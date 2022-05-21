-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 21 Bulan Mei 2022 pada 11.41
-- Versi server: 10.4.21-MariaDB
-- Versi PHP: 8.0.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `elibrary_db`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `m_menu`
--

CREATE TABLE `m_menu` (
  `id_menu` int(11) NOT NULL,
  `nama_menu` varchar(20) NOT NULL,
  `link_menu` text NOT NULL,
  `type` varchar(20) NOT NULL,
  `color` varchar(50) NOT NULL,
  `icon` varchar(128) NOT NULL,
  `is_active` int(1) NOT NULL,
  `editable` enum('N/A','YES','','') NOT NULL,
  `create_by` int(11) NOT NULL,
  `create_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `m_menu`
--

INSERT INTO `m_menu` (`id_menu`, `nama_menu`, `link_menu`, `type`, `color`, `icon`, `is_active`, `editable`, `create_by`, `create_date`) VALUES
(1, 'DASHBOARD', 'dashboard', 'statis', '2B7B70', '<i class=\"fas fa-tachometer-alt\"></i>', 0, 'YES', 0, '2022-05-21'),
(2, 'MANAGEMENT', 'manajemen', 'statis', '', '<i class=\"fas fa-columns\"></i>', 1, 'N/A', 0, '2022-05-21'),
(3, 'RISK MANAGEMENT', 'risk_management', 'statis', 'FFF', '<i class=\"fas fa-columns\"></i>', 1, 'YES', 0, '2022-05-21'),
(4, 'LEGAL COMPLIANCE', 'legal_compliance', 'statis', '', '<i class=\"fas fa-columns\"></i>', 1, 'YES', 0, '2022-05-21');

-- --------------------------------------------------------

--
-- Struktur dari tabel `m_submenu`
--

CREATE TABLE `m_submenu` (
  `id_submenu` int(11) NOT NULL,
  `id_menu` int(11) NOT NULL,
  `nama_submenu` varchar(26) NOT NULL,
  `url` varchar(128) NOT NULL,
  `icon` varchar(128) NOT NULL,
  `is_active` int(1) NOT NULL COMMENT 'untuk status menu',
  `create_by` int(11) NOT NULL,
  `create_date` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `m_submenu`
--

INSERT INTO `m_submenu` (`id_submenu`, `id_menu`, `nama_submenu`, `url`, `icon`, `is_active`, `create_by`, `create_date`) VALUES
(1, 2, 'Menu', 'manajemen/menu', '<i class=\"fas fa-sitemap\"></i>', 1, 0, '2022-05-21'),
(2, 3, 'Home', 'risk_management/home', '<i class=\"fas fa-home\"></i>', 1, 0, '2022-05-21'),
(3, 2, 'Sub Menu', 'manajemen/sub_menu', '<i class=\"fas fa-sitemap\"></i>', 1, 0, '2022-05-21'),
(4, 2, 'User', 'manajemen/user', '<i class=\"fas fa-users\"></i>', 1, 0, '2022-05-21'),
(5, 2, 'Role Access', 'manajemen/role_access', '<i class=\"fas fa-users-cog\"></i>', 1, 0, '2022-05-21'),
(6, 3, 'Input New Risk Register', 'risk_management/input_new_risk_register', '<i class=\"fas fa-pen\"></i>', 1, 0, '2022-05-21'),
(7, 3, 'Risk Manj Performance', 'risk_management/risk_manj_performance', '<i class=\"fas fa-chart-pie\"></i>', 1, 0, '2022-05-21'),
(8, 4, 'Legal Compliance Home', 'legal_compliance/legal_compliance_home', '<i class=\"fas fa-clipboard\"></i>', 1, 0, '2022-05-21'),
(9, 4, 'Input New Regulation', 'legal_compliance/input_new_regulation', '<i class=\"fas fa-pen\"></i>', 1, 0, '2022-05-21'),
(10, 4, 'Masterlist Regulation', 'legal_compliance/masterlist_regulation', '<i class=\"fas fa-list-alt\"></i>', 1, 0, '2022-05-21'),
(11, 4, 'Regulation Compliance', 'legal_compliance/regulation_compliance', '<i class=\"fas fa-chart-pie\"></i>', 1, 0, '2022-05-21'),
(12, 4, 'Action Plan', 'legal_compliance/action_plan', '<i class=\"fas fa-list\"></i>', 1, 0, '2022-05-21');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(128) NOT NULL,
  `role_id` int(11) NOT NULL,
  `user_detail_id` int(11) NOT NULL,
  `is_active` int(1) NOT NULL,
  `last_login` int(20) NOT NULL,
  `ip_address` int(11) NOT NULL,
  `create_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_access_menu`
--

CREATE TABLE `user_access_menu` (
  `id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `id_menu` int(11) NOT NULL,
  `create_by` int(11) NOT NULL,
  `create_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_detail`
--

CREATE TABLE `user_detail` (
  `user_detail_id` int(11) NOT NULL,
  `nama` varchar(128) NOT NULL,
  `email` varchar(60) NOT NULL,
  `divisi` varchar(128) NOT NULL,
  `jabatan` varchar(128) NOT NULL,
  `tlp` int(13) NOT NULL,
  `img` varchar(128) NOT NULL,
  `id_departemen` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_role`
--

CREATE TABLE `user_role` (
  `role_id` int(11) NOT NULL,
  `role_type` varchar(128) NOT NULL,
  `description` text NOT NULL,
  `create_by` int(11) NOT NULL,
  `create_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `m_menu`
--
ALTER TABLE `m_menu`
  ADD PRIMARY KEY (`id_menu`),
  ADD KEY `id_menu` (`id_menu`,`is_active`);

--
-- Indeks untuk tabel `m_submenu`
--
ALTER TABLE `m_submenu`
  ADD PRIMARY KEY (`id_submenu`),
  ADD KEY `id_submenu` (`id_submenu`,`id_menu`,`is_active`),
  ADD KEY `id_menu` (`id_menu`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`),
  ADD KEY `user_id` (`user_id`,`role_id`,`user_detail_id`,`is_active`);

--
-- Indeks untuk tabel `user_access_menu`
--
ALTER TABLE `user_access_menu`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`,`role_id`,`id_menu`);

--
-- Indeks untuk tabel `user_detail`
--
ALTER TABLE `user_detail`
  ADD PRIMARY KEY (`user_detail_id`);

--
-- Indeks untuk tabel `user_role`
--
ALTER TABLE `user_role`
  ADD PRIMARY KEY (`role_id`),
  ADD KEY `role_id` (`role_id`,`role_type`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `m_menu`
--
ALTER TABLE `m_menu`
  MODIFY `id_menu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `m_submenu`
--
ALTER TABLE `m_submenu`
  MODIFY `id_submenu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `user_access_menu`
--
ALTER TABLE `user_access_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `user_detail`
--
ALTER TABLE `user_detail`
  MODIFY `user_detail_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `user_role`
--
ALTER TABLE `user_role`
  MODIFY `role_id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
