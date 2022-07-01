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
//use colorSet AS colorSet;
use JJD AS JJD;

$GLOBALS['xoopsOption']['template_main'] = 'glossaire_entries.tpl';
require __DIR__ . '/header.php';
require_once \XOOPS_ROOT_PATH . '/header.php';

$op    = Request::getCmd('op', 'list');
$entId = Request::getInt('ent_id', 0);
$catIdSelect = Request::getInt('catIdSelect',0);
$start = Request::getInt('start', 0);
$limit = Request::getInt('limit', $glossaireHelper->getConfig('userpager'));
if (!$limit)$limit=15;
$letter= Request::getString('letter', '*');
if ($letter=='@') $letter = GLOSSAIRE_CHIFFRES;
$exp2search  = Request::getString('exp2search', '');
$exp2searchGlobal  = Request::getString('exp2searchGlobal', '');
$sender  = Request::getString('sender', '');

//if ($letter == '*') $exp2search ='';
$statusAccess = Request::getInt('statusAccess', 0);
$page2redirect = "entries.php";

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
$xoBreadcrumbs[] = ['title' => \_MA_GLOSSAIRE_INDEX, 'link' => $page2redirect];
// Permissions
$GLOBALS['xoopsTpl']->assign('showItem', $entId > 0);

        $utility = new \XoopsModules\Glossaire\Utility();        
$bolFoot = true;
switch ($op) {
    case 'show':
    case 'list':
    default:
        include_once "entries-list.php";
        break;

    case 'save':
            include_once("admin/entries-save.php");
            exit;
        break;


    case 'new':
        // Breadcrumbs
        $xoBreadcrumbs[] = ['title' => \_MA_GLOSSAIRE_ENTRY_ADD];
        // Form Create
        $entriesObj = $entriesHandler->create();
        $entriesObj->setVar('ent_cat_id', $catIdSelect);
        $entriesObj->setVar('ent_status', GLOSSAIRE_PROPOSITION);
        $entriesObj->setVar('statusAccess', $statusAccess);
        if($statusAccess == 2){
            $form = $entriesObj->getFormEntries(false, true);
        }else{
            $form = $entriesObj->getFormEntriesLight(false, true);
        }
        \JJD\load_css();
        $catObj = $categoriesHandler->get($catIdSelect);
        echo ($catObj) ? "<hr>OUI<hr>" : "<hr>NON<hr>"; 
        $GLOBALS['xoopsTpl']->assign('colors_set', $catObj->getVar('cat_colors_set'));
        echo "<hr>{$catIdSelect} : cat_colors_set : " . $catObj->getVar('cat_colors_set') . "<hr>";
        $GLOBALS['xoopsTpl']->assign('form', $form->render());
        break;
    case 'edit':
        // Breadcrumbs
        $xoBreadcrumbs[] = ['title' => \_MA_GLOSSAIRE_ENTRY_EDIT];
        // Check params
        if (0 == $entId) {
            \redirect_header("{$page2redirect}?op=list", 3, \_MA_GLOSSAIRE_INVALID_PARAM);
        }
        // Get Form
        $entriesObj = $entriesHandler->get($entId);
        $entriesObj->start = $start;
        $entriesObj->limit = $limit;
        $entriesObj->exp2search = $exp2search;
        $form = $entriesObj->getFormEntries();
        $GLOBALS['xoopsTpl']->assign('form', $form->render());
        break;
    case 'clone':
        // Breadcrumbs
        $xoBreadcrumbs[] = ['title' => \_MA_GLOSSAIRE_ENTRY_CLONE];
        // Request source
        $entIdSource = Request::getInt('ent_id_source');
        // Check params
        if (0 == $entIdSource) {
            \redirect_header("{$page2redirect}?op=list", 3, \_MA_GLOSSAIRE_INVALID_PARAM);
        }
        // Get Form
        $entriesObjSource = $entriesHandler->get($entIdSource);
        $entriesObj = $entriesObjSource->xoopsClone();
        $form = $entriesObj->getFormEntries();
        $GLOBALS['xoopsTpl']->assign('form', $form->render());
        break;
        
    case 'delete':
        include_once 'admin/entries-delete';
        break;
        // Breadcrumbs
        $xoBreadcrumbs[] = ['title' => \_MA_GLOSSAIRE_ENTRY_DELETE];
        // Check params
        if (0 == $entId) {
            \redirect_header("{$page2redirect}?op=list", 3, \_MA_GLOSSAIRE_INVALID_PARAM);
        }
        $entriesObj = $entriesHandler->get($entId);
        $entCat_id = $entriesObj->getVar('ent_cat_id');
        if (isset($_REQUEST['ok']) && 1 == $_REQUEST['ok']) {
            if (!$GLOBALS['xoopsSecurity']->check()) {
                \redirect_header($page2redirect, 3, \implode(', ', $GLOBALS['xoopsSecurity']->getErrors()));
            }
            if ($entriesHandler->delete($entriesObj)) {
                // Event delete notification
                $tags = [];
                $tags['ITEM_NAME'] = $entCat_id;
                $notificationHandler = \xoops_getHandler('notification');
                $notificationHandler->triggerEvent('global', 0, 'global_delete', $tags);
                $notificationHandler->triggerEvent('entries', $entId, 'entry_delete', $tags);
                \redirect_header($page2redirect, 3, \_MA_GLOSSAIRE_FORM_DELETE_OK);
            } else {
                $GLOBALS['xoopsTpl']->assign('error', $entriesObj->getHtmlErrors());
            }
        } else {
            $xoopsconfirm = new Common\XoopsConfirm( 
                ['ok' => 1, 'ent_id' => $entId, 'start' => $start, 'limit' => $limit, 'exp2search' => $exp2search, 'op' => 'delete'],
                $_SERVER['REQUEST_URI'],
                \sprintf(\_MA_GLOSSAIRE_FORM_SURE_DELETE, $entriesObj->getVar('ent_cat_id')));
            $form = $xoopsconfirm->getFormXoopsConfirm();
            $GLOBALS['xoopsTpl']->assign('form', $form->render());
        }
        break;

    case 'globalSearch':
    case 'globalsearch':
        $exp2search = str_replace(",|; ", "+", $exp2search);
        $andor = "OR";
        $mid =  $GLOBALS['xoopsModule']->getVar('mid');
        $url = XOOPS_URL . "/search.php?query={$exp2search}&andor={$andor}&mids%5B%5D={$mid}&submit=Recherche&action=results";
        //exit($url);
        \redirect_header($url, 0, '');
        break;
}
if ($bolFoot){
// Keywords
glossaireMetaKeywords($glossaireHelper->getConfig('keywords') . ', ' . \implode(',', $keywords));
unset($keywords);

// Description
glossaireMetaDescription(\_MA_GLOSSAIRE_ENTRIES_DESC);
$GLOBALS['xoopsTpl']->assign('xoops_mpageurl', \GLOSSAIRE_URL.'/' . $page2redirect);
$GLOBALS['xoopsTpl']->assign('glossaire_upload_url', \GLOSSAIRE_UPLOAD_URL);

require __DIR__ . '/footer.php';
}
