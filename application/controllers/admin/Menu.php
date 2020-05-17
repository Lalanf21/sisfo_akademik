<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Menu extends CI_controller{

    public function __construct()
    {
        parent::__construct();
        is_logged_in('login');
        $this->load->model('my_model', 'logic');
    }

    public function index()
    {
        $join = ['menu','menu.id_menu = sub_menu.id_menu'];
        $data['menu'] = $this->logic->get_all('menu')->result();
        $data['subMenu'] = $this->logic->get_all_join('sub_menu','menu.nama_menu,sub_menu.*',$join)->result();
        $data['title'] = 'Sisfo | Mahasiswa';
        $this->load->view('template_admin/header', $data);
        $this->load->view('template_admin/sidebar');
        $this->load->view('admin/menu/v_menu');
        $this->load->view('template_admin/footer');
    }
}