<?php
/**
 * menuitem 表单
 *
 * @copyright	xoops.com.cn
 * @author		bitshine <bitshine@gmail.com>
 * @since		1.00
 * @version		$Id$
 * @package		simplepage
 */
?>	
<style>
th{
	background-color: #678FF4;
	color:#FFFFFF;
	padding:4px;
}
.head{
	background-color: #DBE8FD;
}
.even{
	background-color: #DBE8FD;
}
</style>
<!--header-->
<div>
<!--<img src="../images/simplepage_slogo.jpg" style="float: left;" />-->
<div style="clear: both;"></div>
</div>
<br />	
<script language="javascript">
function changeLink() {
	document.getElementById("link").value = document.getElementById("page").value;
}
</script>
<?php
	require_once(XOOPS_ROOT_PATH.'/class/xoopsformloader.php');
	$menuitemFormTitle = $menuitem->isNew()? _AD_SIMPLEPAGE_ADDMENUITEM : _AD_SIMPLEPAGE_EDITMENUITEM;
	$menuitemForm = new XoopsThemeForm($menuitemFormTitle, 'pageForm', $_SERVER['PHP_SELF'], 'post');
	$menuitemForm->addElement(new XoopsFormHidden('op', 'save'));	
	$menuitemForm->addElement(new XoopsFormHidden('menuitemId', $menuitem->getVar('menuitemId')));
	
	$menuitemForm->addElement(new XoopsFormText(_AD_SIMPLEPAGE_TITLE, 'title', 32, 32, $menuitem->getVar('title')), true);
	
	$linkTray = new XoopsFormElementTray(_AD_SIMPLEPAGE_LINK);
	$linkTray->addElement(new XoopsFormText('', 'link', 32, 255, $menuitem->getVar('link')), true);	
	$linkTray->addElement(new XoopsFormLabel(_AD_SIMPLEPAGE_SELECTPAGE.':'));
	$pageSelector = new XoopsFormSelect('', 'page');
	$pageSelector->setExtra('onchange="changeLink();"');
	
	//取得所有发布的页面
	$criteria = new Criteria('isPublished', 1);
	/* @var $pageHandler SimplepagePageHandler */
	$pageHandler =& xoops_getmodulehandler('page');
	$pages = $pageHandler->getAll($criteria, array('pageName', 'title'), false);
	foreach ($pages as $page) {
		$selection[$page['pageName']] = $page['title'];
	}
	
	$pageSelector->addOptionArray($selection);
	$linkTray->addElement($pageSelector);
	$menuitemForm->addElement($linkTray);
	
	$targetSeletor = new XoopsFormSelect(_AD_SIMPLEPAGE_TARGET,'target', $menuitem->getVar('target'));
	$targetSeletor->addOption('_self', _AD_SIMPLEPAGE_OPENINSELF);
	$targetSeletor->addOption('_blank', _AD_SIMPLEPAGE_OPENINNEW);
	$menuitemForm->addElement($targetSeletor);
	
	//提交
	$buttonTray = new XoopsFormElementTray('');
	$buttonTray->addElement(new XoopsFormButton('', 'submit', _SUBMIT, 'submit'));
	$cancelButton = new XoopsFormButton('', 'cancel', _CANCEL, 'button');
	$cancelButton->setExtra('onclick="history.go(-1);"');
	$buttonTray->addElement($cancelButton);
	$menuitemForm->addElement($buttonTray);
	//显示
	$menuitemForm->display('mycssclass');
?>