<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tentang_kampus extends CI_controller{

    public function __construct() { 
        parent::__construct();
        is_logged_in('login');
        $this->load->model('my_model','logic');
    }

    public function index(){
        $data['tentang'] = $this->logic->get_all('tentang_kampus')->result();
        $data['title'] = 'Sisfo | Tentang kampus';
        $this->load->view('template_admin/header', $data);
        $this->load->view('template_admin/sidebar');
        $this->load->view('admin/tentang/v_tentang');
        $this->load->view('template_admin/footer');
    }

    private function _rules() {
        $this->form_validation->set_rules('sejarah', 'Sejarah', 'required', [
        ]);
        $this->form_validation->set_rules('visi', 'Visi', 'required', [
        ]);
        $this->form_validation->set_rules('misi', 'Misi', 'required', [
        ]);
    }
    

    public function form_edit() {
        $id = $this->input->post('id');
        $where = ['id_tentang'=>$id];
        $data['data'] = $this->logic->get_where('tentang_kampus', $where)->row_array();
        $data['title'] = 'edit tentang kampus';
        $this->load->view('template_admin/header', $data);
        $this->load->view('template_admin/sidebar');
        $this->load->view('admin/tentang/form_edit');
        $this->load->view('template_admin/footer');
    }

    public function update() { 
        $this->_rules();

        if ( $this->form_validation->run() == false ){
            $this->form_edit();
        } else{
            $id = $this->input->post('id') ;
            $sejarah= htmlspecialchars($this->input->post('sejarah', true));
            $visi = htmlspecialchars($this->input->post('visi', true));
            $misi = htmlspecialchars($this->input->post('misi', true));
            
            $data = [
                'sejarah' => $sejarah,
                'visi' => $visi,
                'misi' => $misi,
            ];
            $where = ['id_tentang'=>$id];

            $cek = $this->logic->update('tentang_kampus', $data, $where);
            
            if ($cek == true) {
                $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Data berhasil di edit !!</strong> 
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>');
                redirect('tentang-kampus') ;
            } else{
                $this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Data gagal di edit !!</strong> 
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>');
                redirect('edit-tentang-kampus');
            }
        }
    }

}