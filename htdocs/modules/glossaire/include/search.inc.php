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


/**
 * search callback functions
 *
 * @param $queryarray
 * @param $andor
 * @param $limit
 * @param $offset
 * @param $userid
 * @return array $itemIds
 */
function glossaire_search($queryarray, $andor, $limit, $offset, $userid)
{
    $ret = [];
    $helper = \XoopsModules\Glossaire\Helper::getInstance();

    // search in table entries
    // search keywords
    $elementCount = 0;
    $entriesHandler = $helper->getHandler('Entries');
    if (\is_array($queryarray)) {
        $elementCount = \count($queryarray);
    }
    if ($elementCount > 0) {
        $crKeywords = new \CriteriaCompo();
        for ($i = 0; $i  <  $elementCount; $i++) {
            $crKeyword = new \CriteriaCompo();
            unset($crKeyword);
        }
    }
    // search user(s)
    if ($userid && \is_array($userid)) {
        $userid = array_map('\intval', $userid);
        $crUser = new \CriteriaCompo();
        $crUser->add(new \Criteria('ent_submitter', '(' . \implode(',', $userid) . ')', 'IN'), 'OR');
    } elseif (is_numeric($userid) && $userid > 0) {
        $crUser = new \CriteriaCompo();
        $crUser->add(new \Criteria('ent_submitter', $userid), 'OR');
    }
    $crSearch = new \CriteriaCompo();
    if (isset($crKeywords)) {
        $crSearch->add($crKeywords, 'AND');
    }
    if (isset($crUser)) {
        $crSearch->add($crUser, 'AND');
    }
    $crSearch->setStart($offset);
    $crSearch->setLimit($limit);
    $crSearch->setSort('ent_date_update');
    $crSearch->setOrder('DESC');
    $entriesAll = $entriesHandler->getAll($crSearch);
    foreach (\array_keys($entriesAll) as $i) {
        $ret[] = [
            'image'  => 'assets/icons/16/entries.png',
            'link'   => 'entries.php?op=show&amp;ent_id=' . $entriesAll[$i]->getVar('ent_id'),
            'title'  => $entriesAll[$i]->getVar('ent_cat_id'),
            'time'   => $entriesAll[$i]->getVar('ent_date_update')
        ];
    }
    unset($crKeywords);
    unset($crKeyword);
    unset($crUser);
    unset($crSearch);

    return $ret;

}
