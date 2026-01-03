<?php
// View CodeIgniter logs in real-time
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

echo "<h2>CodeIgniter Logs</h2>";
echo "<p>Refresh this page to see latest logs</p>";

// Define APPPATH if not defined
if (!defined('APPPATH')) {
    define('APPPATH', __DIR__ . '/application/');
}

// Get today's log file
$log_file = APPPATH . 'logs/log-' . date('Y-m-d') . '.php';

echo "<h3>Debug Info:</h3>";
echo "APPPATH: " . APPPATH . "<br>";
echo "Log file: " . $log_file . "<br>";
echo "File exists: " . (file_exists($log_file) ? "Yes" : "No") . "<br>";

if (file_exists($log_file)) {
    echo "<h3>Log File: " . basename($log_file) . "</h3>";
    echo "<p>File size: " . number_format(filesize($log_file)) . " bytes</p>";
    
    // Read last 100 lines
    $lines = file($log_file);
    $recent_lines = array_slice($lines, -100);
    
    echo "<h4>Recent Log Entries (Last 100 lines):</h4>";
    echo "<div style='background: #f8f9fa; border: 1px solid #dee2e6; padding: 15px; border-radius: 5px; font-family: monospace; font-size: 12px; white-space: pre-wrap; max-height: 500px; overflow-y: auto;'>";
    
    $submit_logs = [];
    $error_logs = [];
    $debug_logs = [];
    
    foreach ($recent_lines as $line) {
        // Remove PHP opening tags if present
        $line = str_replace('<?php defined(\'BASEPATH\') OR exit(\'No direct script access allowed\'); ?>', '', $line);
        $line = trim($line);
        
        if (empty($line)) continue;
        
        // Categorize logs
        if (strpos($line, 'SubmitTugas') !== false) {
            $submit_logs[] = $line;
        } elseif (strpos($line, 'ERROR') !== false) {
            $error_logs[] = $line;
        } elseif (strpos($line, 'DEBUG') !== false) {
            $debug_logs[] = $line;
        }
    }
    
    // Show SubmitTugas logs first
    if (!empty($submit_logs)) {
        echo "<div style='color: #0066cc; font-weight: bold; margin-bottom: 10px;'>=== SUBMITTUGAS LOGS ===</div>";
        foreach ($submit_logs as $log) {
            echo htmlspecialchars($log) . "\n";
        }
        echo "\n";
    }
    
    // Show error logs
    if (!empty($error_logs)) {
        echo "<div style='color: #cc0000; font-weight: bold; margin-bottom: 10px;'>=== ERROR LOGS ===</div>";
        foreach ($error_logs as $log) {
            echo htmlspecialchars($log) . "\n";
        }
        echo "\n";
    }
    
    // Show some debug logs
    if (!empty($debug_logs)) {
        echo "<div style='color: #009900; font-weight: bold; margin-bottom: 10px;'>=== DEBUG LOGS (Last 20) ===</div>";
        $debug_subset = array_slice($debug_logs, -20);
        foreach ($debug_subset as $log) {
            echo htmlspecialchars($log) . "\n";
        }
    }
    
    echo "</div>";
    
    // Show statistics
    echo "<h4>Log Statistics:</h4>";
    echo "<ul>";
    echo "<li>SubmitTugas entries: " . count($submit_logs) . "</li>";
    echo "<li>Error entries: " . count($error_logs) . "</li>";
    echo "<li>Debug entries: " . count($debug_logs) . "</li>";
    echo "</ul>";
    
} else {
    echo "<p>No log file found for today: " . $log_file . "</p>";
    echo "<p>Creating log directory and file...</p>";
    
    // Create log directory
    $log_dir = APPPATH . 'logs';
    if (!is_dir($log_dir)) {
        mkdir($log_dir, 0755, true);
        echo "Created log directory: " . $log_dir . "<br>";
    }
    
    // Create log file
    $log_content = "<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>\n";
    if (file_put_contents($log_file, $log_content)) {
        echo "Created log file: " . $log_file . "<br>";
        echo "<a href='?refresh=1'>Refresh page</a> to see logs<br>";
    } else {
        echo "Failed to create log file<br>";
    }
}

// Show available log files
echo "<h3>Available Log Files:</h3>";
$log_dir = APPPATH . 'logs';
if (is_dir($log_dir)) {
    $files = scandir($log_dir);
    $log_files = array_filter($files, function($file) {
        return strpos($file, 'log-') === 0 && strpos($file, '.php') !== false;
    });
    
    sort($log_files);
    
    echo "<ul>";
    foreach ($log_files as $file) {
        $file_path = $log_dir . '/' . $file;
        $size = filesize($file_path);
        $date = date('Y-m-d H:i:s', filemtime($file_path));
        echo "<li><a href='?file=" . urlencode($file) . "'>" . htmlspecialchars($file) . "</a> (" . number_format($size) . " bytes, " . $date . ")</li>";
    }
    echo "</ul>";
    
    // Show specific log file if requested
    if (isset($_GET['file'])) {
        $requested_file = $log_dir . '/' . $_GET['file'];
        if (file_exists($requested_file) && strpos($requested_file, $log_dir) === 0) {
            echo "<h3>Content of: " . htmlspecialchars($_GET['file']) . "</h3>";
            $content = file_get_contents($requested_file);
            echo "<div style='background: #f8f9fa; border: 1px solid #dee2e6; padding: 15px; border-radius: 5px; font-family: monospace; font-size: 12px; white-space: pre-wrap; max-height: 500px; overflow-y: auto;'>";
            echo htmlspecialchars($content);
            echo "</div>";
        }
    }
} else {
    echo "<p>Log directory not found: " . $log_dir . "</p>";
}

// Show PHP error log
echo "<h3>PHP Error Log:</h3>";
$error_log = ini_get('error_log');
if ($error_log && file_exists($error_log)) {
    echo "<p>Error log location: " . $error_log . "</p>";
    $error_content = file_get_contents($error_log);
    $error_lines = explode("\n", $error_content);
    $recent_errors = array_slice($error_lines, -20);
    
    echo "<div style='background: #fff3cd; border: 1px solid #ffeaa7; padding: 15px; border-radius: 5px; font-family: monospace; font-size: 12px; white-space: pre-wrap; max-height: 300px; overflow-y: auto;'>";
    foreach ($recent_errors as $error) {
        echo htmlspecialchars($error) . "\n";
    }
    echo "</div>";
} else {
    echo "<p>No PHP error log configured or file not found</p>";
    echo "<p>Current error_log setting: " . ($error_log ?: 'Not set') . "</p>";
}

// Show CodeIgniter config
echo "<h3>CodeIgniter Configuration:</h3>";
$config_file = APPPATH . 'config/config.php';
if (file_exists($config_file)) {
    $config_content = file_get_contents($config_file);
    
    // Extract log threshold
    if (preg_match('/\$config\[\'log_threshold\'\]\s*=\s*(\d+);/', $config_content, $matches)) {
        $threshold = $matches[1];
        $thresholds = [
            0 => 'DISABLED',
            1 => 'ERRORS',
            2 => 'ERRORS & DEBUG',
            3 => 'ALL'
        ];
        echo "Log Threshold: " . $threshold . " (" . ($thresholds[$threshold] ?? 'UNKNOWN') . ")<br>";
    }
    
    // Extract log path
    if (preg_match('/\$config\[\'log_path\'\]\s*=\s*[\'"]([^\'"]+)[\'"];/', $config_content, $matches)) {
        echo "Log Path: " . $matches[1] . "<br>";
    }
} else {
    echo "Config file not found: " . $config_file . "<br>";
}
?>

<script>
// Auto-refresh every 30 seconds
setTimeout(function() {
    window.location.reload();
}, 30000);
</script>
