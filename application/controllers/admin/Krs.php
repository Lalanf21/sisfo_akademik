<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Krs extends CI_controller{

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
        $this->load->view('admin/krs/v_masuk_krs');
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
                redirect('krs');
            } else {
                $sess_data = [
                    'nim' => $nim,
                    'id_tahun_akademik' => $tahun
                ];
                $this->session->set_userdata($sess_data);
                redirect('tampil-krs');
            }
        }
    }

    public function tampil() {
        $nim = $this->session->userdata('nim');
        $tahun = $this->session->userdata('id_tahun_akademik');
        if (!$nim || !$tahun) {
            $this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Anda tidak berhak mengakses !!</strong> 
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>');
            redirect('krs');
        }

        $data = [
            'krsData'            => $this->bacaKrs($nim, $tahun),
            'nama_lengkap'       => $this->logic->get_where('mahasiswa', ['nim' => $nim])->row()->nama_lengkap,
            'prodi'              => $this->logic->get_where('mahasiswa', ['nim' => $nim])->row()->nama_prodi,
            'id_tahun_akademik'  => $tahun,
            'tahun_akademik'     => $this->logic->get_where('tahun_akademik', ['id_tahun_akademik' => $tahun])->row()->tahun_akademik,
            'semester'           => $this->logic->get_where('tahun_akademik', ['id_tahun_akademik' => $tahun])->row()->semester,
        ];
        // var_dump($data['k    rsData']);die;
        $data['title'] = 'Sisfo | list KRS';
        $this->load->view('template_admin/header', $data);
        $this->load->view('template_admin/sidebar');
        $this->load->view('admin/krs/v_krs_list');
        $this->load->view('template_admin/footer');
    }

    public function bacaKrs($nim,$tahun) {     
        $this->db->select('krs.id_krs , krs.kode_matakuliah ,mata_kuliah.nama_matakuliah, mata_kuliah.sks');
        $this->db->from('krs');
        $this->db->where('krs.nim', $nim);
        $this->db->where('krs.id_tahun_akademik', $tahun);
        $this->db->join('mata_kuliah', 'mata_kuliah.kode_matakuliah = krs.kode_matakuliah');

        return $this->db->get()->result();
    }

    public function form_add() {
        $nim = $this->session->userdata('nim');
        $id_tahun = $this->session->userdata('id_tahun_akademik');
        $whereAkademik = [
            'id_tahun_akademik' => $id_tahun
        ];
        $data = [
            'nim' => $nim,
            'akademik'    => $this->logic->get_where('tahun_akademik',$whereAkademik)->row(),
            'mata_kuliah' => $this->logic->query("SELECT kode_matakuliah,nama_matakuliah FROM mata_kuliah WHERE id_tahun_akademik = $id_tahun")->result()
        ];
        // var_dump($data['akademik']);die;
        $data['title'] = 'Tambah KRS';
        $this->load->view('template_admin/header', $data);
        $this->load->view('template_admin/sidebar');
        $this->load->view('admin/krs/form_add');
        $this->load->view('template_admin/footer');
    }

    public function store()
    {
        $this->form_validation->set_rules('mata_kuliah', 'Mata kuliah', 'required', [
            'required' => 'Silahkan pilih mata kuliah dahulu !'
        ]);

        if ($this->form_validation->run() == false){
            $this->form_add();
        } else {
            $mk = htmlspecialchars($this->input->post('mata_kuliah', true));
            $id_tahun = $this->session->userdata('id_tahun_akademik');
            $nim = $this->session->userdata('nim');
            $where = [
                'nim' => $nim,
                'kode_matakuliah' => $mk,
                'id_tahun_akademik' => $id_tahun,
            ];
            $cek = $this->logic->get_where('krs', $where);

            if ($cek->num_rows() > 0) {
                $this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Data KRS sudah ada !!</strong> 
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>');
                redirect('tambah-krs');
            } else {
                $data = [
                    'id_tahun_akademik' => $id_tahun,
                    'nim' => $nim,
                    'kode_matakuliah' => $mk
                ];
                $this->logic->store('krs', $data);

                $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Data berhasil di tambahkan !!</strong> 
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>');
                redirect('tampil-krs');
            }
        }
    }

    public function form_edit() {
        $id = $this->input->post('id');
        $dec = $this->encryption->decrypt($id);
        $where = ['id_krs'=>$dec];
        $id_tahun = $this->session->userdata('id_tahun_akademik');
        $whereAkademik = ['id_tahun_akademik' => $id_tahun];
        $data = [
            'title' => 'Update KRS',
            'krs' => $this->logic->get_where('krs', $where)->row(),
            'akademik'    => $this->logic->get_where('tahun_akademik', $whereAkademik)->row(),
            'mata_kuliah' => $this->logic->query('SELECT kode_matakuliah,nama_matakuliah FROM mata_kuliah')->result()
        ];
        $this->load->view('template_admin/header', $data);
        $this->load->view('template_admin/sidebar');
        $this->load->view('admin/krs/form_edit');
        $this->load->view('template_admin/footer');
    }

    public function update() {
        $this->form_validation->set_rules('mata_kuliah', 'Mata kuliah', 'required', [
            'required' => 'Silahkan pilih mata kuliah dahulu !'
        ]);
        if ( $this->form_validation->run() == false ){
            $this->form_edit();
        } else{
            $id = $this->input->post('id');
            $dec = $this->encryption->decrypt($id);
            $mk = $this->input->post('mata_kuliah');
            $data = [
                'kode_matakuliah' => $mk,
            ];
            $where = ['id_krs'=>$dec];

            $cek = $this->logic->update('krs', $data, $where);
            
            if ($cek == true) {
                $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Data berhasil di edit !!</strong> 
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>');
                redirect('tampil-krs') ;
            } else{
                $this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Data gagal di edit !!</strong> 
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>');
                redirect('edit-krs');
            }
        }
    }


    public function delete() { 
        $id = $this->input->post('id');
        $dec = $this->encryption->decrypt($id);
        $where = ['id_krs'=>$dec];
        $cek = $this->logic->delete('krs', $where);
        if ( $cek == true ){
            $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Data KRS berhasil di Hapus !!</strong> 
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </div>');
            redirect('tampil-krs');
        } else {
            $this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Data KRS gagal di Hapus !!</strong> 
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </div>');
            redirect('tampil-krs');
        }
    }

    public function refresh() { 
        $sess = ['nim','id_tahun_akademik'];
        $this->session->unset_userdata($sess);
        redirect('krs');
    }
}