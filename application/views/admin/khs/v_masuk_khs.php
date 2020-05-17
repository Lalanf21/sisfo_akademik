<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="alert alert-success" role="alert">
        <i class="fas fa-file"></i> Form masuk halaman KHS
    </div>

    <?= $this->session->flashdata('pesan') ?>

    <!-- konten -->
    <div class="row">
        <div class="col-lg-6">
            <form action="<?= site_url('proses-khs') ?>" method="post">
                <div class="form-group">
                    <label for="nim">NIM</label>
                    <input type="text" class="form-control" id="nim" name="nim" placeholder="Masukkan NIM">
                    <div class="text-danger small">
                        <?= form_error('nim') ?>
                    </div>
                </div>
                <div class="form-group">
                    <label for="tahun_akademik">
                        Tahun Akademik / Semester
                    </label>
                    <select name="tahun_akademik" id="tahun_akademik" class="form-control">
                        <option value="-">==pilih==</option>
                        <?php foreach($tahun_akademik as $key): ?>
                            <?php $lists = $key->tahun_semester.''.$key->semester ?>
                            <option value="<?= $key->id_tahun_akademik ?>">
                                <?= $lists ?>   
                            </option>
                        <?php endforeach ?>
                    </select>
                    <div class="text-danger small">
                        <?= form_error('tahun_akademik') ?>
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