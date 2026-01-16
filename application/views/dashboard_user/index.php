<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SINTA Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="<?= base_url('assets/css/dashboard_user.css') ?>">
    <style>
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

        .icon-btn i.fa-book {
            font-size: 18px;
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
                <button class="icon-btn"
                         onclick="window.location.href='<?= site_url('notifikasiuser') ?>'">
                    <i class="fa-regular fa-bell"></i>
                    <?php if ($notif_unread > 0): ?>
                        <span class="badge-dot"><?= $notif_unread ?></span>
                    <?php endif; ?>
                </button>

                <button class="icon-btn"
                        onclick="window.open('<?= $buku_panduan_url ?>','panduan')" 
                        title="Buku Panduan">
                    <i class="fa-solid fa-book"></i>
                </button>

                <button class="icon-btn"
                        onclick="window.location.href='<?= base_url('loginuser/logout') ?>'">
                    <i class="fa-solid fa-arrow-right-from-bracket"></i>
                </button>
            </div>
        </div>

        <div class="status-cards-container">
            <div class="status-card menunggu">
                <div class="status-info">
                    <span class="status-count"><?= $pengerjaan_stats['pending'] ?? 0 ?></span>
                    <span class="status-title">Menunggu</span>
                </div>
            </div>

            <div class="status-card dikerjakan">
                <div class="status-info">
                    <span class="status-count"><?= $pengerjaan_stats['proses'] ?? 0 ?></span>
                    <span class="status-title">Dikerjakan</span>
                </div>
            </div>

            <div class="status-card selesai">
                <div class="status-info">
                    <span class="status-count"><?= $pengerjaan_stats['selesai'] ?? 0 ?></span>
                    <span class="status-title">Selesai</span>
                </div>
            </div>
        </div>

        <div class="progress-box">
            <div class="progress-header">
                <span>Progress Hari Ini</span>
                <span>
                    <?php
                        $total = $pengerjaan_stats['total'] ?? 0;
                        $selesai = $pengerjaan_stats['selesai'] ?? 0;
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
            <span class="task-count"><?= $pengerjaan_stats['total'] ?? 0 ?> tugas</span>
        </div>

        <?php if (!empty($pengerjaan_list)): ?>
            <?php foreach ($pengerjaan_list as $item): ?>
                <?php
                    $tugas_data = json_decode($item->tugas, true);
                    $first_tugas = is_array($tugas_data) ? $tugas_data[0] : $item->tugas;
                    $time = date('H:i', strtotime($item->created_at));
                ?>
                <div class="task-card" onclick="window.location.href='<?= base_url('detailtugas/detail') ?>'">
                    <div class="card-body">
                        <div class="icon-box yellow">
                            <i class="fa-regular fa-clock"></i>
                        </div>
                        <div class="task-info">
                            <h3><?= htmlspecialchars($first_tugas) ?></h3>
                            <p><?= htmlspecialchars($item->nama_ruangan) ?></p>
                        </div>
                    </div>
                    <div class="card-footer">
                        <span class="time"><?= $time ?></span>
                        <span class="status-pill"><?= ucfirst($item->status) ?></span>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="empty-state">
                <p>Belum ada tugas.</p>
            </div>
        <?php endif; ?>
    </main>
</body>
</html>
