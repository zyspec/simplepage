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
    Helper
};

require_once('../../mainfile.php');
require_once(XOOPS_ROOT_PATH.'/modules/simplepage/include/functions.php');
//require_once(XOOPS_ROOT_PATH.'/modules/simplepage/include/vars.php');

$xoopsOption['template_main'] = 'simplepage_index.tpl';
require('../../header.php');

$helper = Helper::getInstance();

//Fetch menu
$criteria = new Criteria(null);
$criteria->setSort('weight');
/** @var  $menuitemHandler  \XoopsModules\Simplepage\MenuItemHandler */
$menuitemHandler = $helper->getHandler('MenuItem');
/** @var  $menuitem  \XoopsModules\Simplepage\MenuItem */
$menuitems = $menuitemHandler->getAll($criteria);
//echo __FILE__.__LINE__;debugPrint($menuitems);
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
$criteria->add(new Criteria('isPublished', 1));
$criteria->setLimit(1);
/*@var $pageHandler SimplepagePageHandler*/
$pageHandler = $helper->getHandler('Page');
/*@var $page SimplepagePage*/
$result = $pageHandler->getObjects($criteria);
if (!$result || !$result[0]) redirect_header(XOOPS_URL, Constants::REDIRECT_DELAY_MEDIUM, _SIMPLEPAGE_MD_PAGENOTFOUND);
$page =& $result[0];
$page->initVar('dohtml', XOBJ_DTYPE_INT, 1);
$page->initVar('dobr', XOBJ_DTYPE_INT, 0);
$GLOBALS['xoopsTpl']->assign('page', $page);
//echo __FILE__.__LINE__;debugPrint($page);

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

addCss($helper->url('templates/simplepage.css'));
require_once XOOPS_ROOT_PATH . '/footer.php';
