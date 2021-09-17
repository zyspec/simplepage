<?php
/**
 * Admin menu
 *
 * @package  \XoopsModules\Simplepage
 * @subpackage  admin
 * @copyright  &copy; 2000-2016 {@link https://xoops.org XOOPS Project}
 * @license  {@link https://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU GPL 2 or later}
 * @author  bitshine <bitshine@gmail.com>
 * @author  XOOPS Module Developement Team
 */
use Xmf\Module\Admin;
use XoopsModules\Simplepage\{
    Constants,
    Helper
};

include dirname(__DIR__) . '/preloads/autoloader.php';

$moduleDirName      = basename(dirname(__DIR__));
$moduleDirNameUpper = mb_strtoupper($moduleDirName);

/** @var  Helper  $helper */
$helper = Helper::getInstance();

$helper->loadLanguage('common');
//$helper->loadLanguage('feedback');

$pathIcon32    = Admin::menuIconPath('');
$pathModIcon32 = '';
if (is_object($helper->getModule())) {
    $pathModIcon32 = $helper->url($helper->getModule()->getInfo('modicons32'));
}

$adminmenu[] = [
    'title' => 'Home',
    'link'  => 'admin/index.php',
    'icon'  => $pathIcon32 . '/home.png',
];
$adminmenu[] = [
    'title' => 'Page',
    'link'  => 'admin/page.php',
    'icon'  => $pathIcon32 . '/content.png',
];
$adminmenu[] = [
    'title' => 'Menu',
    'link'  => 'admin/menuitem.php',
    'icon'  => $pathIcon32 . '/index.png',
];
if ($helper->getConfig('displayDeveloperTools')) {
    $adminmenu[] = [
        'title' => constant('CO_' . $moduleDirNameUpper . '_' . 'ADMENU_MIGRATE'),
        'link'  => 'admin/migrate.php',
        'icon'  => $pathIcon32 . '/database_go.png',
    ];
}

$adminmenu[] = [
    'title' => 'About',
    'link'  => 'admin/about.php',
    'icon'  => $pathIcon32 . '/about.png',
];
