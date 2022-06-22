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

$dirname       = \basename(\dirname(__DIR__));
$moduleHandler = \xoops_getHandler('module');
$xoopsModule   = XoopsModule::getByDirname($dirname);
$moduleInfo    = $moduleHandler->get($xoopsModule->getVar('mid'));
$sysPathIcon32 = $moduleInfo->getInfo('sysicons32');

$adminmenu[] = [
    'title' => \_MI_GLOSSAIRE_ADMENU1,
    'link' => 'admin/index.php',
    'icon' => $sysPathIcon32.'/dashboard.png',
];
$adminmenu[] = [
    'title' => \_MI_GLOSSAIRE_ADMENU2,
    'link' => 'admin/categories.php',
    'icon' => 'assets/icons/32/category.png',
];
$adminmenu[] = [
    'title' => \_MI_GLOSSAIRE_ADMENU3,
    'link' => 'admin/entries.php',
    'icon' => 'assets/icons/32/translations.png',
];
$adminmenu[] = [
	'title' => _MI_GLOSSAIRE_EXPORT,
	'link' => 'admin/export.php',
	'icon' => $sysPathIcon32 . '/upload.png',
];

$adminmenu[] = [
	'title' => _MI_GLOSSAIRE_IMPORT,
	'link' => 'admin/import.php',
	'icon' => $sysPathIcon32 . '/download.png',
];

$adminmenu[] = [
    'title' => \_MI_GLOSSAIRE_ADMENU4,
    'link' => 'admin/permissions.php',
    'icon' => $sysPathIcon32.'/permissions.png',
];
$adminmenu[] = [
    'title' => \_MI_GLOSSAIRE_ADMENU5,
    'link' => 'admin/clone.php',
    'icon' => $sysPathIcon32.'/page_copy.png',
];
$adminmenu[] = [
    'title' => \_MI_GLOSSAIRE_ADMENU6,
    'link' => 'admin/feedback.php',
    'icon' => $sysPathIcon32.'/mail_foward.png',
];
$adminmenu[] = [
    'title' => \_MI_GLOSSAIRE_ABOUT,
    'link' => 'admin/about.php',
    'icon' => $sysPathIcon32.'/about.png',
];
