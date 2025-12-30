<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Kasus extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->library('session');
        $this->load->model('Model_kasus', 'kasus');
        if ($this->session->userdata('admin_valid') == FALSE && $this->session->userdata('email') == "") {
            redirect("login");
        } else if ($this->session->userdata('u_id') == "7") {
            redirect("404");
        }
    }

    /*
       Display all records in page
    */
    public function index()
    {
        if ($this->session->userdata('admin_valid') == FALSE && $this->session->userdata('email') == "") {
            redirect("login");
        } else if ($this->session->userdata('u_id') == "7") {
            redirect("404");
        }

        $data = [
            'all' => $this->kasus->get_all(),
            'get_list_jeniskasus' => $this->kasus->get_list_jeniskasus(),
            'get_list_objek' => $this->kasus->get_list_objek(),
            'title' => 'Semua Kasus',
            'page' => 'kasus/regis_data',
        ];
        $this->load->view('index', $data);
    }

    public function edit_kajian($id)
    {
        if ($this->session->userdata('admin_valid') == FALSE && $this->session->userdata('email') == "") {
            redirect("login");
        }

        $data = [
            'all' => $this->kasus->get_all(),
            'get_list_jeniskasus' => $this->kasus->get_list_jeniskasus(),
            'get_list_objek' => $this->kasus->get_list_objek(),
            'get_kajian' => $this->kasus->get_kajian_1($id),
            'title' => 'Edit Kajian',
            'page' => 'kasus/edit_kajian',
        ];
        $this->load->view('index', $data);
    }

    public function pidana()
    {
        if ($this->session->userdata('admin_valid') == FALSE && $this->session->userdata('email') == "") {
            redirect("login");
        }

        $data = [
            'all' => $this->kasus->pidana(),
            'get_list_jeniskasus' => $this->kasus->get_list_jeniskasus(),
            'get_list_objek' => $this->kasus->get_list_objek(),
            'title' => 'Pidana',
            'page' => 'kasus/regis_data',
        ];
        $this->load->view('index', $data);
    }

    public function perdata()
    {
        if ($this->session->userdata('admin_valid') == FALSE && $this->session->userdata('email') == "") {
            redirect("login");
        }

        $data = [
            'all' => $this->kasus->perdata(),
            'get_list_jeniskasus' => $this->kasus->get_list_jeniskasus(),
            'get_list_objek' => $this->kasus->get_list_objek(),
            'title' => 'Perdata',
            'page' => 'kasus/regis_data',
        ];
        $this->load->view('index', $data);
    }

    public function ptun()
    {
        if ($this->session->userdata('admin_valid') == FALSE && $this->session->userdata('email') == "") {
            redirect("login");
        }

        $data = [
            'all' => $this->kasus->ptun(),
            'get_list_jeniskasus' => $this->kasus->get_list_jeniskasus(),
            'get_list_objek' => $this->kasus->get_list_objek(),
            'title' => 'PTUN',
            'page' => 'kasus/regis_data',
        ];
        $this->load->view('index', $data);
    }

    public function dumas()
    {
        if ($this->session->userdata('admin_valid') == FALSE && $this->session->userdata('email') == "") {
            redirect("login");
        }

        $data = [
            'all' => $this->kasus->dumas(),
            'get_list_jeniskasus' => $this->kasus->get_list_jeniskasus(),
            'get_list_objek' => $this->kasus->get_list_objek(),
            'title' => 'Pengaduan Masyarakat',
            'page' => 'kasus/regis_data',
        ];
        $this->load->view('index', $data);
    }

    /*
   
      Display a record
    */
    public function show($id)
    {
        if ($this->session->userdata('admin_valid') == FALSE && $this->session->userdata('email') == "") {
            redirect("login");
        }

        $data = [
            'show' => $this->kasus->get(decrypt_url($id)),
            'get_seksi' => $this->kasus->get_seksi($id),
            'get_list_seksi' => $this->kasus->get_list_seksi(),
            'get_kajian' => $this->kasus->get_kajian($id),
            'get_list_jkajian' => $this->kasus->get_list_jkajian(),
            'get_list_jeniskasus' => $this->kasus->get_list_jeniskasus(),
            'get_list_objek' => $this->kasus->get_list_objek(),
            'get_rekomendasi' => $this->kasus->get_rekomendasi($id),
            'title' => 'Detil kasus',
            'page' => 'kasus/detil_data',
        ];
        $this->load->view('index', $data);
    }

    /*
      Save the submitted record
    */
    public function store()
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
        $this->form_validation->set_rules('objek', 'Objek', 'required');/* 
        $this->form_validation->set_rules('kota', 'Kota', 'required');
        $this->form_validation->set_rules('kelurahan', 'Kota', 'required');
        $this->form_validation->set_rules('nohak', 'No. Hak', 'required'); */
        $this->form_validation->set_rules('keterangan', 'Keterangan', 'required');
        $this->form_validation->set_rules('uraian', 'Uraian', 'required');
        $this->form_validation->set_rules('lampiran', 'Lampiran', 'callback_do_upload');

        if (!$this->form_validation->run()) {
            $this->session->set_flashdata('errors', validation_errors());
        } else {
            $this->kasus->store();
            $this->session->set_flashdata('success', "Saved Successfully!");
        }
        redirect(base_url('kasus'));
    }

    public function store_link($id)
    {
        if ($this->session->userdata('admin_valid') == FALSE && $this->session->userdata('email') == "") {
            redirect("login");
        }

        $this->form_validation->set_rules('linksipp', 'Link SIPP', 'required');

        if (!$this->form_validation->run()) {
            $this->session->set_flashdata('errors', validation_errors());
        } else {
            $this->kasus->store_link();
            $this->session->set_flashdata('success', "Saved Successfully!");
        }
        redirect(base_url('kasus/show/' . $id));
    }

    public function store_seksi($id)
    {
        if ($this->session->userdata('admin_valid') == FALSE && $this->session->userdata('email') == "") {
            redirect("login");
        }

        $this->form_validation->set_rules('keterangan_seksi', 'Keterangan Seksi', 'required');
        $this->form_validation->set_rules('lampiran_seksi', 'lampiran', 'callback_do_upload_seksi');

        if (!$this->form_validation->run()) {
            $this->session->set_flashdata('errors', validation_errors());
        } else {
            $this->kasus->store_seksi($id);
            $this->session->set_flashdata('success', "Saved Successfully!");
        }
        redirect(base_url('kasus/show/' . $id));
    }

    public function store_kajian($id)
    {
        if ($this->session->userdata('admin_valid') == FALSE && $this->session->userdata('email') == "") {
            redirect("login");
        }

        $this->form_validation->set_rules('isi_kajian', 'Isi Kajian', 'required');

        if (!$this->form_validation->run()) {
            $this->session->set_flashdata('errors', validation_errors());
        } else {
            $this->kasus->store_kajian($id);
            $this->session->set_flashdata('success', "Saved Successfully!");
        }
        redirect(base_url('kasus/show/' . $id));
    }

    public function store_rekomendasi($id)
    {
        if ($this->session->userdata('admin_valid') == FALSE && $this->session->userdata('email') == "") {
            redirect("login");
        }

        $this->form_validation->set_rules('isi_rekomendasi', 'Isi Rekomendasi', 'required');

        if (!$this->form_validation->run()) {
            $this->session->set_flashdata('errors', validation_errors());
        } else {
            $this->kasus->store_rekomendasi($id);
            $this->session->set_flashdata('success', "Saved Successfully!");
        }
        redirect(base_url('kasus/show/' . $id));
    }

    /*
        Upload File
    */
    public function do_upload()
    {
        if ($_FILES['lampiran']['size'] != 0) {
            $upload_dir = 'resources/lampiran/kasus';
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
            $this->kasus->update_link(decrypt_url($id));
            $this->session->set_flashdata('success', "Updated Successfully!");
        }
        redirect(base_url('kasus/show/' . $id));
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
        $this->kasus->delete(decrypt_url($id));
        $this->session->set_flashdata('success', "Deleted Successfully!");
        redirect(base_url('kasus'));
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
}
