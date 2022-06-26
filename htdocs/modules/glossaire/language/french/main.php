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
\define('_MA_GLOSSAIRE_INDEX', "Vue d'ensemble Glossaire");
\define('_MA_GLOSSAIRE_TITLE', "Glossaire");
\define('_MA_GLOSSAIRE_DESC', "Module de gestion des glossaires");
\define('_MA_GLOSSAIRE_INDEX_DESC', "Bienvenue sur la page d'accueil de votre nouveau module Glossaire !<br>
Comme vous pouvez le voir, vous avez créé une page avec une liste de liens en haut pour naviguer entre les pages de votre module. Cette description n'est visible que sur la page d'accueil de ce module, sur les autres pages vous verrez le contenu que vous avez créé lorsque vous avez construit ce module avec le module ModuleBuilder, et après avoir créé un nouveau contenu dans l'admin de ce module. Afin d'étendre ce module avec d'autres ressources, ajoutez simplement le code dont vous avez besoin pour étendre les fonctionnalités de celui-ci. Les fichiers sont regroupés par type, de l'en-tête au pied de page pour voir comment divisé le code source.<br><br>Si vous voyez ce message, c'est parce que vous n'avez pas créé de contenu pour ce module. Une fois que vous avez créé n'importe quel type de contenu, vous ne verrez pas ce message.<br><br>Si vous avez aimé le module ModuleBuilder et grâce au long processus pour donner la possibilité au nouveau module d'être créé en un instant, considérez faire un don pour conserver le module ModuleBuilder et faire un don en utilisant ce bouton <a href='https://xoops.org/modules/xdonations/index.php' title='Donation To Txmod Xoops'><img src=' https://www.paypal.com/en_US/i/btn/btn_donate_LG.gif' alt='Button Donations' ></a><br>Merci !<br><br>Utilisez le lien ci-dessous pour accéder au admin et créer du contenu.");
\define('_MA_GLOSSAIRE_NO_PDF_LIBRARY', "Les bibliothèques TCPDF ne sont pas encore là, chargez-les à la racine/Frameworks");
\define('_MA_GLOSSAIRE_NO', "Non");
\define('_MA_GLOSSAIRE_DETAILS', "Afficher les détails");
\define('_MA_GLOSSAIRE_BROKEN', "Notification cassée");
// ---------------- Contenu ----------------
// Catégorie
\define('_MA_GLOSSAIRE_CATEGORY', "Catégorie");
\define('_MA_GLOSSAIRE_CATEGORY_ADD', "Ajouter une catégorie");
\define('_MA_GLOSSAIRE_CATEGORY_EDIT', "Modifier la catégorie");
\define('_MA_GLOSSAIRE_CATEGORY_DELETE', "Supprimer la catégorie");
\define('_MA_GLOSSAIRE_CATEGORY_CLONE', "Cloner la catégorie");
\define('_MA_GLOSSAIRE_CATEGORIES', "Catégories");
\define('_MA_GLOSSAIRE_CATEGORIES_LIST', "Liste des catégories");
\define('_MA_GLOSSAIRE_CATEGORIES_TITLE', "Titre des catégories");
\define('_MA_GLOSSAIRE_CATEGORIES_DESC', "Description des catégories");
// Légende de la catégorie
\define('_MA_GLOSSAIRE_CATEGORY_ID', "Identifiant");
\define('_MA_GLOSSAIRE_CATEGORY_NAME', "Nom");
\define('_MA_GLOSSAIRE_CATEGORY_DESCRIPTION', "Description");
\define('_MA_GLOSSAIRE_CATEGORY_TOTAL', "Totale");
\define('_MA_GLOSSAIRE_CATEGORY_WEIGHT', "Poids");
\define('_MA_GLOSSAIRE_CATEGORY_LOGOURL', "Logourl");
\define('_MA_GLOSSAIRE_CATEGORY_DATE_CREATION', "Date_création");
\define('_MA_GLOSSAIRE_CATEGORY_DATE_UPDATE', "Date_update");
// Entrée
\define('_MA_GLOSSAIRE_ENTRY', "Entrée");
\define('_MA_GLOSSAIRE_ENTRY_ADD', "Ajouter une entrée");
\define('_MA_GLOSSAIRE_ENTRY_EDIT', "Modifier l'entrée");
\define('_MA_GLOSSAIRE_ENTRY_DELETE', "Supprimer l'entrée");
\define('_MA_GLOSSAIRE_ENTRY_CLONE', "Clone d'entrée");
\define('_MA_GLOSSAIRE_ENTRIES', "Entrée");
\define('_MA_GLOSSAIRE_ENTRIES_LIST', "Liste des entrées");
\define('_MA_GLOSSAIRE_ENTRIES_TITLE', "Titre des entrées");
\define('_MA_GLOSSAIRE_ENTRIES_DESC', "Description des entrées");
// Légende de l'entrée
\define('_MA_GLOSSAIRE_ENTRY_ID', "Identifiant");
\define('_MA_GLOSSAIRE_ENTRY_CAT_ID', "Cat_id");
\define('_MA_GLOSSAIRE_ENTRY_UID', "UId");
\define('_MA_GLOSSAIRE_ENTRY_TERM', "Terme");
\define('_MA_GLOSSAIRE_ENTRY_SHORTDEF', "Définition courte");
\define('_MA_GLOSSAIRE_ENTRY_DEFINITION', "Définition");
\define('_MA_GLOSSAIRE_ENTRY_REFERENCE', "Référence");
\define('_MA_GLOSSAIRE_ENTRY_URL1', "Url1");
\define('_MA_GLOSSAIRE_ENTRY_URL2', "Url2");
\define('_MA_GLOSSAIRE_ENTRY_DATE_CREATION', "Date_création");
\define('_MA_GLOSSAIRE_ENTRY_DATE_UPDATE', "Date_update");
\define('_MA_GLOSSAIRE_ENTRY_COUNTER', "Compteur");
\define('_MA_GLOSSAIRE_ENTRY_STATUS', "Statut");
\define('_MA_GLOSSAIRE_ENTRY_FLAG', "Drapeau");
\define('_MA_GLOSSAIRE_INDEX_THEREARE', "Il y a %s entrées");
\define('_MA_GLOSSAIRE_INDEX_LATEST_LIST', "Dernier glossaire");
// Soumettre
\define('_MA_GLOSSAIRE_SUBMIT', "Soumettre");
// formulaire
\define('_MA_GLOSSAIRE_FORM_OK', "Sauvegardé avec succès");
\define('_MA_GLOSSAIRE_FORM_DELETE_OK', "Supprimé avec succès");
\define('_MA_GLOSSAIRE_FORM_SURE_DELETE', "Etes-vous sûr de supprimer : <b><span style='color : Red;'>%s </span></b>");
\define('_MA_GLOSSAIRE_FORM_SURE_RENEW', "Êtes-vous sûr de mettre à jour : <b><span style='color : Red;'>%s </span></b>");
\define('_MA_GLOSSAIRE_INVALID_PARAM', 'Paramètre invalide');
//Lien administrateur
\define('_MA_GLOSSAIRE_ADMIN', "Admin");

// ---------------- JJD ----------------
\define('_MA_GLOSSAIRE_ALL', "Tout");
\define('_MA_GLOSSAIRE_ENTRY_NEW', "Ajouter un nouveau terme");
\define('_MA_GLOSSAIRE_TOP', "Haut de page");
\define('_MA_GLOSSAIRE_ENTRY_SEARCH', "Chercher");
\define('_MA_GLOSSAIRE_SEEALSO', "Voir aussi");
\define('_AM_GLOSSAIRE_NO_GLOSSAIRE', "Il n'y a aucun glossaire accessible");

\define('_MA_GLOSSAIRE_REFERENCES', "Références");
\define('_MA_GLOSSAIRE_ENTRY_SOUMETTRE', "Soumettre un terme");
// ---------------- End ----------------
