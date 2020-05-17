<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="alert alert-success" role="alert">
        <i class="fas fa-edit"></i> Form edit
    </div>

    <?= $this->session->flashdata('pesan') ?>

    <!-- konten -->
    <div class="row">
        <div class="col-lg-8">
            <?= form_open('update-user') ?>
            <div class="form-group">
                <input type="hidden" name="id" value="<?= $this->encryption->encrypt($data['id_user']) ?>">
                <label for="username">username</label>
                <input type="text" class="form-control" id="username" name="username" value="<?= $data['username'] ?>">
                <div class="text-danger small">
                    <?= form_error('username') ?>
                </div>
            </div>
            <div class="form-group">
                <label for="email">email</label>
                <input type="text" class="form-control" id="email" name="email" value="<?= $data['email'] ?>">
                <div class="text-danger small">
                    <?= form_error('email') ?>
                </div>
            </div>
            <div class="form-group">
                <label for="level">Level</label>
                <?php $level = ['admin','user'] ?>
                <select name="level" id="level" class="form-control">
                    <option value="-">==PILIH==</option>
                    <?php foreach($level as $key): ?>
                        <?php if ($key === $data['level']): ?>
                            <option value="<?= $key ?>" selected>
                                <?= $data['level'] ?>
                            </option>
                            <?php continue ?>
                        <?php endif ?>
                        <option value="<?= $key ?>"><?= $key ?></option>
                    <?php endforeach ?>
                </select>
                <div class="text-danger small">
                    <?= form_error('level') ?>
                </div>
            </div>
            <div class="form-group">
                <label for="blokir">blokir</label>
                <select name="blokir" id="blokir" class="form-control">
                    <?php $blokir = ['N','Y'] ?>
                    <option value="-">==PILIH==</option>
                    <?php foreach ( $blokir as $key ): ?>
                        <?php if ($key == $data['blokir']): ?>
                            <option value="<?= $key ?>" selected>
                                <?= $data['blokir'] ?>
                            </option>
                            <?php continue ?>
                        <?php endif ?>
                        <option value="<?= $key ?>"><?= $key ?></option>
                    <?php endforeach ?>
                </select>
                <div class="text-danger small">
                    <?= form_error('blokir') ?>
                </div>
            </div>
            <a href="<?= site_url('user') ?>" class="btn btn-primary btn-sm">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>

            <button type="submit" class="btn btn-success btn-sm">
                <i class="fas fa-save"></i> Simpan
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