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
//$permEdit = $permissionsHandler->getPermGlobalSubmit();
$perms = $categoriesHandler->getPermissions();
// $GLOBALS['xoopsTpl']->assign('permEdit', $permEdit);
// $GLOBALS['xoopsTpl']->assign('showItem', $catId > 0);

switch ($op) {
    case 'show':
    case 'list':
    default:
        // Breadcrumbs
        $xoBreadcrumbs[] = ['title' => \_MA_GLOSSAIRE_CATEGORIES_LIST];
        $crCategories = new \CriteriaCompo();
        if ($catId > 0) {
            $crCategories->add(new \Criteria('cat_id', $catId));
        }
        $categoriesCount = $categoriesHandler->getAllCatAllowed('view', $crCategories);
        $GLOBALS['xoopsTpl']->assign('categoriesCount', $categoriesCount);
        if (0 === $catId) {
            $crCategories->setStart($start);
            $crCategories->setLimit($limit);
        }
        $categoriesAll = $categoriesHandler->getAllCatAllowed('view', $crCategories);
        if ($categoriesCount > 0) {
	        $catPerms = $categoriesHandler->getAlPermsByCatId($categoriesAll);        
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
        break;
    case 'save':
        include_once "admin/categories-save.php";
        break;
        // Security Check
        if (!$GLOBALS['xoopsSecurity']->check()) {
            \redirect_header('categories.php', 3, \implode(',', $GLOBALS['xoopsSecurity']->getErrors()));
        }
        // Check permissions
        if (!$permissionsHandler->getPermGlobalSubmit()) {
            \redirect_header('categories.php?op=list', 3, \_NOPERM);
        }
        if ($catId > 0) {
            $categoriesObj = $categoriesHandler->get($catId);
        } else {
            $categoriesObj = $categoriesHandler->create();
        }
        $uploaderErrors = '';
        $categoriesObj->setVar('cat_name', Request::getString('cat_name', ''));
        $categoriesObj->setVar('cat_description', Request::getString('cat_description', ''));
        $categoriesObj->setVar('cat_total', Request::getInt('cat_total', 0));
        $categoriesObj->setVar('cat_weight', Request::getInt('cat_weight', 0));
        // Set Var cat_logourl
        require_once \XOOPS_ROOT_PATH . '/class/uploader.php';
        $uploader = new \XoopsMediaUploader(\XOOPS_ROOT_PATH . '/Frameworks/moduleclasses/icons/32', 
                                                    $glossaireHelper->getConfig('mimetypes_image'), 
                                                    $glossaireHelper->getConfig('maxsize_image'), null, null);
        if ($uploader->fetchMedia($_POST['xoops_upload_file'][0])) {
            //$uploader->setPrefix(cat_logourl_);
            //$uploader->fetchMedia($_POST['xoops_upload_file'][0]);
            if ($uploader->upload()) {
                $categoriesObj->setVar('cat_logourl', $uploader->getSavedFileName());
            } else {
                $uploaderErrors .= '<br>' . $uploader->getErrors();
            }
        } else {
            $categoriesObj->setVar('cat_logourl', Request::getString('cat_logourl'));
        }
//$utility = new \XoopsModules\Glossaire\Utility();
        if ($categoriesObj->getVar('cat_img_folder') == ''){
            $imgFolder = \JJD\sanityseNameForFile($categoriesObj->getVar('cat_name'));
            $categoriesObj->setVar('cat_img_folder', $imgFolder);
        }  

        $categoriesObj->setVar('cat_colors_set', Request::getString('cat_colors_set', ''));
        $categoriesObj->setVar('cat_magnify_sd', Request::getInt('cat_magnify_sd', ''));
        $categoriesObj->setVar('cat_show_terms_index', Request::getInt('cat_show_terms_index', ''));
        $categoryDate_creationArr = Request::getArray('cat_date_creation');
        $categoryDate_creationObj = \DateTime::createFromFormat(\_SHORTDATESTRING, $categoryDate_creationArr['date']);
        $categoryDate_creationObj->setTime(0, 0, 0);
        $categoryDate_creation = $categoryDate_creationObj->getTimestamp() + (int)$categoryDate_creationArr['time'];
        $categoriesObj->setVar('cat_date_creation', $categoryDate_creation);
        $categoryDate_updateArr = Request::getArray('cat_date_update');
        $categoryDate_updateObj = \DateTime::createFromFormat(\_SHORTDATESTRING, $categoryDate_updateArr['date']);
        $categoryDate_updateObj->setTime(0, 0, 0);
        $categoryDate_update = $categoryDate_updateObj->getTimestamp() + (int)$categoryDate_updateArr['time'];
        $categoriesObj->setVar('cat_date_update', $categoryDate_update);
        // Insert Data
        if ($categoriesHandler->insert($categoriesObj)) {
            $newCatId = $catId > 0 ? $catId : $categoriesObj->getNewInsertedIdCategories();
            $grouppermHandler = \xoops_getHandler('groupperm');
            $mid = $GLOBALS['xoopsModule']->getVar('mid');
            // Permission to view_categories
            $grouppermHandler->deleteByModule($mid, 'glossaire_view_categories', $newCatId);
            if (isset($_POST['groups_view_categories'])) {
                foreach ($_POST['groups_view_categories'] as $onegroupId) {
                    $grouppermHandler->addRight('glossaire_view_categories', $newCatId, $onegroupId, $mid);
                }
            }
            // Permission to submit_categories
            $grouppermHandler->deleteByModule($mid, 'glossaire_submit_categories', $newCatId);
            if (isset($_POST['groups_submit_categories'])) {
                foreach ($_POST['groups_submit_categories'] as $onegroupId) {
                    $grouppermHandler->addRight('glossaire_submit_categories', $newCatId, $onegroupId, $mid);
                }
            }
            // Permission to approve_categories
            $grouppermHandler->deleteByModule($mid, 'glossaire_approve_categories', $newCatId);
            if (isset($_POST['groups_approve_categories'])) {
                foreach ($_POST['groups_approve_categories'] as $onegroupId) {
                    $grouppermHandler->addRight('glossaire_approve_categories', $newCatId, $onegroupId, $mid);
                }
            }
            // Handle notification
            $catName = $categoriesObj->getVar('cat_name');
            $tags = [];
            $tags['ITEM_NAME'] = $catName;
            $tags['ITEM_URL']  = \XOOPS_URL . '/modules/glossaire/categories.php?op=show&cat_id=' . $catId;
            $notificationHandler = \xoops_getHandler('notification');
            if ($catId > 0) {
                // Event modify notification
                $notificationHandler->triggerEvent('global', 0, 'global_modify', $tags);
                $notificationHandler->triggerEvent('categories', $newCatId, 'category_modify', $tags);
            } else {
                // Event new notification
                $notificationHandler->triggerEvent('global', 0, 'global_new', $tags);
            }
            // redirect after insert
            if ('' !== $uploaderErrors) {
                \redirect_header('categories.php?op=edit&cat_id=' . $newCatId, 5, $uploaderErrors);
            } else {
                \redirect_header('categories.php?op=list&amp;start=' . $start . '&amp;limit=' . $limit, 2, \_MA_GLOSSAIRE_FORM_OK);
            }
        }
        // Get Form Error
        $GLOBALS['xoopsTpl']->assign('error', $categoriesObj->getHtmlErrors());
        $form = $categoriesObj->getFormCategories();
        $GLOBALS['xoopsTpl']->assign('form', $form->render());
        break;
    case 'new':
        // Breadcrumbs
        $xoBreadcrumbs[] = ['title' => \_MA_GLOSSAIRE_CATEGORY_ADD];
        // Check permissions
        if (!$permissionsHandler->getPermGlobalSubmit()) {
            \redirect_header('categories.php?op=list', 3, \_NOPERM);
        }
        // Form Create
        $categoriesObj = $categoriesHandler->create();
        $form = $categoriesObj->getFormCategories();
        $GLOBALS['xoopsTpl']->assign('form', $form->render());
        break;
    case 'edit':
        // Breadcrumbs
        $xoBreadcrumbs[] = ['title' => \_MA_GLOSSAIRE_CATEGORY_EDIT];
        // Check permissions
        if (!$permissionsHandler->getPermGlobalSubmit()) {
            \redirect_header('categories.php?op=list', 3, \_NOPERM);
        }
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
        if (!$permissionsHandler->getPermGlobalSubmit()) {
            \redirect_header('categories.php?op=list', 3, \_NOPERM);
        }
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
    case 'delete':
        // Breadcrumbs
        $xoBreadcrumbs[] = ['title' => \_MA_GLOSSAIRE_CATEGORY_DELETE];
        // Check permissions
        if (!$permissionsHandler->getPermGlobalSubmit()) {
            \redirect_header('categories.php?op=list', 3, \_NOPERM);
        }
        // Check params
        if (0 == $catId) {
            \redirect_header('categories.php?op=list', 3, \_MA_GLOSSAIRE_INVALID_PARAM);
        }
        $categoriesObj = $categoriesHandler->get($catId);
        $catName = $categoriesObj->getVar('cat_name');
        if (isset($_REQUEST['ok']) && 1 == $_REQUEST['ok']) {
            if (!$GLOBALS['xoopsSecurity']->check()) {
                \redirect_header('categories.php', 3, \implode(', ', $GLOBALS['xoopsSecurity']->getErrors()));
            }
            if ($categoriesHandler->delete($categoriesObj)) {
                // Event delete notification
                $tags = [];
                $tags['ITEM_NAME'] = $catName;
                $notificationHandler = \xoops_getHandler('notification');
                $notificationHandler->triggerEvent('global', 0, 'global_delete', $tags);
                $notificationHandler->triggerEvent('categories', $catId, 'category_delete', $tags);
                \redirect_header('categories.php', 3, \_MA_GLOSSAIRE_FORM_DELETE_OK);
            } else {
                $GLOBALS['xoopsTpl']->assign('error', $categoriesObj->getHtmlErrors());
            }
        } else {
            $xoopsconfirm = new Common\XoopsConfirm(
                ['ok' => 1, 'cat_id' => $catId, 'start' => $start, 'limit' => $limit, 'op' => 'delete'],
                $_SERVER['REQUEST_URI'],
                \sprintf(\_MA_GLOSSAIRE_FORM_SURE_DELETE, $categoriesObj->getVar('cat_name')));
            $form = $xoopsconfirm->getFormXoopsConfirm();
            $GLOBALS['xoopsTpl']->assign('form', $form->render());
        }
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
