<?php
/**
 * Commonly used functions
 *
 * @copyright	xoops.com.cn
 * @author		bitshine <bitshine@gmail.com>
 * @since		1.00
 * @package		monkeyking :: investment
 */

use \XoopsModules\Simplepage\Constants;

/**
 * Receive uploaded files
 *
 * @param  null|int  $maxSize  Maximum file size
 * @param  string  $uploadPath  Upload path
 * @param  null|string  $formElementName  The name of the form element used for upload
 * @param  null|string  $targetFileName  The saved file name, the default is only一ID,'original' Is the original file name
 * @param  null|array  $allowedMimeTypes  MIME types of files allowed to be uploaded
 * @return  string|array  Saved file name; Error message array for upload failure; false No files uploaded.
 */
function uploadFile($maxSize = Constants::DEFAULT_FILE_SIZE, $uploadPath, $formElementName='file', $targetFileName = '',  $allowedMimeTypes = []) {
	if(!empty($_FILES[$formElementName]['name'])) { //File upload
		//Set default value
		if ($targetFileName == '') {
			//Get the extension and check
//			$temp = explode('.', $_FILES['file']['name']);
//			$ext_name = $temp[count($temp) - 1];
	    	$targetFileName = $_FILES[$formElementName]['name'];
	    }
//	    $allowedMimeTypes = array('application/x-truetype-font'); //ttf,ttc,otf
	    //Instantiate XoopsMediaUploader
	    require_once XOOPS_ROOT_PATH . '/class/uploader.php';
	    /* @var  \XoopsMediaUploader  $uploader */
	    $uploader = new \XoopsMediaUploader($uploadPath, $allowedMimeTypes, $maxSize, NULL, NULL);
	    $uploader->setTargetFileName($targetFileName);
	    //Get files
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
	} else {	//No files uploaded
		return false;
	}
}

/**
 * Receive uploaded pictures
 *
 * @param  null|int  $maxSize  Maximum file size
 * @param  null|int  $maxWidth  Maximum width
 * @param  null|int  $maxHeight  maximum height
 * @param  null|string  $uploadPath  Upload path
 * @param  null|string  $formElementName  The name of the form element used for upload
 * @param  null|string  $targetFileName  The saved file name, the default is only一ID,'original' Is the original file name
 * @param  null|array  $allowedMimeTypes  Allow file upload MIME type
 * @return  bool|string|array  Saved file name; array Error message array for upload failure; false No files uploaded.
 */
function uploadImage(
    $maxSize          = Constants::DEFAULT_FILE_SIZE,
    $maxWidth         = Constants::DEFAULT_IMAGE_WIDTH,
    $maxHeight        = Constants::DEFAULT_IMAGE_HEIGHT,
    $uploadPath       = '',
    $formElementName  = 'image',
    $targetFileName   = '',
    $allowedMimeTypes = [])
{
	//Note that this function has been modified and may not be universal

	if(!empty($_FILES[$formElementName]['name'])) { //File upload
		//Set default value
		if (empty($uploadPath)) {
			$uploadPath = XOOPS_ROOT_PATH . '/modules/' . $GLOBALS['xoopsModule']->dirname() . '/images/';
		}
	    if (empty($targetFileName)) {
			//Get extension
			$temp = explode('.', $_FILES['image']['name']);
			$ext_name = $temp[count($temp) - 1];
	    	//Do not add file name at the end		$targetFileName = uniqid(time()).'-'.$_FILES[$formElementName]['name'];
	    	$targetFileName = uniqid().'.'.$ext_name;
	    } elseif ($targetFileName == 'original') {
	    	$targetFileName = $_FILES[$formElementName]['name'];
	    }
	    if (empty($allowedMimeTypes)) {
	    	$allowedMimeTypes = array('image/gif', 'image/jpeg', 'image/png', 'image/webp'); //ttf,ttc,otf
	    }
	    //Instantiate XoopsMediaUploader
	    require_once XOOPS_ROOT_PATH . '/class/uploader.php';
	    /** @var  \XoopsMediaUploader  $uploader */
	    $uploader = new \XoopsMediaUploader($uploadPath, $allowedMimeTypes, $maxSize, $maxWidth, $maxHeight);
	    $uploader->setTargetFileName($targetFileName);
	    //Get files
	    if ($uploader->fetchMedia($formElementName)) {
	        if($uploader->upload()) {
	        	return $uploader->getSavedFileName();
		    } else {
		    	$errors = $uploader->getErrors();
		    	return is_array($errors) ? $errors : array($errors);
		    }
	    } else {
	    	$errors = $uploader->getErrors();
		    return is_array($errors) ? $errors : array($errors);
	    }
	} else {	//No files uploaded
		return false;
	}
}

function EOCencode($text) {
	return str_replace('EOC', '~*E~*O~*C~*', $text);
}

function EOCdecode($text) {
	return str_replace('~*E~*O~*C~*', 'EOC', $text);
}
