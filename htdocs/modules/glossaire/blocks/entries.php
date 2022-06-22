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

/**
 * Function show block
 * @param  $options
 * @return array
 */
function b_glossaire_entries_show($options)
{
$dirname = "glossaire";
    require_once \XOOPS_ROOT_PATH . "/modules/{$dirname}/class/Entries.php";
    $GLOBALS['xoopsTpl']->assign('glossaire_upload_url', \GLOSSAIRE_UPLOAD_URL);
    $GLOBALS['xoopsTpl']->assign('glossaire_url', \GLOSSAIRE_URL);
    $block       = [];
    $typeBlock   = $options[0];
    $limit       = $options[1];
    $lenghtTitle = $options[2];
    $helper      = Helper::getInstance();
    $entriesHandler = $helper->getHandler('Entries');
    $categoriesHandler = $helper->getHandler('Categories');
    $crEntries = new \CriteriaCompo();
    $crEntries->add(new \Criteria('ent_status', GLOSSAIRE_STATUS_APPROVED, '='));
    $idsCat = implode(',', $categoriesHandler->getPermissions('view'));
    $crEntries->add(new \Criteria('ent_cat_id',  "({$idsCat})" , 'IN'));
            
    \array_shift($options);
    \array_shift($options);
    \array_shift($options);

    switch ($typeBlock) {
        case 'last':
        default:
            // For the block: entries last
            $crEntries->setSort('');
            $crEntries->setOrder('DESC');
            break;
        case 'new':
            // For the block: entries new
            // new since last week: 7 * 24 * 60 * 60 = 604800
            $crEntries->add(new \Criteria('', \time() - 604800, '>='));
            $crEntries->add(new \Criteria('', \time(), '<='));
            $crEntries->setSort('');
            $crEntries->setOrder('ASC');
            break;
        case 'hits':
            // For the block: entries hits
            $crEntries->setSort('ent_hits');
            $crEntries->setOrder('DESC');
            break;
        case 'top':
            // For the block: entries top
            $crEntries->setSort('ent_top');
            $crEntries->setOrder('ASC');
            break;
        case 'random':
            // For the block: entries random
            $crEntries->setSort('RAND()');
            break;
    }

    $crEntries->setLimit($limit);
    $entriesAll = $entriesHandler->getAll($crEntries);
    unset($crEntries);
    if (\count($entriesAll) > 0) {
        foreach (\array_keys($entriesAll) as $i) {
            $block[$i]['id'] = $entriesAll[$i]->getVar('ent_id');
            $block[$i]['cat_id'] = $entriesAll[$i]->getVar('ent_cat_id');
//            $block[$i]['uid'] = \XoopsUser::getUnameFromId($entriesAll[$i]->getVar('ent_uid'));
            $block[$i]['term'] = \htmlspecialchars($entriesAll[$i]->getVar('ent_term'), ENT_QUOTES | ENT_HTML5);
            $block[$i]['initiale'] = \htmlspecialchars($entriesAll[$i]->getVar('ent_initiale'), ENT_QUOTES | ENT_HTML5);
            $block[$i]['shortdef'] = \htmlspecialchars($entriesAll[$i]->getVar('ent_shortdef'), ENT_QUOTES | ENT_HTML5);
            //$block[$i]['shortdefMagnifed'] = \htmlspecialchars($entriesAll[$i]->getVar('shortdefMagnifed'), ENT_QUOTES | ENT_HTML5);
            $block[$i]['definition'] = \strip_tags($entriesAll[$i]->getVar('ent_definition'));
            $block[$i]['reference'] = \strip_tags($entriesAll[$i]->getVar('ent_reference'));
            $block[$i]['urls'] = \htmlspecialchars($entriesAll[$i]->getVar('ent_urls'), ENT_QUOTES | ENT_HTML5);
//             $block[$i]['url1'] = \htmlspecialchars($entriesAll[$i]->getVar('ent_url1'), ENT_QUOTES | ENT_HTML5);
//             $block[$i]['url2'] = \htmlspecialchars($entriesAll[$i]->getVar('ent_url2'), ENT_QUOTES | ENT_HTML5);
            $block[$i]['counter'] = $entriesAll[$i]->getVar('ent_counter');
        }
    }

    return $block;

}

/**
 * Function edit block
 * @param  $options
 * @return string
 */
function b_glossaire_entries_edit($options)
{
    require_once \XOOPS_ROOT_PATH . '/modules/glossaire/class/Entries.php';
    $helper = Helper::getInstance();
    $entriesHandler = $helper->getHandler('Entries');
    $GLOBALS['xoopsTpl']->assign('glossaire_upload_url', \GLOSSAIRE_UPLOAD_URL);
    $form = \_MB_GLOSSAIRE_DISPLAY;
    $form .= "<input type='hidden' name='options[0]' value='".$options[0]."' >";
    $form .= "<input type='text' name='options[1]' size='5' maxlength='255' value='" . $options[1] . "' >&nbsp;<br>";
    $form .= \_MB_GLOSSAIRE_TITLE_LENGTH . " : <input type='text' name='options[2]' size='5' maxlength='255' value='" . $options[2] . "' ><br><br>";
    \array_shift($options);
    \array_shift($options);
    \array_shift($options);

    $crEntries = new \CriteriaCompo();
    $crEntries->add(new \Criteria('ent_id', 0, '!='));
    $crEntries->setSort('ent_id');
    $crEntries->setOrder('ASC');
    $entriesAll = $entriesHandler->getAll($crEntries);
    unset($crEntries);
    $form .= \_MB_GLOSSAIRE_ENTRIES_TO_DISPLAY . "<br><select name='options[]' multiple='multiple' size='5'>";
    $form .= "<option value='0' " . (!\in_array(0, $options) && !\in_array('0', $options) ? '' : "selected='selected'") . '>' . \_MB_GLOSSAIRE_ALL_ENTRIES . '</option>';
    foreach (\array_keys($entriesAll) as $i) {
        $ent_id = $entriesAll[$i]->getVar('ent_id');
        $form .= "<option value='" . $ent_id . "' " . (!\in_array($ent_id, $options) ? '' : "selected='selected'") . '>' . $entriesAll[$i]->getVar('ent_cat_id') . '</option>';
    }
    $form .= '</select>';

    return $form;

}
