<?php $enkrip = encrypt_url($show->id_permintaan); ?>
<?php $enkrip_kasus = encrypt_url($show->id_kasus); ?>
<section class="content">
    <div class="container-fluid">
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
        <a class="btn btn-warning mb-2" href="<?= base_url('Pn/show/' . $enkrip_kasus) ?>">Kembali</a>
        <div class="row">
            <div class="col-md-6">
                <div class="card card-primary card-outline card-tabs">
                    <div class="card-header p-0 pt-1 border-bottom-0">
                        <ul class="nav nav-tabs" id="custom-tabs-three-tab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="custom-tabs-three-home-tab" data-toggle="pill" href="#custom-tabs-three-home" role="tab" aria-controls="custom-tabs-three-home" aria-selected="true">Informasi</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="custom-tabs-three-profile-tab" data-toggle="pill" href="#custom-tabs-three-profile" role="tab" aria-controls="custom-tabs-three-profile" aria-selected="false">Informasi Tambahan</a>
                            </li>
                        </ul>
                    </div>
                    <div class="card-body">
                        <div class="tab-content" id="custom-tabs-three-tabContent">
                            <div class="tab-pane fade active show" id="custom-tabs-three-home" role="tabpanel" aria-labelledby="custom-tabs-three-home-tab">
                                <div class="row">
                                    <div class="col-md-6">
                                        <h6><b>Tanggal Dibuat</b><br>
                                            <?= $show->created_at ?>
                                            <h6><b>Permintaan dari</b></b><br>
                                                <?= $show->nama ?></b></h6>
                                            <h6><b>Instansi</b><br>
                                                <?= $show->nama_satker ?></h6>
                                            <h6><b>Judul<br></b>
                                                <?= $show->judul ?></h6>
                                    </div>
                                    <div class="col-md-6">
                                        <h6><b>Tanggal Diperbarui</b><br>
                                            <?= $show->created_at ?></h6>
                                        <h6><b>Lampiran</b><br>
                                            <?= $show->lampiran ?></h6>
                                        <h6><b>Deskripsi</b><br>
                                            <?= $show->keterangan ?></h6>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="custom-tabs-three-profile" role="tabpanel" aria-labelledby="custom-tabs-three-profile-tab">
                                Mauris tincidunt mi at erat gravida, eget tristique urna bibendum. Mauris pharetra purus ut ligula tempor, et vulputate metus facilisis. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Maecenas sollicitudin, nisi a luctus interdum, nisl ligula placerat mi, quis posuere purus ligula eu lectus. Donec nunc tellus, elementum sit amet ultricies at, posuere nec nunc. Nunc euismod pellentesque diam.
                            </div>
                        </div>
                    </div>
                    <!-- /.card -->
                </div>
            </div>

            <div class="col-md-6">
                <div class="card card-primary card-outline direct-chat direct-chat-primary">
                    <div class="card-header">
                        <h3 class="card-title">Catatan</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-footer">
                        <?= form_open_multipart("Permintaan_data/store_pesan/" . $enkrip) ?>
                        <div class="input-group">
                            <textarea class="form-control" rows="3" placeholder="Enter ..." name="pesan"></textarea>
                            <span class="input-group-append">
                                <button type="submit" class="btn btn-white"><i class="fa fa-paper-plane"></i></button>
                            </span>
                        </div>
                        </form>
                    </div>
                    <!-- /.card-footer-->
                    <div class="card-body">
                        <!-- Conversations are loaded here -->
                        <div class="direct-chat-messages" style="height: 400px">
                            <!-- Message. Default to the left -->
                            <?php
                            foreach ($get_pesan as $pesan) :
                                ?>
                                <div class="direct-chat-msg">
                                    <div class="direct-chat-infos clearfix">
                                        <span class="direct-chat-name float-left"><?= $pesan->nama ?></span>
                                        <span class="direct-chat-timestamp float-right"><?= $pesan->created_at ?></span>
                                    </div>
                                    <!-- /.direct-chat-infos -->
                                    <img class="direct-chat-img" src="<?= base_url('resources/icon/ppl.png') ?>" alt="Message User Image">
                                    <!-- /.direct-chat-img -->
                                    <div class="direct-chat-text">
                                        <div class="text-justify mt-n4" style="word-wrap: break-word;white-space: pre-line;white-space: -moz-pre-line;white-space: -pre-line;white-space: -o-pre-line;">
                                            <?= $pesan->isi_pesan ?>
                                        </div>
                                    </div>
                                    <!-- /.direct-chat-text -->
                                </div>
                            <?php endforeach ?>

                            <div class="direct-chat-msg">
                                <div class="direct-chat-infos clearfix">
                                    <span class="direct-chat-name float-left"><?= $show->nama ?></span>
                                    <span class="direct-chat-timestamp float-right"><?= $show->created_at ?></span>
                                </div>
                                <!-- /.direct-chat-infos -->
                                <img class="direct-chat-img" src="<?= base_url('resources/icon/ppl.png') ?>" alt="Message User Image">
                                <!-- /.direct-chat-img -->
                                <div class="direct-chat-text text-justify">
                                    <div class="text-justify mt-n4" style="word-wrap: break-word;white-space: pre-line;white-space: -moz-pre-line;white-space: -pre-line;white-space: -o-pre-line;">
                                        <?= $show->keterangan ?>
                                    </div>
                                </div>
                                <!-- /.direct-chat-text -->
                            </div>
                        </div>
                        <!--/.direct-chat-messages-->
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>

        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Lampiran</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body p-0">
            <button type="button" class="btn btn-primary m-3" data-toggle="modal" data-target="#tambahseksi">
                <i class="fa fa-upload"></i>
            </button>Maks. File 10.000kB
            <div class="modal fade" id="tambahseksi">
                <div class="modal-dialog" style="margin: 4.75rem auto;">
                    <?= form_open_multipart("permintaan_data/store_lampiran_pesan/" . $enkrip) ?>
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title mt-n3 mb-n4 ml-n2">
                                <div class="btn btn-app bg-primary mt-n3">
                                    <i class="fas fa-upload"></i>
                                </div>
                                Tambah Lampiran
                            </h4>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label class="has-float-label">
                                    <input type="text" class="form-control form-floating" name="nama" placeholder=" ">
                                    <span>Nama File</span>
                                </label>
                            </div>
                            <div class="form-group">
                                <label class="has-float-label ">
                                    <input type="file" class="form-control form-floating" name="lampiran" placeholder=" ">
                                    <span class="mb-2">Lampiran</span>
                                </label>
                            </div>
                        </div>
                        <div class="modal-footer justify-content-between">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-primary">Tambah</button>
                        </div>
                    </div>
                    </form>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th style="width: 10px">#</th>
                        <th>Nama File</th>
                        <th>Pengunggah</th>
                        <th>Waktu</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($get_lampiran as $lampiran) :
                        $enkrip_lampiran = encrypt_url($lampiran->id_lampiran);
                        ?>
                        <tr>
                            <td>1.</td>
                            <td><?= $lampiran->nama_file ?></td>
                            <td>
                                <?= $lampiran->nama ?>
                            </td>
                            <td><?= $lampiran->created_at ?></td>
                            <td>
                                <div class="btn-group">
                                    <a href="<?= base_url('resources/lampiran/permintaan_data/' . $lampiran->lampiran) ?>" target="_blank" class="btn btn-info"><i class="fas fa-download"></i></a>
                                    <button type="button" class="btn btn-info" data-toggle="modal" data-target="#<?= $enkrip_lampiran ?>l">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                    <?php if ($this->session->userdata('u_id') == $lampiran->u_id or $this->session->userdata('u_id') == '0') { ?>
                                        <button type="button" class="btn btn-info" data-toggle="modal" data-target="#<?= $enkrip_lampiran ?>h">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    <?php } ?>
                                </div>
                                <!-- //show file -->
                                <div class="modal fade" id="<?= $enkrip_lampiran ?>l">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="card card-outline card-primary">
                                                <div class="card-header">
                                                    <h3 class="card-title"><?= $lampiran->nama_file ?></h3>

                                                    <div class="card-tools">
                                                        <button type="button" class="btn btn-tool" data-dismiss="modal">
                                                            <i class="fas fa-times"></i>
                                                        </button>
                                                    </div>
                                                    <!-- /.card-tools -->
                                                </div>
                                                <!-- /.card-header -->
                                                <div class="card-body">
                                                    <object data="<?= base_url('resources/lampiran/permintaan_data/' . $lampiran->lampiran) ?>" type="application/pdf" width="100%" height="1000"></object>
                                                </div>
                                                <!-- /.card-body -->
                                            </div>
                                        </div>
                                        <!-- /.modal-content -->
                                    </div>
                                    <!-- /.modal-dialog -->
                                </div>
                                <!-- /.modal -->
                                <!-- delete file -->
                                <div class="modal fade" id="<?= $enkrip_lampiran ?>h">
                                    <div class="modal-dialog">
                                        <form action="<?= base_url('permintaan_data/delete/' . $enkrip_lampiran . '/' . $enkrip) ?>" method="post">
                                            <div class="modal-content bg-danger">
                                                <div class="modal-header bg-danger">
                                                    <h4 class="modal-title">Hapus Semua Data?</h4>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <p>Anda akan menghapus file <?= $lampiran->nama_file ?>!</p>
                                                </div>
                                                <div class="modal-footer justify-content-between">
                                                    <button type="button" class="btn btn-success" data-dismiss="modal">Batal</button>
                                                    <button type="submit" class="btn btn-secondary">Hapus</button>
                                                </div>
                                            </div>
                                        </form>
                                        <!-- /.modal-content -->
                                    </div>
                                    <!-- /.modal-dialog -->
                                </div>
                                <!-- /.modal -->
                            </td>
                        </tr>
                    <?php endforeach ?>

                </tbody>
            </table>
        </div>
        <!-- /.card-body -->
    </div>
</section>