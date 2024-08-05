-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 09, 2024 at 01:44 PM
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
(22, 'A1', 0.45, 0.36262948909511, 0.40631474454756, 8),
(23, 'A2', 0.71, 0.66722048516115, 0.68861024258057, 3),
(24, 'A3', 0.69, 0.68292605439702, 0.68646302719851, 4),
(25, 'A4', 0.87, 0.86498483123006, 0.86749241561503, 2),
(26, 'A5', 0.91, 0.90446235192564, 0.90723117596282, 1),
(27, 'A6', 0.38, 0.32789482335177, 0.35394741167589, 10),
(28, 'A7', 0.38, 0.32789482335177, 0.35394741167589, 9),
(29, 'A8', 0.49, 0.48006612064395, 0.48503306032198, 6),
(30, 'A9', 0.56, 0.52750519782641, 0.54375259891321, 5),
(31, 'A10', 0.47, 0.37321319661472, 0.42160659830736, 7);

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
(14, 'Pengalaman Kerja', 0.3, 'Benefit'),
(15, 'Pelatihan Leadershift', 0.25, 'Benefit'),
(16, 'Penampilan', 0.2, 'Benefit'),
(17, 'Wawasan', 0.15, 'Benefit'),
(18, 'Kejujuran', 0.1, 'Benefit');

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
(403, 22, 14, 53),
(404, 22, 15, 58),
(405, 22, 16, 66),
(406, 22, 17, 71),
(407, 22, 18, 75),
(408, 23, 14, 55),
(409, 23, 15, 59),
(410, 23, 16, 67),
(411, 23, 17, 72),
(412, 23, 18, 76),
(413, 24, 14, 55),
(414, 24, 15, 60),
(415, 24, 16, 66),
(416, 24, 17, 71),
(417, 24, 18, 76),
(418, 25, 14, 56),
(419, 25, 15, 61),
(420, 25, 16, 67),
(421, 25, 17, 72),
(422, 25, 18, 76),
(423, 26, 14, 57),
(424, 26, 15, 62),
(425, 26, 16, 66),
(426, 26, 17, 71),
(427, 26, 18, 76),
(428, 27, 14, 53),
(429, 27, 15, 58),
(430, 27, 16, 65),
(431, 27, 17, 70),
(432, 27, 18, 75),
(433, 28, 14, 53),
(434, 28, 15, 58),
(435, 28, 16, 65),
(436, 28, 17, 70),
(437, 28, 18, 75),
(438, 29, 14, 54),
(439, 29, 15, 59),
(440, 29, 16, 65),
(441, 29, 17, 70),
(442, 29, 18, 75),
(443, 30, 14, 54),
(444, 30, 15, 59),
(445, 30, 16, 65),
(446, 30, 17, 71),
(447, 30, 18, 77),
(448, 31, 14, 53),
(449, 31, 15, 58),
(450, 31, 16, 66),
(451, 31, 17, 71),
(452, 31, 18, 76);

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
(53, 14, '1 Tahun', 1),
(54, 14, '2 Tahun', 2),
(55, 14, '3 Tahun', 3),
(56, 14, '4 Tahun', 4),
(57, 14, '> 5 Tahun', 5),
(58, 15, '1 - 3 Kali', 1),
(59, 15, '4 - 6 Kali', 2),
(60, 15, '7 - 9 Kali', 3),
(61, 15, '10 - 13 Kali', 4),
(62, 15, '> 15 Kali', 5),
(63, 16, 'Sangat Tidak Baik', 1),
(64, 16, 'Tidak Baik', 2),
(65, 16, 'Cukup', 3),
(66, 16, 'Baik', 4),
(67, 16, 'Sangat Baik', 5),
(68, 17, 'Sangat Tidak Baik', 1),
(69, 17, 'Tidak Baik', 2),
(70, 17, 'Cukup', 3),
(71, 17, 'Baik', 4),
(72, 17, 'Sangat Baik', 5),
(73, 18, 'Sangat Tidak Jujur', 1),
(74, 18, 'Tidak Jujur', 2),
(75, 18, 'Cukup', 3),
(76, 18, 'Jujur', 4),
(77, 18, 'Sangat Jujur', 5);

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
  MODIFY `id_alternatif` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `tbl_kriteria`
--
ALTER TABLE `tbl_kriteria`
  MODIFY `id_kriteria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `tbl_nilai`
--
ALTER TABLE `tbl_nilai`
  MODIFY `id_nilai` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=453;

--
-- AUTO_INCREMENT for table `tbl_subkriteria`
--
ALTER TABLE `tbl_subkriteria`
  MODIFY `id_subkriteria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=78;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
