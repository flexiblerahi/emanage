-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Oct 01, 2023 at 01:15 PM
-- Server version: 10.3.38-MariaDB-cll-lve
-- PHP Version: 8.1.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `noorincorporatio_realestate`
--

-- --------------------------------------------------------

--
-- Table structure for table `attendances`
--

CREATE TABLE `attendances` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_detail_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `backup_bank_infos`
--

CREATE TABLE `backup_bank_infos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `bank_info_id` bigint(20) UNSIGNED NOT NULL,
  `bank_name_id` bigint(20) UNSIGNED NOT NULL,
  `account_id` varchar(500) NOT NULL,
  `address` text DEFAULT NULL,
  `amount` double NOT NULL DEFAULT 0,
  `status` tinyint(4) NOT NULL DEFAULT 0,
  `entry` bigint(20) UNSIGNED NOT NULL,
  `comment` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `backup_bank_infos`
--

INSERT INTO `backup_bank_infos` (`id`, `bank_info_id`, `bank_name_id`, `account_id`, `address`, `amount`, `status`, `entry`, `comment`, `created_at`, `updated_at`) VALUES
(1, 3, 2, 'Hasebul 210', 'Mouchak', 0, 1, 1, 'A/C Type Add', '2023-07-24 11:19:49', '2023-07-24 11:19:49');

-- --------------------------------------------------------

--
-- Table structure for table `backup_bank_transactions`
--

CREATE TABLE `backup_bank_transactions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `bank_transaction_id` bigint(20) UNSIGNED NOT NULL,
  `account_id` varchar(500) NOT NULL,
  `bank_info_id` bigint(20) UNSIGNED DEFAULT NULL,
  `amount` double NOT NULL DEFAULT 0,
  `trx_by` tinyint(4) NOT NULL DEFAULT 0 COMMENT 'cash=0,online_transfer=1,check=2',
  `trx_no` varchar(255) DEFAULT NULL COMMENT 'transaction_no',
  `other` text DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0 COMMENT 'withdraw=0,cashin=1',
  `date` date DEFAULT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL,
  `entry` bigint(20) UNSIGNED NOT NULL,
  `comment` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `backup_bank_transactions`
--

INSERT INTO `backup_bank_transactions` (`id`, `bank_transaction_id`, `account_id`, `bank_info_id`, `amount`, `trx_by`, `trx_no`, `other`, `status`, `date`, `model_type`, `model_id`, `entry`, `comment`, `created_at`, `updated_at`) VALUES
(1, 78, '100078', 1, -1000, 1, '1', 'Gas + Toll Advance', 0, '2023-08-27', 'App\\Models\\Expense', 64, 1, 'jj', '2023-08-27 07:59:29', '2023-08-27 07:59:29'),
(2, 83, '100083', 1, -2500, 1, '1', NULL, 0, '2023-09-30', 'App\\Models\\Expense', 69, 1, 'Add Bazar', '2023-09-30 08:55:40', '2023-09-30 08:55:40');

-- --------------------------------------------------------

--
-- Table structure for table `backup_expenses`
--

CREATE TABLE `backup_expenses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `expense_id` bigint(20) UNSIGNED NOT NULL,
  `expense_item_id` bigint(20) UNSIGNED NOT NULL,
  `entry` bigint(20) UNSIGNED NOT NULL,
  `comment` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `backup_expenses`
--

INSERT INTO `backup_expenses` (`id`, `expense_id`, `expense_item_id`, `entry`, `comment`, `created_at`, `updated_at`) VALUES
(1, 64, 16, 1, 'jj', '2023-08-27 07:59:29', '2023-08-27 07:59:29'),
(2, 69, 1, 1, 'Add Bazar', '2023-09-30 08:55:40', '2023-09-30 08:55:40');

-- --------------------------------------------------------

--
-- Table structure for table `backup_expense_items`
--

CREATE TABLE `backup_expense_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `expense_item_id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `parent` bigint(20) UNSIGNED DEFAULT NULL,
  `entry` bigint(20) UNSIGNED NOT NULL,
  `comment` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `backup_investments`
--

CREATE TABLE `backup_investments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `investment_id` bigint(20) UNSIGNED NOT NULL,
  `investor_id` bigint(20) UNSIGNED NOT NULL,
  `document` varchar(255) DEFAULT NULL,
  `rate` double NOT NULL DEFAULT 0,
  `duration` int(11) NOT NULL DEFAULT 0,
  `duration_in` varchar(255) NOT NULL,
  `comment` text DEFAULT NULL,
  `entry` bigint(20) UNSIGNED NOT NULL,
  `invest_at` date NOT NULL,
  `last_interest` date DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1 COMMENT '1 = activate( get commission every month), 0 = deactive (not get any commission)',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `backup_investment_withdraws`
--

CREATE TABLE `backup_investment_withdraws` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `investment_withdraw_id` bigint(20) UNSIGNED NOT NULL,
  `investor_id` bigint(20) UNSIGNED NOT NULL,
  `investment_id` bigint(20) UNSIGNED NOT NULL,
  `amount` double NOT NULL DEFAULT 0,
  `date` date DEFAULT NULL,
  `entry` bigint(20) UNSIGNED NOT NULL,
  `other` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `backup_other_deposits`
--

CREATE TABLE `backup_other_deposits` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `other_deposit_id` bigint(20) UNSIGNED NOT NULL,
  `other` text DEFAULT NULL,
  `document` varchar(255) DEFAULT NULL,
  `entry` bigint(20) UNSIGNED NOT NULL,
  `comment` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `backup_payments`
--

CREATE TABLE `backup_payments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `payment_id` bigint(20) UNSIGNED NOT NULL,
  `sale_id` bigint(20) UNSIGNED NOT NULL,
  `commission` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `commission_type` varchar(255) NOT NULL,
  `percentage` double NOT NULL DEFAULT 0,
  `comment` text DEFAULT NULL,
  `entry` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `backup_salaries`
--

CREATE TABLE `backup_salaries` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `salary_id` bigint(20) UNSIGNED NOT NULL,
  `user_detail_id` bigint(20) UNSIGNED NOT NULL,
  `group_id` bigint(20) UNSIGNED DEFAULT NULL,
  `type_id` bigint(20) UNSIGNED DEFAULT NULL,
  `other` text DEFAULT NULL,
  `monthly` varchar(255) DEFAULT NULL,
  `entry` bigint(20) UNSIGNED NOT NULL,
  `comment` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `backup_sales`
--

CREATE TABLE `backup_sales` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `sale_id` bigint(20) UNSIGNED NOT NULL,
  `customer_id` bigint(20) UNSIGNED NOT NULL,
  `agent_id` bigint(20) UNSIGNED DEFAULT NULL,
  `shareholder_id` bigint(20) UNSIGNED NOT NULL,
  `price` double NOT NULL DEFAULT 0,
  `sector` varchar(255) NOT NULL,
  `block` varchar(255) NOT NULL,
  `road` varchar(255) NOT NULL,
  `plot` varchar(255) NOT NULL,
  `kata` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `type` varchar(255) NOT NULL COMMENT 'cash, emi',
  `commission` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL COMMENT 'commission data will be comes from commission table data take which agent get how much commission',
  `date` date NOT NULL,
  `entry` bigint(20) UNSIGNED NOT NULL,
  `comment` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `backup_sales`
--

INSERT INTO `backup_sales` (`id`, `sale_id`, `customer_id`, `agent_id`, `shareholder_id`, `price`, `sector`, `block`, `road`, `plot`, `kata`, `type`, `commission`, `date`, `entry`, `comment`, `created_at`, `updated_at`) VALUES
(6, 37, 77, NULL, 24, 500000, '2', 'A', '60', '6', '5', 'emi', '{\"installment\":[{\"hand\":\"hand_1\",\"percentage\":20,\"agent_id\":\"28\"},{\"hand\":\"shareholder\",\"percentage\":15,\"shareholder_id\":\"23\"}],\"down_payment\":[{\"hand\":\"hand_1\",\"percentage\":14,\"agent_id\":\"28\"},{\"hand\":\"shareholder\",\"percentage\":16,\"shareholder_id\":\"23\"}],\"booking_money\":[{\"hand\":\"hand_1\",\"percentage\":16,\"agent_id\":\"28\"},{\"hand\":\"shareholder\",\"percentage\":24.5,\"shareholder_id\":\"23\"}]}', '2022-08-29', 1, 'u', '2023-08-29 16:50:28', '2023-08-29 16:50:28'),
(7, 69, 108, NULL, 25, 600000, '1', 'B', '10', '14', '10', 'emi', '{\"installment\":[{\"hand\":\"shareholder\",\"percentage\":\"25\",\"shareholder_id\":\"25\"}],\"down_payment\":[{\"hand\":\"shareholder\",\"percentage\":\"30\",\"shareholder_id\":\"25\"}],\"booking_money\":[{\"hand\":\"shareholder\",\"percentage\":\"40.5\",\"shareholder_id\":\"25\"}]}', '2022-12-31', 1, 'Phone Number Update', '2023-08-30 08:09:42', '2023-08-30 08:09:42'),
(8, 87, 126, NULL, 25, 600000, '1', 'B', '8', '32', '10', 'cash', '{\"installment\":[{\"hand\":\"shareholder\",\"percentage\":\"25\",\"shareholder_id\":\"25\"}],\"down_payment\":[{\"hand\":\"shareholder\",\"percentage\":\"30\",\"shareholder_id\":\"25\"}],\"booking_money\":[{\"hand\":\"shareholder\",\"percentage\":\"40.5\",\"shareholder_id\":\"25\"}]}', '2022-12-31', 17, 'Sale Date Update', '2023-08-31 08:55:14', '2023-08-31 08:55:14'),
(9, 86, 125, NULL, 25, 600000, '1', 'C', '14', '8', '5', 'emi', '{\"installment\":[{\"hand\":\"shareholder\",\"percentage\":\"25\",\"shareholder_id\":\"25\"}],\"down_payment\":[{\"hand\":\"shareholder\",\"percentage\":\"30\",\"shareholder_id\":\"25\"}],\"booking_money\":[{\"hand\":\"shareholder\",\"percentage\":\"40.5\",\"shareholder_id\":\"25\"}]}', '2022-12-31', 17, 'Sale Date Update', '2023-08-31 08:56:06', '2023-08-31 08:56:06'),
(10, 85, 124, NULL, 25, 600000, '1', 'C', '15', '54', '5', 'emi', '{\"installment\":[{\"hand\":\"shareholder\",\"percentage\":\"25\",\"shareholder_id\":\"25\"}],\"down_payment\":[{\"hand\":\"shareholder\",\"percentage\":\"30\",\"shareholder_id\":\"25\"}],\"booking_money\":[{\"hand\":\"shareholder\",\"percentage\":\"40.5\",\"shareholder_id\":\"25\"}]}', '2022-12-31', 17, 'Sale Date Update', '2023-08-31 08:56:47', '2023-08-31 08:56:47'),
(11, 84, 123, NULL, 25, 550000, '2', 'O', '30', '48', '3', 'emi', '{\"installment\":[{\"hand\":\"shareholder\",\"percentage\":\"25\",\"shareholder_id\":\"25\"}],\"down_payment\":[{\"hand\":\"shareholder\",\"percentage\":\"30\",\"shareholder_id\":\"25\"}],\"booking_money\":[{\"hand\":\"shareholder\",\"percentage\":\"40.5\",\"shareholder_id\":\"25\"}]}', '2022-12-31', 17, 'Sale Date Update', '2023-08-31 08:58:43', '2023-08-31 08:58:43');

-- --------------------------------------------------------

--
-- Table structure for table `backup_transactions`
--

CREATE TABLE `backup_transactions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `transaction_id` bigint(20) UNSIGNED NOT NULL,
  `user_details_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL DEFAULT 0,
  `amount` double NOT NULL DEFAULT 0,
  `date` date DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0 COMMENT 'withdraw = 0, cashin = 1',
  `other` text DEFAULT NULL,
  `entry` bigint(20) UNSIGNED NOT NULL,
  `comment` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `bank_infos`
--

CREATE TABLE `bank_infos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `bank_name_id` bigint(20) UNSIGNED NOT NULL,
  `account_id` varchar(500) NOT NULL,
  `amount` double NOT NULL DEFAULT 0,
  `address` text DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0,
  `entry` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `bank_infos`
--

INSERT INTO `bank_infos` (`id`, `bank_name_id`, `account_id`, `amount`, `address`, `status`, `entry`, `created_at`, `updated_at`) VALUES
(1, 1, '1', 113092, 'Default Account', 1, 1, '2023-07-22 18:03:14', '2023-09-30 08:55:40'),
(2, 2, 'Noorin Corporation', 495000, 'Mouchak', 1, 1, '2023-07-24 11:17:47', '2023-07-24 12:21:15'),
(3, 2, 'Hasebul 210', 0, 'Salary A/C', 1, 1, '2023-07-24 11:18:31', '2023-07-24 11:19:49'),
(4, 2, 'Hasebul 280', 0, 'Personal A/C', 1, 1, '2023-07-24 11:19:01', '2023-07-24 11:19:01'),
(5, 3, 'Noorin Co DBBL', 0, 'Shantinagor', 1, 1, '2023-07-24 11:21:47', '2023-07-24 11:21:47'),
(6, 4, 'Hasebul', 0, 'Perconal A/C', 1, 1, '2023-07-24 11:22:10', '2023-07-24 11:22:10'),
(7, 5, 'Apple B-Kash', 49000, 'Personal', 1, 1, '2023-07-24 11:42:29', '2023-07-24 11:59:30'),
(8, 5, 'Manik B-Kash', 0, 'Personals', 1, 1, '2023-07-24 11:43:51', '2023-07-24 11:43:51');

-- --------------------------------------------------------

--
-- Table structure for table `bank_names`
--

CREATE TABLE `bank_names` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `entry` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `bank_names`
--

INSERT INTO `bank_names` (`id`, `name`, `status`, `entry`, `created_at`, `updated_at`) VALUES
(1, 'Cash', 1, 1, '2023-07-22 18:03:14', '2023-07-22 18:03:14'),
(2, 'City Bank', 1, 1, '2023-07-24 11:16:20', '2023-07-24 11:16:35'),
(3, 'Dutch Bangla Bank', 1, 1, '2023-07-24 11:16:51', '2023-07-24 11:16:51'),
(4, 'IBBL', 1, 1, '2023-07-24 11:17:00', '2023-07-24 11:17:00'),
(5, 'B-Kash', 1, 1, '2023-07-24 11:41:55', '2023-07-24 11:41:55');

-- --------------------------------------------------------

--
-- Table structure for table `bank_transactions`
--

CREATE TABLE `bank_transactions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `account_id` varchar(500) NOT NULL,
  `bank_info_id` bigint(20) UNSIGNED DEFAULT NULL,
  `amount` double NOT NULL DEFAULT 0,
  `trx_by` tinyint(4) NOT NULL DEFAULT 0 COMMENT 'cash=0,online_transfer=1,check=2',
  `trx_no` varchar(255) DEFAULT NULL COMMENT 'transaction_no',
  `other` text DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0 COMMENT 'withdraw=0,cashin=1',
  `date` date DEFAULT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL,
  `entry` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `bank_transactions`
--

INSERT INTO `bank_transactions` (`id`, `account_id`, `bank_info_id`, `amount`, `trx_by`, `trx_no`, `other`, `status`, `date`, `model_type`, `model_id`, `entry`, `created_at`, `updated_at`) VALUES
(1, '100001', 1, 45000, 1, '1', NULL, 1, '2023-07-24', 'App\\Models\\Payment', 1, 1, '2023-07-24 10:49:42', '2023-07-24 10:49:42'),
(2, '100002', 1, 0, 1, '1', NULL, 0, '2023-07-24', 'App\\Models\\Salary', 1, 1, '2023-07-24 11:11:29', '2023-07-24 11:11:29'),
(3, '100003', 1, -1000, 1, '1', NULL, 0, '2023-07-24', 'App\\Models\\Salary', 2, 1, '2023-07-24 11:11:29', '2023-07-24 11:11:29'),
(4, '100004', 1, 1000000, 1, '1', 'Cash CQ', 1, '2023-07-24', 'App\\Models\\Investment', 1, 1, '2023-07-24 11:15:50', '2023-07-24 11:15:50'),
(5, '100005', 2, 500000, 0, '005', 'Invest', 1, '2023-05-01', 'App\\Models\\Investment', 2, 1, '2023-07-24 11:26:55', '2023-07-24 11:26:55'),
(6, '100006', 1, 25000, 1, '1', NULL, 1, '2023-07-13', 'App\\Models\\Payment', 2, 17, '2023-07-24 11:41:35', '2023-07-24 11:41:35'),
(7, '100007', 7, 50000, 0, '24.07.23', 'Invest', 1, '2023-01-01', 'App\\Models\\Investment', 3, 1, '2023-07-24 11:45:06', '2023-07-24 11:45:06'),
(8, '100008', 1, -2000, 1, '1', 'Antor', 0, '2023-07-24', 'App\\Models\\Expense', 1, 1, '2023-07-24 11:56:31', '2023-07-24 11:56:31'),
(9, '100009', 1, -1100, 1, '1', 'Office Nasta By Hossain', 0, '2023-07-24', 'App\\Models\\Expense', 2, 1, '2023-07-24 11:57:18', '2023-07-24 11:57:18'),
(10, '100010', 7, -1000, 0, '01', 'Beethi Vabi B-Kash Send', 0, '2023-07-24', 'App\\Models\\Expense', 3, 1, '2023-07-24 11:59:30', '2023-07-24 11:59:30'),
(11, '100011', 1, -2000, 1, '1', 'Johirul Karim for 22.07.2023', 0, '2023-07-24', 'App\\Models\\Expense', 4, 1, '2023-07-24 12:00:10', '2023-07-24 12:00:10'),
(12, '100012', 1, -1800, 1, '1', 'Oil+ Toll Advance', 0, '2023-07-24', 'App\\Models\\Expense', 5, 1, '2023-07-24 12:00:52', '2023-07-24 12:00:52'),
(13, '100013', 1, -1000, 1, '1', 'Gas + Toll Advance', 0, '2023-07-24', 'App\\Models\\Expense', 6, 1, '2023-07-24 12:01:28', '2023-07-24 12:01:28'),
(14, '100014', 1, -2200, 1, '1', 'By Mama', 0, '2023-07-21', 'App\\Models\\Expense', 7, 1, '2023-07-24 12:02:14', '2023-07-24 12:02:14'),
(15, '100015', 1, -1500, 1, '1', NULL, 0, '2023-07-13', 'App\\Models\\Expense', 8, 1, '2023-07-24 12:02:41', '2023-07-24 12:02:41'),
(16, '100016', 2, -5000, 0, '002', NULL, 0, '2023-07-24', 'App\\Models\\Transaction', 7, 1, '2023-07-24 12:21:15', '2023-07-24 12:21:15'),
(17, '100017', 1, -5000, 1, '1', NULL, 0, '2023-07-24', 'App\\Models\\Transaction', 8, 1, '2023-07-24 12:30:45', '2023-07-24 12:30:45'),
(18, '100018', 1, -2200, 1, '1', NULL, 0, '2023-07-26', 'App\\Models\\Expense', 9, 1, '2023-07-26 08:52:06', '2023-07-26 08:52:06'),
(19, '100019', 1, -2400, 1, '1', 'Dettol, Soap, Sugar, Tishu, & Others', 0, '2023-07-26', 'App\\Models\\Expense', 10, 1, '2023-07-26 08:53:30', '2023-07-26 08:53:30'),
(20, '100020', 1, -5000, 1, '1', 'Bashundhara Flat Purpose', 0, '2023-07-26', 'App\\Models\\Expense', 11, 1, '2023-07-26 08:54:19', '2023-07-26 08:54:19'),
(21, '100021', 1, -1800, 1, '1', 'Gas + Toll Purpose', 0, '2023-07-26', 'App\\Models\\Expense', 12, 1, '2023-07-26 08:55:04', '2023-07-26 08:55:04'),
(22, '100022', 1, -6000, 1, '1', 'A.R Mintu For Date 14.07.23 & 21.07.23', 0, '2023-07-26', 'App\\Models\\Expense', 13, 1, '2023-07-26 08:55:47', '2023-07-26 08:55:47'),
(23, '100023', 1, -5000, 1, '1', 'Manik Vai Loan Purpose', 0, '2023-07-26', 'App\\Models\\Expense', 14, 1, '2023-07-26 08:57:02', '2023-07-26 08:57:02'),
(24, '100024', 1, -500000, 1, '1', '223 Dcm Land Purpose IBBL Depo.', 0, '2023-07-31', 'App\\Models\\Expense', 15, 1, '2023-07-31 02:45:11', '2023-07-31 02:45:11'),
(25, '100025', 1, -1000, 1, '1', 'Gas + toll Advance', 0, '2023-07-31', 'App\\Models\\Expense', 16, 1, '2023-07-31 02:46:02', '2023-07-31 02:46:02'),
(26, '100026', 1, -2000, 1, '1', NULL, 0, '2023-07-31', 'App\\Models\\Expense', 17, 1, '2023-07-31 02:46:37', '2023-07-31 02:46:37'),
(27, '100027', 1, 210, 1, '1', NULL, 1, '2023-07-31', 'App\\Models\\OtherDeposit', 1, 1, '2023-07-31 02:48:05', '2023-07-31 02:48:05'),
(28, '100028', 1, -6480, 1, '1', NULL, 0, '2023-08-05', 'App\\Models\\Expense', 18, 1, '2023-08-05 02:21:40', '2023-08-05 02:21:40'),
(29, '100029', 1, -1500, 1, '1', 'Shanto Srinagar Purpose', 0, '2023-08-05', 'App\\Models\\Expense', 19, 1, '2023-08-05 02:25:40', '2023-08-05 02:25:40'),
(30, '100030', 1, -2730, 1, '1', 'Gas + Toll (Total 4530)', 0, '2023-08-05', 'App\\Models\\Expense', 20, 1, '2023-08-05 02:27:04', '2023-08-05 02:27:04'),
(31, '100031', 1, -1880, 1, '1', 'Office File + Moila Baill + Donation + Tishu', 0, '2023-08-05', 'App\\Models\\Expense', 21, 1, '2023-08-05 02:27:44', '2023-08-05 02:27:44'),
(32, '100032', 1, -610, 1, '1', 'Dolil Photocopy + Coffee', 0, '2023-08-06', 'App\\Models\\Expense', 22, 1, '2023-08-06 04:32:19', '2023-08-06 04:32:19'),
(33, '100033', 1, -100000, 1, '1', 'To PPL Juwel By Miraz', 0, '2023-08-06', 'App\\Models\\Expense', 23, 1, '2023-08-06 04:34:20', '2023-08-06 04:34:20'),
(34, '100034', 1, -200000, 1, '1', 'To PPL Juwel By Miraz For Kalur Land Purpose', 0, '2023-08-06', 'App\\Models\\Expense', 24, 1, '2023-08-06 04:35:02', '2023-08-06 04:35:02'),
(35, '100035', 1, -6000, 1, '1', 'Beethi Vabi B-Kash Send', 0, '2023-08-06', 'App\\Models\\Expense', 25, 1, '2023-08-06 04:36:04', '2023-08-06 04:36:04'),
(36, '100036', 1, 100000, 1, '1', NULL, 1, '2023-08-06', 'App\\Models\\OtherDeposit', 2, 1, '2023-08-06 04:38:28', '2023-08-06 04:38:28'),
(37, '100037', 1, -2000, 1, '1', 'Johirul Karim For 06.08.2023', 0, '2023-08-06', 'App\\Models\\Expense', 26, 1, '2023-08-06 10:27:59', '2023-08-06 10:27:59'),
(38, '100038', 1, -1800, 1, '1', NULL, 0, '2023-08-06', 'App\\Models\\Expense', 27, 1, '2023-08-06 10:28:25', '2023-08-06 10:28:25'),
(39, '100039', 1, -1000, 1, '1', NULL, 0, '2023-08-06', 'App\\Models\\Expense', 28, 1, '2023-08-06 10:28:46', '2023-08-06 10:28:46'),
(40, '100040', 1, -1000, 1, '1', NULL, 0, '2023-08-06', 'App\\Models\\Expense', 29, 1, '2023-08-06 10:29:57', '2023-08-06 10:29:57'),
(41, '100041', 1, -3000, 1, '1', 'Bazar', 0, '2023-08-10', 'App\\Models\\Expense', 30, 1, '2023-08-10 03:03:45', '2023-08-10 03:03:45'),
(42, '100042', 1, -3500, 1, '1', 'By Jilan', 0, '2023-08-10', 'App\\Models\\Expense', 31, 1, '2023-08-10 03:04:19', '2023-08-10 03:04:19'),
(43, '100043', 1, -1000, 1, '1', 'Gas + Toll Advance', 0, '2023-08-10', 'App\\Models\\Expense', 32, 1, '2023-08-10 03:08:25', '2023-08-10 03:08:25'),
(44, '100044', 1, -1320, 1, '1', 'Home Baby Pampas By Jilan', 0, '2023-08-10', 'App\\Models\\Expense', 33, 1, '2023-08-10 03:09:09', '2023-08-10 03:09:09'),
(45, '100045', 1, -2000, 1, '1', 'Johirul Karim', 0, '2023-08-10', 'App\\Models\\Expense', 34, 1, '2023-08-10 03:09:51', '2023-08-10 03:09:51'),
(46, '100046', 1, -1620, 1, '1', 'bazar', 0, '2023-08-12', 'App\\Models\\Expense', 35, 1, '2023-08-12 03:24:12', '2023-08-12 03:24:12'),
(47, '100047', 1, -1000, 1, '1', NULL, 0, '2023-08-12', 'App\\Models\\Expense', 36, 1, '2023-08-12 03:24:33', '2023-08-12 03:24:33'),
(48, '100048', 1, 1420, 1, '1', NULL, 1, '2023-08-12', 'App\\Models\\OtherDeposit', 3, 1, '2023-08-12 03:25:24', '2023-08-12 03:25:24'),
(49, '100049', 1, -1000, 1, '1', NULL, 0, '2023-08-14', 'App\\Models\\Expense', 37, 1, '2023-08-14 06:43:21', '2023-08-14 06:43:21'),
(50, '100050', 1, -1200, 1, '1', 'Tishu, Poly, Handwash By Hossain', 0, '2023-08-14', 'App\\Models\\Expense', 38, 1, '2023-08-14 06:56:41', '2023-08-14 06:56:41'),
(51, '100051', 1, -2200, 1, '1', NULL, 0, '2023-08-16', 'App\\Models\\Expense', 39, 1, '2023-08-16 03:44:17', '2023-08-16 03:44:17'),
(52, '100052', 1, -1000, 1, '1', 'Gas + Toll Advance', 0, '2023-08-16', 'App\\Models\\Expense', 40, 1, '2023-08-16 03:44:50', '2023-08-16 03:44:50'),
(53, '100053', 1, -1000, 1, '1', 'Gas + Toll Advance', 0, '2023-08-16', 'App\\Models\\Expense', 41, 1, '2023-08-16 03:45:18', '2023-08-16 03:45:18'),
(54, '100054', 1, -200, 1, '1', 'Gas + Toll Total =3200/-', 0, '2023-08-16', 'App\\Models\\Expense', 42, 1, '2023-08-16 03:46:01', '2023-08-16 03:46:01'),
(55, '100055', 1, 572, 1, '1', 'Tofayal Return From 14.08.23', 1, '2023-08-16', 'App\\Models\\OtherDeposit', 4, 1, '2023-08-16 03:47:39', '2023-08-16 03:47:39'),
(56, '100056', 1, -100000, 1, '1', 'Resturant Wotk Purpose Khairul', 0, '2023-08-16', 'App\\Models\\Expense', 43, 1, '2023-08-16 03:50:11', '2023-08-16 03:50:11'),
(57, '100057', 1, -6000, 1, '1', 'Johirul Karin Visit Car Bill Fron 08.08.23 (3*2000)', 0, '2023-08-16', 'App\\Models\\Expense', 44, 1, '2023-08-16 03:51:41', '2023-08-16 03:51:41'),
(58, '100058', 1, -3500, 1, '1', NULL, 0, '2023-08-17', 'App\\Models\\Expense', 45, 1, '2023-08-17 02:39:50', '2023-08-17 02:39:50'),
(59, '100059', 1, -1200, 1, '1', 'Tea Bag 4 Box, Suger, Adea By Hossain', 0, '2023-08-17', 'App\\Models\\Expense', 46, 1, '2023-08-17 02:40:18', '2023-08-17 02:40:18'),
(60, '100060', 1, -4000, 1, '1', 'Cash Pay', 0, '2023-08-17', 'App\\Models\\Transaction', 9, 1, '2023-08-17 03:22:33', '2023-08-17 03:22:33'),
(61, '100061', 1, -2000, 1, '1', 'Bazar', 0, '2023-08-19', 'App\\Models\\Expense', 47, 1, '2023-08-19 02:28:42', '2023-08-19 02:28:42'),
(62, '100062', 1, -1570, 1, '1', 'Mamun Vai Home Bazar By Hossain', 0, '2023-08-19', 'App\\Models\\Expense', 48, 1, '2023-08-19 02:29:52', '2023-08-19 02:29:52'),
(63, '100063', 1, -10000, 1, '1', 'Jahangir Vai ac cable,pipe,other\'s Pur. (18.08.23)', 0, '2023-08-18', 'App\\Models\\Expense', 49, 1, '2023-08-19 02:30:28', '2023-08-19 02:30:28'),
(64, '100064', 1, -2000, 1, '1', NULL, 0, '2023-08-20', 'App\\Models\\Expense', 50, 1, '2023-08-20 04:08:27', '2023-08-20 04:08:27'),
(65, '100065', 1, -2000, 1, '1', 'Nagad Send', 0, '2023-08-20', 'App\\Models\\Expense', 51, 1, '2023-08-20 04:08:49', '2023-08-20 04:08:49'),
(66, '100066', 1, -1000, 1, '1', 'Advance', 0, '2023-08-20', 'App\\Models\\Expense', 52, 1, '2023-08-20 04:09:47', '2023-08-20 04:09:47'),
(67, '100067', 1, -2200, 1, '1', 'A-4 Paper', 0, '2023-08-20', 'App\\Models\\Expense', 53, 1, '2023-08-20 04:12:03', '2023-08-20 04:12:03'),
(68, '100068', 1, -4000, 1, '1', 'Bazar + Rice 25 Kg', 0, '2023-08-21', 'App\\Models\\Expense', 54, 1, '2023-08-21 05:27:34', '2023-08-21 05:27:34'),
(69, '100069', 1, -1000, 1, '1', 'Tishu, Tea Bag 4 Box', 0, '2023-08-21', 'App\\Models\\Expense', 55, 1, '2023-08-21 05:28:18', '2023-08-21 05:28:18'),
(70, '100070', 1, -2450, 1, '1', 'Bazar', 0, '2023-08-22', 'App\\Models\\Expense', 56, 1, '2023-08-23 02:41:02', '2023-08-23 02:41:02'),
(71, '100071', 1, -4000, 1, '1', 'Johirul Karim For 18.08.23, 22.08.23', 0, '2023-08-23', 'App\\Models\\Expense', 57, 1, '2023-08-23 02:43:41', '2023-08-23 02:43:41'),
(72, '100072', 1, -2000, 1, '1', 'Bazar By Hossain', 0, '2023-08-26', 'App\\Models\\Expense', 58, 1, '2023-08-26 03:24:08', '2023-08-26 03:24:08'),
(73, '100073', 1, -2000, 1, '1', 'Paper', 0, '2023-08-26', 'App\\Models\\Expense', 59, 1, '2023-08-26 03:24:26', '2023-08-26 03:24:26'),
(74, '100074', 1, -1500, 1, '1', 'Gas + Toll Advance', 0, '2023-08-26', 'App\\Models\\Expense', 60, 1, '2023-08-26 03:24:58', '2023-08-26 03:24:58'),
(75, '100075', 1, -200, 1, '1', 'Mobile Rech. (24.08.23)', 0, '2023-08-27', 'App\\Models\\Expense', 61, 1, '2023-08-27 02:31:08', '2023-08-27 02:31:08'),
(76, '100076', 1, -3100, 1, '1', 'Home Bazar By Tofayal', 0, '2023-08-27', 'App\\Models\\Expense', 62, 1, '2023-08-27 02:31:36', '2023-08-27 02:31:36'),
(77, '100077', 1, -2000, 1, '1', 'Gas + Toll Advance', 0, '2023-08-27', 'App\\Models\\Expense', 63, 1, '2023-08-27 02:32:07', '2023-08-27 02:32:07'),
(78, '100078', 1, -950, 1, '1', 'Gas + Toll Advance', 0, '2023-08-27', 'App\\Models\\Expense', 64, 1, '2023-08-27 02:33:25', '2023-08-27 07:59:29'),
(79, '100079', 1, -4000, 1, '1', 'Rice 25 Kg + Bazar', 0, '2023-08-28', 'App\\Models\\Expense', 65, 1, '2023-08-28 05:14:32', '2023-08-28 05:14:32'),
(80, '100080', 1, -3000, 1, '1', 'Nagad send', 0, '2023-08-28', 'App\\Models\\Expense', 66, 1, '2023-08-28 05:14:55', '2023-08-28 05:14:55'),
(81, '100081', 1, -900, 1, '1', 'Gas + Toll', 0, '2023-08-28', 'App\\Models\\Expense', 67, 1, '2023-08-28 05:15:20', '2023-08-28 05:15:20'),
(82, '100082', 1, -2000, 1, '1', 'Mobile Servicing Purpose', 0, '2023-08-28', 'App\\Models\\Expense', 68, 1, '2023-08-28 05:15:54', '2023-08-28 05:15:54'),
(83, '100083', 1, -2500, 1, '1', 'Bazar', 0, '2023-09-30', 'App\\Models\\Expense', 69, 1, '2023-09-30 08:54:55', '2023-09-30 08:55:40');

-- --------------------------------------------------------

--
-- Table structure for table `commissions`
--

CREATE TABLE `commissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `type` tinyint(4) NOT NULL COMMENT 'Booking Money = 0, Down Payment = 1, Installment = 2',
  `total` double NOT NULL DEFAULT 0,
  `rank1` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL COMMENT 'hand1, hand2, hand3, shareholder',
  `rank2` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL COMMENT 'hand1, hand2, hand3, shareholder',
  `rank3` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL COMMENT 'hand1, hand2, hand3, shareholder',
  `user_details_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `commissions`
--

INSERT INTO `commissions` (`id`, `type`, `total`, `rank1`, `rank2`, `rank3`, `user_details_id`, `created_at`, `updated_at`) VALUES
(1, 0, 25, '{\"hand1\":\"10\",\"hand2\":\"0\",\"hand3\":\"0\",\"shareholder\":\"15.00\"}', '{\"hand1\":\"0\",\"hand2\":\"0\",\"hand3\":\"0\",\"shareholder\":\"25.00\"}', '{\"hand1\":\"20\",\"hand2\":\"0\",\"hand3\":\"0\",\"shareholder\":\"5.00\"}', 1, '2023-07-22 18:03:14', '2023-08-30 03:33:49'),
(2, 1, 30, '{\"hand1\":\"14\",\"hand2\":\"10\",\"hand3\":\"0\",\"shareholder\":\"6.00\"}', '{\"hand1\":\"14\",\"hand2\":\"10\",\"hand3\":\"0\",\"shareholder\":\"6.00\"}', '{\"hand1\":\"14\",\"hand2\":\"10\",\"hand3\":\"0\",\"shareholder\":\"6.00\"}', 1, '2023-07-22 18:03:14', '2023-07-23 06:24:33'),
(3, 2, 40.5, '{\"hand1\":\"16.5\",\"hand2\":\"10\",\"hand3\":\"5\",\"shareholder\":\"9.00\"}', '{\"hand1\":\"16.5\",\"hand2\":\"10\",\"hand3\":\"5\",\"shareholder\":\"9.00\"}', '{\"hand1\":\"16\",\"hand2\":\"10\",\"hand3\":\"5\",\"shareholder\":\"9.50\"}', 1, '2023-07-22 18:03:14', '2023-07-23 06:25:43');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `account_id` varchar(255) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `phone` varchar(255) NOT NULL,
  `present_address` text DEFAULT NULL,
  `permanent_address` text DEFAULT NULL,
  `emergency_contact` varchar(255) DEFAULT NULL,
  `occupation` varchar(255) DEFAULT NULL,
  `parent_name` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL COMMENT 'father name, and mother name',
  `status` tinyint(4) NOT NULL DEFAULT 0,
  `image` varchar(255) DEFAULT NULL,
  `entry` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `account_id`, `name`, `phone`, `present_address`, `permanent_address`, `emergency_contact`, `occupation`, `parent_name`, `status`, `image`, `entry`, `created_at`, `updated_at`) VALUES
(3, 'cuE2526', 'rahman', '01711870259(2)', 'kk', 'jj', 'asdf', 'business', '{\"father\":\"as\",\"mother\":\"sdf\"}', 1, NULL, 1, '2023-07-23 17:36:38', '2023-08-31 04:01:35'),
(4, 'cuE-5088', 'Mohammad Atikur Rahman', '01711870259(3)', 'mmmm', 'mmmm', '0', 'Business', '{\"father\":\"Mr.\",\"mother\":\"Mts.\"}', 1, NULL, 17, '2023-07-24 10:33:29', '2023-08-31 07:28:45'),
(5, 'cuE-5061', 'Md Matiur Rahman & Gong', '01819457051(2)', 'aaa', 'aaa', '01819457051', 'ddd', '{\"father\":\"ddd\",\"mother\":\"ddd\"}', 1, NULL, 17, '2023-07-24 11:37:04', '2023-08-31 07:28:55'),
(6, 'cuE-5077', 'Fareha Zia', '01710101924(2)', 'aaa', 'aaa', '01710101924', 'ddd', '{\"father\":\"ddd\",\"mother\":\"ddd\"}', 1, NULL, 17, '2023-07-24 11:45:44', '2023-08-31 07:29:05'),
(7, 'cuE-5078', 'Zia Qamar', '01710101921(2)', 'aaa', 'aaa', '01710101924', 'ddd', '{\"father\":\"ddd\",\"mother\":\"ddd\"}', 1, NULL, 17, '2023-08-07 08:22:36', '2023-08-31 07:29:13'),
(8, 'cuE-5079', 'Irfana Farukh', '01715102996(2)', 'aaa', 'aaa', '01715102996', 'ddd', '{\"father\":\"ddd\",\"mother\":\"ddd\"}', 1, NULL, 17, '2023-08-07 08:26:31', '2023-08-31 07:29:25'),
(9, 'cuE-5080', 'Farukh Qamar', '01715102991(2)', 'aaa', 'aaa', '01715102996', 'ddd', '{\"father\":\"ddd\",\"mother\":\"ddd\"}', 1, NULL, 17, '2023-08-07 08:35:29', '2023-08-31 07:29:34'),
(10, 'cuE-5089', 'Dolly Akter & Sayed Nader', '01764078497(2)', 'aaa', 'aaa', '01764078497', 'ddd', '{\"father\":\"ddd\",\"mother\":\"ddd\"}', 1, NULL, 17, '2023-08-07 08:44:59', '2023-08-31 07:29:45'),
(11, 'cuE-5162', 'Md Shadidul Alam', '01676079563(2)', 'aaa', 'aaa', '01676079563', 'ddd', '{\"father\":\"ddd\",\"mother\":\"ddd\"}', 1, NULL, 17, '2023-08-07 09:29:04', '2023-08-31 07:29:54'),
(12, 'cuE-5157', 'Nasrin Akter, Md Mainul Islam & Gong', '01727778290(2)', 'aaa', 'aaa', '01727778290', 'ddd', '{\"father\":\"ddd\",\"mother\":\"ddd\"}', 1, NULL, 17, '2023-08-07 09:40:27', '2023-08-31 07:30:04'),
(26, 'cuE-5163', 'Zia Qamar', '01710101922(2)', 'aaa', 'aaa', '01710101922', 'ddd', '{\"father\":\"ddd\",\"mother\":\"ddd\"}', 1, NULL, 17, '2023-08-07 10:06:10', '2023-08-31 07:30:17'),
(47, 'cuE-5164', 'Farukh Qamar', '01715102992(2)', 'aaa', 'aaa', '01715102992', 'ddd', '{\"father\":\"ddd\",\"mother\":\"ddd\"}', 1, NULL, 17, '2023-08-07 10:17:13', '2023-08-31 07:30:37'),
(50, 'cuE-4397', 'Jisaiman Ahasan', '01711480459(2)', 'aaa', 'aaa', '01711480459', 'ddd', '{\"father\":\"ddd\",\"mother\":\"ddd\"}', 1, NULL, 17, '2023-08-12 02:27:57', '2023-08-31 07:32:11'),
(51, 'cuE-4508', 'Zoheb Ahasan', '01713211100(2)', 'aaa', 'aaa', '01713211100', 'ddd', '{\"father\":\"ddd\",\"mother\":\"ddd\"}', 1, NULL, 17, '2023-08-12 02:42:21', '2023-08-31 07:32:35'),
(52, 'cuE-5178', 'Fariah Sharmeen Akbar', '01911773500(2)', 'aaa', 'aaa', '0191773500', 'ddd', '{\"father\":\"ddd\",\"mother\":\"ddd\"}', 1, NULL, 17, '2023-08-12 02:45:48', '2023-08-31 07:32:23'),
(53, 'cuE-5180', 'Fariah Sharmeen Akbar', '01911773501(2)', 'aaa', 'aaa', '01911773501', 'ddd', '{\"father\":\"ddd\",\"mother\":\"ddd\"}', 1, NULL, 17, '2023-08-12 03:02:33', '2023-08-31 07:31:58'),
(54, 'cuE-5181', 'Md Shafiul Ajam Sharmin', '01931111555(2)', 'aaa', 'aaa', '01931111555', 'ddd', '{\"father\":\"ddd\",\"mother\":\"ddd\"}', 1, NULL, 17, '2023-08-12 03:05:12', '2023-08-31 07:31:43'),
(56, 'cuE-4537', 'Mohammad Atikur Rahman, Hemendra Nath Rou & Gong', '01711146532(2)', 'aaa', 'aaa', '01711146532', 'ddd', '{\"father\":\"ddd\",\"mother\":\"ddd\"}', 1, NULL, 17, '2023-08-12 03:19:57', '2023-08-31 07:31:26'),
(57, 'cuE-4541', 'Muhammad Mosharaf Hossain', '01712393558(2)', 'aaa', 'aaa', '01712393558', 'ddd', '{\"father\":\"ddd\",\"mother\":\"ddd\"}', 1, NULL, 17, '2023-08-12 03:22:57', '2023-08-31 07:31:04'),
(58, 'cuE-4534', 'Muhammad Mosharaf Hossain', '01712393559(2)', 'aaa', 'aaa', '01712393559', 'ddd', '{\"father\":\"ddd\",\"mother\":\"ddd\"}', 1, NULL, 17, '2023-08-12 03:31:39', '2023-08-31 07:30:52'),
(59, 'cuE-4540 (A)', 'Md Harun Ar Rashid & Nazmun Nahar', '01552475798(2)', 'aaa', 'aaa', '01552475798', 'ddd', '{\"father\":\"ddd\",\"mother\":\"ddd\"}', 1, NULL, 17, '2023-08-12 03:35:47', '2023-08-31 07:32:58'),
(60, 'cuE-5227', 'Muhammad Mosharaf Hossain', '01712393557(2)', 'aaa', 'aaa', '01712393557', 'ddd', '{\"father\":\"ddd\",\"mother\":\"ddd\"}', 1, NULL, 17, '2023-08-12 03:39:36', '2023-08-31 07:33:56'),
(61, 'cuE-5257', 'Aisha Akter Asha Asha, Aminul Islam Amin & Shafiul Azam', '01784890084(2)', 'aaa', 'aaa', '01784890084', 'ddd', '{\"father\":\"ddd\",\"mother\":\"ddd\"}', 1, NULL, 17, '2023-08-12 03:58:42', '2023-08-31 07:34:17'),
(63, 'cuE-5308', 'Syed Sayad Ibne Rashed', '01711629901(2)', 'aaa', 'aaa', '01711629901', 'ddd', '{\"father\":\"ddd\",\"mother\":\"ddd\"}', 1, NULL, 17, '2023-08-12 07:48:51', '2023-08-31 07:34:29'),
(64, 'cuE-5324', 'Nazim Uddin Chowdhury, Mohin Uddin & Gong', '01715952292(2)', 'aaa', 'aaa', '01715952292', 'ddd', '{\"father\":\"ddd\",\"mother\":\"ddd\"}', 1, NULL, 17, '2023-08-12 07:55:33', '2023-08-31 07:37:51'),
(65, 'cuE-5327', 'Md Habibur Rahman, Md Arif Billah & Md Atikur Rahman', '01715380239(2)', 'aaa', 'aaa', '01715380239', 'ddd', '{\"father\":\"ddd\",\"mother\":\"ddd\"}', 1, NULL, 17, '2023-08-12 08:01:33', '2023-08-31 07:38:05'),
(66, 'cuE-5346', 'Mohammad Atikur Rahman', '01711870250(2)', 'aaa', 'aaa', '01711870250', 'ddd', '{\"father\":\"ddd\",\"mother\":\"ddd\"}', 1, NULL, 17, '2023-08-12 08:04:11', '2023-08-31 07:37:33'),
(67, 'cuE-5472', 'Mohammad Atikur Rahman', '01711870259(4)', 'aaa', 'aaa', '01711870251', 'ddd', '{\"father\":\"ddd\",\"mother\":\"ddd\"}', 1, NULL, 17, '2023-08-12 08:09:38', '2023-08-31 07:37:17'),
(68, 'cuE-5345', 'Mohammad Atikur Rahman', '01711870259(2)(2)', 'aaa', 'aaa', '01711870252', 'ddd', '{\"father\":\"ddd\",\"mother\":\"ddd\"}', 1, NULL, 17, '2023-08-12 08:14:10', '2023-08-31 07:36:27'),
(69, 'cuE-5361', 'Tabassum Hasan & Sumaya Hasan', '01717688372(2)', 'aaa', 'aaa', '01717688372', 'ddd', '{\"father\":\"ddd\",\"mother\":\"ddd\"}', 1, NULL, 17, '2023-08-12 08:17:59', '2023-08-31 07:34:40'),
(70, 'cuC-04115', 'Abdul Haque', '01554330740(2)', 'aaa', 'aaa', '01554330740', 'ddd', '{\"father\":\"ddd\",\"mother\":\"ddd\"}', 1, NULL, 17, '2023-08-12 08:24:30', '2023-08-31 07:38:27'),
(71, 'cuC-04357', 'Md Hasibul Hoque & Rezaul Karim Rakib', '01674536629(2)', 'aaa', 'aaa', '01674536629', 'ddd', '{\"father\":\"ddd\",\"mother\":\"ddd\"}', 1, NULL, 17, '2023-08-13 04:26:16', '2023-08-31 07:38:50'),
(72, 'cuC 04613', 'Khandaker Salahuddin Ahmed', '01712184444', 'aaa', 'aaa', '01712184444', 'ddd', '{\"father\":\"ddd\",\"mother\":\"ddd\"}', 1, NULL, 17, '2023-08-13 04:31:34', '2023-08-13 04:31:34'),
(73, 'cuC 04889', 'Md Zafar Hossain', '01711050966', 'aaa', 'aaa', '01711050966', 'ddd', '{\"father\":\"ddd\",\"mother\":\"ddd\"}', 1, NULL, 17, '2023-08-13 04:41:32', '2023-08-13 04:41:32'),
(74, 'cuC 05444', 'Nazmun Nahar', '01818908333', 'aaa', 'aaa', '01818908333', 'ddd', '{\"father\":\"ddd\",\"mother\":\"ddd\"}', 1, NULL, 17, '2023-08-13 04:48:42', '2023-08-13 04:48:42'),
(75, 'cuC 05442', 'Sahadat Hosain', '01829968793', 'aaa', 'aaa', '01829968793', 'ddd', '{\"father\":\"ddd\",\"mother\":\"ddd\"}', 1, NULL, 17, '2023-08-13 04:55:27', '2023-08-13 04:55:27'),
(76, 'cuE 5335', 'Md Nurun Nobi Sumon', '0171595220', 'aaa', 'aaa', '01715952292', 'ddd', '{\"father\":\"ddd\",\"mother\":\"ddd\"}', 1, NULL, 17, '2023-08-13 05:15:37', '2023-08-13 05:15:37'),
(77, 'cuE 3333', 'Salima Rahman & Gong', '01772986368', 'aaa', 'aaa', '01772986368', 'ddd', '{\"father\":\"ddd\",\"mother\":\"ddd\"}', 1, NULL, 17, '2023-08-19 04:01:46', '2023-08-19 04:01:46'),
(78, 'cuE3333', 'Salima Rahman & Gong', '01772986369', 'aaaa', 'aaa', '01772986369', 'ddd', '{\"father\":\"ddd\",\"mother\":\"ddd\"}', 1, NULL, 17, '2023-08-19 04:19:22', '2023-08-19 04:19:22'),
(79, 'cuE 1372', 'Aklima Akter', '01912102268', 'aaa', 'aaa', '01912102268', 'ddd', '{\"father\":\"ddd\",\"mother\":\"ddd\"}', 1, NULL, 17, '2023-08-19 04:28:46', '2023-08-19 04:28:46'),
(80, 'cuE 4091', 'Md Ilias Ahmed Jamal', '01711386265', 'aaa', 'aaa', '01711386265', 'ddd', '{\"father\":\"ddd\",\"mother\":\"ddd\"}', 1, NULL, 17, '2023-08-19 04:42:21', '2023-08-19 04:42:21'),
(81, 'cuE 4657', 'Kaniz Fatema & Gong', '01717270606', 'aaa', 'aaa', '01717270606', 'ddd', '{\"father\":\"ddd\",\"mother\":\"ddd\"}', 1, NULL, 17, '2023-08-19 05:11:15', '2023-08-19 05:11:15'),
(82, 'cuE 4677', 'Rehena Parvin Beauty & Fatema Khatun', '01642537722', 'aaa', 'aaa', '01642537722', 'ddd', '{\"father\":\"ddd\",\"mother\":\"ddd\"}', 1, NULL, 17, '2023-08-19 05:20:30', '2023-08-19 05:20:30'),
(83, 'cuE 5042', 'Abu Naser', '01717270607', 'aaa', 'aaa', '01717270606', 'ddd', '{\"father\":\"ddd\",\"mother\":\"ddd\"}', 1, NULL, 17, '2023-08-19 05:23:10', '2023-08-19 05:23:10'),
(84, 'cuE 5065', 'Sarowar Jahan Popy & Gong', '01710928940', 'aaa', 'aaa', '01710928940', 'ddd', '{\"father\":\"ddd\",\"mother\":\"ddd\"}', 1, NULL, 17, '2023-08-19 05:25:41', '2023-08-19 05:25:41'),
(85, 'cuE 5072', 'Adnim Arifin & Rifat Haider', '01673204434', 'aaa', 'aaa', '01673204434', 'ddd', '{\"father\":\"ddd\",\"mother\":\"ddd\"}', 1, NULL, 17, '2023-08-19 05:28:29', '2023-08-19 05:28:29'),
(86, 'cuE 5073', 'Md Zafar Ullah & Md Morshed', '01735790904', 'aaa', 'aaa', '01735790904', 'ddd', '{\"father\":\"ddd\",\"mother\":\"ddd\"}', 1, NULL, 17, '2023-08-19 05:31:47', '2023-08-19 05:31:47'),
(87, 'cuE 5254', 'Samia Yeasmin & Gong', '01620280589', 'aaa', 'aaa', '01620280589', 'ddd', '{\"father\":\"ddd\",\"mother\":\"ddd\"}', 1, NULL, 17, '2023-08-19 05:34:09', '2023-08-19 05:34:09'),
(88, 'cuE 5440', 'Mohammad Nazmul Hossain & Gong', '01711365382', 'aaa', 'aaa', '01711365382', 'ddd', '{\"father\":\"ddd\",\"mother\":\"ddd\"}', 1, NULL, 17, '2023-08-19 05:37:47', '2023-08-19 05:37:47'),
(89, 'cuC 06027', 'Md Nazim Haider', '01722777193', 'aaa', 'aaa', '01722777193', 'ddd', '{\"father\":\"ddd\",\"mother\":\"ddd\"}', 1, NULL, 17, '2023-08-19 06:19:56', '2023-08-19 06:19:56'),
(90, 'cuE 5263', 'Nargis Sultana Boby & Gong', '01912102269', 'aaa', 'aaa', '01912102269', 'ddd', '{\"father\":\"ddd\",\"mother\":\"ddd\"}', 1, NULL, 17, '2023-08-19 06:50:06', '2023-08-19 06:50:06'),
(91, 'cuC 04745', 'Nilufar Easmin', '01833323546', 'aaa', 'aaa', '01833323546', 'ddd', '{\"father\":\"ddd\",\"mother\":\"ddd\"}', 1, NULL, 17, '2023-08-19 06:53:57', '2023-08-19 06:53:57'),
(92, 'cuC 04751', 'Minu', '01630430244', 'aaa', 'aaa', '01630430244', 'ddd', '{\"father\":\"ddd\",\"mother\":\"ddd\"}', 1, NULL, 17, '2023-08-19 07:13:21', '2023-08-19 07:13:21'),
(93, 'cuC 05297', 'Delwar Kader', '01912700579', 'aaa', 'aaa', '01912700579', 'ddd', '{\"father\":\"ddd\",\"mother\":\"ddd\"}', 1, NULL, 17, '2023-08-19 07:17:27', '2023-08-19 07:17:27'),
(94, 'cuC 05296', 'Moni Mahmud Seraj', '01912700570', 'aaa', 'aaa', '01912700570', 'ddd', '{\"father\":\"ddd\",\"mother\":\"ddd\"}', 1, NULL, 17, '2023-08-19 07:21:27', '2023-08-19 07:21:27'),
(95, 'cuC 05295', 'Syeda Shahnaz Afzal', '01912700589', 'aaa', 'aaa', '01912700589', 'ddd', '{\"father\":\"ddd\",\"mother\":\"ddd\"}', 1, NULL, 17, '2023-08-19 07:23:40', '2023-08-19 07:23:40'),
(96, 'cuC 06017', 'Laila Mostary', '01850738382', 'aaa', 'aaa', '01850738382', NULL, '{\"father\":\"ddd\",\"mother\":\"ddd\"}', 1, NULL, 17, '2023-08-19 07:42:35', '2023-08-19 07:42:35'),
(97, 'cuC 06016', 'Laila Mostary & Gong', '01850738383', 'aaa', 'aaa', '01850738383', 'ddd', '{\"father\":\"ddd\",\"mother\":\"ddd\"}', 1, NULL, 17, '2023-08-19 07:44:53', '2023-08-19 07:44:53'),
(98, 'cuxyzParvez', 'parvez', '+8801912982982', 'kk', 'kk', '55', 'sdfsf', '{\"father\":\"sdfsfs\",\"mother\":\"sdfsdf\"}', 1, NULL, 1, '2023-08-27 06:07:27', '2023-08-27 06:07:27'),
(99, 'cuC 05234', 'Md Abdus Sattar', '01711946260', 'aaa', 'aaa', '01711946260', 'ddd', '{\"father\":\"ddd\",\"mother\":\"ddd\"}', 1, NULL, 17, '2023-08-28 05:36:13', '2023-08-28 05:36:13'),
(100, 'cuE252622', 'sifat', '01760322933', 'sdf', 'sdf', 'sdf', 'sdf', '{\"father\":\"sdf\",\"mother\":\"sd\"}', 1, NULL, 1, '2023-08-28 05:48:25', '2023-08-29 13:10:05'),
(101, 'cuC 05235', 'Md Abdus Sattar', '01711946260(2)', 'aaa', 'aaa', '01711946260', 'ddd', '{\"father\":\"ddd\",\"mother\":\"ddd\"}', 1, NULL, 17, '2023-08-28 05:49:09', '2023-08-31 07:17:18'),
(102, 'cuE 5278', 'Muhammad Abdul Latif Akanda', '01924738441', 'aaa', 'aaa', '01924738441', 'ddd', '{\"father\":\"ddd\",\"mother\":\"ddd\"}', 1, NULL, 17, '2023-08-28 05:56:09', '2023-08-28 05:56:09'),
(103, 'cuC 04189', 'Muhammad Abdul Latif Akanda & Gong', '01924738441(3)', 'aaa', 'aaa', '01924738441', 'ddd', '{\"father\":\"ddd\",\"mother\":\"ddd\"}', 1, NULL, 17, '2023-08-28 06:05:01', '2023-08-31 07:16:37'),
(104, 'cuC 04354', 'Askander Khan & Sekander Ali', '01830305488', 'aaa', 'aaa', '01830305488', 'ddd', '{\"father\":\"ddd\",\"mother\":\"ddd\"}', 1, NULL, 17, '2023-08-28 06:08:16', '2023-08-28 06:08:16'),
(105, 'cuC 04502', 'Ruma Akter', '01718214919', 'aaa', 'aaa', '01718214919', 'ddd', '{\"father\":\"ddd\",\"mother\":\"ddd\"}', 1, NULL, 17, '2023-08-28 06:09:46', '2023-08-28 06:09:46'),
(106, 'cuC 04536', 'Md Jahangir Alam & Gong', '01711264093', 'aaa', 'aaaa', '01711264093', 'ddd', '{\"father\":\"ddd\",\"mother\":\"ddd\"}', 1, NULL, 17, '2023-08-28 06:22:45', '2023-08-28 06:22:45'),
(107, 'cuC 04534', 'Muhammad Jubair Islam & Sikder Muhammad Habibur Rahman', '01790552255', 'aaaa', 'aaaa', '01790552255', 'ddd', '{\"father\":\"ddd\",\"mother\":\"ddd\"}', 1, NULL, 17, '2023-08-28 06:28:36', '2023-08-28 06:28:36'),
(108, 'cuC 04537', 'Muhammad Abdul Latif Akanda & Gong', '01924738441(2)', 'aaa', 'aaa', '01924738441', 'ddd', '{\"father\":\"ddd\",\"mother\":\"ddd\"}', 1, NULL, 17, '2023-08-28 07:29:31', '2023-08-31 06:47:56'),
(109, 'cuC 04628', 'Md Sekander Ali & Gong', '01674073270', 'aaa', 'aaa', '01674073270', 'ddd', '{\"father\":\"ddd\",\"mother\":\"ddd\"}', 1, NULL, 17, '2023-08-28 08:39:57', '2023-08-28 08:39:57'),
(110, 'cuC 04630', 'Md Abdul Kader', '01718557999', 'aaa', 'aaa', '01718557999', 'ddd', '{\"father\":\"ddd\",\"mother\":\"ddd\"}', 1, NULL, 17, '2023-08-30 08:28:31', '2023-08-30 08:28:31'),
(111, 'cuC 04634', 'M. A. Daud', '01712089599', 'aaa', 'aaa', '01712089599', 'ddd', '{\"father\":\"ddd\",\"mother\":\"ddd\"}', 1, NULL, 17, '2023-08-30 08:32:55', '2023-08-30 08:32:55'),
(112, 'cuC 04632', 'S. M. Ramiz Ahmed', '01795738781', 'aaa', 'aaa', '01795738781', 'ddd', '{\"father\":\"ddd\",\"mother\":\"ddd\"}', 1, NULL, 17, '2023-08-30 08:37:10', '2023-08-30 08:37:10'),
(113, 'cuC 04655', 'Sikder Muhammad Habibur Rahman & Muhammad Jubair Islam', '01790552255(2)', 'aaa', 'aaa', '01790552255', 'ddd', '{\"father\":\"ddd\",\"mother\":\"ddd\"}', 1, NULL, 17, '2023-08-30 08:49:40', '2023-08-31 07:15:46'),
(114, 'cuC 04661', 'Mohammad Nurul Alam', '01730335089', 'aaa', 'aaa', '01730335089', 'ddd', '{\"father\":\"ddd\",\"mother\":\"ddd\"}', 1, NULL, 17, '2023-08-30 08:54:00', '2023-08-30 08:54:00'),
(115, 'cuC-04669', 'Renu Akter', '01725060740(2)', 'aaa', 'aaa', '01725060740', 'ddd', '{\"father\":\"ddd\",\"mother\":\"ddd\"}', 1, NULL, 17, '2023-08-31 07:24:31', '2023-08-31 07:26:06'),
(116, 'cuC-04667', 'Muhammad Jubair Islam', '01790552255(3)', 'aaa', 'aaa', '01790552255', 'ddd', '{\"father\":\"ddd\",\"mother\":\"ddd\"}', 1, NULL, 17, '2023-08-31 07:41:35', '2023-08-31 07:41:35'),
(117, 'cuC-04708', 'Rafia Amin & Muhammad Maidul Islam', '01759665661', 'aaa', 'aaa', '01759665661', 'ddd', '{\"father\":\"ddd\",\"mother\":\"ddd\"}', 1, NULL, 17, '2023-08-31 07:45:24', '2023-08-31 07:45:24'),
(118, 'cuC-04707', 'Nazmus Sakib', '01703827355', 'aaa', 'aaa', '01703827355', 'ddd', '{\"father\":\"ddd\",\"mother\":\"ddd\"}', 1, NULL, 17, '2023-08-31 07:58:23', '2023-08-31 07:58:23'),
(119, 'cuC-04735', 'Md Abdus Samad', '01817563003', 'aaa', 'aaa', '01817563003', 'ddd', '{\"father\":\"ddd\",\"mother\":\"ddd\"}', 1, NULL, 17, '2023-08-31 08:02:03', '2023-08-31 08:02:03'),
(120, 'cuC-04737', 'Md Samsul Alam', '01550019402', 'aaaa', 'aaaa', '01550019402', 'ddd', '{\"father\":\"ddd\",\"mother\":\"ddd\"}', 1, NULL, 17, '2023-08-31 08:23:36', '2023-08-31 08:23:36'),
(121, 'cuC-04736', 'Khairun Nahar Sapna', '01721099615', 'aaaa', 'aaaa', '01721099615', 'ddd', '{\"father\":\"ddd\",\"mother\":\"ddd\"}', 1, NULL, 17, '2023-08-31 08:29:14', '2023-08-31 08:29:14'),
(122, 'cuC-04726', 'Md Jamal Uddin & Gong', '01818588043', 'aaa', 'aaa', '01818588043', 'ddd', '{\"father\":\"ddd\",\"mother\":\"ddd\"}', 1, NULL, 17, '2023-08-31 08:32:51', '2023-08-31 08:32:51'),
(123, 'cuC-04856', 'A. H. M. Saifuddin', '01780880069', 'aaa', 'aaa', '01780880069', 'ddd', '{\"father\":\"ddd\",\"mother\":\"ddd\"}', 1, NULL, 17, '2023-08-31 08:39:43', '2023-08-31 08:39:43'),
(124, 'cuC-04879', 'Papia Akter', '01712521735', 'aaa', 'aaa', '01712521735', 'ddd', '{\"father\":\"ddd\",\"mother\":\"ddd\"}', 1, NULL, 17, '2023-08-31 08:43:00', '2023-08-31 08:43:00'),
(125, 'cuC-04915', 'A.Y.M Tamim & N.M Zubaer', '01740212006', 'aaa', 'aaa', '01740212006', 'ddd', '{\"father\":\"ddd\",\"mother\":\"ddd\"}', 1, NULL, 17, '2023-08-31 08:46:23', '2023-08-31 08:46:23'),
(126, 'cuC-04886', 'Asrar Ul Haque & Sanzida Ahmed', '01711946260(3)', 'aaa', 'aaa', '01711946260', 'ddd', '{\"father\":\"ddd\",\"mother\":\"ddd\"}', 1, NULL, 17, '2023-08-31 08:49:47', '2023-08-31 08:49:47'),
(127, 'cuC-04927', 'Kathika Rani Biswas', '01714793905', 'aaa', 'aaa', '01714793905', 'ddd', '{\"father\":\"ddd\",\"mother\":\"ddd\"}', 1, NULL, 17, '2023-08-31 08:52:07', '2023-08-31 08:52:07'),
(128, 'cuC-05241', 'Nazma Yesmin & Md Shahidul Islam', '01932998456', 'aaa', 'aaa', '01932998456', 'ddd', '{\"father\":\"ddd\",\"mother\":\"ddd\"}', 1, NULL, 17, '2023-08-31 09:01:14', '2023-08-31 09:01:14'),
(129, 'cuC-05240', 'Md Jahidul Islam', '01913059910', 'aaaa', 'aaaa', '01913059910', 'ddd', '{\"father\":\"ddd\",\"mother\":\"ddd\"}', 1, NULL, 17, '2023-08-31 09:05:30', '2023-08-31 09:05:30'),
(130, 'cuC-05237', 'Sufia Akter & Gong', '01759147122', 'aaa', 'aaa', '01759147122', 'ddd', '{\"father\":\"ddd\",\"mother\":\"ddd\"}', 1, NULL, 17, '2023-08-31 09:08:16', '2023-08-31 09:08:16'),
(132, 'cuC-05613', 'Muhammad Abdul Latif Akanda', '01924738441(4)', 'aaa', 'aaa', '01924738441', 'ddd', '{\"father\":\"ddd\",\"mother\":\"ddd\"}', 1, NULL, 17, '2023-08-31 09:12:07', '2023-08-31 09:12:07'),
(133, 'cuC-05628', 'M. A. Daud', '01712089599(2)', 'aaa', 'aaa', '01712089599', 'ddd', '{\"father\":\"ddd\",\"mother\":\"ddd\"}', 1, NULL, 17, '2023-08-31 09:16:13', '2023-08-31 09:16:13'),
(134, 'cuC-05627', 'Khairun Nahar Sapna', '01721099615(2)', 'aaa', 'aaa', '01721099615', 'ddd', '{\"father\":\"ddd\",\"mother\":\"ddd\"}', 1, NULL, 17, '2023-08-31 09:17:17', '2023-08-31 09:17:17'),
(135, 'cuC-05626', 'Md. Khairul Islam', '01716601498', 'aaa', 'aaa', '01716601498', 'ddd', '{\"father\":\"ddd\",\"mother\":\"ddd\"}', 1, NULL, 17, '2023-09-02 06:43:25', '2023-09-02 06:43:25'),
(136, 'cuC-05667', 'Md Sekander Ali', '01674073270(2)', 'aaa', 'aaa', '01674073270', 'ddd', '{\"father\":\"ddd\",\"mother\":\"ddd\"}', 1, NULL, 17, '2023-09-02 06:46:15', '2023-09-02 06:46:15'),
(137, 'cuC-05662', 'S. K. Safat Ali', '01716578816', 'aaa', 'aaa', '01716578816', 'ddd', '{\"father\":\"ddd\",\"mother\":\"ddd\"}', 1, NULL, 17, '2023-09-02 07:06:04', '2023-09-02 07:06:04'),
(138, 'cuC-05859', 'Md Fayjur Rahman & Gong', '01983251125', 'aaa', 'aaa', '01983251125', 'ddd', '{\"father\":\"ddd\",\"mother\":\"ddd\"}', 1, NULL, 17, '2023-09-02 07:09:50', '2023-09-02 07:09:50'),
(139, 'cuC-05964', 'Md Fayjur Rahman & Gong', '01983251125(2)', 'aaa', 'aaa', '01983251125', 'ddd', '{\"father\":\"ddd\",\"mother\":\"ddd\"}', 1, NULL, 17, '2023-09-02 07:16:00', '2023-09-02 07:16:00'),
(140, 'cuC-06049', 'Md Jubayer Ahamed', '01712055473', 'aaa', 'aaa', '01712055473', 'ddd', '{\"father\":\"ddd\",\"mother\":\"ddd\"}', 1, NULL, 17, '2023-09-02 07:32:26', '2023-09-02 07:32:26');

-- --------------------------------------------------------

--
-- Table structure for table `expenses`
--

CREATE TABLE `expenses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `expense_item_id` bigint(20) UNSIGNED NOT NULL,
  `document` varchar(255) DEFAULT NULL,
  `entry` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `expenses`
--

INSERT INTO `expenses` (`id`, `expense_item_id`, `document`, `entry`, `created_at`, `updated_at`) VALUES
(1, 1, NULL, 1, '2023-07-24 11:56:31', '2023-07-24 11:56:31'),
(2, 2, NULL, 1, '2023-07-24 11:57:18', '2023-07-24 11:57:18'),
(3, 3, NULL, 1, '2023-07-24 11:59:30', '2023-07-24 11:59:30'),
(4, 6, NULL, 1, '2023-07-24 12:00:10', '2023-07-24 12:00:10'),
(5, 7, NULL, 1, '2023-07-24 12:00:52', '2023-07-24 12:00:52'),
(6, 8, NULL, 1, '2023-07-24 12:01:28', '2023-07-24 12:01:28'),
(7, 1, NULL, 1, '2023-07-24 12:02:14', '2023-07-24 12:02:14'),
(8, 2, NULL, 1, '2023-07-24 12:02:41', '2023-07-24 12:02:41'),
(9, 1, NULL, 1, '2023-07-26 08:52:06', '2023-07-26 08:52:06'),
(10, 2, NULL, 1, '2023-07-26 08:53:30', '2023-07-26 08:53:30'),
(11, 3, 'expense/11.jpg', 1, '2023-07-26 08:54:19', '2023-07-26 08:54:19'),
(12, 7, NULL, 1, '2023-07-26 08:55:04', '2023-07-26 08:55:04'),
(13, 6, NULL, 1, '2023-07-26 08:55:47', '2023-07-26 08:55:47'),
(14, 4, NULL, 1, '2023-07-26 08:57:02', '2023-07-26 08:57:02'),
(15, 10, NULL, 1, '2023-07-31 02:45:11', '2023-07-31 02:45:11'),
(16, 8, NULL, 1, '2023-07-31 02:46:02', '2023-07-31 02:46:02'),
(17, 1, NULL, 1, '2023-07-31 02:46:37', '2023-07-31 02:46:37'),
(18, 1, NULL, 1, '2023-08-05 02:21:40', '2023-08-05 02:21:40'),
(19, 11, NULL, 1, '2023-08-05 02:25:40', '2023-08-05 02:25:40'),
(20, 7, NULL, 1, '2023-08-05 02:27:04', '2023-08-05 02:27:04'),
(21, 2, NULL, 1, '2023-08-05 02:27:44', '2023-08-05 02:27:44'),
(22, 2, NULL, 1, '2023-08-06 04:32:19', '2023-08-06 04:32:19'),
(23, 12, NULL, 1, '2023-08-06 04:34:20', '2023-08-06 04:34:20'),
(24, 13, NULL, 1, '2023-08-06 04:35:02', '2023-08-06 04:35:02'),
(25, 3, NULL, 1, '2023-08-06 04:36:04', '2023-08-06 04:36:04'),
(26, 6, NULL, 1, '2023-08-06 10:27:59', '2023-08-06 10:27:59'),
(27, 7, NULL, 1, '2023-08-06 10:28:25', '2023-08-06 10:28:25'),
(28, 8, NULL, 1, '2023-08-06 10:28:46', '2023-08-06 10:28:46'),
(29, 14, NULL, 1, '2023-08-06 10:29:57', '2023-08-06 10:29:57'),
(30, 2, NULL, 1, '2023-08-10 03:03:45', '2023-08-10 03:03:45'),
(31, 1, NULL, 1, '2023-08-10 03:04:19', '2023-08-10 03:04:19'),
(32, 16, NULL, 1, '2023-08-10 03:08:25', '2023-08-10 03:08:25'),
(33, 3, NULL, 1, '2023-08-10 03:09:09', '2023-08-10 03:09:09'),
(34, 4, NULL, 1, '2023-08-10 03:09:51', '2023-08-10 03:09:51'),
(35, 1, NULL, 1, '2023-08-12 03:24:12', '2023-08-12 03:24:12'),
(36, 16, NULL, 1, '2023-08-12 03:24:33', '2023-08-12 03:24:33'),
(37, 16, NULL, 1, '2023-08-14 06:43:21', '2023-08-14 06:43:21'),
(38, 2, NULL, 1, '2023-08-14 06:56:41', '2023-08-14 06:56:41'),
(39, 1, NULL, 1, '2023-08-16 03:44:17', '2023-08-16 03:44:17'),
(40, 8, NULL, 1, '2023-08-16 03:44:50', '2023-08-16 03:44:50'),
(41, 16, NULL, 1, '2023-08-16 03:45:18', '2023-08-16 03:45:18'),
(42, 16, NULL, 1, '2023-08-16 03:46:01', '2023-08-16 03:46:01'),
(43, 2, NULL, 1, '2023-08-16 03:50:11', '2023-08-16 03:50:11'),
(44, 6, NULL, 1, '2023-08-16 03:51:41', '2023-08-16 03:51:41'),
(45, 1, NULL, 1, '2023-08-17 02:39:50', '2023-08-17 02:39:50'),
(46, 2, NULL, 1, '2023-08-17 02:40:18', '2023-08-17 02:40:18'),
(47, 1, NULL, 1, '2023-08-19 02:28:42', '2023-08-19 02:28:42'),
(48, 3, NULL, 1, '2023-08-19 02:29:52', '2023-08-19 02:29:52'),
(49, 2, NULL, 1, '2023-08-19 02:30:28', '2023-08-19 02:30:28'),
(50, 1, NULL, 1, '2023-08-20 04:08:27', '2023-08-20 04:08:27'),
(51, 3, NULL, 1, '2023-08-20 04:08:49', '2023-08-20 04:08:49'),
(52, 8, NULL, 1, '2023-08-20 04:09:47', '2023-08-20 04:09:47'),
(53, 2, NULL, 1, '2023-08-20 04:12:03', '2023-08-20 04:12:03'),
(54, 1, NULL, 1, '2023-08-21 05:27:34', '2023-08-21 05:27:34'),
(55, 2, NULL, 1, '2023-08-21 05:28:18', '2023-08-21 05:28:18'),
(56, 1, NULL, 1, '2023-08-23 02:41:02', '2023-08-23 02:41:02'),
(57, 6, NULL, 1, '2023-08-23 02:43:41', '2023-08-23 02:43:41'),
(58, 1, NULL, 1, '2023-08-26 03:24:08', '2023-08-26 03:24:08'),
(59, 2, NULL, 1, '2023-08-26 03:24:26', '2023-08-26 03:24:26'),
(60, 8, NULL, 1, '2023-08-26 03:24:58', '2023-08-26 03:24:58'),
(61, 3, NULL, 1, '2023-08-27 02:31:08', '2023-08-27 02:31:08'),
(62, 3, NULL, 1, '2023-08-27 02:31:36', '2023-08-27 02:31:36'),
(63, 7, NULL, 1, '2023-08-27 02:32:07', '2023-08-27 02:32:07'),
(64, 16, NULL, 1, '2023-08-27 02:33:25', '2023-08-27 02:33:25'),
(65, 1, NULL, 1, '2023-08-28 05:14:32', '2023-08-28 05:14:32'),
(66, 3, NULL, 1, '2023-08-28 05:14:55', '2023-08-28 05:14:55'),
(67, 16, NULL, 1, '2023-08-28 05:15:20', '2023-08-28 05:15:20'),
(68, 3, NULL, 1, '2023-08-28 05:15:54', '2023-08-28 05:15:54'),
(69, 1, NULL, 1, '2023-09-30 08:54:55', '2023-09-30 08:54:55');

-- --------------------------------------------------------

--
-- Table structure for table `expense_items`
--

CREATE TABLE `expense_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `parent` bigint(20) UNSIGNED DEFAULT NULL,
  `entry` bigint(20) UNSIGNED NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0 COMMENT 'if expense have then 1 else 0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `expense_items`
--

INSERT INTO `expense_items` (`id`, `title`, `parent`, `entry`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Bazar', NULL, 1, 0, '2023-07-24 11:49:52', '2023-07-24 11:49:52'),
(2, 'Office Cost', NULL, 1, 0, '2023-07-24 11:50:36', '2023-07-24 11:50:36'),
(3, 'Mamun Vai Cost', NULL, 1, 0, '2023-07-24 11:50:50', '2023-07-24 11:50:50'),
(4, 'Loan', NULL, 1, 0, '2023-07-24 11:51:09', '2023-07-24 11:51:09'),
(5, 'Car', NULL, 1, 0, '2023-07-24 11:51:32', '2023-07-24 11:51:32'),
(6, 'Visit Car Bill', NULL, 1, 0, '2023-07-24 11:51:46', '2023-07-24 11:51:46'),
(7, 'A.Rohim', 5, 1, 0, '2023-07-24 11:52:30', '2023-07-24 11:52:30'),
(8, 'Tofayal', 5, 1, 0, '2023-07-24 11:52:39', '2023-07-24 11:52:39'),
(9, 'Ext Driver', 5, 1, 0, '2023-07-24 11:53:21', '2023-07-24 11:53:21'),
(10, 'Mannan Hossain', NULL, 1, 0, '2023-07-31 02:44:25', '2023-07-31 02:44:25'),
(11, 'Convince Bill', NULL, 1, 0, '2023-08-05 02:24:47', '2023-08-05 02:24:47'),
(12, 'Product 02 (PPL)', NULL, 1, 0, '2023-08-06 04:33:24', '2023-08-06 04:33:24'),
(13, 'PPL Invest Triple', NULL, 1, 0, '2023-08-06 04:33:50', '2023-08-06 04:33:50'),
(14, 'Shipon', 5, 1, 0, '2023-08-06 10:29:19', '2023-08-06 10:29:19'),
(16, 'Monirul', 5, 1, 0, '2023-08-10 03:07:22', '2023-08-10 03:07:22');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `investments`
--

CREATE TABLE `investments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `account_id` varchar(500) NOT NULL,
  `investor_id` bigint(20) UNSIGNED NOT NULL,
  `document` varchar(255) DEFAULT NULL,
  `rate` double NOT NULL DEFAULT 0,
  `duration` int(11) NOT NULL DEFAULT 0,
  `duration_in` varchar(255) NOT NULL,
  `entry` bigint(20) UNSIGNED NOT NULL,
  `invest_at` date NOT NULL,
  `last_interest` date DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1 COMMENT '1=activate( get commission every month), 0 = deactive (not get any commission)',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `investments`
--

INSERT INTO `investments` (`id`, `account_id`, `investor_id`, `document`, `rate`, `duration`, `duration_in`, `entry`, `invest_at`, `last_interest`, `status`, `created_at`, `updated_at`) VALUES
(1, '100001', 1, NULL, 2, 1, 'years', 1, '2023-07-24', '2023-08-01', 1, '2023-07-24 11:15:50', '2023-08-05 08:34:27'),
(2, '100002', 2, NULL, 3, 1, 'years', 1, '2023-05-01', '2023-08-01', 1, '2023-07-24 11:26:55', '2023-08-05 08:19:24'),
(3, '100003', 3, NULL, 2, 1, 'years', 1, '2023-01-01', '2023-08-01', 1, '2023-07-24 11:45:06', '2023-08-05 08:19:24');

-- --------------------------------------------------------

--
-- Table structure for table `investment_commissions`
--

CREATE TABLE `investment_commissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `investment_id` bigint(20) UNSIGNED NOT NULL,
  `amount` double NOT NULL DEFAULT 0,
  `investor_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `investment_commissions`
--

INSERT INTO `investment_commissions` (`id`, `investment_id`, `amount`, `investor_id`, `created_at`, `updated_at`) VALUES
(1, 1, 4516.1290322581, 1, '2023-08-05 08:19:24', '2023-08-05 08:19:24'),
(2, 2, 15000, 2, '2023-08-05 08:19:24', '2023-08-05 08:19:24'),
(3, 3, 1000, 3, '2023-08-05 08:19:24', '2023-08-05 08:19:24'),
(4, 1, 4516.1290322581, 1, '2023-08-05 08:34:27', '2023-08-05 08:34:27');

-- --------------------------------------------------------

--
-- Table structure for table `investment_withdraws`
--

CREATE TABLE `investment_withdraws` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `investor_id` bigint(20) UNSIGNED NOT NULL,
  `investment_id` bigint(20) UNSIGNED NOT NULL,
  `amount` double NOT NULL DEFAULT 0,
  `date` date DEFAULT NULL,
  `entry` bigint(20) UNSIGNED NOT NULL,
  `other` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `investors`
--

CREATE TABLE `investors` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `account_id` varchar(255) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `phone` varchar(255) NOT NULL,
  `present_address` text DEFAULT NULL,
  `permanent_address` text DEFAULT NULL,
  `emergency_contact` varchar(255) DEFAULT NULL,
  `occupation` varchar(255) DEFAULT NULL,
  `role` bigint(20) UNSIGNED NOT NULL,
  `parent_name` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL COMMENT 'father name, and mother name',
  `status` tinyint(4) NOT NULL DEFAULT 0,
  `image` varchar(255) DEFAULT NULL,
  `income` double NOT NULL DEFAULT 0,
  `reference_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `investors`
--

INSERT INTO `investors` (`id`, `account_id`, `name`, `phone`, `present_address`, `permanent_address`, `emergency_contact`, `occupation`, `role`, `parent_name`, `status`, `image`, `income`, `reference_id`, `created_at`, `updated_at`) VALUES
(1, '10000000001', 'Aklima Akter', '01912102268', 'Badda', 'Badda', NULL, 'Business', 6, '{\"father\":\"Mr.\",\"mother\":\"Mts.\"}', 1, NULL, 4516.1290322581, 1, '2023-07-24 11:13:38', '2023-08-05 08:34:27'),
(2, '10000000002', 'Kanij Fatema', '01717270606', 'Rampura', 'Rampura', NULL, 'Business', 6, '{\"father\":\"Mr.\",\"mother\":\"Mts.\"}', 1, NULL, 15000, 1, '2023-07-24 11:14:24', '2023-08-05 08:19:24'),
(3, '10000000003', 'Md. Kaosar Amin', '01677599477', 'Malibag', 'Noakhali', NULL, 'Accountant', 6, '{\"father\":\"Mr.\",\"mother\":\"Mts.\"}', 1, NULL, 1000, 1, '2023-07-24 11:41:21', '2023-08-05 08:19:24');

-- --------------------------------------------------------

--
-- Table structure for table `land_purchases`
--

CREATE TABLE `land_purchases` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `land` varchar(255) DEFAULT NULL,
  `giver` varchar(255) DEFAULT NULL,
  `taker` varchar(255) DEFAULT NULL,
  `mouza` varchar(255) DEFAULT NULL,
  `rs` varchar(255) DEFAULT NULL,
  `sa` varchar(255) DEFAULT NULL,
  `amount` double DEFAULT NULL,
  `entry` bigint(20) UNSIGNED NOT NULL,
  `document` varchar(500) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2014_10_12_100000_create_password_resets_table', 1),
(4, '2019_08_19_000000_create_failed_jobs_table', 1),
(5, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(6, '2023_02_19_145236_create_permission_tables', 1),
(7, '2023_02_20_045238_create_user_details_table', 1),
(8, '2023_02_21_131406_create_customers_table', 1),
(9, '2023_02_22_053308_create_sales_table', 1),
(10, '2023_02_22_053503_create_payments_table', 1),
(11, '2023_02_22_054523_create_commissions_table', 1),
(12, '2023_02_28_131803_create_settings_table', 1),
(13, '2023_04_16_210614_create_backup_sales_table', 1),
(14, '2023_04_16_210636_create_backup_payments_table', 1),
(15, '2023_05_07_091056_create_investors_table', 1),
(16, '2023_05_09_234947_create_investments_table', 1),
(17, '2023_05_10_194759_create_backup_investments_table', 1),
(18, '2023_05_11_191222_create_land_purchases_table', 1),
(19, '2023_05_14_111230_create_expense_items_table', 1),
(20, '2023_05_14_154846_create_backup_expense_items_table', 1),
(21, '2023_05_15_111109_create_expenses_table', 1),
(22, '2023_05_15_221004_create_backup_expenses_table', 1),
(23, '2023_05_24_100808_create_bank_names_table', 1),
(24, '2023_05_25_235033_create_bank_infos_table', 1),
(25, '2023_05_26_105227_create_backup_bank_infos_table', 1),
(26, '2023_05_26_181320_create_transactions_table', 1),
(27, '2023_05_26_210626_create_backup_transactions_table', 1),
(28, '2023_05_27_053835_create_bank_transactions_table', 1),
(29, '2023_05_27_083912_create_backup_bank_transactions_table', 1),
(30, '2023_06_09_113455_create_other_deposits_table', 1),
(31, '2023_06_09_113516_create_backup_other_deposits_table', 1),
(32, '2023_06_15_131154_create_salary_types_table', 1),
(33, '2023_06_22_005306_create_attendances_table', 1),
(34, '2023_07_08_100010_create_investment_commissions_table', 1),
(35, '2023_07_08_151038_create_salaries_table', 1),
(36, '2023_07_09_123101_create_backup_salaries_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\Models\\User', 1),
(2, 'App\\Models\\User', 5),
(2, 'App\\Models\\User', 7),
(3, 'App\\Models\\User', 2),
(3, 'App\\Models\\User', 3),
(3, 'App\\Models\\User', 4),
(3, 'App\\Models\\User', 6),
(3, 'App\\Models\\User', 8),
(3, 'App\\Models\\User', 9),
(3, 'App\\Models\\User', 10),
(3, 'App\\Models\\User', 11),
(3, 'App\\Models\\User', 12);

-- --------------------------------------------------------

--
-- Table structure for table `other_deposits`
--

CREATE TABLE `other_deposits` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `account_id` varchar(500) NOT NULL,
  `other` text DEFAULT NULL,
  `document` varchar(255) DEFAULT NULL,
  `entry` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `other_deposits`
--

INSERT INTO `other_deposits` (`id`, `account_id`, `other`, `document`, `entry`, `created_at`, `updated_at`) VALUES
(1, '100001', 'Tofayal Return from 29.07.23', NULL, 1, '2023-07-31 02:48:05', '2023-07-31 02:48:05'),
(2, '100002', 'Mominul Islam Product-02 Purpose', NULL, 1, '2023-08-06 04:38:28', '2023-08-06 04:38:28'),
(3, '100003', 'Monirul Return  from 10.08.23', NULL, 1, '2023-08-12 03:25:24', '2023-08-12 03:25:24'),
(4, '100004', 'Tofayal Return From 14.08.23', NULL, 1, '2023-08-16 03:47:39', '2023-08-16 03:47:39');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `sale_id` bigint(20) UNSIGNED NOT NULL,
  `commission` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `commission_type` varchar(255) NOT NULL,
  `percentage` double NOT NULL DEFAULT 0,
  `entry` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'sale-list', 'web', '2023-07-22 18:03:14', '2023-07-22 18:03:14'),
(2, 'new-sale', 'web', '2023-07-22 18:03:14', '2023-07-22 18:03:14'),
(3, 'sale-view', 'web', '2023-07-22 18:03:14', '2023-07-22 18:03:14'),
(4, 'sale-edit', 'web', '2023-07-22 18:03:14', '2023-07-22 18:03:14'),
(5, 'accountant-list', 'web', '2023-07-22 18:03:14', '2023-07-22 18:03:14'),
(6, 'accountant-edit', 'web', '2023-07-22 18:03:14', '2023-07-22 18:03:14'),
(7, 'accountant-view', 'web', '2023-07-22 18:03:14', '2023-07-22 18:03:14'),
(8, 'shareholder-list', 'web', '2023-07-22 18:03:14', '2023-07-22 18:03:14'),
(9, 'shareholder-edit', 'web', '2023-07-22 18:03:14', '2023-07-22 18:03:14'),
(10, 'shareholder-view', 'web', '2023-07-22 18:03:14', '2023-07-22 18:03:14'),
(11, 'agent-list', 'web', '2023-07-22 18:03:14', '2023-07-22 18:03:14'),
(12, 'agent-view', 'web', '2023-07-22 18:03:14', '2023-07-22 18:03:14'),
(13, 'new-agent', 'web', '2023-07-22 18:03:14', '2023-07-22 18:03:14'),
(14, 'agent-edit', 'web', '2023-07-22 18:03:14', '2023-07-22 18:03:14'),
(15, 'customer-list', 'web', '2023-07-22 18:03:14', '2023-07-22 18:03:14'),
(16, 'customer-view', 'web', '2023-07-22 18:03:14', '2023-07-22 18:03:14'),
(17, 'new-customer', 'web', '2023-07-22 18:03:14', '2023-07-22 18:03:14'),
(18, 'customer-edit', 'web', '2023-07-22 18:03:14', '2023-07-22 18:03:14'),
(19, 'payment-list', 'web', '2023-07-22 18:03:14', '2023-07-22 18:03:14'),
(20, 'new-payment', 'web', '2023-07-22 18:03:14', '2023-07-22 18:03:14'),
(21, 'old-payment-list', 'web', '2023-07-22 18:03:14', '2023-07-22 18:03:14'),
(22, 'old-payment-edit', 'web', '2023-07-22 18:03:14', '2023-07-22 18:03:14'),
(23, 'withdraw-list', 'web', '2023-07-22 18:03:14', '2023-07-22 18:03:14'),
(24, 'new-withdraw', 'web', '2023-07-22 18:03:14', '2023-07-22 18:03:14'),
(25, 'withdraw-edit', 'web', '2023-07-22 18:03:14', '2023-07-22 18:03:14'),
(26, 'report-list', 'web', '2023-07-22 18:03:14', '2023-07-22 18:03:14'),
(27, 'report-customers', 'web', '2023-07-22 18:03:14', '2023-07-22 18:03:14'),
(28, 'report-agents', 'web', '2023-07-22 18:03:14', '2023-07-22 18:03:14'),
(29, 'report-sale-txotal', 'web', '2023-07-22 18:03:14', '2023-07-22 18:03:14'),
(30, 'report-sale-individual', 'web', '2023-07-22 18:03:14', '2023-07-22 18:03:14'),
(31, 'report-deposit', 'web', '2023-07-22 18:03:14', '2023-07-22 18:03:14'),
(32, 'report-withdraw', 'web', '2023-07-22 18:03:14', '2023-07-22 18:03:14'),
(33, 'report-transaction', 'web', '2023-07-22 18:03:14', '2023-07-22 18:03:14'),
(34, 'commission-list', 'web', '2023-07-22 18:03:14', '2023-07-22 18:03:14'),
(35, 'commission-view', 'web', '2023-07-22 18:03:14', '2023-07-22 18:03:14'),
(36, 'commission-edit', 'web', '2023-07-22 18:03:14', '2023-07-22 18:03:14'),
(37, 'role-list', 'web', '2023-07-22 18:03:14', '2023-07-22 18:03:14'),
(38, 'permission-edit', 'web', '2023-07-22 18:03:14', '2023-07-22 18:03:14'),
(39, 'investor-list', 'web', '2023-07-22 18:03:14', '2023-07-22 18:03:14'),
(40, 'new-investor', 'web', '2023-07-22 18:03:14', '2023-07-22 18:03:14'),
(41, 'investor-edit', 'web', '2023-07-22 18:03:14', '2023-07-22 18:03:14'),
(42, 'investor-view', 'web', '2023-07-22 18:03:14', '2023-07-22 18:03:14'),
(43, 'land-purchase-list', 'web', '2023-07-22 18:03:14', '2023-07-22 18:03:14'),
(44, 'new-land-purchase', 'web', '2023-07-22 18:03:14', '2023-07-22 18:03:14'),
(45, 'land-purchase-edit', 'web', '2023-07-22 18:03:14', '2023-07-22 18:03:14'),
(46, 'land-purchase-view', 'web', '2023-07-22 18:03:14', '2023-07-22 18:03:14'),
(47, 'investment-list', 'web', '2023-07-22 18:03:14', '2023-07-22 18:03:14'),
(48, 'new-investment', 'web', '2023-07-22 18:03:14', '2023-07-22 18:03:14'),
(49, 'investment-edit', 'web', '2023-07-22 18:03:14', '2023-07-22 18:03:14'),
(50, 'investment-view', 'web', '2023-07-22 18:03:14', '2023-07-22 18:03:14'),
(51, 'expense-type-list', 'web', '2023-07-22 18:03:14', '2023-07-22 18:03:14'),
(52, 'new-expense-type', 'web', '2023-07-22 18:03:14', '2023-07-22 18:03:14'),
(53, 'expense-type-edit', 'web', '2023-07-22 18:03:14', '2023-07-22 18:03:14'),
(54, 'expense-type-view', 'web', '2023-07-22 18:03:14', '2023-07-22 18:03:14'),
(55, 'expense-type-delete', 'web', '2023-07-22 18:03:14', '2023-07-22 18:03:14'),
(56, 'expense-list', 'web', '2023-07-22 18:03:14', '2023-07-22 18:03:14'),
(57, 'new-expense', 'web', '2023-07-22 18:03:14', '2023-07-22 18:03:14'),
(58, 'expense-edit', 'web', '2023-07-22 18:03:14', '2023-07-22 18:03:14'),
(59, 'expense-view', 'web', '2023-07-22 18:03:14', '2023-07-22 18:03:14'),
(60, 'salary-type-list', 'web', '2023-07-22 18:03:14', '2023-07-22 18:03:14'),
(61, 'new-salary-type', 'web', '2023-07-22 18:03:14', '2023-07-22 18:03:14'),
(62, 'salary-type-edit', 'web', '2023-07-22 18:03:14', '2023-07-22 18:03:14'),
(63, 'salary-type-delete', 'web', '2023-07-22 18:03:14', '2023-07-22 18:03:14'),
(64, 'salary-list', 'web', '2023-07-22 18:03:14', '2023-07-22 18:03:14'),
(65, 'new-salary', 'web', '2023-07-22 18:03:14', '2023-07-22 18:03:14'),
(66, 'salary-edit', 'web', '2023-07-22 18:03:14', '2023-07-22 18:03:14'),
(67, 'salary-view', 'web', '2023-07-22 18:03:14', '2023-07-22 18:03:14'),
(68, 'bank-name-list', 'web', '2023-07-22 18:03:14', '2023-07-22 18:03:14'),
(69, 'new-bank-name', 'web', '2023-07-22 18:03:14', '2023-07-22 18:03:14'),
(70, 'bank-name-edit', 'web', '2023-07-22 18:03:14', '2023-07-22 18:03:14'),
(71, 'bank-name-view', 'web', '2023-07-22 18:03:14', '2023-07-22 18:03:14'),
(72, 'bank-info-list', 'web', '2023-07-22 18:03:14', '2023-07-22 18:03:14'),
(73, 'new-bank-info', 'web', '2023-07-22 18:03:14', '2023-07-22 18:03:14'),
(74, 'bank-info-edit', 'web', '2023-07-22 18:03:14', '2023-07-22 18:03:14'),
(75, 'bank-info-view', 'web', '2023-07-22 18:03:14', '2023-07-22 18:03:14'),
(76, 'other-deposit-list', 'web', '2023-07-22 18:03:14', '2023-07-22 18:03:14'),
(77, 'new-other-deposit', 'web', '2023-07-22 18:03:14', '2023-07-22 18:03:14'),
(78, 'other-deposit-edit', 'web', '2023-07-22 18:03:14', '2023-07-22 18:03:14'),
(79, 'other-deposit-view', 'web', '2023-07-22 18:03:14', '2023-07-22 18:03:14'),
(80, 'stuff-list', 'web', '2023-07-22 18:03:14', '2023-07-22 18:03:14'),
(81, 'new-stuff', 'web', '2023-07-22 18:03:14', '2023-07-22 18:03:14'),
(82, 'stuff-edit', 'web', '2023-07-22 18:03:14', '2023-07-22 18:03:14'),
(83, 'stuff-view', 'web', '2023-07-22 18:03:14', '2023-07-22 18:03:14');

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'Managing Director', 'web', '2023-07-22 18:03:14', '2023-07-22 18:03:14'),
(2, 'Accountant', 'web', '2023-07-22 18:03:14', '2023-07-22 18:03:14'),
(3, 'Master Agent', 'web', '2023-07-22 18:03:14', '2023-07-22 18:03:14'),
(4, 'Agent', 'web', '2023-07-22 18:03:14', '2023-07-22 18:03:14'),
(5, 'Customer', 'web', '2023-07-22 18:03:14', '2023-07-22 18:03:14'),
(6, 'Investor', 'web', '2023-07-22 18:03:14', '2023-07-22 18:03:14'),
(7, 'Stuff', 'web', '2023-07-22 18:03:14', '2023-07-22 18:03:14');

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_has_permissions`
--

INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
(1, 1),
(1, 2),
(2, 1),
(2, 2),
(3, 1),
(3, 2),
(4, 1),
(4, 2),
(5, 1),
(5, 2),
(6, 1),
(6, 2),
(7, 1),
(7, 2),
(8, 1),
(8, 2),
(9, 1),
(9, 2),
(10, 1),
(10, 2),
(11, 1),
(11, 2),
(12, 1),
(12, 2),
(13, 1),
(13, 2),
(14, 1),
(14, 2),
(15, 1),
(15, 2),
(16, 1),
(16, 2),
(17, 1),
(17, 2),
(18, 1),
(18, 2),
(19, 1),
(19, 2),
(20, 1),
(20, 2),
(21, 1),
(21, 2),
(22, 1),
(22, 2),
(23, 1),
(23, 2),
(24, 1),
(24, 2),
(25, 1),
(25, 2),
(26, 1),
(26, 2),
(27, 1),
(27, 2),
(28, 1),
(28, 2),
(29, 1),
(29, 2),
(30, 1),
(30, 2),
(31, 1),
(31, 2),
(32, 1),
(32, 2),
(33, 1),
(33, 2),
(34, 1),
(34, 2),
(35, 1),
(35, 2),
(36, 1),
(36, 2),
(37, 1),
(37, 2),
(38, 1),
(38, 2),
(39, 1),
(39, 2),
(40, 1),
(40, 2),
(41, 1),
(41, 2),
(42, 1),
(42, 2),
(43, 1),
(43, 2),
(44, 1),
(44, 2),
(45, 1),
(45, 2),
(46, 1),
(46, 2),
(47, 1),
(47, 2),
(48, 1),
(48, 2),
(49, 1),
(49, 2),
(50, 1),
(50, 2),
(51, 1),
(51, 2),
(52, 1),
(52, 2),
(53, 1),
(53, 2),
(54, 1),
(54, 2),
(55, 1),
(55, 2),
(56, 1),
(56, 2),
(57, 1),
(57, 2),
(58, 1),
(58, 2),
(59, 1),
(59, 2),
(60, 1),
(60, 2),
(61, 1),
(61, 2),
(62, 1),
(62, 2),
(63, 1),
(63, 2),
(64, 1),
(64, 2),
(65, 1),
(65, 2),
(66, 1),
(66, 2),
(67, 1),
(67, 2),
(68, 1),
(68, 2),
(69, 1),
(69, 2),
(70, 1),
(70, 2),
(71, 1),
(71, 2),
(72, 1),
(72, 2),
(73, 1),
(73, 2),
(74, 1),
(74, 2),
(75, 1),
(75, 2),
(76, 1),
(76, 2),
(77, 1),
(77, 2),
(78, 1),
(78, 2),
(79, 1),
(79, 2),
(80, 1),
(80, 2),
(81, 1),
(81, 2),
(82, 1),
(82, 2),
(83, 1),
(83, 2);

-- --------------------------------------------------------

--
-- Table structure for table `salaries`
--

CREATE TABLE `salaries` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_detail_id` bigint(20) UNSIGNED NOT NULL,
  `group_id` bigint(20) UNSIGNED DEFAULT NULL,
  `type_id` bigint(20) UNSIGNED DEFAULT NULL,
  `other` text DEFAULT NULL,
  `monthly` varchar(255) DEFAULT NULL,
  `entry` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `salary_types`
--

CREATE TABLE `salary_types` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `entry` bigint(20) UNSIGNED NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `salary_types`
--

INSERT INTO `salary_types` (`id`, `title`, `entry`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Advance Salary', 1, 1, '2023-07-24 10:54:43', '2023-07-24 10:54:43'),
(2, 'Bonus', 1, 1, '2023-07-24 10:55:02', '2023-07-24 10:55:02');

-- --------------------------------------------------------

--
-- Table structure for table `sales`
--

CREATE TABLE `sales` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(500) NOT NULL,
  `customer_id` bigint(20) UNSIGNED NOT NULL,
  `agent_id` bigint(20) UNSIGNED DEFAULT NULL,
  `shareholder_id` bigint(20) UNSIGNED NOT NULL,
  `price` double NOT NULL DEFAULT 0,
  `sector` varchar(255) NOT NULL,
  `block` varchar(255) NOT NULL,
  `road` varchar(255) NOT NULL,
  `plot` varchar(255) NOT NULL,
  `kata` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL COMMENT 'cash, emi',
  `commission` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL COMMENT 'commission data will be comes from commission table data take which agent get how much commission',
  `date` date NOT NULL,
  `entry` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sales`
--

INSERT INTO `sales` (`id`, `uuid`, `customer_id`, `agent_id`, `shareholder_id`, `price`, `sector`, `block`, `road`, `plot`, `kata`, `type`, `commission`, `date`, `entry`, `created_at`, `updated_at`) VALUES
(1, 'e2a6a1ace352668000aed191a817d143', 4, 28, 23, 750000, '1', 'C', '100w/01', '61', '10', 'emi', '{\"installment\":[{\"hand\":\"hand_1\",\"percentage\":14,\"agent_id\":\"28\"},{\"hand\":\"shareholder\",\"percentage\":17.25,\"shareholder_id\":\"23\"}],\"down_payment\":[{\"hand\":\"hand_1\",\"percentage\":14,\"agent_id\":\"28\"},{\"hand\":\"shareholder\",\"percentage\":16,\"shareholder_id\":\"23\"}],\"booking_money\":[{\"hand\":\"hand_1\",\"percentage\":16.5,\"agent_id\":\"28\"},{\"hand\":\"shareholder\",\"percentage\":24,\"shareholder_id\":\"23\"}]}', '2022-04-17', 1, '2023-08-29 15:43:19', '2023-08-29 15:43:19'),
(2, 'c81e728d9d4c2f636f067f89cc14862c', 5, 28, 23, 600000, '1', 'D', '29', '12', '5', 'emi', '{\"installment\":[{\"hand\":\"hand_1\",\"percentage\":14,\"agent_id\":\"28\"},{\"hand\":\"shareholder\",\"percentage\":13.5,\"shareholder_id\":\"23\"}],\"down_payment\":[{\"hand\":\"hand_1\",\"percentage\":14,\"agent_id\":\"28\"},{\"hand\":\"shareholder\",\"percentage\":16,\"shareholder_id\":\"23\"}],\"booking_money\":[{\"hand\":\"hand_1\",\"percentage\":16.5,\"agent_id\":\"28\"},{\"hand\":\"shareholder\",\"percentage\":24,\"shareholder_id\":\"23\"}]}', '2022-04-13', 1, '2023-08-29 15:46:40', '2023-08-29 15:46:40'),
(3, 'eccbc87e4b5ce2fe28308fd9f2a7baf3', 6, 28, 23, 600000, '1', 'C', '14', '46', '5', 'emi', '{\"installment\":[{\"hand\":\"hand_1\",\"percentage\":14,\"agent_id\":\"28\"},{\"hand\":\"shareholder\",\"percentage\":13.5,\"shareholder_id\":\"23\"}],\"down_payment\":[{\"hand\":\"hand_1\",\"percentage\":14,\"agent_id\":\"28\"},{\"hand\":\"shareholder\",\"percentage\":16,\"shareholder_id\":\"23\"}],\"booking_money\":[{\"hand\":\"hand_1\",\"percentage\":16.5,\"agent_id\":\"28\"},{\"hand\":\"shareholder\",\"percentage\":24,\"shareholder_id\":\"23\"}]}', '2022-04-21', 1, '2023-08-29 15:52:09', '2023-08-29 15:52:09'),
(4, 'a87ff679a2f3e71d9181a67b7542122c', 7, 28, 23, 600000, '1', 'C', '14', '44', '5', 'emi', '{\"installment\":[{\"hand\":\"hand_1\",\"percentage\":14,\"agent_id\":\"28\"},{\"hand\":\"shareholder\",\"percentage\":13.5,\"shareholder_id\":\"23\"}],\"down_payment\":[{\"hand\":\"hand_1\",\"percentage\":14,\"agent_id\":\"28\"},{\"hand\":\"shareholder\",\"percentage\":16,\"shareholder_id\":\"23\"}],\"booking_money\":[{\"hand\":\"hand_1\",\"percentage\":16.5,\"agent_id\":\"28\"},{\"hand\":\"shareholder\",\"percentage\":24,\"shareholder_id\":\"23\"}]}', '2022-04-21', 1, '2023-08-29 15:53:38', '2023-08-29 15:53:38'),
(5, 'e4da3b7fbbce2345d7772b0674a318d5', 8, 28, 23, 600000, '1', 'C', '14', '42', '5', 'emi', '{\"installment\":[{\"hand\":\"hand_1\",\"percentage\":14,\"agent_id\":\"28\"},{\"hand\":\"shareholder\",\"percentage\":13.5,\"shareholder_id\":\"23\"}],\"down_payment\":[{\"hand\":\"hand_1\",\"percentage\":14,\"agent_id\":\"28\"},{\"hand\":\"shareholder\",\"percentage\":16,\"shareholder_id\":\"23\"}],\"booking_money\":[{\"hand\":\"hand_1\",\"percentage\":16.5,\"agent_id\":\"28\"},{\"hand\":\"shareholder\",\"percentage\":24,\"shareholder_id\":\"23\"}]}', '2022-04-21', 1, '2023-08-29 15:54:49', '2023-08-29 15:54:49'),
(6, '1679091c5a880faf6fb5e6087eb1b2dc', 9, 28, 23, 600000, '1', 'C', '14', '40', '5', 'emi', '{\"installment\":[{\"hand\":\"hand_1\",\"percentage\":14,\"agent_id\":\"28\"},{\"hand\":\"shareholder\",\"percentage\":13.5,\"shareholder_id\":\"23\"}],\"down_payment\":[{\"hand\":\"hand_1\",\"percentage\":14,\"agent_id\":\"28\"},{\"hand\":\"shareholder\",\"percentage\":16,\"shareholder_id\":\"23\"}],\"booking_money\":[{\"hand\":\"hand_1\",\"percentage\":16.5,\"agent_id\":\"28\"},{\"hand\":\"shareholder\",\"percentage\":24,\"shareholder_id\":\"23\"}]}', '2022-04-21', 1, '2023-08-29 15:56:02', '2023-08-29 15:56:02'),
(7, '8f14e45fceea167a5a36dedd4bea2543', 10, 28, 23, 750000, '1', 'C', '100w/01', '59', '10', 'emi', '{\"installment\":[{\"hand\":\"hand_1\",\"percentage\":14,\"agent_id\":\"28\"},{\"hand\":\"shareholder\",\"percentage\":13.5,\"shareholder_id\":\"23\"}],\"down_payment\":[{\"hand\":\"hand_1\",\"percentage\":14,\"agent_id\":\"28\"},{\"hand\":\"shareholder\",\"percentage\":16,\"shareholder_id\":\"23\"}],\"booking_money\":[{\"hand\":\"hand_1\",\"percentage\":16.5,\"agent_id\":\"28\"},{\"hand\":\"shareholder\",\"percentage\":24,\"shareholder_id\":\"23\"}]}', '2022-05-22', 1, '2023-08-29 15:59:04', '2023-08-29 15:59:04'),
(8, 'c9f0f895fb98ab9159f51fd0297e236d', 11, 28, 23, 600000, '1', 'C', '16', '48', '5', 'emi', '{\"installment\":[{\"hand\":\"hand_1\",\"percentage\":14,\"agent_id\":\"28\"},{\"hand\":\"shareholder\",\"percentage\":13.5,\"shareholder_id\":\"23\"}],\"down_payment\":[{\"hand\":\"hand_1\",\"percentage\":14,\"agent_id\":\"28\"},{\"hand\":\"shareholder\",\"percentage\":16,\"shareholder_id\":\"23\"}],\"booking_money\":[{\"hand\":\"hand_1\",\"percentage\":16.5,\"agent_id\":\"28\"},{\"hand\":\"shareholder\",\"percentage\":24,\"shareholder_id\":\"23\"}]}', '2022-05-31', 1, '2023-08-29 16:00:34', '2023-08-29 16:00:34'),
(9, '45c48cce2e2d7fbdea1afc51c7c6ad26', 26, 28, 23, 800000, '1', 'C', '100w/01', '67', '10', 'emi', '{\"installment\":[{\"hand\":\"hand_1\",\"percentage\":14,\"agent_id\":\"28\"},{\"hand\":\"shareholder\",\"percentage\":13.5,\"shareholder_id\":\"23\"}],\"down_payment\":[{\"hand\":\"hand_1\",\"percentage\":14,\"agent_id\":\"28\"},{\"hand\":\"shareholder\",\"percentage\":16,\"shareholder_id\":\"23\"}],\"booking_money\":[{\"hand\":\"hand_1\",\"percentage\":16.5,\"agent_id\":\"28\"},{\"hand\":\"shareholder\",\"percentage\":24,\"shareholder_id\":\"23\"}]}', '2022-05-31', 1, '2023-08-29 16:01:39', '2023-08-29 16:01:39'),
(10, 'd3d9446802a44259755d38e6d163e820', 47, 28, 23, 800000, '1', 'C', '100w/01', '69', '10', 'emi', '{\"installment\":[{\"hand\":\"hand_1\",\"percentage\":14,\"agent_id\":\"28\"},{\"hand\":\"shareholder\",\"percentage\":13.5,\"shareholder_id\":\"23\"}],\"down_payment\":[{\"hand\":\"hand_1\",\"percentage\":14,\"agent_id\":\"28\"},{\"hand\":\"shareholder\",\"percentage\":16,\"shareholder_id\":\"23\"}],\"booking_money\":[{\"hand\":\"hand_1\",\"percentage\":16.5,\"agent_id\":\"28\"},{\"hand\":\"shareholder\",\"percentage\":24,\"shareholder_id\":\"23\"}]}', '2022-05-31', 1, '2023-08-29 16:03:34', '2023-08-29 16:03:34'),
(11, '6512bd43d9caa6e02c990b0a82652dca', 50, 28, 23, 600000, '1', 'C', '15', '26', '5', 'emi', '{\"installment\":[{\"hand\":\"hand_1\",\"percentage\":14,\"agent_id\":\"28\"},{\"hand\":\"shareholder\",\"percentage\":13.5,\"shareholder_id\":\"23\"}],\"down_payment\":[{\"hand\":\"hand_1\",\"percentage\":14,\"agent_id\":\"28\"},{\"hand\":\"shareholder\",\"percentage\":16,\"shareholder_id\":\"23\"}],\"booking_money\":[{\"hand\":\"hand_1\",\"percentage\":16.5,\"agent_id\":\"28\"},{\"hand\":\"shareholder\",\"percentage\":24,\"shareholder_id\":\"23\"}]}', '2022-06-13', 1, '2023-08-29 16:04:57', '2023-08-29 16:04:57'),
(12, 'c20ad4d76fe97759aa27a0c99bff6710', 51, 28, 23, 600000, '1', 'C', '15', '24', '5', 'emi', '{\"installment\":[{\"hand\":\"hand_1\",\"percentage\":14,\"agent_id\":\"28\"},{\"hand\":\"shareholder\",\"percentage\":13.5,\"shareholder_id\":\"23\"}],\"down_payment\":[{\"hand\":\"hand_1\",\"percentage\":14,\"agent_id\":\"28\"},{\"hand\":\"shareholder\",\"percentage\":16,\"shareholder_id\":\"23\"}],\"booking_money\":[{\"hand\":\"hand_1\",\"percentage\":16.5,\"agent_id\":\"28\"},{\"hand\":\"shareholder\",\"percentage\":24,\"shareholder_id\":\"23\"}]}', '2022-06-13', 1, '2023-08-29 16:06:25', '2023-08-29 16:06:25'),
(13, 'c51ce410c124a10e0db5e4b97fc2af39', 52, 28, 23, 850000, '1', 'E', '100w/01', '72', '10', 'emi', '{\"installment\":[{\"hand\":\"hand_1\",\"percentage\":14,\"agent_id\":\"28\"},{\"hand\":\"shareholder\",\"percentage\":13.5,\"shareholder_id\":\"23\"}],\"down_payment\":[{\"hand\":\"hand_1\",\"percentage\":14,\"agent_id\":\"28\"},{\"hand\":\"shareholder\",\"percentage\":16,\"shareholder_id\":\"23\"}],\"booking_money\":[{\"hand\":\"hand_1\",\"percentage\":16.5,\"agent_id\":\"28\"},{\"hand\":\"shareholder\",\"percentage\":24,\"shareholder_id\":\"23\"}]}', '2022-06-15', 1, '2023-08-29 16:07:47', '2023-08-29 16:07:47'),
(14, 'aab3238922bcc25a6f606eb525ffdc56', 53, 28, 23, 600000, '1', 'C', '15', '28', '5', 'emi', '{\"installment\":[{\"hand\":\"hand_1\",\"percentage\":14,\"agent_id\":\"28\"},{\"hand\":\"shareholder\",\"percentage\":13.5,\"shareholder_id\":\"23\"}],\"down_payment\":[{\"hand\":\"hand_1\",\"percentage\":14,\"agent_id\":\"28\"},{\"hand\":\"shareholder\",\"percentage\":16,\"shareholder_id\":\"23\"}],\"booking_money\":[{\"hand\":\"hand_1\",\"percentage\":16.5,\"agent_id\":\"28\"},{\"hand\":\"shareholder\",\"percentage\":24,\"shareholder_id\":\"23\"}]}', '2022-06-15', 1, '2023-08-29 16:10:56', '2023-08-29 16:10:56'),
(15, '9bf31c7ff062936a96d3c8bd1f8f2ff3', 56, 28, 23, 600000, '1', 'B', '9', '4', '10', 'emi', '{\"installment\":[{\"hand\":\"hand_1\",\"percentage\":20,\"agent_id\":\"28\"},{\"hand\":\"shareholder\",\"percentage\":10,\"shareholder_id\":\"23\"}],\"down_payment\":[{\"hand\":\"hand_1\",\"percentage\":14,\"agent_id\":\"28\"},{\"hand\":\"shareholder\",\"percentage\":16,\"shareholder_id\":\"23\"}],\"booking_money\":[{\"hand\":\"hand_1\",\"percentage\":16.5,\"agent_id\":\"28\"},{\"hand\":\"shareholder\",\"percentage\":24,\"shareholder_id\":\"23\"}]}', '2022-06-19', 1, '2023-08-29 16:13:26', '2023-08-29 16:13:26'),
(16, 'c74d97b01eae257e44aa9d5bade97baf', 57, 28, 23, 800000, '1', 'E', '100w/01', '52', '10', 'emi', '{\"installment\":[{\"hand\":\"hand_1\",\"percentage\":20,\"agent_id\":\"28\"},{\"hand\":\"shareholder\",\"percentage\":10,\"shareholder_id\":\"23\"}],\"down_payment\":[{\"hand\":\"hand_1\",\"percentage\":14,\"agent_id\":\"28\"},{\"hand\":\"shareholder\",\"percentage\":16,\"shareholder_id\":\"23\"}],\"booking_money\":[{\"hand\":\"hand_1\",\"percentage\":16,\"agent_id\":\"28\"},{\"hand\":\"shareholder\",\"percentage\":24.5,\"shareholder_id\":\"23\"}]}', '2022-06-23', 1, '2023-08-29 16:15:05', '2023-08-29 16:15:05'),
(17, '70efdf2ec9b086079795c442636b55fb', 58, 28, 23, 600000, '1', 'E', '31', '18', '5', 'emi', '{\"installment\":[{\"hand\":\"hand_1\",\"percentage\":20,\"agent_id\":\"28\"},{\"hand\":\"shareholder\",\"percentage\":10,\"shareholder_id\":\"23\"}],\"down_payment\":[{\"hand\":\"hand_1\",\"percentage\":14,\"agent_id\":\"28\"},{\"hand\":\"shareholder\",\"percentage\":16,\"shareholder_id\":\"23\"}],\"booking_money\":[{\"hand\":\"hand_1\",\"percentage\":16,\"agent_id\":\"28\"},{\"hand\":\"shareholder\",\"percentage\":24.5,\"shareholder_id\":\"23\"}]}', '2022-06-30', 1, '2023-08-29 16:16:29', '2023-08-29 16:16:29'),
(18, '6f4922f45568161a8cdf4ad2299f6d23', 59, 28, 23, 750000, '1', 'E', '100w/01', '54', '10', 'emi', '{\"installment\":[{\"hand\":\"hand_1\",\"percentage\":20,\"agent_id\":\"28\"},{\"hand\":\"shareholder\",\"percentage\":10,\"shareholder_id\":\"23\"}],\"down_payment\":[{\"hand\":\"hand_1\",\"percentage\":14,\"agent_id\":\"28\"},{\"hand\":\"shareholder\",\"percentage\":16,\"shareholder_id\":\"23\"}],\"booking_money\":[{\"hand\":\"hand_1\",\"percentage\":16,\"agent_id\":\"28\"},{\"hand\":\"shareholder\",\"percentage\":24.5,\"shareholder_id\":\"23\"}]}', '2022-06-28', 1, '2023-08-29 16:17:57', '2023-08-29 16:17:57'),
(19, '1f0e3dad99908345f7439f8ffabdffc4', 60, 28, 23, 600000, '1', 'E', '31', '16', '5', 'emi', '{\"installment\":[{\"hand\":\"hand_1\",\"percentage\":20,\"agent_id\":\"28\"},{\"hand\":\"shareholder\",\"percentage\":10,\"shareholder_id\":\"23\"}],\"down_payment\":[{\"hand\":\"hand_1\",\"percentage\":14,\"agent_id\":\"28\"},{\"hand\":\"shareholder\",\"percentage\":16,\"shareholder_id\":\"23\"}],\"booking_money\":[{\"hand\":\"hand_1\",\"percentage\":16,\"agent_id\":\"28\"},{\"hand\":\"shareholder\",\"percentage\":24.5,\"shareholder_id\":\"23\"}]}', '2022-06-30', 1, '2023-08-29 16:19:18', '2023-08-29 16:19:18'),
(20, '98f13708210194c475687be6106a3b84', 61, 28, 23, 500000, '2', 'J', '60w/32', '32', '6', 'emi', '{\"installment\":[{\"hand\":\"hand_1\",\"percentage\":20,\"agent_id\":\"28\"},{\"hand\":\"shareholder\",\"percentage\":15,\"shareholder_id\":\"23\"}],\"down_payment\":[{\"hand\":\"hand_1\",\"percentage\":14,\"agent_id\":\"28\"},{\"hand\":\"shareholder\",\"percentage\":16,\"shareholder_id\":\"23\"}],\"booking_money\":[{\"hand\":\"hand_1\",\"percentage\":16,\"agent_id\":\"28\"},{\"hand\":\"shareholder\",\"percentage\":24.5,\"shareholder_id\":\"23\"}]}', '2022-07-28', 1, '2023-08-29 16:22:02', '2023-08-29 16:22:02'),
(21, '3c59dc048e8850243be8079a5c74d079', 54, 28, 23, 500000, '2', 'J', '60w/32', '30', '6', 'emi', '{\"installment\":[{\"hand\":\"hand_1\",\"percentage\":14,\"agent_id\":\"28\"},{\"hand\":\"shareholder\",\"percentage\":13.5,\"shareholder_id\":\"23\"}],\"down_payment\":[{\"hand\":\"hand_1\",\"percentage\":14,\"agent_id\":\"28\"},{\"hand\":\"shareholder\",\"percentage\":16,\"shareholder_id\":\"23\"}],\"booking_money\":[{\"hand\":\"hand_1\",\"percentage\":16,\"agent_id\":\"28\"},{\"hand\":\"shareholder\",\"percentage\":24.5,\"shareholder_id\":\"23\"}]}', '2022-06-15', 1, '2023-08-29 16:23:54', '2023-08-29 16:23:54'),
(22, 'b6d767d2f8ed5d21a44b0e5886680cb9', 12, 28, 23, 600000, '1', 'B', '8', '14', '10', 'emi', '{\"installment\":[{\"hand\":\"hand_1\",\"percentage\":14,\"agent_id\":\"28\"},{\"hand\":\"shareholder\",\"percentage\":13.5,\"shareholder_id\":\"23\"}],\"down_payment\":[{\"hand\":\"hand_1\",\"percentage\":14,\"agent_id\":\"28\"},{\"hand\":\"shareholder\",\"percentage\":16,\"shareholder_id\":\"23\"}],\"booking_money\":[{\"hand\":\"hand_1\",\"percentage\":16,\"agent_id\":\"28\"},{\"hand\":\"shareholder\",\"percentage\":24.5,\"shareholder_id\":\"23\"}]}', '2022-05-31', 1, '2023-08-29 16:24:57', '2023-08-29 16:24:57'),
(23, '37693cfc748049e45d87b8c7d8b9aacd', 63, 28, 23, 600000, '1', 'C', '12', '6', '5', 'emi', '{\"installment\":[{\"hand\":\"hand_1\",\"percentage\":20,\"agent_id\":\"28\"},{\"hand\":\"shareholder\",\"percentage\":15,\"shareholder_id\":\"23\"}],\"down_payment\":[{\"hand\":\"hand_1\",\"percentage\":14,\"agent_id\":\"28\"},{\"hand\":\"shareholder\",\"percentage\":16,\"shareholder_id\":\"23\"}],\"booking_money\":[{\"hand\":\"hand_1\",\"percentage\":16,\"agent_id\":\"28\"},{\"hand\":\"shareholder\",\"percentage\":24.5,\"shareholder_id\":\"23\"}]}', '2022-08-21', 1, '2023-08-29 16:26:26', '2023-08-29 16:26:26'),
(24, '1ff1de774005f8da13f42943881c655f', 64, 28, 23, 600000, '1', 'F', '39', '29', '5', 'emi', '{\"installment\":[{\"hand\":\"hand_1\",\"percentage\":20,\"agent_id\":\"28\"},{\"hand\":\"shareholder\",\"percentage\":15,\"shareholder_id\":\"23\"}],\"down_payment\":[{\"hand\":\"hand_1\",\"percentage\":14,\"agent_id\":\"28\"},{\"hand\":\"shareholder\",\"percentage\":16,\"shareholder_id\":\"23\"}],\"booking_money\":[{\"hand\":\"hand_1\",\"percentage\":16,\"agent_id\":\"28\"},{\"hand\":\"shareholder\",\"percentage\":24.5,\"shareholder_id\":\"23\"}]}', '2022-08-29', 1, '2023-08-29 16:27:56', '2023-08-29 16:27:56'),
(25, '8e296a067a37563370ded05f5a3bf3ec', 65, 28, 23, 500000, '2', 'A', '60', '6', '5', 'Select Type', '{\"installment\":[{\"hand\":\"hand_1\",\"percentage\":20,\"agent_id\":\"28\"},{\"hand\":\"shareholder\",\"percentage\":15,\"shareholder_id\":\"23\"}],\"down_payment\":[{\"hand\":\"hand_1\",\"percentage\":14,\"agent_id\":\"28\"},{\"hand\":\"shareholder\",\"percentage\":16,\"shareholder_id\":\"23\"}],\"booking_money\":[{\"hand\":\"hand_1\",\"percentage\":16,\"agent_id\":\"28\"},{\"hand\":\"shareholder\",\"percentage\":24.5,\"shareholder_id\":\"23\"}]}', '2022-08-08', 1, '2023-08-29 16:30:31', '2023-08-29 16:30:31'),
(26, '4e732ced3463d06de0ca9a15b6153677', 66, 28, 23, 500000, '2', 'J', '60w/32', '18', '6', 'emi', '{\"installment\":[{\"hand\":\"hand_1\",\"percentage\":20,\"agent_id\":\"28\"},{\"hand\":\"shareholder\",\"percentage\":15,\"shareholder_id\":\"23\"}],\"down_payment\":[{\"hand\":\"hand_1\",\"percentage\":14,\"agent_id\":\"28\"},{\"hand\":\"shareholder\",\"percentage\":16,\"shareholder_id\":\"23\"}],\"booking_money\":[{\"hand\":\"hand_1\",\"percentage\":16,\"agent_id\":\"28\"},{\"hand\":\"shareholder\",\"percentage\":24.5,\"shareholder_id\":\"23\"}]}', '2022-08-31', 1, '2023-08-29 16:32:09', '2023-08-29 16:32:09'),
(27, '02e74f10e0327ad868d138f2b4fdd6f0', 67, 28, 23, 550000, '1', 'B', '7', '4', '10', 'emi', '{\"installment\":[{\"hand\":\"hand_1\",\"percentage\":20,\"agent_id\":\"28\"},{\"hand\":\"shareholder\",\"percentage\":15,\"shareholder_id\":\"23\"}],\"down_payment\":[{\"hand\":\"hand_1\",\"percentage\":14,\"agent_id\":\"28\"},{\"hand\":\"shareholder\",\"percentage\":16,\"shareholder_id\":\"23\"}],\"booking_money\":[{\"hand\":\"hand_1\",\"percentage\":16,\"agent_id\":\"28\"},{\"hand\":\"shareholder\",\"percentage\":24.5,\"shareholder_id\":\"23\"}]}', '2022-09-19', 1, '2023-08-29 16:33:11', '2023-08-29 16:33:11'),
(28, '33e75ff09dd601bbe69f351039152189', 68, 28, 23, 500000, '2', 'A', '60', '1', '10', 'emi', '{\"installment\":[{\"hand\":\"hand_1\",\"percentage\":20,\"agent_id\":\"28\"},{\"hand\":\"shareholder\",\"percentage\":15,\"shareholder_id\":\"23\"}],\"down_payment\":[{\"hand\":\"hand_1\",\"percentage\":14,\"agent_id\":\"28\"},{\"hand\":\"shareholder\",\"percentage\":16,\"shareholder_id\":\"23\"}],\"booking_money\":[{\"hand\":\"hand_1\",\"percentage\":16,\"agent_id\":\"28\"},{\"hand\":\"shareholder\",\"percentage\":24.5,\"shareholder_id\":\"23\"}]}', '2022-08-31', 1, '2023-08-29 16:34:15', '2023-08-29 16:34:15'),
(29, '6ea9ab1baa0efb9e19094440c317e21b', 69, 28, 23, 600000, '1', 'C', '12', '10', '5', 'emi', '{\"installment\":[{\"hand\":\"hand_1\",\"percentage\":20,\"agent_id\":\"28\"},{\"hand\":\"shareholder\",\"percentage\":15,\"shareholder_id\":\"23\"}],\"down_payment\":[{\"hand\":\"hand_1\",\"percentage\":14,\"agent_id\":\"28\"},{\"hand\":\"shareholder\",\"percentage\":16,\"shareholder_id\":\"23\"}],\"booking_money\":[{\"hand\":\"hand_1\",\"percentage\":16,\"agent_id\":\"28\"},{\"hand\":\"shareholder\",\"percentage\":24.5,\"shareholder_id\":\"23\"}]}', '2022-08-31', 1, '2023-08-29 16:35:15', '2023-08-29 16:35:15'),
(30, '34173cb38f07f89ddbebc2ac9128303f', 70, 28, 23, 500000, '2', 'A', '62', '37', '5', 'emi', '{\"installment\":[{\"hand\":\"hand_1\",\"percentage\":20,\"agent_id\":\"28\"},{\"hand\":\"shareholder\",\"percentage\":15,\"shareholder_id\":\"23\"}],\"down_payment\":[{\"hand\":\"hand_1\",\"percentage\":14,\"agent_id\":\"28\"},{\"hand\":\"shareholder\",\"percentage\":16,\"shareholder_id\":\"23\"}],\"booking_money\":[{\"hand\":\"hand_1\",\"percentage\":16,\"agent_id\":\"28\"},{\"hand\":\"shareholder\",\"percentage\":24.5,\"shareholder_id\":\"23\"}]}', '2022-10-30', 1, '2023-08-29 16:36:12', '2023-08-29 16:36:12'),
(31, 'c16a5320fa475530d9583c34fd356ef5', 71, 28, 23, 600000, '1', 'F', '39', '31', '5', 'emi', '{\"installment\":[{\"hand\":\"hand_1\",\"percentage\":20,\"agent_id\":\"28\"},{\"hand\":\"shareholder\",\"percentage\":15,\"shareholder_id\":\"23\"}],\"down_payment\":[{\"hand\":\"hand_1\",\"percentage\":14,\"agent_id\":\"28\"},{\"hand\":\"shareholder\",\"percentage\":16,\"shareholder_id\":\"23\"}],\"booking_money\":[{\"hand\":\"hand_1\",\"percentage\":16,\"agent_id\":\"28\"},{\"hand\":\"shareholder\",\"percentage\":24.5,\"shareholder_id\":\"23\"}]}', '2022-12-04', 1, '2023-08-29 16:37:13', '2023-08-29 16:37:13'),
(32, '6364d3f0f495b6ab9dcf8d3b5c6e0b01', 72, 28, 23, 6000000, '1', 'E', '34', '6', '5', 'emi', '{\"installment\":[{\"hand\":\"hand_1\",\"percentage\":20,\"agent_id\":\"28\"},{\"hand\":\"shareholder\",\"percentage\":15,\"shareholder_id\":\"23\"}],\"down_payment\":[{\"hand\":\"hand_1\",\"percentage\":14,\"agent_id\":\"28\"},{\"hand\":\"shareholder\",\"percentage\":16,\"shareholder_id\":\"23\"}],\"booking_money\":[{\"hand\":\"hand_1\",\"percentage\":16,\"agent_id\":\"28\"},{\"hand\":\"shareholder\",\"percentage\":24.5,\"shareholder_id\":\"23\"}]}', '2022-12-31', 1, '2023-08-29 16:38:24', '2023-08-29 16:38:24'),
(33, '182be0c5cdcd5072bb1864cdee4d3d6e', 73, 28, 23, 550000, '2', 'P', '33', '18', '5', 'emi', '{\"installment\":[{\"hand\":\"hand_1\",\"percentage\":23,\"agent_id\":\"28\"},{\"hand\":\"shareholder\",\"percentage\":9.5,\"shareholder_id\":\"23\"}],\"down_payment\":[{\"hand\":\"hand_1\",\"percentage\":14,\"agent_id\":\"28\"},{\"hand\":\"shareholder\",\"percentage\":16,\"shareholder_id\":\"23\"}],\"booking_money\":[{\"hand\":\"hand_1\",\"percentage\":16,\"agent_id\":\"28\"},{\"hand\":\"shareholder\",\"percentage\":24.5,\"shareholder_id\":\"23\"}]}', '2023-02-25', 1, '2023-08-29 16:39:58', '2023-08-29 16:39:58'),
(34, 'e369853df766fa44e1ed0ff613f563bd', 74, 28, 23, 550000, '2', 'G', '59', '2', '10', 'emi', '{\"installment\":[{\"hand\":\"hand_1\",\"percentage\":23,\"agent_id\":\"28\"},{\"hand\":\"shareholder\",\"percentage\":9.5,\"shareholder_id\":\"23\"}],\"down_payment\":[{\"hand\":\"hand_1\",\"percentage\":14,\"agent_id\":\"28\"},{\"hand\":\"shareholder\",\"percentage\":16,\"shareholder_id\":\"23\"}],\"booking_money\":[{\"hand\":\"hand_1\",\"percentage\":16,\"agent_id\":\"28\"},{\"hand\":\"shareholder\",\"percentage\":24.5,\"shareholder_id\":\"23\"}]}', '2023-03-19', 1, '2023-08-29 16:41:28', '2023-08-29 16:41:28'),
(35, '1c383cd30b7c298ab50293adfecb7b18', 75, 28, 23, 550000, '2', 'O', '32', '32', '3', 'emi', '{\"installment\":[{\"hand\":\"hand_1\",\"percentage\":23,\"agent_id\":\"28\"},{\"hand\":\"shareholder\",\"percentage\":9.5,\"shareholder_id\":\"23\"}],\"down_payment\":[{\"hand\":\"hand_1\",\"percentage\":14,\"agent_id\":\"28\"},{\"hand\":\"shareholder\",\"percentage\":16,\"shareholder_id\":\"23\"}],\"booking_money\":[{\"hand\":\"hand_1\",\"percentage\":16,\"agent_id\":\"28\"},{\"hand\":\"shareholder\",\"percentage\":24.5,\"shareholder_id\":\"23\"}]}', '2023-03-19', 1, '2023-08-29 16:42:43', '2023-08-29 16:42:43'),
(36, '19ca14e7ea6328a42e0eb13d585e4c22', 76, 28, 23, 600000, '1', 'B', '9', '8', '10', 'emi', '{\"installment\":[{\"hand\":\"hand_1\",\"percentage\":17,\"agent_id\":\"28\"},{\"hand\":\"shareholder\",\"percentage\":14.25,\"shareholder_id\":\"23\"}],\"down_payment\":[{\"hand\":\"hand_1\",\"percentage\":14,\"agent_id\":\"28\"},{\"hand\":\"shareholder\",\"percentage\":16,\"shareholder_id\":\"23\"}],\"booking_money\":[{\"hand\":\"hand_1\",\"percentage\":16,\"agent_id\":\"28\"},{\"hand\":\"shareholder\",\"percentage\":24.5,\"shareholder_id\":\"23\"}]}', '2022-08-22', 1, '2023-08-29 16:44:38', '2023-08-29 16:44:38'),
(37, 'a5bfc9e07964f8dddeb95fc584cd965d', 77, NULL, 24, 500000, '2', 'A', '60', '6', '5', 'emi', '{\"installment\":[{\"hand\":\"shareholder\",\"percentage\":\"35\",\"shareholder_id\":\"24\"}],\"down_payment\":[{\"hand\":\"shareholder\",\"percentage\":\"30\",\"shareholder_id\":\"24\"}],\"booking_money\":[{\"hand\":\"shareholder\",\"percentage\":\"40.5\",\"shareholder_id\":\"24\"}]}', '2022-08-29', 1, '2023-08-29 16:46:48', '2023-08-29 16:50:28'),
(38, 'a5771bce93e200c36f7cd9dfd0e5deaa', 79, 26, 24, 500000, '1', 'C', '11', '48', '5', 'emi', '{\"installment\":[{\"hand\":\"hand_1\",\"percentage\":14.53999999999999914734871708787977695465087890625,\"agent_id\":\"26\"},{\"hand\":\"shareholder\",\"percentage\":14.53999999999999914734871708787977695465087890625,\"shareholder_id\":\"24\"}],\"down_payment\":[{\"hand\":\"hand_1\",\"percentage\":14,\"agent_id\":\"26\"},{\"hand\":\"shareholder\",\"percentage\":16,\"shareholder_id\":\"24\"}],\"booking_money\":[{\"hand\":\"hand_1\",\"percentage\":16.5,\"agent_id\":\"26\"},{\"hand\":\"shareholder\",\"percentage\":24,\"shareholder_id\":\"24\"}]}', '2021-01-21', 1, '2023-08-29 16:52:22', '2023-08-29 16:52:22'),
(39, 'd67d8ab4f4c10bf22aa353e27879133c', 81, 27, 24, 550000, '1', 'B', '7', '26', '10', 'emi', '{\"installment\":[{\"hand\":\"hand_1\",\"percentage\":0,\"agent_id\":\"27\"},{\"hand\":\"hand_2\",\"percentage\":14,\"agent_id\":\"26\"},{\"hand\":\"shareholder\",\"percentage\":6,\"shareholder_id\":\"24\"}],\"down_payment\":[{\"hand\":\"hand_1\",\"percentage\":14,\"agent_id\":\"27\"},{\"hand\":\"hand_2\",\"percentage\":10,\"agent_id\":\"26\"},{\"hand\":\"shareholder\",\"percentage\":6,\"shareholder_id\":\"24\"}],\"booking_money\":[{\"hand\":\"hand_1\",\"percentage\":16.5,\"agent_id\":\"27\"},{\"hand\":\"hand_2\",\"percentage\":10,\"agent_id\":\"26\"},{\"hand\":\"shareholder\",\"percentage\":14,\"shareholder_id\":\"24\"}]}', '2022-02-22', 1, '2023-08-29 17:13:01', '2023-08-29 17:13:01'),
(40, 'd645920e395fedad7bbbed0eca3fe2e0', 82, 27, 24, 550000, '1', 'C', '11', '50', '5', 'emi', '{\"installment\":[{\"hand\":\"hand_1\",\"percentage\":14,\"agent_id\":\"27\"},{\"hand\":\"hand_2\",\"percentage\":6,\"agent_id\":\"26\"},{\"hand\":\"shareholder\",\"percentage\":0,\"shareholder_id\":\"24\"}],\"down_payment\":[{\"hand\":\"hand_1\",\"percentage\":14,\"agent_id\":\"27\"},{\"hand\":\"hand_2\",\"percentage\":10,\"agent_id\":\"26\"},{\"hand\":\"shareholder\",\"percentage\":6,\"shareholder_id\":\"24\"}],\"booking_money\":[{\"hand\":\"hand_1\",\"percentage\":16.5,\"agent_id\":\"27\"},{\"hand\":\"hand_2\",\"percentage\":10,\"agent_id\":\"26\"},{\"hand\":\"shareholder\",\"percentage\":14,\"shareholder_id\":\"24\"}]}', '2022-03-15', 1, '2023-08-29 17:15:18', '2023-08-29 17:15:18'),
(41, '3416a75f4cea9109507cacd8e2f2aefc', 83, 27, 24, 500000, '1', 'D', '25', '14', '5', 'emi', '{\"installment\":[{\"hand\":\"hand_1\",\"percentage\":14,\"agent_id\":\"27\"},{\"hand\":\"hand_2\",\"percentage\":6,\"agent_id\":\"26\"},{\"hand\":\"shareholder\",\"percentage\":0,\"shareholder_id\":\"24\"}],\"down_payment\":[{\"hand\":\"hand_1\",\"percentage\":14,\"agent_id\":\"27\"},{\"hand\":\"hand_2\",\"percentage\":10,\"agent_id\":\"26\"},{\"hand\":\"shareholder\",\"percentage\":6,\"shareholder_id\":\"24\"}],\"booking_money\":[{\"hand\":\"hand_1\",\"percentage\":16.5,\"agent_id\":\"27\"},{\"hand\":\"hand_2\",\"percentage\":10,\"agent_id\":\"26\"},{\"hand\":\"shareholder\",\"percentage\":14,\"shareholder_id\":\"24\"}]}', '2022-04-02', 1, '2023-08-29 17:16:28', '2023-08-29 17:16:28'),
(42, 'a1d0c6e83f027327d8461063f4ac58a6', 84, 27, 24, 600000, '1', 'B', '8', '26', '10', 'emi', '{\"installment\":[{\"hand\":\"hand_1\",\"percentage\":14,\"agent_id\":\"27\"},{\"hand\":\"hand_2\",\"percentage\":6,\"agent_id\":\"26\"},{\"hand\":\"shareholder\",\"percentage\":0,\"shareholder_id\":\"24\"}],\"down_payment\":[{\"hand\":\"hand_1\",\"percentage\":14,\"agent_id\":\"27\"},{\"hand\":\"hand_2\",\"percentage\":10,\"agent_id\":\"26\"},{\"hand\":\"shareholder\",\"percentage\":6,\"shareholder_id\":\"24\"}],\"booking_money\":[{\"hand\":\"hand_1\",\"percentage\":16.5,\"agent_id\":\"27\"},{\"hand\":\"hand_2\",\"percentage\":10,\"agent_id\":\"26\"},{\"hand\":\"shareholder\",\"percentage\":14,\"shareholder_id\":\"24\"}]}', '2022-04-16', 1, '2023-08-29 17:17:32', '2023-08-29 17:17:32'),
(43, '17e62166fc8586dfa4d1bc0e1742c08b', 84, 27, 24, 600000, '1', 'B', '8', '26', '10', 'emi', '{\"installment\":[{\"hand\":\"hand_1\",\"percentage\":14,\"agent_id\":\"27\"},{\"hand\":\"hand_2\",\"percentage\":6,\"agent_id\":\"26\"},{\"hand\":\"shareholder\",\"percentage\":0,\"shareholder_id\":\"24\"}],\"down_payment\":[{\"hand\":\"hand_1\",\"percentage\":14,\"agent_id\":\"27\"},{\"hand\":\"hand_2\",\"percentage\":10,\"agent_id\":\"26\"},{\"hand\":\"shareholder\",\"percentage\":6,\"shareholder_id\":\"24\"}],\"booking_money\":[{\"hand\":\"hand_1\",\"percentage\":16.5,\"agent_id\":\"27\"},{\"hand\":\"hand_2\",\"percentage\":10,\"agent_id\":\"26\"},{\"hand\":\"shareholder\",\"percentage\":14,\"shareholder_id\":\"24\"}]}', '2022-04-16', 1, '2023-08-29 17:18:33', '2023-08-29 17:18:33'),
(44, 'f7177163c833dff4b38fc8d2872f1ec6', 84, 27, 24, 600000, '1', 'B', '8', '26', '10', 'emi', '{\"installment\":[{\"hand\":\"hand_1\",\"percentage\":14,\"agent_id\":\"27\"},{\"hand\":\"hand_2\",\"percentage\":6,\"agent_id\":\"26\"},{\"hand\":\"shareholder\",\"percentage\":0,\"shareholder_id\":\"24\"}],\"down_payment\":[{\"hand\":\"hand_1\",\"percentage\":14,\"agent_id\":\"27\"},{\"hand\":\"hand_2\",\"percentage\":10,\"agent_id\":\"26\"},{\"hand\":\"shareholder\",\"percentage\":6,\"shareholder_id\":\"24\"}],\"booking_money\":[{\"hand\":\"hand_1\",\"percentage\":16.5,\"agent_id\":\"27\"},{\"hand\":\"hand_2\",\"percentage\":10,\"agent_id\":\"26\"},{\"hand\":\"shareholder\",\"percentage\":14,\"shareholder_id\":\"24\"}]}', '2022-04-16', 1, '2023-08-29 17:19:32', '2023-08-29 17:19:32'),
(45, '6c8349cc7260ae62e3b1396831a8398f', 85, 27, 24, 600000, '1', 'D', '28', '34', '5', 'emi', '{\"installment\":[{\"hand\":\"hand_1\",\"percentage\":14,\"agent_id\":\"27\"},{\"hand\":\"hand_2\",\"percentage\":6,\"agent_id\":\"26\"},{\"hand\":\"shareholder\",\"percentage\":0,\"shareholder_id\":\"24\"}],\"down_payment\":[{\"hand\":\"hand_1\",\"percentage\":14,\"agent_id\":\"27\"},{\"hand\":\"hand_2\",\"percentage\":10,\"agent_id\":\"26\"},{\"hand\":\"shareholder\",\"percentage\":6,\"shareholder_id\":\"24\"}],\"booking_money\":[{\"hand\":\"hand_1\",\"percentage\":16.5,\"agent_id\":\"27\"},{\"hand\":\"hand_2\",\"percentage\":10,\"agent_id\":\"26\"},{\"hand\":\"shareholder\",\"percentage\":14,\"shareholder_id\":\"24\"}]}', '2022-02-17', 1, '2023-08-29 17:20:53', '2023-08-29 17:20:53'),
(46, 'd9d4f495e875a2e075a1a4a6e1b9770f', 86, 27, 24, 600000, '1', 'B', '60w/02', '5', '10', 'emi', '{\"installment\":[{\"hand\":\"hand_1\",\"percentage\":14,\"agent_id\":\"27\"},{\"hand\":\"hand_2\",\"percentage\":6,\"agent_id\":\"26\"},{\"hand\":\"shareholder\",\"percentage\":0,\"shareholder_id\":\"24\"}],\"down_payment\":[{\"hand\":\"hand_1\",\"percentage\":14,\"agent_id\":\"27\"},{\"hand\":\"hand_2\",\"percentage\":10,\"agent_id\":\"26\"},{\"hand\":\"shareholder\",\"percentage\":6,\"shareholder_id\":\"24\"}],\"booking_money\":[{\"hand\":\"hand_1\",\"percentage\":16.5,\"agent_id\":\"27\"},{\"hand\":\"hand_2\",\"percentage\":10,\"agent_id\":\"26\"},{\"hand\":\"shareholder\",\"percentage\":14,\"shareholder_id\":\"24\"}]}', '2022-04-18', 1, '2023-08-29 17:21:51', '2023-08-29 17:21:51'),
(47, '67c6a1e7ce56d3d6fa748ab6d9af3fd7', 87, 27, 24, 600000, '1', 'C', '11', '52', '5', 'emi', '{\"installment\":[{\"hand\":\"hand_1\",\"percentage\":14,\"agent_id\":\"27\"},{\"hand\":\"hand_2\",\"percentage\":6,\"agent_id\":\"26\"},{\"hand\":\"shareholder\",\"percentage\":0,\"shareholder_id\":\"24\"}],\"down_payment\":[{\"hand\":\"hand_1\",\"percentage\":14,\"agent_id\":\"27\"},{\"hand\":\"hand_2\",\"percentage\":10,\"agent_id\":\"26\"},{\"hand\":\"shareholder\",\"percentage\":6,\"shareholder_id\":\"24\"}],\"booking_money\":[{\"hand\":\"hand_1\",\"percentage\":16.5,\"agent_id\":\"27\"},{\"hand\":\"hand_2\",\"percentage\":10,\"agent_id\":\"26\"},{\"hand\":\"shareholder\",\"percentage\":14,\"shareholder_id\":\"24\"}]}', '2022-07-28', 1, '2023-08-29 17:22:55', '2023-08-29 17:22:55'),
(48, '642e92efb79421734881b53e1e1b18b6', 87, 27, 24, 600000, '1', 'C', '11', '52', '5', 'emi', '{\"installment\":[{\"hand\":\"hand_1\",\"percentage\":14,\"agent_id\":\"27\"},{\"hand\":\"hand_2\",\"percentage\":6,\"agent_id\":\"26\"},{\"hand\":\"shareholder\",\"percentage\":0,\"shareholder_id\":\"24\"}],\"down_payment\":[{\"hand\":\"hand_1\",\"percentage\":14,\"agent_id\":\"27\"},{\"hand\":\"hand_2\",\"percentage\":10,\"agent_id\":\"26\"},{\"hand\":\"shareholder\",\"percentage\":6,\"shareholder_id\":\"24\"}],\"booking_money\":[{\"hand\":\"hand_1\",\"percentage\":16.5,\"agent_id\":\"27\"},{\"hand\":\"hand_2\",\"percentage\":10,\"agent_id\":\"26\"},{\"hand\":\"shareholder\",\"percentage\":14,\"shareholder_id\":\"24\"}]}', '2022-07-28', 1, '2023-08-29 17:24:00', '2023-08-29 17:24:00'),
(49, 'f457c545a9ded88f18ecee47145a72c0', 88, 27, 24, 600000, '1', 'C', '11', '46', '5', 'emi', '{\"installment\":[{\"hand\":\"hand_1\",\"percentage\":14,\"agent_id\":\"27\"},{\"hand\":\"hand_2\",\"percentage\":6,\"agent_id\":\"26\"},{\"hand\":\"shareholder\",\"percentage\":0,\"shareholder_id\":\"24\"}],\"down_payment\":[{\"hand\":\"hand_1\",\"percentage\":14,\"agent_id\":\"27\"},{\"hand\":\"hand_2\",\"percentage\":10,\"agent_id\":\"26\"},{\"hand\":\"shareholder\",\"percentage\":6,\"shareholder_id\":\"24\"}],\"booking_money\":[{\"hand\":\"hand_1\",\"percentage\":16.5,\"agent_id\":\"27\"},{\"hand\":\"hand_2\",\"percentage\":10,\"agent_id\":\"26\"},{\"hand\":\"shareholder\",\"percentage\":14,\"shareholder_id\":\"24\"}]}', '2022-09-18', 1, '2023-08-29 17:24:56', '2023-08-29 17:24:56'),
(50, 'c0c7c76d30bd3dcaefc96f40275bdc0a', 89, 27, 24, 600000, '2', 'C', '91', 'Ext-2', '3', 'emi', '{\"installment\":[{\"hand\":\"hand_1\",\"percentage\":15,\"agent_id\":\"27\"},{\"hand\":\"hand_2\",\"percentage\":10,\"agent_id\":\"26\"},{\"hand\":\"shareholder\",\"percentage\":0,\"shareholder_id\":\"24\"}],\"down_payment\":[{\"hand\":\"hand_1\",\"percentage\":14,\"agent_id\":\"27\"},{\"hand\":\"hand_2\",\"percentage\":10,\"agent_id\":\"26\"},{\"hand\":\"shareholder\",\"percentage\":6,\"shareholder_id\":\"24\"}],\"booking_money\":[{\"hand\":\"hand_1\",\"percentage\":16.5,\"agent_id\":\"27\"},{\"hand\":\"hand_2\",\"percentage\":10,\"agent_id\":\"26\"},{\"hand\":\"shareholder\",\"percentage\":14,\"shareholder_id\":\"24\"}]}', '2023-07-22', 1, '2023-08-29 17:27:05', '2023-08-29 17:27:05'),
(51, '2838023a778dfaecdc212708f721b788', 89, 27, 24, 600000, '2', 'C', '91', 'Ext-2', '3', 'emi', '{\"installment\":[{\"hand\":\"hand_1\",\"percentage\":15,\"agent_id\":\"27\"},{\"hand\":\"hand_2\",\"percentage\":10,\"agent_id\":\"26\"},{\"hand\":\"shareholder\",\"percentage\":0,\"shareholder_id\":\"24\"}],\"down_payment\":[{\"hand\":\"hand_1\",\"percentage\":14,\"agent_id\":\"27\"},{\"hand\":\"hand_2\",\"percentage\":10,\"agent_id\":\"26\"},{\"hand\":\"shareholder\",\"percentage\":6,\"shareholder_id\":\"24\"}],\"booking_money\":[{\"hand\":\"hand_1\",\"percentage\":16.5,\"agent_id\":\"27\"},{\"hand\":\"hand_2\",\"percentage\":10,\"agent_id\":\"26\"},{\"hand\":\"shareholder\",\"percentage\":14,\"shareholder_id\":\"24\"}]}', '2023-07-22', 1, '2023-08-29 17:28:11', '2023-08-29 17:28:11'),
(52, '9a1158154dfa42caddbd0694a4e9bdc8', 90, 26, 24, 600000, '1', 'B', '10', '8', '10', 'emi', '{\"installment\":[{\"hand\":\"hand_1\",\"percentage\":14,\"agent_id\":\"26\"},{\"hand\":\"shareholder\",\"percentage\":6,\"shareholder_id\":\"24\"}],\"down_payment\":[{\"hand\":\"hand_1\",\"percentage\":14,\"agent_id\":\"26\"},{\"hand\":\"shareholder\",\"percentage\":16,\"shareholder_id\":\"24\"}],\"booking_money\":[{\"hand\":\"hand_1\",\"percentage\":16.5,\"agent_id\":\"26\"},{\"hand\":\"shareholder\",\"percentage\":24,\"shareholder_id\":\"24\"}]}', '2022-08-01', 1, '2023-08-29 17:29:56', '2023-08-29 17:29:56'),
(53, 'd82c8d1619ad8176d665453cfb2e55f0', 91, 26, 24, 600000, '1', 'B', '8', '8', '10', 'cash', '{\"installment\":[{\"hand\":\"hand_1\",\"percentage\":25,\"agent_id\":\"26\"},{\"hand\":\"shareholder\",\"percentage\":0,\"shareholder_id\":\"24\"}],\"down_payment\":[{\"hand\":\"hand_1\",\"percentage\":14,\"agent_id\":\"26\"},{\"hand\":\"shareholder\",\"percentage\":16,\"shareholder_id\":\"24\"}],\"booking_money\":[{\"hand\":\"hand_1\",\"percentage\":16.5,\"agent_id\":\"26\"},{\"hand\":\"shareholder\",\"percentage\":24,\"shareholder_id\":\"24\"}]}', '2023-02-01', 1, '2023-08-29 17:31:30', '2023-08-29 17:31:30'),
(54, 'a684eceee76fc522773286a895bc8436', 92, 26, 24, 550000, '2', 'A', '67', '38', '5', 'emi', '{\"installment\":[{\"hand\":\"hand_1\",\"percentage\":25,\"agent_id\":\"26\"},{\"hand\":\"shareholder\",\"percentage\":0,\"shareholder_id\":\"24\"}],\"down_payment\":[{\"hand\":\"hand_1\",\"percentage\":14,\"agent_id\":\"26\"},{\"hand\":\"shareholder\",\"percentage\":16,\"shareholder_id\":\"24\"}],\"booking_money\":[{\"hand\":\"hand_1\",\"percentage\":16.5,\"agent_id\":\"26\"},{\"hand\":\"shareholder\",\"percentage\":24,\"shareholder_id\":\"24\"}]}', '2023-02-05', 1, '2023-08-29 17:32:50', '2023-08-29 17:32:50'),
(55, 'b53b3a3d6ab90ce0268229151c9bde11', 93, 26, 24, 550000, '2', 'A', '65', '30', '5', 'emi', '{\"installment\":[{\"hand\":\"hand_1\",\"percentage\":25,\"agent_id\":\"26\"},{\"hand\":\"shareholder\",\"percentage\":0,\"shareholder_id\":\"24\"}],\"down_payment\":[{\"hand\":\"hand_1\",\"percentage\":14,\"agent_id\":\"26\"},{\"hand\":\"shareholder\",\"percentage\":16,\"shareholder_id\":\"24\"}],\"booking_money\":[{\"hand\":\"hand_1\",\"percentage\":16.5,\"agent_id\":\"26\"},{\"hand\":\"shareholder\",\"percentage\":24,\"shareholder_id\":\"24\"}]}', '2023-03-14', 1, '2023-08-29 17:33:56', '2023-08-29 17:33:56'),
(56, '9f61408e3afb633e50cdf1b20de6f466', 94, 26, 24, 550000, '2', 'A', '65', '18', '5', 'emi', '{\"installment\":[{\"hand\":\"hand_1\",\"percentage\":25,\"agent_id\":\"26\"},{\"hand\":\"shareholder\",\"percentage\":0,\"shareholder_id\":\"24\"}],\"down_payment\":[{\"hand\":\"hand_1\",\"percentage\":14,\"agent_id\":\"26\"},{\"hand\":\"shareholder\",\"percentage\":16,\"shareholder_id\":\"24\"}],\"booking_money\":[{\"hand\":\"hand_1\",\"percentage\":16.5,\"agent_id\":\"26\"},{\"hand\":\"shareholder\",\"percentage\":24,\"shareholder_id\":\"24\"}]}', '2023-03-14', 1, '2023-08-29 17:35:09', '2023-08-29 17:35:09'),
(57, '72b32a1f754ba1c09b3695e0cb6cde7f', 95, 26, 24, 500000, '2', 'A', '65', '28', '5', 'emi', '{\"installment\":[{\"hand\":\"hand_1\",\"percentage\":25,\"agent_id\":\"26\"},{\"hand\":\"shareholder\",\"percentage\":0,\"shareholder_id\":\"24\"}],\"down_payment\":[{\"hand\":\"hand_1\",\"percentage\":14,\"agent_id\":\"26\"},{\"hand\":\"shareholder\",\"percentage\":16,\"shareholder_id\":\"24\"}],\"booking_money\":[{\"hand\":\"hand_1\",\"percentage\":16.5,\"agent_id\":\"26\"},{\"hand\":\"shareholder\",\"percentage\":24,\"shareholder_id\":\"24\"}]}', '2023-03-03', 1, '2023-08-29 17:36:09', '2023-08-29 17:36:09'),
(58, '66f041e16a60928b05a7e228a89c3799', 96, 26, 24, 550000, '2', 'C', '92', 'Ext-2', '3', 'emi', '{\"installment\":[{\"hand\":\"hand_1\",\"percentage\":25,\"agent_id\":\"26\"},{\"hand\":\"shareholder\",\"percentage\":0,\"shareholder_id\":\"24\"}],\"down_payment\":[{\"hand\":\"hand_1\",\"percentage\":14,\"agent_id\":\"26\"},{\"hand\":\"shareholder\",\"percentage\":16,\"shareholder_id\":\"24\"}],\"booking_money\":[{\"hand\":\"hand_1\",\"percentage\":16.5,\"agent_id\":\"26\"},{\"hand\":\"shareholder\",\"percentage\":24,\"shareholder_id\":\"24\"}]}', '2023-06-22', 1, '2023-08-29 17:37:15', '2023-08-29 17:37:15'),
(59, '093f65e080a295f8076b1c5722a46aa2', 97, 26, 24, 600000, '2', 'A', '65', 'Ext-2', '5', 'emi', '{\"installment\":[{\"hand\":\"hand_1\",\"percentage\":25,\"agent_id\":\"26\"},{\"hand\":\"shareholder\",\"percentage\":0,\"shareholder_id\":\"24\"}],\"down_payment\":[{\"hand\":\"hand_1\",\"percentage\":14,\"agent_id\":\"26\"},{\"hand\":\"shareholder\",\"percentage\":16,\"shareholder_id\":\"24\"}],\"booking_money\":[{\"hand\":\"hand_1\",\"percentage\":16.5,\"agent_id\":\"26\"},{\"hand\":\"shareholder\",\"percentage\":24,\"shareholder_id\":\"24\"}]}', '2023-06-22', 1, '2023-08-29 17:38:32', '2023-08-29 17:38:32'),
(60, '072b030ba126b2f4b2374f342be9ed44', 99, NULL, 25, 600000, '1', 'B', '9', '32', '10', 'emi', '{\"installment\":[{\"hand\":\"shareholder\",\"percentage\":\"25\",\"shareholder_id\":\"25\"}],\"down_payment\":[{\"hand\":\"shareholder\",\"percentage\":\"30\",\"shareholder_id\":\"25\"}],\"booking_money\":[{\"hand\":\"shareholder\",\"percentage\":\"40.5\",\"shareholder_id\":\"25\"}]}', '2023-02-28', 1, '2023-08-30 02:52:44', '2023-08-30 02:52:44'),
(61, '7f39f8317fbdb1988ef4c628eba02591', 101, NULL, 25, 600000, '1', 'B', '9', '34', '10', 'emi', '{\"installment\":[{\"hand\":\"shareholder\",\"percentage\":\"25\",\"shareholder_id\":\"25\"}],\"down_payment\":[{\"hand\":\"shareholder\",\"percentage\":\"30\",\"shareholder_id\":\"25\"}],\"booking_money\":[{\"hand\":\"shareholder\",\"percentage\":\"40.5\",\"shareholder_id\":\"25\"}]}', '2023-02-28', 1, '2023-08-30 02:54:23', '2023-08-30 02:54:23'),
(62, '44f683a84163b3523afe57c2e008bc8c', 102, NULL, 25, 600000, '2', 'O', '31', '16', '3', 'emi', '{\"installment\":[{\"hand\":\"shareholder\",\"percentage\":\"20\",\"shareholder_id\":\"25\"}],\"down_payment\":[{\"hand\":\"shareholder\",\"percentage\":\"30\",\"shareholder_id\":\"25\"}],\"booking_money\":[{\"hand\":\"shareholder\",\"percentage\":\"40.5\",\"shareholder_id\":\"25\"}]}', '2022-08-10', 1, '2023-08-30 02:55:50', '2023-08-30 02:55:50'),
(63, '03afdbd66e7929b125f8597834fa83a4', 103, NULL, 25, 600000, '2', 'L', '60w/24', '18', '10', 'emi', '{\"installment\":[{\"hand\":\"shareholder\",\"percentage\":\"20\",\"shareholder_id\":\"25\"}],\"down_payment\":[{\"hand\":\"shareholder\",\"percentage\":\"30\",\"shareholder_id\":\"25\"}],\"booking_money\":[{\"hand\":\"shareholder\",\"percentage\":\"40.5\",\"shareholder_id\":\"25\"}]}', '2022-11-13', 1, '2023-08-30 02:57:32', '2023-08-30 02:57:32'),
(64, 'ea5d2f1c4608232e07d3aa3d998e5135', 105, NULL, 25, 600000, '1', 'E', '33', '30', '5', 'emi', '{\"installment\":[{\"hand\":\"shareholder\",\"percentage\":\"25\",\"shareholder_id\":\"25\"}],\"down_payment\":[{\"hand\":\"shareholder\",\"percentage\":\"30\",\"shareholder_id\":\"25\"}],\"booking_money\":[{\"hand\":\"shareholder\",\"percentage\":\"40.5\",\"shareholder_id\":\"25\"}]}', '2022-12-31', 1, '2023-08-30 03:05:07', '2023-08-30 03:05:07'),
(65, 'fc490ca45c00b1249bbe3554a4fdf6fb', 104, NULL, 25, 550000, '2', 'A', '64', '30', '5', 'emi', '{\"installment\":[{\"hand\":\"shareholder\",\"percentage\":\"20\",\"shareholder_id\":\"25\"}],\"down_payment\":[{\"hand\":\"shareholder\",\"percentage\":\"30\",\"shareholder_id\":\"25\"}],\"booking_money\":[{\"hand\":\"shareholder\",\"percentage\":\"40.5\",\"shareholder_id\":\"25\"}]}', '2022-12-03', 1, '2023-08-30 03:14:19', '2023-08-30 03:14:19'),
(66, '3295c76acbf4caaed33c36b1b5fc2cb1', 104, NULL, 25, 550000, '2', 'A', '64', '30', '5', 'emi', '{\"installment\":[{\"hand\":\"shareholder\",\"percentage\":\"20\",\"shareholder_id\":\"25\"}],\"down_payment\":[{\"hand\":\"shareholder\",\"percentage\":\"30\",\"shareholder_id\":\"25\"}],\"booking_money\":[{\"hand\":\"shareholder\",\"percentage\":\"40.5\",\"shareholder_id\":\"25\"}]}', '2022-12-03', 1, '2023-08-30 03:16:27', '2023-08-30 03:16:27'),
(67, '735b90b4568125ed6c3f678819b6e058', 106, NULL, 25, 600000, '1', 'B', '10', '10', '10', 'emi', '{\"installment\":[{\"hand\":\"shareholder\",\"percentage\":\"25\",\"shareholder_id\":\"25\"}],\"down_payment\":[{\"hand\":\"shareholder\",\"percentage\":\"30\",\"shareholder_id\":\"25\"}],\"booking_money\":[{\"hand\":\"shareholder\",\"percentage\":\"40.5\",\"shareholder_id\":\"25\"}]}', '2022-12-31', 1, '2023-08-30 03:18:21', '2023-08-30 03:18:21'),
(68, 'a3f390d88e4c41f2747bfa2f1b5f87db', 107, NULL, 25, 600000, '1', 'C', '12', '24', '5', 'emi', '{\"installment\":[{\"hand\":\"shareholder\",\"percentage\":\"25\",\"shareholder_id\":\"25\"}],\"down_payment\":[{\"hand\":\"shareholder\",\"percentage\":\"30\",\"shareholder_id\":\"25\"}],\"booking_money\":[{\"hand\":\"shareholder\",\"percentage\":\"40.5\",\"shareholder_id\":\"25\"}]}', '2022-12-31', 1, '2023-08-30 03:20:39', '2023-08-30 03:20:39'),
(69, '14bfa6bb14875e45bba028a21ed38046', 108, NULL, 25, 600000, '1', 'B', '10', '14', '10', 'emi', '{\"installment\":[{\"hand\":\"shareholder\",\"percentage\":\"25\",\"shareholder_id\":\"25\"}],\"down_payment\":[{\"hand\":\"shareholder\",\"percentage\":\"30\",\"shareholder_id\":\"25\"}],\"booking_money\":[{\"hand\":\"shareholder\",\"percentage\":\"40.5\",\"shareholder_id\":\"25\"}]}', '2022-12-31', 17, '2023-08-30 03:25:15', '2023-08-30 08:09:42'),
(70, '7cbbc409ec990f19c78c75bd1e06f215', 109, NULL, 25, 600000, '1', 'B', '9', '16', '10', 'emi', '{\"installment\":[{\"hand\":\"shareholder\",\"percentage\":\"25\",\"shareholder_id\":\"25\"}],\"down_payment\":[{\"hand\":\"shareholder\",\"percentage\":\"30\",\"shareholder_id\":\"25\"}],\"booking_money\":[{\"hand\":\"shareholder\",\"percentage\":\"40.5\",\"shareholder_id\":\"25\"}]}', '2022-12-31', 1, '2023-08-30 03:26:16', '2023-08-30 03:26:16'),
(71, 'e2c420d928d4bf8ce0ff2ec19b371514', 110, NULL, 25, 550000, '2', 'O', '30', '18', '3', 'emi', '{\"installment\":[{\"hand\":\"shareholder\",\"percentage\":\"25\",\"shareholder_id\":\"25\"}],\"down_payment\":[{\"hand\":\"shareholder\",\"percentage\":\"30\",\"shareholder_id\":\"25\"}],\"booking_money\":[{\"hand\":\"shareholder\",\"percentage\":\"40.5\",\"shareholder_id\":\"25\"}]}', '2022-12-31', 17, '2023-08-30 08:31:11', '2023-08-30 08:31:11'),
(72, '32bb90e8976aab5298d5da10fe66f21d', 111, NULL, 25, 600000, '1', 'C', '16', '22', '5', 'emi', '{\"installment\":[{\"hand\":\"shareholder\",\"percentage\":\"25\",\"shareholder_id\":\"25\"}],\"down_payment\":[{\"hand\":\"shareholder\",\"percentage\":\"30\",\"shareholder_id\":\"25\"}],\"booking_money\":[{\"hand\":\"shareholder\",\"percentage\":\"40.5\",\"shareholder_id\":\"25\"}]}', '2022-12-31', 17, '2023-08-30 08:34:22', '2023-08-30 08:34:22'),
(73, 'd2ddea18f00665ce8623e36bd4e3c7c5', 112, NULL, 25, 600000, '1', 'B', '8', '24', '10', 'emi', '{\"installment\":[{\"hand\":\"shareholder\",\"percentage\":\"25\",\"shareholder_id\":\"25\"}],\"down_payment\":[{\"hand\":\"shareholder\",\"percentage\":\"30\",\"shareholder_id\":\"25\"}],\"booking_money\":[{\"hand\":\"shareholder\",\"percentage\":\"40.5\",\"shareholder_id\":\"25\"}]}', '2022-12-31', 17, '2023-08-30 08:38:16', '2023-08-30 08:38:16'),
(74, 'ad61ab143223efbc24c7d2583be69251', 113, NULL, 25, 500000, '2', 'L', '39', '34', '10', 'emi', '{\"installment\":[{\"hand\":\"shareholder\",\"percentage\":\"25\",\"shareholder_id\":\"25\"}],\"down_payment\":[{\"hand\":\"shareholder\",\"percentage\":\"30\",\"shareholder_id\":\"25\"}],\"booking_money\":[{\"hand\":\"shareholder\",\"percentage\":\"40.5\",\"shareholder_id\":\"25\"}]}', '2022-12-31', 17, '2023-08-30 08:51:05', '2023-08-30 08:51:05'),
(75, 'd09bf41544a3365a46c9077ebb5e35c3', 114, NULL, 25, 600000, '1', 'C', '15', '46', '5', 'emi', '{\"installment\":[{\"hand\":\"shareholder\",\"percentage\":\"25\",\"shareholder_id\":\"25\"}],\"down_payment\":[{\"hand\":\"shareholder\",\"percentage\":\"30\",\"shareholder_id\":\"25\"}],\"booking_money\":[{\"hand\":\"shareholder\",\"percentage\":\"40.5\",\"shareholder_id\":\"25\"}]}', '2022-12-31', 17, '2023-08-30 08:55:26', '2023-08-30 08:55:26'),
(76, 'fbd7939d674997cdb4692d34de8633c4', 115, NULL, 25, 500000, '2', 'O', '30', '26', '3', 'emi', '{\"installment\":[{\"hand\":\"shareholder\",\"percentage\":\"25\",\"shareholder_id\":\"25\"}],\"down_payment\":[{\"hand\":\"shareholder\",\"percentage\":\"30\",\"shareholder_id\":\"25\"}],\"booking_money\":[{\"hand\":\"shareholder\",\"percentage\":\"40.5\",\"shareholder_id\":\"25\"}]}', '2022-12-31', 17, '2023-08-31 07:25:44', '2023-08-31 07:25:44'),
(77, '28dd2c7955ce926456240b2ff0100bde', 116, NULL, 25, 600000, '1', 'C', '12', '48', '5', 'emi', '{\"installment\":[{\"hand\":\"shareholder\",\"percentage\":\"25\",\"shareholder_id\":\"25\"}],\"down_payment\":[{\"hand\":\"shareholder\",\"percentage\":\"30\",\"shareholder_id\":\"25\"}],\"booking_money\":[{\"hand\":\"shareholder\",\"percentage\":\"40.5\",\"shareholder_id\":\"25\"}]}', '2022-12-31', 17, '2023-08-31 07:43:29', '2023-08-31 07:43:29'),
(78, '35f4a8d465e6e1edc05f3d8ab658c551', 117, NULL, 25, 550000, '2', 'O', '30', '34', '3', 'emi', '{\"installment\":[{\"hand\":\"shareholder\",\"percentage\":\"25\",\"shareholder_id\":\"25\"}],\"down_payment\":[{\"hand\":\"shareholder\",\"percentage\":\"30\",\"shareholder_id\":\"25\"}],\"booking_money\":[{\"hand\":\"shareholder\",\"percentage\":\"40.5\",\"shareholder_id\":\"25\"}]}', '2022-12-31', 17, '2023-08-31 07:46:27', '2023-08-31 07:46:27'),
(79, 'd1fe173d08e959397adf34b1d77e88d7', 118, NULL, 25, 500000, '2', 'O', '30', '36', '5', 'emi', '{\"installment\":[{\"hand\":\"shareholder\",\"percentage\":\"25\",\"shareholder_id\":\"25\"}],\"down_payment\":[{\"hand\":\"shareholder\",\"percentage\":\"30\",\"shareholder_id\":\"25\"}],\"booking_money\":[{\"hand\":\"shareholder\",\"percentage\":\"40.5\",\"shareholder_id\":\"25\"}]}', '2022-12-31', 17, '2023-08-31 08:00:00', '2023-08-31 08:00:00'),
(80, 'f033ab37c30201f73f142449d037028d', 119, NULL, 25, 600000, '1', 'B', '9', '2', '10', 'emi', '{\"installment\":[{\"hand\":\"shareholder\",\"percentage\":\"25\",\"shareholder_id\":\"25\"}],\"down_payment\":[{\"hand\":\"shareholder\",\"percentage\":\"30\",\"shareholder_id\":\"25\"}],\"booking_money\":[{\"hand\":\"shareholder\",\"percentage\":\"40.5\",\"shareholder_id\":\"25\"}]}', '2022-12-31', 17, '2023-08-31 08:05:51', '2023-08-31 08:05:51'),
(81, '43ec517d68b6edd3015b3edc9a11367b', 120, NULL, 25, 600000, '1', 'C', '14', '10', '5', 'emi', '{\"installment\":[{\"hand\":\"shareholder\",\"percentage\":\"25\",\"shareholder_id\":\"25\"}],\"down_payment\":[{\"hand\":\"shareholder\",\"percentage\":\"30\",\"shareholder_id\":\"25\"}],\"booking_money\":[{\"hand\":\"shareholder\",\"percentage\":\"40.5\",\"shareholder_id\":\"25\"}]}', '2022-12-31', 17, '2023-08-31 08:27:21', '2023-08-31 08:27:21'),
(82, '9778d5d219c5080b9a6a17bef029331c', 121, NULL, 25, 600000, '1', 'B', '8', '5', '10', 'emi', '{\"installment\":[{\"hand\":\"shareholder\",\"percentage\":\"25\",\"shareholder_id\":\"25\"}],\"down_payment\":[{\"hand\":\"shareholder\",\"percentage\":\"30\",\"shareholder_id\":\"25\"}],\"booking_money\":[{\"hand\":\"shareholder\",\"percentage\":\"40.5\",\"shareholder_id\":\"25\"}]}', '2022-12-31', 17, '2023-08-31 08:30:13', '2023-08-31 08:30:13'),
(83, 'fe9fc289c3ff0af142b6d3bead98a923', 122, NULL, 25, 600000, '1', 'B', '7', '16', '10', 'emi', '{\"installment\":[{\"hand\":\"shareholder\",\"percentage\":\"25\",\"shareholder_id\":\"25\"}],\"down_payment\":[{\"hand\":\"shareholder\",\"percentage\":\"30\",\"shareholder_id\":\"25\"}],\"booking_money\":[{\"hand\":\"shareholder\",\"percentage\":\"40.5\",\"shareholder_id\":\"25\"}]}', '2022-12-31', 17, '2023-08-31 08:37:37', '2023-08-31 08:37:37'),
(84, '68d30a9594728bc39aa24be94b319d21', 123, NULL, 25, 550000, '2', 'O', '30', '48', '3', 'emi', '{\"installment\":[{\"hand\":\"shareholder\",\"percentage\":\"25\",\"shareholder_id\":\"25\"}],\"down_payment\":[{\"hand\":\"shareholder\",\"percentage\":\"30\",\"shareholder_id\":\"25\"}],\"booking_money\":[{\"hand\":\"shareholder\",\"percentage\":\"40.5\",\"shareholder_id\":\"25\"}]}', '2023-02-18', 17, '2023-08-31 08:40:29', '2023-08-31 08:58:43');
INSERT INTO `sales` (`id`, `uuid`, `customer_id`, `agent_id`, `shareholder_id`, `price`, `sector`, `block`, `road`, `plot`, `kata`, `type`, `commission`, `date`, `entry`, `created_at`, `updated_at`) VALUES
(85, '3ef815416f775098fe977004015c6193', 124, NULL, 25, 600000, '1', 'C', '15', '54', '5', 'emi', '{\"installment\":[{\"hand\":\"shareholder\",\"percentage\":\"25\",\"shareholder_id\":\"25\"}],\"down_payment\":[{\"hand\":\"shareholder\",\"percentage\":\"30\",\"shareholder_id\":\"25\"}],\"booking_money\":[{\"hand\":\"shareholder\",\"percentage\":\"40.5\",\"shareholder_id\":\"25\"}]}', '2023-02-23', 17, '2023-08-31 08:45:03', '2023-08-31 08:56:47'),
(86, '93db85ed909c13838ff95ccfa94cebd9', 125, NULL, 25, 600000, '1', 'C', '14', '8', '5', 'emi', '{\"installment\":[{\"hand\":\"shareholder\",\"percentage\":\"25\",\"shareholder_id\":\"25\"}],\"down_payment\":[{\"hand\":\"shareholder\",\"percentage\":\"30\",\"shareholder_id\":\"25\"}],\"booking_money\":[{\"hand\":\"shareholder\",\"percentage\":\"40.5\",\"shareholder_id\":\"25\"}]}', '2023-02-26', 17, '2023-08-31 08:47:45', '2023-08-31 08:56:06'),
(87, 'c7e1249ffc03eb9ded908c236bd1996d', 126, NULL, 25, 600000, '1', 'B', '8', '32', '10', 'cash', '{\"installment\":[{\"hand\":\"shareholder\",\"percentage\":\"25\",\"shareholder_id\":\"25\"}],\"down_payment\":[{\"hand\":\"shareholder\",\"percentage\":\"30\",\"shareholder_id\":\"25\"}],\"booking_money\":[{\"hand\":\"shareholder\",\"percentage\":\"40.5\",\"shareholder_id\":\"25\"}]}', '2023-02-24', 17, '2023-08-31 08:50:36', '2023-08-31 08:55:14'),
(88, '2a38a4a9316c49e5a833517c45d31070', 127, NULL, 25, 600000, '1', 'C', '16', '28', '5', 'emi', '{\"installment\":[{\"hand\":\"shareholder\",\"percentage\":\"25\",\"shareholder_id\":\"25\"}],\"down_payment\":[{\"hand\":\"shareholder\",\"percentage\":\"30\",\"shareholder_id\":\"25\"}],\"booking_money\":[{\"hand\":\"shareholder\",\"percentage\":\"40.5\",\"shareholder_id\":\"25\"}]}', '2023-03-01', 17, '2023-08-31 08:54:00', '2023-08-31 08:54:00'),
(89, '7647966b7343c29048673252e490f736', 128, NULL, 25, 600000, '1', 'B', '9', '24', '10', 'emi', '{\"installment\":[{\"hand\":\"shareholder\",\"percentage\":\"25\",\"shareholder_id\":\"25\"}],\"down_payment\":[{\"hand\":\"shareholder\",\"percentage\":\"30\",\"shareholder_id\":\"25\"}],\"booking_money\":[{\"hand\":\"shareholder\",\"percentage\":\"40.5\",\"shareholder_id\":\"25\"}]}', '2023-02-28', 17, '2023-08-31 09:02:31', '2023-08-31 09:02:31'),
(90, '8613985ec49eb8f757ae6439e879bb2a', 129, NULL, 25, 600000, '1', 'C', '16', '26', '5', 'emi', '{\"installment\":[{\"hand\":\"shareholder\",\"percentage\":\"25\",\"shareholder_id\":\"25\"}],\"down_payment\":[{\"hand\":\"shareholder\",\"percentage\":\"30\",\"shareholder_id\":\"25\"}],\"booking_money\":[{\"hand\":\"shareholder\",\"percentage\":\"40.5\",\"shareholder_id\":\"25\"}]}', '2023-02-28', 17, '2023-08-31 09:06:49', '2023-08-31 09:06:49'),
(91, '54229abfcfa5649e7003b83dd4755294', 130, NULL, 25, 600000, '1', 'B', '8', '15', '10', 'emi', '{\"installment\":[{\"hand\":\"shareholder\",\"percentage\":\"25\",\"shareholder_id\":\"25\"}],\"down_payment\":[{\"hand\":\"shareholder\",\"percentage\":\"30\",\"shareholder_id\":\"25\"}],\"booking_money\":[{\"hand\":\"shareholder\",\"percentage\":\"40.5\",\"shareholder_id\":\"25\"}]}', '2023-08-31', 17, '2023-08-31 09:09:24', '2023-08-31 09:09:24'),
(92, '92cc227532d17e56e07902b254dfad10', 132, NULL, 25, 600000, '2', 'L', '60w/24', '2', '10', 'emi', '{\"installment\":[{\"hand\":\"shareholder\",\"percentage\":\"25\",\"shareholder_id\":\"25\"}],\"down_payment\":[{\"hand\":\"shareholder\",\"percentage\":\"30\",\"shareholder_id\":\"25\"}],\"booking_money\":[{\"hand\":\"shareholder\",\"percentage\":\"40.5\",\"shareholder_id\":\"25\"}]}', '2023-04-15', 17, '2023-08-31 09:13:48', '2023-08-31 09:13:48'),
(93, '98dce83da57b0395e163467c9dae521b', 134, NULL, 25, 600000, '2', 'L', '40', '32', '10', 'emi', '{\"installment\":[{\"hand\":\"shareholder\",\"percentage\":\"25\",\"shareholder_id\":\"25\"}],\"down_payment\":[{\"hand\":\"shareholder\",\"percentage\":\"30\",\"shareholder_id\":\"25\"}],\"booking_money\":[{\"hand\":\"shareholder\",\"percentage\":\"40.5\",\"shareholder_id\":\"25\"}]}', '2023-04-17', 17, '2023-08-31 09:18:48', '2023-08-31 09:18:48'),
(94, 'f4b9ec30ad9f68f89b29639786cb62ef', 135, NULL, 25, 600000, '2', 'L', '40', '30', '10', 'emi', '{\"installment\":[{\"hand\":\"shareholder\",\"percentage\":\"25\",\"shareholder_id\":\"25\"}],\"down_payment\":[{\"hand\":\"shareholder\",\"percentage\":\"30\",\"shareholder_id\":\"25\"}],\"booking_money\":[{\"hand\":\"shareholder\",\"percentage\":\"40.5\",\"shareholder_id\":\"25\"}]}', '2023-04-17', 17, '2023-09-02 06:44:53', '2023-09-02 06:44:53'),
(95, '812b4ba287f5ee0bc9d43bbf5bbe87fb', 136, NULL, 25, 600000, '2', 'L', '40', '28', '10', 'emi', '{\"installment\":[{\"hand\":\"shareholder\",\"percentage\":\"25\",\"shareholder_id\":\"25\"}],\"down_payment\":[{\"hand\":\"shareholder\",\"percentage\":\"30\",\"shareholder_id\":\"25\"}],\"booking_money\":[{\"hand\":\"shareholder\",\"percentage\":\"40.5\",\"shareholder_id\":\"25\"}]}', '2023-04-17', 17, '2023-09-02 06:50:15', '2023-09-02 06:50:15'),
(96, '26657d5ff9020d2abefe558796b99584', 137, NULL, 25, 500000, '1', 'A', '20', 'Ext-2', '5', 'emi', '{\"installment\":[{\"hand\":\"shareholder\",\"percentage\":\"25\",\"shareholder_id\":\"25\"}],\"down_payment\":[{\"hand\":\"shareholder\",\"percentage\":\"30\",\"shareholder_id\":\"25\"}],\"booking_money\":[{\"hand\":\"shareholder\",\"percentage\":\"40.5\",\"shareholder_id\":\"25\"}]}', '2023-04-16', 17, '2023-09-02 07:07:45', '2023-09-02 07:07:45'),
(97, 'e2ef524fbf3d9fe611d5a8e90fefdc9c', 138, NULL, 25, 550000, '2', 'G', '59', '27', '10', 'emi', '{\"installment\":[{\"hand\":\"shareholder\",\"percentage\":\"25\",\"shareholder_id\":\"25\"}],\"down_payment\":[{\"hand\":\"shareholder\",\"percentage\":\"30\",\"shareholder_id\":\"25\"}],\"booking_money\":[{\"hand\":\"shareholder\",\"percentage\":\"40.5\",\"shareholder_id\":\"25\"}]}', '2023-06-07', 17, '2023-09-02 07:13:08', '2023-09-02 07:13:08'),
(98, 'ed3d2c21991e3bef5e069713af9fa6ca', 139, NULL, 25, 500000, '2', 'G', '59', '25', '10', 'emi', '{\"installment\":[{\"hand\":\"shareholder\",\"percentage\":\"25\",\"shareholder_id\":\"25\"}],\"down_payment\":[{\"hand\":\"shareholder\",\"percentage\":\"30\",\"shareholder_id\":\"25\"}],\"booking_money\":[{\"hand\":\"shareholder\",\"percentage\":\"40.5\",\"shareholder_id\":\"25\"}]}', '2023-06-12', 17, '2023-09-02 07:17:03', '2023-09-02 07:17:03'),
(99, 'ac627ab1ccbdb62ec96e702f07f6425b', 140, NULL, 25, 600000, '2', 'G', '58', '26', '10', 'emi', '{\"installment\":[{\"hand\":\"shareholder\",\"percentage\":\"25\",\"shareholder_id\":\"25\"}],\"down_payment\":[{\"hand\":\"shareholder\",\"percentage\":\"30\",\"shareholder_id\":\"25\"}],\"booking_money\":[{\"hand\":\"shareholder\",\"percentage\":\"40.5\",\"shareholder_id\":\"25\"}]}', '2023-06-26', 17, '2023-09-02 07:34:13', '2023-09-02 07:34:13');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `key` varchar(255) NOT NULL,
  `value` text DEFAULT NULL,
  `group_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_details_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL DEFAULT 0,
  `amount` double NOT NULL DEFAULT 0,
  `date` date DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0 COMMENT 'withdraw = 0, cashin = 1',
  `other` text DEFAULT NULL,
  `entry` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `email_verified_at`, `password`, `status`, `remember_token`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'admin@gmail.com', '2023-07-22 18:03:14', '$2y$10$yFSZxg.O/3lmsZBpN5B/QOcft6DGE2txfE.QSojU/Ih4nYfjNYVYu', 1, NULL, '2023-07-22 18:03:14', '2023-07-22 18:03:14', NULL),
(5, 'kaosar85@gmail.com', NULL, '$2y$10$pwbveRp80V52/mfq4oDT/epAekdtYTh3ZSuwYE2n2YEq4Eh4QQ6t.', 1, NULL, '2023-07-24 10:12:03', '2023-07-24 11:31:55', NULL),
(7, 'afrrozanipu19@gmail.com', NULL, '$2y$10$aD3czhpv9P.EIypWv7HZXeoD2ntUE7j/qyCAElh5HGYjEFttv.8pW', 1, NULL, '2023-07-24 11:32:07', '2023-07-24 11:32:19', NULL),
(10, 'Julfiker2@gmail.com', NULL, '$2y$10$.XcsK.qmFYZkkWMNdujXSuC5KbfRZKvMEZiz53LvvAlK9nOD.JpW.', 1, NULL, '2023-08-29 14:43:14', '2023-08-29 14:43:35', NULL),
(11, 'sadek78@gmail.com', NULL, '$2y$10$0WY87cuyff7KnCnoPOIfreCxdmsZ9q0ErkfAw.fL5L1CMJVoKOFIS', 1, NULL, '2023-08-29 14:51:03', '2023-08-29 14:52:28', NULL),
(12, 'sattarppl@gmail.com', NULL, '$2y$10$XxoaQY0dLZJQW92ROGoYveHu5iAFL.rmhJIIP71u0ytMO.vEQAIMu', 1, NULL, '2023-08-29 14:52:08', '2023-08-29 14:52:32', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_details`
--

CREATE TABLE `user_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `account_id` varchar(255) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `phone` varchar(255) NOT NULL,
  `present_address` text DEFAULT NULL,
  `permanent_address` text DEFAULT NULL,
  `emergency_contact` varchar(255) DEFAULT NULL,
  `occupation` varchar(255) DEFAULT NULL,
  `refer_id` bigint(20) UNSIGNED DEFAULT NULL,
  `reference_id` varchar(255) DEFAULT NULL,
  `role` bigint(20) UNSIGNED NOT NULL,
  `parent_name` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL COMMENT 'father name, and mother name',
  `status` tinyint(4) NOT NULL DEFAULT 0,
  `image` varchar(255) DEFAULT NULL,
  `income` double NOT NULL DEFAULT 0 COMMENT 'only agent and shareholder',
  `total_kata` int(11) NOT NULL DEFAULT 0 COMMENT 'only for agent and shareholder',
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_details`
--

INSERT INTO `user_details` (`id`, `account_id`, `name`, `phone`, `present_address`, `permanent_address`, `emergency_contact`, `occupation`, `refer_id`, `reference_id`, `role`, `parent_name`, `status`, `image`, `income`, `total_kata`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 'Gm11111111', 'General Manager', '01222222222', 'present address', 'permanent address', '01222222222', 'General Manager', NULL, NULL, 1, NULL, 0, NULL, 45750, 0, 1, NULL, '2023-07-24 12:21:15'),
(10, 'AcKaosar85@gmail.com', 'Md. Kaosar Amin', '01677599477', NULL, NULL, NULL, NULL, NULL, NULL, 2, NULL, 1, NULL, 0, 0, 5, '2023-07-24 10:12:03', '2023-07-24 11:31:55'),
(17, 'Acafroza81', 'Afroza', '01797773181', NULL, NULL, NULL, NULL, NULL, NULL, 2, NULL, 1, NULL, 0, 0, 7, '2023-07-24 11:32:07', '2023-07-24 11:32:19'),
(23, 'E5347', 'Jilfiker Ali', '01715578056', NULL, NULL, NULL, 'Not Given Yet', NULL, NULL, 3, '{\"father\":null,\"mother\":null}', 1, NULL, 0, 0, 10, '2023-08-29 14:43:14', '2023-08-29 14:48:12'),
(24, 'sadek78', 'Md Sadekur Rahman', '01712533078', NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, 1, NULL, 0, 0, 11, '2023-08-29 14:51:03', '2023-08-29 14:52:28'),
(25, 'sattar60', 'Md Abdus Sattar', '01711946260', NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, 1, NULL, 0, 295, 12, '2023-08-29 14:52:08', '2023-09-02 07:34:13'),
(26, 'Agaklima68', 'Aklima Akter', '01912102268', 'aaa', 'aaa', '01912102268', 'ddd', 24, '24,', 4, '{\"father\":\"ddd\",\"mother\":\"ddd\"}', 1, NULL, 0, 53, NULL, '2023-08-29 14:54:17', '2023-08-29 17:38:32'),
(27, 'Agkaniz606', 'Kaniz Fatema', '01717270606', 'aaa', 'aaa', '01717270606', 'ddd', 26, '26,24,', 4, '{\"father\":\"ddd\",\"mother\":\"ddd\"}', 1, NULL, 0, 86, NULL, '2023-08-29 14:55:10', '2023-08-29 17:28:11'),
(28, 'AgE5088', 'Mohammad Atikur Rahman', '01711870259', 'Malibag', 'Malibag', '00', 'Business', 23, '23,', 4, '{\"father\":\"Mr. A\",\"mother\":\"Mts.\"}', 1, NULL, 0, 251, NULL, '2023-08-29 14:56:04', '2023-08-29 16:46:48');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `attendances`
--
ALTER TABLE `attendances`
  ADD PRIMARY KEY (`id`),
  ADD KEY `attendances_user_detail_id_foreign` (`user_detail_id`);

--
-- Indexes for table `backup_bank_infos`
--
ALTER TABLE `backup_bank_infos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `backup_bank_infos_bank_info_id_foreign` (`bank_info_id`),
  ADD KEY `backup_bank_infos_bank_name_id_foreign` (`bank_name_id`),
  ADD KEY `backup_bank_infos_entry_foreign` (`entry`);

--
-- Indexes for table `backup_bank_transactions`
--
ALTER TABLE `backup_bank_transactions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `backup_bank_transactions_bank_transaction_id_foreign` (`bank_transaction_id`),
  ADD KEY `backup_bank_transactions_bank_info_id_foreign` (`bank_info_id`),
  ADD KEY `backup_bank_transactions_entry_foreign` (`entry`);

--
-- Indexes for table `backup_expenses`
--
ALTER TABLE `backup_expenses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `backup_expenses_expense_id_foreign` (`expense_id`),
  ADD KEY `backup_expenses_expense_item_id_foreign` (`expense_item_id`),
  ADD KEY `backup_expenses_entry_foreign` (`entry`);

--
-- Indexes for table `backup_expense_items`
--
ALTER TABLE `backup_expense_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `backup_expense_items_expense_item_id_foreign` (`expense_item_id`),
  ADD KEY `backup_expense_items_parent_foreign` (`parent`),
  ADD KEY `backup_expense_items_entry_foreign` (`entry`);

--
-- Indexes for table `backup_investments`
--
ALTER TABLE `backup_investments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `backup_investments_investment_id_foreign` (`investment_id`),
  ADD KEY `backup_investments_investor_id_foreign` (`investor_id`),
  ADD KEY `backup_investments_entry_foreign` (`entry`);

--
-- Indexes for table `backup_investment_withdraws`
--
ALTER TABLE `backup_investment_withdraws`
  ADD PRIMARY KEY (`id`),
  ADD KEY `backup_investment_withdraws_investor_id_foreign` (`investor_id`),
  ADD KEY `backup_investment_withdraws_investment_id_foreign` (`investment_id`),
  ADD KEY `backup_investment_withdraws_entry_foreign` (`entry`),
  ADD KEY `backup_investment_withdraws_investment_withdraw_id_foreign` (`investment_withdraw_id`);

--
-- Indexes for table `backup_other_deposits`
--
ALTER TABLE `backup_other_deposits`
  ADD PRIMARY KEY (`id`),
  ADD KEY `backup_other_deposits_other_deposit_id_foreign` (`other_deposit_id`),
  ADD KEY `backup_other_deposits_entry_foreign` (`entry`);

--
-- Indexes for table `backup_payments`
--
ALTER TABLE `backup_payments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `backup_payments_payment_id_foreign` (`payment_id`),
  ADD KEY `backup_payments_sale_id_foreign` (`sale_id`),
  ADD KEY `backup_payments_entry_foreign` (`entry`);

--
-- Indexes for table `backup_salaries`
--
ALTER TABLE `backup_salaries`
  ADD PRIMARY KEY (`id`),
  ADD KEY `backup_salaries_salary_id_foreign` (`salary_id`),
  ADD KEY `backup_salaries_user_detail_id_foreign` (`user_detail_id`),
  ADD KEY `backup_salaries_group_id_foreign` (`group_id`),
  ADD KEY `backup_salaries_type_id_foreign` (`type_id`),
  ADD KEY `backup_salaries_entry_foreign` (`entry`);

--
-- Indexes for table `backup_sales`
--
ALTER TABLE `backup_sales`
  ADD PRIMARY KEY (`id`),
  ADD KEY `backup_sales_sale_id_foreign` (`sale_id`),
  ADD KEY `backup_sales_customer_id_foreign` (`customer_id`),
  ADD KEY `backup_sales_agent_id_foreign` (`agent_id`),
  ADD KEY `backup_sales_shareholder_id_foreign` (`shareholder_id`),
  ADD KEY `backup_sales_entry_foreign` (`entry`);

--
-- Indexes for table `backup_transactions`
--
ALTER TABLE `backup_transactions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `backup_transactions_transaction_id_foreign` (`transaction_id`),
  ADD KEY `backup_transactions_user_details_id_foreign` (`user_details_id`),
  ADD KEY `backup_transactions_entry_foreign` (`entry`);

--
-- Indexes for table `bank_infos`
--
ALTER TABLE `bank_infos`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `bank_infos_account_id_unique` (`account_id`),
  ADD KEY `bank_infos_bank_name_id_foreign` (`bank_name_id`),
  ADD KEY `bank_infos_entry_foreign` (`entry`);

--
-- Indexes for table `bank_names`
--
ALTER TABLE `bank_names`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `bank_names_name_unique` (`name`),
  ADD KEY `bank_names_entry_foreign` (`entry`);

--
-- Indexes for table `bank_transactions`
--
ALTER TABLE `bank_transactions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `bank_transactions_account_id_unique` (`account_id`),
  ADD KEY `bank_transactions_bank_info_id_foreign` (`bank_info_id`),
  ADD KEY `bank_transactions_entry_foreign` (`entry`);

--
-- Indexes for table `commissions`
--
ALTER TABLE `commissions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `commissions_user_details_id_foreign` (`user_details_id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `customers_account_id_unique` (`account_id`),
  ADD UNIQUE KEY `customers_phone_unique` (`phone`),
  ADD KEY `customers_entry_foreign` (`entry`);

--
-- Indexes for table `expenses`
--
ALTER TABLE `expenses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `expenses_expense_item_id_foreign` (`expense_item_id`),
  ADD KEY `expenses_entry_foreign` (`entry`);

--
-- Indexes for table `expense_items`
--
ALTER TABLE `expense_items`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `expense_items_title_unique` (`title`),
  ADD KEY `expense_items_parent_foreign` (`parent`),
  ADD KEY `expense_items_entry_foreign` (`entry`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `investments`
--
ALTER TABLE `investments`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `investments_account_id_unique` (`account_id`),
  ADD KEY `investments_investor_id_foreign` (`investor_id`),
  ADD KEY `investments_entry_foreign` (`entry`);

--
-- Indexes for table `investment_commissions`
--
ALTER TABLE `investment_commissions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `investment_commissions_investment_id_foreign` (`investment_id`),
  ADD KEY `investment_commissions_investor_id_foreign` (`investor_id`);

--
-- Indexes for table `investment_withdraws`
--
ALTER TABLE `investment_withdraws`
  ADD UNIQUE KEY `id` (`id`),
  ADD KEY `investment_withdraws_entry_foreign` (`entry`),
  ADD KEY `investment_withdraws_investor_id_foreign` (`investor_id`),
  ADD KEY `investment_withdraws_investment_id_foreign` (`investment_id`);

--
-- Indexes for table `investors`
--
ALTER TABLE `investors`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `investors_account_id_unique` (`account_id`),
  ADD UNIQUE KEY `investors_phone_unique` (`phone`),
  ADD KEY `investors_role_foreign` (`role`),
  ADD KEY `investors_reference_id_foreign` (`reference_id`);

--
-- Indexes for table `land_purchases`
--
ALTER TABLE `land_purchases`
  ADD PRIMARY KEY (`id`),
  ADD KEY `land_purchases_entry_foreign` (`entry`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `other_deposits`
--
ALTER TABLE `other_deposits`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `other_deposits_account_id_unique` (`account_id`),
  ADD KEY `other_deposits_entry_foreign` (`entry`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `payments_sale_id_foreign` (`sale_id`),
  ADD KEY `payments_entry_foreign` (`entry`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Indexes for table `salaries`
--
ALTER TABLE `salaries`
  ADD PRIMARY KEY (`id`),
  ADD KEY `salaries_user_detail_id_foreign` (`user_detail_id`),
  ADD KEY `salaries_type_id_foreign` (`type_id`),
  ADD KEY `salaries_entry_foreign` (`entry`);

--
-- Indexes for table `salary_types`
--
ALTER TABLE `salary_types`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `salary_types_title_unique` (`title`),
  ADD KEY `salary_types_entry_foreign` (`entry`);

--
-- Indexes for table `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `sales_uuid_unique` (`uuid`),
  ADD KEY `sales_customer_id_foreign` (`customer_id`),
  ADD KEY `sales_agent_id_foreign` (`agent_id`),
  ADD KEY `sales_shareholder_id_foreign` (`shareholder_id`),
  ADD KEY `sales_entry_foreign` (`entry`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `settings_key_unique` (`key`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `transactions_user_details_id_foreign` (`user_details_id`),
  ADD KEY `transactions_entry_foreign` (`entry`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `user_details`
--
ALTER TABLE `user_details`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_details_account_id_unique` (`account_id`),
  ADD KEY `user_details_refer_id_foreign` (`refer_id`),
  ADD KEY `user_details_role_foreign` (`role`),
  ADD KEY `user_details_user_id_foreign` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `attendances`
--
ALTER TABLE `attendances`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `backup_bank_infos`
--
ALTER TABLE `backup_bank_infos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `backup_bank_transactions`
--
ALTER TABLE `backup_bank_transactions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `backup_expenses`
--
ALTER TABLE `backup_expenses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `backup_expense_items`
--
ALTER TABLE `backup_expense_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `backup_investments`
--
ALTER TABLE `backup_investments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `backup_investment_withdraws`
--
ALTER TABLE `backup_investment_withdraws`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `backup_other_deposits`
--
ALTER TABLE `backup_other_deposits`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `backup_payments`
--
ALTER TABLE `backup_payments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `backup_salaries`
--
ALTER TABLE `backup_salaries`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `backup_sales`
--
ALTER TABLE `backup_sales`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `backup_transactions`
--
ALTER TABLE `backup_transactions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `bank_infos`
--
ALTER TABLE `bank_infos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `bank_names`
--
ALTER TABLE `bank_names`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `bank_transactions`
--
ALTER TABLE `bank_transactions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=84;

--
-- AUTO_INCREMENT for table `commissions`
--
ALTER TABLE `commissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=141;

--
-- AUTO_INCREMENT for table `expenses`
--
ALTER TABLE `expenses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;

--
-- AUTO_INCREMENT for table `expense_items`
--
ALTER TABLE `expense_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `investments`
--
ALTER TABLE `investments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `investment_commissions`
--
ALTER TABLE `investment_commissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `investment_withdraws`
--
ALTER TABLE `investment_withdraws`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `investors`
--
ALTER TABLE `investors`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `land_purchases`
--
ALTER TABLE `land_purchases`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `other_deposits`
--
ALTER TABLE `other_deposits`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=84;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `salaries`
--
ALTER TABLE `salaries`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `salary_types`
--
ALTER TABLE `salary_types`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `sales`
--
ALTER TABLE `sales`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=100;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `user_details`
--
ALTER TABLE `user_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `attendances`
--
ALTER TABLE `attendances`
  ADD CONSTRAINT `attendances_user_detail_id_foreign` FOREIGN KEY (`user_detail_id`) REFERENCES `user_details` (`id`);

--
-- Constraints for table `backup_bank_infos`
--
ALTER TABLE `backup_bank_infos`
  ADD CONSTRAINT `backup_bank_infos_bank_info_id_foreign` FOREIGN KEY (`bank_info_id`) REFERENCES `bank_infos` (`id`),
  ADD CONSTRAINT `backup_bank_infos_bank_name_id_foreign` FOREIGN KEY (`bank_name_id`) REFERENCES `bank_names` (`id`),
  ADD CONSTRAINT `backup_bank_infos_entry_foreign` FOREIGN KEY (`entry`) REFERENCES `user_details` (`id`);

--
-- Constraints for table `backup_bank_transactions`
--
ALTER TABLE `backup_bank_transactions`
  ADD CONSTRAINT `backup_bank_transactions_bank_info_id_foreign` FOREIGN KEY (`bank_info_id`) REFERENCES `bank_infos` (`id`),
  ADD CONSTRAINT `backup_bank_transactions_bank_transaction_id_foreign` FOREIGN KEY (`bank_transaction_id`) REFERENCES `bank_transactions` (`id`),
  ADD CONSTRAINT `backup_bank_transactions_entry_foreign` FOREIGN KEY (`entry`) REFERENCES `user_details` (`id`);

--
-- Constraints for table `backup_expenses`
--
ALTER TABLE `backup_expenses`
  ADD CONSTRAINT `backup_expenses_entry_foreign` FOREIGN KEY (`entry`) REFERENCES `user_details` (`id`),
  ADD CONSTRAINT `backup_expenses_expense_id_foreign` FOREIGN KEY (`expense_id`) REFERENCES `expenses` (`id`),
  ADD CONSTRAINT `backup_expenses_expense_item_id_foreign` FOREIGN KEY (`expense_item_id`) REFERENCES `expense_items` (`id`);

--
-- Constraints for table `backup_expense_items`
--
ALTER TABLE `backup_expense_items`
  ADD CONSTRAINT `backup_expense_items_entry_foreign` FOREIGN KEY (`entry`) REFERENCES `user_details` (`id`),
  ADD CONSTRAINT `backup_expense_items_expense_item_id_foreign` FOREIGN KEY (`expense_item_id`) REFERENCES `expense_items` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `backup_expense_items_parent_foreign` FOREIGN KEY (`parent`) REFERENCES `expense_items` (`id`);

--
-- Constraints for table `backup_investments`
--
ALTER TABLE `backup_investments`
  ADD CONSTRAINT `backup_investments_entry_foreign` FOREIGN KEY (`entry`) REFERENCES `user_details` (`id`),
  ADD CONSTRAINT `backup_investments_investment_id_foreign` FOREIGN KEY (`investment_id`) REFERENCES `investments` (`id`),
  ADD CONSTRAINT `backup_investments_investor_id_foreign` FOREIGN KEY (`investor_id`) REFERENCES `investors` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `backup_investment_withdraws`
--
ALTER TABLE `backup_investment_withdraws`
  ADD CONSTRAINT `backup_investment_withdraws_entry_foreign` FOREIGN KEY (`entry`) REFERENCES `user_details` (`id`),
  ADD CONSTRAINT `backup_investment_withdraws_investment_id_foreign` FOREIGN KEY (`investment_id`) REFERENCES `investments` (`id`),
  ADD CONSTRAINT `backup_investment_withdraws_investment_withdraw_id_foreign` FOREIGN KEY (`investment_withdraw_id`) REFERENCES `investment_withdraws` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `backup_investment_withdraws_investor_id_foreign` FOREIGN KEY (`investor_id`) REFERENCES `investors` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `backup_other_deposits`
--
ALTER TABLE `backup_other_deposits`
  ADD CONSTRAINT `backup_other_deposits_entry_foreign` FOREIGN KEY (`entry`) REFERENCES `user_details` (`id`),
  ADD CONSTRAINT `backup_other_deposits_other_deposit_id_foreign` FOREIGN KEY (`other_deposit_id`) REFERENCES `other_deposits` (`id`);

--
-- Constraints for table `backup_payments`
--
ALTER TABLE `backup_payments`
  ADD CONSTRAINT `backup_payments_entry_foreign` FOREIGN KEY (`entry`) REFERENCES `user_details` (`id`),
  ADD CONSTRAINT `backup_payments_payment_id_foreign` FOREIGN KEY (`payment_id`) REFERENCES `payments` (`id`),
  ADD CONSTRAINT `backup_payments_sale_id_foreign` FOREIGN KEY (`sale_id`) REFERENCES `sales` (`id`);

--
-- Constraints for table `backup_salaries`
--
ALTER TABLE `backup_salaries`
  ADD CONSTRAINT `backup_salaries_entry_foreign` FOREIGN KEY (`entry`) REFERENCES `user_details` (`id`),
  ADD CONSTRAINT `backup_salaries_group_id_foreign` FOREIGN KEY (`group_id`) REFERENCES `salaries` (`id`),
  ADD CONSTRAINT `backup_salaries_salary_id_foreign` FOREIGN KEY (`salary_id`) REFERENCES `salaries` (`id`),
  ADD CONSTRAINT `backup_salaries_type_id_foreign` FOREIGN KEY (`type_id`) REFERENCES `salary_types` (`id`),
  ADD CONSTRAINT `backup_salaries_user_detail_id_foreign` FOREIGN KEY (`user_detail_id`) REFERENCES `user_details` (`id`);

--
-- Constraints for table `backup_sales`
--
ALTER TABLE `backup_sales`
  ADD CONSTRAINT `backup_sales_agent_id_foreign` FOREIGN KEY (`agent_id`) REFERENCES `user_details` (`id`),
  ADD CONSTRAINT `backup_sales_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`),
  ADD CONSTRAINT `backup_sales_entry_foreign` FOREIGN KEY (`entry`) REFERENCES `user_details` (`id`),
  ADD CONSTRAINT `backup_sales_sale_id_foreign` FOREIGN KEY (`sale_id`) REFERENCES `sales` (`id`),
  ADD CONSTRAINT `backup_sales_shareholder_id_foreign` FOREIGN KEY (`shareholder_id`) REFERENCES `user_details` (`id`);

--
-- Constraints for table `backup_transactions`
--
ALTER TABLE `backup_transactions`
  ADD CONSTRAINT `backup_transactions_entry_foreign` FOREIGN KEY (`entry`) REFERENCES `user_details` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `backup_transactions_transaction_id_foreign` FOREIGN KEY (`transaction_id`) REFERENCES `transactions` (`id`),
  ADD CONSTRAINT `backup_transactions_user_details_id_foreign` FOREIGN KEY (`user_details_id`) REFERENCES `user_details` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `bank_infos`
--
ALTER TABLE `bank_infos`
  ADD CONSTRAINT `bank_infos_bank_name_id_foreign` FOREIGN KEY (`bank_name_id`) REFERENCES `bank_names` (`id`),
  ADD CONSTRAINT `bank_infos_entry_foreign` FOREIGN KEY (`entry`) REFERENCES `user_details` (`id`);

--
-- Constraints for table `bank_names`
--
ALTER TABLE `bank_names`
  ADD CONSTRAINT `bank_names_entry_foreign` FOREIGN KEY (`entry`) REFERENCES `user_details` (`id`);

--
-- Constraints for table `bank_transactions`
--
ALTER TABLE `bank_transactions`
  ADD CONSTRAINT `bank_transactions_bank_info_id_foreign` FOREIGN KEY (`bank_info_id`) REFERENCES `bank_infos` (`id`),
  ADD CONSTRAINT `bank_transactions_entry_foreign` FOREIGN KEY (`entry`) REFERENCES `user_details` (`id`);

--
-- Constraints for table `commissions`
--
ALTER TABLE `commissions`
  ADD CONSTRAINT `commissions_user_details_id_foreign` FOREIGN KEY (`user_details_id`) REFERENCES `user_details` (`id`);

--
-- Constraints for table `customers`
--
ALTER TABLE `customers`
  ADD CONSTRAINT `customers_entry_foreign` FOREIGN KEY (`entry`) REFERENCES `user_details` (`id`);

--
-- Constraints for table `expenses`
--
ALTER TABLE `expenses`
  ADD CONSTRAINT `expenses_entry_foreign` FOREIGN KEY (`entry`) REFERENCES `user_details` (`id`),
  ADD CONSTRAINT `expenses_expense_item_id_foreign` FOREIGN KEY (`expense_item_id`) REFERENCES `expense_items` (`id`);

--
-- Constraints for table `expense_items`
--
ALTER TABLE `expense_items`
  ADD CONSTRAINT `expense_items_entry_foreign` FOREIGN KEY (`entry`) REFERENCES `user_details` (`id`),
  ADD CONSTRAINT `expense_items_parent_foreign` FOREIGN KEY (`parent`) REFERENCES `expense_items` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `investments`
--
ALTER TABLE `investments`
  ADD CONSTRAINT `investments_entry_foreign` FOREIGN KEY (`entry`) REFERENCES `user_details` (`id`),
  ADD CONSTRAINT `investments_investor_id_foreign` FOREIGN KEY (`investor_id`) REFERENCES `investors` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `investment_commissions`
--
ALTER TABLE `investment_commissions`
  ADD CONSTRAINT `investment_commissions_investment_id_foreign` FOREIGN KEY (`investment_id`) REFERENCES `investments` (`id`),
  ADD CONSTRAINT `investment_commissions_investor_id_foreign` FOREIGN KEY (`investor_id`) REFERENCES `investors` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `investment_withdraws`
--
ALTER TABLE `investment_withdraws`
  ADD CONSTRAINT `investment_withdraws_entry_foreign` FOREIGN KEY (`entry`) REFERENCES `user_details` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `investment_withdraws_investment_id_foreign` FOREIGN KEY (`investment_id`) REFERENCES `investments` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `investment_withdraws_investor_id_foreign` FOREIGN KEY (`investor_id`) REFERENCES `investors` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `investors`
--
ALTER TABLE `investors`
  ADD CONSTRAINT `investors_reference_id_foreign` FOREIGN KEY (`reference_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `investors_role_foreign` FOREIGN KEY (`role`) REFERENCES `roles` (`id`);

--
-- Constraints for table `land_purchases`
--
ALTER TABLE `land_purchases`
  ADD CONSTRAINT `land_purchases_entry_foreign` FOREIGN KEY (`entry`) REFERENCES `user_details` (`id`);

--
-- Constraints for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `other_deposits`
--
ALTER TABLE `other_deposits`
  ADD CONSTRAINT `other_deposits_entry_foreign` FOREIGN KEY (`entry`) REFERENCES `user_details` (`id`);

--
-- Constraints for table `payments`
--
ALTER TABLE `payments`
  ADD CONSTRAINT `payments_entry_foreign` FOREIGN KEY (`entry`) REFERENCES `user_details` (`id`),
  ADD CONSTRAINT `payments_sale_id_foreign` FOREIGN KEY (`sale_id`) REFERENCES `sales` (`id`);

--
-- Constraints for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `salaries`
--
ALTER TABLE `salaries`
  ADD CONSTRAINT `salaries_entry_foreign` FOREIGN KEY (`entry`) REFERENCES `user_details` (`id`),
  ADD CONSTRAINT `salaries_type_id_foreign` FOREIGN KEY (`type_id`) REFERENCES `salary_types` (`id`),
  ADD CONSTRAINT `salaries_user_detail_id_foreign` FOREIGN KEY (`user_detail_id`) REFERENCES `user_details` (`id`);

--
-- Constraints for table `salary_types`
--
ALTER TABLE `salary_types`
  ADD CONSTRAINT `salary_types_entry_foreign` FOREIGN KEY (`entry`) REFERENCES `user_details` (`id`);

--
-- Constraints for table `sales`
--
ALTER TABLE `sales`
  ADD CONSTRAINT `sales_agent_id_foreign` FOREIGN KEY (`agent_id`) REFERENCES `user_details` (`id`),
  ADD CONSTRAINT `sales_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`),
  ADD CONSTRAINT `sales_entry_foreign` FOREIGN KEY (`entry`) REFERENCES `user_details` (`id`),
  ADD CONSTRAINT `sales_shareholder_id_foreign` FOREIGN KEY (`shareholder_id`) REFERENCES `user_details` (`id`);

--
-- Constraints for table `transactions`
--
ALTER TABLE `transactions`
  ADD CONSTRAINT `transactions_entry_foreign` FOREIGN KEY (`entry`) REFERENCES `user_details` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `transactions_user_details_id_foreign` FOREIGN KEY (`user_details_id`) REFERENCES `user_details` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `user_details`
--
ALTER TABLE `user_details`
  ADD CONSTRAINT `user_details_refer_id_foreign` FOREIGN KEY (`refer_id`) REFERENCES `user_details` (`id`),
  ADD CONSTRAINT `user_details_role_foreign` FOREIGN KEY (`role`) REFERENCES `roles` (`id`),
  ADD CONSTRAINT `user_details_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
