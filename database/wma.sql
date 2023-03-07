-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 09, 2023 at 12:47 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `wma`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_jenis`
--

CREATE TABLE `tb_jenis` (
  `kode_jenis` varchar(16) NOT NULL,
  `nama_jenis` varchar(255) DEFAULT NULL,
  `hasil` double DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_jenis`
--

INSERT INTO `tb_jenis` (`kode_jenis`, `nama_jenis`, `hasil`) VALUES
('J01', 'Profit', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tb_periode`
--

CREATE TABLE `tb_periode` (
  `kode_periode` varchar(16) NOT NULL,
  `tanggal` date DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_periode`
--

INSERT INTO `tb_periode` (`kode_periode`, `tanggal`) VALUES
('P12', '2021-12-31'),
('P11', '2021-11-30'),
('P10', '2021-10-31'),
('P09', '2021-09-30'),
('P08', '2021-08-31'),
('P07', '2021-07-31'),
('P06', '2021-06-30'),
('P05', '2021-05-31'),
('P01', '2021-01-31'),
('P02', '2021-02-28'),
('P03', '2021-03-31'),
('P04', '2021-04-30'),
('P13', '2022-01-31'),
('P14', '2022-02-28'),
('P15', '2022-03-31'),
('P16', '2022-04-30'),
('P17', '2022-05-31'),
('P18', '2022-06-30'),
('P19', '2022-07-31'),
('P20', '2022-08-31'),
('P21', '2022-09-30'),
('P22', '2022-10-31'),
('P23', '2022-11-30');

-- --------------------------------------------------------

--
-- Table structure for table `tb_relasi`
--

CREATE TABLE `tb_relasi` (
  `ID` int(11) NOT NULL,
  `kode_periode` varchar(16) DEFAULT NULL,
  `kode_jenis` varchar(16) DEFAULT NULL,
  `nilai` double DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_relasi`
--

INSERT INTO `tb_relasi` (`ID`, `kode_periode`, `kode_jenis`, `nilai`) VALUES
(183, 'P23', 'J01', 4900588),
(182, 'P22', 'J01', 3546851),
(181, 'P21', 'J01', 2686891),
(180, 'P20', 'J01', 2601450),
(179, 'P19', 'J01', 4736397),
(178, 'P18', 'J01', 3735930),
(177, 'P17', 'J01', 4976125),
(176, 'P16', 'J01', 4163543),
(175, 'P15', 'J01', 5790599),
(162, 'P02', 'J01', 5181587),
(163, 'P03', 'J01', 4327742),
(164, 'P04', 'J01', 5919391),
(165, 'P05', 'J01', 4267880),
(166, 'P06', 'J01', 4322167),
(167, 'P07', 'J01', 5132558),
(168, 'P08', 'J01', 5642014),
(169, 'P09', 'J01', 4811518),
(170, 'P10', 'J01', 5541783),
(171, 'P11', 'J01', 5913734),
(172, 'P12', 'J01', 6267011),
(173, 'P13', 'J01', 3754040),
(174, 'P14', 'J01', 2469626),
(161, 'P01', 'J01', 5436197);

-- --------------------------------------------------------

--
-- Table structure for table `tb_user`
--

CREATE TABLE `tb_user` (
  `user` varchar(16) DEFAULT NULL,
  `pass` varchar(16) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_user`
--

INSERT INTO `tb_user` (`user`, `pass`) VALUES
('admin', 'admin'),
('owner', 'owner');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_jenis`
--
ALTER TABLE `tb_jenis`
  ADD PRIMARY KEY (`kode_jenis`);

--
-- Indexes for table `tb_periode`
--
ALTER TABLE `tb_periode`
  ADD PRIMARY KEY (`kode_periode`);

--
-- Indexes for table `tb_relasi`
--
ALTER TABLE `tb_relasi`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_relasi`
--
ALTER TABLE `tb_relasi`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=324;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
