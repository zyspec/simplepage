<?php
/**
 * 管理菜单项
 *
 * @copyright	xoops.com.cn
 * @author		bitshine <bitshine@gmail.com>
 * @since		1.00
 * @version		$Id$
 * @package		simplepage
 */

require_once('../../../include/cp_header.php');
include_once(XOOPS_ROOT_PATH."/Frameworks/art/functions.admin.php");
require_once('../include/functions.php');
require_once('../include/vars.php');
xoops_cp_header();

$op = getRequestVar('op', 'str', 'list');
switch ($op) {
	case 'add': //显示添加界面
		loadModuleAdminMenu(2);
		addeditMenuitem();
		break;
	case 'edit': //显示编辑界面
		loadModuleAdminMenu(2);
		addeditMenuitem();
		break;
	case 'save': //保存到数据库
		saveMenuitem();
		break;
	case 'confirmDelete': //显示删除警告
		confirmDelete();
		break;
	case 'delete': //从数据库删除
		deleteMenuitem();
		break;
	case 'sort': //执行排序
		sortMenuitem();
		break;
	case 'generate': //生成菜单项
		generateMenuitem();
		break;
	case 'list': //列表显示
	default:
		loadModuleAdminMenu(2);
		listMenuitem();
		break;
}

xoops_cp_footer();

/**
 * 列表显示
 *
 * 
 * @return null
 */
function listMenuitem() {
	//获取参数
	$start = getRequestVar('start', 'int', 0);
	$criteria = new Criteria(null);
	$criteria->setSort('weight');
//	$criteria->setLimit(SIMPLEPAGE_PERPAGE);
	//获取列表数据
	/* @var $menuitemHandler SimplepageMenuitemHandler */
	$menuitemHandler =& xoops_getmodulehandler('menuitem');
	$menuitems = $menuitemHandler->getAll($criteria);
//	$count = $menuitemHandler->getCount($criteria);
//	$menuitemr = getPageNav($count, SIMPLEPAGE_PERPAGE, $start, 'start');
	//显示列表
//	include('../include/admin_header_tpl.php');
	include('../include/menuitem_list_tpl.php');
}

/**
 * 显示添加/编辑界面
 *
 * @return null
 */
function addeditMenuitem($menuitem = null) {
	if ($menuitem == null) {
		//取得参数
		$menuitemId = getRequestVar('menuitemId', 'int', 0);
		//取得数据
		/* @var $menuitemHandler SimplepageMenuitemHandler */
		$menuitemHandler =& xoops_getmodulehandler('menuitem');
		$menuitem = $menuitemHandler->get($menuitemId);
	}
//	include('../include/admin_header_tpl.php');
	include('../include/menuitem_form.php');
}

/**
 * 保存到数据库
 *
 * @return null
 */
function saveMenuitem() {
//	echo __FILE__.__LINE__;debugPrint($_POST);
	$menuitemId = getRequestVar('menuitemId', 'int', 0);
	/*@var $menuitemHandler SimplepageMenuitemHandler*/
	$menuitemHandler =& xoops_getmodulehandler('menuitem');
	/*@var $menuitem SimplepageMenuitem*/
	$menuitem = $menuitemHandler->get($menuitemId);
	$menuitem->setFormVars($_POST, '');
//	$menuitem->setVar('target', )
	//排序
	if ($menuitem->isNew()) {
		$menuitem->setVar('weight', time());
	}
	//插入数据库
	if ($menuitemHandler->insert($menuitem)) {
		redirect_header($_SERVER['PHP_SELF'], 2, _AD_SIMPLEPAGE_UPDATE_DATABASE_SUCCESS);
	} else {
		echo '<div class="error">'.$menuitem->getHtmlErrors().'</div>';
		addeditMenuitem($menuitem);
	}
}

/**
 * 显示删除警告
 *
 * @return null
 */
function confirmDelete() {

}

/**
 * 从数据库删除
 *
 * @return null
 */
function deleteMenuitem() {
	$menuitemId = getRequestVar('menuitemId', 'int', null, 'Deleting object no exist.'
		, $_SERVER['PHP_SELF'].'?op=list');
	/*@var $menuitemHandler SimplepageMenuitemHandler*/
	$menuitemHandler =& xoops_getmodulehandler('menuitem');
	/*@var $menuitem SimplepageMenuitem*/
	$menuitem = $menuitemHandler->get($menuitemId);
	if (!$menuitem) {
		$message = 'Deleting object no exist.';
	} else {
		$title = $menuitem->getVar('alias');
		if ($menuitemHandler->delete($menuitem)) {
			$message = 'Delete '.$title.' success.';
		} else {
			$message = '<font color="red">Delete '.$title.' fail.</font>';
		}
	}
	redirect_header($_SERVER['PHP_SELF'].'?op=list', 3, $message);
}

/**
 * 执行排序
 *
 * @return null
 */
function sortMenuitem() {
//	echo __FILE__.__LINE__;debugPrint($_POST);
	$menuOrder = getRequestVar('menuOrder', 'str', '');
	$menuOrder = str_replace("sortable[]=", "", $menuOrder);
	$order = explode('&', $menuOrder);
//	echo __FILE__.__LINE__;debugPrint($order);
	
	//获取参数
	$criteria = new Criteria(null);
	$criteria->setSort('weight');
	
	//获取列表数据
	/* @var $menuitemHandler SimplepageMenuitemHandler */
	$menuitemHandler =& xoops_getmodulehandler('menuitem');
	$menuitems = $menuitemHandler->getObjects($criteria, true);
	
	$message = '';
	if ($menuitems) {
		$weight = $first = reset($menuitems)->getVar('weight');
		if ($weight == 0) echo __FILE__.__LINE__."0000000000000000";
		$last = end($menuitems)->getVar('weight');
		$interval = intval(($last - $first) / (count($menuitems) - 1));
		/*
		echo __FILE__.__LINE__;debugPrint(reset($menuitems));
		echo __FILE__.__LINE__;debugPrint($weight, 'weight');
		echo __FILE__.__LINE__;debugPrint($first, 'first');
		echo __FILE__.__LINE__;debugPrint($last, 'last');
		echo __FILE__.__LINE__;debugPrint($interval, 'interval');
		*/
		foreach ($order as $id) {			
			$menuitems[$id]->setVar('weight', intval($weight));
			if (!$menuitemHandler->insert($menuitems[$id])) $message .= $menuitemHandler->getErrors();
//			echo __FILE__.__LINE__;debugPrint($weight);
			$weight = $weight + $interval;
		}
	}
	redirect_header($_SERVER['PHP_SELF'], 3, $message);
}
?>