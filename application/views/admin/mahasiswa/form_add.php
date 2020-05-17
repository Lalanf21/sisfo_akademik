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
            <?= form_open_multipart('save-mahasiswa') ?>
            <div class="form-group">
                <label for="nim">Nim</label>
                <input type="text" class="form-control" id="nim" name="nim" value="<?= set_value('nim') ?>">
                <div class="text-danger small">
                    <?= form_error('nim') ?>
                </div>
            </div>
            <div class="form-group">
                <label for="nama_mahasiswa">Nama mahasiswa</label>
                <input type="text" class="form-control" id="nama_mahasiswa" name="nama_mahasiswa" value="<?= set_value('nama_mahasiswa') ?>">
                <div class="text-danger small">
                    <?= form_error('nama_mahasiswa') ?>
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
                <input type="text" class="form-control" id="telepon" name="telepon" value="<?= set_value('telepon') ?>">
                <div class="text-danger small">
                    <?= form_error('telepon') ?>
                </div>
            </div>
            <div class="form-group">
                <label for="tempat_lahir">tempat lahir</label>
                <input type="text" class="form-control" id="tempat_lahir" name="tempat_lahir" value="<?= set_value('telepon') ?>">
                <div class="text-danger small">
                    <?= form_error('tempat_lahir') ?>
                </div>
            </div>
            <div class="form-group">
                <label for="tanggal_lahir">tanggal lahir</label>
                <input type="text" class="form-control" id="tanggal_lahir" name="tanggal_lahir" value="<?= set_value('tanggal_lahir') ?>">
                <div class="text-danger small">
                    <?= form_error('tanggal_lahir') ?>
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
                <label for="nama_prodi">Nama program studi</label>
                <select name="nama_prodi" id="nama_prodi" class="form-control">
                    <option value="-"> --PILIH-- </option>
                    <?php foreach ($prodi as $key) : ?>
                        <option value="<?= $key->nama_prodi ?>">
                            <?= $key->nama_prodi ?>
                        </option>
                    <?php endforeach; ?>
                </select>
                <div class="text-danger small">
                    <?= form_error('nama_prodi') ?>
                </div>
            </div>
            <div class="form-group">
                <label for="foto">Upload Foto</label>
                <input type="file" name="photo" class="form-control">
            </div>
            <a href="<?= site_url('mahasiswa') ?>" class="btn btn-primary btn-sm">
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

<script>
    $(function() {
        $("#tanggal_lahir").datepicker({
            showAnim: 'slide',
            changeMonth: true,
            changeYear: true,
            dateFormat: 'yy-mm-dd'
        });
    });
</script>