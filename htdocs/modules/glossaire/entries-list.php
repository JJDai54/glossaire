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
 * @author        Jean-Jacques DELALANDRE - Email:<jjdelalandre@orange.fr> - Website:<jubile.fr>
 */

use Xmf\Request;
use XoopsModules\Glossaire;
use XoopsModules\Glossaire\Constants;
use XoopsModules\Glossaire\Common;
use JJD AS JJD;

//         include_once "entries-list.php";
//         break;
        // Breadcrumbs
        $xoBreadcrumbs[] = ['title' => \_MA_GLOSSAIRE_ENTRIES_LIST];
        $xoTheme->addScript(XOOPS_URL . '/modules/glossaire/assets/js/scroll.js');        
//Utility::include_highslide(array('allowMultipleInstances'=>false));        
        \JJD\include_highslide(array('allowMultipleInstances'=>false));  
        //highslide::include_files(array('allowMultipleInstances'=>false));    
        // --------------------------------------------
        // categories avec une listbox
        //$categoriesHandler = $glossaireHelper->getHandler('Categories');
        /*
        $catList = $categoriesHandler->getListAllowed(view);
        if ($catIdSelect == 0) $catIdSelect = array_key_first($catList);
        $inpCategory = new \XoopsFormSelect(\_AM_GLOSSAIRE_ENTRY_CAT_ID, 'catIdSelect', $catIdSelect);
        $inpCategory->addOptionArray($catList);
        $inpCategory->setExtra('onchange="document.select_filter.sender.value=this.name;document.select_filter.submit();"');
        $GLOBALS['xoopsTpl']->assign('catIdSelect', $inpCategory->render());
        */
        // --------------------------------------------
        // categories avec des onglets
        \JJD\load_css();
        $GLOBALS['xoopsTpl']->assign('catPerms', $catPerms);
        //----------------------------------------------------------
        $GLOBALS['xoopsTpl']->assign('categories', $catList);
        
        //Categorie selectionnée, utilisée notamment pour colorset
        $GLOBALS['xoopsTpl']->assign('catSelected', $catList[$catIdSelect]);
        
        $GLOBALS['xoopsTpl']->assign('catIdSelect', $catIdSelect);
        $GLOBALS['xoopsTpl']->assign('nbCategories', count($catList));
        $GLOBALS['xoopsTpl']->assign('isCatAllowed', $categoriesHandler->isCatAllowed($catIdSelect));
        $GLOBALS['xoopsTpl']->assign('page2redirect', $page2redirect);
        $GLOBALS['xoopsTpl']->assign('searchMode', array(0=>'globalSearch', 1=>'list')[$glossaireHelper->getConfig('search_mode')]);
        $GLOBALS['xoopsTpl']->assign('showId', $glossaireHelper->getConfig('showId'));
        $GLOBALS['xoopsTpl']->assign('posButtonsActions', $glossaireHelper->getConfig('posButtonsActions'));
        $GLOBALS['xoopsTpl']->assign('cat_br_after_term', $catObj->getVar('cat_br_after_term'));

//        $statusAccess = $categoriesHandler->getStatusAccess($catIdSelect);
//        echo "<hr>===> : {$statusAccess}<hr>";
//        $GLOBALS['xoopsTpl']->assign('statusAccess', $statusAccess);
        
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
            
        if ($exp2search  !== '' && $letter != '*' && $sender != 'xoops'){
            include_once('include/search.inc.php');
            $crKeywords = glossaire_build_criteria_words($exp2search,null);
            $crEntries->add($crKeywords);
       }else{
       }
        //a-verifier
         //$exp2search = $exp2searchGlobal;

    //url = XOOPS_URL . "/modules/glossaire/op=list&catId={$catId}&letter=%s";        &exp2search={$exp2search}
        $url = "{$page2redirect}?op=list&catIdSelect={$catIdSelect}&start=0&limit={$limit}&letter=%s&exp2search={$exp2search}";
        
        $alphaBarre = $entriesHandler->getAlphaBarre($crEntries, $url, $letter, $catArr, $alphaBarreWithoutStyle);
        $GLOBALS['xoopsTpl']->assign('alphaBarre', $alphaBarre);
        $GLOBALS['xoopsTpl']->assign('alphaBarre_bottom', $alphaBarreWithoutStyle);
        
        if (strpos($glossaireHelper->getConfig('alphabarre'), $letter) !== false && $letter !='*'){
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
        $entriesHandler->incrementCounter($crEntries, 'ent_term ASC, ent_id', $start, $limit);
        //----------------------------------------------------------------
        if ($entriesCount > 0) {
//           $GLOBALS['xoTheme']->addStylesheet($catObj->getCssFileName(true), null);        
            
            $entries = [];
            $entCat_id = '';
            // Get All Entries
            foreach (\array_keys($entriesAll) as $i) {
                //$entries[$i] = $entriesAll[$i]->getValuesEntries();

                $entries[$i] = $entriesAll[$i]->getValuesEntries(null, null, null, $catObj);
                $entCat_id = $entriesAll[$i]->getVar('ent_cat_id');
                $keywords[$i] = $entCat_id;
            }
            $GLOBALS['xoopsTpl']->assign('entries', $entries);
            // Display Navigation
            if ($entriesCount > $limit) {
                require_once \XOOPS_ROOT_PATH . '/class/pagenav.php';
                $pagenav = new \XoopsPageNav($entriesCount, $limit, $start, 'start', "op=list&catIdSelect={$catIdSelect}&limit={$limit}&letter={$letter}&exp2search={$exp2search}" );
                $GLOBALS['xoopsTpl']->assign('pagenav', $pagenav->renderNav(4));
            }
            
            if($catArr['show_terms_index'] > 0){
              $catArr['nbEntriesByCol'] = intval((count($entries) +($catArr['show_terms_index'] -1))/$catArr['show_terms_index'] );
              $catArr['colWidth'] = intval(100 / $catArr['show_terms_index']);
            }else{
              $catArr['nbEntriesByCol'] = 0;
              $catArr['colWidth'] = 0;
            }
            
        $GLOBALS['xoopsTpl']->assign('catArr', $catArr);
            unset($entries);
            $GLOBALS['xoopsTpl']->assign('table_type', $glossaireHelper->getConfig('table_type'));
            $GLOBALS['xoopsTpl']->assign('panel_type', $glossaireHelper->getConfig('panel_type'));
            $GLOBALS['xoopsTpl']->assign('divideby',   $glossaireHelper->getConfig('divideby'));
            $GLOBALS['xoopsTpl']->assign('numb_col',   $glossaireHelper->getConfig('numb_col'));
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
