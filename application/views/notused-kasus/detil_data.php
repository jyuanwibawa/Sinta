<!-- Main content -->
<?php $elsya_enkrip_id = encrypt_url($show->id_kasus); ?>
<section class="content">

    <!-- Default box -->
    <div class="card">
        <div class="card-header">
            <div class="card-title">
                <h4>Data Umum</h4>
            </div>
            <div class="card-tools">
                <?php if ($this->session->userdata('u_id') == '0' or $this->session->userdata('u_id') == $show->u_id) { ?>
                    <button type="button" class="btn btn-info" data-toggle="modal" data-target="#editdataumum">
                        Edit Data Umum
                    </button>
                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#hapus">
                        Hapus Data
                    </button>
                <?php } ?>
            </div>
        </div>

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
            <table class="table table-bordered table-hover table-sm">
                <tbody>
                    <tr>
                        <td class="bg-light" style="width: 200px">Link SIPP</td>
                        <td>
                            <?php if (is_null($show->link)) { ?>
                                <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#linksipp">
                                    Tambah Link SIPP
                                </button>
                            <?php } else { ?>
                                <div class="btn-group">
                                    <a class="btn btn-primary" href="<?= $show->link ?>" target="_blank" rel="noopener noreferrer">Link SIPP</a>
                                    <button type="button" class="btn btn-primary dropdown-toggle dropdown-icon" data-toggle="dropdown">
                                        <span class="sr-only">Toggle Dropdown</span>
                                    </button>
                                    <div class="dropdown-menu" role="menu">
                                        <a class="dropdown-item" data-toggle="modal" data-target="#edit_linksipp">Edit Link</a>
                                    </div>
                                </div>
                            <?php } ?>
                        </td>
                    </tr>
                    <tr>
                        <td class="bg-light" style="width: 200px">Tanggal Surat</td>
                        <td><?= tgl_bayu($show->tanggalsurat) ?></td>
                    </tr>
                    <tr>
                        <td class="bg-light">Nomor Surat</td>
                        <td><?= $show->nosurat ?></td>
                    </tr>
                    <tr>
                        <td class="bg-light">Instansi</td>
                        <td><?= $show->instansi ?></td>
                    </tr>
                    <tr>
                        <td class="bg-light">Para Pihak</td>
                        <td>
                            <pre class="p-0" style="word-wrap: break-word;white-space: pre-wrap;white-space: -moz-pre-wrap;white-space: -pre-wrap;white-space: -o-pre-wrap;word-wrap: break-word;"><?= $show->pihak ?></pre>
                        </td>
                    </tr>
                    <tr>
                        <td class="bg-light">Perihal</td>
                        <td><?= $show->perihal ?></td>
                    </tr>
                    <tr>
                        <td class="bg-light">Objek</td>
                        <td><?= $show->objek ?></td>
                    </tr>
                    <tr>
                        <td class="bg-light">Keterangan Objek</td>
                        <td>
                            <pre class="p-0 text-justify" style="word-wrap: break-word;white-space: pre-wrap;white-space: -moz-pre-wrap;white-space: -pre-wrap;white-space: -o-pre-wrap;word-wrap: break-word;"><?= $show->keterangan ?></pre>
                        </td>
                    </tr>
                    <tr>
                        <td class="bg-light">Uraian</td>
                        <td>
                            <pre class="p-0 text-justify" style="word-wrap: break-word;white-space: pre-wrap;white-space: -moz-pre-wrap;white-space: -pre-wrap;white-space: -o-pre-wrap;word-wrap: break-word;"><?= $show->uraian ?></pre>
                        </td>
                    </tr>
                    <tr>
                        <td class="bg-light">Lampiran</td>
                        <td>
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#lihatfile">
                                Lihat File
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="card-body">
            <!-- /row -->
            <div class="card card-navy card-tabs">
                <div class="card-header p-0 pt-1">
                    <ul class="nav nav-tabs" id="custom-tabs-four-tab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link" id="lampiran-tab" data-toggle="pill" href="#lampiran" role="tab" aria-controls="lampiran" aria-selected="false">Lampiran Seksi</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="kajian-tab" data-toggle="pill" href="#kajian" role="tab" aria-controls="kajian" aria-selected="false">Kajian</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="rekomendasi-tab" data-toggle="pill" href="#rekomendasi" role="tab" aria-controls="rekomendasi" aria-selected="false">Rekomendasi</a>
                        </li>
                    </ul>
                </div>
                <div class="card-body">
                    <div class="tab-content" id="custom-tabs-four-tabContent">

                        <div class="tab-pane fade show active" id="lampiran" role="tabpanel" aria-labelledby="lampiran-tab">
                            <button type="button" class="btn btn-primary mb-3" data-toggle="modal" data-target="#tambahseksi">
                                Tambah Lampiran
                            </button>
                            <div class="modal fade" id="tambahseksi">
                                <div class="modal-dialog" style="margin: 4.75rem auto;">
                                    <?= form_open_multipart("kasus/store_seksi/" . $elsya_enkrip_id) ?>
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title mt-n3 mb-n4 ml-n2">
                                                <div class="btn btn-app bg-danger mt-n3">
                                                    <i class="fas fa-inbox"></i>
                                                </div>
                                                Tambah Lampiran Seksi
                                            </h4>
                                        </div>
                                        <div class="modal-body">
                                            <div class="form-group">
                                                <label class="has-float-label">
                                                    <textarea class="form-control form-floating" rows="3" name="keterangan_seksi" placeholder=" "></textarea>
                                                    <span>Keterangan</span>
                                                </label>
                                            </div>
                                            <div class="form-group">
                                                <label class="has-float-label ">
                                                    <input type="file" class="form-control form-floating" name="lampiran_seksi" placeholder=" ">
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

                            <!-- /.modal -->
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th style="width: 10px">No.</th>
                                        <th>Tanggal</th>
                                        <th>Seksi</th>
                                        <th>Keterangan</th>
                                        <th>#</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1;
                                    foreach ($get_seksi as $lihat) :
                                        $elsya_enkrip_lampiran = encrypt_url($lihat->id_lampiran);
                                        ?>
                                        <tr>
                                            <td><?= $no++ ?></td>
                                            <td><?= tgl_bayu($lihat->created_at) ?></td>
                                            <td><?= $lihat->seksi ?></td>
                                            <td><?= $lihat->keterangan_lampiran ?></td>
                                            <td width="150px">
                                                <div class="btn-group d-flex content-center">
                                                    <button type="button" class="btn btn-block btn-secondary m-0" data-toggle="modal" data-target="#ls<?= $elsya_enkrip_lampiran ?>">
                                                        Lihat File
                                                    </button>
                                                    <button type="button" class="btn btn-secondary dropdown-toggle dropdown-icon" data-toggle="dropdown" aria-expanded="false">
                                                        <span class="sr-only">Toggle Dropdown</span>
                                                    </button>
                                                    <div class="dropdown-menu" role="menu" style="">
                                                        <button type="button" class="btn btn-block btn-flat btn-white m-0" data-toggle="modal" data-target="#es<?= $elsya_enkrip_lampiran ?>">
                                                            Edit
                                                        </button>

                                                        <button type="button" class="btn btn-block btn-flat btn-white m-0" data-toggle="modal" data-target="#hs<?= $elsya_enkrip_lampiran ?>">
                                                            Hapus
                                                        </button>
                                                        <!-- /.modal -->
                                                    </div>
                                                </div>
                                                <div class="modal fade" id="ls<?= $elsya_enkrip_lampiran ?>">
                                                    <div class="modal-dialog modal-lg">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h4 class="modal-title mr-auto">
                                                                    File Lampiran <?= $lihat->seksi ?>
                                                                </h4>
                                                                <a href="<?= base_url('resources/lampiran/seksi/' . $lihat->lampiran) ?>" target="_blank" class="btn btn-success m-1">Unduh</a>
                                                                <!-- <button type="submit" class="btn btn-info m-1">Edit File</button>
                                                                <button type="submit" class="btn btn-danger m-1">Hapus File</button> -->
                                                            </div>
                                                            <div class="modal-body">
                                                                <object data="<?= base_url('resources/lampiran/seksi/' . $lihat->lampiran) ?>" type="application/pdf" width="100%" height="1000"></object>
                                                            </div>
                                                        </div>
                                                        <!-- /.modal-content -->
                                                    </div>
                                                    <!-- /.modal-dialog -->
                                                </div>
                                                <!-- /.modal -->

                                                <div class="modal fade" id="es<?= $elsya_enkrip_lampiran ?>">
                                                    <div class="modal-dialog" style="margin: 4.75rem auto;">
                                                        <?= form_open_multipart("kasus/store_seksi/" . $elsya_enkrip_id) ?>
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h4 class="modal-title mt-n3 mb-n4 ml-n2">
                                                                    <div class="btn btn-app bg-info mt-n3">
                                                                        <i class="fas fa-inbox"></i>
                                                                    </div>
                                                                    Edit Lampiran
                                                                </h4>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="form-group">
                                                                    <label class="has-float-label">
                                                                        <textarea class="form-control form-floating" rows="3" name="keterangan_seksi" placeholder=" "><?= $lihat->keterangan_lampiran ?></textarea>
                                                                        <span>Keterangan</span>
                                                                    </label>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label class="has-float-label ">
                                                                        <input type="file" class="form-control form-floating" name="lampiran_seksi" placeholder=" ">
                                                                        <span class="mb-2">Lampiran</span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer justify-content-between">
                                                                <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
                                                                <button type="submit" class="btn btn-info">Perbarui</button>
                                                            </div>
                                                        </div>
                                                        </form>
                                                        <!-- /.modal-content -->
                                                    </div>
                                                    <!-- /.modal-dialog -->
                                                </div>
                                                <!-- /.modal -->

                                                <div class="modal fade" id="hs<?= $elsya_enkrip_lampiran ?>">
                                                    <div class="modal-dialog">
                                                        <form action="<?= base_url('kasus/delete_seksi/' . $elsya_enkrip_lampiran . '/' . $elsya_enkrip_id) ?>" method="post">
                                                            <div class="modal-content">
                                                                <div class="modal-header bg-danger">
                                                                    <h4 class="modal-title">Hapus Lampiran Seksi?</h4>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <p>Anda akan menghapus lampiran seksi <strong><?= $lihat->seksi ?></strong>!</p>
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

                                            </td>
                                        </tr>
                                    <?php endforeach ?>
                                </tbody>
                            </table>
                        </div>

                        <div class="tab-pane fade" id="kajian" role="tabpanel" aria-labelledby="kajian-tab">
                            <!-- Timelime example  -->
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="mr-4 ml-4">
                                        <?= form_open_multipart("kasus/store_kajian/" . $elsya_enkrip_id) ?>
                                        <!-- <div class="form-group">
                                            <label class="has-float-label">
                                                <select class="form-control custom-select" name="bagian">
                                                    <option selected disabled>Pilih salah satu</option>
                                                    <?php foreach ($get_list_jkajian as $ljkajian) : ?>
                                                        <option value="<?= $ljkajian->id_jkajian ?>"><?= $ljkajian->jkajian ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                                <span>Bagian</span>
                                            </label>
                                        </div> -->
                                        <div class="form-group">
                                            <label class="has-float-label">
                                                <textarea class="form-control form-floating" rows="5" name="isi_kajian" placeholder=" "></textarea>
                                                <span>Isi Kajian</span>
                                            </label>
                                        </div>
                                        <button type="submit" class="btn btn-primary mb-3">Tambah Kajian</button>
                                        </form>
                                    </div>

                                    <?php foreach ($get_kajian as $lkajian) :
                                        $elsya_enkrip_kajian = encrypt_url($lkajian->id_kajian);
                                        ?>

                                        <div class="modal fade" id="ek<?= $elsya_enkrip_kajian ?>">
                                            <div class="modal-dialog modal-xl" style="margin: 4.75rem auto;">
                                                <?= form_open_multipart("kasus/update_kajian/" . $elsya_enkrip_kajian . "/" . $elsya_enkrip_id) ?>
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title mt-n3 mb-n4 ml-n2">
                                                            <div class="btn btn-app bg-info mt-n3">
                                                                <i class="fas fa-inbox"></i>
                                                            </div>
                                                            Edit Kajian
                                                        </h4>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="form-group">
                                                            <label class="has-float-label">
                                                                <textarea class="form-control form-floating" rows=20 name="isi_kajian" placeholder=" "><?= $lkajian->isi_kajian ?></textarea>
                                                                <span>Isi Kajian</span>
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer justify-content-between">
                                                        <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
                                                        <button type="submit" class="btn btn-primary">Perbarui</button>
                                                    </div>
                                                </div>
                                                </form>
                                                <!-- /.modal-content -->
                                            </div>
                                            <!-- /.modal-dialog -->
                                        </div>
                                        <!-- /.modal -->

                                        <div class="modal fade" id="hk<?= $elsya_enkrip_kajian ?>">
                                            <div class="modal-dialog">
                                                <form action="<?= base_url('kasus/delete_kajian/' . $elsya_enkrip_kajian . '/' . $elsya_enkrip_id) ?>" method="post">
                                                    <div class="modal-content">
                                                        <div class="modal-header bg-danger">
                                                            <h4 class="modal-title">Hapus Kajian?</h4>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <p>Anda akan menghapus kajian <strong><?= $lkajian->jkajian ?></strong>!</p>
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
                                    <?php endforeach ?>
                                </div>
                                <!-- /.col -->
                            </div>
                        </div>

                        <div class="tab-pane fade" id="rekomendasi" role="tabpanel" aria-labelledby="rekomendasi-tab">
                            <!-- Timelime example  -->
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="mr-4 ml-4">
                                        <?= form_open_multipart("kasus/store_rekomendasi/" . $elsya_enkrip_id) ?>
                                        <div class="form-group">
                                            <label class="has-float-label">
                                                <textarea class="form-control form-floating border-width-3" rows="5" name="isi_rekomendasi" placeholder=" "></textarea>
                                                <span>Rekomendasi</span>
                                            </label>
                                        </div>
                                        <button type="submit" class="btn btn-primary mb-3">Tambah Rekomendasi</button>
                                        </form>
                                    </div>
                                    <!-- The time line -->
                                    <div class="timeline">
                                        <!-- timeline time label -->
                                        <!-- <div class="time-label">
                                            <span class="bg-red">10 Feb. 2014</span>
                                        </div> -->
                                        <!-- /.timeline-label -->
                                        <?php
                                        $no = 1;
                                        foreach ($get_rekomendasi as $lrekom) :
                                            $elsya_enkrip_rekom = encrypt_url($lrekom->id_rekomendasi);
                                            ?>
                                            <!-- timeline item -->
                                            <div>
                                                <i class="fas fa-comments bg-warning"></i>
                                                <div class="timeline-item">
                                                    <span class="time"><i class="fas fa-clock"></i> <?= indonesian_date($lrekom->created_at) ?></span>
                                                    <h3 class="timeline-header">Rekomendasi dari <a href="#"><?= $lrekom->seksi ?></a></h3>

                                                    <div class="timeline-body">
                                                        <pre class="p-0 m-0 text-justify" style="word-wrap: break-word;white-space: pre-wrap;white-space: -moz-pre-wrap;white-space: -pre-wrap;white-space: -o-pre-wrap;word-wrap: break-word;">
                                                        <br><?= $lrekom->isi_rekomendasi ?>
                                                        </pre>
                                                    </div>
                                                    <div class="timeline-footer">
                                                        <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#ek<?= $elsya_enkrip_rekom ?>">
                                                            Edit
                                                        </button>
                                                        <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#hr<?= $elsya_enkrip_rekom ?>">
                                                            Hapus
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- END timeline item -->
                                        <?php endforeach ?>
                                    </div>
                                    <?php foreach ($get_rekomendasi as $lrekom) :
                                        $elsya_enkrip_rekom = encrypt_url($lrekom->id_rekomendasi);
                                        ?>

                                        <div class="modal fade" id="ek<?= $elsya_enkrip_rekom ?>">
                                            <div class="modal-dialog" style="margin: 4.75rem auto;">
                                                <?= form_open_multipart("kasus/update_rekomendasi/" . $elsya_enkrip_rekom . "/" . $elsya_enkrip_id) ?>
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title mt-n3 mb-n4 ml-n2">
                                                            <div class="btn btn-app bg-info mt-n3">
                                                                <i class="fas fa-inbox"></i>
                                                            </div>
                                                            Edit Rekomendasi
                                                        </h4>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="form-group">
                                                            <label class="has-float-label">
                                                                <textarea class="form-control form-floating" rows="5" name="isi_rekomendasi" placeholder=" "><?= $lrekom->isi_rekomendasi ?></textarea>
                                                                <span>Isi Rekomendasi</span>
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer justify-content-between">
                                                        <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
                                                        <button type="submit" class="btn btn-primary">Perbarui</button>
                                                    </div>
                                                </div>
                                                </form>
                                                <!-- /.modal-content -->
                                            </div>
                                            <!-- /.modal-dialog -->
                                        </div>
                                        <!-- /.modal -->

                                        <div class="modal fade" id="hr<?= $elsya_enkrip_rekom ?>">
                                            <div class="modal-dialog">
                                                <form action="<?= base_url('kasus/delete_rekomendasi/' . $elsya_enkrip_rekom . '/' . $elsya_enkrip_id) ?>" method="post">
                                                    <div class="modal-content">
                                                        <div class="modal-header bg-danger">
                                                            <h4 class="modal-title">Hapus Rekomendasi?</h4>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <p>Anda akan menghapus rekomendasi dari <strong><?= $lrekom->nama ?></strong>!</p>
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
                                    <?php endforeach ?>
                                </div>
                                <!-- /.col -->
                            </div>
                        </div>
                    </div>


                </div>
            </div>
            <!-- /.card -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.card-body -->
    </div>
    <!-- /.card -->

</section>
<!-- /.content -->

<div class="modal fade" id="lihatfile">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title mr-auto">
                    Lampiran <?= $show->nosurat ?>
                </h4>
                <a href="<?= base_url('resources/lampiran/kasus/' . $show->lampiran) ?>" target="_blank" class="btn btn-success m-1">Unduh</a>
                <!-- <button type="submit" class="btn btn-info m-1">Edit</button> -->
                <!-- <button type="submit" class="btn btn-danger m-1">Hapus</button> -->
            </div>
            <div class="modal-body">
                <object data="<?= base_url('resources/lampiran/kasus/' . $show->lampiran) ?>" type="application/pdf" width="100%" height="1000"></object>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<div class="modal fade" id="hapus">
    <div class="modal-dialog">
        <form action="<?= base_url('kasus/delete/' . $elsya_enkrip_id) ?>" method="post">
            <div class="modal-content bg-danger">
                <div class="modal-header bg-danger">
                    <h4 class="modal-title">Hapus Semua Data?</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Anda akan menghapus seluruh informasi pada data ini(lampiran, kajian dan rekomendasi)!</p>
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

<div class="modal fade" id="editdataumum">
    <div class="modal-dialog modal-xl" style="margin: 4.75rem auto;">
        <?= form_open_multipart("kasus/update/" . $elsya_enkrip_id) ?>
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title mt-n3 mb-n4 ml-n2">
                    <div class="btn btn-app bg-danger mt-n3">
                        <i class="fas fa-inbox"></i>
                    </div>
                    Edit Data <?= $show->nosurat ?>
                </h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6 col-sm-6 col-12">
                        <div class="row">
                            <div id="reservationdate" data-target-input="nearest" class="form-group col-4">
                                <label class="has-float-label">
                                    <input type="text" class="form-control datetimepicker-input" data-target="#reservationdate" data-toggle="datetimepicker" name="tanggalsurat" placeholder=" " value="<?= $show->tanggalsurat ?>" />
                                    <span>Tanggal Surat</span>
                                </label>
                            </div>
                            <div class="form-group col-8">
                                <label class="has-float-label">
                                    <input type="text" class="form-control form-floating" name="nosurat" placeholder=" " value="<?= $show->nosurat ?>">
                                    <span>No. Surat</span>
                                </label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="has-float-label">
                                <select class="form-control custom-select" name="jeniskasus">
                                    <option value="<?= $show->id_jeniskasus ?>" selected><?= $show->jeniskasus ?></option>
                                    <option value="#" disabled>==========</option>
                                    <?php foreach ($get_list_jeniskasus as $ljkasus) : ?>
                                        <option value="<?= $ljkasus->id_jeniskasus ?>"><?= $ljkasus->jeniskasus ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <span>Kasus</span>
                            </label>
                        </div>
                        <div class="form-group">
                            <label class="has-float-label">
                                <input type="text" class="form-control form-floating" name="instansi" placeholder=" " value="<?= $show->instansi ?>">
                                <span>Instansi Terkait</span>
                            </label>
                        </div>
                        <div class="form-group">
                            <label class="has-float-label">
                                <textarea class="form-control form-floating" rows="3" name="pihak" placeholder=" "><?= $show->pihak ?></textarea>
                                <span>Para Pihak</span>
                            </label>
                        </div>
                        <div class="form-group">
                            <label class="has-float-label">
                                <input type="text" class="form-control form-floating" name="perihal" placeholder=" " value="<?= $show->perihal ?>">
                                <span>Perihal</span>
                            </label>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6 col-12">
                        <div class="form-group">
                            <label class="has-float-label">
                                <select class="form-control custom-select" name="objek">
                                    <option value="<?= $show->id_objek ?>" selected><?= $show->objek ?></option>
                                    <option value="#" disabled>==========</option>
                                    <?php foreach ($get_list_objek as $lobjek) : ?>
                                        <option value="<?= $lobjek->id_objek ?>"><?= $lobjek->objek ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <span>Objek</span>
                            </label>
                        </div>
                        <!-- <div class="form-group">
                            <label class="has-float-label">
                                <input type="text" class="form-control form-floating" name="kota" placeholder=" " value="<?= $show->kota ?>">
                                <span>Kota</span>
                            </label>
                        </div>
                        <div class="form-group">
                            <label class="has-float-label">
                                <input type="text" class="form-control form-floating" name="kelurahan" placeholder=" " value="<?= $show->kelurahan ?>">
                                <span>Kelurahan</span>
                            </label>
                        </div>
                        <div class="form-group">
                            <label class="has-float-label">
                                <input type="text" class="form-control form-floating" name="nohak" placeholder=" " value="<?= $show->nohak ?>">
                                <span>No. Hak</span>
                            </label>
                        </div> -->
                        <div class="form-group">
                            <label class="has-float-label">
                                <textarea class="form-control form-floating" rows="3" name="keterangan" placeholder=" "><?= $show->keterangan ?></textarea>
                                <span>Keterangan Objek</span>
                            </label>
                        </div>
                        <div class="form-group">
                            <label class="has-float-label">
                                <textarea class="form-control form-floating" rows="4" name="uraian" placeholder=" "><?= $show->uraian ?></textarea>
                                <span>Uraian</span>
                            </label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-info">Perbarui</button>
            </div>
        </div>
        </form>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<div class="modal fade" id="linksipp">
    <div class="modal-dialog" style="margin: 4.75rem auto;">
        <?= form_open_multipart("kasus/update_link/" . $elsya_enkrip_id) ?>
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title mt-n3 mb-n4 ml-n2">
                    <div class="btn btn-app bg-danger mt-n3">
                        <i class="fas fa-inbox"></i>
                    </div>
                    Tambah Link SIPP
                </h4>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label class="has-float-label">
                        <input type="text" class="form-control form-floating" name="linksipp" placeholder=" ">
                        <span>Link SIPP</span>
                    </label>
                    <code>* Wajib berawalan http:// atau https://</code>
                </div>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-info">Perbarui</button>
            </div>
        </div>
        </form>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<div class="modal fade" id="edit_linksipp">
    <div class="modal-dialog" style="margin: 4.75rem auto;">
        <?= form_open_multipart("kasus/update_link/" . $elsya_enkrip_id) ?>
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title mt-n3 mb-n4 ml-n2">
                    <div class="btn btn-app bg-danger mt-n3">
                        <i class="fas fa-inbox"></i>
                    </div>
                    Edit Link SIPP
                </h4>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label class="has-float-label">
                        <input type="text" class="form-control form-floating" name="linksipp" placeholder=" " value="<?= $show->link ?>">
                        <span>Link SIPP</span>
                    </label>
                    <code>* Wajib berawalan http:// atau https://</code>
                </div>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-info">Perbarui</button>
            </div>
        </div>
        </form>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->