<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Model_activity_log extends CI_Model {

  public function add($action, $module = null, $description = null) {
    $this->load->database();
    $this->load->library('session');

    $user_id = $this->session->userdata('user_id');
    $nama    = $this->session->userdata('nama');
    $email   = $this->session->userdata('email');
    $role    = $this->session->userdata('role');

    // Label role (sesuaikan dengan sistem kamu: 0 admin, 1 user)
    $role_label = 'guest';
    if (!empty($user_id)) {
      if ((string)$role === '0') $role_label = 'Administrator';
      else if ((string)$role === '1') $role_label = 'User';
      else $role_label = (string)$role;
    }

    $data = [
      'user_id'    => empty($user_id) ? null : $user_id,
      'username'   => empty($user_id) ? 'guest' : ($nama ?: $email),
      'role'       => $role_label,
      'action'     => $action,
      'module'     => $module,
      'description'=> $description,
      'url'        => current_url(),
      'method'     => $this->input->method(TRUE),
      'ip_address' => $this->input->ip_address(),
      'user_agent' => $this->input->user_agent(),
      'created_at' => date('Y-m-d H:i:s'),
    ];

    try {
      return $this->db->insert('activity_logs', $data);
    } catch (Throwable $e) {
      log_message('error', 'Model_activity_log add failed: '.$e->getMessage());
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
