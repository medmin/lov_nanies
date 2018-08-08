ALTER TABLE `user_discount` DROP PRIMARY KEY;
ALTER TABLE `user_discount` ADD `type` TINYINT NOT NULL DEFAULT '1' COMMENT '1 nanny ; 2 family_post' AFTER `user_id`;
ALTER TABLE `user_discount` ADD PRIMARY KEY(user_id,type);