<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Pertanahan extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->library('session');
        $this->load->model('Model_kasus', 'kasus');
    }

    /*
       Display all records in page
    */
    public function index()
    {
        if ($this->session->userdata('admin_valid') == FALSE && $this->session->userdata('email') == "") {
            redirect("login");
        }

        $data = [
            'all' => $this->kasus->get_all(),
            'get_list_jeniskasus' => $this->kasus->get_list_jeniskasus(),
            'get_list_objek' => $this->kasus->get_list_objek(),
            'title' => 'Semua Kasus',
            'page' => 'pertanahan/regis_data',
        ];
        $this->load->view('index', $data);
    }
}
