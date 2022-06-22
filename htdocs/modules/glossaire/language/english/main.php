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

require_once __DIR__ . '/admin.php';

// ---------------- Main ----------------
\define('_MA_GLOSSAIRE_INDEX', "Overview Glossaire");
\define('_MA_GLOSSAIRE_TITLE', "Glossaire");
\define('_MA_GLOSSAIRE_DESC', "Module de gestion d'un glossaire");
\define('_MA_GLOSSAIRE_INDEX_DESC', "Welcome to the homepage of your new module Glossaire!<br>
As you can see, you have created a page with a list of links at the top to navigate between the pages of your module. This description is only visible on the homepage of this module, the other pages you will see the content you created when you built this module with the module ModuleBuilder, and after creating new content in admin of this module. In order to expand this module with other resources, just add the code you need to extend the functionality of the same. The files are grouped by type, from the header to the footer to see how divided the source code.<br><br>If you see this message, it is because you have not created content for this module. Once you have created any type of content, you will not see this message.<br><br>If you liked the module ModuleBuilder and thanks to the long process for giving the opportunity to the new module to be created in a moment, consider making a donation to keep the module ModuleBuilder and make a donation using this button <a href='https://xoops.org/modules/xdonations/index.php' title='Donation To Txmod Xoops'><img src='https://www.paypal.com/en_US/i/btn/btn_donate_LG.gif' alt='Button Donations' ></a><br>Thanks!<br><br>Use the link below to go to the admin and create content.");
\define('_MA_GLOSSAIRE_NO_PDF_LIBRARY', "Libraries TCPDF not there yet, upload them in root/Frameworks");
\define('_MA_GLOSSAIRE_NO', "No");
\define('_MA_GLOSSAIRE_DETAILS', "Show details");
\define('_MA_GLOSSAIRE_BROKEN', "Notify broken");
// ---------------- Contents ----------------
// Category
\define('_MA_GLOSSAIRE_CATEGORY', "Category");
\define('_MA_GLOSSAIRE_CATEGORY_ADD', "Add Category");
\define('_MA_GLOSSAIRE_CATEGORY_EDIT', "Edit Category");
\define('_MA_GLOSSAIRE_CATEGORY_DELETE', "Delete Category");
\define('_MA_GLOSSAIRE_CATEGORY_CLONE', "Clone Category");
\define('_MA_GLOSSAIRE_CATEGORIES', "Categories");
\define('_MA_GLOSSAIRE_CATEGORIES_LIST', "List of Categories");
\define('_MA_GLOSSAIRE_CATEGORIES_TITLE', "Categories title");
\define('_MA_GLOSSAIRE_CATEGORIES_DESC', "Categories description");
// Caption of Category
\define('_MA_GLOSSAIRE_CATEGORY_ID', "Id");
\define('_MA_GLOSSAIRE_CATEGORY_NAME', "Name");
\define('_MA_GLOSSAIRE_CATEGORY_DESCRIPTION', "Description");
\define('_MA_GLOSSAIRE_CATEGORY_TOTAL', "Total");
\define('_MA_GLOSSAIRE_CATEGORY_WEIGHT', "Weight");
\define('_MA_GLOSSAIRE_CATEGORY_LOGOURL', "Logourl");
\define('_MA_GLOSSAIRE_CATEGORY_DATE_CREATION', "Date_creation");
\define('_MA_GLOSSAIRE_CATEGORY_DATE_UPDATE', "Date_update");
// Entry
\define('_MA_GLOSSAIRE_ENTRY', "Entry");
\define('_MA_GLOSSAIRE_ENTRY_ADD', "Add Entry");
\define('_MA_GLOSSAIRE_ENTRY_EDIT', "Edit Entry");
\define('_MA_GLOSSAIRE_ENTRY_DELETE', "Delete Entry");
\define('_MA_GLOSSAIRE_ENTRY_CLONE', "Clone Entry");
\define('_MA_GLOSSAIRE_ENTRIES', "Entries");
\define('_MA_GLOSSAIRE_ENTRIES_LIST', "List of Entries");
\define('_MA_GLOSSAIRE_ENTRIES_TITLE', "Entries title");
\define('_MA_GLOSSAIRE_ENTRIES_DESC', "Entries description");
// Caption of Entry
\define('_MA_GLOSSAIRE_ENTRY_ID', "Id");
\define('_MA_GLOSSAIRE_ENTRY_CAT_ID', "Cat_id");
\define('_MA_GLOSSAIRE_ENTRY_UID', "Uid");
\define('_MA_GLOSSAIRE_ENTRY_TERM', "Term");
\define('_MA_GLOSSAIRE_ENTRY_SHORTDEF', "Shortdef");
\define('_MA_GLOSSAIRE_ENTRY_DEFINITION', "Definition");
\define('_MA_GLOSSAIRE_ENTRY_REFERENCE', "Reference");
\define('_MA_GLOSSAIRE_ENTRY_URL1', "Url1");
\define('_MA_GLOSSAIRE_ENTRY_URL2', "Url2");
\define('_MA_GLOSSAIRE_ENTRY_DATE_CREATION', "Date_creation");
\define('_MA_GLOSSAIRE_ENTRY_DATE_UPDATE', "Date_update");
\define('_MA_GLOSSAIRE_ENTRY_COUNTER', "Counter");
\define('_MA_GLOSSAIRE_ENTRY_STATUS', "Status");
\define('_MA_GLOSSAIRE_ENTRY_FLAG', "Flag");
\define('_MA_GLOSSAIRE_INDEX_THEREARE', "There are %s Entries");
\define('_MA_GLOSSAIRE_INDEX_LATEST_LIST', "Last Glossaire");
// Submit
\define('_MA_GLOSSAIRE_SUBMIT', "Submit");
// Form
\define('_MA_GLOSSAIRE_FORM_OK', "Successfully saved");
\define('_MA_GLOSSAIRE_FORM_DELETE_OK', "Successfully deleted");
\define('_MA_GLOSSAIRE_FORM_SURE_DELETE', "Are you sure to delete: <b><span style='color : Red;'>%s </span></b>");
\define('_MA_GLOSSAIRE_FORM_SURE_RENEW', "Are you sure to update: <b><span style='color : Red;'>%s </span></b>");
\define('_MA_GLOSSAIRE_INVALID_PARAM', 'Invalid parameter');
// Admin link
\define('_MA_GLOSSAIRE_ADMIN', "Admin");

// ---------------- JJD ----------------
\define('_MA_GLOSSAIRE_ALL', "Tout");
\define('_MA_GLOSSAIRE_ENTRY_NEW', "Ajouter un nouveau terme");
\define('_MA_GLOSSAIRE_TOP', "Haut de page");
\define('_MA_GLOSSAIRE_ENTRY_SEARCH', "Chercher");
\define('_MA_GLOSSAIRE_SEEALSO', "Voir aussi");
// ---------------- End ----------------
