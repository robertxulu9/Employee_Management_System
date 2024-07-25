-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 25, 2024 at 12:13 PM
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
-- Database: `file_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `id` int(11) NOT NULL,
  `employee_id` varchar(50) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `middle_name` varchar(100) DEFAULT NULL,
  `dob` date NOT NULL,
  `gender` enum('Male','Female','Other') NOT NULL,
  `marital_status` enum('Single','Married','Divorced','Widowed') NOT NULL,
  `address` varchar(255) NOT NULL,
  `city` varchar(100) NOT NULL,
  `state` varchar(100) NOT NULL,
  `postal_code` varchar(20) NOT NULL,
  `country` varchar(100) NOT NULL,
  `phone_number` varchar(20) NOT NULL,
  `email_address` varchar(100) NOT NULL,
  `job_title` varchar(100) NOT NULL,
  `department` enum('Registry clerks','Human Resource officers','Chief Administrator','Director Human Resources and Administration','Deputy Director Human Resources','Chief Human Resource Management officer','Senior Human Resource officers','Chief accountant','Principal accountant','Senior Accountant','Accountants') NOT NULL,
  `date_of_hire` date NOT NULL,
  `employment_type` enum('Full-time','Part-time','Contract') NOT NULL,
  `work_location` varchar(100) NOT NULL,
  `manager_supervisor` varchar(100) DEFAULT NULL,
  `salary_wage` decimal(10,2) NOT NULL,
  `pay_frequency` enum('Weekly','Bi-weekly','Monthly') NOT NULL,
  `benefits_enrollment` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `used_leave_days` int(11) DEFAULT 0,
  `leave_status` enum('Active','On Leave') DEFAULT 'Active',
  `maternity_leave_days` int(11) DEFAULT 0,
  `on_maternity_leave` enum('Yes','No') DEFAULT 'No'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`id`, `employee_id`, `first_name`, `last_name`, `middle_name`, `dob`, `gender`, `marital_status`, `address`, `city`, `state`, `postal_code`, `country`, `phone_number`, `email_address`, `job_title`, `department`, `date_of_hire`, `employment_type`, `work_location`, `manager_supervisor`, `salary_wage`, `pay_frequency`, `benefits_enrollment`, `created_at`, `updated_at`, `used_leave_days`, `leave_status`, `maternity_leave_days`, `on_maternity_leave`) VALUES
(1, '5887687686867', 'Robert', 'Zulu', '', '1998-07-17', 'Male', 'Single', 'Central St Plot 9687', 'Lusaka', 'Lusaka', '45454', 'Zambia', '0771250133', 'robertxulu9@gmail.com', 'Boss', 'Chief Administrator', '2024-07-10', 'Full-time', 'hybrid', 'non', 99999999.99, 'Monthly', 'non', '2024-07-24 11:57:46', '2024-07-24 11:57:46', 0, 'Active', 0, 'No');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `department` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `job_title` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `department`, `password`, `created_at`, `job_title`) VALUES
(1, 'Robert Zulu', 'robertxulu9@gmail.com', 'Chief Administrator', '$2y$10$hceXvFdsw7dZY5/pL.ZylOQKNzJttscbOwXbIbcLvi4cJOmIYJQgy', '2024-07-18 11:59:15', ''),
(3, 'user name', 'example@email.com', 'Registry clerks', '$2y$10$EpfLO7PkWeraFgCeq5EVluFIruHON52RXS5Zs8ASRIQb9DEdDkesu', '2024-07-19 10:23:27', ''),
(5, 'hr user', 'hruser@email.com', 'Human Resource', '$2y$10$H6zLm3LC.IGFSMRcKeI5hOw7nAZrKFAchjYN4YZETY4VaMW8ZvYYa', '2024-07-25 04:41:30', 'Chief Human Resource Management officer');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `employee_id` (`employee_id`),
  ADD UNIQUE KEY `email_address` (`email_address`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
