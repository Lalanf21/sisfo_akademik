<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="alert alert-success" role="alert">
        <i class="fas fa-file-medical"></i> Form tambah data
    </div>

    <?= $this->session->flashdata('pesan') ?>

    <!-- konten -->
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <form action="<?= site_url('save-informasi-kampus') ?>" method="post">
                <div class="form-group">
                    <label for="icon">icon informasi</label>
                    <input type="text" class="form-control" id="icon" name="icon">
                    <div class="text-danger small">
                        <?= form_error('icon') ?>
                    </div>
                </div>
                <div class="form-group">
                    <label for="judul_informasi">Judul informasi</label>
                    <input type="text" class="form-control" id="judul_informasi" name="judul_informasi">
                    <div class="text-danger small">
                        <?= form_error('judul_informasi') ?>
                    </div>
                </div>
                <div class="form-group">
                    <label for="isi_informasi">isi informasi</label>
                    <textarea name="isi_informasi" id="isi_informasi" cols="30" rows="10" class="form-control">

                    </textarea>
                    <div class="text-danger small">
                        <?= form_error('isi_informasi') ?>
                    </div>
                </div>
                <a href="<?= site_url('informasi-kampus') ?>" class="btn btn-primary btn-sm">
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