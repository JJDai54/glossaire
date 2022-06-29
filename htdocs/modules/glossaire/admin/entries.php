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
// Get all request values
$op = Request::getCmd('op', 'list');
$entId = Request::getInt('ent_id');
$catIdSelect = Request::getInt('catIdSelect',0);
$statusIdSelect = Request::getInt('statusIdSelect', GLOSSAIRE_STATUS_ALL);
$start = Request::getInt('start', 0);
$limit = Request::getInt('limit', $glossaireHelper->getConfig('adminpager'));
if ($limit == 0) $limit = $glossaireHelper->getConfig('adminpager');

// $gp=array_merge($_GET, $_POST);
// 
// echo "<hr><pre>" . print_r($gp, true) . "</pre><hr>";
// echo "<hr><pre>" . print_r($_FILES, true) . "</pre><hr>";


//if (!$limit)$limit=15;
$GLOBALS['xoopsTpl']->assign('start', $start);
$GLOBALS['xoopsTpl']->assign('limit', $limit);
$GLOBALS['xoopsTpl']->assign('statusIdSelect', $statusIdSelect);
$utility = new \XoopsModules\Glossaire\Utility();

switch ($op) {
    case 'list':
    default:
        include_once "entries-list.php";
        break;
        
    case 'new':
        $templateMain = 'glossaire_admin_entries.tpl';
        $GLOBALS['xoopsTpl']->assign('avigation', $adminObject->displayNavigation('entries.php'));
        $adminObject->addItemButton(\_AM_GLOSSAIRE_LIST_ENTRIES, 'entries.php', 'list');
        $GLOBALS['xoopsTpl']->assign('buttons', $adminObject->displayButton('left'));
        // Form Create
        $entriesObj = $entriesHandler->create();
        $entriesObj->setVar('ent_cat_id', $catIdSelect);
        if ($statusIdSelect >= GLOSSAIRE_STATUS_ALL){
            $entriesObj->setVar('ent_status', GLOSSAIRE_STATUS_APPROVED);
        }else{
            $entriesObj->setVar('ent_status', GLOSSAIRE_PROPOSITION);
        }
        $form = $entriesObj->getFormEntries();
        $GLOBALS['xoopsTpl']->assign('form', $form->render());
        break;
    case 'clone':
        $templateMain = 'glossaire_admin_entries.tpl';
        $GLOBALS['xoopsTpl']->assign('navigation', $adminObject->displayNavigation('entries.php'));
        $adminObject->addItemButton(\_AM_GLOSSAIRE_LIST_ENTRIES, 'entries.php', 'list');
        $adminObject->addItemButton(\_AM_GLOSSAIRE_ADD_ENTRY, 'entries.php?op=new', 'add');
        $GLOBALS['xoopsTpl']->assign('buttons', $adminObject->displayButton('left'));
        // Request source
        $entIdSource = Request::getInt('ent_id_source');
        // Get Form
        $entriesObjSource = $entriesHandler->get($entIdSource);
        $entriesObj = $entriesObjSource->xoopsClone();
        $form = $entriesObj->getFormEntries();
        $GLOBALS['xoopsTpl']->assign('form', $form->render());
        break;
    case 'save':   //exit;
        include_once("entries-save.php");
        break;
        

    case 'edit':
        $templateMain = 'glossaire_admin_entries.tpl';
        $GLOBALS['xoopsTpl']->assign('navigation', $adminObject->displayNavigation('entries.php'));
        $adminObject->addItemButton(\_AM_GLOSSAIRE_ADD_ENTRY, 'entries.php?op=new', 'add');
        $adminObject->addItemButton(\_AM_GLOSSAIRE_LIST_ENTRIES, 'entries.php', 'list');
        $GLOBALS['xoopsTpl']->assign('buttons', $adminObject->displayButton('left'));
        // Get Form
        $entriesObj = $entriesHandler->get($entId);
        $entriesObj->start = $start;
        $entriesObj->limit = $limit;
        $entriesObj->statusIdSelect = $statusIdSelect;
        $form = $entriesObj->getFormEntries();
        $GLOBALS['xoopsTpl']->assign('form', $form->render());
        break;
        
    case 'delete':
        include_once "entries-delete.php";
        break;
        
    case 'changeStatus':
    case 'changestatus':
        //$entriesHandler->changeStatus($entId);
        $entriesHandler->incrementeField($entId, 'ent_status', 3);
        \redirect_header("entries.php?op=list&catIdSelect={$catIdSelect}&start={$start}&limit={$limit}&statusIdSelect={$statusIdSelect}" , 2, \_AM_GLOSSAIRE_FORM_OK);
        break;
        
        
    case 'incrementField':
    case 'incrementfield':
        //$entriesHandler->changeStatus($entId);
        $fldName = Request::getString('field', $glossaireHelper->getConfig('adminpager'));
        $entriesHandler->incrementeField($entId, $fldName, 2);
        \redirect_header("entries.php?op=list&catIdSelect={$catIdSelect}&start={$start}&limit={$limit}&statusIdSelect={$statusIdSelect}" , 2, \_AM_GLOSSAIRE_FORM_OK);
        break;
        
    case 'cleanEntriesImages':
    case 'cleanentriesimages':
        $nbImgCleaned = $utility->cleanEntriesImages($catIdSelect, 1);     
        $msg = sprintf(_AM_GLOSSAIRE_CLEAN_IMAGES_OK, $nbImgCleaned[1], $nbImgCleaned[2], $catIdSelect);         
        \redirect_header("entries.php?op=list&catIdSelect={$catIdSelect}&start={$start}&limit={$limit}&statusIdSelect={$statusIdSelect}" , 2, $msg);
        break;

    case 'cleanFolderImages':
    case 'cleanfolderimages':
        $nbImagesDeleted = $utility->cleanFolderImages($catIdSelect, 1);
        $msg = sprintf(_AM_GLOSSAIRE_IMAGES_DELETED, $nbImagesDeleted);         
        \redirect_header("entries.php?op=list&catIdSelect={$catIdSelect}&start={$start}&limit={$limit}&statusIdSelect={$statusIdSelect}" , 2, $msg);
        break;

    case 'CleanImagesNotExists':
    case 'cleanimagesnotexists':
        $nbImagesDeletedEntriesUpdated = $utility->cleanImagesNotExists($catIdSelect, 1);
        $msg = sprintf(_AM_GLOSSAIRE_CLEAN_ENTRIES_IMAGES_UPDATE, $nbImagesDeletedEntriesUpdated);         
        \redirect_header("entries.php?op=list&catIdSelect={$catIdSelect}&start={$start}&limit={$limit}&statusIdSelect={$statusIdSelect}" , 2, $msg);
        break;
        
    }
require __DIR__ . '/footer.php';
