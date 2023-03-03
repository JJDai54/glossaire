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
//use JJD;

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
    $categoriesObj->setVar('cat_active', Request::getInt('cat_active', 0));


    //---------------------------------------------------------
    //recupere le nom du dossier pour les images et les fichiers joints
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
    
        //---------------------------------------------------
//        exit("renomage de : {$oldImgFolder} en {$newImgFolder}<br>");
        if($newImgFolder != $oldImgFolder && $oldImgFolder != ''){
            rename(GLOSSAIRE_UPLOAD_IMPORT_DATA_PATH.'/'.$oldImgFolder, GLOSSAIRE_UPLOAD_IMPORT_DATA_PATH.'/'.$newImgFolder);
//            exit("renomage ok : {$oldImgFolder} en {$newImgFolder}<br>". GLOSSAIRE_UPLOAD_IMPORT_DATA_PATH . "<br>");
        }
        $categoriesObj->createFolders($newImgFolder);
//         if(!is_dir(GLOSSAIRE_UPLOAD_IMPORT_DATA_PATH.'/'.$newImgFolder)) $categoriesObj->createFolders($newImgFolder);
//         if(!is_dir(GLOSSAIRE_UPLOAD_IMPORT_DATA_PATH.'/'.$newImgFolder)) $categoriesObj->createFolders($newImgFolder);




    //---------------------------------------------------------
    // Set Var cat_logo
    require_once \XOOPS_ROOT_PATH . '/class/uploader.php';
    $imageDirectory = $categoriesObj->getPathUploads("logo");
    $uploader = new \XoopsMediaUploader($imageDirectory, 
                                                $glossaireHelper->getConfig('mimetypes_image'), 
                                                $glossaireHelper->getConfig('maxsize_image'), null, null);
    if ($uploader->fetchMedia($_POST['xoops_upload_file'][0])) {
        //$uploader->fetchMedia($_POST['xoops_upload_file'][0]);
        if ($uploader->upload()) {
            $categoriesObj->setVar('cat_logo', $uploader->getSavedFileName());
        } else {
            $uploaderErrors .= '<br>' . $uploader->getErrors();
        }
    } else {
        $categoriesObj->setVar('cat_logo', Request::getString('cat_logo'));
    }

    //---------------------------------------------------
    $categoriesObj->setVar('cat_userpager',             (Request::getInt('cat_userpager', "")!='') ? Request::getInt('cat_userpager', 10) : $glossaireHelper->getConfig('userpager'));
    $categoriesObj->setVar('cat_alphabarre',            (Request::getString('cat_alphabarre', "")!='') ? Request::getString('cat_alphabarre', "") : $glossaireHelper->getConfig('alphabarre'));
    $categoriesObj->setVar('cat_alphabarre_mode',       (Request::getInt('cat_alphabarre_mode', "")!='') ? Request::getInt('cat_alphabarre_mode', "") : $glossaireHelper->getConfig('alphabarre_mode'));

    //---------------------------------------------------
    $categoriesObj->setVar('cat_colors_set', Request::getString('cat_colors_set', ''));
    $categoriesObj->setVar('cat_is_acronym', Request::getInt('cat_is_acronym', 0));
    $categoriesObj->setVar('cat_replace_arobase', Request::getString('cat_replace_arobase', 0));
    $categoriesObj->setVar('cat_br_after_term', Request::getInt('cat_br_after_term', 0));
    $categoriesObj->setVar('cat_show_terms_index', Request::getInt('cat_show_terms_index', 1));
    $categoriesObj->setVar('cat_show_bin', Request::getInt('cat_show_bin', 32767));
    $categoriesObj->setVar('cat_count_entries', $entriesHandler->getCountOnCategory($catId));
    $categoriesObj->setVar('cat_date_format', Request::getString('cat_date_format', 'd-m-Y : H-i-s'));
    
    // Insert Data
    if ($categoriesHandler->insert($categoriesObj)) {
        $newCatId = $categoriesObj->getNewInsertedIdCategories();
    //---------------------------------------------------------
    // Set Var cat_logo
    require_once \XOOPS_ROOT_PATH . '/class/uploader.php';
    //$imageDirectory = $categoriesObj->getPathUploads($categoriesObj->getVar('cat_upload_folder') . '/logo');
            
    $uploader = new \XoopsMediaUploader($imageDirectory, 
                                                $glossaireHelper->getConfig('mimetypes_image'), 
                                                $glossaireHelper->getConfig('maxsize_image'), null, null);
    if ($uploader->fetchMedia($_POST['xoops_upload_file'][0])) {
        //$uploader->fetchMedia($_POST['xoops_upload_file'][0]);
        if ($uploader->upload()) {
            $categoriesObj->setVar('cat_logo', $uploader->getSavedFileName());
        } else {
            $uploaderErrors .= '<br>' . $uploader->getErrors();
        }
    } else {
        $categoriesObj->setVar('cat_logo', Request::getString('cat_logo'));
    }
        
//exit ($imageDirectory);            
        
        //---------------------------------------------------
        $permId = isset($_REQUEST['cat_id']) ? $catId : $newCatId;
        $grouppermHandler = \xoops_getHandler('groupperm');
        $mid = $GLOBALS['xoopsModule']->getVar('mid');
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
