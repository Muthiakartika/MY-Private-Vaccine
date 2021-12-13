-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 13, 2021 at 03:56 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 7.4.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `myprivatevaccine`
--

-- --------------------------------------------------------

--
-- Table structure for table `batch`
--

CREATE TABLE `batch` (
  `batchNo` varchar(15) NOT NULL,
  `expiryDate` date NOT NULL,
  `quantityAvailable` int(5) NOT NULL,
  `quantityAdministered` int(5) NOT NULL DEFAULT 0,
  `vaccineID` int(11) NOT NULL,
  `centreName` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `batch`
--

INSERT INTO `batch` (`batchNo`, `expiryDate`, `quantityAvailable`, `quantityAdministered`, `vaccineID`, `centreName`) VALUES
('512710P', '2022-06-01', 99, 1, 1, 'MSU Medical Centre');

-- --------------------------------------------------------

--
-- Table structure for table `healthcarecentre`
--

CREATE TABLE `healthcarecentre` (
  `id` int(11) NOT NULL,
  `centreName` varchar(30) NOT NULL,
  `address` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `healthcarecentre`
--

INSERT INTO `healthcarecentre` (`id`, `centreName`, `address`) VALUES
(1, 'MSU Medical Centre', 'Selangor'),
(2, 'Senawang Specialist Hospital', 'Negri Sembilan'),
(3, 'Timberland Medical Centre', 'Serawak');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `icpassport` varchar(15) DEFAULT NULL,
  `centreName` varchar(30) DEFAULT NULL,
  `username` varchar(15) NOT NULL,
  `password` varchar(15) NOT NULL,
  `fullname` varchar(30) NOT NULL,
  `email` varchar(30) NOT NULL,
  `role` enum('administrator','patient','','') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `icpassport`, `centreName`, `username`, `password`, `fullname`, `email`, `role`) VALUES
(96, '', 'MSU Medical Centre', 'uzumaki', 'uzumaki123', 'Naruto Uzumaki', 'nandaimehokagenaruto@gmail.com', 'administrator'),
(97, 'JPY5671234', '', 'uchiha', 'uchiha123', 'Uchiha Sasuke', 'uchihasasukeshage@gmail.com', 'patient');

-- --------------------------------------------------------

--
-- Table structure for table `vaccination`
--

CREATE TABLE `vaccination` (
  `vaccinationID` int(5) NOT NULL,
  `batchNo` varchar(15) NOT NULL,
  `appointmentDate` varchar(15) NOT NULL,
  `status` enum('Pending','Confirm','Administered','Rejected') NOT NULL DEFAULT 'Pending',
  `remarks` varchar(50) DEFAULT NULL,
  `fullname` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `vaccination`
--

INSERT INTO `vaccination` (`vaccinationID`, `batchNo`, `appointmentDate`, `status`, `remarks`, `fullname`) VALUES
(32, '512710P', '2021-12-14', 'Administered', 'He has gotten 1 doses of vaccine without any sympt', 'Uchiha Sasuke');

-- --------------------------------------------------------

--
-- Table structure for table `vaccine`
--

CREATE TABLE `vaccine` (
  `vaccineID` int(5) NOT NULL,
  `manufacturer` varchar(15) NOT NULL,
  `vaccineName` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `vaccine`
--

INSERT INTO `vaccine` (`vaccineID`, `manufacturer`, `vaccineName`) VALUES
(1, 'Sinovac Biotech', 'Sinovac'),
(2, 'ModernaTX,Inc.', 'Moderna'),
(3, 'Pfizer,Inc. and', 'Pfizer'),
(4, 'Oxford', 'Astrazeneca'),
(5, 'Janssen Pharmac', 'Jhonson & Jhons');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `batch`
--
ALTER TABLE `batch`
  ADD PRIMARY KEY (`batchNo`);

--
-- Indexes for table `healthcarecentre`
--
ALTER TABLE `healthcarecentre`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vaccination`
--
ALTER TABLE `vaccination`
  ADD PRIMARY KEY (`vaccinationID`);

--
-- Indexes for table `vaccine`
--
ALTER TABLE `vaccine`
  ADD PRIMARY KEY (`vaccineID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `healthcarecentre`
--
ALTER TABLE `healthcarecentre`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=98;

--
-- AUTO_INCREMENT for table `vaccination`
--
ALTER TABLE `vaccination`
  MODIFY `vaccinationID` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `vaccine`
--
ALTER TABLE `vaccine`
  MODIFY `vaccineID` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
