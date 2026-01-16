<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CetakLaporanRekap extends CI_Controller {

    public function __construct() {
        parent::__construct();

        $this->load->library('session');
        $this->load->helper(['url', 'form']);
        $this->load->database();
        $this->load->model('Model_rekap', 'rekap');

        // Proteksi akses
        $this->_authorize_ktu();
    }

    private function _authorize_ktu() {
        // BYPASS jika akses dari localhost (testing)
        $ip = $this->input->ip_address();
        if ($ip === '127.0.0.1' || $ip === '::1') {
            return;
        }

        // Cek login
        $login_keys = ['user_id', 'id_user', 'id', 'uid', 'username', 'nama'];
        $is_logged_in = false;

        foreach ($login_keys as $k) {
            if (!empty($this->session->userdata($k))) {
                $is_logged_in = true;
                break;
            }
        }

        if (!$is_logged_in) {
            show_error('Akses ditolak. Silakan login terlebih dahulu.', 401);
        }

        // Cek role
        $role_candidates = [
            $this->session->userdata('role'),
            $this->session->userdata('level'),
            $this->session->userdata('akses'),
            $this->session->userdata('user_role'),
            $this->session->userdata('jabatan'),
        ];

        $role_norm = '';
        foreach ($role_candidates as $rc) {
            if (!empty($rc)) {
                $role_norm = strtolower(trim((string)$rc));
                break;
            }
        }

        $allowed = [
            'ktu',
            'tu',
            'tata usaha',
            'kasubbag tu&keu',
            'kasubbag tu & keu',
            'kasubbag tu dan keu',
            'kasubbag tu&keuangan',
            'kasubbag tu & keuangan',
        ];

        if ($role_norm !== '' && !in_array($role_norm, $allowed, true)) {
            show_error('Akses ditolak. Hanya KTU/Kasubbag TU&Keu yang dapat mengakses halaman ini.', 403);
        }
    }

    public function index() {
        $data = ['title' => 'Cetak Laporan Rekap'];
        $this->load->view('laporan/cetak_rekap_form', $data);
    }

    public function preview() {
        [$start, $end] = $this->_get_range_or_fail();
        $payload = $this->_build_report_payload($start, $end);
        $payload['mode'] = 'preview';
        $this->load->view('laporan/cetak_rekap_preview', $payload);
    }

    public function print() {
        [$start, $end] = $this->_get_range_or_fail();
        $payload = $this->_build_report_payload($start, $end);
        $payload['mode'] = 'print';
        $this->load->view('laporan/cetak_rekap_print', $payload);
    }

    public function pdf() {
    [$start, $end] = $this->_get_range_or_fail();

    $payload = $this->_build_report_payload($start, $end);
    $html = $this->load->view('laporan/cetak_rekap_pdf', $payload, true);

    $this->load->library('Pdf');
    $filename = 'Laporan_Rekap_' . $start . '_sd_' . $end . '.pdf';
    $this->pdf->create($html, $filename, true, 'A4', 'landscape');
}


    private function _get_range_or_fail() {
        $start = $this->input->get('start', true);
        $end   = $this->input->get('end', true);

        if (!$start || !$end) show_error('Range tanggal wajib diisi (start & end).', 400);

        $start_dt = date_create_from_format('Y-m-d', $start);
        $end_dt   = date_create_from_format('Y-m-d', $end);

        if (!$start_dt || !$end_dt) show_error('Format tanggal harus YYYY-MM-DD.', 400);
        if ($start > $end) show_error('Tanggal mulai tidak boleh lebih besar dari tanggal akhir.', 400);

        return [$start, $end];
    }

    private function _build_report_payload($start, $end) {
        $rows    = $this->rekap->get_rekap_range($start, $end);
        $summary = $this->rekap->get_summary_range($start, $end);

        return [
            'title'      => 'Laporan Rekap Pekerjaan',
            'start'      => $start,
            'end'        => $end,
            'rows'       => $rows,
            'summary'    => $summary,
            'printed_at' => date('Y-m-d H:i:s'),
            'printed_by' => $this->session->userdata('nama') ?: 'KTU',
        ];
    }
}
