<?php if (!empty($laporan)): ?>
  <?php foreach ($laporan as $row): ?>

    <?php
      if ($row->verifikasi_status == 'disetujui') {
        $status_label = 'DISETUJUI';
        $status_class = 'success';  
      } elseif ($row->verifikasi_status == 'perlu_perbaikan') {
        $status_label = 'PERLU PERBAIKAN';
        $status_class = 'danger';    
      } else {
        $status_label = 'MENUNGGU VERIFIKASI';
        $status_class = 'warning';   
      }
    ?>

    <div class="verif-card <?= $status_class ?>">
      <div class="job-info-title">
        <?= $row->nama_ob ?> • <?= $row->nama_ruangan ?>
      </div>

      <div class="job-info-meta">
        <?= $row->completed_at ?>
      </div>

      <div class="job-info-activity" style="margin-top:6px">
        Aktivitas: <?= $row->tugas ?>
      </div>

      <div style="margin-top:6px;font-size:12px;font-weight:600">
        Status: <?= $status_label ?>
      </div>

      <?php if (
        $row->status == 'selesai' &&
        (empty($row->verifikasi_status) || $row->verifikasi_status == 'menunggu')
      ): ?>

        <!-- Tombol hanya muncul jika BELUM diverifikasi -->
        <button 
          type="button"
          class="btn btn-preview open-modal"
          data-id="<?= $row->id_pengerjaan ?>"
          data-nama="<?= $row->nama_ob ?>"
          data-lokasi="<?= $row->nama_ruangan ?>">
          Evaluasi
        </button>

      <?php else: ?>
        <!-- Setelah diverifikasi -->
        <div style="margin-top:6px;font-size:12px;color:#374151">
          Catatan: <?= !empty($row->verifikasi_catatan) ? $row->verifikasi_catatan : '-' ?>
        </div>
        <div style="font-size:11px;color:#6b7280">
          Diverifikasi: <?= !empty($row->verifikasi_at) ? $row->verifikasi_at : '-' ?>
        </div>
      <?php endif; ?>

    </div>
  <?php endforeach; ?>
<?php else: ?>
  <p style="font-size:13px;color:#6b7280">Tidak ada laporan untuk diverifikasi.</p>
<?php endif; ?>
