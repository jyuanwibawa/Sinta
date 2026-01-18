<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DashboardTu extends CI_Controller {

    public function __construct()
    {
        parent::__construct();

        $this->load->model('Model_pengerjaan_tu');
        $this->load->model('Model_notifikasi');
        $this->load->model('Model_statistik_kinerja', 'stat');
    }

    public function index()
    {
        $data['laporan'] = $this->Model_pengerjaan_tu->get_laporan_verifikasi_tu();

        $data['total_hari_ini']       = $this->Model_pengerjaan_tu->count_laporan_hari_ini();
        $data['total_menunggu']       = $this->Model_pengerjaan_tu->count_menunggu_verifikasi();
        $data['total_terverifikasi']  = $this->Model_pengerjaan_tu->count_terverifikasi();
        $data['total_ditolak']        = $this->Model_pengerjaan_tu->count_ditolak();
        $data['total_komplain']       = $this->Model_pengerjaan_tu->count_komplain_bulan_ini();

        // statistik
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

        // indikator max komplain supervisor
        $data['max_komplain'] = 10;

        //total komplain untuk periode statistik
        $data['total_komplain_stat'] = (int) $this->stat->indikator_komplain($stat_start, $stat_end);

        // jumlah ruangan bersih (misal dihitung dari pengerjaan selesai + disetujui)
        $data['ruangan_bersih'] = (int) $this->stat->jumlah_ruangan_bersih($stat_start, $stat_end);

        // rata2 waktu penyelesaian tugas (menit)
        $avgMenit = (float) $this->stat->rata2_waktu_selesai_menit($stat_start, $stat_end);

        // amankan biar tidak minus
        if ($avgMenit < 0) $avgMenit = 0;
        $data['avg_menit'] = $avgMenit;

        // list OB performa 
        $data['list_ob'] = $this->stat->kinerja_ob($stat_start, $stat_end);

        // Nama OB: pakai data model kalau ada, fallback OB + id_user
        if (!empty($data['list_ob'])) {
            foreach ($data['list_ob'] as $row) {

                // Ambil nama dari field yang mungkin dikirim model
                $nama = '';
                if (!empty($row->display_nama)) $nama = $row->display_nama;
                else if (!empty($row->nama_ob)) $nama = $row->nama_ob;
                else if (!empty($row->nama)) $nama = $row->nama;
                else if (!empty($row->full_name)) $nama = $row->full_name;
                else if (!empty($row->username)) $nama = $row->username;

                // fallback terakhir: OB + id
                if ($nama === '') {
                    $nama = 'OB ' . (int)(isset($row->id_user) ? $row->id_user : 0);
                }

                // Set field yang dipakai view
                $row->display_nama = $nama;
            }
        }

        $this->load->view('layout_tu/vhead');
        $this->load->view('dashboard_tu/index', $data);
        $this->load->view('layout_tu/vscript');
    }

    // ajax monitoring
    public function get_laporan_ajax()
    {
        $data['laporan'] = $this->Model_pengerjaan_tu->get_all_laporan_ob();
        $this->load->view('dashboard_tu/partials/laporan_ob_list', $data);
    }

    // ajax verifikasi (auto refresh)
    public function get_verifikasi_ajax()
    {
        $data['laporan'] = $this->Model_pengerjaan_tu->get_laporan_verifikasi_tu();
        $this->load->view('dashboard_tu/partials/verifikasi_list', $data);
    }

    public function verifikasi_list()
    {
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
        $data['pengerjaan'] = $this->Model_pengerjaan_tu->get_pengerjaan_for_verifikasi($id);

        if (!$data['pengerjaan']) {
            redirect('dashboardtu/verifikasi_list');
        }

        $this->load->view('layout_tu/vhead');
        $this->load->view('dashboard_tu/detail', $data);
        $this->load->view('layout_tu/vscript');
    }

    // ajax
    public function verifikasi()
    {
        // 🔒 Pastikan hanya request AJAX yang diproses
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

        // update status laporan
        $data = [
            'verifikasi_status'  => $status_verifikasi,
            'verifikasi_catatan' => $catatan_tu,
            'verifikasi_by'      => $this->session->userdata('user_id'),
            'verifikasi_at'      => date('Y-m-d H:i:s')
        ];

        $this->Model_pengerjaan_tu->verifikasi_pengerjaan($id_pengerjaan, $data);

        if ($status_verifikasi === 'perlu_perbaikan') {

            $pengerjaan = $this->Model_pengerjaan_tu
                ->get_pengerjaan_for_verifikasi($id_pengerjaan);

            if ($pengerjaan && !empty($pengerjaan->id_user)) {

                $notifikasi = [
                    'user_id'    => $pengerjaan->id_user,
                    'pesan'      => 'Laporan perlu perbaikan: ' . $catatan_tu,
                    'status'     => 'belum dibaca',
                    'created_at' => date('Y-m-d H:i:s')
                ];

                $this->Model_notifikasi->insert_notifikasi($notifikasi);
            }
        }

        //response ajax (tanpa redirect) 
        echo json_encode(['status' => 'success']);
        exit;
    }

    public function cetak_laporan_rekap()
    {
        // if ($this->session->userdata('role') != 'KTU') show_error('Akses ditolak', 403);

        $data['title'] = 'Cetak Laporan Rekap';

        $this->load->view('layout_tu/vhead');
        $this->load->view('dashboard_tu/cetak_laporan_rekap', $data); // view form tanggal
        $this->load->view('layout_tu/vscript');
    }
}
