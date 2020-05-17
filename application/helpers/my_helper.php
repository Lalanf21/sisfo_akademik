<?php

function getAutoNumber($table, $field, $pref, $length, $where = "") {
    $ci = &get_instance();
        $query = "SELECT IFNULL(MAX(CONVERT(MID($field," . (strlen($pref) + 1) . "," . ($length - strlen($pref)) . "),UNSIGNED INTEGER)),0)+1 AS NOMOR
                FROM $table WHERE LEFT($field," . (strlen($pref)) . ")='$pref' $where";
        $result = $ci->db->query($query)->row();
        $zero="";
        $num = $length - strlen($pref) - strlen($result->NOMOR);
        for ($i = 0; $i < $num; $i++) {
            $zero = $zero . "0";
        }
        return $pref . $zero . $result->NOMOR;
    }

function noRegistrasiotomatis($field, $table, $where)
{
    $ci = get_instance();
    $today = date('Y-m-d');
    // mencari kode barang dengan nilai paling besar
    $query = "SELECT max($field) as maxKode FROM $table where $where='$today'";
    $data = $ci->db->query($query)->row_array();
    $kode = $data['maxKode'];
    $noUrut = (int) substr($kode, 0, 6);
    $noUrut++;
    $kodeBaru = sprintf("%04s", $noUrut); //sprintf berfungsi untuk menampilkan kodebaru yang diambil
    //berdasarkan no_urut, "%04s" berfungsi untuk menampilkan berapa karakter yang ingin ditampilkan kalau %04s berarti yang ditampilkan hanya 4 karakter
    return $kodeBaru;
}

function activate_menu($menu){
    $ci = get_instance();
    $class = $ci->router->fetch_class();
    return $class==$menu?'active':'';
}

function show_dropdown($menu){
    $ci = get_instance();
    $class = $ci->router->fetch_class();
    return $class==$menu?'show':'';
}

function is_logged_in($redirect){
    $ci = get_instance();
	if ( $ci->session->userdata('logged_in') != true ){
		$ci->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Anda Belum login !</strong> 
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>');
		redirect($redirect);
	}
}

function tanggal_indo($day){
	$day = explode ("-",$day);
	switch ($day[1]){
		case 1:
		$day[1] = "Januari";
		break;
		case 2:
		$day[1] = "Februari";
		break;
		case 3:
		$day[1] = "Maret";
		break;
		case 4:
		$day[1] = "April";
		break;
		case 5:
		$day[1] = "Mei";
		break;
		case 6:
		$day[1] = "Juni";
		break;
		case 7:
		$day[1] = "Juli";
		break;
		case 8:
		$day[1] = "Agustus";
		break;
		case 9:
		$day[1] = "September";
		break;
		case 10:
		$day[1] = "Oktober";
		break;
		case 11:
		$day[1] = "November";
		break;
		case 12:
		$day[1] = "Desember";
		break; 
	}
	$tgl_indo = $day[2]." ".$day[1]." ".$day[0];
	return $tgl_indo;
}

function skor($nilai, $sks) { 
	if ($nilai == 'A'){
		$skor = 4 * $sks;
	} else if( $nilai == 'B' ){
		$skor = 3 * $sks;
	} else if( $nilai == 'C' ){
		$skor = 2 * $sks;
	} else if ( $nilai == 'D' ){
		$skor = 1 * $sks;
	}else{
		$skor = 0 ;
	}
	return $skor;
}

function menu(){
	$ci = get_instance();
	return $ci->db->query("SELECT * FROM menu WHERE active = '1'")->result();
}

function sub_menu($id){
	$ci = get_instance();
	return $ci->db->query("SELECT * FROM sub_menu WHERE id_menu = $id AND active = '1'")->result() ;


}

function is_active($id){
	if ($id == 1) {
		$active = '<i class="fas fa-check">';
	}else{
		$active = '<i class="fas fa-times text-danger">';
	}
	return $active;
}