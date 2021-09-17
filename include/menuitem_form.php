<?php
/**
 * menuitem Form
 *
 * @package		\XoopsModules\Simplepage
 * @copyright	xoops.com.cn
 * @author		bitshine <bitshine@gmail.com>
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
<!--<img src="../assets/images/simplepage_slogo.jpg" style="float: left;" />-->
<div class="clear"></div>
</div>
<br />	
<script>
function changeLink() {
	document.getElementById("link").value = document.getElementById("page").value;
}
</script>
<?php
	require_once(XOOPS_ROOT_PATH.'/class/xoopsformloader.php');
    /**
     * @var \XoopsModules\Simplepage\Helper $helper
     * @var \XoopsModules\Simplepage\MenuItem $menuitem
     */
	$menuitemFormTitle = $menuitem->isNew()? _AD_SIMPLEPAGE_ADDMENUITEM : _AD_SIMPLEPAGE_EDITMENUITEM;
	$menuitemForm = new \XoopsThemeForm($menuitemFormTitle, 'pageForm', $_SERVER['SCRIPT_NAME'], 'post');
	$menuitemForm->addElement(new \XoopsFormHidden('op', 'save'));
	$menuitemForm->addElement(new \XoopsFormHidden('menuitemId', $menuitem->getVar('menuitemId')));
	
	$menuitemForm->addElement(new \XoopsFormText(_AD_SIMPLEPAGE_TITLE, 'title', 32, 32, $menuitem->getVar('title')), true);
	
	$linkTray = new \XoopsFormElementTray(_AD_SIMPLEPAGE_LINK);
	$linkTray->addElement(new \XoopsFormText('', 'link', 32, 255, $menuitem->getVar('link')), true);
	$linkTray->addElement(new \XoopsFormLabel(_AD_SIMPLEPAGE_SELECTPAGE.':'));
	$pageSelector = new \XoopsFormSelect('', 'page');
	$pageSelector->setExtra('onchange="changeLink();"');
	
	//Get all published pages
	$criteria = new \Criteria('isPublished', 1);
	/* @var $pageHandler SimplepagePageHandler */
	$pageHandler = $helper->getHandler('Page');
	$pages = $pageHandler->getAll($criteria, array('pageName', 'title'), false);
	foreach ($pages as $page) {
		$selection[$page['pageName']] = $page['title'];
	}
	
	$pageSelector->addOptionArray($selection);
	$linkTray->addElement($pageSelector);
	$menuitemForm->addElement($linkTray);
	
	$targetSeletor = new \XoopsFormSelect(_AD_SIMPLEPAGE_TARGET,'target', $menuitem->getVar('target'));
	$targetSeletor->addOption('_self', _AD_SIMPLEPAGE_OPENINSELF);
	$targetSeletor->addOption('_blank', _AD_SIMPLEPAGE_OPENINNEW);
	$menuitemForm->addElement($targetSeletor);
	
	//submit
	$buttonTray = new \XoopsFormElementTray('');
	$buttonTray->addElement(new \XoopsFormButton('', 'submit', _SUBMIT, 'submit'));
	$cancelButton = new \XoopsFormButton('', 'cancel', _CANCEL, 'button');
	$cancelButton->setExtra('onclick="history.go(-1);"');
	$buttonTray->addElement($cancelButton);
	$menuitemForm->addElement($buttonTray);
	//show
	$menuitemForm->display('mycssclass');
