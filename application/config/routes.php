<?php
defined('BASEPATH') or exit('No direct script access allowed');


$route['logout'] = 'users/logout';
//akun
$route['home'] = 'users/home';

//pemiliki
$route['pemilik_daftarsales'] = 'pemilik/daftarsales';
$route['pemilik_daftarproduk'] = 'pemilik/daftarproduk';
$route['pemilik_bahanbaku'] = 'pemilik/bahan_baku';
$route['pemilik_daftar_thr'] = 'pemilik/lihat_thr';
$route['pemilik_profile']='pemilik/lihat_profile';
$route['riwayat_pemesanan']='pemilik/riwayat_pemesanan';
$route['laporan_keuangan']='pemilik/laporan_keuangan';
//produk
$route['pemilik_buatproduk']='pemilik/buatproduk';
$route['produk/hapus/(:any)'] = 'produk/hapus/$1';
$route['create_akun']='pemilik/create_akun';
$route['pesan_bahan_baku']='pemilik/pesan_bahan_baku';
$route['permintaan_sales']='pemilik/lihat_daftar_pemesanan';
$route['pemesanan/produk/(:any)/(:any)']='pemesanan_produk/setujui/$1/$2';
$route['konfirmasi_pembayaran/(:any)']='riwayat_pemesanan/pembayaran_selesai/$1';
$route['tolak_pemesanan_produk']='pemesanan_produk/tolak_pemesanan';
//bahan baku
$route['pemilik_daftar_p_bahan_baku']='users/daftar_p_bahan_baku';
$route['edit_bahan_baku']='bahan_baku/edit_bahan_baku';
$route['bahan_baku/konfirmasi/(:any)/(:any)']='bahan_baku/konfirmasi/$1/$2';
//tunjangan
$route['pemilik_tunjangan']='users/buat_tunjangan';
$route['cetak_laporan_keuangan']='pemilik/cetak_laporan_keuangan';
//pengguna
$route['ProfileUKM']='Users/profileukm';
$route['VisimisiUKM'] ='Users/Visimisiukm';
$route['Lihatproduk']='Users/Lihatproduk';
$route['LihatDaftarsales']='Users/lihatdaftarsales';
$route['halaman_login']='Users/halaman_login';
$route['lupapassword']='Users/halaman_lupapassword';

//sales
$route['sales_home']='sales/home';
$route['pesan_produk']='sales/halaman_pesan_produk';
$route['lihat_profile']='sales/lihat_profile';
$route['lihat_r_pemesanan']='sales/lihat_r_pemesanan';
$route['lihat_thr']='sales/lihat_thr';
//supplier
$route['supplier_home']='supplier/home';
$route['supplier_lihat_profile']='supplier/lihat_profile';
$route['supplier_permintaan_bahan_baku']='supplier/daftar_permintaan_b_baku';
$route['supplier_daftar_bahan_baku']='supplier/daftar_b_baku';
$route['supplier_buat_bahan_baku']='supplier/buat_b_baku';
$route['bahan_baku/hapus/(:any)']='supplier/hapus_b_baku/$1';
$route['edit_bahan_baku_supplier']='bahan_baku_supplier/edit_bahan_baku_supplier';
$route['tolak_permintaan_b_baku']='supplier/tolak_permintaan_b_baku';
$route['setujui_permintaan_b_baku']='supplier/setujui_permintaan_b_baku';
// routing for posts
$route['posts/index'] = 'posts/index';
$route['posts/update'] = 'posts/update';
$route['posts/create'] = 'posts/create';
$route['posts/(:any)'] = 'posts/view/$1';
$route['posts'] = 'posts/index';
// Main Page
$route['default_controller'] = 'users/index';
$route['(:any)'] = 'users/index/$1';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
