<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dosen extends CI_controller{

    public function __construct()
    {
        parent::__construct();
        is_logged_in('login');
        $this->load->model('my_model', 'logic');
        $this->load->library('encryption');
        $this->load->library('upload');
    }

    public function index(){
        $data['dosen'] = $this->logic->get_all('dosen')->result();
        $data['title'] = 'Sisfo | Dosen';
        $this->load->view('template_admin/header', $data);
        $this->load->view('template_admin/sidebar');
        $this->load->view('admin/dosen/v_dosen');
        $this->load->view('template_admin/footer');
    }
    
    public function form_add()
    {
        $data['title'] = 'Tambah dosen';
        $this->load->view('template_admin/header', $data);
        $this->load->view('template_admin/sidebar');
        $this->load->view('admin/dosen/form_add');
        $this->load->view('template_admin/footer');
    }

    private function _rules() {
        $this->form_validation->set_rules('nidn', 'NIDN Dosen', 'required|numeric|max_length[10]|min_length[5]|is_unique[dosen.nidn]', [
            'required' => 'Wajib di isi !',
            'numeric' => 'hanya bisa di isi angka !',
            'max_length' => 'maksimal 10 karakter !',
            'min_length' => 'minimal 5 karakter !',
            'is_unique' => 'NIDN susah terdaftar !',
        ]);
        $this->form_validation->set_rules('nama_dosen', 'Nama dosen', 'required', [
            'required' => 'wajib di isi !',
        ]);
        $this->form_validation->set_rules('alamat', 'Alamat', 'required', [
            'required' => 'wajib di isi',
        ]);
        $this->form_validation->set_rules('telepon', 'No telepon', 'required|numeric', [
            'required' => 'wajib di isi',
            'numeric' => 'hanya boleh angka !'
        ]);
        $this->form_validation->set_rules('jenis_kelamin', 'Jenis kelamin', 'required|in_list[pria,wanita]', [
            'required' => 'wajib di isi',
            'in_list' => 'Silahkan pilih option dahulu !',
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
            $nidn = htmlspecialchars($this->input->post('nidn', true));
            $nama = htmlspecialchars($this->input->post('nama_dosen', true));
            $alamat = htmlspecialchars($this->input->post('alamat', true));
            $telepon = htmlspecialchars($this->input->post('telepon', true));
            $email = htmlspecialchars($this->input->post('email', true));
            $jenis_kelamin = htmlspecialchars($this->input->post('jenis_kelamin', true));
            $photo = $_FILES['photo']['name'];

            if ( empty($photo)){
                $this->session->set_flashdata('pesan', '<div class="alert alert-info alert-dismissible fade show" role="alert">
                <strong>Silahkan Upload foto dahulu ! </strong> 
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>');
                redirect('tambah-dosen');
            }else{
                $config['upload_path'] = './assets/uploads/dosen/';
                $config['allowed_types'] = 'jpg|png|gif|bmp';
                $config['encrypt_name'] = TRUE;
                $this->upload->initialize($config);   

                if ($this->upload->do_upload('photo')) {
                    $upload = $this->upload->data();
                    $config['image_library'] = 'gd2';
                    $config['source_image'] = './assets/uploads/dosen/'.$upload['file_name'];
                    $config['maintain_ratio'] = FALSE;
                    $config['quality'] = '75%';
                    $config['width'] = '100';
                    $config['height'] = '100';
                    $config['new_image'] = './assets/uploads/dosen/'.$upload['file_name'];
                    $this->load->library('image_lib',$config);
                    $this->image_lib->resize();
                    $gambar = $upload['file_name'];

                    $data = [
                        'nidn' => $nidn,
                        'nama_dosen' => $nama,
                        'alamat' => $alamat,
                        'jenis_kelamin' => $jenis_kelamin,
                        'email' => $email,
                        'telepon' => $telepon,
                        'foto' => $gambar
                    ];
                    $this->logic->store('dosen', $data);
        
                    $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Data berhasil di tambahkan !!</strong> 
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </div>');
                    redirect('dosen');
                }else{
                    $this->session->set_flashdata('pesan', $this->upload->display_errors('<div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>', '</strong> 
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </div>'));
                    redirect('tambah-dosen');
                }
            }
        }
    }

    public function form_edit()
    {
        $id = $this->input->post('id');
        $dec = $this->encryption->decrypt($id);
        $where = ['id_dosen' => $dec];
        $data['data'] = $this->logic->get_where('dosen', $where)->row_array();
        $data['title'] = 'edit data dosen';
        $this->load->view('template_admin/header', $data);
        $this->load->view('template_admin/sidebar');
        $this->load->view('admin/dosen/form_edit');
        $this->load->view('template_admin/footer');
    }

    public function update()
    {
        $id = $this->input->post('id');
        $dec = $this->encryption->decrypt($id);
        $nidn = htmlspecialchars($this->input->post('nidn', true));
        $nama = htmlspecialchars($this->input->post('nama_dosen', true));
        $alamat = htmlspecialchars($this->input->post('alamat', true));
        $telepon = htmlspecialchars($this->input->post('telepon', true));
        $email = htmlspecialchars($this->input->post('email', true));
        $jenis_kelamin = htmlspecialchars($this->input->post('jenis_kelamin', true));
        $photo = $_FILES['photo']['name'];

        if ($photo) {
            $fotoLama = $this->logic->query("SELECT foto FROM dosen WHERE id_dosen = '$dec'")->row_array();
            $config['upload_path'] = './assets/uploads/dosen/';
            $config['allowed_types'] = 'jpg|png|gif|bmp';
            $config['encrypt_name'] = TRUE;
            $this->upload->initialize($config);
            
            if ($this->upload->do_upload('photo')) {
                unlink(FCPATH.'assets/uploads/dosen/'.$fotoLama['foto']);

                $upload = $this->upload->data();
                $config['image_library'] = 'gd2';
                $config['source_image'] = './assets/uploads/dosen/' . $upload['file_name'];
                $config['maintain_ratio'] = FALSE;
                $config['quality'] = '75%';
                $config['width'] = '100';
                $config['height'] = '100';
                $config['new_image'] = './assets/uploads/dosen/' . $upload['file_name'];
                $this->load->library('image_lib', $config);
                $this->image_lib->resize();                    
                $gambar = $upload['file_name'];

                $this->db->set('foto',$gambar);
            } else {
                $this->session->set_flashdata('pesan', $this->upload->display_errors('<div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>', '</strong> 
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>'));
                redirect('dosen');
            }
        }
        $data = [
            'nidn' => $nidn,
            'nama_dosen' => $nama,
            'alamat' => $alamat,
            'jenis_kelamin' => $jenis_kelamin,
            'email' => $email,
            'telepon' => $telepon,
        ];

        $where = ['id_dosen'=>$dec];
        $this->logic->update('dosen', $data, $where);

        $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Data berhasil di edit !!</strong> 
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>');
        redirect('dosen');
    }

    public function delete()
    {
        $id = $this->input->post('id');
        $dec = $this->encryption->decrypt($id);
        $foto = $this->logic->query("SELECT foto FROM dosen WHERE id_dosen = '$dec'")->row_array();
        unlink(FCPATH.'assets/uploads/dosen/'.$foto['foto']);
        $where = ['id_dosen' => $dec];
        $cek = $this->logic->delete('dosen', $where);
        

        if ($cek == true ) {
            $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Data berhasil di Hapus !!</strong> 
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </div>');
            redirect('dosen');
        } else {
            $this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Data gagal di Hapus !!</strong> 
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </div>');
            redirect('dosen');
        }
    }
}