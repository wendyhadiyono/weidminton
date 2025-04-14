-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 14, 2025 at 08:55 PM
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
-- Database: `weidminton`
--

-- --------------------------------------------------------

--
-- Table structure for table `absensi_anggota`
--

CREATE TABLE `absensi_anggota` (
  `id_aa` int(11) NOT NULL,
  `id_anggota` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `tanggal_absensi` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `absensi_bola_lapangan`
--

CREATE TABLE `absensi_bola_lapangan` (
  `id_abl` int(11) NOT NULL,
  `bola_terpakai` int(11) NOT NULL,
  `lapangan_terpakai` int(11) NOT NULL,
  `tanggal_absensi` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `anggota`
--

CREATE TABLE `anggota` (
  `id_anggota` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `jenis_kelamin` varchar(255) NOT NULL,
  `sisa_main` int(11) NOT NULL DEFAULT 0,
  `domisili` varchar(255) NOT NULL DEFAULT 'Singkawang'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `paket_main`
--

CREATE TABLE `paket_main` (
  `id_pm` int(11) NOT NULL,
  `jenis` varchar(255) NOT NULL,
  `jumlah_main` int(11) NOT NULL,
  `harga` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `profil_admin`
--

CREATE TABLE `profil_admin` (
  `id_pa` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `id_admin` varchar(50) NOT NULL,
  `kata_sandi` varchar(50) NOT NULL,
  `file_avatar` varchar(50) NOT NULL,
  `token_tautan` varchar(255) DEFAULT NULL,
  `masa_berlaku` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `profil_admin`
--

INSERT INTO `profil_admin` (`id_pa`, `nama`, `email`, `id_admin`, `kata_sandi`, `file_avatar`, `token_tautan`, `masa_berlaku`) VALUES
(1, 'Admin', 'nama@email.com', 'admin', 'admin', 'aset/avatar_admin.png', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `profil_klub`
--

CREATE TABLE `profil_klub` (
  `id_pk` int(11) NOT NULL,
  `nama_klub` varchar(255) NOT NULL,
  `kota_asal` varchar(255) NOT NULL,
  `kas_awal` varchar(255) NOT NULL DEFAULT '0',
  `logo_klub` varchar(255) NOT NULL,
  `gambar_sampul` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `profil_klub`
--

INSERT INTO `profil_klub` (`id_pk`, `nama_klub`, `kota_asal`, `kas_awal`, `logo_klub`, `gambar_sampul`) VALUES
(1, 'PB WeidMinton', 'Singkawang', '0', 'aset/favicon.png', 'aset/sampul.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `transaksi_anggota`
--

CREATE TABLE `transaksi_anggota` (
  `id_ta` int(11) NOT NULL,
  `nama_ta` varchar(255) NOT NULL,
  `harga_ta` varchar(255) NOT NULL,
  `tanggal_ta` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `transaksi_bola`
--

CREATE TABLE `transaksi_bola` (
  `id_tb` int(11) NOT NULL,
  `keterangan_tb` varchar(255) NOT NULL,
  `jumlah_tb` int(11) NOT NULL,
  `harga_tb` varchar(255) NOT NULL,
  `tanggal_tb` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `transaksi_lainnya`
--

CREATE TABLE `transaksi_lainnya` (
  `id_tll` int(11) NOT NULL,
  `keterangan_tll` varchar(255) NOT NULL,
  `harga_tll` varchar(255) NOT NULL,
  `tanggal_tll` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `transaksi_lapangan`
--

CREATE TABLE `transaksi_lapangan` (
  `id_tl` int(11) NOT NULL,
  `keterangan_tl` varchar(255) NOT NULL,
  `harga_tl` varchar(255) NOT NULL,
  `sisa_main_tl` int(11) NOT NULL,
  `tanggal_tl` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `absensi_anggota`
--
ALTER TABLE `absensi_anggota`
  ADD PRIMARY KEY (`id_aa`);

--
-- Indexes for table `absensi_bola_lapangan`
--
ALTER TABLE `absensi_bola_lapangan`
  ADD PRIMARY KEY (`id_abl`);

--
-- Indexes for table `anggota`
--
ALTER TABLE `anggota`
  ADD PRIMARY KEY (`id_anggota`);

--
-- Indexes for table `paket_main`
--
ALTER TABLE `paket_main`
  ADD PRIMARY KEY (`id_pm`);

--
-- Indexes for table `profil_admin`
--
ALTER TABLE `profil_admin`
  ADD PRIMARY KEY (`id_pa`);

--
-- Indexes for table `profil_klub`
--
ALTER TABLE `profil_klub`
  ADD PRIMARY KEY (`id_pk`);

--
-- Indexes for table `transaksi_anggota`
--
ALTER TABLE `transaksi_anggota`
  ADD PRIMARY KEY (`id_ta`);

--
-- Indexes for table `transaksi_bola`
--
ALTER TABLE `transaksi_bola`
  ADD PRIMARY KEY (`id_tb`);

--
-- Indexes for table `transaksi_lainnya`
--
ALTER TABLE `transaksi_lainnya`
  ADD PRIMARY KEY (`id_tll`);

--
-- Indexes for table `transaksi_lapangan`
--
ALTER TABLE `transaksi_lapangan`
  ADD PRIMARY KEY (`id_tl`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `absensi_anggota`
--
ALTER TABLE `absensi_anggota`
  MODIFY `id_aa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `absensi_bola_lapangan`
--
ALTER TABLE `absensi_bola_lapangan`
  MODIFY `id_abl` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `anggota`
--
ALTER TABLE `anggota`
  MODIFY `id_anggota` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `paket_main`
--
ALTER TABLE `paket_main`
  MODIFY `id_pm` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `profil_admin`
--
ALTER TABLE `profil_admin`
  MODIFY `id_pa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `profil_klub`
--
ALTER TABLE `profil_klub`
  MODIFY `id_pk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `transaksi_anggota`
--
ALTER TABLE `transaksi_anggota`
  MODIFY `id_ta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `transaksi_bola`
--
ALTER TABLE `transaksi_bola`
  MODIFY `id_tb` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `transaksi_lainnya`
--
ALTER TABLE `transaksi_lainnya`
  MODIFY `id_tll` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `transaksi_lapangan`
--
ALTER TABLE `transaksi_lapangan`
  MODIFY `id_tl` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
