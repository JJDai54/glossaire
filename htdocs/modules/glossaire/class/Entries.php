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
 * @author        Jean-Jacques DELALANDRE - Email:<jjdelalandre@orange.fr> - Website:<xoopsfr.kiolo.fr>
 */

use XoopsModules\Glossaire;

\defined('XOOPS_ROOT_PATH') || die('Restricted access');

/**
 * Class Object Entries
 */
class Entries extends \XoopsObject
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
     * @var int
     */
//    public $statusAccess = 0;
    
    /**
     * @var int
     */
     
    public $statusIdSelect = -1;//a verifier si utile

    /**
     * Constructor
     *
     * @param null
     */
    public function __construct()
    {
        $this->initVar('ent_id', \XOBJ_DTYPE_INT);
        $this->initVar('ent_cat_id', \XOBJ_DTYPE_INT);
        $this->initVar('ent_term', \XOBJ_DTYPE_TXTBOX);
        $this->initVar('ent_link', \XOBJ_DTYPE_TXTBOX);
        $this->initVar('ent_shortdef', \XOBJ_DTYPE_TXTBOX);
        $this->initVar('ent_is_acronym', \XOBJ_DTYPE_INT);
        $this->initVar('ent_submitter', \XOBJ_DTYPE_INT);
        $this->initVar('ent_creator', \XOBJ_DTYPE_TXTBOX);
        $this->initVar('ent_initiale', \XOBJ_DTYPE_TXTBOX);
        $this->initVar('ent_image', \XOBJ_DTYPE_TXTBOX);
        $this->initVar('ent_definition', \XOBJ_DTYPE_OTHER);
        $this->initVar('ent_reference', \XOBJ_DTYPE_OTHER);
        $this->initVar('ent_file_name', \XOBJ_DTYPE_TXTBOX);
        $this->initVar('ent_file_path', \XOBJ_DTYPE_TXTBOX);
        $this->initVar('ent_urls', \XOBJ_DTYPE_OTHER);
        $this->initVar('ent_email', \XOBJ_DTYPE_TXTBOX);
        $this->initVar('ent_date_creation', \XOBJ_DTYPE_OTHER);//XOBJ_DTYPE_LTIME
        $this->initVar('ent_date_update', \XOBJ_DTYPE_OTHER);//XOBJ_DTYPE_LTIME
        $this->initVar('ent_counter', \XOBJ_DTYPE_INT);
        $this->initVar('ent_status', \XOBJ_DTYPE_INT);
        $this->initVar('ent_flag', \XOBJ_DTYPE_INT);
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
    public function getNewInsertedIdEntries()
    {
        $newInsertedId = $GLOBALS['xoopsDB']->getInsertId();
        return $newInsertedId;
    }

    /**
     * @public function getForm
     * @param bool $action
     * @return \XoopsThemeForm
     * 
     */
    public function getFormEntries($action = false)
    {//exit("<hr>getFormEntries - statusIdSelect = {$statusIdSelect}<hr>");
        global $categoriesHandler, $clPerms;
        if(!$clPerms->isPermit('approve_entries', $this->getVar('ent_cat_id'))){
            redirect_header(GLOSSAIRE_URL, 3 ,_AM_GLOSSAIRE_NO_PERMISSIONS_SET);
        }

        $glossaireHelper = \XoopsModules\Glossaire\Helper::getInstance();
        if (!$action) {
            $action = $_SERVER['REQUEST_URI'];
        }
        $catIdSelect = $this->getVar('ent_cat_id');
        $categoriesObj = $categoriesHandler->get($catIdSelect);
        $catArray = $categoriesObj->getValuesCategories();
        
        if ($this->isNew()){
            $this->setVar('ent_is_acronym', $categoriesObj->getVar('cat_is_acronym'));
        }
        
        //$isAdmin = ($GLOBALS['xoopsUser']) ? $GLOBALS['xoopsUser']->isAdmin($GLOBALS['xoopsModule']->mid()) : false;
        if($GLOBALS['xoopsUser']){
            if($this->isNew()){
                $entUid = $GLOBALS['xoopsUser']->uid();
                $creator = \XoopsUser::getUnameFromId($entUid);
            }else{
                $creator = $this->getVar('ent_creator');
            }
        }else{
            $isAdmin = false;
            if($this->isNew()){
                    $entUid = 0;
                    $creator = 'Anonyme';
                }else{
                    $creator = $this->getVar('ent_creator');
                }
        }        
                
        // Title
        $title = $this->isNew() ? \sprintf(\_AM_GLOSSAIRE_ENTRY_ADD) : \sprintf(\_AM_GLOSSAIRE_ENTRY_EDIT);
        // Get Theme Form
        \xoops_load('XoopsFormLoader');
        $form = new \XoopsThemeForm($title, 'form', $action, 'post', true);
        $form->setExtra('enctype="multipart/form-data"');

        
        // Form Table categories
        $catList = $categoriesHandler->getList();
          $categoriesHandler = $glossaireHelper->getHandler('Categories');
          $entCat_idSelect = new \XoopsFormSelect(\_AM_GLOSSAIRE_CATEGORY, 'ent_cat_id', $catIdSelect);
          $entCat_idSelect->addOptionArray($catList);
          $form->addElement($entCat_idSelect, true);
        
        // Form Select User entUid
        //en cas d'import d'une autre base le uid n'a pas de sens
        //$entUid = $this->isNew() ? $GLOBALS['xoopsUser']->ent_submitter() : $this->getVar('ent_submitter');
        //$form->addElement(new \XoopsFormSelectUser(\_AM_GLOSSAIRE_ENTRY_UID, 'ent_submitter', false, $entUid));
        // Form Text entTerm
        $libelle = \_AM_GLOSSAIRE_ENTRY_TERM . (($catArray['show_bin'][GLOSSAIRE_ENT_ID]) ? " - [#{$this->getVar('ent_id')}]": '');
        $form->addElement(new \XoopsFormText($libelle, 'ent_term', 50, 255, $this->getVar('ent_term')), true);
        // Form Text entShortdef
        //---------------------------------------------------------------------     

        if($catArray['show_bin'][GLOSSAIRE_ENT_LINK]){
            $form->addElement(new \XoopsFormText(\_AM_GLOSSAIRE_ENT_LINK , 'ent_link', 150, 255, $this->getVar('ent_link')), false);
        }
        // Form Text entShortdef
        //---------------------------------------------------------------------     
        if($catArray['show_bin'][GLOSSAIRE_ENT_CREATOR]){
            if($this->isNew()){
                $entUid = $GLOBALS['xoopsUser']->uid();
                $creator = \XoopsUser::getUnameFromId($entUid);
            }else{
                $creator = $this->getVar('ent_creator');
            }
            //$form->addElement(new \XoopsFormLabel(\_AM_GLOSSAIRE_CREATOR, $creator));
            //$form->addElement(new \XoopsFormHidden('ent_creator', $creator));   
            $form->addElement(new \XoopsFormText(\_AM_GLOSSAIRE_CREATOR, 'ent_creator', 50, 50, $creator), false);
        }
        //---------------------------------------------------------------------     
        //echoArray($catArray['show_bin'],"shortdef = " . GLOSSAIRE_ENT_SHORTDEF);
        if($catArray['show_bin'][GLOSSAIRE_ENT_SHORTDEF]){
            $form->addElement(new \XoopsFormText(\_AM_GLOSSAIRE_ENTRY_SHORTDEF, 'ent_shortdef', 120, 255, $this->getVar('ent_shortdef')));
        
            // Form Text ent_is_acronym
            if($catArray['show_bin'][GLOSSAIRE_ENT_SHORTDEF]){ 
                $inpMagnifySd = new \XoopsFormRadioYN(\_AM_GLOSSAIRE_ENTRY_MAGNIFY_SD, 'ent_is_acronym', $this->getVar('ent_is_acronym'));
                $inpMagnifySd->setDescription(\_AM_GLOSSAIRE_ENTRY_MAGNIFY_SD_DESC);
                $form->addElement($inpMagnifySd);
            }
        }

        //-------------------------------------------------
        if($catArray['show_bin'][GLOSSAIRE_ENT_IMAGE]){
            $entImage = $this->isNew() ? '' : $this->getVar('ent_image');
            $form->addElement(new \XoopsFormHidden('ent_image', $entImage));        
     
            $urlImg = $categoriesObj->getPathUploads('images', true) . '/' . $entImage;
            $isImgOk = (is_readable($categoriesObj->getPathUploads('images', false) . '/' . $entImage) AND $entImage!='');
            $currentImg = new \XoopsFormLabel('', "<br><img src='{$urlImg}'  name='image_img2' id='image_img2' alt='' style='max-width:100px'>");
            
    //         if (!is_null() && $fulName!=='' && is_readable($fulName)) {
    //           $urlImg = XOOPS_URL . "/modules/slider/assets/images/slide-temp-01.png";
    //         }else{
    //           $urlImg = SLIDER_UPLOAD_IMAGE_URL . "/slides/" . $slideImg;
    //         }
            // Form File: Upload entImage
            $imgUploadTray = new \XoopsFormElementTray(\_AM_GLOSSAIRE_ENTRY_IMAGE, '<br>');
            $permissionUpload = true;
            if ($permissionUpload) {
                $fileDirectory = '/uploads/glossaire/files/entries';
                if ($isImgOk) {
                    $imgUploadTray->addElement(new \XoopsFormLabel(\sprintf(\_AM_GLOSSAIRE_ENTRY_IMAGE_UPLOADS, ".{$fileDirectory}/"), $entImage));
                    $inpDeleteImg = new \XoopsFormCheckBox('', 'ent_delete_img', "",'<br>');
                    $inpDeleteImg->addOption(1, _AM_GLOSSAIRE_DELETE_IMG);
                    $imgUploadTray->addElement($inpDeleteImg);
                    
                }
                $maxsize = $glossaireHelper->getConfig('maxsize_file');
                $imgUploadTray->addElement(new \XoopsFormFile('', 'ent_image', $maxsize));
                $imgUploadTray->addElement(new \XoopsFormLabel(\_AM_GLOSSAIRE_FORM_UPLOAD_SIZE, ($maxsize / 1048576) . ' '  . \_AM_GLOSSAIRE_FORM_UPLOAD_SIZE_MB));
                //$form->addElement($imgUploadTray);
    
            } else {
    
            }
            $upload_size = $glossaireHelper->getConfig('maxsize_image');
            $imageTray  = new \XoopsFormElementTray(_AM_GLOSSAIRE_ENTRY_IMAGE,"<br>"); 
            $imageTray->addElement($currentImg, false);
            $imageTray->setDescription(_AM_GLOSSAIRE_ENTRY_IMG_DESC . '<br>' . sprintf(_AM_GLOSSAIRE_FILE_UPLOADSIZE, $upload_size / 1024), '<br>');
            $imageTray->addElement($imgUploadTray, false);
            $form->addElement($imageTray);
        }
        //-------------------------------------------------
        if($catArray['show_bin'][GLOSSAIRE_ENT_DEFINITION]){
            
            // Form Editor DhtmlTextArea entDefinition
            if ($isAdmin) {
                $editor = $glossaireHelper->getConfig('editor_admin');
            } else {
                $editor = $glossaireHelper->getConfig('editor_user');
            }
            
            $editorConfigs1 = [];
            $editorConfigs1['name'] = 'ent_definition';
            $editorConfigs1['value'] = $this->getVar('ent_definition', 'e');
            $editorConfigs1['rows'] = 10;
            $editorConfigs1['cols'] = 40;
            $editorConfigs1['width'] = '100%';
            $editorConfigs1['height'] = '400px';
            $editorConfigs1['editor'] = $editor;
            $inpDefinition = new \XoopsFormEditor(\_AM_GLOSSAIRE_ENTRY_DEFINITION, 'ent_definition', $editorConfigs1);
            //$inpDefinition->setDescription(_AM_GLOSSAIRE_ENTRY_DEFINITION_DESC);
            $form->addElement($inpDefinition);
        }
        
        
        if($catArray['show_bin'][GLOSSAIRE_ENT_REFERENCE]){
            // Form Editor DhtmlTextArea entReference
            $editorConfigs2 = [];
            $editorConfigs2['name'] = 'ent_reference';
            $editorConfigs2['value'] = $this->getVar('ent_reference', 'e');
            $editorConfigs2['rows'] = 5;
            $editorConfigs2['cols'] = 40;
            $editorConfigs2['width'] = '100%';
            $editorConfigs2['height'] = '200px';
            $editorConfigs2['editor'] = $editor;
            $inpReference = new \XoopsFormEditor(\_AM_GLOSSAIRE_ENTRY_REFERENCES, 'ent_reference', $editorConfigs2);
            $inpReference->setDescription(_AM_GLOSSAIRE_ENTRY_REFERENCES_DESC);
            $form->addElement($inpReference);
        }

        //-------------------------------------------------
        // Form Text ent_file
        if($catArray['show_bin'][GLOSSAIRE_ENT_FILE_NAME]){
            $entFileName = $this->isNew() ? '' : $this->getVar('ent_file_name');
            $entFilePath = $this->isNew() ? '' : $this->getVar('ent_file_path');
            $form->addElement(new \XoopsFormHidden('ent_file_name', $entFileName));        
            $form->addElement(new \XoopsFormHidden('ent_file_path', $entFilePath));        
     
            $isFileOk = (is_readable($categoriesObj->getPathUploads('files', false) . '/' . $entFilePath) AND $entFilePath != '');
            //$form->addElement(new \XoopsFormText(\_AM_GLOSSAIRE_FILE_NAME, 'ent_file_name', 50, 50, $this->getVar('ent_file_name')), false);
            //-------------------------------------------------
            if ($isFileOk) {
                $currentFileTray = new \XoopsFormElementTray(\_AM_GLOSSAIRE_ENTRY_CURRENT_FILE, '<br>');
                
                $currentFile = new \XoopsFormLabel('', sprintf("%s ===> <span style='color:blue;'>%s</span><br>", $entFileName, $entFilePath));
                $currentFileTray->addElement($currentFile);
                
                //$imgUploadTray->addElement(new \XoopsFormLabel(\sprintf(\_AM_GLOSSAIRE_ENTRY_IMAGE_UPLOADS, ".{$fileDirectory}/"), $entImage));
                $inpDeleteFile = new \XoopsFormCheckBox('', 'ent_delete_file', "",'<br>');            
                $inpDeleteFile->addOption(1, _AM_GLOSSAIRE_DELETE_FILE);
                $currentFileTray->addElement($inpDeleteFile);
                
                $form->addElement($currentFileTray);
            }
        
            // Form File: Upload 
            $maxsize = $glossaireHelper->getConfig('maxsize_file');
            $fileUploadTray = new \XoopsFormElementTray(\_AM_GLOSSAIRE_ENTRY_FILE, '<br>');
            $permissionUpload = true;
            if ($permissionUpload) {
            
                //$fileDirectory = '/uploads/glossaire/files/entries';
                //$maxsize = $glossaireHelper->getConfig('maxsize_file');
                $fileUploadTray->addElement(new \XoopsFormFile('', 'ent_file_name', $maxsize));
                $fileUploadTray->addElement(new \XoopsFormLabel(\_AM_GLOSSAIRE_FORM_UPLOAD_SIZE, ($maxsize / 1048576) . ' '  . \_AM_GLOSSAIRE_FORM_UPLOAD_SIZE_MB));
            $fileUploadTray->setDescription(_AM_GLOSSAIRE_ENTRY_IMG_DESC2 . '<br>' . sprintf(_AM_GLOSSAIRE_FILE_UPLOADSIZE, $maxsize / 1024), '<br>');
            $form->addElement($fileUploadTray);
            } 
        }
        //-------------------------------------------------
        // Form Text ent_urls
        if($catArray['show_bin'][GLOSSAIRE_ENT_URLS]){
            $inpUrls = new \XoopsFormTextArea(_AM_GLOSSAIRE_ENTRY_URLS, 'ent_urls', $this->getVar('ent_urls'), 3, 120);  
            $inpUrls->setDescription(_AM_GLOSSAIRE_ENTRY_URLS_DESC); 
            $form->addElement($inpUrls);
        }

        
        // Form Text ent_email
        if($catArray['show_bin'][GLOSSAIRE_ENT_EMAIL]){
            $inpEmail = new \XoopsFormText(\_AM_GLOSSAIRE_ENTRY_EMAIL, 'ent_email', 50, 80, $this->getVar('ent_email'));
            $inpEmail->setDescription(_AM_GLOSSAIRE_ENTRY_EMAIL_DESC); 
            $form->addElement($inpEmail);
        }
        
        // Form Text entCounter
        //$form->addElement(new \XoopsFormText(\_AM_GLOSSAIRE_ENTRY_COUNTER, 'ent_counter', 50, 255, $this->getVar('ent_counter')));
        if($catArray['show_bin'][GLOSSAIRE_ENT_COUNTER]){
            $form->addElement(new \XoopsFormHidden(\_AM_GLOSSAIRE_ENTRY_COUNTER, $this->getVar('ent_counter')));
        }
                  
        // Entries Handler
        $entriesHandler = $glossaireHelper->getHandler('Entries');

        $arrStatus = array(GLOSSAIRE_STATUS_INACTIF  => _AM_GLOSSAIRE_CATEGORY_STATUS_INATIF,
                           GLOSSAIRE_PROPOSITION     => _AM_GLOSSAIRE_CATEGORY_STATUS_PROPOSITION,
                           GLOSSAIRE_STATUS_APPROVED => _AM_GLOSSAIRE_CATEGORY_STATUS_APPROVED);        
        // Form Select entStatus
        $entStatusSelect = new \XoopsFormRadio(\_AM_GLOSSAIRE_ENTRY_STATUS, 'ent_status', $this->getVar('ent_status'));
        $entStatusSelect->addOptionArray($arrStatus);
        $form->addElement($entStatusSelect);

        // To Save
        $form->addElement(new \XoopsFormHidden('op', 'save'));
        $form->addElement(new \XoopsFormHidden('start', $this->start));
        $form->addElement(new \XoopsFormHidden('limit', $this->limit));
        //$form->addElement(new \XoopsFormButtonTray('', \_SUBMIT, 'submit', '', false));

        $btnTray = new \XoopsFormElementTray  ('', '&nbsp;');
        $btnTray->addElement(new \XoopsFormButtonTray('', _SUBMIT, 'submit', '', false));
        $btnAddNew = new \XoopsFormButton('', 'submit_and_addnew', _AM_GLOSSAIRE_SUBMIT_AND_ADDNEW,'submit');
        $btnAddNew->setClass('btn btn-success');
        $btnTray->addElement($btnAddNew);
		$form->addElement($btnTray);
        
        
        $form->addElement(new \XoopsFormHidden('catIdSelect', $catIdSelect));
        $form->addElement(new \XoopsFormHidden('statusIdSelect', $this->statusIdSelect));
        return $form;
        
    }

    /**
     * @public function getForm
     * @param bool $action
     * @return \XoopsThemeForm
     * 
     * C'est forc�ment une nouvel entr�e donc pas besoin de teste $this->isNew()
     * isAdmin est faux �galement
     */
    public function getFormEntriesLight($action = false)
    {//exit("<hr>getFormEntries - statusIdSelect = {$statusIdSelect}<hr>");
        global $categoriesHandler;

        $glossaireHelper = \XoopsModules\Glossaire\Helper::getInstance();
        if (!$action) {
            $action = $_SERVER['REQUEST_URI'];
        }
        $catIdSelect = $this->getVar('ent_cat_id');
        $categoriesObj = $categoriesHandler->get($catIdSelect);

        $this->setVar('ent_is_acronym', $categoriesObj->getVar('cat_is_acronym'));
        
        $isAdmin = false;
        if($GLOBALS['xoopsUser']){
            $entUid = $GLOBALS['xoopsUser']->uid();
            $creator = \XoopsUser::getUnameFromId($entUid);
        }else{
            $creator = '';
        }        
                
        // Title
        $title = $this->isNew() ? \sprintf(\_MA_GLOSSAIRE_SUBMIT) : \sprintf(\_AM_GLOSSAIRE_ENTRY_EDIT);
        // Get Theme Form
        \xoops_load('XoopsFormLoader');
        $form = new \XoopsThemeForm($title, 'form', $action, 'post', true);
        $form->setExtra('enctype="multipart/form-data"');

        
        // Form Table categories
        $catList = $categoriesHandler->getList();

        $form->addElement(new \XoopsFormLabel(\_AM_GLOSSAIRE_CATEGORY, $catList[$catIdSelect]));
        $form->addElement(new \XoopsFormHidden('ent_cat_id', $catIdSelect));   
        
        if($creator != ''){
          $form->addElement(new \XoopsFormLabel(\_AM_GLOSSAIRE_CREATOR, $creator));
          $form->addElement(new \XoopsFormHidden('ent_creator', $creator));   
        }else{
            $form->addElement(new \XoopsFormText(\_AM_GLOSSAIRE_CREATOR, 'ent_creator', 50, 50, ''), true);
        }
        
        // Form Text entTerm
        $form->addElement(new \XoopsFormText(\_AM_GLOSSAIRE_ENTRY_TERM, 'ent_term', 50, 255, $this->getVar('ent_term')), true);
        // Form Text entShortdef
        $form->addElement(new \XoopsFormText(\_AM_GLOSSAIRE_ENTRY_SHORTDEF, 'ent_shortdef', 120, 255, $this->getVar('ent_shortdef')));
        
        // Form Text ent_is_acronym
        $form->addElement(new \XoopsFormHidden('ent_is_acronym', 0));   
        
        //-------------------------------------------------
        $entImage = '';
        $form->addElement(new \XoopsFormHidden('ent_image', $entImage));        
        
        // Form File: Upload entImage
        $maxsize = $glossaireHelper->getConfig('maxsize_image');
        $imgUploadTray = new \XoopsFormElementTray(\_AM_GLOSSAIRE_ENTRY_IMAGE, '<br>');
        $permissionUpload = true;
        if ($permissionUpload) {
            $fileDirectory = '/uploads/glossaire/files/entries';
            //$maxsize = $glossaireHelper->getConfig('maxsize_file');
            $imgUploadTray->addElement(new \XoopsFormFile('', 'ent_image', $maxsize));
            $imgUploadTray->addElement(new \XoopsFormLabel(\_AM_GLOSSAIRE_FORM_UPLOAD_SIZE, ($maxsize / 1048576) . ' '  . \_AM_GLOSSAIRE_FORM_UPLOAD_SIZE_MB));
        $imgUploadTray->setDescription(_AM_GLOSSAIRE_ENTRY_IMG_DESC2 . '<br>' . sprintf(_AM_GLOSSAIRE_FILE_UPLOADSIZE, $maxsize / 1024), '<br>');
        $form->addElement($imgUploadTray);
        } 
        //-------------------------------------------------
            
        // Form Editor DhtmlTextArea entDefinition
        $editorConfigs = [];
        $editor = $glossaireHelper->getConfig('editor_user');
        $editorConfigs['name'] = 'ent_definition';
        $editorConfigs['value'] = $this->getVar('ent_definition', 'e');
        $editorConfigs['rows'] = 5;
        $editorConfigs['cols'] = 40;
        $editorConfigs['width'] = '100%';
        $editorConfigs['height'] = '400px';
        $editorConfigs['editor'] = $editor;
        $form->addElement(new \XoopsFormEditor(\_AM_GLOSSAIRE_ENTRY_DEFINITION, 'ent_definition', $editorConfigs));
        
        // Form Editor DhtmlTextArea entReference
        $editorConfigs = [];
        $editor = $glossaireHelper->getConfig('editor_user');
        $editorConfigs['name'] = 'ent_reference';
        $editorConfigs['value'] = $this->getVar('ent_reference', 'e');
        $editorConfigs['rows'] = 5;
        $editorConfigs['cols'] = 40;
        $editorConfigs['width'] = '100%';
        $editorConfigs['height'] = '400px';
        $editorConfigs['editor'] = $editor;
        $inpReference = new \XoopsFormEditor(\_AM_GLOSSAIRE_ENTRY_REFERENCES, 'ent_reference', $editorConfigs);
        $inpReference->setDescription(_AM_GLOSSAIRE_ENTRY_REFERENCES_DESC);
        $form->addElement($inpReference);

        // Form Text ent_urls
        $inpUrls = new \XoopsFormTextArea(_AM_GLOSSAIRE_ENTRY_URLS, 'ent_urls', $this->getVar('ent_urls'), 3, 120);  
        $inpUrls->setDescription(_AM_GLOSSAIRE_ENTRY_URLS_DESC); 
        $form->addElement($inpUrls);
        
        // Form Text ent_email
        $inpEmail = new \XoopsFormText(\_AM_GLOSSAIRE_ENTRY_EMAIL, 'ent_email', 50, 80, $this->getVar('ent_email'));
        $inpEmail->setDescription(_AM_GLOSSAIRE_ENTRY_EMAIL_DESC); 
        $form->addElement($inpEmail);
        
        // Form Text entCounter
        //$form->addElement(new \XoopsFormText(\_AM_GLOSSAIRE_ENTRY_COUNTER, 'ent_counter', 50, 255, $this->getVar('ent_counter')));
        $form->addElement(new \XoopsFormHidden(\_AM_GLOSSAIRE_ENTRY_COUNTER, $this->getVar('ent_counter')));
                  
        // Form Select entStatus
        $form->addElement(new \XoopsFormHidden('ent_status', GLOSSAIRE_PROPOSITION));   

        // To Save
        $form->addElement(new \XoopsFormHidden('op', 'save'));
        $form->addElement(new \XoopsFormHidden('start', $this->start));
        $form->addElement(new \XoopsFormHidden('limit', $this->limit));
        $form->addElement(new \XoopsFormButtonTray('', \_SUBMIT, 'submit', '', false));
        $form->addElement(new \XoopsFormHidden('catIdSelect', $this->catIdSelect));
        $form->addElement(new \XoopsFormHidden('statusIdSelect', $this->statusIdSelect));
        return $form;
        
    }

    /**
     * Get Values
     * @param null $keys
     * @param null $format
     * @param null $maxDepth
     * @return array
     */
    public function getValuesEntries($keys = null, $format = null, $maxDepth = null, &$categoriesObj = null)
    {global $categoriesHandler;
        $glossaireHelper  = \XoopsModules\Glossaire\Helper::getInstance();
        //$categoriesHandler = $glossaireHelper->getHandler('Categories');
//        if (is_null($categoriesHandler)) echo "categoriesHandler est null"; else echo 'bin non';
        
        if(!$categoriesObj) $categoriesObj = $categoriesHandler->get($this->getVar('ent_cat_id'));
        $catArray = $categoriesObj->getValuesCategories();
        //if($catArray['show_bin'][GLOSSAIRE_ENT_ADD_LINK_IN_URLS]){

        //----------------------------------------------------
        $utility = new \XoopsModules\Glossaire\Utility();
        $ret = $this->getValues($keys, $format, $maxDepth);
        $ret['id']               = $this->getVar('ent_id');
        $ret['cat_id']           = $this->getVar('ent_cat_id');
        $ret['cat_name']         = $categoriesObj->getVar('cat_name');
        $ret['submitter']        = \XoopsUser::getUnameFromId($this->getVar('ent_submitter'));
        $ret['creator']          = $this->getVar('ent_creator');
        $ret['term']             = $this->getVar('ent_term');
        $ret['link']             = $this->getVar('ent_link');
        $ret['initiale']         = $this->getVar('ent_initiale');
        $ret['shortdef']         = $this->getVar('ent_shortdef');
        $ret['is_acronym']       = $this->getVar('ent_is_acronym');
        $ret['shortdefMagnifed'] = ($ret['is_acronym']) ? $utility->get_acronym($ret['shortdef']) : $ret['shortdef'];
        $ret['definition']       = $this->getVar('ent_definition', 'e');
        $editorMaxchar = $glossaireHelper->getConfig('editor_maxchar');
        $ret['definition_trunq'] = $utility::truncateHtml($ret['definition'], $editorMaxchar);
        $ret['image']            = $this->getVar('ent_image');
        
        $imgPath =  $categoriesObj->getPathUploads('images', false);
        $imgUrl  =  $categoriesObj->getPathUploads('images', true);
        if ($ret['image'] !== '' && is_readable($imgPath . '/' . $this->getVar('ent_image'))){
          $ret['image_url']        =  $imgUrl . '/' . $this->getVar('ent_image');
          //definition_img contient l'image et la d�finition prete a l'emloi dans le form
          $ret['definition_img'] = "<div class='highslide-gallery'>"
            . "<a href='{$ret['image_url']}' class='highslide' onclick='return hs.expand(this);' >"
            . "<img src='{$ret['image_url']}' class='img_glossaire' alt='' style='max-width:100px' />"
            . "</a>"
            . "<div class='highslide-heading'></div>"
            . "</div>"
            . $ret['definition'];
               
          $ret['image_ok'] = 1;
        }else{
          $ret['image_url']      = '';
          $ret['definition_img'] = $ret['definition'];
          $ret['image_ok'] = 0;
        }
        
        $ret['reference']        = $this->getVar('ent_reference', 'e');
        $ret['reference_short']  = $utility::truncateHtml($ret['reference'], $editorMaxchar);
        $ret['file_name']        = $this->getVar('ent_file_name', 'e');
        $ret['file_path']        = $this->getVar('ent_file_path', 'e');
        $ret['file_ok'] = (is_readable($categoriesObj->getPathUploads('files', false) . '/' . $ret['file_path']));
        if($ret['file_ok']){
            $link = "<a href='%s/%s' title=''>%s</a>";
            $ret['file_link']    = sprintf($link, $categoriesObj->getPathUploads('files', true), $ret['file_path'], $ret['file_name']);
        }else{
            $ret['file_link']    = $ret['file_name'];
        }

        //todo
        //$ret['file_name_1_fullname']        = $this->getVar('ent_file_name_1', 'e');
//echoArray($catArray);       
        $urls = $this->getVar('ent_urls');
        if ($ret['link'] && $catArray['show_bin'][GLOSSAIRE_ENT_ADD_LINK_IN_URLS]) $urls = "{$ret['term'] }|{$ret['link']}\n{$urls}";
        
        if($urls){
            $ret['urls'] = $utility::build_urls($urls);
        }else{
            $ret['urls'] = '';
        }

        if($this->getVar('ent_email')){
            if($categoriesObj->getVar('cat_replace_arobase')){
                $email = str_replace('@', $categoriesObj->getVar('cat_replace_arobase'), $this->getVar('ent_email'));         
                $ret['email']         = sprintf("<a href='mailto:%s'>{$email}</a>", $email);
            }else{
                $ret['email']         = sprintf("<a href='mailto:%s'>{$this->getVar('ent_email')}</a>", $this->getVar('ent_email'));
            }
        }else{
                $ret['email']         = '';
        }          
        
		$ret['date_creation']          = \JANUS\getDateSql2Str($this->getVar('ent_date_creation'), $categoriesObj->getVar('cat_date_format'));
		$ret['date_update']            = \JANUS\getDateSql2Str($this->getVar('ent_date_update'), $categoriesObj->getVar('cat_date_format'));
        
        $ret['counter']          = $this->getVar('ent_counter');
        $ret['status']           = $this->getVar('ent_status');
        $ret['flag']             = $this->getVar('ent_flag');
        
        
        return $ret;
    }

    /**
     * Returns an array representation of the object
     *
     * @return array
     */
    public function toArrayEntries()
    {
        $ret = [];
        $vars = $this->getVars();
        foreach (\array_keys($vars) as $var) {
            $ret[$var] = $this->getVar('"{$var}"');
        }
        return $ret;
    }

/**
 * delete_img
 * 
 * return bool
 * */
function delete_image($catImgFolder){

    $entImage = $this->getVar('ent_image');
    //$f = GLOSSAIRE_UPLOAD_IMG_FOLDER_PATH . "/{$catImgFolder}/{$entImage}")  
    $fImg = $catImgFolder . $entImage;  
    $isImgOk = (is_readable($fImg) AND $entImage != '');
    if ($isImgOk) unlink($fImg);
    $this->setVar('ent_image', '');
//exit ($fImg);
}
function delete_file($catFileFolder){

    $entFilePath = $this->getVar('ent_file_path');
    //$f = GLOSSAIRE_UPLOAD_IMG_FOLDER_PATH . "/{$catImgFolder}/{$entImage}")  
    $fFilePath = $catFileFolder . $entFilePath;  
    $isFileOk = (is_readable($fFilePath) AND $fFilePath != '');
    if ($isFileOk) unlink($fFilePath);
    $this->setVar('ent_file_name', '');
    $this->setVar('ent_file_path', '');
    
//exit ($fImg);
}

} // ----- FIN DE LA CLASSE -----
