-- phpMyAdmin SQL Dump
-- version 4.4.9
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 19, 2016 at 06:38 
-- Server version: 5.6.21
-- PHP Version: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `rpl`
--

-- --------------------------------------------------------

--
-- Table structure for table `guestbook`
--

CREATE TABLE IF NOT EXISTS `guestbook` (
  `id_guest` int(5) NOT NULL,
  `name` varchar(30) NOT NULL,
  `email` varchar(50) NOT NULL,
  `comment` text NOT NULL,
  `status` int(1) NOT NULL DEFAULT '0',
  `datetime` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tb_admin`
--

CREATE TABLE IF NOT EXISTS `tb_admin` (
  `id_admin` varchar(8) NOT NULL,
  `password` varchar(32) NOT NULL,
  `nama` varchar(30) NOT NULL,
  `alamat` varchar(30) NOT NULL,
  `no_hp` char(13) NOT NULL,
  `img` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_admin`
--

INSERT INTO `tb_admin` (`id_admin`, `password`, `nama`, `alamat`, `no_hp`, `img`) VALUES
('admin', 'pulu', 'Anggraini', 'Ngentak', '08716316383', 'CYMERA_20141229_222635.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `tb_detail_pesan`
--

CREATE TABLE IF NOT EXISTS `tb_detail_pesan` (
  `id_detail_pesan` int(10) NOT NULL,
  `id_pemesanan` int(8) NOT NULL,
  `nama_kelas` varchar(15) NOT NULL,
  `jumlah` int(2) NOT NULL,
  `harga_satuan` int(7) NOT NULL,
  `total_harga` int(7) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tb_eksekutif`
--

CREATE TABLE IF NOT EXISTS `tb_eksekutif` (
  `id_eksekutif` varchar(15) NOT NULL,
  `password` varchar(32) NOT NULL,
  `nama` varchar(30) NOT NULL,
  `alamat` varchar(30) NOT NULL,
  `no_hp` char(13) NOT NULL,
  `img` varchar(75) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_eksekutif`
--

INSERT INTO `tb_eksekutif` (`id_eksekutif`, `password`, `nama`, `alamat`, `no_hp`, `img`) VALUES
('EKSE', '123456', 'Pengelola Maguwo', 'Maguwoharjo', '019371371', 'DSC_0502.JPG');

-- --------------------------------------------------------

--
-- Table structure for table `tb_jadwal`
--

CREATE TABLE IF NOT EXISTS `tb_jadwal` (
  `id_jadwal` int(5) NOT NULL,
  `id_tim1` int(4) NOT NULL,
  `id_tim2` int(4) NOT NULL,
  `tanggal` date NOT NULL,
  `jam` time NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_jadwal`
--

INSERT INTO `tb_jadwal` (`id_jadwal`, `id_tim1`, `id_tim2`, `tanggal`, `jam`) VALUES
(2, 1, 2, '2016-12-07', '15:30:00'),
(3, 1, 3, '2016-12-08', '01:00:00'),
(4, 3, 4, '2016-12-08', '15:30:00'),
(5, 2, 3, '2016-02-08', '13:00:00'),
(6, 1, 2, '2016-12-14', '20:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `tb_jadwal_kelas`
--

CREATE TABLE IF NOT EXISTS `tb_jadwal_kelas` (
  `id_jadwal_kls` int(11) NOT NULL,
  `id_jadwal` int(5) NOT NULL,
  `id_kelas` int(5) NOT NULL,
  `stock_awal` int(5) NOT NULL,
  `harga` int(7) NOT NULL,
  `terjual` int(5) NOT NULL,
  `stock_akhir` int(5) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_jadwal_kelas`
--

INSERT INTO `tb_jadwal_kelas` (`id_jadwal_kls`, `id_jadwal`, `id_kelas`, `stock_awal`, `harga`, `terjual`, `stock_akhir`) VALUES
(2, 2, 3, 5000, 20000, 0, 5000),
(3, 2, 3, 5000, 30000, 0, 5000),
(4, 2, 2, 3000, 5000, 0, 3000),
(5, 3, 2, 50000, 500000, 0, 50000),
(6, 4, 3, 5000, 30000, 0, 5000),
(7, 5, 3, 500, 20000, 0, 500),
(8, 6, 2, 500, 30000, 0, 500);

-- --------------------------------------------------------

--
-- Table structure for table `tb_kelas`
--

CREATE TABLE IF NOT EXISTS `tb_kelas` (
  `id_kelas` int(5) NOT NULL,
  `nama_kelas` varchar(15) NOT NULL,
  `max_kuota` int(4) NOT NULL,
  `def_harga` int(6) NOT NULL,
  `flag_kelas` int(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_kelas`
--

INSERT INTO `tb_kelas` (`id_kelas`, `nama_kelas`, `max_kuota`, `def_harga`, `flag_kelas`) VALUES
(2, 'VIP', 5000, 50000, 0),
(3, 'Class I', 5000, 35000, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tb_login`
--

CREATE TABLE IF NOT EXISTS `tb_login` (
  `username` varchar(15) NOT NULL,
  `password` varchar(75) NOT NULL,
  `stts` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_login`
--

INSERT INTO `tb_login` (`username`, `password`, `stts`) VALUES
('admin', 'd1d6d0a6d5cefb2241bedf703bcf00da', 'admin'),
('EKSE', 'e10adc3949ba59abbe56e057f20f883e', 'eksekutif'),
('holaholopulu', 'e10adc3949ba59abbe56e057f20f883e', 'member'),
('OP1', '5cca05790f375f4ca4650a6b1586ce4f', 'operator'),
('OP3', 'e10adc3949ba59abbe56e057f20f883e', 'operator'),
('puluneko', '77bb8056dc29cb9e6847f7c6d06d032d', 'member');

-- --------------------------------------------------------

--
-- Table structure for table `tb_member`
--

CREATE TABLE IF NOT EXISTS `tb_member` (
  `id_member` varchar(15) NOT NULL,
  `password` varchar(32) NOT NULL,
  `nama` varchar(30) NOT NULL,
  `alamat` varchar(75) NOT NULL,
  `img` varchar(45) NOT NULL,
  `no_hp` char(13) NOT NULL,
  `email` varchar(30) NOT NULL,
  `saldo` int(7) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_member`
--

INSERT INTO `tb_member` (`id_member`, `password`, `nama`, `alamat`, `img`, `no_hp`, `email`, `saldo`) VALUES
('holaholopulu', '123456', 'Anggraini', 'Ngentak', 'geeky-pinas-mi4i.png', '088391391313', 'rain.aini@gmail.com', 0),
('puluneko', '5136153', '763716', '381318', 'DSC_05061.JPG', '73671', '6368', 378372);

-- --------------------------------------------------------

--
-- Table structure for table `tb_nota`
--

CREATE TABLE IF NOT EXISTS `tb_nota` (
  `id_nota` int(8) NOT NULL,
  `id_topup` int(5) NOT NULL,
  `saldo_sebelum` int(8) NOT NULL,
  `saldo_akhir` int(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tb_operator`
--

CREATE TABLE IF NOT EXISTS `tb_operator` (
  `id_operator` varchar(8) NOT NULL,
  `password` varchar(32) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `alamat` varchar(75) NOT NULL,
  `no_hp` char(13) NOT NULL,
  `img` varchar(75) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_operator`
--

INSERT INTO `tb_operator` (`id_operator`, `password`, `nama`, `alamat`, `no_hp`, `img`) VALUES
('OP1', '123456hjhjh', 'Anggraini Diah P', 'Mbuh', '0988482642', 'DSC_06432.JPG'),
('OP2', '123456', 'Pulu', 'hahaha', '039273272', 'DSC_0506.JPG'),
('OP3', '123456', 'Andi Gustanto', 'Jl.Gito Gati', '08939711', 'DSC_0643.JPG');

-- --------------------------------------------------------

--
-- Table structure for table `tb_pemesanan`
--

CREATE TABLE IF NOT EXISTS `tb_pemesanan` (
  `id_pemesanan` int(8) NOT NULL,
  `id_member` char(15) NOT NULL,
  `id_jadwal` int(5) NOT NULL,
  `grand_total` int(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tb_pesan_report`
--

CREATE TABLE IF NOT EXISTS `tb_pesan_report` (
  `id_pesan_report` int(5) NOT NULL,
  `id_report` int(5) NOT NULL,
  `id_pemesanan` int(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tb_report`
--

CREATE TABLE IF NOT EXISTS `tb_report` (
  `id_report` int(5) NOT NULL,
  `nama_report` varchar(30) NOT NULL,
  `tanggal` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `total` int(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tb_tiket`
--

CREATE TABLE IF NOT EXISTS `tb_tiket` (
  `id_tiket` int(8) NOT NULL,
  `no_tiket` int(8) NOT NULL,
  `id_pemesanan` int(8) NOT NULL,
  `tim_home` varchar(10) NOT NULL,
  `tim_away` varchar(10) NOT NULL,
  `class` varchar(10) NOT NULL,
  `tanggal_tiket` date NOT NULL,
  `jam_tiket` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tb_tim`
--

CREATE TABLE IF NOT EXISTS `tb_tim` (
  `id_tim` int(4) NOT NULL,
  `kode_tim` varchar(10) NOT NULL,
  `nama_tim` varchar(50) NOT NULL,
  `asal_tim` varchar(30) NOT NULL,
  `img` varchar(75) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_tim`
--

INSERT INTO `tb_tim` (`id_tim`, `kode_tim`, `nama_tim`, `asal_tim`, `img`) VALUES
(1, 'PSS', 'Persatuan Sepak Bola Sleman', 'Sleman', 'PSS_logo.png'),
(2, 'PSIM', 'Persatuan Sepak Bola Indonesia Mataram', 'Yogyakarta', 'PSIM.png'),
(3, 'PERSIBA', 'Persatuan Sepak bola Indonesia Bantul', 'Bantul, Yogyakarta', 'Logo_persiba.png'),
(4, 'PERSIJA', 'Persatuan Sepak Bola Indonesia Jakarta', 'Jakarta', 'Logo_Persija.png');

-- --------------------------------------------------------

--
-- Table structure for table `tb_topup`
--

CREATE TABLE IF NOT EXISTS `tb_topup` (
  `id_topup` int(8) NOT NULL,
  `id_member` varchar(8) NOT NULL,
  `id_operator` varchar(8) NOT NULL,
  `jumlah_topup` int(7) NOT NULL,
  `tanggal` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tb_topup_report`
--

CREATE TABLE IF NOT EXISTS `tb_topup_report` (
  `id_topup_report` int(5) NOT NULL,
  `id_report` int(5) NOT NULL,
  `id_topup` int(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `guestbook`
--
ALTER TABLE `guestbook`
  ADD PRIMARY KEY (`id_guest`),
  ADD KEY `id_guest` (`id_guest`,`name`,`email`,`status`,`datetime`);

--
-- Indexes for table `tb_admin`
--
ALTER TABLE `tb_admin`
  ADD PRIMARY KEY (`id_admin`),
  ADD KEY `id_admin` (`id_admin`,`password`,`nama`,`alamat`,`no_hp`),
  ADD KEY `id_admin_2` (`id_admin`,`password`,`nama`,`alamat`,`no_hp`,`img`);

--
-- Indexes for table `tb_detail_pesan`
--
ALTER TABLE `tb_detail_pesan`
  ADD PRIMARY KEY (`id_detail_pesan`),
  ADD KEY `id_pesan_kelas` (`id_detail_pesan`,`id_pemesanan`,`nama_kelas`,`jumlah`),
  ADD KEY `id_pemesanan` (`id_pemesanan`),
  ADD KEY `id_kelas_harga` (`nama_kelas`),
  ADD KEY `id_pesan_kelas_2` (`id_detail_pesan`,`id_pemesanan`,`nama_kelas`,`jumlah`);

--
-- Indexes for table `tb_eksekutif`
--
ALTER TABLE `tb_eksekutif`
  ADD PRIMARY KEY (`id_eksekutif`),
  ADD KEY `id_eksekutif` (`id_eksekutif`,`password`,`nama`,`alamat`,`no_hp`),
  ADD KEY `id_eksekutif_2` (`id_eksekutif`,`password`,`nama`,`alamat`,`no_hp`,`img`);

--
-- Indexes for table `tb_jadwal`
--
ALTER TABLE `tb_jadwal`
  ADD PRIMARY KEY (`id_jadwal`),
  ADD KEY `id_jadwal` (`id_jadwal`,`id_tim1`,`id_tim2`,`tanggal`,`jam`),
  ADD KEY `id_tim1` (`id_tim1`),
  ADD KEY `id_tim2` (`id_tim2`),
  ADD KEY `id_jadwal_2` (`id_jadwal`,`id_tim1`,`id_tim2`,`tanggal`,`jam`),
  ADD KEY `id_jadwal_3` (`id_jadwal`,`id_tim1`,`id_tim2`,`tanggal`,`jam`);

--
-- Indexes for table `tb_jadwal_kelas`
--
ALTER TABLE `tb_jadwal_kelas`
  ADD PRIMARY KEY (`id_jadwal_kls`),
  ADD KEY `id_jadwal_kls` (`id_jadwal_kls`,`id_jadwal`,`id_kelas`,`stock_awal`,`terjual`,`stock_akhir`),
  ADD KEY `id_kelas` (`id_kelas`),
  ADD KEY `id_jadwal` (`id_jadwal`);

--
-- Indexes for table `tb_kelas`
--
ALTER TABLE `tb_kelas`
  ADD PRIMARY KEY (`id_kelas`),
  ADD KEY `id_kelas_harga` (`id_kelas`,`nama_kelas`),
  ADD KEY `id_kelas` (`id_kelas`,`nama_kelas`,`max_kuota`,`def_harga`,`flag_kelas`);

--
-- Indexes for table `tb_login`
--
ALTER TABLE `tb_login`
  ADD PRIMARY KEY (`username`),
  ADD KEY `username` (`username`,`password`,`stts`);

--
-- Indexes for table `tb_member`
--
ALTER TABLE `tb_member`
  ADD PRIMARY KEY (`id_member`),
  ADD KEY `id_member` (`id_member`,`password`,`nama`,`alamat`,`no_hp`,`email`,`saldo`),
  ADD KEY `id_member_2` (`id_member`,`password`,`nama`,`alamat`,`no_hp`,`email`,`saldo`),
  ADD KEY `id_member_3` (`id_member`,`password`,`nama`,`alamat`,`img`,`no_hp`,`email`,`saldo`);

--
-- Indexes for table `tb_nota`
--
ALTER TABLE `tb_nota`
  ADD PRIMARY KEY (`id_nota`),
  ADD KEY `id_nota` (`id_nota`,`id_topup`),
  ADD KEY `id_topup` (`id_topup`),
  ADD KEY `id_nota_2` (`id_nota`,`id_topup`);

--
-- Indexes for table `tb_operator`
--
ALTER TABLE `tb_operator`
  ADD PRIMARY KEY (`id_operator`),
  ADD KEY `id_operator` (`id_operator`,`password`,`nama`,`alamat`,`no_hp`),
  ADD KEY `id_operator_2` (`id_operator`,`password`,`nama`,`alamat`,`no_hp`,`img`);

--
-- Indexes for table `tb_pemesanan`
--
ALTER TABLE `tb_pemesanan`
  ADD PRIMARY KEY (`id_pemesanan`),
  ADD KEY `id_pemesanan` (`id_pemesanan`,`id_member`,`id_jadwal`),
  ADD KEY `id_member` (`id_member`),
  ADD KEY `id_jadwal` (`id_jadwal`),
  ADD KEY `id_pemesanan_2` (`id_pemesanan`,`id_member`,`id_jadwal`);

--
-- Indexes for table `tb_pesan_report`
--
ALTER TABLE `tb_pesan_report`
  ADD PRIMARY KEY (`id_pesan_report`),
  ADD KEY `id_pesan_report` (`id_pesan_report`,`id_report`,`id_pemesanan`),
  ADD KEY `id_report` (`id_report`),
  ADD KEY `id_pemesanan` (`id_pemesanan`),
  ADD KEY `id_pesan_report_2` (`id_pesan_report`,`id_report`,`id_pemesanan`),
  ADD KEY `id_pesan_report_3` (`id_pesan_report`,`id_report`,`id_pemesanan`);

--
-- Indexes for table `tb_report`
--
ALTER TABLE `tb_report`
  ADD PRIMARY KEY (`id_report`),
  ADD KEY `id_report` (`id_report`),
  ADD KEY `id_report_2` (`id_report`,`nama_report`,`tanggal`),
  ADD KEY `id_report_3` (`id_report`,`nama_report`,`tanggal`,`total`);

--
-- Indexes for table `tb_tiket`
--
ALTER TABLE `tb_tiket`
  ADD PRIMARY KEY (`id_tiket`),
  ADD KEY `id_tiket` (`id_tiket`,`id_pemesanan`),
  ADD KEY `id_pemesanan` (`id_pemesanan`),
  ADD KEY `id_tiket_2` (`id_tiket`,`id_pemesanan`);

--
-- Indexes for table `tb_tim`
--
ALTER TABLE `tb_tim`
  ADD PRIMARY KEY (`id_tim`),
  ADD KEY `id_tim` (`id_tim`,`nama_tim`,`asal_tim`),
  ADD KEY `id_tim_2` (`id_tim`,`kode_tim`,`nama_tim`,`asal_tim`,`img`);

--
-- Indexes for table `tb_topup`
--
ALTER TABLE `tb_topup`
  ADD PRIMARY KEY (`id_topup`),
  ADD KEY `id_topup` (`id_topup`,`id_member`,`id_operator`,`jumlah_topup`,`tanggal`),
  ADD KEY `id_operator` (`id_operator`),
  ADD KEY `id_member` (`id_member`),
  ADD KEY `id_topup_2` (`id_topup`,`id_member`,`id_operator`,`jumlah_topup`,`tanggal`);

--
-- Indexes for table `tb_topup_report`
--
ALTER TABLE `tb_topup_report`
  ADD PRIMARY KEY (`id_topup_report`),
  ADD KEY `id_topup_report` (`id_topup_report`,`id_report`,`id_topup`),
  ADD KEY `id_topup` (`id_topup`),
  ADD KEY `id_report` (`id_report`),
  ADD KEY `id_topup_report_2` (`id_topup_report`,`id_report`,`id_topup`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `guestbook`
--
ALTER TABLE `guestbook`
  MODIFY `id_guest` int(5) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tb_detail_pesan`
--
ALTER TABLE `tb_detail_pesan`
  MODIFY `id_detail_pesan` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tb_jadwal`
--
ALTER TABLE `tb_jadwal`
  MODIFY `id_jadwal` int(5) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `tb_jadwal_kelas`
--
ALTER TABLE `tb_jadwal_kelas`
  MODIFY `id_jadwal_kls` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `tb_kelas`
--
ALTER TABLE `tb_kelas`
  MODIFY `id_kelas` int(5) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `tb_nota`
--
ALTER TABLE `tb_nota`
  MODIFY `id_nota` int(8) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tb_pemesanan`
--
ALTER TABLE `tb_pemesanan`
  MODIFY `id_pemesanan` int(8) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tb_pesan_report`
--
ALTER TABLE `tb_pesan_report`
  MODIFY `id_pesan_report` int(5) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tb_report`
--
ALTER TABLE `tb_report`
  MODIFY `id_report` int(5) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tb_tiket`
--
ALTER TABLE `tb_tiket`
  MODIFY `id_tiket` int(8) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tb_tim`
--
ALTER TABLE `tb_tim`
  MODIFY `id_tim` int(4) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `tb_topup`
--
ALTER TABLE `tb_topup`
  MODIFY `id_topup` int(8) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tb_topup_report`
--
ALTER TABLE `tb_topup_report`
  MODIFY `id_topup_report` int(5) NOT NULL AUTO_INCREMENT;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `tb_detail_pesan`
--
ALTER TABLE `tb_detail_pesan`
  ADD CONSTRAINT `tb_detail_pesan_ibfk_1` FOREIGN KEY (`id_pemesanan`) REFERENCES `tb_pemesanan` (`id_pemesanan`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tb_jadwal`
--
ALTER TABLE `tb_jadwal`
  ADD CONSTRAINT `tb_jadwal_ibfk_1` FOREIGN KEY (`id_tim1`) REFERENCES `tb_tim` (`id_tim`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_jadwal_ibfk_2` FOREIGN KEY (`id_tim2`) REFERENCES `tb_tim` (`id_tim`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tb_jadwal_kelas`
--
ALTER TABLE `tb_jadwal_kelas`
  ADD CONSTRAINT `tb_jadwal_kelas_ibfk_1` FOREIGN KEY (`id_kelas`) REFERENCES `tb_kelas` (`id_kelas`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_jadwal_kelas_ibfk_2` FOREIGN KEY (`id_jadwal`) REFERENCES `tb_jadwal` (`id_jadwal`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tb_nota`
--
ALTER TABLE `tb_nota`
  ADD CONSTRAINT `tb_nota_ibfk_1` FOREIGN KEY (`id_topup`) REFERENCES `tb_topup` (`id_topup`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tb_pemesanan`
--
ALTER TABLE `tb_pemesanan`
  ADD CONSTRAINT `tb_pemesanan_ibfk_1` FOREIGN KEY (`id_member`) REFERENCES `tb_member` (`id_member`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_pemesanan_ibfk_2` FOREIGN KEY (`id_jadwal`) REFERENCES `tb_jadwal` (`id_jadwal`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tb_tiket`
--
ALTER TABLE `tb_tiket`
  ADD CONSTRAINT `tb_tiket_ibfk_1` FOREIGN KEY (`id_pemesanan`) REFERENCES `tb_pemesanan` (`id_pemesanan`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tb_topup`
--
ALTER TABLE `tb_topup`
  ADD CONSTRAINT `tb_topup_ibfk_1` FOREIGN KEY (`id_member`) REFERENCES `tb_member` (`id_member`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_topup_ibfk_2` FOREIGN KEY (`id_operator`) REFERENCES `tb_operator` (`id_operator`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
