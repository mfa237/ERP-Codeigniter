-- phpMyAdmin SQL Dump
-- version 4.4.10
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jun 22, 2017 at 05:14 PM
-- Server version: 10.0.30-MariaDB-cll-lve
-- PHP Version: 7.0.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `jasaprog_tangs`
--

-- --------------------------------------------------------

--
-- Table structure for table `t_pengubahan_bahan`
--

CREATE TABLE IF NOT EXISTS `t_pengubahan_bahan` (
  `pengubahan_bahan_id` int(11) NOT NULL,
  `t_perolehan_produksi_id` int(11) DEFAULT NULL,
  `pengubahan_bahan_tanggal` datetime DEFAULT NULL,
  `pengubahan_bahan_nomor` varchar(255) DEFAULT NULL,
  `pengubahan_bahan_jenis` int(1) DEFAULT NULL,
  `pengubahan_bahan_status` varchar(255) DEFAULT NULL,
  `pengubahan_bahan_created_date` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `pengubahan_bahan_created_by` varchar(255) DEFAULT NULL,
  `pengubahan_bahan_update_date` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `pengubahan_bahan_update_by` varchar(255) DEFAULT NULL,
  `pengubahan_bahan_revised` int(255) DEFAULT NULL,
  `m_cabang_id` int(11) DEFAULT NULL,
  `pengubahan_bahan_keterangan` text,
  `pengubahan_bahan_konversi` float DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `t_pengubahan_bahanakhir`
--

CREATE TABLE IF NOT EXISTS `t_pengubahan_bahanakhir` (
  `pengubahan_bahanakhir_id` int(11) NOT NULL,
  `t_pengubahan_bahan_id` int(11) DEFAULT NULL,
  `m_barang_id` int(11) DEFAULT NULL,
  `pengubahan_bahanakhir_qty` int(11) DEFAULT NULL,
  `pengubahan_bahanakhir_gudang` varchar(255) DEFAULT NULL,
  `pengubahan_bahanakhir_status` int(255) DEFAULT NULL,
  `pengubahan_bahanakhir_deskripsi` text
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `t_pengubahan_bahanawal`
--

CREATE TABLE IF NOT EXISTS `t_pengubahan_bahanawal` (
  `pengubahan_bahanawal_id` int(11) NOT NULL,
  `t_pengubahan_bahan_id` int(11) DEFAULT NULL,
  `m_barang_id` int(11) DEFAULT NULL,
  `pengubahan_bahanawal_qty` int(11) DEFAULT NULL,
  `pengubahan_bahanawal_gudang` varchar(255) DEFAULT NULL,
  `pengubahan_bahanawal_status` int(255) DEFAULT NULL,
  `t_perolehan_produksi_awaldet_id` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `t_pengubahan_bahanlog`
--

CREATE TABLE IF NOT EXISTS `t_pengubahan_bahanlog` (
  `pengubahan_bahanlog_id` int(11) NOT NULL,
  `referensi_id` int(11) DEFAULT NULL,
  `pengubahan_bahanlog_status_dari` int(11) DEFAULT NULL,
  `pengubahan_bahanlog_status_ke` int(11) DEFAULT NULL,
  `pengubahan_bahanlog_status_update_date` datetime DEFAULT NULL,
  `pengubahan_bahanlog_status_update_by` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `t_pengunjung`
--

CREATE TABLE IF NOT EXISTS `t_pengunjung` (
  `pengunjung_id` int(11) NOT NULL,
  `m_cabang_id` int(11) NOT NULL,
  `m_user_id` int(11) NOT NULL,
  `pengunjung_date` date NOT NULL,
  `pengunjung_total` int(11) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t_pengunjung`
--

INSERT INTO `t_pengunjung` (`pengunjung_id`, `m_cabang_id`, `m_user_id`, `pengunjung_date`, `pengunjung_total`) VALUES
(1, 1, 1, '2017-06-12', 2),
(2, 1, 1, '2017-05-12', 20),
(3, 1, 1, '2017-06-16', 3);

-- --------------------------------------------------------

--
-- Table structure for table `t_perhitungan_kebutuhan`
--

CREATE TABLE IF NOT EXISTS `t_perhitungan_kebutuhan` (
  `perhitungan_kebutuhan_id` int(11) NOT NULL,
  `perhitungan_kebutuhan_nomor` varchar(255) DEFAULT NULL,
  `perhitungan_kebutuhan_jenis` int(1) DEFAULT NULL,
  `m_cabang_id` int(11) DEFAULT NULL,
  `m_gudang_id` int(11) DEFAULT NULL,
  `t_jadwal_produksi_id` varchar(255) DEFAULT NULL,
  `perhitungan_kebutuhan_tanggal` datetime DEFAULT NULL,
  `perhitungan_kebutuhan_verifikasi_jumlah` int(1) DEFAULT '0',
  `perhitungan_kebutuhan_status` varchar(255) DEFAULT NULL,
  `perhitungan_kebutuhan_status_date` datetime DEFAULT NULL,
  `perhitungan_kebutuhan_created_date` datetime DEFAULT NULL,
  `perhitungan_kebutuhan_created_by` varchar(255) DEFAULT NULL,
  `perhitungan_kebutuhan_update_date` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `perhitungan_kebutuhan_update_by` varchar(255) DEFAULT NULL,
  `perhitungan_kebutuhan_revised` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `t_perhitungan_kebutuhandet`
--

CREATE TABLE IF NOT EXISTS `t_perhitungan_kebutuhandet` (
  `perhitungan_kebutuhandet_id` int(11) NOT NULL,
  `t_perhitungan_kebutuhan_id` int(11) DEFAULT NULL,
  `t_jadwal_produksidet_id` int(11) DEFAULT NULL,
  `m_barang_id` int(11) DEFAULT NULL,
  `perhitungan_kebutuhandet_qty` int(11) DEFAULT NULL,
  `perhitungan_kebutuhandet_berat` varchar(255) DEFAULT NULL,
  `perhitungan_kebutuhandet_total` varchar(255) DEFAULT NULL,
  `perhitungan_kebutuhandet_ukuran` varchar(255) DEFAULT NULL,
  `perhitungan_kebutuhandet_lebar` varchar(255) DEFAULT NULL,
  `perhitungan_kebutuhandet_slitingan` varchar(255) DEFAULT NULL,
  `perhitungan_kebutuhandet_keterangan` varchar(255) DEFAULT NULL,
  `perhitungan_kebutuhandet_status` int(11) DEFAULT NULL,
  `perhitungan_kebutuhandet_created_date` datetime DEFAULT NULL,
  `perhitungan_kebutuhandet_created_by` varchar(255) DEFAULT NULL,
  `perhitungan_kebutuhandet_update_date` datetime DEFAULT NULL,
  `perhitungan_kebutuhandet_update_by` varchar(255) DEFAULT NULL,
  `perhitungan_kebutuhandet_revised` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `t_perhitungan_kebutuhanlog`
--

CREATE TABLE IF NOT EXISTS `t_perhitungan_kebutuhanlog` (
  `perhitungan_kebutuhanlog_id` int(11) NOT NULL,
  `referensi_id` int(11) DEFAULT NULL,
  `perhitungan_kebutuhanlog_status_dari` int(11) DEFAULT NULL,
  `perhitungan_kebutuhanlog_status_ke` int(11) DEFAULT NULL,
  `perhitungan_kebutuhanlog_status_update_date` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `perhitungan_kebutuhanlog_status_update_by` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `t_permintaan_jasa`
--

CREATE TABLE IF NOT EXISTS `t_permintaan_jasa` (
  `permintaan_jasa_id` int(11) NOT NULL,
  `m_cabang_id` int(11) DEFAULT NULL,
  `permintaan_jasa_nomor` varchar(255) NOT NULL,
  `permintaan_jasa_tanggal` datetime NOT NULL,
  `m_departemen_id` int(255) NOT NULL,
  `permintaan_jasa_tanggal_dibutuhkan` datetime DEFAULT NULL,
  `permintaan_jasa_status` int(255) NOT NULL,
  `permintaan_jasa_status_date` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `permintaan_jasa_printed` int(255) DEFAULT NULL,
  `permintaan_jasa_created_date` datetime NOT NULL,
  `permintaan_jasa_created_by` varchar(255) NOT NULL,
  `permintaan_jasa_update_date` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `permintaan_jasa_update_by` varchar(0) DEFAULT NULL,
  `permintaan_jasa_revised` int(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `t_permintaan_jasadet`
--

CREATE TABLE IF NOT EXISTS `t_permintaan_jasadet` (
  `permintaan_jasadet_id` int(11) NOT NULL,
  `t_permintaan_jasa_id` int(11) DEFAULT NULL,
  `m_barang_id` int(11) DEFAULT NULL,
  `permintaan_jasadet_qty` int(11) DEFAULT NULL,
  `permintaan_jasadet_qty_realisasi` int(11) DEFAULT '0',
  `permintaan_jasadet_keterangan` varchar(255) DEFAULT NULL,
  `permintaan_jasadet_status` int(11) DEFAULT NULL,
  `permintaan_jasadet_status_date` datetime DEFAULT NULL,
  `permintaan_jasadet_create_date` datetime DEFAULT NULL,
  `permintaan_jasadet_create_by` varchar(255) DEFAULT NULL,
  `permintaan_jasadet_update_date` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `permintaan_jasadet_update_by` varchar(255) DEFAULT NULL,
  `permintaan_jasadet_revised` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `t_permintaan_jasalog`
--

CREATE TABLE IF NOT EXISTS `t_permintaan_jasalog` (
  `permintaan_jasalog_id` int(11) NOT NULL,
  `referensi_id` int(11) DEFAULT NULL,
  `permintaan_jasalog_status_dari` int(11) DEFAULT NULL,
  `permintaan_jasalog_status_ke` int(11) DEFAULT NULL,
  `permintaan_jasalog_status_update_date` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `permintaan_jasalog_status_update_by` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `t_pengubahan_bahan`
--
ALTER TABLE `t_pengubahan_bahan`
  ADD PRIMARY KEY (`pengubahan_bahan_id`);

--
-- Indexes for table `t_pengubahan_bahanakhir`
--
ALTER TABLE `t_pengubahan_bahanakhir`
  ADD PRIMARY KEY (`pengubahan_bahanakhir_id`);

--
-- Indexes for table `t_pengubahan_bahanawal`
--
ALTER TABLE `t_pengubahan_bahanawal`
  ADD PRIMARY KEY (`pengubahan_bahanawal_id`);

--
-- Indexes for table `t_pengubahan_bahanlog`
--
ALTER TABLE `t_pengubahan_bahanlog`
  ADD PRIMARY KEY (`pengubahan_bahanlog_id`);

--
-- Indexes for table `t_pengunjung`
--
ALTER TABLE `t_pengunjung`
  ADD PRIMARY KEY (`pengunjung_id`);

--
-- Indexes for table `t_perhitungan_kebutuhan`
--
ALTER TABLE `t_perhitungan_kebutuhan`
  ADD PRIMARY KEY (`perhitungan_kebutuhan_id`);

--
-- Indexes for table `t_perhitungan_kebutuhandet`
--
ALTER TABLE `t_perhitungan_kebutuhandet`
  ADD PRIMARY KEY (`perhitungan_kebutuhandet_id`);

--
-- Indexes for table `t_perhitungan_kebutuhanlog`
--
ALTER TABLE `t_perhitungan_kebutuhanlog`
  ADD PRIMARY KEY (`perhitungan_kebutuhanlog_id`);

--
-- Indexes for table `t_permintaan_jasa`
--
ALTER TABLE `t_permintaan_jasa`
  ADD PRIMARY KEY (`permintaan_jasa_id`);

--
-- Indexes for table `t_permintaan_jasadet`
--
ALTER TABLE `t_permintaan_jasadet`
  ADD PRIMARY KEY (`permintaan_jasadet_id`);

--
-- Indexes for table `t_permintaan_jasalog`
--
ALTER TABLE `t_permintaan_jasalog`
  ADD PRIMARY KEY (`permintaan_jasalog_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `t_pengubahan_bahan`
--
ALTER TABLE `t_pengubahan_bahan`
  MODIFY `pengubahan_bahan_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `t_pengubahan_bahanakhir`
--
ALTER TABLE `t_pengubahan_bahanakhir`
  MODIFY `pengubahan_bahanakhir_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `t_pengubahan_bahanawal`
--
ALTER TABLE `t_pengubahan_bahanawal`
  MODIFY `pengubahan_bahanawal_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `t_pengubahan_bahanlog`
--
ALTER TABLE `t_pengubahan_bahanlog`
  MODIFY `pengubahan_bahanlog_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `t_pengunjung`
--
ALTER TABLE `t_pengunjung`
  MODIFY `pengunjung_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `t_perhitungan_kebutuhan`
--
ALTER TABLE `t_perhitungan_kebutuhan`
  MODIFY `perhitungan_kebutuhan_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `t_perhitungan_kebutuhandet`
--
ALTER TABLE `t_perhitungan_kebutuhandet`
  MODIFY `perhitungan_kebutuhandet_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `t_perhitungan_kebutuhanlog`
--
ALTER TABLE `t_perhitungan_kebutuhanlog`
  MODIFY `perhitungan_kebutuhanlog_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `t_permintaan_jasa`
--
ALTER TABLE `t_permintaan_jasa`
  MODIFY `permintaan_jasa_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `t_permintaan_jasadet`
--
ALTER TABLE `t_permintaan_jasadet`
  MODIFY `permintaan_jasadet_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `t_permintaan_jasalog`
--
ALTER TABLE `t_permintaan_jasalog`
  MODIFY `permintaan_jasalog_id` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
