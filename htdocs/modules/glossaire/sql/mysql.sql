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
  `cat_id` INT(8) UNSIGNED NOT NULL AUTO_INCREMENT,
  `cat_name` VARCHAR(255) NOT NULL DEFAULT '',
  `cat_description` TEXT NOT NULL ,
  `cat_weight` INT(10) NOT NULL DEFAULT '0',
  `cat_logourl` VARCHAR(255) NOT NULL DEFAULT '',
  `cat_img_folder` VARCHAR(255) NOT NULL DEFAULT '',
  `cat_colors_set` VARCHAR(50) NOT NULL DEFAULT '',
  `cat_is_acronym` TINYINT(1) NOT NULL DEFAULT '0',   
  `cat_show_terms_index` TINYINT(1) NOT NULL DEFAULT '1',   
  `cat_count_entries` INT(11) NOT NULL DEFAULT '0',   
  `cat_date_creation` DATETIME(6) NOT NULL DEFAULT '0000-00-00 00:00:00.0000',
  `cat_date_update` DATETIME(6) NOT NULL DEFAULT '0000-00-00 00:00:00.00000',
  PRIMARY KEY (`cat_id`),
 UNIQUE KEY `cat_img_folder` (`cat_img_folder`)  
) ENGINE=InnoDB;

#
# Structure table for `glossaire_entries` 14
#

CREATE TABLE `glossaire_entries` (
  `ent_id` INT(8) UNSIGNED NOT NULL AUTO_INCREMENT,
  `ent_cat_id` INT(10) NOT NULL DEFAULT '0',
  `ent_creator` VARCHAR(80) NOT NULL DEFAULT '',
  `ent_term` VARCHAR(255) NOT NULL DEFAULT '',
  `ent_initiale` VARCHAR(5) NOT NULL DEFAULT '',
  `ent_shortdef` VARCHAR(255) NOT NULL DEFAULT '',
  `ent_is_acronym` TINYINT(1) NOT NULL DEFAULT '0',   
  `ent_image` VARCHAR(255) NOT NULL DEFAULT '',
  `ent_definition` TEXT NOT NULL ,
  `ent_reference` TEXT NOT NULL ,
  `ent_file_title_1` VARCHAR(80) NOT NULL DEFAULT '',
  `ent_file_name_1` VARCHAR(80) NOT NULL DEFAULT '',
  `ent_urls`  TEXT NOT NULL,
  `ent_date_creation` DATETIME(6) NOT NULL DEFAULT '0000-00-00 00:00:00.00000',
  `ent_date_update` DATETIME(6) NOT NULL DEFAULT '0000-00-00 00:00:00.00000',
  `ent_counter` INT(10) NOT NULL DEFAULT '0',
  `ent_status` TINYINT(1) NOT NULL DEFAULT '0',
  `ent_flag` INT(10) NOT NULL DEFAULT '0',
  PRIMARY KEY (`ent_id`)
) ENGINE=InnoDB;

