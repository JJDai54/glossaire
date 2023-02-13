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

\define('_GLOSSAIRE_FB_FORM_TITLE', 'Send a feedback');
\define('_GLOSSAIRE_FB_RECIPIENT', 'Recipient');
\define('_GLOSSAIRE_FB_NAME', 'Name');
\define('_GLOSSAIRE_FB_NAME_PLACEHOLER', 'Please enter your name');
\define('_GLOSSAIRE_FB_SITE', 'Website');
\define('_GLOSSAIRE_FB_SITE_PLACEHOLER', 'Please enter your website');
\define('_GLOSSAIRE_FB_MAIL', 'Email');
\define('_GLOSSAIRE_FB_MAIL_PLACEHOLER', 'Please enter your email');
\define('_GLOSSAIRE_FB_TYPE', 'Type of feedback');
\define('_GLOSSAIRE_FB_TYPE_SUGGESTION', 'Suggestions');
\define('_GLOSSAIRE_FB_TYPE_BUGS', 'Bugs');
\define('_GLOSSAIRE_FB_TYPE_TESTIMONIAL', 'Testimonials');
\define('_GLOSSAIRE_FB_TYPE_FEATURES', 'Features');
\define('_GLOSSAIRE_FB_TYPE_OTHERS', 'Misc');
\define('_GLOSSAIRE_FB_TYPE_CONTENT', 'Feedback content');
\define('_GLOSSAIRE_FB_SEND_FOR', 'Feedback for module ');
\define('_GLOSSAIRE_FB_SEND_SUCCESS', 'Feedback successfully sent');
\define('_GLOSSAIRE_FB_SEND_ERROR', 'An errror occured when feedback was sent!');
