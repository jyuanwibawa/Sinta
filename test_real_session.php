<?php
// Test with real browser session
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

echo "<h2>Real Session Test</h2>";
echo "<p>This test will help you debug the session issue</p>";

// Check if we have a CodeIgniter session
echo "<h3>Current Session Status:</h3>";

if (isset($_COOKIE['ci_session'])) {
    echo "✅ Found ci_session cookie: " . substr($_COOKIE['ci_session'], 0, 10) . "...<br>";
    
    // Try to decode the session
    $session_data = $_COOKIE['ci_session'];
    echo "Session data length: " . strlen($session_data) . " bytes<br>";
    
    // Try to parse if it's JSON
    $decoded = json_decode(base64_decode($session_data), true);
    if ($decoded) {
        echo "✅ Session appears to be JSON encoded<br>";
        echo "Session keys: " . implode(', ', array_keys($decoded)) . "<br>";
        
        if (isset($decoded['user_logged_in'])) {
            echo "✅ User logged in: " . ($decoded['user_logged_in'] ? "Yes" : "No") . "<br>";
        }
        
        if (isset($decoded['user_id'])) {
            echo "User ID: " . $decoded['user_id'] . "<br>";
        }
        
        if (isset($decoded['role'])) {
            echo "Role: " . $decoded['role'] . "<br>";
        }
    } else {
        echo "❌ Could not decode session data<br>";
    }
} else {
    echo "❌ No ci_session cookie found<br>";
    echo "You need to login to the application first<br>";
}

echo "<h3>Test Instructions:</h3>";
echo "<ol>";
echo "<li>Open a new browser tab</li>";
echo "<li>Login to the Sinta application as a user</li>";
echo "<li>Come back to this tab and refresh</li>";
echo "<li>Then try to submit a task</li>";
echo "</ol>";

echo "<h3>Debug Steps:</h3>";
echo "<p>1. Login to: <a href='http://localhost/Sinta/loginuser' target='_blank'>http://localhost/Sinta/loginuser</a></p>";
echo "<p>2. Go to: <a href='http://localhost/Sinta/dashboard_user' target='_blank'>http://localhost/Sinta/dashboard_user</a></p>";
echo "<p>3. Try to submit a task and check the browser console</p>";

echo "<h3>Browser Console Debug:</h3>";
echo "<p>Open browser developer tools (F12) and go to Console tab.</p>";
echo "<p>Look for these console.log messages:</p>";
echo "<ul>";
echo "<li>'Submitting form data:'</li>";
echo "<li>'Response status:'</li>";
echo "<li>'Response data:'</li>";
echo "<li>'Server response:' (if error)</li>";
echo "</ul>";

echo "<h3>Network Tab Debug:</h3>";
echo "<p>In browser developer tools, go to Network tab:</p>";
echo "<ul>";
echo "<li>Find the POST request to 'submittugas/complete'</li>";
echo "<li>Check the Request headers (should include ci_session cookie)</li>";
echo "<li>Check the Response (should be JSON, not HTML)</li>";
echo "<li>Check the Status (should be 200, not 303)</li>";
echo "</ul>";

echo "<h3>Common Issues:</h3>";
echo "<div style='background: #f8f9fa; padding: 15px; border-radius: 5px;'>";
echo "<strong>Issue 1: Session expired</strong><br>";
echo "Solution: Login again<br><br>";
echo "<strong>Issue 2: Wrong browser tab</strong><br>";
echo "Solution: Use the same browser tab where you logged in<br><br>";
echo "<strong>Issue 3: Cookie blocked</strong><br>";
echo "Solution: Check browser cookie settings<br><br>";
echo "<strong>Issue 4: Multiple domains</strong><br>";
echo "Solution: Make sure you're using localhost consistently<br>";
echo "</div>";

// Check current PHP session vs CodeIgniter session
echo "<h3>Session Comparison:</h3>";
echo "PHP Session ID: " . session_id() . "<br>";
echo "PHP Session Data: " . print_r($_SESSION, true) . "<br>";

if (isset($_COOKIE['ci_session'])) {
    echo "CodeIgniter Session Cookie: " . substr($_COOKIE['ci_session'], 0, 20) . "...<br>";
}
?>
