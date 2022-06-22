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

\define('CO_GLOSSAIRE_GDLIBSTATUS', "Support de la bibliothèque GD : ");
\define('CO_GLOSSAIRE_GDLIBVERSION', "Version de la bibliothèque GD : ");
\define('CO_GLOSSAIRE_GDOFF', "<span style='font-weight: bold;'>Désactivé</span> (Aucune vignette disponible)");
\define('CO_GLOSSAIRE_GDON', "<span style='font-weight: bold;'>Activé</span> (Vignettes disponibles)");
\define('CO_GLOSSAIRE_IMAGEINFO', "Etat du serveur");
\define('CO_GLOSSAIRE_MAXPOSTSIZE', "Taille maximale de publication autorisée (directive post_max_size dans php.ini): ");
\define('CO_GLOSSAIRE_MAXUPLOADSIZE', "Taille maximale de téléchargement autorisée (directive upload_max_filesize dans php.ini): ");
\define('CO_GLOSSAIRE_MEMORYLIMIT', "Limite de mémoire (directive memory_limit dans php.ini): ");
\define('CO_GLOSSAIRE_METAVERSION', "<span style='font-weight: bold;'>Télécharge la méta version :</span> ");
\define('CO_GLOSSAIRE_OFF', "<span style='font-weight: bold;'>OFF</span>");
\define('CO_GLOSSAIRE_ON', "<span style='font-weight: bold;'>ON</span>");
\define('CO_GLOSSAIRE_SERVERPATH', "Chemin du serveur vers la racine XOOPS : ");
\define('CO_GLOSSAIRE_SERVERUPLOADSTATUS', "Statut des téléchargements du serveur : ");
\define('CO_GLOSSAIRE_SPHPINI', "<span style='font-weight: bold;'>Information extraite du fichier PHP ini :</span>");
\define('CO_GLOSSAIRE_UPLOADPATHDSC', "Remarque. Le chemin de téléchargement *DOIT* contenir le chemin complet du serveur de votre dossier de téléchargement.");

\define('CO_GLOSSAIRE_PRINT', "<span style='font-weight: bold;'>Imprimer</span>");
\define('CO_GLOSSAIRE_PDF', "<span style='font-weight: bold;'>Créer un PDF</span>");

\define('CO_GLOSSAIRE_UPGRADEFAILED0', "Échec de la mise à jour - impossible de renommer le champ '%s'");
\define('CO_GLOSSAIRE_UPGRADEFAILED1', "Échec de la mise à jour - impossible d'ajouter de nouveaux champs");
\define('CO_GLOSSAIRE_UPGRADEFAILED2', "Échec de la mise à jour - impossible de renommer la table '%s'");
\define('CO_GLOSSAIRE_ERROR_COLUMN', "Impossible de créer une colonne dans la base de données : %s");
\define('CO_GLOSSAIRE_ERROR_BAD_XOOPS', "Ce module nécessite XOOPS %s+ (%s installé)");
\define('CO_GLOSSAIRE_ERROR_BAD_PHP', "Ce module nécessite PHP version %s+ (%s installé)");
\define('CO_GLOSSAIRE_ERROR_TAG_REMOVAL', "Impossible de supprimer les balises du module de balises");

\define('CO_GLOSSAIRE_FOLDERS_DELETED_OK', "Les dossiers de téléchargement ont été supprimés");

// Message d'erreur
\define('CO_GLOSSAIRE_ERROR_BAD_DEL_PATH', "Impossible de supprimer le répertoire %s");
\define('CO_GLOSSAIRE_ERROR_BAD_REMOVE', "Impossible de supprimer %s");
\define('CO_GLOSSAIRE_ERROR_NO_PLUGIN', "Impossible de charger le plugin");

//Aider
\define('CO_GLOSSAIRE_DIRNAME', \basename(\dirname(__DIR__, 2)));
\define('CO_GLOSSAIRE_HELP_HEADER', __DIR__ . "/help/helpheader.tpl");
\define('CO_GLOSSAIRE_BACK_2_ADMIN', "Retour à l'administration de ");
\define('CO_GLOSSAIRE_OVERVIEW', "Vue d'ensemble");

//\define('CO_GLOSSAIRE_HELP_DIR', __DIR__);

// aide multi-page
\define('CO_GLOSSAIRE_DISCLAIMER', "Avis de non-responsabilité");
\define('CO_GLOSSAIRE_LICENSE', "Licence");
\define('CO_GLOSSAIRE_SUPPORT', "Soutien");

//SampleData
\define('_CO_GLOSSAIRE_ADD_SAMPLEDATA', "Importer des exemples de données (supprimera TOUTES les données actuelles)");
\define('_CO_GLOSSAIRE_SAMPLEDATA_SUCCESS', "Exemples de données importés avec succès");
\define('_CO_GLOSSAIRE_SAVE_SAMPLEDATA', "Exporter les tableaux vers YAML");
\define('_CO_GLOSSAIRE_SAVE_SAMPLEDATA_SUCCESS', "Exporter les tableaux vers YAML avec succès");
\define('_CO_GLOSSAIRE_SAVE_SAMPLEDATA_ERROR', "ERROR: Export of Tables to YAML failed");
\define('_CO_GLOSSAIRE_SHOW_SAMPLE_BUTTON', "Show Sample Button?");
\define('_CO_GLOSSAIRE_SHOW_SAMPLE_BUTTON_DESC', "Si oui, le bouton \"Ajouter des exemples de données\" sera visible par l'administrateur. Il est Oui par défaut pour la première installation.");
\define('_CO_GLOSSAIRE_EXPORT_SCHEMA', "Exporter le schéma de base de données vers YAML");
\define('_CO_GLOSSAIRE_EXPORT_SCHEMA_SUCCESS', "Export DB Schema to YAML was a success");
\define('_CO_GLOSSAIRE_EXPORT_SCHEMA_ERROR', "ERROR: Export of DB Schema to YAML failed");
\define('_CO_GLOSSAIRE_ADD_SAMPLEDATA_OK', "Êtes-vous sûr d'importer des exemples de données ? (Cela supprimera TOUTES les données actuelles)");
\define('_CO_GLOSSAIRE_HIDE_SAMPLEDATA_BUTTONS', "Masquer les boutons d'importation");
\define('_CO_GLOSSAIRE_SHOW_SAMPLEDATA_BUTTONS', "Afficher les boutons d'importation");
\define('_CO_GLOSSAIRE_CONFIRMER', "Confirmer");

// choix de lettres
\define('_CO_GLOSSAIRE_BROWSETOTOPIC', "<span style='font-weight: bold;'>Parcourir les éléments par ordre alphabétique</span>");
\define('_CO_GLOSSAIRE_AUTRE', "Autre");
\define('_CO_GLOSSAIRE_TOUS', "Tous");

// définition du bloc
\define('_CO_GLOSSAIRE_ACCESSRIGHTS', "Droits d'accès");
\define('_CO_GLOSSAIRE_ACTION', "Action");
\define('_CO_GLOSSAIRE_ACTIVERIGHTS', "Active Rights");
\define('_CO_GLOSSAIRE_BADMIN', "Bloquer l'administration");
\define('_CO_GLOSSAIRE_BLKDESC', "Description");
\define('_CO_GLOSSAIRE_CBCENTER', "Centre Milieu");
\define('_CO_GLOSSAIRE_CBLEFT', "Centre Gauche");
\define('_CO_GLOSSAIRE_CBRIGHT', "Centre Droit");
\define('_CO_GLOSSAIRE_SBLEFT', "Gauche");
\define('_CO_GLOSSAIRE_SBRIGHT', "Droite");
\define('_CO_GLOSSAIRE_COTE', "Alignement");
\define('_CO_GLOSSAIRE_TITRE', "Titre");
\define('_CO_GLOSSAIRE_VISIBLE', "Visible");
\define('_CO_GLOSSAIRE_VISIBLEIN', "Visible dans");
\define('_CO_GLOSSAIRE_POIDS', "Poids");

\define('_CO_GLOSSAIRE_PERMISSIONS', "Permissions");
\define('_CO_GLOSSAIRE_BLOCS', "Blocs Admin");
\define('_CO_GLOSSAIRE_BLOCKS_DESC', "Blocks/Group Admin");

\define('_CO_GLOSSAIRE_GESTION_BLOCS', "Gérer");
\define('_CO_GLOSSAIRE_BLOCKS_ADDBLOCK', "Ajouter un nouveau bloc");
\define('_CO_GLOSSAIRE_BLOCS_EDITBLOC', "Editer un bloc");
\define('_CO_GLOSSAIRE_BLOCS_CLONEBLOC', "Cloner un bloc");

//myblocksadmin
\define('_CO_GLOSSAIRE_AGDS', "Groupes admin");
\define('_CO_GLOSSAIRE_BCACHETIME', "Temps du cache");
\define('_CO_GLOSSAIRE_BLOCKS_ADMIN', "Blocks Admin");

//TemplateAdmin
\define('_CO_GLOSSAIRE_TPLSETS', "Gestion des templates");
\define('_CO_GLOSSAIRE_GENERER', "Générer");
\define('_CO_GLOSSAIRE_FILENAME', "File Name");

//Menu
\define('_CO_GLOSSAIRE_ADMENU_MIGRATE', "Migrer");
\define('_CO_GLOSSAIRE_DOSSIER_OUI', "Le dossier \"%s\" existe");
\define('_CO_GLOSSAIRE_FOLDER_NO', "Le dossier \"%s\" n'existe pas. Créer le dossier spécifié avec CHMOD 777.");
\define('_CO_GLOSSAIRE_SHOW_DEV_TOOLS', "Afficher le bouton Outils de développement ?");
\define('_CO_GLOSSAIRE_SHOW_DEV_TOOLS_DESC', "Si oui, l'onglet \"Migrate\" et les autres outils de développement seront visibles par l'administrateur.");
\define('_CO_GLOSSAIRE_ADMENU_FEEDBACK', "Commentaires");

//Vérification de la dernière version
\define('_CO_GLOSSAIRE_NOUVELLE_VERSION', "Nouvelle version : ");

// Vérificateur de répertoire
\define('_CO_GLOSSAIRE_DISPONIBLE', "<span style='color: green;'>Disponible</span>");
\define('_CO_GLOSSAIRE_NON DISPONIBLE', "<span style='color: red;'>Non disponible</span>");
\define('_CO_GLOSSAIRE_NOTWRITABLE', "<span style='color: red;'>Devrait avoir la permission ( %d ), mais il a ( %d )</span>");
\define('_CO_GLOSSAIRE_CREATETHEDIR', "Créer");
\define('_CO_GLOSSAIRE_SETMPERM', "Définir la permission");
\define('_CO_GLOSSAIRE_DIRCREATED', "Le répertoire a été créé");
\define('_CO_GLOSSAIRE_DIRNOTCREATED', "Impossible de créer le répertoire");
\define('_CO_GLOSSAIRE_PERMSET', "La permission a été définie");
\define('_CO_GLOSSAIRE_PERMNOTSET', "La permission ne peut pas être définie");

//Vérificateur de fichiers
//\define('_CO_GLOSSAIRE_DISPONIBLE', "<span style='color: green;'>Disponible</span>");
//\define('_CO_GLOSSAIRE_NON DISPONIBLE', "<span style='color: red;'>Non disponible</span>");
//\define('_CO_GLOSSAIRE_NOTWRITABLE', "<span style='color: red;'>Devrait avoir la permission ( %d ), mais il a ( %d )</span>");
//\define('_CO_GLOSSAIRE_COPYTHEFILE', "Copy it");
//\define('_CO_GLOSSAIRE_CREATETHEFILE', "Créer");
//\define('_CO_GLOSSAIRE_SETMPERM', "Définir la permission");

\define('_CO_GLOSSAIRE_FILECOPIED', "Le fichier a été copié");
\define('_CO_GLOSSAIRE_FILENOTCOPIED', "Le fichier ne peut pas être copié");

//\define('_CO_GLOSSAIRE_PERMSET', "La permission a été définie");
//\define('_CO_GLOSSAIRE_PERMNOTSET', "La permission ne peut pas être définie");

//imageconfig
\define('_CO_GLOSSAIRE_IMAGE_WIDTH', "Largeur d'affichage de l'image");
\define('_CO_GLOSSAIRE_IMAGE_WIDTH_DSC', "Largeur d'affichage pour l'image");
\define('_CO_GLOSSAIRE_HAUTEUR_IMAGE', "Hauteur d'affichage de l'image");
\define('_CO_GLOSSAIRE_HAUTEUR_IMAGE_DSC', "Hauteur d'affichage pour l'image");
\define('_CO_GLOSSAIRE_IMAGE_CONFIG', "<span style=\"color: #FF0000; font-size: Small; font-weight: bold;\">--- EXTERNAL Image configuration ---</span> ");
\define('_CO_GLOSSAIRE_IMAGE_CONFIG_DSC', "");
\define('_CO_GLOSSAIRE_IMAGE_UPLOAD_PATH', "Chemin de téléchargement de l'image");
\define('_CO_GLOSSAIRE_IMAGE_UPLOAD_PATH_DSC', "Chemin de téléchargement des images");

//Préférences
\define('_CO_GLOSSAIRE_TRUNCATE_LENGTH', "Nombre de caractères à tronquer dans le champ de texte long");
\define('_CO_GLOSSAIRE_TRUNCATE_LENGTH_DESC', "Définir le nombre maximum de caractères pour tronquer les champs de texte longs");

//Statistiques du module
\define('_CO_GLOSSAIRE_STATS_SUMMARY', "Module Statistiques");
\define('_CO_GLOSSAIRE_TOTAL_CATEGORIES', "Catégories :");
\define('_CO_GLOSSAIRE_TOTAL_ITEMS', "Articles");
\define('_CO_GLOSSAIRE_TOTAL_OFFLINE', "Hors ligne");
\define('_CO_GLOSSAIRE_TOTAL_PUBLISHED', "Publié");
\define('_CO_GLOSSAIRE_TOTAL_REJECTED', "Rejected");
\define('_CO_GLOSSAIRE_TOTAL_SOUMIS', "Soumis");
\define('_CO_GLOSSAIRE_CATEGORY', "Catégorie");
\define('_CO_GLOSSAIRE_STATUS', "Statut");
