<?php

namespace XoopsModules\Glossaire;

/*
 Utility Class Definition

 You may not change or alter any portion of this comment or credits of
 supporting developers from this source code or any supporting source code
 which is considered copyrighted (c) material of the original comment or credit
 authors.

 This program is distributed in the hope that it will be useful, but
 WITHOUT ANY WARRANTY; without even the implied warranty of
 MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 */

/**
 * Module:  glossaire
 *
 * @package      \module\glossaire\class
 * @license      http://www.fsf.org/copyleft/gpl.html GNU public license
 * @copyright    https://xoops.org 2001-2017 &copy; XOOPS Project
 * @author       ZySpec <owners@zyspec.com>
 * @author       Mamba <mambax7@gmail.com>
 * @since        
 */

use XoopsModules\Glossaire;

/**
 * Class Utility
 */
class Utility
{
    use Common\VersionChecks; //checkVerXoops, checkVerPhp Traits

    use Common\ServerStats; // getServerStats Trait

    use Common\FilesManagement; // Files Management Trait

    /**
     * truncateHtml can truncate a string up to a number of characters while preserving whole words and HTML tags
     * www.gsdesign.ro/blog/cut-html-string-without-breaking-the-tags
     * www.cakephp.org
     *
     * @param string $text         String to truncate.
     * @param int    $length       Length of returned string, including ellipsis.
     * @param string $ending       Ending to be appended to the trimmed string.
     * @param bool   $exact        If false, $text will not be cut mid-word
     * @param bool   $considerHtml If true, HTML tags would be handled correctly
     *
     * @return string Trimmed string.
     */
    public static function truncateHtml($text, $length = 100, $ending = '...', $exact = false, $considerHtml = true)
    {$text = strip_tags($text);
        if ($considerHtml) {
            // if the plain text is shorter than the maximum length, return the whole text
            if (\mb_strlen(\preg_replace('/<.*?' . '>/', '', $text)) <= $length) {
                return $text;
            }
            // splits all html-tags to scanable lines
            \preg_match_all('/(<.+?' . '>)?([^<>]*)/s', $text, $lines, \PREG_SET_ORDER);
            $total_length = \mb_strlen($ending);
            $open_tags    = [];
            $truncate     = '';
            foreach ($lines as $line_matchings) {
                // if there is any html-tag in this line, handle it and add it (uncounted) to the output
                if (!empty($line_matchings[1])) {
                    // if it's an "empty element" with or without xhtml-conform closing slash
                    if (\preg_match('/^<(\s*.+?\/\s*|\s*(img|br|input|hr|area|base|basefont|col|frame|isindex|link|meta|param)(\s.+?)?)>$/is', $line_matchings[1])) {
                        // do nothing
                        // if tag is a closing tag
                    } elseif (\preg_match('/^<\s*\/([^\s]+?)\s*>$/s', $line_matchings[1], $tag_matchings)) {
                        // delete tag from $open_tags list
                        $pos = \array_search($tag_matchings[1], $open_tags, true);
                        if (false !== $pos) {
                            unset($open_tags[$pos]);
                        }
                        // if tag is an opening tag
                    } elseif (\preg_match('/^<\s*([^\s>!]+).*?' . '>$/s', $line_matchings[1], $tag_matchings)) {
                        // add tag to the beginning of $open_tags list
                        \array_unshift($open_tags, \mb_strtolower($tag_matchings[1]));
                    }
                    // add html-tag to $truncate'd text
                    $truncate .= $line_matchings[1];
                }
                // calculate the length of the plain text part of the line; handle entities as one character
                $content_length = mb_strlen(\preg_replace('/&[0-9a-z]{2,8};|&#[0-9]{1,7};|[0-9a-f]{1,6};/i', ' ', $line_matchings[2]));
                if ($total_length + $content_length > $length) {
                    // the number of characters which are left
                    $left            = $length - $total_length;
                    $entities_length = 0;
                    // search for html entities
                    if (\preg_match_all('/&[0-9a-z]{2,8};|&#[0-9]{1,7};|[0-9a-f]{1,6};/i', $line_matchings[2], $entities, \PREG_OFFSET_CAPTURE)) {
                        // calculate the real length of all entities in the legal range
                        foreach ($entities[0] as $entity) {
                            if ($left >= $entity[1] + 1 - $entities_length) {
                                $left--;
                                $entities_length += mb_strlen($entity[0]);
                            } else {
                                // no more characters left
                                break;
                            }
                        }
                    }
                    $truncate .= \mb_substr($line_matchings[2], 0, $left + $entities_length);
                    // maximum lenght is reached, so get off the loop
                    break;
                }
                $truncate     .= $line_matchings[2];
                $total_length += $content_length;

                // if the maximum length is reached, get off the loop
                if ($total_length >= $length) {
                    break;
                }
            }
        } else {
            if (\mb_strlen($text) <= $length) {
                return $text;
            }
            $truncate = \mb_substr($text, 0, $length - mb_strlen($ending));
        }
        // if the words shouldn't be cut in the middle...
        if (!$exact) {
            // ...search the last occurance of a space...
            $spacepos = \mb_strrpos($truncate, ' ');
            if (isset($spacepos)) {
                // ...and cut the text in this position
                $truncate = \mb_substr($truncate, 0, $spacepos);
            }
        }
        // add the defined ending to the text
        if ('' != $truncate) {
            $truncate .= $ending;
        }
        if ($considerHtml) {
            // close all unclosed html-tags
            foreach ($open_tags as $tag) {
                $truncate .= '</' . $tag . '>';
            }
        }

        return $truncate;
    }

    /**
     * @param \Xmf\Module\Helper $glossaireHelper
     * @param array|null         $options
     * @return \XoopsFormDhtmlTextArea|\XoopsFormEditor
     */
    public static function getEditor($glossaireHelper = null, $options = null)
    {
        /** @var Glossaire\Helper $glossaireHelper */
        if (null === $options) {
            $options           = [];
            $options['name']   = 'Editor';
            $options['value']  = 'Editor';
            $options['rows']   = 10;
            $options['cols']   = '100%';
            $options['width']  = '100%';
            $options['height'] = '400px';
        }

        $isAdmin = $glossaireHelper->isUserAdmin();

        if (\class_exists('XoopsFormEditor')) {
            if ($isAdmin) {
                $descEditor = new \XoopsFormEditor(\ucfirst($options['name']), $glossaireHelper->getConfig('editorAdmin'), $options, $nohtml = false, $onfailure = 'textarea');
            } else {
                $descEditor = new \XoopsFormEditor(\ucfirst($options['name']), $glossaireHelper->getConfig('editorUser'), $options, $nohtml = false, $onfailure = 'textarea');
            }
        } else {
            $descEditor = new \XoopsFormDhtmlTextArea(\ucfirst($options['name']), $options['name'], $options['value'], '100%', '100%');
        }

        //        $form->addElement($descEditor);

        return $descEditor;
    }

    //--------------- Custom module methods -----------------------------

    /**
     * @param $about
     * @return string
     */
    public static function makeDonationForm($about)
    {
        $donationform = [
            0   => '<form name="donation" id="donation" action="https://xoops.org/modules/xdonations/" method="post" onsubmit="return xoopsFormValidate_donation();">',
            1   => '<table class="outer" cellspacing="1" width="100%"><tbody><tr><th colspan="2">'
                   . \_AM_GLOSSAIRE_ABOUT_MAKE_DONATION
                   . '</th></tr><tr align="left" valign="top"><td class="head"><div class="xoops-form-element-caption-required"><span class="caption-text">'
                   . \_AM_GLOSSAIRE_DONATION_AMOUNT
                   . '</span><span class="caption-marker">*</span></div></td><td class="even"><select size="1" name="item[A][amount]" id="item[A][amount]" title="Donation Amount"><option value="5">5.00 EUR</option><option value="10">10.00 EUR</option><option value="20">20.00 EUR</option><option value="40">40.00 EUR</option><option value="60">60.00 EUR</option><option value="80">80.00 EUR</option><option value="90">90.00 EUR</option><option value="100">100.00 EUR</option><option value="200">200.00 EUR</option></select></td></tr><tr align="left" valign="top"><td class="head"></td><td class="even"><input class="formButton" name="submit" id="submit" value="'
                   . \_SUBMIT
                   . '" title="'
                   . \_SUBMIT
                   . '" type="submit"></td></tr></tbody></table>',
            2   => '<input name="op" id="op" value="createinvoice" type="hidden"><input name="plugin" id="plugin" value="donations" type="hidden"><input name="donation" id="donation" value="1" type="hidden"><input name="drawfor" id="drawfor" value="Chronolabs Co-Operative" type="hidden"><input name="drawto" id="drawto" value="%s" type="hidden"><input name="drawto_email" id="drawto_email" value="%s" type="hidden"><input name="key" id="key" value="%s" type="hidden"><input name="currency" id="currency" value="EUR" type="hidden"><input name="weight_unit" id="weight_unit" value="kgs" type="hidden"><input name="item[A][cat]" id="item[A][cat]" value="XDN%s" type="hidden"><input name="item[A][name]" id="item[A][name]" value="Donation for %s" type="hidden"><input name="item[A][quantity]" id="item[A][quantity]" value="1" type="hidden"><input name="item[A][shipping]" id="item[A][shipping]" value="0" type="hidden"><input name="item[A][handling]" id="item[A][handling]" value="0" type="hidden"><input name="item[A][weight]" id="item[A][weight]" value="0" type="hidden"><input name="item[A][tax]" id="item[A][tax]" value="0" type="hidden"><input name="return" id="return" value="https://xoops.org/modules/xdonations/success.php" type="hidden"><input name="cancel" id="cancel" value="https://xoops.org/modules/xdonations/success.php" type="hidden"></form>',
            'D' => '',
            3   => '',
            4   => '<!-- Start Form Validation JavaScript //-->
<script type="text/javascript">
<!--//
function xoopsFormValidate_donation() { var myform = window.document.donation; 
var hasSelected = false; var selectBox = myform.item[A][amount];for (i = 0; i < selectBox.options.length; i++ ) { if (selectBox.options[i].selected === true && selectBox.options[i].value != \'\') { hasSelected = true; break; } }if (!hasSelected) { window.alert("Please enter Donation Amount"); selectBox.focus(); return false; }return true;
}
//--></script>
<!-- End Form Validation JavaScript //-->',
        ];
        $paypalform   = [
            0 => '<form action="https://www.paypal.com/cgi-bin/webscr" method="post">',
            1 => '<input name="cmd" value="_s-xclick" type="hidden">',
            2 => '<input name="hosted_button_id" value="%s" type="hidden">',
            3 => '<img alt="" src="https://www.paypal.com/fr_FR/i/scr/pixel.gif" height="1" border="0" width="1">',
            4 => '<input src="https://www.paypal.com/en_US/i/btn/btn_donate_LG.gif" name="submit" alt="PayPal - The safer, easier way to pay online!" border="0" type="image">',
            5 => '</form>',
        ];
        for ($key = 0; $key <= 4; ++$key) {
            switch ($key) {
                case 2:
                    $donationform[$key] = \sprintf(
                        $donationform[$key],
                        $GLOBALS['xoopsConfig']['sitename'] . ' - ' . ('' != $GLOBALS['xoopsUser']->getVar('name') ? $GLOBALS['xoopsUser']->getVar('name') . ' [' . $GLOBALS['xoopsUser']->getVar('uname') . ']' : $GLOBALS['xoopsUser']->getVar('uname')),
                        $GLOBALS['xoopsUser']->getVar('email'),
                        \XOOPS_LICENSE_KEY,
                        \mb_strtoupper($GLOBALS['xoopsModule']->getVar('dirname')),
                        \mb_strtoupper($GLOBALS['xoopsModule']->getVar('dirname')) . ' ' . $GLOBALS['xoopsModule']->getVar('name')
                    );
                    break;
            }
        }
        $aboutRes = '';
        $istart   = \mb_strpos($about, $paypalform[0], 1);
        $iend     = \mb_strpos($about, $paypalform[5], $istart + 1) + mb_strlen($paypalform[5]) - 1;
        $aboutRes .= \mb_substr($about, 0, $istart - 1);
        $aboutRes .= \implode("\n", $donationform);
        $aboutRes .= \mb_substr($about, $iend + 1, mb_strlen($about) - $iend - 1);

        return $aboutRes;
    }

    /**
     * @param $str
     *
     * @return string
     */
    public static function UcFirstAndToLower($str)
    {
        return \ucfirst(\mb_strtolower(\trim($str)));
    }
    
    //**************************************************
    //------------- functions JJd ----------------------
    //**************************************************
    
    /**
     * @param $str
     *
     * @return string
     */
    public static     function getInitiale($exp){
      $initiale = \JJD\enleve_accents(mb_strtoupper(mb_substr($exp,0,1)));

      if (ord($initiale) > 64 && ord($initiale) < 91)
      {
          return $initiale;
      }else{
          return GLOSSAIRE_CHIFFRES;
      }
    }

    
    /**
     * @param $str
     *
     * @return string
    public static function get_acronym2_old($exp)
    { 
        $i = mb_strpos($exp, ";", 0);
        if($i === false) $i = mb_strpos($exp, ";", 0);

        //echo "<hr>{$str} | {$exp} | i={$i}<hr>";
        if($i === false){
            $j=mb_strpos("|de|des|du|le|la|les|en|pour|à|au|aux|et|e|y|", "|" . strtolower($exp) . "|");
            if ($j===false)
                $exp = sprintf("<b>%s</b>%s" ,mb_strtoupper(mb_substr($exp,0,1)), mb_substr($exp,1));
        }else{
            $exp = sprintf("%s<b>%s</b>%s" ,substr($exp,0,$i+1), mb_strtoupper(mb_substr($exp,$i+1,1)), mb_substr($exp,$i+2));
        }
        return $exp;
    }
     */
     
    /**
     * @param $str
     *
     * @return string
     */

    public static function get_acronym2($exp)
    {   
    $newExp = '';    
    
        for ($h=0; $h < mb_strlen($exp); $h++){
            $car = mb_substr ($exp, $h, 1, "UTF-8");        
            if($car === '/'){
                $h++;
                $car = mb_substr ($exp, $h, 1, "UTF-8");        
                $newExp .= sprintf("<b>%s</b>" , $car);            
            }elseif(ctype_upper($car)){
                $newExp .= sprintf("<b>%s</b>" ,$car);            
            }elseif(mb_strpos("ÀÂÄÉÈÊËÎÏÔÖÙÛÜÑÇ", $car) !== false){
                $newExp .= sprintf("<b>%s</b>" ,$car);            
            }else{
                $newExp .=  $car;
            }        
        }
        return $newExp;
    }    
    /**
     * @param $str
     *
     * @return string
     */
    public static function get_acronym($str)
    { 
//        $exp =  strtolower(htmlspecialchars_decode($str,ENT_QUOTES));
        $sep1 = ' ';
        $tExp1 = explode($sep1, $str);

        for($h=0; $h < count($tExp1); $h++){
            $sep2 = '-';
            $tExp2 = explode($sep2, $tExp1[$h]);
            for($j=0; $j < count($tExp2); $j++){
                $tExp2[$j] = self::get_acronym2($tExp2[$j]);
            }
            $tExp1[$h] = implode($sep2 , $tExp2);
            
        }
        return (implode($sep1, $tExp1));
    }
   
    /**
     * @param $str Construit les liens url pour le champ "voir aussi"
     *
     * @return string
     */
    public static function build_urls($exp, $sep='|')
    {
        $tUrls = explode("\n", $exp);
        $retArr = array();
        
        for ($h=0; $h<count($tUrls); $h++){
            $t = explode('|', trim($tUrls[$h]));
            if(count($t) > 1){
                $name = $t[0];
                $url  = $t[1];
            }else{
                $name = '';
                $url  = $t[0];
            }
            
            $i = stripos($url, 'http');
            
            if ($url != ''){
              if ($i === false) $url = 'http://' . $url;
              if($name == ''){
                $retArr[]  = sprintf("<li><a href='%s' title='' alt='' target='blank'>%s</a></li>", $url, $url);
              }else{
                $retArr[]  = sprintf("<li><a href='%s' title='' alt='' target='blank'>%s</a></li>", $url, $name);
              }
            }
        }
        return "<ul>" . implode("\n", $retArr) . "</ul>";
    }

/* ***********************
@ purgerFolderImg : compte ou supprime les images inutilisés
@ $actionForEnr : 0 = Compte - 1 = update entries
@ $actionForImg : 0 = Compte - 1 = delete files
************************** */
function cleanCatFolders($catId, $fldPath, $fldName,  $subFolder, $actionForEnr = 0, $actionForFiles = 0){
global $categoriesHandler, $entriesHandler, $xoopsList;

//if(!$categoriesHandler)return;
    if($catId == 0)return 0;
//echo "<hr>dossier : {$subFolder} - {$fldPath}<hr>";    
    //------------------------------------------------------------------
    //recherche dans la table les enregistrements n'ayant pas de fichier associer dans le dossier
    $catObj = $categoriesHandler->get($catId);
    if(!$catObj) return true;
    //$catFolder = GLOSSAIRE_UPLOAD_IMPORT_DATA_PATH . '/' . $catObj->getVar('cat_upload_folder'). "/{$subFolder}" ;
    $catFolder = $catObj->getPathUploads($subFolder) ;
//echo "===>dossier : {$catFolder}<br>";    
    
    $criteria = new \CriteriaCompo();
    $criteria->add(new \Criteria('ent_cat_id', $catId, '='));
    $criteria->add(new \Criteria('', 0, '<>',null,"length({$fldPath})"),"AND");
         
    $allEntries = $entriesHandler->getAllEntries($criteria);
    $imgUsed = array();
    $nbImgNotExists = 0;    
    
    foreach($allEntries AS $entry){
        $img = $entry->getVar($fldPath);
        $imgUsed[$img] = $img;
        $f = $catFolder . '/' . $img;
        if (!is_readable($f) && $img != '' ){
            if ($actionForEnr == 1) {
              $entry->setVar($fldPath, '');
              //et une petite verue
              if ($fldPath != '') $entry->setVar($fldName, '');
              $entriesHandler->insert($entry);
//        echo "cleanEntriesImages : nbImgNotExists = {$nbImgNotExists} / " . count($imgUsed) . $f . '<br>';
            }
            $nbImgNotExists++;
        }
    }
 
    //------------------------------------------------------------------
    //recherche dans le dossie les fichiers non référencé dans la table
    
    

    //$dirname = GLOSSAIRE_UPLOAD_IMG_FOLDER_PATH . '/' . $catObj->getVar('cat_upload_folder');

// ----------------------------------------------- 
xoops_load('XoopsLists');
 //$xoopsList = new \XoopsList();

    //$listImg = $xoopsList->getImgListAsArray($catFolder);
    $listImg = \XoopsLists::getFileListAsArray($catFolder);
    $nbImg2Delete = 0;
    foreach($listImg as $key=>$img){
        if($key == 'index.html' || $key == 'index.php') continue; //on efface pas ces fichiers
        if (!array_key_exists($key, $imgUsed)){
            $f = $catFolder . '/' . $key;
            if ($actionForFiles == 1) {
              unlink($f);
//        echo "===>Fichiers supprimé : {$f}<br>";
            }
            $nbImg2Delete++;
//        echo "Fichiers non référencés dans la table : {$nbImg2Delete} / " . count($listImg) . " - {$catFolder}/{$key}<br>";
        }
    }

    return array($nbImgNotExists + $nbImg2Delete, $nbImgNotExists, $nbImg2Delete);
   }
   
   

} // ----- FIN DE La CLASS -----
