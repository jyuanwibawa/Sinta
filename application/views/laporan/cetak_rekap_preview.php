<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <title>Preview - <?= html_escape($title); ?></title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>
<body class="p-3">

<div class="container">
  <h5 class="mb-1"><?= html_escape($title); ?></h5>
  <div class="text-muted mb-3">
    Periode: <b><?= html_escape($start); ?></b> s/d <b><?= html_escape($end); ?></b><br>
    Dicetak oleh: <b><?= html_escape($printed_by); ?></b> | <?= html_escape($printed_at); ?>
  </div>

  <div class="row g-3 mb-3">
    <div class="col-md-3"><div class="card"><div class="card-body"><div class="text-muted">Total</div><div class="fs-4 fw-bold"><?= (int)$summary->total; ?></div></div></div></div>
    <div class="col-md-3"><div class="card"><div class="card-body"><div class="text-muted">Selesai</div><div class="fs-4 fw-bold"><?= (int)$summary->selesai; ?></div></div></div></div>
    <div class="col-md-3"><div class="card"><div class="card-body"><div class="text-muted">Pending</div><div class="fs-4 fw-bold"><?= (int)$summary->pending; ?></div></div></div></div>
    <div class="col-md-3"><div class="card"><div class="card-body"><div class="text-muted">Ditolak</div><div class="fs-4 fw-bold"><?= (int)$summary->ditolak; ?></div></div></div></div>
  </div>

  <div class="table-responsive">
    <table class="table table-bordered table-sm align-middle">
      <thead class="table-light">
        <tr>
          <th style="width: 120px;">Tanggal</th>
          <th>Pekerjaan</th>
          <th style="width: 160px;">Petugas</th>
          <th style="width: 110px;">Status</th>
          <th>Catatan</th>
        </tr>
      </thead>
      <tbody>
      <?php if (empty($rows)): ?>
        <tr><td colspan="5" class="text-center text-muted">Tidak ada data pada periode ini.</td></tr>
      <?php else: ?>
        <?php foreach ($rows as $r): ?>
          <tr>
            <td><?= html_escape($r->tanggal); ?></td>
            <td><?= html_escape($r->nama_pekerjaan); ?></td>
            <td><?= html_escape($r->petugas ?: '-'); ?></td>
            <td><?= html_escape($r->status); ?></td>
            <td><?= html_escape($r->catatan ?: '-'); ?></td>
          </tr>
        <?php endforeach; ?>
      <?php endif; ?>
      </tbody>
    </table>
  </div>
</div>

</body>
</html>
