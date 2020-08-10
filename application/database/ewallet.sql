-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 10 Agu 2020 pada 16.53
-- Versi server: 10.1.38-MariaDB
-- Versi PHP: 7.1.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ewallet`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `blance_bank`
--

CREATE TABLE `blance_bank` (
  `id` int(11) NOT NULL,
  `balance` int(11) NOT NULL,
  `balance_achieve` int(11) NOT NULL,
  `code` varchar(10) NOT NULL,
  `enable` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `blance_bank_history`
--

CREATE TABLE `blance_bank_history` (
  `id` int(11) NOT NULL,
  `balance_bank_id` int(11) NOT NULL,
  `balance_before` int(11) NOT NULL,
  `balance_after` int(11) NOT NULL,
  `activity` varchar(200) NOT NULL,
  `type` enum('credit','debit') NOT NULL,
  `ip` varchar(50) NOT NULL,
  `location` varchar(100) NOT NULL,
  `user_agent` varchar(50) NOT NULL,
  `author` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(10) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id`, `username`, `email`, `password`, `created`, `modified`, `status`) VALUES
(1, 'andreee', 'andre@gmail.com', '12345', '0000-00-00 00:00:00', '2020-08-10 15:41:31', 1),
(2, 'bambang', 'bambang@gmail.com', 'bambang50', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1),
(3, 'agus80', 'agus80@gmail.com', 'agus80', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1),
(4, 'gracia', 'grace25@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '2020-08-09 15:48:34', '2020-08-09 15:48:34', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_balance`
--

CREATE TABLE `user_balance` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `balance` int(11) NOT NULL,
  `balance_achieve` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_balance_history`
--

CREATE TABLE `user_balance_history` (
  `id` int(11) NOT NULL,
  `user_balance_id` int(11) NOT NULL,
  `balance_before` int(11) NOT NULL,
  `balance_after` int(11) NOT NULL,
  `activity` varchar(150) NOT NULL,
  `type` enum('credit','debit') NOT NULL,
  `ip` varchar(50) NOT NULL,
  `location` varchar(50) NOT NULL,
  `user_agent` varchar(50) NOT NULL,
  `author` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `blance_bank`
--
ALTER TABLE `blance_bank`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `blance_bank_history`
--
ALTER TABLE `blance_bank_history`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `user_balance`
--
ALTER TABLE `user_balance`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `user_balance_history`
--
ALTER TABLE `user_balance_history`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `blance_bank`
--
ALTER TABLE `blance_bank`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `blance_bank_history`
--
ALTER TABLE `blance_bank_history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `user_balance`
--
ALTER TABLE `user_balance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `user_balance_history`
--
ALTER TABLE `user_balance_history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
