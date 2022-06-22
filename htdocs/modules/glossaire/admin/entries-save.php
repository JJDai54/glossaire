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

        // Security Check
        if (!$GLOBALS['xoopsSecurity']->check()) {
            \redirect_header('entries.php', 3, \implode(',', $GLOBALS['xoopsSecurity']->getErrors()));
        }
        if ($entId > 0) {
            $entriesObj = $entriesHandler->get($entId);
        } else {
            $entriesObj = $entriesHandler->create();
    		$entriesObj->setVar('ent_date_creation', \JJD\getSqlDate());
        }


/*
        if ($catId > 0) {
            $categoriesObj = $categoriesHandler->get($catId);
        } else {
            $categoriesObj = $categoriesHandler->create();
		}
//            echo "<hr>Date : " .  \JJD\getSqlDate(). "<hr>";exit;

        // Set Vars
        $uploaderErrors = '';
        $categoriesObj->setVar('cat_name', Request::getString('cat_name', ''));
        $categoriesObj->setVar('cat_description', Request::getString('cat_description', ''));
        $categoriesObj->setVar('cat_total', Request::getInt('cat_total', 0));
        $categoriesObj->setVar('cat_weight', Request::getInt('cat_weight', 0));

*/
        $catId = Request::getInt('ent_cat_id', 0);
        $categoriesObj = $categoriesHandler->get($catId);
        
        // Set Vars
		$entriesObj->setVar('ent_date_update', \JJD\getSqlDate());
        $entriesObj->setVar('ent_cat_id', Request::getInt('ent_cat_id', 0));
//        $entriesObj->setVar('ent_uid', Request::getInt('ent_uid', 0));
        $entriesObj->setVar('ent_creator', Request::getString('ent_creator', ''));
        $entriesObj->setVar('ent_term', Request::getString('ent_term', ''));
        $entriesObj->setVar('ent_initiale', $utility::getInitiale(Request::getString('ent_term', '')));
        $entriesObj->setVar('ent_shortdef', Request::getString('ent_shortdef', ''));
        $entriesObj->setVar('ent_is_acronym', Request::getInt('ent_is_acronym', 0));
        $entriesObj->setVar('ent_definition', Request::getText('ent_definition', ''));
        $entriesObj->setVar('ent_reference', Request::getText('ent_reference', ''));
        $entriesObj->setVar('ent_urls', Request::getText('ent_urls', ''));
//         $entriesObj->setVar('ent_url1', Request::getString('ent_url1', ''));
//         $entriesObj->setVar('ent_url2', Request::getString('ent_url2', ''));
        
        // Set Var ent_image
        require_once \XOOPS_ROOT_PATH . '/class/uploader.php';
        $filename       = $_FILES['ent_image']['name'];
        //$imgNameDef     = Request::getString('ent_cat_id');
        $imgName     = \JJD\sanityseNameForFile(Request::getString('ent_term')) . '_';
        $imgFolder = \GLOSSAIRE_UPLOAD_IMG_FOLDER_PATH . "/" . $categoriesObj->getVar('cat_img_folder')."/";
        
        $ent_delete_img = Request::getInt('ent_delete_img', 0);
        if($ent_delete_img){
            $entriesObj->delete_image($imgFolder);
            $entriesObj->setVar('ent_image', '');
        }
        
        
        
        //mkdir($imgFolder);
        if (!is_dir($imgFolder)) mkdir($imgFolder, 0777, true);        
        //echo "<hr>{$catId}-{$imgFolder}<hr>";exit;
        $uploader = new \XoopsMediaUploader($imgFolder, 
                                            $helper->getConfig('mimetypes_file'), 
                                            $helper->getConfig('maxsize_file'), null, null);
        if ($uploader->fetchMedia($_POST['xoops_upload_file'][0])) {
            $extension = \preg_replace('/^.+\.([^.]+)$/sU', '', $filename);
            //$imgName = \str_replace(' ', '', $imgNameDef) . '.' . $extension;
            $uploader->setPrefix($imgName);
            $uploader->fetchMedia($_POST['xoops_upload_file'][0]);
            if ($uploader->upload()) {
                $entriesObj->setVar('ent_image', $uploader->getSavedFileName());
            } else {
                $uploaderErrors .= '<br>' . $uploader->getErrors();
            }
        } else {
            if ($filename > '') {
                $uploaderErrors .= '<br>' . $uploader->getErrors();
            }
            $entriesObj->setVar('ent_image', Request::getString('ent_image'));
        }
        
        
        
        
        
//         $entryDate_creationObj = \DateTime::createFromFormat(\_SHORTDATESTRING, Request::getString('ent_date_creation'));
//         $entriesObj->setVar('ent_date_creation', $entryDate_creationObj->getTimestamp());
//         $entryDate_updateObj = \DateTime::createFromFormat(\_SHORTDATESTRING, Request::getString('ent_date_update'));
//         $entriesObj->setVar('ent_date_update', $entryDate_updateObj->getTimestamp());
        $entriesObj->setVar('ent_counter', Request::getInt('ent_counter', 0));
        $entriesObj->setVar('ent_status', Request::getInt('ent_status', 0));
        $entriesObj->setVar('ent_flag', Request::getInt('ent_flag', 0));
        // Insert Data
        if ($entriesHandler->insert($entriesObj)) {
//exit('ok');
                \redirect_header("entries.php?op=list&amp;start={$start}&limit={$limit}&statusIdSelect={$statusIdSelect}" , 2, \_AM_GLOSSAIRE_FORM_OK);
        }
//exit('non');
        // Get Form
        $GLOBALS['xoopsTpl']->assign('error', $entriesObj->getHtmlErrors());
        $form = $entriesObj->getFormEntries();
        $GLOBALS['xoopsTpl']->assign('form', $form->render());

