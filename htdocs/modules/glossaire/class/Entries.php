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
 * @author         XOOPS Development Team - Email:<jjdelalandre@orange.fr> - Website:<jubile.fr>
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
//        $this->initVar('ent_uid', \XOBJ_DTYPE_INT);
        $this->initVar('ent_creator', \XOBJ_DTYPE_TXTBOX);
        $this->initVar('ent_term', \XOBJ_DTYPE_TXTBOX);
        $this->initVar('ent_initiale', \XOBJ_DTYPE_TXTBOX);
        $this->initVar('ent_shortdef', \XOBJ_DTYPE_TXTBOX);
        $this->initVar('ent_is_acronym', \XOBJ_DTYPE_INT);
        $this->initVar('ent_image', \XOBJ_DTYPE_TXTBOX);
        $this->initVar('ent_definition', \XOBJ_DTYPE_OTHER);
        $this->initVar('ent_reference', \XOBJ_DTYPE_OTHER);
        $this->initVar('ent_urls', \XOBJ_DTYPE_OTHER);
//         $this->initVar('ent_url1', \XOBJ_DTYPE_TXTBOX);
//         $this->initVar('ent_url2', \XOBJ_DTYPE_TXTBOX);
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
     */
    public function getFormEntries($action = false, $isProposition = false)
    {//exit("<hr>getFormEntries - statusIdSelect = {$statusIdSelect}<hr>");
        global $categoriesHandler;

        
        $helper = \XoopsModules\Glossaire\Helper::getInstance();
        if (!$action) {
            $action = $_SERVER['REQUEST_URI'];
        }
        $catIdSelect = $this->getVar('ent_cat_id');
        $categoriesObj = $categoriesHandler->get($catIdSelect);

        if ($this->isNew()){
            $this->setVar('ent_is_acronym', $categoriesObj->getVar('cat_is_acronym'));
        }
        
        $isAdmin = $GLOBALS['xoopsUser']->isAdmin($GLOBALS['xoopsModule']->mid());
        // Title
        $title = $this->isNew() ? \sprintf(\_AM_GLOSSAIRE_ENTRY_ADD) : \sprintf(\_AM_GLOSSAIRE_ENTRY_EDIT);
        // Get Theme Form
        \xoops_load('XoopsFormLoader');
        $form = new \XoopsThemeForm($title, 'form', $action, 'post', true);
        $form->setExtra('enctype="multipart/form-data"');
        
        // Form Table categories
        $catList = $categoriesHandler->getList();
        if($isProposition){
          $form->addElement(new \XoopsFormLabel(\_AM_GLOSSAIRE_CATEGORY, $catList[$catIdSelect]));
          $form->addElement(new \XoopsFormHidden('ent_cat_id', $catIdSelect));   
        
        }else{
          $categoriesHandler = $helper->getHandler('Categories');
          $entCat_idSelect = new \XoopsFormSelect(\_AM_GLOSSAIRE_CATEGORY, 'ent_cat_id', $catIdSelect);
          $entCat_idSelect->addOptionArray($catList);
          $form->addElement($entCat_idSelect, true);
        }
        
        // Form Select User entUid
        //en cas d'import d'une autre base le uid n'a pas de sens
        //$entUid = $this->isNew() ? $GLOBALS['xoopsUser']->uid() : $this->getVar('ent_uid');
        //$form->addElement(new \XoopsFormSelectUser(\_AM_GLOSSAIRE_ENTRY_UID, 'ent_uid', false, $entUid));
        if($this->isNew()){
            $entUid = $GLOBALS['xoopsUser']->uid();
            $creator = \XoopsUser::getUnameFromId($entUid);
        }else{
            $creator = $this->getVar('ent_creator');
        }
        $form->addElement(new \XoopsFormLabel(\_AM_GLOSSAIRE_CREATOR, $creator));
        $form->addElement(new \XoopsFormHidden('ent_creator', $creator));   
             
        // Form Text entTerm
        $form->addElement(new \XoopsFormText(\_AM_GLOSSAIRE_ENTRY_TERM, 'ent_term', 50, 255, $this->getVar('ent_term')), true);
        // Form Text entShortdef
        $form->addElement(new \XoopsFormText(\_AM_GLOSSAIRE_ENTRY_SHORTDEF, 'ent_shortdef', 120, 255, $this->getVar('ent_shortdef')));
        
        // Form Text ent_is_acronym
        if($isProposition){
          $form->addElement(new \XoopsFormHidden('ent_is_acronym', 0));   
        }else{
          $inpMagnifySd = new \XoopsFormRadioYN(\_AM_GLOSSAIRE_ENTRY_MAGNIFY_SD, 'ent_is_acronym', $this->getVar('ent_is_acronym'));
          $inpMagnifySd->setDescription(\_AM_GLOSSAIRE_ENTRY_MAGNIFY_SD_DESC);
          $form->addElement($inpMagnifySd);
        }
        
        //-------------------------------------------------
        $entImage = $this->isNew() ? '' : $this->getVar('ent_image');
        $imgFile = '/' . $categoriesObj->getVar('cat_img_folder') . '/' . $entImage; 
        $urlImg = GLOSSAIRE_UPLOAD_IMG_FOLDER_URL . $imgFile;
        $isImgOk = (is_readable(GLOSSAIRE_UPLOAD_IMG_FOLDER_PATH . $imgFile) AND $entImage!='');
        $currentImg = new \XoopsFormLabel('', "<br><img src='{$urlImg}'  name='image_img2' id='image_img2' alt='' style='max-width:100px'>");
        
//         if (!is_null() && $fulName!=='' && is_readable($fulName)) {
//           $urlImg = XOOPS_URL . "/modules/slider/assets/images/slide-temp-01.png";
//         }else{
//           $urlImg = SLIDER_UPLOAD_IMAGE_URL . "/slides/" . $slideImg;
//         }
        // Form File: Upload entImage
        $fileUploadTray = new \XoopsFormElementTray(\_AM_GLOSSAIRE_ENTRY_IMAGE, '<br>');
        $permissionUpload = true;
        if ($permissionUpload) {
            $fileDirectory = '/uploads/glossaire/files/entries';
            if ($isImgOk) {
                $fileUploadTray->addElement(new \XoopsFormLabel(\sprintf(\_AM_GLOSSAIRE_ENTRY_IMAGE_UPLOADS, ".{$fileDirectory}/"), $entImage));
                $inpDeleteImg = new \XoopsFormCheckBox('', 'ent_delete_img', "",'<br>');
                $inpDeleteImg->addOption(1, _AM_GLOSSAIRE_DELETE_IMG);
                $fileUploadTray->addElement($inpDeleteImg);
                
            }
            $maxsize = $helper->getConfig('maxsize_file');
            $fileUploadTray->addElement(new \XoopsFormFile('', 'ent_image', $maxsize));
            $fileUploadTray->addElement(new \XoopsFormLabel(\_AM_GLOSSAIRE_FORM_UPLOAD_SIZE, ($maxsize / 1048576) . ' '  . \_AM_GLOSSAIRE_FORM_UPLOAD_SIZE_MB));
            //$form->addElement($fileUploadTray);

        } else {
            $fileUploadTray->addElement(new \XoopsFormHidden('ent_image', $entImage));
        }
        
        $upload_size = $helper->getConfig('maxsize_image');
        $imageTray  = new \XoopsFormElementTray(_AM_GLOSSAIRE_ENTRY_IMAGE,"<br>"); 
        $imageTray->addElement($currentImg, false);
        $imageTray->setDescription(_AM_GLOSSAIRE_ENTRY_IMG_DESC . '<br>' . sprintf(_AM_GLOSSAIRE_FILE_UPLOADSIZE, $upload_size / 1024), '<br>');
        $imageTray->addElement($fileUploadTray, false);
        $form->addElement($imageTray);
        //-------------------------------------------------
            
        // Form Editor DhtmlTextArea entDefinition
        $editorConfigs = [];
        if ($isAdmin) {
            $editor = $helper->getConfig('editor_admin');
        } else {
            $editor = $helper->getConfig('editor_user');
        }
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
        if ($isAdmin) {
            $editor = $helper->getConfig('editor_admin');
        } else {
            $editor = $helper->getConfig('editor_user');
        }
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
/*
        // Form Text entUrl1
        $form->addElement(new \XoopsFormText(\_AM_GLOSSAIRE_ENTRY_URL1, 'ent_url1', 50, 255, $this->getVar('ent_url1')));
        // Form Text entUrl2
        $form->addElement(new \XoopsFormText(\_AM_GLOSSAIRE_ENTRY_URL2, 'ent_url2', 50, 255, $this->getVar('ent_url2')));
*/       
        
        
//         // Form Text Date Select entDate_creation
//         $entDate_creation = $this->isNew() ? \time() : $this->getVar('ent_date_creation');
//         $form->addElement(new \XoopsFormTextDateSelect(\_AM_GLOSSAIRE_ENTRY_DATE_CREATION, 'ent_date_creation', '', $entDate_creation));
//         // Form Text Date Select entDate_update
//         $entDate_update = $this->isNew() ? \time() : $this->getVar('ent_date_update');
//         $form->addElement(new \XoopsFormTextDateSelect(\_AM_GLOSSAIRE_ENTRY_DATE_UPDATE, 'ent_date_update', '', $entDate_update));
        
        
        // Form Text entCounter
        //$form->addElement(new \XoopsFormText(\_AM_GLOSSAIRE_ENTRY_COUNTER, 'ent_counter', 50, 255, $this->getVar('ent_counter')));
        $form->addElement(new \XoopsFormHidden(\_AM_GLOSSAIRE_ENTRY_COUNTER, $this->getVar('ent_counter')));
                  
        // Entries Handler
        $entriesHandler = $helper->getHandler('Entries');

        $arrStatus = array(GLOSSAIRE_STATUS_INACTIF  => _AM_GLOSSAIRE_CATEGORY_STATUS_INATIF,
                           GLOSSAIRE_PROPOSITION     => _AM_GLOSSAIRE_CATEGORY_STATUS_PROPOSITION,
                           GLOSSAIRE_STATUS_APPROVED => _AM_GLOSSAIRE_CATEGORY_STATUS_APPROVED);        
        // Form Select entStatus
        if($isProposition){
          //pas utile d'afficher le status
          //$form->addElement(new \XoopsFormLabel(\_AM_GLOSSAIRE_ENTRY_STATUS, _AM_GLOSSAIRE_CATEGORY_STATUS_PROPOSITION));
          $form->addElement(new \XoopsFormHidden('ent_status', $arrStatus[$this->getVar('ent_status')]));   
        }else{
          $entStatusSelect = new \XoopsFormRadio(\_AM_GLOSSAIRE_ENTRY_STATUS, 'ent_status', $this->getVar('ent_status'));
          $entStatusSelect->addOptionArray($arrStatus);
          $form->addElement($entStatusSelect);
        }

        // Form Text entFlag
        //$form->addElement(new \XoopsFormText(\_AM_GLOSSAIRE_ENTRY_FLAG, 'ent_flag', 50, 255, $this->getVar('ent_flag')));
        
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
    public function getValuesEntries($keys = null, $format = null, $maxDepth = null)
    {global $categoriesHandler;
        $helper  = \XoopsModules\Glossaire\Helper::getInstance();
        //$categoriesHandler = $helper->getHandler('Categories');
//        if (is_null($categoriesHandler)) echo "categoriesHandler est null"; else echo 'bin non';
        $categoriesObj = $categoriesHandler->get($this->getVar('ent_cat_id'));

        //----------------------------------------------------
        $utility = new \XoopsModules\Glossaire\Utility();
        $ret = $this->getValues($keys, $format, $maxDepth);
        $ret['id']               = $this->getVar('ent_id');
        $ret['cat_id']           = $this->getVar('ent_cat_id');
        $ret['cat_name']         = $categoriesObj->getVar('cat_name');
//        $ret['uid']              = \XoopsUser::getUnameFromId($this->getVar('ent_uid'));
        $ret['creator']          = $this->getVar('ent_creator');
        $ret['term']             = $this->getVar('ent_term');
        $ret['initiale']         = $this->getVar('ent_initiale');
        $ret['shortdef']         = $this->getVar('ent_shortdef');
        $ret['is_acronym']       = $this->getVar('ent_is_acronym');
        $ret['shortdefMagnifed'] = ($ret['is_acronym']) ? $utility->get_acronym($ret['shortdef']) : $ret['shortdef'];
        $ret['definition']       = $this->getVar('ent_definition', 'e');
        $editorMaxchar = $helper->getConfig('editor_maxchar');
        $ret['definition_short'] = $utility::truncateHtml($ret['definition'], $editorMaxchar);
        $ret['image']            = $this->getVar('ent_image');
        if ($ret['image'] !== ''){
          $ret['image_url']        =  GLOSSAIRE_UPLOAD_IMG_FOLDER_URL . '/' . $categoriesObj->getVar('cat_img_folder') . '/' . $this->getVar('ent_image');
          $ret['definition_img'] = "<div class='highslide-gallery'>"
            . "<a href='{$ret['image_url']}' class='highslide' onclick='return hs.expand(this);' >"
            . "<img src='{$ret['image_url']}' class='img_glossaire' alt='' style='max-width:100px' />"
            . "</a>"
            . "<div class='highslide-heading'></div>"
            . "</div>"
            . $ret['definition'];
               
        }else{
          $ret['image_url']      = '';
          $ret['definition_img'] = $ret['definition'];
        }
        
        $ret['reference']        = $this->getVar('ent_reference', 'e');
        $ret['reference_short']  = $utility::truncateHtml($ret['reference'], $editorMaxchar);
        $ret['urls']             = $utility::build_urls($this->getVar('ent_urls'));
//         $ret['url1']             = $this->getVar('ent_url1');
//         $ret['url2']             = $this->getVar('ent_url2');
//         $ret['date_creation']    = \formatTimestamp($this->getVar('ent_date_creation'), 's');
//         $ret['date_update']      = \formatTimestamp($this->getVar('ent_date_update'), 's');
		$ret['date_creation']          = \JJD\getDateSql2Str($this->getVar('ent_date_creation'));
		$ret['date_update']            = \JJD\getDateSql2Str($this->getVar('ent_date_update'));
        
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
//exit ($fImg);
}

} // ----- FIN DE LA CLASSE -----
