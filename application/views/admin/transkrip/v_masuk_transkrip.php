<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="alert alert-success" role="alert">
        <i class="fas fa-file"></i> Form masuk halaman Transkrip Nilai
    </div>

    <?= $this->session->flashdata('pesan') ?>
    <!-- konten -->
    <div class="row">
        <div class="col-lg-4">
            <form action="<?= site_url('proses-transkrip') ?>" method="post">
                <div class="form-group">
                    <input type="text" class="form-control" name="nim" placeholder="masukkan nim">
                    <div class="text-danger small">
                        <?= form_error('nim') ?>
                    </div>
                </div>
                <button type="submit" class="btn btn-success btn-sm float-right">
                    Proses <i class="fas fa-arrow-right"></i>
                </button>
            </form>
        </div>
    </div>
    <!-- /konten -->


</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->