ALTER TABLE `tasks` ADD `username` VARCHAR(255) NOT NULL AFTER `user_id`;
ALTER TABLE `tasks` ADD `email` VARCHAR(255) NOT NULL AFTER `username`;
ALTER TABLE `tasks` DROP `user_id`;