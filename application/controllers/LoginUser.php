<?php
defined('BASEPATH') or exit('No direct script access allowed');

class LoginUser extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('Model_user', 'u');
        $this->load->helper('security');

        // model log
        $this->load->model('Model_activity_log');
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

            // log login gagal (validasi form)
            $this->Model_activity_log->add(
                'LOGIN_FAIL',
                'login_user',
                'Validasi form gagal. Email input: ' . $this->input->post('email', TRUE)
            );

            $this->session->set_flashdata('error', 'Email dan password harus diisi dengan benar');
            redirect('loginuser');
        }

        // Enkripsi password dengan MD5 seperti login admin
        $encrypted_password = md5($password);
        $cek = $this->u->cek($email, $encrypted_password);

        if ($cek->num_rows() > 0) {
            $row = $cek->row();

            // Database menggunakan angka: 0 = admin, 1 = user
            if ($row->role != '1') {

                // log akses ditolak (role bukan user)
                $this->Model_activity_log->add(
                    'ACCESS_DENIED',
                    'login_user',
                    'Akses ditolak (role bukan user). Email: ' . $email . ' | role: ' . $row->role
                );

                $this->session->set_flashdata('error', 'Akses ditolak! Halaman ini hanya untuk role user.');
                redirect('loginuser');
            }

            // Cek apakah user aktif
            if ($row->aktivasi != 1) {

                // log akses ditolak (akun non-aktif)
                $this->Model_activity_log->add(
                    'ACCESS_DENIED',
                    'login_user',
                    'Akun tidak aktif. Email: ' . $email . ' | aktivasi: ' . $row->aktivasi
                );

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

            //log login sukses (setelah session dibuat)
            $this->Model_activity_log->add(
                'LOGIN',
                'login_user',
                'Login user berhasil. User: ' . $row->nama . ' | Email: ' . $row->email
            );

            $this->session->set_flashdata('success', 'Selamat datang, ' . $row->nama . '!');
            redirect('dashboard_user');

        } else {

            // log login gagal (email/password salah)
            $this->Model_activity_log->add(
                'LOGIN_FAIL',
                'login_user',
                'Login gagal (email/password salah). Email: ' . $email
            );

            $this->session->set_flashdata('error', 'Email atau password salah!');
            redirect('loginuser');
        }
    }

    public function logout()
    {
        // log logout (ambil data sebelum session dihancurkan)
        $nama  = $this->session->userdata('nama');
        $email = $this->session->userdata('email');
        $this->Model_activity_log->add(
            'LOGOUT',
            'login_user',
            'Logout user. User: ' . $nama . ' | Email: ' . $email
        );

        $this->session->sess_destroy();
        redirect('loginuser');
    }
}
