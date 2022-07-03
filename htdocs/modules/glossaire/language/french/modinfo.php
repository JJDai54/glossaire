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
\define('_MI_GLOSSAIRE_DESC', "Module de gestion des glossaires");
// ---------------- Menu Admin ----------------
\define('_MI_GLOSSAIRE_ADMENU1', "Tableau de bord");
\define('_MI_GLOSSAIRE_ADMENU2', "Catégories");
\define('_MI_GLOSSAIRE_ADMENU3', "Entrée");
\define('_MI_GLOSSAIRE_ADMENU4', "Autorisations");
\define('_MI_GLOSSAIRE_ADMENU5', "Cloner");
\define('_MI_GLOSSAIRE_ADMENU6', "Commentaires");
\define('_MI_GLOSSAIRE_ABOUT', "A propos");
// ---------------- Navigation Admin ----------------
\define('_MI_GLOSSAIRE_ADMIN_PAGER', "Nombre de lignes côté administration");
\define('_MI_GLOSSAIRE_ADMIN_PAGER_DESC', "Nombre de lignes par page dans les listes de l'administration");
//Utilisateur
\define('_MI_GLOSSAIRE_USER_PAGER', "Nombre de lignes côté utilisateur");
\define('_MI_GLOSSAIRE_USER_PAGER_DESC', "Nombre de lignes par page dans les listes pour les utilisateurs");
// sous-menu
\define('_MI_GLOSSAIRE_SMNAME1', "Page d'index");
\define('_MI_GLOSSAIRE_SMNAME2', "Catégories");
\define('_MI_GLOSSAIRE_SMNAME3', "Soumettre les catégories");
\define('_MI_GLOSSAIRE_SMNAME4', "Entrée");
\define('_MI_GLOSSAIRE_SMNAME5', "Soumettre les entrées");
\define('_MI_GLOSSAIRE_SMNAME6', "Rechercher");
// blocs
\define('_MI_GLOSSAIRE_CATEGORIES_BLOCK', "Bloc catégories");
\define('_MI_GLOSSAIRE_CATEGORIES_BLOCK_DESC', "Description du bloc de catégories");
\define('_MI_GLOSSAIRE_CATEGORIES_BLOCK_CATEGORY', "Catégories bloc CATEGORY");
\define('_MI_GLOSSAIRE_CATEGORIES_BLOCK_CATEGORY_DESC', "Catégories bloc CATEGORY description");
\define('_MI_GLOSSAIRE_ENTRIES_BLOCK', "Bloc d'entrées");
\define('_MI_GLOSSAIRE_ENTRIES_BLOCK_DESC', "Description du bloc d'entrées");
\define('_MI_GLOSSAIRE_ENTRIES_BLOCK_ENTRY', "Entrée bloc ENTRY");
\define('_MI_GLOSSAIRE_ENTRIES_BLOCK_ENTRY_DESC', "Description de l'ENTREE du bloc d'entrées");
\define('_MI_GLOSSAIRE_ENTRIES_BLOCK_LAST', "Bloc d'entrées en dernier");
\define('_MI_GLOSSAIRE_ENTRIES_BLOCK_LAST_DESC', "Dernière description du bloc d'entrées");
\define('_MI_GLOSSAIRE_ENTRIES_BLOCK_NEW', "Nouveau bloc d'entrées");
\define('_MI_GLOSSAIRE_ENTRIES_BLOCK_NEW_DESC', "Les entrées bloquent la nouvelle description");
\define('_MI_GLOSSAIRE_ENTRIES_BLOCK_HITS', "Les entrées bloquent les hits");
\define('_MI_GLOSSAIRE_ENTRIES_BLOCK_HITS_DESC', "Description des hits du bloc d'entrées");
\define('_MI_GLOSSAIRE_ENTRIES_BLOCK_TOP', "Bloc d'entrées en haut");
\define('_MI_GLOSSAIRE_ENTRIES_BLOCK_TOP_DESC', "Description du haut du bloc d'entrées");
\define('_MI_GLOSSAIRE_ENTRIES_BLOCK_RANDOM', "Bloc d'entrées aléatoire");
\define('_MI_GLOSSAIRE_ENTRIES_BLOCK_RANDOM_DESC', "Les entrées bloquent la description aléatoire");
// Config
\define('_MI_GLOSSAIRE_EDITOR_ADMIN', "Éditeur de l'administrateur'");
\define('_MI_GLOSSAIRE_EDITOR_ADMIN_DESC', "Sélectionnez l'éditeur qui doit être utilisé dans la zone d'administration pour les champs de zone de texte");
\define('_MI_GLOSSAIRE_EDITOR_USER', "Éditeur de l'utilisateur");
\define('_MI_GLOSSAIRE_EDITOR_USER_DESC', "Sélectionnez l'éditeur qui doit être utilisé dans la zone utilisateur pour les champs de zone de texte");
\define('_MI_GLOSSAIRE_EDITOR_MAXCHAR', "Nombre maximum de caractères");
\define('_MI_GLOSSAIRE_EDITOR_MAXCHAR_DESC', "Nombre maximum de caractères pour afficher le texte d'une zone de texte ou d'un champ d'éditeur dans la zone d'administration");
\define('_MI_GLOSSAIRE_KEYWORDS', "Mots clés");
\define('_MI_GLOSSAIRE_KEYWORDS_DESC', "Insérer ici les mots clés (séparés par des virgules)");
\define('_MI_GLOSSAIRE_SIZE_MB', "Mo");
\define('_MI_GLOSSAIRE_MAXSIZE_IMAGE', "Taille max de l'image");
\define('_MI_GLOSSAIRE_MAXSIZE_IMAGE_DESC', "Définir la taille maximale pour télécharger des images");
\define('_MI_GLOSSAIRE_MIMETYPES_IMAGE', "Image des types MIME");
\define('_MI_GLOSSAIRE_MIMETYPES_IMAGE_DESC', "Définir les types MIME autorisés pour le téléchargement d'images");
\define('_MI_GLOSSAIRE_MAXWIDTH_IMAGE', "Largeur max de l'image");
\define('_MI_GLOSSAIRE_MAXWIDTH_IMAGE_DESC', "Définir la largeur maximale à laquelle les images téléchargées doivent être mises à l'échelle (en pixels)<br>0 signifie que les images conservent la taille d'origine. <br>Si une image est plus petite que la valeur maximale, alors l'image ne sera pas agrandie, il sera enregistré dans sa largeur d'origine.");
\define('_MI_GLOSSAIRE_MAXHEIGHT_IMAGE', "Hauteur max image");
\define('_MI_GLOSSAIRE_MAXHEIGHT_IMAGE_DESC', "Définir la hauteur maximale à laquelle les images téléchargées doivent être mises à l'échelle (en pixels)<br>0 signifie que les images conservent la taille d'origine. <br>Si une image est inférieure à la valeur maximale, alors l'image ne s'agrandira pas, il sera enregistré dans sa hauteur d'origine");
\define('_MI_GLOSSAIRE_NUMB_COL', "Nombre de colonnes");
\define('_MI_GLOSSAIRE_NUMB_COL_DESC', "Numéroter les colonnes à afficher");
\define('_MI_GLOSSAIRE_DIVIDEBY', "Diviser par");
\define('_MI_GLOSSAIRE_DIVIDEBY_DESC', "Diviser par le nombre de colonnes");
\define('_MI_GLOSSAIRE_TABLE_TYPE', "Type de tableau");
\define('_MI_GLOSSAIRE_TABLE_TYPE_DESC', "Le type de table est la table html d'amorçage");
\define('_MI_GLOSSAIRE_PANEL_TYPE', "Type de panneau");
\define('_MI_GLOSSAIRE_PANEL_TYPE_DESC', "Le type de panneau est la div html bootstrap");
\define('_MI_GLOSSAIRE_IDPAYPAL', "Identifiant Paypal");
\define('_MI_GLOSSAIRE_IDPAYPAL_DESC', "Insérez ici votre identifiant PayPal pour les dons");
\define('_MI_GLOSSAIRE_SHOW_BREADCRUMBS', "Afficher le fil d'Ariane");
\define('_MI_GLOSSAIRE_SHOW_BREADCRUMBS_DESC', "Afficher le fil d'Ariane qui affiche la page actuelle en contexte dans la structure du site");
\define('_MI_GLOSSAIRE_ADVERTISE', "Code de la publicité");
\define('_MI_GLOSSAIRE_ADVERTISE_DESC', "Insérez ici le code de l'annonce");
\define('_MI_GLOSSAIRE_MAINTAINEDBY', "Maintenu par");
\define('_MI_GLOSSAIRE_MAINTAINEDBY_DESC', "Autoriser l'URL du site de support ou de la communauté");
\define('_MI_GLOSSAIRE_BOOKMARKS', "Signets sociaux");
\define('_MI_GLOSSAIRE_BOOKMARKS_DESC', "Afficher les signets sociaux sur une seule page");
// Notifications globales
\define('_MI_GLOSSAIRE_NOTIFY_GLOBAL', "Notification globale");
\define('_MI_GLOSSAIRE_NOTIFY_GLOBAL_NEW', "Tout nouvel élément");
\define('_MI_GLOSSAIRE_NOTIFY_GLOBAL_NEW_CAPTION', "M'avertir de tout nouvel élément");
\define('_MI_GLOSSAIRE_NOTIFY_GLOBAL_NEW_SUBJECT', "Notification de nouvel élément");
\define('_MI_GLOSSAIRE_NOTIFY_GLOBAL_MODIFY', "Tout élément modifié");
\define('_MI_GLOSSAIRE_NOTIFY_GLOBAL_MODIFY_CAPTION', "M'avertir de toute modification d'article");
\define('_MI_GLOSSAIRE_NOTIFY_GLOBAL_MODIFY_SUBJECT', "Notification de modification");
\define('_MI_GLOSSAIRE_NOTIFY_GLOBAL_DELETE', "Tout élément supprimé");
\define('_MI_GLOSSAIRE_NOTIFY_GLOBAL_DELETE_CAPTION', "M'avertir de tout élément supprimé");
\define('_MI_GLOSSAIRE_NOTIFY_GLOBAL_DELETE_SUBJECT', "Notification sur l'élément supprimé");
\define('_MI_GLOSSAIRE_NOTIFY_GLOBAL_APPROVE', "Tout élément à approuver");
\define('_MI_GLOSSAIRE_NOTIFY_GLOBAL_APPROVE_CAPTION', "M'avertir de tout élément en attente d'approbation");
\define('_MI_GLOSSAIRE_NOTIFY_GLOBAL_APPROVE_SUBJECT', "Notification d'un élément en attente d'approbation");
// Category notifications
\define('_MI_GLOSSAIRE_NOTIFY_CATEGORY', "Notification de catégorie");
\define('_MI_GLOSSAIRE_NOTIFY_CATEGORY_MODIFY', "Modification de catégorie");
\define('_MI_GLOSSAIRE_NOTIFY_CATEGORY_MODIFY_CAPTION', "M'avertir de la modification de catégorie");
\define('_MI_GLOSSAIRE_NOTIFY_CATEGORY_MODIFY_SUBJECT', "Notification de modification");
\define('_MI_GLOSSAIRE_NOTIFY_CATEGORY_DELETE', "Catégorie supprimée");
\define('_MI_GLOSSAIRE_NOTIFY_CATEGORY_DELETE_CAPTION', "M'avertir des catégories supprimées");
\define('_MI_GLOSSAIRE_NOTIFY_CATEGORY_DELETE_SUBJECT', "Catégorie de suppression de notification");
\define('_MI_GLOSSAIRE_NOTIFY_CATEGORY_APPROVE', "Catégorie approuvée");
\define('_MI_GLOSSAIRE_NOTIFY_CATEGORY_APPROVE_CAPTION', "M'avertir des catégories en attente d'approbation");
\define('_MI_GLOSSAIRE_NOTIFY_CATEGORY_APPROVE_SUBJECT', "Catégorie de notification en attente d'approbation");
// Notifications d'entrée
\define('_MI_GLOSSAIRE_NOTIFY_ENTRY', "Notification d'entrée");
\define('_MI_GLOSSAIRE_NOTIFY_ENTRY_MODIFY', "Modification d'entrée");
\define('_MI_GLOSSAIRE_NOTIFY_ENTRY_MODIFY_CAPTION', "M'avertir de la modification d'une entrée");
\define('_MI_GLOSSAIRE_NOTIFY_ENTRY_MODIFY_SUBJECT', "Notification de modification");
\define('_MI_GLOSSAIRE_NOTIFY_ENTRY_DELETE', "Entrée supprimée");
\define('_MI_GLOSSAIRE_NOTIFY_ENTRY_DELETE_CAPTION', "M'avertir des entrées supprimées");
\define('_MI_GLOSSAIRE_NOTIFY_ENTRY_DELETE_SUBJECT', "Notification supprimer entrée");
\define('_MI_GLOSSAIRE_NOTIFY_ENTRY_APPROVE', "Entrée approuvée");
\define('_MI_GLOSSAIRE_NOTIFY_ENTRY_APPROVE_CAPTION', "M'avertir des entrées en attente d'approbation");
\define('_MI_GLOSSAIRE_NOTIFY_ENTRY_APPROVE_SUBJECT', "Entrée de notification en attente d'approbation");
// Groupes d'autorisations
\define('_MI_GLOSSAIRE_GROUPS', "Accès groupes");
\define('_MI_GLOSSAIRE_GROUPS_DESC', "Sélectionner l'autorisation d'accès générale pour les groupes.");
\define('_MI_GLOSSAIRE_ADMIN_GROUPS', "Autorisations du groupe d'administration");
\define('_MI_GLOSSAIRE_ADMIN_GROUPS_DESC', "Quels groupes ont accès à la page des outils et permissions");
\define('_MI_GLOSSAIRE_UPLOAD_GROUPS', "Autorisations de groupe de téléchargement");
\define('_MI_GLOSSAIRE_UPLOAD_GROUPS_DESC', "Quels sont les groupes autorisés à télécharger des fichiers ?");

// ---------------- JJD ----------------

define('_MI_GLOSSAIRE_SHOW_TPL_NAME', "Afficher le nom des templates");
define('_MI_GLOSSAIRE_SHOW_TPL_NAME_DESC', "Option à utiliser pour le développement, la désactiver en production");
define('_MI_GLOSSAIRE_EXPORT', "Exportation");
define('_MI_GLOSSAIRE_IMPORT', "Importation");

\define('_MI_GLOSSAIRE_MAXSIZE_FILE', "Fichier de taille max");
\define('_MI_GLOSSAIRE_MAXSIZE_FILE_DESC', "Définir la taille maximale pour télécharger des fichiers");
\define('_MI_GLOSSAIRE_MIMETYPES_FILE', "Fichier des types MIME");
\define('_MI_GLOSSAIRE_MIMETYPES_FILE_DESC', "Définir les types mime autorisés pour le téléchargement de fichiers");



\define('_MI_GLOSSAIRE_SHOW_ID', "Afficher les identifiants");
\define('_MI_GLOSSAIRE_SHOW_ID_DESC', "Utilisé en mode développement, laisser de préférence 'False' en production");

\define('_MI_GLOSSAIRE_SEARCH_MODE', "Mode de recherche");
\define('_MI_GLOSSAIRE_SEARCH_MODE_DESC', "Module : Utilise la fonction de recherche du module<br>Globale : Utilise la fonction de recheche de xoops");
\define('_MI_GLOSSAIRE_SEARCH_MODE_LOCAL', "Module");
\define('_MI_GLOSSAIRE_SEARCH_MODE_GLOBAL', "Globale");

//--------
\define('_MI_GLOSSAIRE_CONFIG_TITLE', "<center><div style='background-color:black;color:white;'>%s</div><center>");

\define('_MI_GLOSSAIRE_ALPHABARRE_CSS', "<br>Indiquer le style CSS sans les accolades et sans oublier les ';'");
\define('_MI_GLOSSAIRE_BREAK_ALPHABARRE_DESC', "<br>Barre constituée des lettres de l'alphabet pour la sélection dans le glossaire.");
\define('_MI_GLOSSAIRE_BREAK_ALPHABARRE_DEFAULT', "<br>Ce sont les valeurs par défaut modifiables pour chaque catégorie.");
\define('_MI_GLOSSAIRE_BREAK_ALPHABARRE', sprintf(_MI_GLOSSAIRE_CONFIG_TITLE, "ALPHABARRE - Barre de sélection" . _MI_GLOSSAIRE_BREAK_ALPHABARRE_DESC . _MI_GLOSSAIRE_ALPHABARRE_CSS . _MI_GLOSSAIRE_BREAK_ALPHABARRE_DEFAULT));

\define('_MI_GLOSSAIRE_BREAK_IMAGE', sprintf(_MI_GLOSSAIRE_CONFIG_TITLE, "Images"));
\define('_MI_GLOSSAIRE_BREAK_FILE', sprintf(_MI_GLOSSAIRE_CONFIG_TITLE, "Fichiers"));
\define('_MI_GLOSSAIRE_BREAK_GROUP', sprintf(_MI_GLOSSAIRE_CONFIG_TITLE, "Groupes"));
\define('_MI_GLOSSAIRE_BREAK_INTERFACE', sprintf(_MI_GLOSSAIRE_CONFIG_TITLE, "Interface"));
\define('_MI_GLOSSAIRE_BREAK_EXTRA', sprintf(_MI_GLOSSAIRE_CONFIG_TITLE, "Extra"));
\define('_MI_GLOSSAIRE_BREAK_NOTIFICATION', sprintf(_MI_GLOSSAIRE_CONFIG_TITLE, "NOTIFICATIONS") );

\define('_MI_GLOSSAIRE_ALPHABARRE', "Barre de lettres");
\define('_MI_GLOSSAIRE_ALPHABARRE_DESC', "Liste des lettres de la barre de sélection par initiale.<br>Utiliser le caractère \"#\" pour une sélection sur tous les termes commençant par un chiffre.");
\define('_MI_GLOSSAIRE_ALPHABARRE_MODE', "Afficher toutes les lettres");
\define('_MI_GLOSSAIRE_ALPHABARRE_MODE_DESC', "<b>Non</b> : Affiche que les lettres existantes pour la sélection courante.<br><b>Oui</b> : Affiche la barre complète quel que soit la sélection.");

\define('_MI_GLOSSAIRE_ALPHABARRE_LETTER_DEFAULT', "Style des lettres par défaut");
\define('_MI_GLOSSAIRE_ALPHABARRE_LETTER_DEFAULT_DESC', "Style CSS des lettres par défaut.");
\define('_MI_GLOSSAIRE_ALPHABARRE_LETTER_SELECTED', "Style de la lettre sélectionnée");
\define('_MI_GLOSSAIRE_ALPHABARRE_LETTER_SELECTED_DESC', "Style de la lettre sélectionnée.");
\define('_MI_GLOSSAIRE_ALPHABARRE_LETTER_EXIST', "Style des lettres existantes");
\define('_MI_GLOSSAIRE_ALPHABARRE_LETTER_EXIST_DESC', "Style des lettres quand des définitions commençant par cette-ci existe");
\define('_MI_GLOSSAIRE_ALPHABARRE_LETTER_NOT_EXIST', "Style des lettres inexistantes");
\define('_MI_GLOSSAIRE_ALPHABARRE_LETTER_NOT_EXIST_DESC', "Style des lettres quand des définitions commençant par cette-ci n'existent pas.");

\define('_MI_GLOSSAIRE_BTN_ACTION_POS', "Position des boutons d'action");
\define('_MI_GLOSSAIRE_BTN_ACTION_POS_DESC', "Détermine pour chaque item la  position des boutons edit/delete/new/top/...");
\define('_MI_GLOSSAIRE_BTN_ACTION_POS_NONE', "Aucun bouton (utiliser l'admin pour ces actions)");
\define('_MI_GLOSSAIRE_BTN_ACTION_POS_TOP', "En haut à droite du terme");
\define('_MI_GLOSSAIRE_BTN_ACTION_POS_BOTTOM', "En bas à droite de la fiche du terme");
\define('_MI_GLOSSAIRE_BTN_ACTION_POS_ALL', "En haut à droite et en bas à droite");



/*
\define('', "");
\define('', "");
*/
// ---------------- End ----------------
