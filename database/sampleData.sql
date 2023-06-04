-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jun 04, 2023 at 11:31 AM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 8.0.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `quizller`
--

-- --------------------------------------------------------

--
-- Table structure for table `classes`
--

CREATE TABLE `classes` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `classes`
--

INSERT INTO `classes` (`id`, `name`) VALUES
(1, 'Web class');

-- --------------------------------------------------------

--
-- Table structure for table `Questions`
--

CREATE TABLE `Questions` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `optionA` varchar(255) NOT NULL,
  `optionB` varchar(255) NOT NULL,
  `optionC` varchar(255) NOT NULL,
  `optionD` varchar(255) NOT NULL,
  `correctAns` varchar(255) NOT NULL,
  `score` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `Questions`
--

INSERT INTO `Questions` (`id`, `title`, `optionA`, `optionB`, `optionC`, `optionD`, `correctAns`, `score`) VALUES
(1, 'Which of the following attributes is used to add link to any element?', 'link', 'ref', 'href', 'newref', 'c', 10),
(2, 'Which of the following attributes is used to open an hyperlink in new tab?', 'tab', 'href', 'target', 'ref', 'c', 20),
(3, 'Which of the following attributes is used to add link to any element?', 'link', 'ref', 'href', 'newref', 'c', 10),
(4, 'Which of the following attributes is used to open an hyperlink in new tab?', 'tab', 'href', 'target', 'ref', 'c', 10);

-- --------------------------------------------------------

--
-- Table structure for table `question_test_mapping`
--

CREATE TABLE `question_test_mapping` (
  `question_id` int(11) NOT NULL,
  `test_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `question_test_mapping`
--

INSERT INTO `question_test_mapping` (`question_id`, `test_id`) VALUES
(1, 1),
(2, 1),
(3, 2),
(4, 2);

-- --------------------------------------------------------

--
-- Table structure for table `score`
--

CREATE TABLE `score` (
  `id` int(11) NOT NULL,
  `test_id` int(11) NOT NULL,
  `question_id` int(11) NOT NULL,
  `correct_count` int(11) NOT NULL,
  `wrong_count` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `score`
--

INSERT INTO `score` (`id`, `test_id`, `question_id`, `correct_count`, `wrong_count`) VALUES
(1, 1, 1, 2, 0),
(2, 1, 2, 1, 1),
(3, 2, 3, 0, 0),
(4, 2, 4, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `status`
--

CREATE TABLE `status` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `status`
--

INSERT INTO `status` (`id`, `name`) VALUES
(1, 'PENDING'),
(2, 'RUNNING'),
(3, 'COMPLETED');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` int(11) NOT NULL,
  `test_id` int(11) NOT NULL,
  `rollno` int(11) NOT NULL,
  `password` varchar(255) NOT NULL,
  `score` int(255) NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `test_id`, `rollno`, `password`, `score`, `status`) VALUES
(1, 1, 1, 'fvOIe421', 30, 1),
(2, 1, 2, 'jVOTAgB1', 10, 1),
(3, 1, 3, 'yKMVVcb1', 0, 0),
(4, 1, 4, '8MbEtVX1', 0, 0),
(5, 1, 5, 'd0lABPl1', 0, 0),
(6, 1, 6, 'eIgGrTG1', 0, 0),
(7, 1, 7, 'FNXCrVe1', 0, 0),
(8, 1, 8, 'LRtQ5uM1', 0, 0),
(9, 1, 9, 'yWtQtGv1', 0, 0),
(10, 1, 10, 't90pLUp1', 0, 0),
(11, 1, 11, 'rgnrgXU1', 0, 0),
(12, 2, 1, 'c5mfcXP2', 0, 0),
(13, 2, 2, 'EbbXzZg2', 0, 0),
(14, 2, 3, 'YYQ6ubk2', 0, 0),
(15, 2, 4, '6CJyQQa2', 0, 0),
(16, 2, 5, 'JN9ZQ2V2', 0, 0),
(17, 2, 6, 'uGr9d0r2', 0, 0),
(18, 2, 7, 'mhylzzP2', 0, 0),
(19, 2, 8, 'ZCFQJy42', 0, 0),
(20, 2, 9, 'wAGyMF72', 0, 0),
(21, 2, 10, 'Ji1oFuD2', 0, 0),
(22, 2, 11, 'XoryU2r2', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `student_data`
--

CREATE TABLE `student_data` (
  `id` int(11) NOT NULL,
  `rollno` bigint(20) NOT NULL,
  `class_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `student_data`
--

INSERT INTO `student_data` (`id`, `rollno`, `class_id`) VALUES
(1, 1000, 1),
(2, 1001, 1),
(3, 1002, 1),
(4, 1003, 1),
(5, 1004, 1),
(6, 1005, 1),
(7, 1006, 1),
(8, 1007, 1),
(9, 1008, 1),
(10, 1009, 1),
(11, 1010, 1);

-- --------------------------------------------------------

--
-- Table structure for table `teachers`
--

CREATE TABLE `teachers` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `teachers`
--

INSERT INTO `teachers` (`id`, `email`, `password`) VALUES
(1, 'admin', '37bd45d638c2d11c49c641d2e9c4f49f406caf3ee282743e0c800aa1ed68e2ee');

-- --------------------------------------------------------

--
-- Table structure for table `tests`
--

CREATE TABLE `tests` (
  `id` int(11) NOT NULL,
  `teacher_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `status_id` int(11) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `total_questions` int(11) NOT NULL,
  `class_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tests`
--

INSERT INTO `tests` (`id`, `teacher_id`, `name`, `date`, `status_id`, `subject`, `total_questions`, `class_id`) VALUES
(1, 1, 'Developer Quiz', '2023-05-30', 3, 'General', 2, 1),
(2, 1, 'Developer Quiz Test 1', '2023-05-30', 2, 'General', 2, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `classes`
--
ALTER TABLE `classes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `Questions`
--
ALTER TABLE `Questions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `question_test_mapping`
--
ALTER TABLE `question_test_mapping`
  ADD PRIMARY KEY (`question_id`,`test_id`),
  ADD KEY `question_test_mapping_fk1` (`test_id`);

--
-- Indexes for table `score`
--
ALTER TABLE `score`
  ADD PRIMARY KEY (`id`),
  ADD KEY `score_fk0` (`test_id`),
  ADD KEY `score_fk1` (`question_id`);

--
-- Indexes for table `status`
--
ALTER TABLE `status`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`),
  ADD KEY `students_fk0` (`test_id`),
  ADD KEY `students_fk1` (`rollno`);

--
-- Indexes for table `student_data`
--
ALTER TABLE `student_data`
  ADD PRIMARY KEY (`id`),
  ADD KEY `student_data_fk0` (`class_id`);

--
-- Indexes for table `teachers`
--
ALTER TABLE `teachers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tests`
--
ALTER TABLE `tests`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tests_fk0` (`teacher_id`),
  ADD KEY `tests_fk1` (`status_id`),
  ADD KEY `tests_fk2` (`class_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `classes`
--
ALTER TABLE `classes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `Questions`
--
ALTER TABLE `Questions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `score`
--
ALTER TABLE `score`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `status`
--
ALTER TABLE `status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `student_data`
--
ALTER TABLE `student_data`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `teachers`
--
ALTER TABLE `teachers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tests`
--
ALTER TABLE `tests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `question_test_mapping`
--
ALTER TABLE `question_test_mapping`
  ADD CONSTRAINT `question_test_mapping_fk0` FOREIGN KEY (`question_id`) REFERENCES `Questions` (`id`),
  ADD CONSTRAINT `question_test_mapping_fk1` FOREIGN KEY (`test_id`) REFERENCES `tests` (`id`);

--
-- Constraints for table `score`
--
ALTER TABLE `score`
  ADD CONSTRAINT `score_fk0` FOREIGN KEY (`test_id`) REFERENCES `tests` (`id`),
  ADD CONSTRAINT `score_fk1` FOREIGN KEY (`question_id`) REFERENCES `Questions` (`id`);

--
-- Constraints for table `students`
--
ALTER TABLE `students`
  ADD CONSTRAINT `students_fk0` FOREIGN KEY (`test_id`) REFERENCES `tests` (`id`),
  ADD CONSTRAINT `students_fk1` FOREIGN KEY (`rollno`) REFERENCES `student_data` (`id`);

--
-- Constraints for table `student_data`
--
ALTER TABLE `student_data`
  ADD CONSTRAINT `student_data_fk0` FOREIGN KEY (`class_id`) REFERENCES `classes` (`id`);

--
-- Constraints for table `tests`
--
ALTER TABLE `tests`
  ADD CONSTRAINT `tests_fk0` FOREIGN KEY (`teacher_id`) REFERENCES `teachers` (`id`),
  ADD CONSTRAINT `tests_fk1` FOREIGN KEY (`status_id`) REFERENCES `status` (`id`),
  ADD CONSTRAINT `tests_fk2` FOREIGN KEY (`class_id`) REFERENCES `classes` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
