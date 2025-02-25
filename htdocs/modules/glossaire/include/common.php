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
 * @author        Jean-Jacques DELALANDRE - Email:<jjdelalandre@orange.fr> - Website:<xoopsfr.kiolo.fr>
 */
if (!\defined('XOOPS_ICONS32_PATH')) {
    \define('XOOPS_ICONS32_PATH', \XOOPS_ROOT_PATH . '/Frameworks/moduleclasses/icons/32');
}
if (!\defined('XOOPS_ICONS32_URL')) {
    \define('XOOPS_ICONS32_URL', \XOOPS_URL . '/Frameworks/moduleclasses/icons/32');
}
if (isset($xoopsModuleConfig)) 
    define('GLOSSAIRE_SHOW_TPL_NAME', $xoopsModuleConfig['displayTemplateName']);
else 
    define('GLOSSAIRE_SHOW_TPL_NAME', 0);


define('GLOSSAIRE_CHIFFRES', '#');

\define('GLOSSAIRE_DIRNAME', 'glossaire');
\define('GLOSSAIRE_PATH', \XOOPS_ROOT_PATH . '/modules/' . GLOSSAIRE_DIRNAME);
\define('GLOSSAIRE_URL', \XOOPS_URL . '/modules/' . GLOSSAIRE_DIRNAME);
\define('GLOSSAIRE_ICONS_PATH', \GLOSSAIRE_PATH . '/assets/icons');
\define('GLOSSAIRE_ICONS_URL', \GLOSSAIRE_URL . '/assets/icons');
\define('GLOSSAIRE_IMAGE_PATH', \GLOSSAIRE_PATH . '/assets/images');
\define('GLOSSAIRE_IMAGE_URL', \GLOSSAIRE_URL . '/assets/images');
\define('GLOSSAIRE_UPLOAD_PATH', \XOOPS_UPLOAD_PATH . '/' . GLOSSAIRE_DIRNAME);
\define('GLOSSAIRE_UPLOAD_URL', \XOOPS_UPLOAD_URL . '/' . GLOSSAIRE_DIRNAME);
\define('GLOSSAIRE_UPLOAD_FILES_PATH', \GLOSSAIRE_UPLOAD_PATH . '/files');
\define('GLOSSAIRE_UPLOAD_FILES_URL', \GLOSSAIRE_UPLOAD_URL . '/files');
\define('GLOSSAIRE_UPLOAD_IMAGE_PATH', \GLOSSAIRE_UPLOAD_PATH . '/images');
\define('GLOSSAIRE_UPLOAD_IMAGE_URL', \GLOSSAIRE_UPLOAD_URL . '/images');
\define('GLOSSAIRE_UPLOAD_SHOTS_PATH', \GLOSSAIRE_UPLOAD_PATH . '/images/shots');
\define('GLOSSAIRE_UPLOAD_SHOTS_URL', \GLOSSAIRE_UPLOAD_URL . '/images/shots');
\define('GLOSSAIRE_ADMIN', \GLOSSAIRE_URL . '/admin/index.php');

\define('GLOSSAIRE_UPLOAD_IMG_FOLDER', '/images/glossaires');
\define('GLOSSAIRE_UPLOAD_IMG_FOLDER_PATH', \GLOSSAIRE_UPLOAD_PATH . GLOSSAIRE_UPLOAD_IMG_FOLDER);
\define('GLOSSAIRE_UPLOAD_IMG_FOLDER_URL', \GLOSSAIRE_UPLOAD_URL   . GLOSSAIRE_UPLOAD_IMG_FOLDER);
\define('GLOSSAIRE_UPLOAD_IMPORT_PATH', \GLOSSAIRE_UPLOAD_PATH . '/imports');
\define('GLOSSAIRE_UPLOAD_IMPORT_DIRECT_PATH', \GLOSSAIRE_UPLOAD_PATH . '/imports-directs');

\define('GLOSSAIRE_UPLOAD_IMPORT_DATA_PATH', \GLOSSAIRE_UPLOAD_PATH . '/data');
\define('GLOSSAIRE_UPLOAD_IMPORT_DATA_URL',  \GLOSSAIRE_UPLOAD_URL  . '/data');
\define('GLOSSAIRE_UPLOAD_IMPORT_DATA_FULL_PATH', XOOPS_ROOT_PATH . \GLOSSAIRE_UPLOAD_PATH . '/data');
\define('GLOSSAIRE_UPLOAD_IMPORT_DATA_FULL_URL',  XOOPS_URL . \GLOSSAIRE_UPLOAD_URL  . '/data');

\define('GLOSSAIRE_STATUS_INACTIF', 0);
\define('GLOSSAIRE_PROPOSITION', 1);
\define('GLOSSAIRE_STATUS_APPROVED', 2);
\define('GLOSSAIRE_STATUS_ALL', -1);


$localLogo = \GLOSSAIRE_IMAGE_URL . '/xoopsdevelopmentteam_logo.png';
// Module Information
$copyright = "<a href='xoopsfr.kiolo.fr' title='XOOPS Project' target='_blank'><img src='" . $localLogo . "' alt='XOOPS Project' ></a>";
require_once \XOOPS_ROOT_PATH . '/class/xoopsrequest.php';
require_once \GLOSSAIRE_PATH . '/include/functions.php';

//--------- a mettre dans xoops_version.php
define('GLOSSAIRE_CATEGORY_CSS_NAME_FILE', "glossaire-category.css"); 

define('GLOSSAIRE_TPL_ENTRIES_DEFAULT', 'glossaire_admin_entries_narrow.tpl'); //large ou narrow
define('GLOSSAIRE_TPL_CATEGORIES_DEFAULT', 'glossaire_admin_categories_narrow.tpl'); //large ou narrow

$h = 0;
define('GLOSSAIRE_ENT_ID', $h++);
define('GLOSSAIRE_ENT_SHORTDEF', $h++);
define('GLOSSAIRE_ENT_MAGNIFY', $h++);
define('GLOSSAIRE_ENT_DEFINITION', $h++);
define('GLOSSAIRE_ENT_CREATOR', $h++);
define('GLOSSAIRE_ENT_IMAGE', $h++);
define('GLOSSAIRE_ENT_REFERENCE', $h++);
define('GLOSSAIRE_ENT_FILE_NAME', $h++);
define('GLOSSAIRE_ENT_URLS', $h++);
define('GLOSSAIRE_ENT_EMAIL', $h++);
define('GLOSSAIRE_ENT_COUNTER', $h++);
define('GLOSSAIRE_ENT_DATE_CREATION', $h++);
define('GLOSSAIRE_ENT_DATE_UPDATE', $h++);
define('GLOSSAIRE_ENT_BTN_ACTIONS_TOP', $h++);
define('GLOSSAIRE_ENT_BTN_ACTIONS_BOTTOM', $h++);
define('GLOSSAIRE_ENT_LINK', $h++);
define('GLOSSAIRE_ENT_ADD_LINK_IN_URLS', $h++);

$h = 0;
define('GLOSSAIRE_CAT_ID', $h++);
define('GLOSSAIRE_CAT_BR_AFTER_TERM', $h++); //Retour à la ligne après le terme
define('GLOSSAIRE_CAT_MAGNIFY', $h++);
define('GLOSSAIRE_CAAT_DEFINITION', $h++);
define('GLOSSAIRE_CAT_CREATOR', $h++);
define('GLOSSAIRE_CAT_IMAGE', $h++);

$h = 1;
define("GLOSSAIRE_PERM_MANCATS", $h++);
define("GLOSSAIRE_PERM_IMPORT", $h++);
define("GLOSSAIRE_PERM_EXPORT", $h++);
define("GLOSSAIRE_PERM_CLONE", $h++);
define("GLOSSAIRE_PERM_PERMS", $h++);

