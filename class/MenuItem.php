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
        $this->helper->loadLanguage('admin');
		$link = $this->getVar('link');
		if ($link != '' && !preg_match("/^http[s]*:\/\//i", $link)) {
			$ret = _AD_SIMPLEPAGE_MENUITEM_PAGE_PREFIX . '<a href="' . $this->helper->url('index.php?page=' . $link) . '" target="_blank">' . $this->getVar('link') . '</a>';
		} else {
			$ret = '<a href="' . $link . '" target="_blank" title="' . $link . '">' . xoops_substr($link, 0, 50) . "</a>";
		}
		return $ret;
	}

	public function render()
    {

	}

    /**
     * @param  \XoopsThemeForm $form  a {@see \XoopsThemeForm} object passed-by-reference
     * @return  void
     */
    public function getFormItems(&$form)
    {
        $form->addElement(new \XoopsFormHidden('op', 'save'));
        $form->addElement(new \XoopsFormHidden('menuitemId', $this->getVar('menuitemId')));

        $form->addElement(new \XoopsFormText(_AD_SIMPLEPAGE_TITLE, 'title', 32, 32, $this->getVar('title')), true);

        $linkTray = new \XoopsFormElementTray(_AD_SIMPLEPAGE_LINK);
        $linkTray->addElement(new \XoopsFormText('', 'link', 32, 255, $this->getVar('link')), true);
        $linkTray->addElement(new \XoopsFormLabel(_AD_SIMPLEPAGE_SELECTPAGE.':'));
        $pageSelector = new \XoopsFormSelect('', 'page');
        $pageSelector->setExtra('onchange="changeLink();"');

        //Get all published pages
        $criteria = new \Criteria('isPublished', 1);
        /**
         * @var  \XoopsModules\Simplepage\PageHandler  $pageHandler
         * @var  string[]  $pages
         */
        $pageHandler = \XoopsModules\Simplepage\Helper::getInstance()->getHandler('Page');
        $pages = $pageHandler->getAll($criteria, array('pageName', 'title'), false);
        foreach ($pages as $page) {
            $selection[$page['pageName']] = $page['title'];
        }

        $pageSelector->addOptionArray($selection);
        $linkTray->addElement($pageSelector);
        $form->addElement($linkTray);

        $targetSeletor = new \XoopsFormSelect(_AD_SIMPLEPAGE_TARGET,'target', $this->getVar('target'));
        $targetSeletor->addOption('_self', _AD_SIMPLEPAGE_OPENINSELF);
        $targetSeletor->addOption('_blank', _AD_SIMPLEPAGE_OPENINNEW);
        $form->addElement($targetSeletor);

        //submit
        $buttonTray = new \XoopsFormElementTray('');
        $buttonTray->addElement(new \XoopsFormButton('', 'submit', _SUBMIT, 'submit'));
        $cancelButton = new \XoopsFormButton('', 'cancel', _CANCEL, 'button');
        $cancelButton->setExtra('onclick="history.go(-1);"');
        $buttonTray->addElement($cancelButton);
        $form->addElement($buttonTray);
    }
}
