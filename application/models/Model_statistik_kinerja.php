<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_statistik_kinerja extends CI_Model {

    private $tbl_user   = null;   
    private $user_pk    = 'id';   
    private $user_name  = 'nama'; 
    private $komplain_table = 'komplain';
    private $komplain_date_col = 'created_at';
    private $komplain_user_col = 'id_user';

    public function set_user_table($tbl, $pk='id', $name='nama') {
        $this->tbl_user = $tbl;
        $this->user_pk = $pk;
        $this->user_name = $name;
    }

    public function indikator_komplain($start, $end) {
        // total komplain periode berdasarkan verifikasi_status = 'perlu_perbaikan'
        $q = $this->db->select('COUNT(*) AS total', false)
            ->from('pengerjaan p')
            ->where("DATE(p.created_at) >=", $start)
            ->where("DATE(p.created_at) <=", $end)
            ->where('p.verifikasi_status', 'perlu_perbaikan')
            ->get()->row();

        return $q ? (int)$q->total : 0;
    }

    public function jumlah_ruangan_bersih($start, $end) {
        // definisi "ruangan bersih": ada pengerjaan selesai & disetujui dalam periode
        $q = $this->db->select('COUNT(DISTINCT p.id_ruangan) AS total', false)
            ->from('pengerjaan p')
            ->where("DATE(p.created_at) >=", $start)
            ->where("DATE(p.created_at) <=", $end)
            ->where('p.status', 'selesai')
            ->where('p.verifikasi_status', 'disetujui')
            ->get()->row();

        return $q ? (int)$q->total : 0;
    }

    public function rata2_waktu_selesai_menit($start, $end) {
        // rata-rata menit pengerjaan untuk tugas yang selesai
        $sql = "
            SELECT AVG(TIMESTAMPDIFF(MINUTE, p.created_at, p.completed_at)) AS avg_menit
            FROM pengerjaan p
            WHERE DATE(p.created_at) >= ?
              AND DATE(p.created_at) <= ?
              AND p.completed_at IS NOT NULL
        ";
        $q = $this->db->query($sql, [$start, $end])->row();

        $avg = ($q && $q->avg_menit !== null) ? (float)$q->avg_menit : 0;

        //Ensures tidak negatif
        if ($avg < 0) $avg = 0;

        return $avg;
    }

    public function kinerja_ob($start, $end) {

        $join_user = '';
        $select_user = "p.id_user AS id_user, NULL AS nama_ob";
        $group_user = "p.id_user";

        if ($this->tbl_user) {
            $join_user = "LEFT JOIN {$this->tbl_user} u ON u.{$this->user_pk} = p.id_user";
            $select_user = "p.id_user AS id_user, u.{$this->user_name} AS nama_ob";
            $group_user = "p.id_user, u.{$this->user_name}";
        }

        $sql = "
            SELECT
              {$select_user},
              COUNT(*) AS total_tugas,
              SUM(CASE WHEN p.status='selesai' THEN 1 ELSE 0 END) AS selesai,

              -- komplain per OB periode: hitung dari verifikasi_status = 'perlu_perbaikan'
              SUM(CASE WHEN p.verifikasi_status='perlu_perbaikan' THEN 1 ELSE 0 END) AS komplain,

              -- skor kebersihan/kerapihan dari penilaian_ob (amankan kalau NULL)
              COALESCE(AVG(n.kebersihan), 0) AS kebersihan,
              COALESCE(AVG(n.kerapihan), 0)  AS kerapihan,

              -- rata-rata waktu selesai (menit) (amankan kalau NULL)
              COALESCE(
                AVG(
                  CASE
                    WHEN p.completed_at IS NOT NULL
                    THEN TIMESTAMPDIFF(MINUTE, p.created_at, p.completed_at)
                  END
                ), 0
              ) AS avg_menit

            FROM pengerjaan p
            {$join_user}
            LEFT JOIN penilaian_ob n ON n.id_pengerjaan = p.id_pengerjaan
            WHERE DATE(p.created_at) >= ?
              AND DATE(p.created_at) <= ?
            GROUP BY {$group_user}
            ORDER BY komplain DESC, kebersihan ASC, total_tugas DESC
        ";

        return $this->db->query($sql, [$start, $end])->result();
    }
}
