<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="alert alert-success" role="alert">
        <i class="fas fa-university"></i> Kartu Rencana Studi (KRS)
    </div>
    <a href="<?= site_url('refresh-khs') ?>" class="btn btn-secondary mb-2"> <i class="fas fa-home"></i> beranda</a>
    <?= $this->session->flashdata('pesan') ?>
    <!-- konten -->
    <!-- Earnings (Monthly) Card Example -->
    <div class="row">
        <div class="col-lg-12">
            <center>
                <legend>
                    <strong> KARTU HASIL STUDI </strong>
                </legend>

                <table>
                    <tr>
                        <td>
                            <strong>NIM</strong>
                        </td>
                        <td>:</td>
                        <td>
                            <?= $nim ?>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <strong>Nama Lengkap</strong>
                        </td>
                        <td>:</td>
                        <td>
                            <?= $nama_lengkap ?>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <strong>Nama Program Studi</strong>
                        </td>
                        <td>:</td>
                        <td>
                            <?= $prodi ?>
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
                    <th>no</th>
                    <th>kode mata kuliah</th>
                    <th>nama mata kuliah</th>
                    <th>sks</th>
                    <th>nilai</th>
                    <th>skor</th>
                </tr>
                <?php if (empty($khsData)) : ?>
                    <?php 
                    $this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong> Nilai pada semester ini belum ada !!</strong>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>');
                    redirect('khs');
                    ?>
                <?php else : ?>
                    <?php $i = 1 ?>
                    <?php $jumlahSks = 0 ?>
                    <?php $jumlahNilai = 0 ?>
                    <?php foreach ($khsData as $khs) : ?>
                        <?php $jumlahSks += $khs->sks ?>
                        <?php $jumlahNilai += skor($khs->nilai, $khs->sks) ?>
                        <tr>
                            <td> <?= $i++ ?> </td>
                            <td>
                                <?= $khs->kode_matakuliah ?>
                            </td>
                            <td>
                                <?= $khs->nama_matakuliah ?>
                            </td>
                            <td>
                                <?= $khs->sks ?>
                            </td>
                            <td>
                                <?= $khs->nilai ?>
                            </td>
                            <td>
                                <?= skor($khs->nilai, $khs->sks) ?>
                            </td>
                        </tr>
                    <?php endforeach ?>
                    <tr>
                        <td colspan="3" align="right">
                            <strong> Jumlah</strong>
                        </td>
                        <td>
                            <strong> <?= $jumlahSks ?> </strong>
                        </td>
                        <td></td>
                        <td>
                            <strong> <?= $jumlahNilai ?> </strong>
                        </td>
                    </tr>
                <?php endif ?>
            </table>
            <p>Indeks Prestasi : <?= number_format($jumlahNilai / $jumlahSks, 2) ?> </p>
        </div>
    </div>
    <!-- /konten -->


</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->