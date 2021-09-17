<?php
/*
 You may not change or alter any portion of this comment or credits of
 supporting developers from this source code or any supporting source code
 which is considered copyrighted (c) material of the original comment or credit
 authors.

 This program is distributed in the hope that it will be useful, but
 WITHOUT ANY WARRANTY; without even the implied warranty of
 MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 */

/**
 * Module: Pedigree
 *
 * @package   \XoopsModules\Pedigree
 * @subpackage  admin
 * @author  XOOPS Module Development Team
 * @copyright  &copy; 2000-2021 {@link https://xoops.org XOOPS Project}
 * @license  {@link https://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU GPL 2 or later}
 * @since  0.4.0
 */

use XoopsModules\Simplepage;

require_once  dirname(__DIR__, 3) . '/include/cp_header.php';
$helper = XoopsModules\Simplepage\Helper::getInstance();
$helper->loadLanguage('modinfo');
require_once $helper->path('admin/menu.php');
