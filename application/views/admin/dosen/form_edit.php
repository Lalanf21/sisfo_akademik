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
            <?= form_open_multipart('update-dosen') ?>
            <input type="hidden" name="id" value="<?= $this->encryption->encrypt($data['id_dosen']) ?>">
            <div class="form-group">
                <label for="nidn">NIDN</label>
                <input type="text" class="form-control" id="nidn" name="nidn" value="<?= $data['nidn'] ?>">
                <div class="text-danger small">
                    <?= form_error('nidn') ?>
                </div>
            </div>
            <div class="form-group">
                <label for="nama_dosen">Nama dosen</label>
                <input type="text" class="form-control" id="nama_dosen" name="nama_dosen" value="<?= $data['nama_dosen'] ?>">
                <div class="text-danger small">
                    <?= form_error('nama_dosen') ?>
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
                <label for="email">email</label>
                <input type="text" class="form-control" id="email" name="email" value="<?= $data['email'] ?>">
                <div class="text-danger small">
                    <?= form_error('email') ?>
                </div>
            </div>
            <div class="form-group">
                <label for="foto">Upload Foto</label>
                <p class="text-center">
                    <img src="<?= base_url('assets/uploads/dosen/') . $data['foto'] ?>" alt="<?= $data['nama_dosen'] ?>" class="responsive-img img-thumbnail">
                </p>
                <input type="file" name="photo" class="form-control">
            </div>
            <a href="<?= site_url('dosen') ?>" class="btn btn-primary btn-sm">
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