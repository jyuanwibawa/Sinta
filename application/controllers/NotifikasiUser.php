<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class NotifikasiUser extends CI_Controller {

    public function __construct() {
        parent::__construct();

        if (!$this->session->userdata('user_id')) {
            redirect('loginuser');
        }

        $this->load->model('Model_notifikasi');
        $this->load->database();
    }

    public function index() {

        $user_id = $this->session->userdata('user_id');

        $tugas = $this->db->query("
            SELECT id_pengerjaan, tugas, created_at
            FROM pengerjaan
            WHERE id_user = ?
            ORDER BY created_at DESC
        ", [$user_id])->result();

        if (!empty($tugas)) {
            foreach ($tugas as $t) {

                $pesan = 'Tugas tambahan: ' . $t->tugas;

                // Cek apakah notifikasi untuk tugas ini sudah ada
                $cek = $this->db
                    ->where('user_id', $user_id)
                    ->where('id_pengerjaan', $t->id_pengerjaan)
                    ->get('notifikasi')
                    ->num_rows();

                // Jika belum ada → buat notifikasi
                if ($cek == 0) {

                    $dataNotif = [
                        'user_id'        => $user_id,
                        'id_pengerjaan'  => $t->id_pengerjaan,
                        'pesan'          => $pesan,
                        'status'         => 'belum dibaca',
                        'created_at'     => date('Y-m-d H:i:s')
                    ];

                    $this->db->insert('notifikasi', $dataNotif);
                }
            }
        }

        // mendapatkan data untuk di tampilkan pada notifikasi
        $data['notifikasi']   = $this->Model_notifikasi->get_by_user($user_id);
        $data['total_unread'] = $this->Model_notifikasi->count_unread_by_user($user_id);

        $this->load->view('dashboard_ob/notifikasi', $data);
    }

    public function mark_all_read()
    {
        $user_id = $this->session->userdata('user_id');
        $this->Model_notifikasi->mark_all_as_read($user_id);
        redirect('NotifikasiUser');
    }
}
