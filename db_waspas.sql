-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 11, 2024 at 01:27 AM
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
-- Database: `db_waspas`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_akun`
--

CREATE TABLE `tbl_akun` (
  `id_akun` int(11) NOT NULL,
  `nama_lengkap` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_akun`
--

INSERT INTO `tbl_akun` (`id_akun`, `nama_lengkap`, `username`, `password`) VALUES
(1, 'Administrator', 'Admin', '12345');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_alternatif`
--

CREATE TABLE `tbl_alternatif` (
  `id_alternatif` int(11) NOT NULL,
  `nama_alternatif` varchar(30) NOT NULL,
  `matriks_a` double NOT NULL,
  `matriks_b` double NOT NULL,
  `nilai_waspas` double NOT NULL,
  `rangking` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_alternatif`
--

INSERT INTO `tbl_alternatif` (`id_alternatif`, `nama_alternatif`, `matriks_a`, `matriks_b`, `nilai_waspas`, `rangking`) VALUES
(8, 'A1', 0.8596, 0.85470672690456, 0.85715336345228, 4),
(9, 'A2', 0.8464, 0.83055205456536, 0.83847602728268, 5),
(10, 'A3', 0.7584, 0.74322567902132, 0.75081283951066, 6),
(11, 'A4', 0.9156, 0.91216430773814, 0.91388215386907, 2),
(12, 'A5', 0.9408, 0.93817474156787, 0.93948737078393, 1),
(13, 'A6', 0.7472, 0.74353170226878, 0.74536585113439, 7),
(14, 'A7', 0.8808, 0.87742647083774, 0.87911323541887, 3);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_kriteria`
--

CREATE TABLE `tbl_kriteria` (
  `id_kriteria` int(11) NOT NULL,
  `nama_kriteria` varchar(30) NOT NULL,
  `bobot_kriteria` double NOT NULL,
  `tipe_kriteria` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_kriteria`
--

INSERT INTO `tbl_kriteria` (`id_kriteria`, `nama_kriteria`, `bobot_kriteria`, `tipe_kriteria`) VALUES
(5, 'Kecepatan Pemeriksaan', 0.456, 'Benefit'),
(6, 'Kerjasama', 0.256, 'Benefit'),
(7, 'Akurasi Pemeriksaan', 0.156, 'Benefit'),
(8, 'Kepatuhan Aturan', 0.09, 'Benefit'),
(9, 'Kreativias', 0.04, 'Benefit');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_nilai`
--

CREATE TABLE `tbl_nilai` (
  `id_nilai` int(11) NOT NULL,
  `id_alternatif` int(11) NOT NULL,
  `id_kriteria` int(11) NOT NULL,
  `id_subkriteria` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_nilai`
--

INSERT INTO `tbl_nilai` (`id_nilai`, `id_alternatif`, `id_kriteria`, `id_subkriteria`) VALUES
(70, 0, 1, 4),
(71, 0, 2, 1),
(72, 0, 4, 6),
(79, 0, 1, 2),
(80, 0, 2, 1),
(81, 0, 4, 6),
(145, 0, 1, 2),
(146, 0, 2, 1),
(147, 0, 4, 7),
(166, 3, 1, 4),
(167, 3, 2, 1),
(168, 3, 4, 7),
(169, 2, 1, 2),
(170, 2, 2, 1),
(171, 2, 4, 6),
(223, 15, 5, 11),
(224, 15, 6, 13),
(225, 15, 7, 17),
(226, 15, 8, 22),
(227, 15, 9, 26),
(228, 17, 5, 9),
(229, 17, 6, 14),
(230, 17, 7, 17),
(231, 17, 8, 20),
(232, 17, 9, 24),
(233, 18, 5, 10),
(234, 18, 6, 13),
(235, 18, 7, 18),
(236, 18, 8, 22),
(237, 18, 9, 25),
(253, 0, 5, 0),
(254, 0, 6, 0),
(255, 0, 7, 0),
(256, 0, 8, 0),
(257, 0, 9, 0),
(258, 8, 5, 9),
(259, 8, 6, 12),
(260, 8, 7, 17),
(261, 8, 8, 20),
(262, 8, 9, 26),
(263, 9, 5, 8),
(264, 9, 6, 14),
(265, 9, 7, 17),
(266, 9, 8, 21),
(267, 9, 9, 24),
(268, 10, 5, 10),
(269, 10, 6, 12),
(270, 10, 7, 17),
(271, 10, 8, 21),
(272, 10, 9, 25),
(273, 11, 5, 8),
(274, 11, 6, 13),
(275, 11, 7, 17),
(276, 11, 8, 20),
(277, 11, 9, 24),
(288, 13, 5, 9),
(289, 13, 6, 14),
(290, 13, 7, 17),
(291, 13, 8, 21),
(292, 13, 9, 25),
(293, 14, 5, 9),
(294, 14, 6, 12),
(295, 14, 7, 16),
(296, 14, 8, 21),
(297, 14, 9, 25),
(298, 12, 5, 8),
(299, 12, 6, 12),
(300, 12, 7, 17),
(301, 12, 8, 21),
(302, 12, 9, 25);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_subkriteria`
--

CREATE TABLE `tbl_subkriteria` (
  `id_subkriteria` int(11) NOT NULL,
  `id_kriteria` int(11) NOT NULL,
  `nama_subkriteria` varchar(50) NOT NULL,
  `nilai_subkriteria` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_subkriteria`
--

INSERT INTO `tbl_subkriteria` (`id_subkriteria`, `id_kriteria`, `nama_subkriteria`, `nilai_subkriteria`) VALUES
(1, 2, 'Data', 3737),
(2, 1, 'ggg', 444),
(3, 3, 'ddd', 46464),
(4, 1, 'hhs', 282),
(5, 3, 'sss', 22),
(6, 4, 'e', 23),
(7, 4, 's', 12),
(8, 5, 'Sangat Baik', 5),
(9, 5, 'Baik', 4),
(10, 5, 'Cukup Baik', 3),
(11, 5, 'Kurang Baik', 2),
(12, 6, 'Sangat Baik', 5),
(13, 6, 'Baik', 4),
(14, 6, 'Cukup Baik', 3),
(15, 6, 'Kurang Baik', 2),
(16, 7, 'Sangat Baik', 5),
(17, 7, 'Baik', 4),
(18, 7, 'Cukup Baik', 3),
(19, 7, 'Kurang Baik', 2),
(20, 8, 'Sangat Baik', 5),
(21, 8, 'Baik', 4),
(22, 8, 'Cukup Baik', 3),
(23, 8, 'Kurang Baik', 2),
(24, 9, 'Sangat Baik', 5),
(25, 9, 'Baik', 4),
(26, 9, 'Cukup Baik', 3),
(27, 9, 'Kurang Baik', 2),
(28, 5, 'Tidak Baik', 1),
(29, 6, 'Tidak Baik', 1),
(30, 7, 'Tidak Baik', 1),
(31, 8, 'Tidak Baik', 1),
(32, 9, 'Tidak Baik', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_akun`
--
ALTER TABLE `tbl_akun`
  ADD PRIMARY KEY (`id_akun`);

--
-- Indexes for table `tbl_alternatif`
--
ALTER TABLE `tbl_alternatif`
  ADD PRIMARY KEY (`id_alternatif`);

--
-- Indexes for table `tbl_kriteria`
--
ALTER TABLE `tbl_kriteria`
  ADD PRIMARY KEY (`id_kriteria`);

--
-- Indexes for table `tbl_nilai`
--
ALTER TABLE `tbl_nilai`
  ADD PRIMARY KEY (`id_nilai`);

--
-- Indexes for table `tbl_subkriteria`
--
ALTER TABLE `tbl_subkriteria`
  ADD PRIMARY KEY (`id_subkriteria`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_akun`
--
ALTER TABLE `tbl_akun`
  MODIFY `id_akun` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_alternatif`
--
ALTER TABLE `tbl_alternatif`
  MODIFY `id_alternatif` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `tbl_kriteria`
--
ALTER TABLE `tbl_kriteria`
  MODIFY `id_kriteria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tbl_nilai`
--
ALTER TABLE `tbl_nilai`
  MODIFY `id_nilai` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=303;

--
-- AUTO_INCREMENT for table `tbl_subkriteria`
--
ALTER TABLE `tbl_subkriteria`
  MODIFY `id_subkriteria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
