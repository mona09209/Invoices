-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 01, 2025 at 08:07 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `invoices`
--

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
-- Table structure for table `invoices`
--

CREATE TABLE `invoices` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `invoice_number` varchar(255) NOT NULL,
  `invoice_date` date NOT NULL,
  `due_date` date NOT NULL,
  `product` varchar(255) NOT NULL,
  `section_id` bigint(20) UNSIGNED NOT NULL,
  `discount` varchar(255) NOT NULL,
  `rate_vat` varchar(255) NOT NULL,
  `value_vat` decimal(8,2) NOT NULL,
  `amount_commission` decimal(8,2) NOT NULL,
  `amount_collection` decimal(8,2) DEFAULT NULL,
  `total` decimal(8,2) NOT NULL,
  `status` varchar(50) NOT NULL,
  `value_status` int(11) NOT NULL,
  `note` text DEFAULT NULL,
  `payment_date` date DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `invoices`
--

INSERT INTO `invoices` (`id`, `invoice_number`, `invoice_date`, `due_date`, `product`, `section_id`, `discount`, `rate_vat`, `value_vat`, `amount_commission`, `amount_collection`, `total`, `status`, `value_status`, `note`, `payment_date`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'XX-0900', '2025-02-17', '2025-02-16', 'القروض الشخصية', 1, '0', '10%', 2000.00, 20000.00, 70000.00, 22000.00, 'مدفوعة', 1, NULL, '2025-02-17', NULL, '2025-02-17 19:26:37', '2025-02-17 19:27:08'),
(2, 'DD100', '2025-02-17', '2025-02-25', 'القروض المتعثرة', 2, '0', '5%', 1500.00, 30000.00, 60000.00, 31500.00, 'مدفوعة جزئيا', 3, NULL, '2025-02-17', NULL, '2025-02-17 19:27:52', '2025-02-17 19:35:16'),
(3, 'RT300', '2025-02-17', '2025-02-26', 'CC', 1, '0', '10%', 1000.00, 10000.00, 50000.00, 11000.00, 'غير مدفوعة', 2, NULL, NULL, NULL, '2025-02-17 19:35:59', '2025-02-17 19:35:59');

-- --------------------------------------------------------

--
-- Table structure for table `invoices_details`
--

CREATE TABLE `invoices_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `invoice_number` varchar(50) NOT NULL,
  `invoice_id` bigint(20) UNSIGNED NOT NULL,
  `product` varchar(255) NOT NULL,
  `payment_date` date DEFAULT NULL,
  `section_id` varchar(255) NOT NULL,
  `status` varchar(50) NOT NULL,
  `value_status` int(11) NOT NULL,
  `note` text DEFAULT NULL,
  `created_by` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `invoices_details`
--

INSERT INTO `invoices_details` (`id`, `invoice_number`, `invoice_id`, `product`, `payment_date`, `section_id`, `status`, `value_status`, `note`, `created_by`, `created_at`, `updated_at`) VALUES
(1, 'XX-0900', 1, 'القروض الشخصية', NULL, '1', 'غير مدفوعة', 2, NULL, 'Mona', '2025-02-17 19:26:37', '2025-02-17 19:26:37'),
(2, 'XX-0900', 1, 'القروض الشخصية', '2025-02-17', '1', 'مدفوعة', 1, NULL, 'Mona', '2025-02-17 19:27:08', '2025-02-17 19:27:08'),
(3, 'DD100', 2, 'القروض المتعثرة', NULL, '2', 'غير مدفوعة', 2, NULL, 'Mona', '2025-02-17 19:27:52', '2025-02-17 19:27:52'),
(4, 'DD100', 2, 'القروض المتعثرة', '2025-02-17', '2', 'مدفوعة جزئيا', 3, NULL, 'Mona', '2025-02-17 19:35:16', '2025-02-17 19:35:16'),
(5, 'RT300', 3, 'CC', NULL, '1', 'غير مدفوعة', 2, NULL, 'Mona', '2025-02-17 19:36:00', '2025-02-17 19:36:00');

-- --------------------------------------------------------

--
-- Table structure for table `invoice_attachments`
--

CREATE TABLE `invoice_attachments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `file_name` varchar(999) NOT NULL,
  `invoice_number` varchar(50) NOT NULL,
  `created_by` varchar(255) NOT NULL,
  `invoice_id` bigint(20) UNSIGNED DEFAULT NULL,
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
(6, '2025_02_02_150209_create_sections_table', 1),
(7, '2025_02_03_221933_create_invoices_table', 1),
(8, '2025_02_05_075126_create_products_table', 1),
(9, '2025_02_06_222552_create_invoices_details_table', 1),
(10, '2025_02_06_223856_create_invoice_attachments_table', 1),
(11, '2025_02_11_213940_create_permission_tables', 1),
(12, '2025_02_12_115859_create_notifications', 1),
(13, '2025_02_17_212107_update_status_column_in_users', 2);

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
(1, 'App\\Models\\User', 1);

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` char(36) NOT NULL,
  `type` varchar(255) NOT NULL,
  `notifiable_type` varchar(255) NOT NULL,
  `notifiable_id` bigint(20) UNSIGNED NOT NULL,
  `data` text NOT NULL,
  `read_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `type`, `notifiable_type`, `notifiable_id`, `data`, `read_at`, `created_at`, `updated_at`) VALUES
('6b39fdfa-3285-4861-a8de-2ed43c612008', 'App\\Notifications\\add_invoice', 'App\\Models\\User', 1, '{\"invoice_id\":2,\"title\":\"\\u062a\\u0645 \\u0625\\u0636\\u0627\\u0641\\u0629 \\u0641\\u0627\\u062a\\u0648\\u0631\\u0629 \\u062c\\u062f\\u064a\\u062f\\u0629 \\u0628\\u0648\\u0627\\u0633\\u0637\\u0629:\",\"user\":\"Mona\"}', '2025-02-17 19:34:38', '2025-02-17 19:27:59', '2025-02-17 19:34:38'),
('f74e9bec-dfcb-4e64-8dd7-8c47fb0c8697', 'App\\Notifications\\add_invoice', 'App\\Models\\User', 1, '{\"invoice_id\":3,\"title\":\"\\u062a\\u0645 \\u0625\\u0636\\u0627\\u0641\\u0629 \\u0641\\u0627\\u062a\\u0648\\u0631\\u0629 \\u062c\\u062f\\u064a\\u062f\\u0629 \\u0628\\u0648\\u0627\\u0633\\u0637\\u0629:\",\"user\":\"Mona\"}', NULL, '2025-02-17 19:36:05', '2025-02-17 19:36:05');

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
(1, 'الفواتير', 'web', '2025-02-17 19:19:24', '2025-02-17 19:19:24'),
(2, 'قائمة الفواتير', 'web', '2025-02-17 19:19:24', '2025-02-17 19:19:24'),
(3, 'الفواتير المدفوعة', 'web', '2025-02-17 19:19:24', '2025-02-17 19:19:24'),
(4, 'الفواتير المدفوعة جزئيا', 'web', '2025-02-17 19:19:24', '2025-02-17 19:19:24'),
(5, 'الفواتير الغير مدفوعة', 'web', '2025-02-17 19:19:24', '2025-02-17 19:19:24'),
(6, 'ارشيف الفواتير', 'web', '2025-02-17 19:19:24', '2025-02-17 19:19:24'),
(7, 'التقارير', 'web', '2025-02-17 19:19:24', '2025-02-17 19:19:24'),
(8, 'تقرير الفواتير', 'web', '2025-02-17 19:19:24', '2025-02-17 19:19:24'),
(9, 'تقرير العملاء', 'web', '2025-02-17 19:19:24', '2025-02-17 19:19:24'),
(10, 'المستخدمين', 'web', '2025-02-17 19:19:24', '2025-02-17 19:19:24'),
(11, 'قائمة المستخدمين', 'web', '2025-02-17 19:19:24', '2025-02-17 19:19:24'),
(12, 'صلاحيات المستخدمين', 'web', '2025-02-17 19:19:24', '2025-02-17 19:19:24'),
(13, 'الاعدادات', 'web', '2025-02-17 19:19:24', '2025-02-17 19:19:24'),
(14, 'المنتجات', 'web', '2025-02-17 19:19:24', '2025-02-17 19:19:24'),
(15, 'الاقسام', 'web', '2025-02-17 19:19:25', '2025-02-17 19:19:25'),
(16, 'اضافة فاتورة', 'web', '2025-02-17 19:19:25', '2025-02-17 19:19:25'),
(17, 'حذف الفاتورة', 'web', '2025-02-17 19:19:25', '2025-02-17 19:19:25'),
(18, 'تصدير EXCEL', 'web', '2025-02-17 19:19:25', '2025-02-17 19:19:25'),
(19, 'تغير حالة الدفع', 'web', '2025-02-17 19:19:25', '2025-02-17 19:19:25'),
(20, 'تعديل الفاتورة', 'web', '2025-02-17 19:19:25', '2025-02-17 19:19:25'),
(21, 'ارشفة الفاتورة', 'web', '2025-02-17 19:19:25', '2025-02-17 19:19:25'),
(22, 'طباعةالفاتورة', 'web', '2025-02-17 19:19:25', '2025-02-17 19:19:25'),
(23, 'اضافة مرفق', 'web', '2025-02-17 19:19:25', '2025-02-17 19:19:25'),
(24, 'حذف المرفق', 'web', '2025-02-17 19:19:25', '2025-02-17 19:19:25'),
(25, 'اضافة مستخدم', 'web', '2025-02-17 19:19:25', '2025-02-17 19:19:25'),
(26, 'تعديل مستخدم', 'web', '2025-02-17 19:19:25', '2025-02-17 19:19:25'),
(27, 'حذف مستخدم', 'web', '2025-02-17 19:19:25', '2025-02-17 19:19:25'),
(28, 'عرض صلاحية', 'web', '2025-02-17 19:19:25', '2025-02-17 19:19:25'),
(29, 'اضافة صلاحية', 'web', '2025-02-17 19:19:25', '2025-02-17 19:19:25'),
(30, 'تعديل صلاحية', 'web', '2025-02-17 19:19:25', '2025-02-17 19:19:25'),
(31, 'حذف صلاحية', 'web', '2025-02-17 19:19:25', '2025-02-17 19:19:25'),
(32, 'اضافة منتج', 'web', '2025-02-17 19:19:25', '2025-02-17 19:19:25'),
(33, 'تعديل منتج', 'web', '2025-02-17 19:19:25', '2025-02-17 19:19:25'),
(34, 'حذف منتج', 'web', '2025-02-17 19:19:25', '2025-02-17 19:19:25'),
(35, 'اضافة قسم', 'web', '2025-02-17 19:19:25', '2025-02-17 19:19:25'),
(36, 'تعديل قسم', 'web', '2025-02-17 19:19:25', '2025-02-17 19:19:25'),
(37, 'حذف قسم', 'web', '2025-02-17 19:19:25', '2025-02-17 19:19:25'),
(38, 'الاشعارات', 'web', '2025-02-17 19:19:25', '2025-02-17 19:19:25');

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
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `section_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `description`, `section_id`, `created_at`, `updated_at`) VALUES
(1, 'القروض الشخصية', NULL, 1, '2025-02-17 19:25:19', '2025-02-17 19:25:19'),
(2, 'CC', NULL, 1, '2025-02-17 19:25:33', '2025-02-17 19:25:33'),
(3, 'القروض المتعثرة', NULL, 2, '2025-02-17 19:25:56', '2025-02-17 19:25:56');

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
(1, 'owner', 'web', '2025-02-17 19:22:50', '2025-02-17 19:22:50');

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
(2, 1),
(3, 1),
(4, 1),
(5, 1),
(6, 1),
(7, 1),
(8, 1),
(9, 1),
(10, 1),
(11, 1),
(12, 1),
(13, 1),
(14, 1),
(15, 1),
(16, 1),
(17, 1),
(18, 1),
(19, 1),
(20, 1),
(21, 1),
(22, 1),
(23, 1),
(24, 1),
(25, 1),
(26, 1),
(27, 1),
(28, 1),
(29, 1),
(30, 1),
(31, 1),
(32, 1),
(33, 1),
(34, 1),
(35, 1),
(36, 1),
(37, 1),
(38, 1);

-- --------------------------------------------------------

--
-- Table structure for table `sections`
--

CREATE TABLE `sections` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `created_by` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sections`
--

INSERT INTO `sections` (`id`, `name`, `description`, `created_by`, `created_at`, `updated_at`) VALUES
(1, 'بنك الخرطوم', NULL, 'Mona', '2025-02-17 19:24:39', '2025-02-17 19:24:39'),
(2, 'البنك الفرنسي', NULL, 'Mona', '2025-02-17 19:24:52', '2025-02-17 19:24:52');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `roles_name` text NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `roles_name`, `remember_token`, `created_at`, `updated_at`, `status`) VALUES
(1, 'Mona', 'admin@admin.com', NULL, '$2y$12$ZhGHcS7Q4hHqnIVomJspYOROhpdrBriBqoIB1d7TR/ZLhlANnA/T2', '[\"owner\"]', NULL, '2025-02-17 19:22:49', '2025-02-17 19:22:49', 0);

--
-- Indexes for dumped tables
--

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
  ADD PRIMARY KEY (`id`),
  ADD KEY `invoices_section_id_foreign` (`section_id`);

--
-- Indexes for table `invoices_details`
--
ALTER TABLE `invoices_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `invoices_details_invoice_id_foreign` (`invoice_id`);

--
-- Indexes for table `invoice_attachments`
--
ALTER TABLE `invoice_attachments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `invoice_attachments_invoice_id_foreign` (`invoice_id`);

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
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `notifications_notifiable_type_notifiable_id_index` (`notifiable_type`,`notifiable_id`);

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
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `products_section_id_foreign` (`section_id`);

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
-- Indexes for table `sections`
--
ALTER TABLE `sections`
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
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `invoices`
--
ALTER TABLE `invoices`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `invoices_details`
--
ALTER TABLE `invoices_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `invoice_attachments`
--
ALTER TABLE `invoice_attachments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `sections`
--
ALTER TABLE `sections`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `invoices`
--
ALTER TABLE `invoices`
  ADD CONSTRAINT `invoices_section_id_foreign` FOREIGN KEY (`section_id`) REFERENCES `sections` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `invoices_details`
--
ALTER TABLE `invoices_details`
  ADD CONSTRAINT `invoices_details_invoice_id_foreign` FOREIGN KEY (`invoice_id`) REFERENCES `invoices` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `invoice_attachments`
--
ALTER TABLE `invoice_attachments`
  ADD CONSTRAINT `invoice_attachments_invoice_id_foreign` FOREIGN KEY (`invoice_id`) REFERENCES `invoices` (`id`) ON DELETE CASCADE;

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
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_section_id_foreign` FOREIGN KEY (`section_id`) REFERENCES `sections` (`id`) ON DELETE CASCADE;

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
