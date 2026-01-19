<div class="app"> 

  <div class="sidebar">
    <div class="sidebar-brand">
      <span class="brand-title">SINTA</span>
      <span class="brand-subtitle">Sinergitas Data</span>
    </div>

    <ul class="sidebar-menu">
      <li class="menu-item active" data-page="dashboard">
        <span class="menu-icon"><i class="fa-solid fa-grip"></i></span>
        <span class="menu-text">Dashboard</span>
      </li>
      <li class="menu-item" data-page="laporan-ob">
        <span class="menu-icon"><i class="fa-regular fa-file-lines"></i></span>
        <span class="menu-text">Laporan Pekerjaan OB</span>
      </li>
      <li class="menu-item" data-page="verifikasi">
        <span class="menu-icon"><i class="fa-regular fa-square-check"></i></span>
        <span class="menu-text">Verifikasi Laporan</span>
      </li>
      <li class="menu-item" data-page="cetak-rekap">
        <span class="menu-icon"><i class="fa-solid fa-print"></i></span>
        <span class="menu-text">Cetak Laporan Rekap</span>
      </li>
      <li class="menu-item" data-page="statistik">
        <span class="menu-icon"><i class="fa-solid fa-chart-column"></i></span>
        <span class="menu-text">Statistik Kinerja</span>
      </li>
    </ul>
  </div>

  <div class="main">
    <!-- TOPBAR -->
    <header class="topbar">
      <div class="topbar-left">
        <div class="menu-toggle">&#9776;</div>
        <div class="topbar-title">
          Selamat Datang, <strong>Pengadilan Negeri Surabaya</strong>
        </div>
      </div>
      <div class="user-pill">
        <div class="user-avatar">T</div>
        <div class="user-name">Tata Usaha</div>

        <!-- TAMBAHAN LOGOUT (tanpa ubah struktur) -->
        <a href="<?= site_url('DashboardTu/logout'); ?>"
           style="margin-left:12px;font-size:12px;font-weight:700;color:#ef4444;text-decoration:none;"
           onclick="return confirm('Yakin ingin logout?')">
          Logout
        </a>
      </div>
    </header>

    <main class="content">

      <section data-page-section="dashboard">
        <h2 class="section-title">Dashboard TU &amp; Keuangan</h2>
        <div class="card-row">
          <div class="card">
            <div class="card-badge blue"></div>
            <div class="card-title">Laporan Hari Ini</div>
            <div class="card-value"><?= isset($total_hari_ini) ? $total_hari_ini : 0 ?></div>
          </div>
          <div class="card">
            <div class="card-badge yellow"></div>
            <div class="card-title">Menunggu Verifikasi</div>
            <div class="card-value"><?= isset($total_menunggu) ? $total_menunggu : 0 ?></div>
          </div>
          <div class="card">
            <div class="card-badge green"></div>
            <div class="card-title">Terverifikasi</div>
            <div class="card-value"><?= isset($total_terverifikasi) ? $total_terverifikasi : 0 ?></div>
          </div>
          <div class="card">
            <div class="card-badge red"></div>
            <div class="card-title">Komplain Bulan Ini</div>
            <div class="card-value"><?= isset($total_komplain) ? $total_komplain : 0 ?></div>
          </div>
        </div>
      </section>

      <!-- LAPORAN OB -->
      <section data-page-section="laporan-ob" style="display:none">
        <h2 class="section-title">Laporan Pekerjaan OB</h2>
        <p style="font-size:13px;color:#6b7280;margin-bottom:10px">
          Monitoring real-time pekerjaan harian Office Boy.
        </p>

        <div class="filter-bar">
          <button class="filter-btn active" type="button">Semua</button>
          <button class="filter-btn" type="button">Selesai</button>
          <button class="filter-btn" type="button">Dalam Proses</button>
        </div>

        <div class="job-list" id="laporan-ob-container"></div>
      </section>

      <!-- VERIFIKASI & EVALUASI -->
      <section data-page-section="verifikasi" style="display:none">
        <h2 class="section-title">Verifikasi &amp; Evaluasi Laporan</h2>

        <div class="verif-header">
          <div class="verif-summary-card">
            <div class="card-title">Menunggu Verifikasi</div>
            <div class="card-value"><?= isset($total_menunggu) ? $total_menunggu : 0 ?></div>
          </div>

          <div class="verif-summary-card">
            <div class="card-title">Disetujui</div>
            <div class="card-value"><?= isset($total_terverifikasi) ? $total_terverifikasi : 0 ?></div>
          </div>

          <div class="verif-summary-card">
            <div class="card-title">Perlu Perbaikan</div>
            <div class="card-value"><?= isset($total_ditolak) ? $total_ditolak : 0 ?></div>
          </div>
        </div>

        <div class="verif-list">
          <?php if (!empty($laporan)): ?>
            <?php foreach ($laporan as $row): ?>
              <div class="verif-card <?= ($row->verifikasi_status == 'disetujui') ? 'success' : '' ?>">
                <div class="job-info-title">
                  <?= $row->nama_ob ?> • <?= $row->nama_ruangan ?>
                </div>
                <div class="job-info-meta">
                  <?= $row->completed_at ?>
                </div>
                <div class="job-info-activity" style="margin-top:6px">
                  Aktivitas: <?= $row->tugas ?>
                </div>

                <?php if (
                  $row->status == 'selesai' &&
                  (empty($row->verifikasi_status) || $row->verifikasi_status == 'menunggu')
                ): ?>
                  <button 
                    type="button"
                    class="btn btn-preview open-modal"
                    data-id="<?= $row->id_pengerjaan ?>"
                    data-nama="<?= $row->nama_ob ?>"
                    data-lokasi="<?= $row->nama_ruangan ?>"
                    data-eval-count="<?= (int)($row->eval_count ?? 0) ?>"
                    data-point-awal="<?= (int)($row->point_awal ?? 100) ?>"
                    data-point-minus="<?= (int)($row->point_minus_total ?? 0) ?>"
                    <!-- ===================== -->
                    <!-- TAMBAHAN REVISI: point akhir dari DB -->
                    <!-- kalau point_akhir masih null, fallback hitung dari eval_count -->
                    data-point-akhir="<?= ($row->point_akhir !== null && $row->point_akhir !== '' ? (int)$row->point_akhir : max(0, 100 - ((int)($row->eval_count ?? 0) * 10))) ?>">
                    <!-- ===================== -->
                    Evaluasi
                  </button>
                <?php else: ?>
                  <div style="margin-top:6px;font-size:12px;color:#374151">
                    Catatan: <?= $row->verifikasi_catatan ?>
                  </div>

                  <!-- ===================== -->
                  <!-- REVISI: cek null/kosong supaya tampil konsisten -->
                  <?php if ($row->point_akhir !== null && $row->point_akhir !== ''): ?>
                    <div style="margin-top:6px;font-size:12px;color:#6b7280">
                      Poin Akhir: <b><?= (int)$row->point_akhir ?></b>
                    </div>
                  <?php endif; ?>
                  <!-- ===================== -->
                <?php endif; ?>
              </div>
            <?php endforeach; ?>
          <?php else: ?>
            <p style="font-size:13px;color:#6b7280">Tidak ada laporan untuk diverifikasi.</p>
          <?php endif; ?>
        </div>
      </section>

      <!-- CETAK LAPORAN REKAP -->
      <section data-page-section="cetak-rekap" style="display:none">
        <h2 class="section-title">Cetak Laporan Rekap Pekerjaan OB</h2>
        <p style="font-size:13px;color:#6b7280;margin-bottom:10px">
          Buat dan cetak laporan rekap berdasarkan rentang tanggal
        </p>

        <div style="background:#fff;border-radius:10px;padding:16px;">
          <div style="font-weight:700;margin-bottom:10px;">Pilih Periode Laporan</div>

          <div style="display:flex;gap:12px;flex-wrap:wrap">
            <div style="flex:1;min-width:240px">
              <label style="font-size:12px;color:#374151;margin-bottom:6px;display:block;">Tanggal Mulai</label>
              <input type="date" id="rekap_start" class="form-control" style="width:100%">
            </div>
            <div style="flex:1;min-width:240px">
              <label style="font-size:12px;color:#374151;margin-bottom:6px;display:block;">Tanggal Akhir</label>
              <input type="date" id="rekap_end" class="form-control" style="width:100%">
            </div>
          </div>

          <div style="margin-top:12px;display:flex;gap:10px;flex-wrap:wrap">
            <button type="button" class="btn btn-preview" id="btnRekapPreview">Lihat Preview</button>
            <button type="button" class="btn btn-approve" id="btnRekapPdf">Download PDF</button>
            <button type="button" class="btn btn-cancel" id="btnRekapPrint">Cetak</button>
          </div>
        </div>
      </section>

      <!-- STATISTIK KINERJA -->
      <section data-page-section="statistik" style="display:none">
        <h2 class="section-title">Statistik Kinerja</h2>
        <p style="font-size:13px;color:#6b7280;margin-bottom:10px">
          Evaluasi kinerja berdasarkan kebersihan dan kerapihan
        </p>

        <!-- Periode -->
        <div style="background:#fff;border-radius:10px;padding:16px;margin-bottom:12px;">
          <div style="font-weight:700;margin-bottom:10px;">Periode</div>

          <div style="display:flex;gap:12px;flex-wrap:wrap">
            <div style="flex:1;min-width:240px">
              <input type="date" id="stat_start"
                value="<?= html_escape(isset($stat_start) ? $stat_start : date('Y-m-01')); ?>"
                style="width:100%;padding:10px;border:1px solid #e5e7eb;border-radius:8px;">
            </div>
            <div style="flex:1;min-width:240px">
              <input type="date" id="stat_end"
                value="<?= html_escape(isset($stat_end) ? $stat_end : date('Y-m-t')); ?>"
                style="width:100%;padding:10px;border:1px solid #e5e7eb;border-radius:8px;">
            </div>
            <div style="min-width:160px">
              <button type="button" class="btn btn-preview" id="btnStatTampilkan">Tampilkan</button>
            </div>
          </div>
        </div>

        <!-- Indikator Komplain -->
        <?php
          $maxK = isset($max_komplain) ? (int)$max_komplain : 10;

          // komplain periode
          $komp = isset($total_komplain_stat) ? (int)$total_komplain_stat : 0;

          // fallback jika komplain 0 dan ada total_menunggu (pending)
          if ($komp === 0 && isset($total_menunggu)) {
            $komp = (int)$total_menunggu;
          }

          $pct = ($maxK > 0) ? min(100, ($komp / $maxK) * 100) : 0;
          $melebihi = ($komp > $maxK);
        ?>
        <div style="background:#fff;border-radius:10px;padding:16px;margin-bottom:12px;border-left:4px solid <?= $melebihi ? '#ef4444' : '#2563eb' ?>;">
          <div style="font-weight:700;margin-bottom:4px;">Indikator Komplain</div>
          <div style="font-size:12px;color:#6b7280;margin-bottom:10px;">Total Komplain Periode Ini</div>

          <div style="display:flex;justify-content:space-between;align-items:center;gap:10px;flex-wrap:wrap">
            <div style="font-size:22px;font-weight:800;">
              <?= $komp ?> <span style="font-size:12px;color:#6b7280">/ <?= $maxK ?> (Maksimal)</span>
            </div>
            <div style="padding:6px 10px;border-radius:999px;font-size:12px;font-weight:700;background:<?= $melebihi ? '#fee2e2' : '#dcfce7' ?>;">
              <?= $melebihi ? 'Melebihi Batas' : 'Aman' ?>
            </div>
          </div>

          <div style="margin-top:10px;height:10px;border-radius:999px;background:#e5e7eb;overflow:hidden;">
            <div style="height:100%;width:<?= (int)$pct ?>%;background:<?= $melebihi ? '#ef4444' : '#22c55e' ?>;"></div>
          </div>
        </div>

        <!-- Ringkasan -->
        <div style="background:#fff;border-radius:10px;padding:16px;margin-bottom:12px;">
          <div style="display:flex;gap:12px;flex-wrap:wrap">
            <div style="flex:1;min-width:240px">
              <div style="font-size:12px;color:#6b7280;">Jumlah Ruangan Bersih</div>
              <div style="font-size:22px;font-weight:800;"><?= (int)(isset($ruangan_bersih) ? $ruangan_bersih : 0) ?></div>
            </div>
            <div style="flex:1;min-width:240px">
              <div style="font-size:12px;color:#6b7280;">Rata-rata Waktu Penyelesaian</div>
              <div style="font-size:22px;font-weight:800;">
                <?= number_format((float)(isset($avg_menit) ? $avg_menit : 0), 1) ?> <span style="font-size:12px;color:#6b7280;">menit</span>
              </div>
            </div>
          </div>
        </div>

        <!-- Tabel Kinerja OB -->
        <div style="background:#fff;border-radius:10px;padding:16px;margin-bottom:12px;">
          <div style="font-weight:700;margin-bottom:10px;">Kinerja Individual Office Boy</div>

          <div style="overflow:auto;">
            <table style="width:100%;border-collapse:collapse;font-size:12px;min-width:720px;">
              <thead>
                <tr style="color:#6b7280;text-align:left;">
                  <th style="padding:10px 6px;border-bottom:1px solid #e5e7eb;">Nama</th>
                  <th style="padding:10px 6px;border-bottom:1px solid #e5e7eb;">Total Tugas</th>
                  <th style="padding:10px 6px;border-bottom:1px solid #e5e7eb;">Selesai</th>
                  <th style="padding:10px 6px;border-bottom:1px solid #e5e7eb;">Komplain</th>
                  <th style="padding:10px 6px;border-bottom:1px solid #e5e7eb;">Kebersihan</th>
                  <th style="padding:10px 6px;border-bottom:1px solid #e5e7eb;">Kerapihan</th>
                  <th style="padding:10px 6px;border-bottom:1px solid #e5e7eb;">Status</th>
                </tr>
              </thead>
              <tbody>
              <?php if (empty($list_ob)): ?>
                <tr>
                  <td colspan="7" style="padding:12px;color:#6b7280;">Tidak ada data pada periode ini.</td>
                </tr>
              <?php else: ?>
                <?php foreach ($list_ob as $ob): ?>
                  <?php
                    $nama = '';
                    if (!empty($ob->display_nama)) $nama = $ob->display_nama;
                    else if (!empty($ob->nama_ob)) $nama = $ob->nama_ob;
                    else if (!empty($ob->nama)) $nama = $ob->nama;
                    else if (!empty($ob->full_name)) $nama = $ob->full_name;
                    else if (!empty($ob->username)) $nama = $ob->username;

                    if ($nama === '') $nama = 'OB ' . (int)(isset($ob->id_user) ? $ob->id_user : 0);

                    $kb = isset($ob->kebersihan) ? (float)$ob->kebersihan : 0;
                    $kr = isset($ob->kerapihan)  ? (float)$ob->kerapihan  : 0;
                    $kom = isset($ob->komplain)  ? (int)$ob->komplain     : 0;

                    $label='Baik'; $bg='#dcfce7';
                    if ($kom > 5 || $kb < 7 || $kr < 7) { $label='Cukup'; $bg='#fef9c3'; }
                    if ($kom > 10 || $kb < 6 || $kr < 6) { $label='Perlu Perhatian'; $bg='#fee2e2'; }
                  ?>
                  <tr>
                    <td style="padding:10px 6px;border-bottom:1px solid #e5e7eb;"><?= html_escape($nama) ?></td>
                    <td style="padding:10px 6px;border-bottom:1px solid #e5e7eb;"><?= (int)$ob->total_tugas ?></td>
                    <td style="padding:10px 6px;border-bottom:1px solid #e5e7eb;"><?= (int)$ob->selesai ?></td>
                    <td style="padding:10px 6px;border-bottom:1px solid #e5e7eb;"><?= (int)$kom ?></td>
                    <td style="padding:10px 6px;border-bottom:1px solid #e5e7eb;"><?= number_format((float)($kb ?? 0), 1) ?>/10</td>
                    <td style="padding:10px 6px;border-bottom:1px solid #e5e7eb;"><?= number_format((float)($kr ?? 0), 1) ?>/10</td>
                    <td style="padding:10px 6px;border-bottom:1px solid #e5e7eb;">
                      <span style="display:inline-block;padding:6px 10px;border-radius:999px;font-size:11px;font-weight:700;background:<?= $bg ?>;">
                        <?= $label ?>
                      </span>
                    </td>
                  </tr>
                <?php endforeach; ?>
              <?php endif; ?>
              </tbody>
            </table>
          </div>

          <div style="margin-top:10px;font-size:12px;color:#6b7280;">
            <b>Catatan Penilaian</b><br>
            • Skor kebersihan & kerapihan dinilai 1–10<br>
            • Maks komplain per bulan: 10 kasus<br>
            • Komplain > 10 perlu perhatian khusus
          </div>
        </div>

        <!-- Diagram -->
        <div style="background:#fff;border-radius:10px;padding:16px;">
          <div style="font-weight:700;margin-bottom:10px;">Diagram Skor (Kebersihan & Kerapihan)</div>
          <canvas id="chartSkor" height="130"></canvas>
          <div id="chartInfo" style="font-size:12px;color:#6b7280;margin-top:8px;"></div>
        </div>

        <!-- Chart.js CDN -->
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

        <script>
        (function(){
          // tombol tampilkan => reload + hash statistik
          const btn = document.getElementById('btnStatTampilkan');
          if (btn) {
            btn.addEventListener('click', function(){
              const s = document.getElementById('stat_start')?.value;
              const e = document.getElementById('stat_end')?.value;

              if (!s || !e) { alert('Tanggal periode wajib diisi'); return; }
              if (s > e) { alert('Tanggal mulai tidak boleh lebih besar dari tanggal akhir'); return; }

              const url = "<?= site_url('DashboardTu'); ?>" +
                "?stat_start=" + encodeURIComponent(s) +
                "&stat_end=" + encodeURIComponent(e) +
                "#statistik";

              window.location.href = url;
            });
          }

          // render chart
          const canvas = document.getElementById('chartSkor');
          const info = document.getElementById('chartInfo');
          if (!canvas) return;

          if (!window.Chart) {
            if (info) info.innerText = 'Chart.js belum termuat.';
            return;
          }

          const rows = <?= json_encode(isset($list_ob) ? $list_ob : []); ?>;
          if (!rows.length) {
            if (info) info.innerText = 'Tidak ada data pada periode ini, diagram tidak ditampilkan.';
            return;
          }

          const labels = rows.map(r => (r.display_nama || r.nama_ob || r.nama || r.full_name || r.username || ('OB ' + (isset(r.id_user) ? r.id_user : ''))));
          const keb = rows.map(r => parseFloat(r.kebersihan || 0));
          const ker = rows.map(r => parseFloat(r.kerapihan || 0));

          if (window.__chartSkor) window.__chartSkor.destroy();

          window.__chartSkor = new Chart(canvas.getContext('2d'), {
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
              plugins: { legend: { display: true } },
              scales: { y: { beginAtZero: true, suggestedMax: 10 } }
            }
          });
        })();
        </script>

      </section>

      <!-- MODAL EVALUASI TU -->
      <div class="modal-backdrop" id="modal-evaluasi" style="display:none;">
        <div class="modal">
          <div class="modal-header">
            <div>
              <div id="modal-nama" style="font-size:14px;font-weight:600">OB:</div>
              <div id="modal-lokasi" style="font-size:12px;color:#6b7280;margin-top:2px">Area:</div>

              <div id="modal-point" style="margin-top:8px;font-size:32px;font-weight:700">100</div>
              <div id="modal-point-desc" style="font-size:12px">
                Total Poin • Setiap evaluasi mengurangi 10 poin • Maks 10 evaluasi
              </div>

              <div style="margin-top:6px;font-size:12px;color:#6b7280;">
                Evaluasi: <b id="modal-eval-count">0</b> / 10
              </div>
            </div>
          </div>

          <div class="modal-body">
            <form id="form-evaluasi" action="<?= site_url('DashboardTu/verifikasi') ?>" method="post">
              <input type="hidden" name="id_pengerjaan" id="modal-id">

              <input type="hidden" name="eval_count" id="modal-eval-count-input" value="0">
              <input type="hidden" name="point_akhir" id="modal-point-input" value="100">

              <label style="font-size:13px;font-weight:600">Tambah Catatan Evaluasi</label>

              <textarea
                name="catatan_tu"
                id="modal-catatan"
                placeholder="Tulis catatan evaluasi..."
                required></textarea>

              <div style="margin-top:10px;display:flex;gap:10px;flex-wrap:wrap;">
                <button type="button" class="btn btn-preview" id="btnTambahEvaluasi">
                  Tambah Evaluasi (-10)
                </button>

                <button type="button" class="btn btn-cancel" id="btnResetEvaluasi">
                  Reset Evaluasi
                </button>
              </div>

              <div class="modal-footer">
                <button type="submit" name="status_verifikasi" value="disetujui" class="btn btn-approve" id="btnSetujui">
                  Setujui (100 poin)
                </button>

                <button type="submit" name="status_verifikasi" value="perlu_perbaikan" class="btn btn-needfix" id="btnPerluPerbaikan">
                  Perlu Perbaikan (100 poin)
                </button>

                <button type="button" class="btn btn-cancel" data-close-modal>
                  Batal
                </button>
              </div>
            </form>
          </div>

        </div>
      </div>

      <!-- SCRIPT MINIMAL -->
      <script>
      document.addEventListener('DOMContentLoaded', function () {

        const menuItems = document.querySelectorAll('.menu-item[data-page]');
        const sections  = document.querySelectorAll('[data-page-section]');

        function showSection(page) {
          sections.forEach(sec => {
            sec.style.display = (sec.getAttribute('data-page-section') === page) ? '' : 'none';
          });
          menuItems.forEach(mi => {
            mi.classList.toggle('active', mi.getAttribute('data-page') === page);
          });
        }

        function getPageFromHash() {
          const h = (window.location.hash || '').replace('#','');
          return h ? h : 'dashboard';
        }

        menuItems.forEach(item => {
          item.addEventListener('click', function () {
            const page = this.getAttribute('data-page');
            showSection(page);
            window.location.hash = page;
          });
        });

        showSection(getPageFromHash());

        window.addEventListener('hashchange', function(){
          showSection(getPageFromHash());
        });

        function getRangeOrAlert() {
          const startEl = document.getElementById('rekap_start');
          const endEl   = document.getElementById('rekap_end');
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

        // ====== MODAL EVALUASI & AJAX ======
        const modal = document.getElementById('modal-evaluasi');
        const form  = document.getElementById('form-evaluasi');

        const elNama   = document.getElementById('modal-nama');
        const elLokasi = document.getElementById('modal-lokasi');
        const elId     = document.getElementById('modal-id');

        const elPoint     = document.getElementById('modal-point');
        const elEvalCount = document.getElementById('modal-eval-count');
        const elCatatan   = document.getElementById('modal-catatan');

        const btnSetujui  = document.getElementById('btnSetujui');
        const btnPerbaiki = document.getElementById('btnPerluPerbaikan');

        const btnTambahEvaluasi = document.getElementById('btnTambahEvaluasi');
        const btnResetEvaluasi  = document.getElementById('btnResetEvaluasi');

        const POTONG_PER_EVAL = 10;
        const MAX_EVAL = 10;

        let __evalCount = 0;
        let __pointAkhir = 100;

        function syncButtonTambahEvaluasi() {
          if (!btnTambahEvaluasi) return;

          if (__evalCount >= MAX_EVAL) {
            btnTambahEvaluasi.disabled = true;
            btnTambahEvaluasi.innerText = 'Evaluasi Maksimal 10x';
          } else {
            btnTambahEvaluasi.disabled = false;
            btnTambahEvaluasi.innerText = 'Tambah Evaluasi (-' + POTONG_PER_EVAL + ')';
          }
        }

        function setUiEvaluasi() {
          if (elPoint) elPoint.innerText = String(__pointAkhir);
          if (elEvalCount) elEvalCount.innerText = String(__evalCount);

          if (btnSetujui) btnSetujui.innerText = 'Setujui (' + __pointAkhir + ' poin)';
          if (btnPerbaiki) btnPerbaiki.innerText = 'Perlu Perbaikan (' + __pointAkhir + ' poin)';

          syncButtonTambahEvaluasi();
        }

        function openModal(btn) {
          if (!modal) return;

          const id = btn.getAttribute('data-id');
          const nama = btn.getAttribute('data-nama') || '';
          const lokasi = btn.getAttribute('data-lokasi') || '';

          const evalCount = parseInt(btn.getAttribute('data-eval-count') || '0', 10);

          const pointAkhirAttr = btn.getAttribute('data-point-akhir');
          let pointAkhirDb = NaN;

          if (pointAkhirAttr !== null && pointAkhirAttr !== '') {
            pointAkhirDb = parseInt(pointAkhirAttr, 10);
          }

          if (isNaN(pointAkhirDb)) {
            const pointAwal = parseInt(btn.getAttribute('data-point-awal') || '100', 10);
            const pointMinus= parseInt(btn.getAttribute('data-point-minus') || '0', 10);
            pointAkhirDb = Math.max(0, pointAwal - pointMinus);
          }

          __evalCount = isNaN(evalCount) ? 0 : evalCount;
          __pointAkhir = isNaN(pointAkhirDb) ? 100 : pointAkhirDb;

          if (elId) elId.value = id;
          if (elNama) elNama.innerText = 'OB: ' + nama;
          if (elLokasi) elLokasi.innerText = 'Area: ' + lokasi;

          setUiEvaluasi();
          modal.style.display = '';
        }

        function closeModal() {
          if (!modal) return;
          modal.style.display = 'none';
        }

        document.querySelectorAll('.open-modal').forEach(btn => {
          btn.addEventListener('click', function(){
            openModal(this);
          });
        });

        document.querySelectorAll('[data-close-modal]').forEach(btn => {
          btn.addEventListener('click', function(){
            closeModal();
          });
        });

        if (btnTambahEvaluasi) {
          btnTambahEvaluasi.addEventListener('click', function () {

            if (__evalCount >= MAX_EVAL) {
              alert('Evaluasi sudah mencapai maksimal 10 kali.');
              syncButtonTambahEvaluasi();
              return;
            }

            const idP = elId ? elId.value : '';
            if (!idP) { alert('ID pengerjaan tidak ditemukan'); return; }

            const cat = elCatatan ? elCatatan.value : '';

            const fd = new FormData();
            fd.append('id_pengerjaan', idP);
            fd.append('catatan_tu', cat);

            fetch("<?= site_url('DashboardTu/tambah_evaluasi'); ?>", {
              method: 'POST',
              body: fd,
              headers: { 'X-Requested-With': 'XMLHttpRequest' }
            })
            .then(r => r.json())
            .then(res => {
              if (!res || res.status !== 'success') {
                alert((res && res.message) ? res.message : 'Gagal tambah evaluasi');
                return;
              }

              __evalCount = parseInt(res.eval_count || '0', 10);
              __pointAkhir = parseInt(res.point_akhir || '100', 10);

              setUiEvaluasi();

              if (__evalCount >= MAX_EVAL) {
                alert('Evaluasi sudah maksimal 10x. Poin akhir sekarang: ' + __pointAkhir);
              }
            })
            .catch(err => {
              console.error(err);
              alert('Terjadi kesalahan saat tambah evaluasi');
            });
          });
        }

        if (btnResetEvaluasi) {
          btnResetEvaluasi.addEventListener('click', function(){
            __evalCount = 0;
            __pointAkhir = 100;
            setUiEvaluasi();
          });
        }

        if (form) {
          form.addEventListener('submit', function(e){
            e.preventDefault();

            const actionUrl = form.getAttribute('action');
            const formData = new FormData(form);

            const active = document.activeElement;
            if (active && active.name === 'status_verifikasi') {
              formData.set('status_verifikasi', active.value);
            }

            fetch(actionUrl, {
              method: 'POST',
              body: formData,
              headers: { 'X-Requested-With': 'XMLHttpRequest' }
            })
            .then(r => r.json())
            .then(res => {

              if (!res || res.status !== 'success') {
                alert((res && res.message) ? res.message : 'Gagal memproses verifikasi.');
                return;
              }

              let msg = "Berhasil!\n";
              if (typeof res.eval_count !== 'undefined') {
                msg += "Evaluasi: " + res.eval_count + "/" + (res.max_eval || MAX_EVAL) + "\n";
              }
              if (typeof res.point_minus_total !== 'undefined') {
                msg += "Potongan total: -" + res.point_minus_total + "\n";
              }

              if (res.point_akhir !== null && typeof res.point_akhir !== 'undefined') {
                msg += "Poin akhir: " + res.point_akhir + "\n";
              } else if (typeof res.point_sementara !== 'undefined') {
                msg += "Poin sekarang: " + res.point_sementara + "\n";
              }

              alert(msg);

              closeModal();
              window.location.href = window.location.pathname + window.location.search + "#verifikasi";
              window.location.reload();
            })
            .catch(err => {
              console.error(err);
              alert('Terjadi kesalahan saat mengirim evaluasi.');
            });
          });
        }

      });
      </script>

    </main>
  </div>
</div>
