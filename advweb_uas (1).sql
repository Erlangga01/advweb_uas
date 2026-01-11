-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 11 Jan 2026 pada 23.50
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `advweb_uas`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `failed_jobs`
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
-- Struktur dari tabel `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `materials`
--

CREATE TABLE `materials` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `unit` varchar(255) NOT NULL,
  `stock` decimal(8,2) NOT NULL DEFAULT 0.00,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `materials`
--

INSERT INTO `materials` (`id`, `name`, `unit`, `stock`, `created_at`, `updated_at`) VALUES
(1, 'Triplek Meranti 18mm', 'Lembar', 56.50, '2025-12-10 07:49:24', '2026-01-11 15:47:05'),
(2, 'Speaker RCF 18 inch Low', 'Pcs', 43.00, '2025-12-10 07:49:24', '2026-01-11 15:47:05'),
(3, 'Speaker ACR 15 inch Mid', 'Pcs', 30.00, '2025-12-10 07:49:24', '2025-12-10 07:49:24'),
(4, 'Tweeter Compression Driver', 'Pcs', 40.00, '2025-12-10 07:49:24', '2025-12-10 07:49:24'),
(5, 'Kabel Audio Canare', 'Meter', 340.00, '2025-12-10 07:49:24', '2026-01-11 08:38:17'),
(6, 'Jack Spikon Biru', 'Pcs', 84.00, '2025-12-10 07:49:24', '2026-01-11 08:38:17'),
(7, 'Lem Kayu Fox', 'Kaleng', 22.70, '2025-12-10 07:49:24', '2026-01-11 15:47:05'),
(8, 'Cat Tekstur Hitam', 'Kaleng', 15.40, '2025-12-10 07:49:24', '2026-01-11 15:47:05'),
(9, 'Grill Besi Penutup', 'Lembar', 26.55, '2025-12-10 07:49:24', '2026-01-11 15:47:05'),
(10, 'Handle Besi Box', 'Pcs', 34.00, '2025-12-10 07:49:24', '2026-01-11 15:47:05');

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2025_12_10_140045_create_materials_table', 1),
(5, '2025_12_10_140045_create_products_table', 1),
(6, '2025_12_10_140046_create_product_materials_table', 1),
(7, '2025_12_10_140045_create_transactions_table', 2),
(8, '2025_12_10_140046_create_transaction_details_table', 3),
(9, '2025_12_10_141148_create_personal_access_tokens_table', 3),
(10, '2026_01_06_054741_add_name_to_transaction_details_table', 4),
(11, '2026_01_06_054949_add_satuan_to_transaction_details_table', 5),
(12, '2026_01_10_062228_add_role_to_users_table', 6);

-- --------------------------------------------------------

--
-- Struktur dari tabel `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` text NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `personal_access_tokens`
--

INSERT INTO `personal_access_tokens` (`id`, `tokenable_type`, `tokenable_id`, `name`, `token`, `abilities`, `last_used_at`, `expires_at`, `created_at`, `updated_at`) VALUES
(1, 'App\\Models\\User', 1, 'auth_token', '2f3bbcc08a44435fb8ccab076e8cdca6a959f1f869fff9ca7451583ba9b0f8ef', '[\"*\"]', '2026-01-11 08:33:24', NULL, '2026-01-11 06:32:49', '2026-01-11 08:33:24'),
(2, 'App\\Models\\User', 1, 'auth_token', '6117a8a09727ada5ada6bcf3b446b5dc9aa287abd13d19282a903ee2a5c52a91', '[\"*\"]', '2026-01-11 07:45:06', NULL, '2026-01-11 07:38:38', '2026-01-11 07:45:06'),
(3, 'App\\Models\\User', 1, 'auth_token', '4e7621779a1216f1e1af10805ad51074734e7d871568a1478d4e620510060b94', '[\"*\"]', '2026-01-11 07:52:45', NULL, '2026-01-11 07:52:44', '2026-01-11 07:52:45'),
(4, 'App\\Models\\User', 2, 'auth_token', '006718280d1731fef4def013456f4c2aa330453747d853d1f18a2269fd3d449c', '[\"*\"]', '2026-01-11 08:00:18', NULL, '2026-01-11 07:58:57', '2026-01-11 08:00:18'),
(5, 'App\\Models\\User', 2, 'auth_token', 'f2436f54fffec599caec39dc03d3574217bce9abe6ff36a2cffc7c80c2ccfb29', '[\"*\"]', '2026-01-11 08:02:42', NULL, '2026-01-11 08:01:18', '2026-01-11 08:02:42'),
(6, 'App\\Models\\User', 2, 'auth_token', '6605ecf32e7fba373a04178ef0311d9cf226c20aae40d0806971b7fd9a50be00', '[\"*\"]', '2026-01-11 08:12:44', NULL, '2026-01-11 08:12:43', '2026-01-11 08:12:44'),
(7, 'App\\Models\\User', 2, 'auth_token', 'b029275c92bf986e19eff6f16b01d422fb675c416f3ee18198a01694ee7ce6db', '[\"*\"]', '2026-01-11 08:18:05', NULL, '2026-01-11 08:15:45', '2026-01-11 08:18:05'),
(8, 'App\\Models\\User', 2, 'auth_token', '8b559d1cb839c4dc7c338659ee610e6cfa88f6c1dbfae0e0773d6ab806c8f731', '[\"*\"]', '2026-01-11 08:35:05', NULL, '2026-01-11 08:20:06', '2026-01-11 08:35:05'),
(9, 'App\\Models\\User', 2, 'auth_token', '69d89317e16303fb280f85d0cc8670e0db04a476c53895c0a65e5efd832293c9', '[\"*\"]', '2026-01-11 08:39:03', NULL, '2026-01-11 08:36:51', '2026-01-11 08:39:03'),
(10, 'App\\Models\\User', 2, 'auth_token', '96e77cdb0806db8bdb9eaa539430ab8e6de9fee7188c06b9a6ce1e5dacd7bb00', '[\"*\"]', '2026-01-11 08:40:37', NULL, '2026-01-11 08:39:59', '2026-01-11 08:40:37'),
(11, 'App\\Models\\User', 2, 'auth_token', '4ea4283ecbf38fff7a75f6388b844c0d38161383306afc0b1fd26c99b72633c7', '[\"*\"]', '2026-01-11 08:53:48', NULL, '2026-01-11 08:53:47', '2026-01-11 08:53:48'),
(12, 'App\\Models\\User', 2, 'auth_token', 'a2c0b93066ff0f0a4c02308cca29747cf33a39bed3ccd20216019b5429ba0f65', '[\"*\"]', '2026-01-11 08:57:20', NULL, '2026-01-11 08:56:00', '2026-01-11 08:57:20'),
(13, 'App\\Models\\User', 2, 'auth_token', 'dfa87dca90870d035884d06eb7e61c8ac4bfc225393a4269fd7a7b11827511ab', '[\"*\"]', '2026-01-11 09:14:28', NULL, '2026-01-11 09:13:53', '2026-01-11 09:14:28'),
(14, 'App\\Models\\User', 2, 'auth_token', '4fc7d25cda23f2db9c9b8c0676c9dbb3926c5310aa2407e51fcc2718810d10ff', '[\"*\"]', '2026-01-11 09:22:40', NULL, '2026-01-11 09:21:45', '2026-01-11 09:22:40'),
(15, 'App\\Models\\User', 2, 'auth_token', '6bc493a68bfbf175d9fde7408d28ef7fc4be6d7b44d4afbb346868815ae07664', '[\"*\"]', NULL, NULL, '2026-01-11 09:57:44', '2026-01-11 09:57:44'),
(16, 'App\\Models\\User', 2, 'auth_token', 'acd5175a5ea82628911c9cdc78e13f950eefc345f249adce8af67450281b844e', '[\"*\"]', '2026-01-11 10:30:08', NULL, '2026-01-11 10:29:49', '2026-01-11 10:30:08'),
(17, 'App\\Models\\User', 2, 'auth_token', '7b147e7e678d8e3aa5be20227ebd1ec7af6d04161447bb7ad137974532013987', '[\"*\"]', '2026-01-11 10:40:13', NULL, '2026-01-11 10:40:12', '2026-01-11 10:40:13'),
(18, 'App\\Models\\User', 2, 'auth_token', 'ba33b7c55ac05436dccfc896e7891a4e600a56e68ea952cd5f1f3ed74f29093a', '[\"*\"]', '2026-01-11 15:02:11', NULL, '2026-01-11 14:53:21', '2026-01-11 15:02:11'),
(19, 'App\\Models\\User', 2, 'auth_token', '9c06e29bb094fba61b8ca794ae263f2c4b44c583df4a3148d414be45856d22ef', '[\"*\"]', '2026-01-11 15:05:32', NULL, '2026-01-11 15:05:31', '2026-01-11 15:05:32'),
(20, 'App\\Models\\User', 2, 'auth_token', '8d5e9d25986c3fd24d0dd9801e352d50a42d2a4a7f0e1448401d755c2b617760', '[\"*\"]', '2026-01-11 15:44:12', NULL, '2026-01-11 15:43:22', '2026-01-11 15:44:12'),
(21, 'App\\Models\\User', 2, 'auth_token', 'b9b97687d2e19ab13f179afc41f495e5204f7166de6ee41560edc3424e63b517', '[\"*\"]', '2026-01-11 15:47:19', NULL, '2026-01-11 15:46:25', '2026-01-11 15:47:19');

-- --------------------------------------------------------

--
-- Struktur dari tabel `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` decimal(15,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `products`
--

INSERT INTO `products` (`id`, `name`, `price`, `created_at`, `updated_at`) VALUES
(1, 'Box Subwoofer 18\" Lapangan (Finished)', 3500000.00, '2025-12-10 07:49:24', '2025-12-10 07:49:24'),
(2, 'Speaker 15\" Aktif Rakitan', 4500000.00, '2025-12-10 07:49:24', '2025-12-10 07:49:24'),
(3, 'Kabel Speaker Set 20 Meter', 450000.00, '2025-12-10 07:49:24', '2025-12-10 07:49:24');

-- --------------------------------------------------------

--
-- Struktur dari tabel `product_materials`
--

CREATE TABLE `product_materials` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `material_id` bigint(20) UNSIGNED NOT NULL,
  `quantity_needed` decimal(8,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `product_materials`
--

INSERT INTO `product_materials` (`id`, `product_id`, `material_id`, `quantity_needed`, `created_at`, `updated_at`) VALUES
(1, 1, 2, 1.00, NULL, NULL),
(2, 1, 1, 0.50, NULL, NULL),
(3, 1, 8, 0.20, NULL, NULL),
(4, 1, 7, 0.10, NULL, NULL),
(5, 1, 9, 0.15, NULL, NULL),
(6, 1, 10, 2.00, NULL, NULL),
(7, 3, 5, 20.00, NULL, NULL),
(8, 3, 6, 2.00, NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('6G11DxxdxV8dTMr2rkHCjEh8KyeLKmrBcHVbEx91', NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiYnNjaWM1a1NDU3M4QU80TnRlRFVIbGJzc1VQYjlqSWgxVlZSbnJhUCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzM6Imh0dHA6Ly9sb2NhbGhvc3QvYWR2d2ViX3Vhcy9zYWxlcyI7czo1OiJyb3V0ZSI7czoxMToic2FsZXMuaW5kZXgiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1768170787),
('6Li6uOi4FQ5RHBgCugxkLJF5YbfDf4Evrt3uDzE3', NULL, '192.168.2.100', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiM1J0b1FsM3VHcTQ4RE84Smh6Ym1KUTFpd1NIRWFWSXhkMmIwd2JyYiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mzc6Imh0dHA6Ly8xOTIuMTY4LjIuMTAwL2FkdndlYl91YXMvc2FsZXMiO3M6NToicm91dGUiO3M6MTE6InNhbGVzLmluZGV4Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1768149701),
('bDtkvyTdBvjk2oDk66dPbwoyB0q86n9YYTute7Hw', NULL, '192.168.2.101', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Mobile Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiMHhJbmJ3U2JHeXlONURETFU1Q281Wm5FTmJNRkFKREZiTEZrZFNEUSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzE6Imh0dHA6Ly8xOTIuMTY4LjIuMTAwL2FkdndlYl91YXMiO3M6NToicm91dGUiO3M6NDoiaG9tZSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1768150163),
('IZXqTEkO1ISSHiYG1WPfngw2hvVkMzjqJT1CEQvb', NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiTVMzYkpZa1JHSXM4Z2oybjVyZlROcDNIdUt3SVBhN1V6a0IyRDcwMSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly9sb2NhbGhvc3QvYWR2d2ViX3VhcyI7czo1OiJyb3V0ZSI7Tjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1768171482),
('l0pKRTV1v1XEZFSsTau8QEPkmBCQgUoOXcur98Gb', NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoidUljWTI0V3NsU0s3cnN5NUd2Ym4zaHJ1ZWN1TFRlWUw0NTBCUjBXWiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly9sb2NhbGhvc3QvYWR2d2ViX3VhcyI7czo1OiJyb3V0ZSI7czo0OiJob21lIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1768150142),
('Mf38cj3VqzVr3dZkiQatwSJPO3MeyerqjO2GmD4m', NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiU245dzkzWXh5YmU2YTNjQnpUV2hMazhvNXA4aDF2alFwUVBJUVFaVSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly9sb2NhbGhvc3QvYWR2d2ViX3VhcyI7czo1OiJyb3V0ZSI7Tjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1768171646),
('MN7rTPRhpyL2SndDGxdz9VLMgX5Bicq0qGzK5YWr', NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiWGZCRE9haEpQRGtKalBuc2xtRGRjODk0Sm54eERnOHphQ3NBc0lZOCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzM6Imh0dHA6Ly9sb2NhbGhvc3QvYWR2d2ViX3Vhcy9zYWxlcyI7czo1OiJyb3V0ZSI7czoxMToic2FsZXMuaW5kZXgiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1768147991);

-- --------------------------------------------------------

--
-- Struktur dari tabel `transactions`
--

CREATE TABLE `transactions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `customer_name` varchar(255) NOT NULL,
  `transaction_date` date NOT NULL,
  `total_amount` decimal(15,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `transactions`
--

INSERT INTO `transactions` (`id`, `customer_name`, `transaction_date`, `total_amount`, `created_at`, `updated_at`) VALUES
(16, 'erlangga', '2025-12-15', 450000.00, '2025-12-14 19:52:53', '2025-12-14 19:52:53'),
(18, 'dayat', '2025-12-20', 8900000.00, '2025-12-20 06:03:07', '2025-12-20 06:03:08'),
(19, 'erlangga', '2025-12-22', 450000.00, '2025-12-21 18:25:25', '2025-12-21 18:25:26'),
(20, 'erlangga', '2026-01-06', 9450000.00, '2026-01-05 22:43:56', '2026-01-05 22:43:56'),
(21, 'Postman Customer', '2026-01-11', 150000.00, '2026-01-11 07:06:43', '2026-01-11 07:06:43'),
(22, 'Postman Customer', '2026-01-11', 150000.00, '2026-01-11 07:06:44', '2026-01-11 07:06:44'),
(23, 'Postman Customer', '2026-01-11', 3700000.00, '2026-01-11 07:15:23', '2026-01-11 07:15:23'),
(24, 'John', '2026-01-11', 3500000.00, '2026-01-11 07:40:19', '2026-01-11 07:40:19'),
(25, 'Subaru', '2026-01-11', 4441250.00, '2026-01-11 08:00:17', '2026-01-11 08:00:17'),
(26, 'Subaru', '2026-01-11', 4801500.00, '2026-01-11 08:02:41', '2026-01-11 08:02:41'),
(27, 'budi', '2026-01-11', 592900.00, '2026-01-11 08:16:32', '2026-01-11 08:16:32'),
(28, 'slamet', '2026-01-11', 6050000.00, '2026-01-11 08:21:18', '2026-01-11 08:21:18'),
(29, 'teguh', '2026-01-11', 2227500.00, '2026-01-11 08:38:17', '2026-01-11 08:38:17'),
(30, 'rec', '2026-01-11', 9625000.00, '2026-01-11 08:40:37', '2026-01-11 08:40:37'),
(31, 'mood', '2026-01-11', 3250000.00, '2026-01-11 09:11:11', '2026-01-11 09:11:11'),
(32, 'mud', '2026-01-11', 9555000.00, '2026-01-11 09:12:55', '2026-01-11 09:12:55'),
(33, 'tarno', '2026-01-11', 490000.00, '2026-01-11 09:22:22', '2026-01-11 09:22:22'),
(34, 'truk', '2026-01-11', 475000.00, '2026-01-11 15:47:05', '2026-01-11 15:47:05');

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaction_details`
--

CREATE TABLE `transaction_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `transaction_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `quantity` int(11) NOT NULL,
  `satuan` varchar(255) DEFAULT NULL,
  `price` decimal(15,2) NOT NULL,
  `subtotal` decimal(15,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `transaction_details`
--

INSERT INTO `transaction_details` (`id`, `transaction_id`, `product_id`, `name`, `quantity`, `satuan`, `price`, `subtotal`, `created_at`, `updated_at`) VALUES
(18, 16, 3, NULL, 1, NULL, 450000.00, 450000.00, '2025-12-14 19:52:53', '2025-12-14 19:52:53'),
(22, 18, 1, NULL, 1, NULL, 3500000.00, 3500000.00, '2025-12-20 06:03:07', '2025-12-20 06:03:07'),
(23, 18, 2, NULL, 1, NULL, 4500000.00, 4500000.00, '2025-12-20 06:03:08', '2025-12-20 06:03:08'),
(24, 18, 3, NULL, 2, NULL, 450000.00, 900000.00, '2025-12-20 06:03:08', '2025-12-20 06:03:08'),
(25, 19, 3, NULL, 1, NULL, 450000.00, 450000.00, '2025-12-21 18:25:25', '2025-12-21 18:25:25'),
(26, 20, 2, NULL, 2, NULL, 4500000.00, 9000000.00, '2026-01-05 22:43:56', '2026-01-05 22:43:56'),
(27, 20, 3, NULL, 1, NULL, 450000.00, 450000.00, '2026-01-05 22:43:56', '2026-01-05 22:43:56'),
(28, 21, 1, 'Dummy Product 1', 1, 'unit', 50000.00, 50000.00, '2026-01-11 07:06:43', '2026-01-11 07:06:43'),
(29, 21, 2, 'Dummy Product 2', 2, 'unit', 50000.00, 100000.00, '2026-01-11 07:06:43', '2026-01-11 07:06:43'),
(30, 22, 1, 'Dummy Product 1', 1, 'unit', 50000.00, 50000.00, '2026-01-11 07:06:44', '2026-01-11 07:06:44'),
(31, 22, 2, 'Dummy Product 2', 2, 'unit', 50000.00, 100000.00, '2026-01-11 07:06:44', '2026-01-11 07:06:44'),
(32, 23, 2, 'Speaker 21 inch', 5, 'unit', 500000.00, 2500000.00, '2026-01-11 07:15:23', '2026-01-11 07:15:23'),
(33, 23, 1, 'Line array JBL 212', 2, 'unit', 60000.00, 1200000.00, '2026-01-11 07:15:23', '2026-01-11 07:15:23'),
(34, 24, 1, 'Box Subwoofer 18\" Lapangan (Finished)', 1, 'Pcsx', 3500000.00, 3500000.00, '2026-01-11 07:40:19', '2026-01-11 07:40:19'),
(35, 25, 2, 'Speaker 15\" Aktif Rakitan Manual Dengan Hati', 1, 'Pcs', 4250000.00, 4037500.00, '2026-01-11 08:00:17', '2026-01-11 08:00:17'),
(36, 26, 2, 'Speaker 12\" Aktif Rakitan XXX', 1, 'Pcs', 4500000.00, 4365000.00, '2026-01-11 08:02:41', '2026-01-11 08:02:41'),
(37, 27, 3, 'Kabel Speaker Set 20 Meter SPL', 1, 'Pcs', 550000.00, 539000.00, '2026-01-11 08:16:32', '2026-01-11 08:16:32'),
(38, 28, 1, 'Box Subwoofer 21\" Lapangan (Finished)', 1, 'Pcs', 4500000.00, 2250000.00, '2026-01-11 08:21:18', '2026-01-11 08:21:18'),
(39, 28, 2, 'Speaker 12\" Aktif Rakitan INDOOR', 1, 'unit', 6500000.00, 3250000.00, '2026-01-11 08:21:18', '2026-01-11 08:21:18'),
(40, 29, 1, 'Box Subwoofer 32\" PLANAR', 1, 'unit', 3500000.00, 1750000.00, '2026-01-11 08:38:17', '2026-01-11 08:38:17'),
(41, 29, 3, 'Kabel Speaker 20 Meter', 1, 'Pcs', 550000.00, 275000.00, '2026-01-11 08:38:17', '2026-01-11 08:38:17'),
(42, 30, 1, 'Box Subwoofer 50\"', 1, 'Pcs', 35000000.00, 8750000.00, '2026-01-11 08:40:37', '2026-01-11 08:40:37'),
(43, 31, 1, 'Box Subwoofer 24', 1, 'unit', 6500000.00, 3250000.00, '2026-01-11 09:11:11', '2026-01-11 09:11:11'),
(44, 32, 1, 'Box Subwoofer 18', 1, 'unit', 9750000.00, 9555000.00, '2026-01-11 09:12:55', '2026-01-11 09:12:55'),
(45, 33, 1, 'Box Subwoofer 8\" miniatur', 1, 'Pcs', 500000.00, 490000.00, '2026-01-11 09:22:22', '2026-01-11 09:22:22'),
(46, 34, 1, 'Box Subwoofer 100', 1, 'unit', 500000.00, 475000.00, '2026-01-11 15:47:05', '2026-01-11 15:47:05');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `role` varchar(255) NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `role`) VALUES
(1, 'John Admin', 'admin@admin.com', NULL, '$2y$12$9tIPsefPUKFDdrap65qoNeSIsDofl2l0SIRMl3t8HbE6iE1gM4wh.', NULL, '2026-01-11 06:20:58', '2026-01-11 06:20:58', 'admin'),
(2, 'Bosh Admin', 'a@a.co', NULL, '$2y$12$i7hvpJwjcRYiVnij9L3RJeVk2oGi4sS7z9txlYHJYFxF3ZIzp24AK', NULL, '2026-01-11 07:58:24', '2026-01-11 07:58:24', 'admin');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indeks untuk tabel `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indeks untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indeks untuk tabel `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indeks untuk tabel `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `materials`
--
ALTER TABLE `materials`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indeks untuk tabel `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`),
  ADD KEY `personal_access_tokens_expires_at_index` (`expires_at`);

--
-- Indeks untuk tabel `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `product_materials`
--
ALTER TABLE `product_materials`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_materials_product_id_foreign` (`product_id`),
  ADD KEY `product_materials_material_id_foreign` (`material_id`);

--
-- Indeks untuk tabel `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indeks untuk tabel `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `transaction_details`
--
ALTER TABLE `transaction_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `transaction_details_transaction_id_foreign` (`transaction_id`),
  ADD KEY `transaction_details_product_id_foreign` (`product_id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `materials`
--
ALTER TABLE `materials`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT untuk tabel `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT untuk tabel `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `product_materials`
--
ALTER TABLE `product_materials`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT untuk tabel `transaction_details`
--
ALTER TABLE `transaction_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `product_materials`
--
ALTER TABLE `product_materials`
  ADD CONSTRAINT `product_materials_material_id_foreign` FOREIGN KEY (`material_id`) REFERENCES `materials` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `product_materials_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `transaction_details`
--
ALTER TABLE `transaction_details`
  ADD CONSTRAINT `transaction_details_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`),
  ADD CONSTRAINT `transaction_details_transaction_id_foreign` FOREIGN KEY (`transaction_id`) REFERENCES `transactions` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
