-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 13, 2025 at 10:02 AM
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
-- Database: `db_lms`
--

-- --------------------------------------------------------

--
-- Table structure for table `borrower`
--

CREATE TABLE `borrower` (
  `borrower_id` int(11) NOT NULL,
  `firstname` varchar(100) NOT NULL,
  `middlename` varchar(100) NOT NULL,
  `lastname` varchar(100) NOT NULL,
  `contact_no` varchar(15) NOT NULL,
  `address` text NOT NULL,
  `email` varchar(30) NOT NULL,
  `tax_id` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `borrower`
--

INSERT INTO `borrower` (`borrower_id`, `firstname`, `middlename`, `lastname`, `contact_no`, `address`, `email`, `tax_id`) VALUES
(2, 'Axmed ', 'Nuur', 'Apdulaahi', '0634675647', 'Hargeisa', 'axmednuur@gmailcom', '1012345666'),
(4, 'Nimco ', 'Nuur ', 'Ceegaag', '0634876113', 'Hargeisa', 'nimco@gmail.com', '3114567754'),
(5, 'Apdiraxmaan', 'Ismaaciil', 'Yusuf', '0634835991', 'Hargeisa', 'apdirahmaan@gmail.com', '312336788'),
(6, 'Sakariye', 'Maxamed ', 'Apdulaahi', '0634876114', 'Hargeisa', 'axmednuur@gmailcom', '15273925'),
(7, 'Cumer ', 'Axmed', 'nour', '0634577892', 'Hargeisa', 'cumer@gmail.com', '45555558736'),
(8, 'Canab', 'Axmed', 'Muuse', '0634675647', 'Hargeisa', 'canab@gmail.com', '233438888'),
(9, 'Axmed ', 'Nuur ', 'Ibraahim', '4433', 'bor', 'abko@gmail.com', '12345678');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `id` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `tax_id` varchar(100) NOT NULL,
  `firstname` varchar(50) DEFAULT NULL,
  `middlename` varchar(50) DEFAULT NULL,
  `lastname` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`id`, `email`, `password`, `phone`, `address`, `created_at`, `tax_id`, `firstname`, `middlename`, `lastname`) VALUES
(20, 'abko@gmail.com', '$2y$10$Ycq28AsR2DhYXb5Pj8hrPuaM6.HuMxT1rSiYbbKof/Z1fyqIYhpGK', '4433', 'bor', '2025-07-06 10:44:30', '12345678', 'Axmed ', 'Nuur ', 'Ibraahim'),
(21, 'apdirahmaan@gmail.com', '$2y$10$q6TFjFgNeW3AId5r8y1F1.cUCaFeGON9UNmvcBdArECtsLPZHBLgu', '0634836991', 'Germany ', '2025-07-06 11:44:10', '167890821', 'Cado', 'ismacil', 'yusuf'),
(22, 'muxumed@gmail.com', '$2y$10$LMM92NXaAoNkXqpxtvUnZ.GM.LyxaDXyY/yFZF0cWho9op8RRWwIS', '4453', 'gabilay', '2025-07-06 15:14:34', '4255362', 'siciid', 'cabdi', 'muxumed');

-- --------------------------------------------------------

--
-- Table structure for table `guarantor`
--

CREATE TABLE `guarantor` (
  `guarantor_id` int(11) NOT NULL,
  `borrower_id` int(11) DEFAULT NULL,
  `full_name` varchar(100) DEFAULT NULL,
  `gender` enum('Male','Female','Other') DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `contact` varchar(20) DEFAULT NULL,
  `job` varchar(100) DEFAULT NULL,
  `company_name` varchar(100) DEFAULT NULL,
  `national_id` varchar(50) DEFAULT NULL,
  `documentation` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `guarantor`
--

INSERT INTO `guarantor` (`guarantor_id`, `borrower_id`, `full_name`, `gender`, `address`, `contact`, `job`, `company_name`, `national_id`, `documentation`) VALUES
(3, 5, 'Cismaan Apdulahi Nuur', 'Male', 'Hargeisa', '0634918818', 'Business', 'Horseed company', '09334566', '1750073298_YusufApdiraxmaanIsmaaciilResume.pdf');

-- --------------------------------------------------------

--
-- Table structure for table `invest_product`
--

CREATE TABLE `invest_product` (
  `product_id` int(11) NOT NULL,
  `borrower_id` int(11) DEFAULT NULL,
  `product_name` varchar(200) DEFAULT NULL,
  `price_estimate` decimal(10,2) DEFAULT NULL,
  `job` varchar(100) DEFAULT NULL,
  `income` decimal(10,2) DEFAULT NULL,
  `documentation` varchar(255) DEFAULT NULL,
  `date_created` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `invest_product`
--

INSERT INTO `invest_product` (`product_id`, `borrower_id`, `product_name`, `price_estimate`, `job`, `income`, `documentation`, `date_created`) VALUES
(0, 5, 'Laptop', 700.00, 'Developer', 500.00, '1750073167_My Resume.pdf', '2025-06-16');

-- --------------------------------------------------------

--
-- Table structure for table `loan`
--

CREATE TABLE `loan` (
  `loan_id` int(11) NOT NULL,
  `ref_no` varchar(50) NOT NULL,
  `ltype_id` int(30) NOT NULL,
  `borrower_id` int(30) NOT NULL,
  `purpose` text NOT NULL,
  `amount` double NOT NULL,
  `lplan_id` int(30) NOT NULL,
  `status` tinyint(1) NOT NULL COMMENT '0=request, 1=confirmed, 2=released, 3=completed, 4=denied',
  `date_released` datetime NOT NULL,
  `date_created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `loan`
--

INSERT INTO `loan` (`loan_id`, `ref_no`, `ltype_id`, `borrower_id`, `purpose`, `amount`, `lplan_id`, `status`, `date_released`, `date_created`) VALUES
(1, '59895370', 1, 1, 'For study', 500, 1, 2, '2025-05-30 13:26:34', '2025-05-24 06:51:36'),
(2, '58903321', 1, 2, 'for business', 1500, 1, 2, '2025-05-31 02:38:07', '2025-05-29 06:56:06'),
(3, '57629624', 2, 3, 'He need money to invest his business ', 4000, 3, 2, '2025-05-31 03:34:20', '2025-05-31 03:33:31'),
(4, '8953505', 1, 1, 'for study', 4000, 1, 2, '2025-06-03 06:55:49', '2025-06-03 06:55:25'),
(5, '0634876113', 2, 4, 'vvvvvvvvvvvvvvvv', 60000, 2, 2, '2025-06-20 09:51:48', '2025-06-20 09:49:48'),
(6, '0634876114', 1, 6, 'Ma aqaan', 3400, 1, 2, '2025-06-20 09:53:56', '2025-06-20 09:53:41'),
(7, '0634577892', 2, 7, 'business for 10 pc', 6000, 1, 2, '2025-06-22 07:13:49', '2025-06-22 07:12:59'),
(8, '0634675647', 2, 8, 'hdhhhhh', 70000, 1, 2, '2025-06-26 08:02:50', '2025-06-26 08:02:38'),
(9, '0634835991', 2, 5, 'bi', 4000, 2, 3, '2025-07-06 09:22:39', '2025-07-06 09:22:06');

-- --------------------------------------------------------

--
-- Table structure for table `loan_plan`
--

CREATE TABLE `loan_plan` (
  `lplan_id` int(11) NOT NULL,
  `lplan_month` int(11) NOT NULL,
  `lplan_interest` float NOT NULL,
  `lplan_penalty` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `loan_plan`
--

INSERT INTO `loan_plan` (`lplan_id`, `lplan_month`, `lplan_interest`, `lplan_penalty`) VALUES
(1, 12, 10, 3),
(2, 6, 5, 3),
(3, 24, 25, 8);

-- --------------------------------------------------------

--
-- Table structure for table `loan_requests`
--

CREATE TABLE `loan_requests` (
  `request_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `loan_type_id` int(11) NOT NULL,
  `loan_plan` int(11) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `reason` text NOT NULL,
  `date_needed` date NOT NULL,
  `status` enum('Pending','Approved','Rejected') DEFAULT 'Pending',
  `date_requested` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `loan_requests`
--

INSERT INTO `loan_requests` (`request_id`, `customer_id`, `loan_type_id`, `loan_plan`, `amount`, `reason`, `date_needed`, `status`, `date_requested`) VALUES
(6, 20, 1, 2, 123.00, 'hos', '2025-07-15', 'Approved', '2025-07-06 11:02:56'),
(7, 21, 1, 1, 4000.00, 'gaadhi vits ah 2002 maal galin shakhsi', '2025-07-06', 'Rejected', '2025-07-06 11:45:32'),
(8, 21, 2, 2, 4000.00, 'hooo', '2025-07-06', 'Approved', '2025-07-06 17:18:38');

-- --------------------------------------------------------

--
-- Table structure for table `loan_schedule`
--

CREATE TABLE `loan_schedule` (
  `loan_sched_id` int(50) NOT NULL,
  `loan_id` int(11) NOT NULL,
  `due_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `loan_schedule`
--

INSERT INTO `loan_schedule` (`loan_sched_id`, `loan_id`, `due_date`) VALUES
(1, 1, '2025-06-30'),
(2, 1, '2025-07-30'),
(3, 1, '2025-08-30'),
(4, 1, '2025-09-30'),
(5, 1, '2025-10-30'),
(6, 1, '2025-11-30'),
(7, 1, '2025-12-30'),
(8, 1, '2026-01-30'),
(9, 1, '2026-03-02'),
(10, 1, '2026-03-30'),
(11, 1, '2026-04-30'),
(12, 1, '2026-05-30'),
(13, 2, '2025-07-01'),
(14, 2, '2025-07-31'),
(15, 2, '2025-08-31'),
(16, 2, '2025-10-01'),
(17, 2, '2025-10-31'),
(18, 2, '2025-12-01'),
(19, 2, '2025-12-31'),
(20, 2, '2026-01-31'),
(21, 2, '2026-03-03'),
(22, 2, '2026-03-31'),
(23, 2, '2026-05-01'),
(24, 2, '2026-05-31'),
(25, 3, '2025-07-01'),
(26, 3, '2025-07-31'),
(27, 3, '2025-08-31'),
(28, 3, '2025-10-01'),
(29, 3, '2025-10-31'),
(30, 3, '2025-12-01'),
(31, 3, '2025-12-31'),
(32, 3, '2026-01-31'),
(33, 3, '2026-03-03'),
(34, 3, '2026-03-31'),
(35, 3, '2026-05-01'),
(36, 3, '2026-05-31'),
(37, 3, '2026-07-01'),
(38, 3, '2026-07-31'),
(39, 3, '2026-08-31'),
(40, 3, '2026-10-01'),
(41, 3, '2026-10-31'),
(42, 3, '2026-12-01'),
(43, 3, '2026-12-31'),
(44, 3, '2027-01-31'),
(45, 3, '2027-03-03'),
(46, 3, '2027-03-31'),
(47, 3, '2027-05-01'),
(48, 3, '2027-05-31'),
(49, 4, '2025-07-03'),
(50, 4, '2025-08-03'),
(51, 4, '2025-09-03'),
(52, 4, '2025-10-03'),
(53, 4, '2025-11-03'),
(54, 4, '2025-12-03'),
(55, 4, '2026-01-03'),
(56, 4, '2026-02-03'),
(57, 4, '2026-03-03'),
(58, 4, '2026-04-03'),
(59, 4, '2026-05-03'),
(60, 4, '2026-06-03'),
(61, 5, '2025-07-20'),
(62, 5, '2025-08-20'),
(63, 5, '2025-09-20'),
(64, 5, '2025-10-20'),
(65, 5, '2025-11-20'),
(66, 5, '2025-12-20'),
(67, 6, '2025-07-20'),
(68, 6, '2025-08-20'),
(69, 6, '2025-09-20'),
(70, 6, '2025-10-20'),
(71, 6, '2025-11-20'),
(72, 6, '2025-12-20'),
(73, 6, '2026-01-20'),
(74, 6, '2026-02-20'),
(75, 6, '2026-03-20'),
(76, 6, '2026-04-20'),
(77, 6, '2026-05-20'),
(78, 6, '2026-06-20'),
(79, 7, '2025-07-22'),
(80, 7, '2025-08-22'),
(81, 7, '2025-09-22'),
(82, 7, '2025-10-22'),
(83, 7, '2025-11-22'),
(84, 7, '2025-12-22'),
(85, 7, '2026-01-22'),
(86, 7, '2026-02-22'),
(87, 7, '2026-03-22'),
(88, 7, '2026-04-22'),
(89, 7, '2026-05-22'),
(90, 7, '2026-06-22'),
(91, 8, '2025-07-26'),
(92, 8, '2025-08-26'),
(93, 8, '2025-09-26'),
(94, 8, '2025-10-26'),
(95, 8, '2025-11-26'),
(96, 8, '2025-12-26'),
(97, 8, '2026-01-26'),
(98, 8, '2026-02-26'),
(99, 8, '2026-03-26'),
(100, 8, '2026-04-26'),
(101, 8, '2026-05-26'),
(102, 8, '2026-06-26'),
(103, 9, '2025-08-06'),
(104, 9, '2025-09-06'),
(105, 9, '2025-10-06'),
(106, 9, '2025-11-06'),
(107, 9, '2025-12-06'),
(108, 9, '2026-01-06');

-- --------------------------------------------------------

--
-- Table structure for table `loan_type`
--

CREATE TABLE `loan_type` (
  `ltype_id` int(11) NOT NULL,
  `ltype_name` text NOT NULL,
  `ltype_desc` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `loan_type`
--

INSERT INTO `loan_type` (`ltype_id`, `ltype_name`, `ltype_desc`) VALUES
(1, 'personal', 'Laptop'),
(2, 'Business', '10 PC for Business');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` int(11) NOT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `message` text DEFAULT NULL,
  `is_read` tinyint(4) DEFAULT 0,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `customer_id`, `message`, `is_read`, `created_at`) VALUES
(1, 21, 'SOO DIR LACAGTA LAGAA RABO', 0, '2025-07-06 17:52:39'),
(2, 22, 'muxumed soo dhawoow sona dir lacagta', 0, '2025-07-06 18:16:09'),
(3, 20, '[February]: Soo bixi lacagta', 0, '2025-07-06 18:25:30'),
(4, 20, '[March]: Soo bixi lacagta', 0, '2025-07-06 18:25:30'),
(5, 20, '[April]: Soo bixi lacagta', 0, '2025-07-06 18:25:30'),
(6, 20, '[May]: Soo bixi lacagta', 0, '2025-07-06 18:25:30'),
(7, 20, '[June]: Soo bixi lacagta', 0, '2025-07-06 18:25:30'),
(8, 20, '[July]: Soo bixi lacagta', 0, '2025-07-06 18:25:30'),
(9, 20, '[August]: Soo bixi lacagta', 0, '2025-07-06 18:25:30'),
(10, 20, '[September]: Soo bixi lacagta', 0, '2025-07-06 18:25:30'),
(11, 20, '[October]: Soo bixi lacagta', 0, '2025-07-06 18:25:30'),
(12, 20, '[November]: Soo bixi lacagta', 0, '2025-07-06 18:25:30'),
(13, 20, '[December]: Soo bixi lacagta', 0, '2025-07-06 18:25:30'),
(14, 22, '[August]: sooo dahdnd', 0, '2025-07-06 18:26:03'),
(15, 22, '[September]: sooo dahdnd', 0, '2025-07-06 18:26:03'),
(16, 22, '[October]: sooo dahdnd', 0, '2025-07-06 18:26:03'),
(17, 22, '[November]: sooo dahdnd', 0, '2025-07-06 18:26:03'),
(18, 22, '[December]: sooo dahdnd', 0, '2025-07-06 18:26:03'),
(19, 20, '[February]: hellow', 0, '2025-07-06 20:04:45'),
(20, 20, '[March]: hellow', 0, '2025-07-06 20:04:45'),
(21, 20, '[April]: hellow', 0, '2025-07-06 20:04:45'),
(22, 21, '[January]: soo dir lacagta', 0, '2025-07-06 20:07:15'),
(23, 21, '[February]: soo dir lacagta', 0, '2025-07-06 20:07:15'),
(24, 21, '[March]: soo dir lacagta', 0, '2025-07-06 20:07:15'),
(25, 21, '[April]: soo dir lacagta', 0, '2025-07-06 20:07:15'),
(26, 21, '[May]: soo dir lacagta', 0, '2025-07-06 20:07:15'),
(27, 21, '[June]: soo dir lacagta', 0, '2025-07-06 20:07:15'),
(28, 21, '[July]: soo dir lacagta', 0, '2025-07-06 20:07:15'),
(29, 21, '[August]: soo dir lacagta', 0, '2025-07-06 20:07:15'),
(30, 21, '[September]: soo dir lacagta', 0, '2025-07-06 20:07:15'),
(31, 21, '[October]: soo dir lacagta', 0, '2025-07-06 20:07:15'),
(32, 21, '[November]: soo dir lacagta', 0, '2025-07-06 20:07:15'),
(33, 21, '[December]: soo dir lacagta', 0, '2025-07-06 20:07:15'),
(34, 21, '[January]: soo dir lacagta', 0, '2025-07-06 20:09:53'),
(35, 21, '[February]: soo dir lacagta', 0, '2025-07-06 20:09:53'),
(36, 21, '[March]: soo dir lacagta', 0, '2025-07-06 20:09:53'),
(37, 21, '[April]: soo dir lacagta', 0, '2025-07-06 20:09:53'),
(38, 21, '[May]: soo dir lacagta', 0, '2025-07-06 20:09:53'),
(39, 21, '[June]: soo dir lacagta', 0, '2025-07-06 20:09:53'),
(40, 21, '[July]: soo dir lacagta', 0, '2025-07-06 20:09:53'),
(41, 21, '[August]: soo dir lacagta', 0, '2025-07-06 20:09:53'),
(42, 21, '[September]: soo dir lacagta', 0, '2025-07-06 20:09:53'),
(43, 21, '[October]: soo dir lacagta', 0, '2025-07-06 20:09:53'),
(44, 21, '[November]: soo dir lacagta', 0, '2025-07-06 20:09:53'),
(45, 21, '[December]: soo dir lacagta', 0, '2025-07-06 20:09:53'),
(46, 21, '[January]: soo dir lacagta', 0, '2025-07-06 20:10:02'),
(47, 21, '[February]: soo dir lacagta', 0, '2025-07-06 20:10:02'),
(48, 21, '[March]: soo dir lacagta', 0, '2025-07-06 20:10:02'),
(49, 21, '[April]: soo dir lacagta', 0, '2025-07-06 20:10:02'),
(50, 21, '[May]: soo dir lacagta', 0, '2025-07-06 20:10:02'),
(51, 21, '[June]: soo dir lacagta', 0, '2025-07-06 20:10:02'),
(52, 21, '[July]: soo dir lacagta', 0, '2025-07-06 20:10:02'),
(53, 21, '[August]: soo dir lacagta', 0, '2025-07-06 20:10:02'),
(54, 21, '[September]: soo dir lacagta', 0, '2025-07-06 20:10:02'),
(55, 21, '[October]: soo dir lacagta', 0, '2025-07-06 20:10:02'),
(56, 21, '[November]: soo dir lacagta', 0, '2025-07-06 20:10:02'),
(57, 21, '[December]: soo dir lacagta', 0, '2025-07-06 20:10:02'),
(58, 21, '[January]: soo dir lacagta', 0, '2025-07-06 20:11:56'),
(59, 21, '[February]: soo dir lacagta', 0, '2025-07-06 20:11:56'),
(60, 21, '[March]: soo dir lacagta', 0, '2025-07-06 20:11:56'),
(61, 21, '[April]: soo dir lacagta', 0, '2025-07-06 20:11:56'),
(62, 21, '[May]: soo dir lacagta', 0, '2025-07-06 20:11:56'),
(63, 21, '[June]: soo dir lacagta', 0, '2025-07-06 20:11:56'),
(64, 21, '[July]: soo dir lacagta', 0, '2025-07-06 20:11:56'),
(65, 21, '[August]: soo dir lacagta', 0, '2025-07-06 20:11:56'),
(66, 21, '[September]: soo dir lacagta', 0, '2025-07-06 20:11:56'),
(67, 21, '[October]: soo dir lacagta', 0, '2025-07-06 20:11:56'),
(68, 21, '[November]: soo dir lacagta', 0, '2025-07-06 20:11:56'),
(69, 21, '[December]: soo dir lacagta', 0, '2025-07-06 20:11:56'),
(70, 21, '[January]: soo dir lacagta', 0, '2025-07-06 20:18:45'),
(71, 21, '[February]: soo dir lacagta', 0, '2025-07-06 20:18:45'),
(72, 21, '[March]: soo dir lacagta', 0, '2025-07-06 20:18:45'),
(73, 21, '[April]: soo dir lacagta', 0, '2025-07-06 20:18:45'),
(74, 21, '[May]: soo dir lacagta', 0, '2025-07-06 20:18:45'),
(75, 21, '[June]: soo dir lacagta', 0, '2025-07-06 20:18:45'),
(76, 21, '[July]: soo dir lacagta', 0, '2025-07-06 20:18:45'),
(77, 21, '[August]: soo dir lacagta', 0, '2025-07-06 20:18:45'),
(78, 21, '[September]: soo dir lacagta', 0, '2025-07-06 20:18:45'),
(79, 21, '[October]: soo dir lacagta', 0, '2025-07-06 20:18:45'),
(80, 21, '[November]: soo dir lacagta', 0, '2025-07-06 20:18:45'),
(81, 21, '[December]: soo dir lacagta', 0, '2025-07-06 20:18:45'),
(82, 21, '[June]: waa y gadha xy', 0, '2025-07-06 20:24:16'),
(83, 21, '[July]: waa y gadha xy', 0, '2025-07-06 20:24:16'),
(84, 21, '[August]: waa y gadha xy', 0, '2025-07-06 20:24:16'),
(85, 21, '[September]: waa y gadha xy', 0, '2025-07-06 20:24:16');

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `payment_id` int(11) NOT NULL,
  `loan_id` int(11) NOT NULL,
  `payee` text NOT NULL,
  `pay_amount` float NOT NULL,
  `penalty` float NOT NULL,
  `overdue` tinyint(1) NOT NULL COMMENT '0=no, 1=yes',
  `payment_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`payment_id`, `loan_id`, `payee`, `pay_amount`, `penalty`, `overdue`, `payment_date`) VALUES
(1, 1, 'Yusuf, Apdiraxmaan I.', 45.83, 0, 0, '2025-05-31'),
(2, 2, 'Apdulaahi, Axmed  N.', 137.5, 0, 0, '2025-05-31'),
(4, 2, 'Apdulaahi, Axmed  N.', 137.5, 0, 0, '2025-05-31'),
(7, 3, 'Ibraahim, Apdicasiis M.', 208.33, 0, 0, '2025-05-31'),
(8, 2, 'Apdulaahi, Axmed  N.', 137.5, 0, 0, '2025-06-01'),
(9, 3, 'Ibraahim, Apdicasiis M.', 208.33, 0, 0, '2025-06-01'),
(10, 4, 'Yusuf, Apdiraxmaan I.', 366.67, 0, 0, '2025-06-03'),
(11, 4, 'Yusuf, Apdiraxmaan I.', 366.67, 0, 0, '2025-06-13'),
(12, 4, 'Yusuf, Apdiraxmaan I.', 366.67, 0, 0, '2025-06-13'),
(13, 4, 'Yusuf, Apdiraxmaan I.', 366.67, 0, 0, '2025-06-13'),
(14, 7, 'nour, Cumer  A.', 550, 0, 0, '2025-06-22'),
(15, 9, 'Yusuf, Apdiraxmaan I.', 700, 0, 0, '2025-07-12'),
(16, 9, 'Yusuf, Apdiraxmaan I.', 700, 0, 0, '2025-07-12'),
(17, 9, 'Yusuf, Apdiraxmaan I.', 700, 0, 0, '2025-07-12'),
(18, 9, 'Yusuf, Apdiraxmaan I.', 700, 0, 0, '2025-07-12'),
(19, 9, 'Yusuf, Apdiraxmaan I.', 700, 0, 0, '2025-07-12'),
(20, 9, 'Yusuf, Apdiraxmaan I.', 700, 0, 0, '2025-07-12');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(30) NOT NULL,
  `firstname` text NOT NULL,
  `lastname` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `username`, `password`, `firstname`, `lastname`) VALUES
(2, 'admin', 'admin', 'Administrator', ''),
(3, 'User', '123', 'Apdiraxmaan', 'ismacil');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `borrower`
--
ALTER TABLE `borrower`
  ADD PRIMARY KEY (`borrower_id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `guarantor`
--
ALTER TABLE `guarantor`
  ADD PRIMARY KEY (`guarantor_id`),
  ADD KEY `borrower_id` (`borrower_id`);

--
-- Indexes for table `invest_product`
--
ALTER TABLE `invest_product`
  ADD PRIMARY KEY (`product_id`),
  ADD KEY `borrower_id` (`borrower_id`);

--
-- Indexes for table `loan`
--
ALTER TABLE `loan`
  ADD PRIMARY KEY (`loan_id`);

--
-- Indexes for table `loan_plan`
--
ALTER TABLE `loan_plan`
  ADD PRIMARY KEY (`lplan_id`);

--
-- Indexes for table `loan_requests`
--
ALTER TABLE `loan_requests`
  ADD PRIMARY KEY (`request_id`),
  ADD KEY `customer_id` (`customer_id`),
  ADD KEY `loan_type_id` (`loan_type_id`),
  ADD KEY `loan_plan` (`loan_plan`);

--
-- Indexes for table `loan_schedule`
--
ALTER TABLE `loan_schedule`
  ADD PRIMARY KEY (`loan_sched_id`);

--
-- Indexes for table `loan_type`
--
ALTER TABLE `loan_type`
  ADD PRIMARY KEY (`ltype_id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`payment_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `borrower`
--
ALTER TABLE `borrower`
  MODIFY `borrower_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `guarantor`
--
ALTER TABLE `guarantor`
  MODIFY `guarantor_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `loan`
--
ALTER TABLE `loan`
  MODIFY `loan_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `loan_plan`
--
ALTER TABLE `loan_plan`
  MODIFY `lplan_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `loan_requests`
--
ALTER TABLE `loan_requests`
  MODIFY `request_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `loan_schedule`
--
ALTER TABLE `loan_schedule`
  MODIFY `loan_sched_id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=109;

--
-- AUTO_INCREMENT for table `loan_type`
--
ALTER TABLE `loan_type`
  MODIFY `ltype_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=86;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `guarantor`
--
ALTER TABLE `guarantor`
  ADD CONSTRAINT `guarantor_ibfk_1` FOREIGN KEY (`borrower_id`) REFERENCES `borrower` (`borrower_id`);

--
-- Constraints for table `invest_product`
--
ALTER TABLE `invest_product`
  ADD CONSTRAINT `invest_product_ibfk_1` FOREIGN KEY (`borrower_id`) REFERENCES `borrower` (`borrower_id`);

--
-- Constraints for table `loan_requests`
--
ALTER TABLE `loan_requests`
  ADD CONSTRAINT `loan_requests_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `loan_requests_ibfk_2` FOREIGN KEY (`loan_type_id`) REFERENCES `loan_type` (`ltype_id`),
  ADD CONSTRAINT `loan_requests_ibfk_3` FOREIGN KEY (`loan_plan`) REFERENCES `loan_plan` (`lplan_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
