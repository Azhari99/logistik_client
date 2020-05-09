USE `inventori_client`;

/*Table structure for table `tbl_anggaran` */

DROP TABLE IF EXISTS `tbl_permintaan`;

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


CREATE TABLE `tbl_permintaan` (
  `tbl_permintaan_id` int(10) NOT NULL,
  `isactive` char(1) NOT NULL DEFAULT 'Y',
  `created` timestamp NOT NULL DEFAULT current_timestamp(),
  `createdby` int(10) NOT NULL,
  `updated` timestamp NOT NULL DEFAULT current_timestamp(),
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
  `keterangan` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_permintaan`
--

INSERT INTO `tbl_permintaan` (`tbl_permintaan_id`, `isactive`, `created`, `createdby`, `updated`, `updatedby`, `documentno`, `tbl_barang_id`, `nama_barang`, `tbl_instansi_id`, `nama_instansi`, `datetrx`, `status`, `qtyentered`, `unitprice`, `amount`, `keterangan`) VALUES
(1, 'Y', '2020-05-08 23:09:46', 0, '2020-05-08 23:09:46', 0, 'PROUT-0001', 1, 'BUKU', 3, 'UI', '2020-05-09', 'CO', 4, 8000, 32000, 'Test Request Out'),
(2, 'Y', '2020-05-09 00:32:45', 0, '2020-05-09 00:32:45', 0, 'PROUT-0002', 1, 'BUKU', 3, 'UI', '2020-05-09', 'CO', 5, 8000, 40000, 'Test Request 2');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `tbl_permintaan`
--
ALTER TABLE `tbl_permintaan`
  ADD PRIMARY KEY (`tbl_permintaan_id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `tbl_permintaan`
--
ALTER TABLE `tbl_permintaan`
  MODIFY `tbl_permintaan_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
