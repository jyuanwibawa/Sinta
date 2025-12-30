<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
// defined('BASEPATH') or exit('No direct script access allowed');

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
    }

    function index()
    {
        $data['satker'] = $this->u->get_satker();
        $this->load->view('view_login',$data);
    }

    function proses()
    {
        $this->load->view('view_login');
        if ($this->session->userdata('admin_valid') == TRUE) {
            redirect("dashboard");
        }

        $this->form_validation->set_rules('email', 'email', 'required|valid_email|trim');
        $this->form_validation->set_rules('password', 'password', 'required|trim');
        // $this->form_validation->set_rules('capcay', 'captcha', 'required|trim');

        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('result_login', '<br>Cek kembali Username / Password / Captcha yang Anda masukkan.');
            redirect('login', 'refresh');
        } else {

            $usr = $this->input->post('email');
            $psw = $this->input->post('password');
            $u = $usr;
            $p = md5($psw);
            $cek = $this->u->cek($u, $p);
            if ($cek->num_rows() > 0) {
                //login berhasil, buat session
                foreach ($cek->result() as $row) {
                    $sess_data['user_id'] = $row->user_id;
                    $sess_data['nama'] = $row->nama;
                    $sess_data['email'] = $row->email;
                    $sess_data['role'] = $row->role;
                    $sess_data['images'] = $row->logo;
                    // $sess_data['seksi'] = $row->seksi;
                    // $sess_data['bagian'] = $row->bagian;
                    $sess_data['role_text'] = $row->role_text;
                    $sess_data['satker'] = $row->nama_satker;
                    $sess_data['jabatan'] = $row->nama_jabatan;
                    $sess_data['waktu_daftar'] = $row->waktu_daftar;
                    $sess_data['active_satker'] = encrypt_url($row->satker_id);
                    $sess_data['admin_valid'] = true;
                    $this->session->set_userdata($sess_data);
                }
                redirect('dashboard');
            } else {
                $this->session->set_flashdata('result_login', '<br>Username atau Password yang anda masukkan salah.');

                redirect('login');
            }
        }
    }

    function logout()
    {
        $this->session->sess_destroy();
        $this->output->set_header("Cache-Control: no-store, no-cache, must-revalidate, no-transform, max-age=0, post-check=0, pre-check=0");
        $this->output->set_header("Pragma: no-cache");
        redirect('login');
    }
}
