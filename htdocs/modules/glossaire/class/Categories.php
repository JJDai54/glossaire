<?php

declare(strict_types=1);


namespace XoopsModules\Glossaire;

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

use XoopsModules\Glossaire;
use colorSet AS colorSet;
use JJD;

\defined('XOOPS_ROOT_PATH') || die('Restricted access');

/**
 * Class Object Categories
 */
class Categories extends \XoopsObject
{
    /**
     * @var int
     */
    public $start = 0;

    /**
     * @var int
     */
    public $limit = 0;

    /**
     * Constructor
     *
     * @param null
     */
    public function __construct()
{
        $this->initVar('cat_id', \XOBJ_DTYPE_INT);
        $this->initVar('cat_name', \XOBJ_DTYPE_TXTBOX);
        $this->initVar('cat_description', \XOBJ_DTYPE_OTHER);
        $this->initVar('cat_weight', \XOBJ_DTYPE_INT);
        $this->initVar('cat_logo', \XOBJ_DTYPE_TXTBOX);
        $this->initVar('cat_userpager', \XOBJ_DTYPE_INT);
        $this->initVar('cat_alphabarre', \XOBJ_DTYPE_TXTBOX);
        $this->initVar('cat_alphabarre_mode', \XOBJ_DTYPE_INT);
        $this->initVar('cat_upload_folder', \XOBJ_DTYPE_TXTBOX);
        $this->initVar('cat_colors_set', \XOBJ_DTYPE_TXTBOX);
        $this->initVar('cat_is_acronym', \XOBJ_DTYPE_INT); 
        $this->initVar('cat_replace_arobase', \XOBJ_DTYPE_TXTBOX);
        $this->initVar('cat_br_after_term', \XOBJ_DTYPE_INT); 
        $this->initVar('cat_count_entries', \XOBJ_DTYPE_INT); 
        $this->initVar('cat_show_terms_index', \XOBJ_DTYPE_INT); 
        $this->initVar('cat_show_bin', \XOBJ_DTYPE_INT); 
        $this->initVar('cat_active', \XOBJ_DTYPE_INT); 
        $this->initVar('cat_date_creation', \XOBJ_DTYPE_OTHER); //XOBJ_DTYPE_LTIME
        $this->initVar('cat_date_update', \XOBJ_DTYPE_OTHER); //XOBJ_DTYPE_LTIME
    }
 




    /**
     * @static function &getInstance
     *
     * @param null
     */
    public static function getInstance()
    {
        static $instance = false;
        if (!$instance) {
            $instance = new self();
        }
    }  


    /**
     * The new inserted $Id
     * @return inserted id
     */
    public function getNewInsertedIdCategories()
    {
        $newInsertedId = $GLOBALS['xoopsDB']->getInsertId();
        return $newInsertedId;
    }


    /**
     * The the CSS of the categorie
     * @return inserted id
     */
    public function getFormCategoriesCss($action = false)
    {
        $glossaireHelper = \XoopsModules\Glossaire\Helper::getInstance();
        $styleBreakLine = '<center><div style="background:black;color:white;">%s</div></center>';
        
        if (!$action) {
            $action = $_SERVER['REQUEST_URI'];
        }
        $isAdmin = $GLOBALS['xoopsUser']->isAdmin($GLOBALS['xoopsModule']->mid());
        // Title

        // Get Theme Form
        \xoops_load('XoopsFormLoader');
        $title = sprintf("%s<br>%s", $this->getVar('cat_name'), \_AM_GLOSSAIRE_CATEGORY_EDIT_CSS);
        $form = new \XoopsThemeForm($title, 'form', $action, 'post', true);
        $form->setExtra('enctype="multipart/form-data"');
        //-------------------------------------------------
        //$cssArr = $this->load_css_as_array(true);
        $cssArr = $this->load_css_as_array();
        //echoArray($cssArr);
        $h = 0;
        foreach($cssArr as $cssName=>$cssClass){
            $constName = "_AM_GLOSSAIRE_STYLES_" . strtoupper(substr($cssName,1));            
            $cssTray = new \XoopsFormElementTray(constant($constName) . " - <span style='color:red;'>[{$cssName}]</span>", '<br>');
        
            $inpStyle = new \XoopsFormTextArea('', "css[{$cssName}]", $cssClass, 5, 50);
            $inpStyle->setExtra("style='width:400px;'");
            $cssTray->addElement($inpStyle, false);
        
            $form->addElement($cssTray, false);
            $h++;
        }        
        //-------------------------------------------------
        $form->addElement(new \XoopsFormHidden('op', 'save_css'));
        $form->addElement(new \XoopsFormHidden('start', $this->start));
        $form->addElement(new \XoopsFormHidden('limit', $this->limit));
        $form->addElement(new \XoopsFormButtonTray('', \_SUBMIT, 'submit', '', false));

        return $form;
}

    /**
     * @public function getForm
     * @param bool $action
     * @return \XoopsThemeForm
     */
    public function getFormCategories($action = false)
    {
        $glossaireHelper = \XoopsModules\Glossaire\Helper::getInstance();
        $styleBreakLine = '<center><div style="background:black;color:white;">%s</div></center>';
        
        if (!$action) {
            $action = $_SERVER['REQUEST_URI'];
        }
        $isAdmin = $GLOBALS['xoopsUser']->isAdmin($GLOBALS['xoopsModule']->mid());
        // Title
        $title = $this->isNew() ? \sprintf(\_AM_GLOSSAIRE_CATEGORY_ADD) : \sprintf(\_AM_GLOSSAIRE_CATEGORY_EDIT);
        // Get Theme Form
        \xoops_load('XoopsFormLoader');
        $form = new \XoopsThemeForm($title, 'form', $action, 'post', true);
        $form->setExtra('enctype="multipart/form-data"');
        
        // Form Text catName
        $form->addElement(new \XoopsFormText(\_AM_GLOSSAIRE_CATEGORY_NAME, 'cat_name', 50, 255, $this->getVar('cat_name')), true);

        // Form Text cat_upload_folder
        //$form->addElement(new \XoopsFormLabel(\_AM_GLOSSAIRE_CATEGORY_UMLOAD_FOLDER, $this->getVar('cat_upload_folder')));
        $inpFolder = new \XoopsFormText(\_AM_GLOSSAIRE_CATEGORY_FOLDER, 'cat_upload_folder', 50, 255, $this->getVar('cat_upload_folder'));
        $inpFolder->setDescription(_AM_GLOSSAIRE_CATEGORY_FOLDER_DESC);
        $form->addElement($inpFolder, false);
        // Form Editor TextArea catDescription
        //$form->addElement(new \XoopsFormTextArea(\_AM_GLOSSAIRE_CATEGORY_DESCRIPTION, 'cat_description', $this->getVar('cat_description', 'e'), 4, 47));
        $editorConfigs = [];
        if ($isAdmin) {
            $editor = $glossaireHelper->getConfig('editor_admin');
        } else {
            $editor = $glossaireHelper->getConfig('editor_user');
        }
        $editorConfigs['name'] = 'cat_description';
        $editorConfigs['value'] = $this->getVar('cat_description', 'e');
        $editorConfigs['rows'] = 5;
        $editorConfigs['cols'] = 40;
        $editorConfigs['width'] = '100%';
        $editorConfigs['height'] = '400px';
        $editorConfigs['editor'] = $editor;
        $form->addElement(new \XoopsFormEditor(\_AM_GLOSSAIRE_CATEGORY_DESCRIPTION, 'cat_description', $editorConfigs));
        
        // Form Text catWeight
        $form->addElement(new \XoopsFormText(\_AM_GLOSSAIRE_CATEGORY_WEIGHT, 'cat_weight', 50, 255, $this->getVar('cat_weight')));
        
        // Form Frameworks Images Files catLogourl
        // Form Frameworks Images catLogourl: Select Uploaded Image
        //$imageDirectory = '/Frameworks/moduleclasses/icons/32';
        //$imageDirectory = GLOSSAIRE_UPLOAD_IMPORT_DATA_PATH . "/" . $this->getVar('cat_upload_folder') . '/logo';
        $logo_url = $this->getPathUploads('logo', true) . "/" . $this->getVar('cat_logo');
        
        $labLogo = new \XoopsFormLabel('', "<img src='{$logo_url}' alt='' style='max-width:100px' >");        
                                
        $logoTray = new \XoopsFormElementTray(_AM_GLOSSAIRE_CATEGORY_LOGO, '<br>');
        $logoTray->addElement($labLogo);
        $logoTray->addElement(new \XoopsFormFile('', 'cat_logo', $glossaireHelper->getConfig('maxsize_image')));
        $form->addElement($logoTray);

        
       // Form Text Date Select cat_colors_set
        //$form->addElement(new \XoopsFormText(\_AM_GLOSSAIRE_CATEGORY_THEME, 'cat_colors_set', 50, 50, $this->getVar('cat_colors_set')));
        $selectFormColorSet = new \XoopsFormSelect(_AM_GLOSSAIRE_CATEGORY_COLOR_SET , 'cat_colors_set', $this->getVar( 'cat_colors_set', 'e' ) );
        $selectFormColorSet->addOptionArray(\jjd\get_css_color());
        //$selectFormColorSet->setDescription(_AM_GLOSSAIRE_CATEGORY_COLOR_SET_DESC);
        $form->addElement($selectFormColorSet);

        // Form Text cat_is_acronym
        $inpMagnifySd = new \XoopsFormRadioYN(\_AM_GLOSSAIRE_CATEGORY_MAGNIFY_SD, 'cat_is_acronym', $this->getVar('cat_is_acronym'));
        $inpMagnifySd->setDescription(\_AM_GLOSSAIRE_CATEGORY_MAGNIFY_SD_DESC);
        $form->addElement($inpMagnifySd);
        
        // Form Text cat_replace_arobase
        $inpReplaceArobase = new \XoopsFormText(\_AM_GLOSSAIRE_REPLACE_AROBASE, 'cat_replace_arobase', 5, 5, $this->getVar('cat_replace_arobase'));
        $inpReplaceArobase->setDescription(\_AM_GLOSSAIRE_REPLACE_AROBASE_DESC);
        $form->addElement($inpReplaceArobase);
        
        // Form Text cat_br_after_term
        $inpBrAfterTerm = new \XoopsFormRadioYN(\_AM_GLOSSAIRE_CATEGORY_BR_AFTER_TERME, 'cat_br_after_term', $this->getVar('cat_br_after_term'));
        $inpBrAfterTerm->setDescription(\_AM_GLOSSAIRE_CATEGORY_BR_AFTER_TERME_DESC);
        $form->addElement($inpBrAfterTerm);
        
        
        //========================================================
        $form->insertBreak(sprintf($styleBreakLine, _AM_GLOSSAIRE_ALPHABARRE));
        //========================================================
 
        // Form  cat_userpager
        $inpUserpager = new \XoopsFormNumber(_MI_GLOSSAIRE_USER_PAGER, "cat_userpager", 5, 5,  $this->getVar('cat_userpager'));
        $inpUserpager->setDescription(_MI_GLOSSAIRE_USER_PAGER_DESC);
        $inpUserpager->setMinMax(5, 100);
        $form->addElement($inpUserpager);
        
        // Form  cat_show_terms_index
        $inpColsIndex = new \XoopsFormNumber(_AM_GLOSSAIRE_NB_COLUMNS_INDEX, "cat_show_terms_index", 5, 5,  $this->getVar('cat_show_terms_index'));
        $inpColsIndex->setDescription(_AM_GLOSSAIRE_NB_COLUMNS_INDEX_DESC);
        $inpColsIndex->setMinMax(-1, 5);
        $form->addElement($inpColsIndex);

        // Form  cat_show_bin
  
//     function __construct($caption, $name, $value = 0, 
//                          $cols = 1, $allowCheckAll = false,
//                          $optionsSeparator = ";")
                         
        $inpShowBin = new \XoopsFormCheckboxBin(_AM_GLOSSAIRE_CAT_SHOW_BIN, "cat_show_bin", $this->getVar('cat_show_bin'),1,true);
        //$inpShowBin->setDescription(_AM_GLOSSAIRE_CAT_SHOW_BIN_DESC);
        $inpShowBin->addOptionArray([_AM_GLOSSAIRE_ENT_ID,
                                     _AM_GLOSSAIRE_ENT_SHORTDEF,
                                     _AM_GLOSSAIRE_ENT_MAGNIFY,
                                     _AM_GLOSSAIRE_ENT_DEFINITION,
                                     _AM_GLOSSAIRE_ENT_CREATOR,
                                     _AM_GLOSSAIRE_ENT_IMAGE,
                                     _AM_GLOSSAIRE_ENT_REFERENCE,
                                     _AM_GLOSSAIRE_ENT_FILE_NAME,
                                     _AM_GLOSSAIRE_ENT_URLS,
                                     _AM_GLOSSAIRE_ENT_EMAIL,
                                     _AM_GLOSSAIRE_ENT_COUNTER,
                                     _AM_GLOSSAIRE_ENT_DATE_CREATION,
                                    _AM_GLOSSAIRE_ENT_DATE_UPDATE]);
        $form->addElement($inpShowBin);

        // Form alphabarre 
        $inpAlphabarre = new \XoopsFormText(\_MI_GLOSSAIRE_ALPHABARRE, 'cat_alphabarre', 150, 255, $this->getVar('cat_alphabarre'));
        $inpAlphabarre->setDescription(_MI_GLOSSAIRE_ALPHABARRE_DESC);
        $form->addElement($inpAlphabarre);
        $form->addElement(new \XoopsFormRadioYN(\_MI_GLOSSAIRE_ALPHABARRE_MODE, 'cat_alphabarre_mode', $this->getVar('cat_alphabarre_mode')));

        //========================================================
        $form->insertBreak(sprintf($styleBreakLine, _AM_GLOSSAIRE_PERMISSIONS));
        //========================================================
        // Form Text cat_active
        $inpActive = new \XoopsFormRadioYN(\_AM_GLOSSAIRE_CATEGORY_ACTIVE, 'cat_active', $this->getVar('cat_active'));
        $inpActive->setDescription(\_AM_GLOSSAIRE_CATEGORY_ACTIVE_DESC);
        $form->addElement($inpActive);
        
        // Permissions
        $memberHandler = \xoops_getHandler('member');
        $groupList = $memberHandler->getGroupList();
        $grouppermHandler = \xoops_getHandler('groupperm');
        $fullList[] = \array_keys($groupList);
        if ($this->isNew()) {
            $groupsCanApproveCheckbox = new \XoopsFormCheckBox(\_AM_GLOSSAIRE_PERMISSIONS_APPROVE, 'groups_approve_categories[]', $fullList);
            $groupsCanSubmitCheckbox = new \XoopsFormCheckBox(\_AM_GLOSSAIRE_PERMISSIONS_SUBMIT, 'groups_submit_categories[]', $fullList);
            $groupsCanViewCheckbox = new \XoopsFormCheckBox(\_AM_GLOSSAIRE_PERMISSIONS_VIEW, 'groups_view_categories[]', $fullList);
        } else {
            $groupsIdsApprove = $grouppermHandler->getGroupIds('glossaire_approve_categories', $this->getVar('cat_id'), $GLOBALS['xoopsModule']->getVar('mid'));
            $groupsIdsApprove[] = \array_values($groupsIdsApprove);
            $groupsCanApproveCheckbox = new \XoopsFormCheckBox(\_AM_GLOSSAIRE_PERMISSIONS_APPROVE, 'groups_approve_categories[]', $groupsIdsApprove);
            $groupsIdsSubmit = $grouppermHandler->getGroupIds('glossaire_submit_categories', $this->getVar('cat_id'), $GLOBALS['xoopsModule']->getVar('mid'));
            $groupsIdsSubmit[] = \array_values($groupsIdsSubmit);
            $groupsCanSubmitCheckbox = new \XoopsFormCheckBox(\_AM_GLOSSAIRE_PERMISSIONS_SUBMIT, 'groups_submit_categories[]', $groupsIdsSubmit);
            $groupsIdsView = $grouppermHandler->getGroupIds('glossaire_view_categories', $this->getVar('cat_id'), $GLOBALS['xoopsModule']->getVar('mid'));
            $groupsIdsView[] = \array_values($groupsIdsView);
            $groupsCanViewCheckbox = new \XoopsFormCheckBox(\_AM_GLOSSAIRE_PERMISSIONS_VIEW, 'groups_view_categories[]', $groupsIdsView);
        }
        // To Approve
        $groupsCanApproveCheckbox->addOptionArray($groupList);
        $form->addElement($groupsCanApproveCheckbox);
        // To Submit
        $groupsCanSubmitCheckbox->addOptionArray($groupList);
        $form->addElement($groupsCanSubmitCheckbox);
        // To View
        $groupsCanViewCheckbox->addOptionArray($groupList);
        $form->addElement($groupsCanViewCheckbox);
        // To Save
        $form->addElement(new \XoopsFormHidden('op', 'save'));
        $form->addElement(new \XoopsFormHidden('start', $this->start));
        $form->addElement(new \XoopsFormHidden('limit', $this->limit));
        $form->addElement(new \XoopsFormButtonTray('', \_SUBMIT, 'submit', '', false));
        return $form;
    }

    /**
     * Get Values
     * @param null $keys
     * @param null $format
     * @param null $maxDepth
     * @return array
     */
    public function getValuesCategories($keys = null, $format = null, $maxDepth = null)
    {global $glossaireHelper;
        $glossaireHelper  = \XoopsModules\Glossaire\Helper::getInstance();
        $utility = new \XoopsModules\Glossaire\Utility();
        $ret = $this->getValues($keys, $format, $maxDepth);
        $ret['id']                = $this->getVar('cat_id');
        $ret['name']              = $this->getVar('cat_name');
        $ret['description']       = $this->getVar('cat_description', 'e');
 
        if($this->getVar('cat_logo') != ''){
            $logo_url = $this->getPathUploads("logo", true) . '/' . $this->getVar('cat_logo') ;
            $ret['description_img'] = sprintf("<img src='%s' class='gls_logoTopLeft'>%s", $logo_url, $this->getVar('cat_description', 'e'));            
        }else{
            $logo_url = '';
            $ret['description_img'] = $this->getVar('cat_logo') . $ret['description'];
        }
        $ret['logo_url'] = $logo_url;
        
        

        $editorMaxchar = $glossaireHelper->getModule()->getInfo('editor_maxchar');
        $ret['description_short'] = $utility::truncateHtml($ret['description'], $editorMaxchar);
        $ret['weight']            = $this->getVar('cat_weight');
        $ret['logo']              = $this->getVar('cat_logo');

        $ret['userpager']           = $this->getVar('cat_userpager');
        $ret['alphabarre']          = $this->getVar('cat_alphabarre');
        $ret['alphabarre_mode']     = $this->getVar('cat_alphabarre_mode');

        $ret['upload_folder']        = $this->getVar('cat_upload_folder');
        $ret['colors_set']           = ($this->getVar('cat_colors_set')) ? $this->getVar('cat_colors_set') : "default";
        $ret['is_acronym']           = $this->getVar('cat_is_acronym');
        $ret['cat_replace_arobase']  = $this->getVar('cat_replace_arobase');     
        $ret['br_after_term']     = $this->getVar('cat_br_after_term');
        $ret['show_terms_index']  = $this->getVar('cat_show_terms_index');
        $ret['show_bin']          = convert_bin_to_array($this->getVar('cat_show_bin'));
        $ret['count_entries']     = $this->getVar('cat_count_entries');
//         $ret['date_creation']     = \formatTimestamp($this->getVar('cat_date_creation'), 'm');
//         $ret['date_update']    = \formatTimestamp($this->getVar('cat_date_update'), 'm');
        $ret['active']            = $this->getVar('cat_active');
		$ret['date_creation']     = \JJD\getDateSql2Str($this->getVar('cat_date_creation'));
		$ret['date_update']       = \JJD\getDateSql2Str($this->getVar('cat_date_update'));
		$ret['css'] = $this->load_css_as_array(true);
        
        return $ret;
    }
    
    
    /**
     * cré les dossier de stockage des images et fichiers de la catégories
     *
     * @return string fullPath
     */
    public function createFolders($catFolder){
        //verifie si le dossier existe déjà
        $fldArr = array($catFolder,"{$catFolder}/logo","{$catFolder}/images","{$catFolder}/files");
        
        for($h=0;$h<count($fldArr);$h++){
            $fullName = GLOSSAIRE_UPLOAD_IMPORT_DATA_PATH.'/'. $fldArr[$h];
            if(!is_dir($fullName)) mkdir($fullName, $mode = 0777);
            //\JJD\FSO\addHtmlIndex2folder($fullName);
        }
            \JJD\FSO\addHtmlIndex2folder(GLOSSAIRE_UPLOAD_IMPORT_DATA_PATH.'/'. $catFolder, true);
        
//exit(GLOSSAIRE_UPLOAD_IMPORT_DATA_PATH.'/'. $catFolder) ;       
        return true;
    }
    
    
    /**
     * Returns chemin de stockage des images et fichiers de la catégories
     *
     * @return string fullPath
     */
    public function getPathUploads($subFolder='', $isUrl=false, $mode= 0777){
    
        if($subFolder !== '')
            $folder = '/' . $this->getVar('cat_upload_folder') . '/' . $subFolder;
        else
            $folder = '/' . $this->getVar('cat_upload_folder');
        $fIndex  = XOOPS_UPLOAD_PATH . '/index.php';        
        //--------------------------------------------------
        $fullPath = GLOSSAIRE_UPLOAD_IMPORT_DATA_PATH . $folder;
        //optimisation, le dossier a sans doute ete déja créé avec la premiere image
        if(!is_dir($fullPath)){
            //echo "getPathUploads fullPath : {$fullPath}<br>";
            $h = strpos($fullPath, '/', strlen(XOOPS_ROOT_PATH)+1);
            while($h !== false){
                $dir = substr($fullPath, 0, $h);
                //echo "getPathUploads dir : {$dir}<br>";
                if(!is_dir($dir)) mkdir($dir, $mode);  
                
                if (!is_readable($dir . '/index.php') && !is_readable($dir . '/index.html')) 
                    copy($fIndex, $dir . '/index.php');    
                
                $h = strpos($fullPath , '/', $h+1);
            }
            if(!is_dir($fullPath)) mkdir($fullPath, $mode);      
            //echo "getPathUploads fullPath : {$fullPath}<br>";
        }
        //--------------------------------------------        
        if ($isUrl) 
            return GLOSSAIRE_UPLOAD_IMPORT_DATA_URL . $folder;
        else
            return $fullPath;
    }


	/**
     * Fonction qui liste les catégories qui respectent la permission demandée
     * @param string   $permtype	Type de permission
     * @return array   $cat		    Liste des catégorie qui correspondent à la permission
     */
	public function getPerms()
    {global $categoriesHandler;
     
        $allPerms = array();
        $idCat=$this->getVar('cat_id');
        
        $tPerm = $categoriesHandler->getPermissions('view');

//echo "<hr>cat_id = {$idCat}<pre>" . print_r($tPerm, true) . "</pre><hr>";
        
        $allPerms['view'] = !(array_search($idCat, $tPerm) === false);
        
        $tPerm = $categoriesHandler->getPermissions('submit');
        $allPerms['submit'] = !(array_search($idCat, $tPerm) === false);
        
        $tPerm = $categoriesHandler->getPermissions('approve');
        $allPerms['approve'] = !(array_search($idCat, $tPerm) === false);
        //-------------------------------------
//         $allPerms['view'] = ($allPerms['view']) ? "Ok" : "Pas Ok";
//         $allPerms['submit'] = ($allPerms['submit']) ? "Ok" : "Pas Ok";
//         $allPerms['approve'] = ($allPerms['approve']) ? "Ok" : "Pas Ok";
        
        return $allPerms;
    }                                 
     
     /* ***************** gestion des CSS par categorie ********************/   
	/**
     */
	public function getCssFileName($isUrl = false){
        return $this->getPathUploads('', $isUrl) . "/" . GLOSSAIRE_CATEGORY_CSS_NAME_FILE;
    }
	/**
     */
     
	public function copy_css_category_modele()
    {
    global $categoriesHandler;
        $cssCatFille = $this->getCssFileName();
        //echo $cssCatFille  . "<br>";
        if (!file_exists($cssCatFille)){
            $cssModele = GLOSSAIRE_PATH . "/assets/css/category-modele.css";
            //echo  $cssModele . "<br>";
            copy($cssModele, $cssCatFille);            
            //\JJD\FSO\saveTexte2File($fullName, $content, $mod = 0777){
        }
        
    }
     
     
	public function css_trim_content($content, $newSep = '')
    {
        $content = str_replace("\n","",$content);
        $t = explode(";", $content);  
        for($h=0; $h < count($t); $h++) 
            if (trim($t[$h]))        
            $t[$h] = trim($t[$h]) . ';';

        return  implode($newSep, $t);
    }
    
    
	public function load_css_as_array($likeStyle = false)
    {
        //copie du fichier csz modele si il n'existe paq déjà
        $this->copy_css_category_modele();
        $cssCatFille = $this->getCssFileName();   
/*
        
        //echo $cssCatFille  . "<br>";
        if (!file_exists($cssCatFille)){
            $cssModele = GLOSSAIRE_PATH . "/assets/css/category-modele.css";
            //echo  $cssModele . "<br>";
            copy($cssModele, $cssCatFille);            
            //\JJD\FSO\saveTexte2File($fullName, $content, $mod = 0777){
        }
*/        
        $content = file_get_contents($cssCatFille);
        $cssArr = $this->parseCss($content);

        //-----------------------------------------------------
        //complete avec les nouveau style fevitni dans le modèle        
        $modCssModele = GLOSSAIRE_PATH . "/assets/css/category-modele.css";
        $ModContent = file_get_contents($modCssModele);
        $modCssArr = $this->parseCss($ModContent);
        $cssArr = array_merge($modCssArr, $cssArr);  
//         echoArray($modCssArr,'modele'); 
//         echoArray($cssArr,'categorie'); 
        //-----------------------------------------------------
        //renvoie une ligne avec uniquement les attribut et valeur        
            $tStyle = array();
        if($likeStyle){
            forEach($cssArr as $cssName=>$attributs){
            /*
               $content = str_replace("\n","",$attrinuts);
               $t = explode(";", $attrinuts);  
               for($h=0; $h < count($t); $h++) $t[$h] = trim($t[$h]);
               $tStyle[substr($cssName,1)] = implode(';', $t);
            */
               $tStyle[substr($cssName,1)] = $this->css_trim_content($attributs);
            }
//echoArray($tStyle);                   
            return $tStyle;
        }else{
            forEach($cssArr as $cssName=>$attributs){
               //$tStyle[substr($cssName,1)] = $this->css_trim_content($attributs, "\n");
               $tStyle[$cssName] = $this->css_trim_content($attributs, "\n");
            }
            //renvoi un taébleau associatif 'class => style'
            return $tStyle;
        }
        
    }
        
/* *******************************

********************************** */
Function parseCss(&$content)
{   
    // recherche la premiere classe qui commence par un "." 
    $j = strpos($content, ".");
    $cssArr = array();
    
    While (True) {
        //echo "<br>---------------------------------<br>";
        $m = $j;  //stock la position courante pour recupérer le nom de la class plus loin
        $i = strpos($content, "{" , $j); //recherche de la premiere "{"
        If ($i === false) break;         // si pas trouvé c'est la fin du fichier CSS
        $j = strpos($content, "}", $i);  // recherche "}"      
        
        //echo  "i-j-delta : {$i}-{$j}-" . $j-$i;        
        $attributs = substr($content, $i + 1, $j - $i - 1); //extraction des styles de la classe        
        $h = strpos($attributs, "\n");  //recherche un retour à la ligne de debut pour le supprimer si besoin      
        If ($h === 1)  $attributs = substr($attributs, strlen("\n")); //suppression du retour à la ligne de début
        //---------------------------------------------

        // pour controle
        //$temp = str_replace("\n","<br>", $attributs);
        //echo "<br>===>{$temp}<br>";

        //------------------------------------------
        //$cssName = substr($content, $m, $i-$m); //extrait le nom de la classe
        $temp = substr($content, $m, $i-$m); //extrait le nom de la classe
        //$temp = strrev(substr($content, $j, $j-$i));
        $cssName = trim(str_replace(array("}","\n"), "", $temp));
        //echo "temp = {$j}{$j} : |{$cssName}|<br>";

        $cssArr[$cssName] = $attributs; 
      
    }    
    //echoArray($cssArr);
    return $cssArr;
}

    
	public function save_css($cssArr)
    {
//    echoArray($cssArr);
        $t = array();
        $t[] = "/* ***   " . $this->getVar('cat_name') . "   *** */\n\n";
        foreach($cssArr as $cssName=>$attributs)  {
            $t[] = $cssName . "{";
            $t[] = $attributs . "}\n\n";
        
        }
        $content = implode("", $t);
        $cssCatFille = $this->getCssFileName();
        //echo $cssCatFille  . "<br>";
        //echo $content  . "<br>";
        \JJD\FSO\saveTexte2File($cssCatFille, $content, 0777);
    }

}

