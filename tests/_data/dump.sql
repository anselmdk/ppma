DROP TABLE IF EXISTS `user`;
DROP TABLE IF EXISTS `group`;
DROP TABLE IF EXISTS `group_has_user`;

CREATE TABLE `user` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL DEFAULT '',
  `slug` varchar(255) NOT NULL DEFAULT '',
  `email` varchar(255) NOT NULL DEFAULT '',
  `password` varchar(128) NOT NULL,
  `authkey` char(40) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `authkey` (`authkey`),
  UNIQUE KEY `slug` (`slug`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `user` (`id`, `username`, `slug`, `email`, `password`, `authkey`)
  VALUES
  (1, 'janedoe', 'janedoe', 'jane@doe.com', '$2y$10$lN7IuOs6pJ8rYLExfot2pe9UwNJjuGwWlW.bEDbm9lH4bzm5VIThS', 'f30d2f04433f0db4265ddc7d39eeeb5440e65fa5');

CREATE TABLE `group` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(128) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `name` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

INSERT INTO `group` (`id`, `name`)
  VALUES
  (1, 'janedoe');

CREATE TABLE `group_has_user` (
  `groupId` bigint(20) unsigned NOT NULL,
  `userId` bigint(20) unsigned NOT NULL,
  `isManager` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`groupId`,`userId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `group_has_user` (`groupId`, `userId`, `isManager`)
  VALUES
  (1, 1, 1);

CREATE TABLE signature
(
  id INT PRIMARY KEY NOT NULL,
  signature VARCHAR(32) NOT NULL,
  expired_on TIMESTAMP DEFAULT CURRENT_TIMESTAMP NOT NULL
);
