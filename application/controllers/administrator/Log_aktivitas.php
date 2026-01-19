<?php defined('BASEPATH') OR exit('No direct script access allowed'); 

class Log_aktivitas extends CI_Controller {

  public function __construct() {
    parent::__construct();
    $this->load->library('session');
    $this->load->model('Model_activity_log');
    $this->load->model('Model_dashboard', 'd');

    // Proteksi akses: hanya Administrator
    if ($this->session->userdata('admin_valid') != TRUE) {
      redirect('login');
    }

    // Pastikan role admin (0)
    if ((string)$this->session->userdata('role') !== '0') {
      show_error('Akses ditolak. Hanya Administrator.', 403);
    }
  }

  public function index() {
    $data['title'] = 'Log Aktivitas';

    $status = strtolower(trim((string)$this->input->get('status', TRUE))); // normal/gagal/warning
    $data['status'] = $status;

    $filters = [
      'q'     => $this->input->get('q', TRUE),
      'start' => $this->input->get('start', TRUE),
      'end'   => $this->input->get('end', TRUE),
      'role'  => $this->input->get('role', TRUE),
      'limit' => $this->input->get('limit', TRUE) ?: 500,

      // TAMBAHAN: status filter
      'status' => $status
    ];

    // Log open page (pakai add_as agar tidak guest)
    $this->Model_activity_log->add_as(
      $this->session->userdata('user_id'),
      $this->session->userdata('nama') . ' (' . $this->session->userdata('email') . ')',
      'Administrator',
      'OPEN_PAGE',
      'log_aktivitas',
      'Access: log_aktivitas::index'
    );

    $data['logs']    = $this->Model_activity_log->get_all($filters);
    $data['filters'] = $filters;
    
    // Get satker data for sidebar
    $active_satker = decrypt_url($this->session->userdata('active_satker'));
    $data['get_satker'] = $this->d->get_satker($active_satker);

    $this->load->view('layout/vhead'); 
    $this->load->view('administrator/log_aktivitas/index', $data);

    // FIX: sidebar perlu $data karena pakai $get_satker
    $this->load->view('layout/vsidebar', $data); 
    $this->load->view('layout/vnav'); 
    $this->load->view('layout/vfooter');
  }
}
