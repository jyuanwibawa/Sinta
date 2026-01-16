<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <title><?= html_escape($title); ?></title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <style>
    body{margin:0;background:#f3f4f6;font-family:Arial,Helvetica,sans-serif;color:#111827}
    .wrap{max-width:980px;margin:20px auto;padding:0 14px}
    h2{margin:0 0 6px 0;font-size:18px}
    .sub{margin:0 0 14px 0;color:#6b7280;font-size:12px}

    .card{background:#fff;border-radius:10px;box-shadow:0 1px 2px rgba(0,0,0,.08);padding:14px;margin-bottom:12px}
    .row{display:flex;gap:12px;flex-wrap:wrap}
    .col{flex:1;min-width:240px}
    label{display:block;font-size:12px;color:#6b7280;margin-bottom:6px}
    input[type="date"]{width:100%;box-sizing:border-box;border:1px solid #e5e7eb;border-radius:8px;padding:10px;font-size:13px}
    .btn{border:0;border-radius:8px;padding:10px 12px;background:#2563eb;color:#fff;font-weight:700;cursor:pointer}

    .title-sm{font-weight:800;font-size:13px;margin-bottom:8px}
    .muted{font-size:12px;color:#6b7280}

    .badge{display:inline-block;padding:4px 10px;border-radius:999px;font-size:11px;font-weight:700}
    .b-ok{background:#dcfce7}
    .b-warn{background:#fef9c3}
    .b-bad{background:#fee2e2}

    .bar{height:10px;border-radius:999px;background:#e5e7eb;overflow:hidden}
    .bar > div{height:100%}
    .bar-good{background:#22c55e}
    .bar-bad{background:#ef4444}

    table{width:100%;border-collapse:collapse}
    th,td{border-bottom:1px solid #e5e7eb;padding:10px 6px;font-size:12px;vertical-align:top}
    th{color:#6b7280;font-size:11px;text-transform:none}
  </style>

  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>

<div class="wrap">
  <h2>Statistik Kinerja</h2>
  <p class="sub">Evaluasi kinerja berdasarkan kebersihan dan kerapihan</p>

  <!-- Periode -->
  <div class="card">
    <div class="muted" style="margin-bottom:6px;">Periode:</div>
    <form method="get" action="<?= site_url('StatistikKinerjaTu'); ?>" class="row">
      <div class="col">
        <input type="date" name="start" value="<?= html_escape($start); ?>">
      </div>
      <div class="col">
        <input type="date" name="end" value="<?= html_escape($end); ?>">
      </div>
      <div class="col" style="min-width:160px;flex:0;">
        <button type="submit" class="btn" style="width:100%;">Tampilkan</button>
      </div>
    </form>
  </div>

  <!-- Indikator Komplain -->
  <?php
    $pct = ($max_komplain > 0) ? min(100, ($total_komplain / $max_komplain) * 100) : 0;
    $melebihi = ($total_komplain > $max_komplain);
  ?>
  <div class="card" style="border-left:4px solid <?= $melebihi ? '#ef4444' : '#22c55e' ?>;">
    <div class="title-sm">Indikator Komplain</div>
    <div class="muted">Total Komplain Periode Ini</div>

    <div style="display:flex;justify-content:space-between;align-items:center;margin-top:6px;">
      <div style="font-size:18px;font-weight:900;">
        <?= (int)$total_komplain; ?> <span class="muted">/ <?= (int)$max_komplain; ?> (Maksimal)</span>
      </div>
      <div>
        <?php if ($melebihi): ?>
          <span class="badge b-bad">Melebihi Batas</span>
        <?php else: ?>
          <span class="badge b-ok">Aman</span>
        <?php endif; ?>
      </div>
    </div>

    <div style="margin-top:10px;" class="bar">
      <div class="<?= $melebihi ? 'bar-bad' : 'bar-good' ?>" style="width:<?= (int)$pct ?>%"></div>
    </div>
  </div>

  <!-- Ringkasan -->
  <div class="card">
    <div class="title-sm">Ringkasan Periode</div>
    <div class="row">
      <div class="col">
        <div class="muted">Jumlah Ruangan Bersih</div>
        <div style="font-size:18px;font-weight:900;"><?= (int)$ruangan_bersih; ?></div>
      </div>
      <div class="col">
        <div class="muted">Rata-rata Waktu Penyelesaian</div>
        <div style="font-size:18px;font-weight:900;"><?= number_format((float)$avg_menit, 1); ?> <span class="muted">menit</span></div>
      </div>
    </div>
  </div>

  <!-- Tabel Kinerja -->
  <div class="card">
    <div class="title-sm">Kinerja Individual Office Boy</div>

    <table>
      <thead>
        <tr>
          <th>Nama</th>
          <th>Total Tugas</th>
          <th>Selesai</th>
          <th>Komplain</th>
          <th>Kebersihan</th>
          <th>Kerapihan</th>
          <th>Status</th>
        </tr>
      </thead>
      <tbody>
      <?php if (empty($list_ob)): ?>
        <tr><td colspan="7" class="muted">Tidak ada data pada periode ini.</td></tr>
      <?php else: ?>
        <?php foreach ($list_ob as $ob): ?>
          <?php
            $nama = $ob->nama_ob ? $ob->nama_ob : ('ID: '.$ob->id_user);
            $kb = $ob->kebersihan ? (float)$ob->kebersihan : 0;
            $kr = $ob->kerapihan ? (float)$ob->kerapihan : 0;
            $kom = (int)$ob->komplain;

            // aturan status (boleh kamu ubah)
            $label='Baik'; $cls='b-ok';
            if ($kom > 5 || $kb < 7 || $kr < 7) { $label='Cukup'; $cls='b-warn'; }
            if ($kom > 10 || $kb < 6 || $kr < 6) { $label='Perlu Perhatian'; $cls='b-bad'; }
          ?>
          <tr>
            <td><?= html_escape($nama); ?></td>
            <td><?= (int)$ob->total_tugas; ?></td>
            <td><?= (int)$ob->selesai; ?></td>
            <td><?= (int)$kom; ?></td>
            <td><?= $kb ? number_format($kb,1) : '-'; ?>/10</td>
            <td><?= $kr ? number_format($kr,1) : '-'; ?>/10</td>
            <td><span class="badge <?= $cls ?>"><?= $label ?></span></td>
          </tr>
        <?php endforeach; ?>
      <?php endif; ?>
      </tbody>
    </table>

    <div style="margin-top:10px;" class="muted">
      <b>Catatan Penilaian</b><br>
      • Skor kebersihan & kerapihan dinilai dari 1–10<br>
      • Maksimal komplain per bulan: 10 kasus<br>
      • Komplain > 10 perlu perhatian khusus
    </div>
  </div>

  <!-- Diagram -->
  <div class="card">
    <div class="title-sm">Diagram Skor (Kebersihan & Kerapihan)</div>
    <canvas id="chartSkor" height="120"></canvas>
  </div>

</div>

<script>
(function(){
  const rows = <?= json_encode($list_ob ?? []); ?>;
  const labels = rows.map(r => (r.nama_ob && r.nama_ob.length ? r.nama_ob : ('ID '+r.id_user)));
  const keb = rows.map(r => parseFloat(r.kebersihan || 0));
  const ker = rows.map(r => parseFloat(r.kerapihan || 0));

  const ctx = document.getElementById('chartSkor').getContext('2d');
  new Chart(ctx, {
    type: 'bar',
    data: {
      labels: labels,
      datasets: [
        { label: 'Kebersihan', data: keb },
        { label: 'Kerapihan', data: ker }
      ]
    },
    options: {
      responsive: true,
      scales: {
        y: { beginAtZero:true, suggestedMax:10 }
      }
    }
  });
})();
</script>

</body>
</html>
