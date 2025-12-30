<!-- Main content -->
<?php $elsya_enkrip_id = encrypt_url($show->id); ?>
<section class="content">

    <!-- Default box -->
    <div class="card">
        <div class="card-header">
            <div class="card-tools">
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#edit">
                    Edit Data
                </button>
                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#hapus">
                    Hapus Semua Data
                </button>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6 col-lg-4">
                    <h5>Dummy</h5>
                    <p class="fs-5">-</p>
                </div>
                <div class="col-md-6 col-lg-4">
                    <h5>Dummy</h5>
                    <p class="fs-5">-</p>
                </div>
                <div class="col-md-6 col-lg-4">
                    <h5>Dummy</h5>
                    <p class="fs-5">-</p>
                </div>
                <div class="col-md-6 col-lg-4">
                    <h5>Dummy</h5>
                    <p class="fs-5">-</p>
                </div>
                <div class="col-md-6 col-lg-4">
                    <h5>Dummy</h5>
                    <p class="fs-5">-</p>
                </div>
                <div class="col-md-6 col-lg-4">
                    <h5>Dummy</h5>
                    <p class="fs-5">-</p>
                </div>
            </div>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->

    <div class="card">
        <div class="card-header">
            <h5 class="card-title">Informasi</h3>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6 col-lg-4">
                    <h5>No. SHM</h5>
                    <p class="fs-5"><?= $show->shm ?></p>
                </div>
                <div class="col-md-6 col-lg-4">
                    <h5>Nama</h5>
                    <p class="fs-5"><?= $show->name ?></p>
                </div>
                <div class="col-md-6 col-lg-4">
                    <h5>Dummy</h5>
                    <p class="fs-5">-</p>
                </div>
                <div class="col-md-6 col-lg-4">
                    <h5>Dummy</h5>
                    <p class="fs-5">-</p>
                </div>
                <div class="col-md-6 col-lg-4">
                    <h5>Dummy</h5>
                    <p class="fs-5">-</p>
                </div>
                <div class="col-md-6 col-lg-4">
                    <h5>Dummy</h5>
                    <p class="fs-5">-</p>
                </div>
            </div>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->

    <div class="card">
        <div class="card-header">
            <h5 class="card-title">Uraian</h3>
        </div>
        <div class="card-body">
            <p class="text-justify"><?= $show->description ?></p>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->

    <!-- Timelime example  -->
    <div class="row">
        <div class="col-md-12">
            <!-- The time line -->
            <div class="timeline">
                <!-- timeline time label -->
                <div class="time-label">
                    <span class="bg-red">Log Timeline</span>
                </div>
                <!-- /.timeline-label -->
                <!-- timeline item -->
                <div>
                    <i class="fas fa-envelope bg-blue"></i>
                    <div class="timeline-item">
                        <span class="time"><i class="fas fa-clock"></i> 12:05</span>
                        <h3 class="timeline-header"><a href="#">Support Team</a> sent you an email</h3>

                        <div class="timeline-body">
                            Etsy doostang zoodles disqus groupon greplin oooj voxy zoodles,
                            weebly ning heekya handango imeem plugg dopplr jibjab, movity
                            jajah plickers sifteo edmodo ifttt zimbra. Babblely odeo kaboodle
                            quora plaxo ideeli hulu weebly balihoo...
                        </div>
                        <div class="timeline-footer">
                            <a class="btn btn-primary btn-sm">Read more</a>
                            <a class="btn btn-danger btn-sm">Delete</a>
                        </div>
                    </div>
                </div>
                <!-- END timeline item -->
                <!-- timeline item -->
                <div>
                    <i class="fas fa-user bg-green"></i>
                    <div class="timeline-item">
                        <span class="time"><i class="fas fa-clock"></i> 5 mins ago</span>
                        <h3 class="timeline-header no-border"><a href="#">Sarah Young</a> accepted your friend request</h3>
                    </div>
                </div>
                <!-- END timeline item -->
                <!-- timeline item -->
                <div>
                    <i class="fas fa-comments bg-yellow"></i>
                    <div class="timeline-item">
                        <span class="time"><i class="fas fa-clock"></i> 27 mins ago</span>
                        <h3 class="timeline-header"><a href="#">Jay White</a> commented on your post</h3>
                        <div class="timeline-body">
                            Take me to your leader!
                            Switzerland is small and neutral!
                            We are more like Germany, ambitious and misunderstood!
                        </div>
                        <div class="timeline-footer">
                            <a class="btn btn-warning btn-sm">View comment</a>
                        </div>
                    </div>
                </div>
                <!-- END timeline item -->
                <div>
                    <i class="fas fa-clock bg-gray"></i>
                </div>
            </div>
        </div>
        <!-- /.col -->
    </div>
    <!-- /.timeline -->


</section>
<!-- /.content -->


<div class="modal fade" id="hapus">
    <div class="modal-dialog">
        <form action="<?= base_url('project/delete/' . $elsya_enkrip_id) ?>" method="post">
            <div class="modal-content">
                <div class="modal-header bg-danger">
                    <h4 class="modal-title">Hapus Data <?= $show->shm ?></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Yakin Hapus?</p>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-danger">Hapus</button>
                </div>
            </div>
        </form>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<div class="modal fade" id="edit">
  <div class="modal-dialog">
    <form action="<?= base_url('project/update/'. $elsya_enkrip_id) ?>" method="post">
      <div class="modal-content">
        <div class="modal-header bg-primary">
          <h4 class="modal-title">Tambah Data</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <label>No. SHM</label>
            <input type="text" class="form-control" value="<?=$show->shm?>" name="shm">
          </div>
          <div class="form-group">
            <label>Nama</label>
            <input type="text" class="form-control" value="<?=$show->name?>" name="name">
          </div>
          <div class="form-group">
            <label>Deskripsi</label>
            <textarea class="form-control" rows="3" name="description"><?=$show->description?></textarea>
          </div>
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
          <button type="submit" class="btn btn-primary">Update</button>
        </div>
      </div>
    </form>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->