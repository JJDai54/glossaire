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
 * @author         XOOPS Development Team - Email:<jjdelalandre@orange.fr> - Website:<xoopsfr.kiolo.fr>
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


// $GLOBALS['xoopsTpl']->assign('permEdit', $permEdit);
// $GLOBALS['xoopsTpl']->assign('showItem', $catId > 0);

switch ($op) {
    case 'show':
    case 'list':
    case 'new':
    case 'delete':
        include_once "categories-{$op}.php";
        break;
        
    case 'save':
        include_once "admin/categories-{$op}.php";
        break;
        
    case 'edit':
        // Breadcrumbs
        $xoBreadcrumbs[] = ['title' => \_MA_GLOSSAIRE_CATEGORY_EDIT];
        // Check permissions
        // Check params
        if (0 == $catId) {
            \redirect_header('categories.php?op=list', 3, \_MA_GLOSSAIRE_INVALID_PARAM);
        }
        // Get Form
        $categoriesObj = $categoriesHandler->get($catId);
        $categoriesObj->start = $start;
        $categoriesObj->limit = $limit;
        $form = $categoriesObj->getFormCategories();
        $GLOBALS['xoopsTpl']->assign('form', $form->render());
        break;
        
    case 'clone':
        // Breadcrumbs
        $xoBreadcrumbs[] = ['title' => \_MA_GLOSSAIRE_CATEGORY_CLONE];
        // Check permissions
        // Request source
        $catIdSource = Request::getInt('cat_id_source');
        // Check params
        if (0 == $catIdSource) {
            \redirect_header('categories.php?op=list', 3, \_MA_GLOSSAIRE_INVALID_PARAM);
        }
        // Get Form
        $categoriesObjSource = $categoriesHandler->get($catIdSource);
        $categoriesObj = $categoriesObjSource->xoopsClone();
        $form = $categoriesObj->getFormCategories();
        $GLOBALS['xoopsTpl']->assign('form', $form->render());
        break;
}

// Keywords
glossaireMetaKeywords($glossaireHelper->getConfig('keywords') . ', ' . \implode(',', $keywords));
unset($keywords);

// Description
glossaireMetaDescription(\_MA_GLOSSAIRE_CATEGORIES_DESC);
$GLOBALS['xoopsTpl']->assign('xoops_mpageurl', \GLOSSAIRE_URL.'/categories.php');
$GLOBALS['xoopsTpl']->assign('glossaire_upload_url', \GLOSSAIRE_UPLOAD_URL);

require __DIR__ . '/footer.php';
