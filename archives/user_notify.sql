CREATE TABLE `user_notify` (
 `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
 `subject` varchar(1000) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '主题',
 `content` text COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '内容',
 `sender_id` int(10) unsigned NOT NULL COMMENT '发送方',
 `receiver_id` int(10) unsigned NOT NULL COMMENT '接收方',
 `pid` int(10) unsigned DEFAULT NULL COMMENT '回复的哪一个信息',
 `job_post_id` int(10) UNSIGNED NULL COMMENT '帖子id',
 `status` tinyint(4) NOT NULL DEFAULT '1',
 `is_read` tinyint(4) NOT NULL DEFAULT '0' COMMENT '是否已读',
 `send_mail` tinyint(4) NOT NULL DEFAULT '0' COMMENT '是否已经发送邮件',
 `created_at` int(10) unsigned NOT NULL,
 `sender_at` int(10) unsigned DEFAULT NULL COMMENT '发送时间',
 PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci
