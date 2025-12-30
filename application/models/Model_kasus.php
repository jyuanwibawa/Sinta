<?php
class Model_kasus extends CI_Model
{
    public function count_bpn()
    {
        $data = $this->db->query("SELECT * FROM kasus")->num_rows();
        return $data;
    }
    /*
        Get all the records from the database
    */
    public function get_all()
    {
        $kasus = $this->db->query("SELECT * FROM kasus
        JOIN `jeniskasus` ON
        kasus.`id_jeniskasus`=`jeniskasus`.`id_jeniskasus`
        JOIN objek ON
        kasus.`id_objek`=objek.`id_objek`
        order by id_kasus DESC")->result();
        return $kasus;
    }

    public function pidana()
    {
        $kasus = $this->db->query("SELECT * FROM kasus
        JOIN `jeniskasus` ON
        kasus.`id_jeniskasus`=`jeniskasus`.`id_jeniskasus`
        JOIN objek ON
        kasus.`id_objek`=objek.`id_objek`
        where jeniskasus='Pidana'
        order by id_kasus DESC")->result();
        return $kasus;
    }

    public function perdata()
    {
        $kasus = $this->db->query("SELECT * FROM kasus
        JOIN `jeniskasus` ON
        kasus.`id_jeniskasus`=`jeniskasus`.`id_jeniskasus`
        JOIN objek ON
        kasus.`id_objek`=objek.`id_objek`
        where jeniskasus='Perdata'
        order by id_kasus DESC")->result();
        return $kasus;
    }

    public function ptun()
    {
        $kasus = $this->db->query("SELECT * FROM kasus
        JOIN `jeniskasus` ON
        kasus.`id_jeniskasus`=`jeniskasus`.`id_jeniskasus`
        JOIN objek ON
        kasus.`id_objek`=objek.`id_objek`
        where jeniskasus='ptun'
        order by id_kasus DESC")->result();
        return $kasus;
    }

    public function dumas()
    {
        $kasus = $this->db->query("SELECT * FROM kasus
        JOIN `jeniskasus` ON
        kasus.`id_jeniskasus`=`jeniskasus`.`id_jeniskasus`
        JOIN objek ON
        kasus.`id_objek`=objek.`id_objek`
        where jeniskasus='Pengaduan Masyarakat'
        order by id_kasus DESC")->result();
        return $kasus;
    }

    public function get_list_jeniskasus()
    {
        $data = $this->db->get('jeniskasus')->result();
        return $data;
    }

    public function get_list_objek()
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
    public function store()
    {
        $data = [
            'id_jeniskasus' => $this->input->post('jeniskasus'),
            'tanggalsurat' => $this->input->post('tanggalsurat'),
            'nosurat' => $this->input->post('nosurat'),
            'instansi' => $this->input->post('instansi'),
            'pihak' => $this->input->post('pihak'),
            'perihal' => $this->input->post('perihal'),
            'id_objek' => $this->input->post('objek'),
            /* 'kota' => $this->input->post('kota'),
            'kelurahan' => $this->input->post('kelurahan'),
            'nohak' => $this->input->post('nohak'), */
            'keterangan' => $this->input->post('keterangan'),
            'uraian' => $this->input->post('uraian'),
            'u_id' => $this->session->userdata('u_id'),
            'lampiran' => $this->upload->data('file_name'),
        ];

        $result = $this->db->insert('kasus', $data);
        return $result;
    }

    public function store_seksi($id)
    {
        $data = [
            'id_seksi' => $this->session->userdata('seksi'),
            'id_kasus' => decrypt_url($id),
            'keterangan_lampiran' => $this->input->post('keterangan_seksi'),
            'u_id' => $this->session->userdata('u_id'),
            'lampiran' => $this->upload->data('file_name'),
        ];

        $result = $this->db->insert('lampiran_seksi', $data);
        return $result;
    }

    public function store_kajian($id)
    {
        $data = [
            'id_jkajian' => $this->session->userdata('bagian'),
            'id_kasus' => decrypt_url($id),
            'isi_kajian' => $this->input->post('isi_kajian'),
            'u_id' => $this->session->userdata('u_id'),
        ];

        $result = $this->db->insert('kajian', $data);
        return $result;
    }

    public function store_rekomendasi($id)
    {
        $data = [
            'id_kasus' => decrypt_url($id),
            'id_user' => $this->session->userdata('u_id'),
            'isi_rekomendasi' => $this->input->post('isi_rekomendasi'),
            'u_id' => $this->session->userdata('u_id'),
        ];

        $result = $this->db->insert('rekomendasi', $data);
        return $result;
    }

    /*
        Get an specific record from the database
    */
    public function get($id)
    {
        $kasus = $this->db->query("SELECT * FROM kasus
        INNER JOIN objek ON
        kasus.`id_objek`=objek.`id_objek`
        INNER JOIN jeniskasus ON
        kasus.`id_jeniskasus`=jeniskasus.`id_jeniskasus`
        WHERE kasus.id_kasus =" . $id)->row();
        return $kasus;
    }

    public function get_seksi($id)
    {
        $seksi = $this->db->query("SELECT lampiran_seksi.u_id, lampiran_seksi.id_kasus, lampiran_seksi.id_lampiran, seksi, keterangan_lampiran, lampiran_seksi.created_at, lampiran_seksi.lampiran FROM `lampiran_seksi`
        JOIN kasus ON
        lampiran_seksi.`id_kasus`=kasus.`id_kasus`
        JOIN seksi ON
        seksi.`id_seksi`=`lampiran_seksi`.`id_seksi`
        WHERE `lampiran_seksi`.`id_kasus`=" . decrypt_url($id) . " ORDER BY seksi ASC")->result();
        return $seksi;
    }

    public function get_kajian($id)
    {
        $seksi = $this->db->query("SELECT kajian.u_id, kajian.id_kasus, id_kajian, jkajian, isi_kajian, kajian.created_at FROM kajian
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
        rekomendasi.`id_user`=user.`u_id`
        JOIN kasus ON
        rekomendasi.`id_kasus`=kasus.`id_kasus`
        JOIN seksi ON user.seksi=seksi.`id_seksi`
        WHERE kasus.id_kasus=" . decrypt_url($id))->result();
        return $seksi;
    }


    /*
        Update or Modify a record in the database
    */
    public function update($id)
    {
        $data = [
            'id_jeniskasus' => $this->input->post('jeniskasus'),
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
            'u_id' => $this->session->userdata('u_id'),
        ];

        $result = $this->db->where('id_kasus', $id)->update('kasus', $data);
        return $result;
    }

    public function update_link($id)
    {
        $data = [
            'link' => $this->input->post('linksipp'),
        ];

        $result = $this->db->where('id_kasus', $id)->update('kasus', $data);
        return $result;
    }

    public function update_kajian($id)
    {
        $data = [
            'isi_kajian' => $this->input->post('isi_kajian'),
            'u_id' => $this->session->userdata('u_id'),
        ];

        $result = $this->db->where('id_kajian', $id)->update('kajian', $data);
        return $result;
    }

    public function update_rekomendasi($id)
    {
        $data = [
            'isi_rekomendasi' => $this->input->post('isi_rekomendasi'),
            'u_id' => $this->session->userdata('u_id'),
        ];

        $result = $this->db->where('id_rekomendasi', $id)->update('rekomendasi', $data);
        return $result;
    }

    /*
        Destroy or Remove a record in the database
    */
    public function delete($id)
    {
        $this->db->delete('rekomendasi', array('id_kasus' => $id));
        $this->db->delete('kajian', array('id_kasus' => $id));
        $this->db->delete('lampiran_seksi', array('id_kasus' => $id));
        $this->db->delete('kasus', array('id_kasus' => $id));
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
}
