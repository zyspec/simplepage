<?php
/**
 * Admin language file
 *
 * @copyright	xoops.com.cn
 * @author		bitshine <bitshine@gmail.com>
 * @since		1.00
 * @package		simplepage
 */

//public
define('_AD_SIMPLEPAGE_TITLE', 'Title');
define('_AD_SIMPLEPAGE_PAGENAME', 'Page shortcode');
define('_AD_SIMPLEPAGE_PAGENAME_DESC', 'English alphanumeric and underscore, page shortcuts must be unique.');
define('_AD_SIMPLEPAGE_ISDISPLAYTITLE', 'Show title');
define('_AD_SIMPLEPAGE_CONTENT', 'Page content');
define('_AD_SIMPLEPAGE_ISPUBLISHED', 'Whether to publish');
define('_AD_SIMPLEPAGE_LINK', 'Link');
define('_AD_SIMPLEPAGE_ACTION', 'Action');
define('_AD_SIMPLEPAGE_DELETE', 'delete');
define('_AD_SIMPLEPAGE_EDIT', 'edit');
define('_AD_SIMPLEPAGE_NOPAGE', 'No page');
define('_AD_SIMPLEPAGE_UPDATE_DATABASE_SUCCESS', 'Successfully updated the database');
define('_AD_SIMPLEPAGE_UPDATE_DATABASE_FAIL', '<div class="error">Failed to update the database</div>');

//Page.php
define('_AD_SIMPLEPAGE_PAGENAME_ALREADY_EXISTS', '<div class="error">The page ID already exists and cannot be repeated.</div>');

//Page::getFormItems() display
define('_AD_SIMPLEPAGE_ADDPAGE', 'Add page');
define('_AD_SIMPLEPAGE_EDITPAGE', 'Edit page');
define('_AD_SIMPLEPAGE_PUBLISH', 'Release');
define('_AD_SIMPLEPAGE_DRAFT', 'Draft');

//MenuItem::getFormItems() diesplay
define('_AD_SIMPLEPAGE_ADDMENUITEM', 'Add menu item');
define('_AD_SIMPLEPAGE_EDITMENUITEM', 'Edit menu item');
define('_AD_SIMPLEPAGE_SELECTPAGE', 'Select page');
define('_AD_SIMPLEPAGE_TARGET', 'Target');
define('_AD_SIMPLEPAGE_OPENINSELF', 'Open in the original window');
define('_AD_SIMPLEPAGE_OPENINNEW', 'Open in new window');

//admin/simplepage_menuitem_list.tpl
define('_AD_SIMPLEPAGE_MENUITEM', 'Menu Item');
define('_AD_SIMPLEPAGE_SORTTHEMENU', 'Menu sort');
define('_AD_SIMPLEPAGE_DRAP_AND_DROP_THE_MENUITEM', 'Please drag the menu items below to sort');
define('_AD_SIMPLEPAGE_SUBMITNEWORDER', 'Submit order');
define('_AD_SIMPLEPAGE_MENU_SORTED', 'Resorted menu items');

//admin/simplepage_page_list.tpl
define('_AD_SIMPLEPAGE_PAGEIDENTIFIER', 'Page ID');
define('_AD_SIMPLEPAGE_CREATETIME', 'Creation time');
define('_AD_SIMPLEPAGE_LASTMODIFY', 'Recently updated');
define('_AD_SIMPLEPAGE_MODIFYUSER', 'Author');
define('_AD_SIMPLEPAGE_FRONT', 'Frontside');

//admin/index.php
define('_AD_SIMPLEPAGE_NOTE', '
<h3>Simplepage Convenient to generate simple pages</h3>
<ul>
	<li>Menu and breadcrumbs are automatically generated on the page</li>
	<li>Edit page with online editor</li>
	<li>Menu drag and drop sort</li>
	<li>The layout of the page can be modified by modifying templates/simplepage_index.tpl </li>
	<li>Modify the appearance of the page by modification of templates/simplepage.css </li>
	<li>Cooperate clone Modules can be copied into different modules</li>
</ul>

<p>The name of the module displayed on the breadcrumbs is in the /language/{language}/modinfo.php language file.</p>
');
