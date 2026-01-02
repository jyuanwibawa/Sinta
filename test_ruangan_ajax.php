<?php
// Simple test file to debug AJAX requests
header('Content-Type: application/json');

// Simulate response for testing
if (isset($_GET['id'])) {
    echo json_encode([
        'success' => true,
        'data' => [
            'id_ruangan' => 1,
            'nama_ruangan' => 'Test Ruangan',
            'lantai' => 1,
            'luas' => 25.5,
            'kapasitas' => 10,
            'status' => 'aktif',
            'deskripsi' => 'Test description'
        ]
    ]);
} else {
    echo json_encode([
        'success' => false,
        'error' => 'ID not provided'
    ]);
}
?>
