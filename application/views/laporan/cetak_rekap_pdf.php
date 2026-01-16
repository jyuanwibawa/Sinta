<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <title><?= html_escape($title ?? 'Laporan Rekap'); ?></title>
  <style>
    @page { margin: 18px 16px; } 
    body { font-family: DejaVu Sans, Arial, sans-serif; font-size: 10px; color:#000; }

    h3 { margin: 0 0 6px 0; }
    .meta { margin-bottom: 6px; }
    .summary { margin: 6px 0 10px 0; }
    table { width: 100%; border-collapse: collapse; table-layout: fixed; }
    th, td { border: 1px solid #000; padding: 4px; vertical-align: top; }
    th { background: #eee; font-weight: bold; }
    td { word-wrap: break-word; overflow-wrap: break-word; }
    .nowrap { white-space: nowrap; }
    .col-no { width: 4%; text-align:center; }
    .col-tgl { width: 10%; }
    .col-ruang { width: 14%; }
    .col-prio { width: 8%; text-align:center; }
    .col-status { width: 9%; text-align:center; }
    .col-verif { width: 11%; text-align:center; }
    .col-tugas { width: 24%; }
    .col-cat { width: 20%; }
    .small { font-size: 9px; line-height: 1.2; }

  </style>
</head>
<body>

<h3><?= html_escape($title ?? 'Laporan Rekap Pekerjaan'); ?></h3>

<div class="meta">
  Periode: <b><?= html_escape($start); ?></b> s/d <b><?= html_escape($end); ?></b><br>
  Dicetak oleh: <b><?= html_escape($printed_by ?? 'KTU'); ?></b> | <?= html_escape($printed_at ?? date('Y-m-d H:i:s')); ?>
</div>

<?php if (!empty($summary)): ?>
<div class="summary">
  <b>Ringkasan:</b>
  Total: <?= (int)$summary->total; ?> |
  Selesai: <?= (int)$summary->selesai; ?> |
  Proses: <?= (int)$summary->proses; ?> |
  Pending: <?= (int)$summary->pending; ?>
</div>
<?php endif; ?>

<table>
  <thead>
    <tr>
      <th class="col-no">No</th>
      <th class="col-tgl">Tanggal</th>
      <th class="col-ruang">Ruangan</th>
      <th class="col-tugas">Pekerjaan</th>
      <th class="col-prio">Prioritas</th>
      <th class="col-status">Status</th>
      <th class="col-verif">Verifikasi</th>
      <th class="col-cat">Catatan</th>
    </tr>
  </thead>
  <tbody>
    <?php if (empty($rows)): ?>
      <tr>
        <td colspan="8" style="text-align:center;">Tidak ada data pada periode ini.</td>
      </tr>
    <?php else: ?>
      <?php $no=1; foreach ($rows as $r): ?>
        <?php
          $tanggal = !empty($r->created_at) ? date('Y-m-d', strtotime($r->created_at)) : '-';
          $ruangan = $r->nama_ruangan ?? '-';
          $tugas   = $r->tugas ?? '-';
          $prio    = $r->prioritas ?? '-';
          $status  = $r->status ?? '-';
          $verif   = $r->verifikasi_status ?? '-';
          $catatan = $r->catatan ?? '-';
        ?>
        <tr>
          <td class="col-no"><?= $no++; ?></td>
          <td class="col-tgl nowrap"><?= html_escape($tanggal); ?></td>
          <td class="col-ruang"><?= html_escape($ruangan); ?></td>
          <td class="col-tugas small"><?= html_escape($tugas); ?></td>
          <td class="col-prio"><?= html_escape($prio); ?></td>
          <td class="col-status"><?= html_escape($status); ?></td>
          <td class="col-verif"><?= html_escape($verif); ?></td>
          <td class="col-cat small"><?= html_escape($catatan); ?></td>
        </tr>
      <?php endforeach; ?>
    <?php endif; ?>
  </tbody>
</table>

</body>
</html>
