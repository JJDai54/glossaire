<?php

declare(strict_types=1);


namespace XoopsModules\Glossaire;

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
 * Class Object Handler Entries
 */
class EntriesHandler extends \XoopsPersistableObjectHandler
{
    /**
     * Constructor
     *
     * @param \XoopsDatabase $db
     */
    public function __construct(\XoopsDatabase $db)
    {
        parent::__construct($db, 'glossaire_entries', Entries::class, 'ent_id', 'ent_cat_id');
    }

    /**
     * @param bool $isNew
     *
     * @return object
     */
    public function create($isNew = true)
    {
        return parent::create($isNew);
    }

    /**
     * retrieve a field
     *
     * @param int $i field id
     * @param null fields
     * @return \XoopsObject|null reference to the {@link Get} object
     */
    public function get($i = null, $fields = null)
    {
        return parent::get($i, $fields);
    }

    /**
     * get inserted id
     *
     * @param null
     * @return int reference to the {@link Get} object
     */
    public function getInsertId()
    {
        return $this->db->getInsertId();
    }

    /**
     * Get Count Entries in the database
     * @param int    $start
     * @param int    $limit
     * @param string $sort
     * @param string $order
     * @return int
     */
    public function getCountEntries($criteria=null, $start = 0, $limit = 0, $sort = 'ent_id ASC, ent_cat_id', $order = 'ASC')
    {
        if (!$criteria) $criteria = new \CriteriaCompo();
        $crCountEntries = $this->getEntriesCriteria($criteria, $start, $limit, $sort, $order);
        return $this->getCount($crCountEntries);
    }

    /**
     * Get All Entries in the database
     * @param int    $start
     * @param int    $limit
     * @param string $sort
     * @param string $order
     * @return array
     */
    public function getAllEntries($criteria=null, $start = 0, $limit = 0, $sort = 'ent_term ASC, ent_id', $order = 'ASC')
    {
        if (!$criteria) $criteria = new \CriteriaCompo();
        $crAllEntries = $this->getEntriesCriteria($criteria, $start, $limit, $sort, $order);
        return $this->getAll($crAllEntries);
    }

    /**
     * Get Criteria Entries
     * @param        $crEntries
     * @param int    $start
     * @param int    $limit
     * @param string $sort
     * @param string $order
     * @return int
     */
    private function getEntriesCriteria($crEntries, $start, $limit, $sort, $order)
    {
        $crEntries->setStart($start);
        $crEntries->setLimit($limit);
        $crEntries->setSort($sort);
        $crEntries->setOrder($order);
        return $crEntries;
    }
    
    // -------------------------function JJD
    /**
     * @return array
     */
public function getAlphaBarre($criteria, $url, $oldLetter, $margin="3px")
{
    $linkRefOk  = "<b><a href='{$url}' title='' alt=''><span class='letter-all letter-exist'>%s</span></a></b>";
    $linkNoRef  = "<span class='letter-all letter-notexist'>%s</span>";
    $linkOldRef = "<span class='letter-all letter-selected'>%s</span>";

    $oldLetter = strtoupper($oldLetter);
    $sql = "SELECT GROUP_CONCAT(DISTINCT(`ent_initiale`)) as comaList FROM " . $this->table
         . " " . $criteria->renderWhere();         
    $rst = $this->db->query($sql);         
    $lettersfound = explode(',', $this->db->fetchArray($rst)['comaList']);
     
    $lettersArr = array();

    $style="<style>"
    . ".letter-all{margin-left:{$margin};margin-right:{$margin};}"
    . ".letter-selected{font-weight:bold;color:red;text-decoration:underline;underline red}"
    . ".letter-exist{font-weight:bold;}"
    . ".letter-notexist{color: #bfc9ca;}"
    ."</style>";
    //------------------------------------------------------
    $letterLink = '*';
    $letterVisible = _ALL;
        if($letterLink==$oldLetter)
            $lettersArr[] =  sprintf($linkOldRef, $letterVisible);
        else
            $lettersArr[] =  sprintf($linkRefOk, $letterLink, $letterVisible);
    
    //------------------------------------------------------
    for ($h = 0; $h < strlen(_GLS_ALPHABARRE); ++$h) {
        $letterVisible = _GLS_ALPHABARRE[$h];
        $letterLink = ($letterVisible=='#') ? '@' : $letterVisible;

        if (array_search($letterVisible, $lettersfound)!==false){
            if($letterVisible==$oldLetter)
                $lettersArr[] = sprintf($linkOldRef, $letterVisible); 
            else
                $lettersArr[] = sprintf($linkRefOk, $letterLink, $letterVisible); 
        }else{
            $lettersArr[] = sprintf($linkNoRef, $letterVisible);
        }

    }

    return $style . implode('', $lettersArr);
}
public function getAlphaBarre_old($catId, $url, $oldLetter, $status=GLOSSAIRE_STATUS_APPROVED, $margin="3px")
{
    $oldLetter = strtoupper($oldLetter);
    $sql = "SELECT GROUP_CONCAT(DISTINCT(`ent_initiale`)) as comaList FROM " . $this->table
         . " WHERE ent_cat_id={$catId} AND ent_status={$status}";         
    $rst = $this->db->query($sql);         
    $lettersfound = explode(',', $this->db->fetchArray($rst)['comaList']);
     
    $lettersArr = array();
    $link = "<b><a href='{$url}' title='' alt=''>%s</a></b>";

    $style="<style>"
    . ".letter-all{margin-left:{$margin};margin-right:{$margin};}"
    . ".letter-selected{font-weight:bold;color:red;text-decoration:underline;underline red}"
    . ".letter-exist{font-weight:bold;}"
    . ".letter-notexist{color: #bfc9ca;}"
    ."</style>";
    //------------------------------------------------------
    $letter = '*';
    $all = _ALL;
        if($letter==$oldLetter)
            $lettersArr[] = sprintf($link, $letter, "<span class='letter-all letter-selected''>{$all}</span>"); 
        else
            $lettersArr[] = sprintf($link, $letter, "<span class='letter-all letter-exist''>{$all}</span>"); 
    
    //------------------------------------------------------
    for ($h = 0; $h < strlen(_GLS_ALPHABARRE); ++$h) {
        $letter = _GLS_ALPHABARRE[$h];
        $letter2 = ($letter=='#') ? '@' : $letter;

        if (array_search($letter, $lettersfound)!==false){
            if($letter==$oldLetter)
                $lettersArr[] = sprintf($link, $letter2, "<span class='letter-all letter-selected'>{$letter}</span>"); 
            else
                $lettersArr[] = sprintf($link, $letter2, "<span class='letter-all letter-exist'>{$letter}</span>"); 
        }else{
            $lettersArr[] = "<span class='letter-all letter-notexist'>{$letter}</span>";
        }

    }

    return $style . implode('', $lettersArr);
}
    /**
     * @return new bool
     */
function changeStatus($entId, $newStatus = null){
    if ($newStatus === null){
      $sql = "UPDATE " . $this->table 
           . " SET ent_status=mod(ent_status+1,3)"
           . " WHERE ent_id={$entId};";
    }else{
      $sql = "UPDATE " . $this->table 
           . " SET ent_status=${$newStatus}"
           . " WHERE ent_id={$entId};";
    }
    $ret = $this->db->queryf($sql);
    return $ret;
}   
 
    /**
     * @return new bool
     */
function incrementeField($entId, $fldName, $modMax = 2, $newStatus = null){
    if ($newStatus === null){
      $sql = "UPDATE " . $this->table 
           . " SET {$fldName}=mod({$fldName}+1,{$modMax})"
           . " WHERE ent_id={$entId};";
    }else{
      $sql = "UPDATE " . $this->table 
           . " SET {$fldName}=${$newStatus}"
           . " WHERE ent_id={$entId};";
    }
    $ret = $this->db->queryf($sql);
    return $ret;
}    

/* ******************************
 * renvoie la valeur maxmum d'un champ pour un idParent 
 * *********************** */
public function getMax($field = "cat_weight", $cat_id_parent = null)

{
    $sql = "SELECT max({$field}) AS valueMax FROM {$this->table}";
    if($cat_id_parent > 0) $sql .= " WHERE cat_id_parent = {$cat_id_parent}";
    
    $rst = $this->db->query($sql);
    $arr = $this->db->fetchArray($rst);
    return $arr['valueMax'];
}
    
/* ******************************
 * incremente le compteur pour la selection
 * *********************** */
public function incrementCounter($criteria=null, $fldName='ent_counter'){
    $sql = "UPDATE {$this->table} SET {$fldName} = {$fldName}+1";
    if ($criteria) $sql .= " " . $criteria->renderWhere(); 
    $this->db->queryf($sql);
}

/**
 * Get Count Entries in the database
 * @param int    $start
 * @param int    $limit
 * @param string $sort
 * @param string $order
 * @return int
 */
public function getCountOnCategory($catId, $status = GLOSSAIRE_STATUS_APPROVED)
{
    $crCountEntries = new \CriteriaCompo(new \Criteria('ent_cat_id', $catId, "="));
    if ($status >= 0) $crCountEntries->add(new \Criteria('ent_status', $status, '='));

    return $this->getCountEntries($crCountEntries);
}

} // FIN dela CLASS
