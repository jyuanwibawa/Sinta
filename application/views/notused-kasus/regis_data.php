<!-- Main content -->
<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">
              <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#tambah">
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
                  <th>Jenis Kasus</th>
                  <th>Nomor & Tanggal Surat</th>
                  <th>Instansi Terkait</th>
                  <th>Perihal</th>
                  <!-- <th>Pihak Terkait</th> -->
                  <th>Objek</th>
                  <!-- <th>Status</th> -->
                </tr>
              </thead>
              <tbody>
                <?php
                $no = 1;
                foreach ($all as $lihat) :
                  $elsya_enkrip_id = encrypt_url(md5($lihat->id_kasus));
                  ?>
                  <tr>
                    <td align="center"><?= $no++ ?></td>
                    <td><?= $lihat->jeniskasus ?></td>
                    <td><a href="<?= base_url("kasus/show/" . $elsya_enkrip_id) ?>" class=""><b>[ <?= $lihat->nosurat ?> ]</b></a>
                      <br>
                      <?= tgl_bayu($lihat->tanggalsurat) ?></td>
                    <td><?= $lihat->instansi ?></td>
                    <td><?= $lihat->perihal ?></td>
                    <!-- <td>
                      <pre class="p-0" style="word-wrap: break-word;white-space: pre-wrap;white-space: -moz-pre-wrap;white-space: -pre-wrap;white-space: -o-pre-wrap;word-wrap: break-word;"><?= $lihat->pihak ?>
                      </pre>
                    </td> -->
                    <td><?= $lihat->objek ?></td>
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

<div class="modal fade" id="tambah">
  <div class="modal-dialog modal-xl" style="margin: 4.75rem auto;">
    <?= form_open_multipart("kasus/store") ?>
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title mt-n3 mb-n4 ml-n2">
          <div class="btn btn-app bg-danger mt-n3">
            <i class="fas fa-inbox"></i>
          </div>
          Tambah Data
        </h4>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-md-6 col-sm-6 col-12">
            <div class="row mb-n2">
              <div id="reservationdate" data-target-input="nearest" class="form-group col-4">
                <label class="has-float-label">
                  <input type="text" class="form-control datetimepicker-input" data-target="#reservationdate" data-toggle="datetimepicker" name="tanggalsurat" placeholder=" " />
                  <span>Tanggal Surat</span>
                </label>
              </div>
              <div class="form-group col-8">
                <label class="has-float-label">
                  <input type="text" class="form-control form-floating" name="nosurat" placeholder=" ">
                  <span>No. Surat</span>
                </label>
              </div>
            </div>
            <div class="form-group">
              <label class="has-float-label">
                <select class="form-control custom-select" name="jeniskasus">
                  <option selected disabled>Pilih salah satu</option>
                  <?php foreach ($get_list_jeniskasus as $ljkasus) : ?>
                    <option value="<?= $ljkasus->id_jeniskasus ?>"><?= $ljkasus->jeniskasus ?></option>
                  <?php endforeach; ?>
                </select>
                <span>Kasus</span>
              </label>
            </div>
            <div class="form-group">
              <label class="has-float-label">
                <input type="text" class="form-control form-floating" name="instansi" placeholder=" ">
                <span>Instansi Terkait</span>
              </label>
            </div>
            <div class="form-group">
              <label class="has-float-label">
                <textarea class="form-control form-floating" rows="3" name="pihak" placeholder=" "></textarea>
                <span>Para Pihak</span>
              </label>
            </div>
            <div class="form-group">
              <label class="has-float-label">
                <input type="text" class="form-control form-floating" name="perihal" placeholder=" ">
                <span>Perihal</span>
              </label>
            </div>
          </div>
          <div class="col-md-6 col-sm-6 col-12">
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
            <!-- <div class="form-group">
              <label class="has-float-label">
                <input type="text" class="form-control form-floating" name="kota" placeholder=" ">
                <span>Kota</span>
              </label>
            </div>
            <div class="form-group">
              <label class="has-float-label">
                <input type="text" class="form-control form-floating" name="kelurahan" placeholder=" ">
                <span>Kelurahan</span>
              </label>
            </div>
            <div class="form-group">
              <label class="has-float-label">
                <input type="text" class="form-control form-floating" name="nohak" placeholder=" ">
                <span>No. Hak</span>
              </label>
            </div> -->
            <div class="form-group mb-4">
              <label class="has-float-label">
                <textarea class="form-control form-floating" rows="2" name="keterangan" placeholder=" "></textarea>
                <span>Keterangan Objek</span>
              </label>
            </div>
            <div class="form-group">
              <label class="has-float-label">
                <textarea class="form-control form-floating" rows="4" name="uraian" placeholder=" "></textarea>
                <span>Uraian</span>
              </label>
            </div>
            <div class="form-group">
              <label class="has-float-label ">
                <input type="file" class="form-control form-floating" name="lampiran" placeholder=" ">
                <span class="mb-2">Lampiran</span>
              </label>
            </div>
          </div>
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