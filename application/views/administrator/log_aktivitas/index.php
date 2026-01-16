<div class="content-wrapper">
  <section class="content-header">
    <h1>Log Aktivitas Sistem</h1>
    <ol class="breadcrumb">
      <li><a href="<?= site_url('dashboard') ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
      <li class="active">Log Aktivitas</li>
    </ol>
  </section>

  <section class="content">

    <?php
      $total = is_array($logs) ? count($logs) : 0;

      $total_berhasil = 0;
      $total_gagal = 0;
      $total_warning = 0;

      if (!empty($logs)) {
        foreach ($logs as $l) {
          $a = strtoupper((string)$l->action);
          if (strpos($a, 'FAIL') !== false || strpos($a, 'GAGAL') !== false) $total_gagal++;
          else if (strpos($a, 'DENIED') !== false || strpos($a, 'WARNING') !== false) $total_warning++;
          else $total_berhasil++;
        }
      }

      $q = $filters['q'] ?? '';
      $start = $filters['start'] ?? '';
      $end = $filters['end'] ?? '';
      $role_f = $filters['role'] ?? '';
      $limit = $filters['limit'] ?? 500;

      // helper badge
      $badge = function($action) {
        $a = strtoupper((string)$action);

        if (strpos($a, 'LOGIN') !== false && strpos($a, 'FAIL') === false) {
          return ['success', 'Login'];
        }
        if (strpos($a, 'LOGOUT') !== false) {
          return ['info', 'Logout'];
        }
        if (strpos($a, 'FAIL') !== false || strpos($a, 'GAGAL') !== false) {
          return ['danger', 'Gagal'];
        }
        if (strpos($a, 'DENIED') !== false || strpos($a, 'WARNING') !== false) {
          return ['warning', 'Warning'];
        }
        return ['primary', $action ?: 'Aktivitas'];
      };

      $role_label = function($role){
        if ($role === 'Administrator') return '<span class="label label-danger">Administrator</span>';
        if ($role === 'User') return '<span class="label label-primary">User</span>';
        if ($role === 'guest') return '<span class="label label-default">guest</span>';
        return '<span class="label label-default">'.htmlspecialchars((string)$role, ENT_QUOTES).'</span>';
      };
    ?>

    <!-- Ringkasan cards -->
    <div class="row">
      <div class="col-md-3">
        <div class="small-box bg-aqua">
          <div class="inner">
            <h3><?= (int)$total ?></h3>
            <p>Total Aktivitas</p>
          </div>
          <div class="icon"><i class="fa fa-list"></i></div>
        </div>
      </div>
      <div class="col-md-3">
        <div class="small-box bg-green">
          <div class="inner">
            <h3><?= (int)$total_berhasil ?></h3>
            <p>Berhasil / Normal</p>
          </div>
          <div class="icon"><i class="fa fa-check"></i></div>
        </div>
      </div>
      <div class="col-md-3">
        <div class="small-box bg-red">
          <div class="inner">
            <h3><?= (int)$total_gagal ?></h3>
            <p>Gagal</p>
          </div>
          <div class="icon"><i class="fa fa-times"></i></div>
        </div>
      </div>
      <div class="col-md-3">
        <div class="small-box bg-yellow">
          <div class="inner">
            <h3><?= (int)$total_warning ?></h3>
            <p>Warning</p>
          </div>
          <div class="icon"><i class="fa fa-exclamation-triangle"></i></div>
        </div>
      </div>
    </div>

    <!-- Filter -->
    <div class="box box-primary">
      <div class="box-header with-border">
        <h3 class="box-title">Filter Log</h3>
      </div>

      <div class="box-body">
        <form method="get" class="row">
          <div class="col-md-4">
            <label>Cari</label>
            <input type="text" name="q" class="form-control" placeholder="Cari user / aksi / module..."
              value="<?= htmlspecialchars($q, ENT_QUOTES) ?>">
          </div>

          <div class="col-md-2">
            <label>Dari</label>
            <input type="date" name="start" class="form-control" value="<?= htmlspecialchars($start, ENT_QUOTES) ?>">
          </div>

          <div class="col-md-2">
            <label>Sampai</label>
            <input type="date" name="end" class="form-control" value="<?= htmlspecialchars($end, ENT_QUOTES) ?>">
          </div>

          <div class="col-md-2">
            <label>Role</label>
            <select name="role" class="form-control">
              <option value="" <?= $role_f===''?'selected':'' ?>>Semua</option>
              <option value="Administrator" <?= $role_f==='Administrator'?'selected':'' ?>>Administrator</option>
              <option value="User" <?= $role_f==='User'?'selected':'' ?>>User</option>
              <option value="guest" <?= $role_f==='guest'?'selected':'' ?>>guest</option>
            </select>
          </div>

          <div class="col-md-2">
            <label>Limit</label>
            <input type="number" name="limit" class="form-control" min="50" max="5000"
              value="<?= htmlspecialchars((string)$limit, ENT_QUOTES) ?>">
          </div>

          <div class="col-md-12" style="margin-top:12px;">
            <button class="btn btn-primary"><i class="fa fa-filter"></i> Terapkan</button>
            <a class="btn btn-default" href="<?= site_url('administrator/log-aktivitas') ?>">
              <i class="fa fa-refresh"></i> Reset
            </a>
          </div>
        </form>
      </div>
    </div>

    <!-- Tabel -->
    <div class="box box-default">
      <div class="box-header with-border">
        <h3 class="box-title">Daftar Log</h3>
        <div class="box-tools">
          <span class="label label-default">Menampilkan <?= (int)$total ?> data</span>
        </div>
      </div>

      <div class="box-body table-responsive">
        <table class="table table-bordered table-hover">
          <thead>
            <tr>
              <th style="width:140px;">Timestamp</th>
              <th style="width:140px;">User</th>
              <th style="width:120px;">Role</th>
              <th style="width:140px;">Aktivitas</th>
              <th style="width:140px;">Module</th>
              <th>Deskripsi</th>
              <th style="width:120px;">IP Address</th>
              <th style="width:90px;">Aksi</th>
            </tr>
          </thead>
          <tbody>
            <?php if (empty($logs)): ?>
              <tr><td colspan="8" class="text-center">Tidak ada data log.</td></tr>
            <?php else: foreach ($logs as $l): ?>
              <?php
                [$cls, $txt] = $badge($l->action);
                $detail_id = 'detail_'.$l->id;
              ?>
              <tr>
                <td><?= htmlspecialchars($l->created_at, ENT_QUOTES) ?></td>
                <td>
                  <b><?= htmlspecialchars($l->username, ENT_QUOTES) ?></b>
                  <?= !empty($l->user_id) ? '<div style="color:#888;font-size:12px;">#'.htmlspecialchars($l->user_id, ENT_QUOTES).'</div>' : '' ?>
                </td>
                <td><?= $role_label($l->role) ?></td>
                <td><span class="label label-<?= $cls ?>"><?= htmlspecialchars($txt, ENT_QUOTES) ?></span></td>
                <td><?= htmlspecialchars($l->module, ENT_QUOTES) ?></td>
                <td><?= htmlspecialchars($l->description, ENT_QUOTES) ?></td>
                <td><?= htmlspecialchars($l->ip_address, ENT_QUOTES) ?></td>
                <td>
                  <a href="javascript:void(0)" class="btn btn-xs btn-primary"
                     onclick="var el=document.getElementById('<?= $detail_id ?>'); el.style.display = (el.style.display==='none'?'table-row':'none');">
                    Detail
                  </a>
                </td>
              </tr>

              <!-- Row detail (toggle) -->
              <tr id="<?= $detail_id ?>" style="display:none;">
                <td colspan="8">
                  <div class="row">
                    <div class="col-md-6">
                      <b>URL</b><br>
                      <div style="word-break:break-all;">
                        <?= htmlspecialchars($l->url, ENT_QUOTES) ?>
                      </div>
                    </div>
                    <div class="col-md-3">
                      <b>Method</b><br>
                      <?= htmlspecialchars($l->method, ENT_QUOTES) ?>
                    </div>
                    <div class="col-md-3">
                      <b>User Agent</b><br>
                      <div style="word-break:break-all;">
                        <?= htmlspecialchars($l->user_agent, ENT_QUOTES) ?>
                      </div>
                    </div>
                  </div>
                </td>
              </tr>
            <?php endforeach; endif; ?>
          </tbody>
        </table>
      </div>
    </div>

  </section>
</div>
