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
use XoopsModules\Glossaire\Utility;

require __DIR__ . '/header.php';
$clPerms->checkAndRedirect('global_ac',GLOSSAIRE_PERM_EXPORT , 'GLOSSAIRE_PERM_EXPORT', "index.php");
// It recovered the value of argument op in URL$
$op = Request::getCmd('op', 'list');
$catId  = Request::getInt('cat_id', -1);
$catIdSelect = Request::getInt('catIdSelect',0);
$gls_add_img = Request::getInt('gls_add_img',1);
$gls_add_files = Request::getInt('gls_add_files',1);
include_once GLOSSAIRE_PATH . "/include/import_export.php";

// echo "<hr><pre>" . print_r($_GET, true) . "</pre><hr>";
// echo "<hr><pre>" . print_r($_POST, true) . "</pre><hr>";

$utility = new \XoopsModules\Glossaire\Utility();  
//$xoTheme->addScript(XOOPS_URL . '/modules/glossaire/assets/js/import-export.js');        

// define("GLOSSAIRE_PERM_PERMS", $h++);
                                                             
////////////////////////////////////////////////////////////////////////
switch($op) {
	case 'export_ok':
        $download = true;
        //$outZipUrl = $entriesHandler->export($catIdSelect);
        $outZipUrl = export_glossaire($catIdSelect, $gls_add_img, $gls_add_files);
        
		$templateMain = 'glossaire_admin_export.tpl';
		$GLOBALS['xoopsTpl']->assign('download', 1);        
		$GLOBALS['xoopsTpl']->assign('href', $outZipUrl);        
		$GLOBALS['xoopsTpl']->assign('name', ' ===> Package');        

        
//      IMPORTANT : Pas de break ni de redirectheader pour continuer avec le formulaire de depart
//  		redirect_header('export.php?op=list&');        
//     break;
    
    case 'export':
    case 'list':
	default:
		if (!isset($download))  $GLOBALS['xoopsTpl']->assign('download', 0);        
        $catList = $categoriesHandler->getList();
        if (count($catList) == 0) \redirect_header('categories.php', 5, _AM_GLOSSAIRE_NO_CATEGORIES2);
                
		$templateMain = 'glossaire_admin_export.tpl';
		$glossaireHelper = \XoopsModules\Glossaire\Helper::getInstance();
// 		if (false === $action) {
// 			$action = $_SERVER['REQUEST_URI'];
// 		}
		$isAdmin = $GLOBALS['xoopsUser']->isAdmin($GLOBALS['xoopsModule']->mid());
		// Permissions for uploader
		$grouppermHandler = xoops_getHandler('groupperm');
		$groups = is_object($GLOBALS['xoopsUser']) ? $GLOBALS['xoopsUser']->getGroups() : XOOPS_GROUP_ANONYMOUS;
		$permissionUpload = $grouppermHandler->checkRight('upload_groups', 32, $groups, $GLOBALS['xoopsModule']->getVar('mid')) ? true : false;
		
        
        // Title
		$title = _AM_GLOSSAIRE_EXPORT;        
		// Get Theme Form
		xoops_load('XoopsFormLoader');
		$form = new \XoopsThemeForm($title, 'form_export', 'export.php', 'post', true);
		$form->setExtra('enctype="multipart/form-data"');
		// To Save
		$form->addElement(new \XoopsFormHidden('op', 'export_ok'));
		$form->addElement(new \XoopsFormHidden('sender', ''));

        // ----- Listes de selection pour filtrage -----  
        $inpCategory = new \XoopsFormSelect(_AM_GLOSSAIRE_CATEGORY, 'catIdSelect', $catIdSelect);
        $inpCategory->addOptionArray($catList);
        $inpCategory->setExtra("onchange=\"document.form_export.op.value='list';document.form_export.sender.value=this.name;document.form_export.submit();\"");
 // &gls_add_img={$gls_add_img}&gls_add_files={$gls_add_files}
  	    $form->addElement($inpCategory);
        
        $inpImgYN = new \XoopsFormRadioYN(\_AM_GLOSSAIRE_INCLUDE_IMG, 'gls_add_img', $gls_add_img);
        $inpImgYN->setDescription(_AM_GLOSSAIRE_INCLUDE_IMG_DESC);
  	    $form->addElement($inpImgYN);
                  
        $inpFileYN = new \XoopsFormRadioYN(\_AM_GLOSSAIRE_INCLUDE_FILES, 'gls_add_files', $gls_add_files);
        $inpFileYN->setDescription(_AM_GLOSSAIRE_INCLUDE_FILES_DESC);
  	    $form->addElement($inpFileYN);

        //-----------------------------------------------$caption, $name, $value = '', $type = 'button'
        $btnSubmit = new \XoopsFormButton(_AM_GLOSSAIRE_EXPORT_AVERTISSEMENT, _SUBMIT, _AM_GLOSSAIRE_EXPORTER, 'submit');
        $btnSubmit->setDescription(_AM_GLOSSAIRE_EXPORT_AVERTISSEMENT_DESC);
		$form->addElement($btnSubmit);
//echo $form->render()  ;      
		$GLOBALS['xoopsTpl']->assign('form', $form->render());        
        
/////////////////////////////////////////        


    
    break;
    

}
require __DIR__ . '/footer.php';
