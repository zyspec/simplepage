<?php
/**
 * Module settings
 *
 * @package  \Simplepage
 * @copyright  bitshine
 * @author  bitshine <bitshine@gmail.com>
 */

use \XoopsModules\Simplepage\Constants;

/**
 * @var array $modversion
 */
include __DIR__ . '/preloads/autoloader.php';

$moduleDirName = basename(__DIR__);
$moduleDirNameUpper = mb_strtoupper($moduleDirName);

xoops_loadLanguage('common', $moduleDirName);

$modversion['name']           = _MI_SIMPLEPAGE_MODULENAME;
$modversion['version']        = '0.4.0';
$modversion['module_status']  = 'Alpha 1';
$modversion['release_date']   = '2021/09/17';

$modversion['module_website_name']  = 'XOOPS';
$modversion['module_website_url']   = 'https://xoops.org';
$modversion['website']              = 'https://xoops.org';

$modversion['license_url']  = 'https://www.gnu.org/licenses/old-licenses/gpl-2.0.html';

$modversion['description'] = 'A simple page generation utility.';
$modversion['credits']     = "bitshine <bitshine@gmail.com>";
$modversion['author']      = "bitshine <bitshine@gmail.com>";
//$modversion['help']        = "simplepage_help.html";
$modversion['official']    = 0;
$modversion['image']       = "assets/images/simplepage_slogo.jpg";
$modversion['dirname']     = basename(__DIR__);

// Sql file
$modversion['sqlfile']['mysql'] = "sql/mysql.sql";
$modversion['tables'] = [
	'simplepage_page',
	'simplepage_menuitem'
];

// Templates
// front page
$modversion['templates'] = [
    [
	    'file'        => 'simplepage_index.tpl',
	    'description' => ''
    ],
    [
        'file'        => 'simplepage_common_breadcrumb.tpl',
        'description' => ''
    ],
];

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
