<?php
$active_satker=decrypt_url($this->session->userdata('active_satker'));
// var_dump($get_satker);
?>

<!-- Main content -->
<section class="content">
  <?php foreach($get_satker as $satkers){
        if((($satkers->satker_id != $active_satker) && ($active_satker=='1')) || (($satkers->satker_id != $active_satker) && ($satkers->satker_id=='1'))){  
  ?>
  <div class="fade show">
  <div class="col-md-12">
  <div class="card card-primary card-outline direct-chat direct-chat-primary">
      <div class="card-header">
          <h4 class="card-title">Partner Sinergi : <span style="font-weight:bold"><?= $satkers->nama_satker ?></span></h4>
      </div>
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <?php 
              if($active_satker != 4 && $satkers->instansi_id != 1 ){
          ?>
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3><?= $satkers->jum_keluar ?></h3>

                <p>Data Keluar</p>
              </div>
              <div class="icon">
                <i class="ion ion-bag"></i>
              </div>
              <!-- <a href="#" class="small-box-footer"> <i class="fas fa-arrow-circle-right"></i></a> -->
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3><?= ($satkers->jum_keluar)-($satkers->jum_keluar_responded) ?></h3>

                <p>Data Keluar, Belum Diproses</p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <!-- <a href="#" class="small-box-footer"> <i class="fas fa-arrow-circle-right"></i></a> -->
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h3><?= $satkers->jum_masuk ?></h3>

                <p>Data Masuk</p>
              </div>
              <div class="icon">
                <i class="ion ion-person-add"></i>
              </div>
              <!-- <a href="#" class="small-box-footer"> <i class="fas fa-arrow-circle-right"></i></a> -->
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h3><?= ($satkers->jum_masuk)-($satkers->jum_masuk_responded) ?></h3>

                <p>Data Masuk, Belum Diproses</p>
              </div>
              <div class="icon">
                <i class="ion ion-pie-graph"></i>
              </div>
              <!-- <a href="#" class="small-box-footer"> <i class="fas fa-arrow-circle-right"></i></a> -->
            </div>
          </div>
          <?php 
              }
          ?>
          <!-- Dashboard untuk Pos Bakum -->
          <?php 
              if($active_satker == 1 && $satkers->satker_id == 4 || $active_satker == 4){
                if($active_satker == 1){
          ?>
              <div class="col-lg-6 col-6">
                <!-- small box -->
                <div class="small-box bg-info">
                  <div class="inner">
                    <h3><?= $satkers->jum_masuk_pb ?></h3>

                    <p>Data Masuk</p>
                  </div>
                  <div class="icon">
                    <i class="ion ion-person-add"></i>
                  </div>
                  <!-- <a href="#" class="small-box-footer"> <i class="fas fa-arrow-circle-right"></i></a> -->
                </div>
              </div>
              <!-- ./col -->
              <div class="col-lg-6 col-6">
                <!-- small box -->
                <div class="small-box bg-danger">
                  <div class="inner">
                    <h3><?= ($satkers->jum_masuk_pb)-($satkers->jum_masuk_responded_pb) ?></h3>

                    <p>Data Masuk, Belum Ada Pesan</p>
                  </div>
                  <div class="icon">
                    <i class="ion ion-pie-graph"></i>
                  </div>
                  <!-- <a href="#" class="small-box-footer"> <i class="fas fa-arrow-circle-right"></i></a> -->
                </div>
              </div>
            <?php } else {?>
              <div class="col-lg-6 col-6">
                <!-- small box -->
                <div class="small-box bg-info">
                  <div class="inner">
                    <h3><?= $satkers->jum_keluar_pb ?></h3>

                    <p>Data Keluar</p>
                  </div>
                  <div class="icon">
                    <i class="ion ion-bag"></i>
                  </div>
                  <!-- <a href="#" class="small-box-footer"> <i class="fas fa-arrow-circle-right"></i></a> -->
                </div>
              </div>
              <!-- ./col -->
              <div class="col-lg-6 col-6">
                <!-- small box -->
                <div class="small-box bg-danger">
                  <div class="inner">
                    <h3><?= ($satkers->jum_keluar_pb)-($satkers->jum_keluar_responded_pb) ?></h3>

                    <p>Data Keluar, Belum Ada Pesan</p>
                  </div>
                  <div class="icon">
                    <i class="ion ion-stats-bars"></i>
                  </div>
                  <!-- <a href="#" class="small-box-footer"> <i class="fas fa-arrow-circle-right"></i></a> -->
                </div>
              </div>
              <!-- ./col -->
            <?php }?>

              <div class="col-lg-12">
                <div class="small-box">
                  <div class="inner">
                    <h2><strong>Data Bulanan Pos Bakum</strong></h2>

                    <form action="<?= base_url('dashboard/get_data_bulanan_pb_by_date') ?>" method="get" target="_self">
                      <div class="row">
                        <div class="col-md-3">
                          <div class="form-group">
                            <label>From Date:</label>
                            <input type="date" name="from_date" class="form-control" value="<?= isset($_GET['from_date']) ? $_GET['from_date'] : '' ?>" required>
                          </div>
                        </div>
                        <div class="col-md-3">
                          <div class="form-group">
                            <label for="to_date">To Date:</label>
                            <input type="date" name="to_date" class="form-control" value="<?= isset($_GET['to_date']) ? $_GET['to_date'] : '' ?>" required>
                          </div>
                        </div>
                        <div class="col-md-3 d-flex flex-column justify-content-end">
                          <div class="form-group w-100">
                            <button type="submit" class="btn btn-primary w-100">Filter</button>
                          </div>
                        </div>
                        <div class="col-md-3 d-flex flex-column justify-content-end">
                          <div class="form-group w-100">
                            <button type="submit" formaction="<?= base_url('dashboard/cetak_laporan_otomatis') ?>" formmethod="post" class="btn btn-dark w-100" onclick="this.form.target='_blank';">Cetak Laporan</button>
                          </div>
                        </div>
                      </div>
                    </form>

                  </div>
                  <div class="icon">
                      <i class="ion ion-ios-analytics"></i>
                  </div>
                </div>
              </div>
              <div class="col-lg-6 col-6">
                <!-- small box -->
                <div class="small-box bg-warning">
                  <div class="inner">
                    <h5><strong>Jumlah Pengunjung</strong></h5>
                    <p class="mb-0">Laki-laki: <?= htmlspecialchars(isset($get_data_bulanan->jumlah_pengunjung_laki) ? $get_data_bulanan->jumlah_pengunjung_laki : 0) ?></p>
                    <p class="mb-0">Perempuan: <?= htmlspecialchars(isset($get_data_bulanan->jumlah_pengunjung_perempuan) ? $get_data_bulanan->jumlah_pengunjung_perempuan : 0) ?></p>
                  </div>
                  <div class="icon">
                    <i class="ion ion-person-add"></i>
                  </div>
                </div>
              </div>
              <div class="col-lg-6 col-6">
                <!-- small box -->
                <div class="small-box bg-warning">
                  <div class="inner">
                    <h5><strong>Jumlah Pengunjung Sesuai Golongan</strong></h5>
                    <p class="mb-0">Masyarakat Biasa: <?= htmlspecialchars(isset($get_data_bulanan->jumlah_masyarakat_biasa) ? $get_data_bulanan->jumlah_masyarakat_biasa : 0) ?></p>
                    <p class="mb-0">Masyarakat Kurang Mampu: <?= htmlspecialchars(isset($get_data_bulanan->jumlah_masyarakat_kurang_mampu) ? $get_data_bulanan->jumlah_masyarakat_kurang_mampu : 0) ?></p>
                  </div>
                  <div class="icon">
                    <i class="ion ion-person-add"></i>
                  </div>
                </div>
              </div>

          <?php 
            }
          ?>
          <!-- ./col -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    </div>
    </div>
  <?php } }?>
</section>
<!-- /.content -->