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
 * @package  \XoopsModules\Simplepage
 * @subpackage  install
 * @copyright  &copy; 2001-2021 {@link https://xoops.org XOOPS Project}
 * @license  {@link https://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU GPL 2}
 * @author  XOOPS Module Development Team
 * @since  0.4.0
 */

/**
 *
 * @internal {Make sure you PROTECT THIS FILE}
 */
use XoopsModules\Simplepage\{
    Helper,
    Utility
};

if ((!defined('XOOPS_ROOT_PATH')) || !($GLOBALS['xoopsUser'] instanceof XoopsUser) || !($GLOBALS['xoopsUser']->isAdmin())) {
    die('Restricted access' . PHP_EOL);
}

/**
 * Prepare to uninstall module
 *
 * @param \XoopsModule $module
 *
 * @return bool success
 */
function xoops_module_pre_uninstall_simplepage(\XoopsModule $module)
{
    // NOP
    return true;
}

/**
 * Uninstall module
 *
 * @param \XoopsModule $module
 *
 * @return bool success
 */
function xoops_module_uninstall_simplepage(\XoopsModule $module)
{
    $helper = Helper::getInstance();
    $helper->loadLanguage('modinfo');

    // Remove uploads folder (and all files in the folder)
    $uploadDir = $helper->uploadPath();
    $dirInfo   = new \SplFileInfo($uploadDir);

    $success = true;
    if ($dirInfo->isDir()) {
        // Folder exists so try and delete it
        $success = Utility::deleteDirectory($uploadDir);
    } else {
        // Try and delete all files and then uploads/xyp4all folder (default)
        //$uploadPathObj = new \SplFileInfo($uploadDir);
        if (false !== $dirInfo->isDir()) {
            // directory exists so try and delete it
            $success = Utility::deleteDirectory($dirInfo);
        }
    }
    if (!$success) {
        $module->setErrors(sprintf(_MI_SIMPLEPAGE_ERR_DEL_FLDR, $uploadDir));
    }
    return $success;
}
