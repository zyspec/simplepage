<?php
/*
 * You may not change or alter any portion of this comment or credits of
 * supporting developers from this source code or any supporting source code
 * which is considered copyrighted (c) material of the original comment or credit
 * authors.
 * This program is distributed in the hope that it will be useful, but
 * WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 */
/**
 * Module: Xyp4all
 *
 * @package  \XoopsModules\Simplepage
 * @subpackage  install
 * @copyright  &copy; 2001-2021 {@link https://xoops.org XOOPS Project}
 * @license  {@link https://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU GPL 2}
 * @author  XOOPS Module Development Team
 * @since  0.4.0
 */
use XoopsModules\Simplepage\{
    Common\Configurator,
    Helper,
    Utility
};

defined('XOOPS_ROOT_PATH') || die('Restricted access');
require_once dirname(__DIR__) . '/preloads/autoloader.php';
/**
 *
 * @internal {Make sure you PROTECT THIS FILE}
 */
if (!($GLOBALS['xoopsUser'] instanceof \XoopsUser) || !($GLOBALS['xoopsUser']->isAdmin())) {
    die("Restricted access" . PHP_EOL);
}

/**
 * Prepares system prior to attempting to install module
 *
 * @param  \XoopsModule  $module  {@see \XoopsModule}
 * @return  bool  true if ready to install, false if not
 */
function xoops_module_pre_install_simplepage(\XoopsModule $module)
{
    $utility      = new Utility();
    $xoopsSuccess = $utility::checkVerXoops($module);
    $phpSuccess   = $utility::checkVerPHP($module);
    return $xoopsSuccess && $phpSuccess;
}

/**
 * Performs tasks required during installation of the module
 *
 * @param  \XoopsModule  $module  {@see \XoopsModule}
 *
 * @return bool true if installation successful, false if not
 */
function xoops_module_install_simplepage(\XoopsModule $module)
{
    $helper       = Helper::getInstance();
    $configurator = new Configurator();
    $helper->loadLanguage('admin');
    // Create the simplepage upload directory
    $uploadPathObj = new \SplFileInfo($configurator->paths['uploadPath']);
    if ((false === $uploadPathObj->isDir()) && (false === mkdir($configurator->paths['uploadPath'], 0755, true))) {
        $success = false;
        $GLOBALS['xoopsModule']->setErrors(sprintf(_AM_SIMPLEPAGE_ERR_BAD_UPLOAD_PATH, $configurator->paths['uploadPath']));
    } else {
        // Create index file in new directories
        $newFile = $configurator->paths['uploadPath'] . '/index.php';
        $fileInfo = new \SplFileInfo($newFile);
        $fileObj = $fileInfo->openFile('w');
        $success = $fileObj->fwrite("<?php\nheader('HTTP/1.0 404 Not Found');\n");
        $fileObj = null; // destroy SplFileObject so it closes file
        if (null === $success) {
            $success = false;
            $GLOBALS['xoopsModule']->setErrors(sprintf(_AM_SIMPLEPAGE_ERR_BAD_INDEX, $newFile));
            // break;
        }
        $fileInfo = null; // destroy this splFileInfo object
    }
    return $success;
}
