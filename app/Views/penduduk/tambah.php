<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <form action="" method="POST" enctype="multipart/form-data">
                        <?= csrf_field(); ?>
                        <!-- <form id="RegisterValidation" action="" method=""> -->
                        <div class="card-header card-header-icon" data-background-color="rose">
                            <i class="material-icons">assignment_ind</i>
                        </div>
                        <div class="card-content">
                            <h4 class="card-title">Tambah Penduduk</h4>
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
                                <label class="label-control">NIK</label>
                                <input class="form-control" name="nik" id="nik" type="text" value="<?= old('nik'); ?>" />
                                <?php if ($validation->getError('nik')) : ?>
                                    <div class='text text-danger mt-2'>
                                        <?= $error = $validation->getError('nik'); ?>
                                    </div>
                                <?php endif ?>
                            </div>

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
                                <label class="label-control">Tempat Lahir</label>
                                <input class="form-control" name="tmpt_lhr" id="tmpt_lhr" type="text" value="<?= old('tmpt_lhr'); ?>" />
                            </div>
                            <?php if ($validation->getError('tmpt_lhr')) : ?>
                                <div class='text text-danger mt-2'>
                                    <?= $error = $validation->getError('tmpt_lhr'); ?>
                                </div>
                            <?php endif ?>

                            <div class="form-group">
                                <label class="label-control">Tanggal Lahir</label>
                                <input type="text" class="form-control datepicker" name="tgl_lhr" id="tgl_lhr" value="10/10/2016" />
                            </div>
                            <?php if ($validation->getError('tgl_lhr')) : ?>
                                <div class='text text-danger mt-2'>
                                    <?= $error = $validation->getError('tgl_lhr'); ?>
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
                                <label class="label-control">No. Hp</label>
                                <input class="form-control" name="no_hp" id="no_hp" type="text" value="<?= old('no_hp'); ?>" />
                            </div>
                            <?php if ($validation->getError('no_hp')) : ?>
                                <div class='text text-danger mt-2'>
                                    <?= $error = $validation->getError('no_hp'); ?>
                                </div>
                            <?php endif ?>

                            <div class="form-group">
                                <label class="label-control">Pekerjaan</label>
                                <input class="form-control" name="pekerjaan" id="pekerjaan" type="text" value="<?= old('pekerjaan'); ?>" />
                            </div>
                            <?php if ($validation->getError('pekerjaan')) : ?>
                                <div class='text text-danger mt-2'>
                                    <?= $error = $validation->getError('pekerjaan'); ?>
                                </div>
                            <?php endif ?>

                            <div class="form-group">
                                <label class="label-control">RW/RT</label>
                                <div class="row">
                                    <div class="col-md-3">
                                        <input class="form-control" placeholder="RW" name="rw" id="rw" type="number" value="<?= old('rw'); ?>" />
                                        <?php if ($validation->getError('rw')) : ?>
                                            <div class='text text-danger mt-2'>
                                                <?= $error = $validation->getError('rw'); ?>
                                            </div>
                                        <?php endif ?>
                                    </div>
                                    <div class="col-md-3">
                                        <input class="form-control" placeholder="RT" name="rt" id="rt" type="number" value="<?= old('rt'); ?>" />
                                        <?php if ($validation->getError('rt')) : ?>
                                            <div class='text text-danger mt-2'>
                                                <?= $error = $validation->getError('rt'); ?>
                                            </div>
                                        <?php endif ?>
                                    </div>
                                </div>
                            </div>

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