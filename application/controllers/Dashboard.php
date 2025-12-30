<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('Model_dashboard', 'd');
        if ($this->session->userdata('admin_valid') == FALSE && $this->session->userdata('email') == "") {
            redirect("login");
        }
    }

    /* Start Fungsi Log Audittrail */
    function index()
    {
        if ($this->session->userdata('admin_valid') == FALSE && $this->session->userdata('email') == "") {
            redirect("login");
        }
        $active_satker=decrypt_url($this->session->userdata('active_satker'));
        // echo "aktif".$active_satker;
        /* else if (!($this->session->userdata('role') == "0")) {
            redirect("login");
        } */
        $data = [
            'title' => "Dashboard",
            'page' => "view_dashboard",
            'get_satker' => $this->d->get_satker($active_satker)
        ];

        $this->load->view('index', $data);
    }
    /* End Fungsi Log Audittrail */

    public function get_data_bulanan_pb_by_date()
    {
        $active_satker=decrypt_url($this->session->userdata('active_satker'));

        $from_date = $this->input->get('from_date');
        $to_date = $this->input->get('to_date');

        /* $data_bulanan = $this->d->get_data_bulanan_pb_by_date($from_date, $to_date);
        var_dump($data_bulanan); */
        
        $data = [
            'get_data_bulanan' => $this->d->get_data_bulanan_pb_by_date($from_date, $to_date),
            'title' => 'Dashboard',
            'page' => 'view_dashboard',
            'get_satker' => $this->d->get_satker($active_satker)
        ];

        $this->load->view('index', $data);
    }

    public function cetak_laporan_otomatis()
    {   
        require_once (APPPATH . 'libraries/dompdf/dompdf_config.inc.php');
        require_once (APPPATH . 'libraries/PDFMerger/PDFMerger.php');

        $active_satker=decrypt_url($this->session->userdata('active_satker'));

        $from_date = $this->input->post('from_date');
        $to_date = $this->input->post('to_date');
        $data_konsultasi = $this->d->get_konsultasi($from_date, $to_date);
        $data_jk_gol = $this->d->get_data_bulanan_pb_by_date($from_date, $to_date);
        $data_satker = $this->d->get_satker($active_satker);
        $nama_lembaga = $data_satker[3]->nama_satker; //IDK How to make this automatic YET
        /* var_dump($data_konsultasi);
        exit; */

        $html = $this->load->view('pb/laporan_pdf', [
            'data_konsultasi' => $data_konsultasi,
            'data_jk_gol' => $data_jk_gol,
            'nama_lembaga' => $nama_lembaga,
            'dari_tanggal' => $from_date,
            'hingga_tanggal' => $to_date,
        ], TRUE);

        $dompdf = new DOMPDF();
        $dompdf->load_html($html);
        $dompdf->set_paper('A4', 'landscape');
        $dompdf->render();
        $pdf_output = $dompdf->output();

        $temp_pdf_path = 'resources/lampiran/sinergi_data/konsultasi/temp_laporan.pdf';
        file_put_contents($temp_pdf_path, $pdf_output);

        $pdfMerger = new \PDFMerger\PDFMerger();

        $pdfMerger->addPDF($temp_pdf_path, 'all');

        foreach ($data_konsultasi as $row) {
            $pdf_file_path = 'resources/lampiran/sinergi_data/konsultasi/combined/' . $row->lampiran;
            if (file_exists($pdf_file_path)) {
                $pdfMerger->addPDF($pdf_file_path, 'all');
            }
        }

        $pdfMerger->merge('browser', 'Laporan_Combined.pdf');

        // (1 = download, 0 = preview)
        //$dompdf->stream("Laporan.pdf", array("Attachment" => 0));
    }
}
