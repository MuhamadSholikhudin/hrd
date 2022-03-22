-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 22, 2022 at 09:41 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hrdit`
--

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `number_of_employees` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`id`, `number_of_employees`, `name`, `phone_number`, `email`, `created_at`, `updated_at`) VALUES
(1, '3218042012200661', 'Abyasa Narpati M.Farm', '0832 4765 2059', 'rfarida@example.org', '2022-03-22 12:46:59', '2022-03-22 12:46:59'),
(2, '6203102603938216', 'Bagya Hutasoit', '0899 353 932', 'garang49@example.net', '2022-03-22 12:46:59', '2022-03-22 12:46:59'),
(3, '3509692107219711', 'Hasna Melani', '0693 8654 6512', 'iswahyudi.ayu@example.org', '2022-03-22 12:46:59', '2022-03-22 12:46:59'),
(4, '5203115611967883', 'Cinta Febi Laksita S.Pd', '(+62) 515 7826 245', 'koko08@example.net', '2022-03-22 12:46:59', '2022-03-22 12:46:59'),
(5, '3375162502220281', 'Bella Susanti', '(+62) 474 3711 2583', 'purwadi74@example.org', '2022-03-22 12:46:59', '2022-03-22 12:46:59');

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
-- Table structure for table `investigations`
--

CREATE TABLE `investigations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `employee_id` bigint(20) UNSIGNED NOT NULL,
  `remark` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `investigations`
--

INSERT INTO `investigations` (`id`, `employee_id`, `remark`, `created_at`, `updated_at`) VALUES
(1, 1, '[\"Sed aliquid autem molestiae quia iste officiis tempora. Quidem ut qui et quisquam inventore temporibus. Quo exercitationem accusamus a nihil animi.\",\"Nihil autem commodi assumenda beatae est et. Dolorem aliquid porro voluptatem. Saepe deserunt non minima ad est. Omnis cum nesciunt sint minima.\",\"Aliquam vero est in aut. Est officia ut sapiente dolor voluptas tenetur. Excepturi eos est earum.\",\"Est ullam voluptatem sed voluptatem. Eius amet harum esse aut.\",\"Voluptatum qui ea atque voluptas nesciunt incidunt quod. Et nostrum et optio.\",\"Hic voluptas dolor aliquid voluptatem delectus earum veniam. Facere est numquam magni cupiditate consequatur autem quia. Et corrupti voluptas dolor ut.\",\"Hic dolores nihil mollitia dolorum necessitatibus quisquam. Hic aliquid odit recusandae amet. Incidunt nam illo tempora nam suscipit unde.\"]', '2022-03-22 12:46:59', '2022-03-22 12:46:59'),
(2, 2, '[\"Non ad pariatur labore ea. Officia aut exercitationem exercitationem. Modi esse rerum fugit.\",\"Nisi provident ullam sapiente sed. Aut enim libero nisi. Quae quas dolorem eos consequatur doloremque rerum. Fuga voluptatum error esse facere enim exercitationem animi.\",\"Eius omnis reprehenderit sed ipsam adipisci. Ut necessitatibus cumque eligendi sit id id hic. Ut excepturi ut maxime rerum saepe nisi ratione. Voluptas modi qui vitae qui.\",\"Suscipit aut magni autem et omnis quam. Eum fugiat placeat expedita nihil vitae provident molestias. Reprehenderit nobis animi omnis non nihil. Architecto officiis commodi dolorem eos ratione autem quod.\",\"Excepturi minima numquam sit quam. Repellat velit consequuntur quod eligendi quo. Qui dignissimos libero pariatur atque reprehenderit ab maxime.\",\"Ut qui aliquid id ut aliquam hic numquam. Enim nisi voluptate nam dolores tempore. Sunt harum in et magnam omnis adipisci alias.\",\"Aut asperiores dolore repellendus nobis voluptate voluptates. Alias blanditiis eligendi reiciendis perspiciatis eius est. Voluptas sequi vero aliquid a autem voluptatem ipsa.\",\"Doloribus ut hic ea odio sunt eum. Amet nulla rerum et qui.\",\"Voluptatem omnis in amet nobis. Qui sit quisquam ab at. Vel deserunt placeat molestias dolorem possimus ut et dolores.\",\"Dicta qui itaque dolorem qui. Quos saepe voluptatem delectus eveniet. Ut quae nemo repellendus a omnis provident molestiae. Hic voluptatibus corrupti in atque.\"]', '2022-03-22 12:46:59', '2022-03-22 12:46:59'),
(3, 3, '[\"Facilis dolores voluptatem voluptate facere ut reprehenderit voluptatem id. A quia doloremque molestiae officia. Perspiciatis architecto ullam dicta sed alias in id sed.\",\"Earum ad blanditiis est et et excepturi consequatur. Reiciendis ab magnam delectus minus dolores non aut.\",\"Dolores eos consequatur minima dolorum officia laborum. Deleniti incidunt quas quod quos quos. Quo non deserunt sed.\",\"Adipisci est fuga est dignissimos ut autem. Iure illo quis sint dignissimos aperiam quis. Et et architecto recusandae ab velit laudantium. Earum omnis totam amet sequi delectus molestiae et.\",\"Saepe iusto consectetur doloribus est vitae ut error. Amet consequatur nobis assumenda nostrum occaecati expedita et maxime. Dicta consequatur velit ut est.\"]', '2022-03-22 12:46:59', '2022-03-22 12:46:59');

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
(20, '2014_10_12_000000_create_users_table', 1),
(21, '2014_10_12_100000_create_password_resets_table', 1),
(22, '2019_08_19_000000_create_failed_jobs_table', 1),
(23, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(24, '2022_03_17_212447_create_employees_table', 1),
(25, '2022_03_22_192855_create_investigations_table', 1);

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
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Cinta Dinda Mandasari', 'uusamah@example.org', '2022-03-22 12:46:59', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '2ruKTJ7LlR', '2022-03-22 12:46:59', '2022-03-22 12:46:59');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `employees_number_of_employees_unique` (`number_of_employees`),
  ADD UNIQUE KEY `employees_email_unique` (`email`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `investigations`
--
ALTER TABLE `investigations`
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
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `investigations`
--
ALTER TABLE `investigations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
