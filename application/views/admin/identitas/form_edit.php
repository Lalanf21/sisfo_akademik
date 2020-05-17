<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="alert alert-success" role="alert">
        <i class="fas fa-edit"></i> Form edit data
    </div>

    <?= $this->session->flashdata('pesan') ?>
    <?= validation_errors() ?>

    <!-- konten -->
    <div class="row">
        <div class="col-lg-8">
            <?= form_open('update-identitas') ?>
            <input type="hidden" name="id" value="<?= $data['id_identitas'] ?>">
            <div class="form-group">
                <label for="nama_kampus">nama kampus</label>
                <input type="text" class="form-control" id="nama_kampus" name="nama_kampus" value="<?= $data['nama_kampus'] ?>">
                <div class="text-danger small">
                    <?= form_error('nama_kampus') ?>
                </div>
            </div>
            <div class="form-group">
                <label for="email">email</label>
                <input type="text" class="form-control" id="email" name="email" value="<?= $data['email'] ?>">
                <div class="text-danger small">
                    <?= form_error('email') ?>
                </div>
            </div>
            <div class="form-group">
                <label for="alamat">alamat</label>
                <input type="text" class="form-control" id="alamat" name="alamat" value="<?= $data['alamat'] ?>">
                <div class="text-danger small">
                    <?= form_error('alamat') ?>
                </div>
            </div>
            <div class="form-group">
                <label for="telepon">telepon</label>
                <input type="text" class="form-control" id="telepon" name="telepon" value="<?= $data['telepon'] ?>">
                <div class="text-danger small">
                    <?= form_error('telepon') ?>
                </div>
            </div>
            <a href="<?= site_url('identitas-kampus') ?>" class="btn btn-primary btn-sm">
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