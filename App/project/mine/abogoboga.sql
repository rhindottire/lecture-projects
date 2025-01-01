-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 23, 2024 at 03:39 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `abogoboga`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `createAt` datetime(3) NOT NULL DEFAULT current_timestamp(3),
  `updateAt` datetime(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `userId`, `createAt`, `updateAt`) VALUES
(1, 1, '2024-12-21 06:42:48.965', '2024-12-21 06:42:48.965'),
(2, 2, '2024-12-21 06:47:48.161', '2024-12-21 06:47:48.161'),
(3, 3, '2024-12-21 06:48:06.470', '2024-12-21 06:48:06.470'),
(4, 4, '2024-12-21 06:48:23.290', '2024-12-21 06:48:23.290');

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

CREATE TABLE `clients` (
  `id` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `createAt` datetime(3) NOT NULL DEFAULT current_timestamp(3),
  `updateAt` datetime(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `clients`
--

INSERT INTO `clients` (`id`, `userId`, `createAt`, `updateAt`) VALUES
(1, 5, '2024-12-21 06:55:42.918', '2024-12-21 06:55:42.918'),
(2, 6, '2024-12-21 06:56:15.212', '2024-12-21 06:56:15.212'),
(3, 7, '2024-12-21 06:56:56.627', '2024-12-21 06:56:56.627'),
(4, 8, '2024-12-21 06:57:50.587', '2024-12-21 06:57:50.587'),
(5, 9, '2024-12-21 06:59:24.457', '2024-12-21 06:59:24.457'),
(6, 10, '2024-12-21 07:00:22.552', '2024-12-21 07:00:22.552'),
(7, 11, '2024-12-21 07:00:53.156', '2024-12-21 07:00:53.156'),
(8, 12, '2024-12-21 07:01:08.712', '2024-12-21 07:01:08.712'),
(9, 13, '2024-12-21 07:01:26.720', '2024-12-21 07:01:26.720'),
(10, 14, '2024-12-21 07:01:44.802', '2024-12-21 07:01:44.802'),
(11, 15, '2024-12-21 07:02:14.355', '2024-12-21 07:02:14.355'),
(12, 16, '2024-12-21 07:02:42.877', '2024-12-21 07:02:42.877'),
(13, 17, '2024-12-21 07:02:56.431', '2024-12-21 07:02:56.431'),
(14, 18, '2024-12-21 07:03:18.720', '2024-12-21 07:03:18.720'),
(15, 19, '2024-12-21 07:03:35.346', '2024-12-21 07:03:35.346'),
(16, 20, '2024-12-21 07:04:24.423', '2024-12-21 07:04:24.423'),
(17, 21, '2024-12-21 07:04:51.524', '2024-12-21 07:04:51.524'),
(18, 22, '2024-12-21 07:05:50.435', '2024-12-21 07:05:50.435'),
(19, 23, '2024-12-21 07:06:04.386', '2024-12-21 07:06:04.386'),
(20, 24, '2024-12-21 07:06:29.930', '2024-12-21 07:06:29.930'),
(21, 25, '2024-12-21 07:06:59.710', '2024-12-21 07:06:59.710'),
(22, 26, '2024-12-21 07:07:13.750', '2024-12-21 07:07:13.750'),
(23, 27, '2024-12-21 07:07:58.311', '2024-12-21 07:07:58.311');

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `id` int(11) NOT NULL,
  `clientId` int(11) NOT NULL,
  `adminId` int(11) DEFAULT NULL,
  `criticism` varchar(191) NOT NULL,
  `suggestion` varchar(191) DEFAULT NULL,
  `rating` int(11) DEFAULT NULL,
  `adminReply` varchar(191) DEFAULT NULL,
  `createAt` datetime(3) NOT NULL DEFAULT current_timestamp(3),
  `updateAt` datetime(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`id`, `clientId`, `adminId`, `criticism`, `suggestion`, `rating`, `adminReply`, `createAt`, `updateAt`) VALUES
(1, 1, 1, 'saran pakai react bang', NULL, NULL, 'siap salah!', '2024-12-21 08:16:37.983', '2024-12-21 08:34:13.872'),
(2, 2, 4, 'pindah nest.js aja bang', NULL, NULL, 'langsung jadi backend sejati', '2024-12-21 08:20:56.433', '2024-12-21 08:37:10.706'),
(3, 3, NULL, 'info gacoan', NULL, NULL, NULL, '2024-12-21 08:21:52.064', '2024-12-21 08:21:52.064'),
(4, 4, NULL, 'mending C++', NULL, NULL, NULL, '2024-12-21 08:22:31.157', '2024-12-21 08:22:31.157'),
(5, 9, NULL, 'flutter aja udah', NULL, NULL, NULL, '2024-12-21 08:25:20.787', '2024-12-21 08:25:20.787');

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` int(11) NOT NULL,
  `clientId` int(11) NOT NULL,
  `nominal` int(11) NOT NULL,
  `status` enum('FAILED','PENDING','SUCCESS') NOT NULL,
  `createAt` datetime(3) NOT NULL DEFAULT current_timestamp(3),
  `updateAt` datetime(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`id`, `clientId`, `nominal`, `status`, `createAt`, `updateAt`) VALUES
(1, 17, 100000, 'SUCCESS', '2024-12-21 08:45:23.011', '2024-12-21 08:45:50.274'),
(2, 16, 30000, 'SUCCESS', '2024-12-21 08:48:29.896', '2024-12-21 08:48:58.766'),
(3, 8, 5000, 'SUCCESS', '2024-12-21 08:50:28.299', '2024-12-21 08:50:45.129'),
(4, 9, 100000, 'SUCCESS', '2024-12-21 11:07:48.863', '2024-12-21 11:08:11.761'),
(5, 3, 100000, 'SUCCESS', '2024-12-22 13:25:04.003', '2024-12-22 13:25:40.685');

-- --------------------------------------------------------

--
-- Table structure for table `server`
--

CREATE TABLE `server` (
  `status` enum('ONLINE','OFFLINE') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `server`
--

INSERT INTO `server` (`status`) VALUES
('ONLINE');

-- --------------------------------------------------------

--
-- Table structure for table `subscribes`
--

CREATE TABLE `subscribes` (
  `id` int(11) NOT NULL,
  `paymentId` int(11) NOT NULL,
  `premium` tinyint(1) NOT NULL DEFAULT 0,
  `jenis` enum('BASIC','EXPERT','MASTER') NOT NULL,
  `startDate` datetime(3) NOT NULL,
  `endDate` datetime(3) NOT NULL,
  `lyricDisplay` tinyint(1) NOT NULL DEFAULT 0,
  `createPlaylist` tinyint(1) NOT NULL DEFAULT 0,
  `downloadLagu` tinyint(1) NOT NULL DEFAULT 0,
  `createdAt` datetime(3) NOT NULL DEFAULT current_timestamp(3),
  `updatedAt` datetime(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `subscribes`
--

INSERT INTO `subscribes` (`id`, `paymentId`, `premium`, `jenis`, `startDate`, `endDate`, `lyricDisplay`, `createPlaylist`, `downloadLagu`, `createdAt`, `updatedAt`) VALUES
(1, 1, 1, 'MASTER', '2024-12-21 08:45:50.269', '2025-01-20 00:00:00.051', 1, 1, 1, '2024-12-21 08:45:50.271', '2024-12-21 08:45:50.271'),
(2, 2, 1, 'EXPERT', '2024-12-21 08:48:58.761', '2024-12-28 00:00:00.028', 1, 1, 0, '2024-12-21 08:48:58.762', '2024-12-21 08:48:58.762'),
(3, 3, 1, 'BASIC', '2024-12-21 08:50:45.124', '2024-12-22 00:00:00.022', 1, 0, 0, '2024-12-21 08:50:45.126', '2024-12-21 08:50:45.126'),
(4, 4, 1, 'MASTER', '2024-12-21 11:08:11.754', '2025-01-20 00:00:00.051', 1, 1, 1, '2024-12-21 11:08:11.756', '2024-12-21 11:08:11.756'),
(5, 5, 1, 'MASTER', '2024-12-22 13:25:40.671', '2025-01-21 00:00:00.052', 1, 1, 1, '2024-12-22 13:25:40.676', '2024-12-22 13:25:40.676');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(191) NOT NULL,
  `username` varchar(191) NOT NULL,
  `password` varchar(191) NOT NULL,
  `role` enum('ADMIN','CLIENT') NOT NULL,
  `name` varchar(191) DEFAULT NULL,
  `gender` enum('MAN','WOMAN') DEFAULT NULL,
  `birthday` datetime(3) DEFAULT NULL,
  `telephone` varchar(191) DEFAULT NULL,
  `userProfile` varchar(191) DEFAULT NULL,
  `createAt` datetime(3) NOT NULL DEFAULT current_timestamp(3),
  `updateAt` datetime(3) NOT NULL,
  `token` varchar(191) DEFAULT NULL,
  `recoveryToken` varchar(191) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `username`, `password`, `role`, `name`, `gender`, `birthday`, `telephone`, `userProfile`, `createAt`, `updateAt`, `token`, `recoveryToken`) VALUES
(1, '230411100197@student.trunojoyo.ac.id', 'Ridho', '$2b$10$WFrmmFCyKipt5ur2RZHND.KVb35PVIuNE9IvFEUgy2oTpfKfcciFy', 'ADMIN', NULL, NULL, NULL, NULL, NULL, '2024-12-21 06:42:48.965', '2024-12-23 14:38:16.286', NULL, NULL),
(2, '23041100172@student.trunojoyo.ac.id', 'Dicky', '$2b$10$i47ZDDX0FoJSguzhKUydnunYSiQEU0CFXYRvGIB64/0G1Uvu87KVW', 'ADMIN', NULL, NULL, NULL, NULL, NULL, '2024-12-21 06:47:48.161', '2024-12-21 06:47:48.161', NULL, NULL),
(3, '23041100176@student.trunojoyo.ac.id', 'Zulfri', '$2b$10$dbVOXjICs1uyVwT4geb4feoXQcl6zF4hDtlnvljLGCSsRS02wPgIi', 'ADMIN', NULL, NULL, NULL, NULL, NULL, '2024-12-21 06:48:06.470', '2024-12-21 06:48:06.470', NULL, NULL),
(4, '23041100025@student.trunojoyo.ac.id', 'Roni', '$2b$10$ruzhQHl7XuUnPGeZZZMhQ.EKmtETo98A.Od6e7NG0rhR6PIKI.yga', 'ADMIN', NULL, NULL, NULL, NULL, NULL, '2024-12-21 06:48:23.290', '2024-12-21 09:39:32.357', NULL, NULL),
(5, 'imamGG99@gmail.com', 'ImamGG', '$2b$10$odsNJIXIFv7453L.5d0EwujfuroShWw6jdEQ.bU8qtMEheuLBwYpa', 'CLIENT', NULL, NULL, NULL, NULL, NULL, '2024-12-21 06:55:42.918', '2024-12-23 14:38:34.486', '428b60c3-f6e7-4472-9003-8c913064cc34', NULL),
(6, 'mufid31@gmail.com', 'Mufid-031', '$2b$10$1X7N0zHIhPfEC4YMwyeMneuuDp6o1o8dOUghwKiZi8f/UCOpx/mOW', 'CLIENT', NULL, NULL, NULL, NULL, NULL, '2024-12-21 06:56:15.212', '2024-12-21 08:18:50.147', 'e496c20e-7601-4601-bcee-9fe518048c03', NULL),
(7, 'maulana17@gmail.com', 'Maul', '$2b$10$wrNjYu43Upbxuzzj1gewGuAIq7pOtz4uHkaNChgyI0NsbWWi6/bVa', 'CLIENT', NULL, NULL, NULL, NULL, NULL, '2024-12-21 06:56:56.627', '2024-12-21 12:33:50.554', '0427c123-9235-475b-92bd-f4d43fe2d7ac', NULL),
(8, 'ubayd19@gmail.com', 'Ubayd', '$2b$10$7ZcGqQyewPgzCDk5NmFxWOuF7VW2ayMmKGkzva/eVJREsO2g.JKbu', 'CLIENT', NULL, NULL, NULL, NULL, NULL, '2024-12-21 06:57:50.587', '2024-12-21 11:32:14.765', NULL, NULL),
(9, 'fahri71@gmail.com', 'Fahri', '$2b$10$sveu86gxo.Koab8y5tOpX.bJOirdp2mOkTvD45MWRDXdpnBY5z0g6', 'CLIENT', NULL, NULL, NULL, NULL, NULL, '2024-12-21 06:59:24.457', '2024-12-21 06:59:24.457', NULL, NULL),
(10, 'rendy27@gmail.com', 'Rendy', '$2b$10$rWaSpFyHisBvOjkMJVvQu.7rOB.f5UHCSqyWN9X36jsmfvEZn/wbq', 'CLIENT', NULL, NULL, NULL, NULL, NULL, '2024-12-21 07:00:22.552', '2024-12-21 07:00:22.552', NULL, NULL),
(11, 'rizal77@gmail.com', 'Rizal', '$2b$10$oNS.JeH83nhGSYDSBglurOYJkbHMItcbAwu5xM/cnAkhZB2mejmBO', 'CLIENT', NULL, NULL, NULL, NULL, NULL, '2024-12-21 07:00:53.156', '2024-12-21 07:00:53.156', NULL, NULL),
(12, 'Haikal11@gmail.com', 'Haikal', '$2b$10$wo4/PSsybdeyetUBAW4/b.WUkxLl3RkYOM2BHReFtKv7PPCSvA/k.', 'CLIENT', NULL, NULL, NULL, NULL, NULL, '2024-12-21 07:01:08.712', '2024-12-21 11:07:15.117', NULL, NULL),
(13, 'Hengki66@gmail.com', 'Hengki', '$2b$10$NPodeWo1gXO2ZFkWS1cS..XlmaAIh2lTn71uJVgynVxk4QKdgw5Si', 'CLIENT', NULL, NULL, NULL, NULL, NULL, '2024-12-21 07:01:26.720', '2024-12-21 11:13:07.470', '9211b099-98c4-48ee-8f0a-4207e7269147', NULL),
(14, 'tuhu22@gmail.com', 'Tuhu', '$2b$10$LtVzd23FHu3jIE3jP/GEz.U5n/VRMdKHf.tIeBkO19hFMya8MI.ei', 'CLIENT', NULL, NULL, NULL, NULL, NULL, '2024-12-21 07:01:44.802', '2024-12-21 07:01:44.802', NULL, NULL),
(15, 'alfa24@gmail.com', 'Alfa', '$2b$10$ugDCt1coxjTpgInpB3QqX.X99tELY92J1ZP1ICVXKoMbsFnfyGEsq', 'CLIENT', NULL, NULL, NULL, NULL, NULL, '2024-12-21 07:02:14.355', '2024-12-21 07:02:14.355', NULL, NULL),
(16, 'dio90@gmail.com', 'Dio', '$2b$10$TACh5EK9B3Jac4P0z12cEuldumh.cmNY4MgFHpiDPXyOQeF6exmnC', 'CLIENT', NULL, NULL, NULL, NULL, NULL, '2024-12-21 07:02:42.877', '2024-12-21 07:02:42.877', NULL, NULL),
(17, 'javier12@gmail.com', 'Javier', '$2b$10$UJwJ4wef3NhiwGWq.RTc.uOkE6uzfPSPrCDm1ui/QT8CrW59MZJNS', 'CLIENT', NULL, NULL, NULL, NULL, NULL, '2024-12-21 07:02:56.431', '2024-12-21 07:02:56.431', NULL, NULL),
(18, 'lintang88@gmail.com', 'Lintang', '$2b$10$56aM/kUxamzgPe/HexOA3OVJb1.upPVh2kDOXJIzr48ak1GpSSu0S', 'CLIENT', NULL, NULL, NULL, NULL, NULL, '2024-12-21 07:03:18.720', '2024-12-21 07:03:18.720', NULL, NULL),
(19, 'triamarcel90@gmail.com', 'Marcel', '$2b$10$cPrGYEKl9fDwgbDy0kDMn.KfuEEOXcymMh/4PuyAIdec1KMlwaTyG', 'CLIENT', NULL, NULL, NULL, NULL, NULL, '2024-12-21 07:03:35.346', '2024-12-21 07:03:35.346', NULL, NULL),
(20, 'rohman40@gmail.com', 'Rohman', '$2b$10$Wtkzhs1nTxoXhfGKmNZwwuaVUge9fdIcHvZae27HSxSK0/efvoWXe', 'CLIENT', NULL, NULL, NULL, NULL, NULL, '2024-12-21 07:04:24.423', '2024-12-21 10:53:00.647', NULL, NULL),
(21, 'hanifbrian12@gmail.com', 'Hanif', '$2b$10$3GtAAB.NgWMssPmZH0x21O5YAJZlaVqvddVfzm5zzrNGgFWr5v9Di', 'CLIENT', NULL, NULL, NULL, NULL, NULL, '2024-12-21 07:04:51.524', '2024-12-21 10:53:10.265', '755e79c8-6ff0-402c-b605-2ba42e69c936', NULL),
(22, 'rossi11@gmail.com', 'Rossi', '$2b$10$DvnhkVmmwaAZvgHob4cjLeNqkRurD6hpuk0iIKkPrMeppzQtFYmna', 'CLIENT', NULL, NULL, NULL, NULL, NULL, '2024-12-21 07:05:50.435', '2024-12-21 07:05:50.435', NULL, NULL),
(23, 'yusron12@gmail.com', 'Yusron', '$2b$10$4LNMBH3V.rHeYAay3Mlk4OqYxDij.M7cQwajsGl6pwGU99Duz4n.C', 'CLIENT', NULL, NULL, NULL, NULL, NULL, '2024-12-21 07:06:04.386', '2024-12-21 07:06:04.386', NULL, NULL),
(24, 'elvita09@gmail.com', 'Elvita', '$2b$10$E3QGljn3UP/j3cdOxnwPW.q/WWqCG8fiL9KBT6iMFKpjXj1S.Bf6C', 'CLIENT', NULL, NULL, NULL, NULL, NULL, '2024-12-21 07:06:29.930', '2024-12-21 07:06:29.930', NULL, NULL),
(25, 'vincenzo17@gmail.com', 'Vincent', '$2b$10$ajG1gozEiq6Glg8wj6oaCeJB8gb7qC.YDFFa4CzBt1SFNlixoOdy2', 'CLIENT', NULL, NULL, NULL, NULL, NULL, '2024-12-21 07:06:59.710', '2024-12-21 07:06:59.710', NULL, NULL),
(26, 'dwiadhi11@gmail.com', 'Miho', '$2b$10$AszoIky5.dt5JEJSFhgkkeQFBWmRUkJS.n9FwRXRyG6OdgtnQvD3q', 'CLIENT', NULL, NULL, NULL, NULL, NULL, '2024-12-21 07:07:13.750', '2024-12-21 07:07:13.750', NULL, NULL),
(27, 'freya17@gmail.com', 'Aidil', '$2b$10$W1YIunBdxLl0yFw8IKRUXe9Keg/KmL0UqUyAuoLDrXYnmdtZlBaiy', 'CLIENT', NULL, NULL, NULL, NULL, NULL, '2024-12-21 07:07:58.311', '2024-12-21 07:07:58.311', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `_prisma_migrations`
--

CREATE TABLE `_prisma_migrations` (
  `id` varchar(36) NOT NULL,
  `checksum` varchar(64) NOT NULL,
  `finished_at` datetime(3) DEFAULT NULL,
  `migration_name` varchar(255) NOT NULL,
  `logs` text DEFAULT NULL,
  `rolled_back_at` datetime(3) DEFAULT NULL,
  `started_at` datetime(3) NOT NULL DEFAULT current_timestamp(3),
  `applied_steps_count` int(10) UNSIGNED NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `_prisma_migrations`
--

INSERT INTO `_prisma_migrations` (`id`, `checksum`, `finished_at`, `migration_name`, `logs`, `rolled_back_at`, `started_at`, `applied_steps_count`) VALUES
('412471ed-7c5a-458a-932b-ee8d9541ec8a', 'b6f76add194d035f05de6d8fd1cf01d75a252ff138c97eeb42ce7928d4b97470', '2024-12-21 06:39:45.533', '20241221063945_abogoboga', NULL, NULL, '2024-12-21 06:39:45.312', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `admins_userId_key` (`userId`);

--
-- Indexes for table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `clients_userId_key` (`userId`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`id`),
  ADD KEY `Feedback_clientId_fkey` (`clientId`),
  ADD KEY `Feedback_adminId_fkey` (`adminId`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `payments_clientId_fkey` (`clientId`);

--
-- Indexes for table `server`
--
ALTER TABLE `server`
  ADD UNIQUE KEY `Server_status_key` (`status`);

--
-- Indexes for table `subscribes`
--
ALTER TABLE `subscribes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `subscribes_paymentId_key` (`paymentId`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_key` (`email`),
  ADD UNIQUE KEY `users_username_key` (`username`);

--
-- Indexes for table `_prisma_migrations`
--
ALTER TABLE `_prisma_migrations`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `clients`
--
ALTER TABLE `clients`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `subscribes`
--
ALTER TABLE `subscribes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `admins`
--
ALTER TABLE `admins`
  ADD CONSTRAINT `admins_userId_fkey` FOREIGN KEY (`userId`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `clients`
--
ALTER TABLE `clients`
  ADD CONSTRAINT `clients_userId_fkey` FOREIGN KEY (`userId`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `feedback`
--
ALTER TABLE `feedback`
  ADD CONSTRAINT `Feedback_adminId_fkey` FOREIGN KEY (`adminId`) REFERENCES `admins` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `Feedback_clientId_fkey` FOREIGN KEY (`clientId`) REFERENCES `clients` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `payments`
--
ALTER TABLE `payments`
  ADD CONSTRAINT `payments_clientId_fkey` FOREIGN KEY (`clientId`) REFERENCES `clients` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `subscribes`
--
ALTER TABLE `subscribes`
  ADD CONSTRAINT `subscribes_paymentId_fkey` FOREIGN KEY (`paymentId`) REFERENCES `payments` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
