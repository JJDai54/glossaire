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

use Xmf\Request;
use XoopsModules\Glossaire;
use XoopsModules\Glossaire\Constants;
use XoopsModules\Glossaire\Common;

require __DIR__ . '/header.php';
$GLOBALS['xoopsOption']['template_main'] = 'glossaire_categories.tpl';
require_once \XOOPS_ROOT_PATH . '/header.php';

$op    = Request::getCmd('op', 'list');
$catId = Request::getInt('cat_id', 0);
$start = Request::getInt('start', 0);
$limit = Request::getInt('limit', $glossaireHelper->getConfig('userpager'));
$GLOBALS['xoopsTpl']->assign('start', $start);
$GLOBALS['xoopsTpl']->assign('limit', $limit);

// Define Stylesheet
$GLOBALS['xoTheme']->addStylesheet($style, null);
// Paths
$GLOBALS['xoopsTpl']->assign('xoops_icons32_url', \XOOPS_ICONS32_URL);
$GLOBALS['xoopsTpl']->assign('glossaire_url', \GLOSSAIRE_URL);
// Keywords
$keywords = [];
// Breadcrumbs
$xoBreadcrumbs[] = ['title' => \_MA_GLOSSAIRE_INDEX, 'link' => 'index.php'];
// Permissions

$perms = $categoriesHandler->getPermissions();
// $GLOBALS['xoopsTpl']->assign('permEdit', $permEdit);
// $GLOBALS['xoopsTpl']->assign('showItem', $catId > 0);
        \JANUS\load_css();
        // Breadcrumbs
        $xoBreadcrumbs[] = ['title' => \_MA_GLOSSAIRE_CATEGORIES_LIST];
        $crCategories = new \CriteriaCompo();
        if ($catId > 0) {
            $crCategories->add(new \Criteria('cat_id', $catId));
        }
        $categoriesAll = $categoriesHandler->getAllCatAllowed('view', $crCategories);
        $categoriesCount = count($categoriesAll); //$categoriesHandler->getAllCatAllowed('view', $crCategories);
        $GLOBALS['xoopsTpl']->assign('categoriesCount', $categoriesCount);
        if (0 === $catId) {
            $crCategories->setStart($start);
            $crCategories->setLimit($limit);
        }
        if ($categoriesCount > 0) {
	        $catPerms = $categoriesHandler->getAlPermsByCatId($categoriesAll);        
            //echoArray( $catPerms );
            $categories = [];
            $catName = '';
            // Get All Categories
            foreach (\array_keys($categoriesAll) as $i) {
                $categories[$i] = $categoriesAll[$i]->getValuesCategories();
                $catName = $categoriesAll[$i]->getVar('cat_name');
                $keywords[$i] = $catName;
                $categories[$i]['perms'] = $catPerms[$categoriesAll[$i]->getVar('cat_id')];
            }
            $GLOBALS['xoopsTpl']->assign('categories', $categories);
            $GLOBALS['xoopsTpl']->assign('posButtonsActions', $glossaireHelper->getConfig('posButtonsActions'));

            unset($categories);
            // Display Navigation
            if ($categoriesCount > $limit) {
                require_once \XOOPS_ROOT_PATH . '/class/pagenav.php';
                $pagenav = new \XoopsPageNav($categoriesCount, $limit, $start, 'start', 'op=list&limit=' . $limit);
                $GLOBALS['xoopsTpl']->assign('pagenav', $pagenav->renderNav(4));
            }
            $GLOBALS['xoopsTpl']->assign('table_type', $glossaireHelper->getConfig('table_type'));
            $GLOBALS['xoopsTpl']->assign('panel_type', $glossaireHelper->getConfig('panel_type'));
            $GLOBALS['xoopsTpl']->assign('divideby', $glossaireHelper->getConfig('divideby'));
            $GLOBALS['xoopsTpl']->assign('numb_col', $glossaireHelper->getConfig('numb_col'));
            if ('show' == $op && '' != $catName) {
                $GLOBALS['xoopsTpl']->assign('xoops_pagetitle', \strip_tags($catName . ' - ' . $GLOBALS['xoopsModule']->getVar('name')));
            }
        }
