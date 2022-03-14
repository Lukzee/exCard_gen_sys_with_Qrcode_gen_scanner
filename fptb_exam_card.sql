-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 20, 2021 at 04:38 PM
-- Server version: 10.1.29-MariaDB
-- PHP Version: 7.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `exam_card`
--
CREATE DATABASE IF NOT EXISTS `exam_card` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `exam_card`;

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `user` varchar(200) NOT NULL,
  `pass` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `user`, `pass`) VALUES
(1, 'admin@gmail.com', '32250170a0dca92d53ec9624f336ca24'),
(2, 'admin2@gmail.com', '32250170a0dca92d53ec9624f336ca24'),
(3, 'ola@gmail.com', '32250170a0dca92d53ec9624f336ca24');

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `id` int(11) NOT NULL,
  `cCode` varchar(50) NOT NULL,
  `cTitle` varchar(300) NOT NULL,
  `cUnit` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`id`, `cCode`, `cTitle`, `cUnit`) VALUES
(1, 'COM 101', 'Introduction to Computer Programming', 3),
(2, 'COM 102', 'Introduction to Computer Networking', 2),
(3, 'COM 103', 'Data Structure and Algorithm', 3),
(4, 'MATH 112', 'Logic And Linear Algebra', 2);

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE `department` (
  `id` int(11) NOT NULL,
  `depname` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`id`, `depname`) VALUES
(1, 'Computer Science'),
(2, 'Library & Information Science'),
(3, 'Science & Laboratory Technology');

-- --------------------------------------------------------

--
-- Table structure for table `records`
--

CREATE TABLE `records` (
  `id` int(11) NOT NULL,
  `regno` varchar(20) NOT NULL,
  `name` varchar(300) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `dep` text NOT NULL,
  `program` varchar(200) NOT NULL,
  `stream` varchar(10) NOT NULL,
  `class` varchar(10) NOT NULL,
  `semester` varchar(20) NOT NULL,
  `session` varchar(20) NOT NULL,
  `passport` varchar(200) NOT NULL,
  `courses_id` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `records`
--

INSERT INTO `records` (`id`, `regno`, `name`, `gender`, `dep`, `program`, `stream`, `class`, `semester`, `session`, `passport`, `courses_id`) VALUES
(1, '19/123402', 'Ola Dele', 'M', 'Computer Science', 'Higher National Diploma', 'B', 'HND 2', 'FIRST', '2020/2021', 'http://localhost/ExCard/upload/250.jpg', '3,2,4'),
(2, '19/134567', 'Musa Ali', 'M', 'Computer Science', 'Higher National Diploma', 'B', 'HND 2', 'FIRST', '2020/2021', 'http://localhost/ExCard/upload/372.png', '3,2,1,4'),
(3, '19/134589', 'DEmo', 'M', 'Computer Science', 'Higher National Diploma', 'B', 'HND 2', 'FIRST', '2020/2021', '', '3,2,1,4'),
(8, '19/144567', 'Issa Ali', 'M', 'Computer Science', 'Higher National Diploma', 'B', 'HND 1', 'FIRST', '2020/2021', 'http://localhost/ExCard/upload/496.jpg', '3,2,1');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `department`
--
ALTER TABLE `department`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `records`
--
ALTER TABLE `records`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `department`
--
ALTER TABLE `department`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `records`
--
ALTER TABLE `records`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
