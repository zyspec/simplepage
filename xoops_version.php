<?php
/**
 * 模块设置
 *
 * @copyright	bitshine
 * @author		bitshine <bitshine@gmail.com>
 * @since		1.00
 * @version		$Id$
 * @package		simplepage
 */

global $modversion;

$modversion['name'] = _MI_SIMPLEPAGE_MODULENAME;
$modversion['version'] = '0.3.1';
$modversion['description'] = 'A simple page generation utility.';
$modversion['credits'] = "bitshine <bitshine@gmail.com>";
$modversion['author'] = "bitshine <bitshine@gmail.com>";
//$modversion['help'] = "simplepage_help.html";
$modversion['official'] = 0;
$modversion['image'] = "images/simplepage_slogo.jpg";
$modversion['dirname'] = "simplepage";


// Sql file
$modversion['sqlfile']['mysql'] = "sql/mysql.sql";
$modversion['tables'] = array(
	'simplepage_page',
	'simplepage_menuitem',
);

// Templates
//首页

$modversion['templates'][0] = array(
	'file' => 'simplepage_index.html',
	'description' => '');

// Main Menu
$modversion['hasMain'] = 1;

// Admin menu things
$modversion['hasAdmin'] = 1;
$modversion['adminindex'] = "admin/index.php";
$modversion['adminmenu'] = "admin/menu.php";

?>