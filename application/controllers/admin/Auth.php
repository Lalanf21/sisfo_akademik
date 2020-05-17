<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_controller{

    public function __construct() { 
        parent::__construct();
        $this->load->model('login_model');
    }
    
    public function index(){
        $this->session->sess_destroy();
        $data['title'] = 'Login Panel';
        $this->load->view('template_admin/header', $data);
        $this->load->view('admin/v_login');
    }
    
    public function proses_login() { 
        $this->form_validation->set_rules('username', 'Username','required',[
            'required' => "wajib di isi !"
        ]);
        $this->form_validation->set_rules('password', 'Password','required|min_length[3]',[
            'required' => 'wajib di isi !',
            'min_length' => 'Password minimal 5 karakter'
        ]);


        if ( $this->form_validation->run() == FALSE ){
            $data['title'] = 'Login Panel';
            $this->load->view('template_admin/header', $data);
            $this->load->view('admin/v_login');
            $this->load->view('template_admin/header');
        } else {
            $username = $this->input->post('username');
            $pass = $this->input->post('password');

            $cek_user = $this->login_model->cek_user($username)->row_array();

            if ($cek_user){
                $cek_pass = $this->login_model->cek_pass($pass,$cek_user['password']);
                if ( $cek_pass ){
                    $sess_data = [
                        'username' => $cek_user['username'],
                        'email' => $cek_user['email'],
                        'level' => $cek_user['level'],
                        'logged_in' => true,
                    ];

                    $this->session->set_userdata($sess_data);
                    redirect('admin');
                }else{
                    $this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Password anda salah !!</strong> 
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>');
                    redirect('login');
                }
            } else {
                $this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Username anda tidak terdaftar !</strong> 
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>');
                redirect('login');
            }

        }
    }

    public function logout() {
        $this->session->sess_destroy();
        $this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Anda sudah Logout </strong> 
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>');
        redirect('login');
    }
}