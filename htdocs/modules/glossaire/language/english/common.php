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
 * Wfdownloads module
 *
 * @copyright       XOOPS Project (https://xoops.org)
 * @license         GNU GPL 2 or later (https://www.gnu.org/licenses/gpl-2.0.html)
 * @package         wfdownload
 * @since           3.23
 * @author          Xoops Development Team
 */
$moduleDirName      = \basename(\dirname(__DIR__, 2));
$moduleDirNameUpper = \mb_strtoupper($moduleDirName);

\define('CO_GLOSSAIRE_GDLIBSTATUS', 'GD library support: ');
\define('CO_GLOSSAIRE_GDLIBVERSION', 'GD Library version: ');
\define('CO_GLOSSAIRE_GDOFF', "<span style='font-weight: bold;'>Disabled</span> (No thumbnails available)");
\define('CO_GLOSSAIRE_GDON', "<span style='font-weight: bold;'>Enabled</span> (Thumbsnails available)");
\define('CO_GLOSSAIRE_IMAGEINFO', 'Server status');
\define('CO_GLOSSAIRE_MAXPOSTSIZE', 'Max post size permitted (post_max_size directive in php.ini): ');
\define('CO_GLOSSAIRE_MAXUPLOADSIZE', 'Max upload size permitted (upload_max_filesize directive in php.ini): ');
\define('CO_GLOSSAIRE_MEMORYLIMIT', 'Memory limit (memory_limit directive in php.ini): ');
\define('CO_GLOSSAIRE_METAVERSION', "<span style='font-weight: bold;'>Downloads meta version:</span> ");
\define('CO_GLOSSAIRE_OFF', "<span style='font-weight: bold;'>OFF</span>");
\define('CO_GLOSSAIRE_ON', "<span style='font-weight: bold;'>ON</span>");
\define('CO_GLOSSAIRE_SERVERPATH', 'Server path to XOOPS root: ');
\define('CO_GLOSSAIRE_SERVERUPLOADSTATUS', 'Server uploads status: ');
\define('CO_GLOSSAIRE_SPHPINI', "<span style='font-weight: bold;'>Information taken from PHP ini file:</span>");
\define('CO_GLOSSAIRE_UPLOADPATHDSC', 'Note. Upload path *MUST* contain the full server path of your upload folder.');

\define('CO_GLOSSAIRE_PRINT', "<span style='font-weight: bold;'>Print</span>");
\define('CO_GLOSSAIRE_PDF', "<span style='font-weight: bold;'>Create PDF</span>");

\define('CO_GLOSSAIRE_UPGRADEFAILED0', "Update failed - couldn't rename field '%s'");
\define('CO_GLOSSAIRE_UPGRADEFAILED1', "Update failed - couldn't add new fields");
\define('CO_GLOSSAIRE_UPGRADEFAILED2', "Update failed - couldn't rename table '%s'");
\define('CO_GLOSSAIRE_ERROR_COLUMN', 'Could not create column in database : %s');
\define('CO_GLOSSAIRE_ERROR_BAD_XOOPS', 'This module requires XOOPS %s+ (%s installed)');
\define('CO_GLOSSAIRE_ERROR_BAD_PHP', 'This module requires PHP version %s+ (%s installed)');
\define('CO_GLOSSAIRE_ERROR_TAG_REMOVAL', 'Could not remove tags from Tag Module');

\define('CO_GLOSSAIRE_FOLDERS_DELETED_OK', 'Upload Folders have been deleted');

// Error Msgs
\define('CO_GLOSSAIRE_ERROR_BAD_DEL_PATH', 'Could not delete %s directory');
\define('CO_GLOSSAIRE_ERROR_BAD_REMOVE', 'Could not delete %s');
\define('CO_GLOSSAIRE_ERROR_NO_PLUGIN', 'Could not load plugin');

//Help
\define('CO_GLOSSAIRE_DIRNAME', \basename(\dirname(__DIR__, 2)));
\define('CO_GLOSSAIRE_HELP_HEADER', __DIR__ . '/help/helpheader.tpl');
\define('CO_GLOSSAIRE_BACK_2_ADMIN', 'Back to Administration of ');
\define('CO_GLOSSAIRE_OVERVIEW', 'Overview');

//\define('CO_GLOSSAIRE_HELP_DIR', __DIR__);

//help multi-page
\define('CO_GLOSSAIRE_DISCLAIMER', 'Disclaimer');
\define('CO_GLOSSAIRE_LICENSE', 'License');
\define('CO_GLOSSAIRE_SUPPORT', 'Support');

//Sample Data
\define('_CO_GLOSSAIRE_ADD_SAMPLEDATA', 'Import Sample Data (will delete ALL current data)');
\define('_CO_GLOSSAIRE_SAMPLEDATA_SUCCESS', 'Sample Data imported successfully');
\define('_CO_GLOSSAIRE_SAVE_SAMPLEDATA', 'Export Tables to YAML');
\define('_CO_GLOSSAIRE_SAVE_SAMPLEDATA_SUCCESS', 'Export Tables to YAML successfully');
\define('_CO_GLOSSAIRE_SAVE_SAMPLEDATA_ERROR', 'ERROR: Export of Tables to YAML failed');
\define('_CO_GLOSSAIRE_SHOW_SAMPLE_BUTTON', 'Show Sample Button?');
\define('_CO_GLOSSAIRE_SHOW_SAMPLE_BUTTON_DESC', 'If yes, the "Add Sample Data" button will be visible to the Admin. It is Yes as a default for first installation.');
\define('_CO_GLOSSAIRE_EXPORT_SCHEMA', 'Export DB Schema to YAML');
\define('_CO_GLOSSAIRE_EXPORT_SCHEMA_SUCCESS', 'Export DB Schema to YAML was a success');
\define('_CO_GLOSSAIRE_EXPORT_SCHEMA_ERROR', 'ERROR: Export of DB Schema to YAML failed');
\define('_CO_GLOSSAIRE_ADD_SAMPLEDATA_OK', 'Are you sure to Import Sample Data? (It will delete ALL current data)');
\define('_CO_GLOSSAIRE_HIDE_SAMPLEDATA_BUTTONS', 'Hide the Import buttons');
\define('_CO_GLOSSAIRE_SHOW_SAMPLEDATA_BUTTONS', 'Show the Import buttons');
\define('_CO_GLOSSAIRE_CONFIRM', 'Confirm');

//letter choice
\define('_CO_GLOSSAIRE_BROWSETOTOPIC', "<span style='font-weight: bold;'>Browse items alphabetically</span>");
\define('_CO_GLOSSAIRE_OTHER', 'Other');
\define('_CO_GLOSSAIRE_ALL', 'All');

// block defines
\define('_CO_GLOSSAIRE_ACCESSRIGHTS', 'Access Rights');
\define('_CO_GLOSSAIRE_ACTION', 'Action');
\define('_CO_GLOSSAIRE_ACTIVERIGHTS', 'Active Rights');
\define('_CO_GLOSSAIRE_BADMIN', 'Block Administration');
\define('_CO_GLOSSAIRE_BLKDESC', 'Description');
\define('_CO_GLOSSAIRE_CBCENTER', 'Center Middle');
\define('_CO_GLOSSAIRE_CBLEFT', 'Center Left');
\define('_CO_GLOSSAIRE_CBRIGHT', 'Center Right');
\define('_CO_GLOSSAIRE_SBLEFT', 'Left');
\define('_CO_GLOSSAIRE_SBRIGHT', 'Right');
\define('_CO_GLOSSAIRE_SIDE', 'Alignment');
\define('_CO_GLOSSAIRE_TITLE', 'Title');
\define('_CO_GLOSSAIRE_VISIBLE', 'Visible');
\define('_CO_GLOSSAIRE_VISIBLEIN', 'Visible In');
\define('_CO_GLOSSAIRE_WEIGHT', 'Weight');

\define('_CO_GLOSSAIRE_PERMISSIONS', 'Permissions');
\define('_CO_GLOSSAIRE_BLOCKS', 'Blocks Admin');
\define('_CO_GLOSSAIRE_BLOCKS_DESC', 'Blocks/Group Admin');

\define('_CO_GLOSSAIRE_BLOCKS_MANAGMENT', 'Manage');
\define('_CO_GLOSSAIRE_BLOCKS_ADDBLOCK', 'Add a new block');
\define('_CO_GLOSSAIRE_BLOCKS_EDITBLOCK', 'Edit a block');
\define('_CO_GLOSSAIRE_BLOCKS_CLONEBLOCK', 'Clone a block');

//myblocksadmin
\define('_CO_GLOSSAIRE_AGDS', 'Admin Groups');
\define('_CO_GLOSSAIRE_BCACHETIME', 'Cache Time');
\define('_CO_GLOSSAIRE_BLOCKS_ADMIN', 'Blocks Admin');

//Template Admin
\define('_CO_GLOSSAIRE_TPLSETS', 'Template Management');
\define('_CO_GLOSSAIRE_GENERATE', 'Generate');
\define('_CO_GLOSSAIRE_FILENAME', 'File Name');

//Menu
\define('_CO_GLOSSAIRE_ADMENU_MIGRATE', 'Migrate');
\define('_CO_GLOSSAIRE_FOLDER_YES', 'Folder "%s" exist');
\define('_CO_GLOSSAIRE_FOLDER_NO', 'Folder "%s" does not exist. Create the specified folder with CHMOD 777.');
\define('_CO_GLOSSAIRE_SHOW_DEV_TOOLS', 'Show Development Tools Button?');
\define('_CO_GLOSSAIRE_SHOW_DEV_TOOLS_DESC', 'If yes, the "Migrate" Tab and other Development tools will be visible to the Admin.');
\define('_CO_GLOSSAIRE_ADMENU_FEEDBACK', 'Feedback');

//Latest Version Check
\define('_CO_GLOSSAIRE_NEW_VERSION', 'New Version: ');

//DirectoryChecker
\define('_CO_GLOSSAIRE_AVAILABLE', "<span style='color: green;'>Available</span>");
\define('_CO_GLOSSAIRE_NOTAVAILABLE', "<span style='color: red;'>Not available</span>");
\define('_CO_GLOSSAIRE_NOTWRITABLE', "<span style='color: red;'>Should have permission ( %d ), but it has ( %d )</span>");
\define('_CO_GLOSSAIRE_CREATETHEDIR', 'Create it');
\define('_CO_GLOSSAIRE_SETMPERM', 'Set the permission');
\define('_CO_GLOSSAIRE_DIRCREATED', 'The directory has been created');
\define('_CO_GLOSSAIRE_DIRNOTCREATED', 'The directory cannot be created');
\define('_CO_GLOSSAIRE_PERMSET', 'The permission has been set');
\define('_CO_GLOSSAIRE_PERMNOTSET', 'The permission cannot be set');

//FileChecker
//\define('_CO_GLOSSAIRE_AVAILABLE', "<span style='color: green;'>Available</span>");
//\define('_CO_GLOSSAIRE_NOTAVAILABLE', "<span style='color: red;'>Not available</span>");
//\define('_CO_GLOSSAIRE_NOTWRITABLE', "<span style='color: red;'>Should have permission ( %d ), but it has ( %d )</span>");
//\define('_CO_GLOSSAIRE_COPYTHEFILE', 'Copy it');
//\define('_CO_GLOSSAIRE_CREATETHEFILE', 'Create it');
//\define('_CO_GLOSSAIRE_SETMPERM', 'Set the permission');

\define('_CO_GLOSSAIRE_FILECOPIED', 'The file has been copied');
\define('_CO_GLOSSAIRE_FILENOTCOPIED', 'The file cannot be copied');

//\define('_CO_GLOSSAIRE_PERMSET', 'The permission has been set');
//\define('_CO_GLOSSAIRE_PERMNOTSET', 'The permission cannot be set');

//image config
\define('_CO_GLOSSAIRE_IMAGE_WIDTH', 'Image Display Width');
\define('_CO_GLOSSAIRE_IMAGE_WIDTH_DSC', 'Display width for image');
\define('_CO_GLOSSAIRE_IMAGE_HEIGHT', 'Image Display Height');
\define('_CO_GLOSSAIRE_IMAGE_HEIGHT_DSC', 'Display height for image');
\define('_CO_GLOSSAIRE_IMAGE_CONFIG', '<span style="color: #FF0000; font-size: Small;  font-weight: bold;">--- EXTERNAL Image configuration ---</span> ');
\define('_CO_GLOSSAIRE_IMAGE_CONFIG_DSC', '');
\define('_CO_GLOSSAIRE_IMAGE_UPLOAD_PATH', 'Image Upload path');
\define('_CO_GLOSSAIRE_IMAGE_UPLOAD_PATH_DSC', 'Path for uploading images');

//Preferences
\define('_CO_GLOSSAIRE_TRUNCATE_LENGTH', 'Number of Characters to truncate to the long text field');
\define('_CO_GLOSSAIRE_TRUNCATE_LENGTH_DESC', 'Set the maximum number of characters to truncate the long text fields');

//Module Stats
\define('_CO_GLOSSAIRE_STATS_SUMMARY', 'Module Statistics');
\define('_CO_GLOSSAIRE_TOTAL_CATEGORIES', 'Categories:');
\define('_CO_GLOSSAIRE_TOTAL_ITEMS', 'Items');
\define('_CO_GLOSSAIRE_TOTAL_OFFLINE', 'Offline');
\define('_CO_GLOSSAIRE_TOTAL_PUBLISHED', 'Published');
\define('_CO_GLOSSAIRE_TOTAL_REJECTED', 'Rejected');
\define('_CO_GLOSSAIRE_TOTAL_SUBMITTED', 'Submitted');
\define('_CO_GLOSSAIRE_CATEGORY', "Catégorie");
\define('_CO_GLOSSAIRE_STATUS', "Statut");
