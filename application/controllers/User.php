<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('Model_user', 'u');
        $this->load->model('Model_kasus', 'k');
    }

    public function index()
    {
        if ($this->session->userdata('admin_valid') == FALSE && $this->session->userdata('email') == "") {
            redirect("login");
        } elseif ($this->session->userdata('role_text') != 'Super Admin') {
            $this->session->sess_destroy();
            redirect("login");
        }

        $data = [
            'all' => $this->u->semua(),
            'title' => 'Manajemen User',
            'page' => 'user/regis_data',
        ];
        $this->load->view('index', $data);
    }

    public function show($id)
    {
        if ($this->session->userdata('admin_valid') == FALSE && $this->session->userdata('email') == "") {
            redirect("login");
        } elseif ($this->session->userdata('role_text') != 'Super Admin') {
            $this->session->sess_destroy();
            redirect("login");
        }

        $data = [
            'show' => $this->u->get(decrypt_url($id)),
            'get_list_seksi' => $this->k->get_list_seksi(),
            'get_list_jkajian' => $this->k->get_list_jkajian(),
            'title' => 'Manajemen User',
            'page' => 'user/detil_data',
        ];
        $this->load->view('index', $data);
    }

    public function update($id)
    {
        if ($this->session->userdata('admin_valid') == FALSE && $this->session->userdata('email') == "") {
            redirect("login");
        } elseif ($this->session->userdata('role_text') != 'Super Admin') {
            $this->session->sess_destroy();
            redirect("login");
        }
        $this->form_validation->set_rules('nama', 'Nama', 'required');
        $this->form_validation->set_rules('email', 'E-mail', 'required');
        $this->form_validation->set_rules('seksi', 'Seksi', 'required');
        $this->form_validation->set_rules('bagian', 'Bagian', 'required');
        $this->form_validation->set_rules('aktivasi', 'Aktivasi', 'required');
        $this->form_validation->set_rules('password', 'Password Baru', 'required');
        $this->form_validation->set_rules('pin', 'Pin Baru', 'required');
        if (!$this->form_validation->run()) {
            $this->session->set_flashdata('errors', validation_errors());
        } else {
            $this->u->update(decrypt_url($id));
            $this->session->set_flashdata('success', "Updated Successfully!");
        }
        redirect(base_url('User/show/' . $id));
    }
}
