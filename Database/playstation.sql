-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 09 Jun 2023 pada 06.12
-- Versi server: 10.4.27-MariaDB
-- Versi PHP: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `playstation`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_chanel`
--

CREATE TABLE `tb_chanel` (
  `id_chanel` int(11) NOT NULL,
  `nama_chanel` varchar(200) NOT NULL,
  `status` enum('N','Y') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tb_chanel`
--

INSERT INTO `tb_chanel` (`id_chanel`, `nama_chanel`, `status`) VALUES
(1, 'PS NO 1', 'N'),
(2, 'PS NO 2', 'N'),
(5, 'PS NO 3', 'N'),
(6, 'PS NO 4', 'N'),
(7, 'PS NO 5', 'N'),
(8, 'PS NO 6', 'N'),
(9, 'PS NO 7', 'N'),
(10, 'PS NO 8', 'N'),
(11, 'PS NO 9', 'N'),
(12, 'PS NO 10', 'N'),
(13, 'PS NO 11', 'N'),
(14, 'PS NO 12', 'N');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_harga`
--

CREATE TABLE `tb_harga` (
  `id_harga` int(11) NOT NULL,
  `menit` int(11) NOT NULL,
  `harga` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tb_harga`
--

INSERT INTO `tb_harga` (`id_harga`, `menit`, `harga`) VALUES
(1, 60, 10000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_member`
--

CREATE TABLE `tb_member` (
  `id_member` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `kode` varchar(350) NOT NULL,
  `nama` varchar(350) NOT NULL,
  `tgl` date NOT NULL,
  `total` double NOT NULL,
  `dibayar` double NOT NULL,
  `status` enum('N','Y','T') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tb_member`
--

INSERT INTO `tb_member` (`id_member`, `id_user`, `kode`, `nama`, `tgl`, `total`, `dibayar`, `status`) VALUES
(40, 1, 'wim9Q20230516194609', 'coba lur', '2023-05-16', 333.3333333333333, 500, 'T'),
(41, 1, 'wG6mi20230516194614', 'STICKER 1 M', '2023-05-16', 333.3333333333333, 500, 'T'),
(42, 1, 'TZfF120230516194851', 'BUKU YASIN', '2023-05-16', 6833.333333333333, 7000, 'T'),
(43, 1, '7MZoD20230516194905', 'KAKI X BANNER', '2023-05-16', 2500, 2500, 'T'),
(44, 1, '8kHPY20230516201501', 'IKAN GEMBONG', '2023-05-16', 5333.333333333333, 5500, 'T'),
(45, 1, '82MNF20230516201807', 'BUKU YASIN', '2023-05-16', 5166.666666666667, 5500, 'T'),
(65, 1, 'yAcmW20230520233926', 'coba lur', '2023-05-20', 12500, 12500, 'T'),
(75, 1, 'RWLiP20230521082738', 'member 1', '2023-05-21', 10000, 10000, 'T'),
(76, 1, 'GROz420230521084411', 'coba lagi', '2023-05-21', 15000, 15000, 'T'),
(77, 1, 'jP3LB20230521103035', 'coba lur', '2023-05-21', 10000, 10000, 'T'),
(79, 1, 'DhbNa20230521104250', 'test', '2023-05-21', 15000, 15000, 'T'),
(82, 1, 'UMrOP20230521121540', 'BUKU YASIN', '2023-05-21', 5000, 5000, 'T'),
(83, 1, 'qQ1jf20230521123808', '3', '2023-05-21', 5000, 5000, 'T'),
(84, 1, 'BCAMF20230521130334', 'plastik', '2023-05-21', 5000, 5000, 'T'),
(86, 1, '4ieZ720230521162635', 'coba lur', '2023-05-21', 13166.666666666666, 13000, 'T'),
(87, 1, '1EuwB20230521162745', '3', '2023-05-21', 10000, 10000, 'T'),
(88, 1, 'i3j2z20230521192844', 'member 1', '2023-05-21', 5000, 5000, 'T'),
(89, 1, '54Uj320230521192851', 'member 2', '2023-05-21', 13333.333333333334, 13000, 'T'),
(90, 1, 'S5byh20230521192902', 'member 3', '2023-05-21', 15000, 15000, 'T'),
(91, 1, 'QDbxL20230521192912', 'member 4', '2023-05-21', 15000, 15000, 'T'),
(92, 1, 'JoXk320230521192918', 'member 4', '2023-05-21', 10666.666666666666, 10500, 'T'),
(93, 1, 'OU95820230521192927', 'member 5', '2023-05-21', 10666.666666666666, 10500, 'T'),
(94, 1, 'i8Yvb20230521193000', 'member 6', '2023-05-21', 5000, 5000, 'T'),
(95, 1, 'aEDKw20230521193116', 'member 7', '2023-05-21', 10333.333333333334, 10000, 'T'),
(96, 1, 'Gtda220230521194522', 'member 8', '2023-05-21', 8000, 8000, 'T'),
(97, 1, 'CY7yG20230522062510', 'coba lur', '2023-05-22', 5000, 5000, 'T'),
(101, 1, '5GSNk20230607172511', '1', '2023-06-07', 5000, 5000, 'T'),
(110, 1, 'wgutA20230608215846', 'gaul', '2023-06-08', 7333.333333333333, 7000, 'T'),
(111, 1, '3EuRk20230608220629', 'kao', '2023-06-08', 6166.666666666667, 6000, 'T'),
(112, 1, 'jdqkw20230608220722', 'hhji', '2023-06-08', 5000, 5000, 'T'),
(113, 1, '1ctiT20230608220859', 'pakkjj', '2023-06-08', 5166.666666666667, 5000, 'T'),
(114, 1, 'H9mIU20230608223221', 'khjkh', '2023-06-08', 1833.3333333333333, 2000, 'T'),
(115, 1, 'aH5Im20230608235902', ';lkl', '2023-06-08', 3833.3333333333335, 4000, 'T'),
(116, 1, 'Y3kbR20230609001537', 'kjhki', '2023-06-09', 1500, 1500, 'T'),
(117, 1, 'O2pAm20230609003259', 'ghf', '2023-06-09', 333.3333333333333, 1000, 'T');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_paket`
--

CREATE TABLE `tb_paket` (
  `id_paket` int(11) NOT NULL,
  `kode_paket` varchar(350) NOT NULL,
  `paket` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tb_paket`
--

INSERT INTO `tb_paket` (`id_paket`, `kode_paket`, `paket`) VALUES
(8, 'RWLiP20230521082738', '1 Jam'),
(9, 'GROz420230521084411', '1.5 Jam'),
(10, 'jP3LB20230521103035', '1 Jam'),
(12, 'DhbNa20230521104250', '1.5 Jam'),
(14, 'UMrOP20230521121540', '30 Menit'),
(15, 'qQ1jf20230521123808', '30 Menit'),
(16, 'BCAMF20230521130334', '30 Menit'),
(18, '1EuwB20230521162745', 'Tambah : 30 Menit'),
(19, 'i3j2z20230521192844', 'Paket : 30 Menit'),
(20, 'S5byh20230521192902', 'Paket : 1.5 Jam'),
(21, 'QDbxL20230521192912', 'Tambah : 30 Menit'),
(22, 'i8Yvb20230521193000', 'Paket : 30 Menit'),
(23, 'CY7yG20230522062510', 'Paket : 30 Menit'),
(26, '5GSNk20230607172511', 'Paket : 30 Menit'),
(28, 'jdqkw20230608220722', 'Paket : 30 Menit');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_pengeluaran`
--

CREATE TABLE `tb_pengeluaran` (
  `id_pengeluaran` int(11) NOT NULL,
  `item` varchar(250) NOT NULL,
  `tgl` date NOT NULL,
  `total` double NOT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tb_pengeluaran`
--

INSERT INTO `tb_pengeluaran` (`id_pengeluaran`, `item`, `tgl`, `total`, `id_user`) VALUES
(6, 'ngopi', '2023-06-08', 10000, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_penjualan`
--

CREATE TABLE `tb_penjualan` (
  `id_penjualan` int(11) NOT NULL,
  `kode_penjualan` varchar(250) NOT NULL,
  `jenis` enum('S','M','SM') NOT NULL,
  `jml` double NOT NULL,
  `tgl` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tb_penjualan`
--

INSERT INTO `tb_penjualan` (`id_penjualan`, `kode_penjualan`, `jenis`, `jml`, `tgl`) VALUES
(6, 'TZfF120230516194851', 'M', 5000, '2023-05-16'),
(9, 'BY', 'S', 5000, '2023-05-21'),
(10, '54Uj320230521192851', 'M', 5000, '2023-05-21');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_sewa`
--

CREATE TABLE `tb_sewa` (
  `id_sewa` int(11) NOT NULL,
  `id_chanel` int(11) NOT NULL,
  `kode_member` varchar(350) NOT NULL,
  `start` datetime NOT NULL,
  `stop` datetime NOT NULL,
  `lama_sewa` varchar(100) NOT NULL,
  `harga_sewa` varchar(250) NOT NULL,
  `aktif` enum('ON','OFF') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tb_sewa`
--

INSERT INTO `tb_sewa` (`id_sewa`, `id_chanel`, `kode_member`, `start`, `stop`, `lama_sewa`, `harga_sewa`, `aktif`) VALUES
(40, 1, 'wim9Q20230516194609', '2023-05-16 19:46:09', '2023-05-16 19:48:19', '00:02:10', 'Harga per 60 menit : Rp.10,000', 'OFF'),
(41, 2, 'wG6mi20230516194614', '2023-05-16 19:46:14', '2023-05-16 19:48:26', '00:02:12', 'Harga per 60 menit : Rp.10,000', 'OFF'),
(42, 1, 'TZfF120230516194851', '2023-05-16 19:48:51', '2023-05-16 20:00:45', '00:11:54', 'Harga per 60 menit : Rp.10,000', 'OFF'),
(43, 2, '7MZoD20230516194905', '2023-05-16 19:49:05', '2023-05-16 20:05:03', '00:15:58', 'Harga per 60 menit : Rp.10,000', 'OFF'),
(44, 7, '8kHPY20230516201501', '2023-05-16 20:15:01', '2023-05-16 20:47:12', '00:32:11', 'Harga per 60 menit : Rp.10,000', 'OFF'),
(45, 6, '82MNF20230516201807', '2023-05-16 20:18:07', '2023-05-16 20:49:22', '00:31:15', 'Harga per 60 menit : Rp.10,000', 'OFF'),
(60, 1, 'yAcmW20230520233926', '2023-05-20 23:39:26', '2023-05-21 00:54:38', '01:15:12', 'Harga per 60 menit : Rp.10,000', 'OFF'),
(70, 1, 'RWLiP20230521082738', '2023-05-21 08:27:38', '2023-05-21 09:27:38', '01:00:00', 'Harga per 60 menit : Rp.10,000', 'OFF'),
(71, 2, 'GROz420230521084411', '2023-05-21 08:44:11', '2023-05-21 10:14:11', '01:30:00', 'Harga per 60 menit : Rp.10,000', 'OFF'),
(72, 1, 'jP3LB20230521103035', '2023-05-21 10:30:35', '2023-05-21 11:30:35', '01:00:00', 'Harga per 60 menit : Rp.10,000', 'OFF'),
(74, 2, 'DhbNa20230521104250', '2023-05-21 10:42:50', '2023-05-21 12:12:50', '01:30:00', 'Harga per 60 menit : Rp.10,000', 'OFF'),
(77, 2, 'UMrOP20230521121540', '2023-05-21 12:15:40', '2023-05-21 12:45:40', '00:30:00', 'Harga per 60 menit : Rp.10,000', 'OFF'),
(78, 1, 'qQ1jf20230521123808', '2023-05-21 12:38:08', '2023-05-21 13:08:08', '00:30:00', 'Harga per 60 menit : Rp.10,000', 'OFF'),
(79, 5, 'BCAMF20230521130334', '2023-05-21 13:03:34', '2023-05-21 13:33:34', '00:30:00', 'Harga per 60 menit : Rp.10,000', 'OFF'),
(81, 2, '4ieZ720230521162635', '2023-05-21 16:26:35', '2023-05-21 17:45:46', '01:19:11', 'Harga per 60 menit : Rp.10,000', 'OFF'),
(82, 1, '1EuwB20230521162745', '2023-05-21 16:27:45', '2023-05-21 17:27:45', '01:00:00', 'Harga per 60 menit : Rp.10,000', 'OFF'),
(83, 1, 'i3j2z20230521192844', '2023-05-21 19:28:44', '2023-05-21 19:58:44', '00:30:00', 'Harga per 60 menit : Rp.10,000', 'OFF'),
(84, 2, '54Uj320230521192851', '2023-05-21 19:28:51', '2023-05-21 20:18:51', '00:50:00', 'Harga per 60 menit : Rp.10,000', 'OFF'),
(85, 5, 'S5byh20230521192902', '2023-05-21 19:29:02', '2023-05-21 20:59:02', '01:30:00', 'Harga per 60 menit : Rp.10,000', 'OFF'),
(86, 6, 'QDbxL20230521192912', '2023-05-21 19:29:12', '2023-05-21 20:59:12', '01:30:00', 'Harga per 60 menit : Rp.10,000', 'OFF'),
(87, 7, 'JoXk320230521192918', '2023-05-21 19:29:18', '2023-05-21 20:34:11', '01:04:53', 'Harga per 60 menit : Rp.10,000', 'OFF'),
(88, 8, 'OU95820230521192927', '2023-05-21 19:29:27', '2023-05-21 20:33:56', '01:04:29', 'Harga per 60 menit : Rp.10,000', 'OFF'),
(89, 14, 'i8Yvb20230521193000', '2023-05-21 19:30:00', '2023-05-21 20:00:00', '00:30:00', 'Harga per 60 menit : Rp.10,000', 'OFF'),
(90, 11, 'aEDKw20230521193116', '2023-05-21 19:31:16', '2023-05-21 20:33:33', '01:02:17', 'Harga per 60 menit : Rp.10,000', 'OFF'),
(91, 10, 'Gtda220230521194522', '2023-05-21 19:45:22', '2023-05-21 20:33:49', '00:48:27', 'Harga per 60 menit : Rp.10,000', 'OFF'),
(92, 1, 'CY7yG20230522062510', '2023-05-22 06:25:10', '2023-05-22 06:55:10', '00:30:00', 'Harga per 60 menit : Rp.10,000', 'OFF'),
(96, 1, '5GSNk20230607172511', '2023-06-07 17:25:11', '2023-06-07 17:55:11', '00:30:00', 'Harga per 60 menit : Rp.10,000', 'OFF'),
(105, 12, 'wgutA20230608215846', '2023-06-08 21:58:46', '2023-06-08 22:43:43', '00:44:57', 'Harga per 60 menit : Rp.10,000', 'OFF'),
(106, 14, '3EuRk20230608220629', '2023-06-08 22:06:29', '2023-06-08 22:43:35', '00:37:06', 'Harga per 60 menit : Rp.10,000', 'OFF'),
(107, 9, 'jdqkw20230608220722', '2023-06-08 22:07:22', '2023-06-08 22:37:22', '00:30:00', 'Harga per 60 menit : Rp.10,000', 'OFF'),
(108, 7, '1ctiT20230608220859', '2023-06-08 22:08:59', '2023-06-08 22:40:35', '00:31:36', 'Harga per 60 menit : Rp.10,000', 'OFF'),
(109, 5, 'H9mIU20230608223221', '2023-06-08 22:32:21', '2023-06-08 22:44:08', '00:11:47', 'Harga per 60 menit : Rp.10,000', 'OFF'),
(110, 1, 'aH5Im20230608235902', '2023-06-08 23:59:02', '2023-06-09 00:22:51', '00:23:49', 'Harga per 60 menit : Rp.10,000', 'OFF'),
(111, 2, 'Y3kbR20230609001537', '2023-06-09 00:15:37', '2023-06-09 00:25:10', '00:09:33', 'Harga per 60 menit : Rp.10,000', 'OFF'),
(112, 2, 'O2pAm20230609003259', '2023-06-09 00:32:59', '2023-06-09 00:35:05', '00:02:06', 'Harga per 60 menit : Rp.10,000', 'OFF');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_user`
--

CREATE TABLE `tb_user` (
  `id_user` int(11) NOT NULL,
  `nama_lengkap` varchar(200) NOT NULL,
  `username` varchar(200) NOT NULL,
  `level` int(1) NOT NULL,
  `password` varchar(350) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tb_user`
--

INSERT INTO `tb_user` (`id_user`, `nama_lengkap`, `username`, `level`, `password`) VALUES
(1, 'Administrator', 'admin', 1, '$2y$10$6HIczh3h9VPTyuRpHreqauBuMLCFdyIsniiSgbpS4U9qouPoxCd4q'),
(3, 'Administrator', 'adi', 2, '$2y$10$kCJtO9Dt39lkaYStDYC4WOd69o4tzOnwC8/EtN3CQqXVZp3k7Mkkm');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `tb_chanel`
--
ALTER TABLE `tb_chanel`
  ADD PRIMARY KEY (`id_chanel`);

--
-- Indeks untuk tabel `tb_harga`
--
ALTER TABLE `tb_harga`
  ADD PRIMARY KEY (`id_harga`);

--
-- Indeks untuk tabel `tb_member`
--
ALTER TABLE `tb_member`
  ADD PRIMARY KEY (`id_member`);

--
-- Indeks untuk tabel `tb_paket`
--
ALTER TABLE `tb_paket`
  ADD PRIMARY KEY (`id_paket`);

--
-- Indeks untuk tabel `tb_pengeluaran`
--
ALTER TABLE `tb_pengeluaran`
  ADD PRIMARY KEY (`id_pengeluaran`);

--
-- Indeks untuk tabel `tb_penjualan`
--
ALTER TABLE `tb_penjualan`
  ADD PRIMARY KEY (`id_penjualan`);

--
-- Indeks untuk tabel `tb_sewa`
--
ALTER TABLE `tb_sewa`
  ADD PRIMARY KEY (`id_sewa`);

--
-- Indeks untuk tabel `tb_user`
--
ALTER TABLE `tb_user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `tb_chanel`
--
ALTER TABLE `tb_chanel`
  MODIFY `id_chanel` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT untuk tabel `tb_harga`
--
ALTER TABLE `tb_harga`
  MODIFY `id_harga` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `tb_member`
--
ALTER TABLE `tb_member`
  MODIFY `id_member` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=125;

--
-- AUTO_INCREMENT untuk tabel `tb_paket`
--
ALTER TABLE `tb_paket`
  MODIFY `id_paket` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT untuk tabel `tb_pengeluaran`
--
ALTER TABLE `tb_pengeluaran`
  MODIFY `id_pengeluaran` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `tb_penjualan`
--
ALTER TABLE `tb_penjualan`
  MODIFY `id_penjualan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT untuk tabel `tb_sewa`
--
ALTER TABLE `tb_sewa`
  MODIFY `id_sewa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=120;

--
-- AUTO_INCREMENT untuk tabel `tb_user`
--
ALTER TABLE `tb_user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
