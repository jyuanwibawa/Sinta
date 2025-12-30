<!-- Main content -->
<?php 
    $active_satker=decrypt_url($this->session->userdata('active_satker'));
    $enc_id = encrypt_url($show->id_konsultasi); 
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
                    <?php if ($this->session->userdata('user_id') == '0' or $this->session->userdata('user_id') == $show->user_id) { ?>
                        <button type="button" class="btn btn-info" data-toggle="modal" data-target="#editdataumum">
                            Edit Data 
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
            <div class="card card-navy card-tabs">
                <div class="card-header p-0 pt-1">
                    <ul class="nav nav-tabs" id="custom-tabs-four-tab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="detil-tab" data-toggle="" href="#" role="tab" aria-controls="custom-tabs-four-profile" aria-selected="true">DETIL</a>
                        </li>
                        <!-- <li class="nav-item">
                            <a class="nav-link" id="kodok-tab" data-toggle="" href="#" role="tab" aria-controls="custom-tabs-four-profile" aria-selected="false">SINERGI DOKUMEN</a>
                        </li> -->
                        <li class="nav-item">
                            <a class="nav-link" id="chat-tab" data-toggle="" href="#" role="tab" aria-controls="custom-tabs-four-profile" aria-selected="false">PERCAKAPAN</a>
                        </li>
                        <?php
                            $appno=1;
                            foreach($get_aplikasi as $app){
                        ?>
                        <!-- <li class="nav-item">
                            <a class="nav-link" id="aplikasi-tab-<?php echo $appno;?>" data-toggle="" href="#" role="tab" aria-controls="custom-tabs-four-profile" aria-selected="false">SINERGI APP : <?php echo $app->nama;?></a>
                        </li> -->
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
                                        <td class="bg-light" style="width: 200px">Tanggal Konsultasi</td>
                                        <td><?= indonesian_date_only($show->tanggalkonsul) ?></td>
                                    </tr>
                                    <tr>
                                        <td class="bg-light">Nama </td>
                                        <td><?= $show->nama_konsultasi ?></td>
                                    </tr>
                                    <tr>
                                        <td class="bg-light">Usia</td>
                                        <td><?= $show->usia ?></td>
                                    </tr>
                                    <tr>
                                        <td class="bg-light">Jenis Kelamin</td>
                                        <td><?= $show->jkelamin ?> </td>
                                    </tr>
                                    <tr>
                                        <td class="bg-light">Alamat</td>
                                        <td>
                                            <pre class="p-0" style="word-wrap: break-word;white-space: pre-wrap;white-space: -moz-pre-wrap;white-space: -pre-wrap;white-space: -o-pre-wrap;word-wrap: break-word;"><?= $show->alamat ?></pre>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="bg-light">Pekerjaan</td>
                                        <td><?= $show->pekerjaan ?> </td>
                                    </tr>
                                    <tr>
                                        <td class="bg-light">Jenis Layanan</td>
                                        <td><?= $show->jlayanan ?></td>
                                    </tr>
                                    <tr>
                                        <td class="bg-light">Jenis Perkara</td>
                                        <td><?= $show->jperkara ?> <br> <?= $show->sjperkara ?> </td>
                                    </tr>
                                    <tr>
                                        <td class="bg-light">Klasifikasi</td>
                                        <td><?= $show->klasifikasi ?> </td>
                                    </tr>
                                    <tr>
                                        <td class="bg-light">Permasalahan</td>
                                        <td>
                                            <pre class="p-0 text-justify" style="word-wrap: break-word;white-space: pre-wrap;white-space: -moz-pre-wrap;white-space: -pre-wrap;white-space: -o-pre-wrap;word-wrap: break-word;"><?= $show->permasalahan ?></pre>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="bg-light">Solusi</td>
                                        <td>
                                            <pre class="p-0 text-justify" style="word-wrap: break-word;white-space: pre-wrap;white-space: -moz-pre-wrap;white-space: -pre-wrap;white-space: -o-pre-wrap;word-wrap: break-word;"><?= $show->uraian ?></pre>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="bg-light">Advokat Piket</td>
                                        <td><?= $show->nama_advokat ?> </td>
                                    </tr>
                                    <tr>
                                        <td class="bg-light" style="width: 200px">Durasi Layanan</td>
                                        <td><?= formatTime($show->durasi_layanan) ?></td>
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
<!-- 
                        <div class="tab-pane fade show active" id="sippweb" role="tabpanel" aria-labelledby="sippweb-tab">
                            <?php if ($show->link!=''){ ?>
                                <object type="text/html" data="<?php echo $show->link;?>" width="100%" height="800px" style="overflow:auto;border:5px ridge blue"></object>

                            <?php }else{ ?>
                                <span class='color:red'>URL Detil Perkara dari SIPP WEB belum ditambahkan.</span>
                            <?php } ?>
                        </div> -->

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
                                        <?= form_open_multipart("Permintaan_data_pb/store_pesan/" . $enc_id) ?>
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
                                                        <span class="direct-chat-name float-left"><?= $pesan->nama_user?></span>
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
                    Lampiran 
                </h4>
                <a href="<?= base_url('resources/lampiran/sinergi_data/konsultasi/combined/' . $show->lampiran) ?>" target="_blank" class="btn btn-success m-1">Unduh</a>
                <!-- <button type="submit" class="btn btn-info m-1">Edit</button> -->
                <!-- <button type="submit" class="btn btn-danger m-1">Hapus</button> -->
            </div>
            <div class="modal-body">
                <object data="<?= base_url('resources/lampiran/sinergi_data/konsultasi/combined/' . $show->lampiran) ?>" type="application/pdf" width="100%" height="1000"></object>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<div class="modal fade" id="hapus">
    <div class="modal-dialog">
        <form action="<?= base_url('pb/delete/' . $enc_id) ?>" method="post">
            <div class="modal-content bg-danger">
                <div class="modal-header bg-danger">
                    <h4 class="modal-title">Hapus Semua Data?</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Anda akan menghapus seluruh informasi pada data ini!</p>
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
        <?= form_open_multipart("pb/update/" . $enc_id) ?> 
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title mt-n3 mb-n4 ml-n2">
                    <div class="btn btn-app bg-danger mt-n3">
                        <i class="fas fa-inbox"></i>
                    </div>
                    Edit Data 
                </h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6 col-sm-6 col-12">
                        <div class="row  mb-n2">
                            <div id="reservationdate" data-target-input="nearest" class="form-group col-12">
                                <label class="has-float-label">
                                    <input type="text" class="form-control datetimepicker-input" data-target="#reservationdate" data-toggle="datetimepicker" name="tanggalkonsultasi" placeholder=" " value="<?= $show->tanggalkonsul ?>" />
                                    <span>Tanggal Konsultasi</span>
                                </label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="has-float-label">
                                <input type="text" class="form-control form-floating" name="nama" placeholder=" " value="<?= $show->nama_konsultasi ?>">
                                <span>Nama</span>
                            </label>
                        </div>
                        <div class="form-group">
                            <label class="has-float-label">
                                <input type="number" class="form-control form-floating" name="usia" placeholder=" " value="<?= $show->usia ?>">
                                <span>Usia</span>
                            </label>
                        </div>
                        <div class="form-group">
                            <label class="has-float-label">
                                <select class="form-control custom-select" name="jeniskelamin">
                                    <option value="Laki-laki" <?= $show->jkelamin == 'Laki-laki' ? 'selected' : '' ?>>Laki-laki</option>
                                     <option value="Perempuan" <?= $show->jkelamin == 'Perempuan' ? 'selected' : '' ?>>Perempuan</option>
                                </select>
                                <span>Jenis Kelamin</span>
                            </label>
                        </div>
                        <div class="form-group">
                            <label class="has-float-label">
                                <input type="text" class="form-control form-floating" name="alamat" placeholder=" " value="<?= $show->alamat ?>">
                                <span>Alamat</span>
                            </label>
                        </div>
                        <div class="form-group">
                            <label class="has-float-label">
                                <input type="text" class="form-control form-floating" name="perkerjaan" placeholder=" " value="<?= $show->pekerjaan ?>">
                                <span>Pekerjaan</span>
                            </label>
                        </div>
                        <div class="form-group">
                            <label class="has-float-label">
                                <select class="form-control custom-select" name="jenislayanan">
                                <?php foreach ($get_list_jlayanan as $list_layanan) : ?>
                                    <option value="<?= $list_layanan->id_jlayanan ?>" <?= $show->id_jlayanan == $list_layanan->id_jlayanan ? 'selected' : '' ?>>
                                        <?= $list_layanan->jlayanan ?>
                                    </option>
                                <?php endforeach; ?>
                                </select>
                                <span>Jenis Layanan</span>
                            </label>
                        </div>
                        <div class="form-group">
                            <label class="has-float-label">
                                <select class="form-control custom-select" name="jenisperkara">
                                <?php foreach ($get_list_jperkara as $list_perkara) : ?>
                                    <option value="<?= $list_perkara->id_jperkara ?>" <?= $show->id_jperkara == $list_perkara->id_jperkara ? 'selected' : '' ?>>
                                        <?= $list_perkara->jperkara?>
                                    </option>
                                <?php endforeach; ?>
                                </select>
                                <select class="form-control custom-select" name="subjenisperkara">
                                    <!-- Sub Jenis Perkara akan diisi melalui javascript line 671 -->
                                </select>
                                <span>Jenis Perkara</span>
                            </label>
                        </div>
                        <div class="form-group">
                            <label class="has-float-label">
                                <select class="form-control custom-select" name="klasifikasi">
                                    <!-- Sub Jenis Perkara akan diisi melalui javascript line 671 -->
                                </select>
                                <span>Klasifikasi</span>
                            </label>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6 col-12">
                        <div class="form-group">
                            <label class="has-float-label">
                                <textarea class="form-control form-floating" rows="3" name="permasalahan" placeholder=" "><?= $show->permasalahan ?></textarea>
                                <span>Permasalahan</span>
                            </label>
                        </div>
                        <div class="form-group">
                            <label class="has-float-label">
                                <textarea class="form-control form-floating" rows="3" name="solusi" placeholder=" "><?= $show->uraian ?></textarea>
                                <span>Solusi</span>
                            </label>
                        </div>
                        <div class="form-group">
                            <label class="has-float-label">
                                <select class="form-control custom-select" name="penerimalayanan">
                                <?php foreach ($get_list_kategori as $list_kategori) : ?>
                                    <option value="<?= $list_kategori->id_kategori?>" <?= $show->id_kategori == $list_kategori->id_kategori ? 'selected' : '' ?>>
                                        <?= $list_kategori->kategori?>
                                    </option>
                                <?php endforeach; ?>
                                </select>
                                <span>Penerima Layanan</span>
                            </label>
                        </div>
                        <div class="form-group">
                            <label class="has-float-label">
                                <select class="form-control custom-select" name="advokat">
                                <?php foreach ($get_list_advokat as $list_advokat) : ?>
                                    <option value="<?= $list_advokat->id_advokat ?>" <?= $show->id_advokat == $list_advokat->id_advokat ? 'selected' : '' ?>>
                                        <?= $list_advokat->nama_advokat?>
                                    </option>
                                <?php endforeach; ?>
                                </select>
                                <span>Advokat Piket</span>
                            </label>
                        </div>
                        <div id="reservationtime" data-target-input="nearest" class="form-group">
                            <label class="has-float-label">
                                <input type="text" class="form-control input-time" data-target="#reservationtime" data-toggle="datetimepicker" name="durasi_layanan" placeholder=" " value="<?= $show->durasi_layanan ?>" />
                                <span>Durasi Layanan</span>
                            </label>
                        </div>
                        <div class="form-group">
                            <label class="has-float-label">
                                <input type="file" class="form-control form-floating" accept="application/pdf" name="ktp" placeholder=" ">
                                <span class="mb-2">KTP (PDF) - Upload untuk mengganti</span>
                            </label>
                        </div>

                        <div class="form-group">
                            <label class="has-float-label">
                                <input type="file" class="form-control form-floating" accept="application/pdf" name="form" placeholder=" ">
                                <span class="mb-2">Form (PDF) - Upload untuk mengganti</span>
                            </label>
                        </div>

                        <div class="form-group">
                            <label class="has-float-label">
                                <input type="file" class="form-control form-floating" accept="application/pdf" name="sktm" placeholder=" ">
                                <span class="mb-2">SKTM (PDF) - Upload untuk mengganti</span>
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

<script>
document.addEventListener('DOMContentLoaded', function() {
    const jenisPerkaraSelect = document.querySelector('select[name="jenisperkara"]');
    const subJenisPerkaraSelect = document.querySelector('select[name="subjenisperkara"]');
    const klasifikasiSelect = document.querySelector('select[name="klasifikasi"]');
    
    // const selectedJenisPerkara = <?= $show->id_jperkara ?>;
    // const selectedSubJenisPerkara = <?= $show->id_sjperkara ?>;
    const selectedJenisPerkara = <?= isset($show->id_jperkara) ? $show->id_jperkara : 'null' ?>;
    const selectedSubJenisPerkara = <?= isset($show->id_sjperkara) ? $show->id_sjperkara : 'null' ?>;


    function loadSubJenisPerkara(idJperkara) {
        fetch(`<?= base_url('pb/get_list_sjperkara/') ?>${idJperkara}`)
            .then(response => response.json())
            .then(data => {
                subJenisPerkaraSelect.innerHTML = '<option selected disabled>Pilih salah satu</option>';
                data.forEach(item => {
                    const option = document.createElement('option');
                    option.value = item.id_sjperkara;
                    option.textContent = item.sjperkara;
                    if (item.id_sjperkara == selectedSubJenisPerkara) {
                        option.selected = true;
                    }
                    subJenisPerkaraSelect.appendChild(option);
                });
                // Load klasifikasi untuk sub jenis perkara yang dipilih
                loadKlasifikasi(selectedSubJenisPerkara);
            });
    }

    function loadKlasifikasi(idSJperkara) {
        fetch(`<?= base_url('pb/get_list_klasifikasi/') ?>${idSJperkara}`)
            .then(response => response.json())
            .then(data => {
                klasifikasiSelect.innerHTML = '<option selected disabled>Pilih salah satu</option>';
                data.forEach(item => {
                    const option = document.createElement('option');
                    option.value = item.id_klasifikasi;
                    option.textContent = item.klasifikasi;
                    if (item.id_klasifikasi == <?= $show->id_klasifikasi ?>) {
                        option.selected = true;
                    }
                    klasifikasiSelect.appendChild(option);
                });
            });
    }

    // Load Sub Jenis Perkara ketika halaman pertama kali dibuka
    loadSubJenisPerkara(selectedJenisPerkara);

    // Load Sub Jenis Perkara ketika Jenis Perkara diubah
    jenisPerkaraSelect.addEventListener('change', function() {
        loadSubJenisPerkara(this.value);
    });

    // Load Klasifikasi ketika Sub Jenis Perkara diubah
    subJenisPerkaraSelect.addEventListener('change', function() {
        loadKlasifikasi(this.value);
    });
});
</script>

