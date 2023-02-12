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

use XoopsModules\Glossaire;
use XoopsModules\Glossaire\Helper;
use XoopsModules\Glossaire\Constants;

/**
 * Function show block
 * @param  $options
 * @return array
 */
function b_glossaire_categories_show($options)
{
//echo "<hr>===>options : <pre>". print_r($options, true) ."</pre><hr>";
	$myts = MyTextSanitizer::getInstance();
    $dirname = "glossaire";
    //$GLOBALS['xoopsTpl']->assign('glossaire_upload_url', \GLOSSAIRE_UPLOAD_URL);
    //$GLOBALS['xoopsTpl']->assign('glossaire_url', \GLOSSAIRE_URL);
    $block       = [];
    $h=0;
	$limit       = $options[$h++];
	$lenghtTitle = $options[$h++];
	$catsIds = $options[$h++];
    $tCats = explode(',', $catsIds);
    if($tCats[0] == 0){
        $nbCats = 0;
    }else{
        $nbCats = count($tCats);
    }
	$caption = $options[$h++];
	//$desc = $options[5];
    
	array_shift($options);
	array_shift($options);
	array_shift($options);
	array_shift($options);
	//array_shift($options);
//------------------------------------------------------------------
    $glossaireHelper = \XoopsModules\Glossaire\Helper::getInstance();
    $categoriesHandler = $glossaireHelper->getHandler('Categories');
    if(in_array(0, $tCats) || count($tCats) == 0){
      $cats = $categoriesHandler->getAllAllowed('view', null, 0, 0, $sort='cat_weight,cat_name,cat_id', $order="ASC");   
    }else{
      $crCat = new \CriteriaCompo();
      $crCat->add(new Criteria('cat_id', "({$catsIds})", 'IN'));
      $cats = $categoriesHandler->getAllAllowed('view', $crCat, 0, 0, $sort='cat_weight,cat_name,cat_id', $order="ASC");   
    }
    
   
    $block['options']['title'] = $caption;            
    //$block['options']['desc'] = str_replace("\n", "<br>",$desc);            
    $block['options']['theme'] = 'blue';            

    
	if (count($cats) > 0) {
		foreach(array_keys($cats) as $i) {
            $catId = $cats[$i]['cat_id'];
			$block['data'][$catId]['id'] = $catId;            
			$block['data'][$catId]['name'] = $cats[$catId]['cat_name'];            
			$block['data'][$catId]['theme'] = $cats[$catId]['cat_colors_set'];            
//             $catId = $cats[$i]->getVar('cat_id');
// 			$block['data'][$catId]['cat']['id'] = $catId;            
// 			$block['data'][$catId]['cat']['name'] = $cats[$catId]['cat_name'];            
// 			$block['data'][$catId]['cat']['theme'] = $cats[$catId]['cat_colors_set'];            
		}
	}

//echo "<hr>===>block : <pre>". print_r($block, true) ."</pre><hr>";

\JJD\load_css('', false);	
    return $block;

}

/**
 * Function edit block
 * @param  $options
 * @return string
 */
function b_glossaire_categories_edit($options)
{
    $glossaireHelper = \XoopsModules\Glossaire\Helper::getInstance();
    $form = new \XoopsThemeForm("glossaire_block", 'form', $action, 'post', true);
	$form->setExtra('enctype="multipart/form-data"');
            
    //--------------------------------------------
    $index=0 ; 
    $inpNbItems = new \XoopsFormNumber(_CO_JJD_NB_QUIZ_2_list, "options[{$index}]", 5, 5, $options[$index]);
    $inpNbItems->setMinMax(3, 25);
    $form->addElement($inpNbItems);
    //--------------------------------------------
    $index++;    
    $inpLgItems = new \XoopsFormNumber(_CO_JJD_NAME_LENGTH, "options[{$index}]", 5, 5, $options[$index]);
    $inpLgItems->setMinMax(25, 120);
    $form->addElement($inpLgItems);

    $index++;   
    $tCat = explode(',', $options[$index]); 
    $categoriesHandler = $glossaireHelper->getHandler('Categories');
    $catAll = $categoriesHandler->getAllCategories();

    $inpCat = new \XoopsFormSelect(_CO_JJD_CATEGORIES, "options[{$index}]", $tCat, $size = 5, true);
    $inpCat->addOption(0, _CO_JJD_ALL_CAT);
	foreach(array_keys($catAll) as $i) {
        $inpCat->addOption($catAll[$i]->getVar('cat_id'), $catAll[$i]->getVar('cat_name'));
	}
    $form->addElement($inpCat);
    
    
    $index++;    
    $inpCaption = new \XoopsFormText(_CO_JJD_BLOCK_TITLE ,  "options[{$index}]", 120, 120, $options[$index]);
    $form->addElement($inpCaption);

    return $form->render();

}



