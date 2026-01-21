-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 21, 2026 at 12:07 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `college_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` int(11) NOT NULL,
  `roll_no` varchar(20) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `class` varchar(50) DEFAULT 'BCA-III (SEM-VI)',
  `commits_count` int(11) DEFAULT 0,
  `last_commit_date` date DEFAULT NULL,
  `github_url` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `roll_no`, `name`, `email`, `class`, `commits_count`, `last_commit_date`, `github_url`) VALUES
(1, 'BCA301', 'Rahul Sharma', 'rahul.s@example.com', 'BCA-III (SEM-VI)', 12, '2026-01-16', 'https://github.com/rahul-s'),
(2, 'BCA302', 'Priya Patil', 'priya.p@example.com', 'BCA-III (SEM-VI)', 15, '2026-01-17', 'https://github.com/priya-p'),
(3, 'BCA303', 'Amit Deshmukh', 'amit.d@example.com', 'BCA-III (SEM-VI)', 8, '2026-01-15', 'https://github.com/amit-d'),
(4, 'BCA304', 'Sneha Kulkarni', 'sneha.k@example.com', 'BCA-III (SEM-VI)', 20, '2026-01-17', 'https://github.com/sneha-k'),
(5, 'BCA305', 'Vikram Pawar', 'vikram.p@example.com', 'BCA-III (SEM-VI)', 5, '2026-01-14', 'https://github.com/vikram-p');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
