<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <title><?= isset($title) ? $title : 'Cetak Laporan Rekap'; ?></title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>
<body class="bg-light">

<div class="container py-4">
  <h4 class="mb-1">Cetak Laporan Rekap Pekerjaan OB</h4>
  <p class="text-muted">Buat dan cetak laporan rekap berdasarkan rentang tanggal</p>

  <div class="card shadow-sm">
    <div class="card-body">
      <h4 class="mb-3">Pilih Periode Laporan</h4>

      <div class="row g-3">
        <div class="col-md-6">
          <label class="form-label">Tanggal Mulai</label>
          <input type="date" id="start" class="form-control" />
        </div>
        <div class="col-md-6">
          <label class="form-label">Tanggal Akhir</label>
          <input type="date" id="end" class="form-control" />
        </div>
      </div>

      <div class="d-flex gap-2 mt-4">
        <button class="btn btn-primary" id="btnPreview">
          Lihat Preview
        </button>
        <button class="btn btn-success" id="btnPdf">
          Download PDF
        </button>
        <button class="btn btn-dark" id="btnPrint">
          Cetak
        </button>
      </div>

      <small class="text-muted d-block mt-3">
        * Range tanggal dapat digunakan untuk rekap harian/mingguan/bulanan (sesuai kebutuhan administrasi KTU).
      </small>
    </div>
  </div>
</div>

<script>
  function getRangeOrAlert() {
    const start = document.getElementById('start').value;
    const end   = document.getElementById('end').value;

    if (!start || !end) {
      alert('Tanggal mulai dan tanggal akhir wajib diisi.');
      return null;
    }
    if (start > end) {
      alert('Tanggal mulai tidak boleh lebih besar dari tanggal akhir.');
      return null;
    }
    return { start, end };
  }

  document.getElementById('btnPreview').addEventListener('click', function() {
    const range = getRangeOrAlert();
    if (!range) return;

    const url = "<?= site_url('CetakLaporanRekap/preview'); ?>?start=" + range.start + "&end=" + range.end;
    window.open(url, '_blank');
  });

  document.getElementById('btnPdf').addEventListener('click', function() {
    const range = getRangeOrAlert();
    if (!range) return;

    const url = "<?= site_url('CetakLaporanRekap/pdf'); ?>?start=" + range.start + "&end=" + range.end;
    window.open(url, '_blank');
  });

  document.getElementById('btnPrint').addEventListener('click', function() {
    const range = getRangeOrAlert();
    if (!range) return;

    const url = "<?= site_url('CetakLaporanRekap/print'); ?>?start=" + range.start + "&end=" + range.end;
    window.open(url, '_blank');
  });
</script>

</body>
</html>
