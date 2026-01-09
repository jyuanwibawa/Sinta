<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_notifikasi extends CI_Model
{
    protected $table = 'notifikasi';

    //mendapatkan seluruh notifikasi user 
    public function get_by_user($user_id)
    {
        return $this->db
            ->where('user_id', $user_id)
            ->order_by('created_at', 'DESC')
            ->get($this->table)
            ->result();
    }

    public function count_unread_by_user($user_id)
    {
        return $this->db
            ->where('user_id', $user_id)
            ->where('status', 'belum dibaca')
            ->count_all_results($this->table);
    }

    public function mark_all_as_read($user_id)
    {
        return $this->db
            ->where('user_id', $user_id)
            ->where('status', 'belum dibaca')
            ->update($this->table, ['status' => 'sudah dibaca']);
    }

    public function insert_notifikasi($data)
    {
        return $this->db->insert($this->table, $data);
    }

    public function cek_notifikasi_tugas($user_id, $id_pengerjaan)
    {
        return $this->db
            ->where('user_id', $user_id)
            ->where('id_pengerjaan', $id_pengerjaan)
            ->get($this->table)
            ->num_rows();
    }
}
