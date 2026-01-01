<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Simetri extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->helper('security');
        $this->load->model('Model_dashboard', 'd');
        $this->load->model('Model_user', 'u');
        if ($this->session->userdata('admin_valid') == FALSE && $this->session->userdata('email') == "") {
            redirect("login");
        }
    }

    public function index()
    {
        $active_satker = 0;
        // Coba decrypt jika session ada, jika tidak gunakan default
        if ($this->session->userdata('active_satker')) {
            try {
                $active_satker = decrypt_url($this->session->userdata('active_satker'));
            } catch (Exception $e) {
                $active_satker = 0;
            }
        }
        
        // Ambil data user dari Model_user menggunakan method semua()
        try {
            $users = $this->u->semua();
        } catch (Exception $e) {
            $users = [];
        }
        
        $data = [
            'title' => 'Integrasi Simetri',
            'page' => 'simetri/index',
            'get_satker' => $this->d->get_satker($active_satker),
            'users' => $users
        ];
        $this->load->view('index', $data);
    }
}
