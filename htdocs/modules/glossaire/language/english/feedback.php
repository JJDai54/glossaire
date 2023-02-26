<?php
/*
 You may not change or alter any portion of this comment or credits
 of supporting developers from this source code or any supporting source code
 which is considered copyrighted (c) material of the original comment or credit authors.

 This program is distributed in the hope that it will be useful,
 but WITHOUT ANY WARRANTY; without even the implied warranty of
 MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
*/

/**
 * feedback plugin for xoops modules
 *
 * @copyright      module for xoops
 * @license        GPL 2.0 or later
 * @package        general
 * @since          1.0
 * @min_xoops      2.5.11
 * @author         XOOPS - Website:<https://xoops.org>
 */
$moduleDirName      = \basename(\dirname(__DIR__, 2));
$moduleDirNameUpper = \mb_strtoupper($moduleDirName);

\define('_FB_GLOSSAIRE_FORM_TITLE', 'Send a feedback');
\define('_FB_GLOSSAIRE_RECIPIENT', 'Recipient');
\define('_FB_GLOSSAIRE_NAME', 'Name');
\define('_FB_GLOSSAIRE_NAME_PLACEHOLER', 'Please enter your name');
\define('_FB_GLOSSAIRE_SITE', 'Website');
\define('_FB_GLOSSAIRE_SITE_PLACEHOLER', 'Please enter your website');
\define('_FB_GLOSSAIRE_MAIL', 'Email');
\define('_FB_GLOSSAIRE_MAIL_PLACEHOLER', 'Please enter your email');
\define('_FB_GLOSSAIRE_TYPE', 'Type of feedback');
\define('_FB_GLOSSAIRE_TYPE_SUGGESTION', 'Suggestions');
\define('_FB_GLOSSAIRE_TYPE_BUGS', 'Bugs');
\define('_FB_GLOSSAIRE_TYPE_TESTIMONIAL', 'Testimonials');
\define('_FB_GLOSSAIRE_TYPE_FEATURES', 'Features');
\define('_FB_GLOSSAIRE_TYPE_OTHERS', 'Misc');
\define('_FB_GLOSSAIRE_TYPE_CONTENT', 'Feedback content');
\define('_FB_GLOSSAIRE_SEND_FOR', 'Feedback for module ');
\define('_FB_GLOSSAIRE_SEND_SUCCESS', 'Feedback successfully sent');
\define('_FB_GLOSSAIRE_SEND_ERROR', 'An errror occured when feedback was sent!');
