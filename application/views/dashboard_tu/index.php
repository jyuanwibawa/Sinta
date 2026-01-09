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
            <div class="card-value"><?= isset($total_komplain) ? $total_komplain : 0 ?>
            </div>

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
          <button class="filter-btn active">Semua</button>
          <button class="filter-btn">Selesai</button>
          <button class="filter-btn">Dalam Proses</button>
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
                  data-lokasi="<?= $row->nama_ruangan ?>">
                  Evaluasi
                </button>
                <?php else: ?>
                  <div style="margin-top:6px;font-size:12px;color:#374151">
                    Catatan: <?= $row->verifikasi_catatan ?>
                  </div>
                <?php endif; ?>
              </div>
            <?php endforeach; ?>
          <?php else: ?>
            <p style="font-size:13px;color:#6b7280">Tidak ada laporan untuk diverifikasi.</p>
          <?php endif; ?>
        </div>
      </section>

    </main>
  </div>
</div>


     <!-- MODAL EVALUASI TU -->
<div class="modal-backdrop" id="modal-evaluasi" style="display:none;">
  <div class="modal">

    <div class="modal-header">
      <div>
        <div id="modal-nama" style="font-size:14px;font-weight:600">OB:</div>
        <div id="modal-lokasi" style="font-size:12px;color:#6b7280;margin-top:2px">
          Area:
        </div>
        <div style="margin-top:8px;font-size:32px;font-weight:700">100</div>
        <div style="font-size:12px">
          Total Poin • Setiap catatan mengurangi 10 poin
        </div>
      </div>
    </div>

    <div class="modal-body">
      <!-- FORM dikirim menggunakan AJAX-->
      <form id="form-evaluasi" action="<?= site_url('DashboardTu/verifikasi') ?>" method="post">
        <input type="hidden" name="id_pengerjaan" id="modal-id">

        <label style="font-size:13px;font-weight:600">
          Tambah Catatan Evaluasi
        </label>

        <textarea
          name="catatan_tu"
          placeholder="Tulis catatan evaluasi..."
          required></textarea>

        <!-- FOOTER -->
        <div class="modal-footer">
          <button
            type="submit"
            name="status_verifikasi"
            value="disetujui"
            class="btn btn-approve">
            Setujui (100 poin)
          </button>

          <button
            type="submit"
            name="status_verifikasi"
            value="perlu_perbaikan"
            class="btn btn-needfix">
            Perlu Perbaikan (100 poin)
          </button>

          <button
            type="button"
            class="btn btn-cancel"
            data-close-modal>
            Batal
          </button>
        </div>
      </form>
    </div>

  </div>
</div>


</div>
