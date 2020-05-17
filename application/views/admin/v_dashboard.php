<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="alert alert-success" role="alert">
        <i class="fas fa-tachometer-alt"></i> Dashboard
    </div>

    <?= $this->session->flashdata('pesan') ?>

    <!-- konten -->
    <!-- Earnings (Monthly) Card Example -->
    <div class="row">
        <div class="col-lg-12">
            <div class="alert alert-info" role="alert">
                <h4 class="alert-heading">Selamat datang!</h4>
                <p>Selamat datang <strong> <?= $this->session->userdata('username') ?> </strong> di dashboard Sistem akademik Sekolah,Anda login sebagai <strong> <?= $this->session->userdata('level') ?> </strong>
                </p>
                <hr>
                <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#tool">
                    <i class="fas fa-cog"></i> Control Panel
                </button>
            </div>
        </div>
    </div>


    <!-- Modal -->
    <div class="modal fade" id="tool" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-cog"></i> Control Panel</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-3 text-info text-center">
                            <a href="#">
                                <p class="nav-link small text-info text-uppercase">Mahasiswa </p>
                                <i class="fas fa-user-graduate fa-3x text-info"></i>
                            </a>
                        </div>
                        <div class="col-md-3 text-info text-center">
                            <a href="#">
                                <p class="nav-link small text-info text-uppercase">Tahun Akademik </p>
                                <i class="fas fa-calendar-alt fa-3x text-info"></i>
                            </a>
                        </div>
                        <div class="col-md-3 text-info text-center">
                            <a href="#">
                                <p class="nav-link small text-info text-uppercase">KRS </p>
                                <i class="fas fa-edit fa-3x text-info"></i>
                            </a>
                        </div>
                        <div class="col-md-3 text-info text-center">
                            <a href="#">
                                <p class="nav-link small text-info text-uppercase">KHS </p>
                                <i class="fas fa-file-alt fa-3x text-info"></i>
                            </a>
                        </div>
                    </div>
                    <hr>
                    <div class="row mt-3">
                        <div class="col-md-3 text-info text-center">
                            <a href="#">
                                <p class="nav-link small text-info text-uppercase">input nilai </p>
                                <i class="fas fa-sort-numeric-down fa-3x text-info"></i>
                            </a>
                        </div>
                        <div class="col-md-3 text-info text-center">
                            <a href="#">
                                <p class="nav-link small text-info text-uppercase">cetak Transkrip </p>
                                <i class="fas fa-print fa-3x text-info"></i>
                            </a>
                        </div>
                        <div class="col-md-3 text-info text-center">
                            <a href="#">
                                <p class="nav-link small text-info text-uppercase">kategori </p>
                                <i class="fas fa-list-ul fa-3x text-info"></i>
                            </a>
                        </div>
                        <div class="col-md-3 text-info text-center">
                            <a href="#">
                                <p class="nav-link small text-info text-uppercase">info kampus </p>
                                <i class="fas fa-bullhorn fa-3x text-info"></i>
                            </a>
                        </div>
                    </div>
                    <hr>
                    <div class="row mt-3">
                        <div class="col-md-3 text-info text-center">
                            <a href="#">
                                <p class="nav-link small text-info text-uppercase">identitas </p>
                                <i class="fas fa-id-card-alt fa-3x text-info"></i>
                            </a>
                        </div>
                        <div class="col-md-3 text-info text-center">
                            <a href="#">
                                <p class="nav-link small text-info text-uppercase">tentang kampus </p>
                                <i class="fas fa-info-circle fa-3x text-info"></i>
                            </a>
                        </div>
                        <div class="col-md-3 text-info text-center">
                            <a href="#">
                                <p class="nav-link small text-info text-uppercase">fasilitas </p>
                                <i class="fas fa-laptop fa-3x text-info"></i>
                            </a>
                        </div>
                        <div class="col-md-3 text-info text-center">
                            <a href="#">
                                <p class="nav-link small text-info text-uppercase">galery </p>
                                <i class="fas fa-image fa-3x text-info"></i>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <!-- /konten -->


</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->