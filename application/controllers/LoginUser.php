<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class LoginUser extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Model_user', 'u');
        $this->load->helper('security');
        $this->load->library('form_validation');

        // PENTING: Pastikan file application/models/Model_activity_log.php BENAR-BENAR ADA.
        // Jika file ini tidak ada, halaman akan BLANK PUTIH (Error 500).
        $this->load->model('Model_activity_log');
    }

    public function index()
    {
        /**
         * ===== TAMBAHAN =====
         * /loginuser?force=1  -> tampil login walau sudah login (untuk ganti akun)
         * /loginuser?logout=1 -> logout lalu tampil login
         */
        $force  = (int)$this->input->get('force', true);
        $doLogout = (int)$this->input->get('logout', true);

        if ($doLogout === 1) {
            // panggil logout
            $this->logout();
            return;
        }

        // Kalau sudah login, arahkan sesuai kategori user (TU / OB / user biasa)
        if ($this->session->userdata('user_logged_in') && $force !== 1) {

            if ((int)$this->session->userdata('is_tu') === 1) {
                redirect('dashboardtu');
            }

            // OB atau user biasa
            redirect('dashboard_user');
        }

        $data['title'] = 'Login User';

        // PERBAIKAN DI SINI: Memanggil file di folder login_user/index.php
        $this->load->view('login_user/index', $data);
    }

    public function proses()
    {
        $email = $this->input->post('email');
        $password = $this->input->post('password');

        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        $this->form_validation->set_rules('password', 'Password', 'required');

        if ($this->form_validation->run() == FALSE) {
            // Cek apakah model log terload sebelum memanggil methodnya
            if(isset($this->Model_activity_log)) {
                $this->Model_activity_log->add(
                    'LOGIN_FAIL',
                    'login_user',
                    'Validasi form gagal. Email input: ' . $this->input->post('email', TRUE)
                );
            }

            $this->session->set_flashdata('error', 'Email dan password harus diisi dengan benar');
            redirect('loginuser');
        }

        // Enkripsi password dengan MD5 seperti sistem kamu
        $encrypted_password = md5($password);
        $cek = $this->u->cek($email, $encrypted_password);

        if ($cek->num_rows() > 0) {
            $row = $cek->row();

            // Cek Role (User = 1)
            if ($row->role != '1') {

                if(isset($this->Model_activity_log)) {
                    $this->Model_activity_log->add(
                        'ACCESS_DENIED',
                        'login_user',
                        'Akses ditolak (role bukan user). Email: ' . $email . ' | role: ' . $row->role
                    );
                }

                $this->session->set_flashdata('error', 'Akses ditolak! Halaman ini hanya untuk role user.');
                redirect('loginuser');
            }

            // Cek Aktivasi
            if ($row->aktivasi != 1) {

                if(isset($this->Model_activity_log)) {
                    $this->Model_activity_log->add(
                        'ACCESS_DENIED',
                        'login_user',
                        'Akun tidak aktif. Email: ' . $email . ' | aktivasi: ' . $row->aktivasi
                    );
                }

                $this->session->set_flashdata('error', 'Akun Anda tidak aktif. Silakan hubungi administrator.');
                redirect('loginuser');
            }

            /**
             * ==========================================================
             * DETEKSI TU & OB
             * Prioritas: deteksi via jabatan_id (paling akurat),
             * fallback: deteksi via role_text (kalau di DB ada "TU"/"Kasubag TU"/"OB")
             * ==========================================================
             */

            // >>> WAJIB kamu sesuaikan sesuai data jabatan_id di DB <<<
            $TU_JABATAN_IDS = [12, 13]; // contoh: isi dengan jabatan_id TU/Kasubag TU
            $OB_JABATAN_IDS = [20, 21]; // contoh: isi dengan jabatan_id OB

            $jabatan_id = (int)($row->jabatan_id ?? 0);
            $role_text_db = strtolower(trim((string)($row->role_text ?? '')));

            // deteksi TU
            $is_tu = in_array($jabatan_id, $TU_JABATAN_IDS) ? 1 : 0;
            if ($is_tu === 0 && $role_text_db !== '') {
                if (strpos($role_text_db, 'tu') !== false) {
                    $is_tu = 1;
                }
            }

            // deteksi OB
            $is_ob = in_array($jabatan_id, $OB_JABATAN_IDS) ? 1 : 0;
            if ($is_ob === 0 && $role_text_db !== '') {
                if (strpos($role_text_db, 'ob') !== false || strpos($role_text_db, 'office boy') !== false) {
                    $is_ob = 1;
                }
            }

            // prioritas TU (biar tidak bentrok)
            if ($is_tu === 1) {
                $is_ob = 0;
            }

            // role_text untuk session/log
            if (!empty($row->role_text)) {
                $role_text = $row->role_text;
            } else if ($is_tu === 1) {
                $role_text = 'TU';
            } else if ($is_ob === 1) {
                $role_text = 'OB';
            } else {
                $role_text = 'USER';
            }

            // Set Session
            $sess_data = array(
                'user_logged_in' => TRUE,
                'user_id'     => $row->user_id,
                'email'       => $row->email,
                'nama'        => $row->nama,
                'role'        => $row->role,
                'role_text'   => $role_text,
                'satker_id'   => $row->satker_id,
                'jabatan_id'  => $row->jabatan_id,

                // tambahan flags
                'is_tu'       => $is_tu,
                'is_ob'       => $is_ob,

                'login_time'  => date('Y-m-d H:i:s')
            );
            $this->session->set_userdata($sess_data);

            // Update waktu login
            $this->u->do_waktu_daftar($row->user_id);

            // log login sukses
            if(isset($this->Model_activity_log)) {
                $this->Model_activity_log->add(
                    'LOGIN',
                    'login_user',
                    'Login ' . $role_text . ' berhasil. User: ' . $row->nama . ' | Email: ' . $row->email .
                    ' | jabatan_id: ' . $row->jabatan_id . ' | satker_id: ' . $row->satker_id
                );
            }

            $this->session->set_flashdata('success', 'Selamat datang, ' . $row->nama . '!');

            // Redirect sesuai kategori
            if ($is_tu === 1) {
                redirect('dashboardtu');
            }

            redirect('dashboard_user');

        } else {
            if(isset($this->Model_activity_log)) {
                $this->Model_activity_log->add(
                    'LOGIN_FAIL',
                    'login_user',
                    'Login gagal (email/password salah). Email: ' . $email
                );
            }

            $this->session->set_flashdata('error', 'Email atau password salah!');
            redirect('loginuser');
        }
    }

    public function logout()
    {
        $nama  = $this->session->userdata('nama');
        $email = $this->session->userdata('email');
        $role_text = $this->session->userdata('role_text');

        if($email && isset($this->Model_activity_log)) {
            $this->Model_activity_log->add(
                'LOGOUT',
                'login_user',
                'Logout ' . ($role_text ? $role_text : 'USER') . '. User: ' . $nama . ' | Email: ' . $email
            );
        }

        // Bersihkan userdata agar benar-benar tidak kebaca login lagi
        $this->session->unset_userdata([
            'user_logged_in', 'user_id', 'email', 'nama', 'role', 'role_text',
            'satker_id', 'jabatan_id', 'is_tu', 'is_ob', 'login_time'
        ]);

        $this->session->sess_destroy();
        redirect('loginuser');
    }
}
