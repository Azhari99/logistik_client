/*
SQLyog Ultimate v10.42 
MySQL - 5.5.5-10.1.31-MariaDB : Database - db_inventori_isma
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`db_inventori_isma` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `db_inventori_isma`;

/*Table structure for table `tbl_menu` */

DROP TABLE IF EXISTS `tbl_menu`;

CREATE TABLE `tbl_menu` (
  `tbl_menu_id` int(10) NOT NULL AUTO_INCREMENT,
  `isactive` char(1) NOT NULL DEFAULT 'Y',
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `createdby` int(10) NOT NULL,
  `updated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updatedby` int(10) NOT NULL,
  `name` varchar(60) NOT NULL,
  `seqno` decimal(10,0) NOT NULL,
  `url` varchar(25) NOT NULL,
  `icon` varchar(60) NOT NULL,
  PRIMARY KEY (`tbl_menu_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_menu` */

insert  into `tbl_menu`(`tbl_menu_id`,`isactive`,`created`,`createdby`,`updated`,`updatedby`,`name`,`seqno`,`url`,`icon`) values (1,'Y','2020-05-13 09:48:58',1,'2020-05-13 09:48:58',1,'Dashboard',1,'','fa fa-dashboard'),(2,'Y','2020-05-13 09:49:32',1,'2020-05-13 09:49:32',1,'Transaction',2,'','fa fa-recycle'),(3,'Y','2020-05-13 09:49:59',1,'2020-05-13 09:49:59',1,'Request Product',3,'requestin','fa fa-list'),(4,'Y','2020-05-13 09:50:16',1,'2020-05-13 09:50:16',1,'Report',4,'','fa fa-file'),(5,'Y','2020-05-13 10:01:43',1,'2020-05-13 10:01:43',1,'Master Data',5,'','fa fa-laptop'),(6,'Y','2020-05-13 10:02:25',1,'2020-05-13 10:03:13',1,'Setting',6,'','fa fa-users');

/*Table structure for table `tbl_submenu` */

DROP TABLE IF EXISTS `tbl_submenu`;

CREATE TABLE `tbl_submenu` (
  `tbl_submenu_id` int(10) NOT NULL AUTO_INCREMENT,
  `isactive` char(1) NOT NULL DEFAULT 'Y',
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `createdby` int(10) NOT NULL,
  `updated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updatedby` int(10) NOT NULL,
  `tbl_menu_id` int(10) NOT NULL,
  `name` varchar(60) NOT NULL,
  `seqno` decimal(10,0) NOT NULL,
  `url` varchar(25) NOT NULL,
  PRIMARY KEY (`tbl_submenu_id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_submenu` */

insert  into `tbl_submenu`(`tbl_submenu_id`,`isactive`,`created`,`createdby`,`updated`,`updatedby`,`tbl_menu_id`,`name`,`seqno`,`url`) values (1,'Y','2020-05-13 10:41:44',1,'2020-05-13 10:41:44',1,5,'Product',1,'product'),(2,'Y','2020-05-13 10:42:22',1,'2020-05-13 10:42:36',1,5,'Category',2,'category'),(3,'Y','2020-05-13 10:42:56',1,'2020-05-13 10:42:56',1,5,'Type Logistics',3,'type'),(4,'Y','2020-05-13 10:43:33',1,'2020-05-13 10:43:33',1,5,'Annual Budget',4,'budget'),(5,'Y','2020-05-13 10:48:14',1,'2020-05-13 10:49:09',1,5,'Menu',6,'menu'),(6,'Y','2020-05-13 10:48:25',1,'2020-05-13 10:49:15',1,5,'Submenu',7,'submenu'),(7,'Y','2020-05-13 10:48:45',1,'2020-05-13 10:48:45',1,5,'Institute',5,'institute'),(8,'Y','2020-05-13 10:49:39',1,'2020-05-13 10:49:39',1,6,'Users',1,'users'),(9,'Y','2020-05-13 10:49:57',1,'2020-05-13 10:49:57',1,4,'Report Product Budget Out',1,'rpt_budgetout'),(10,'Y','2020-05-13 10:50:34',1,'2020-05-13 10:51:10',1,2,'Product In',1,'productin'),(11,'Y','2020-05-13 10:50:47',1,'2020-05-13 10:50:47',1,2,'Product Out',2,'productout');

/*Table structure for table `tbl_user` */

DROP TABLE IF EXISTS `tbl_user`;

CREATE TABLE `tbl_user` (
  `tbl_user_id` int(10) NOT NULL AUTO_INCREMENT,
  `isactive` char(1) NOT NULL DEFAULT 'Y',
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `createdby` int(10) NOT NULL,
  `updated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updatedby` int(10) NOT NULL,
  `value` varchar(10) NOT NULL,
  `name` varchar(60) NOT NULL,
  `password` varchar(255) NOT NULL,
  `level` int(10) NOT NULL,
  `lastlogin` timestamp NULL DEFAULT NULL,
  `changedpassword` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`tbl_user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_user` */

insert  into `tbl_user`(`tbl_user_id`,`isactive`,`created`,`createdby`,`updated`,`updatedby`,`value`,`name`,`password`,`level`,`lastlogin`,`changedpassword`) values (1,'Y','2020-05-04 12:52:53',1,'2020-05-31 18:49:47',1,'admin','Awn Admin','$2y$10$l3yJgjZu9F62I32efAKr/utUWErHYWgLAYLqwkD6LsOPCTWqP5YuW',1,'2020-06-07 01:27:46','2020-05-31 18:49:47'),(2,'Y','2020-05-31 12:21:39',1,'2020-05-31 12:26:20',2,'Oki-170903','Oki Permana','$2y$10$Cb9Iuyq7s1DrUQ/I/jRNBOe2zy1DB.RmGdCzSsdi15BVA6A/wQ3HK',3,'2020-06-07 01:23:27','2020-05-31 12:26:20'),(3,'Y','2020-06-06 12:29:03',1,'2020-06-06 12:29:03',1,'dbz','dbz','$2y$10$v9Tle0rr8V6Jvn/yhLu1MO7OSjBy/nRdqKPoOqLhdj1mYXSdXXrue',2,'2020-06-07 01:28:16',NULL);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
