<?php
class Model_pn extends CI_Model
{
    public function count_pn()
    {
        $data = $this->db->query("SELECT * FROM kasus_pn")->num_rows();
        return $data;
    }
    /*
        Get all the records from the database
    */
    public function get_all($satker_tujuan_id=NULL,$satker_asal_id=NULL) //== digunakan (Checked 20240602)
    {
        $addwhere="";
        if($satker_tujuan_id){
            $addwhere="WHERE satker_id_tujuan='".$satker_tujuan_id."' AND satker_id_asal='".$satker_asal_id."'";
        }
        $kasus = $this->db->query("SELECT *,
                                        asi1.nama_satker AS satker_asal, 
                                        asi2.nama_satker AS satker_tujuan,
                                        (SELECT COUNT(*) FROM permintaan_data pd WHERE pd.id_kasus=kp.id_kasus) AS jumrespon
                                    FROM kasus_pn kp
                                    LEFT JOIN adref_kegiatan keg ON kp.id_kegiatan=keg.id_kegiatan
                                    LEFT JOIN objek o ON kp.id_objek=o.id_objek
                                    LEFT JOIN adref_satker_instansi asi1 ON asi1.satker_id=kp.satker_id_asal
                                    LEFT JOIN adref_satker_instansi asi2 ON asi2.satker_id=kp.satker_id_tujuan
                                    ".$addwhere."
                                    ORDER BY kp.id_kasus DESC")->result();
        return $kasus;
    }

    // public function pemeriksaan()
    // {
    //     $kasus = $this->db->query("SELECT * FROM `kasus_pn`
    //     JOIN `kegiatan_pn` ON
    //     `kasus_pn`.`id_kegiatan`=`kegiatan_pn`.`id_kegiatan`
    //     JOIN objek ON
    //     `kasus_pn`.`id_objek`=objek.`id_objek`
    //     where `kegiatan_pn`.`id_kegiatan`=1
    //     ORDER BY id_kasus DESC")->result();
    //     return $kasus;
    // }

    // public function konstatering()
    // {
    //     $kasus = $this->db->query("SELECT * FROM `kasus_pn`
    //     JOIN `kegiatan_pn` ON
    //     `kasus_pn`.`id_kegiatan`=`kegiatan_pn`.`id_kegiatan`
    //     JOIN objek ON
    //     `kasus_pn`.`id_objek`=objek.`id_objek`
    //     where `kegiatan_pn`.`id_kegiatan`=2
    //     ORDER BY id_kasus DESC")->result();
    //     return $kasus;
    // }

    // public function sita()
    // {
    //     $kasus = $this->db->query("SELECT * FROM `kasus_pn`
    //     JOIN `kegiatan_pn` ON
    //     `kasus_pn`.`id_kegiatan`=`kegiatan_pn`.`id_kegiatan`
    //     JOIN objek ON
    //     `kasus_pn`.`id_objek`=objek.`id_objek`
    //     where `kegiatan_pn`.`id_kegiatan`=3
    //     ORDER BY id_kasus DESC")->result();
    //     return $kasus;
    // }

    // public function lainnya()
    // {
    //     $kasus = $this->db->query("SELECT * FROM `kasus_pn`
    //     JOIN `kegiatan_pn` ON
    //     `kasus_pn`.`id_kegiatan`=`kegiatan_pn`.`id_kegiatan`
    //     JOIN objek ON
    //     `kasus_pn`.`id_objek`=objek.`id_objek`
    //     where `kegiatan_pn`.`id_kegiatan`=5
    //     ORDER BY id_kasus DESC")->result();
    //     return $kasus;
    // }

    // public function skpt()
    // {
    //     $kasus = $this->db->query("SELECT * FROM `kasus_pn`
    //     JOIN `kegiatan_pn` ON
    //     `kasus_pn`.`id_kegiatan`=`kegiatan_pn`.`id_kegiatan`
    //     JOIN objek ON
    //     `kasus_pn`.`id_objek`=objek.`id_objek`
    //     where `kegiatan_pn`.`id_kegiatan`=4
    //     ORDER BY id_kasus DESC")->result();
    //     return $kasus;
    // }

    // public function sidang()
    // {
    //     $kasus = $this->db->query("SELECT * FROM `kasus_pn`
    //     JOIN `kegiatan_pn` ON
    //     `kasus_pn`.`id_kegiatan`=`kegiatan_pn`.`id_kegiatan`
    //     JOIN objek ON
    //     `kasus_pn`.`id_objek`=objek.`id_objek`
    //     where `kegiatan_pn`.`id_kegiatan`=5
    //     ORDER BY id_kasus DESC")->result();
    //     return $kasus;
    // }


    public function get_list_jeniskegiatan() //== digunakan (Checked 20240602)
    {
        $data = $this->db->query("SELECT * FROM adref_kegiatan ORDER BY `id_kegiatan` ASC")->result();
        return $data;
    }

    public function get_list_objek() //== digunakan (Checked 20240602)
    {
        $data = $this->db->get('objek')->result();
        return $data;
    }

    public function get_list_seksi()
    {
        $data = $this->db->get('seksi')->result();
        return $data;
    }

    public function get_list_jkajian()
    {
        $data = $this->db->get('jeniskajian')->result();
        return $data;
    }

    /*
        Store the record in the database
    */
    public function store() //== digunakan (Checked 20240602)
    {
        $data = [
            'tanggalsurat' => $this->input->post('tanggalsurat'),
            'nosurat' => $this->input->post('nosurat'),
            'id_kegiatan' => $this->input->post('jeniskegiatan'),
            'tergugat' => $this->input->post('tergugat'),
            'turuttergugat' => $this->input->post('turuttergugat'),
            'penggugat' => $this->input->post('penggugat'),
            'perihal' => $this->input->post('perihal'),
            'id_objek' => $this->input->post('objek'),
            'keterangan' => $this->input->post('keterangan'),
            'uraian' => $this->input->post('uraian'),
            'user_id' => $this->session->userdata('user_id'),
            'lampiran' => $this->upload->data('file_name'),
            'satker_id_asal' => decrypt_url($this->input->post('enc_satker_asal')),
            'satker_id_tujuan' => decrypt_url($this->input->post('enc_satker_tujuan'))
        ];

        $result = $this->db->insert('kasus_pn', $data);
        // return $result;
        $insert_id=$this->db->insert_id();
        return $insert_id;
    }

    public function store_permintaan($id) //== digunakan (Checked 20240602)
    {
        $data = [
            'judul' => $this->input->post('judul'),
            'id_kasus' => decrypt_url($id),
            'keterangan' => $this->input->post('keterangan_pn'),
            'user_id' => $this->session->userdata('user_id'),
            'lampiran' => $this->upload->data('file_name'),
        ];

        $result = $this->db->insert('permintaan_data', $data);
        return $result;
    }

    public function store_seksi($id)
    {
        $data = [
            'id_seksi' => $this->session->userdata('seksi'),
            'id_kasus' => decrypt_url($id),
            'keterangan_lampiran' => $this->input->post('keterangan_seksi'),
            'user_id' => $this->session->userdata('user_id'),
            'lampiran' => $this->upload->data('file_name'),
        ];

        $result = $this->db->insert('lampiran_seksi', $data);
        return $result;
    }

    public function store_pn($id)
    {
        $data = [
            'id_seksi' => $this->session->userdata('seksi'),
            'id_kasus' => decrypt_url($id),
            'keterangan_lampiran' => $this->input->post('keterangan_pn'),
            'user_id' => $this->session->userdata('user_id'),
            'lampiran' => $this->upload->data('file_name'),
        ];

        $result = $this->db->insert('lampiran_pn', $data);
        return $result;
    }

    public function store_kajian($id)
    {
        $data = [
            'id_jkajian' => $this->session->userdata('bagian'),
            'id_kasus' => decrypt_url($id),
            'isi_kajian' => $this->input->post('isi_kajian'),
            'user_id' => $this->session->userdata('user_id'),
        ];

        $result = $this->db->insert('kajian', $data);
        return $result;
    }

    public function store_rekomendasi($id)
    {
        $data = [
            'id_kasus' => decrypt_url($id),
            'id_user' => $this->session->userdata('user_id'),
            'isi_rekomendasi' => $this->input->post('isi_rekomendasi'),
            'user_id' => $this->session->userdata('user_id'),
        ];

        $result = $this->db->insert('rekomendasi', $data);
        return $result;
    }

    /*
        Get an specific record from the database
    */
    public function get($id)
    {
        $kasus = $this->db->query("SELECT kp.*,
                                            keg.jeniskegiatan,
                                            o.objek,
                                            u.nama FROM kasus_pn kp
                                    INNER JOIN objek o ON kp.`id_objek`=o.`id_objek`
                                    INNER JOIN adref_kegiatan keg ON kp.`id_kegiatan`=keg.`id_kegiatan`
                                    LEFT JOIN user u ON u.user_id=kp.user_id
                                    WHERE kp.id_kasus =" . $id)->row();
        return $kasus;
    }

    public function get_permintaan($id) //== digunakan (Checked 20240603)
    {
        $seksi = $this->db->query("SELECT pd.id_permintaan,
                                            pd.judul,
                                            pd.keterangan AS keterangan_dok,
                                            pd.lampiran AS lampiran_dok,
                                            pd.created_at AS created_at_dok,
                                            kp.*,u.*,aj.*,asi.* FROM `permintaan_data` AS pd
        LEFT JOIN kasus_pn AS kp ON kp.`id_kasus`=pd.`id_kasus`
        LEFT JOIN user AS u ON u.`user_id`=pd.`user_id`
        LEFT JOIN adref_jabatan aj ON aj.jabatan_id=u.jabatan_id
        LEFT JOIN adref_satker_instansi asi ON asi.satker_id=u.satker_id
        WHERE pd.`id_kasus`=" . decrypt_url($id) . " ORDER BY id_permintaan ASC")->result();
        return $seksi;
    }

    public function get_seksi($id)
    {
        $seksi = $this->db->query("SELECT lampiran_pn.user_id, lampiran_pn.id_kasus, lampiran_pn.id_lampiran, seksi, keterangan_lampiran, lampiran_pn.created_at, lampiran_pn.lampiran FROM `lampiran_pn`
        JOIN kasus_pn ON
        lampiran_pn.`id_kasus`=kasus_pn.`id_kasus`
        JOIN seksi ON
        seksi.`id_seksi`=`lampiran_pn`.`id_seksi`
        WHERE `lampiran_pn`.`id_kasus`=" . decrypt_url($id) . " ORDER BY seksi ASC")->result();
        return $seksi;
    }

    public function get_kajian($id)
    {
        $seksi = $this->db->query("SELECT kajian.user_id, kajian.id_kasus, id_kajian, jkajian, isi_kajian, kajian.created_at FROM kajian
        JOIN kasus ON
        kajian.`id_kasus`=kasus.`id_kasus`
        JOIN jeniskajian ON
        kajian.id_jkajian=jeniskajian.id_jkajian
        WHERE kajian.id_kasus=" . decrypt_url($id))->result();
        return $seksi;
    }

    public function get_kajian_1($id)
    {
        $seksi = $this->db->query("SELECT * from kajian
        WHERE kajian.id_kajian=" . $id)->row();
        return $seksi;
    }

    public function get_rekomendasi($id)
    {
        $seksi = $this->db->query("SELECT * FROM rekomendasi
        JOIN user ON
        rekomendasi.`id_user`=user.`user_id`
        JOIN kasus ON
        rekomendasi.`id_kasus`=kasus.`id_kasus`
        WHERE kasus.id_kasus=" . decrypt_url($id))->result();
        return $seksi;
    }


    /*
        Update or Modify a record in the database
    */
    public function update($id)
    {
        $data = [
            'id_kegiatan' => $this->input->post('jeniskegiatan'),
            'tanggalsurat' => $this->input->post('tanggalsurat'),
            'nosurat' => $this->input->post('nosurat'),
            'instansi' => $this->input->post('instansi'),
            'pihak' => $this->input->post('pihak'),
            'perihal' => $this->input->post('perihal'),
            'id_objek' => $this->input->post('objek'),
            'kota' => $this->input->post('kota'),
            'kelurahan' => $this->input->post('kelurahan'),
            'nohak' => $this->input->post('nohak'),
            'uraian' => $this->input->post('uraian'),
            'user_id' => $this->session->userdata('user_id'),
        ];

        $result = $this->db->where('id_kasus', $id)->update('kasus', $data);
        return $result;
    }

    public function update_link($id)
    {
        $data = [
            'link' => $this->input->post('linksipp'),
        ];

        $result = $this->db->where('id_kasus', $id)->update('kasus_pn', $data);
        return $result;
    }

    public function update_kajian($id)
    {
        $data = [
            'isi_kajian' => $this->input->post('isi_kajian'),
            'user_id' => $this->session->userdata('user_id'),
        ];

        $result = $this->db->where('id_kajian', $id)->update('kajian', $data);
        return $result;
    }

    public function update_rekomendasi($id)
    {
        $data = [
            'isi_rekomendasi' => $this->input->post('isi_rekomendasi'),
            'user_id' => $this->session->userdata('user_id'),
        ];

        $result = $this->db->where('id_rekomendasi', $id)->update('rekomendasi', $data);
        return $result;
    }

    /*
        Destroy or Remove a record in the database
    */
    public function delete($id)
    {
        $this->db->delete('lampiran_pn', array('id_kasus' => $id));
        $this->db->delete('kasus_pn', array('id_kasus' => $id));
    }

    public function delete_seksi($id)
    {
        $result = $this->db->delete('lampiran_seksi', array('id_lampiran' => $id));
        return $result;
    }

    public function delete_kajian($id)
    {
        $result = $this->db->delete('kajian', array('id_kajian' => $id));
        return $result;
    }

    public function delete_rekomendasi($id)
    {
        $result = $this->db->delete('rekomendasi', array('id_rekomendasi' => $id));
        return $result;
    }

    //=== adityo
    public function get_satker($satker_id=NULL)
    {
        if($satker_id){
            $this->db->where('satker_id', $satker_id);
        }
        $data = $this->db->get('adref_satker_instansi')->result();
        return $data;
    }

    public function get_penerima_pesan($id_kasus=NULL,$status_penerima=NULL){
        if($status_penerima=='1'){
            $tujuannya="kp.satker_id_asal";
        }else{
            $tujuannya="kp.satker_id_tujuan";
        }
        $qry="SELECT kp.nosurat,
                    u.nama,
                    u.no_hp
                FROM kasus_pn kp
                LEFT JOIN adref_satker_instansi asi ON asi.satker_id=".$tujuannya."
                LEFT JOIN user u ON u.satker_id=asi.satker_id
                WHERE kp.id_kasus='".$id_kasus."';";
        $query=$this->db->query($qry);
        return $query;

    }

    public function get_status_penerima_pesan($id_kasus=NULL,$active_satker=NULL){
        $qry="SELECT COUNT(*) AS statusnya
                FROM kasus_pn kp 
                WHERE kp.id_kasus='".$id_kasus."'
                    AND kp.satker_id_tujuan='".$active_satker."';";
        $query=$this->db->query($qry)->result();
        return $query;
    }

    public function get_satker_aplikasi($satker_id=NULL,$kegiatan_id=NULL)
    {
        if($satker_id){
            $this->db->where('satker_id', $satker_id);
        }
        if($kegiatan_id){
            $this->db->like('id_kegiatan', $kegiatan_id);
        }
        $data = $this->db->get('adref_satker_aplikasi');
        return $data;
    }
}
