<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pengerjaan extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        // Load library yang diperlukan
        $this->load->library('session');
        $this->load->helper('url');
        $this->load->model('Model_dashboard', 'd');
        
        // Check if user is logged in (sesuai dengan pattern di aplikasi)
        if ($this->session->userdata('admin_valid') == FALSE && $this->session->userdata('email') == "") {
            redirect("login");
        }
    }

    public function index()
    {
        if ($this->session->userdata('admin_valid') == FALSE && $this->session->userdata('email') == "") {
            redirect("login");
        }
        
        $active_satker=decrypt_url($this->session->userdata('active_satker'));
        $data = [
            'title' => "Kelola Pengerjaan",
            'page' => "pengerjaan/index",
            'get_satker' => $this->d->get_satker($active_satker)
        ];

        $this->load->view('index', $data);
    }
}
