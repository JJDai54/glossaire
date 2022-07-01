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
public function getAlphaBarre($criteria, $url, $oldLetter, $catObj=null)
{
    global $glossaireHelper;
    
    if($catObj){
        $alphabarre          = $catObj->getVar('cat_alphabarre');
        $alphabarre_mode     = $catObj->getVar('cat_alphabarre_mode');
        $letter_css_default  = $catObj->getVar('cat_letter_css_default');
        $letter_css_selected = $catObj->getVar('cat_letter_css_selected');
        $letter_css_exist    = $catObj->getVar('cat_letter_css_exist');
        $letter_css_notexist = $catObj->getVar('cat_letter_css_notexist');
    }else{
        $alphabarre          = $glossaireHelper->getConfig('alphabarre');
        $alphabarre_mode     = $glossaireHelper->getConfig('alphabarre_mode');
        $letter_css_default  = $glossaireHelper->getConfig('letter_css_default');
        $letter_css_selected = $glossaireHelper->getConfig('letter_css_selected');
        $letter_css_exist    = $glossaireHelper->getConfig('letter_css_exist');
        $letter_css_notexist = $glossaireHelper->getConfig('letter_css_notexist');
    }
    
    $linkRefOk  = "<b><a href='{$url}' title='' alt=''><span class='letter-exist'>%s</span></a></b>";
    //$linkNoRef  = "<span>%s</span>";
    $linkNoRef  = "<span class='letter-notexist'>%s</span>";
    $linkOldRef = "<span class='letter-selected'>%s</span>";

    $oldLetter = strtoupper($oldLetter);
    $sql = "SELECT GROUP_CONCAT(DISTINCT(`ent_initiale`)) as comaList FROM " . $this->table
         . " " . $criteria->renderWhere();         
    $rst = $this->db->query($sql);  
    $arr = $this->db->fetchArray($rst)['comaList']; 

    if($arr)      
        $lettersfound = explode(',', $arr);
    else
        $lettersfound = array();
    //---------------------------------------------
    $lettersArr = array();

    $style="<style>\n"
    . ".letter-default span{{$letter_css_default}}\n"
    . ".letter-selected{{$letter_css_selected}}\n"
    . ".letter-exist{{$letter_css_exist}}\n"
    . ".letter-notexist{{$letter_css_notexist}}\n"
    ."</style>\n";
    //------------------------------------------------------
    $letterLink = '*';
    $letterVisible = _ALL;
        if($letterLink==$oldLetter)
            $lettersArr[] =  sprintf($linkOldRef, $letterVisible);
        else
            $lettersArr[] =  sprintf($linkRefOk, $letterLink, $letterVisible);
    
    //------------------------------------------------------
    for ($h = 0; $h < strlen($alphabarre); ++$h) {
        $letterVisible = $alphabarre[$h];
        $letterLink = ($letterVisible == GLOSSAIRE_CHIFFRES) ? '@' : $letterVisible;

        if (array_search($letterVisible, $lettersfound)!==false){
            if($letterVisible==$oldLetter)
                $lettersArr[] = sprintf($linkOldRef, $letterVisible); 
            else
                $lettersArr[] = sprintf($linkRefOk, $letterLink, $letterVisible); 
        }elseif ($alphabarre_mode == 1){
            $lettersArr[] = sprintf($linkNoRef, $letterVisible);
        }

    }

    return $style. "<span class='letter-default'>" . implode('', $lettersArr) . "</span>";
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
