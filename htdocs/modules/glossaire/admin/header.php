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
require \dirname(__DIR__, 3) . '/include/cp_header.php';
require_once \dirname(__DIR__) . '/include/common.php';
//require_once \dirname(__DIR__) . '/include/functions-colors-set.php';
//xoops_load('XoopsFormLoader');
include_once (XOOPS_ROOT_PATH . "/Frameworks/janus/load.php");
\JANUS\loadAllXForms();

$sysPathIcon16   = '../' . $GLOBALS['xoopsModule']->getInfo('sysicons16');
$sysPathIcon32   = '../' . $GLOBALS['xoopsModule']->getInfo('sysicons32');
$pathModuleAdmin = $GLOBALS['xoopsModule']->getInfo('dirmoduleadmin');
$modPathIcon16   = \GLOSSAIRE_URL . '/' . $GLOBALS['xoopsModule']->getInfo('modicons16') ; //. '/'
$modPathIcon32   = \GLOSSAIRE_URL . '/' . $GLOBALS['xoopsModule']->getInfo('modicons32') ; //. '/'

// Get instance of module
$glossaireHelper = \XoopsModules\Glossaire\Helper::getInstance();
$categoriesHandler = $glossaireHelper->getHandler('Categories');
$entriesHandler = $glossaireHelper->getHandler('Entries');
$myts = MyTextSanitizer::getInstance();
// 
if (!isset($xoopsTpl) || !\is_object($xoopsTpl)) {
    require_once \XOOPS_ROOT_PATH . '/class/template.php';
    $xoopsTpl = new \XoopsTpl();
}

// Load languages
\xoops_loadLanguage('admin');
\xoops_loadLanguage('modinfo');
\xoops_loadLanguage('common', 'glossaire');

// Local admin menu class
if (\file_exists($GLOBALS['xoops']->path($pathModuleAdmin.'/moduleadmin.php'))) {
    require_once $GLOBALS['xoops']->path($pathModuleAdmin.'/moduleadmin.php');
} else {
    \redirect_header('../../../admin.php', 5, \_AM_MODULEADMIN_MISSING);
}


xoops_cp_header();
$glossaireHelper = \XoopsModules\Glossaire\Helper::getInstance();

//$xoTheme->addScript(XOOPS_URL . '/Frameworks/trierTableauHTML/trierTableau.js');
\JANUS\load_trierTableauHTML();
$clPerms = new \JanusPermissions('glossaire');
//$GLOBALS['xoTheme']->addScript(XOOPS_URL . '/Frameworks/trierTableauHTML/trierTableau.js');

// System icons path
$GLOBALS['xoopsTpl']->assign('sysPathIcon16', $sysPathIcon16);
$GLOBALS['xoopsTpl']->assign('sysPathIcon32', $sysPathIcon32);
$GLOBALS['xoopsTpl']->assign('modPathIcon16', $modPathIcon16);
$GLOBALS['xoopsTpl']->assign('modPathIcon32', $modPathIcon32);

//include_once (XOOPS_ROOT_PATH . '\class\file\folder.php');       
$xoopsFolder = new \XoopsFolderHandler(); 

$adminObject = \Xmf\Module\Admin::getInstance();
$style = \GLOSSAIRE_URL . '/assets/css/admin/style.css';

