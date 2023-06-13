-- Adminer 4.8.1 MySQL 10.4.28-MariaDB dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

SET NAMES utf8mb4;

CREATE DATABASE `address_book` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */;
USE `address_book`;

DROP TABLE IF EXISTS `addressbook`;
CREATE TABLE `addressbook` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `name` mediumtext NOT NULL,
  `fname` mediumtext NOT NULL,
  `email` mediumtext NOT NULL,
  `street` mediumtext NOT NULL,
  `zipcode` mediumtext NOT NULL,
  `city` mediumtext NOT NULL,
  `regdate` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `addressbook` (`id`, `name`, `fname`, `email`, `street`, `zipcode`, `city`, `regdate`) VALUES
(1,	'MANIVANNAN',	'Mani',	'admin@admin.com',	'123 school street',	'631302',	'Chennai',	'2023-06-13 15:36:48'),
(2,	'Test',	'Test name',	'test@email.com',	'test street',	'631302',	'kovai',	'2023-06-13 17:32:58');

DROP TABLE IF EXISTS `city`;
CREATE TABLE `city` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `city` text NOT NULL,
  `state` text NOT NULL,
  `country` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

INSERT INTO `city` (`id`, `city`, `state`, `country`) VALUES
(1,	'Chennai',	'Tamilnadu',	'INDIA'),
(2,	'kovai',	'Tamilnadu',	'INDIA');

-- 2023-06-13 18:32:21
