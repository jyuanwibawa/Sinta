<!-- Main content -->
<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">
              <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#tambah">
                Tambah Data
              </button>
            </h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <?php
            if (validation_errors() || $this->session->flashdata('errors')) {
              ?>
              <div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h5><i class="icon fas fa-ban"></i> Peringatan!</h5>
                <?= validation_errors(); ?>
                <?= $this->session->flashdata('errors'); ?>
              </div>
            <?php } else if ($this->session->flashdata('success')) { ?>
              <div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h5><i class="icon fas fa-check"></i> Berhasil!</h5>
                <?= $this->session->flashdata('success'); ?>
              </div>
            <?php } ?>
            <table id="example1" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>No.</th>
                  <th>No. SHM</th>
                  <th>Tanggal Register</th>
                  <th>Nama</th>
                  <th>Aksi</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $no = 1;
                foreach ($all as $lihat) :
                  $elsya_enkrip_id = encrypt_url($lihat->id);
                  ?>
                  <tr>
                    <td><?= $no++ ?></td>
                    <td><?= $lihat->shm ?></td>
                    <td><?= indonesian_date_tanggal($lihat->created_at) ?></td>
                    <td><?= $lihat->name ?></td>
                    <td>
                      <a href="<?= base_url("project/show/" . $elsya_enkrip_id) ?>" class="btn btn-info btn-sm btn-block">Detil</a>
                      <a href="<?= base_url("project/delete/" . $elsya_enkrip_id) ?>" class="btn btn-danger btn-sm btn-block">Hapus</a>
                    </td>
                  </tr>
                <?php endforeach ?>
              </tbody>
            </table>
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
  </div>
  <!-- /.container-fluid -->
</section>
<!-- /.content -->

<div class="modal fade" id="tambah">
  <div class="modal-dialog">
    <form action="<?= base_url() ?>/project/store" method="post">
      <div class="modal-content">
        <div class="modal-header bg-warning">
          <h4 class="modal-title">Tambah Data</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <label>No. SHM</label>
            <input type="text" class="form-control" placeholder="No. SHM ..." name="shm">
          </div>
          <div class="form-group">
            <label>Nama</label>
            <input type="text" class="form-control" placeholder="Nama ..." name="name">
          </div>
          <div class="form-group">
            <label>Deskripsi</label>
            <textarea class="form-control" rows="3" placeholder="Deskripsi ..." name="description"></textarea>
          </div>
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
          <button type="submit" class="btn btn-warning">Tambah</button>
        </div>
      </div>
    </form>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->