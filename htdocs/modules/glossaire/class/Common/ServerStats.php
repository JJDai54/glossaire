<?php

namespace XoopsModules\Glossaire\Common;

/*
 You may not change or alter any portion of this comment or credits
 of supporting developers from this source code or any supporting source code
 which is considered copyrighted (c) material of the original comment or credit authors.

 This program is distributed in the hope that it will be useful,
 but WITHOUT ANY WARRANTY; without even the implied warranty of
 MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 */

/**
 * @copyright   XOOPS Project (https://xoops.org)
 * @license     http://www.fsf.org/copyleft/gpl.html GNU public license
 * @author      mamba <mambax7@gmail.com>
 */
trait ServerStats
{
    /**
     * serverStats()
     *
     * @return string
     */
    public static function getServerStats()
    {
        $moduleDirName      = \basename(\dirname(__DIR__, 2));
        $moduleDirNameUpper = \mb_strtoupper($moduleDirName);
        \xoops_loadLanguage('common', $moduleDirName);
        $html = '';
        //        $sql   = 'SELECT metavalue';
        //        $sql   .= ' FROM ' . $GLOBALS['xoopsDB']->prefix('wfdownloads_meta');
        //        $sql   .= " WHERE metakey='version' LIMIT 1";
        //        $query = $GLOBALS['xoopsDB']->query($sql);
        //        list($meta) = $GLOBALS['xoopsDB']->fetchRow($query);
        $html .= '<fieldset>';
        $html .= "<legend style='font-weight: bold; color: #900;'>" . \constant('_CO_GLOSSAIRE_IMAGEINFO') . '</legend>';
        $html .= "<div style='padding: 8px;'>";
        //        $html .= '<div>' . \constant('_CO_GLOSSAIRE_METAVERSION') . $meta . "</div>";
        //        $html .= "<br>";
        //        $html .= "<br>";
        $html .= '<div>' . \constant('_CO_GLOSSAIRE_SPHPINI') . '</div>';
        $html .= '<ul>';

        $gdlib = \function_exists('gd_info') ? '<span style="color: #008000;">' . \constant('_CO_GLOSSAIRE_GDON') . '</span>' : '<span style="color: #ff0000;">' . \constant('_CO_GLOSSAIRE_GDOFF') . '</span>';
        $html  .= '<li>' . \constant('_CO_GLOSSAIRE_GDLIBSTATUS') . $gdlib;
        if (\function_exists('gd_info')) {
            if (true === ($gdlib = gd_info())) {
                $html .= '<li>' . \constant('_CO_GLOSSAIRE_GDLIBVERSION') . '<b>' . $gdlib['GD Version'] . '</b>';
            }
        }

        //    $safemode = \ini_get('safe_mode') ? \constant('_CO_GLOSSAIRE_ON') . \constant('_CO_GLOSSAIRE_SAFEMODEPROBLEMS : \constant('_CO_GLOSSAIRE_OFF');
        //    $html .= '<li>' . \constant('_CO_GLOSSAIRE_SAFEMODESTATUS . $safemode;

        //    $registerglobals = (!\ini_get('register_globals')) ? "<span style=\"color: #008000;\">" . \constant('_CO_GLOSSAIRE_OFF') . '</span>' : "<span style=\"color: #ff0000;\">" . \constant('_CO_GLOSSAIRE_ON') . '</span>';
        //    $html .= '<li>' . \constant('_CO_GLOSSAIRE_REGISTERGLOBALS . $registerglobals;

        $downloads = \ini_get('file_uploads') ? '<span style="color: #008000;">' . \constant('_CO_GLOSSAIRE_ON') . '</span>' : '<span style="color: #ff0000;">' . \constant('_CO_GLOSSAIRE_OFF') . '</span>';
        $html      .= '<li>' . \constant('_CO_GLOSSAIRE_SERVERUPLOADSTATUS') . $downloads;

        $html .= '<li>' . \constant('_CO_GLOSSAIRE_MAXUPLOADSIZE') . ' <b><span style="color: #0000ff;">' . \ini_get('upload_max_filesize') . '</span></b>';
        $html .= '<li>' . \constant('_CO_GLOSSAIRE_MAXPOSTSIZE') . ' <b><span style="color: #0000ff;">' . \ini_get('post_max_size') . '</span></b>';
        $html .= '<li>' . \constant('_CO_GLOSSAIRE_MEMORYLIMIT') . ' <b><span style="color: #0000ff;">' . \ini_get('memory_limit') . '</span></b>';
        $html .= '</ul>';
        $html .= '<ul>';
        $html .= '<li>' . \constant('_CO_GLOSSAIRE_SERVERPATH') . ' <b>' . \XOOPS_ROOT_PATH . '</b>';
        $html .= '</ul>';
        $html .= '<br>';
        $html .= \constant('_CO_GLOSSAIRE_UPLOADPATHDSC') . '';
        $html .= '</div>';
        $html .= '</fieldset><br>';

        return $html;
    }
}
