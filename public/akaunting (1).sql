-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 06, 2020 at 03:05 PM
-- Server version: 10.4.8-MariaDB
-- PHP Version: 7.3.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `akaunting`
--

-- --------------------------------------------------------

--
-- Table structure for table `iqj_accounts`
--

CREATE TABLE `iqj_accounts` (
  `id` int(10) UNSIGNED NOT NULL,
  `company_id` int(11) NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `number` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `currency_code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `opening_balance` double(15,4) NOT NULL DEFAULT 0.0000,
  `bank_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bank_phone` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bank_address` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `enabled` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `iqj_accounts`
--

INSERT INTO `iqj_accounts` (`id`, `company_id`, `name`, `number`, `currency_code`, `opening_balance`, `bank_name`, `bank_phone`, `bank_address`, `enabled`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 'Cash', '1', 'USD', 0.0000, 'Cash', NULL, NULL, 1, '2020-05-13 04:29:57', '2020-05-13 04:29:57', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `iqj_bills`
--

CREATE TABLE `iqj_bills` (
  `id` int(10) UNSIGNED NOT NULL,
  `company_id` int(11) NOT NULL,
  `bill_number` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `order_number` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `billed_at` datetime NOT NULL,
  `due_at` datetime NOT NULL,
  `amount` double(15,4) NOT NULL,
  `currency_code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `currency_rate` double(15,8) NOT NULL,
  `category_id` int(11) NOT NULL DEFAULT 1,
  `contact_id` int(11) NOT NULL,
  `contact_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contact_email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contact_tax_number` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contact_phone` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contact_address` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `notes` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `parent_id` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `iqj_bills`
--

INSERT INTO `iqj_bills` (`id`, `company_id`, `bill_number`, `order_number`, `status`, `billed_at`, `due_at`, `amount`, `currency_code`, `currency_rate`, `category_id`, `contact_id`, `contact_name`, `contact_email`, `contact_tax_number`, `contact_phone`, `contact_address`, `notes`, `parent_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 'BIL-00001', '45344343', 'partial', '2020-06-02 12:58:02', '2020-06-03 12:58:02', 20.4000, 'USD', 1.00000000, 4, 66, 'Demo vendor', 'vendor@email.com', '3434', NULL, 'Demo Address', 'eww', 0, '2020-06-02 06:58:02', '2020-06-02 06:59:00', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `iqj_bill_histories`
--

CREATE TABLE `iqj_bill_histories` (
  `id` int(10) UNSIGNED NOT NULL,
  `company_id` int(11) NOT NULL,
  `bill_id` int(11) NOT NULL,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notify` tinyint(1) NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `iqj_bill_histories`
--

INSERT INTO `iqj_bill_histories` (`id`, `company_id`, `bill_id`, `status`, `notify`, `description`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 1, 'draft', 0, 'BIL-00001 added!', '2020-06-02 06:58:03', '2020-06-02 06:58:03', NULL),
(2, 1, 1, 'partial', 0, '$20.00 Payment', '2020-06-02 06:59:00', '2020-06-02 06:59:00', NULL),
(3, 1, 1, 'partial', 0, '$0.40 Payment', '2020-06-02 06:59:42', '2020-06-02 06:59:42', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `iqj_bill_items`
--

CREATE TABLE `iqj_bill_items` (
  `id` int(10) UNSIGNED NOT NULL,
  `company_id` int(11) NOT NULL,
  `bill_id` int(11) NOT NULL,
  `item_id` int(11) DEFAULT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sku` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `quantity` double(7,2) NOT NULL,
  `price` double(15,4) NOT NULL,
  `total` double(15,4) NOT NULL,
  `tax` double(15,4) NOT NULL DEFAULT 0.0000,
  `discount_rate` double(15,4) NOT NULL DEFAULT 0.0000,
  `discount_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'normal',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `iqj_bill_items`
--

INSERT INTO `iqj_bill_items` (`id`, `company_id`, `bill_id`, `item_id`, `name`, `sku`, `quantity`, `price`, `total`, `tax`, `discount_rate`, `discount_type`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 1, 3, 'Web Services', NULL, 1.00, 20.0000, 20.0000, 0.4000, 0.0000, 'normal', '2020-06-02 06:58:02', '2020-06-02 06:58:02', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `iqj_bill_item_taxes`
--

CREATE TABLE `iqj_bill_item_taxes` (
  `id` int(10) UNSIGNED NOT NULL,
  `company_id` int(11) NOT NULL,
  `bill_id` int(11) NOT NULL,
  `bill_item_id` int(11) NOT NULL,
  `tax_id` int(11) NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` double(15,4) NOT NULL DEFAULT 0.0000,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `iqj_bill_item_taxes`
--

INSERT INTO `iqj_bill_item_taxes` (`id`, `company_id`, `bill_id`, `bill_item_id`, `tax_id`, `name`, `amount`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 1, 1, 1, 'Example', 0.4000, '2020-06-02 06:58:02', '2020-06-02 06:58:02', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `iqj_bill_totals`
--

CREATE TABLE `iqj_bill_totals` (
  `id` int(10) UNSIGNED NOT NULL,
  `company_id` int(11) NOT NULL,
  `bill_id` int(11) NOT NULL,
  `code` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` double(15,4) NOT NULL,
  `sort_order` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `iqj_bill_totals`
--

INSERT INTO `iqj_bill_totals` (`id`, `company_id`, `bill_id`, `code`, `name`, `amount`, `sort_order`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 1, 'sub_total', 'bills.sub_total', 20.0000, 1, '2020-06-02 06:58:03', '2020-06-02 06:58:03', NULL),
(2, 1, 1, 'tax', 'Example', 0.4000, 2, '2020-06-02 06:58:03', '2020-06-02 06:58:03', NULL),
(3, 1, 1, 'total', 'bills.total', 20.4000, 3, '2020-06-02 06:58:03', '2020-06-02 06:58:03', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `iqj_categories`
--

CREATE TABLE `iqj_categories` (
  `id` int(10) UNSIGNED NOT NULL,
  `company_id` int(11) NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `color` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `enabled` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `iqj_categories`
--

INSERT INTO `iqj_categories` (`id`, `company_id`, `name`, `type`, `color`, `enabled`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 'Transfer', 'other', '#3c3f72', 1, '2020-05-13 04:29:58', '2020-05-13 04:29:58', NULL),
(2, 1, 'Deposit', 'income', '#efad32', 1, '2020-05-13 04:29:58', '2020-05-13 04:29:58', NULL),
(3, 1, 'Sales', 'income', '#6da252', 1, '2020-05-13 04:29:58', '2020-05-13 04:29:58', NULL),
(4, 1, 'Other', 'expense', '#e5e5e5', 1, '2020-05-13 04:29:58', '2020-05-13 04:29:58', NULL),
(5, 1, 'General', 'item', '#328aef', 1, '2020-05-13 04:29:58', '2020-05-13 04:29:58', NULL),
(6, 1, 'dsfdf', 'income', '#55588b', 1, '2020-05-18 00:43:55', '2020-05-18 00:43:55', NULL),
(7, 1, 'sam', 'expense', '#55588b', 1, '2020-05-30 10:23:08', '2020-05-30 10:23:08', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `iqj_companies`
--

CREATE TABLE `iqj_companies` (
  `id` int(10) UNSIGNED NOT NULL,
  `domain` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `enabled` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `iqj_companies`
--

INSERT INTO `iqj_companies` (`id`, `domain`, `enabled`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, '', 1, '2020-05-13 04:29:57', '2020-05-13 04:29:57', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `iqj_contacts`
--

CREATE TABLE `iqj_contacts` (
  `id` int(10) UNSIGNED NOT NULL,
  `company_id` int(11) NOT NULL,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `tax_number` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `website` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `currency_code` varchar(3) COLLATE utf8mb4_unicode_ci NOT NULL,
  `enabled` tinyint(1) NOT NULL,
  `reference` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `iqj_contacts`
--

INSERT INTO `iqj_contacts` (`id`, `company_id`, `type`, `name`, `email`, `user_id`, `tax_number`, `phone`, `address`, `website`, `currency_code`, `enabled`, `reference`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 'customer', 'Demo Customer', 'mr.user.nishan@gmail.com', NULL, '12233', NULL, 'Master Para\nMaijdee bazer', NULL, 'USD', 1, NULL, '2020-05-13 05:31:59', '2020-05-14 01:28:41', '2020-05-14 01:28:41'),
(2, 1, 'customer', 'Example', 'iotait@gmail.com', NULL, '3413', NULL, 'sd', NULL, 'USD', 1, NULL, '2020-05-14 01:23:22', '2020-05-14 01:28:41', '2020-05-14 01:28:41'),
(3, 1, 'customer', 'Example', 'mishan@gmail.com', NULL, '23', NULL, NULL, NULL, 'USD', 1, NULL, '2020-05-14 01:26:32', '2020-05-14 01:28:41', '2020-05-14 01:28:41'),
(4, 1, 'customer', 'Example', 'omor.iotait@gmail.com', NULL, '1443', NULL, '134134', NULL, 'USD', 1, NULL, '2020-05-14 01:32:04', '2020-05-14 02:04:10', '2020-05-14 02:04:10'),
(5, 1, 'customer', 'Skin care men', 'iotait@gmail.com', NULL, '22', NULL, NULL, NULL, 'USD', 1, NULL, '2020-05-14 01:33:17', '2020-05-14 02:04:10', '2020-05-14 02:04:10'),
(6, 1, 'customer', 'Example', 'iotait@gmail.com', NULL, '11', NULL, NULL, NULL, 'USD', 1, NULL, '2020-05-14 02:04:30', '2020-05-14 02:28:53', '2020-05-14 02:28:53'),
(7, 1, 'customer', 'Example category', 'mr.user.nishan@gmail.com', NULL, '123', NULL, NULL, NULL, 'USD', 1, NULL, '2020-05-14 02:26:26', '2020-05-14 02:28:53', '2020-05-14 02:28:53'),
(8, 1, 'customer', 'Example category', 'iotait@gmail.com', NULL, '4123', NULL, NULL, NULL, 'USD', 1, NULL, '2020-05-14 02:29:14', '2020-05-14 02:38:40', '2020-05-14 02:38:40'),
(9, 1, 'customer', 'Example', 'mr.user.nishan@gmail.com', NULL, '11', NULL, NULL, NULL, 'USD', 1, NULL, '2020-05-14 02:36:51', '2020-05-14 02:38:40', '2020-05-14 02:38:40'),
(10, 1, 'customer', 'owner', 'omor.iffotait@gmail.com', NULL, '2343', NULL, NULL, NULL, 'USD', 1, NULL, '2020-05-14 02:37:52', '2020-05-14 02:38:40', '2020-05-14 02:38:40'),
(11, 1, 'customer', 'Example', 'iotait@gmail.com', NULL, '11', NULL, NULL, NULL, 'USD', 1, NULL, '2020-05-14 02:39:53', '2020-05-14 02:48:23', '2020-05-14 02:48:23'),
(12, 1, 'customer', 'Skin care men', 'superadmin@email.com', NULL, '22', NULL, NULL, NULL, 'USD', 1, NULL, '2020-05-14 02:43:21', '2020-05-14 02:48:23', '2020-05-14 02:48:23'),
(13, 1, 'customer', 'Example category', 'omor.iotait@gmail.comss', NULL, '11', NULL, NULL, NULL, 'USD', 1, NULL, '2020-05-14 02:47:07', '2020-05-14 02:48:23', '2020-05-14 02:48:23'),
(14, 1, 'customer', 'Example', 'iotait@gmail.com', NULL, '2', NULL, NULL, NULL, 'USD', 1, NULL, '2020-05-14 02:53:00', '2020-05-14 03:23:26', '2020-05-14 03:23:26'),
(15, 1, 'customer', 'Example category', 'iotadit@gmail.com', NULL, '2', NULL, NULL, NULL, 'USD', 1, NULL, '2020-05-14 03:12:11', '2020-05-14 03:23:26', '2020-05-14 03:23:26'),
(16, 1, 'customer', 'Skin care men', 'superadmin@email.comss', NULL, '11', NULL, NULL, NULL, 'USD', 1, NULL, '2020-05-14 03:14:52', '2020-05-14 03:23:26', '2020-05-14 03:23:26'),
(17, 1, 'customer', 'adsf dsdd', 'iotfdfait@gmail.com', NULL, '23213', NULL, NULL, NULL, 'USD', 1, NULL, '2020-05-14 03:16:49', '2020-05-14 03:23:26', '2020-05-14 03:23:26'),
(18, 1, 'customer', 'Example', 'iotait@gmail.com', NULL, '11', NULL, NULL, NULL, 'USD', 1, NULL, '2020-05-14 03:24:46', '2020-05-14 04:43:34', '2020-05-14 04:43:34'),
(19, 1, 'customer', 'Example cateewegory', 'iotasssit@gmail.com', NULL, '2ewqewq', NULL, NULL, NULL, 'USD', 1, NULL, '2020-05-14 03:31:14', '2020-05-14 04:43:34', '2020-05-14 04:43:34'),
(20, 1, 'customer', 'Example cvczcvategory', 'omvcvor.iotait@gmail.com', NULL, 'qwewe', NULL, NULL, NULL, 'USD', 1, NULL, '2020-05-14 03:43:22', '2020-05-14 04:43:34', '2020-05-14 04:43:34'),
(21, 1, 'customer', 'asdfasdfsdfsdfa', 'iotdafssdfdsfait@gmail.com', NULL, '12341234', NULL, NULL, NULL, 'USD', 1, NULL, '2020-05-14 04:31:15', '2020-05-14 04:43:34', '2020-05-14 04:43:34'),
(22, 1, 'customer', 'dfasdf', 'admidfassdfn@email.com', NULL, 'qweqw', NULL, NULL, NULL, 'USD', 1, NULL, '2020-05-14 04:31:57', '2020-05-14 04:43:34', '2020-05-14 04:43:34'),
(23, 1, 'customer', 'czxbzxzzx', 'czx@gmail.comz', NULL, 'rewqer', NULL, NULL, NULL, 'USD', 1, NULL, '2020-05-14 04:34:00', '2020-05-14 04:43:34', '2020-05-14 04:43:34'),
(24, 1, 'customer', 'asdfsdfa', 'sdsdain@email.com', NULL, 'afdsdfs', NULL, NULL, NULL, 'USD', 1, NULL, '2020-05-14 04:40:57', '2020-05-14 04:43:34', '2020-05-14 04:43:34'),
(25, 1, 'customer', 'Example category', 'sd@gmail.com', NULL, '32234', NULL, NULL, NULL, 'USD', 1, NULL, '2020-05-14 04:50:56', '2020-05-14 05:14:48', '2020-05-14 05:14:48'),
(26, 1, 'customer', 'zjkxcbvjkxcbv', 'icxvxcvzcvotait@gmail.com', NULL, '41334', NULL, NULL, NULL, 'USD', 1, NULL, '2020-05-14 05:00:02', '2020-05-14 05:14:48', '2020-05-14 05:14:48'),
(27, 1, 'customer', 'sdsd', 'a@b.com', NULL, '122332', '1232123', NULL, NULL, 'USD', 1, NULL, '2020-05-14 05:21:23', '2020-05-15 23:12:34', '2020-05-15 23:12:34'),
(28, 1, 'customer', 'Example', 'omoddr.iotait@gmail.com', NULL, '22', NULL, 'sddssd', NULL, 'USD', 1, NULL, '2020-05-14 05:34:58', '2020-05-15 23:12:34', '2020-05-15 23:12:34'),
(29, 1, 'customer', 'demo', 'demo@email.com', NULL, '41231342', NULL, 'asdfsdfad', NULL, 'EUR', 1, NULL, '2020-05-14 05:39:39', '2020-05-15 23:12:34', '2020-05-15 23:12:34'),
(30, 1, 'customer', 'Example category', 'omor.iotait@gmail.com', NULL, 'qqwwq', NULL, NULL, NULL, 'USD', 1, NULL, '2020-05-14 05:43:01', '2020-05-15 23:12:34', '2020-05-15 23:12:34'),
(31, 1, 'customer', 'Last', 'lastiotait@gmail.com', NULL, '412423', NULL, 'dsgsfgddf g', NULL, 'GBP', 1, NULL, '2020-05-14 06:02:47', '2020-05-15 23:12:34', '2020-05-15 23:12:34'),
(32, 1, 'customer', 'Exaadfssdfmple', 'iotafddfit@gmail.com', NULL, 'qweqwer', NULL, NULL, NULL, 'USD', 1, NULL, '2020-05-14 07:03:11', '2020-05-15 23:12:34', '2020-05-15 23:12:34'),
(33, 1, 'customer', 'ASDASDSD', 'asasas@gmail.comass', NULL, 'sa', NULL, NULL, NULL, 'USD', 1, NULL, '2020-05-14 07:04:53', '2020-05-15 23:12:34', '2020-05-15 23:12:34'),
(34, 1, 'customer', 'hfgsdf', 'iodfgssdfgfsdvtait@gmail.com', NULL, 'fdasdf', NULL, NULL, NULL, 'USD', 1, NULL, '2020-05-14 08:33:19', '2020-05-15 23:12:34', '2020-05-15 23:12:34'),
(35, 1, 'customer', 'fgsddfsvcx', 'admxcvcvcvin@email.com', NULL, 'sddfs', NULL, NULL, NULL, 'USD', 1, NULL, '2020-05-14 10:05:53', '2020-05-15 23:12:34', '2020-05-15 23:12:34'),
(36, 1, 'customer', 'xcxcx', 'ixcxcxotait@gmail.com', NULL, 'xzxc', NULL, NULL, NULL, 'USD', 1, NULL, '2020-05-14 10:08:40', '2020-05-15 23:12:34', '2020-05-15 23:12:34'),
(37, 1, 'customer', 'Demo Customer', 'addsdsmin@email.com', NULL, '14223', NULL, NULL, NULL, 'USD', 1, NULL, '2020-05-14 12:14:00', '2020-05-15 23:12:34', '2020-05-15 23:12:34'),
(38, 1, 'customer', 'owner', 'sss@sss.com', NULL, '11', NULL, 'dddd', NULL, 'GBP', 1, NULL, '2020-05-14 12:15:45', '2020-05-15 23:12:34', '2020-05-15 23:12:34'),
(39, 1, 'customer', 'ggtyu', NULL, NULL, NULL, NULL, NULL, NULL, 'USD', 1, NULL, '2020-05-14 12:16:29', '2020-05-15 23:12:34', '2020-05-15 23:12:34'),
(40, 1, 'customer', 'Demo Customer', 'customer@email.com', NULL, '4231342', NULL, 'Bangladesh', NULL, 'BBD', 1, NULL, '2020-05-15 23:05:42', '2020-05-15 23:12:34', '2020-05-15 23:12:34'),
(41, 1, 'customer', 'Demo Customer', 'customer@email.com', NULL, '1323', NULL, NULL, NULL, 'USD', 1, NULL, '2020-05-15 23:14:09', '2020-05-17 08:51:12', '2020-05-17 08:51:12'),
(42, 1, 'customer', 'adfdf', 'admadfin@email.com', NULL, 'wqeweq', NULL, NULL, NULL, 'USD', 1, NULL, '2020-05-16 06:07:47', '2020-05-17 08:51:12', '2020-05-17 08:51:12'),
(43, 1, 'customer', 'sdasasasdas', 'iotaisdast@gmail.coms', NULL, '22', NULL, NULL, NULL, 'USD', 1, NULL, '2020-05-16 09:50:10', '2020-05-17 08:51:12', '2020-05-17 08:51:12'),
(44, 1, 'customer', 'dsfsdsdsdsdfsdf', 'sdffffffffffffffff@gmail.com', NULL, '3qewe', NULL, NULL, NULL, 'USD', 1, NULL, '2020-05-17 01:27:16', '2020-05-17 08:51:12', '2020-05-17 08:51:12'),
(45, 1, 'customer', 'Example category', 'adxccmin@email.com', NULL, 'qwweqwe', NULL, 'czx', NULL, 'USD', 1, NULL, '2020-05-17 01:42:25', '2020-05-17 08:51:12', '2020-05-17 08:51:12'),
(46, 1, 'customer', 'Skin care men', 'asdsdasdasdasdasd@email.com', NULL, NULL, NULL, NULL, NULL, 'USD', 1, NULL, '2020-05-17 01:47:52', '2020-05-17 08:51:12', '2020-05-17 08:51:12'),
(47, 1, 'customer', 'Exampldfsdfase category', 'admagfafgadgsdgin@email.com', NULL, NULL, NULL, NULL, NULL, 'USD', 1, NULL, '2020-05-17 02:13:39', '2020-05-17 08:51:12', '2020-05-17 08:51:12'),
(48, 1, 'customer', 'ownerxcxc', 'omor.cciotait@gmail.com', NULL, NULL, NULL, NULL, NULL, 'USD', 1, NULL, '2020-05-17 06:34:25', '2020-05-17 08:51:12', '2020-05-17 08:51:12'),
(49, 1, 'customer', 'Test_station_Prefix', 'advdadvxmin@email.com', NULL, NULL, NULL, NULL, NULL, 'USD', 1, NULL, '2020-05-17 07:10:14', '2020-05-17 08:51:12', '2020-05-17 08:51:12'),
(50, 1, 'customer', 'Demo Customer', 'customer@email.com', NULL, '13434', NULL, NULL, NULL, 'USD', 1, NULL, '2020-05-17 08:51:57', '2020-05-17 23:16:16', '2020-05-17 23:16:16'),
(51, 1, 'customer', 'owner', 'owner@email.com', NULL, '132', NULL, NULL, NULL, 'USD', 1, NULL, '2020-05-17 22:24:56', '2020-05-17 23:16:16', '2020-05-17 23:16:16'),
(52, 1, 'customer', 'Example category', 'adxxmin@email.com', NULL, '123', NULL, NULL, NULL, 'USD', 1, NULL, '2020-05-17 22:25:36', '2020-05-17 23:16:16', '2020-05-17 23:16:16'),
(53, 1, 'customer', 'Test_station_Prefix', 'supesradmin@email.com', NULL, NULL, NULL, NULL, NULL, 'USD', 1, NULL, '2020-05-17 22:26:28', '2020-05-17 23:16:16', '2020-05-17 23:16:16'),
(54, 1, 'customer', 'Skin care men', 'admxxxxin@email.com', NULL, NULL, NULL, NULL, NULL, 'USD', 1, NULL, '2020-05-17 22:41:26', '2020-05-17 23:16:16', '2020-05-17 23:16:16'),
(55, 1, 'customer', 'asdfdfsa', 'admhfagadfin@email.com', NULL, NULL, NULL, NULL, NULL, 'USD', 1, NULL, '2020-05-17 22:42:11', '2020-05-17 23:16:16', '2020-05-17 23:16:16'),
(56, 1, 'customer', 'kldvkcvklcklckl', 'iokasdfhjsdfta@gmail.com', NULL, NULL, NULL, NULL, NULL, 'USD', 1, NULL, '2020-05-17 23:10:44', '2020-05-17 23:16:16', '2020-05-17 23:16:16'),
(57, 1, 'customer', 'Example', 'admin@email.com', NULL, NULL, NULL, NULL, NULL, 'USD', 1, NULL, '2020-05-17 23:17:21', '2020-05-20 05:33:02', NULL),
(58, 1, 'customer', 'owner', 'iotaxxit@gmail.com', NULL, NULL, NULL, NULL, NULL, 'USD', 1, NULL, '2020-05-17 23:20:35', '2020-06-01 09:59:26', '2020-06-01 09:59:26'),
(59, 1, 'customer', 'Example category', 'omor.iotait@gmail.com', NULL, NULL, NULL, NULL, NULL, 'USD', 1, NULL, '2020-05-17 23:23:43', '2020-05-17 23:23:43', NULL),
(60, 1, 'customer', 'Test_station_Prefix', 'mr.user.nishan@gmail.com', NULL, NULL, NULL, NULL, NULL, 'USD', 1, NULL, '2020-05-17 23:24:57', '2020-06-01 09:59:26', '2020-06-01 09:59:26'),
(61, 1, 'customer', 'sdfsdfdf', 'iodfsdfsdfdfta@gmail.com', NULL, NULL, NULL, NULL, NULL, 'USD', 1, NULL, '2020-05-17 23:28:12', '2020-06-01 09:59:26', '2020-06-01 09:59:26'),
(62, 1, 'customer', 'jkasdf;jkasdvn;jkasdn;jksdvn', 'hasdfjkhjlin@email.com', NULL, NULL, NULL, NULL, NULL, 'USD', 1, NULL, '2020-05-17 23:35:14', '2020-06-01 09:59:26', '2020-06-01 09:59:26'),
(63, 1, 'vendor', 'vvzcxcvx', 'admin@email.com', NULL, NULL, NULL, NULL, NULL, 'USD', 1, NULL, '2020-05-17 23:36:55', '2020-05-17 23:36:55', NULL),
(64, 1, 'customer', 'sdsdfdf', 'addfssdfmin@email.com', NULL, NULL, NULL, NULL, NULL, 'USD', 1, NULL, '2020-05-18 01:53:44', '2020-06-01 09:59:26', '2020-06-01 09:59:26'),
(65, 1, 'customer', 'Example', 'admrerrerin@email.com', NULL, '123432', NULL, NULL, NULL, 'USD', 1, NULL, '2020-05-28 07:38:27', '2020-06-01 09:59:26', '2020-06-01 09:59:26'),
(66, 1, 'vendor', 'Demo vendor', 'vendor@email.com', NULL, '3434', NULL, 'Demo Address', NULL, 'USD', 1, NULL, '2020-06-02 06:56:42', '2020-06-02 06:56:42', NULL),
(67, 1, 'customer', 'Demo Customer', 'customer@email.com', NULL, '4334', NULL, 'erewq', NULL, 'USD', 1, NULL, '2020-06-02 07:01:28', '2020-06-02 07:01:28', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `iqj_currencies`
--

CREATE TABLE `iqj_currencies` (
  `id` int(10) UNSIGNED NOT NULL,
  `company_id` int(11) NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `rate` double(15,8) NOT NULL,
  `precision` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `symbol` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `symbol_first` int(11) NOT NULL DEFAULT 1,
  `decimal_mark` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `thousands_separator` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `enabled` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `iqj_currencies`
--

INSERT INTO `iqj_currencies` (`id`, `company_id`, `name`, `code`, `rate`, `precision`, `symbol`, `symbol_first`, `decimal_mark`, `thousands_separator`, `enabled`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 'US Dollar', 'USD', 1.00000000, '2', '$', 1, '.', ',', 1, '2020-05-13 04:29:58', '2020-05-13 04:29:58', NULL),
(2, 1, 'Euro', 'EUR', 1.25000000, '2', '€', 1, ',', '.', 1, '2020-05-13 04:29:58', '2020-05-13 04:29:58', NULL),
(3, 1, 'British Pound', 'GBP', 1.60000000, '2', '£', 1, '.', ',', 1, '2020-05-13 04:29:58', '2020-05-13 04:29:58', NULL),
(4, 1, 'Turkish Lira', 'TRY', 0.80000000, '2', '₺', 1, ',', '.', 1, '2020-05-13 04:29:58', '2020-05-13 04:29:58', NULL),
(5, 1, 'taka', 'BDT', 0.00000000, '2', '৳', 1, '.', ',', 1, '2020-05-13 23:27:48', '2020-05-13 23:27:48', NULL),
(6, 1, 'taka', 'BBD', 0.00000000, '2', '$', 0, '.', ',', 1, '2020-05-14 04:53:01', '2020-05-14 04:53:01', NULL),
(7, 1, 'Pound', 'FKP', 0.00000000, '2', '£', 0, '.', ',', 1, '2020-05-17 09:04:37', '2020-05-17 09:04:37', NULL),
(8, 1, 'jhjh', 'AFN', 56.00000000, '2', '؋', 0, '.', ',', 1, '2020-05-17 09:15:12', '2020-05-17 09:15:12', NULL),
(9, 1, 'demo', 'AED', 22.00000000, '2', 'د.إ', 1, '.', ',', 1, '2020-05-18 00:07:25', '2020-05-18 00:07:25', NULL),
(10, 1, 'Demo Curency', 'CDF', 23.00000000, '2', 'Fr', 0, '.', ',', 1, '2020-05-18 00:32:44', '2020-05-18 00:32:44', NULL),
(11, 1, 'currency', 'BAM', 212.00000000, '2', 'КМ', 1, '.', ',', 1, '2020-05-18 00:38:00', '2020-05-18 00:38:00', NULL),
(12, 1, 'dssd', 'ALL', 20.00000000, '2', 'L', 0, '.', ',', 1, '2020-05-18 01:54:11', '2020-05-18 01:54:11', NULL),
(13, 1, 'Example category', 'ANG', 2.00000000, '2', 'ƒ', 1, ',', '.', 1, '2020-05-18 01:59:35', '2020-05-18 01:59:35', NULL),
(14, 1, 'poisha', 'AZN', 8.00000000, '2', '₼', 1, '.', ',', 1, '2020-05-18 03:54:02', '2020-05-18 03:54:02', NULL),
(15, 1, 'owner', 'AOA', 123.00000000, '2', 'Kz', 0, '.', ',', 1, '2020-05-18 04:02:41', '2020-05-18 04:02:41', NULL),
(16, 1, 'adfds', 'BHD', 32.00000000, '3', 'ب.د', 1, '.', ',', 1, '2020-05-18 04:53:24', '2020-05-18 04:53:24', NULL),
(17, 1, 'demo', 'BWP', 2.00000000, '2', 'P', 1, '.', ',', 1, '2020-05-30 07:12:22', '2020-05-30 07:12:22', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `iqj_dashboards`
--

CREATE TABLE `iqj_dashboards` (
  `id` int(10) UNSIGNED NOT NULL,
  `company_id` int(11) NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `enabled` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `iqj_dashboards`
--

INSERT INTO `iqj_dashboards` (`id`, `company_id`, `name`, `enabled`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 'Dashboard', 1, '2020-05-13 04:30:02', '2020-05-13 04:30:02', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `iqj_email_templates`
--

CREATE TABLE `iqj_email_templates` (
  `id` int(10) UNSIGNED NOT NULL,
  `company_id` int(11) NOT NULL,
  `alias` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `class` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `subject` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `body` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `params` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `iqj_email_templates`
--

INSERT INTO `iqj_email_templates` (`id`, `company_id`, `alias`, `class`, `name`, `subject`, `body`, `params`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 'invoice_new_customer', 'App\\Notifications\\Sale\\Invoice', 'settings.email.templates.invoice_new_customer', '{invoice_number} invoice created', 'Dear {customer_name},<br /><br />We have prepared the following invoice for you: <strong>{invoice_number}</strong>.<br /><br />You can see the invoice details and proceed with the payment from the following link: <a href=\"{invoice_guest_link}\">{invoice_number}</a>.<br /><br />Feel free to contact us for any question.<br /><br />Best Regards,<br />{company_name}', NULL, '2020-05-13 04:29:58', '2020-05-13 04:29:58', NULL),
(2, 1, 'invoice_remind_customer', 'App\\Notifications\\Sale\\Invoice', 'settings.email.templates.invoice_remind_customer', '{invoice_number} invoice overdue notice', 'Dear {customer_name},<br /><br />This is an overdue notice for <strong>{invoice_number}</strong> invoice.<br /><br />The invoice total is {invoice_total} and was due <strong>{invoice_due_date}</strong>.<br /><br />You can see the invoice details and proceed with the payment from the following link: <a href=\"{invoice_guest_link}\">{invoice_number}</a>.<br /><br />Best Regards,<br />{company_name}', NULL, '2020-05-13 04:29:58', '2020-05-13 04:29:58', NULL),
(3, 1, 'invoice_remind_admin', 'App\\Notifications\\Sale\\Invoice', 'settings.email.templates.invoice_remind_admin', '{invoice_number} invoice overdue notice', 'Hello,<br /><br />{customer_name} has received an overdue notice for <strong>{invoice_number}</strong> invoice.<br /><br />The invoice total is {invoice_total} and was due <strong>{invoice_due_date}</strong>.<br /><br />You can see the invoice details from the following link: <a href=\"{invoice_admin_link}\">{invoice_number}</a>.<br /><br />Best Regards,<br />{company_name}', NULL, '2020-05-13 04:29:59', '2020-05-13 04:29:59', NULL),
(4, 1, 'invoice_recur_customer', 'App\\Notifications\\Sale\\Invoice', 'settings.email.templates.invoice_recur_customer', '{invoice_number} recurring invoice created', 'Dear {customer_name},<br /><br />Based on your recurring circle, we have prepared the following invoice for you: <strong>{invoice_number}</strong>.<br /><br />You can see the invoice details and proceed with the payment from the following link: <a href=\"{invoice_guest_link}\">{invoice_number}</a>.<br /><br />Feel free to contact us for any question.<br /><br />Best Regards,<br />{company_name}', NULL, '2020-05-13 04:29:59', '2020-05-13 04:29:59', NULL),
(5, 1, 'invoice_recur_admin', 'App\\Notifications\\Sale\\Invoice', 'settings.email.templates.invoice_recur_admin', '{invoice_number} recurring invoice created', 'Hello,<br /><br />Based on {customer_name} recurring circle, <strong>{invoice_number}</strong> invoice has been automatically created.<br /><br />You can see the invoice details from the following link: <a href=\"{invoice_admin_link}\">{invoice_number}</a>.<br /><br />Best Regards,<br />{company_name}', NULL, '2020-05-13 04:29:59', '2020-05-13 04:29:59', NULL),
(6, 1, 'invoice_payment_customer', 'App\\Notifications\\Portal\\PaymentReceived', 'settings.email.templates.invoice_payment_customer', 'Payment received for {invoice_number} invoice', 'Dear {customer_name},<br /><br />Thank you for the payment. Find the payment details below:<br /><br />-------------------------------------------------<br />Amount: <strong>{transaction_total}</strong><br />Date: <strong>{transaction_paid_date}</strong><br />Invoice Number: <strong>{invoice_number}</strong><br />-------------------------------------------------<br /><br />You can always see the invoice details from the following link: <a href=\"{invoice_guest_link}\">{invoice_number}</a>.<br /><br />Feel free to contact us for any question.<br /><br />Best Regards,<br />{company_name}', NULL, '2020-05-13 04:29:59', '2020-05-13 04:29:59', NULL),
(7, 1, 'invoice_payment_admin', 'App\\Notifications\\Portal\\PaymentReceived', 'settings.email.templates.invoice_payment_admin', 'Payment received for {invoice_number} invoice', 'Hello,<br /><br />{customer_name} recorded a payment for <strong>{invoice_number}</strong> invoice.<br /><br />You can see the invoice details from the following link: <a href=\"{invoice_admin_link}\">{invoice_number}</a>.<br /><br />Best Regards,<br />{company_name}', NULL, '2020-05-13 04:29:59', '2020-05-13 04:29:59', NULL),
(8, 1, 'bill_remind_admin', 'App\\Notifications\\Purchase\\Bill', 'settings.email.templates.bill_remind_admin', '{bill_number} bill reminding notice', 'Hello,<br /><br />This is a reminding notice for <strong>{bill_number}</strong> bill to {vendor_name}.<br /><br />The bill total is {bill_total} and is due <strong>{bill_due_date}</strong>.<br /><br />You can see the bill details from the following link: <a href=\"{bill_admin_link}\">{bill_number}</a>.<br /><br />Best Regards,<br />{company_name}', NULL, '2020-05-13 04:29:59', '2020-05-13 04:29:59', NULL),
(9, 1, 'bill_recur_admin', 'App\\Notifications\\Purchase\\Bill', 'settings.email.templates.bill_recur_admin', '{bill_number} recurring bill created', 'Hello,<br /><br />Based on {vendor_name} recurring circle, <strong>{bill_number}</strong> invoice has been automatically created.<br /><br />You can see the bill details from the following link: <a href=\"{bill_admin_link}\">{bill_number}</a>.<br /><br />Best Regards,<br />{company_name}', NULL, '2020-05-13 04:29:59', '2020-05-13 04:29:59', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `iqj_failed_jobs`
--

CREATE TABLE `iqj_failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `iqj_firewall_ips`
--

CREATE TABLE `iqj_firewall_ips` (
  `id` int(10) UNSIGNED NOT NULL,
  `ip` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `log_id` int(11) DEFAULT NULL,
  `blocked` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `iqj_firewall_logs`
--

CREATE TABLE `iqj_firewall_logs` (
  `id` int(10) UNSIGNED NOT NULL,
  `ip` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `level` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'medium',
  `middleware` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `url` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `referrer` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `request` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `iqj_firewall_logs`
--

INSERT INTO `iqj_firewall_logs` (`id`, `ip`, `level`, `middleware`, `user_id`, `url`, `referrer`, `request`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, '::1', 'medium', 'login', 0, 'http://localhost/Akaunting_update/auth/login', 'http://localhost/Akaunting_update/auth/login', '_token=2iAqfTubj0n86n3gRSyGZBIWA92rOe4gzdSeBUbH&email=customer@email.com&password=******', '2020-05-30 03:41:11', '2020-05-30 03:41:11', NULL),
(2, '::1', 'medium', 'login', 0, 'http://localhost/Akaunting_update/auth/login', 'http://localhost/Akaunting_update/auth/login', '_token=2iAqfTubj0n86n3gRSyGZBIWA92rOe4gzdSeBUbH&email=customer@email.com&password=******', '2020-05-30 03:41:40', '2020-05-30 03:41:40', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `iqj_invoices`
--

CREATE TABLE `iqj_invoices` (
  `id` int(10) UNSIGNED NOT NULL,
  `company_id` int(11) NOT NULL,
  `invoice_number` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `order_number` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `invoiced_at` datetime NOT NULL,
  `due_at` datetime NOT NULL,
  `amount` double(15,4) NOT NULL,
  `currency_code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `currency_rate` double(15,8) NOT NULL,
  `category_id` int(11) NOT NULL DEFAULT 1,
  `contact_id` int(11) NOT NULL,
  `contact_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contact_email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contact_tax_number` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contact_phone` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contact_address` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `notes` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `footer` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `parent_id` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `iqj_invoices`
--

INSERT INTO `iqj_invoices` (`id`, `company_id`, `invoice_number`, `order_number`, `status`, `invoiced_at`, `due_at`, `amount`, `currency_code`, `currency_rate`, `category_id`, `contact_id`, `contact_name`, `contact_email`, `contact_tax_number`, `contact_phone`, `contact_address`, `notes`, `footer`, `parent_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 'INV-00001', '45344343', 'paid', '2020-05-23 15:51:45', '2020-05-30 15:51:45', 12.2400, 'USD', 1.00000000, 2, 57, 'Example', 'admin@email.com', NULL, NULL, NULL, NULL, NULL, 0, '2020-05-23 09:51:45', '2020-05-23 10:20:00', NULL),
(2, 1, 'INV-00002', '1234234', 'paid', '2020-06-02 13:02:18', '2020-06-03 13:02:18', 51.0000, 'USD', 1.00000000, 3, 67, 'Demo Customer', 'customer@email.com', '4334', NULL, 'erewq', 'qerqerw', 'qerwqwer', 0, '2020-06-02 07:02:18', '2020-06-02 07:02:29', NULL),
(3, 1, 'INV-00003', '34134431234', 'paid', '2020-06-03 05:49:03', '2020-06-05 05:49:03', 51.0000, 'USD', 1.00000000, 2, 67, 'Demo Customer', 'customer@email.com', '4334', NULL, 'erewq', 'asdhfjkasdhfjkhasdfjk', 'adfjjkhadhsfjkhasdfk', 0, '2020-06-02 23:49:03', '2020-06-02 23:49:16', NULL),
(4, 1, 'INV-00004', '12343434121234', 'paid', '2020-06-04 07:27:50', '2020-06-05 07:27:50', 30.6000, 'USD', 1.00000000, 6, 67, 'Demo Customer', 'customer@email.com', '4334', NULL, 'erewq', 'ddd', 'ddd', 0, '2020-06-04 01:27:50', '2020-06-04 01:28:35', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `iqj_invoice_histories`
--

CREATE TABLE `iqj_invoice_histories` (
  `id` int(10) UNSIGNED NOT NULL,
  `company_id` int(11) NOT NULL,
  `invoice_id` int(11) NOT NULL,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notify` tinyint(1) NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `iqj_invoice_histories`
--

INSERT INTO `iqj_invoice_histories` (`id`, `company_id`, `invoice_id`, `status`, `notify`, `description`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 1, 'draft', 0, 'INV-00001 added!', '2020-05-23 09:51:45', '2020-05-23 09:51:45', NULL),
(2, 1, 1, 'paid', 0, 'د.إ12.24 Payment', '2020-05-23 10:20:00', '2020-05-23 10:20:00', NULL),
(3, 1, 2, 'draft', 0, 'INV-00002 added!', '2020-06-02 07:02:18', '2020-06-02 07:02:18', NULL),
(4, 1, 2, 'paid', 0, '$51.00 Payment', '2020-06-02 07:02:29', '2020-06-02 07:02:29', NULL),
(5, 1, 3, 'draft', 0, 'INV-00003 added!', '2020-06-02 23:49:03', '2020-06-02 23:49:03', NULL),
(6, 1, 3, 'paid', 0, '$51.00 Payment', '2020-06-02 23:49:16', '2020-06-02 23:49:16', NULL),
(7, 1, 4, 'draft', 0, 'INV-00004 added!', '2020-06-04 01:27:51', '2020-06-04 01:27:51', NULL),
(8, 1, 4, 'paid', 0, '$30.60 Payment', '2020-06-04 01:28:35', '2020-06-04 01:28:35', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `iqj_invoice_items`
--

CREATE TABLE `iqj_invoice_items` (
  `id` int(10) UNSIGNED NOT NULL,
  `company_id` int(11) NOT NULL,
  `invoice_id` int(11) NOT NULL,
  `item_id` int(11) DEFAULT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sku` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `quantity` double(7,2) NOT NULL,
  `price` double(15,4) NOT NULL,
  `total` double(15,4) NOT NULL,
  `tax` double(15,4) NOT NULL DEFAULT 0.0000,
  `discount_rate` double(15,4) NOT NULL DEFAULT 0.0000,
  `discount_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'normal',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `iqj_invoice_items`
--

INSERT INTO `iqj_invoice_items` (`id`, `company_id`, `invoice_id`, `item_id`, `name`, `sku`, `quantity`, `price`, `total`, `tax`, `discount_rate`, `discount_type`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 1, 2, 'Demo', NULL, 1.00, 12.0000, 12.0000, 0.2400, 0.0000, 'normal', '2020-05-23 09:51:45', '2020-05-23 09:51:45', NULL),
(2, 1, 2, 3, 'Web Services', NULL, 1.00, 50.0000, 50.0000, 1.0000, 0.0000, 'normal', '2020-06-02 07:02:18', '2020-06-02 07:02:18', NULL),
(3, 1, 3, 3, 'Web Services', NULL, 1.00, 50.0000, 50.0000, 1.0000, 0.0000, 'normal', '2020-06-02 23:49:03', '2020-06-02 23:49:03', NULL),
(4, 1, 4, 3, 'Web Services', NULL, 1.00, 30.0000, 30.0000, 0.6000, 0.0000, 'normal', '2020-06-04 01:27:50', '2020-06-04 01:27:50', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `iqj_invoice_item_taxes`
--

CREATE TABLE `iqj_invoice_item_taxes` (
  `id` int(10) UNSIGNED NOT NULL,
  `company_id` int(11) NOT NULL,
  `invoice_id` int(11) NOT NULL,
  `invoice_item_id` int(11) NOT NULL,
  `tax_id` int(11) NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` double(15,4) NOT NULL DEFAULT 0.0000,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `iqj_invoice_item_taxes`
--

INSERT INTO `iqj_invoice_item_taxes` (`id`, `company_id`, `invoice_id`, `invoice_item_id`, `tax_id`, `name`, `amount`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 1, 1, 1, 'Example', 0.2400, '2020-05-23 09:51:45', '2020-05-23 09:51:45', NULL),
(2, 1, 2, 2, 1, 'Example', 1.0000, '2020-06-02 07:02:18', '2020-06-02 07:02:18', NULL),
(3, 1, 3, 3, 1, 'Example', 1.0000, '2020-06-02 23:49:03', '2020-06-02 23:49:03', NULL),
(4, 1, 4, 4, 1, 'Example', 0.6000, '2020-06-04 01:27:50', '2020-06-04 01:27:50', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `iqj_invoice_totals`
--

CREATE TABLE `iqj_invoice_totals` (
  `id` int(10) UNSIGNED NOT NULL,
  `company_id` int(11) NOT NULL,
  `invoice_id` int(11) NOT NULL,
  `code` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` double(15,4) NOT NULL,
  `sort_order` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `iqj_invoice_totals`
--

INSERT INTO `iqj_invoice_totals` (`id`, `company_id`, `invoice_id`, `code`, `name`, `amount`, `sort_order`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 1, 'sub_total', 'invoices.sub_total', 12.0000, 1, '2020-05-23 09:51:45', '2020-05-23 09:51:45', NULL),
(2, 1, 1, 'tax', 'Example', 0.2400, 2, '2020-05-23 09:51:45', '2020-05-23 09:51:45', NULL),
(3, 1, 1, 'total', 'invoices.total', 12.2400, 3, '2020-05-23 09:51:45', '2020-05-23 09:51:45', NULL),
(4, 1, 2, 'sub_total', 'invoices.sub_total', 50.0000, 1, '2020-06-02 07:02:18', '2020-06-02 07:02:18', NULL),
(5, 1, 2, 'tax', 'Example', 1.0000, 2, '2020-06-02 07:02:18', '2020-06-02 07:02:18', NULL),
(6, 1, 2, 'total', 'invoices.total', 51.0000, 3, '2020-06-02 07:02:18', '2020-06-02 07:02:18', NULL),
(7, 1, 3, 'sub_total', 'invoices.sub_total', 50.0000, 1, '2020-06-02 23:49:03', '2020-06-02 23:49:03', NULL),
(8, 1, 3, 'tax', 'Example', 1.0000, 2, '2020-06-02 23:49:03', '2020-06-02 23:49:03', NULL),
(9, 1, 3, 'total', 'invoices.total', 51.0000, 3, '2020-06-02 23:49:03', '2020-06-02 23:49:03', NULL),
(10, 1, 4, 'sub_total', 'invoices.sub_total', 30.0000, 1, '2020-06-04 01:27:50', '2020-06-04 01:27:50', NULL),
(11, 1, 4, 'tax', 'Example', 0.6000, 2, '2020-06-04 01:27:50', '2020-06-04 01:27:50', NULL),
(12, 1, 4, 'total', 'invoices.total', 30.6000, 3, '2020-06-04 01:27:50', '2020-06-04 01:27:50', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `iqj_items`
--

CREATE TABLE `iqj_items` (
  `id` int(10) UNSIGNED NOT NULL,
  `company_id` int(11) NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sku` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sale_price` double(15,4) NOT NULL,
  `purchase_price` double(15,4) NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT 1,
  `category_id` int(11) DEFAULT NULL,
  `tax_id` int(11) DEFAULT NULL,
  `enabled` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `iqj_items`
--

INSERT INTO `iqj_items` (`id`, `company_id`, `name`, `sku`, `description`, `sale_price`, `purchase_price`, `quantity`, `category_id`, `tax_id`, `enabled`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 'xxx', NULL, NULL, 0.0000, 0.0000, 1, NULL, NULL, 0, '2020-05-18 00:44:18', '2020-05-20 04:42:23', NULL),
(2, 1, 'Demo', NULL, NULL, 0.0000, 0.0000, 1, NULL, NULL, 1, '2020-05-23 09:51:24', '2020-05-23 09:51:24', NULL),
(3, 1, 'Web Services', NULL, NULL, 0.0000, 0.0000, 1, NULL, NULL, 1, '2020-06-02 06:57:32', '2020-06-02 06:57:32', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `iqj_jobs`
--

CREATE TABLE `iqj_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `iqj_media`
--

CREATE TABLE `iqj_media` (
  `id` int(10) UNSIGNED NOT NULL,
  `disk` varchar(32) COLLATE utf8mb4_unicode_ci NOT NULL,
  `directory` varchar(68) COLLATE utf8mb4_unicode_ci NOT NULL,
  `filename` varchar(121) COLLATE utf8mb4_unicode_ci NOT NULL,
  `extension` varchar(28) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mime_type` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL,
  `aggregate_type` varchar(32) COLLATE utf8mb4_unicode_ci NOT NULL,
  `size` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `iqj_mediables`
--

CREATE TABLE `iqj_mediables` (
  `media_id` int(10) UNSIGNED NOT NULL,
  `mediable_type` varchar(152) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mediable_id` int(10) UNSIGNED NOT NULL,
  `tag` varchar(68) COLLATE utf8mb4_unicode_ci NOT NULL,
  `order` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `iqj_migrations`
--

CREATE TABLE `iqj_migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `iqj_migrations`
--

INSERT INTO `iqj_migrations` (`id`, `migration`, `batch`) VALUES
(1, '2017_09_14_000000_core_v1', 1),
(2, '2020_01_08_000000_core_v200', 1),
(3, '2020_03_20_183732_core_v208', 1);

-- --------------------------------------------------------

--
-- Table structure for table `iqj_modules`
--

CREATE TABLE `iqj_modules` (
  `id` int(10) UNSIGNED NOT NULL,
  `company_id` int(11) NOT NULL,
  `alias` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `enabled` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `iqj_modules`
--

INSERT INTO `iqj_modules` (`id`, `company_id`, `alias`, `enabled`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 'offline-payments', 1, '2020-05-13 04:29:59', '2020-05-13 04:29:59', NULL),
(2, 1, 'paypal-standard', 1, '2020-05-13 04:30:00', '2020-05-13 04:30:00', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `iqj_module_histories`
--

CREATE TABLE `iqj_module_histories` (
  `id` int(10) UNSIGNED NOT NULL,
  `company_id` int(11) NOT NULL,
  `module_id` int(11) NOT NULL,
  `category` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `version` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `iqj_module_histories`
--

INSERT INTO `iqj_module_histories` (`id`, `company_id`, `module_id`, `category`, `version`, `description`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 1, 'payment-method', '2.0.0', 'offline-payments installed', '2020-05-13 04:29:59', '2020-05-13 04:29:59', NULL),
(2, 1, 2, 'payment-method', '2.0.0', 'paypal-standard installed', '2020-05-13 04:30:00', '2020-05-13 04:30:00', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `iqj_notifications`
--

CREATE TABLE `iqj_notifications` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notifiable_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notifiable_id` bigint(20) UNSIGNED NOT NULL,
  `data` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `read_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `iqj_password_resets`
--

CREATE TABLE `iqj_password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `iqj_permissions`
--

CREATE TABLE `iqj_permissions` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `iqj_permissions`
--

INSERT INTO `iqj_permissions` (`id`, `name`, `display_name`, `description`, `created_at`, `updated_at`) VALUES
(1, 'read-admin-panel', 'Read Admin Panel', 'Read Admin Panel', '2020-05-13 04:28:27', '2020-05-13 04:28:27'),
(2, 'read-api', 'Read Api', 'Read Api', '2020-05-13 04:28:28', '2020-05-13 04:28:28'),
(3, 'create-auth-permissions', 'Create Auth Permissions', 'Create Auth Permissions', '2020-05-13 04:28:28', '2020-05-13 04:28:28'),
(4, 'read-auth-permissions', 'Read Auth Permissions', 'Read Auth Permissions', '2020-05-13 04:28:28', '2020-05-13 04:28:28'),
(5, 'update-auth-permissions', 'Update Auth Permissions', 'Update Auth Permissions', '2020-05-13 04:28:28', '2020-05-13 04:28:28'),
(6, 'delete-auth-permissions', 'Delete Auth Permissions', 'Delete Auth Permissions', '2020-05-13 04:28:28', '2020-05-13 04:28:28'),
(7, 'read-auth-profile', 'Read Auth Profile', 'Read Auth Profile', '2020-05-13 04:28:29', '2020-05-13 04:28:29'),
(8, 'update-auth-profile', 'Update Auth Profile', 'Update Auth Profile', '2020-05-13 04:28:29', '2020-05-13 04:28:29'),
(9, 'create-auth-roles', 'Create Auth Roles', 'Create Auth Roles', '2020-05-13 04:28:29', '2020-05-13 04:28:29'),
(10, 'read-auth-roles', 'Read Auth Roles', 'Read Auth Roles', '2020-05-13 04:28:29', '2020-05-13 04:28:29'),
(11, 'update-auth-roles', 'Update Auth Roles', 'Update Auth Roles', '2020-05-13 04:28:29', '2020-05-13 04:28:29'),
(12, 'delete-auth-roles', 'Delete Auth Roles', 'Delete Auth Roles', '2020-05-13 04:28:29', '2020-05-13 04:28:29'),
(13, 'create-auth-users', 'Create Auth Users', 'Create Auth Users', '2020-05-13 04:28:29', '2020-05-13 04:28:29'),
(14, 'read-auth-users', 'Read Auth Users', 'Read Auth Users', '2020-05-13 04:28:30', '2020-05-13 04:28:30'),
(15, 'update-auth-users', 'Update Auth Users', 'Update Auth Users', '2020-05-13 04:28:30', '2020-05-13 04:28:30'),
(16, 'delete-auth-users', 'Delete Auth Users', 'Delete Auth Users', '2020-05-13 04:28:30', '2020-05-13 04:28:30'),
(17, 'create-banking-accounts', 'Create Banking Accounts', 'Create Banking Accounts', '2020-05-13 04:28:30', '2020-05-13 04:28:30'),
(18, 'read-banking-accounts', 'Read Banking Accounts', 'Read Banking Accounts', '2020-05-13 04:28:30', '2020-05-13 04:28:30'),
(19, 'update-banking-accounts', 'Update Banking Accounts', 'Update Banking Accounts', '2020-05-13 04:28:30', '2020-05-13 04:28:30'),
(20, 'delete-banking-accounts', 'Delete Banking Accounts', 'Delete Banking Accounts', '2020-05-13 04:28:30', '2020-05-13 04:28:30'),
(21, 'create-banking-reconciliations', 'Create Banking Reconciliations', 'Create Banking Reconciliations', '2020-05-13 04:28:31', '2020-05-13 04:28:31'),
(22, 'read-banking-reconciliations', 'Read Banking Reconciliations', 'Read Banking Reconciliations', '2020-05-13 04:28:31', '2020-05-13 04:28:31'),
(23, 'update-banking-reconciliations', 'Update Banking Reconciliations', 'Update Banking Reconciliations', '2020-05-13 04:28:31', '2020-05-13 04:28:31'),
(24, 'delete-banking-reconciliations', 'Delete Banking Reconciliations', 'Delete Banking Reconciliations', '2020-05-13 04:28:31', '2020-05-13 04:28:31'),
(25, 'create-banking-transactions', 'Create Banking Transactions', 'Create Banking Transactions', '2020-05-13 04:28:31', '2020-05-13 04:28:31'),
(26, 'read-banking-transactions', 'Read Banking Transactions', 'Read Banking Transactions', '2020-05-13 04:28:31', '2020-05-13 04:28:31'),
(27, 'update-banking-transactions', 'Update Banking Transactions', 'Update Banking Transactions', '2020-05-13 04:28:31', '2020-05-13 04:28:31'),
(28, 'delete-banking-transactions', 'Delete Banking Transactions', 'Delete Banking Transactions', '2020-05-13 04:28:32', '2020-05-13 04:28:32'),
(29, 'create-banking-transfers', 'Create Banking Transfers', 'Create Banking Transfers', '2020-05-13 04:28:32', '2020-05-13 04:28:32'),
(30, 'read-banking-transfers', 'Read Banking Transfers', 'Read Banking Transfers', '2020-05-13 04:28:32', '2020-05-13 04:28:32'),
(31, 'update-banking-transfers', 'Update Banking Transfers', 'Update Banking Transfers', '2020-05-13 04:28:32', '2020-05-13 04:28:32'),
(32, 'delete-banking-transfers', 'Delete Banking Transfers', 'Delete Banking Transfers', '2020-05-13 04:28:32', '2020-05-13 04:28:32'),
(33, 'create-common-companies', 'Create Common Companies', 'Create Common Companies', '2020-05-13 04:28:32', '2020-05-13 04:28:32'),
(34, 'read-common-companies', 'Read Common Companies', 'Read Common Companies', '2020-05-13 04:28:33', '2020-05-13 04:28:33'),
(35, 'update-common-companies', 'Update Common Companies', 'Update Common Companies', '2020-05-13 04:28:33', '2020-05-13 04:28:33'),
(36, 'delete-common-companies', 'Delete Common Companies', 'Delete Common Companies', '2020-05-13 04:28:33', '2020-05-13 04:28:33'),
(37, 'create-common-dashboards', 'Create Common Dashboards', 'Create Common Dashboards', '2020-05-13 04:28:33', '2020-05-13 04:28:33'),
(38, 'read-common-dashboards', 'Read Common Dashboards', 'Read Common Dashboards', '2020-05-13 04:28:33', '2020-05-13 04:28:33'),
(39, 'update-common-dashboards', 'Update Common Dashboards', 'Update Common Dashboards', '2020-05-13 04:28:33', '2020-05-13 04:28:33'),
(40, 'delete-common-dashboards', 'Delete Common Dashboards', 'Delete Common Dashboards', '2020-05-13 04:28:33', '2020-05-13 04:28:33'),
(41, 'create-common-import', 'Create Common Import', 'Create Common Import', '2020-05-13 04:28:33', '2020-05-13 04:28:33'),
(42, 'create-common-items', 'Create Common Items', 'Create Common Items', '2020-05-13 04:28:34', '2020-05-13 04:28:34'),
(43, 'read-common-items', 'Read Common Items', 'Read Common Items', '2020-05-13 04:28:34', '2020-05-13 04:28:34'),
(44, 'update-common-items', 'Update Common Items', 'Update Common Items', '2020-05-13 04:28:34', '2020-05-13 04:28:34'),
(45, 'delete-common-items', 'Delete Common Items', 'Delete Common Items', '2020-05-13 04:28:34', '2020-05-13 04:28:34'),
(46, 'create-common-notifications', 'Create Common Notifications', 'Create Common Notifications', '2020-05-13 04:28:34', '2020-05-13 04:28:34'),
(47, 'read-common-notifications', 'Read Common Notifications', 'Read Common Notifications', '2020-05-13 04:28:34', '2020-05-13 04:28:34'),
(48, 'update-common-notifications', 'Update Common Notifications', 'Update Common Notifications', '2020-05-13 04:28:34', '2020-05-13 04:28:34'),
(49, 'delete-common-notifications', 'Delete Common Notifications', 'Delete Common Notifications', '2020-05-13 04:28:34', '2020-05-13 04:28:34'),
(50, 'create-common-reports', 'Create Common Reports', 'Create Common Reports', '2020-05-13 04:28:35', '2020-05-13 04:28:35'),
(51, 'read-common-reports', 'Read Common Reports', 'Read Common Reports', '2020-05-13 04:28:35', '2020-05-13 04:28:35'),
(52, 'update-common-reports', 'Update Common Reports', 'Update Common Reports', '2020-05-13 04:28:35', '2020-05-13 04:28:35'),
(53, 'delete-common-reports', 'Delete Common Reports', 'Delete Common Reports', '2020-05-13 04:28:35', '2020-05-13 04:28:35'),
(54, 'read-common-search', 'Read Common Search', 'Read Common Search', '2020-05-13 04:28:35', '2020-05-13 04:28:35'),
(55, 'read-common-uploads', 'Read Common Uploads', 'Read Common Uploads', '2020-05-13 04:28:35', '2020-05-13 04:28:35'),
(56, 'delete-common-uploads', 'Delete Common Uploads', 'Delete Common Uploads', '2020-05-13 04:28:36', '2020-05-13 04:28:36'),
(57, 'create-common-widgets', 'Create Common Widgets', 'Create Common Widgets', '2020-05-13 04:28:36', '2020-05-13 04:28:36'),
(58, 'read-common-widgets', 'Read Common Widgets', 'Read Common Widgets', '2020-05-13 04:28:36', '2020-05-13 04:28:36'),
(59, 'update-common-widgets', 'Update Common Widgets', 'Update Common Widgets', '2020-05-13 04:28:36', '2020-05-13 04:28:36'),
(60, 'delete-common-widgets', 'Delete Common Widgets', 'Delete Common Widgets', '2020-05-13 04:28:36', '2020-05-13 04:28:36'),
(61, 'create-purchases-bills', 'Create Purchases Bills', 'Create Purchases Bills', '2020-05-13 04:28:36', '2020-05-13 04:28:36'),
(62, 'read-purchases-bills', 'Read Purchases Bills', 'Read Purchases Bills', '2020-05-13 04:28:37', '2020-05-13 04:28:37'),
(63, 'update-purchases-bills', 'Update Purchases Bills', 'Update Purchases Bills', '2020-05-13 04:28:37', '2020-05-13 04:28:37'),
(64, 'delete-purchases-bills', 'Delete Purchases Bills', 'Delete Purchases Bills', '2020-05-13 04:28:37', '2020-05-13 04:28:37'),
(65, 'create-purchases-payments', 'Create Purchases Payments', 'Create Purchases Payments', '2020-05-13 04:28:37', '2020-05-13 04:28:37'),
(66, 'read-purchases-payments', 'Read Purchases Payments', 'Read Purchases Payments', '2020-05-13 04:28:37', '2020-05-13 04:28:37'),
(67, 'update-purchases-payments', 'Update Purchases Payments', 'Update Purchases Payments', '2020-05-13 04:28:38', '2020-05-13 04:28:38'),
(68, 'delete-purchases-payments', 'Delete Purchases Payments', 'Delete Purchases Payments', '2020-05-13 04:28:38', '2020-05-13 04:28:38'),
(69, 'create-purchases-vendors', 'Create Purchases Vendors', 'Create Purchases Vendors', '2020-05-13 04:28:38', '2020-05-13 04:28:38'),
(70, 'read-purchases-vendors', 'Read Purchases Vendors', 'Read Purchases Vendors', '2020-05-13 04:28:38', '2020-05-13 04:28:38'),
(71, 'update-purchases-vendors', 'Update Purchases Vendors', 'Update Purchases Vendors', '2020-05-13 04:28:39', '2020-05-13 04:28:39'),
(72, 'delete-purchases-vendors', 'Delete Purchases Vendors', 'Delete Purchases Vendors', '2020-05-13 04:28:39', '2020-05-13 04:28:39'),
(73, 'create-sales-customers', 'Create Sales Customers', 'Create Sales Customers', '2020-05-13 04:28:39', '2020-05-13 04:28:39'),
(74, 'read-sales-customers', 'Read Sales Customers', 'Read Sales Customers', '2020-05-13 04:28:39', '2020-05-13 04:28:39'),
(75, 'update-sales-customers', 'Update Sales Customers', 'Update Sales Customers', '2020-05-13 04:28:39', '2020-05-13 04:28:39'),
(76, 'delete-sales-customers', 'Delete Sales Customers', 'Delete Sales Customers', '2020-05-13 04:28:39', '2020-05-13 04:28:39'),
(77, 'create-sales-invoices', 'Create Sales Invoices', 'Create Sales Invoices', '2020-05-13 04:28:39', '2020-05-13 04:28:39'),
(78, 'read-sales-invoices', 'Read Sales Invoices', 'Read Sales Invoices', '2020-05-13 04:28:39', '2020-05-13 04:28:39'),
(79, 'update-sales-invoices', 'Update Sales Invoices', 'Update Sales Invoices', '2020-05-13 04:28:40', '2020-05-13 04:28:40'),
(80, 'delete-sales-invoices', 'Delete Sales Invoices', 'Delete Sales Invoices', '2020-05-13 04:28:40', '2020-05-13 04:28:40'),
(81, 'create-sales-revenues', 'Create Sales Revenues', 'Create Sales Revenues', '2020-05-13 04:28:40', '2020-05-13 04:28:40'),
(82, 'read-sales-revenues', 'Read Sales Revenues', 'Read Sales Revenues', '2020-05-13 04:28:40', '2020-05-13 04:28:40'),
(83, 'update-sales-revenues', 'Update Sales Revenues', 'Update Sales Revenues', '2020-05-13 04:28:40', '2020-05-13 04:28:40'),
(84, 'delete-sales-revenues', 'Delete Sales Revenues', 'Delete Sales Revenues', '2020-05-13 04:28:40', '2020-05-13 04:28:40'),
(85, 'read-install-updates', 'Read Install Updates', 'Read Install Updates', '2020-05-13 04:28:40', '2020-05-13 04:28:40'),
(86, 'update-install-updates', 'Update Install Updates', 'Update Install Updates', '2020-05-13 04:28:40', '2020-05-13 04:28:40'),
(87, 'create-modules-api-key', 'Create Modules Api Key', 'Create Modules Api Key', '2020-05-13 04:28:41', '2020-05-13 04:28:41'),
(88, 'update-modules-api-key', 'Update Modules Api Key', 'Update Modules Api Key', '2020-05-13 04:28:41', '2020-05-13 04:28:41'),
(89, 'read-modules-home', 'Read Modules Home', 'Read Modules Home', '2020-05-13 04:28:41', '2020-05-13 04:28:41'),
(90, 'create-modules-item', 'Create Modules Item', 'Create Modules Item', '2020-05-13 04:28:41', '2020-05-13 04:28:41'),
(91, 'read-modules-item', 'Read Modules Item', 'Read Modules Item', '2020-05-13 04:28:41', '2020-05-13 04:28:41'),
(92, 'update-modules-item', 'Update Modules Item', 'Update Modules Item', '2020-05-13 04:28:41', '2020-05-13 04:28:41'),
(93, 'delete-modules-item', 'Delete Modules Item', 'Delete Modules Item', '2020-05-13 04:28:42', '2020-05-13 04:28:42'),
(94, 'read-modules-my', 'Read Modules My', 'Read Modules My', '2020-05-13 04:28:42', '2020-05-13 04:28:42'),
(95, 'read-modules-tiles', 'Read Modules Tiles', 'Read Modules Tiles', '2020-05-13 04:28:42', '2020-05-13 04:28:42'),
(96, 'read-notifications', 'Read Notifications', 'Read Notifications', '2020-05-13 04:28:42', '2020-05-13 04:28:42'),
(97, 'update-notifications', 'Update Notifications', 'Update Notifications', '2020-05-13 04:28:42', '2020-05-13 04:28:42'),
(98, 'read-reports-expense-summary', 'Read Reports Expense Summary', 'Read Reports Expense Summary', '2020-05-13 04:28:42', '2020-05-13 04:28:42'),
(99, 'read-reports-income-summary', 'Read Reports Income Summary', 'Read Reports Income Summary', '2020-05-13 04:28:43', '2020-05-13 04:28:43'),
(100, 'read-reports-income-expense-summary', 'Read Reports Income Expense Summary', 'Read Reports Income Expense Summary', '2020-05-13 04:28:43', '2020-05-13 04:28:43'),
(101, 'read-reports-profit-loss', 'Read Reports Profit Loss', 'Read Reports Profit Loss', '2020-05-13 04:28:43', '2020-05-13 04:28:43'),
(102, 'read-reports-tax-summary', 'Read Reports Tax Summary', 'Read Reports Tax Summary', '2020-05-13 04:28:43', '2020-05-13 04:28:43'),
(103, 'create-settings-categories', 'Create Settings Categories', 'Create Settings Categories', '2020-05-13 04:28:43', '2020-05-13 04:28:43'),
(104, 'read-settings-categories', 'Read Settings Categories', 'Read Settings Categories', '2020-05-13 04:28:43', '2020-05-13 04:28:43'),
(105, 'update-settings-categories', 'Update Settings Categories', 'Update Settings Categories', '2020-05-13 04:28:44', '2020-05-13 04:28:44'),
(106, 'delete-settings-categories', 'Delete Settings Categories', 'Delete Settings Categories', '2020-05-13 04:28:44', '2020-05-13 04:28:44'),
(107, 'read-settings-company', 'Read Settings Company', 'Read Settings Company', '2020-05-13 04:28:44', '2020-05-13 04:28:44'),
(108, 'create-settings-currencies', 'Create Settings Currencies', 'Create Settings Currencies', '2020-05-13 04:28:44', '2020-05-13 04:28:44'),
(109, 'read-settings-currencies', 'Read Settings Currencies', 'Read Settings Currencies', '2020-05-13 04:28:44', '2020-05-13 04:28:44'),
(110, 'update-settings-currencies', 'Update Settings Currencies', 'Update Settings Currencies', '2020-05-13 04:28:44', '2020-05-13 04:28:44'),
(111, 'delete-settings-currencies', 'Delete Settings Currencies', 'Delete Settings Currencies', '2020-05-13 04:28:45', '2020-05-13 04:28:45'),
(112, 'read-settings-defaults', 'Read Settings Defaults', 'Read Settings Defaults', '2020-05-13 04:28:45', '2020-05-13 04:28:45'),
(113, 'read-settings-email', 'Read Settings Email', 'Read Settings Email', '2020-05-13 04:28:45', '2020-05-13 04:28:45'),
(114, 'read-settings-invoice', 'Read Settings Invoice', 'Read Settings Invoice', '2020-05-13 04:28:45', '2020-05-13 04:28:45'),
(115, 'read-settings-localisation', 'Read Settings Localisation', 'Read Settings Localisation', '2020-05-13 04:28:45', '2020-05-13 04:28:45'),
(116, 'read-settings-modules', 'Read Settings Modules', 'Read Settings Modules', '2020-05-13 04:28:45', '2020-05-13 04:28:45'),
(117, 'update-settings-modules', 'Update Settings Modules', 'Update Settings Modules', '2020-05-13 04:28:46', '2020-05-13 04:28:46'),
(118, 'read-settings-settings', 'Read Settings Settings', 'Read Settings Settings', '2020-05-13 04:28:46', '2020-05-13 04:28:46'),
(119, 'update-settings-settings', 'Update Settings Settings', 'Update Settings Settings', '2020-05-13 04:28:46', '2020-05-13 04:28:46'),
(120, 'read-settings-schedule', 'Read Settings Schedule', 'Read Settings Schedule', '2020-05-13 04:28:46', '2020-05-13 04:28:46'),
(121, 'create-settings-taxes', 'Create Settings Taxes', 'Create Settings Taxes', '2020-05-13 04:28:46', '2020-05-13 04:28:46'),
(122, 'read-settings-taxes', 'Read Settings Taxes', 'Read Settings Taxes', '2020-05-13 04:28:46', '2020-05-13 04:28:46'),
(123, 'update-settings-taxes', 'Update Settings Taxes', 'Update Settings Taxes', '2020-05-13 04:28:47', '2020-05-13 04:28:47'),
(124, 'delete-settings-taxes', 'Delete Settings Taxes', 'Delete Settings Taxes', '2020-05-13 04:28:47', '2020-05-13 04:28:47'),
(125, 'read-widgets-account-balance', 'Read Widgets Account Balance', 'Read Widgets Account Balance', '2020-05-13 04:28:47', '2020-05-13 04:28:47'),
(126, 'read-widgets-cash-flow', 'Read Widgets Cash Flow', 'Read Widgets Cash Flow', '2020-05-13 04:28:47', '2020-05-13 04:28:47'),
(127, 'read-widgets-expenses-by-category', 'Read Widgets Expenses By Category', 'Read Widgets Expenses By Category', '2020-05-13 04:28:47', '2020-05-13 04:28:47'),
(128, 'read-widgets-income-by-category', 'Read Widgets Income By Category', 'Read Widgets Income By Category', '2020-05-13 04:28:47', '2020-05-13 04:28:47'),
(129, 'read-widgets-latest-expenses', 'Read Widgets Latest Expenses', 'Read Widgets Latest Expenses', '2020-05-13 04:28:47', '2020-05-13 04:28:47'),
(130, 'read-widgets-latest-income', 'Read Widgets Latest Income', 'Read Widgets Latest Income', '2020-05-13 04:28:48', '2020-05-13 04:28:48'),
(131, 'read-widgets-total-expenses', 'Read Widgets Total Expenses', 'Read Widgets Total Expenses', '2020-05-13 04:28:48', '2020-05-13 04:28:48'),
(132, 'read-widgets-total-income', 'Read Widgets Total Income', 'Read Widgets Total Income', '2020-05-13 04:28:48', '2020-05-13 04:28:48'),
(133, 'read-widgets-total-profit', 'Read Widgets Total Profit', 'Read Widgets Total Profit', '2020-05-13 04:28:48', '2020-05-13 04:28:48'),
(134, 'read-client-portal', 'Read Client Portal', 'Read Client Portal', '2020-05-13 04:28:58', '2020-05-13 04:28:58'),
(135, 'read-portal-invoices', 'Read Portal Invoices', 'Read Portal Invoices', '2020-05-13 04:28:59', '2020-05-13 04:28:59'),
(136, 'update-portal-invoices', 'Update Portal Invoices', 'Update Portal Invoices', '2020-05-13 04:28:59', '2020-05-13 04:28:59'),
(137, 'read-portal-payments', 'Read Portal Payments', 'Read Portal Payments', '2020-05-13 04:28:59', '2020-05-13 04:28:59'),
(138, 'update-portal-payments', 'Update Portal Payments', 'Update Portal Payments', '2020-05-13 04:28:59', '2020-05-13 04:28:59'),
(139, 'read-portal-profile', 'Read Portal Profile', 'Read Portal Profile', '2020-05-13 04:28:59', '2020-05-13 04:28:59'),
(140, 'update-portal-profile', 'Update Portal Profile', 'Update Portal Profile', '2020-05-13 04:28:59', '2020-05-13 04:28:59'),
(141, 'read-offline-payments-settings', 'Read Offline Payments Settings', 'Read Offline Payments Settings', '2020-05-13 04:29:59', '2020-05-13 04:29:59'),
(142, 'update-offline-payments-settings', 'Update Offline Payments Settings', 'Update Offline Payments Settings', '2020-05-13 04:30:00', '2020-05-13 04:30:00'),
(143, 'delete-offline-payments-settings', 'Delete Offline Payments Settings', 'Delete Offline Payments Settings', '2020-05-13 04:30:00', '2020-05-13 04:30:00'),
(144, 'read-paypal-standard-settings', 'Read PayPal Standard Settings', 'Read PayPal Standard Settings', '2020-05-13 04:30:00', '2020-05-13 04:30:00'),
(145, 'update-paypal-standard-settings', 'Update PayPal Standard Settings', 'Update PayPal Standard Settings', '2020-05-13 04:30:00', '2020-05-13 04:30:00');

-- --------------------------------------------------------

--
-- Table structure for table `iqj_reconciliations`
--

CREATE TABLE `iqj_reconciliations` (
  `id` int(10) UNSIGNED NOT NULL,
  `company_id` int(11) NOT NULL,
  `account_id` int(11) NOT NULL,
  `started_at` datetime NOT NULL,
  `ended_at` datetime NOT NULL,
  `closing_balance` double(15,4) NOT NULL DEFAULT 0.0000,
  `reconciled` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `iqj_recurring`
--

CREATE TABLE `iqj_recurring` (
  `id` int(10) UNSIGNED NOT NULL,
  `company_id` int(11) NOT NULL,
  `recurable_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `recurable_id` bigint(20) UNSIGNED NOT NULL,
  `frequency` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `interval` int(11) NOT NULL DEFAULT 1,
  `started_at` datetime NOT NULL,
  `count` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `iqj_recurring`
--

INSERT INTO `iqj_recurring` (`id`, `company_id`, `recurable_type`, `recurable_id`, `frequency`, `interval`, `started_at`, `count`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 'App\\Models\\Sale\\Invoice', 4, 'monthly', 1, '2020-06-04 07:27:50', 1, '2020-06-04 01:27:50', '2020-06-04 01:27:50', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `iqj_reports`
--

CREATE TABLE `iqj_reports` (
  `id` int(10) UNSIGNED NOT NULL,
  `company_id` int(11) NOT NULL,
  `class` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `settings` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `iqj_reports`
--

INSERT INTO `iqj_reports` (`id`, `company_id`, `class`, `name`, `description`, `settings`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 'App\\Reports\\IncomeSummary', 'Income Summary', 'Monthly income summary by category.', '{\"group\":\"category\",\"period\":\"monthly\",\"basis\":\"accrual\",\"chart\":\"line\"}', '2020-05-13 04:30:01', '2020-05-13 04:30:01', NULL),
(2, 1, 'App\\Reports\\ExpenseSummary', 'Expense Summary', 'Monthly expense summary by category.', '{\"group\":\"category\",\"period\":\"monthly\",\"basis\":\"accrual\",\"chart\":\"line\"}', '2020-05-13 04:30:01', '2020-05-13 04:30:01', NULL),
(3, 1, 'App\\Reports\\IncomeExpenseSummary', 'Income vs Expense', 'Monthly income vs expense by category.', '{\"group\":\"category\",\"period\":\"monthly\",\"basis\":\"accrual\",\"chart\":\"line\"}', '2020-05-13 04:30:01', '2020-05-13 04:30:01', NULL),
(4, 1, 'App\\Reports\\ProfitLoss', 'Profit & Loss', 'Quarterly profit & loss by category.', '{\"group\":\"category\",\"period\":\"quarterly\",\"basis\":\"accrual\"}', '2020-05-13 04:30:01', '2020-05-13 04:30:01', NULL),
(5, 1, 'App\\Reports\\TaxSummary', 'Tax Summary', 'Quarterly tax summary.', '{\"period\":\"quarterly\",\"basis\":\"accrual\"}', '2020-05-13 04:30:01', '2020-05-13 04:30:01', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `iqj_roles`
--

CREATE TABLE `iqj_roles` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `iqj_roles`
--

INSERT INTO `iqj_roles` (`id`, `name`, `display_name`, `description`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'Admin', 'Admin', '2020-05-13 04:28:27', '2020-05-13 04:28:27'),
(2, 'manager', 'Manager', 'Manager', '2020-05-13 04:28:48', '2020-05-13 04:28:48'),
(3, 'customer', 'Customer', 'Customer', '2020-05-13 04:28:58', '2020-05-13 04:28:58');

-- --------------------------------------------------------

--
-- Table structure for table `iqj_role_permissions`
--

CREATE TABLE `iqj_role_permissions` (
  `role_id` int(10) UNSIGNED NOT NULL,
  `permission_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `iqj_role_permissions`
--

INSERT INTO `iqj_role_permissions` (`role_id`, `permission_id`) VALUES
(1, 1),
(1, 2),
(1, 3),
(1, 4),
(1, 5),
(1, 6),
(1, 7),
(1, 8),
(1, 9),
(1, 10),
(1, 11),
(1, 12),
(1, 13),
(1, 14),
(1, 15),
(1, 16),
(1, 17),
(1, 18),
(1, 19),
(1, 20),
(1, 21),
(1, 22),
(1, 23),
(1, 24),
(1, 25),
(1, 26),
(1, 27),
(1, 28),
(1, 29),
(1, 30),
(1, 31),
(1, 32),
(1, 33),
(1, 34),
(1, 35),
(1, 36),
(1, 37),
(1, 38),
(1, 39),
(1, 40),
(1, 41),
(1, 42),
(1, 43),
(1, 44),
(1, 45),
(1, 46),
(1, 47),
(1, 48),
(1, 49),
(1, 50),
(1, 51),
(1, 52),
(1, 53),
(1, 54),
(1, 55),
(1, 56),
(1, 57),
(1, 58),
(1, 59),
(1, 60),
(1, 61),
(1, 62),
(1, 63),
(1, 64),
(1, 65),
(1, 66),
(1, 67),
(1, 68),
(1, 69),
(1, 70),
(1, 71),
(1, 72),
(1, 73),
(1, 74),
(1, 75),
(1, 76),
(1, 77),
(1, 78),
(1, 79),
(1, 80),
(1, 81),
(1, 82),
(1, 83),
(1, 84),
(1, 85),
(1, 86),
(1, 87),
(1, 88),
(1, 89),
(1, 90),
(1, 91),
(1, 92),
(1, 93),
(1, 94),
(1, 95),
(1, 96),
(1, 97),
(1, 98),
(1, 99),
(1, 100),
(1, 101),
(1, 102),
(1, 103),
(1, 104),
(1, 105),
(1, 106),
(1, 107),
(1, 108),
(1, 109),
(1, 110),
(1, 111),
(1, 112),
(1, 113),
(1, 114),
(1, 115),
(1, 116),
(1, 117),
(1, 118),
(1, 119),
(1, 120),
(1, 121),
(1, 122),
(1, 123),
(1, 124),
(1, 125),
(1, 126),
(1, 127),
(1, 128),
(1, 129),
(1, 130),
(1, 131),
(1, 132),
(1, 133),
(1, 141),
(1, 142),
(1, 143),
(1, 144),
(1, 145),
(2, 1),
(2, 7),
(2, 8),
(2, 17),
(2, 18),
(2, 19),
(2, 20),
(2, 21),
(2, 22),
(2, 23),
(2, 24),
(2, 25),
(2, 26),
(2, 27),
(2, 28),
(2, 29),
(2, 30),
(2, 31),
(2, 32),
(2, 33),
(2, 34),
(2, 35),
(2, 36),
(2, 37),
(2, 38),
(2, 39),
(2, 40),
(2, 41),
(2, 42),
(2, 43),
(2, 44),
(2, 45),
(2, 46),
(2, 47),
(2, 48),
(2, 49),
(2, 50),
(2, 51),
(2, 52),
(2, 53),
(2, 54),
(2, 55),
(2, 57),
(2, 58),
(2, 59),
(2, 60),
(2, 61),
(2, 62),
(2, 63),
(2, 64),
(2, 65),
(2, 66),
(2, 67),
(2, 68),
(2, 69),
(2, 70),
(2, 71),
(2, 72),
(2, 73),
(2, 74),
(2, 75),
(2, 76),
(2, 77),
(2, 78),
(2, 79),
(2, 80),
(2, 81),
(2, 82),
(2, 83),
(2, 84),
(2, 85),
(2, 86),
(2, 96),
(2, 97),
(2, 98),
(2, 99),
(2, 100),
(2, 101),
(2, 102),
(2, 103),
(2, 104),
(2, 105),
(2, 106),
(2, 107),
(2, 108),
(2, 109),
(2, 110),
(2, 111),
(2, 112),
(2, 113),
(2, 114),
(2, 115),
(2, 116),
(2, 117),
(2, 118),
(2, 119),
(2, 120),
(2, 121),
(2, 122),
(2, 123),
(2, 124),
(2, 125),
(2, 126),
(2, 127),
(2, 128),
(2, 129),
(2, 130),
(2, 131),
(2, 132),
(2, 133),
(2, 141),
(2, 142),
(2, 143),
(2, 144),
(2, 145),
(3, 134),
(3, 135),
(3, 136),
(3, 137),
(3, 138),
(3, 139),
(3, 140);

-- --------------------------------------------------------

--
-- Table structure for table `iqj_sessions`
--

CREATE TABLE `iqj_sessions` (
  `id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(10) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payload` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `iqj_settings`
--

CREATE TABLE `iqj_settings` (
  `id` int(10) UNSIGNED NOT NULL,
  `company_id` int(11) NOT NULL,
  `key` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` text COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `iqj_settings`
--

INSERT INTO `iqj_settings` (`id`, `company_id`, `key`, `value`) VALUES
(1, 1, 'default.account', '1'),
(2, 1, 'default.payment_method', 'offline-payments.cash.1'),
(3, 1, 'default.list_limit', '25'),
(4, 1, 'default.use_gravatar', '0'),
(5, 1, 'default.currency', 'USD'),
(6, 1, 'default.locale', 'en-GB'),
(7, 1, 'localisation.financial_start', '01-01'),
(8, 1, 'localisation.timezone', 'Europe/London'),
(9, 1, 'localisation.date_format', 'd M Y'),
(10, 1, 'localisation.date_separator', 'space'),
(11, 1, 'localisation.percent_position', 'after'),
(12, 1, 'invoice.number_prefix', 'INV-'),
(13, 1, 'invoice.number_digit', '5'),
(14, 1, 'invoice.number_next', '5'),
(15, 1, 'invoice.item_name', 'settings.invoice.item'),
(16, 1, 'invoice.price_name', 'settings.invoice.price'),
(17, 1, 'invoice.quantity_name', 'settings.invoice.quantity'),
(18, 1, 'invoice.title', 'Invoice'),
(19, 1, 'invoice.payment_terms', '0'),
(20, 1, 'invoice.template', 'default'),
(21, 1, 'invoice.color', '#55588b'),
(22, 1, 'email.protocol', 'mail'),
(23, 1, 'email.sendmail_path', '/usr/sbin/sendmail -bs'),
(24, 1, 'schedule.send_invoice_reminder', '0'),
(25, 1, 'schedule.invoice_days', '1,3,5,10'),
(26, 1, 'schedule.send_bill_reminder', '0'),
(27, 1, 'schedule.bill_days', '10,5,3,1'),
(28, 1, 'schedule.time', '09:00'),
(29, 1, 'wizard.completed', '1'),
(30, 1, 'offline-payments.methods', '[{\"code\":\"offline-payments.cash.1\",\"name\":\"Cash\",\"customer\":\"0\",\"order\":\"1\",\"description\":null},{\"code\":\"offline-payments.bank_transfer.2\",\"name\":\"Bank Transfer\",\"customer\":\"0\",\"order\":\"2\",\"description\":null}]'),
(31, 1, 'contact.type.customer', 'customer'),
(32, 1, 'contact.type.vendor', 'vendor'),
(33, 1, 'company.name', 'Cloud Soft'),
(34, 1, 'company.email', 'company@email.com'),
(36, 1, 'bill.number_next', '2');

-- --------------------------------------------------------

--
-- Table structure for table `iqj_taxes`
--

CREATE TABLE `iqj_taxes` (
  `id` int(10) UNSIGNED NOT NULL,
  `company_id` int(11) NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `rate` double(15,4) NOT NULL,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'normal',
  `enabled` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `iqj_taxes`
--

INSERT INTO `iqj_taxes` (`id`, `company_id`, `name`, `rate`, `type`, `enabled`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 'Example', 2.0000, 'normal', 1, '2020-05-18 00:42:55', '2020-05-18 00:42:55', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `iqj_transactions`
--

CREATE TABLE `iqj_transactions` (
  `id` int(10) UNSIGNED NOT NULL,
  `company_id` int(11) NOT NULL,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `paid_at` datetime NOT NULL,
  `amount` double(15,4) NOT NULL,
  `currency_code` varchar(3) COLLATE utf8mb4_unicode_ci NOT NULL,
  `currency_rate` double(15,8) NOT NULL,
  `account_id` int(11) NOT NULL,
  `document_id` int(11) DEFAULT NULL,
  `contact_id` int(11) DEFAULT NULL,
  `category_id` int(11) NOT NULL DEFAULT 1,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payment_method` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `reference` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `parent_id` int(11) NOT NULL DEFAULT 0,
  `reconciled` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `iqj_transactions`
--

INSERT INTO `iqj_transactions` (`id`, `company_id`, `type`, `paid_at`, `amount`, `currency_code`, `currency_rate`, `account_id`, `document_id`, `contact_id`, `category_id`, `description`, `payment_method`, `reference`, `parent_id`, `reconciled`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 'income', '2020-05-24 00:00:00', 12.2400, 'USD', 1.00000000, 1, 1, 57, 2, NULL, 'offline-payments.cash.1', NULL, 0, 0, '2020-05-23 10:20:00', '2020-05-23 10:20:00', NULL),
(2, 1, 'expense', '2020-06-02 12:59:00', 20.0000, 'USD', 1.00000000, 1, 1, 66, 4, NULL, 'offline-payments.cash.1', NULL, 0, 0, '2020-06-02 06:59:00', '2020-06-02 06:59:00', NULL),
(3, 1, 'expense', '2020-06-02 00:00:00', 0.4000, 'USD', 1.00000000, 1, 1, 66, 4, NULL, 'offline-payments.cash.1', NULL, 0, 0, '2020-06-02 06:59:41', '2020-06-02 06:59:41', NULL),
(4, 1, 'income', '2020-06-02 00:00:00', 51.0000, 'USD', 1.00000000, 1, 2, 67, 3, NULL, 'offline-payments.cash.1', NULL, 0, 0, '2020-06-02 07:02:29', '2020-06-02 07:02:29', NULL),
(5, 1, 'income', '2020-06-03 00:00:00', 51.0000, 'USD', 1.00000000, 1, 3, 67, 2, NULL, 'offline-payments.cash.1', NULL, 0, 0, '2020-06-02 23:49:16', '2020-06-02 23:49:16', NULL),
(6, 1, 'income', '2020-06-04 00:00:00', 30.6000, 'USD', 1.00000000, 1, 4, 67, 6, NULL, 'offline-payments.cash.1', NULL, 0, 0, '2020-06-04 01:28:35', '2020-06-04 01:28:35', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `iqj_transfers`
--

CREATE TABLE `iqj_transfers` (
  `id` int(10) UNSIGNED NOT NULL,
  `company_id` int(11) NOT NULL,
  `expense_transaction_id` int(11) NOT NULL,
  `income_transaction_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `iqj_users`
--

CREATE TABLE `iqj_users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_logged_in_at` timestamp NULL DEFAULT NULL,
  `locale` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'en-GB',
  `landing_page` varchar(70) COLLATE utf8mb4_unicode_ci DEFAULT 'dashboard',
  `enabled` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `iqj_users`
--

INSERT INTO `iqj_users` (`id`, `name`, `email`, `password`, `remember_token`, `last_logged_in_at`, `locale`, `landing_page`, `enabled`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, '', 'admin@email.com', '$2y$10$yb61ROaEJcpNstw1Rh680Oi3lovMorfNRUyFPFsbW4Q0NAxlTbRcO', 'PWbFrkdqVia8S2znmSfMr5hySwLeYSFC6J8B6nO4mSuzFt220e1DFmS38vPb', '2020-06-06 06:11:35', 'en-GB', 'dashboard', 1, '2020-05-13 04:30:02', '2020-06-06 06:11:35', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `iqj_user_companies`
--

CREATE TABLE `iqj_user_companies` (
  `user_id` int(10) UNSIGNED NOT NULL,
  `company_id` int(10) UNSIGNED NOT NULL,
  `user_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `iqj_user_companies`
--

INSERT INTO `iqj_user_companies` (`user_id`, `company_id`, `user_type`) VALUES
(1, 1, 'users');

-- --------------------------------------------------------

--
-- Table structure for table `iqj_user_dashboards`
--

CREATE TABLE `iqj_user_dashboards` (
  `user_id` int(10) UNSIGNED NOT NULL,
  `dashboard_id` int(10) UNSIGNED NOT NULL,
  `user_type` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `iqj_user_dashboards`
--

INSERT INTO `iqj_user_dashboards` (`user_id`, `dashboard_id`, `user_type`) VALUES
(1, 1, 'users');

-- --------------------------------------------------------

--
-- Table structure for table `iqj_user_permissions`
--

CREATE TABLE `iqj_user_permissions` (
  `user_id` int(10) UNSIGNED NOT NULL,
  `permission_id` int(10) UNSIGNED NOT NULL,
  `user_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `iqj_user_roles`
--

CREATE TABLE `iqj_user_roles` (
  `user_id` int(10) UNSIGNED NOT NULL,
  `role_id` int(10) UNSIGNED NOT NULL,
  `user_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `iqj_user_roles`
--

INSERT INTO `iqj_user_roles` (`user_id`, `role_id`, `user_type`) VALUES
(1, 1, 'users');

-- --------------------------------------------------------

--
-- Table structure for table `iqj_widgets`
--

CREATE TABLE `iqj_widgets` (
  `id` int(10) UNSIGNED NOT NULL,
  `company_id` int(11) NOT NULL,
  `dashboard_id` int(11) NOT NULL,
  `class` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sort` int(11) NOT NULL DEFAULT 0,
  `settings` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `iqj_widgets`
--

INSERT INTO `iqj_widgets` (`id`, `company_id`, `dashboard_id`, `class`, `name`, `sort`, `settings`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 1, 'App\\Widgets\\TotalIncome', 'Total Income', 1, '{\"width\":\"col-md-3\"}', '2020-05-13 04:30:02', '2020-05-31 00:06:26', NULL),
(2, 1, 1, 'App\\Widgets\\TotalExpenses', 'Total Expenses', 2, '{\"width\":\"col-md-3\"}', '2020-05-13 04:30:02', '2020-05-31 00:06:40', NULL),
(3, 1, 1, 'App\\Widgets\\TotalProfit', 'Total Profit', 3, '{\"width\":\"col-md-3\"}', '2020-05-13 04:30:03', '2020-05-31 00:06:49', NULL),
(4, 1, 1, 'App\\Widgets\\CashFlow', 'Cash Flow', 4, '{\"width\":\"col-md-12\"}', '2020-05-13 04:30:03', '2020-05-30 11:31:48', NULL),
(5, 1, 1, 'App\\Widgets\\IncomeByCategory', 'Income By Category', 5, '{\"width\":\"col-md-6\"}', '2020-05-13 04:30:03', '2020-06-03 07:32:38', NULL),
(6, 1, 1, 'App\\Widgets\\ExpensesByCategory', 'Expenses By Category', 6, '{\"width\":\"col-md-6\"}', '2020-05-13 04:30:03', '2020-05-13 04:30:03', NULL),
(7, 1, 1, 'App\\Widgets\\AccountBalance', 'Account Balance', 7, '{\"width\":\"col-md-4\"}', '2020-05-13 04:30:03', '2020-05-13 04:30:03', NULL),
(8, 1, 1, 'App\\Widgets\\LatestIncome', 'Latest Income', 8, '{\"width\":\"col-md-4\"}', '2020-05-13 04:30:03', '2020-05-13 04:30:03', NULL),
(9, 1, 1, 'App\\Widgets\\LatestExpenses', 'Latest Expenses', 9, '{\"width\":\"col-md-4\"}', '2020-05-13 04:30:03', '2020-05-13 04:30:03', NULL),
(10, 1, 1, 'App\\Widgets\\TotalIncome', 'Total Purchases', 3, '{\"width\":\"col-md-3\"}', '2020-05-31 00:05:10', '2020-05-31 00:05:51', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `iqj_accounts`
--
ALTER TABLE `iqj_accounts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `iqj_accounts_company_id_index` (`company_id`);

--
-- Indexes for table `iqj_bills`
--
ALTER TABLE `iqj_bills`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `iqj_bills_company_id_bill_number_deleted_at_unique` (`company_id`,`bill_number`,`deleted_at`),
  ADD KEY `iqj_bills_company_id_index` (`company_id`);

--
-- Indexes for table `iqj_bill_histories`
--
ALTER TABLE `iqj_bill_histories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `iqj_bill_histories_company_id_index` (`company_id`);

--
-- Indexes for table `iqj_bill_items`
--
ALTER TABLE `iqj_bill_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `iqj_bill_items_company_id_index` (`company_id`);

--
-- Indexes for table `iqj_bill_item_taxes`
--
ALTER TABLE `iqj_bill_item_taxes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `iqj_bill_item_taxes_company_id_index` (`company_id`);

--
-- Indexes for table `iqj_bill_totals`
--
ALTER TABLE `iqj_bill_totals`
  ADD PRIMARY KEY (`id`),
  ADD KEY `iqj_bill_totals_company_id_index` (`company_id`);

--
-- Indexes for table `iqj_categories`
--
ALTER TABLE `iqj_categories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `iqj_categories_company_id_index` (`company_id`);

--
-- Indexes for table `iqj_companies`
--
ALTER TABLE `iqj_companies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `iqj_contacts`
--
ALTER TABLE `iqj_contacts`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `iqj_contacts_company_id_type_email_deleted_at_unique` (`company_id`,`type`,`email`,`deleted_at`),
  ADD KEY `iqj_contacts_company_id_type_index` (`company_id`,`type`);

--
-- Indexes for table `iqj_currencies`
--
ALTER TABLE `iqj_currencies`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `iqj_currencies_company_id_code_deleted_at_unique` (`company_id`,`code`,`deleted_at`),
  ADD KEY `iqj_currencies_company_id_index` (`company_id`);

--
-- Indexes for table `iqj_dashboards`
--
ALTER TABLE `iqj_dashboards`
  ADD PRIMARY KEY (`id`),
  ADD KEY `iqj_dashboards_company_id_index` (`company_id`);

--
-- Indexes for table `iqj_email_templates`
--
ALTER TABLE `iqj_email_templates`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `iqj_email_templates_company_id_alias_deleted_at_unique` (`company_id`,`alias`,`deleted_at`),
  ADD KEY `iqj_email_templates_company_id_index` (`company_id`);

--
-- Indexes for table `iqj_failed_jobs`
--
ALTER TABLE `iqj_failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `iqj_firewall_ips`
--
ALTER TABLE `iqj_firewall_ips`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `iqj_firewall_ips_ip_deleted_at_unique` (`ip`,`deleted_at`),
  ADD KEY `iqj_firewall_ips_ip_index` (`ip`);

--
-- Indexes for table `iqj_firewall_logs`
--
ALTER TABLE `iqj_firewall_logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `iqj_firewall_logs_ip_index` (`ip`);

--
-- Indexes for table `iqj_invoices`
--
ALTER TABLE `iqj_invoices`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `iqj_invoices_company_id_invoice_number_deleted_at_unique` (`company_id`,`invoice_number`,`deleted_at`),
  ADD KEY `iqj_invoices_company_id_index` (`company_id`);

--
-- Indexes for table `iqj_invoice_histories`
--
ALTER TABLE `iqj_invoice_histories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `iqj_invoice_histories_company_id_index` (`company_id`);

--
-- Indexes for table `iqj_invoice_items`
--
ALTER TABLE `iqj_invoice_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `iqj_invoice_items_company_id_index` (`company_id`);

--
-- Indexes for table `iqj_invoice_item_taxes`
--
ALTER TABLE `iqj_invoice_item_taxes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `iqj_invoice_item_taxes_company_id_index` (`company_id`);

--
-- Indexes for table `iqj_invoice_totals`
--
ALTER TABLE `iqj_invoice_totals`
  ADD PRIMARY KEY (`id`),
  ADD KEY `iqj_invoice_totals_company_id_index` (`company_id`);

--
-- Indexes for table `iqj_items`
--
ALTER TABLE `iqj_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `iqj_items_company_id_index` (`company_id`);

--
-- Indexes for table `iqj_jobs`
--
ALTER TABLE `iqj_jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `iqj_jobs_queue_reserved_at_index` (`queue`,`reserved_at`);

--
-- Indexes for table `iqj_media`
--
ALTER TABLE `iqj_media`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `iqj_media_disk_directory_filename_extension_deleted_at_unique` (`disk`,`directory`,`filename`,`extension`,`deleted_at`),
  ADD KEY `iqj_media_disk_directory_index` (`disk`,`directory`),
  ADD KEY `iqj_media_aggregate_type_index` (`aggregate_type`);

--
-- Indexes for table `iqj_mediables`
--
ALTER TABLE `iqj_mediables`
  ADD PRIMARY KEY (`media_id`,`mediable_type`,`mediable_id`,`tag`),
  ADD KEY `iqj_mediables_mediable_id_mediable_type_index` (`mediable_id`,`mediable_type`),
  ADD KEY `iqj_mediables_tag_index` (`tag`),
  ADD KEY `iqj_mediables_order_index` (`order`);

--
-- Indexes for table `iqj_migrations`
--
ALTER TABLE `iqj_migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `iqj_modules`
--
ALTER TABLE `iqj_modules`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `iqj_modules_company_id_alias_deleted_at_unique` (`company_id`,`alias`,`deleted_at`),
  ADD KEY `iqj_modules_company_id_index` (`company_id`);

--
-- Indexes for table `iqj_module_histories`
--
ALTER TABLE `iqj_module_histories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `iqj_module_histories_company_id_module_id_index` (`company_id`,`module_id`);

--
-- Indexes for table `iqj_notifications`
--
ALTER TABLE `iqj_notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `iqj_notifications_notifiable_type_notifiable_id_index` (`notifiable_type`,`notifiable_id`);

--
-- Indexes for table `iqj_password_resets`
--
ALTER TABLE `iqj_password_resets`
  ADD KEY `iqj_password_resets_email_index` (`email`);

--
-- Indexes for table `iqj_permissions`
--
ALTER TABLE `iqj_permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `iqj_permissions_name_unique` (`name`);

--
-- Indexes for table `iqj_reconciliations`
--
ALTER TABLE `iqj_reconciliations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `iqj_reconciliations_company_id_index` (`company_id`);

--
-- Indexes for table `iqj_recurring`
--
ALTER TABLE `iqj_recurring`
  ADD PRIMARY KEY (`id`),
  ADD KEY `iqj_recurring_recurable_type_recurable_id_index` (`recurable_type`,`recurable_id`),
  ADD KEY `iqj_recurring_company_id_index` (`company_id`);

--
-- Indexes for table `iqj_reports`
--
ALTER TABLE `iqj_reports`
  ADD PRIMARY KEY (`id`),
  ADD KEY `iqj_reports_company_id_index` (`company_id`);

--
-- Indexes for table `iqj_roles`
--
ALTER TABLE `iqj_roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `iqj_roles_name_unique` (`name`);

--
-- Indexes for table `iqj_role_permissions`
--
ALTER TABLE `iqj_role_permissions`
  ADD PRIMARY KEY (`role_id`,`permission_id`),
  ADD KEY `iqj_role_permissions_permission_id_foreign` (`permission_id`);

--
-- Indexes for table `iqj_sessions`
--
ALTER TABLE `iqj_sessions`
  ADD UNIQUE KEY `iqj_sessions_id_unique` (`id`);

--
-- Indexes for table `iqj_settings`
--
ALTER TABLE `iqj_settings`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `iqj_settings_company_id_key_unique` (`company_id`,`key`),
  ADD KEY `iqj_settings_company_id_index` (`company_id`);

--
-- Indexes for table `iqj_taxes`
--
ALTER TABLE `iqj_taxes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `iqj_taxes_company_id_index` (`company_id`);

--
-- Indexes for table `iqj_transactions`
--
ALTER TABLE `iqj_transactions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `iqj_transactions_company_id_type_index` (`company_id`,`type`);

--
-- Indexes for table `iqj_transfers`
--
ALTER TABLE `iqj_transfers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `iqj_transfers_company_id_index` (`company_id`);

--
-- Indexes for table `iqj_users`
--
ALTER TABLE `iqj_users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `iqj_users_email_deleted_at_unique` (`email`,`deleted_at`);

--
-- Indexes for table `iqj_user_companies`
--
ALTER TABLE `iqj_user_companies`
  ADD PRIMARY KEY (`user_id`,`company_id`,`user_type`);

--
-- Indexes for table `iqj_user_dashboards`
--
ALTER TABLE `iqj_user_dashboards`
  ADD PRIMARY KEY (`user_id`,`dashboard_id`,`user_type`);

--
-- Indexes for table `iqj_user_permissions`
--
ALTER TABLE `iqj_user_permissions`
  ADD PRIMARY KEY (`user_id`,`permission_id`,`user_type`),
  ADD KEY `iqj_user_permissions_permission_id_foreign` (`permission_id`);

--
-- Indexes for table `iqj_user_roles`
--
ALTER TABLE `iqj_user_roles`
  ADD PRIMARY KEY (`user_id`,`role_id`,`user_type`),
  ADD KEY `iqj_user_roles_role_id_foreign` (`role_id`);

--
-- Indexes for table `iqj_widgets`
--
ALTER TABLE `iqj_widgets`
  ADD PRIMARY KEY (`id`),
  ADD KEY `iqj_widgets_company_id_dashboard_id_index` (`company_id`,`dashboard_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `iqj_accounts`
--
ALTER TABLE `iqj_accounts`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `iqj_bills`
--
ALTER TABLE `iqj_bills`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `iqj_bill_histories`
--
ALTER TABLE `iqj_bill_histories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `iqj_bill_items`
--
ALTER TABLE `iqj_bill_items`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `iqj_bill_item_taxes`
--
ALTER TABLE `iqj_bill_item_taxes`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `iqj_bill_totals`
--
ALTER TABLE `iqj_bill_totals`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `iqj_categories`
--
ALTER TABLE `iqj_categories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `iqj_companies`
--
ALTER TABLE `iqj_companies`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `iqj_contacts`
--
ALTER TABLE `iqj_contacts`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;

--
-- AUTO_INCREMENT for table `iqj_currencies`
--
ALTER TABLE `iqj_currencies`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `iqj_dashboards`
--
ALTER TABLE `iqj_dashboards`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `iqj_email_templates`
--
ALTER TABLE `iqj_email_templates`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `iqj_failed_jobs`
--
ALTER TABLE `iqj_failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `iqj_firewall_ips`
--
ALTER TABLE `iqj_firewall_ips`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `iqj_firewall_logs`
--
ALTER TABLE `iqj_firewall_logs`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `iqj_invoices`
--
ALTER TABLE `iqj_invoices`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `iqj_invoice_histories`
--
ALTER TABLE `iqj_invoice_histories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `iqj_invoice_items`
--
ALTER TABLE `iqj_invoice_items`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `iqj_invoice_item_taxes`
--
ALTER TABLE `iqj_invoice_item_taxes`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `iqj_invoice_totals`
--
ALTER TABLE `iqj_invoice_totals`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `iqj_items`
--
ALTER TABLE `iqj_items`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `iqj_jobs`
--
ALTER TABLE `iqj_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `iqj_media`
--
ALTER TABLE `iqj_media`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `iqj_migrations`
--
ALTER TABLE `iqj_migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `iqj_modules`
--
ALTER TABLE `iqj_modules`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `iqj_module_histories`
--
ALTER TABLE `iqj_module_histories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `iqj_permissions`
--
ALTER TABLE `iqj_permissions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=146;

--
-- AUTO_INCREMENT for table `iqj_reconciliations`
--
ALTER TABLE `iqj_reconciliations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `iqj_recurring`
--
ALTER TABLE `iqj_recurring`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `iqj_reports`
--
ALTER TABLE `iqj_reports`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `iqj_roles`
--
ALTER TABLE `iqj_roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `iqj_settings`
--
ALTER TABLE `iqj_settings`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `iqj_taxes`
--
ALTER TABLE `iqj_taxes`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `iqj_transactions`
--
ALTER TABLE `iqj_transactions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `iqj_transfers`
--
ALTER TABLE `iqj_transfers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `iqj_users`
--
ALTER TABLE `iqj_users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `iqj_widgets`
--
ALTER TABLE `iqj_widgets`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `iqj_mediables`
--
ALTER TABLE `iqj_mediables`
  ADD CONSTRAINT `iqj_mediables_media_id_foreign` FOREIGN KEY (`media_id`) REFERENCES `iqj_media` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `iqj_role_permissions`
--
ALTER TABLE `iqj_role_permissions`
  ADD CONSTRAINT `iqj_role_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `iqj_permissions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `iqj_role_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `iqj_roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `iqj_user_permissions`
--
ALTER TABLE `iqj_user_permissions`
  ADD CONSTRAINT `iqj_user_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `iqj_permissions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `iqj_user_roles`
--
ALTER TABLE `iqj_user_roles`
  ADD CONSTRAINT `iqj_user_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `iqj_roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
