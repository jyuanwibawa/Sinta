<?php
class Model_permintaan_pb extends CI_Model
{
    /*
        Count DB
    */
    public function count_permintaandata()
    {
        $data = $this->db->query("SELECT * FROM permintaan_data_pb")->num_rows();
        return $data;
    }
    /*
        Get all the records from the database
    */
    public function get($id) //== digunakan (Checked 20240603)
    {
        $konsul = $this->db->query("SELECT pdb.user_id,nama, pdb.id_konsultasi, pdb.`id_permintaan`, pdb.`judul`, pdb.`keterangan`, pdb.`lampiran`, pdb.`created_at`, asi.nama_satker
                                    FROM permintaan_data_pb AS pdb 
                                    JOIN konsultasi AS ks ON ks.`id_konsultasi` = pdb.`id_konsultasi`
                                    JOIN user as u ON u.user_id = pdb.user_id
                                    LEFT JOIN adref_satker_instansi asi ON asi.satker_id=u.satker_id
                                    WHERE pdb.`id_permintaan`=" . $id)->row();  
        return $konsul;
    }

    public function get_pesan($id) //== digunakan (Checked 20240603)
    {
        // $kasus = $this->db->query("SELECT nama, p.`created_at`, isi_pesan 
        //                                 FROM pesan AS p
        //                             JOIN `permintaan_data` AS pd ON pd.`id_permintaan` = p.`id_permintaan`
        //                             JOIN user AS u ON u.`user_id` = p.`user_id`
        //                             WHERE p.id_permintaan = " . $id . " order by id_pesan DESC")->result();
        $konsul = $this->db->query("SELECT pp.*, u.nama AS nama_user, pp.`created_at`, pp.isi_pesan 
                                        FROM pesan_pb AS pp
                                    JOIN user AS u ON u.`user_id` = pp.`user_id`
                                    WHERE pp.id_konsultasi = " . $id . " order by id_pesan DESC")->result();
        return $konsul;
    }

    public function get_lampiran($id)
    {
        $konsul = $this->db->query("SELECT lp.user_id,lp.id_lampiran, lp.lampiran, lp.`nama_file`, u.`nama`, lp.`created_at`
                                        FROM lampiran_pesan AS lp
                                    JOIN `permintaan_data_pb` AS pdb ON pdb.`id_permintaan` = lp.`id_permintaan`
                                    JOIN user AS u ON u.`user_id` = lp.`user_id`
                                    WHERE lp.id_permintaan = " . $id . " ORDER BY id_lampiran ASC")->result();
        return $konsul;
    }

    public function store_pesan($id) //== digunakan (Checked 20240606)
    {
        $data = [
            'isi_pesan' => $this->input->post('pesan'),
            'id_konsultasi' => $id,
            'user_id' => $this->session->userdata('user_id'),
        ];

        $result = $this->db->insert('pesan_pb', $data);
        return $result;
    }

    // public function store_lampiran_pesan($id)
    // {
    //     $data = [
    //         'nama_file' => $this->input->post('nama'),
    //         'id_permintaan' => $id,
    //         'lampiran' => $this->upload->data('file_name'),
    //         'user_id' => $this->session->userdata('user_id'),
    //     ];

    //     $result = $this->db->insert('lampiran_pesan', $data);
    //     return $result;
    // }

    public function delete($id)
    {
        $this->db->delete('lampiran_pesan', array('id_lampiran' => $id));
    }
}
