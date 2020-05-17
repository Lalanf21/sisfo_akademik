<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="alert alert-success" role="alert">
        <i class="fas fa-university"></i> Daftar Mahasiswa
    </div>

    <a href="<?= site_url('tambah-dosen') ?>" class="btn btn-primary mb-2"><i class="fas fa-plus"></i> Add data</a>
    <?= $this->session->flashdata('pesan') ?>
    <!-- konten -->
    <!-- Earnings (Monthly) Card Example -->
    <div class="row">
        <div class="col-lg-12">
            <table class="table table-hover table-striped text-center">
                <tr class="thead-dark text-uppercase">
                    <th>No</th>
                    <th>NIDN</th>
                    <th>nama</th>
                    <th>jenis kelamin</th>
                    <th colspan="3">Aksi</th>
                </tr>
                <?php if (empty($dosen)) :  ?>
                    <tr>
                        <td colspan="5"> TIDAK ADA DATA </td>
                    </tr>
                <?php else : ?>
                    <?php $i = 1 ?>
                    <?php foreach ($dosen as $key) : ?>
                        <tr>
                            <td> <?= $i++ ?> </td>
                            <td> <?= $key->nidn ?> </td>
                            <td> <?= $key->nama_dosen ?> </td>
                            <td> <?= $key->jenis_kelamin ?> </td>
                            <td width="50px">
                                <button class="btn btn-info btn-sm" data-toggle="modal" data-target="#m<?= $key->id_dosen ?>">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </td>
                            <td width="50px">
                                <form action="<?= site_url('edit-dosen') ?>" method="post">
                                    <input type="hidden" name="id" value="<?= $this->encryption->encrypt($key->id_dosen) ?>">
                                    <button class="btn btn-sm btn-primary">
                                        <i class="fas fa-edit text-white"></i>
                                    </button>
                                </form>
                            </td>
                            <td width="50px">
                                <form action="<?= site_url('hapus-dosen') ?>" method="post">
                                    <input type="hidden" name="id" value="<?= $this->encryption->encrypt($key->id_dosen) ?>">
                                    <button onclick="return confirm('Anda yakin ?')" class="btn btn-sm btn-danger">
                                        <i class="fas fa-trash text-white"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach ?>
                <?php endif ?>
            </table>
        </div>
    </div>
    <!-- /konten -->


</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

<!-- Modal -->
<?php foreach ($dosen as $m) : ?>
    <div class="modal fade" id="m<?= $m->id_dosen ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-center text-uppercase" id="exampleModalLabel">Detail Dosen</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p class="text-center">
                        <img src="<?=base_url('assets/uploads/dosen/').$m->foto ?>" alt="<?= $m->nama_dosen ?>" class="img-thumbnail mb-2">
                    </p>
                    <table class="table table-striped table-bordered text-capitalize">
                        <tr>
                            <th>nim</th>
                            <td> <?= $m->nidn ?> </td>
                        </tr>
                        <tr>
                            <th> nama lengkap</th>
                            <td> <?= $m->nama_dosen ?> </td>
                        </tr>
                        <tr>
                            <th>jenis kelamin</th>
                            <td> <?= $m->jenis_kelamin ?> </td>
                        </tr>
                        <tr>
                            <th>alamat</th>
                            <td> <?= $m->alamat ?> </td>
                        </tr>
                        <tr>
                            <th>email</th>
                            <td> <?= $m->email ?> </td>
                        </tr>
                        <tr>
                            <th>telepon</th>
                            <td> <?= $m->telepon ?> </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
<?php endforeach ?>
<!-- end modal -->