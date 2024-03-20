-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 20, 2024 at 05:49 PM
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
-- Database: `se6`
--

-- --------------------------------------------------------

--
-- Table structure for table `checkpoints`
--

CREATE TABLE `checkpoints` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `checkpoint_number` int(11) NOT NULL,
  `projects_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `cus_id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `regis_date` date NOT NULL,
  `phone` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `cus_id`, `name`, `address`, `regis_date`, `phone`) VALUES
(1, 'C67001', 'เกษตรคุง', 'เลขที่ 1 หมู่ 6 ต.กำแพงแสน อ.กำแพงแสน จ.นครปฐม 73140', '2024-03-20', '0 2942 8003-19'),
(2, 'C67002', 'พี่แสน', 'เลขที่ 1 หมู่ 6 ต.กำแพงแสน อ.กำแพงแสน จ.นครปฐม 73140', '2024-03-21', '0 2942 8003-19'),
(3, 'C67003', 'น้องแพง', 'เลขที่ 1 หมู่ 6 ต.กำแพงแสน อ.กำแพงแสน จ.นครปฐม 73140', '2024-03-22', '0 2942 8003-19');

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
-- Table structure for table `inventory`
--

CREATE TABLE `inventory` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_type_id` bigint(20) UNSIGNED NOT NULL,
  `product_remain` int(11) NOT NULL,
  `product_minimum` int(11) NOT NULL
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
(1, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(2, '2019_08_19_000000_create_failed_jobs_table', 1),
(3, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(4, '2024_03_02_154000_create_users_table', 1),
(5, '2024_03_03_101805_create_customers_table', 1),
(6, '2024_03_03_101806_create_project_status_table', 1),
(7, '2024_03_03_111831_create_projects_table', 1),
(8, '2024_03_03_112125_create_project_members_table', 1),
(9, '2024_03_03_130831_create_product_type_table', 1),
(10, '2024_03_03_131350_create_inventory_table', 1),
(11, '2024_03_03_131448_create_product_set_table', 1),
(12, '2024_03_03_131612_create_set_detail_table', 1),
(13, '2024_03_03_131825_create_parameters_table', 1),
(14, '2024_03_03_132011_create_checkpoints_table', 1),
(15, '2024_03_03_144931_create_parameter_in_checkpoints_table', 1),
(16, '2024_03_03_145726_create_requisitions_table', 1),
(17, '2024_03_13_153915_create_permission_tables', 1);

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
(2, 'App\\Models\\User', 2),
(2, 'App\\Models\\User', 5),
(2, 'App\\Models\\User', 6),
(3, 'App\\Models\\User', 3),
(4, 'App\\Models\\User', 7),
(5, 'App\\Models\\User', 8),
(6, 'App\\Models\\User', 9),
(7, 'App\\Models\\User', 10);

-- --------------------------------------------------------

--
-- Table structure for table `parameters`
--

CREATE TABLE `parameters` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `parameter_fullname` varchar(255) NOT NULL,
  `parameter_shortname` varchar(255) NOT NULL,
  `parameter_unit` varchar(255) NOT NULL,
  `product_set_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `parameter_in_checkpoints`
--

CREATE TABLE `parameter_in_checkpoints` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `checkpoint_id` bigint(20) UNSIGNED NOT NULL,
  `parameter_id` bigint(20) UNSIGNED NOT NULL,
  `sample_value` double(8,2) DEFAULT NULL,
  `sample_date_time` datetime DEFAULT NULL,
  `academician_id` bigint(20) UNSIGNED NOT NULL,
  `surveyor_id` bigint(20) UNSIGNED NOT NULL
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
(1, 'user-list', 'web', '2024-03-17 05:41:58', '2024-03-17 05:41:58'),
(2, 'user-create', 'web', '2024-03-17 05:41:58', '2024-03-17 05:41:58'),
(3, 'user-edit', 'web', '2024-03-17 05:41:58', '2024-03-17 05:41:58'),
(4, 'user-delete', 'web', '2024-03-17 05:41:58', '2024-03-17 05:41:58'),
(5, 'role-list', 'web', '2024-03-17 05:41:58', '2024-03-17 05:41:58'),
(6, 'role-create', 'web', '2024-03-17 05:41:58', '2024-03-17 05:41:58'),
(7, 'role-edit', 'web', '2024-03-17 05:41:58', '2024-03-17 05:41:58'),
(8, 'role-delete', 'web', '2024-03-17 05:41:58', '2024-03-17 05:41:58'),
(9, 'project-list', 'web', '2024-03-17 05:41:58', '2024-03-17 05:41:58'),
(10, 'project-create', 'web', '2024-03-17 05:41:58', '2024-03-17 05:41:58'),
(11, 'project-edit', 'web', '2024-03-17 05:41:58', '2024-03-17 05:41:58'),
(12, 'project-delete', 'web', '2024-03-17 05:41:58', '2024-03-17 05:41:58'),
(13, 'product-list', 'web', '2024-03-20 15:26:16', '2024-03-20 15:26:16'),
(14, 'product-create', 'web', '2024-03-20 15:26:29', '2024-03-20 15:26:29'),
(15, 'product-edit', 'web', '2024-03-20 15:26:29', '2024-03-20 15:26:29'),
(16, 'product-delete', 'web', '2024-03-20 15:26:53', '2024-03-20 15:26:53');

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
-- Table structure for table `product_set`
--

CREATE TABLE `product_set` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `set_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product_type`
--

CREATE TABLE `product_type` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `type_name` varchar(255) NOT NULL,
  `type_unit` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `projects`
--

CREATE TABLE `projects` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `project_id` varchar(255) NOT NULL,
  `start_date` date NOT NULL,
  `area_date` date NOT NULL,
  `map` varchar(255) NOT NULL,
  `customers_contact_name` varchar(255) NOT NULL,
  `customers_contact_phone` varchar(255) NOT NULL,
  `status_id` bigint(20) UNSIGNED NOT NULL,
  `customer_id` bigint(20) UNSIGNED NOT NULL,
  `assistant_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `projects`
--

INSERT INTO `projects` (`id`, `project_id`, `start_date`, `area_date`, `map`, `customers_contact_name`, `customers_contact_phone`, `status_id`, `customer_id`, `assistant_id`) VALUES
(1, 'P67001', '2024-03-10', '2024-03-12', 'example_1', 'สมปอง', '0 9680 96932', 1, 2, 2),
(2, 'Geraldine Ratke', '2014-04-12', '1995-04-03', '-ZA]9[0-', 'Garrett Rutherford', '27071', 3, 3, 2),
(3, 'Emelie Bernier', '2008-10-10', '2004-07-28', '9-[Z]0A-', 'Joyce Keeling', '37', 2, 1, 1),
(4, 'Miles Bogisich', '1977-04-14', '2018-01-21', 'A-0]9-[Z', 'Dariana Torphy', '885377487', 3, 2, 1),
(5, 'Magdalena Tromp', '1980-10-09', '1991-04-25', 'A9Z-]-[0', 'Candelario Goodwin', '49792955', 1, 1, 1),
(6, 'Birdie O\'Reilly', '1988-08-24', '2023-11-03', '--AZ[09]', 'Earl McCullough', '791', 3, 3, 2),
(7, 'Dr. Keegan Quigley IV', '2021-07-19', '2012-09-08', '-9A0[]Z-', 'Kody Jacobi', '2', 1, 3, 2),
(8, 'Korey Kutch', '1983-01-16', '1988-10-09', ']-9[AZ0-', 'Rylee Reilly', '3174', 3, 1, 2),
(9, 'Bridgette Zemlak', '1985-11-10', '1984-12-27', '][ZA0--9', 'Bridie Heaney Jr.', '93952628', 1, 3, 2),
(10, 'Jayda Kshlerin', '1971-12-08', '1987-01-30', '-]-90Z[A', 'Raoul Hartmann DDS', '49330', 3, 2, 2),
(11, 'Domenic Murphy', '2001-08-28', '2018-11-20', 'Z0A]-9-[', 'Dr. Rosa Pacocha PhD', '718', 3, 3, 2),
(12, 'Krystal Pagac DDS', '1997-03-24', '2013-09-14', '[A]-09-Z', 'Cooper Braun', '133747317', 1, 2, 1),
(13, 'Mrs. Stephanie Crist', '2004-09-12', '1979-09-29', '9]ZA0--[', 'Troy Conroy', '639190093', 3, 1, 2),
(14, 'Emilia Walker III', '2011-05-31', '1971-04-11', '0]ZA9[--', 'Houston Connelly', '37876', 3, 1, 2),
(15, 'Carson Rosenbaum', '2017-10-28', '1996-01-31', '-]-[AZ09', 'Jaiden Wyman', '9', 3, 3, 1),
(16, 'Miss Judy Huels', '2010-11-19', '1995-03-06', 'Z[0-A9-]', 'Bernita Kertzmann', '5370', 2, 2, 1),
(17, 'Aliza Wilderman DVM', '2002-07-17', '2009-08-10', '9]0--ZA[', 'Lizzie Powlowski', '5', 3, 1, 1),
(18, 'Damon Gleichner', '1976-01-02', '1979-04-04', '09--Z][A', 'Fletcher Beier', '990169', 2, 2, 2),
(19, 'Emelie Wilkinson', '2004-10-29', '2021-12-16', '-]A0[9-Z', 'Dr. Megane Maggio MD', '28862177', 1, 3, 1),
(20, 'Rachelle Halvorson', '2009-11-14', '1977-07-18', 'AZ-0[9-]', 'Georgianna Cole', '958666750', 2, 1, 1),
(21, 'Matilda Wiegand Jr.', '1997-06-13', '2013-09-07', '-Z-A[]09', 'Eduardo Kreiger', '3', 2, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `project_members`
--

CREATE TABLE `project_members` (
  `project_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `project_status`
--

CREATE TABLE `project_status` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `project_status`
--

INSERT INTO `project_status` (`id`, `status`) VALUES
(1, 'กำลังดำเนินการ'),
(2, 'ยังไม่ดำเนินการ'),
(3, 'ดำเนินการเสร็จสิ้น');

-- --------------------------------------------------------

--
-- Table structure for table `requisitions`
--

CREATE TABLE `requisitions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_set_id` bigint(20) UNSIGNED NOT NULL,
  `sample_id` bigint(20) UNSIGNED NOT NULL,
  `requisition_remark` varchar(255) NOT NULL
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
(1, 'Admin', 'web', '2024-03-17 05:41:59', '2024-03-17 05:41:59'),
(2, 'Manager', 'web', '2024-03-17 06:52:39', '2024-03-17 06:52:39'),
(3, 'Assistant', 'web', '2024-03-20 13:35:38', '2024-03-20 13:35:38'),
(4, 'Sales', 'web', '2024-03-20 13:36:02', '2024-03-20 13:36:02'),
(5, 'Surveyor', 'web', '2024-03-20 13:36:02', '2024-03-20 13:36:02'),
(6, 'Academician', 'web', '2024-03-20 13:37:20', '2024-03-20 13:37:20'),
(7, 'Developer', 'web', '2024-03-20 16:37:12', '2024-03-20 16:37:12');

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
(1, 7),
(2, 1),
(2, 7),
(3, 1),
(3, 7),
(4, 1),
(4, 7),
(5, 1),
(5, 7),
(6, 1),
(6, 7),
(7, 1),
(7, 7),
(8, 1),
(8, 7),
(9, 1),
(9, 2),
(9, 3),
(9, 4),
(9, 5),
(9, 6),
(9, 7),
(10, 1),
(10, 2),
(10, 4),
(10, 7),
(11, 1),
(11, 2),
(11, 4),
(11, 5),
(11, 6),
(11, 7),
(12, 1),
(12, 2),
(12, 4),
(12, 7),
(13, 3),
(13, 7),
(14, 3),
(14, 7),
(15, 3),
(15, 7),
(16, 3),
(16, 7);

-- --------------------------------------------------------

--
-- Table structure for table `set_detail`
--

CREATE TABLE `set_detail` (
  `product_set_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `employee_id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `employee_id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'EMP001', 'AdminTest', 'test@example.com', NULL, '$2y$12$X6/LiHpN9ZevPn8hQHo8P.NUv7xYlp32ATYKS3LP4Jxj4PSv4h8eu', NULL, '2024-03-17 05:41:59', '2024-03-17 05:41:59'),
(2, 'EMP002', 'Manager', 'test2@example.com', NULL, '$2y$12$yBKWi5/B/jc6Nt1C08TmxeEoEW8.aOkU5.x675IDfecgGjwjEZSa.', NULL, NULL, '2024-03-20 06:45:12'),
(3, 'EMP003', 'Assistant', 'test3@example.com', NULL, '$2y$12$ztai7m8fHanQ/DQ65.BZXepazKCX.xCeVVpp7ZQXw1S1b6w.cRTDy', NULL, NULL, '2024-03-20 06:44:59'),
(7, 'EMP004', 'Sales', 'test4@example.com', NULL, '$2y$12$VB7IxyzBBIf/gWOwxOzN5OZdPZF6CtN/R7XEjYJWSekLPBSXQSD7.', NULL, '2024-03-20 06:46:08', '2024-03-20 06:46:08'),
(8, 'EMP005', 'Surveyor', 'test5@example.com', NULL, '$2y$12$KQ5z2i.gLhn7ozGKJrIy0eZsWvVJ1okWy5ZlF7ZFxWlRwkomWyAPi', NULL, '2024-03-20 06:46:55', '2024-03-20 06:46:55'),
(9, 'EMP006', 'Academician', 'test6@example.com', NULL, '$2y$12$Nbwqn1ituYEsiaAx6uUxTezK837RdLV6A8nmbSjnxkCwgRR8oUd7e', NULL, '2024-03-20 06:47:29', '2024-03-20 06:47:29'),
(10, 'EMP007', 'Developer', 'developer@example.com', NULL, '$2y$12$GDXNn0u9iXD3ontBaAyu/uvL1jAPm5ZZXgV.uBJqG2te1AT3yHLAu', NULL, '2024-03-20 09:36:25', '2024-03-20 09:37:49');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `checkpoints`
--
ALTER TABLE `checkpoints`
  ADD PRIMARY KEY (`id`),
  ADD KEY `checkpoints_projects_id_foreign` (`projects_id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `customers_customer_id_unique` (`cus_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `inventory`
--
ALTER TABLE `inventory`
  ADD PRIMARY KEY (`id`),
  ADD KEY `inventory_product_type_id_foreign` (`product_type_id`);

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
-- Indexes for table `parameters`
--
ALTER TABLE `parameters`
  ADD PRIMARY KEY (`id`),
  ADD KEY `parameters_product_set_id_foreign` (`product_set_id`);

--
-- Indexes for table `parameter_in_checkpoints`
--
ALTER TABLE `parameter_in_checkpoints`
  ADD PRIMARY KEY (`id`),
  ADD KEY `parameter_in_checkpoints_checkpoint_id_foreign` (`checkpoint_id`),
  ADD KEY `parameter_in_checkpoints_parameter_id_foreign` (`parameter_id`),
  ADD KEY `parameter_in_checkpoints_academician_id_foreign` (`academician_id`),
  ADD KEY `parameter_in_checkpoints_surveyor_id_foreign` (`surveyor_id`);

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
-- Indexes for table `product_set`
--
ALTER TABLE `product_set`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_type`
--
ALTER TABLE `product_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `projects`
--
ALTER TABLE `projects`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `projects_projects_id_unique` (`project_id`),
  ADD KEY `projects_status_id_foreign` (`status_id`),
  ADD KEY `projects_customer_id_foreign` (`customer_id`),
  ADD KEY `projects_assistant_id_foreign` (`assistant_id`);

--
-- Indexes for table `project_members`
--
ALTER TABLE `project_members`
  ADD KEY `project_members_project_id_foreign` (`project_id`),
  ADD KEY `project_members_user_id_foreign` (`user_id`);

--
-- Indexes for table `project_status`
--
ALTER TABLE `project_status`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `requisitions`
--
ALTER TABLE `requisitions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `requisitions_product_set_id_foreign` (`product_set_id`),
  ADD KEY `requisitions_sample_id_foreign` (`sample_id`);

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
-- Indexes for table `set_detail`
--
ALTER TABLE `set_detail`
  ADD KEY `set_detail_product_set_id_foreign` (`product_set_id`),
  ADD KEY `set_detail_product_id_foreign` (`product_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_employee_id_unique` (`employee_id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `checkpoints`
--
ALTER TABLE `checkpoints`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `inventory`
--
ALTER TABLE `inventory`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `parameters`
--
ALTER TABLE `parameters`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `parameter_in_checkpoints`
--
ALTER TABLE `parameter_in_checkpoints`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product_set`
--
ALTER TABLE `product_set`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product_type`
--
ALTER TABLE `product_type`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `projects`
--
ALTER TABLE `projects`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `project_status`
--
ALTER TABLE `project_status`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `requisitions`
--
ALTER TABLE `requisitions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `checkpoints`
--
ALTER TABLE `checkpoints`
  ADD CONSTRAINT `checkpoints_projects_id_foreign` FOREIGN KEY (`projects_id`) REFERENCES `projects` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `inventory`
--
ALTER TABLE `inventory`
  ADD CONSTRAINT `inventory_product_type_id_foreign` FOREIGN KEY (`product_type_id`) REFERENCES `product_type` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE;

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
-- Constraints for table `parameters`
--
ALTER TABLE `parameters`
  ADD CONSTRAINT `parameters_product_set_id_foreign` FOREIGN KEY (`product_set_id`) REFERENCES `product_set` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `parameter_in_checkpoints`
--
ALTER TABLE `parameter_in_checkpoints`
  ADD CONSTRAINT `parameter_in_checkpoints_academician_id_foreign` FOREIGN KEY (`academician_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `parameter_in_checkpoints_checkpoint_id_foreign` FOREIGN KEY (`checkpoint_id`) REFERENCES `checkpoints` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `parameter_in_checkpoints_parameter_id_foreign` FOREIGN KEY (`parameter_id`) REFERENCES `parameters` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `parameter_in_checkpoints_surveyor_id_foreign` FOREIGN KEY (`surveyor_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `projects`
--
ALTER TABLE `projects`
  ADD CONSTRAINT `projects_assistant_id_foreign` FOREIGN KEY (`assistant_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `projects_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `projects_status_id_foreign` FOREIGN KEY (`status_id`) REFERENCES `project_status` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `project_members`
--
ALTER TABLE `project_members`
  ADD CONSTRAINT `project_members_project_id_foreign` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `project_members_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `requisitions`
--
ALTER TABLE `requisitions`
  ADD CONSTRAINT `requisitions_product_set_id_foreign` FOREIGN KEY (`product_set_id`) REFERENCES `product_set` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `requisitions_sample_id_foreign` FOREIGN KEY (`sample_id`) REFERENCES `parameter_in_checkpoints` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `set_detail`
--
ALTER TABLE `set_detail`
  ADD CONSTRAINT `set_detail_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `inventory` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `set_detail_product_set_id_foreign` FOREIGN KEY (`product_set_id`) REFERENCES `product_set` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
