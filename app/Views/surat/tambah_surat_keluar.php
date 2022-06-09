<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <form action="" method="POST" enctype="multipart/form-data">
                        <?= csrf_field(); ?>
                        <!-- <form id="RegisterValidation" action="" method=""> -->
                        <div class="card-header card-header-icon" data-background-color="rose">
                            <i class="material-icons">mail_outline</i>
                        </div>
                        <div class="card-content">
                            <h4 class="card-title">Tambah Surat Keluar</h4>
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
                                <label class="label-control">Nama Surat</label>
                                <input class="form-control" name="nama_surat" id="nama_surat" type="text" value="<?= old('nama_surat'); ?>" />
                            </div>
                            <?php if ($validation->getError('nama_surat')) : ?>
                                <div class='text text-danger mt-2'>
                                    <?= $error = $validation->getError('nama_surat'); ?>
                                </div>
                            <?php endif ?>

                            <div class="form-group">
                                <label class="label-control">Tanggal Surat</label>
                                <input type="text" class="form-control datepicker" name="tanggal_surat" id="tanggal_surat" value="10/10/2016" />
                            </div>
                            <?php if ($validation->getError('tanggal_surat')) : ?>
                                <div class='text text-danger mt-2'>
                                    <?= $error = $validation->getError('tanggal_surat'); ?>
                                </div>
                            <?php endif ?>

                            <div class="form-group">
                                <label class="label-control">Keterangan Surat</label>
                                <input class="form-control" name="keterangan_surat" id="keterangan_surat" type="text" <?= old('keterangan_surat'); ?> />
                            </div>
                            <?php if ($validation->getError('keterangan_surat')) : ?>
                                <div class='text text-danger mt-2'>
                                    <?= $error = $validation->getError('keterangan_surat'); ?>
                                </div>
                            <?php endif ?>

                            <div class="form-group">
                                <label class="label-control">File Surat</label>
                                <div class="fileinput fileinput-new text-center" data-provides="fileinput">
                                    <div class="fileinput-new thumbnail">
                                        <!-- <img src="<?= base_url() ?>assets/save.png" alt="..."> -->
                                    </div>
                                    <div class="fileinput-preview fileinput-exists thumbnail"></div>
                                    <div>
                                        <span class="btn btn-danger btn-file">
                                            <i class="material-icons">cloud_upload</i>
                                            <span class="fileinput-new">Select File</span>
                                            <span class="fileinput-exists">Change</span>
                                            <input type="file" name="file_surat" id="file_surat" />
                                        </span>
                                        <a href="#pablo" class="btn btn-danger btn-round fileinput-exists" data-dismiss="fileinput"><i class="fa fa-times"></i> Remove</a>
                                    </div>
                                </div>
                            </div>
                            <?php if ($validation->getError('file_surat')) : ?>
                                <div class='text text-danger mt-2'>
                                    <?= $error = $validation->getError('file_surat'); ?>
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