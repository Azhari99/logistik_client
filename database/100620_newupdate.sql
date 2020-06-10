/*
SQLyog Ultimate v10.42 
MySQL - 5.5.5-10.1.31-MariaDB : Database - inventori_client
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`inventori_client` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `inventori_client`;

/*Table structure for table `tbl_barang_masuk` */

DROP TABLE IF EXISTS `tbl_barang_masuk`;

CREATE TABLE `tbl_barang_masuk` (
  `id_barang_masuk` int(11) NOT NULL AUTO_INCREMENT,
  `kode_barang` varchar(6) NOT NULL,
  `nama_barang` varchar(50) NOT NULL,
  `instansi` varchar(50) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `documentno` varchar(30) NOT NULL,
  `unitprice` int(11) NOT NULL,
  `amount` bigint(20) NOT NULL,
  `tgl_barang_masuk` date NOT NULL,
  `keterangan` varchar(255) NOT NULL,
  `stat` int(11) NOT NULL,
  `pathDownload` varchar(500) DEFAULT NULL,
  KEY `id_barang_masuk` (`id_barang_masuk`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_barang_masuk` */

insert  into `tbl_barang_masuk`(`id_barang_masuk`,`kode_barang`,`nama_barang`,`instansi`,`jumlah`,`documentno`,`unitprice`,`amount`,`tgl_barang_masuk`,`keterangan`,`stat`,`pathDownload`) values (1,'PS0001','KOMPUTER','UI',1,'POT-0006',1000000,1000000,'2020-06-09','test',1,'http://localhost/logistik/productout/download/item_200609_095947_a9594a9dd7.pdf'),(2,'PS0001','KOMPUTER','UI',1,'PROUT-0007',1000000,1000000,'2020-06-09','test',1,''),(3,'PS0001','KOMPUTER','UI',1,'PROUT-0008',1000000,1000000,'2020-06-09','test 2',1,''),(4,'PS0001','KOMPUTER','UI',1,'PROUT-0009',1000000,1000000,'2020-06-09','test upload',1,'');

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

insert  into `tbl_menu`(`tbl_menu_id`,`isactive`,`created`,`createdby`,`updated`,`updatedby`,`name`,`seqno`,`url`,`icon`) values (1,'Y','2020-05-13 09:48:58',1,'2020-05-13 09:48:58',1,'Dashboard',1,'','fa fa-dashboard'),(2,'Y','2020-05-13 09:49:32',1,'2020-05-13 09:49:32',1,'Transaction',2,'','fa fa-recycle'),(3,'Y','2020-05-13 09:49:59',1,'2020-06-08 23:22:31',1,'Request Product',3,'requestout','fa fa-list'),(4,'Y','2020-05-13 09:50:16',1,'2020-05-13 09:50:16',1,'Report',4,'','fa fa-file'),(5,'Y','2020-05-13 10:01:43',1,'2020-05-13 10:01:43',1,'Master Data',5,'','fa fa-laptop'),(6,'Y','2020-05-13 10:02:25',1,'2020-05-13 10:03:13',1,'Setting',6,'','fa fa-users');

/*Table structure for table `tbl_permintaan` */

DROP TABLE IF EXISTS `tbl_permintaan`;

CREATE TABLE `tbl_permintaan` (
  `tbl_permintaan_id` int(10) NOT NULL AUTO_INCREMENT,
  `isactive` char(1) NOT NULL DEFAULT 'Y',
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `createdby` int(10) NOT NULL,
  `updated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updatedby` int(10) NOT NULL,
  `documentno` varchar(30) NOT NULL,
  `tbl_barang_id` int(11) NOT NULL,
  `nama_barang` varchar(60) NOT NULL,
  `tbl_instansi_id` int(11) NOT NULL,
  `nama_instansi` varchar(60) NOT NULL,
  `datetrx` date NOT NULL,
  `status` char(2) NOT NULL,
  `qtyentered` int(10) NOT NULL,
  `unitprice` int(11) NOT NULL,
  `amount` bigint(20) NOT NULL,
  `keterangan` varchar(255) NOT NULL,
  `file` varchar(500) NOT NULL,
  PRIMARY KEY (`tbl_permintaan_id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_permintaan` */

insert  into `tbl_permintaan`(`tbl_permintaan_id`,`isactive`,`created`,`createdby`,`updated`,`updatedby`,`documentno`,`tbl_barang_id`,`nama_barang`,`tbl_instansi_id`,`nama_instansi`,`datetrx`,`status`,`qtyentered`,`unitprice`,`amount`,`keterangan`,`file`) values (1,'Y','2020-05-09 06:09:46',0,'2020-05-09 06:09:46',0,'PROUT-0001',1,'BUKU',3,'UI','2020-05-09','CO',4,8000,32000,'Test Request Out',''),(2,'Y','2020-05-09 07:32:45',0,'2020-05-09 07:32:45',0,'PROUT-0002',1,'BUKU',3,'UI','2020-05-09','CO',5,8000,40000,'Test Request 2',''),(5,'Y','2020-05-12 22:57:57',0,'2020-05-12 22:57:57',0,'PROUT-0003',1,'BUKU',3,'UI','2020-05-12','P',10,8000,80000,'',''),(6,'Y','2020-05-12 23:06:54',0,'2020-05-12 23:06:54',0,'PROUT-0004',2,'PULPEN',3,'UI','2020-05-12','P',1,8000,8000,'',''),(7,'Y','2020-05-12 23:08:09',0,'2020-05-12 23:08:09',0,'PROUT-0005',1,'BUKU',3,'UI','2020-05-12','CO',1,8000,8000,'',''),(8,'Y','2020-05-12 23:10:12',0,'2020-05-12 23:10:12',0,'PROUT-0006',1,'BUKU',3,'UI','2020-05-12','CO',10,8000,80000,'',''),(9,'Y','2020-06-09 10:53:29',0,'2020-06-09 10:53:29',0,'PROUT-0007',1,'KOMPUTER',3,'UI','2020-06-09','CO',1,1000000,1000000,'test',''),(10,'Y','2020-06-09 11:03:46',0,'2020-06-09 11:03:46',0,'PROUT-0008',1,'KOMPUTER',3,'UI','2020-06-09','CO',1,1000000,1000000,'test 2',''),(13,'Y','2020-06-09 15:01:47',1,'2020-06-09 15:01:47',1,'PROUT-0009',1,'KOMPUTER',3,'UI','2020-06-09','CO',1,1000000,1000000,'test upload','item_200609_150146_df12a4db4c.pdf');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
