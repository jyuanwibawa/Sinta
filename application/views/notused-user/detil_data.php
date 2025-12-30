<!-- Main content -->
<?php $elsya_enkrip_id = encrypt_url($show->u_id); ?>
<section class="content">
    <div class="container-fluid">
        <a href="<?= base_url('User') ?>" class="btn btn-warning mb-2"><b>Kembali</b></a>
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
        <div class="row">
            <div class="col-md-4">

                <!-- Profile Image -->
                <div class="card card-primary card-outline">
                    <div class="card-body box-profile">
                        <div class="text-center">
                            <img class="profile-user-img img-fluid img-circle" src="<?= base_url() ?>resources/user/<?= $show->images ?>" alt="User profile picture" style="width:200px">
                        </div>
                        <?= decrypt_url($elsya_enkrip_id) ?>
                        <?= md5('1') ?>
                        <h3 class="profile-username text-center"><?= $show->nama ?> (<?php if ($show->aktivasi) {
                                                                                            echo "Aktif";
                                                                                        } else {
                                                                                            echo "Tidak AKtif";
                                                                                        } ?>)</h3>

                        <ul class="list-group list-group-unbordered mb-3">
                            <li class="list-group-item">
                                <b>Role</b> <a class="float-right"><?= $show->role ?></a>
                            </li>
                            <li class="list-group-item">
                                <b>Seksi</b> <a class="float-right"><?= $show->seksi ?></a>
                            </li>
                            <li class="list-group-item">
                                <b>Bagian</b> <a class="float-right"><?= $show->bagian ?></a>
                            </li>
                        </ul>

                        <!-- <a href="#" class="btn btn-primary btn-block"><b>Ganti Foto</b></a> -->
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
            <div class="col-md-8">
                <div class="card card-primary card-outline">
                    <!-- form start -->
                    <?= form_open_multipart("User/update/" . $elsya_enkrip_id) ?>
                    <div class="card-body">
                        <div class="form-group">
                            <label class="has-float-label">
                                <input type="text" class="form-control form-floating" name="nama" placeholder="<?= $show->nama ?>" value="<?= $show->nama ?>">
                                <span>Nama</span>
                            </label>
                        </div>
                        <div class="form-group">
                            <label class="has-float-label">
                                <input type="email" class="form-control form-floating" name="email" placeholder="<?= $show->email ?>" value="<?= $show->email ?>">
                                <span>E-mail</span>
                            </label>
                        </div>
                        <div class="form-group">
                            <label class="has-float-label">
                                <select class="form-control custom-select" name="seksi">
                                    <option value="<?= $show->id_seksi ?>" selected><?= $show->seksi ?></option>
                                    <option value="#" disabled>==========</option>
                                    <?php foreach ($get_list_seksi as $lseksi) : ?>
                                        <option value="<?= $lseksi->id_seksi ?>"><?= $lseksi->seksi ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <span>Seksi</span>
                            </label>
                        </div>
                        <div class="form-group">
                            <label class="has-float-label">
                                <select class="form-control custom-select" name="bagian">
                                    <option value="<?= $show->id_bagian ?>" selected><?= $show->bagian ?></option>
                                    <option value="#" disabled>==========</option>
                                    <?php foreach ($get_list_jkajian as $lkajian) : ?>
                                        <option value="<?= $lkajian->id_jkajian ?>"><?= $lkajian->jkajian ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <span>Bagian</span>
                            </label>
                        </div>
                        <div class="form-group">
                            <label class="has-float-label">
                                <select class="form-control custom-select" name="aktivasi">
                                    <option value="<?= $show->aktivasi ?>" selected><?php if ($show->aktivasi) {
                                                                                        echo "Aktif";
                                                                                    } else {
                                                                                        echo "Tidak AKtif";
                                                                                    } ?></option>
                                    <option value="#" disabled>==========</option>
                                    <option value="1">Aktif</option>
                                    <option value="0">Tidak Aktif</option>
                                </select>
                                <span>Status Aktivasi Pengguna</span>
                            </label>
                        </div>
                        <div class="form-group">
                            <label class="has-float-label">
                                <input type="password" class="form-control form-floating" name="password" placeholder="Password Baru">
                                <span>Password Baru</span>
                            </label>
                        </div>
                        <div class="form-group">
                            <label class="has-float-label">
                                <input type="password" class="form-control form-floating" name="pin" placeholder="Pin Baru">
                                <span>Pin Baru</span>
                            </label>
                        </div>
                    </div>
                    <!-- /.card-body -->

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                    </form>
                </div>
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->
</section>