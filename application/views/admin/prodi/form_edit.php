<!-- Begin Page Content -->
<?php
$enc = $this->encryption->encrypt($data['id_prodi']);
?>
<div class="container-fluid">

    <!-- Page Heading -->

    <div class="alert alert-success" role="alert">
        <i class="fas fa-edit"></i> Form edit data
    </div>
    <?= $this->session->flashdata('pesan') ?>

    <!-- konten -->
    <div class="row">
        <div class="col-lg-8">
            <form action="<?= site_url('update-prodi') ?>" method="post">
                <input type="hidden" value="<?= $enc ?>" name="id">
                <div class="form-group">
                    <label for="kode_prodi">Kode prodi</label>
                    <input type="text" class="form-control" id="kode_prodi" name="kode_prodi" value="<?= $data['kode_prodi'] ?>">
                    <div class="text-danger small">
                        <?= form_error('kode_prodi') ?>
                    </div>
                </div>
                <div class="form-group">
                    <label for="nama_prodi">Nama program studi</label>
                    <input type="text" class="form-control" id="nama_prodi" name="nama_prodi" value="<?= $data['nama_prodi'] ?>">
                    <div class="text-danger small">
                        <?= form_error('nama_prodi') ?>
                    </div>
                </div>
                <div class="form-group">
                    <label for="nama_jurusan"> Nama Jurusan </label>
                    <select name="nama_jurusan" id="nama_jurusan" class="form-control">
                        <option value="-">--PILIH--</option>
                        <?php foreach ($jurusan as $key) : ?>
                            <?php if ($key->nama_jurusan === $data['nama_jurusan']) : ?>
                                <option value="<?= $data['nama_jurusan'] ?>" selected>
                                    <?= $data['nama_jurusan'] ?>
                                </option>
                            <?php continue ?>
                            <?php endif ?>
                                <option value="<?= $key->nama_jurusan ?>">
                                <?= $key->nama_jurusan ?>
                                </option>
                        <?php endforeach ?>
                    </select>
                    <div class="text-danger small">
                        <?= form_error('nama_jurusan') ?>
                    </div>
                </div>
                <a href="<?= site_url('program_studi') ?>" class="btn btn-primary btn-sm">
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