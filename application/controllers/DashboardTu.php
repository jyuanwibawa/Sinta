<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DashboardTu extends CI_Controller {

    public function __construct()
    {
        parent::__construct();

        $this->load->model('Model_pengerjaan_tu');
        $this->load->model('Model_notifikasi');
        $this->load->model('Model_statistik_kinerja', 'stat');

        //  model log (sesuai LoginUser) =====
        $this->load->model('Model_activity_log');

        // ===== TAMBAHAN: guard akses TU (sesuai session LoginUser) =====
        // Wajib login user
        if (!$this->session->userdata('user_logged_in')) {
            // log akses tanpa login
            $this->Model_activity_log->add(
                'ACCESS_DENIED',
                'dashboard_tu',
                'Akses DashboardTu ditolak (belum login). URL: ' . current_url()
            );
            redirect('loginuser');
        }

        // Wajib TU
        if ((int)$this->session->userdata('is_tu') !== 1) {
            // log akses ditolak karena bukan TU
            $this->Model_activity_log->add(
                'ACCESS_DENIED',
                'dashboard_tu',
                'Akses DashboardTu ditolak (bukan TU). User: ' .
                $this->session->userdata('nama') . ' | Email: ' . $this->session->userdata('email') .
                ' | jabatan_id: ' . $this->session->userdata('jabatan_id')
            );
            redirect('dashboard_user'); // user biasa balik ke dashboard user
        }

        // ===== TAMBAHAN: log open page dashboard TU =====
        $this->Model_activity_log->add(
            'OPEN_PAGE',
            'dashboard_tu',
            'Access Dashboard TU. User: ' . $this->session->userdata('nama') . ' | Email: ' . $this->session->userdata('email')
        );
    }

    public function index()
    {
        // log open page index
        $this->Model_activity_log->add(
            'OPEN_PAGE',
            'dashboard_tu',
            'Open index DashboardTu'
        );

        $data['laporan'] = $this->Model_pengerjaan_tu->get_laporan_verifikasi_tu();

        /**
         * ==========================
         * REVISI DASHBOARD AGAR RIIL
         * ==========================
         */

        // statistik (periode)
        $stat_start = $this->input->get('stat_start', true);
        $stat_end   = $this->input->get('stat_end', true);

        if (!$stat_start) $stat_start = date('Y-m-01');
        if (!$stat_end)   $stat_end   = date('Y-m-t');

        // validasi sederhana: kalau kebalik, tukar
        if ($stat_start > $stat_end) {
            $tmp = $stat_start; $stat_start = $stat_end; $stat_end = $tmp;
        }

        $data['stat_start'] = $stat_start;
        $data['stat_end']   = $stat_end;

        // === Ringkasan riil dashboard dari DB ===
        $sqlRingkas = "
            SELECT
              COUNT(*) AS total,
              SUM(CASE WHEN p.status='selesai' THEN 1 ELSE 0 END) AS selesai,
              SUM(CASE WHEN p.status='pending' THEN 1 ELSE 0 END) AS pending,
              SUM(CASE WHEN p.verifikasi_status='perlu_perbaikan' THEN 1 ELSE 0 END) AS ditolak
            FROM pengerjaan p
            WHERE DATE(p.created_at) >= ?
              AND DATE(p.created_at) <= ?
        ";
        $ringkas = $this->db->query($sqlRingkas, [$stat_start, $stat_end])->row();

        $data['total_hari_ini']      = (int)($ringkas->total ?? 0);
        $data['total_terverifikasi'] = (int)($ringkas->selesai ?? 0);
        $data['total_menunggu']      = (int)($ringkas->pending ?? 0);
        $data['total_ditolak']       = (int)($ringkas->ditolak ?? 0);

        // Komplain Bulan Ini (riil dari DB)
        $sqlKomplain = "
            SELECT COUNT(*) AS total
            FROM pengerjaan p
            WHERE p.verifikasi_status='perlu_perbaikan'
              AND p.verifikasi_at IS NOT NULL
              AND MONTH(p.verifikasi_at)=MONTH(CURDATE())
              AND YEAR(p.verifikasi_at)=YEAR(CURDATE())
        ";
        $qKomp = $this->db->query($sqlKomplain)->row();
        $data['total_komplain'] = (int)($qKomp->total ?? 0);

        $data['max_komplain'] = 10;

        $data['total_komplain_stat'] = (int) $this->stat->indikator_komplain($stat_start, $stat_end);
        $data['ruangan_bersih']      = (int) $this->stat->jumlah_ruangan_bersih($stat_start, $stat_end);

        $avgMenit = (float) $this->stat->rata2_waktu_selesai_menit($stat_start, $stat_end);
        if ($avgMenit < 0) $avgMenit = 0;
        $data['avg_menit'] = $avgMenit;

        $data['list_ob'] = $this->stat->kinerja_ob($stat_start, $stat_end);

        if (!empty($data['list_ob'])) {
            foreach ($data['list_ob'] as $row) {

                $nama = '';
                if (!empty($row->display_nama)) $nama = $row->display_nama;
                else if (!empty($row->nama_ob)) $nama = $row->nama_ob;
                else if (!empty($row->nama)) $nama = $row->nama;
                else if (!empty($row->full_name)) $nama = $row->full_name;
                else if (!empty($row->username)) $nama = $row->username;

                if ($nama === '') {
                    $nama = 'OB ' . (int)(isset($row->id_user) ? $row->id_user : 0);
                }

                $row->display_nama = $nama;
            }
        }

        $this->load->view('layout_tu/vhead');
        $this->load->view('dashboard_tu/index', $data);
        $this->load->view('layout_tu/vscript');
    }

    public function logout()
    {
        $this->Model_activity_log->add(
            'LOGOUT',
            'dashboard_tu',
            'User logout. User: ' . $this->session->userdata('nama') .
            ' | Email: ' . $this->session->userdata('email')
        );

        $this->session->sess_destroy();
        redirect('loginuser');
    }

    public function tambah_evaluasi()
    {
        if (!$this->input->is_ajax_request()) {
            show_404();
            return;
        }

        $id_pengerjaan = (int)$this->input->post('id_pengerjaan');
        $catatan_tu    = $this->input->post('catatan_tu');

        if (!$id_pengerjaan) {
            echo json_encode([
                'status'  => 'error',
                'message' => 'Data tidak lengkap'
            ]);
            exit;
        }

        $this->Model_activity_log->add(
            'EVAL_ACTION',
            'dashboard_tu',
            'Tambah evaluasi. id_pengerjaan: ' . $id_pengerjaan
        );

        $pengerjaan = $this->Model_pengerjaan_tu->get_pengerjaan_for_verifikasi($id_pengerjaan);

        if (!$pengerjaan) {
            echo json_encode([
                'status'  => 'error',
                'message' => 'Data pengerjaan tidak ditemukan'
            ]);
            exit;
        }

        $MAX_EVAL = 10;
        $POTONG_PER_EVAL = 10;

        // ===== FIX PENTING: nilai 100 jangan bikin balik 100 terus kalau eval_count sudah > 0 =====
        $eval_count  = (int)($pengerjaan->verifikasi_eval_count ?? 0);

        $dbPoint = $pengerjaan->verifikasi_point_akhir;

        // FIX: jika point null/kosong ATAU point masih 100 padahal eval_count sudah ada -> hitung ulang
        if ($dbPoint === null || $dbPoint === '' || ((int)$dbPoint === 100 && $eval_count > 0)) {
            $point_akhir = max(0, 100 - ($eval_count * $POTONG_PER_EVAL));
        } else {
            $point_akhir = (int)$dbPoint;
        }

        if ($eval_count >= $MAX_EVAL) {
            echo json_encode([
                'status'  => 'error',
                'message' => 'Evaluasi sudah mencapai batas maksimal (10 kali).'
            ]);
            exit;
        }

        $eval_count = $eval_count + 1;
        $point_akhir = $point_akhir - $POTONG_PER_EVAL;
        if ($point_akhir < 0) $point_akhir = 0;

        $data = [
            'verifikasi_eval_count'  => $eval_count,
            'verifikasi_point_akhir' => $point_akhir
        ];

        if ($catatan_tu) {
            $lama = (string)($pengerjaan->verifikasi_catatan ?? '');
            $data['verifikasi_catatan'] = $lama ? ($lama . ' | ' . $catatan_tu) : $catatan_tu;
        }

        $this->Model_pengerjaan_tu->verifikasi_pengerjaan($id_pengerjaan, $data);

        echo json_encode([
            'status' => 'success',
            'eval_count' => $eval_count,
            'max_eval' => $MAX_EVAL,
            'potong_per_eval' => $POTONG_PER_EVAL,
            'point_akhir' => $point_akhir
        ]);
        exit;
    }

    public function get_laporan_ajax()
    {
        $this->Model_activity_log->add(
            'OPEN_PAGE',
            'dashboard_tu',
            'AJAX get_laporan_ajax'
        );

        $data['laporan'] = $this->Model_pengerjaan_tu->get_all_laporan_ob();
        $this->load->view('dashboard_tu/partials/laporan_ob_list', $data);
    }

    public function get_verifikasi_ajax()
    {
        $this->Model_activity_log->add(
            'OPEN_PAGE',
            'dashboard_tu',
            'AJAX get_verifikasi_ajax'
        );

        $data['laporan'] = $this->Model_pengerjaan_tu->get_laporan_verifikasi_tu();
        $this->load->view('dashboard_tu/partials/verifikasi_list', $data);
    }

    public function verifikasi_list()
    {
        $this->Model_activity_log->add(
            'OPEN_PAGE',
            'dashboard_tu',
            'Open verifikasi_list'
        );

        $data['laporan'] = $this->Model_pengerjaan_tu->get_laporan_verifikasi_tu();

        $data['total_menunggu']      = $this->Model_pengerjaan_tu->count_menunggu_verifikasi();
        $data['total_terverifikasi'] = $this->Model_pengerjaan_tu->count_terverifikasi();
        $data['total_ditolak']       = $this->Model_pengerjaan_tu->count_ditolak();

        $this->load->view('layout_tu/vhead');
        $this->load->view('dashboard_tu/partials/verifikasi_list', $data);
        $this->load->view('layout_tu/vscript');
    }

    public function detail($id)
    {
        $this->Model_activity_log->add(
            'OPEN_PAGE',
            'dashboard_tu',
            'Open detail pengerjaan. id: ' . (int)$id
        );

        $data['pengerjaan'] = $this->Model_pengerjaan_tu->get_pengerjaan_for_verifikasi($id);

        if (!$data['pengerjaan']) {
            $this->Model_activity_log->add(
                'NOT_FOUND',
                'dashboard_tu',
                'Detail pengerjaan tidak ditemukan. id: ' . (int)$id
            );

            redirect('dashboardtu/verifikasi_list');
        }

        $this->load->view('layout_tu/vhead');
        $this->load->view('dashboard_tu/detail', $data);
        $this->load->view('layout_tu/vscript');
    }

    public function verifikasi()
    {
        if (!$this->input->is_ajax_request()) {
            show_404();
            return;
        }

        $id_pengerjaan     = $this->input->post('id_pengerjaan');
        $status_verifikasi = $this->input->post('status_verifikasi');
        $catatan_tu        = $this->input->post('catatan_tu');

        if (!$id_pengerjaan || !$status_verifikasi) {
            echo json_encode([
                'status'  => 'error',
                'message' => 'Data tidak lengkap'
            ]);
            exit;
        }

        $this->Model_activity_log->add(
            'VERIFY_ACTION',
            'dashboard_tu',
            'Verifikasi pengerjaan. id_pengerjaan: ' . $id_pengerjaan .
            ' | status: ' . $status_verifikasi
        );

        $pengerjaan = $this->Model_pengerjaan_tu->get_pengerjaan_for_verifikasi($id_pengerjaan);

        if (!$pengerjaan) {
            echo json_encode([
                'status'  => 'error',
                'message' => 'Data pengerjaan tidak ditemukan'
            ]);
            exit;
        }

        $MAX_EVAL = 10;
        $POTONG_PER_EVAL = 10;

        $eval_count = (int)($pengerjaan->verifikasi_eval_count ?? 0);

        // ===== FIX SAMA: point 100 padahal eval_count sudah ada => hitung ulang =====
        $dbPoint = $pengerjaan->verifikasi_point_akhir;
        if ($dbPoint === null || $dbPoint === '' || ((int)$dbPoint === 100 && $eval_count > 0)) {
            $point_akhir_now = max(0, 100 - ($eval_count * $POTONG_PER_EVAL));
        } else {
            $point_akhir_now = (int)$dbPoint;
        }

        $data = [
            'verifikasi_status'  => $status_verifikasi,
            'verifikasi_catatan' => $catatan_tu,
            'verifikasi_by'      => $this->session->userdata('user_id'),
            'verifikasi_at'      => date('Y-m-d H:i:s')
        ];

        if ($status_verifikasi === 'disetujui') {
            $data['verifikasi_point_akhir'] = $point_akhir_now;

            $data['verifikasi_catatan'] = $catatan_tu .
                ' | Poin akhir: ' . $point_akhir_now;
        }

        if ($status_verifikasi === 'perlu_perbaikan') {

            if ($eval_count >= $MAX_EVAL) {
                $data['verifikasi_catatan'] = $catatan_tu .
                    ' | Evaluasi sudah maksimal: ' . $eval_count . '/' . $MAX_EVAL .
                    ' | Poin sekarang: ' . $point_akhir_now;
            } else {
                $data['verifikasi_catatan'] = $catatan_tu .
                    ' | Evaluasi: ' . $eval_count . '/' . $MAX_EVAL .
                    ' | Poin sekarang: ' . $point_akhir_now;
            }

            $data['verifikasi_eval_count']  = $eval_count;
            $data['verifikasi_point_akhir'] = $point_akhir_now;
        }

        $this->Model_pengerjaan_tu->verifikasi_pengerjaan($id_pengerjaan, $data);

        if ($status_verifikasi === 'perlu_perbaikan') {

            $pengerjaan = $this->Model_pengerjaan_tu
                ->get_pengerjaan_for_verifikasi($id_pengerjaan);

            if ($pengerjaan && !empty($pengerjaan->id_user)) {

                $notifikasi = [
                    'user_id'    => $pengerjaan->id_user,
                    'pesan'      => 'Laporan perlu perbaikan: ' . $catatan_tu,
                    'status'     => 'unread',
                    'created_at' => date('Y-m-d H:i:s')
                ];

                $this->Model_notifikasi->insert_notifikasi($notifikasi);
            }
        }

        // selalu kirim point_akhir agar UI tampil (disetujui / perlu_perbaikan sama-sama ada)
        echo json_encode([
            'status' => 'success',
            'eval_count' => $eval_count,
            'max_eval' => $MAX_EVAL,
            'potong_per_eval' => $POTONG_PER_EVAL,
            'point_awal' => 100,
            'point_minus_total' => (int)($eval_count * $POTONG_PER_EVAL),
            'point_sementara' => $point_akhir_now,
            'point_akhir' => $point_akhir_now
        ]);
        exit;
    }

    public function cetak_laporan_rekap()
    {
        $this->Model_activity_log->add(
            'OPEN_PAGE',
            'dashboard_tu',
            'Open cetak_laporan_rekap'
        );

        $data['title'] = 'Cetak Laporan Rekap';

        $this->load->view('layout_tu/vhead');
        $this->load->view('dashboard_tu/cetak_laporan_rekap', $data);
        $this->load->view('layout_tu/vscript');
    }
}
