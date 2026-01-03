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
                <span><?= htmlspecialchars($pengerjaan->nama_ruangan) ?> • Lantai <?= htmlspecialchars($pengerjaan->lantai ?? '-') ?></span>
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

            <button class="btn-action" id="scanButton" onclick="startPekerjaan()">
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

    <script>
        const pengerjaanId = <?= $pengerjaan->id_pengerjaan ?>;
        const currentStatus = '<?= $pengerjaan->status ?>';

        function showAlert(message, type) {
            const alertEl = document.getElementById('alertMessage');
            alertEl.textContent = message;
            alertEl.className = `alert ${type} show`;
            
            setTimeout(() => {
                alertEl.classList.remove('show');
            }, 3000);
        }

        function updateStatus(newStatus, buttonId) {
            const button = document.getElementById(buttonId);
            button.classList.add('loading');
            
            fetch('<?= base_url('detailtugas/update_status') ?>', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: `id_pengerjaan=${pengerjaanId}&status=${newStatus}`
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
    </script>
</body>
</html>
