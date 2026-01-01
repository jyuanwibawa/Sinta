<?php
defined('BASEPATH') or exit('No direct script access allowed');

class DashboardUser extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('Model_user', 'u');
        $this->load->model('Model_dashboard', 'd');
        
        // Cek login user
        if (!$this->session->userdata('user_logged_in')) {
            redirect('loginuser');
        }
        
        // Cek apakah user memiliki role 'user'
        // Database menggunakan angka: 0 = admin, 1 = user
        if ($this->session->userdata('role') != '1') {
            $this->session->sess_destroy();
            redirect('loginuser');
        }
    }

    public function index()
    {
        // Double check role untuk keamanan
        // Database menggunakan angka: 0 = admin, 1 = user
        if ($this->session->userdata('role') != '1') {
            $this->session->sess_destroy();
            redirect('loginuser');
        }
        
        $data = [
            'title' => 'Dashboard User',
            'page' => 'dashboard_user/index',
            'user_data' => $this->session->userdata(),
            'total_users' => $this->u->count_user()
        ];
        
        $this->load->view('index_user', $data);
    }
}
