<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ruangan_model extends CI_Model {

    // Nama tabel
    protected $table = 'ruangan';

    // Field yang diizinkan untuk insert/update
    protected $allowed_fields = [
        'nama_ruangan',
        'lantai', 
        'luas',
        'kapasitas',
        'status',
        'deskripsi',
        'created_at',
        'updated_at'
    ];

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    /**
     * Get all ruangan data
     * @param array $filters - filter parameters
     * @param int $limit - limit data
     * @param int $offset - offset data
     * @return array
     */
    public function get_all_ruangan($filters = [], $limit = null, $offset = 0)
    {
        try {
            $this->db->select('*');
            $this->db->from($this->table);

            // Apply filters
            if (!empty($filters)) {
                if (isset($filters['status']) && $filters['status'] != '') {
                    $this->db->where('status', $filters['status']);
                }
                if (isset($filters['lantai']) && $filters['lantai'] != '') {
                    $this->db->where('lantai', $filters['lantai']);
                }
                if (isset($filters['search']) && $filters['search'] != '') {
                    $this->db->like('nama_ruangan', $filters['search']);
                    $this->db->or_like('deskripsi', $filters['search']);
                }
            }

            // Order by
            $this->db->order_by('nama_ruangan', 'ASC');

            // Apply limit and offset
            if ($limit != null) {
                $this->db->limit($limit, $offset);
            }

            $query = $this->db->get();
            $result = $query->result_array();
            
            log_message('info', 'Get all ruangan query executed with filters: ' . json_encode($filters));
            return $result;
        } catch (Exception $e) {
            log_message('error', 'Error in get_all_ruangan: ' . $e->getMessage());
            return [];
        }
    }

    /**
     * Get total count of ruangan
     * @param array $filters - filter parameters
     * @return int
     */
    public function count_ruangan($filters = [])
    {
        try {
            $this->db->from($this->table);

            // Apply filters
            if (!empty($filters)) {
                if (isset($filters['status']) && $filters['status'] != '') {
                    $this->db->where('status', $filters['status']);
                }
                if (isset($filters['lantai']) && $filters['lantai'] != '') {
                    $this->db->where('lantai', $filters['lantai']);
                }
                if (isset($filters['search']) && $filters['search'] != '') {
                    $this->db->like('nama_ruangan', $filters['search']);
                    $this->db->or_like('deskripsi', $filters['search']);
                }
            }

            return $this->db->count_all_results();
        } catch (Exception $e) {
            log_message('error', 'Error in count_ruangan: ' . $e->getMessage());
            return 0;
        }
    }

    /**
     * Get ruangan by ID
     * @param int $id
     * @return array
     */
    public function get_ruangan_by_id($id)
    {
        try {
            $this->db->where('id_ruangan', $id);
            $query = $this->db->get($this->table);
            $result = $query->row_array();
            
            if ($result) {
                log_message('info', 'Ruangan found: ' . json_encode($result));
            } else {
                log_message('error', 'Ruangan not found with ID: ' . $id);
            }
            
            return $result;
        } catch (Exception $e) {
            log_message('error', 'Error in get_ruangan_by_id: ' . $e->getMessage());
            return false;
        }
    }

    /**
     * Insert new ruangan
     * @param array $data
     * @return int - last insert ID
     */
    public function insert_ruangan($data)
    {
        try {
            // Filter data hanya field yang diizinkan
            $filtered_data = array_intersect_key($data, array_flip($this->allowed_fields));
            
            // Add timestamps
            $filtered_data['created_at'] = date('Y-m-d H:i:s');
            
            $this->db->insert($this->table, $filtered_data);
            $insert_id = $this->db->insert_id();
            
            log_message('info', 'Ruangan inserted: ' . json_encode($filtered_data));
            return $insert_id;
        } catch (Exception $e) {
            log_message('error', 'Error in insert_ruangan: ' . $e->getMessage());
            return false;
        }
    }

    /**
     * Update ruangan
     * @param int $id
     * @param array $data
     * @return bool
     */
    public function update_ruangan($id, $data)
    {
        try {
            // Filter data hanya field yang diizinkan
            $filtered_data = array_intersect_key($data, array_flip($this->allowed_fields));
            
            // Add timestamp
            $filtered_data['updated_at'] = date('Y-m-d H:i:s');
            
            $this->db->where('id_ruangan', $id);
            $result = $this->db->update($this->table, $filtered_data);
            
            log_message('info', 'Ruangan updated: ' . json_encode(['id' => $id, 'data' => $filtered_data]));
            return $result;
        } catch (Exception $e) {
            log_message('error', 'Error in update_ruangan: ' . $e->getMessage());
            return false;
        }
    }

    /**
     * Delete ruangan
     * @param int $id
     * @return bool
     */
    public function delete_ruangan($id)
    {
        try {
            $this->db->where('id_ruangan', $id);
            $result = $this->db->delete($this->table);
            
            if ($result) {
                log_message('info', 'Ruangan deleted: ' . $id);
            } else {
                log_message('error', 'Failed to delete ruangan: ' . $id);
            }
            
            return $result;
        } catch (Exception $e) {
            log_message('error', 'Error in delete_ruangan: ' . $e->getMessage());
            return false;
        }
    }

    /**
     * Check if nama ruangan exists
     * @param string $nama
     * @param int $exclude_id - exclude ID for update
     * @return bool
     */
    public function is_nama_ruangan_exists($nama, $exclude_id = null)
    {
        $this->db->where('nama_ruangan', $nama);
        
        if ($exclude_id != null) {
            $this->db->where('id_ruangan !=', $exclude_id);
        }
        
        $query = $this->db->get($this->table);
        return $query->num_rows() > 0;
    }

    /**
     * Get ruangan by lantai
     * @param int $lantai
     * @return array
     */
    public function get_ruangan_by_lantai($lantai)
    {
        $this->db->where('lantai', $lantai);
        $this->db->order_by('nama_ruangan', 'ASC');
        $query = $this->db->get($this->table);
        return $query->result_array();
    }

    /**
     * Get ruangan aktif
     * @return array
     */
    public function get_ruangan_aktif()
    {
        $this->db->where('status', 'aktif');
        $this->db->order_by('nama_ruangan', 'ASC');
        $query = $this->db->get($this->table);
        return $query->result_array();
    }

    /**
     * Get list lantai
     * @return array
     */
    public function get_list_lantai()
    {
        $this->db->select('lantai');
        $this->db->distinct();
        $this->db->order_by('lantai', 'ASC');
        $query = $this->db->get($this->table);
        return $query->result_array();
    }

    /**
     * Get statistics
     * @return array
     */
    public function get_statistics()
    {
        try {
            $stats = [];
            
            // Total ruangan
            $this->db->from($this->table);
            $stats['total'] = $this->db->count_all_results();
            
            // Ruangan aktif
            $this->db->where('status', 'aktif');
            $this->db->from($this->table);
            $stats['aktif'] = $this->db->count_all_results();
            
            // Ruangan maintenance
            $this->db->where('status', 'maintenance');
            $this->db->from($this->table);
            $stats['maintenance'] = $this->db->count_all_results();
            
            // Total luas
            $this->db->select_sum('luas');
            $this->db->from($this->table);
            $query = $this->db->get();
            $result = $query->row_array();
            $stats['total_luas'] = $result['luas'] ? $result['luas'] : 0;
            
            // Total kapasitas
            $this->db->select_sum('kapasitas');
            $this->db->from($this->table);
            $query = $this->db->get();
            $result = $query->row_array();
            $stats['total_kapasitas'] = $result['kapasitas'] ? $result['kapasitas'] : 0;
            
            return $stats;
        } catch (Exception $e) {
            log_message('error', 'Error in get_statistics: ' . $e->getMessage());
            return [];
        }
    }

    /**
     * Validate ruangan data
     * @param array $data
     * @param int $exclude_id - for update validation
     * @return array - validation result
     */
    public function validate_ruangan($data, $exclude_id = null)
    {
        $errors = [];
        
        log_message('debug', 'Validating data: ' . json_encode($data));
        
        // Validate required fields
        if (empty($data['nama_ruangan']) || trim($data['nama_ruangan']) === '') {
            $errors['nama_ruangan'] = 'Nama ruangan wajib diisi';
        }
        
        if (empty($data['lantai']) || trim($data['lantai']) === '') {
            $errors['lantai'] = 'Lantai wajib diisi';
        }
        
        if (empty($data['luas']) || trim($data['luas']) === '') {
            $errors['luas'] = 'Luas wajib diisi';
        } elseif (!is_numeric($data['luas']) || $data['luas'] <= 0) {
            $errors['luas'] = 'Luas harus berupa angka dan lebih dari 0';
        }
        
        if (empty($data['kapasitas']) || trim($data['kapasitas']) === '') {
            $errors['kapasitas'] = 'Kapasitas wajib diisi';
        } elseif (!is_numeric($data['kapasitas']) || $data['kapasitas'] <= 0) {
            $errors['kapasitas'] = 'Kapasitas harus berupa angka dan lebih dari 0';
        }
        
        // Validate unique nama ruangan
        if (!empty($data['nama_ruangan']) && $this->is_nama_ruangan_exists($data['nama_ruangan'], $exclude_id)) {
            $errors['nama_ruangan'] = 'Nama ruangan sudah ada';
        }
        
        // Validate status (optional field)
        if (isset($data['status']) && $data['status'] !== '') {
            if (!in_array($data['status'], ['aktif', 'maintenance'])) {
                $errors['status'] = 'Status tidak valid. Pilih: aktif atau maintenance';
            }
        } else {
            // Set default status if empty
            $data['status'] = 'aktif';
        }
        
        // Validate lantai format (should be numeric)
        if (!empty($data['lantai']) && !is_numeric($data['lantai'])) {
            $errors['lantai'] = 'Lantai harus berupa angka';
        }
        
        log_message('debug', 'Validation errors: ' . json_encode($errors));
        
        return $errors;
    }
}
