<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cetak_transkrip extends CI_controller{

    public function __construct() { 
        parent::__construct();
        is_logged_in('login');
        $this->load->model('my_model','logic');
        $this->load->library('encryption');
    }

    public function index(){
        $sess = ['nim', 'id_tahun_akademik'];
        $this->session->unset_userdata($sess);

        $data['title'] = 'Sisfo | Cetak transkrip nilai';
        $this->load->view('template_admin/header', $data);
        $this->load->view('template_admin/sidebar');
        $this->load->view('admin/transkrip/v_masuk_transkrip');
        $this->load->view('template_admin/footer');
    }
    
    private function _rules() {
        $this->form_validation->set_rules('nim', 'NIM', 'required|numeric', [
            'required' => 'Wajib di isi !',
            'numeric' => 'Masukkan angka !'
        ]);
        
    }

    public function proses() {
        $this->_rules();

        if ($this->form_validation->run() == false) {
            $this->index();
        } else {
            $nim = htmlspecialchars($this->input->post('nim',true));
            if ($this->logic->get_where('mahasiswa', ['nim' => $nim])->result() == null) {
                $this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>NIM tidak terdaftar !!</strong> 
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>');
                redirect('transkrip');
            } else {
                $sess_data = [
                    'nim' => $nim,
                ];
                $this->session->set_userdata($sess_data);
                redirect('tampil-transkrip');
            }
        }
    }

    public function tampil() {
        $nim = $this->session->userdata('nim');
        $whereNim = ['nim'=>$nim];
        if (!$nim) {
            $this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Anda tidak berhak mengakses !!</strong> 
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>');
            redirect('transkrip');
        }

        $data = [
            'nilaiData'          => $this->bacaNilai($nim),
            'nim'                => $nim,
            'nama_lengkap'       => $this->logic->get_where         ('mahasiswa', $whereNim)->row()->nama_lengkap,
            'prodi'              => $this->logic->get_where('mahasiswa', $whereNim)->row()->nama_prodi,
        ];
        $data['title'] = 'Sisfo | Transkrip nilai';
        $this->load->view('template_admin/header', $data);
        $this->load->view('template_admin/sidebar');
        $this->load->view('admin/transkrip/v_transkrip');
        $this->load->view('template_admin/footer');
    }

    public function bacaNilai($nim) {     
        $this->db->select('krs.nilai, krs.kode_matakuliah, mata_kuliah.nama_matakuliah, mata_kuliah.sks');
        $this->db->from('krs');
        $this->db->where('krs.nim', $nim);
        $this->db->join('mata_kuliah', 'mata_kuliah.kode_matakuliah = krs.kode_matakuliah','inner');

        return $this->db->get()->result();
    }

    public function refresh() { 
        $sess = ['nim','id_tahun_akademik'];
        $this->session->unset_userdata($sess);
        redirect('transkrip');
    }
}