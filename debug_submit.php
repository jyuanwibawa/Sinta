<?php
// Debug submit tugas functionality
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

echo "<h2>Submit Tugas Debug</h2>";

// Check CodeIgniter logs
$log_file = APPPATH . 'logs/log-' . date('Y-m-d') . '.php';
echo "<h3>Log File:</h3>";
echo "Path: $log_file<br>";
echo "Exists: " . (file_exists($log_file) ? "Yes" : "No") . "<br>";

if (file_exists($log_file)) {
    echo "File size: " . filesize($log_file) . " bytes<br>";
    
    // Read last 50 lines of log
    $lines = file($log_file);
    $recent_lines = array_slice($lines, -50);
    
    echo "<h4>Recent Log Entries:</h4>";
    echo "<pre style='background: #f5f5f5; padding: 10px; border: 1px solid #ccc;'>";
    foreach ($recent_lines as $line) {
        if (strpos($line, 'SubmitTugas') !== false) {
            echo htmlspecialchars($line);
        }
    }
    echo "</pre>";
}

// Check session
echo "<h3>Session Data:</h3>";
session_start();
echo "Session ID: " . session_id() . "<br>";
echo "User logged in: " . (isset($_SESSION['user_logged_in']) ? "Yes" : "No") . "<br>";
echo "User ID: " . (isset($_SESSION['user_id']) ? $_SESSION['user_id'] : "Not set") . "<br>";
echo "Role: " . (isset($_SESSION['role']) ? $_SESSION['role'] : "Not set") . "<br>";

// Check CodeIgniter session
$ci =& get_instance();
$ci->load->library('session');
echo "<h3>CodeIgniter Session:</h3>";
echo "User logged in: " . ($ci->session->userdata('user_logged_in') ? "Yes" : "No") . "<br>";
echo "User ID: " . $ci->session->userdata('user_id') . "<br>";
echo "Role: " . $ci->session->userdata('role') . "<br>";

// Test database connection
echo "<h3>Database Test:</h3>";
try {
    $ci->load->model('Model_pengerjaan', 'p');
    $user_id = $ci->session->userdata('user_id');
    
    if ($user_id) {
        $pengerjaan = $ci->p->get_latest_pengerjaan_by_user($user_id);
        if ($pengerjaan) {
            echo "✅ Found pengerjaan for user $user_id<br>";
            echo "Pengerjaan ID: " . $pengerjaan->id_pengerjaan . "<br>";
            echo "Room: " . $pengerjaan->nama_ruangan . "<br>";
            echo "Status: " . $pengerjaan->status . "<br>";
        } else {
            echo "❌ No pengerjaan found for user $user_id<br>";
        }
    } else {
        echo "❌ No user ID in session<br>";
    }
} catch (Exception $e) {
    echo "❌ Database error: " . $e->getMessage() . "<br>";
}

// Check upload directory
echo "<h3>Upload Directory:</h3>";
$upload_path = './uploads/pengerjaan/';
echo "Path: $upload_path<br>";
echo "Exists: " . (is_dir($upload_path) ? "Yes" : "No") . "<br>";
echo "Writable: " . (is_writable($upload_path) ? "Yes" : "No") . "<br>";

if (is_dir($upload_path)) {
    $files = scandir($upload_path);
    $file_count = count($files) - 2; // Exclude . and ..
    echo "Files in directory: $file_count<br>";
    
    if ($file_count > 0) {
        echo "<h4>Recent Files:</h4>";
        foreach (array_slice($files, 2, 10) as $file) {
            $full_path = $upload_path . $file;
            if (is_file($full_path)) {
                echo "- $file (" . filesize($full_path) . " bytes, " . date('Y-m-d H:i:s', filemtime($full_path)) . ")<br>";
            }
        }
    }
}

// Test URL generation
echo "<h3>URL Test:</h3>";
$base_url = base_url();
echo "Base URL: $base_url<br>";
echo "Submit URL: " . $base_url . 'submittugas/complete<br>';
echo "Detail URL: " . $base_url . 'detailtugas/detail<br>';

echo "<h3>PHP Info:</h3>";
echo "PHP Version: " . phpversion() . "<br>";
echo "Max Upload Size: " . ini_get('upload_max_filesize') . "<br>";
echo "Max POST Size: " . ini_get('post_max_size') . "<br>";
echo "Memory Limit: " . ini_get('memory_limit') . "<br>";
?>
