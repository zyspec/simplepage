<?php
/**
 * Front page
 *
 * @copyright	xoops.com.cn
 * @author		bitshine <bitshine@gmail.com>
 * @since		1.00
 * @package		simplepage
 */
require_once('../../mainfile.php');
require_once(XOOPS_ROOT_PATH.'/modules/simplepage/include/functions.php');
require_once(XOOPS_ROOT_PATH.'/modules/simplepage/include/vars.php');
$xoopsOption['template_main'] = 'simplepage_index.html';
require('../../header.php');

//Fetch menu
$criteria = new Criteria(null);
$criteria->setSort('weight');
/** @var $menuitemHandler SimplepageMenuitemHandler */
$menuitemHandler = xoops_getmodulehandler('menuitem');
/** @var $menuitem SimplepageMenuitem */
$menuitems       = $menuitemHandler->getAll($criteria);
//echo __FILE__.__LINE__;debugPrint($menuitems);
$GLOBALS['xoopsTpl']->assign('menuitems', $menuitems);


//Fetch page object
$pageName = getRequestVar('page', 'str', '');
$criteria = new CriteriaCompo(null);
if ($pageName == '') {
	if (!isset($menuitems)) redirect_header(XOOPS_URL, 3, _SIMPLEPAGE_MD_PAGENOTFOUND);
	foreach ($menuitems as $menuitem) {
		if (is_object($menuitem)) {
            $pageName = $menuitem->getVar('link');
            if (preg_match("/^http[s]*:\/\//i", $pageName)) {
                header("Location:" . $pageName);
            }
			break;
		} else {
			redirect_header(XOOPS_URL, 3, _SIMPLEPAGE_MD_PAGENOTFOUND);
		}
	}
}
$criteria->add(new Criteria('pageName', $pageName));
$criteria->add(new Criteria('isPublished', 1));
$criteria->setLimit(1);
/*@var $pageHandler SimplepagePageHandler*/
$pageHandler = xoops_getmodulehandler('page');
/*@var $page SimplepagePage*/
$result = $pageHandler->getObjects($criteria);
if (!$result || !$result[0]) redirect_header(XOOPS_URL, 3, _SIMPLEPAGE_MD_PAGENOTFOUND);
$page =& $result[0];
$page->initVar("dohtml",XOBJ_DTYPE_INT,1);
$page->initVar("dobr",XOBJ_DTYPE_INT,0);
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
$breadcrumb = createBreadcrumb();
$breadcrumb->add($moduleName, 'index.php');
foreach ($menuitems as $menuitem) {	
	if ($menuitem->getVar('link') == $page->getVar('pageName')) {
		$breadcrumb->add($menuitem->title());
		break;
	}
}
$GLOBALS['xoopsTpl']->assign('breadcrumb', $breadcrumb->getHtml());

addCss(SIMPLEPAGE_URL."/templates/simplepage.css");
require('../../footer.php');
