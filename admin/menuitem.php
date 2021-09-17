<?php
/**
 * Manage menu items
 *
 * @package  \XoopsModules\Simplepage
 * @subpackage  admin
 * @copyright  xoops.com.cn
 * @copyright  &copy; 2000-2021 {@link https://xoops.org XOOPS Project}
 * @author  bitshine <bitshine@gmail.com>
 * @author  XOOPS Module Development Team
 */

use \Xmf\Request;
use \XoopsModules\Simplepage\{
    Constants,
    Helper
};

/**
 * @var Xmf\Module\Admin $adminObject
 * @var XoopsModules\Simplepage\Helper $helper
 * @var string $moduleDirName
 * @var string $moduleDirNameUpper
 * @var string[] $icons;
 */
require_once __DIR__ . '/admin_header.php';

require_once('../include/functions.php');
//require_once('../include/vars.php');
xoops_cp_header();

$adminObject->displayNavigation(basename(__FILE__));

$op = Request::getCmd('op', 'list');
switch ($op) {
	case 'add': //Show add interface
	case 'edit': //Show editing interface
        $adminObject->addItemButton(_AD_SIMPLEPAGE_ADDMENUITEM, 'menuitem.php?op=add', 'add');
        $adminObject->displayButton('left');
        $menuitemId = Request::getInt('menuitemId', 0);
        //Get data
        /** @var  $menuItemHandler  \XoopsModules\Simplepage\MenuItemHandler */
        $menuItemHandler = $helper->getHandler('MenuItem');
        $menuitem        = $menuItemHandler->get($menuitemId);
        //include('../include/admin_header_tpl.php');
        include('../include/menuitem_form.php');
        break;
	case 'save': //Save to database
        $menuitemId = Request::getInt('menuitemId', 0);
        /** @var $menuItemHandler \XoopsModules\Simplepage\MenuItemHandler */
        $menuItemHandler = $helper->getHandler('MenuItem');
        /** @var $menuitem \XoopsModules\Simplepage\MenuItem */
        $menuitem = $menuItemHandler->get($menuitemId);
        $menuitem->setFormVars($_POST, '');
        //$menuitem->setVar('target', )
        //Sorting
        if ($menuitem->isNew()) {
            $menuitem->setVar('weight', time());
        }
        //Insert into the database
        if ($menuItemHandler->insert($menuitem)) {
            redirect_header($_SERVER['SCRIPT_NAME'], Constants::REDIRECT_DELAY_MEDIUM, _AD_SIMPLEPAGE_UPDATE_DATABASE_SUCCESS);
        } else {
            //echo '<div class="error">'.$menuitem->getHtmlErrors().'</div>';
            redirect_header($_SERVER['SCRIPT_NAME'] . '?op=add&menuitemId=' . $menuitemId, Constants::REDIRECT_DELAY_MEDIUM, $menuitem->getHtmlErrors());
        }
        break;
	case 'confirmDelete': //Show delete warning
		//confirmDelete();
		break;
	case 'delete': //Delete from database
		//deleteMenuitem();
        if (!Request::hasVar('menuitemId')) {
            redirect_header($_SERVER['SCRIPT_NAME'].'?op=list', Constants::REDIRECT_DELAY_MEDIUM, 'Deleting object no exist.');
        }
        /** @var Helper $helper */
        $helper = Helper::getInstance();
        $menuitemId = Request::getInt('menuitemId', null);
        /** @var $menuItemHandler \XoopsModules\Simplepage\MenuItemHandler */
        $menuItemHandler = $helper->getHandler('MenuItem');
        /** @var $menuitem \XoopsModules\Simplepage\MenuItem */
        $menuitem = $menuItemHandler->get($menuitemId);
        if (!$menuitem) {
            $message = 'Menu item does not exist.';
        } else {
            $title = $menuitem->getVar('alias');
            if ($menuItemHandler->delete($menuitem)) {
                $message = 'Delete '.$title.' success.';
            } else {
                $message = '<span class="red">' . _DELETE . $title . ' fail.</span>';
            }
        }
        redirect_header($_SERVER['SCRIPT_NAME'].'?op=list', Constants::REDIRECT_DELAY_MEDIUM, $message);
        break;
	case 'sort': //Perform sorting
        $menuOrder = Request::getString('menuOrder', '');
        $menuOrder = str_replace("sortable[]=", "", $menuOrder);
        $order = explode('&', $menuOrder);

        //Get parameters
        $criteria = new \Criteria('', '');
        $criteria->setSort('weight');

        //Get list data
        /** @var $menuItemHandler XoopsModules\Simplepage\MenuItemHandler */
        $menuItemHandler = $helper->getHandler('MenuItem');
        $menuitems = $menuItemHandler->getObjects($criteria, true);

        $message = '';
        if ($menuitems) {
            $weight = $first = reset($menuitems)->getVar('weight');
            if ($weight == 0) echo __FILE__.__LINE__."0000000000000000";
            $last = end($menuitems)->getVar('weight');
            $interval = intval(($last - $first) / (count($menuitems) - 1));
            foreach ($order as $id) {
                $menuitems[$id]->setVar('weight', intval($weight));
                if (!$menuItemHandler->insert($menuitems[$id])) $message .= $menuItemHandler->getErrors();
                //echo __FILE__.__LINE__;debugPrint($weight);
                $weight = $weight + $interval;
            }
        }
        redirect_header($_SERVER['SCRIPT_NAME'], Constants::REDIRECT_DELAY_MEDIUM, $message);
        break;
	case 'generate': //Generate menu items
		//generateMenuitem();
		break;
	case 'list': //List display
	default:
		//listMenuitem();
        $adminObject->addItemButton(_AD_SIMPLEPAGE_ADDMENUITEM, 'menuitem.php?op=add', 'add');
        $adminObject->displayButton('left');

        $start    = Request::getInt('start', 0);
        $criteria = new Criteria('', '');
        $criteria->setSort('weight');
        //$criteria->setLimit($helper->getConfig('perpage', Constants::DEFAULT_PER_PAGE));
        //Get list data
        /** @var  $menuItemHandler  \XoopsModules\Simplepage\MenuItemHandler */
        $menuItemHandler = $helper->getHandler('MenuItem');
        $menuitems = $menuItemHandler->getAll($criteria);
        //$count = $menuItemHandler->getCount($criteria);
        //$menuitemr = getPageNav($count, $helper->getConfig('perpage', Constants::DEFAULT_PER_PAGE), $start, 'start');
        //Show list
        //include('../include/admin_header_tpl.php');
        include('../include/menuitem_list_tpl.php');
        break;
}

include __DIR__ . '/admin_footer.php';
