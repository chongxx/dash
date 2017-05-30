
-- ----------------------
-- 文章
-- ----------------------
DROP TABLE IF EXISTS `article`;
CREATE TABLE `article`(
  `aid` int(10) NOT NULL AUTO_INCREMENT,
  `title` char(255) NOT NULL DEFAULT 'no title',
  `author` varchar(15) NOT NULL DEFAULT 'no author',
  `content` mediumtext NOT NULL,
  `keywords` varchar(256) NOT NULL DEFAULT '',
  `desc` varchar(256) NOT NULL DEFAULT '',
  `is_show` tinyint(1) NOT NULL DEFAULT '1',
  `is_delete` tinyint(1) NOT NULL DEFAULT '0',
  `is_top` tinyint(1) NOT NULL DEFAULT '0',
  `views` int(10) NOT NULL DEFAULT '0',
  `time` int(10) NOT NULL DEFAULT '0',
  `cid` tinyint(2) NOT NULL DEFAULT '0',
  PRIMARY KEY (aid)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;
