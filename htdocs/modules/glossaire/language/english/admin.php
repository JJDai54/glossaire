<?php
   /**
 * Name: modinfo.php
 * Description:
 *
 * You may not change or alter any portion of this comment or credits
 * of supporting developers from this source code or any supporting source code
 * which is considered copyrighted (c) material of the original comment or credit authors.
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 *
 * @copyright The XOOPS Project http://sourceforge.net/projects/xoops/
 * @license http://www.fsf.org/copyleft/gpl.html GNU public license
 * @package : XOOPS
 * @Module : 
 * @subpackage : Menu Language
 * @since 2.5.7
 * @author Jean-Jacques DELALANDRE (jjdelalandre@orange.fr)
 * @version {version}
 * Traduction:  
 */
 
defined( 'XOOPS_ROOT_PATH' ) or die( 'Accès restreint' );

define('_AM_GLOSSAIRE_ABOUT_MAKE_DONATION', "Submit");
define('_AM_GLOSSAIRE_ACTIVATE', "Enable");
define('_AM_GLOSSAIRE_CAT_SHOW_BIN', "field ti show");
define('_AM_GLOSSAIRE_CATEGORY_ACTIVE_DESC', "<span style='color:red;'>If false the category will not be visible in the UI.</span>");
define('_AM_GLOSSAIRE_CATEGORY_ADD', "Add Category");
define('_AM_GLOSSAIRE_CATEGORY_BR_AFTER_TERME', "Newline after term");
define('_AM_GLOSSAIRE_CATEGORY_BR_AFTER_TERME_DESC', "Yes: the 'term' and 'short_def' fields will be on two lines.<br><No>the 'term' and 'short_def' fields will be on the same line.");
define('_AM_GLOSSAIRE_CATEGORY_CSS_OK', "Save CSS file ok");
define('_AM_GLOSSAIRE_CATEGORY_DATE_CREATION', "Creation");
define('_AM_GLOSSAIRE_CATEGORY_DATE_UPDATE', "Update");
define('_AM_GLOSSAIRE_CATEGORY_EDIT', "Edit Category");
define('_AM_GLOSSAIRE_CATEGORY_EDIT_CSS', "Editing styles for this category");
define('_AM_GLOSSAIRE_CATEGORY_ENTRIES', "Entries");
define('_AM_GLOSSAIRE_CATEGORY_FOLDER_DESC', "Glossary files and images upload folder in the \"uploads\" folder<br>The folder name must not contain special characters, accents, spaces, ...");
define('_AM_GLOSSAIRE_CATEGORY_ID', "Id");
define('_AM_GLOSSAIRE_CATEGORY_MAGNIFY_SD', "Magnify");
define('_AM_GLOSSAIRE_CATEGORY_MAGNIFY_SD_DESC', "Formats the short definition by bolding capital letters and letters preceded by a \"/\"<br>Editable default for category entries");
define('_AM_GLOSSAIRE_CATEGORY_TOTAL', "Total");
define('_AM_GLOSSAIRE_CATEGORY_UMLOAD_FOLDER', "Dossier des fichiers du glossaire");
define('_AM_GLOSSAIRE_CLEAN_ENTRIES_FILES', 'Clean attached files (%1\$s non-existent files, %2\$s unreferenced files)');
define('_AM_GLOSSAIRE_CLEAN_ENTRIES_IMAGES', 'Clean up images (%1\$s non-existent images, %2\$s unreferenced images)');
define('_AM_GLOSSAIRE_CLEAN_ENTRIES_IMAGES_OK', "Image cleanup: <br>%s definitions updated and %s image(s) removed<br>for category #%s.");
define('_AM_GLOSSAIRE_DATE_FORMAT', "Date format");
define('_AM_GLOSSAIRE_DATE_FORMAT_DESC', "See PHP help for more informations");
define('_AM_GLOSSAIRE_DELETE_FILE', "delete file");
define('_AM_GLOSSAIRE_DELETE_IMG', "Delete image");
define('_AM_GLOSSAIRE_DESACTIVATE', "Unsactiver");
define('_AM_GLOSSAIRE_DONATION_AMOUNT', "Donation Amount");
define('_AM_GLOSSAIRE_DOWNLOAD_OK', "Action completed successfully, the file is in your download folder.");
define('_AM_GLOSSAIRE_ENT_BTN_ACTIONS_BOTTOM', "Position at the bottom of the management buttons");
define('_AM_GLOSSAIRE_ENT_BTN_ACTIONS_TOP', "Position at the top of the management buttons");
define('_AM_GLOSSAIRE_ENT_LINK', "Link on term");
define('_AM_GLOSSAIRE_ENT_ADD_LINK_IN_URLS', "Ass link in \"voir aussi\"");
define('_AM_GLOSSAIRE_ENT_CREATOR', "Auteur");
define('_AM_GLOSSAIRE_ENT_DEFINITION', "Définition");
define('_AM_GLOSSAIRE_ENT_EMAIL', "Contact");
define('_AM_GLOSSAIRE_ENT_FILE_NAME', "Fichier joint");
define('_AM_GLOSSAIRE_ENT_HEADER', "Page header : Index and Search bar by letters");
define('_AM_GLOSSAIRE_ENT_ID', "ID");
define('_AM_GLOSSAIRE_ENT_IMAGE', "Image");
define('_AM_GLOSSAIRE_ENT_MAGNIFY', "Magnifier");
define('_AM_GLOSSAIRE_ENT_REFERENCE', "References");
define('_AM_GLOSSAIRE_ENT_SHORTDEF', "Définition courte");
define('_AM_GLOSSAIRE_ENT_URLS', "See also");
define('_AM_GLOSSAIRE_ENTRIES_UPDATE_OK', "update completed");
define('_AM_GLOSSAIRE_ENTRY_ADD', "Add Entry");
define('_AM_GLOSSAIRE_ENTRY_CURRENT_FILE', "Current file");
define('_AM_GLOSSAIRE_ENTRY_DATE_CREATION', "Creation date");
define('_AM_GLOSSAIRE_ENTRY_DATE_UPDATE', "Date updated");
define('_AM_GLOSSAIRE_ENTRY_FLAG', "Flag");
define('_AM_GLOSSAIRE_ENTRY_ID', "Id");
define('_AM_GLOSSAIRE_ENTRY_IMG_DESC', "Select an existing image or upload a new image.<br>Leave blank to keep the existing image.");
define('_AM_GLOSSAIRE_ENTRY_INITIALE', "Initiale");
define('_AM_GLOSSAIRE_ENTRY_MAGNIFY_SD', "Magnify");
define('_AM_GLOSSAIRE_ENTRY_MAGNIFY_SD_DESC', "Formats the short definition by putting the capital letters in bold as well as the letters preceded by a \"/\"");
define('_AM_GLOSSAIRE_ENTRY_UID', "Uid");
define('_AM_GLOSSAIRE_ENTRY_URL1', "Url1");
define('_AM_GLOSSAIRE_ENTRY_URL2', "Url2");
define('_AM_GLOSSAIRE_EXPORT', "Export");
define('_AM_GLOSSAIRE_EXPORT_AVERTISSEMENT', "Exportation : nettoyage des fichiers.");
define('_AM_GLOSSAIRE_EXPORT_AVERTISSEMENT_DESC', "<b>Important</b> : Pour alléger l'archive l'export effectue un nettoyage des fichiers images et fichiers joints inutiles<br>qui n'ont pas été supprimés correctement lors de modifications");
define('_AM_GLOSSAIRE_EXPORTER', "Exporter");
define('_AM_GLOSSAIRE_FILE_DESC', "A new category will be generated");
define('_AM_GLOSSAIRE_FILE_NAME', "File title");
define('_AM_GLOSSAIRE_FILE_TO_IMPORT', "File to import");
define('_AM_GLOSSAIRE_FILE_TO_IMPORT_DESC', "The file must be an archive exported by the 'glossary' module or one of its clones.<br>Use when the file is too big to import.<br>Copy the file via FTP into the 'uploads/ folder glossary/direct-imports'.");
define('_AM_GLOSSAIRE_FILE_TO_LOAD', "File to import");
define('_AM_GLOSSAIRE_IMPORT_ECHEC', "Import failed<br>%s");
define('_AM_GLOSSAIRE_IMPORT_FROM_FTP', "Direct import from 'mport-direct' folder");
define('_AM_GLOSSAIRE_IMPORT_FROM_GLOSSAIRE', "Importing an export from the Gossaire module or one of its clones");
define('_AM_GLOSSAIRE_IMPORT_FROM_LEXIKON', "Import of the Lexikon module (Lexikon must be installed)");
define('_AM_GLOSSAIRE_IMPORT_IN_NEW_CAT', "Import into a new category");
define('_AM_GLOSSAIRE_IMPORT_SUCCES', "Ok import in catIdSelect #%s");
define('_AM_GLOSSAIRE_INCLUDE_FILES', "include attached files");
define('_AM_GLOSSAIRE_INCLUDE_FILES_DESC', "If you don't include attachments the archive will be smaller.");
define('_AM_GLOSSAIRE_INCLUDE_IMG', "Include images");
define('_AM_GLOSSAIRE_INCLUDE_IMG_DESC', "If images are not included the archive will be lighter");
define('_AM_GLOSSAIRE_MAINTAINEDBY', " is maintained by ");
define('_AM_GLOSSAIRE_NB_COLUMNS_INDEX', "Nb index columns");
define('_AM_GLOSSAIRE_NB_COLUMNS_INDEX_DESC', "Number of columns for displaying the index for the current page.<br> > 0: number of columns for displaying the index (default = 1)<br>&nbsp;0: Continuous display separated by ' | '<br>-1: no index display");
define('_AM_GLOSSAIRE_NO_CATEGORIES1', "There are no categories created.<br>You must first create a category before adding definitions.");
define('_AM_GLOSSAIRE_NO_CATEGORIES2', "There are no categories to export.");
define('_AM_GLOSSAIRE_PERM_CLONE', "Clone Module");
define('_AM_GLOSSAIRE_PERM_DESC', "Manage Permissions");
define('_AM_GLOSSAIRE_PERM_EXPORT', "Export Glossary");
define('_AM_GLOSSAIRE_PERM_GLOBAL_AC', "Global Permissions");
define('_AM_GLOSSAIRE_PERM_IMPORT', "Import Glossary");
define('_AM_GLOSSAIRE_PERM_MANCATS', "Manage Categories");
define('_AM_GLOSSAIRE_PERM_PERMS', "Manage Permissions");
define('_AM_GLOSSAIRE_PERM_VIEW_CATS', "View Categories");
define('_AM_GLOSSAIRE_PERMISSIONS', "Permissions");
define('_AM_GLOSSAIRE_REPLACE_AROBASE', "Remplacer l'arobase");
define('_AM_GLOSSAIRE_REPLACE_AROBASE_DESC', "Allows you to block direct access to emails on pages.<br>example: [@]");
define('_AM_GLOSSAIRE_SELECT_CATEGORY_DESC', "Select a destination category for these new definitions.");
define('_AM_GLOSSAIRE_SELECT_LEX_CATEGORY', "Categorie de Lexikon");
define('_AM_GLOSSAIRE_SELECT_LEX_CATEGORY_DESC', "Select the category of the Lexikon module to import");
define('_AM_GLOSSAIRE_STATISTICS', "Statistics");
define('_AM_GLOSSAIRE_STYLES_GLS_ENT_CREATOR', "Auteur");
define('_AM_GLOSSAIRE_STYLES_GLS_ENT_DATE_UPDATE', "Date de mise à jour");
define('_AM_GLOSSAIRE_STYLES_GLS_ENT_DEFINITION', "Définition");
define('_AM_GLOSSAIRE_STYLES_GLS_ENT_EMAIL', "Courriel");
define('_AM_GLOSSAIRE_STYLES_GLS_ENT_FILE_NAME', "Fichier joint");
define('_AM_GLOSSAIRE_STYLES_GLS_ENT_FILES_JOINS', "Fichiers joints");
define('_AM_GLOSSAIRE_STYLES_GLS_ENT_INDEX_DIV', "Index des termes en liste");
define('_AM_GLOSSAIRE_STYLES_GLS_ENT_INDEX_TABLE', "<hr>Index des termes en colonnes");
define('_AM_GLOSSAIRE_STYLES_GLS_ENT_REFERENCE', "Références");
define('_AM_GLOSSAIRE_STYLES_GLS_ENT_SHORTDEF', "Définition courte");
define('_AM_GLOSSAIRE_STYLES_GLS_ENT_TERM', "<hr>Terme");
define('_AM_GLOSSAIRE_STYLES_GLS_ENT_URLS', "URL to visit");
define('_AM_GLOSSAIRE_STYLES_GLS_LETTER_DEFAULT', "Alphabet: Default letters");
define('_AM_GLOSSAIRE_STYLES_GLS_LETTER_EMPTY', "Alphabet: Missing letters");
define('_AM_GLOSSAIRE_STYLES_GLS_LETTER_EXIST', "Alphabet: Existing letters");
define('_AM_GLOSSAIRE_STYLES_GLS_LETTER_SELECTED', "Alphabet: Selected letter");
define('_AM_GLOSSAIRE_STYLES_GLS_ENT_DATES', "Dates");
define('_AM_GLOSSAIRE_STYLES_GLS_ENT_COUNTER', "Counter");
define('_AM_GLOSSAIRE_STYLES_GLS_LETTER_SELECED', "Selected letter");
define('_AM_GLOSSAIRE_STYLES_GLS_STYLE_SHEET', "Style sheet");
define('_AM_GLOSSAIRE_STYLES_INIT_STYLE_SHEET', "Init style sheet");
define('_AM_GLOSSAIRE_FORM_SURE_INIT_CSS', "Confirmer l'initialize la feuille de style de %s [%s]");

define('_AM_GLOSSAIRE_SUBMIT_AND_ADDNEW', "Submit and add");
define('_AM_GLOSSAIRE_THEREARE_CATEGORIES', "There are <span class='bold'>%s</span> categories in the database");
define('_AM_GLOSSAIRE_THEREARE_ENTRIES', "There are <span class='bold'>%s</span> entries in the database");
define('_AM_GLOSSAIRE_THEREARENT_CATEGORIES', "There aren't categories");
define('_AM_GLOSSAIRE_THEREARENT_ENTRIES', "There aren't entries");
define('_AM_GLOSSAIRE_TOTAL', "Total");
define('_AM_GLOSSAIRE_WEIGHT_UPDATE', "The weight has been updated");
define('_AM_GLOSSAIRE_CATEGORY_ACTIVE', "Actif");
define('_AM_GLOSSAIRE_CATEGORY_COLOR_SET', "Color scheme");
define('_AM_GLOSSAIRE_CATEGORY_FOLDER', "Dossier");
define('_AM_GLOSSAIRE_CATEGORY_LOGO', "Logo");
define('_AM_GLOSSAIRE_CATEGORY_NAME', "Name");
define('_AM_GLOSSAIRE_CATEGORY_WEIGHT', "Weight");
define('_AM_GLOSSAIRE_DOWN', "Down");
define('_AM_GLOSSAIRE_EDIT_CSS', "Edit CSS");
define('_AM_GLOSSAIRE_ENTRIES', "Entries");
define('_AM_GLOSSAIRE_ENTRY_EDIT', "Edit Entry");
define('_AM_GLOSSAIRE_ENTRY_EMAIL', "E-mail");
define('_AM_GLOSSAIRE_ENTRY_EMAIL_DESC', "Contact by email.");
define('_AM_GLOSSAIRE_ENTRY_FILE', "File");
define('_AM_GLOSSAIRE_ENTRY_IMAGE_UPLOADS', "Image in %s :");
define('_AM_GLOSSAIRE_ENTRY_IMG_DESC2', "Select an image in your environment or leave empty.");
define('_AM_GLOSSAIRE_ENTRY_REFERENCES_DESC', "Sources, Address, telephone and any useful information");
define('_AM_GLOSSAIRE_ENTRY_URLS', "Reference sites");
define('_AM_GLOSSAIRE_ENTRY_URLS_DESC', "Enter one URL per line without separator. Each line can be composed of the title and the url separated by a '|' without spaces.<br>Example: <br>Xoops France<b> | </b>https://www.frxoops.org/");
define('_AM_GLOSSAIRE_FIRST', "Premier");
define('_AM_GLOSSAIRE_FORM_ACTIONS', "Actions");
define('_AM_GLOSSAIRE_FORM_DELETE_OK', "Successfully deleted");
define('_AM_GLOSSAIRE_FORM_SURE_DELETE', "Are you sure to delete: <b><span style='color : Red;'>[%s] %s</span></b>");
define('_AM_GLOSSAIRE_LAST', "Last");
define('_AM_GLOSSAIRE_PERM_APPROVE_ENTRIES', "Approve Entries");
define('_AM_GLOSSAIRE_RAZ_COUNTERS', "Reset counters");
define('_AM_GLOSSAIRE_UP', "Up");
define('_AM_GLOSSAIRE_ADD_CATEGORY', "Add New Category");
define('_AM_GLOSSAIRE_ADD_ENTRY', "Add New Entry");
define('_AM_GLOSSAIRE_CATEGORY_DESCRIPTION', "Description");
define('_AM_GLOSSAIRE_ENT_COUNTER', "Compteur se visites");
define('_AM_GLOSSAIRE_ENT_DATE_CREATION', "Date de création");
define('_AM_GLOSSAIRE_ENT_DATE_UPDATE', "Date de mise à jour");
define('_AM_GLOSSAIRE_ENTRY_CAT_ID', "Cat id");
define('_AM_GLOSSAIRE_ENTRY_DEFINITION', "Definition");
define('_AM_GLOSSAIRE_ENTRY_REFERENCES', "References");
define('_AM_GLOSSAIRE_ENTRY_SHORTDEF', "Shortdef");
define('_AM_GLOSSAIRE_ENTRY_STATUS', "Status");
define('_AM_GLOSSAIRE_ENTRY_TERM', "Term");
define('_AM_GLOSSAIRE_FORM_UPLOAD_SIZE', "Max file size: ");
define('_AM_GLOSSAIRE_FORM_UPLOAD_SIZE_MB', "MB");
define('_AM_GLOSSAIRE_IMPORTER', "Import");
define('_AM_GLOSSAIRE_LIST_ENTRIES', "List of Entries");
define('_AM_GLOSSAIRE_PERM_SUBMIT_ENTRIES', "Submit Entries");
define('_AM_GLOSSAIRE_CATEGORY', "Categorie");
define('_AM_GLOSSAIRE_CATEGORY_STATUS_APPROVED', "Approuved");
define('_AM_GLOSSAIRE_CATEGORY_STATUS_INATIF', "Idle");
define('_AM_GLOSSAIRE_CATEGORY_STATUS_PROPOSITION', "Propose");
define('_AM_GLOSSAIRE_ENTRY_IMAGE', "Image");
define('_AM_GLOSSAIRE_FILE_UPLOADSIZE', "Maximum file size %s mo");
define('_AM_GLOSSAIRE_LIST_CATEGORIES', "List of Categories");
define('_AM_GLOSSAIRE_ENTRY_COUNTER', "Counter");
define('_AM_GLOSSAIRE_FORM_OK', "Successfully saved");
define('_AM_GLOSSAIRE_CREATOR', "Author");
define('_AM_GLOSSAIRE_NO_PERMISSIONS_SET', "You do not have permissions to access this feature");

?>
