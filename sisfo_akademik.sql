-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 17, 2020 at 01:16 PM
-- Server version: 5.7.24
-- PHP Version: 7.3.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sisfo_akademik`
--

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE `contact` (
  `id_contact` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `subject` varchar(100) NOT NULL,
  `email` varchar(70) NOT NULL,
  `pesan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `contact`
--

INSERT INTO `contact` (`id_contact`, `nama`, `subject`, `email`, `pesan`) VALUES
(1, 'Lalan fathurrahman', 'info masuk semster baru', 'lalan@gmail.com', 'saya mau tanya, kapan awal perkuliahan untuk mahasiswa baru'),
(2, 'test', 'asd', 'test@gmail.com', 'asd');

-- --------------------------------------------------------

--
-- Table structure for table `dosen`
--

CREATE TABLE `dosen` (
  `id_dosen` int(11) NOT NULL,
  `nidn` varchar(10) NOT NULL,
  `nama_dosen` varchar(50) NOT NULL,
  `alamat` text NOT NULL,
  `jenis_kelamin` enum('pria','wanita') NOT NULL,
  `email` varchar(25) NOT NULL,
  `telepon` varchar(12) NOT NULL,
  `foto` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `dosen`
--

INSERT INTO `dosen` (`id_dosen`, `nidn`, `nama_dosen`, `alamat`, `jenis_kelamin`, `email`, `telepon`, `foto`) VALUES
(2, '3212345687', 'Arif suyono', 'Sukabumi, jalan apa saja asal bagus dan benar ', 'pria', 'arif123@gmail.com', '08997654367', '63fc5d696a6d28baee715c4128ba578e.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `identitas`
--

CREATE TABLE `identitas` (
  `id_identitas` int(11) NOT NULL,
  `nama_kampus` varchar(50) NOT NULL,
  `alamat` varchar(50) NOT NULL,
  `email` varchar(30) NOT NULL,
  `telepon` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `identitas`
--

INSERT INTO `identitas` (`id_identitas`, `nama_kampus`, `alamat`, `email`, `telepon`) VALUES
(1, 'Universitas Muhammadiyah Tangerang', 'Jl.perintis kemerdekaan No 1, tangerang', 'Umt@gmail.ac.id', '0215567683');

-- --------------------------------------------------------

--
-- Table structure for table `informasi_kampus`
--

CREATE TABLE `informasi_kampus` (
  `id_informasi` int(11) NOT NULL,
  `icon` varchar(20) NOT NULL,
  `judul_informasi` varchar(50) NOT NULL,
  `isi_informasi` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `informasi_kampus`
--

INSERT INTO `informasi_kampus` (`id_informasi`, `icon`, `judul_informasi`, `isi_informasi`) VALUES
(1, 'fas fa-university', 'Penerimaan Mahasiswa baru', 'Penerimaan Mahasiswa baru gelombang 4 di buka mulai tanggal 31 juni - 31 agustus 2020\r\n                    '),
(2, 'fas fa-wallet', 'Pembayaran uang kuliah', '                        pembayaran uang kuliah mulai tanggal 01 juli - 30 agustus 2020\r\n\r\n                                        '),
(3, 'fas fa-user-graduate', 'jadwal wisuda', 'jadwal pelaksanaan wisuda gelombang 1 tanggal 31 agustus 2019     '),
(4, 'fas fa-file-invoice', 'bimbingan skripsi', 'bimbingan skripsi di mulai pada tanggal 21 mei 2020\r\n                    ');

-- --------------------------------------------------------

--
-- Table structure for table `jurusan`
--

CREATE TABLE `jurusan` (
  `id_jurusan` int(11) NOT NULL,
  `kode_jurusan` varchar(5) NOT NULL,
  `nama_jurusan` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jurusan`
--

INSERT INTO `jurusan` (`id_jurusan`, `kode_jurusan`, `nama_jurusan`) VALUES
(6, 'SI', 'Sistem Informasi'),
(7, 'TI', 'Teknik Informatika'),
(8, 'TK', 'Teknik Komputer');

-- --------------------------------------------------------

--
-- Table structure for table `krs`
--

CREATE TABLE `krs` (
  `id_krs` int(11) NOT NULL,
  `id_tahun_akademik` int(11) NOT NULL,
  `nim` varchar(10) NOT NULL,
  `kode_matakuliah` varchar(10) NOT NULL,
  `nilai` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `krs`
--

INSERT INTO `krs` (`id_krs`, `id_tahun_akademik`, `nim`, `kode_matakuliah`, `nilai`) VALUES
(1, 2, '1755201288', 'MK002', 'A'),
(2, 2, '1755201278', 'MK002', 'A'),
(6, 2, '1755201278', 'MK001', 'B'),
(7, 3, '1755201278', 'MK003', 'B');

-- --------------------------------------------------------

--
-- Table structure for table `mahasiswa`
--

CREATE TABLE `mahasiswa` (
  `id_mahasiswa` int(11) NOT NULL,
  `nim` varchar(10) NOT NULL,
  `nama_lengkap` varchar(50) NOT NULL,
  `alamat` varchar(80) NOT NULL,
  `email` varchar(50) NOT NULL,
  `telepon` varchar(13) NOT NULL,
  `tempat_lahir` varchar(30) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `jenis_kelamin` enum('pria','wanita') NOT NULL,
  `nama_prodi` varchar(25) NOT NULL,
  `photo` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mahasiswa`
--

INSERT INTO `mahasiswa` (`id_mahasiswa`, `nim`, `nama_lengkap`, `alamat`, `email`, `telepon`, `tempat_lahir`, `tanggal_lahir`, `jenis_kelamin`, `nama_prodi`, `photo`) VALUES
(6, '1755201288', 'Ririn ', 'asd', 'test@gmail.com', '1232', 'Jakarta', '2020-02-03', 'pria', 'Sistem Informasi', 'ecd3e6864c8e98ded8abefcf9e12194a.jpg'),
(7, '1755201278', 'Lalan fathurrahman', 'kp pisangan', 'lalan@gmail.com', '0899721262', 'Tangerang', '2020-01-21', 'pria', 'Teknik Informatika', 'cefd7d4cb8000260f29cdaebe04d3bd3.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `mata_kuliah`
--

CREATE TABLE `mata_kuliah` (
  `id_matakuliah` int(11) NOT NULL,
  `id_tahun_akademik` int(5) NOT NULL,
  `kode_matakuliah` varchar(10) NOT NULL,
  `nama_matakuliah` varchar(50) NOT NULL,
  `sks` int(5) NOT NULL,
  `nama_prodi` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mata_kuliah`
--

INSERT INTO `mata_kuliah` (`id_matakuliah`, `id_tahun_akademik`, `kode_matakuliah`, `nama_matakuliah`, `sks`, `nama_prodi`) VALUES
(3, 2, 'MK002', 'Pemrograman Java Dasar', 3, 'Teknik Informatika'),
(4, 2, 'MK001', 'Pemrograman web dasar', 3, 'Teknik Informatika'),
(7, 3, 'MK003', 'AIKA', 3, 'Teknik Informatika');

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE `menu` (
  `id_menu` int(11) NOT NULL,
  `nama_menu` varchar(50) NOT NULL,
  `icon` varchar(50) NOT NULL,
  `active` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`id_menu`, `nama_menu`, `icon`, `active`) VALUES
(1, 'Akademik', 'fas fa-fw fa-university', 1),
(2, 'Pengaturan', 'fas fa-fw fa-wrench', 1),
(3, 'Info Kampus', 'fas fa-fw fa-folder', 1);

-- --------------------------------------------------------

--
-- Table structure for table `prodi`
--

CREATE TABLE `prodi` (
  `id_prodi` int(11) NOT NULL,
  `kode_prodi` varchar(20) NOT NULL,
  `nama_prodi` varchar(25) NOT NULL,
  `nama_jurusan` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `prodi`
--

INSERT INTO `prodi` (`id_prodi`, `kode_prodi`, `nama_prodi`, `nama_jurusan`) VALUES
(5, 'SI', 'Sistem Informasi', 'Teknik Komputer'),
(6, 'TI', 'Teknik Informatika', 'Sistem Informasi');

-- --------------------------------------------------------

--
-- Table structure for table `sub_menu`
--

CREATE TABLE `sub_menu` (
  `id_sub_menu` int(11) NOT NULL,
  `id_menu` int(11) NOT NULL,
  `nama_submenu` varchar(50) NOT NULL,
  `url` varchar(100) NOT NULL,
  `controller` varchar(50) NOT NULL,
  `active` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sub_menu`
--

INSERT INTO `sub_menu` (`id_sub_menu`, `id_menu`, `nama_submenu`, `url`, `controller`, `active`) VALUES
(1, 1, 'jurusan', 'jurusan', 'jurusan', 1),
(2, 1, 'Program Studi', 'program_studi', 'program_studi', 1),
(3, 2, 'Menu', 'menu', 'menu', 1),
(4, 2, 'user', 'user', 'user', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tahun_akademik`
--

CREATE TABLE `tahun_akademik` (
  `id_tahun_akademik` int(11) NOT NULL,
  `tahun_akademik` varchar(20) NOT NULL,
  `semester` varchar(10) NOT NULL,
  `status` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tahun_akademik`
--

INSERT INTO `tahun_akademik` (`id_tahun_akademik`, `tahun_akademik`, `semester`, `status`) VALUES
(2, '2019/2020', 'Genap', 'Aktif'),
(3, '2019/2020', 'Ganjil', 'Aktif');

-- --------------------------------------------------------

--
-- Table structure for table `tentang_kampus`
--

CREATE TABLE `tentang_kampus` (
  `id_tentang` int(11) NOT NULL,
  `sejarah` text NOT NULL,
  `visi` text NOT NULL,
  `misi` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tentang_kampus`
--

INSERT INTO `tentang_kampus` (`id_tentang`, `sejarah`, `visi`, `misi`) VALUES
(1, '                                        Pada tanggal 1 Juni 1993 STIE Muhammadiyah Tangerang didirikan yang merupakan salah satu amal usaha milik Persyarikatan Muhammadiyah di bawah naungan Majelis Pendidikan Tinggi Penelitian dan Pengembangan (DIKTILITBANG) Muhammadiyah berdasarkan Surat Keputusan Pimpinan Wilayah Muhammadiyah DKI Jakarta No.1.A/SK/B/1992 tertanggal 10 November 1992.\r\n\r\nSeiring berjalanya waktu, menyusul pula berdirinya STAI Muhammadiyah Tangerang tahun 2000, kemudian berdiri pula STIKES Muhammadiyah Tangerang tahun 2004. Ketiga amal usaha Muhammadiyah tersebut di bawah naungan dan milik Pimpinan Daerah Muhammadiyah Kota Tangerang.\r\n\r\nDengan meleburnya tiga sekolah tinggi yang akhirnya menjadi Universitas Muhammadiyah Tangerang menjadikan semangat para founding father agar Universitas Muhammadiyah Tangerang mampu sejajar dengan PTM lainya di sekitar JABODETABEK dan Banten khususnya.\r\n\r\nUniversitas Muhammadiyah Tangerang merupakan PTM terbesar dengan jumlah mahasiswa terbanyak di Provinsi Banten, selain itu agar terus menjaga kepercayaan masyarakat Universitas Muhammadiyah Tangerang pada Tahun 2015 telah menyandang Akreditasi Institusi Perguruan Tinggi (AIPT) “B” Badan Akreditasi Nasional Perguruan Tinggi (BAN-PT) hingga tahun 2020. Kami secara konsisten terus meningkatkan kualitas dalam proses belajar mengajar dan KeMuhammadiyahan di kampus Universitas Muhammadiyah Tangerang hal ini kami buktikan dengan terus melakukan pengembangan kampus pada tahun 2012 telah berdiri gedung perkuliahan 5 lantai, lalu di susul pada tahun 2013 gedung perkuliahan 12 lantai. Terus meningkatnya kepercayaan masyarakat terhadap Universitas Muhamamdiyah Tangerang dengan meningkatnya pendaftar mahasiswa baru setiap tahunya mendorongkami untuk menambah sarana gedung perkuliahan yang baru, lalu pada tahun 2018 Universitas Muhammadiyah Tangerang mulai melakukan pembangunan gedung perkuliahan 19 lantai di samping gedung perkuliahan 12 lantai selain untuk sarana perkuliahan gedung 19 lantai akan menjadi simbol (icon) Muhammadiyah di Provinsi Banten yang akan diberi nama Gedung 1912 sesuai dengan tahun lahirnya Muhammadiyah.\r\n\r\nMasuknya Era Masyarakat Ekonomi ASEAN (MEA) dan Era Globalisasi saat ini menjadikan kami harus mampu bertahan dan berdaya saing dalam menciptakan lulusan yang mampu sesuai dengan kebutuhan, Universitas Muhammadiyah Tangerang terus beradaptasi dengan kebutuhan pasar dalam menciptakan lulusan dengan berinovasi di zaman yang tidak menentu seperti saat ini, Universitas Muhammadiyah Tangerang pada tahun akademik 2019/2020 akan melaksanakan program perkuliahan dengan sistem Blended Learning guna menjawab kebutuhan masyarakat di berbagai peloksok daerah, hal ini kami sadari bahwa Universitas Muhammadiyah Tangerang ingin semua anak bangsa mampu menjadi sarjana dengan berkuliah tanpa ada hambatan fisik dan jarak dan mampu bersaing di Era MEA da Era Globalisasi.                                ', '                                        Menjadi Universitas Unggul dan Islami dalam Pengembangan IPTEKS.                                ', '                                        1. Menyelenggarakan pendidikan yang bermutu.\r\n\r\n2. Menyelenggarakan penelitian dan pengembangan ilmu pengetahuan serta pengabdian masyarakat yang dapat meningkatkan kesejahteraan manusia.\r\n\r\n3. Menyelenggarakan kerja sama dengan pihak lain yang saling menguntungkan dalam pengembangan IPTEKS.\r\n\r\n4. Mengembangkan kehidupan islami menurut pemahaman Muhammadiyah.\r\n                                ');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `level` enum('admin','user') NOT NULL,
  `blokir` enum('N','Y') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `username`, `password`, `email`, `level`, `blokir`) VALUES
(2, 'admin', '$2y$10$NNKwEMRil4DMOwajuhykyOCuVS.PtVBk.vSs9MIK0T7AZo2.gNtsm', 'test@gmail.com', 'admin', 'N'),
(4, 'user', '$2y$10$DkW/Aj77TIjLahbG3N8OGOJ.GfDneGLpj1RjyKFccVrLBlJ9yYDQy', 'user@gmail.com', 'user', 'N');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`id_contact`);

--
-- Indexes for table `dosen`
--
ALTER TABLE `dosen`
  ADD PRIMARY KEY (`id_dosen`);

--
-- Indexes for table `identitas`
--
ALTER TABLE `identitas`
  ADD PRIMARY KEY (`id_identitas`);

--
-- Indexes for table `informasi_kampus`
--
ALTER TABLE `informasi_kampus`
  ADD PRIMARY KEY (`id_informasi`);

--
-- Indexes for table `jurusan`
--
ALTER TABLE `jurusan`
  ADD PRIMARY KEY (`id_jurusan`);

--
-- Indexes for table `krs`
--
ALTER TABLE `krs`
  ADD PRIMARY KEY (`id_krs`);

--
-- Indexes for table `mahasiswa`
--
ALTER TABLE `mahasiswa`
  ADD PRIMARY KEY (`id_mahasiswa`);

--
-- Indexes for table `mata_kuliah`
--
ALTER TABLE `mata_kuliah`
  ADD PRIMARY KEY (`id_matakuliah`);

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id_menu`);

--
-- Indexes for table `prodi`
--
ALTER TABLE `prodi`
  ADD PRIMARY KEY (`id_prodi`);

--
-- Indexes for table `sub_menu`
--
ALTER TABLE `sub_menu`
  ADD PRIMARY KEY (`id_sub_menu`);

--
-- Indexes for table `tahun_akademik`
--
ALTER TABLE `tahun_akademik`
  ADD PRIMARY KEY (`id_tahun_akademik`);

--
-- Indexes for table `tentang_kampus`
--
ALTER TABLE `tentang_kampus`
  ADD PRIMARY KEY (`id_tentang`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `contact`
--
ALTER TABLE `contact`
  MODIFY `id_contact` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `dosen`
--
ALTER TABLE `dosen`
  MODIFY `id_dosen` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `identitas`
--
ALTER TABLE `identitas`
  MODIFY `id_identitas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `informasi_kampus`
--
ALTER TABLE `informasi_kampus`
  MODIFY `id_informasi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `jurusan`
--
ALTER TABLE `jurusan`
  MODIFY `id_jurusan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `krs`
--
ALTER TABLE `krs`
  MODIFY `id_krs` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `mahasiswa`
--
ALTER TABLE `mahasiswa`
  MODIFY `id_mahasiswa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `mata_kuliah`
--
ALTER TABLE `mata_kuliah`
  MODIFY `id_matakuliah` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `id_menu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `prodi`
--
ALTER TABLE `prodi`
  MODIFY `id_prodi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `sub_menu`
--
ALTER TABLE `sub_menu`
  MODIFY `id_sub_menu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tahun_akademik`
--
ALTER TABLE `tahun_akademik`
  MODIFY `id_tahun_akademik` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tentang_kampus`
--
ALTER TABLE `tentang_kampus`
  MODIFY `id_tentang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
