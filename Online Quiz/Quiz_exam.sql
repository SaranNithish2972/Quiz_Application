-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 02, 2024 at 01:09 PM
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
-- Database: `Quiz_exam`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `email`, `password`) VALUES
(1, 'admin@admin.com', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `answer`
--

CREATE TABLE `answer` (
  `qid` text NOT NULL,
  `ansid` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `answer`
--

INSERT INTO `answer` (`qid`, `ansid`) VALUES
('6681a26739863', '6681a2673a07b'),
('6681a267426b0', '6681a26742d13'),
('6683d6141b15c', '6683d6141bd72'),
('6683d81e9591b', '6683d81e96a10'),
('6683d81e9ec52', '6683d81ea15e6'),
('6683d81ea51a6', '6683d81ea5e23'),
('6683d81ea9c1e', '6683d81eaacb6'),
('6683d81eada05', '6683d81eae421'),
('6683d9c3e56ce', '6683d9c3e6bfb'),
('6683d9de029d8', '6683d9de0303a'),
('6683d9ff4390a', '6683d9ff443e0'),
('6683d9ff47853', '6683d9ff48084'),
('6683d9ff4b533', '6683d9ff4bd38'),
('6683da302044b', '6683da3020db8'),
('6683da3024c2f', '6683da30256d5'),
('6683da302827b', '6683da302896b'),
('6683da3e31bde', '6683da3e3244a'),
('6683da3e35433', '6683da3e35ac0'),
('6683da3e377c2', '6683da3e37cb3'),
('6683da3e3a1e0', '6683da3e3a752'),
('6683da3e3ccb1', '6683da3e3d3dc');

-- --------------------------------------------------------

--
-- Table structure for table `history`
--

CREATE TABLE `history` (
  `email` varchar(50) NOT NULL,
  `eid` text NOT NULL,
  `score` int(11) NOT NULL,
  `level` int(11) NOT NULL,
  `correct` int(11) NOT NULL,
  `wrong` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `history`
--

INSERT INTO `history` (`email`, `eid`, `score`, `level`, `correct`, `wrong`, `date`) VALUES
('sarannithish069@gmail.com', '6683d8be9f57e', 5, 5, 5, 0, '2024-07-02 11:01:06'),
('sarannithish069@gmail.com', '6683d76421ee7', 5, 5, 5, 0, '2024-07-02 11:01:53');

-- --------------------------------------------------------

--
-- Table structure for table `options`
--

CREATE TABLE `options` (
  `qid` varchar(50) NOT NULL,
  `option` varchar(5000) NOT NULL,
  `optionid` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `options`
--

INSERT INTO `options` (`qid`, `option`, `optionid`) VALUES
('6681a26739863', '1', '6681a2673a07b'),
('6681a26739863', '1', '6681a2673a081'),
('6681a26739863', '1', '6681a2673a082'),
('6681a26739863', '1', '6681a2673a083'),
('6681a267426b0', '1', '6681a26742d13'),
('6681a267426b0', '1', '6681a26742d19'),
('6681a267426b0', '1', '6681a26742d1a'),
('6681a267426b0', '1', '6681a26742d1b'),
('6683d6141b15c', '2', '6683d6141bd72'),
('6683d6141b15c', '22', '6683d6141bd7c'),
('6683d6141b15c', '2', '6683d6141bd7d'),
('6683d6141b15c', '2', '6683d6141bd7f'),
('6683d81e9591b', '9', '6683d81e969e9'),
('6683d81e9591b', '10', '6683d81e96a10'),
('6683d81e9591b', '11', '6683d81e96a12'),
('6683d81e9591b', '12', '6683d81e96a15'),
('6683d81e9ec52', '2', '6683d81ea15db'),
('6683d81e9ec52', '3', '6683d81ea15e4'),
('6683d81e9ec52', '4', '6683d81ea15e6'),
('6683d81e9ec52', '5', '6683d81ea15e7'),
('6683d81ea51a6', '1/2', '6683d81ea5e23'),
('6683d81ea51a6', '1/3', '6683d81ea5e30'),
('6683d81ea51a6', '1/4', '6683d81ea5e32'),
('6683d81ea51a6', '1/5', '6683d81ea5e33'),
('6683d81ea9c1e', '90', '6683d81eaacb1'),
('6683d81ea9c1e', '180', '6683d81eaacb6'),
('6683d81ea9c1e', '270', '6683d81eaacb7'),
('6683d81ea9c1e', '360', '6683d81eaacb8'),
('6683d81eada05', '20', '6683d81eae41c'),
('6683d81eada05', '25', '6683d81eae420'),
('6683d81eada05', '30', '6683d81eae421'),
('6683d81eada05', '35', '6683d81eae422'),
('6683d9c3e56ce', 'Dog', '6683d9c3e6bef'),
('6683d9c3e56ce', 'Cat', '6683d9c3e6bf8'),
('6683d9c3e56ce', 'Rabbit', '6683d9c3e6bf9'),
('6683d9c3e56ce', 'Car', '6683d9c3e6bfb'),
('6683d9de029d8', 'Dog', '6683d9de03036'),
('6683d9de029d8', 'Cat', '6683d9de03038'),
('6683d9de029d8', 'Rabbit', '6683d9de03039'),
('6683d9de029d8', 'Car', '6683d9de0303a'),
('6683d9ff4390a', 'Dog', '6683d9ff443d4'),
('6683d9ff4390a', 'Cat', '6683d9ff443dd'),
('6683d9ff4390a', 'Rabbit', '6683d9ff443df'),
('6683d9ff4390a', 'Car', '6683d9ff443e0'),
('6683d9ff47853', 'EGNARO', '6683d9ff48084'),
('6683d9ff47853', 'ENGARO', '6683d9ff4808b'),
('6683d9ff47853', 'EGNRAO', '6683d9ff4808d'),
('6683d9ff47853', 'EGNORO', '6683d9ff4808e'),
('6683d9ff4b533', 'John', '6683d9ff4bd38'),
('6683d9ff4b533', 'Sarah', '6683d9ff4bd3e'),
('6683d9ff4b533', 'Michael', '6683d9ff4bd3f'),
('6683d9ff4b533', 'Cannot be determined', '6683d9ff4bd40'),
('6683da302044b', 'Dog', '6683da3020dab'),
('6683da302044b', 'Cat', '6683da3020db4'),
('6683da302044b', 'Rabbit', '6683da3020db6'),
('6683da302044b', 'Car', '6683da3020db8'),
('6683da3024c2f', 'EGNARO', '6683da30256d5'),
('6683da3024c2f', 'ENGARO', '6683da30256dd'),
('6683da3024c2f', 'EGNRAO', '6683da30256df'),
('6683da3024c2f', 'EGNORO', '6683da30256e0'),
('6683da302827b', 'John', '6683da302896b'),
('6683da302827b', 'Sarah', '6683da3028973'),
('6683da302827b', 'Michael', '6683da3028974'),
('6683da302827b', 'Cannot be determined', '6683da3028975'),
('6683da3e31bde', 'Dog', '6683da3e32443'),
('6683da3e31bde', 'Cat', '6683da3e32448'),
('6683da3e31bde', 'Rabbit', '6683da3e32449'),
('6683da3e31bde', 'Car', '6683da3e3244a'),
('6683da3e35433', 'EGNARO', '6683da3e35ac0'),
('6683da3e35433', 'ENGARO', '6683da3e35ac6'),
('6683da3e35433', 'EGNRAO', '6683da3e35ac7'),
('6683da3e35433', 'EGNORO', '6683da3e35ac8'),
('6683da3e377c2', 'John', '6683da3e37cb3'),
('6683da3e377c2', 'Sarah', '6683da3e37cb7'),
('6683da3e377c2', 'Michael', '6683da3e37cb8'),
('6683da3e377c2', 'Cannot be determined', '6683da3e37cb9'),
('6683da3e3a1e0', '3120', '6683da3e3a74b'),
('6683da3e3a1e0', '3140', '6683da3e3a751'),
('6683da3e3a1e0', '3129', '6683da3e3a752'),
('6683da3e3a1e0', '3119', '6683da3e3a753'),
('6683da3e3ccb1', '2', '6683da3e3d3d2'),
('6683da3e3ccb1', '3', '6683da3e3d3dc'),
('6683da3e3ccb1', '4', '6683da3e3d3de'),
('6683da3e3ccb1', '6', '6683da3e3d3df');

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE `questions` (
  `eid` text NOT NULL,
  `qid` text NOT NULL,
  `qns` text NOT NULL,
  `choice` int(10) NOT NULL,
  `sn` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`eid`, `qid`, `qns`, `choice`, `sn`) VALUES
('6683d76421ee7', '6683d81e9591b', 'What is the next number in the sequence: 2, 4, 6, 8, ___?', 4, 1),
('6683d76421ee7', '6683d81e9ec52', 'If 5x = 20, what is the value of x?', 4, 2),
('6683d76421ee7', '6683d81ea51a6', 'Which of the following is the largest?', 4, 3),
('6683d76421ee7', '6683d81ea9c1e', 'What is the sum of the angles in a triangle?', 4, 4),
('6683d76421ee7', '6683d81eada05', 'What is 15% of 200?', 4, 5),
('6683d8be9f57e', '6683d9ff4390a', 'Find the odd one out:', 4, 1),
('6683d8be9f57e', '6683d9ff47853', 'In a certain code,  APPLE  is written as ELPPA. How is ORANGE written in that code?', 4, 2),
('6683d8be9f57e', '6683d9ff4b533', 'John, Sarah, and Michael are standing in a line. John is not at either end. Sarah is standing to the left of John. Who is standing in the middle?', 4, 3),
('6683d8be9f57e', '6683da3e3a1e0', 'If \"CAT\" is coded as \"3120\", \"DOG\" is coded as \"4157\", then \"RAT\" is coded as:', 4, 4),
('6683d8be9f57e', '6683da3e3ccb1', 'Which one of the following does not belong in the sequence?', 4, 5);

-- --------------------------------------------------------

--
-- Table structure for table `quiz`
--

CREATE TABLE `quiz` (
  `eid` text NOT NULL,
  `title` varchar(100) NOT NULL,
  `correct` int(11) NOT NULL,
  `wrong` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `quiz`
--

INSERT INTO `quiz` (`eid`, `title`, `correct`, `wrong`, `total`, `date`) VALUES
('6683d76421ee7', 'General Aptitude', 1, 0, 5, '2024-07-02 10:33:08'),
('6683d8be9f57e', 'Logical Aptitude', 1, 0, 5, '2024-07-02 10:38:54');

-- --------------------------------------------------------

--
-- Table structure for table `rank`
--

CREATE TABLE `rank` (
  `email` varchar(50) NOT NULL,
  `score` int(11) NOT NULL,
  `time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `rank`
--

INSERT INTO `rank` (`email`, `score`, `time`) VALUES
('demo@gmail.com', 5, '2024-06-30 18:23:59'),
('sarannithish069@gmail.com', 10, '2024-07-02 11:01:53');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `name` varchar(50) NOT NULL,
  `college` varchar(100) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`name`, `college`, `email`, `password`) VALUES
('Demo', 'Coimbatore Institute Of Technology', 'demo@gmail.com', 'demo'),
('Saran Nithish T S', 'Coimbatore Institute Of Technology', 'sarannithish069@gmail.com', 'saran');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
