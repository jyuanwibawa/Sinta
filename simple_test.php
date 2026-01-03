<?php
// Simple test for database connection and basic operations
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

echo "<h2>Simple Database Test</h2>";

// Database connection
$host = 'localhost';
$username = 'root';
$password = '';
$database = 'sinta';

$conn = new mysqli($host, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

echo "✅ Database connected successfully<br>";

// Test 1: Check if pengerjaan table exists
echo "<h3>1. Table Check:</h3>";
$result = $conn->query("SHOW TABLES LIKE 'pengerjaan'");
if ($result->num_rows > 0) {
    echo "✅ Table 'pengerjaan' exists<br>";
} else {
    echo "❌ Table 'pengerjaan' not found<br>";
}

// Test 2: Check table structure
echo "<h3>2. Table Structure:</h3>";
$result = $conn->query("DESCRIBE pengerjaan");
while ($row = $result->fetch_assoc()) {
    echo "- " . $row['Field'] . " (" . $row['Type'] . ")<br>";
}

// Test 3: Check if there are any records
echo "<h3>3. Data Check:</h3>";
$result = $conn->query("SELECT COUNT(*) as count FROM pengerjaan");
$row = $result->fetch_assoc();
echo "Total records: " . $row['count'] . "<br>";

// Test 4: Get latest pengerjaan for user 1
echo "<h3>4. Latest Pengerjaan Test:</h3>";
$sql = "SELECT p.*, r.nama_ruangan, r.lantai, r.luas, u.nama as nama_user, u.user_id
        FROM pengerjaan p
        LEFT JOIN ruangan r ON p.id_ruangan = r.id_ruangan
        LEFT JOIN user u ON p.id_user = u.user_id
        WHERE p.id_user = 1
        ORDER BY p.created_at DESC
        LIMIT 1";

$result = $conn->query($sql);
if ($result && $result->num_rows > 0) {
    $pengerjaan = $result->fetch_assoc();
    echo "✅ Found pengerjaan:<br>";
    echo "ID: " . $pengerjaan['id_pengerjaan'] . "<br>";
    echo "Room: " . $pengerjaan['nama_ruangan'] . "<br>";
    echo "Status: " . $pengerjaan['status'] . "<br>";
    echo "Tasks: " . $pengerjaan['tugas'] . "<br>";
    
    // Test 5: Update test
    echo "<h3>5. Update Test:</h3>";
    $test_data = [
        'status' => 'selesai',
        'foto_before' => json_encode(['test_before.jpg']),
        'foto_after' => json_encode(['test_after.jpg']),
        'catatan' => 'Test catatan',
        'completed_at' => date('Y-m-d H:i:s')
    ];
    
    // Build UPDATE query
    $set_clauses = [];
    foreach ($test_data as $key => $value) {
        $escaped_value = $conn->real_escape_string($value);
        $set_clauses[] = "`$key` = '$escaped_value'";
    }
    
    $update_sql = "UPDATE pengerjaan SET " . implode(', ', $set_clauses) . " WHERE id_pengerjaan = " . $pengerjaan['id_pengerjaan'];
    
    echo "Update SQL: " . $update_sql . "<br>";
    
    if ($conn->query($update_sql)) {
        echo "✅ Update successful<br>";
        
        // Verify update
        $verify_sql = "SELECT status, completed_at, foto_before, foto_after FROM pengerjaan WHERE id_pengerjaan = " . $pengerjaan['id_pengerjaan'];
        $verify_result = $conn->query($verify_sql);
        if ($verify_result) {
            $updated = $verify_result->fetch_assoc();
            echo "Updated status: " . $updated['status'] . "<br>";
            echo "Updated completed_at: " . $updated['completed_at'] . "<br>";
            echo "Updated foto_before: " . $updated['foto_before'] . "<br>";
        }
    } else {
        echo "❌ Update failed<br>";
        echo "Error: " . $conn->error . "<br>";
    }
    
} else {
    echo "❌ No pengerjaan found for user 1<br>";
}

// Test 6: Check upload directory
echo "<h3>6. Upload Directory:</h3>";
$upload_path = './uploads/pengerjaan/';
echo "Path: $upload_path<br>";
echo "Exists: " . (is_dir($upload_path) ? "Yes" : "No") . "<br>";
echo "Writable: " . (is_writable($upload_path) ? "Yes" : "No") . "<br>";

if (!is_dir($upload_path)) {
    if (mkdir($upload_path, 0755, true)) {
        echo "✅ Created upload directory<br>";
    } else {
        echo "❌ Failed to create upload directory<br>";
    }
}

// Test 7: PHP Configuration
echo "<h3>7. PHP Configuration:</h3>";
echo "upload_max_filesize: " . ini_get('upload_max_filesize') . "<br>";
echo "post_max_size: " . ini_get('post_max_size') . "<br>";
echo "max_execution_time: " . ini_get('max_execution_time') . "<br>";
echo "memory_limit: " . ini_get('memory_limit') . "<br>";

$conn->close();
?>
