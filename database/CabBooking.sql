-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Nov 30, 2020 at 02:05 PM
-- Server version: 10.4.13-MariaDB
-- PHP Version: 7.2.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `CabBooking`
--

-- --------------------------------------------------------

--
-- Table structure for table `LocationTable`
--

CREATE TABLE `LocationTable` (
  `id` int(50) NOT NULL,
  `name` varchar(50) NOT NULL,
  `distance` varchar(50) NOT NULL,
  `is_available` int(50) NOT NULL DEFAULT 1,
  `is_block` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `LocationTable`
--

INSERT INTO `LocationTable` (`id`, `name`, `distance`, `is_available`, `is_block`) VALUES
(1, 'Charbagh', '0', 0, 1),
(2, 'Indira Nagar', '10', 1, 1),
(3, 'BBD', '30', 1, 1),
(4, 'Barabanki', '60', 1, 1),
(5, 'Faizabad', '100', 1, 1),
(6, 'Basti', '150', 1, 1),
(7, 'Gorakhpur', '210', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `rideTable`
--

CREATE TABLE `rideTable` (
  `ride_id` int(50) NOT NULL,
  `ride_date` date NOT NULL DEFAULT current_timestamp(),
  `pickup` varchar(50) NOT NULL,
  `droplocation` varchar(50) NOT NULL,
  `cabType` varchar(50) NOT NULL,
  `total_distance` varchar(50) NOT NULL,
  `total_fare` int(50) NOT NULL,
  `status` int(50) NOT NULL,
  `user_id` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `rideTable`
--

INSERT INTO `rideTable` (`ride_id`, `ride_date`, `pickup`, `droplocation`, `cabType`, `total_distance`, `total_fare`, `status`, `user_id`) VALUES
(11, '2020-11-27', 'Charbagh', 'Basti', 'CedMicro', '150', 1720, 2, 10),
(12, '2020-10-27', 'Charbagh', 'Basti', 'CedSUV', '150', 2770, 0, 10),
(14, '2020-11-28', 'Charbagh', 'Basti', 'CedMini', '150', 2170, 1, 10),
(15, '2020-11-28', 'Charbagh', 'Faizabad', 'CedMini', '100', 1493, 1, 10),
(24, '2020-11-30', 'Charbagh', 'Basti', 'CedMicro', '150', 1720, 1, 10);

-- --------------------------------------------------------

--
-- Table structure for table `userTable`
--

CREATE TABLE `userTable` (
  `user_id` int(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `mobile` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(200) NOT NULL,
  `date` date NOT NULL DEFAULT current_timestamp(),
  `is_admin` varchar(50) NOT NULL DEFAULT 'user',
  `is_block` int(10) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `userTable`
--

INSERT INTO `userTable` (`user_id`, `username`, `mobile`, `email`, `password`, `date`, `is_admin`, `is_block`) VALUES
(8, 'sumit', '9936406865', 'padey@gmail.com', '202cb962ac59075b964b07152d234b70', '2020-11-24', 'admin', 1),
(10, 'amit', '9125457091', 'pandeysumit@gmail.com', 'caf1a3dfb505ffed0d024130f58c5cfa', '2020-11-24', 'user', 1),
(11, 'ankit', '9415487256', 'ankit@gmail.com', '202cb962ac59075b964b07152d234b70', '2020-11-25', 'user', 0),
(12, 'chirag', '9415478965', 'chirag@gmail.com', '202cb962ac59075b964b07152d234b70', '2020-11-27', 'user', 1),
(14, 'nitish', '9415463811', 'nitish@gmail.com', '202cb962ac59075b964b07152d234b70', '2020-11-30', 'user', 0),
(25, 'jatin', '09415463811', 'kahbsdk@gmail.com', '202cb962ac59075b964b07152d234b70', '2020-11-30', 'user', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `LocationTable`
--
ALTER TABLE `LocationTable`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rideTable`
--
ALTER TABLE `rideTable`
  ADD PRIMARY KEY (`ride_id`);

--
-- Indexes for table `userTable`
--
ALTER TABLE `userTable`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `LocationTable`
--
ALTER TABLE `LocationTable`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `rideTable`
--
ALTER TABLE `rideTable`
  MODIFY `ride_id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `userTable`
--
ALTER TABLE `userTable`
  MODIFY `user_id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
