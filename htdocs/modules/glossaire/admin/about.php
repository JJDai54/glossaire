<?php
namespace XoopsModules\Quizmaker;
/*
 You may not change or alter any portion of this comment or credits
 of supporting developers from this source code or any supporting source code
 which is considered copyrighted (c) material of the original comment or credit authors.

 This program is distributed in the hope that it will be useful,
 but WITHOUT ANY WARRANTY; without even the implied warranty of
 MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
*/

/**
 * quizmaker - Slides management module for xoops
 *
 * @copyright      2020 XOOPS Project (https://xooops.org)
 * @license        GPL 2.0 or later
 * @package        quizmaker
 * @since          1.0
 * @min_xoops      2.5.9
 * @author         JJDai - Email:<jjdelalandre@orange.fr> - Website:<http://jubile.fr>
 */
use XoopsModules\Glossaire;
use XoopsModules\Glossaire\Helper;
use XoopsModules\Glossaire\Constants;

//require_once XOOPS_ROOT_PATH . '/modules/quizmaker/admin/header.php';
require_once 'header.php';
$templateMain = 'glossaire_admin_about.tpl';


$box = array();
$clAbout = new \About($glossaireHelper);
/* ------------------------- PAYPAL -----------------------------*/

$box['module']['legend'] = _AM_MODULEADMIN_ABOUT_MODULEINFO;
$box['module']['content'] = $clAbout->htmlTableInfo();

/* ------------------------- Module -----------------------------*/
$box['paypal']['legend'] = _AM_JJD_ABOUT_CONTRIBUTION;
$box['paypal']['content'] = $clAbout->contribution('MUUZPTPGJSB9G',
                            "https://www.paypalobjects.com/en_US/i/btn/btn_donate_SM.gif",
                            "https://www.paypal.com/en_FR/i/scr/pixel.gif");

/* ------------------------- Header Info -----------------------------*/
$box['header']['legend'] = "header";
$box['header']['content'] = $clAbout->localHeaderInfo();

/* ------------------------- Chanlog -----------------------------*/
$box['changelog']['legend'] = _AM_MODULEADMIN_ABOUT_CHANGELOG;
$box['changelog']['content'] = $clAbout->changelog();


/************************************************************************/
$adminObject->displayNavigation('about.php');
$GLOBALS['xoopsTpl']->assign('box', $box);
$GLOBALS['xoopsTpl']->assign('tplAbout', XOOPS_ROOT_PATH . "/Frameworks/JJD-Framework/templates/admin_about.tpl");

require __DIR__ . '/footer.php';
