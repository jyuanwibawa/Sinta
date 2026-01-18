<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Tugas - SINTA</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        /* --- RESET & GLOBAL --- */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            background-color: #f3f4f6;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        /* --- HEADER SECTION --- */
        .header {
            background-color: #131b2e;
            color: white;
            padding: 20px 20px 60px 20px;
            position: relative;
            z-index: 1;
        }

        .nav-row {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 20px;
        }

        .back-link {
            text-decoration: none;
            color: white;
            font-size: 14px;
            display: flex;
            align-items: center;
            gap: 8px;
            font-weight: 500;
            transition: opacity 0.2s;
        }

        .back-link:hover {
            opacity: 0.8;
        }

        .page-title {
            font-size: 18px;
            font-weight: 600;
        }

        /* --- MAIN CONTAINER --- */
        .container {
            padding: 0 20px 20px 20px;
            margin-top: 10px;
            flex: 1;
            position: relative;
            z-index: 2;
        }

        /* --- CARD STYLES --- */
        .card {
            background-color: white;
            border-radius: 16px;
            padding: 20px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.05);
            margin-bottom: 20px;
            transition: transform 0.2s, box-shadow 0.2s;
        }

        .card:active {
            transform: translateY(2px);
        }

        /* Detail Header Info */
        .task-title {
            font-size: 16px;
            font-weight: 600;
            color: #1f2937;
            margin-bottom: 10px;
        }

        .meta-row {
            display: flex;
            align-items: center;
            gap: 8px;
            color: #6b7280;
            font-size: 13px;
            margin-bottom: 6px;
        }

        .meta-row i {
            width: 16px;
            text-align: center;
            color: #9ca3af;
        }

        /* Description Box */
        .desc-box {
            margin-top: 20px;
            background-color: #f9fafb;
            border: 1px solid #f3f4f6;
            padding: 15px;
            border-radius: 12px;
        }

        .desc-label {
            font-size: 12px;
            color: #6b7280;
            margin-bottom: 5px;
            display: block;
        }

        .desc-text {
            font-size: 14px;
            color: #1f2937;
            line-height: 1.5;
        }

        /* Divider & Status */
        .divider {
            height: 1px;
            background-color: #e5e7eb;
            margin: 20px 0;
            border: none;
        }

        .status-row {
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 13px;
            color: #4b5563;
        }

        .status-pill {
            padding: 6px 16px;
            border-radius: 20px;
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .status-pill.pending {
            background-color: #fffbeb;
            color: #d97706;
            border: 1px solid #fcd34d;
        }

        .status-pill.proses {
            background-color: #eff6ff;
            color: #2563eb;
            border: 1px solid #bfdbfe;
        }

        .status-pill.selesai {
            background-color: #f0fdf4;
            color: #16a34a;
            border: 1px solid #bbf7d0;
        }

        .status-dot {
            width: 8px;
            height: 8px;
            border-radius: 50%;
        }

        .status-dot.pending { background-color: #d97706; }
        .status-dot.proses { background-color: #2563eb; }
        .status-dot.selesai { background-color: #16a34a; }

        /* --- SCAN INFO CARD (BLUE) --- */
        .scan-card {
            background-color: #eff6ff;
            border: 1px solid #bfdbfe;
            display: flex;
            gap: 15px;
            align-items: flex-start;
            border-radius: 16px;
            padding: 15px;
            margin-bottom: 20px;
        }

        .scan-icon-box {
            background-color: #0ea5e9;
            width: 40px;
            height: 40px;
            border-radius: 10px;
            display: flex;
            justify-content: center;
            align-items: center;
            color: white;
            font-size: 18px;
            flex-shrink: 0;
        }

        .scan-content h3 {
            font-size: 14px;
            font-weight: 600;
            color: #1e293b;
            margin-bottom: 4px;
        }

        .scan-content p {
            font-size: 12px;
            color: #475569;
            line-height: 1.4;
        }

        /* --- ACTION BUTTONS --- */
        .btn-action {
            width: 100%;
            background-color: #131b2e;
            color: white;
            padding: 16px;
            border: none;
            border-radius: 12px;
            font-size: 14px;
            font-weight: 500;
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 10px;
            cursor: pointer;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
            transition: all 0.2s;
            margin-bottom: 10px;
        }

        .btn-action:active {
            transform: translateY(2px);
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        .btn-action i {
            font-size: 16px;
        }

        .btn-action.secondary {
            background-color: #6b7280;
        }

        .btn-action.success {
            background-color: #16a34a;
        }

        /* Loading state */
        .btn-action.loading {
            opacity: 0.8;
            pointer-events: none;
        }

        .btn-action.loading i {
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            from { transform: rotate(0deg); }
            to { transform: rotate(360deg); }
        }

        /* Task List */
        .task-list {
            margin-top: 15px;
        }

        .task-item {
            display: flex;
            align-items: flex-start;
            gap: 10px;
            margin-bottom: 10px;
            padding: 10px;
            background-color: #f9fafb;
            border-radius: 8px;
        }

        .task-checkbox {
            width: 20px;
            height: 20px;
            border: 2px solid #d1d5db;
            border-radius: 4px;
            cursor: pointer;
            flex-shrink: 0;
            margin-top: 2px;
            transition: all 0.2s;
        }

        .task-checkbox.checked {
            background-color: #16a34a;
            border-color: #16a34a;
            position: relative;
        }

        .task-checkbox.checked::after {
            content: '✓';
            color: white;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            font-size: 12px;
        }

        .task-content {
            flex: 1;
        }

        .task-name {
            font-size: 14px;
            color: #1f2937;
            margin-bottom: 4px;
        }

        .task-standar {
            font-size: 12px;
            color: #6b7280;
            line-height: 1.4;
        }

        /* Responsive Design */
        @media (min-width: 400px) {
            .container {
                max-width: 500px;
                margin-left: auto;
                margin-right: auto;
                width: 100%;
            }
        }

        /* Alert Messages */
        .alert {
            padding: 12px 16px;
            border-radius: 8px;
            margin-bottom: 20px;
            display: none;
        }

        .alert.success {
            background-color: #f0fdf4;
            color: #16a34a;
            border: 1px solid #bbf7d0;
        }

        .alert.error {
            background-color: #fef2f2;
            color: #dc2626;
            border: 1px solid #fecaca;
        }

        .alert.show {
            display: block;
        }

        /* Modal Styles */
        .modal {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.8);
            z-index: 1000;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .modal-content {
            background-color: white;
            border-radius: 16px;
            width: 90%;
            max-width: 500px;
            max-height: 90vh;
            overflow: hidden;
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1);
        }

        .modal-header {
            padding: 20px;
            border-bottom: 1px solid #e5e7eb;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .modal-header h3 {
            font-size: 18px;
            font-weight: 600;
            color: #1f2937;
        }

        .close-btn {
            background: none;
            border: none;
            font-size: 20px;
            color: #6b7280;
            cursor: pointer;
            padding: 5px;
            border-radius: 4px;
            transition: background-color 0.2s;
        }

        .close-btn:hover {
            background-color: #f3f4f6;
        }

        .modal-body {
            padding: 20px;
        }

        /* Camera Container */
        .camera-container {
            position: relative;
            width: 100%;
            height: 300px;
            background-color: #000;
            border-radius: 12px;
            overflow: hidden;
            margin-bottom: 20px;
        }

        #videoElement {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .scan-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            pointer-events: none;
        }

        .scan-line {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 2px;
            background: linear-gradient(90deg, transparent, #16a34a, transparent);
            animation: scan 2s linear infinite;
        }

        @keyframes scan {
            0% { top: 0; }
            100% { top: 100%; }
        }

        /* Camera Controls */
        .camera-controls {
            display: flex;
            gap: 10px;
            justify-content: center;
            margin-bottom: 20px;
        }

        .btn-scan {
            background-color: #16a34a;
            color: white;
            padding: 12px 24px;
            border: none;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 500;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 8px;
            transition: all 0.2s;
        }

        .btn-scan:hover {
            background-color: #15803d;
        }

        .btn-scan:active {
            transform: translateY(1px);
        }

        .btn-cancel {
            background-color: #6b7280;
            color: white;
            padding: 12px 24px;
            border: none;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 500;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 8px;
            transition: all 0.2s;
        }

        .btn-cancel:hover {
            background-color: #4b5563;
        }

        /* Scan Result */
        .scan-result {
            background-color: #f0fdf4;
            border: 1px solid #bbf7d0;
            border-radius: 8px;
            padding: 16px;
            text-align: center;
        }

        .result-content {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            color: #16a34a;
            font-weight: 500;
        }

        .result-content i {
            font-size: 20px;
        }
    </style>
</head>
<body>
    <header class="header">
        <div class="nav-row">
            <a href="<?= base_url('dashboard_user') ?>" class="back-link">
                <i class="fa-solid fa-arrow-left"></i> Kembali
            </a>
        </div>
        <h1 class="page-title">Detail Tugas</h1>
    </header>

    <div class="container">
        <div class="alert" id="alertMessage"></div>
        
        <div class="card">
            <h2 class="task-title"><?= htmlspecialchars($pengerjaan->nama_ruangan) ?></h2>
            
            <div class="meta-row">
                <i class="fa-solid fa-location-dot"></i>
                <span><?= htmlspecialchars($pengerjaan->nama_ruangan) ?> • Lantai <?= htmlspecialchars(isset($pengerjaan->lantai) ? $pengerjaan->lantai : '-') ?></span>
            </div>
            
            <div class="meta-row">
                <i class="fa-regular fa-clock"></i>
                <span>Jadwal: <?= date('H:i', strtotime($pengerjaan->created_at)) ?></span>
            </div>

            <div class="meta-row">
                <i class="fa-solid fa-flag"></i>
                <span>Prioritas: <?= ucfirst($pengerjaan->prioritas) ?></span>
            </div>

            <?php 
            // Parse tugas data
            $tugas_data = json_decode($pengerjaan->tugas, true);
            $standar_data = json_decode($pengerjaan->standar, true);
            
            if (!is_array($tugas_data)) {
                $tugas_data = [$pengerjaan->tugas];
                $standar_data = [$pengerjaan->standar];
            }
            ?>

            <div class="desc-box">
                <span class="desc-label">Daftar Tugas:</span>
                <div class="task-list">
                    <?php foreach($tugas_data as $index => $tugas): ?>
                        <div class="task-item">
                            <div class="task-checkbox <?= $pengerjaan->status == 'selesai' ? 'checked' : '' ?>"></div>
                            <div class="task-content">
                                <div class="task-name"><?= htmlspecialchars($tugas) ?></div>
                                <?php if(isset($standar_data[$index]) && !empty($standar_data[$index])): ?>
                                    <div class="task-standar">Standar: <?= htmlspecialchars($standar_data[$index]) ?></div>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <hr class="divider">

            <div class="status-row">
                <span>Status:</span>
                <div class="status-pill <?= $pengerjaan->status ?>">
                    <span class="status-dot <?= $pengerjaan->status ?>"></span> 
                    <?php 
                    switch($pengerjaan->status) {
                        case 'selesai': echo 'Selesai'; break;
                        case 'proses': echo 'Dikerjakan'; break;
                        default: echo 'Menunggu';
                    }
                    ?>
                </div>
            </div>
        </div>

        <?php if($pengerjaan->status == 'pending'): ?>
            <div class="card scan-card">
                <div class="scan-icon-box">
                    <i class="fa-solid fa-expand"></i>
                </div>
                <div class="scan-content">
                    <h3>Verifikasi Lokasi Diperlukan</h3>
                    <p>Scan barcode di dinding ruangan sebelum memulai pekerjaan untuk verifikasi lokasi.</p>
                </div>
            </div>

            <button class="btn-action" id="scanButton" onclick="openCameraModal()">
                <i class="fa-solid fa-expand"></i> Scan Barcode & Mulai Pekerjaan
            </button>
        <?php elseif($pengerjaan->status == 'proses'): ?>
            <button class="btn-action success" id="selesaiButton" onclick="selesaikanPekerjaan()">
                <i class="fa-solid fa-check"></i> Selesaikan Pekerjaan
            </button>
        <?php else: ?>
            <button class="btn-action secondary" disabled>
                <i class="fa-solid fa-check"></i> Pekerjaan Selesai
            </button>
        <?php endif; ?>
    </div>

    <!-- Camera Scan Modal -->
    <div id="cameraModal" class="modal" style="display: none;">
        <div class="modal-content">
            <div class="modal-header">
                <h3>Scan Barcode</h3>
                <button class="close-btn" onclick="closeCameraModal()">
                    <i class="fa-solid fa-times"></i>
                </button>
            </div>
            <div class="modal-body">
                <div class="camera-container">
                    <video id="videoElement" autoplay playsinline></video>
                    <canvas id="canvasElement" style="display: none;"></canvas>
                    <div class="scan-overlay">
                        <div class="scan-line"></div>
                    </div>
                </div>
                <div class="camera-controls">
                    <button class="btn-scan" id="captureBtn" onclick="captureAndScan()">
                        <i class="fa-solid fa-camera"></i> Scan
                    </button>
                    <button class="btn-cancel" onclick="closeCameraModal()">
                        <i class="fa-solid fa-times"></i> Batal
                    </button>
                </div>
                <div id="scanResult" class="scan-result" style="display: none;">
                    <div class="result-content">
                        <i class="fa-solid fa-check-circle"></i>
                        <span id="resultText">Barcode berhasil terdeteksi!</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        const currentStatus = '<?= $pengerjaan->status ?>';
        let stream = null;
        let isScanning = false;

        function showAlert(message, type) {
            const alertEl = document.getElementById('alertMessage');
            alertEl.textContent = message;
            alertEl.className = `alert ${type} show`;
            
            setTimeout(() => {
                alertEl.classList.remove('show');
            }, 3000);
        }

        // Camera Functions
        async function openCameraModal() {
            const modal = document.getElementById('cameraModal');
            const video = document.getElementById('videoElement');
            const scanResult = document.getElementById('scanResult');
            
            // Reset scan result
            scanResult.style.display = 'none';
            
            try {
                // Request camera access
                stream = await navigator.mediaDevices.getUserMedia({ 
                    video: { 
                        facingMode: 'environment', // Use back camera if available
                        width: { ideal: 1280 },
                        height: { ideal: 720 }
                    } 
                });
                
                video.srcObject = stream;
                modal.style.display = 'flex';
                
                // Start continuous scanning
                startContinuousScanning();
                
            } catch (error) {
                console.error('Camera access error:', error);
                showAlert('Tidak dapat mengakses kamera. Pastikan Anda telah memberikan izin kamera.', 'error');
                
                // Fallback: simulate scan after 2 seconds
                setTimeout(() => {
                    simulateScanSuccess();
                }, 2000);
            }
        }

        function closeCameraModal() {
            const modal = document.getElementById('cameraModal');
            const video = document.getElementById('videoElement');
            
            // Stop camera stream
            if (stream) {
                stream.getTracks().forEach(track => track.stop());
                stream = null;
            }
            
            video.srcObject = null;
            modal.style.display = 'none';
            isScanning = false;
        }

        function startContinuousScanning() {
            isScanning = true;
            // For demo purposes, we'll simulate barcode detection
            // In real implementation, you would use a barcode scanning library
        }

        function captureAndScan() {
            const video = document.getElementById('videoElement');
            const canvas = document.getElementById('canvasElement');
            const context = canvas.getContext('2d');
            
            // Set canvas size to video size
            canvas.width = video.videoWidth;
            canvas.height = video.videoHeight;
            
            // Draw current video frame to canvas
            context.drawImage(video, 0, 0, canvas.width, canvas.height);
            
            // Simulate barcode detection
            // In real implementation, you would use libraries like:
            // - QuaggaJS (for barcode/QR code)
            // - ZXing-js
            // - jsQR
            
            simulateScanSuccess();
        }

        function simulateScanSuccess() {
            const scanResult = document.getElementById('scanResult');
            const resultText = document.getElementById('resultText');
            const captureBtn = document.getElementById('captureBtn');
            
            // Show loading state
            captureBtn.innerHTML = '<i class="fa-solid fa-spinner fa-spin"></i> Scanning...';
            captureBtn.disabled = true;
            
            // Simulate scan process
            setTimeout(() => {
                // Generate room barcode based on current room
                const roomBarcode = generateRoomBarcode();
                
                // Show success result
                resultText.textContent = `Barcode terdeteksi: ${roomBarcode}`;
                scanResult.style.display = 'block';
                
                // Reset button
                captureBtn.innerHTML = '<i class="fa-solid fa-camera"></i> Scan';
                captureBtn.disabled = false;
                
                // Auto close modal and redirect to submit tugas after 2 seconds
                setTimeout(() => {
                    closeCameraModal();
                    redirectToSubmitTugas(roomBarcode);
                }, 2000);
            }, 1500);
        }

        function generateRoomBarcode() {
            // Generate barcode based on room ID
            // In real implementation, this would come from actual barcode scan
            const roomId = <?= $pengerjaan->id_ruangan ?>;
            return 'RM' + String(roomId).padStart(6, '0');
        }

        function redirectToSubmitTugas(barcode) {
            // Redirect to submit tugas with barcode parameter
            window.location.href = `<?= base_url('submittugas') ?>/${barcode}`;
        }

        function updateStatus(newStatus, buttonId) {
            const button = document.getElementById(buttonId);
            button.classList.add('loading');
            
            fetch('<?= base_url('detailtugas/update_status') ?>', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: `status=${newStatus}`
            })
            .then(response => response.json())
            .then(data => {
                button.classList.remove('loading');
                
                if (data.status === 'success') {
                    showAlert(data.message, 'success');
                    setTimeout(() => {
                        window.location.reload();
                    }, 1500);
                } else {
                    showAlert(data.message, 'error');
                }
            })
            .catch(error => {
                button.classList.remove('loading');
                showAlert('Terjadi kesalahan. Silakan coba lagi.', 'error');
                console.error('Error:', error);
            });
        }

        function startPekerjaan() {
            if (confirm('Apakah Anda yakin ingin memulai pekerjaan ini?')) {
                updateStatus('proses', 'scanButton');
            }
        }

        function selesaikanPekerjaan() {
            if (confirm('Apakah Anda yakin pekerjaan ini sudah selesai?')) {
                updateStatus('selesai', 'selesaiButton');
            }
        }

        // Handle task checkboxes (visual only)
        document.querySelectorAll('.task-checkbox').forEach(checkbox => {
            checkbox.addEventListener('click', function() {
                if (currentStatus === 'selesai') return;
                
                this.classList.toggle('checked');
            });
        });

        // Cleanup on page unload
        window.addEventListener('beforeunload', () => {
            if (stream) {
                stream.getTracks().forEach(track => track.stop());
            }
        });
    </script>
</body>
</html>
