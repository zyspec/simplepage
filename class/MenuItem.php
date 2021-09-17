<?php

namespace XoopsModules\Simplepage;

use \XoopsModules\Simplepage\Helper;
/**
 * Class Menuitem and MenuitemHandler
 *
 * @package  \XoopsModules\Simplepage
 * @subpackage  class
 * @copyright  xoops.com.cn
 * @author  bitshine <bitshine@gmail.com>
 */
class MenuItem extends \XoopsObject
{
    private $helper;
	/**
	 * construtor
	 */
	function __construct()
    {
		$this->initVar('menuitemId', XOBJ_DTYPE_INT, NULL, false);
		$this->initVar('title', XOBJ_DTYPE_TXTBOX, NULL, true);
		$this->initVar('link', XOBJ_DTYPE_TXTBOX, NULL, true);
		$this->initVar('target', XOBJ_DTYPE_TXTBOX, NULL, true);
		$this->initVar('templateId', XOBJ_DTYPE_INT, NULL, true);
		$this->initVar('weight', XOBJ_DTYPE_INT, NULL, true);

        $this->helper = Helper::getInstance();
	}
	
	public function link()
    {
		$link = $this->getVar('link');
		if ('' != $link && !preg_match("/^http[s]*:\/\//i", $link)) {
			$link = $this->helper->url('index.php?page=' . $link);
		}
		return $link;
	}
	
	public function target()
    {
		return $this->getVar('target');
	}
	
	
	public function title()
    {
		return $this->getVar('title');
	} 
	
	public function getAdminLink()
    {
		$link = $this->getVar('link');
		if ($link != '' && !preg_match("/^http[s]*:\/\//i", $link)) {
			$ret = 'Page：<a href="' . $this->helper->url('index.php?page=' . $link) . '" target="_blank">' . $this->getVar('link') . '</a>';
		} else {
			$ret = '<a href="' . $link . '" target="_blank" title="' . $link . '">' . xoops_substr($link, 0, 50) . "</a>";
		}
		return $ret;
	}

	public function render()
    {

	}
}
