<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SINTA - Kelola Pengerjaan</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?= base_url('assets') ?>/plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="<?= base_url('assets') ?>/css/parameter-sistem.css">
    <link rel="stylesheet" href="<?= base_url('assets') ?>/css/task-standard.css">
    
    <style>
        /* Dynamic Tugas & Standar Fields */
        .tugas-standar-item {
            display: flex;
            gap: 10px;
            margin-bottom: 10px;
            align-items: flex-start;
        }
        
        .tugas-field {
            flex: 1;
        }
        
        .standar-field {
            flex: 1.5;
        }
        
        .btn-remove {
            background: #dc3545;
            color: white;
            border: none;
            padding: 8px 12px;
            border-radius: 4px;
            cursor: pointer;
            font-size: 12px;
            margin-top: 0;
        }
        
        .btn-remove:hover {
            background: #c82333;
        }
        
        .btn-add-more {
            background: #28a745;
            color: white;
            border: none;
            padding: 8px 16px;
            border-radius: 4px;
            cursor: pointer;
            font-size: 14px;
            margin-top: 10px;
        }
        
        .btn-add-more:hover {
            background: #218838;
        }
    </style>
</head>
<body>
    <div class="main-content">
        <div class="content-body">
            <div class="table-card">
                <div class="card-header-row">
                    <h4 class="card-title">Daftar Pengerjaan</h4>
                    <button class="btn-add" onclick="tambahPengerjaan()">
                        <i class="fas fa-plus"></i> Tambah Pengerjaan
                    </button>
                </div>

                <?php if($this->session->flashdata('success')): ?>
                <div class="alert alert-success">
                    <i class="fa-solid fa-check-circle"></i>
                    <?= $this->session->flashdata('success') ?>
                </div>
                <?php endif; ?>

                <?php if($this->session->flashdata('error')): ?>
                <div class="alert alert-error">
                    <i class="fa-solid fa-exclamation-circle"></i>
                    <?= $this->session->flashdata('error') ?>
                </div>
                <?php endif; ?>

                <div class="table-responsive">
                    <table class="custom-table">
                        <thead>
                            <tr>
                                <th>Nama Ruangan</th>
                                <th>Lantai</th>
                                <th>Luas (m²)</th>
                                <th>Penanggungjawab</th>
                                <th>Tugas & Standar</th>
                                <th>Prioritas</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if(isset($pengerjaan_list) && !empty($pengerjaan_list)): ?>
                                <?php foreach($pengerjaan_list as $item): ?>
                                <tr>
                                    <td><?= htmlspecialchars($item->nama_ruangan) ?></td>
                                    <td>Lantai <?= htmlspecialchars(isset($item->lantai) ? $item->lantai : '-') ?></td>
                                    <td><?= htmlspecialchars(isset($item->luas) ? $item->luas : '-') ?></td>
                                    <td>
                                        <div class="admin-cell">
                                            <i class="far fa-user admin-icon"></i>
                                            <div class="admin-details">
                                                <span class="admin-name"><?= htmlspecialchars($item->nama_user) ?></span>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="task-standard-container">
                                            <?php 
                                            $tugas_data = json_decode($item->tugas, true);
                                            // Encode Base64 agar aman dikirim ke Javascript
                                            $tugas_safe = base64_encode($item->tugas);
                                            $standar_safe = base64_encode($item->standar);
                                            
                                            if ($tugas_data && is_array($tugas_data)) {
                                                $count = count($tugas_data);
                                                echo '<a href="#" class="badge-combined" style="text-decoration: none;" onclick="showTugasDetail(\'' . $tugas_safe . '\', \'' . $standar_safe . '\')">';
                                                echo '<i class="far fa-file-alt"></i>';
                                                echo '<i class="far fa-check-square"></i>';
                                                echo $count . ' Tugas';
                                                echo '</a>';
                                            } else {
                                                echo '<a href="#" class="badge-combined" style="text-decoration: none;">';
                                                echo '<i class="far fa-file-alt"></i>';
                                                echo '<i class="far fa-check-square"></i>';
                                                echo 'Tugas & Standar';
                                                echo '</a>';
                                            }
                                            ?>
                                        </div>
                                    </td>
                                    <td><span class="pill-priority priority-<?= $item->prioritas ?>"><?= ucfirst($item->prioritas) ?></span></td>
                                    <td><span class="status-badge status-<?= $item->status ?>"><?= ucfirst($item->status) ?></span></td>
                                    <td>
                                        <div class="action-cell">
                                            <button class="btn-icon btn-detail" onclick="detailPengerjaan(this, <?= $item->id_pengerjaan ?>)" title="Detail">
                                                <i class="fa-solid fa-eye"></i>
                                            </button>
                                            <button class="btn-icon btn-edit" onclick="editPengerjaan(this, <?= $item->id_pengerjaan ?>)" title="Edit">
                                                <i class="fa-solid fa-pen"></i>
                                            </button>
                                            <button class="btn-icon btn-delete" onclick="deletePengerjaan(this, <?= $item->id_pengerjaan ?>)" title="Delete">
                                                <i class="fa-solid fa-trash"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="8" class="text-center">
                                        <div class="empty-state">
                                            <i class="fas fa-clipboard-list"></i>
                                            <p>Belum ada data pengerjaan</p>
                                        </div>
                                    </td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div id="modalTambahPengerjaan" class="modal" style="display: none;">
        <div class="modal-content">
            <div class="modal-header">
                <h3>Tambah Pengerjaan Baru</h3>
                <button type="button" class="close-btn" onclick="tutupModal('modalTambahPengerjaan')">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <form id="formTambahPengerjaan" class="modal-form" action="<?= base_url('pengerjaan/add') ?>" method="POST">
                <div class="form-group">
                    <label for="id_ruangan">Pilih Ruangan</label>
                    <select id="id_ruangan" name="id_ruangan" required>
                        <option value="">Pilih Ruangan</option>
                        <?php if(isset($dropdown_options['ruangan'])): ?>
                            <?php foreach($dropdown_options['ruangan'] as $id => $nama): ?>
                                <?php if($id != ''): ?>
                                <option value="<?= $id ?>"><?= $nama ?></option>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="id_user">Penanggungjawab</label>
                    <select id="id_user" name="id_user" required>
                        <option value="">Pilih Penanggungjawab</option>
                        <?php if(isset($dropdown_options['user'])): ?>
                            <?php foreach($dropdown_options['user'] as $id => $nama): ?>
                                <?php if($id != ''): ?>
                                <option value="<?= $id ?>"><?= $nama ?></option>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </select>
                </div>
                
                <div class="form-group">
                    <label>Tugas dan Standar</label>
                    <div id="tugasStandarContainer">
                        <div class="tugas-standar-item">
                            <div class="tugas-field">
                                <input type="text" name="tugas[]" placeholder="Masukkan nama tugas" required>
                            </div>
                            <div class="standar-field">
                                <textarea name="standar[]" rows="2" placeholder="Masukkan standar pelaksanaan tugas"></textarea>
                            </div>
                            <button type="button" class="btn-remove" onclick="removeTugasStandar(this)" style="display: none;">Hapus</button>
                        </div>
                    </div>
                    <button type="button" class="btn-add-more" onclick="addTugasStandar()">+ Tambah Tugas & Standar</button>
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
                    <button type="button" class="btn btn-secondary" onclick="tutupModal('modalTambahPengerjaan')">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>

    <div id="modalEditPengerjaan" class="modal" style="display: none;">
        <div class="modal-content">
            <div class="modal-header">
                <h3>Edit Pengerjaan</h3>
                <button type="button" class="close-btn" onclick="tutupModal('modalEditPengerjaan')">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <form id="formEditPengerjaan" class="modal-form" action="<?= base_url('pengerjaan/edit') ?>" method="POST">
                <input type="hidden" id="editId" name="id_pengerjaan">
                <div class="form-group">
                    <label for="editIdRuangan">Pilih Ruangan</label>
                    <select id="editIdRuangan" name="id_ruangan" required>
                        <option value="">Pilih Ruangan</option>
                        <?php if(isset($dropdown_options['ruangan'])): ?>
                            <?php foreach($dropdown_options['ruangan'] as $id => $nama): ?>
                                <?php if($id != ''): ?>
                                <option value="<?= $id ?>"><?= $nama ?></option>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="editIdUser">Penanggungjawab</label>
                    <select id="editIdUser" name="id_user" required>
                        <option value="">Pilih Penanggungjawab</option>
                        <?php if(isset($dropdown_options['user'])): ?>
                            <?php foreach($dropdown_options['user'] as $id => $nama): ?>
                                <?php if($id != ''): ?>
                                <option value="<?= $id ?>"><?= $nama ?></option>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </select>
                </div>
                
                <div class="form-group">
                    <label>Tugas dan Standar</label>
                    <div id="editTugasStandarContainer">
                        </div>
                    <button type="button" class="btn-add-more" onclick="addEditTugasStandar()">+ Tambah Tugas & Standar</button>
                </div>
                
                <div class="form-group">
                    <label for="editPrioritas">Prioritas</label>
                    <select id="editPrioritas" name="prioritas" required>
                        <option value="">Pilih Prioritas</option>
                        <option value="tinggi">Tinggi</option>
                        <option value="sedang">Sedang</option>
                        <option value="rendah">Rendah</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="editStatus">Status</label>
                    <select id="editStatus" name="status">
                        <option value="pending">Pending</option>
                        <option value="proses">Proses</option>
                        <option value="selesai">Selesai</option>
                    </select>
                </div>
                <div class="form-actions">
                    <button type="button" class="btn btn-secondary" onclick="tutupModal('modalEditPengerjaan')">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        // Make sidebar full when page loads
        document.addEventListener('DOMContentLoaded', function() {
            if(document.body) {
                document.body.classList.remove('sidebar-mini');
                document.body.classList.add('sidebar-open');
            }
            
            const mainSidebar = document.querySelector('.main-sidebar');
            if (mainSidebar) {
                mainSidebar.style.width = '250px';
            }
            
            const contentWrapper = document.querySelector('.content-wrapper');
            if (contentWrapper) {
                contentWrapper.style.marginLeft = '250px';
            }
        });

        // Modal functions
        function tambahPengerjaan() {
            document.getElementById('modalTambahPengerjaan').style.display = 'flex';
        }

        function editPengerjaan(button, id) {
            fetch(`<?= base_url('pengerjaan/get_by_id') ?>/` + id)
                .then(response => response.json())
                .then(data => {
                    if (data.status === 'success') {
                        document.getElementById('editId').value = data.data.id_pengerjaan;
                        document.getElementById('editIdRuangan').value = data.data.id_ruangan;
                        document.getElementById('editIdUser').value = data.data.id_user;
                        document.getElementById('editPrioritas').value = data.data.prioritas;
                        document.getElementById('editStatus').value = data.data.status;
                        
                        populateEditTugasStandar(data.data.tugas, data.data.standar);
                        
                        document.getElementById('modalEditPengerjaan').style.display = 'flex';
                    } else {
                        alert('Gagal mengambil data: ' + data.message);
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Terjadi kesalahan saat mengambil data');
                });
        }

        function populateEditTugasStandar(tugasJson, standarJson) {
            const container = document.getElementById('editTugasStandarContainer');
            container.innerHTML = '';
            
            let tugasData = [];
            let standarData = [];
            
            try {
                tugasData = typeof tugasJson === 'string' ? JSON.parse(tugasJson) : tugasJson;
                standarData = typeof standarJson === 'string' ? JSON.parse(standarJson) : standarJson;
            } catch (e) {
                tugasData = [tugasJson];
                standarData = [standarJson];
            }
            
            if (!Array.isArray(tugasData) || tugasData.length === 0) {
                tugasData = [''];
                standarData = [''];
            }
            
            tugasData.forEach((tugas, index) => {
                const newItem = document.createElement('div');
                newItem.className = 'tugas-standar-item';
                
                const standarValue = standarData && standarData[index] ? standarData[index] : '';

                newItem.innerHTML = `
                    <div class="tugas-field">
                        <input type="text" name="tugas[]" placeholder="Masukkan nama tugas" value="${tugas || ''}" required>
                    </div>
                    <div class="standar-field">
                        <textarea name="standar[]" rows="2" placeholder="Masukkan standar pelaksanaan tugas">${standarValue}</textarea>
                    </div>
                    <button type="button" class="btn-remove" onclick="removeEditTugasStandar(this)">Hapus</button>
                `;
                container.appendChild(newItem);
            });
            
            updateEditRemoveButtons();
        }

        function addEditTugasStandar() {
            const container = document.getElementById('editTugasStandarContainer');
            
            const newItem = document.createElement('div');
            newItem.className = 'tugas-standar-item';
            newItem.innerHTML = `
                <div class="tugas-field">
                    <input type="text" name="tugas[]" placeholder="Masukkan nama tugas" required>
                </div>
                <div class="standar-field">
                    <textarea name="standar[]" rows="2" placeholder="Masukkan standar pelaksanaan tugas"></textarea>
                </div>
                <button type="button" class="btn-remove" onclick="removeEditTugasStandar(this)">Hapus</button>
            `;
            
            container.appendChild(newItem);
            updateEditRemoveButtons();
        }

        function removeEditTugasStandar(button) {
            const container = document.getElementById('editTugasStandarContainer');
            if (container.children.length > 1) {
                button.parentElement.remove();
                updateEditRemoveButtons();
            }
        }

        function updateEditRemoveButtons() {
            const container = document.getElementById('editTugasStandarContainer');
            const items = container.querySelectorAll('.tugas-standar-item');
            
            items.forEach((item, index) => {
                const removeBtn = item.querySelector('.btn-remove');
                if (removeBtn) {
                    removeBtn.style.display = items.length > 1 ? 'block' : 'none';
                }
            });
        }

        function showTugasDetail(tugasBase64, standarBase64) {
            let tugasData = [];
            let standarData = [];
            
            try {
                // Decode Base64 string from PHP
                const tugasJson = atob(tugasBase64);
                const standarJson = atob(standarBase64);
                
                tugasData = JSON.parse(tugasJson);
                standarData = JSON.parse(standarJson);
            } catch (e) {
                console.error("Gagal parse data:", e);
                alert("Format data tidak valid.");
                return;
            }
            
            let detailText = 'Daftar Tugas:\n\n';
            if(Array.isArray(tugasData)){
                tugasData.forEach((tugas, index) => {
                    detailText += `${index + 1}. ${tugas || '-'}\n`;
                    if (standarData && standarData[index]) {
                        detailText += `   Standar: ${standarData[index]}\n`;
                    }
                    detailText += '\n';
                });
            } else {
                 detailText += "Data tidak tersedia.";
            }
            
            alert(detailText);
        }

        function deletePengerjaan(button, id) {
            if (confirm('Apakah Anda yakin ingin menghapus pengerjaan ini?')) {
                window.location.href = `<?= base_url('pengerjaan/delete') ?>/` + id;
            }
        }

        function detailPengerjaan(button, id) {
            fetch(`<?= base_url('pengerjaan/get_by_id') ?>/` + id)
                .then(response => response.json())
                .then(data => {
                    if (data.status === 'success') {
                        let detailText = `Detail Pengerjaan:\n\n`;
                        detailText += `ID: ${data.data.id_pengerjaan}\n`;
                        detailText += `Ruangan: ${data.data.nama_ruangan}\n`;
                        detailText += `Penanggungjawab: ${data.data.nama_user}\n`;
                        detailText += `Prioritas: ${data.data.prioritas}\n`;
                        detailText += `Status: ${data.data.status}\n`;
                        detailText += `Dibuat: ${data.data.created_at}\n\n`;
                        
                        let tugasData = [];
                        let standarData = [];
                        try {
                            tugasData = typeof data.data.tugas === 'string' ? JSON.parse(data.data.tugas) : data.data.tugas;
                            standarData = typeof data.data.standar === 'string' ? JSON.parse(data.data.standar) : data.data.standar;
                        } catch (e) {
                            tugasData = [data.data.tugas];
                            standarData = [data.data.standar];
                        }
                        
                        detailText += `Tugas dan Standar:\n`;
                        if(Array.isArray(tugasData)) {
                             tugasData.forEach((tugas, index) => {
                                detailText += `${index + 1}. ${tugas || '-'}\n`;
                                if (standarData && standarData[index]) {
                                    detailText += `   Standar: ${standarData[index]}\n`;
                                }
                            });
                        }
                        
                        alert(detailText);
                    } else {
                        alert('Gagal mengambil data: ' + data.message);
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Terjadi kesalahan saat mengambil data');
                });
        }

        function tutupModal(modalId) {
            document.getElementById(modalId).style.display = 'none';
        }

        function addTugasStandar() {
            const container = document.getElementById('tugasStandarContainer');
            
            const newItem = document.createElement('div');
            newItem.className = 'tugas-standar-item';
            newItem.innerHTML = `
                <div class="tugas-field">
                    <input type="text" name="tugas[]" placeholder="Masukkan nama tugas" required>
                </div>
                <div class="standar-field">
                    <textarea name="standar[]" rows="2" placeholder="Masukkan standar pelaksanaan tugas"></textarea>
                </div>
                <button type="button" class="btn-remove" onclick="removeTugasStandar(this)">Hapus</button>
            `;
            
            container.appendChild(newItem);
            updateRemoveButtons();
        }

        function removeTugasStandar(button) {
            const container = document.getElementById('tugasStandarContainer');
            if (container.children.length > 1) {
                button.parentElement.remove();
                updateRemoveButtons();
            }
        }

        function updateRemoveButtons() {
            const container = document.getElementById('tugasStandarContainer');
            const items = container.querySelectorAll('.tugas-standar-item');
            
            items.forEach((item, index) => {
                const removeBtn = item.querySelector('.btn-remove');
                if (removeBtn) {
                    removeBtn.style.display = items.length > 1 ? 'block' : 'none';
                }
            });
        }

        document.getElementById('formTambahPengerjaan')?.addEventListener('submit', function(e) {
        });

        document.getElementById('formEditPengerjaan')?.addEventListener('submit', function(e) {
        });

        window.addEventListener('click', function(event) {
            if (event.target.classList.contains('modal')) {
                event.target.style.display = 'none';
            }
        });
    </script>
</body>
</html>