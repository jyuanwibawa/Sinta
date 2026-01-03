<?php
defined('BASEPATH') or exit('No direct script access allowed');

class DetailTugas extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Model_pengerjaan', 'p');
        
        // Cek login user
        if (!$this->session->userdata('user_logged_in')) {
            redirect('loginuser');
        }
        
        // Cek apakah user memiliki role 'user'
        if ($this->session->userdata('role') != '1') {
            $this->session->sess_destroy();
            redirect('loginuser');
        }
    }

    public function index()
    {
        // Double check role untuk keamanan
        if ($this->session->userdata('role') != '1') {
            $this->session->sess_destroy();
            redirect('loginuser');
        }
        
        // Get current user ID from session
        $user_id = $this->session->userdata('user_id');
        
        // Get the latest pengerjaan for this user
        $pengerjaan = $this->p->get_latest_pengerjaan_by_user($user_id);
        
        if (!$pengerjaan) {
            $this->session->set_flashdata('error', 'Tidak ada pengerjaan yang ditemukan');
            redirect('dashboard_user');
        }
        
        $data = [
            'title' => 'Detail Tugas',
            'page' => 'detail_tugas/index',
            'user_data' => $this->session->userdata(),
            'pengerjaan' => $pengerjaan
        ];
        
        $this->load->view('index_user', $data);
    }
    
    public function update_status()
    {
        if (!$this->session->userdata('user_logged_in') || $this->session->userdata('role') != '1') {
            echo json_encode(['status' => 'error', 'message' => 'Unauthorized']);
            return;
        }
        
        $status = $this->input->post('status');
        $user_id = $this->session->userdata('user_id');
        
        // Get the latest pengerjaan for this user
        $pengerjaan = $this->p->get_latest_pengerjaan_by_user($user_id);
        
        if (!$pengerjaan) {
            echo json_encode(['status' => 'error', 'message' => 'Pengerjaan tidak ditemukan']);
            return;
        }
        
        // Update status
        $data = ['status' => $status];
        if ($this->p->update_pengerjaan($pengerjaan->id_pengerjaan, $data)) {
            echo json_encode(['status' => 'success', 'message' => 'Status berhasil diperbarui']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Gagal memperbarui status']);
        }
    }
}
