-- phpMyAdmin SQL Dump
-- version 4.4.10
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jun 22, 2017 at 05:03 PM
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
-- Table structure for table `t_bpbr`
--

CREATE TABLE IF NOT EXISTS `t_bpbr` (
  `bpbr_id` int(11) NOT NULL,
  `m_cabang_id` int(11) DEFAULT NULL,
  `bpbr_nomor` varchar(255) DEFAULT NULL,
  `bpbr_tanggal` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `t_retur_penjualan_id` int(11) DEFAULT NULL,
  `bpbr_catatan` text,
  `bpbr_pengecekan` datetime DEFAULT NULL,
  `bpbr_created_date` datetime DEFAULT NULL,
  `bpbr_created_by` varchar(255) DEFAULT NULL,
  `bpbr_updated_date` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `bpbr_updated_by` varchar(255) DEFAULT NULL,
  `bpbr_revised` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `t_bpbrdet`
--

CREATE TABLE IF NOT EXISTS `t_bpbrdet` (
  `bpbrdet_id` int(11) NOT NULL,
  `t_retur_penjualandet_id` int(11) DEFAULT NULL,
  `t_bpbr_id` int(11) DEFAULT NULL,
  `bpbrdet_qty` int(11) DEFAULT NULL,
  `bpbrdet_created_date` datetime DEFAULT NULL,
  `bpbrdet_created_by` varchar(255) DEFAULT NULL,
  `bpbrdet_updated_date` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `bpbrdet_updated_by` varchar(255) DEFAULT NULL,
  `bpbrdet_revised` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `t_bukti_bank`
--

CREATE TABLE IF NOT EXISTS `t_bukti_bank` (
  `bukti_bank_id` int(11) NOT NULL,
  `m_cabang_id` int(11) DEFAULT NULL,
  `bukti_bank_nomor` varchar(255) DEFAULT NULL,
  `bukti_bank_tanggal` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `bukti_bank_lampiran` int(11) DEFAULT NULL,
  `bukti_bank_tipe` int(11) DEFAULT NULL COMMENT '1 Keluar, 2 Masuk',
  `m_partner_id` int(11) DEFAULT NULL,
  `bukti_bank_jumlah_bayar` decimal(20,2) DEFAULT NULL,
  `bukti_bank_catatan` varchar(255) DEFAULT NULL,
  `bukti_bank_status` int(11) DEFAULT NULL,
  `bukti_bank_created_date` datetime DEFAULT NULL,
  `bukti_bank_created_by` varchar(255) DEFAULT NULL,
  `bukti_bank_updated_date` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `bukti_bank_updated_by` varchar(255) DEFAULT NULL,
  `bukti_bank_revised` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `t_bukti_bankdet`
--

CREATE TABLE IF NOT EXISTS `t_bukti_bankdet` (
  `bukti_bankdet_id` int(11) NOT NULL,
  `t_bukti_bank_id` int(11) DEFAULT NULL,
  `m_coa_id` int(11) DEFAULT NULL,
  `t_refrensi_id` int(11) DEFAULT NULL,
  `bukti_bankdet_jumlah` decimal(20,2) DEFAULT NULL,
  `bukti_bankdet_created_date` datetime DEFAULT NULL,
  `bukti_bankdet_created_by` varchar(255) DEFAULT NULL,
  `bukti_bankdet_updated_date` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `bukti_bankdet_uppdated_by` varchar(255) DEFAULT NULL,
  `bukti_bankdet_revised` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `t_bukti_bgcek`
--

CREATE TABLE IF NOT EXISTS `t_bukti_bgcek` (
  `bukti_bgcek_id` int(11) NOT NULL,
  `m_cabang_id` int(11) DEFAULT NULL,
  `bukti_bgcek_nomor` varchar(255) DEFAULT NULL,
  `bukti_bgcek_tanggal` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `bukti_bgcek_tipe` int(11) DEFAULT NULL COMMENT '1 Keluar, 2 Masuk',
  `m_partner_id` int(11) DEFAULT NULL,
  `bukti_bgcek_jumlah_bayar` decimal(20,2) DEFAULT '0.00',
  `bukti_bgcek_jumlah_bayar_giro` decimal(20,2) DEFAULT '0.00',
  `bukti_bgcek_catatan` varchar(255) DEFAULT NULL,
  `bukti_bgcek_status` int(11) DEFAULT NULL,
  `bukti_bgcek_created_date` datetime DEFAULT NULL,
  `bukti_bgcek_created_by` varchar(255) DEFAULT NULL,
  `bukti_bgcek_updated_date` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `bukti_bgcek_updated_by` varchar(255) DEFAULT NULL,
  `bukti_bgcek_revised` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `t_bukti_bgcekdet`
--

CREATE TABLE IF NOT EXISTS `t_bukti_bgcekdet` (
  `bukti_bgcekdet_id` int(11) NOT NULL,
  `t_bukti_bgcek_id` int(11) DEFAULT NULL,
  `t_refrensi_id` int(11) DEFAULT NULL,
  `bukti_bgcekdet_jumlah` decimal(20,2) DEFAULT NULL,
  `bukti_bgcekdet_created_date` datetime DEFAULT NULL,
  `bukti_bgcekdet_created_by` varchar(255) DEFAULT NULL,
  `bukti_bgcekdet_updated_date` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `bukti_bgcekdet_updated_by` varchar(255) DEFAULT NULL,
  `bukti_bgcekdet_revised` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `t_bukti_bgcek_girodet`
--

CREATE TABLE IF NOT EXISTS `t_bukti_bgcek_girodet` (
  `bukti_bgcek_girodet_id` int(11) NOT NULL,
  `t_bukti_bgcek_id` int(11) DEFAULT NULL,
  `bukti_bgcek_girodet_nomor` varchar(255) DEFAULT NULL,
  `bukti_bgcek_girodet_jatuh_tempo` date DEFAULT NULL,
  `bukti_bgcek_girodet_status` int(11) DEFAULT '1' COMMENT '0 Cair, 1 Belum',
  `bukti_bgcek_girodet_jumlah` decimal(20,2) DEFAULT NULL,
  `bukti_bgcek_girodet_created_date` datetime DEFAULT NULL,
  `bukti_bgcek_girodet_created_by` varchar(255) DEFAULT NULL,
  `bukti_bgcek_girodet_updated_date` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `bukti_bgcek_girodet_updated_by` varchar(255) DEFAULT NULL,
  `bukti_bgcek_girodet_revised` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `t_bukti_kas`
--

CREATE TABLE IF NOT EXISTS `t_bukti_kas` (
  `bukti_kas_id` int(11) NOT NULL,
  `m_cabang_id` int(11) DEFAULT NULL,
  `bukti_kas_nomor` varchar(255) DEFAULT NULL,
  `bukti_kas_tanggal` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `bukti_kas_lampiran` int(11) DEFAULT NULL,
  `bukti_kas_tipe` int(11) DEFAULT NULL COMMENT '1 Keluar, 2 Masuk',
  `m_partner_id` int(11) DEFAULT NULL,
  `bukti_kas_jumlah_bayar` decimal(20,2) DEFAULT NULL,
  `bukti_kas_catatan` varchar(255) DEFAULT NULL,
  `bukti_kas_status` int(11) DEFAULT NULL,
  `bukti_kas_created_date` datetime DEFAULT NULL,
  `bukti_kas_created_by` varchar(255) DEFAULT NULL,
  `bukti_kas_updated_date` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `bukti_kas_updated_by` varchar(255) DEFAULT NULL,
  `bukti_kas_revised` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `t_bukti_kasdet`
--

CREATE TABLE IF NOT EXISTS `t_bukti_kasdet` (
  `bukti_kasdet_id` int(11) NOT NULL,
  `t_bukti_kas_id` int(11) DEFAULT NULL,
  `m_coa_id` int(11) DEFAULT NULL,
  `t_refrensi_id` int(11) DEFAULT NULL,
  `bukti_kasdet_jumlah` decimal(20,2) DEFAULT NULL,
  `bukti_kasdet_created_date` datetime DEFAULT NULL,
  `bukti_kasdet_created_by` varchar(255) DEFAULT NULL,
  `bukti_kasdet_updated_date` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `bukti_kasdet_uppdated_by` varchar(255) DEFAULT NULL,
  `bukti_kasdet_revised` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `t_bpbr`
--
ALTER TABLE `t_bpbr`
  ADD PRIMARY KEY (`bpbr_id`);

--
-- Indexes for table `t_bpbrdet`
--
ALTER TABLE `t_bpbrdet`
  ADD PRIMARY KEY (`bpbrdet_id`);

--
-- Indexes for table `t_bukti_bank`
--
ALTER TABLE `t_bukti_bank`
  ADD PRIMARY KEY (`bukti_bank_id`);

--
-- Indexes for table `t_bukti_bankdet`
--
ALTER TABLE `t_bukti_bankdet`
  ADD PRIMARY KEY (`bukti_bankdet_id`);

--
-- Indexes for table `t_bukti_bgcek`
--
ALTER TABLE `t_bukti_bgcek`
  ADD PRIMARY KEY (`bukti_bgcek_id`);

--
-- Indexes for table `t_bukti_bgcekdet`
--
ALTER TABLE `t_bukti_bgcekdet`
  ADD PRIMARY KEY (`bukti_bgcekdet_id`);

--
-- Indexes for table `t_bukti_bgcek_girodet`
--
ALTER TABLE `t_bukti_bgcek_girodet`
  ADD PRIMARY KEY (`bukti_bgcek_girodet_id`);

--
-- Indexes for table `t_bukti_kas`
--
ALTER TABLE `t_bukti_kas`
  ADD PRIMARY KEY (`bukti_kas_id`);

--
-- Indexes for table `t_bukti_kasdet`
--
ALTER TABLE `t_bukti_kasdet`
  ADD PRIMARY KEY (`bukti_kasdet_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `t_bpbr`
--
ALTER TABLE `t_bpbr`
  MODIFY `bpbr_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `t_bpbrdet`
--
ALTER TABLE `t_bpbrdet`
  MODIFY `bpbrdet_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `t_bukti_bank`
--
ALTER TABLE `t_bukti_bank`
  MODIFY `bukti_bank_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `t_bukti_bankdet`
--
ALTER TABLE `t_bukti_bankdet`
  MODIFY `bukti_bankdet_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `t_bukti_bgcek`
--
ALTER TABLE `t_bukti_bgcek`
  MODIFY `bukti_bgcek_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `t_bukti_bgcekdet`
--
ALTER TABLE `t_bukti_bgcekdet`
  MODIFY `bukti_bgcekdet_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `t_bukti_bgcek_girodet`
--
ALTER TABLE `t_bukti_bgcek_girodet`
  MODIFY `bukti_bgcek_girodet_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `t_bukti_kas`
--
ALTER TABLE `t_bukti_kas`
  MODIFY `bukti_kas_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `t_bukti_kasdet`
--
ALTER TABLE `t_bukti_kasdet`
  MODIFY `bukti_kasdet_id` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
