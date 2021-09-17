<?php

namespace XoopsModules\Simplepage;

/**
 * Class Template and TemplateHandler
 *
 * @package  \Simplepage
 * @subpackage  class
 * @copyright  xoops.com.cn
 * @author  bitshine <bitshine@gmail.com>
 */
class Template extends \XoopsObject
{
	/**
	 * construtor
	 */
	function __construct()
    {
		$this->initVar('template_id', XOBJ_DTYPE_INT, NULL, false);
		$this->initVar('title', XOBJ_DTYPE_TXTBOX, NULL, true);
		$this->initVar('content', XOBJ_DTYPE_TXTAREA, NULL, true);
		$this->initVar('updated', XOBJ_DTYPE_INT, NULL, true);
		$this->initVar('author_id', XOBJ_DTYPE_INT, NULL, true);
	}

	function render()
    {

	}
}
