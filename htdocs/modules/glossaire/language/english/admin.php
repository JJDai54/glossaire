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
require_once __DIR__ . '/main.php';

// ---------------- Admin Index ----------------
\define('_AM_GLOSSAIRE_STATISTICS', "Statistics");
// There are
\define('_AM_GLOSSAIRE_THEREARE_CATEGORIES', "There are <span class='bold'>%s</span> categories in the database");
\define('_AM_GLOSSAIRE_THEREARE_ENTRIES', "There are <span class='bold'>%s</span> entries in the database");
// ---------------- Admin Files ----------------
// There aren't
\define('_AM_GLOSSAIRE_THEREARENT_CATEGORIES', "There aren't categories");
\define('_AM_GLOSSAIRE_THEREARENT_ENTRIES', "There aren't entries");
// Save/Delete
\define('_AM_GLOSSAIRE_FORM_OK', "Successfully saved");
\define('_AM_GLOSSAIRE_FORM_DELETE_OK', "Successfully deleted");
\define('_AM_GLOSSAIRE_FORM_SURE_DELETE', "Are you sure to delete: <b><span style='color : Red;'>%s </span></b>");
\define('_AM_GLOSSAIRE_FORM_SURE_RENEW', "Are you sure to update: <b><span style='color : Red;'>%s </span></b>");
// Buttons
\define('_AM_GLOSSAIRE_ADD_CATEGORY', "Add New Category");
\define('_AM_GLOSSAIRE_ADD_ENTRY', "Add New Entry");
// Lists
\define('_AM_GLOSSAIRE_LIST_CATEGORIES', "List of Categories");
\define('_AM_GLOSSAIRE_LIST_ENTRIES', "List of Entries");
// ---------------- Admin Classes ----------------
// Category add/edit
\define('_AM_GLOSSAIRE_CATEGORY_ADD', "Add Category");
\define('_AM_GLOSSAIRE_CATEGORY_EDIT', "Edit Category");
// Elements of Category
\define('_AM_GLOSSAIRE_CATEGORY_ID', "Id");
\define('_AM_GLOSSAIRE_CATEGORY_NAME', "Name");
\define('_AM_GLOSSAIRE_CATEGORY_DESCRIPTION', "Description");
\define('_AM_GLOSSAIRE_CATEGORY_TOTAL', "Total");
\define('_AM_GLOSSAIRE_CATEGORY_WEIGHT', "Weight");
\define('_AM_GLOSSAIRE_CATEGORY_LOGOURL', "Logourl");
\define('_AM_GLOSSAIRE_CATEGORY_LOGOURL_UPLOADS', "Logourl in frameworks images: %s");
\define('_AM_GLOSSAIRE_CATEGORY_DATE_CREATION', "Date creation");
\define('_AM_GLOSSAIRE_CATEGORY_DATE_UPDATE', "Date update");
// Entry add/edit
\define('_AM_GLOSSAIRE_ENTRY_ADD', "Add Entry");
\define('_AM_GLOSSAIRE_ENTRY_EDIT', "Edit Entry");
// Elements of Entry
\define('_AM_GLOSSAIRE_ENTRY_ID', "Id");
\define('_AM_GLOSSAIRE_ENTRY_CAT_ID', "Cat id");
\define('_AM_GLOSSAIRE_ENTRY_UID', "Uid");
\define('_AM_GLOSSAIRE_ENTRY_TERM', "Term");
\define('_AM_GLOSSAIRE_ENTRY_SHORTDEF', "Shortdef");
\define('_AM_GLOSSAIRE_ENTRY_DEFINITION', "Definition");
\define('_AM_GLOSSAIRE_ENTRY_REFERENCES', "References");
\define('_AM_GLOSSAIRE_ENTRY_URL1', "Url1");
\define('_AM_GLOSSAIRE_ENTRY_URL2', "Url2");
\define('_AM_GLOSSAIRE_ENTRY_DATE_CREATION', "Date creation");
\define('_AM_GLOSSAIRE_ENTRY_DATE_UPDATE', "Date update");
\define('_AM_GLOSSAIRE_ENTRY_COUNTER', "Counter");
\define('_AM_GLOSSAIRE_ENTRY_STATUS', "Status");
\define('_AM_GLOSSAIRE_ENTRY_FLAG', "Flag");
// General
\define('_AM_GLOSSAIRE_FORM_UPLOAD', "Upload file");
\define('_AM_GLOSSAIRE_FORM_UPLOAD_NEW', "Upload new file: ");
\define('_AM_GLOSSAIRE_FORM_UPLOAD_SIZE', "Max file size: ");
\define('_AM_GLOSSAIRE_FORM_UPLOAD_SIZE_MB', "MB");
\define('_AM_GLOSSAIRE_FORM_UPLOAD_IMG_WIDTH', "Max image width: ");
\define('_AM_GLOSSAIRE_FORM_UPLOAD_IMG_HEIGHT', "Max image height: ");
\define('_AM_GLOSSAIRE_FORM_IMAGE_PATH', "Files in %s :");
\define('_AM_GLOSSAIRE_FORM_ACTION', "Action");
\define('_AM_GLOSSAIRE_FORM_EDIT', "Modification");
\define('_AM_GLOSSAIRE_FORM_DELETE', "Clear");
// Clone feature
\define('_AM_GLOSSAIRE_CLONE', "Clone");
\define('_AM_GLOSSAIRE_CLONE_DSC', "Cloning a module has never been this easy! Just type in the name you want for it and hit submit button!");
\define('_AM_GLOSSAIRE_CLONE_TITLE', "Clone %s");
\define('_AM_GLOSSAIRE_CLONE_NAME', "Choose a name for the new module");
\define('_AM_GLOSSAIRE_CLONE_NAME_DSC', "Do not use special characters! <br>Do not choose an existing module dirname or database table name!");
\define('_AM_GLOSSAIRE_CLONE_INVALIDNAME', "ERROR: Invalid module name, please try another one!");
\define('_AM_GLOSSAIRE_CLONE_EXISTS', "ERROR: Module name already taken, please try another one!");
\define('_AM_GLOSSAIRE_CLONE_CONGRAT', "Congratulations! %s was sucessfully created!<br>You may want to make changes in language files.");
\define('_AM_GLOSSAIRE_CLONE_IMAGEFAIL', "Attention, we failed creating the new module logo. Please consider modifying assets/images/logo_module.png manually!");
\define('_AM_GLOSSAIRE_CLONE_FAIL', "Sorry, we failed in creating the new clone. Maybe you need to temporally set write permissions (CHMOD 777) to modules folder and try again.");
// ---------------- Admin Permissions ----------------
// Permissions
\define('_AM_GLOSSAIRE_PERMISSIONS_GLOBAL', "Permissions global");
\define('_AM_GLOSSAIRE_PERMISSIONS_GLOBAL_DESC', "Permissions global to check type of.");
\define('_AM_GLOSSAIRE_PERMISSIONS_GLOBAL_4', "Permissions global to approve");
\define('_AM_GLOSSAIRE_PERMISSIONS_GLOBAL_8', "Permissions global to submit");
\define('_AM_GLOSSAIRE_PERMISSIONS_GLOBAL_16', "Permissions global to view");
\define('_AM_GLOSSAIRE_PERMISSIONS_APPROVE', "Permissions to approve");
\define('_AM_GLOSSAIRE_PERMISSIONS_APPROVE_DESC', "Permissions to approve");
\define('_AM_GLOSSAIRE_PERMISSIONS_SUBMIT', "Permissions to submit");
\define('_AM_GLOSSAIRE_PERMISSIONS_SUBMIT_DESC', "Permissions to submit");
\define('_AM_GLOSSAIRE_PERMISSIONS_VIEW', "Permissions to view");
\define('_AM_GLOSSAIRE_PERMISSIONS_VIEW_DESC', "Permissions to view");
\define('_AM_GLOSSAIRE_NO_PERMISSIONS_SET', "No permission set");
// ---------------- Admin Others ----------------
\define('_AM_GLOSSAIRE_ABOUT_MAKE_DONATION', "Submit");
\define('_AM_GLOSSAIRE_SUPPORT_FORUM', "Support Forum");
\define('_AM_GLOSSAIRE_DONATION_AMOUNT', "Donation Amount");
\define('_AM_GLOSSAIRE_MAINTAINEDBY', " is maintained by ");

// ---------------- JJD ----------------
\define('_AM_GLOSSAIRE_FIRST', "Premier");
\define('_AM_GLOSSAIRE_UP', "Monter");
\define('_AM_GLOSSAIRE_DOWN', "Descendre");
\define('_AM_GLOSSAIRE_LAST', "Dernier");
\define('_AM_GLOSSAIRE_WEIGHT_UPDATE', "Le poids a été mis à jour");
\define('_AM_GLOSSAIRE_ENTRY_INITIALE', "Initiale");
\define('_AM_GLOSSAIRE_CATEGORY_COLOR_SET', "Jeu de couleurs");
\define('_AM_GLOSSAIRE_ENTRY_MAGNIFY_SD', "Magnifier");
\define('_AM_GLOSSAIRE_ENTRY_MAGNIFY_SD_DESC', "Met en forme la définiton courte en mettant les initiales en gras");
\define('_AM_GLOSSAIRE_CATEGORY_MAGNIFY_SD', "Magnifier");
\define('_AM_GLOSSAIRE_CATEGORY_MAGNIFY_SD_DESC', "Met en forme la définiton courte en mettant les initiales en gras<br>Valeur par défaut pour les entrées de la catégorie");
\define('_AM_GLOSSAIRE_ENTRY_URLS', "Sites de référence");
\define('_AM_GLOSSAIRE_ENTRY_URLS_DESC', "Entrer une URL par ligne sans séparateur");
\define('_AM_GLOSSAIRE_CATEGORY_SHOW_INDEX_TERMS', "Afficher l'index des termes");
\define('_AM_GLOSSAIRE_CATEGORY_SHOW_INDEX_TERMS_DESC', "Affiche la liste des termes en tête de page avec un lien sur la définitions");
\define('_AM_GLOSSAIRE_CATEGORY_STATUS_INATIF', "Inactif");
\define('_AM_GLOSSAIRE_CATEGORY_STATUS_PROPOSITION', "Proposé");
\define('_AM_GLOSSAIRE_CATEGORY_STATUS_APPROVED', "Approuvé");
\define('_AM_GLOSSAIRE_CATEGORY', "Catégorie");
\define('_AM_GLOSSAIRE_EXPORTER', "Exporter");
\define('_AM_GLOSSAIRE_EXPORT', "Export");
\define('_AM_GLOSSAIRE_DOWNLOAD_OK', "Téléchargement effectué, il se trouve dans votre dossier de téléchargement.");
\define('_AM_GLOSSAIRE_IMPORT', "Import");
\define('_AM_GLOSSAIRE_IMPORT_FROM_GLOSSAIRE', "Import d'un export du module Gossaire ou un de ses clones");
\define('_AM_GLOSSAIRE_IMPORT_FROM_LEXIKON', "Import du modulle Lexikon (Lexikon doit être installé)");
\define('_AM_GLOSSAIRE_FILE', "Fichier à importer");
\define('_AM_GLOSSAIRE_FILE_DESC', "Un nouveau quiz sera généré");
\define('_AM_GLOSSAIRE_FILE_TO_LOAD', "Fichier à importer");
\define('_AM_GLOSSAIRE_FILE_UPLOADSIZE', "Taile maximum des fichiers %s mo");
\define('_AM_GLOSSAIRE_SELECT_CATEGORY_DESC', "Sélectionnez une catégorie de destintion pour ce nouveau glossaire.");
\define('_AM_GLOSSAIRE_IMPORTER', "Importer");
\define('_AM_GLOSSAIRE_IMPORT_IN_NEW_CAT', "Importer dans une nouvelle catégorie");
\define('_AM_GLOSSAIRE_ENTRY_IMAGE', "Image");
\define('_AM_GLOSSAIRE_ENTRY_IMAGE_UPLOADS', "Image in %s :");
\define('_AM_GLOSSAIRE_CATEGORY_IMG_FOLDER', "Dossier images");
\define('_AM_GLOSSAIRE_ENTRY_IMG_DESC', "Sélectionnez une image existante ou téléchargez une nouvelle image.<br>Laissez vide pour garder l'image existante.");
\define('_AM_GLOSSAIRE_ENTRY_IMG_DESC2', "Sélectionnez une image dans votre environnement ou Laissez vide.");
\define('_AM_GLOSSAIRE_CREATOR', "Creator");
\define('_AM_GLOSSAIRE_CATEGORY_ENTRIES', "Entries");
\define('_AM_GLOSSAIRE_TOTAL', "Total");
\define('_AM_GLOSSAIRE_ENTRY_REFERENCES_DESC', "Sources, Adresse, téléphone et toute information utile");
\define('_AM_GLOSSAIRE_DELETE_IMG', "Supprimer l'image");
\define('_AM_GLOSSAIRE_NO_CATEGORIES1', "Il n'y a aucune categorie de crée.<br>Vous devez d'abord créer une catégories avant d'ajouter des définitions.");
\define('_AM_GLOSSAIRE_NO_CATEGORIES2', "Il n'y a aucune categorie à exporter.");
define ('_AM_GLOSSAIRE_SELECT_LEX_CATEGORY', "Catégorie de Lexikon");   
define ('_AM_GLOSSAIRE_SELECT_LEX_CATEGORY_DESC', "Sélectionez la catégorie du module Lexikon à importer");   
\define('_AM_GLOSSAIRE_CLEAN_IMAGES', "Nettoyer les images: Il y a  %s image(s) inutilisé(s) et %s image(s) inexistante(s)");
\define('_AM_GLOSSAIRE_CLEAN_IMAGES_OK', "Nettoyage des images : <br>%s image(s) ont été supprimées et %s définitions mises à jour<br>pour la catégorie #%s.");    

// ---------------- End ----------------

