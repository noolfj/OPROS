/*
SQLyog Professional v13.1.1 (64 bit)
MySQL - 8.0.24 : Database - oprosnik
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`oprosnik` /*!40100 DEFAULT CHARACTER SET utf8 */ /*!80016 DEFAULT ENCRYPTION='N' */;

USE `oprosnik`;

/*Table structure for table `comment` */

DROP TABLE IF EXISTS `comment`;

CREATE TABLE `comment` (
  `id` int NOT NULL AUTO_INCREMENT,
  `commentText` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

/*Data for the table `comment` */

/*Table structure for table `cycle` */

DROP TABLE IF EXISTS `cycle`;

CREATE TABLE `cycle` (
  `id` int NOT NULL AUTO_INCREMENT,
  `lessonCycle` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

/*Data for the table `cycle` */

/*Table structure for table `opros` */

DROP TABLE IF EXISTS `opros`;

CREATE TABLE `opros` (
  `id` int NOT NULL AUTO_INCREMENT,
  `prepodavateliId` int NOT NULL,
  `lessonscycleId` int NOT NULL,
  `subjectId` int NOT NULL,
  `questionId` int NOT NULL,
  `ratingId` int NOT NULL,
  `commentId` int NOT NULL,
  `createDate` date NOT NULL,
  PRIMARY KEY (`id`),
  KEY `prepodavateliId` (`prepodavateliId`),
  KEY `lessonscycleId` (`lessonscycleId`),
  KEY `subjectId` (`subjectId`),
  KEY `questionId` (`questionId`),
  KEY `ratingId` (`ratingId`),
  KEY `commentId` (`commentId`),
  CONSTRAINT `opros_ibfk_1` FOREIGN KEY (`prepodavateliId`) REFERENCES `prepodavateli` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `opros_ibfk_2` FOREIGN KEY (`lessonscycleId`) REFERENCES `cycle` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `opros_ibfk_3` FOREIGN KEY (`subjectId`) REFERENCES `predmet` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `opros_ibfk_4` FOREIGN KEY (`questionId`) REFERENCES `question` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `opros_ibfk_5` FOREIGN KEY (`ratingId`) REFERENCES `rating` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `opros_ibfk_6` FOREIGN KEY (`commentId`) REFERENCES `comment` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

/*Data for the table `opros` */

/*Table structure for table `predmet` */

DROP TABLE IF EXISTS `predmet`;

CREATE TABLE `predmet` (
  `id` int NOT NULL AUTO_INCREMENT,
  `subject` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

/*Data for the table `predmet` */

/*Table structure for table `prepodavateli` */

DROP TABLE IF EXISTS `prepodavateli`;

CREATE TABLE `prepodavateli` (
  `id` int NOT NULL AUTO_INCREMENT,
  `firstName` varchar(50) NOT NULL,
  `lastName` varchar(50) NOT NULL,
  `middleName` varchar(50) NOT NULL,
  `doljnost` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

/*Data for the table `prepodavateli` */

/*Table structure for table `question` */

DROP TABLE IF EXISTS `question`;

CREATE TABLE `question` (
  `id` int NOT NULL AUTO_INCREMENT,
  `questionText` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

/*Data for the table `question` */

/*Table structure for table `rating` */

DROP TABLE IF EXISTS `rating`;

CREATE TABLE `rating` (
  `id` int NOT NULL AUTO_INCREMENT,
  `rating` int NOT NULL,
  `oprosId` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `rating` (`rating`),
  KEY `oprosId` (`oprosId`),
  CONSTRAINT `rating_ibfk_1` FOREIGN KEY (`oprosId`) REFERENCES `opros` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

/*Data for the table `rating` */

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
