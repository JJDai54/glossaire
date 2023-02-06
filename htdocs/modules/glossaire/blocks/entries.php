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

require_once \XOOPS_ROOT_PATH . '/modules/glossaire/include/common.php';
include_once (XOOPS_ROOT_PATH . "/Frameworks/JJD-Framework/load.php");

/**
 * Function show block
 * @param  $options
 * @return array
 */
function b_glossaire_entries_show($options)
{
//echo "<hr>===>options : <pre>". print_r($options, true) ."</pre><hr>";
	$myts = MyTextSanitizer::getInstance();
    $dirname = "glossaire";
    require_once \XOOPS_ROOT_PATH . "/modules/{$dirname}/class/Entries.php";
    $GLOBALS['xoopsTpl']->assign('glossaire_upload_url', \GLOSSAIRE_UPLOAD_URL);
    $GLOBALS['xoopsTpl']->assign('glossaire_url', \GLOSSAIRE_URL);
    $block       = [];
    $typeBlock   = $options[0];
	$limit       = $options[1];
	$lenghtTitle = $options[2];
	$catsIds = $options[3];
    $tCats = explode(',', $catsIds);
    if($tCats[0] == 0){
        $nbCats = 0;
    }else{
        $nbCats = count($tCats);
    }
	$caption = $options[4];
	//$desc = $options[5];
    
	array_shift($options);
	array_shift($options);
	array_shift($options);
	array_shift($options);
	//array_shift($options);
//------------------------------------------------------------------
	$glossaireHelper = \XoopsModules\Glossaire\Helper::getInstance();
	$entriesHandler = $glossaireHelper->getHandler('Entries');
    $categoriesHandler = $glossaireHelper->getHandler('Categories');
    $cats = $categoriesHandler->getAll (null,null,false);
//echo "<hr>===>cats : <pre>". print_r($cats, true) ."</pre><hr>";
	$crEntries = new \CriteriaCompo();
    if ($nbCats>0) 
        $crEntries->add(new Criteria('ent_cat_id', "({$catsIds})", 'IN'));
    

    switch ($typeBlock) {
        case 'last':
        default:
            // For the block: entries last
            $crEntries->setSort('ent_cat_id');
            $crEntries->setOrder('DESC');
            break;
//         case 'new':
//             // For the block: entries new
//             // new since last week: 7 * 24 * 60 * 60 = 604800
//             $crEntries->add(new \Criteria('', \time() - 604800, '>='));
//             $crEntries->add(new \Criteria('', \time(), '<='));
//             $crEntries->setSort('');
//             $crEntries->setOrder('ASC');
//             break;
//         case 'hits':
//             // For the block: entries hits
//             $crEntries->setSort('ent_hits');
//             $crEntries->setOrder('DESC');
//             break;
//         case 'top':
//             // For the block: entries top
//             $crEntries->setSort('ent_top');
//             $crEntries->setOrder('ASC');
//             break;
        case 'random':
            // For the block: entries random
            $crEntries->setSort('RAND()');
            break;
    }
    
    $block['options']['title'] = $caption;            
    //$block['options']['desc'] = str_replace("\n", "<br>",$desc);            
    $block['options']['theme'] = 'red';            

    $crEntries->setLimit($limit);
    $entriesAll = $entriesHandler->getAll($crEntries);
    unset($crEntries);
//echo "<hr>===>entries : <pre>". print_r($entriesAll, true) ."</pre><hr>";
    
	if (count($entriesAll) > 0) {
		foreach(array_keys($entriesAll) as $i) {
            $catId = $entriesAll[$i]->getVar('ent_cat_id');
			$block['data'][$catId]['cat']['id'] = $catId;            
			$block['data'][$catId]['cat']['name'] = $cats[$catId]['cat_name'];            
			$block['data'][$catId]['cat']['theme'] = $cats[$catId]['cat_colors_set'];            
            
			$block['data'][$catId]['entries'][$i]['id'] = $entriesAll[$i]->getVar('ent_id');
			$block['data'][$catId]['entries'][$i]['cat_id'] = $catId;
			$block['data'][$catId]['entries'][$i]['term'] = $myts->htmlSpecialChars($entriesAll[$i]->getVar('ent_term'));
			$block['data'][$catId]['entries'][$i]['shortdef'] = $myts->htmlSpecialChars($entriesAll[$i]->getVar('ent_shortdef'));
            
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
function b_glossaire_entries_edit($options)
{
include_once (XOOPS_ROOT_PATH . "/Frameworks/JJD-Framework/load.php");

    $form = new \XoopsThemeForm("glossaire_block", 'form', $action, 'post', true);
	$form->setExtra('enctype="multipart/form-data"');
            
    //--------------------------------------------
    $filterTray = new \XoopsFormElementTray(_CO_JJD_NB_QUIZ_2_list, '');    
    $index = 0;    //last, random, ... //mettre les formHidden en dernier
    $inpFilter = new \XoopsFormHidden("options[{$index}]", $options[$index]); 
    $filterTray->addElement($inpFilter);


    
    $index++ ; 
    $inpNbItems = new \XoopsFormNumber('', "options[{$index}]", 5, 5, $options[$index]);
    $inpNbItems->setMinMax(3, 25);
    $filterTray->addElement($inpNbItems);
    $form->addElement($filterTray);
    //--------------------------------------------
    $index++;    
    $inpLgItems = new \XoopsFormNumber(_CO_JJD_NAME_LENGTH, "options[{$index}]", 5, 5, $options[$index]);
    $inpLgItems->setMinMax(25, 120);
    $form->addElement($inpLgItems);

    $index++;   
    $tCat = explode(',', $options[$index]); 
	$catAll = b_glossaire_get_AllCategories();
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

function b_glossaire_get_AllCategories()
{

    require_once \XOOPS_ROOT_PATH . '/modules/glossaire/class/Categories.php';
    $glossaireHelper = \XoopsModules\Glossaire\Helper::getInstance();
    $categoriesHandler = $glossaireHelper->getHandler('Categories');
    return $categoriesHandler->getAllCategories();
    
}
function b_glossaire_get_AllowedCategories()
{

    require_once \XOOPS_ROOT_PATH . '/modules/glossaire/class/categories.php';
    $glossaireHelper = \XoopsModules\Glossaire\Helper::getInstance();
    $categoriesHandler = $glossaireHelper->getHandler('Categories');
    $catIds = $categoriesHandler->getIdsAllowed('view');
    return $catIds;
    
}
