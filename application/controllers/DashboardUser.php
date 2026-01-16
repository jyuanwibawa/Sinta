<?php
defined('BASEPATH') or exit('No direct script access allowed');

class DashboardUser extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('Model_user', 'u');
        $this->load->model('Model_dashboard', 'd');
        $this->load->model('Model_pengerjaan', 'p');
        $this->load->model('Model_notifikasi', 'n');
        
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
        
        // Get current user ID from session
        $user_id = $this->session->userdata('user_id');
        
        // Get pengerjaan data for this user
        $pengerjaan_list = $this->p->get_pengerjaan_by_user($user_id);
        $pengerjaan_stats = $this->p->get_pengerjaan_stats_by_user($user_id);

        // Hitung notif terbaca 
        $notif_unread = $this->n->count_unread_by_user($user_id);
        $notifikasi_list = $this->n->get_by_user($user_id);
        
        $data = [
            'title' => 'Dashboard User',
            'page' => 'dashboard_user/index',
            'user_data' => $this->session->userdata(),
            'total_users' => $this->u->count_user(),
            'pengerjaan_list' => $pengerjaan_list,
            'pengerjaan_stats' => $pengerjaan_stats,
            'notif_unread' => $notif_unread,
            'buku_panduan_url' => base_url('assets/panduan/buku_panduan_cleancourt.pdf')
        ];
        
        $this->load->view('index_user', $data);
    }
}
