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
        $this->initVar('cat_logourl', \XOBJ_DTYPE_TXTBOX);
        $this->initVar('cat_alphabarre', \XOBJ_DTYPE_TXTBOX);
        $this->initVar('cat_alphabarre_mode', \XOBJ_DTYPE_INT);
        $this->initVar('cat_letter_css_default', \XOBJ_DTYPE_TXTBOX);
        $this->initVar('cat_letter_css_selected', \XOBJ_DTYPE_TXTBOX);
        $this->initVar('cat_letter_css_exist', \XOBJ_DTYPE_TXTBOX);
        $this->initVar('cat_letter_css_notexist', \XOBJ_DTYPE_TXTBOX);
        $this->initVar('cat_img_folder', \XOBJ_DTYPE_TXTBOX);
        $this->initVar('cat_colors_set', \XOBJ_DTYPE_TXTBOX);
        $this->initVar('cat_is_acronym', \XOBJ_DTYPE_INT); 
        $this->initVar('cat_count_entries', \XOBJ_DTYPE_INT); 
        $this->initVar('cat_show_terms_index', \XOBJ_DTYPE_INT); 
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
     * @public function getForm
     * @param bool $action
     * @return \XoopsThemeForm
     */
    public function getFormCategories($action = false)
    {
        $glossaireHelper = \XoopsModules\Glossaire\Helper::getInstance();
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
        
        // Form Text cat_img_folder
        //$form->addElement(new \XoopsFormLabel(\_AM_GLOSSAIRE_CATEGORY_IMG_FOLDER, $this->getVar('cat_img_folder')));
        $form->addElement(new \XoopsFormText(\_AM_GLOSSAIRE_CATEGORY_IMG_FOLDER, 'cat_img_folder', 50, 255, $this->getVar('cat_img_folder')), false);
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
        $getCatLogourl = $this->getVar('cat_logourl');
        $catLogourl = $getCatLogourl ?: 'blank.gif';
        $imageDirectory = '/Frameworks/moduleclasses/icons/32';
        $imageTray = new \XoopsFormElementTray(\_AM_GLOSSAIRE_CATEGORY_LOGOURL, '<br>');
        $imageSelect = new \XoopsFormSelect(\sprintf(\_AM_GLOSSAIRE_CATEGORY_LOGOURL_UPLOADS, ".{$imageDirectory}/"), 'cat_logourl', $catLogourl, 5);
        $imageArray = \XoopsLists::getImgListAsArray( \XOOPS_ROOT_PATH . $imageDirectory );
        foreach ($imageArray as $image1) {
            $imageSelect->addOption(($image1), $image1);
        }
        $imageSelect->setExtra("onchange='showImgSelected(\"imglabel_cat_logourl\", \"cat_logourl\", \"" . $imageDirectory . '", "", "' . \XOOPS_URL . "\")'");
        $imageTray->addElement($imageSelect, false);
        $imageTray->addElement(new \XoopsFormLabel('', "<br><img src='" . \XOOPS_URL . '/' . $imageDirectory . '/' . $catLogourl . "' id='imglabel_cat_logourl' alt='' style='max-width:100px' >"));
        // Form Frameworks Images catLogourl: Upload new image
        $fileSelectTray = new \XoopsFormElementTray('', '<br>');
        $fileSelectTray->addElement(new \XoopsFormFile(\_AM_GLOSSAIRE_FORM_UPLOAD_NEW, 'cat_logourl', $glossaireHelper->getConfig('maxsize_image')));
        $fileSelectTray->addElement(new \XoopsFormLabel(''));
        $imageTray->addElement($fileSelectTray);
        $form->addElement($imageTray);
        
        // Form Text 
        $form->addElement(new \XoopsFormText(\_MI_GLOSSAIRE_ALPHABARRE, 'cat_alphabarre', 150, 255, $this->getVar('cat_alphabarre')));
        $form->addElement(new \XoopsFormRadioYN(\_MI_GLOSSAIRE_ALPHABARRE_MODE, 'cat_alphabarre_mode', $this->getVar('cat_alphabarre_mode')));
        $form->addElement(new \XoopsFormText(\_MI_GLOSSAIRE_ALPHABARRE_LETTER_DEFAULT, 'cat_letter_css_default', 150, 255, $this->getVar('cat_letter_css_default')));
        $form->addElement(new \XoopsFormText(\_MI_GLOSSAIRE_ALPHABARRE_LETTER_SELECTED, 'cat_letter_css_selected', 150, 255, $this->getVar('cat_letter_css_selected')));
        $form->addElement(new \XoopsFormText(\_MI_GLOSSAIRE_ALPHABARRE_LETTER_EXIST, 'cat_letter_css_exist', 150, 255, $this->getVar('cat_letter_css_exist')));
        $form->addElement(new \XoopsFormText(\_MI_GLOSSAIRE_ALPHABARRE_LETTER_NOT_EXIST, 'cat_letter_css_notexist', 150, 255, $this->getVar('cat_letter_css_notexist')));
        
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
        
        // Form Text cat_show_terms_index
        $inpMagnifySd = new \XoopsFormRadioYN(\_AM_GLOSSAIRE_CATEGORY_SHOW_INDEX_TERMS, 'cat_show_terms_index', $this->getVar('cat_show_terms_index'));
        $inpMagnifySd->setDescription(\_AM_GLOSSAIRE_CATEGORY_SHOW_INDEX_TERMS_DESC);
        $form->addElement($inpMagnifySd);
        
//         // Form Text Date Select catDate_creation
//         $catDate_creation = $this->isNew() ? \time() : $this->getVar('cat_date_creation');
//         $form->addElement(new \XoopsFormDateTime(\_AM_GLOSSAIRE_CATEGORY_DATE_CREATION, 'cat_date_creation', '', $catDate_creation));
//         // Form Text Date Select catDate_update
//         $catDate_update = $this->isNew() ? \time() : $this->getVar('cat_date_update');
//         $form->addElement(new \XoopsFormDateTime(\_AM_GLOSSAIRE_CATEGORY_DATE_UPDATE, 'cat_date_update', '', $catDate_update));
        
        
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
    {
        $glossaireHelper  = \XoopsModules\Glossaire\Helper::getInstance();
        $utility = new \XoopsModules\Glossaire\Utility();
        $ret = $this->getValues($keys, $format, $maxDepth);
        $ret['id']                = $this->getVar('cat_id');
        $ret['name']              = $this->getVar('cat_name');
        $ret['description']       = $this->getVar('cat_description', 'e');
        $editorMaxchar = $glossaireHelper->getConfig('editor_maxchar');
        $ret['description_short'] = $utility::truncateHtml($ret['description'], $editorMaxchar);
        $ret['weight']            = $this->getVar('cat_weight');
        $ret['logourl']           = $this->getVar('cat_logourl');
        
        $ret['alphabarre']          = $this->getVar('cat_alphabarre');
        $ret['alphabarre_mode']     = $this->getVar('cat_alphabarre_mode');
        $ret['letter_css_default']  = $this->getVar('cat_letter_css_default');
        $ret['letter_css_selected'] = $this->getVar('cat_letter_css_selected');
        $ret['letter_css_exist']    = $this->getVar('cat_letter_css_exist');
        $ret['letter_css_notexist'] = $this->getVar('cat_letter_css_notexist');

        $ret['img_folder']        = $this->getVar('cat_img_folder');
        $ret['colors_set']        = ($this->getVar('cat_colors_set')) ? $this->getVar('cat_colors_set') : "default";
        $ret['is_acronym']        = $this->getVar('cat_is_acronym');
        $ret['show_terms_index']  = $this->getVar('cat_show_terms_index');
        $ret['count_entries']     = $this->getVar('cat_count_entries');
//         $ret['date_creation']     = \formatTimestamp($this->getVar('cat_date_creation'), 'm');
//         $ret['date_update']    = \formatTimestamp($this->getVar('cat_date_update'), 'm');
		$ret['date_creation']     = \JJD\getDateSql2Str($this->getVar('cat_date_creation'));
		$ret['date_update']       = \JJD\getDateSql2Str($this->getVar('cat_date_update'));
        
        return $ret;
    }

    /**
     * Returns an array representation of the object
     *
     * @return array
     */
    public function toArrayCategories()
    {
        $ret = [];
        $vars = $this->getVars();
        foreach (\array_keys($vars) as $var) {
            $ret[$var] = $this->getVar('"{$var}"');
        }
        return $ret;
    }
    
    /**
     * Returns chemin de stockage des images et fichiers de la catégories
     *
     * @return string fullPath
     */
    public function getPathUploads($subFolder='', $isUrl=false, $mode= 0777){
    
        if($subFolder !== '')
            $folder = '/' . $this->getVar('cat_img_folder') . '/' . $subFolder;
        else
            $folder = '/' . $this->getVar('cat_img_folder');
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

}
