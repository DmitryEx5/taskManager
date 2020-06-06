CREATE TABLE IF NOT EXISTS `task_manager`.`users`
(
    `id`       INT(11)               NOT NULL AUTO_INCREMENT,
    `username` VARCHAR(255)          NOT NULL,
    `email`    VARCHAR(255)          NOT NULL,
    `password` VARCHAR(255)          NOT NULL,
    `role`     ENUM ('user','admin') NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE = InnoDB
  CHARSET = utf8
  COLLATE utf8_general_ci;
