<div class="breadcrumb"><{$breadcrumb}></div>
<div id="simplepage">
<table class="width100 bnone" style="border-spacing: 0px; padding: 0px;">
  <tr>
    <td id="simplepageLeftColumn">
		<!-- menu -->
		<ul id='simplepageNav'>
		<{foreach from=$menuitems item=item}>
			<{if $item->getVar('link') == $page->getVar('pageName')}>
				<!-- Menu item of current page -->
				<li id="currentMenuItem"><a href="<{$item->link()}>" target="<{$item->target()}>"><{$item->title()}></a></li>
			<{else}>
				<!-- Menu items that are not on the current page -->
				<li class="menuitem"><a href="<{$item->link()}>" target="<{$item->target()}>"><{$item->title()}></a></li>
			<{/if}>
		<{/foreach}>
		</ul>
		</td>
    
		<td id="simplepageContent">
		<!-- title -->
		<{if $page->getVar('isDisplayTitle')}>
			<h1><{$page->getVar('title')}></h1>
		<{/if}>
		<!-- content -->
		<{$page->getVar('content')}>	
		</td>
  </tr>
</table>
</div>