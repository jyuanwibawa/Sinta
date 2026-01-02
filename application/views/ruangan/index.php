<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SINTA - Parameter Sistem</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?= base_url('assets') ?>/plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="<?= base_url('assets') ?>/css/parameter-sistem.css">
</head>
<body>
    <div class="main-content">
        <div class="content-body">
            <div class="table-card">
                <div class="card-header-row">
                    <h4 class="card-title">Daftar Ruangan</h4>
                    <button class="btn-add" onclick="tambahRuangan()">
                        <i class="fas fa-plus"></i> Tambah Ruangan
                    </button>
                </div>

                <div class="table-responsive">
                    <table class="custom-table">
                        <thead>
                            <tr>
                                <th>Nama Ruangan</th>
                                <th>Lantai</th>
                                <th>Luas (m²)</th>
                                <th>Administrator</th>
                                <th>Tugas</th>
                                <th>Standar</th>
                                <th>Prioritas</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Ruang Sidang A</td>
                                <td>Lantai 1</td>
                                <td>120</td>
                                <td>
                                    <div class="admin-cell">
                                        <i class="far fa-user admin-icon"></i>
                                        <div class="admin-details">
                                            <span class="admin-name">Bambang Wijaya, S.H.</span>
                                            <span class="admin-nip">199003032016031003</span>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <a href="<?= base_url('tugas') ?>" class="badge-task">
                                        <i class="far fa-file-alt"></i> 3 Tugas
                                    </a>
                                </td>
                                <td>
                                    <a href="<?= base_url('standar') ?>" class="badge-standard">
                                        <i class="far fa-check-square"></i> 3 Standar
                                    </a>
                                </td>
                                <td><span class="pill-priority priority-high">Tinggi</span></td>
                                <td>
                                    <div class="action-cell">
                                        <button type="button" class="btn-icon btn-edit" onclick="editRuangan(this)">
                                            <i class="fas fa-pen"></i>
                                        </button>
                                        <button class="btn-icon btn-delete">
                                            <i class="far fa-trash-alt"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>

                            <tr>
                                <td>Toilet Lantai 1</td>
                                <td>Lantai 1</td>
                                <td>30</td>
                                <td>
                                    <div class="admin-cell">
                                        <i class="far fa-user admin-icon"></i>
                                        <div class="admin-details">
                                            <span class="admin-name">Rudi Hartono, S.Sos.</span>
                                            <span class="admin-nip">199005052017031005</span>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <a href="<?= base_url('tugas') ?>" class="badge-task">
                                        <i class="far fa-file-alt"></i> 3 Tugas
                                    </a>
                                </td>
                                <td>
                                    <a href="<?= base_url('standar') ?>" class="badge-standard">
                                        <i class="far fa-check-square"></i> 3 Standar
                                    </a>
                                </td>
                                <td><span class="pill-priority priority-high">Tinggi</span></td>
                                <td>
                                    <div class="action-cell">
                                        <button type="button" class="btn-icon btn-edit" onclick="editRuangan(this)">
                                            <i class="fas fa-pen"></i>
                                        </button>
                                        <button class="btn-icon btn-delete">
                                            <i class="far fa-trash-alt"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>

                            <tr>
                                <td>Ruang Tunggu</td>
                                <td>Lantai 1</td>
                                <td>80</td>
                                <td>
                                    <div class="admin-cell">
                                        <i class="far fa-user admin-icon"></i>
                                        <div class="admin-details">
                                            <span class="admin-name">Rudi Hartono, S.Sos.</span>
                                            <span class="admin-nip">199005052017031005</span>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <a href="<?= base_url('tugas') ?>" class="badge-task">
                                        <i class="far fa-file-alt"></i> 2 Tugas
                                    </a>
                                </td>
                                <td>
                                    <a href="<?= base_url('standar') ?>" class="badge-standard">
                                        <i class="far fa-check-square"></i> 2 Standar
                                    </a>
                                </td>
                                <td><span class="pill-priority priority-med">Sedang</span></td>
                                <td>
                                    <div class="action-cell">
                                        <button type="button" class="btn-icon btn-edit" onclick="editRuangan(this)"><i class="fas fa-pen"></i></button>
                                        <button class="btn-icon btn-delete"><i class="far fa-trash-alt"></i></button>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Tambah Ruangan -->
    <div id="modalTambahRuangan" class="modal" style="display: none;">
        <div class="modal-content">
            <div class="modal-header">
                <h3>Tambah Ruangan Baru</h3>
                <button type="button" class="close-btn" onclick="tutupModal('modalTambahRuangan')">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <form id="formTambahRuangan" class="modal-form">
                <div class="form-group">
                    <label for="namaRuangan">Nama Ruangan</label>
                    <input type="text" id="namaRuangan" name="namaRuangan" placeholder="Masukkan nama ruangan" required>
                </div>
                <div class="form-group">
                    <label for="lantai">Lantai</label>
                    <input type="text" id="lantai" name="lantai" placeholder="Contoh: Lantai 1" required>
                </div>
                <div class="form-group">
                    <label for="luas">Luas (m²)</label>
                    <input type="number" id="luas" name="luas" placeholder="Masukkan luas ruangan" required>
                </div>
                <div class="form-group">
                    <label for="admin">Administrator</label>
                    <select id="admin" name="admin" required>
                        <option value="">Pilih Administrator</option>
                        <option value="1">Bambang Wijaya, S.H. - 199003032016031003</option>
                        <option value="2">Rudi Hartono, S.Sos. - 199005052017031005</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="prioritas">Prioritas</label>
                    <select id="prioritas" name="prioritas" required>
                        <option value="">Pilih Prioritas</option>
                        <option value="tinggi">Tinggi</option>
                        <option value="sedang">Sedang</option>
                        <option value="rendah">Rendah</option>
                    </select>
                </div>
                <div class="form-actions">
                    <button type="button" class="btn btn-secondary" onclick="tutupModal('modalTambahRuangan')">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal Edit Ruangan -->
    <div id="modalEditRuangan" class="modal" style="display: none;">
        <div class="modal-content">
            <div class="modal-header">
                <h3>Edit Ruangan</h3>
                <button type="button" class="close-btn" onclick="tutupModal('modalEditRuangan')">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <form id="formEditRuangan" class="modal-form">
                <input type="hidden" id="editId" name="id">
                <div class="form-group">
                    <label for="editNamaRuangan">Nama Ruangan</label>
                    <input type="text" id="editNamaRuangan" name="namaRuangan" placeholder="Masukkan nama ruangan" required>
                </div>
                <div class="form-group">
                    <label for="editLantai">Lantai</label>
                    <input type="text" id="editLantai" name="lantai" placeholder="Contoh: Lantai 1" required>
                </div>
                <div class="form-group">
                    <label for="editLuas">Luas (m²)</label>
                    <input type="number" id="editLuas" name="luas" placeholder="Masukkan luas ruangan" required>
                </div>
                <div class="form-group">
                    <label for="editAdministrator">Administrator</label>
                    <select id="editAdministrator" name="admin" required>
                        <option value="">Pilih Administrator</option>
                        <option value="1">Bambang Wijaya, S.H. - 199003032016031003</option>
                        <option value="2">Rudi Hartono, S.Sos. - 199005052017031005</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="editPrioritas">Prioritas</label>
                    <select id="editPrioritas" name="prioritas" required>
                        <option value="">Pilih Prioritas</option>
                        <option value="Tinggi">Tinggi</option>
                        <option value="Sedang">Sedang</option>
                        <option value="Rendah">Rendah</option>
                    </select>
                </div>
                <div class="form-actions">
                    <button type="button" class="btn btn-secondary" onclick="tutupModal('modalEditRuangan')">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        // Make sidebar full when page loads
        document.addEventListener('DOMContentLoaded', function() {
            // Remove sidebar-mini class and add sidebar-open for full sidebar
            document.body.classList.remove('sidebar-mini');
            document.body.classList.add('sidebar-open');
            
            // Ensure sidebar stays open
            const mainSidebar = document.querySelector('.main-sidebar');
            if (mainSidebar) {
                mainSidebar.style.width = '250px';
            }
            
            // Adjust content wrapper margin
            const contentWrapper = document.querySelector('.content-wrapper');
            if (contentWrapper) {
                contentWrapper.style.marginLeft = '250px';
            }
        });

        // Modal functions
        function tambahRuangan() {
            document.getElementById('modalTambahRuangan').style.display = 'flex';
        }

        function editRuangan(button) {
            // Get row data
            const row = button.closest('tr');
            const cells = row.getElementsByTagName('td');
            
            // Populate edit form with row data
            document.getElementById('editId').value = '1'; // Set appropriate ID
            document.getElementById('editNamaRuangan').value = cells[0].textContent;
            document.getElementById('editLantai').value = cells[1].textContent;
            document.getElementById('editLuas').value = cells[2].textContent;
            
            // Show modal
            document.getElementById('modalEditRuangan').style.display = 'flex';
        }

        function tutupModal(modalId) {
            document.getElementById(modalId).style.display = 'none';
        }

        // Handle form submission for tambah ruangan
        document.getElementById('formTambahRuangan')?.addEventListener('submit', function(e) {
            e.preventDefault();
            // Add your form submission logic here
            alert('Data ruangan berhasil disimpan!');
            tutupModal('modalTambahRuangan');
        });

        // Handle form submission for edit ruangan
        document.getElementById('formEditRuangan')?.addEventListener('submit', function(e) {
            e.preventDefault();
            // Add your form submission logic here
            alert('Perubahan berhasil disimpan!');
            tutupModal('modalEditRuangan');
        });

        // Close modal when clicking outside
        window.addEventListener('click', function(event) {
            if (event.target.classList.contains('modal')) {
                event.target.style.display = 'none';
            }
        });
    </script>
</body>
</html>