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
                  <th>Nama Pengunjung<br>Nama Advokat<br>Tanggal Kunjungan<br>Tanggal Penyimpanan Data</th>
                  <th>Jenis Perkara<br>Sub Jenis Perkara<br>Klasifikasi<br>Jenis Layanan</th>
                  <!-- <th>Pihak Terkait</th> -->
                  <th>Pesan</th>
                  <!-- <th>Status</th> -->
                </tr>
              </thead>
              <tbody>
                <?php
                $no = 1;
                foreach ($all as $lihat) :
                  $enc_id = encrypt_url($lihat->id_konsultasi);
                  if(empty($lihat->pesan_terakhir)){
                    $response="<span style='color:red'>Belum Ada Pesan</span>";
                    $tdcolor="background:orange";
                  }else{
                    $response="<strong>Pesan Terakhir :</strong> " . $lihat->pesan_terakhir;
                    $tdcolor="";
                  }

              ?>
                  <tr>
                    <td align="center"><?= $no++ ?></td>
                    <!-- <td><?= $lihat->jeniskasus ?></td -->
                    <td><a href="<?= base_url("pb/show/" . $enc_id) ?>" class=""><b><?= $lihat->nama ?></b></a>
                      <br>
                      <?= $lihat->nama_advokat ?>
                      <br>
                      <?= indonesian_date_only($lihat->tanggalkonsul) ?>
                      <br>
                      <?= indonesian_date($lihat->created_at) ?>
                    </td>
                    <td>
                      <?= $lihat->jperkara ?>
                      <br>
                      <?= $lihat->sjperkara ?>
                      <br>
                      <?= $lihat->klasifikasi ?>
                      <br>
                      <?= $lihat->jlayanan ?>
                    </td>
                    <!-- <td>
                      <pre class="p-0" style="word-wrap: break-word;white-space: pre-wrap;white-space: -moz-pre-wrap;white-space: -pre-wrap;white-space: -o-pre-wrap;word-wrap: break-word;"><?= $lihat->pihak ?>
                      </pre>
                    </td> -->
                    <td style="text-align:left;<?= $tdcolor?>">
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

<div class="modal fade" id="tambah">
  <div class="modal-dialog modal-xl" style="margin: 4.75rem auto;">
    <?= form_open_multipart("Pb/store") ?>
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
              <div id="reservationdate" data-target-input="nearest" class="form-group col-12">
                <label class="has-float-label w-100">
                  <input type="text" class="form-control datetimepicker-input w-100" data-target="#reservationdate" data-toggle="datetimepicker" id="tanggalkonsultasi" name="tanggalkonsultasi" placeholder="DD-MM-YYYY" />
                  <span>Tanggal Konsultasi</span>
                </label>
              </div>
            </div>
            
            <div class="form-group">
              <label class="has-float-label w-100">
                <input type="text" class="form-control form-floating w-100" name="nama" placeholder=" ">
                <span>Nama</span>
              </label>
            </div>

            <div class="form-group">
              <label class="has-float-label w-100">
                <input type="number" class="form-control form-floating w-100" name="usia" placeholder=" ">
                <span>Usia</span>
              </label>
            </div>

            <div class="form-group">
              <label class="has-float-label">
                <select class="form-control custom-select" name="jeniskelamin">
                  <option selected disabled>Pilih salah satu</option>
                   <option value="Laki-laki">Laki-laki</option>
                   <option value="Perempuan">Perempuan</option>
                </select>
                <span>Jenis Kelamin</span>
              </label>
            </div>

            <div class="form-group">
              <label class="has-float-label w-100">
                <textarea class="form-control form-floating w-100" rows="2" name="alamat" placeholder=" "></textarea>
                <span>Alamat</span>
              </label>
            </div>

            <div class="form-group">
              <label class="has-float-label w-100">
                <input type="text" class="form-control form-floating w-100" name="perkerjaan" placeholder=" ">
                <span>Perkerjaan</span>
              </label>
            </div>

            <div class="form-group">
              <label class="has-float-label">
                <select class="form-control custom-select" name="jenislayanan">
                  <option selected disabled>Pilih salah satu</option>
                  <?php foreach ($get_list_jlayanan as $list_layanan) : ?>
                    <option value="<?= $list_layanan->id_jlayanan ?>"><?= $list_layanan->jlayanan ?></option>
                  <?php endforeach; ?>
                </select>
                <span>Jenis Layanan</span>
              </label>
            </div>
            
            <div class="form-group">
              <label class="has-float-label">
                <select class="form-control custom-select" name="jenisperkara">
                  <option selected disabled>Pilih salah satu</option>
                  <?php foreach ($get_list_jperkara as $list_perkara) : ?>
                    <option value="<?= $list_perkara->id_jperkara ?>"><?= $list_perkara->jperkara ?></option>
                  <?php endforeach; ?>
                </select>
                <select class="form-control custom-select" name="subjenisperkara">
                    <option selected disabled>Pilih salah satu</option>
                    <?php foreach ($get_list_sjperkara as $list_sjperkara) : ?>
                      <option value="<?= $list_sjperkara->id_sjperkara ?>"><?= $list_sjperkara->sjperkara ?></option>
                    <?php endforeach; ?>
                  </select>
                <span>Jenis Perkara</span>
              </label>
            </div>

            <div class="form-group">
                <label class="has-float-label">
                  <select class="form-control custom-select" name="klasifikasi">
                    <option selected disabled>Pilih salah satu</option>
                    <?php foreach ($get_list_klasifikasi as $list_klasifikasi) : ?>
                      <option value="<?= $list_klasifikasi->id_klasifikasi ?>"><?= $list_klasifikasi->klasifikasi ?></option>
                    <?php endforeach; ?>
                  </select>
                  <span>Klasifikasi</span>
                </label>
            </div>

          </div>
          <div class="col-md-6 col-sm-6 col-12">

            <div class="form-group">
              <label class="has-float-label w-100">
                <textarea class="form-control form-floating w-100" rows="2" name="permasalahan" placeholder=" "></textarea>
                <span>Permasalahan</span>
              </label>
            </div>

            <div class="form-group">
              <label class="has-float-label w-100">
                <textarea class="form-control form-floating w-100" rows="2" name="solusi" placeholder=" "></textarea>
                <span>Solusi</span>
              </label>
            </div>

            <div class="form-group">
                <label class="has-float-label">
                  <select class="form-control custom-select" name="penerimalayanan">
                    <option selected disabled>Pilih salah satu</option>
                    <?php foreach ($get_list_kategori as $list_kategori) : ?>
                      <option value="<?= $list_kategori->id_kategori ?>"><?= $list_kategori->kategori ?></option>
                    <?php endforeach; ?>
                  </select>
                  <span>Penerima Layanan</span>
                </label>
            </div>

            <div class="form-group">
                <label class="has-float-label">
                  <select class="form-control custom-select" name="advokat">
                    <option selected disabled>Pilih salah satu</option>
                    <?php foreach ($get_list_advokat as $list_advokat) : ?>
                      <option value="<?= $list_advokat->id_advokat ?>"><?= $list_advokat->nama_advokat ?></option>
                    <?php endforeach; ?>
                  </select>
                  <span>Advokat Piket</span>
                </label>
            </div>

            <div id="reservationtime" data-target-input="nearest" class="form-group">
                <label class="has-float-label ">
                  <input type="text" class="form-control input-time w-100" data-target="#reservationtime" data-toggle="datetimepicker" id="durasi_layanan" name="durasi_layanan" placeholder="HH:mm:ss" />
                  <span>Durasi Layanan</span>
                </label>
            </div>

            <div class="form-group">
              <label class="has-float-label ">
                <input type="file" class="form-control form-floating" accept="application/pdf" name="ktp" placeholder=" ">
                <span class="mb-2">KTP (PDF)</span>
              </label>
            </div>

            <div class="form-group">
              <label class="has-float-label ">
                <input type="file" class="form-control form-floating" accept="application/pdf" name="form" placeholder=" ">
                <span class="mb-2">Form (PDF)</span>
              </label>
            </div>

            <div class="form-group">
              <label class="has-float-label ">
                <input type="file" class="form-control form-floating" accept="application/pdf" name="sktm" placeholder=" ">
                <span class="mb-2">SKTM (PDF)</span>
              </label>
              <p>Note : Tidak perlu mengisi sktm jika penerima layanan merupakan Masyarakat Biasa</p>
            </div>
            <div>
            </div>
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
$(document).ready(function() {
    $('#example1').DataTable({
        dom: '<"d-flex justify-content-between"<"dt-buttons"B><"ml-auto"f>>tip',
        buttons: [
            'copy', 'excel', 'pdf', 'print'
        ]
    });
});

</script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const jenisPerkaraSelect = document.querySelector('select[name="jenisperkara"]');
    const subJenisPerkaraSelect = document.querySelector('select[name="subjenisperkara"]');
    const klasifikasiSelect = document.querySelector('select[name="klasifikasi"]');

    jenisPerkaraSelect.addEventListener('change', function() {
        const idJperkara = this.value;

        fetch(`<?= base_url('pb/get_list_sjperkara/') ?>${idJperkara}`)
            .then(response => response.json())
            .then(data => {
                subJenisPerkaraSelect.innerHTML = '<option selected disabled>Pilih salah satu</option>';
                data.forEach(item => {
                    const option = document.createElement('option');
                    option.value = item.id_sjperkara;
                    option.textContent = item.sjperkara;
                    subJenisPerkaraSelect.appendChild(option);
                });
            });
    });

    subJenisPerkaraSelect.addEventListener('change', function() {
        const idSJperkara = this.value;

        fetch(`<?= base_url('pb/get_list_klasifikasi/') ?>${idSJperkara}`)
            .then(response => response.json())
            .then(data => {
              klasifikasiSelect.innerHTML = '<option selected disabled>Pilih salah satu</option>';
                data.forEach(item => {
                    const option = document.createElement('option');
                    option.value = item.id_klasifikasi;
                    option.textContent = item.klasifikasi;
                    klasifikasiSelect.appendChild(option);
                });
            });
    });
});
</script>

