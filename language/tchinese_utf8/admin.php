<?php
/**
 * 後台語言文件
 *
 * @copyright	xoops.com.cn
 * @author		bitshine <bitshine@gmail.com>
 * @since		1.00
 * @version		$Id$
 * @package		simplepage
 */

//公用
define('_AD_SIMPLEPAGE_TITLE', '標題');
define('_AD_SIMPLEPAGE_PAGENAME', ' 頁面標識<br>英文字母數字及下劃線,各頁面不能重複');
define('_AD_SIMPLEPAGE_ISDISPLAYTITLE', '顯示標題');
define('_AD_SIMPLEPAGE_CONTENT', '頁面內容');
define('_AD_SIMPLEPAGE_ISPUBLISHED', '是否發佈');
define('_AD_SIMPLEPAGE_LINK', '鏈接');
define('_AD_SIMPLEPAGE_ACTION', '操作');
define('_AD_SIMPLEPAGE_DELETE', '刪除');
define('_AD_SIMPLEPAGE_EDIT', '編輯');
define('_AD_SIMPLEPAGE_NOPAGE', '沒有頁面');
define('_AD_SIMPLEPAGE_UPDATE_DATABASE_SUCCESS', '更新數據庫成功');
define('_AD_SIMPLEPAGE_UPDATE_DATABASE_FAIL', '<div class="error">更新數據庫成功失敗</div>');

//page.php
define('_AD_SIMPLEPAGE_PAGENAME_ALREADY_EXISTS', '<div class="error">可能頁面標識已存在，不能重複。</div>');

//page_form.php
define('_AD_SIMPLEPAGE_ADDPAGE', '添加頁面');
define('_AD_SIMPLEPAGE_EDITPAGE', '編輯頁面');
define('_AD_SIMPLEPAGE_PUBLISH', '發佈');
define('_AD_SIMPLEPAGE_DRAFT', '草稿');

//menuitem_form.php
define('_AD_SIMPLEPAGE_ADDMENUITEM', '添加菜單項');
define('_AD_SIMPLEPAGE_EDITMENUITEM', '編輯菜單項');
define('_AD_SIMPLEPAGE_SELECTPAGE', '選擇頁面');
define('_AD_SIMPLEPAGE_TARGET', '目標');
define('_AD_SIMPLEPAGE_OPENINSELF', '在原窗口打開');
define('_AD_SIMPLEPAGE_OPENINNEW', '在新窗口打開');

//menuitem_list_tpl.php
define('_AD_SIMPLEPAGE_MENUITEM', '菜單項');
define('_AD_SIMPLEPAGE_SORTTHEMENU', '菜單排序');
define('_AD_SIMPLEPAGE_DRAP_AND_DROP_THE_MENUITEM', '請拖動下面菜單項進行排序');
define('_AD_SIMPLEPAGE_SUBMITNEWORDER', '提交排序');

//page_list_tpl.php
define('_AD_SIMPLEPAGE_PAGEIDENTIFIER', '頁面標識');
define('_AD_SIMPLEPAGE_CREATETIME', '創建時間');
define('_AD_SIMPLEPAGE_LASTMODIFY', '最近更新');
define('_AD_SIMPLEPAGE_MODIFYUSER', '更新人');
define('_AD_SIMPLEPAGE_FRONT', '前台');

//admin/index.php
define('_AD_SIMPLEPAGE_NOTE', '
<h3>Simplepage 方便生成簡單的頁面</h3>
<ul>
	<li>頁面自動生成菜單和麵包屑</li>
	<li>使用在線編輯器編輯頁面</li>
	<li>菜單拖放排序</li>
	<li>通過修改 templates/simplepage_index.html 可以修改頁面的佈局</li>
	<li>通過修改 templates/simplepage.css 可以修改頁面的外觀</li>
	<li>配合 clone 模塊可以複製成不同的模塊</li>
</ul>

<p>麵包屑上顯示的模塊名稱請在語言文件 /language/{語言}/modinfo.php 中修改。</p>
');


?>