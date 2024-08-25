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
 * @author        Jean-Jacques DELALANDRE - Email:<jjdelalandre@orange.fr> - Website:<xoopsfr.kiolo.fr>
 */

use Xmf\Request;
use XoopsModules\Glossaire;
use XoopsModules\Glossaire\Constants;
use XoopsModules\Glossaire\Common;
        //$categoriesHandler = $glossaireHelper->getHandler('Categories');
        $clPerms->addPermissions($criteria, 'view_cats', 'cat_id');        
        $catList = $categoriesHandler->getList($criteria);
        if (count($catList) == 0) \redirect_header('categories.php', 5, _AM_GLOSSAIRE_NO_CATEGORIES1);
        if (!array_key_exists ($catIdSelect, $catList)) $catIdSelect = array_key_first($catList);

        // Define Stylesheet
        $GLOBALS['xoTheme']->addStylesheet($style, null);
        $templateMain = 'glossaire_admin_entries.tpl';
        $GLOBALS['xoopsTpl']->assign('navigation', $adminObject->displayNavigation('entries.php'));
        $adminObject->addItemButton(\_AM_GLOSSAIRE_ADD_ENTRY, "entries.php?op=new&catIdSelect={$catIdSelect}", 'add');
        
        /* remplacé par deux boutons, un pour chaque cas
        $imgCleanArr = $utility->cleanEntriesImages($catIdSelect, 0);
        if($imgCleanArr[0] > 0 ){ //il il i a des image a supprimée ou des definition a nettoyer
          $caption = sprintf(_AM_GLOSSAIRE_CLEAN_IMAGES, $imgCleanArr[1], $imgCleanArr[2]);
          $adminObject->addItemButton($caption, "entries.php?op=cleanEntriesImages&catIdSelect={$catIdSelect}", 'update');
        }
        */
        
        $adminObject->addItemButton(_AM_GLOSSAIRE_RAZ_COUNTERS, "entries.php?op=razCounter&catIdSelect={$catIdSelect}", 'update');
          
        $params = array('op'          => 'cleanCatFolders',
                        'folder'      => 'images',
                        'fldPath'     => 'ent_image',
                        'fldName'     => '',
                        'catIdSelect' => $catIdSelect);        
        $stat = $utility->cleanCatFolders($catIdSelect, $params['fldPath'], $params['fldName'], $params['folder'], 0, 0);
        if($stat[0] > 0 ){ //il il i a des image a supprimée ou des definition a nettoyer
          $caption = sprintf(_AM_GLOSSAIRE_CLEAN_ENTRIES_IMAGES, $stat[1], $stat[2]);
          $adminObject->addItemButton($caption, \JANUS\array2urlParams($params, '', 'entries.php?'), 'update');
        }
        
        $params = array('op'          => 'cleanCatFolders',
                        'folder'      => 'files',
                        'fldPath'     => 'ent_file_path',
                        'fldName'     => 'ent_file_name',
                        'catIdSelect' => $catIdSelect);        
        $stat = $utility->cleanCatFolders($catIdSelect, $params['fldPath'], $params['fldName'], $params['folder'], 0, 0);
        if($stat[0] > 0 ){ //il il i a des image a supprimée ou des definition a nettoyer
          $caption = sprintf(_AM_GLOSSAIRE_CLEAN_ENTRIES_FILES, $stat[1], $stat[2]);
          $adminObject->addItemButton($caption, \JANUS\array2urlParams($params, '', 'entries.php?'), 'update');
        }
        
        $GLOBALS['xoopsTpl']->assign('buttons', $adminObject->displayButton('left'));
        //--------------------------------------------------------------------------
        
        $inpCategory = new \XoopsFormSelect(\_AM_GLOSSAIRE_ENTRY_CAT_ID, 'catIdSelect', $catIdSelect);
        $inpCategory->addOptionArray($catList);
        $inpCategory->setExtra('onchange="document.select_filter.sender.value=this.name;document.select_filter.submit();"');
        $GLOBALS['xoopsTpl']->assign('catIdSelect', $inpCategory->render());
        
        $inpStatus = new \XoopsFormSelect(\_AM_GLOSSAIRE_ENTRY_STATUS, 'statusIdSelect', $statusIdSelect);
        $inpStatus->addOption(GLOSSAIRE_STATUS_ALL, _ALL);
        $inpStatus->addOption(GLOSSAIRE_STATUS_INACTIF, _AM_GLOSSAIRE_CATEGORY_STATUS_INATIF);
        $inpStatus->addOption(GLOSSAIRE_PROPOSITION, _AM_GLOSSAIRE_CATEGORY_STATUS_PROPOSITION);
        $inpStatus->addOption(GLOSSAIRE_STATUS_APPROVED, _AM_GLOSSAIRE_CATEGORY_STATUS_APPROVED);
        $inpStatus->setExtra('onchange="document.select_filter.sender.value=this.name;document.select_filter.submit();"');
        $GLOBALS['xoopsTpl']->assign('statusSelect', $inpStatus->render());
        
//         $inpSort = new \XoopsFormSelect(\_CO_GLOSSAIRE_ENTRIES_SORT0, 'sortIdSelect', $sortIdSelect);
//         $inpSort->addOption(0, _CO_GLOSSAIRE_ENTRIES_SORT1);
//         $inpSort->addOption(1, _CO_GLOSSAIRE_ENTRIES_SORT2);
//         $inpSort->addOption(2, _CO_GLOSSAIRE_ENTRIES_SORT3);
//         $inpSort->addOption(3, _CO_GLOSSAIRE_ENTRIES_SORT4);
//         $inpSort->addOption(4, _CO_GLOSSAIRE_ENTRIES_SORT5);
//         $inpSort->addOption(5, _CO_GLOSSAIRE_ENTRIES_SORT6);
//         $inpSort->addOption(6, _CO_GLOSSAIRE_ENTRIES_SORT7);
//         $inpSort->setExtra('onchange="document.select_filter.sender.value=this.name;document.select_filter.submit();"');
//         $GLOBALS['xoopsTpl']->assign('sortIdSelect', $inpSort->render());
//         
//         $sortArray= array('ent_term,ent_id','ent_shortdef,ent_id',
//                           'ent_creator,ent_term,ent_id',
//                           'ent_date_creation,ent_id',
//                           'ent_date_update,ent_id',
//                           'ent_counter,ent_term,ent_id',
//                           'ent_status,ent_term,ent_id');
                          
                           
///////////////////////////////////////////////////////////////////////////
 $cols = 1;
 $colToSortArray=[
 array('caption'=>_CO_GLOSSAIRE_ENTRIES_SORT1, 'fields'=>'ent_term,ent_id',             'tplColToSort'=>$cols++),
 array('caption'=>_CO_GLOSSAIRE_ENTRIES_SORT2, 'fields'=>'ent_id',                      'tplColToSort'=>$cols++),
 array('caption'=>_CO_GLOSSAIRE_ENTRIES_SORT3, 'fields'=>'ent_shortdef,ent_id',         'tplColToSort'=>$cols++),
 array('caption'=>_CO_GLOSSAIRE_ENTRIES_SORT4, 'fields'=>'ent_creator,ent_term,ent_id', 'tplColToSort'=>$cols++),
 array('caption'=>_CO_GLOSSAIRE_ENTRIES_SORT5, 'fields'=>'ent_date_creation,ent_id',    'tplColToSort'=>$cols++),
 array('caption'=>_CO_GLOSSAIRE_ENTRIES_SORT6, 'fields'=>'ent_date_update,ent_id',      'tplColToSort'=>$cols++),
 array('caption'=>_CO_GLOSSAIRE_ENTRIES_SORT7, 'fields'=>'ent_counter,ent_term,ent_id', 'tplColToSort'=>$cols++),
 array('caption'=>_CO_GLOSSAIRE_ENTRIES_SORT8, 'fields'=>'ent_status,ent_term,ent_id',  'tplColToSort'=>$cols++)
 ];                         
//  array('caption'=>_CO_GLOSSAIRE_ENTRIES_SORT1, 'fields'=>'ent_term,ent_id',             'tplColToSort'=>GLOSSAIRE_COL_ADM_ENTRIES_TERM),
//  array('caption'=>_CO_GLOSSAIRE_ENTRIES_SORT2, 'fields'=>'ent_id',                      'tplColToSort'=>GLOSSAIRE_COL_ADM_ENTRIES_ID),
//  array('caption'=>_CO_GLOSSAIRE_ENTRIES_SORT3, 'fields'=>'ent_shortdef,ent_id',         'tplColToSort'=>GLOSSAIRE_COL_ADM_ENTRIES_SHORTDEF),
//  array('caption'=>_CO_GLOSSAIRE_ENTRIES_SORT4, 'fields'=>'ent_creator,ent_term,ent_id', 'tplColToSort'=>GLOSSAIRE_COL_ADM_ENTRIES_CREATOR),
//  array('caption'=>_CO_GLOSSAIRE_ENTRIES_SORT5, 'fields'=>'ent_date_creation,ent_id',    'tplColToSort'=>GLOSSAIRE_COL_ADM_ENTRIES_DATE_CREATION),
//  array('caption'=>_CO_GLOSSAIRE_ENTRIES_SORT6, 'fields'=>'ent_date_update,ent_id',      'tplColToSort'=>GLOSSAIRE_COL_ADM_ENTRIES_DATE_UPDATE),
//  array('caption'=>_CO_GLOSSAIRE_ENTRIES_SORT7, 'fields'=>'ent_counter,ent_term,ent_id', 'tplColToSort'=>GLOSSAIRE_COL_ADM_ENTRIES_COUNTER),
//  array('caption'=>_CO_GLOSSAIRE_ENTRIES_SORT8, 'fields'=>'ent_status,ent_term,ent_id',  'tplColToSort'=>GLOSSAIRE_COL_ADM_ENTRIES_STATUS)
//  ];                         
        $inpSort = new \XoopsFormSelect(\_CO_GLOSSAIRE_ENTRIES_SORT0, 'sortIdSelect', $sortIdSelect);
        $h=-1;
        for($h=0; $h<count($colToSortArray); $h++){
            $inpSort->addOption($h, $colToSortArray[$h]['caption']);
        }
        $inpSort->setExtra('onchange="document.select_filter.sender.value=this.name;document.select_filter.submit();"');
        $GLOBALS['xoopsTpl']->assign('sortIdSelect', $inpSort->render());
        $GLOBALS['xoopsTpl']->assign('tplColToSort', $colToSortArray[$sortIdSelect]['tplColToSort']);
                          
                       
                          

        $inpStatus->addOption(GLOSSAIRE_STATUS_INACTIF, _AM_GLOSSAIRE_CATEGORY_STATUS_INATIF);
        $inpStatus->addOption(GLOSSAIRE_PROPOSITION, _AM_GLOSSAIRE_CATEGORY_STATUS_PROPOSITION);
        $inpStatus->addOption(GLOSSAIRE_STATUS_APPROVED, _AM_GLOSSAIRE_CATEGORY_STATUS_APPROVED);
        $inpStatus->setExtra('onchange="document.select_filter.sender.value=this.name;document.select_filter.submit();"');
        $GLOBALS['xoopsTpl']->assign('statusSelect', $inpStatus->render());
        
        $criteria = new \CriteriaCompo();
        $criteria->add(new \Criteria('ent_cat_id',$catIdSelect, "="));
//         $criteria->setSort($sortArray[$sortIdSelect]);   
//         $criteria->setOrder('ASC');   
        if ($statusIdSelect>=0) $criteria->add(new \Criteria('ent_status',$statusIdSelect, "="));
        
        $entriesCount = $entriesHandler->getCountEntries($criteria);
        $entriesAll = $entriesHandler->getAllEntries($criteria, $start, $limit, $colToSortArray[$sortIdSelect]['fields']);
        $GLOBALS['xoopsTpl']->assign('entries_count', $entriesCount);
        $GLOBALS['xoopsTpl']->assign('glossaire_url', \GLOSSAIRE_URL);
        $GLOBALS['xoopsTpl']->assign('glossaire_upload_url', \GLOSSAIRE_UPLOAD_URL);
        // Table view entries
        if ($entriesCount > 0) {
            foreach (\array_keys($entriesAll) as $i) {
                $entry = $entriesAll[$i]->getValuesEntries();
                $GLOBALS['xoopsTpl']->append('entries_list', $entry);
                unset($entry);
            }
            // Display Navigation
            if ($entriesCount > $limit) {
                require_once \XOOPS_ROOT_PATH . '/class/pagenav.php';
                //$pagenav = new \XoopsPageNav($entriesCount, $limit, $start, 'start', "op=list&catIdSelect=$catIdSelect&limit={$limit}");
                $pagenav = new \XoopsPageNav($entriesCount, $limit, $start, 'start', "op=list{$gp}");
                $GLOBALS['xoopsTpl']->assign('pagenav', $pagenav->renderNav(4));
            }
        } else {
            $GLOBALS['xoopsTpl']->assign('error', \_AM_GLOSSAIRE_THEREARENT_ENTRIES);
        }

