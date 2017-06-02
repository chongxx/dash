-- ----------------------
-- 文章
-- ----------------------
DROP TABLE IF EXISTS `article`;
CREATE TABLE `article` (
  `aid`       INT(10)      NOT NULL AUTO_INCREMENT,
  `title`     CHAR(255)    NOT NULL DEFAULT 'no title',
  `author`    VARCHAR(15)  NOT NULL DEFAULT 'no author',
  `content`   MEDIUMTEXT   NOT NULL,
  `keywords`  VARCHAR(256) NOT NULL DEFAULT '',
  `desc`      VARCHAR(256) NOT NULL DEFAULT '',
  `is_show`   TINYINT(1)   NOT NULL DEFAULT '1',
  `is_delete` TINYINT(1)   NOT NULL DEFAULT '0',
  `is_top`    TINYINT(1)   NOT NULL DEFAULT '0',
  `views`     INT(10)      NOT NULL DEFAULT '0',
  `time`      INT(10)      NOT NULL DEFAULT '0',
  `cid`       TINYINT(2)   NOT NULL DEFAULT '0',
  PRIMARY KEY (aid)
)
  ENGINE = InnoDB
  DEFAULT CHARSET = utf8;

-- ----------------------
-- 用户
-- ----------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `user_name`     VARCHAR(16) NOT NULL UNIQUE,
  `pwd`           VARCHAR(32) NOT NULL,
  `register_time` INT(10)     NOT NULL,
  `avatar`        VARCHAR(255)         DEFAULT '',
  `status`        TINYINT(1)  NOT NULL DEFAULT '1',
  `email`         VARCHAR(20)          DEFAULT '',
  `type`          TINYINT(1)           DEFAULT '2',
  `login_times`   INT(6)               DEFAULT '0',
  `last_login`    INT(10)     NOT NULL,
  PRIMARY KEY (user_name)
)
  ENGINE = InnoDB
  DEFAULT CHARSET = utf8;