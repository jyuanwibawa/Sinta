<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class StatistikKinerjaTu extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->helper(['url', 'form']);
        $this->load->library('session');

        $this->load->model('Model_statistik_kinerja', 'stat');

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

        // Data statistik
        $totalKomplain = (int) $this->stat->indikator_komplain($start, $end);
        $ruanganBersih = (int) $this->stat->jumlah_ruangan_bersih($start, $end);
        $avgMenit      = (float) $this->stat->rata2_waktu_selesai_menit($start, $end);
        $listOb        = $this->stat->kinerja_ob($start, $end);

        // amankan nilai
        if ($avgMenit < 0) $avgMenit = 0;

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
