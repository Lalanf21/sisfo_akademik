<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="alert alert-success" role="alert">
        <i class="fas fa-key"></i> Ganti password
    </div>

    <?= $this->session->flashdata('pesan') ?>

    <!-- konten -->
    <div class="row">
        <div class="col-lg-8">
            <?= form_open('ganti-password') ?>
            <div class="form-group">
                <label for="passwordLama">Password lama</label>
                <input type="password" class="form-control" id="passwordLama" name="passwordLama" placeholder="masukkan password lama">
                <div class="text-danger small">
                    <?= form_error('passwordLama') ?>
                </div>
            </div>
            <div class="form-group">
                <label for="password1">Password baru</label>
                <input type="password" class="form-control" id="password1" name="password1" placeholder="minimal 5 karakter">
                <div class="text-danger small">
                    <?= form_error('password1') ?>
                </div>
            </div>
            <div class="form-group">
                <label for="password2">Konfirmasi Password</label>
                <input type="password" class="form-control" id="password2" name="password2" placeholder="minimal 5 karakter">
                <div class="text-danger small">
                    <?= form_error('password2') ?>
                </div>
            </div>
            <a href="<?= site_url('admin') ?>" class="btn btn-primary btn-sm">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>

            <button type="submit" class="btn btn-success btn-sm">
                <i class="fas fa-edit"></i> edit
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