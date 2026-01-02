<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SINTA - Standar Kebersihan</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="<?= base_url('assets') ?>/css/parameter-sistem.css">
    <link rel="stylesheet" href="<?= base_url('assets') ?>/css/standar-kebersihan.css">
</head>
<body>
    <div class="main-content">
        <div class="content-body">
            <div class="table-card">
                <div class="card-header-wrapper">
                    <a href="<?= base_url('ruangan') ?>" class="back-link">
                        <i class="fa-solid fa-arrow-left"></i> Kembali ke Daftar Ruangan
                    </a>

                    <div class="header-action-row">
                        <div class="header-title-group">
                            <h4>Standar Kebersihan untuk <span id="roomName" class="room-title">Ruang Sidang A</span></h4>
                            <p>Kelola standar kebersihan khusus untuk ruangan ini</p>
                        </div>
                        <button class="btn-add-green" onclick="tambahStandar()">
                            <i class="fa-solid fa-plus"></i> Tambah Standar
                        </button>
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="custom-table">
                        <thead>
                            <tr>
                                <th style="width: 25%;">Kriteria</th>
                                <th style="width: 45%;">Keterangan</th>
                                <th style="width: 15%;">Nilai Maksimal</th>
                                <th style="width: 15%;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="standarList">
                            <tr>
                                <td class="td-criteria">Lantai bersih</td>
                                <td class="td-desc">Lantai harus bebas dari debu, kotoran, dan noda</td>
                                <td class="td-score">10</td>
                                <td>
                                    <div class="action-cell">
                                        <button class="btn-icon btn-edit" onclick="editStandar(this)">
                                            <i class="fa-solid fa-pen"></i>
                                        </button>
                                        <button class="btn-icon btn-delete" onclick="deleteStandar(this)">
                                            <i class="fa-solid fa-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="td-criteria">Meja dan kursi rapi</td>
                                <td class="td-desc">Meja dan kursi harus dalam kondisi rapi dan bersih</td>
                                <td class="td-score">8</td>
                                <td>
                                    <div class="action-cell">
                                        <button class="btn-icon btn-edit" onclick="editStandar(this)">
                                            <i class="fa-solid fa-pen"></i>
                                        </button>
                                        <button class="btn-icon btn-delete" onclick="deleteStandar(this)">
                                            <i class="fa-solid fa-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="td-criteria">Jendela bersih</td>
                                <td class="td-desc">Jendela harus bebas dari debu dan noda</td>
                                <td class="td-score">7</td>
                                <td>
                                    <div class="action-cell">
                                        <button class="btn-icon btn-edit" onclick="editStandar(this)">
                                            <i class="fa-solid fa-pen"></i>
                                        </button>
                                        <button class="btn-icon btn-delete" onclick="deleteStandar(this)">
                                            <i class="fa-solid fa-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Tambah Standar -->
    <div id="tambahStandarModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h4><i class="fa-solid fa-plus-circle"></i> Tambah Standar Baru</h4>
                <span class="close-modal">&times;</span>
            </div>
            <div class="modal-body">
                <form id="standarForm" class="form-container">
                    <div class="form-group">
                        <label for="kriteria">Kriteria <span class="required">*</span></label>
                        <input type="text" id="kriteria" name="kriteria" required 
                               placeholder="Contoh: Lantai bersih tanpa debu">
                    </div>
                    
                    <div class="form-group">
                        <label for="keterangan">Keterangan <span class="required">*</span></label>
                        <textarea id="keterangan" name="keterangan" rows="3" required
                                 placeholder="Deskripsi detail kriteria kebersihan"></textarea>
                    </div>
                    
                    <div class="form-group">
                        <label for="nilai">Nilai Maksimal <span class="required">*</span></label>
                        <input type="number" id="nilai" name="nilai" min="1" max="100" value="10" required>
                    </div>
                    
                    <div class="form-actions">
                        <button type="button" class="btn-cancel" onclick="tutupModal()">Batal</button>
                        <button type="submit" class="btn-submit">Simpan Standar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Edit Standar -->
    <div id="editStandarModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h4><i class="fa-solid fa-pen-to-square"></i> Edit Standar</h4>
                <span class="close-modal" onclick="tutupModal('editStandarModal')">&times;</span>
            </div>
            <div class="modal-body">
                <form id="editStandarForm" class="form-container">
                    <input type="hidden" id="editStandarId">
                    <div class="form-group">
                        <label for="editKriteria">Kriteria <span class="required">*</span></label>
                        <input type="text" id="editKriteria" name="kriteria" required 
                               placeholder="Contoh: Lantai bersih tanpa debu">
                    </div>
                    
                    <div class="form-group">
                        <label for="editKeterangan">Keterangan <span class="required">*</span></label>
                        <textarea id="editKeterangan" name="keterangan" rows="3" required
                                 placeholder="Deskripsi detail kriteria kebersihan"></textarea>
                    </div>
                    
                    <div class="form-group">
                        <label for="editNilai">Nilai Maksimal <span class="required">*</span></label>
                        <input type="number" id="editNilai" name="nilai" min="1" max="100" required>
                    </div>
                    
                    <div class="form-actions">
                        <button type="button" class="btn-cancel" onclick="tutupModal('editStandarModal')">Batal</button>
                        <button type="submit" class="btn-submit">Simpan Perubahan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        // Initialize page after DOM is loaded
        document.addEventListener('DOMContentLoaded', function() {
            // Initialize modal functionality
            initModalHandlers();
            
            // Initialize form handlers
            initFormHandlers();
            
            // Initialize other scripts
            if (typeof initStandarKebersihan === 'function') {
                initStandarKebersihan();
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
        
        // Form submission handlers
        function initFormHandlers() {
            // Handle tambah standar form
            const tambahForm = document.getElementById('standarForm');
            if (tambahForm) {
                tambahForm.addEventListener('submit', function(e) {
                    e.preventDefault();
                    
                    // Get form values
                    const kriteria = document.getElementById('kriteria').value;
                    const keterangan = document.getElementById('keterangan').value;
                    const nilai = document.getElementById('nilai').value;
                    
                    // Add new row to table
                    addNewStandar(kriteria, keterangan, nilai);
                    
                    // Reset form and close modal
                    this.reset();
                    tutupModal('tambahStandarModal');
                    alert('Standar berhasil ditambahkan!');
                });
            }
            
            // Handle edit standar form
            const editForm = document.getElementById('editStandarForm');
            if (editForm) {
                editForm.addEventListener('submit', function(e) {
                    e.preventDefault();
                    alert('Perubahan berhasil disimpan!');
                    tutupModal('editStandarModal');
                });
            }
        }
        
        // Add new standard to table
        function addNewStandar(kriteria, keterangan, nilai) {
            const tableBody = document.getElementById('standarList');
            const newRow = document.createElement('tr');
            
            newRow.innerHTML = `
                <td class="td-criteria">${kriteria}</td>
                <td class="td-desc">${keterangan}</td>
                <td class="td-score">${nilai}</td>
                <td>
                    <div class="action-cell">
                        <button class="btn-icon btn-edit" onclick="editStandar(this)">
                            <i class="fa-solid fa-pen"></i>
                        </button>
                        <button class="btn-icon btn-delete" onclick="deleteStandar(this)">
                            <i class="fa-solid fa-trash"></i>
                        </button>
                    </div>
                </td>
            `;
            
            tableBody.appendChild(newRow);
        }
        
        function tambahStandar() {
            document.getElementById('tambahStandarModal').classList.add('show');
        }
        
        function editStandar(button) {
            // Get row data
            const row = button.closest('tr');
            const cells = row.getElementsByTagName('td');
            
            // Populate edit form with row data
            document.getElementById('editStandarId').value = '1'; // Set appropriate ID
            document.getElementById('editKriteria').value = cells[0].textContent;
            document.getElementById('editKeterangan').value = cells[1].textContent;
            document.getElementById('editNilai').value = cells[2].textContent;
            
            // Show modal
            document.getElementById('editStandarModal').classList.add('show');
        }
        
        function deleteStandar(button) {
            if (confirm('Apakah Anda yakin ingin menghapus standar ini?')) {
                const row = button.closest('tr');
                row.remove();
                alert('Standar berhasil dihapus!');
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
