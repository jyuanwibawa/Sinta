<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Submit Tugas - SINTA</title>
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
            padding-bottom: 30px; 
        }

        /* --- HEADER SECTION --- */
        .header {
            background-color: #131b2e;
            color: white;
            padding: 20px 20px 60px 20px;
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
            padding: 0 20px;
            margin-top: 10px;
            width: 100%;
            max-width: 500px;
            align-self: center;
        }

        /* --- CARD STYLES --- */
        .card {
            background-color: white;
            border-radius: 16px;
            padding: 20px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.05);
            margin-bottom: 15px;
        }

        .card-title {
            font-size: 16px;
            font-weight: 600;
            color: #1f2937;
            margin-bottom: 10px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .card-title i {
            background-color: #131b2e;
            color: white;
            width: 28px;
            height: 28px;
            border-radius: 8px;
            font-size: 12px;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        /* --- INFO TUGAS --- */
        .meta-row {
            display: flex;
            align-items: center;
            gap: 8px;
            color: #6b7280;
            font-size: 13px;
            margin-bottom: 6px;
        }

        .desc-box {
            margin-top: 15px;
            background-color: #f9fafb;
            border: 1px solid #f3f4f6;
            padding: 15px;
            border-radius: 12px;
            margin-bottom: 15px;
        }

        .desc-label {
            font-size: 12px;
            color: #6b7280;
            margin-bottom: 4px;
            display: block;
        }

        .desc-text {
            font-size: 14px;
            color: #1f2937;
        }

        /* Status: Sedang Dikerjakan (Biru) */
        .status-row {
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 13px;
            color: #4b5563;
            border-top: 1px solid #f3f4f6;
            padding-top: 15px;
        }

        .status-pill.working {
            background-color: #e0f2fe; 
            color: #0284c7; 
            border: 1px solid #bae6fd;
            padding: 6px 16px;
            border-radius: 20px;
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .status-dot.blue {
            width: 8px;
            height: 8px;
            background-color: #0284c7;
            border-radius: 50%;
        }

        /* --- UPLOAD FOTO --- */
        .task-upload-section {
            margin-bottom: 20px;
        }

        .task-header {
            display: flex;
            flex-direction: column;
            gap: 4px;
            margin-bottom: 15px;
        }

        .task-number {
            font-size: 14px;
            font-weight: 600;
            color: #1f2937;
        }

        .task-standar {
            font-size: 12px;
            color: #6b7280;
            font-style: italic;
        }

        .task-divider {
            border: none;
            height: 1px;
            background-color: #e5e7eb;
            margin: 20px 0;
        }

        .upload-section-label {
            font-size: 13px;
            color: #4b5563;
            margin-top: 15px;
            margin-bottom: 8px;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .upload-box {
            background-color: #f8fafc;
            border: 2px solid #e2e8f0;
            border-radius: 12px;
            height: 180px;
            display: flex;
            justify-content: center;
            align-items: center;
            cursor: pointer;
            transition: border-color 0.2s;
            position: relative;
            overflow: hidden;
            text-align: center;
        }

        .upload-box:hover {
            border-color: #cbd5e1;
        }

        .upload-content {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            width: 100%;
        }

        .upload-icon {
            font-size: 24px;
            color: #64748b;
            margin-bottom: 10px;
            border: 2px solid #cbd5e1;
            width: 48px;
            height: 48px;
            display: flex;
            justify-content: center;
            align-items: center;
            border-radius: 10px;
            margin-left: auto; 
            margin-right: auto;
        }

        .upload-text {
            font-size: 13px;
            color: #475569;
            font-weight: 500;
        }

        .upload-subtext {
            font-size: 11px;
            color: #94a3b8;
            margin-top: 4px;
        }

        .preview-img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            position: absolute;
            top: 0;
            left: 0;
            display: none; 
        }

        /* --- CATATAN --- */
        .notes-area {
            width: 100%;
            border: 1px solid #d1d5db;
            border-radius: 10px;
            padding: 12px;
            font-size: 13px;
            resize: none;
            height: 100px;
            outline: none;
            color: #1f2937;
        }

        .notes-area::placeholder {
            color: #9ca3af;
        }

        .notes-area:focus {
            border-color: #131b2e;
        }

        /* --- BUTTONS --- */
        .btn-group {
            display: flex;
            flex-direction: column;
            gap: 12px;
            margin-top: 10px;
        }

        .btn {
            width: 100%;
            padding: 14px;
            border-radius: 10px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 8px;
            transition: opacity 0.2s;
        }

        .btn:active {
            opacity: 0.8;
        }

        .btn-success {
            background-color: #008855; 
            color: white;
            border: none;
            box-shadow: 0 4px 6px rgba(0, 136, 85, 0.2);
        }

        .btn-outline {
            background-color: white;
            color: #4b5563;
            border: 1px solid #d1d5db;
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

        /* Animasi */
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .card {
            animation: fadeIn 0.3s ease-out;
        }
    </style>
</head>
<body>
    <header class="header">
        <div class="nav-row">
            <a href="<?= base_url('detailtugas/detail') ?>" class="back-link">
                <i class="fa-solid fa-arrow-left"></i> Kembali
            </a>
        </div>
        <h1 class="page-title">Submit Tugas</h1>
    </header>

    <div class="container">
        <div class="alert" id="alertMessage"></div>
        
        <div class="card">
            <h2 class="card-title" id="taskTitle"><?= htmlspecialchars($pengerjaan->nama_ruangan) ?></h2>
            
            <div class="meta-row">
                <i class="fa-solid fa-location-dot"></i>
                <span id="taskLocation"><?= htmlspecialchars($pengerjaan->nama_ruangan) ?> • Lantai <?= htmlspecialchars($pengerjaan->lantai ?? '-') ?></span>
            </div>
            
            <div class="meta-row">
                <i class="fa-regular fa-clock"></i>
                <span id="taskTime">Jadwal: <?= date('H:i', strtotime($pengerjaan->created_at)) ?></span>
            </div>

            <?php 
            // Parse tugas data
            $tugas_data = json_decode($pengerjaan->tugas, true);
            $first_tugas = is_array($tugas_data) && !empty($tugas_data) ? $tugas_data[0] : $pengerjaan->tugas;
            ?>

            <div class="desc-box">
                <span class="desc-label">Deskripsi Pekerjaan:</span>
                <p class="desc-text" id="taskDesc"><?= htmlspecialchars($first_tugas) ?></p>
            </div>

            <div class="status-row">
                <span>Status:</span>
                <div class="status-pill working">
                    <span class="status-dot blue"></span> Sedang Dikerjakan
                </div>
            </div>
        </div>

        <div class="card">
            <h2 class="card-title">
                <i class="fa-solid fa-camera"></i> Dokumentasi Foto
            </h2>

            <?php 
            // Parse tugas data
            $tugas_data = json_decode($pengerjaan->tugas, true);
            $standar_data = json_decode($pengerjaan->standar, true);
            
            if (!is_array($tugas_data)) {
                $tugas_data = [$pengerjaan->tugas];
                $standar_data = [$pengerjaan->standar];
            }
            ?>

            <?php foreach($tugas_data as $index => $tugas): ?>
                <div class="task-upload-section">
                    <div class="task-header">
                        <span class="task-number"><?= $index + 1 ?>. <?= htmlspecialchars($tugas) ?></span>
                        <?php if(isset($standar_data[$index]) && !empty($standar_data[$index])): ?>
                            <span class="task-standar">Standar: <?= htmlspecialchars($standar_data[$index]) ?></span>
                        <?php endif; ?>
                    </div>

                    <div class="upload-section-label">
                        <i class="fa-regular fa-image"></i> Foto Sebelum Dibersihkan
                    </div>
                    <div class="upload-box" onclick="triggerUpload('input-before-<?= $index ?>', 'preview-before-<?= $index ?>', 'content-before-<?= $index ?>')">
                        <div id="content-before-<?= $index ?>" class="upload-content">
                            <div class="upload-icon"><i class="fa-solid fa-arrow-up-from-bracket"></i></div>
                            <div class="upload-text">Tap untuk unggah foto</div>
                            <div class="upload-subtext">PNG, JPG hingga 10MB</div>
                        </div>
                        <img id="preview-before-<?= $index ?>" class="preview-img" src="" alt="Preview">
                        <input type="file" id="input-before-<?= $index ?>" hidden accept="image/*" onchange="handleFile(this, 'preview-before-<?= $index ?>', 'content-before-<?= $index ?>', 'before', <?= $index ?>)">
                    </div>

                    <div class="upload-section-label">
                        <i class="fa-regular fa-image"></i> Foto Sesudah Dibersihkan
                    </div>
                    <div class="upload-box" onclick="triggerUpload('input-after-<?= $index ?>', 'preview-after-<?= $index ?>', 'content-after-<?= $index ?>')">
                        <div id="content-after-<?= $index ?>" class="upload-content">
                            <div class="upload-icon"><i class="fa-solid fa-arrow-up-from-bracket"></i></div>
                            <div class="upload-text">Tap untuk unggah foto</div>
                            <div class="upload-subtext">PNG, JPG hingga 10MB</div>
                        </div>
                        <img id="preview-after-<?= $index ?>" class="preview-img" src="" alt="Preview">
                        <input type="file" id="input-after-<?= $index ?>" hidden accept="image/*" onchange="handleFile(this, 'preview-after-<?= $index ?>', 'content-after-<?= $index ?>', 'after', <?= $index ?>)">
                    </div>
                </div>

                <?php if($index < count($tugas_data) - 1): ?>
                    <hr class="task-divider">
                <?php endif; ?>
            <?php endforeach; ?>
        </div>

        <div class="card">
            <h2 class="card-title">Catatan Tambahan</h2>
            <textarea class="notes-area" id="taskNotes" placeholder="Tulis catatan tentang kondisi ruangan, kendala yang dihadapi, atau informasi penting lainnya..."></textarea>
        </div>

        <div class="btn-group">
            <button class="btn btn-success" id="submitBtn" onclick="selesaikanTugas()">
                <i class="fa-solid fa-check"></i> Selesaikan Tugas
            </button>
            <button class="btn btn-outline" onclick="window.history.back()">
                Batalkan
            </button>
        </div>
    </div>

    <script>
        // Store uploaded files for each task
        const uploadedFiles = {};
        
        function showAlert(message, type) {
            const alertEl = document.getElementById('alertMessage');
            alertEl.textContent = message;
            alertEl.className = `alert ${type} show`;
            
            setTimeout(() => {
                alertEl.classList.remove('show');
            }, 3000);
        }

        function triggerUpload(inputId, previewId, contentId) {
            document.getElementById(inputId).click();
        }

        function handleFile(input, previewId, contentId, type, taskIndex) {
            const file = input.files[0];
            const preview = document.getElementById(previewId);
            const content = document.getElementById(contentId);
            
            if (file) {
                // Check file size (max 10MB)
                if (file.size > 10 * 1024 * 1024) {
                    showAlert('Ukuran file terlalu besar. Maksimal 10MB.', 'error');
                    input.value = '';
                    return;
                }
                
                // Check file type
                if (!file.type.startsWith('image/')) {
                    showAlert('File harus berupa gambar.', 'error');
                    input.value = '';
                    return;
                }
                
                // Read and display image
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.style.display = 'block';
                    content.style.display = 'none';
                    
                    // Store file data
                    if (!uploadedFiles[taskIndex]) {
                        uploadedFiles[taskIndex] = {};
                    }
                    uploadedFiles[taskIndex][type] = file;
                };
                reader.readAsDataURL(file);
            }
        }

        function selesaikanTugas() {
            const taskCount = <?= count($tugas_data) ?>;
            
            // Validate all required photos are uploaded
            let allPhotosUploaded = true;
            for (let i = 0; i < taskCount; i++) {
                if (!uploadedFiles[i] || !uploadedFiles[i].before || !uploadedFiles[i].after) {
                    allPhotosUploaded = false;
                    break;
                }
            }
            
            if (!allPhotosUploaded) {
                showAlert('Harap unggah foto sebelum dan sesudah pembersihan untuk semua tugas.', 'error');
                return;
            }
            
            const notes = document.getElementById('taskNotes').value;
            const submitBtn = document.getElementById('submitBtn');
            
            // Show loading state
            submitBtn.innerHTML = '<i class="fa-solid fa-spinner fa-spin"></i> Menyimpan...';
            submitBtn.disabled = true;
            
            // Create form data
            const formData = new FormData();
            
            // Add all uploaded files
            for (let i = 0; i < taskCount; i++) {
                formData.append(`foto_before_${i}`, uploadedFiles[i].before);
                formData.append(`foto_after_${i}`, uploadedFiles[i].after);
            }
            
            formData.append('task_count', taskCount);
            formData.append('notes', notes);
            
            // Debug: Log form data
            console.log('Submitting form data:');
            for (let pair of formData.entries()) {
                console.log(pair[0], pair[1]);
            }
            
            // Submit to server
            fetch('<?= base_url('submittugas/complete') ?>', {
                method: 'POST',
                body: formData
            })
            .then(response => {
                console.log('Response status:', response.status);
                console.log('Response headers:', response.headers);
                
                // Check if response is JSON
                const contentType = response.headers.get('content-type');
                if (!contentType || !contentType.includes('application/json')) {
                    throw new Error('Server returned non-JSON response');
                }
                
                return response.json();
            })
            .then(data => {
                console.log('Response data:', data);
                
                if (data.status === 'success') {
                    showAlert(data.message, 'success');
                    setTimeout(() => {
                        window.location.href = '<?= base_url('dashboard_user') ?>';
                    }, 2000);
                } else {
                    showAlert(data.message, 'error');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                
                // Try to read response as text for debugging
                fetch('<?= base_url('submittugas/complete') ?>', {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.text())
                .then(text => {
                    console.error('Server response:', text);
                    if (text.includes('<!DOCTYPE')) {
                        showAlert('Terjadi error server. Silakan coba lagi atau hubungi admin.', 'error');
                    } else {
                        showAlert('Terjadi kesalahan. Silakan coba lagi.', 'error');
                    }
                })
                .catch(() => {
                    showAlert('Terjadi kesalahan. Silakan coba lagi.', 'error');
                });
            })
            .finally(() => {
                // Reset button
                submitBtn.innerHTML = '<i class="fa-solid fa-check"></i> Selesaikan Tugas';
                submitBtn.disabled = false;
            });
        }
    </script>
</body>
</html>
