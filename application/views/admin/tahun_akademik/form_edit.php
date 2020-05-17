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
            <form action="<?= site_url('update-tahun-akademik') ?>" method="post">
            <input type="hidden" name="id" value="<?= $this->encryption->encrypt($data['id_tahun_akademik']) ?>">
                <div class="form-group">
                    <label for="tahun_akademik">Tahun akademik</label>
                    <input type="text" class="form-control" id="tahun_akademik" name="tahun_akademik" value="<?= $data['tahun_akademik'] ?>">
                    <div class="text-danger small">
                        <?= form_error('tahun_akademik') ?>
                    </div>
                </div>
                <div class="form-group">
                    <label for="semester">Semester</label>
                    <select name="semester" id="semester" class="form-control">
                        <option value="-">--PILIH--</option>
                        <?php $semester = ['Ganjil', 'Genap']; ?>
                        <?php foreach($semester as $key): ?>
                            <?php if ( $key == $data['semester'] ): ?>
                                <option value="<?= $data['semester'] ?>" selected>
                                    <?= $data['semester'] ?>
                                </option>
                            <?php continue ?>
                            <?php endif ?>
                            <option value="<?= $key ?>"><?= $key ?></option>
                        <?php endforeach ?>
                    </select>
                    <div class="text-danger small">
                        <?= form_error('semester') ?>
                    </div>
                </div>
                <div class="form-group">
                    <label for="status">status</label>
                    <select name="status" id="status" class="form-control">
                        <option value="-">--PILIH--</option>
                        <?php $status = ['Aktif','Tidak aktif'] ?>
                        <?php foreach ( $status as $key ): ?>
                            <?php if ( $key == $data['status'] ): ?>
                                <option value="<?= $data['status'] ?>" selected>
                                    <?= $data['status'] ?>
                                </option>
                            <?php continue ?>
                            <?php endif ?>
                            <option value="<?= $key ?>"><?= $key ?></option>
                            <?php endforeach ?>
                    </select>
                    <div class="text-danger small">
                        <?= form_error('status') ?>
                    </div>
                </div>
                <a href="<?= site_url('tahun-akademik') ?>" class="btn btn-primary btn-sm">
                    <i class="fas fa-arrow-left"></i> Kembali
                </a>

                <button type="submit" class="btn btn-success btn-sm">
                    <i class="fas fa-edit"></i> Edit
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