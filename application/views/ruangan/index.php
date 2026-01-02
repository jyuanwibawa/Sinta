<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SINTA - Kelola Ruangan</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="<?= base_url('assets') ?>/css/parameter-sistem.css">
    <link rel="stylesheet" href="<?= base_url('assets') ?>/css/tugas-ruangan.css">
</head>
<body>
    <!-- Sidebar will be loaded here by JavaScript -->
    <div id="sidebar-container"></div>

    <main class="main-content">
       

        <div class="content-body">
            <div class="table-card">
                <div class="card-header-wrapper">
                    <div class="header-action-row">
                        <div class="header-title-group">
                            <h4 id="room-title">Daftar Ruangan</h4>
                            <p>Kelola informasi ruangan dan fasilitasnya</p>
                        </div>
                        <button class="btn-add" onclick="tambahRuangan()">
                            <i class="fa-solid fa-plus"></i> Tambah Ruangan
                        </button>
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="custom-table">
                        <thead>
                            <tr>
                                <th>Nama Ruangan</th>
                                <th>Lantai</th>
                                <th>Luas (m²)</th>
                                <th>Kapasitas</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="ruanganList">
                            <?php if (!empty($ruangan_list)): ?>
                                <?php foreach ($ruangan_list as $ruangan): ?>
                                    <tr>
                                        <td class="td-task-name"><?= htmlspecialchars($ruangan['nama_ruangan']) ?></td>
                                        <td><?= htmlspecialchars($ruangan['lantai']) ?></td>
                                        <td><?= number_format($ruangan['luas'], 2) ?></td>
                                        <td><?= number_format($ruangan['kapasitas']) ?></td>
                                        <td>
                                            <?php 
                                            $status_class = $ruangan['status'] == 'aktif' ? 'priority-high' : 'priority-med';
                                            $status_text = ucfirst($ruangan['status']);
                                            ?>
                                            <span class="pill-priority <?= $status_class ?>"><?= $status_text ?></span>
                                        </td>
                                        <td>
                                            <div class="action-cell">
                                                <button class="btn-icon btn-edit" onclick="editRuangan(<?= $ruangan['id_ruangan'] ?>)">
                                                    <i class="fa-solid fa-pen"></i>
                                                </button>
                                                <button class="btn-icon btn-delete" onclick="deleteRuangan(<?= $ruangan['id_ruangan'] ?>)">
                                                    <i class="fa-solid fa-trash"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="6" style="text-align: center; padding: 40px; color: #666;">
                                        <i class="fa-solid fa-inbox" style="font-size: 48px; margin-bottom: 15px; display: block;"></i>
                                        <p>Belum ada data ruangan</p>
                                        <p style="font-size: 14px; margin-top: 10px;">
                                            <button class="btn-add" onclick="tambahRuangan()">
                                                <i class="fa-solid fa-plus"></i> Tambah Ruangan Pertama
                                            </button>
                                        </p>
                                    </td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>

    <!-- Modal Tambah Ruangan -->
    <div id="tambahRuanganModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h4>Tambah Ruangan Baru</h4>
                <span class="close-modal">&times;</span>
            </div>
            <div class="modal-body">
                <form id="ruanganForm" class="form-container" onsubmit="return submitTambahRuangan(event)">
                    <div class="form-section">
                        <h5 class="form-section-title">Informasi Ruangan</h5>
                        <div class="form-group">
                            <div class="input-group">
                                <label for="namaRuangan">Nama Ruangan <span class="required">*</span></label>
                                <input type="text" id="namaRuangan" name="namaRuangan" placeholder="Contoh: Ruang Sidang A" required>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group">
                                <div class="input-group">
                                    <label for="lantai">Lantai <span class="required">*</span></label>
                                    <input type="text" id="lantai" name="lantai" placeholder="Contoh: Lantai 2" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="input-group">
                                    <label for="luas">Luas (m²) <span class="required">*</span></label>
                                    <input type="number" id="luas" name="luas" min="1" placeholder="0" required>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-section">
                        <h5 class="form-section-title">Detail Ruangan</h5>
                        <div class="form-row">
                            <div class="form-group">
                                <div class="input-group">
                                    <label for="kapasitas">Kapasitas <span class="required">*</span></label>
                                    <input type="number" id="kapasitas" name="kapasitas" min="1" placeholder="0" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="input-group">
                                    <label for="status">Status</label>
                                    <div class="select-wrapper">
                                        <select id="status" name="status">
                                            <option value="aktif">Aktif</option>
                                            <option value="maintenance">Maintenance</option>
                                        </select>
                                        <i class="fa-solid fa-chevron-down"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <label for="deskripsi">Deskripsi</label>
                                <textarea id="deskripsi" name="deskripsi" rows="3" placeholder="Deskripsi detail ruangan (opsional)"></textarea>
                                <div class="hint">Deskripsi membantu memberikan informasi tambahan tentang ruangan</div>
                            </div>
                        </div>
                    </div>

                    <div class="form-actions">
                        <button type="button" class="btn-cancel">
                            <i class="fa-solid fa-times"></i> Batal
                        </button>
                        <button type="submit" class="btn-submit">
                            <i class="fa-solid fa-save"></i> Simpan Ruangan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Edit Ruangan -->
    <div id="editRuanganModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h4>Edit Ruangan</h4>
                <span class="close-modal" onclick="tutupModal('editRuanganModal')">&times;</span>
            </div>
            <div class="modal-body">
                <form id="editRuanganForm" class="form-container" onsubmit="return submitEditRuangan(event)">
                    <input type="hidden" id="editRuanganId">
                    <div class="form-section">
                        <h5 class="form-section-title">Informasi Ruangan</h5>
                        <div class="form-group">
                            <div class="input-group">
                                <label for="editNamaRuangan">Nama Ruangan <span class="required">*</span></label>
                                <input type="text" id="editNamaRuangan" name="namaRuangan" placeholder="Contoh: Ruang Sidang A" required>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group">
                                <div class="input-group">
                                    <label for="editLantai">Lantai <span class="required">*</span></label>
                                    <input type="text" id="editLantai" name="lantai" placeholder="Contoh: Lantai 2" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="input-group">
                                    <label for="editLuas">Luas (m²) <span class="required">*</span></label>
                                    <input type="number" id="editLuas" name="luas" min="1" placeholder="0" required>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-section">
                        <h5 class="form-section-title">Detail Ruangan</h5>
                        <div class="form-row">
                            <div class="form-group">
                                <div class="input-group">
                                    <label for="editKapasitas">Kapasitas <span class="required">*</span></label>
                                    <input type="number" id="editKapasitas" name="kapasitas" min="1" placeholder="0" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="input-group">
                                    <label for="editStatus">Status</label>
                                    <div class="select-wrapper">
                                        <select id="editStatus" name="status">
                                            <option value="aktif">Aktif</option>
                                            <option value="maintenance">Maintenance</option>
                                        </select>
                                        <i class="fa-solid fa-chevron-down"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <label for="editDeskripsi">Deskripsi</label>
                                <textarea id="editDeskripsi" name="deskripsi" rows="3" placeholder="Deskripsi detail ruangan (opsional)"></textarea>
                                <div class="hint">Deskripsi membantu memberikan informasi tambahan tentang ruangan</div>
                            </div>
                        </div>
                    </div>

                    <div class="form-actions">
                        <button type="button" class="btn-cancel" onclick="tutupModal('editRuanganModal')">
                            <i class="fa-solid fa-times"></i> Batal
                        </button>
                        <button type="submit" class="btn-submit">
                            <i class="fa-solid fa-save"></i> Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        // Load sidebar and initialize after DOM is loaded
        document.addEventListener('DOMContentLoaded', function() {
            // Load sidebar
            if (typeof loadSidebar === 'function') {
                loadSidebar();
            } else {
                console.error('loadSidebar function not found');
            }
            
            // Initialize modal functionality
            initModalHandlers();
            
            // Initialize other scripts
            if (typeof initRuangan === 'function') {
                initRuangan();
            }
        });
        
        // Basic modal functionality
        function initModalHandlers() {
            // Close modal when clicking outside
            window.addEventListener('click', function(event) {
                if (event.target.classList.contains('modal')) {
                    event.target.classList.remove('show');
                }
            });

            // Close modal with close button
            document.querySelectorAll('.close-modal').forEach(button => {
                button.addEventListener('click', function() {
                    this.closest('.modal').classList.remove('show');
                });
            });
        }
        
        function tambahRuangan() {
            document.getElementById('tambahRuanganModal').classList.add('show');
        }
        
        function editRuangan(id) {
            console.log('Edit ruangan called with ID:', id);
            
            const url = `<?= base_url('ruangan/get_ruangan') ?>/${id}`;
            console.log('Requesting URL:', url);
            
            // Fetch ruangan data via AJAX
            fetch(url)
                .then(response => {
                    console.log('Response status:', response.status);
                    console.log('Response headers:', response.headers);
                    console.log('Response URL:', response.url);
                    
                    // Check if response is JSON
                    const contentType = response.headers.get('content-type');
                    console.log('Content-Type:', contentType);
                    
                    if (!contentType || !contentType.includes('application/json')) {
                        // Clone response to read text for debugging
                        return response.text().then(text => {
                            console.error('Non-JSON response received:', text.substring(0, 500));
                            console.error('Full response length:', text.length);
                            throw new Error('Server returned non-JSON response. Status: ' + response.status + ', Content-Type: ' + contentType);
                        });
                    }
                    return response.json();
                })
                .then(data => {
                    console.log('Parsed JSON data:', data);
                    
                    if (data.success) {
                        // Populate edit form with data
                        document.getElementById('editRuanganId').value = data.data.id_ruangan;
                        document.getElementById('editNamaRuangan').value = data.data.nama_ruangan;
                        document.getElementById('editLantai').value = data.data.lantai;
                        document.getElementById('editLuas').value = data.data.luas;
                        document.getElementById('editKapasitas').value = data.data.kapasitas;
                        document.getElementById('editStatus').value = data.data.status;
                        document.getElementById('editDeskripsi').value = data.data.deskripsi || '';
                        
                        // Show modal
                        document.getElementById('editRuanganModal').classList.add('show');
                    } else {
                        showNotification('Gagal memuat data ruangan: ' + (data.error || 'Unknown error'), 'error');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    showNotification('Terjadi kesalahan saat memuat data: ' + error.message, 'error');
                });
        }
        
        function deleteRuangan(id) {
            if (confirm('Apakah Anda yakin ingin menghapus ruangan ini?')) {
                // Send delete request via AJAX
                fetch(`<?= base_url('ruangan/delete') ?>/${id}`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                })
                .then(response => {
                    // Check if response is JSON
                    const contentType = response.headers.get('content-type');
                    if (!contentType || !contentType.includes('application/json')) {
                        throw new Error('Server returned non-JSON response');
                    }
                    return response.json();
                })
                .then(data => {
                    if (data.success) {
                        // Remove row from table
                        const row = document.querySelector(`tr:has(button[onclick*="deleteRuangan(${id})"])`);
                        if (row) {
                            row.remove();
                        }
                        
                        // Show success message
                        showNotification('Ruangan berhasil dihapus', 'success');
                        
                        // Reload page after short delay
                        setTimeout(() => {
                            window.location.reload();
                        }, 1000);
                    } else {
                        showNotification('Gagal menghapus ruangan: ' + (data.error || 'Unknown error'), 'error');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    showNotification('Terjadi kesalahan saat menghapus ruangan: ' + error.message, 'error');
                });
            }
        }
        
        function submitTambahRuangan(event) {
            event.preventDefault();
            
            const formData = new FormData(event.target);
            
            fetch('<?= base_url('ruangan/add') ?>', {
                method: 'POST',
                body: formData
            })
            .then(response => {
                // Check if response is JSON
                const contentType = response.headers.get('content-type');
                if (!contentType || !contentType.includes('application/json')) {
                    throw new Error('Server returned non-JSON response');
                }
                return response.json();
            })
            .then(data => {
                console.log('Parsed JSON data:', data);
                
                if (data.success) {
                    showNotification('Ruangan berhasil ditambahkan', 'success');
                    tutupModal('tambahRuanganModal');
                    event.target.reset();
                    
                    // Reload page after short delay
                    setTimeout(() => {
                        window.location.reload();
                    }, 1500);
                } else {
                    // Handle validation errors
                    if (data.errors && Object.keys(data.errors).length > 0) {
                        let errorMessages = [];
                        for (let field in data.errors) {
                            errorMessages.push(data.errors[field]);
                        }
                        showNotification('Validation error: ' + errorMessages.join(', '), 'error');
                    } else {
                        showNotification(data.error || 'Gagal menambahkan ruangan', 'error');
                    }
                }
            })
            .catch(error => {
                console.error('Error:', error);
                showNotification('Terjadi kesalahan saat menambahkan ruangan: ' + error.message, 'error');
            });
        }
        
        function submitEditRuangan(event) {
            event.preventDefault();
            
            const formData = new FormData(event.target);
            const id = document.getElementById('editRuanganId').value;
            
            console.log('Submit edit ruangan called with ID:', id);
            console.log('Form data:', Object.fromEntries(formData));
            
            const url = `<?= base_url('ruangan/edit') ?>/${id}`;
            console.log('Requesting URL:', url);
            
            fetch(url, {
                method: 'POST',
                body: formData
            })
            .then(response => {
                console.log('Response status:', response.status);
                console.log('Response headers:', response.headers);
                console.log('Response URL:', response.url);
                
                // Check if response is JSON
                const contentType = response.headers.get('content-type');
                console.log('Content-Type:', contentType);
                
                if (!contentType || !contentType.includes('application/json')) {
                    // Clone response to read text for debugging
                    return response.text().then(text => {
                        console.error('Non-JSON response received:', text.substring(0, 500));
                        console.error('Full response length:', text.length);
                        throw new Error('Server returned non-JSON response. Status: ' + response.status + ', Content-Type: ' + contentType);
                    });
                }
                return response.json();
            })
            .then(data => {
                console.log('Parsed JSON data:', data);
                
                if (data.success) {
                    showNotification('Ruangan berhasil diperbarui', 'success');
                    tutupModal('editRuanganModal');
                    
                    // Reload page after short delay
                    setTimeout(() => {
                        window.location.reload();
                    }, 1500);
                } else {
                    // Handle validation errors
                    if (data.errors && Object.keys(data.errors).length > 0) {
                        let errorMessages = [];
                        for (let field in data.errors) {
                            errorMessages.push(data.errors[field]);
                        }
                        showNotification('Validation error: ' + errorMessages.join(', '), 'error');
                    } else {
                        showNotification(data.error || 'Gagal memperbarui ruangan', 'error');
                    }
                }
            })
            .catch(error => {
                console.error('Error:', error);
                showNotification('Terjadi kesalahan saat memperbarui ruangan: ' + error.message, 'error');
            });
        }
        
        function showNotification(message, type = 'info') {
            // Create notification element
            const notification = document.createElement('div');
            notification.className = `alert alert-${type}`;
            notification.style.cssText = `
                position: fixed;
                top: 20px;
                right: 20px;
                z-index: 9999;
                padding: 15px 20px;
                border-radius: 6px;
                color: white;
                font-weight: 500;
                box-shadow: 0 4px 12px rgba(0,0,0,0.15);
                animation: slideIn 0.3s ease-out;
            `;
            
            // Set background color based on type
            if (type === 'success') {
                notification.style.backgroundColor = '#28a745';
            } else if (type === 'error') {
                notification.style.backgroundColor = '#dc3545';
            } else {
                notification.style.backgroundColor = '#17a2b8';
            }
            
            notification.textContent = message;
            document.body.appendChild(notification);
            
            // Auto remove after 3 seconds
            setTimeout(() => {
                if (notification.parentNode) {
                    notification.parentNode.removeChild(notification);
                }
            }, 3000);
        }
        
        function tutupModal(modalId) {
            if (modalId) {
                document.getElementById(modalId).classList.remove('show');
            } else {
                document.querySelectorAll('.modal.show').forEach(modal => {
                    modal.classList.remove('show');
                });
            }
        }
    </script>
</body>
</html>
