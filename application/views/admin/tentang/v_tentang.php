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
                    <th>Sejarah</th>
                    <th>Visi</th>
                    <th>Misi</th>
                    <th>Aksi</th>
                </tr>
                <?php if (empty($tentang)) :  ?>
                    <tr>
                        <td colspan="5"> TIDAK ADA DATA </td>
                    </tr>
                <?php else : ?>
                    <?php foreach ($tentang as $key) : ?>
                        <tr>
                            <td align="justify"> <?= $key->sejarah ?> </td>
                            <td align="justfy"> <?= $key->visi ?> </td>
                            <td align="justify"> <?= $key->misi ?> </td>
                            <td>
                                <form action="<?= site_url('edit-tentang-kampus') ?>" method="post">
                                    <input type="hidden" name="id" value="<?= $key->id_tentang ?>">
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