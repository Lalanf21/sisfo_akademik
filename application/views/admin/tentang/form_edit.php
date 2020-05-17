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
            <?= form_open('update-tentang-kampus') ?>
            <input type="hidden" name="id" value="<?= $data['id_tentang'] ?>">
            <div class="form-group">
                <label for="sejarah">sejarah</label>
                <textarea class="form-control" name="sejarah" id="sejarah" cols="30" rows="10">
                    <?= $data['sejarah'] ?>
                </textarea>
                <div class="text-danger small">
                    <?= form_error('sejarah') ?>
                </div>
            </div>
            <div class="form-group">
                <label for="visi">visi</label>
                <textarea class="form-control" name="visi" id="visi" cols="30" rows="10">
                    <?= $data['visi'] ?>
                </textarea>
                <div class="text-danger small">
                    <?= form_error('visi') ?>
                </div>
            </div>
            <div class="form-group">
                <label for="misi">misi</label>
                <textarea class="form-control" name="misi" id="misi" cols="30" rows="10">
                    <?= $data['misi'] ?>
                </textarea>
                <div class="text-danger small">
                    <?= form_error('misi') ?>
                </div>
            </div>
            <a href="<?= site_url('tentang-kampus') ?>" class="btn btn-primary btn-sm">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>

            <button type="submit" class="btn btn-success btn-sm">
                <i class="fas fa-edit"></i> edit
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