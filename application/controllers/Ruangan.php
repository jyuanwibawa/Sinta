<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ruangan extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        // Load library yang diperlukan
        $this->load->library('session');
        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->helper('security'); // Tambahkan helper untuk decrypt_url
        $this->load->model('Ruangan_model', 'ruangan');
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
        
        // Debug: Log session data
        log_message('debug', 'Session active_satker: ' . $this->session->userdata('active_satker'));
        
        try {
            $active_satker = decrypt_url($this->session->userdata('active_satker'));
            log_message('debug', 'Decrypted active_satker: ' . $active_satker);
        } catch (Exception $e) {
            // Jika decrypt gagal, gunakan default value
            $active_satker = 1;
            log_message('error', 'Decrypt failed: ' . $e->getMessage());
        }
        
        // Get filters from request
        $filters = [];
        if ($this->input->get('status')) {
            $filters['status'] = $this->input->get('status');
        }
        if ($this->input->get('lantai')) {
            $filters['lantai'] = $this->input->get('lantai');
        }
        if ($this->input->get('search')) {
            $filters['search'] = $this->input->get('search');
        }
        
        // Pagination
        $page = $this->input->get('page') ? (int)$this->input->get('page') : 1;
        $per_page = 10;
        $offset = ($page - 1) * $per_page;
        
        // Debug: Log filters
        log_message('debug', 'Filters: ' . json_encode($filters));
        
        // Get data
        $data['ruangan_list'] = $this->ruangan->get_all_ruangan($filters, $per_page, $offset);
        $data['total_ruangan'] = $this->ruangan->count_ruangan($filters);
        $data['total_pages'] = $data['total_ruangan'] > 0 ? ceil($data['total_ruangan'] / $per_page) : 1;
        $data['current_page'] = $page;
        $data['lantai_list'] = $this->ruangan->get_list_lantai();
        $data['statistics'] = $this->ruangan->get_statistics();
        $data['filters'] = $filters;
        
        // Get satker data
        try {
            if ($this->d) {
                $data['get_satker'] = $this->d->get_satker($active_satker);
            } else {
                $data['get_satker'] = [];
                log_message('error', 'Model_dashboard (d) is not loaded');
            }
        } catch (Exception $e) {
            $data['get_satker'] = [];
            log_message('error', 'Error loading satker data: ' . $e->getMessage());
        }
        
        // Page data
        $data['title'] = "Kelola Ruangan";
        $data['page'] = "ruangan/index";

        $this->load->view('index', $data);
    }
    
    /**
     * Add new ruangan
     */
    public function add()
    {
        // Force JSON response regardless of request type
        $this->output->set_content_type('application/json');
        
        if ($this->session->userdata('admin_valid') == FALSE && $this->session->userdata('email') == "") {
            $this->output->set_status_header(401);
            $this->output->set_output(json_encode(['success' => false, 'error' => 'Unauthorized']));
            return;
        }
        
        if ($this->input->post()) {
            $data = [
                'nama_ruangan' => $this->input->post('namaRuangan'),
                'lantai' => $this->input->post('lantai'),
                'luas' => $this->input->post('luas'),
                'kapasitas' => $this->input->post('kapasitas'),
                'status' => $this->input->post('status') ? $this->input->post('status') : 'aktif',
                'deskripsi' => $this->input->post('deskripsi')
            ];
            
            log_message('debug', 'Processed data: ' . json_encode($data));
            
            // Validate data
            $errors = $this->ruangan->validate_ruangan($data);
            
            if (empty($errors)) {
                // Insert data
                $insert_id = $this->ruangan->insert_ruangan($data);
                
                if ($insert_id) {
                    $this->output->set_status_header(200);
                    $this->output->set_output(json_encode(['success' => true, 'message' => 'Ruangan berhasil ditambahkan']));
                } else {
                    $this->output->set_status_header(500);
                    $this->output->set_output(json_encode(['success' => false, 'error' => 'Gagal menambahkan ruangan']));
                }
            } else {
                $this->output->set_status_header(400);
                $this->output->set_output(json_encode(['success' => false, 'error' => 'Validation failed', 'errors' => $errors]));
            }
        } else {
            // If no POST data, return error
            $this->output->set_status_header(400);
            $this->output->set_output(json_encode(['success' => false, 'error' => 'No data received']));
        }
    }
    
    /**
     * Edit ruangan
     */
    public function edit($id = null)
    {
        // Debug: Log request info
        log_message('debug', 'Edit method called with ID: ' . $id);
        log_message('debug', 'POST data: ' . json_encode($this->input->post()));
        log_message('debug', 'Is AJAX: ' . ($this->input->is_ajax_request() ? 'true' : 'false'));
        
        // Force JSON response regardless of request type
        $this->output->set_content_type('application/json');
        
        if ($this->session->userdata('admin_valid') == FALSE && $this->session->userdata('email') == "") {
            log_message('error', 'Unauthorized access attempt');
            $this->output->set_status_header(401);
            $this->output->set_output(json_encode(['success' => false, 'error' => 'Unauthorized']));
            return;
        }
        
        if ($id == null) {
            log_message('error', 'ID is null');
            $this->output->set_status_header(400);
            $this->output->set_output(json_encode(['success' => false, 'error' => 'ID tidak valid']));
            return;
        }
        
        if ($this->input->post()) {
            $data = [
                'nama_ruangan' => $this->input->post('namaRuangan'),
                'lantai' => $this->input->post('lantai'),
                'luas' => $this->input->post('luas'),
                'kapasitas' => $this->input->post('kapasitas'),
                'status' => $this->input->post('status') ? $this->input->post('status') : 'aktif',
                'deskripsi' => $this->input->post('deskripsi')
            ];
            
            log_message('debug', 'Processed data: ' . json_encode($data));
            
            // Validate data
            $errors = $this->ruangan->validate_ruangan($data, $id);
            
            if (empty($errors)) {
                // Update data
                $result = $this->ruangan->update_ruangan($id, $data);
                
                if ($result) {
                    log_message('info', 'Ruangan updated successfully: ' . $id);
                    $this->output->set_status_header(200);
                    $this->output->set_output(json_encode(['success' => true, 'message' => 'Ruangan berhasil diperbarui']));
                } else {
                    log_message('error', 'Failed to update ruangan: ' . $id);
                    $this->output->set_status_header(500);
                    $this->output->set_output(json_encode(['success' => false, 'error' => 'Gagal memperbarui ruangan']));
                }
            } else {
                log_message('error', 'Validation errors: ' . json_encode($errors));
                $this->output->set_status_header(400);
                $this->output->set_output(json_encode(['success' => false, 'error' => 'Validation failed', 'errors' => $errors]));
            }
        } else {
            // If no POST data, return error
            log_message('error', 'No POST data received');
            $this->output->set_status_header(400);
            $this->output->set_output(json_encode(['success' => false, 'error' => 'No data received']));
        }
    }
    
    /**
     * Delete ruangan
     */
    public function delete($id = null)
    {
        if ($this->session->userdata('admin_valid') == FALSE && $this->session->userdata('email') == "") {
            if ($this->input->is_ajax_request()) {
                $this->output
                    ->set_content_type('application/json')
                    ->set_status_header(401)
                    ->set_output(json_encode(['success' => false, 'error' => 'Unauthorized']));
                return;
            } else {
                redirect("login");
            }
        }
        
        if ($id == null) {
            if ($this->input->is_ajax_request()) {
                $this->output
                    ->set_content_type('application/json')
                    ->set_status_header(400)
                    ->set_output(json_encode(['success' => false, 'error' => 'ID tidak valid']));
                return;
            } else {
                redirect('ruangan');
            }
        }
        
        // Check if ruangan exists
        $ruangan = $this->ruangan->get_ruangan_by_id($id);
        if (!$ruangan) {
            if ($this->input->is_ajax_request()) {
                $this->output
                    ->set_content_type('application/json')
                    ->set_status_header(404)
                    ->set_output(json_encode(['success' => false, 'error' => 'Ruangan tidak ditemukan']));
                return;
            } else {
                $this->session->set_flashdata('error', 'Ruangan tidak ditemukan');
                redirect('ruangan');
            }
        }
        
        // Delete ruangan
        $result = $this->ruangan->delete_ruangan($id);
        
        if ($result) {
            if ($this->input->is_ajax_request()) {
                $this->output
                    ->set_content_type('application/json')
                    ->set_status_header(200)
                    ->set_output(json_encode(['success' => true, 'message' => 'Ruangan berhasil dihapus']));
            } else {
                $this->session->set_flashdata('success', 'Ruangan berhasil dihapus');
                redirect('ruangan');
            }
        } else {
            if ($this->input->is_ajax_request()) {
                $this->output
                    ->set_content_type('application/json')
                    ->set_status_header(500)
                    ->set_output(json_encode(['success' => false, 'error' => 'Gagal menghapus ruangan']));
            } else {
                $this->session->set_flashdata('error', 'Gagal menghapus ruangan');
                redirect('ruangan');
            }
        }
    }
    
    /**
     * Get ruangan by ID (for AJAX)
     */
    public function get_ruangan($id)
    {
        // Set JSON response header
        $this->output->set_content_type('application/json');
        
        if ($this->session->userdata('admin_valid') == FALSE && $this->session->userdata('email') == "") {
            $this->output->set_status_header(401);
            $this->output->set_output(json_encode(['success' => false, 'error' => 'Unauthorized']));
            return;
        }
        
        try {
            $ruangan = $this->ruangan->get_ruangan_by_id($id);
            
            if ($ruangan) {
                $this->output->set_status_header(200);
                $this->output->set_output(json_encode(['success' => true, 'data' => $ruangan]));
            } else {
                $this->output->set_status_header(404);
                $this->output->set_output(json_encode(['success' => false, 'error' => 'Ruangan tidak ditemukan']));
            }
        } catch (Exception $e) {
            log_message('error', 'Error in get_ruangan: ' . $e->getMessage());
            $this->output->set_status_header(500);
            $this->output->set_output(json_encode(['success' => false, 'error' => 'Internal server error']));
        }
    }
    
    /**
     * Get statistics (for AJAX)
     */
    public function get_statistics()
    {
        if ($this->session->userdata('admin_valid') == FALSE && $this->session->userdata('email') == "") {
            $this->output
                ->set_content_type('application/json')
                ->set_status_header(401)
                ->set_output(json_encode(['success' => false, 'error' => 'Unauthorized']));
            return;
        }
        
        $statistics = $this->ruangan->get_statistics();
        $this->output
            ->set_content_type('application/json')
            ->set_status_header(200)
            ->set_output(json_encode(['success' => true, 'data' => $statistics]));
    }
}
