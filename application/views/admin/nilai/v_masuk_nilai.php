<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="alert alert-success" role="alert">
        <i class="fas fa-file"></i> Nilai akademik
    </div>

    <?= $this->session->flashdata('pesan') ?>
    <button class="badge-lg badge-info" data-toggle="modal" data-target="#daftarNilai"> <i class=" fas fa-list"></i> Daftar Nilai</button>

    <!-- konten -->
    <div class="row">
        <div class="col-lg-4">
            <form action="<?= site_url('proses-nilai/form') ?>" method="post">
                <div class="form-group">
                    <label for="kode_matkul"> Nama Mata kuliah / kode mata kuliah </label>
                    <select name="kode_matkul" id="kode_matkul" class="form-control">
                        <option value="-">==PILIH==</option>
                        <?php foreach ($matakuliah as $mk) : ?>
                            <option value="<?= $mk->kode_matakuliah ?>">
                                <?= $mk->nama_matakuliah . ' (' . $mk->kode_matakuliah . ')' ?>
                            </option>
                        <?php endforeach ?>
                    </select>
                    <div class="text-danger small">
                        <?= form_error('kode_matkul') ?>
                    </div>
                </div>
                <div class="form-group">
                    <label for="tahun_akademik">
                        Tahun Akademik / Semester
                    </label>
                    <select name="tahun_akademik" id="tahun_akademik" class="form-control">
                        <option value="-">==pilih==</option>
                        <?php foreach ($tahun_akademik as $key) : ?>
                            <?php $lists = $key->tahun_semester . '' . $key->semester ?>
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

<!-- Modal -->
<div class="modal fade" id="daftarNilai" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-center text-uppercase" id="exampleModalLabel">Lihat daftar nilai mahasiswa</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?= site_url('proses-nilai/daftar') ?>" method="post">
                    <div class="form-group">
                        <label for="kode_matkul"> Nama Mata kuliah / kode mata kuliah </label>
                        <select name="kode_matkul" id="kode_matkul" class="form-control">
                            <option value="-">==PILIH==</option>
                            <?php foreach ($matakuliah as $mk) : ?>
                                <option value="<?= $mk->kode_matakuliah ?>">
                                    <?= $mk->nama_matakuliah . ' (' . $mk->kode_matakuliah . ')' ?>
                                </option>
                            <?php endforeach ?>
                        </select>
                        <div class="text-danger small">
                            <?= form_error('kode_matkul') ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="tahun_akademik">
                            Tahun Akademik / Semester
                        </label>
                        <select name="tahun_akademik" id="tahun_akademik" class="form-control">
                            <option value="-">==pilih==</option>
                            <?php foreach ($tahun_akademik as $key) : ?>
                                <?php $lists = $key->tahun_semester . '' . $key->semester ?>
                                <option value="<?= $key->id_tahun_akademik ?>">
                                    <?= $lists ?>
                                </option>
                            <?php endforeach ?>
                        </select>
                        <div class="text-danger small">
                            <?= form_error('tahun_akademik') ?>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-info btn-sm float-right">
                        Lihat data <i class="fas fa-arrow-right"></i>
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- end modal -->