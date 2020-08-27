-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 27, 2020 at 08:00 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `elearning`
--

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `forum`
--

CREATE TABLE `forum` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `file` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deskripsi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_kelas` int(11) DEFAULT NULL,
  `id_mata_pelajaran` int(11) NOT NULL,
  `aktif` tinyint(4) DEFAULT NULL,
  `publik` tinyint(4) DEFAULT NULL,
  `owner` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `forum`
--

INSERT INTO `forum` (`id`, `name`, `file`, `deskripsi`, `id_kelas`, `id_mata_pelajaran`, `aktif`, `publik`, `owner`, `created_at`, `updated_at`) VALUES
(1, 'WOOOO HAHAHAHAHAHAHA', 'lu kok bisa ada disini.png', 'ewewewewewewewe', 0, 1, 1, 1, 1, '2020-08-08 06:49:39', '2020-08-08 06:52:55'),
(2, 'eeeeee', NULL, 'aweaweaweawe', 1, 1, NULL, 1, 1, '2020-08-08 06:53:43', '2020-08-08 06:53:43'),
(4, 'Forum Umum', NULL, 'ewewewew', NULL, 1, NULL, NULL, 1, '2020-08-08 08:51:36', '2020-08-08 08:51:36'),
(5, 'Kelas Kuvukiland', NULL, 'qweqwewewewewe', 1, 1, 1, NULL, 1, '2020-08-08 08:51:53', '2020-08-08 08:51:53');

-- --------------------------------------------------------

--
-- Table structure for table `forum_isi`
--

CREATE TABLE `forum_isi` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_reply` int(11) DEFAULT NULL,
  `file` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deskripsi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_forum` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `forum_isi`
--

INSERT INTO `forum_isi` (`id`, `id_user`, `id_reply`, `file`, `deskripsi`, `id_forum`, `created_at`, `updated_at`) VALUES
(1, 4, NULL, NULL, 'sapi hatiku', 5, '2020-08-08 09:49:32', '2020-08-08 09:49:32'),
(2, 4, 1, NULL, 'galau jiwaku', 5, '2020-08-08 10:39:36', '2020-08-08 10:39:36'),
(3, 1, NULL, NULL, 'isabella adalah', 5, '2020-08-08 10:41:26', '2020-08-08 10:41:26'),
(4, 1, 2, NULL, 'woe malah nyanyi le', 5, '2020-08-08 10:46:01', '2020-08-08 11:29:54'),
(5, 4, 4, '101183664_1617867628377720_8590144650260512768_n.jpg', 'yamaaf', 5, '2020-08-08 10:47:37', '2020-08-08 10:47:37');

-- --------------------------------------------------------

--
-- Table structure for table `forum_rate`
--

CREATE TABLE `forum_rate` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_user` int(11) NOT NULL,
  `forum_isi` int(11) DEFAULT NULL,
  `jenis` tinyint(4) DEFAULT NULL,
  `aktif` tinyint(4) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `forum_rate`
--

INSERT INTO `forum_rate` (`id`, `id_user`, `forum_isi`, `jenis`, `aktif`, `created_at`, `updated_at`) VALUES
(1, 4, 1, 0, 1, '2020-08-08 10:34:58', '2020-08-08 10:36:14'),
(2, 1, 1, 1, 1, '2020-08-08 10:41:03', '2020-08-08 10:41:03'),
(3, 1, 2, 0, 0, '2020-08-08 10:41:08', '2020-08-08 11:30:11'),
(4, 4, 8, 1, 1, '2020-08-08 14:25:11', '2020-08-08 14:25:11');

-- --------------------------------------------------------

--
-- Table structure for table `hasil_ujian`
--

CREATE TABLE `hasil_ujian` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_ujian` int(11) NOT NULL,
  `benar` int(11) NOT NULL,
  `salah` int(11) NOT NULL,
  `kosong` int(11) NOT NULL,
  `nilai` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `hasil_ujian`
--

INSERT INTO `hasil_ujian` (`id`, `id_user`, `id_ujian`, `benar`, `salah`, `kosong`, `nilai`, `created_at`, `updated_at`) VALUES
(1, 4, 2, 3, 2, 0, 60, '2020-08-08 17:11:51', '2020-08-08 17:11:51'),
(2, 4, 1, 2, 0, 0, 100, '2020-08-08 17:22:54', '2020-08-08 17:26:34');

-- --------------------------------------------------------

--
-- Table structure for table `jawaban`
--

CREATE TABLE `jawaban` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_soal` int(11) NOT NULL,
  `jawaban` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `jawaban`
--

INSERT INTO `jawaban` (`id`, `id_user`, `id_soal`, `jawaban`, `created_at`, `updated_at`) VALUES
(1, 4, 4, 'a', '2020-08-08 17:10:16', '2020-08-08 17:10:16'),
(2, 4, 5, 'd', '2020-08-08 17:10:17', '2020-08-08 17:10:17'),
(3, 4, 6, 'b', '2020-08-08 17:10:17', '2020-08-08 17:10:17'),
(4, 4, 7, 'd', '2020-08-08 17:10:17', '2020-08-08 17:10:17'),
(5, 4, 8, 'c', '2020-08-08 17:10:17', '2020-08-08 17:10:17'),
(6, 4, 2, 'd', '2020-08-08 17:26:34', '2020-08-08 17:26:34'),
(7, 4, 3, 'b', '2020-08-08 17:26:34', '2020-08-08 17:26:34');

-- --------------------------------------------------------

--
-- Table structure for table `kelas`
--

CREATE TABLE `kelas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kelas`
--

INSERT INTO `kelas` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Kelas Kuvukiland', '2020-08-05 23:26:46', '2020-08-05 23:28:18'),
(4, 'Kelas Angkasa', '2020-08-05 23:45:13', '2020-08-05 23:45:13');

-- --------------------------------------------------------

--
-- Table structure for table `kumpul_tugas`
--

CREATE TABLE `kumpul_tugas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_user` int(11) NOT NULL,
  `deskripsi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_tugas` int(11) NOT NULL,
  `file` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kumpul_tugas`
--

INSERT INTO `kumpul_tugas` (`id`, `id_user`, `deskripsi`, `id_tugas`, `file`, `created_at`, `updated_at`) VALUES
(1, 4, 'dsdsdsdsds', 1, '222.png', '2020-08-08 03:34:57', '2020-08-08 06:09:46');

-- --------------------------------------------------------

--
-- Table structure for table `mata_pelajaran`
--

CREATE TABLE `mata_pelajaran` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `mata_pelajaran`
--

INSERT INTO `mata_pelajaran` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Bahasa Inggris', '2020-08-05 23:56:39', '2020-08-05 23:56:47'),
(3, 'Matematika', '2020-08-07 23:44:29', '2020-08-07 23:44:29');

-- --------------------------------------------------------

--
-- Table structure for table `materi_download`
--

CREATE TABLE `materi_download` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `file` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deskripsi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_kelas` int(11) DEFAULT NULL,
  `id_mata_pelajaran` int(11) NOT NULL,
  `aktif` tinyint(4) DEFAULT NULL,
  `owner` int(11) NOT NULL,
  `download` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `materi_download`
--

INSERT INTO `materi_download` (`id`, `name`, `file`, `deskripsi`, `id_kelas`, `id_mata_pelajaran`, `aktif`, `owner`, `download`, `created_at`, `updated_at`) VALUES
(1, 'TES', 'bruh.png', 'qewqeas dasd asda sdasd asdasd', NULL, 1, NULL, 1, 5, '2020-08-06 13:45:54', '2020-08-08 15:22:57'),
(4, 'admin', NULL, 'ewewe', NULL, 1, 1, 1, NULL, '2020-08-06 15:54:14', '2020-08-06 15:54:14'),
(6, 'Kuvukiland Only', 'hong.png', 'sasasasa', 1, 3, 1, 3, 7, '2020-08-08 05:21:26', '2020-08-08 12:40:08');

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
(31, '2014_10_12_000000_create_users_table', 1),
(32, '2014_10_12_100000_create_password_resets_table', 1),
(33, '2019_08_19_000000_create_failed_jobs_table', 1),
(34, '2020_08_04_233605_ujian', 1),
(35, '2020_08_04_233913_soal', 1),
(36, '2020_08_04_234001_tugas', 1),
(37, '2020_08_04_234035_kumpul_tugas', 1),
(38, '2020_08_04_234104_forum', 1),
(39, '2020_08_04_234127_forum_isi', 1),
(40, '2020_08_04_234155_kelas', 1),
(41, '2020_08_04_234228_jawaban', 1),
(42, '2020_08_05_183003_mata_pelajaran', 1),
(43, '2020_08_05_184132_hasil_ujian', 1),
(44, '2020_08_05_184622_forum_rate', 1),
(45, '2020_08_05_185526_materi_download', 1);

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
-- Table structure for table `soal`
--

CREATE TABLE `soal` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_ujian` int(11) NOT NULL,
  `soal` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `file` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `a` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `b` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `c` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `d` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jawaban` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `soal`
--

INSERT INTO `soal` (`id`, `id_ujian`, `soal`, `file`, `a`, `b`, `c`, `d`, `jawaban`, `created_at`, `updated_at`) VALUES
(2, 1, '1+1=', '46354388_p0.png', '5', '1', '4', '2', 'd', '2020-08-08 15:26:27', '2020-08-08 16:07:39'),
(3, 1, '1', 'Wow Amazing dancing frog and dog.mp4', '4', '1', '3', '2', 'b', '2020-08-08 16:08:10', '2020-08-08 16:08:10'),
(4, 2, 'a', NULL, 'y', 'n', 'n', 'n', 'a', '2020-08-08 17:03:58', '2020-08-08 17:03:58'),
(5, 2, 'd', NULL, 'n', 'n', 'n', 'y', 'd', '2020-08-08 17:04:10', '2020-08-08 17:04:10'),
(6, 2, 'b', NULL, 'n', 'y', 'n', 'n', 'b', '2020-08-08 17:04:27', '2020-08-08 17:04:27'),
(7, 2, 'c', NULL, 'n', 'n', 'y', 'n', 'c', '2020-08-08 17:04:40', '2020-08-08 17:04:40'),
(8, 2, 'a', NULL, 'y', 'n', 'n', 'n', 'a', '2020-08-08 17:04:49', '2020-08-08 17:04:49');

-- --------------------------------------------------------

--
-- Table structure for table `tugas`
--

CREATE TABLE `tugas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `file` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deskripsi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_kelas` int(11) NOT NULL,
  `id_mata_pelajaran` int(11) NOT NULL,
  `aktif` tinyint(4) DEFAULT NULL,
  `owner` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tugas`
--

INSERT INTO `tugas` (`id`, `name`, `file`, `deskripsi`, `id_kelas`, `id_mata_pelajaran`, `aktif`, `owner`, `created_at`, `updated_at`) VALUES
(1, 'ewe', 'dorime.png', 'rererer', 1, 1, 1, 3, '2020-08-07 23:39:17', '2020-08-08 06:07:55');

-- --------------------------------------------------------

--
-- Table structure for table `ujian`
--

CREATE TABLE `ujian` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deskripsi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_kelas` int(11) DEFAULT NULL,
  `id_mata_pelajaran` int(11) NOT NULL,
  `aktif` tinyint(4) DEFAULT NULL,
  `publik` tinyint(4) DEFAULT NULL,
  `owner` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ujian`
--

INSERT INTO `ujian` (`id`, `name`, `deskripsi`, `id_kelas`, `id_mata_pelajaran`, `aktif`, `publik`, `owner`, `created_at`, `updated_at`) VALUES
(1, 'Uji Tese', 'ewewewew', 0, 3, 1, 1, 1, '2020-08-08 14:18:04', '2020-08-08 14:19:45'),
(2, 'Umum dong', 'qae qewqwe qwe qwe qwe asdsdasdasd', NULL, 1, 1, NULL, 1, '2020-08-08 14:32:38', '2020-08-08 14:32:38'),
(3, 'Kelas Kuvukiland aja', 'aweweweaeaweaweaew', 1, 1, 1, NULL, 1, '2020-08-08 14:32:55', '2020-08-08 14:32:55');

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
  `jenis` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `id_kelas` int(11) DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `jenis`, `id_kelas`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'admin@gmail.com', NULL, '$2y$10$5swvM2.rP5C1UUGqDgS6zuJ5YSGIjqXQKRHFpvGh0Mta.5TPD09/a', 'admin', NULL, NULL, '2020-08-05 23:24:30', '2020-08-05 23:24:30'),
(2, 'TESAAA', 'tesaaa@gmail.com', NULL, '$2y$10$f/z8Suq1RSR1M1N4NgtG4OKSTj4vMCf6BwsQLvfCKWuPeoTh2MVGC', 'guru', 4, NULL, '2020-08-06 01:51:41', '2020-08-08 05:11:29'),
(3, 'Guru', 'guru@gmail.com', NULL, '$2y$10$D6Qzy597wxFfsIeyWFOIJuyK2DlrK3UCrtSi9AZpNC6pE0azksPB2', 'guru', 1, NULL, '2020-08-07 20:58:21', '2020-08-07 20:58:21'),
(4, 'UserAAAAA', 'user@gmail.com', NULL, '$2y$10$ghw0ohsYsyQSwImSzHbn4OhWJSO3oO2dV//dJSPNROqlfAX/6J5zq', 'user', 1, NULL, '2020-08-07 23:35:02', '2020-08-08 06:10:01'),
(5, 'dia', 'tabayang@qawe', NULL, '$2y$10$a00XH3EIVYmukVFi2Fv6ZeVzPIDwZ87dWfFU.mFMSviOKzCsmB4gy', 'admin', NULL, NULL, '2020-08-08 05:16:05', '2020-08-08 05:16:05');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `forum`
--
ALTER TABLE `forum`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `forum_isi`
--
ALTER TABLE `forum_isi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `forum_rate`
--
ALTER TABLE `forum_rate`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hasil_ujian`
--
ALTER TABLE `hasil_ujian`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jawaban`
--
ALTER TABLE `jawaban`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kelas`
--
ALTER TABLE `kelas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kumpul_tugas`
--
ALTER TABLE `kumpul_tugas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mata_pelajaran`
--
ALTER TABLE `mata_pelajaran`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `materi_download`
--
ALTER TABLE `materi_download`
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
-- Indexes for table `soal`
--
ALTER TABLE `soal`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tugas`
--
ALTER TABLE `tugas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ujian`
--
ALTER TABLE `ujian`
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
-- AUTO_INCREMENT for table `forum`
--
ALTER TABLE `forum`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `forum_isi`
--
ALTER TABLE `forum_isi`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `forum_rate`
--
ALTER TABLE `forum_rate`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `hasil_ujian`
--
ALTER TABLE `hasil_ujian`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `jawaban`
--
ALTER TABLE `jawaban`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `kelas`
--
ALTER TABLE `kelas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `kumpul_tugas`
--
ALTER TABLE `kumpul_tugas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `mata_pelajaran`
--
ALTER TABLE `mata_pelajaran`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `materi_download`
--
ALTER TABLE `materi_download`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `soal`
--
ALTER TABLE `soal`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tugas`
--
ALTER TABLE `tugas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `ujian`
--
ALTER TABLE `ujian`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
