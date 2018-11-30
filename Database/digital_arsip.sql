-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 21, 2018 at 04:52 PM
-- Server version: 10.1.34-MariaDB
-- PHP Version: 7.2.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `digital_arsip`
--

-- --------------------------------------------------------

--
-- Table structure for table `data_arsip`
--

CREATE TABLE `data_arsip` (
  `id` int(11) NOT NULL,
  `noarsip` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `pencipta` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `unit_pengolah` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `tanggal` date NOT NULL,
  `retensi` date NOT NULL,
  `uraian` text COLLATE utf8_unicode_ci NOT NULL,
  `ket` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `jenisdok` int(2) NOT NULL COMMENT '1 = Biasa, 2 = Rahasia',
  `kode` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `jumlah` int(11) NOT NULL,
  `nobox` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `lokasi` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `lantai` int(254) NOT NULL,
  `ruangan` int(254) NOT NULL,
  `lemari` int(254) NOT NULL,
  `baris` int(254) NOT NULL,
  `media` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `file` text COLLATE utf8_unicode_ci,
  `tgl_input` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `tgl_update` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `dep` int(12) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `master_baris`
--

CREATE TABLE `master_baris` (
  `id_baris` int(254) NOT NULL,
  `id_lemari` int(254) NOT NULL,
  `no_baris` int(254) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `master_baris`
--

INSERT INTO `master_baris` (`id_baris`, `id_lemari`, `no_baris`) VALUES
(24, 32, 1),
(25, 32, 2),
(26, 33, 1),
(27, 33, 2),
(28, 36, 1),
(29, 36, 2),
(30, 37, 1),
(31, 37, 2),
(32, 27, 1),
(33, 27, 2),
(34, 40, 1),
(35, 41, 1),
(36, 29, 1);

-- --------------------------------------------------------

--
-- Table structure for table `master_departemen`
--

CREATE TABLE `master_departemen` (
  `id_dep` int(12) NOT NULL,
  `kode_dep` varchar(30) NOT NULL,
  `nama_dep` varchar(254) NOT NULL,
  `keterangan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `master_departemen`
--

INSERT INTO `master_departemen` (`id_dep`, `kode_dep`, `nama_dep`, `keterangan`) VALUES
(1, 'SDM', 'Sumber Daya Manusia', 'kosongkan aja'),
(2, 'OPR', 'Operasional', ''),
(3, 'UMM', 'Umum', '');

-- --------------------------------------------------------

--
-- Table structure for table `master_kode`
--

CREATE TABLE `master_kode` (
  `id` int(11) NOT NULL,
  `kode` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `nama` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `retensi` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `master_kode`
--

INSERT INTO `master_kode` (`id`, `kode`, `nama`, `retensi`) VALUES
(5, 'SDM.01', 'Rekrutmen Pegawai', 1),
(6, 'SDM.02', 'Mutasi Pegawai', 1),
(7, 'SDM.03', 'Pengembangan Pegawai', 1),
(8, 'SDM.04', 'Cuti Pegawai', 3),
(9, 'SDM.03.01', 'Pelatihan Pegawai', 1),
(10, 'SDM.03.02', 'Beasiswa Pegawai', 1),
(11, 'SDM.01.01', 'Pengangakatan Pegawai', 1),
(12, 'SDM.05', 'Pemberhentian Pegawai', 5),
(13, 'KEU.01', 'Rencana Anggaran', 10),
(14, 'KEU.02', 'Realisasi Anggaran Pegawai', 10),
(15, 'KEU.03', 'Realisasi Anggaran Umum dan Rumah Tangga', 10),
(16, 'HKP.01', 'Peraturan Perusahaan', 3),
(17, 'HKP.01.01', 'Peraturan Direksi Perusahaan', 5),
(18, 'HKP.01.02', 'Keputusan Direksi Perusahaan', 20),
(19, 'HKP.02', 'Pengawasan Internal', 10),
(20, 'RND.01', 'Penelitian dan Pengembangan', 3),
(21, 'UMUM.01', 'Inventarisasi Barang Bergerak', 5),
(22, 'UMUM.02', 'Inventarisasi Barang Tidak Bergerak', 5),
(27, 'ZZZ', 'Zzzz', 0),
(28, 'ZZZ.01', 'Z01', 0);

-- --------------------------------------------------------

--
-- Table structure for table `master_lantai`
--

CREATE TABLE `master_lantai` (
  `id_lantai` int(254) NOT NULL,
  `id` int(11) NOT NULL,
  `no_lantai` int(254) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `master_lantai`
--

INSERT INTO `master_lantai` (`id_lantai`, `id`, `no_lantai`) VALUES
(36, 1, 1),
(37, 1, 2),
(38, 1, 3),
(39, 6, 1),
(40, 6, 2),
(41, 0, 0),
(42, 2, 1),
(43, 2, 2);

-- --------------------------------------------------------

--
-- Table structure for table `master_lemari`
--

CREATE TABLE `master_lemari` (
  `id_lemari` int(254) NOT NULL,
  `id_ruangan` int(254) NOT NULL,
  `no_lemari` int(254) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `master_lemari`
--

INSERT INTO `master_lemari` (`id_lemari`, `id_ruangan`, `no_lemari`) VALUES
(24, 20, 1),
(25, 20, 2),
(26, 20, 3),
(27, 19, 1),
(28, 19, 2),
(29, 21, 1),
(30, 21, 2),
(32, 23, 1),
(33, 23, 2),
(34, 24, 1),
(35, 24, 2),
(36, 18, 1),
(37, 18, 2),
(39, 0, 0),
(40, 26, 1),
(41, 22, 1);

-- --------------------------------------------------------

--
-- Table structure for table `master_lokasi`
--

CREATE TABLE `master_lokasi` (
  `id` int(11) NOT NULL,
  `nama_lokasi` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `master_lokasi`
--

INSERT INTO `master_lokasi` (`id`, `nama_lokasi`) VALUES
(1, 'Gedung A, Unit II1'),
(2, 'Gedung B, Unit III'),
(3, 'Gedung C, Unit IV'),
(4, 'Lokasi'),
(5, 'Gedung C lt 2'),
(6, 'Gedung B lt4');

-- --------------------------------------------------------

--
-- Table structure for table `master_media`
--

CREATE TABLE `master_media` (
  `id` int(11) NOT NULL,
  `nama_media` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `master_media`
--

INSERT INTO `master_media` (`id`, `nama_media`) VALUES
(5, 'Audio Cassette'),
(6, 'Audio Disc'),
(4, 'Blueprint'),
(3, 'Kartografi'),
(2, 'Tekstual'),
(7, 'Video Cartridge'),
(8, 'Digital'),
(9, 'Media'),
(10, 'kertas koran'),
(12, 'usb');

-- --------------------------------------------------------

--
-- Table structure for table `master_pencipta`
--

CREATE TABLE `master_pencipta` (
  `id` int(11) NOT NULL,
  `nama_pencipta` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `master_pencipta`
--

INSERT INTO `master_pencipta` (`id`, `nama_pencipta`) VALUES
(5, 'Bidang Hukum dan Tata Laksana'),
(3, 'Bidang Kepegawaian'),
(6, 'Bidang Keuangan'),
(4, 'Bidang Pengadaan'),
(8, 'Bidang Produksi'),
(7, 'Bidang Umum dan Rumah Tangga'),
(9, 'Pencipta'),
(10, 'Bidang ZZZ'),
(11, 'Bidang QWE');

-- --------------------------------------------------------

--
-- Table structure for table `master_pengolah`
--

CREATE TABLE `master_pengolah` (
  `id` int(11) NOT NULL,
  `nama_pengolah` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `master_pengolah`
--

INSERT INTO `master_pengolah` (`id`, `nama_pengolah`) VALUES
(1, 'Unit Arsip Teknologi Informasi'),
(4, 'Unit Arsip Sekretariat Hukum dan Tata Laksana'),
(2, 'Unit Arsip Kepegawaian'),
(5, 'Unit Arsip Pengadaan'),
(6, 'Unit Arsip Biro Umum dan Rumah Tangga'),
(3, 'Unit Kearsipan Pusat'),
(7, 'Pengolah'),
(8, 'unit ABC'),
(9, 'Unit SDF');

-- --------------------------------------------------------

--
-- Table structure for table `master_ruangan`
--

CREATE TABLE `master_ruangan` (
  `id_ruangan` int(254) NOT NULL,
  `id_lantai` int(254) NOT NULL,
  `nama_ruangan` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `master_ruangan`
--

INSERT INTO `master_ruangan` (`id_ruangan`, `id_lantai`, `nama_ruangan`) VALUES
(18, 36, 'Ruangan A'),
(19, 36, 'Ruangan B'),
(20, 36, 'Ruangan C'),
(21, 39, 'Ruangan A'),
(22, 39, 'Ruangan B'),
(23, 40, 'Ruangan A'),
(24, 40, 'Ruangan B'),
(25, 0, 'Ruangan'),
(26, 43, 'Ruangan Gue nih');

-- --------------------------------------------------------

--
-- Table structure for table `master_user`
--

CREATE TABLE `master_user` (
  `id` int(11) NOT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` enum('active','disable') COLLATE utf8_unicode_ci NOT NULL,
  `tipe` enum('admin','user','sumin') COLLATE utf8_unicode_ci NOT NULL,
  `akses_klas` text COLLATE utf8_unicode_ci NOT NULL,
  `akses_modul` text COLLATE utf8_unicode_ci NOT NULL,
  `depar` varchar(30) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `master_user`
--

INSERT INTO `master_user` (`id`, `username`, `password`, `status`, `tipe`, `akses_klas`, `akses_modul`, `depar`) VALUES
(1, 'admin', '$2y$10$M57KBHBtl9HsFQP6rxrqUOuSqO/MiQJnTqTu4wM5OlWwa/lTKyb2S', 'active', 'sumin', '', '{\"entridata\":\"on\",\"sirkulasi\":\"on\",\"klasifikasi\":\"on\",\"pencipta\":\"on\",\"pengolah\":\"on\",\"lokasi\":\"on\",\"media\":\"on\",\"user\":\"on\",\"import\":\"on\",\"departemen\":\"on\"}', '2'),
(6, 'user', '$2y$10$uE3PKQ/tWOoGQwnfKXVYjOXHRHQ43o5PgYpN2wf2lp.iI4.DFshoq', 'active', 'user', '', '{\"entridata\":\"on\",\"sirkulasi\":\"on\"}', '1'),
(7, 'deni', '$2y$10$uRX3lo8tB2ogPMJA2HwpQe.WGOgemzEM17hL5mrtMsFRo516HnKwW', 'active', 'admin', '', '{\"entridata\":\"on\",\"sirkulasi\":\"on\",\"klasifikasi\":\"on\",\"pencipta\":\"on\",\"pengolah\":\"on\",\"lokasi\":\"on\",\"media\":\"on\",\"user\":\"on\",\"import\":\"on\",\"departemen\":\"on\"}', '1'),
(8, 'gustian', '$2y$10$Av2uvzHlIhL4ga2nz5ZAS.NJBxKuawbGMTpP/1MLyRAZJ/KoOzp2i', 'active', 'user', '', '{\"entridata\":\"on\",\"sirkulasi\":\"on\",\"klasifikasi\":\"on\",\"pencipta\":\"on\",\"pengolah\":\"on\",\"lokasi\":\"on\",\"media\":\"on\",\"user\":\"on\",\"import\":\"on\"}', '2'),
(19, 'agus', '$2y$10$8NnSBOxztydlJ1OXUYi2hOkl3ZB24gX8W9ULSLRQvX6CKMI8ZIFT.', 'disable', 'user', 'hkp,keu', '{\"media\":\"on\"}', '2'),
(20, 'kamal', '$2y$10$GjfR2Izxse0th0dJ/JMqfOD.Ro6gVHIQnmKdCODVO7jGR58rxDPQ2', 'disable', 'admin', '', '{\"entridata\":\"on\",\"sirkulasi\":\"on\",\"klasifikasi\":\"on\",\"pencipta\":\"on\",\"pengolah\":\"on\",\"lokasi\":\"on\",\"media\":\"on\",\"user\":\"on\",\"import\":\"on\"}', '3'),
(23, 'yuki', '$2y$10$ICcgQ74zmigB009Fz/ZcM.32DjUgVQIdnUEZsrwxdJ6T0cwUT1Kyi', 'active', 'user', '', 'null', '1'),
(24, 'luthfi', '$2y$10$7xKVWsN9ykLJhtM3Eh3//Olx/wkRHgCLpMwKO.I6YLz9uKPaUavDa', 'active', 'admin', '', '{\"entridata\":\"on\",\"sirkulasi\":\"on\",\"klasifikasi\":\"on\",\"pencipta\":\"on\",\"pengolah\":\"on\",\"lokasi\":\"on\",\"media\":\"on\",\"user\":\"on\",\"import\":\"on\",\"departemen\":\"on\"}', '1');

-- --------------------------------------------------------

--
-- Table structure for table `sirkulasi`
--

CREATE TABLE `sirkulasi` (
  `id` int(11) NOT NULL,
  `noarsip` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `username_peminjam` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `keperluan` text COLLATE utf8_unicode_ci,
  `tgl_pinjam` datetime NOT NULL,
  `tgl_haruskembali` datetime NOT NULL,
  `tgl_pengembalian` datetime DEFAULT NULL,
  `tgl_transaksi` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `sirkulasi`
--

INSERT INTO `sirkulasi` (`id`, `noarsip`, `username_peminjam`, `keperluan`, `tgl_pinjam`, `tgl_haruskembali`, `tgl_pengembalian`, `tgl_transaksi`) VALUES
(15, '123', 'user', 'gak ada bosss', '2018-11-20 00:00:00', '2018-11-22 00:00:00', '2018-11-20 20:56:06', '2018-11-20 12:50:07'),
(20, 'ABC01', 'gustian', 'etah lah', '2018-11-21 00:00:00', '2018-11-22 00:00:00', NULL, '2018-11-21 21:32:33'),
(14, '4567', 'bebal1', 'mau makan iya 1', '2018-11-20 00:00:00', '2018-11-26 00:00:00', '2018-11-20 09:22:44', '2018-11-20 09:09:43');

-- --------------------------------------------------------

--
-- Table structure for table `system_log`
--

CREATE TABLE `system_log` (
  `id` int(11) NOT NULL,
  `kode_transaksi` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `username_transaksi` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `tgl_transaksi` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `visitor_file`
--

CREATE TABLE `visitor_file` (
  `id_visit` int(5) NOT NULL,
  `id_file` int(5) NOT NULL,
  `id_user` int(5) NOT NULL,
  `time_visit` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `visitor_file`
--

INSERT INTO `visitor_file` (`id_visit`, `id_file`, `id_user`, `time_visit`) VALUES
(1, 126, 1, '2018-11-18'),
(2, 127, 1, '2018-11-18'),
(3, 125, 1, '2018-11-18'),
(4, 126, 6, '2018-11-18'),
(5, 125, 6, '2018-11-18'),
(6, 126, 1, '2018-11-18'),
(7, 126, 6, '2018-11-18'),
(8, 126, 1, '2018-11-19'),
(9, 126, 1, '2018-11-19'),
(10, 128, 7, '2018-11-19'),
(11, 126, 6, '2018-11-19'),
(12, 128, 6, '2018-11-19'),
(13, 126, 6, '2018-11-19'),
(14, 127, 1, '2018-11-19'),
(15, 129, 24, '2018-11-19'),
(16, 129, 1, '2018-11-19'),
(17, 126, 1, '2018-11-19'),
(18, 126, 24, '2018-11-19'),
(19, 129, 1, '2018-11-19'),
(20, 129, 24, '2018-11-19'),
(21, 126, 24, '2018-11-19'),
(22, 126, 24, '2018-11-19'),
(23, 127, 1, '2018-11-19'),
(24, 125, 1, '2018-11-19'),
(25, 126, 6, '2018-11-19'),
(26, 128, 1, '2018-11-19'),
(27, 125, 1, '2018-11-19'),
(28, 127, 1, '2018-11-19'),
(29, 126, 1, '2018-11-19'),
(30, 126, 6, '2018-11-19'),
(31, 126, 24, '2018-11-19'),
(32, 129, 24, '2018-11-19'),
(33, 127, 1, '2018-11-19'),
(34, 128, 1, '2018-11-19'),
(35, 126, 24, '2018-11-19'),
(36, 129, 24, '2018-11-19'),
(37, 126, 6, '2018-11-19'),
(38, 126, 6, '2018-11-19'),
(39, 127, 1, '2018-11-19'),
(40, 128, 1, '2018-11-19'),
(41, 126, 24, '2018-11-19'),
(42, 129, 24, '2018-11-19'),
(43, 126, 6, '2018-11-19'),
(44, 126, 1, '2018-11-19'),
(45, 127, 1, '2018-11-19'),
(46, 129, 24, '2018-11-19'),
(47, 126, 24, '2018-11-19'),
(48, 127, 1, '2018-11-19'),
(49, 126, 1, '2018-11-19'),
(50, 126, 24, '2018-11-19'),
(51, 129, 24, '2018-11-19'),
(52, 126, 6, '2018-11-19'),
(53, 126, 24, '2018-11-19'),
(54, 129, 24, '2018-11-19'),
(55, 126, 1, '2018-11-19'),
(56, 125, 1, '2018-11-19'),
(57, 127, 1, '2018-11-19'),
(58, 126, 24, '2018-11-19'),
(59, 129, 24, '2018-11-19'),
(60, 126, 1, '2018-11-19'),
(61, 128, 1, '2018-11-19'),
(62, 142, 1, '2018-11-19'),
(63, 126, 1, '2018-11-19'),
(64, 142, 1, '2018-11-19'),
(65, 145, 24, '2018-11-20'),
(66, 143, 6, '2018-11-20'),
(67, 129, 1, '2018-11-20'),
(68, 129, 24, '2018-11-20'),
(69, 129, 1, '2018-11-20'),
(70, 129, 1, '2018-11-20'),
(71, 129, 6, '2018-11-20'),
(72, 129, 24, '2018-11-20'),
(73, 129, 1, '2018-11-20'),
(74, 129, 6, '2018-11-20'),
(75, 129, 24, '2018-11-20'),
(76, 142, 24, '2018-11-20'),
(77, 129, 24, '2018-11-20'),
(78, 143, 24, '2018-11-20'),
(79, 142, 24, '2018-11-20'),
(80, 146, 24, '2018-11-20'),
(81, 147, 24, '2018-11-20'),
(82, 148, 24, '2018-11-20'),
(83, 149, 24, '2018-11-20'),
(84, 150, 24, '2018-11-20'),
(85, 151, 24, '2018-11-20'),
(86, 152, 24, '2018-11-20'),
(87, 153, 24, '2018-11-20'),
(88, 154, 24, '2018-11-20'),
(89, 155, 24, '2018-11-20'),
(90, 156, 24, '2018-11-20'),
(91, 157, 24, '2018-11-20'),
(92, 158, 24, '2018-11-20'),
(93, 159, 24, '2018-11-20'),
(94, 160, 24, '2018-11-20'),
(95, 161, 24, '2018-11-20'),
(96, 165, 24, '2018-11-20'),
(97, 163, 6, '2018-11-20'),
(98, 165, 24, '2018-11-20'),
(99, 166, 1, '2018-11-20'),
(100, 168, 1, '2018-11-20'),
(101, 168, 1, '2018-11-20'),
(102, 151, 1, '2018-11-20'),
(103, 173, 1, '2018-11-20'),
(104, 165, 1, '2018-11-21'),
(105, 165, 1, '2018-11-21'),
(106, 168, 1, '2018-11-21'),
(107, 168, 1, '2018-11-21'),
(108, 218, 1, '2018-11-21'),
(109, 219, 1, '2018-11-21'),
(110, 220, 1, '2018-11-21'),
(111, 168, 1, '2018-11-21'),
(112, 168, 1, '2018-11-21'),
(113, 168, 1, '2018-11-21'),
(114, 221, 6, '2018-11-21'),
(115, 222, 1, '2018-11-21'),
(116, 223, 1, '2018-11-21');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `data_arsip`
--
ALTER TABLE `data_arsip`
  ADD PRIMARY KEY (`id`),
  ADD KEY `noarsip` (`noarsip`),
  ADD KEY `pencipta` (`pencipta`),
  ADD KEY `unit_pengolah` (`unit_pengolah`);
ALTER TABLE `data_arsip` ADD FULLTEXT KEY `uraian` (`uraian`);

--
-- Indexes for table `master_baris`
--
ALTER TABLE `master_baris`
  ADD PRIMARY KEY (`id_baris`);

--
-- Indexes for table `master_departemen`
--
ALTER TABLE `master_departemen`
  ADD PRIMARY KEY (`id_dep`);

--
-- Indexes for table `master_kode`
--
ALTER TABLE `master_kode`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `kode` (`kode`),
  ADD KEY `nama` (`nama`);

--
-- Indexes for table `master_lantai`
--
ALTER TABLE `master_lantai`
  ADD PRIMARY KEY (`id_lantai`);

--
-- Indexes for table `master_lemari`
--
ALTER TABLE `master_lemari`
  ADD PRIMARY KEY (`id_lemari`) USING BTREE;

--
-- Indexes for table `master_lokasi`
--
ALTER TABLE `master_lokasi`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nama_lokasi` (`nama_lokasi`);

--
-- Indexes for table `master_media`
--
ALTER TABLE `master_media`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nama_media` (`nama_media`);

--
-- Indexes for table `master_pencipta`
--
ALTER TABLE `master_pencipta`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nama_pencipta` (`nama_pencipta`);

--
-- Indexes for table `master_pengolah`
--
ALTER TABLE `master_pengolah`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nama_pengolah` (`nama_pengolah`);

--
-- Indexes for table `master_ruangan`
--
ALTER TABLE `master_ruangan`
  ADD PRIMARY KEY (`id_ruangan`) USING BTREE;

--
-- Indexes for table `master_user`
--
ALTER TABLE `master_user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `sirkulasi`
--
ALTER TABLE `sirkulasi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `noarsip` (`noarsip`),
  ADD KEY `username_peminjam` (`username_peminjam`),
  ADD KEY `tgl_pinjam` (`tgl_pinjam`),
  ADD KEY `tgl_pengembalian` (`tgl_pengembalian`),
  ADD KEY `tgl_haruskembali` (`tgl_haruskembali`);

--
-- Indexes for table `system_log`
--
ALTER TABLE `system_log`
  ADD PRIMARY KEY (`id`),
  ADD KEY `kode_transaksi` (`kode_transaksi`),
  ADD KEY `username_transaksi` (`username_transaksi`),
  ADD KEY `tgl_transaksi` (`tgl_transaksi`);

--
-- Indexes for table `visitor_file`
--
ALTER TABLE `visitor_file`
  ADD PRIMARY KEY (`id_visit`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `data_arsip`
--
ALTER TABLE `data_arsip`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=224;

--
-- AUTO_INCREMENT for table `master_baris`
--
ALTER TABLE `master_baris`
  MODIFY `id_baris` int(254) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `master_departemen`
--
ALTER TABLE `master_departemen`
  MODIFY `id_dep` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `master_kode`
--
ALTER TABLE `master_kode`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `master_lantai`
--
ALTER TABLE `master_lantai`
  MODIFY `id_lantai` int(254) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `master_lemari`
--
ALTER TABLE `master_lemari`
  MODIFY `id_lemari` int(254) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `master_lokasi`
--
ALTER TABLE `master_lokasi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `master_media`
--
ALTER TABLE `master_media`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `master_pencipta`
--
ALTER TABLE `master_pencipta`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `master_pengolah`
--
ALTER TABLE `master_pengolah`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `master_ruangan`
--
ALTER TABLE `master_ruangan`
  MODIFY `id_ruangan` int(254) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `master_user`
--
ALTER TABLE `master_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `sirkulasi`
--
ALTER TABLE `sirkulasi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `visitor_file`
--
ALTER TABLE `visitor_file`
  MODIFY `id_visit` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=117;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
