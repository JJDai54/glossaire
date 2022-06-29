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
function b_glossaire_categories_show($options)
{
    require_once \XOOPS_ROOT_PATH . '/modules/glossaire/class/categories.php';
    $GLOBALS['xoopsTpl']->assign('glossaire_upload_url', \GLOSSAIRE_UPLOAD_URL);
    $block       = [];
    $typeBlock   = $options[0];
    $limit       = $options[1];
    $lenghtTitle = $options[2];
    $glossaireHelper      = Helper::getInstance();
    $categoriesHandler = $glossaireHelper->getHandler('Categories');
    $crCategories = new \CriteriaCompo();
    \array_shift($options);
    \array_shift($options);
    \array_shift($options);

    switch ($typeBlock) {
        case 'last':
        default:
            // For the block: categories last
            $crCategories->setSort('cat_date_update');
            $crCategories->setOrder('DESC');
            break;
        case 'new':
            // For the block: categories new
            // new since last week: 7 * 24 * 60 * 60 = 604800
            $crCategories->add(new \Criteria('cat_date_update', \time() - 604800, '>='));
            $crCategories->add(new \Criteria('cat_date_update', \time(), '<='));
            $crCategories->setSort('cat_date_update');
            $crCategories->setOrder('ASC');
            break;
        case 'hits':
            // For the block: categories hits
            $crCategories->setSort('cat_hits');
            $crCategories->setOrder('DESC');
            break;
        case 'top':
            // For the block: categories top
            $crCategories->setSort('cat_top');
            $crCategories->setOrder('ASC');
            break;
        case 'random':
            // For the block: categories random
            $crCategories->setSort('RAND()');
            break;
    }

    $crCategories->setLimit($limit);
    $categoriesAll = $categoriesHandler->getAll($crCategories);
    unset($crCategories);
    if (\count($categoriesAll) > 0) {
        foreach (\array_keys($categoriesAll) as $i) {
            $block[$i]['id'] = $categoriesAll[$i]->getVar('cat_id');
            $block[$i]['name'] = \htmlspecialchars($categoriesAll[$i]->getVar('cat_name'), ENT_QUOTES | ENT_HTML5);
            $block[$i]['description'] = \strip_tags($categoriesAll[$i]->getVar('cat_description'));
            $block[$i]['weight'] = \htmlspecialchars($categoriesAll[$i]->getVar('cat_weight'), ENT_QUOTES | ENT_HTML5);
            $block[$i]['logourl'] = $categoriesAll[$i]->getVar('cat_logourl');
            $block[$i]['colors_set'] = $categoriesAll[$i]->getVar('cat_colors_set');
            $block[$i]['count_entries'] = $categoriesAll[$i]->getVar('cat_count_entries');
            $block[$i]['date_creation'] = $categoriesAll[$i]->getVar('cat_date_creation');
            $block[$i]['date_update'] = $categoriesAll[$i]->getVar('cat_date_update');
        }
    }

    return $block;

}

/**
 * Function edit block
 * @param  $options
 * @return string
 */
function b_glossaire_categories_edit($options)
{
    require_once \XOOPS_ROOT_PATH . '/modules/glossaire/class/categories.php';
    $glossaireHelper = Helper::getInstance();
    $categoriesHandler = $glossaireHelper->getHandler('Categories');
    $GLOBALS['xoopsTpl']->assign('glossaire_upload_url', \GLOSSAIRE_UPLOAD_URL);
    $form = \_MB_GLOSSAIRE_DISPLAY;
    $form .= "<input type='hidden' name='options[0]' value='".$options[0]."' >";
    $form .= "<input type='text' name='options[1]' size='5' maxlength='255' value='" . $options[1] . "' >&nbsp;<br>";
    $form .= \_MB_GLOSSAIRE_TITLE_LENGTH . " : <input type='text' name='options[2]' size='5' maxlength='255' value='" . $options[2] . "' ><br><br>";
    \array_shift($options);
    \array_shift($options);
    \array_shift($options);

    $crCategories = new \CriteriaCompo();
    $crCategories->add(new \Criteria('cat_id', 0, '!='));
    $crCategories->setSort('cat_id');
    $crCategories->setOrder('ASC');
    $categoriesAll = $categoriesHandler->getAll($crCategories);
    unset($crCategories);
    $form .= \_MB_GLOSSAIRE_CATEGORIES_TO_DISPLAY . "<br><select name='options[]' multiple='multiple' size='5'>";
    $form .= "<option value='0' " . (!\in_array(0, $options) && !\in_array('0', $options) ? '' : "selected='selected'") . '>' . \_MB_GLOSSAIRE_ALL_CATEGORIES . '</option>';
    foreach (\array_keys($categoriesAll) as $i) {
        $cat_id = $categoriesAll[$i]->getVar('cat_id');
        $form .= "<option value='" . $cat_id . "' " . (!\in_array($cat_id, $options) ? '' : "selected='selected'") . '>' . $categoriesAll[$i]->getVar('cat_name') . '</option>';
    }
    $form .= '</select>';

    return $form;

}
