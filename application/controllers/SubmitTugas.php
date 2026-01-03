<?php
defined('BASEPATH') or exit('No direct script access allowed');

class SubmitTugas extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Model_pengerjaan', 'p');
        
        log_message('debug', 'SubmitTugas constructor called');
        log_message('debug', 'SubmitTugas constructor - Session check: ' . print_r($this->session->all_userdata(), true));
        
        // Cek login user
        if (!$this->session->userdata('user_logged_in')) {
            log_message('debug', 'SubmitTugas constructor - User not logged in, redirecting to loginuser');
            redirect('loginuser');
        }
        
        // Cek apakah user memiliki role 'user'
        if ($this->session->userdata('role') != '1') {
            log_message('debug', 'SubmitTugas constructor - Invalid role, destroying session and redirecting');
            $this->session->sess_destroy();
            redirect('loginuser');
        }
        
        log_message('debug', 'SubmitTugas constructor completed successfully');
    }

    public function index($barcode = null)
    {
        log_message('debug', 'SubmitTugas::index method called with barcode: ' . $barcode);
        
        // Double check role untuk keamanan
        if ($this->session->userdata('role') != '1') {
            log_message('debug', 'Role check failed in index method');
            $this->session->sess_destroy();
            redirect('loginuser');
        }
        
        // Get current user ID from session
        $user_id = $this->session->userdata('user_id');
        log_message('debug', 'User ID from session: ' . $user_id);
        
        // Get the latest pengerjaan for this user
        $pengerjaan = $this->p->get_latest_pengerjaan_by_user($user_id);
        
        if (!$pengerjaan) {
            log_message('debug', 'No pengerjaan found for user: ' . $user_id);
            $this->session->set_flashdata('error', 'Tidak ada pengerjaan yang ditemukan');
            redirect('dashboard_user');
        }
        
        log_message('debug', 'Pengerjaan found: ' . print_r($pengerjaan, true));
        
        // Validate barcode if provided
        if ($barcode) {
            log_message('debug', 'Validating barcode: ' . $barcode);
            $valid_barcode = $this->validate_room_barcode($barcode, $pengerjaan->id_ruangan);
            if (!$valid_barcode) {
                log_message('debug', 'Invalid barcode provided');
                $this->session->set_flashdata('error', 'Barcode ruangan tidak valid');
                redirect('detailtugas/detail');
            }
            log_message('debug', 'Barcode validation passed');
        }
        
        $data = [
            'title' => 'Submit Tugas',
            'page' => 'submit_tugas/index',
            'user_data' => $this->session->userdata(),
            'pengerjaan' => $pengerjaan
        ];
        
        log_message('debug', 'Loading submit_tugas view');
        $this->load->view('index_user', $data);
    }
    
    private function validate_room_barcode($barcode, $id_ruangan)
    {
        // Generate expected barcode for this room
        $expected_barcode = $this->generate_room_barcode($id_ruangan);
        
        // Compare barcodes
        return $barcode === $expected_barcode;
    }
    
    private function generate_room_barcode($id_ruangan)
    {
        // Generate barcode based on room ID
        return 'RM' . str_pad($id_ruangan, 6, '0', STR_PAD_LEFT);
    }
    
    public function complete()
    {
        log_message('debug', 'SubmitTugas::complete method called directly');
        
        try {
            // Debug: Log all request data
            log_message('debug', 'SubmitTugas::complete called');
            log_message('debug', 'POST data: ' . print_r($_POST, true));
            log_message('debug', 'FILES data: ' . print_r($_FILES, true));
            log_message('debug', 'Session data: ' . print_r($this->session->all_userdata(), true));
            
            // Set response header to JSON
            header('Content-Type: application/json');
            
            // Debug: Check session
            if (!$this->session->userdata('user_logged_in')) {
                log_message('error', 'User not logged in');
                echo json_encode(['status' => 'error', 'message' => 'User not logged in']);
                return;
            }
            
            if ($this->session->userdata('role') != '1') {
                log_message('error', 'Invalid role: ' . $this->session->userdata('role'));
                echo json_encode(['status' => 'error', 'message' => 'Unauthorized']);
                return;
            }
            
            log_message('debug', 'Session validation passed');
            
            $user_id = $this->session->userdata('user_id');
            log_message('debug', 'User ID: ' . $user_id);
            
            // Get the latest pengerjaan for this user
            $pengerjaan = $this->p->get_latest_pengerjaan_by_user($user_id);
            
            if (!$pengerjaan) {
                log_message('error', 'No pengerjaan found for user: ' . $user_id);
                echo json_encode(['status' => 'error', 'message' => 'Pengerjaan tidak ditemukan']);
                return;
            }
            
            log_message('debug', 'Pengerjaan found: ' . $pengerjaan->id_pengerjaan);
            
            $task_count = $this->input->post('task_count');
            $notes = $this->input->post('notes');
            
            log_message('debug', 'Task count: ' . $task_count);
            log_message('debug', 'Notes: ' . $notes);
            
            if (!$task_count || $task_count < 1) {
                log_message('error', 'Invalid task count: ' . $task_count);
                echo json_encode(['status' => 'error', 'message' => 'Invalid task count']);
                return;
            }
            
            // Handle multiple file uploads
            $foto_before_data = [];
            $foto_after_data = [];
            
            for ($i = 0; $i < $task_count; $i++) {
                $before_field = "foto_before_{$i}";
                $after_field = "foto_after_{$i}";
                
                log_message('debug', "Processing task {$i}: {$before_field}, {$after_field}");
                
                $foto_before = $this->handle_upload($before_field, 'pengerjaan_before_' . $pengerjaan->id_pengerjaan . "_task_{$i}");
                $foto_after = $this->handle_upload($after_field, 'pengerjaan_after_' . $pengerjaan->id_pengerjaan . "_task_{$i}");
                
                log_message('debug', "Upload results - Before: " . ($foto_before ? 'Success' : 'Failed') . ", After: " . ($foto_after ? 'Success' : 'Failed'));
                
                if (!$foto_before || !$foto_after) {
                    log_message('error', "Upload failed for task {$i}");
                    echo json_encode(['status' => 'error', 'message' => 'Gagal mengupload foto untuk tugas ' . ($i + 1)]);
                    return;
                }
                
                $foto_before_data[] = $foto_before;
                $foto_after_data[] = $foto_after;
            }
            
            // Update pengerjaan status and add completion data
            $data = [
                'status' => 'selesai',
                'foto_before' => json_encode($foto_before_data),
                'foto_after' => json_encode($foto_after_data),
                'catatan' => $notes,
                'completed_at' => date('Y-m-d H:i:s')
            ];
            
            log_message('debug', 'Update data: ' . print_r($data, true));
            
            if ($this->p->update_pengerjaan($pengerjaan->id_pengerjaan, $data)) {
                log_message('debug', 'Update successful');
                echo json_encode(['status' => 'success', 'message' => 'Tugas berhasil diselesaikan']);
            } else {
                log_message('error', 'Update failed');
                echo json_encode(['status' => 'error', 'message' => 'Gagal menyelesaikan tugas']);
            }
            
        } catch (Exception $e) {
            log_message('error', 'Exception in complete: ' . $e->getMessage());
            log_message('error', 'Exception trace: ' . $e->getTraceAsString());
            
            // Make sure we return JSON even on error
            if (!headers_sent()) {
                header('Content-Type: application/json');
            }
            
            echo json_encode([
                'status' => 'error', 
                'message' => 'Terjadi kesalahan server: ' . $e->getMessage()
            ]);
        } catch (Error $e) {
            log_message('error', 'Fatal error in complete: ' . $e->getMessage());
            log_message('error', 'Fatal error trace: ' . $e->getTraceAsString());
            
            // Make sure we return JSON even on error
            if (!headers_sent()) {
                header('Content-Type: application/json');
            }
            
            echo json_encode([
                'status' => 'error', 
                'message' => 'Terjadi kesalahan fatal: ' . $e->getMessage()
            ]);
        }
    }
    
    private function handle_upload($field_name, $file_prefix)
    {
        log_message('debug', "Handling upload for field: {$field_name}");
        
        if (!isset($_FILES[$field_name])) {
            log_message('error', "Field {$field_name} not found in \$_FILES");
            return false;
        }
        
        $file = $_FILES[$field_name];
        log_message('debug', "File info for {$field_name}: " . print_r($file, true));
        
        if ($file['error'] !== UPLOAD_ERR_OK) {
            $error_messages = [
                UPLOAD_ERR_INI_SIZE => 'File terlalu besar (melebihi upload_max_filesize)',
                UPLOAD_ERR_FORM_SIZE => 'File terlalu besar (melebihi MAX_FILE_SIZE)',
                UPLOAD_ERR_PARTIAL => 'File hanya ter-upload sebagian',
                UPLOAD_ERR_NO_FILE => 'Tidak ada file yang diupload',
                UPLOAD_ERR_NO_TMP_DIR => 'Temporary folder tidak ditemukan',
                UPLOAD_ERR_CANT_WRITE => 'Gagal menulis file ke disk',
                UPLOAD_ERR_EXTENSION => 'File upload dihentikan oleh extension',
            ];
            
            $error_msg = isset($error_messages[$file['error']]) ? 
                        $error_messages[$file['error']] : 
                        "Unknown upload error (code: {$file['error']})";
            
            log_message('error', "Upload error for {$field_name}: {$error_msg}");
            return false;
        }
        
        // Validate file type
        $allowed_types = ['image/jpeg', 'image/jpg', 'image/png'];
        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $mime_type = finfo_file($finfo, $file['tmp_name']);
        finfo_close($finfo);
        
        log_message('debug', "MIME type for {$field_name}: {$mime_type}");
        
        if (!in_array($mime_type, $allowed_types)) {
            log_message('error', "Invalid file type for {$field_name}: {$mime_type}");
            return false;
        }
        
        // Generate unique filename
        $extension = pathinfo($file['name'], PATHINFO_EXTENSION);
        $filename = $file_prefix . '_' . time() . '.' . $extension;
        
        // Create upload directory if not exists
        $upload_path = './uploads/pengerjaan/';
        if (!is_dir($upload_path)) {
            log_message('debug', "Creating upload directory: {$upload_path}");
            if (!mkdir($upload_path, 0755, true)) {
                log_message('error', "Failed to create upload directory: {$upload_path}");
                return false;
            }
        }
        
        // Check if directory is writable
        if (!is_writable($upload_path)) {
            log_message('error', "Upload directory is not writable: {$upload_path}");
            return false;
        }
        
        // Move uploaded file
        $destination = $upload_path . $filename;
        log_message('debug', "Moving file from {$file['tmp_name']} to {$destination}");
        
        if (move_uploaded_file($file['tmp_name'], $destination)) {
            log_message('debug', "File moved successfully: {$destination}");
            return 'uploads/pengerjaan/' . $filename;
        } else {
            log_message('error', "Failed to move uploaded file from {$file['tmp_name']} to {$destination}");
            return false;
        }
    }
}
