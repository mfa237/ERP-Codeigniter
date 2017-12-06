<?php

defined('BASEPATH') OR exit('No direct script access allowed');



/*

| -------------------------------------------------------------------------

| URI ROUTING

| -------------------------------------------------------------------------

| This file lets you re-map URI requests to specific controller functions.

|

| Typically there is a one-to-one relationship between a URL string

| and its corresponding controller class/method. The segments in a

| URL normally follow this pattern:

|

|	example.com/class/method/id/

|

| In some instances, however, you may want to remap this relationship

| so that a different class/function is called than the one

| corresponding to the URL.

|

| Please see the user guide for complete details:

|

|	https://codeigniter.com/user_guide/general/routing.html

|

| -------------------------------------------------------------------------

| RESERVED ROUTES

| -------------------------------------------------------------------------

|

| There are three reserved routes:

|

|	$route['default_controller'] = 'welcome';

|

| This route indicates which controller class should be loaded if the

| URI contains no data. In the above example, the "welcome" class

| would be loaded.

|

|	$route['404_override'] = 'errors/page_missing';

|

| This route will tell the Router which controller/method to use if those

| provided in the URL cannot be matched to a valid route.

|

|	$route['translate_uri_dashes'] = FALSE;

|

| This is not exactly a route, but allows you to automatically route

| controller and method names that contain dashes. '-' isn't a valid

| class or method name character, so it requires translation.

| When you set this option to TRUE, it will replace ALL dashes in the

| controller and method URI segments.

|

| Examples:	my-controller/index	-> my_controller/index

|		my-controller/my-method	-> my_controller/my_method

*/

$route['default_controller'] 	= 'C_dashboard';

$route['404_override'] 			= 'C_page_handling/Page404';

$route['translate_uri_dashes'] 	= FALSE;



// Commend this route for active C_my_custom_controller

// $route['C_my_custom_controller'] = 'C_page_handling/Page404';



// ROUTE USER GATE

$route['Login']													= 'C_page_handling/PageLogin';

$route['Login/doLogin']											= 'C_page_handling/doLogin';

$route['Login/doLogout']										= 'C_page_handling/doLogout';

$route['Login/(:any)']											= 'C_page_handling/$1';

$route['Login/(:any)/(:any)']									= 'C_page_handling/$1/$2';

// END ROUTE USER GATE



$route['Dashboard']												= 'C_dashboard';

$route['Dashboard/(:any)']								= 'C_dashboard/$1';

$route['Dashboard-Manufaktur']            = 'C_dashboard';

// ROUTE MASTER

// Cabang

$route['Master-Data/Cabang']									= 'C_cabang';

$route['Master-Data/Cabang/checkKode']									= 'C_cabang/checkKode';

$route['Master-Data/Cabang/getForm']							= 'C_cabang/getForm';

$route['Master-Data/Cabang/loadData']							= 'C_cabang/loadData';

$route['Master-Data/Cabang/postData']							= 'C_cabang/postData';

$route['Master-Data/Cabang/deleteData']							= 'C_cabang/deleteData';

$route['Master-Data/Cabang/aktifData']							= 'C_cabang/aktifData';

$route['Master-Data/Cabang/loadDataWhere']						= 'C_cabang/loadDataWhere';

$route['Master-Data/Cabang/loadDataSelect']						= 'C_cabang/loadData_select';

$route['Master-Data/Cabang/loadDataSelectKota']					= 'C_cabang/loadData_selectKota';

// End Cabang

// Brand

$route['Master-Data/Master-Brand']								= 'C_brand';

$route['Master-Data/Master-Brand/getForm']						= 'C_brand/getForm';

$route['Master-Data/Master-Brand/loadData']						= 'C_brand/loadData';

$route['Master-Data/Master-Brand/postData']						= 'C_brand/postData';

$route['Master-Data/Master-Brand/deleteData']					= 'C_brand/deleteData';

$route['Master-Data/Master-Brand/aktifData']					= 'C_brand/aktifData';

$route['Master-Data/Master-Brand/loadDataWhere']				= 'C_brand/loadDataWhere';

$route['Master-Data/Master-Brand/loadDataSelect']				= 'C_brand/loadData_select';

$route['Master-Data/Master-Brand/loadDataSelectKota']			= 'C_brand/loadData_selectKota';

$route['Master-Data/Master-Brand/loadDataSelectWhere']			= 'C_brand/loadDataSelectWhere';

// End Brand

// Promo

$route['Master-Data/Master-Promo/(:any)']								= 'C_promo/$1';

$route['Master-Data/Master-Promo']								= 'C_promo';

$route['Master-Data/Master-Promo/getForm']						= 'C_promo/getForm';

$route['Master-Data/Master-Promo/loadData']						= 'C_promo/loadData';

$route['Master-Data/Master-Promo/postData']						= 'C_promo/postData';

$route['Master-Data/Master-Promo/deleteData']					= 'C_promo/deleteData';

$route['Master-Data/Master-Promo/aktifData']					= 'C_promo/aktifData';

$route['Master-Data/Master-Promo/loadDataWhere']				= 'C_promo/loadDataWhere';

$route['Master-Data/Master-Promo/loadDataSelect']				= 'C_promo/loadData_select';

$route['Master-Data/Master-Promo/loadDataSelectKota']			= 'C_promo/loadData_selectKota';

// End Promo

// Tipe Karyawan

$route['Master-Data/Tipe-Karyawan']								= 'C_tipe_karyawan';

$route['Master-Data/Tipe-Karyawan/getForm']						= 'C_tipe_karyawan/getForm';

$route['Master-Data/Tipe-Karyawan/loadData']					= 'C_tipe_karyawan/loadData';

$route['Master-Data/Tipe-Karyawan/postData']					= 'C_tipe_karyawan/postData';

$route['Master-Data/Tipe-Karyawan/deleteData']					= 'C_tipe_karyawan/deleteData';

$route['Master-Data/Tipe-Karyawan/aktifData']					= 'C_tipe_karyawan/aktifData';

$route['Master-Data/Tipe-Karyawan/loadDataWhere']				= 'C_tipe_karyawan/loadDataWhere';

$route['Master-Data/Tipe-Karyawan/loadDataSelect']				= 'C_tipe_karyawan/loadData_select';

// End Tipe Karyawan

// Departemen

$route['Master-Data/Departemen']								= 'C_departemen';

$route['Master-Data/Departemen/getForm']						= 'C_departemen/getForm';

$route['Master-Data/Departemen/loadData']						= 'C_departemen/loadData';

$route['Master-Data/Departemen/postData']						= 'C_departemen/postData';

$route['Master-Data/Departemen/deleteData']						= 'C_departemen/deleteData';

$route['Master-Data/Departemen/aktifData']						= 'C_departemen/aktifData';

$route['Master-Data/Departemen/loadDataWhere']					= 'C_departemen/loadDataWhere';

$route['Master-Data/Departemen/loadDataSelect']					= 'C_departemen/loadData_select';

// End Departemen

// Jenis Gudang

$route['Master-Data/Mutasi/postData']								= 'C_mutasibarang/postData';

$route['Master-Data/Jenis-Gudang']								  = 'C_jenis_gudang';

$route['Master-Data/Jenis-Gudang/getForm']						= 'C_jenis_gudang/getForm';

$route['Master-Data/Jenis-Gudang/loadData']						= 'C_jenis_gudang/loadData';

$route['Master-Data/Jenis-Gudang/postData']						= 'C_jenis_gudang/postData';

$route['Master-Data/Jenis-Gudang/deleteData']					= 'C_jenis_gudang/deleteData';

$route['Master-Data/Jenis-Gudang/aktifData']					= 'C_jenis_gudang/aktifData';

$route['Master-Data/Jenis-Gudang/loadDataWhere']				= 'C_jenis_gudang/loadDataWhere';

$route['Master-Data/Jenis-Gudang/loadDataSelect']				= 'C_jenis_gudang/loadData_select';

// End Jenis Gudang

// Karyawan

$route['Master-Data/Karyawan']									= 'C_karyawan';

$route['Master-Data/Karyawan/getForm']							= 'C_karyawan/getForm';

$route['Master-Data/Karyawan/loadData']							= 'C_karyawan/loadData';

$route['Master-Data/Karyawan/postData']							= 'C_karyawan/postData';

$route['Master-Data/Karyawan/deleteData']						= 'C_karyawan/deleteData';

$route['Master-Data/Karyawan/aktifData']						= 'C_karyawan/aktifData';

$route['Master-Data/Karyawan/loadDataWhere']					= 'C_karyawan/loadDataWhere';

$route['Master-Data/Karyawan/loadDataSelect']					= 'C_karyawan/loadData_select';

$route['Master-Data/Karyawan/checkNip']							= 'C_karyawan/checkNip';

// End Karyawan

// Partner

$route['Master-Data/Partner']									= 'C_partner';

$route['Master-Data/Partner/getForm']							= 'C_partner/getForm';

$route['Master-Data/Partner/getFormLogin']						= 'C_partner/getFormLogin';

$route['Master-Data/Partner/loadData']							= 'C_partner/loadData';

$route['Master-Data/Partner/postData']							= 'C_partner/postData';

$route['Master-Data/Partner/deleteData']						= 'C_partner/deleteData';

$route['Master-Data/Partner/aktifData']							= 'C_partner/aktifData';

$route['Master-Data/Partner/loadDataWhere']						= 'C_partner/loadDataWhere';

$route['Master-Data/Partner/loadDataSelect1']					= 'C_partner/loadData_select1';

$route['Master-Data/Partner/loadDataSelect2']					= 'C_partner/loadData_select2';

$route['Master-Data/Partner/loadDataSelect3']					= 'C_partner/loadData_select3';

$route['Master-Data/Partner/loadDataLimit']						= 'C_partner/loadDataLimit';

// End Partner

// Gudang

$route['Master-Data/Gudang']									= 'C_gudang';

$route['Master-Data/Gudang/getForm']							= 'C_gudang/getForm';

$route['Master-Data/Gudang/loadData']							= 'C_gudang/loadData';

$route['Master-Data/Gudang/postData']							= 'C_gudang/postData';

$route['Master-Data/Gudang/deleteData']							= 'C_gudang/deleteData';

$route['Master-Data/Gudang/aktifData']							= 'C_gudang/aktifData';

$route['Master-Data/Gudang/loadDataWhere']						= 'C_gudang/loadDataWhere';

$route['Master-Data/Gudang/loadDataSelect']						= 'C_gudang/loadData_select';

$route['Master-Data/Gudang/loadDataSelectCabang']				= 'C_gudang/loadData_selectGudang/1';

$route['Master-Data/Gudang/loadDataSelectCabang2']				= 'C_gudang/loadData_selectGudang/2';

$route['Master-Data/Gudang/loadDataSelectKota']					              = 'C_gudang/loadData_selectKota';

$route['Gudang/Mutasi-Barang']				                    = 'C_mutasibarang';

$route['Gudang/Mutasi-Barang/(:any)/(:any)']				      = 'C_mutasibarang/$1/$2';

// End Gudang

// Jenis Barang

$route['Master-Data/Jenis-Barang']								= 'C_jenis_barang';

$route['Master-Data/Jenis-Barang/getForm']						= 'C_jenis_barang/getForm';

$route['Master-Data/Jenis-Barang/loadData']						= 'C_jenis_barang/loadData';

$route['Master-Data/Jenis-Barang/postData']						= 'C_jenis_barang/postData';

$route['Master-Data/Jenis-Barang/deleteData']					= 'C_jenis_barang/deleteData';

$route['Master-Data/Jenis-Barang/aktifData']					= 'C_jenis_barang/aktifData';

$route['Master-Data/Jenis-Barang/loadDataWhere']				= 'C_jenis_barang/loadDataWhere';

$route['Master-Data/Jenis-Barang/loadDataSelect']				= 'C_jenis_barang/loadData_select';

// End Jenis Barang

// Jenis Barang

$route['Master-Data/Master-Kategori']							= 'C_kategori';

$route['Master-Data/Master-Kategori/getForm']					= 'C_kategori/getForm';

$route['Master-Data/Master-Kategori/loadData']					= 'C_kategori/loadData';

$route['Master-Data/Master-Kategori/postData']					= 'C_kategori/postData';

$route['Master-Data/Master-Kategori/deleteData']				= 'C_kategori/deleteData';

$route['Master-Data/Master-Kategori/aktifData']					= 'C_kategori/aktifData';

$route['Master-Data/Master-Kategori/loadDataWhere']				= 'C_kategori/loadDataWhere';

$route['Master-Data/Master-Kategori/loadDataSelect']			= 'C_kategori/loadData_select';

$route['Master-Data/Master-Kategori/loadDataSelectWhere']		= 'C_kategori/loadDataSelectWhere';

// End Jenis Barang

// Barang

$route['Master-Data/Barang']									= 'C_barang';

$route['Master-Data/Barang/getForm']							= 'C_barang/getForm';

$route['Master-Data/Barang/loadData']							= 'C_barang/loadData';

$route['Master-Data/Barang/postData']							= 'C_barang/postData';

$route['Master-Data/Barang/deleteData']							= 'C_barang/deleteData';

$route['Master-Data/Barang/aktifData']							= 'C_barang/aktifData';

$route['Master-Data/Barang/loadDataWhere']						= 'C_barang/loadDataWhere';

$route['Master-Data/Barang/Import']								= 'C_barang/import';

$route['Master-Data/Barang/loadDataSelect']						= 'C_barang/loadData_select';

$route['Master-Data/Barang/loadDataSelectKode']					= 'C_barang/loadData_select2';

$route['Master-Data/Barang/loadDataSelectUraian']				= 'C_barang/loadData_select3';

$route['Master-Data/Barang/loadDataSelectWhere']				= 'C_barang/loadDataSelectWhere';

$route['Master-Data/Barang/loadDataSelectWhere2']				= 'C_barang/loadDataSelectWhere2';

$route['Master-Data/Barang/getLastId']							= 'C_barang/get_last_id';

$route['Master-Data/Barang/printPriceTag']							= 'C_barang/printpricetag';



// End Barang

// Atribut Barang

$route['Master-Data/Atribut-Barang']							= 'C_atribut_barang';

$route['Master-Data/Atribut-Barang/getForm']					= 'C_atribut_barang/getForm';

$route['Master-Data/Atribut-Barang/loadData']					= 'C_atribut_barang/loadData';

$route['Master-Data/Atribut-Barang/postData']					= 'C_atribut_barang/postData';

$route['Master-Data/Atribut-Barang/deleteData']					= 'C_atribut_barang/deleteData';

$route['Master-Data/Atribut-Barang/aktifData']					= 'C_atribut_barang/aktifData';

$route['Master-Data/Atribut-Barang/loadDataWhere']				= 'C_atribut_barang/loadDataWhere';

$route['Master-Data/Atribut-Barang/loadDataSelect']				= 'C_atribut_barang/loadData_select';

// $route['Master-Data/Atribut-Barang/loadDataSelectSatuan']		= 'C_atribut_barang/loadData_selectSatuan';

// End Atribut Barang

// Sub Atribut Barang

$route['Master-Data/Sub-Atribut-Barang']						= 'C_sub_atribut_barang';

$route['Master-Data/Sub-Atribut-Barang/getForm']				= 'C_sub_atribut_barang/getForm';

$route['Master-Data/Sub-Atribut-Barang/loadData']				= 'C_sub_atribut_barang/loadData';

$route['Master-Data/Sub-Atribut-Barang/postData']				= 'C_sub_atribut_barang/postData';

$route['Master-Data/Sub-Atribut-Barang/deleteData']				= 'C_sub_atribut_barang/deleteData';

$route['Master-Data/Sub-Atribut-Barang/aktifData']				= 'C_sub_atribut_barang/aktifData';

$route['Master-Data/Sub-Atribut-Barang/loadDataWhere']			= 'C_sub_atribut_barang/loadDataWhere';

$route['Master-Data/Sub-Atribut-Barang/loadAtribut']			= 'C_sub_atribut_barang/loadAtribut';

$route['Master-Data/Sub-Atribut-Barang/loadDataSelect']			= 'C_sub_atribut_barang/loadData_select';

// End Sub Atribut Barang

// Value Barang

$route['Master-Data/Value-Barang/getFormValue']					= 'C_barang/getFormValue';

$route['Master-Data/Value-Barang/loadDataValueWhere']			= 'C_barang/loadDataValueWhere';

$route['Master-Data/Value-Barang/postData']						= 'C_barang/postDataValue';

// End Value Barang

// Currency

$route['Master-Data/Mata-Uang']									= 'C_mata_uang';

$route['Master-Data/Mata-Uang/getForm']							= 'C_mata_uang/getForm';

$route['Master-Data/Mata-Uang/loadData']						= 'C_mata_uang/loadData';

$route['Master-Data/Mata-Uang/postData']						= 'C_mata_uang/postData';

$route['Master-Data/Mata-Uang/deleteData']						= 'C_mata_uang/deleteData';

$route['Master-Data/Mata-Uang/aktifData']						= 'C_mata_uang/aktifData';

$route['Master-Data/Mata-Uang/loadDataWhere']					= 'C_mata_uang/loadDataWhere';

$route['Master-Data/Mata-Uang/loadDataSelect']					= 'C_mata_uang/loadData_select';

// End Currency

//EDC

$route['Master-Data/EDC']								= 'C_edc';

$route['Master-Data/EDC/getForm']						= 'C_edc/getForm';

$route['Master-Data/EDC/loadData']						= 'C_edc/loadData';

$route['Master-Data/EDC/postData']						= 'C_edc/postData';

$route['Master-Data/EDC/deleteData']						= 'C_edc/deleteData';

$route['Master-Data/EDC/aktifData']						= 'C_edc/aktifData';

$route['Master-Data/EDC/loadDataWhere']					= 'C_edc/loadDataWhere';

$route['Master-Data/EDC/loadDataSelectCabang']					= 'C_edc/loadData_select_cabang';

$route['Master-Data/EDC/loadDataSelectBank']					= 'C_edc/loadData_select_bank';

//End EDC

// JENIS PRODUKSI

$route['Master-Data/Jenis-Produksi']							= 'C_jenis_produksi';

$route['Master-Data/Jenis-Produksi/getForm']					= 'C_jenis_produksi/getForm';

$route['Master-Data/Jenis-Produksi/loadData']					= 'C_jenis_produksi/loadData';

$route['Master-Data/Jenis-Produksi/postData']					= 'C_jenis_produksi/postData';

$route['Master-Data/Jenis-Produksi/deleteData']					= 'C_jenis_produksi/deleteData';

$route['Master-Data/Jenis-Produksi/aktifData']					= 'C_jenis_produksi/aktifData';

$route['Master-Data/Jenis-Produksi/loadDataWhere']				= 'C_jenis_produksi/loadDataWhere';

$route['Master-Data/Jenis-Produksi/loadDataSelect']				= 'C_jenis_produksi/loadData_select';

// End JENIS PRODUKSI

// BANK

$route['Master-Data/Bank']								= 'C_bank';

$route['Master-Data/Bank/getForm']						= 'C_bank/getForm';

$route['Master-Data/Bank/loadData']						= 'C_bank/loadData';

$route['Master-Data/Bank/postData']						= 'C_bank/postData';

$route['Master-Data/Bank/deleteData']					= 'C_bank/deleteData';

$route['Master-Data/Bank/aktifData']					= 'C_bank/aktifData';

$route['Master-Data/Bank/loadDataWhere']				= 'C_bank/loadDataWhere';

$route['Master-Data/Bank/loadDataSelect']				= 'C_bank/loadData_select';

// End BANK



// BANK

$route['Master-Data/Konsinyasi']								            = 'C_konsinyasi';

$route['Master-Data/Konsinyasi/getForm']						        = 'C_konsinyasi/getForm';

$route['Master-Data/Konsinyasi/loadData']						        = 'C_konsinyasi/loadData';

$route['Master-Data/Konsinyasi/postData']						        = 'C_konsinyasi/postData';

$route['Master-Data/Konsinyasi/deleteData']						      = 'C_konsinyasi/deleteData';

$route['Master-Data/Konsinyasi/aktifData']						      = 'C_konsinyasi/aktifData';

$route['Master-Data/Konsinyasi/loadDataWhere']					    = 'C_konsinyasi/loadDataWhere';

$route['Master-Data/Konsinyasi/loadDataSelect']					    = 'C_konsinyasi/loadData_select';

$route['Master-Data/Konsinyasi/loadDataSelectWhere']			  = 'C_konsinyasi/loadDataSelectWhere';

$route['Master-Data/Konsinyasi/cekStok']						        = 'C_konsinyasi/cekStok';

$route['Master-Data/Konsinyasi/loadDataSelectKons']				  = 'C_konsinyasi/loadDataSelectKons';

$route['Master-Data/Konsinyasi/loadDataSelectBarang']				  = 'C_konsinyasi/loadDataSelectBarang';



// End BANK

// END ROUTE MASTER



// BKB

$route['Produksi/Bukti-Keluar-Barang']							= 'C_bukti_keluar_barang/viewBkb/1';

$route['Produksi/Bukti-Keluar-Barang/Form']						= 'C_bukti_keluar_barang/getForm1';

$route['Produksi/Bukti-Keluar-Barang/Form/(:any)']				= 'C_bukti_keluar_barang/getForm1/$1';

$route['Produksi/Bukti-Keluar-Barang/loadData']					= 'C_bukti_keluar_barang/loadDataBkb/1';

$route['Produksi/Bukti-Keluar-Barang/postData']					= 'C_bukti_keluar_barang/postDataBkb/1';

$route['Produksi/Bukti-Keluar-Barang/loadDataWhere']			= 'C_bukti_keluar_barang/loadDataBkbWhere/1';

$route['Produksi/Bukti-Keluar-Barang/print-BKB/(:any)']			= 'C_bukti_keluar_barang/cetakPDF/$1';

$route['Gudang/Bukti-Keluar-Barang']							= 'C_bukti_keluar_barang/viewBkb/2';

$route['Gudang/Bukti-Keluar-Barang/loadData']					= 'C_bukti_keluar_barang/loadDataBkb/2';

$route['Gudang/Bukti-Keluar-Barang/Form/(:any)']				= 'C_bukti_keluar_barang/getForm2/$1';

$route['Gudang/Bukti-Keluar-Barang/loadDataWhere']				= 'C_bukti_keluar_barang/loadDataBkbWhere/2';

$route['Gudang/Bukti-Keluar-Barang/checkStatus']				= 'C_bukti_keluar_barang/checkStatus';

$route['Gudang/Bukti-Keluar-Barang/postData']					= 'C_bukti_keluar_barang/postDataBkb/2';

$route['Gudang/Bukti-Keluar-Barang/print-BKB/(:any)']			= 'C_bukti_keluar_barang/cetakPDF/$1';

// end BKB



// Stok Gudang

$route['Inventory/Stok-Gudang']									= 'C_stok_gudang/view';

$route['Inventory/Stok-Gudang/loadDataStok']					= 'C_stok_gudang/loadDataStok';

$route['Inventory/Stok-Gudang/loadDataWhere']					= 'C_stok_gudang/loadDataWhere';

$route['Inventory/Stok-Gudang/loadDataJumlahWhere']				= 'C_stok_gudang/loadDataJumlahWhere';

$route['Inventory/Stok-Gudang/loadDataKartuStok']				= 'C_stok_gudang/loadDataKartuStok';

$route['Inventory/Stok-Gudang/Print-Kartu-Stok']				= 'C_stok_gudang/cetakPDF';

// End Stok Gudang



// SPP

$route['Gudang/Surat-Permintaan-Pembelian']						= 'C_permintaan_pembelian/view/1';

$route['Gudang/Surat-Permintaan-Pembelian/loadData']			= 'C_permintaan_pembelian/loadData/1';

$route['Gudang/Surat-Permintaan-Pembelian/Form']				= 'C_permintaan_pembelian/getForm1';

$route['Gudang/Surat-Permintaan-Pembelian/Form/(:any)']			= 'C_permintaan_pembelian/getForm1/$1';

$route['Gudang/Surat-Permintaan-Pembelian/postData']			= 'C_permintaan_pembelian/postData/1';

$route['Gudang/Surat-Permintaan-Pembelian/loadDataWhere']		= 'C_permintaan_pembelian/loadDataWhere/1';

$route['Gudang/Surat-Permintaan-Pembelian/print-SPP/(:any)']	= 'C_permintaan_pembelian/cetakPDF/$1';

$route['Pembelian/Surat-Permintaan-Pembelian']					= 'C_permintaan_pembelian/view/2';

$route['Pembelian/Surat-Permintaan-Pembelian/loadData']			= 'C_permintaan_pembelian/loadData/2';

$route['Pembelian/Surat-Permintaan-Pembelian/postData']			= 'C_permintaan_pembelian/postData/1';

$route['Pembelian/Surat-Permintaan-Pembelian/Form/(:any)']		= 'C_permintaan_pembelian/getForm2/$1';

$route['Pembelian/Surat-Permintaan-Pembelian/loadDataWhere']	= 'C_permintaan_pembelian/loadDataWhere/2';

$route['Pembelian/Surat-Permintaan-Pembelian/checkStatus']		= 'C_permintaan_pembelian/checkStatus';

$route['Pembelian/Surat-Permintaan-Pembelian/loadDataSelect/(:any)']	= 'C_permintaan_pembelian/loadData_select/1/$1';

$route['Pembelian/Surat-Permintaan-Pembelian/loadDataSelect2/(:any)']	= 'C_permintaan_pembelian/loadData_select/2/$1';

$route['Pembelian/Surat-Permintaan-Pembelian/print-SPP/(:any)']			= 'C_permintaan_pembelian/cetakPDF/$1';

$route['Gudang/Surat-Permintaan-Pembelian/(:any)']						= 'C_permintaan_pembelian/$1';

$route['Gudang/Surat-Permintaan-Pembelian/(:any)/(:any)']				= 'C_permintaan_pembelian/$1/$2';

// end SPP



// Penawaran Harga

$route['Pembelian/Penawaran-Harga']								      = 'C_penawaran_harga';

$route['Pembelian/Penawaran-Harga/loadData']					  = 'C_penawaran_harga/loadData/1';

$route['Pembelian/Penawaran-Harga/Form']						    = 'C_penawaran_harga/getForm1';

$route['Pembelian/Penawaran-Harga/Form/(:any)']					= 'C_penawaran_harga/getForm1/$1';

$route['Pembelian/Penawaran-Harga/postData']					  = 'C_penawaran_harga/postData/1';

$route['Pembelian/Penawaran-Harga/loadDataHarga']				= 'C_penawaran_harga/loadDataHarga/1';

$route['Pembelian/Penawaran-Harga/loadDataHarga2']			= 'C_penawaran_harga/loadDataHarga/2';

$route['Pembelian/Penawaran-Harga/loadDataPemenang']		= 'C_penawaran_harga/loadDataPemenang/1';

$route['Pembelian/Penawaran-Harga/loadDataPemenang2']		= 'C_penawaran_harga/loadDataPemenang/2';

$route['Pembelian/Penawaran-Harga/loadDataWhere']				= 'C_penawaran_harga/loadDataWhere/1';

$route['Pembelian/Penawaran-Harga/loadDataSelect']			= 'C_penawaran_harga/loadData_select/1';

$route['Pembelian/Penawaran-Harga/loadDataSelect2']			= 'C_penawaran_harga/loadData_select/2';

$route['Pembelian/Penawaran-Harga/loadDataSelect3']			= 'C_penawaran_harga/loadData_select/3';

$route['Pembelian/Penawaran-Harga/print-Penawaran/(:any)']	= 'C_penawaran_harga/cetakPDF/$1';

$route['Pembelian/Penawaran-Harga/(:any)']						      = 'C_penawaran_harga/$1';

$route['Pembelian/Penawaran-Harga/(:any)/(:any)']				    = 'C_penawaran_harga/$1/$2';



// end Penawaran Harga



// PO

$route['Pembelian/Purchase-Order']								    = 'C_purchase_order/view/1';

$route['Pembelian/Purchase-Order/loadData']						= 'C_purchase_order/loadData/1';

$route['Pembelian/Purchase-Order/Form']							  = 'C_purchase_order/getForm1';

$route['Pembelian/Purchase-Order/Form/(:any)']				= 'C_purchase_order/getForm1/$1';

$route['Pembelian/Purchase-Order/EditForm/(:any)']		= 'C_purchase_order/getForm3/$1';

$route['Pembelian/Purchase-Order/loadDataWhere']			= 'C_purchase_order/loadDataWhere/1';

$route['Pembelian/Purchase-Order/postData']						= 'C_purchase_order/postData/1';

$route['Pembelian/Purchase-Order/postData/3']					= 'C_purchase_order/postData/3';

$route['Pembelian/Purchase-Order/print-PO/(:any)']		= 'C_purchase_order/cetakPDF/$1';

$route['Pembelian/Purchase-Order/loadDataSelect']			= 'C_purchase_order/loadData_select';

$route['Persetujuan/Purchase-Order']							    = 'C_purchase_order/view/2';

$route['Persetujuan/Purchase-Order/loadData']					= 'C_purchase_order/loadData/2';

$route['Persetujuan/Purchase-Order/Form/(:any)']			= 'C_purchase_order/getForm2/$1';

$route['Persetujuan/Purchase-Order/loadDataWhere']		= 'C_purchase_order/loadDataWhere/2';

$route['Persetujuan/Purchase-Order/checkStatus']			= 'C_purchase_order/checkStatus';

$route['Persetujuan/Purchase-Order/postData']					= 'C_purchase_order/postData/2';

$route['Persetujuan/Purchase-Order/postData/4']				= 'C_purchase_order/postData/4';

$route['Persetujuan/Purchase-Order/print-PO/(:any)']	= 'C_purchase_order/cetakPDF/$1';

$route['Pembelian/Purchase-Order/(:any)']						= 'C_purchase_order/$1';

$route['Pembelian/Purchase-Order/(:any)/(:any)']				= 'C_purchase_order/$1/$2';



// end PO



// Penerimaan Barang

$route['Gudang/Penerimaan-Barang']								= 'C_penerimaan_barang/view/1';

$route['Gudang/Penerimaan-Barang/loadData']						= 'C_penerimaan_barang/loadData/1';

$route['Gudang/Penerimaan-Barang/Form']							= 'C_penerimaan_barang/getForm1';

$route['Gudang/Penerimaan-Barang/Form/(:any)']					= 'C_penerimaan_barang/getForm1/$1';

$route['Gudang/Penerimaan-Barang/postData']						= 'C_penerimaan_barang/postData/1';

$route['Gudang/Penerimaan-Barang/print-BPB/(:any)']				= 'C_penerimaan_barang/cetakPDF/$1';

$route['Gudang/Penerimaan-Barang/(:any)']								        = 'C_penerimaan_barang/$1';





$route['Gudang/Penerimaan-Barang/print-BPBJ/(:any)']			= 'C_penerimaan_barang/cetakPDFBPBJ/$1';

$route['Gudang/Penerimaan-Barang/loadDataWhere']				= 'C_penerimaan_barang/loadDataWhere/1';

$route['Gudang/Penerimaan-Barang/loadDataSelect']				= 'C_penerimaan_barang/loadData_select';

$route['Pembelian/Penerimaan-Barang']							= 'C_penerimaan_barang/view/2';

$route['Pembelian/Penerimaan-Barang/loadData']					= 'C_penerimaan_barang/loadData/2';

$route['Pembelian/Penerimaan-Barang/checkStatus']				= 'C_penerimaan_barang/checkStatus';

$route['Pembelian/Penerimaan-Barang/Form/(:any)']				= 'C_penerimaan_barang/getForm2/$1';

$route['Pembelian/Penerimaan-Barang/loadDataWhere']				= 'C_penerimaan_barang/loadDataWhere/2';

$route['Pembelian/Penerimaan-Barang/postData']					= 'C_penerimaan_barang/postData/2';

$route['Gudang/Penerimaan-Barang/(:any)']						= 'C_penerimaan_barang/$1';

$route['Gudang/Penerimaan-Barang/(:any)/(:any)']				= 'C_penerimaan_barang/$1/$2';

// end Penerimaan Barang





//RETUR PEMBELIAN

$route['Gudang/Retur-Pembelian']								= 'C_retur_pembelian/view/1';

$route['Gudang/Retur-Pembelian/loadData']						= 'C_retur_pembelian/loadData/1';

$route['Gudang/Retur-Pembelian/Form']							= 'C_retur_pembelian/getForm1';

$route['Gudang/Retur-Pembelian/Form/(:any)']					= 'C_retur_pembelian/getForm1/$1';

$route['Gudang/Retur-Pembelian/postData']						= 'C_retur_pembelian/postData/1';

$route['Gudang/Retur-Pembelian/loadDataWhere']					= 'C_retur_pembelian/loadDataWhere/1';

$route['Gudang/Retur-Pembelian/print-Nota-Retur/(:any)']		= 'C_retur_pembelian/cetakPDF/$1';

$route['Pembelian/Retur-Pembelian']								= 'C_retur_pembelian/view/2';

$route['Pembelian/Retur-Pembelian/loadData']					= 'C_retur_pembelian/loadData/2';

$route['Pembelian/Retur-Pembelian/checkStatus']					= 'C_retur_pembelian/checkStatus';

$route['Pembelian/Retur-Pembelian/Form/(:any)']					= 'C_retur_pembelian/getForm2/$1';

$route['Pembelian/Retur-Pembelian/loadDataWhere']				= 'C_retur_pembelian/loadDataWhere/2';

$route['Pembelian/Retur-Pembelian/postData']					= 'C_retur_pembelian/postData/2';

$route['Pembelian/Retur-Pembelian/loadDataSelect']				= 'C_retur_pembelian/loadData_select';

$route['Pembelian/Retur-Pembelian/print-Nota-Retur/(:any)']		= 'C_retur_pembelian/cetakPDF/$1';

//END RETUR PEMBELIAN



//NOTA DEBET

$route['Pembelian/Nota-Debet']									= 'C_nota_debet/view/1';

$route['Pembelian/Nota-Debet/loadData']							= 'C_nota_debet/loadData/1';

$route['Pembelian/Nota-Debet/Form']								= 'C_nota_debet/getForm1';

$route['Pembelian/Nota-Debet/Form/(:any)']						= 'C_nota_debet/getForm1/$1';

$route['Pembelian/Nota-Debet/postData']							= 'C_nota_debet/postData/1';

$route['Pembelian/Nota-Debet/loadDataWhere']					= 'C_nota_debet/loadDataWhere/1';

$route['Pembelian/Nota-Debet/loadDataSelect']					= 'C_nota_debet/loadData_select';

$route['Pembelian/Nota-Debet/print-Nota-Debet/(:any)']			= 'C_nota_debet/cetakPDF/$1';

$route['Persetujuan/Nota-Debet']								= 'C_nota_debet/view/2';

$route['Persetujuan/Nota-Debet/loadData']						= 'C_nota_debet/loadData/2';

$route['Persetujuan/Nota-Debet/Form/(:any)']					= 'C_nota_debet/getForm2/$1';

$route['Persetujuan/Nota-Debet/checkStatus']					= 'C_nota_debet/checkStatus';

$route['Persetujuan/Nota-Debet/postData']						= 'C_nota_debet/postData/2';

$route['Persetujuan/Nota-Debet/print-Nota-Debet/(:any)']			= 'C_nota_debet/cetakPDF/$1';

//END NOTA DEBET



//SURAT JALAN

$route['Master-Data/surat-jalan']								= 'C_surat_jalan';

$route['Master-Data/surat-jalan/getForm']						= 'C_surat_jalan/getForm';

$route['Master-Data/surat-jalan/postData']						= 'C_surat_jalan/postData';

$route['Gudang/Surat-Jalan']									= 'C_surat_jalan/view/1';

//END SURAT JALAN

$route['Penjualan/Point-of-Sale']							                      = 'C_POS/view';

$route['Penjualan/Point-of-Sale/loadData']						              = 'C_POS/loadData/1';

$route['Penjualan/Point-of-Sale/loadDatadetail/(:any)']						  = 'C_POS/loadDatadetail/$1';

$route['Penjualan/form_penjualan']						                      = 'C_POS/open_page_penjualan';

$route['Penjualan/penjualan_details/(:any)']						            = 'C_POS/penjualan_details/$1';

$route['Penjualan/print/(:any)']						                        = 'C_POS/print_struk/$1';

$route['Penjualan/ViewEndofsheets']						                      = 'C_POS/viewendofsheets';

$route['Penjualan/PilihKasir']						                          = 'C_POS/loaddatakasir';

$route['Penjualan/Pilihcabang']						                          = 'C_POS/loadcabang';

$route['Penjualan/LoadDataWhere']						                        = 'C_POS/loaddatawhere';

$route['Penjualan/Point-of-Sale/getsummarydata']						        = 'C_POS/getsummarydata';

$route['Penjualan/Point-of-Sale/(:any)']							              = 'C_POS/$1';







// Satuan

$route['Master-Data/Satuan']									= 'C_satuan';

$route['Master-Data/Satuan/getForm']							= 'C_satuan/getForm';

$route['Master-Data/Satuan/loadData']							= 'C_satuan/loadData';

$route['Master-Data/Satuan/postData']							= 'C_satuan/postData';

$route['Master-Data/Satuan/deleteData']							= 'C_satuan/deleteData';

$route['Master-Data/Satuan/aktifData']							= 'C_satuan/aktifData';

$route['Master-Data/Satuan/loadDataWhere']						= 'C_satuan/loadDataWhere';

$route['Master-Data/Satuan/loadDataSelect']						= 'C_satuan/loadData_select';

// End Satuan



// LAPORAN

$route['Laporan/Laporan-Harian-Keluar-Barang']									= 'C_laporan/lhkb';

$route['Laporan/Laporan-Harian-Keluar-Barang/loadDataKartuStokKeluar']			= 'C_laporan/loadDatalhkb';

// $route['Laporan/Laporan-Harian-Keluar-Barang/loadDataKartuStokMasuk']		= 'C_laporan/loadDataKartuStokMasuk';

$route['Laporan/Laporan-Harian-Keluar-Barang/Print-LHKB']						= 'C_laporan/cetakPDFlhkb';

$route['Laporan/SPP-Belum-Realisasi']											= 'C_laporan/spp_belum_realisasi';

$route['Laporan/SPP-Belum-Realisasi/loadData']									= 'C_laporan/loadDataspp_belum_realisasi';

$route['Laporan/SPP-Belum-Realisasi/Print-Data/(:any)/(:any)/(:any)/(:any)/(:any)/(:any)/(:any)/(:any)']	= 'C_laporan/cetakPDFspp_belum_realisasi/$1/$2/$3/$4/$5/$6/$7/$8';

// NEW LAPORAN SAMUEL
$route['Laporan/penerimaan-barang']												= 'C_laporan/penerimaan_barang';
$route['Laporan/penerimaan-barang/print']										= 'C_laporan/penerimaan_barang_pdf';
$route['Laporan/penerimaan-barang/loadData']									= 'C_laporan/loadDataPenerimaanBarang';
$route['Laporan/penjualan']														= 'C_laporan/penjualan';
$route['Laporan/penjualan/print']												= 'C_laporan/penjualan_pdf';
$route['Laporan/penjualan/loadData']											= 'C_laporan/loadDataPenjualan';
$route['Laporan/konsinyasi']													= 'C_laporan/konsinyasi';
$route['Laporan/konsinyasi/print']												= 'C_laporan/konsinyasi_pdf';
$route['Laporan/konsinyasi/loadData']											= 'C_laporan/loadDataKonsinyasi';
$route['Laporan/pembelian']														= 'C_laporan/pembelian';
$route['Laporan/pembelian/print']												= 'C_laporan/pembelian_pdf';
$route['Laporan/pembelian/loadData']											= 'C_laporan/loadDataPembelian';


// END LAPORAN



// USER PRIVILEGE

$route['Setting/User-Privilege']							= 'C_user_privilege';

$route['Setting/User-Privilege/loadData']					= 'C_user_privilege/loadData';

$route['Setting/User-Privilege/loadDataWhere']				= 'C_user_privilege/loadDataWhere';

$route['Setting/User-Privilege/postData']					= 'C_user_privilege/postData';

$route['Setting/Edit-User-Privilege/(:any)']				= 'C_user_privilege/getForm/$1';

// USER PRIVILEGE



// USER ACCOUNT

$route['Setting/User-Account']								= 'C_user';

$route['Setting/User-Account/loadData']						= 'C_user/loadData';

$route['Setting/User-Account/deleteData']					= 'C_user/deleteData';

$route['Setting/User-Account/aktifData']					= 'C_user/aktifData';

$route['Setting/User-Account/loadDataWhere']				= 'C_user/loadDataWhere';

$route['Setting/User-Account/postData']						= 'C_user/postData';

$route['Setting/User-Account/getForm']						= 'C_user/getForm';

// USER ACCOUNT



// PERMINTAAN JASA

$route['Produksi/Permintaan-Jasa']							= 'C_permintaan_jasa/view/1';

$route['Produksi/Permintaan-Jasa/Form']						= 'C_permintaan_jasa/getForm1';

$route['Produksi/Permintaan-Jasa/Form/(:any)']				= 'C_permintaan_jasa/getForm1/$1';

$route['Produksi/Permintaan-Jasa/postData']					= 'C_permintaan_jasa/postData/1';

$route['Produksi/Permintaan-Jasa/loadData']					= 'C_permintaan_jasa/loadData/1';

$route['Produksi/Permintaan-Jasa/loadDataWhere']			= 'C_permintaan_jasa/loadDataWhere/1';

$route['Produksi/Permintaan-Jasa/print-PJ/(:any)']			= 'C_permintaan_jasa/cetakPDF/$1';

$route['Gudang/Permintaan-Jasa']							= 'C_permintaan_jasa/view/2';

$route['Gudang/Permintaan-Jasa/loadData']					= 'C_permintaan_jasa/loadData/2';

$route['Gudang/Permintaan-Jasa/postData']					= 'C_permintaan_jasa/postData/1';

$route['Gudang/Permintaan-Jasa/Form/(:any)']				= 'C_permintaan_jasa/getForm2/$1';

$route['Gudang/Permintaan-Jasa/loadDataWhere']				= 'C_permintaan_jasa/loadDataWhere/2';

$route['Gudang/Permintaan-Jasa/checkStatus']				= 'C_permintaan_jasa/checkStatus';

$route['Gudang/Permintaan-Jasa/loadDataSelect']				= 'C_permintaan_jasa/loadData_select';

$route['Gudang/Permintaan-Jasa/print-PJ/(:any)']			= 'C_permintaan_jasa/cetakPDF/$1';

// END PERMINTAAN JASA



// WO

$route['Pembelian/Work-Order']								= 'C_work_order/view/1';

$route['Pembelian/Work-Order/loadData']						= 'C_work_order/loadData/1';

$route['Pembelian/Work-Order/Form']							= 'C_work_order/getForm1';

$route['Pembelian/Work-Order/Form/(:any)']					= 'C_work_order/getForm1/$1';

$route['Pembelian/Work-Order/EditForm/(:any)']				= 'C_work_order/getForm3/$1';

$route['Pembelian/Work-Order/loadDataWhere']				= 'C_work_order/loadDataWhere/1';

$route['Pembelian/Work-Order/postData']						= 'C_work_order/postData/1';

$route['Pembelian/Work-Order/postData/3']					= 'C_work_order/postData/3';

$route['Pembelian/Work-Order/print-WO/(:any)']				= 'C_work_order/cetakPDF/$1';

$route['Pembelian/Work-Order/loadDataSelect']				= 'C_work_order/loadData_select';

$route['Persetujuan/Work-Order']							= 'C_work_order/view/2';

$route['Persetujuan/Work-Order/loadData']					= 'C_work_order/loadData/2';

$route['Persetujuan/Work-Order/Form/(:any)']				= 'C_work_order/getForm2/$1';

$route['Persetujuan/Work-Order/loadDataWhere']				= 'C_work_order/loadDataWhere/2';

$route['Persetujuan/Work-Order/checkStatus']				= 'C_work_order/checkStatus';

$route['Persetujuan/Work-Order/postData']					= 'C_work_order/postData/2';

$route['Persetujuan/Work-Order/postData/4']					= 'C_work_order/postData/4';

$route['Persetujuan/Work-Order/print-WO/(:any)']			= 'C_work_order/cetakPDF/$1';

// end WO



// Surat Jalan

$route['Gudang/Surat-Jalan']								= 'C_surat_jalan/view/1';

$route['Gudang/Surat-Jalan/loadData']						= 'C_surat_jalan/loadData/1';

$route['Gudang/Surat-Jalan/Form']							= 'C_surat_jalan/getForm1';

$route['Gudang/Surat-Jalan/Form/(:any)']					= 'C_surat_jalan/getForm1/$1';

$route['Gudang/Surat-Jalan/loadDataWhere']					= 'C_surat_jalan/loadDataWhere';

$route['Gudang/Surat-Jalan/postData']						= 'C_surat_jalan/postData/1';

$route['Gudang/Surat-Jalan/postData/2']						= 'C_surat_jalan/postData/2';

$route['Gudang/Surat-Jalan/print-SJ/(:any)']				= 'C_surat_jalan/cetakPDF/$1';

$route['Gudang/Surat-Jalan/loadDataSelect']					= 'C_surat_jalan/loadData_select';

$route['Gudang/Surat-Jalan/checkStokWO']					= 'C_surat_jalan/checkStokWO';

$route['Gudang/Surat-Jalan/checkStokNotaDebet']				= 'C_surat_jalan/checkStokNotaDebet';

$route['Penjualan/Surat-Jalan']								= 'C_surat_jalan/view/2';

$route['Penjualan/Surat-Jalan/Form']						= 'C_surat_jalan/getForm2';

$route['Penjualan/Surat-Jalan/Form/(:any)']					= 'C_surat_jalan/getForm2/$1';

$route['Penjualan/Surat-Jalan/postData']					= 'C_surat_jalan/postData/1';

$route['Penjualan/Surat-Jalan/loadData']					= 'C_surat_jalan/loadData/2';

$route['Penjualan/Surat-Jalan/loadDataSelect']				= 'C_surat_jalan/loadData_selectFaktur';

$route['Penjualan/Surat-Jalan/loadDataWhere']				= 'C_surat_jalan/loadDataWhere';

$route['Penjualan/Surat-Jalan/loadDataSelect2']				= 'C_surat_jalan/loadData_selectSJRetur';



$route['Penjualan/Point-of-Sale']							                      = 'C_POS/view';

$route['Penjualan/Point-of-Sale/loadData']						              = 'C_POS/loadData/1';

$route['Penjualan/Point-of-Sale/loadDatadetail/(:any)']						  = 'C_POS/loadDatadetail/$1';

$route['Penjualan/form_penjualan']						                      = 'C_POS/open_page_penjualan';

$route['Penjualan/penjualan_details/(:any)']						            = 'C_POS/penjualan_details/$1';

$route['Penjualan/print/(:any)']						                        = 'C_POS/print_struk/$1';



// $route['Gudang/Surat-Jalan/checkStokSO']					= 'C_surat_jalan/checkStokSO';

// end Surat Jalan



// ESTIMASI PENJUALAN

$route['Penjualan/Estimasi-Penjualan']							= 'C_estimasi_penjualan/view/1';

$route['Penjualan/Estimasi-Penjualan/loadData']					= 'C_estimasi_penjualan/loadData/1';

$route['Penjualan/Estimasi-Penjualan/Form']						= 'C_estimasi_penjualan/getForm1';

$route['Penjualan/Estimasi-Penjualan/Form/(:any)']				= 'C_estimasi_penjualan/getForm1/$1';

$route['Penjualan/Estimasi-Penjualan/loadDataWhere']			= 'C_estimasi_penjualan/loadDataWhere';

$route['Penjualan/Estimasi-Penjualan/postData']					= 'C_estimasi_penjualan/postData/1';

$route['Penjualan/Estimasi-Penjualan/postData/2']				= 'C_estimasi_penjualan/postData/2';

$route['Penjualan/Estimasi-Penjualan/print-Estimasi/(:any)']	= 'C_estimasi_penjualan/cetakPDF/$1';

$route['Penjualan/Estimasi-Penjualan/loadDataSelect']			= 'C_estimasi_penjualan/loadData_select';

$route['Persetujuan/Estimasi-Penjualan']						= 'C_estimasi_penjualan/view/2';

$route['Persetujuan/Estimasi-Penjualan/loadData']				= 'C_estimasi_penjualan/loadData/2';

$route['Persetujuan/Estimasi-Penjualan/Form/(:any)']			= 'C_estimasi_penjualan/getForm2/$1';

$route['Persetujuan/Estimasi-Penjualan/loadDataWhere']			= 'C_estimasi_penjualan/loadDataWhere/2';

$route['Persetujuan/Estimasi-Penjualan/checkStatus']			= 'C_estimasi_penjualan/checkStatus';

$route['Persetujuan/Estimasi-Penjualan/postData']				= 'C_estimasi_penjualan/postData/2';

$route['Persetujuan/Estimasi-Penjualan/print-Estimasi/(:any)']	= 'C_estimasi_penjualan/cetakPDF/$1';

// end ESTIMASI PENJUALAN



// JADWAL PRODUKSI

$route['Produksi/Jadwal-Produksi']							= 'C_jadwal_produksi/view/1';

$route['Produksi/Jadwal-Produksi/loadData']					= 'C_jadwal_produksi/loadData/1';

$route['Produksi/Jadwal-Produksi/Form']						= 'C_jadwal_produksi/getForm1';

$route['Produksi/Jadwal-Produksi/Form/(:any)']				= 'C_jadwal_produksi/getForm1/$1';

$route['Produksi/Jadwal-Produksi/postData']					= 'C_jadwal_produksi/postData/1';

$route['Produksi/Jadwal-Produksi/loadDataWhere']			= 'C_jadwal_produksi/loadDataWhere';

$route['Produksi/Jadwal-Produksi/loadDataSelect']			= 'C_jadwal_produksi/loadData_select';

$route['Produksi/Jadwal-Produksi/loadDataSelect2']			= 'C_jadwal_produksi/loadData_select2';

$route['Produksi/Jadwal-Produksi/loadDataSelectBahanAwal']	= 'C_jadwal_produksi/loadData_selectBahanAwal';

$route['Produksi/Jadwal-Produksi/loadDataDetailSatuan']		= 'C_jadwal_produksi/loadDataDetail1Where';

$route['Produksi/Jadwal-Produksi/loadDataQtyAwalWhere']		= 'C_jadwal_produksi/loadDataQtyAwalWhere';

$route['Produksi/Jadwal-Produksi/print-Jadwal/(:any)']		= 'C_jadwal_produksi/cetakPDF/$1';



$route['Persetujuan/Jadwal-Produksi']						= 'C_jadwal_produksi/view/2';

$route['Persetujuan/Jadwal-Produksi/loadData']				= 'C_jadwal_produksi/loadData/2loalo';

$route['Persetujuan/Jadwal-Produksi/Form']					= 'C_jadwal_produksi/getForm2';

$route['Persetujuan/Jadwal-Produksi/Form/(:any)']			= 'C_jadwal_produksi/getForm2/$1';

$route['Persetujuan/Jadwal-Produksi/postData']				= 'C_jadwal_produksi/postData/2';

$route['Persetujuan/Jadwal-Produksi/loadDataWhere']			= 'C_jadwal_produksi/loadDataWhere';



// $route['Persetujuan/Jadwal-Produksi/loadDataSelect']		= 'C_jadwal_produksi/loadData_select';

// $route['Persetujuan/Jadwal-Produksi/loadDataSelect2']		= 'C_jadwal_produksi/loadData_select2';

$route['Persetujuan/Jadwal-Produksi/loadDataDetailSatuan']	= 'C_jadwal_produksi/loadDataDetail1Where';

$route['Persetujuan/Jadwal-Produksi/print-Jadwal/(:any)']	= 'C_jadwal_produksi/cetakPDF/$1';

// end JADWAL PRODUKSI



// PERHITUNGAN KEBUTUHAN BAHAN

$route['Produksi/Perhitungan-Kebutuhan-Bahan']							= 'C_perhitungan_kebutuhan/view/1';

$route['Produksi/Perhitungan-Kebutuhan-Bahan/loadData']					= 'C_perhitungan_kebutuhan/loadData/1';

$route['Produksi/Perhitungan-Kebutuhan-Bahan/Form']						= 'C_perhitungan_kebutuhan/getForm1';

$route['Produksi/Perhitungan-Kebutuhan-Bahan/Form/(:any)']				= 'C_perhitungan_kebutuhan/getForm1/$1';

$route['Produksi/Perhitungan-Kebutuhan-Bahan/postData']					= 'C_perhitungan_kebutuhan/postData/1';

$route['Produksi/Perhitungan-Kebutuhan-Bahan/loadDataWhere']			= 'C_perhitungan_kebutuhan/loadDataWhere/1';

$route['Produksi/Perhitungan-Kebutuhan-Bahan/loadDataWhere2']			= 'C_perhitungan_kebutuhan/loadDataWhere/2';

$route['Produksi/Perhitungan-Kebutuhan-Bahan/loadDataDetailWhere']		= 'C_perhitungan_kebutuhan/loadDataDetailWhere';

$route['Produksi/Perhitungan-Kebutuhan-Bahan/loadDataSelect']			= 'C_perhitungan_kebutuhan/loadData_select';

$route['Produksi/Perhitungan-Kebutuhan-Bahan/loadDataDetailSatuan']		= 'C_perhitungan_kebutuhan/loadDataDetail1Where';

$route['Produksi/Perhitungan-Kebutuhan-Bahan/print-Perhitungan/(:any)']	= 'C_perhitungan_kebutuhan/cetakPDF/$1';



$route['Gudang/Perhitungan-Kebutuhan-Bahan']							= 'C_perhitungan_kebutuhan/view/2';

$route['Gudang/Perhitungan-Kebutuhan-Bahan/loadData']					= 'C_perhitungan_kebutuhan/loadData/2';

$route['Gudang/Perhitungan-Kebutuhan-Bahan/Form/(:any)']				= 'C_perhitungan_kebutuhan/getForm2/$1';

$route['Gudang/Perhitungan-Kebutuhan-Bahan/postData']					= 'C_perhitungan_kebutuhan/postData/2';

$route['Gudang/Perhitungan-Kebutuhan-Bahan/checkStatus']				= 'C_perhitungan_kebutuhan/checkStatus';



$route['Persetujuan/Perhitungan-Kebutuhan-Bahan']						= 'C_perhitungan_kebutuhan/view/3';

$route['Persetujuan/Perhitungan-Kebutuhan-Bahan/loadData']				= 'C_perhitungan_kebutuhan/loadData/3';

$route['Persetujuan/Perhitungan-Kebutuhan-Bahan/Form/(:any)']			= 'C_perhitungan_kebutuhan/getForm3/$1';

$route['Persetujuan/Perhitungan-Kebutuhan-Bahan/postData']				= 'C_perhitungan_kebutuhan/postData/3';

// end PERHITUNGAN KEBUTUHAN BAHAN



// KETIDAKSESUAIAN SPESIFIKASI

$route['Produksi/Ketidaksesuaian-Spesifikasi']						= 'C_ketidaksesuaian_spesifikasi/view/1';

$route['Produksi/Ketidaksesuaian-Spesifikasi/loadData']				= 'C_ketidaksesuaian_spesifikasi/loadData/1';

$route['Produksi/Ketidaksesuaian-Spesifikasi/Form']					= 'C_ketidaksesuaian_spesifikasi/getForm1';

$route['Produksi/Ketidaksesuaian-Spesifikasi/Form/(:any)']			= 'C_ketidaksesuaian_spesifikasi/getForm1/$1';

$route['Produksi/Ketidaksesuaian-Spesifikasi/postData']				= 'C_ketidaksesuaian_spesifikasi/postData/1';

$route['Produksi/Ketidaksesuaian-Spesifikasi/loadDataWhere']		= 'C_ketidaksesuaian_spesifikasi/loadDataWhere';

$route['Produksi/Ketidaksesuaian-Spesifikasi/loadDataDetailWhere']	= 'C_ketidaksesuaian_spesifikasi/loadDataDetailWhere';

$route['Produksi/Ketidaksesuaian-Spesifikasi/print-Ketidaksesuaian-Spesifikasi/(:any)']= 'C_ketidaksesuaian_spesifikasi/cetakPDF/$1';

// end KETIDAKSESUAIAN SPESIFIKASI



// PEROLEHAN PRODUKSI

$route['Produksi/Perolehan-Produksi']									= 'C_perolehan_produksi/view/1';

$route['Produksi/Perolehan-Produksi/loadData']							= 'C_perolehan_produksi/loadData/1';

$route['Produksi/Perolehan-Produksi/Form']								= 'C_perolehan_produksi/getForm1';

$route['Produksi/Perolehan-Produksi/Form/(:any)']						= 'C_perolehan_produksi/getForm1/$1';

$route['Produksi/Perolehan-Produksi/postData']							= 'C_perolehan_produksi/postData/1';

$route['Produksi/Perolehan-Produksi/loadDataWhere']						= 'C_perolehan_produksi/loadDataWhere/1';

$route['Produksi/Perolehan-Produksi/loadDataWhere2']					= 'C_perolehan_produksi/loadDataWhere/2';

$route['Produksi/Perolehan-Produksi/loadDataSelect']					= 'C_perolehan_produksi/loadData_select';

$route['Produksi/Perolehan-Produksi/loadDataSelect2']					= 'C_perolehan_produksi/loadData_selectFKS';

$route['Produksi/Perolehan-Produksi/print-Perolehan-Produksi/(:any)']	= 'C_perolehan_produksi/cetakPDF/$1';

$route['Produksi/Perolehan-Produksi/loadDataAwalWhere']					= 'C_perolehan_produksi/loadDataAwalWhere';

$route['Produksi/Perolehan-Produksi/loadDataAkhirWhere']				= 'C_perolehan_produksi/loadDataAkhirWhere';

// end PEROLEHAN PRODUKSI



// PENGUBAHAN BAHAN

$route['Produksi/Pengubahan-Bahan']										= 'C_pengubahan_bahan/view/1';

$route['Produksi/Pengubahan-Bahan/loadData']							= 'C_pengubahan_bahan/loadData/1';

$route['Produksi/Pengubahan-Bahan/Form']								= 'C_pengubahan_bahan/getForm1';

$route['Produksi/Pengubahan-Bahan/Form/(:any)']							= 'C_pengubahan_bahan/getForm1/$1';

$route['Produksi/Pengubahan-Bahan/postData']							= 'C_pengubahan_bahan/postData/1';

$route['Produksi/Pengubahan-Bahan/loadDataWhere']						= 'C_pengubahan_bahan/loadDataWhere';

$route['Produksi/Pengubahan-Bahan/loadDataSelect']						= 'C_pengubahan_bahan/loadData_select';

$route['Produksi/Pengubahan-Bahan/loadDataSelect2']						= 'C_pengubahan_bahan/loadData_select2';

$route['Produksi/Pengubahan-Bahan/print-Pengubahan-Bahan/(:any)']		= 'C_pengubahan_bahan/cetakPDF/$1';



$route['Accounting/Pengubahan-Bahan']									= 'C_pengubahan_bahan/view/2';

$route['Accounting/Pengubahan-Bahan/loadData']							= 'C_pengubahan_bahan/loadData/2';

$route['Accounting/Pengubahan-Bahan/loadDataWhere']						= 'C_pengubahan_bahan/loadDataWhere';

$route['Accounting/Pengubahan-Bahan/Form/(:any)']						= 'C_pengubahan_bahan/getForm2/$1';

// $route['Accounting/Pengubahan-Bahan/postData']							= 'C_pengubahan_bahan/postData/2';

// $route['Accounting/Pengubahan-Bahan/checkStatus']						= 'C_pengubahan_bahan/checkStatus';

$route['Accounting/Pengubahan-Bahan/print-Pengubahan-Bahan/(:any)']		= 'C_pengubahan_bahan/cetakPDF/$1';



$route['Persetujuan/Pengubahan-Bahan']									= 'C_pengubahan_bahan/view/3';

$route['Persetujuan/Pengubahan-Bahan/loadData']							= 'C_pengubahan_bahan/loadData/3';

$route['Persetujuan/Pengubahan-Bahan/loadDataWhere']					= 'C_pengubahan_bahan/loadDataWhere';

$route['Persetujuan/Pengubahan-Bahan/Form/(:any)']						= 'C_pengubahan_bahan/getForm3/$1';

$route['Persetujuan/Pengubahan-Bahan/postData']							= 'C_pengubahan_bahan/postData/2';

$route['Persetujuan/Pengubahan-Bahan/checkStatus']						= 'C_pengubahan_bahan/checkStatus';

$route['Persetujuan/Pengubahan-Bahan/print-Pengubahan-Bahan/(:any)']	= 'C_pengubahan_bahan/cetakPDF/$1';

// end PENGUBAHAN BAHAN



// SERAH TERIMA

$route['Produksi/Serah-Terima']									= 'C_serah_terima/view/1';

$route['Produksi/Serah-Terima/loadData']						= 'C_serah_terima/loadData/1';

$route['Produksi/Serah-Terima/Form']							= 'C_serah_terima/getForm1';

$route['Produksi/Serah-Terima/Form/(:any)']						= 'C_serah_terima/getForm1/$1';

$route['Produksi/Serah-Terima/postData']						= 'C_serah_terima/postData/1';

$route['Produksi/Serah-Terima/loadDataWhere']					= 'C_serah_terima/loadDataWhere';

$route['Produksi/Serah-Terima/loadDataSelect']					= 'C_serah_terima/loadData_select';

$route['Produksi/Serah-Terima/loadDataSelect2']					= 'C_serah_terima/loadData_select2';

$route['Produksi/Serah-Terima/print-Serah-Terima/(:any)']		= 'C_serah_terima/cetakPDF/$1';



$route['Gudang/Serah-Terima']									= 'C_serah_terima/view/2';

$route['Gudang/Serah-Terima/loadData']							= 'C_serah_terima/loadData/2';

$route['Gudang/Serah-Terima/loadDataWhere']						= 'C_serah_terima/loadDataWhere';

$route['Gudang/Serah-Terima/Form/(:any)']						= 'C_serah_terima/getForm2/$1';

$route['Gudang/Serah-Terima/postData']							= 'C_serah_terima/postData/2';

$route['Gudang/Serah-Terima/checkStatus']						= 'C_serah_terima/checkStatus';

$route['Gudang/Serah-Terima/print-Serah-Terima/(:any)']			= 'C_serah_terima/cetakPDF/$1';

// end SERAH TERIMA



// PENGEMBALIAN BARANG

$route['Produksi/Pengembalian-Barang']										= 'C_pengembalian_barang/view/1';

$route['Produksi/Pengembalian-Barang/loadData']								= 'C_pengembalian_barang/loadData/1';

$route['Produksi/Pengembalian-Barang/Form']									= 'C_pengembalian_barang/getForm1';

$route['Produksi/Pengembalian-Barang/Form/(:any)']							= 'C_pengembalian_barang/getForm1/$1';

$route['Produksi/Pengembalian-Barang/postData']								= 'C_pengembalian_barang/postData/1';

$route['Produksi/Pengembalian-Barang/loadDataWhere']						= 'C_pengembalian_barang/loadDataWhere';

$route['Produksi/Pengembalian-Barang/loadDataSelect']						= 'C_pengembalian_barang/loadData_select';

$route['Produksi/Pengembalian-Barang/loadDataSelect2']						= 'C_pengembalian_barang/loadData_select2';

$route['Produksi/Pengembalian-Barang/print-Pengembalian-Barang/(:any)']		= 'C_pengembalian_barang/cetakPDF/$1';



$route['Gudang/Pengembalian-Barang']										= 'C_pengembalian_barang/view/2';

$route['Gudang/Pengembalian-Barang/loadData']								= 'C_pengembalian_barang/loadData/2';

$route['Gudang/Pengembalian-Barang/loadDataWhere']							= 'C_pengembalian_barang/loadDataWhere';

$route['Gudang/Pengembalian-Barang/Form/(:any)']							= 'C_pengembalian_barang/getForm2/$1';

$route['Gudang/Pengembalian-Barang/postData']								= 'C_pengembalian_barang/postData/2';

$route['Gudang/Pengembalian-Barang/checkStatus']							= 'C_pengembalian_barang/checkStatus';

$route['Gudang/Pengembalian-Barang/print-Pengembalian-Barang/(:any)']		= 'C_pengembalian_barang/cetakPDF/$1';

// end PENGEMBALIAN BARANG



// PURCHASE ORDER CUSTOMER

$route['Marketing/Purchase-Order-Customer']									= 'C_purchase_order_customer/view/1';

$route['Marketing/Purchase-Order-Customer/loadData']						= 'C_purchase_order_customer/loadData/1';

$route['Marketing/Purchase-Order-Customer/Form']							= 'C_purchase_order_customer/getForm1';

$route['Marketing/Purchase-Order-Customer/Form/(:any)']						= 'C_purchase_order_customer/getForm1/$1';

$route['Marketing/Purchase-Order-Customer/postData']						= 'C_purchase_order_customer/postData/1';

$route['Marketing/Purchase-Order-Customer/loadDataWhere']					= 'C_purchase_order_customer/loadDataWhere/1';

$route['Marketing/Purchase-Order-Customer/print-PO-Customer/(:any)']		= 'C_purchase_order_customer/cetakPDF/$1';

$route['Persetujuan/Purchase-Order-Customer']								= 'C_purchase_order_customer/view/2';

$route['Persetujuan/Purchase-Order-Customer/loadData']						= 'C_purchase_order_customer/loadData/2';

$route['Persetujuan/Purchase-Order-Customer/Form/(:any)']					= 'C_purchase_order_customer/getForm2/$1';

$route['Persetujuan/Purchase-Order-Customer/postData']						= 'C_purchase_order_customer/postData/1';

$route['Persetujuan/Purchase-Order-Customer/loadDataSelect']				= 'C_purchase_order_customer/loadData_select/1';

$route['Persetujuan/Purchase-Order-Customer/print-PO-Customer/(:any)']		= 'C_purchase_order_customer/cetakPDF/$1';

// end PURCHASE ORDER CUSTOMER



// SALES ORDER

$route['Penjualan/Sales-Order-Customer']									= 'C_sales_order_customer/view/1';

$route['Penjualan/Sales-Order-Customer/loadData']							= 'C_sales_order_customer/loadData/1';

$route['Penjualan/Sales-Order-Customer/Form']								= 'C_sales_order_customer/getForm1';

$route['Penjualan/Sales-Order-Customer/Form/(:any)']						= 'C_sales_order_customer/getForm1/$1';

$route['Penjualan/Sales-Order-Customer/postData']							= 'C_sales_order_customer/postData/1';

$route['Penjualan/Sales-Order-Customer/loadDataWhere']						= 'C_sales_order_customer/loadDataWhere/1';

$route['Penjualan/Sales-Order-Customer/loadDataWhere2']						= 'C_sales_order_customer/loadDataWhere/2';

$route['Penjualan/Sales-Order-Customer/print-SO-Customer/(:any)']			= 'C_sales_order_customer/cetakPDF/$1';

$route['Persetujuan/Sales-Order-Customer']									= 'C_sales_order_customer/view/2';

$route['Persetujuan/Sales-Order-Customer/loadData']							= 'C_sales_order_customer/loadData/2';

$route['Persetujuan/Sales-Order-Customer/Form']								= 'C_sales_order_customer/getForm2';

$route['Persetujuan/Sales-Order-Customer/Form/(:any)']						= 'C_sales_order_customer/getForm2/$1';

$route['Persetujuan/Sales-Order-Customer/postData']							= 'C_sales_order_customer/postData/2';

$route['Persetujuan/Sales-Order-Customer/loadDataSelect']					= 'C_sales_order_customer/loadData_select/1';

$route['Persetujuan/Sales-Order-Customer/loadDataSelect2']					= 'C_sales_order_customer/loadData_select/2';

$route['Produksi/Sales-Order-Customer']										= 'C_sales_order_customer/view/3';

$route['Produksi/Sales-Order-Customer/loadData']							= 'C_sales_order_customer/loadData/3';

$route['Produksi/Sales-Order-Customer/Form']								= 'C_sales_order_customer/getForm3';

$route['Produksi/Sales-Order-Customer/Form/(:any)']							= 'C_sales_order_customer/getForm3/$1';

// end SALES ORDER



// INVOICE SO

$route['Penjualan/Faktur-Penjualan']										= 'C_faktur_penjualan/view/1';

$route['Penjualan/Faktur-Penjualan/loadData']								= 'C_faktur_penjualan/loadData/1';

$route['Penjualan/Faktur-Penjualan/Form']									= 'C_faktur_penjualan/getForm1';

$route['Penjualan/Faktur-Penjualan/Form/(:any)']							= 'C_faktur_penjualan/getForm1/$1';

$route['Penjualan/Faktur-Penjualan/postData']								= 'C_faktur_penjualan/postData/1';

$route['Penjualan/Faktur-Penjualan/loadDataWhere']							= 'C_faktur_penjualan/loadDataWhere/1';

$route['Penjualan/Faktur-Penjualan/loadDataSelect']							= 'C_faktur_penjualan/loadData_select/1';

$route['Penjualan/Faktur-Penjualan/print-Faktur-Penjualan/(:any)']			= 'C_faktur_penjualan/cetakPDF/$1';

// end INVOICE SO



// SURAT JALAN RETUR JUAL

$route['Penjualan/Surat-Jalan-Retur']										= 'C_surat_jalan_retur/view/1';

$route['Penjualan/Surat-Jalan-Retur/loadData']								= 'C_surat_jalan_retur/loadData/1';

$route['Penjualan/Surat-Jalan-Retur/Form']									= 'C_surat_jalan_retur/getForm1';

$route['Penjualan/Surat-Jalan-Retur/Form/(:any)']							= 'C_surat_jalan_retur/getForm1/$1';

$route['Penjualan/Surat-Jalan-Retur/postData']								= 'C_surat_jalan_retur/postData/1';

$route['Penjualan/Surat-Jalan-Retur/loadDataWhere']							= 'C_surat_jalan_retur/loadDataWhere/1';

$route['Penjualan/Surat-Jalan-Retur/loadDataSelect']						= 'C_surat_jalan_retur/loadData_select/1';

$route['Penjualan/Surat-Jalan-Retur/print-SJ/(:any)']						= 'C_surat_jalan_retur/cetakPDF/$1';

// end SURAT JALAN RETUR JUAL



// NOTA KREDIT

$route['Penjualan/Nota-Kredit']												= 'C_nota_kredit/view/1';

$route['Penjualan/Nota-Kredit/loadData']									= 'C_nota_kredit/loadData/1';

$route['Penjualan/Nota-Kredit/Form']										= 'C_nota_kredit/getForm1';

$route['Penjualan/Nota-Kredit/Form/(:any)']									= 'C_nota_kredit/getForm1/$1';

$route['Penjualan/Nota-Kredit/postData']									= 'C_nota_kredit/postData/1';

$route['Penjualan/Nota-Kredit/loadDataWhere']								= 'C_nota_kredit/loadDataWhere/1';

$route['Penjualan/Nota-Kredit/loadDataSelect']								= 'C_nota_kredit/loadData_select/1';

$route['Penjualan/Nota-Kredit/print-Nota-Kredit/(:any)']					= 'C_nota_kredit/cetakPDF/$1';

// end NOTA KREDIT



// KLAIM/RETUR PENJUALAN

$route['Marketing/Klaim-Retur-Penjualan']									= 'C_retur_penjualan/view/1';

$route['Marketing/Klaim-Retur-Penjualan/loadData']							= 'C_retur_penjualan/loadData/1';

$route['Marketing/Klaim-Retur-Penjualan/Form']								= 'C_retur_penjualan/getForm1';

$route['Marketing/Klaim-Retur-Penjualan/Form/(:any)']						= 'C_retur_penjualan/getForm1/$1';

$route['Marketing/Klaim-Retur-Penjualan/postData']							= 'C_retur_penjualan/postData/1';

$route['Marketing/Klaim-Retur-Penjualan/loadDataWhere']						= 'C_retur_penjualan/loadDataWhere/1';

$route['Penjualan/Klaim-Retur-Penjualan']									= 'C_retur_penjualan/view/2';

$route['Penjualan/Klaim-Retur-Penjualan/loadData']							= 'C_retur_penjualan/loadData/2';

$route['Penjualan/Klaim-Retur-Penjualan/Form/(:any)']						= 'C_retur_penjualan/getForm2/$1';

$route['Penjualan/Klaim-Retur-Penjualan/postData']							= 'C_retur_penjualan/postData/1';

$route['Penjualan/Klaim-Retur-Penjualan/print-Klaim-Retur/(:any)']			= 'C_retur_penjualan/cetakPDF/$1';

$route['Persetujuan/Klaim-Retur-Penjualan']									= 'C_retur_penjualan/view/3';

$route['Persetujuan/Klaim-Retur-Penjualan/loadData']						= 'C_retur_penjualan/loadData/3';

$route['Persetujuan/Klaim-Retur-Penjualan/Form/(:any)']						= 'C_retur_penjualan/getForm3/$1';

$route['Persetujuan/Klaim-Retur-Penjualan/postData']						= 'C_retur_penjualan/postData/1';

$route['Persetujuan/Klaim-Retur-Penjualan/loadDataSelect']					= 'C_retur_penjualan/loadData_select/1';

$route['Persetujuan/Klaim-Retur-Penjualan/loadDataSelect2']					= 'C_retur_penjualan/loadData_select/2';

// end KLAIM/RETUR PENJUALAN



// BPBR

$route['Gudang/Penerimaan-Barang-Retur']									= 'C_penerimaan_barang_retur/view/1';

$route['Gudang/Penerimaan-Barang-Retur/loadData']							= 'C_penerimaan_barang_retur/loadData/1';

$route['Gudang/Penerimaan-Barang-Retur/Form']								= 'C_penerimaan_barang_retur/getForm1';

$route['Gudang/Penerimaan-Barang-Retur/Form/(:any)']						= 'C_penerimaan_barang_retur/getForm1/$1';

$route['Gudang/Penerimaan-Barang-Retur/postData']							= 'C_penerimaan_barang_retur/postData/1';

$route['Gudang/Penerimaan-Barang-Retur/loadDataWhere']						= 'C_penerimaan_barang_retur/loadDataWhere/1';

$route['Gudang/Penerimaan-Barang-Retur/loadDataSelect']						= 'C_penerimaan_barang_retur/loadData_select/1';

// end BPBR





// custom js route javascript

$route['Master-Barang/Getbrand']						= 'C_barang/loadDataSelectBrand';

$route['Master-Barang/CheckNamabarang']						= 'C_barang/checknamabarang';

