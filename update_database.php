<?php
// Database configuration
$host = 'localhost';
$username = 'root';
$password = '';
$database = 'sinta';

// Create connection
$conn = new mysqli($host, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// SQL queries to execute
$sql_queries = [
    "ALTER TABLE pengerjaan ADD COLUMN foto_before TEXT NULL AFTER standar",
    "ALTER TABLE pengerjaan ADD COLUMN foto_after TEXT NULL AFTER foto_before", 
    "ALTER TABLE pengerjaan ADD COLUMN catatan TEXT NULL AFTER foto_after",
    "ALTER TABLE pengerjaan ADD COLUMN completed_at DATETIME NULL AFTER catatan"
];

echo "Starting database update...\n";

foreach ($sql_queries as $index => $sql) {
    echo "Executing query " . ($index + 1) . ": " . $sql . "\n";
    
    // Check if column already exists
    $column_name = '';
    if (strpos($sql, 'foto_before') !== false) $column_name = 'foto_before';
    elseif (strpos($sql, 'foto_after') !== false) $column_name = 'foto_after';
    elseif (strpos($sql, 'catatan') !== false) $column_name = 'catatan';
    elseif (strpos($sql, 'completed_at') !== false) $column_name = 'completed_at';
    
    if ($column_name) {
        $check_sql = "SHOW COLUMNS FROM pengerjaan LIKE '$column_name'";
        $result = $conn->query($check_sql);
        
        if ($result && $result->num_rows > 0) {
            echo "Column '$column_name' already exists. Skipping.\n";
            continue;
        }
    }
    
    if ($conn->query($sql) === TRUE) {
        echo "Query executed successfully.\n";
    } else {
        echo "Error executing query: " . $conn->error . "\n";
    }
}

echo "Database update completed.\n";

// Check current table structure
echo "\nCurrent pengerjaan table structure:\n";
$result = $conn->query("DESCRIBE pengerjaan");
while ($row = $result->fetch_assoc()) {
    echo "- " . $row['Field'] . " (" . $row['Type'] . ")\n";
}

$conn->close();
?>
