<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class identitas_kampus extends CI_controller{

    public function __construct() { 
        parent::__construct();
        is_logged_in('login');
        $this->load->model('my_model','logic');
    }

    public function index(){
        $data['identitas'] = $this->logic->get_all('identitas')->result();
        $data['title'] = 'Sisfo | identitas kampus';
        $this->load->view('template_admin/header', $data);
        $this->load->view('template_admin/sidebar');
        $this->load->view('admin/identitas/v_identitas');
        $this->load->view('template_admin/footer');
    }

    private function _rules() {
        $this->form_validation->set_rules('nama_kampus', 'nama website', 'required', [
        ]);
        $this->form_validation->set_rules('alamat', 'Alamat', 'required', [
        ]);
        $this->form_validation->set_rules('email', 'Email', 'required', [
        ]);
        $this->form_validation->set_rules('telepon', 'telepon', 'required', [
        ]);
    }
    

    public function form_edit() {
        $id = $this->input->post('id');
        $where = ['id_identitas'=>$id];
        $data['data'] = $this->logic->get_where('identitas', $where)->row_array();
        $data['title'] = 'edit identitas kampus';
        $this->load->view('template_admin/header', $data);
        $this->load->view('template_admin/sidebar');
        $this->load->view('admin/identitas/form_edit');
        $this->load->view('template_admin/footer');
    }

    public function update() { 
        $this->_rules();

        if ( $this->form_validation->run() == false ){
            $this->form_edit();
        } else{
            $id = $this->input->post('id') ;
            $nama = htmlspecialchars($this->input->post('nama_kampus', true));
            $email = htmlspecialchars($this->input->post('email', true));
            $telepon = htmlspecialchars($this->input->post('telepon', true));
            $telepon = htmlspecialchars($this->input->post('telepon', true));
            $alamat = htmlspecialchars($this->input->post('alamat', true));
            
            $data = [
                'nama_kampus' => $nama,
                'alamat' => $alamat,
                'email' => $email,
                'telepon' => $telepon
            ];
            $where = ['id_identitas'=>$id];

            $cek = $this->logic->update('identitas', $data, $where);
            
            if ($cek == true) {
                $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Data berhasil di edit !!</strong> 
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>');
                redirect('identitas-kampus') ;
            } else{
                $this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Data gagal di edit !!</strong> 
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>');
                redirect('edit-identitas');
            }
        }
    }

}