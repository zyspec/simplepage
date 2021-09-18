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

    /**
     * @param  \XoopsThemeForm $form  a {@see \XoopsThemeForm} object passed-by-reference
     * @return  void
     */
    public function getFormItems(&$form)
    {
        require_once XOOPS_ROOT_PATH . '/class/xoopsformloader.php';
        $form->addElement(new \XoopsFormHidden('op', 'save'));
        $form->addElement(new \XoopsFormHidden('pageId', $this->getVar('pageId')));
        //title
        $form->addElement(new \XoopsFormText(_AD_SIMPLEPAGE_TITLE, 'title', 32, 64, $this->getVar('title')), true);
        //pageName
        $pageName = new \XoopsFormText(_AD_SIMPLEPAGE_PAGENAME, 'pageName', 32, 64, $this->getVar('pageName'));
        $pageName->setDescription(_AD_SIMPLEPAGE_PAGENAME_DESC);
        $form->addElement($pageName, true);
        //display title or not
        $isDisplayTitle = $this->getVar('isDisplayTitle');
        $isDisplayTitle = !empty($isDisplayTitle)? $isDisplayTitle : 1; //default
        $form->addElement(new \XoopsFormRadioYN(_AD_SIMPLEPAGE_ISDISPLAYTITLE, 'isDisplayTitle', $isDisplayTitle, _YES, _NO), true);
        //selectEditor
        //$options['editor'] = 'fckeditor'; //ezsky hack (ezskyyoung@gmail.com)
        //$form->addElement(new XoopsFormDhtmlTextArea(_AD_SIMPLEPAGE_CONTENT, 'content', $this->getVar('content', 'e'),'','','',$options), true);
        $form->addElement(new \XoopsFormDhtmlTextArea(_AD_SIMPLEPAGE_CONTENT, 'content', $this->getVar('content', 'e'),25,null,'',null), true);

        //published or draft
        $isPublished = $this->getVar('isPublished');
        $isPublished = !empty($isPublished)? $isPublished : 1; //default
        $form->addElement(new \XoopsFormRadioYN(_AD_SIMPLEPAGE_ISPUBLISHED, 'isPublished', $isPublished, _AD_SIMPLEPAGE_PUBLISH, _AD_SIMPLEPAGE_DRAFT), true);

        //submit
        $buttonTray = new \XoopsFormElementTray('');
        $buttonTray->addElement(new \XoopsFormButton('', 'submit', _SUBMIT, 'submit'));
        $cancelButton = new \XoopsFormButton('', 'cancel', _CANCEL, 'button');
        $cancelButton->setExtra('onclick="history.go(-1);"');
        $buttonTray->addElement($cancelButton);
        $form->addElement($buttonTray);
    }
}
