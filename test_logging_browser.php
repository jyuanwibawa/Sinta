<?php
// Test logging through browser
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

echo "<h2>Browser Logging Test</h2>";

if ($_POST['test_logging']) {
    echo "<h3>Testing Log Messages:</h3>";
    
    // Test 1: Error log
    log_message('error', 'Test error message from browser');
    echo "✅ Error log sent<br>";

    // Test 2: Debug log
    log_message('debug', 'Test debug message from browser');
    echo "✅ Debug log sent<br>";

    // Test 3: Info log
    log_message('info', 'Test info message from browser');
    echo "✅ Info log sent<br>";

    echo "<h3>Checking Log File:</h3>";

    // Check if log file was created
    $log_file = APPPATH . 'logs/log-' . date('Y-m-d') . '.php';
    echo "Log file: " . $log_file . "<br>";

    if (file_exists($log_file)) {
        echo "✅ Log file exists<br>";
        
        // Read recent logs
        $log_content = file_get_contents($log_file);
        $recent_logs = explode("\n", $log_content);
        $test_logs = array_filter($recent_logs, function($line) {
            return strpos($line, 'Test') !== false;
        });
        
        echo "Found " . count($test_logs) . " test log entries<br>";
        
        if (!empty($test_logs)) {
            echo "<h4>Recent Test Logs:</h4>";
            echo "<pre style='background: #f0f0f0; padding: 10px; border: 1px solid #ccc;'>";
            foreach (array_slice($test_logs, -5) as $log) {
                echo htmlspecialchars($log) . "\n";
            }
            echo "</pre>";
        }
    } else {
        echo "❌ Log file not found<br>";
    }
    
    echo "<h3>Log Configuration:</h3>";
    $CI =& get_instance();
    echo "Log threshold: " . $CI->config->item('log_threshold') . "<br>";
    echo "Log path: " . $CI->config->item('log_path') . "<br>";
    echo "Log date format: " . $CI->config->item('log_date_format') . "<br>";
    
    echo "<h3>Next Steps:</h3>";
    echo "<ol>";
    echo "<li>Try submitting a task now</li>";
    echo "<li>Open <a href='view_logs.php'>view_logs.php</a> for real-time monitoring</li>";
    echo "<li>Check SubmitTugas logs</li>";
    echo "</ol>";
} else {
    ?>
    <!DOCTYPE html>
    <html>
    <head>
        <title>Logging Test</title>
        <style>
            body { font-family: Arial, sans-serif; margin: 20px; }
            .btn { background: #007cba; color: white; padding: 10px 20px; border: none; border-radius: 5px; cursor: pointer; }
            .btn:hover { background: #005a87; }
        </style>
    </head>
    <body>
        <h2>Browser Logging Test</h2>
        <p>This will test if CodeIgniter logging is working properly.</p>
        
        <form method="post">
            <button type="submit" name="test_logging" value="1" class="btn">Test Logging</button>
        </form>
        
        <h3>What this tests:</h3>
        <ul>
            <li>Creates error, debug, and info log entries</li>
            <li>Checks if log file is created</li>
            <li>Verifies log configuration</li>
        </ul>
        
        <h3>After testing:</h3>
        <ol>
            <li>Submit a task from the application</li>
            <li>Check <a href="view_logs.php" target="_blank">view_logs.php</a> for real-time monitoring</li>
            <li>Look for SubmitTugas logs</li>
        </ol>
    </body>
    </html>
    <?php
}
?>
