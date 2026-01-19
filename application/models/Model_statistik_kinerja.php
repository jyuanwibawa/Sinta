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
        // Hitung JUMLAH kejadian komplain (bukan DISTINCT ruangan)
        // PERIODE PAKAI verifikasi_at agar benar-benar sesuai kejadian verifikasi/komplain
        $q = $this->db->select('COUNT(*) AS total', false)
            ->from('pengerjaan p')
            ->where('p.verifikasi_at IS NOT NULL', null, false)
            ->where("DATE(p.verifikasi_at) >=", $start)
            ->where("DATE(p.verifikasi_at) <=", $end)
            ->where('p.verifikasi_status', 'perlu_perbaikan')
            ->get()->row();

        $total = $q ? (int)$q->total : 0;
        if ($total > 10) $total = 10; // maksimal 10
        return $total;
    }

    public function jumlah_ruangan_bersih($start, $end) {
        $q = $this->db->select('COUNT(DISTINCT p.id_ruangan) AS total', false)
            ->from('pengerjaan p')
            ->where('p.verifikasi_at IS NOT NULL', null, false)
            ->where("DATE(p.verifikasi_at) >=", $start)
            ->where("DATE(p.verifikasi_at) <=", $end)
            ->where('p.status', 'selesai')
            ->where('p.verifikasi_status', 'disetujui')
            ->get()->row();

        return $q ? (int)$q->total : 0;
    }

    public function rata2_waktu_selesai_menit($start, $end) {
        $sql = "
            SELECT AVG(TIMESTAMPDIFF(MINUTE, p.created_at, p.completed_at)) AS avg_menit
            FROM pengerjaan p
            WHERE p.verifikasi_at IS NOT NULL
              AND DATE(p.verifikasi_at) >= ?
              AND DATE(p.verifikasi_at) <= ?
              AND p.completed_at IS NOT NULL
              AND (p.verifikasi_status IS NOT NULL AND p.verifikasi_status <> '' AND p.verifikasi_status <> 'menunggu')
        ";
        $q = $this->db->query($sql, [$start, $end])->row();

        $avg = ($q && $q->avg_menit !== null) ? (float)$q->avg_menit : 0;
        if ($avg < 0) $avg = 0;
        return $avg;
    }

    public function kinerja_ob($start, $end) {

        $join_user = '';
        // Default nama kalau join user tidak di-set: "OB {id_user}" (biar tidak ngawur/kosong)
        $select_user = "p.id_user AS id_user, CONCAT('OB ', p.id_user) AS nama_ob";
        $group_user = "p.id_user";

        if ($this->tbl_user) {
            $join_user = "LEFT JOIN {$this->tbl_user} u ON u.{$this->user_pk} = p.id_user";
            // Pakai COALESCE supaya kalau nama NULL tetap ada fallback
            $select_user = "p.id_user AS id_user, COALESCE(u.{$this->user_name}, CONCAT('OB ', p.id_user)) AS nama_ob";
            $group_user = "p.id_user, u.{$this->user_name}";
        }

        $sql = "
            SELECT
              {$select_user},
              COUNT(*) AS total_tugas,
              SUM(CASE WHEN p.status='selesai' THEN 1 ELSE 0 END) AS selesai,

              -- Komplain per OB = jumlah kejadian perlu_perbaikan (bukan DISTINCT)
              SUM(CASE WHEN p.verifikasi_status='perlu_perbaikan' THEN 1 ELSE 0 END) AS komplain_raw,
              LEAST(10, SUM(CASE WHEN p.verifikasi_status='perlu_perbaikan' THEN 1 ELSE 0 END)) AS komplain,

              GREATEST(0, 10 - LEAST(10, SUM(CASE WHEN p.verifikasi_status='perlu_perbaikan' THEN 1 ELSE 0 END))) AS poin_akhir,

              CASE
                WHEN GREATEST(0, 10 - LEAST(10, SUM(CASE WHEN p.verifikasi_status='perlu_perbaikan' THEN 1 ELSE 0 END))) >= 7
                  THEN 'Baik'
                ELSE 'Perlu Perhatian'
              END AS status_poin,

              COALESCE(AVG(n.kebersihan), 0) AS kebersihan,
              COALESCE(AVG(n.kerapihan), 0)  AS kerapihan,

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

            WHERE p.verifikasi_at IS NOT NULL
              AND DATE(p.verifikasi_at) >= ?
              AND DATE(p.verifikasi_at) <= ?
              AND (p.verifikasi_status IS NOT NULL AND p.verifikasi_status <> '' AND p.verifikasi_status <> 'menunggu')

            GROUP BY {$group_user}
            ORDER BY komplain DESC, kebersihan ASC, total_tugas DESC
        ";

        return $this->db->query($sql, [$start, $end])->result();
    }
}
