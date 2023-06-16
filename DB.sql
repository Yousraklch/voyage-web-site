-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 16, 2023 at 11:14 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `voyage`
--
CREATE DATABASE IF NOT EXISTS `voyage` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `voyage`;

-- --------------------------------------------------------

--
-- Table structure for table `continent`
--

CREATE TABLE `continent` (
  `idcon` int(11) NOT NULL,
  `nomcon` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `continent`
--

INSERT INTO `continent` (`idcon`, `nomcon`) VALUES
(1, 'asia'),
(2, 'africa'),
(3, 'europe'),
(4, 'north amer'),
(5, 'south amer'),
(6, 'australia'),
(7, 'antarctica');

-- --------------------------------------------------------

--
-- Table structure for table `necessaire`
--

CREATE TABLE `necessaire` (
  `idnec` int(11) NOT NULL,
  `typenec` varchar(25) DEFAULT NULL,
  `nomnec` varchar(25) DEFAULT NULL,
  `idvil` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `necessaire`
--

INSERT INTO `necessaire` (`idnec`, `typenec`, `nomnec`, `idvil`) VALUES
(23, 'hotel', 'hotel 1', 11),
(24, 'gare', 'gare 1', 12);

-- --------------------------------------------------------

--
-- Table structure for table `pays`
--

CREATE TABLE `pays` (
  `idpay` int(11) NOT NULL,
  `nompay` varchar(25) DEFAULT NULL,
  `idcon` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pays`
--

INSERT INTO `pays` (`idpay`, `nompay`, `idcon`) VALUES
(4, 'algeria', 2);

-- --------------------------------------------------------

--
-- Table structure for table `site`
--

CREATE TABLE `site` (
  `idsit` int(11) NOT NULL,
  `nomsit` varchar(25) DEFAULT NULL,
  `cheminphoto` varchar(255) DEFAULT NULL,
  `idvil` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `site`
--

INSERT INTO `site` (`idsit`, `nomsit`, `cheminphoto`, `idvil`) VALUES
(33, 'site alger 1', 'sitealgerphoto1', 11),
(34, 'site oran 1', 'siteoran1', 12);

-- --------------------------------------------------------

--
-- Table structure for table `ville`
--

CREATE TABLE `ville` (
  `idvil` int(11) NOT NULL,
  `nomvil` varchar(25) DEFAULT NULL,
  `descvil` varchar(255) DEFAULT NULL,
  `idpay` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ville`
--

INSERT INTO `ville` (`idvil`, `nomvil`, `descvil`, `idpay`) VALUES
(11, 'alger', 'alger description', 4),
(12, 'oran', 'oran', 4),
(13, 'anaba', 'anaba', 4);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `continent`
--
ALTER TABLE `continent`
  ADD PRIMARY KEY (`idcon`);

--
-- Indexes for table `necessaire`
--
ALTER TABLE `necessaire`
  ADD PRIMARY KEY (`idnec`),
  ADD KEY `idvil` (`idvil`);

--
-- Indexes for table `pays`
--
ALTER TABLE `pays`
  ADD PRIMARY KEY (`idpay`),
  ADD KEY `idcon` (`idcon`);

--
-- Indexes for table `site`
--
ALTER TABLE `site`
  ADD PRIMARY KEY (`idsit`),
  ADD KEY `idvil` (`idvil`);

--
-- Indexes for table `ville`
--
ALTER TABLE `ville`
  ADD PRIMARY KEY (`idvil`),
  ADD KEY `idpay` (`idpay`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `continent`
--
ALTER TABLE `continent`
  MODIFY `idcon` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `necessaire`
--
ALTER TABLE `necessaire`
  MODIFY `idnec` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `pays`
--
ALTER TABLE `pays`
  MODIFY `idpay` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `site`
--
ALTER TABLE `site`
  MODIFY `idsit` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `ville`
--
ALTER TABLE `ville`
  MODIFY `idvil` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `necessaire`
--
ALTER TABLE `necessaire`
  ADD CONSTRAINT `necessaire_ibfk_1` FOREIGN KEY (`idvil`) REFERENCES `ville` (`idvil`);

--
-- Constraints for table `pays`
--
ALTER TABLE `pays`
  ADD CONSTRAINT `pays_ibfk_1` FOREIGN KEY (`idcon`) REFERENCES `continent` (`idcon`);

--
-- Constraints for table `site`
--
ALTER TABLE `site`
  ADD CONSTRAINT `site_ibfk_1` FOREIGN KEY (`idvil`) REFERENCES `ville` (`idvil`);

--
-- Constraints for table `ville`
--
ALTER TABLE `ville`
  ADD CONSTRAINT `ville_ibfk_1` FOREIGN KEY (`idpay`) REFERENCES `pays` (`idpay`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
