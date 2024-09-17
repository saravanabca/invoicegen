-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 12, 2024 at 03:35 PM
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
-- Database: `invoice_sky`
--

-- --------------------------------------------------------

--
-- Table structure for table `bank_details`
--

CREATE TABLE `bank_details` (
  `id` int(11) NOT NULL,
  `auth_mail` varchar(250) DEFAULT NULL,
  `company_id` int(11) DEFAULT NULL,
  `bank_active` int(11) NOT NULL DEFAULT 0,
  `account_no` varchar(250) DEFAULT NULL,
  `confirm_account_no` varchar(250) DEFAULT NULL,
  `ifsc_code` varchar(100) DEFAULT NULL,
  `bank_name` varchar(250) DEFAULT NULL,
  `branch_name` varchar(250) DEFAULT NULL,
  `type` enum('cash','bank') DEFAULT 'bank',
  `flag` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bank_details`
--

INSERT INTO `bank_details` (`id`, `auth_mail`, `company_id`, `bank_active`, `account_no`, `confirm_account_no`, `ifsc_code`, `bank_name`, `branch_name`, `type`, `flag`, `created_at`, `updated_at`) VALUES
(1, NULL, NULL, 1, NULL, NULL, NULL, 'Cash', NULL, 'cash', 1, '2024-07-23 05:50:33', '2024-08-07 12:47:36'),
(2, 'saravanabca16@gmail.com', 1, 0, '1234', '1234', 'UBIN0903850', 'Union Bank of India', 'ERAIYUR  KOOTHANUR', 'bank', 0, '2024-07-23 05:51:11', '2024-08-06 22:47:30'),
(3, 'saravanabca16@gmail.com', 1, 0, '1234', '1234', 'UBIN0903850', 'Union Bank of India', 'ERAIYUR  KOOTHANUR', 'bank', 0, '2024-07-24 02:24:17', '2024-07-24 02:24:54'),
(4, 'saravanabca16@gmail.com', 1, 0, '12345', '12345', 'UBIN0903850', 'Union Bank of Indiaa', 'ERAIYUR  KOOTHANURr', 'bank', 0, '2024-07-24 02:24:42', '2024-07-24 02:24:57'),
(5, 'saravanabca16@gmail.com', 1, 0, '1234', '1234', 'UBIN0903850', 'Union Bank of India', 'ERAIYUR  KOOTHANUR', 'bank', 0, '2024-07-24 05:51:29', '2024-08-06 22:47:33'),
(6, 'saravanabca16@gmail.com', 2, 1, '1234', '1234', 'dfghjkl', 'fghjkk', 'dfghjk', 'bank', 1, '2024-07-31 07:57:31', '2024-08-08 01:50:47'),
(7, 'saravanabca16@gmail.com', 1, 0, '1234', '1234', 'UBIN0903850', 'Union Bank of India', 'ERAIYUR  KOOTHANUR', 'bank', 0, '2024-08-07 04:56:41', '2024-08-07 04:56:59'),
(8, 'saravanabca16@gmail.com', 1, 1, '1234', '1234', 'UBIN0903850', 'Union Bank of India', 'ERAIYUR  KOOTHANUR', 'bank', 1, '2024-08-07 04:57:25', '2024-08-07 12:47:36'),
(9, 'saravanabca16@gmail.com', 4, 0, '12345', '12345', 'UBIN0903850', 'Union Bank of India', 'ERAIYUR  KOOTHANUR', 'bank', 0, '2024-08-07 07:05:39', '2024-08-07 07:06:09'),
(10, 'saravanabca16@gmail.com', 2, 1, '1111', '1111', 'UBIN0903850', 'Union Bank of India', 'ERAIYUR  KOOTHANUR', 'bank', 1, '2024-08-07 12:16:05', '2024-08-07 12:47:36'),
(11, 'saravanabca16@gmail.com', 2, 0, '111', '111', 'UBIN0903850', 'Union Bank of India', 'ERAIYUR  KOOTHANUR', 'bank', 0, '2024-08-07 12:16:17', '2024-08-07 12:32:41'),
(12, 'saravanabca16@gmail.com', 2, 0, '111111', '111111', 'UBIN0903850', 'Union Bank of India', 'ERAIYUR  KOOTHANUR', 'bank', 0, '2024-08-07 12:16:33', '2024-08-07 12:32:31'),
(13, 'saravanabca16@gmail.com', 2, 0, '11111', '11111', 'UBIN0903850', 'Union Bank of India', 'ERAIYUR  KOOTHANUR', 'bank', 0, '2024-08-07 12:17:13', '2024-08-07 12:32:35'),
(14, 'saravanabca16@gmail.com', 2, 1, '111', '111', 'UBIN0903850', 'Union Bank of India', 'ERAIYUR  KOOTHANUR', 'bank', 1, '2024-08-07 12:34:44', '2024-08-07 12:47:36'),
(15, 'saravanabca16@gmail.com', 2, 0, '111', '111', 'UBIN0903850', 'Union Bank of India', 'ERAIYUR  KOOTHANUR', 'bank', 0, '2024-08-07 12:47:09', '2024-08-07 12:47:36'),
(16, 'saravanabca16@gmail.com', 2, 0, '123', '123', 'UBIN0903850', 'Union Bank of India', 'ERAIYUR  KOOTHANUR', 'bank', 1, '2024-08-07 22:54:45', '2024-08-07 22:54:45'),
(17, 'saravanabca16@gmail.com', 2, 0, '1111', '1111', 'UBIN0903850', 'Union Bank of India', 'ERAIYUR  KOOTHANUR', 'bank', 1, '2024-08-08 01:51:30', '2024-08-08 01:51:30');

-- --------------------------------------------------------

--
-- Table structure for table `company`
--

CREATE TABLE `company` (
  `id` int(11) NOT NULL,
  `auth_mail` varchar(200) DEFAULT NULL,
  `company_name` text DEFAULT NULL,
  `company_email` varchar(250) DEFAULT NULL,
  `company_mobile` varchar(20) DEFAULT NULL,
  `company_logo` varchar(500) DEFAULT NULL,
  `company_gstin_number` varchar(20) DEFAULT NULL,
  `company_address` text DEFAULT NULL,
  `company_pin_code` varchar(20) DEFAULT NULL,
  `company_city` varchar(150) DEFAULT NULL,
  `company_state` varchar(150) DEFAULT NULL,
  `company_country` varchar(150) DEFAULT NULL,
  `company_shipping_address` text DEFAULT NULL,
  `company_shipping_pin_code` varchar(20) DEFAULT NULL,
  `company_shipping_city` varchar(150) DEFAULT NULL,
  `company_shipping_state` varchar(150) DEFAULT NULL,
  `company_shipping_country` varchar(150) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `company_active` int(11) NOT NULL DEFAULT 0,
  `flag` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `company`
--

INSERT INTO `company` (`id`, `auth_mail`, `company_name`, `company_email`, `company_mobile`, `company_logo`, `company_gstin_number`, `company_address`, `company_pin_code`, `company_city`, `company_state`, `company_country`, `company_shipping_address`, `company_shipping_pin_code`, `company_shipping_city`, `company_shipping_state`, `company_shipping_country`, `created_at`, `updated_at`, `company_active`, `flag`) VALUES
(1, 'saravanabca16@gmail.com', 'Skyraan Technologies, Hari Complex, Opp.ttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttto:', 'sky@gmail.com', '5645155458', 'uploads/company_logo/1722948150_skyraan-logo-657e9a29edccb.png', NULL, 'No.23, 2nd Floor, Nav Bhavna Building, SVS Rd,Navi Mumbai , Maharashtra ,India-400025', '94043', 'sdcdc', 'rewr', 'United States', 'No.23, 2nd Floor, Nav Bhavna Building, SVS Rd,Navi Mumbai , Maharashtra ,India-400025', '94043', 'sdcdc', 'rewr', 'United States', '2024-07-24 02:13:37', '2024-08-07 13:21:02', 1, 0),
(2, 'saravanabca16@gmail.com', 'Sky', 'skyraan@gmail.com', '5645155458', 'uploads/company_logo/1722322038_Group_427.png', '24AAACH7409R2Z6', 'No.23, 2nd Floor, Nav Bhavna Building, SVS Rd,Navi Mumbai , Maharashtra ,India-400025', '940444', 'Mountain Viewwwww', 'CA', 'United States', 'No.23, 2nd Floor, Nav Bhavna Building, SVS Rd,Navi Mumbai , Maharashtra ,India-400025', '940444', 'Mountain View', 'CA', 'United States', '2024-07-30 01:17:18', '2024-08-09 11:43:35', 0, 1),
(3, 'saravanabca16@gmail.com', 'Sky1', 'sky@gmail.com', '5645155458', NULL, '24AAACH7409R2Z6', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-08-06 07:53:12', '2024-08-06 13:33:27', 0, 0),
(4, 'saravanabca16@gmail.com', 'Skyraan', 'skyran@gmail.com', '5645155458', NULL, '24AAACH7409R2Z6', 'No.23, 2nd Floor, Nav Bhavna Building, SVS Rd,Navi Mumbai , Maharashtra ,India-400025', '94043', NULL, NULL, NULL, 'No.23, 2nd Floor, Nav Bhavna Building, SVS Rd,Navi Mumbai , Maharashtra ,India-400025', '94043', 'Mountain View', 'CA', 'United States', '2024-08-06 22:52:37', '2024-08-09 11:43:35', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `id` int(11) NOT NULL,
  `auth_mail` varchar(200) DEFAULT NULL,
  `company_id` int(11) DEFAULT NULL,
  `customer_name` varchar(250) DEFAULT NULL,
  `customer_email` varchar(250) DEFAULT NULL,
  `customer_mobile` varchar(20) DEFAULT NULL,
  `customer_gstin_number` varchar(20) DEFAULT NULL,
  `customer_address` text DEFAULT NULL,
  `customer_pin_code` varchar(20) DEFAULT NULL,
  `customer_city` varchar(150) DEFAULT NULL,
  `customer_state` varchar(150) DEFAULT NULL,
  `customer_country` varchar(150) DEFAULT NULL,
  `cus_shipping_address` text DEFAULT NULL,
  `cus_shipping_pin_code` varchar(20) DEFAULT NULL,
  `cus_shipping_city` varchar(150) DEFAULT NULL,
  `cus_shipping_state` varchar(150) DEFAULT NULL,
  `cus_shipping_country` varchar(150) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `flag` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`id`, `auth_mail`, `company_id`, `customer_name`, `customer_email`, `customer_mobile`, `customer_gstin_number`, `customer_address`, `customer_pin_code`, `customer_city`, `customer_state`, `customer_country`, `cus_shipping_address`, `cus_shipping_pin_code`, `cus_shipping_city`, `cus_shipping_state`, `cus_shipping_country`, `created_at`, `updated_at`, `flag`) VALUES
(1, 'saravanabca16@gmail.com', 2, 'Saravana kumar T', 'jayavel@gmail.com', '6369027855', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-08-07 07:54:50', '2024-08-08 04:03:31', 0),
(2, 'saravanabca16@gmail.com', 2, 'kumar', 'kumar@gmail.com', '6369027855', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-08-07 07:55:15', '2024-08-08 04:05:27', 0),
(3, 'saravanabca16@gmail.com', 2, 'Saravana', 'saravanasky@gmail.com', '6369027855', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-08-07 07:55:47', '2024-08-08 04:10:26', 0),
(4, 'saravanabca16@gmail.com', 2, 'jayavel', 'jayavelsky@gmail.com', '6019521325', '24AAACH7409R2Z6', '1600 Amphitheatre Parkway', '94043', 'Mountain View', 'hjbihb', 'United States', '1600 Amphitheatre Parkway', '94043', 'Mountain View', 'hjbihb', 'United States', '2024-08-07 08:21:17', '2024-08-09 04:24:34', 0),
(5, 'saravanabca16@gmail.com', 2, 'kumar test', 'test@example.us', '6369027855', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-08-07 08:22:28', '2024-08-09 04:25:33', 0),
(6, 'saravanabca16@gmail.com', 2, 'kumar 2', 'kumar@gmail.com', '6999999990', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-08-07 12:07:47', '2024-08-09 04:41:32', 0),
(7, 'saravanabca16@gmail.com', 2, 'Saravana1', 'kumar@gmail.com', '6369027855', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-08-08 03:11:52', '2024-08-09 04:54:25', 0),
(8, 'saravanabca16@gmail.com', 2, 'Saravana kumar T', 'jayavel@gmail.com', '6369027855', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-08-08 03:12:27', '2024-08-08 04:05:06', 0),
(9, 'saravanabca16@gmail.com', 2, 'kumar', 'jayavel@gmail.com', '3515841858', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-08-08 03:12:40', '2024-08-09 04:59:21', 0),
(10, 'saravanabca16@gmail.com', 2, 'Saravana kumar T', 'jayavel@gmail.com', '6369027855', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-08-08 03:12:49', '2024-08-09 05:01:39', 0),
(11, 'saravanabca16@gmail.com', 2, '123333', 'saravanasky@gmail.com', '3515841858', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-08-08 03:12:58', '2024-08-09 05:00:02', 0),
(12, 'saravanabca16@gmail.com', 2, 'kuma44', 'jayavel@gmail.com', '3515841858', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-08-08 03:13:18', '2024-08-09 05:36:23', 0),
(13, 'saravanabca16@gmail.com', 2, 'Saravana kumar T', 'jayavel@gmail.com', '6369027855', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-08-08 03:31:23', '2024-08-09 05:04:14', 0),
(14, 'saravanabca16@gmail.com', 2, 'Saravana kumar T', 'jayavel@gmail.com', '6369027855', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-08-08 03:37:16', '2024-08-09 05:37:42', 0),
(15, 'saravanabca16@gmail.com', 2, 'kumar', 'saravanasky@gmail.com', '6369027855', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-08-08 03:40:40', '2024-08-09 05:02:29', 0),
(16, 'saravanabca16@gmail.com', 2, 'k111', 'jayavel@gmail.com', '3515841858', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-08-08 03:40:54', '2024-08-09 05:04:41', 0),
(17, 'saravanabca16@gmail.com', 2, 'Saravanaaa', 'test@example.us', '6369027855', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-08-08 03:41:18', '2024-08-09 05:47:46', 1),
(18, 'saravanabca16@gmail.com', 4, 'Saravana kumar T', 'jayavel@gmail.com', '6369027855', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-08-08 03:42:53', '2024-08-08 03:43:18', 0),
(19, 'saravanabca16@gmail.com', 4, 'kumar', 'saravanasky@gmail.com', '3515841858', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-08-08 03:43:09', '2024-08-08 03:44:42', 0),
(20, 'saravanabca16@gmail.com', 4, 'Saravana', 'saravanasky@gmail.com', '3515841858', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-08-08 03:44:38', '2024-08-08 03:44:52', 0),
(21, 'saravanabca16@gmail.com', 4, 'Saravana kumar T', 'jayavel@gmail.com', '6369027855', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-08-08 03:45:58', '2024-08-08 03:46:21', 0),
(22, 'saravanabca16@gmail.com', 4, 'Saravana', 'kumar@gmail.com', '6999999990', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-08-08 03:46:35', '2024-08-08 03:46:35', 1),
(23, 'saravanabca16@gmail.com', 2, 'Saravana kumar T', 'jayavel@gmail.com', '6369027855', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-08-09 04:25:20', '2024-08-09 04:25:20', 1),
(24, 'saravanabca16@gmail.com', 2, 'Saravana kumar T', 'saravanasky@gmail.com', '6369027855', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-08-09 04:42:46', '2024-08-09 05:02:37', 0),
(25, 'saravanabca16@gmail.com', 2, 'kumar', 'jayavel@gmail.com', '6369027855', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-08-09 04:43:55', '2024-08-09 05:00:14', 0),
(26, 'saravanabca16@gmail.com', 2, 'Saravana kumar T', 'jayavel@gmail.com', '6369027855', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-08-09 05:00:25', '2024-08-09 05:37:51', 0),
(27, 'saravanabca16@gmail.com', 2, 'kumar', 'jayavel@gmail.com', '6369027855', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-08-09 05:00:33', '2024-08-09 05:38:04', 0),
(28, 'saravanabca16@gmail.com', 2, 'Saravana kumar T', 'jayavel@gmail.com', '6369027855', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-08-09 05:00:41', '2024-08-09 05:00:41', 1),
(29, 'saravanabca16@gmail.com', 2, 'Saravana kumar T', 'jayavel@gmail.com', '6369027855', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-08-09 05:00:50', '2024-08-09 05:00:50', 1),
(30, 'saravanabca16@gmail.com', 2, 'kumar', 'jayavel@gmail.com', '3515841858', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-08-09 05:03:14', '2024-08-09 05:03:14', 1),
(31, 'saravanabca16@gmail.com', 2, 'kumar', 'jayavel@gmail.com', '6369027855', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-08-09 05:03:24', '2024-08-09 05:03:24', 1),
(32, 'saravanabca16@gmail.com', 2, 'kumar', 'jayavel@gmail.com', '6369027855', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-08-09 05:03:38', '2024-08-09 05:37:58', 0),
(33, 'saravanabca16@gmail.com', 2, 'Saravana kumar T', 'jayavel@gmail.com', '6369027855', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-08-09 05:03:50', '2024-08-09 05:03:50', 1),
(34, 'saravanabca16@gmail.com', 2, 'Saravana kumar T', 'jayavel@gmail.com', '6369027855', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-08-09 05:04:04', '2024-08-09 05:04:04', 1),
(35, 'saravanabca16@gmail.com', 2, 'Saravana kumar T', 'jayavel@gmail.com', '6369027855', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-08-09 05:30:48', '2024-08-09 05:30:48', 1),
(36, 'saravanabca16@gmail.com', 2, 'Saravana kumar T', 'jayavel@gmail.com', '6369027855', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-08-09 05:31:15', '2024-08-09 05:31:15', 1),
(37, 'saravanabca16@gmail.com', 2, 'Saravana kumar T', 'jayavel@gmail.com', '6369027855', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-08-09 05:36:06', '2024-08-09 05:36:06', 1),
(38, 'saravanabca16@gmail.com', 2, 'kumar test', 'jayavel@gmail.com', '6369027855', '1234', '1600 Amphitheatre Parkway', '94043', 'Mountain View', 'CA', 'United States', '1600 Amphitheatre Parkway', '94043', 'Mountain View', 'CA', 'United States', '2024-08-09 05:38:31', '2024-08-09 05:38:31', 1),
(39, 'saravanabca16@gmail.com', 2, 'Saravana kumar T', 'jayavel@gmail.com', '6369027855', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-08-09 06:59:09', '2024-08-09 06:59:09', 1),
(40, 'saravanabca16@gmail.com', 2, 'kumar', 'jayavel@gmail.com', '6369027855', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-08-09 08:14:13', '2024-08-09 08:14:13', 1),
(41, 'saravanabca16@gmail.com', 2, 'kumar test', 'jayavel@gmail.com', '6369027855', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-08-09 08:14:29', '2024-08-09 08:14:29', 1);

-- --------------------------------------------------------

--
-- Table structure for table `invoice`
--

CREATE TABLE `invoice` (
  `id` int(11) NOT NULL,
  `auth_mail` varchar(250) DEFAULT NULL,
  `invoice_number` int(11) DEFAULT NULL,
  `invoice_number_cat` varchar(100) DEFAULT NULL,
  `customer_name` varchar(1000) DEFAULT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `company_id` int(11) DEFAULT NULL,
  `invoice_date` varchar(50) DEFAULT NULL,
  `due_date` varchar(50) DEFAULT NULL,
  `product_name` text DEFAULT NULL,
  `product_hsnsac` text DEFAULT NULL,
  `product_rate` text DEFAULT NULL,
  `product_quantity` text DEFAULT NULL,
  `product_quantity_type` text DEFAULT NULL,
  `product_discount_type` text DEFAULT NULL,
  `product_gst` text DEFAULT NULL,
  `product_discount` text DEFAULT NULL,
  `product_total` text DEFAULT NULL,
  `sgst` int(100) DEFAULT NULL,
  `cgst` int(100) DEFAULT NULL,
  `round_off` varchar(100) DEFAULT NULL,
  `total_tax` int(100) DEFAULT NULL,
  `overall_amt` int(100) DEFAULT NULL,
  `overall_discount` int(100) DEFAULT NULL,
  `bank_id` int(11) DEFAULT NULL,
  `payment_type` varchar(100) DEFAULT NULL,
  `partially_paid` varchar(12) DEFAULT NULL,
  `transaction_method` varchar(100) DEFAULT 'pending',
  `signature_id` int(11) DEFAULT NULL,
  `signature_image` varchar(500) DEFAULT NULL,
  `notes` varchar(2000) DEFAULT NULL,
  `terms_condition` varchar(2000) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `flag` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `invoice`
--

INSERT INTO `invoice` (`id`, `auth_mail`, `invoice_number`, `invoice_number_cat`, `customer_name`, `customer_id`, `company_id`, `invoice_date`, `due_date`, `product_name`, `product_hsnsac`, `product_rate`, `product_quantity`, `product_quantity_type`, `product_discount_type`, `product_gst`, `product_discount`, `product_total`, `sgst`, `cgst`, `round_off`, `total_tax`, `overall_amt`, `overall_discount`, `bank_id`, `payment_type`, `partially_paid`, `transaction_method`, `signature_id`, `signature_image`, `notes`, `terms_condition`, `created_at`, `updated_at`, `flag`) VALUES
(1, 'saravanabca16@gmail.com', 1, 'Inv', 'kumar', 3, 2, '2024-08-02', '2024-08-02', 'Watch', NULL, '500', '1', 'num', '%', '0', '0', '500.00', 0, 0, '0.00', 0, 500, 0, 6, 'upi', NULL, 'pending', 3, 'uploads/signature_image/66aa3c191edf2.png', 'test-2', 'terms-2', '2024-08-02 03:33:46', '2024-08-09 05:41:52', 0),
(2, 'saravanabca16@gmail.com', 2, 'Inv', 'kumar', 3, 2, '2024-08-02', '2024-08-02', 'Watch', NULL, '1000', '1', 'num', '%', '0', '0', '1000.00', 0, 0, '0.00', 0, 1000, 0, 6, 'upi', NULL, 'pending', 3, 'uploads/signature_image/66aa3c191edf2.png', 'test-2', 'terms-2', '2024-08-02 07:00:43', '2024-08-09 05:57:08', 0),
(3, 'saravanabca16@gmail.com', 1, 'Inv', 'Saravana', 22, 4, '2024-08-08', '2024-08-08', 'Watch,mobile', ',', '0450,10000.50', '1,2', 'num', '₹,%', '5,5', '050,010', '420.00,18900.94', 460, 460, '0.06', 920, 19321, 2050, 1, 'cash', NULL, 'pending', 4, 'uploads/signature_image/66b36ccbd16ff.png', NULL, NULL, '2024-08-08 12:00:16', '2024-08-08 12:00:16', 1),
(4, 'saravanabca16@gmail.com', 3, 'Inv', 'Saravanaaa', 17, 2, '2024-08-09', '2024-08-09', 'Watch', NULL, '100', '1', 'num', '%', '0', '0', '100.00', 0, 0, '0.00', 0, 100, 0, 14, 'upi', NULL, 'pending', 5, 'uploads/signature_image/66b448a9e1e22.png', 'dfbg', 'fgbf', '2024-08-09 05:56:26', '2024-08-09 06:01:59', 0),
(5, 'saravanabca16@gmail.com', 4, 'Inv', 'Saravanaaa', 17, 2, '2024-08-09', '2024-08-09', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '0.00', 0, 0, 0, 14, 'upi', NULL, 'paid', 5, 'uploads/signature_image/66b448a9e1e22.png', 'dfbg', 'fgbf', '2024-08-09 05:56:46', '2024-08-09 07:11:11', 0),
(6, 'saravanabca16@gmail.com', 5, 'Inv', 'Saravanaaa', 17, 2, '2024-08-09', '2024-08-09', 'Watch,Watch', ',', '1000,100', '5,1', 'num', '%,%', '0.25,0', '0,0', '5012.50,100.00', 6, 6, '0.00', 13, 5113, 0, 14, 'upi', NULL, 'pending', 5, 'uploads/signature_image/66b448a9e1e22.png', 'dfbg', 'fgbf', '2024-08-09 07:10:56', '2024-08-09 07:14:01', 0),
(7, 'saravanabca16@gmail.com', 1, 'Inv', 'Saravanaaa', 17, 2, '2024-08-09', '2024-08-09', NULL, NULL, '0', '1', 'num', '%', '0', '0', '0', 0, 0, '0.00', 0, 0, 0, 14, 'upi', NULL, 'paid', 5, 'uploads/signature_image/66b448a9e1e22.png', 'dfbg', 'fgbf', '2024-08-09 07:14:17', '2024-08-09 07:39:45', 0),
(8, 'saravanabca16@gmail.com', 2, 'Inv', 'Saravanaaa', 17, 2, '2024-08-09', '2024-08-09', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '0.00', 0, 0, 0, 14, 'upi', NULL, 'paid', 5, 'uploads/signature_image/66b448a9e1e22.png', 'dfbg', 'fgbf', '2024-08-09 07:18:51', '2024-08-09 07:18:51', 1),
(9, 'saravanabca16@gmail.com', 3, 'Inv', 'Saravanaaa', 17, 2, '2024-08-09', '2024-08-09', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '0.00', 0, 0, 0, 14, 'upi', NULL, 'paid', 5, 'uploads/signature_image/66b448a9e1e22.png', 'dfbg', 'fgbf', '2024-08-09 07:18:58', '2024-08-09 07:42:57', 0),
(10, 'saravanabca16@gmail.com', 4, 'Inv', 'Saravana kumar T', 23, 2, '2024-08-09', '2024-08-09', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '0.00', 0, 0, 0, 14, 'upi', NULL, 'paid', 5, 'uploads/signature_image/66b448a9e1e22.png', 'dfbg', 'fgbf', '2024-08-09 07:19:06', '2024-08-09 07:19:06', 1),
(11, 'saravanabca16@gmail.com', 5, 'Inv', 'Saravanaaa', 17, 2, '2024-08-09', '2024-08-09', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '0.00', 0, 0, 0, 14, 'upi', NULL, 'paid', 5, 'uploads/signature_image/66b448a9e1e22.png', 'dfbg', 'fgbf', '2024-08-09 07:19:17', '2024-08-09 07:19:17', 1),
(12, 'saravanabca16@gmail.com', 6, 'Inv', 'Saravanaaa', 17, 2, '2024-08-09', '2024-08-09', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '0.00', 0, 0, 0, 14, 'upi', NULL, 'paid', 5, 'uploads/signature_image/66b448a9e1e22.png', 'dfbg', 'fgbf', '2024-08-09 07:19:25', '2024-08-09 07:19:25', 1),
(13, 'saravanabca16@gmail.com', 7, 'Inv', 'Saravanaaa', 17, 2, '2024-08-09', '2024-08-09', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '0.00', 0, 0, 0, 14, 'upi', NULL, 'paid', 5, 'uploads/signature_image/66b448a9e1e22.png', 'dfbg', 'fgbf', '2024-08-09 07:19:38', '2024-08-09 07:19:38', 1),
(14, 'saravanabca16@gmail.com', 8, 'Inv', 'Saravanaaa', 17, 2, '2024-08-09', '2024-08-09', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '0.00', 0, 0, 0, 14, 'upi', NULL, 'paid', 5, 'uploads/signature_image/66b448a9e1e22.png', 'dfbg', 'fgbf', '2024-08-09 07:19:49', '2024-08-09 07:19:49', 1),
(15, 'saravanabca16@gmail.com', 9, 'Inv', 'Saravana kumar T', 28, 2, '2024-08-09', '2024-08-09', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '0.00', 0, 0, 0, 14, 'upi', NULL, 'paid', 5, 'uploads/signature_image/66b448a9e1e22.png', 'dfbg', 'fgbf', '2024-08-09 07:19:57', '2024-08-09 07:19:57', 1),
(16, 'saravanabca16@gmail.com', 10, 'Inv', 'kumar', 30, 2, '2024-08-09', '2024-08-09', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '0.00', 0, 0, 0, 14, 'upi', NULL, 'paid', 5, 'uploads/signature_image/66b448a9e1e22.png', 'dfbg', 'fgbf', '2024-08-09 07:20:06', '2024-08-09 07:20:06', 1),
(17, 'saravanabca16@gmail.com', 11, 'Inv', 'Saravana kumar T', 29, 2, '2024-08-09', '2024-08-09', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '0.00', 0, 0, 0, 14, 'upi', NULL, 'paid', 5, 'uploads/signature_image/66b448a9e1e22.png', 'dfbg', 'fgbf', '2024-08-09 07:20:12', '2024-08-09 07:20:12', 1),
(18, 'saravanabca16@gmail.com', 12, 'Inv', 'Saravana kumar T', 23, 2, '2024-08-09', '2024-08-09', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '0.00', 0, 0, 0, 14, 'upi', NULL, 'paid', 5, 'uploads/signature_image/66b448a9e1e22.png', 'dfbg', 'fgbf', '2024-08-09 07:20:21', '2024-08-09 07:20:21', 1),
(19, 'saravanabca16@gmail.com', 13, 'Inv', 'Saravanaaa', 17, 2, '2024-08-09', '2024-08-09', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '0.00', 0, 0, 0, 14, 'upi', NULL, 'paid', 5, 'uploads/signature_image/66b448a9e1e22.png', 'dfbg', 'fgbf', '2024-08-09 07:20:41', '2024-08-09 07:20:41', 1),
(20, 'saravanabca16@gmail.com', 14, 'Inv', 'Saravanaaa', 17, 2, '2024-08-09', '2024-08-09', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '0.00', 0, 0, 0, 14, 'upi', NULL, 'paid', 5, 'uploads/signature_image/66b448a9e1e22.png', 'dfbg', 'fgbf', '2024-08-09 07:40:22', '2024-08-09 07:40:22', 1),
(21, 'saravanabca16@gmail.com', 15, 'Inv', 'Saravana kumar T', 23, 2, '2024-08-09', '2024-08-09', 'Watch,mobile', ',', '100,10000', '1,1', 'num', '%,%', '0', '10,0', '90.22,10000.00', 0, 0, '-0.23', 0, 10090, 10, 14, 'upi', NULL, 'paid', 5, 'uploads/signature_image/66b448a9e1e22.png', 'dfbg', 'fgbf', '2024-08-09 07:42:24', '2024-08-09 07:53:26', 1);

-- --------------------------------------------------------

--
-- Table structure for table `notes`
--

CREATE TABLE `notes` (
  `id` int(11) NOT NULL,
  `company_id` int(11) DEFAULT NULL,
  `notes_title` varchar(250) DEFAULT NULL,
  `notes` text DEFAULT NULL,
  `auth_mail` varchar(250) DEFAULT NULL,
  `notes_active` int(11) NOT NULL DEFAULT 0,
  `flag` int(11) DEFAULT 1,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `notes`
--

INSERT INTO `notes` (`id`, `company_id`, `notes_title`, `notes`, `auth_mail`, `notes_active`, `flag`, `created_at`, `updated_at`) VALUES
(1, 2, 'Test-1', 'test-1', 'saravanabca16@gmail.com', 0, 0, '2024-08-01 08:08:44', '2024-08-08 02:00:22'),
(2, 2, 'Test-2', 'test-2', 'saravanabca16@gmail.com', 0, 0, '2024-08-01 08:11:05', '2024-08-08 01:58:23'),
(3, 2, 'rferf', 'rgverfv', 'saravanabca16@gmail.com', 0, 0, '2024-08-08 01:11:38', '2024-08-08 01:58:29'),
(4, 2, 'Test-1', 'testttttt', 'saravanabca16@gmail.com', 0, 0, '2024-08-08 01:57:10', '2024-08-08 01:58:17'),
(5, 2, 'Test-1', 'test-1', 'saravanabca16@gmail.com', 0, 0, '2024-08-08 02:00:44', '2024-08-08 02:18:47'),
(6, 2, 'Test-2', 'testtt-2', 'saravanabca16@gmail.com', 0, 0, '2024-08-08 02:01:21', '2024-08-08 02:18:44'),
(7, 2, '333', 'dfbgdf', 'saravanabca16@gmail.com', 0, 0, '2024-08-08 02:31:57', '2024-08-08 02:33:02'),
(8, 2, 'Test-1', 'fdbvdfb', 'saravanabca16@gmail.com', 0, 0, '2024-08-08 02:32:52', '2024-08-08 02:32:59'),
(9, 2, 'Test-1', 'cfbfd', 'saravanabca16@gmail.com', 0, 0, '2024-08-08 02:33:56', '2024-08-08 02:34:26'),
(10, 2, 'dfbgdfbd', 'dfbg', 'saravanabca16@gmail.com', 1, 1, '2024-08-08 02:34:36', '2024-08-08 02:34:36'),
(11, 2, 'test1', '5. Settings -> Notes -> after notes created -> list view -> it display the notes description display the notes title in the list view\r\n\r\n5. Settings -> Notes -> after notes created -> list view -> it display the notes description display the notes title in the list view', 'saravanabca16@gmail.com', 0, 1, '2024-08-08 07:00:13', '2024-08-08 07:49:50');

-- --------------------------------------------------------

--
-- Table structure for table `signature`
--

CREATE TABLE `signature` (
  `id` int(11) NOT NULL,
  `company_id` int(11) DEFAULT NULL,
  `signature_name` varchar(250) DEFAULT NULL,
  `signature_image` varchar(500) DEFAULT NULL,
  `canvas_image` varchar(500) DEFAULT NULL,
  `auth_mail` varchar(250) DEFAULT NULL,
  `signature_active` int(11) NOT NULL DEFAULT 0,
  `flag` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `template_active`
--

CREATE TABLE `template_active` (
  `id` int(11) NOT NULL,
  `template_name` varchar(100) NOT NULL,
  `temp_active_status` int(11) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `template_active`
--

INSERT INTO `template_active` (`id`, `template_name`, `temp_active_status`, `updated_at`) VALUES
(1, 'temp_1', 1, '2024-07-04 07:49:17'),
(2, 'temp_2', 0, '2024-07-04 07:49:17');

-- --------------------------------------------------------

--
-- Table structure for table `terms`
--

CREATE TABLE `terms` (
  `id` int(11) NOT NULL,
  `company_id` int(11) DEFAULT NULL,
  `terms_title` varchar(250) DEFAULT NULL,
  `terms` text DEFAULT NULL,
  `auth_mail` varchar(255) DEFAULT NULL,
  `terms_active` int(11) DEFAULT 0,
  `flag` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `terms`
--

INSERT INTO `terms` (`id`, `company_id`, `terms_title`, `terms`, `auth_mail`, `terms_active`, `flag`, `created_at`, `updated_at`) VALUES
(1, 2, 'Terms-1', 'terms-1', 'saravanabca16@gmail.com', 0, 0, '2024-08-01 08:08:55', '2024-08-08 02:10:08'),
(2, 2, 'Terms-2', 'terms-2', 'saravanabca16@gmail.com', 0, 0, '2024-08-01 08:11:16', '2024-08-08 02:34:54'),
(3, 2, 'Terms-2 fdbvadfvadfvdfbvd', 'ffffffff', 'saravanabca16@gmail.com', 0, 0, '2024-08-08 01:36:52', '2024-08-08 02:10:04'),
(4, 2, 'Terms-2', 'teee', 'saravanabca16@gmail.com', 0, 0, '2024-08-08 02:14:21', '2024-08-08 02:34:52'),
(5, 2, 'sdfvdfs', 'sdfvfdv', 'saravanabca16@gmail.com', 0, 0, '2024-08-08 02:32:42', '2024-08-08 02:34:50'),
(6, 2, 'dfbhd', 'dthbftgh', 'saravanabca16@gmail.com', 0, 0, '2024-08-08 02:35:02', '2024-08-08 02:35:57'),
(7, 2, 'dsfvsdf', 'fdsvfsdv', 'saravanabca16@gmail.com', 0, 0, '2024-08-08 02:35:44', '2024-08-08 02:35:53'),
(8, 2, 'sdv', 'sdvsdv', 'saravanabca16@gmail.com', 0, 0, '2024-08-08 02:36:08', '2024-08-08 02:36:15'),
(9, 2, 'dfb', 'fgbf', 'saravanabca16@gmail.com', 1, 1, '2024-08-08 02:36:29', '2024-08-09 07:57:06'),
(10, 2, 'Terms-1', 'dsfhbrhbrtg', 'saravanabca16@gmail.com', 0, 0, '2024-08-09 07:57:03', '2024-08-09 07:57:06');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(150) DEFAULT NULL,
  `email` varchar(150) DEFAULT NULL,
  `phone` varchar(100) DEFAULT NULL,
  `avatar` varchar(500) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `otp` int(11) DEFAULT NULL,
  `expired_otp` varchar(100) DEFAULT NULL,
  `template_name` varchar(100) NOT NULL DEFAULT 'temp_1',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `flag` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `phone`, `avatar`, `password`, `otp`, `expired_otp`, `template_name`, `created_at`, `updated_at`, `flag`) VALUES
(1, 'T Saravana Kumar', 'saravanabca16@gmail.com', '6369028378', 'https://lh3.googleusercontent.com/a/ACg8ocJT86pVTi5n1P3hS8TtrYYVUfnYP9BgJUFlHR53RmPL_UmFIjJt=s96-c', '$2y$12$N2r1Gwrsr.9XK3qNtXXQvu5asQL35SSNDyb5tpW09Qc6ywcq0FPVC', 8480, '2024-08-11 13:14:55', 'temp_2', '2024-08-05 23:50:47', '2024-08-11 07:43:55', 1),
(2, 'Saravana', 'saravana@gmail.com', '6369028378', NULL, '$2y$12$cCMxzcbXyor.2xD0aNHe8.AKxRrGAOHH/CXqWLLMh0QvJqfZVGxeq', 1514, '2024-08-06 06:22:32', 'temp_1', '2024-08-06 00:30:20', '2024-08-06 00:51:32', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bank_details`
--
ALTER TABLE `bank_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `company`
--
ALTER TABLE `company`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `invoice`
--
ALTER TABLE `invoice`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notes`
--
ALTER TABLE `notes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `template_active`
--
ALTER TABLE `template_active`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `terms`
--
ALTER TABLE `terms`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bank_details`
--
ALTER TABLE `bank_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `company`
--
ALTER TABLE `company`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `invoice`
--
ALTER TABLE `invoice`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `notes`
--
ALTER TABLE `notes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `terms`
--
ALTER TABLE `terms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
