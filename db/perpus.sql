-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 16, 2024 at 10:53 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `perpus`
--

-- --------------------------------------------------------

--
-- Table structure for table `anggota`
--

CREATE TABLE `anggota` (
  `id` int(11) NOT NULL,
  `nisn` varchar(16) NOT NULL,
  `nama_lengkap` varchar(50) NOT NULL,
  `jenis_kelamin` enum('Laki-laki','Perempuan') NOT NULL,
  `no_telp` varchar(13) NOT NULL,
  `alamat` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `update_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `anggota`
--

INSERT INTO `anggota` (`id`, `nisn`, `nama_lengkap`, `jenis_kelamin`, `no_telp`, `alamat`, `created_at`, `update_at`) VALUES
(1, '123', 'Jindan Kafilah Akbar', 'Laki-laki', '0895421369787', 'bekasi', '2024-08-06 07:01:35', '2024-08-06 07:01:35');

-- --------------------------------------------------------

--
-- Table structure for table `buku`
--

CREATE TABLE `buku` (
  `id` int(11) NOT NULL,
  `id_kategori` int(11) NOT NULL,
  `judul` varchar(50) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `penerbit` varchar(50) NOT NULL,
  `tahun_terbit` varchar(5) NOT NULL,
  `penulis` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `delete_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `buku`
--

INSERT INTO `buku` (`id`, `id_kategori`, `judul`, `jumlah`, `penerbit`, `tahun_terbit`, `penulis`, `created_at`, `delete_at`) VALUES
(1, 1, 'Rudi Habibi 2', 1, 'Gema Insani', '2013', 'jokowi', '2024-08-06 04:47:00', '2024-08-07 07:11:07'),
(2, 1, 'Kata', 2, 'gema insani', '2014', 'paus biru', '2024-08-07 07:13:20', '2024-08-07 08:04:43'),
(3, 2, 'Tutorial Menjadi Ayah', 2, 'elex media komputindo', '2013', 'denis', '2024-08-07 07:46:33', '2024-08-07 08:04:46');

-- --------------------------------------------------------

--
-- Table structure for table `detail_peminjaman`
--

CREATE TABLE `detail_peminjaman` (
  `id` int(11) NOT NULL,
  `id_peminjaman` int(11) NOT NULL,
  `id_buku` int(11) NOT NULL,
  `id_kategori` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `detail_peminjaman`
--

INSERT INTO `detail_peminjaman` (`id`, `id_peminjaman`, `id_buku`, `id_kategori`) VALUES
(1, 1, 1, 0),
(2, 1, 1, 2),
(3, 2, 1, 1),
(4, 3, 1, 1),
(5, 4, 1, 2),
(6, 5, 1, 2),
(7, 6, 1, 2),
(8, 7, 1, 2),
(9, 8, 1, 2),
(10, 9, 1, 1),
(11, 27, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `id` int(11) NOT NULL,
  `nama_kategori` varchar(11) NOT NULL,
  `keterangan` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`id`, `nama_kategori`, `keterangan`, `created_at`, `updated_at`) VALUES
(1, 'fiksi', 'minjem 2 minggu', '2024-07-31 07:25:00', '2024-07-31 07:25:00'),
(3, 'legenda rak', 'asdasdas12321', '2024-07-31 07:52:54', '2024-08-06 04:40:45'),
(5, 'Pendidikan', 'cerita rakyat', '2024-08-07 07:49:48', '2024-08-07 07:49:48');

-- --------------------------------------------------------

--
-- Table structure for table `level`
--

CREATE TABLE `level` (
  `id` int(11) NOT NULL,
  `nama_level` varchar(50) NOT NULL,
  `keterangan` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `level`
--

INSERT INTO `level` (`id`, `nama_level`, `keterangan`, `created_at`, `updated_at`) VALUES
(1, 'Administrator', 'Dapat mengolah data perpustakaan', '2024-08-06 01:32:11', '2024-08-06 01:45:27'),
(2, 'User', 'Bertanggung jawab atas transaksi peminjaman buku perpustakaan', '2024-08-06 01:32:24', '2024-08-06 01:45:32');

-- --------------------------------------------------------

--
-- Table structure for table `peminjaman`
--

CREATE TABLE `peminjaman` (
  `id` int(11) NOT NULL,
  `id_anggota` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `kode_transaksi` varchar(30) NOT NULL,
  `tgl_pinjam` date NOT NULL,
  `tgl_kembali` date NOT NULL,
  `status` tinyint(4) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `deleted_at` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `peminjaman`
--

INSERT INTO `peminjaman` (`id`, `id_anggota`, `id_user`, `kode_transaksi`, `tgl_pinjam`, `tgl_kembali`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 3, 'PJ12 08 2024001', '2024-08-13', '2024-08-12', 2, '2024-08-12 07:10:09', '2024-08-16 08:49:25', 1),
(2, 1, 3, 'PJ12 08 2024002', '2024-08-30', '2024-08-12', 2, '2024-08-12 07:10:44', '2024-08-16 08:43:15', 1),
(3, 1, 3, 'PJ12 08 2024003', '2024-08-14', '2024-08-13', 2, '2024-08-12 07:12:54', '2024-08-16 08:46:20', 1),
(4, 1, 3, 'PJ12 08 2024004', '2024-08-21', '2024-08-13', 2, '2024-08-12 07:16:35', '2024-08-16 08:52:21', 1),
(5, 1, 3, 'PJ12 08 2024004', '2024-08-21', '2024-08-13', 2, '2024-08-12 07:18:29', '2024-08-16 08:44:03', 1),
(6, 1, 3, 'PJ12 08 2024004', '2024-08-21', '2024-08-13', 2, '2024-08-12 07:18:32', '2024-08-16 08:44:41', 1),
(7, 1, 3, 'PJ12 08 2024004', '2024-08-21', '2024-08-13', 2, '2024-08-12 07:18:37', '2024-08-16 08:42:45', 1),
(8, 1, 3, 'PJ12 08 2024008', '2024-08-23', '2024-08-12', 2, '2024-08-12 07:22:13', '2024-08-16 08:50:49', 1),
(9, 0, 3, 'PJ12 08 2024009', '2024-08-16', '2024-08-12', 1, '2024-08-12 07:32:40', '2024-08-12 08:11:15', 1),
(13, 0, 3, '', '0000-00-00', '0000-00-00', 1, '2024-08-16 06:22:17', '2024-08-16 06:29:37', 1),
(14, 0, 3, '', '0000-00-00', '0000-00-00', 1, '2024-08-16 06:27:33', '2024-08-16 06:29:35', 1),
(15, 0, 3, '', '0000-00-00', '0000-00-00', 1, '2024-08-16 06:27:45', '2024-08-16 06:29:33', 1),
(16, 0, 3, '', '0000-00-00', '0000-00-00', 1, '2024-08-16 06:27:45', '2024-08-16 06:29:31', 1),
(17, 0, 3, '', '0000-00-00', '0000-00-00', 1, '2024-08-16 06:27:46', '2024-08-16 06:29:30', 1),
(18, 0, 3, '', '0000-00-00', '0000-00-00', 1, '2024-08-16 06:27:46', '2024-08-16 06:29:28', 1),
(19, 0, 3, '', '0000-00-00', '0000-00-00', 1, '2024-08-16 06:27:46', '2024-08-16 06:29:26', 1),
(20, 0, 3, '', '0000-00-00', '0000-00-00', 1, '2024-08-16 06:27:46', '2024-08-16 06:29:23', 1),
(21, 0, 3, '', '0000-00-00', '0000-00-00', 1, '2024-08-16 06:28:47', '2024-08-16 06:29:21', 1),
(22, 0, 3, '', '0000-00-00', '0000-00-00', 1, '2024-08-16 06:28:48', '2024-08-16 06:29:19', 1),
(23, 0, 0, '', '0000-00-00', '0000-00-00', 1, '2024-08-16 06:31:33', '2024-08-16 08:43:11', 1),
(24, 0, 3, '', '0000-00-00', '0000-00-00', 1, '2024-08-16 06:42:50', '2024-08-16 08:43:09', 1),
(25, 0, 3, '', '0000-00-00', '0000-00-00', 1, '2024-08-16 08:39:42', '2024-08-16 08:43:07', 1),
(26, 0, 3, '', '0000-00-00', '0000-00-00', 1, '2024-08-16 08:39:45', '2024-08-16 08:43:05', 1),
(27, 1, 3, 'PJ16 08 2024027', '2024-08-17', '2024-08-16', 1, '2024-08-16 08:53:07', '2024-08-16 08:53:07', 0);

-- --------------------------------------------------------

--
-- Table structure for table `pengembalian`
--

CREATE TABLE `pengembalian` (
  `id` int(11) NOT NULL,
  `id_peminjaman` int(11) NOT NULL,
  `kode_pengembalian` varchar(30) NOT NULL,
  `tgl_pengembalian` date NOT NULL,
  `terlambat` int(30) NOT NULL,
  `denda` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `update_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pengembalian`
--

INSERT INTO `pengembalian` (`id`, `id_peminjaman`, `kode_pengembalian`, `tgl_pengembalian`, `terlambat`, `denda`, `created_at`, `update_at`) VALUES
(1, 7, 'KMBL16082024001', '0000-00-00', 3, 0, '2024-08-16 08:42:45', '2024-08-16 08:42:45'),
(2, 2, 'KMBL16082024002', '0000-00-00', 4, 0, '2024-08-16 08:42:57', '2024-08-16 08:42:57'),
(3, 5, 'KMBL16082024003', '0000-00-00', 3, 0, '2024-08-16 08:44:03', '2024-08-16 08:44:03'),
(4, 6, 'KMBL16082024004', '0000-00-00', 3, 0, '2024-08-16 08:44:41', '2024-08-16 08:44:41'),
(5, 3, 'KMBL16082024005', '0000-00-00', 3, 0, '2024-08-16 08:46:20', '2024-08-16 08:46:20'),
(6, 1, 'KMBL16082024006', '0000-00-00', 4, 0, '2024-08-16 08:49:25', '2024-08-16 08:49:25'),
(7, 8, 'KMBL16082024007', '2024-08-16', 4, 0, '2024-08-16 08:50:49', '2024-08-16 08:50:49'),
(8, 4, 'KMBL16082024008', '0000-00-00', 3, 0, '2024-08-16 08:52:21', '2024-08-16 08:52:21');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `id_level` int(11) NOT NULL,
  `nama_lengkap` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `update_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `id_level`, `nama_lengkap`, `email`, `password`, `created_at`, `update_at`) VALUES
(3, 1, 'yudi', 'admin@gmail.com', 'a687a84ff2f6c9be45d94eb8ee8d6411d6583ca3', '2024-08-12 07:05:06', '2024-08-12 07:06:41'),
(31, 2, 'Kaido', 'user@gmail.com', 'a687a84ff2f6c9be45d94eb8ee8d6411d6583ca3', '2024-08-12 02:05:43', '2024-08-12 02:05:43');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `anggota`
--
ALTER TABLE `anggota`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `buku`
--
ALTER TABLE `buku`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `detail_peminjaman`
--
ALTER TABLE `detail_peminjaman`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `level`
--
ALTER TABLE `level`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `peminjaman`
--
ALTER TABLE `peminjaman`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pengembalian`
--
ALTER TABLE `pengembalian`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `anggota`
--
ALTER TABLE `anggota`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `buku`
--
ALTER TABLE `buku`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `detail_peminjaman`
--
ALTER TABLE `detail_peminjaman`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `level`
--
ALTER TABLE `level`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `peminjaman`
--
ALTER TABLE `peminjaman`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `pengembalian`
--
ALTER TABLE `pengembalian`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
