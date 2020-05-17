<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tahun_akademik extends CI_controller{

    public function __construct() { 
        parent::__construct();
        is_logged_in('login');
        $this->load->model('my_model','logic');
        $this->load->library('encryption');
    }

    public function index(){
        $data['tahun_akademik'] = $this->logic->get_all('tahun_akademik')->result();
        $data['title'] = 'Sisfo | tahun_akademik';
        $this->load->view('template_admin/header', $data);
        $this->load->view('template_admin/sidebar');
        $this->load->view('admin/tahun_akademik/v_tahun_akademik');
        $this->load->view('template_admin/footer');
    }

    private function _rules() {
        $this->form_validation->set_rules('tahun_akademik', 'tahun akademik', 'required', [
            'required' => 'Wajib di isi !'
        ]);
        $this->form_validation->set_rules('semester', 'Semester', 'required|in_list[Genap,Ganjil]', [
            'required' => 'wajib di isi !',
            'in_list' => 'Silahkan Pilih Option dahulu !'
        ]);
        $this->form_validation->set_rules('status', 'Status', 'required|in_list[Aktif,Tidak aktif]', [
            'required' => 'wajib di isi !',
            'in_list' => 'Silahkan Pilih Option dahulu !'
        ]);
    }
    
    public function form_add() {
        $data['title'] = 'Tambah data tahun_akademik';
        $this->load->view('template_admin/header', $data);
        $this->load->view('template_admin/sidebar');
        $this->load->view('admin/tahun_akademik/form_add');
        $this->load->view('template_admin/footer');
    }

    public function store()
    {
        $this->_rules();
        if ($this->form_validation->run() == false) {
            $this->form_add();
        } else {
            $tahun = htmlspecialchars($this->input->post('tahun_akademik', true));
            $semester = htmlspecialchars($this->input->post('semester', true));
            $status = htmlspecialchars($this->input->post('status', true));

            $where = [
                'tahun_akademik' => $tahun,
                'semester' => $semester,
                'status' => $status
            ];
            $cek = $this->logic->get_where('tahun_akademik', $where);

            if ($cek->num_rows() > 0) {
                $this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Data Sudah Ada !!</strong> 
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>');
                redirect('tambah-tahun-akademik');
            } else {
                $data = [
                    'tahun_akademik' => $tahun,
                    'semester' => $semester,
                    'status' => $status
                ];
                $this->logic->store('tahun_akademik', $data);

                $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Data berhasil di tambahkan !!</strong> 
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>');
                redirect('tahun-akademik');
            }
        }
    }


    public function form_edit() {
        $id = $this->input->post('id');
        $dec = $this->encryption->decrypt($id);
        $where = ['id_tahun_akademik'=>$dec];
        $data['data'] = $this->logic->get_where('tahun_akademik', $where)->row_array();
        $data['title'] = 'edit data tahun_akademik';
        $this->load->view('template_admin/header', $data);
        $this->load->view('template_admin/sidebar');
        $this->load->view('admin/tahun_akademik/form_edit');
        $this->load->view('template_admin/footer');
    }

    public function update() { 
        $this->_rules();

        if ( $this->form_validation->run() == false ){
            $this->form_edit();
        } else{
            $id = $this->input->post('id');
            $dec = $this->encryption->decrypt($id);
            $tahun = htmlspecialchars($this->input->post('tahun_akademik', true));
            $semester = htmlspecialchars($this->input->post('semester', true));
            $status = htmlspecialchars($this->input->post('status', true));
            
            $data = [
                'tahun_akademik' => $tahun,
                'semester' => $semester,
                'status' => $status
            ];
            $where = ['id_tahun_akademik'=>$dec];

            $cek = $this->logic->update('tahun_akademik', $data, $where);
            
            if ($cek == true) {
                $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Data berhasil di edit !!</strong> 
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>');
                redirect('tahun-akademik') ;
            } else{
                $this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Data gagal di edit !!</strong> 
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>');
                redirect('edit-tahun-akademik');
            }
        }
    }

    
    public function delete() { 
        $id = $this->input->post('id');
        $dec = $this->encryption->decrypt($id);
        $where = ['id_tahun_akademik'=>$dec];
        $cek = $this->logic->delete('tahun_akademik', $where);
        if ( $cek == true ){
            $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Data berhasil di Hapus !!</strong> 
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </div>');
            redirect('tahun-akademik');
        } else {
            $this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Data gagal di Hapus !!</strong> 
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </div>');
            redirect('tahun-akademik');
        }
    }
}