<?php

declare(strict_types=1);

/*
 You may not change or alter any portion of this comment or credits
 of supporting developers from this source code or any supporting source code
 which is considered copyrighted (c) material of the original comment or credit authors.

 This program is distributed in the hope that it will be useful,
 but WITHOUT ANY WARRANTY; without even the implied warranty of
 MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
*/

/**
 * Glossaire module for xoops
 *
 * @copyright      2021 XOOPS Project (https://xoops.org)
 * @license        GPL 2.0 or later
 * @package        glossaire
 * @since          1.0
 * @min_xoops      2.5.10
 * @author        Jean-Jacques DELALANDRE - Email:<jjdelalandre@orange.fr> - Website:<jubile.fr>
 */


function glossaire_getBreakLine($name){
// ------------------- Images ------------------- //
$tBreakLine = [
    'name'        => 'gls_break_' . strtolower($name),
    'title'       => '\_MI_GLOSSAIRE_BREAK_' . strtoupper($name),
    'description' => '', //\_MI_GLOSSAIRE_BREAK_' . strtoupper($name) . '_DESC',
    'formtype'    => 'line_break',
    'valuetype'   => 'textbox',
    'default'     => 'head',
];
    return $tBreakLine;
}

// 
$moduleDirName      = \basename(__DIR__);
$moduleDirNameUpper = \mb_strtoupper($moduleDirName);
// ------------------- Informations ------------------- //
$modversion = [
    'name'                => \_MI_GLOSSAIRE_NAME,
    'version'             => 1.2,
    'release'             => '2023-02-12',
    'module_status'       => 'Beta 6',
    'description'         => \_MI_GLOSSAIRE_DESC,
    'author'              => 'Jean-Jacques Delalandre',
    'author_mail'         => 'jjdelalandre@orange.fr',
    'author_website_url'  => 'jubile.fr',
    'author_website_name' => 'XOOPS Project',
    'credits'             => 'XOOPS Development Team (JJDai)',
    'license'             => 'GPL 2.0 or later',
    'license_url'         => 'https://www.gnu.org/licenses/gpl-3.0.en.html',
    'help'                => 'page=help',
    'release_info'        => 'release_info',
    'release_file'        => \XOOPS_URL . '/modules/glossaire/docs/release_info file',
    'release_date'        => '2022/06/12',
    'manual'              => 'link to manual file',
    'manual_file'         => \XOOPS_URL . '/modules/glossaire/docs/install.txt',
    'min_php'             => '5.5',
    'min_xoops'           => '2.5.10',
    'min_admin'           => '1.2',
    'min_db'              => ['mysql' => '5.5', 'mysqli' => '5.5'],
    'image'               => 'assets/images/logoModule.png',
    'dirname'             => \basename(__DIR__),
    'dirmoduleadmin'      => 'Frameworks/moduleclasses/moduleadmin',
    'sysicons16'          => '../../Frameworks/moduleclasses/icons/16',
    'sysicons32'          => '../../Frameworks/moduleclasses/icons/32',
    'modicons16'          => 'assets/icons/16',
    'modicons32'          => 'assets/icons/32',
    'demo_site_url'       => 'https://xoops2511a.jubile.fr',
    'demo_site_name'      => 'Jubile Demo Site',
    'support_url'         => 'https://www.frxoops.org/modules/newbb/',
    'support_name'        => 'Support Forum',
    'module_website_url'  => 'github.com/JJDai54',
    'module_website_name' => 'JJDai Project',
    'system_menu'         => 1,
    'hasAdmin'            => 1,
    'hasMain'             => 1,
    'adminindex'          => 'admin/index.php',
    'adminmenu'           => 'admin/menu.php',
    'onInstall'           => 'include/install.php',
    'onUninstall'         => 'include/uninstall.php',
    'onUpdate'            => 'include/update.php',
];
// ------------------- Templates ------------------- //
$modversion['templates'] = [
    // Admin templates
    ['file' => 'glossaire_admin_about.tpl', 'description' => '', 'type' => 'admin'],
    ['file' => 'glossaire_admin_header.tpl', 'description' => '', 'type' => 'admin'],
    ['file' => 'glossaire_admin_index.tpl', 'description' => '', 'type' => 'admin'],
    ['file' => 'glossaire_admin_categories.tpl', 'description' => '', 'type' => 'admin'],
    ['file' => 'glossaire_admin_entries.tpl', 'description' => '', 'type' => 'admin'],
    ['file' => 'glossaire_admin_permissions.tpl', 'description' => '', 'type' => 'admin'],
    ['file' => 'glossaire_admin_clone.tpl', 'description' => '', 'type' => 'admin'],
    ['file' => 'glossaire_admin_footer.tpl', 'description' => '', 'type' => 'admin'],
    ['file' => 'glossaire_admin_export.tpl', 'description' => '', 'type' => 'admin'],
    ['file' => 'glossaire_admin_import.tpl', 'description' => '', 'type' => 'admin'],
    // User templates
    ['file' => 'glossaire_header.tpl', 'description' => ''],
    ['file' => 'glossaire_index.tpl', 'description' => ''],
    ['file' => 'glossaire_categories.tpl', 'description' => ''],
    ['file' => 'glossaire_categories_list.tpl', 'description' => ''],
    ['file' => 'glossaire_categories_item.tpl', 'description' => ''],
    ['file' => 'glossaire_entries.tpl', 'description' => ''],
    ['file' => 'glossaire_entries_list.tpl', 'description' => ''],
    ['file' => 'glossaire_entries_item-01.tpl', 'description' => ''],
    ['file' => 'glossaire_entries_item-02.tpl', 'description' => ''],
    ['file' => 'glossaire_entries_terms_links.tpl', 'description' => ''],
    ['file' => 'glossaire_breadcrumbs.tpl', 'description' => ''],
    ['file' => 'glossaire_search.tpl', 'description' => ''],
    ['file' => 'glossaire_footer.tpl', 'description' => ''],
    ['file' => 'glossaire_categories_colors_set.tpl', 'description' => 'Boutons des categories'],
];
// ------------------- Mysql ------------------- //
$modversion['sqlfile']['mysql'] = 'sql/mysql.sql';
// Tables
$modversion['tables'] = [
    'glossaire_categories',
    'glossaire_entries',
];
// ------------------- Search ------------------- //
$modversion['hasSearch'] = 1;
$modversion['search'] = [
    'file' => 'include/search.inc.php',
    'func' => 'glossaire_search',
];
// ------------------- Menu ------------------- //
$currdirname  = isset($GLOBALS['xoopsModule']) && \is_object($GLOBALS['xoopsModule']) ? $GLOBALS['xoopsModule']->getVar('dirname') : 'system';
if ($currdirname == $moduleDirName) {
/*
    $modversion['sub'][] = [
        'name' => \_MI_GLOSSAIRE_SMNAME1,
        'url'  => 'index.php',
    ];
*/
    // Sub categories
    $modversion['sub'][] = [
        'name' => \_MI_GLOSSAIRE_SMNAME2,
        'url'  => 'categories.php',
    ];
    // Sub Submit
    $modversion['sub'][] = [
        'name' => \_MI_GLOSSAIRE_SMNAME3,
        'url'  => 'categories.php?op=new',
    ];
    // Sub entries
    $modversion['sub'][] = [
        'name' => \_MI_GLOSSAIRE_SMNAME4,
        'url'  => 'entries.php',
    ];
    // Sub Submit
    $modversion['sub'][] = [
        'name' => \_MI_GLOSSAIRE_SMNAME5,
        'url'  => 'entries.php?op=new',
    ];
}
// ------------------- Blocks ------------------- //
// Entries last
$modversion['blocks'][] = [
    'file'        => 'categories.php',
    'name'        => '//' . \_MI_GLOSSAIRE_CATEGORIES_BLOCK,
    'description' => \_MI_GLOSSAIRE_CATEGORIES_BLOCK_DESC,
    'show_func'   => 'b_glossaire_categories_show',
    'edit_func'   => 'b_glossaire_categories_edit',
    'template'    => 'glossaire_block_categories.tpl',
    'options'     => '5|80|0|Title', //nbItem|ldTitle|cats(0=all)|titl
];
// Entries last
$modversion['blocks'][] = [
    'file'        => 'entries.php',
    'name'        => '//' . \_MI_GLOSSAIRE_ENTRIES_BLOCK_LAST,
    'description' => \_MI_GLOSSAIRE_ENTRIES_BLOCK_LAST_DESC,
    'show_func'   => 'b_glossaire_entries_show',
    'edit_func'   => 'b_glossaire_entries_edit',
    'template'    => 'glossaire_block_entries.tpl',
    'options'     => 'last|5|25|0',
];
// Entries random
$modversion['blocks'][] = [
    'file'        => 'entries.php',
    'name'        => '//' . \_MI_GLOSSAIRE_ENTRIES_BLOCK_RANDOM,
    'description' => \_MI_GLOSSAIRE_ENTRIES_BLOCK_RANDOM_DESC,
    'show_func'   => 'b_glossaire_entries_show',
    'edit_func'   => 'b_glossaire_entries_edit',
    'template'    => 'glossaire_block_entries.tpl',
    'options'     => 'random|5|25|0',
];
/*
// Entries new
$modversion['blocks'][] = [
    'file'        => 'entries.php',
    'name'        => \_MI_GLOSSAIRE_ENTRIES_BLOCK_NEW,
    'description' => \_MI_GLOSSAIRE_ENTRIES_BLOCK_NEW_DESC,
    'show_func'   => 'b_glossaire_entries_show',
    'edit_func'   => 'b_glossaire_entries_edit',
    'template'    => 'glossaire_block_entries.tpl',
    'options'     => 'new|5|25|0',
];
// Entries hits
$modversion['blocks'][] = [
    'file'        => 'entries.php',
    'name'        => \_MI_GLOSSAIRE_ENTRIES_BLOCK_HITS,
    'description' => \_MI_GLOSSAIRE_ENTRIES_BLOCK_HITS_DESC,
    'show_func'   => 'b_glossaire_entries_show',
    'edit_func'   => 'b_glossaire_entries_edit',
    'template'    => 'glossaire_block_entries.tpl',
    'options'     => 'hits|5|25|0',
];
// Entries top
$modversion['blocks'][] = [
    'file'        => 'entries.php',
    'name'        => \_MI_GLOSSAIRE_ENTRIES_BLOCK_TOP,
    'description' => \_MI_GLOSSAIRE_ENTRIES_BLOCK_TOP_DESC,
    'show_func'   => 'b_glossaire_entries_show',
    'edit_func'   => 'b_glossaire_entries_edit',
    'template'    => 'glossaire_block_entries.tpl',
    'options'     => 'top|5|25|0',
];
*/
// ------------------- Config ------------------- //
// Editor Admin
\xoops_load('xoopseditorhandler');
$editorHandler = XoopsEditorHandler::getInstance();
$modversion['config'][] = [
    'name'        => 'editor_admin',
    'title'       => '\_MI_GLOSSAIRE_EDITOR_ADMIN',
    'description' => '\_MI_GLOSSAIRE_EDITOR_ADMIN_DESC',
    'formtype'    => 'select',
    'valuetype'   => 'text',
    'default'     => 'dhtml',
    'options'     => array_flip($editorHandler->getList()),
];
// Editor User
\xoops_load('xoopseditorhandler');
$editorHandler = XoopsEditorHandler::getInstance();
$modversion['config'][] = [
    'name'        => 'editor_user',
    'title'       => '\_MI_GLOSSAIRE_EDITOR_USER',
    'description' => '\_MI_GLOSSAIRE_EDITOR_USER_DESC',
    'formtype'    => 'select',
    'valuetype'   => 'text',
    'default'     => 'dhtml',
    'options'     => array_flip($editorHandler->getList()),
];
// Editor : max characters admin area
$modversion['config'][] = [
    'name'        => 'editor_maxchar',
    'title'       => '\_MI_GLOSSAIRE_EDITOR_MAXCHAR',
    'description' => '\_MI_GLOSSAIRE_EDITOR_MAXCHAR_DESC',
    'formtype'    => 'textbox',
    'valuetype'   => 'int',
    'default'     => 50,
];

/////////////////////////////////////////////////////////////
// create increment steps for file size
require_once __DIR__ . '/include/xoops_version.inc.php';
$iniPostMaxSize       = glossaireReturnBytes(\ini_get('post_max_size'));
$iniUploadMaxFileSize = glossaireReturnBytes(\ini_get('upload_max_filesize'));

/*
$iniPostMaxSize       = 314572800;
$iniUploadMaxFileSize = 314572800;
*/

$maxSize              = min($iniPostMaxSize, $iniUploadMaxFileSize);

if ($maxSize > 10000  * 1048576) $increment = 500;
if ($maxSize <= 10000 * 1048576) $increment = 200;
if ($maxSize <= 5000  * 1048576) $increment = 100;
if ($maxSize <= 2500  * 1048576) $increment = 50;
if ($maxSize <= 1000  * 1048576) $increment = 10;
if ($maxSize <= 500   * 1048576) $increment = 5;
if ($maxSize <= 100   * 1048576) $increment = 2;
if ($maxSize <= 50    * 1048576) $increment = 1;
if ($maxSize <= 25    * 1048576) $increment = 0.5;

// ------------------- Images ------------------- //
$modversion['config'][] = glossaire_getBreakLine('image');

$optionMaxsize = [];
$i = $increment;
while ($i * 1048576 <= $maxSize) {
    $optionMaxsize[$i . ' ' . _MI_GLOSSAIRE_SIZE_MB] = $i * 1048576;
    $i += $increment;
}
//echo "<hr><pre>" . print_r($optionMaxsize,true) . "</pre><hr>" ;

// Uploads : maxsize of image
$modversion['config'][] = [
    'name'        => 'maxsize_image',
    'title'       => '\_MI_GLOSSAIRE_MAXSIZE_IMAGE',
    'description' => '\_MI_GLOSSAIRE_MAXSIZE_IMAGE_DESC',
    'formtype'    => 'select',
    'valuetype'   => 'int',         
    'default'     => 104857600, //$optionMaxsize['100 Mo'],   
    'options'     => $optionMaxsize,
];
// Uploads : mimetypes of image
$modversion['config'][] = [
    'name'        => 'mimetypes_image',
    'title'       => '\_MI_GLOSSAIRE_MIMETYPES_IMAGE',
    'description' => '\_MI_GLOSSAIRE_MIMETYPES_IMAGE_DESC',
    'formtype'    => 'select_multi',
    'valuetype'   => 'array',
    'default'     => ['image/gif','image/jpg',  'image/jpeg', 'image/png'],
    'options'     => ['bmp' => 'image/bmp','gif' => 'image/gif','pjpeg' => 'image/pjpeg', 'jpeg' => 'image/jpeg','jpg' => 'image/jpg','jpe' => 'image/jpe', 'png' => 'image/png'],
];
$modversion['config'][] = [
    'name'        => 'maxwidth_image',
    'title'       => '\_MI_GLOSSAIRE_MAXWIDTH_IMAGE',
    'description' => '\_MI_GLOSSAIRE_MAXWIDTH_IMAGE_DESC',
    'formtype'    => 'textbox',
    'valuetype'   => 'int',
    'default'     => 500,
];
$modversion['config'][] = [
    'name'        => 'maxheight_image',
    'title'       => '\_MI_GLOSSAIRE_MAXHEIGHT_IMAGE',
    'description' => '\_MI_GLOSSAIRE_MAXHEIGHT_IMAGE_DESC',
    'formtype'    => 'textbox',
    'valuetype'   => 'int',
    'default'     => 500,
];

// ------------------- fichiers ------------------- //
$modversion['config'][] = glossaire_getBreakLine('file');

// Uploads : maxsize of file
$modversion['config'][] = [
    'name'        => 'maxsize_file',
    'title'       => '\_MI_GLOSSAIRE_MAXSIZE_FILE',
    'description' => '\_MI_GLOSSAIRE_MAXSIZE_FILE_DESC',
    'formtype'    => 'select',
    'valuetype'   => 'int',
    'default'     => 262144000, //$optionMaxsize['250 Mo'], 
    'options'     => $optionMaxsize,
];

// Uploads : mimetypes of file
$modversion['config'][] = [
    'name'        => 'mimetypes_file',
    'title'       => '\_MI_GLOSSAIRE_MIMETYPES_FILE',
    'description' => '\_MI_GLOSSAIRE_MIMETYPES_FILE_DESC',
    'formtype'    => 'select_multi',
    'valuetype'   => 'array',
    'default'     => ['application/pdf', 'application/zip', 'text/comma-separated-values', 'text/plain', 'image/gif', 'image/jpeg', 'image/png'],
    'options'     => ['gif' => 'image/gif','pjpeg' => 'image/pjpeg', 'jpeg' => 'image/jpeg','jpg' => 'image/jpg','jpe' => 'image/jpe', 'png' => 'image/png', 'pdf' => 'application/pdf','zip' => 'application/zip','csv' => 'text/comma-separated-values', 'txt' => 'text/plain', 'xml' => 'application/xml', 'xlsx' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet', 'docx' => 'application/vnd.openxmlformats-officedocument.wordprocessingml.document'],
];
/////////////////////////////////////////////////////////////
// Get groups
$modversion['config'][] = glossaire_getBreakLine('group');

$memberHandler = \xoops_getHandler('member');
$xoopsGroups  = $memberHandler->getGroupList();
$groups = [];
foreach ($xoopsGroups as $key => $group) {
    $groups[$group]  = $key;
}
// General access groups
$modversion['config'][] = [
    'name'        => 'groups',
    'title'       => '\_MI_GLOSSAIRE_GROUPS',
    'description' => '\_MI_GLOSSAIRE_GROUPS_DESC',
    'formtype'    => 'select_multi',
    'valuetype'   => 'array',
    'default'     => $groups,
    'options'     => $groups,
];
// Upload groups
$modversion['config'][] = [
    'name'        => 'upload_groups',
    'title'       => '\_MI_GLOSSAIRE_UPLOAD_GROUPS',
    'description' => '\_MI_GLOSSAIRE_UPLOAD_GROUPS_DESC',
    'formtype'    => 'select_multi',
    'valuetype'   => 'array',
    'default'     => $groups,
    'options'     => $groups,
];
// Get Admin groups
$crGroups = new \CriteriaCompo();
$crGroups->add(new \Criteria('group_type', 'Admin'));
$memberHandler = \xoops_getHandler('member');
$adminXoopsGroups  = $memberHandler->getGroupList($crGroups);
$adminGroups = [];
foreach ($adminXoopsGroups as $key => $adminGroup) {
    $adminGroups[$adminGroup]  = $key;
}
$modversion['config'][] = [
    'name'        => 'admin_groups',
    'title'       => '\_MI_GLOSSAIRE_ADMIN_GROUPS',
    'description' => '\_MI_GLOSSAIRE_ADMIN_GROUPS_DESC',
    'formtype'    => 'select_multi',
    'valuetype'   => 'array',
    'default'     => $adminGroups,
    'options'     => $adminGroups,
];
unset($crGroups);

// ------------------- alphabarre ------------------- //
$modversion['config'][] = glossaire_getBreakLine('alphabarre');

$modversion['config'][] = [
    'name'        => 'alphabarre',
    'title'       => '\_MI_GLOSSAIRE_ALPHABARRE',
    'description' => '\_MI_GLOSSAIRE_ALPHABARRE_DESC',
    'formtype'    => 'textbox',
    'valuetype'   => 'text',
    'default'     => '*ABCDEFGHIJKLMNOPQRSTUVWXYZ#',
];

$modversion['config'][] = [
    'name'        => 'alphabarre_mode',
    'title'       => '\_MI_GLOSSAIRE_ALPHABARRE_MODE',
    'description' => '\_MI_GLOSSAIRE_ALPHABARRE_MODE_DESC',
    'formtype'    => 'yesno',
    'valuetype'   => 'int',
    'default'     => 1,
];

$modversion['config'][] = [
    'name'        => 'letter_css_default',
    'title'       => '\_MI_GLOSSAIRE_ALPHABARRE_LETTER_DEFAULT',
    'description' => '\_MI_GLOSSAIRE_ALPHABARRE_LETTER_DEFAULT_DESC',
    'formtype'    => 'textbox',
    'valuetype'   => 'text',
    'default'     => 'font-size:1.5em;margin-left:3px;margin-right:3px;',
];

$modversion['config'][] = [
    'name'        => 'letter_css_selected',
    'title'       => '\_MI_GLOSSAIRE_ALPHABARRE_LETTER_SELECTED',
    'description' => '\_MI_GLOSSAIRE_ALPHABARRE_LETTER_SELECTED_DESC',
    'formtype'    => 'textbox',
    'valuetype'   => 'text',
    'default'     => 'font-weight:bold;color:red;text-decoration:underline;underline red;',
];

$modversion['config'][] = [
    'name'        => 'letter_css_exist',
    'title'       => '\_MI_GLOSSAIRE_ALPHABARRE_LETTER_EXIST',
    'description' => '\_MI_GLOSSAIRE_ALPHABARRE_LETTER_EXIST_DESC',
    'formtype'    => 'textbox',
    'valuetype'   => 'text',
    'default'     => 'font-weight:bold;',
];

$modversion['config'][] = [
    'name'        => 'letter_css_notexist',
    'title'       => '\_MI_GLOSSAIRE_ALPHABARRE_LETTER_NOT_EXIST',
    'description' => '\_MI_GLOSSAIRE_ALPHABARRE_LETTER_NOT_EXIST_DESC',
    'formtype'    => 'textbox',
    'valuetype'   => 'text',
    'default'     => 'color: #bfc9ca;',
];

$modversion['config'][] = [
    'name'        => 'replace_arobase',
    'title'       => '\_MI_GLOSSAIRE_REPLACE_AROBASE',
    'description' => '\_MI_GLOSSAIRE_REPLACE_AROBASE_DESC',
    'formtype'    => 'textbox',
    'valuetype'   => 'text',
    'default'     => '[@]',
];

// ------------------- interface ------------------- //
$modversion['config'][] = glossaire_getBreakLine('interface');

$modversion['config'][] = [
    'name'        => 'search_mode',
    'title'       => '_MI_GLOSSAIRE_SEARCH_MODE',
    'description' => '_MI_GLOSSAIRE_SEARCH_MODE_DESC',
    'formtype'    => 'select',
    'valuetype'   => 'int',
    'default'     => 0,
    'options'     => array(_MI_GLOSSAIRE_SEARCH_MODE_GLOBAL => 0,
                           _MI_GLOSSAIRE_SEARCH_MODE_LOCAL  => 1)
];

// Admin pager
$modversion['config'][] = [
    'name'        => 'adminpager',
    'title'       => '\_MI_GLOSSAIRE_ADMIN_PAGER',
    'description' => '\_MI_GLOSSAIRE_ADMIN_PAGER_DESC',
    'formtype'    => 'textbox',
    'valuetype'   => 'int',
    'default'     => 10,
];
// User pager
$modversion['config'][] = [
    'name'        => 'userpager',
    'title'       => '\_MI_GLOSSAIRE_USER_PAGER',
    'description' => '\_MI_GLOSSAIRE_USER_PAGER_DESC',
    'formtype'    => 'textbox',
    'valuetype'   => 'int',
    'default'     => 10,
];
// Show Breadcrumbs
$modversion['config'][] = [
    'name'        => 'show_breadcrumbs',
    'title'       => '\_MI_GLOSSAIRE_SHOW_BREADCRUMBS',
    'description' => '\_MI_GLOSSAIRE_SHOW_BREADCRUMBS_DESC',
    'formtype'    => 'yesno',
    'valuetype'   => 'int',
    'default'     => 1,
];
$modversion['config'][] = [
    'name'        => 'posButtonsActions',
    'title'       => '\_MI_GLOSSAIRE_BTN_ACTION_POS',
    'description' => '\_MI_GLOSSAIRE_BTN_ACTION_POS_DESC',
    'formtype'    => 'select',
    'valuetype'   => 'int',
    'default'     => 1,
    'options'     => [_MI_GLOSSAIRE_BTN_ACTION_POS_NONE    => 0,
                      _MI_GLOSSAIRE_BTN_ACTION_POS_TOP     => 1, 
                      _MI_GLOSSAIRE_BTN_ACTION_POS_BOTTOM  => 2, 
                      _MI_GLOSSAIRE_BTN_ACTION_POS_ALL     => 3],
];

$modversion['config'][] = [
    'name' => 'displayTemplateName',
    'title'       => '_MI_GLOSSAIRE_SHOW_TPL_NAME',
    'description' => '_MI_GLOSSAIRE_SHOW_TPL_NAME_DESC',
    'formtype'    => 'yesno',
    'valuetype'   => 'int',
    'default'     => 0];
    
$modversion['config'][] = [
    'name' => 'showId',
    'title'       => '_MI_GLOSSAIRE_SHOW_ID',
    'description' => '_MI_GLOSSAIRE_SHOW_ID_DESC',
    'formtype'    => 'yesno',
    'valuetype'   => 'int',
    'default'     => 0];



$modversion['config'][] = glossaire_getBreakLine('extra');
// Keywords
$modversion['config'][] = [
    'name'        => 'keywords',
    'title'       => '\_MI_GLOSSAIRE_KEYWORDS',
    'description' => '\_MI_GLOSSAIRE_KEYWORDS_DESC',
    'formtype'    => 'textbox',
    'valuetype'   => 'text',
    'default'     => 'glossaire, categories, entries',
];

// Bookmarks
$modversion['config'][] = [
    'name'        => 'bookmarks',
    'title'       => '\_MI_GLOSSAIRE_BOOKMARKS',
    'description' => '\_MI_GLOSSAIRE_BOOKMARKS_DESC',
    'formtype'    => 'yesno',
    'valuetype'   => 'int',
    'default'     => 0,
];

// ------------------- Notifications ------------------- //
$modversion['config'][] = [
    'name'        => 'gls_break_notification',
    'title'       => '_MI_GLOSSAIRE_BREAK_NOTIFICATION',
    'description' => '_MI_GLOSSAIRE_BREAK_NOTIFICATION_DESC',
    'formtype'    => 'line_break',
    'valuetype'   => 'textbox',
    'default'     => 'head',
];

$modversion['hasNotification'] = 1;
$modversion['notification'] = [
    'lookup_file' => 'include/notification.inc.php',
    'lookup_func' => 'glossaire_notify_iteminfo',
];
// Categories of notification
// Global Notify
$modversion['notification']['category'][] = [
    'name'           => 'global',
    'title'          => \_MI_GLOSSAIRE_NOTIFY_GLOBAL,
    'description'    => '',
    'subscribe_from' => ['index.php', 'categories.php', 'entries.php'],
];
// Category Notify
$modversion['notification']['category'][] = [
    'name'           => 'categories',
    'title'          => \_MI_GLOSSAIRE_NOTIFY_CATEGORY,
    'description'    => '',
    'subscribe_from' => 'categories.php',
    'item_name'      => 'cat_id',
    'allow_bookmark' => 1,
];
// Entry Notify
$modversion['notification']['category'][] = [
    'name'           => 'entries',
    'title'          => \_MI_GLOSSAIRE_NOTIFY_ENTRY,
    'description'    => '',
    'subscribe_from' => 'entries.php',
    'item_name'      => 'ent_id',
    'allow_bookmark' => 1,
];
// Global events notification
// GLOBAL_NEW Notify
$modversion['notification']['event'][] = [
    'name'          => 'global_new',
    'category'      => 'global',
    'admin_only'    => 0,
    'title'         => \_MI_GLOSSAIRE_NOTIFY_GLOBAL_NEW,
    'caption'       => \_MI_GLOSSAIRE_NOTIFY_GLOBAL_NEW_CAPTION,
    'description'   => '',
    'mail_template' => 'global_new_notify',
    'mail_subject'  => \_MI_GLOSSAIRE_NOTIFY_GLOBAL_NEW_SUBJECT,
];
// GLOBAL_MODIFY Notify
$modversion['notification']['event'][] = [
    'name'          => 'global_modify',
    'category'      => 'global',
    'admin_only'    => 0,
    'title'         => \_MI_GLOSSAIRE_NOTIFY_GLOBAL_MODIFY,
    'caption'       => \_MI_GLOSSAIRE_NOTIFY_GLOBAL_MODIFY_CAPTION,
    'description'   => '',
    'mail_template' => 'global_modify_notify',
    'mail_subject'  => \_MI_GLOSSAIRE_NOTIFY_GLOBAL_MODIFY_SUBJECT,
];
// GLOBAL_DELETE Notify
$modversion['notification']['event'][] = [
    'name'          => 'global_delete',
    'category'      => 'global',
    'admin_only'    => 0,
    'title'         => \_MI_GLOSSAIRE_NOTIFY_GLOBAL_DELETE,
    'caption'       => \_MI_GLOSSAIRE_NOTIFY_GLOBAL_DELETE_CAPTION,
    'description'   => '',
    'mail_template' => 'global_delete_notify',
    'mail_subject'  => \_MI_GLOSSAIRE_NOTIFY_GLOBAL_DELETE_SUBJECT,
];
// GLOBAL_APPROVE Notify
$modversion['notification']['event'][] = [
    'name'          => 'global_approve',
    'category'      => 'global',
    'admin_only'    => 1,
    'title'         => \_MI_GLOSSAIRE_NOTIFY_GLOBAL_APPROVE,
    'caption'       => \_MI_GLOSSAIRE_NOTIFY_GLOBAL_APPROVE_CAPTION,
    'description'   => '',
    'mail_template' => 'global_approve_notify',
    'mail_subject'  => \_MI_GLOSSAIRE_NOTIFY_GLOBAL_APPROVE_SUBJECT,
];
// Event notifications for items
// CATEGORY_MODIFY Notify
$modversion['notification']['event'][] = [
    'name'          => 'category_modify',
    'category'      => 'categories',
    'admin_only'    => 0,
    'title'         => \_MI_GLOSSAIRE_NOTIFY_CATEGORY_MODIFY,
    'caption'       => \_MI_GLOSSAIRE_NOTIFY_CATEGORY_MODIFY_CAPTION,
    'description'   => '',
    'mail_template' => 'category_modify_notify',
    'mail_subject'  => \_MI_GLOSSAIRE_NOTIFY_CATEGORY_MODIFY_SUBJECT,
];
// CATEGORY_DELETE Notify
$modversion['notification']['event'][] = [
    'name'          => 'category_delete',
    'category'      => 'categories',
    'admin_only'    => 0,
    'title'         => \_MI_GLOSSAIRE_NOTIFY_CATEGORY_DELETE,
    'caption'       => \_MI_GLOSSAIRE_NOTIFY_CATEGORY_DELETE_CAPTION,
    'description'   => '',
    'mail_template' => 'category_delete_notify',
    'mail_subject'  => \_MI_GLOSSAIRE_NOTIFY_CATEGORY_DELETE_SUBJECT,
];
// CATEGORY_APPROVE Notify
$modversion['notification']['event'][] = [
    'name'          => 'category_approve',
    'category'      => 'categories',
    'admin_only'    => 0,
    'title'         => \_MI_GLOSSAIRE_NOTIFY_CATEGORY_APPROVE,
    'caption'       => \_MI_GLOSSAIRE_NOTIFY_CATEGORY_APPROVE_CAPTION,
    'description'   => '',
    'mail_template' => 'category_approve_notify',
    'mail_subject'  => \_MI_GLOSSAIRE_NOTIFY_CATEGORY_APPROVE_SUBJECT,
];
// ENTRY_MODIFY Notify
$modversion['notification']['event'][] = [
    'name'          => 'entry_modify',
    'category'      => 'entries',
    'admin_only'    => 0,
    'title'         => \_MI_GLOSSAIRE_NOTIFY_ENTRY_MODIFY,
    'caption'       => \_MI_GLOSSAIRE_NOTIFY_ENTRY_MODIFY_CAPTION,
    'description'   => '',
    'mail_template' => 'entry_modify_notify',
    'mail_subject'  => \_MI_GLOSSAIRE_NOTIFY_ENTRY_MODIFY_SUBJECT,
];
// ENTRY_DELETE Notify
$modversion['notification']['event'][] = [
    'name'          => 'entry_delete',
    'category'      => 'entries',
    'admin_only'    => 0,
    'title'         => \_MI_GLOSSAIRE_NOTIFY_ENTRY_DELETE,
    'caption'       => \_MI_GLOSSAIRE_NOTIFY_ENTRY_DELETE_CAPTION,
    'description'   => '',
    'mail_template' => 'entry_delete_notify',
    'mail_subject'  => \_MI_GLOSSAIRE_NOTIFY_ENTRY_DELETE_SUBJECT,
];
// ENTRY_APPROVE Notify
$modversion['notification']['event'][] = [
    'name'          => 'entry_approve',
    'category'      => 'entries',
    'admin_only'    => 0,
    'title'         => \_MI_GLOSSAIRE_NOTIFY_ENTRY_APPROVE,
    'caption'       => \_MI_GLOSSAIRE_NOTIFY_ENTRY_APPROVE_CAPTION,
    'description'   => '',
    'mail_template' => 'entry_approve_notify',
    'mail_subject'  => \_MI_GLOSSAIRE_NOTIFY_ENTRY_APPROVE_SUBJECT,
];
