-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 06, 2025 at 07:24 AM
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
-- Database: `financial_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `accounts_payable`
--

CREATE TABLE `accounts_payable` (
  `id` int(11) NOT NULL,
  `payee` varchar(255) NOT NULL,
  `amount` decimal(12,2) NOT NULL,
  `due_date` date NOT NULL,
  `account_id` int(11) NOT NULL,
  `department_id` int(11) DEFAULT NULL,
  `remarks` text DEFAULT NULL,
  `status` enum('Unpaid','Partially Paid','Paid','Voided') DEFAULT 'Unpaid',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `accounts_payable`
--

INSERT INTO `accounts_payable` (`id`, `payee`, `amount`, `due_date`, `account_id`, `department_id`, `remarks`, `status`, `created_at`) VALUES
(70, 'ken', 20.00, '2025-05-29', 9, 5, 'qwe', 'Paid', '2025-05-29 05:25:49'),
(71, 'ken1', 1.00, '2025-05-29', 8, 8, 'q', 'Paid', '2025-05-29 05:47:40'),
(72, 'qewew', 23.00, '2025-05-29', 14, 5, 'hahahah', 'Paid', '2025-05-29 06:15:44'),
(73, 'qwe', 123.00, '2025-06-04', 10, 4, 'qwe', 'Voided', '2025-06-03 23:42:25'),
(74, 'qweqwe', 123.00, '2025-06-04', 9, 4, 'qwe', 'Voided', '2025-06-03 23:44:58'),
(75, 'qweasd', 123.00, '2025-06-03', 9, 4, 'qweqwe', 'Unpaid', '2025-06-03 23:49:33'),
(76, 'qweqwe', 123.00, '2025-06-03', 8, 4, 'qweqwe', 'Unpaid', '2025-06-03 23:53:36'),
(77, 's', 33.00, '2025-06-04', 10, 6, 'q', 'Partially Paid', '2025-06-03 23:54:30'),
(78, 'John Doe', 1500.00, '2025-06-06', 9, 5, 'For salary', 'Paid', '2025-06-06 04:23:14');

-- --------------------------------------------------------

--
-- Table structure for table `accounts_receivable`
--

CREATE TABLE `accounts_receivable` (
  `id` int(11) NOT NULL,
  `invoice_no` varchar(50) DEFAULT NULL,
  `client_name` varchar(100) DEFAULT NULL,
  `booking_date` date DEFAULT NULL,
  `amount_due` decimal(12,2) DEFAULT NULL,
  `payment_method` varchar(50) DEFAULT NULL,
  `payment_date` date DEFAULT NULL,
  `due_date` date DEFAULT NULL,
  `status` varchar(20) DEFAULT 'Unpaid',
  `remarks` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `accounts_receivable`
--

INSERT INTO `accounts_receivable` (`id`, `invoice_no`, `client_name`, `booking_date`, `amount_due`, `payment_method`, `payment_date`, `due_date`, `status`, `remarks`, `created_at`) VALUES
(117, 'INV-20250528-001', 'kalabaw', '2025-05-28', 9600.00, NULL, NULL, '2025-05-29', 'Partially Paid', 'baguio tour', '2025-05-28 13:36:21'),
(118, 'INV-20250529-001', 'ken', '2025-05-29', 0.00, NULL, NULL, '2025-05-29', 'Voided', 'qwe', '2025-05-29 01:58:55'),
(119, 'INV-20250529-002', 'KENTOT', '2025-05-29', 199.00, NULL, NULL, '2025-05-29', 'Partially Paid', 'Yosi isang pack', '2025-05-29 06:27:16'),
(120, 'INV-20250530-001', 'q', '2025-05-30', 0.00, NULL, NULL, '2025-05-30', 'Fully Paid', 'qwe', '2025-05-30 10:30:18'),
(121, 'INV-20250530-002', 'Ana Garcia', '2025-05-30', 587.00, NULL, NULL, '2025-05-30', 'Partially Paid', 'Payment from Visa', '2025-05-30 15:27:11'),
(122, 'INV-20250530-003', 'qweqwe', '2025-05-30', 0.00, NULL, NULL, '2025-05-30', 'Fully Paid', 'qwe', '2025-05-30 15:31:29'),
(123, 'INV-20250531-001', 'lebumbum', '2025-05-31', 2499.00, NULL, NULL, NULL, 'Partially Paid', 'Vehicle payments', '2025-05-30 22:45:45'),
(124, 'INV-20250531-002', 'maykel jurdan', '2025-05-31', 0.00, NULL, NULL, NULL, 'Fully Paid', 'Hotel Payment', '2025-05-30 22:46:57'),
(125, 'INV-20250604-001', 'example', '2025-06-04', 0.00, NULL, NULL, NULL, 'Fully Paid', 'q', '2025-06-04 00:16:05'),
(126, 'INV-20250604-002', 'qwwwwww', '2025-06-04', 0.00, NULL, NULL, NULL, 'Fully Paid', 'q', '2025-06-04 05:20:44'),
(127, 'INV-20250606-001', 'qwe', '2025-06-06', 123.00, NULL, NULL, NULL, 'Unpaid', 'q', '2025-06-06 04:02:05');

-- --------------------------------------------------------

--
-- Table structure for table `audit_trail`
--

CREATE TABLE `audit_trail` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `action` varchar(100) NOT NULL,
  `description` text DEFAULT NULL,
  `timestamp` datetime DEFAULT current_timestamp(),
  `ip_address` varchar(50) DEFAULT NULL,
  `module` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `audit_trail`
--

INSERT INTO `audit_trail` (`id`, `user_id`, `action`, `description`, `timestamp`, `ip_address`, `module`) VALUES
(1, 4, 'Login', 'User logged in', '2025-06-04 07:25:04', '::1', 'Authentication'),
(2, 4, 'Logout', 'User logged out', '2025-06-04 07:26:43', '::1', 'Authentication'),
(3, 5, 'Login', 'User logged in', '2025-06-04 07:26:55', '::1', 'Authentication'),
(4, 5, 'Logout', 'User logged out', '2025-06-04 07:26:57', '::1', 'Authentication'),
(5, 4, 'Login', 'User logged in', '2025-06-04 07:27:10', '::1', 'Authentication'),
(6, 4, 'Submit Payable', 'Submitted payable request for qwe (₱123.00)', '2025-06-04 07:37:30', '::1', 'Accounts Payable'),
(7, 4, 'Login', 'User logged in', '2025-06-04 07:43:42', '::1', 'Authentication'),
(8, 4, 'Void Payable', 'Voided payable request for qweqwe (ID: 74)', '2025-06-04 07:45:09', '::1', 'Accounts Payable'),
(9, 4, 'Approved Payable Request', 'Approved payable request ID #22 for ₱123.00', '2025-06-04 07:53:36', '::1', 'Accounts Payable'),
(10, 4, 'Submit Payable', 'Submitted payable request for s (₱33.00)', '2025-06-04 07:54:01', '::1', 'Accounts Payable'),
(11, 4, 'Approved Payable Request', 'Approved payable request ID #28 for ₱33.00', '2025-06-04 07:54:30', '::1', 'Accounts Payable'),
(12, 4, 'Create Invoice', 'Created Invoice INV-20250604-001 for ₱2.00 - example', '2025-06-04 08:16:05', '::1', 'Accounts Receivable'),
(14, 4, 'Create Invoice', 'Created Invoice INV-20250604-002 for ₱2.00 - qwwwwww', '2025-06-04 13:20:44', '::1', 'Accounts Receivable'),
(16, 4, 'Record Payment', 'Payment of ₱1 recorded for invoice #INV-20250604-002 using Cash', '2025-06-04 13:26:18', '::1', 'Collection'),
(17, 4, 'Void Invoice', 'Voided invoice #INV-20250529-001 with original total: 200', '2025-06-04 13:26:38', '::1', 'Accounts Receivable'),
(18, 4, 'Create', 'Disbursed ₱2.00 for Payable ID: 77 using Cash. Remarks: w', '2025-06-04 13:37:41', '::1', 'Disbursement'),
(19, 4, 'Record Payment', 'Payment of ₱900 recorded for invoice #INV-20250531-002 using Cash', '2025-06-04 13:41:39', '::1', 'Collection'),
(20, 4, 'Login', 'User logged in', '2025-06-04 20:20:47', '::1', 'Authentication'),
(21, 4, 'Login', 'User logged in', '2025-06-06 09:32:37', '::1', 'Authentication'),
(22, 4, 'Login', 'User logged in', '2025-06-06 10:55:25', '::1', 'Authentication'),
(23, 4, 'Login', 'User logged in', '2025-06-06 12:01:57', '::1', 'Authentication'),
(24, 4, 'Create Invoice', 'Created Invoice INV-20250606-001 for ₱123.00 - qwe', '2025-06-06 12:02:05', '::1', 'Accounts Receivable'),
(25, 4, 'Login', 'User logged in', '2025-06-06 12:22:01', '::1', 'Authentication'),
(26, 4, 'Submit Payable', 'Submitted payable request for John Doe (₱1,500.00)', '2025-06-06 12:22:57', '::1', 'Accounts Payable'),
(27, 4, 'Approved Payable Request', 'Approved payable request ID #29 for ₱1,500.00', '2025-06-06 12:23:14', '::1', 'Accounts Payable'),
(28, 4, 'Create', 'Disbursed ₱1,500.00 for Payable ID: 78 using Cash. Remarks: qqqq', '2025-06-06 12:23:58', '::1', 'Disbursement');

-- --------------------------------------------------------

--
-- Table structure for table `budget_allocations`
--

CREATE TABLE `budget_allocations` (
  `id` int(11) NOT NULL,
  `department_id` int(11) NOT NULL,
  `year` year(4) NOT NULL,
  `allocated_amount` decimal(15,2) NOT NULL,
  `used_amount` decimal(15,2) NOT NULL DEFAULT 0.00,
  `status` enum('Active','Closed') DEFAULT 'Active',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `budget_allocations`
--

INSERT INTO `budget_allocations` (`id`, `department_id`, `year`, `allocated_amount`, `used_amount`, `status`, `created_at`, `updated_at`) VALUES
(6, 5, '2025', 200000.00, 1543.00, 'Active', '2025-05-29 05:23:44', '2025-06-06 04:23:58'),
(7, 6, '2025', 400.00, 2.00, 'Active', '2025-05-29 05:24:06', '2025-06-04 05:37:41'),
(8, 7, '2025', 323.00, 0.00, 'Active', '2025-05-29 05:24:11', '2025-06-03 13:58:57'),
(9, 8, '2025', 123.00, 1.00, 'Active', '2025-05-29 05:24:15', '2025-05-29 06:13:00'),
(10, 9, '2025', 12312.00, 0.00, 'Active', '2025-05-29 05:24:20', '2025-05-29 05:24:20'),
(12, 11, '2025', 126437.00, 0.00, 'Active', '2025-05-29 05:24:40', '2025-06-03 13:58:02'),
(13, 12, '2025', 23213.00, 0.00, 'Active', '2025-05-29 05:24:47', '2025-05-29 05:24:47'),
(17, 4, '2025', 100001.00, 0.00, 'Active', '2025-06-03 13:59:31', '2025-06-03 13:59:37');

-- --------------------------------------------------------

--
-- Table structure for table `chart_of_accounts`
--

CREATE TABLE `chart_of_accounts` (
  `id` int(11) NOT NULL,
  `account_code` varchar(10) NOT NULL,
  `account_name` varchar(100) NOT NULL,
  `account_type` enum('Asset','Liability','Equity','Revenue','Expense') NOT NULL,
  `description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `chart_of_accounts`
--

INSERT INTO `chart_of_accounts` (`id`, `account_code`, `account_name`, `account_type`, `description`) VALUES
(1, '101', 'Cash', 'Asset', 'Cash or Bank'),
(2, '102', 'Accounts Receivable', 'Asset', 'Customer receivables'),
(3, '401', 'Service Revenue', 'Revenue', 'Earned service income'),
(4, '201', 'Accounts Payable', 'Liability', 'Supplier obligations'),
(5, '402', 'Miscellaneous Revenue', 'Revenue', 'Other income sources'),
(6, '501', 'Travel Expense', 'Expense', 'Expenses for travel'),
(7, '502', 'Utilities Expense', 'Expense', 'Electricity, water, internet'),
(8, '503', 'Supplies Expense', 'Expense', 'Office or booking supplies'),
(9, '504', 'Salaries and Wages Expense', 'Expense', 'Employee payroll (HR)'),
(10, '505', 'Recruitment and Training Expense', 'Expense', 'HR hiring and training costs'),
(11, '506', 'Employee Welfare and Benefits', 'Expense', 'Allowances, SSS, PhilHealth'),
(12, '507', 'Marketing and Advertising Expense', 'Expense', 'Core promotional campaigns'),
(13, '508', 'Equipment Maintenance Expense', 'Expense', 'Repairs for operations equipment'),
(14, '509', 'Fuel and Transportation Expense', 'Expense', 'Core transport & fuel'),
(15, '510', 'Delivery and Freight Expense', 'Expense', 'Logistics shipping/delivery'),
(16, '511', 'Warehouse Supplies Expense', 'Expense', 'Tools, packaging for logistics'),
(17, '512', 'Inventory Handling Expense', 'Expense', 'Handling and storage fees');

-- --------------------------------------------------------

--
-- Table structure for table `collection`
--

CREATE TABLE `collection` (
  `id` int(11) NOT NULL,
  `invoice_id` int(11) DEFAULT NULL,
  `amount_paid` decimal(12,2) DEFAULT NULL,
  `payment_method` varchar(50) DEFAULT NULL,
  `payment_date` date DEFAULT NULL,
  `remarks` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `collection`
--

INSERT INTO `collection` (`id`, `invoice_id`, `amount_paid`, `payment_method`, `payment_date`, `remarks`, `created_at`) VALUES
(147, 117, 123.00, 'Cash', '2025-05-28', NULL, '2025-05-28 13:36:37'),
(148, 117, 200.00, 'Cash', '2025-05-29', NULL, '2025-05-29 01:49:30'),
(149, 117, 77.00, 'Cash', '2025-05-29', NULL, '2025-05-29 01:49:48'),
(150, 119, 1.00, 'Cash', '2025-05-30', NULL, '2025-05-30 03:05:52'),
(151, 120, 123.00, 'Cash', '2025-05-30', NULL, '2025-05-30 10:30:55'),
(152, 122, 123.00, 'Cash', '2025-05-31', NULL, '2025-05-30 21:23:27'),
(153, 124, 100.00, 'Cash', '2025-05-31', NULL, '2025-05-30 22:48:53'),
(154, 125, 2.00, 'Cash', '2025-06-04', NULL, '2025-06-04 00:25:20'),
(155, 123, 1.00, 'Cash', '2025-06-04', NULL, '2025-06-04 00:26:31'),
(156, 121, 1.00, 'Cash', '2025-06-04', NULL, '2025-06-04 00:27:32'),
(157, 126, 1.00, 'Cash', '2025-06-04', NULL, '2025-06-04 05:21:12'),
(158, 121, 1.00, 'Cash', '2025-06-04', NULL, '2025-06-04 05:22:21'),
(159, 126, 1.00, 'Cash', '2025-06-04', NULL, '2025-06-04 05:26:18'),
(160, 124, 900.00, 'Cash', '2025-06-04', NULL, '2025-06-04 05:41:39');

-- --------------------------------------------------------

--
-- Table structure for table `core_payments`
--

CREATE TABLE `core_payments` (
  `id` int(11) NOT NULL,
  `payment_id` varchar(100) DEFAULT NULL,
  `amount` decimal(10,2) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `reference_number` varchar(100) DEFAULT NULL,
  `customer_name` varchar(255) DEFAULT NULL,
  `payment_method` varchar(50) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` enum('Pending','Done') NOT NULL DEFAULT 'Pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `core_payments`
--

INSERT INTO `core_payments` (`id`, `payment_id`, `amount`, `date`, `reference_number`, `customer_name`, `payment_method`, `created_at`, `status`) VALUES
(4, 'PAY-20250530-004', 123.00, '2025-05-30', '2321', 'qwe', 'Cash', '2025-05-30 04:04:28', 'Done'),
(5, 'PAY-20250530-002', 589.82, '2025-05-30', 'REF1748600258364', 'Ana Garcia', 'Credit Card', '2025-05-30 10:18:50', 'Pending'),
(6, 'PAY-20250530-003', 123.00, '2025-05-30', '2321', 'fff', 'Credit Card', '2025-05-30 15:17:29', 'Pending');

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` text DEFAULT NULL,
  `status` enum('active','inactive') DEFAULT 'active',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`id`, `name`, `description`, `status`, `created_at`, `updated_at`) VALUES
(4, 'HR 4', 'Human Resources - Unit 4', 'active', '2025-06-02 20:34:37', '2025-06-02 20:34:37'),
(5, 'HR 1', 'Human Resources - Unit 1', 'active', '2025-05-29 05:16:56', '2025-05-29 05:16:56'),
(6, 'HR 2', 'Human Resources - Unit 2', 'active', '2025-05-29 05:16:56', '2025-05-29 05:16:56'),
(7, 'HR 3', 'Human Resources - Unit 3', 'active', '2025-05-29 05:16:56', '2025-05-29 05:16:56'),
(8, 'LOGISTIC 1', 'Logistics - Unit 1', 'active', '2025-05-29 05:16:56', '2025-05-29 05:16:56'),
(9, 'LOGISTIC 2', 'Logistics - Unit 2', 'active', '2025-05-29 05:16:56', '2025-05-29 05:16:56'),
(11, 'CORE 1', 'Core Services - Unit 1', 'active', '2025-05-29 05:16:56', '2025-05-29 05:16:56'),
(12, 'CORE 2', 'Core Services - Unit 2', 'active', '2025-05-29 05:16:56', '2025-05-29 05:16:56');

-- --------------------------------------------------------

--
-- Table structure for table `disbursement`
--

CREATE TABLE `disbursement` (
  `id` int(11) NOT NULL,
  `payable_id` int(11) NOT NULL,
  `disbursement_date` date NOT NULL,
  `amount_paid` decimal(12,2) NOT NULL,
  `payment_method` varchar(100) DEFAULT NULL,
  `remarks` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `disbursement`
--

INSERT INTO `disbursement` (`id`, `payable_id`, `disbursement_date`, `amount_paid`, `payment_method`, `remarks`, `created_at`) VALUES
(60, 70, '2025-05-29', 20.00, 'Cash', 'qwe', '2025-05-29 05:26:03'),
(61, 71, '2025-05-29', 1.00, 'Cash', 'Fully Paid', '2025-05-29 06:13:00'),
(62, 72, '2025-05-29', 23.00, 'Cash', 'Fully Paid', '2025-05-29 06:44:51'),
(63, 77, '2025-06-04', 2.00, 'Cash', 'w', '2025-06-04 05:37:41'),
(64, 78, '2025-06-06', 1500.00, 'Cash', 'qqqq', '2025-06-06 04:23:58');

-- --------------------------------------------------------

--
-- Table structure for table `encoded_bookings`
--

CREATE TABLE `encoded_bookings` (
  `id` int(11) NOT NULL,
  `booking_id` int(11) NOT NULL,
  `booking_type` varchar(20) NOT NULL,
  `booking_name` varchar(100) DEFAULT NULL,
  `encoded_by` varchar(20) NOT NULL,
  `encoded_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `encoded_bookings`
--

INSERT INTO `encoded_bookings` (`id`, `booking_id`, `booking_type`, `booking_name`, `encoded_by`, `encoded_at`) VALUES
(8, 15, 'vehicle', NULL, '0', '2025-05-31 05:07:41'),
(9, 14, 'vehicle', NULL, '0', '2025-05-31 05:09:44'),
(10, 13, 'vehicle', NULL, 'admin', '2025-05-31 06:28:53'),
(11, 12, 'vehicle', NULL, 'admin', '2025-05-31 06:29:07'),
(13, 1, 'vehicle', NULL, 'admin', '2025-05-31 07:12:40'),
(14, 2, 'vehicle', NULL, 'admin', '2025-05-31 07:12:47'),
(15, 11, 'vehicle', NULL, 'admin', '2025-05-31 07:20:51'),
(16, 10, 'vehicle', NULL, 'admin', '2025-05-31 07:22:20'),
(18, 9, 'vehicle', 'undefined', 'admin', '2025-05-31 07:28:19'),
(19, 2, 'hotel', NULL, 'admin', '2025-06-06 09:32:45');

-- --------------------------------------------------------

--
-- Table structure for table `general_ledger`
--

CREATE TABLE `general_ledger` (
  `id` int(11) NOT NULL,
  `account_id` int(11) DEFAULT NULL,
  `account_name` varchar(100) DEFAULT NULL,
  `debit` decimal(12,2) DEFAULT 0.00,
  `credit` decimal(12,2) DEFAULT 0.00,
  `balance` decimal(12,2) DEFAULT 0.00,
  `period` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `general_ledger`
--

INSERT INTO `general_ledger` (`id`, `account_id`, `account_name`, `debit`, `credit`, `balance`, `period`) VALUES
(105, 2, '', 200.00, 0.00, 200.00, '2025-05-29'),
(106, 3, '', 0.00, 200.00, -200.00, '2025-05-29'),
(107, 4, '', 23.00, 0.00, 23.00, '2025-05-29'),
(108, 1, '', 0.00, 23.00, -23.00, '2025-05-29'),
(109, 1, '', 247.00, 0.00, 247.00, '2025-05-30'),
(110, 2, '', 835.00, 247.00, 588.00, '2025-05-30'),
(111, 3, '', 0.00, 835.00, -835.00, '2025-05-30'),
(112, 2, '', 3500.00, 100.00, 3400.00, '2025-05-31'),
(113, 3, '', 0.00, 3500.00, -3500.00, '2025-05-31'),
(114, 1, '', 100.00, 0.00, 100.00, '2025-05-31'),
(115, 10, 'Recruitment and Training Expense', 156.00, 0.00, 156.00, '2025-06-04'),
(116, 9, 'Salaries and Wages Expense', 246.00, 0.00, 246.00, '2025-06-04'),
(117, 8, 'Supplies Expense', 123.00, 0.00, 123.00, '2025-06-04'),
(118, 2, '', 4.00, 6.00, -2.00, '2025-06-04'),
(119, 3, '', 0.00, 4.00, -4.00, '2025-06-04'),
(120, 1, '', 6.00, 2.00, 4.00, '2025-06-04'),
(121, 4, '', 2.00, 0.00, 2.00, '2025-06-04'),
(122, 2, '', 123.00, 0.00, 123.00, '2025-06-06'),
(123, 3, '', 0.00, 123.00, -123.00, '2025-06-06'),
(124, 9, 'Salaries and Wages Expense', 1500.00, 0.00, 1500.00, '2025-06-06'),
(125, 4, '', 1500.00, 0.00, 1500.00, '2025-06-06'),
(126, 1, '', 0.00, 1500.00, -1500.00, '2025-06-06');

-- --------------------------------------------------------

--
-- Table structure for table `journal_entries`
--

CREATE TABLE `journal_entries` (
  `id` int(11) NOT NULL,
  `transaction_date` date NOT NULL,
  `account_id` int(11) DEFAULT NULL,
  `debit` decimal(12,2) DEFAULT 0.00,
  `credit` decimal(12,2) DEFAULT 0.00,
  `module_type` varchar(50) DEFAULT NULL,
  `reference_id` int(11) DEFAULT NULL,
  `remarks` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `journal_entries`
--

INSERT INTO `journal_entries` (`id`, `transaction_date`, `account_id`, `debit`, `credit`, `module_type`, `reference_id`, `remarks`, `created_at`) VALUES
(1, '2025-05-29', 2, 200.00, 0.00, 'AR', 119, 'Invoice: INV-20250529-002', '2025-05-29 06:27:16'),
(2, '2025-05-29', 3, 0.00, 200.00, 'AR', 119, 'Invoice: INV-20250529-002', '2025-05-29 06:27:16'),
(3, '2025-05-29', 4, 23.00, 0.00, 'DISBURSEMENT', 72, 'Fully Paid', '2025-05-29 06:44:51'),
(4, '2025-05-29', 1, 0.00, 23.00, 'DISBURSEMENT', 72, 'Fully Paid', '2025-05-29 06:44:51'),
(5, '2025-05-30', 1, 1.00, 0.00, 'COLLECTION', 150, 'Payment for Invoice: INV-20250529-002', '2025-05-30 03:05:52'),
(6, '2025-05-30', 2, 0.00, 1.00, 'COLLECTION', 150, 'Payment for Invoice: INV-20250529-002', '2025-05-30 03:05:52'),
(7, '2025-05-30', 2, 123.00, 0.00, 'AR', 120, 'Invoice: INV-20250530-001', '2025-05-30 10:30:18'),
(8, '2025-05-30', 3, 0.00, 123.00, 'AR', 120, 'Invoice: INV-20250530-001', '2025-05-30 10:30:18'),
(9, '2025-05-30', 1, 123.00, 0.00, 'COLLECTION', 151, 'Payment for Invoice: INV-20250530-001', '2025-05-30 10:30:55'),
(10, '2025-05-30', 2, 0.00, 123.00, 'COLLECTION', 151, 'Payment for Invoice: INV-20250530-001', '2025-05-30 10:30:55'),
(11, '2025-05-30', 2, 589.00, 0.00, 'AR', 121, 'Invoice: INV-20250530-002', '2025-05-30 15:27:11'),
(12, '2025-05-30', 3, 0.00, 589.00, 'AR', 121, 'Invoice: INV-20250530-002', '2025-05-30 15:27:11'),
(13, '2025-05-30', 2, 123.00, 0.00, 'AR', 122, 'Invoice: INV-20250530-003', '2025-05-30 15:31:29'),
(14, '2025-05-30', 3, 0.00, 123.00, 'AR', 122, 'Invoice: INV-20250530-003', '2025-05-30 15:31:29'),
(15, '2025-05-30', 1, 123.00, 0.00, 'COLLECTION', 152, 'Payment for Invoice: INV-20250530-003', '2025-05-30 21:23:27'),
(16, '2025-05-30', 2, 0.00, 123.00, 'COLLECTION', 152, 'Payment for Invoice: INV-20250530-003', '2025-05-30 21:23:27'),
(17, '2025-05-31', 2, 2500.00, 0.00, 'AR', 123, 'Invoice: INV-20250531-001', '2025-05-30 22:45:46'),
(18, '2025-05-31', 3, 0.00, 2500.00, 'AR', 123, 'Invoice: INV-20250531-001', '2025-05-30 22:45:46'),
(19, '2025-05-31', 2, 1000.00, 0.00, 'AR', 124, 'Invoice: INV-20250531-002', '2025-05-30 22:46:57'),
(20, '2025-05-31', 3, 0.00, 1000.00, 'AR', 124, 'Invoice: INV-20250531-002', '2025-05-30 22:46:57'),
(21, '2025-05-31', 1, 100.00, 0.00, 'COLLECTION', 153, 'Payment for Invoice: INV-20250531-002', '2025-05-30 22:48:53'),
(22, '2025-05-31', 2, 0.00, 100.00, 'COLLECTION', 153, 'Payment for Invoice: INV-20250531-002', '2025-05-30 22:48:53'),
(23, '2025-06-04', 10, 123.00, 0.00, 'AP', 73, 'qwe', '2025-06-03 23:42:25'),
(24, '2025-06-04', 4, 0.00, 123.00, 'AP', 73, 'qwe', '2025-06-03 23:42:25'),
(25, '2025-06-04', 9, 123.00, 0.00, 'AP', 74, 'qwe', '2025-06-03 23:44:58'),
(26, '2025-06-04', 4, 0.00, 123.00, 'AP', 74, 'qwe', '2025-06-03 23:44:58'),
(27, '2025-06-04', 9, 123.00, 0.00, 'AP', 75, 'qweqwe', '2025-06-03 23:49:33'),
(28, '2025-06-04', 4, 0.00, 123.00, 'AP', 75, 'qweqwe', '2025-06-03 23:49:33'),
(29, '2025-06-04', 8, 123.00, 0.00, 'AP', 76, 'qweqwe', '2025-06-03 23:53:36'),
(30, '2025-06-04', 4, 0.00, 123.00, 'AP', 76, 'qweqwe', '2025-06-03 23:53:36'),
(31, '2025-06-04', 10, 33.00, 0.00, 'AP', 77, 'q', '2025-06-03 23:54:30'),
(32, '2025-06-04', 4, 0.00, 33.00, 'AP', 77, 'q', '2025-06-03 23:54:30'),
(33, '2025-06-04', 2, 2.00, 0.00, 'AR', 125, 'Invoice: INV-20250604-001', '2025-06-04 00:16:05'),
(34, '2025-06-04', 3, 0.00, 2.00, 'AR', 125, 'Invoice: INV-20250604-001', '2025-06-04 00:16:05'),
(35, '2025-06-04', 1, 2.00, 0.00, 'COLLECTION', 154, 'Payment for Invoice: INV-20250604-001', '2025-06-04 00:25:20'),
(36, '2025-06-04', 2, 0.00, 2.00, 'COLLECTION', 154, 'Payment for Invoice: INV-20250604-001', '2025-06-04 00:25:20'),
(37, '2025-06-04', 1, 1.00, 0.00, 'COLLECTION', 155, 'Payment for Invoice: INV-20250531-001', '2025-06-04 00:26:31'),
(38, '2025-06-04', 2, 0.00, 1.00, 'COLLECTION', 155, 'Payment for Invoice: INV-20250531-001', '2025-06-04 00:26:31'),
(39, '2025-06-04', 1, 1.00, 0.00, 'COLLECTION', 156, 'Payment for Invoice: INV-20250530-002', '2025-06-04 00:27:32'),
(40, '2025-06-04', 2, 0.00, 1.00, 'COLLECTION', 156, 'Payment for Invoice: INV-20250530-002', '2025-06-04 00:27:32'),
(41, '2025-06-04', 2, 2.00, 0.00, 'AR', 126, 'Invoice: INV-20250604-002', '2025-06-04 05:20:44'),
(42, '2025-06-04', 3, 0.00, 2.00, 'AR', 126, 'Invoice: INV-20250604-002', '2025-06-04 05:20:44'),
(43, '2025-06-04', 1, 1.00, 0.00, 'COLLECTION', 157, 'Payment for Invoice: INV-20250604-002', '2025-06-04 05:21:12'),
(44, '2025-06-04', 2, 0.00, 1.00, 'COLLECTION', 157, 'Payment for Invoice: INV-20250604-002', '2025-06-04 05:21:12'),
(45, '2025-06-04', 1, 1.00, 0.00, 'COLLECTION', 158, 'Payment for Invoice: INV-20250530-002', '2025-06-04 05:22:21'),
(46, '2025-06-04', 2, 0.00, 1.00, 'COLLECTION', 158, 'Payment for Invoice: INV-20250530-002', '2025-06-04 05:22:21'),
(47, '2025-06-04', 4, 2.00, 0.00, 'DISBURSEMENT', 77, 'w', '2025-06-04 05:37:41'),
(48, '2025-06-04', 1, 0.00, 2.00, 'DISBURSEMENT', 77, 'w', '2025-06-04 05:37:41'),
(49, '2025-06-06', 2, 123.00, 0.00, 'AR', 127, 'Invoice: INV-20250606-001', '2025-06-06 04:02:05'),
(50, '2025-06-06', 3, 0.00, 123.00, 'AR', 127, 'Invoice: INV-20250606-001', '2025-06-06 04:02:05'),
(51, '2025-06-06', 9, 1500.00, 0.00, 'AP', 78, 'For salary', '2025-06-06 04:23:14'),
(52, '2025-06-06', 4, 0.00, 1500.00, 'AP', 78, 'For salary', '2025-06-06 04:23:14'),
(53, '2025-06-06', 4, 1500.00, 0.00, 'DISBURSEMENT', 78, 'qqqq', '2025-06-06 04:23:58'),
(54, '2025-06-06', 1, 0.00, 1500.00, 'DISBURSEMENT', 78, 'qqqq', '2025-06-06 04:23:58');

-- --------------------------------------------------------

--
-- Table structure for table `payable_requests`
--

CREATE TABLE `payable_requests` (
  `id` int(11) NOT NULL,
  `payee` varchar(255) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `due_date` date NOT NULL,
  `department_id` int(11) DEFAULT NULL,
  `account_id` int(11) DEFAULT NULL,
  `requested_by` varchar(255) NOT NULL,
  `remarks` text DEFAULT NULL,
  `status` enum('Pending','Approved','Rejected') DEFAULT 'Pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payable_requests`
--

INSERT INTO `payable_requests` (`id`, `payee`, `amount`, `due_date`, `department_id`, `account_id`, `requested_by`, `remarks`, `status`, `created_at`, `updated_at`) VALUES
(13, 'aeron', 1200.00, '2025-05-13', 3, 6, '', 'Pang Gas daw ng mga bus', 'Approved', '2025-05-13 03:43:07', '2025-05-13 03:43:56'),
(14, 'qweqwe', 99999999.99, '2025-05-13', 1, 9, '', 'pang sugal', 'Rejected', '2025-05-13 03:44:43', '2025-05-29 05:25:46'),
(15, 'kenkg', 120.00, '2025-05-14', 1, 9, '', 'qwe', 'Approved', '2025-05-13 22:23:18', '2025-05-13 22:23:31'),
(16, 'kler', 1000.00, '2025-05-14', 2, 12, '', 'Bibili yosi', 'Approved', '2025-05-13 22:27:45', '2025-05-13 22:27:50'),
(17, 'asdasd', 123.00, '2025-05-28', 1, 9, '', 'qwe', 'Approved', '2025-05-28 13:19:11', '2025-05-28 13:34:04'),
(18, 'ken', 20.00, '2025-05-29', 5, 9, '', 'qwe', 'Approved', '2025-05-29 05:25:42', '2025-05-29 05:25:49'),
(19, 'ken1', 1.00, '2025-05-29', 8, 8, '', 'q', 'Approved', '2025-05-29 05:47:34', '2025-05-29 05:47:40'),
(20, 'qewew', 23.00, '2025-05-29', 5, 14, '', 'hahahah', 'Approved', '2025-05-29 06:15:40', '2025-05-29 06:15:44'),
(21, 'qweqw', 123123.00, '2025-06-03', 4, 10, '', 'qwe', 'Pending', '2025-06-03 15:00:40', '2025-06-03 15:00:40'),
(22, 'qweqwe', 123.00, '2025-06-03', 4, 8, '', 'qweqwe', 'Approved', '2025-06-03 15:05:56', '2025-06-03 23:53:36'),
(23, 'qweasd', 123.00, '2025-06-03', 4, 9, 'kenken', 'qweqwe', 'Approved', '2025-06-03 15:07:24', '2025-06-03 23:49:33'),
(24, 'tite', 123.00, '2025-06-03', 4, 9, 'kenken', 'qweqwe', 'Rejected', '2025-06-03 15:36:08', '2025-06-03 15:37:20'),
(25, 'qweqwe', 123.00, '2025-06-04', 4, 9, '', 'qwe', 'Approved', '2025-06-03 18:34:08', '2025-06-03 23:44:58'),
(26, 'keknekenken', 333.00, '2025-06-04', 4, 9, '', 'qwe', 'Rejected', '2025-06-03 18:34:25', '2025-06-03 18:34:30'),
(27, 'qwe', 123.00, '2025-06-04', 4, 10, 'admin', 'qwe', 'Approved', '2025-06-03 23:37:30', '2025-06-03 23:42:25'),
(28, 's', 33.00, '2025-06-04', 6, 10, 'admin', 'q', 'Approved', '2025-06-03 23:54:01', '2025-06-03 23:54:30'),
(29, 'John Doe', 1500.00, '2025-06-06', 5, 9, 'admin', 'For salary', 'Approved', '2025-06-06 04:22:57', '2025-06-06 04:23:14');

-- --------------------------------------------------------

--
-- Table structure for table `request_table`
--

CREATE TABLE `request_table` (
  `id` int(11) NOT NULL,
  `department` varchar(100) NOT NULL,
  `payee` varchar(255) NOT NULL,
  `amount` decimal(12,2) NOT NULL,
  `purpose` text NOT NULL,
  `request_type` varchar(100) NOT NULL,
  `reference_id` varchar(100) DEFAULT NULL,
  `requested_by` varchar(255) NOT NULL,
  `request_date` date NOT NULL,
  `status` enum('pending','approved','rejected') DEFAULT 'pending',
  `source` varchar(50) DEFAULT 'Manual',
  `date_encoded` timestamp NOT NULL DEFAULT current_timestamp(),
  `disbursement_status` enum('not_disbursed','disbursed') DEFAULT 'not_disbursed'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `request_table`
--

INSERT INTO `request_table` (`id`, `department`, `payee`, `amount`, `purpose`, `request_type`, `reference_id`, `requested_by`, `request_date`, `status`, `source`, `date_encoded`, `disbursement_status`) VALUES
(1, 'asdasd', 'asdasd', 12312.00, 'asdasd', 'Vehicle', 'asdwq', 'asdas', '2025-06-03', 'approved', 'API', '2025-06-02 21:33:02', 'disbursed'),
(2, 'HR', 'Employee', 123.00, 'Salary', 'Other', '', 'ken', '2025-06-03', 'approved', 'API', '2025-06-02 21:51:44', 'disbursed'),
(3, 'HR 2', 'qweqwe', 123123.00, 'qwe', 'Other', '', 'qwe', '2025-06-03', 'rejected', 'API', '2025-06-02 22:02:08', ''),
(5, 'IT', 'John Doe', 1500.00, 'Purchase new laptops for development team', 'purchase', 'REF-2025-001', 'Jane Manager', '2025-06-03', 'rejected', 'API', '2025-06-03 14:44:28', ''),
(6, 'IT', 'John Doe', 1500.00, 'Purchase new laptops for development team', 'purchase', 'REF-2025-001', 'Jane Manager', '2025-06-03', 'approved', 'API', '2025-06-03 14:47:02', 'not_disbursed'),
(7, 'HR', 'kekneknenk', 2000.00, 'asdasdasd', 'purchase', 'REF-2025-001', 'asfasfasfas', '2025-06-06', 'pending', 'API', '2025-06-06 04:28:11', 'not_disbursed');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','employee') NOT NULL DEFAULT 'employee',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `role`, `created_at`) VALUES
(3, 'ken', '$2y$10$5acJLBELao.os.VQen0e1..UYNpely9itTSak8z1ezF/COCuN3UBC', 'employee', '2025-05-12 02:57:19'),
(4, 'admin', '$2y$10$rasrBYJbeJmoDZRpd9ctdegoHIxL6S6OKVIntDWSTFNuPK6r6oMB6', 'admin', '2025-05-12 03:51:40'),
(5, 'kenken', '$2y$10$6JVmcADe1cxlFNzxIk9.C.vgDYI0p9A9k3j/n.MlhXs7F3AWzYZIy', 'employee', '2025-05-12 04:26:19'),
(6, 'chels', '$2y$10$yq8OxZXn0RpHybCAmOm7IueFoP9Bul30W68Zh9Htcyn7E0LJykPz.', 'employee', '2025-06-03 17:23:13'),
(7, 'admin1', '$2y$10$hoxAc.pONA///e4N1LnEIecqTln0jyrJfoaGfkf9ggiZeuIz5Gmy2', 'admin', '2025-06-03 17:32:51');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accounts_payable`
--
ALTER TABLE `accounts_payable`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_accounts_payable_department` (`department_id`);

--
-- Indexes for table `accounts_receivable`
--
ALTER TABLE `accounts_receivable`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `audit_trail`
--
ALTER TABLE `audit_trail`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `budget_allocations`
--
ALTER TABLE `budget_allocations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_budget_department` (`department_id`);

--
-- Indexes for table `chart_of_accounts`
--
ALTER TABLE `chart_of_accounts`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `account_code` (`account_code`);

--
-- Indexes for table `collection`
--
ALTER TABLE `collection`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_invoice_id` (`invoice_id`);

--
-- Indexes for table `core_payments`
--
ALTER TABLE `core_payments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `disbursement`
--
ALTER TABLE `disbursement`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_disbursement_payable` (`payable_id`);

--
-- Indexes for table `encoded_bookings`
--
ALTER TABLE `encoded_bookings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `general_ledger`
--
ALTER TABLE `general_ledger`
  ADD PRIMARY KEY (`id`),
  ADD KEY `account_id` (`account_id`);

--
-- Indexes for table `journal_entries`
--
ALTER TABLE `journal_entries`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_journal_account` (`account_id`);

--
-- Indexes for table `payable_requests`
--
ALTER TABLE `payable_requests`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `request_table`
--
ALTER TABLE `request_table`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accounts_payable`
--
ALTER TABLE `accounts_payable`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=79;

--
-- AUTO_INCREMENT for table `accounts_receivable`
--
ALTER TABLE `accounts_receivable`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=128;

--
-- AUTO_INCREMENT for table `audit_trail`
--
ALTER TABLE `audit_trail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `budget_allocations`
--
ALTER TABLE `budget_allocations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `chart_of_accounts`
--
ALTER TABLE `chart_of_accounts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `collection`
--
ALTER TABLE `collection`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=161;

--
-- AUTO_INCREMENT for table `core_payments`
--
ALTER TABLE `core_payments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `disbursement`
--
ALTER TABLE `disbursement`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT for table `encoded_bookings`
--
ALTER TABLE `encoded_bookings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `general_ledger`
--
ALTER TABLE `general_ledger`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=127;

--
-- AUTO_INCREMENT for table `journal_entries`
--
ALTER TABLE `journal_entries`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT for table `payable_requests`
--
ALTER TABLE `payable_requests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `request_table`
--
ALTER TABLE `request_table`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `accounts_payable`
--
ALTER TABLE `accounts_payable`
  ADD CONSTRAINT `fk_accounts_payable_department` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `audit_trail`
--
ALTER TABLE `audit_trail`
  ADD CONSTRAINT `audit_trail_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `budget_allocations`
--
ALTER TABLE `budget_allocations`
  ADD CONSTRAINT `fk_budget_department` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`);

--
-- Constraints for table `collection`
--
ALTER TABLE `collection`
  ADD CONSTRAINT `fk_invoice_id` FOREIGN KEY (`invoice_id`) REFERENCES `accounts_receivable` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `disbursement`
--
ALTER TABLE `disbursement`
  ADD CONSTRAINT `fk_disbursement_payable` FOREIGN KEY (`payable_id`) REFERENCES `accounts_payable` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `general_ledger`
--
ALTER TABLE `general_ledger`
  ADD CONSTRAINT `general_ledger_ibfk_1` FOREIGN KEY (`account_id`) REFERENCES `chart_of_accounts` (`id`);

--
-- Constraints for table `journal_entries`
--
ALTER TABLE `journal_entries`
  ADD CONSTRAINT `fk_journal_account` FOREIGN KEY (`account_id`) REFERENCES `chart_of_accounts` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
