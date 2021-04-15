/*
SQLyog Community v13.1.5  (64 bit)
MySQL - 10.4.8-MariaDB : Database - baza_filmova
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`baza_filmova` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;

USE `baza_filmova`;

/*Table structure for table `angazovanje` */

DROP TABLE IF EXISTS `angazovanje`;

CREATE TABLE `angazovanje` (
  `film` bigint(20) NOT NULL,
  `glumac` bigint(20) NOT NULL,
  PRIMARY KEY (`film`,`glumac`),
  KEY `glumac` (`glumac`),
  CONSTRAINT `angazovanje_ibfk_1` FOREIGN KEY (`film`) REFERENCES `film` (`id`) ON DELETE CASCADE,
  CONSTRAINT `angazovanje_ibfk_2` FOREIGN KEY (`glumac`) REFERENCES `glumac` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `angazovanje` */

/*Table structure for table `film` */

DROP TABLE IF EXISTS `film`;

CREATE TABLE `film` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `naziv` varchar(40) DEFAULT NULL,
  `ocena` int(11) DEFAULT NULL,
  `minuti_trajanja` int(11) DEFAULT NULL,
  `zanr` bigint(20) DEFAULT NULL,
  `slika` varchar(70) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `zanr` (`zanr`),
  CONSTRAINT `film_ibfk_1` FOREIGN KEY (`zanr`) REFERENCES `zanr` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;

/*Data for the table `film` */

/*Table structure for table `glumac` */

DROP TABLE IF EXISTS `glumac`;

CREATE TABLE `glumac` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `ime` varchar(20) DEFAULT NULL,
  `prezime` varchar(30) DEFAULT NULL,
  `starost` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

/*Data for the table `glumac` */

insert  into `glumac`(`id`,`ime`,`prezime`,`starost`) values 
(1,'Morgan','Freeman',1952),
(2,'Meryl','Strip',1959);

/*Table structure for table `zanr` */

DROP TABLE IF EXISTS `zanr`;

CREATE TABLE `zanr` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `naziv` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4;

/*Data for the table `zanr` */

insert  into `zanr`(`id`,`naziv`) values 
(1,'akcioni'),
(2,'drama'),
(3,'horor'),
(4,'ljubavni'),
(5,'dokumentarni'),
(6,'sci-fi');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
