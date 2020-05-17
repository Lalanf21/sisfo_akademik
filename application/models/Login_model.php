<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login_model extends CI_Model{

    public function cek_user($user){
        return $this->db->get_where('user',['username'=>$user]);
    }

    public function cek_pass($pass, $cek){
        return password_verify($pass, $cek);
    }
}