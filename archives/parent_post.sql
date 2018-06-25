START TRANSACTION;
DROP TABLE IF EXISTS `parent_post`;
CREATE TABLE IF NOT EXISTS `parent_post` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `zip_code` int(11) NOT NULL,
  `job_type` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type_of_help` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL,
  `created_at` int(11) NOT NULL,
  `expired_at` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
ALTER TABLE `parent_post`
  ADD CONSTRAINT `parent_post_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);
COMMIT;
ALTER TABLE `parent_post` ADD `summary` VARCHAR(300) NOT NULL AFTER `type_of_help`;
ALTER TABLE `parent_post` ADD `updated_at` INT UNSIGNED NOT NULL AFTER `created_at`;
ALTER TABLE `parent_post` ADD `remark` VARCHAR(500) NULL AFTER `expired_at`;