CREATE TABLE IF NOT EXISTS `task_manager`.`tasks`
(
    `id`      INT(11)    NOT NULL AUTO_INCREMENT,
    `user_id` INT(11)    NOT NULL,
    `task`    TEXT       NOT NULL,
    `status`  TINYINT(2) NOT NULL,
    PRIMARY KEY (`id`)
)
    ENGINE = InnoDB
    CHARSET = utf8
    COLLATE utf8_general_ci;