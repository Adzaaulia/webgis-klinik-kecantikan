-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 16 Jul 2024 pada 04.12
-- Versi server: 10.4.24-MariaDB
-- Versi PHP: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_sig`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `markers`
--

CREATE TABLE `markers` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `latitude` decimal(10,8) NOT NULL,
  `longitude` decimal(11,8) NOT NULL,
  `description` text NOT NULL,
  `image` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `markers`
--

INSERT INTO `markers` (`id`, `name`, `latitude`, `longitude`, `description`, `image`) VALUES
(14, 'Benings Clinic Kendari', '-3.99229180', '122.51362110', 'Klinik Kecantikan', '2022-11-02.jpg'),
(16, 'ALLENNA SKIN CLINIC KENDARI', '-4.01377330', '122.53540760', 'Klinik Kecantikan', '53CB8B73-2A6F-4BA3-B8B1-307B866FFD10.jpeg'),
(17, 'Natasha', '-3.98985040', '122.51509670', 'Klinik Kecantikan', '2023-03-24.jpg'),
(18, 'Erha Skin Kendari', '-3.99297250', '122.51236790', 'Klinik Kecantikan', '2020-03-04.jpg'),
(19, 'Zesya Aesthetic Clinic & Apotek', '-3.99861850', '122.54619820', 'Klinik Kecantikan', '2022-08-23.jpg'),
(20, 'Ameno Aesthetic Clinic', '-4.00221430', '122.50910270', 'Klinik Kecantikan', '2023-06-09.jpg'),
(21, 'Klinik & Apotek Glowliy', '-3.99888810', '122.51746090', 'Klinik Kecantikan', '2019-01-15.jpg'),
(22, 'Citra Medika Aesthetic Clinic', '-4.01794900', '122.49963680', 'Klinik Kecantikan', '20171122_184626.jpg'),
(23, 'Arayu Clinic Kendari', '-3.98167370', '122.52145620', '                        Klinik Kecantikan                        ', '2024-07-07.jpg'),
(24, 'Astrid Harianto Dermatology', '-3.98940240', '122.50560530', 'Klinik Kecantikan', 'thumbnail.jpg'),
(25, 'GA. COSMEDIC ESTETIKA dr. Diana', '-4.02724850', '122.50081350', 'Klinik Kecantikan', 'IMG_0092.JPG'),
(26, 'Alana Beauty Bar Kendari', '-3.97956460', '122.52296400', 'Klinik Kecantikan', '2022-02-22.jpg'),
(27, 'Klinik Riyena Pratama', '-3.96305560', '122.46169280', 'Klinik Kendari', '2023-06-27.jpg'),
(28, 'CHLOE SKIN CLINIC by dr. Tika Marpaung, Sp.KK', '-3.97350770', '122.49355240', 'Klinik Kecantikan', '2023-04-05.jpg'),
(29, 'dr.Anny Beauty House', '-3.96958070', '122.52282360', 'Klinik Kecantikan', '2022-05-11.jpg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_users`
--

CREATE TABLE `tb_users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_users`
--

INSERT INTO `tb_users` (`id`, `username`, `password`) VALUES
(1, 'adza', '$2y$10$VPMer6gPTC4YtiOdbjVYcueCyfmdC29KrraMwOuuOUqRUjvXtgKjC'),
(3, 'adza aulia salsabita', '$2y$10$MmMYBoPl/2L3z7Kiev0tjelEYvRCnKSYkgV1Qcz159Okg5hew9ak6'),
(5, 'asmin', '$2y$10$GCrbhXJ8XrqrOJXH0I2mduEpmyNLxJGggpowJYOXxhkNqCDc..pA.');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `markers`
--
ALTER TABLE `markers`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tb_users`
--
ALTER TABLE `tb_users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `markers`
--
ALTER TABLE `markers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT untuk tabel `tb_users`
--
ALTER TABLE `tb_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
