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

use Xmf\Request;
use XoopsModules\Glossaire;
use XoopsModules\Glossaire\Constants;
use XoopsModules\Glossaire\Common;
require __DIR__ . '/header.php';
// Get all request values
$op = Request::getCmd('op', 'list');
$entId = Request::getInt('ent_id');
$catIdSelect = Request::getInt('catIdSelect',0);
$statusIdSelect = Request::getInt('statusIdSelect', GLOSSAIRE_STATUS_ALL);
$sortIdSelect = Request::getInt('sortIdSelect', 0);
$addNew = (Request::getCmd('submit_and_addnew', 'no') == 'no') ? false : true;

$start = Request::getInt('start', 0);
//$limit = Request::getInt('limit', $glossaireHelper->getConfig('adminpager'));
$limit = $glossaireHelper->getConfig('adminpager');
if ($limit == 0) $limit = $glossaireHelper->getConfig('adminpager');

// utilise notamment par pagenav
// $gepeto = ['catIdSelect'     => Request::getInt('catIdSelect'),
//            'statusIdSelect'  => Request::getInt('statusIdSelect',GLOSSAIRE_STATUS_ALL),
//            'sortIdSelect'    => Request::getInt('sortIdSelect',0)
//            ];
// $gp = '';
// foreach ($gepeto as $key=>$v){
//     $gp .= "&{$key}={$v}";
// }
//echo "===>gp : {$gp}<br>";


// $gp=array_merge($_GET, $_POST);
// 
// echo "<hr><pre>" . print_r($gp, true) . "</pre><hr>";
// echo "<hr><pre>" . print_r($_FILES, true) . "</pre><hr>";


//if (!$limit)$limit=15;
$GLOBALS['xoopsTpl']->assign('start', $start);
$GLOBALS['xoopsTpl']->assign('limit', $limit);
$GLOBALS['xoopsTpl']->assign('statusIdSelect', $statusIdSelect);
$utility = new \XoopsModules\Glossaire\Utility();

switch (strtolower($op)) {
    case 'list':
    default:
    case 'new':
    case 'clone':
    case 'save':   //exit;
    case 'edit':
    case 'delete':
        include_once("entries-{$op}.php");
        break;
        
    case 'changestatus':
        //$entriesHandler->changeStatus($entId);
        $entriesHandler->incrementeField($entId, 'ent_status', 3);
        \redirect_header("entries.php?op=list&catIdSelect={$catIdSelect}&start={$start}&limit={$limit}&statusIdSelect={$statusIdSelect}" , 2, \_AM_GLOSSAIRE_FORM_OK);
        break;
        
        
    case 'incrementfield':
        //$entriesHandler->changeStatus($entId);
        $fldName = Request::getString('field', $glossaireHelper->getConfig('adminpager'));
        $entriesHandler->incrementeField($entId, $fldName, 2);
        \redirect_header("entries.php?op=list&catIdSelect={$catIdSelect}&start={$start}&limit={$limit}&statusIdSelect={$statusIdSelect}" , 2, \_AM_GLOSSAIRE_FORM_OK);
        break;
        
    case 'cleancatfolders':
        $fldPath =  Request::getString('fldPath', '');
        $fldName =  Request::getString('fldName', '');
        $folder  =  Request::getString('folder', '');
        $stat = $utility->cleanCatFolders($catIdSelect, $fldPath, $fldName, $folder, 1, 1);     
        $msg = sprintf(_AM_GLOSSAIRE_CLEAN_ENTRIES_IMAGES_OK, $stat[1], $stat[2], $catIdSelect);    
        //exit("<hr>{$folder} - {$fldName} - {$msg}<hr>" );
        \redirect_header("entries.php?op=list&catIdSelect={$catIdSelect}&start={$start}&limit={$limit}&statusIdSelect={$statusIdSelect}" , 2, $msg);
        break;

    case 'razcounter':
        $entriesHandler->RazCounters($catIdSelect, 0);
        $msg = _AM_GLOSSAIRE_ENTRIES_UPDATE_OK;         
        \redirect_header("entries.php?op=list&catIdSelect={$catIdSelect}&start={$start}&limit={$limit}&statusIdSelect={$statusIdSelect}" , 2, $msg);
        break;
    }
    
    
        $adminObject->addItemButton(_AM_GLOSSAIRE_RAZ_COUNTERS, "entries.php?op=&catIdSelect={$catIdSelect}", 'update');

require __DIR__ . '/footer.php';
