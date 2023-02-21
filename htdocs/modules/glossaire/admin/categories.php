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

require_once __DIR__ . '/header.php';
// Get all request values
$op = Request::getCmd('op', 'list');
$catId = Request::getInt('cat_id');
$start = Request::getInt('start', 0);
$limit = Request::getInt('limit', $glossaireHelper->getConfig('adminpager'));
$GLOBALS['xoopsTpl']->assign('start', $start);
$GLOBALS['xoopsTpl']->assign('limit', $limit);

/*
$gp=array_merge($_GET, $_POST);
echo "<hr><pre>" . print_r($gp, true) . "</pre><hr>";
echo "<hr><pre>" . print_r($_FILES, true) . "</pre><hr>";
*/


$utility = new \XoopsModules\Glossaire\Utility();
        
switch (strtolower($op)) {
    case 'list':
    default:
        $op = 'list';
    case 'new':
    case 'save':
        include_once("categories-{$op}.php");
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
                \sprintf(\_AM_GLOSSAIRE_FORM_SURE_DELETE, $categoriesObj->getVar('cat_id'), $categoriesObj->getVar('cat_name')));
            $form = $xoopsconfirm->getFormXoopsConfirm();
            $GLOBALS['xoopsTpl']->assign('form', $form->render());
        }
        break;
        
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
