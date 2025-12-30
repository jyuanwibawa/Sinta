<?php
class Model_permintaan extends CI_Model
{
    /*
        Count DB
    */
    public function count_permintaandata()
    {
        $data = $this->db->query("SELECT * FROM permintaan_data")->num_rows();
        return $data;
    }
    /*
        Get all the records from the database
    */
    public function get($id) //== digunakan (Checked 20240603)
    {
        $kasus = $this->db->query("SELECT pd.user_id,nama, pd.id_kasus, pd.`id_permintaan`, pd.`judul`, pd.`keterangan`, pd.`lampiran`, pd.`created_at`, asi.nama_satker
                                    FROM permintaan_data AS pd 
                                    JOIN kasus_pn AS kp ON kp.`id_kasus` = pd.`id_kasus`
                                    JOIN user as u ON u.user_id = pd.user_id
                                    LEFT JOIN adref_satker_instansi asi ON asi.satker_id=u.satker_id
                                    WHERE pd.`id_permintaan`=" . $id)->row();  
        return $kasus;
    }

    public function get_pesan($id) //== digunakan (Checked 20240603)
    {
        // $kasus = $this->db->query("SELECT nama, p.`created_at`, isi_pesan 
        //                                 FROM pesan AS p
        //                             JOIN `permintaan_data` AS pd ON pd.`id_permintaan` = p.`id_permintaan`
        //                             JOIN user AS u ON u.`user_id` = p.`user_id`
        //                             WHERE p.id_permintaan = " . $id . " order by id_pesan DESC")->result();
        $kasus = $this->db->query("SELECT nama, p.`created_at`, isi_pesan 
                                        FROM pesan AS p
                                    JOIN user AS u ON u.`user_id` = p.`user_id`
                                    WHERE p.id_kasus = " . $id . " order by id_pesan DESC")->result();
        return $kasus;
    }

    public function get_lampiran($id)
    {
        $kasus = $this->db->query("SELECT lp.user_id,lp.id_lampiran, lp.lampiran, lp.`nama_file`, u.`nama`, lp.`created_at`
                                        FROM lampiran_pesan AS lp
                                    JOIN `permintaan_data` AS pd ON pd.`id_permintaan` = lp.`id_permintaan`
                                    JOIN user AS u ON u.`user_id` = lp.`user_id`
                                    WHERE lp.id_permintaan = " . $id . " ORDER BY id_lampiran ASC")->result();
        return $kasus;
    }

    public function store_pesan($id) //== digunakan (Checked 20240606)
    {
        $data = [
            'isi_pesan' => $this->input->post('pesan'),
            'id_kasus' => $id,
            'user_id' => $this->session->userdata('user_id'),
        ];

        $result = $this->db->insert('pesan', $data);
        return $result;
    }

    public function store_lampiran_pesan($id)
    {
        $data = [
            'nama_file' => $this->input->post('nama'),
            'id_permintaan' => $id,
            'lampiran' => $this->upload->data('file_name'),
            'user_id' => $this->session->userdata('user_id'),
        ];

        $result = $this->db->insert('lampiran_pesan', $data);
        return $result;
    }

    public function delete($id)
    {
        $this->db->delete('lampiran_pesan', array('id_lampiran' => $id));
    }
}
