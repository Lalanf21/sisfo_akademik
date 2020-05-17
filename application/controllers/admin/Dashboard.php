<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_controller{

    public function __construct() { 
        parent::__construct();
         is_logged_in('login');
         
    }

    public function index(){
        $data['title'] = 'Sisfo | Admin';
        $this->load->view('template_admin/header', $data);
        $this->load->view('template_admin/sidebar');
        $this->load->view('admin/v_dashboard');
        $this->load->view('template_admin/footer');
    }
}