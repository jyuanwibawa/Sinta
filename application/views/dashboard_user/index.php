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
                    <span class="status-count"><?= isset($pengerjaan_stats['pending']) ? $pengerjaan_stats['pending'] : 0 ?></span>
                    <span class="status-title">Menunggu</span>
                </div>
            </div>

            <!-- Card Dikerjakan -->
            <div class="status-card dikerjakan">
                <div class="status-info">
                    <span class="status-count"><?= isset($pengerjaan_stats['proses']) ? $pengerjaan_stats['proses'] : 0 ?></span>
                    <span class="status-title">Dikerjakan</span>
                </div>
            </div>

            <!-- Card Selesai -->
            <div class="status-card selesai">
                <div class="status-info">
                    <span class="status-count"><?= isset($pengerjaan_stats['selesai']) ? $pengerjaan_stats['selesai'] : 0 ?></span>
                    <span class="status-title">Selesai</span>
                </div>
            </div>
        </div>

        <div class="progress-box">
            <div class="progress-header">
                <span>Progress Hari Ini</span>
                <span><i class="fa-solid fa-arrow-trend-up"></i> 
                    <?php 
                    $total = isset($pengerjaan_stats['total']) ? $pengerjaan_stats['total'] : 0;
                    $selesai = isset($pengerjaan_stats['selesai']) ? $pengerjaan_stats['selesai'] : 0;
                    $progress = $total > 0 ? round(($selesai / $total) * 100) : 0;
                    echo $progress . '%';
                    ?>
                </span>
            </div>
            <div class="progress-bar-bg">
                <div class="progress-bar-fill" style="width: <?= $progress ?>%"></div>
            </div>
        </div>
    </header>

    <main class="main-content">
        <div class="section-header">
            <h2 class="section-title">Daftar Tugas Hari Ini</h2>
            <span class="task-count"><?= isset($pengerjaan_stats['total']) ? $pengerjaan_stats['total'] : 0 ?> tugas</span>
        </div>

        <?php if(isset($pengerjaan_list) && !empty($pengerjaan_list)): ?>
            <?php foreach($pengerjaan_list as $item): ?>
                <?php 
                // Parse tugas data
                $tugas_data = json_decode($item->tugas, true);
                $first_tugas = is_array($tugas_data) && !empty($tugas_data) ? $tugas_data[0] : $item->tugas;
                
                // Determine status class and icon
                $status_class = '';
                $status_icon = '';
                $status_text = '';
                
                switch($item->status) {
                    case 'selesai':
                        $status_class = 'done';
                        $status_icon = 'fa-check';
                        $status_text = 'Selesai';
                        break;
                    case 'proses':
                        $status_class = 'working';
                        $status_icon = 'fa-spinner';
                        $status_text = 'Dikerjakan';
                        break;
                    default:
                        $status_class = 'pending';
                        $status_icon = 'fa-circle-notch';
                        $status_text = 'Menunggu';
                }
                
                // Determine icon box color
                $icon_color = $item->status == 'selesai' ? 'green' : 'yellow';
                
                // Format created time
                $time = date('H:i', strtotime($item->created_at));
                ?>
                
                <div class="task-card" onclick="window.location.href='<?= base_url('detailtugas/detail') ?>'">
                    <?php if($item->prioritas == 'tinggi'): ?>
                    <div class="badge-urgent">
                        <i class="fa-solid fa-clock"></i> Urgent
                    </div>
                    <?php endif; ?>
                    
                    <div class="card-body">
                        <div class="icon-box <?= $icon_color ?>">
                            <i class="fa-regular <?= $item->status == 'selesai' ? 'fa-circle-check' : 'fa-clock' ?>"></i>
                        </div>
                        <div class="task-info">
                            <h3><?= htmlspecialchars($first_tugas) ?></h3>
                            <p class="task-meta"><?= htmlspecialchars($item->nama_ruangan) ?> • <?= ucfirst($item->prioritas) ?></p>
                            <p class="task-desc">
                                <?php 
                                if(is_array($tugas_data) && count($tugas_data) > 1) {
                                    echo count($tugas_data) . ' tugas termasuk ' . htmlspecialchars($first_tugas);
                                } else {
                                    echo htmlspecialchars($first_tugas);
                                }
                                ?>
                            </p>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="time"><i class="fa-regular fa-clock"></i> <?= $time ?></div>
                        <span class="status-pill <?= $status_class ?>"><i class="fa-solid <?= $status_icon ?>"></i> <?= $status_text ?></span>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="empty-state" style="text-align: center; padding: 60px 20px; color: #666;">
                <i class="fas fa-clipboard-list" style="font-size: 48px; margin-bottom: 20px; color: #ccc;"></i>
                <h3 style="margin-bottom: 10px;">Belum ada tugas</h3>
                <p>Anda belum memiliki pengerjaan yang ditugaskan.</p>
            </div>
        <?php endif; ?>
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

        // Handle status card clicks
        document.querySelectorAll('.status-card').forEach((card, index) => {
            card.addEventListener('click', function() {
                // Redirect to pengerjaan page with status filter
                const statusMap = ['pending', 'proses', 'selesai'];
                const status = statusMap[index];
                window.location.href = `<?= base_url('pengerjaan') ?>?status=${status}`;
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