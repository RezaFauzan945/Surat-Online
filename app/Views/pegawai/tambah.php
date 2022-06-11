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
                            <h4 class="card-title">Tambah Pegawai</h4>
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
                                <label class="label-control">Nama</label>
                                <input class="form-control" name="nama" id="nama" type="text" value="<?= old('nama'); ?>" />
                            </div>
                            <?php if ($validation->getError('nama')) : ?>
                                <div class='text text-danger mt-2'>
                                    <?= $error = $validation->getError('nama'); ?>
                                </div>
                            <?php endif ?>

                            <div class="form-group">
                                <label class="label-control">NIP</label>
                                <input class="form-control" name="nip" id="nip" type="text" value="<?= old('nip'); ?>" />
                            </div>
                            <?php if ($validation->getError('nip')) : ?>
                                <div class='text text-danger mt-2'>
                                    <?= $error = $validation->getError('nip'); ?>
                                </div>
                            <?php endif ?>

                            <div class="form-group">
                                <label class="label-control">Tempat Lahir</label>
                                <input class="form-control" name="tempat_lahir" id="tempat_lahir" type="text" value="<?= old('tempat_lahir'); ?>" />
                            </div>
                            <?php if ($validation->getError('tempat_lahir')) : ?>
                                <div class='text text-danger mt-2'>
                                    <?= $error = $validation->getError('tempat_lahir'); ?>
                                </div>
                            <?php endif ?>

                            <div class="form-group">
                                <label class="label-control">Tanggal Lahir</label>
                                <input type="date" class="form-control datepicker" name="tanggal_lahir" id="tanggal_lahir" value="10/10/2016" />
                            </div>
                            <?php if ($validation->getError('tanggal_lahir')) : ?>
                                <div class='text text-danger mt-2'>
                                    <?= $error = $validation->getError('tanggal_lahir'); ?>
                                </div>
                            <?php endif ?>

                            <div class="form-group">
                                <label class="label-control">Alamat</label>
                                <input class="form-control" name="alamat" id="alamat" type="text" value="<?= old('alamat'); ?>" />
                            </div>
                            <?php if ($validation->getError('alamat')) : ?>
                                <div class='text text-danger mt-2'>
                                    <?= $error = $validation->getError('alamat'); ?>
                                </div>
                            <?php endif ?>

                            <div class="form-group">
                                <label class="label-control">Foto</label>
                                <div class="fileinput fileinput-new text-center" data-provides="fileinput">
                                    <div class="fileinput-new thumbnail">
                                    </div>
                                    <div class="fileinput-preview fileinput-exists thumbnail"></div>
                                    <div>
                                        <span class="btn btn-danger btn-file">
                                            <i class="material-icons">cloud_upload</i>
                                            <span class="fileinput-new">Select File</span>
                                            <span class="fileinput-exists">Change</span>
                                            <input type="file" name="foto" id="foto" />
                                        </span>
                                        <a href="#pablo" class="btn btn-danger btn-round fileinput-exists" data-dismiss="fileinput"><i class="fa fa-times"></i> Remove</a>
                                    </div>
                                </div>
                            </div>

                            <?php if ($validation->getError('foto')) : ?>
                                <div class='text text-danger mt-2'>
                                    <?= $error = $validation->getError('foto'); ?>
                                </div>
                            <?php endif ?>

                            <div class="form-group">
                                <label class="label-control">No. Hp</label>
                                <input class="form-control" name="no_hp" id="no_hp" type="text" value="<?= old('no_hp'); ?>" />
                            </div>
                            <?php if ($validation->getError('no_hp')) : ?>
                                <div class='text text-danger mt-2'>
                                    <?= $error = $validation->getError('no_hp'); ?>
                                </div>
                            <?php endif ?>

                            <div class="form-group">
                                <label class="label-control">Jabatan</label>
                                <input class="form-control" name="jabatan" id="jabatan" type="text" value="<?= old('jabatan'); ?>" />
                            </div>
                            <?php if ($validation->getError('jabatan')) : ?>
                                <div class='text text-danger mt-2'>
                                    <?= $error = $validation->getError('jabatan'); ?>
                                </div>
                            <?php endif ?>

                            <div class="form-group">
                                <label class="label-control">Pendidikan</label>
                                <input class="form-control" name="pendidikan" id="pendidikan" type="text" value="<?= old('pendidikan'); ?>" />
                            </div>
                            <?php if ($validation->getError('pendidikan')) : ?>
                                <div class='text text-danger mt-2'>
                                    <?= $error = $validation->getError('pendidikan'); ?>
                                </div>
                            <?php endif ?>


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