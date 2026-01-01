<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SINTA - Integrasi SIMETRI</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="<?= base_url('assets/css/simetri.css') ?>">
</head>
<body>
    <main class="main-content">
        <!-- Top Header -->
        
        <div class="content-body">
            <div class="cards-container">
                <div class="status-card card-green">
                    <div class="card-header">
                        <span class="card-label">Status Koneksi</span>
                        <i class="card-icon fa-solid fa-database text-green"></i>
                    </div>
                    <div class="card-value text-green">Terhubung</div>
                    <a href="#" class="card-link" onclick="alert('Mengecek koneksi...')">Test Koneksi</a>
                </div>

                <div class="status-card card-blue">
                    <div class="card-header">
                        <span class="card-label">Terakhir Sinkronisasi</span>
                        <i class="card-icon fa-regular fa-calendar text-blue"></i>
                    </div>
                    <div class="card-value" id="lastSyncTime">21 Des 2024, 14:30</div>
                </div>

                <div class="status-card card-purple">
                    <div class="card-header">
                        <span class="card-label">Total Data Pegawai</span>
                        <i class="card-icon fa-solid fa-user-group text-purple"></i>
                    </div>
                    <div class="card-value"><?= count($users) ?></div>
                </div>
            </div>

            <div class="content-card">
                <h4 class="panel-title">Kontrol Sinkronisasi</h4>

                <div class="sync-row">
                    <div class="sync-info">
                        <h4>Auto Sync</h4>
                        <p>Sinkronisasi otomatis setiap hari pukul 14:30</p>
                    </div>
                    <label class="switch">
                        <input type="checkbox" checked>
                        <span class="slider"></span>
                    </label>
                </div>

                <div class="button-group">
                    <button class="btn btn-blue" id="btnSync">
                        <i class="fa-solid fa-rotate"></i> Sinkronkan Sekarang
                    </button>
                    <button class="btn btn-green">
                        <i class="fa-solid fa-download"></i> Export Data
                    </button>
                </div>
            </div>

            <div class="table-card">
                <div class="table-header-container">
                    <h3 class="panel-title">Data Pegawai dari SIMETRI</h3>
                    <p class="panel-subtitle">Daftar pegawai yang berhasil di sinkronisasi dari sistem SIMETRI</p>
                </div>
                
                <div class="table-responsive">
                    <table class="custom-table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            $no = 1;
                            foreach($users as $user): 
                            ?>
                            <tr>
                                <td><?= $no ?></td>
                                <td class="td-name"><?= $user->nama ?></td>
                                <td><?= $user->email ?></td>
                                <td><?= $user->role_text ? $user->role_text : $user->role ?></td>
                                <td>
                                    <?php if($user->aktivasi == 1): ?>
                                        <span class="badge-active"><i class="fas fa-check-circle"></i> Aktif</span>
                                    <?php else: ?>
                                        <span class="badge-inactive"><i class="fas fa-times-circle"></i> Tidak Aktif</span>
                                    <?php endif; ?>
                                </td>
                            </tr>
                            <?php 
                            $no++;
                            endforeach; 
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="content-card">
                <h4 class="panel-title" style="margin-bottom: 20px;">Riwayat Sinkronisasi</h4>
                
                <div class="history-list">
                    <div class="history-item item-success">
                        <div class="history-content">
                            <div class="history-icon-box"><i class="fa-solid fa-check"></i></div>
                            <div class="history-details">
                                <h5>21 Des 2024 pukul 14:30</h5>
                                <p>Total: 156 data • Berhasil: 156 • Gagal: 0</p>
                            </div>
                        </div>
                        <span class="history-badge badge-success">Sukses</span>
                    </div>

                    <div class="history-item item-warning">
                        <div class="history-content">
                            <div class="history-icon-box"><i class="fa-solid fa-exclamation"></i></div>
                            <div class="history-details">
                                <h5>20 Des 2024 pukul 14:30</h5>
                                <p>Total: 155 data • Berhasil: 153 • Gagal: 2</p>
                            </div>
                        </div>
                        <span class="history-badge badge-warning">Warning</span>
                    </div>

                    <div class="history-item item-success">
                        <div class="history-content">
                            <div class="history-icon-box"><i class="fa-solid fa-check"></i></div>
                            <div class="history-details">
                                <h5>19 Des 2024 pukul 14:30</h5>
                                <p>Total: 155 data • Berhasil: 155 • Gagal: 0</p>
                            </div>
                        </div>
                        <span class="history-badge badge-success">Sukses</span>
                    </div>
                </div>
            </div>

            <div class="info-box">
                <div class="info-header">
                    <i class="fa-solid fa-circle-info"></i>
                    <h4>Informasi Penting</h4>
                </div>
                <ul class="info-list">
                    <li>Database lokal berfungsi sebagai backup jika terjadi gangguan koneksi ke SIMETRI</li>
                    <li>Sinkronisasi otomatis dilakukan setiap hari untuk menjaga data tetap update</li>
                    <li>Data pegawai yang ditarik meliputi: NIP, Nama, Jabatan, Unit, dan Status</li>
                    <li>User yang sudah ada akan diupdate, user baru akan ditambahkan otomatis</li>
                    <li>Log sinkronisasi disimpan untuk audit trail</li>
                </ul>
            </div>
        </div>
    </main>

    <script>
        document.getElementById('btnSync').addEventListener('click', function() {
            const btn = this;
            const originalText = btn.innerHTML;
            
            btn.innerHTML = '<i class="fa-solid fa-spinner fa-spin"></i> Memproses...';
            btn.disabled = true;
            btn.style.opacity = '0.7';

            setTimeout(() => {
                const now = new Date();
                const options = { day: 'numeric', month: 'short', year: 'numeric', hour: '2-digit', minute: '2-digit' };
                const dateString = now.toLocaleDateString('id-ID', options);
                
                document.getElementById('lastSyncTime').innerText = dateString.replace('.', ':');

                btn.innerHTML = originalText;
                btn.disabled = false;
                btn.style.opacity = '1';
                
                alert('Sinkronisasi Berhasil!');
            }, 2000);
        });
    </script>
</body>
</html>
