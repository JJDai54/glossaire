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
\define('_AM_GLOSSAIRE_STATISTICS', "Statistiques");
// Il y a
\define('_AM_GLOSSAIRE_THEREARE_CATEGORIES', "Il y a <span class='bold'>%s</span> catégories dans la base de données");
\define('_AM_GLOSSAIRE_THEREARE_ENTRIES', "Il y a <span class='bold'>%s</span> entrées dans la base de données");
// ---------------- Fichiers d'administration ----------------
// Il n'y a pas un pas
\define('_AM_GLOSSAIRE_THEREARENT_CATEGORIES', "Il n'y a pas de catégories");
\define('_AM_GLOSSAIRE_THEREARENT_ENTRIES', "Il n'y a pas d'entrées");
// Enregistrer/Supprimer
\define('_AM_GLOSSAIRE_FORM_OK', "Sauvegardé avec succès");
\define('_AM_GLOSSAIRE_FORM_DELETE_OK', "Supprimé avec succès");
\define('_AM_GLOSSAIRE_FORM_SURE_DELETE', "Êtes-vous sûr de supprimer : <b><span style='color : Red;'>%s </span></b>");
\define('_AM_GLOSSAIRE_FORM_SURE_RENEW', "Êtes-vous sûr de mettre à jour : <b><span style='color : Red;'>%s </span></b>");
//Boutons
\define('_AM_GLOSSAIRE_ADD_CATEGORY', "Ajouter une nouvelle catégorie");
\define('_AM_GLOSSAIRE_ADD_ENTRY', "Ajouter une nouvelle entrée");
// listes
\define('_AM_GLOSSAIRE_LIST_CATEGORIES', "Liste des Catégories");
\define('_AM_GLOSSAIRE_LIST_ENTRIES', "Liste des entrées");
// ---------------- Cours d'administration ----------------
// Catégorie ajouter/modifier
\define('_AM_GLOSSAIRE_CATEGORY_ADD', "Ajouter une catégorie");
\define('_AM_GLOSSAIRE_CATEGORY_EDIT', "Modifier la catégorie");
// Éléments de catégories
\define('_AM_GLOSSAIRE_CATEGORY_ID', "Identifiant");
\define('_AM_GLOSSAIRE_CATEGORY_NAME', "Nom");
\define('_AM_GLOSSAIRE_CATEGORY_DESCRIPTION', "Description");
\define('_AM_GLOSSAIRE_CATEGORY_TOTAL', "Total");
\define('_AM_GLOSSAIRE_CATEGORY_WEIGHT', "Poids");
\define('_AM_GLOSSAIRE_CATEGORY_LOGOURL', "Logourl");
\define('_AM_GLOSSAIRE_CATEGORY_LOGOURL_UPLOADS', "Logourl dans les images frameworks : %s");
\define('_AM_GLOSSAIRE_CATEGORY_DATE_CREATION', "Date de création");
\define('_AM_GLOSSAIRE_CATEGORY_DATE_UPDATE', "Mise à jour de la date");
// Ajout/modification d'entrée
\define('_AM_GLOSSAIRE_ENTRY_ADD', "Ajouter une entrée");
\define('_AM_GLOSSAIRE_ENTRY_EDIT', "Modifier l'entrée");
// Éléments d'entrée
\define('_AM_GLOSSAIRE_ENTRY_ID', "Identifiant");
\define('_AM_GLOSSAIRE_ENTRY_CAT_ID', "Identifiant du chat");
\define('_AM_GLOSSAIRE_ENTRY_UID', "UId");
\define('_AM_GLOSSAIRE_ENTRY_TERM', "Terme");
\define('_AM_GLOSSAIRE_ENTRY_SHORTDEF', "Définition courte");
\define('_AM_GLOSSAIRE_ENTRY_DEFINITION', "Définition");
\define('_AM_GLOSSAIRE_ENTRY_REFERENCES', "Références");
\define('_AM_GLOSSAIRE_ENTRY_URL1', "Url1");
\define('_AM_GLOSSAIRE_ENTRY_URL2', "Url2");
\define('_AM_GLOSSAIRE_ENTRY_DATE_CREATION', "Date de création");
\define('_AM_GLOSSAIRE_ENTRY_DATE_UPDATE', "Mise à jour de la date");
\define('_AM_GLOSSAIRE_ENTRY_COUNTER', "Compteur");
\define('_AM_GLOSSAIRE_ENTRY_STATUS', "Statut");
\define('_AM_GLOSSAIRE_ENTRY_FLAG', "Drapeau");
// Général
\define('_AM_GLOSSAIRE_FORM_UPLOAD', "Télécharger le fichier");
\define('_AM_GLOSSAIRE_FORM_UPLOAD_NEW', "Télécharger un nouveau fichier : ");
\define('_AM_GLOSSAIRE_FORM_UPLOAD_SIZE', "Taille maximale du fichier : ");
\define('_AM_GLOSSAIRE_FORM_UPLOAD_SIZE_MB', "Mo");
\define('_AM_GLOSSAIRE_FORM_UPLOAD_IMG_WIDTH', "Largeur max de l'image : ");
\define('_AM_GLOSSAIRE_FORM_UPLOAD_IMG_HEIGHT', "Hauteur max de l'image : ");
\define('_AM_GLOSSAIRE_FORM_IMAGE_PATH', "Fichiers dans %s :");
\define('_AM_GLOSSAIRE_FORM_ACTION', "Action");
\define('_AM_GLOSSAIRE_FORM_EDIT', "Modification");
\define('_AM_GLOSSAIRE_FORM_DELETE', "Effacer");
// fonctionnalité de clonage
\define('_AM_GLOSSAIRE_CLONE', "Clone");
\define('_AM_GLOSSAIRE_CLONE_DSC', "Cloner un module n'a jamais été aussi facile ! Tapez simplement le nom que vous souhaitez lui donner et appuyez sur le bouton Soumettre !");
\define('_AM_GLOSSAIRE_CLONE_TITLE', "Clone %s");
\define('_AM_GLOSSAIRE_CLONE_NAME', "Choisissez un nom pour le nouveau module");
\define('_AM_GLOSSAIRE_CLONE_NAME_DSC', "N'utilisez pas de caractères spéciaux ! <br>Ne choisissez pas un nom de répertoire de module ou un nom de table de base de données existant !");
\define('_AM_GLOSSAIRE_CLONE_INVALIDNAME', "ERREUR : nom de module invalide, veuillez en essayer un autre !");
\define('_AM_GLOSSAIRE_CLONE_EXISTS', "ERREUR : Nom du module déjà pris, veuillez en essayer un autre !");
\define('_AM_GLOSSAIRE_CLONE_CONGRAT', "Félicitations ! %s a été créé avec succès !<br>Vous voudrez peut-être apporter des modifications aux fichiers de langue.");
\define('_AM_GLOSSAIRE_CLONE_IMAGEFAIL', "Attention, nous n'avons pas réussi à créer le nouveau logo du module. Veuillez envisager de modifier manuellement assets/images/logo_module.png !");
\define('_AM_GLOSSAIRE_CLONE_FAIL', "Désolé, nous n'avons pas réussi à créer le nouveau clone. Peut-être avez-vous besoin de définir temporairement des autorisations d'écriture (CHMOD 777) sur le dossier des modules et de réessayer.");
// ---------------- Admin Permissions ----------------
// Permissions
\define('_AM_GLOSSAIRE_PERMISSIONS_GLOBAL', "Permissions globales");
\define('_AM_GLOSSAIRE_PERMISSIONS_GLOBAL_DESC', "Permissions globales pour vérifier le type de.");
\define('_AM_GLOSSAIRE_PERMISSIONS_GLOBAL_4', "Permissions globales à approuver");
\define('_AM_GLOSSAIRE_PERMISSIONS_GLOBAL_8', "Permissions globales à soumettre");
\define('_AM_GLOSSAIRE_PERMISSIONS_GLOBAL_16', "Permissions globales pour voir");
\define('_AM_GLOSSAIRE_PERMISSIONS_APPROVE', "Permissions d'approuver");
\define('_AM_GLOSSAIRE_PERMISSIONS_APPROVE_DESC', "Autorisations d'approuver");
\define('_AM_GLOSSAIRE_PERMISSIONS_SUBMIT', "Autorisations de soumettre");
\define('_AM_GLOSSAIRE_PERMISSIONS_SUBMIT_DESC', "Autorisations de soumettre");
\define('_AM_GLOSSAIRE_PERMISSIONS_VIEW', "Permissions de voir");
\define('_AM_GLOSSAIRE_PERMISSIONS_VIEW_DESC', "Permissions de voir");
\define('_AM_GLOSSAIRE_NO_PERMISSIONS_SET', "Aucun ensemble d'autorisations");

// ---------------- Admin Others ----------------
\define('_AM_GLOSSAIRE_ABOUT_MAKE_DONATION', "Soumettre");
\define('_AM_GLOSSAIRE_SUPPORT_FORUM', "Forum d'assistance");
\define('_AM_GLOSSAIRE_DONATION_AMOUNT', "Montant du don");
\define('_AM_GLOSSAIRE_MAINTAINEDBY', " est maintenu par ");

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
\define('_AM_GLOSSAIRE_ENTRY_URLS_DESC', "Entrer une URL par ligne sans séparateur.Chaque ligne peut etre composée du titre et de l'url séparée par un '|' sans espace.<br>Exemple : <br>Xoops France<b> | </b>https://www.frxoops.org/");
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
\define('_AM_GLOSSAIRE_FILE_DESC', "Une nouvelle catégorie sera générée");
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
\define('_AM_GLOSSAIRE_CREATOR', "Créateur");
\define('_AM_GLOSSAIRE_CATEGORY_ENTRIES', "Entrées");
\define('_AM_GLOSSAIRE_TOTAL', "Total");
\define('_AM_GLOSSAIRE_ENTRY_REFERENCES_DESC', "Sources, Adresse, téléphone et toute information utile");
\define('_AM_GLOSSAIRE_DELETE_IMG', "Supprimer l'image");
\define('_AM_GLOSSAIRE_NO_CATEGORIES1', "Il n'y a aucune categorie de crée.<br>Vous devez d'abord créer une catégories avant d'ajouter des définitions.");
\define('_AM_GLOSSAIRE_NO_CATEGORIES2', "Il n'y a aucune categorie à exporter.");
\define ('_AM_GLOSSAIRE_SELECT_LEX_CATEGORY', "Catégorie de Lexikon");   
\define ('_AM_GLOSSAIRE_SELECT_LEX_CATEGORY_DESC', "Sélectionez la catégorie du module Lexikon à importer");   

\define('_AM_GLOSSAIRE_CLEAN_IMAGES', "Nettoyer les images: Il y a  %s image(s) inutilisé(s) et %s image(s) inexistante(s)");
\define('_AM_GLOSSAIRE_CLEAN_FOLDER_IMAGES', "Supprimer les %s image(s) inutilisé(s)");
\define('_AM_GLOSSAIRE_CLEAN_IMAGES_OK', "Nettoyage des images : <br>%s image(s) ont été supprimées et %s définitions mises à jour<br>pour la catégorie #%s.");    
\define ('_AM_GLOSSAIRE_INCLUDE_IMG', "Inclure les images");   
\define ('_AM_GLOSSAIRE_INCLUDE_IMG_DESC', "Si les images ne sont pas incluses l'archive sera plus légère");   
\define ('_AM_GLOSSAIRE_IMAGES_DELETED', "%s image(s) on été supprimées avec succès");   

\define ('_AM_GLOSSAIRE_CLEAN_ENTRIES_IMAGES', "Mettre à jour les %s définition(s) qui ont des images inexistantes");   
\define ('_AM_GLOSSAIRE_CLEAN_ENTRIES_IMAGES_UPDATE', "%s définitions on tété mises à jours");   
\define('_AM_GLOSSAIRE_IMPORT_SUCCES', "Importation Ok dans catIdSelect #%s");
\define('_AM_GLOSSAIRE_IMPORT_ECHEC', "Echec de l'importation<br>%s");

// ---------------- End ----------------
