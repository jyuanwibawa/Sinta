<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <title>Cetak - <?= html_escape($title); ?></title>
  <style>
    body { font-family: Arial, sans-serif; font-size: 12px; }
    .meta { margin-bottom: 10px; }
    table { width: 100%; border-collapse: collapse; }
    th, td { border: 1px solid #000; padding: 6px; vertical-align: top; }
    th { background: #eee; }
  </style>
</head>
<body onload="window.print()">

<h3><?= html_escape($title); ?></h3>

<div class="meta">
  Periode: <b><?= html_escape($start); ?></b> s/d <b><?= html_escape($end); ?></b><br>
  Dicetak oleh: <b><?= html_escape($printed_by); ?></b> | <?= html_escape($printed_at); ?>
</div>

<?php if (!empty($summary)): ?>
<p>
  <b>Ringkasan:</b>
  Total: <?= (int)$summary->total; ?> |
  Selesai: <?= (int)$summary->selesai; ?> |
  Proses: <?= (int)$summary->proses; ?> |
  Pending: <?= (int)$summary->pending; ?>
</p>
<?php endif; ?>

<table>
  <thead>
    <tr>
      <th style="width: 28px;">No</th>
      <th style="width: 90px;">Tanggal</th>
      <th style="width: 140px;">Ruangan</th>
      <th>Pekerjaan</th>
      <th style="width: 70px;">Prioritas</th>
      <th style="width: 80px;">Status</th>
      <th style="width: 110px;">Verifikasi</th>
      <th>Catatan</th>
    </tr>
  </thead>
  <tbody>
    <?php if (empty($rows)): ?>
      <tr><td colspan="8" style="text-align:center;">Tidak ada data.</td></tr>
    <?php else: ?>
      <?php $no=1; foreach ($rows as $r): ?>
        <tr>
          <td><?= $no++; ?></td>
          <td>
            <?= !empty($r->created_at) ? html_escape(date('Y-m-d', strtotime($r->created_at))) : '-' ?>
          </td>
          <td><?= html_escape($r->nama_ruangan ?? '-'); ?></td>
          <td><?= html_escape($r->tugas ?? '-'); ?></td>
          <td><?= html_escape($r->prioritas ?? '-'); ?></td>
          <td><?= html_escape($r->status ?? '-'); ?></td>
          <td><?= html_escape($r->verifikasi_status ?? '-'); ?></td>
          <td><?= html_escape($r->catatan ?? '-'); ?></td>
        </tr>
      <?php endforeach; ?>
    <?php endif; ?>
  </tbody>
</table>

</body>
</html>
