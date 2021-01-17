-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 17, 2021 at 09:11 AM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `evaluation_system_database`
--

-- --------------------------------------------------------

--
-- Table structure for table `evaluation`
--

CREATE TABLE `evaluation` (
  `id` int(11) NOT NULL,
  `student_number` varchar(500) NOT NULL,
  `subject_code` varchar(500) NOT NULL,
  `professor` varchar(500) NOT NULL,
  `course` varchar(500) NOT NULL,
  `item1` int(11) NOT NULL,
  `item2` int(11) NOT NULL,
  `item3` int(11) NOT NULL,
  `item4` int(11) NOT NULL,
  `item5` int(11) NOT NULL,
  `item6` int(11) NOT NULL,
  `item7` int(11) NOT NULL,
  `item8` int(11) NOT NULL,
  `item9` int(11) NOT NULL,
  `item10` int(11) NOT NULL,
  `item11` int(11) NOT NULL,
  `item12` int(11) NOT NULL,
  `item13` int(11) NOT NULL,
  `item14` int(11) NOT NULL,
  `item15` int(11) NOT NULL,
  `comment` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `evaluation`
--

INSERT INTO `evaluation` (`id`, `student_number`, `subject_code`, `professor`, `course`, `item1`, `item2`, `item3`, `item4`, `item5`, `item6`, `item7`, `item8`, `item9`, `item10`, `item11`, `item12`, `item13`, `item14`, `item15`, `comment`) VALUES
(11, '222', 'CCS 116', 'VICTORIA, EFREN PPP', 'BSCS - 1A', 3, 2, 1, 1, 2, 3, 2, 2, 1, 2, 2, 1, 2, 2, 1, 'no comment'),
(12, '33333', 'CCS 116', 'VICTORIA, EFREN PPP', 'BSIT - 3B', 3, 2, 2, 2, 1, 3, 3, 3, 2, 1, 2, 2, 3, 2, 2, 'magaling magturo\r\n'),
(13, '20181562', 'CCS 116', 'VICTORIA, EFREN PPP', 'BSCS - 3A', 1, 2, 2, 1, 2, 1, 2, 2, 1, 2, 1, 2, 1, 2, 2, 'no comment'),
(14, '20181561', 'CCS 116', 'VICTORIA, EFREN PPP', 'BSCS - 3B', 1, 2, 2, 1, 2, 2, 2, 1, 1, 2, 2, 2, 1, 2, 2, 'no comment'),
(15, '20181562', 'CCS 115', 'VICTORIA, EFREN PPP', 'BSCS - 3A', 2, 1, 2, 2, 2, 2, 3, 3, 2, 2, 2, 2, 2, 1, 1, 'no comment'),
(16, '20181562', 'CCS 112', 'PROFNAME', 'BSCS - 3A', 2, 1, 1, 1, 1, 3, 2, 2, 3, 2, 3, 3, 2, 2, 2, 'good professor');

-- --------------------------------------------------------

--
-- Table structure for table `evaluation_setting`
--

CREATE TABLE `evaluation_setting` (
  `status` varchar(500) NOT NULL,
  `id` int(11) NOT NULL,
  `date` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `evaluation_setting`
--

INSERT INTO `evaluation_setting` (`status`, `id`, `date`) VALUES
('OPEN', 1, '01/31/2021');

-- --------------------------------------------------------

--
-- Table structure for table `profname`
--

CREATE TABLE `profname` (
  `id` int(11) NOT NULL,
  `name` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `profname`
--

INSERT INTO `profname` (`id`, `name`) VALUES
(1, 'profname'),
(2, 'Victoria, efren Ppp'),
(3, 'Victoria, efren Ppp'),
(4, 'Victoria, efren Ppp'),
(5, 'sad, asd asd'),
(6, 'sad, asd a'),
(7, 'sad, asd aaaa'),
(8, 'sad, asdddd aaaa'),
(9, 'sad, asdddd aaaaaaaa'),
(10, 'sad, asdddd aaaaaaaaaaaa');

-- --------------------------------------------------------

--
-- Table structure for table `school_year`
--

CREATE TABLE `school_year` (
  `sy` varchar(500) NOT NULL,
  `semester` varchar(500) NOT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `school_year`
--

INSERT INTO `school_year` (`sy`, `semester`, `id`) VALUES
('2020-2021', '1ST', 1);

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `id` int(11) NOT NULL,
  `student_number` varchar(500) NOT NULL,
  `status` varchar(500) NOT NULL,
  `course` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`id`, `student_number`, `status`, `course`) VALUES
(2, '20181561', 'IRREGULAR', 'BSCS - 3B'),
(3, '20181562', 'REGULAR', 'BSCS - 3A'),
(4, '2222', 'REGULAR', 'BSCS - 3A'),
(5, '222', 'IRREGULAR', 'BSCS - 1A'),
(7, '33333', 'IRREGULAR', 'BSIT - 3B');

-- --------------------------------------------------------

--
-- Table structure for table `subject`
--

CREATE TABLE `subject` (
  `subject_code` varchar(500) NOT NULL,
  `description` varchar(500) NOT NULL,
  `course` varchar(500) NOT NULL,
  `id` int(11) NOT NULL,
  `professor` varchar(500) NOT NULL,
  `sy` varchar(500) NOT NULL,
  `sem` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `subject`
--

INSERT INTO `subject` (`subject_code`, `description`, `course`, `id`, `professor`, `sy`, `sem`) VALUES
('CCS 116', 'WEB APP', 'BSCS - 3A', 1, 'Victoria, efren Ppp', '2020-2021', '1ST'),
('CCS 114', 'SUBJECT ', 'BSIT - 3A', 2, 'sad, asd a', '2020-2021', '1ST'),
('CCS 112', 'NETWORKING', 'BSCS - 3A', 3, 'profname', '2020-2021', '1ST'),
('ASD', 'ASD', 'BSCS - 3A', 4, 'sad, asdddd aaaaaaaa', '2020-2021', '1ST'),
('CCS 115', 'BUSINESS APPLICATION SOFTWARE WEB APP NETWORKING', 'BSCS - 3A', 13, 'Victoria, efren Ppp', '2020-2021', '1ST'),
('GEC 111', 'AAA', 'BSIS - 2A', 14, 'sad, asdddd aaaaaaaa', '2020-2021', '1ST');

-- --------------------------------------------------------

--
-- Table structure for table `subject_irregular`
--

CREATE TABLE `subject_irregular` (
  `id` int(11) NOT NULL,
  `student_number` varchar(500) NOT NULL,
  `subject_code` varchar(500) NOT NULL,
  `description` varchar(500) NOT NULL,
  `course` varchar(500) NOT NULL,
  `professor` varchar(500) NOT NULL,
  `sy` varchar(500) NOT NULL,
  `sem` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `subject_irregular`
--

INSERT INTO `subject_irregular` (`id`, `student_number`, `subject_code`, `description`, `course`, `professor`, `sy`, `sem`) VALUES
(13, '222', 'CCS 116', 'WEB APP', 'BSCS - 3A', 'Victoria, efren Ppp', '2020-2021', '1ST'),
(14, '222', 'CCS 114', 'SUBJECT ', 'BSIT - 3A', 'sad, asd a', '2020-2021', '1ST'),
(15, '222', 'CCS 112', 'NETWORKING', 'BSCS - 3A', 'profname', '2020-2021', '1ST'),
(16, '222', 'ASD', 'ASD', 'BSCS - 3A', 'sad, asdddd aaaaaaaa', '2020-2021', '1ST'),
(17, '20181561', 'CCS 116', 'WEB APP', 'BSCS - 3A', 'Victoria, efren Ppp', '2020-2021', '1ST'),
(18, '33333', 'CCS 116', 'WEB APP', 'BSCS - 3A', 'Victoria, efren Ppp', '2020-2021', '1ST');

-- --------------------------------------------------------

--
-- Table structure for table `user_account`
--

CREATE TABLE `user_account` (
  `id` int(11) NOT NULL,
  `name` varchar(500) NOT NULL,
  `username` varchar(500) NOT NULL,
  `password` varchar(500) NOT NULL,
  `account_type` varchar(500) NOT NULL,
  `student_number` varchar(500) NOT NULL,
  `email` varchar(500) NOT NULL,
  `otp` int(11) NOT NULL,
  `verification_status` varchar(500) NOT NULL,
  `fotp` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_account`
--

INSERT INTO `user_account` (`id`, `name`, `username`, `password`, `account_type`, `student_number`, `email`, `otp`, `verification_status`, `fotp`) VALUES
(1, 'joash', 'admin', 'admin', 'admin', '', '', 0, 'true', 0),
(2, 'Cabanilla, Joash Florentino', 'student', 'student', 'student', '20181562', 'joash0199@gmail.com', 0, 'true', 0),
(3, 'Cabanilla, Joash Florentino', 'professor', 'professor', 'professor', '', 'joash0199@gmail.com', 0, 'true', 0),
(4, 'Victoria, efren Ppp', 'efren123', 'asdasd', 'professor', '', 'efren@gmail.com', 0, 'true', 0),
(5, 'sad, asd asd', 'asdasdas', 'asdasd', 'professor', '', 'asd@gmail.com', 0, 'true', 0),
(6, 'sad, asd a', 'efren123asds', 'asdasd', 'professor', '', 'wqewqewq@gmail.com', 0, 'true', 0),
(7, 'Cabanilla, Joash Florentino', 'student1', 'student1', 'student', '20181561', 'joash0199@gmail.com', 0, 'true', 0),
(8, 'cabanilla, wew we we', 'student2', 'asdasd', 'student', '2222', 'we@gmail.com', 0, 'true', 0),
(9, 'asd, aasd asd', 'redred', 'asdasd', 'student', '222', 'aasd@gmail.com', 0, 'true', 0),
(10, 'www, wwww www', 'asdasd', 'asdasd', 'student', '33333', 'asdas@gmail.com', 0, 'true', 0),
(11, 'red, red red', 'redred1', 'redred', 'student', '12345', 'red123@gmail.com', 994599, 'false', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `evaluation`
--
ALTER TABLE `evaluation`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `evaluation_setting`
--
ALTER TABLE `evaluation_setting`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `profname`
--
ALTER TABLE `profname`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `school_year`
--
ALTER TABLE `school_year`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subject`
--
ALTER TABLE `subject`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subject_irregular`
--
ALTER TABLE `subject_irregular`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_account`
--
ALTER TABLE `user_account`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `evaluation`
--
ALTER TABLE `evaluation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `evaluation_setting`
--
ALTER TABLE `evaluation_setting`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `profname`
--
ALTER TABLE `profname`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `school_year`
--
ALTER TABLE `school_year`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `subject`
--
ALTER TABLE `subject`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `subject_irregular`
--
ALTER TABLE `subject_irregular`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `user_account`
--
ALTER TABLE `user_account`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
