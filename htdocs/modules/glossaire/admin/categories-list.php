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
 * @author        Jean-Jacques DELALANDRE - Email:<jjdelalandre@orange.fr> - Website:<jubile.fr>
 */

use Xmf\Request;
use XoopsModules\Glossaire;
use XoopsModules\Glossaire\Constants;
use XoopsModules\Glossaire\Common;
//use JANUS;


    // Define Stylesheet
    $GLOBALS['xoTheme']->addStylesheet($style, null);
    $templateMain = 'glossaire_admin_categories.tpl';
    $GLOBALS['xoopsTpl']->assign('navigation', $adminObject->displayNavigation('categories.php'));
    $adminObject->addItemButton(\_AM_GLOSSAIRE_ADD_CATEGORY, 'categories.php?op=new', 'add');
    $GLOBALS['xoopsTpl']->assign('buttons', $adminObject->displayButton('left'));

    $clPerms->addPermissions($criteria, 'view_cats', 'cat_id');
    $categoriesAll = $categoriesHandler->getAllCategories($criteria, $start, $limit);
    //$categoriesCount = count($categoriesAll);
    $categoriesCount = $categoriesHandler->getCountCategories();

    $GLOBALS['xoopsTpl']->assign('categories_count', $categoriesCount);
    $GLOBALS['xoopsTpl']->assign('glossaire_url', \GLOSSAIRE_URL);
    $GLOBALS['xoopsTpl']->assign('glossaire_upload_url', \GLOSSAIRE_UPLOAD_URL);
    //$GLOBALS['xoopsTpl']->assign('modPathIcon16', $modPathIcon16);
    // Table view categories
    if ($categoriesCount > 0) {
        foreach (\array_keys($categoriesAll) as $i) {
            $category = $categoriesAll[$i]->getValuesCategories();
            $GLOBALS['xoopsTpl']->append('categories_list', $category);
            unset($category);
        }
        // Display Navigation
        if ($categoriesCount > $limit) {
            require_once \XOOPS_ROOT_PATH . '/class/pagenav.php';
            $pagenav = new \XoopsPageNav($categoriesCount, $limit, $start, 'start', 'op=list&limit=' . $limit);
            $GLOBALS['xoopsTpl']->assign('pagenav', $pagenav->renderNav(4));
        }
    } else {
        $GLOBALS['xoopsTpl']->assign('error', \_AM_GLOSSAIRE_THEREARENT_CATEGORIES);
    }
