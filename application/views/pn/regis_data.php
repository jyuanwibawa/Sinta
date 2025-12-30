<?php
$active_satker=decrypt_url($this->session->userdata('active_satker'));
$satker_tujuan=decrypt_url($enc_satker_tujuan);
$no_surat_title="No. Perkara / ";
$istansi_id=$get_instansi[0]->instansi_id;
?>

<!-- Main content -->
<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <?php
            if($active_satker!=$satker_tujuan){
            ?>
            <h3 class="card-title">
              <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#tambah">
                Tambah Data
              </button>
            </h3>
            <?php } ?>
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
                  <!-- <th>Jenis Kasus</th> -->
                  <th>Nomor Surat<br>Tanggal Surat<br>Pengiriman Data</th>
                  <th>Jenis Kegiatan<br>Perihal<br>Objek</th>
                  <!-- <th>Pihak Terkait</th> -->
                  <th>Respon</th>
                  <!-- <th>Status</th> -->
                </tr>
              </thead>
              <tbody>
                <?php
                $no = 1;
                foreach ($all as $lihat) :
                  $enc_id = encrypt_url($lihat->id_kasus);
                  if($lihat->jumrespon<1){
                    $response="<span style='color:red'>Belum Diproses</span>";
                    $tdcolor="background:orange";
                  }else{
                    $response=$lihat->jumrespon." Dokumen";
                    $tdcolor="";
                  }

              ?>
                  <tr>
                    <td align="center"><?= $no++ ?></td>
                    <!-- <td><?= $lihat->jeniskasus ?></td -->
                    <td><a href="<?= base_url("pn/show/" . $enc_id) ?>" class=""><b><?= $lihat->nosurat ?></b></a>
                      <br>
                      <?= indonesian_date_only($lihat->tanggalsurat) ?>
                      <br>
                      <?= indonesian_date($lihat->created_at) ?>
                    </td>
                    <td>
                      <?= $lihat->jeniskegiatan ?>
                      <br>
                      <?= $lihat->perihal ?>
                      <br>
                      <?= $lihat->objek ?>
                    </td>
                    <!-- <td>
                      <pre class="p-0" style="word-wrap: break-word;white-space: pre-wrap;white-space: -moz-pre-wrap;white-space: -pre-wrap;white-space: -o-pre-wrap;word-wrap: break-word;"><?= $lihat->pihak ?>
                      </pre>
                    </td> -->
                    <td style="text-align:right;<?= $tdcolor?>">
                    <?php
                      echo $response;
                      ?>
                    </td>
                    <!-- <td><button type="button" class="btn btn-block btn-warning btn-sm">Belum Mengisi Kajian</button></td> -->
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
<?php
$form_gugat='<div class="form-group">
              <label class="has-float-label">
                <textarea class="form-control form-floating" rows="3" name="penggugat" placeholder=" "></textarea>
                <span>Penggugat</span>
              </label>
            </div>
            <div class="form-group">
              <label class="has-float-label">
                <textarea class="form-control form-floating" rows="3" name="tergugat" placeholder=" "></textarea>
                <span>Tergugat</span>
              </label>
            </div>
            <div class="form-group">
              <label class="has-float-label">
                <textarea class="form-control form-floating" rows="3" name="turuttergugat" placeholder=" "></textarea>
                <span>Turut Tergugat</span>
              </label>
            </div>';

$form_uraian='<div class="form-group">
              <label class="has-float-label">
                <textarea class="form-control form-floating" rows="6" name="uraian" placeholder=" "></textarea>
                <span>Uraian</span>
              </label>
            </div>';
$form_browse='<div class="form-group">
              <label class="has-float-label ">
                <input type="file" class="form-control form-floating" accept="application/pdf" name="lampiran" placeholder=" ">
                <span class="mb-2">Dokumen (PDF)</span>
              </label>
            </div>';
?>


<div class="modal fade" id="tambah">
  <div class="modal-dialog modal-xl" style="margin: 4.75rem auto;">
    <?= form_open_multipart("Pn/store") ?>
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title mt-n3 mb-n4 ml-n2">
          <div class="btn btn-app bg-danger mt-n3">
            <i class="fas fa-inbox"></i>
          </div>
          Tambah Data
        </h4>
      </div>
      <div style="padding:10px 0 10px 15px;background-color:orange; font-weight:bold; color:white">
      Catatan : 
      <ol>
      <li>Semua form bersifat wajib diisi.</li>
      <li>Jika tidak ada data, isikan dengan "-".</li>
      <li>Dokumen yang diunggah berbentuk PDF dengan besar file maksimum 20 MB (Mega Byte).</li>
      </ol>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-md-6 col-sm-6 col-12">
            <div class="row mb-n2">
              <div id="reservationdate" data-target-input="nearest" class="form-group col-4">
                <label class="has-float-label">
                  <input type="text" class="form-control datetimepicker-input" data-target="#reservationdate" data-toggle="datetimepicker" id="tanggalsurat" name="tanggalsurat" placeholder="DD-MM-YYYY" />
                  <span>Tanggal Surat</span>
                </label>
              </div>
              <div class="form-group col-8">
                <label class="has-float-label">
                  <input type="text" class="form-control form-floating" name="nosurat" placeholder=" ">
                  <span><?php echo($no_surat_title); ?>No. Surat</span>
                </label>
              </div>
            </div>
            <div class="form-group">
              <label class="has-float-label">
                <select class="form-control custom-select" name="jeniskegiatan">
                  <option selected disabled>Pilih salah satu</option>
                  <?php foreach ($get_list_jeniskegiatan as $list_kegiatan) : ?>
                    <option value="<?= $list_kegiatan->id_kegiatan ?>"><?= $list_kegiatan->jeniskegiatan ?></option>
                  <?php endforeach; ?>
                </select>
                <span>Jenis Kegiatan</span>
              </label>
            </div>
            <?php
            if($istansi_id=='1'){
              echo $form_gugat;
            }else{
             echo $form_uraian;
            }
            ?>
          </div>
          <div class="col-md-6 col-sm-6 col-12">
            <div class="form-group">
              <label class="has-float-label">
                <input type="text" class="form-control form-floating" name="perihal" placeholder=" ">
                <span>Perihal</span>
              </label>
            </div>
            <div class="form-group">
              <label class="has-float-label">
                <select class="form-control custom-select" name="objek">
                  <option selected disabled>Pilih salah satu</option>
                  <?php foreach ($get_list_objek as $lobjek) : ?>
                    <option value="<?= $lobjek->id_objek ?>"><?= $lobjek->objek ?></option>
                  <?php endforeach; ?>
                </select>
                <span>Objek</span>
              </label>
            </div>
            <div class="form-group">
              <label class="has-float-label">
                <textarea class="form-control form-floating" rows="2" name="keterangan" placeholder=" "></textarea>
                <span>Nomor HAK beserta lokasi</span>
              </label>
            </div>
            <?php
            if($istansi_id=='1'){
              echo $form_uraian;
            }
            echo $form_browse;
            ?>
          </div>
        </div>
      </div>
      <div class="modal-footer justify-content-between">
        <input type="hidden" name="enc_satker_tujuan" value="<?= $enc_satker_tujuan;?>">
        <input type="hidden" name="enc_satker_asal" value="<?= $enc_satker_asal;?>">
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
<?php
// echo "url sekarang : ".current_url();
// echo $this->uri->segment(3);
?>

<script type="text/javascript">
localStorage.clear();
$('.datetimepicker-input').datetimepicker({
  format:'dd/mm/yyyy'
});
</script>