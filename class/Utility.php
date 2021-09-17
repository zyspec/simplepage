<?php

namespace XoopsModules\Simplepage;

/*
 * You may not change or alter any portion of this comment or credits
 * of supporting developers from this source code or any supporting source code
 * which is considered copyrighted (c) material of the original comment or credit authors.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 */

/**
 * @package  XoopsModules\Simplepage
 * @subpackage  class
 *
 * @copyright  {@link https://xoops.org/ XOOPS Project}
 * @license  {@link https://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU GPL 2 or later}
 * @author  XOOPS Module Dev Team (https://xoops.org)
 * @link  https://github.com/XoopsModules25x/simplepage  Simplepage Repository
 */

use XoopsModules;
use XoopsModules\Simplepage\{
    Common\Configurator,
};


/**
 * Class Simplepage\Utility
 *
 */
class Utility
{
    use Common\VersionChecks; //checkVerXoops, checkVerPhp Traits
    use Common\ServerStats; // getServerStats Trait
    use Common\FilesManagement; // Files Management Trait

    //--------------- Custom module methods -----------------------------

    /**
     * @param  string  $haystack
     * @param  string  $needle
     * @param  int  $offset
     *
     * @return  bool|int
     */
    public static function myStrRpos($haystack, $needle, $offset = 0)
    {
        // same as strrpos, except $needle can be a string
        $strrpos = false;
        if (is_string($haystack) && is_string($needle) && is_numeric($offset)) {
            $strlen = mb_strlen($haystack);
            $strpos = mb_strpos(strrev(mb_substr($haystack, $offset)), strrev($needle));
            if (is_numeric($strpos)) {
                $strrpos = $strlen - $strpos - mb_strlen($needle);
            }
        }

        return $strrpos;
    }

    /**
     * Upload an image from user
     *
     * @uses \XoopsMediaUploader
     *
     * @param int $num number of image in upload file array
     * @return string name of uploaded image or '' if failed
     */
    public static function uploadPicture($num)
    {
        require_once $GLOBALS['xoops']->path('class/uploader.php');

        $num = (int)$num;

        /** @var Helper $helper */
        $helper           = Helper::getInstance();
        $maxImgSize       = $helper->getConfig('maxfilesize');
        $maxImgWidth      = $helper->getConfig('maximgwidth');
        $maxImgHeight     = $helper->getConfig('maximgheight');
        $allowedMimetypes = ['image/gif', 'image/jpeg', 'image/pjpeg', 'image/x-png', 'image/png'];
        /** Changed this to use settings from module helper */
        $imgDir           = $helper->uploadPath('images');
        //$imgDir           = $helper->getConfig('uploaddir') . '/images';

        $field = $_POST['xoops_upload_file'][$num];
        $photo = '';
        if (!empty($field)) {
            $uploader = new \XoopsMediaUploader($imgDir, $allowedMimetypes, $maxImgSize, $maxImgWidth, $maxImgHeight);
            $uploader->setPrefix('img');
            if ($uploader->fetchMedia($field) && $uploader->upload()) {
                $photo = $uploader->getSavedFileName();
            } else {
                echo $uploader->getErrors();
            }
            static::createThumbs($photo);
        }

        return $photo;
    }

    /**
     * @param $filename
     */
    public static function createThumbs(string $filename)
    {
        $helper = Helper::getInstance();

        require_once $helper->path('class/libraries/Zebra_Image/Zebra_Image.php');

        $configurator = new Configurator();
        $image        = new Zebra_Image();
        $tWidth       = $helper->getConfig('maxthumbwidth');

        // image's type - '.jpg' as extension will instruct the script to create a 'jpg' file
        $imageType = 'jpeg';

        // indicate a source image (a GIF, PNG or JPEG file)
        $image->source_path = $configurator->uploadFolders['paths']['uploadPath'] . "/images/{$filename}";

        // generate & output thumbnail
        $output_filename    = $helper->uploadPath('images/thumbnails/') . basename($filename) . "_{$tWidth}.{$imageType}";
        $image->target_path = $output_filename;

        // set additional properties
        $image->jpeg_quality           = 100;  // depending on image size could change to 90 or 95 with minimal loss and decreased file size
        $image->preserve_aspect_ratio  = true;
        $image->enlarge_smaller_images = true;
        $image->preserve_time          = true;

        // resize the image by using the "crop from center" method
        //  and if there is an error, display the error
        if (!$image->resize($tWidth, 0)) {
            // if there was an error, let's see what the error is about
            switch ($image->error) {
                case 1:
                    echo 'Source file could not be found!';
                    break;
                case 2:
                    echo 'Source file is not readable!';
                    break;
                case 3:
                    echo 'Could not write target file!';
                    break;
                case 4:
                    echo 'Unsupported source file format!';
                    break;
                case 5:
                    echo 'Unsupported target file format!';
                    break;
                case 6:
                    echo 'GD library version does not support target file format!';
                    break;
                case 7:
                    echo 'GD library is not installed!';
                    break;
                case 8:
                    echo '"chmod" command is disabled via configuration!';
                    break;
            }

            // if no errors
        } else {
            echo 'Success!';
        }

        unset($image);
    }

    /**
     * @param $string
     * @return string
     */
    public static function unHtmlEntities($string)
    {
        $trans_tbl = array_flip(get_html_translation_table(HTML_ENTITIES));

        return strtr($string, $trans_tbl);
    }
}
