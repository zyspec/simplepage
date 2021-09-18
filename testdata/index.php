<?php
/*
 * You may not change or alter any portion of this comment or credits
 * of supporting developers from this source code or any supporting source code
 * which is considered copyrighted (c) material of the original comment or credit authors.
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 */

/**
 * @package  XoopsModules\Pedigree
 *
 * @copyright  {@link https://xoops.org/ XOOPS Project}
 * @license  {@link https://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU GPL 2 or later}
 * @author  Michael Beck (aka Mamba)
 * @link  https://github.com/XoopsModules25x/pedigree  Pedigree Repository
 */

use XoopsModules\Pedigree;
use XoopsModules\Pedigree\{
    Common,
    Constants,
    Helper,
    Utility
};

require_once __DIR__ . '/../../../mainfile.php';
include __DIR__ . '/../preloads/autoloader.php';

$moduleDirName = basename(dirname(__DIR__));
$moduleDirNameUpper = mb_strtoupper($moduleDirName);

if (!(Helper::getInstance()->isUserAdmin())) {
    redirect_header('index/php', Constants::REDIRECT_DELAY_MEDIUM, _NOPERM);
}

$op = \Xmf\Request::getCmd('op', '');

switch ($op) {
    case 'load':
        $helper = Pedigree\Helper::getInstance();
        $configurator = new Common\Configurator();
        // Load language files
        $helper->loadLanguage('admin');
        $helper->loadLanguage('modinfo');
        $helper->loadLanguage('common');

//    $items = \Xmf\Yaml::readWrapped('quotes_data.yml');
//    \Xmf\Database\TableLoad::truncateTable($moduleDirName . '_quotes');
//    \Xmf\Database\TableLoad::loadTableFromArray($moduleDirName . '_quotes', $items);

        $tables = \Xmf\Module\Helper::getHelper($moduleDirName)->getModule()->getInfo('tables');

        foreach ($tables as $table) {
            $tabledata = \Xmf\Yaml::readWrapped($table . '.yml');
            \Xmf\Database\TableLoad::truncateTable($table);
            \Xmf\Database\TableLoad::loadTableFromArray($table, $tabledata);
        }

        //  ---  COPY test folder files ---------------
        if (is_array($configurator->copyTestFolders) && count($configurator->copyTestFolders) > 0) {
            //        $file = __DIR__ . '/../testdata/images/';
            foreach (array_keys($configurator->copyTestFolders) as $i) {
                $src = $configurator->copyTestFolders[$i][0];
                $dest = $configurator->copyTestFolders[$i][1];
                Utility::rcopy($src, $dest);
            }
        }
        redirect_header($GLOBALS['xoops']->url('modules' . '/' . $moduleDirName . '/admin/'), Constants::REDIRECT_DELAY_MEDIUM, constant('CO_' . $moduleDirNameUpper . '_' . 'SAMPLEDATA_SUCCESS'));
        break;
    case 'save':
        $tables = \Xmf\Module\Helper::getHelper($moduleDirName)->getModule()->getInfo('tables');

        foreach ($tables as $table) {
            \Xmf\Database\TableLoad::saveTableToYamlFile($table, $table . '_' . date('Y-m-d H-i-s') . '.yml');
        }

        redirect_header('../admin/index.php', 1, constant('CO_' . $moduleDirNameUpper . '_' . 'SAMPLEDATA_SUCCESS'));
        break;

    case 'clear':
    {
        if (!isset($_POST['ok']) || Constants::CONFIRM_OK != $_POST['ok']) {
            require_once dirname(__DIR__, 3) . '/include/cp_header.php';
            xoops_cp_header();
            xoops_confirm(['op' => 'clear', 'ok' => Constants::CONFIRM_OK], $_SERVER['SCRIPT_NAME'], 'Are you sure you want to delete all data in the dB tables?', _DELETE);
            xoops_cp_footer();
        } else {
            if (!$GLOBALS['xoopsSecurity']->check()) {
                redirect_header($_SERVER['SCRIPT_NAME'], Constants::REDIRECT_DELAY_MEDIUM, implode('<br>', $GLOBALS['xoopsSecurity']->getErrors()));
            }

            $tables = \Xmf\Module\Helper::getHelper($moduleDirName)->getModule()->getInfo('tables');

            $tablesObj = new \Xmf\Database\Tables();

            foreach ($tables as $table) {
                if ($tablesObj->useTable($table)) {
                    $tablesObj->delete($table, '');
                }
            }
            $tablesObj->executeQueue(); // do it
            redirect_header($GLOBALS['xoops']->url('modules' . '/' . $moduleDirName . '/admin/'), Constants::REDIRECT_DELAY_NONE, 'Test data cleared from the dB');
        }
        break;
    }
}
/*
function exportSchema()
{
    try {
        $moduleDirName      = basename(dirname(__DIR__));
        $moduleDirNameUpper = mb_strtoupper($moduleDirName);

        $migrate = new \Xmf\Database\Migrate($moduleDirName);
        $migrate->saveCurrentSchema();

        redirect_header('../admin/index.php', 1, constant('CO_' . $moduleDirNameUpper . '_' . 'EXPORT_SCHEMA_SUCCESS'));
    } catch (\Exception $e) {
        exit(constant('CO_' . $moduleDirNameUpper . '_' . 'EXPORT_SCHEMA_ERROR'));
    }
}
*/