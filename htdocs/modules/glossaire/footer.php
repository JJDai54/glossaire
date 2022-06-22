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
if ($helper->getConfig('show_breadcrumbs') && \count($xoBreadcrumbs) > 0) {
    $GLOBALS['xoopsTpl']->assign('xoBreadcrumbs', $xoBreadcrumbs);
}
$GLOBALS['xoopsTpl']->assign('adv', $helper->getConfig('advertise'));
// 
$GLOBALS['xoopsTpl']->assign('bookmarks', $helper->getConfig('bookmarks'));
$GLOBALS['xoopsTpl']->assign('fbcomments', $helper->getConfig('fbcomments'));
// 
$GLOBALS['xoopsTpl']->assign('admin', \GLOSSAIRE_ADMIN);
$GLOBALS['xoopsTpl']->assign('copyright', $copyright);
// 
require_once \XOOPS_ROOT_PATH . '/footer.php';
