<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="alert alert-success" role="alert">
        <i class="fas fa-file-medical"></i> Form tambah data
    </div>

    <?= $this->session->flashdata('pesan') ?>

    <!-- konten -->
    <div class="row">
        <div class="col-lg-8">
            <form action="<?= site_url('save-tahun-akademik') ?>" method="post">
                <div class="form-group">
                    <label for="tahun_akademik">Tahun akademik</label>
                    <input type="text" class="form-control" id="tahun_akademik" name="tahun_akademik" placeholder="ex: 2019/2020" value="<?= set_value('tahun_akademik') ?>">
                    <div class="text-danger small">
                        <?= form_error('tahun_akademik') ?>
                    </div>
                </div>
                <div class="form-group">
                    <label for="semester">Semester</label>
                    <select name="semester" id="semester" class="form-control">
                        <option value="-">--PILIH--</option>
                        <option value="Ganjil">Ganjil</option>
                        <option value="Genap">Genap</option>
                    </select>
                    <div class="text-danger small">
                        <?= form_error('semester') ?>
                    </div>
                </div>
                <div class="form-group">
                    <label for="status">status</label>
                    <select name="status" id="status" class="form-control">
                        <option value="-">--PILIH--</option>
                        <option value="Aktif">Aktif</option>
                        <option value="Tidak aktif">Tidak aktif</option>
                    </select>
                    <div class="text-danger small">
                        <?= form_error('status') ?>
                    </div>
                </div>
                <a href="<?= site_url('tahun-akademik') ?>" class="btn btn-primary btn-sm">
                    <i class="fas fa-arrow-left"></i> Kembali
                </a>

                <button type="submit" class="btn btn-success btn-sm">
                    <i class="fas fa-save"></i> Simpan
                </button>
                <button type="reset" class="btn btn-warning btn-sm">
                    <i class="fas fa-sync"></i> Refresh
                </button>
            </form>
        </div>
    </div>
    <!-- /konten -->


</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->