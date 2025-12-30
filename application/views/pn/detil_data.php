<!-- Main content -->
<?php 
    $active_satker=decrypt_url($this->session->userdata('active_satker'));
    $enc_id = encrypt_url($show->id_kasus); 
    $jum_aplikasi=$get_aplikasi->num_rows();
    $get_aplikasi=$get_aplikasi->result();
?>
<section class="content">

    <!-- Default box -->
    <div class="card">
        <div class="card-header">
            <!-- <div class="card-title">
                <h4>Data Umum</h4>
            </div> -->
                <div class="card-tools">
                    <?php 
                    // if($show->satker_id_asal=='1'){
                        if($show->satker_id_asal=='1' && $active_satker=='1'){
                            if (is_null($show->link)) { ?>
                            <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#linksipp">
                                Tambah URL SIPP WEB
                            </button>
                    <?php } else { ?>
                            <div class="btn-group">
                                <a class="btn btn-primary" data-toggle="modal" data-target="#edit_linksipp">Edit URL SIPP WEB</a>
                            </div>
                    <?php }} ?>
                    <?php if ($this->session->userdata('user_id') == '0' or $this->session->userdata('user_id') == $show->user_id) { ?>
                        <!-- <button type="button" class="btn btn-info" data-toggle="modal" data-target="#editdataumum">
                            Edit Data Umum
                        </button> -->
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
            <div class="card card-navy card-tabs">
                <div class="card-header p-0 pt-1">
                    <ul class="nav nav-tabs" id="custom-tabs-four-tab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="detil-tab" data-toggle="" href="#" role="tab" aria-controls="custom-tabs-four-profile" aria-selected="true">DETIL</a>
                        </li>
                        <?php
                        if($show->satker_id_tujuan!='1'){
                        ?>
                        <li class="nav-item">
                            <a class="nav-link" id="sippweb-tab" data-toggle="" href="#" role="tab" aria-controls="custom-tabs-four-profile" aria-selected="false">DATA PERKARA</a>
                        </li>
                        <?php
                        }
                        ?>
                        <li class="nav-item">
                            <a class="nav-link" id="kodok-tab" data-toggle="" href="#" role="tab" aria-controls="custom-tabs-four-profile" aria-selected="false">SINERGI DOKUMEN</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="chat-tab" data-toggle="" href="#" role="tab" aria-controls="custom-tabs-four-profile" aria-selected="false">PERCAKAPAN</a>
                        </li>
                        <?php
                            $appno=1;
                            foreach($get_aplikasi as $app){
                        ?>
                        <li class="nav-item">
                            <a class="nav-link" id="aplikasi-tab-<?php echo $appno;?>" data-toggle="" href="#" role="tab" aria-controls="custom-tabs-four-profile" aria-selected="false">SINERGI APP : <?php echo $app->nama;?></a>
                        </li>
                        <?php 
                        $appno++;
                        }?>
                    </ul>
                </div>
                <div class="card-body">
                    <div class="tab-content" id="custom-tabs-four-tabContent">

                        <div class="tab-pane fade show active" id="detil" role="tabpanel" aria-labelledby="detil-tab">
                            <table class="table table-bordered table-hover table-sm">
                                <tbody>
                                    <tr>
                                        <td class="bg-light" style="width: 200px">Tanggal Surat</td>
                                        <td><?= indonesian_date_only($show->tanggalsurat) ?></td>
                                    </tr>
                                    <tr>
                                        <td class="bg-light">Nomor Surat</td>
                                        <td><?= $show->nosurat ?></td>
                                    </tr>
                                    <tr>
                                        <td class="bg-light">Jenis Kegiatan</td>
                                        <td><?= $show->jeniskegiatan ?></td>
                                    </tr>
                                    <tr>
                                        <td class="bg-light">Pihak Penggugat</td>
                                        <td>
                                            <pre class="p-0" style="word-wrap: break-word;white-space: pre-wrap;white-space: -moz-pre-wrap;white-space: -pre-wrap;white-space: -o-pre-wrap;word-wrap: break-word;"><?= $show->penggugat ?></pre>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="bg-light">Pihak Tergugat</td>
                                        <td>
                                            <pre class="p-0" style="word-wrap: break-word;white-space: pre-wrap;white-space: -moz-pre-wrap;white-space: -pre-wrap;white-space: -o-pre-wrap;word-wrap: break-word;"><?= $show->tergugat ?></pre>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="bg-light">Pihak Turut Tergugat</td>
                                        <td>
                                            <pre class="p-0" style="word-wrap: break-word;white-space: pre-wrap;white-space: -moz-pre-wrap;white-space: -pre-wrap;white-space: -o-pre-wrap;word-wrap: break-word;"><?= $show->turuttergugat ?></pre>
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
                                        <td class="bg-light">Dokumen</td>
                                        <td>
                                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#lihatfile">
                                                Lihat Dokumen
                                            </button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <div class="tab-pane fade show active" id="sippweb" role="tabpanel" aria-labelledby="sippweb-tab">
                            <?php if ($show->link!=''){ ?>
                                <object type="text/html" data="<?php echo $show->link;?>" width="100%" height="800px" style="overflow:auto;border:5px ridge blue"></object>

                            <?php }else{ ?>
                                <span class='color:red'>URL Detil Perkara dari SIPP WEB belum ditambahkan.</span>
                            <?php } ?>
                        </div>

                        <div class="tab-pane fade show active" id="kodok" role="tabpanel" aria-labelledby="kodok-tab">
                            <div class="row" style="width:100%">
                            <div style="width:20%"><button type="button" class="btn btn-primary mb-3" data-toggle="modal" data-target="#tambahseksi">
                                Tambah Dokumen
                            </button></div>
                            <div style="width:80%;text-align:right">
                            Data pada SINERGI DOKUMEN ini dapat ditambahkan sebanyak yang diperlukan.
                            </div>
                            </div>
                            <table class="table table-striped table-hover">
                                <thead class="thead-secondary">
                                    <tr>
                                        <th>Dokumen</th><th>Judul Dokumen</th><th>Keterangan</th><th class="text-right">Tanggal Pengiriman<br>Nama Pengirim</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1;
                                    foreach ($get_permintaan as $lihat) :
                                        $enkrip_permintaan = encrypt_url($lihat->id_permintaan);
                                        ?>
                                        <tr>
                                            <td><button type="button" 
                                                        class="btn btn-info btn_lihatfile_kodok" 
                                                        id="btn_lihatfile_kodok<?= $no ?>" 
                                                        data-toggle="modal" 
                                                        data-target="#lihatfile_kodok" 
                                                        data-namafile="<?= $lihat->lampiran_dok ?>" 
                                                        data-judulfile="<?= $lihat->judul ?>" 
                                                        data-urut="<?= $no ?>">Lihat Dokumen #<?= $no ?></button></td></td>
                                            <td>
                                                <?= $lihat->judul ?>
                                    </td><td><?= $lihat->keterangan_dok ?>
                                            </td>
                                            <td class="text-right">
                                                <?= indonesian_date($lihat->created_at_dok) ?>
                                                <br><?= $lihat->nama ?>
                                                <br><?= $lihat->nama_jabatan ?>
                                                <br><?= $lihat->nama_satker ?>
                                            </td>
                                        </tr>
                                    <?php 
                                    $no++;
                                    endforeach ?>
                                </tbody>
                            </table>
                        </div>

                        <div class="tab-pane fade show active" id="chat" role="tabpanel" aria-labelledby="chat-tab">
                            <div class="col-md-12">
                                <div class="card card-primary card-outline direct-chat direct-chat-primary">
                                    <div class="card-header">
                                        <h3 class="card-title">Catatan</h3>
                                    </div>
                                    <!-- /.card-header -->
                                    <div class="card-footer">
                                        <?= form_open_multipart("Permintaan_data/store_pesan/" . $enc_id) ?>
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
                                                        <span class="direct-chat-timestamp float-right"><?= indonesian_date($pesan->created_at) ?></span>
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
                                                    <span class="direct-chat-timestamp float-right"><?= indonesian_date($show->created_at) ?></span>
                                                </div>
                                                <!-- /.direct-chat-infos -->
                                                <img class="direct-chat-img" src="<?= base_url('resources/icon/ppl.png') ?>" alt="Message User Image">
                                                <!-- /.direct-chat-img -->
                                                <div class="direct-chat-text text-justify">
                                                    <div class="text-justify mt-n4" style="word-wrap: break-word;white-space: pre-line;white-space: -moz-pre-line;white-space: -pre-line;white-space: -o-pre-line;">
                                                        <?= $show->uraian ?>
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
                        <?php
                            $noapp=1;
                            foreach($get_aplikasi as $app){
                        ?>
                        <div class="tab-pane fade show active" id="aplikasi-<?php echo $noapp;?>" role="tabpanel" aria-labelledby="aplikasi-tab-<?php echo $noapp;?>">
                                <object type="text/html" data="<?php echo $app->url;?>" width="100%" height="800px" style="overflow:auto;border:5px ridge blue"></object>
                        </div>
                        <?php 
                        $noapp++;
                        } ?>
                    </div>
                </div>
            </div>
        </div>
</section>
<!-- /.content -->




<div class="modal fade" id="lihatfile">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title mr-auto">
                    Lampiran <?= $show->nosurat ?>
                </h4>
                <a href="<?= base_url('resources/lampiran/sinergi_data/surat/' . $show->lampiran) ?>" target="_blank" class="btn btn-success m-1">Unduh</a>
                <!-- <button type="submit" class="btn btn-info m-1">Edit</button> -->
                <!-- <button type="submit" class="btn btn-danger m-1">Hapus</button> -->
            </div>
            <div class="modal-body">
                <object data="<?= base_url('resources/lampiran/sinergi_data/surat/' . $show->lampiran) ?>" type="application/pdf" width="100%" height="1000"></object>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<div class="modal fade" id="hapus">
    <div class="modal-dialog">
        <form action="<?= base_url('pn/delete/' . $enc_id) ?>" method="post">
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
        <?= form_open_multipart("pn/update/" . $enc_id) ?>
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
        <?= form_open_multipart("pn/update_link/" . $enc_id) ?>
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title mt-n3 mb-n4 ml-n2">
                    <div class="btn btn-app bg-danger mt-n3">
                        <i class="fas fa-inbox"></i>
                    </div>
                    Tambah URL SIPP WEB
                </h4>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label class="has-float-label">
                        <input type="text" class="form-control form-floating" name="linksipp" placeholder=" ">
                        <span>URL SIPP WEB</span>
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
        <?= form_open_multipart("pn/update_link/" . $enc_id) ?>
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title mt-n3 mb-n4 ml-n2">
                    <div class="btn btn-app bg-danger mt-n3">
                        <i class="fas fa-inbox"></i>
                    </div>
                    Edit URL SIPP WEB
                </h4>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label class="has-float-label">
                        <input type="text" class="form-control form-floating" name="linksipp" placeholder=" " value="<?= $show->link ?>">
                        <span>URL SIPP WEB</span>
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

            <div class="modal fade" id="tambahseksi">
                <div class="modal-dialog" style="margin: 4.75rem auto;">
                    <?= form_open_multipart("pn/store_permintaan/" . $enc_id) ?>
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title mt-n3 mb-n4 ml-n2">
                                <div class="btn btn-app bg-danger mt-n3">
                                    <i class="fas fa-inbox"></i>
                                </div>
                                Tambah Dokumen
                            </h4>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label class="has-float-label">
                                    <input type="text" class="form-control form-floating" name="judul" placeholder=" " required>
                                    <span>Judul</span>
                                </label>
                            </div>
                            <div class="form-group">
                                <label class="has-float-label">
                                    <textarea class="form-control form-floating" rows="5" name="keterangan_pn" placeholder=" " required></textarea>
                                    <span>Keterangan</span>
                                </label>
                            </div>
                            <div class="form-group">
                                <label class="has-float-label ">
                                    <input type="file" class="form-control form-floating" accept="application/pdf" name="lampiran_pn" placeholder=" " required>
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

<div class="modal fade" id="lihatfile_kodok">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title mr-auto">
                    <span id="lihatfile_kodok_judul"></span>
                </h4>
                <a id="lihatfile_kodok_href" href="" target="_blank" class="btn btn-success m-1">Unduh</a>
            </div>
            <div class="modal-body">
                <object id="lihatfile_kodok_object" data="" type="application/pdf" width="100%" height="1000"></object>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<script type="text/javascript">
$(document).ready(function(){
    $('#sippweb').hide();
    $('#kodok').hide();
    $('#chat').hide();
<?php
    $noapp=1;
    foreach($get_aplikasi as $app){
?>
    $('#aplikasi-<?php echo $noapp;?>').hide();
    <?php
    $noapp++;
    }
    ?>
    const cat = localStorage.getItem("tabTerpilih");
    if(cat){
        document.getElementById(cat).click();
    }else{
        $('#detil').show();
    }
});
$('#sippweb-tab').click(function(){
    $('#detil').hide();
    $('#sippweb').show();
    $('#kodok').hide();
    $('#chat').hide();
    $('#detil-tab').removeClass('active');
    $('#sippweb-tab').addClass('active');
    $('#kodok-tab').removeClass('active');
    $('#chat-tab').removeClass('active');
    <?php
    for($i=1;$i<=$jum_aplikasi;$i++){
    ?>
    $('#aplikasi-<?php echo $i;?>').hide();
    $('#aplikasi-tab-<?php echo $i;?>').removeClass('active');
    <?php
    }
    ?>
    localStorage.clear();
    localStorage.setItem("tabTerpilih", "sippweb-tab");
});
$('#detil-tab').click(function(){
    $('#detil').show();
    $('#sippweb').hide();
    $('#kodok').hide();
    $('#chat').hide();
    $('#detil-tab').addClass('active');
    $('#sippweb-tab').removeClass('active');
    $('#kodok-tab').removeClass('active');
    $('#chat-tab').removeClass('active');
    <?php
    for($i=1;$i<=$jum_aplikasi;$i++){
    ?>
    $('#aplikasi-<?php echo $i;?>').hide();
    $('#aplikasi-tab-<?php echo $i;?>').removeClass('active');
    <?php
    }
    ?>
    localStorage.clear();
    localStorage.setItem("tabTerpilih", "detil-tab");
});
$('#kodok-tab').click(function(){
    $('#detil').hide();
    $('#sippweb').hide();
    $('#kodok').show();
    $('#chat').hide();
    $('#detil-tab').removeClass('active');
    $('#sippweb-tab').removeClass('active');
    $('#kodok-tab').addClass('active');
    $('#chat-tab').removeClass('active');
    <?php
    for($i=1;$i<=$jum_aplikasi;$i++){
    ?>
    $('#aplikasi-<?php echo $i;?>').hide();
    $('#aplikasi-tab-<?php echo $i;?>').removeClass('active');
    <?php
    }
    ?>
    localStorage.clear();
    localStorage.setItem("tabTerpilih", "kodok-tab");
});
$('#chat-tab').click(function(){
    $('#detil').hide();
    $('#sippweb').hide();
    $('#kodok').hide();
    $('#chat').show();
    $('#detil-tab').removeClass('active');
    $('#sippweb-tab').removeClass('active');
    $('#kodok-tab').removeClass('active');
    $('#chat-tab').addClass('active');
    <?php
    for($i=1;$i<=$jum_aplikasi;$i++){
    ?>
    $('#aplikasi-<?php echo $i;?>').hide();
    $('#aplikasi-tab-<?php echo $i;?>').removeClass('active');
    <?php
    }
    ?>
    localStorage.clear();
    localStorage.setItem("tabTerpilih", "chat-tab");
});

<?php
    $noapp=1;
    foreach($get_aplikasi as $app){
?>
$('#aplikasi-tab-<?php echo $noapp;?>').click(function(){
    $('#detil').hide();
    $('#sippweb').hide();
    $('#kodok').hide();
    $('#chat').hide();
    $('#detil-tab').removeClass('active');
    $('#sippweb-tab').removeClass('active');
    $('#kodok-tab').removeClass('active');
    $('#chat-tab').removeClass('active');
    <?php
    for($i=1;$i<=$jum_aplikasi;$i++){
        if($i==$noapp){
    ?>
    $('#aplikasi-<?php echo $i;?>').show();
    $('#aplikasi-tab-<?php echo $i;?>').addClass('active');
    <?php
    }else{
        ?>
    $('#aplikasi-<?php echo $i;?>').hide();
    $('#aplikasi-tab-<?php echo $i;?>').removeClass('active');
    <?php
    }
    }
    ?>
});
<?php
    $noapp++;
    }
    ?>

$('.btn_lihatfile_kodok').click(function(){
    var urlsnya='<?= base_url('resources/lampiran/sinergi_data/lampiran/') ?>';
    var urutandata=$(this).data('urut');
    var idnya='#btn_lihatfile_kodok'+urutandata;
    var namafile=$(idnya).data('namafile');
    var lengkapnya=urlsnya+namafile;
    var judulfile=$(idnya).data('judulfile');
    $('#lihatfile_kodok_object').attr('data',lengkapnya);
    $('#lihatfile_kodok_href').attr('href',lengkapnya);
    $('#lihatfile_kodok_judul').text(judulfile);
});
</script>