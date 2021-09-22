<?php
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
 * @subpackage admin
 * @copyright  &copy; 2000-2021 {@link https://xoops.org XOOPS Project}
 * @license  @license  {@link https://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU GPL 2 or later}
 * @author  XOOPS Module Dev Team
 * @link  https://github.com/XoopsModules25x/simplepage  Simplepage Repository
 */

use Xmf\Module\Admin;

require_once dirname(__DIR__, 3) . '/include/cp_header.php';
require_once $GLOBALS['xoops']->path('www/class/xoopsformloader.php');
require_once dirname(__DIR__) . '/include/common.php';

$moduleDirName      = basename(dirname(__DIR__));
$moduleDirNameUpper = mb_strtoupper($moduleDirName);

/** @var  Xmf\Module\Admin  $adminObject */
$adminObject   = Admin::getInstance();

/**
 * @var  \XoopsModules\Simplepage\Helper  $helper  defined in ../include/common.php
 * @var  string  $pathModIcon32
 * @var  string  $pathModIcon16
 */
$pathModIcon32 = $helper->getModule()->getInfo('modicons32');
$pathModIcon16 = $helper->getModule()->getInfo('modicons16');

// Load language files
$helper->loadLanguage('admin');
$helper->loadLanguage('main');
$helper->loadLanguage('modinfo');
