-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 25, 2025 at 06:15 AM
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
(66, 'aeron', 1200.00, '2025-05-13', 6, 3, 'Pang Gas daw ng mga bus', 'Voided', '2025-05-13 03:43:56'),
(67, 'kenkg', 120.00, '2025-05-14', 9, 1, 'qwe', 'Paid', '2025-05-13 22:23:31'),
(68, 'kler', 1000.00, '2025-05-14', 12, 2, 'Bibili yosi', 'Paid', '2025-05-13 22:27:50');

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
(94, 'INV-20250512-001', 'Aeron burat', '2025-05-12', 0.00, NULL, NULL, '2025-05-12', 'Voided', 'qwe', '2025-05-12 02:06:50'),
(95, 'INV-20250513-001', 'Aeron Family', '2025-05-13', 4900.00, NULL, NULL, '2025-05-13', 'Partially Paid', 'Fam bonding', '2025-05-13 00:22:02'),
(96, 'INV-20250513-002', 'kenkenid', '2025-05-13', 0.00, NULL, NULL, '2025-05-13', 'Fully Paid', 'qwe', '2025-05-13 00:36:43'),
(97, 'INV-20250513-003', 'qwe', '2025-05-13', 0.00, NULL, NULL, '2025-06-14', 'Fully Paid', 'qwe', '2025-05-13 01:07:14'),
(98, 'INV-20250513-004', 'qwe', '2025-05-13', 0.00, NULL, NULL, '2025-06-18', 'Fully Paid', 'qwe', '2025-05-13 01:09:15'),
(99, 'INV-20250513-005', 'qwe123', '2025-05-13', 0.00, NULL, NULL, '2025-06-12', 'Fully Paid', 'qwe', '2025-05-13 01:14:29'),
(100, 'INV001', 'Dummy Client 1', '2024-06-01', 5000.00, 'Cash', '2024-06-15', '2024-06-30', 'Paid', 'Dummy invoice', '2025-05-13 01:20:44'),
(101, 'INV002', 'Dummy Client 2', '2024-07-01', 4800.00, 'Cash', '2024-07-10', '2024-07-31', 'Paid', 'Dummy invoice', '2025-05-13 01:20:44'),
(102, 'INV003', 'Dummy Client 3', '2024-08-01', 5200.00, 'Cash', '2024-08-20', '2024-08-31', 'Paid', 'Dummy invoice', '2025-05-13 01:20:44'),
(103, 'INV004', 'Dummy Client 4', '2024-09-01', 5100.00, 'Cash', '2024-09-18', '2024-09-30', 'Paid', 'Dummy invoice', '2025-05-13 01:20:44'),
(104, 'INV005', 'Dummy Client 5', '2024-10-01', 5300.00, 'Cash', '2024-10-22', '2024-10-31', 'Paid', 'Dummy invoice', '2025-05-13 01:20:44'),
(105, 'INV006', 'Dummy Client 6', '2024-11-01', 4900.00, 'Cash', '2024-11-12', '2024-11-30', 'Paid', 'Dummy invoice', '2025-05-13 01:20:44'),
(106, 'INV007', 'Dummy Client 7', '2024-12-01', 5500.00, 'Cash', '2024-12-05', '2024-12-31', 'Paid', 'Dummy invoice', '2025-05-13 01:20:44'),
(107, 'INV008', 'Dummy Client 8', '2025-01-01', 5700.00, 'Cash', '2025-01-08', '2025-01-31', 'Paid', 'Dummy invoice', '2025-05-13 01:20:44'),
(108, 'INV009', 'Dummy Client 9', '2025-02-01', 5600.00, 'Cash', '2025-02-14', '2025-02-28', 'Paid', 'Dummy invoice', '2025-05-13 01:20:44'),
(109, 'INV010', 'Dummy Client 10', '2025-03-01', 6000.00, 'Cash', '2025-03-16', '2025-03-31', 'Paid', 'Dummy invoice', '2025-05-13 01:20:44'),
(110, 'INV011', 'Dummy Client 11', '2025-04-01', 6100.00, 'Cash', '2025-04-11', '2025-04-30', 'Paid', 'Dummy invoice', '2025-05-13 01:20:44'),
(111, 'INV012', 'Dummy Client 12', '2025-05-01', 6200.00, 'Cash', '2025-05-09', '2025-05-31', 'Paid', 'Dummy invoice', '2025-05-13 01:20:44'),
(112, 'INV-20250513-018', 'qweqwe', '2025-05-13', 0.00, NULL, NULL, '2025-05-13', 'Fully Paid', 'sample', '2025-05-13 01:53:32'),
(113, 'INV-20250513-019', 'qweqwe', '2025-05-13', 0.00, NULL, NULL, '2025-05-13', 'Fully Paid', 'qwe', '2025-05-13 03:35:52'),
(114, 'INV-20250513-020', 'qweqwe123123', '2025-05-13', 0.00, NULL, NULL, '2025-08-13', 'Fully Paid', 'qwe', '2025-05-13 03:37:32'),
(115, 'INV-20250513-021', 'kalbo', '2025-05-13', 0.00, NULL, NULL, '2025-05-13', 'Voided', 'qwe', '2025-05-13 03:47:26'),
(116, 'INV-20250514-001', 'kalbo123', '2025-05-14', 0.00, NULL, NULL, '2025-05-15', 'Voided', 'qwe', '2025-05-13 22:29:53');

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
(1, 1, '2025', 500000.00, 6842.00, 'Active', '2025-04-26 13:43:02', '2025-05-13 22:25:48'),
(2, 2, '2025', 1000000.00, 9316.00, 'Active', '2025-04-26 13:47:12', '2025-05-13 22:28:27'),
(4, 3, '2025', 10000.00, 1100.00, 'Active', '2025-04-26 20:02:27', '2025-05-09 07:48:00');

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
(99, 94, 23.00, 'Cash', '2025-05-12', NULL, '2025-05-12 02:07:06'),
(100, 95, 5000.00, 'Cash', '2025-05-13', NULL, '2025-05-13 00:23:38'),
(101, 95, 100.00, 'Cash', '2025-05-13', NULL, '2025-05-13 00:29:52'),
(102, 96, 123.00, 'Cash', '2025-05-13', NULL, '2025-05-13 00:37:31'),
(103, 97, 1000.00, 'Cash', '2025-07-05', NULL, '2025-05-13 01:08:15'),
(104, 98, 123.00, 'Cash', '2025-05-13', NULL, '2025-05-13 01:09:24'),
(105, 99, 123.00, 'Cash', '2025-06-13', NULL, '2025-05-13 01:14:42'),
(130, 100, 5000.00, 'Cash', '2024-06-15', 'Payment for INV001', '2025-05-13 01:22:41'),
(131, 101, 4800.00, 'Cash', '2024-07-10', 'Payment for INV002', '2025-05-13 01:22:41'),
(132, 102, 5200.00, 'Cash', '2024-08-20', 'Payment for INV003', '2025-05-13 01:22:41'),
(133, 103, 5100.00, 'Cash', '2024-09-18', 'Payment for INV004', '2025-05-13 01:22:41'),
(134, 104, 5300.00, 'Cash', '2024-10-22', 'Payment for INV005', '2025-05-13 01:22:41'),
(135, 105, 4900.00, 'Cash', '2024-11-12', 'Payment for INV006', '2025-05-13 01:22:41'),
(136, 106, 5500.00, 'Cash', '2024-12-05', 'Payment for INV007', '2025-05-13 01:22:41'),
(137, 107, 5700.00, 'Cash', '2025-01-08', 'Payment for INV008', '2025-05-13 01:22:41'),
(138, 108, 5600.00, 'Cash', '2025-02-14', 'Payment for INV009', '2025-05-13 01:22:41'),
(139, 109, 6000.00, 'Cash', '2025-03-16', 'Payment for INV010', '2025-05-13 01:22:41'),
(140, 110, 6100.00, 'Cash', '2025-04-11', 'Payment for INV011', '2025-05-13 01:22:41'),
(141, 111, 6200.00, 'Cash', '2025-05-09', 'Payment for INV012', '2025-05-13 01:22:41'),
(142, 112, 20000.00, 'Cash', '2025-07-14', NULL, '2025-05-13 01:53:50'),
(143, 113, 123.00, 'Cash', '2025-06-19', NULL, '2025-05-13 03:36:07'),
(144, 114, 123.00, 'Cash', '2025-08-12', NULL, '2025-05-13 03:37:43'),
(145, 115, 600.00, 'Cash', '2025-05-13', NULL, '2025-05-13 03:48:50'),
(146, 116, 123.00, 'Cash', '2025-05-14', NULL, '2025-05-13 22:30:10');

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
(1, 'HR', 'Human Resources Department', 'active', '2025-04-26 01:03:27', '2025-04-26 01:03:27'),
(2, 'LOGISTIC', 'Logistics and Operations Department', 'active', '2025-04-26 01:03:27', '2025-04-26 01:03:27'),
(3, 'CORE', 'Core Services and Management', 'active', '2025-04-26 01:03:27', '2025-04-26 01:03:27');

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
(58, 67, '2025-05-14', 120.00, 'Cash', 'q', '2025-05-13 22:25:48'),
(59, 68, '2025-05-14', 1000.00, 'Cash', 'q', '2025-05-13 22:28:27');

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
(81, 2, '', 223.00, 23.00, 200.00, '2025-05-12'),
(82, 3, '', 123.00, 123.00, 0.00, '2025-05-12'),
(83, 1, '', 23.00, 23.00, 0.00, '2025-05-12'),
(84, 2, '', 33415.00, 27315.00, 6100.00, '2025-05-13'),
(85, 3, '', 1223.00, 32815.00, -31592.00, '2025-05-13'),
(86, 1, '', 27315.00, 623.00, 26692.00, '2025-05-13'),
(87, 6, 'Travel Expense', 1200.00, 0.00, 1200.00, '2025-05-13'),
(88, 9, 'Salaries and Wages Expense', 120.00, 0.00, 120.00, '2025-05-14'),
(89, 4, '', 1120.00, 0.00, 1120.00, '2025-05-14'),
(90, 1, '', 123.00, 1243.00, -1120.00, '2025-05-14'),
(91, 12, 'Marketing and Advertising Expense', 1000.00, 0.00, 1000.00, '2025-05-14'),
(92, 2, '', 2277.00, 123.00, 2154.00, '2025-05-14'),
(93, 3, '', 1200.00, 1200.00, 0.00, '2025-05-14');

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
(543, '2025-05-12', 2, 123.00, 0.00, 'AR', 94, 'Invoice: INV-20250512-001', '2025-05-12 02:06:50'),
(544, '2025-05-12', 3, 0.00, 123.00, 'AR', 94, 'Invoice: INV-20250512-001', '2025-05-12 02:06:50'),
(545, '2025-05-12', 1, 23.00, 0.00, 'COLLECTION', 99, 'Payment for Invoice: INV-20250512-001', '2025-05-12 02:07:06'),
(546, '2025-05-12', 2, 0.00, 23.00, 'COLLECTION', 99, 'Payment for Invoice: INV-20250512-001', '2025-05-12 02:07:06'),
(547, '2025-05-12', 3, 123.00, 0.00, 'AR_VOID', 94, 'VOIDED Invoice: INV-20250512-001', '2025-05-12 02:07:18'),
(548, '2025-05-12', 2, 100.00, 0.00, 'AR_VOID', 94, 'VOIDED Invoice: INV-20250512-001', '2025-05-12 02:07:18'),
(549, '2025-05-12', 1, 0.00, 23.00, 'AR_VOID', 94, 'VOIDED Invoice: INV-20250512-001', '2025-05-12 02:07:18'),
(550, '2025-05-13', 2, 10000.00, 0.00, 'AR', 95, 'Invoice: INV-20250513-001', '2025-05-13 00:22:02'),
(551, '2025-05-13', 3, 0.00, 10000.00, 'AR', 95, 'Invoice: INV-20250513-001', '2025-05-13 00:22:02'),
(552, '2025-05-13', 1, 5000.00, 0.00, 'COLLECTION', 100, 'Payment for Invoice: INV-20250513-001', '2025-05-13 00:23:38'),
(553, '2025-05-13', 2, 0.00, 5000.00, 'COLLECTION', 100, 'Payment for Invoice: INV-20250513-001', '2025-05-13 00:23:38'),
(554, '2025-05-13', 3, 23.00, 0.00, 'AR_VOID', 94, 'VOIDED Invoice: INV-20250512-001', '2025-05-13 00:28:45'),
(555, '2025-05-13', 1, 0.00, 23.00, 'AR_VOID', 94, 'VOIDED Invoice: INV-20250512-001', '2025-05-13 00:28:45'),
(556, '2025-05-13', 1, 100.00, 0.00, 'COLLECTION', 101, 'Payment for Invoice: INV-20250513-001', '2025-05-13 00:29:52'),
(557, '2025-05-13', 2, 0.00, 100.00, 'COLLECTION', 101, 'Payment for Invoice: INV-20250513-001', '2025-05-13 00:29:52'),
(558, '2025-05-13', 2, 123.00, 0.00, 'AR', 96, 'Invoice: INV-20250513-002', '2025-05-13 00:36:43'),
(559, '2025-05-13', 3, 0.00, 123.00, 'AR', 96, 'Invoice: INV-20250513-002', '2025-05-13 00:36:43'),
(560, '2025-05-13', 1, 123.00, 0.00, 'COLLECTION', 102, 'Payment for Invoice: INV-20250513-002', '2025-05-13 00:37:31'),
(561, '2025-05-13', 2, 0.00, 123.00, 'COLLECTION', 102, 'Payment for Invoice: INV-20250513-002', '2025-05-13 00:37:31'),
(562, '2025-05-13', 2, 1000.00, 0.00, 'AR', 97, 'Invoice: INV-20250513-003', '2025-05-13 01:07:14'),
(563, '2025-05-13', 3, 0.00, 1000.00, 'AR', 97, 'Invoice: INV-20250513-003', '2025-05-13 01:07:14'),
(564, '2025-05-13', 1, 1000.00, 0.00, 'COLLECTION', 103, 'Payment for Invoice: INV-20250513-003', '2025-05-13 01:08:15'),
(565, '2025-05-13', 2, 0.00, 1000.00, 'COLLECTION', 103, 'Payment for Invoice: INV-20250513-003', '2025-05-13 01:08:15'),
(566, '2025-05-13', 2, 123.00, 0.00, 'AR', 98, 'Invoice: INV-20250513-004', '2025-05-13 01:09:15'),
(567, '2025-05-13', 3, 0.00, 123.00, 'AR', 98, 'Invoice: INV-20250513-004', '2025-05-13 01:09:15'),
(568, '2025-05-13', 1, 123.00, 0.00, 'COLLECTION', 104, 'Payment for Invoice: INV-20250513-004', '2025-05-13 01:09:24'),
(569, '2025-05-13', 2, 0.00, 123.00, 'COLLECTION', 104, 'Payment for Invoice: INV-20250513-004', '2025-05-13 01:09:24'),
(570, '2025-05-13', 2, 123.00, 0.00, 'AR', 99, 'Invoice: INV-20250513-005', '2025-05-13 01:14:29'),
(571, '2025-05-13', 3, 0.00, 123.00, 'AR', 99, 'Invoice: INV-20250513-005', '2025-05-13 01:14:29'),
(572, '2025-05-13', 1, 123.00, 0.00, 'COLLECTION', 105, 'Payment for Invoice: INV-20250513-005', '2025-05-13 01:14:42'),
(573, '2025-05-13', 2, 0.00, 123.00, 'COLLECTION', 105, 'Payment for Invoice: INV-20250513-005', '2025-05-13 01:14:42'),
(574, '2025-05-13', 2, 20000.00, 0.00, 'AR', 112, 'Invoice: INV-20250513-018', '2025-05-13 01:53:32'),
(575, '2025-05-13', 3, 0.00, 20000.00, 'AR', 112, 'Invoice: INV-20250513-018', '2025-05-13 01:53:32'),
(576, '2025-05-13', 1, 20000.00, 0.00, 'COLLECTION', 142, 'Payment for Invoice: INV-20250513-018', '2025-05-13 01:53:50'),
(577, '2025-05-13', 2, 0.00, 20000.00, 'COLLECTION', 142, 'Payment for Invoice: INV-20250513-018', '2025-05-13 01:53:50'),
(578, '2025-05-13', 2, 123.00, 0.00, 'AR', 113, 'Invoice: INV-20250513-019', '2025-05-13 03:35:52'),
(579, '2025-05-13', 3, 0.00, 123.00, 'AR', 113, 'Invoice: INV-20250513-019', '2025-05-13 03:35:52'),
(580, '2025-05-13', 1, 123.00, 0.00, 'COLLECTION', 143, 'Payment for Invoice: INV-20250513-019', '2025-05-13 03:36:07'),
(581, '2025-05-13', 2, 0.00, 123.00, 'COLLECTION', 143, 'Payment for Invoice: INV-20250513-019', '2025-05-13 03:36:07'),
(582, '2025-05-13', 2, 123.00, 0.00, 'AR', 114, 'Invoice: INV-20250513-020', '2025-05-13 03:37:32'),
(583, '2025-05-13', 3, 0.00, 123.00, 'AR', 114, 'Invoice: INV-20250513-020', '2025-05-13 03:37:32'),
(584, '2025-05-13', 1, 123.00, 0.00, 'COLLECTION', 144, 'Payment for Invoice: INV-20250513-020', '2025-05-13 03:37:43'),
(585, '2025-05-13', 2, 0.00, 123.00, 'COLLECTION', 144, 'Payment for Invoice: INV-20250513-020', '2025-05-13 03:37:43'),
(586, '2025-05-13', 6, 1200.00, 0.00, 'AP', 66, 'Pang Gas daw ng mga bus', '2025-05-13 03:43:56'),
(587, '2025-05-13', 4, 0.00, 1200.00, 'AP', 66, 'Pang Gas daw ng mga bus', '2025-05-13 03:43:56'),
(588, '2025-05-13', 2, 1200.00, 0.00, 'AR', 115, 'Invoice: INV-20250513-021', '2025-05-13 03:47:26'),
(589, '2025-05-13', 3, 0.00, 1200.00, 'AR', 115, 'Invoice: INV-20250513-021', '2025-05-13 03:47:26'),
(590, '2025-05-13', 1, 600.00, 0.00, 'COLLECTION', 145, 'Payment for Invoice: INV-20250513-021', '2025-05-13 03:48:50'),
(591, '2025-05-13', 2, 0.00, 600.00, 'COLLECTION', 145, 'Payment for Invoice: INV-20250513-021', '2025-05-13 03:48:50'),
(592, '2025-05-13', 3, 1200.00, 0.00, 'AR_VOID', 115, 'VOIDED Invoice: INV-20250513-021', '2025-05-13 03:52:03'),
(593, '2025-05-13', 2, 600.00, 0.00, 'AR_VOID', 115, 'VOIDED Invoice: INV-20250513-021', '2025-05-13 03:52:03'),
(594, '2025-05-13', 1, 0.00, 600.00, 'AR_VOID', 115, 'VOIDED Invoice: INV-20250513-021', '2025-05-13 03:52:03'),
(595, '2025-05-14', 9, 120.00, 0.00, 'AP', 67, 'qwe', '2025-05-13 22:23:31'),
(596, '2025-05-14', 4, 0.00, 120.00, 'AP', 67, 'qwe', '2025-05-13 22:23:31'),
(597, '2025-05-14', 4, 120.00, 0.00, 'DISBURSEMENT', 67, 'q', '2025-05-13 22:25:48'),
(598, '2025-05-14', 1, 0.00, 120.00, 'DISBURSEMENT', 67, 'q', '2025-05-13 22:25:48'),
(599, '2025-05-14', 12, 1000.00, 0.00, 'AP', 68, 'Bibili yosi', '2025-05-13 22:27:50'),
(600, '2025-05-14', 4, 0.00, 1000.00, 'AP', 68, 'Bibili yosi', '2025-05-13 22:27:50'),
(601, '2025-05-14', 4, 1000.00, 0.00, 'DISBURSEMENT', 68, 'q', '2025-05-13 22:28:27'),
(602, '2025-05-14', 1, 0.00, 1000.00, 'DISBURSEMENT', 68, 'q', '2025-05-13 22:28:27'),
(603, '2025-05-14', 2, 1200.00, 0.00, 'AR', 116, 'Invoice: INV-20250514-001', '2025-05-13 22:29:53'),
(604, '2025-05-14', 3, 0.00, 1200.00, 'AR', 116, 'Invoice: INV-20250514-001', '2025-05-13 22:29:53'),
(605, '2025-05-14', 1, 123.00, 0.00, 'COLLECTION', 146, 'Payment for Invoice: INV-20250514-001', '2025-05-13 22:30:10'),
(606, '2025-05-14', 2, 0.00, 123.00, 'COLLECTION', 146, 'Payment for Invoice: INV-20250514-001', '2025-05-13 22:30:10'),
(607, '2025-05-14', 3, 1200.00, 0.00, 'AR_VOID', 116, 'VOIDED Invoice: INV-20250514-001', '2025-05-13 22:30:23'),
(608, '2025-05-14', 2, 1077.00, 0.00, 'AR_VOID', 116, 'VOIDED Invoice: INV-20250514-001', '2025-05-13 22:30:23'),
(609, '2025-05-14', 1, 0.00, 123.00, 'AR_VOID', 116, 'VOIDED Invoice: INV-20250514-001', '2025-05-13 22:30:23');

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
  `remarks` text DEFAULT NULL,
  `status` enum('Pending','Approved','Rejected') DEFAULT 'Pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payable_requests`
--

INSERT INTO `payable_requests` (`id`, `payee`, `amount`, `due_date`, `department_id`, `account_id`, `remarks`, `status`, `created_at`, `updated_at`) VALUES
(13, 'aeron', 1200.00, '2025-05-13', 3, 6, 'Pang Gas daw ng mga bus', 'Approved', '2025-05-13 03:43:07', '2025-05-13 03:43:56'),
(14, 'qweqwe', 99999999.99, '2025-05-13', 1, 9, 'pang sugal', 'Pending', '2025-05-13 03:44:43', '2025-05-13 03:44:43'),
(15, 'kenkg', 120.00, '2025-05-14', 1, 9, 'qwe', 'Approved', '2025-05-13 22:23:18', '2025-05-13 22:23:31'),
(16, 'kler', 1000.00, '2025-05-14', 2, 12, 'Bibili yosi', 'Approved', '2025-05-13 22:27:45', '2025-05-13 22:27:50');

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
(5, 'kenken', '$2y$10$GV18HsFDqMp3vf3deCEode7V7QzDQxK5WFWOIK3exlwSVZ5q5ikWK', 'employee', '2025-05-12 04:26:19');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;

--
-- AUTO_INCREMENT for table `accounts_receivable`
--
ALTER TABLE `accounts_receivable`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=117;

--
-- AUTO_INCREMENT for table `budget_allocations`
--
ALTER TABLE `budget_allocations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `chart_of_accounts`
--
ALTER TABLE `chart_of_accounts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `collection`
--
ALTER TABLE `collection`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=147;

--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `disbursement`
--
ALTER TABLE `disbursement`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT for table `general_ledger`
--
ALTER TABLE `general_ledger`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=94;

--
-- AUTO_INCREMENT for table `journal_entries`
--
ALTER TABLE `journal_entries`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=610;

--
-- AUTO_INCREMENT for table `payable_requests`
--
ALTER TABLE `payable_requests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `accounts_payable`
--
ALTER TABLE `accounts_payable`
  ADD CONSTRAINT `fk_accounts_payable_department` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

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
