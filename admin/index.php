<?php
/*
 You may not change or alter any portion of this comment or credits of
 supporting developers from this source code or any supporting source code
 which is considered copyrighted (c) material of the original comment or credit
 authors.

 This program is distributed in the hope that it will be useful, but
 WITHOUT ANY WARRANTY; without even the implied warranty of
 MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 */

/**
 * Module: Simplepage
 *
 * @package  \XoopsModules\Simplepage
 * @subpackage  admin
 * @copyright  &copy; 2000-2021 {@link https://xoops.org XOOPS Project}
 * @license  {@link https://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU GPL 2 or later}
 * @author  XOOPS Module Development Team
 * @link  https://github.com/XoopsModules25x/simplepage  Simplepage Repository
 */

use Xmf\Request;
use XoopsModules\Simplepage\{
    Common\TestdataButtons,
    Constants,
    Utility
};

/**
 * @var  \Xmf\Module\Admin  $adminObject
 * @var  \XoopsModules\Simplepage\Helper  $helper
 * @var  string  $moduleDirName
 * @var  string  $moduleDirNameUpper
 */
require_once __DIR__ . '/admin_header.php';
xoops_cp_header();

$adminObject->displayNavigation(basename(__FILE__));

$criteria = new \Criteria('');
$criteria->setGroupBy('isPublished');
$pageCount       = $helper->getHandler('Page')->getCounts($criteria);
$totalPages      = array_sum($pageCount);
$totalPubPages   = isset($pageCount[Constants::IS_PUBLISHED]) ? $pageCount[Constants::IS_PUBLISHED] : 0;
$totalDraftPages = $totalPages - $totalPubPages;

$adminObject->addInfoBox(_MD_SIMPLEPAGE_DASHBOARD);
$adminObject->AddInfoBoxLine(sprintf('<span class="infolabel">' . _MD_SIMPLEPAGE_TOTAL_PUB . '</span>', '<span class="infotext green bold">' . (int)$totalPubPages . '</span>'));
$adminObject->addInfoBoxLine(sprintf('<span class="infolabel">' . _MD_SIMPLEPAGE_TOTAL_DRAFT . '</span>', '<span class="infotext red bold">' . (int)$totalDraftPages . '</span>'));
$adminObject->addInfoBoxLine(sprintf('<span class="infolabel">' . _MD_SIMPLEPAGE_TOTAL_PAGES . '</span>', '<span class="infotext bold">' . (int)$totalPages . '</span>'));

//check for latest release

$newRelease = Utility::checkVerModule($helper);
if (!empty($newRelease)) {
    $adminObject->addItemButton(
        $newRelease[constant('CO_' . $moduleDirNameUpper . '_RELEASE_INTRO_INDEX')],
        $newRelease[constant('CO_' . $moduleDirNameUpper . '_RELEASE_LINK_INDEX')],
        'download',
        'style="color: Red"'
    );
}

//------------- Test Data ----------------------------
if (Constants::DISP_SAMPLE_BTN == $helper->getConfig('displaySampleButton')) {
    TestdataButtons::loadButtonConfig($adminObject);
    $adminObject->displayButton('left', '');
}
//------------- End Test Data ----------------------------

//------------- Test Data Buttons ----------------------------
$op = Request::getCmd('op', '', 'GET');

switch ($op) {
//    default:
    case 'hide_buttons':
        TestdataButtons::hideButtons();
        break;
    case 'show_buttons':
        TestdataButtons::showButtons();
        break;
}
//------------- End Test Data Buttons ----------------------------


$adminObject->displayIndex();
echo Utility::getServerStats();

require __DIR__ . '/admin_footer.php';
