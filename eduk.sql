-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 05, 2022 at 04:49 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 7.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `eduk`
--

-- --------------------------------------------------------

--
-- Table structure for table `jabatan`
--

CREATE TABLE `jabatan` (
  `jbt_id` int(11) NOT NULL,
  `jbt_nama` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `jabatan`
--

INSERT INTO `jabatan` (`jbt_id`, `jbt_nama`, `created_at`, `updated_at`) VALUES
(1, 'Kepala Badan', '2022-09-19 14:12:18', '2022-09-20 09:20:55');

-- --------------------------------------------------------

--
-- Table structure for table `jabatan_catatan`
--

CREATE TABLE `jabatan_catatan` (
  `jct_id` int(11) NOT NULL,
  `id_jabatan` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `jct_tmt` date NOT NULL,
  `jct_skjabatan` varchar(500) NOT NULL,
  `jct_status` varchar(255) NOT NULL,
  `jct_keterangan` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `jabatan_catatan`
--

INSERT INTO `jabatan_catatan` (`jct_id`, `id_jabatan`, `id_user`, `jct_tmt`, `jct_skjabatan`, `jct_status`, `jct_keterangan`, `created_at`, `updated_at`) VALUES
(2, 1, 1, '2022-09-23', 'item-220923-d64a2fb9ec.pdf', 'Aktif', 'Kenaikan Jabatan', '2022-09-23 11:13:01', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `kgaji_catatan`
--

CREATE TABLE `kgaji_catatan` (
  `gct_id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `gct_tmt` date NOT NULL,
  `gct_skkenaikangaji` varchar(500) NOT NULL,
  `gct_tgl_naikgaji` date DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kgaji_catatan`
--

INSERT INTO `kgaji_catatan` (`gct_id`, `id_user`, `gct_tmt`, `gct_skkenaikangaji`, `gct_tgl_naikgaji`, `created_at`, `updated_at`) VALUES
(2, 1, '2021-01-03', 'item-220927-0e0af323b9.pdf', '2023-01-03', '2022-09-27 10:32:17', '0000-00-00 00:00:00'),
(3, 3, '2021-01-03', 'item-221003-a33c726ff6.pdf', '2023-01-03', '2022-10-03 09:11:46', '2022-10-03 09:19:28');

-- --------------------------------------------------------

--
-- Table structure for table `lampiran_catatan`
--

CREATE TABLE `lampiran_catatan` (
  `lam_id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `lam_nama` varchar(500) NOT NULL,
  `lam_dokumen` varchar(500) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `lampiran_catatan`
--

INSERT INTO `lampiran_catatan` (`lam_id`, `id_user`, `lam_nama`, `lam_dokumen`, `created_at`, `updated_at`) VALUES
(3, 1, 'SK CPNS', 'item-221003-de819c6f71.pdf', '2022-10-03 15:05:11', '2022-10-03 15:08:20');

-- --------------------------------------------------------

--
-- Table structure for table `mutasi_catatan`
--

CREATE TABLE `mutasi_catatan` (
  `mct_id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `mct_catatan` varchar(500) NOT NULL,
  `mct_tgl_mutasi` date NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `mutasi_catatan`
--

INSERT INTO `mutasi_catatan` (`mct_id`, `id_user`, `mct_catatan`, `mct_tgl_mutasi`, `created_at`, `updated_at`) VALUES
(3, 1, 'Persaingan Politik', '2022-09-28', '2022-09-28 10:37:26', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `pangkat`
--

CREATE TABLE `pangkat` (
  `pkt_id` int(11) NOT NULL,
  `pkt_nama` varchar(255) NOT NULL,
  `pkt_golongan` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pangkat`
--

INSERT INTO `pangkat` (`pkt_id`, `pkt_nama`, `pkt_golongan`, `created_at`, `updated_at`) VALUES
(2, 'Pembina Muda', 'II/A', '2022-09-19 12:26:16', '2022-09-19 12:28:43');

-- --------------------------------------------------------

--
-- Table structure for table `pangkat_catatan`
--

CREATE TABLE `pangkat_catatan` (
  `pct_id` int(11) NOT NULL,
  `id_pangkat` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `pct_tmt` date NOT NULL,
  `pct_skpangkat` varchar(500) NOT NULL,
  `pct_status` varchar(255) NOT NULL,
  `pct_tgl_naikpangkat` date DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pangkat_catatan`
--

INSERT INTO `pangkat_catatan` (`pct_id`, `id_pangkat`, `id_user`, `pct_tmt`, `pct_skpangkat`, `pct_status`, `pct_tgl_naikpangkat`, `created_at`, `updated_at`) VALUES
(16, 2, 1, '2019-01-15', 'item-221002-ce43b60d9c.pdf', 'Aktif', '2023-01-15', '2022-10-02 23:26:42', '2022-10-02 23:34:24'),
(17, 2, 4, '2019-01-03', 'item-221003-28df6afebe.pdf', 'Aktif', '2023-01-03', '2022-10-02 23:28:36', '2022-10-03 09:02:10'),
(18, 2, 3, '2019-01-03', 'item-221002-e7b1afab9f.pdf', 'Aktif', '2023-01-03', '2022-10-02 23:29:19', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `pelatihan`
--

CREATE TABLE `pelatihan` (
  `plt_id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `plt_nama` varchar(255) NOT NULL,
  `plt_tgl_pelatihan` date NOT NULL,
  `plt_sertifikat` varchar(500) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pelatihan`
--

INSERT INTO `pelatihan` (`plt_id`, `id_user`, `plt_nama`, `plt_tgl_pelatihan`, `plt_sertifikat`, `created_at`, `updated_at`) VALUES
(4, 1, 'DIKLAT PIM II', '2022-09-21', 'item-220922-7021f595b7.pdf', '2022-09-21 00:39:20', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `pendidikan`
--

CREATE TABLE `pendidikan` (
  `pd_id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `pd_jenjang_pendidikan` varchar(255) NOT NULL,
  `pd_nama` varchar(255) NOT NULL,
  `pd_tahun_lulus` varchar(255) NOT NULL,
  `pd_ijazah` varchar(500) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pendidikan`
--

INSERT INTO `pendidikan` (`pd_id`, `id_user`, `pd_jenjang_pendidikan`, `pd_nama`, `pd_tahun_lulus`, `pd_ijazah`, `created_at`, `updated_at`) VALUES
(8, 1, 'Sarjana', 'UIR', '2020', 'item-220922-0a88d671eb.pdf', '2022-09-22 11:56:01', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `usr_id` int(11) NOT NULL,
  `usr_username` varchar(255) NOT NULL,
  `usr_password` varchar(255) NOT NULL,
  `usr_nama` varchar(100) NOT NULL,
  `usr_level` enum('Admin','User') NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`usr_id`, `usr_username`, `usr_password`, `usr_nama`, `usr_level`, `created_at`, `updated_at`) VALUES
(1, 'admin', '$2y$10$J9f8U7KiXnQ0BeM3Jl5DhuANl3Oawu57P6N2z8w3kaGhTl/5kGeUO', 'Jimmy Arianda Bahari', 'Admin', NULL, NULL),
(3, '1111111111', '$2y$10$NCcrA7UCBgvb0F8VfoAbieVm..iqLDNIe//mlnQyDDSoVR8ornmJS', 'Chandra Ade Syahroni', 'User', '2022-09-28 13:55:50', NULL),
(4, '2323', '$2y$10$dvtuLJpmOe0QihYHCk1b0.0kPSf4g5uD/DiSvGsRaNvRuKZZboniq', 'Rinaldi', 'User', '2022-10-02 23:27:12', NULL);

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_jabatan_catatan`
-- (See below for the actual view)
--
CREATE TABLE `view_jabatan_catatan` (
`jct_id` int(11)
,`jbt_nama` varchar(255)
,`usr_nama` varchar(100)
,`jct_tmt` date
,`jct_skjabatan` varchar(500)
,`jct_status` varchar(255)
,`jct_keterangan` varchar(255)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_kgaji_catatan`
-- (See below for the actual view)
--
CREATE TABLE `view_kgaji_catatan` (
`gct_id` int(11)
,`usr_nama` varchar(100)
,`gct_tmt` date
,`gct_skkenaikangaji` varchar(500)
,`gct_tgl_naikgaji` date
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_lampiran_catatan`
-- (See below for the actual view)
--
CREATE TABLE `view_lampiran_catatan` (
`lam_id` int(11)
,`usr_nama` varchar(100)
,`lam_nama` varchar(500)
,`lam_dokumen` varchar(500)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_mutasi_catatan`
-- (See below for the actual view)
--
CREATE TABLE `view_mutasi_catatan` (
`mct_id` int(11)
,`usr_nama` varchar(100)
,`mct_catatan` varchar(500)
,`mct_tgl_mutasi` date
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_pangkat_catatan`
-- (See below for the actual view)
--
CREATE TABLE `view_pangkat_catatan` (
`pct_id` int(11)
,`pkt_nama` varchar(255)
,`usr_nama` varchar(100)
,`pct_tmt` date
,`pct_skpangkat` varchar(500)
,`pct_status` varchar(255)
,`pct_tgl_naikpangkat` date
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_pelatihan`
-- (See below for the actual view)
--
CREATE TABLE `view_pelatihan` (
`plt_id` int(11)
,`usr_id` int(11)
,`plt_nama` varchar(255)
,`plt_tgl_pelatihan` date
,`plt_sertifikat` varchar(500)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_pendidikan`
-- (See below for the actual view)
--
CREATE TABLE `view_pendidikan` (
`pd_id` int(11)
,`id_user` int(11)
,`usr_nama` varchar(100)
,`pd_jenjang_pendidikan` varchar(255)
,`pd_nama` varchar(255)
,`pd_tahun_lulus` varchar(255)
,`pd_ijazah` varchar(500)
);

-- --------------------------------------------------------

--
-- Structure for view `view_jabatan_catatan`
--
DROP TABLE IF EXISTS `view_jabatan_catatan`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_jabatan_catatan`  AS SELECT `jc`.`jct_id` AS `jct_id`, `j`.`jbt_nama` AS `jbt_nama`, `u`.`usr_nama` AS `usr_nama`, `jc`.`jct_tmt` AS `jct_tmt`, `jc`.`jct_skjabatan` AS `jct_skjabatan`, `jc`.`jct_status` AS `jct_status`, `jc`.`jct_keterangan` AS `jct_keterangan` FROM ((`jabatan_catatan` `jc` join `jabatan` `j` on(`jc`.`id_jabatan` = `j`.`jbt_id`)) join `user` `u` on(`jc`.`id_user` = `u`.`usr_id`)) ;

-- --------------------------------------------------------

--
-- Structure for view `view_kgaji_catatan`
--
DROP TABLE IF EXISTS `view_kgaji_catatan`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_kgaji_catatan`  AS SELECT `kgc`.`gct_id` AS `gct_id`, `u`.`usr_nama` AS `usr_nama`, `kgc`.`gct_tmt` AS `gct_tmt`, `kgc`.`gct_skkenaikangaji` AS `gct_skkenaikangaji`, `kgc`.`gct_tgl_naikgaji` AS `gct_tgl_naikgaji` FROM (`kgaji_catatan` `kgc` join `user` `u` on(`kgc`.`id_user` = `u`.`usr_id`)) ;

-- --------------------------------------------------------

--
-- Structure for view `view_lampiran_catatan`
--
DROP TABLE IF EXISTS `view_lampiran_catatan`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_lampiran_catatan`  AS SELECT `lc`.`lam_id` AS `lam_id`, `u`.`usr_nama` AS `usr_nama`, `lc`.`lam_nama` AS `lam_nama`, `lc`.`lam_dokumen` AS `lam_dokumen` FROM (`lampiran_catatan` `lc` join `user` `u` on(`lc`.`id_user` = `u`.`usr_id`)) ;

-- --------------------------------------------------------

--
-- Structure for view `view_mutasi_catatan`
--
DROP TABLE IF EXISTS `view_mutasi_catatan`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_mutasi_catatan`  AS SELECT `mc`.`mct_id` AS `mct_id`, `u`.`usr_nama` AS `usr_nama`, `mc`.`mct_catatan` AS `mct_catatan`, `mc`.`mct_tgl_mutasi` AS `mct_tgl_mutasi` FROM (`mutasi_catatan` `mc` join `user` `u` on(`mc`.`id_user` = `u`.`usr_id`)) ;

-- --------------------------------------------------------

--
-- Structure for view `view_pangkat_catatan`
--
DROP TABLE IF EXISTS `view_pangkat_catatan`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_pangkat_catatan`  AS SELECT `pc`.`pct_id` AS `pct_id`, `p`.`pkt_nama` AS `pkt_nama`, `u`.`usr_nama` AS `usr_nama`, `pc`.`pct_tmt` AS `pct_tmt`, `pc`.`pct_skpangkat` AS `pct_skpangkat`, `pc`.`pct_status` AS `pct_status`, `pc`.`pct_tgl_naikpangkat` AS `pct_tgl_naikpangkat` FROM ((`pangkat_catatan` `pc` join `pangkat` `p` on(`pc`.`id_pangkat` = `p`.`pkt_id`)) join `user` `u` on(`pc`.`id_user` = `u`.`usr_id`)) ;

-- --------------------------------------------------------

--
-- Structure for view `view_pelatihan`
--
DROP TABLE IF EXISTS `view_pelatihan`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_pelatihan`  AS SELECT `p`.`plt_id` AS `plt_id`, `u`.`usr_id` AS `usr_id`, `p`.`plt_nama` AS `plt_nama`, `p`.`plt_tgl_pelatihan` AS `plt_tgl_pelatihan`, `p`.`plt_sertifikat` AS `plt_sertifikat` FROM (`pelatihan` `p` join `user` `u` on(`p`.`id_user` = `u`.`usr_id`)) ;

-- --------------------------------------------------------

--
-- Structure for view `view_pendidikan`
--
DROP TABLE IF EXISTS `view_pendidikan`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_pendidikan`  AS SELECT `p`.`pd_id` AS `pd_id`, `p`.`id_user` AS `id_user`, `u`.`usr_nama` AS `usr_nama`, `p`.`pd_jenjang_pendidikan` AS `pd_jenjang_pendidikan`, `p`.`pd_nama` AS `pd_nama`, `p`.`pd_tahun_lulus` AS `pd_tahun_lulus`, `p`.`pd_ijazah` AS `pd_ijazah` FROM (`pendidikan` `p` join `user` `u` on(`p`.`id_user` = `u`.`usr_id`)) ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `jabatan`
--
ALTER TABLE `jabatan`
  ADD PRIMARY KEY (`jbt_id`);

--
-- Indexes for table `jabatan_catatan`
--
ALTER TABLE `jabatan_catatan`
  ADD PRIMARY KEY (`jct_id`),
  ADD KEY `id_jabatan` (`id_jabatan`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `kgaji_catatan`
--
ALTER TABLE `kgaji_catatan`
  ADD PRIMARY KEY (`gct_id`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `lampiran_catatan`
--
ALTER TABLE `lampiran_catatan`
  ADD PRIMARY KEY (`lam_id`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `mutasi_catatan`
--
ALTER TABLE `mutasi_catatan`
  ADD PRIMARY KEY (`mct_id`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `pangkat`
--
ALTER TABLE `pangkat`
  ADD PRIMARY KEY (`pkt_id`);

--
-- Indexes for table `pangkat_catatan`
--
ALTER TABLE `pangkat_catatan`
  ADD PRIMARY KEY (`pct_id`),
  ADD KEY `id_pangkat` (`id_pangkat`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_pangkat_2` (`id_pangkat`),
  ADD KEY `id_user_2` (`id_user`);

--
-- Indexes for table `pelatihan`
--
ALTER TABLE `pelatihan`
  ADD PRIMARY KEY (`plt_id`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `pendidikan`
--
ALTER TABLE `pendidikan`
  ADD PRIMARY KEY (`pd_id`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`usr_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `jabatan`
--
ALTER TABLE `jabatan`
  MODIFY `jbt_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `jabatan_catatan`
--
ALTER TABLE `jabatan_catatan`
  MODIFY `jct_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `kgaji_catatan`
--
ALTER TABLE `kgaji_catatan`
  MODIFY `gct_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `lampiran_catatan`
--
ALTER TABLE `lampiran_catatan`
  MODIFY `lam_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `mutasi_catatan`
--
ALTER TABLE `mutasi_catatan`
  MODIFY `mct_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `pangkat`
--
ALTER TABLE `pangkat`
  MODIFY `pkt_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `pangkat_catatan`
--
ALTER TABLE `pangkat_catatan`
  MODIFY `pct_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `pelatihan`
--
ALTER TABLE `pelatihan`
  MODIFY `plt_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `pendidikan`
--
ALTER TABLE `pendidikan`
  MODIFY `pd_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `usr_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `jabatan_catatan`
--
ALTER TABLE `jabatan_catatan`
  ADD CONSTRAINT `jabatancatatan_fk1` FOREIGN KEY (`id_jabatan`) REFERENCES `jabatan` (`jbt_id`),
  ADD CONSTRAINT `jabatancatatan_fk2` FOREIGN KEY (`id_user`) REFERENCES `user` (`usr_id`);

--
-- Constraints for table `kgaji_catatan`
--
ALTER TABLE `kgaji_catatan`
  ADD CONSTRAINT `kgaji_catatan_fk1` FOREIGN KEY (`id_user`) REFERENCES `user` (`usr_id`);

--
-- Constraints for table `lampiran_catatan`
--
ALTER TABLE `lampiran_catatan`
  ADD CONSTRAINT `lampirancatatan_fk1` FOREIGN KEY (`id_user`) REFERENCES `user` (`usr_id`);

--
-- Constraints for table `mutasi_catatan`
--
ALTER TABLE `mutasi_catatan`
  ADD CONSTRAINT `mutasicatatan_fk1` FOREIGN KEY (`id_user`) REFERENCES `user` (`usr_id`);

--
-- Constraints for table `pangkat_catatan`
--
ALTER TABLE `pangkat_catatan`
  ADD CONSTRAINT `pangkatctt_fk1` FOREIGN KEY (`id_pangkat`) REFERENCES `pangkat` (`pkt_id`),
  ADD CONSTRAINT `pangkatctt_fk2` FOREIGN KEY (`id_user`) REFERENCES `user` (`usr_id`);

--
-- Constraints for table `pelatihan`
--
ALTER TABLE `pelatihan`
  ADD CONSTRAINT `pelatihan_fk1` FOREIGN KEY (`id_user`) REFERENCES `user` (`usr_id`);

--
-- Constraints for table `pendidikan`
--
ALTER TABLE `pendidikan`
  ADD CONSTRAINT `pendidikan_fk1` FOREIGN KEY (`id_user`) REFERENCES `user` (`usr_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
