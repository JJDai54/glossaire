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
 * @author        Jean-Jacques DELALANDRE - Email:<jjdelalandre@orange.fr> - Website:<xoopsfr.kiolo.fr>
 */

use Xmf\Request;
use XoopsModules\Glossaire;
use XoopsModules\Glossaire\Constants;
use XoopsModules\Glossaire\Common;


    $templateMain = GLOSSAIRE_TPL_ENTRIES_DEFAULT;
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


