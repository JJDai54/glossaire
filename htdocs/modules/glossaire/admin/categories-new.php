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
//use JANUS;


    $templateMain = GLOSSAIRE_TPL_CATEGORIES_DEFAULT;
    $GLOBALS['xoopsTpl']->assign('navigation', $adminObject->displayNavigation('categories.php'));
    $adminObject->addItemButton(\_AM_GLOSSAIRE_LIST_CATEGORIES, 'categories.php', 'list');
    $GLOBALS['xoopsTpl']->assign('buttons', $adminObject->displayButton('left'));
    // Form Create
    $categoriesObj = $categoriesHandler->create();
    $categoriesObj->setVar('cat_weight', $categoriesHandler->getMax('cat_weight')+10);
    
    $categoriesObj->setVar('cat_userpager',             $glossaireHelper->getConfig('userpager'));
    $categoriesObj->setVar('cat_alphabarre',            $glossaireHelper->getConfig('alphabarre'));
    $categoriesObj->setVar('cat_alphabarre_mode',       $glossaireHelper->getConfig('alphabarre_mode'));
    $categoriesObj->setVar('cat_replace_arobase',       '[@]'); 
    //$categoriesObj->setVar('cat_show_bin', 326767));
    //$categoriesObj->setVar('cat_date_format', 'd-m-Y : H-i-s'));

    
    $form = $categoriesObj->getFormCategories();
    $GLOBALS['xoopsTpl']->assign('form', $form->render());
        

