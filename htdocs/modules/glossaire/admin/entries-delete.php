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


    $templateMain = 'glossaire_admin_entries.tpl';
    $GLOBALS['xoopsTpl']->assign('navigation', $adminObject->displayNavigation('entries.php'));
    $entriesObj = $entriesHandler->get($entId);
    $catIdSelect = $entriesObj->getVar('ent_cat_id');
    
    if(!$clPerms->isPermit('approve_entries', $catIdSelect)){
        redirect_header(GLOSSAIRE_URL, 3 ,_AM_GLOSSAIRE_NO_PERMISSIONS_SET);
    }
    
    if (isset($_REQUEST['ok']) && 1 == $_REQUEST['ok']) {
        if (!$GLOBALS['xoopsSecurity']->check()) {
            \redirect_header('entries.php', 3, \implode(', ', $GLOBALS['xoopsSecurity']->getErrors()));
        }
        if ($entriesHandler->delete($entriesObj)) {
            \redirect_header("entries.php?catIdSelect={$catIdSelect}&start={$start}&limit={$limit}&statusIdSelect={$statusIdSelect}", 3, \_AM_GLOSSAIRE_FORM_DELETE_OK);
        } else {
            $GLOBALS['xoopsTpl']->assign('error', $entriesObj->getHtmlErrors());
        }
    } else {
        $xoopsconfirm = new XoopsConfirm(
            ['ok' => 1, 'ent_id' => $entId, 'catIdSelect' => $catIdSelect, 'start' => $start, 'limit' => $limit, 'statusIdSelect' => $statusIdSelect, 'op' => 'delete'],
            $_SERVER['REQUEST_URI'],
            \sprintf(\_AM_GLOSSAIRE_FORM_SURE_DELETE, $entriesObj->getVar('ent_id'), $entriesObj->getVar('ent_term')));
        $form = $xoopsconfirm->getFormXoopsConfirm();
        $GLOBALS['xoopsTpl']->assign('form', $form->render());
    }

