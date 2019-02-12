-- phpMyAdmin SQL Dump
-- version 4.8.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 13 Feb 2019 pada 00.34
-- Versi server: 10.1.31-MariaDB
-- Versi PHP: 7.1.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `toko_buah`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_admin`
--

CREATE TABLE `tbl_admin` (
  `id_admin` int(11) NOT NULL,
  `nama_lengkap` varchar(50) DEFAULT NULL,
  `email` varchar(50) NOT NULL DEFAULT '',
  `password` varchar(150) NOT NULL DEFAULT '',
  `tempat_lahir` varchar(50) DEFAULT NULL,
  `tanggal_lahir` date DEFAULT NULL,
  `jenis_kelamin` varchar(255) DEFAULT NULL,
  `alamat` text,
  `is_superadmin` varchar(1) DEFAULT 'N',
  `api_token` varchar(150) DEFAULT NULL,
  `remember_token` varchar(150) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_admin`
--

INSERT INTO `tbl_admin` (`id_admin`, `nama_lengkap`, `email`, `password`, `tempat_lahir`, `tanggal_lahir`, `jenis_kelamin`, `alamat`, `is_superadmin`, `api_token`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Administrator', 'inienam06@gmail.com', 'QqOaEarFI97sQL2kkDR9dQ==:YWJkdWxyb2htYW4wMDAwMA==', 'Tangerang', '1999-11-18', 'Laki-Laki', 'Curug, Kab. Tangerang', 'Y', 'NHJJUGszSjFpWlNBSmRuVDg0SWNDczFuT2VqOGtrNjR5aUlqNllRUkNqblE5YVBYbW4=', '98jZQdx8S20OQabHOCv5WHrpoasOnMNXoGC0DUJPilQRkZa8AlGrs4LtaWhw', '2018-11-09 10:05:42', '2018-12-23 06:48:08');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_kategori`
--

CREATE TABLE `tbl_kategori` (
  `id_kategori` int(11) NOT NULL,
  `nama_kategori` varchar(30) DEFAULT NULL,
  `slug` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` varchar(50) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_kategori`
--

INSERT INTO `tbl_kategori` (`id_kategori`, `nama_kategori`, `slug`, `created_at`, `created_by`, `updated_at`, `updated_by`) VALUES
(1, 'Apel', 'apel', '2018-11-13 10:01:48', 'Administrator', '2018-11-24 21:52:43', 'Administrator'),
(2, 'Durian', 'durian', '2018-11-13 10:03:48', 'Administrator', '2018-11-24 21:52:43', NULL),
(3, 'Mangga', 'mangga', '2018-11-17 07:48:24', 'Administrator', '2018-11-24 21:52:43', NULL),
(6, 'Rambutan', 'rambutan', '2018-11-27 09:09:24', 'Administrator', '2018-11-27 09:09:43', 'Administrator'),
(8, 'Pisang', 'pisang', '2018-12-13 19:14:04', 'Administrator', '2018-12-13 19:14:04', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_produk`
--

CREATE TABLE `tbl_produk` (
  `id_produk` int(11) NOT NULL,
  `id_kategori` int(11) NOT NULL DEFAULT '0',
  `nama_produk` varchar(50) DEFAULT NULL,
  `deskripsi` text,
  `harga` bigint(20) DEFAULT NULL,
  `foto_produk` varchar(100) DEFAULT NULL,
  `url_foto` varchar(100) DEFAULT NULL,
  `slug` varchar(100) DEFAULT NULL,
  `dilihat` int(5) DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` varchar(50) DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_produk`
--

INSERT INTO `tbl_produk` (`id_produk`, `id_kategori`, `nama_produk`, `deskripsi`, `harga`, `foto_produk`, `url_foto`, `slug`, `dilihat`, `created_at`, `created_by`, `updated_at`, `updated_by`) VALUES
(17, 2, 'Contoh 1', '<p>sdasda</p>', 12000, 'contoh_20181122154338.jpg', 'assets/images/buah/', 'contoh-1', 90, '2018-11-22 08:34:02', 'Administrator', '2019-02-11 08:26:25', 'Administrator'),
(18, 1, 'Apel Manis', '<p>apel manis</p>', 10000, NULL, NULL, 'apel-manis', 203, '2018-11-24 10:29:09', 'Administrator', '2019-01-03 05:40:50', NULL),
(20, 1, 'Apel Rasa Jeruk', '<p>Apel Aneh</p>', 16000, 'apel_1543342302.png', 'assets/images/buah/', 'apel-rasa-jeruk', 38, '2018-11-27 10:55:50', 'Administrator', '2018-12-29 08:25:38', 'Administrator'),
(21, 2, 'asdasd sad', '<p>sadasd asad</p>', 14000, 'asdasd_1543902902.jpg', 'assets/images/buah/', 'asdasd-sad', 1, '2018-12-03 22:55:02', 'Administrator', '2018-12-03 22:55:11', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_user`
--

CREATE TABLE `tbl_user` (
  `id_user` int(11) NOT NULL,
  `nama_lengkap` varchar(50) DEFAULT NULL,
  `email` varchar(50) NOT NULL DEFAULT '',
  `password` varchar(150) NOT NULL DEFAULT '',
  `no_handphone` bigint(15) DEFAULT NULL,
  `tempat_lahir` varchar(50) DEFAULT NULL,
  `tanggal_lahir` date DEFAULT NULL,
  `jenis_kelamin` varchar(255) DEFAULT NULL,
  `alamat` text,
  `lat` double(11,10) DEFAULT NULL,
  `lng` double(11,10) DEFAULT NULL,
  `api_token` varchar(150) DEFAULT NULL,
  `token_firebase` varchar(255) DEFAULT NULL,
  `token_verify` int(5) DEFAULT NULL,
  `verified` bit(1) NOT NULL DEFAULT b'0',
  `remember_token` varchar(150) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `t_pesanan`
--

CREATE TABLE `t_pesanan` (
  `id_pesanan` int(11) NOT NULL,
  `id_user` int(11) NOT NULL DEFAULT '0',
  `id_produk` int(11) NOT NULL DEFAULT '0',
  `kilo` int(5) DEFAULT NULL,
  `total_harga` bigint(20) UNSIGNED DEFAULT NULL,
  `invoice` varchar(15) DEFAULT NULL,
  `status` int(1) DEFAULT '0',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` varchar(100) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `tbl_admin`
--
ALTER TABLE `tbl_admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indeks untuk tabel `tbl_kategori`
--
ALTER TABLE `tbl_kategori`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indeks untuk tabel `tbl_produk`
--
ALTER TABLE `tbl_produk`
  ADD PRIMARY KEY (`id_produk`),
  ADD KEY `fk_kategori` (`id_kategori`);

--
-- Indeks untuk tabel `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`id_user`);

--
-- Indeks untuk tabel `t_pesanan`
--
ALTER TABLE `t_pesanan`
  ADD PRIMARY KEY (`id_pesanan`),
  ADD KEY `fk_id_user` (`id_user`),
  ADD KEY `fk_id_produk` (`id_produk`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `tbl_admin`
--
ALTER TABLE `tbl_admin`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `tbl_kategori`
--
ALTER TABLE `tbl_kategori`
  MODIFY `id_kategori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `tbl_produk`
--
ALTER TABLE `tbl_produk`
  MODIFY `id_produk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT untuk tabel `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `t_pesanan`
--
ALTER TABLE `t_pesanan`
  MODIFY `id_pesanan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `tbl_produk`
--
ALTER TABLE `tbl_produk`
  ADD CONSTRAINT `fk_kategori` FOREIGN KEY (`id_kategori`) REFERENCES `tbl_kategori` (`id_kategori`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `t_pesanan`
--
ALTER TABLE `t_pesanan`
  ADD CONSTRAINT `fk_id_produk` FOREIGN KEY (`id_produk`) REFERENCES `tbl_produk` (`id_produk`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_id_user` FOREIGN KEY (`id_user`) REFERENCES `tbl_user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
