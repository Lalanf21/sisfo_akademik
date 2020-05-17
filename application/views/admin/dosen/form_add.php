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
            <?= form_open_multipart('save-dosen') ?>
            <div class="form-group">
                <label for="nidn">nidn</label>
                <input type="text" class="form-control" id="nidn" name="nidn" value="<?= set_value('nidn') ?>" maxlength="10">
                <div class="text-danger small">
                    <?= form_error('nidn') ?>
                </div>
            </div>
            <div class="form-group">
                <label for="nama_dosen">Nama dosen</label>
                <input type="text" class="form-control" id="nama_dosen" name="nama_dosen" value="<?= set_value('nama_dosen') ?>">
                <div class="text-danger small">
                    <?= form_error('nama_dosen') ?>
                </div>
            </div>
            <div class="form-group">
                <label for="jenis_kelamin">Jenis kelamin</label>
                <select name="jenis_kelamin" id="jenis_kelamin" class="form-control">
                    <option value="-">--PILIH--</option>
                    <option value="pria">Pria</option>
                    <option value="wanita">Wanita</option>
                </select>
                <div class="text-danger small">
                    <?= form_error('jenis_kelamin') ?>
                </div>
            </div>
            <div class="form-group">
                <label for="alamat">alamat</label>
                <input type="text" class="form-control" id="alamat" name="alamat" value="<?= set_value('alamat') ?>">
                <div class="text-danger small">
                    <?= form_error('alamat') ?>
                </div>
            </div>
            <div class="form-group">
                <label for="telepon">telepon</label>
                <input type="text" class="form-control" id="telepon" name="telepon" value="<?= set_value('telepon') ?>" maxlength="12">
                <div class="text-danger small">
                    <?= form_error('telepon') ?>
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
                <label for="foto">Upload Foto</label>
                <input type="file" name="photo" class="form-control">
            </div>
            <a href="<?= site_url('dosen') ?>" class="btn btn-primary btn-sm">
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