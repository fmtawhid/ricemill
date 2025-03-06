-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Mar 06, 2025 at 09:38 AM
-- Server version: 8.0.30
-- PHP Version: 8.3.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ricemill`
--

-- --------------------------------------------------------

--
-- Table structure for table `currencies`
--

CREATE TABLE `currencies` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `note` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `currencies`
--

INSERT INTO `currencies` (`id`, `name`, `note`, `created_at`, `updated_at`) VALUES
(1, 'tk', NULL, '2025-03-05 23:20:45', '2025-03-05 23:20:45');

-- --------------------------------------------------------

--
-- Table structure for table `domains`
--

CREATE TABLE `domains` (
  `id` int UNSIGNED NOT NULL,
  `domain` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tenant_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `domains`
--

INSERT INTO `domains` (`id`, `domain`, `tenant_id`, `created_at`, `updated_at`) VALUES
(5, 'tenant1.localhost', 'tenant1', '2025-03-06 03:33:57', '2025-03-06 03:33:57'),
(6, 'tenant2.localhost', 'tenant2', '2025-03-06 03:33:57', '2025-03-06 03:33:57'),
(7, 'tenant3.localhost', 'tenant3', '2025-03-06 03:33:57', '2025-03-06 03:33:57');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `galleries`
--

CREATE TABLE `galleries` (
  `id` bigint UNSIGNED NOT NULL,
  `note` text,
  `date` date NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `galleries`
--

INSERT INTO `galleries` (`id`, `note`, `date`, `image`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'class room photo', '2024-12-10', '1733840986.jpg', '2024-12-10 19:29:46', '2025-02-28 23:23:51', '2025-02-28 23:23:51'),
(2, 'another class room', '2024-12-10', '1733841016.jpg', '2024-12-10 19:30:16', '2025-02-28 23:23:48', '2025-02-28 23:23:48'),
(3, 'photo 4', '2024-12-10', '1733841035.jpg', '2024-12-10 19:30:35', '2025-02-28 23:23:45', '2025-02-28 23:23:45'),
(4, 'photo 5', '2024-12-10', '1733841053.jpg', '2024-12-10 19:30:53', '2025-02-28 23:26:29', '2025-02-28 23:26:29'),
(5, 'photo 5', '2024-12-10', '1733841093.jpg', '2024-12-10 19:31:33', '2025-02-28 23:23:42', '2025-02-28 23:23:42'),
(6, 'photo 6', '2024-12-10', '1738839232.jpg', '2024-12-10 19:31:52', '2025-03-01 00:23:07', '2025-03-01 00:23:07'),
(7, 'fghjkfghjkg', '2025-03-01', '1740806666.jpg', '2025-02-28 23:24:26', '2025-02-28 23:24:26', NULL),
(8, NULL, '2025-03-01', '1740806764.jpg', '2025-02-28 23:26:04', '2025-02-28 23:26:04', NULL),
(9, 'ooik;pi', '2025-03-01', '1740807798.jpg', '2025-02-28 23:43:18', '2025-02-28 23:43:18', NULL),
(10, NULL, '2025-03-01', '1740809295.jpg', '2025-03-01 00:08:15', '2025-03-01 00:08:15', NULL),
(11, NULL, '2025-03-01', '1740809358.jpg', '2025-03-01 00:09:18', '2025-03-01 00:09:18', NULL),
(12, NULL, '2025-03-01', 'cropped_1740809738.png', '2025-03-01 00:15:38', '2025-03-01 00:23:01', '2025-03-01 00:23:01'),
(13, 'fghfgdf gdfg dfghdfghdfgh fdg', '2025-03-01', 'cropped_1740810144.png', '2025-03-01 00:22:24', '2025-03-01 00:22:24', NULL),
(14, 'dfgsdfg sdfgsdf', '2025-03-03', 'cropped_1740983212.png', '2025-03-03 00:26:52', '2025-03-03 00:26:52', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2024_12_04_085232_add_role_to_users_table', 2),
(6, '2024_12_04_095240_create_settings_table', 3),
(7, '2024_12_04_124340_create_srenis_table', 4),
(8, '2024_12_04_155919_create_students_table', 5),
(9, '2024_12_04_161852_add_slug_to_students_table', 6),
(10, '2024_12_04_162250_add_admission_id_to_students_table', 7),
(11, '2024_12_04_183942_create_student_attachments_table', 8),
(12, '2024_12_05_055947_add_file_type_to_student_attachments_table', 9),
(13, '2024_12_05_113806_create_expense_heads_table', 10),
(14, '2024_12_05_114741_create_expenses_table', 10),
(15, '2024_12_05_114759_create_expense_attachments_table', 10),
(16, '2024_12_05_190112_add_file_type_to_expense_attachments_table', 11),
(17, '2024_12_06_144248_create_payments_table', 12),
(18, '2024_12_06_155400_create_bibags_table', 13),
(21, '2024_12_06_160553_add_bibag_id_to_students_table', 14),
(22, '2024_12_06_165239_add_bibag_id_to_payments_table', 14),
(27, '2024_12_09_123319_create_notices_table', 16),
(28, '2025_02_04_100115_create_attachment_types_table', 17),
(29, '2025_02_04_101343_create_attachments_table', 18),
(30, '2025_02_04_102102_create_attachments_table', 19),
(31, '2025_02_05_054653_update_payments_table', 20),
(32, '2025_02_06_094942_add_columns_to_students_table', 21),
(33, '2025_02_09_061603_update_payments_table', 22),
(36, '2025_02_09_113305_add_gender_to_students_table', 23),
(37, '2025_02_11_064427_add_fields_to_teachers_table', 24),
(39, '2025_02_18_044303_create_permission_tables', 25),
(40, '2025_02_20_045316_create_categories_table', 26),
(41, '2025_02_20_045353_create_sub_categories_table', 27),
(42, '2025_02_20_045413_create_news_types_table', 28),
(44, '2025_02_25_064849_create_posts_table', 29),
(45, '2025_02_26_101900_add_sub_category_id_to_posts_table', 30),
(46, '2025_02_26_121145_add_views_to_posts_table', 31),
(47, '2025_02_27_092644_add_news_type_id_to_posts_table', 32),
(48, '2025_03_02_034735_add_author_name_to_posts_table', 33),
(49, '2025_03_06_035031_create_units_table', 34),
(50, '2025_03_06_045652_create_currencies_table', 35),
(51, '2019_09_15_000010_create_tenants_table', 36),
(52, '2019_09_15_000020_create_domains_table', 37);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint UNSIGNED NOT NULL,
  `model_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint UNSIGNED NOT NULL,
  `model_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(33, 'App\\Models\\User', 1),
(37, 'App\\Models\\User', 7),
(39, 'App\\Models\\User', 8),
(38, 'App\\Models\\User', 9);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(13, 'gallery_view', 'web', '2025-02-18 05:59:22', '2025-02-18 05:59:22'),
(14, 'gallery_add', 'web', '2025-02-18 05:59:36', '2025-02-18 05:59:36'),
(15, 'gallery_edit', 'web', '2025-02-18 05:59:45', '2025-02-18 05:59:45'),
(16, 'gallery_delete', 'web', '2025-02-18 05:59:52', '2025-02-18 05:59:52'),
(69, 'role_view', 'web', '2025-02-19 04:45:53', '2025-02-19 04:45:53'),
(70, 'role_add', 'web', '2025-02-19 04:45:58', '2025-02-19 04:45:58'),
(71, 'role_edit', 'web', '2025-02-19 04:46:03', '2025-02-19 04:46:03'),
(72, 'role_delete', 'web', '2025-02-19 04:46:08', '2025-02-19 04:46:08'),
(73, 'permission_view', 'web', '2025-02-19 04:46:31', '2025-02-19 04:46:31'),
(74, 'permission_add', 'web', '2025-02-19 04:46:36', '2025-02-19 04:46:36'),
(75, 'permission_edit', 'web', '2025-02-19 04:46:40', '2025-02-19 04:46:40'),
(76, 'permission_delete', 'web', '2025-02-19 04:46:47', '2025-02-19 04:46:47'),
(77, 'user_view', 'web', '2025-02-19 04:47:00', '2025-02-19 04:47:00'),
(78, 'user_add', 'web', '2025-02-19 04:47:04', '2025-02-19 04:47:04'),
(79, 'user_edit', 'web', '2025-02-19 04:47:09', '2025-02-19 04:47:09'),
(80, 'user_delete', 'web', '2025-02-19 04:47:15', '2025-02-19 04:47:15'),
(82, 'post_add', 'web', '2025-03-01 01:47:44', '2025-03-01 01:47:44'),
(83, 'post_view', 'web', '2025-03-01 01:47:52', '2025-03-01 01:47:52'),
(84, 'post_edit', 'web', '2025-03-01 01:47:58', '2025-03-01 01:47:58'),
(85, 'post_delete', 'web', '2025-03-01 01:48:04', '2025-03-01 01:48:04'),
(86, 'category_add', 'web', '2025-03-01 01:48:13', '2025-03-01 01:48:13'),
(87, 'category_view', 'web', '2025-03-01 01:48:19', '2025-03-01 01:48:19'),
(88, 'category_edit', 'web', '2025-03-01 01:48:24', '2025-03-01 01:48:24'),
(89, 'category_delete', 'web', '2025-03-01 01:48:31', '2025-03-01 01:48:31'),
(90, 'setting_view', 'web', '2025-03-01 21:14:48', '2025-03-01 21:14:48');

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
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
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(33, 'Admin', 'web', '2025-02-18 03:06:58', '2025-03-01 21:19:02'),
(37, 'Press', 'web', '2025-02-19 04:17:31', '2025-03-01 01:50:41'),
(38, 'editor', 'web', '2025-02-19 04:21:27', '2025-03-01 01:46:21'),
(39, 'Moderator', 'web', '2025-03-01 01:56:34', '2025-03-01 01:56:34');

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint UNSIGNED NOT NULL,
  `role_id` bigint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_has_permissions`
--

INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
(13, 33),
(14, 33),
(15, 33),
(69, 33),
(70, 33),
(71, 33),
(72, 33),
(73, 33),
(74, 33),
(75, 33),
(76, 33),
(77, 33),
(78, 33),
(79, 33),
(80, 33),
(82, 33),
(83, 33),
(84, 33),
(85, 33),
(86, 33),
(87, 33),
(88, 33),
(89, 33),
(90, 33),
(82, 37),
(82, 38),
(83, 38),
(84, 38),
(13, 39),
(14, 39),
(15, 39),
(82, 39),
(83, 39),
(84, 39),
(85, 39),
(86, 39),
(87, 39),
(88, 39);

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `logo` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `favicon` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `city` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `state` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `zip` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `name`, `logo`, `favicon`, `email`, `address`, `city`, `state`, `zip`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Auto Rice Mill', '1727430172logo_1740816209.png', '1727430350fav_1740819542.png', 'admin@gmail.com', 'Soanlipara', 'sonalipur', 'sonali', '23123', NULL, '2025-03-05 03:28:00', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `teachers`
--

CREATE TABLE `teachers` (
  `id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `designation` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `phone_number` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `address` text,
  `facebook_link` varchar(255) DEFAULT NULL,
  `date_of_joining` date DEFAULT NULL,
  `salary` decimal(8,2) DEFAULT NULL,
  `qualification` varchar(255) DEFAULT NULL,
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `years_of_experience` int DEFAULT NULL,
  `department` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `teachers`
--

INSERT INTO `teachers` (`id`, `created_at`, `updated_at`, `deleted_at`, `name`, `designation`, `image`, `phone_number`, `email`, `address`, `facebook_link`, `date_of_joining`, `salary`, `qualification`, `status`, `years_of_experience`, `department`) VALUES
(3, '2024-12-11 18:41:29', '2025-02-11 01:17:21', NULL, 'Md Emtiaj Ahammad', 'Teacher', '1733924489.jpg', '01521584092', NULL, NULL, NULL, NULL, NULL, NULL, 'active', NULL, NULL),
(4, '2024-12-11 18:41:51', '2025-02-11 01:17:09', NULL, 'Md Anowar Hossain', 'Teacher', '1733924511.jpg', '01603747235', NULL, NULL, NULL, NULL, NULL, NULL, 'active', NULL, NULL),
(5, '2024-12-11 18:42:21', '2025-02-11 01:16:57', NULL, 'Md Lokman Hossain', 'Teacher', '1733924541.jpg', '0123456789', NULL, NULL, NULL, NULL, NULL, NULL, 'active', NULL, NULL),
(8, '2024-12-17 18:22:06', '2025-02-11 01:16:48', NULL, 'Md Mamunur Rashid', 'Teacher', '1734441726.jpg', '0123456789', NULL, NULL, NULL, NULL, NULL, NULL, 'active', NULL, NULL),
(9, '2024-12-17 18:22:23', '2025-02-11 01:16:30', NULL, 'Md Nur Islam', 'Teacher', '1738839055.jpg', '0123456789', NULL, NULL, NULL, NULL, NULL, NULL, 'active', NULL, NULL),
(10, '2025-02-11 01:11:01', '2025-02-11 01:11:01', NULL, 'Demo name', 'demo title', '1739257861.jpg', '01521584092', 'demo@gmail.com', 'demo address', 'https://www.google.com/', '2025-02-11', 9999.00, 'BSC', 'active', 10, 'Demo department');

-- --------------------------------------------------------

--
-- Table structure for table `teacher_attendances`
--

CREATE TABLE `teacher_attendances` (
  `id` bigint UNSIGNED NOT NULL,
  `teacher_id` bigint UNSIGNED NOT NULL,
  `attendance_type_id` bigint UNSIGNED NOT NULL,
  `date` date NOT NULL,
  `remark` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT '',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `teacher_attendances`
--

INSERT INTO `teacher_attendances` (`id`, `teacher_id`, `attendance_type_id`, `date`, `remark`, `created_at`, `updated_at`) VALUES
(38, 3, 1, '2025-02-03', NULL, '2025-02-03 14:24:14', '2025-02-03 14:24:14'),
(39, 4, 2, '2025-02-03', NULL, '2025-02-03 14:24:14', '2025-02-03 14:24:14'),
(40, 5, 1, '2025-02-03', NULL, '2025-02-03 14:24:14', '2025-02-03 14:24:14'),
(41, 8, 1, '2025-02-03', NULL, '2025-02-03 14:24:14', '2025-02-03 14:24:14'),
(42, 9, 2, '2025-02-03', NULL, '2025-02-03 14:24:14', '2025-02-03 14:24:14');

-- --------------------------------------------------------

--
-- Table structure for table `tenants`
--

CREATE TABLE `tenants` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `data` json DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tenants`
--

INSERT INTO `tenants` (`id`, `created_at`, `updated_at`, `data`) VALUES
('tenant1', '2025-03-06 03:33:57', '2025-03-06 03:33:57', '{\"name\": \"Tenant 1\"}'),
('tenant2', '2025-03-06 03:33:57', '2025-03-06 03:33:57', '{\"name\": \"Tenant 2\"}'),
('tenant3', '2025-03-06 03:33:57', '2025-03-06 03:33:57', '{\"name\": \"Tenant 3\"}');

-- --------------------------------------------------------

--
-- Table structure for table `units`
--

CREATE TABLE `units` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `note` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `units`
--

INSERT INTO `units` (`id`, `name`, `note`, `created_at`, `updated_at`) VALUES
(1, 'KG', 'this is kG', '2025-03-05 22:52:56', '2025-03-05 22:52:56'),
(2, 'KILO', 'dfg', '2025-03-05 22:53:48', '2025-03-05 22:53:48');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `tenant_id` bigint UNSIGNED DEFAULT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `role` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'customer'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `tenant_id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `role`) VALUES
(1, NULL, 'admin', 'admin@gmail.com', '2024-12-04 02:10:56', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'ZRhHehdzRJZgq9Ugd9H7pRVt02HC4TyqGwvs7OeLDZz0lwHrxIfymBkRI0FX', '2024-12-04 02:10:56', '2024-12-04 02:10:56', 'admin'),
(7, NULL, 'press', 'press@gmail.com', NULL, '$2y$10$jKRI9HCnMIlFsDWh4TaQouMkzU3duOWRqIj1n9OvaM3girEZpemgy', NULL, '2025-03-01 02:55:45', '2025-03-01 02:55:45', 'customer'),
(8, NULL, 'modarator', 'modarator@gmail.com', NULL, '$2y$10$vdhbHyHsFwfIhsY45bj3A.T7KaUU8LT0SL/WxM4zccUW3GIv8gIqq', NULL, '2025-03-02 03:09:50', '2025-03-02 03:09:50', 'customer'),
(9, NULL, 'editor', 'editor@gmail.com', NULL, '$2y$10$6atHLChFRku1Ui7ZT7.GYuBaAnKRVHWT/rvNTw9rW08pXKLNPYnle', NULL, '2025-03-02 03:10:20', '2025-03-02 03:10:20', 'customer');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `currencies`
--
ALTER TABLE `currencies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `domains`
--
ALTER TABLE `domains`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `domains_domain_unique` (`domain`),
  ADD KEY `domains_tenant_id_foreign` (`tenant_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `galleries`
--
ALTER TABLE `galleries`
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
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

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
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `teachers`
--
ALTER TABLE `teachers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `teacher_attendances`
--
ALTER TABLE `teacher_attendances`
  ADD PRIMARY KEY (`id`),
  ADD KEY `teacher_attendances_teacher_id_index` (`teacher_id`),
  ADD KEY `teacher_attendances_attendance_type_id_index` (`attendance_type_id`);

--
-- Indexes for table `tenants`
--
ALTER TABLE `tenants`
  ADD PRIMARY KEY (`id`);

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
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `currencies`
--
ALTER TABLE `currencies`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `domains`
--
ALTER TABLE `domains`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `galleries`
--
ALTER TABLE `galleries`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=91;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `teachers`
--
ALTER TABLE `teachers`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `teacher_attendances`
--
ALTER TABLE `teacher_attendances`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `units`
--
ALTER TABLE `units`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `domains`
--
ALTER TABLE `domains`
  ADD CONSTRAINT `domains_tenant_id_foreign` FOREIGN KEY (`tenant_id`) REFERENCES `tenants` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

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
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
