<div class="container-fluid">
  <h4 class="mb-2">Cetak Laporan Rekap Bulanan</h4>
  <p class="text-muted">Buat dan cetak laporan rekap berdasarkan rentang tanggal</p>

  <div class="card">
    <div class="card-body">
      <div class="row">
        <div class="col-md-6">
          <label>Tanggal Mulai</label>
          <input type="date" id="start" class="form-control">
        </div>
        <div class="col-md-6">
          <label>Tanggal Akhir</label>
          <input type="date" id="end" class="form-control">
        </div>
      </div>

      <div class="mt-3">
        <button class="btn btn-primary" id="btnPreview">Lihat Preview</button>
        <button class="btn btn-success" id="btnPdf">Download PDF</button>
        <button class="btn btn-dark" id="btnPrint">Cetak</button>
      </div>
    </div>
  </div>
</div>

<script>
function getRangeOrAlert() {
  const start = document.getElementById('start').value;
  const end   = document.getElementById('end').value;
  if (!start || !end) { alert('Tanggal mulai dan akhir wajib diisi'); return null; }
  if (start > end) { alert('Tanggal mulai tidak boleh lebih besar dari tanggal akhir'); return null; }
  return { start, end };
}

document.getElementById('btnPreview').onclick = function() {
  const r = getRangeOrAlert(); if (!r) return;
  window.open("<?= site_url('CetakLaporanRekap/preview'); ?>?start="+r.start+"&end="+r.end, "_blank");
};
document.getElementById('btnPdf').onclick = function() {
  const r = getRangeOrAlert(); if (!r) return;
  window.open("<?= site_url('CetakLaporanRekap/pdf'); ?>?start="+r.start+"&end="+r.end, "_blank");
};
document.getElementById('btnPrint').onclick = function() {
  const r = getRangeOrAlert(); if (!r) return;
  window.open("<?= site_url('CetakLaporanRekap/print'); ?>?start="+r.start+"&end="+r.end, "_blank");
};
</script>
