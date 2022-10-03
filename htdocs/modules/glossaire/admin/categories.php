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
//use JJD;

require __DIR__ . '/header.php';
// Get all request values
$op = Request::getCmd('op', 'list');
$catId = Request::getInt('cat_id');
$start = Request::getInt('start', 0);
$limit = Request::getInt('limit', $glossaireHelper->getConfig('adminpager'));
$GLOBALS['xoopsTpl']->assign('start', $start);
$GLOBALS['xoopsTpl']->assign('limit', $limit);




$utility = new \XoopsModules\Glossaire\Utility();
        
switch ($op) {
    case 'list':
    default:
        // Define Stylesheet
        $GLOBALS['xoTheme']->addStylesheet($style, null);
        $templateMain = 'glossaire_admin_categories.tpl';
        $GLOBALS['xoopsTpl']->assign('navigation', $adminObject->displayNavigation('categories.php'));
        $adminObject->addItemButton(\_AM_GLOSSAIRE_ADD_CATEGORY, 'categories.php?op=new', 'add');
        $GLOBALS['xoopsTpl']->assign('buttons', $adminObject->displayButton('left'));
        $categoriesCount = $categoriesHandler->getCountCategories();
        $categoriesAll = $categoriesHandler->getAllCategories($start, $limit);
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
        break;
    case 'new':
        $templateMain = 'glossaire_admin_categories.tpl';
        $GLOBALS['xoopsTpl']->assign('navigation', $adminObject->displayNavigation('categories.php'));
        $adminObject->addItemButton(\_AM_GLOSSAIRE_LIST_CATEGORIES, 'categories.php', 'list');
        $GLOBALS['xoopsTpl']->assign('buttons', $adminObject->displayButton('left'));
        // Form Create
        $categoriesObj = $categoriesHandler->create();
        $categoriesObj->setVar('cat_weight', $categoriesHandler->getMax('cat_weight')+10);
        
        $categoriesObj->setVar('cat_alphabarre',            $glossaireHelper->getConfig('alphabarre'));
        $categoriesObj->setVar('cat_alphabarre_mode',       $glossaireHelper->getConfig('alphabarre_mode'));
        $categoriesObj->setVar('cat_letter_css_default',    $glossaireHelper->getConfig('letter_css_default'));
        $categoriesObj->setVar('cat_letter_css_selected',   $glossaireHelper->getConfig('letter_css_selected'));
        $categoriesObj->setVar('cat_letter_css_exist',      $glossaireHelper->getConfig('letter_css_exist'));
        $categoriesObj->setVar('cat_letter_css_notexist',   $glossaireHelper->getConfig('letter_css_notexist'));
        
        $form = $categoriesObj->getFormCategories();
        $GLOBALS['xoopsTpl']->assign('form', $form->render());
        break;
        
    case 'clone':
        $templateMain = 'glossaire_admin_categories.tpl';
        $GLOBALS['xoopsTpl']->assign('navigation', $adminObject->displayNavigation('categories.php'));
        $adminObject->addItemButton(\_AM_GLOSSAIRE_LIST_CATEGORIES, 'categories.php', 'list');
        $adminObject->addItemButton(\_AM_GLOSSAIRE_ADD_CATEGORY, 'categories.php?op=new', 'add');
        $GLOBALS['xoopsTpl']->assign('buttons', $adminObject->displayButton('left'));
        // Request source
        $catIdSource = Request::getInt('cat_id_source');
        // Get Form
        $categoriesObjSource = $categoriesHandler->get($catIdSource);
        $categoriesObj = $categoriesObjSource->xoopsClone();
        $categoriesObj->setVar('cat_weight', $categoriesHandler->getMax('cat_weight')+10);
        $form = $categoriesObj->getFormCategories();
        $GLOBALS['xoopsTpl']->assign('form', $form->render());
        break;
        
    case 'save':
        $templateMain = 'glossaire_admin_categories.tpl';
        // Security Check
        if (!$GLOBALS['xoopsSecurity']->check()) {
            \redirect_header('categories.php', 3, \implode(',', $GLOBALS['xoopsSecurity']->getErrors()));
        }
        if ($catId > 0) {
            $categoriesObj = $categoriesHandler->get($catId);
        } else {
            $categoriesObj = $categoriesHandler->create();
    		$categoriesObj->setVar('cat_date_creation', \JJD\getSqlDate());
		}
//            echo "<hr>Date : " .  \JJD\getSqlDate(). "<hr>";exit;

        // Set Vars
        $uploaderErrors = '';
        $categoriesObj->setVar('cat_name', Request::getString('cat_name', ''));
        $categoriesObj->setVar('cat_description', Request::getText('cat_description', ''));
        $categoriesObj->setVar('cat_weight', Request::getInt('cat_weight', 0));
		$categoriesObj->setVar('cat_date_update', \JJD\getSqlDate());
        
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
        //---------------------------------------------------
        $oldImgFolder = $categoriesObj->getVar('cat_upload_folder');
        $newImgFolder = Request::getString('cat_upload_folder', '');
        if ($newImgFolder == ''){
            $newImgFolder = \JJD\sanityseNameForFile(Request::getString('cat_name', ''));
            $categoriesObj->setVar('cat_upload_folder', $newImgFolder);
        }elseif($newImgFolder != $oldImgFolder){
            $newImgFolder = \JJD\sanityseNameForFile($newImgFolder);
            $categoriesObj->setVar('cat_upload_folder', $newImgFolder);
        }else{
            $categoriesObj->setVar('cat_upload_folder', $oldImgFolder);
        }
        
//         if ($categoriesObj->getVar('cat_upload_folder') == ''){
//             $imgFolder = \JJD\sanityseNameForFile($categoriesObj->getVar('cat_name'));
//             $categoriesObj->setVar('cat_upload_folder', $imgFolder);
//         }else{
//         }  
        
//         $categoriesObj->setVar('cat_alphabarre',            Request::getString('cat_alphabarre', ""));
//         $categoriesObj->setVar('cat_alphabarre_mode',       Request::getInt('cat_alphabarre_mode', ''));
//         $categoriesObj->setVar('cat_letter_css_default',    Request::getString('cat_letter_css_default', ''));
//         $categoriesObj->setVar('cat_letter_css_selected',   Request::getString('cat_letter_css_selected', ''));
//         $categoriesObj->setVar('cat_letter_css_exist',      Request::getString('cat_letter_css_exist', ''));
//         $categoriesObj->setVar('cat_letter_css_notexist',   Request::getString('cat_letter_css_notexist', ''));

        $categoriesObj->setVar('cat_alphabarre',            (Request::getString('cat_alphabarre', "")!='') ? Request::getString('cat_alphabarre', "") : $glossaireHelper->getConfig('alphabarre'));
        $categoriesObj->setVar('cat_alphabarre_mode',       (Request::getInt('cat_alphabarre_mode', "")!='') ? Request::getInt('cat_alphabarre_mode', "") : $glossaireHelper->getConfig('alphabarre_mode'));
        $categoriesObj->setVar('cat_letter_css_default',    (Request::getString('cat_letter_css_default', "")!='') ? Request::getString('cat_letter_css_default', "") : $glossaireHelper->getConfig('letter_css_default'));
        $categoriesObj->setVar('cat_letter_css_selected',   (Request::getString('cat_letter_css_selected', "")!='') ? Request::getString('cat_letter_css_selected', "") : $glossaireHelper->getConfig('letter_css_selected'));
        $categoriesObj->setVar('cat_letter_css_exist',      (Request::getString('cat_letter_css_exist', "")!='') ? Request::getString('cat_letter_css_exist', "") : $glossaireHelper->getConfig('letter_css_exist'));
        $categoriesObj->setVar('cat_letter_css_notexist',   (Request::getString('cat_letter_css_notexist', "")!='') ? Request::getString('cat_letter_css_notexist', "") : $glossaireHelper->getConfig('letter_css_notexist'));

        //---------------------------------------------------
        $categoriesObj->setVar('cat_colors_set', Request::getString('cat_colors_set', ''));
        $categoriesObj->setVar('cat_is_acronym', Request::getInt('cat_is_acronym', 0));
        $categoriesObj->setVar('cat_br_after_term', Request::getInt('cat_br_after_term', 0));
        $categoriesObj->setVar('cat_show_terms_index', Request::getInt('cat_show_terms_index', 1));
        $categoriesObj->setVar('cat_count_entries', $entriesHandler->getCountOnCategory($catId));
        
//         $categoryDate_creationArr = Request::getArray('cat_date_creation');
//         $categoryDate_creationObj = \DateTime::createFromFormat(\_SHORTDATESTRING, $categoryDate_creationArr['date']);
//         $categoryDate_creationObj->setTime(0, 0, 0);
//         $categoryDate_creation = $categoryDate_creationObj->getTimestamp() + (int)$categoryDate_creationArr['time'];
//         $categoriesObj->setVar('cat_date_creation', $categoryDate_creation);
//         $categoryDate_updateArr = Request::getArray('cat_date_update');
//         $categoryDate_updateObj = \DateTime::createFromFormat(\_SHORTDATESTRING, $categoryDate_updateArr['date']);
//         $categoryDate_updateObj->setTime(0, 0, 0);
//         $categoryDate_update = $categoryDate_updateObj->getTimestamp() + (int)$categoryDate_updateArr['time'];
//         $categoriesObj->setVar('cat_date_update', $categoryDate_update);
        // Insert Data
        if ($categoriesHandler->insert($categoriesObj)) {
            $newCatId = $categoriesObj->getNewInsertedIdCategories();
            $permId = isset($_REQUEST['cat_id']) ? $catId : $newCatId;
            $grouppermHandler = \xoops_getHandler('groupperm');
            $mid = $GLOBALS['xoopsModule']->getVar('mid');
            
            if($newImgFolder != $oldImgFolder && $oldImgFolder != ''){
                rename(GLOSSAIRE_UPLOAD_IMG_FOLDER_PATH.'/'.$oldImgFolder, GLOSSAIRE_UPLOAD_IMG_FOLDER_PATH.'/'.$newImgFolder);
                //exit("renomage ok : {$newImgFolder} - {$oldImgFolder}");
            }
            if(!is_dir(GLOSSAIRE_UPLOAD_IMG_FOLDER_PATH.'/'.$newImgFolder)) mkdir(GLOSSAIRE_UPLOAD_IMG_FOLDER_PATH.'/'.$newImgFolder);
            
            // Permission to view_categories
            $grouppermHandler->deleteByModule($mid, 'glossaire_view_categories', $permId);
            if (isset($_POST['groups_view_categories'])) {
                foreach ($_POST['groups_view_categories'] as $onegroupId) {
                    $grouppermHandler->addRight('glossaire_view_categories', $permId, $onegroupId, $mid);
                }
            }
            // Permission to submit_categories
            $grouppermHandler->deleteByModule($mid, 'glossaire_submit_categories', $permId);
            if (isset($_POST['groups_submit_categories'])) {
                foreach ($_POST['groups_submit_categories'] as $onegroupId) {
                    $grouppermHandler->addRight('glossaire_submit_categories', $permId, $onegroupId, $mid);
                }
            }
            // Permission to approve_categories
            $grouppermHandler->deleteByModule($mid, 'glossaire_approve_categories', $permId);
            if (isset($_POST['groups_approve_categories'])) {
                foreach ($_POST['groups_approve_categories'] as $onegroupId) {
                    $grouppermHandler->addRight('glossaire_approve_categories', $permId, $onegroupId, $mid);
                }
            }
            if ('' !== $uploaderErrors) {
                \redirect_header('categories.php?op=edit&cat_id=' . $catId, 5, $uploaderErrors);
            } else {
                \redirect_header('categories.php?op=list&amp;start=' . $start . '&amp;limit=' . $limit, 2, \_AM_GLOSSAIRE_FORM_OK);
            }
        }
        // Get Form

        $GLOBALS['xoopsTpl']->assign('error', $categoriesObj->getHtmlErrors());
        $form = $categoriesObj->getFormCategories();
        $GLOBALS['xoopsTpl']->assign('form', $form->render());
        break;
        
    case 'edit':
        $templateMain = 'glossaire_admin_categories.tpl';
        $GLOBALS['xoopsTpl']->assign('navigation', $adminObject->displayNavigation('categories.php'));
        $adminObject->addItemButton(\_AM_GLOSSAIRE_ADD_CATEGORY, 'categories.php?op=new', 'add');
        $adminObject->addItemButton(\_AM_GLOSSAIRE_LIST_CATEGORIES, 'categories.php', 'list');
        $GLOBALS['xoopsTpl']->assign('buttons', $adminObject->displayButton('left'));
        // Get Form
        $categoriesObj = $categoriesHandler->get($catId);
        $categoriesObj->start = $start;
        $categoriesObj->limit = $limit;
        $form = $categoriesObj->getFormCategories();
        $GLOBALS['xoopsTpl']->assign('form', $form->render());
        break;
        
    case 'delete':
        $templateMain = 'glossaire_admin_categories.tpl';
        $GLOBALS['xoopsTpl']->assign('navigation', $adminObject->displayNavigation('categories.php'));
        $categoriesObj = $categoriesHandler->get($catId);
        $catName = $categoriesObj->getVar('cat_name');
        //$imgFolder = $categoriesObj->getVar('cat_upload_folder');
        $glsUploads = $categoriesObj->getPathUploads();
//echo "<hr>===>" . GLOSSAIRE_UPLOAD_IMG_FOLDER_PATH . '/' . $imgFolder . "<hr>";        
        if (isset($_REQUEST['ok']) && 1 == $_REQUEST['ok']) {
            if (!$GLOBALS['xoopsSecurity']->check()) {
                \redirect_header('categories.php', 3, \implode(', ', $GLOBALS['xoopsSecurity']->getErrors()));
            }
            if ($categoriesHandler->delete($categoriesObj)) {
                $entCriteria = new \Criteria('ent_cat_id', $catId,'=');
                $entriesHandler->deleteAll($entCriteria);
                //todo : supprimer les images de la categories dans le dosier deu glossaire
                $xoopsFolder->delete($glsUploads); 
                
                \redirect_header('categories.php', 3, \_AM_GLOSSAIRE_FORM_DELETE_OK);
            } else {
                $GLOBALS['xoopsTpl']->assign('error', $categoriesObj->getHtmlErrors());
            }
        } else {
            $xoopsconfirm = new Common\XoopsConfirm(
                ['ok' => 1, 'cat_id' => $catId, 'start' => $start, 'limit' => $limit, 'op' => 'delete'],
                $_SERVER['REQUEST_URI'],
                \sprintf(\_AM_GLOSSAIRE_FORM_SURE_DELETE, $categoriesObj->getVar('cat_name')));
            $form = $xoopsconfirm->getFormXoopsConfirm();
            $GLOBALS['xoopsTpl']->assign('form', $form->render());
        }
        break;
        
    case 'updateWeight':
    case 'updateweight':
        $action = Request::getCmd('action');
        $categoriesHandler->updateWeight($catId, $action);
        \redirect_header('categories.php?op=list&amp;start=' . $start . '&amp;limit=' . $limit, 2, \_AM_GLOSSAIRE_WEIGHT_UPDATE);        
        break;

    case 'bascule_actif':
        $catId = Request::getInt('catId', 0);
        $newValue = Request::getInt('value', 0);
        $sql = "UPDATE " . $xoopsDB->prefix("glossaire_categories") . " SET cat_active={$newValue} WHERE cat_id={$catId}";
        $xoopsDB->queryf($sql);
        \redirect_header("categories.php?op=list", 0, "");

        break;
}
require __DIR__ . '/footer.php';
