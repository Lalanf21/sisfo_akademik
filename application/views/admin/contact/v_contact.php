<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="alert alert-success" role="alert">
        <i class="fas fa-university"></i> Pesan dari User
    </div>

    <?= $this->session->flashdata('pesan') ?>
    <!-- konten -->
    <!-- Earnings (Monthly) Card Example -->
    <div class="row">
        <div class="col-lg-12">
            <table class="table table-hover table-striped text-center">
                <tr class="thead-dark text-uppercase">
                    <th>No</th>
                    <th>Nama</th>
                    <th>email</th>
                    <th>Subject</th>
                    <th>Aksi</th>
                </tr>
                <?php if (empty($contact)) :  ?>
                    <tr>
                        <td colspan="5"> TIDAK ADA PESAN </td>
                    </tr>
                <?php else : ?>
                    <?php $i = 1 ?>
                    <?php foreach ($contact as $key) : ?>
                        <tr>
                            <td> <?= $i++ ?></td>
                            <td> <?= $key->nama ?> </td>
                            <td> <?= $key->email ?> </td>
                            <td> <?= $key->subject ?> </td>
                            <td>
                                <form action="<?= site_url('balas-pesan') ?>" method="post">
                                    <input type="hidden" name="id" value="<?= $key->id_contact ?>">
                                    <button class="btn btn-sm btn-primary">
                                        <i class="fas fa-comment-alt text-white"></i>
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