<?php
/*
 You may not change or alter any portion of this comment or credits
 of supporting developers from this source code or any supporting source code
 which is considered copyrighted (c) material of the original comment or credit authors.

 This program is distributed in the hope that it will be useful,
 but WITHOUT ANY WARRANTY; without even the implied warranty of
 MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 */
/**
 * Simplepage module for XOOPS
 *
 * @package  \XoopsModules\Simplepage
 * @sybpackage  language
 * @copyright  &copy; 2000-2021 {@link https://xoops.org XOOPS Project}
 * @license  {@link https://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU GPL 2}
 * @author  XOOPS Module Dev Team (https://xoops.org)
 * @link  https://github.com/XoopsModules25x/simplepage  Simplepage Repository
 */
$moduleDirName = basename(dirname(dirname(__DIR__)));
$moduleDirNameUpper = mb_strtoupper($moduleDirName);

define('CO_' . $moduleDirNameUpper . '_GDLIBSTATUS', 'GD library support: ');
define('CO_' . $moduleDirNameUpper . '_GDLIBVERSION', 'GD Library version: ');
define('CO_' . $moduleDirNameUpper . '_GDOFF', "<span style='font-weight: bold;'>Disabled</span> (No thumbnails available)");
define('CO_' . $moduleDirNameUpper . '_GDON', "<span style='font-weight: bold;'>Enabled</span> (Thumbsnails available)");
define('CO_' . $moduleDirNameUpper . '_IMAGEINFO', 'Server status');
define('CO_' . $moduleDirNameUpper . '_MAXPOSTSIZE', 'Max post size permitted (post_max_size directive in php.ini): ');
define('CO_' . $moduleDirNameUpper . '_MAXUPLOADSIZE', 'Max upload size permitted (upload_max_filesize directive in php.ini): ');
define('CO_' . $moduleDirNameUpper . '_MEMORYLIMIT', 'Memory limit (memory_limit directive in php.ini): ');
define('CO_' . $moduleDirNameUpper . '_METAVERSION', "<span style='font-weight: bold;'>Downloads meta version:</span> ");
define('CO_' . $moduleDirNameUpper . '_OFF', "<span style='font-weight: bold;'>OFF</span>");
define('CO_' . $moduleDirNameUpper . '_ON', "<span style='font-weight: bold;'>ON</span>");
define('CO_' . $moduleDirNameUpper . '_SERVERPATH', 'Server path to XOOPS root: ');
define('CO_' . $moduleDirNameUpper . '_SERVERUPLOADSTATUS', 'Server uploads status: ');
define('CO_' . $moduleDirNameUpper . '_SPHPINI', "<span style='font-weight: bold;'>Information taken from PHP ini file:</span>");
define('CO_' . $moduleDirNameUpper . '_UPLOADPATHDSC', 'Note. Upload path *MUST* contain the full server path of your upload folder.');

define('CO_' . $moduleDirNameUpper . '_PRINT', "<span style='font-weight: bold;'>Print</span>");
define('CO_' . $moduleDirNameUpper . '_PDF', "<span style='font-weight: bold;'>Create PDF</span>");

define('CO_' . $moduleDirNameUpper . '_UPGRADEFAILED0', "Update failed - couldn't rename field '%s'");
define('CO_' . $moduleDirNameUpper . '_UPGRADEFAILED1', "Update failed - couldn't add new fields");
define('CO_' . $moduleDirNameUpper . '_UPGRADEFAILED2', "Update failed - couldn't rename table '%s'");
define('CO_' . $moduleDirNameUpper . '_ERROR_COLUMN', 'Could not create column in database : %s');
define('CO_' . $moduleDirNameUpper . '_ERROR_BAD_XOOPS', 'This module requires XOOPS %s+ (%s installed)');
define('CO_' . $moduleDirNameUpper . '_ERROR_BAD_PHP', 'This module requires PHP version %s+ (%s installed)');
define('CO_' . $moduleDirNameUpper . '_ERROR_TAG_REMOVAL', 'Could not remove tags from Tag Module');

define('CO_' . $moduleDirNameUpper . '_FOLDERS_DELETED_OK', 'Upload Folders have been deleted');

// Error Msgs
define('CO_' . $moduleDirNameUpper . '_ERROR_BAD_DEL_PATH', 'Could not delete %s directory');
define('CO_' . $moduleDirNameUpper . '_ERROR_BAD_REMOVE', 'Could not delete %s');
define('CO_' . $moduleDirNameUpper . '_ERROR_NO_PLUGIN', 'Could not load plugin');

//Help
define('CO_' . $moduleDirNameUpper . '_DIRNAME', basename(dirname(dirname(__DIR__))));
define('CO_' . $moduleDirNameUpper . '_HELP_HEADER', __DIR__ . '/help/helpheader.tpl');
define('CO_' . $moduleDirNameUpper . '_BACK_2_ADMIN', 'Back to Administration of ');
define('CO_' . $moduleDirNameUpper . '_OVERVIEW', 'Overview');

//define('CO_' . $moduleDirNameUpper . '_HELP_DIR', __DIR__);

//help multi-page
define('CO_' . $moduleDirNameUpper . '_DISCLAIMER', 'Disclaimer');
define('CO_' . $moduleDirNameUpper . '_LICENSE', 'License');
define('CO_' . $moduleDirNameUpper . '_SUPPORT', 'Support');

//Sample Data
define('CO_' . $moduleDirNameUpper . '_' . 'LOAD_SAMPLEDATA', 'Import Sample Data (will delete ALL current data)');
define('CO_' . $moduleDirNameUpper . '_' . 'LOAD_SAMPLEDATA_CONFIRM', 'Are you sure to Import Sample Data? (It will delete ALL current data)');
define('CO_' . $moduleDirNameUpper . '_' . 'LOAD_SAMPLEDATA_SUCCESS', 'Sample Date imported  successfully');
define('CO_' . $moduleDirNameUpper . '_' . 'SAVE_SAMPLEDATA', 'Export Tables to YAML');
define('CO_' . $moduleDirNameUpper . '_' . 'SAVE_SAMPLEDATA_SUCCESS', 'Export Tables to YAML successfully');
define('CO_' . $moduleDirNameUpper . '_' . 'CLEAR_SAMPLEDATA', 'Clear Sample Data');
define('CO_' . $moduleDirNameUpper . '_' . 'CLEAR_SAMPLEDATA_OK', 'The Sample Data has been cleared');
define('CO_' . $moduleDirNameUpper . '_' . 'CLEAR_SAMPLEDATA_CONFIRM', 'Are you sure to Clear Sample Data? (It will delete ALL current data)');
define('CO_' . $moduleDirNameUpper . '_' . 'EXPORT_SCHEMA', 'Export DB Schema to YAML');
define('CO_' . $moduleDirNameUpper . '_' . 'EXPORT_SCHEMA_SUCCESS', 'Export DB Schema to YAML was a success');
define('CO_' . $moduleDirNameUpper . '_' . 'EXPORT_SCHEMA_ERROR', 'ERROR: Export of DB Schema to YAML failed');
define('CO_' . $moduleDirNameUpper . '_' . 'SHOW_SAMPLE_BUTTON', 'Show Sample Button?');
define('CO_' . $moduleDirNameUpper . '_' . 'SHOW_SAMPLE_BUTTON_DESC', 'If yes, the "Add Sample Data" button will be visible to the Admin. It is Yes as a default for first installation.');
define('CO_' . $moduleDirNameUpper . '_' . 'HIDE_SAMPLEDATA_BUTTONS', 'Hide the Import buttons)');
define('CO_' . $moduleDirNameUpper . '_' . 'SHOW_SAMPLEDATA_BUTTONS', 'Show the Import buttons)');

\define('CO_' . $moduleDirNameUpper . '_' . 'CONFIRM', 'Confirm');

//letter choice
define('CO_' . $moduleDirNameUpper . '_' . 'BROWSETOTOPIC', "<span style='font-weight: bold;'>Browse items alphabetically</span>");
define('CO_' . $moduleDirNameUpper . '_' . 'OTHER', 'Other');
define('CO_' . $moduleDirNameUpper . '_' . 'ALL', 'All');

// block defines
define('CO_' . $moduleDirNameUpper . '_' . 'ACCESSRIGHTS', 'Access Rights');
define('CO_' . $moduleDirNameUpper . '_' . 'ACTION', 'Action');
define('CO_' . $moduleDirNameUpper . '_' . 'ACTIVERIGHTS', 'Active Rights');
define('CO_' . $moduleDirNameUpper . '_' . 'BADMIN', 'Block Administration');
define('CO_' . $moduleDirNameUpper . '_' . 'BLKDESC', 'Description');
define('CO_' . $moduleDirNameUpper . '_' . 'CBCENTER', 'Center Middle');
define('CO_' . $moduleDirNameUpper . '_' . 'CBLEFT', 'Center Left');
define('CO_' . $moduleDirNameUpper . '_' . 'CBRIGHT', 'Center Right');
define('CO_' . $moduleDirNameUpper . '_' . 'SBLEFT', 'Left');
define('CO_' . $moduleDirNameUpper . '_' . 'SBRIGHT', 'Right');
define('CO_' . $moduleDirNameUpper . '_' . 'SIDE', 'Alignment');
define('CO_' . $moduleDirNameUpper . '_' . 'TITLE', 'Title');
define('CO_' . $moduleDirNameUpper . '_' . 'VISIBLE', 'Visible');
define('CO_' . $moduleDirNameUpper . '_' . 'VISIBLEIN', 'Visible In');
define('CO_' . $moduleDirNameUpper . '_' . 'WEIGHT', 'Weight');

define('CO_' . $moduleDirNameUpper . '_' . 'PERMISSIONS', 'Permissions');
define('CO_' . $moduleDirNameUpper . '_' . 'BLOCKS', 'Blocks Admin');
define('CO_' . $moduleDirNameUpper . '_' . 'BLOCKS_DESC', 'Blocks/Group Admin');

define('CO_' . $moduleDirNameUpper . '_' . 'BLOCKS_MANAGMENT', 'Manage');
define('CO_' . $moduleDirNameUpper . '_' . 'BLOCKS_ADDBLOCK', 'Add a new block');
define('CO_' . $moduleDirNameUpper . '_' . 'BLOCKS_EDITBLOCK', 'Edit a block');
define('CO_' . $moduleDirNameUpper . '_' . 'BLOCKS_CLONEBLOCK', 'Clone a block');

//Template Admin
define('CO_' . $moduleDirNameUpper . '_' . 'TPLSETS', 'Template Management');
define('CO_' . $moduleDirNameUpper . '_' . 'GENERATE', 'Generate');
define('CO_' . $moduleDirNameUpper . '_' . 'FILENAME', 'File Name');

//Admin Footer
define('CO_' . $moduleDirNameUpper . '_' . 'AUTHORLINK', 'https://xoops.org');
define('CO_' . $moduleDirNameUpper . '_' . 'AUTHORIMAGENAME', 'xoopsmicrobutton.gif');
define('CO_' . $moduleDirNameUpper . '_' . 'AUTHORIMAGEALT', 'XOOPS Link');
define('CO_' . $moduleDirNameUpper . '_' . 'AUTHORIMAGETITLE', 'Visit XOOPS');
define('CO_' . $moduleDirNameUpper . '_' . 'MAINTENANCETEXT', "This module is maintained by the ");
define('CO_' . $moduleDirNameUpper . '_' . 'MAINTENANCELINK', "https://xoops.org/");
define('CO_' . $moduleDirNameUpper . '_' . 'MAINTENANCETITLE', "Visit XOOPS Community");
define('CO_' . $moduleDirNameUpper . '_' . 'MAINTENANCELINKTEXT', "XOOPS Community");

//Menu
define('CO_' . $moduleDirNameUpper . '_' . 'ADMENU_CONFIRM', 'Confirm');
define('CO_' . $moduleDirNameUpper . '_' . 'ADMENU_MIGRATE', 'Migrate');
define('CO_' . $moduleDirNameUpper . '_' . 'MIGRATE_OK', 'Database migrated to current schema.');
define('CO_' . $moduleDirNameUpper . '_' . 'MIGRATE_WARNING', 'Warning! This is intended for developers only. Confirm write schema file from current database.');
define('CO_' . $moduleDirNameUpper . '_' . 'MIGRATE_SCHEMA_OK', 'Current schema file written');
define('CO_' . $moduleDirNameUpper . '_' . 'MIGRATE_SHOW_SQL', 'Show SQL');
define('CO_' . $moduleDirNameUpper . '_' . 'MIGRATE_DO_MIGRATION', 'Do Migration');
define('CO_' . $moduleDirNameUpper . '_' . 'MIGRATE_WRITE_SCHEMA', 'Write Schema');
define('CO_' . $moduleDirNameUpper . '_' . 'MIGRATE_SCHEMA_WRITTEN', 'Current schema file written');
define('CO_' . $moduleDirNameUpper . '_' . 'MIGRATE_SCHEMA_UPDATED', 'Database migrated to current schema.');
define('CO_' . $moduleDirNameUpper . '_' . 'FOLDER_YES', 'Folder "%s" exist');
define('CO_' . $moduleDirNameUpper . '_' . 'FOLDER_NO', 'Folder "%s" does not exist. Create the specified folder with CHMOD 777.');
define('CO_' . $moduleDirNameUpper . '_' . 'SHOW_DEV_TOOLS', 'Show Development Tools Button?');
define('CO_' . $moduleDirNameUpper . '_' . 'SHOW_DEV_TOOLS_DESC', 'If yes, the "Migrate" Tab and other Development tools will be visible to the Admin.');
define('CO_' . $moduleDirNameUpper . '_' . 'ADMENU_FEEDBACK', 'Feedback');

//Latest Version Check
define('CO_' . $moduleDirNameUpper . '_' . 'NEW_VERSION', 'New Version: ');
define('CO_' . $moduleDirNameUpper . '_' . 'RELEASE_INTRO_INDEX', 0); // index in $version[] array
define('CO_' . $moduleDirNameUpper . '_' . 'RELEASE_LINK_INDEX', 1);  // index in $version[] array

//DirectoryChecker
define('CO_' . $moduleDirNameUpper . '_' . 'AVAILABLE', "<span style='color: #008000;'>Available</span>");
define('CO_' . $moduleDirNameUpper . '_' . 'NOTAVAILABLE', "<span style='color: #ff0000;'>Not available</span>");
define('CO_' . $moduleDirNameUpper . '_' . 'NOTWRITABLE', "<span style='color: #ff0000;'>Should have permission ( %d ), but it has ( %d )</span>");
define('CO_' . $moduleDirNameUpper . '_' . 'CREATETHEDIR', 'Create it');
define('CO_' . $moduleDirNameUpper . '_' . 'SETMPERM', 'Set the permission');
define('CO_' . $moduleDirNameUpper . '_' . 'DIRCREATED', 'The directory has been created');
define('CO_' . $moduleDirNameUpper . '_' . 'DIRNOTCREATED', 'The directory cannot be created');
define('CO_' . $moduleDirNameUpper . '_' . 'PERMSET', 'The permission has been set');
define('CO_' . $moduleDirNameUpper . '_' . 'PERMNOTSET', 'The permission cannot be set');

//FileChecker
//define('CO_' . $moduleDirNameUpper . '_' . 'AVAILABLE', "<span style='color: green;'>Available</span>");
//define('CO_' . $moduleDirNameUpper . '_' . 'NOTAVAILABLE', "<span style='color: red;'>Not available</span>");
//define('CO_' . $moduleDirNameUpper . '_' . 'NOTWRITABLE', "<span style='color: red;'>Should have permission ( %d ), but it has ( %d )</span>");
//define('CO_' . $moduleDirNameUpper . '_' . 'COPYTHEFILE', 'Copy it');
//define('CO_' . $moduleDirNameUpper . '_' . 'CREATETHEFILE', 'Create it');
//define('CO_' . $moduleDirNameUpper . '_' . 'SETMPERM', 'Set the permission');

define('CO_' . $moduleDirNameUpper . '_' . 'FILECOPIED', 'The file has been copied');
define('CO_' . $moduleDirNameUpper . '_' . 'FILENOTCOPIED', 'The file cannot be copied');

//define('CO_' . $moduleDirNameUpper . '_' . 'PERMSET', 'The permission has been set');
//define('CO_' . $moduleDirNameUpper . '_' . 'PERMNOTSET', 'The permission cannot be set');

define('CO_' . $moduleDirNameUpper . '_' . 'TRUNCATE_LENGTH', 'Number of Characters to truncate to the long text field');
define('CO_' . $moduleDirNameUpper . '_' . 'TRUNCATE_LENGTH_DESC', 'Set the maximum number of characters to truncate the long text fields');

//image config
define('CO_' . $moduleDirNameUpper . '_' . 'IMAGE_WIDTH', 'Image Display Width');
define('CO_' . $moduleDirNameUpper . '_' . 'IMAGE_WIDTH_DSC', 'Display width for image');
define('CO_' . $moduleDirNameUpper . '_' . 'IMAGE_HEIGHT', 'Image Display Height');
define('CO_' . $moduleDirNameUpper . '_' . 'IMAGE_HEIGHT_DSC', 'Display height for image');
define('CO_' . $moduleDirNameUpper . '_' . 'IMAGE_CONFIG', '<span style="color: #FF0000; font-size: Small;  font-weight: bold;">--- EXTERNAL Image configuration ---</span> ');
define('CO_' . $moduleDirNameUpper . '_' . 'IMAGE_CONFIG_DSC', '');
define('CO_' . $moduleDirNameUpper . '_' . 'IMAGE_UPLOAD_PATH', 'Image Upload path');
define('CO_' . $moduleDirNameUpper . '_' . 'IMAGE_UPLOAD_PATH_DSC', 'Path for uploading images');
