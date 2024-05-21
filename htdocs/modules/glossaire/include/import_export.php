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
 * @param mixed      $module
 * @param null|mixed $prev_version
 * @package        Glossaire
 * @since          1.0
 * @min_xoops      2.5.11
 * @author         Wedega - Email:<webmaster@wedega.com> - Website:<https://wedega.com>
 * @version        $Id: 1.0 update.php 1 Mon 2018-03-19 10:04:53Z XOOPS Project (www.xoops.org) $
 * @copyright      module for xoops
 * @license        GPL 2.0 or later
 */

/**
 * @param      $module
 * @param null $prev_version
 *
 * @return bool|null
 */


/* --------------- fonctions d'exportation -------------------*/

/**************************************************************
 * 
 * ************************************************************/
function export_glossaire($catId, $gls_add_img = false, $gls_add_files=false)
{
    global $xoopsConfig, $xoopsDB, $utility, $categoriesHandler, $xoopsFolder;

    //nettoyage du dossier a exporter pour alléger l'archive compressee
    $stat = $utility->cleanCatFolders($catId, 'ent_image', '', 'images', 1, 1);        
    $stat = $utility->cleanCatFolders($catId, 'ent_file_path', 'ent_file_name', 'files', 1, 1);        
    
    // --- Dossier de destination
    $catObj = $categoriesHandler->get($catId);
    $catName = $catObj->getVar('cat_name');    
    $folder = \JJD\sanityseNameForFile($catName);
    echo "<hr>folder : {$folder}<hr>";
    //$catName = $folder; // nom du fichier = nom du dosser pour faciliter l'import
    
    $pathExport = GLOSSAIRE_UPLOAD_PATH . "/export";
    if (!is_dir($pathExport)) mkdir($pathExport, 0777, true);
    $pathGlossaire = $pathExport . "/{$folder}/";
    if (!is_dir($pathGlossaire)) mkdir($pathGlossaire, 0777, true);
    //--------------------------------------------------------------
    $uploadsPath = $catObj->getPathUploads();
    //echo "===>uploadsPath : {$uploadsPath}<br>";
    export_categories ($catId, $pathGlossaire, GLOSSAIRE_DIRNAME, $uploadsPath);    
    export_entries    ($catId, $pathGlossaire, GLOSSAIRE_DIRNAME, $uploadsPath, $gls_add_img, $gls_add_files);    
    
    // copie du fichier CSS
	$cssFrom = $catObj->getCssFileName();
    //echo "<hr>{$cssFrom}<br>" . $pathGlossaire . "/" . GLOSSAIRE_CATEGORY_CSS_NAME_FILE .  "<hr>";
    copy($cssFrom, $pathGlossaire . "/" . GLOSSAIRE_CATEGORY_CSS_NAME_FILE); 
   
    \JJD\FSO\addHtmlIndex2folder($pathExport, true);    
    //----------------------------------------------------
    
    
    \JJD\zipSimpleDir($pathGlossaire  , $pathExport . "/{$folder}.zip");  
    $xoopsFolder->delete($pathGlossaire);
    
    $outZipUrl = GLOSSAIRE_UPLOAD_URL . "/export/{$folder}.zip";
    return $outZipUrl;   
}

/**************************************************************
 * 
 * ************************************************************/
function export_categories($catId, $pathExport, $moduleName, $uploadsPath=''){
    global $xoopsFolder;
    $criteria = new \CriteriaCompo(new \Criteria('cat_id',$catId,'='));
    $tbl = 'categories';
    \Xmf\Database\TableLoad::saveTableToYamlFile("{$moduleName}_{$tbl}", $pathExport . $tbl . '.yml', $criteria);
    
    //----------------------------------------------------
    $options = array('from' => $uploadsPath . '/logo', 
                     'to'   => $pathExport . "/logo",
                     'mode' => 0777);
    $xoopsFolder->copy($options);
}

/**************************************************************
 * 
 * ************************************************************/
function export_entries($catId, $pathExport, $moduleName, $uploadsPath,$gls_add_img, $gls_add_files){
    global $xoopsFolder;
    
    $criteria = new \CriteriaCompo(new \Criteria('ent_cat_id',$catId,'='));
    $tbl = 'entries';
    \Xmf\Database\TableLoad::saveTableToYamlFile("{$moduleName}_{$tbl}", $pathExport . $tbl . '.yml', $criteria);
    
    //----------------------------------------------------
    if($gls_add_img){
 
      $options = array('from' => $uploadsPath . '/images', 
                       'to'   => $pathExport . "/images",
                       'mode' => 0777);
      $xoopsFolder->copy($options);
    }
    //----------------------------------------------------
    if($gls_add_files){
 
      $options = array('from' => $uploadsPath . '/files', 
                       'to'   => $pathExport . "/files",
                       'mode' => 0777);
      $xoopsFolder->copy($options);
    }
    /*

    */
    
}

/* --------------- fonctions d'importation -------------------*/

/**************************************************************
 * 
 * ************************************************************/
function import_glossaire($pathImport, $catId)
{
    global $categoriesHandler, $xoopsFolder;
    
    if ($catId > 0 ) {
        $categoriesObj = $categoriesHandler->get($catId);
    }else{
        $categoriesObj = import_category($pathImport);
        $catId = $categoriesObj->getVar("cat_id");
        //-----------------------------------------
        // Importation des logos
        //-----------------------------------------
        $glsUploads = $categoriesObj->getPathUploads();
        if (is_readable($pathImport . '/logo')){
        $xoopsFolder->copy(array('from' => $pathImport . '/logo', 
                                 'to'   => $glsUploads . '/logo',
                                 'mode' => 0777));   
        }
        // copie du fichier CSS
        $cssFrom = $pathImport .  "/" . GLOSSAIRE_CATEGORY_CSS_NAME_FILE;
        //echo "<hr>{$cssFrom}<br>" . $pathGlossaire . "/" . GLOSSAIRE_CATEGORY_CSS_NAME_FILE .  "<hr>";
        copy($cssFrom, $categoriesObj->getCssFileName());       
        
        
        
    }
    //---------------------------------------------------------
     if(!$glsUploads) $glsUploads = $categoriesObj->getPathUploads();
//     echo ("<hr>===>catId = {$catId}<hr>");
     import_entries($pathImport, $catId, $glsUploads);



    return $catId;
}
/**************************************************************
 * 
 * ************************************************************/
function import_entries($pathImport, $catId, $glsUploads){
global $entriesHandler, $xoopsFolder;

    $fullName = "{$pathImport}/entries.yml";
    $tabledata = \Xmf\Yaml::readWrapped($fullName);
    
    //Mise à jour des champs avant importation
    foreach ($tabledata as $index => $row) {
        //affectation du nouvel ID
        $tabledata[$index]['ent_id'] = 0;
        $tabledata[$index]['ent_cat_id'] = $catId;
    }
    
    $table = 'glossaire_entries';
    \Xmf\Database\TableLoad::loadTableFromArray($table, $tabledata);
//     unlink($fullName);
//     rmdir($FullPath);
    
    
    //-----------------------------------------
    // Importation des images
    //-----------------------------------------
    if (is_readable($pathImport . '/images')){
    $xoopsFolder->copy(array('from' => $pathImport . '/images', 
                             'to'   => $glsUploads . '/images',
                             'mode' => 0777));
    }
    
    //-----------------------------------------
    // Importation des fichiers joints
    //-----------------------------------------
    if (is_readable($pathImport . '/images')){
    $xoopsFolder->copy(array('from' => $pathImport . '/files', 
                             'to'   => $glsUploads . '/files',
                             'mode' => 0777));
    }
    
    
}

/**************************************************************
 * 
 * ************************************************************/
function import_category($pathImport){
global $categoriesHandler;
       
    //lecture du fichier et chargement dans un tableau
    $fullName = "{$pathImport}/categories.yml";
    $tabledata = \Xmf\Yaml::readWrapped($fullName);

    //Il n'y a normalement qu'une seul entrée:
    $index = 0;
    $data = $tabledata[$index];
    
    $suffix = '-' . rand(10000,99999);
    
//   echo "<hr><pre>" . print_r($tabledata, true) . "</pre><hr>";
//   echo "<hr><pre>" . print_r($data, true) . "</pre><hr>";
//echo "===>data['cat_name'] = {$data['cat_name']}<br>";
    
    $categoriesObj = $categoriesHandler->create();
//    echo "new cat : " . ((is_null($categoriesObj)) ? 'non': 'oui');
	//$categoriesObj->setVar('cat_id', 0);    
	$categoriesObj->setVar('cat_name',        $data['cat_name'] . $suffix);    
	$categoriesObj->setVar('cat_description', $data['cat_description']);    
	$categoriesObj->setVar('cat_weight',      $data['cat_weight']);    
	$categoriesObj->setVar('cat_logo',        $data['cat_logo']);  

	if (isset($data['cat_replace_arobase'])) $categoriesObj->setVar('cat_replace_arobase',  $data['cat_replace_arobase']);    
    
    
	if (isset($data['cat_userpager'])) $categoriesObj->setVar('cat_userpager',  $data['cat_userpager']); else $categoriesObj->setVar('cat_userpager',10);    
	if (isset($data['cat_show_bin']))  $categoriesObj->setVar('cat_show_bin',  $data['cat_show_bin']); else $categoriesObj->setVar('cat_show_bin',32767);    
	if (isset($data['cat_date_format']))  $categoriesObj->setVar('cat_date_format',  $data['cat_date_format']); else $categoriesObj->setVar('cat_date_format','d-m-Y : H-i-s');    
	$categoriesObj->setVar('cat_alphabarre',       $data['cat_alphabarre']);  
	$categoriesObj->setVar('cat_alphabarre_mode',  $data['cat_alphabarre_mode']);  
	$categoriesObj->setVar('cat_upload_folder',  $data['cat_upload_folder'] . $suffix);    
	$categoriesObj->setVar('cat_colors_set',     $data['cat_colors_set']);    
	$categoriesObj->setVar('cat_is_acronym',     $data['cat_is_acronym']);    
	$categoriesObj->setVar('cat_br_after_term',    $data['cat_br_after_term']);    
	$categoriesObj->setVar('cat_show_terms_index', $data['cat_show_terms_index']);    
	$categoriesObj->setVar('show_bin',             $data['cat_show_bin']);    
	$categoriesObj->setVar('cat_count_entries',    $data['cat_count_entries']);    
	$categoriesObj->setVar('cat_date_format',      $data['cat_date_format']);    
	$categoriesObj->setVar('cat_date_creation',    $data['cat_date_creation']);    
	$categoriesObj->setVar('cat_date_update', date("Y-m-d H:i:00.00000"));
    
    if ($categoriesHandler->insert($categoriesObj)) {
        $newCatId = $categoriesObj->getNewInsertedIdCategories();
    }else{
        $newCatId = 0;
        exit("Erreur catId : {$newCatId}");
    }

    return $categoriesObj;
}


