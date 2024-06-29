-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 23 Bulan Mei 2024 pada 14.27
-- Versi server: 10.4.25-MariaDB
-- Versi PHP: 7.4.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bkn-web`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `failed_jobs`
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
-- Struktur dari tabel `menu`
--

CREATE TABLE `menu` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_menu` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `icon` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `select_menu` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `parent_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `menu`
--

INSERT INTO `menu` (`id`, `nama_menu`, `icon`, `url`, `select_menu`, `parent_id`, `created_at`, `updated_at`) VALUES
(1, 'Dashboard', 'fas fa-home', '/dashboard', 'menu', NULL, '2024-05-23 02:12:00', '2024-05-23 02:12:00'),
(2, 'SDM', 'fas fa-users', '#', 'menu', 1, '2024-05-23 02:15:52', '2024-05-23 04:26:11'),
(3, 'Pengawas', NULL, '/sdm/pengawas', 'sub_menu', 2, '2024-05-23 02:52:28', '2024-05-23 02:52:28'),
(4, 'Koordinator / Pic', NULL, '/sdm/leader', 'sub_menu', 2, '2024-05-23 03:15:54', '2024-05-23 03:15:54'),
(5, 'Teknisi', NULL, '/sdm/teknisi', 'sub_menu', 2, '2024-05-23 04:28:44', '2024-05-23 04:28:44'),
(6, 'Pengaturan SDM', 'fas fa-user-plus', '#', 'menu', 1, '2024-05-23 04:53:03', '2024-05-23 04:53:03'),
(7, 'Setup SDM Pengawas', NULL, '/setup_sdm/pengawas', 'sub_menu', 6, '2024-05-23 04:53:32', '2024-05-23 04:53:32'),
(8, 'Setup SDM Koordinator', NULL, '/setup_sdm/list_setup_sdm', 'sub_menu', 6, '2024-05-23 04:54:04', '2024-05-23 04:55:59'),
(9, 'Pelaporan Kegiatan', 'far fa-edit', '#', 'menu', 1, '2024-05-23 04:54:54', '2024-05-23 04:54:54'),
(10, 'Penerimaan Barang', NULL, '/lapor_kegiatan/penerimaan_barang', 'sub_menu', 9, '2024-05-23 04:55:21', '2024-05-23 04:55:21'),
(11, 'Installasi Barang', NULL, '/lapor_kegiatan/installasi_barang', 'sub_menu', 9, '2024-05-23 04:55:47', '2024-05-23 04:58:07'),
(12, 'Uji Fungsi', NULL, '/lapor_kegiatan/uji_fungsi', 'sub_menu', 9, '2024-05-23 04:56:37', '2024-05-23 04:58:00'),
(13, 'Pelaksanaan Harian', NULL, '/laporan_kegiatan/pelaksanaan_harian', 'sub_menu', 9, '2024-05-23 04:57:07', '2024-05-23 04:57:53'),
(14, 'Penutupan (Serah Terima Barang)', NULL, '/lapor_kegiatan/penutupan', 'sub_menu', 9, '2024-05-23 04:57:45', '2024-05-23 04:57:45'),
(15, 'Absensi Harian', NULL, '/lapor_kegiatan/absensi', 'sub_menu', 9, '2024-05-23 04:58:55', '2024-05-23 04:58:55'),
(16, 'Berita', 'far fa-newspaper', '#', 'menu', 1, '2024-05-23 04:59:51', '2024-05-23 04:59:51'),
(17, 'Daftar Kegiatan Berita', NULL, '/berita/daftar_berita_kegiatan', 'sub_menu', 16, '2024-05-23 05:00:40', '2024-05-23 05:00:40'),
(18, 'Tambah Berita Kegiatan', NULL, '/berita/daftar_berita_kegiatan/create', 'sub_menu', 16, '2024-05-23 05:01:13', '2024-05-23 05:01:13'),
(19, 'Laporan', 'fas fa-paste', '#', 'menu', NULL, '2024-05-23 05:03:34', '2024-05-23 05:03:34'),
(20, 'Map Lokasi Kegiatan', NULL, '/laporan/map_report_lokasi', 'sub_menu', 19, '2024-05-23 05:04:22', '2024-05-23 05:04:22'),
(21, 'SDM Pelaksana Pekerjaan', NULL, '/laporan/report_sdm_pelaksana', 'sub_menu', 19, '2024-05-23 05:04:59', '2024-05-23 05:04:59'),
(22, 'Kesiapan Lokasi', NULL, '/laporan/kesiapan_lokasi', 'sub_menu', 19, '2024-05-23 05:05:19', '2024-05-23 05:05:19'),
(23, 'Master Data', 'fas fa-database', '#', 'menu', NULL, '2024-05-23 05:05:50', '2024-05-23 05:05:50'),
(24, 'Data Barang', NULL, '/master_data/list_barang', 'sub_menu', 23, '2024-05-23 05:06:12', '2024-05-23 05:06:12'),
(25, 'Data Satuan Barang', NULL, '/master_data/data_satuan_barang', 'sub_menu', 23, '2024-05-23 05:07:07', '2024-05-23 05:07:07'),
(26, 'Data Kategori Barang', NULL, '/master_data/list_kategori_barang', 'sub_menu', 23, '2024-05-23 05:07:32', '2024-05-23 05:07:32'),
(27, 'Administrator', 'fas fa-key', '#', 'menu', NULL, '2024-05-23 05:08:48', '2024-05-23 05:08:48'),
(28, 'User', NULL, '/administrator/user', 'sub_menu', 27, '2024-05-23 05:09:07', '2024-05-23 05:09:07'),
(29, 'Hak Akses', NULL, '/administrator/access_permission', 'sub_menu', 27, '2024-05-23 05:09:35', '2024-05-23 05:09:35'),
(30, 'Audit Trail', NULL, '/administrator/audit_trail', 'sub_menu', 27, '2024-05-23 05:09:59', '2024-05-23 05:09:59'),
(31, 'Module Menu', NULL, '/administrator/module_menu', 'sub_menu', 27, '2024-05-23 05:10:31', '2024-05-23 05:10:31'),
(32, 'Pengaturan', 'fas fa-wrench', '#', 'menu', NULL, '2024-05-23 05:11:40', '2024-05-23 05:11:40'),
(33, 'Daftar Kegiatan', NULL, '/setup_kegiatan/daftar_kegiatan', 'sub_menu', 32, '2024-05-23 05:12:21', '2024-05-23 05:12:21'),
(34, 'Lokasi', NULL, '/setup_lokasi/daftar_lokasi', 'sub_menu', 32, '2024-05-23 05:12:53', '2024-05-23 05:12:53'),
(35, 'Informasi Aplikasi', NULL, '/pengaturan/informasi_aplikasi', 'sub_menu', 32, '2024-05-23 05:13:37', '2024-05-23 05:13:37'),
(36, 'Tema', 'fas fa-desktop', '#', 'menu', NULL, '2024-05-23 05:14:44', '2024-05-23 05:14:44'),
(37, 'Pengaturan Tema', NULL, '/tema/pengaturan_tema', 'sub_menu', 36, '2024-05-23 05:15:06', '2024-05-23 05:15:06'),
(38, 'Distribusi Tema', NULL, '/tema/distribusi_tema', 'sub_menu', 36, '2024-05-23 05:15:31', '2024-05-23 05:15:31');

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2024_05_23_070717_create_menu', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `personal_access_tokens`
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
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(2, 'Admin', 'admin', 'admin@bkn.com', NULL, '$2y$10$3APPr1b5i/hgTJl1ZCwQpu5PtWOCTBiVeQy72BviQW0v9nOyweMei', NULL, '2024-05-23 05:26:42', '2024-05-23 05:26:42');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indeks untuk tabel `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indeks untuk tabel `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

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
-- AUTO_INCREMENT untuk tabel `menu`
--
ALTER TABLE `menu`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
