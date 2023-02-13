<?php
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
 * glossaire - Slides management module for xoops
 *
 * @copyright      2020 XOOPS Project (https://xooops.org)
 * @license        GPL 2.0 or later
 * @package        glossaire
 * @since          1.0
 * @min_xoops      2.5.9
 * @author         JJDai - Email:<jjdelalandre@orange.fr> - Website:<http://jubile.fr>
 */
use XoopsModules\Glossaire;
use XoopsModules\Glossaire\Helper;
use XoopsModules\Glossaire\Constants;

//require_once XOOPS_ROOT_PATH . '/modules/glossaire/admin/header.php';
require_once 'header.php';
$templateMain = 'glossaire_admin_about.tpl';


$box = array();

/**********************************
 * 
 * ****************************** */
function array2table($tLines){
    $html = array();
    $html[] = "<table>";
    
    foreach($tLines as $k=>$line){
        $html[] = "<tr>";
        $html[] = "<td style='text-align:right;width:30%'>{$line['title']}</td>";
        $html[] = "<td style='text-align:center;'>:</td>";
        $html[] = "<td style='text-align:left;'>{$line['value']}</td>";
        $html[] = "</tr>";
    }
    $html[] = "</table>";
    return implode("\n", $html);
}

/**********************************
 * 
 * ****************************** */
function changelog(){

    $path = dirname(__DIR__);;
    
    $language = empty( $GLOBALS['xoopsConfig']['language'] ) ? 'english' : $GLOBALS['xoopsConfig']['language'];
    $file     = "{$path}/language/{$language}/changelog.txt";
    if ( !is_file( $file ) && ( 'english' !== $language ) ) {
        $file = "{$path}/language/english/changelog.txt";
    }
    if ( is_readable( $file ) ) {
        $ret = ( implode( '<br>', file( $file ) ) ) . "\n";
    } else {
        $file = "{$path}/docs/changelog.txt";
        if ( is_readable( $file ) ) {
            $ret = implode( '<br>', file( $file ) ) . "\n";
        }
    }
    //--------------------------------------------
    $html = array();

    $html[] = "<div class=\"txtchangelog\">\n";
    //$html[] = "|" . $file . "|<br>";
    $html[] = $ret;
    
    $html[] = "</div>\n";
    return implode("\n", $html);

}
/**********************************
 * 
 * https://www.paypal.com/donate?hosted_button_id=H9EMH5M4XA48A
 * ****************************** */
function contribution(){
    //--------------------------------------------
    $html = array();
    $html[] = "<div style=\"clear: both; height: 1em;\"></div>";
    
    $html[] = "<div>" . _AM_JJD_ABOUT_WHY_DONATE . "</div><center>";
    
    $html[] = '<form action="https://www.paypal.com/donate" method="post" target="_top">
<input type="hidden" name="hosted_button_id" value="MUUZPTPGJSB9G" />
<input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_donate_SM.gif" border="0" name="submit" title="PayPal - The safer, easier way to pay online!" alt="Donate with PayPal button" />
<img alt="" border="0" src="https://www.paypal.com/en_FR/i/scr/pixel.gif" width="1" height="1" />
</form>';

   
    $html[] = "</center></div>\n";
    return implode("\n", $html);

/*
*/
}

/**********************************
 * 
 * ****************************** */
function localHeaderInfo(){
global    $glossaireHelper;
$module_dir = basename(dirname(dirname(__FILE__)));

$glossaireHelper = \XoopsModules\Glossaire\Helper::getInstance();
$module_dir = basename(dirname(dirname(__FILE__)));
$module = $glossaireHelper->getModule();

    $license_url = $glossaireHelper->getModule()->getInfo('license_url');
    $license_url = preg_match('%^(https?:)?//%', $license_url) ? $license_url : 'http://' . $license_url;


    $html = array();
    
    $html[] = "<table>\n<tr>\n<td style=\"width: 100px;\">";
    $html[] = "<img src=\"" . XOOPS_URL . '/modules/' . $module_dir . '/' . $module->getInfo('image') . "\" alt=\"" . $module_dir . "\" style=\"float: left; margin-right: 10px;\">";
    $html[] = "</td><td>";
    $html[] = "<div style=\"margin-top: 1px; margin-itemRound-bottom: 4px; font-size: 18px; line-height: 18px; color: #2F5376; font-weight: bold;\">";
    $html[] = $module->getInfo('name');
    $html[] = " - ";
    $html[] = $module->getInfo('version');
    $html[] = " - ";
    $html[] = $module->getInfo('module_status');
    $html[] = " - ";
    $html[] = "mid = " . $module->getVar('mid');
    $html[] = "</div>";
    
    
    $html[] = "<div style=\"line-height: 16px; font-weight: bold;\">";
    $html[] = _AM_JJD_ABOUT_BY . " ".  $module->getInfo('author');
    $html[] = "</div>";
    $html[] = "<div style=\"line-height: 16px;\">";
    $html[] = "<a href=\"$license_url\" target=\"_blank\" rel=\"external\">" . $module->getInfo('license') . "</a>";
    $html[] = "<br>";
    $html[] = "<a href=\"" . $module->getInfo('author_website_url') . "\" target=\"_blank\">" . $module->getInfo('author_website_name') . "</a>";
    $html[] = "</div>";

    $html[] = "</td></tr></table>";
    return implode("\n", $html);
    

}
/**********************************
 * 
 * ****************************** */
function moduleInfo(){
//global    $glossaireHelper;
$glossaireHelper = \XoopsModules\Glossaire\Helper::getInstance();
$module_dir = basename(dirname(dirname(__FILE__)));
$module = $glossaireHelper->getModule();

    
  $lines = array();
  
  $lines[] = ['title' => 'Auteur',
              'value' => $module->getInfo('author'),
              'color' => 'red',
              'bold'  => true];
    
  $lines[] = ['title' => 'author_mail',
              'value' => $module->getInfo('author_mail'),
              'color' => '',
              'bold'  => true];
     
  $lines[] = ['title' => 'author_website_url',
              'value' => $module->getInfo('author_website_url'),
              'color' => '',
              'bold'  => true];
             
     
  $lines[] = ['title' => 'author_website_name',
              'value' => $module->getInfo('author_website_name'),
              'color' => '',
              'bold'  => true];

 $lines[] = ['title' => 'module',
              'value' => $module->getInfo('name'),
              'color' => 'red',
              'bold'  => true];
  
  $lines[] = ['title' => 'dirname',
              'value' => basename(dirname(__DIR__)),
              'color' => 'red',
              'bold'  => true];
    
  $lines[] = ['title' => 'version',
              'value' => $module->getInfo('version'),
              'color' => '',
              'bold'  => true];
    
  $lines[] = ['title' => 'release_info',
              'value' => $module->getInfo('release_info'),
              'color' => '',
              'bold'  => true];
    
  $lines[] = ['title' => 'release_file',
              'value' => $module->getInfo('release_file'),
              'color' => '',
              'bold'  => true];
    
  $lines[] = ['title' => 'release_date',
              'value' => $module->getInfo('release_date'),
              'color' => '',
              'bold'  => true];
    
  $lines[] = ['title' => 'description',
              'value' => $module->getInfo('description'),
              'color' => '',
              'bold'  => true];
    
  $lines[] = ['title' => 'license',
              'value' => $module->getInfo('license'),
              'color' => '',
              'bold'  => true];
    
  $lines[] = ['title' => 'credits',
              'value' => $module->getInfo('credits'),
              'color' => '',
              'bold'  => true];
 return $lines;   
    
}

/* ------------------------- PAYPAL -----------------------------*/

$box['module']['legend'] = _AM_MODULEADMIN_ABOUT_MODULEINFO;
$box['module']['content'] = array2table(moduleInfo());

/* ------------------------- Module -----------------------------*/
$box['paypal']['legend'] = _AM_JJD_ABOUT_CONTRIBUTION;
$box['paypal']['content'] = contribution();

/* ------------------------- Header Info -----------------------------*/
$box['header']['legend'] = "header";
$box['header']['content'] = localHeaderInfo();

/* ------------------------- Chanlog -----------------------------*/
$box['changelog']['legend'] = _AM_MODULEADMIN_ABOUT_CHANGELOG;
$box['changelog']['content'] = changelog();



    

/************************************************************************/
$adminObject->displayNavigation('about.php');
//$adminObject->setPaypal('jjdelalandre@orange.fr');
//$GLOBALS['xoopsTpl']->assign('about', $adminObject->renderAbout(true));
$GLOBALS['xoopsTpl']->assign('box', $box);

require __DIR__ . '/footer.php';
