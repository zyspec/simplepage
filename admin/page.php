<?php
/**
 * 管理页面
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
		loadModuleAdminMenu(1);
		addeditPage();
		break;
	case 'edit': //显示编辑界面
		loadModuleAdminMenu(1);
		addeditPage();
		break;
	case 'save': //保存到数据库
		savePage();
		break;
	case 'confirmDelete': //显示删除警告
		confirmDelete();
		break;
	case 'delete': //从数据库删除
		deletePage();
		break;
	case 'sort': //执行排序
		sortPage();
		break;
	case 'generate': //生成页面
		generatePage();
		break;
	case 'list': //列表显示
	default:
		loadModuleAdminMenu(1);
		listPage();
		break;
}

xoops_cp_footer();

/**
 * 列表显示
 *
 * @return null
 */
function listPage() {
	//获取参数
	$start = getRequestVar('start', 'int', 0);
	$criteria = new Criteria(null);
	$criteria->setLimit(SIMPLEPAGE_PERPAGE);
	//获取列表数据
	/* @var $pageHandler SimplepagePageHandler */
	$pageHandler =& xoops_getmodulehandler('page');
	$pages = $pageHandler->getAll($criteria);
	$count = $pageHandler->getCount($criteria);
	$pager = getPageNav($count, SIMPLEPAGE_PERPAGE, $start, 'start');
	//显示列表
//	include('../include/admin_header_tpl.php');
	include('../include/page_list_tpl.php');
}

/**
 * 显示添加/编辑界面
 *
 * @return null
 */
function addeditPage($page = null) {
	if ($page == null) {
		//取得参数
		$pageId = getRequestVar('pageId', 'int', 0);
		//取得数据
		/* @var $pageHandler SimplepagePageHandler */
		$pageHandler =& xoops_getmodulehandler('page');
		$page = $pageHandler->get($pageId);
	}
//	include('../include/admin_header_tpl.php');
	include('../include/page_form.php');
}

/**
 * 保存到数据库
 *
 * @return null
 */
function savePage() {
	$pageId = getRequestVar('pageId', 'int', 0);
	/*@var $pageHandler SimplepagePageHandler*/
	$pageHandler =& xoops_getmodulehandler('page');
	/*@var $page SimplepagePage*/
	$page = $pageHandler->get($pageId);
	$page->setFormVars($_POST, '');
	$myts = new MyTextSanitizer();
//	$page->setVar('content', $myts->htmlSpecialChars($myts->stripSlashesGPC($_POST['content'])));
	$page->setVar('content', $_POST['content']);
	$page->setVar('pageName', str_replace(' ', '', $page->getVar('pageName')));
	//Todo：检查字符
	//时间与排序
	$time = time();
	if ($page->isNew()) {
		$page->setVar('created', $time);
		$page->setVar('updated', 0);
		$page->setVar('weight', $time);
	} else {
		$page->setVar('updated', $time);
	}
	//更新者
	global $xoopsUser;
	$page->setVar('updaterUid', $xoopsUser->uid());	
	//插入数据库
	if ($pageHandler->insert($page)) {
		redirect_header($_SERVER['PHP_SELF'], 2, _AD_SIMPLEPAGE_UPDATE_DATABASE_SUCCESS);
	} else {
		echo _AD_SIMPLEPAGE_UPDATE_DATABASE_FAIL._AD_SIMPLEPAGE_PAGENAME_ALREADY_EXISTS;
//		echo '<div class="error">'.$page->getHtmlErrors().'</div>';
		addeditPage($page);
	}
}

/**
 * 从数据库删除
 *
 * @return null
 */
function deletePage() {
	$pageId = getRequestVar('pageId', 'int', null, 'Deleting object no exist.'
		, $_SERVER['PHP_SELF'].'?op=list');
	/*@var $pageHandler SimplepagePageHandler*/
	$pageHandler =& xoops_getmodulehandler('page');
	/*@var $page SimplepagePage*/
	$page = $pageHandler->get($pageId);
	if (!$page) {
		$message = 'Deleting object no exist.';
	} else {
		$title = $page->getVar('alias');
		if ($pageHandler->delete($page)) {
			$message = 'Delete '.$title.' success.';
		} else {
			$message = '<font color="red">Delete '.$title.' fail.</font>';
		}
	}
	redirect_header($_SERVER['PHP_SELF'].'?op=list', 3, $message);
}
?>