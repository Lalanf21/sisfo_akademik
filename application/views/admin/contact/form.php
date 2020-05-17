<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="alert alert-success" role="alert">
        <i class="fas fa-edit"></i> Form edit data
    </div>
    <a href="<?=site_url('contact-us') ?>" class="btn btn-sm btn-outline-primary my-3">
        <i class="fas fa-arrow-left"></i>
    </a>

    <?= $this->session->flashdata('pesan') ?>

    <!-- konten -->
    <div class="row justify-content-between">
        <div class="col-md-5">
            <div class="card">
                <div class="card-header">
                    <h4>Pesan User</h4>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label>Nama</label>
                        <input type="text" name="nama" class="form-control" value="<?= $data['nama'] ?>" readonly>
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" name="email" class="form-control" readonly value="<?= $data['email'] ?>">
                    </div>
                    <div class="form-group">
                        <label>Subject</label>
                        <input type="email" name="subject" class="form-control" readonly value="<?= $data['subject'] ?>">
                    </div>
                    <div class="form-group mb-0">
                        <label>Pesan</label>
                        <textarea class="form-control" name="pesan" readonly>
                            <?= $data['pesan'] ?>
                        </textarea>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-5">
            <div class="card">
                <form method="POST" action="<?= site_url('send-email') ?>">
                    <div class="card-header">
                        <h4>Balas Pesan</h4>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label>Kirim ke</label>
                            <input type="hidden" name="id" value="<?= $data['id_contact'] ?>">
                            <input type="email" name="email" class="form-control" readonly value="<?= $data['email'] ?>">
                        </div>
                        <div class="form-group">
                            <label>Subject</label>
                            <input autofocus type="text" name="subject" class="form-control" required>
                        </div>
                        <div class="form-group mb-0">
                            <label>Pesan</label>
                            <textarea class="form-control" name="pesan" required></textarea>
                        </div>
                    </div>
                    <div class="card-footer text-right">
                        <button class="btn btn-primary"> <i class="fas fa-location-arrow"></i> Kirim</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- /konten -->


</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->