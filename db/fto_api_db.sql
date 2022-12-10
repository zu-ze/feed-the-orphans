-- Adminer 4.7.7 MySQL dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP TABLE IF EXISTS `approvedDonation`;
CREATE TABLE `approvedDonation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sentTransId` int(11) NOT NULL,
  `receivedTransId` int(11) NOT NULL,
  `createdAt` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE current_timestamp(),
  `updatedAt` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `contact`;
CREATE TABLE `contact` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `orphanageId` int(11) NOT NULL,
  `type` enum('"airtel money","mpamba","bank"') NOT NULL,
  `number` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `createdAt` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE current_timestamp(),
  `updatedAt` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `orphanageId` (`orphanageId`),
  CONSTRAINT `contact_ibfk_1` FOREIGN KEY (`orphanageId`) REFERENCES `orphanage` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `event`;
CREATE TABLE `event` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `orphanageId` int(11) NOT NULL,
  `eventDate` date NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `createdAt` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updatedAt` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `orphanageId` (`orphanageId`),
  CONSTRAINT `event_ibfk_1` FOREIGN KEY (`orphanageId`) REFERENCES `orphanage` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

INSERT INTO `event` (`id`, `orphanageId`, `eventDate`, `title`, `description`, `createdAt`, `updatedAt`) VALUES
(1,	1,	'2022-01-31',	'Test Event',	'Test description',	'2022-01-31 09:11:10',	'0000-00-00 00:00:00'),
(2,	3,	'2022-01-01',	'Test Event 01',	'&amp;lt;div&amp;gt;Test Activity List:&amp;lt;/div&amp;gt;&amp;lt;div&amp;gt;&amp;lt;ol&amp;gt;&amp;lt;li&amp;gt;national anthem&amp;lt;/li&amp;gt;&amp;lt;li&amp;gt;opening prayer&amp;lt;/li&amp;gt;&amp;lt;li&amp;gt;opening remarks from director&amp;lt;/li&amp;gt;&amp;lt;li&amp;gt;talent showcase&amp;lt;/li&amp;gt;&amp;lt;li&amp;gt;etc...&amp;lt;br&amp;gt;&amp;lt;/li&amp;gt;&amp;lt;/ol&amp;gt;&amp;lt;/div&amp;gt;',	'2022-01-31 20:30:15',	'0000-00-00 00:00:00'),
(3,	3,	'2022-01-06',	'Test Event 02',	'&amp;lt;div&amp;gt;Activity list:&amp;lt;/div&amp;gt;&amp;lt;div&amp;gt;&amp;lt;ol&amp;gt;&amp;lt;li&amp;gt;moog&amp;lt;/li&amp;gt;&amp;lt;li&amp;gt;loog&amp;lt;/li&amp;gt;&amp;lt;li&amp;gt;joog&amp;lt;/li&amp;gt;&amp;lt;li&amp;gt;goog&amp;lt;br&amp;gt;&amp;lt;/li&amp;gt;&amp;lt;/ol&amp;gt;&amp;lt;/div&amp;gt;',	'2022-01-31 20:33:35',	'0000-00-00 00:00:00')
ON DUPLICATE KEY UPDATE `id` = VALUES(`id`), `orphanageId` = VALUES(`orphanageId`), `eventDate` = VALUES(`eventDate`), `title` = VALUES(`title`), `description` = VALUES(`description`), `createdAt` = VALUES(`createdAt`), `updatedAt` = VALUES(`updatedAt`);

DROP TABLE IF EXISTS `orphanage`;
CREATE TABLE `orphanage` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `adminId` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `latitude` double DEFAULT NULL,
  `longitude` double DEFAULT NULL,
  `district` varchar(255) DEFAULT NULL,
  `area` varchar(255) DEFAULT NULL,
  `mission` text DEFAULT NULL,
  `vision` text DEFAULT NULL,
  `createdAt` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE current_timestamp(),
  `updatedAt` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`),
  UNIQUE KEY `adminId` (`adminId`),
  CONSTRAINT `orphanage_ibfk_1` FOREIGN KEY (`adminId`) REFERENCES `user` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

INSERT INTO `orphanage` (`id`, `adminId`, `name`, `latitude`, `longitude`, `district`, `area`, `mission`, `vision`, `createdAt`, `updatedAt`) VALUES
(1,	45,	'Save The Children',	0,	0,	'',	'',	'',	'',	'2022-01-29 14:01:07',	'0000-00-00 00:00:00'),
(3,	49,	'Mzuzu Crisis Nursey',	0,	0,	'',	'',	'',	'',	'2022-01-29 14:33:57',	'0000-00-00 00:00:00'),
(4,	50,	'Chisomo Nursey',	0,	0,	'',	'',	'',	'',	'2022-01-29 14:37:02',	'0000-00-00 00:00:00')
ON DUPLICATE KEY UPDATE `id` = VALUES(`id`), `adminId` = VALUES(`adminId`), `name` = VALUES(`name`), `latitude` = VALUES(`latitude`), `longitude` = VALUES(`longitude`), `district` = VALUES(`district`), `area` = VALUES(`area`), `mission` = VALUES(`mission`), `vision` = VALUES(`vision`), `createdAt` = VALUES(`createdAt`), `updatedAt` = VALUES(`updatedAt`);

DROP TABLE IF EXISTS `population`;
CREATE TABLE `population` (
  `orphanageId` int(11) NOT NULL,
  `male_1_to_10` int(11) NOT NULL,
  `female_1_to_10` int(11) NOT NULL,
  `male_11_to_15` int(11) NOT NULL,
  `female_11_to_15` int(11) NOT NULL,
  `male_16_to_18` int(11) NOT NULL,
  `female_16_to_18` int(11) NOT NULL,
  KEY `orphanageId` (`orphanageId`),
  CONSTRAINT `population_ibfk_1` FOREIGN KEY (`orphanageId`) REFERENCES `orphanage` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `receivedDonation`;
CREATE TABLE `receivedDonation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `receivedTransId` varchar(255) NOT NULL,
  `typeOfTransaction` int(11) NOT NULL,
  `orphanageId` int(11) NOT NULL,
  `createdAt` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE current_timestamp(),
  `updatedAt` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `orphanageId` (`orphanageId`),
  CONSTRAINT `receivedDonation_ibfk_1` FOREIGN KEY (`orphanageId`) REFERENCES `orphanage` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `sentDonation`;
CREATE TABLE `sentDonation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sentTransId` varchar(255) NOT NULL,
  `userId` int(11) NOT NULL,
  `typeOfTransaction` int(11) NOT NULL,
  `orphanageId` int(11) NOT NULL,
  `createdAt` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE current_timestamp(),
  `updatedAt` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `orphanageId` (`orphanageId`),
  KEY `userId` (`userId`),
  CONSTRAINT `sentDonation_ibfk_1` FOREIGN KEY (`orphanageId`) REFERENCES `orphanage` (`id`),
  CONSTRAINT `sentDonation_ibfk_2` FOREIGN KEY (`userId`) REFERENCES `user` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `status` char(11) NOT NULL,
  `role` char(11) NOT NULL,
  `userName` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `createdAt` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updatedAt` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `userName` (`userName`)
) ENGINE=InnoDB AUTO_INCREMENT=51 DEFAULT CHARSET=latin1;

INSERT INTO `user` (`id`, `status`, `role`, `userName`, `password`, `email`, `phone`, `createdAt`, `updatedAt`) VALUES
(1,	'active',	'donor',	'jonathan',	'password1234',	'jonathan@gmail.com',	'0999999999',	'2022-01-06 06:47:42',	'2022-01-06 06:52:41'),
(2,	'active',	'donor',	'james',	'password1234',	'james112@gmail.com',	'0998997654',	'2022-01-06 06:54:22',	'2022-01-06 06:54:54'),
(4,	'active',	'donor',	'manni',	'manni3434',	'manni34@yahoo.com',	'012235456',	'2022-01-06 07:15:52',	'0000-00-00 00:00:00'),
(5,	'active',	'donor',	'koldo',	'12345678',	'koldo09@yahoo.com',	'0987556478',	'2022-01-06 07:18:16',	'0000-00-00 00:00:00'),
(33,	'active',	'donor',	'kelz',	'kelz1234',	'kelzkelz@gmail.com',	'0998765412',	'2022-01-06 15:46:09',	'0000-00-00 00:00:00'),
(35,	'active',	'donor',	'nyetha',	'nyetha123',	'nyetha@yahoo.com',	'0998765234',	'2022-01-06 16:20:14',	'0000-00-00 00:00:00'),
(37,	'active',	'admin',	'fada',	'$2y$10$hH4p.hE5QpVfjS8PVl97ZOm8ewTM71RFF8npeCRiCdMvUd2CIfPV2',	'admin@yahoo.com',	'0995388994',	'0000-00-00 00:00:00',	'2022-01-28 09:10:26'),
(45,	'active',	'orphanage',	'jane',	'$2y$10$.g9xqATO..Y4mV7iAm/VRujRnTjXU8x0JY3FYHfT7KnpVQbO9Q44.',	'jane@yahoo.com',	'xxxx-xxx-xxx',	'2022-01-29 11:56:58',	'0000-00-00 00:00:00'),
(49,	'active',	'orphanage',	'mannie',	'$2y$10$hT8LzsUdCXqb7/FfHNDc2.BL8IVYC8cXb//dTXhvrxk2uzx0olZE2',	'mannie@yahoo.com',	'xxxx-xxx-xxx',	'2022-01-29 14:30:46',	'0000-00-00 00:00:00'),
(50,	'active',	'orphanage',	'robert',	'$2y$10$uS8akg6ocq9sWwTUZR8IguUqHqrPBXrCCZ9Yvv7bYJlG3DVcW5V6S',	'robert@yahoo.com',	'xxxx-xxx-xxx',	'2022-01-29 14:34:45',	'0000-00-00 00:00:00')
ON DUPLICATE KEY UPDATE `id` = VALUES(`id`), `status` = VALUES(`status`), `role` = VALUES(`role`), `userName` = VALUES(`userName`), `password` = VALUES(`password`), `email` = VALUES(`email`), `phone` = VALUES(`phone`), `createdAt` = VALUES(`createdAt`), `updatedAt` = VALUES(`updatedAt`);

-- 2022-02-02 09:36:41
