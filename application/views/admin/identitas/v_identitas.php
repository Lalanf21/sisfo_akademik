<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="alert alert-success" role="alert">
        <i class="fas fa-university"></i> Identitas kampus
    </div>

    <?= $this->session->flashdata('pesan') ?>
    <!-- konten -->
    <!-- Earnings (Monthly) Card Example -->
    <div class="row">
        <div class="col-lg-12">
            <table class="table table-hover table-striped text-center">
                <tr class="thead-dark text-uppercase">
                    <th>Nama kampus</th>
                    <th>email</th>
                    <th>alamat</th>
                    <th>no telepon</th>
                    <th>Aksi</th>
                </tr>
                <?php if (empty($identitas)) :  ?>
                    <tr>
                        <td colspan="5"> TIDAK ADA DATA </td>
                    </tr>
                <?php else : ?>
                    <?php foreach ($identitas as $key) : ?>
                        <tr>
                            <td> <?= $key->nama_kampus ?> </td>
                            <td> <?= $key->email ?> </td>
                            <td> <?= $key->alamat ?> </td>
                            <td> <?= $key->telepon ?> </td>
                            <td>
                                <form action="<?= site_url('edit-identitas') ?>" method="post">
                                    <input type="hidden" name="id" value="<?= $key->id_identitas ?>">
                                    <button class="btn btn-sm btn-primary">
                                        <i class="fas fa-edit text-white"></i>
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