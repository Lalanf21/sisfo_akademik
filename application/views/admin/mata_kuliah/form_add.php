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
            <form action="<?= site_url('save-matakuliah') ?>" method="post">
                <div class="form-group">
                    <label for="kode_matakuliah">Kode mata kuliah</label>
                    <input type="text" class="form-control" id="kode_matakuliah" name="kode_matakuliah">
                    <div class="text-danger small">
                        <?= form_error('kode_matakuliah') ?>
                    </div>
                </div>
                <div class="form-group">
                    <label for="nama_matakuliah">Nama mata kuliah</label>
                    <input type="text" class="form-control" id="nama_matakuliah" name="nama_matakuliah">
                    <div class="text-danger small">
                        <?= form_error('nama_matakuliah') ?>
                    </div>
                </div>
                <div class="form-group">
                    <label for="tahun_akademik">Tahun Akademik</label>
                    <select name="tahun_akademik" id="tahun_akademik" class="form-control">
                        <option value="-">--PILIH--</option>
                        <?php foreach($tahun_akademik as $key): ?>
                            <option value="<?= $key->id_tahun_akademik ?>">
                                <?= $key->tahun_akademik.' ( '.$key->semester.' )' ?>
                            </option>
                        <?php endforeach ?>
                    </select>
                    <div class="text-danger small">
                        <?= form_error('tahun_akademik') ?>
                    </div>
                </div>
                <div class="form-group">
                    <label for="sks">SKS</label>
                    <select name="sks" id="sks" class="form-control">
                        <option value="-">--PILIH--</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                    </select>
                    <div class="text-danger small">
                        <?= form_error('sks') ?>
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
                <a href="<?= site_url('mata_kuliah') ?>" class="btn btn-primary btn-sm">
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