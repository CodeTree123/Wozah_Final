-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 09, 2023 at 12:32 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `wozah_final`
--

-- --------------------------------------------------------

--
-- Table structure for table `catagory_infos`
--

CREATE TABLE `catagory_infos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `u_id` varchar(255) DEFAULT NULL,
  `catagory_name` varchar(255) DEFAULT NULL,
  `c_description` varchar(255) DEFAULT NULL,
  `c_status` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `catagory_infos`
--

INSERT INTO `catagory_infos` (`id`, `u_id`, `catagory_name`, `c_description`, `c_status`, `created_at`, `updated_at`) VALUES
(1, '2', 'hair  style', 'you can  change.your hair color', 1, '2023-01-09 03:14:11', '2023-01-09 03:14:36');

-- --------------------------------------------------------

--
-- Table structure for table `customer_infos`
--

CREATE TABLE `customer_infos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `u_id` varchar(255) DEFAULT NULL,
  `cus_add_status` tinyint(1) NOT NULL DEFAULT 0,
  `customer_address` varchar(255) DEFAULT NULL,
  `customer_street_name` varchar(255) DEFAULT NULL,
  `customer_street_number` varchar(255) DEFAULT NULL,
  `customer_apt` varchar(255) DEFAULT NULL,
  `customer_city` varchar(255) DEFAULT NULL,
  `customer_state` varchar(255) DEFAULT NULL,
  `customer_zip` varchar(255) DEFAULT NULL,
  `gender` varchar(255) DEFAULT NULL,
  `c_cc` varchar(255) DEFAULT NULL,
  `c_card_exp` varchar(255) DEFAULT NULL,
  `c_cvv` varchar(255) DEFAULT NULL,
  `c_payment_zip` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `customer_infos`
--

INSERT INTO `customer_infos` (`id`, `u_id`, `cus_add_status`, `customer_address`, `customer_street_name`, `customer_street_number`, `customer_apt`, `customer_city`, `customer_state`, `customer_zip`, `gender`, `c_cc`, `c_card_exp`, `c_cvv`, `c_payment_zip`, `created_at`, `updated_at`) VALUES
(1, '3', 1, 'cvmngh', '4325', '2134', '943785', 'dxbghsdfg', '23', '5423', NULL, NULL, NULL, NULL, NULL, '2023-01-09 03:17:55', '2023-01-09 04:51:25');

-- --------------------------------------------------------

--
-- Table structure for table `employee_infos`
--

CREATE TABLE `employee_infos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `sp_id` varchar(255) DEFAULT NULL,
  `emp_u_id` varchar(255) DEFAULT NULL,
  `join_date` datetime DEFAULT NULL,
  `end_date` datetime DEFAULT NULL,
  `work_status` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `employee_infos`
--

INSERT INTO `employee_infos` (`id`, `sp_id`, `emp_u_id`, `join_date`, `end_date`, `work_status`, `created_at`, `updated_at`) VALUES
(2, '1', '1', '2023-01-09 17:05:02', NULL, 0, NULL, NULL);

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
-- Table structure for table `individual_infos`
--

CREATE TABLE `individual_infos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `u_id` varchar(255) DEFAULT NULL,
  `doc_add_status` tinyint(1) NOT NULL DEFAULT 0,
  `i_street_number` varchar(255) DEFAULT NULL,
  `i_street_name` varchar(255) DEFAULT NULL,
  `i_apt` varchar(255) DEFAULT NULL,
  `i_city` varchar(255) DEFAULT NULL,
  `i_state` varchar(255) DEFAULT NULL,
  `i_zip` varchar(255) DEFAULT NULL,
  `i_driver_license` varchar(255) DEFAULT NULL,
  `i_driver_license_status` tinyint(1) NOT NULL DEFAULT 0,
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
(12, '2014_10_12_000000_create_users_table', 1),
(13, '2014_10_12_100000_create_password_resets_table', 1),
(14, '2019_08_19_000000_create_failed_jobs_table', 1),
(15, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(16, '2022_09_23_115006_create_otp_verifies_table', 1),
(17, '2022_09_23_150422_create_customer_infos_table', 1),
(18, '2022_09_23_170704_create_shop_infos_table', 1),
(19, '2022_09_24_091741_create_catagory_infos_table', 1),
(20, '2022_09_24_113421_create_subcatagory_infos_table', 1),
(21, '2022_09_24_133749_create_services_table', 1),
(22, '2022_09_25_042920_create_roles_table', 1),
(23, '2022_10_24_071258_create_individual_infos_table', 1),
(24, '2022_10_26_055354_create_employee_infos_table', 1),
(25, '2022_10_31_080607_create_orders_table', 1),
(26, '2022_10_31_084745_create_suborders_table', 1),
(27, '2022_11_15_085940_create_service_provider_docs_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `cus_id` varchar(255) DEFAULT NULL,
  `sp_id` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `total_items` varchar(255) DEFAULT NULL,
  `total_price` varchar(255) DEFAULT NULL,
  `order_status` tinyint(1) NOT NULL DEFAULT 0,
  `assign_emp_id` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `cus_id`, `sp_id`, `address`, `total_items`, `total_price`, `order_status`, `assign_emp_id`, `created_at`, `updated_at`) VALUES
(1, '3', '2', 'cvmngh,2134,4325,Apartment #943785,dxbghsdfg,23 5423,USA', '1', '2,000.00', 0, NULL, '2023-01-09 04:51:25', '2023-01-09 04:51:25');

-- --------------------------------------------------------

--
-- Table structure for table `otp_verifies`
--

CREATE TABLE `otp_verifies` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `mobile` varchar(255) NOT NULL,
  `otp` varchar(255) NOT NULL,
  `verified_at` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `otp_verifies`
--

INSERT INTO `otp_verifies` (`id`, `mobile`, `otp`, `verified_at`, `created_at`, `updated_at`) VALUES
(1, '017', '', 1, '2023-01-09 03:04:50', '2023-01-09 03:04:58'),
(2, '01777074302', '', 1, '2023-01-09 03:17:48', '2023-01-09 03:17:55');

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
  `role` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `role`) VALUES
(1, 'Admin'),
(2, 'Shop'),
(3, 'Individual'),
(4, 'Customer'),
(5, 'Employee');

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `u_id` varchar(255) DEFAULT NULL,
  `subcatagory_id` varchar(255) DEFAULT NULL,
  `service_name` varchar(255) DEFAULT NULL,
  `s_description` varchar(255) DEFAULT NULL,
  `price` varchar(255) DEFAULT NULL,
  `s_status` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`id`, `u_id`, `subcatagory_id`, `service_name`, `s_description`, `price`, `s_status`, `created_at`, `updated_at`) VALUES
(1, '2', '1', 'dgfhgcfh', 'dfhgdfhgdfgh', '2000', 1, '2023-01-09 03:16:20', '2023-01-09 03:16:20');

-- --------------------------------------------------------

--
-- Table structure for table `service_provider_docs`
--

CREATE TABLE `service_provider_docs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `u_id` varchar(255) DEFAULT NULL,
  `doc_add_status` tinyint(1) NOT NULL DEFAULT 0,
  `b_ein` varchar(255) DEFAULT NULL,
  `b_ein_status` tinyint(1) NOT NULL DEFAULT 0,
  `b_certificate` varchar(255) DEFAULT NULL,
  `b_certificate_status` tinyint(1) NOT NULL DEFAULT 0,
  `b_registration` varchar(255) DEFAULT NULL,
  `b_registration_status` tinyint(1) NOT NULL DEFAULT 0,
  `nail_salon` varchar(255) DEFAULT NULL,
  `nail_salon_status` tinyint(1) NOT NULL DEFAULT 0,
  `e_certificate` varchar(255) DEFAULT NULL,
  `e_certificate_status` tinyint(1) NOT NULL DEFAULT 0,
  `b_insurance` varchar(255) DEFAULT NULL,
  `b_insurance_status` tinyint(1) NOT NULL DEFAULT 0,
  `b_workers` varchar(255) DEFAULT NULL,
  `b_workers_status` tinyint(1) NOT NULL DEFAULT 0,
  `driver_license` varchar(255) DEFAULT NULL,
  `driver_license_status` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `service_provider_docs`
--

INSERT INTO `service_provider_docs` (`id`, `u_id`, `doc_add_status`, `b_ein`, `b_ein_status`, `b_certificate`, `b_certificate_status`, `b_registration`, `b_registration_status`, `nail_salon`, `nail_salon_status`, `e_certificate`, `e_certificate_status`, `b_insurance`, `b_insurance_status`, `b_workers`, `b_workers_status`, `driver_license`, `driver_license_status`, `created_at`, `updated_at`) VALUES
(1, '2', 1, 'b_ein20230109090145.pdf', 1, 'b_certificate20230109090145.pdf', 1, 'b_registration20230109090145.pdf', 1, 'nail_salon20230109090145.pdf', 1, 'e_certificate20230109090145.pdf', 1, 'b_insurance20230109090145.pdf', 1, 'b_workers20230109090145.pdf', 1, 'driver_license20230109090145.pdf', 1, '2023-01-09 03:04:59', '2023-01-09 03:12:13');

-- --------------------------------------------------------

--
-- Table structure for table `shop_infos`
--

CREATE TABLE `shop_infos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `u_id` varchar(255) DEFAULT NULL,
  `shop_address` varchar(255) DEFAULT NULL,
  `b_legal_name` varchar(255) DEFAULT NULL,
  `b_dba` varchar(255) DEFAULT NULL,
  `street_number_b` varchar(255) DEFAULT NULL,
  `street_name_b` varchar(255) DEFAULT NULL,
  `apt_b` varchar(255) DEFAULT NULL,
  `city_b` varchar(255) DEFAULT NULL,
  `state_b` varchar(255) DEFAULT NULL,
  `zip_b` varchar(255) DEFAULT NULL,
  `street_number_c` varchar(255) DEFAULT NULL,
  `street_name_c` varchar(255) DEFAULT NULL,
  `apt_c` varchar(255) DEFAULT NULL,
  `city_c` varchar(255) DEFAULT NULL,
  `state_c` varchar(255) DEFAULT NULL,
  `zip_c` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `shop_infos`
--

INSERT INTO `shop_infos` (`id`, `u_id`, `shop_address`, `b_legal_name`, `b_dba`, `street_number_b`, `street_name_b`, `apt_b`, `city_b`, `state_b`, `zip_b`, `street_number_c`, `street_name_c`, `apt_c`, `city_c`, `state_c`, `zip_c`, `created_at`, `updated_at`) VALUES
(1, '2', NULL, 'cbdcfb', NULL, '123', 'xfgvgzdsg', '3124', 'xdfgbsdf', 'dsfgdesg', '234', '324', '324', '342', '234', '342', '234', '2023-01-09 03:04:58', '2023-01-09 03:13:18');

-- --------------------------------------------------------

--
-- Table structure for table `subcatagory_infos`
--

CREATE TABLE `subcatagory_infos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `u_id` varchar(255) DEFAULT NULL,
  `catagory_id` varchar(255) DEFAULT NULL,
  `subcatagory_name` varchar(255) DEFAULT NULL,
  `sc_description` varchar(255) DEFAULT NULL,
  `sc_image` varchar(255) DEFAULT NULL,
  `sc_status` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `subcatagory_infos`
--

INSERT INTO `subcatagory_infos` (`id`, `u_id`, `catagory_id`, `subcatagory_name`, `sc_description`, `sc_image`, `sc_status`, `created_at`, `updated_at`) VALUES
(1, '2', '1', 'color', 'zdfzsdf', 'shopcat20230109090107.webp', 1, '2023-01-09 03:15:07', '2023-01-09 03:15:07');

-- --------------------------------------------------------

--
-- Table structure for table `suborders`
--

CREATE TABLE `suborders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` varchar(255) DEFAULT NULL,
  `service_id` varchar(255) DEFAULT NULL,
  `service_name` varchar(255) DEFAULT NULL,
  `service_subcat` varchar(255) DEFAULT NULL,
  `order_quantity` varchar(255) DEFAULT NULL,
  `sub_total` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `suborders`
--

INSERT INTO `suborders` (`id`, `order_id`, `service_id`, `service_name`, `service_subcat`, `order_quantity`, `sub_total`, `created_at`, `updated_at`) VALUES
(1, '1', '1', 'dgfhgcfh', 'color', '1', '2000', '2023-01-09 04:51:25', '2023-01-09 04:51:25');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `role_id` int(11) NOT NULL,
  `first_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `shop_name` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `user_status` tinyint(1) NOT NULL DEFAULT 0,
  `emp_status` tinyint(1) NOT NULL DEFAULT 0,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `role_id`, `first_name`, `last_name`, `shop_name`, `phone`, `email`, `email_verified_at`, `password`, `image`, `user_status`, `emp_status`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 1, 'Wozah', 'Admin', NULL, NULL, 'admin@wozah.com', '2023-01-09 00:11:15', '$2y$10$LbLrWOaUvkTBAFGqKOTKn.AnHhUpXJyjgLOO5sudSa35VXFVmiLCK', NULL, 1, 0, NULL, '2023-01-09 00:11:15', '2023-01-09 00:11:15'),
(2, 2, NULL, NULL, 'shop', '017', 'shop@gmail.com', '2023-01-09 03:05:33', '$2y$10$Io9LqrB7gLRQ4qvj3j0m8eNPG1PNoaDsiag5R8YTq05fwMVfwZry6', NULL, 1, 0, NULL, '2023-01-09 03:04:58', '2023-01-09 03:13:26'),
(3, 4, 'rafsan', 'mahbub', NULL, '01777074302', 'rafsan629424@gmail.com', '2023-01-09 03:50:36', '$2y$10$kGrrDNPrk/ygElWHqVo6buLa9dDvSt5oG1iN/C2hPneKn2e9QxGUu', NULL, 0, 0, NULL, '2023-01-09 03:17:55', '2023-01-09 03:50:36');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `catagory_infos`
--
ALTER TABLE `catagory_infos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customer_infos`
--
ALTER TABLE `customer_infos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employee_infos`
--
ALTER TABLE `employee_infos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `individual_infos`
--
ALTER TABLE `individual_infos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `otp_verifies`
--
ALTER TABLE `otp_verifies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

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
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `service_provider_docs`
--
ALTER TABLE `service_provider_docs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `shop_infos`
--
ALTER TABLE `shop_infos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subcatagory_infos`
--
ALTER TABLE `subcatagory_infos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `suborders`
--
ALTER TABLE `suborders`
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
-- AUTO_INCREMENT for table `catagory_infos`
--
ALTER TABLE `catagory_infos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `customer_infos`
--
ALTER TABLE `customer_infos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `employee_infos`
--
ALTER TABLE `employee_infos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `individual_infos`
--
ALTER TABLE `individual_infos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `otp_verifies`
--
ALTER TABLE `otp_verifies`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `service_provider_docs`
--
ALTER TABLE `service_provider_docs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `shop_infos`
--
ALTER TABLE `shop_infos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `subcatagory_infos`
--
ALTER TABLE `subcatagory_infos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `suborders`
--
ALTER TABLE `suborders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
