<?php
// Test submit endpoint directly
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

echo "<h2>Submit Endpoint Test</h2>";

// Create a simple test file
$test_image_content = base64_decode('/9j/4AAQSkZJRgABAQEAYABgAAD/2wBDAAEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQH/2wBDAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQH/wAARCAABAAEDASIAAhEBAxEB/8QAFQABAQAAAAAAAAAAAAAAAAAAAAv/xAAUEAEAAAAAAAAAAAAAAAAAAAAA/8QAFQEBAQAAAAAAAAAAAAAAAAAAAAX/xAAUEQEAAAAAAAAAAAAAAAAAAAAA/9oADAMBAAIRAxEAPwA/8A8A');

// Save test files
$temp_dir = sys_get_temp_dir();
$before_file = $temp_dir . '/test_before.jpg';
$after_file = $temp_dir . '/test_after.jpg';

file_put_contents($before_file, $test_image_content);
file_put_contents($after_file, $test_image_content);

// Simulate $_FILES
$_FILES = [
    'foto_before_0' => [
        'name' => 'test_before.jpg',
        'type' => 'image/jpeg',
        'size' => strlen($test_image_content),
        'tmp_name' => $before_file,
        'error' => UPLOAD_ERR_OK
    ],
    'foto_after_0' => [
        'name' => 'test_after.jpg',
        'type' => 'image/jpeg',
        'size' => strlen($test_image_content),
        'tmp_name' => $after_file,
        'error' => UPLOAD_ERR_OK
    ]
];

// Simulate $_POST
$_POST = [
    'task_count' => '1',
    'notes' => 'Test notes from endpoint test'
];

// Simulate session
session_start();
$_SESSION['__ci_last_regenerate'] = time();
$_SESSION['user_logged_in'] = true;
$_SESSION['user_id'] = 1;
$_SESSION['role'] = '1';

echo "<h3>Test Data Prepared:</h3>";
echo "POST data: " . print_r($_POST, true) . "<br>";
echo "Files count: " . count($_FILES) . "<br>";
echo "Session user_id: " . $_SESSION['user_id'] . "<br>";

// Test 1: Direct cURL to endpoint
echo "<h3>Direct cURL Test:</h3>";

$ch = curl_init('http://localhost/Sinta/submittugas/complete');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $_POST);
curl_setopt($ch, CURLOPT_COOKIESESSION, true);
curl_setopt($ch, CURLOPT_COOKIE, session_name() . '=' . session_id());
curl_setopt($ch, CURLOPT_HEADER, true);
curl_setopt($ch, CURLOPT_VERBOSE, true);

$response = curl_exec($ch);
$http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
$header_size = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
$headers = substr($response, 0, $header_size);
$body = substr($response, $header_size);
$error = curl_error($ch);

curl_close($ch);

echo "HTTP Code: $http_code<br>";
echo "cURL Error: $error<br>";
echo "Response Headers:<br><pre>" . htmlspecialchars($headers) . "</pre>";
echo "Response Body:<br><pre>" . htmlspecialchars($body) . "</pre>";

// Test 2: Check if response is JSON
echo "<h3>Response Analysis:</h3>";
$json_data = json_decode($body, true);
if ($json_data !== null) {
    echo "✅ Valid JSON response<br>";
    echo "Status: " . $json_data['status'] . "<br>";
    echo "Message: " . $json_data['message'] . "<br>";
} else {
    echo "❌ Invalid JSON response<br>";
    echo "Body starts with: " . substr($body, 0, 100) . "...<br>";
    
    // Check if it's HTML
    if (strpos($body, '<!DOCTYPE') !== false || strpos($body, '<html') !== false) {
        echo "❌ Response is HTML (error page)<br>";
        
        // Extract title if HTML
        if (preg_match('/<title>(.*?)<\/title>/', $body, $matches)) {
            echo "Page title: " . htmlspecialchars($matches[1]) . "<br>";
        }
    }
}

// Test 3: Check log file for new entries
echo "<h3>Log Check:</h3>";
$log_file = APPPATH . 'logs/log-' . date('Y-m-d') . '.php';
if (file_exists($log_file)) {
    $log_content = file_get_contents($log_file);
    $recent_logs = explode("\n", $log_content);
    $submit_logs = array_filter($recent_logs, function($line) {
        return strpos($line, 'SubmitTugas') !== false;
    });
    
    echo "Recent SubmitTugas logs:<br>";
    echo "<pre>" . htmlspecialchars(implode("\n", array_slice($submit_logs, -5))) . "</pre>";
} else {
    echo "No log file found<br>";
}

// Cleanup
unlink($before_file);
unlink($after_file);

echo "<h3>Next Steps:</h3>";
echo "1. If you see HTML response, check the logs for errors<br>";
echo "2. If you see JSON response, the endpoint is working<br>";
echo "3. Check session validation in logs<br>";
echo "4. Check file upload logs<br>";
?>
