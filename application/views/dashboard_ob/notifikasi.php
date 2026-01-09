<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Notifikasi</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <link rel="stylesheet" href="<?= base_url('assets/css/notifikasi.css') ?>">
</head>
<body>

<header class="header">
    <div class="nav-row">
        <a href="<?= base_url('dashboard_user') ?>" class="back-link">
            <i class="fa-solid fa-arrow-left"></i> Kembali
        </a>
    </div>
    <h1 class="page-title">Notifikasi</h1>
</header>

<main class="notif-container">

    <?php if (!empty($notifikasi)) : ?>
        <?php foreach ($notifikasi as $n) : ?>
            <article class="notif-card">
                <div class="notif-icon-box">
                    <i class="fa-solid fa-bell"></i>
                </div>

                <div class="notif-content">
                    <h2 class="notif-title">
                        <?= htmlspecialchars($n->judul ?? 'Notifikasi') ?>
                    </h2>

                    <p class="notif-desc">
                        <?= htmlspecialchars($n->pesan) ?>
                    </p>

                    <span class="notif-time">
                        <i class="fa-regular fa-clock"></i>
                        <?= date('d M Y H:i', strtotime($n->created_at)) ?>
                    </span>
                </div>
            </article>
        <?php endforeach; ?>

    <?php else : ?>
        <article class="notif-card">
            <div class="notif-content">
                <p class="notif-desc">Belum ada notifikasi.</p>
            </div>
        </article>
    <?php endif; ?>

</main>

</body>
</html>
