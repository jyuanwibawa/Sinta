<?php

class Model_user extends CI_Model
{
    public function count_user()
    {
        $data = $this->db->query("SELECT * FROM user")->num_rows();
        return $data;
    }

    private $table = "user";

    //=== function yang digunakan ===
    function cek($email, $password)
    {
        // $this->db->where("email", $email);
        // $this->db->where("u_paswd", $password);
        // return $this->db->get("user");
        $sql="SELECT u.*,
                    asi.nama_satker,
                    asi.logo,
                    aj.nama_jabatan
                FROM user u 
                LEFT JOIN adref_satker_instansi asi ON asi.satker_id=u.satker_id
                LEFT JOIN adref_jabatan aj ON aj.jabatan_id=u.jabatan_id
                WHERE u.email='".$email."' AND u.u_paswd='".$password."';";
        return $this->db->query($sql);
    }
    //=== end of function yang digunakan ===

    function semua()
    {
        return $this->db->query("SELECT nama, s.`seksi`, b.`jkajian` as bagian, aktivasi, email, u_id FROM user AS u
        JOIN `seksi` AS s ON
        u.`seksi` = s.`id_seksi`
        JOIN jeniskajian AS b ON
        u.`bagian` = b.`id_jkajian`
        ORDER BY u_id ASC")->result();
    }

    function get($id)
    {
        return $this->db->query("SELECT nama, s.`seksi`, b.`jkajian` as bagian, aktivasi, email, u_id, role_text as role, images, u.seksi as id_seksi, u.bagian as id_bagian, u_paswd AS pass, u_pin AS pin
        FROM user AS u
        JOIN `seksi` AS s ON
        u.`seksi` = s.`id_seksi`
        JOIN jeniskajian AS b ON
        u.`bagian` = b.`id_jkajian` where u_id=" . $id . "
        ORDER BY u_id ASC")->row();
    }

    function daftar($data)
    {
        $this->db->insert("user", $data);
    }

    function file_identitas($data)
    {
        $nama   =    $this->input->post('nama');
        $email  =    $this->input->post('email');
        $no_hp  =    $this->input->post('telepon');
        $up_data        = $this->upload->data();
        $this->db->query("INSERT INTO user (nama,images,email,no_hp,file_identitas,waktu_daftar) VALUES ( '$nama','user.jpg','$email','$no_hp','" . mysql_real_escape_string($up_data['file_name']) . "',now())");
    }

    function upload($data)
    {
        $this->upload->do_upload('file_identitas');
    }

    function cekKode($kode)
    {
        $this->db->where("email", $kode);
        return $this->db->get("user");
    }

    function cekId($kode)
    {
        $this->db->where("u_id", $kode);
        return $this->db->get("user");
    }

    function getLoginData($usr, $psw)
    {
        $u = mysql_real_escape_string($usr);
        $p = md5(mysql_real_escape_string($psw));
        $q_cek_login = $this->db->get_where('user', array('email' => $u, 'password' => $p));
        if (count($q_cek_login->result()) > 0) {
            foreach ($q_cek_login->result() as $qck) {
                foreach ($q_cek_login->result() as $qad) {
                    $sess_data['logged_in'] = 'EQUALIZR sedang Login';
                    $sess_data['u_id'] = $qad->u_id;
                    $sess_data['email'] = $qad->email;
                    $sess_data['nama'] = $qad->nama;
                    $sess_data['group'] = $qad->group;
                    $sess_data['rid'] = $qad->rid;
                    $sess_data['images'] = $qad->images;
                    $sess_data['aktivasi'] = $qad->aktivasi;
                    $this->session->set_userdata($sess_data);
                }
                redirect('login');
            }
        } else {
            $this->session->set_flashdata('result_login', '<br>username atau Password yang anda masukkan salah.');
            header('location:' . base_url() . 'login');
        }
    }

    function do_waktu_daftar($id)
    {

        return $this->db->query("UPDATE user SET waktu_daftar=now() WHERE u_id = '$id'");
    }

    function update($id)
    {
        $data = [
            'nama' => $this->input->post('nama'),
            'email' => $this->input->post('email'),
            'seksi' => $this->input->post('seksi'),
            'bagian' => $this->input->post('bagian'),
            'aktivasi' => $this->input->post('aktivasi'),
            'u_paswd' => md5($this->input->post('password')),
            'u_pin' => encrypt_url(md5($this->input->post('pin'))),
        ];

        $result = $this->db->where('u_id', $id)->update('user', $data);
        return $result;
    }

    function simpan($info)
    {
        $this->db->insert("user", $info);
    }

    function hapus($kode)
    {
        $this->db->where("u_id", $kode);
        $this->db->delete("user");
    }

    public function get_satker($satker_id=NULL)
    {
        if($satker_id){
            $this->db->where('satker_id', $satker_id);
        }
        $data = $this->db->get('adref_satker_instansi')->result();
        return $data;
    }
}
