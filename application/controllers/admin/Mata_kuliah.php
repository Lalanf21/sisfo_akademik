<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mata_kuliah extends CI_controller{

    public function __construct()
    {
        parent::__construct();
        is_logged_in('login');
        $this->load->model('my_model', 'logic');
        $this->load->library('encryption');
    }

    public function index(){
        $join = ['tahun_akademik','tahun_akademik.id_tahun_akademik = mata_kuliah.id_tahun_akademik'];
        $data['mk'] = $this->logic->get_all_join('mata_kuliah','*',$join)->result();
        $data['title'] = 'Sisfo | Mata Kuliah';
        $this->load->view('template_admin/header', $data);
        $this->load->view('template_admin/sidebar');
        $this->load->view('admin/mata_kuliah/v_mk');
        $this->load->view('template_admin/footer');
    }

    private function _rules() {
        $this->form_validation->set_rules('kode_matakuliah', 'Kode Mata kuliah', 'required', [
            'required' => 'Wajib di isi !'
        ]);
        $this->form_validation->set_rules('nama_matakuliah', 'Nama mata kuliah', 'required', [
            'required' => 'wajib di isi !'
        ]);
        $this->form_validation->set_rules('tahun_akademik', 'tahun akademik', 'required|numeric', [
            'required' => 'wajib di isi',
            'numeric' => 'silahkan pilih option dahulu !'
        ]);
        $this->form_validation->set_rules('sks', 'SKS', 'required|numeric', [
            'required' => 'wajib di isi',
            'numeric' => 'silahkan pilih option dahulu !'
        ]);
        $this->form_validation->set_rules('nama_prodi', 'Nama Prodi', 'required|alpha_numeric_spaces', [
            'required' => 'wajib di isi',
            'alpha_numeric_spaces' => 'silahkan pilih option dahulu !'
        ]);
    }
    
    public function form_add()
    {
        $data['title'] = 'Tambah data mata kuliah';
        $data['prodi'] = $this->logic->query('SELECT nama_prodi FROM prodi')->result() ;
        $data['tahun_akademik'] = $this->logic->get_where('tahun_akademik',['status'=>'aktif'])->result() ;
        $this->load->view('template_admin/header', $data);
        $this->load->view('template_admin/sidebar');
        $this->load->view('admin/mata_kuliah/form_add', $data);
        $this->load->view('template_admin/footer');
    }

    public function store()
    {
        $this->_rules();
        if ($this->form_validation->run() == false) {
            $this->form_add();
        } else {
            $kode = htmlspecialchars($this->input->post('kode_matakuliah', true));
            $id_tahun = htmlspecialchars($this->input->post('tahun_akademik', true));
            $nama = htmlspecialchars($this->input->post('nama_matakuliah', true));
            $sks = htmlspecialchars($this->input->post('sks', true));
            $prodi = htmlspecialchars($this->input->post('nama_prodi', true));

            $where = [
                'kode_matakuliah' => $kode,
                'nama_matakuliah' => $nama,
                'sks' => $sks,
                'nama_prodi' => $prodi,
            ];
            $cek = $this->logic->get_where('mata_kuliah', $where);

            if ($cek->num_rows() > 0) {
                $this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Data Sudah Ada !!</strong> 
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>');
                redirect('tambah-matakuliah');
            } else {
                $data = [
                    'id_tahun_akademik' => $id_tahun,
                    'kode_matakuliah' => $kode,
                    'nama_matakuliah' => $nama,
                    'sks' => $sks,
                    'nama_prodi' => $prodi,
                ];
                $this->logic->store('mata_kuliah', $data);

                $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Data berhasil di tambahkan !!</strong> 
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>');
                redirect('mata_kuliah');
            }
        }
    }

    public function form_edit()
    {
        $id = $this->input->post('id');
        $dec = $this->encryption->decrypt($id);
        $where = ['id_matakuliah' => $dec];
        $data['data'] = $this->logic->get_where('mata_kuliah', $where)->row_array();
        $data['tahun_akademik'] = $this->logic->get_where('tahun_akademik', ['status' => 'aktif'])->result();
        $data['prodi'] = $this->logic->query('SELECT nama_prodi FROM prodi')->result();
        $data['title'] = 'edit data Jurusan';
        $this->load->view('template_admin/header', $data);
        $this->load->view('template_admin/sidebar');
        $this->load->view('admin/mata_kuliah/form_edit');
        $this->load->view('template_admin/footer');
    }

    public function update()
    {
       $this->_rules();

        if ($this->form_validation->run() == false) {
            $this->form_edit();
        } else {
            $id = $this->input->post('id');
            $dec = $this->encryption->decrypt($id);
            $nama = htmlspecialchars($this->input->post('nama_matakuliah', true));
            $sks = htmlspecialchars($this->input->post('sks', true));
            $tahun = htmlspecialchars($this->input->post('tahun_akademik', true));
            $prodi = htmlspecialchars($this->input->post('nama_prodi', true));
            $data = [
                'id_tahun_akademik' => $tahun,
                'nama_matakuliah' => $nama,
                'sks' => $sks,
                'nama_prodi' => $prodi,
            ];
            $where = ['id_matakuliah' => $dec];

            $cek = $this->logic->update('mata_kuliah', $data, $where);

            if ($cek == true) {
                $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Data berhasil di edit !!</strong> 
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>');
                redirect('mata_kuliah');
            } else {
                $this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Data gagal di edit !!</strong> 
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>');
                redirect('mata_kuliah');
            }
        }
    }

    public function delete()
    {
        $id = $this->input->post('id');
        $dec = $this->encryption->decrypt($id);
        $where = ['kode_matakuliah' => $dec];
        $cek = $this->logic->delete('mata_kuliah', $where);
        if ( $cek > 0 ) {
            $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Data berhasil di Hapus !!</strong> 
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </div>');
            redirect('mata_kuliah');
        } else {
            $this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Data gagal di Hapus !!</strong> 
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </div>');
            redirect('mata_kuliah');
        }
    }
}