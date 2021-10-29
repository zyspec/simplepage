<?php
/**
 * Module settings
 *
 * @package  \XoopsModules\Simplepage
 * @copyright  bitshine
 * @copyright  &copy; 2000-2021 {@link https://xoops.org XOOPS Project}
 * @author  bitshine <bitshine@gmail.com>
 * @author  XOOPS Module Development Team
 */

use XoopsModules\Simplepage\Constants;

/**
 * @var  mixed[]  $modversion
 */
include __DIR__ . '/preloads/autoloader.php';

$moduleDirName      = basename(__DIR__);
$moduleDirNameUpper = mb_strtoupper($moduleDirName);

xoops_loadLanguage('common', $moduleDirName);

$modversion['name']           = _MI_SIMPLEPAGE_MODULENAME;
$modversion['version']        = '0.4.0';
$modversion['module_status']  = 'alpha.1';
$modversion['release_date']   = '2021/10/29';

$modversion['min_php']        = '7.3';
$modversion['min_xoops']      = '2.5.10';
$modversion['min_admin']      = '1.2';
$modversion['min_db']         = ['mysql' => '5.6', 'mysqli' => '5.6'];
$modversion['official']       = 0;

$modversion['module_website_name']  = 'XOOPS';
$modversion['module_website_url']   = 'https://xoops.org';
$modversion['website']              = 'https://xoops.org';

$modversion['license_url']  = 'https://www.gnu.org/licenses/old-licenses/gpl-2.0.html';

$modversion['description'] = 'A simple page generation utility.';
$modversion['credits']     = "bitshine <bitshine@gmail.com>";
$modversion['author']      = "bitshine <bitshine@gmail.com>";
//$modversion['help']        = "simplepage_help.html";
$modversion['image']       = "assets/images/simplepage_slogo.jpg";
$modversion['dirname']     = basename(__DIR__);

// Icon locations
$modversion['icons16']    = 'Frameworks/moduleclasses/icons/16';
$modversion['icons32']    = 'Frameworks/moduleclasses/icons/32';
$modversion['modicons16'] = 'assets/images/icons/16';
$modversion['modicons32'] = 'assets/images/icons/32';

// Sql file
$modversion['sqlfile']['mysql'] = "sql/mysql.sql";
$modversion['tables'] = [
	'simplepage_page',
	'simplepage_menuitem'
];

// ------------------- Templates -------------------
$modversion['templates'] = [
    ['file' => 'simplepage_index.tpl', 'description' => _MI_SIMPLEPAGE_TPL_INDEX_DESC],
    ['file' => 'simplepage_common_breadcrumb.tpl', 'description' => _MI_SIMPLEPAGE_TPL_BREADCRUMB_DESC],
    ['file' => 'admin/simplepage_page_list.tpl', 'description' => _MI_SIMPLEPAGE_TPL_ADMIN_PAGE_DESC],
    ['file' => 'admin/simplepage_menuitem_list.tpl', 'description' => _MI_SIMPLEPAGE_TPL_ADMIN_MENU_DESC]
];

// ------------------- Install/Update -------------------
$modversion['onInstall']   = 'include/oninstall.php';
$modversion['onUpdate']    = 'include/onupdate.php';
$modversion['onUninstall'] = 'include/onuninstall.php';

// Main Menu
$modversion['hasMain']     = 1;

// Admin menu things
$modversion['hasAdmin']    = 1;
$modversion['system_menu'] = 1;
$modversion['adminindex']  = "admin/index.php";
$modversion['adminmenu']   = "admin/menu.php";

// Make Sample button visible?
$modversion['config'][] = [
    'name'        => 'perpage',
    'title'       => '_MI_SIMPLEPAGE_MENU_PERP',
    'description' => '_MI_SIMPLEPAGE_MENU_PERP_DESC',
    'formtype'    => 'select',
    'valuetype'   => 'int',
    'default'     => Constants::DEFAULT_PER_PAGE,
    'options'     => ['10' => 10, '25' => 25, '50' => 50, '75' => 75, '100' => 100],
];

// Max file size in bytes
$modversion['config'][] = [
    'name'        => 'maxfilesize',
    'title'       => '_MI_SIMPLEPAGE_MAXFILESIZE',
    'description' => '_MI_SIMPLEPAGE_MAXFILESIZEDSC',
    'formtype'    => 'textbox',
    'valuetype'   => 'int',
    'default'     => Constants::DEFAULT_FILE_SIZE,
];

// Max image width in px
$modversion['config'][] = [
    'name'        => 'maximgwidth',
    'title'       => '_MI_SIMPLEPAGE_IMGWIDTH',
    'description' => '_MI_SIMPLEPAGE_IMGWIDTHDSC',
    'formtype'    => 'textbox',
    'valuetype'   => 'int',
    'default'     => Constants::DEFAULT_IMAGE_WIDTH,
];

// Max image height in px
$modversion['config'][] = [
    'name'        => 'maximgheight',
    'title'       => '_MI_SIMPLEPAGE_IMGHEIGHT',
    'description' => '_MI_SIMPLEPAGE_IMGHEIGHTDSC',
    'formtype'    => 'textbox',
    'valuetype'   => 'int',
    'default'     => Constants::DEFAULT_IMAGE_HEIGHT,
];


// Max thumbnail image width in px
$modversion['config'][] = [
    'name'        => 'maxthumbwidth',
    'title'       => '_MI_SIMPLEPAGE_THUMBWIDTH',
    'description' => '_MI_SIMPLEPAGE_THUMBWIDTHDSC',
    'formtype'    => 'select',
    'valuetype'   => 'int',
    'default'     => Constants::DEFAULT_THUMB_WIDTH,
    'options'     => [100 => '100', 150 => '150', 300 => '300', 400 => '400']
];

$modversion['config'][] = [
    'name'        => 'displaySampleButton',
    'title'       => 'CO_' . $moduleDirNameUpper . '_' . 'SHOW_SAMPLE_BUTTON',
    'description' => 'CO_' . $moduleDirNameUpper . '_' . 'SHOW_SAMPLE_BUTTON_DESC',
    'formtype'    => 'yesno',
    'valuetype'   => 'int',
    'default'     => 1,
];

// Show Developer Tools?
$modversion['config'][] = [
    'name'        => 'displayDeveloperTools',
    'title'       => 'CO_' . $moduleDirNameUpper . '_' . 'SHOW_DEV_TOOLS',
    'description' => 'CO_' . $moduleDirNameUpper . '_' . 'SHOW_DEV_TOOLS_DESC',
    'formtype'    => 'yesno',
    'valuetype'   => 'int',
    'default'     => 0,
];
