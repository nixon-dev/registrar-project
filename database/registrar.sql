-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 27, 2025 at 09:38 AM
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
-- Database: `registrar`
--

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `document_request`
--

CREATE TABLE `document_request` (
  `dr_id` bigint(20) NOT NULL,
  `admin_id` bigint(20) NOT NULL,
  `request_date` date NOT NULL,
  `student_id` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `middle_name` varchar(255) DEFAULT NULL,
  `course` varchar(255) NOT NULL,
  `year_graduated` varchar(255) DEFAULT NULL,
  `or_number` varchar(255) DEFAULT NULL,
  `or_date` date DEFAULT NULL,
  `request_type` varchar(255) NOT NULL,
  `purpose` varchar(255) DEFAULT NULL,
  `status` varchar(255) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `document_request`
--

INSERT INTO `document_request` (`dr_id`, `admin_id`, `request_date`, `student_id`, `last_name`, `first_name`, `middle_name`, `course`, `year_graduated`, `or_number`, `or_date`, `request_type`, `purpose`, `status`, `updated_at`, `created_at`) VALUES
(1, 11, '2025-07-28', '21-10230', 'Abalos', 'Odessa', 'Durias', 'BEED', '2025', '0524119', '2025-07-28', 'Transcript of Records', 'Employment & Board', 'For Release', '2025-10-23 05:15:54', '2025-10-23 05:15:54'),
(2, 11, '2025-09-24', '21-10952', 'Abbel', 'Zeny', 'Dumanas', 'BSCRIM', '2025', '0527528', '2025-09-24', 'Transcript of Records', 'Board', 'For Release', '2025-10-23 05:17:28', '2025-10-23 05:17:28'),
(3, 11, '2025-10-23', '21-11026', 'Dulnuan', 'Karen', 'Pumihic', 'BSCRIM', '2025', '0529234', '2025-10-23', 'Transcript of Records', 'Employment & Board', 'For Signing', '2025-10-23 07:13:57', '2025-10-23 06:07:01'),
(4, 11, '2025-09-24', '22-11015', 'Bernaga', 'Erica', 'De Nuevo', 'BSABE', '2025', '0527519', '2025-09-24', 'Transcript of Records', 'Employment & Board', 'For Signing', '2025-10-23 06:25:51', '2025-10-23 06:25:51'),
(5, 11, '2025-09-25', '21-10061', 'Lagunilla', 'Paulino', 'Andus', 'BSABE', '2025', '0527672', '2025-09-25', 'Transcript of Records', 'Employment & Board', 'For Signing', '2025-10-23 06:43:16', '2025-10-23 06:43:16'),
(6, 11, '2025-09-30', '22-11024', 'Sagucio', 'Jonah', 'Barreo', 'BSABE', '2025', '0528040', '2025-09-30', 'Transcript of Records', 'Employment & Board', 'For Signing', '2025-10-23 06:51:51', '2025-10-23 06:51:51'),
(7, 11, '2025-09-24', '22-11017', 'Servan', 'Shane', 'Ventoza', 'BSABE', '2025', '0527515', '2025-09-24', 'Transcript of Records', 'Employment & Board', 'For Signing', '2025-10-23 06:59:46', '2025-10-23 06:59:46'),
(8, 11, '2025-10-30', '22-11018', 'Villarta', 'Melanie', 'Torres', 'BSABE', '2025', '0528058', '2025-10-30', 'Transcript of Records', 'Employment & Board', 'For Signing', '2025-10-24 02:07:41', '2025-10-23 07:08:26'),
(9, 13, '2025-10-23', '25-1619', 'Paguio', 'Eunice', NULL, 'PES', '2025', '0529172', '2025-10-23', 'Transcript of Records', 'For Employment', 'Released', '2025-10-23 08:33:01', '2025-10-23 08:33:01'),
(10, 13, '2025-10-23', '25-1619', 'Paguio', 'Eunice', NULL, 'PES', '2025', '0529173', '2025-10-23', 'Diploma', 'For Employment', 'Released', '2025-10-23 08:33:47', '2025-10-23 08:33:47'),
(11, 13, '2025-10-23', '25-1619', 'Paguio', 'Eunice', NULL, 'PES', '2025', '0529174', '2025-10-23', 'Certificate of Graduation', 'For Employment', 'For Release', '2025-10-23 08:35:35', '2025-10-23 08:35:35'),
(12, 12, '2025-10-24', '19-11270', 'Prieto', 'Nickson', 'Santos', 'BSIT', '2025', NULL, NULL, 'Transcript of Records', NULL, 'Released', '2025-10-27 01:17:38', '2025-10-24 05:07:58'),
(13, 11, '2025-10-27', '21-3291', 'Pascual', 'Lorei-ann', 'Gorio', 'BTLED', '2025', '0529271', '2025-10-24', 'Transcript of Records', 'Board Examination', 'For Signing', '2025-10-27 02:26:07', '2025-10-27 02:26:07'),
(14, 11, '2025-10-10', '13-00958', 'Ancheta', 'Rosarie Mae', 'Raymundo', 'MAED', '2016', '0528573', '2025-10-10', 'Transcript of Records', 'Promotion', 'For Signing', '2025-10-27 07:24:59', '2025-10-27 07:24:59'),
(15, 11, '2025-07-28', '21-20033', 'Dadulla', 'Rowena', 'Pantaleon', 'BSHM', '2025', '0524196', '2025-07-28', 'Transcript of Records', 'Employment', 'For Signing', '2025-10-27 07:49:15', '2025-10-27 07:49:15');

-- --------------------------------------------------------

--
-- Table structure for table `history`
--

CREATE TABLE `history` (
  `history_id` bigint(20) UNSIGNED NOT NULL,
  `history_name` varchar(255) NOT NULL,
  `history_action` text NOT NULL,
  `history_description` text NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `history`
--

INSERT INTO `history` (`history_id`, `history_name`, `history_action`, `history_description`, `created_at`, `updated_at`) VALUES
(1, 'Nickson S. Prieto', 'Updated Status for', '22-11018', '2025-10-24 02:06:49', '2025-10-24 02:06:49'),
(2, 'nick', 'Updated Status for', '22-11018', '2025-10-24 02:07:41', '2025-10-24 02:07:41'),
(3, 'mac', 'Updated Status for', '19-11270', '2025-10-24 05:13:21', '2025-10-24 05:13:21'),
(4, 'nick', 'Updated Status for', '19-11270', '2025-10-27 01:17:38', '2025-10-27 01:17:38');

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
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2025_03_16_145019_document', 1);

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
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` bigint(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('3c7tUiN69tCPXgtGoHZQu5rmz4sX2doF6Iy8Py5u', 11, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiWXNYeUhXckZDUGVnY1FORHZjeElyZ1lKYU9pNUNiaDFDSklzdXZJaSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzg6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9jc3MvcGVyc29uYWwuY3NzIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTE7fQ==', 1761553522),
('5Z8ppJUkTkzXTBN6F8NvBDvunrK1j6ra6e7QcJPR', 11, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiaXRyeUVSQmNMZmFWRkF0TnBFeG9HYW1zUzB1ZG5pczBQR3VldG0zbCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9kaW9pa2l0aXMvZGFzaGJvYXJkIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTE7fQ==', 1761554226);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `username` varchar(255) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL DEFAULT 'Guest',
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `name`, `email`, `email_verified_at`, `password`, `role`, `remember_token`, `created_at`, `updated_at`) VALUES
(11, 'nick', 'Nickson S. Prieto', 'nickson.prieto005@gmail.com', NULL, '$2y$12$Qf4ILcA0Kp.VH8zrRdvbluafkvhdX2Riq2FJLsE1qoXOJY4AuRzYu', 'Administrator', 'h9QghV4RIrU1fVg9zTQOySS3GLyAXiMGHht7KBQmj0fKjSR2qZPsH7xLVthx', '2025-10-22 00:21:20', '2025-10-27 06:03:02'),
(12, 'mac', 'Reymarc R. Acosta', 'adsas@gmail.com', NULL, '$2y$12$3iHssCRmrOGb7ZxXatFHYOb8oFI5XP6D2Awg/BiRoCppb6rywOx7S', 'Administrator', 'OYvd8HMZdoACUvURqtJBIhsGkk3atqcngWUmgzW2GzQmPRqrg2A0BZWWYCWC', '2025-10-22 08:56:30', '2025-10-24 05:09:07'),
(13, 'eunice', 'Eunice O. Paguio', 'temp@gmail.com', NULL, '$2y$12$W6RHAD/D6ONL/bBtfkyzreGTx5O4L9MAu/X.30b0kj555N9SlbNtK', 'Administrator', NULL, '2025-10-23 07:16:15', '2025-10-23 07:17:06'),
(14, 'aiz', 'Reyliza A. Ramos', 'temp2@gmail.com', NULL, '$2y$12$dPjHCqfrFrSAQfVfeXwe..m7KU7T3wJSDGWs25jazq3aXydkpAbky', 'Administrator', NULL, '2025-10-23 07:44:53', '2025-10-23 07:45:41');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `document_request`
--
ALTER TABLE `document_request`
  ADD PRIMARY KEY (`dr_id`);

--
-- Indexes for table `history`
--
ALTER TABLE `history`
  ADD PRIMARY KEY (`history_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

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
-- AUTO_INCREMENT for table `document_request`
--
ALTER TABLE `document_request`
  MODIFY `dr_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `history`
--
ALTER TABLE `history`
  MODIFY `history_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
