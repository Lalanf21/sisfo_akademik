<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="alert alert-success" role="alert">
        <i class="fas fa-list"></i> Management menu
    </div>

    <?= $this->session->flashdata('pesan') ?>

    <!-- konten -->
    <div class="row justify-content-between p-3 shadow">
        <div class="col-md-6">
            <h3 class="text-capitalize text-center card-header">menu</h3>
            <button class="badge-lg badge-info my-2" data-toggle="modal" data-target="#Menu"> <i class="fas fa-plus"></i> Add menu</button>

            <table class="table table-striped table-hover">
                <tr class="thead-dark text-uppercase text-center">
                    <th>No</th>
                    <th>Nama Menu</th>
                    <th>Icon</th>
                    <th>Active</th>
                    <th colspan="2">Aksi</th>
                </tr>
                <?php $i = 1 ?>
                <?php foreach ($menu as $key) : ?>
                    <tr>
                        <td> <?= $i++ ?> </td>
                        <td> <?= $key->nama_menu ?> </td>
                        <td> <i class="<?= $key->icon ?>"></i> </td>
                        <td align="center"> <?= is_active($key->active) ?> </td>
                        <td>
                            <form action="post" method="post">
                                <input type="hidden" name="id" value="<?= $key->id_menu ?>">
                                <button type="submit" class="badge badge-warning rounded"> <i class="fas fa-edit"></i> </button>
                            </form>
                        </td>
                        <td>
                            <form action="post" method="post">
                                <input type="hidden" name="id" value="<?= $key->id_menu ?>">
                                <button type="submit" class="badge badge-danger rounded"> <i class="fas fa-trash"></i> </button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach ?>
            </table>
        </div>
        <div class="col-md-6">
            <h3 class="text-capitalize text-center card-header">Sub-menu</h3>
            <button class="badge-lg badge-info my-2" data-toggle="modal" data-target="#subMenu"> <i class="fas fa-plus"></i> Add Submenu</button>

            <table class="table table-striped table-hover">
                <tr class="thead-dark text-center text-uppercase">
                    <th>No</th>
                    <th>Nama subMenu</th>
                    <th>Menu</th>
                    <th>Active</th>
                    <th colspan="2">Aksi</th>
                </tr>
                <?php $i = 1 ?>
                <?php foreach ($subMenu as $key) : ?>
                    <tr>
                        <td><?= $i++ ?></td>
                        <td><?= $key->nama_submenu ?></td>
                        <td><?= $key->nama_menu ?></td>
                        <td align="center"> <?= is_active($key->active) ?> </td>
                        <td>
                            <form action="post" method="post">
                                <input type="hidden" name="id" value="<?= $key->id_sub_menu ?>">
                                <button type="submit" class="badge badge-warning rounded"> <i class="fas fa-edit"></i> </button>
                            </form>
                        </td>
                        <td>
                            <form action="post" method="post">
                                <input type="hidden" name="id" value="<?= $key->id_sub_menu ?>">
                                <button type="submit" class="badge badge-danger rounded"> <i class="fas fa-trash"></i> </button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach ?>
            </table>
        </div>
    </div>
    <!-- /konten -->


</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

<!-- Modal menu -->
<div class="modal fade" id="Menu" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-center text-uppercase" id="exampleModalLabel">Tambah menu</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?= site_url('') ?>" method="post">
                    <div class="form-group">
                        <label for="nama_menu"> Nama submenu </label>
                        <input type="text" name="nama_submenu" id="nama_submenu" class="form-control">
                        <div class="text-danger small">
                            <?= form_error('nama_submenu') ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="icon">icon</label>
                        <input type="text" name="icon" id="icon" class="form-control">
                        <div class="text-danger small">
                            <?= form_error('icon') ?>
                        </div>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="1" id="active">
                        <label class="form-check-label" for="active">
                            Active ?
                        </label>
                    </div>

                    <button type="submit" class="btn btn-info btn-sm float-right">
                        Simpan <i class="fas fa-check"></i>
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- end modal menu -->

<!-- Modal sub menu -->
<div class="modal fade" id="subMenu" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-center text-uppercase" id="exampleModalLabel">Tambah sub menu</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?= site_url('') ?>" method="post">
                    <div class="form-group">
                        <label for="nama_submenu"> Nama sub menu </label>
                        <input type="text" name="nama_submenu" id="nama_submenu" class="form-control">
                        <div class="text-danger small">
                            <?= form_error('nama_submenu') ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="menu">menu</label>
                        <select name="menu" id="menu" class="form-control">
                            <?php foreach ($menu as $key) : ?>
                                <option value="<?= $key->id_menu ?>">
                                    <?= $key->nama_menu ?>
                                </option>
                            <?php endforeach ?>
                        </select>
                        <div class="text-danger small">
                            <?= form_error('menu') ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="nama_url"> URL </label>
                        <input type="text" name="nama_url" id="nama_url" class="form-control">
                        <div class="text-danger small">
                            <?= form_error('nama_url') ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="nama_controller"> Nama controller </label>
                        <input type="text" name="nama_controller" id="nama_controller" class="form-control">
                        <div class="text-danger small">
                            <?= form_error('nama_controller') ?>
                        </div>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="1" id="active">
                        <label class="form-check-label" for="active">
                            Active ?
                        </label>
                    </div>

                    <button type="submit" class="btn btn-info btn-sm float-right">
                        Simpan <i class="fas fa-check"></i>
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- end modal -->