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
$route['default_controller'] = 'dashboard';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

$route['nilai-mata-kuliah-by-mahasiswa'] = 'NilaiMataKuliahByMahasiswa/index';

/* Router Master Mahasiswa */
$route['mahasiswa'] = 'Mahasiswa';
$route['mahasiswa/create'] = 'Mahasiswa/create';
$route['mahasiswa/upload'] = 'MahasiswaUpload';
$route['mahasiswa/upload-process'] = 'MahasiswaUpload/create';
$route['mahasiswa/update'] = 'Mahasiswa/update';
$route['mahasiswa/delete'] = 'Mahasiswa/delete';

/* Router Master Matakuliah */
$route['mata-kuliah'] = 'MataKuliah';
$route['mata-kuliah/create'] = 'MataKuliah/create';
$route['mata-kuliah/update'] = 'MataKuliah/update';
$route['mata-kuliah/delete'] = 'MataKuliah/delete';

/* Router Master Dosen */
$route['dosen'] = 'Dosen';
$route['dosen/create'] = 'Dosen/create';
$route['dosen/update'] = 'Dosen/update';
$route['dosen/delete'] = 'Dosen/delete';

/* Router Master Skor Maks */
$route['skor-maks'] = 'SkorMaks';
$route['skor-maks/create'] = 'SkorMaks/create';
$route['skor-maks/update'] = 'SkorMaks/update';
$route['skor-maks/delete'] = 'SkorMaks/delete';

/* Router Master Klasifikasi */
$route['klasifikasi'] = 'Klasifikasi';
$route['klasifikasi/create'] = 'Klasifikasi/create';
$route['klasifikasi/update'] = 'Klasifikasi/update';
$route['klasifikasi/delete'] = 'Klasifikasi/delete';

/* Router Master Harkat */
$route['harkat'] = 'Harkat';
$route['harkat/create'] = 'Harkat/create';
$route['harkat/update'] = 'Harkat/update';
$route['harkat/delete'] = 'Harkat/delete';

/* Router Master Kelas */
$route['kelas'] = 'Kelas';
$route['kelas/create'] = 'Kelas/create';
$route['kelas/update'] = 'Kelas/update';
$route['kelas/delete'] = 'Kelas/delete';

/* Router Master Capaian Pembelajaran Lulusan */
$route['capaian-pembelajaran-lulusan'] = 'CapaianPembelajaranLulusan';
$route['capaian-pembelajaran-lulusan/create'] = 'CapaianPembelajaranLulusan/create';
$route['capaian-pembelajaran-lulusan/update'] = 'CapaianPembelajaranLulusan/update';
$route['capaian-pembelajaran-lulusan/delete'] = 'CapaianPembelajaranLulusan/delete';

/* Router Master Tahun Akademik */
$route['tahun-akademik'] = 'TahunAkademik';
$route['tahun-akademik/create'] = 'TahunAkademik/create';
$route['tahun-akademik/update'] = 'TahunAkademik/update';
$route['tahun-akademik/delete'] = 'TahunAkademik/delete';

/* Router Dosen Pengampu */
$route['dosen-pengampu'] = 'DosenPengampu';
$route['dosen-pengampu/detail'] = 'DosenPengampu/detail';

/* Router Jadwal Perkuliahan */
$route['jadwal-perkuliahan'] = 'JadwalPerkuliahan';
$route['jadwal-perkuliahan/detail'] = 'JadwalPerkuliahan/detail';
$route['jadwal-perkuliahan/upload-nilai'] = 'JadwalPerkuliahanUploadNilai';
$route['jadwal-perkuliahan/upload-nilai-process'] = 'JadwalPerkuliahanUploadNilai/create';

/* Router Khs Kumulatif */
$route['khs-kumulatif'] = 'KhsKumulatif';

/* Router Khs Kumulatif Upload Nilai */
$route['khs-kumulatif-upload-nilai'] = 'KhsKumulatifUploadNilai';
$route['khs-kumulatif-upload-nilai/process'] = 'KhsKumulatifUploadNilai/upload';

/* Router Laporan Nilai Mata Kuliah */
$route['nilai-mata-kuliah'] = 'NilaiMataKuliah';

/* Laporan Evaluasi Mandiri */
$route['evaluasi-mandiri'] = 'EvaluasiMandiri';
$route['evaluasi-mandiri/laporan'] = 'EvaluasiMandiri/laporan';

/* Laporan Hasil Evaluasi Mandiri */
$route['hasil-evaluasi-mandiri'] = 'EvaluasiMandiriHasil';
$route['hasil-evaluasi-mandiri/laporan'] = 'EvaluasiMandiriHasil/laporan';

/* Router Master User Management */
$route['user-management'] = 'UserManagement';
$route['user-management/create'] = 'UserManagement/create';
$route['user-management/update'] = 'UserManagement/update';
$route['user-management/delete'] = 'UserManagement/delete';

/* Router Master User Role */
$route['user-role'] = 'UserRole';
$route['user-role/create'] = 'UserRole/create';
$route['user-role/update'] = 'UserRole/update';
$route['user-role/delete'] = 'UserRole/delete';

/* Router Master User Permission */
$route['user-permission'] = 'UserPermission';
$route['user-permission/create'] = 'UserPermission/create';
$route['user-permission/update'] = 'UserPermission/update';
$route['user-permission/delete'] = 'UserPermission/delete';

/* Router Pengaturan Sistem */
$route['pengaturan-sistem'] = 'PengaturanSistem';
$route['pengaturan-sistem/update'] = 'PengaturanSistem/update';
