    <nav class="navbar text-white bg-primary">
        <a class="navbar-brand text-uppercase">
            <strong><?= $identitas->nama_kampus ?></strong>
        </a>
        `<span class="small">
            <?= $identitas->alamat . ' - ' . $identitas->telepon ?>
        </span>`
        <a href="<?=site_url('login') ?>" class="btn btn-success my-2 my-sm-0" type="submit">Login</a>
    </nav>

    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <button class="navbar-toggler ml-auto" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav mx-auto">
                <a class="nav-item nav-link ml-3" href="#">BERANDA <span class="sr-only">(current)</span></a>
                <li class="nav-item dropdown ml-3">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        INFORMASI KAMPUS
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <a class="dropdown-item" href="#">FASILITAS</a>
                        <a class="dropdown-item" href="#">GALERI</a>
                        <a class="dropdown-item" href="#">MATERI KULIAH</a>
                    </div>
                </li>
                <a class="nav-item nav-link ml-3" href="#">TENTANG KAMPUS</a>
                <a class="nav-item nav-link ml-3" href="#">KONTAK</a>
            </div>
        </div>
    </nav>
    <!-- akhir navbar -->

    <!-- carousel -->
    <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img class="d-block w-100" src="<?= base_url('assets/img/home_slider_1.jpg') ?>" alt="First slide">
            </div>
            <div class="carousel-item">
                <img class="d-block w-100" src="<?= base_url('assets/img/home_slider_1.jpg') ?>" alt="Second slide">
            </div>
            <div class="carousel-item">
                <img class="d-block w-100" src="<?= base_url('assets/img/home_slider_1.jpg') ?>" alt="Third slide">
            </div>
        </div>
        <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
    <!-- akhir carousel -->

    <!-- tentang kampus -->
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card text-center">
                    <div class="card-header text-uppercase">
                        <h3>Tentang kampus</h3>
                    </div>
                    <div class="card-body">
                        <?= word_limiter($tentang->sejarah, 50) ?>
                    </div>
                    <div class="card-footer text-muted">
                        <a href="" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#m<?= $tentang->id_tentang ?>">
                            Selengkapnya
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- akhir tentang kampus -->

    <!-- informasi -->
    <div class="container-fluid mt-3">
        <div class="row m-4">
            <?php foreach ($info as $key) : ?>
                <div class="card m-2" style="width: 18rem; min-height: 100px !important;">
                    <span class="display-2 text-center text-info"> <i class="<?= $key->icon ?>"></i> </span>
                    <div class="card-body">
                        <h5 class="card-title text-center"><?= $key->judul_informasi ?></h5>
                        <p class="card-text">
                            <?= $key->isi_informasi ?>
                        </p>
                    </div>
                </div>
            <?php endforeach ?>
        </div>
    </div>
    <!-- akhir informasi -->

    <!-- contact -->
    <div class="row justify-content-center">
        <div class="col-12 col-md-6 col-lg-6">
            <div class="card">
                <form method="POST" action="<?= site_url('kirim-pesan') ?>">
                    <?= $this->session->flashdata('pesan') ?>
                    <div class="card-header">
                        <h4>Contact Us</h4>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label>Nama</label>
                            <input type="text" name="nama" class="form-control">
                            <div class="text-danger small">
                                <?= form_error('nama') ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" name="email" class="form-control">
                            <div class="text-danger small">
                                <?= form_error('email') ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Subject</label>
                            <input type="text" name="subject" class="form-control">
                            <div class="text-danger small">
                                <?= form_error('subject') ?>
                            </div>
                        </div>
                        <div class="form-group mb-0">
                            <label>Pesan</label>
                            <textarea class="form-control" name="pesan"></textarea>
                            <div class="text-danger small">
                                <?= form_error('pesan') ?>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-right">
                        <button class="btn btn-primary"> <i class="fas fa-location-arrow"></i> Kirim</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- akhir contact -->





    <!-- modal tentang kampus -->
    <div class="modal fade" id="m<?= $tentang->id_tentang ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tentang Kampus</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body text-justify">
                    <strong>Sejarah Universitas Muhammadiyah Tangerang</strong>
                    <?= $tentang->sejarah ?> <br><br><br>

                    <strong>Visi Universitas Muhammadiyah Tangerang</strong>
                    <?= $tentang->visi ?> <br><br><br>

                    <strong>misi Universitas Muhammadiyah Tangerang</strong> <br>
                    <?= $tentang->misi ?> <br><br><br>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>
    <!-- akhir modal tentang kampus -->
    </div>
    <!-- End of Main Content -->