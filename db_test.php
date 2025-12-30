<?php
// Test koneksi database detail
echo "<h3>Testing Database Connection...</h3>";

$host = 'localhost';
$port = 3306;
$user = 'root';
$pass = '';
$db = 'sinta';

echo "Host: $host:$port<br>";
echo "User: $user<br>";
echo "Database: $db<br><br>";

// Test 1: Connect tanpa database
try {
    $mysqli = new mysqli($host, $user, $pass, null, $port);
    
    if ($mysqli->connect_error) {
        echo "❌ Connection failed: " . $mysqli->connect_error . "<br>";
        echo "Error code: " . $mysqli->connect_errno . "<br>";
    } else {
        echo "✅ Server connection successful!<br>";
        echo "MySQL Version: " . $mysqli->server_info . "<br>";
        
        // Test 2: Connect dengan database
        $mysqli2 = new mysqli($host, $user, $pass, $db, $port);
        if ($mysqli2->connect_error) {
            echo "❌ Database connection failed: " . $mysqli2->connect_error . "<br>";
        } else {
            echo "✅ Database 'sinta' connection successful!<br>";
            
            // Test 3: Check tables
            $result = $mysqli2->query("SHOW TABLES");
            if ($result) {
                echo "📊 Tables in database: " . $result->num_rows . "<br>";
                while ($row = $result->fetch_row()) {
                    echo "- " . $row[0] . "<br>";
                }
            }
        }
        $mysqli2->close();
    }
    $mysqli->close();
    
} catch (Exception $e) {
    echo "❌ Exception: " . $e->getMessage() . "<br>";
}

// Test 4: Check PHP MySQL extension
echo "<br><h3>PHP Extensions:</h3>";
if (extension_loaded('mysqli')) {
    echo "✅ mysqli extension loaded<br>";
} else {
    echo "❌ mysqli extension NOT loaded<br>";
}
?>
