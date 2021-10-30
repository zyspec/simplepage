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

$xoopsOption['template_main'] = 'simplepage_index.tpl';
require dirname(__DIR__, 2) . '/header.php';

$helper = Helper::getInstance();

/** @var  string  $pageName */
$pageName = Request::getString('page', '');

//Fetch menu
$criteria = new Criteria(null);
$criteria->setSort('weight');
/**
 * @var  \XoopsModules\Simplepage\MenuItemHandler  $menuitemHandler
 * @var  \XoopsModules\Simplepage\MenuItem[]  $menuItemArray
 * @var  \XoopsModules\Simplepage\MenuItem[]  $menuitem
 * @var  \XoopsModules\Simplepage\MenuItem  $item
 */
$menuitemHandler = $helper->getHandler('MenuItem');
$menuItemArray   = $menuitemHandler->getAll($criteria);

foreach ($menuItemArray as $item) {
    $items['linkAttribs'] = [
        'link'   => $item->link(),
        'page'   => $item->getVar('link'),
        'target' => $item->target(),
        'title'  => $item->title()
    ];
    $GLOBALS['xoopsTpl']->append('menuItemArray', $items);
}
if ('' == $pageName && (!is_countable($menuItemArray) || 0 == count($menuItemArray))) {
    if (empty($menuItemArray)){
        redirect_header(XOOPS_URL, Constants::REDIRECT_DELAY_MEDIUM, _SIMPLEPAGE_MD_PAGENOTFOUND);
    }
    foreach ($menuItemArray as $item) {
        $pageName = $item->link();
        if (preg_match("/^http[s]*:\/\//i", $pageName)) {
            header("Location:" . $pageName);
        }
        break;
    }
}

$criteria = new \CriteriaCompo();
$criteria->add(new \Criteria('pageName', $pageName));
$criteria->add(new \Criteria('isPublished', Constants::IS_PUBLISHED));
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
$GLOBALS['xoopsTpl']->assign('page', $page->getValues());
$GLOBALS['xoopsTpl']->assign('pageName', $pageName);

///Bread crumbs
//Take the title. The language file can be modified to display different module names in different languages
//If not defined, the module name set in the module management will be displayed
$moduleName = defined('_MI_SIMPLEPAGE_MODULENAME') ? _MI_SIMPLEPAGE_MODULENAME : $GLOBALS['xoopsModule']->name();

$breadcrumb = new Breadcrumb();
$breadcrumb->addLink($moduleName, 'index.php');
foreach ($menuItemArray as $menuItem) {
	if ($menuItem->getVar('link') == $page->getVar('pageName')) {
		$breadcrumb->addLink($menuItem->title());
		break;
	}
}
$GLOBALS['xoopsTpl']->assign('breadcrumb', $breadcrumb->render());
$GLOBALS['xoTheme']->addStylesheet($helper->url('assets/css/simplepage.css'));
require_once XOOPS_ROOT_PATH . '/footer.php';
