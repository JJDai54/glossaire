<?php
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
 * @copyright      module for xoops
 * @license        GPL 2.0 or later
 * @package        glossaire
 * @since          1.0
 * @min_xoops      2.5.11
 * @author         Wedega - Email:<webmaster@wedega.com> - Website:<https://wedega.com>
 * @version        $Id: 1.0 images.php 1 Mon 2018-03-19 10:04:51Z XOOPS Project (www.xoops.org) $
 */

use Xmf\Request;

require __DIR__ . '/header.php';
$clPerms->checkAndRedirect('global_ac', GLOSSAIRE_PERM_CLONE,'GLOSSAIRE_PERM_CLONE', "index.php");

// It recovered the value of argument op in URL$
$op = Request::getString('op', 'list');
$clone = Request::getString('clone', '');

include_once (JANUS_PATH . "/class/CloneModule.php");
$clCloneModule = new CloneModule($glossaireHelper->getModule());


switch ($op) {
    case 'list':
    default:
        echo $clCloneModule->getForm();
        break;

    case 'submit':
        // Security Check
        if (!$GLOBALS['xoopsSecurity']->check()) {
            \redirect_header('clone.php', 3, \implode(',', $GLOBALS['xoopsSecurity']->getErrors()));
        }
        
        $clCloneModule->clone($clone);
        break;
}

require __DIR__ . '/footer.php';




