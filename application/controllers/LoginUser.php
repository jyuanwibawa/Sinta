<?php
defined('BASEPATH') or exit('No direct script access allowed');

class LoginUser extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('Model_user', 'u');
        $this->load->helper('security');
    }

    public function index()
    {
        if ($this->session->userdata('user_logged_in')) {
            redirect('dashboard_user');
        }
        
        $data['title'] = 'Login User';
        $this->load->view('login_user/index', $data);
    }

    public function proses()
    {
        $email = $this->input->post('email');
        $password = $this->input->post('password');

        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        $this->form_validation->set_rules('password', 'Password', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('error', 'Email dan password harus diisi dengan benar');
            redirect('loginuser');
        }

        // Enkripsi password dengan MD5 seperti login admin
        $encrypted_password = md5($password);
        $cek = $this->u->cek($email, $encrypted_password);

        if ($cek->num_rows() > 0) {
            $row = $cek->row();
            
            // Cek apakah user aktif
            if ($row->aktivasi != 1) {
                $this->session->set_flashdata('error', 'Akun Anda tidak aktif. Silakan hubungi administrator.');
                redirect('loginuser');
            }
            
            // Set session untuk user
            $sess_data = array(
                'user_logged_in' => TRUE,
                'user_id' => $row->user_id,
                'email' => $row->email,
                'nama' => $row->nama,
                'role' => $row->role,
                'role_text' => $row->role_text,
                'satker_id' => $row->satker_id,
                'jabatan_id' => $row->jabatan_id,
                'login_time' => date('Y-m-d H:i:s')
            );
            
            $this->session->set_userdata($sess_data);
            
            // Update waktu login
            $this->u->do_waktu_daftar($row->user_id);
            
            $this->session->set_flashdata('success', 'Selamat datang, ' . $row->nama . '!');
            redirect('dashboard_user');
            
        } else {
            $this->session->set_flashdata('error', 'Email atau password salah!');
            redirect('loginuser');
        }
    }

    public function logout()
    {
        $this->session->sess_destroy();
        redirect('loginuser');
    }
}
