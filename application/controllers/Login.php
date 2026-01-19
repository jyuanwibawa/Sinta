<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller
{
    /**
     * elsyarex
     * bayuelsya@gmail.com
     **/
    function __construct()
    {
        parent::__construct();
        $this->load->model('Model_user','u');

        // model log
        $this->load->model('Model_activity_log');
    }

    function index()
    {
        $data['satker'] = $this->u->get_satker();
        $this->load->view('view_login',$data);
    }

    function proses()
    {
        // IMPORTANT: jangan load view di awal proses (bisa ganggu session/cookie)
        // $this->load->view('view_login');

        if ($this->session->userdata('admin_valid') == TRUE) {
            redirect("dashboard");
        }

        $this->form_validation->set_rules('email', 'email', 'required|valid_email|trim');
        $this->form_validation->set_rules('password', 'password', 'required|trim');

        if ($this->form_validation->run() == FALSE) {

            $this->Model_activity_log->add(
                'LOGIN_FAIL',
                'login',
                'Validasi form gagal (email/password tidak valid). Email input: '.$this->input->post('email', TRUE)
            );

            $this->session->set_flashdata('result_login', '<br>Cek kembali Username / Password / Captcha yang Anda masukkan.');
            redirect('login', 'refresh');

        } else {

            $usr = $this->input->post('email');
            $psw = $this->input->post('password');

            $u = $usr;
            $p = md5($psw);

            $cek = $this->u->cek($u, $p);

            if ($cek->num_rows() > 0) {

                foreach ($cek->result() as $row) {
                    $sess_data['user_id'] = $row->user_id;
                    $sess_data['nama'] = $row->nama;
                    $sess_data['email'] = $row->email;

                    // paksa role admin
                    $sess_data['role'] = '0';

                    $sess_data['images'] = $row->logo;
                    $sess_data['role_text'] = $row->role_text;
                    $sess_data['satker'] = $row->nama_satker;
                    $sess_data['jabatan'] = $row->nama_jabatan;
                    $sess_data['waktu_daftar'] = $row->waktu_daftar;
                    $sess_data['active_satker'] = encrypt_url($row->satker_id);
                    $sess_data['admin_valid'] = true;

                    // admin_* untuk fallback
                    $sess_data['admin_id'] = $row->user_id;
                    $sess_data['admin_nama'] = $row->nama;
                    $sess_data['admin_email'] = $row->email;

                    $this->session->set_userdata($sess_data);
                }

                // log login sukses (paksa identitas admin agar tidak guest)
                $this->Model_activity_log->add_as(
                    $this->session->userdata('user_id'),
                    $this->session->userdata('nama') . ' (' . $this->session->userdata('email') . ')',
                    'Administrator',
                    'LOGIN',
                    'login',
                    'Login berhasil. Email: '.$usr
                );

                redirect('dashboard');

            } else {

                $this->Model_activity_log->add(
                    'LOGIN_FAIL',
                    'login',
                    'Login gagal (password salah / user tidak ditemukan). Email: '.$usr
                );

                $this->session->set_flashdata('result_login', '<br>Username atau Password yang anda masukkan salah.');
                redirect('login');
            }
        }
    }

    function logout()
    {
        $nama  = $this->session->userdata('nama');
        $email = $this->session->userdata('email');

        $this->Model_activity_log->add(
            'LOGOUT',
            'login',
            'Logout. User: '.$nama.' ('.$email.')'
        );

        // bersihkan userdata
        $this->session->unset_userdata([
            'user_id','nama','email','role','images','role_text','satker','jabatan',
            'waktu_daftar','active_satker','admin_valid','admin_id','admin_nama','admin_email'
        ]);

        $this->session->sess_destroy();
        $this->output->set_header("Cache-Control: no-store, no-cache, must-revalidate, no-transform, max-age=0, post-check=0, pre-check=0");
        $this->output->set_header("Pragma: no-cache");
        redirect('login');
    }
}
