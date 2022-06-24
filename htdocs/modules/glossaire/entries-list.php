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
use XoopsModules\Glossaire\Common;
//use colorSet AS colorSet;
include_once (XOOPS_ROOT_PATH . "/Frameworks/JJD-Framework/load.php");
use JJD AS JJD;


//         include_once "entries-list.php";
//         break;
        // Breadcrumbs
        $xoBreadcrumbs[] = ['title' => \_MA_GLOSSAIRE_ENTRIES_LIST];
//Utility::include_highslide(array('allowMultipleInstances'=>false));        
//exit('include_highslide');    
        \JJD\include_highslide(array('allowMultipleInstances'=>false));    
        // --------------------------------------------
        // categories avec une listbox
        //$categoriesHandler = $helper->getHandler('Categories');
        /*
        $catList = $categoriesHandler->getListAllowed();
        if ($catIdSelect == 0) $catIdSelect = array_key_first($catList);
        $inpCategory = new \XoopsFormSelect(\_AM_GLOSSAIRE_ENTRY_CAT_ID, 'catIdSelect', $catIdSelect);
        $inpCategory->addOptionArray($catList);
        $inpCategory->setExtra('onchange="document.select_filter.sender.value=this.name;document.select_filter.submit();"');
        $GLOBALS['xoopsTpl']->assign('catIdSelect', $inpCategory->render());
        */
        // --------------------------------------------
        // categories avec des onglets
        \JJD\load_css();
        $catList = $categoriesHandler->getAllAllowed();
        if (count($catList) == 0) {
            require __DIR__ . '/footer.php';
            exit;
        }
        //----------------------------------------------------------
        if ($catIdSelect == 0) $catIdSelect = array_key_first($catList);
        $GLOBALS['xoopsTpl']->assign('categories', $catList);
        $GLOBALS['xoopsTpl']->assign('showButtonsImg', true);
        
        //Categorie selectionnée, utilisée notamment pour colorset
        $GLOBALS['xoopsTpl']->assign('catSelected', $catList[$catIdSelect]);
        
        $GLOBALS['xoopsTpl']->assign('catIdSelect', $catIdSelect);
        $GLOBALS['xoopsTpl']->assign('nbCategories', count($catList));
        $GLOBALS['xoopsTpl']->assign('isCatAllowed', $categoriesHandler->isCatAllowed($catIdSelect));
        $GLOBALS['xoopsTpl']->assign('page2;irect', $page2redirect);
        
        
        //--- Criteres de recherche
        $crEntries = new \CriteriaCompo();
        /*
        if ($entId > 0) {
            $crEntries->add(new \Criteria('ent_id', $entId));
        }else{
          $crEntries->add(new \Criteria('ent_cat_id',$catIdSelect, "="));
          $crEntries->add(new \Criteria('ent_status',GLOSSAIRE_STATUS_APPROVED, "="));
        }
        */
        
          $crEntries->add(new \Criteria('ent_cat_id',$catIdSelect, "="));
          $crEntries->add(new \Criteria('ent_status',GLOSSAIRE_STATUS_APPROVED, "="));
        
        if($letter == '*')  $exp2search = '';
        $GLOBALS['xoopsTpl']->assign('exp2search', $exp2search);
            
        if ($exp2search  !== '' && $letter != '*'){
            $crsearch = new \CriteriaCompo();
            $crsearch->add(new \Criteria('ent_term', "%{$exp2search}%" , 'LIKE'), 'OR');
            $crsearch->add(new \Criteria('ent_shortdef', "%{$exp2search}%" , 'LIKE'), 'OR');
            $crsearch->add(new \Criteria('ent_definition', "%{$exp2search}%" , 'LIKE'), 'OR');
            $crsearch->add(new \Criteria('ent_reference', "%{$exp2search}%" , 'LIKE'), 'OR');
            $crEntries->add($crsearch);
       }            

    //url = XOOPS_URL . "/modules/glossaire/op=list&catId={$catId}&letter=%s";        &exp2search={$exp2search}
        $url = "{$page2redirect}?op=list&catIdSelect={$catIdSelect}&start=0&limit={$limit}&letter=%s&exp2search={$exp2search}";
        $GLOBALS['xoopsTpl']->assign('alphaBarre', $entriesHandler->getAlphaBarre($crEntries, $url, $letter));

        if (strpos(_GLS_ALPHABARRE, $letter) !== false){
            $crEntries->add(new \Criteria('ent_initiale',$letter, "="));
        }
        $entriesCount = $entriesHandler->getCount($crEntries);
//echo "<hr>crEntries<br>"    . $crEntries->renderWhere() . "<hr>";     
        $GLOBALS['xoopsTpl']->assign('entriesCount', $entriesCount);
        if (0 === $entId) {
            $crEntries->setStart($start);
            $crEntries->setLimit($limit);
        }
        $crEntries->setSort('ent_term ASC, ent_id');
        $crEntries->setOrder('ASC');
       // ----------------------------------------------------------------     
        $entriesAll = $entriesHandler->getAll($crEntries);
        $entriesHandler->incrementCounter($crEntries);
        //----------------------------------------------------------------
        if ($entriesCount > 0) {
            $entries = [];
            $entCat_id = '';
            // Get All Entries
            foreach (\array_keys($entriesAll) as $i) {
                $entries[$i] = $entriesAll[$i]->getValuesEntries();
                $entCat_id = $entriesAll[$i]->getVar('ent_cat_id');
                $keywords[$i] = $entCat_id;
            }
            $GLOBALS['xoopsTpl']->assign('entries', $entries);
            unset($entries);
            // Display Navigation
            if ($entriesCount > $limit) {
                require_once \XOOPS_ROOT_PATH . '/class/pagenav.php';
                $pagenav = new \XoopsPageNav($entriesCount, $limit, $start, 'start', "op=list&catIdSelect={$catIdSelect}&limit={$limit}&letter={$letter}&exp2search={$exp2search}" );
                $GLOBALS['xoopsTpl']->assign('pagenav', $pagenav->renderNav(4));
            }
            $GLOBALS['xoopsTpl']->assign('table_type', $helper->getConfig('table_type'));
            $GLOBALS['xoopsTpl']->assign('panel_type', $helper->getConfig('panel_type'));
            $GLOBALS['xoopsTpl']->assign('divideby', $helper->getConfig('divideby'));
            $GLOBALS['xoopsTpl']->assign('numb_col', $helper->getConfig('numb_col'));
            if ('show' == $op && '' != $entCat_id) {
                $GLOBALS['xoopsTpl']->assign('xoops_pagetitle', \strip_tags($entCat_id . ' - ' . $GLOBALS['xoopsModule']->getVar('name')));
            }
            if ('show' == $op) {
                $entriesObj = $entriesHandler->get($entId);
                $entCounter = (int)$entriesObj->getVar('ent_counter') + 1;
                $entriesObj->setVar('ent_counter', $entCounter);
                // Insert Data
                $entriesHandler->insert($entriesObj);
            }
        }
