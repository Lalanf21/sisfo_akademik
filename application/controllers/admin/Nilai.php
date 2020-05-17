<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Nilai extends CI_controller{

    public function __construct() { 
        parent::__construct();
        is_logged_in('login');
        $this->load->model('my_model','logic');
        $this->load->library('encryption');
    }

    public function index(){
        $data['tahun_akademik'] = $this->logic->query('SELECT id_tahun_akademik, semester, CONCAT(tahun_akademik," - ") AS tahun_semester FROM tahun_akademik')->result();
        $data['matakuliah'] = $this->logic->query('SELECT kode_matakuliah,nama_matakuliah FROM mata_kuliah')->result();
        $data['title'] = 'Sisfo | Input nilai';
        $this->load->view('template_admin/header', $data);
        $this->load->view('template_admin/sidebar');
        $this->load->view('admin/nilai/v_masuk_nilai');
        $this->load->view('template_admin/footer');
    }
    
    private function _rules() {
        $this->form_validation->set_rules('kode_matkul', 'Kode Mata Kuliah', 'required|alpha_numeric', [
            'required' => 'Wajib di isi !',
            'alpha_numeric' => 'silahkan pilih option dahulu !'
        ]);
        $this->form_validation->set_rules('tahun_akademik', 'Tahun Akademik', 'required|numeric', [
            'required' => 'wajib di isi !',
            'numeric' => 'silahkan pilih option dahulu !'
        ]);
        
    }

    public function proses($param) {
        $this->_rules();

        if ($this->form_validation->run() == false) {
            $this->index();
        } else {
            $kode_mk = htmlspecialchars($this->input->post('kode_matkul',true));
            $tahun = htmlspecialchars($this->input->post('tahun_akademik',true));
                $sess_data = [
                    'kode_mk' => $kode_mk,
                    'id_tahun_akademik' => $tahun
                ];
                $this->session->set_userdata($sess_data);
                if ($param == 'form') {
                    redirect('tampil-form-nilai');
                }else {
                    redirect('tampil-daftar-nilai');
                }
            }
        
    }

    public function tampil() {
        $kode_mk = $this->session->userdata('kode_mk');
        $tahun = $this->session->userdata('id_tahun_akademik');
        if (!$kode_mk) {
            $this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Anda tidak berhak mengakses !!</strong> 
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>');
            redirect('nilai');
        }

        $whereIdtahun = ['id_tahun_akademik' => $tahun];
        $wherekodeMk = ['kode_matakuliah' => $kode_mk];

        $data = [
            'nilaiData'         => $this->bacaNilai($kode_mk, $tahun),
            'kode_mk'           => $kode_mk,
            'nama_mk'           => $this->logic->get_where('mata_kuliah', $wherekodeMk)->row()->nama_matakuliah,
            'sks'           => $this->logic->get_where('mata_kuliah', $wherekodeMk)->row()->sks,
            'semester'          => $this->logic->get_where('tahun_akademik',$whereIdtahun)->row()->semester,
            'tahun_akademik'          => $this->logic->get_where('tahun_akademik',$whereIdtahun)->row()->tahun_akademik
        ];
        // var_dump($data['nilaiData']);
        // var_dump($tahun);die;
        if (!$data['nilaiData']) {
            $this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Mata kuliah tidak ada mahasiswa</strong> 
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>');
            redirect('nilai');
        }
        $data['title'] = 'Sisfo | Input nilai';
        $this->load->view('template_admin/header', $data);
        $this->load->view('template_admin/sidebar');
        $this->load->view('admin/nilai/input_form');
        $this->load->view('template_admin/footer');
    }

    public function bacaNilai($kode_mk,$tahun) {     
        $this->db->select('k.id_krs,k.nilai,k.nim,m.nama_lengkap,mk.nama_matakuliah');
        $this->db->from('krs as k');
        $this->db->where('k.kode_matakuliah', $kode_mk);
        $this->db->where('k.id_tahun_akademik', $tahun);
        $this->db->join('mahasiswa as m', 'm.nim = k.nim' ,'inner');
        $this->db->join('mata_kuliah as mk', 'mk.kode_matakuliah = k.kode_matakuliah' ,'inner');
        return $this->db->get()->result();
    }

    public function store()
    {
        $nilai = array_map('strtoupper',$this->input->post('nilai'));
        $id_krs = $this->input->post('id_krs');
        for ($i=0; $i < sizeof($id_krs); $i++) { 
            $this->db->set('nilai',$nilai[$i])->where('id_krs',$id_krs[$i])->update('krs');
        }
        $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Nilai mahasiswa berhasil di simpan</strong> 
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>');
        redirect('tampil-daftar-nilai');
    }

    public function list_nilai() {
        $kode_mk = $this->session->userdata('kode_mk');
        $tahun = $this->session->userdata('id_tahun_akademik');
        if (!$kode_mk) {
            $this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Anda tidak berhak mengakses !!</strong> 
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>');
            redirect('nilai');
        }

        $whereIdtahun = ['id_tahun_akademik' => $tahun];
        $wherekodeMk = ['kode_matakuliah' => $kode_mk];

        $data = [
            'nilaiData'         => $this->bacaNilai($kode_mk, $tahun),
            'kode_mk'           => $kode_mk,
            'nama_mk'           => $this->logic->get_where('mata_kuliah', $wherekodeMk)->row()->nama_matakuliah,
            'sks'           => $this->logic->get_where('mata_kuliah', $wherekodeMk)->row()->sks,
            'semester'          => $this->logic->get_where('tahun_akademik', $whereIdtahun)->row()->semester,
            'tahun_akademik'          => $this->logic->get_where('tahun_akademik', $whereIdtahun)->row()->tahun_akademik
        ];
        if (!$data['nilaiData']) {
            $this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Mata kuliah tidak ada mahasiswa</strong> 
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>');
            redirect('nilai');
        }
        $data['title'] = 'Sisfo | Input nilai';
        $this->load->view('template_admin/header', $data);
        $this->load->view('template_admin/sidebar');
        $this->load->view('admin/nilai/daftar_nilai');
        $this->load->view('template_admin/footer');
    }

    public function refresh() { 
        $sess = ['nim','id_tahun_akademik','kode_mk'];
        $this->session->unset_userdata($sess);
        redirect('nilai');
    }
}