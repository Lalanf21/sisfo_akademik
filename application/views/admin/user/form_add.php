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
            <?= form_open('save-user') ?>
            <div class="form-group">
                <label for="username">username</label>
                <input type="text" class="form-control" id="username" name="username" value="<?= set_value('username') ?>">
                <div class="text-danger small">
                    <?= form_error('username') ?>
                </div>
            </div>
            <div class="form-group">
                <label for="email">email</label>
                <input type="text" class="form-control" id="email" name="email" value="<?= set_value('email') ?>">
                <div class="text-danger small">
                    <?= form_error('email') ?>
                </div>
            </div>
            <div class="form-group">
                <label for="password1">Password</label>
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
            <div class="form-group">
                <label for="level">Level</label>
                <select name="level" id="level" class="form-control">
                    <option value="-">==PILIH==</option>
                    <option value="user">User</option>
                    <option value="admin">Admin</option>
                </select>
                <div class="text-danger small">
                    <?= form_error('level') ?>
                </div>
            </div>
            <div class="form-group">
                <label for="blokir">blokir</label>
                <select name="blokir" id="blokir" class="form-control">
                    <option value="-">==PILIH==</option>
                    <option value="N">Tidak</option>
                    <option value="Y">ya</option>
                </select>
                <div class="text-danger small">
                    <?= form_error('blokir') ?>
                </div>
            </div>
            <a href="<?= site_url('user') ?>" class="btn btn-primary btn-sm">
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