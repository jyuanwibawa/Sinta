<script src="<?= base_url('assets/js/tu.js') ?>"></script>

<script>
document.addEventListener('DOMContentLoaded', function () {

  function getRangeOrAlert() {
    const startEl = document.getElementById('rekap_start');
    const endEl   = document.getElementById('rekap_end');

    // ✅ kalau elemen belum ada, stop tanpa error
    if (!startEl || !endEl) return null;

    const start = startEl.value;
    const end   = endEl.value;

    if (!start || !end) { alert('Tanggal mulai dan akhir wajib diisi'); return null; }
    if (start > end) { alert('Tanggal mulai tidak boleh lebih besar dari tanggal akhir'); return null; }
    return { start, end };
  }

  const btnPrev = document.getElementById('btnRekapPreview');
  const btnPdf  = document.getElementById('btnRekapPdf');
  const btnPrn  = document.getElementById('btnRekapPrint');

  // ✅ pasang event hanya kalau tombolnya ada
  if (btnPrev) btnPrev.addEventListener('click', function(){
    const r = getRangeOrAlert(); if (!r) return;
    window.open("<?= site_url('CetakLaporanRekap/preview'); ?>?start="+r.start+"&end="+r.end, "_blank");
  });

  if (btnPdf) btnPdf.addEventListener('click', function(){
    const r = getRangeOrAlert(); if (!r) return;
    window.open("<?= site_url('CetakLaporanRekap/pdf'); ?>?start="+r.start+"&end="+r.end, "_blank");
  });

  if (btnPrn) btnPrn.addEventListener('click', function(){
    const r = getRangeOrAlert(); if (!r) return;
    window.open("<?= site_url('CetakLaporanRekap/print'); ?>?start="+r.start+"&end="+r.end, "_blank");
  });

});
</script>
