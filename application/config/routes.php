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

/* Route auth */
$route['auth'] = 'Auth';
$route['auth/logout'] = 'Auth/logout';
$route['auth/proses-login'] = 'Auth/prosesLogin';

/* Route dashboard */

/* Router Master Periode */
$route['master-periode'] = 'MasterPeriode';
$route['master-periode/get-data'] = 'MasterPeriode/getData';
$route['master-periode/create'] = 'MasterPeriode/create';
$route['master-periode/update'] = 'MasterPeriode/update';
$route['master-periode/delete'] = 'MasterPeriode/delete';

/* Router Master Prodi */
$route['master-prodi'] = 'MasterProdi';
$route['master-prodi/get-data'] = 'MasterProdi/getData';
$route['master-prodi/create'] = 'MasterProdi/create';
$route['master-prodi/update'] = 'MasterProdi/update';
$route['master-prodi/delete'] = 'MasterProdi/delete';

/* Router Master Ruang */
$route['master-ruang'] = 'MasterRuang';
$route['master-ruang/get-data'] = 'MasterRuang/getData';
$route['master-ruang/create'] = 'MasterRuang/create';
$route['master-ruang/update'] = 'MasterRuang/update';
$route['master-ruang/delete'] = 'MasterRuang/delete';

/* Router Master Mata Kuliah */
$route['master-mata-kuliah'] = 'MasterMataKuliah';
$route['master-mata-kuliah/get-data'] = 'MasterMataKuliah/getData';
$route['master-mata-kuliah/create'] = 'MasterMataKuliah/create';
$route['master-mata-kuliah/update'] = 'MasterMataKuliah/update';
$route['master-mata-kuliah/delete'] = 'MasterMataKuliah/delete';

/* Router Master Kelas */
$route['master-kelas'] = 'MasterKelas';
$route['master-kelas/get-data'] = 'MasterKelas/getData';
$route['master-kelas/create'] = 'MasterKelas/create';
$route['master-kelas/update'] = 'MasterKelas/update';
$route['master-kelas/delete'] = 'MasterKelas/delete';

/* Router Master Dosen */
$route['master-dosen'] = 'MasterDosen';
$route['master-dosen/get-data'] = 'MasterDosen/getData';
$route['master-dosen/create'] = 'MasterDosen/create';
$route['master-dosen/update'] = 'MasterDosen/update';
$route['master-dosen/delete'] = 'MasterDosen/delete';

/* Router Penawaran Mata Kuliah */
$route["penawaran-mata-kuliah"] = 'PenawaranMataKuliah';
$route["penawaran-mata-kuliah/get-data"] = 'PenawaranMataKuliah/getData';
$route["penawaran-mata-kuliah/create"] = 'PenawaranMataKuliah/create';
$route["penawaran-mata-kuliah/delete"] = 'PenawaranMataKuliah/delete';
$route["penawaran-mata-kuliah/detail"] = 'PenawaranMataKuliah/detail';
$route["penawaran-mata-kuliah/add-kontrak-penawaran-mata-kuliah"] = "PenawaranMataKuliah/addKontrakPenawaranMataKuliah";
$route["penawaran-mata-kuliah/get-data-detail"] = 'PenawaranMataKuliah/getDataDetail';
$route["penawaran-mata-kuliah/delete-detail"] = 'PenawaranMataKuliah/deleteDetail';
$route["penawaran-mata-kuliah/edit-kontrak-penawaran-mata-kuliah"] = 'PenawaranMataKuliah/editKontrakPenawaranMataKuliah';

/* Router Jadwal Perkuliahan */
$route['jadwal-perkuliahan'] = 'JadwalPerkuliahan';
$route['jadwal-perkuliahan/get-jadwal'] = 'JadwalPerkuliahan/getListJadwal';
$route['jadwal-perkuliahan/create'] = 'JadwalPerkuliahan/create';
$route['matriks-jadwal-perkuliahan'] = 'MatriksJadwalPerkuliahan/matriksJadwalPerkuliahan';
$route['matriks-jadwal-perkuliahan/get-data-ruang'] = "MatriksJadwalPerkuliahan/getDataRuang";

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
