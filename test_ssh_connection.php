<?php
// Test koneksi database via SSH tunnel
$host = '127.0.0.1';
$port = 3307;
$user = 'root';
$pass = 'Surabaya456';
$db = 'sinta';

try {
    $mysqli = new mysqli($host, $user, $pass, $db, $port);
    
    if ($mysqli->connect_error) {
        echo "Connection failed: " . $mysqli->connect_error;
    } else {
        echo "✅ Database connection successful!<br>";
        echo "Host: $host:$port<br>";
        echo "Database: $db<br>";
        echo "MySQL Version: " . $mysqli->server_info;
    }
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
?>
