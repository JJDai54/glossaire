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

        //$categoriesHandler = $helper->getHandler('Categories');
        $catList = $categoriesHandler->getList();
        if (count($catList) == 0) \redirect_header('categories.php', 5, _AM_GLOSSAIRE_NO_CATEGORIES1);
        if ($catIdSelect == 0) $catIdSelect = array_key_first($catList);

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
        
        $imgNotExist = $utility->cleanImagesNotExists($catIdSelect, 0);
        if($imgNotExist > 0 ){ //il il i a des image a supprimée ou des definition a nettoyer
          $caption = sprintf(_AM_GLOSSAIRE_CLEAN_ENTRIES_IMAGES, $imgNotExist);
          $adminObject->addItemButton($caption, "entries.php?op=CleanImagesNotExists&catIdSelect={$catIdSelect}", 'update');
        }
        
        $img2delete = $utility->cleanFolderImages($catIdSelect, 0);
        if($img2delete > 0 ){ //il il i a des images a supprimée
          $caption = sprintf(_AM_GLOSSAIRE_CLEAN_FOLDER_IMAGES, $img2delete);
          $adminObject->addItemButton($caption, "entries.php?op=cleanFolderImages&catIdSelect={$catIdSelect}", 'update');
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
        
        $criteria = new \CriteriaCompo();
        $criteria->add(new \Criteria('ent_cat_id',$catIdSelect, "="));
        if ($statusIdSelect>=0) $criteria->add(new \Criteria('ent_status',$statusIdSelect, "="));
        
        $entriesCount = $entriesHandler->getCountEntries($criteria);
        $entriesAll = $entriesHandler->getAllEntries($criteria, $start, $limit);
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
                $pagenav = new \XoopsPageNav($entriesCount, $limit, $start, 'start', "op=list&catIdSelect=$catIdSelect&limit={$limit}");
                $GLOBALS['xoopsTpl']->assign('pagenav', $pagenav->renderNav(4));
            }
        } else {
            $GLOBALS['xoopsTpl']->assign('error', \_AM_GLOSSAIRE_THEREARENT_ENTRIES);
        }

