<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_controller{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('my_model', 'logic');
        $this->load->helper('text');
    }

    public function index(){
        $data['title'] = 'Universitas Muhammadiyah Tangerang';
        $data['identitas'] = $this->logic->get_all('identitas')->row();
        $data['tentang'] = $this->logic->get_all('tentang_kampus')->row();
        $data['info'] = $this->logic->get_all('informasi_kampus')->result();
        $this->load->view('template_admin/header',$data);
        $this->load->view('front_end/home');
        $this->load->view('template_admin/footer');
    }
}