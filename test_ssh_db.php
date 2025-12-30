<?php
try {
    $mysqli = new mysqli('127.0.0.1', 'root', 'Surabaya456', 'sinta', 3307);
    if ($mysqli->connect_error) {
        echo 'Connection failed: ' . $mysqli->connect_error;
    } else {
        echo 'SSH Tunnel Connection successful!';
        echo '<br>MySQL Server Info: ' . $mysqli->server_info;
    }
    $mysqli->close();
} catch (Exception $e) {
    echo 'Error: ' . $e->getMessage();
}
?>
