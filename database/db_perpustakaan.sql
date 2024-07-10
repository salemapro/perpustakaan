-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 10, 2024 at 04:50 PM
-- Server version: 10.3.16-MariaDB
-- PHP Version: 7.1.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_perpustakaan`
--

-- --------------------------------------------------------

--
-- Table structure for table `buku`
--

CREATE TABLE `buku` (
  `id_buku` int(11) NOT NULL,
  `judul_buku` varchar(125) NOT NULL,
  `kategori_buku` varchar(125) NOT NULL,
  `penerbit_buku` varchar(125) NOT NULL,
  `pengarang` varchar(125) NOT NULL,
  `tahun_terbit` varchar(125) NOT NULL,
  `isbn` int(50) NOT NULL,
  `j_buku_baik` varchar(125) NOT NULL,
  `j_buku_rusak` varchar(125) NOT NULL,
  `cover_buku` text NOT NULL,
  `sinopsis` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `buku`
--

INSERT INTO `buku` (`id_buku`, `judul_buku`, `kategori_buku`, `penerbit_buku`, `pengarang`, `tahun_terbit`, `isbn`, `j_buku_baik`, `j_buku_rusak`, `cover_buku`, `sinopsis`) VALUES
(1, 'Cantik Itu Luka', 'Novel ', 'Gramedia Pustaka Utama', 'Eka Kurniawan', '2002', 2147483647, '38', '2', 'Cantik Itu Luka20240707115327.jpg', 'cantik itu luka'),
(2, 'Home Sweet Loan', 'Novel ', 'Gramedia Pustaka Utama', 'Almira Bastari', '2022', 2147483647, '40', '0', 'Home Sweet Loan20240707115343.jpg', 'home'),
(3, 'Heartbreak Motel', 'Novel ', 'Gramedia Pustaka Utama', 'Ika Natassa', '2022', 2147483647, '40', '0', 'Heartbreak Motel20240707115405.jpg', 'Heartbreak'),
(4, 'Rindu', 'Novel ', 'Mizan Pustaka', 'Tere Liye', '2014', 12345678, '3', '1', 'Rindu20240707115241.jpg', ' rindu');

-- --------------------------------------------------------

--
-- Table structure for table `identitas`
--

CREATE TABLE `identitas` (
  `id_identitas` int(11) NOT NULL,
  `nama_app` varchar(50) NOT NULL,
  `alamat_app` text NOT NULL,
  `email_app` varchar(125) NOT NULL,
  `nomor_hp` char(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `identitas`
--

INSERT INTO `identitas` (`id_identitas`, `nama_app`, `alamat_app`, `email_app`, `nomor_hp`) VALUES
(1, 'Perpustakaan SMAN Pati', 'Jl. P. Sudirman No.24, Puri, Plangitan, Kec. Pati, Kabupaten Pati, Jawa Tengah', 'perpussmanpati@e-perpus.com', '6281221545666');

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `id_kategori` int(11) NOT NULL,
  `kode_kategori` varchar(50) NOT NULL,
  `nama_kategori` varchar(125) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`id_kategori`, `kode_kategori`, `nama_kategori`) VALUES
(1, 'KT-001', 'Novel '),
(2, 'KT-002', 'Cergam'),
(3, 'KT-003', 'Ensiklopedi'),
(4, 'KT-004', 'Biografi'),
(5, 'KT-005', 'Catatan Harian'),
(6, 'KT-006', 'Karya Ilmiah'),
(7, 'KT-007', 'Tafsir'),
(8, 'KT-008', 'Panduan (how to)'),
(9, 'KT-009', 'Majalah'),
(10, 'KT-010', 'Antologi');

-- --------------------------------------------------------

--
-- Table structure for table `pemberitahuan`
--

CREATE TABLE `pemberitahuan` (
  `id_pemberitahuan` int(11) NOT NULL,
  `isi_pemberitahuan` varchar(255) NOT NULL,
  `level_user` varchar(125) NOT NULL,
  `status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pemberitahuan`
--

INSERT INTO `pemberitahuan` (`id_pemberitahuan`, `isi_pemberitahuan`, `level_user`, `status`) VALUES
(1, '<i class=\'fa fa-exchange\'></i> #Reza  Saputra Telah meminjam Buku', 'Admin', 'Sudah dibaca'),
(2, '<i class=\'fa fa-repeat\'></i> #Reza  Saputra Telah mengembalikan Buku', 'Admin', 'Sudah dibaca'),
(3, '<i class=\'fa fa-exchange\'></i> #Reza  Saputra Telah meminjam Buku', 'Admin', 'Sudah dibaca'),
(4, '<i class=\'fa fa-exchange\'></i> #Reza  Saputra Telah meminjam Buku', 'Admin', 'Sudah dibaca'),
(5, '<i class=\'fa fa-exchange\'></i> #Reza  Saputra Telah meminjam Buku', 'Admin', 'Sudah dibaca'),
(6, '<i class=\'fa fa-repeat\'></i> #Reza  Saputra Telah mengembalikan Buku', 'Admin', 'Sudah dibaca'),
(7, '<i class=\'fa fa-exchange\'></i> #Reza  Saputra Telah meminjam Buku', 'Admin', 'Sudah dibaca'),
(8, '<i class=\'fa fa-repeat\'></i> #Reza  Saputra Telah mengembalikan Buku', 'Admin', 'Sudah dibaca'),
(9, '<i class=\'fa fa-exchange\'></i> #Reza  Saputra Telah meminjam Buku', 'Admin', 'Sudah dibaca'),
(10, '<i class=\'fa fa-repeat\'></i> #Reza  Saputra Telah mengembalikan Buku', 'Admin', 'Sudah dibaca'),
(11, '<i class=\'fa fa-exchange\'></i> #Reza  Saputra Telah meminjam Buku', 'Admin', 'Sudah dibaca'),
(12, '<i class=\'fa fa-repeat\'></i> #Reza  Saputra Telah mengembalikan Buku', 'Admin', 'Sudah dibaca'),
(13, '<i class=\'fa fa-repeat\'></i> #Reza  Saputra Telah mengembalikan Buku', 'Admin', 'Sudah dibaca'),
(14, '<i class=\'fa fa-repeat\'></i> #Reza  Saputra Telah mengembalikan Buku', 'Admin', 'Sudah dibaca'),
(15, '<i class=\'fa fa-repeat\'></i> #Reza  Saputra Telah mengembalikan Buku', 'Admin', 'Sudah dibaca'),
(16, '<i class=\'fa fa-repeat\'></i> #Reza  Saputra Telah mengembalikan Buku', 'Admin', 'Sudah dibaca'),
(17, '<i class=\'fa fa-repeat\'></i> #Reza  Saputra Telah mengembalikan Buku', 'Admin', 'Sudah dibaca'),
(18, '<i class=\'fa fa-repeat\'></i> #Reza  Saputra Telah mengembalikan Buku', 'Admin', 'Sudah dibaca'),
(19, '<i class=\'fa fa-repeat\'></i> #Reza  Saputra Telah mengembalikan Buku', 'Admin', 'Sudah dibaca'),
(20, '<i class=\'fa fa-repeat\'></i> #Reza  Saputra Telah mengembalikan Buku', 'Admin', 'Sudah dibaca'),
(21, '<i class=\'fa fa-repeat\'></i> #Reza  Saputra Telah mengembalikan Buku', 'Admin', 'Sudah dibaca'),
(22, '<i class=\'fa fa-repeat\'></i> #Reza  Saputra Telah mengembalikan Buku', 'Admin', 'Sudah dibaca'),
(23, '<i class=\'fa fa-exchange\'></i> #Reza  Saputra Telah meminjam Buku', 'Admin', 'Sudah dibaca'),
(24, '<i class=\'fa fa-repeat\'></i> #Reza  Saputra Telah mengembalikan Buku', 'Admin', 'Sudah dibaca');

-- --------------------------------------------------------

--
-- Table structure for table `peminjaman`
--

CREATE TABLE `peminjaman` (
  `id_peminjaman` int(11) NOT NULL,
  `nama_anggota` varchar(125) NOT NULL,
  `judul_buku` varchar(125) NOT NULL,
  `tanggal_peminjaman` date NOT NULL,
  `batas_peminjaman` date NOT NULL,
  `tanggal_pengembalian` varchar(150) NOT NULL,
  `kondisi_buku_saat_dipinjam` varchar(125) NOT NULL,
  `kondisi_buku_saat_dikembalikan` varchar(125) NOT NULL,
  `denda` varchar(125) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `peminjaman`
--

INSERT INTO `peminjaman` (`id_peminjaman`, `nama_anggota`, `judul_buku`, `tanggal_peminjaman`, `batas_peminjaman`, `tanggal_pengembalian`, `kondisi_buku_saat_dipinjam`, `kondisi_buku_saat_dikembalikan`, `denda`) VALUES
(1, 'Reza  Saputra', 'Cantik Itu Luka', '2022-08-08', '2022-08-08', '2022-08-08', 'Baik', 'Baik', 'Tidak Ada'),
(5, 'Reza  Saputra', 'Heartbreak Motel', '2024-07-07', '2024-07-14', '2024-07-07', 'Baik', 'Rusak', 'Rp 20.000'),
(7, 'Reza  Saputra', 'Cantik Itu Luka', '2024-06-28', '2024-07-04', '2024-07-07', 'Baik', 'Baik', 'Rp 1.500'),
(8, 'Reza  Saputra', 'Home Sweet Loan', '2024-07-07', '2024-07-07', '2024-07-07', 'Baik', 'Hilang', 'Rp 50.000');

-- --------------------------------------------------------

--
-- Table structure for table `penerbit`
--

CREATE TABLE `penerbit` (
  `id_penerbit` int(11) NOT NULL,
  `kode_penerbit` varchar(125) NOT NULL,
  `nama_penerbit` varchar(50) NOT NULL,
  `verif_penerbit` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `penerbit`
--

INSERT INTO `penerbit` (`id_penerbit`, `kode_penerbit`, `nama_penerbit`, `verif_penerbit`) VALUES
(1, 'P001', 'Gramedia Pustaka Utama', 'Terverifikasi'),
(2, 'P002', 'Mizan Pustaka', 'Terverifikasi'),
(3, 'P003', 'Bentang Pustaka', 'Terverifikasi'),
(4, 'P004', 'Erlangga', 'Terverifikasi'),
(5, 'P005', 'Republika', 'Terverifikasi');

-- --------------------------------------------------------

--
-- Table structure for table `pesan`
--

CREATE TABLE `pesan` (
  `id_pesan` int(11) NOT NULL,
  `penerima` varchar(50) NOT NULL,
  `pengirim` varchar(50) NOT NULL,
  `judul_pesan` varchar(50) NOT NULL,
  `isi_pesan` text NOT NULL,
  `status` varchar(50) NOT NULL,
  `tanggal_kirim` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pesan`
--

INSERT INTO `pesan` (`id_pesan`, `penerima`, `pengirim`, `judul_pesan`, `isi_pesan`, `status`, `tanggal_kirim`) VALUES
(2, 'Reza  Saputra', 'Ceppy Masoem', 'Halo', 'Ppp', 'Sudah dibaca', '06-07-2024');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `kode_user` varchar(25) NOT NULL,
  `nis` char(20) NOT NULL,
  `fullname` varchar(125) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `kelas` varchar(50) NOT NULL,
  `alamat` varchar(225) NOT NULL,
  `verif` varchar(50) NOT NULL,
  `role` varchar(50) NOT NULL,
  `join_date` varchar(125) NOT NULL,
  `terakhir_login` varchar(125) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `kode_user`, `nis`, `fullname`, `username`, `password`, `kelas`, `alamat`, `verif`, `role`, `join_date`, `terakhir_login`) VALUES
(1, '-', '-', 'Administrator', 'admin', 'admin', '-', '-', 'Iya', 'Admin', '04-05-2021', '09-07-2024 ( 21:37:15 )'),
(2, 'AP001', '100011', 'Reza  Saputra', 'reza', 'Reza', 'X - Rekayasa Perangkat Lunak', 'Desa Sambiroto, Kecamatan Tayu, Kabupatem Pati', 'Tidak', 'Anggota', '08-08-2022', '09-07-2024 ( 14:32:01 )'),
(3, '-', '-', 'Ceppy Masoem', 'kepsek', 'kepsek', '-', '-', 'Iya', 'Kepsek', '06-07-2024', '09-07-2024 ( 14:30:59 )');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `buku`
--
ALTER TABLE `buku`
  ADD PRIMARY KEY (`id_buku`);

--
-- Indexes for table `identitas`
--
ALTER TABLE `identitas`
  ADD PRIMARY KEY (`id_identitas`);

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indexes for table `pemberitahuan`
--
ALTER TABLE `pemberitahuan`
  ADD PRIMARY KEY (`id_pemberitahuan`);

--
-- Indexes for table `peminjaman`
--
ALTER TABLE `peminjaman`
  ADD PRIMARY KEY (`id_peminjaman`);

--
-- Indexes for table `penerbit`
--
ALTER TABLE `penerbit`
  ADD PRIMARY KEY (`id_penerbit`);

--
-- Indexes for table `pesan`
--
ALTER TABLE `pesan`
  ADD PRIMARY KEY (`id_pesan`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `buku`
--
ALTER TABLE `buku`
  MODIFY `id_buku` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `identitas`
--
ALTER TABLE `identitas`
  MODIFY `id_identitas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id_kategori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `pemberitahuan`
--
ALTER TABLE `pemberitahuan`
  MODIFY `id_pemberitahuan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `peminjaman`
--
ALTER TABLE `peminjaman`
  MODIFY `id_peminjaman` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `penerbit`
--
ALTER TABLE `penerbit`
  MODIFY `id_penerbit` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `pesan`
--
ALTER TABLE `pesan`
  MODIFY `id_pesan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
