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

/**
 * comment callback functions
 *
 * @param  $category
 * @param  $item_id
 * @return array item|null
 */
function glossaire_notify_iteminfo($category, $item_id)
{
    global $xoopsDB;

    if (!\defined('GLOSSAIRE_URL')) {
        \define('GLOSSAIRE_URL', \XOOPS_URL . '/modules/glossaire');
    }

    switch ($category) {
        case 'global':
            $item['name'] = '';
            $item['url']  = '';
            return $item;
            break;
        case 'categories':
            $sql          = 'SELECT cat_name FROM ' . $xoopsDB->prefix('glossaire_categories') . ' WHERE cat_id = '. $item_id;
            $result       = $xoopsDB->query($sql);
            $result_array = $xoopsDB->fetchArray($result);
            $item['name'] = $result_array['cat_name'];
            $item['url']  = \GLOSSAIRE_URL . '/categories.php?cat_id=' . $item_id;
            return $item;
            break;
        case 'entries':
            $sql          = 'SELECT ent_cat_id FROM ' . $xoopsDB->prefix('glossaire_entries') . ' WHERE ent_id = '. $item_id;
            $result       = $xoopsDB->query($sql);
            $result_array = $xoopsDB->fetchArray($result);
            $item['name'] = $result_array['ent_cat_id'];
            $item['url']  = \GLOSSAIRE_URL . '/entries.php?ent_id=' . $item_id;
            return $item;
            break;
    }
    return null;
}
