<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_pengerjaan_tu extends CI_Model {

    // realtime 
    public function get_all_laporan_ob() {
        $this->db->select('p.*, r.nama_ruangan, r.lantai, u.nama as nama_ob');
        $this->db->from('pengerjaan p');
        $this->db->join('ruangan r', 'p.id_ruangan = r.id_ruangan', 'left');
        $this->db->join('user u', 'p.id_user = u.user_id', 'left');
        $this->db->where('u.role', 1); 
        $this->db->order_by('p.updated_at', 'DESC');
        return $this->db->get()->result();
    }


    public function get_laporan_verifikasi_tu() {
        $this->db->select('p.*, r.nama_ruangan, u.nama as nama_ob');
        $this->db->from('pengerjaan p');
        $this->db->join('ruangan r', 'p.id_ruangan = r.id_ruangan', 'left');
        $this->db->join('user u', 'p.id_user = u.user_id', 'left');
        $this->db->where('u.role', 1);
        $this->db->where('p.status', 'selesai');

        $this->db->order_by('p.completed_at', 'DESC');
        return $this->db->get()->result();
    }

    public function get_laporan_menunggu_verifikasi() {
        $this->db->select('p.*, r.nama_ruangan, u.nama as nama_ob');
        $this->db->from('pengerjaan p');
        $this->db->join('ruangan r', 'p.id_ruangan = r.id_ruangan', 'left');
        $this->db->join('user u', 'p.id_user = u.user_id', 'left');
        $this->db->where('u.role', 1);              
        $this->db->where('p.status', 'selesai');    

        $this->db->group_start();
            $this->db->where('p.verifikasi_status IS NULL', null, false);
            $this->db->or_where('p.verifikasi_status', 'menunggu');
            $this->db->or_where('p.verifikasi_status', '');
        $this->db->group_end();

        $this->db->order_by('p.completed_at', 'DESC');
        return $this->db->get()->result();
    }

    
    // Hitung total laporan menunggu verifikasi (card)
    public function count_menunggu_verifikasi() {
        $this->db->from('pengerjaan p');
        $this->db->join('user u', 'p.id_user = u.user_id', 'left');
        $this->db->where('u.role', 1);
        $this->db->where('p.status', 'selesai');

        $this->db->group_start();
            $this->db->where('p.verifikasi_status IS NULL', null, false);
            $this->db->or_where('p.verifikasi_status', 'menunggu');
            $this->db->or_where('p.verifikasi_status', '');
        $this->db->group_end();

        return $this->db->count_all_results();
    }

    // Hitung total disetujui (TIDAK DIUBAH)
    public function count_terverifikasi() {
        $this->db->from('pengerjaan p');
        $this->db->join('user u', 'p.id_user = u.user_id', 'left');
        $this->db->where('u.role', 1);
        $this->db->where('p.verifikasi_status', 'disetujui');
        return $this->db->count_all_results();
    }

    public function count_ditolak() {
        $this->db->from('pengerjaan p');
        $this->db->join('user u', 'p.id_user = u.user_id', 'left');
        $this->db->where('u.role', 1);
        $this->db->where('p.verifikasi_status', 'perlu_perbaikan');
        return $this->db->count_all_results();
    }

    public function count_laporan_hari_ini() {
        $this->db->from('pengerjaan p');
        $this->db->join('user u', 'p.id_user = u.user_id', 'left');
        $this->db->where('u.role', 1);
        $this->db->where('DATE(p.created_at)', date('Y-m-d'));
        return $this->db->count_all_results();
    }

    public function count_komplain_bulan_ini() {
        $this->db->from('pengerjaan p');
        $this->db->join('user u', 'p.id_user = u.user_id', 'left');
        $this->db->where('u.role', 1);
        $this->db->where('p.verifikasi_status', 'perlu_perbaikan');
        $this->db->where('MONTH(p.verifikasi_at)', date('m'));
        $this->db->where('YEAR(p.verifikasi_at)', date('Y'));
        return $this->db->count_all_results();
    }

    public function get_pengerjaan_for_verifikasi($id) {
        $this->db->select('p.*, r.nama_ruangan, r.lantai, u.nama as nama_ob');
        $this->db->from('pengerjaan p');
        $this->db->join('ruangan r', 'p.id_ruangan = r.id_ruangan', 'left');
        $this->db->join('user u', 'p.id_user = u.user_id', 'left');
        $this->db->where('p.id_pengerjaan', $id);
        return $this->db->get()->row();
    }

    
    public function verifikasi_pengerjaan($id_pengerjaan, $data) {
        $this->db->where('id_pengerjaan', $id_pengerjaan);
        return $this->db->update('pengerjaan', $data);
    }
}
