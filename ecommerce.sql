-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 11, 2021 at 07:13 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ecommerce`
--

-- --------------------------------------------------------

--
-- Table structure for table `add_to_cards`
--

CREATE TABLE `add_to_cards` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `session_id` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `quantity` double(8,2) NOT NULL DEFAULT 0.00,
  `unit_price` double(8,2) NOT NULL DEFAULT 0.00,
  `total_price` double(8,2) NOT NULL DEFAULT 0.00,
  `data` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`data`)),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `add_to_cards`
--

INSERT INTO `add_to_cards` (`id`, `session_id`, `product_id`, `quantity`, `unit_price`, `total_price`, `data`, `created_at`, `updated_at`) VALUES
(6, '9J0Lkegmbrds9JvVHGRJq5VRkdsPOz15vyZnHU3p', 3, 1.00, 150.00, 150.00, '{\"product_id\":3,\"product_name\":\"Memory Card\",\"regular_price\":120,\"special_price\":150,\"image\":\"j3WS5exhgTdo8jfo9VccBwpwSgORnes55NjyHZlF.png\"}', '2021-08-09 22:40:28', '2021-08-09 22:40:28'),
(7, '9J0Lkegmbrds9JvVHGRJq5VRkdsPOz15vyZnHU3p', 1, 1.00, 120.00, 120.00, '{\"product_id\":1,\"product_name\":\"Pensrive\",\"regular_price\":150,\"special_price\":120,\"image\":\"KghsZrMJWH39pYyfmmXgQp4zHhV00SDGoFgzIjBa.jpg\"}', '2021-08-09 22:40:29', '2021-08-09 22:40:29'),
(8, '9J0Lkegmbrds9JvVHGRJq5VRkdsPOz15vyZnHU3p', 4, 1.00, 300.00, 300.00, '{\"product_id\":4,\"product_name\":\"8 Gb Pendrive\",\"regular_price\":250,\"special_price\":300,\"image\":\"Bz0T6gEu341lUfVbi1HbJjt7CYxDEo0kD8Qlqd8F.jpg\"}', '2021-08-09 22:40:30', '2021-08-09 22:40:30'),
(9, '9J0Lkegmbrds9JvVHGRJq5VRkdsPOz15vyZnHU3p', 5, 1.00, 200.00, 200.00, '{\"product_id\":5,\"product_name\":\"16 gb Pendrive\",\"regular_price\":250,\"special_price\":200,\"image\":\"smx4PXqp4cAY5fw4UU777Krks9lkN5bH22I8iV1i.png\"}', '2021-08-09 22:40:31', '2021-08-09 22:40:31'),
(10, '9J0Lkegmbrds9JvVHGRJq5VRkdsPOz15vyZnHU3p', 2, 1.00, 110.00, 110.00, '{\"product_id\":2,\"product_name\":\"new item\",\"regular_price\":120,\"special_price\":110,\"image\":\"4Q9DM7yD3oMnh5mB5VOW1DcVXFK8C59NtdTLNFb8.jpg\"}', '2021-08-09 22:40:33', '2021-08-09 22:40:33'),
(11, '890neH1faVVKWRefqQCLGF91V1DiLlpZOUWq3DQQ', 2, 6.00, 110.00, 660.00, '{\"product_id\":2,\"product_name\":\"new item\",\"regular_price\":120,\"special_price\":110,\"image\":\"4Q9DM7yD3oMnh5mB5VOW1DcVXFK8C59NtdTLNFb8.jpg\"}', '2021-08-09 22:42:03', '2021-08-09 23:46:15'),
(12, '890neH1faVVKWRefqQCLGF91V1DiLlpZOUWq3DQQ', 3, 6.00, 150.00, 900.00, '{\"product_id\":3,\"product_name\":\"Memory Card\",\"regular_price\":120,\"special_price\":150,\"image\":\"j3WS5exhgTdo8jfo9VccBwpwSgORnes55NjyHZlF.png\"}', '2021-08-09 22:42:06', '2021-08-09 23:46:12'),
(13, '890neH1faVVKWRefqQCLGF91V1DiLlpZOUWq3DQQ', 4, 6.00, 300.00, 1800.00, '{\"product_id\":4,\"product_name\":\"8 Gb Pendrive\",\"regular_price\":250,\"special_price\":300,\"image\":\"Bz0T6gEu341lUfVbi1HbJjt7CYxDEo0kD8Qlqd8F.jpg\"}', '2021-08-09 22:42:08', '2021-08-09 23:46:10'),
(14, '890neH1faVVKWRefqQCLGF91V1DiLlpZOUWq3DQQ', 1, 6.00, 120.00, 720.00, '{\"product_id\":1,\"product_name\":\"Pensrive\",\"regular_price\":150,\"special_price\":120,\"image\":\"KghsZrMJWH39pYyfmmXgQp4zHhV00SDGoFgzIjBa.jpg\"}', '2021-08-09 22:42:11', '2021-08-09 23:46:13'),
(15, '890neH1faVVKWRefqQCLGF91V1DiLlpZOUWq3DQQ', 5, 6.00, 200.00, 1200.00, '{\"product_id\":5,\"product_name\":\"16 gb Pendrive\",\"regular_price\":250,\"special_price\":200,\"image\":\"smx4PXqp4cAY5fw4UU777Krks9lkN5bH22I8iV1i.png\"}', '2021-08-09 22:42:13', '2021-08-09 23:46:11'),
(86, '0BsuC2XxCyhJ9KrR7ByzQ1DDXmXE8UutIQ243cWp', 5, 3.00, 200.00, 600.00, '{\"product_id\":5,\"product_name\":\"16 gb Pendrive\",\"regular_price\":250,\"special_price\":200,\"image\":\"smx4PXqp4cAY5fw4UU777Krks9lkN5bH22I8iV1i.png\"}', '2021-08-10 07:35:04', '2021-08-10 07:36:08'),
(87, '0BsuC2XxCyhJ9KrR7ByzQ1DDXmXE8UutIQ243cWp', 4, 4.00, 300.00, 1200.00, '{\"product_id\":4,\"product_name\":\"8 Gb Pendrive\",\"regular_price\":250,\"special_price\":300,\"image\":\"Bz0T6gEu341lUfVbi1HbJjt7CYxDEo0kD8Qlqd8F.jpg\"}', '2021-08-10 07:35:05', '2021-08-10 07:36:10'),
(88, '0BsuC2XxCyhJ9KrR7ByzQ1DDXmXE8UutIQ243cWp', 3, 4.00, 150.00, 600.00, '{\"product_id\":3,\"product_name\":\"Memory Card\",\"regular_price\":120,\"special_price\":150,\"image\":\"j3WS5exhgTdo8jfo9VccBwpwSgORnes55NjyHZlF.png\"}', '2021-08-10 07:35:06', '2021-08-10 07:36:11'),
(89, '0BsuC2XxCyhJ9KrR7ByzQ1DDXmXE8UutIQ243cWp', 1, 3.00, 120.00, 360.00, '{\"product_id\":1,\"product_name\":\"Pensrive\",\"regular_price\":150,\"special_price\":120,\"image\":\"KghsZrMJWH39pYyfmmXgQp4zHhV00SDGoFgzIjBa.jpg\"}', '2021-08-10 07:35:07', '2021-08-10 07:36:02'),
(90, '0BsuC2XxCyhJ9KrR7ByzQ1DDXmXE8UutIQ243cWp', 2, 1.00, 110.00, 110.00, '{\"product_id\":2,\"product_name\":\"new item\",\"regular_price\":120,\"special_price\":110,\"image\":\"4Q9DM7yD3oMnh5mB5VOW1DcVXFK8C59NtdTLNFb8.jpg\"}', '2021-08-10 07:36:05', '2021-08-10 07:36:05'),
(105, 'J7Qf024XxIcJIF5NXoIthkHrRJazeL0M4E9JwZfr', 4, 1.00, 300.00, 300.00, '{\"product_id\":4,\"product_name\":\"8 Gb Pendrive\",\"regular_price\":250,\"special_price\":300,\"image\":\"Bz0T6gEu341lUfVbi1HbJjt7CYxDEo0kD8Qlqd8F.jpg\"}', '2021-08-10 22:31:53', '2021-08-10 22:31:53'),
(106, 'J7Qf024XxIcJIF5NXoIthkHrRJazeL0M4E9JwZfr', 3, 1.00, 150.00, 150.00, '{\"product_id\":3,\"product_name\":\"Memory Card\",\"regular_price\":120,\"special_price\":150,\"image\":\"j3WS5exhgTdo8jfo9VccBwpwSgORnes55NjyHZlF.png\"}', '2021-08-10 22:31:57', '2021-08-10 22:31:57'),
(107, 'J7Qf024XxIcJIF5NXoIthkHrRJazeL0M4E9JwZfr', 5, 1.00, 200.00, 200.00, '{\"product_id\":5,\"product_name\":\"16 gb Pendrive\",\"regular_price\":250,\"special_price\":200,\"image\":\"smx4PXqp4cAY5fw4UU777Krks9lkN5bH22I8iV1i.png\"}', '2021-08-10 22:32:00', '2021-08-10 22:32:00'),
(108, 'J7Qf024XxIcJIF5NXoIthkHrRJazeL0M4E9JwZfr', 2, 1.00, 110.00, 110.00, '{\"product_id\":2,\"product_name\":\"new item\",\"regular_price\":120,\"special_price\":110,\"image\":\"4Q9DM7yD3oMnh5mB5VOW1DcVXFK8C59NtdTLNFb8.jpg\"}', '2021-08-10 22:32:04', '2021-08-10 22:32:04'),
(109, 'J7Qf024XxIcJIF5NXoIthkHrRJazeL0M4E9JwZfr', 1, 1.00, 120.00, 120.00, '{\"product_id\":1,\"product_name\":\"Pensrive\",\"regular_price\":150,\"special_price\":120,\"image\":\"KghsZrMJWH39pYyfmmXgQp4zHhV00SDGoFgzIjBa.jpg\"}', '2021-08-10 22:32:38', '2021-08-10 22:32:38'),
(114, 'z5FkcpZD9N6YODjJLNpYegqOiAq39r4xu9tWxTsw', 5, 8.00, 200.00, 1600.00, '{\"product_id\":5,\"product_name\":\"16 gb Pendrive\",\"regular_price\":250,\"special_price\":200,\"image\":\"smx4PXqp4cAY5fw4UU777Krks9lkN5bH22I8iV1i.png\"}', '2021-08-10 22:43:37', '2021-08-10 22:44:28'),
(115, 'z5FkcpZD9N6YODjJLNpYegqOiAq39r4xu9tWxTsw', 4, 11.00, 300.00, 3300.00, '{\"product_id\":4,\"product_name\":\"8 Gb Pendrive\",\"regular_price\":250,\"special_price\":300,\"image\":\"Bz0T6gEu341lUfVbi1HbJjt7CYxDEo0kD8Qlqd8F.jpg\"}', '2021-08-10 22:43:38', '2021-08-10 22:44:14'),
(120, '946hfDBM1TLsRzBCLKK2CFbfKVVzzjIT8iFyIKcG', 5, 10.00, 200.00, 2000.00, '{\"product_id\":5,\"product_name\":\"16 gb Pendrive\",\"regular_price\":250,\"special_price\":200,\"image\":\"smx4PXqp4cAY5fw4UU777Krks9lkN5bH22I8iV1i.png\"}', '2021-08-10 22:55:13', '2021-08-10 22:55:13'),
(121, '946hfDBM1TLsRzBCLKK2CFbfKVVzzjIT8iFyIKcG', 5, 10.00, 200.00, 2000.00, '{\"product_id\":5,\"product_name\":\"16 gb Pendrive\",\"regular_price\":250,\"special_price\":200,\"image\":\"smx4PXqp4cAY5fw4UU777Krks9lkN5bH22I8iV1i.png\"}', '2021-08-10 22:55:13', '2021-08-10 22:55:13');

-- --------------------------------------------------------

--
-- Table structure for table `branches`
--

CREATE TABLE `branches` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `code` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mobile` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` bigint(20) UNSIGNED NOT NULL,
  `is_active` tinyint(1) DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `branches`
--

INSERT INTO `branches` (`id`, `code`, `name`, `address`, `mobile`, `created_by`, `is_active`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'B627559547', 'Default Branch', 'Dhakaa,Bangladesh', '01643235533', 1, 1, '2021-07-29 05:52:50', '2021-07-29 05:52:50', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE `brands` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `branch_id` bigint(20) UNSIGNED NOT NULL,
  `created_by` bigint(20) UNSIGNED NOT NULL,
  `is_active` tinyint(1) DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `brands`
--

INSERT INTO `brands` (`id`, `code`, `name`, `image`, `description`, `branch_id`, `created_by`, `is_active`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'C1625670810', 'Nokia', '8Mtjj23BVzLV1blzllMYE7txCRxLWyA527qIstAb.jpg', 'Hello World', 1, 1, 1, '2021-07-18 23:00:11', '2021-07-18 23:00:11', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image1` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image2` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `top_show` tinyint(4) NOT NULL,
  `branch_id` bigint(20) UNSIGNED NOT NULL,
  `created_by` bigint(20) UNSIGNED NOT NULL,
  `is_active` tinyint(1) DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `code`, `name`, `image1`, `image2`, `description`, `top_show`, `branch_id`, `created_by`, `is_active`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'C626670495', 'Ladies ', 'E0MSEwmLZAK6VV4C3GwGDLmdGr32QRahKDK1ubji.jpg', 'pZuPP3kB2r5KwOh2ws9thMn1uybWsjOLtEtVX66H.jpg', NULL, 1, 1, 1, 1, '2021-07-18 22:55:04', '2021-08-07 23:15:28', NULL),
(2, 'C627823255', 'Gents', 'onB07gKn2jVgTFag7MSLWtACydau3rNPB3CKs3sz.jpg', NULL, NULL, 1, 1, 1, 1, '2021-08-01 07:07:48', '2021-08-07 23:15:18', NULL),
(3, 'C627823272', 'Kids', 'WRNDjrwWEhT9SgvdGiFMyljqi2ud1ObH6Tr3Tz50.png', NULL, NULL, 1, 1, 1, 1, '2021-08-01 07:08:10', '2021-08-07 23:15:12', NULL),
(4, 'C627823293', 'Mens Fashion', 'lC4Xqa3lw74kbtfauR6Fza3jdVtjSwOUAOKN4tQ8.png', NULL, NULL, 1, 1, 1, 1, '2021-08-01 07:08:33', '2021-08-07 23:15:07', NULL),
(5, 'C628399836', 'Electronics', 'UbwdtDbqXIMo1RuMOFLNOYdDZjK3z7C91UZDINOD.jpg', NULL, NULL, 1, 1, 7, 1, '2021-08-07 23:17:36', '2021-08-07 23:17:36', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `colors`
--

CREATE TABLE `colors` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `color_code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` bigint(20) UNSIGNED NOT NULL,
  `is_active` tinyint(1) DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `company_infos`
--

CREATE TABLE `company_infos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mobile` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `hotline` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `web` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `logo` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `facebook_link` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `youtube_link` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `branch_id` bigint(20) UNSIGNED NOT NULL,
  `created_by` bigint(20) UNSIGNED NOT NULL,
  `is_active` tinyint(1) DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `company_infos`
--

INSERT INTO `company_infos` (`id`, `name`, `phone`, `mobile`, `address`, `hotline`, `email`, `web`, `logo`, `facebook_link`, `youtube_link`, `branch_id`, `created_by`, `is_active`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Shomikaron', '11111', '0000', 'Block-A, Meraj Nagar, Rayerbag, kadamtali, Dhaka - 1362', '0111', NULL, NULL, 'VrRIYQ3RL0lsSCD0Ndb2anDAhpoGFUzGvLfD7Htt.png', NULL, NULL, 1, 1, 1, NULL, '2021-08-08 02:28:09', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

CREATE TABLE `contacts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `type` enum('Customer','Supplier','Staff','Both') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `first_name` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_name` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shipping_address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `post_code` varchar(6) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `state` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country_id` bigint(20) UNSIGNED DEFAULT NULL,
  `phone` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mobile` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `due_date` date DEFAULT NULL,
  `birthday` date DEFAULT NULL,
  `opening_balance` double DEFAULT 0,
  `contact_category_id` bigint(20) UNSIGNED DEFAULT NULL,
  `branch_id` bigint(20) UNSIGNED NOT NULL,
  `created_by` bigint(20) UNSIGNED NOT NULL,
  `is_active` tinyint(1) DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `contacts`
--

INSERT INTO `contacts` (`id`, `user_id`, `type`, `first_name`, `last_name`, `address`, `shipping_address`, `post_code`, `state`, `country_id`, `phone`, `mobile`, `email`, `due_date`, `birthday`, `opening_balance`, `contact_category_id`, `branch_id`, `created_by`, `is_active`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, NULL, 'Customer', 'Nozibor', 'Rahman', NULL, 'Dhaka,Bangladesh', NULL, NULL, NULL, NULL, '01643235533', NULL, NULL, NULL, 0, NULL, 1, 1, 1, '2021-08-07 02:28:23', '2021-08-07 02:40:01', NULL),
(2, NULL, 'Customer', 'iqbal', 'Rahman', NULL, 'Hazi Tower,Lakecity Concord Gate,Khilkhet,Dhaka*1229', NULL, NULL, NULL, NULL, '0122222222', NULL, NULL, NULL, 0, NULL, 1, 1, 1, '2021-08-09 07:14:30', '2021-08-09 07:14:30', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `contact_balances`
--

CREATE TABLE `contact_balances` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `contact_id` bigint(20) UNSIGNED DEFAULT NULL,
  `opening_balance` double DEFAULT NULL,
  `purchase_amount` double DEFAULT NULL,
  `sale_amount` double DEFAULT NULL,
  `discount` double DEFAULT NULL,
  `vat` double DEFAULT NULL,
  `commission` double DEFAULT NULL,
  `balance` double DEFAULT NULL,
  `model` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `model_id` int(11) DEFAULT NULL,
  `branch_id` bigint(20) UNSIGNED NOT NULL,
  `created_by` bigint(20) UNSIGNED NOT NULL,
  `is_active` tinyint(1) DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `contact_categories`
--

CREATE TABLE `contact_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `type` enum('Customer','Supplier','Staff') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `code` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `branch_id` bigint(20) UNSIGNED NOT NULL,
  `created_by` bigint(20) UNSIGNED NOT NULL,
  `is_active` tinyint(1) DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `contact_categories`
--

INSERT INTO `contact_categories` (`id`, `type`, `code`, `name`, `branch_id`, `created_by`, `is_active`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Customer', 'C1626344540', 'Default Category', 1, 1, 1, '2021-07-26 18:04:53', '2021-07-26 18:09:00', NULL),
(2, 'Supplier', 'C1626344606', 'Default Supplier Category', 1, 1, 1, '2021-07-26 18:10:24', '2021-07-26 18:10:24', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `coupon_codes`
--

CREATE TABLE `coupon_codes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `code` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `expired_day` int(11) DEFAULT NULL,
  `expired_date` timestamp NULL DEFAULT NULL,
  `after_effect_date` timestamp NULL DEFAULT NULL,
  `offer_type` enum('Percentage','Amount','Reward-Point') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `offer_amount` double(20,4) DEFAULT NULL,
  `min_buy_amount` double(20,4) DEFAULT NULL,
  `branch_id` bigint(20) UNSIGNED NOT NULL,
  `created_by` bigint(20) UNSIGNED NOT NULL,
  `is_active` tinyint(1) DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `currencies`
--

CREATE TABLE `currencies` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `code` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `symbol` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `symbol_position` enum('Prefix','Surfix') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `in_word_prefix` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `in_word_suffix` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `in_word_prefix_position` enum('Prefix','Suffix') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `in_word_suffix_position` enum('Prefix','Suffix') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `branch_id` bigint(20) UNSIGNED NOT NULL,
  `created_by` bigint(20) UNSIGNED NOT NULL,
  `is_active` tinyint(1) DEFAULT 1,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `currencies`
--

INSERT INTO `currencies` (`id`, `code`, `title`, `symbol`, `symbol_position`, `in_word_prefix`, `in_word_suffix`, `in_word_prefix_position`, `in_word_suffix_position`, `branch_id`, `created_by`, `is_active`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'C628421204', 'BDT', '৳', 'Prefix', 'ss', 'ssss', 'Prefix', 'Prefix', 1, 1, 1, NULL, '2021-08-08 05:18:36', '2021-08-08 05:18:36');

-- --------------------------------------------------------

--
-- Table structure for table `delivery_methods`
--

CREATE TABLE `delivery_methods` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `code` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `branch_id` bigint(20) UNSIGNED NOT NULL,
  `created_by` bigint(20) UNSIGNED NOT NULL,
  `is_active` tinyint(1) DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `invoices`
--

CREATE TABLE `invoices` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `type` enum('Order','Sales','Purchase','Quate') COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `code` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contact_id` bigint(20) UNSIGNED DEFAULT NULL,
  `subtotal` double(20,4) DEFAULT NULL,
  `vat_total` double(20,4) DEFAULT NULL,
  `discount_value` double(20,4) DEFAULT NULL,
  `discount` double(20,4) DEFAULT NULL,
  `shipping_charge` double(20,4) DEFAULT NULL,
  `earn_point` double(20,4) DEFAULT NULL,
  `earn_point_amount` double(20,4) DEFAULT NULL,
  `expense_point` double(20,4) DEFAULT NULL,
  `expense_point_amount` double(20,4) DEFAULT NULL,
  `grand_total` double(20,4) DEFAULT NULL,
  `created_by` bigint(20) UNSIGNED NOT NULL,
  `branch_id` bigint(20) UNSIGNED NOT NULL,
  `status` enum('Pending','In Process','Delivered','Accepted','Rescheduled','Picked Up','Cancel','Return') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `invoice_settings`
--

CREATE TABLE `invoice_settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `type` enum('Invoice','Receipt') COLLATE utf8mb4_unicode_ci NOT NULL,
  `logo` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `invoice_header` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `invoice_title` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `invoice_footer` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `vat_reg_no` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `vat_area_code` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `vat_text` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `website` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `currency_id` bigint(20) UNSIGNED NOT NULL,
  `is_paid_due_hide` tinyint(1) DEFAULT 0,
  `is_memo_no_hide` tinyint(1) DEFAULT 0,
  `is_chalan_no_hide` tinyint(1) DEFAULT 0,
  `branch_id` bigint(20) UNSIGNED NOT NULL,
  `created_by` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(73, '2021_07_16_052805_create_product_info_table', 1),
(91, '2014_10_12_000000_create_users_table', 2),
(92, '2014_10_12_100000_create_password_resets_table', 2),
(93, '2014_10_12_200000_add_two_factor_columns_to_users_table', 2),
(94, '2019_08_19_000000_create_failed_jobs_table', 2),
(95, '2019_12_14_000001_create_personal_access_tokens_table', 2),
(96, '2020_05_21_100000_create_teams_table', 2),
(97, '2020_05_21_200000_create_team_user_table', 2),
(98, '2020_05_21_300000_create_team_invitations_table', 2),
(99, '2021_02_13_105214_create_sessions_table', 2),
(100, '2021_03_30_123909_create_profile_settings_table', 2),
(101, '2021_04_01_210304_create_permission_categories_table', 2),
(102, '2021_06_13_064243_create_brands_table', 2),
(103, '2021_06_13_064317_create_categories_table', 2),
(104, '2021_06_13_064338_create_sub_categories_table', 2),
(105, '2021_06_13_064414_create_sub_sub_categories_table', 2),
(106, '2021_06_13_064438_create_units_table', 2),
(107, '2021_06_13_064514_create_products_table', 2),
(108, '2021_06_13_064634_create_product_images_table', 2),
(109, '2021_06_13_064743_create_contacts_table', 2),
(110, '2021_06_13_065016_create_invoice_settings_table', 2),
(111, '2021_06_13_065038_create_payment_methods_table', 2),
(112, '2021_06_13_065149_create_delivery_methods_table', 2),
(113, '2021_06_13_065207_create_vats_table', 2),
(114, '2021_06_13_065246_create_branches_table', 2),
(115, '2021_06_13_065302_create_warehouses_table', 2),
(116, '2021_06_13_065444_create_invoices_table', 2),
(117, '2021_06_13_065519_create_stock_managers_table', 2),
(118, '2021_06_13_065548_create_stock_adjustments_table', 2),
(119, '2021_06_13_065811_create_payments_table', 2),
(120, '2021_06_13_070133_create_currencies_table', 2),
(121, '2021_06_13_073934_create_contact_categories_table', 2),
(122, '2021_06_19_070242_create_company_infos_table', 2),
(123, '2021_06_19_090514_create_sliders_table', 2),
(124, '2021_06_19_113037_create_coupon_codes_table', 2),
(125, '2021_06_27_124950_create_point_policies_table', 2),
(126, '2021_06_29_034815_create_colors_table', 2),
(127, '2021_06_29_053813_create_sizes_table', 2),
(128, '2021_06_29_155357_create_permission_tables', 2),
(129, '2021_07_16_052805_create_product_infos_table', 2),
(130, '2021_07_16_054152_create_sale_invoices_table', 2),
(131, '2021_07_16_055111_create_sale_invoice_details_table', 2),
(132, '2021_07_16_055154_create_product_barcodes_table', 2),
(133, '2021_07_16_060158_create_product_wish_lists_table', 2),
(134, '2021_07_16_174539_create_purchase_invoices_table', 2),
(135, '2021_07_16_174559_create_purchase_invoice_details_table', 2),
(136, '2021_07_16_175013_create_contact_balances_table', 2),
(137, '2021_07_16_205947_create_sale_payments_table', 2),
(138, '2021_07_16_205958_create_purchase_payments_table', 2),
(139, '2021_07_28_202059_create_add_to_cards_table', 2),
(140, '2021_08_01_113222_create_orders_table', 2),
(141, '2021_08_01_113325_create_order_details_table', 2),
(142, '2021_08_03_043041_create_shipping_charges_table', 2);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\Models\\User', 1),
(3, 'App\\Models\\User', 2);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `contact_id` bigint(20) UNSIGNED DEFAULT NULL,
  `order_date` datetime DEFAULT NULL,
  `total_amount` double DEFAULT NULL,
  `other_amount` double DEFAULT NULL,
  `discount` double DEFAULT NULL,
  `shipping_charge` double DEFAULT NULL,
  `vat` double DEFAULT NULL,
  `payable_amount` double DEFAULT NULL,
  `note` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `coupon_code_id` bigint(20) UNSIGNED DEFAULT NULL,
  `status` enum('pending','approved','cancel') COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_active` tinyint(1) DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `order_details`
--

CREATE TABLE `order_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED DEFAULT NULL,
  `product_id` bigint(20) UNSIGNED DEFAULT NULL,
  `unit_price` double DEFAULT NULL,
  `quantity` double DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` enum('CustomerPayment','SupplierPayment') COLLATE utf8mb4_unicode_ci NOT NULL,
  `contact_id` bigint(20) UNSIGNED NOT NULL,
  `invoice_id` bigint(20) UNSIGNED DEFAULT NULL,
  `amount` double(20,4) DEFAULT NULL,
  `charge` double(20,4) DEFAULT NULL,
  `net_amount` double(20,4) DEFAULT NULL,
  `payment_method_id` bigint(20) UNSIGNED NOT NULL,
  `transaction_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `receipt_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `note` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `branch_id` bigint(20) UNSIGNED NOT NULL,
  `created_by` bigint(20) UNSIGNED NOT NULL,
  `is_active` tinyint(1) DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payment_methods`
--

CREATE TABLE `payment_methods` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `code` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `account_no` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `account_holder_name` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `opening_balance` double DEFAULT 0,
  `branch_id` bigint(20) UNSIGNED NOT NULL,
  `created_by` bigint(20) UNSIGNED NOT NULL,
  `is_active` tinyint(1) DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `payment_methods`
--

INSERT INTO `payment_methods` (`id`, `code`, `name`, `account_no`, `account_holder_name`, `opening_balance`, `branch_id`, `created_by`, `is_active`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, NULL, 'Bkash', '12345678', 'Nazmul Huda', 0, 1, 1, 1, '2021-07-26 09:04:21', '2021-07-26 09:04:21', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permission_categories`
--

CREATE TABLE `permission_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `point_policies`
--

CREATE TABLE `point_policies` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `amount` double(20,2) DEFAULT NULL,
  `point_value` double(20,2) DEFAULT NULL,
  `point_amount` double(20,2) DEFAULT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `branch_id` bigint(20) UNSIGNED NOT NULL,
  `created_by` bigint(20) UNSIGNED NOT NULL,
  `is_active` tinyint(1) DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `regular_price` double(20,4) NOT NULL,
  `special_price` double(20,4) NOT NULL,
  `wholesale_price` double(20,4) NOT NULL,
  `purchase_price` double(20,4) NOT NULL DEFAULT 0.0000,
  `discount` double(20,4) DEFAULT 0.0000,
  `sub_sub_category_id` bigint(20) UNSIGNED NOT NULL,
  `sub_category_id` bigint(20) UNSIGNED NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `contact_id` bigint(20) UNSIGNED DEFAULT NULL,
  `brand_id` bigint(20) UNSIGNED DEFAULT NULL,
  `low_alert` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `min_order_qty` double(20,4) DEFAULT NULL,
  `featured` enum('None','New Product','Trending Product','Best Selling Product') COLLATE utf8mb4_unicode_ci NOT NULL,
  `barcode_generate_state` enum('Bulk','Single') COLLATE utf8mb4_unicode_ci NOT NULL,
  `vat_id` bigint(20) UNSIGNED DEFAULT NULL,
  `branch_id` bigint(20) UNSIGNED NOT NULL,
  `created_by` bigint(20) UNSIGNED NOT NULL,
  `is_active` tinyint(1) DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `code`, `name`, `regular_price`, `special_price`, `wholesale_price`, `purchase_price`, `discount`, `sub_sub_category_id`, `sub_category_id`, `category_id`, `contact_id`, `brand_id`, `low_alert`, `min_order_qty`, `featured`, `barcode_generate_state`, `vat_id`, `branch_id`, `created_by`, `is_active`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'P628052522', 'Pensrive', 150.0000, 120.0000, 120.0000, 100.0000, NULL, 1, 1, 1, NULL, 1, NULL, 5.0000, 'New Product', 'Bulk', NULL, 1, 1, 1, '2021-08-01 07:04:18', '2021-08-03 22:49:05', NULL),
(2, 'P628052666', 'new item', 120.0000, 110.0000, 104.0000, 100.0000, NULL, 1, 1, 1, NULL, 1, NULL, 10.0000, 'Best Selling Product', 'Bulk', NULL, 1, 1, 1, '2021-08-03 22:52:19', '2021-08-03 22:52:19', NULL),
(3, 'P628058662', 'Memory Card', 120.0000, 150.0000, 100.0000, 150.0000, 20.0000, 1, 1, 1, NULL, 1, NULL, 10.0000, 'New Product', 'Bulk', NULL, 1, 1, 1, '2021-08-04 00:31:59', '2021-08-04 00:31:59', NULL),
(4, 'P628058721', '8 Gb Pendrive', 250.0000, 300.0000, 100.0000, 200.0000, NULL, 1, 1, 1, NULL, 1, NULL, 10.0000, 'New Product', 'Bulk', NULL, 1, 1, 1, '2021-08-04 00:33:01', '2021-08-04 00:33:01', NULL),
(5, 'P628487534', '16 gb Pendrive', 250.0000, 200.0000, 150.0000, 520.0000, NULL, 1, 1, 1, NULL, 1, NULL, 5.0000, 'New Product', 'Bulk', NULL, 1, 1, 1, '2021-08-04 00:33:56', '2021-08-08 23:39:02', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `product_barcodes`
--

CREATE TABLE `product_barcodes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED DEFAULT NULL,
  `barcode` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `branch_id` bigint(20) UNSIGNED NOT NULL,
  `created_by` bigint(20) UNSIGNED NOT NULL,
  `is_active` tinyint(1) DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product_images`
--

CREATE TABLE `product_images` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `image` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `position` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` bigint(20) UNSIGNED NOT NULL,
  `branch_id` bigint(20) UNSIGNED NOT NULL,
  `is_active` tinyint(1) DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_images`
--

INSERT INTO `product_images` (`id`, `product_id`, `image`, `position`, `created_by`, `branch_id`, `is_active`, `created_at`, `updated_at`, `deleted_at`) VALUES
(6, 5, 'smx4PXqp4cAY5fw4UU777Krks9lkN5bH22I8iV1i.png', NULL, 1, 1, 1, '2021-07-28 12:57:33', '2021-07-28 12:57:33', NULL),
(7, 5, 'edrVWBy3H4trCYylqUnfR5QYnPx8mF3vpnDsshNm.jpg', NULL, 1, 1, 1, '2021-07-28 12:57:33', '2021-07-28 12:57:33', NULL),
(8, 5, 'H4bpYb7mytFX0BlrPZYVHG20wDHTYTcBpqQzmjyN.jpg', NULL, 1, 1, 1, '2021-07-28 12:57:33', '2021-07-28 12:57:33', NULL),
(9, 1, 'KghsZrMJWH39pYyfmmXgQp4zHhV00SDGoFgzIjBa.jpg', NULL, 1, 1, 1, '2021-08-01 07:04:18', '2021-08-01 07:04:18', NULL),
(10, 1, 'wXwKBplKoeQDki838Q8lJzYFTDOQfhYsG8S0IbPA.jpg', NULL, 1, 1, 1, '2021-08-01 07:04:18', '2021-08-01 07:04:18', NULL),
(11, 2, '4Q9DM7yD3oMnh5mB5VOW1DcVXFK8C59NtdTLNFb8.jpg', NULL, 1, 1, 1, '2021-08-03 22:52:19', '2021-08-03 22:52:19', NULL),
(12, 3, 'j3WS5exhgTdo8jfo9VccBwpwSgORnes55NjyHZlF.png', NULL, 1, 1, 1, '2021-08-04 00:31:59', '2021-08-04 00:31:59', NULL),
(13, 4, 'Bz0T6gEu341lUfVbi1HbJjt7CYxDEo0kD8Qlqd8F.jpg', NULL, 1, 1, 1, '2021-08-04 00:33:01', '2021-08-04 00:33:01', NULL),
(14, 5, 'WaDJMycQBybq0FCpLEcSHDX4ArZn0U5cHvDn4zr1.jpg', NULL, 1, 1, 1, '2021-08-04 00:33:56', '2021-08-04 00:33:56', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `product_infos`
--

CREATE TABLE `product_infos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED DEFAULT NULL,
  `short_description` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `long_description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `youtube_link` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_title` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_keyword` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `branch_id` bigint(20) UNSIGNED NOT NULL,
  `created_by` bigint(20) UNSIGNED NOT NULL,
  `is_active` tinyint(1) DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_infos`
--

INSERT INTO `product_infos` (`id`, `product_id`, `short_description`, `long_description`, `youtube_link`, `meta_title`, `meta_description`, `meta_keyword`, `branch_id`, `created_by`, `is_active`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 'Short Description Test', 'Long Description Test', NULL, NULL, NULL, NULL, 1, 1, 1, '2021-08-01 07:04:18', '2021-08-01 07:04:18', NULL),
(2, 2, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, 1, '2021-08-03 22:52:19', '2021-08-03 22:52:19', NULL),
(3, 3, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, 1, '2021-08-04 00:31:59', '2021-08-04 00:31:59', NULL),
(4, 4, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, 1, '2021-08-04 00:33:01', '2021-08-04 00:33:01', NULL),
(5, 5, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, 1, '2021-08-04 00:33:56', '2021-08-04 00:33:56', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `product_wish_lists`
--

CREATE TABLE `product_wish_lists` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED DEFAULT NULL,
  `branch_id` bigint(20) UNSIGNED NOT NULL DEFAULT 0,
  `created_by` bigint(20) UNSIGNED NOT NULL,
  `is_active` tinyint(1) DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `profile_settings`
--

CREATE TABLE `profile_settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `profile_photo` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `business_name` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mobile` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `postal_code` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `company_id` bigint(20) UNSIGNED NOT NULL,
  `branch_id` bigint(20) UNSIGNED NOT NULL,
  `is_active` tinyint(1) DEFAULT 1,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `purchase_invoices`
--

CREATE TABLE `purchase_invoices` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `contact_id` bigint(20) UNSIGNED DEFAULT NULL,
  `purchase_date` datetime DEFAULT NULL,
  `total_amount` double DEFAULT NULL,
  `other_amount` double DEFAULT NULL,
  `discount` double DEFAULT NULL,
  `shipping_charge` double DEFAULT NULL,
  `commission` double DEFAULT NULL,
  `vat` double DEFAULT NULL,
  `payable_amount` double DEFAULT NULL,
  `note` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `branch_id` bigint(20) UNSIGNED NOT NULL,
  `created_by` bigint(20) UNSIGNED NOT NULL,
  `is_active` tinyint(1) DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `purchase_invoice_details`
--

CREATE TABLE `purchase_invoice_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `purchase_invoice_id` bigint(20) UNSIGNED DEFAULT NULL,
  `product_id` bigint(20) UNSIGNED DEFAULT NULL,
  `unit_price` double DEFAULT NULL,
  `quantity` double DEFAULT NULL,
  `branch_id` bigint(20) UNSIGNED NOT NULL,
  `created_by` bigint(20) UNSIGNED NOT NULL,
  `is_active` tinyint(1) DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `purchase_payments`
--

CREATE TABLE `purchase_payments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contact_id` bigint(20) UNSIGNED NOT NULL,
  `purchase_invoice_id` bigint(20) UNSIGNED DEFAULT NULL,
  `total_amount` double(20,4) DEFAULT NULL,
  `charge` double(20,4) DEFAULT NULL,
  `vat` double(20,4) DEFAULT NULL,
  `discount` double(20,4) DEFAULT NULL,
  `net_amount` double(20,4) DEFAULT NULL,
  `payment_method_id` bigint(20) UNSIGNED NOT NULL,
  `transaction_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `receipt_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `note` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `branch_id` bigint(20) UNSIGNED NOT NULL,
  `created_by` bigint(20) UNSIGNED NOT NULL,
  `is_active` tinyint(1) DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'web', '2021-08-07 18:00:00', '2021-08-07 18:00:00'),
(2, 'user', 'web', '2021-08-07 18:00:00', '2021-08-07 18:00:00'),
(3, 'customer', 'web', '2021-08-07 18:00:00', '2021-08-07 18:00:00'),
(4, 'seller', 'web', '2021-08-07 18:00:00', '2021-08-07 18:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sale_invoices`
--

CREATE TABLE `sale_invoices` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED DEFAULT NULL,
  `contact_id` bigint(20) UNSIGNED DEFAULT NULL,
  `sale_date` datetime DEFAULT NULL,
  `total_amount` double DEFAULT NULL,
  `other_amount` double DEFAULT NULL,
  `discount` double DEFAULT NULL,
  `shipping_charge` double DEFAULT NULL,
  `vat` double DEFAULT NULL,
  `payable_amount` double DEFAULT NULL,
  `note` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `invoice_channel` enum('Web-Sale','Sale-Terminal') COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Backend Sale or Online Sale',
  `coupon_code_id` bigint(20) UNSIGNED DEFAULT NULL,
  `branch_id` bigint(20) UNSIGNED NOT NULL,
  `created_by` bigint(20) UNSIGNED NOT NULL,
  `is_active` tinyint(1) DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sale_invoice_details`
--

CREATE TABLE `sale_invoice_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `sale_invoice_id` bigint(20) UNSIGNED DEFAULT NULL,
  `product_id` bigint(20) UNSIGNED DEFAULT NULL,
  `unit_price` double DEFAULT NULL,
  `quantity` double DEFAULT NULL,
  `branch_id` bigint(20) UNSIGNED NOT NULL,
  `created_by` bigint(20) UNSIGNED NOT NULL,
  `is_active` tinyint(1) DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sale_payments`
--

CREATE TABLE `sale_payments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contact_id` bigint(20) UNSIGNED NOT NULL,
  `sale_invoice_id` bigint(20) UNSIGNED DEFAULT NULL,
  `total_amount` double(20,4) DEFAULT NULL,
  `charge` double(20,4) DEFAULT NULL,
  `vat` double(20,4) DEFAULT NULL,
  `discount` double(20,4) DEFAULT NULL,
  `net_amount` double(20,4) DEFAULT NULL,
  `payment_method_id` bigint(20) UNSIGNED NOT NULL,
  `transaction_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `receipt_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `note` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `branch_id` bigint(20) UNSIGNED NOT NULL,
  `created_by` bigint(20) UNSIGNED NOT NULL,
  `is_active` tinyint(1) DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payload` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('946hfDBM1TLsRzBCLKK2CFbfKVVzzjIT8iFyIKcG', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.2; Win64; x64; rv:91.0) Gecko/20100101 Firefox/91.0', 'YTo3OntzOjY6Il90b2tlbiI7czo0MDoiZnM1TzNsa1BnMHVYMXBXRENSNjJDTVBQdmF4a1J6SW1pYlJmQVdwVyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjI6Imh0dHA6Ly9lY29tLmxvY2FsOjgwODAiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjM6InVybCI7YTowOnt9czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTtzOjE3OiJwYXNzd29yZF9oYXNoX3dlYiI7czo2MDoiJDJ5JDEwJC94ay91cmZ5aDF3UHJkUEVPL2hxYi5FL05MNExRb2RvOU5QZUVJbDIvTEpNSWhtbnA0VDRLIjtzOjIxOiJwYXNzd29yZF9oYXNoX3NhbmN0dW0iO3M6NjA6IiQyeSQxMCQveGsvdXJmeWgxd1ByZFBFTy9ocWIuRS9OTDRMUW9kbzlOUGVFSWwyL0xKTUlobW5wNFQ0SyI7fQ==', 1628658241),
('TzwZXtYQjZxFVaDA7dJ3P1jgaZenjHYKHVPI1tZT', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.2; Win64; x64; rv:91.0) Gecko/20100101 Firefox/91.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiUUZ0WlZKY3dWZ0wzU0lDOUVEcU1hSndYdVRHTnVMNEgwZjdObXhpYyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjI6Imh0dHA6Ly9lY29tLmxvY2FsOjgwODAiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1628654842),
('z5FkcpZD9N6YODjJLNpYegqOiAq39r4xu9tWxTsw', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/92.0.4515.131 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiOUdFWlhPd2VPS0s5Q2FqRlRPNTVrNURZM0E5OTJkdWdhMUVpb3Z1eiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly9lY29tLmxvY2FsOjgwODAvY2FydCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1628657082);

-- --------------------------------------------------------

--
-- Table structure for table `shipping_charges`
--

CREATE TABLE `shipping_charges` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `code` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `title` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` enum('price','weight') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `from` double(20,4) DEFAULT NULL,
  `to` double(20,4) DEFAULT NULL,
  `shipping_fee` double(20,4) NOT NULL DEFAULT 0.0000,
  `country_id` bigint(20) UNSIGNED NOT NULL,
  `branch_id` bigint(20) UNSIGNED NOT NULL,
  `created_by` bigint(20) UNSIGNED NOT NULL,
  `is_active` tinyint(1) DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `shipping_charges`
--

INSERT INTO `shipping_charges` (`id`, `code`, `title`, `type`, `from`, `to`, `shipping_fee`, `country_id`, `branch_id`, `created_by`, `is_active`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'SC1627509411', 'Inside Dhaka', 'price', 0.0000, 5000.0000, 50.0000, 1, 1, 1, 1, '2021-08-09 05:44:07', '2021-08-09 05:44:07', NULL),
(2, 'SC1627509453', 'Outside Dhaka', 'price', 0.0000, 10000.0000, 100.0000, 1, 1, 1, 1, '2021-08-09 05:44:44', '2021-08-09 05:44:44', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sizes`
--

CREATE TABLE `sizes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `size_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` bigint(20) UNSIGNED NOT NULL,
  `is_active` tinyint(1) DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sliders`
--

CREATE TABLE `sliders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `position` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `branch_id` bigint(20) UNSIGNED NOT NULL,
  `created_by` bigint(20) UNSIGNED NOT NULL,
  `is_active` tinyint(1) DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sliders`
--

INSERT INTO `sliders` (`id`, `title`, `image`, `description`, `position`, `branch_id`, `created_by`, `is_active`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Title', 'Ql9bXWFtUFZwnlZxJccaBo9BKZ2TZrzNxUZw2vK1.jpg', NULL, '23', 1, 1, 1, '2021-07-26 18:54:20', '2021-08-05 12:12:24', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `stock_adjustments`
--

CREATE TABLE `stock_adjustments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `date` date NOT NULL,
  `type` enum('Transfer','Decrease','Increase') COLLATE utf8mb4_unicode_ci NOT NULL,
  `contact_id` bigint(20) UNSIGNED DEFAULT NULL,
  `from_branch_id` bigint(20) UNSIGNED DEFAULT NULL,
  `to_branch_id` bigint(20) UNSIGNED DEFAULT NULL,
  `from_warehouse_id` bigint(20) UNSIGNED DEFAULT NULL,
  `to_warehouse_id` bigint(20) UNSIGNED DEFAULT NULL,
  `note` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `branch_id` bigint(20) UNSIGNED NOT NULL,
  `created_by` bigint(20) UNSIGNED NOT NULL,
  `is_active` tinyint(1) DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `stock_managers`
--

CREATE TABLE `stock_managers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `product_id` bigint(20) UNSIGNED DEFAULT NULL,
  `invoice_id` bigint(20) UNSIGNED DEFAULT NULL,
  `stock_adjustment_id` bigint(20) UNSIGNED DEFAULT NULL,
  `flow` enum('In','Out') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `quantity` double(20,4) DEFAULT NULL,
  `price` double(20,4) DEFAULT NULL,
  `vat` double(20,4) DEFAULT NULL,
  `discount` double(20,4) DEFAULT NULL,
  `subtotal` double(20,4) DEFAULT NULL,
  `stock_in_opening` double(20,4) DEFAULT 0.0000,
  `stock_in_purchase` double(20,4) DEFAULT 0.0000,
  `stock_in_inventory` double(20,4) DEFAULT 0.0000,
  `stock_out_opening` double(20,4) DEFAULT 0.0000,
  `stock_out_sale` double(20,4) DEFAULT 0.0000,
  `stock_out_sale_web` double(20,4) DEFAULT 0.0000,
  `stock_out_inventory` double(20,4) DEFAULT 0.0000,
  `warehouse_id` bigint(20) UNSIGNED NOT NULL,
  `branch_id` bigint(20) UNSIGNED NOT NULL,
  `created_by` bigint(20) UNSIGNED NOT NULL,
  `is_active` tinyint(1) DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sub_categories`
--

CREATE TABLE `sub_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `branch_id` bigint(20) UNSIGNED NOT NULL,
  `created_by` bigint(20) UNSIGNED NOT NULL,
  `is_active` tinyint(1) DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sub_categories`
--

INSERT INTO `sub_categories` (`id`, `code`, `name`, `image`, `description`, `category_id`, `branch_id`, `created_by`, `is_active`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'SC626670687', 'Ladies 3 Pcs', 'IXsvzOuwHPtjuPdjXCe2exJK5LANc6WiZGF1Uw2A.jpg', 'Hello Test', 1, 1, 1, 1, '2021-07-18 22:58:38', '2021-07-18 22:58:38', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sub_sub_categories`
--

CREATE TABLE `sub_sub_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `sub_category_id` bigint(20) UNSIGNED NOT NULL,
  `code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `branch_id` bigint(20) UNSIGNED NOT NULL,
  `created_by` bigint(20) UNSIGNED NOT NULL,
  `is_active` tinyint(1) DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sub_sub_categories`
--

INSERT INTO `sub_sub_categories` (`id`, `sub_category_id`, `code`, `name`, `image`, `description`, `branch_id`, `created_by`, `is_active`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 'C626670736', 'Ladies 4 Pcs', 'eDdprviIov2PsvMpUvbrLHMa4wFQljKDog7LgJWz.jpg', 'Hello Test', 1, 1, 1, '2021-07-18 22:59:29', '2021-08-01 07:00:48', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `teams`
--

CREATE TABLE `teams` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `personal_team` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `teams`
--

INSERT INTO `teams` (`id`, `user_id`, `name`, `personal_team`, `created_at`, `updated_at`) VALUES
(1, 1, 'Admin\'s Team', 1, '2021-08-09 22:41:45', '2021-08-09 22:41:45'),
(2, 2, 'Customer\'s Team', 1, '2021-08-10 06:49:28', '2021-08-10 06:49:28');

-- --------------------------------------------------------

--
-- Table structure for table `team_invitations`
--

CREATE TABLE `team_invitations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `team_id` bigint(20) UNSIGNED NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `team_user`
--

CREATE TABLE `team_user` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `team_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `role` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `units`
--

CREATE TABLE `units` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `rate` double(20,4) NOT NULL,
  `branch_id` bigint(20) UNSIGNED NOT NULL,
  `created_by` bigint(20) UNSIGNED NOT NULL,
  `is_active` tinyint(1) DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `units`
--

INSERT INTO `units` (`id`, `code`, `name`, `rate`, `branch_id`, `created_by`, `is_active`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'C626670836', 'Pcs', 1.0000, 1, 1, 1, '2021-07-18 23:00:49', '2021-07-18 23:00:49', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `first_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mobile` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` enum('Admin','User','Customer','Seller') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `two_factor_secret` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `two_factor_recovery_codes` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `current_team_id` bigint(20) UNSIGNED DEFAULT NULL,
  `branch_id` bigint(20) UNSIGNED DEFAULT NULL,
  `profile_photo_path` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `first_name`, `last_name`, `mobile`, `email`, `address`, `type`, `email_verified_at`, `password`, `two_factor_secret`, `two_factor_recovery_codes`, `remember_token`, `current_team_id`, `branch_id`, `profile_photo_path`, `created_at`, `updated_at`) VALUES
(1, 'Admin', NULL, NULL, '01643235533', 'admin@admin.com', 'Hazi Tower,Lakecity Concord Gate,Khilkhet,Dhaka-1229', 'Customer', NULL, '$2y$10$/xk/urfyh1wPrdPEO/hqb.E/NL4LQodo9NPeEIl2/LJMIhmnp4T4K', NULL, NULL, NULL, NULL, NULL, NULL, '2021-08-09 22:41:45', '2021-08-09 22:41:45'),
(2, 'Customer', NULL, NULL, '01643235500', 'customer@customer.com', 'Dhaka,Bangladesh', 'Customer', NULL, '$2y$10$7WGCfbcq6IocdZ.ZzMQLNeMASmUIGMi2KnQBF4SLbp9l0WWIbIcg2', NULL, NULL, NULL, NULL, NULL, NULL, '2021-08-10 06:49:28', '2021-08-10 06:49:28');

-- --------------------------------------------------------

--
-- Table structure for table `vats`
--

CREATE TABLE `vats` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `code` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `rate_percent` double NOT NULL DEFAULT 0,
  `rate_fixed` double DEFAULT 0,
  `branch_id` bigint(20) UNSIGNED NOT NULL,
  `created_by` bigint(20) UNSIGNED NOT NULL,
  `is_active` tinyint(1) DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `warehouses`
--

CREATE TABLE `warehouses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `code` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `branch_id` bigint(20) UNSIGNED NOT NULL,
  `created_by` bigint(20) UNSIGNED NOT NULL,
  `is_active` tinyint(1) DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `warehouses`
--

INSERT INTO `warehouses` (`id`, `code`, `name`, `address`, `branch_id`, `created_by`, `is_active`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'W627497653', 'Default Warehouse', 'Dhaka,Bangladesh', 1, 1, 1, '2021-07-28 12:41:18', '2021-07-28 12:41:18', NULL),
(2, 'W627559583', 'WareHouse 2', 'Dhaka,Bangladesh', 1, 1, 1, '2021-07-29 05:53:20', '2021-07-29 05:53:20', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `add_to_cards`
--
ALTER TABLE `add_to_cards`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `branches`
--
ALTER TABLE `branches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `colors`
--
ALTER TABLE `colors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `company_infos`
--
ALTER TABLE `company_infos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact_balances`
--
ALTER TABLE `contact_balances`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact_categories`
--
ALTER TABLE `contact_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `coupon_codes`
--
ALTER TABLE `coupon_codes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `currencies`
--
ALTER TABLE `currencies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `delivery_methods`
--
ALTER TABLE `delivery_methods`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `invoices`
--
ALTER TABLE `invoices`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `invoice_settings`
--
ALTER TABLE `invoice_settings`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_details`
--
ALTER TABLE `order_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payment_methods`
--
ALTER TABLE `payment_methods`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `permission_categories`
--
ALTER TABLE `permission_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `point_policies`
--
ALTER TABLE `point_policies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_barcodes`
--
ALTER TABLE `product_barcodes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_images`
--
ALTER TABLE `product_images`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_infos`
--
ALTER TABLE `product_infos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_wish_lists`
--
ALTER TABLE `product_wish_lists`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `profile_settings`
--
ALTER TABLE `profile_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `purchase_invoices`
--
ALTER TABLE `purchase_invoices`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `purchase_invoice_details`
--
ALTER TABLE `purchase_invoice_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `purchase_payments`
--
ALTER TABLE `purchase_payments`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `sale_invoices`
--
ALTER TABLE `sale_invoices`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sale_invoice_details`
--
ALTER TABLE `sale_invoice_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sale_payments`
--
ALTER TABLE `sale_payments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `shipping_charges`
--
ALTER TABLE `shipping_charges`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sizes`
--
ALTER TABLE `sizes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sliders`
--
ALTER TABLE `sliders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stock_adjustments`
--
ALTER TABLE `stock_adjustments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stock_managers`
--
ALTER TABLE `stock_managers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sub_categories`
--
ALTER TABLE `sub_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sub_sub_categories`
--
ALTER TABLE `sub_sub_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `teams`
--
ALTER TABLE `teams`
  ADD PRIMARY KEY (`id`),
  ADD KEY `teams_user_id_index` (`user_id`);

--
-- Indexes for table `team_invitations`
--
ALTER TABLE `team_invitations`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `team_invitations_team_id_email_unique` (`team_id`,`email`);

--
-- Indexes for table `team_user`
--
ALTER TABLE `team_user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `team_user_team_id_user_id_unique` (`team_id`,`user_id`);

--
-- Indexes for table `units`
--
ALTER TABLE `units`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_mobile_unique` (`mobile`);

--
-- Indexes for table `vats`
--
ALTER TABLE `vats`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `warehouses`
--
ALTER TABLE `warehouses`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `add_to_cards`
--
ALTER TABLE `add_to_cards`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=122;

--
-- AUTO_INCREMENT for table `branches`
--
ALTER TABLE `branches`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `colors`
--
ALTER TABLE `colors`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `company_infos`
--
ALTER TABLE `company_infos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `contact_balances`
--
ALTER TABLE `contact_balances`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `contact_categories`
--
ALTER TABLE `contact_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `coupon_codes`
--
ALTER TABLE `coupon_codes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `currencies`
--
ALTER TABLE `currencies`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `delivery_methods`
--
ALTER TABLE `delivery_methods`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `invoices`
--
ALTER TABLE `invoices`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `invoice_settings`
--
ALTER TABLE `invoice_settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=143;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `order_details`
--
ALTER TABLE `order_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `payment_methods`
--
ALTER TABLE `payment_methods`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `permission_categories`
--
ALTER TABLE `permission_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `point_policies`
--
ALTER TABLE `point_policies`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `product_barcodes`
--
ALTER TABLE `product_barcodes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product_images`
--
ALTER TABLE `product_images`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `product_infos`
--
ALTER TABLE `product_infos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `product_wish_lists`
--
ALTER TABLE `product_wish_lists`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `profile_settings`
--
ALTER TABLE `profile_settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `purchase_invoices`
--
ALTER TABLE `purchase_invoices`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `purchase_invoice_details`
--
ALTER TABLE `purchase_invoice_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `purchase_payments`
--
ALTER TABLE `purchase_payments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `sale_invoices`
--
ALTER TABLE `sale_invoices`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sale_invoice_details`
--
ALTER TABLE `sale_invoice_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sale_payments`
--
ALTER TABLE `sale_payments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `shipping_charges`
--
ALTER TABLE `shipping_charges`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `sizes`
--
ALTER TABLE `sizes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sliders`
--
ALTER TABLE `sliders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `stock_adjustments`
--
ALTER TABLE `stock_adjustments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `stock_managers`
--
ALTER TABLE `stock_managers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sub_categories`
--
ALTER TABLE `sub_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `sub_sub_categories`
--
ALTER TABLE `sub_sub_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `teams`
--
ALTER TABLE `teams`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `team_invitations`
--
ALTER TABLE `team_invitations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `team_user`
--
ALTER TABLE `team_user`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `units`
--
ALTER TABLE `units`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `vats`
--
ALTER TABLE `vats`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `warehouses`
--
ALTER TABLE `warehouses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

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
-- Constraints for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `team_invitations`
--
ALTER TABLE `team_invitations`
  ADD CONSTRAINT `team_invitations_team_id_foreign` FOREIGN KEY (`team_id`) REFERENCES `teams` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
