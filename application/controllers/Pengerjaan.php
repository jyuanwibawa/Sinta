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
        $this->load->model('Model_pengerjaan', 'p');
        
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
            'get_satker' => $this->d->get_satker($active_satker),
            'pengerjaan_list' => $this->p->get_all_pengerjaan(),
            'dropdown_options' => $this->p->get_dropdown_options(),
            'statistics' => $this->p->get_statistics()
        ];

        $this->load->view('index', $data);
    }

    public function add() {
        if ($this->session->userdata('admin_valid') == FALSE && $this->session->userdata('email') == "") {
            redirect("login");
        }

        $id_ruangan = $this->input->post('id_ruangan');
        $id_user = $this->input->post('id_user');
        $tugas_array = $this->input->post('tugas');
        $standar_array = $this->input->post('standar');
        $prioritas = $this->input->post('prioritas');

        // Separate tugas and standar into different arrays
        $tugas_only = array();
        $standar_only = array();
        
        if (!empty($tugas_array)) {
            foreach ($tugas_array as $key => $tugas) {
                if (!empty($tugas)) {
                    $tugas_only[] = $tugas;
                    $standar_only[] = isset($standar_array[$key]) ? $standar_array[$key] : '';
                }
            }
        }

        $data = array(
            'id_ruangan' => $id_ruangan,
            'id_user' => $id_user,
            'tugas' => json_encode($tugas_only),
            'standar' => json_encode($standar_only),
            'prioritas' => $prioritas,
            'status' => 'pending'
        );

        if ($this->p->insert_pengerjaan($data)) {
            $count = count($tugas_only);
            $this->session->set_flashdata('success', "Berhasil menambahkan pengerjaan dengan {$count} tugas");
        } else {
            $this->session->set_flashdata('error', 'Gagal menambahkan data pengerjaan');
        }

        redirect('pengerjaan');
    }

    public function edit() {
        if ($this->session->userdata('admin_valid') == FALSE && $this->session->userdata('email') == "") {
            redirect("login");
        }

        $id = $this->input->post('id_pengerjaan');
        $tugas_array = $this->input->post('tugas');
        $standar_array = $this->input->post('standar');

        // Separate tugas and standar into different arrays
        $tugas_only = array();
        $standar_only = array();
        
        if (!empty($tugas_array)) {
            foreach ($tugas_array as $key => $tugas) {
                if (!empty($tugas)) {
                    $tugas_only[] = $tugas;
                    $standar_only[] = isset($standar_array[$key]) ? $standar_array[$key] : '';
                }
            }
        }

        $data = array(
            'id_ruangan' => $this->input->post('id_ruangan'),
            'id_user' => $this->input->post('id_user'),
            'tugas' => json_encode($tugas_only),
            'standar' => json_encode($standar_only),
            'prioritas' => $this->input->post('prioritas'),
            'status' => $this->input->post('status')
        );

        if ($this->p->update_pengerjaan($id, $data)) {
            $this->session->set_flashdata('success', 'Data pengerjaan berhasil diupdate');
        } else {
            $this->session->set_flashdata('error', 'Gagal mengupdate data pengerjaan');
        }

        redirect('pengerjaan');
    }

    public function delete($id) {
        if ($this->session->userdata('admin_valid') == FALSE && $this->session->userdata('email') == "") {
            redirect("login");
        }

        if ($this->p->delete_pengerjaan($id)) {
            $this->session->set_flashdata('success', 'Data pengerjaan berhasil dihapus');
        } else {
            $this->session->set_flashdata('error', 'Gagal menghapus data pengerjaan');
        }

        redirect('pengerjaan');
    }

    public function get_by_id($id) {
        if ($this->session->userdata('admin_valid') == FALSE && $this->session->userdata('email') == "") {
            redirect("login");
        }

        $pengerjaan = $this->p->get_pengerjaan_by_id($id);
        
        if ($pengerjaan) {
            echo json_encode(array('status' => 'success', 'data' => $pengerjaan));
        } else {
            echo json_encode(array('status' => 'error', 'message' => 'Data tidak ditemukan'));
        }
    }
}
