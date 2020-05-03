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

/*Table structure for table `tbl_admin` */

DROP TABLE IF EXISTS `tbl_admin`;

CREATE TABLE `tbl_admin` (
  `id_admin` int(3) NOT NULL AUTO_INCREMENT,
  `nama` varchar(50) NOT NULL,
  `username` varchar(23) NOT NULL,
  `password` varchar(23) NOT NULL,
  `level` int(4) NOT NULL,
  PRIMARY KEY (`id_admin`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_admin` */

insert  into `tbl_admin`(`id_admin`,`nama`,`username`,`password`,`level`) values (1,'admin','admin','123',1),(2,'Pimpinan','pimpinan','123',2),(3,'user','user','123',3),(4,'Indra','Indra','123',1);

/*Table structure for table `tbl_barang` */

DROP TABLE IF EXISTS `tbl_barang`;

CREATE TABLE `tbl_barang` (
  `tbl_barang_id` int(10) NOT NULL AUTO_INCREMENT,
  `isactive` char(1) NOT NULL DEFAULT 'Y',
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `createdby` int(10) NOT NULL,
  `updated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updatedby` int(10) NOT NULL,
  `value` varchar(6) NOT NULL,
  `name` varchar(60) NOT NULL,
  `jenis_id` int(10) NOT NULL,
  `kategori_id` int(10) NOT NULL,
  `keterangan` varchar(255) DEFAULT NULL,
  `qtyentered` decimal(10,0) NOT NULL,
  `qtyavailable` decimal(10,0) NOT NULL,
  PRIMARY KEY (`tbl_barang_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_barang` */

insert  into `tbl_barang`(`tbl_barang_id`,`isactive`,`created`,`createdby`,`updated`,`updatedby`,`value`,`name`,`jenis_id`,`kategori_id`,`keterangan`,`qtyentered`,`qtyavailable`) values (1,'Y','2020-04-07 21:03:04',0,'2020-04-10 16:55:08',0,'PS0001','PULPEN',1,1,'Barang masuk',100,10),(2,'Y','2020-04-08 22:15:10',0,'2020-04-10 16:20:01',0,'PS0002','DANA',2,3,'',0,0),(3,'Y','2020-04-10 14:09:59',0,'2020-04-10 16:12:26',0,'PS0003','BUKU',1,1,'Barang masuk baru nihhh',150,0),(4,'Y','2020-04-10 14:12:43',0,'2020-04-10 14:12:43',0,'PS0004','PENSIL',1,1,'',200,0),(5,'Y','2020-04-10 14:13:43',0,'2020-04-11 14:24:23',0,'PS0005','SPIDOL',1,1,'',100,28);

/*Table structure for table `tbl_barangkeluar` */

DROP TABLE IF EXISTS `tbl_barangkeluar`;

CREATE TABLE `tbl_barangkeluar` (
  `tbl_barangkeluar_id` int(10) NOT NULL AUTO_INCREMENT,
  `isactive` char(1) NOT NULL DEFAULT 'Y',
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `createdby` int(10) NOT NULL,
  `updated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updatedby` int(10) NOT NULL,
  `documentno` varchar(30) NOT NULL,
  `tbl_barang_id` int(5) NOT NULL,
  `tbl_instansi_id` int(5) NOT NULL,
  `datetrx` date NOT NULL,
  `status` char(2) NOT NULL,
  `qtyentered` int(10) NOT NULL,
  `keterangan` varchar(255) NOT NULL,
  PRIMARY KEY (`tbl_barangkeluar_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_barangkeluar` */

insert  into `tbl_barangkeluar`(`tbl_barangkeluar_id`,`isactive`,`created`,`createdby`,`updated`,`updatedby`,`documentno`,`tbl_barang_id`,`tbl_instansi_id`,`datetrx`,`status`,`qtyentered`,`keterangan`) values (1,'Y','2020-04-11 13:07:52',0,'2020-04-11 14:05:40',0,'POT-0001',5,3,'2020-05-02','CO',1,'Kirim jadi 2'),(2,'Y','2020-04-11 14:24:18',0,'2020-04-11 14:24:18',0,'POT-0002',5,3,'2020-04-11','CO',2,'Kirim 2');

/*Table structure for table `tbl_barangmasuk` */

DROP TABLE IF EXISTS `tbl_barangmasuk`;

CREATE TABLE `tbl_barangmasuk` (
  `tbl_barangmasuk_id` int(10) NOT NULL AUTO_INCREMENT,
  `isactive` char(1) NOT NULL DEFAULT 'Y',
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `createdby` int(10) NOT NULL,
  `updated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updatedby` int(10) NOT NULL,
  `documentno` varchar(30) NOT NULL,
  `datetrx` datetime NOT NULL,
  `tbl_barang_id` int(10) NOT NULL,
  `qtyentered` int(5) NOT NULL,
  `amount` int(11) NOT NULL,
  `status` char(2) NOT NULL,
  `keterangan` varchar(255) NOT NULL,
  `file` varchar(500) NOT NULL,
  PRIMARY KEY (`tbl_barangmasuk_id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_barangmasuk` */

insert  into `tbl_barangmasuk`(`tbl_barangmasuk_id`,`isactive`,`created`,`createdby`,`updated`,`updatedby`,`documentno`,`datetrx`,`tbl_barang_id`,`qtyentered`,`amount`,`status`,`keterangan`,`file`) values (1,'Y','2020-04-10 19:23:59',0,'2020-04-10 19:23:59',0,'PIN-0001','2020-04-10 00:00:00',5,20,400000,'CO','SPIDOL 1',''),(3,'Y','2020-04-10 20:39:44',0,'2020-04-10 20:39:52',0,'PIN-0002','2020-04-10 00:00:00',5,10,100,'CO','Masuk 2',''),(21,'Y','2020-04-11 11:17:24',0,'2020-04-11 11:17:24',0,'PIN-0003','2020-04-11 00:00:00',5,1,1000,'CO','Test','item-200411-0262aef88d.pdf');

/*Table structure for table `tbl_instansi` */

DROP TABLE IF EXISTS `tbl_instansi`;

CREATE TABLE `tbl_instansi` (
  `tbl_instansi_id` int(10) NOT NULL AUTO_INCREMENT,
  `isactive` char(1) NOT NULL DEFAULT 'Y',
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `createdby` int(10) NOT NULL,
  `updated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updatedby` int(10) NOT NULL,
  `value` varchar(6) NOT NULL,
  `name` varchar(60) NOT NULL,
  PRIMARY KEY (`tbl_instansi_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_instansi` */

insert  into `tbl_instansi`(`tbl_instansi_id`,`isactive`,`created`,`createdby`,`updated`,`updatedby`,`value`,`name`) values (3,'Y','2020-04-11 10:56:26',0,'2020-04-11 10:56:26',0,'IS0001','ITB');

/*Table structure for table `tbl_jenis_logistik` */

DROP TABLE IF EXISTS `tbl_jenis_logistik`;

CREATE TABLE `tbl_jenis_logistik` (
  `tbl_jenis_id` int(10) NOT NULL AUTO_INCREMENT,
  `isactive` char(1) NOT NULL DEFAULT 'Y',
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `createdby` decimal(10,0) NOT NULL,
  `updated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updatedby` decimal(10,0) NOT NULL,
  `value` varchar(6) DEFAULT NULL,
  `name` varchar(60) NOT NULL,
  PRIMARY KEY (`tbl_jenis_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_jenis_logistik` */

insert  into `tbl_jenis_logistik`(`tbl_jenis_id`,`isactive`,`created`,`createdby`,`updated`,`updatedby`,`value`,`name`) values (1,'Y','2020-04-06 23:12:00',0,'2020-04-07 09:10:07',0,'TL0001','Barang'),(2,'Y','2020-04-06 23:12:07',0,'2020-04-11 09:39:05',0,'TL0002','Anggaran');

/*Table structure for table `tbl_kategori` */

DROP TABLE IF EXISTS `tbl_kategori`;

CREATE TABLE `tbl_kategori` (
  `tbl_kategori_id` int(10) NOT NULL AUTO_INCREMENT,
  `isactive` char(1) NOT NULL DEFAULT 'Y',
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `createdby` int(10) NOT NULL,
  `updated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updatedby` int(10) NOT NULL,
  `value` varchar(6) NOT NULL,
  `name` varchar(60) NOT NULL,
  `isdefault` char(1) NOT NULL DEFAULT 'N',
  `jenis_id` int(10) NOT NULL,
  PRIMARY KEY (`tbl_kategori_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_kategori` */

insert  into `tbl_kategori`(`tbl_kategori_id`,`isactive`,`created`,`createdby`,`updated`,`updatedby`,`value`,`name`,`isdefault`,`jenis_id`) values (1,'Y','2020-04-07 08:30:15',0,'2020-04-07 11:01:27',0,'CA0001','ATK','N',1),(2,'Y','2020-04-07 08:30:26',0,'2020-04-07 11:01:22',0,'CA0002','DOKUMEN','Y',1),(3,'Y','2020-04-07 09:07:43',0,'2020-04-11 09:49:44',2020,'CA0003','UANG','Y',2),(4,'Y','2020-04-11 09:57:08',0,'2020-04-11 09:57:16',0,'CA0004','LEMARI','N',1);

/*Table structure for table `tbl_permintaan` */

DROP TABLE IF EXISTS `tbl_permintaan`;

CREATE TABLE `tbl_permintaan` (
  `id_permintaan` int(5) NOT NULL AUTO_INCREMENT,
  `status` int(3) NOT NULL,
  `tanggal` date NOT NULL,
  `id_instansi` int(5) NOT NULL,
  `id_barang` int(5) NOT NULL,
  `jumlah` int(10) NOT NULL,
  `keterangan` text NOT NULL,
  `id_admin` int(3) NOT NULL,
  PRIMARY KEY (`id_permintaan`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

DROP TABLE IF EXISTS 'keys';

CREATE TABLE `keys` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `key` varchar(40) NOT NULL,
  `level` int(2) NOT NULL,
  `ignore_limits` tinyint(1) NOT NULL DEFAULT 0,
  `is_private_key` tinyint(1) NOT NULL DEFAULT 0,
  `ip_addresses` text DEFAULT NULL,
  `date_created` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `keys`
--

INSERT INTO `keys` (`id`, `user_id`, `key`, `level`, `ignore_limits`, `is_private_key`, `ip_addresses`, `date_created`) VALUES
(1, 1, 'inv123', 1, 0, 0, NULL, 20200409);

/*Data for the table `tbl_permintaan` */

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
