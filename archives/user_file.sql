DROP TABLE IF EXISTS `user_file`;
CREATE TABLE `user_file` (
 `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
 `user_id` int(11) NOT NULL,
 `file_uuid` varchar(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
 `title` varchar(300) COLLATE utf8mb4_unicode_ci NOT NULL,
 `link` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
 `status` tinyint(4) NOT NULL DEFAULT 1,
 `created_at` int(10) unsigned NOT NULL,
 `updated_at` int(10) unsigned DEFAULT NULL,
 `deleted_at` int(10) unsigned DEFAULT NULL,
 PRIMARY KEY (`id`),
 KEY `user_id` (`user_id`),
 CONSTRAINT `user_file_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;