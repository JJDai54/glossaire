# SQL Dump for glossaire module
# PhpMyAdmin Version: 4.0.4
# http://www.phpmyadmin.net
#
# Host: xoops2511.jubile.fr
# Generated on: Sun Jun 12, 2022 to 16:25:12
# Server version: 5.6.49-log
# PHP Version: 7.4.28

#
# Structure table for `glossaire_categories` 8
#

CREATE TABLE `glossaire_categories` (
  `cat_id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `cat_pid` int NOT NULL DEFAULT '0',
  `cat_name` varchar(255) NOT NULL DEFAULT '',
  `cat_description` text NOT NULL,
  `cat_weight` int NOT NULL DEFAULT '0',
  `cat_logo` varchar(80) NOT NULL DEFAULT '',
  `cat_userpager` tinyint NOT NULL DEFAULT '10',
  `cat_alphabarre` varchar(255) NOT NULL,
  `cat_alphabarre_mode` tinyint(1) NOT NULL DEFAULT '1',
  `cat_upload_folder` varchar(255) NOT NULL DEFAULT '',
  `cat_colors_set` varchar(50) NOT NULL DEFAULT '',
  `cat_is_acronym` tinyint(1) NOT NULL DEFAULT '0',
  `cat_replace_arobase` varchar(5) NOT NULL DEFAULT '',
  `cat_br_after_term` tinyint NOT NULL DEFAULT '0',
  `cat_show_terms_index` tinyint(1) NOT NULL DEFAULT '1',
  `cat_show_bin` INT(8) NOT NULL DEFAULT '65535',   
  `cat_options_bin` INT(8) NOT NULL DEFAULT '65535',   
  `cat_count_entries` int NOT NULL DEFAULT '0',
  `cat_active` tinyint(1) NOT NULL DEFAULT '0',
  `cat_date_format` varchar(30) NOT NULL DEFAULT 'd-m-Y : H-i-s',
  `cat_date_creation` datetime(6) NOT NULL DEFAULT '1970-01-01 00:00:00.000000',
  `cat_date_update` datetime(6) NOT NULL DEFAULT '1970-01-01 00:00:00.000000',
 PRIMARY KEY (`cat_id`),
 UNIQUE KEY `cat_upload_folder` (`cat_upload_folder`)  
) ENGINE=InnoDB;

#
# Structure table for `glossaire_entries` 14
#

CREATE TABLE `glossaire_entries` (
  `ent_id` int(8) UNSIGNED NOT NULL AUTO_INCREMENT,
  `ent_cat_id` int(10) NOT NULL DEFAULT '0',
  `ent_submitter` int(10) NOT NULL DEFAULT '0',
  `ent_creator` varchar(80) NOT NULL DEFAULT '',
  `ent_term` varchar(255) NOT NULL DEFAULT '',
  `ent_link` varchar(255) NOT NULL DEFAULT '',
  `ent_initiale` varchar(5) NOT NULL DEFAULT '',
  `ent_shortdef` varchar(255) NOT NULL DEFAULT '',
  `ent_is_acronym` tinyint(1) NOT NULL DEFAULT '0',
  `ent_image` varchar(255) NOT NULL DEFAULT '',
  `ent_definition` text NOT NULL,
  `ent_reference` text NOT NULL,
  `ent_file_name` varchar(80) NOT NULL,
  `ent_file_path` varchar(80) NOT NULL,
  `ent_urls` text NOT NULL,
  `ent_email` varchar(80) NOT NULL,
  `ent_counter` int(10) NOT NULL DEFAULT '0',
  `ent_status` tinyint(1) NOT NULL DEFAULT '0',
  `ent_flag` int(10) NOT NULL DEFAULT '0',
  `ent_date_creation` datetime(6) NOT NULL DEFAULT '1970-01-01 00:00:00',
  `ent_date_update` datetime(6) NOT NULL DEFAULT '1970-01-01 00:00:00',
  PRIMARY KEY (`ent_id`)
) ENGINE=InnoDB;

