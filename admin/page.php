<?php
/**
 * Management page
 *
 * @package  \XoopsModules\Simplepage
 * @subpackage  admin
 * @copyright  xoops.com.cn
 * @copyright  &copy; 2000-2021 {@link https://xoops.org XOOPS Project}
 * @author  bitshine <bitshine@gmail.com>
 * @author  XOOPS Modules Developement Team
 */

use \Xmf\Request;
use \XoopsModules\Simplepage\{
    Constants,
    Helper,
    Utility
};

/**
 * @var Xmf\Module\Admin $adminObject
 * @var XoopsModules\Simplepage\Helper $helper
 * @var string $moduleDirName
 * @var string $moduleDirNameUpper
 * @var string[] $icons;
 */
require_once __DIR__ . '/admin_header.php';
xoops_cp_header();

$adminObject->displayNavigation(basename(__FILE__));

$op = Request::getCmd('op', 'list');
switch ($op) {
	case 'add': //Show add interface
    case 'edit'://Show editing interface
        $adminObject->addItemButton(_AD_SIMPLEPAGE_ADDPAGE, 'page.php?op=add', 'add');
        $adminObject->displayButton('left');

        /**
         * @var  \XoopsModules\Simplepage\PageHandler $pageHandler
         * @var  \XoopsModules\Simplepage\Page $page
         */
        $pageHandler = $helper->getHandler('Page');
        $pageId      = Request::getInt('pageId',0);
        $page        = $pageHandler->get($pageId);

        require_once XOOPS_ROOT_PATH . '/class/xoopsformloader.php';
        $formTitle = $page->isNew() ? _AD_SIMPLEPAGE_ADDPAGE : _AD_SIMPLEPAGE_EDITPAGE;
        $form      = new \XoopsThemeForm($formTitle, 'pageform', $_SERVER['SCRIPT_NAME'], 'post');
        $page->getFormItems($form);
        $form->display();
		break;
	case 'save': //Save to database
        /**
         * @var  \XoopsModules\Simplepage\PageHandler  $pageHandler
         * @var  \XoopsModules\Simplepage\Page  $page
         */
        $pageHandler = $helper->getHandler('Page');
        $pageId      = Request::getInt('pageId', 0);
        $page        = $pageHandler->get($pageId);
        $page->setVar('content', Request::getText('content', '', 'POST'));
        $page->setVar('pageName', str_replace(' ', '', $page->getVar('pageName')));

        //Time and order
        $time = time();
        if ($page->isNew()) {
            $page->setVar('created', $time);
            $page->setVar('updated', 0);
            $page->setVar('weight', $time);
        } else {
            $page->setVar('updated', $time);
        }
        //updater
        $page->setVar('updaterUid', $GLOBALS['xoopsUser']->uid());
        //Insert into the database
        if ($pageHandler->insert($page)) {
            redirect_header($_SERVER['SCRIPT_NAME'], Constants::REDIRECT_DELAY_MEDIUM, _AD_SIMPLEPAGE_UPDATE_DATABASE_SUCCESS);
        } else {
            redirect_header($_SERVER['SCRIPT_NAME'] . '?op=add&menuitemId=' . $pageId, Constants::REDIRECT_DELAY_MEDIUM, '<div class="error">' . _AD_SIMPLEPAGE_UPDATE_DATABASE_FAIL . _AD_SIMPLEPAGE_PAGENAME_ALREADY_EXISTS . '</div>');
        }
        break;
	case 'confirmDelete': //Show delete warning
		//confirmDelete();
		break;
	case 'delete': //Delete from database
        if (!Request::hasVar('myId')) {
            redirect_header($_SERVER['SCRIPT_NAME'].'?op=list', Constants::REDIRECT_DELAY_MEDIUM, _AD_SIMPLEPAGE_PAGE_NOT_EXIST);
        }
        $pageId = Request::getInt('myId', null);
        /**
         * @var  \XoopsModules\Simplepage\PageHandler $pageHandler
         * @var  \XoopsModules\Simplepage\Page $page
         */
        $pageHandler = $helper->getHandler('Page');
        $page        = $pageHandler->get($pageId);
        if (!$page) {
            $message = _AD_SIMPLEPAGE_PAGE_NOT_EXIST;
        } else {
            $title = $page->getVar('alias');
            if ($pageHandler->delete($page)) {
                $message = sprintf(_AD_SIMPLEPAGE_DELETE_PAGE_SUCCESS, $title);
            } else {
                $message = '<span class="red">' . sprintf(_AD_SIMPLEPAGE_DELETE_PAGE_FAIL, $title) . '</span>';
            }
        }
        redirect_header($_SERVER['SCRIPT_NAME'].'?op=list', Constants::REDIRECT_DELAY_MEDIUM, $message);
        break;
	case 'sort': //Perform sorting
		//sortPage();
		break;
	case 'generate': //Generate page
		//generatePage();
		break;
	case 'list': //List display
	default:
        $perPage = $helper->getConfig('perpage', Constants::DEFAULT_PER_PAGE);
        $adminObject->addItemButton(_AD_SIMPLEPAGE_ADDPAGE, 'page.php?op=add', 'add');
        $adminObject->displayButton('left');
        //Get parameters
        $start    = Request::getInt('start', 0);
        $criteria = new Criteria(null);
        $criteria->setLimit($perPage);
        //Get list data
        /**
         * @var  \XoopsModules\Simplepage\PageHandler  $pageHandler
         * @var  \XoopsModules\Simplepage\Page[]  $pages
         */
        $pageHandler = $helper->getHandler('Page');
        $pages       = $pageHandler->getAll($criteria);
        $count       = $pageHandler->getCount($criteria);
        $pager       = Utility::getPageNav($count, $perPage, $start, 'start');
        //Show list
        $pagesArray = [];
        /** @var  \XoopsModules\Simplepage\Page  $page */
        foreach ($pages as $page) {
            $pageArray = $page->getValues();
            $pageArray['isPubIcon']     = "../assets/images/" . $page->getVar('isPublished') . '.png';
            $pageArray['isPubIconAlt']  = '';
            $pageArray['isDispIcon'] =  "../assets/images/" . $page->getVar('isDisplayTitle') . '.png';
            $pageArray['isDispIconAlt'] = '';
            $pageArray['created']       = $page->created();
            $pageArray['updated']       = $page->updated();
            $pageArray['updater']       = $page->updater();
            $pagesArray[]               = $pageArray;
        }

        $GLOBALS['xoopsTpl']->assign([
            'thisUrl'    => $_SERVER['SCRIPT_NAME'],
            'indexUrl'   => $helper->url('index.php'),
            'pagesArray' => $pagesArray,
            'pager'      => $pager

        ]);
        $GLOBALS['xoTheme']->addStylesheet($helper->url('assets/css/simplepage_admin.css'));
        echo $GLOBALS['xoopsTpl']->fetch($helper->path('templates/admin/simplepage_page_list.tpl'));
		break;
}

include_once __DIR__ . '/admin_footer.php';
