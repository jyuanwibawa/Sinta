<?php defined('BASEPATH') OR exit('No direct script access allowed'); 

class Log_aktivitas extends CI_Controller {

  public function __construct() {
    parent::__construct();
    $this->load->library('session');
    $this->load->model('Model_activity_log');

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

    $filters = [
      'q'     => $this->input->get('q', TRUE),
      'start' => $this->input->get('start', TRUE),
      'end'   => $this->input->get('end', TRUE),
      'role'  => $this->input->get('role', TRUE),
      'limit' => $this->input->get('limit', TRUE) ?: 500
    ];

    $data['logs']    = $this->Model_activity_log->get_all($filters);
    $data['filters'] = $filters;

    $this->load->view('layout/vhead'); 
    $this->load->view('administrator/log_aktivitas/index', $data);
    $this->load->view('layout/vsidebar'); 
     $this->load->view('layout/vnav'); 
    $this->load->view('layout/vfooter');
  }
}
