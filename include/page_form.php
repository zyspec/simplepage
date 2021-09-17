<?php
/**
 * page Form
 *
 * @copyright	xoops.com.cn
 * @author		bitshine <bitshine@gmail.com>
 * @since		1.00
 * @package		simplepage
 */
?>
<style>
.clear{
clear: both;
}
.warning{
background-color: yellow;
padding: 10px;
}
.error{
background-color: #CC3333;
padding: 10px;
}

th{
	background-color: #678FF4;
	color: #FFFFFF;
	padding: 4px;
}
.head{
	background-color: #DBE8FD;
}
.even{
	background-color: #DBE8FD;
}

/*
.form-outer th{
	background-color: #C8D6FB;
}
*/
.form-head{
	background-color: #678FF4;
	color: #FFFFFF;
	padding: 4px;
}
.form-head a{
	color: #FFFFFF;
}
.form-head a:hover{
	color: #FF9900;
}

.button{
	padding: 2px 10px;
	border: double #666666;
	background-color: #CCCCCC;
}

.form-caption{
	text-align: right;
	padding-right: 10px;
}
.form-even{
	background-color: #DBE8FD;
}
.form-odd{
	background-color: #E1E9FB;
}

.pager{
	text-align: right;
	margin: 15px;
}

#nav{
	/*float:left;*/
}
#nav li{
	display: inline;
	color: #000000;
	text-decoration: none;
	/*padding: 2px 10px;
	border:double #666666;
	width: 97px;
	height: 22px;*/
	text-align: center;
	background-color: #ececec;
	margin-left: 20px;
}
</style>
<!--header-->
<div>
<!--<img src="../assets/images/simplepage_slogo.jpg" style="float: left;" />-->
<div class="clear"></div>
</div>
<br>
<?php
//表单
require_once(XOOPS_ROOT_PATH.'/class/xoopsformloader.php');
$page_form_title = $page->isNew()? _AD_SIMPLEPAGE_ADDPAGE : _AD_SIMPLEPAGE_EDITPAGE;
$page_form = new XoopsThemeForm($page_form_title, 'pageform', $_SERVER['SCRIPT_NAME'], 'post');
$page_form->addElement(new XoopsFormHidden('op', 'save'));
$page_form->addElement(new XoopsFormHidden('pageId', $page->getVar('pageId')));
//pageName
$page_form->addElement(new XoopsFormText(_AD_SIMPLEPAGE_PAGENAME, 'pageName', 32, 64, $page->getVar('pageName')), true);
//title
$page_form->addElement(new XoopsFormText(_AD_SIMPLEPAGE_TITLE, 'title', 32, 64, $page->getVar('title')), true);
//selectEditor
//$options['editor'] = 'fckeditor'; //ezsky hack (ezskyyoung@gmail.com)
//$page_form->addElement(new XoopsFormDhtmlTextArea(_AD_SIMPLEPAGE_CONTENT, 'content', $page->getVar('content', 'e'),'','','',$options), true);
$page_form->addElement(new XoopsFormDhtmlTextArea(_AD_SIMPLEPAGE_CONTENT, 'content', $page->getVar('content', 'e'),null,null,'',null), true);

$isDisplayTitle = $page->getVar('isDisplayTitle');
$isDisplayTitle = !empty($isDisplayTitle)? $isDisplayTitle : 1; //default
$page_form->addElement(new XoopsFormRadioYN(_AD_SIMPLEPAGE_ISDISPLAYTITLE, 'isDisplayTitle', $isDisplayTitle, _YES, _NO), true);


$isPublished = $page->getVar('isPublished');
$isPublished = !empty($isPublished)? $isPublished : 1; //default
$page_form->addElement(new XoopsFormRadioYN(_AD_SIMPLEPAGE_ISPUBLISHED, 'isPublished', $isPublished, _AD_SIMPLEPAGE_PUBLISH, _AD_SIMPLEPAGE_DRAFT), true);

//提交
$buttonTray = new XoopsFormElementTray('');
$buttonTray->addElement(new XoopsFormButton('', 'submit', _SUBMIT, 'submit'));
$cancelButton = new XoopsFormButton('', 'cancel', _CANCEL, 'button');
$cancelButton->setExtra('onclick="history.go(-1);"');
$buttonTray->addElement($cancelButton);
$page_form->addElement($buttonTray);
//显示
$page_form->display('mycssclass');
