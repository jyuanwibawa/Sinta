<?php if(!empty($laporan)): ?>
    <?php foreach($laporan as $row): ?>
        <div class="job-card">
            <div class="job-left">
                <div class="job-avatar">👤</div>
                <div>
                    <div class="job-info-title"><?= $row->nama_ob; ?></div>
                    <div class="job-info-meta">
                        <?= $row->nama_ruangan; ?> • <?= $row->updated_at; ?>
                    </div>
                    <div class="job-info-activity">
                        Aktivitas: <?= $row->aktivitas; ?>
                    </div>
                </div>
            </div>

            <div class="status-pill status-<?= $row->status; ?>">
                <?= ucfirst($row->status); ?>
            </div>
        </div>
    <?php endforeach; ?>
<?php else: ?>
    <p>Tidak ada laporan pekerjaan.</p>
<?php endif; ?>
