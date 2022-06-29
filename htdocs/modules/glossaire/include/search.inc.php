<?php

//declare(strict_types=1);

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
 * glossaire_build_criteria_words construit les criteres de recherche sur le term et la définition
 * la fonction peut être appelée par la fonction de rechecher globale ou par la fonction du module
 * voir les préférence du module
 *
 * @param string $queryarray  string ou array selon l'appel global ou module
 * @param string $type     string replacement for any blank case
 * @return string $andor peut être vide, dans ce cas la r"echeche de "+" ou "|" dans $queryarray forcera 'OR' sinon 'AND'
 */
function glossaire_build_criteria_words($queryarray, $andor = '')
{

    if (!is_array($queryarray)){
        $exp = $queryarray;
//echo "===>exp : {$exp}<br>";
        $exp = str_ireplace('+', '|', $exp);
//echo "===>exp : {$exp}<br>";
        $h = strpos($exp, '|');
        if($andor == '') $andor =  ($h === false) ?  'AND' : 'OR';
    
        $exp = str_replace(',', '|', $exp);
        $exp = str_replace(' ', '|', $exp);
//echo "===>exp : {$exp}<br>";
        $queryarray = explode('|', $exp);
//echo "<hr><pre>" . print_r($queryarray, true) . "</pre><hr>";
// exit;       
    }
    $elementCount = \count($queryarray);
    if ($elementCount == 0) return null;


    $crKeywords = new \CriteriaCompo();
        
        for ($i = 0; $i  <  $elementCount; $i++) {
            $crKeyword = new \CriteriaCompo();
            $crKeyword->add(new \Criteria('ent_term', "%{$queryarray[$i]}%",'LIKE'),'OR');
            $crKeyword->add(new \Criteria('ent_shortdef', "%{$queryarray[$i]}%",'LIKE'),'OR');
            $crKeyword->add(new \Criteria('ent_definition', "%{$queryarray[$i]}%",'LIKE'),'OR');
            $crKeyword->add(new \Criteria('ent_reference', "%{$queryarray[$i]}%",'LIKE'),'OR');
// a voir ajout du nom du fichier dans la recherche
//ent_file_name


            $crKeywords->add($crKeyword, $andor);
            unset($crKeyword);
            
        }
    return $crKeywords;
}
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
    $glossaireHelper = \XoopsModules\Glossaire\Helper::getInstance();
    $categoriesHandler = $glossaireHelper->getHandler('Categories');
    //$catIdsAllowes = $categoriesHandler->getIdsAllowed();
	$catAllowed = $categoriesHandler->getListAllowed('view');
    $catIdsAllowes = implode(',', array_keys($catAllowed));
        
    // search in table entries
    // search keywords
    $elementCount = 0;
    $entriesHandler = $glossaireHelper->getHandler('Entries');
    if (\is_array($queryarray)) {
        $elementCount = \count($queryarray);
    }
/*
    if ($elementCount > 0) {
        $crKeywords = new \CriteriaCompo();
        
        for ($i = 0; $i  <  $elementCount; $i++) {
            $crKeyword = new \CriteriaCompo();
            $crKeyword->add(new \Criteria('ent_term', "%{$queryarray[$i]}%",'LIKE'),'OR');
            $crKeyword->add(new \Criteria('ent_shortdef', "%{$queryarray[$i]}%",'LIKE'),'OR');
            $crKeyword->add(new \Criteria('ent_definition', "%{$queryarray[$i]}%",'LIKE'),'OR');
            $crKeyword->add(new \Criteria('ent_reference', "%{$queryarray[$i]}%",'LIKE'),'OR');

            $crKeywords->add($crKeyword, $andor);
            unset($crKeyword);
            
        }
    }
*/
    $crKeywords = glossaire_build_criteria_words($queryarray, $andor, $catIdSelect=null);
    
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
    $crSearch->add(new \Criteria('ent_cat_id', "({$catIdsAllowes})",'IN'), 'AND');
    
    if (isset($crKeywords)) {
        $crSearch->add($crKeywords, 'AND');
    }
    if (isset($crUser)) {
        $crSearch->add($crUser, 'AND');
    }
    
    if ($catIdSelect) $crSearch->add(new \Criteria('ent_cat_id', $catIdSelect, '='), 'AND');
    
    $crSearch->setStart($offset);
    $crSearch->setLimit($limit);
    $crSearch->setSort('ent_cat_id,ent_date_update');
    $crSearch->setOrder('DESC');
    $entriesAll = $entriesHandler->getAll($crSearch);

    $showId = $glossaireHelper->getConfig('showId');    
    $title1   = (($showId) ? "[#%1\$s/#%2\$s] - " : '') . "%3\$s : %4\$s";
    $title2   = (($showId) ? "[#%1\$s/#%2\$s] - " : '') . "%3\$s";
    $catTitle = (($showId) ? "[#%1\$s] - " : '')        . "%2\$s";
    
    $exp = implode(',', $queryarray);
    $link = "entries.php?op=list&catIdSelect=%s&ent_id=%s&exp2search={$exp}&sender=xoops&letter=%s&start=0#entry-%s";
    $catLink = "entries.php?catIdSelect=%s";
    $cuttentId = 0;
    
    foreach (\array_keys($entriesAll) as $i) {
        $catId = $entriesAll[$i]->getVar('ent_cat_id');
        if($cuttentId != $catId){
          $ret[] = [
              'image'  => 'assets/icons/16/detail.png',
              'link'   => sprintf($catLink, $catId),
              'title'  => sprintf($catTitle, $catId, $catAllowed[$catId], "eeee") ,
              'time'   => ''
          ];
          $cuttentId = $catId;
        }
        
        if($entriesAll[$i]->getVar('ent_shortdef')){
            $title = sprintf($title1,$entriesAll[$i]->getVar('ent_cat_id'),$entriesAll[$i]->getVar('ent_id'),$entriesAll[$i]->getVar('ent_term'),$entriesAll[$i]->getVar('ent_shortdef'));
        }else{
            $title = sprintf($title2,$entriesAll[$i]->getVar('ent_cat_id'),$entriesAll[$i]->getVar('ent_id'),$entriesAll[$i]->getVar('ent_term'));
        }

        $ret[] = [
            'image'  => 'assets/icons/16/entries.png',
            'link'   => sprintf($link,$entriesAll[$i]->getVar('ent_cat_id'),$entriesAll[$i]->getVar('ent_id'),$entriesAll[$i]->getVar('ent_initiale'),$entriesAll[$i]->getVar('ent_id'))  ,
            'title'  => str_repeat('-', 5) . $title,
            'time'   => $entriesAll[$i]->getVar('ent_date_update')
        ];
    }
    unset($crKeywords);
    unset($crKeyword);
    unset($crUser);
    unset($crSearch);

    return $ret;

}
