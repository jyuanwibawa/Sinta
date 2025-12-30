<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Pn extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->library('session');
        $this->load->model('Model_pn', 'pn');
        $this->load->model('Model_pb', 'pb');
        $this->load->model('Model_permintaan', 'mp');
        if ($this->session->userdata('admin_valid') == FALSE && $this->session->userdata('email') == "") {
            redirect("login");
        }
    }

    /*
       Display all records in page
    */
    // public function index() //== digunakan (checked 20240602)
    // {
    //     if ($this->session->userdata('admin_valid') == FALSE && $this->session->userdata('email') == "") {
    //         redirect("login");
    //     }

    //     $data = [
    //         'all' => $this->pn->get_all(),
    //         'get_list_jeniskegiatan' => $this->pn->get_list_jeniskegiatan(),
    //         'get_list_objek' => $this->pn->get_list_objek(),
    //         'get_satker' => $this->pn->get_satker(),
    //         'title' => 'Semua Data PN',
    //         'page' => 'pn/regis_data',
    //     ];
    //     $this->load->view('index', $data);
    // }

    public function satker($enc_satker_tujuan=NULL,$enc_satker_asal=NULL) //== new by adityo
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
            'all' => $this->pn->get_all($satker_tujuan,$satker_asal),
            'get_list_jeniskegiatan' => $this->pn->get_list_jeniskegiatan(),
            'get_list_objek' => $this->pn->get_list_objek(),
            'get_satker' => $this->pn->get_satker(),
            'get_instansi' => $this->pn->get_satker($active_satker),
            'title' => 'Semua Data '.$katasambung.' '.$nama_satker,
            'page' => "pn/regis_data",
        ];

        if($active_satker == 4 || $satker_asal == 1 && $satker_tujuan == 4 || $satker_asal == 4 && $satker_tujuan == 1){
            $data['all'] = $this->pb->get_all($satker_tujuan, $satker_asal);
            $data['get_list_jlayanan'] = $this->pb->get_list_jlayanan();
            $data['get_list_jperkara'] = $this->pb->get_list_jperkara();
            $data['get_list_kategori'] = $this->pb->get_list_kategori();
            /* $data['get_list_klasifikasi'] = $this->pb->get_list_klasifikasi(); */
            $data['get_list_advokat'] = $this->pb->get_list_advokat();
            $data['page'] = "pb/regis_data";
        }
        
        $this->load->view('index', $data);
    }

    // public function edit_kajian($id)
    // {
    //     if ($this->session->userdata('admin_valid') == FALSE && $this->session->userdata('email') == "") {
    //         redirect("login");
    //     }

    //     $data = [
    //         'all' => $this->kasus->get_all(),
    //         'get_list_jeniskegiatan' => $this->kasus->get_list_jeniskegiatan(),
    //         'get_list_objek' => $this->kasus->get_list_objek(),
    //         'get_kajian' => $this->kasus->get_kajian_1($id),
    //         'title' => 'Edit Kajian',
    //         'page' => 'kasus/edit_kajian',
    //     ];
    //     $this->load->view('index', $data);
    // }

    // public function pemeriksaan()
    // {
    //     if ($this->session->userdata('admin_valid') == FALSE && $this->session->userdata('email') == "") {
    //         redirect("login");
    //     }

    //     $data = [
    //         'all' => $this->pn->pemeriksaan(),
    //         'get_list_jeniskegiatan' => $this->pn->get_list_jeniskegiatan(),
    //         'get_list_objek' => $this->pn->get_list_objek(),
    //         'title' => 'Pemeriksaan Setempat',
    //         'page' => 'pn/regis_data',
    //     ];
    //     $this->load->view('index', $data);
    // }

    // public function konstatering()
    // {
    //     if ($this->session->userdata('admin_valid') == FALSE && $this->session->userdata('email') == "") {
    //         redirect("login");
    //     }

    //     $data = [
    //         'all' => $this->pn->konstatering(),
    //         'get_list_jeniskegiatan' => $this->pn->get_list_jeniskegiatan(),
    //         'get_list_objek' => $this->pn->get_list_objek(),
    //         'title' => 'Konstatering',
    //         'page' => 'pn/regis_data',
    //     ];
    //     $this->load->view('index', $data);
    // }

    // public function sita()
    // {
    //     if ($this->session->userdata('admin_valid') == FALSE && $this->session->userdata('email') == "") {
    //         redirect("login");
    //     }

    //     $data = [
    //         'all' => $this->pn->sita(),
    //         'get_list_jeniskegiatan' => $this->pn->get_list_jeniskegiatan(),
    //         'get_list_objek' => $this->pn->get_list_objek(),
    //         'title' => 'Sita',
    //         'page' => 'pn/regis_data',
    //     ];
    //     $this->load->view('index', $data);
    // }

    // public function lainnya()
    // {
    //     if ($this->session->userdata('admin_valid') == FALSE && $this->session->userdata('email') == "") {
    //         redirect("login");
    //     }

    //     $data = [
    //         'all' => $this->pn->lainnya(),
    //         'get_list_jeniskegiatan' => $this->pn->get_list_jeniskegiatan(),
    //         'get_list_objek' => $this->pn->get_list_objek(),
    //         'title' => 'Lain-lain',
    //         'page' => 'pn/regis_data',
    //     ];
    //     $this->load->view('index', $data);
    // }

    // public function skpt()
    // {
    //     if ($this->session->userdata('admin_valid') == FALSE && $this->session->userdata('email') == "") {
    //         redirect("login");
    //     }

    //     $data = [
    //         'all' => $this->pn->skpt(),
    //         'get_list_jeniskegiatan' => $this->pn->get_list_jeniskegiatan(),
    //         'get_list_objek' => $this->pn->get_list_objek(),
    //         'title' => 'Penerbitan SKPT',
    //         'page' => 'pn/regis_data',
    //     ];
    //     $this->load->view('index', $data);
    // }

    // public function sidang()
    // {
    //     if ($this->session->userdata('admin_valid') == FALSE && $this->session->userdata('email') == "") {
    //         redirect("login");
    //     }

    //     $data = [
    //         'all' => $this->pn->sidang(),
    //         'get_list_jeniskegiatan' => $this->pn->get_list_jeniskegiatan(),
    //         'get_list_objek' => $this->pn->get_list_objek(),
    //         'title' => 'Panggilan Sidang',
    //         'page' => 'pn/regis_data',
    //     ];
    //     $this->load->view('index', $data);
    // }

    /*
   
      Display a record
    */
    public function show($id)//== digunakan (Checked 20240602)
    {
        if ($this->session->userdata('admin_valid') == FALSE && $this->session->userdata('email') == "") {
            redirect("login");
        }

        $show=$this->pn->get(decrypt_url($id));
        $show_satkeridtujuan=$show->satker_id_tujuan;
        $show_idkegiatan=$show->id_kegiatan;
        $data = [
            'show' => $show,
            'get_permintaan' => $this->pn->get_permintaan($id),
            // 'get_seksi' => $this->pn->get_seksi($id),
            // 'get_list_seksi' => $this->pn->get_list_seksi(),
            // 'get_kajian' => $this->pn->get_kajian($id),
            // 'get_list_jkajian' => $this->pn->get_list_jkajian(),
            // 'get_list_jeniskegiatan' => $this->pn->get_list_jeniskegiatan(),
            // 'get_list_objek' => $this->pn->get_list_objek(),
            // 'get_rekomendasi' => $this->pn->get_rekomendasi($id),
            // 'show_pesan' => $this->mp->get(decrypt_url($id)),
            'get_pesan' => $this->mp->get_pesan(decrypt_url($id)),
            'get_satker' => $this->pn->get_satker(),
            'get_aplikasi' => $this->pn->get_satker_aplikasi($show_satkeridtujuan,$show_idkegiatan),
            'title' => 'Detil Data',
            'page' => 'pn/detil_data',
        ];
        $this->load->view('index', $data);
    }

    /*
      Save the submitted record
    */
    public function store() //== digunakan (Checked 20240602)
    {
        if ($this->session->userdata('admin_valid') == FALSE && $this->session->userdata('email') == "") {
            redirect("login");
        }

        $active_satker=decrypt_url($this->session->userdata('active_satker'));
        $active_instansi=$this->pn->get_satker($active_satker);

        $this->form_validation->set_rules('tanggalsurat', 'Tanggal Surat', 'required');
        $this->form_validation->set_rules('nosurat', 'Nomor Surat', 'required');
        $this->form_validation->set_rules('jeniskegiatan', 'Jenis Kegiatan', 'required');

        if($active_instansi[0]->instansi_id=='1'){
        $this->form_validation->set_rules('penggugat', 'Penggugat', 'required');
        $this->form_validation->set_rules('tergugat', 'Tergugat', 'required');
        $this->form_validation->set_rules('turuttergugat', 'Turut Tergugat', 'required');
        }

        $this->form_validation->set_rules('perihal', 'Perihal', 'required');
        $this->form_validation->set_rules('objek', 'Objek', 'required');
        $this->form_validation->set_rules('keterangan', 'Nomor HAK beserta lokasi', 'required');
        $this->form_validation->set_rules('uraian', 'Uraian', 'required');
        $this->form_validation->set_rules('lampiran', 'Lampiran', 'callback_do_upload');

        if (!$this->form_validation->run()) {
            $this->session->set_flashdata('errors', validation_errors());
        } else {
            $insert_id=$this->pn->store();
            $this->session->set_flashdata('success', "Saved Successfully!");

            //== pengiriman pesan
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
            //== end of pengiriman pesan
        }
        redirect(base_url('Pn/satker/'.$this->input->post('enc_satker_tujuan').'/'.$this->input->post('enc_satker_asal')));
    }

    public function store_permintaan($id) //== digunakan (Checked 20240602)
    {
        if ($this->session->userdata('admin_valid') == FALSE && $this->session->userdata('email') == "") {
            redirect("login");
        }

        $this->form_validation->set_rules('judul', 'Judul', 'required');
        $this->form_validation->set_rules('keterangan_pn', 'Keterangan', 'required');
        $this->form_validation->set_rules('lampiran_pn', 'Lampiran', 'callback_do_upload_lampiran');

        if (!$this->form_validation->run()) {
            $this->session->set_flashdata('errors', validation_errors());
        } else {
            $this->pn->store_permintaan($id);
            $this->session->set_flashdata('success', "Saved Successfully!");

            //== pengiriman pesan
            $id_kasus=decrypt_url($id);
            $active_satker=decrypt_url($this->session->userdata('active_satker'));

            $status_penerima=$this->pn->get_status_penerima_pesan($id_kasus,$active_satker);
            $status_penerima=$status_penerima[0]->statusnya;

            $get_penerimapesan=$this->pn->get_penerima_pesan($id_kasus,$status_penerima);
            $jum_penerimapesan=$get_penerimapesan->num_rows();
            if($jum_penerimapesan>0){
                foreach($get_penerimapesan->result() as $penerimapesan){
                    $pesan="Bapak/Ibu ".$penerimapesan->nama.".";
                    $pesan.="\n\nTerdapat _*Dokumen Masuk*_ baru untuk data SINTA nomor ".$penerimapesan->nosurat.".";

                    $phone=$penerimapesan->no_hp;
                    $this->kirimpesan($pesan,$phone);            
                }
            }
            //== end of pengiriman pesan
        }
        redirect(base_url('Pn/show/' . $id));
    }

    // public function store_seksi($id)
    // {
    //     if ($this->session->userdata('admin_valid') == FALSE && $this->session->userdata('email') == "") {
    //         redirect("login");
    //     }

    //     $this->form_validation->set_rules('keterangan_seksi', 'Keterangan Seksi', 'required');
    //     $this->form_validation->set_rules('lampiran_seksi', 'lampiran', 'callback_do_upload_pn');

    //     if (!$this->form_validation->run()) {
    //         $this->session->set_flashdata('errors', validation_errors());
    //     } else {
    //         $this->kasus->store_seksi($id);
    //         $this->session->set_flashdata('success', "Saved Successfully!");
    //     }
    //     redirect(base_url('kasus/show/' . $id));
    // }

    // public function store_pn($id)
    // {
    //     if ($this->session->userdata('admin_valid') == FALSE && $this->session->userdata('email') == "") {
    //         redirect("login");
    //     }

    //     $this->form_validation->set_rules('keterangan_pn', 'Keterangan PN', 'required');
    //     $this->form_validation->set_rules('lampiran_pn', 'lampiran', 'callback_do_upload_pn');

    //     if (!$this->form_validation->run()) {
    //         $this->session->set_flashdata('errors', validation_errors());
    //     } else {
    //         $this->pn->store_pn($id);
    //         $this->session->set_flashdata('success', "Saved Successfully!");
    //     }
    //     redirect(base_url('pn/show/' . $id));
    // }

    // public function store_kajian($id)
    // {
    //     if ($this->session->userdata('admin_valid') == FALSE && $this->session->userdata('email') == "") {
    //         redirect("login");
    //     }

    //     $this->form_validation->set_rules('isi_kajian', 'Isi Kajian', 'required');

    //     if (!$this->form_validation->run()) {
    //         $this->session->set_flashdata('errors', validation_errors());
    //     } else {
    //         $this->kasus->store_kajian($id);
    //         $this->session->set_flashdata('success', "Saved Successfully!");
    //     }
    //     redirect(base_url('kasus/show/' . $id));
    // }

    // public function store_rekomendasi($id)
    // {
    //     if ($this->session->userdata('admin_valid') == FALSE && $this->session->userdata('email') == "") {
    //         redirect("login");
    //     }

    //     $this->form_validation->set_rules('isi_rekomendasi', 'Isi Rekomendasi', 'required');

    //     if (!$this->form_validation->run()) {
    //         $this->session->set_flashdata('errors', validation_errors());
    //     } else {
    //         $this->kasus->store_rekomendasi($id);
    //         $this->session->set_flashdata('success', "Saved Successfully!");
    //     }
    //     redirect(base_url('kasus/show/' . $id));
    // }

    /*
        Upload File
    */
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

    public function do_upload_seksi()
    {
        if ($_FILES['lampiran_seksi']['size'] != 0) {
            $upload_dir = 'resources/lampiran/seksi';
            if (!is_dir($upload_dir)) {
                mkdir($upload_dir);
            }
            $config['upload_path']   = $upload_dir;
            $config['allowed_types'] = 'pdf';
            $config['file_name']     = 'file_lampiran_seksi_' . substr(md5(rand()), 0, 9);
            $config['overwrite']     = false;
            $config['max_size']  = '10240';

            $this->load->library('upload', $config);
            if (!$this->upload->do_upload('lampiran_seksi')) {
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
        if ($_FILES['lampiran_pn']['size'] != 0) {
            // $upload_dir = 'resources/lampiran/pn';
            $upload_dir = 'resources/lampiran/sinergi_data/lampiran';
            if (!is_dir($upload_dir)) {
                mkdir($upload_dir);
            }
            $config['upload_path']   = $upload_dir;
            $config['allowed_types'] = 'pdf';
            $config['file_name']     = 'file_lampiran_pn_' . substr(md5(rand()), 0, 9);
            $config['overwrite']     = false;
            $config['max_size']  = '10240';

            $this->load->library('upload', $config);
            if (!$this->upload->do_upload('lampiran_pn')) {
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

    /*
      Update the submitted record
    */
    public function update($id)
    {
        if ($this->session->userdata('admin_valid') == FALSE && $this->session->userdata('email') == "") {
            redirect("login");
        }

        $this->form_validation->set_rules('jeniskasus', 'Jenis Kasus', 'required');
        $this->form_validation->set_rules('tanggalsurat', 'Tanggal Surat', 'required');
        $this->form_validation->set_rules('nosurat', 'Nomor Surat', 'required');
        $this->form_validation->set_rules('instansi', 'Instansi', 'required');
        $this->form_validation->set_rules('pihak', 'Para Pihak', 'required');
        $this->form_validation->set_rules('perihal', 'Perihal', 'required');
        $this->form_validation->set_rules('objek', 'Objek', 'required');
        /* $this->form_validation->set_rules('kota', 'Kota', 'required');
        $this->form_validation->set_rules('kelurahan', 'Kota', 'required');
        $this->form_validation->set_rules('nohak', 'No. Hak', 'required'); */
        $this->form_validation->set_rules('keterangan', 'Keterangan', 'required');
        $this->form_validation->set_rules('uraian', 'Uraian', 'required');

        if (!$this->form_validation->run()) {
            $this->session->set_flashdata('errors', validation_errors());
        } else {
            $this->kasus->update(decrypt_url($id));
            $this->session->set_flashdata('success', "Updated Successfully!");
        }
        redirect(base_url('kasus/show/' . $id));
    }

    public function update_link($id)
    {
        if ($this->session->userdata('admin_valid') == FALSE && $this->session->userdata('email') == "") {
            redirect("login");
        }

        $this->form_validation->set_rules('linksipp', 'Link SIPP', 'required');

        if (!$this->form_validation->run()) {
            $this->session->set_flashdata('errors', validation_errors());
        } else {
            $this->pn->update_link(decrypt_url($id));
            $this->session->set_flashdata('success', "Updated Successfully!");
        }
        redirect(base_url('Pn/show/' . $id));
    }

    public function update_kajian($id, $id_awal)
    {
        if ($this->session->userdata('admin_valid') == FALSE && $this->session->userdata('email') == "") {
            redirect("login");
        }

        $this->form_validation->set_rules('isi_kajian', 'Isi Kajian', 'required');

        if (!$this->form_validation->run()) {
            $this->session->set_flashdata('errors', validation_errors());
        } else {
            $this->kasus->update_kajian(decrypt_url($id));
            $this->session->set_flashdata('success', "Updated Successfully!");
        }
        redirect(base_url('kasus/show/' . $id_awal));
    }

    public function update_rekomendasi($id, $id_awal)
    {
        if ($this->session->userdata('admin_valid') == FALSE && $this->session->userdata('email') == "") {
            redirect("login");
        }

        $this->form_validation->set_rules('isi_rekomendasi', 'Isi Rekomendasi', 'required');

        if (!$this->form_validation->run()) {
            $this->session->set_flashdata('errors', validation_errors());
        } else {
            $this->kasus->update_rekomendasi(decrypt_url($id));
            $this->session->set_flashdata('success', "Updated Successfully!");
        }
        redirect(base_url('kasus/show/' . $id_awal));
    }

    /*
    Delete a record
    */
    public function delete($id)
    {
        if ($this->session->userdata('admin_valid') == FALSE && $this->session->userdata('email') == "") {
            redirect("login");
        }
        $this->pn->delete(decrypt_url($id));
        $this->session->set_flashdata('success', "Deleted Successfully!");
        redirect(base_url('Pn'));
    }

    public function delete_seksi($id, $id_awal)
    {
        if ($this->session->userdata('admin_valid') == FALSE && $this->session->userdata('email') == "") {
            redirect("login");
        }
        $this->kasus->delete_seksi(decrypt_url($id));
        $this->session->set_flashdata('success', "Deleted Successfully!");
        redirect(base_url('kasus/show/' . $id_awal));
    }

    public function delete_kajian($id, $id_awal)
    {
        if ($this->session->userdata('admin_valid') == FALSE && $this->session->userdata('email') == "") {
            redirect("login");
        }
        $this->kasus->delete_kajian(decrypt_url($id));
        $this->session->set_flashdata('success', "Deleted Successfully!");
        redirect(base_url('kasus/show/' . $id_awal));
    }

    public function delete_rekomendasi($id, $id_awal)
    {
        if ($this->session->userdata('admin_valid') == FALSE && $this->session->userdata('email') == "") {
            redirect("login");
        }
        $this->kasus->delete_rekomendasi(decrypt_url($id));
        $this->session->set_flashdata('success', "Deleted Successfully!");
        redirect(base_url('kasus/show/' . $id_awal));
    }

    function kirimpesan($pesannya,$nocell){
        date_default_timezone_set("Asia/Jakarta");  
        $h = date('G');
        if($h>=5 && $h<11)
        { $salam="Selamat Pagi"; }
        else if($h>=11 && $h<=15)
        { $salam="Selamat Siang"; }
        else
        { $salam="Selamat Sore"; }
        
        $nama_pegirim=$this->session->userdata('nama');
        $jabatan_pengirim=$this->session->userdata('jabatan');
        $satker_pengirim=$this->session->userdata('satker');

        $pesannya=$salam." ".$pesannya;
        $pesannya.="\n\nPengirim :\n".$nama_pegirim.",\n".ucwords(strtolower($jabatan_pengirim))." ".$satker_pengirim."\n\nTerima Kasih.";


        $data = array(
		    'pesannya' => $pesannya,
		    'nocell' => $nocell
		);
        $curl=curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_PORT => "80",
            CURLOPT_URL => $this->config->item('messenger_wa'),
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => json_encode($data),
          ));      
        curl_exec($curl);

        //== jika tidak bisa kirim WA, enable 3 baris di bawah ini untuk melihat ada masalah apa
        // echo var_dump(curl_getinfo($curl)) . '<br/>';
        // echo curl_errno($curl) . '<br/>';
        // echo curl_error($curl) . '<br/>';
        //== end of jika tidak bisa...

        curl_close($curl);
        return true;
    }
}
