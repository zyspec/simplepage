<?php

namespace XoopsModules\Simplepage;

/**
 * Page Class Definition
 *
 * @package	 \Simplepage
 * @subpackage class
 * @copyright  xoops.com.cn
 * @author  bitshine <bitshine@gmail.com>
 */

class Page extends \XoopsObject
{
	/**
	 * constructor
	 */
	function __construct()
    {
		$this->initVar('pageName', XOBJ_DTYPE_TXTBOX, NULL, true);
		$this->initVar('pageId', XOBJ_DTYPE_INT, NULL, false);
		$this->initVar('title', XOBJ_DTYPE_TXTBOX, NULL, true);
		$this->initVar('content', XOBJ_DTYPE_TXTAREA, NULL, true);	
		$this->initVar('templateId', XOBJ_DTYPE_INT, NULL, true);
		$this->initVar('isDisplayTitle', XOBJ_DTYPE_INT, NULL, true);
		$this->initVar('commentable', XOBJ_DTYPE_INT, NULL, true);
		$this->initVar('isPublished', XOBJ_DTYPE_INT, NULL, true);
		$this->initVar('created', XOBJ_DTYPE_INT, NULL, true);
		$this->initVar('updated', XOBJ_DTYPE_INT, NULL, true);
		$this->initVar('updaterUid', XOBJ_DTYPE_INT, NULL, true);
		$this->initVar('weight', XOBJ_DTYPE_INT, NULL, true);
	}

    /**
     * Return a formatted string of when page was created
     *
     * @return string
     */
	public function created()
    {
        $retVal = '-';
		if (0 != $this->getVar('created')) {
			$retVal = formatTimeStamp($this->getVar('created'), _MEDIUMDATESTRING);
		}

        return $retVal;
	}

    /**
     * Return a formatted string of when page was last updated
     *
     * @return string
     */
	public function updated()
    {
        $retVal = '-';
		if (0 != $this->getVar('updated')) {
			return formatTimeStamp($this->getVar('updated'), _MEDIUMDATESTRING);
		}

        return $retVal;
	}

    /**
     * Get the XOOPS user's real or user name
     *
     * @param  bool  $usereal
     * @return  string
     */
	public function updater($usereal = false)
    {
		return $GLOBALS['xoopsUser']->getUnameFromId($this->getVar('updaterUid'), $usereal);
	}
}
