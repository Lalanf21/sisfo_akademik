<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Contact_us extends CI_controller{

    public function __construct() { 
        parent::__construct();
        is_logged_in('login');
        $this->load->model('my_model','logic');
        $this->load->helper('text');
    }

    public function index(){
        $data['contact'] = $this->logic->get_all('contact')->result();
        $data['title'] = 'Sisfo | Tentang kampus';
        $this->load->view('template_admin/header', $data);
        $this->load->view('template_admin/sidebar');
        $this->load->view('admin/contact/v_contact');
        $this->load->view('template_admin/footer');
    }

    private function _rules() {
        $this->form_validation->set_rules('nama', 'Nama', 'required', [
            'required' =>'wajib di isi !'
        ]);
        $this->form_validation->set_rules('subject', 'Subject', 'required', [
            'required' => 'wajib di isi !'
        ]);
        $this->form_validation->set_rules('pesan', 'Pesan', 'required', [
            'required' => 'wajib di isi !'
        ]);
        $this->form_validation->set_rules('email', 'email', 'required|valid_email', [
            'required' => 'Wajib di isi !',
            'valid_email' => 'Alamat email tidak valid'
        ]);
    }

    private function _view(){
        $data['title'] = 'Universitas Muhammadiyah Tangerang';
        $data['identitas'] = $this->logic->get_all('identitas')->row();
        $data['tentang'] = $this->logic->get_all('tentang_kampus')->row();
        $data['info'] = $this->logic->get_all('informasi_kampus')->result();
        $this->load->view('template_admin/header', $data);
        $this->load->view('front_end/home');
        $this->load->view('template_admin/footer');
    }
    

    public function form() {
        $id = $this->input->post('id');
        $where = ['id_contact'=>$id];
        $data['data'] = $this->logic->get_where('contact', $where)->row_array();
        $data['title'] = 'Balas pesan';
        $this->load->view('template_admin/header', $data);
        $this->load->view('template_admin/sidebar');
        $this->load->view('admin/contact/form');
        $this->load->view('template_admin/footer');
    }

    public function store() { 
        $this->_rules();
        if ( $this->form_validation->run() == false ){
            $this->_view();
        }else {
            $pesan = htmlspecialchars($this->input->post('pesan',true));
            $subject = htmlspecialchars($this->input->post('subject',true));
            $email = htmlspecialchars($this->input->post('email',true));
            $nama = htmlspecialchars($this->input->post('nama',true));

            $data = [
                'nama' => $nama,
                'subject' => $subject,
                'email' => $email,
                'pesan' => $pesan
            ];

            $this->logic->store('contact',$data);

            $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Pesan sudah terkirim !!</strong> 
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>');
            redirect('home');
        }
    }

    public function send_mail() {
        $id = htmlspecialchars($this->input->post('id'));
        $subject = htmlspecialchars($this->input->post('subject'));
        $pesan = htmlspecialchars($this->input->post('pesan'));
        $to_email = htmlspecialchars($this->input->post('email'));
        $config = [
            'protocol'      => 'smtp',
            'smtp_host'     => 'ssl://smtp.googlemail.com',
            'smtp_port'     => '465',
            'smtp_user'     => 'informatikakelasd1@gmail.com',
            'smtp_pass'     => 'informatikad1',
            'mailtype'      => 'html',
            'charset'       => 'utf-8'
        ];

        $this->load->library('email', $config);
        $this->email->initialize($config);
        $this->email->set_newline("\r\n");

        $this->email->from('informatikakelasd1@gmail.com', 'balasan pesan siakad');
        $this->email->subject($subject);
        $this->email->to($to_email);
        $this->email->message($pesan);

        if ($this->email->send()) {
            $where = ['id_contact' =>$id];   
            $this->logic->delete('contact',$where);
            $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Pesan berhasil di balas !</strong> 
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>');
            redirect('contact-us');
        } else {
            echo $this->email->print_debugger();
            die;
        }
        
    }

}