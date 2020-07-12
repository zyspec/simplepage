<?php
/**
 * Class Menuitem and MenuitemHandler
 *
 * @copyright	xoops.com.cn
 * @author		bitshine <bitshine@gmail.com>
 * @since		1.00
 * @version		$Id$
 * @package		simplepage
 * @subpackage
 */

defined('FRAMEWORKS_ART_FUNCTIONS_INI') || require(XOOPS_ROOT_PATH.'/Frameworks/art/functions.ini.php');
load_object();

Class SimplepageMenuitem extends ArtObject {

	/**
	 * construtor
	 */
	function SimplepageMenuitem() {
		$this->artObject();
		$this->initVar('menuitemId', XOBJ_DTYPE_INT, NULL, false);
		$this->initVar('title', XOBJ_DTYPE_TXTBOX, NULL, true);
		$this->initVar('link', XOBJ_DTYPE_TXTBOX, NULL, true);
		$this->initVar('target', XOBJ_DTYPE_TXTBOX, NULL, true);
		$this->initVar('templateId', XOBJ_DTYPE_INT, NULL, true);
		$this->initVar('weight', XOBJ_DTYPE_INT, NULL, true);
	}
	
	function link() {
		$link = $this->getVar('link');
		if ($link != '' && !preg_match("/^http[s]*:\/\//i", $link)) {
			$link = SIMPLEPAGE_URL.'/index.php?page='.$link;
		}
		return $link;
	}
	
	function target() {
		return $this->getVar('target');
	}
	
	
	function title() {
		return $this->getVar('title');
	} 
	
	function getAdminLink() {		
		$link = $this->getVar('link');
		if ($link != '' && !preg_match("/^http[s]*:\/\//i", $link)) {
			$ret = '页面：<a href="'.SIMPLEPAGE_URL.'/index.php?page='.$link.'" target="_blank">'.$this->getVar('link').'</a>';
		} else {
			$ret = '<a href="'.$link.'" target="_blank" title="'.$link.'">'.xoops_substr($link, 0, 50)."</a>";
		}
		return $ret;
	}

	function render() {
	}
}

Class SimplepageMenuitemHandler extends ArtObjectHandler {

	/**
	 * constructor
	 *
	 * @param object $db
	 * @return SimplepageMenuitemHandler
	 */
	function SimplepageMenuitemHandler(&$db) {
		$this->ArtObjectHandler($db, 'simplepage_menuitem', 'SimplepageMenuitem', 'menuitemId', 'title');
	}
}
?>