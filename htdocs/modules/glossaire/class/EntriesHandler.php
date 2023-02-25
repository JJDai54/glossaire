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
 * @author        Jean-Jacques DELALANDRE - Email:<jjdelalandre@orange.fr> - Website:<jubile.fr>
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
     * retrieve a field
     *
     * @param int $i field id
     * @param null fields
     * @return \arrat|null reference to the {@link Get} object
     */
    public function getArray($i = null, $fields = null)
    {
        $catObj =  parent::get($i, $fields);
        if($catObj){
          return $catObj->getValuesCategories();
        }else{
            return null;
        }
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
public function getAlphaBarre($criteria, $url, $oldLetter, $catArr)
{
    global $glossaireHelper;
/*
    if($catObj){
        $alphabarre          = $catObj->getVar('cat_alphabarre');
        $alphabarre_mode     = $catObj->getVar('cat_alphabarre_mode');
    }else{
        $alphabarre          = $glossaireHelper->getConfig('alphabarre');
        $alphabarre_mode     = $glossaireHelper->getConfig('alphabarre_mode');
    }
*/    
        $alphabarre      = $catArr['cat_alphabarre'];
        $alphabarre_mode = $catArr['cat_alphabarre_mode'];
    
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
echoArray($catArr['css']);
    $style="<style>\n"
    . ".letter-default span{{$catArr['css']['gls_letter_default']}}\n"
    . ".letter-selected{{$catArr['css']['gls_letter_seleced']}}\n"
    . ".letter-exist{{$catArr['css']['gls_letter_exist']}}\n"
    . ".letter-notexist{{V['css']['gls_letter_empty']}}\n"
    ."</style>\n";
    //------------------------------------------------------
$temp = str_replace('<', '[', $style);    
$temp = str_replace('>', ']', $temp);    
echo "<hr><pre><code>{$temp}</code></pre><hr>";    
    //------------------------------------------------------
    for ($h = 0; $h < strlen($alphabarre); ++$h) {
        $letterVisible = $alphabarre[$h];
        $letterLink = ($letterVisible == GLOSSAIRE_CHIFFRES) ? '@' : $letterVisible;

        if (array_search($letterVisible, $lettersfound) !== false){
            if($letterVisible==$oldLetter)
                $lettersArr[] = sprintf($linkOldRef, $letterVisible); 
            else
                $lettersArr[] = sprintf($linkRefOk, $letterLink, $letterVisible); 
        }elseif ($letterVisible == '|'){
            //ajout d'un retour a la ligne quand la lettre est un '|'     (barre verticale)
            $lettersArr[] = '<br>';   
        }elseif ($letterVisible == '*'){
            //ajout de 'tout' quand la lettre est une '*'
            $letterLink = '*';
            $letterVisible = _ALL;
                if($letterLink==$oldLetter)
                    $lettersArr[] =  sprintf($linkOldRef, $letterVisible);
                else
                    $lettersArr[] =  sprintf($linkRefOk, $letterLink, $letterVisible);
            
        }elseif ($alphabarre_mode == 1){
            $lettersArr[] = sprintf($linkNoRef, $letterVisible);
        } // else{exit;}

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
           . " SET ent_status={$newStatus}"
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
           . " SET {$fldName}={$newStatus}"
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
public function incrementCounter($criteria=null, $sort='ent_term', $start=0, $limit=0, $fldName='ent_counter'){

    $sqlSelect = "SELECT ent_id FROM {$this->table}";
    if ($criteria) $sqlSelect .= " " . $criteria->renderWhere(); 
    if ($limit != 0) $sqlSelect .= " ORDER BY {$sort} LIMIT {$start},{$limit}";
    //-------------------------------------------------
    $sql = "UPDATE {$this->table} SET {$fldName} = {$fldName}+1"
. " WHERE ent_id IN (SELECT ent_id FROM ({$sqlSelect})tmp)";    
    $this->db->queryf($sql);


/*
UPDATE table_name SET name='test'
WHERE id IN (
    SELECT id FROM (
        SELECT id FROM table_name 
        ORDER BY id ASC  
        LIMIT 0, 10
    ) tmp
exit ($sql);
)
*/
}

/* ******************************
 * met à jour le compteur avev $value pour la catégorie $catId
 * *********************** */
public function RazCounters($catId, $newValue=0){
    $sql = "UPDATE {$this->table} SET ent_counter = {$newValue} WHERE ent_cat_id={$catId}";
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
