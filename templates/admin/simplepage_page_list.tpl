<style>
.warning{
	background-color: yellow;
	padding: 10px;
}
.error{
	background-color:#CC3333;
	padding: 10px;
}
.form-head{
	background-color: #678FF4;
	color:#FFFFFF;
	padding:4px;
}
.form-head a{
	color:#FFFFFF;
}
.form-head a:hover{
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
	text-align: right;
	margin: 15px;
}

#nav{
	/*float:left;*/
}
#nav li{
	display:inline;
	color:#000000;
	text-decoration:none;
	text-align:center;
	background-color:#ececec;
	margin-left:20px;
}
</style>

<!-- Send delete ID start -->
<form name="deletesel" action="<{$thisUrl}>" method="post">
<input name="pageId" type="hidden" value="">
</form>

<script>
<!--
function confirmDelete(id) {
	if (confirm('Do you confirm to delete?')) {
		document.deletesel.pageId.value = id;
		document.deletesel.submit();
		}
}
-->
</script>
<!-- Send delete ID end -->

<table class="outer width90 border center pad3" style="margin: 0">
  <tr class="form-head">
	<th><div class="center">#</div></th>
	<th><div class="center"><{$smarty.const._AD_SIMPLEPAGE_PUBLISH}></div></th>
    <th><div class="center"><{$smarty.const._AD_SIMPLEPAGE_TITLE}></div></th>
    <th><div class="center"><{$smarty.const._AD_SIMPLEPAGE_ISDISPLAYTITLE}></div></th>
    <th><div class="center"><{$smarty.const._AD_SIMPLEPAGE_PAGEIDENTIFIER}></div></th>
    <th><div class="center"><{$smarty.const._AD_SIMPLEPAGE_CREATETIME}></div></th>
    <th><div class="center"><{$smarty.const._AD_SIMPLEPAGE_LASTMODIFY}></div></th>
    <th><div class="center"><{$smarty.const._AD_SIMPLEPAGE_MODIFYUSER}></div></th>
    <th><div class="center"><{$smarty.const._AD_SIMPLEPAGE_ACTION}></div></th>
  </tr>
	<{if !empty($pagesArray)}>
	<{foreach from=$pagesArray item=page}>
		<tr class="<{cycle values="odd,even"}>">
		<td><div class="center"><{$page.pageId}></div></td>
		<td><div class="center"><img src="<{$page.isPubIcon}>"></div></td>
		<td><div class="left"><{$page.title}></div></td>
		<td><div class="center"><img src="<{$page.isDispIcon}>"></div></td>
		<td><div class="left"><{$page.pageName}></div></td>
		<td><div class="center"><{$page.created}></div></td>
		<td><div class="center"><{$page.updated}></div></td>
		<td><div class="center"><{$page.updater}></div></td>
		<td class="center">
			<a href="<{$indexUrl}>?page=<{$page.pageName}>" target="_blank"><{$smarty.const._AD_SIMPLEPAGE_FRONT}></a> |
			<a href="<{$thisUrl}>?op=edit&amp;pageId=<{$page.pageId}>"><{$smarty.const._EDIT}></a> |
			<a href="#" id="<{$page.pageId}>" onclick="confirmDelete(this.id);"><{$smarty.const._DELETE}></a>
		</td>
		</tr>
	<{/foreach}>
	<{else}>
		<tr><td colspan="9" class="even"><div class="center"><{$smarty.const._AD_SIMPLEPAGE_NOPAGE}></div></td></tr>
	<{/if}>
</table>

<div class="pager"><?php echo $pager; ?></div>