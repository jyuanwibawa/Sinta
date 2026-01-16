<?php defined('BASEPATH') OR exit('No direct script access allowed');

class ActivityLogger {

  public function log_request() {
    $CI =& get_instance();
    $CI->load->database();
    if (!isset($CI->session)) {
      $CI->load->library('session');
    }

    // Hindari spam (assets, favicon, dll)
    $ignored = array('assets', 'favicon.ico');
    $uri = $CI->uri->uri_string();
    foreach ($ignored as $ig) {
      if (stripos($uri, $ig) !== false) return;
    }

    // Ambil controller & method
    $controller = strtolower($CI->router->fetch_class());
    $method     = strtolower($CI->router->fetch_method());

    // Jangan log halaman login index
    if ($controller === 'login' && $method === 'index') return;
    if ($controller === 'loginuser' && $method === 'index') return;

    // Ambil session user 
    $user_id = $CI->session->userdata('user_id');
    $nama    = $CI->session->userdata('nama');
    $email   = $CI->session->userdata('email');
    $role    = $CI->session->userdata('role');

    $is_guest = empty($user_id);

    // Label role
    $role_label = 'guest';
    if (!$is_guest) {
      if ((string)$role === '0') {
        $role_label = 'Administrator';
      } elseif ((string)$role === '1') {
        $role_label = 'User';
      } else {
        $role_label = (string)$role;
      }
    }

    // Data log
    $data = array(
      'user_id'    => $is_guest ? null : $user_id,
      'username'   => $is_guest ? 'guest' : ($nama ?: $email),
      'role'       => $role_label,
      'action'     => 'OPEN_PAGE',
      'module'     => $controller,
      'description'=> 'Access: '.$controller.'::'.$method,
      'url'        => current_url(),
      'method'     => $CI->input->method(TRUE),
      'ip_address' => $CI->input->ip_address(),
      'user_agent' => $CI->input->user_agent(),
      'created_at' => date('Y-m-d H:i:s'),
    );

    // Insert log (anti crash)
    try {
      $CI->db->insert('activity_logs', $data);
    } catch (Exception $e) {
      log_message('error', 'ActivityLogger insert failed: '.$e->getMessage());
      return;
    }
  }
}
