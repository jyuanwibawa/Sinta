<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_notifikasi extends CI_Model
{
    protected $table = 'notifikasi';

    // mendapatkan seluruh notifikasi user (unread ditampilkan lebih dulu, lalu terbaru)
    public function get_by_user($user_id)
    {
        return $this->db
            ->where('user_id', $user_id)
            ->order_by("CASE WHEN status='unread' THEN 0 ELSE 1 END", "ASC", false)
            ->order_by('created_at', 'DESC')
            ->get($this->table)
            ->result();
    }

    // hitung notifikasi yang belum dibaca
    public function count_unread_by_user($user_id)
    {
        return $this->db
            ->where('user_id', $user_id)
            ->where('status', 'unread')
            ->count_all_results($this->table);
    }

    // tandai semua notifikasi jadi dibaca
    public function mark_all_as_read($user_id)
    {
        return $this->db
            ->where('user_id', $user_id)
            ->where('status', 'unread')
            ->update($this->table, ['status' => 'read']);
    }

    // insert notifikasi (status & created_at otomatis kalau tidak dikirim)
    public function insert_notifikasi($data)
    {
        if (!isset($data['status']) || empty($data['status'])) {
            $data['status'] = 'unread';
        }

        if (!isset($data['created_at']) || empty($data['created_at'])) {
            $data['created_at'] = date('Y-m-d H:i:s');
        }

        return $this->db->insert($this->table, $data);
    }

    // cek notifikasi berdasarkan tugas (mencegah duplikat notifikasi tugas)
    public function cek_notifikasi_tugas($user_id, $id_pengerjaan)
    {
        return $this->db
            ->where('user_id', $user_id)
            ->where('id_pengerjaan', $id_pengerjaan)
            ->get($this->table)
            ->num_rows();
    }
}
