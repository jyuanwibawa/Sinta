<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class LoginUser extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Model_user', 'u');
        $this->load->helper('security');
        $this->load->library('form_validation');

        // PENTING: Pastikan file application/models/Model_activity_log.php BENAR-BENAR ADA.
        // Jika file ini tidak ada, halaman akan BLANK PUTIH (Error 500).
        $this->load->model('Model_activity_log');
    }

    public function index()
    {
        if ($this->session->userdata('user_logged_in')) {
            redirect('dashboard_user');
        }

        $data['title'] = 'Login User';

        // PERBAIKAN DI SINI: Memanggil file di folder login_user/index.php
        $this->load->view('login_user/index', $data);
    }

    public function proses()
    {
        $email = $this->input->post('email');
        $password = $this->input->post('password');

        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        $this->form_validation->set_rules('password', 'Password', 'required');

        if ($this->form_validation->run() == FALSE) {
            // Cek apakah model log terload sebelum memanggil methodnya
            if(isset($this->Model_activity_log)) {
                $this->Model_activity_log->add(
                    'LOGIN_FAIL',
                    'login_user',
                    'Validasi form gagal. Email input: ' . $this->input->post('email', TRUE)
                );
            }

            $this->session->set_flashdata('error', 'Email dan password harus diisi dengan benar');
            redirect('loginuser');
        }

        $encrypted_password = md5($password);
        $cek = $this->u->cek($email, $encrypted_password);

        if ($cek->num_rows() > 0) {
            $row = $cek->row();

            // Cek Role (User = 1)
            if ($row->role != '1') {
                if(isset($this->Model_activity_log)) {
                    $this->Model_activity_log->add(
                        'ACCESS_DENIED',
                        'login_user',
                        'Akses ditolak (role bukan user). Email: ' . $email . ' | role: ' . $row->role
                    );
                }
                $this->session->set_flashdata('error', 'Akses ditolak! Halaman ini hanya untuk role user.');
                redirect('loginuser');
            }

            // Cek Aktivasi
            if ($row->aktivasi != 1) {
                if(isset($this->Model_activity_log)) {
                    $this->Model_activity_log->add(
                        'ACCESS_DENIED',
                        'login_user',
                        'Akun tidak aktif. Email: ' . $email . ' | aktivasi: ' . $row->aktivasi
                    );
                }
                $this->session->set_flashdata('error', 'Akun Anda tidak aktif. Silakan hubungi administrator.');
                redirect('loginuser');
            }

            // Set Session
            $sess_data = array(
                'user_logged_in' => TRUE,
                'user_id'     => $row->user_id,
                'email'       => $row->email,
                'nama'        => $row->nama,
                'role'        => $row->role,
                'role_text'   => $row->role_text,
                'satker_id'   => $row->satker_id,
                'jabatan_id'  => $row->jabatan_id,
                'login_time'  => date('Y-m-d H:i:s')
            );
            $this->session->set_userdata($sess_data);

            // Update waktu login
            $this->u->do_waktu_daftar($row->user_id);

            if(isset($this->Model_activity_log)) {
                $this->Model_activity_log->add(
                    'LOGIN',
                    'login_user',
                    'Login user berhasil. User: ' . $row->nama . ' | Email: ' . $row->email
                );
            }

            $this->session->set_flashdata('success', 'Selamat datang, ' . $row->nama . '!');
            redirect('dashboard_user');

        } else {
            if(isset($this->Model_activity_log)) {
                $this->Model_activity_log->add(
                    'LOGIN_FAIL',
                    'login_user',
                    'Login gagal (email/password salah). Email: ' . $email
                );
            }

            $this->session->set_flashdata('error', 'Email atau password salah!');
            redirect('loginuser');
        }
    }

    public function logout()
    {
        $nama  = $this->session->userdata('nama');
        $email = $this->session->userdata('email');
        
        if($email && isset($this->Model_activity_log)) {
            $this->Model_activity_log->add(
                'LOGOUT',
                'login_user',
                'Logout user. User: ' . $nama . ' | Email: ' . $email
            );
        }

        $this->session->sess_destroy();
        redirect('loginuser');
    }
}