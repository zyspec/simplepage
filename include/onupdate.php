<?php
/*
 * You may not change or alter any portion of this comment or credits of
 * supporting developers from this source code or any supporting source code
 * which is considered copyrighted (c) material of the original comment or credit
 * authors.
 *
 * This program is distributed in the hope that it will be useful, but
 * WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 */
/**
 * Module: Simplepage
 *
 * An module to provide easy page creation
 *
 * @package  \XoopsModules\Simplepage
 * @subpackage  install
 * @copyright  &copy; 2001-2021 {@link https://xoops.org XOOPS Project}
 * @license  {@link https://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU GPL 2}
 * @author  Richard Griffith  <richard@geekwright.com>
 * @author  trabis  <lusopoemas@gmail.com>
 * @author  XOOPS Module Development Team
 * @since  0.4.0
 */
use XoopsModules\Simplepage\{
    Common\Configurator,
    Constants,
    Helper,
    Utility
};

/** @internal Make sure you PROTECT THIS FILE */

if ((!defined('XOOPS_ROOT_PATH')) || !($GLOBALS['xoopsUser'] instanceof \XoopsUser) || !($GLOBALS['xoopsUser']->isAdmin())) {
    die('Restricted access');
}

/**
 * Upgrade works to update Simplepage from previous versions
 *
 * @uses  \Xmf\Module\Admin
 * @uses  \XoopsModules\Simplepage\Utility
 *
 * @param  \XoopsModule $module  {@see \XoopsModule}
 * @param  string  $prev_version  version * 100
 * @return  bool
 *
 */
function xoops_module_update_simplepage(\XoopsModule $module, $prev_version)
{
    $success = Utility::checkVerXoops($module);
    $success = $success && Utility::checkVerPHP($module);
    if (!$success) {
        return false;
    }
    /*
     * =============================================================
     * Upgrade for Simplepage < 0.4.0
     * =============================================================
     * - move old directories and contents to uploads folder
     * - remove old .css, .js, and .image and (sub)folders if they exist
     * - remove old .html template files since they've been replaced with .tpl files
     * =============================================================
     */

    $success = true; // not really needed but included in case addt'l code added above in the future
    $helper  = Helper::getInstance();
    $helper->loadLanguage('modinfo');
    $helper->loadLanguage('common');

    // ----------------------------------------------------------------
    // Remove previous .css, .js and .images directories since they're
    // being moved to ./assets
    // ----------------------------------------------------------------
    //
    // @todo  move any 'files' to the downloads folder (directory)
    $configurator = new Configurator();
    $oldFolders   = $configurator->oldFolders;
    $badFolders   = [];

    foreach ($oldFolders as $oldFolder) {
        $dirInfo = new \SplFileInfo($oldFolder);
        if ($dirInfo->isDir()) {
            // Folder exists so try and delete it
            $success = $success && Utility::deleteDirectory($oldFolder);
            if (!$success) {
                $badFolders[] = $oldFolder;
            }
        }
    }
    if (!$success) {
        /**
         * @var  string[]  $badFolders
         * @var  string  $badFolder
         */
        foreach ($badFolders as $badFolder) {
            $module->setErrors(sprintf('CO_SIMPLEPAGE_ERROR_BAD_DEL_PATH', $badFolder));
        }
    }

    // -----------------------------------------------------------------------
    // Remove ./template/*.html (except index.php) files since they're being
    // replaced by *.tpl files
    // -----------------------------------------------------------------------
    // Remove old files
    if ($prev_version < 200) {
        $folder = $helper->path('templates/');
        $dirInfo = new \SplFileInfo($folder);
        // Validate is a directory
        if ($dirInfo->isDir()) {
            $fileList = array_diff(scandir($folder), ['..', '.', 'index.php']);
            foreach ($fileList as $k => $v) {
                if (!preg_match('/.tpl+$/i', $v)) {
                    $fileInfo = new \SplFileInfo($folder . $v);
                    if ($fileInfo->isDir()) {
                        // Recursively handle sub-folders
                        if (!($success = Utility::deleteDirectory($folder . $v))) {
                            $module->setErrors(sprintf('CO_SIMPLEPAGE_ERROR_BAD_DEL_PATH', $folder . $v));
                        }
                    } elseif ($fileInfo->isFile()) {
                        if (!($success = unlink($fileInfo->getRealPath()))) {
                            $module->setErrors(sprintf('CO_SIMPLEPAGE_ERROR_BAD_DEL_PATH', $fileInfo->getFilename()));
                        }
                    }
                }
            }
        } else {
            // Couldn't find template directory - that's bad
            $module->setErrors(sprintf(CO_SIMPLEPAGE_ERROR_FLDR_NOT_FOUND, htmlspecialchars($folder)));
            $success = false;
        }
    }
    return $success;
}
