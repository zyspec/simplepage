<?php
/*
 * You may not change or alter any portion of this comment or credits
 * of supporting developers from this source code or any supporting source code
 * which is considered copyrighted (c) material of the original comment or credit authors.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 */

/**
 * @package  XoopsModules\Simplepage
 * @subpackage configuration
 * @copyright  {@link https://xoops.org/ XOOPS Project}
 * @license  {@link http://www.gnu.org/licenses/gpl-2.0.html GNU GPL 2 or later}
 * @author  XOOPS Module Dev Team (https://xoops.org)
 * @link https://github.com/XoopsModules25x/simplepage
 */

$moduleDirName      = basename(dirname(__DIR__));
$moduleDirNameUpper = mb_strtoupper($moduleDirName);

$pathsConfig        = include __DIR__ . '/paths.php';

return (object)[
    'name'           => mb_strtoupper($moduleDirName) . ' ModuleConfigurator',
    'paths'          => $pathsConfig->paths,
    'uploadFolders'  => $pathsConfig->uploadFolders,
/*
    'paths'          => [
        'dirname'    => $moduleDirName,
        'admin'      => XOOPS_ROOT_PATH . '/modules/' . $moduleDirName . '/admin',
        'modPath'    => XOOPS_ROOT_PATH . '/modules/' . $moduleDirName,
        'modUrl'     => XOOPS_URL . '/modules/' . $moduleDirName,
        'uploadPath' => XOOPS_UPLOAD_PATH . '/' . $moduleDirName,
        'uploadUrl'  => XOOPS_UPLOAD_URL . '/' . $moduleDirName,
        'imagePath'  => XOOPS_UPLOAD_PATH . '/' . $moduleDirName . '/assets/images',
        'imageUrl'   => XOOPS_UPLOAD_URL . '/' . $moduleDirName . '/assets/images'

    ],

    'uploadFolders'  => [
        XOOPS_UPLOAD_PATH . '/' . $moduleDirName,
        XOOPS_UPLOAD_PATH . '/' . $moduleDirName . '/' . 'owner',
        XOOPS_UPLOAD_PATH . '/' . $moduleDirName . '/' . 'images',
        XOOPS_UPLOAD_PATH . '/' . $moduleDirName . '/' . 'images/thumbnails',
        XOOPS_UPLOAD_PATH . '/' . $moduleDirName . '/' . $moduleDirName . '_config',
        XOOPS_UPLOAD_PATH . '/' . $moduleDirName . '/' . $moduleDirName . '_trash',
        XOOPS_UPLOAD_PATH . '/' . $moduleDirName . '/' . $moduleDirName . '_temp'
    ],
*/
    // image directories needing blank files (no trailing slash '/')
    'copyBlankFiles' => [],

    'copyTestFolders' => [
        [
            XOOPS_ROOT_PATH . '/modules/' . $moduleDirName . '/testdata/uploads',
            XOOPS_UPLOAD_PATH . '/' . $moduleDirName,
        ],
    ],

    'templateFolders' => [
        '/templates/',
        //'/templates/blocks/',
        //'/templates/admin/'
    ],
    'oldFiles' => [
        '/admin/index.html',
        '/class/breadcrumb.php',
        '/class/index.html',
        '/class/MenuItem.php',
        '/class/Page.php',
        '/class/Template.php',
        '/class/include/index.html',
        '/include/jquery1.1.2.js',
        '/include/jquery-1.2.1.pack.js',
        '/include/vars.php',
        '/index.html',
        '/language/index.html',
        '/language/schinese/index.html',
        '/language/schinese_utf8/index.html',
        '/language/tchinese_utf8/index.html',
        '/sql/index.html',
        '/templates/index.html',
        '/templates/simplepage_index.html'
    ],
    'oldFolders' => [
        '/images',
    ],

//  'oldTableName'     => 'newTableName',
    'renameTables' => [
        []
    ],

    // Fix column name(s)
    // syntax: ['tableName' => ['from' => 'oldColumn', 'to' =>'newColumn', ...]
    'renameColumns' => [],

    'moduleStats' => [
        //            'totalcategories' => $helper->getHandler('Category')->getCategoriesCount(-1),
        //            'totalitems'      => $helper->getHandler('Item')->getItemsCount(),
        //            'totalsubmitted'  => $helper->getHandler('Item')->getItemsCount(-1, [Constants::PUBLISHER_STATUS_SUBMITTED]),
    ],
    /** @todo figure out where this constant should be defined & ensure it's loaded */
    'modCopyright' => "<a href='https://xoops.org' title='XOOPS Project' target='_blank'>
                     <img src='" . constant($moduleDirNameUpper . '_AUTHOR_LOGOIMG') . "' alt='XOOPS Project'></a>",
];
