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

require __DIR__ . '/header.php';

// Template Index
$templateMain = 'glossaire_admin_permissions.tpl';
$GLOBALS['xoopsTpl']->assign('navigation', $adminObject->displayNavigation('permissions.php'));

$op = Request::getCmd('op', 'global');

// Get Form
require_once \XOOPS_ROOT_PATH . '/class/xoopsform/grouppermform.php';
\xoops_load('XoopsFormLoader');
$permTableForm = new \XoopsSimpleForm('', 'fselperm', 'permissions.php', 'post');
$formSelect = new \XoopsFormSelect('', 'op', $op);
$formSelect->setExtra('onchange="document.fselperm.submit()"');
$formSelect->addOption('global', \_AM_GLOSSAIRE_PERMISSIONS_GLOBAL);
$formSelect->addOption('approve_categories', \_AM_GLOSSAIRE_PERMISSIONS_APPROVE . ' Categories');
$formSelect->addOption('submit_categories', \_AM_GLOSSAIRE_PERMISSIONS_SUBMIT . ' Categories');
$formSelect->addOption('view_categories', \_AM_GLOSSAIRE_PERMISSIONS_VIEW . ' Categories');
$permTableForm->addElement($formSelect);
$permTableForm->display();
switch ($op) {
    case 'global':
    default:
        $formTitle = \_AM_GLOSSAIRE_PERMISSIONS_GLOBAL;
        $permName = 'glossaire_ac';
        $permDesc = \_AM_GLOSSAIRE_PERMISSIONS_GLOBAL_DESC;
        $globalPerms = ['4' => \_AM_GLOSSAIRE_PERMISSIONS_GLOBAL_4, '8' => \_AM_GLOSSAIRE_PERMISSIONS_GLOBAL_8, '16' => \_AM_GLOSSAIRE_PERMISSIONS_GLOBAL_16 ];
        break;
    case 'approve_categories':
        $formTitle = \_AM_GLOSSAIRE_PERMISSIONS_APPROVE;
        $permName = 'glossaire_approve_categories';
        $permDesc = \_AM_GLOSSAIRE_PERMISSIONS_APPROVE_DESC . ' Categories';
        $handler = $glossaireHelper->getHandler('categories');
        break;
    case 'submit_categories':
        $formTitle = \_AM_GLOSSAIRE_PERMISSIONS_SUBMIT;
        $permName = 'glossaire_submit_categories';
        $permDesc = \_AM_GLOSSAIRE_PERMISSIONS_SUBMIT_DESC . ' Categories';
        $handler = $glossaireHelper->getHandler('categories');
        break;
    case 'view_categories':
        $formTitle = \_AM_GLOSSAIRE_PERMISSIONS_VIEW;
        $permName = 'glossaire_view_categories';
        $permDesc = \_AM_GLOSSAIRE_PERMISSIONS_VIEW_DESC . ' Categories';
        $handler = $glossaireHelper->getHandler('categories');
        break;
}
$moduleId = $xoopsModule->getVar('mid');
$permform = new \XoopsGroupPermForm($formTitle, $moduleId, $permName, $permDesc, 'admin/permissions.php');
$permFound = false;
if ($op === 'global') {
    foreach ($globalPerms as $gPermId => $gPermName) {
        $permform->addItem($gPermId, $gPermName);
    }
    $GLOBALS['xoopsTpl']->assign('form', $permform->render());
    $permFound = true;
}
if ('approve_categories' === $op || 'submit_categories' === $op || 'view_categories' === $op) {
    $categoriesCount = $categoriesHandler->getCountCategories();
    if ($categoriesCount > 0) {
        $categoriesAll = $categoriesHandler->getAllCategories(0, 'cat_name');
        foreach (\array_keys($categoriesAll) as $i) {
            $permform->addItem($categoriesAll[$i]->getVar('cat_id'), $categoriesAll[$i]->getVar('cat_name'));
        }
        $GLOBALS['xoopsTpl']->assign('form', $permform->render());
    }
    $permFound = true;
}
unset($permform);
if (true !== $permFound) {
    \redirect_header('permissions.php', 3, \_AM_GLOSSAIRE_NO_PERMISSIONS_SET);
    exit();
}
require __DIR__ . '/footer.php';
