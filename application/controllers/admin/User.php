<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_controller{

    public function __construct()
    {
        parent::__construct();
        is_logged_in('login');
        $this->load->model('my_model', 'logic');
        $this->load->library('encryption');
    }

    public function index(){
        $data['title'] = 'Sisfo | User';
        $data['user'] = $this->logic->get_all('user')->result();
        $this->load->view('template_admin/header', $data);
        $this->load->view('template_admin/sidebar');
        $this->load->view('admin/user/v_user');
        $this->load->view('template_admin/footer');
    }

    public function form_add()
    {
        $data['title'] = 'Tambah user';
        $this->load->view('template_admin/header', $data);
        $this->load->view('template_admin/sidebar');
        $this->load->view('admin/user/form_add');
        $this->load->view('template_admin/footer');
    }

    public function _rules() { 
        $this->form_validation->set_rules('username','Username','required|is_unique[user.username]',[
            'required' => 'Wajib di isi !',
            'is_unique' => 'username sudah ada'
        ]);
        $this->form_validation->set_rules('email','Email','required|valid_email',[
            'required' => 'wajib di isi',
            'valid_email' => 'alamat email tidak valid'
        ]);
        $this->form_validation->set_rules('level','level','required|in_list[user,admin]',[
            'required' => 'wajib di isi',
            'in_list' => 'Silahkan pilih option dahulu'
        ]);
        $this->form_validation->set_rules('blokir','blokir','required|in_list[Y,N]',[
            'required' => 'wajib di isi',
            'in_list' => 'Silahkan pilih option dahulu'
        ]);
        $this->form_validation->set_rules('password1','Password','required|matches[password2]|min_length[5]',[
            'required' => 'wajib di isi',
            'matches' => 'kata sandi tidak sama !',
            'min_length' => 'minimal 5 karakter!'
        ]);
        $this->form_validation->set_rules('password2','Password','required|matches[password1]|min_length[5]',[
            'required' => 'wajib di isi',
            'matches' => 'kata sandi tidak sama !',
            'min_length' => 'minimal 5 karakter'
        ]);
    }   

    public function store()
    {
        $this->_rules();
        if ($this->form_validation->run() == false) {
            $this->form_add();
        } else {
            $user = htmlspecialchars($this->input->post('username', true));
            $email = htmlspecialchars($this->input->post('email', true));
            $password = htmlspecialchars($this->input->post('password1', true));
            $level = htmlspecialchars($this->input->post('level', true));
            $blokir = htmlspecialchars($this->input->post('blokir', true));
            $hash_pass = password_hash($password,PASSWORD_DEFAULT);

            $data = [
                'username' => $user,
                'password' => $hash_pass,
                'email' => $email,
                'level' => $level,
                'blokir' => $blokir
            ];
            $this->logic->store('user', $data);

            $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Data berhasil di tambahkan !!</strong> 
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>');
            redirect('user');
            
        }
    }

    public function form_edit()
    {
        $id = $this->input->post('id');
        $dec = $this->encryption->decrypt($id);
        $where = ['id_user' => $dec];
        $data['data'] = $this->logic->get_where('user', $where)->row_array();
        $data['title'] = 'edit user';
        $this->load->view('template_admin/header', $data);
        $this->load->view('template_admin/sidebar');
        $this->load->view('admin/user/form_edit');
        $this->load->view('template_admin/footer');
    }

    public function update()
    {
        $this->form_validation->set_rules('username', 'Username', 'required|is_unique[user.username]', [
            'required' => 'Wajib di isi !',
            'is_unique' => 'username sudah ada'
        ]);
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email', [
            'required' => 'wajib di isi',
            'valid_email' => 'alamat email tidak valid'
        ]);
        $this->form_validation->set_rules('level', 'level', 'required|in_list[user,admin]', [
            'required' => 'wajib di isi',
            'in_list' => 'Silahkan pilih option dahulu'
        ]);
        $this->form_validation->set_rules('blokir', 'blokir', 'required|in_list[Y,N]', [
            'required' => 'wajib di isi',
            'in_list' => 'Silahkan pilih option dahulu'
        ]);
        
        if ($this->form_validation->run() == false) {
            $this->form_edit();
        } else {
            $id = $this->input->post('id');
            $dec = $this->encryption->decrypt($id);
            $user = htmlspecialchars($this->input->post('username', true));
            $email = htmlspecialchars($this->input->post('email', true));
            $level = htmlspecialchars($this->input->post('level', true));
            $blokir = htmlspecialchars($this->input->post('blokir', true));
            $data = [
                'username' => $user,
                'email' => $email,
                'level' => $level,
                'blokir' => $blokir,
            ];
            $where = ['id_user' => $dec];

            $cek = $this->logic->update('user', $data, $where);

            if ($cek == true) {
                $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Data berhasil di edit !!</strong> 
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>');
                redirect('user');
            } else {
                $this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Data gagal di edit !!</strong> 
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>');
                redirect('edit-user');
            }
        }
    }

    public function ganti_pass() {
        $data['title'] = 'Sisfo | ganti password';
        $where = ['username' => $this->session->userdata('username')];
        
        $this->form_validation->set_rules('password1', 'Password', 'required|matches[password2]|min_length[5]', [
            'required' => 'wajib di isi',
            'matches' => 'kata sandi tidak sama !',
            'min_length' => 'minimal 5 karakter!'
            ]);
            $this->form_validation->set_rules('password2', 'Password', 'required|matches[password1]|min_length[5]', [
                'required' => 'wajib di isi',
                'matches' => 'kata sandi tidak sama !',
                'min_length' => 'minimal 5 karakter'
                ]);
                
                if ($this->form_validation->run() == false) {
                    $this->load->view('template_admin/header', $data);
                    $this->load->view('template_admin/sidebar');
                    $this->load->view('admin/user/ganti_pass');
                    $this->load->view('template_admin/footer');
                } else {
                    $get_PassLama = $this->logic->get_where('user',$where)->row()->password;
                    $passLama = htmlspecialchars($this->input->post('passwordLama'));
                    $verifikasi = password_verify($passLama,$get_PassLama);
                    if ( $verifikasi == true ){
                        $passbaru = htmlspecialchars($this->input->post('password1'));
                        $pass_hash = password_hash($passbaru,PASSWORD_DEFAULT) ;
                        $this->db->set('password',$pass_hash);
                        $this->db->update('user',['username'=>$this->session->userdata('username')]);

                        $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong>Password berhasil di ganti !!</strong> 
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            </div>');
                        redirect('admin');
                    } else{
                        $this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong>Password lama anda salah !!</strong> 
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            </div>');
                        redirect('ganti-password');
                    }
                }
            }
            
    public function delete()
    {
        $id = $this->input->post('id');
        $dec = $this->encryption->decrypt($id);
        $where = ['id_user' => $dec];
        $cek = $this->logic->delete('user', $where);
        if ($cek == true) {
            $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Data berhasil di Hapus !!</strong> 
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </div>');
            redirect('user');
        } else {
            $this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Data gagal di Hapus !!</strong> 
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </div>');
            redirect('user');
        }
    }
}