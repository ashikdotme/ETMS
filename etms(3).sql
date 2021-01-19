-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 19, 2021 at 07:54 AM
-- Server version: 10.3.16-MariaDB
-- PHP Version: 7.2.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `etms`
--

-- --------------------------------------------------------

--
-- Table structure for table `em_admins`
--

CREATE TABLE `em_admins` (
  `ad_id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `designation` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `em_admins`
--

INSERT INTO `em_admins` (`ad_id`, `username`, `password`, `name`, `designation`) VALUES
(1, 'admin', '7b902e6ff1db9f560443f2048974fd7d386975b0', 'Admin', 'Adminstrator');

-- --------------------------------------------------------

--
-- Table structure for table `em_attendance`
--

CREATE TABLE `em_attendance` (
  `at_id` int(11) NOT NULL,
  `em_id` varchar(100) NOT NULL,
  `attendance` int(11) NOT NULL DEFAULT 0,
  `user_time` datetime NOT NULL,
  `system_time` datetime NOT NULL,
  `latitude` varchar(255) NOT NULL,
  `longitude` varchar(255) NOT NULL,
  `ip_address` varchar(255) NOT NULL,
  `device_details` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `em_attendance`
--

INSERT INTO `em_attendance` (`at_id`, `em_id`, `attendance`, `user_time`, `system_time`, `latitude`, `longitude`, `ip_address`, `device_details`) VALUES
(6, '1', 1, '2020-12-17 07:22:00', '2020-12-17 15:52:25', '25.8623', '88.654', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:83.0) Gecko/20100101 Firefox/83.0'),
(7, '1', 1, '2020-12-11 00:10:30', '2020-12-11 15:52:25', '25.8623', '88.654', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:83.0) Gecko/20100101 Firefox/83.0'),
(8, '1', 1, '2020-12-12 18:11:00', '2020-12-12 15:52:25', '25.8623', '88.654', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:83.0) Gecko/20100101 Firefox/83.0'),
(9, '1', 1, '2020-12-13 10:08:12', '2020-12-13 15:52:25', '25.8623', '88.654', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:83.0) Gecko/20100101 Firefox/83.0'),
(10, '1', 1, '2020-12-21 19:30:00', '2020-12-21 15:48:27', '25.8623', '88.654', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:84.0) Gecko/20100101 Firefox/84.0'),
(11, '6', 1, '2020-12-21 10:30:00', '2020-12-21 16:38:49', '25.4250834', '88.9207457', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:84.0) Gecko/20100101 Firefox/84.0'),
(13, '1', 1, '2020-12-23 15:40:00', '2020-12-23 15:41:50', '25.8623', '88.654', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:84.0) Gecko/20100101 Firefox/84.0'),
(14, '1', 1, '2021-01-12 14:20:00', '2021-01-12 18:05:37', 'NaN', 'NaN', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:84.0) Gecko/20100101 Firefox/84.0'),
(15, '1', 1, '2021-01-14 14:10:00', '2021-01-14 15:22:29', '25.496086', '88.950546', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:84.0) Gecko/20100101 Firefox/84.0'),
(16, '1', 1, '2021-02-14 14:10:00', '2021-02-14 15:22:29', '25.496086', '88.950546', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:84.0) Gecko/20100101 Firefox/84.0');

-- --------------------------------------------------------

--
-- Table structure for table `em_class`
--

CREATE TABLE `em_class` (
  `c_id` int(11) NOT NULL,
  `user_id` varchar(100) NOT NULL,
  `class_name` varchar(255) NOT NULL,
  `class_details` text NOT NULL,
  `date_time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `em_class`
--

INSERT INTO `em_class` (`c_id`, `user_id`, `class_name`, `class_details`, `date_time`) VALUES
(1, '1', 'Class 1', 'Today Practice HTML, CSS etc....', '2020-12-19 15:48:50'),
(2, '1', 'Class 2', 'here class details', '2020-12-19 16:15:39'),
(3, '1', 'Class 5', 'Today test class', '2020-12-23 15:50:47'),
(4, '2', 'Dashboard 1', 'Dashboard 1', '2021-01-14 15:27:00'),
(5, '1', 'Dashboard 2', 'Dashboard 2', '2021-01-14 15:27:06');

-- --------------------------------------------------------

--
-- Table structure for table `em_task`
--

CREATE TABLE `em_task` (
  `t_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `task_name` varchar(255) NOT NULL,
  `task_details` text NOT NULL,
  `submit_date_time` date NOT NULL,
  `status` varchar(255) NOT NULL,
  `date_time` datetime NOT NULL,
  `work_details` longtext DEFAULT NULL,
  `updated_at` datetime NOT NULL,
  `review` text DEFAULT NULL,
  `review_date` datetime NOT NULL,
  `task_read` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `em_task`
--

INSERT INTO `em_task` (`t_id`, `user_id`, `task_name`, `task_details`, `submit_date_time`, `status`, `date_time`, `work_details`, `updated_at`, `review`, `review_date`, `task_read`) VALUES
(1, 1, 'Test Task 1', 'Test Task Details..', '2020-12-28', 'NotApproved', '2020-12-26 15:57:42', 'here my files: https://twiiter.com', '2021-01-12 17:16:29', '<p>please solve all problem.</p><p>still here all problem 2<br></p>', '2021-01-12 17:19:27', 1),
(2, 1, 'Make a Form', 'Make a Form with HTML CSS', '2020-12-29', 'Completed', '2020-12-26 16:25:06', 'here my work details...', '2020-12-26 17:10:37', '<p>tes 3<br></p>', '2021-01-11 17:13:37', 1),
(4, 1, 'create a basic template', 'create a basic template', '2020-12-29', 'Pending', '2020-12-26 17:16:18', NULL, '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', 1),
(5, 1, 'Today Task', '<h2 align=\"center\">Test Tas<span style=\"background-color: rgb(255, 255, 0);\">k <span style=\"font-family: &quot;Comic Sans MS&quot;;\">Details...</span></span><br></h2>', '2021-01-07', 'Pending', '2021-01-03 15:46:50', NULL, '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', 1),
(6, 1, 'test', '<p><a href=\"https://google.com\" target=\"_blank\">google</a><br></p>', '2021-01-11', 'Completed', '2021-01-03 15:57:42', '<p>here my work : <a href=\"http://google.com\" target=\"_blank\">click here</a><br></p>', '2021-01-03 16:02:10', '<p>Great job.<br></p>', '2021-01-14 15:36:59', 1),
(7, 1, 'Create a Dashboard', '<p>Create a Dashboard<br></p>', '2021-01-15', 'Pending', '2021-01-14 15:34:07', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', 1),
(8, 1, 'Create a New PHP project', '<p>Create a New PHP project<br></p>', '2021-01-20', 'Pending', '2021-01-19 12:51:41', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `em_users`
--

CREATE TABLE `em_users` (
  `u_id` int(11) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `mobile` varchar(255) NOT NULL,
  `birthday` date NOT NULL,
  `blood_group` varchar(100) NOT NULL,
  `father_name` varchar(255) NOT NULL,
  `mother_name` varchar(255) NOT NULL,
  `f_or_m_mobile` varchar(100) NOT NULL,
  `edu` varchar(100) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `register_date` datetime NOT NULL,
  `email_verify` int(100) NOT NULL DEFAULT 0,
  `email_verify_code` varchar(100) DEFAULT NULL,
  `mobile_verify` int(11) NOT NULL DEFAULT 0,
  `mobile_verify_code` varchar(100) DEFAULT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `reset_code` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `em_users`
--

INSERT INTO `em_users` (`u_id`, `first_name`, `last_name`, `email`, `mobile`, `birthday`, `blood_group`, `father_name`, `mother_name`, `f_or_m_mobile`, `edu`, `address`, `password`, `register_date`, `email_verify`, `email_verify_code`, `mobile_verify`, `mobile_verify_code`, `photo`, `reset_code`) VALUES
(1, 'Md Al', 'Amin', 'alamin@gmail.com', '01859592359', '2020-12-16', 'B+', 'Amin', 'Arjina', '01752585858', 'Diploma', 'Dinajpur', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', '2020-12-03 16:21:43', 0, NULL, 1, '6088', '1.jpg', NULL),
(2, 'Rakib', 'Hosen', 'rakib@gmail.com', '01585458545', '2020-12-22', 'AB+', 'Jekono', 'Jekono', '01258547858', 'Diploma', 'Dinjapur', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', '2020-12-03 16:55:57', 1, NULL, 0, NULL, NULL, NULL),
(6, 'Sifat', 'Khan', 'sifatkhan@gmail.com', '01752585858', '2020-12-17', 'B+', 'Sifat Baba', 'Sifat Ma', '01752585858', 'Diploma', 'Rangpur', '601f1889667efaebb33b8c12572835da3f027f78', '2020-12-19 16:44:33', 0, NULL, 0, NULL, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `em_admins`
--
ALTER TABLE `em_admins`
  ADD PRIMARY KEY (`ad_id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `em_attendance`
--
ALTER TABLE `em_attendance`
  ADD PRIMARY KEY (`at_id`);

--
-- Indexes for table `em_class`
--
ALTER TABLE `em_class`
  ADD PRIMARY KEY (`c_id`);

--
-- Indexes for table `em_task`
--
ALTER TABLE `em_task`
  ADD PRIMARY KEY (`t_id`);

--
-- Indexes for table `em_users`
--
ALTER TABLE `em_users`
  ADD PRIMARY KEY (`u_id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `mobile` (`mobile`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `em_admins`
--
ALTER TABLE `em_admins`
  MODIFY `ad_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `em_attendance`
--
ALTER TABLE `em_attendance`
  MODIFY `at_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `em_class`
--
ALTER TABLE `em_class`
  MODIFY `c_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `em_task`
--
ALTER TABLE `em_task`
  MODIFY `t_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `em_users`
--
ALTER TABLE `em_users`
  MODIFY `u_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
