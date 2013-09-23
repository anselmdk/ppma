CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `encryptionKey` text,
  `isAdmin` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

INSERT INTO `user` (`id`, `username`, `password`, `encryptionKey`, `isAdmin`)
  VALUES
  (1, 'root', '$2a$12$GM3gXSA87uFNLQ.P0vf8y.ADwfbE9ToZdG5xy3K6D0Y/UMMGgFjcG', 'O50fd2UjTG5YpTOfCjEPfRiuNEait3Q3YuXu/y8+eDwn6LlbeVDS+qRXjZYtrLzSfFXB6yXi/Zj0g3ORdRpCEQ==', 1); #root:password
