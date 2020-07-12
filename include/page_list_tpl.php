<?php if (!defined('XOOPS_ROOT_PATH')) exit('Page access deny!'); ?>

<style>
.clear{
clear: both;
}
.warning{
background-color: yellow;
padding: 10px;
}
.error{
background-color:#CC3333;
padding: 10px;
}

/*
.form-outer th{
	background-color: #C8D6FB;
}
*/
.form-head{
	background-color: #678FF4;
	color:#FFFFFF;
	padding:4px;
}
.form-head a{
	color:#FFFFFF;
}
.form-head a:hoover{
	color:#FF9900;
}

.button{
	padding:2px 10px;
	border:double #666666;
	background-color:#CCCCCC;
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
	text-align:right;
	margin:15px;
}

#nav{
	/*float:left;*/
}
#nav li{
	display:inline;
	color:#000000;
	text-decoration:none;
	/*padding:2px 10px;
	border:double #666666;
	width:97px;
	height:22px;*/
	text-align:center;
	background-color:#ececec;
	margin-left:20px;
}
</style>
<!--header-->
<div>
<!--<img src="../images/simplepage_slogo.jpg" style="float: left;" />-->
<ul id="nav">
	<li><a href="page.php?op=add" class="button"><?php echo _AD_SIMPLEPAGE_ADDPAGE; ?></a> </li>
</ul>
<div style="clear: both;"></div>
</div>
<br />

<!-- 用于发送删除的ID start -->
<form name="deletesel" action="<?php echo $_SERVER['PHP_SELF'].'?op=delete'; ?>" method="post">
<input name="pageId" type="hidden" value="" />
</form>

<script language="javascript" type="text/javascript">
<!--
function confirmDelete(id) {
	if (confirm('Do you confirm to delete?')) {
		document.deletesel.pageId.value = id;
		document.deletesel.submit();
		}
}
-->
</script>
  <!-- 用于发送删除的ID end -->

<table width="90%" border="1" align="center" cellpadding="3" cellspacing="0">
  <tr class="form-head">
		<td><div align="center">#</div></td>
		<td><div align="center"><?php echo _AD_SIMPLEPAGE_PUBLISH; ?></div></td>
    <td><div align="center"><?php echo _AD_SIMPLEPAGE_TITLE; ?></div></td>
    <td><div align="center"><?php echo _AD_SIMPLEPAGE_ISDISPLAYTITLE; ?></div></td>
    <td><div align="center"><?php echo _AD_SIMPLEPAGE_PAGEIDENTIFIER; ?></div></td>
		<td><div align="center"><?php echo _AD_SIMPLEPAGE_TITLE; ?></div></td>
    <td><div align="center"><?php echo _AD_SIMPLEPAGE_CREATETIME; ?></div></td>
    <td><div align="center"><?php echo _AD_SIMPLEPAGE_LASTMODIFY; ?></div></td>		
    <td><div align="center" width="120"><?php echo _AD_SIMPLEPAGE_MODIFYUSER; ?></div></td>
  </tr>
<?php
$cssClass = 'odd';
if ($pages) {
	foreach ($pages as $page) { 
?>
	<tr class="<?php
	if ($cssClass == 'form-even') {
		$cssClass='form-odd';
	} else {
		$cssClass='form-even';
	}
	echo $cssClass;
	?>
	">
	<td><div align="center"><?php echo $page->getVar('pageId'); ?></div></td>
	<td><div align="center"><img src="../images/<?php echo $page->getVar('isPublished'); ?>.png" /></div></td>
	<td><div align="left"><?php echo $page->getVar('title'); ?></div></td>
	<td><div align="center"><img src="../images/<?php echo $page->getVar('isDisplayTitle'); ?>.png" /></div></td>
	<td><div align="left"><?php echo $page->getVar('pageName'); ?></div></td>
	<td><div align="center"><?php echo $page->created(); ?></div></td>
	<td><div align="center"><?php echo $page->updated(); ?></div></td>
	<td><div align="center"><?php echo $page->updater(); ?></div></td>
	<td align="center"><div style="width: 120px;">
		<a href="<?php echo SIMPLEPAGE_URL; ?>/index.php?page=<?php echo $page->getVar('pageName'); ?>" target="_blank"><?php echo _AD_SIMPLEPAGE_FRONT; ?></a> | 
		<a href="<?php echo $_SERVER['PHP_SELF']; ?>?op=edit&amp;pageId=<?php echo $page->getVar('pageId'); ?>"><?php echo _AD_SIMPLEPAGE_EDIT; ?></a> |
		<a href="#" id="<?php echo $page->getVar('pageId'); ?>" onclick="javascript:confirmDelete(this.id);"><?php echo _AD_SIMPLEPAGE_DELETE; ?></a>
	</div></td>
	</tr>
<?php }
}	else { ?>
	<tr><td colspan="9" class="even"><div align="center"><?php echo _AD_SIMPLEPAGE_NOPAGE; ?></div></td></tr>
<?php } ?>
</table>

<div class="pager"><?php echo $pager; ?></div>