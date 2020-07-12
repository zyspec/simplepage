<?php
/**
 * 定义常用的变量和常量
 *
 * @copyright	xoops.com.cn
 * @author		bitshine <bitshine@gmail.com>
 * @since		1.00
 * @version		$Id$
 * @package		simplepage
 */

if(!defined("SIMPLEPAGEMENT_VARS")):
define("SIMPLEPAGEMENT_VARS", 1);

//路径
define('SIMPLEPAGE_PATH', XOOPS_ROOT_PATH.'/modules/simplepage');
define('SIMPLEPAGE_UPLOAD_PATH', XOOPS_ROOT_PATH.'/uploads/simplepage');
//url
define('SIMPLEPAGE_URL', XOOPS_URL.'/modules/simplepage');
define('SIMPLEPAGE_UPLOAD_URL', XOOPS_URL.'/uploads/simplepage');

//
define('SIMPLEPAGE_PERPAGE', 20); //每页列表数量

//图片
define('SIMPLEPAGE_THUMB_WIDTH', 80); //缩略图宽度
define('SIMPLEPAGE_THUMB_HEIGHT', 50); //缩略图高度
define('SIMPLEPAGE_IMAGE_SIZE', 800000); //图片文件的大小，单位字节
define('SIMPLEPAGE_IMAGE_WIDTH', 800); //图片的宽度，单位象素
define('SIMPLEPAGE_IMAGE_HEIGHT', 800); //图片的高度，单位象素
endif;

?>