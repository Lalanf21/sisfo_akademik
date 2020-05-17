<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Program_studi extends CI_controller{

    public function __construct()
    {
        parent::__construct();
        is_logged_in('login');
        $this->load->model('my_model', 'logic');
        $this->load->library('encryption');
    }

    public function index(){
        $data['prodi'] = $this->logic->get_all('prodi')->result();
        // var_dump($data['prodi']);die;
        $data['title'] = 'Sisfo | Program Studi';
        $this->load->view('template_admin/header', $data);
        $this->load->view('template_admin/sidebar');
        $this->load->view('admin/prodi/v_prodi');
        $this->load->view('template_admin/footer');
    }
    
    public function form_add()
    {
        $data['title'] = 'Tambah data program studi';
        $data['jurusan'] = $this->logic->query('SELECT nama_jurusan FROM jurusan')->result() ;
        // var_dump($data['jurusan']);die;
        $this->load->view('template_admin/header', $data);
        $this->load->view('template_admin/sidebar');
        $this->load->view('admin/prodi/form_add', $data);
        $this->load->view('template_admin/footer');
    }

    public function form_edit()
    {
        $id = $this->input->post('id');
        $dec = $this->encryption->decrypt($id);
        $where = ['id_prodi' => $dec];
        $data['data'] = $this->logic->get_where('prodi', $where)->row_array();
        $data['jurusan'] = $this->logic->query('SELECT nama_jurusan FROM jurusan')->result();
        $data['title'] = 'edit data Jurusan';
        $this->load->view('template_admin/header', $data);
        $this->load->view('template_admin/sidebar');
        $this->load->view('admin/prodi/form_edit');
        $this->load->view('template_admin/footer');
    }

    public function update()
    {
        $this->form_validation->set_rules('kode_prodi', 'Kode Prodi', 'required', [
            'required' => 'Wajib di isi !'
        ]);
        $this->form_validation->set_rules('nama_prodi', 'Nama Prodi', 'required', [
            'required' => 'wajib di isi !'
        ]);
        $this->form_validation->set_rules('nama_jurusan', 'Nama Jurusan', 'required|alpha_numeric_spaces', [
            'required' => 'wajib di isi',
            'alpha_numeric_spaces' => 'silahkan pilih option dahulu !'
        ]);

        if ($this->form_validation->run() == false) {
            $this->form_edit();
        } else {
            $id = $this->input->post('id');
            $dec = $this->encryption->decrypt($id);
            $kode = htmlspecialchars($this->input->post('kode_prodi', true));
            $jurusan = htmlspecialchars($this->input->post('nama_jurusan', true));
            $nama = htmlspecialchars($this->input->post('nama_prodi', true));
            $data = [
                'kode_prodi' => $kode,
                'nama_prodi' => $nama,
                'nama_jurusan' => $jurusan
            ];
            $where = ['id_prodi' => $dec];

            $cek = $this->logic->update('prodi', $data, $where);

            if ($cek == true) {
                $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Data berhasil di edit !!</strong> 
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>');
                redirect('program_studi');
            } else {
                $this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Data gagal di edit !!</strong> 
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>');
                redirect('edit-prodi');
            }
        }
    }

    public function store()
    {
        $this->form_validation->set_rules('kode_prodi', 'Kode Prodi', 'required', [
            'required' => 'Wajib di isi !'
        ]);
        $this->form_validation->set_rules('nama_prodi', 'Nama Prodi', 'required', [
            'required' => 'wajib di isi !'
        ]);
        $this->form_validation->set_rules('nama_jurusan', 'Nama Jurusan', 'required|alpha_numeric_spaces',[
            'required' => 'wajib di isi',
            'alpha_numeric_spaces' => 'silahkan pilih option dahulu !'
        ]);

        if ($this->form_validation->run() == false) {
            $this->form_add();
        } else {
            $kode = htmlspecialchars($this->input->post('kode_prodi', true));
            $nama = htmlspecialchars($this->input->post('nama_prodi', true));
            $jurusan = htmlspecialchars($this->input->post('nama_jurusan', true));

            $where = [
                'kode_prodi' => $kode,
                'nama_prodi' => $nama,
                'nama_jurusan' => $jurusan
            ];
            $cek = $this->logic->get_where('prodi', $where);

            if ($cek->num_rows() > 0) {
                $this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Data Sudah Ada !!</strong> 
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>');
                redirect('tambah-jurusan');
            } else {
                $data = [
                    'kode_prodi' => $kode,
                    'nama_prodi' => $nama,
                    'nama_jurusan' => $jurusan
                ];
                $this->logic->store('prodi', $data);

                $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Data berhasil di tambahkan !!</strong> 
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>');
                redirect('program_studi');
            }
        }
    }

    public function delete()
    {
        $id = $this->input->post('id');
        $dec = $this->encryption->decrypt($id);
        $where = ['id_prodi' => $dec];
        $cek = $this->logic->delete('prodi', $where);
        if ($cek == true ) {
            $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Data berhasil di Hapus !!</strong> 
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </div>');
            redirect('program_studi');
        } else {
            $this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Data gagal di Hapus !!</strong> 
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </div>');
            redirect('program_studi');
        }
    }
}