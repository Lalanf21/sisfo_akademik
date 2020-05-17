<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="alert alert-success" role="alert">
        <i class="fas fa-university"></i> Program Studi
    </div>

    <a href="<?= site_url('tambah-user') ?>" class="btn btn-primary mb-2"><i class="fas fa-plus"></i> Add data</a>
    <?= $this->session->flashdata('pesan') ?>
    <!-- konten -->
    <!-- Earnings (Monthly) Card Example -->
    <div class="row">
        <div class="col-lg-12">
            <table class="table table-hover table-striped text-center">
                <tr class="thead-dark text-uppercase">
                    <th>No</th>
                    <th>Username</th>
                    <th>email</th>
                    <th>level</th>
                    <th colspan="2">Aksi</th>
                </tr>
                <?php if (empty($user)) :  ?>
                    <tr>
                        <td colspan="5"> TIDAK ADA DATA </td>
                    </tr>
                <?php else : ?>
                    <?php $i = 1 ?>
                    <?php foreach ($user as $key) : ?>
                        <tr>
                            <td> <?= $i++ ?> </td>
                            <td> <?= $key->username ?> </td>
                            <td> <?= $key->email ?> </td>
                            <td> <?= $key->level ?> </td>
                            <td>
                                <form action="<?= site_url('edit-user') ?>" method="post">
                                    <input type="hidden" name="id" value="<?= $this->encryption->encrypt($key->id_user) ?>">
                                    <button class="btn btn-sm btn-primary">
                                        <i class="fas fa-edit text-white"></i>
                                    </button>
                                </form>
                            </td>
                            <td width="50px">
                                <form action="<?= site_url('hapus-user') ?>" method="post">
                                    <input type="hidden" name="id" value="<?= $this->encryption->encrypt($key->id_user) ?>">
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