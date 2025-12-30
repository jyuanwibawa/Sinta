<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Permintaan_data extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->library('session');
        $this->load->model('Model_pn', 'pn');
        $this->load->model('Model_permintaan', 'mp');
        // $this->load->library($this->config->item('messenger_wa'));
    }

    /*
    Display all records in page
    */
    public function show($id)
    {
        if ($this->session->userdata('admin_valid') == FALSE && $this->session->userdata('email') == "") {
            redirect("login");
        }

        $data = [
            'show' => $this->mp->get(decrypt_url($id)),
            'get_pesan' => $this->mp->get_pesan(decrypt_url($id)),
            'get_lampiran' => $this->mp->get_lampiran(decrypt_url($id)),
            'title' => '',
            'page' => 'pn/permintaan_data',
        ];
        $this->load->view('index', $data);
    }

    public function store_pesan($id) //== digunakan (Checked 20240606)
    {
        if ($this->session->userdata('admin_valid') == FALSE && $this->session->userdata('email') == "") {
            redirect("login");
        }

        $this->form_validation->set_rules('pesan', 'Pesan', 'required');

        if (!$this->form_validation->run()) {
            $this->session->set_flashdata('errors', validation_errors());
        } else {
            $this->mp->store_pesan(decrypt_url($id));
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
                    $pesan.="\n\nTerdapat _*Pesan Masuk*_ baru untuk data SINTA nomor ".$penerimapesan->nosurat.".";

                    $phone=$penerimapesan->no_hp;
                    $this->kirimpesan($pesan,$phone);            
                }
            }
            //== end of pengiriman pesan
        }
        redirect(base_url('pn/show/' . $id));
    }

    public function store_lampiran_pesan($id)
    {
        if ($this->session->userdata('admin_valid') == FALSE && $this->session->userdata('email') == "") {
            redirect("login");
        }

        $this->form_validation->set_rules('nama', 'Nama File', 'required');
        $this->form_validation->set_rules('lampiran', 'Lampiran', 'callback_do_upload');

        if (!$this->form_validation->run()) {
            $this->session->set_flashdata('errors', validation_errors());
        } else {
            $this->mp->store_lampiran_pesan(decrypt_url($id));
            $this->session->set_flashdata('success', "Saved Successfully!");
        }
        redirect(base_url('Permintaan_data/show/' . $id));
    }

    public function do_upload()
    {
        if ($_FILES['lampiran']['size'] != 0) {
            $upload_dir = 'resources/lampiran/permintaan_data';
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

    public function delete($id, $home)
    {
        if ($this->session->userdata('admin_valid') == FALSE && $this->session->userdata('email') == "") {
            redirect("login");
        }
        $this->mp->delete(decrypt_url($id));
        $this->session->set_flashdata('success', "Deleted Successfully!");
        redirect(base_url('Permintaan_data/show/' . $home));
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
