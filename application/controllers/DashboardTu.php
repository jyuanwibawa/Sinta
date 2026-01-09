<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DashboardTu extends CI_Controller {

    public function __construct()
    {
        parent::__construct();

        $this->load->model('Model_pengerjaan_tu');
        $this->load->model('Model_notifikasi');
    }

    public function index()
    {
        $data['laporan'] = $this->Model_pengerjaan_tu->get_laporan_verifikasi_tu();

        $data['total_hari_ini']       = $this->Model_pengerjaan_tu->count_laporan_hari_ini();
        $data['total_menunggu']       = $this->Model_pengerjaan_tu->count_menunggu_verifikasi();
        $data['total_terverifikasi']  = $this->Model_pengerjaan_tu->count_terverifikasi();
        $data['total_ditolak']        = $this->Model_pengerjaan_tu->count_ditolak();
        $data['total_komplain']       = $this->Model_pengerjaan_tu->count_komplain_bulan_ini();

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


}
