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
 * @author         XOOPS Development Team - Email:<jjdelalandre@orange.fr> - Website:<jubile.fr>
 */

require_once __DIR__ . '/common.php';

// ---------------- Admin Main ----------------
\define('_MI_GLOSSAIRE_NAME', "Glossaire");
\define('_MI_GLOSSAIRE_DESC', "Module de gestion d'un glossaire");
// ---------------- Admin Menu ----------------
\define('_MI_GLOSSAIRE_ADMENU1', "Dashboard");
\define('_MI_GLOSSAIRE_ADMENU2', "Categories");
\define('_MI_GLOSSAIRE_ADMENU3', "Entries");
\define('_MI_GLOSSAIRE_ADMENU4', "Permissions");
\define('_MI_GLOSSAIRE_ADMENU5', "Clone");
\define('_MI_GLOSSAIRE_ADMENU6', "Feedback");
\define('_MI_GLOSSAIRE_ABOUT', "About");
// ---------------- Admin Nav ----------------
\define('_MI_GLOSSAIRE_ADMIN_PAGER', "Admin pager");
\define('_MI_GLOSSAIRE_ADMIN_PAGER_DESC', "Admin per page list");
// User
\define('_MI_GLOSSAIRE_USER_PAGER', "User pager");
\define('_MI_GLOSSAIRE_USER_PAGER_DESC', "User per page list");
// Submenu
\define('_MI_GLOSSAIRE_SMNAME1', "Index page");
\define('_MI_GLOSSAIRE_SMNAME2', "Categories");
\define('_MI_GLOSSAIRE_SMNAME3', "Submit Categories");
\define('_MI_GLOSSAIRE_SMNAME4', "Entries");
\define('_MI_GLOSSAIRE_SMNAME5', "Submit Entries");
\define('_MI_GLOSSAIRE_SMNAME6', "Search");
// Blocks
\define('_MI_GLOSSAIRE_CATEGORIES_BLOCK', "Categories block");
\define('_MI_GLOSSAIRE_CATEGORIES_BLOCK_DESC', "Categories block description");
\define('_MI_GLOSSAIRE_CATEGORIES_BLOCK_CATEGORY', "Categories block CATEGORY");
\define('_MI_GLOSSAIRE_CATEGORIES_BLOCK_CATEGORY_DESC', "Categories block CATEGORY description");
\define('_MI_GLOSSAIRE_ENTRIES_BLOCK', "Entries block");
\define('_MI_GLOSSAIRE_ENTRIES_BLOCK_DESC', "Entries block description");
\define('_MI_GLOSSAIRE_ENTRIES_BLOCK_ENTRY', "Entries block  ENTRY");
\define('_MI_GLOSSAIRE_ENTRIES_BLOCK_ENTRY_DESC', "Entries block  ENTRY description");
\define('_MI_GLOSSAIRE_ENTRIES_BLOCK_LAST', "Entries block last");
\define('_MI_GLOSSAIRE_ENTRIES_BLOCK_LAST_DESC', "Entries block last description");
\define('_MI_GLOSSAIRE_ENTRIES_BLOCK_NEW', "Entries block new");
\define('_MI_GLOSSAIRE_ENTRIES_BLOCK_NEW_DESC', "Entries block new description");
\define('_MI_GLOSSAIRE_ENTRIES_BLOCK_HITS', "Entries block hits");
\define('_MI_GLOSSAIRE_ENTRIES_BLOCK_HITS_DESC', "Entries block hits description");
\define('_MI_GLOSSAIRE_ENTRIES_BLOCK_TOP', "Entries block top");
\define('_MI_GLOSSAIRE_ENTRIES_BLOCK_TOP_DESC', "Entries block top description");
\define('_MI_GLOSSAIRE_ENTRIES_BLOCK_RANDOM', "Entries block random");
\define('_MI_GLOSSAIRE_ENTRIES_BLOCK_RANDOM_DESC', "Entries block random description");
// Config
\define('_MI_GLOSSAIRE_EDITOR_ADMIN', "Editor admin");
\define('_MI_GLOSSAIRE_EDITOR_ADMIN_DESC', "Select the editor which should be used in admin area for text area fields");
\define('_MI_GLOSSAIRE_EDITOR_USER', "Editor user");
\define('_MI_GLOSSAIRE_EDITOR_USER_DESC', "Select the editor which should be used in user area for text area fields");
\define('_MI_GLOSSAIRE_EDITOR_MAXCHAR', "Text max characters");
\define('_MI_GLOSSAIRE_EDITOR_MAXCHAR_DESC', "Max characters for showing text of a textarea or editor field in admin area");
\define('_MI_GLOSSAIRE_KEYWORDS', "Keywords");
\define('_MI_GLOSSAIRE_KEYWORDS_DESC', "Insert here the keywords (separate by comma)");
\define('_MI_GLOSSAIRE_SIZE_MB', "MB");
\define('_MI_GLOSSAIRE_MAXSIZE_IMAGE', "Max size image");
\define('_MI_GLOSSAIRE_MAXSIZE_IMAGE_DESC', "Define the max size for uploading images");
\define('_MI_GLOSSAIRE_MIMETYPES_IMAGE', "Mime types image");
\define('_MI_GLOSSAIRE_MIMETYPES_IMAGE_DESC', "Define the allowed mime types for uploading images");
\define('_MI_GLOSSAIRE_MAXWIDTH_IMAGE', "Max width image");
\define('_MI_GLOSSAIRE_MAXWIDTH_IMAGE_DESC', "Set the max width to which uploaded images should be scaled (in pixel)<br>0 means, that images keeps the original size. <br>If an image is smaller than maximum value then the image will be not enlarge, it will be save in original width.");
\define('_MI_GLOSSAIRE_MAXHEIGHT_IMAGE', "Max height image");
\define('_MI_GLOSSAIRE_MAXHEIGHT_IMAGE_DESC', "Set the max height to which uploaded images should be scaled (in pixel)<br>0 means, that images keeps the original size. <br>If an image is smaller than maximum value then the image will be not enlarge, it will be save in original height");
\define('_MI_GLOSSAIRE_NUMB_COL', "Number Columns");
\define('_MI_GLOSSAIRE_NUMB_COL_DESC', "Number Columns to View");
\define('_MI_GLOSSAIRE_DIVIDEBY', "Divide By");
\define('_MI_GLOSSAIRE_DIVIDEBY_DESC', "Divide by columns number");
\define('_MI_GLOSSAIRE_TABLE_TYPE', "Table Type");
\define('_MI_GLOSSAIRE_TABLE_TYPE_DESC', "Table Type is the bootstrap html table");
\define('_MI_GLOSSAIRE_PANEL_TYPE', "Panel Type");
\define('_MI_GLOSSAIRE_PANEL_TYPE_DESC', "Panel Type is the bootstrap html div");
\define('_MI_GLOSSAIRE_IDPAYPAL', "Paypal ID");
\define('_MI_GLOSSAIRE_IDPAYPAL_DESC', "Insert here your PayPal ID for donations");
\define('_MI_GLOSSAIRE_SHOW_BREADCRUMBS', "Show breadcrumb navigation");
\define('_MI_GLOSSAIRE_SHOW_BREADCRUMBS_DESC', "Show breadcrumb navigation which displays the current page in context within the site structure");
\define('_MI_GLOSSAIRE_ADVERTISE', "Advertisement Code");
\define('_MI_GLOSSAIRE_ADVERTISE_DESC', "Insert here the advertisement code");
\define('_MI_GLOSSAIRE_MAINTAINEDBY', "Maintained By");
\define('_MI_GLOSSAIRE_MAINTAINEDBY_DESC', "Allow url of support site or community");
\define('_MI_GLOSSAIRE_BOOKMARKS', "Social Bookmarks");
\define('_MI_GLOSSAIRE_BOOKMARKS_DESC', "Show Social Bookmarks in the single page");
// Global notifications
\define('_MI_GLOSSAIRE_NOTIFY_GLOBAL', "Global notification");
\define('_MI_GLOSSAIRE_NOTIFY_GLOBAL_NEW', "Any new item");
\define('_MI_GLOSSAIRE_NOTIFY_GLOBAL_NEW_CAPTION', "Notify me about any new item");
\define('_MI_GLOSSAIRE_NOTIFY_GLOBAL_NEW_SUBJECT', "Notification about new item");
\define('_MI_GLOSSAIRE_NOTIFY_GLOBAL_MODIFY', "Any modified item");
\define('_MI_GLOSSAIRE_NOTIFY_GLOBAL_MODIFY_CAPTION', "Notify me about any item modification");
\define('_MI_GLOSSAIRE_NOTIFY_GLOBAL_MODIFY_SUBJECT', "Notification about modification");
\define('_MI_GLOSSAIRE_NOTIFY_GLOBAL_DELETE', "Any deleted item");
\define('_MI_GLOSSAIRE_NOTIFY_GLOBAL_DELETE_CAPTION', "Notify me about any deleted item");
\define('_MI_GLOSSAIRE_NOTIFY_GLOBAL_DELETE_SUBJECT', "Notification about deleted item");
\define('_MI_GLOSSAIRE_NOTIFY_GLOBAL_APPROVE', "Any item to approve");
\define('_MI_GLOSSAIRE_NOTIFY_GLOBAL_APPROVE_CAPTION', "Notify me about any item waiting for approvement");
\define('_MI_GLOSSAIRE_NOTIFY_GLOBAL_APPROVE_SUBJECT', "Notification about item waiting for approvement");
// Category notifications
\define('_MI_GLOSSAIRE_NOTIFY_CATEGORY', "Category notification");
\define('_MI_GLOSSAIRE_NOTIFY_CATEGORY_MODIFY', "Category modification");
\define('_MI_GLOSSAIRE_NOTIFY_CATEGORY_MODIFY_CAPTION', "Notify me about category modification");
\define('_MI_GLOSSAIRE_NOTIFY_CATEGORY_MODIFY_SUBJECT', "Notification about modification");
\define('_MI_GLOSSAIRE_NOTIFY_CATEGORY_DELETE', "Category deleted");
\define('_MI_GLOSSAIRE_NOTIFY_CATEGORY_DELETE_CAPTION', "Notify me about deleted categories");
\define('_MI_GLOSSAIRE_NOTIFY_CATEGORY_DELETE_SUBJECT', "Notification delete category");
\define('_MI_GLOSSAIRE_NOTIFY_CATEGORY_APPROVE', "Category approve");
\define('_MI_GLOSSAIRE_NOTIFY_CATEGORY_APPROVE_CAPTION', "Notify me about categories waiting for approvement");
\define('_MI_GLOSSAIRE_NOTIFY_CATEGORY_APPROVE_SUBJECT', "Notification category waiting for approvement");
// Entry notifications
\define('_MI_GLOSSAIRE_NOTIFY_ENTRY', "Entry notification");
\define('_MI_GLOSSAIRE_NOTIFY_ENTRY_MODIFY', "Entry modification");
\define('_MI_GLOSSAIRE_NOTIFY_ENTRY_MODIFY_CAPTION', "Notify me about entry modification");
\define('_MI_GLOSSAIRE_NOTIFY_ENTRY_MODIFY_SUBJECT', "Notification about modification");
\define('_MI_GLOSSAIRE_NOTIFY_ENTRY_DELETE', "Entry deleted");
\define('_MI_GLOSSAIRE_NOTIFY_ENTRY_DELETE_CAPTION', "Notify me about deleted entries");
\define('_MI_GLOSSAIRE_NOTIFY_ENTRY_DELETE_SUBJECT', "Notification delete entry");
\define('_MI_GLOSSAIRE_NOTIFY_ENTRY_APPROVE', "Entry approve");
\define('_MI_GLOSSAIRE_NOTIFY_ENTRY_APPROVE_CAPTION', "Notify me about entries waiting for approvement");
\define('_MI_GLOSSAIRE_NOTIFY_ENTRY_APPROVE_SUBJECT', "Notification entry waiting for approvement");
// Permissions Groups
\define('_MI_GLOSSAIRE_GROUPS', "Groups access");
\define('_MI_GLOSSAIRE_GROUPS_DESC', "Select general access permission for groups.");
\define('_MI_GLOSSAIRE_ADMIN_GROUPS', "Admin Group Permissions");
\define('_MI_GLOSSAIRE_ADMIN_GROUPS_DESC', "Which groups have access to tools and permissions page");
\define('_MI_GLOSSAIRE_UPLOAD_GROUPS', "Upload Group Permissions");
\define('_MI_GLOSSAIRE_UPLOAD_GROUPS_DESC', "Which groups have permissions to upload files");

// ---------------- JJD ----------------

define('_MI_GLOSSAIRE_SHOW_TPL_NAME', "Afficher le nom des templates");
define('_MI_GLOSSAIRE_SHOW_TPL_NAME_DESC', "Option à utiliser pour le développement, la désactiver en production");
define('_MI_GLOSSAIRE_EXPORT', "Exportation");
define('_MI_GLOSSAIRE_IMPORT', "Importation");

\define('_MI_GLOSSAIRE_MAXSIZE_FILE', "Max size file");
\define('_MI_GLOSSAIRE_MAXSIZE_FILE_DESC', "Define the max size for uploading files");
\define('_MI_GLOSSAIRE_MIMETYPES_FILE', "Mime types file");
\define('_MI_GLOSSAIRE_MIMETYPES_FILE_DESC', "Define the allowed mime types for uploading files");
// ---------------- End ----------------
