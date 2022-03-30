-- phpMyAdmin SQL Dump
-- version 4.3.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 28 Nov 2017 pada 15.46
-- Versi Server: 5.6.24
-- PHP Version: 5.5.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `dewisrii`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `id_admin` int(11) NOT NULL,
  `namaA` varchar(20) NOT NULL,
  `emailA` varchar(30) NOT NULL,
  `noHpA` varchar(12) NOT NULL,
  `password` varchar(20) NOT NULL,
  `jenisKelaminA` varchar(20) NOT NULL,
  `status` varchar(50) NOT NULL,
  `level` enum('1','2') DEFAULT '2' COMMENT '1 superadmin 2 admin'
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `admin`
--

INSERT INTO `admin` (`id_admin`, `namaA`, `emailA`, `noHpA`, `password`, `jenisKelaminA`, `status`, `level`) VALUES
(1, 'ulya', 'ulya@gmail.com', '08214748367', 'ulya', 'Perempuan', 'Aktif', '2'),
(2, 'cantik', 'cantik@gmail.com', '2147483647', 'cantik', 'Perempuan', 'Aktif', '2'),
(5, 'Super Admin', 'admin@admin.com', '08947483647', 'admin', 'Laki-laki', 'Aktif', '1'),
(6, 'ganteng', 'ganteng@gmail.com', '987654566', 'ganteng', 'Laki-laki', 'Tidak Aktif', '2');

-- --------------------------------------------------------

--
-- Struktur dari tabel `artikel`
--

CREATE TABLE IF NOT EXISTS `artikel` (
  `id_artikel` int(11) NOT NULL,
  `id_admin` int(11) NOT NULL,
  `judulArtikel` varchar(50) NOT NULL,
  `isi` text NOT NULL,
  `keyword` varchar(20) NOT NULL,
  `deskripsi` varchar(100) NOT NULL,
  `tanggalArtikel` date NOT NULL,
  `id_kategoriArtikel` int(11) NOT NULL,
  `status` varchar(50) NOT NULL,
  `urlArtikel` varchar(30) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `artikel`
--

INSERT INTO `artikel` (`id_artikel`, `id_admin`, `judulArtikel`, `isi`, `keyword`, `deskripsi`, `tanggalArtikel`, `id_kategoriArtikel`, `status`, `urlArtikel`) VALUES
(7, 1, 'Promo besar besaran', 'Berhubung topik kali ini berhubungan dengan Hacker, jadi halonya buat Hacker aja ya :D. Topik kali ini cukup menarik nih buat kalian yang jago ngeretas, menarik gimana sih ? gini sob, Grab layanan ojek dan taksi online yang terkenal di Indonesia dan mungkin di negara lain ini lagi kasih tantangan buat para Hacker yang bisa menemukan celah keamanan yang valid dan imbasnya kalo sampe kena retas, hadiahnya gak main - main lho sob, sekitar USD 100 sampai 10.000 mantab kan?\r\n\r\nSaya ngutip dari laman Merdeka, kata mas Ditesh Kumar selaku Director of Engineering Grab begini "Sistem pengukuran keamanan yang canggih dan menyeluruh, seperti yang tersedia melalui platform HackerOne, merupakan elemen vital yang dibutuhkan untuk meraih kepercayaan para penumpang dan mitra pengemudi kami,"', 'promo,charming promo', 'promo murah banget dah kuy', '2017-05-06', 1, 'Publish', 'promo-besar-besaran'),
(10, 1, 'Jadwal Pengiriman', 'bagi anda member untuk wilayah Daerah Istimewa Yogyakarta dan Jawa Tengah, pengiriman akan dilakukan setiap hari senin-jumat pada jam kerja', 'sad,asd,asd', 'jadwal', '2017-08-31', 2, 'Publish', 'jadwal'),
(11, 5, 'Bagaimana Cara Memesan?', 'daftar terlebih dahulu untuk dapat memesan produk\r\nkemudian login dengan username dan password yang telah terdaftar\r\nmember baru hanya dapat memesan produk pertama yaitu 30 bungkus dan 12 bungkus selanjutnya\r\nmember melakukan konfirmasi pembayaran setelah proses checkout\r\nbarang dapat diretur ketika transaksi telah selesai, dengan syarat barang rusak atau tidak laku dijual', 'cara,pesan,retur', 'Cara Memesan', '2017-08-31', 2, 'Publish', 'cara');

-- --------------------------------------------------------

--
-- Struktur dari tabel `barang`
--

CREATE TABLE IF NOT EXISTS `barang` (
  `id_barang` int(11) NOT NULL,
  `id_kategori` int(11) NOT NULL,
  `id_admin` int(11) NOT NULL,
  `namaBarang` varchar(50) NOT NULL,
  `deskripsi` varchar(100) NOT NULL,
  `gambar` varchar(50) NOT NULL,
  `berat` int(11) DEFAULT NULL,
  `stok` enum('1','0') NOT NULL DEFAULT '1',
  `harga` int(11) NOT NULL,
  `status` varchar(50) NOT NULL,
  `urlBarang` varchar(30) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `barang`
--

INSERT INTO `barang` (`id_barang`, `id_kategori`, `id_admin`, `namaBarang`, `deskripsi`, `gambar`, `berat`, `stok`, `harga`, `status`, `urlBarang`) VALUES
(6, 1, 1, 'Nangka', 'Kue potong terbuat dari adonan tepung terigu yang diisi dengan gula merah dengan rasa bintang 5', 'Images-2017-11-08-01-13-31.png', 1, '1', 0, 'publish', 'kuepotong'),
(14, 1, 1, 'Durian', 'ena', 'Images-2017-11-08-01-13-18.png', 1, '1', 0, 'publish', 'kuepotong'),
(16, 1, 1, 'Nanas', 'ena', 'Images-2017-11-08-01-13-01.png', 1, '1', 0, 'publish', 'kuepotong'),
(18, 1, 1, 'Coklat', 'ena', 'Images-2017-11-08-01-12-42.png', 1, '1', 0, 'publish', 'kuepotong'),
(20, 4, 1, 'Nangka', 'Nopia terbuat dari adonan tepung terigu yang diisi dengan gula merah dengan rasa bintang 5 ', 'Images-2017-11-08-01-11-17.png', 1, '1', 0, 'publish', 'nopia'),
(21, 4, 1, 'Durian', 'maknyus', 'Images-2017-11-08-01-11-44.png', 1, '1', 0, 'publish', 'nopia'),
(22, 4, 1, 'Nanas', 'maknyus', 'Images-2017-11-08-01-12-06.png', 1, '1', 0, 'publish', 'nopia'),
(23, 4, 1, 'Coklat', 'maknyus', 'Images-2017-11-08-01-12-26.png', 1, '1', 0, 'publish', 'nopia');

-- --------------------------------------------------------

--
-- Struktur dari tabel `detailtransaksipenjualan`
--

CREATE TABLE IF NOT EXISTS `detailtransaksipenjualan` (
  `id_detail` int(11) NOT NULL,
  `id_transaksi` int(11) NOT NULL,
  `id_barang` int(11) NOT NULL,
  `berat_satuan` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=89 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `detailtransaksipenjualan`
--

INSERT INTO `detailtransaksipenjualan` (`id_detail`, `id_transaksi`, `id_barang`, `berat_satuan`) VALUES
(82, 116, 16, 30),
(83, 117, 23, 35),
(84, 118, 20, 12),
(85, 119, 18, 15),
(86, 119, 21, 15),
(87, 120, 16, 12),
(88, 120, 14, 1000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `kategoriartikel`
--

CREATE TABLE IF NOT EXISTS `kategoriartikel` (
  `id_kategoriArtikel` int(11) NOT NULL,
  `namaKa` varchar(20) NOT NULL,
  `url` varchar(30) NOT NULL,
  `status` varchar(50) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `kategoriartikel`
--

INSERT INTO `kategoriartikel` (`id_kategoriArtikel`, `namaKa`, `url`, `status`) VALUES
(1, 'Promo', 'promo', 'Publish'),
(2, 'Pengumuman', 'pengumuman', 'Publish');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kategoribarang`
--

CREATE TABLE IF NOT EXISTS `kategoribarang` (
  `id_kategori` int(11) NOT NULL,
  `namaKb` varchar(30) NOT NULL,
  `hargakg` int(11) NOT NULL,
  `url` varchar(30) NOT NULL,
  `statusKb` varchar(50) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `kategoribarang`
--

INSERT INTO `kategoribarang` (`id_kategori`, `namaKb`, `hargakg`, `url`, `statusKb`) VALUES
(1, 'Kue Potong', 12000, 'kuepotong', 'Publish'),
(4, 'Nopia', 12000, 'nopia', 'Publish');

-- --------------------------------------------------------

--
-- Struktur dari tabel `konfirmasipembayaran`
--

CREATE TABLE IF NOT EXISTS `konfirmasipembayaran` (
  `id_konfirmasi` int(11) NOT NULL,
  `id_rekening` int(11) NOT NULL,
  `id_admin` int(11) NOT NULL,
  `id_member` int(11) NOT NULL,
  `namaPengirim` varchar(20) NOT NULL,
  `kode_unik` int(30) DEFAULT NULL,
  `jumlahTransfer` int(11) NOT NULL,
  `tanggalKonfirmasi` date NOT NULL,
  `statusKonf` varchar(50) NOT NULL,
  `lampiran` varchar(50) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `konfirmasipembayaran`
--

INSERT INTO `konfirmasipembayaran` (`id_konfirmasi`, `id_rekening`, `id_admin`, `id_member`, `namaPengirim`, `kode_unik`, `jumlahTransfer`, `tanggalKonfirmasi`, `statusKonf`, `lampiran`) VALUES
(28, 4, 1, 5, 'ridho', 531, 360531, '2017-11-11', 'Disetujui', 'Images-2017-11-11-15-49-33.png'),
(29, 3, 0, 2, 'Babas', 762, 420762, '2017-11-12', 'Disetujui', 'Images-2017-11-11-15-50-31.png'),
(30, 3, 0, 2, 'babas', 100, 144100, '2017-11-22', 'Disetujui', 'Images-2017-11-21-16-43-13.png'),
(31, 4, 0, 6, 'Yudhi', 188, 360188, '2017-11-22', 'Menunggu', 'Images-2017-11-21-17-55-03.png');

-- --------------------------------------------------------

--
-- Struktur dari tabel `member`
--

CREATE TABLE IF NOT EXISTS `member` (
  `id_member` int(11) NOT NULL,
  `nama` varchar(20) NOT NULL,
  `namaToko` varchar(30) NOT NULL,
  `NIK` int(30) NOT NULL,
  `email` varchar(30) NOT NULL,
  `jenisKelamin` varchar(10) NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `noHp` varchar(12) NOT NULL,
  `Provinsi` varchar(20) NOT NULL,
  `Kota` varchar(20) NOT NULL,
  `password` varchar(50) NOT NULL,
  `statusMember` varchar(50) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `member`
--

INSERT INTO `member` (`id_member`, `nama`, `namaToko`, `NIK`, `email`, `jenisKelamin`, `alamat`, `noHp`, `Provinsi`, `Kota`, `password`, `statusMember`) VALUES
(1, 'nid', 'Varokah', 1234567890, 'nid@gmail.com', 'Perempuan', 'Depok Sleman Yogyakarta Jawa Tengah', '123456789177', 'DIY', 'Yogyakarta', '11', 'Aktif'),
(2, 'Basuki', 'Kembang Rejo', 2147483647, 'basuki@gmail.com', 'Laki-laki', 'Purworjo Jawa Tengah', '087762772622', 'Jawa Tengah', 'Purworjo', 'basuki', 'Aktif'),
(5, 'Ridho', 'Slendang Jaya', 2147483647, 'ridho@gmail.com', 'Laki-laki', 'Panca Arga Magelang', '098876656459', 'Jawa Tengah', 'Magelang', 'ridho', 'Aktif'),
(6, 'Yudhi', 'sekar kembag', 2147483647, 'yudhi@gmail.com', 'Laki-laki', 'Tembalang Undip Diponegoro Semarang Jawa Tengah', '089328287367', 'Jawa Tengah', 'Semarang', 'yudhi', 'Aktif');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengaturan`
--

CREATE TABLE IF NOT EXISTS `pengaturan` (
  `id_pengaturan` int(11) NOT NULL,
  `namaWebsite` varchar(20) NOT NULL,
  `deskripsi` varchar(100) NOT NULL,
  `keyword` varchar(30) NOT NULL,
  `noHp` varchar(12) NOT NULL,
  `instagram` varchar(50) NOT NULL,
  `line` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `hari_kerja` varchar(50) NOT NULL,
  `sabtu` varchar(50) NOT NULL,
  `minggu` varchar(50) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `pengaturan`
--

INSERT INTO `pengaturan` (`id_pengaturan`, `namaWebsite`, `deskripsi`, `keyword`, `noHp`, `instagram`, `line`, `email`, `alamat`, `hari_kerja`, `sabtu`, `minggu`) VALUES
(1, 'Dewi Sri', 'Kue Nopia dan Potong spesial khas Purwokerto', 'Dewi Sri', '082242407644', '@dewisri', 'dewisri', 'dewisri@gmail.com', 'Seneng Banyurojo Mertoyudan Magelang', '09.00-17.00', '09.00-14.00', 'Libur');

-- --------------------------------------------------------

--
-- Struktur dari tabel `rekeningbank`
--

CREATE TABLE IF NOT EXISTS `rekeningbank` (
  `id_rekening` int(11) NOT NULL,
  `namaRekening` varchar(20) NOT NULL,
  `bankRekening` varchar(20) NOT NULL,
  `noRekening` int(30) NOT NULL,
  `status` varchar(50) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `rekeningbank`
--

INSERT INTO `rekeningbank` (`id_rekening`, `namaRekening`, `bankRekening`, `noRekening`, `status`) VALUES
(3, 'Trisna', 'BCA', 2147483647, ''),
(4, 'Eddy', 'BRI', 2147483647, '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `retur`
--

CREATE TABLE IF NOT EXISTS `retur` (
  `id_retur` int(11) NOT NULL,
  `id_member` int(11) DEFAULT NULL,
  `tgl_retur` date DEFAULT NULL,
  `status_retur` enum('disetujui','ditolak','menunggu') DEFAULT NULL,
  `kode_unik` int(30) DEFAULT NULL,
  `id_barang` int(11) DEFAULT NULL,
  `id_transaksi` int(11) DEFAULT NULL,
  `jumlah` int(11) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `retur`
--

INSERT INTO `retur` (`id_retur`, `id_member`, `tgl_retur`, `status_retur`, `kode_unik`, `id_barang`, `id_transaksi`, `jumlah`) VALUES
(18, 5, '2017-11-11', 'disetujui', 531, 16, 116, 3),
(19, 2, '2017-11-11', 'disetujui', 762, 23, 117, 10),
(20, 2, '2017-11-21', 'menunggu', 100, 20, 118, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `slider`
--

CREATE TABLE IF NOT EXISTS `slider` (
  `id_slider` int(11) NOT NULL,
  `judul` varchar(50) DEFAULT NULL,
  `gambar` varchar(50) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=48 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `slider`
--

INSERT INTO `slider` (`id_slider`, `judul`, `gambar`) VALUES
(45, NULL, 'yipi.png'),
(47, NULL, 'yash.png');

-- --------------------------------------------------------

--
-- Struktur dari tabel `testimoni`
--

CREATE TABLE IF NOT EXISTS `testimoni` (
  `id_testimoni` int(11) NOT NULL,
  `id_admin` int(11) NOT NULL,
  `id_member` int(11) NOT NULL,
  `tanggalTestimoni` date NOT NULL,
  `isi` varchar(100) NOT NULL,
  `status` varchar(50) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `testimoni`
--

INSERT INTO `testimoni` (`id_testimoni`, `id_admin`, `id_member`, `tanggalTestimoni`, `isi`, `status`) VALUES
(1, 2, 1, '2017-05-04', 'mantab', 'Ditampilkan'),
(3, 0, 2, '2017-08-31', 'terpercaya', 'Ditampilkan'),
(4, 2, 2, '2017-08-31', 'hebat', 'Ditampilkan'),
(5, 5, 2, '2017-08-31', 'kualitas oke', 'Ditampilkan'),
(10, 0, 4, '2017-09-05', 'meneh ah', 'Menunggu'),
(11, 0, 3, '2017-11-01', 'Mantab Lur', 'Menunggu');

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaksipenjualan`
--

CREATE TABLE IF NOT EXISTS `transaksipenjualan` (
  `id_transaksi` int(11) NOT NULL,
  `id_member` int(11) NOT NULL,
  `id_admin` int(11) DEFAULT NULL,
  `kode_unik` int(30) DEFAULT NULL,
  `tanggalTransaksi` datetime NOT NULL,
  `totalBayar` int(11) NOT NULL,
  `nama_tujuan` varchar(30) DEFAULT NULL,
  `status` enum('Diproses','Ditolak','Menunggu','Konfirmasi','Selesai') NOT NULL,
  `alamat_tujuan` text NOT NULL,
  `notelp_tujuan` varchar(12) NOT NULL,
  `berat` int(11) DEFAULT NULL,
  `jenis_kirim` varchar(20) DEFAULT NULL,
  `kirim_ke` varchar(20) DEFAULT NULL,
  `status_retur` enum('1','0') DEFAULT '1'
) ENGINE=InnoDB AUTO_INCREMENT=121 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `transaksipenjualan`
--

INSERT INTO `transaksipenjualan` (`id_transaksi`, `id_member`, `id_admin`, `kode_unik`, `tanggalTransaksi`, `totalBayar`, `nama_tujuan`, `status`, `alamat_tujuan`, `notelp_tujuan`, `berat`, `jenis_kirim`, `kirim_ke`, `status_retur`) VALUES
(116, 5, 0, 531, '2017-11-11 15:49:09', 252000, '', 'Selesai', '', '', 27, '2', '1', '0'),
(117, 2, 0, 762, '2017-11-11 15:50:05', 180000, '', 'Selesai', '', '', 25, '1', '', '0'),
(118, 2, 0, 100, '2017-11-12 21:17:20', 144000, '', 'Selesai', '', '', 12, '1', '', '1'),
(119, 6, 0, 188, '2017-11-21 17:52:14', 360000, '', 'Menunggu', '', '', 30, '2', '1', '1'),
(120, 6, 0, 889, '2017-11-22 11:07:31', 12144000, '', 'Menunggu', '', '', 1012, '2', '1', '1');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indexes for table `artikel`
--
ALTER TABLE `artikel`
  ADD PRIMARY KEY (`id_artikel`), ADD KEY `id_admin` (`id_admin`), ADD KEY `id_kategoriArtikel` (`id_kategoriArtikel`);

--
-- Indexes for table `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`id_barang`), ADD KEY `id_kategori` (`id_kategori`), ADD KEY `id_admin` (`id_admin`);

--
-- Indexes for table `detailtransaksipenjualan`
--
ALTER TABLE `detailtransaksipenjualan`
  ADD PRIMARY KEY (`id_detail`), ADD KEY `id_transaksi` (`id_transaksi`), ADD KEY `id_barang` (`id_barang`);

--
-- Indexes for table `kategoriartikel`
--
ALTER TABLE `kategoriartikel`
  ADD PRIMARY KEY (`id_kategoriArtikel`);

--
-- Indexes for table `kategoribarang`
--
ALTER TABLE `kategoribarang`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indexes for table `konfirmasipembayaran`
--
ALTER TABLE `konfirmasipembayaran`
  ADD PRIMARY KEY (`id_konfirmasi`), ADD KEY `id_rekening` (`id_rekening`), ADD KEY `id_member` (`id_admin`);

--
-- Indexes for table `member`
--
ALTER TABLE `member`
  ADD PRIMARY KEY (`id_member`);

--
-- Indexes for table `pengaturan`
--
ALTER TABLE `pengaturan`
  ADD PRIMARY KEY (`id_pengaturan`);

--
-- Indexes for table `rekeningbank`
--
ALTER TABLE `rekeningbank`
  ADD PRIMARY KEY (`id_rekening`);

--
-- Indexes for table `retur`
--
ALTER TABLE `retur`
  ADD PRIMARY KEY (`id_retur`);

--
-- Indexes for table `slider`
--
ALTER TABLE `slider`
  ADD PRIMARY KEY (`id_slider`);

--
-- Indexes for table `testimoni`
--
ALTER TABLE `testimoni`
  ADD PRIMARY KEY (`id_testimoni`), ADD KEY `id_admin` (`id_admin`), ADD KEY `id_member` (`id_member`);

--
-- Indexes for table `transaksipenjualan`
--
ALTER TABLE `transaksipenjualan`
  ADD PRIMARY KEY (`id_transaksi`), ADD KEY `id_member` (`id_member`), ADD KEY `id_admin` (`id_admin`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `artikel`
--
ALTER TABLE `artikel`
  MODIFY `id_artikel` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `barang`
--
ALTER TABLE `barang`
  MODIFY `id_barang` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=24;
--
-- AUTO_INCREMENT for table `detailtransaksipenjualan`
--
ALTER TABLE `detailtransaksipenjualan`
  MODIFY `id_detail` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=89;
--
-- AUTO_INCREMENT for table `kategoriartikel`
--
ALTER TABLE `kategoriartikel`
  MODIFY `id_kategoriArtikel` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `kategoribarang`
--
ALTER TABLE `kategoribarang`
  MODIFY `id_kategori` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `konfirmasipembayaran`
--
ALTER TABLE `konfirmasipembayaran`
  MODIFY `id_konfirmasi` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=32;
--
-- AUTO_INCREMENT for table `member`
--
ALTER TABLE `member`
  MODIFY `id_member` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `pengaturan`
--
ALTER TABLE `pengaturan`
  MODIFY `id_pengaturan` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `rekeningbank`
--
ALTER TABLE `rekeningbank`
  MODIFY `id_rekening` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `retur`
--
ALTER TABLE `retur`
  MODIFY `id_retur` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT for table `slider`
--
ALTER TABLE `slider`
  MODIFY `id_slider` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=48;
--
-- AUTO_INCREMENT for table `testimoni`
--
ALTER TABLE `testimoni`
  MODIFY `id_testimoni` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `transaksipenjualan`
--
ALTER TABLE `transaksipenjualan`
  MODIFY `id_transaksi` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=121;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
