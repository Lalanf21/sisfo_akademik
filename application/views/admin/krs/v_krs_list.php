<?php $nim = $this->session->userdata('nim') ?>
<?php $id_tahun = $this->session->userdata('id_tahun_akademik') ?>

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="alert alert-success" role="alert">
        <i class="fas fa-university"></i> Kartu Rencana Studi (KRS)
    </div>
    <a href="<?= site_url('refresh-krs') ?>" class="btn btn-secondary mb-2"> <i class="fas fa-home"></i> beranda</a>
    <?= $this->session->flashdata('pesan') ?>
    <!-- konten -->
    <!-- Earnings (Monthly) Card Example -->
    <div class="row">
        <div class="col-lg-12">
            <center>
                <legend>
                    <strong> KARTU RENCANA STUDI </strong>
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
                        
            <a href="<?=site_url('tambah-krs') ?>" class="btn btn-sm btn-primary mb-2"><i class="fas fa-plus"></i> Add KRS</a>
            <button class="btn btn-success btn-sm mb-2"><i class="fas fa-print"></i> Print</button>
            <table class="table table-hover table-striped my-3 text-center">
                <tr class="thead-dark text-uppercase">
                    <th>no</th>
                    <th>kode mata kuliah</th>
                    <th>nama mata kuliah</th>
                    <th>sks</th>
                    <th colspan="2">aksi</th>
                </tr>
                <?php if (empty($krsData)) :  ?>
                    <tr>
                        <td colspan="5"> TIDAK ADA DATA </td>
                    </tr>
                <?php else : ?>
                    <?php $i = 1 ?>
                    <?php $jumlahKrs = 0 ?>
                    <?php foreach ($krsData as $krs) : ?>
                        <?php $jumlahKrs += $krs->sks ?>
                        <tr>
                            <td> <?= $i++ ?> </td>
                            <td>
                                <?= $krs->kode_matakuliah ?>
                            </td>
                            <td>
                                <?= $krs->nama_matakuliah ?>
                            </td>
                            <td>
                                <?= $krs->sks ?>
                            </td>
                            <td width="50px">
                                <form action="<?= site_url('edit-krs') ?>" method="post">
                                    <input type="hidden" name="id" value="<?= $this->encryption->encrypt($krs->id_krs) ?>">
                                    <button class="btn btn-sm btn-primary">
                                        <i class="fas fa-edit text-white"></i>
                                    </button>
                                </form>
                            </td>
                            <td width="50px">
                                <form action="<?= site_url('hapus-krs') ?>" method="post">
                                    <input type="hidden" name="id" value="<?= $this->encryption->encrypt($krs->id_krs) ?>">
                                    <button onclick="return confirm('Anda yakin ?')" class="btn btn-sm btn-danger">
                                        <i class="fas fa-trash text-white"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        <?php endforeach ?>
                        <tr>
                            <td colspan="3" align="right">
                                <strong> Jumlah krs </strong>
                            </td>
                            <td colspan="3" align="left">
                                <strong> <?= $jumlahKrs ?> </strong>
                            </td>
                        </tr>
                <?php endif ?>
            </table>
        </div>
    </div>
    <!-- /konten -->


</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->