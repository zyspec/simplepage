<?php
/**
 * breadcrumb.php
 * 面包屑类
 *
 * @copyright	The XOOPS project http://www.xoops.org/
 * @author		bitshine <bitshine@gmail.com>
 * @since		1.00
 * @version		$Id version 2007/08/07$
 * @package		module::bizcard
 */

class Breadcrumb {
	var $html;
	var $seperator;

	function Breadcrumb($seperator = ' > ') {
		$this->seperator = $seperator;
		$this->html = '<a href="'.XOOPS_URL.'" />'._YOURHOME.'</a>';
	}

	function add($caption, $url = '') {
		$this->html .= $this->seperator;
		if (isset($url) && (!empty($url))) {
			$this->html .= '<a href="'.$url.'" />'.$caption.'</a>';
		} else {
			$this->html .= $caption;
		}
	}

	function getHtml() {
		return $this->html;
	}

	function render() {
		$this->display();
	}

	function display() {
		echo $this->html;
	}
}
?>
