<?php
/**
 * 后台语言文件
 *
 * @copyright	xoops.com.cn
 * @author		bitshine <bitshine@gmail.com>
 * @since		1.00
 * @version		$Id$
 * @package		simplepage
 */

//公用
define('_AD_SIMPLEPAGE_TITLE', '标题');
define('_AD_SIMPLEPAGE_PAGENAME', ' 页面标识<br>英文字母数字及下划线,各页面不能重复');
define('_AD_SIMPLEPAGE_ISDISPLAYTITLE', '显示标题');
define('_AD_SIMPLEPAGE_CONTENT', '页面内容');
define('_AD_SIMPLEPAGE_ISPUBLISHED', '是否发布');
define('_AD_SIMPLEPAGE_LINK', '链接');
define('_AD_SIMPLEPAGE_ACTION', '操作');
define('_AD_SIMPLEPAGE_DELETE', '删除');
define('_AD_SIMPLEPAGE_EDIT', '编辑');
define('_AD_SIMPLEPAGE_NOPAGE', '没有页面');
define('_AD_SIMPLEPAGE_UPDATE_DATABASE_SUCCESS', '更新数据库成功');
define('_AD_SIMPLEPAGE_UPDATE_DATABASE_FAIL', '<div class="error">更新数据库成功失败</div>');

//page.php
define('_AD_SIMPLEPAGE_PAGENAME_ALREADY_EXISTS', '<div class="error">可能页面标识已存在，不能重复。</div>');

//page_form.php
define('_AD_SIMPLEPAGE_ADDPAGE', '添加页面');
define('_AD_SIMPLEPAGE_EDITPAGE', '编辑页面');
define('_AD_SIMPLEPAGE_PUBLISH', '发布');
define('_AD_SIMPLEPAGE_DRAFT', '草稿');

//menuitem_form.php
define('_AD_SIMPLEPAGE_ADDMENUITEM', '添加菜单项');
define('_AD_SIMPLEPAGE_EDITMENUITEM', '编辑菜单项');
define('_AD_SIMPLEPAGE_SELECTPAGE', '选择页面');
define('_AD_SIMPLEPAGE_TARGET', '目标');
define('_AD_SIMPLEPAGE_OPENINSELF', '在原窗口打开');
define('_AD_SIMPLEPAGE_OPENINNEW', '在新窗口打开');

//menuitem_list_tpl.php
define('_AD_SIMPLEPAGE_MENUITEM', '菜单项');
define('_AD_SIMPLEPAGE_SORTTHEMENU', '菜单排序');
define('_AD_SIMPLEPAGE_DRAP_AND_DROP_THE_MENUITEM', '请拖动下面菜单项进行排序');
define('_AD_SIMPLEPAGE_SUBMITNEWORDER', '提交排序');

//page_list_tpl.php
define('_AD_SIMPLEPAGE_PAGEIDENTIFIER', '页面标识');
define('_AD_SIMPLEPAGE_CREATETIME', '创建时间');
define('_AD_SIMPLEPAGE_LASTMODIFY', '最近更新');
define('_AD_SIMPLEPAGE_MODIFYUSER', '更新人');
define('_AD_SIMPLEPAGE_FRONT', '前台');

//admin/index.php
define('_AD_SIMPLEPAGE_NOTE', '
<h3>Simplepage 方便生成简单的页面</h3>
<ul>
	<li>页面自动生成菜单和面包屑</li>
	<li>使用在线编辑器编辑页面</li>
	<li>菜单拖放排序</li>
	<li>通过修改 templates/simplepage_index.html 可以修改页面的布局</li>
	<li>通过修改 templates/simplepage.css 可以修改页面的外观</li>
	<li>配合 clone 模块可以复制成不同的模块</li>
</ul>

<p>面包屑上显示的模块名称请在语言文件 /language/{语言}/modinfo.php 中修改。</p>
');
