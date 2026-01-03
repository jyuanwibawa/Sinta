<?php
// Test file upload functionality
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

echo "<h2>File Upload Test</h2>";

// Check PHP configuration
echo "<h3>PHP Configuration:</h3>";
echo "upload_max_filesize: " . ini_get('upload_max_filesize') . "<br>";
echo "post_max_size: " . ini_get('post_max_size') . "<br>";
echo "max_execution_time: " . ini_get('max_execution_time') . "<br>";
echo "memory_limit: " . ini_get('memory_limit') . "<br>";

// Check upload directory
$upload_path = './uploads/pengerjaan/';
echo "<h3>Upload Directory:</h3>";
echo "Path: $upload_path<br>";
echo "Exists: " . (is_dir($upload_path) ? "Yes" : "No") . "<br>";
echo "Writable: " . (is_writable($upload_path) ? "Yes" : "No") . "<br>";

// Create directory if not exists
if (!is_dir($upload_path)) {
    echo "Creating directory...<br>";
    if (mkdir($upload_path, 0755, true)) {
        echo "Directory created successfully.<br>";
    } else {
        echo "Failed to create directory.<br>";
    }
}

// Test file upload
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['test_file'])) {
    echo "<h3>Upload Test:</h3>";
    
    $file = $_FILES['test_file'];
    echo "File name: " . $file['name'] . "<br>";
    echo "File type: " . $file['type'] . "<br>";
    echo "File size: " . $file['size'] . " bytes<br>";
    echo "Upload error: " . $file['error'] . "<br>";
    
    if ($file['error'] === UPLOAD_ERR_OK) {
        $destination = $upload_path . 'test_' . time() . '_' . $file['name'];
        
        if (move_uploaded_file($file['tmp_name'], $destination)) {
            echo "✅ File uploaded successfully to: $destination<br>";
            echo "File exists: " . (file_exists($destination) ? "Yes" : "No") . "<br>";
        } else {
            echo "❌ Failed to move uploaded file<br>";
        }
    } else {
        echo "❌ Upload failed with error code: " . $file['error'] . "<br>";
    }
}
?>

<h3>Upload Test Form:</h3>
<form method="post" enctype="multipart/form-data">
    <input type="file" name="test_file" accept="image/*" required>
    <button type="submit">Upload Test</button>
</form>

<h3>Server Information:</h3>
<?php
echo "PHP Version: " . phpversion() . "<br>";
echo "Server Software: " . $_SERVER['SERVER_SOFTWARE'] . "<br>";
echo "Document Root: " . $_SERVER['DOCUMENT_ROOT'] . "<br>";
echo "Current Directory: " . getcwd() . "<br>";
?>
