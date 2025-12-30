<?php 
class Model_pb extends CI_Model
{
    public function count_pb()
    {
        $data = $this->db->query("SELECT * FROM konsultasi")-> num_rows();
        return $data;
    }
    
    public function get_all($satker_tujuan_id=NULL,$satker_asal_id=NULL) 
    {
        $addwhere="";
        if($satker_tujuan_id){
            $addwhere="WHERE satker_id_tujuan='".$satker_tujuan_id."' AND satker_id_asal='".$satker_asal_id."'";
        }
        $konsul = $this->db->query("SELECT *,
                                        (SELECT COUNT(*) FROM permintaan_data_pb pdb WHERE pdb.id_konsultasi=ks.id_konsultasi) AS jumrespon,
                                        (SELECT isi_pesan FROM pesan_pb psb WHERE psb.id_konsultasi = ks.id_konsultasi ORDER BY psb.id_pesan DESC LIMIT 1) AS pesan_terakhir
                                    FROM konsultasi ks
                                    LEFT JOIN jenisperkara jp ON ks.id_jperkara=jp.id_jperkara
                                    LEFT JOIN subjenisperkara sjp ON ks.id_sjperkara=sjp.id_sjperkara
                                    LEFT JOIN klasifikasi kls ON ks.id_klasifikasi=kls.id_klasifikasi
                                    LEFT JOIN jenislayanan jl ON ks.id_jlayanan=jl.id_jlayanan
                                    LEFT JOIN kategori kt ON ks.id_kategori=kt.id_kategori
                                    LEFT JOIN advokat adv ON ks.id_advokat=adv.id_advokat
                                    LEFT JOIN adref_satker_instansi asi1 ON asi1.satker_id=ks.satker_id_asal
                                    LEFT JOIN adref_satker_instansi asi2 ON asi2.satker_id=ks.satker_id_tujuan
                                    ".$addwhere."
                                    ORDER BY ks.id_konsultasi DESC")->result();
        return $konsul;
    }

    public function get_list_jperkara()
    {
        $data = $this->db->get('jenisperkara')->result();
        return $data;
    }

    public function get_list_sjperkara($id_jperkara) 
    {
        $data = $this->db->get_where('subjenisperkara', ['id_jperkara' => $id_jperkara])->result();
        return $data;
    }
    
    public function get_list_klasifikasi($id_sjperkara) 
    {
        $data = $this->db->get_where('klasifikasi', ['id_sjperkara' => $id_sjperkara])->result();
        return $data;
    }

    public function get_list_advokat()
    {
        $data = $this->db->get('advokat')->result();
        return $data;
    }

    public function get_list_jlayanan() 
    {
        $data = $this->db->get('jenislayanan')->result();
        return $data;
    }

    public function get_list_kategori() 
    {
        $data = $this->db->get('kategori')->result();
        return $data;
    }

    /*
        Store the record in the database
    */

    public function store($data) 
    {
        $data = [
            'tanggalkonsul' => $this->input->post('tanggalkonsultasi'),
            'nama' => $this->input->post('nama'),
            'usia' => $this->input->post('usia'),
            'jkelamin' => $this->input->post('jeniskelamin'),
            'alamat' => $this->input->post('alamat'),
            'pekerjaan' => $this->input->post('perkerjaan'),
            'id_jperkara' => $this->input->post('jenisperkara'),
            'id_sjperkara' => $this->input->post('subjenisperkara'),
            'id_klasifikasi' => $this->input->post('klasifikasi'),
            'id_jlayanan' => $this->input->post('jenislayanan'),
            'id_kategori' => $this->input->post('penerimalayanan'),
            'permasalahan' => $this->input->post('permasalahan'),
            'uraian' => $this->input->post('solusi'),
            'id_advokat' => $this->input->post('advokat'),
            'durasi_layanan' => $this->input->post('durasi_layanan'),
            'user_id' => $this->session->userdata('user_id'),
            'lampiran' => $data,
            'satker_id_asal' => decrypt_url($this->input->post('enc_satker_asal')),
            'satker_id_tujuan' => decrypt_url($this->input->post('enc_satker_tujuan'))
        ];

        $result = $this->db->insert('konsultasi', $data);
        // return $result;
        $insert_id=$this->db->insert_id();
        return $insert_id;
    }

    public function update($id, $merged_file= null)
    {
        $data = [
            'tanggalkonsul' => $this->input->post('tanggalkonsultasi'),
            'nama' => $this->input->post('nama'),
            'usia' => $this->input->post('usia'),
            'jkelamin' => $this->input->post('jeniskelamin'),
            'alamat' => $this->input->post('alamat'),
            'pekerjaan' => $this->input->post('perkerjaan'),
            'id_jperkara' => $this->input->post('jenisperkara'),
            'id_sjperkara' => $this->input->post('subjenisperkara'),
            'id_klasifikasi' => $this->input->post('klasifikasi'),
            'id_jlayanan' => $this->input->post('jenislayanan'),
            'id_kategori' => $this->input->post('penerimalayanan'),
            'permasalahan' => $this->input->post('permasalahan'),
            'uraian' => $this->input->post('solusi'),
            'id_advokat' => $this->input->post('advokat'),
            'durasi_layanan' => $this->input->post('durasi_layanan'),
            // 'lampiran' => $this->upload->data('file_name'),
            'updated_at' => date('Y-m-d H:i:s')
        ];

        // if($merged_file){
        //     $data['lampiran'] = $merged_file;
        // }

        if ($merged_file !== null) {
            $data['lampiran'] = $merged_file; // Update lampiran jika ada file baru
        }

        $result = $this->db->where('id_konsultasi', $id)->update('konsultasi', $data);
        return $result;
    }

    public function get($id)
    {
        $konsul = $this->db->query("SELECT ks.*,
                                    ks.nama AS nama_konsultasi,
                                    jp.jperkara, sjp.sjperkara, kls.klasifikasi, jl.jlayanan, kt.kategori, adv.nama_advokat,
                                    u.nama AS nama_user FROM konsultasi ks
                                    LEFT JOIN jenisperkara jp ON ks.`id_jperkara`=jp.`id_jperkara`
                                    LEFT JOIN subjenisperkara sjp ON ks.`id_sjperkara`=sjp.`id_sjperkara`
                                    LEFT JOIN klasifikasi kls ON ks.`id_klasifikasi`=kls.`id_klasifikasi`
                                    LEFT JOIN jenislayanan jl ON ks.`id_jlayanan`=jl.`id_jlayanan`
                                    LEFT JOIN kategori kt ON ks.`id_kategori`=kt.`id_kategori`
                                    LEFT JOIN advokat adv ON ks.`id_advokat`=adv.`id_advokat`
                                    LEFT JOIN user u ON ks.`user_id` =u.`user_id`
                                    WHERE ks.id_konsultasi =" . $id)->row();
        return $konsul;
    }
    /*
        Destroy or Remove a record in the database
    */

    public function get_permintaan($id) //== digunakan (Checked 20240603)
    {
        $seksi = $this->db->query("SELECT pdb.id_permintaan,
                                            pdb.judul,
                                            pdb.keterangan AS keterangan_dok,
                                            pdb.lampiran AS lampiran_dok,
                                            pdb.created_at AS created_at_dok,
                                            ks.*,u.*,aj.*,asi.* FROM `permintaan_data_pb` AS pdb
        LEFT JOIN konsultasi AS ks ON ks.`id_konsultasi`=pdb.`id_konsultasi`
        LEFT JOIN user AS u ON u.`user_id`=pdb.`user_id`
        LEFT JOIN adref_jabatan aj ON aj.jabatan_id=u.jabatan_id
        LEFT JOIN adref_satker_instansi asi ON asi.satker_id=u.satker_id
        WHERE pdb.`id_konsultasi`=" . decrypt_url($id) . " ORDER BY id_permintaan ASC")->result();
        return $seksi;
    }


    public function store_permintaan($id) //== digunakan (Checked 20240602)
    {
        $data = [
            'judul' => $this->input->post('judul'),
            'id_konsultasi' => decrypt_url($id),
            'keterangan' => $this->input->post('keterangan_pb'),
            'user_id' => $this->session->userdata('user_id'),
            'lampiran' => $this->upload->data('file_name'),
        ];

        $result = $this->db->insert('permintaan_data_pb', $data);
        return $result;
    }

    public function delete($id)
    {
        // $this->db->delete('lampiran_pb', array('id_konsultasi' => $id));
        // $this->db->delete('permintaan_data_pb', array('id_konsultasi' => $id));
        $this->db->delete('pesan_pb', array('id_konsultasi' => $id));
        $this->db->delete('konsultasi', array('id_konsultasi' => $id));
    } 
}