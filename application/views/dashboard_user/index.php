<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SINTA Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="<?= base_url('assets/css/dashboard_user.css') ?>">
    <style>
        /* Additional styles for better integration */
        .status-card {
            cursor: pointer;
        }
        
        .task-card {
            cursor: pointer;
        }
        
        .task-card:hover .icon-box {
            transform: scale(1.05);
        }
        
        .status-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.1);
        }
        
        /* Make Integrasi SIMETRI card clickable */
        .task-card:first-child {
            cursor: pointer;
        }
        
        .task-card:first-child:hover {
            box-shadow: 0 8px 20px rgba(74, 144, 226, 0.15);
        }
    </style>
</head>
<body>
    <header class="header">
        <div class="top-bar">
            <div class="user-info">
                <h1><i class="fa-solid fa-sparkles" style="color: #fbbf24;"></i> SINTA</h1>
                <p>Halo, <span id="username-display"><?= $user_data['nama'] ?></span> 👋</p>
            </div>
            <div class="header-icons">
                <button class="icon-btn">
                    <i class="fa-regular fa-bell"></i>
                    <span class="badge-dot">3</span>
                </button>
                <button class="icon-btn" onclick="window.location.href='<?= base_url('loginuser/logout') ?>'">
                    <i class="fa-solid fa-arrow-right-from-bracket"></i>
                </button>
            </div>
        </div>

        <div class="status-cards-container">
            <!-- Card Menunggu -->
            <div class="status-card menunggu">
                <div class="status-info">
                    <span class="status-count">4</span>
                    <span class="status-title">Menunggu</span>
                </div>
            </div>

            <!-- Card Dikerjakan -->
            <div class="status-card dikerjakan">
                <div class="status-info">
                    <span class="status-count">0</span>
                    <span class="status-title">Dikerjakan</span>
                </div>
            </div>

            <!-- Card Selesai -->
            <div class="status-card selesai">
                <div class="status-info">
                    <span class="status-count">1</span>
                    <span class="status-title">Selesai</span>
                </div>
            </div>
        </div>

        <div class="progress-box">
            <div class="progress-header">
                <span>Progress Hari Ini</span>
                <span><i class="fa-solid fa-arrow-trend-up"></i> 20%</span>
            </div>
            <div class="progress-bar-bg">
                <div class="progress-bar-fill"></div>
            </div>
        </div>
    </header>

    <main class="main-content">
        <div class="section-header">
            <h2 class="section-title">Daftar Tugas Hari Ini</h2>
            <span class="task-count">5 tugas</span>
        </div>

        <div class="task-card">
            <div class="card-body">
                <div class="icon-box green">
                    <i class="fa-regular fa-circle-check"></i>
                </div>
                <div class="task-info">
                    <h3>Integrasi SIMETRI</h3>
                    <p class="task-meta">Dashboard • Sistem</p>
                    <p class="task-desc">Sinkronisasi data pegawai dengan sistem SIMETRI.</p>
                </div>
            </div>
            <div class="card-footer">
                <div class="time"><i class="fa-regular fa-clock"></i> 08:00</div>
                <span class="status-pill done"><i class="fa-solid fa-check"></i> Selesai</span>
            </div>
        </div>

        <div class="task-card">
            <div class="card-body">
                <div class="icon-box yellow">
                    <i class="fa-regular fa-clock"></i>
                </div>
                <div class="task-info">
                    <h3>Update Profil User</h3>
                    <p class="task-meta">User Management • Profile</p>
                    <p class="task-desc">Perbarui informasi profil dan pengaturan akun pengguna.</p>
                </div>
            </div>
            <div class="card-footer">
                <div class="time"><i class="fa-regular fa-clock"></i> 09:00</div>
                <span class="status-pill pending"><i class="fa-solid fa-circle-notch"></i> Menunggu</span>
            </div>
        </div>

        <div class="task-card">
            <div class="badge-urgent">
                <i class="fa-solid fa-clock"></i> Urgent
            </div>
            <div class="card-body">
                <div class="icon-box yellow">
                    <i class="fa-regular fa-clock"></i>
                </div>
                <div class="task-info">
                    <h3>Backup Database</h3>
                    <p class="task-meta">System • Database</p>
                    <p class="task-desc">Lakukan backup database harian untuk keamanan data.</p>
                </div>
            </div>
            <div class="card-footer">
                <div class="time"><i class="fa-regular fa-clock"></i> 07:30</div>
                <span class="status-pill pending"><i class="fa-solid fa-circle-notch"></i> Menunggu</span>
            </div>
        </div>

        <div class="task-card">
            <div class="card-body">
                <div class="icon-box yellow">
                    <i class="fa-regular fa-clock"></i>
                </div>
                <div class="task-info">
                    <h3>Generate Laporan</h3>
                    <p class="task-meta">Reports • Analytics</p>
                    <p class="task-desc">Buat laporan bulanan untuk manajemen sistem.</p>
                </div>
            </div>
            <div class="card-footer">
                <div class="time"><i class="fa-regular fa-clock"></i> 10:00</div>
                <span class="status-pill pending"><i class="fa-solid fa-circle-notch"></i> Menunggu</span>
            </div>
        </div>

        <div class="task-card">
            <div class="card-body">
                <div class="icon-box yellow">
                    <i class="fa-regular fa-clock"></i>
                </div>
                <div class="task-info">
                    <h3>System Maintenance</h3>
                    <p class="task-meta">System • Maintenance</p>
                    <p class="task-desc">Periksa dan optimasi performa sistem.</p>
                </div>
            </div>
            <div class="card-footer">
                <div class="time"><i class="fa-regular fa-clock"></i> 14:00</div>
                <span class="status-pill pending"><i class="fa-solid fa-circle-notch"></i> Menunggu</span>
            </div>
        </div>
    </main>

    <script>
        // Update real-time clock
        function updateClock() {
            const now = new Date();
            const timeString = now.toLocaleTimeString('id-ID', { 
                hour: '2-digit', 
                minute: '2-digit' 
            });
            
            // Update time elements if needed
            const timeElements = document.querySelectorAll('.time');
            // This would require more complex logic to update specific times
        }

        // Add click handlers for task cards
        document.querySelectorAll('.task-card').forEach((card, index) => {
            card.addEventListener('click', function() {
                // Handle task card click
                if (index === 0) {
                    // First card (Integrasi SIMETRI) - redirect to simetri page
                    window.location.href = '<?= base_url('simetri') ?>';
                } else {
                    console.log('Task card clicked:', index);
                }
            });
        });

        // Handle status card clicks
        document.querySelectorAll('.status-card').forEach((card, index) => {
            card.addEventListener('click', function() {
                console.log('Status card clicked:', index);
                // Add functionality for status cards
            });
        });

        // Handle notification click
        document.querySelector('.icon-btn').addEventListener('click', function() {
            console.log('Notifications clicked');
        });

        // Initialize animations
        document.addEventListener('DOMContentLoaded', function() {
            const cards = document.querySelectorAll('.task-card');
            cards.forEach((card, index) => {
                card.style.animationDelay = `${index * 0.1}s`;
            });
        });
    </script>
</body>
</html>