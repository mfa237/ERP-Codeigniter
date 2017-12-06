-- phpMyAdmin SQL Dump
-- version 4.4.10
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jun 22, 2017 at 04:53 PM
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
-- Table structure for table `tb_booking`
--

CREATE TABLE IF NOT EXISTS `tb_booking` (
  `booking_id` int(11) NOT NULL,
  `penjualan_id` int(11) NOT NULL,
  `penjualan_code` varchar(200) NOT NULL,
  `booking_done_date` datetime DEFAULT NULL,
  `booking_status` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tb_booking_details`
--

CREATE TABLE IF NOT EXISTS `tb_booking_details` (
  `booking_detail_id` int(11) NOT NULL,
  `penjualan` int(11) DEFAULT NULL,
  `penjualan_detail` int(11) DEFAULT NULL,
  `booking` int(11) DEFAULT NULL,
  `booking_item` int(11) DEFAULT NULL,
  `booking_item_qty` int(11) DEFAULT NULL,
  `booking_status` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tb_kredit`
--

CREATE TABLE IF NOT EXISTS `tb_kredit` (
  `kredit_id` int(11) NOT NULL,
  `penjualan_id` int(11) NOT NULL,
  `penjualan_code` varchar(200) NOT NULL,
  `tanggal_batas` date DEFAULT NULL,
  `customer` int(11) DEFAULT NULL,
  `user` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tb_pengiriman`
--

CREATE TABLE IF NOT EXISTS `tb_pengiriman` (
  `pengiriman_id` int(11) NOT NULL,
  `penjualan_id` int(11) NOT NULL,
  `penjualan_code` varchar(200) DEFAULT NULL,
  `penjualan_tanggal` datetime DEFAULT NULL,
  `pengiriman_date` datetime DEFAULT NULL,
  `pengiriman_tujuan` varchar(200) DEFAULT NULL,
  `pengiriman_jarak` int(11) DEFAULT NULL,
  `pengiriman_biaya` int(11) DEFAULT NULL,
  `pengiriman_tanggal` datetime DEFAULT NULL,
  `pengiriman_tanggal_sampai` datetime DEFAULT NULL,
  `status` int(11) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_pengiriman`
--

INSERT INTO `tb_pengiriman` (`pengiriman_id`, `penjualan_id`, `penjualan_code`, `penjualan_tanggal`, `pengiriman_date`, `pengiriman_tujuan`, `pengiriman_jarak`, `pengiriman_biaya`, `pengiriman_tanggal`, `pengiriman_tanggal_sampai`, `status`) VALUES
(1, 29, 'T001/20/06/2017/0001', '2017-06-20 09:06:56', NULL, 'Bandung', 0, 13, NULL, '0000-00-00 00:00:00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tb_penjualan`
--

CREATE TABLE IF NOT EXISTS `tb_penjualan` (
  `penjualan_id` int(11) NOT NULL,
  `penjualan_code` varchar(200) NOT NULL,
  `penjualan_date` datetime NOT NULL,
  `customer` int(11) DEFAULT NULL,
  `branch` int(11) DEFAULT NULL,
  `penjualan_all_discount` float DEFAULT NULL,
  `penjualan_total` bigint(20) DEFAULT NULL,
  `penjualan_pajak` bigint(20) DEFAULT NULL,
  `penjualan_all_discount_percent` float DEFAULT NULL,
  `penjualan_all_discount_nominal` int(11) DEFAULT NULL,
  `penjualan_biaya_pengiriman` int(11) DEFAULT NULL,
  `penjualan_grand_total` bigint(20) DEFAULT NULL,
  `penjualan_payment` bigint(20) DEFAULT NULL,
  `penjualan_change` int(11) DEFAULT NULL,
  `penjualan_payment_method` int(11) DEFAULT NULL,
  `bank_atas_name` varchar(200) DEFAULT NULL,
  `bank` int(11) DEFAULT NULL,
  `bank_number` varchar(200) DEFAULT NULL,
  `user` int(11) DEFAULT NULL,
  `booking_status` int(11) DEFAULT NULL,
  `no_edc` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `promo` varchar(200) DEFAULT NULL,
  `promo_total` int(11) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_penjualan`
--

INSERT INTO `tb_penjualan` (`penjualan_id`, `penjualan_code`, `penjualan_date`, `customer`, `branch`, `penjualan_all_discount`, `penjualan_total`, `penjualan_pajak`, `penjualan_all_discount_percent`, `penjualan_all_discount_nominal`, `penjualan_biaya_pengiriman`, `penjualan_grand_total`, `penjualan_payment`, `penjualan_change`, `penjualan_payment_method`, `bank_atas_name`, `bank`, `bank_number`, `user`, `booking_status`, `no_edc`, `status`, `promo`, `promo_total`) VALUES
(1, 'INV_1496389555', '2017-06-01 07:01:00', 1, 1, 0, 47400, 0, 0, 0, NULL, 47400, 47400, 0, 1, '', 0, '', 1, 1, 0, 0, '', 0),
(2, 'INV_1496390623', '2017-05-22 00:00:00', 1, 1, 0, 124300, 0, 0, 0, NULL, 124300, 124300, 0, 1, '', 0, '', 1, 1, 0, 0, '', 0),
(3, 'INV_1496390844', '2017-05-17 00:00:00', 1, 1, 0, 3612000, 0, 0, 0, NULL, 3612000, 4000000, 388000, 1, '', 0, '', 1, 1, 0, 0, '', 0),
(4, 'INV_1496757476', '2017-06-06 00:00:00', 1, 1, 0, 26400, 0, 0, 0, NULL, 26400, 200000, 173600, 1, '', 0, '', 1, 1, 0, 0, '', 0),
(5, 'INV_1496758338', '2017-06-06 21:06:18', 1, 1, 0, 330000, 0, 0, 0, NULL, 330000, 400000, 70000, 1, '', 0, '', 1, 1, 0, 0, '', 0),
(6, 'INV_1496761111', '2017-06-06 21:06:31', 1, 1, 0, 21000, 0, 0, 0, NULL, 21000, 50000, 29000, 1, '', 0, '', 1, 1, 0, 1, '', 0),
(7, 'INV_1496803342', '2017-06-07 09:06:22', 1, 1, 1684, 13516, 0, 0, 1684, NULL, 15200, 15500, 300, 1, '', 0, '', 1, 1, 0, 0, '', 0),
(8, 'INV_1496805360', '2017-06-07 10:06:00', 1, 1, 0, 140800, 0, 0, 0, NULL, 140800, 150000, 9200, 1, '', 0, '', 1, 1, 0, 1, '', 0),
(9, 'INV_1496805514', '2017-06-07 10:06:34', 1, 1, 0, 62400, 0, 0, 0, NULL, 62400, 70000, 7600, 1, '', 0, '', 1, 1, 0, 0, '', 0),
(10, 'INV_1496805565', '2017-06-02 10:06:25', 1, 1, 0, 935000, 0, 0, 0, NULL, 935000, 950000, 15000, 1, '', 0, '', 1, 1, 0, 1, '', 0),
(11, 'INV_1496806303', '2017-06-07 10:06:43', 1, 1, 2000, 128000, 0, 0, 2000, NULL, 130000, 130000, 0, 1, '', 0, '', 1, 1, 0, 1, '', 0),
(12, 'INV_1496807823', '2017-06-07 10:06:03', 1, 1, 0, 351700, 0, 0, 0, NULL, 351700, 352000, 300, 1, '', 0, '', 1, 1, 0, 0, '', 0),
(13, 'INV_1496808596', '2017-06-07 11:06:56', 1, 1, 0, 40500, 0, 0, 0, NULL, 40500, 40500, 0, 1, '', 0, '', 1, 1, 0, 0, '', 0),
(14, 'INV_1496809347', '2017-06-07 11:06:27', 1, 1, 800, 129200, 0, 0, 800, NULL, 130000, 130000, 0, 1, '', 0, '', 1, 1, 0, 0, '', 0),
(15, 'INV_1496811408', '2017-06-07 11:06:48', 1, 1, 0, 278900, 0, 0, 0, NULL, 278900, 280000, 1100, 1, '', 0, '', 1, 1, 0, 0, '', 0),
(16, 'INV_1496811409', '2017-06-07 11:06:49', 1, 1, 0, 278900, 0, 0, 0, NULL, 278900, 280000, 1100, 1, '', 0, '', 1, 1, 0, 0, '', 0),
(17, 'INV_1496816701', '2017-06-07 13:06:01', 1, 1, 22000, 176000, 0, 0, 22000, NULL, 198000, 200000, 2000, 1, '', 0, '', 1, 1, 0, 0, '', 0),
(18, 'INV_1496817609', '2017-06-07 13:06:09', 1, 1, 10000, 90000, 0, 0, 10000, NULL, 100000, 100000, 0, 1, '', 0, '', 1, 1, 0, 0, '', 0),
(19, 'INV_1496820301', '2017-06-04 14:06:01', 1, 1, 10000, 120000, 0, 0, 10000, NULL, 130000, 150000, 20000, 1, '', 0, '', 1, 1, 0, 1, '', 0),
(20, 'INV_1496824380', '2017-06-07 15:06:00', 1, 1, 20592, 117308, 0, 0, 20592, NULL, 137900, 150000, 12100, 1, '', 0, '', 1, 1, 0, 0, '', 0),
(21, 'INV_1496829649', '2017-06-07 17:06:49', 1, 1, 0, 557530, 0, 0, 0, NULL, 557530, 600000, 42470, 1, '', 0, '', 1, 1, 0, 0, '', 0),
(22, 'INV_1496829915', '2017-06-07 17:06:15', 1, 1, 0, 2781240, 0, 0, 0, NULL, 2781240, 2800000, 18760, 1, '0', 0, '0', 1, 1, 0, 0, '', 0),
(23, 'INV_1496830398', '2017-06-07 17:06:18', 1, 1, 2250, 85500, 0, 0, 2250, NULL, 87750, 100000, 12250, 1, '', 0, '', 1, 1, 0, 1, '', 0),
(24, 'INV_1496893745', '2017-05-30 10:06:05', 1, 1, 7089, 103972, 0, 0, 7089, NULL, 111061, 115000, 3939, 1, '', 0, '', 1, 1, 0, 1, '', 0),
(25, 'INV_1496894345', '2017-06-08 10:06:05', 1, 1, 0, 578660, 0, 0, 0, NULL, 578660, 600000, 21340, 1, '', 0, '', 1, 1, 0, 0, '', 0),
(26, 'INV_1496931000', '2017-06-08 21:06:00', 1, 1, 0, 924000, 0, 0, 0, NULL, 924000, 925000, 1000, 1, '', 0, '', 1, 1, 0, 0, '', 0),
(27, 'INV_1496983043', '2017-06-09 11:06:23', 1, 1, 0, 374000, 0, 0, 0, NULL, 374000, 400000, 26000, 1, '', 0, '', 1, 1, 0, 0, '', 0),
(28, 'T001/12/06/2017/0001', '2017-06-12 09:06:19', 1, 1, 0, 5620000, 0, 0, 0, NULL, 5620000, 5700000, 80000, 1, '', 0, '', 1, 1, NULL, 0, '', 0),
(29, 'T001/20/06/2017/0001', '2017-06-20 09:06:56', 1, 1, 0, 1254013, 0, 0, 0, 13, 1254000, 1254000, 0, 1, '', 0, '', 1, 2, NULL, 0, '', 0),
(30, 'T001/21/06/2017/0001', '2017-06-21 00:06:54', 1, 1, 10000, 480010, 0, 0, 10000, NULL, 490010, 490010, 0, 1, '', 0, '', 1, 1, NULL, 1, '', 0),
(31, 'T001/21/06/2017/0001', '2017-06-21 00:06:54', 1, 1, 10000, 480010, 0, 0, 10000, NULL, 490010, 490010, 0, 1, '', 0, '', 1, 1, NULL, 1, '', 0),
(32, 'T001/21/06/2017/0001', '2017-06-21 22:06:45', 1, 1, 0, 1241950, 0, 0, 0, NULL, 1241950, 1250000, 8050, 1, '', 0, '', 1, 1, NULL, 1, '', 0),
(33, 'T001/22/06/2017/0001', '2017-06-22 00:06:05', 2, 1, 70000, 560000, 0, 0, 70000, NULL, 630000, 630000, 0, 1, '', 0, '', 1, 1, NULL, 0, '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tb_penjualan_details`
--

CREATE TABLE IF NOT EXISTS `tb_penjualan_details` (
  `penjualan_detail_id` int(11) NOT NULL,
  `penjualan` int(11) NOT NULL,
  `barang` int(11) NOT NULL,
  `barang_qty` int(11) NOT NULL,
  `barang_price` int(11) NOT NULL,
  `barang_total` int(11) NOT NULL,
  `barang_discount_percent` int(11) NOT NULL,
  `barang_discount_nominal` int(11) NOT NULL,
  `barang_grand_total` bigint(20) NOT NULL,
  `booking_status` int(11) DEFAULT NULL,
  `item_getFromGudang` int(11) DEFAULT NULL,
  `promo` int(11) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=94 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_penjualan_details`
--

INSERT INTO `tb_penjualan_details` (`penjualan_detail_id`, `penjualan`, `barang`, `barang_qty`, `barang_price`, `barang_total`, `barang_discount_percent`, `barang_discount_nominal`, `barang_grand_total`, `booking_status`, `item_getFromGudang`, `promo`) VALUES
(43, 1, 1085, 0, 7000, 21000, 0, 0, 21000, 0, 3, 0),
(44, 1, 3736, 1, 26400, 26400, 0, 0, 26400, 0, 0, 0),
(45, 2, 3350, 1, 124300, 124300, 0, 0, 124300, 0, 0, 0),
(46, 3, 3, 1, 3612000, 3612000, 0, 0, 3612000, 1, 0, 0),
(47, 4, 3736, 0, 26400, 26400, 0, 0, 26400, 0, 1, 0),
(48, 5, 2391, 0, 165000, 330000, 0, 0, 330000, 0, 2, 0),
(49, 6, 1085, 0, 7000, 21000, 0, 0, 21000, 0, 3, 0),
(50, 7, 5275, 1, 10000, 10000, 1000, 1000, 9000, 0, 0, 0),
(51, 7, 5277, 1, 8000, 8000, 160, 160, 7840, 0, 0, 0),
(52, 8, 1643, 0, 70400, 140800, 0, 0, 140800, 0, 2, 0),
(53, 9, 1643, 1, 70400, 70400, 8000, 8000, 62400, 0, 0, 0),
(54, 10, 2686, 0, 935000, 935000, 0, 0, 935000, 0, 1, 0),
(55, 11, 2889, 0, 42000, 84000, 0, 0, 84000, 0, 2, 0),
(56, 11, 5082, 0, 48000, 48000, 0, 0, 48000, 0, 1, 0),
(57, 12, 5294, 2, 99900, 199800, 9000, 9000, 190800, 0, 0, 0),
(58, 12, 3212, 1, 165900, 165900, 5000, 5000, 160900, 0, 0, 0),
(59, 13, 3121, 0, 13000, 26000, 6000, 6000, 20000, 0, 2, 0),
(60, 13, 234, 0, 21500, 21500, 1000, 1000, 20500, 0, 1, 0),
(61, 14, 3971, 0, 21400, 42800, 2000, 2000, 40800, 0, 2, 0),
(62, 14, 3641, 0, 90200, 90200, 200, 200, 90000, 0, 1, 0),
(63, 15, 1, 1, 581000, 581000, 302120, 302120, 278880, 1, 0, 0),
(64, 16, 1, 1, 581000, 581000, 302120, 302120, 278880, 1, 0, 0),
(65, 17, 3388, 0, 90000, 180000, 10000, 10000, 170000, 0, 2, 0),
(66, 17, 1572, 0, 55000, 55000, 5000, 5000, 50000, 0, 1, 0),
(67, 18, 5224, 0, 33000, 66000, 6000, 6000, 60000, 0, 2, 0),
(68, 18, 4060, 0, 52000, 52000, 2000, 2000, 50000, 0, 1, 0),
(69, 19, 3258, 0, 69300, 138600, 8600, 8600, 130000, 0, 2, 0),
(70, 19, 183, 0, 15000, 15000, 5000, 5000, 10000, 0, 1, 0),
(71, 20, 3801, 0, 60500, 121000, 1000, 1000, 120000, 0, 2, 0),
(72, 20, 1379, 0, 48000, 48000, 9600, 9600, 38400, 0, 1, 0),
(73, 21, 1, 1, 581000, 581000, 23470, 23470, 557530, 1, 0, 0),
(74, 22, 3, 1, 3612000, 3612000, 830760, 830760, 2781240, 1, 0, 0),
(75, 23, 5054, 0, 21000, 42000, 2000, 2000, 40000, 0, 2, 0),
(76, 23, 369, 0, 59000, 59000, 9000, 9000, 50000, 0, 1, 0),
(77, 24, 3322, 0, 53900, 107800, 7800, 7800, 100000, 0, 2, 0),
(78, 24, 3653, 0, 24200, 24200, 6050, 6050, 18150, 0, 1, 0),
(79, 25, 1, 1, 581000, 581000, 2340, 2340, 578660, 1, 0, 0),
(80, 26, 5, 1, 475000, 475000, 0, 0, 475000, 1, 0, 0),
(81, 26, 7, 1, 449000, 449000, 0, 0, 449000, 1, 0, 0),
(82, 27, 8, 0, 374000, 374000, 0, 0, 374000, 0, 1, 0),
(83, 28, 4, 1, 2557000, 2557000, 0, 0, 2557000, 1, 0, 0),
(84, 28, 1, 3, 581000, 1743000, 0, 0, 1743000, 1, 0, 0),
(85, 28, 2, 2, 660000, 1320000, 0, 0, 1320000, 1, 0, 0),
(86, 29, 1, 1, 581000, 581000, 0, 0, 581000, 1, 0, 0),
(87, 29, 2, 1, 660000, 660000, 0, 0, 660000, 1, 0, 0),
(88, 30, 1, 1, 581000, 581000, 81000, 81000, 500000, 2, 0, 0),
(89, 31, 1, 1, 581000, 581000, 81000, 81000, 500000, 1, 0, 0),
(90, 32, 1, 1, 581000, 581000, 29050, 29050, 551950, 1, 0, 0),
(91, 32, 2, 1, 660000, 660000, 0, 0, 660000, 1, 0, 0),
(92, 33, 5, 1, 475000, 475000, 75000, 75000, 400000, 1, 0, 0),
(93, 33, 14, 1, 344000, 344000, 44000, 44000, 300000, 1, 0, 0);

--
-- Triggers `tb_penjualan_details`
--
DELIMITER $$
CREATE TRIGGER `updatestockdaripenjualan` AFTER INSERT ON `tb_penjualan_details`
 FOR EACH ROW BEGIN
	DECLARE cabangdisplay INTEGER;
	DECLARE cabanggudang INTEGER;
	
	SELECT m_cabang.cabang_gudangdisplay INTO cabangdisplay FROM m_cabang 
	WHERE m_cabang.cabang_id = (SELECT tb_penjualan.branch FROM tb_penjualan
				    LEFT JOIN tb_penjualan_details ON tb_penjualan_details.penjualan = tb_penjualan.penjualan_id
				    WHERE tb_penjualan.penjualan_id = new.penjualan LIMIT 1);
				    
	UPDATE t_stok_gudang SET stok_gudang_jumlah = stok_gudang_jumlah - new.barang_qty 
	WHERE m_barang_id = new.barang AND m_gudang_id = (SELECT m_cabang.cabang_gudangdisplay FROM m_cabang 
	WHERE m_cabang.cabang_id = (SELECT tb_penjualan.branch FROM tb_penjualan
				    LEFT JOIN tb_penjualan_details ON tb_penjualan_details.penjualan = tb_penjualan.penjualan_id
				    WHERE tb_penjualan.penjualan_id = new.penjualan LIMIT 1));			      
	
	UPDATE t_stok_gudang SET stok_gudang_jumlah = stok_gudang_jumlah - new.item_getFromGudang 
	WHERE m_barang_id = new.barang AND m_gudang_id = (SELECT m_gudang.gudang_id FROM m_gudang 
	WHERE m_gudang.m_cabang_id = (SELECT tb_penjualan.branch FROM tb_penjualan
				    LEFT JOIN tb_penjualan_details ON tb_penjualan_details.penjualan = tb_penjualan.penjualan_id
				    WHERE tb_penjualan.penjualan_id = new.penjualan LIMIT 1) and m_gudang.gudang_id != cabangdisplay);
	
    END
$$
DELIMITER ;

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
-- Indexes for table `tb_booking`
--
ALTER TABLE `tb_booking`
  ADD PRIMARY KEY (`booking_id`);

--
-- Indexes for table `tb_booking_details`
--
ALTER TABLE `tb_booking_details`
  ADD PRIMARY KEY (`booking_detail_id`);

--
-- Indexes for table `tb_kredit`
--
ALTER TABLE `tb_kredit`
  ADD PRIMARY KEY (`kredit_id`);

--
-- Indexes for table `tb_pengiriman`
--
ALTER TABLE `tb_pengiriman`
  ADD PRIMARY KEY (`pengiriman_id`);

--
-- Indexes for table `tb_penjualan`
--
ALTER TABLE `tb_penjualan`
  ADD PRIMARY KEY (`penjualan_id`);

--
-- Indexes for table `tb_penjualan_details`
--
ALTER TABLE `tb_penjualan_details`
  ADD PRIMARY KEY (`penjualan_detail_id`);

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
-- AUTO_INCREMENT for table `tb_booking`
--
ALTER TABLE `tb_booking`
  MODIFY `booking_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tb_booking_details`
--
ALTER TABLE `tb_booking_details`
  MODIFY `booking_detail_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tb_kredit`
--
ALTER TABLE `tb_kredit`
  MODIFY `kredit_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tb_pengiriman`
--
ALTER TABLE `tb_pengiriman`
  MODIFY `pengiriman_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `tb_penjualan`
--
ALTER TABLE `tb_penjualan`
  MODIFY `penjualan_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=34;
--
-- AUTO_INCREMENT for table `tb_penjualan_details`
--
ALTER TABLE `tb_penjualan_details`
  MODIFY `penjualan_detail_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=94;
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
