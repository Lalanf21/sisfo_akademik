<!-- Begin Page Content -->
<?php
$enc = $this->encryption->encrypt($data['id_informasi']);
?>
<div class="container-fluid">

    <!-- Page Heading -->

    <div class="alert alert-success" role="alert">
        <i class="fas fa-edit"></i> Form edit data
    </div>
    <?= $this->session->flashdata('pesan') ?>

    <!-- konten -->
    <div class="row">
        <div class="col-lg-8">
            <form action="<?= site_url('update-informasi-kampus') ?>" method="post">
                <input type="hidden" value="<?= $enc ?>" name="id">
                <div class="form-group">
                    <label for="icon">icon informasi</label>
                    <input type="text" class="form-control" id="icon" name="icon" value="<?= $data['icon'] ?>">
                    <div class="text-danger small">
                        <?= form_error('icon') ?>
                    </div>
                </div>
                <div class="form-group">
                    <label for="judul_informasi">Judul informasi</label>
                    <input type="text" class="form-control" id="judul_informasi" name="judul_informasi" value="<?= $data['judul_informasi'] ?>">
                    <div class="text-danger small">
                        <?= form_error('judul_informasi') ?>
                    </div>
                </div>
                <div class="form-group">
                    <label for="isi_informasi">isi informasi</label>
                    <textarea name="isi_informasi" id="isi_informasi" cols="30" rows="10" class="form-control">
                        <?= $data['isi_informasi'] ?>
                    </textarea>
                    <div class="text-danger small">
                        <?= form_error('isi_informasi') ?>
                    </div>
                </div>
                <a href="<?= site_url('informasi-kampus') ?>" class="btn btn-primary btn-sm">
                    <i class="fas fa-arrow-left"></i> Kembali
                </a>
                <button type="submit" class="btn btn-success btn-sm">
                    <i class="fas fa-edit"></i> Edit
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