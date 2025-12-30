<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Pb extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->library('session');
        $this->load->model('Model_pb', 'pb');
        $this->load->model('Model_pn', 'pn');
        $this->load->model('Model_permintaan_pb', 'mpp');
        if ($this->session->userdata('admin_valid') == FALSE && $this->session->userdata('email') == "") {
            redirect("login");
        }
    }

    /* public function satker($enc_satker_tujuan=NULL,$enc_satker_asal=NULL)
    {
        if ($this->session->userdata('admin_valid') == FALSE && $this->session->userdata('email') == "") {
            redirect("login");
        }

        $satker_tujuan=decrypt_url($enc_satker_tujuan);
        $satker_asal=decrypt_url($enc_satker_asal);

        $active_satker=decrypt_url($this->session->userdata('active_satker'));
        if($active_satker==$satker_asal){
            $id_panggil=$satker_tujuan;
            $katasambung="Keluar Ke";
        }else{
            $id_panggil=$satker_asal;
            $katasambung="Masuk Dari";
        }
        $nama_satker=$this->pn->get_satker($id_panggil);
        // var_dump($nama_satker['0']);
        $nama_satker=$nama_satker['0']->nama_satker;
        
        $data = [
            'enc_satker_tujuan' => $enc_satker_tujuan,
            'enc_satker_asal' => $enc_satker_asal,
            'all' => $this->pb->get_all($satker_tujuan,$satker_asal),
            'get_list_jlayanan' => $this->pb->get_list_jlayanan(),
            'get_list_jperkara' => $this->pb->get_list_jperkara(),
            'get_list_kategori' => $this->pb->get_list_kategori(),
            'get_satker' => $this->pn->get_satker(),
            'get_instansi' => $this->pn->get_satker($active_satker),
            'title' => 'Semua Data '.$katasambung.' '.$nama_satker,
            'page' => "pb/regis_data",
        ];
        
        $this->load->view('index', $data);
    } */

    public function get_list_sjperkara($id_jperkara) 
    {
        $data = $this->pb->get_list_sjperkara($id_jperkara);
        echo json_encode($data);
    }

    public function get_list_klasifikasi($id_sjperkara) 
    {
        $data = $this->pb->get_list_klasifikasi($id_sjperkara);
        echo json_encode($data);
    }

    public function store() 
    {
        if ($this->session->userdata('admin_valid') == FALSE && $this->session->userdata('email') == "") {
            redirect("login");
        }

        $active_satker=decrypt_url($this->session->userdata('active_satker'));
        $active_instansi=$this->pn->get_satker($active_satker);

        $this->form_validation->set_rules('tanggalkonsultasi', 'Tanggal Konsultasi', 'required');
        $this->form_validation->set_rules('nama', 'Nama', 'required');
        $this->form_validation->set_rules('usia', 'Usia', 'required');
        $this->form_validation->set_rules('jeniskelamin', 'Jenis Kelamin', 'required');
        $this->form_validation->set_rules('alamat', 'Alamat', 'required');
        $this->form_validation->set_rules('perkerjaan', 'Perkerjaan', 'required');
        $this->form_validation->set_rules('jenislayanan', 'Jenis Layanan', 'required');
        $this->form_validation->set_rules('jenisperkara', 'Jenis Perkara', 'required');
        $this->form_validation->set_rules('subjenisperkara', 'Sub Jenis Perkara', 'required');
        $this->form_validation->set_rules('permasalahan', 'Permasalahan', 'required');
        $this->form_validation->set_rules('solusi', 'Solusi', 'required');
        $this->form_validation->set_rules('penerimalayanan', 'Penerima Layanan', 'required');
        $this->form_validation->set_rules('advokat', 'Advokat Piket', 'required');
        $this->form_validation->set_rules('durasi_layanan', 'Durasi Layanan', 'required');

        $penerimalayanan = $this->input->post('penerimalayanan');

        if($penerimalayanan == '1') {
            if (empty($_FILES['ktp']['name'])) {
                $this->form_validation->set_rules('ktp', 'KTP', 'required');
            }
            if (empty($_FILES['form']['name'])) {
                $this->form_validation->set_rules('form', 'Form', 'required');
            }
        } elseif($penerimalayanan == '2') {
            if (empty($_FILES['ktp']['name'])) {
                $this->form_validation->set_rules('ktp', 'KTP', 'required');
            }
            if (empty($_FILES['form']['name'])) {
                $this->form_validation->set_rules('form', 'Form', 'required');
            }
            if (empty($_FILES['sktm']['name'])) {
                $this->form_validation->set_rules('sktm', 'SKTM', 'required');
            }
        }

        if (!$this->form_validation->run()) {
            $this->session->set_flashdata('errors', validation_errors());
        } else {
            $merged_file = $this->do_merge();
            if (!$merged_file) {
                $this->session->set_flashdata('errors', 'Tidak ada File Terpilih');
                redirect(base_url('Pn/satker/'.$this->input->post('enc_satker_tujuan').'/'.$this->input->post('enc_satker_asal')));
            }

            // Store the merged file name in the database
            $this->pb->store($merged_file);
            $this->session->set_flashdata('success', "Saved Successfully!");

            /* //== pengiriman pesan
            // $id_kasus=decrypt_url($id);
            $id_kasus=$insert_id;

            $status_penerima=$this->pn->get_status_penerima_pesan($id_kasus,$active_satker);
            $status_penerima=$status_penerima[0]->statusnya;

            $get_penerimapesan=$this->pn->get_penerima_pesan($id_kasus,$status_penerima);
            $jum_penerimapesan=$get_penerimapesan->num_rows();
            if($jum_penerimapesan>0){
                foreach($get_penerimapesan->result() as $penerimapesan){
                    $pesan="Bapak/Ibu ".$penerimapesan->nama.".";
                    $pesan.="\n\nTerdapat _*Data Masuk*_ baru untuk SINTA nomor ".$penerimapesan->nosurat.".";

                    $phone=$penerimapesan->no_hp;
                    $this->kirimpesan($pesan,$phone);            
                }
            }
            //== end of pengiriman pesan */
        }
        redirect(base_url('Pn/satker/'.$this->input->post('enc_satker_tujuan').'/'.$this->input->post('enc_satker_asal')));
    }

    public function do_merge()
    {
        require_once (APPPATH . 'libraries/PDFMerger/PDFMerger.php');

        $pdf = new \PDFMerger\PDFMerger();

        $upload_dir = 'resources/lampiran/sinergi_data/konsultasi/combined/';

        $file_inputs = ['form', 'ktp', 'sktm'];
        $files_to_merge = [];

        foreach ($file_inputs as $file_input) {
            if ($_FILES[$file_input]['size'] != 0) {
                $config['upload_path'] = $upload_dir;
                $config['allowed_types'] = 'pdf';
                $config['file_name'] = $file_input . '_' . substr(md5(rand()), 0, 9);
                $config['overwrite'] = false;
                $config['max_size'] = '10240';
    
                $this->load->library('upload', $config);
    
                if (!$this->upload->do_upload($file_input)) {
                    $this->form_validation->set_message('do_merge', $this->upload->display_errors());
                    return false;
                } else {
                    $uploaded_file = $this->upload->data('full_path');
                    $files_to_merge[] = $uploaded_file;
                }
            }
        }

        foreach ($files_to_merge as $file) {
            $pdf->addPDF($file, 'all');
        }

        $merged_file_name = 'merged_' . substr(md5(rand()), 0, 9) . '.pdf';
        $pdf->merge('file', $upload_dir . $merged_file_name);

        return $merged_file_name;
    }

    public function do_upload()
    {
        if ($_FILES['lampiran']['size'] != 0) {
            // $upload_dir = 'resources/lampiran/pn/surat';
            $upload_dir = 'resources/lampiran/sinergi_data/surat';
            if (!is_dir($upload_dir)) {
                mkdir($upload_dir);
            }
            $config['upload_path']   = $upload_dir;
            $config['allowed_types'] = 'pdf';
            $config['file_name']     = 'file_lampiran_' . substr(md5(rand()), 0, 9);
            $config['overwrite']     = false;
            $config['max_size']  = '10240';

            $this->load->library('upload', $config);
            if (!$this->upload->do_upload('lampiran')) {
                $this->form_validation->set_message('do_upload', $this->upload->display_errors());
                return false;
            } else {
                $this->upload_data['file'] =  $this->upload->data();
                return true;
            }
        } else {
            $this->form_validation->set_message('do_upload', "tidak ada berkas terpilih");
            return false;
        }
    }

    public function do_upload_lampiran()
    {
        if ($_FILES['lampiran_pb']['size'] != 0) {
            // $upload_dir = 'resources/lampiran/pn';
            $upload_dir = 'resources/lampiran/sinergi_data/lampiran';
            if (!is_dir($upload_dir)) {
                mkdir($upload_dir);
            }
            $config['upload_path']   = $upload_dir;
            $config['allowed_types'] = 'pdf';
            $config['file_name']     = 'file_lampiran_pb_' . substr(md5(rand()), 0, 9);
            $config['overwrite']     = false;
            $config['max_size']  = '10240';

            $this->load->library('upload', $config);
            if (!$this->upload->do_upload('lampiran_pb')) {
                $this->form_validation->set_message('do_upload', $this->upload->display_errors());
                return false;
            } else {
                $this->upload_data['file'] =  $this->upload->data();
                return true;
            }
        } else {
            $this->form_validation->set_message('do_upload', "tidak ada berkas terpilih");
            return false;
        }
    }

    public function show($id)
    {
        if ($this->session->userdata('admin_valid') == FALSE && $this->session->userdata('email') == "") {
            redirect("login");
        }

        $show=$this->pb->get(decrypt_url($id));
        $show_satkeridtujuan=$show->satker_id_tujuan;
        $data = [
            'show' => $show,
            'get_permintaan' => $this->pb->get_permintaan($id),
            'get_list_jlayanan' => $this->pb->get_list_jlayanan(),
            'get_list_jperkara' => $this->pb->get_list_jperkara(),
            'get_list_kategori' => $this->pb->get_list_kategori(),
            'get_list_advokat' => $this->pb->get_list_advokat(),
            'get_pesan' => $this->mpp->get_pesan(decrypt_url($id)),
            'get_satker' => $this->pn->get_satker(),
            'get_aplikasi' => $this->pn->get_satker_aplikasi($show_satkeridtujuan),
            'title' => 'Detil Data',
            'page' => 'pb/detil_data',
        ];
        $this->load->view('index', $data);
    }

    public function store_permintaan($id) 
    {
        if ($this->session->userdata('admin_valid') == FALSE && $this->session->userdata('email') == "") {
            redirect("login");
        }

        $this->form_validation->set_rules('judul', 'Judul', 'required');
        $this->form_validation->set_rules('keterangan_pb', 'Keterangan', 'required');
        $this->form_validation->set_rules('lampiran_pb', 'Lampiran', 'callback_do_upload_lampiran');

        if (!$this->form_validation->run()) {
            $this->session->set_flashdata('errors', validation_errors());
        } else {
            $this->pb->store_permintaan($id);
            $this->session->set_flashdata('success', "Saved Successfully!");

            //== pengiriman pesan
            // $id_kasus=decrypt_url($id);
            // $active_satker=decrypt_url($this->session->userdata('active_satker'));

            // $status_penerima=$this->pn->get_status_penerima_pesan($id_kasus,$active_satker);
            // $status_penerima=$status_penerima[0]->statusnya;

            // $get_penerimapesan=$this->pn->get_penerima_pesan($id_kasus,$status_penerima);
            // $jum_penerimapesan=$get_penerimapesan->num_rows();
            // if($jum_penerimapesan>0){
            //     foreach($get_penerimapesan->result() as $penerimapesan){
            //         $pesan="Bapak/Ibu ".$penerimapesan->nama.".";
            //         $pesan.="\n\nTerdapat _*Dokumen Masuk*_ baru untuk data SINTA nomor ".$penerimapesan->nosurat.".";

            //         $phone=$penerimapesan->no_hp;
            //         $this->kirimpesan($pesan,$phone);            
            //     }
            // }
            // //== end of pengiriman pesan
        }
        redirect(base_url('Pb/show/' . $id));
    }
    public function do_update_merge()
    {
        require_once (APPPATH . 'libraries/PDFMerger/PDFMerger.php');

        $pdf = new \PDFMerger\PDFMerger();

        $upload_dir = 'resources/lampiran/sinergi_data/konsultasi/combined/';

        $file_inputs = ['ktp', 'form', 'sktm'];
        $files_to_merge = [];

        foreach ($file_inputs as $file_input) {
            if ($_FILES[$file_input]['size'] != 0) {
                $config['upload_path'] = $upload_dir;
                $config['allowed_types'] = 'pdf';
                $config['file_name'] = $file_input . '_' . substr(md5(rand()), 0, 9);
                $config['overwrite'] = false;
                $config['max_size'] = '10240';
    
                $this->load->library('upload', $config);
    
                if (!$this->upload->do_upload($file_input)) {
                    $this->form_validation->set_message('do_merge', $this->upload->display_errors());
                    return false;
                } else {
                    $uploaded_file = $this->upload->data('full_path');
                    $files_to_merge[] = $uploaded_file;
                }
            }
        }

        if (empty($files_to_merge)) {
            return null; // Tidak ada file yang diupload, kembalikan null
        }

        // Add the files to PDFMerger and merge
        foreach ($files_to_merge as $file) {
            $pdf->addPDF($file, 'all');
        }

        $merged_file_name = 'merged_' . substr(md5(rand()), 0, 9) . '.pdf';
        $pdf->merge('file', $upload_dir . $merged_file_name);

        // Return the merged file path or name to store in the database if needed
        return $merged_file_name;
    }

    public function update($id)
    {
        if ($this->session->userdata('admin_valid') == FALSE && $this->session->userdata('email') == "") {
            redirect("login");
        }

        $this->form_validation->set_rules('tanggalkonsultasi', 'Tanggal Konsultasi', 'required');
        $this->form_validation->set_rules('nama', 'Nama', 'required');
        $this->form_validation->set_rules('usia', 'Usia', 'required');
        $this->form_validation->set_rules('jeniskelamin', 'Jenis Kelamin', 'required');
        $this->form_validation->set_rules('alamat', 'Alamat', 'required');
        $this->form_validation->set_rules('perkerjaan', 'Perkerjaan', 'required');
        $this->form_validation->set_rules('jenislayanan', 'Jenis Layanan', 'required');
        $this->form_validation->set_rules('jenisperkara', 'Jenis Perkara', 'required');
        $this->form_validation->set_rules('subjenisperkara', 'Sub Jenis Perkara', 'required');
        $this->form_validation->set_rules('permasalahan', 'Permasalahan', 'required');
        $this->form_validation->set_rules('solusi', 'Solusi', 'required');
        $this->form_validation->set_rules('penerimalayanan', 'Penerima Layanan', 'required');
        $this->form_validation->set_rules('advokat', 'Advokat Piket', 'required');
        $this->form_validation->set_rules('durasi_layanan', 'Durasi Layanan', 'required');

        $penerimalayanan = $this->input->post('penerimalayanan');

        if($penerimalayanan == '1') {
            if (empty($_FILES['ktp']['name'])) {
                $this->form_validation->set_rules('ktp', 'KTP', 'required');
            }
            if (empty($_FILES['form']['name'])) {
                $this->form_validation->set_rules('form', 'Form', 'required');
            }
        } elseif($penerimalayanan == '2') {
            if (empty($_FILES['ktp']['name'])) {
                $this->form_validation->set_rules('ktp', 'KTP', 'required');
            }
            if (empty($_FILES['form']['name'])) {
                $this->form_validation->set_rules('form', 'Form', 'required');
            }
            if (empty($_FILES['sktm']['name'])) {
                $this->form_validation->set_rules('sktm', 'SKTM', 'required');
            }
        }

        // if (!$this->form_validation->run()) {
        //     $this->session->set_flashdata('errors', validation_errors());
        // } else {
        //     $merged_file = $this->do_update_merge();
        //     $this->pb->update(decrypt_url($id), $merged_file);
        //     // $this->pb->update(decrypt_url($id));
        //     $this->session->set_flashdata('success', "Updated Successfully!");
        // }
        if (!$this->form_validation->run()) {
            $this->session->set_flashdata('errors', validation_errors());
        } else {
            $merged_file = $this->do_update_merge(); // Memanggil fungsi do_merge
    
            if ($merged_file !== null) {
                $this->pb->update(decrypt_url($id), $merged_file); // Kirim file hasil merge ke model
            } else {
                $this->pb->update(decrypt_url($id)); // Jika tidak ada file baru, update tanpa mengubah lampiran
            }
    
            $this->session->set_flashdata('success', "Updated Successfully!");
        }

        redirect(base_url('Pb/show/' . $id));
    }

    public function delete($id)
    {
        if ($this->session->userdata('admin_valid') == FALSE && $this->session->userdata('email') == "") {
            redirect("login");
        }

        $this->pb->delete(decrypt_url($id));
        $this->session->set_flashdata('success', "Deleted Successfully!");
        redirect(base_url('Pn/satker/'.encrypt_url("4").'/'.encrypt_url('1')));
    }

}

