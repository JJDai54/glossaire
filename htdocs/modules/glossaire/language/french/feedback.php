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
 * feedback plugin for xoops modules
 *
 * @copyright      module for xoops
 * @license        GPL 2.0 or later
 * @package        general
 * @since          1.0
 * @min_xoops      2.5.11
 * @author         XOOPS - Website:<https://xoops.org>
 */
$moduleDirName      = \basename(\dirname(__DIR__, 2));
$moduleDirNameUpper = \mb_strtoupper($moduleDirName);

\define('_FB_GLOSSAIRE_FORM_TITLE', "Envoyer un commentaire");
\define('_FB_GLOSSAIRE_RECIPIENT', "Destinataire");
\define('_FB_GLOSSAIRE_NAME', "Nom");
\define('_FB_GLOSSAIRE_NAME_PLACEHOLER', "Veuillez saisir votre nom");
\define('_FB_GLOSSAIRE_SITE', "Site Web");
\define('_FB_GLOSSAIRE_SITE_PLACEHOLER', "Veuillez entrer votre site Web");
\define('_FB_GLOSSAIRE_MAIL', "Courriel");
\define('_FB_GLOSSAIRE_MAIL_PLACEHOLER', "Veuillez saisir votre email");
\define('_FB_GLOSSAIRE_TYPE', "Type de retour");
\define('_FB_GLOSSAIRE_TYPE_SUGGESTION', "Suggestions");
\define('_FB_GLOSSAIRE_TYPE_BUGS', "Bogues");
\define('_FB_GLOSSAIRE_TYPE_TESTIMONIAL', "Témoignages");
\define('_FB_GLOSSAIRE_TYPE_FEATURES', "Caractéristiques");
\define('_FB_GLOSSAIRE_TYPE_OTHERS', "Divers");
\define('_FB_GLOSSAIRE_TYPE_CONTENT', "Contenu des commentaires");
\define('_FB_GLOSSAIRE_SEND_FOR', "Retour pour le module ");
\define('_FB_GLOSSAIRE_SEND_SUCCESS', "Commentaire envoyé avec succès");
\define('_FB_GLOSSAIRE_SEND_ERROR', "Une erreur s'est produite lors de l'envoi des commentaires !");
