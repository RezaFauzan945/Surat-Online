<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <form action="" method="POST" enctype="multipart/form-data">
                        <?= csrf_field(); ?>
                        <!-- <form id="RegisterValidation" action="" method=""> -->
                        <div class="card-header card-header-icon" data-background-color="rose">
                            <i class="material-icons">people</i>
                        </div>
                        <div class="card-content">
                            <h4 class="card-title">Edit User</h4>
                            <?php if (session()->getFlashdata('success') == TRUE) : ?>
                                <div class="alert alert-success">
                                    <span><?= session()->getFlashdata('success'); ?></span>
                                </div>
                            <?php endif; ?>
                            <?php if (session()->getFlashdata('error') == TRUE) : ?>
                                <div class="alert alert-danger">
                                    <span><?= session()->getFlashdata('error'); ?></span>
                                </div>
                            <?php endif; ?>
                            <div class="form-group">
                                <label class="label-control">Username</label>
                                <input class="form-control" name="username" id="username" type="text" value="<?= $user['username'] ?>" />
                            </div>
                            <?php if ($validation->getError('username')) : ?>
                                <div class='text text-danger mt-2'>
                                    <?= $error = $validation->getError('username'); ?>
                                </div>
                            <?php endif ?>

                            <div class="form-group">
                                <label class="label-control">Password</label>
                                <input class="form-control" name="password" id="password" type="password" value="<?= $user['password'] ?>" />
                            </div>
                            <?php if ($validation->getError('password')) : ?>
                                <div class='text text-danger mt-2'>
                                    <?= $error = $validation->getError('password'); ?>
                                </div>
                            <?php endif ?>

                            <div class="form-group">
                                <label class="label-control">Konfirmasi Password</label>
                                <input class="form-control" name="password2" id="password2" type="password" value="<?= $user['password'] ?>" />
                            </div>
                            <?php if ($validation->getError('password2')) : ?>
                                <div class='text text-danger mt-2'>
                                    <?= $error = $validation->getError('password2'); ?>
                                </div>
                            <?php endif ?>

                            <?php if ($user['level'] == 'administrator') : ?>
                                <div class="form-group">
                                    <label class="label-control">Hak Akses</label>
                                    <select class="selectpicker" name="level" id="level" data-style="btn btn-primary btn-round" title="Single Select" data-size="7">
                                        <option disabled selected>Pilih Hak Akses</option>
                                        <?php if ($user['level'] == 'administrator') : ?>
                                            <option selected='true' value="administrator">Administrator</option>
                                            <option value="pegawai">Pegawai</option>
                                        <?php else : ?>
                                            <option value="administrator">Administrator</option>
                                            <option selected='true' value="pegawai">Pegawai</option>
                                        <?php endif; ?>
                                    </select>
                                </div>
                                <?php if ($validation->getError('level')) : ?>
                                    <div class='text text-danger mt-2'>
                                        <?= $error = $validation->getError('level'); ?>
                                    </div>
                                <?php endif ?>

                            <?php endif; ?>







                            <div class="category form-category">
                                <div class="form-footer text-right">

                                    <button type="submit" class="btn btn-success btn-fill">simpan</button>
                                </div>
                            </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>