-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Waktu pembuatan: 08 Jul 2024 pada 14.25
-- Versi server: 8.0.30
-- Versi PHP: 7.4.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sprint_new`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `permohonan`
--

CREATE TABLE `permohonan` (
  `id` bigint UNSIGNED NOT NULL,
  `id_perusahaan` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `surat_permohonan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `formulir_pendaftaran` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `no_surat_permohonan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tgl_surat_permohonan` date NOT NULL,
  `no_order` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `no_proses` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `menu` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tujuan_audit` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `proses_lain` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_sertifikat_referensi` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `masa_berlaku` date NOT NULL,
  `masa_berlaku_akhir` date NOT NULL,
  `id_standar` varchar(2) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status_komoditi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `illustrasi_penandaan_standar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status_penerapan_smm` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `akreditasi_lssm` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `keterangan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tanggal_terima` date DEFAULT NULL,
  `tanggal_input` date DEFAULT NULL,
  `tanggal_order` date DEFAULT NULL,
  `sts_permohonan` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `permohonan`
--

INSERT INTO `permohonan` (`id`, `id_perusahaan`, `surat_permohonan`, `formulir_pendaftaran`, `no_surat_permohonan`, `tgl_surat_permohonan`, `no_order`, `no_proses`, `menu`, `tujuan_audit`, `proses_lain`, `no_sertifikat_referensi`, `masa_berlaku`, `masa_berlaku_akhir`, `id_standar`, `status_komoditi`, `illustrasi_penandaan_standar`, `status_penerapan_smm`, `akreditasi_lssm`, `keterangan`, `tanggal_terima`, `tanggal_input`, `tanggal_order`, `sts_permohonan`, `created_at`, `updated_at`) VALUES
(4, '2512.A.1', NULL, NULL, '213', '2024-07-08', NULL, NULL, 'SMM', '3', '1', '25', '2024-01-01', '2025-02-10', '1', 'Wajib Kemenperin', NULL, 'asdasddas', 'aqsd', NULL, NULL, NULL, NULL, 'Pengajuan', '2024-07-08 06:50:03', '2024-07-08 06:50:03');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `permohonan`
--
ALTER TABLE `permohonan`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `permohonan`
--
ALTER TABLE `permohonan`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
