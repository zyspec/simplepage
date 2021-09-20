<link rel="stylesheet" src="../assets/css/simplepage_admin.css"></link>

<!-- Send delete ID start -->
<form name="deletesel" action="<{$thisUrl}>" method="post">
<input name="op" type="hidden" value="delete">
<input name="myId" type="hidden" value="">
</form>

<{*
<script>
<!--
function confirmDelete(id) {
	if (confirm('Do you confirm to delete?')) {
		document.deletesel.myId.value = id;
		document.deletesel.submit();
		}
}
-->
</script>
*}>
<!-- Send delete ID end -->

<table class="outer width90 border center pad3" style="margin: 0">
  <thead>
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
  </thead>
	<{if !empty($pagesArray)}>
	<tbody>
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
	</tbody>
</table>

<div class="pager"><{$pager}></div>
<script src="../assets/js/simplepage_admin.js"></script>
