<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light bg-light">
  <!-- Left navbar links -->
  <ul class="navbar-nav">
    <li class="nav-item">
      <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
    </li>
    <li class="nav-item d-none d-sm-inline-block">
      <!-- <a href="<?= base_url() ?>" class="nav-link"> -->
      <div class="nav-link">
      Selamat Datang, 
      <?php 
        echo($this->session->userdata('jabatan'));
        echo("&nbsp;");
        echo($this->session->userdata('satker'));
      ?>
      </div>
    <!-- </a> -->
    </li>
  </ul>

  <!-- Right navbar links -->
  <ul class="navbar-nav ml-auto">
    <!-- Navbar Search -->
    <!-- <li class="nav-item">
      <a class="nav-link" data-widget="navbar-search" href="#" role="button">
        <i class="fas fa-search"></i>
      </a>
      <div class="navbar-search-block">
        <form class="form-inline">
          <div class="input-group input-group-sm">
            <input class="form-control form-control-navbar" type="search" placeholder="Pencarian" aria-label="Pencarian">
            <div class="input-group-append">
              <button class="btn btn-navbar" type="submit">
                <i class="fas fa-search"></i>
              </button>
              <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                <i class="fas fa-times"></i>
              </button>
            </div>
          </div>
        </form>
      </div>
    </li> -->

    <li class="nav-item dropdown user-menu">
      <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
        <!-- <img src="<?= base_url('resources/user/' . $this->session->userdata('images')) ?>" class="user-image img-circle elevation-2" alt="User Image"> -->
        <img src="<?= base_url('resources/user/' . $this->session->userdata('images')) ?>" style="object-fit:contain;height:30px" alt="User Image">
        <span class="d-none d-md-inline"><?= $this->session->userdata('nama') ?></span>
      </a>
      <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
        <!-- User image -->
        <li class="user-header bg-dark">
          <!-- <img src="<?= base_url('resources/user/' . $this->session->userdata('images')) ?>" class="img-circle elevation-2" alt="User Image"> -->
          <img src="<?= base_url('resources/user/' . $this->session->userdata('images')) ?>" style="object-fit:contain;height:60px;border:0"  alt="User Image">

          <p>
            <?= $this->session->userdata('nama') . " - " . $this->session->userdata('role_text') ?>
            <small> <?= $this->session->userdata('jabatan') ?></small>
            <!-- <small>Member sejak <?= indonesian_date_only($this->session->userdata('waktu_daftar')) ?></small> -->
          </p>
        </li>
        <!-- Menu Body -->
        <!-- <li class="user-body">
          <div class="row">
            <div class="col-4 text-center">
              <a href="#">Followers</a>
            </div>
            <div class="col-4 text-center">
              <a href="#">Sales</a>
            </div>
            <div class="col-4 text-center">
              <a href="#">Friends</a>
            </div>
          </div>
        </li> -->
        <!-- Menu Footer-->
        <li class="user-footer">
          <!-- <a href="#" class="btn btn-default btn-flat">Profile</a> -->
          <a href="<?= base_url('logout') ?>" class="btn btn-danger btn-flat float-right">Keluar Aplikasi</a>
        </li>
      </ul>
    </li>
    <li class="nav-item">
      <a class="nav-link" data-widget="fullscreen" href="#" role="button">
        <i class="fas fa-expand-arrows-alt"></i>
      </a>
    </li>
  </ul>
</nav>
<!-- /.navbar -->