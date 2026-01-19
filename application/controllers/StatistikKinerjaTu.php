<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class StatistikKinerjaTu extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->helper(['url', 'form']);
        $this->load->library('session');

        $this->load->model('Model_statistik_kinerja', 'stat');

        // ===== TAMBAHAN: guard login TU (tanpa ubah struktur utama) =====
        // wajib login user
        if (!$this->session->userdata('user_logged_in')) {
            redirect('loginuser');
        }
        // wajib TU
        if ((int)$this->session->userdata('is_tu') !== 1) {
            redirect('dashboard_user');
        }

        // $this->_authorize_ktu();
    }

    private function _authorize_ktu() {
        $role = $this->session->userdata('role');
        if (!$role || !in_array($role, ['KTU','Kasubbag TU & Keu','Kasubbag TU&Keu'])) {
            show_error('Akses ditolak. Hanya KTU/Kasubbag TU&Keu yang dapat mengakses halaman ini.', 403);
        }
    }

    public function index() {
        // Ambil periode
        $start = $this->input->get('stat_start', true);
        $end   = $this->input->get('stat_end', true);

        // fallback lama (opsional)
        if (!$start) $start = $this->input->get('start', true);
        if (!$end)   $end   = $this->input->get('end', true);

        $start = $start ?: date('Y-m-01');
        $end   = $end   ?: date('Y-m-t');

        // validasi tanggal
        if ($start > $end) {
            $tmp = $start; $start = $end; $end = $tmp;
        }

        // ===== TAMBAHAN: validasi format tanggal (anti input aneh) =====
        // (tanpa mengubah struktur alur)
        if (!preg_match('/^\d{4}\-\d{2}\-\d{2}$/', $start)) $start = date('Y-m-01');
        if (!preg_match('/^\d{4}\-\d{2}\-\d{2}$/', $end))   $end   = date('Y-m-t');

        // Data statistik
        $totalKomplain = (int) $this->stat->indikator_komplain($start, $end);
        $ruanganBersih = (int) $this->stat->jumlah_ruangan_bersih($start, $end);
        $avgMenit      = (float) $this->stat->rata2_waktu_selesai_menit($start, $end);
        $listOb        = $this->stat->kinerja_ob($start, $end);

        // ===== TAMBAHAN: normalisasi nilai komplain (agar sesuai tampilan, misal 8) =====
        if ($totalKomplain < 0) $totalKomplain = 0;

        // amankan nilai
        if ($avgMenit < 0) $avgMenit = 0;

        // ===== TAMBAHAN: pastikan nama tampil di view (fallback aman) =====
        if (!empty($listOb)) {
            foreach ($listOb as $row) {
                $nama = '';
                if (!empty($row->display_nama)) $nama = $row->display_nama;
                else if (!empty($row->nama_ob)) $nama = $row->nama_ob;
                else if (!empty($row->nama)) $nama = $row->nama;
                else if (!empty($row->full_name)) $nama = $row->full_name;
                else if (!empty($row->username)) $nama = $row->username;

                if ($nama === '') {
                    $nama = 'OB ' . (int)($row->id_user ?? 0);
                }
                $row->display_nama = $nama;
            }
        }

        $data = [
            'title'               => 'Statistik Kinerja',
            'stat_start'          => $start,
            'stat_end'            => $end,
            'max_komplain'        => 10,
            'total_komplain_stat' => $totalKomplain,
            'ruangan_bersih'      => $ruanganBersih,
            'avg_menit'           => $avgMenit,
            'list_ob'             => $listOb,
        ];

        $this->load->view('statistik_kinerja/index', $data);
    }
}
