-- phpMyAdmin SQL Dump
-- version 4.4.10
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jun 22, 2017 at 04:19 PM
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
-- Stand-in structure for view `v_atribut`
--
CREATE TABLE IF NOT EXISTS `v_atribut` (
`atribut_id` int(11)
,`m_barang_id` int(11)
,`atribut_jenis` varchar(255)
,`atribut_nama` varchar(255)
,`atribut_satuan` varchar(255)
,`atribut_default_value` varchar(255)
,`atribut_status_aktif` varchar(255)
,`atribut_create_date` datetime
,`atribut_create_by` varchar(255)
,`atribut_update_date` datetime
,`atribut_update_by` varchar(255)
,`atribut_revised` int(11)
,`barang_nama` varchar(255)
,`satuan_nama` varchar(255)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_bank`
--
CREATE TABLE IF NOT EXISTS `v_bank` (
`bank_id` int(11)
,`cabang_id` int(11)
,`cabang_nama` varchar(255)
,`bank_cabang` varchar(255)
,`bank_nama` varchar(255)
,`bank_atas_nama` varchar(255)
,`bank_no_rek` varchar(255)
,`bank_status_aktif` char(1)
,`bank_created_date` datetime
,`bank_created_by` varchar(255)
,`bank_update_date` datetime
,`bank_update_by` varchar(255)
,`bank_revised` int(11)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_barang`
--
CREATE TABLE IF NOT EXISTS `v_barang` (
`barang_id` int(11)
,`m_jenis_barang_id` int(11)
,`barang_kode` varchar(255)
,`barang_nomor` varchar(255)
,`barang_nama` varchar(255)
,`barang_minimum_stok` int(11)
,`barang_status_aktif` char(1)
,`barang_create_date` datetime
,`barang_create_by` varchar(255)
,`barang_update_date` datetime
,`barang_update_by` varchar(255)
,`barang_revised` int(11)
,`jenis_barang_nama` varchar(255)
,`satuan_nama` varchar(255)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_bkb`
--
CREATE TABLE IF NOT EXISTS `v_bkb` (
`keluar_barang_id` int(11)
,`keluar_barang_nomor` varchar(255)
,`keluar_barang_jenis` varchar(14)
,`keluar_barang_tanggal` datetime
,`cabang_id` int(11)
,`cabang_nama` varchar(255)
,`departemen_id` int(11)
,`departemen_nama` varchar(255)
,`keluar_barang_status` varchar(12)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_bukti_bank`
--
CREATE TABLE IF NOT EXISTS `v_bukti_bank` (
`bukti_bank_id` int(11)
,`cabang_id` int(11)
,`cabang_nama` varchar(255)
,`bukti_bank_nomor` varchar(255)
,`bukti_bank_tanggal` datetime
,`bukti_bank_lampiran` int(11)
,`partner_id` int(11)
,`partner_nama` varchar(255)
,`bukti_bank_catatan` varchar(255)
,`bukti_bank_jumlah_bayar` decimal(20,2)
,`bukti_bank_tipe` int(11)
,`bukti_bank_tipe_nama` varchar(17)
,`bukti_bank_status` int(11)
,`bukti_bank_created_date` datetime
,`bukti_bank_created_by` varchar(255)
,`bukti_bank_updated_date` datetime
,`bukti_bank_updated_by` varchar(255)
,`bukti_bank_revised` int(11)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_bukti_bgcek`
--
CREATE TABLE IF NOT EXISTS `v_bukti_bgcek` (
`bukti_bgcek_id` int(11)
,`cabang_id` int(11)
,`cabang_nama` varchar(255)
,`bukti_bgcek_nomor` varchar(255)
,`bukti_bgcek_tanggal` datetime
,`partner_id` int(11)
,`partner_nama` varchar(255)
,`bukti_bgcek_catatan` varchar(255)
,`bukti_bgcek_jumlah_bayar` decimal(20,2)
,`bukti_bgcek_tipe` int(11)
,`bukti_bgcek_tipe_nama` varchar(17)
,`bukti_bgcek_status` int(11)
,`bukti_bgcek_created_date` datetime
,`bukti_bgcek_created_by` varchar(255)
,`bukti_bgcek_updated_date` datetime
,`bukti_bgcek_updated_by` varchar(255)
,`bukti_bgcek_revised` int(11)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_bukti_kas`
--
CREATE TABLE IF NOT EXISTS `v_bukti_kas` (
`bukti_kas_id` int(11)
,`cabang_id` int(11)
,`cabang_nama` varchar(255)
,`bukti_kas_nomor` varchar(255)
,`bukti_kas_tanggal` datetime
,`bukti_kas_lampiran` int(11)
,`partner_id` int(11)
,`partner_nama` varchar(255)
,`bukti_kas_catatan` varchar(255)
,`bukti_kas_jumlah_bayar` decimal(20,2)
,`bukti_kas_tipe` int(11)
,`bukti_kas_tipe_nama` varchar(17)
,`bukti_kas_status` int(11)
,`bukti_kas_created_date` datetime
,`bukti_kas_created_by` varchar(255)
,`bukti_kas_updated_date` datetime
,`bukti_kas_updated_by` varchar(255)
,`bukti_kas_revised` int(11)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_category_2`
--
CREATE TABLE IF NOT EXISTS `v_category_2` (
`category_2_id` int(11)
,`m_jenis_barang_id` int(11)
,`jenis_barang_nama` varchar(255)
,`category_2_nama` varchar(255)
,`category_2_status_aktif` char(1)
,`category_2_create_date` datetime
,`category_2_create_by` varchar(255)
,`category_2_update_date` datetime
,`category_2_update_by` varchar(255)
,`category_2_revised` int(11)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_category_konsinyasi`
--
CREATE TABLE IF NOT EXISTS `v_category_konsinyasi` (
`barang_id` int(11)
,`jenis_barang_id` int(11)
,`category_2_id` int(11)
,`barang_kode` varchar(255)
,`barang_nomor` varchar(255)
,`barang_nama` varchar(255)
,`m_satuan_id` int(11)
,`m_brand_id` int(11)
,`harga_beli` int(11)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_coa`
--
CREATE TABLE IF NOT EXISTS `v_coa` (
`coa_id` int(11)
,`coa_kode` int(255)
,`coa_header` int(11)
,`coa_subheader` int(11)
,`coa_tipe` int(11)
,`coa_tipe_nama` varchar(14)
,`coa_nama` varchar(255)
,`coa_keterangan` varchar(255)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_estimasi_penjualan`
--
CREATE TABLE IF NOT EXISTS `v_estimasi_penjualan` (
`estimasi_penjualan_id` int(11)
,`estimasi_penjualan_nomor` varchar(255)
,`cabang_id` int(11)
,`cabang_nama` varchar(255)
,`estimasi_penjualan_periode` varchar(255)
,`estimasi_penjualan_status` varchar(255)
,`estimasi_penjualan_status_nama` varchar(25)
,`estimasi_penjualan_created_date` datetime
,`estimasi_penjualan_created_by` varchar(255)
,`estimasi_penjualan_update_date` datetime
,`estimasi_penjualan_update_by` varchar(255)
,`estimasi_penjualan_revised` int(11)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_faktur_penjualan`
--
CREATE TABLE IF NOT EXISTS `v_faktur_penjualan` (
`faktur_penjualan_id` int(11)
,`faktur_penjualan_nomor` varchar(255)
,`cabang_id` int(11)
,`cabang_nama` varchar(255)
,`faktur_penjualan_tanggal` datetime
,`faktur_penjualan_jatuh_tempo` datetime
,`surat_jalan_id` int(11)
,`surat_jalan_nomor` varchar(255)
,`faktur_penjualan_tujuan_transfer` text
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_gudang`
--
CREATE TABLE IF NOT EXISTS `v_gudang` (
`gudang_id` int(255)
,`gudang_nama` varchar(255)
,`gudang_alamat` varchar(255)
,`gudang_kota` varchar(255)
,`gudang_telepon` varchar(255)
,`gudang_fax` varchar(255)
,`gudang_email` varchar(255)
,`m_cabang_id` int(11)
,`m_jenis_gudang_id` int(11)
,`gudang_status_aktif` char(1)
,`gudang_create_date` datetime
,`gudang_create_by` varchar(255)
,`gudang_update_date` datetime
,`gudang_update_by` varchar(255)
,`gudang_revised` int(11)
,`jenis_gudang_nama` varchar(255)
,`cabang_nama` varchar(255)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_jadwal_produksi`
--
CREATE TABLE IF NOT EXISTS `v_jadwal_produksi` (
`jadwal_produksi_id` int(11)
,`jadwal_produksi_nomor` varchar(255)
,`jadwal_produksi_periode` varchar(255)
,`cabang_id` int(11)
,`cabang_nama` varchar(255)
,`jadwal_produksi_shift` varchar(255)
,`jadwal_produksi_jenis` varchar(255)
,`jadwal_produksi_kebutuhan` int(11)
,`estimasi_penjualan_id` int(11)
,`estimasi_penjualan_nomor` varchar(255)
,`so_customer_id` int(11)
,`so_customer_nomor` varchar(255)
,`jadwal_produksi_status` varchar(255)
,`jadwal_produksi_status_nama` varchar(27)
,`jadwal_produksi_status_date` datetime
,`jadwal_produksi_created_date` datetime
,`jadwal_produksi_created_by` varchar(255)
,`jadwal_produksi_update_date` datetime
,`jadwal_produksi_update_by` varchar(255)
,`jadwal_produksi_revised` int(11)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_jurnal`
--
CREATE TABLE IF NOT EXISTS `v_jurnal` (
`jurnal_id` int(11)
,`jurnal_tanggal` datetime
,`cabang_id` int(11)
,`cabang_nama` varchar(255)
,`coa_id` int(11)
,`coa_nama` varchar(255)
,`jurnal_refrensi_nomor` varchar(50)
,`jurnal_keterangan` text
,`jurnal_debit` decimal(20,2)
,`jurnal_kredit` decimal(20,2)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_kartu_stok`
--
CREATE TABLE IF NOT EXISTS `v_kartu_stok` (
`barang_id` int(11)
,`jenis_barang_id` int(11)
,`jenis_barang_nama` varchar(255)
,`barang_kode` varchar(255)
,`barang_nama` varchar(255)
,`satuan_id` int(11)
,`satuan_nama` varchar(255)
,`stok_minimum` int(11)
,`stok_gudang` int(20)
,`gudang_id` int(255)
,`gudang_nama` varchar(255)
,`cabang_id` int(11)
,`cabang_nama` varchar(255)
,`kartu_stok_tanggal` datetime
,`kartu_stok_id` int(11)
,`kartu_stok_referensi` varchar(255)
,`kartu_stok_saldo` int(255)
,`kartu_stok_masuk` bigint(255)
,`kartu_stok_keluar` int(255)
,`kartu_stok_sisa` bigint(67)
,`kartu_stok_penyesuaian` int(11)
,`kartu_stok_keterangan` text
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_karyawan`
--
CREATE TABLE IF NOT EXISTS `v_karyawan` (
`karyawan_id` int(11)
,`karyawan_nip` varchar(255)
,`karyawan_nama` varchar(255)
,`karyawan_alamat` varchar(255)
,`karyawan_telepon` varchar(255)
,`m_type_karyawan_id` int(11)
,`m_cabang_id` int(11)
,`m_departemen_id` int(11)
,`karyawan_status_aktif` char(255)
,`karyawan_create_date` datetime
,`karyawan_create_by` varchar(255)
,`karyawan_update_date` datetime
,`karyawan_update_by` varchar(255)
,`karyawan_revised` int(11)
,`type_karyawan_nama` varchar(255)
,`cabang_nama` varchar(255)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_kas`
--
CREATE TABLE IF NOT EXISTS `v_kas` (
`kas_id` int(11)
,`cabang_id` int(11)
,`cabang_nama` varchar(255)
,`kas_nama` varchar(255)
,`kas_status_aktif` char(1)
,`kas_created_date` datetime
,`kas_created_by` varchar(255)
,`kas_update_date` datetime
,`kas_update_by` varchar(255)
,`kas_revised` int(11)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_keluar_barang`
--
CREATE TABLE IF NOT EXISTS `v_keluar_barang` (
`keluar_barang_id` int(11)
,`cabang_id` int(11)
,`cabang_nama` varchar(255)
,`keluar_barang_nomor` varchar(255)
,`keluar_barang_tanggal` datetime
,`keluar_barang_jenis` int(255)
,`keluar_barang_jenis_nama` varchar(14)
,`gudang_id_permintaan` int(255)
,`gudang_nama_permintaan` varchar(255)
,`gudang_id_tujuan` int(255)
,`gudang_nama_tujuan` varchar(255)
,`departemen_id` int(11)
,`departemen_nama` varchar(255)
,`keluar_barang_status` int(255)
,`keluar_barang_status_nama` varchar(255)
,`keluar_barang_status_date` datetime
,`keluar_barang_penerima` varchar(255)
,`keluar_barang_penyerah` varchar(255)
,`keluar_barang_pembuat` varchar(255)
,`keluar_barang_printed` int(255)
,`keluar_barang_created_date` datetime
,`keluar_barang_created_by` varchar(255)
,`keluar_barang_update_date` datetime
,`keluar_barang_update_by` varchar(0)
,`keluar_barang_revised` int(255)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_ketidaksesuaian_spesifikasi`
--
CREATE TABLE IF NOT EXISTS `v_ketidaksesuaian_spesifikasi` (
`ketidaksesuaian_spesifikasi_id` int(11)
,`ketidaksesuaian_spesifikasi_nomor` varchar(255)
,`ketidaksesuaian_spesifikasi_tanggal` datetime
,`cabang_id` int(11)
,`cabang_nama` varchar(255)
,`perolehan_produksi_id` int(11)
,`perolehan_produksi_nomor` varchar(255)
,`ketidaksesuaian_spesifikasi_created_date` datetime
,`ketidaksesuaian_spesifikasi_created_by` varchar(255)
,`ketidaksesuaian_spesifikasi_update_date` datetime
,`ketidaksesuaian_spesifikasi_update_by` varchar(255)
,`ketidaksesuaian_spesifikasi_revised` varchar(255)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_konsinyasi`
--
CREATE TABLE IF NOT EXISTS `v_konsinyasi` (
`konsinyasi_id` int(11)
,`m_jenis_barang_id` int(11)
,`jenis_barang_nama` varchar(255)
,`m_category_2_id` int(11)
,`category_2_nama` varchar(255)
,`m_barang_id` varchar(255)
,`barang_nama` varchar(255)
,`konsinyasi_status_aktif` char(1)
,`konsinyasi_create_date` datetime
,`konsinyasi_create_by` varchar(255)
,`konsinyasi_update_date` datetime
,`konsinyasi_update_by` varchar(255)
,`konsinyasi_revised` int(11)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_laporan_spp_belum_realisasi`
--
CREATE TABLE IF NOT EXISTS `v_laporan_spp_belum_realisasi` (
`cabang_id` int(11)
,`cabang_nama` varchar(255)
,`gudang_id` int(255)
,`gudang_nama` varchar(255)
,`permintaan_pembelian_nomor` varchar(255)
,`permintaan_pembelian_tanggal` datetime
,`barang_kode` varchar(255)
,`barang_nama` varchar(255)
,`permintaan_pembelian_qty` int(11)
,`satuan_nama` varchar(255)
,`permintaan_pembelian_alasan` text
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_mutasi_bankkas`
--
CREATE TABLE IF NOT EXISTS `v_mutasi_bankkas` (
`mutasi_bankkas_id` int(11)
,`mutasi_bankkas_nomor` varchar(50)
,`mutasi_bankkas_tanggal` datetime
,`mutasi_bankkas_tipe` int(11)
,`mutasi_bankkas_tipe_nama` varchar(19)
,`mutasi_bankkas_dari` varchar(255)
,`mutasi_bankkas_ke` varchar(255)
,`cabang_id` bigint(11)
,`cabang_nama` varchar(255)
,`mutasi_bankkas_nominal` decimal(20,2)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_nota_debet`
--
CREATE TABLE IF NOT EXISTS `v_nota_debet` (
`nota_debet_id` int(11)
,`nota_debet_nomor` varchar(255)
,`nota_debet_tanggal` varchar(255)
,`retur_pembelian_id` int(11)
,`retur_pembelian_nomor` varchar(255)
,`retur_pembelian_tanggal` varchar(255)
,`cabang_id` int(11)
,`cabang_nama` varchar(255)
,`partner_id` int(11)
,`partner_nama` varchar(255)
,`gudang_id` int(255)
,`gudang_nama` varchar(255)
,`nota_debet_subtotal` decimal(10,0)
,`nota_debet_ppn` decimal(10,0)
,`nota_debet_total` decimal(10,0)
,`nota_debet_catatan` varchar(255)
,`nota_debet_metode_pembayaran` int(11)
,`nota_debet_status` int(255)
,`nota_debet_status_nama` varchar(20)
,`nota_debet_status_date` datetime
,`nota_debet_printed` int(255)
,`nota_debet_created_date` datetime
,`nota_debet_created_by` varchar(255)
,`nota_debet_update_date` datetime
,`nota_debet_update_by` varchar(0)
,`nota_debet_revised` int(255)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_nota_kredit`
--
CREATE TABLE IF NOT EXISTS `v_nota_kredit` (
`nota_kredit_id` int(11)
,`nota_kredit_nomor` varchar(255)
,`cabang_id` int(11)
,`cabang_nama` varchar(255)
,`nota_kredit_tanggal` datetime
,`nota_kredit_jenis` int(11)
,`nomor_refrensi` varchar(255)
,`sj_retur_id` int(11)
,`sj_retur_nomor` varchar(255)
,`nota_kredit_netto` float(255,0)
,`nota_kredit_potongan_harga` float(255,0)
,`nota_kredit_uang_muka` float(255,0)
,`nota_kredit_ppn` float(255,0)
,`nota_kredit_total` float(255,0)
,`nota_kredit_catatan` text
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_order`
--
CREATE TABLE IF NOT EXISTS `v_order` (
`order_id` int(11)
,`order_nomor` varchar(255)
,`order_type` char(1)
,`order_jenis_nama` varchar(2)
,`order_tanggal` datetime
,`cabang_id` int(11)
,`cabang_nama` varchar(255)
,`penawaran_id` int(11)
,`penawaran_nomor` varchar(255)
,`partner_id` int(11)
,`partner_nama` varchar(255)
,`order_nama_dikirim` varchar(255)
,`order_alamat_dikirim` varchar(255)
,`order_hp_fax` varchar(255)
,`order_subtotal` int(255)
,`order_ppn` int(11)
,`order_total` int(255)
,`order_tanggal_kirim` datetime
,`order_pembayaran` int(255)
,`order_pembayaran_nama` varchar(6)
,`order_status` int(255)
,`order_status_nama` varchar(18)
,`order_status_date` datetime
,`order_printed` int(255)
,`order_created_date` datetime
,`order_created_by` varchar(255)
,`order_update_date` datetime
,`order_update_by` varchar(0)
,`order_revised` int(255)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_payment_request`
--
CREATE TABLE IF NOT EXISTS `v_payment_request` (
`payment_request_id` int(11)
,`cabang_id` int(11)
,`cabang_nama` varchar(255)
,`payment_request_nomor` varchar(255)
,`payment_request_tanggal` datetime
,`payment_request_lampiran` int(11)
,`partner_id` int(11)
,`partner_nama` varchar(255)
,`payment_request_keperluan` varchar(255)
,`payment_request_voucher` decimal(20,2)
,`payment_request_discount` decimal(20,2)
,`payment_request_jumlah_bayar` decimal(20,2)
,`payment_request_tipe_pengeluaran` int(11)
,`payment_request_tipe_pengeluaran_nama` varchar(4)
,`pengeluaran_id` int(11)
,`payment_request_pengeluaran_nama` varchar(255)
,`payment_request_status` int(11)
,`payment_request_status_nama` varchar(31)
,`payment_request_created_date` datetime
,`payment_request_created_by` varchar(255)
,`payment_request_updated_date` datetime
,`payment_request_updated_by` varchar(255)
,`payment_request_revised` int(11)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_payment_request_piutang`
--
CREATE TABLE IF NOT EXISTS `v_payment_request_piutang` (
`payment_request_piutang_id` int(11)
,`cabang_id` int(11)
,`cabang_nama` varchar(255)
,`payment_request_piutang_nomor` varchar(255)
,`payment_request_piutang_tanggal` datetime
,`payment_request_piutang_lampiran` int(11)
,`partner_id` int(11)
,`partner_nama` varchar(255)
,`payment_request_piutang_keperluan` varchar(255)
,`payment_request_piutang_voucher` decimal(20,2)
,`payment_request_piutang_discount` decimal(20,2)
,`payment_request_piutang_jumlah_bayar` decimal(20,2)
,`payment_request_piutang_tipe_pemasukkan` int(11)
,`payment_request_piutang_tipe_pemasukkan_nama` varchar(4)
,`pemasukkan_id` int(11)
,`payment_request_piutang_pemasukkan_nama` varchar(255)
,`payment_request_piutang_status` int(11)
,`payment_request_piutang_status_nama` varchar(33)
,`payment_request_piutang_created_date` datetime
,`payment_request_piutang_created_by` varchar(255)
,`payment_request_piutang_updated_date` datetime
,`payment_request_piutang_updated_by` varchar(255)
,`payment_request_piutang_revised` int(11)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_penawaran`
--
CREATE TABLE IF NOT EXISTS `v_penawaran` (
`penawaran_id` int(11)
,`penawaran_nomor` varchar(255)
,`penawaran_jenis` char(1)
,`penawaran_jenis_nama` varchar(9)
,`penawaran_tanggal` datetime
,`cabang_id` int(11)
,`cabang_nama` varchar(255)
,`penawaran_step` int(11)
,`penawaran_status` varchar(255)
,`penawaran_status_nama` varchar(20)
,`penawaran_status_date` datetime
,`penawaran_printed` int(11)
,`penawaran_create_date` datetime
,`penawaran_create_by` varchar(255)
,`penawaran_update_date` datetime
,`penawaran_update_by` varchar(255)
,`penawaran_revised` int(255)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_penerimaan_barang`
--
CREATE TABLE IF NOT EXISTS `v_penerimaan_barang` (
`penerimaan_barang_id` int(11)
,`penerimaan_barang_nomor` varchar(255)
,`penerimaan_barang_tanggal` datetime
,`cabang_id` int(11)
,`cabang_nama` varchar(255)
,`order_id` int(11)
,`order_nomor` varchar(255)
,`penerimaan_barang_tanggal_terima` varchar(255)
,`penerimaan_barang_status` varchar(255)
,`penerimaan_barang_status_nama` varchar(12)
,`penerimaan_barang_status_date` datetime
,`penerimaan_barang_printed` varchar(255)
,`penerimaan_barang_created_date` datetime
,`penerimaan_barang_created_by` varchar(255)
,`penerimaan_barang_update_date` datetime
,`penerimaan_barang_update_by` varchar(0)
,`penerimaan_barang_revised` int(255)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_penerimaan_barang_retur`
--
CREATE TABLE IF NOT EXISTS `v_penerimaan_barang_retur` (
`bpbr_id` int(11)
,`bpbr_nomor` varchar(255)
,`cabang_id` int(11)
,`cabang_nama` varchar(255)
,`bpbr_tanggal` datetime
,`retur_penjualan_id` int(11)
,`retur_penjualan_nomor` varchar(255)
,`bpbr_pengecekan` datetime
,`bpbr_catatan` text
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_pengeluaran_kaskecil`
--
CREATE TABLE IF NOT EXISTS `v_pengeluaran_kaskecil` (
`pengeluaran_kaskecil_id` int(11)
,`pengeluaran_kaskecil_nomor` varchar(50)
,`pengeluaran_kaskecil_tanggal` datetime
,`kas_id` int(11)
,`kas_nama` varchar(255)
,`pengeluaran_kaskecil_total` decimal(20,2)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_pengembalian_barang`
--
CREATE TABLE IF NOT EXISTS `v_pengembalian_barang` (
`pengembalian_barang_id` int(11)
,`pengembalian_barang_nomor` varchar(255)
,`pengembalian_barang_awal` varchar(255)
,`pengembalian_barang_tujuan` varchar(255)
,`pengembalian_barang_status` int(11)
,`pengembalian_barang_status_nama` varchar(28)
,`pengembalian_barang_created_date` datetime
,`pengembalian_barang_created_by` varchar(255)
,`pengembalian_barang_update_date` datetime
,`pengembalian_barang_update_by` varchar(255)
,`pengembalian_barang_revised` int(255)
,`cabang_id` int(11)
,`cabang_nama` varchar(255)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_pengubahan_bahan`
--
CREATE TABLE IF NOT EXISTS `v_pengubahan_bahan` (
`pengubahan_bahan_id` int(11)
,`pengubahan_bahan_nomor` varchar(255)
,`pengubahan_bahan_tanggal` datetime
,`pengubahan_bahan_status` varchar(255)
,`pengubahan_bahan_status_nama` varchar(29)
,`pengubahan_bahan_created_date` datetime
,`pengubahan_bahan_created_by` varchar(255)
,`pengubahan_bahan_update_date` datetime
,`pengubahan_bahan_update_by` varchar(255)
,`pengubahan_bahan_revised` int(255)
,`cabang_id` int(11)
,`cabang_nama` varchar(255)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_perhitungan_kebutuhan`
--
CREATE TABLE IF NOT EXISTS `v_perhitungan_kebutuhan` (
`perhitungan_kebutuhan_id` int(11)
,`perhitungan_kebutuhan_nomor` varchar(255)
,`perhitungan_kebutuhan_tanggal` datetime
,`cabang_id` int(11)
,`cabang_nama` varchar(255)
,`jadwal_produksi_id` int(11)
,`jadwal_produksi_nomor` varchar(255)
,`perhitungan_kebutuhan_status` varchar(255)
,`perhitungan_kebutuhan_status_nama` varchar(33)
,`perhitungan_kebutuhan_status_date` datetime
,`perhitungan_kebutuhan_created_date` datetime
,`perhitungan_kebutuhan_created_by` varchar(255)
,`perhitungan_kebutuhan_update_date` datetime
,`perhitungan_kebutuhan_update_by` varchar(255)
,`perhitungan_kebutuhan_revised` int(11)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_permintaan_jasa`
--
CREATE TABLE IF NOT EXISTS `v_permintaan_jasa` (
`permintaan_jasa_id` int(11)
,`cabang_id` int(11)
,`cabang_nama` varchar(255)
,`permintaan_jasa_nomor` varchar(255)
,`departemen_id` int(11)
,`departemen_nama` varchar(255)
,`permintaan_jasa_tanggal` datetime
,`permintaan_jasa_tanggal_dibutuhkan` datetime
,`permintaan_jasa_status` int(255)
,`permintaan_jasa_status_nama` varchar(13)
,`permintaan_jasa_status_date` datetime
,`permintaan_jasa_printed` int(255)
,`permintaan_jasa_created_date` datetime
,`permintaan_jasa_created_by` varchar(255)
,`permintaan_jasa_update_date` datetime
,`permintaan_jasa_update_by` varchar(0)
,`permintaan_jasa_revised` int(255)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_permintaan_pembelian`
--
CREATE TABLE IF NOT EXISTS `v_permintaan_pembelian` (
`permintaan_pembelian_id` int(11)
,`cabang_id` int(11)
,`cabang_nama` varchar(255)
,`permintaan_pembelian_nomor` varchar(255)
,`permintaan_pembelian_tanggal` datetime
,`permintaan_pembelian_tanggal_dibutuhkan` datetime
,`permintaan_pembelian_jenis` int(255)
,`permintaan_pembelian_jenis_nama` varchar(7)
,`gudang_id_permintaan` int(255)
,`gudang_nama_permintaan` varchar(255)
,`permintaan_pembelian_status` int(255)
,`permintaan_pembelian_status_nama` varchar(14)
,`permintaan_pembelian_status_date` datetime
,`permintaan_pembelian_penerima` varchar(255)
,`permintaan_pembelian_penyetuju` varchar(255)
,`permintaan_pembelian_pembuat` varchar(255)
,`permintaan_pembelian_printed` int(255)
,`permintaan_pembelian_created_date` datetime
,`permintaan_pembelian_created_by` varchar(255)
,`permintaan_pembelian_update_date` datetime
,`permintaan_pembelian_update_by` varchar(0)
,`permintaan_pembelian_revised` int(255)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_perolehan_produksi`
--
CREATE TABLE IF NOT EXISTS `v_perolehan_produksi` (
`perolehan_produksi_id` int(11)
,`perolehan_produksi_nomor` varchar(255)
,`perolehan_produksi_total` int(11)
,`perolehan_produksi_afalan` int(11)
,`perolehan_produksi_created_date` datetime
,`perolehan_produksi_created_by` varchar(255)
,`perolehan_produksi_update_date` datetime
,`perolehan_produksi_update_by` varchar(255)
,`perolehan_produksi_revised` int(255)
,`cabang_id` int(11)
,`cabang_nama` varchar(255)
,`gudang_id` int(255)
,`gudang_nama` varchar(255)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_po_customer`
--
CREATE TABLE IF NOT EXISTS `v_po_customer` (
`po_customer_id` int(11)
,`cabang_id` int(11)
,`cabang_nama` varchar(255)
,`po_customer_nomor` varchar(255)
,`po_customer_tanggal` datetime
,`partner_id` int(11)
,`partner_nama` varchar(255)
,`po_customer_kontak_person` varchar(255)
,`po_customer_nama_pelanggan` varchar(255)
,`po_customer_perjanjian_bayar` int(255)
,`po_customer_jasaangkut_jenis` int(255)
,`po_customer_jasaangkut_jenis_nama` varchar(13)
,`po_customer_ekspedisi` varchar(255)
,`po_customer_jasaangkut_bayar` int(255)
,`po_customer_jasaangkut_bayar_nama` varchar(12)
,`po_customer_catatan` text
,`po_customer_step` int(11)
,`po_customer_status` int(255)
,`po_customer_status_nama_old` varchar(20)
,`po_customer_status_nama_lama` varchar(22)
,`po_customer_status_nama` varchar(22)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_retur_pembelian`
--
CREATE TABLE IF NOT EXISTS `v_retur_pembelian` (
`retur_pembelian_id` int(11)
,`retur_pembelian_nomor` varchar(255)
,`retur_pembelian_tanggal` varchar(255)
,`cabang_id` int(11)
,`cabang_nama` varchar(255)
,`penerimaan_barang_id` int(11)
,`penerimaan_barang_nomor` varchar(255)
,`order_ppn` int(11)
,`retur_pembelian_status` int(255)
,`retur_pembelian_status_nama` varchar(25)
,`retur_pembelian_status_date` datetime
,`retur_pembelian_printed` int(255)
,`retur_pembelian_created_date` datetime
,`retur_pembelian_created_by` varchar(255)
,`retur_pembelian_update_date` datetime
,`retur_pembelian_update_by` varchar(0)
,`retur_pembelian_revised` int(255)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_saldo_bankkas`
--
CREATE TABLE IF NOT EXISTS `v_saldo_bankkas` (
`saldo_bankkas_id` int(11)
,`saldo_bankkas_tipe` int(11)
,`saldo_bankkas_tipe_nama` varchar(10)
,`bankkas_id` bigint(11)
,`bankkas_nama` varchar(255)
,`cabang_id` bigint(11)
,`cabang_nama` varchar(255)
,`bankkas_status_aktif` varchar(1)
,`saldo_bankkas_nominal` decimal(20,2)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_serah_terima`
--
CREATE TABLE IF NOT EXISTS `v_serah_terima` (
`serah_terima_id` int(11)
,`serah_terima_nomor` varchar(255)
,`serah_terima_daribagian` varchar(255)
,`serah_terima_darishift` varchar(255)
,`serah_terima_kebagian` varchar(255)
,`serah_terima_keshift` varchar(255)
,`serah_terima_status` int(255)
,`serah_terima_status_nama` varchar(21)
,`serah_terima_created_date` datetime
,`serah_terima_created_by` varchar(255)
,`serah_terima_update_date` datetime
,`serah_terima_update_by` varchar(255)
,`serah_terima_revised` int(255)
,`cabang_id` int(11)
,`cabang_nama` varchar(255)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_stok_gudang`
--
CREATE TABLE IF NOT EXISTS `v_stok_gudang` (
`barang_id` int(11)
,`jenis_barang_id` int(11)
,`jenis_barang_nama` varchar(255)
,`barang_nomor` varchar(255)
,`barang_nama` varchar(255)
,`barang_status_aktif` char(1)
,`satuan_id` int(11)
,`satuan_nama` varchar(255)
,`stok_minimum` int(11)
,`stok_gudang` int(20)
,`gudang_id` int(255)
,`gudang_nama` varchar(255)
,`id_cabang` int(11)
,`cabang_nama` varchar(255)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_sub_atribut`
--
CREATE TABLE IF NOT EXISTS `v_sub_atribut` (
`sub_atribut_id` int(11)
,`m_atribut_id` int(11)
,`sub_atribut_jenis` varchar(255)
,`sub_atribut_nama` varchar(255)
,`sub_atribut_satuan` varchar(255)
,`sub_atribut_default_value` varchar(255)
,`sub_atribut_status_aktif` varchar(255)
,`sub_atribut_create_date` datetime
,`sub_atribut_create_by` varchar(255)
,`sub_atribut_update_date` datetime
,`sub_atribut_update_by` varchar(255)
,`sub_atribut_revised` int(11)
,`atribut_nama` varchar(255)
,`m_barang_id` int(11)
,`barang_nama` varchar(255)
,`satuan_nama` varchar(255)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_surat_jalan`
--
CREATE TABLE IF NOT EXISTS `v_surat_jalan` (
`surat_jalan_id` int(11)
,`surat_jalan_nomor` varchar(255)
,`cabang_id` int(11)
,`cabang_nama` varchar(255)
,`surat_jalan_jenis` tinyint(1)
,`surat_jalan_jenis_nama` varchar(23)
,`nomor_referensi` varchar(255)
,`surat_jalan_tanggal` datetime
,`surat_jalan_tanggal_kirim` datetime
,`surat_jalan_ekspedisi` varchar(255)
,`so_customer_id` varchar(255)
,`nota_debet_id` int(11)
,`nota_debet_nomor` varchar(255)
,`partner_id` int(11)
,`partner_nama` varchar(255)
,`order_id` int(11)
,`order_nomor` varchar(255)
,`surat_jalan_status` int(11)
,`surat_jalan_status_date` datetime
,`surat_jalan_created_date` datetime
,`surat_jalan_created_by` varchar(255)
,`surat_jalan_update_date` datetime
,`surat_jalan_update_by` varchar(255)
,`surat_jalan_revised` int(11)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_transfer_gudang`
--
CREATE TABLE IF NOT EXISTS `v_transfer_gudang` (
`transfer_gudang_id` int(11)
,`transfer_gudang_nomor` varchar(255)
,`transfer_gudang_tanggal` datetime
,`gudang_id_awal` int(255)
,`gudang_nama_awal` varchar(255)
,`cabang_id_awal` int(11)
,`cabang_nama_awal` varchar(255)
,`transfer_gudang_tanggal_terima` datetime
,`gudang_id_akhir` int(255)
,`gudang_nama_akhir` varchar(255)
,`cabang_id_akhir` int(11)
,`cabang_nama_akhir` varchar(255)
,`transfer_gudang_status` int(11)
,`transfer_gudang_status_nama` varchar(24)
,`transfer_gudang_created_date` datetime
,`transfer_gudang_created_by` varchar(255)
,`transfer_gudang_update_date` datetime
,`transfer_gudang_update_by` varchar(255)
,`transfer_gudang_revised` int(11)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_user`
--
CREATE TABLE IF NOT EXISTS `v_user` (
`user_id` int(11)
,`user_username` varchar(255)
,`karyawan_id` int(11)
,`karyawan_nama` varchar(255)
,`user_status_aktif` char(1)
,`user_status_nama` varchar(9)
);

-- --------------------------------------------------------

--
-- Structure for view `v_atribut`
--
DROP TABLE IF EXISTS `v_atribut`;

CREATE ALGORITHM=UNDEFINED DEFINER=`jasaprog_tangs`@`localhost` SQL SECURITY DEFINER VIEW `v_atribut` AS select `a`.`atribut_id` AS `atribut_id`,`a`.`m_barang_id` AS `m_barang_id`,`a`.`atribut_jenis` AS `atribut_jenis`,`a`.`atribut_nama` AS `atribut_nama`,`a`.`atribut_satuan` AS `atribut_satuan`,`a`.`atribut_default_value` AS `atribut_default_value`,`a`.`atribut_status_aktif` AS `atribut_status_aktif`,`a`.`atribut_create_date` AS `atribut_create_date`,`a`.`atribut_create_by` AS `atribut_create_by`,`a`.`atribut_update_date` AS `atribut_update_date`,`a`.`atribut_update_by` AS `atribut_update_by`,`a`.`atribut_revised` AS `atribut_revised`,`b`.`barang_nama` AS `barang_nama`,`c`.`satuan_nama` AS `satuan_nama` from ((`m_atribut_barang` `a` left join `m_barang` `b` on((`a`.`m_barang_id` = `b`.`barang_id`))) left join `m_satuan` `c` on((`a`.`atribut_satuan` = `c`.`satuan_id`)));

-- --------------------------------------------------------

--
-- Structure for view `v_bank`
--
DROP TABLE IF EXISTS `v_bank`;

CREATE ALGORITHM=UNDEFINED DEFINER=`jasaprog_tangs`@`localhost` SQL SECURITY DEFINER VIEW `v_bank` AS select `a`.`bank_id` AS `bank_id`,`b`.`cabang_id` AS `cabang_id`,`b`.`cabang_nama` AS `cabang_nama`,`a`.`bank_cabang` AS `bank_cabang`,`a`.`bank_nama` AS `bank_nama`,`a`.`bank_atas_nama` AS `bank_atas_nama`,`a`.`bank_no_rek` AS `bank_no_rek`,`a`.`bank_status_aktif` AS `bank_status_aktif`,`a`.`bank_created_date` AS `bank_created_date`,`a`.`bank_created_by` AS `bank_created_by`,`a`.`bank_update_date` AS `bank_update_date`,`a`.`bank_update_by` AS `bank_update_by`,`a`.`bank_revised` AS `bank_revised` from (`m_bank` `a` join `m_cabang` `b` on((`b`.`cabang_id` = `a`.`m_cabang_id`)));

-- --------------------------------------------------------

--
-- Structure for view `v_barang`
--
DROP TABLE IF EXISTS `v_barang`;

CREATE ALGORITHM=UNDEFINED DEFINER=`jasaprog_tangs`@`localhost` SQL SECURITY DEFINER VIEW `v_barang` AS (select `a`.`barang_id` AS `barang_id`,`a`.`m_jenis_barang_id` AS `m_jenis_barang_id`,`a`.`barang_kode` AS `barang_kode`,`a`.`barang_nomor` AS `barang_nomor`,`a`.`barang_nama` AS `barang_nama`,`a`.`barang_minimum_stok` AS `barang_minimum_stok`,`a`.`barang_status_aktif` AS `barang_status_aktif`,`a`.`barang_create_date` AS `barang_create_date`,`a`.`barang_create_by` AS `barang_create_by`,`a`.`barang_update_date` AS `barang_update_date`,`a`.`barang_update_by` AS `barang_update_by`,`a`.`barang_revised` AS `barang_revised`,`b`.`jenis_barang_nama` AS `jenis_barang_nama`,`c`.`satuan_nama` AS `satuan_nama` from ((`m_barang` `a` left join `m_jenis_barang` `b` on((`a`.`m_jenis_barang_id` = `b`.`jenis_barang_id`))) left join `m_satuan` `c` on((`a`.`m_satuan_id` = `c`.`satuan_id`))));

-- --------------------------------------------------------

--
-- Structure for view `v_bkb`
--
DROP TABLE IF EXISTS `v_bkb`;

CREATE ALGORITHM=UNDEFINED DEFINER=`jasaprog_tangs`@`localhost` SQL SECURITY DEFINER VIEW `v_bkb` AS (select `a`.`keluar_barang_id` AS `keluar_barang_id`,`a`.`keluar_barang_nomor` AS `keluar_barang_nomor`,if((`a`.`keluar_barang_jenis` = 1),'Bahan Baku',if((`a`.`keluar_barang_jenis` = 2),'Bahan Penolong','Lain Lain')) AS `keluar_barang_jenis`,`a`.`keluar_barang_tanggal` AS `keluar_barang_tanggal`,`b`.`cabang_id` AS `cabang_id`,`b`.`cabang_nama` AS `cabang_nama`,`c`.`departemen_id` AS `departemen_id`,`c`.`departemen_nama` AS `departemen_nama`,if((`a`.`keluar_barang_status` = 1),'BKB Baru',if((`a`.`keluar_barang_status` = 2),'BKB Diterima',if((`a`.`keluar_barang_status` = 3),'BKB Pending','BKB Terkirim'))) AS `keluar_barang_status` from ((`t_keluar_barang` `a` join `m_cabang` `b` on((`b`.`cabang_id` = `a`.`m_cabang_id`))) join `m_departemen` `c` on((`c`.`departemen_id` = `a`.`m_departemen_id`))));

-- --------------------------------------------------------

--
-- Structure for view `v_bukti_bank`
--
DROP TABLE IF EXISTS `v_bukti_bank`;

CREATE ALGORITHM=UNDEFINED DEFINER=`jasaprog_tangs`@`localhost` SQL SECURITY DEFINER VIEW `v_bukti_bank` AS (select `a`.`bukti_bank_id` AS `bukti_bank_id`,`b`.`cabang_id` AS `cabang_id`,`b`.`cabang_nama` AS `cabang_nama`,`a`.`bukti_bank_nomor` AS `bukti_bank_nomor`,`a`.`bukti_bank_tanggal` AS `bukti_bank_tanggal`,`a`.`bukti_bank_lampiran` AS `bukti_bank_lampiran`,`c`.`partner_id` AS `partner_id`,`c`.`partner_nama` AS `partner_nama`,`a`.`bukti_bank_catatan` AS `bukti_bank_catatan`,`a`.`bukti_bank_jumlah_bayar` AS `bukti_bank_jumlah_bayar`,`a`.`bukti_bank_tipe` AS `bukti_bank_tipe`,if((`a`.`bukti_bank_tipe` = 1),'Bukti Bank Keluar','Bukti Bank Masuk') AS `bukti_bank_tipe_nama`,`a`.`bukti_bank_status` AS `bukti_bank_status`,`a`.`bukti_bank_created_date` AS `bukti_bank_created_date`,`a`.`bukti_bank_created_by` AS `bukti_bank_created_by`,`a`.`bukti_bank_updated_date` AS `bukti_bank_updated_date`,`a`.`bukti_bank_updated_by` AS `bukti_bank_updated_by`,`a`.`bukti_bank_revised` AS `bukti_bank_revised` from ((`t_bukti_bank` `a` join `m_cabang` `b` on((`b`.`cabang_id` = `a`.`m_cabang_id`))) join `m_partner` `c` on((`c`.`partner_id` = `a`.`m_partner_id`))));

-- --------------------------------------------------------

--
-- Structure for view `v_bukti_bgcek`
--
DROP TABLE IF EXISTS `v_bukti_bgcek`;

CREATE ALGORITHM=UNDEFINED DEFINER=`jasaprog_tangs`@`localhost` SQL SECURITY DEFINER VIEW `v_bukti_bgcek` AS (select `a`.`bukti_bgcek_id` AS `bukti_bgcek_id`,`b`.`cabang_id` AS `cabang_id`,`b`.`cabang_nama` AS `cabang_nama`,`a`.`bukti_bgcek_nomor` AS `bukti_bgcek_nomor`,`a`.`bukti_bgcek_tanggal` AS `bukti_bgcek_tanggal`,`c`.`partner_id` AS `partner_id`,`c`.`partner_nama` AS `partner_nama`,`a`.`bukti_bgcek_catatan` AS `bukti_bgcek_catatan`,`a`.`bukti_bgcek_jumlah_bayar` AS `bukti_bgcek_jumlah_bayar`,`a`.`bukti_bgcek_tipe` AS `bukti_bgcek_tipe`,if((`a`.`bukti_bgcek_tipe` = 1),'Bukti Bank Keluar','Bukti Bank Masuk') AS `bukti_bgcek_tipe_nama`,`a`.`bukti_bgcek_status` AS `bukti_bgcek_status`,`a`.`bukti_bgcek_created_date` AS `bukti_bgcek_created_date`,`a`.`bukti_bgcek_created_by` AS `bukti_bgcek_created_by`,`a`.`bukti_bgcek_updated_date` AS `bukti_bgcek_updated_date`,`a`.`bukti_bgcek_updated_by` AS `bukti_bgcek_updated_by`,`a`.`bukti_bgcek_revised` AS `bukti_bgcek_revised` from ((`t_bukti_bgcek` `a` join `m_cabang` `b` on((`b`.`cabang_id` = `a`.`m_cabang_id`))) join `m_partner` `c` on((`c`.`partner_id` = `a`.`m_partner_id`))));

-- --------------------------------------------------------

--
-- Structure for view `v_bukti_kas`
--
DROP TABLE IF EXISTS `v_bukti_kas`;

CREATE ALGORITHM=UNDEFINED DEFINER=`jasaprog_tangs`@`localhost` SQL SECURITY DEFINER VIEW `v_bukti_kas` AS (select `a`.`bukti_kas_id` AS `bukti_kas_id`,`b`.`cabang_id` AS `cabang_id`,`b`.`cabang_nama` AS `cabang_nama`,`a`.`bukti_kas_nomor` AS `bukti_kas_nomor`,`a`.`bukti_kas_tanggal` AS `bukti_kas_tanggal`,`a`.`bukti_kas_lampiran` AS `bukti_kas_lampiran`,`c`.`partner_id` AS `partner_id`,`c`.`partner_nama` AS `partner_nama`,`a`.`bukti_kas_catatan` AS `bukti_kas_catatan`,`a`.`bukti_kas_jumlah_bayar` AS `bukti_kas_jumlah_bayar`,`a`.`bukti_kas_tipe` AS `bukti_kas_tipe`,if((`a`.`bukti_kas_tipe` = 1),'Bukti Bank Keluar','Bukti Bank Masuk') AS `bukti_kas_tipe_nama`,`a`.`bukti_kas_status` AS `bukti_kas_status`,`a`.`bukti_kas_created_date` AS `bukti_kas_created_date`,`a`.`bukti_kas_created_by` AS `bukti_kas_created_by`,`a`.`bukti_kas_updated_date` AS `bukti_kas_updated_date`,`a`.`bukti_kas_updated_by` AS `bukti_kas_updated_by`,`a`.`bukti_kas_revised` AS `bukti_kas_revised` from ((`t_bukti_kas` `a` join `m_cabang` `b` on((`b`.`cabang_id` = `a`.`m_cabang_id`))) join `m_partner` `c` on((`c`.`partner_id` = `a`.`m_partner_id`))));

-- --------------------------------------------------------

--
-- Structure for view `v_category_2`
--
DROP TABLE IF EXISTS `v_category_2`;

CREATE ALGORITHM=UNDEFINED DEFINER=`jasaprog_tangs`@`localhost` SQL SECURITY DEFINER VIEW `v_category_2` AS select `m_category_2`.`category_2_id` AS `category_2_id`,`m_category_2`.`m_jenis_barang_id` AS `m_jenis_barang_id`,`m_jenis_barang`.`jenis_barang_nama` AS `jenis_barang_nama`,`m_category_2`.`category_2_nama` AS `category_2_nama`,`m_category_2`.`category_2_status_aktif` AS `category_2_status_aktif`,`m_category_2`.`category_2_create_date` AS `category_2_create_date`,`m_category_2`.`category_2_create_by` AS `category_2_create_by`,`m_category_2`.`category_2_update_date` AS `category_2_update_date`,`m_category_2`.`category_2_update_by` AS `category_2_update_by`,`m_category_2`.`category_2_revised` AS `category_2_revised` from (`m_jenis_barang` join `m_category_2` on((`m_category_2`.`m_jenis_barang_id` = `m_jenis_barang`.`jenis_barang_id`)));

-- --------------------------------------------------------

--
-- Structure for view `v_category_konsinyasi`
--
DROP TABLE IF EXISTS `v_category_konsinyasi`;

CREATE ALGORITHM=UNDEFINED DEFINER=`jasaprog_tangs`@`localhost` SQL SECURITY DEFINER VIEW `v_category_konsinyasi` AS select `m_barang`.`barang_id` AS `barang_id`,`m_jenis_barang`.`jenis_barang_id` AS `jenis_barang_id`,`m_category_2`.`category_2_id` AS `category_2_id`,`m_barang`.`barang_kode` AS `barang_kode`,`m_barang`.`barang_nomor` AS `barang_nomor`,`m_barang`.`barang_nama` AS `barang_nama`,`m_barang`.`m_satuan_id` AS `m_satuan_id`,`m_barang`.`m_brand_id` AS `m_brand_id`,`m_barang`.`harga_beli` AS `harga_beli` from ((`m_barang` join `m_jenis_barang`) join `m_category_2`);

-- --------------------------------------------------------

--
-- Structure for view `v_coa`
--
DROP TABLE IF EXISTS `v_coa`;

CREATE ALGORITHM=UNDEFINED DEFINER=`jasaprog_tangs`@`localhost` SQL SECURITY DEFINER VIEW `v_coa` AS (select `m_coa`.`coa_id` AS `coa_id`,`m_coa`.`coa_kode` AS `coa_kode`,`m_coa`.`coa_header` AS `coa_header`,`m_coa`.`coa_subheader` AS `coa_subheader`,`m_coa`.`coa_tipe` AS `coa_tipe`,if((`m_coa`.`coa_tipe` = 1),'Header',if((`m_coa`.`coa_tipe` = 2),'Sub Header','Nama Perkiraan')) AS `coa_tipe_nama`,`m_coa`.`coa_nama` AS `coa_nama`,`m_coa`.`coa_keterangan` AS `coa_keterangan` from `m_coa`);

-- --------------------------------------------------------

--
-- Structure for view `v_estimasi_penjualan`
--
DROP TABLE IF EXISTS `v_estimasi_penjualan`;

CREATE ALGORITHM=UNDEFINED DEFINER=`jasaprog_tangs`@`localhost` SQL SECURITY DEFINER VIEW `v_estimasi_penjualan` AS select `a`.`estimasi_penjualan_id` AS `estimasi_penjualan_id`,`a`.`estimasi_penjualan_nomor` AS `estimasi_penjualan_nomor`,`b`.`cabang_id` AS `cabang_id`,`b`.`cabang_nama` AS `cabang_nama`,`a`.`estimasi_penjualan_periode` AS `estimasi_penjualan_periode`,`a`.`estimasi_penjualan_status` AS `estimasi_penjualan_status`,if((`a`.`estimasi_penjualan_status` = 1),'Estimasi Baru',if((`a`.`estimasi_penjualan_status` = 2),'Estimasi Diterima',if((`a`.`estimasi_penjualan_status` = 3),'Disetujui',if((`a`.`estimasi_penjualan_status` = 4),'Pembuatan Jadwal Produksi','Selesai')))) AS `estimasi_penjualan_status_nama`,`a`.`estimasi_penjualan_created_date` AS `estimasi_penjualan_created_date`,`a`.`estimasi_penjualan_created_by` AS `estimasi_penjualan_created_by`,`a`.`estimasi_penjualan_update_date` AS `estimasi_penjualan_update_date`,`a`.`estimasi_penjualan_update_by` AS `estimasi_penjualan_update_by`,`a`.`estimasi_penjualan_revised` AS `estimasi_penjualan_revised` from (`t_estimasi_penjualan` `a` join `m_cabang` `b` on((`b`.`cabang_id` = `a`.`m_cabang_id`)));

-- --------------------------------------------------------

--
-- Structure for view `v_faktur_penjualan`
--
DROP TABLE IF EXISTS `v_faktur_penjualan`;

CREATE ALGORITHM=UNDEFINED DEFINER=`jasaprog_tangs`@`localhost` SQL SECURITY DEFINER VIEW `v_faktur_penjualan` AS (select `a`.`faktur_penjualan_id` AS `faktur_penjualan_id`,`a`.`faktur_penjualan_nomor` AS `faktur_penjualan_nomor`,`b`.`cabang_id` AS `cabang_id`,`b`.`cabang_nama` AS `cabang_nama`,`a`.`faktur_penjualan_tanggal` AS `faktur_penjualan_tanggal`,`a`.`faktur_penjualan_jatuh_tempo` AS `faktur_penjualan_jatuh_tempo`,`c`.`surat_jalan_id` AS `surat_jalan_id`,`c`.`surat_jalan_nomor` AS `surat_jalan_nomor`,`a`.`faktur_penjualan_tujuan_transfer` AS `faktur_penjualan_tujuan_transfer` from ((`t_faktur_penjualan` `a` join `m_cabang` `b` on((`b`.`cabang_id` = `a`.`m_cabang_id`))) join `t_surat_jalan` `c` on((`c`.`surat_jalan_id` = `a`.`t_surat_jalan_id`))));

-- --------------------------------------------------------

--
-- Structure for view `v_gudang`
--
DROP TABLE IF EXISTS `v_gudang`;

CREATE ALGORITHM=UNDEFINED DEFINER=`jasaprog_tangs`@`localhost` SQL SECURITY DEFINER VIEW `v_gudang` AS select `a`.`gudang_id` AS `gudang_id`,`a`.`gudang_nama` AS `gudang_nama`,`a`.`gudang_alamat` AS `gudang_alamat`,`a`.`gudang_kota` AS `gudang_kota`,`a`.`gudang_telepon` AS `gudang_telepon`,`a`.`gudang_fax` AS `gudang_fax`,`a`.`gudang_email` AS `gudang_email`,`a`.`m_cabang_id` AS `m_cabang_id`,`a`.`m_jenis_gudang_id` AS `m_jenis_gudang_id`,`a`.`gudang_status_aktif` AS `gudang_status_aktif`,`a`.`gudang_create_date` AS `gudang_create_date`,`a`.`gudang_create_by` AS `gudang_create_by`,`a`.`gudang_update_date` AS `gudang_update_date`,`a`.`gudang_update_by` AS `gudang_update_by`,`a`.`gudang_revised` AS `gudang_revised`,`b`.`jenis_gudang_nama` AS `jenis_gudang_nama`,`c`.`cabang_nama` AS `cabang_nama` from ((`m_gudang` `a` left join `m_jenis_gudang` `b` on((`a`.`m_jenis_gudang_id` = `b`.`jenis_gudang_id`))) left join `m_cabang` `c` on((`a`.`m_cabang_id` = `c`.`cabang_id`)));

-- --------------------------------------------------------

--
-- Structure for view `v_jadwal_produksi`
--
DROP TABLE IF EXISTS `v_jadwal_produksi`;

CREATE ALGORITHM=UNDEFINED DEFINER=`jasaprog_tangs`@`localhost` SQL SECURITY DEFINER VIEW `v_jadwal_produksi` AS (select `a`.`jadwal_produksi_id` AS `jadwal_produksi_id`,`a`.`jadwal_produksi_nomor` AS `jadwal_produksi_nomor`,`a`.`jadwal_produksi_periode` AS `jadwal_produksi_periode`,`b`.`cabang_id` AS `cabang_id`,`b`.`cabang_nama` AS `cabang_nama`,`a`.`jadwal_produksi_shift` AS `jadwal_produksi_shift`,`a`.`jadwal_produksi_jenis` AS `jadwal_produksi_jenis`,`a`.`jadwal_produksi_kebutuhan` AS `jadwal_produksi_kebutuhan`,`c`.`estimasi_penjualan_id` AS `estimasi_penjualan_id`,`c`.`estimasi_penjualan_nomor` AS `estimasi_penjualan_nomor`,`a`.`t_so_customer_id` AS `so_customer_id`,`d`.`so_customer_nomor` AS `so_customer_nomor`,`a`.`jadwal_produksi_status` AS `jadwal_produksi_status`,if((`a`.`jadwal_produksi_status` = 1),'Jadwal Produksi Baru',if((`a`.`jadwal_produksi_status` = 2),'Jadwal Produksi Disetujui','Jadwal Produksi Direalisasi')) AS `jadwal_produksi_status_nama`,`a`.`jadwal_produksi_status_date` AS `jadwal_produksi_status_date`,`a`.`jadwal_produksi_created_date` AS `jadwal_produksi_created_date`,`a`.`jadwal_produksi_created_by` AS `jadwal_produksi_created_by`,`a`.`jadwal_produksi_update_date` AS `jadwal_produksi_update_date`,`a`.`jadwal_produksi_update_by` AS `jadwal_produksi_update_by`,`a`.`jadwal_produksi_revised` AS `jadwal_produksi_revised` from (((`t_jadwal_produksi` `a` join `m_cabang` `b` on((`b`.`cabang_id` = `a`.`m_cabang_id`))) left join `t_estimasi_penjualan` `c` on((`c`.`estimasi_penjualan_id` = `a`.`t_estimasi_penjualan_id`))) left join `t_so_customer` `d` on((`d`.`so_customer_id` = `a`.`t_so_customer_id`))));

-- --------------------------------------------------------

--
-- Structure for view `v_jurnal`
--
DROP TABLE IF EXISTS `v_jurnal`;

CREATE ALGORITHM=UNDEFINED DEFINER=`jasaprog_tangs`@`localhost` SQL SECURITY DEFINER VIEW `v_jurnal` AS (select `a`.`jurnal_id` AS `jurnal_id`,`a`.`jurnal_tanggal` AS `jurnal_tanggal`,`b`.`cabang_id` AS `cabang_id`,`b`.`cabang_nama` AS `cabang_nama`,`c`.`coa_id` AS `coa_id`,`c`.`coa_nama` AS `coa_nama`,`a`.`jurnal_refrensi_nomor` AS `jurnal_refrensi_nomor`,`a`.`jurnal_keterangan` AS `jurnal_keterangan`,`a`.`jurnal_debit` AS `jurnal_debit`,`a`.`jurnal_kredit` AS `jurnal_kredit` from ((`t_jurnal` `a` join `m_cabang` `b` on((`b`.`cabang_id` = `a`.`m_cabang_id`))) join `m_coa` `c` on((`c`.`coa_id` = `a`.`m_coa_id`))));

-- --------------------------------------------------------

--
-- Structure for view `v_kartu_stok`
--
DROP TABLE IF EXISTS `v_kartu_stok`;

CREATE ALGORITHM=UNDEFINED DEFINER=`jasaprog_tangs`@`localhost` SQL SECURITY DEFINER VIEW `v_kartu_stok` AS (select `a`.`barang_id` AS `barang_id`,`b`.`jenis_barang_id` AS `jenis_barang_id`,`b`.`jenis_barang_nama` AS `jenis_barang_nama`,`a`.`barang_kode` AS `barang_kode`,`a`.`barang_nama` AS `barang_nama`,`c`.`satuan_id` AS `satuan_id`,`c`.`satuan_nama` AS `satuan_nama`,`a`.`barang_minimum_stok` AS `stok_minimum`,`d`.`stok_gudang_jumlah` AS `stok_gudang`,`e`.`gudang_id` AS `gudang_id`,`e`.`gudang_nama` AS `gudang_nama`,`f`.`cabang_id` AS `cabang_id`,`f`.`cabang_nama` AS `cabang_nama`,`g`.`kartu_stok_tanggal` AS `kartu_stok_tanggal`,`g`.`kartu_stok_id` AS `kartu_stok_id`,`g`.`kartu_stok_referensi` AS `kartu_stok_referensi`,`g`.`kartu_stok_saldo` AS `kartu_stok_saldo`,if((`g`.`kartu_stok_penyesuaian` = 0),`g`.`kartu_stok_masuk`,`g`.`kartu_stok_penyesuaian`) AS `kartu_stok_masuk`,`g`.`kartu_stok_keluar` AS `kartu_stok_keluar`,if((`g`.`kartu_stok_penyesuaian` = 0),((`g`.`kartu_stok_saldo` + `g`.`kartu_stok_masuk`) - `g`.`kartu_stok_keluar`),`g`.`kartu_stok_penyesuaian`) AS `kartu_stok_sisa`,`g`.`kartu_stok_penyesuaian` AS `kartu_stok_penyesuaian`,`g`.`kartu_stok_keterangan` AS `kartu_stok_keterangan` from ((((((`m_barang` `a` join `m_jenis_barang` `b` on((`b`.`jenis_barang_id` = `a`.`m_jenis_barang_id`))) join `m_satuan` `c` on((`c`.`satuan_id` = `a`.`m_satuan_id`))) join `t_stok_gudang` `d` on((`d`.`m_barang_id` = `a`.`barang_id`))) join `m_gudang` `e` on((`e`.`gudang_id` = `d`.`m_gudang_id`))) join `m_cabang` `f` on((`f`.`cabang_id` = `e`.`m_cabang_id`))) join `t_kartu_stok` `g` on(((`g`.`m_barang_id` = `a`.`barang_id`) and (`g`.`m_gudang_id` = `e`.`gudang_id`)))));

-- --------------------------------------------------------

--
-- Structure for view `v_karyawan`
--
DROP TABLE IF EXISTS `v_karyawan`;

CREATE ALGORITHM=UNDEFINED DEFINER=`jasaprog_tangs`@`localhost` SQL SECURITY DEFINER VIEW `v_karyawan` AS select `a`.`karyawan_id` AS `karyawan_id`,`a`.`karyawan_nip` AS `karyawan_nip`,`a`.`karyawan_nama` AS `karyawan_nama`,`a`.`karyawan_alamat` AS `karyawan_alamat`,`a`.`karyawan_telepon` AS `karyawan_telepon`,`a`.`m_type_karyawan_id` AS `m_type_karyawan_id`,`a`.`m_cabang_id` AS `m_cabang_id`,`a`.`m_departemen_id` AS `m_departemen_id`,`a`.`karyawan_status_aktif` AS `karyawan_status_aktif`,`a`.`karyawan_create_date` AS `karyawan_create_date`,`a`.`karyawan_create_by` AS `karyawan_create_by`,`a`.`karyawan_update_date` AS `karyawan_update_date`,`a`.`karyawan_update_by` AS `karyawan_update_by`,`a`.`karyawan_revised` AS `karyawan_revised`,`b`.`type_karyawan_nama` AS `type_karyawan_nama`,`c`.`cabang_nama` AS `cabang_nama` from (((`m_karyawan` `a` left join `m_type_karyawan` `b` on((`a`.`m_type_karyawan_id` = `b`.`type_karyawan_id`))) left join `m_cabang` `c` on((`a`.`m_cabang_id` = `c`.`cabang_id`))) left join `m_departemen` `d` on((`a`.`m_departemen_id` = `d`.`departemen_id`)));

-- --------------------------------------------------------

--
-- Structure for view `v_kas`
--
DROP TABLE IF EXISTS `v_kas`;

CREATE ALGORITHM=UNDEFINED DEFINER=`jasaprog_tangs`@`localhost` SQL SECURITY DEFINER VIEW `v_kas` AS select `a`.`kas_id` AS `kas_id`,`b`.`cabang_id` AS `cabang_id`,`b`.`cabang_nama` AS `cabang_nama`,`a`.`kas_nama` AS `kas_nama`,`a`.`kas_status_aktif` AS `kas_status_aktif`,`a`.`kas_created_date` AS `kas_created_date`,`a`.`kas_created_by` AS `kas_created_by`,`a`.`kas_update_date` AS `kas_update_date`,`a`.`kas_update_by` AS `kas_update_by`,`a`.`kas_revised` AS `kas_revised` from (`m_kas` `a` join `m_cabang` `b` on((`b`.`cabang_id` = `a`.`m_cabang_id`)));

-- --------------------------------------------------------

--
-- Structure for view `v_keluar_barang`
--
DROP TABLE IF EXISTS `v_keluar_barang`;

CREATE ALGORITHM=UNDEFINED DEFINER=`jasaprog_tangs`@`localhost` SQL SECURITY DEFINER VIEW `v_keluar_barang` AS (select `a`.`keluar_barang_id` AS `keluar_barang_id`,`b`.`cabang_id` AS `cabang_id`,`b`.`cabang_nama` AS `cabang_nama`,`a`.`keluar_barang_nomor` AS `keluar_barang_nomor`,`a`.`keluar_barang_tanggal` AS `keluar_barang_tanggal`,`a`.`keluar_barang_jenis` AS `keluar_barang_jenis`,if((`a`.`keluar_barang_jenis` = 1),'Bahan Baku',if((`a`.`keluar_barang_jenis` = 2),'Bahan Penolong','Lain Lain')) AS `keluar_barang_jenis_nama`,`c`.`gudang_id` AS `gudang_id_permintaan`,`c`.`gudang_nama` AS `gudang_nama_permintaan`,`d`.`gudang_id` AS `gudang_id_tujuan`,`d`.`gudang_nama` AS `gudang_nama_tujuan`,`e`.`departemen_id` AS `departemen_id`,`e`.`departemen_nama` AS `departemen_nama`,`a`.`keluar_barang_status` AS `keluar_barang_status`,`f`.`status_nama` AS `keluar_barang_status_nama`,`a`.`keluar_barang_status_date` AS `keluar_barang_status_date`,`a`.`keluar_barang_penerima` AS `keluar_barang_penerima`,`a`.`keluar_barang_penyerah` AS `keluar_barang_penyerah`,`a`.`keluar_barang_pembuat` AS `keluar_barang_pembuat`,`a`.`keluar_barang_printed` AS `keluar_barang_printed`,`a`.`keluar_barang_created_date` AS `keluar_barang_created_date`,`a`.`keluar_barang_created_by` AS `keluar_barang_created_by`,`a`.`keluar_barang_update_date` AS `keluar_barang_update_date`,`a`.`keluar_barang_update_by` AS `keluar_barang_update_by`,`a`.`keluar_barang_revised` AS `keluar_barang_revised` from (((((`t_keluar_barang` `a` left join `m_cabang` `b` on((`b`.`cabang_id` = `a`.`m_cabang_id`))) left join `m_gudang` `c` on((`c`.`gudang_id` = `a`.`m_gudang_id_permintaan`))) left join `m_gudang` `d` on((`d`.`gudang_id` = `a`.`m_gudang_id_tujuan`))) left join `m_departemen` `e` on((`e`.`departemen_id` = `a`.`m_departemen_id`))) left join `s_keluar_barangstatus` `f` on((`f`.`keluar_barangstatus_id` = `a`.`keluar_barang_status`))));

-- --------------------------------------------------------

--
-- Structure for view `v_ketidaksesuaian_spesifikasi`
--
DROP TABLE IF EXISTS `v_ketidaksesuaian_spesifikasi`;

CREATE ALGORITHM=UNDEFINED DEFINER=`jasaprog_tangs`@`localhost` SQL SECURITY DEFINER VIEW `v_ketidaksesuaian_spesifikasi` AS (select `a`.`ketidaksesuaian_spesifikasi_id` AS `ketidaksesuaian_spesifikasi_id`,`a`.`ketidaksesuaian_spesifikasi_nomor` AS `ketidaksesuaian_spesifikasi_nomor`,`a`.`ketidaksesuaian_spesifikasi_tanggal` AS `ketidaksesuaian_spesifikasi_tanggal`,`b`.`cabang_id` AS `cabang_id`,`b`.`cabang_nama` AS `cabang_nama`,`c`.`perolehan_produksi_id` AS `perolehan_produksi_id`,`c`.`perolehan_produksi_nomor` AS `perolehan_produksi_nomor`,`a`.`ketidaksesuaian_spesifikasi_created_date` AS `ketidaksesuaian_spesifikasi_created_date`,`a`.`ketidaksesuaian_spesifikasi_created_by` AS `ketidaksesuaian_spesifikasi_created_by`,`a`.`ketidaksesuaian_spesifikasi_update_date` AS `ketidaksesuaian_spesifikasi_update_date`,`a`.`ketidaksesuaian_spesifikasi_update_by` AS `ketidaksesuaian_spesifikasi_update_by`,`a`.`ketidaksesuaian_spesifikasi_revised` AS `ketidaksesuaian_spesifikasi_revised` from ((`t_ketidaksesuaian_spesifikasi` `a` join `m_cabang` `b` on((`b`.`cabang_id` = `a`.`m_cabang_id`))) join `t_perolehan_produksi` `c` on((`c`.`perolehan_produksi_id` = `a`.`t_jadwal_produksi_id`))));

-- --------------------------------------------------------

--
-- Structure for view `v_konsinyasi`
--
DROP TABLE IF EXISTS `v_konsinyasi`;

CREATE ALGORITHM=UNDEFINED DEFINER=`jasaprog_tangs`@`localhost` SQL SECURITY DEFINER VIEW `v_konsinyasi` AS select `m_konsinyasi`.`konsinyasi_id` AS `konsinyasi_id`,`m_konsinyasi`.`m_jenis_barang_id` AS `m_jenis_barang_id`,`m_jenis_barang`.`jenis_barang_nama` AS `jenis_barang_nama`,`m_konsinyasi`.`m_category_2_id` AS `m_category_2_id`,`m_category_2`.`category_2_nama` AS `category_2_nama`,`m_konsinyasi`.`m_barang_id` AS `m_barang_id`,`m_barang`.`barang_nama` AS `barang_nama`,`m_konsinyasi`.`konsinyasi_status_aktif` AS `konsinyasi_status_aktif`,`m_konsinyasi`.`konsinyasi_create_date` AS `konsinyasi_create_date`,`m_konsinyasi`.`konsinyasi_create_by` AS `konsinyasi_create_by`,`m_konsinyasi`.`konsinyasi_update_date` AS `konsinyasi_update_date`,`m_konsinyasi`.`konsinyasi_update_by` AS `konsinyasi_update_by`,`m_konsinyasi`.`konsinyasi_revised` AS `konsinyasi_revised` from (((`m_konsinyasi` join `m_jenis_barang` on((`m_konsinyasi`.`m_jenis_barang_id` = `m_jenis_barang`.`jenis_barang_id`))) join `m_category_2` on((`m_konsinyasi`.`m_category_2_id` = `m_category_2`.`category_2_id`))) join `m_barang` on((`m_konsinyasi`.`m_barang_id` = `m_barang`.`barang_id`)));

-- --------------------------------------------------------

--
-- Structure for view `v_laporan_spp_belum_realisasi`
--
DROP TABLE IF EXISTS `v_laporan_spp_belum_realisasi`;

CREATE ALGORITHM=UNDEFINED DEFINER=`jasaprog_tangs`@`localhost` SQL SECURITY DEFINER VIEW `v_laporan_spp_belum_realisasi` AS (select `e`.`cabang_id` AS `cabang_id`,`e`.`cabang_nama` AS `cabang_nama`,`f`.`gudang_id` AS `gudang_id`,`f`.`gudang_nama` AS `gudang_nama`,`a`.`permintaan_pembelian_nomor` AS `permintaan_pembelian_nomor`,`a`.`permintaan_pembelian_tanggal` AS `permintaan_pembelian_tanggal`,`c`.`barang_kode` AS `barang_kode`,`c`.`barang_nama` AS `barang_nama`,`b`.`permintaan_pembeliandet_qty` AS `permintaan_pembelian_qty`,`d`.`satuan_nama` AS `satuan_nama`,`a`.`permintaan_pembelian_alasan` AS `permintaan_pembelian_alasan` from (((((`t_permintaan_pembelian` `a` join `t_permintaan_pembeliandet` `b` on((`b`.`t_permintaan_pembelian_id` = `a`.`permintaan_pembelian_id`))) join `m_barang` `c` on((`c`.`barang_id` = `b`.`m_barang_id`))) join `m_satuan` `d` on((`d`.`satuan_id` = `c`.`m_satuan_id`))) join `m_cabang` `e` on((`e`.`cabang_id` = `a`.`m_cabang_id`))) join `m_gudang` `f` on((`f`.`gudang_id` = `a`.`m_gudang_id_permintaan`))) where (`a`.`permintaan_pembelian_status` < 3));

-- --------------------------------------------------------

--
-- Structure for view `v_mutasi_bankkas`
--
DROP TABLE IF EXISTS `v_mutasi_bankkas`;

CREATE ALGORITHM=UNDEFINED DEFINER=`jasaprog_tangs`@`localhost` SQL SECURITY DEFINER VIEW `v_mutasi_bankkas` AS (select `a`.`mutasi_bankkas_id` AS `mutasi_bankkas_id`,`a`.`mutasi_bankkas_nomor` AS `mutasi_bankkas_nomor`,`a`.`mutasi_bankkas_tanggal` AS `mutasi_bankkas_tanggal`,`a`.`mutasi_bankkas_tipe` AS `mutasi_bankkas_tipe`,if((`a`.`mutasi_bankkas_tipe` = 1),'Mutasi Bank ke Kas',if((`a`.`mutasi_bankkas_tipe` = 2),'Mutasi Bank ke Kas','Mutasi Bank ke Bank')) AS `mutasi_bankkas_tipe_nama`,if((`a`.`mutasi_bankkas_tipe` = 1),`b`.`bank_nama`,if((`a`.`mutasi_bankkas_tipe` = 2),`d`.`kas_nama`,`b`.`bank_nama`)) AS `mutasi_bankkas_dari`,if((`a`.`mutasi_bankkas_tipe` = 1),`h`.`kas_nama`,if((`a`.`mutasi_bankkas_tipe` = 2),`f`.`bank_nama`,`f`.`bank_nama`)) AS `mutasi_bankkas_ke`,if((`a`.`mutasi_bankkas_tipe` = 1),`c`.`cabang_id`,`e`.`cabang_id`) AS `cabang_id`,if((`a`.`mutasi_bankkas_tipe` = 1),`c`.`cabang_nama`,`e`.`cabang_nama`) AS `cabang_nama`,`a`.`mutasi_bankkas_nominal` AS `mutasi_bankkas_nominal` from ((((((((`t_mutasi_bankkas` `a` left join `m_bank` `b` on((`b`.`bank_id` = `a`.`mutasi_bankkas_refrensi_id1`))) left join `m_cabang` `c` on((`c`.`cabang_id` = `b`.`m_cabang_id`))) left join `m_kas` `d` on((`d`.`kas_id` = `a`.`mutasi_bankkas_refrensi_id2`))) left join `m_cabang` `e` on((`e`.`cabang_id` = `d`.`m_cabang_id`))) left join `m_bank` `f` on((`f`.`bank_id` = `a`.`mutasi_bankkas_refrensi_id2`))) left join `m_cabang` `g` on((`g`.`cabang_id` = `f`.`m_cabang_id`))) left join `m_kas` `h` on((`h`.`kas_id` = `a`.`mutasi_bankkas_refrensi_id2`))) left join `m_cabang` `i` on((`i`.`cabang_id` = `h`.`m_cabang_id`))));

-- --------------------------------------------------------

--
-- Structure for view `v_nota_debet`
--
DROP TABLE IF EXISTS `v_nota_debet`;

CREATE ALGORITHM=UNDEFINED DEFINER=`jasaprog_tangs`@`localhost` SQL SECURITY DEFINER VIEW `v_nota_debet` AS (select `a`.`nota_debet_id` AS `nota_debet_id`,`a`.`nota_debet_nomor` AS `nota_debet_nomor`,`a`.`nota_debet_tanggal` AS `nota_debet_tanggal`,`e`.`retur_pembelian_id` AS `retur_pembelian_id`,`e`.`retur_pembelian_nomor` AS `retur_pembelian_nomor`,`e`.`retur_pembelian_tanggal` AS `retur_pembelian_tanggal`,`b`.`cabang_id` AS `cabang_id`,`b`.`cabang_nama` AS `cabang_nama`,`c`.`partner_id` AS `partner_id`,`c`.`partner_nama` AS `partner_nama`,`d`.`gudang_id` AS `gudang_id`,`d`.`gudang_nama` AS `gudang_nama`,`a`.`nota_debet_subtotal` AS `nota_debet_subtotal`,`a`.`nota_debet_ppn` AS `nota_debet_ppn`,`a`.`nota_debet_total` AS `nota_debet_total`,`a`.`nota_debet_catatan` AS `nota_debet_catatan`,`a`.`nota_debet_metode_pembayaran` AS `nota_debet_metode_pembayaran`,`a`.`nota_debet_status` AS `nota_debet_status`,if((`a`.`nota_debet_status` = 1),'Nota Debet Baru',if((`a`.`nota_debet_status` = 2),'Nota Debet Diterima','Nota Debet Disetujui')) AS `nota_debet_status_nama`,`a`.`nota_debet_status_date` AS `nota_debet_status_date`,`a`.`nota_debet_printed` AS `nota_debet_printed`,`a`.`nota_debet_created_date` AS `nota_debet_created_date`,`a`.`nota_debet_created_by` AS `nota_debet_created_by`,`a`.`nota_debet_update_date` AS `nota_debet_update_date`,`a`.`nota_debet_update_by` AS `nota_debet_update_by`,`a`.`nota_debet_revised` AS `nota_debet_revised` from ((((`t_nota_debet` `a` join `m_cabang` `b` on((`b`.`cabang_id` = `a`.`m_cabang_id`))) join `m_partner` `c` on((`c`.`partner_id` = `a`.`m_partner_id`))) join `m_gudang` `d` on((`d`.`gudang_id` = `a`.`m_gudang_id`))) join `t_retur_pembelian` `e` on((`e`.`retur_pembelian_id` = `a`.`t_retur_pembelian_id`))));

-- --------------------------------------------------------

--
-- Structure for view `v_nota_kredit`
--
DROP TABLE IF EXISTS `v_nota_kredit`;

CREATE ALGORITHM=UNDEFINED DEFINER=`jasaprog_tangs`@`localhost` SQL SECURITY DEFINER VIEW `v_nota_kredit` AS (select `a`.`nota_kredit_id` AS `nota_kredit_id`,`a`.`nota_kredit_nomor` AS `nota_kredit_nomor`,`b`.`cabang_id` AS `cabang_id`,`b`.`cabang_nama` AS `cabang_nama`,`a`.`nota_kredit_tanggal` AS `nota_kredit_tanggal`,`a`.`nota_kredit_jenis` AS `nota_kredit_jenis`,if((`a`.`nota_kredit_jenis` = 0),`c`.`sj_retur_nomor`,`d`.`bpbr_nomor`) AS `nomor_refrensi`,`c`.`sj_retur_id` AS `sj_retur_id`,`c`.`sj_retur_nomor` AS `sj_retur_nomor`,`a`.`nota_kredit_netto` AS `nota_kredit_netto`,`a`.`nota_kredit_potongan_harga` AS `nota_kredit_potongan_harga`,`a`.`nota_kredit_uang_muka` AS `nota_kredit_uang_muka`,`a`.`nota_kredit_ppn` AS `nota_kredit_ppn`,`a`.`nota_kredit_total` AS `nota_kredit_total`,`a`.`nota_kredit_catatan` AS `nota_kredit_catatan` from (((`t_nota_kredit` `a` join `m_cabang` `b` on((`b`.`cabang_id` = `a`.`m_cabang_id`))) left join `t_sj_retur` `c` on((`c`.`sj_retur_id` = `a`.`referensi_id`))) left join `t_bpbr` `d` on((`d`.`bpbr_id` = `a`.`referensi_id`))));

-- --------------------------------------------------------

--
-- Structure for view `v_order`
--
DROP TABLE IF EXISTS `v_order`;

CREATE ALGORITHM=UNDEFINED DEFINER=`jasaprog_tangs`@`localhost` SQL SECURITY DEFINER VIEW `v_order` AS (select `a`.`order_id` AS `order_id`,`a`.`order_nomor` AS `order_nomor`,`a`.`order_type` AS `order_type`,if((`a`.`order_type` = 0),'PO','WO') AS `order_jenis_nama`,`a`.`order_tanggal` AS `order_tanggal`,`b`.`cabang_id` AS `cabang_id`,`b`.`cabang_nama` AS `cabang_nama`,`c`.`penawaran_id` AS `penawaran_id`,`c`.`penawaran_nomor` AS `penawaran_nomor`,`d`.`partner_id` AS `partner_id`,`d`.`partner_nama` AS `partner_nama`,`a`.`order_nama_dikirim` AS `order_nama_dikirim`,`a`.`order_alamat_dikirim` AS `order_alamat_dikirim`,`a`.`order_hp_fax` AS `order_hp_fax`,`a`.`order_subtotal` AS `order_subtotal`,`a`.`order_ppn` AS `order_ppn`,`a`.`order_total` AS `order_total`,`a`.`order_tanggal_kirim` AS `order_tanggal_kirim`,`a`.`order_pembayaran` AS `order_pembayaran`,if((`a`.`order_pembayaran` = 1),'Tunai','Kredit') AS `order_pembayaran_nama`,`a`.`order_status` AS `order_status`,if((`a`.`order_type` = 0),if((`a`.`order_status` = 1),'PO Baru',if((`a`.`order_status` = 2),'PO Diterima ',if((`a`.`order_status` = 3),'PO Disetujui',if((`a`.`order_status` = 4),'PO Berjalan',if((`a`.`order_status` = 5),'PO Selesai',if((`a`.`order_status` = -(1)),'PO Tidak Disetujui','PO Edited')))))),if((`a`.`order_status` = 1),'WO Baru',if((`a`.`order_status` = 2),'WO Diterima ',if((`a`.`order_status` = 3),'WO Disetujui',if((`a`.`order_status` = 4),'WO Berjalan',if((`a`.`order_status` = 5),'WO Selesai',if((`a`.`order_status` = -(1)),'WO Tidak Disetujui','WO Edited'))))))) AS `order_status_nama`,`a`.`order_status_date` AS `order_status_date`,`a`.`order_printed` AS `order_printed`,`a`.`order_created_date` AS `order_created_date`,`a`.`order_created_by` AS `order_created_by`,`a`.`order_update_date` AS `order_update_date`,`a`.`order_update_by` AS `order_update_by`,`a`.`order_revised` AS `order_revised` from (((`t_order` `a` join `m_cabang` `b` on((`b`.`cabang_id` = `a`.`m_cabang_id`))) join `t_penawaran` `c` on((`c`.`penawaran_id` = `a`.`order_referensi_id`))) join `m_partner` `d` on((`d`.`partner_id` = `a`.`m_supplier_id`))));

-- --------------------------------------------------------

--
-- Structure for view `v_payment_request`
--
DROP TABLE IF EXISTS `v_payment_request`;

CREATE ALGORITHM=UNDEFINED DEFINER=`jasaprog_tangs`@`localhost` SQL SECURITY DEFINER VIEW `v_payment_request` AS (select `a`.`payment_request_id` AS `payment_request_id`,`b`.`cabang_id` AS `cabang_id`,`b`.`cabang_nama` AS `cabang_nama`,`a`.`payment_request_nomor` AS `payment_request_nomor`,`a`.`payment_request_tanggal` AS `payment_request_tanggal`,`a`.`payment_request_lampiran` AS `payment_request_lampiran`,`c`.`partner_id` AS `partner_id`,`c`.`partner_nama` AS `partner_nama`,`a`.`payment_request_keperluan` AS `payment_request_keperluan`,`a`.`payment_request_voucher` AS `payment_request_voucher`,`a`.`payment_request_discount` AS `payment_request_discount`,`a`.`payment_request_jumlah_bayar` AS `payment_request_jumlah_bayar`,`a`.`payment_request_tipe_pengeluaran` AS `payment_request_tipe_pengeluaran`,if((`a`.`payment_request_tipe_pengeluaran` = 1),'Bank',if((`a`.`payment_request_tipe_pengeluaran` = 2),'Kas','Giro')) AS `payment_request_tipe_pengeluaran_nama`,`a`.`pengeluaran_id` AS `pengeluaran_id`,if((`a`.`payment_request_tipe_pengeluaran` = 1),`d`.`bank_nama`,`e`.`kas_nama`) AS `payment_request_pengeluaran_nama`,`a`.`payment_request_status` AS `payment_request_status`,if((`a`.`payment_request_status` = 1),'Payment Request Baru',if((`a`.`payment_request_status` = 2),'Payment Request Disetujui','Payment Request Tidak Disetujui')) AS `payment_request_status_nama`,`a`.`payment_request_created_date` AS `payment_request_created_date`,`a`.`payment_request_created_by` AS `payment_request_created_by`,`a`.`payment_request_updated_date` AS `payment_request_updated_date`,`a`.`payment_request_updated_by` AS `payment_request_updated_by`,`a`.`payment_request_revised` AS `payment_request_revised` from ((((`t_payment_request` `a` join `m_cabang` `b` on((`b`.`cabang_id` = `a`.`m_cabang_id`))) join `m_partner` `c` on((`c`.`partner_id` = `a`.`m_partner_id`))) left join `m_bank` `d` on((`d`.`bank_id` = `a`.`pengeluaran_id`))) left join `m_kas` `e` on((`e`.`kas_id` = `a`.`pengeluaran_id`))));

-- --------------------------------------------------------

--
-- Structure for view `v_payment_request_piutang`
--
DROP TABLE IF EXISTS `v_payment_request_piutang`;

CREATE ALGORITHM=UNDEFINED DEFINER=`jasaprog_tangs`@`localhost` SQL SECURITY DEFINER VIEW `v_payment_request_piutang` AS (select `a`.`payment_request_piutang_id` AS `payment_request_piutang_id`,`b`.`cabang_id` AS `cabang_id`,`b`.`cabang_nama` AS `cabang_nama`,`a`.`payment_request_piutang_nomor` AS `payment_request_piutang_nomor`,`a`.`payment_request_piutang_tanggal` AS `payment_request_piutang_tanggal`,`a`.`payment_request_piutang_lampiran` AS `payment_request_piutang_lampiran`,`c`.`partner_id` AS `partner_id`,`c`.`partner_nama` AS `partner_nama`,`a`.`payment_request_piutang_keperluan` AS `payment_request_piutang_keperluan`,`a`.`payment_request_piutang_voucher` AS `payment_request_piutang_voucher`,`a`.`payment_request_piutang_discount` AS `payment_request_piutang_discount`,`a`.`payment_request_piutang_jumlah_bayar` AS `payment_request_piutang_jumlah_bayar`,`a`.`payment_request_piutang_tipe_pemasukkan` AS `payment_request_piutang_tipe_pemasukkan`,if((`a`.`payment_request_piutang_tipe_pemasukkan` = 1),'Bank',if((`a`.`payment_request_piutang_tipe_pemasukkan` = 2),'Kas','Giro')) AS `payment_request_piutang_tipe_pemasukkan_nama`,`a`.`pemasukkan_id` AS `pemasukkan_id`,if((`a`.`payment_request_piutang_tipe_pemasukkan` = 1),`d`.`bank_nama`,`e`.`kas_nama`) AS `payment_request_piutang_pemasukkan_nama`,`a`.`payment_request_piutang_status` AS `payment_request_piutang_status`,if((`a`.`payment_request_piutang_status` = 1),'Pelunasan Piutang Baru',if((`a`.`payment_request_piutang_status` = 2),'Pelunasan Piutang Disetujui','Pelunasan Piutang Tidak Disetujui')) AS `payment_request_piutang_status_nama`,`a`.`payment_request_piutang_created_date` AS `payment_request_piutang_created_date`,`a`.`payment_request_piutang_created_by` AS `payment_request_piutang_created_by`,`a`.`payment_request_piutang_updated_date` AS `payment_request_piutang_updated_date`,`a`.`payment_request_piutang_updated_by` AS `payment_request_piutang_updated_by`,`a`.`payment_request_piutang_revised` AS `payment_request_piutang_revised` from ((((`t_payment_request_piutang` `a` join `m_cabang` `b` on((`b`.`cabang_id` = `a`.`m_cabang_id`))) join `m_partner` `c` on((`c`.`partner_id` = `a`.`m_partner_id`))) left join `m_bank` `d` on((`d`.`bank_id` = `a`.`pemasukkan_id`))) left join `m_kas` `e` on((`e`.`kas_id` = `a`.`pemasukkan_id`))));

-- --------------------------------------------------------

--
-- Structure for view `v_penawaran`
--
DROP TABLE IF EXISTS `v_penawaran`;

CREATE ALGORITHM=UNDEFINED DEFINER=`jasaprog_tangs`@`localhost` SQL SECURITY DEFINER VIEW `v_penawaran` AS (select `a`.`penawaran_id` AS `penawaran_id`,`a`.`penawaran_nomor` AS `penawaran_nomor`,`a`.`penawaran_jenis` AS `penawaran_jenis`,if((`a`.`penawaran_jenis` = 1),'Pembelian','Maklon') AS `penawaran_jenis_nama`,`a`.`penawaran_tanggal` AS `penawaran_tanggal`,`b`.`cabang_id` AS `cabang_id`,`b`.`cabang_nama` AS `cabang_nama`,`a`.`penawaran_step` AS `penawaran_step`,`a`.`penawaran_status` AS `penawaran_status`,if((`a`.`penawaran_status` = 1),'Penawaran Baru',if((`a`.`penawaran_status` = 2),'Pemilihan Supplier',if((`a`.`penawaran_status` = 3),'Pengisian Harga',if((`a`.`penawaran_status` = 4),'Penawaran Selesai','Penawaran Dibatalkan')))) AS `penawaran_status_nama`,`a`.`penawaran_status_date` AS `penawaran_status_date`,`a`.`penawaran_printed` AS `penawaran_printed`,`a`.`penawaran_create_date` AS `penawaran_create_date`,`a`.`penawaran_create_by` AS `penawaran_create_by`,`a`.`penawaran_update_date` AS `penawaran_update_date`,`a`.`penawaran_update_by` AS `penawaran_update_by`,`a`.`penawaran_revised` AS `penawaran_revised` from (`t_penawaran` `a` join `m_cabang` `b` on((`b`.`cabang_id` = `a`.`m_cabang_id`))));

-- --------------------------------------------------------

--
-- Structure for view `v_penerimaan_barang`
--
DROP TABLE IF EXISTS `v_penerimaan_barang`;

CREATE ALGORITHM=UNDEFINED DEFINER=`jasaprog_tangs`@`localhost` SQL SECURITY DEFINER VIEW `v_penerimaan_barang` AS (select `a`.`penerimaan_barang_id` AS `penerimaan_barang_id`,`a`.`penerimaan_barang_nomor` AS `penerimaan_barang_nomor`,`a`.`penerimaan_barang_tanggal` AS `penerimaan_barang_tanggal`,`b`.`cabang_id` AS `cabang_id`,`b`.`cabang_nama` AS `cabang_nama`,`c`.`order_id` AS `order_id`,`c`.`order_nomor` AS `order_nomor`,`a`.`penerimaan_barang_tanggal_terima` AS `penerimaan_barang_tanggal_terima`,`a`.`penerimaan_barang_status` AS `penerimaan_barang_status`,if((`a`.`penerimaan_barang_status` = 1),'BPB Baru',if((`a`.`penerimaan_barang_status` = 2),'BPB Berjalan','BPB Selesai')) AS `penerimaan_barang_status_nama`,`a`.`penerimaan_barang_status_date` AS `penerimaan_barang_status_date`,`a`.`penerimaan_barang_printed` AS `penerimaan_barang_printed`,`a`.`penerimaan_barang_created_date` AS `penerimaan_barang_created_date`,`a`.`penerimaan_barang_created_by` AS `penerimaan_barang_created_by`,`a`.`penerimaan_barang_update_date` AS `penerimaan_barang_update_date`,`a`.`penerimaan_barang_update_by` AS `penerimaan_barang_update_by`,`a`.`penerimaan_barang_revised` AS `penerimaan_barang_revised` from ((`t_penerimaan_barang` `a` join `m_cabang` `b` on((`b`.`cabang_id` = `a`.`m_cabang_id`))) join `t_order` `c` on((`c`.`order_id` = `a`.`t_order_id`))));

-- --------------------------------------------------------

--
-- Structure for view `v_penerimaan_barang_retur`
--
DROP TABLE IF EXISTS `v_penerimaan_barang_retur`;

CREATE ALGORITHM=UNDEFINED DEFINER=`jasaprog_tangs`@`localhost` SQL SECURITY DEFINER VIEW `v_penerimaan_barang_retur` AS (select `a`.`bpbr_id` AS `bpbr_id`,`a`.`bpbr_nomor` AS `bpbr_nomor`,`b`.`cabang_id` AS `cabang_id`,`b`.`cabang_nama` AS `cabang_nama`,`a`.`bpbr_tanggal` AS `bpbr_tanggal`,`c`.`retur_penjualan_id` AS `retur_penjualan_id`,`c`.`retur_penjualan_nomor` AS `retur_penjualan_nomor`,`a`.`bpbr_pengecekan` AS `bpbr_pengecekan`,`a`.`bpbr_catatan` AS `bpbr_catatan` from ((`t_bpbr` `a` join `m_cabang` `b` on((`b`.`cabang_id` = `a`.`m_cabang_id`))) left join `t_retur_penjualan` `c` on((`c`.`retur_penjualan_id` = `a`.`t_retur_penjualan_id`))));

-- --------------------------------------------------------

--
-- Structure for view `v_pengeluaran_kaskecil`
--
DROP TABLE IF EXISTS `v_pengeluaran_kaskecil`;

CREATE ALGORITHM=UNDEFINED DEFINER=`jasaprog_tangs`@`localhost` SQL SECURITY DEFINER VIEW `v_pengeluaran_kaskecil` AS (select `a`.`pengeluaran_kaskecil_id` AS `pengeluaran_kaskecil_id`,`a`.`pengeluaran_kaskecil_nomor` AS `pengeluaran_kaskecil_nomor`,`a`.`pengeluaran_kaskecil_tanggal` AS `pengeluaran_kaskecil_tanggal`,`b`.`kas_id` AS `kas_id`,`b`.`kas_nama` AS `kas_nama`,`a`.`pengeluaran_kaskecil_total` AS `pengeluaran_kaskecil_total` from ((`t_pengeluaran_kaskecil` `a` left join `m_kas` `b` on((`b`.`kas_id` = `a`.`m_kas_id`))) left join `m_cabang` `c` on((`c`.`cabang_id` = `b`.`m_cabang_id`))));

-- --------------------------------------------------------

--
-- Structure for view `v_pengembalian_barang`
--
DROP TABLE IF EXISTS `v_pengembalian_barang`;

CREATE ALGORITHM=UNDEFINED DEFINER=`jasaprog_tangs`@`localhost` SQL SECURITY DEFINER VIEW `v_pengembalian_barang` AS select `a`.`pengembalian_barang_id` AS `pengembalian_barang_id`,`a`.`pengembalian_barang_nomor` AS `pengembalian_barang_nomor`,`a`.`pengembalian_barang_awal` AS `pengembalian_barang_awal`,`a`.`pengembalian_barang_tujuan` AS `pengembalian_barang_tujuan`,`a`.`pengembalian_barang_status` AS `pengembalian_barang_status`,if((`a`.`pengembalian_barang_status` = '1'),'Pengembalian Barang Baru','Pengembalian Barang Diterima') AS `pengembalian_barang_status_nama`,`a`.`pengembalian_barang_created_date` AS `pengembalian_barang_created_date`,`a`.`pengembalian_barang_created_by` AS `pengembalian_barang_created_by`,`a`.`pengembalian_barang_update_date` AS `pengembalian_barang_update_date`,`a`.`pengembalian_barang_update_by` AS `pengembalian_barang_update_by`,`a`.`pengembalian_barang_revised` AS `pengembalian_barang_revised`,`b`.`cabang_id` AS `cabang_id`,`b`.`cabang_nama` AS `cabang_nama` from (`t_pengembalian_barang` `a` join `m_cabang` `b` on((`b`.`cabang_id` = `a`.`m_cabang_id`)));

-- --------------------------------------------------------

--
-- Structure for view `v_pengubahan_bahan`
--
DROP TABLE IF EXISTS `v_pengubahan_bahan`;

CREATE ALGORITHM=UNDEFINED DEFINER=`jasaprog_tangs`@`localhost` SQL SECURITY DEFINER VIEW `v_pengubahan_bahan` AS select `a`.`pengubahan_bahan_id` AS `pengubahan_bahan_id`,`a`.`pengubahan_bahan_nomor` AS `pengubahan_bahan_nomor`,`a`.`pengubahan_bahan_tanggal` AS `pengubahan_bahan_tanggal`,`a`.`pengubahan_bahan_status` AS `pengubahan_bahan_status`,if((`a`.`pengubahan_bahan_status` = '1'),'Pengubahan Bahan Baru',if((`a`.`pengubahan_bahan_status` = '2'),'Pengubahan Bahan Diverifikasi',if((`a`.`pengubahan_bahan_status` = '3'),'Pengubahan Bahan Diterima','Pengubahan Bahan Disetujui'))) AS `pengubahan_bahan_status_nama`,`a`.`pengubahan_bahan_created_date` AS `pengubahan_bahan_created_date`,`a`.`pengubahan_bahan_created_by` AS `pengubahan_bahan_created_by`,`a`.`pengubahan_bahan_update_date` AS `pengubahan_bahan_update_date`,`a`.`pengubahan_bahan_update_by` AS `pengubahan_bahan_update_by`,`a`.`pengubahan_bahan_revised` AS `pengubahan_bahan_revised`,`b`.`cabang_id` AS `cabang_id`,`b`.`cabang_nama` AS `cabang_nama` from (`t_pengubahan_bahan` `a` join `m_cabang` `b` on((`b`.`cabang_id` = `a`.`m_cabang_id`)));

-- --------------------------------------------------------

--
-- Structure for view `v_perhitungan_kebutuhan`
--
DROP TABLE IF EXISTS `v_perhitungan_kebutuhan`;

CREATE ALGORITHM=UNDEFINED DEFINER=`jasaprog_tangs`@`localhost` SQL SECURITY DEFINER VIEW `v_perhitungan_kebutuhan` AS (select `a`.`perhitungan_kebutuhan_id` AS `perhitungan_kebutuhan_id`,`a`.`perhitungan_kebutuhan_nomor` AS `perhitungan_kebutuhan_nomor`,`a`.`perhitungan_kebutuhan_tanggal` AS `perhitungan_kebutuhan_tanggal`,`b`.`cabang_id` AS `cabang_id`,`b`.`cabang_nama` AS `cabang_nama`,`c`.`jadwal_produksi_id` AS `jadwal_produksi_id`,`c`.`jadwal_produksi_nomor` AS `jadwal_produksi_nomor`,`a`.`perhitungan_kebutuhan_status` AS `perhitungan_kebutuhan_status`,if((`a`.`perhitungan_kebutuhan_status` = 1),'Perhitungan Kebutuhan Baru',if((`a`.`perhitungan_kebutuhan_status` = 2),'Perhitungan Kebutuhan Diterima','Perhitungan Kebutuhan Direalisasi')) AS `perhitungan_kebutuhan_status_nama`,`a`.`perhitungan_kebutuhan_status_date` AS `perhitungan_kebutuhan_status_date`,`a`.`perhitungan_kebutuhan_created_date` AS `perhitungan_kebutuhan_created_date`,`a`.`perhitungan_kebutuhan_created_by` AS `perhitungan_kebutuhan_created_by`,`a`.`perhitungan_kebutuhan_update_date` AS `perhitungan_kebutuhan_update_date`,`a`.`perhitungan_kebutuhan_update_by` AS `perhitungan_kebutuhan_update_by`,`a`.`perhitungan_kebutuhan_revised` AS `perhitungan_kebutuhan_revised` from ((`t_perhitungan_kebutuhan` `a` join `m_cabang` `b` on((`b`.`cabang_id` = `a`.`m_cabang_id`))) join `t_jadwal_produksi` `c` on((`c`.`jadwal_produksi_id` = `a`.`t_jadwal_produksi_id`))));

-- --------------------------------------------------------

--
-- Structure for view `v_permintaan_jasa`
--
DROP TABLE IF EXISTS `v_permintaan_jasa`;

CREATE ALGORITHM=UNDEFINED DEFINER=`jasaprog_tangs`@`localhost` SQL SECURITY DEFINER VIEW `v_permintaan_jasa` AS (select `a`.`permintaan_jasa_id` AS `permintaan_jasa_id`,`b`.`cabang_id` AS `cabang_id`,`b`.`cabang_nama` AS `cabang_nama`,`a`.`permintaan_jasa_nomor` AS `permintaan_jasa_nomor`,`c`.`departemen_id` AS `departemen_id`,`c`.`departemen_nama` AS `departemen_nama`,`a`.`permintaan_jasa_tanggal` AS `permintaan_jasa_tanggal`,`a`.`permintaan_jasa_tanggal_dibutuhkan` AS `permintaan_jasa_tanggal_dibutuhkan`,`a`.`permintaan_jasa_status` AS `permintaan_jasa_status`,if((`a`.`permintaan_jasa_status` = 1),'PJ Baru',if((`a`.`permintaan_jasa_status` = 2),'PJ Diterima',if((`a`.`permintaan_jasa_status` = 3),'PJ Ditawarkan',if((`a`.`permintaan_jasa_status` = 4),'PJ Disetujui','PJ Selesai')))) AS `permintaan_jasa_status_nama`,`a`.`permintaan_jasa_status_date` AS `permintaan_jasa_status_date`,`a`.`permintaan_jasa_printed` AS `permintaan_jasa_printed`,`a`.`permintaan_jasa_created_date` AS `permintaan_jasa_created_date`,`a`.`permintaan_jasa_created_by` AS `permintaan_jasa_created_by`,`a`.`permintaan_jasa_update_date` AS `permintaan_jasa_update_date`,`a`.`permintaan_jasa_update_by` AS `permintaan_jasa_update_by`,`a`.`permintaan_jasa_revised` AS `permintaan_jasa_revised` from ((`t_permintaan_jasa` `a` left join `m_cabang` `b` on((`b`.`cabang_id` = `a`.`m_cabang_id`))) left join `m_departemen` `c` on((`c`.`departemen_id` = `a`.`m_departemen_id`))));

-- --------------------------------------------------------

--
-- Structure for view `v_permintaan_pembelian`
--
DROP TABLE IF EXISTS `v_permintaan_pembelian`;

CREATE ALGORITHM=UNDEFINED DEFINER=`jasaprog_tangs`@`localhost` SQL SECURITY DEFINER VIEW `v_permintaan_pembelian` AS (select `a`.`permintaan_pembelian_id` AS `permintaan_pembelian_id`,`b`.`cabang_id` AS `cabang_id`,`b`.`cabang_nama` AS `cabang_nama`,`a`.`permintaan_pembelian_nomor` AS `permintaan_pembelian_nomor`,`a`.`permintaan_pembelian_tanggal` AS `permintaan_pembelian_tanggal`,`a`.`permintaan_pembelian_tanggal_dibutuhkan` AS `permintaan_pembelian_tanggal_dibutuhkan`,`a`.`permintaan_pembelian_jenis` AS `permintaan_pembelian_jenis`,if((`a`.`permintaan_pembelian_jenis` = 1),'Penting','Biasa') AS `permintaan_pembelian_jenis_nama`,`c`.`gudang_id` AS `gudang_id_permintaan`,`c`.`gudang_nama` AS `gudang_nama_permintaan`,`a`.`permintaan_pembelian_status` AS `permintaan_pembelian_status`,if((`a`.`permintaan_pembelian_status` = 1),'SPP Baru',if((`a`.`permintaan_pembelian_status` = 2),'SPP Diterima',if((`a`.`permintaan_pembelian_status` = 3),'SPP Ditawarkan',if((`a`.`permintaan_pembelian_status` = 4),'SPP Disetujui',if((`a`.`permintaan_pembelian_status` = 100),'SPP Dibatalkan','SPP Selesai'))))) AS `permintaan_pembelian_status_nama`,`a`.`permintaan_pembelian_status_date` AS `permintaan_pembelian_status_date`,`a`.`permintaan_pembelian_penerima` AS `permintaan_pembelian_penerima`,`a`.`permintaan_pembelian_penyetuju` AS `permintaan_pembelian_penyetuju`,`a`.`permintaan_pembelian_pembuat` AS `permintaan_pembelian_pembuat`,`a`.`permintaan_pembelian_printed` AS `permintaan_pembelian_printed`,`a`.`permintaan_pembelian_created_date` AS `permintaan_pembelian_created_date`,`a`.`permintaan_pembelian_created_by` AS `permintaan_pembelian_created_by`,`a`.`permintaan_pembelian_update_date` AS `permintaan_pembelian_update_date`,`a`.`permintaan_pembelian_update_by` AS `permintaan_pembelian_update_by`,`a`.`permintaan_pembelian_revised` AS `permintaan_pembelian_revised` from ((`t_permintaan_pembelian` `a` left join `m_cabang` `b` on((`b`.`cabang_id` = `a`.`m_cabang_id`))) left join `m_gudang` `c` on((`c`.`gudang_id` = `a`.`m_gudang_id_permintaan`))));

-- --------------------------------------------------------

--
-- Structure for view `v_perolehan_produksi`
--
DROP TABLE IF EXISTS `v_perolehan_produksi`;

CREATE ALGORITHM=UNDEFINED DEFINER=`jasaprog_tangs`@`localhost` SQL SECURITY DEFINER VIEW `v_perolehan_produksi` AS select `a`.`perolehan_produksi_id` AS `perolehan_produksi_id`,`a`.`perolehan_produksi_nomor` AS `perolehan_produksi_nomor`,`a`.`perolehan_produksi_total` AS `perolehan_produksi_total`,`a`.`perolehan_produksi_afalan` AS `perolehan_produksi_afalan`,`a`.`perolehan_produksi_created_date` AS `perolehan_produksi_created_date`,`a`.`perolehan_produksi_created_by` AS `perolehan_produksi_created_by`,`a`.`perolehan_produksi_update_date` AS `perolehan_produksi_update_date`,`a`.`perolehan_produksi_update_by` AS `perolehan_produksi_update_by`,`a`.`perolehan_produksi_revised` AS `perolehan_produksi_revised`,`b`.`cabang_id` AS `cabang_id`,`b`.`cabang_nama` AS `cabang_nama`,`c`.`gudang_id` AS `gudang_id`,`c`.`gudang_nama` AS `gudang_nama` from ((`t_perolehan_produksi` `a` join `m_cabang` `b` on((`b`.`cabang_id` = `a`.`m_cabang_id`))) left join `m_gudang` `c` on((`c`.`gudang_id` = `a`.`m_gudang_id`)));

-- --------------------------------------------------------

--
-- Structure for view `v_po_customer`
--
DROP TABLE IF EXISTS `v_po_customer`;

CREATE ALGORITHM=UNDEFINED DEFINER=`jasaprog_tangs`@`localhost` SQL SECURITY DEFINER VIEW `v_po_customer` AS (select `a`.`po_customer_id` AS `po_customer_id`,`b`.`cabang_id` AS `cabang_id`,`b`.`cabang_nama` AS `cabang_nama`,`a`.`po_customer_nomor` AS `po_customer_nomor`,`a`.`po_customer_tanggal` AS `po_customer_tanggal`,`c`.`partner_id` AS `partner_id`,`c`.`partner_nama` AS `partner_nama`,`a`.`po_customer_kontak_person` AS `po_customer_kontak_person`,`a`.`po_customer_nama_pelanggan` AS `po_customer_nama_pelanggan`,`a`.`po_customer_perjanjian_bayar` AS `po_customer_perjanjian_bayar`,`a`.`po_customer_jasaangkut_jenis` AS `po_customer_jasaangkut_jenis`,if((`a`.`po_customer_jasaangkut_jenis` = 1),'Ekspedisi','Kirim Sendiri') AS `po_customer_jasaangkut_jenis_nama`,`a`.`po_customer_ekspedisi` AS `po_customer_ekspedisi`,`a`.`po_customer_jasaangkut_bayar` AS `po_customer_jasaangkut_bayar`,if((`a`.`po_customer_jasaangkut_bayar` = 1),'Bayar Kantor','Bayar Toko') AS `po_customer_jasaangkut_bayar_nama`,`a`.`po_customer_catatan` AS `po_customer_catatan`,`a`.`po_customer_step` AS `po_customer_step`,`a`.`po_customer_status` AS `po_customer_status`,if((`a`.`po_customer_status` = 1),'Draft PO',if((`a`.`po_customer_status` = 2),'Cek Stok Barang',if((`a`.`po_customer_status` = 3),'Cek Kredit Limit',if((`a`.`po_customer_status` = 4),'Menunggu Persetujuan',if((`a`.`po_customer_status` = 5),'PO Diterima',if((`a`.`po_customer_status` = 6),'Terbit SO','PO Tidak Diterima')))))) AS `po_customer_status_nama_old`,if((`a`.`po_customer_status` = 1),'PO Pending',if((`a`.`po_customer_status` = 2),'PO Pending',if((`a`.`po_customer_status` = 3),'PO Pending',if((`a`.`po_customer_status` = 4),'PO Pending',if((`a`.`po_customer_status` = 5),'PO Disetujui',if((`a`.`po_customer_status` = 6),'PO Disetujui',if((`a`.`po_customer_status` = 7),'PO Cancel',if((`a`.`po_customer_status` = 8),'PO Cancel Kredit Limit','PO Revisi')))))))) AS `po_customer_status_nama_lama`,if((`a`.`po_customer_status` = 1),'Draft PO',if((`a`.`po_customer_status` = 2),'Cek Stok Barang',if((`a`.`po_customer_status` = 3),'Cek Kredit Limit',if((`a`.`po_customer_status` = 4),'Menunggu Persetujuan',if((`a`.`po_customer_status` = 5),'PO Direvisi',if((`a`.`po_customer_status` = 6),'PO sesuai',if((`a`.`po_customer_status` = 7),'PO Pending',if((`a`.`po_customer_status` = 8),'PO dicancel (Manajer)',if((`a`.`po_customer_status` = 9),'PO disetujui (Manajer)',if((`a`.`po_customer_status` = 10),'PO disetujui (Admin)','Terbit SO')))))))))) AS `po_customer_status_nama` from ((`t_po_customer` `a` join `m_cabang` `b` on((`b`.`cabang_id` = `a`.`m_cabang_id`))) join `m_partner` `c` on((`c`.`partner_id` = `a`.`m_partner_id`))));

-- --------------------------------------------------------

--
-- Structure for view `v_retur_pembelian`
--
DROP TABLE IF EXISTS `v_retur_pembelian`;

CREATE ALGORITHM=UNDEFINED DEFINER=`jasaprog_tangs`@`localhost` SQL SECURITY DEFINER VIEW `v_retur_pembelian` AS (select `a`.`retur_pembelian_id` AS `retur_pembelian_id`,`a`.`retur_pembelian_nomor` AS `retur_pembelian_nomor`,`a`.`retur_pembelian_tanggal` AS `retur_pembelian_tanggal`,`b`.`cabang_id` AS `cabang_id`,`b`.`cabang_nama` AS `cabang_nama`,`c`.`penerimaan_barang_id` AS `penerimaan_barang_id`,`c`.`penerimaan_barang_nomor` AS `penerimaan_barang_nomor`,`d`.`order_ppn` AS `order_ppn`,`a`.`retur_pembelian_status` AS `retur_pembelian_status`,if((`a`.`retur_pembelian_status` = 1),'Retur Pembelian Baru',if((`a`.`retur_pembelian_status` = 2),'Retur Pembelian Diterima',if((`a`.`retur_pembelian_status` = 3),'Retur Pembelian Disetujui','Pembuatan Nota Debet'))) AS `retur_pembelian_status_nama`,`a`.`retur_pembelian_status_date` AS `retur_pembelian_status_date`,`a`.`retur_pembelian_printed` AS `retur_pembelian_printed`,`a`.`retur_pembelian_created_date` AS `retur_pembelian_created_date`,`a`.`retur_pembelian_created_by` AS `retur_pembelian_created_by`,`a`.`retur_pembelian_update_date` AS `retur_pembelian_update_date`,`a`.`retur_pembelian_update_by` AS `retur_pembelian_update_by`,`a`.`retur_pembelian_revised` AS `retur_pembelian_revised` from (((`t_retur_pembelian` `a` join `m_cabang` `b` on((`b`.`cabang_id` = `a`.`m_cabang_id`))) join `t_penerimaan_barang` `c` on((`c`.`penerimaan_barang_id` = `a`.`t_penerimaan_barang_id`))) join `t_order` `d` on((`d`.`order_id` = `c`.`t_order_id`))));

-- --------------------------------------------------------

--
-- Structure for view `v_saldo_bankkas`
--
DROP TABLE IF EXISTS `v_saldo_bankkas`;

CREATE ALGORITHM=UNDEFINED DEFINER=`jasaprog_tangs`@`localhost` SQL SECURITY DEFINER VIEW `v_saldo_bankkas` AS (select `a`.`saldo_bankkas_id` AS `saldo_bankkas_id`,`a`.`saldo_bankkas_tipe` AS `saldo_bankkas_tipe`,if((`a`.`saldo_bankkas_tipe` = 1),'Saldo Bank','Saldo Kas') AS `saldo_bankkas_tipe_nama`,if((`a`.`saldo_bankkas_tipe` = 1),`b`.`bank_id`,`d`.`kas_id`) AS `bankkas_id`,if((`a`.`saldo_bankkas_tipe` = 1),`b`.`bank_nama`,`d`.`kas_nama`) AS `bankkas_nama`,if((`a`.`saldo_bankkas_tipe` = 1),`c`.`cabang_id`,`e`.`cabang_id`) AS `cabang_id`,if((`a`.`saldo_bankkas_tipe` = 1),`c`.`cabang_nama`,`e`.`cabang_nama`) AS `cabang_nama`,if((`a`.`saldo_bankkas_tipe` = 1),`b`.`bank_status_aktif`,`d`.`kas_status_aktif`) AS `bankkas_status_aktif`,`a`.`saldo_bankkas_nominal` AS `saldo_bankkas_nominal` from ((((`t_saldo_bankkas` `a` left join `m_bank` `b` on((`b`.`bank_id` = `a`.`saldo_bankkas_refrensi_id`))) left join `m_cabang` `c` on((`c`.`cabang_id` = `b`.`m_cabang_id`))) left join `m_kas` `d` on((`d`.`kas_id` = `a`.`saldo_bankkas_refrensi_id`))) left join `m_cabang` `e` on((`e`.`cabang_id` = `d`.`m_cabang_id`))));

-- --------------------------------------------------------

--
-- Structure for view `v_serah_terima`
--
DROP TABLE IF EXISTS `v_serah_terima`;

CREATE ALGORITHM=UNDEFINED DEFINER=`jasaprog_tangs`@`localhost` SQL SECURITY DEFINER VIEW `v_serah_terima` AS select `a`.`serah_terima_id` AS `serah_terima_id`,`a`.`serah_terima_nomor` AS `serah_terima_nomor`,`a`.`serah_terima_daribagian` AS `serah_terima_daribagian`,`a`.`serah_terima_darishift` AS `serah_terima_darishift`,`a`.`serah_terima_kebagian` AS `serah_terima_kebagian`,`a`.`serah_terima_keshift` AS `serah_terima_keshift`,`a`.`serah_terima_status` AS `serah_terima_status`,if((`a`.`serah_terima_status` = '1'),'Serah Terima Baru','Serah Terima Diterima') AS `serah_terima_status_nama`,`a`.`serah_terima_created_date` AS `serah_terima_created_date`,`a`.`serah_terima_created_by` AS `serah_terima_created_by`,`a`.`serah_terima_update_date` AS `serah_terima_update_date`,`a`.`serah_terima_update_by` AS `serah_terima_update_by`,`a`.`serah_terima_revised` AS `serah_terima_revised`,`b`.`cabang_id` AS `cabang_id`,`b`.`cabang_nama` AS `cabang_nama` from (`t_serah_terima` `a` join `m_cabang` `b` on((`b`.`cabang_id` = `a`.`m_cabang_id`)));

-- --------------------------------------------------------

--
-- Structure for view `v_stok_gudang`
--
DROP TABLE IF EXISTS `v_stok_gudang`;

CREATE ALGORITHM=UNDEFINED DEFINER=`jasaprog_tangs`@`localhost` SQL SECURITY DEFINER VIEW `v_stok_gudang` AS (select `a`.`barang_id` AS `barang_id`,`b`.`jenis_barang_id` AS `jenis_barang_id`,`b`.`jenis_barang_nama` AS `jenis_barang_nama`,`a`.`barang_nomor` AS `barang_nomor`,`a`.`barang_nama` AS `barang_nama`,`a`.`barang_status_aktif` AS `barang_status_aktif`,`c`.`satuan_id` AS `satuan_id`,`c`.`satuan_nama` AS `satuan_nama`,`a`.`barang_minimum_stok` AS `stok_minimum`,`d`.`stok_gudang_jumlah` AS `stok_gudang`,`e`.`gudang_id` AS `gudang_id`,`e`.`gudang_nama` AS `gudang_nama`,`f`.`cabang_id` AS `id_cabang`,`f`.`cabang_nama` AS `cabang_nama` from (((((`m_barang` `a` join `m_jenis_barang` `b` on((`b`.`jenis_barang_id` = `a`.`m_jenis_barang_id`))) join `m_satuan` `c` on((`c`.`satuan_id` = `a`.`m_satuan_id`))) join `t_stok_gudang` `d` on((`d`.`m_barang_id` = `a`.`barang_id`))) join `m_gudang` `e` on((`e`.`gudang_id` = `d`.`m_gudang_id`))) join `m_cabang` `f` on((`f`.`cabang_id` = `e`.`m_cabang_id`))));

-- --------------------------------------------------------

--
-- Structure for view `v_sub_atribut`
--
DROP TABLE IF EXISTS `v_sub_atribut`;

CREATE ALGORITHM=UNDEFINED DEFINER=`jasaprog_tangs`@`localhost` SQL SECURITY DEFINER VIEW `v_sub_atribut` AS (select `a`.`sub_atribut_id` AS `sub_atribut_id`,`a`.`m_atribut_id` AS `m_atribut_id`,`a`.`sub_atribut_jenis` AS `sub_atribut_jenis`,`a`.`sub_atribut_nama` AS `sub_atribut_nama`,`a`.`sub_atribut_satuan` AS `sub_atribut_satuan`,`a`.`sub_atribut_default_value` AS `sub_atribut_default_value`,`a`.`sub_atribut_status_aktif` AS `sub_atribut_status_aktif`,`a`.`sub_atribut_create_date` AS `sub_atribut_create_date`,`a`.`sub_atribut_create_by` AS `sub_atribut_create_by`,`a`.`sub_atribut_update_date` AS `sub_atribut_update_date`,`a`.`sub_atribut_update_by` AS `sub_atribut_update_by`,`a`.`sub_atribut_revised` AS `sub_atribut_revised`,`b`.`atribut_nama` AS `atribut_nama`,`b`.`m_barang_id` AS `m_barang_id`,`e`.`barang_nama` AS `barang_nama`,`f`.`satuan_nama` AS `satuan_nama` from (((`m_sub_atribut_barang` `a` left join `m_atribut_barang` `b` on((`a`.`m_atribut_id` = `b`.`atribut_id`))) left join `m_barang` `e` on((`b`.`m_barang_id` = `e`.`barang_id`))) left join `m_satuan` `f` on((`a`.`sub_atribut_satuan` = `f`.`satuan_id`))));

-- --------------------------------------------------------

--
-- Structure for view `v_surat_jalan`
--
DROP TABLE IF EXISTS `v_surat_jalan`;

CREATE ALGORITHM=UNDEFINED DEFINER=`jasaprog_tangs`@`localhost` SQL SECURITY DEFINER VIEW `v_surat_jalan` AS (select `a`.`surat_jalan_id` AS `surat_jalan_id`,`a`.`surat_jalan_nomor` AS `surat_jalan_nomor`,`b`.`cabang_id` AS `cabang_id`,`b`.`cabang_nama` AS `cabang_nama`,`a`.`surat_jalan_jenis` AS `surat_jalan_jenis`,if((`a`.`surat_jalan_jenis` = 0),'Surat Jalan Retur',if((`a`.`surat_jalan_jenis` = 2),'Surat Jalan Work Order','Surat Jalan Sales Order')) AS `surat_jalan_jenis_nama`,if((`a`.`surat_jalan_jenis` = 0),`e`.`nota_debet_nomor`,if((`a`.`surat_jalan_jenis` = 2),`d`.`order_nomor`,`f`.`so_customer_nomor`)) AS `nomor_referensi`,`a`.`surat_jalan_tanggal` AS `surat_jalan_tanggal`,`a`.`surat_jalan_tanggal_kirim` AS `surat_jalan_tanggal_kirim`,`a`.`surat_jalan_ekspedisi` AS `surat_jalan_ekspedisi`,`a`.`t_so_customer_id` AS `so_customer_id`,`e`.`nota_debet_id` AS `nota_debet_id`,`e`.`nota_debet_nomor` AS `nota_debet_nomor`,`c`.`partner_id` AS `partner_id`,`c`.`partner_nama` AS `partner_nama`,`d`.`order_id` AS `order_id`,`d`.`order_nomor` AS `order_nomor`,`a`.`surat_jalan_status` AS `surat_jalan_status`,`a`.`surat_jalan_status_date` AS `surat_jalan_status_date`,`a`.`surat_jalan_created_date` AS `surat_jalan_created_date`,`a`.`surat_jalan_created_by` AS `surat_jalan_created_by`,`a`.`surat_jalan_update_date` AS `surat_jalan_update_date`,`a`.`surat_jalan_update_by` AS `surat_jalan_update_by`,`a`.`surat_jalan_revised` AS `surat_jalan_revised` from (((((`t_surat_jalan` `a` join `m_cabang` `b` on((`b`.`cabang_id` = `a`.`m_cabang_id`))) join `m_partner` `c` on((`c`.`partner_id` = `a`.`m_partner_id`))) left join `t_order` `d` on((`d`.`order_id` = `a`.`t_order_id`))) left join `t_nota_debet` `e` on((`e`.`nota_debet_id` = `a`.`t_nota_debet_id`))) left join `t_so_customer` `f` on((`f`.`so_customer_id` = `a`.`t_so_customer_id`))));

-- --------------------------------------------------------

--
-- Structure for view `v_transfer_gudang`
--
DROP TABLE IF EXISTS `v_transfer_gudang`;

CREATE ALGORITHM=UNDEFINED DEFINER=`jasaprog_tangs`@`localhost` SQL SECURITY DEFINER VIEW `v_transfer_gudang` AS select `a`.`transfer_gudang_id` AS `transfer_gudang_id`,`a`.`transfer_gudang_nomor` AS `transfer_gudang_nomor`,`a`.`transfer_gudang_tanggal` AS `transfer_gudang_tanggal`,`b`.`gudang_id` AS `gudang_id_awal`,`b`.`gudang_nama` AS `gudang_nama_awal`,`c`.`cabang_id` AS `cabang_id_awal`,`c`.`cabang_nama` AS `cabang_nama_awal`,`a`.`transfer_gudang_tanggal_terima` AS `transfer_gudang_tanggal_terima`,`d`.`gudang_id` AS `gudang_id_akhir`,`d`.`gudang_nama` AS `gudang_nama_akhir`,`e`.`cabang_id` AS `cabang_id_akhir`,`e`.`cabang_nama` AS `cabang_nama_akhir`,`a`.`transfer_gudang_status` AS `transfer_gudang_status`,if((`a`.`transfer_gudang_status` = 1),'Transfer Gudang Baru',if((`a`.`transfer_gudang_status` = 2),'Transfer Gudang Diterima','Transfer Gudang Ditolak')) AS `transfer_gudang_status_nama`,`a`.`transfer_gudang_created_date` AS `transfer_gudang_created_date`,`a`.`transfer_gudang_created_by` AS `transfer_gudang_created_by`,`a`.`transfer_gudang_update_date` AS `transfer_gudang_update_date`,`a`.`transfer_gudang_update_by` AS `transfer_gudang_update_by`,`a`.`transfer_gudang_revised` AS `transfer_gudang_revised` from ((((`t_transfer_gudang` `a` left join `m_gudang` `b` on((`a`.`m_gudang_id_awal` = `b`.`gudang_id`))) left join `m_cabang` `c` on((`a`.`m_cabang_id_awal` = `c`.`cabang_id`))) left join `m_gudang` `d` on((`a`.`m_gudang_id_akhir` = `d`.`gudang_id`))) left join `m_cabang` `e` on((`a`.`m_cabang_id_akhir` = `e`.`cabang_id`)));

-- --------------------------------------------------------

--
-- Structure for view `v_user`
--
DROP TABLE IF EXISTS `v_user`;

CREATE ALGORITHM=UNDEFINED DEFINER=`jasaprog_tangs`@`localhost` SQL SECURITY DEFINER VIEW `v_user` AS select `a`.`user_id` AS `user_id`,`a`.`user_username` AS `user_username`,`b`.`karyawan_id` AS `karyawan_id`,`b`.`karyawan_nama` AS `karyawan_nama`,`a`.`user_status_aktif` AS `user_status_aktif`,if((`a`.`user_status_aktif` = 'y'),'Aktif','Non Aktif') AS `user_status_nama` from (`s_user` `a` left join `m_karyawan` `b` on((`a`.`m_karyawan_id` = `b`.`karyawan_id`)));

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
