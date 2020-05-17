<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="alert alert-success text-uppercase" role="alert">
        <i class="fas fa-university"></i> Transkrip nilai
    </div>
    <a href="<?= site_url('refresh-transkrip') ?>" class="btn btn-secondary mb-2"> <i class="fas fa-home"></i> beranda</a>
    <?= $this->session->flashdata('pesan') ?>
    <!-- konten -->
    <!-- Earnings (Monthly) Card Example -->
    <div class="row">
        <div class="col-lg-12">
            <center>
                <legend>
                    <strong> TRANSKRIP NILAI </strong>
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
                <?php if (empty($nilaiData)) : ?>
                    <tr>
                        <td colspan="6"> TIDAK ADA DATA </td>
                    </tr>
                <?php else : ?>
                    <?php $i = 1 ?>
                    <?php $jumlahSks = 0 ?>
                    <?php $jumlahNilai = 0 ?>
                    <?php foreach ($nilaiData as $trankrip) : ?>
                        <?php $jumlahSks += $trankrip->sks ?>
                        <?php $jumlahNilai += skor($trankrip->nilai, $trankrip->sks) ?>
                        <tr>
                            <td> <?= $i++ ?> </td>
                            <td>
                                <?= $trankrip->kode_matakuliah ?>
                            </td>
                            <td>
                                <?= $trankrip->nama_matakuliah ?>
                            </td>
                            <td>
                                <?= $trankrip->sks ?>
                            </td>
                            <td>
                                <?= $trankrip->nilai ?>
                            </td>
                            <td>
                                <?= skor($trankrip->nilai, $trankrip->sks) ?>
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