-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Aug 15, 2024 at 07:25 AM
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
-- Database: `garage`
--

-- --------------------------------------------------------

--
-- Table structure for table `brand`
--

CREATE TABLE `brand` (
  `id` int(11) NOT NULL,
  `categoryid` int(11) NOT NULL,
  `bname` varchar(250) NOT NULL,
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `garage_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `brand`
--

INSERT INTO `brand` (`id`, `categoryid`, `bname`, `status`, `garage_id`) VALUES
(1, 2, 'Toyota', 'active', NULL),
(2, 2, 'Brand 2', 'active', NULL),
(3, 2, 'Brand 3', 'active', NULL),
(4, 1, 'Brand 201', 'active', NULL),
(5, 1, 'Brand 202', 'active', NULL),
(6, 1, 'Brand 203', 'active', NULL),
(7, 3, 'Brand 301', 'active', NULL),
(8, 3, 'Brand 302', 'active', NULL),
(9, 3, 'Brand 303', 'active', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `cart_items`
--

CREATE TABLE `cart_items` (
  `id` int(11) NOT NULL,
  `service_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `unit_price` decimal(10,2) NOT NULL,
  `total_amount` decimal(10,2) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `submitted` tinyint(1) DEFAULT 0,
  `is_paid` tinyint(1) DEFAULT 0,
  `sold_date` datetime DEFAULT current_timestamp(),
  `sold_by` int(11) DEFAULT NULL,
  `garage_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cart_items`
--

INSERT INTO `cart_items` (`id`, `service_id`, `customer_id`, `quantity`, `unit_price`, `total_amount`, `created_at`, `submitted`, `is_paid`, `sold_date`, `sold_by`, `garage_id`) VALUES
(1, 1, 7, 2, 80000.00, NULL, '2024-08-12 07:51:48', 0, 0, '2024-08-12 14:27:29', NULL, NULL),
(2, 1, 8, 2, 80000.00, NULL, '2024-08-12 07:54:15', 0, 0, '2024-08-12 14:27:29', NULL, NULL),
(3, 3, 9, 5, 100000.00, 500000.00, '2024-08-12 08:24:00', 0, 0, '2024-08-12 14:27:29', NULL, NULL),
(4, 1, 10, 5, 80000.00, 400000.00, '2024-08-12 08:47:54', 0, 1, '2024-08-12 14:27:29', NULL, NULL),
(5, 1, 11, 5, 80000.00, 400000.00, '2024-08-12 09:05:12', 0, 1, '2024-08-12 14:27:29', NULL, NULL),
(6, 4, 12, 3, 500000.00, 1500000.00, '2024-08-12 12:49:47', 0, 1, '2024-08-12 15:49:47', NULL, NULL),
(7, 11, 13, 1, 80000.00, 80000.00, '2024-08-13 06:24:19', 0, 1, '2024-08-13 09:24:19', NULL, NULL),
(8, 1, 14, 5, 80000.00, 400000.00, '2024-08-13 07:57:20', 0, 1, '2024-08-13 10:57:20', NULL, NULL),
(9, 3, 14, 1, 100000.00, 100000.00, '2024-08-13 07:57:20', 0, 1, '2024-08-13 10:57:20', NULL, NULL),
(10, 2, 15, 2, 400000.00, 800000.00, '2024-08-13 08:07:50', 0, 1, '2024-08-13 11:07:50', NULL, NULL),
(11, 3, 15, 1, 100000.00, 100000.00, '2024-08-13 08:07:50', 0, 1, '2024-08-13 11:07:50', NULL, NULL),
(12, 1, 15, 1, 80000.00, 80000.00, '2024-08-13 08:07:50', 0, 1, '2024-08-13 11:07:50', NULL, NULL),
(13, 4, 16, 1, 500000.00, 500000.00, '2024-08-13 08:10:25', 0, 0, '2024-08-13 11:10:25', NULL, NULL),
(14, 2, 16, 1, 400000.00, 400000.00, '2024-08-13 08:10:25', 0, 0, '2024-08-13 11:10:25', NULL, NULL),
(15, 1, 17, 5, 80000.00, 400000.00, '2024-08-13 08:18:03', 0, 1, '2024-08-13 11:18:03', NULL, NULL),
(16, 2, 17, 1, 400000.00, 400000.00, '2024-08-13 08:18:03', 0, 1, '2024-08-13 11:18:03', NULL, NULL),
(17, 2, 18, 1, 400000.00, 400000.00, '2024-08-13 12:02:18', 0, 1, '2024-08-13 15:02:18', NULL, NULL),
(18, 3, 18, 2, 100000.00, 200000.00, '2024-08-13 12:02:18', 0, 1, '2024-08-13 15:02:18', NULL, NULL),
(19, 1, 19, 1, 80000.00, 80000.00, '2024-08-14 13:31:55', 0, 0, '2024-08-14 16:31:55', NULL, NULL),
(20, 2, 19, 1, 400000.00, 400000.00, '2024-08-14 13:31:55', 0, 0, '2024-08-14 16:31:55', NULL, NULL),
(21, 1, 20, 5, 80000.00, 400000.00, '2024-08-14 14:26:03', 0, 0, '2024-08-14 17:26:03', NULL, NULL),
(22, 2, 20, 1, 400000.00, 400000.00, '2024-08-14 14:26:04', 0, 0, '2024-08-14 17:26:04', NULL, NULL),
(23, 1, 21, 5, 80000.00, 400000.00, '2024-08-14 18:32:21', 0, 0, '2024-08-14 21:32:21', NULL, NULL),
(24, 2, 21, 1, 400000.00, 400000.00, '2024-08-14 18:32:21', 0, 0, '2024-08-14 21:32:21', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `name` varchar(250) NOT NULL,
  `status` enum('active','inactive') NOT NULL DEFAULT 'active'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `name`, `status`) VALUES
(1, 'Wiring', 'active'),
(2, 'Random Item', 'active'),
(3, 'Speaker', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` int(11) NOT NULL,
  `garage_id` int(11) DEFAULT NULL,
  `service_id` int(11) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `number_plate` varchar(255) NOT NULL,
  `contact` varchar(255) NOT NULL,
  `quantity` int(11) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `garage_id`, `service_id`, `name`, `number_plate`, `contact`, `quantity`, `created_at`, `updated_at`) VALUES
(1, NULL, 1, 'Mujuni Deus', 'UBR 100A', '0703996251', 0, '2024-08-09 08:39:13', '2024-08-09 08:39:13'),
(2, NULL, 3, 'Mugumya Vicent', 'UBD 543Z', '0776322439', 0, '2024-08-09 08:43:22', '2024-08-09 08:43:22'),
(3, NULL, 2, 'Tumutegyerize Paulson', 'UBF 628E', '0776322439', 0, '2024-08-09 08:45:14', '2024-08-09 08:45:14'),
(4, NULL, 4, 'Derrick Dev Automobiles', 'UBQ 100V', '0776322439', 0, '2024-08-09 11:05:05', '2024-08-09 11:05:05'),
(5, NULL, 1, 'Mugumya Vicent', 'UBR 100A', '0776322439', 0, '2024-08-12 07:14:56', '2024-08-12 07:14:56'),
(6, NULL, 1, 'Derrick Dev Automobiles', 'UBD 543Z', '0776322439', 0, '2024-08-12 07:23:39', '2024-08-12 07:23:39'),
(7, NULL, 1, 'Derrick Dev Automobiles', 'UBD 543Z', '0776322439', 2, '2024-08-12 07:51:48', '2024-08-12 07:51:48'),
(8, NULL, 1, 'Derrick Dev Automobiles', 'UBD 543Z', '0776322439', 2, '2024-08-12 07:54:15', '2024-08-12 07:54:15'),
(9, NULL, 3, 'NugSoft Motors', 'UBR 100A', '0776322439', 5, '2024-08-12 08:24:00', '2024-08-12 08:24:00'),
(10, NULL, NULL, 'Ainembabazi Derrick', 'UBD 543Z', '0776322439', 5, '2024-08-12 08:47:54', '2024-08-12 08:47:54'),
(11, NULL, NULL, 'Tito Lutwa', 'UBR 100A', '0776322439', 5, '2024-08-12 09:05:11', '2024-08-12 09:05:11'),
(12, NULL, NULL, 'Mugisha Amon', 'UBR 100A', '0776322439', 3, '2024-08-12 12:49:47', '2024-08-12 12:49:47'),
(13, NULL, NULL, 'Semakokiro James', 'UBR 100A', '0776322439', 1, '2024-08-13 06:24:19', '2024-08-13 06:24:19'),
(14, NULL, NULL, 'Mugumya Vicent', 'UBR 100A', '0776322439', 0, '2024-08-13 07:57:20', '2024-08-13 07:57:20'),
(15, NULL, NULL, 'Ainebyona Frank', 'UBZ123R', '07874628236', 0, '2024-08-13 08:07:50', '2024-08-13 08:07:50'),
(16, NULL, NULL, 'Zilabamuzale Eddie', 'UBD 543Z', '07874628236', 0, '2024-08-13 08:10:24', '2024-08-13 08:10:24'),
(17, NULL, NULL, 'Kaana Kambata', 'UBD 543Z', '0776322439', 0, '2024-08-13 08:18:03', '2024-08-13 08:18:03'),
(18, NULL, NULL, 'Kyamagero Lynnet', 'UBH 100Z', '0789432320', 0, '2024-08-13 12:02:18', '2024-08-13 12:02:18'),
(19, NULL, NULL, 'Kambegye Edith', 'UAZ 867C', '079448378', 0, '2024-08-14 13:31:55', '2024-08-14 13:31:55'),
(20, NULL, NULL, 'Mugumya Vicent', 'UBR 100A', '0776322439', 0, '2024-08-14 14:26:03', '2024-08-14 14:26:03'),
(21, NULL, NULL, 'Mugumya Vicent', 'UBR 100A', '0776322439', 0, '2024-08-14 18:32:20', '2024-08-14 18:32:20');

-- --------------------------------------------------------

--
-- Table structure for table `garages`
--

CREATE TABLE `garages` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `address` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `garages`
--

INSERT INTO `garages` (`id`, `name`, `address`, `created_at`, `updated_at`) VALUES
(1, 'NugSoft Motors', 'Kyanja', NULL, NULL),
(3, 'Collin Motors', 'Nakawa', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `ims_supplier`
--

CREATE TABLE `ims_supplier` (
  `id` int(11) NOT NULL,
  `supplier_name` varchar(200) NOT NULL,
  `mobile` varchar(50) NOT NULL,
  `address` text NOT NULL,
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `garage_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `ims_supplier`
--

INSERT INTO `ims_supplier` (`id`, `supplier_name`, `mobile`, `address`, `status`, `garage_id`) VALUES
(1, 'Supplier 101', '09645987123', 'Over Here', 'active', NULL),
(2, 'Supplier 102', '094568791252', 'Over There', 'active', NULL),
(3, 'Simba Auto mobiles', '09789897879', 'Kamwokya', 'active', NULL),
(4, 'Mugumya Vicent', '07793734672', 'Kyanja', 'active', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `order`
--

CREATE TABLE `order` (
  `id` int(11) NOT NULL,
  `product_id` varchar(255) NOT NULL,
  `total_shipped` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `order_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `order`
--

INSERT INTO `order` (`id`, `product_id`, `total_shipped`, `customer_id`, `order_date`) VALUES
(1, '1', 5, 1, '2022-06-20 08:20:40'),
(2, '2', 3, 2, '2022-06-20 08:20:48');

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` int(11) NOT NULL,
  `permission_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `categoryid` int(11) NOT NULL,
  `brandid` int(11) NOT NULL,
  `pname` varchar(300) NOT NULL,
  `model` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `quantity` int(11) NOT NULL,
  `unit` varchar(150) NOT NULL,
  `base_price` double(10,2) NOT NULL,
  `tax` decimal(4,2) NOT NULL,
  `minimum_order` double(10,2) NOT NULL,
  `supplier` int(11) NOT NULL,
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `categoryid`, `brandid`, `pname`, `model`, `description`, `quantity`, `unit`, `base_price`, `tax`, `minimum_order`, `supplier`, `status`, `date`) VALUES
(1, 2, 1, 'Product 101', 'P-1001', 'usce auctor faucibus efficitur.', 10, 'Bottles', 500.00, 12.00, 1.00, 1, 'active', '0000-00-00'),
(2, 1, 4, 'Product 102', 'P-1002', 'Proin vehicula mi pulvinar ipsum ornare tincidunt.', 15, 'Box', 7500.00, 12.00, 1.00, 2, 'active', '0000-00-00'),
(3, 3, 7, 'Product 103', 'P-1003', 'Integer interdum, odio eget mattis venenatis', 20, 'Bags', 350.00, 12.00, 1.00, 3, 'active', '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `purchase`
--

CREATE TABLE `purchase` (
  `id` int(11) NOT NULL,
  `supplier_id` varchar(255) DEFAULT NULL,
  `product_id` varchar(255) DEFAULT NULL,
  `quantity` varchar(255) DEFAULT NULL,
  `purchase_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `purchase`
--

INSERT INTO `purchase` (`id`, `supplier_id`, `product_id`, `quantity`, `purchase_date`) VALUES
(1, '1', '1', '25', '2022-06-20 08:20:07'),
(2, '2', '2', '35', '2022-06-20 08:20:14'),
(3, '3', '3', '10', '2022-06-20 08:20:29');

-- --------------------------------------------------------

--
-- Table structure for table `purchase_order_list`
--

CREATE TABLE `purchase_order_list` (
  `id` int(30) NOT NULL,
  `po_code` varchar(50) NOT NULL,
  `supplier_id` int(30) NOT NULL,
  `amount` float NOT NULL,
  `discount_perc` float NOT NULL DEFAULT 0,
  `discount` float NOT NULL DEFAULT 0,
  `tax_perc` float NOT NULL DEFAULT 0,
  `tax` float NOT NULL DEFAULT 0,
  `remarks` text NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0 = pending, 1 = partially received, 2 =received',
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  `date_updated` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `purchase_order_list`
--

INSERT INTO `purchase_order_list` (`id`, `po_code`, `supplier_id`, `amount`, `discount_perc`, `discount`, `tax_perc`, `tax`, `remarks`, `status`, `date_created`, `date_updated`) VALUES
(1, 'PO-0001', 1, 81480, 3, 2250, 12, 8730, 'Sample', 2, '2021-11-03 11:20:22', '2021-11-03 11:21:00'),
(2, 'PO-0002', 2, 107464, 5, 5050, 12, 11514, 'Sample PO Only', 2, '2021-11-03 11:50:50', '2021-11-03 11:52:15');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `role_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `role_name`) VALUES
(1, 'mechanic'),
(2, 'Cashier');

-- --------------------------------------------------------

--
-- Table structure for table `role_permissions`
--

CREATE TABLE `role_permissions` (
  `role_id` int(11) NOT NULL,
  `permission_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `id` int(11) NOT NULL,
  `garage_id` int(11) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `cost_price` bigint(20) DEFAULT NULL,
  `price` bigint(20) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`id`, `garage_id`, `name`, `cost_price`, `price`, `created_at`, `updated_at`) VALUES
(1, NULL, 'Wheel Alignment', 80000, 100000, '2024-08-09 07:21:04', '2024-08-09 07:21:04'),
(2, NULL, 'Spraying', 400000, 500000, '2024-08-09 07:42:06', '2024-08-09 07:42:06'),
(3, NULL, 'Repairs', 100000, 200000, '2024-08-09 07:54:39', '2024-08-09 07:54:39'),
(4, NULL, 'General Maintenance', 500000, 700000, '2024-08-09 07:55:16', '2024-08-09 07:55:16'),
(5, NULL, 'Diagnostics', 50000, 100000, '2024-08-09 07:56:06', '2024-08-09 07:56:06'),
(6, NULL, 'Body and Paints Work', 1000000, 2000000, '2024-08-09 07:56:51', '2024-08-09 10:03:42'),
(8, NULL, 'Mujuni Deus', 123456, 100000, '2024-08-09 10:08:34', '2024-08-09 10:08:34'),
(10, NULL, 'Mugumya Vicent', 150001, 100000, '2024-08-09 10:11:01', '2024-08-09 10:12:40'),
(11, NULL, 'Android radio', 80000, 100000, '2024-08-13 06:16:36', '2024-08-13 06:16:36'),
(13, NULL, 'Steer Rack', 60000, 100000, '2024-08-13 09:53:47', '2024-08-13 09:56:51');

-- --------------------------------------------------------

--
-- Table structure for table `site_activity_log_automation_tbl`
--

CREATE TABLE `site_activity_log_automation_tbl` (
  `id` bigint(30) NOT NULL,
  `user_id` bigint(30) NOT NULL,
  `ip` varchar(25) NOT NULL,
  `url` text NOT NULL,
  `action` text NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `site_activity_log_automation_tbl`
--

INSERT INTO `site_activity_log_automation_tbl` (`id`, `user_id`, `ip`, `url`, `action`, `created_at`) VALUES
(1, 1, '::1', 'http://localhost/garage/login.php', 'successfully logged-in', '2024-08-08 10:11:38'),
(2, 1, '::1', 'http://localhost/garage/login.php', 'successfully logged-in', '2024-08-08 10:15:32'),
(3, 1, '::1', 'http://localhost/garage/login.php', 'successfully logged-in', '2024-08-08 10:19:44'),
(4, 1, '::1', 'http://localhost/garage/login.php', 'successfully logged-in', '2024-08-08 10:21:01'),
(5, 1, '::1', 'http://localhost/garage/login.php', 'successfully logged-in', '2024-08-08 10:21:44'),
(6, 1, '::1', 'http://localhost/garage/services/index.php', 'added new service [ID#]', '2024-08-08 11:06:45'),
(7, 1, '::1', 'http://localhost/garage/services/index.php', 'edited service [ID#1]', '2024-08-08 11:08:41'),
(8, 1, '::1', 'http://localhost/garage/services/index.php', 'added new service [ID#]', '2024-08-08 11:35:44'),
(9, 1, '::1', 'http://localhost/garage/login.php', 'successfully logged-in', '2024-08-08 12:14:18'),
(10, 1, '::1', 'http://localhost/garage/services/index.php', 'added new service [ID#]', '2024-08-08 12:39:26'),
(11, 1, '::1', 'http://localhost/garage/garage.php', 'added new service [ID#]', '2024-08-08 15:02:17'),
(12, 1, '::1', 'http://localhost/garage/garage.php', 'added new service [ID#]', '2024-08-08 15:03:39'),
(13, 1, '::1', 'http://localhost/garage/garage.php', 'added new service [ID#]', '2024-08-08 15:10:48'),
(14, 1, '::1', 'http://localhost/garage/garage.php', 'edited service [ID#2]', '2024-08-08 15:25:01'),
(15, 1, '::1', 'http://localhost/garage/garage.php', 'edited service [ID#2]', '2024-08-08 15:29:26'),
(16, 1, '::1', 'http://localhost/garage/garage.php', 'edited service [ID#2]', '2024-08-08 15:29:29'),
(17, 1, '::1', 'http://localhost/garage/garage.php', 'edited service [ID#2]', '2024-08-08 15:29:33'),
(18, 1, '::1', 'http://localhost/garage/garage.php', 'added new garage [ID#]', '2024-08-08 15:36:24'),
(19, 1, '::1', 'http://localhost/garage/garage.php', 'edited garage [ID#4]', '2024-08-08 15:36:32'),
(20, 1, '::1', 'http://localhost/garage/delete_garage.php?id=4', 'deleted a garage [ID#4]', '2024-08-08 15:36:38'),
(21, 1, '::1', 'http://localhost/garage/users.php', 'added new users [ID#]', '2024-08-08 17:51:36'),
(22, 1, '::1', 'http://localhost/garage/login.php', 'successfully logged-in', '2024-08-08 18:07:27'),
(23, 1, '::1', 'http://localhost/garage/services/index.php', 'added new service [ID#]', '2024-08-08 18:08:48'),
(24, 1, '::1', 'http://localhost/garage/login.php', 'successfully logged-in', '2024-08-09 08:08:04'),
(25, 1, '::1', 'http://localhost/garage/services/index.php', 'added new service [ID#]', '2024-08-09 08:21:53'),
(26, 1, '::1', 'http://localhost/garage/services/index.php', 'added new service [ID#]', '2024-08-09 08:26:11'),
(27, 1, '::1', 'http://localhost/garage/services/index.php', 'added new service [ID#]', '2024-08-09 08:27:10'),
(28, 1, '::1', 'http://localhost/garage/services/index.php', 'added new service [ID#]', '2024-08-09 08:27:40'),
(29, 1, '::1', 'http://localhost/garage/services/index.php', 'added new service [ID#]', '2024-08-09 08:27:44'),
(30, 1, '::1', 'http://localhost/garage/services/index.php', 'added new service [ID#]', '2024-08-09 08:29:16'),
(31, 1, '::1', 'http://localhost/garage/services/index.php', 'added new service [ID#]', '2024-08-09 08:29:22'),
(32, 1, '::1', 'http://localhost/garage/services/index.php', 'added new service [ID#]', '2024-08-09 08:31:49'),
(33, 1, '::1', 'http://localhost/garage/services/index.php', 'added new service [ID#]', '2024-08-09 08:37:04'),
(34, 1, '::1', 'http://localhost/garage/services/index.php', 'added new service [ID#]', '2024-08-09 08:37:16'),
(35, 1, '::1', 'http://localhost/garage/services/index.php', 'added new service [ID#]', '2024-08-09 08:37:33'),
(36, 1, '::1', 'http://localhost/garage/services/index.php', 'added new service [ID#]', '2024-08-09 08:44:55'),
(37, 1, '::1', 'http://localhost/garage/services/index.php', 'added new service [ID#]', '2024-08-09 08:46:09'),
(38, 1, '::1', 'http://localhost/garage/services/index.php', 'added new service [ID#]', '2024-08-09 08:47:18'),
(39, 1, '::1', 'http://localhost/garage/services/index.php', 'added new service [ID#]', '2024-08-09 08:47:52'),
(40, 1, '::1', 'http://localhost/garage/services/index.php', 'edited service [ID#13]', '2024-08-09 08:50:11'),
(41, 1, '::1', 'http://localhost/garage/services/index.php', 'edited service [ID#13]', '2024-08-09 08:55:20'),
(42, 1, '::1', 'http://localhost/garage/delete_service.php?id=13', 'deleted service [ID#13]', '2024-08-09 08:59:47'),
(43, 1, '::1', 'http://localhost/garage/delete_service.php?id=15', 'deleted service [ID#15]', '2024-08-09 09:00:12'),
(44, 1, '::1', 'http://localhost/garage/delete_service.php?id=12', 'deleted service []', '2024-08-09 09:04:19'),
(45, 1, '::1', 'http://localhost/garage/delete_service.php?id=11', 'deleted service []', '2024-08-09 09:05:49'),
(46, 1, '::1', 'http://localhost/garage/services/index.php', 'added new service [ID#]', '2024-08-09 09:15:54'),
(47, 1, '::1', 'http://localhost/garage/services/index.php', 'added new service [ID#]', '2024-08-09 09:16:28'),
(48, 1, '::1', 'http://localhost/garage/services/index.php', 'added new service [ID#]', '2024-08-09 09:16:33'),
(49, 1, '::1', 'http://localhost/garage/delete_service.php?id=26', 'deleted service [ID#26]', '2024-08-09 09:17:02'),
(50, 1, '::1', 'http://localhost/garage/services/index.php', 'added new service [ID#]', '2024-08-09 09:18:01'),
(51, 1, '::1', 'http://localhost/garage/services/index.php', 'added new service [ID#]', '2024-08-09 09:18:09'),
(52, 1, '::1', 'http://localhost/garage/services/index.php', 'edited service [ID#2]', '2024-08-09 09:19:04'),
(53, 1, '::1', 'http://localhost/garage/delete_service.php?id=30', 'deleted service [ID#30]', '2024-08-09 09:19:18'),
(54, 1, '::1', 'http://localhost/garage/services/index.php', 'added new service [ID#]', '2024-08-09 09:19:42'),
(55, 1, '::1', 'http://localhost/garage/services/index.php', 'added new service [ID#]', '2024-08-09 09:19:49'),
(56, 1, '::1', 'http://localhost/garage/delete_service.php?id=32', 'deleted service [ID#32]', '2024-08-09 09:20:01'),
(57, 1, '::1', 'http://localhost/garage/delete_service.php?id=28', 'deleted service [ID#28]', '2024-08-09 09:22:18'),
(58, 1, '::1', 'http://localhost/garage/login.php', 'successfully logged-in', '2024-08-09 09:45:59'),
(59, 1, '::1', 'http://localhost/garage/services/index.php', 'added new service [ID#]', '2024-08-09 10:21:04'),
(60, 1, '::1', 'http://localhost/garage/services/index.php', 'edited service [ID#1]', '2024-08-09 10:21:15'),
(61, 1, '::1', 'http://localhost/garage/services/index.php', 'edited service [ID#1]', '2024-08-09 10:30:35'),
(62, 1, '::1', 'http://localhost/garage/services/index.php', 'edited service [ID#1]', '2024-08-09 10:31:12'),
(63, 1, '::1', 'http://localhost/garage/services/index.php', 'added new service [ID#]', '2024-08-09 10:42:06'),
(64, 1, '::1', 'http://localhost/garage/services/index.php', 'added new service [ID#]', '2024-08-09 10:54:39'),
(65, 1, '::1', 'http://localhost/garage/services/index.php', 'added new service [ID#]', '2024-08-09 10:55:16'),
(66, 1, '::1', 'http://localhost/garage/services/index.php', 'added new service [ID#]', '2024-08-09 10:56:06'),
(67, 1, '::1', 'http://localhost/garage/services/index.php', 'added new service [ID#]', '2024-08-09 10:56:51'),
(68, 1, '::1', 'http://localhost/garage/customers.php', 'added new customers [ID#]', '2024-08-09 11:39:13'),
(69, 1, '::1', 'http://localhost/garage/customers.php', 'added new customers [ID#]', '2024-08-09 11:43:22'),
(70, 1, '::1', 'http://localhost/garage/customers.php', 'added new customers [ID#]', '2024-08-09 11:45:14'),
(71, 1, '::1', 'http://localhost/garage/services/index.php', 'added new service [ID#]', '2024-08-09 12:21:19'),
(72, 1, '::1', 'http://localhost/garage/delete_service.php?id=7', 'deleted service [ID#7]', '2024-08-09 12:21:44'),
(73, 1, '::1', 'http://localhost/garage/garage.php', 'edited garage [ID#1]', '2024-08-09 12:36:17'),
(74, 1, '::1', 'http://localhost/garage/services/index.php', 'edited service [ID#6]', '2024-08-09 13:03:43'),
(75, 1, '::1', 'http://localhost/garage/services/index.php', 'added new service [ID#]', '2024-08-09 13:08:34'),
(76, 1, '::1', 'http://localhost/garage/services/index.php', 'added new service [ID#]', '2024-08-09 13:09:43'),
(77, 1, '::1', 'http://localhost/garage/delete_service.php?id=9', 'deleted service [ID#9]', '2024-08-09 13:10:52'),
(78, 1, '::1', 'http://localhost/garage/services/index.php', 'added new service [ID#]', '2024-08-09 13:11:01'),
(79, 1, '::1', 'http://localhost/garage/services/index.php', 'edited service [ID#10]', '2024-08-09 13:11:22'),
(80, 1, '::1', 'http://localhost/garage/services/index.php', 'edited service [ID#10]', '2024-08-09 13:12:41'),
(81, 1, '::1', 'http://localhost/garage/customers.php', 'added new customers [ID#]', '2024-08-09 14:05:05'),
(82, 1, '::1', 'http://localhost/garage/staff.php', 'added new garage [ID#]', '2024-08-09 15:34:47'),
(83, 1, '::1', 'http://localhost/garage/staff.php', 'added new Staff [ID#]', '2024-08-09 16:03:08'),
(84, 1, '::1', 'http://localhost/garage/garage.php', 'edited garage [ID#1]', '2024-08-09 16:13:56'),
(85, 1, '::1', 'http://localhost/garage/delete_staff.php?id=1', 'deleted a staff [ID#1]', '2024-08-09 16:26:40'),
(86, 1, '::1', 'http://localhost/garage/login.php', 'successfully logged-in', '2024-08-10 08:50:00'),
(87, 1, '::1', 'http://localhost/garage/supplier.php', 'added new Supplier [ID#]', '2024-08-10 10:24:56'),
(88, 1, '::1', 'http://localhost/garage/supplier.php', 'edited supplier [ID#3]', '2024-08-10 10:34:38'),
(89, 1, '::1', 'http://localhost/garage/category.php', 'edited category [ID#1]', '2024-08-10 10:51:51'),
(90, 1, '::1', 'http://localhost/garage/category.php', 'edited category [ID#1]', '2024-08-10 11:17:49'),
(91, 1, '::1', 'http://localhost/garage/brand.php', 'edited brand [ID#1]', '2024-08-10 11:32:05'),
(92, 1, '::1', 'http://localhost/garage/login.php', 'successfully logged-in', '2024-08-11 22:18:48'),
(93, 1, '::1', 'http://localhost/garage/login.php', 'successfully logged-in', '2024-08-11 22:23:42'),
(94, 1, '::1', 'http://localhost/garage/login.php', 'successfully logged-in', '2024-08-12 07:56:33'),
(95, 1, '::1', 'http://localhost/garage/login.php', 'successfully logged-in', '2024-08-12 08:48:24'),
(96, 1, '::1', 'http://localhost/garage/login.php', 'successfully logged-in', '2024-08-12 09:49:05'),
(97, 1, '::1', 'http://localhost/garage/login.php', 'successfully logged-in', '2024-08-12 09:50:27'),
(98, 1, '::1', 'http://localhost/garage/staff.php', 'added new Staff [ID#]', '2024-08-12 09:51:21'),
(99, 1, '::1', 'http://localhost/garage/customer.php', 'added new customers [ID#]', '2024-08-12 10:14:56'),
(100, 1, '::1', 'http://localhost/garage/customer.php', 'added new customers [ID#]', '2024-08-12 10:23:39'),
(101, 1, '::1', 'http://localhost/garage/customer.php', 'added new customer to cart [ID#7]', '2024-08-12 10:51:48'),
(102, 1, '::1', 'http://localhost/garage/customer.php', 'added new customer to cart [ID#8]', '2024-08-12 10:54:15'),
(103, 1, '::1', 'http://localhost/garage/customer.php', 'added new customers [ID#9]', '2024-08-12 11:24:00'),
(104, 1, '::1', 'http://localhost/garage/customer.php', 'added new customer [ID#10]', '2024-08-12 11:47:54'),
(105, 1, '::1', 'http://localhost/garage/customer.php', 'added new customer [ID#11]', '2024-08-12 12:05:12'),
(106, 1, '::1', 'http://localhost/garage/customer.php', 'added new customer [ID#12]', '2024-08-12 15:49:47'),
(107, 1, '::1', 'http://localhost/garage/login.php', 'successfully logged-in', '2024-08-13 08:05:28'),
(108, 1, '::1', 'http://localhost/garage/login.php', 'successfully logged-in', '2024-08-13 08:43:57'),
(109, 1, '::1', 'http://localhost/garage/login.php', 'successfully logged-in', '2024-08-13 08:53:19'),
(110, 2, '::1', 'http://localhost/garage/login.php', 'successfully logged-in', '2024-08-13 08:53:58'),
(111, 1, '::1', 'http://localhost/garage/login.php', 'successfully logged-in', '2024-08-13 08:59:36'),
(112, 1, '::1', 'http://localhost/garage/login.php', 'successfully logged-in', '2024-08-13 09:01:32'),
(113, 2, '::1', 'http://localhost/garage/login.php', 'successfully logged-in', '2024-08-13 09:05:56'),
(114, 2, '::1', 'http://localhost/garage/cashier_services.php', 'added new service [ID#]', '2024-08-13 09:16:36'),
(115, 2, '::1', 'http://localhost/garage/cashier_services.php', 'added new service [ID#]', '2024-08-13 09:19:45'),
(116, 2, '::1', 'http://localhost/garage/delete_service.php?id=12', 'deleted service [ID#12]', '2024-08-13 09:19:53'),
(117, 2, '::1', 'http://localhost/garage/login.php', 'successfully logged-in', '2024-08-13 09:21:04'),
(118, 1, '::1', 'http://localhost/garage/login.php', 'successfully logged-in', '2024-08-13 09:23:16'),
(119, 2, '::1', 'http://localhost/garage/login.php', 'successfully logged-in', '2024-08-13 09:23:41'),
(120, 2, '::1', 'http://localhost/garage/cashier_customer.php', 'added new customer [ID#13]', '2024-08-13 09:24:19'),
(121, 2, '::1', 'http://localhost/garage/login.php', 'successfully logged-in', '2024-08-13 09:25:17'),
(122, 2, '::1', 'http://localhost/garage/login.php', 'successfully logged-in', '2024-08-13 09:43:04'),
(123, 1, '::1', 'http://localhost/garage/login.php', 'successfully logged-in', '2024-08-13 09:52:57'),
(124, 2, '::1', 'http://localhost/garage/login.php', 'successfully logged-in', '2024-08-13 10:29:46'),
(125, 2, '::1', 'http://localhost/garage/customar.php', 'added services to customer [ID#]', '2024-08-13 10:34:52'),
(126, 2, '::1', 'http://localhost/garage/customar.php', 'added new customer [ID#14] with multiple services', '2024-08-13 10:57:20'),
(127, 1, '::1', 'http://localhost/garage/login.php', 'successfully logged-in', '2024-08-13 11:06:08'),
(128, 1, '::1', 'http://localhost/garage/customer.php', 'added new customer [ID#15] with multiple services', '2024-08-13 11:07:50'),
(129, 1, '::1', 'http://localhost/garage/customer.php', 'added new customer [ID#16] with multiple services', '2024-08-13 11:10:25'),
(130, 1, '::1', 'http://localhost/garage/users.php', 'added new users [ID#]', '2024-08-13 11:15:19'),
(131, 4, '::1', 'http://localhost/garage/login.php', 'successfully logged-in', '2024-08-13 11:17:03'),
(132, 4, '::1', 'http://localhost/garage/customar.php', 'added new customer [ID#17] with multiple services', '2024-08-13 11:18:03'),
(133, 1, '::1', 'http://localhost/garage/login.php', 'successfully logged-in', '2024-08-13 11:18:15'),
(134, 1, '::1', 'http://localhost/garage/services/index.php', 'added new service [ID#]', '2024-08-13 12:53:47'),
(135, 1, '::1', 'http://localhost/garage/services/index.php', 'edited service [ID#13]', '2024-08-13 12:56:51'),
(136, 4, '::1', 'http://localhost/garage/login.php', 'successfully logged-in', '2024-08-13 13:06:36'),
(137, 1, '::1', 'http://localhost/garage/login.php', 'successfully logged-in', '2024-08-13 13:09:03'),
(138, 1, '::1', 'http://localhost/garage/login.php', 'successfully logged-in', '2024-08-13 14:58:38'),
(139, 1, '::1', 'http://localhost/garage/customer.php', 'added new customer [ID#18] with multiple services', '2024-08-13 15:02:18'),
(140, 1, '::1', 'http://localhost/garage/staff.php', 'added new Staff [ID#]', '2024-08-13 15:20:11'),
(141, 4, '::1', 'http://localhost/garage/login.php', 'successfully logged-in', '2024-08-13 15:53:07'),
(142, 1, '::1', 'http://localhost/garage/login.php', 'successfully logged-in', '2024-08-13 15:54:43'),
(143, 1, '::1', 'http://localhost/garage/users.php', 'added new users [ID#]', '2024-08-13 15:57:04'),
(144, 5, '::1', 'http://localhost/garage/log.php', 'successfully logged-in', '2024-08-13 16:06:36'),
(145, 1, '::1', 'http://localhost/garage/login.php', 'successfully logged-in', '2024-08-14 16:13:07'),
(146, 1, '::1', 'http://localhost/garage/customer.php', 'added new customer [ID#19] with multiple services', '2024-08-14 16:31:55'),
(147, 1, '::1', 'http://localhost/garage/login.php', 'successfully logged-in', '2024-08-14 16:54:51'),
(148, 1, '::1', 'http://localhost/garage/customer.php', 'added new customer [ID#20] with multiple services', '2024-08-14 17:26:04'),
(149, 1, '::1', 'http://localhost/garage/customer.php', 'added new customer [ID#21] with multiple services', '2024-08-14 21:32:21');

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE `staff` (
  `id` int(11) NOT NULL,
  `garage_id` int(11) DEFAULT NULL,
  `service_id` int(11) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `age` varchar(255) NOT NULL,
  `contact` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`id`, `garage_id`, `service_id`, `name`, `age`, `contact`, `address`, `email`, `created_at`, `updated_at`) VALUES
(2, NULL, 2, 'Mugumya Vicent', '26', '0776322439', 'Nakawa', 'deus@gmail', '2024-08-09 13:03:08', '2024-08-09 13:03:08'),
(3, NULL, 4, 'Mujuni Deus', '26', '0776322439', 'Nakawa', 'deus@gmail.com', '2024-08-12 06:51:21', '2024-08-12 06:51:21'),
(4, NULL, 11, 'Abaho John', '30', '0709238748', 'Kampala', 'abaho@gmail.com', '2024-08-13 12:20:11', '2024-08-13 12:20:11');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `garage_id` int(11) DEFAULT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `email` varchar(200) NOT NULL,
  `phone` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL,
  `role` varchar(200) NOT NULL DEFAULT 'client',
  `permissions` varchar(1000) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `garage_id`, `first_name`, `last_name`, `email`, `phone`, `password`, `role`, `permissions`, `created_at`) VALUES
(1, 1, 'Derrick', 'Ainembabazi', 'derrick@gmail.com', '0703996251', '123456', 'admin', NULL, '2024-08-07 08:34:52'),
(2, 3, 'vicent', 'Mugumya', 'vicent@gmail.com', '0776322439', '123456', 'cashier', NULL, '2024-08-07 11:02:15'),
(3, 1, 'Abertson', 'Amumpaire', 'abert@gmail.com', '+234445598746', '$2y$10$OAojDrV42TXLNA5.yFjcaepR6FCh.cq3UYaqz19sw4N.7lgvd2BJm', 'cashier', NULL, '2024-08-08 17:51:36'),
(4, 1, 'Arinaitwe', 'Sylvia', 'sylvia@gmail.com', '0779432329', '123456', 'cashier', NULL, '2024-08-13 11:15:19'),
(5, 1, 'Amperize', 'Jovan', 'jovan@gmail.com', '+234445598746', '$2y$10$IWmh0rXpx.gU1pM.rc.tTedeJJhuW9dWgFmZqVMAH5qN3WTZgUZfC', 'cashier', NULL, '2024-08-13 15:57:04');

-- --------------------------------------------------------

--
-- Table structure for table `user_roles`
--

CREATE TABLE `user_roles` (
  `user_id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_roles`
--

INSERT INTO `user_roles` (`user_id`, `role_id`) VALUES
(1, 2),
(2, 1),
(3, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `brand`
--
ALTER TABLE `brand`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cart_items`
--
ALTER TABLE `cart_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `service_id` (`service_id`),
  ADD KEY `customer_id` (`customer_id`),
  ADD KEY `fk_garage` (`garage_id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `garage_id` (`garage_id`),
  ADD KEY `service_id` (`service_id`);

--
-- Indexes for table `garages`
--
ALTER TABLE `garages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ims_supplier`
--
ALTER TABLE `ims_supplier`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_garage_id` (`garage_id`);

--
-- Indexes for table `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `purchase`
--
ALTER TABLE `purchase`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `purchase_order_list`
--
ALTER TABLE `purchase_order_list`
  ADD PRIMARY KEY (`id`),
  ADD KEY `supplier_id` (`supplier_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `role_permissions`
--
ALTER TABLE `role_permissions`
  ADD PRIMARY KEY (`role_id`,`permission_id`),
  ADD KEY `permission_id` (`permission_id`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`),
  ADD KEY `garage_id` (`garage_id`);

--
-- Indexes for table `site_activity_log_automation_tbl`
--
ALTER TABLE `site_activity_log_automation_tbl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`id`),
  ADD KEY `garage_id` (`garage_id`),
  ADD KEY `service_id` (`service_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `garage_id` (`garage_id`);

--
-- Indexes for table `user_roles`
--
ALTER TABLE `user_roles`
  ADD PRIMARY KEY (`user_id`,`role_id`),
  ADD KEY `role_id` (`role_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `brand`
--
ALTER TABLE `brand`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `cart_items`
--
ALTER TABLE `cart_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `garages`
--
ALTER TABLE `garages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `ims_supplier`
--
ALTER TABLE `ims_supplier`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `order`
--
ALTER TABLE `order`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `purchase`
--
ALTER TABLE `purchase`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `purchase_order_list`
--
ALTER TABLE `purchase_order_list`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `site_activity_log_automation_tbl`
--
ALTER TABLE `site_activity_log_automation_tbl`
  MODIFY `id` bigint(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=150;

--
-- AUTO_INCREMENT for table `staff`
--
ALTER TABLE `staff`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart_items`
--
ALTER TABLE `cart_items`
  ADD CONSTRAINT `cart_items_ibfk_1` FOREIGN KEY (`service_id`) REFERENCES `services` (`id`),
  ADD CONSTRAINT `cart_items_ibfk_2` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`),
  ADD CONSTRAINT `fk_garage` FOREIGN KEY (`garage_id`) REFERENCES `garages` (`id`);

--
-- Constraints for table `customers`
--
ALTER TABLE `customers`
  ADD CONSTRAINT `customers_ibfk_1` FOREIGN KEY (`garage_id`) REFERENCES `garages` (`id`),
  ADD CONSTRAINT `customers_ibfk_2` FOREIGN KEY (`service_id`) REFERENCES `services` (`id`);

--
-- Constraints for table `ims_supplier`
--
ALTER TABLE `ims_supplier`
  ADD CONSTRAINT `fk_garage_id` FOREIGN KEY (`garage_id`) REFERENCES `garages` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `role_permissions`
--
ALTER TABLE `role_permissions`
  ADD CONSTRAINT `role_permissions_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`),
  ADD CONSTRAINT `role_permissions_ibfk_2` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`);

--
-- Constraints for table `services`
--
ALTER TABLE `services`
  ADD CONSTRAINT `services_ibfk_1` FOREIGN KEY (`garage_id`) REFERENCES `garages` (`id`);

--
-- Constraints for table `staff`
--
ALTER TABLE `staff`
  ADD CONSTRAINT `staff_ibfk_1` FOREIGN KEY (`garage_id`) REFERENCES `garages` (`id`),
  ADD CONSTRAINT `staff_ibfk_2` FOREIGN KEY (`service_id`) REFERENCES `services` (`id`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`garage_id`) REFERENCES `garages` (`id`);

--
-- Constraints for table `user_roles`
--
ALTER TABLE `user_roles`
  ADD CONSTRAINT `user_roles_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `user_roles_ibfk_2` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
