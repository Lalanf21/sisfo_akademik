<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Jurusan extends CI_controller{

    public function __construct() { 
        parent::__construct();
        is_logged_in('login');
        $this->load->model('my_model','logic');
        $this->load->library('encryption');
    }

    public function index(){
        $data['jurusan'] = $this->logic->get_all('jurusan')->result();
        $data['title'] = 'Sisfo | Jurusan';
        $this->load->view('template_admin/header', $data);
        $this->load->view('template_admin/sidebar');
        $this->load->view('admin/jurusan/v_jurusan');
        $this->load->view('template_admin/footer');
    }
    
    public function form_add() {
        $data['title'] = 'Tambah data Jurusan';
        $this->load->view('template_admin/header', $data);
        $this->load->view('template_admin/sidebar');
        $this->load->view('admin/jurusan/form_add');
        $this->load->view('template_admin/footer');
    }

    public function form_edit() {
        $id = $this->input->post('id');
        $dec = $this->encryption->decrypt($id);
        $where = ['id_jurusan'=>$dec];
        $data['data'] = $this->logic->get_where('jurusan', $where)->row_array();
        $data['title'] = 'edit data Jurusan';
        $this->load->view('template_admin/header', $data);
        $this->load->view('template_admin/sidebar');
        $this->load->view('admin/jurusan/form_edit');
        $this->load->view('template_admin/footer');
    }

    public function update() { 
        $this->form_validation->set_rules('kode_jurusan','Kode Jurusan','required',[
            'required' => 'Wajib di isi !'
        ]);
        $this->form_validation->set_rules('nama_jurusan','Nama Jurusan','required', [
            'required' => 'wajib di isi !'
        ]);

        if ( $this->form_validation->run() == false ){
            $this->form_edit();
        } else{
            $id = $this->input->post('id');
            $dec = $this->encryption->decrypt($id);
            $kode = htmlspecialchars($this->input->post('kode_jurusan',true));
            $nama = htmlspecialchars($this->input->post('nama_jurusan',true));
            $data = [
                'kode_jurusan' => $kode,
                'nama_jurusan' => $nama
            ];
            $where = ['id_jurusan'=>$dec];

            $cek = $this->logic->update('jurusan', $data, $where);
            
            if ($cek == true) {
                $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Data berhasil di edit !!</strong> 
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>');
                redirect('jurusan') ;
            } else{
                $this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Data gagal di edit !!</strong> 
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>');
                redirect('edit-jurusan');
            }
        }
    }

    public function store() { 
        $this->form_validation->set_rules('kode_jurusan','Kode Jurusan','required',[
            'required' => 'Wajib di isi !'
        ]);
        $this->form_validation->set_rules('nama_jurusan','Nama Jurusan','required', [
            'required' => 'wajib di isi !'
        ]);

        if ( $this->form_validation->run() == false ){
            $this->form_add();
        } else{
            $kode = htmlspecialchars($this->input->post('kode_jurusan',true));
            $nama = htmlspecialchars($this->input->post('nama_jurusan',true));

            $where = [
                'kode_jurusan' => $kode,
                'nama_jurusan' => $nama,
            ];
            $cek = $this->logic->get_where('jurusan', $where);
            
            if ($cek->num_rows() > 0) {
                $this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Data Sudah Ada !!</strong> 
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>');
                redirect('tambah-jurusan') ;
            } else{
                $data = [
                    'kode_jurusan' => $kode,
                    'nama_jurusan' => $nama
                ];
                $this->logic->store('jurusan',$data);

                $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Data berhasil di tambahkan !!</strong> 
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>');
                redirect('jurusan');
            }
        }
    }

    public function delete() { 
        $id = $this->input->post('id');
        $dec = $this->encryption->decrypt($id);
        $where = ['id_jurusan'=>$dec];
        $cek = $this->logic->delete('jurusan', $where);
        if ( $cek == true ){
            $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Data berhasil di Hapus !!</strong> 
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </div>');
            redirect('jurusan');
        } else {
            $this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Data gagal di Hapus !!</strong> 
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </div>');
            redirect('jurusan');
        }
    }
}