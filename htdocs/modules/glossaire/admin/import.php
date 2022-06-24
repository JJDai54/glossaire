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
use XoopsModules\Glossaire\Utility;

require __DIR__ . '/header.php';
// It recovered the value of argument op in URL$
$op = Request::getCmd('op', 'list');
$catIdSelect = Request::getInt('catIdSelect',0);
$catId  = Request::getInt('cat_id', -1);
$catIdLexikon = Request::getInt('catIdLexikon', 0);

$utility = new \XoopsModules\Glossaire\Utility();  
include_once GLOSSAIRE_PATH . "/include/import_export.php";


////////////////////////////////////////////////////////////////////////
/**
 * 
 * */
function getCatListFromLexikon(){
global $xoopsDB;

    $sql = "SELECT categoryID, name FROM " . $xoopsDB->prefix('lxcategories')
         . " ORDER BY name";
    $rst = $xoopsDB->Query($sql);
    $catList = array();
    
    while ($row = $xoopsDB->fetchArray($rst)){
        $catList[$row['categoryID']] = $row['name'];
    }
    return $catList;
        
}

/**
 * 
 * */
function importCategoryFromLexikon($catIdLexikon){
global $xoopsDB, $categoriesHandler;

    $sql = "SELECT * FROM " . $xoopsDB->prefix('lxcategories')
         . " WHERE categoryID = {$catIdLexikon}";
    $rst = $xoopsDB->Query($sql);
    $catLexArr = $xoopsDB->fetchArray($rst);
    $suffix = '-' . rand(10000,99999);
        
    $catObj = $categoriesHandler->create();
    $catObj->setVar('cat_name', $catLexArr['name'] . $suffix);
    $catObj->setVar('cat_description', $catLexArr['description']);
    $catObj->setVar('cat_count_entries', $catLexArr['total']);
    $catObj->setVar('cat_', $catLexArr['weight']);
	$catObj->setVar('cat_img_folder', \JJD\sanityseNameForFile($catLexArr['name']) . $suffix);
        
	$catObj->setVar('cat_date_creation', \JJD\getSqlDate());
	$catObj->setVar('cat_date_update', \JJD\getSqlDate());
    

    if ($categoriesHandler->insert($catObj)) {
        $newCatId = $catObj->getNewInsertedIdCategories();
    }else{
        $newCatId = 0;
        exit("Erreur catId : {$newCatId}");
    }
    return $newCatId;
}

/**
 * 
 * */
function importEntriesFromLexikon($catIdLexikon, $catIdSelect){
global $xoopsDB, $categoriesHandler;

$entUid = $GLOBALS['xoopsUser']->uid();
$creator = \XoopsUser::getUnameFromId($entUid);
$date_creation = \JJD\getSqlDate();
$date_update = \JJD\getSqlDate();

$sql = "INSERT INTO " . $xoopsDB->prefix('glossaire_entries')
. "(ent_cat_id,ent_term,ent_initiale,ent_definition,ent_creator,ent_urls,ent_counter,ent_is_acronym,ent_status,ent_date_creation,ent_date_update) "
. " SELECT {$catIdSelect},term,init,definition,'{$creator}',url,counter,0,2,'{$date_creation}','{$date_update}'"
. " FROM " . $xoopsDB->prefix('lxentries') . " WHERE categoryID = {$catIdLexikon};";
echo $sql . "<hr>";
    $ret = $xoopsDB->query($sql);
}
$upload_size = 5000000;
////////////////////////////////////////////////////////////////////////
switch($op) {
	case 'import_self':
          include_once XOOPS_ROOT_PATH . '/class/uploader.php';
          //$fileName       = basename($_FILES['glossaire_files']['name'],".zip");
          $h= strrpos($_FILES['glossaire_files']['name'], '.');  
          $fileName = substr($_FILES['glossaire_files']['name'], 0, $h); 
          $imgMimetype    = $_FILES['glossaire_files']['type'];
          //$imgNameDef     = Request::getString('sld_short_name');
          $uploaderErrors = '';
          $uploader = new \XoopsMediaUploader(GLOSSAIRE_UPLOAD_IMPORT_PATH , 
                      array('application/x-gzip',
                            'application/zip', 
                            'text/plain',
                            'application/gzip',
                            'application/x-compressed',
                            'application/x-zip-compressed'), 
                      $upload_size, null, null);
          if ($uploader->fetchMedia($_POST['xoops_upload_file'][0])) {
              //$h= strlen($fileName) - strrpos($fileName, '.');  
              //$fileName = ; //"new-glossaire"; 
                  $uploader->setPrefix($fileName . "-");
                  $uploader->fetchMedia($_POST['xoops_upload_file'][0]);
                  if (!$uploader->upload()) {
                      $uploaderErrors = $uploader->getErrors();
                      echo "<hr>Errors upload : {$uploaderErrors}<hr>";
                      exit;
                  } else {
                      $savedFilename = $uploader->getSavedFileName();
                      if (!is_dir(GLOSSAIRE_UPLOAD_IMPORT_PATH)) mkdir(GLOSSAIRE_UPLOAD_IMPORT_PATH);
                      $fullName =  GLOSSAIRE_UPLOAD_IMPORT_PATH . "/". $savedFilename;
                      $destPath = GLOSSAIRE_UPLOAD_IMPORT_PATH . '/' . $fileName; //"/files_new_glossaire";
                      //echo "<br>===>{$savedFilename}<br>===>{$fullName}<br>===>{$destPath}<br>";
                      \JJD\unZipFile($fullName, $destPath);
                      /*
                      $newQuizId = $quizUtility::loadAsNewData($destPath, $catId);
                      */
                      //$catIdSelect = $entriesHandler->import($destPath, $catIdSelect);
                      //exit($destPath);
                      $catIdSelect = import_glossaire($destPath, $catIdSelect);

                      $xoopsFolder->delete($destPath);//();
                      unlink($fullName);
                      
                  }
                  $msg = sprintf(_AM_GLOSSAIRE_IMPORT_SUCCES, $catIdSelect);
                } else{
                  $msg =  sprintf(_AM_GLOSSAIRE_IMPORT_ECHEC, $uploader->getErrors());
                }
//exit($fullName);
            redirect_header("entries.php?op=list&catIdSelect={$catIdSelect}", 5, $msg);
        break;
    
	case 'import_lexikon':
        if ($catIdSelect < 0) $catIdSelect = importCategoryFromLexikon($catIdLexikon);
        importEntriesFromLexikon($catIdLexikon, $catIdSelect);
        //exit("import_lexikon dans {$newCatId}");
        redirect_header("entries.php?op=list&catIdSelect={$catIdSelect}", 5, "Importation Ok dans catIdSelect={$catIdSelect}");
        break;

    
    case 'import':
    case 'list':
	default:
		$templateMain = 'glossaire_admin_import.tpl';
		$helper = \XoopsModules\Glossaire\Helper::getInstance();
// 		if (false === $action) {
// 			$action = $_SERVER['REQUEST_URI'];
// 		}
		$isAdmin = $GLOBALS['xoopsUser']->isAdmin($GLOBALS['xoopsModule']->mid());
		// Permissions for uploader
		$grouppermHandler = xoops_getHandler('groupperm');
		$groups = is_object($GLOBALS['xoopsUser']) ? $GLOBALS['xoopsUser']->getGroups() : XOOPS_GROUP_ANONYMOUS;
		$permissionUpload = $grouppermHandler->checkRight('upload_groups', 32, $groups, $GLOBALS['xoopsModule']->getVar('mid')) ? true : false;
		xoops_load('XoopsFormLoader');
        
        $catList = $categoriesHandler->getList();
        $inpCategory = new \XoopsFormSelect(_AM_GLOSSAIRE_CATEGORY, 'catIdSelect', $catIdSelect);
        $inpCategory->addOption(-1, _AM_GLOSSAIRE_IMPORT_IN_NEW_CAT);
        $inpCategory->addOptionArray($catList);
        $inpCategory->setDescription(_AM_GLOSSAIRE_SELECT_CATEGORY_DESC);
		
        // /////////////////////////////////////////////////////////////////
        // ////////// form pour import d'un export Glossaire ///////////////
         // ////////////////////////////////////////////////////////////////
       // Title
		$title = _AM_GLOSSAIRE_IMPORT_FROM_GLOSSAIRE;        
		// Get Theme Form
		$formImport = new \XoopsThemeForm($title, 'form_import', 'import.php', 'post', true);
		$formImport->setExtra('enctype="multipart/form-data"');
		// To Save
		$formImport->addElement(new \XoopsFormHidden('op', 'import_self'));
		$formImport->addElement(new \XoopsFormHidden('sender', ''));

        

        //$upload_size = 3145728;     //;$helper->getConfig('maxsize_image'); 
        $uploadTray = new \XoopsFormFile(_AM_GLOSSAIRE_FILE_TO_LOAD, 'glossaire_files', $upload_size);     
        $uploadTray->setDescription(_AM_GLOSSAIRE_FILE_DESC . '<br>' . sprintf(_AM_GLOSSAIRE_FILE_UPLOADSIZE, $upload_size / 1024), '<br>');
        $formImport->addElement($uploadTray, true);

        // ----- Listes de selection pour filtrage -----  
  	    $formImport->addElement($inpCategory);

        //----------------------------------------------- 
		$formImport->addElement(new \XoopsFormButton('', _SUBMIT, _AM_GLOSSAIRE_IMPORTER, 'submit'));
//echo $formImport->render()  ;      
		$GLOBALS['xoopsTpl']->assign('form', $formImport->render());        
  
        // /////////////////////////////////////////////////////////
        // ////////  form pour import de lexikon            ////////
        // /////////////////////////////////////////////////////////
        // Title
		$title = _AM_GLOSSAIRE_IMPORT_FROM_LEXIKON;        
		$formLexikon = new \XoopsThemeForm($title, 'form_import', 'import.php', 'post', true);
		$formLexikon->setExtra('enctype="multipart/form-data"');
		// To Save
		$formLexikon->addElement(new \XoopsFormHidden('op', 'import_lexikon'));
		$formLexikon->addElement(new \XoopsFormHidden('sender', ''));

        // ----- Listes de selection des categories de Lexikon -----  
        $catListLexikon = getCatListFromLexikon();
        if ($catIdLexikon == 0) $catIdLexikon = array_key_first($catListLexikon);
        $inpcatLexikon = new \XoopsFormSelect(_AM_GLOSSAIRE_SELECT_LEX_CATEGORY, 'catIdLexikon', $catIdLexikon);
        $inpcatLexikon->addOptionArray($catListLexikon);
        $inpcatLexikon->setDescription(_AM_GLOSSAIRE_SELECT_LEX_CATEGORY_DESC);
  	    $formLexikon->addElement($inpcatLexikon);
        
        // ----- Listes de selection pour filtrage -----  
  	    $formLexikon->addElement($inpCategory);

		$formLexikon->addElement(new \XoopsFormButton('', _SUBMIT, _AM_GLOSSAIRE_IMPORTER, 'submit'));
		$GLOBALS['xoopsTpl']->assign('form_lexikon', $formLexikon->render());        



    
    break;
    

}
require __DIR__ . '/footer.php';
