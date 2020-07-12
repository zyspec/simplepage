<?php
/**
 * 常用函数
 *
 * @copyright	xoops.com.cn
 * @author		bitshine <bitshine@gmail.com>
 * @since		1.00
 * @version		$Id$
 * @package		monkeyking :: investment
 */

/**
 * 添加包含目录
 *
 * @param string $path
 * @return void
 */
function addIncludePath($path) {
	ini_set('include_path',ini_get('include_path').PATH_SEPARATOR.$path);
}

/**
 * 调试用打印变量 当常量 DEBUG == TRUE 时打印变量的值
 *
 * @param  variable $var
 * @param string $caption
 * @example echo __FILE__.__LINE__;debugPrint($foo, 'foo');
 */
//定义调试开关常量,设为false时debugPrint()不显示调试信息
if (!defined('DEBUG')) define('DEBUG', true);
function debugPrint($var, $caption='DEBUG') {
	if (DEBUG) {
		echo '<b>DEBUG '.$caption.'</b>';
		echo '<pre>';
		print_r($var);
		echo"</pre>";
	}
}

/**
 * 返回$_GET\$_POST\$_COOKIE中指定的变量
 *
 * @access	public
 * @param	string	$var	 	索引名
 * @param	string	$dataType	数据类型,'int', 'str', 'array'
 * @param	mixed	$default	指定索引不存在时返回的默认值
 * @param	string	$message  	指定索引不存在时返回出错信息
 * @param	url		$jumpto	 	指定索引不存在时跳转的url
 * @return  mixed
 */

//FIXME:传递"0"时empty为true,传递null时isset为true
function getRequestVar($var, $dataType, $default=null, $message=null, $jumpto=null) {
	if (!empty($_REQUEST[$var])) {
		if (strtolower($dataType) == 'int') {
			return intval($_REQUEST[$var]);
		} elseif (strtolower($dataType) == 'str') {
			//TODO:是否需要 qoute
			return trim($_REQUEST[$var]);
		} elseif (strtolower($dataType) == 'array') {
			return $_REQUEST[$var];
		} else {
			trigger_error(__FUNCTION__.'($var, $dataType, $default=null, $message=null, $jumpto=null)
				的第二个参数的错误,请使用"int"或"str".', E_USER_ERROR);
		}
	} else {
		if (isset($default)) {
			return $default;
		} elseif (!empty($jumpto)) {
			redirect_header($jumpto, 3, $message);
		} elseif (!empty($message) && empty($jumpto)) {
			exit($message);
		} else {
			die('<p><font color="red">Parameter Error 参数错误!</font></p>');
			/*
			if (function_exists('xoops_cp_footer')) {
				xoops_cp_footer();
			} else {
				include_once(XOOPS_ROOT_PATH.'/footer.php');
			}
			exit();
			*/
		}
	}
}

/**
 * 显示分页导航
 *
 * @param int $total_items
 * @param int $items_perpage
 * @param int $current_start
 * @param int $start_name
 * @param int $extra_arg
 * @return html
 */
function getPageNav($total_items, $items_perpage, $current_start, $start_name="start", $extra_arg="") {
	require_once(XOOPS_ROOT_PATH.'/class/pagenav.php');
	$nav_handler = new XoopsPageNav($total_items, $items_perpage, $current_start, $start_name, $extra_arg);
	return $nav_handler->renderNav();
}

/**
 * createBreadcrumb()
 * 取得面包屑
 *
 * @return  breadcrumb object
 */
function createBreadcrumb() {
	if (file_exists(XOOPS_ROOT_PATH.'/class/breadcrumb.php')) {
		require_once(XOOPS_ROOT_PATH.'/class/breadcrumb.php');
	} else {
		require_once(SIMPLEPAGE_PATH.'/class/breadcrumb.php');
	}
	$breadcrumb = new Breadcrumb();
	return $breadcrumb;
}

/**
 * 载入css文件,为兼容xoops 2.0.x和2.2.x而设
 *
 * @access	public
 * @param	int		$src	css文件路径
 * @param	string	$attributes
 * @param	string	$content
 * @return  void
 */
function addCss($src, $attributes = array(), $content = "") {
	global $xTheme;
	if (empty($xTheme)) {
		require_once(XOOPS_ROOT_PATH.'/class/theme.php');
		global $xoTheme;
		$xoTheme->addStylesheet($src, $attributes, $content);
	} else {
		$xTheme->addCss($src, $attributes, $content);
	}
}

/**
 * 接收上传的文件
 *
 * @access	public
 * @param 	int		$maxSize			最大文件大小
 * @param 	string	$uploadPath			上传目录
 * @param	string	$formElementName	用于上传的表单元素的名称
 * @param 	string	$targetFileName		保存的文件名,默认为唯一ID,'original'为原来的文件名
 * @param 	array	$allowedMimeTypes	允许上传文件的MIME类型
 * @return	string 保存的文件名; array 上传失败的错误信息数组; false 没有文件上传.
 */
function uploadFile($maxSize=786432, $uploadPath, $formElementName='file', $targetFileName='',  $allowedMimeTypes='') {
	if(!empty($_FILES[$formElementName]['name'])) { //有文件上传
		//设置默认值
		if ($targetFileName == '') {
			//获取扩展名并检查
//			$temp = explode('.', $_FILES['file']['name']);
//			$ext_name = $temp[count($temp) - 1];
	    	$targetFileName = $_FILES[$formElementName]['name'];
	    }
//	    $allowedMimeTypes = array('application/x-truetype-font'); //ttf,ttc,otf
	    //实例化XoopsMediaUploader类
	    require_once(XOOPS_ROOT_PATH.'/class/uploader.php');
	    /* @var $uploader XoopsMediaUploader */
	    $uploader = new XoopsMediaUploader($uploadPath, $allowedMimeTypes, $maxSize, NULL, NULL);
	    $uploader->setTargetFileName($targetFileName);
	    //获取文件
	    if ($uploader->fetchMedia($formElementName)) {
	        if($uploader->upload()) {
	        	return $uploader->getSavedFileName();
		    } else {
		    	$errors = $uploader->getErrors();
		    	return is_array($errors)? $errors : array($errors);
		    }
	    } else {
	    	$errors = $uploader->getErrors();
		    return is_array($errors)? $errors : array($errors);
	    }
	} else {	//没有文件上传
		return false;
	}
}

/**
 * 接收上传的图片
 *
 * @access	public
 * @param 	int		$maxSize			最大文件大小
 * @param 	int		$maxWidth			最大宽度
 * @param 	int		$maxHeight			最大高度
 * @param 	string	$uploadPath			上传目录
 * @param	string	$formElementName	用于上传的表单元素的名称
 * @param 	string	$targetFileName		保存的文件名,默认为唯一ID,'original'为原来的文件名
 * @param 	array	$allowedMimeTypes	允许上传文件的MIME类型
 * @return	string 保存的文件名; array 上传失败的错误信息数组; false 没有文件上传.
 */
function uploadImage($maxSize=786432, $maxWidth=1204, $maxHeight=768, $uploadPath='', $formElementName='image', $targetFileName='',  $allowedMimeTypes='') {
	//注意,这个函数已被修改,可能不太通用

	if(!empty($_FILES[$formElementName]['name'])) { //有文件上传
		//设置默认值
		global $xoopsModule;
		if (empty($uploadPath)) {
			$uploadPath = XOOPS_ROOT_PATH.'/modules/'.$xoopsModule->dirname().'/images/';
		}
	    if (empty($targetFileName)) {
			//获取扩展名
			$temp = explode('.', $_FILES['image']['name']);
			$ext_name = $temp[count($temp) - 1];
	    	//后面不添加文件名		$targetFileName = uniqid(time()).'-'.$_FILES[$formElementName]['name'];
	    	global $xoopsUser;
	    	$targetFileName = uniqid().'.'.$ext_name;
	    } elseif ($targetFileName == 'original') {
	    	$targetFileName = $_FILES[$formElementName]['name'];
	    }
	    if (empty($allowedMimeTypes)) {
	    	$allowedMimeTypes = array('image/gif', 'image/jpeg', 'image/png', 'application/x-truetype-font'); //ttf,ttc,otf
	    }
	    //实例化XoopsMediaUploader类
	    require_once(XOOPS_ROOT_PATH.'/class/uploader.php');
	    /* @var $uploader XoopsMediaUploader */
	    $uploader = new XoopsMediaUploader($uploadPath, $allowedMimeTypes, $maxSize, $maxWidth, $maxHeight);
	    $uploader->setTargetFileName($targetFileName);
	    //获取文件
	    if ($uploader->fetchMedia($formElementName)) {
	        if($uploader->upload()) {
	        	return $uploader->getSavedFileName();
		    } else {
		    	$errors = $uploader->getErrors();
		    	return is_array($errors)? $errors : array($errors);
		    }
	    } else {
	    	$errors = $uploader->getErrors();
		    return is_array($errors)? $errors : array($errors);
	    }
	} else {	//没有文件上传
		return false;
	}
}

function EOCencode($text) {
	return str_replace('EOC', '~*E~*O~*C~*', $text);
}

function EOCdecode($text) {
	return str_replace('~*E~*O~*C~*', 'EOC', $text);
}
?>