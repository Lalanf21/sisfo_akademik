<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Khs extends CI_controller{

    public function __construct() { 
        parent::__construct();
        is_logged_in('login');
        $this->load->model('my_model','logic');
        $this->load->library('encryption');
    }

    public function index(){
        $sess = ['nim', 'id_tahun_akademik'];
        $this->session->unset_userdata($sess);

        $data['tahun_akademik'] = $this->logic->query('SELECT id_tahun_akademik, semester, CONCAT(tahun_akademik," - ") AS tahun_semester FROM tahun_akademik')->result();
        $data['title'] = 'Sisfo | KRS';
        $this->load->view('template_admin/header', $data);
        $this->load->view('template_admin/sidebar');
        $this->load->view('admin/khs/v_masuk_khs');
        $this->load->view('template_admin/footer');
    }
    
    private function _rules() {
        $this->form_validation->set_rules('nim', 'NIM', 'required|numeric', [
            'required' => 'Wajib di isi !',
            'numeric' => 'Masukkan angka !'
        ]);
        $this->form_validation->set_rules('tahun_akademik', 'Tahun Akademik', 'required|numeric', [
            'required' => 'wajib di isi !',
            'numeric' => 'silahkan pilih option dahulu !'
        ]);
        
    }

    public function proses() {
        $this->_rules();

        if ($this->form_validation->run() == false) {
            $this->index();
        } else {
            $nim = htmlspecialchars($this->input->post('nim',true));
            $tahun = htmlspecialchars($this->input->post('tahun_akademik',true));

            if ($this->logic->get_where('mahasiswa', ['nim' => $nim])->result() == null) {
                $this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>NIM tidak terdaftar !!</strong> 
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>');
                redirect('khs');
            } else {
                $sess_data = [
                    'nim' => $nim,
                    'id_tahun_akademik' => $tahun
                ];
                $this->session->set_userdata($sess_data);
                redirect('tampil-khs');
            }
        }
    }

    public function tampil() {
        $nim = $this->session->userdata('nim');
        $tahun = $this->session->userdata('id_tahun_akademik');
        $whereNim = ['nim'=>$nim];
        $whereIdtahun = ['id_tahun_akademik'=>$tahun];
        if (!$nim || !$tahun) {
            $this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Anda tidak berhak mengakses !!</strong> 
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>');
            redirect('khs');
        }

        $data = [
            'khsData'            => $this->bacaKhs($nim, $tahun),
            'nim'                => $nim,
            'nama_lengkap'       => $this->logic->get_where('mahasiswa', $whereNim)->row()->nama_lengkap,
            'prodi'              => $this->logic->get_where('mahasiswa', $whereNim)->row()->nama_prodi,
            'id_tahun_akademik'  => $tahun,
            'tahun_akademik'     => $this->logic->get_where('tahun_akademik', $whereIdtahun)->row()->tahun_akademik,
            'semester'           => $this->logic->get_where('tahun_akademik', $whereIdtahun)->row()->semester,
        ];

        // var_dump($data['khsData']);die;
        $data['title'] = 'Sisfo | KHS';
        $this->load->view('template_admin/header', $data);
        $this->load->view('template_admin/sidebar');
        $this->load->view('admin/khs/v_khs_list');
        $this->load->view('template_admin/footer');
    }

    public function bacaKhs($nim,$tahun) {     
        $this->db->select('krs.id_tahun_akademik,krs.nilai, krs.kode_matakuliah, mata_kuliah.nama_matakuliah, mata_kuliah.sks');
        $this->db->from('krs');
        $this->db->where('krs.nim', $nim);
        $this->db->where('krs.id_tahun_akademik', $tahun);
        $this->db->join('mata_kuliah', 'mata_kuliah.kode_matakuliah = krs.kode_matakuliah','inner');

        return $this->db->get()->result();
    }

    public function refresh() { 
        $sess = ['nim','id_tahun_akademik'];
        $this->session->unset_userdata($sess);
        redirect('khs');
    }
}