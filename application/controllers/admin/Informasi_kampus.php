<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Informasi_kampus extends CI_controller{

    public function __construct() { 
        parent::__construct();
        is_logged_in('login');
        $this->load->model('my_model','logic');
        $this->load->library('encryption');
    }

    public function index(){
        $data['informasi'] = $this->logic->get_all('informasi_kampus')->result();
        $data['title'] = 'Sisfo | informasi kampus';
        $this->load->view('template_admin/header', $data);
        $this->load->view('template_admin/sidebar');
        $this->load->view('admin/informasi/v_informasi');
        $this->load->view('template_admin/footer');
    }

    private function _rules() {
        $this->form_validation->set_rules('icon', 'Icon', 'required', [
            'required' => 'Wajib di isi !'
        ]);
        $this->form_validation->set_rules('isi_informasi', 'Isi Informasi', 'required', [
            'required' => 'wajib di isi !'
        ]);
        $this->form_validation->set_rules('judul_informasi', 'Judul Informasi', 'required', [
            'required' => 'wajib di isi !'
        ]);
    }
    
    public function form_add() {
        $data['title'] = 'Tambah data Jurusan';
        $this->load->view('template_admin/header', $data);
        $this->load->view('template_admin/sidebar');
        $this->load->view('admin/informasi/form_add');
        $this->load->view('template_admin/footer');
    }

    public function store()
    {
        $this->_rules();

        if ($this->form_validation->run() == false) {
            $this->form_add();
        } else {
            $icon = htmlspecialchars($this->input->post('icon', true));
            $isi = htmlspecialchars($this->input->post('isi_informasi', true));
            $judul = htmlspecialchars($this->input->post('judul_informasi', true));

            $where = [
                'icon' => $icon,
                'judul_informasi' => $judul,
                'isi_informasi' => $isi,
            ];
            $cek = $this->logic->get_where('informasi_kampus', $where);

            if ($cek->num_rows() > 0) {
                $this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Data Sudah Ada !!</strong> 
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>');
                redirect('tambah-informasi-kampus');
            } else {
                $data = [
                    'icon' => $icon,
                    'judul_informasi' => $judul,
                    'isi_informasi' => $isi,
                ];
                $this->logic->store('informasi_kampus', $data);

                $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Data berhasil di tambahkan !!</strong> 
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>');
                redirect('informasi-kampus');
            }
        }
    }

    public function form_edit() {
        $id = $this->input->post('id');
        $dec = $this->encryption->decrypt($id);
        $where = ['id_informasi'=>$dec];
        $data['data'] = $this->logic->get_where('informasi_kampus', $where)->row_array();
        $data['title'] = 'edit data Jurusan';
        $this->load->view('template_admin/header', $data);
        $this->load->view('template_admin/sidebar');
        $this->load->view('admin/informasi/form_edit');
        $this->load->view('template_admin/footer');
    }

    public function update() { 
        $this->_rules();
        if ( $this->form_validation->run() == false ){
            $this->form_edit();
        } else{
            $id = $this->input->post('id');
            $dec = $this->encryption->decrypt($id);
            $icon = htmlspecialchars($this->input->post('icon', true));
            $isi = htmlspecialchars($this->input->post('isi_informasi', true));
            $judul = htmlspecialchars($this->input->post('judul_informasi', true));
            $data = [
                'icon' => $icon,
                'judul_informasi' => $judul,
                'isi_informasi' => $isi,
            ];
            $where = ['id_informasi'=>$dec];

            $cek = $this->logic->update('informasi_kampus', $data, $where);
            
            if ($cek == true) {
                $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Data berhasil di edit !!</strong> 
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>');
                redirect('informasi-kampus') ;
            } else{
                $this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Data gagal di edit !!</strong> 
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>');
                redirect('edit-informasi-kampus');
            }
        }
    }

    public function delete() { 
        $id = $this->input->post('id');
        $dec = $this->encryption->decrypt($id);
        $where = ['id_informasi'=>$dec];
        $cek = $this->logic->delete('informasi_kampus', $where);
        if ( $cek == true ){
            $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Data berhasil di Hapus !!</strong> 
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </div>');
            redirect('informasi-kampus');
        } else {
            $this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Data gagal di Hapus !!</strong> 
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </div>');
            redirect('informasi-kampus');
        }
    }
}