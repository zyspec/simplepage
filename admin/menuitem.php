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
    Helper,
    Utility
};

/**
 * @var Xmf\Module\Admin $adminObject
 * @var XoopsModules\Simplepage\Helper $helper
 * @var string $moduleDirName
 * @var string $moduleDirNameUpper
 * @var string[] $icons;
 */
require_once __DIR__ . '/admin_header.php';
//require_once dirname(__DIR__) . '/include/functions.php';

xoops_cp_header();

$adminObject->displayNavigation(basename(__FILE__));

$op = Request::getCmd('op', 'list');
switch ($op) {
	case 'add': //Show add interface
	case 'edit': //Show editing interface
        $adminObject->addItemButton(_AD_SIMPLEPAGE_ADDMENUITEM, 'menuitem.php?op=add', 'add');
        $adminObject->displayButton('left');
        $menuitemId = Request::getInt('myId', 0);
        //Get data
        /** @var  $menuItemHandler  \XoopsModules\Simplepage\MenuItemHandler */
        $menuItemHandler = $helper->getHandler('MenuItem');
        $menuitem        = $menuItemHandler->get($menuitemId);
        // add the javascript
        $GLOBALS['xoTheme']->addScript('', [], '
            function changeLink() {
	            document.getElementById("link").value = document.getElementById("page").value;
            }
        ');
        require_once XOOPS_ROOT_PATH . '/class/xoopsformloader.php';
        $formTitle = $menuitem->isNew()? _AD_SIMPLEPAGE_ADDMENUITEM : _AD_SIMPLEPAGE_EDITMENUITEM;
        $form = new \XoopsThemeForm($formTitle, 'menuitemForm', $_SERVER['SCRIPT_NAME'], 'post');
        $menuitem->getFormItems($form);
        $form->display();
        //echo "<!--\n"
        //    . "<script>\n"
        //   . "function changeLink() {\n"
	    //   . "    document.getElementById(\"link\").value = document.getElementById(\"page\").value;\n"
        //   . "}\n"
        //   . "</script>\n"
        //   . "-->\n";
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
        if (!Request::hasVar('myId')) {
            redirect_header($_SERVER['SCRIPT_NAME'].'?op=list', Constants::REDIRECT_DELAY_MEDIUM, 'Deleting object no exist.');
        }
        /** @var Helper $helper */
        $helper = Helper::getInstance();
        $menuitemId = Request::getInt('myId', null);
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
        $order = explode(',', $menuOrder);

        //Get parameters
        $criteria = new \Criteria('', '');
        $criteria->setSort('weight');

        //Get list data
        /** @var $menuItemHandler XoopsModules\Simplepage\MenuItemHandler */
        $menuItemHandler = $helper->getHandler('MenuItem');
        $menuitems       = $menuItemHandler->getObjects($criteria, true);

        $message = _AD_SIMPLEPAGE_MENU_SORTED;
        if ($menuitems) {
            $weight = $first = reset($menuitems)->getVar('weight');
            if (0 == $weight) echo __FILE__.__LINE__."0000000000000000";
            $last = end($menuitems)->getVar('weight');
            $interval = intval(($last - $first) / (count($menuitems) - 1));
            foreach ($order as $id) {
                $menuitems[$id]->setVar('weight', intval($weight));
                if (!$menuItemHandler->insert($menuitems[$id])) $message .= $menuItemHandler->getErrors();
                //\Xmf\Debug::dump($weight);
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
        $perPage = $helper->getConfig('perpage', Constants::DEFAULT_PER_PAGE);
		//listMenuitem();
        $adminObject->addItemButton(_AD_SIMPLEPAGE_ADDMENUITEM, 'menuitem.php?op=add', 'add');
        $adminObject->displayButton('left');

        $start    = Request::getInt('start', 0);
        $criteria = new Criteria('', '');
        $criteria->setSort('weight');
        //Get list data
        /** @var  $menuItemHandler  \XoopsModules\Simplepage\MenuItemHandler */
        $menuItemHandler = $helper->getHandler('MenuItem');
        $menuitems       = $menuItemHandler->getAll($criteria);
        $count           = is_countable($menuitems) ? count($menuitems) : 0;
        $pager           = Utility::getPageNav($count, $perPage, $start, 'start');
        $menuitems       = array_slice($menuitems, $start, $perPage, true);
        //Show list
        $itemsArray = [];
        /** @var \XoopsModules\Simplepage\MenuItem $item */
        foreach ($menuitems as $item) {
            $itemArray = $item->getValues();
            $itemArray['adminLink'] = $item->getAdminLink();
            $itemsArray[] = $itemArray;
        }
        $GLOBALS['xoopsTpl']->assign([
            'thisUrl'    => $_SERVER['SCRIPT_NAME'],
            'indexUrl'   => $helper->url('index.php'),
            'itemsArray' => $itemsArray,
            'pager'      => $pager
        ]);
        $GLOBALS['xoTheme']->addStylesheet($helper->url('assets/css/simplepage_admin.css'));
        echo $GLOBALS['xoopsTpl']->fetch($helper->path('templates/admin/simplepage_menuitem_list.tpl'));
        break;
}

include __DIR__ . '/admin_footer.php';
