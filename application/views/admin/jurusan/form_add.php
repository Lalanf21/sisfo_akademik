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
            <form action="<?= site_url('save-jurusan') ?>" method="post">
                <div class="form-group">
                    <label for="kode_jurusan">Kode Jurusan</label>
                    <input type="text" class="form-control" id="kode_jurusan" name="kode_jurusan">
                    <div class="text-danger small">
                        <?= form_error('kode_jurusan') ?>
                    </div>
                </div>
                <div class="form-group">
                    <label for="nama_jurusan">Nama Jurusan</label>
                    <input type="text" class="form-control" id="nama_jurusan" name="nama_jurusan">
                    <div class="text-danger small">
                        <?= form_error('nama_jurusan') ?>
                    </div>
                </div>
                <a href="<?= site_url('jurusan') ?>" class="btn btn-primary btn-sm">
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