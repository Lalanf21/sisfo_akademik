<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="alert alert-success" role="alert">
        <i class="fas fa-edit"></i> Form edit data
    </div>

    <?= $this->session->flashdata('pesan') ?>

    <!-- konten -->
    <div class="row">
        <div class="col-lg-8">
            <?= form_open_multipart('update-mahasiswa') ?>
            <input type="hidden" name="id" value="<?= $this->encryption->encrypt($data['id_mahasiswa']) ?>">
            <div class="form-group">
                <label for="nim">Nim</label>
                <input type="text" class="form-control" id="nim" name="nim" value="<?= $data['nim'] ?>">
                <div class="text-danger small">
                    <?= form_error('nim') ?>
                </div>
            </div>
            <div class="form-group">
                <label for="nama_mahasiswa">Nama mahasiswa</label>
                <input type="text" class="form-control" id="nama_mahasiswa" name="nama_mahasiswa" value="<?= $data['nama_lengkap'] ?>">
                <div class="text-danger small">
                    <?= form_error('nama_mahasiswa') ?>
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
            <div class="form-group">
                <label for="tempat_lahir">tempat lahir</label>
                <input type="text" class="form-control" id="tempat_lahir" name="tempat_lahir" value="<?= $data['tempat_lahir'] ?>">
                <div class="text-danger small">
                    <?= form_error('tempat_lahir') ?>
                </div>
            </div>
            <div class="form-group">
                <label for="tanggal_lahir">tanggal lahir</label>
                <input type="text" class="form-control" id="tanggal_lahir" name="tanggal_lahir" value="<?= $data['tanggal_lahir'] ?>">
                <div class="text-danger small">
                    <?= form_error('tanggal_lahir') ?>
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
                <label for="jenis_kelamin">Jenis kelamin</label>
                <select name="jenis_kelamin" id="jenis_kelamin" class="form-control">
                    <option value="-">--PILIH--</option>
                    <?php $jenis = ['pria', 'wanita'] ?>
                    <?php foreach ($jenis as $key) : ?>
                        <?php if ($key == $data['jenis_kelamin']) : ?>
                            <option value="<?= $data['jenis_kelamin'] ?>" selected><?= $data['jenis_kelamin'] ?></option>
                            <?php continue ?>
                        <?php endif ?>
                        <option value="<?= $key ?>"><?= $key ?></option>
                    <?php endforeach ?>
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
                        <?php if ($key->nama_prodi == $data['nama_prodi']) : ?>
                            <option value="<?= $key->nama_prodi ?>" selected>
                                <?= $key->nama_prodi ?>
                            </option>
                            <?php continue ?>
                        <?php endif ?>
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
                <p class="text-center">
                    <img src="<?= base_url('assets/uploads/') . $data['photo'] ?>" alt="<?= $data['nama_lengkap'] ?>" class="responsive-img img-thumbnail">
                </p>
                <input type="file" name="photo" class="form-control">
            </div>
            <a href="<?= site_url('mahasiswa') ?>" class="btn btn-primary btn-sm">
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