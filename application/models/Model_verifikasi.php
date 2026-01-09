<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_verifikasi extends CI_Model {

    public function get_laporan_menunggu() {
        $this->db->select('p.*, r.nama_ruangan, u.nama as nama_ob');
        $this->db->from('pengerjaan p');
        $this->db->join('ruangan r', 'p.id_ruangan = r.id_ruangan', 'left');
        $this->db->join('user u', 'p.id_user = u.user_id', 'left');
        $this->db->where('p.status', 'menunggu');
        $this->db->order_by('p.created_at', 'DESC');
        return $this->db->get()->result();
    }

    public function verifikasi_laporan($id_pengerjaan, $data) {
        $this->db->where('id_pengerjaan', $id_pengerjaan);
        return $this->db->update('pengerjaan', $data);
    }
}
