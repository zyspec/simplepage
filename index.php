<?php
/**
 * Front page
 *
 * @package  \XoopsModules\Simplepage
 * @copyright  xoops.com.cn
 * @author  bitshine <bitshine@gmail.com>
 */

use \Xmf\Request;
use \XoopsModules\Simplepage\{
    Common\Breadcrumb,
    Constants,
    Helper,
    Page
};

include __DIR__ . '/preloads/autoloader.php';
require_once dirname(__DIR__, 2) . '/mainfile.php';
//require_once XOOPS_ROOT_PATH . '/modules/simplepage/include/functions.php';

$xoopsOption['template_main'] = 'simplepage_index.tpl';
require dirname(__DIR__, 2) . '/header.php';

$helper = Helper::getInstance();

//Fetch menu
$criteria = new Criteria(null);
$criteria->setSort('weight');
/** @var  $menuitemHandler  \XoopsModules\Simplepage\MenuItemHandler */
$menuitemHandler = $helper->getHandler('MenuItem');
/** @var  $menuitem  \XoopsModules\Simplepage\MenuItem */
$menuitems = $menuitemHandler->getAll($criteria);
//\Xmf\Debug::dump($menuitems);
$GLOBALS['xoopsTpl']->assign('menuitems', $menuitems);

//Fetch page object
$pageName = Request::getString('page', '');
if ('' == $pageName) {
	if (!isset($menuitems)) redirect_header(XOOPS_URL, Constants::REDIRECT_DELAY_MEDIUM, _SIMPLEPAGE_MD_PAGENOTFOUND);
	foreach ($menuitems as $menuitem) {
		if (is_object($menuitem)) {
            $pageName = $menuitem->getVar('link');
            if (preg_match("/^http[s]*:\/\//i", $pageName)) {
                header("Location:" . $pageName);
            }
			break;
		} else {
			redirect_header(XOOPS_URL, Constants::REDIRECT_DELAY_MEDIUM, _SIMPLEPAGE_MD_PAGENOTFOUND);
		}
	}
}
$criteria = new CriteriaCompo();
$criteria->add(new Criteria('pageName', $pageName));
$criteria->add(new Criteria('isPublished', Constants::IS_PUBLISHED));
$criteria->setLimit(1);
/**
 * @var  \XoopsModules\Simplepage\PageHandler  $pageHandler
 * @var  \XoopsModules\Simplepage\Page[]  $result
 * @var  \XoopsModules\Simplepage\Page  $page
 */
$pageHandler = $helper->getHandler('Page');
$result      = $pageHandler->getObjects($criteria);
if (!$result || !(array_key_exists(0, $result)) || !$result[0] instanceof Page) {
    redirect_header(XOOPS_URL, Constants::REDIRECT_DELAY_MEDIUM, _SIMPLEPAGE_MD_PAGENOTFOUND);
}
$page = $result[0];
$page->initVar('dohtml', XOBJ_DTYPE_INT, 1);
$page->initVar('dobr', XOBJ_DTYPE_INT, 1);
$GLOBALS['xoopsTpl']->assign('page', $page);
//\Xmf\Debug::dump($page);

///Bread crumbs
//Take the title. The language file can be modified to display different module names in different languages
//If not defined, the module name set in the module management will be displayed
if (defined('_MI_SIMPLEPAGE_MODULENAME')) {
	$moduleName = _MI_SIMPLEPAGE_MODULENAME;
} else {
	$moduleName = $GLOBALS['xoopsModule']->name();
}
$breadcrumb = new Breadcrumb();
$breadcrumb->addLink($moduleName, 'index.php');
foreach ($menuitems as $menuitem) {
	if ($menuitem->getVar('link') == $page->getVar('pageName')) {
		$breadcrumb->addLink($menuitem->title());
		break;
	}
}

$GLOBALS['xoopsTpl']->assign('breadcrumb', $breadcrumb->render());
$GLOBALS['xoTheme']->addStylesheet($helper->url('assets/css/simplepage.css'));
require_once XOOPS_ROOT_PATH . '/footer.php';
