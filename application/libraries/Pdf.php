<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use Dompdf\Dompdf;
use Dompdf\Options;

class Pdf {

    public function __construct()
    {
        if (file_exists(FCPATH . 'vendor/autoload.php')) {
            require_once FCPATH . 'vendor/autoload.php';
        } else {
            show_error("vendor/autoload.php tidak ditemukan. Pastikan kamu sudah install dompdf via Composer.", 500);
        }
    }

    /**
     * Create PDF from HTML
     * @param string $html
     * @param string $filename
     * @param bool $stream true=download/preview browser, false=return string
     * @param string $paper A4/letter
     * @param string $orientation portrait/landscape
     */
    public function create($html, $filename = 'document.pdf', $stream = true, $paper = 'A4', $orientation = 'portrait')
    {
        $options = new Options();
        $options->set('isRemoteEnabled', true);
        $options->set('isHtml5ParserEnabled', true);

        $dompdf = new Dompdf($options);
        $dompdf->loadHtml($html);
        $dompdf->setPaper($paper, $orientation);
        $dompdf->render();

        if ($stream) {
            $dompdf->stream($filename, ['Attachment' => 1]); // 1=download, 0=preview
        } else {
            return $dompdf->output();
        }
    }
}
