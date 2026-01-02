<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SINTA - Detail Tugas Ruangan</title>
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
                    <a href="<?= base_url('pengerjaan') ?>" class="back-link">
                        <i class="fa-solid fa-arrow-left"></i> Kembali ke Daftar Pengerjaan
                    </a>

                    <div class="header-action-row">
                        <div class="header-title-group">
                            <h4 id="room-title">Daftar Tugas</h4>
                            <p>Kelola tugas pembersihan untuk ruangan ini</p>
                        </div>
                        <button class="btn-add" onclick="tambahTugas()">
                            <i class="fa-solid fa-plus"></i> Tambah Tugas
                        </button>
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="custom-table">
                        <thead>
                            <tr>
                                <th>Nama Tugas</th>
                                <th>Deskripsi</th>
                                <th>Frekuensi</th>
                                <th>Durasi (menit)</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="task-list">
                            <!-- Tasks will be loaded here by JavaScript -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Tambah Tugas -->
    <div id="tambahTugasModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h4>Tambah Tugas Baru</h4>
                <span class="close-modal">&times;</span>
            </div>
            <div class="modal-body">
                <form id="tugasForm" class="form-container">
                    <div class="form-section">
                        <h5 class="form-section-title">Informasi Tugas</h5>
                        <div class="form-group">
                            <div class="input-group">
                                <label for="namaTugas">Nama Tugas <span class="required">*</span></label>
                                <input type="text" id="namaTugas" name="namaTugas" placeholder="Contoh: Menyapu Lantai" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <label for="deskripsi">Deskripsi Tugas</label>
                                <textarea id="deskripsi" name="deskripsi" rows="3" placeholder="Deskripsi detail tugas (opsional)"></textarea>
                                <div class="hint">Deskripsi membantu petugas memahami tugas dengan lebih baik</div>
                            </div>
                        </div>
                    </div>

                    <div class="form-section">
                        <h5 class="form-section-title">Detail Pelaksanaan</h5>
                        <div class="form-row">
                            <div class="form-group">
                                <div class="input-group">
                                    <label for="frekuensi">Frekuensi <span class="required">*</span></label>
                                    <div class="select-wrapper">
                                        <select id="frekuensi" name="frekuensi" required>
                                            <option value="">Pilih Frekuensi</option>
                                            <option value="Harian">Harian</option>
                                            <option value="Mingguan">Mingguan</option>
                                            <option value="Bulanan">Bulanan</option>
                                        </select>
                                        <i class="fa-solid fa-chevron-down"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="input-group">
                                    <label for="durasi">Durasi (menit) <span class="required">*</span></label>
                                    <div class="input-with-icon">
                                        <input type="number" id="durasi" name="durasi" min="1" placeholder="0" required>
                                        <span class="input-icon">menit</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-section">
                        <h5 class="form-section-title">Kategori</h5>
                        <div class="form-group">
                            <div class="input-group">
                                <label for="kategori">Kategori Tugas</label>
                                <div class="select-wrapper">
                                    <select id="kategori" name="kategori">
                                        <option value="">Pilih Kategori</option>
                                        <option value="Kebersihan">Kebersihan</option>
                                        <option value="Perawatan">Perawatan</option>
                                        <option value="Pengecekan">Pengecekan</option>
                                        <option value="Lainnya">Lainnya</option>
                                    </select>
                                    <i class="fa-solid fa-chevron-down"></i>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-actions">
                        <button type="button" class="btn-cancel">
                            <i class="fa-solid fa-times"></i> Batal
                        </button>
                        <button type="submit" class="btn-submit">
                            <i class="fa-solid fa-save"></i> Simpan Tugas
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Edit Tugas -->
    <div id="editTugasModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h4>Edit Tugas</h4>
                <span class="close-modal" onclick="tutupModal('editTugasModal')">&times;</span>
            </div>
            <div class="modal-body">
                <form id="editTugasForm" class="form-container">
                    <input type="hidden" id="editTugasId">
                    <div class="form-section">
                        <h5 class="form-section-title">Informasi Tugas</h5>
                        <div class="form-group">
                            <div class="input-group">
                                <label for="editNamaTugas">Nama Tugas <span class="required">*</span></label>
                                <input type="text" id="editNamaTugas" name="namaTugas" placeholder="Contoh: Menyapu Lantai" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <label for="editDeskripsi">Deskripsi Tugas</label>
                                <textarea id="editDeskripsi" name="deskripsi" rows="3" placeholder="Deskripsi detail tugas (opsional)"></textarea>
                                <div class="hint">Deskripsi membantu petugas memahami tugas dengan lebih baik</div>
                            </div>
                        </div>
                    </div>

                    <div class="form-section">
                        <h5 class="form-section-title">Detail Pelaksanaan</h5>
                        <div class="form-row">
                            <div class="form-group">
                                <div class="input-group">
                                    <label for="editFrekuensi">Frekuensi <span class="required">*</span></label>
                                    <div class="select-wrapper">
                                        <select id="editFrekuensi" name="frekuensi" required>
                                            <option value="">Pilih Frekuensi</option>
                                            <option value="Harian">Harian</option>
                                            <option value="Mingguan">Mingguan</option>
                                            <option value="Bulanan">Bulanan</option>
                                        </select>
                                        <i class="fa-solid fa-chevron-down"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="input-group">
                                    <label for="editDurasi">Durasi (menit) <span class="required">*</span></label>
                                    <input type="number" id="editDurasi" name="durasi" min="1" placeholder="0" required>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <label for="editKategori">Kategori</label>
                                <div class="select-wrapper">
                                    <select id="editKategori" name="kategori">
                                        <option value="">Pilih Kategori</option>
                                        <option value="Bersih-bersih">Bersih-bersih</option>
                                        <option value="Pengecekan">Pengecekan</option>
                                        <option value="Perawatan">Perawatan</option>
                                        <option value="Lainnya">Lainnya</option>
                                    </select>
                                    <i class="fa-solid fa-chevron-down"></i>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-actions">
                        <button type="button" class="btn-cancel" onclick="tutupModal('editTugasModal')">
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
            if (typeof initTugasRuangan === 'function') {
                initTugasRuangan();
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
        
        function tambahTugas() {
            document.getElementById('tambahTugasModal').classList.add('show');
        }
        
        function editTugas(button) {
            // Get row data
            const row = button.closest('tr');
            const cells = row.getElementsByTagName('td');
            
            // Populate edit form with row data
            document.getElementById('editTugasId').value = '1'; // Set appropriate ID
            document.getElementById('editNamaTugas').value = cells[0].textContent;
            document.getElementById('editDeskripsi').value = cells[1].textContent;
            // Set other fields as needed
            
            // Show modal
            document.getElementById('editTugasModal').classList.add('show');
        }
        
        function deleteTugas(button) {
            if (confirm('Apakah Anda yakin ingin menghapus tugas ini?')) {
                const row = button.closest('tr');
                row.remove();
                alert('Tugas berhasil dihapus!');
            }
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
