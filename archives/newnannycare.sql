-- phpMyAdmin SQL Dump
-- version 4.8.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 04, 2018 at 08:07 AM
-- Server version: 10.1.32-MariaDB
-- PHP Version: 7.1.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `lovingna_new`
--

-- --------------------------------------------------------

--
-- Table structure for table `article`
--

CREATE TABLE IF NOT EXISTS `article` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `slug` varchar(1024) COLLATE utf8_unicode_ci NOT NULL,
  `title` varchar(512) COLLATE utf8_unicode_ci NOT NULL,
  `body` text COLLATE utf8_unicode_ci NOT NULL,
  `view` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  `thumbnail_base_url` varchar(1024) COLLATE utf8_unicode_ci DEFAULT NULL,
  `thumbnail_path` varchar(1024) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` smallint(6) NOT NULL DEFAULT '0',
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `published_at` int(11) DEFAULT NULL,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_article_author` (`created_by`),
  KEY `fk_article_updater` (`updated_by`),
  KEY `fk_article_category` (`category_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `article_attachment`
--

CREATE TABLE IF NOT EXISTS `article_attachment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `article_id` int(11) NOT NULL,
  `path` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `base_url` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `type` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `size` int(11) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` int(11) DEFAULT NULL,
  `order` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_article_attachment_article` (`article_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `article_category`
--

CREATE TABLE IF NOT EXISTS `article_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `slug` varchar(1024) COLLATE utf8_unicode_ci NOT NULL,
  `title` varchar(512) COLLATE utf8_unicode_ci NOT NULL,
  `body` text COLLATE utf8_unicode_ci,
  `parent_id` int(11) DEFAULT NULL,
  `status` smallint(6) NOT NULL DEFAULT '0',
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_article_category_section` (`parent_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `employment`
--

CREATE TABLE IF NOT EXISTS `employment` (
  `id` int(11) NOT NULL,
  `email` text NOT NULL,
  `employer_name` text NOT NULL,
  `employer_address` text NOT NULL,
  `from_date` text NOT NULL,
  `to_date` text NOT NULL,
  `position_type` text NOT NULL,
  `number_of_children` int(11) NOT NULL,
  `ages_of_children_started` text NOT NULL,
  `ages_of_children_left` text NOT NULL,
  `responsibilities` text NOT NULL,
  `salary_starting` text NOT NULL,
  `salary_ending` text NOT NULL,
  `may_we_contact` text NOT NULL,
  `contact_phone` text NOT NULL,
  `contact_email` text NOT NULL,
  `reason_for_leaving` text NOT NULL,
  `hours_worked` text NOT NULL,
  `was_this_a_live_in_position` text NOT NULL,
  `emloyer_comment` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `families`
--

CREATE TABLE IF NOT EXISTS `families` (
  `id` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `name` text NOT NULL,
  `address` text NOT NULL,
  `phone` text NOT NULL,
  `children` text NOT NULL,
  `type_of_help` text NOT NULL,
  `work_out_of_home` text NOT NULL,
  `special_needs` text NOT NULL,
  `driving` text NOT NULL,
  `when_start` text NOT NULL,
  `how_heared_about_us` text NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `file_storage_item`
--

CREATE TABLE IF NOT EXISTS `file_storage_item` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `component` varchar(255) NOT NULL,
  `base_url` varchar(1024) NOT NULL,
  `path` varchar(1024) NOT NULL,
  `type` varchar(255) DEFAULT NULL,
  `size` int(11) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `upload_ip` varchar(15) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `i18n_message`
--

CREATE TABLE IF NOT EXISTS `i18n_message` (
  `id` int(11) NOT NULL DEFAULT '0',
  `language` varchar(16) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `translation` text COLLATE utf8_unicode_ci,
  PRIMARY KEY (`id`,`language`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `i18n_source_message`
--

CREATE TABLE IF NOT EXISTS `i18n_source_message` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL,
  `message` text COLLATE utf8_unicode_ci,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `key_storage_item`
--

CREATE TABLE IF NOT EXISTS `key_storage_item` (
  `key` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `value` text COLLATE utf8_unicode_ci NOT NULL,
  `comment` text COLLATE utf8_unicode_ci,
  `updated_at` int(11) DEFAULT NULL,
  `created_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`key`),
  UNIQUE KEY `idx_key_storage_item_key` (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `nannies`
--

CREATE TABLE IF NOT EXISTS `nannies` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `status` int(11) NOT NULL DEFAULT '0',
  `avatar_path` text NOT NULL,
  `avatar_base_url` text NOT NULL,
  `unique_link` text NOT NULL,
  `reg_date` date NOT NULL,
  `password` text NOT NULL,
  `name` text NOT NULL,
  `address` text NOT NULL,
  `zip_code` int(11) NOT NULL,
  `biography` text NOT NULL,
  `phone_home` text NOT NULL,
  `phone_cell` text NOT NULL,
  `email` text NOT NULL,
  `aviliable_for_interview` int(11) NOT NULL,
  `over_18` int(11) NOT NULL,
  `date_of_birth` text NOT NULL,
  `eligible_to_work` int(11) NOT NULL,
  `have_work_visa` int(11) NOT NULL,
  `personal_comments` text NOT NULL,
  `position_for` text NOT NULL,
  `employed` int(11) NOT NULL,
  `may_contact_employer` int(11) NOT NULL,
  `when_can_start` text NOT NULL,
  `hours_per_week` int(11) NOT NULL,
  `hourly_rate` text NOT NULL,
  `weekly_salary` int(11) NOT NULL,
  `wage_comment` text NOT NULL,
  `availability` text NOT NULL,
  `sun` text NOT NULL,
  `mon` text NOT NULL,
  `tue` text NOT NULL,
  `wed` text NOT NULL,
  `thu` text NOT NULL,
  `fri` text NOT NULL,
  `sat` text NOT NULL,
  `schedule_comment` text NOT NULL,
  `level_of_school` text NOT NULL,
  `name_of_school` text NOT NULL,
  `college` text NOT NULL,
  `college_location` text NOT NULL,
  `subjects_studied` text NOT NULL,
  `spec_training` text NOT NULL,
  `certificates` text NOT NULL,
  `childcare_exp` text NOT NULL,
  `ages_to_work_with` text NOT NULL,
  `most_exp_with` text NOT NULL,
  `cared_of_twins` text NOT NULL,
  `special_needs_exp` text NOT NULL,
  `tutor` text NOT NULL,
  `houskeeping` text NOT NULL,
  `why_want_be_nanny` text NOT NULL,
  `type_of_activities` text NOT NULL,
  `characteristics_look_for` text NOT NULL,
  `background_in_child_dev` text NOT NULL,
  `number_of_children_care_for` text NOT NULL,
  `sick_children` text NOT NULL,
  `assist_homework` text NOT NULL,
  `family_life` text NOT NULL,
  `interests` text NOT NULL,
  `philosophy` text NOT NULL,
  `most_important` text NOT NULL,
  `rate_communication_skills` int(11) NOT NULL,
  `houskeep_years_exp` text NOT NULL,
  `largest_house` text NOT NULL,
  `laundry_and_ironing` int(11) NOT NULL,
  `best_describes_housekeeping` text NOT NULL,
  `housekeep_communication_skills` int(11) NOT NULL,
  `housekeep_organization_skills` int(11) NOT NULL,
  `personal_style_of_service` text NOT NULL,
  `private_household` text NOT NULL,
  `work_at_home_with_child` int(11) NOT NULL,
  `help_with_childcare` int(11) NOT NULL,
  `not_willing_housework` text NOT NULL,
  `crp_certified` int(11) NOT NULL,
  `first_aid_certified` int(11) NOT NULL,
  `need_crp_fa_renew` int(11) NOT NULL,
  `tb_test` int(11) NOT NULL,
  `pet_allergies` int(11) NOT NULL,
  `smoking` int(11) NOT NULL,
  `work_if_parent_smokes` int(11) NOT NULL,
  `travel_restrictions` text NOT NULL,
  `valid_passport` int(11) NOT NULL,
  `work_if_parent_at_home` int(11) NOT NULL,
  `miles_to_commute` int(11) NOT NULL,
  `child_of_your_own` int(11) NOT NULL,
  `dog_cat_at_home` int(11) NOT NULL,
  `swim` int(11) NOT NULL,
  `uniform_dress_code` int(11) NOT NULL,
  `crime` text NOT NULL,
  `benefits` int(11) NOT NULL,
  `trawel_with_family` int(11) NOT NULL,
  `drive` int(11) NOT NULL,
  `have_car` int(11) NOT NULL,
  `state_licence` text NOT NULL,
  `car_insurance` int(11) NOT NULL,
  `company_car_insurance` text NOT NULL,
  `traffic_citations` text NOT NULL,
  `states_lived_in` text NOT NULL,
  `valid_licence` int(11) NOT NULL,
  `use_car_for_work` int(11) NOT NULL,
  `traffic_citations_last5_yrs` text NOT NULL,
  `car_model_year` text NOT NULL,
  `extra_activities` text NOT NULL,
  `type_of_family` text NOT NULL,
  `short_term_goals` text NOT NULL,
  `why_qualified` text NOT NULL,
  `languages` text NOT NULL,
  `heared_about_us` text NOT NULL,
  `rate_candidate` text NOT NULL,
  `notes` text NOT NULL,
  `city` int(11) NOT NULL DEFAULT '0',
  `trustline` text NOT NULL,
  `back_checks` text NOT NULL,
  `attach1` text NOT NULL,
  `attach2` text NOT NULL,
  `attach3` text NOT NULL,
  `attach12` text NOT NULL,
  `attach13` text NOT NULL,
  `attach22` text NOT NULL,
  `attach23` text NOT NULL,
  `attach32` text NOT NULL,
  `attach33` text NOT NULL,
  `locale` text NOT NULL,
  `gender` int(11) NOT NULL DEFAULT '2',
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=332 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `page`
--

CREATE TABLE IF NOT EXISTS `page` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `slug` varchar(2048) COLLATE utf8_unicode_ci NOT NULL,
  `title` varchar(512) COLLATE utf8_unicode_ci NOT NULL,
  `body` text COLLATE utf8_unicode_ci NOT NULL,
  `view` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` smallint(6) NOT NULL,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `parent_nanny`
--

CREATE TABLE IF NOT EXISTS `parent_nanny` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `parentid` int(10) UNSIGNED NOT NULL,
  `nannyid` int(10) UNSIGNED NOT NULL,
  `timestamp` int(10) UNSIGNED NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `postal_codes`
--

CREATE TABLE IF NOT EXISTS `postal_codes` (
  `country_code` char(2) NOT NULL DEFAULT '' COMMENT 'iso country code',
  `postal_code` varchar(20) NOT NULL DEFAULT '',
  `place_name` varchar(180) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `admin_name1` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '' COMMENT '1. order subdivision (state)',
  `admin_code1` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '' COMMENT '1. order subdivision (state)',
  `admin_name2` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '' COMMENT '2. order subdivision (county/province)',
  `admin_code2` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '' COMMENT '2. order subdivision (county/province)',
  `admin_name3` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '' COMMENT '3. order subdivision (community)',
  `admin_code3` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '' COMMENT '3. order subdivision (community)',
  `latitude` float NOT NULL COMMENT 'estimated latitude (wgs84)',
  `longitude` float NOT NULL COMMENT 'estimated longitude (wgs84)',
  `accuracy` tinyint(1) NOT NULL COMMENT 'accuracy of lat/lng from 1=estimated to 6=centroid',
  KEY `postal_code` (`postal_code`),
  KEY `place_name` (`place_name`,`admin_code1`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='Download and import the file `US.zip` from <http://download.geonames.org/export/zip/>\nThe GeoNames.org database is licensed under a Creative Commons Attribution 3.0 License.';

-- --------------------------------------------------------

--
-- Table structure for table `rbac_auth_assignment`
--

CREATE TABLE IF NOT EXISTS `rbac_auth_assignment` (
  `item_name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`item_name`,`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `rbac_auth_item`
--

CREATE TABLE IF NOT EXISTS `rbac_auth_item` (
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `type` smallint(6) NOT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `rule_name` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `data` blob,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`name`),
  KEY `rule_name` (`rule_name`),
  KEY `idx-auth_item-type` (`type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `rbac_auth_item_child`
--

CREATE TABLE IF NOT EXISTS `rbac_auth_item_child` (
  `parent` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `child` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`parent`,`child`),
  KEY `child` (`child`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `rbac_auth_rule`
--

CREATE TABLE IF NOT EXISTS `rbac_auth_rule` (
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `data` blob,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `refs`
--

CREATE TABLE IF NOT EXISTS `refs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` text NOT NULL,
  `reference_name` text NOT NULL,
  `reference_address` text NOT NULL,
  `contact_number` text NOT NULL,
  `ref_contact_email` text NOT NULL,
  `how_do_you_know` text NOT NULL,
  `years_known` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `system_db_migration`
--

CREATE TABLE IF NOT EXISTS `system_db_migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `system_log`
--

CREATE TABLE IF NOT EXISTS `system_log` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `level` int(11) DEFAULT NULL,
  `category` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `log_time` double DEFAULT NULL,
  `prefix` text COLLATE utf8_unicode_ci,
  `message` text COLLATE utf8_unicode_ci,
  PRIMARY KEY (`id`),
  KEY `idx_log_level` (`level`),
  KEY `idx_log_category` (`category`)
) ENGINE=InnoDB AUTO_INCREMENT=2481 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `system_rbac_migration`
--

CREATE TABLE IF NOT EXISTS `system_rbac_migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `timeline_event`
--

CREATE TABLE IF NOT EXISTS `timeline_event` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `application` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `category` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `event` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `data` text COLLATE utf8_unicode_ci,
  `created_at` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_created_at` (`created_at`)
) ENGINE=InnoDB AUTO_INCREMENT=84 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL,
  `auth_key` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `access_token` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `password_hash` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `oauth_client` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `oauth_client_user_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `credits` int(11) NOT NULL DEFAULT '0',
  `status` smallint(6) NOT NULL DEFAULT '1',
  `step` int(11) NOT NULL DEFAULT '1',
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  `logged_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=333 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user_order`
--

CREATE TABLE IF NOT EXISTS `user_order` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` int(10) UNSIGNED NOT NULL,
  `user_type` varchar(20) NOT NULL,
  `payment_gateway` varchar(20) NOT NULL,
  `payment_gateway_id` varchar(200) NOT NULL,
  `service_plan` varchar(100) CHARACTER SET utf8 NOT NULL,
  `service_money` int(10) UNSIGNED NOT NULL,
  `timestamp` int(10) UNSIGNED NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `user_profile`
--

CREATE TABLE IF NOT EXISTS `user_profile` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `firstname` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `middlename` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `lastname` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `avatar_path` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `avatar_base_url` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `locale` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `gender` smallint(1) DEFAULT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=333 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user_token`
--

CREATE TABLE IF NOT EXISTS `user_token` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `type` varchar(255) NOT NULL,
  `token` varchar(40) NOT NULL,
  `expire_at` int(11) DEFAULT NULL,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `widget_carousel`
--

CREATE TABLE IF NOT EXISTS `widget_carousel` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `key` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` smallint(6) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `widget_carousel_item`
--

CREATE TABLE IF NOT EXISTS `widget_carousel_item` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `carousel_id` int(11) NOT NULL,
  `base_url` varchar(1024) COLLATE utf8_unicode_ci DEFAULT NULL,
  `path` varchar(1024) COLLATE utf8_unicode_ci DEFAULT NULL,
  `type` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `url` varchar(1024) COLLATE utf8_unicode_ci DEFAULT NULL,
  `caption` varchar(1024) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` smallint(6) NOT NULL DEFAULT '0',
  `order` int(11) DEFAULT '0',
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_item_carousel` (`carousel_id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `widget_menu`
--

CREATE TABLE IF NOT EXISTS `widget_menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `key` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `items` text COLLATE utf8_unicode_ci NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `widget_text`
--

CREATE TABLE IF NOT EXISTS `widget_text` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `key` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `body` text COLLATE utf8_unicode_ci NOT NULL,
  `status` smallint(6) DEFAULT NULL,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_widget_text_key` (`key`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `article`
--
ALTER TABLE `article`
  ADD CONSTRAINT `fk_article_author` FOREIGN KEY (`created_by`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_article_category` FOREIGN KEY (`category_id`) REFERENCES `article_category` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_article_updater` FOREIGN KEY (`updated_by`) REFERENCES `user` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `article_attachment`
--
ALTER TABLE `article_attachment`
  ADD CONSTRAINT `fk_article_attachment_article` FOREIGN KEY (`article_id`) REFERENCES `article` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `article_category`
--
ALTER TABLE `article_category`
  ADD CONSTRAINT `fk_article_category_section` FOREIGN KEY (`parent_id`) REFERENCES `article_category` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `i18n_message`
--
ALTER TABLE `i18n_message`
  ADD CONSTRAINT `fk_i18n_message_source_message` FOREIGN KEY (`id`) REFERENCES `i18n_source_message` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `rbac_auth_assignment`
--
ALTER TABLE `rbac_auth_assignment`
  ADD CONSTRAINT `rbac_auth_assignment_ibfk_1` FOREIGN KEY (`item_name`) REFERENCES `rbac_auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `rbac_auth_item`
--
ALTER TABLE `rbac_auth_item`
  ADD CONSTRAINT `rbac_auth_item_ibfk_1` FOREIGN KEY (`rule_name`) REFERENCES `rbac_auth_rule` (`name`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `rbac_auth_item_child`
--
ALTER TABLE `rbac_auth_item_child`
  ADD CONSTRAINT `rbac_auth_item_child_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `rbac_auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `rbac_auth_item_child_ibfk_2` FOREIGN KEY (`child`) REFERENCES `rbac_auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user_profile`
--
ALTER TABLE `user_profile`
  ADD CONSTRAINT `fk_user` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `widget_carousel_item`
--
ALTER TABLE `widget_carousel_item`
  ADD CONSTRAINT `fk_item_carousel` FOREIGN KEY (`carousel_id`) REFERENCES `widget_carousel` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;