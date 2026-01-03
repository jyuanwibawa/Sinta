<?php
// Test submit process step by step
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Load CodeIgniter
require_once 'system/core/CodeIgniter.php';
$CI = new CodeIgniter();
$CI->load->library('session');
$CI->load->database();

echo "<h2>Submit Process Test</h2>";

// Test 1: Check session
echo "<h3>1. Session Check:</h3>";
$CI->session->set_userdata('user_logged_in', true);
$CI->session->set_userdata('user_id', 1);
$CI->session->set_userdata('role', '1');

echo "User logged in: " . ($CI->session->userdata('user_logged_in') ? "Yes" : "No") . "<br>";
echo "User ID: " . $CI->session->userdata('user_id') . "<br>";
echo "Role: " . $CI->session->userdata('role') . "<br>";

// Test 2: Load model and get pengerjaan
echo "<h3>2. Model Test:</h3>";
$CI->load->model('Model_pengerjaan', 'p');

$user_id = $CI->session->userdata('user_id');
$pengerjaan = $CI->p->get_latest_pengerjaan_by_user($user_id);

if ($pengerjaan) {
    echo "✅ Found pengerjaan:<br>";
    echo "ID: " . $pengerjaan->id_pengerjaan . "<br>";
    echo "Room: " . $pengerjaan->nama_ruangan . "<br>";
    echo "Status: " . $pengerjaan->status . "<br>";
    echo "Tasks: " . $pengerjaan->tugas . "<br>";
} else {
    echo "❌ No pengerjaan found<br>";
}

// Test 3: Test update
echo "<h3>3. Update Test:</h3>";
if ($pengerjaan) {
    $test_data = [
        'status' => 'selesai',
        'foto_before' => json_encode(['test_before.jpg']),
        'foto_after' => json_encode(['test_after.jpg']),
        'catatan' => 'Test catatan',
        'completed_at' => date('Y-m-d H:i:s')
    ];
    
    echo "Update data: <pre>" . print_r($test_data, true) . "</pre>";
    
    $result = $CI->p->update_pengerjaan($pengerjaan->id_pengerjaan, $test_data);
    
    if ($result) {
        echo "✅ Update successful<br>";
        
        // Verify update
        $updated = $CI->p->get_pengerjaan_by_id($pengerjaan->id_pengerjaan);
        if ($updated) {
            echo "Updated status: " . $updated->status . "<br>";
            echo "Updated completed_at: " . $updated->completed_at . "<br>";
        }
    } else {
        echo "❌ Update failed<br>";
        echo "DB Error: " . $CI->db->error()['message'] . "<br>";
        echo "Last Query: " . $CI->db->last_query() . "<br>";
    }
}

// Test 4: Test file upload simulation
echo "<h3>4. File Upload Simulation:</h3>";
$test_files = [
    'foto_before_0' => [
        'name' => 'test_before.jpg',
        'type' => 'image/jpeg',
        'size' => 123456,
        'tmp_name' => 'C:\xampp\tmp\php1234.tmp',
        'error' => UPLOAD_ERR_OK
    ],
    'foto_after_0' => [
        'name' => 'test_after.jpg',
        'type' => 'image/jpeg',
        'size' => 654321,
        'tmp_name' => 'C:\xampp\tmp\php5678.tmp',
        'error' => UPLOAD_ERR_OK
    ]
];

$_FILES = $test_files;

echo "Simulated FILES: <pre>" . print_r($_FILES, true) . "</pre>";

// Test 5: Test complete method simulation
echo "<h3>5. Complete Method Simulation:</h3>";
if ($pengerjaan) {
    $task_count = 1;
    $notes = "Test notes";
    
    $foto_before_data = [];
    $foto_after_data = [];
    
    for ($i = 0; $i < $task_count; $i++) {
        $before_field = "foto_before_{$i}";
        $after_field = "foto_after_{$i}";
        
        echo "Processing task {$i}: {$before_field}, {$after_field}<br>";
        
        if (isset($_FILES[$before_field])) {
            $foto_before_data[] = 'uploads/pengerjaan/test_before_' . $i . '.jpg';
            echo "✅ Found {$before_field}<br>";
        } else {
            echo "❌ Missing {$before_field}<br>";
        }
        
        if (isset($_FILES[$after_field])) {
            $foto_after_data[] = 'uploads/pengerjaan/test_after_' . $i . '.jpg';
            echo "✅ Found {$after_field}<br>";
        } else {
            echo "❌ Missing {$after_field}<br>";
        }
    }
    
    $update_data = [
        'status' => 'selesai',
        'foto_before' => json_encode($foto_before_data),
        'foto_after' => json_encode($foto_after_data),
        'catatan' => $notes,
        'completed_at' => date('Y-m-d H:i:s')
    ];
    
    echo "Final update data: <pre>" . print_r($update_data, true) . "</pre>";
    
    $result = $CI->p->update_pengerjaan($pengerjaan->id_pengerjaan, $update_data);
    
    if ($result) {
        echo "✅ Complete simulation successful<br>";
    } else {
        echo "❌ Complete simulation failed<br>";
        echo "DB Error: " . $CI->db->error()['message'] . "<br>";
    }
}

// Test 6: Check database structure
echo "<h3>6. Database Structure Check:</h3>";
$fields = $CI->db->field_data('pengerjaan');
foreach ($fields as $field) {
    echo "- " . $field->name . " (" . $field->type . ")<br>";
}

echo "<h3>7. PHP Configuration:</h3>";
echo "upload_max_filesize: " . ini_get('upload_max_filesize') . "<br>";
echo "post_max_size: " . ini_get('post_max_size') . "<br>";
echo "max_execution_time: " . ini_get('max_execution_time') . "<br>";
echo "memory_limit: " . ini_get('memory_limit') . "<br>";

echo "<h3>8. Upload Directory:</h3>";
$upload_path = './uploads/pengerjaan/';
echo "Path: $upload_path<br>";
echo "Exists: " . (is_dir($upload_path) ? "Yes" : "No") . "<br>";
echo "Writable: " . (is_writable($upload_path) ? "Yes" : "No") . "<br>";
?>
