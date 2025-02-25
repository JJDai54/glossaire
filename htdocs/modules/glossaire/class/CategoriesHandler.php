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
 * @author        Jean-Jacques DELALANDRE - Email:<jjdelalandre@orange.fr> - Website:<xoopsfr.kiolo.fr>
 */

use XoopsModules\Glossaire;


/**
 * Class Object Handler Categories
 */
class CategoriesHandler extends \XoopsPersistableObjectHandler
{
    /**
     * Constructor
     *
     * @param \XoopsDatabase $db
     */
    public function __construct(\XoopsDatabase $db)
    {
        parent::__construct($db, 'glossaire_categories', Categories::class, 'cat_id', 'cat_name');
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
     * Get Count Categories in the database
     * @param int    $start
     * @param int    $limit
     * @param string $sort
     * @param string $order
     * @return int
     */
    public function getCountCategories($crCountCategories = null, $start = 0, $limit = 0, $sort = 'cat_id ASC, cat_name', $order = 'ASC')
    {
        if (!$crCountCategories) $crCountCategories = new \CriteriaCompo();
        $crCountCategories = $this->getCategoriesCriteria($crCountCategories, $start, $limit, $sort, $order);
        return $this->getCount($crCountCategories);
    }

    /**
     * Get All Categories in the database
     * @param int    $start
     * @param int    $limit
     * @param string $sort
     * @param string $order
     * @return array
     */
    public function getAllCategories($crAllCategories = null, $start = 0, $limit = 0, $sort = 'cat_weight,cat_id ASC, cat_name', $order = 'ASC')
    {
        if (!$crAllCategories) $crAllCategories = new \CriteriaCompo();
        $crAllCategories = $this->getCategoriesCriteria($crAllCategories, $start, $limit, $sort, $order);
        return $this->getAll($crAllCategories);
    }

    /**
     * Get Criteria Categories
     * @param        $crCategories
     * @param int    $start
     * @param int    $limit
     * @param string $sort
     * @param string $order
     * @return int
     */
    private function getCategoriesCriteria($crCategories, $start, $limit, $sort, $order)
    {
        $crCategories->setStart($start);
        $crCategories->setLimit($limit);
        $crCategories->setSort($sort);
        $crCategories->setOrder($order);
        return $crCategories;
    }
    
// **********************************************************************    
// ////////////////////////// functions JJD /////////////////////////////
// **********************************************************************    

/* ******************************
 * Update weight
 * *********************** */
 function updateWeight($catId, $action, $step = 10){
 global $xoopsDB;
 $table = $this->table;
 $fldWeight = 'cat_weight';
 $fldId = 'cat_id';
 $order = "{$fldWeight},{$fldId}";
 
 
         switch ($action){
            case 'up'; 
              $newValue = "{$fldWeight} = {$fldWeight}-{$step}-1";
              break;

            case 'down'; 
              $newValue = "{$fldWeight} = {$fldWeight}+{$step}+1";
            break;

            case 'first'; 
              $newValue = "{$fldWeight} = -99999";
            break;

            case 'last'; 
              $newValue = "{$fldWeight} = 99999";
            break;
            
         }
         
    $firstWeight = $step;
    $sql = "SET @rank={$firstWeight};";
    $result = $xoopsDB->queryf($sql);

    $sql = "UPDATE {$table} SET {$fldWeight} = (@rank:=@rank+{$step}) ORDER BY {$order};";    
    $result = $xoopsDB->queryf($sql);
    //----------------------------------------------------------
    $sql = "UPDATE {$table} SET {$newValue} WHERE {$fldId}={$catId}"; 
    $xoopsDB->queryf($sql);
    //----------------------------------------------------------
    
    $firstWeight = $step;
    $sql = "SET @rank={$firstWeight};";
    $result = $xoopsDB->queryf($sql);

    $sql = "UPDATE {$table} SET {$fldWeight} = (@rank:=@rank+{$step}) ORDER BY {$order};";    
    $result = $xoopsDB->queryf($sql);

 }

	/**
     * Fonction qui liste les cats qui respectent la permission demandée
     * @param string   $permtype	Type de permission
     * @return array   $cat		    Liste des catégorie qui correspondent à la permission
     */
	public function getPermissions($short_permtype = 'view_cats')
    {global $clPerms;
        return $clPerms->getIdsPermissions($short_permtype);
    }

	/**
     * getStatus renvoie les tatus qui défini le type d'accès aau formulaire des sefinition
     * @param catId   iod de la catétogrie
     * @return int  
     *          0 : Aucune permission
     *          1 : permet de soumettre une définition, certain champs seront masqué ou inaccessible
     *          2 : permet d'approuver. Full acces au formulaire
     */
	public function getStatusAccess($catId){
    
    $tPerms = array_flip($this->getPermissions('approve_entries'));
    //echo "<hr>catId : {$catId}<pre>" . print_r($tPerms, true) . "</pre><hr>";
    if (array_key_exists($catId, $tPerms)) return 2;
  
    $tPerms =  array_flip($this->getPermissions('submit_entries'));
    //echo "<hr>catId : {$catId}<pre>" . print_r($tPerms, true) . "</pre><hr>";
    if (array_key_exists($catId, $tPerms)) return 1;
    
    return 0;
    
}

	/**
     * Fonction qui liste les catégories qui respectent la permission demandée
     * @param string   $permtype	Type de permission
     * @return array   $cat		    Liste des catégorie qui correspondent à la permission
     */
    
	public function getAllCatAllowed($short_permtype, $criteria, $sort='cat_weight,cat_name,cat_id', $order="ASC")
    {global $clPerms;
    //include_once (XOOPS_ROOT_PATH . "/Frameworks/janus/class/Permissions.php");
     if (!$clPerms) $clPerms = new \JanusPermissions('glossaire');
    //echo "<hr>getAllCatAllowed : $short_permtype = {$short_permtype}<hr>";
        $clPerms->addPermissions($criteria, 'view_cats', 'cat_id');
        
        $criteria->add(new \Criteria('cat_active',"1",'='));
        if ($sort != '') $criteria->setSort($sort);
        if ($order  != '') $criteria->setOrder($order);

        $allEnrAllowed = $this->getAll($criteria);
        return $allEnrAllowed;
    }

	public function getIdsAllowed($short_permtype = 'view_cats')
    {
        $tPerm = $this->getPermissions($short_permtype);
        return join(',', $tPerm);
    }
    
	public function getAllAllowed($short_permtype = 'view_cats', $criteria = null, $start = 0, $limit = 0, $sort='cat_weight,cat_name,cat_id', $order="ASC",$zzz=false)
    {
        $categoriesAll = $this->getAllCatAllowed($short_permtype, $criteria, $sort, $order);
        $catArr = [];
        
        foreach (\array_keys($categoriesAll) as $i) {
            //$catArr[] = $categoriesAll[$i]->getValuesCategories();
            $catArr[$categoriesAll[$i]->getVar('cat_id')] = $categoriesAll[$i]->getValuesCategories();
        }
//echoArray($allEnrAllowed) ;       
        if ($zzz) exit;
        return $catArr;

    }
    
	public function getAlPermsByCatId(&$categoriesAll){
    global $clPerms;
        foreach (\array_keys($categoriesAll) as $i) {
            $catId = $categoriesAll[$i]->getVar('cat_id');
            $tPerms[$catId] = $clPerms->getPermNames(GLOSSAIRE_PERM_MANCATS);
            //$tPerms[$catId]['name'] = $categoriesAll[$i]->getVar('cat_name');
        }
//echoArray($tPerms);
        return $tPerms; 
    }

	/**
     * Fonction qui liste les catégories qui respectent la permission demandée
     * @param string   $permtype	Type de permission
     * @return array   $cat		    Liste des catégorie qui correspondent à la permission
     */
	public function isCatAllowed($idCat, $short_permtype = 'submit')
    {
        $tPerm = $this->getPermissions($short_permtype);
        return (!(array_search($idCat, $tPerm) === false));
    }

	/**
     * Fonction crée une nouvelle catégorie
     * @param string   $permtype	Type de permission
     * @return int   $catId		    Renvoie le nouvel id de la catégorie
     */
public function getNewCategory($name, &$categoriesObj = null){
global $utility;
    $categoriesObj = $this->create();
	$categoriesObj->setVar('cat_name', $name);
	$categoriesObj->setVar('cat_upload_folder', \JANUS\sanityseNameForFile($name));
	$categoriesObj->setVar('cat_weight',  $this->getMax('cat_weight')+10);
	$categoriesObj->setVar('cat_date_creation', \JANUS\getSqlDate());

    if ($this->insert($categoriesObj)) {
        $newCatId = $categoriesObj->getNewInsertedIdCategories();
    }else{
        $newCatId = 0;
        exit("Erreur catId : {$newCatId}");
    }
    return $newCatId;
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
 * renvoie lle nombre d'entrées par categorie et status 
 * *********************** */
public function getStatistiques(){
global $entriesHandler;
    
    $catList = $this->getList();
    $status = array(GLOSSAIRE_STATUS_ALL      => _AM_GLOSSAIRE_TOTAL,
                    GLOSSAIRE_STATUS_INACTIF  => _AM_GLOSSAIRE_CATEGORY_STATUS_INATIF,
                    GLOSSAIRE_PROPOSITION     => _AM_GLOSSAIRE_CATEGORY_STATUS_PROPOSITION,
                    GLOSSAIRE_STATUS_APPROVED => _AM_GLOSSAIRE_CATEGORY_STATUS_APPROVED);
    $arr = array();
    foreach($catList AS $catId=>$name){
        foreach($status AS $statusId=>$statusName){
            $arr[$catId][$statusId] = $entriesHandler->getCountOnCategory($catId, $statusId);
        }
    }

// echo "<hr><pre>catList" . print_r($catList, true) . "</pre><hr>";
// echo "<hr><pre>arr" . print_r($arr, true) . "</pre><hr>";
    
    //--------------------------------------
    $tr = "<tr><td>%s</td><td class='gls_stat'>%s</td><td class='gls_stat'>%s</td><td class='gls_stat'>%s</td><td class='gls_stat'>%s</td></tr>";
    $link = "<a href='entries.php?catIdSelect=%s&statusIdSelect=%s' title=''>%s</a>";
    $htmlArr = array();
    $htmlArr[] = sprintf($tr, '', 
                              $status[GLOSSAIRE_STATUS_ALL], 
                              $status[GLOSSAIRE_STATUS_INACTIF], 
                              $status[GLOSSAIRE_PROPOSITION], 
                              $status[GLOSSAIRE_STATUS_APPROVED]);
   
                           
    foreach($catList AS $catId=>$name){
        $htmlArr[] = sprintf($tr, sprintf($link, $catId, GLOSSAIRE_STATUS_ALL, $name), 
                                  sprintf($link, $catId, GLOSSAIRE_STATUS_ALL,      $arr[$catId][GLOSSAIRE_STATUS_ALL]),                                   
                                  sprintf($link, $catId, GLOSSAIRE_STATUS_INACTIF,  $arr[$catId][GLOSSAIRE_STATUS_INACTIF]), 
                                  sprintf($link, $catId, GLOSSAIRE_PROPOSITION,     $arr[$catId][GLOSSAIRE_PROPOSITION]), 
                                  sprintf($link, $catId, GLOSSAIRE_STATUS_APPROVED, $arr[$catId][GLOSSAIRE_STATUS_APPROVED]));
    }
//echo "<hr><pre>" . print_r($htmlArr, true) . "</pre><hr>";
    $html = "<div><style>.gls_stat{text-align:center;}</style><table>" .  implode("\n", $htmlArr) . "</table></div>";
    return $html;
}    
    
    
}
