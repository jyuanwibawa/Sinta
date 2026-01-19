<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_activity_log extends CI_Model {

  public function add($action, $module = null, $description = null) {
    $this->load->database();
    $this->load->library('session');

    $user_id = $this->session->userdata('user_id');
    $nama    = $this->session->userdata('nama');
    $email   = $this->session->userdata('email');
    $role    = $this->session->userdata('role');

    // flag user (TU/OB) dari LoginUser
    $is_tu = (int)$this->session->userdata('is_tu');
    $is_ob = (int)$this->session->userdata('is_ob');

    // fallback admin_* jika user_id kosong tapi admin_valid true
    if (empty($user_id) && $this->session->userdata('admin_valid') == TRUE) {
      $user_id = $this->session->userdata('admin_id');
      $nama    = $this->session->userdata('admin_nama');
      $email   = $this->session->userdata('admin_email');
      $role    = '0';
      $is_tu   = 0;
      $is_ob   = 0;
    }

    // normalisasi
    $action = strtoupper(trim((string)$action));
    $module = strtolower(trim((string)$module));
    if ($module === '') $module = 'app';

    // role label
    $role_label = 'guest';
    if (!empty($user_id)) {
      if ((string)$role === '0') {
        $role_label = 'Administrator';
      } else if ((string)$role === '1') {
        if ($is_tu === 1) $role_label = 'TU';
        else if ($is_ob === 1) $role_label = 'OB';
        else $role_label = 'User';
      } else {
        $role_label = (string)$role;
      }
    }

    // username
    $username = 'guest';
    if (!empty($user_id)) {
      if (!empty($nama) && !empty($email)) $username = $nama . ' (' . $email . ')';
      else if (!empty($nama)) $username = $nama;
      else if (!empty($email)) $username = $email;
      else $username = 'user#' . $user_id;
    }

    if ($description === null || $description === '') {
      $description = $action . ' on ' . $module;
    }

    $data = [
      'user_id'     => empty($user_id) ? null : $user_id,
      'username'    => $username,
      'role'        => $role_label,
      'action'      => $action,
      'module'      => $module,
      'description' => $description,
      'url'         => current_url(),
      'method'      => $this->input->method(TRUE),
      'ip_address'  => $this->input->ip_address(),
      'user_agent'  => $this->input->user_agent(),
      'created_at'  => date('Y-m-d H:i:s'),
    ];

    try {
      return $this->db->insert('activity_logs', $data);
    } catch (Throwable $e) {
      log_message('error', 'Model_activity_log add failed: '.$e->getMessage());
      return false;
    }
  }

  /**
   * ===== TAMBAHAN =====
   * Paksa insert log pakai identitas tertentu (untuk admin agar tidak guest)
   */
  public function add_as($user_id, $username, $role_label, $action, $module = null, $description = null) {
    $this->load->database();

    $action = strtoupper(trim((string)$action));
    $module = strtolower(trim((string)$module));
    if ($module === '') $module = 'app';

    if ($description === null || $description === '') {
      $description = $action . ' on ' . $module;
    }

    $data = [
      'user_id'     => empty($user_id) ? null : $user_id,
      'username'    => empty($username) ? 'guest' : $username,
      'role'        => empty($role_label) ? 'guest' : $role_label,
      'action'      => $action,
      'module'      => $module,
      'description' => $description,
      'url'         => current_url(),
      'method'      => $this->input->method(TRUE),
      'ip_address'  => $this->input->ip_address(),
      'user_agent'  => $this->input->user_agent(),
      'created_at'  => date('Y-m-d H:i:s'),
    ];

    try {
      return $this->db->insert('activity_logs', $data);
    } catch (Throwable $e) {
      log_message('error', 'Model_activity_log add_as failed: '.$e->getMessage());
      return false;
    }
  }

  public function get_all($filters = []) {
    $this->load->database();

    $this->db->from('activity_logs');

    if (!empty($filters['q'])) {
      $q = $filters['q'];
      $this->db->group_start()
        ->like('username', $q)
        ->or_like('action', $q)
        ->or_like('module', $q)
        ->or_like('description', $q)
      ->group_end();
    }

    if (!empty($filters['start'])) $this->db->where('created_at >=', $filters['start'].' 00:00:00');
    if (!empty($filters['end']))   $this->db->where('created_at <=', $filters['end'].' 23:59:59');
    if (!empty($filters['role']))  $this->db->where('role', $filters['role']);

    // ===== TAMBAHAN: filter status (normal/gagal/warning) =====
    if (!empty($filters['status'])) {
      $status = strtolower(trim((string)$filters['status']));

      if ($status === 'normal') {
        $this->db->where_in('action', ['LOGIN','OPEN_PAGE','LOGOUT','AJAX_CALL','VERIFY','SUCCESS']);
      } else if ($status === 'gagal') {
        $this->db->where_in('action', ['LOGIN_FAIL','ACCESS_DENIED','NOT_FOUND','ERROR','FAIL']);
      } else if ($status === 'warning') {
        $this->db->where_in('action', ['WARNING','PERLU_PERBAIKAN','SUSPICIOUS']);
      }
    }

    $limit = !empty($filters['limit']) ? (int)$filters['limit'] : 500;
    $this->db->order_by('created_at', 'DESC');
    $this->db->limit($limit);

    try {
      return $this->db->get()->result();
    } catch (Throwable $e) {
      log_message('error', 'Model_activity_log get_all failed: '.$e->getMessage());
      return [];
    }
  }
}
