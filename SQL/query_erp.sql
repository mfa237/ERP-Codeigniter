# QUERY LAPORAN POS
SELECT * FROM m_barang WHERE 1 AND barang_id = 1085;

SELECT * FROM tb_penjualan_details WHERE 1 AND barang = 890;

SELECT * FROM m_harga a WHERE a.`barang_id`= 890;

INSERT INTO `jasaprog_tangs`.`tb_penjualan_details` (`penjualan`, `barang`, `barang_qty`, `barang_price`) VALUES ('40', '2', '1', '660000');

SELECT *
FROM `tb_penjualan_details`
WHERE `barang_harga_beli` =0
OR `barang_harga_beli` IS NULL
OR `barang_harga_jual` =0;

SELECT mb.barang_id,`d`.*, `mb`.*, `ms`.`satuan_nama`, `mjb`.`jenis_barang_nama`, `mc`.`category_2_nama`, `mc`.`category_2_id`, (d.`barang_qty` + d.`item_getFromGudang`) AS qty, `d`.`barang_price` AS `barang_price`, d.barang_harga_beli * (d.`barang_qty` + d.`item_getFromGudang`)AS barang_total_harga_beli, d.barang_harga_jual* (d.`barang_qty` + d.`item_getFromGudang`)AS barang_total_harga_jual, `d`.`barang_discount_nominal` AS `discount`, `d`.`barang_grand_total` AS `barang_grand_total`, `a`.`penjualan_pajak` AS `penjualan_pajak`, `a`.`penjualan_all_discount_nominal` AS `penjualan_all_discount_nominal`, (a.`penjualan_all_discount_nominal` + a.penjualan_grand_total) AS total_transaksi_penjualan, (d.`barang_grand_total` / (a.`penjualan_all_discount_nominal` + a.penjualan_grand_total) * penjualan_all_discount_nominal) AS total_discout_nota, d.`barang_grand_total` - (d.`barang_grand_total` / (a.`penjualan_all_discount_nominal` + a.penjualan_grand_total) * penjualan_all_discount_nominal) AS total_transaksi_barang FROM `tb_penjualan` `a` LEFT JOIN `tb_penjualan_details` `d` ON `d`.`penjualan` = `a`.`penjualan_id` INNER JOIN `m_barang` `mb` ON `d`.`barang` = `mb`.`barang_id` INNER JOIN `m_satuan` `ms` ON mb.`m_satuan_id` = ms.`satuan_id` INNER JOIN `m_jenis_barang` `mjb` ON mjb.`jenis_barang_id` = mb.`m_jenis_barang_id` INNER JOIN `m_category_2` `mc` ON mb.`m_category_2_id` = mc.`category_2_id` WHERE `penjualan_date` >= '2017/01/01 00:00:00' AND `penjualan_date` <= '2017/07/13 23:59:59' AND `a`.`status` =0 AND `mb`.`m_jenis_barang_id` = '1' AND `mb`.`m_category_2_id` = '1' GROUP BY mb.barang_id


SELECT `d`.*, 
	`ms`.`satuan_nama`, `mjb`.`jenis_barang_nama`, 
	`mc`.`category_2_nama`, `mc`.`category_2_id`, `d`.*, 
	SUM(d.`barang_qty`) AS qty, 
	SUM(mb.`harga_beli`) AS  harga_beli, 
	SUM(mb.`harga_jual`) AS harga_jual, 
	SUM(mb.`harga_jual_pajak`) AS harga_jual_pajak
FROM `tb_penjualan` `a`
LEFT JOIN `tb_penjualan_details` `d` ON `d`.`penjualan` = `a`.`penjualan_id`
INNER JOIN `m_barang` `mb` ON `d`.`barang` = `mb`.`barang_id`
INNER JOIN `m_satuan` `ms` ON mb.`m_satuan_id` = ms.`satuan_id`
INNER JOIN `m_jenis_barang` `mjb` ON mjb.`jenis_barang_id` = mb.`m_jenis_barang_id`
INNER JOIN `m_category_2` `mc` ON mb.`m_category_2_id` = mc.`category_2_id`
WHERE `penjualan_date` >= '2017/06/01 00:00:00'
AND `penjualan_date` <= '2017/07/31 23:59:59'
GROUP BY `mb`.`m_jenis_barang_id`;

SELECT tpd.*, tp.*
FROM `tb_penjualan`  tp
JOIN `tb_penjualan_details` tpd ON tp.`penjualan_id` = tpd.`penjualan`
WHERE 1
AND tp.`penjualan_id`=1;

SELECT *
FROM `tb_penjualan` WHERE penjualan_id = 33;

SELECT 
	`d`.*, `mb`.*, `ms`.`satuan_nama`, `mjb`.`jenis_barang_nama`, `mc`.`category_2_nama`, `mc`.`category_2_id`, 
	(d.`barang_qty` + d.`item_getFromGudang`) AS qty,
	d.`barang_price` AS  barang_price,
	d.barang_harga_beli * (d.`barang_qty` + d.`item_getFromGudang`)AS  barang_total_harga_beli,
	d.barang_harga_jual* (d.`barang_qty` + d.`item_getFromGudang`)AS  barang_total_harga_jual,
	d.`barang_discount_nominal` AS discount,
	d.`barang_grand_total` AS barang_grand_total,
	a.`penjualan_pajak` AS penjualan_pajak,
	a.`penjualan_all_discount_nominal` AS penjualan_all_discount_nominal,
	(a.`penjualan_all_discount_nominal` + a.penjualan_grand_total) AS total_transaksi_penjualan,
	(d.`barang_grand_total` / (a.`penjualan_all_discount_nominal` + a.penjualan_grand_total) * penjualan_all_discount_nominal) AS total_discout_nota,
	d.`barang_grand_total` - (d.`barang_grand_total` / (a.`penjualan_all_discount_nominal` + a.penjualan_grand_total) * penjualan_all_discount_nominal) AS total_transaksi_barang
FROM `tb_penjualan` `a`
INNER  JOIN `tb_penjualan_details` `d` ON `d`.`penjualan` = `a`.`penjualan_id`
INNER JOIN `m_barang` `mb` ON `d`.`barang` = `mb`.`barang_id`
INNER JOIN `m_satuan` `ms` ON mb.`m_satuan_id` = ms.`satuan_id`
INNER JOIN `m_jenis_barang` `mjb` ON mjb.`jenis_barang_id` = mb.`m_jenis_barang_id`
INNER JOIN `m_category_2` `mc` ON mb.`m_category_2_id` = mc.`category_2_id`
WHERE `penjualan_date` >= '2017/01/01 00:00:00'
AND `penjualan_date` <= '2017/08/01 23:59:59'
AND a.status = 0
;

SELECT `a`.*, `b`.`cabang_nama`, `c`.`user_username`, `d`.`partner_nama`, `e`.`pengiriman_id`
FROM `tb_penjualan` `a`
JOIN tb_penjualan_details tpd ON a.`penjualan_id` = tpd.`penjualan`
LEFT JOIN `m_cabang` `b` ON `b`.`cabang_id` = `a`.`branch`
LEFT JOIN `s_user` `c` ON `c`.`user_id` = `a`.`user`
LEFT JOIN `m_partner` `d` ON `d`.`partner_id` = `a`.`customer`
LEFT JOIN `tb_pengiriman` `e` ON `e`.`penjualan_id` = `a`.`penjualan_id`
WHERE `a`.`status` =0
AND `a`.`penjualan_date` >= '2016-12-01 00:12:00'
AND `a`.`penjualan_date` <= '2017-09-01 23:09:00'
AND  CONCAT_WS(" ", b.cabang_nama, a.penjualan_code, a.penjualan_date, a.penjualan_total, a.penjualan_payment) LIKE '%%' ESCAPE '!'
ORDER BY `penjualan_date` ASC
;

SELECT tpd.*, tp.*
FROM `tb_penjualan`  tp
JOIN `tb_penjualan_details` tpd ON tp.`penjualan_id` = tpd.`penjualan`
WHERE 1
AND tp.`penjualan_id`=1;


SELECT `a`.*, `b`.`partner_nama`, `c`.*, SUM(d.barang_discount_nominal) AS discountbarang
FROM `tb_penjualan` `a`
LEFT JOIN `m_partner` `b` ON `b`.`partner_id` = `a`.`customer`
LEFT JOIN `tb_pengiriman` `c` ON `c`.`penjualan_id` = `a`.`penjualan_id`
LEFT JOIN `tb_penjualan_details` `d` ON `d`.`penjualan` = `a`.`penjualan_id`
WHERE `a`.`penjualan_id` = '33';

# QUERY DELCOM PO
SELECT *
FROM `t_order`
WHERE `order_id` = '173';

SELECT *
FROM t_orderdet
WHERE 1
AND t_order_id = '173'
;

SELECT *
FROM t_penerimaan_barang tb
WHERE tb.`t_order_id` = '173';

SELECT *
FROM t_penerimaan_barangdet tbd
WHERE tbd.`t_penerimaan_barang_id`= '110';


SELECT *
FROM `t_penerimaan_barang` `tb`
INNER JOIN `t_penerimaan_barangdet` `tbd` ON `tb`.`penerimaan_barang_id` = `tbd`.`t_penerimaan_barang_id`
WHERE `t_order_id` = '173'
###########################################################################################

SELECT * 
FROM `tb_penjualan` `a`
LEFT JOIN `m_partner` `b` ON `b`.`partner_id` = `a`.`customer`
LEFT JOIN `tb_pengiriman` `c` ON `c`.`penjualan_id` = `a`.`penjualan_id`
LEFT JOIN `tb_penjualan_details` `d` ON `d`.`penjualan` = `a`.`penjualan_id`
;

SELECT *
FROM `tb_penjualan` `a`
LEFT JOIN `tb_penjualan_details` `d` ON `d`.`penjualan` = `a`.`penjualan_id`
LEFT JOIN m_barang mb ON mb.`barang_id` = d.`barang`
#FROM m_barang mb 
INNER JOIN m_jenis_barang mjb ON  mjb.`jenis_barang_id` = mb.`m_jenis_barang_id`
INNER JOIN m_category_2 mc ON mb.`m_category_2_id` = mc.`category_2_id`
WHERE 1
#AND mjb.`jenis_barang_nama` like '%Compres%'
#and mjb.`jenis_barang_id`= 1
#AND mc.`category_2_id`= 1
AND barang_id IN ('936','935')
;

SELECT * FROM m_category_2 mc 
WHERE 1 
AND mc.`m_jenis_barang_id` = 5
AND mc.`category_2_id` = 28; 

;
SELECT `a`.*
#SUM(d.barang_discount_nominal) as discountbarang 
FROM `tb_penjualan` `a` LEFT JOIN `tb_penjualan_details` `d` ON `d`.`penjualan` = `a`.`penjualan_id` INNER JOIN `m_barang` `mb` ON `d`.`barang` = `mb`.`barang_id` INNER JOIN `m_jenis_barang` `mjb` ON mjb.`jenis_barang_id` = mb.`m_jenis_barang_id` INNER JOIN `m_category_2` `mc` ON mb.`m_category_2_id` = mc.`category_2_id`
GROUP BY penjualan_id;

SELECT mb.*
,`d`.*
,SUM(d.`barang_qty`) AS qty
,mb.`harga_beli` AS  hpp
,mb.`harga_jual` AS harga_jual
,mb.`harga_jual_pajak` AS harga_jual_pajak
FROM `tb_penjualan_details` `d` 
INNER JOIN `m_barang` `mb` ON `d`.`barang` = `mb`.`barang_id` 
INNER JOIN `m_jenis_barang` `mjb` ON mjb.`jenis_barang_id` = mb.`m_jenis_barang_id` 
INNER JOIN `m_category_2` `mc` ON mb.`m_category_2_id` = mc.`category_2_id`
GROUP BY mb.`barang_id`;

SELECT * FROM tb_penjualan_details d WHERE 1 ;
AND d.`penjualan_detail_id` = 70;


SELECT `mb`.*, `ms`.`satuan_nama`, `d`.*
, SUM(d.`barang_qty`) AS qty, `mb`.`harga_beli` AS `hpp`, 
`mb`.`harga_jual` AS `harga_jual`, `mb`.`harga_jual_pajak` AS `harga_jual_pajak` 
FROM `tb_penjualan_details` `d` 
INNER JOIN `m_barang` `mb` ON `d`.`barang` = `mb`.`barang_id` 
INNER JOIN `m_satuan` `ms` ON mb.`m_satuan_id` = ms.`satuan_id` 
INNER JOIN `m_jenis_barang` `mjb` ON mjb.`jenis_barang_id` = mb.`m_jenis_barang_id` 
INNER JOIN `m_category_2` `mc` ON mb.`m_category_2_id` = mc.`category_2_id` 
GROUP BY `mb`.`m_jenis_barang_id`;

