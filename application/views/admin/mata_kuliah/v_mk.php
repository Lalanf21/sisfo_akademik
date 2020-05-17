<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="alert alert-success" role="alert">
        <i class="fas fa-university"></i> Daftar Mata kuliah
    </div>

    <a href="<?= site_url('tambah-matakuliah') ?>" class="btn btn-primary mb-2"><i class="fas fa-plus"></i> Add data</a>
    <?= $this->session->flashdata('pesan') ?>
    <!-- konten -->
    <!-- Earnings (Monthly) Card Example -->
    <div class="row">
        <div class="col-lg-12">
            <table class="table table-hover table-striped text-center">
                <tr class="thead-dark text-uppercase">
                    <th>No</th>
                    <th>Kode mata kuliah</th>
                    <th>tahun akademik</th>
                    <th>nama mata kuliah</th>
                    <th colspan="3">Aksi</th>
                </tr>
                <?php if (empty($mk)) :  ?>
                    <tr>
                        <td colspan="6"> TIDAK ADA DATA </td>
                    </tr>
                <?php else : ?>
                    <?php $i = 1 ?>
                    <?php foreach ($mk as $key) : ?>
                        <tr>
                            <td> <?= $i++ ?> </td>
                            <td> <?= $key->kode_matakuliah ?> </td>
                            <td> 
                                <?= $key->tahun_akademik.' ('.
                                $key->semester.')' ?> 
                            </td>
                            <td> <?= $key->nama_matakuliah ?> </td>
                            <td width="50px">
                                <button class="btn btn-info btn-sm" data-toggle="modal" data-target="#<?= $key->kode_matakuliah ?>">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </td>
                            <td width="50px">
                                <form action="<?= site_url('edit-matakuliah') ?>" method="post">
                                    <input type="hidden" name="id" value="<?= $this->encryption->encrypt($key->id_matakuliah) ?>">
                                    <button class="btn btn-sm btn-primary">
                                        <i class="fas fa-edit text-white"></i>
                                    </button>
                                </form>
                            </td>
                            <td width="50px">
                                <form action="<?= site_url('hapus-matakuliah') ?>" method="post">
                                    <input type="hidden" name="id" value="<?= $this->encryption->encrypt($key->id_matakuliah) ?>">
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
<?php foreach($mk as $key): ?>
<div class="modal fade" id="<?= $key->kode_matakuliah ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-center text-uppercase" id="exampleModalLabel">Detail Mata kuliah</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table class="table table-striped table-bordered text-capitalize">
                    <tr>
                        <th>Kode Mata Kuliah</th>
                        <td> <?= $key->kode_matakuliah ?> </td>
                    </tr>
                    <tr>
                        <th>Nama Mata Kuliah</th>
                        <td> <?= $key->nama_matakuliah ?> </td>
                    </tr>
                    <tr>
                        <th>SKS</th>
                        <td> <?= $key->sks ?> </td>
                    </tr>
                    <tr>
                        <th>Program Studi</th>
                        <td> <?= $key->nama_prodi ?> </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>
<?php endforeach ?>
<!-- end modal -->