CREATE DATABASE IF NOT EXISTS `testecd2` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `testecd2`;

DROP TABLE IF EXISTS `address`;
CREATE TABLE IF NOT EXISTS `address` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cep` int(8) DEFAULT NULL,
  `street` varchar(255) DEFAULT NULL,
  `district` varchar(40) DEFAULT NULL,
  `city` varchar(40) DEFAULT NULL,
  `uf` varchar(2) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
