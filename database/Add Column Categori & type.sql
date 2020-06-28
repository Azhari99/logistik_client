-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 28 Jun 2020 pada 08.46
-- Versi server: 10.4.6-MariaDB
-- Versi PHP: 7.3.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `inventori_client`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_barang_masuk`
--

CREATE TABLE `tbl_barang_masuk` (
  `id_barang_masuk` int(11) NOT NULL,
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
  `jenis_id` int(11) NOT NULL,
  `kategori_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_barang_masuk`
--

INSERT INTO `tbl_barang_masuk` (`id_barang_masuk`, `kode_barang`, `nama_barang`, `instansi`, `jumlah`, `documentno`, `unitprice`, `amount`, `tgl_barang_masuk`, `keterangan`, `stat`, `pathDownload`, `jenis_id`, `kategori_id`) VALUES
(1, 'PS0001', 'KOMPUTER', 'UI', 1, 'POT-0001', 3000000, 3000000, '2020-06-22', 'Oke', 1, 'http://localhost/logistik_2/productout/download/item_200622_232527_0c06157574.pdf', 0, 0),
(2, 'PS0001', 'KOMPUTER', 'UI', 1, 'PROUT-0001', 3000000, 3000000, '2020-06-23', 'oke', 1, '', 0, 0),
(3, 'PS0001', 'KOMPUTER', 'UI', 1, 'POT-0002', 3000000, 3000000, '2020-06-28', 'oke', 1, 'http://localhost/logistik_2/productout/download/item_200628_134139_cc0b3b9520.pdf', 1, 1);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `tbl_barang_masuk`
--
ALTER TABLE `tbl_barang_masuk`
  ADD KEY `id_barang_masuk` (`id_barang_masuk`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `tbl_barang_masuk`
--
ALTER TABLE `tbl_barang_masuk`
  MODIFY `id_barang_masuk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
