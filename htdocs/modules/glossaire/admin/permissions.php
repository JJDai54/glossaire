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
$clPerms->checkAndRedirect('global_ac', GLOSSAIRE_PERM_PERMS , 'GLOSSAIRE_PERM_PERMS', "index.php", true);

// Template Index
$templateMain = 'glossaire_admin_permissions.tpl';
$GLOBALS['xoopsTpl']->assign('navigation', $adminObject->displayNavigation('permissions.php'));


// Get Form
require_once \XOOPS_ROOT_PATH . '/class/xoopsform/grouppermform.php';
\xoops_load('XoopsFormLoader');

$op = Request::getCmd('op', '');
if ($op == '') $op = 'global_ac';
$domaines = explode('_', $op . '__');


//permission spécifiques
$permArr = ['global_ac'         => _AM_GLOSSAIRE_PERM_GLOBAL_AC,
            'view_cats'         => _AM_GLOSSAIRE_PERM_VIEW_CATS,
            'approve_entries'    => _AM_GLOSSAIRE_PERM_APPROVE_ENTRIES,
            'submit_entries'    => _AM_GLOSSAIRE_PERM_SUBMIT_ENTRIES];
/*
            'submit_entries'    => _AM_GLOSSAIRE_PERM_SUBMIT_ENTRIES,
            'add_entries'       => _AM_GLOSSAIRE_PERM_ADD_ENTRIES,
            'edit_entries'      => _AM_GLOSSAIRE_PERM_EDIT_ENTRIES,
            'delete_entries'    => _AM_GLOSSAIRE_PERM_DELETE_ENTRIES];
            
$clPerms->checkAndRedirect('add_entries', $catId , 'cat_id', "index.php", true);
$clPerms->checkAndRedirect('edit_entries', $catId , 'cat_id', "index.php", true);
$clPerms->checkAndRedirect('delete_entries', $catId , 'cat_id', "index.php", true);
$clPerms->checkAndRedirect('view_cats', $catId , 'cat_id', "index.php", true);
$clPerms->addPermissions($criteria, 'view_cats', 'cat_id');
SELECT * FROM `x251_group_permission` WHERE `gperm_name` LIKE "%glossaire%"
*/
$permTableForm = new \XoopsSimpleForm('', 'fselperm', 'permissions.php', 'post');
$formSelect = new \XoopsFormSelect('', 'op', $op);
$formSelect->setExtra('onchange="document.fselperm.submit()"');
$formSelect->addOptionArray($permArr);
$permTableForm->addElement($formSelect);
$permTableForm->display();

/*
echo '===>' . $op . '--->' . '_AM_GLOSSAIRE_PERM_' . strtoupper($domaines[0]). '<br>';
*/
	$formTitle = constant('_AM_GLOSSAIRE_PERM_' . strtoupper($domaines[0] . '_' . strtoupper($domaines[1]))) ;
	$permName = $op; 
    //$cst = strtoupper('_AM_QUIZMAKER_PERMISSIONS_' . strtoupper($domaines[0]));   // ."_DESC"
	$permDesc = $formTitle;
	$permFound = true;

//exit;
switch($domaines[1]) {
	case 'ac':
        //permission globales
		$permArr = [GLOSSAIRE_PERM_MANCATS => _AM_GLOSSAIRE_PERM_MANCATS,
                    GLOSSAIRE_PERM_IPORT   => _AM_GLOSSAIRE_PERM_IPORT,
                    GLOSSAIRE_PERM_EXPORT  => _AM_GLOSSAIRE_PERM_EXPORT,
                    GLOSSAIRE_PERM_CLONE   => _AM_GLOSSAIRE_PERM_CLONE, 
                    GLOSSAIRE_PERM_PERMS   => _AM_GLOSSAIRE_PERM_PERMS]; 
                         
        break;
	case 'cats':
	case 'entries':
        $permArr = $categoriesHandler->getList();
        break;
	default:
	$permFound = false;
}

//echoArray($permArr, "op= {$op} - domaine={$domaine}");
//echo "formTitle : {$formTitle}<br>permName : {$permName}<br>permDesc : {$permDesc}<hr>";
    $permform = $clPerms->getPermissionsForm($formTitle, $permName, _AM_GLOSSAIRE_PERM_DESC, $permArr, $op);
    //$permform->addElement(new XoopsFormHidden('op','edit_quiz'));
    echo $permform->render();
    //$GLOBALS['xoopsTpl']->assign('form', $permform->render());


unset($permform);
if (true !== $permFound) {
	redirect_header('permissions.php', 3, _AM_GLOSSAIRE_NO_PERMISSIONS_SET);
	exit();
}
require __DIR__ . '/footer.php';

/////////////////////////////////////////////////////////////////////////////////


