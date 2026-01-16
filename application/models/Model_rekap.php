<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_rekap extends CI_Model {

    // Data detail laporan rekap (range tanggal)
     
    public function get_rekap_range($start, $end)
    {
        return $this->db
            ->select('
                p.id_pengerjaan,
                p.created_at,
                p.tugas,
                p.prioritas,
                p.status,
                p.verifikasi_status,
                p.catatan,
                p.verifikasi_catatan,
                p.completed_at,
                r.nama_ruangan
            ')
            ->from('pengerjaan p')
            ->join('ruangan r', 'r.id_ruangan = p.id_ruangan', 'left')
            ->where('DATE(p.created_at) >=', $start)
            ->where('DATE(p.created_at) <=', $end)
            ->order_by('p.created_at', 'ASC')
            ->get()
            ->result();
    }

    // Ringkasan laporan (summary)

    public function get_summary_range($start, $end)
    {
        return $this->db
            ->select("
                COUNT(*) AS total,
                SUM(CASE WHEN p.status = 'selesai' THEN 1 ELSE 0 END) AS selesai,
                SUM(CASE WHEN p.status = 'proses' THEN 1 ELSE 0 END) AS proses,
                SUM(CASE WHEN p.status = 'pending' THEN 1 ELSE 0 END) AS pending
            ", false)
            ->from('pengerjaan p')
            ->where('DATE(p.created_at) >=', $start)
            ->where('DATE(p.created_at) <=', $end)
            ->get()
            ->row();
    }
}
