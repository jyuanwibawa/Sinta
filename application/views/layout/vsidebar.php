<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-warning">
  <!-- Brand Logo -->
  <!-- <a href="<?= base_url() ?>" class="brand-link bg-dark text-center"> -->
  <div class="brand-link bg-dark text-center">
    <div class="brand-text font-weight-light wrap h4"><?php echo $this->config->item('app_name');?></div>
    <div class="d-flex flex-row justify-content-center align-items-center h5" style="width:100%">
							<?php echo $this->config->item('long_app_name');?>
					</div>
    <!-- <img src="<?= base_url('assets/dist/img/logobpn.png') ?>" alt="Logo PN" class="brand-image img-circle elevation-3" style="opacity: .8;float: inherit;">
    <img src="<?= base_url('assets/dist/img/logopn.png') ?>" alt="Logo BPN" class="brand-image img-circle elevation-3" style="opacity: .8;float: inherit;"> -->
</div>
  <!-- </a> -->


  <!-- Sidebar -->
  <div class="sidebar">

    <!-- Sidebar Menu -->
    <nav class="mt-5">
      <ul class="nav nav-pills nav-sidebar flex-column nav-child-indent nav-flat text-sm" data-widget="treeview" role="menu" data-accordion="false">

        <li class="nav-item">
          <?php $base = "Dashboard"; ?>
          <a href="<?= base_url($base) ?>" class="nav-link 
          <?php if ($title == $base) {
            echo 'active';
          } ?>">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>
              <?= $base ?>
            </p>
          </a>
        </li>

        <!-- Menu Admin Ruangan -->
        <li class="nav-item">
          <?php $base = "Admin Ruangan"; ?>
          <a href="<?= base_url('admin/ruangan') ?>" class="nav-link 
          <?php if ($title == $base) {
            echo 'active';
          } ?>">
            <i class="nav-icon fas fa-door-open"></i>
            <p>
              <?= $base ?>
            </p>
          </a>
        </li>

        <!-- <li class="nav-item">
          <?php $base = "Pertanahan"; ?>
          <a href="<?= base_url($base) ?>" class="nav-link 
          <?php if ($title == $base) {
            echo 'active';
          } ?>">
            <i class="nav-icon fas fa-globe"></i>
            <p>
              <?= $base ?>
            </p>
          </a>
        </li> -->

        <!-- Pengadilan Negeri -->
        <!-- <li class="nav-item <?php if ($title == 'Semua Data PN' or $title == 'Pemeriksaan Setempat' or $title == 'Konstatering' or $title == 'Sita' or $title == 'Penerbitan SKPT' or $title == 'Panggilan Sidang' or $title == 'Lain-lain') {
                              echo 'menu-open';
                            } ?>">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-gavel"></i>
            <p>
              Pengadilan Negeri
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">

            <li class="nav-item">
              <?php $base = "Semua Data PN"; ?>
              <a href="<?= base_url('pn') ?>" class="nav-link 
          <?php if ($title == $base) {
            echo 'active';
          } ?>">
                <i class="nav-icon far fa-edit"></i>
                <p>
                  <?= $base ?>
                </p>
              </a>
            </li>

            <li class="nav-item">
              <?php $base = "Panggilan Sidang"; ?>
              <a href="<?= base_url('pn/sidang') ?>" class="nav-link 
          <?php if ($title == $base) {
            echo 'active';
          } ?>">
                <i class="nav-icon far fa-edit"></i>
                <p>
                  <?= $base ?>
                </p>
              </a>
            </li>

            <li class="nav-item">
              <?php $base = "Pemeriksaan Setempat"; ?>
              <a href="<?= base_url('pn/pemeriksaan') ?>" class="nav-link 
          <?php if ($title == $base) {
            echo 'active';
          } ?>">
                <i class="nav-icon far fa-edit"></i>
                <p>
                  <?= $base ?>
                </p>
              </a>
            </li>

            <li class="nav-item">
              <?php $base = "Konstatering"; ?>
              <a href="<?= base_url('pn/konstatering') ?>" class="nav-link 
          <?php if ($title == $base) {
            echo 'active';
          } ?>">
                <i class="nav-icon far fa-edit"></i>
                <p>
                  <?= $base ?>
                </p>
              </a>
            </li>

            <li class="nav-item">
              <?php $base = "Sita"; ?>
              <a href="<?= base_url('pn/sita') ?>" class="nav-link 
          <?php if ($title == $base) {
            echo 'active';
          } ?>">
                <i class="nav-icon far fa-edit"></i>
                <p>
                  <?= $base ?>
                </p>
              </a>
            </li>

            <li class="nav-item">
              <?php $base = "Lain-lain"; ?>
              <a href="<?= base_url('pn/lainnya') ?>" class="nav-link 
          <?php if ($title == $base) {
            echo 'active';
          } ?>">
                <i class="nav-icon far fa-edit"></i>
                <p>
                  <?= $base ?>
                </p>
              </a>
            </li>
            </ul> -->

        <?php
        $active_satker=decrypt_url($this->session->userdata('active_satker'));
        // echo "aktif : ".$active_satker;
        foreach($get_satker as $satkers){
          if((($satkers->satker_id != $active_satker) && ($active_satker=='1')) || (($satkers->satker_id != $active_satker) && ($satkers->satker_id=='1'))){

        ?>
        <li class="nav-item">
          <a href="#" class="nav-link">
            <div style="display:flex">
              <div style="padding:0 10px 0 10px">
              <img src="<?= base_url('resources/user/'.$satkers->logo) ?>" alt="" class="brand-image img-circle elevation-3" style="opacity: .8;float: inherit;height:20px">
              </div>
              <div style="width:100%">
              <p>
                <?= $satkers->nama_satker;?>
              </p>
              </div>
              <div style="text-align:right">
              <i class="right fas fa-angle-left"></i>
              </div>
            </div>
          </a>
          <ul class="nav nav-treeview">
            <?php // if condition to remove "Data Keluar" from Admin and "Data Masuk" from Legundi
            if ($active_satker == 4 && $satkers->satker_id == 1){
              ?>
              <li class="nav-item">
              <a href="<?= base_url("pn/satker/" .encrypt_url($satkers->satker_id).'/'.encrypt_url($active_satker)) ?>" class="nav-link <?php if ($title == $base) { echo 'active';} ?>">
              <i class="nav-icon far fa-hand-point-right"></i>
              <p>Data Keluar</p>
              </a>
            <?php
            } elseif ($active_satker == 1 && $satkers->satker_id == 4) {
            ?>
              <li class="nav-item">
              <a href="<?= base_url("pn/satker/" .encrypt_url($active_satker).'/'.encrypt_url($satkers->satker_id)) ?>" class="nav-link <?php if ($title == $base) { echo 'active';} ?>">
              <i class="nav-icon far fa-hand-point-left"></i>
              <p>Data Masuk</p>
              </a>
              </li>
            <?php
            } else {
            ?>
              <li class="nav-item">
              <a href="<?= base_url("pn/satker/" .encrypt_url($satkers->satker_id).'/'.encrypt_url($active_satker)) ?>" class="nav-link <?php if ($title == $base) { echo 'active';} ?>">
              <i class="nav-icon far fa-hand-point-right"></i>
              <p>Data Keluar</p>
              </a>
              </li>
              <li class="nav-item">
              <a href="<?= base_url("pn/satker/" .encrypt_url($active_satker).'/'.encrypt_url($satkers->satker_id)) ?>" class="nav-link <?php if ($title == $base) { echo 'active';} ?>">
              <i class="nav-icon far fa-hand-point-left"></i>
              <p>Data Masuk</p>
              </a>
              </li>
            <?php
            }
            ?>
          </ul>
        </li>
        <?php
        }}
        ?>
 
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>
<?php
// var_dump($this->session->userdata());
?>