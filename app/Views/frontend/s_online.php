<section class="page-section">
    <div class="container">
        <?php if (session()->getFlashdata('success') == TRUE) : ?>
            <?= session()->getFlashdata('success'); ?>
        <?php endif; ?>
        <div class="text-center">
            <h2 class="section-heading text-uppercase">Pengajuan Surat Online</h2>
            <h3 class="section-subheading text-muted">Isi Form Pengajuan Surat Dibawah:</h3>
        </div>
        <div class="text-justify pl-5 pr-5">
            <form action="/surat_online/ajukan" id="ajukanSurat" enctype="multipart/form-data" method="post" accept-charset="utf-8">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label class="label-control" for="nik">NIK *</label>
                            <input class="form-control" name="nik" id="nik" required type="text" placeholder='Silahkan masukkan NIK anda' value="<?= old('nik'); ?>" />
                        </div>
                        <?php if ($validation->getError('nik')) : ?>
                            <div class='text text-danger mt-2'>
                                <?= $error = $validation->getError('nik'); ?>
                            </div>
                        <?php endif ?>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label class="label-control" for="nama">Nama *</label>
                            <input class="form-control" name="nama" id="nama" required type="text" placeholder='Silahkan masukkan nama anda' value="<?= old('nama'); ?>" />
                        </div>
                        <?php if ($validation->getError('nama')) : ?>
                            <div class='text text-danger mt-2'>
                                <?= $error = $validation->getError('nama'); ?>
                            </div>
                        <?php endif ?>
                    </div>
                    <div class="col-lg-6 mt-2">
                        <div class="form-group">
                            <label class="label-control" for="no_hp">No Hp *</label>
                            <input class="form-control" name="no_hp" id="no_hp" required type="text" placeholder='Silahkan masukkan No Hp anda' value="<?= old('no_hp'); ?>" />
                        </div>
                        <?php if ($validation->getError('no_hp')) : ?>
                            <div class='text text-danger mt-2'>
                                <?= $error = $validation->getError('no_hp'); ?>
                            </div>
                        <?php endif ?>
                    </div>
                    <div class="col-lg-6 mt-2">
                        <label for="jenis">Pilih Jenis Surat *</label>
                        <?= form_dropdown('jenis_surat', $options, '', ['id' => 'jenis', 'class' => 'form-control']); ?>
                        <?php if ($validation->getError('jenis_surat')) : ?>
                            <div class='text text-danger mt-2'>
                                <?= $error = $validation->getError('jenis_surat'); ?>
                            </div>
                        <?php endif ?>
                    </div>
                    <div class="col-lg-12 mt-2">
                        <label for="file">File Berkas/Lampiran <sup class="text-danger">*PDF Recommended! | Max 5MB</sup></label>
                        <?= form_upload(['name' => 'file', 'id' => 'file', 'class' => 'form-control']) ?>
                        <?php if ($validation->getError('file')) : ?>
                            <div class='text text-danger mt-2'>
                                <?= $error = $validation->getError('file'); ?>
                            </div>
                        <?php endif ?>
                    </div>
                </div>
                <hr>
                <small>
                    <p class="text-danger">PENTING!! Syarat Harus Terpenuhi, Jika Tidak Pengajuan Tidak Diproses!</p>
                    <div id="syarat" class="text-danger">
                    </div>
                </small>
                <hr>
                <div class="row mt-2">
                    <div class="col-lg-4">
                        <button type="submit" class="btn btn-block btn-primary">KIRIM PERMOHONAN</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>