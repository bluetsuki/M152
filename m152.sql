-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 29, 2020 at 10:09 PM
-- Server version: 5.7.17
-- PHP Version: 7.1.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `m152`
--
CREATE DATABASE IF NOT EXISTS `m152` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `m152`;

-- --------------------------------------------------------

--
-- Table structure for table `media`
--

CREATE TABLE `media` (
  `idMedia` int(11) NOT NULL,
  `typeMedia` varchar(50) NOT NULL,
  `nameMedia` varchar(200) NOT NULL,
  `dateCreation` date NOT NULL,
  `dateModification` date DEFAULT NULL,
  `pathImg` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `media`
--

INSERT INTO `media` (`idMedia`, `typeMedia`, `nameMedia`, `dateCreation`, `dateModification`, `pathImg`) VALUES
(1, 'image', 'ARLAffiche.png', '2020-01-29', NULL, 'upload/ARLAffiche.png'),
(2, 'image', 'tumblr_ovcll4Wh0l1wvncv4o1_500.jpg', '2020-01-29', NULL, 'upload/tumblr_ovcll4Wh0l1wvncv4o1_500.jpg'),
(3, 'image', 'ex07.png', '2020-01-29', NULL, 'upload/ex07.png');

-- --------------------------------------------------------

--
-- Table structure for table `post`
--

CREATE TABLE `post` (
  `idPost` int(11) NOT NULL,
  `commentaire` varchar(250) NOT NULL,
  `dateCreation` date NOT NULL,
  `dateModification` date DEFAULT NULL,
  `idMedia` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `media`
--
ALTER TABLE `media`
  ADD PRIMARY KEY (`idMedia`);

--
-- Indexes for table `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`idPost`),
  ADD KEY `idMedia` (`idMedia`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `media`
--
ALTER TABLE `media`
  MODIFY `idMedia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `post`
--
ALTER TABLE `post`
  MODIFY `idPost` int(11) NOT NULL AUTO_INCREMENT;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
