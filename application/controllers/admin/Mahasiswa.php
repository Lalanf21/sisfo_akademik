<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mahasiswa extends CI_controller{

    public function __construct()
    {
        parent::__construct();
        is_logged_in('login');
        $this->load->model('my_model', 'logic');
        $this->load->library('encryption');
        $this->load->library('upload');
    }

    public function index(){
        $data['mahasiswa'] = $this->logic->get_all('mahasiswa')->result();
        $data['title'] = 'Sisfo | Mahasiswa';
        $this->load->view('template_admin/header', $data);
        $this->load->view('template_admin/sidebar');
        $this->load->view('admin/mahasiswa/v_mahasiswa');
        $this->load->view('template_admin/footer');
    }
    
    public function form_add()
    {
        $data['title'] = 'Tambah data mata kuliah';
        $data['prodi'] = $this->logic->query('SELECT nama_prodi FROM prodi')->result() ;
        $this->load->view('template_admin/header', $data);
        $this->load->view('template_admin/sidebar');
        $this->load->view('admin/mahasiswa/form_add', $data);
        $this->load->view('template_admin/footer');
    }

    private function _rules() {
        $this->form_validation->set_rules('nim', 'Nim mahasiswa', 'required|numeric|max_length[10]|min_length[5]|is_unique[mahasiswa.nim]', [
            'required' => 'Wajib di isi !',
            'numeric' => 'hanya bisa di isi angka !',
            'max_length' => 'maksimal 10 karakter !',
            'min_length' => 'minimal 5 karakter !',
            'is_unique' => 'NIM susah terdaftar !',
        ]);
        $this->form_validation->set_rules('nama_mahasiswa', 'Nama mahasiswa', 'required', [
            'required' => 'wajib di isi !'
        ]);
        $this->form_validation->set_rules('alamat', 'Alamat', 'required', [
            'required' => 'wajib di isi',
        ]);
        $this->form_validation->set_rules('telepon', 'No telepon', 'required|numeric', [
            'required' => 'wajib di isi',
            'numeric' => 'hanya boleh angka !'
        ]);
        $this->form_validation->set_rules('tempat_lahir', 'Tempat lahir', 'required', [
            'required' => 'wajib di isi',
        ]);
        $this->form_validation->set_rules('tanggal_lahir', 'tanggal lahir', 'required', [
            'required' => 'wajib di isi',
        ]);
        $this->form_validation->set_rules('nama_prodi', 'Nama Program Studi', 'alpha_numeric_spaces', [
            'alpha_numeric_spaces' => 'silahkan pilih option dahulu',
        ]);
        $this->form_validation->set_rules('jenis_kelamin', 'Jenis kelamin', 'required|alpha', [
            'required' => 'wajib di isi',
            'alpha' => 'Silahkan pilih option dahulu !',
        ]);
        $this->form_validation->set_rules('email', 'Alamat email', 'required|valid_email', [
            'required' => 'wajib di isi',
            'valid_email' => 'Alamat email tidak valid',
        ]);

    }

    public function store()
    {
        $this->_rules();

        if ($this->form_validation->run() == false) {
            $this->form_add();
        } else {
            $nim = htmlspecialchars($this->input->post('nim', true));
            $nama = htmlspecialchars($this->input->post('nama_mahasiswa', true));
            $alamat = htmlspecialchars($this->input->post('alamat', true));
            $telepon = htmlspecialchars($this->input->post('telepon', true));
            $tempat_lahir = htmlspecialchars($this->input->post('tempat_lahir', true));
            $tanggal_lahir = htmlspecialchars($this->input->post('tanggal_lahir', true));
            $email = htmlspecialchars($this->input->post('email', true));
            $jenis_kelamin = htmlspecialchars($this->input->post('jenis_kelamin', true));
            $prodi = htmlspecialchars($this->input->post('nama_prodi', true));
            $photo = $_FILES['photo']['name'];

            if ( empty($photo)){
                $this->session->set_flashdata('pesan', '<div class="alert alert-info alert-dismissible fade show" role="alert">
                <strong>Silahkan Upload foto dahulu ! </strong> 
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>');
                redirect('tambah-mahasiswa');
            }else{
                $config['upload_path'] = './assets/uploads/';
                $config['allowed_types'] = 'jpg|png|gif|bmp';
                $config['encrypt_name'] = TRUE;
                $this->upload->initialize($config);   

                if ($this->upload->do_upload('photo')) {
                    $upload = $this->upload->data();
                    $config['image_library'] = 'gd2';
                    $config['source_image'] = './assets/uploads/'.$upload['file_name'];
                    $config['maintain_ratio'] = FALSE;
                    $config['quality'] = '75%';
                    $config['width'] = '100';
                    $config['height'] = '100';
                    $config['new_image'] = './assets/uploads/'.$upload['file_name'];
                    $this->load->library('image_lib',$config);
                    $this->image_lib->resize();
                    $gambar = $upload['file_name'];

                    $data = [
                        'nim' => $nim,
                        'nama_lengkap' => $nama,
                        'alamat' => $alamat,
                        'email' => $email,
                        'telepon' => $telepon,
                        'tempat_lahir' => $tempat_lahir,
                        'tanggal_lahir' => $tanggal_lahir,
                        'jenis_kelamin' => $jenis_kelamin,
                        'nama_prodi' => $prodi,
                        'photo' => $gambar
                    ];
                    $this->logic->store('mahasiswa', $data);
        
                    $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Data berhasil di tambahkan !!</strong> 
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </div>');
                    redirect('mahasiswa');
                }else{
                    $this->session->set_flashdata('pesan', $this->upload->display_errors('<div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>', '</strong> 
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </div>'));
                    redirect('tambah-mahasiswa');
                }
            }
        }
    }

    public function form_edit()
    {
        $id = $this->input->post('id');
        $dec = $this->encryption->decrypt($id);
        $where = ['id_mahasiswa' => $dec];
        $data['data'] = $this->logic->get_where('mahasiswa', $where)->row_array();
        $data['prodi'] = $this->logic->query('SELECT nama_prodi FROM prodi')->result();
        $data['title'] = 'edit data mahasiswa';
        $this->load->view('template_admin/header', $data);
        $this->load->view('template_admin/sidebar');
        $this->load->view('admin/mahasiswa/form_edit');
        $this->load->view('template_admin/footer');
    }

    public function update()
    {
        $id = $this->input->post('id');
        $dec = $this->encryption->decrypt($id);
        $nim = htmlspecialchars($this->input->post('nim', true));
        $nama = htmlspecialchars($this->input->post('nama_mahasiswa', true));
        $alamat = htmlspecialchars($this->input->post('alamat', true));
        $telepon = htmlspecialchars($this->input->post('telepon', true));
        $tempat_lahir = htmlspecialchars($this->input->post('tempat_lahir', true));
        $tanggal_lahir = htmlspecialchars($this->input->post('tanggal_lahir', true));
        $email = htmlspecialchars($this->input->post('email', true));
        $jenis_kelamin = htmlspecialchars($this->input->post('jenis_kelamin', true));
        $prodi = htmlspecialchars($this->input->post('nama_prodi', true));
        $photo = $_FILES['photo']['name'];

        if ($photo) {
            $fotoLama = $this->logic->query("SELECT photo FROM mahasiswa WHERE id_mahasiswa = '$dec'")->row_array();
            $config['upload_path'] = './assets/uploads/';
            $config['allowed_types'] = 'jpg|png|gif|bmp';
            $config['encrypt_name'] = TRUE;
            $this->upload->initialize($config);
            
            if ($this->upload->do_upload('photo')) {
                unlink(FCPATH.'assets/uploads/'.$fotoLama['photo']);

                $upload = $this->upload->data();
                $config['image_library'] = 'gd2';
                $config['source_image'] = './assets/uploads/' . $upload['file_name'];
                $config['maintain_ratio'] = FALSE;
                $config['quality'] = '75%';
                $config['width'] = '100';
                $config['height'] = '100';
                $config['new_image'] = './assets/uploads/' . $upload['file_name'];
                $this->load->library('image_lib', $config);
                $this->image_lib->resize();                    
                $gambar = $upload['file_name'];

                $this->db->set('photo',$gambar);
            } else {
                $this->session->set_flashdata('pesan', $this->upload->display_errors('<div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>', '</strong> 
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>'));
                redirect('mahasiswa');
            }
        }
        $data = [
            'nim' => $nim,
            'nama_lengkap' => $nama,
            'alamat' => $alamat,
            'email' => $email,
            'telepon' => $telepon,
            'tempat_lahir' => $tempat_lahir,
            'tanggal_lahir' => $tanggal_lahir,
            'jenis_kelamin' => $jenis_kelamin,
            'nama_prodi' => $prodi
        ];

        $where = ['id_mahasiswa'=>$dec];
        $this->logic->update('mahasiswa', $data, $where);

        $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Data berhasil di edit !!</strong> 
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>');
        redirect('mahasiswa');
    }

    public function delete()
    {
        $id = $this->input->post('id');
        $dec = $this->encryption->decrypt($id);
        $foto = $this->logic->query("SELECT photo FROM mahasiswa WHERE id = '$dec'")->row_array();
        unlink(FCPATH.'assets/uploads/'.$foto['photo']);
        $where = ['id_mahasiswa' => $dec];
        $cek = $this->logic->delete('mahasiswa', $where);
        

        if ($cek == true ) {
            $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Data berhasil di Hapus !!</strong> 
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </div>');
            redirect('mahasiswa');
        } else {
            $this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Data gagal di Hapus !!</strong> 
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </div>');
            redirect('mahasiswa');
        }
    }
}