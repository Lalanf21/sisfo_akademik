<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="alert alert-success" role="alert">
        <i class="fas fa-university"></i> Kartu Rencana Studi (KRS)
    </div>
    <a href="<?= site_url('refresh-nilai') ?>" class="btn btn-secondary mb-2"> <i class="fas fa-home"></i> beranda</a>
    <?= $this->session->flashdata('pesan') ?>
    <!-- konten -->
    <!-- Earnings (Monthly) Card Example -->
    <div class="row">
        <div class="col-lg-12">
            <center>
                <legend>
                    <strong> DAFTAR NILAI MAHASISWA </strong>
                </legend>

                <table>
                    <tr>
                        <td>
                            <strong>Kode Mata kuliah</strong>
                        </td>
                        <td>:</td>
                        <td>
                            <?= $kode_mk ?>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <strong>Nama Mata kuliah (sks)</strong>
                        </td>
                        <td>:</td>
                        <td>
                            <?= $nama_mk.' ('.$sks.' SKS)' ?>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <strong>Tahun Akademik (semester)</strong>
                        </td>
                        <td>:</td>
                        <td>
                            <?= $tahun_akademik . ' ' . '(' . $semester . ')' ?>
                        </td>
                    </tr>
                </table>
            </center>

            <button class="btn btn-success btn-sm mb-2"><i class="fas fa-print"></i> Print</button>
                <table class="table table-hover table-striped my-3 text-center">
                    <tr class="thead-dark text-uppercase">
                        <th width="25px">no</th>
                        <th>nim</th>
                        <th>nama mahasiswa</th>
                        <th>nilai</th>
                    </tr>
                        <?php $i = 1 ?>
                        <?php foreach ($nilaiData as $nilai) : ?>
                            <tr>
                                <td> <?= $i++ ?> </td>
                                <td>
                                    <?= $nilai->nim ?>
                                </td>
                                <td>
                                    <?= $nilai->nama_lengkap ?>
                                </td>
                                <td>
                                    <?= $nilai->nilai ?>
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