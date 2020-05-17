<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="alert alert-success" role="alert">
        <i class="fas fa-file-medical"></i> Form tambah KRS
    </div>

    <?= $this->session->flashdata('pesan') ?>

    <!-- konten -->
    <div class="row">
        <div class="col-lg-8">
            <form action="<?= site_url('save-krs') ?>" method="post">
                <div class="form-group">
                    <label for="tahun_akademik">Tahun akademik</label>
                    <input type="text" class="form-control" id="tahun_akademik" name="tahun_akademik" value="<?= $akademik->tahun_akademik.' - '. $akademik->semester ?>" readonly>
                </div>
                <div class="form-group">
                    <label for="nim">NIM mahasiswa</label>
                    <input type="text" class="form-control" id="nim" name="out_nim" value="<?= $nim ?>" readonly>
                </div>
                <div class="form-group">
                    <label for="mata_kuliah">mata_kuliah</label>
                    <select name="mata_kuliah" id="mata_kuliah" class="form-control">
                        <option value=" ">--PILIH--</option>
                        <?php foreach($mata_kuliah as $key): ?>
                            <option value="<?= $key->kode_matakuliah ?>">
                                <?= $key->nama_matakuliah ?>
                            </option>
                        <?php endforeach ?>
                    </select>
                    <div class="text-danger small">
                        <?= form_error('mata_kuliah') ?>
                    </div>
                </div>
                <a href="<?= site_url('tampil-krs') ?>" class="btn btn-primary btn-sm">
                    <i class="fas fa-arrow-left"></i> Kembali
                </a>

                <button type="submit" class="btn btn-success btn-sm">
                    <i class="fas fa-save"></i> Simpan
                </button>
            </form>
        </div>
    </div>
    <!-- /konten -->


</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->