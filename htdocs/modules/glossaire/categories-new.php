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

    // Breadcrumbs
    $xoBreadcrumbs[] = ['title' => \_MA_GLOSSAIRE_CATEGORY_ADD];
    // Check permissions
    if (!$permissionsHandler->getPermGlobalSubmit()) {
        \redirect_header('categories.php?op=list', 3, \_NOPERM);
    }
    // Form Create
    $categoriesObj = $categoriesHandler->create();
    $categoriesObj->setVar('cat_weight', $categoriesHandler->getMax('cat_weight')+10);
    
    $categoriesObj->setVar('userpager',                 $glossaireHelper->getConfig('userpager'));
    $categoriesObj->setVar('cat_alphabarre',            $glossaireHelper->getConfig('alphabarre'));
    $categoriesObj->setVar('cat_alphabarre_mode',       $glossaireHelper->getConfig('alphabarre_mode'));
    $categoriesObj->setVar('cat_letter_css_default',    $glossaireHelper->getConfig('letter_css_default'));
    $categoriesObj->setVar('cat_letter_css_selected',   $glossaireHelper->getConfig('letter_css_selected'));
    $categoriesObj->setVar('cat_letter_css_exist',      $glossaireHelper->getConfig('letter_css_exist'));
    $categoriesObj->setVar('cat_letter_css_notexist',   $glossaireHelper->getConfig('letter_css_notexist'));
    $categoriesObj->setVar('cat_replace_arobase',       $glossaireHelper->getConfig('replace_arobase'));

    $form = $categoriesObj->getFormCategories();
    $GLOBALS['xoopsTpl']->assign('form', $form->render());
