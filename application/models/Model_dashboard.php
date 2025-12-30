<?php
class Model_dashboard extends CI_Model
{
    // public function get_satker($satker_id=NULL)
    // {
    //     if($satker_id){
    //         $this->db->where('satker_id', $satker_id);
    //     }
    //     $data = $this->db->get('adref_satker_instansi')->result();
    //     return $data;
    // }

    public function get_satker($active_satkerid=NULL){
        $addwhere="";
        $whereadd="";
        if($active_satkerid){
            $addwhere="AND kp.satker_id_asal=".$active_satkerid;
            $whereadd="AND kp.satker_id_tujuan=".$active_satkerid;
            $addwhere_pb="AND ks.satker_id_asal=".$active_satkerid;
            $whereadd_pb="AND ks.satker_id_tujuan=".$active_satkerid;
        }
        $qry="SELECT asi.*,asi.nama_satker,
                    (SELECT COUNT(*) FROM kasus_pn kp WHERE kp.satker_id_tujuan=asi.satker_id ".$addwhere.") AS jum_keluar,
                    (SELECT COUNT(DISTINCT(pd.id_kasus)) 
                        FROM permintaan_data pd 
                            LEFT JOIN kasus_pn kp ON kp.id_kasus=pd.id_kasus
                        WHERE kp.satker_id_tujuan=asi.satker_id ".$addwhere.") AS jum_keluar_responded,
                    (SELECT COUNT(*) FROM kasus_pn kp WHERE kp.satker_id_asal=asi.satker_id ".$whereadd.") AS jum_masuk,
                    (SELECT COUNT(DISTINCT(pd.id_kasus)) 
                        FROM permintaan_data pd 
                        LEFT JOIN kasus_pn kp ON kp.id_kasus=pd.id_kasus
                        WHERE kp.satker_id_asal=asi.satker_id ".$whereadd.") AS jum_masuk_responded,
                    (SELECT COUNT(*) FROM konsultasi ks WHERE ks.satker_id_tujuan=asi.satker_id ".$addwhere_pb.") AS jum_keluar_pb,
                    (SELECT COUNT(DISTINCT(pdb.id_konsultasi)) 
                        FROM permintaan_data_pb pdb
                            LEFT JOIN konsultasi ks ON ks.id_konsultasi=pdb.id_konsultasi
                        WHERE ks.satker_id_tujuan=asi.satker_id ".$addwhere_pb.") AS jum_keluar_responded_pb,
                    (SELECT COUNT(*) FROM konsultasi ks WHERE ks.satker_id_asal=asi.satker_id ".$whereadd_pb.") AS jum_masuk_pb,
                    (SELECT COUNT(DISTINCT(pdb.id_konsultasi)) 
                        FROM permintaan_data_pb pdb
                        LEFT JOIN konsultasi ks ON ks.id_konsultasi=pdb.id_konsultasi
                        WHERE ks.satker_id_asal=asi.satker_id ".$whereadd_pb.") AS jum_masuk_responded_pb
                FROM adref_satker_instansi asi;";
        $data = $this->db->query($qry)->result();
        return $data;
    }

    public function get_data_bulanan_pb_by_date($from_date, $to_date){
        $from_date = $this->db->escape($from_date);
        $to_date = $this->db->escape($to_date);

        $qry = $this->db->query("SELECT
                                        COUNT(*) AS jumlah_total,
                                        SUM(jkelamin = 'Laki-laki') AS jumlah_pengunjung_laki,
                                        SUM(jkelamin = 'Perempuan') AS jumlah_pengunjung_perempuan,
                                        SUM(id_kategori = 1) AS jumlah_masyarakat_biasa,
                                        SUM(id_kategori = 2) AS jumlah_masyarakat_kurang_mampu
                                        /* SUM(id_jlayanan = 1 AND id_jperkara = 1 AND id_sjperkara = 1) AS jumlah_konper_ijin_jual,
                                        SUM(id_jlayanan = 1 AND id_jperkara = 1 AND id_sjperkara = 2) AS jumlah_konper_perbaikan_akta_kelahiran,
                                        SUM(id_jlayanan = 1 AND id_jperkara = 1 AND id_sjperkara = 3) AS jumlah_konper_pencatatan_akta_kematian,
                                        SUM(id_jlayanan = 1 AND id_jperkara = 1 AND id_sjperkara = 4) AS jumlah_konper_pencatatan_perkawinan,
                                        SUM(id_jlayanan = 1 AND id_jperkara = 1 AND id_sjperkara = 5) AS jumlah_konper_perbaikan_biodata,
                                        SUM(id_jlayanan = 1 AND id_jperkara = 1 AND id_sjperkara = 6) AS jumlah_konper_pengesahan_anak,
                                        SUM(id_jlayanan = 1 AND id_jperkara = 1 AND id_sjperkara = 7) AS jumlah_konper_perwalian,
                                        SUM(id_jlayanan = 1 AND id_jperkara = 1 AND id_sjperkara = 8) AS jumlah_konper_lain,
                                        SUM(id_jlayanan = 1 AND id_jperkara = 2 AND id_sjperkara = 9) AS jumlah_kongug_cerai,
                                        SUM(id_jlayanan = 1 AND id_jperkara = 2 AND id_sjperkara = 10) AS jumlah_kongug_pembatalan_cerai,
                                        SUM(id_jlayanan = 1 AND id_jperkara = 2 AND id_sjperkara = 11) AS jumlah_kongug_pmh,
                                        SUM(id_jlayanan = 1 AND id_jperkara = 2 AND id_sjperkara = 12) AS jumlah_kongug_wanprestasi,
                                        SUM(id_jlayanan = 1 AND id_jperkara = 2 AND id_sjperkara = 13) AS jumlah_kongug_lain,
                                        SUM(id_jlayanan = 1 AND id_jperkara = 3 AND id_sjperkara = 14) AS jumlah_konpid_narkotika,
                                        SUM(id_jlayanan = 1 AND id_jperkara = 3 AND id_sjperkara = 15) AS jumlah_konpid_perlindungan_anak,
                                        SUM(id_jlayanan = 1 AND id_jperkara = 3 AND id_sjperkara = 16) AS jumlah_konpid_pembunuhan,
                                        SUM(id_jlayanan = 1 AND id_jperkara = 3 AND id_sjperkara = 17) AS jumlah_konpid_pencabulan,
                                        SUM(id_jlayanan = 1 AND id_jperkara = 3 AND id_sjperkara = 18) AS jumlah_konpid_penganiayaan,
                                        SUM(id_jlayanan = 1 AND id_jperkara = 3 AND id_sjperkara = 19) AS jumlah_konpid_tipikor,
                                        SUM(id_jlayanan = 1 AND id_jperkara = 3 AND id_sjperkara = 20) AS jumlah_konpid_lain,
                                        SUM(id_jlayanan = 2 AND id_jperkara = 1 AND id_sjperkara = 1) AS jumlah_draftper_ijin_jual,
                                        SUM(id_jlayanan = 2 AND id_jperkara = 1 AND id_sjperkara = 2) AS jumlah_draftper_perbaikan_akta_kelahiran,
                                        SUM(id_jlayanan = 2 AND id_jperkara = 1 AND id_sjperkara = 3) AS jumlah_draftper_pencatatan_akta_kematian,
                                        SUM(id_jlayanan = 2 AND id_jperkara = 1 AND id_sjperkara = 4) AS jumlah_draftper_pencatatan_perkawinan,
                                        SUM(id_jlayanan = 2 AND id_jperkara = 1 AND id_sjperkara = 5) AS jumlah_draftper_perbaikan_biodata,
                                        SUM(id_jlayanan = 2 AND id_jperkara = 1 AND id_sjperkara = 6) AS jumlah_draftper_pengesahan_anak,
                                        SUM(id_jlayanan = 2 AND id_jperkara = 1 AND id_sjperkara = 7) AS jumlah_draftper_perwalian,
                                        SUM(id_jlayanan = 2 AND id_jperkara = 1 AND id_sjperkara = 8) AS jumlah_draftper_lain,
                                        SUM(id_jlayanan = 2 AND id_jperkara = 2 AND id_sjperkara = 9) AS jumlah_draftgug_cerai,
                                        SUM(id_jlayanan = 2 AND id_jperkara = 2 AND id_sjperkara = 10) AS jumlah_draftgug_pembatalan_cerai,
                                        SUM(id_jlayanan = 2 AND id_jperkara = 2 AND id_sjperkara = 11) AS jumlah_draftgug_pmh,
                                        SUM(id_jlayanan = 2 AND id_jperkara = 2 AND id_sjperkara = 12) AS jumlah_draftgug_wanprestasi,
                                        SUM(id_jlayanan = 2 AND id_jperkara = 2 AND id_sjperkara = 13) AS jumlah_draftgug_lain,
                                        SUM(id_jlayanan = 2 AND id_jperkara = 3 AND id_sjperkara = 14) AS jumlah_draftpid_narkotika,
                                        SUM(id_jlayanan = 2 AND id_jperkara = 3 AND id_sjperkara = 15) AS jumlah_draftpid_perlindungan_anak,
                                        SUM(id_jlayanan = 2 AND id_jperkara = 3 AND id_sjperkara = 16) AS jumlah_draftpid_pembunuhan,
                                        SUM(id_jlayanan = 2 AND id_jperkara = 3 AND id_sjperkara = 17) AS jumlah_draftpid_pencabulan,
                                        SUM(id_jlayanan = 2 AND id_jperkara = 3 AND id_sjperkara = 18) AS jumlah_draftpid_penganiayaan,
                                        SUM(id_jlayanan = 2 AND id_jperkara = 3 AND id_sjperkara = 19) AS jumlah_draftpid_tipikor,
                                        SUM(id_jlayanan = 2 AND id_jperkara = 3 AND id_sjperkara = 20) AS jumlah_draftpid_lain */
                                    FROM konsultasi ks
                                    WHERE ks.tanggalkonsul BETWEEN ".$from_date." AND ".$to_date.";")->row();
        return $qry;
    }

    public function get_konsultasi($from_date, $to_date){
        $from_date = $this->db->escape($from_date);
        $to_date = $this->db->escape($to_date);

        $qry="SELECT ks.*, kl.klasifikasi, adv.nama_advokat, kt.kategori
                FROM konsultasi ks 
                LEFT JOIN klasifikasi kl ON kl.id_klasifikasi = ks.id_klasifikasi
                LEFT JOIN advokat adv ON adv.id_advokat = ks.id_advokat
                LEFT JOIN kategori kt ON kt.id_kategori = ks.id_kategori
                WHERE ks.tanggalkonsul BETWEEN ".$from_date." AND ".$to_date."
                GROUP BY ks.tanggalkonsul;";

        $data = $this->db->query($qry)->result();
        return $data;
    }

    public function get_jkelamin($from_date, $to_date){
        $from_date = $this->db->escape($from_date);
        $to_date = $this->db->escape($to_date);

        $qry="SELECT jkelamin, COUNT(*) AS count
                FROM konsultasi ks
                WHERE ks.tanggalkonsul BETWEEN ".$from_date." AND ".$to_date."
                GROUP BY jkelamin;";

        $data = $this->db->query($qry)->result();
        return $data;
    }

    public function get_kategori($from_date, $to_date){
        $from_date = $this->db->escape($from_date);
        $to_date = $this->db->escape($to_date);

        $qry="SELECT kg.kategori, COUNT(*) AS count
                FROM konsultasi ks
                LEFT JOIN kategori kg ON kg.id_kategori = ks.id_kategori
                WHERE ks.tanggalkonsul BETWEEN ".$from_date." AND ".$to_date."
                GROUP BY ks.id_kategori;";

        $data = $this->db->query($qry)->result();
        return $data;
    }

}