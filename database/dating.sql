-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 20, 2021 at 11:55 PM
-- Server version: 10.4.19-MariaDB
-- PHP Version: 8.0.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dating`
--

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
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `message` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sender_id` bigint(20) NOT NULL,
  `receiver_id` bigint(20) NOT NULL,
  `is_read` tinyint(4) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `message`, `sender_id`, `receiver_id`, `is_read`, `created_at`, `updated_at`) VALUES
(1, 'Hi', 1, 4, 0, NULL, NULL),
(2, 'Hi', 2, 4, 0, NULL, NULL),
(3, 'Hi', 3, 4, 0, NULL, NULL),
(4, 'Hi', 1, 2, 0, NULL, NULL),
(5, 'Hi', 4, 2, 0, NULL, NULL),
(6, 'Hi', 3, 2, 0, NULL, NULL),
(7, 'Hi', 1, 3, 0, NULL, NULL),
(8, 'Hi', 2, 3, 0, NULL, NULL),
(9, 'Hi', 4, 3, 0, NULL, NULL),
(10, 'tare', 4, 2, 0, '2021-11-20 22:02:49', '2021-11-20 22:02:49'),
(11, 'This is not yet  done', 4, 2, 0, '2021-11-20 22:03:05', '2021-11-20 22:03:05'),
(12, 'Hi', 4, 2, 0, '2021-11-20 22:03:31', '2021-11-20 22:03:31'),
(13, 'Hello', 4, 3, 0, '2021-11-20 22:05:04', '2021-11-20 22:05:04'),
(14, 'This is tarek', 3, 4, 0, '2021-11-20 22:06:39', '2021-11-20 22:06:39'),
(15, 'Hi this is tarek too', 4, 3, 0, '2021-11-20 22:10:36', '2021-11-20 22:10:36'),
(16, 'Tarek hossen naeem', 4, 3, 0, '2021-11-20 22:34:57', '2021-11-20 22:34:57'),
(17, 'Hi are you litchening', 4, 3, 0, '2021-11-20 22:35:48', '2021-11-20 22:35:48');

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
(11, '2014_10_12_000000_create_users_table', 1),
(12, '2014_10_12_100000_create_password_resets_table', 1),
(13, '2019_08_19_000000_create_failed_jobs_table', 1),
(14, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(15, '2021_11_19_212632_create_user_interests_table', 1),
(16, '2021_11_21_012919_create_messages_table', 2);

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
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gender` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_of_birth` date NOT NULL,
  `latitude` decimal(10,8) NOT NULL,
  `longitude` decimal(11,8) NOT NULL,
  `profile_picture` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `two_factor_code` int(11) DEFAULT NULL,
  `two_factor_expires_at` datetime DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `gender`, `date_of_birth`, `latitude`, `longitude`, `profile_picture`, `email`, `email_verified_at`, `password`, `two_factor_code`, `two_factor_expires_at`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Platinum', 'female', '1999-10-10', '23.89314770', '90.40177080', 'uploads/pictures/1637391824.png', 'platinam@gmail.com', NULL, '$2y$10$08Lvq/y.V7uikwa/d7O59e9PS6bTjHZkEihJqc3e6PczgbQyyECXO', NULL, NULL, NULL, '2021-11-20 07:03:44', '2021-11-20 07:03:44'),
(2, 'Imperil  Palace', 'male', '1994-10-10', '23.91212320', '85.38998150', 'uploads/pictures/1637391958.jpg', 'imperil@gmail.com', NULL, '$2y$10$9csKqma9Z/VTbzOhI2kDUehyIB.0qcNR84mE2VIgolrDUUXdp2zmW', NULL, NULL, NULL, '2021-11-20 07:05:58', '2021-11-20 07:05:58'),
(3, 'Tarek Hossen', 'male', '1994-03-11', '23.86415010', '90.39951640', 'uploads/pictures/1637392235.jpg', 'tarekllf@gmail.com', NULL, '$2y$10$03trJYrw9fwdEULU9KIZ6u2NnMGMmA84zpLKBNPwxDKBEBsYxOfPS', NULL, NULL, NULL, '2021-11-20 07:10:36', '2021-11-20 07:10:36'),
(4, 'Md Naeem Hossain', 'male', '1997-10-10', '23.91742970', '90.40006670', 'uploads/pictures/1637393384.PNG', 'tarekllf01@gmail.com', NULL, '$2y$10$rALEB.QQNXbxG0XUYaj3vOir3ONIvjXcczjc10YVCF3oZC3j.WfKy', NULL, NULL, NULL, '2021-11-20 07:29:44', '2021-11-20 07:29:44');

-- --------------------------------------------------------

--
-- Table structure for table `user_interests`
--

CREATE TABLE `user_interests` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `submitted_by_id` bigint(20) NOT NULL,
  `submitted_for_id` bigint(20) NOT NULL,
  `is_interested` tinyint(4) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_interests`
--

INSERT INTO `user_interests` (`id`, `submitted_by_id`, `submitted_for_id`, `is_interested`, `created_at`, `updated_at`) VALUES
(1, 3, 4, 1, '2021-11-20 11:31:40', '2021-11-20 11:31:40'),
(2, 3, 1, 1, '2021-11-20 11:31:48', '2021-11-20 11:31:48'),
(3, 3, 2, 1, '2021-11-20 11:31:50', '2021-11-20 11:31:50'),
(19, 1, 2, 1, '2021-11-20 12:03:15', '2021-11-20 12:03:15'),
(20, 1, 3, 1, '2021-11-20 12:03:18', '2021-11-20 12:03:18'),
(28, 4, 1, 1, '2021-11-20 22:51:49', '2021-11-20 22:51:49'),
(30, 4, 2, 1, '2021-11-20 22:53:40', '2021-11-20 22:53:40'),
(31, 4, 3, 1, '2021-11-20 22:53:42', '2021-11-20 22:53:42');

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
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
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
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `user_interests`
--
ALTER TABLE `user_interests`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_interests_submitted_by_id_submitted_for_id_unique` (`submitted_by_id`,`submitted_for_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `user_interests`
--
ALTER TABLE `user_interests`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
