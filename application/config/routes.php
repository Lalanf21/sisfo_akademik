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
$route['default_controller'] = 'home';
// #############################################
$route['admin'] = 'admin/dashboard';
$route['login'] = 'admin/Auth';
//================ user =====================
$route['user'] = 'admin/user';
$route['tambah-user'] = 'admin/user/form_add';
$route['save-user'] = 'admin/user/store';
$route['edit-user'] = 'admin/user/form_edit';
$route['update-user'] = 'admin/user/update';
$route['hapus-user'] = 'admin/user/delete';
$route['ganti-password'] = 'admin/user/ganti_pass';
// #############################################
//================ JURUSAN =====================
$route['jurusan'] = 'admin/jurusan';
$route['tambah-jurusan'] = 'admin/jurusan/form_add';
$route['save-jurusan'] = 'admin/jurusan/store';
$route['edit-jurusan'] = 'admin/jurusan/form_edit';
$route['update-jurusan'] = 'admin/jurusan/update';
$route['hapus-jurusan'] = 'admin/jurusan/delete';
// #############################################
//================ Prodi =====================
$route['program_studi'] = 'admin/program_studi';
$route['tambah-prodi'] = 'admin/program_studi/form_add';
$route['save-prodi'] = 'admin/program_studi/store';
$route['edit-prodi'] = 'admin/program_studi/form_edit';
$route['update-prodi'] = 'admin/program_studi/update';
$route['hapus-prodi'] = 'admin/program_studi/delete';
// #############################################
//================ Mata Kuliah =====================
$route['mata_kuliah'] = 'admin/mata_kuliah';
$route['tambah-matakuliah'] = 'admin/mata_kuliah/form_add';
$route['save-matakuliah'] = 'admin/mata_kuliah/store';
$route['edit-matakuliah'] = 'admin/mata_kuliah/form_edit';
$route['update-matakuliah'] = 'admin/mata_kuliah/update';
$route['hapus-matakuliah'] = 'admin/mata_kuliah/delete';
// #############################################
//================ Mahasiswa =====================
$route['mahasiswa'] = 'admin/mahasiswa';
$route['tambah-mahasiswa'] = 'admin/mahasiswa/form_add';
$route['save-mahasiswa'] = 'admin/mahasiswa/store';
$route['edit-mahasiswa'] = 'admin/mahasiswa/form_edit';
$route['update-mahasiswa'] = 'admin/mahasiswa/update';
$route['hapus-mahasiswa'] = 'admin/mahasiswa/delete';
// #############################################
//================ Dosen =====================
$route['dosen'] = 'admin/dosen';
$route['tambah-dosen'] = 'admin/dosen/form_add';
$route['save-dosen'] = 'admin/dosen/store';
$route['edit-dosen'] = 'admin/dosen/form_edit';
$route['update-dosen'] = 'admin/dosen/update';
$route['hapus-dosen'] = 'admin/dosen/delete';
// #############################################
//================ Tahun akademik =====================
$route['tahun-akademik'] = 'admin/tahun_akademik';
$route['tambah-tahun-akademik'] = 'admin/tahun_akademik/form_add';
$route['save-tahun-akademik'] = 'admin/tahun_akademik/store';
$route['edit-tahun-akademik'] = 'admin/tahun_akademik/form_edit';
$route['update-tahun-akademik'] = 'admin/tahun_akademik/update';
$route['hapus-tahun-akademik'] = 'admin/tahun_akademik/delete';
// #############################################
//================ KRS =====================
$route['krs'] = 'admin/krs';
$route['proses-krs'] = 'admin/krs/proses';
$route['refresh-krs'] = 'admin/krs/refresh';
$route['tampil-krs'] = 'admin/krs/tampil';
$route['tambah-krs'] = 'admin/krs/form_add';
$route['save-krs'] = 'admin/krs/store';
$route['edit-krs'] = 'admin/krs/form_edit';
$route['update-krs'] = 'admin/krs/update';
$route['hapus-krs'] = 'admin/krs/delete';
// #############################################
//================ Nilai =====================
$route['nilai'] = 'admin/nilai';
$route['proses-nilai/(:any)'] = 'admin/nilai/proses/$1';
$route['refresh-nilai'] = 'admin/nilai/refresh';
$route['tampil-form-nilai'] = 'admin/nilai/tampil';
$route['tampil-daftar-nilai'] = 'admin/nilai/list_nilai';
$route['save-nilai'] = 'admin/nilai/store';
// #############################################
//================ KHS =====================
$route['khs'] = 'admin/khs';
$route['proses-khs'] = 'admin/khs/proses';
$route['refresh-khs'] = 'admin/khs/refresh';
$route['tampil-khs'] = 'admin/khs/tampil';
//================ Transkrip =====================
$route['transkrip'] = 'admin/cetak_transkrip';
$route['proses-transkrip'] = 'admin/cetak_transkrip/proses';
$route['refresh-transkrip'] = 'admin/cetak_transkrip/refresh';
$route['tampil-transkrip'] = 'admin/cetak_transkrip/tampil';
//================ Identitas kampus =====================
$route['identitas-kampus'] = 'admin/identitas_kampus';
$route['edit-identitas'] = 'admin/identitas_kampus/form_edit';
$route['update-identitas'] = 'admin/identitas_kampus/update';
// #############################################
//================ tentang kampus =====================
$route['tentang-kampus'] = 'admin/tentang_kampus';
$route['edit-tentang-kampus'] = 'admin/tentang_kampus/form_edit';
$route['update-tentang-kampus'] = 'admin/tentang_kampus/update';
// #############################################
//================ tentang kampus =====================
$route['contact-us'] = 'admin/contact_us';
$route['kirim-pesan'] = 'admin/contact_us/store';
$route['hapus-pesan'] = 'admin/contact_us/delete';
$route['balas-pesan'] = 'admin/contact_us/form';
$route['send-email'] = 'admin/contact_us/send_mail';
// #############################################
//================ Informasi kampus =====================
$route['informasi-kampus'] = 'admin/informasi_kampus';
$route['tambah-informasi-kampus'] = 'admin/informasi_kampus/form_add';
$route['save-informasi-kampus'] = 'admin/informasi_kampus/store';
$route['edit-informasi-kampus'] = 'admin/informasi_kampus/form_edit';
$route['update-informasi-kampus'] = 'admin/informasi_kampus/update';
$route['hapus-informasi-kampus'] = 'admin/informasi_kampus/delete';
// #############################################
//================ Informasi kampus =====================
$route['menu'] = 'admin/menu';
$route['tambah-menu'] = 'admin/menu/form_add_menu';
$route['tambah-submenu'] = 'admin/menu/form_add_submenu';
$route['save-menu'] = 'admin/menu/store_menu';
$route['save-submenu'] = 'admin/menu/store_submenu';
$route['edit-menu'] = 'admin/menu/form_edit_menu';
$route['edit-submenu'] = 'admin/menu/form_edit_submenu';
$route['update-menu'] = 'admin/menu/update_menu';
$route['update-submenu'] = 'admin/menu/update_submenu';
$route['hapus-menu'] = 'admin/menu/delete_menu';
$route['hapus-submenu'] = 'admin/menu/delete_submenu';
// #############################################
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
