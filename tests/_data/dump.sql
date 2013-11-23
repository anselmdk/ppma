DROP TABLE IF EXISTS `user`;

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