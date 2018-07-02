CREATE TABLE `user_discount` (
  `user_id` int(10) unsigned NOT NULL,
  `discount` float NOT NULL,
  `created_at` int(10) unsigned NOT NULL,
  `expired_at` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4
