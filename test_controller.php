<?php
// Test controller access and session
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

echo "<h2>Controller Test</h2>";

// Test 1: Check if we can access the controller
echo "<h3>1. Controller Access:</h3>";
$controller_url = 'http://localhost/Sinta/submittugas/complete';
echo "Controller URL: $controller_url<br>";

// Test 2: Simulate POST request
echo "<h3>2. POST Request Simulation:</h3>";

// Create test file content
$test_content = "Test image content";
$temp_file = tempnam(sys_get_temp_dir(), 'test_');
file_put_contents($temp_file, $test_content);

// Create $_FILES array
$_FILES = [
    'foto_before_0' => [
        'name' => 'test_before.jpg',
        'type' => 'image/jpeg',
        'size' => strlen($test_content),
        'tmp_name' => $temp_file,
        'error' => UPLOAD_ERR_OK
    ],
    'foto_after_0' => [
        'name' => 'test_after.jpg',
        'type' => 'image/jpeg',
        'size' => strlen($test_content),
        'tmp_name' => $temp_file . '_after',
        'error' => UPLOAD_ERR_OK
    ]
];

// Create $_POST array
$_POST = [
    'task_count' => 1,
    'notes' => 'Test notes'
];

echo "Simulated POST data:<br>";
echo "task_count: " . $_POST['task_count'] . "<br>";
echo "notes: " . $_POST['notes'] . "<br>";
echo "Files count: " . count($_FILES) . "<br>";

// Test 3: Check session simulation
echo "<h3>3. Session Simulation:</h3>";
session_start();

// Simulate CodeIgniter session data
$_SESSION['__ci_last_regenerate'] = time();
$_SESSION['user_logged_in'] = true;
$_SESSION['user_id'] = 1;
$_SESSION['role'] = '1';

echo "Session started: " . (session_status() === PHP_SESSION_ACTIVE ? "Yes" : "No") . "<br>";
echo "User logged in: " . ($_SESSION['user_logged_in'] ? "Yes" : "No") . "<br>";
echo "User ID: " . $_SESSION['user_id'] . "<br>";
echo "Role: " . $_SESSION['role'] . "<br>";

// Test 4: Test file upload function
echo "<h3>4. File Upload Function Test:</h3>";

function test_handle_upload($field_name, $file_prefix) {
    if (!isset($_FILES[$field_name])) {
        echo "❌ Field {$field_name} not found<br>";
        return false;
    }
    
    $file = $_FILES[$field_name];
    echo "File info for {$field_name}:<br>";
    echo "- Name: " . $file['name'] . "<br>";
    echo "- Type: " . $file['type'] . "<br>";
    echo "- Size: " . $file['size'] . "<br>";
    echo "- Error: " . $file['error'] . "<br>";
    
    if ($file['error'] !== UPLOAD_ERR_OK) {
        echo "❌ Upload error: " . $file['error'] . "<br>";
        return false;
    }
    
    // Validate file type
    $allowed_types = ['image/jpeg', 'image/jpg', 'image/png'];
    if (!in_array($file['type'], $allowed_types)) {
        echo "❌ Invalid file type: " . $file['type'] . "<br>";
        return false;
    }
    
    // Generate unique filename
    $extension = pathinfo($file['name'], PATHINFO_EXTENSION);
    $filename = $file_prefix . '_' . time() . '.' . $extension;
    
    // Create upload directory if not exists
    $upload_path = './uploads/pengerjaan/';
    if (!is_dir($upload_path)) {
        if (!mkdir($upload_path, 0755, true)) {
            echo "❌ Failed to create upload directory<br>";
            return false;
        }
    }
    
    // Move uploaded file
    $destination = $upload_path . $filename;
    if (move_uploaded_file($file['tmp_name'], $destination)) {
        echo "✅ File uploaded successfully: $destination<br>";
        return 'uploads/pengerjaan/' . $filename;
    } else {
        echo "❌ Failed to move file<br>";
        return false;
    }
}

// Test upload functions
$foto_before = test_handle_upload('foto_before_0', 'test_before');
$foto_after = test_handle_upload('foto_after_0', 'test_after');

// Test 5: Test JSON encoding
echo "<h3>5. JSON Encoding Test:</h3>";
if ($foto_before && $foto_after) {
    $foto_before_data = [$foto_before];
    $foto_after_data = [$foto_after];
    
    $json_before = json_encode($foto_before_data);
    $json_after = json_encode($foto_after_data);
    
    echo "JSON before: $json_before<br>";
    echo "JSON after: $json_after<br>";
    
    // Test JSON decode
    $decoded_before = json_decode($json_before, true);
    $decoded_after = json_decode($json_after, true);
    
    echo "Decoded before: " . print_r($decoded_before, true) . "<br>";
    echo "Decoded after: " . print_r($decoded_after, true) . "<br>";
}

// Test 6: Test cURL request to controller
echo "<h3>6. cURL Request Test:</h3>";
$ch = curl_init($controller_url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $_POST);
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    'Content-Type: multipart/form-data'
]);

$response = curl_exec($ch);
$http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
$error = curl_error($ch);
curl_close($ch);

echo "HTTP Code: $http_code<br>";
echo "cURL Error: $error<br>";
echo "Response: <pre>" . htmlspecialchars($response) . "</pre>";

// Cleanup
unlink($temp_file);
if (file_exists($temp_file . '_after')) {
    unlink($temp_file . '_after');
}
?>
