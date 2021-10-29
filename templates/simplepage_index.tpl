<div class="breadcrumb"><{$breadcrumb}></div>
<div id="simplepage">
	<table class="width100 bnone" style="padding: 0;">
		<tr>
			<td id="simplepageLeftColumn">
				<!-- menu -->
				<ul id='simplepageNav'>
					<{* $page|@debug_print_var *}>
					<{* $menuItemArray|@debug_print_var *}>
					<{foreach from=$menuItemArray item=item}>
					<{if $item.linkAttribs.link == $pageName}>
					<!-- Menu item of current page -->
					<li id="currentMenuItem"><a href="<{$item.linkAttribs.link}>" target="<{$item.linkAttribs.target}>"><{$item.linkAttribs.title}></a></li>
					<{else}>
					<!-- Menu items that are not on the current page -->
					<li class="menuitem"><a href="<{$item.linkAttribs.link}>" target="<{$item.linkAttribs.target}>"><{$item.linkAttribs.title}></a></li>
					<{/if}>
					<{/foreach}>
				</ul>
			</td>

			<td id="simplepageContent">
				<!-- title -->
				<{if $page.isDisplayTitle}>
				<h1><{$page.title}></h1>
				<{/if}>
				<!-- content -->
				<{$page.content}>
			</td>
		</tr>
	</table>
</div>