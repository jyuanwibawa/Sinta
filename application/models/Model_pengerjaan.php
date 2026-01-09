<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_pengerjaan extends CI_Model {

    // Get all pengerjaan with joins
    public function get_all_pengerjaan() {
        $this->db->select('p.*, r.nama_ruangan, r.lantai, r.luas, u.nama as nama_user, u.user_id');
        $this->db->from('pengerjaan p');
        $this->db->join('ruangan r', 'p.id_ruangan = r.id_ruangan', 'left');
        $this->db->join('user u', 'p.id_user = u.user_id', 'left');
        $this->db->order_by('p.created_at', 'DESC');
        return $this->db->get()->result();
    }

    // Get pengerjaan by ID
    public function get_pengerjaan_by_id($id) {
        $this->db->select('p.*, r.nama_ruangan, r.lantai, r.luas, u.nama as nama_user, u.user_id');
        $this->db->from('pengerjaan p');
        $this->db->join('ruangan r', 'p.id_ruangan = r.id_ruangan', 'left');
        $this->db->join('user u', 'p.id_user = u.user_id', 'left');
        $this->db->where('p.id_pengerjaan', $id);
        return $this->db->get()->row();
    }

    // Get dropdown options
    public function get_dropdown_options() {
        $options = array();
        
        // Get ruangan options
        $this->db->select('id_ruangan, nama_ruangan');
        $this->db->from('ruangan');
        $this->db->where('status', 'aktif');
        $this->db->order_by('nama_ruangan');
        $ruangan = $this->db->get()->result();
        
        $options['ruangan'] = array();
        foreach($ruangan as $r) {
            $options['ruangan'][$r->id_ruangan] = $r->nama_ruangan;
        }
        
        // Get user options
        $this->db->select('user_id, nama');
        $this->db->from('user');
        $this->db->where('aktivasi', 1);
        $this->db->order_by('nama');
        $user = $this->db->get()->result();
        
        $options['user'] = array();
        foreach($user as $u) {
            $options['user'][$u->user_id] = $u->nama;
        }
        
        return $options;
    }

    // Insert pengerjaan
    public function insert_pengerjaan($data) {
        return $this->db->insert('pengerjaan', $data);
    }

    // Update pengerjaan (🔥 DITAMBAHKAN AUTO completed_at)
    public function update_pengerjaan($id, $data) {

        // ==========================================================
        // 🔥 FIX: Jika status diubah menjadi "selesai",
        // otomatis set completed_at dengan waktu sekarang
        // ==========================================================
        if (isset($data['status']) && $data['status'] === 'selesai') {
            if (!isset($data['completed_at']) || empty($data['completed_at'])) {
                $data['completed_at'] = date('Y-m-d H:i:s');
            }
        }

        $this->db->where('id_pengerjaan', $id);
        return $this->db->update('pengerjaan', $data);
    }

    // Delete pengerjaan
    public function delete_pengerjaan($id) {
        $this->db->where('id_pengerjaan', $id);
        return $this->db->delete('pengerjaan');
    }

    // Get pengerjaan by user_id
    public function get_latest_pengerjaan_by_user($user_id) {
        $this->db->select('p.*, r.nama_ruangan, r.lantai, r.luas, u.nama as nama_user, u.user_id');
        $this->db->from('pengerjaan p');
        $this->db->join('ruangan r', 'p.id_ruangan = r.id_ruangan', 'left');
        $this->db->join('user u', 'p.id_user = u.user_id', 'left');
        $this->db->where('p.id_user', $user_id);
        $this->db->order_by('p.created_at', 'DESC');
        $this->db->limit(1);
        return $this->db->get()->row();
    }
    
    public function get_pengerjaan_by_user($user_id) {
        $this->db->select('p.*, r.nama_ruangan, r.lantai, r.luas, u.nama as nama_user, u.user_id');
        $this->db->from('pengerjaan p');
        $this->db->join('ruangan r', 'p.id_ruangan = r.id_ruangan', 'left');
        $this->db->join('user u', 'p.id_user = u.user_id', 'left');
        $this->db->where('p.id_user', $user_id);
        $this->db->order_by('p.created_at', 'DESC');
        return $this->db->get()->result();
    }

    // Get pengerjaan statistics by user_id
    public function get_pengerjaan_stats_by_user($user_id) {
        $stats = array();
        
        $this->db->where('id_user', $user_id);
        $stats['total'] = $this->db->count_all_results('pengerjaan');
        
        $this->db->where('id_user', $user_id);
        $this->db->where('status', 'pending');
        $stats['pending'] = $this->db->count_all_results('pengerjaan');
        
        $this->db->where('id_user', $user_id);
        $this->db->where('status', 'proses');
        $stats['proses'] = $this->db->count_all_results('pengerjaan');
        
        $this->db->where('id_user', $user_id);
        $this->db->where('status', 'selesai');
        $stats['selesai'] = $this->db->count_all_results('pengerjaan');
        
        return $stats;
    }

    // Get statistics
    public function get_statistics() {
        $stats = array();
        
        $stats['total'] = $this->db->count_all('pengerjaan');
        
        $this->db->where('status', 'pending');
        $stats['pending'] = $this->db->count_all_results('pengerjaan');
        
        $this->db->where('status', 'proses');
        $stats['proses'] = $this->db->count_all_results('pengerjaan');
        
        $this->db->where('status', 'selesai');
        $stats['selesai'] = $this->db->count_all_results('pengerjaan');
        
        return $stats;
    }
}
