-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 08 Jul 2022 pada 10.40
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
-- Struktur dari tabel `data_kunjungan`
--

CREATE TABLE `data_kunjungan` (
  `id_kunjungan` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `tgl_kunjungan` date NOT NULL DEFAULT current_timestamp(),
  `time_kunjungan` time NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `data_kunjungan`
--

INSERT INTO `data_kunjungan` (`id_kunjungan`, `id_user`, `tgl_kunjungan`, `time_kunjungan`) VALUES
(4, 9, '2022-07-05', '14:15:04'),
(7, 9, '2022-07-05', '14:33:34'),
(12, 9, '2022-07-05', '14:39:58'),
(14, 9, '2022-07-08', '15:18:23');

-- --------------------------------------------------------

--
-- Struktur dari tabel `m_buku`
--

CREATE TABLE `m_buku` (
  `id_buku` int(11) NOT NULL,
  `judul_buku` varchar(100) NOT NULL,
  `penulis_buku` varchar(100) NOT NULL,
  `penerbit_buku` varchar(100) NOT NULL,
  `tahun_penerbit` char(4) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `kode_buku` varchar(11) NOT NULL,
  `kode_penulis` varchar(11) NOT NULL,
  `kode_judul` varchar(11) NOT NULL,
  `id_kategori` int(11) NOT NULL,
  `img` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `m_buku`
--

INSERT INTO `m_buku` (`id_buku`, `judul_buku`, `penulis_buku`, `penerbit_buku`, `tahun_penerbit`, `jumlah`, `kode_buku`, `kode_penulis`, `kode_judul`, `id_kategori`, `img`) VALUES
(1, '10 HARI PENTING BERSAMA RASULULLAH ', 'KHALID MUHAMMAD KHALID', 'GEMA INSANI', '1982', 1, '200', 'KHA', '10', 1, 'ebookdefault.jpg'),
(2, 'Hafal Al-Qur\'an dalam Sebulan', 'Ir. Amjad Qosim', 'Qiblat Press', '2008', 1, '200', 'IRA', 'h', 1, 'ebookdefault.jpg'),
(3, 'BERPIKIR DAN BERJIWA BESAR', 'David J. Schwartz', 'Binarupa Aksara', '2007', 1, '000', 'DIV', 'b', 1, 'ebookdefault.jpg'),
(4, 'Berlajar Berprestasi', 'AN. Ubaedy', 'Mutiara Harapan', '2005', 1, '200', 'ANU', 'b', 1, 'ebookdefault.jpg'),
(5, 'JAGA 12 BAGIAN TUBUHMU, NISCAYA KAU MASUK SURGA', 'Rizem Aizid', 'Semesta Hikmah', '2018', 1, '200', 'RIZ', 'j', 1, 'ebookdefault.jpg'),
(6, 'Nikmatnya Hidup Penuh Berkah', 'Abu Hudzaifah Ibrahim bin Muhammad', 'Saiful Aziz', '2011', 1, '200', 'ABU', 'n', 1, 'ebookdefault.jpg'),
(7, 'DEMOCRATIC POLICING', 'MUHAMAAD TITO KARNAVIAN', 'Pensil-324', '2017', 1, '000', 'MUH', 'd', 1, 'ebookdefault.jpg'),
(8, 'Kerja Cerdas Dong! 3', 'Ahmad Asrof', 'Fitri', '2016', 1, '000', 'AHM', 'k', 1, 'ebookdefault.jpg'),
(9, 'Secangkir Teh Hangat Pasar Modal', 'UBAIDDILLAH NUGRHA', 'Gramedia Pustaka Utama', '2004', 1, '000', 'UBA', 's', 1, 'ebookdefault.jpg'),
(10, 'KEPEMIMPINAN (TEORI DAN APLIKASI)', 'Prof. Dr. H.U Husna Asmara', 'ALFABETA, BANDUNG', '2017', 1, '000', 'PRO', 'k', 1, 'ebookdefault.jpg'),
(11, 'JATUH-BANGUN BOS-BOS STARTUP', 'Lauma Kiwe', 'Checklist', '2018', 1, '000', 'LAU', 'j', 1, 'ebookdefault.jpg'),
(12, 'Kekuatan Tangan kiri', 'Aulia Fadli', 'Pinus(KPP)', '2009', 1, '000', 'AUL', 'k', 1, 'ebookdefault.jpg'),
(13, 'Kenapa Jadi Pemimpin', 'ILHAM NURI', 'ALFABETA, BANDUNG', '2015', 1, '000', 'ILH', 'k', 1, 'ebookdefault.jpg'),
(14, 'Pirate and Mer-King', 'Sheila K.McCullagh', 'Mary Gernat', '1975', 1, '800', 'SHE', 'p', 1, 'ebookdefault.jpg'),
(15, 'SEJARAH BANTEN (Membangun Tradisi dan Peradaban)', 'Prof. Dr. Hj. Nina H. Lubis, M. S.', 'BADAN PERPUSTAKAAN DAN ARSIP DAERAH PROVINSI BANTEN', '2014', 1, '800', 'PRO', 's', 1, 'ebookdefault.jpg'),
(16, 'KAMUS PRAKTIS Bahasa Jerman', 'Leon Friedrich', 'Inter Press', '2015', 1, '500', 'LEO', 'k', 1, 'ebookdefault.jpg'),
(17, 'RAHASIA SUKSES ORANG MINANG DI PERANTAUAN', 'Muarif', 'PINUS BOOK PUBLISHER', '2009', 1, '300', 'MUA', 'r', 1, 'ebookdefault.jpg'),
(18, 'Kemuliaan \'Umar Ibn Khaththab Ra', 'DR. MUHAMMAD SHIDDIQ AL-MINSYAWI', 'PUSTAKA ANISAH', '2003', 1, '200', 'DRM', 'k', 1, 'ebookdefault.jpg'),
(19, 'USTADZ ARIFIN ILHAM DAN KEKUATAN DZIKIRNYA', 'H. MUHAMMAD AINUR', 'Noktah', '2019', 1, '200', 'HMU', 'u', 1, 'ebookdefault.jpg'),
(20, 'Asal Mula (Terjadinya Alam Semesta, Galaksi, Tata Surya, dan Kita)', 'NEIL deGRASSE TYSON', '(Keputusaan Populer Gramedia)', '2019', 1, '900', 'NEI', 'a', 1, 'ebookdefault.jpg'),
(21, 'RADIN INTEN II (PAHLAWAN NASIONAL DARI LAMPUNG)', 'Amrin Imran', 'PT. SENTRA KREASI INTI, Jakarta', '2001', 1, '900', 'AMR', 'r', 1, 'ebookdefault.jpg'),
(22, 'TAN MALAKA Perjuangan dan Kesederhanaan', 'Anom Whani Wicaksana', 'C-Klik Media', '2020', 1, '900', 'ANO', 't', 1, 'ebookdefault.jpg'),
(23, 'PAULO FREIRE (KEHIPUDAN, KARYA & PEMIKIRANNYA)', 'DENIS COLLINS', 'KOMUNITAS APIRU Yogyakarta', '2011', 1, '900', 'DEN', 'p', 1, 'ebookdefault.jpg'),
(24, 'Manusia Ide', 'MOCHTAR RIADY', 'Buku Kompas', '2016', 1, '900', 'MOC', 'm', 1, 'ebookdefault.jpg'),
(25, 'MARIE CURIE', 'ANN E. STEINKE', 'BARROSN\'S', '1987', 1, '813', 'ANN', 'm', 1, 'ebookdefault.jpg'),
(26, 'THE SIGNALMAN and THE GOST AT THE TRIAL', 'CHARLES DICKENS', 'DIAN RAKYAT', '2003', 1, '813', 'CHA', 't', 1, 'ebookdefault.jpg'),
(27, 'The Black Cat', 'John Milne', 'DIAN RAKYAT', '2003', 1, '813', 'JOH', 't', 1, 'ebookdefault.jpg'),
(28, 'THE CUT GLASS BOWL ANDOTHER STORIES', 'F. SCOTT FITZGERALD', 'DIAN RAKYAT', '2003', 1, '813', 'FSO', 't', 1, 'ebookdefault.jpg'),
(29, 'The HOUSE an the HILL', 'ELIZABETH LAIRD', 'DIAN RAKYAT', '2003', 1, '813', 'ELI', 't', 1, 'ebookdefault.jpg'),
(30, 'The Beautiful and Damned', 'F. SCOTT FITZGERALD', 'DIAN RAKYAT', '2003', 1, '813', 'FSO', 't', 1, 'ebookdefault.jpg'),
(31, 'NGEBLOG DENGAN HATI', 'NDORO KAKUNG', 'GAGAS MEDIA', '2009', 1, '700', 'NDO', 'n', 1, 'ebookdefault.jpg'),
(32, 'Jagad Sains', 'Jigyungsa', 'PT. Elex Media Komputindo', '2014', 1, '741.3', 'JIG', 'j', 1, 'ebookdefault.jpg'),
(33, 'Pilar Islam (Bagi Pluralisme Modern)', 'Imam Sukardi, dkk', 'TIGA SERANGKAI', '2003', 1, '700', 'IMA', 'p', 1, 'ebookdefault.jpg'),
(34, 'Rukun Keberlimpahan (Menuju Keberlimpahan dalam 365 hari)', 'Adam Nova', 'PT. Elex Media Komputindo', '2013', 1, '297.1', 'ADA', 'r', 1, 'ebookdefault.jpg'),
(35, 'Kebebasan Wanita (Jilid 4)', 'Abdul Halim Abu Syuqqah', 'GEMA INSANI', '2000', 1, '200', 'ABD', 'k', 1, 'ebookdefault.jpg'),
(36, 'Kebebasan Wanita (Jilid 1)', 'Abdul Halim Abu Syuqqah', 'GEMA INSANI', '2000', 1, '200', 'ABD', 'k', 1, 'ebookdefault.jpg'),
(37, 'Kebebasan Wanita (Jilid 2)', 'Abdul Halim Abu Syuqqah', 'GEMA INSANI', '2000', 1, '200', 'ABD', 'k', 1, 'ebookdefault.jpg'),
(38, 'Kebebasan Wanita (Jilid 6)', 'Abdul Halim Abu Syuqqah', 'GEMA INSANI', '2000', 1, '200', 'ABD', 'k', 1, 'ebookdefault.jpg'),
(39, 'Kebebasan Wanita (Jilid 5)', 'Abdul Halim Abu Syuqqah', 'GEMA INSANI', '2000', 1, '200', 'ABD', 'k', 1, 'ebookdefault.jpg'),
(40, 'Beginilah Jalan Da\'wah Mengajarkan Kami', 'M. Lili Nur Aulia', 'Pustaka Da\'watuna', '2008', 1, '200', 'LIL', 'b', 1, 'ebookdefault.jpg'),
(41, 'Kisah Tokoh - Tokoh Dunia Yang Masuk Islam', 'Ahmad Hamid', 'PUSTAKA AL-KAUTSAR', '2010', 1, '200', 'AHM', 'k', 1, 'ebookdefault.jpg'),
(42, 'Islamic Parenting (Pendidikan Anak di Usia Emas)', 'M.Fauzi Rachman', 'ERLANGGA', '2011', 1, '200', 'FAU', 'i', 1, 'ebookdefault.jpg'),
(43, 'Man Jadda Wajada (Ketika Sukses Berawal Dari Pesantren)', 'Akbar Zainudin', 'PT. EMJEWE', '2014', 1, '200', 'AKB', 'm', 1, 'ebookdefault.jpg'),
(44, 'Butir - Butir Pemikiran Sayyid Quthb', 'K. Salim Bahnasawi', 'GEMA INSANI', '2004', 1, '200', 'SAL', 'b', 1, 'ebookdefault.jpg'),
(45, 'Rahasia Kehidupan Jin', 'Fatchur Rahman', 'AL BASITH ', '', 1, '200', 'FAT', 'r', 1, 'ebookdefault.jpg'),
(46, 'Ramadhan Yang Kurindukan ', 'Syaikh Muzaffer Ozak Al-Jerrahi', 'PUSTAKA HIDAYAH', '2009', 1, '200', 'MUZ', 'r', 1, 'ebookdefault.jpg'),
(47, 'GIZI HATI (Selamatkan Hati Dari Tipu Daya Setan)', 'Dr. Ahmad Farid', 'AQWAM', '2007', 1, '200', 'AHM', 'g', 1, 'ebookdefault.jpg'),
(48, 'Pokok - Pokok Ajaran Islam ', 'Drs. Miftah Faridl ', 'PUSTAKA', '1993', 1, '200', 'MIF', 'p', 1, 'ebookdefault.jpg'),
(49, 'Komitmen Dai Sejati ', 'Muhammad Abduh', 'Al-I\'tishom Cahaya Umat', '2010', 1, '200', 'MUH', 'k', 1, 'ebookdefault.jpg'),
(50, 'Dialog Masalah Kebenaran Bibel ', 'KH. Bahaudin Mudhary', 'Pustaka Da\'i Jakarta', '2005', 1, '200', 'BAH', 'd', 1, 'ebookdefault.jpg'),
(51, 'Menggagas Pendidikan Bermakna', 'Muclhas Samani', 'SIC', '2011', 1, '200', 'MUC', 'm', 1, 'ebookdefault.jpg'),
(52, 'Pilar - Pilar Agama Islam ', 'Syaikh Muhammad Bin Ibrahim At-Tuwajiri', 'PUSTAKA AZZAM', '2000', 1, '200', 'MUH', 'p', 1, 'ebookdefault.jpg'),
(53, 'Kisah nyata 25 Nabi Dan Rasul Disertai Pengetahuan Aqidah Islam', 'Cecep Ihsani', 'DUA MEDIA', '2011', 1, '200', 'CEC', 'k', 1, 'ebookdefault.jpg'),
(54, 'Hidup Berkah Mati Pun Indah ', 'Dr. H. Abdul Mustaqim', 'KOMARONA ', '2013', 1, '200', 'ABD', 'h', 1, 'ebookdefault.jpg'),
(55, 'Wanita - Wanita Yang Sudah Tidak Punya Rasa Malu', 'Arini El-Ghaniy', 'DIVA Press', '2010', 1, '200', 'ARI', 'w', 1, 'ebookdefault.jpg'),
(56, 'Tuntunan Islami Menuju Kemenangan Di Usia 40 Tahun ', 'Nur K', 'Semesta Hikmah', '2017', 1, '200', 'NUR', 't', 1, 'ebookdefault.jpg'),
(57, 'Enam Pertemuan Penuh Cahaya ', 'Abdullah bin Abdul Aziz Al-Aidan', 'SHAKIRA', '2004', 1, '200', 'ABD', 'e', 1, 'ebookdefault.jpg'),
(58, 'BREAKTHROUGH (7 Kunci Utama Membangun Bisnis)', 'Muhammad Assad', 'PT Elex Media Komputindo', '2017', 1, '300', 'MUH', 'b', 1, 'ebookdefault.jpg'),
(59, 'Pengantar Ilmu Antropologi ', 'Prof. Dr. Koentjaraningrat', 'RINEKA CIPTA', '2015', 2, '300', 'KOE', 'p', 1, 'ebookdefault.jpg'),
(60, 'Sistem Sosial Budaya Indonesia ', 'Jacobus Ranjabar', 'ALFABETA', '2014', 1, '300', 'JAC', 's', 1, 'ebookdefault.jpg'),
(61, 'Sistem Ekonomi Indonesia', 'Dr. Subandi, M.M', 'AlFABETA', '2016', 1, '300', 'SUB', 's', 1, 'ebookdefault.jpg'),
(62, 'Ilmu Sosial Budaya Dasar', 'Elly M. Setiadi, dkk', 'PRENADAMEDIA', '2012', 1, '300', 'ELL', 'i', 1, 'ebookdefault.jpg'),
(63, 'BANTEN BANGKIT', 'Akhmad Mukhlis Yusuf, dkk', 'Gong Publishing', '2010', 1, '300', 'AHM', 'b', 1, 'ebookdefault.jpg'),
(64, 'Menangani Kemiskinan ', 'Dr. Bambang Rustanto, M.Hum', 'PT. REMAJA ROSDAKARYA', '2015', 1, '300', 'BAM', 'm', 1, 'ebookdefault.jpg'),
(65, 'Strategi Jitu Mendapatkan Pekerjaan ', 'Puji Astutik', 'SAUFA', '2016', 1, '300', 'PUJ', 's', 1, 'ebookdefault.jpg'),
(66, 'Bagaimana Menjadi Politisi Bermoral', 'M. Ilham Marzuq, S.Hum', 'INDAH', '2009', 1, '300', 'ILH', 'b', 1, 'ebookdefault.jpg'),
(67, 'Remaja Dan Masalahnya', 'Prof. Dr. Sofyah S.Willis, M.Pd', 'ALFABETA', '2017', 2, '300', 'SOF', 'r', 1, 'ebookdefault.jpg'),
(68, 'Rich Dad\'s Rich Kid Smart Kid', 'Robert T. Kiyosaki', 'PT. Gramedia Pustaka Utama', '2002', 1, '300', 'SHA', 'r', 1, 'ebookdefault.jpg'),
(69, 'Meraih Perkejaan Yang Diidamkan ', 'Hoeda Manis', 'INDAH', '2012', 1, '300', 'HOE', 'm', 1, 'ebookdefault.jpg'),
(70, 'Manusia Indonesia', 'Moechar Lubis', 'Yayasan Pustaka Obor Indonesia ', '2013', 1, '300', 'MOC', 'm', 1, 'ebookdefault.jpg'),
(71, 'Bertahan Dari Tragedi', 'Dono Baswardono', 'PT. Elex Media Komputindo', '2006', 1, '300', 'DON', 'b', 1, 'ebookdefault.jpg'),
(72, 'Panduan MC Dan Pidato Dalam Tiga Bahasa', 'Drs. Moh. Syamsi Hasan, Dkk', 'AMELIA', '', 1, '300', 'SYA', 'p', 1, 'ebookdefault.jpg'),
(73, 'Jangan Putus Asa Ibroh dari kehidupan teroris korbannya ', 'Hasibullah Satrawi', 'Aliansi Indonesia Damai', '2018', 4, '100', 'HAS', 'j', 1, 'ebookdefault.jpg'),
(74, 'Aneka Sifat Kekerasan Fisik, Simbolik, Birokratik dan Struktural', 'I.M. Hendrati Dan Herudjati Purwoko', 'PT INDEKS', '2008', 1, '100', 'HEN', 'a', 1, 'ebookdefault.jpg'),
(75, 'Perilaku Manusia ', 'Prof. Dr. Samsunuwiyati Mar\'at, Psi', 'PT Refika Aditama', '2010', 1, '100', 'SAM', 'p', 1, 'ebookdefault.jpg'),
(76, 'Pengembangan Kepribadian', 'Euis Winarti', 'LENTERA ILMU CENDEKIA', '2007', 1, '100', 'EUI', 'p', 1, 'ebookdefault.jpg'),
(77, 'How to Reset Your Life', 'Dian Nafi', 'PT Gramedia Widiasarana Indonesia', '2017', 1, '100', 'DIA', 'h', 1, 'ebookdefault.jpg'),
(78, 'Membaca Kepribadian Orang ', 'Gregory G. Young ', 'THINK ', '2009', 1, '100', 'GRE', 'm', 1, 'ebookdefault.jpg'),
(79, 'BRISTOL MURDER', 'PHILIP PROWSE', 'DIAN RAKYAT', '2003', 1, '813', 'PHI', 'b', 1, 'ebookdefault.jpg'),
(80, 'The Stranger', 'Norman Whitney', 'DIAN RAKYAT', '2003', 1, '813', 'NOR', 't', 1, 'ebookdefault.jpg'),
(81, 'The Earth, My Butt & Other Big Round Things', 'Carolyn Mackler', '', '2014', 1, '813', 'CAR', 't', 1, 'ebookdefault.jpg'),
(82, 'Dream Catcher', 'Alanda Kariza', 'GagasMedia', '2012', 1, '813', 'ALA', 'd', 1, 'ebookdefault.jpg'),
(83, 'CHICKEN SOUP FOR THE CHRISTIAN SOUL', 'Jack Canfield', 'DABARA PUBLISHERS', '1997', 1, '813', 'JAC', 'c', 1, 'ebookdefault.jpg'),
(84, 'UNDANG-UNDANG DASAR NEGERA REPBLIK INDONESIA TAHUN 1945', 'Pimpinan MPR dan Tim Kerja', 'SEKRETARIAT JENDERAL MPR RI', '2015', 1, '340', 'PIM', 'u', 1, 'ebookdefault.jpg'),
(85, 'MATERI SOSIALISASI EMPAT PILAR MPR RI', 'Pimpinan MPR dan Tim Kerja', 'SEKRETARIAT JENDERAL MPR RI', '2015', 24, '323.6', 'PIM', 'm', 1, 'ebookdefault.jpg'),
(86, 'BAHAN TAYANG MATERI SOSIALISASI EMPAT PILAR MPR RI', 'Pimpinan MPR dan Tim Kerja', 'SEKRETARIAT JENDERAL MPR RI', '2015', 5, '323.6', 'PIM', 'b', 1, 'ebookdefault.jpg'),
(87, 'Panduan Pemasyarakatan Undang-Undang Dasar Negara Republik Indonesia Tahun 1945 Dan Ketepan MPR RI', 'Pimpinan MPR dan Tim Kerja', 'SEKRETARIAT JENDERAL MPR RI', '2015', 1, '340', 'PIM', 'p', 1, 'ebookdefault.jpg'),
(88, 'Panduan Pemasyarakatan Undang-Undang Dasar Negara Republik Indonesia Tahun 1945 Dan Ketepan MPR RI', 'Pimpinan MPR dan Tim Kerja', 'SEKRETARIAT JENDERAL MPR RI', '2017', 1, '340', 'PIM', 'p', 1, 'ebookdefault.jpg'),
(89, 'Panduan Pemasyarakatan Undang-Undang Dasar Negara Republik Indonesia Tahun 1945 Dan Ketepan MPR RI', 'Pimpinan MPR dan Tim Kerja', 'SEKRETARIAT JENDERAL MPR RI', '2016', 1, '340', 'PIM', 'p', 1, 'ebookdefault.jpg'),
(90, 'Panduan Pemasyarakatan Undang-Undang Dasar Negara Republik Indonesia Tahun 1945 Dan Ketepan MPR RI', 'Pimpinan MPR dan Tim Kerja', 'SEKRETARIAT JENDERAL MPR RI', '2015', 1, '340', 'PIM', 'P', 1, 'ebookdefault.jpg'),
(91, 'BAHAN AJAR PENDIDIKAN KEWARGANEGARAAN (Dipakai Untuk Lingkungan Sendiri)', 'Dra. Hj. Ehal Halimah, M.Pd', '', '', 1, '340', 'EHA', 'b', 1, 'ebookdefault.jpg'),
(92, 'UUD 1945', 'Pimpinan MPR dan Tim Kerja', 'SEKRETARIAT JENDERAL MPR RI', '2011', 1, '340', 'PIM', 'u', 1, 'ebookdefault.jpg'),
(93, 'MATERI SOSIALISASI EMPAT PILAR MPR RI', 'Pimpinan MPR dan Tim Kerja', 'SEKRETARIAT JENDERAL MPR RI', '2017', 1, '340', 'PIM', 'M', 1, 'ebookdefault.jpg'),
(94, 'UNDANG-UNDANG DASAR NEGERA REPBLIK INDONESIA TAHUN 1945', 'Pimpinan MPR dan Tim Kerja', 'SEKRETARIAT JENDERAL MPR RI', '2016', 1, '340', 'PIM', 'u', 1, 'ebookdefault.jpg'),
(95, 'UNDANG-UNDANG DASAR NEGERA REPBLIK INDONESIA TAHUN 1945', 'Pimpinan MPR dan Tim Kerja', 'SEKRETARIAT JENDERAL MPR RI', '2017', 1, '340', 'PIM', 'u', 1, 'ebookdefault.jpg'),
(96, 'MAJELIS PERMUSYAWARATAN RAKYAT REPUBLIK INDONESIA', 'Pimpinan MPR dan Tim Kerja', 'SEKRETARIAT JENDERAL MPR RI', '2017', 1, '340', 'PIM', 'm', 1, 'ebookdefault.jpg'),
(97, 'MAJELIS PERMUSYAWARATAN RAKYAT REPUBLIK INDONESIA', 'Pimpinan MPR dan Tim Kerja', 'SEKRETARIAT JENDERAL MPR RI', '2015', 1, '340', 'PIM', 'm', 1, 'ebookdefault.jpg'),
(98, 'MAJELIS PERMUSYAWARATAN RAKYAT REPUBLIK INDONESIA', 'Pimpinan MPR dan Tim Kerja', 'SEKRETARIAT JENDERAL MPR RI', '2010', 1, '340', 'PIM', 'm', 1, 'ebookdefault.jpg'),
(99, 'UNDANG-UNDANG DASAR NEGERA REPBLIK INDONESIA TAHUN 1945', 'Pimpinan MPR dan Tim Kerja', 'SEKRETARIAT JENDERAL MPR RI', '2008', 1, '340', 'PIM', 'u', 1, 'ebookdefault.jpg'),
(100, 'BAHAN TAYANG MATERI SOSIALISASI EMPAT PILAR MPR RI', 'Pimpinan MPR dan Tim Kerja', 'SEKRETARIAT JENDERAL MPR RI', '2017', 1, '340', 'PIM', 'b', 1, 'ebookdefault.jpg'),
(101, 'Empat Pilar Kehidupan Berbangsa dan Bernegara', 'Pimpinan MPR dan Tim Kerja', 'SEKRETARIAT JENDERAL MPR RI', '2013', 1, '340', 'PIM', 'e', 1, 'ebookdefault.jpg'),
(102, 'Rumus Kilat Kuasain Bahasa Inggris (TENSES AND EXERCISES)', 'Yohanes Mei Setiyanta', 'Buku Pinter Indonesia', '2017', 1, '400', 'YOH', 'r', 1, 'ebookdefault.jpg'),
(103, 'Cerdas Mengelola KEUANGAN KELUARGA', 'Dra. Sulastiningsih', 'Pro-U Media', '2008', 1, '500', 'DRA', 'c', 1, 'ebookdefault.jpg'),
(104, 'MANAJEMEN PROGRAM & TEKNIK PRODUKSI SIARAN RADIO ', 'ASEP SYAMSUL M. ROMLI', 'NUANSA CENDEKIA', '2017', 1, '500', 'ASE', 'm', 1, 'ebookdefault.jpg'),
(105, 'I LOVE YOU DADDY', 'AGUSTINUS HENDRA', 'Gramedia Widiasarana', '2016', 1, '001', 'AGU', 'i', 1, 'ebookdefault.jpg'),
(106, 'PENATAAN PEKARANGAN RUMAH', 'MUNTAZAR', 'INTIMEDIA ', '', 1, '000', 'MUN', 'p', 1, 'ebookdefault.jpg'),
(107, 'MENBUAT RENCANA USAHA', 'Muhammad Musrofi', 'INSAN MADANI', '2008', 1, '000', 'MUH', 'm', 1, 'ebookdefault.jpg'),
(108, 'KIAT SUKSES MENCARI & MELAMAR KERJA', 'Hoeda Manis', 'INDAH Surabaya', '2010', 1, '000', 'HOE', 'K', 1, 'ebookdefault.jpg'),
(109, 'FINANCIAL MANAGEMENT (Cara Pinter Mengelola Uang)', 'Hoeda Manis', 'INDAH Surabaya', '2009', 1, '000', 'HOE', 'f', 1, 'ebookdefault.jpg'),
(110, 'Menangkal Narkoba, HIV dan AIDS, serta Kekerasan', 'Harlina Pribadi', 'REMAJA ROSDAKARYA', '2011', 1, '000', 'HAR', 'm', 1, 'ebookdefault.jpg'),
(111, 'Naskah-Naskah Skriptorium Pakualaman', 'Sri Ratna Saktimulya', 'KPG (Kepustakaan Populer Gramedia)', '2016', 1, '000', 'SRI', 'n', 1, 'ebookdefault.jpg'),
(112, 'Memanen Air Hujan SUMBER BARU  AIR MINUM', 'FG WINARNO', 'KOMPAS GRAMEDIA', '2016', 1, '000', 'FGN', 'm', 1, 'ebookdefault.jpg'),
(113, 'BAHAN TOKSIK dalam Makanan', 'Dr. Ir. ALSUHENDRA, M.Si', 'REMAJA ROSDAKARYA', '2013', 1, '000', 'DII', 'h', 1, 'ebookdefault.jpg'),
(114, 'SERI KESENIAN Kesenian Daerah dan Lagu-Lagu Daerah', 'Cendi Yuliana', 'WIDYA DUTA GRAFIKA', '2008', 1, '700', 'CEN', 's', 1, 'ebookdefault.jpg'),
(115, 'SISTEM AKUNTASI', 'V. WIRATNA SUJARWENI', 'Pustaka Baru Press', '2015', 1, '500', 'VWI', 'p', 1, 'ebookdefault.jpg'),
(116, 'Bahagianya aku \'kan Segera MENJADI AYAH', 'arfian c. atmaja', 'iN-Books', '2010', 1, '300', 'AFR', 'b', 1, 'ebookdefault.jpg'),
(117, 'PENGEMBANGAN SUMBER DAYA MANUSIA', 'PROF. DR. H DJUMHANA PURWANEGARA', 'Art Pustaka', '', 1, '', 'PRO', 'p', 1, 'ebookdefault.jpg'),
(118, 'BUSINESS LETTERS', 'N. A. Huda', 'INDAH ', '2008', 1, '', 'NAH', 'b', 1, 'ebookdefault.jpg'),
(119, 'BUKU PINTER POHON WORTEL', 'Mira Lesmana', 'Study Books', '', 1, '', 'MIR', 'b', 1, 'ebookdefault.jpg'),
(120, 'UUD 1945', 'Tim Setia kawan', 'Setia kawan Press', '2002', 1, '', 'TIM', 'u', 1, 'ebookdefault.jpg'),
(121, 'GOLOK Ciomas Hikayat dan Keistiwaannya', 'Oman Solihin', 'Lembaga Pendidikan Dan Pengembangan Potensi Daya Masyarakat Daerah Banten (LP-3SDMDB)', '2011', 1, '', 'OMA', 'g', 1, 'ebookdefault.jpg'),
(122, 'Boleh Aku Curhat?', 'Nashihatku', 'Salam Books', '2016', 1, '', 'NAS', 'b', 1, 'ebookdefault.jpg'),
(123, 'Why World heritage ', 'Puji Hestiningsih', 'ELEX MEDIA KOMPUTINDO', '2014', 1, '', 'PUJ', 'w', 1, 'ebookdefault.jpg'),
(124, 'AKM SK & SLB', 'TIm Kompas Ilmu', 'Kompas Ilmu', '2021', 1, '', 'TIM', 'a', 1, 'ebookdefault.jpg'),
(125, 'Why Aliens and UFO ', 'Denny Supriyadi', 'ELEX MEDIA KOMPUTINDO', '2011', 1, '', 'DEN', 'w', 1, 'ebookdefault.jpg'),
(126, 'Why Environment', 'Irene Christin', 'ELEX MEDIA KOMPUTINDO', '2010', 1, '', 'IRE', 'w', 1, 'ebookdefault.jpg'),
(127, 'Why Scientific Event', 'Endah Nawang Novianti', 'ELEX MEDIA KOMPUTINDO', '2011', 1, '', 'END', 'w', 1, 'ebookdefault.jpg'),
(128, 'Why Electricity & Electron', 'Endah Nawang Novianti', 'ELEX MEDIA KOMPUTINDO', '2011', 1, '', 'END', 'w', 1, 'ebookdefault.jpg'),
(129, 'Why Anatomy', 'Endah Nawang Novianti', 'ELEX MEDIA KOMPUTINDO', '2015', 1, '', 'END', 'w', 1, 'ebookdefault.jpg'),
(130, 'Why Future Science', 'Endah Nawang Novianti', 'ELEX MEDIA KOMPUTINDO', '2011', 1, '', 'END', 'w', 1, 'ebookdefault.jpg'),
(131, 'Why Disease', 'Deni Supriadi', 'ELEX MEDIA KOMPUTINDO', '2010', 1, '', 'DEN', 'w', 1, 'ebookdefault.jpg'),
(132, 'GONG SMASH!', 'GOL A LONG', 'Epigraf', '2021', 1, '', 'GOL', 'G', 1, 'ebookdefault.jpg'),
(133, 'Balada si Roy', 'GOL A LONG', 'Gramedia Pustaka Utama', '2018', 1, '', 'GOL', 'b', 1, 'ebookdefault.jpg'),
(134, 'Why Chemistry', 'Deni Supriadi & Team', 'ELEX MEDIA KOMPUTINDO', '2010', 1, '', 'DEN', 'w', 1, 'ebookdefault.jpg'),
(135, 'Why Earth', 'Novi dan Dede Sofyant', 'ELEX MEDIA KOMPUTINDO', '2009', 1, '', 'NOV', 'w', 1, 'ebookdefault.jpg'),
(136, 'Why Rockets and Spacecrafts', 'Denny Supriyadi', 'ELEX MEDIA KOMPUTINDO', '2011', 1, '', 'DEN', 'w', 1, 'ebookdefault.jpg'),
(137, 'Why Microscope and Observation', 'Endah Nawang Novianti', 'ELEX MEDIA KOMPUTINDO', '2017', 1, '', 'END', 'w', 1, 'ebookdefault.jpg'),
(138, 'Pendidikan Karakter dalam Metode AKTIF, INOVATIF & KREATIF', 'Retno Listyarti', 'Erlangga', '2012', 1, '', 'RET', 'p', 1, 'ebookdefault.jpg'),
(139, 'Panduan Manajemen PERILAKU SISWA', 'SUE COWLEY', 'Erlangga', '2011', 1, '', 'SUE', 'p', 1, 'ebookdefault.jpg'),
(140, 'PENDIDIKA KARAKTER BANGSA Pendidikan Sekolah Menengah Atas (SMA)', 'Tim Penulis', 'GRIYA WIDYA PUSTAKA', '', 1, '', 'TIM', 'p', 1, 'ebookdefault.jpg'),
(141, 'PROFESIONALISME GURU DALAM PEMBELAJARAN', 'Drs. H. Zainal Aqib, M.Pd.', 'INSAN CENDEKIA', '2010', 1, '', 'DRS', 'p', 1, 'ebookdefault.jpg'),
(142, 'Pendidikan Moral & Budi Pekerti Dalam Perspektif Perubahan', 'Dra. Nurul Zuriah, M.Si.', 'Bumi Aksara', '2015', 1, '', 'DRA', 'p', 1, 'ebookdefault.jpg'),
(143, 'Tak Terlupakan', 'Annita Meilina, ddk.', 'UviMedia', '2021', 1, '', 'ANN', 'p', 1, 'ebookdefault.jpg'),
(144, 'SI Anak Spesial', 'TERE LIYE', 'REPUBLIKA ', '2018', 1, '', 'TER', 's', 1, 'ebookdefault.jpg'),
(145, 'Si Anak Kuat', 'TERE LIYE', 'REPUBLIKA ', '2018', 1, '', 'TER', 's', 1, 'ebookdefault.jpg'),
(146, 'Si Anak Pinter', 'TERE LIYE', 'REPUBLIKA ', '2018', 1, '', 'TER', 's', 1, 'ebookdefault.jpg'),
(147, 'Si Anak Pemberani', 'TERE LIYE', 'REPUBLIKA ', '2018', 1, '', 'TER', 's', 1, 'ebookdefault.jpg'),
(148, 'Si Anak Badai', 'TERE LIYE', 'REPUBLIKA ', '2018', 1, '', 'TER', 's', 1, 'ebookdefault.jpg'),
(149, 'Si Anak Cahaya', 'TERE LIYE', 'REPUBLIKA ', '2018', 1, '', 'TER', 's', 1, 'ebookdefault.jpg'),
(150, 'Seni Rupa & DESAIN UNTUK SMA KELAS XI', 'Agus Sachari', 'Erlangga', '2006', 1, '', 'AGU', 's', 1, 'ebookdefault.jpg'),
(151, 'Menyelidiki Matahari', 'Hs. Mardiyah', 'MUSI PERKASA UTAMA', '2011', 1, '', 'HSM', 'm', 1, 'ebookdefault.jpg'),
(152, 'langkah jitu membuat kompos dari kotoran ternak & sampah', 'Willyan Djaja', 'AgroMedia Pustaka', '2008', 1, '', 'WIL', 'l', 1, 'ebookdefault.jpg'),
(153, 'FISIKA Untuk SMA dan MA Kelas XI', 'Sri Handayani', 'Pusat Perbukuan Departemen Pendidikan Nasional ', '2009', 1, '', 'SRI', 'f', 1, 'ebookdefault.jpg'),
(154, 'Integrasi Budi Pekerti dalam Pendidikan Agama Islam', 'H. UDIN WAHYUDIN', 'BINA SISWA', '2003', 1, '', 'UDI', 'I', 1, 'ebookdefault.jpg'),
(155, 'PERUSAK PERGAULAN & KEPRIBADIAN REMAJA MUSLIM', 'Luqman Haqani', 'PUSKTAKA ULUMUDDIN', '2004', 1, '', 'LUQ', 'p', 1, 'ebookdefault.jpg'),
(156, 'EXO SALAH GAUL SERI 2', 'EviiMbow88', 'Bintang Media', '2015', 1, '', 'EVI', 'e', 1, 'ebookdefault.jpg'),
(157, 'PENGANTAR ILMU GIRI', 'PROF.DR.IR.DEDDY MUCHTADI,MS.', 'ALFABETA ', '2014', 1, '', 'DED', 'p', 1, 'ebookdefault.jpg'),
(158, 'Membentuk Karakter Islam Anak Usia Dini', 'Muhammad Sajirun', 'ERA ADICITRA INTERMEDIA', '2012', 1, '', 'MUH', 'm', 1, 'ebookdefault.jpg'),
(159, 'ILMU BAHASA INDONESIA MORFOLOGI Teori dan Sejumput Problematik Terapannya', 'Iyo Mulyono', 'YRAMA WIDYA', '2013', 1, '', 'IYO', 'i', 1, 'ebookdefault.jpg'),
(160, 'NARKOBA Ranjau Remaja', 'Enung Eliawati', 'Wahana Iptek  Bandung', '', 1, '', 'ENU', 'n', 1, 'ebookdefault.jpg'),
(161, 'LENGKAP UUD 45 DAN AMANDEMEN-AMANDEMENNYA', 'Tim Redaksi', 'Laksana', '2013', 1, '', 'TIM', 'l', 1, 'ebookdefault.jpg'),
(162, 'SOSIOLOGI Untuk SMA/MA Kelas X Kelompok Peminataan Ilmu-Ilmu Sosial', 'Idianto Muin', 'Erlangga', '2013', 1, '', 'IDI', 's', 1, 'ebookdefault.jpg'),
(163, 'Buku Guru SOSIOLOGI untuk SMA-MA Kelas X', 'Slamet Triyono', 'SRIKANDI EMPAT WIDYA UTAMA', '2014', 1, '', 'SLA', 'b', 1, 'ebookdefault.jpg'),
(164, 'Mari Berkebun Tomat', 'Suraniningsih', 'SINAR CEMERLANG ABADI', '', 1, '', 'SUR', 'm', 1, 'ebookdefault.jpg'),
(165, 'Memperbaiki dan Merakit Kompter Sendiri', 'TUTANG, MM', 'MUSTIKA ILMU', '2015', 1, '', 'TUT', 'm', 1, 'ebookdefault.jpg'),
(166, 'Merawat dan Meperbaiki LAPTOP SENDIRI', 'TUTANG, MM', 'MUSTIKA ILMU', '2015', 1, '', 'TUT', 'm', 1, 'ebookdefault.jpg'),
(167, 'PENDIDIKAN IPS Filosofi, Konsep dan Aplikasi', 'Dr. Rudy Gunawan, M.Pd.', 'ALFABETA ', '2016', 1, '', 'RUD', 'm', 1, 'ebookdefault.jpg'),
(168, 'AKUNTASI BIAYA Teori & penerapannya', 'V. WIRATNA SUJARWENI', 'Pustaka Baru Press', '2015', 1, '', 'VWI', 'a', 1, 'ebookdefault.jpg'),
(169, 'KAMUS LENGKAP BAHASA INDONESIA', 'Em Zul Fajri', 'DIFA PUBLISHER', '2008', 1, '', 'ZUL', 'k', 1, 'ebookdefault.jpg'),
(170, 'Ragam Pusaka Budaya BANTEN', 'Prof. Dr. Uka Tjandrasasmita', 'DINAS PENDIDIKAN PROVINSI BANTEN', '2017', 1, '', 'UKA', 'r', 1, 'ebookdefault.jpg'),
(171, 'SEJARAH NASIONAL INDONESIA', 'Marwati Djoened Poesponegoro', 'Balai Pustaka', '2008', 1, '', 'MAR', 's', 1, 'ebookdefault.jpg'),
(172, 'Cara cepat menguasai Tenses', 'M.M. Abdullah, S.Pd', 'Sandro Jaya', '', 0, '420', 'ABD', 'c', 1, 'ebookdefault.jpg'),
(173, 'Cara cepat dan tepat menguasai tenses', 'Drs. Budiono', 'Bintang Indonesia', '', 0, '420', 'BUD', 'C', 1, 'ebookdefault.jpg'),
(174, 'Kumpulan Lengkap Lagu Wajib', 'Drs. Thursan Hakim', 'Bintang Indo Jakarta', '', 0, '', '', '', 1, 'ebookdefault.jpg'),
(175, 'Spring id London', 'Ilana tan', 'Gramedia Pustaka Utama', '2012', 1, '899.221.3', 'ILA', 's', 2, 'ebookdefault.jpg'),
(176, '99 CAHAYA DI LANGIT EROPA', 'Hanum Salsabiela Rais & Rangga Almahendra', 'Gramedia Pustaka Utama', '2014', 1, '899.221.3', 'HAN', '9', 2, 'ebookdefault.jpg'),
(177, 'KAPAS-KAPAS DI LANGIT', 'PIPIET SENJA', 'Zikrul Hakim', '2003', 1, '899.221.3', 'PIP', 'k', 2, 'ebookdefault.jpg'),
(178, 'Dalam Mihrab Cinta ', 'HABIBURRAHMAN EL SHIRANZY', 'Republika', '2007', 1, '899.221.3', 'HAB', 'd', 2, 'ebookdefault.jpg'),
(179, 'Tapak Jejek', 'Fiersa Besari', 'MediaKita', '2019', 1, '899.221.3', 'FIE', 't', 2, 'ebookdefault.jpg'),
(180, 'Hijrahku', 'Indari Mastuti', 'Indscript Creative', '2020', 1, '899.221.3', 'IND', 'h', 2, 'ebookdefault.jpg'),
(181, 'Dalam Mihrab Cinta (THE ROMANCE)', 'HABIBURRAHMAN EL SHIRANZY', 'Ihwah Publishing House', '2010', 1, '899.221.3', 'HAB', 'd', 2, 'ebookdefault.jpg'),
(182, 'Baby Come Home', 'STEPHANIE BOND', 'Gramedia Pustaka Utama', '2015', 1, '899.221.3', 'STE', 'b', 2, 'ebookdefault.jpg'),
(183, 'Habis Gelap Terbitlah Terang', 'Armijn Pane', 'Balai Pustaka', '2008', 1, '899.221.3', 'ARM', 'h', 2, 'ebookdefault.jpg'),
(184, 'Aku Mendengar, Istanbul', 'Bernando J.Subjibto', 'DIVA Press', '2019', 1, '899.221.3', 'BER', 'a', 2, 'ebookdefault.jpg'),
(185, 'Rentang Kisah', 'GITA SAVITRI DEVI', 'GagasMedia', '2018', 1, '899.221.3', 'GIT', 'r', 2, 'ebookdefault.jpg'),
(186, 'HUJA BULAN JUNI', 'SAPARDI DJOKO DAMONO', 'Gramedia Pustaka Utama', '2015', 1, '899.221.3', 'SAP', 'h', 2, 'ebookdefault.jpg'),
(187, 'Senyum Yasmin', 'Ajeng Sastra', 'Zettu', '', 1, '899.221.3', 'AJE', 's', 2, 'ebookdefault.jpg'),
(188, 'Islamic Paranting', 'M. Fauzi Rachman', 'Erlangga', '2011', 1, '899.221.3', 'MFA', 'i', 2, 'ebookdefault.jpg'),
(189, 'Selalu Ada Kapal Untuk Pulang', 'Randu Alamsyah', 'DIVA Press', '2013', 1, '899.221.3', 'RAN', 's', 2, 'ebookdefault.jpg'),
(190, 'Hafalan Shalat Delisa', 'Tere Liye', 'Pustaka Abdi Negara', '2019', 1, '899.221.3', 'TER', 'h', 2, 'ebookdefault.jpg'),
(191, 'Cacatan Hati Seorang Gadis', 'Asma Nadia', 'Publishing House', '2016', 1, '899.221.3', 'ASM', 'c', 2, 'ebookdefault.jpg'),
(192, 'Hawa Ratu Surga Ibunda Manusia', 'NAZAN BEKIROGLU', 'Kaysa Media', '2019', 1, '899.221.3', 'NAZ', 'h', 2, 'ebookdefault.jpg'),
(193, 'Tahajud Cinta Di Kota New York', 'Arumi. E', 'Zettu', '', 1, '899.221.3', 'ARU', 't', 2, 'ebookdefault.jpg'),
(194, 'Bidadari Bermata Bening', 'HABIBURRAHMAN EL SHIRANZY', 'Republika', '2017', 1, '899.221.3', 'HAB', 'b', 2, 'ebookdefault.jpg'),
(195, 'Pacar Akhwat', 'Syamsa Hawa', 'cakrawala', '2004', 1, '899.221.3', 'SYA', 'p', 2, 'ebookdefault.jpg'),
(196, 'Siti Nurbaya', 'Marah Rusli', 'Balai Pustaka', '1992', 1, '899.221.3', 'MAR', 's', 2, 'ebookdefault.jpg'),
(197, 'my broken flower', 'park moonlight', 'Zettu', '2012', 1, '899.221.3', 'PAR', 'm', 2, 'ebookdefault.jpg'),
(198, 'Sang Pemimpi', 'Andrea Hinata', 'Bentang Pustaka', '2012', 1, '899.221.3', 'AND', 's', 2, 'ebookdefault.jpg'),
(199, 'Wajah Tanpa Make -Up', 'Mina Yunus', 'Daaruttauzi\'Wannashr Al-Islamiyyah', '1994', 1, '899.221.3', 'MIN', 'w', 2, 'ebookdefault.jpg'),
(200, 'Ingin Bercinta', 'Nyi Penengah Dewanti & Nikmatusai', 'Zettu', '2014', 1, '899.221.3', 'NYI', 'i', 2, 'ebookdefault.jpg'),
(201, 'Jantung Hatiku', 'Damai Pandu Nata', 'Zettu', '2013', 1, '899.221.3', 'DAM', 'j', 2, 'ebookdefault.jpg'),
(202, 'Winter In Tokyo', 'Ilana tan', 'Gramedia Pustaka Utama', '2012', 1, '899.221.3', 'ILA', 'w', 2, 'ebookdefault.jpg'),
(203, 'THE BEST LAID PLANS', 'SIDNEY SHELDON', 'Gramedia Pustaka Utama', '2009', 1, '899.221.3', 'SID', 't', 2, 'ebookdefault.jpg'),
(204, 'Pacar Bohongan', 'Nikmatusai', 'Zettu', '2014', 1, '899.221.3', 'NIK', 'p', 2, 'ebookdefault.jpg'),
(205, 'Cinta Gangga', 'Shaheer Khan', 'Euthenia', '2016', 1, '899.221.3', 'SHA', 'c', 2, 'ebookdefault.jpg'),
(206, 'Dungeon', 'Theresia D.R. Pratiwi', 'Grasindo', '2006', 1, '899.221.3', 'THE', 'd', 2, 'ebookdefault.jpg'),
(207, 'Harga Sebuah Maaf ', 'Karyani Rukman', 'Dinas Pendidikan Provinsi Banten', '2012', 1, '899.221.3', 'KAR', 'h', 2, 'ebookdefault.jpg'),
(208, 'Burung-Burung Cahaya', 'Jusuf A.N.', 'SABIL', '2011', 1, '899.221.3', 'JUS', 'b', 2, 'ebookdefault.jpg'),
(209, 'Bersujud Dalam Keheningan ', 'Abu Al-Hamidy', 'Mizan Publika', '2007', 1, '899.221.3', 'ABU', 'b', 2, 'ebookdefault.jpg'),
(210, 'King', 'Iwok Abqary', 'Gradien Mediatama', '2009', 1, '899.221.3', 'IWO', 'k', 2, 'ebookdefault.jpg'),
(211, 'Pesan Dalam Bisu', 'Mae', 'Rumah Oranye', '2013', 1, '899.221.3', 'MAE', 'p', 2, 'ebookdefault.jpg'),
(212, '101 Kisah Orang-orang yang dikabulkan Do\'anya', 'Majdi Fathi As-Sayyid', 'Buku Islam Rahmatan', '2018', 1, '899.221.3', 'MAJ', 'o', 2, 'ebookdefault.jpg'),
(213, 'Mahakarya Cinta', 'El-Fachrudin Suhaemi', 'Gong Publishing', '2016', 1, '899.221.3', 'FAC', 'm', 2, 'ebookdefault.jpg'),
(214, 'Pocong Juga Pocong', 'Anwar Syafrani', 'Bukune', '2011', 1, '899.221.3', 'ANW', 'p', 2, 'ebookdefault.jpg'),
(215, 'TALL,THIN and BLONDE', 'Dyan Sheldon', 'Gramedia Pustaka Utama', '2004', 1, '899.221.3', 'DYA', 't', 2, 'ebookdefault.jpg'),
(216, 'AYAH', 'Andrea Hirata', 'Bentang Pustaka', '2015', 1, '899.221.3', 'AND', 'a', 2, 'ebookdefault.jpg'),
(217, 'Merindu Baginda Nabi', 'HABIBURRAHMAN EL SHIRANZY', 'Republika', '1992', 1, '899.221.3', 'HAB', 'm', 2, 'ebookdefault.jpg'),
(218, 'Wajah Baru Nikolas', 'Regina Feby & Elcy Anastasia', 'Gramedia Pustaka Utama', '2006', 1, '899.221.3', 'REG', 'w', 2, 'ebookdefault.jpg'),
(219, 'Once Upon a Love', 'ADITIA YUDIS', 'GagasMedia', '2012', 1, '899.221.3', 'ADI', 'o', 2, 'ebookdefault.jpg'),
(220, 'The Last Exam', 'Sucia Ramadhani', 'Mizan Media Utama', '2012', 1, '899.221.3', 'SUC', 't', 2, 'ebookdefault.jpg'),
(221, 'Jejak Sang Pencerah', 'Didik L. Hariri', 'Best Media Utama', '2010', 1, '899.221.3', 'DID', 'j', 2, 'ebookdefault.jpg'),
(222, 'Melodylan ', 'Asriaci', 'Bumi Semesta Madia', '2017', 1, '899.221.3', 'ASR', 'm', 2, 'ebookdefault.jpg'),
(223, 'Ketua Kelas', 'Sang Ayu Gita', 'Bukune', '2017', 1, '899.221.3', 'SAN', 'k', 2, 'ebookdefault.jpg'),
(224, 'Surga Kecil di Atas Awan', 'Kirana Kejora', 'Euthenia', '2015', 1, '899.221.3', 'KIR', 's', 2, 'ebookdefault.jpg'),
(225, 'DETEKTIF KONYOL TERJEBAK DI SARANG POCONG', 'Rudiyant', 'JAL publishing', '2012', 1, '899.221.3', 'RUD', 'd', 2, 'ebookdefault.jpg'),
(226, 'Saat Langit & Bumi Bercumbu', 'Wiwid Prasetyo', 'DIVA Press', '2012', 1, '899.221.3', 'WIW', 's', 2, 'ebookdefault.jpg'),
(227, 'AROK DEDES', 'Pramoedya Ananta Toer', 'LENTERA DIPANTARA', '2009', 1, '899.221.3', 'PRA', 'a', 2, 'ebookdefault.jpg'),
(228, 'JATUH CINTA ITU NGGAK HARAM KOK', 'Muhammad Muhyidin', 'DIVA Press', '2005', 1, '899.221.3', 'MUH', 'j', 2, 'ebookdefault.jpg'),
(229, 'dari ave maria ke jalan lain ke roma', 'IDRUS', 'Balai Pustaka', '2010', 1, '899.221.3', 'IDR', 'd', 2, 'ebookdefault.jpg'),
(230, 'High School Love Story', 'Haula S.', 'Bentang Pustaka', '2018', 1, '899.221.3', 'HAU', 'h', 2, 'ebookdefault.jpg'),
(231, 'My Favorite Good Bye', 'Nuril Basri', 'GagasMedia', '2015', 1, '899.221.3', 'NUR', 'm', 2, 'ebookdefault.jpg'),
(232, 'Memoritmo', 'Anto Arief', 'Bukune', '2012', 1, '899.221.3', 'ANT', 'm', 2, 'ebookdefault.jpg'),
(233, 'Akulah Malaikat Hatimu', 'Ratna. DKS', 'Euthenia', '2014', 1, '899.221.3', 'RAT', 'a', 2, 'ebookdefault.jpg'),
(234, 'Meretas Ungu', 'PIPIET SENJA', 'Gema Insani', '2005', 1, '899.221.3', 'PIP', 'm', 2, 'ebookdefault.jpg'),
(235, 'Dear Jan Love Ruth', 'Nick Mclver', 'DIAN RAKYAT', '2003', 1, '899.221.3', 'NIC', 'd', 2, 'ebookdefault.jpg'),
(236, 'MEREDAM DENDAM', 'GERSON POYK', 'KAKILANGIT KENCANA', '2009', 1, '899.221.3', 'GER', 'm', 2, 'ebookdefault.jpg'),
(237, 'Power of Love', 'Dr. Aidh bin Abdullah Al-Qarni', 'Zikrul Hakim', '2005', 1, '899.221.3', 'AID', 'p', 2, 'ebookdefault.jpg'),
(238, 'White Sunset', 'Nikmatusai', 'Euthenia', '2016', 1, '899.221.3', 'NIK', 'w', 2, 'ebookdefault.jpg'),
(239, 'Anak Rantau', 'A. Fuadi', 'Falcon', '2017', 1, '899.221.3', 'FUA', 'a', 2, 'ebookdefault.jpg'),
(240, 'Moga Bunda Disayang Allah', 'Tere Liye', 'Republika', '2006', 1, '899.221.3', 'TER', 'm', 2, 'ebookdefault.jpg'),
(241, '2045', 'ANWAR WIDJOJO', 'Kurniaesa Publishing', '2011', 1, '899.221.3', 'ANW', '2', 2, 'ebookdefault.jpg'),
(242, 'Ken Arok Cinta dan Takhta', 'Zhaenal Fanani', 'TIga Serangkai Pustaka Mandiri', '2013', 1, '899.221.3', 'ZHA', 'k', 2, 'ebookdefault.jpg'),
(243, 'THE LORD OF THE RINGS THE RETURN OF THE KING', 'J.R.R. Tolkien', 'Gramedia Pustaka Utama', '2003', 1, '899.221.3', 'TOL', 't', 2, 'ebookdefault.jpg'),
(244, 'Si Anak Singkong', 'Chairul Tanjung', 'Buku Kompas', '2012', 1, '899.221.3', 'CHA', 's', 2, 'ebookdefault.jpg'),
(245, 'Ada Tasbih di Hati Aisya', 'Wien Oktadatu Setyawati', 'NAJAH', '2013', 1, '899.221.3', 'WIE', 'a', 2, 'ebookdefault.jpg'),
(246, 'Shitlicious', 'Alit Susanto', 'Gradien Mediatama', '2010', 1, '899.221.3', 'ALI', 's', 2, 'ebookdefault.jpg'),
(247, 'HOAKAIAU DI INDONESIA', 'Pramoedya Ananta Toer', 'Garba Budaya', '1998', 1, '899.221.3', 'PRA', 'h', 2, 'ebookdefault.jpg'),
(248, 'Drunken Marmut', 'PIdi Baiq', 'Mizan Media Utama', '2015', 1, '899.221.3', 'PID', 'd', 2, 'ebookdefault.jpg'),
(249, 'Jejak Halefa', 'Md. Aminudin', 'Salsabila', '2013', 1, '899.221.3', 'AMI', 'j', 2, 'ebookdefault.jpg'),
(250, 'PRAGMATIK', 'GEORGE YULE', 'PUSTAKA PELAJAR', '2014', 1, '899.221.3', 'GEO', 'p', 2, 'ebookdefault.jpg'),
(251, 'Laptop Ajaib', 'Nelfi Syafria', 'Lini Zikrul Kids', '2007', 1, '899.221.3', 'NEL', 'l', 2, 'ebookdefault.jpg'),
(252, 'CInta Beda Kasta', 'Eidelweis Almira', 'Zettu', '2014', 1, '899.221.3', 'EID', 'c', 2, 'ebookdefault.jpg'),
(253, 'MIXED FEELINGS', 'Kerry Allyne', '', '1981', 1, '899.221.3', 'KER', 'm', 2, 'ebookdefault.jpg'),
(254, 'Cinta Selamanya', 'Eidelweis Almira', 'Zettu', '2014', 1, '899.221.3', 'EID', 'c', 2, 'ebookdefault.jpg'),
(255, 'Sitti Nurbaya', 'Marah Rusli', 'Balai Pustaka', '1922', 1, '899.221.3', 'MAR', 's', 2, 'ebookdefault.jpg'),
(256, 'Nightmare', 'TIm Nightmare Side Ardan', 'Bukune', '2011', 1, '899.221.3', 'TIM', 'n', 2, 'ebookdefault.jpg'),
(257, 'Surga Yang Tak Dirindukan', 'Asma Nadia', 'AsmaNadia Publishing House', '2016', 1, '899.221.3', 'ASM', 's', 2, 'ebookdefault.jpg'),
(258, 'NI ANTEH PERGI KE BULAN', 'Yulia Sukardi', 'NUANSA AULIA', '2006', 1, '899.221.3', 'YUL', 'n', 2, 'ebookdefault.jpg'),
(259, 'THE MIRROR, THE CANDLE and THE FLUTE', 'SHEULA K. McCULLAGH M.A.', '', '1958', 1, '899.221.3', 'SHE', 't', 2, 'ebookdefault.jpg'),
(260, 'WOODLANDERS', 'Tmomas Hardy', 'DIAN RAKYAT', '2003', 1, '899.221.3', 'THO', 't', 2, 'ebookdefault.jpg'),
(261, 'CINTA DALAM SUJUDKU', 'PIPIET SENJA', 'Lixima Metro Media', '2013', 1, '899.221.3', 'PIP', 'c', 2, 'ebookdefault.jpg'),
(262, 'ARUS BALIK', 'Pramoedya Ananta Toer', 'HASTA MITRA', '1995', 1, '899.221.3', 'PRA', 'a', 2, 'ebookdefault.jpg'),
(263, 'Mencintaimu di Jannah ', 'Ullah Pralihanta', 'Zettu', '2013', 1, '899.221.3', 'ULL', 'm', 2, 'ebookdefault.jpg'),
(264, 'Syair Sultan Syarif', 'SITI ZAAHRA YUNDIAFI', 'Pusat Bahasa', '2010', 1, '899.221.3', 'SIT', 'S', 2, 'ebookdefault.jpg'),
(265, 'Putri Sirkus dan Lelaki Penjual Dongeng ', 'Jostien Gaarder', 'Mizan Media Utama', '2006', 1, '899.221.3', 'JOS', 'p', 2, 'ebookdefault.jpg'),
(266, 'Air Mata Kasih', 'Taufiqurrahman al-Azizy', 'Kartini Publishing', '2008', 1, '899.221.3', 'TAU', 'a', 2, 'ebookdefault.jpg'),
(267, 'Jomblo', 'ADHITYA MULYA', 'Falcon', '2017', 1, '899.221.3', 'ADH', 'j', 2, 'ebookdefault.jpg'),
(268, 'KETIKA TUHAN JATUH CINTA (2)', 'Wahyu Sujanji', 'DIVA Press', '2010', 1, '899.221.3', 'WAH', 'k', 2, 'ebookdefault.jpg'),
(269, 'KALAU TAK UNTUNG ', 'Selasih', 'BALAI PUSTAKA', '1992', 1, '899.221.3', 'SEL', 'k', 2, 'ebookdefault.jpg'),
(270, 'TENGGELAMNYA KAPAL VAN DER WIJCK', 'HAMKA', 'Bulan Bintang', '1976', 1, '899.221.3', 'HAM', 't', 2, 'ebookdefault.jpg'),
(271, 'Rindu Purnama', 'TASARO G.K.', 'Bentang Pustaka', '2011', 1, '899.221.3', 'TAS', 'r', 2, 'ebookdefault.jpg'),
(272, 'ASA AYUNI', 'Dyah Rinni', 'Falcon', '2016', 1, '899.221.3', 'DYA', 'a', 2, 'ebookdefault.jpg'),
(273, 'Subject : Re :', 'Novita Estiti', 'GagasMedia', '2004', 1, '899.221.3', 'NOV', 's', 2, 'ebookdefault.jpg'),
(274, 'PERRJALANAN', 'Drs. Arif Tahri Badri', 'GP Soft', '2014', 1, '899.221.3', 'DRS', 'p', 2, 'ebookdefault.jpg'),
(275, 'HAJI BACK PACKER', 'AGUK IRAWAN MN', 'Maleo Creative', '2014', 1, '899.221.3', 'AGU', 'h', 2, 'ebookdefault.jpg'),
(276, '2', 'Donny Dhirgantoro', 'GRASINDO', '2002', 1, '899.221.3', 'DON', '2', 2, 'ebookdefault.jpg'),
(277, 'Dilan 1990', 'Pidi Baiq', 'Mizan Media Utama', '2016', 1, '899.221.3', 'PID', 'd', 2, 'ebookdefault.jpg'),
(278, 'Hawa', 'NAZAN BEKIROGLU', 'KAYSA MEDIA', '2019', 1, '899.221.3', 'NAZ', 'h', 2, 'ebookdefault.jpg'),
(279, 'Cinta di Dalam Gelas', 'Andrea Hirata', 'Bentang Pustaka', '2016', 1, '899.221.3', 'AND', 'c', 2, 'ebookdefault.jpg'),
(280, 'Satria', 'ADITYA SURYA PRATAMA', 'Anugrah', '2018', 1, '899.221.3', 'ADI', 's', 2, 'ebookdefault.jpg'),
(281, 'FLASH! FLASH! FLASH!', 'Blogfam', 'Gradien Books', '2017', 1, '899.221.3', 'BLO', 'f', 2, 'ebookdefault.jpg'),
(282, 'Cinta yang Kuberi', 'ERIZELI BANDARO', 'WIRA MULIA TECHNOLOGY', '2015', 1, '899.221.3', 'ERI', 'c', 2, 'ebookdefault.jpg'),
(283, 'MATAHARI ', 'Tere Liye', 'Gramedia Pustaka Utama', '2016', 1, '899.221.3', 'TER', 'm', 2, 'ebookdefault.jpg'),
(284, 'Habis Gelap Terbitlah Terang', 'Armijin Pane', 'BALAI PUSTAKA', '2008', 1, '899.221.3', 'ARM', 'h', 2, 'ebookdefault.jpg'),
(285, 'SEBUAH SENI UNTUK BERSIKAP BODO AMAT', 'MARK MANSON', 'Gramedia', '2018', 1, '899.221.3', 'MAR', 's', 2, 'ebookdefault.jpg'),
(286, 'SALANK NGGAK ADA MATINYA', 'Moammar Emka & Cassandra Massardi', 'Entar!Media', '2014', 1, '899.221.3', 'MOA', 's', 2, 'ebookdefault.jpg'),
(287, 'Mencintai Dengan Sederhana ', 'Reny Supelli', 'Pustaka IIMAN', '2015', 1, '899.221.3', 'REN', 'm', 2, 'ebookdefault.jpg'),
(288, 'THE ROMANCE', 'HABIBURRAHMAN EL SHIRANZY', 'Ihwah Publishing House', '2010', 1, '899.221.3', 'HAB', 't', 2, 'ebookdefault.jpg'),
(289, 'Senyum Tuhan di Barcelona ', 'Wiwid Prasetyo', 'DIVA Press', '2012', 1, '899.221.3', 'WIW', 's', 2, 'ebookdefault.jpg'),
(290, 'KOALA KUMAL', 'RADITYA DIKA ', 'GagasMedia', '2014', 1, '899.221.3', 'RAD', 'k', 2, 'ebookdefault.jpg'),
(291, 'Azab dan Sengsara', 'MERARI SIREGAR', 'BALAI PUSTAKA', '1920', 1, '899.221.3', 'MER', 'a', 2, 'ebookdefault.jpg'),
(292, 'ONEIRA CHRUSE AND ARES\' EYES CUBE', 'Febry Reyzky', 'Tiga Serangkai', '2015', 1, '899.221.3', 'FEB', 'o', 2, 'ebookdefault.jpg'),
(293, 'Cinta Sepanjang Waktu', 'Eidelweis Almira', 'Zettu', '2014', 1, '899.221.3', 'EID', 'c', 2, 'ebookdefault.jpg'),
(294, 'Who Cau Den Love', 'BARBARA CARTLAND', 'Gramedia Pustaka Utama', '2001', 1, '899.221.3', 'BAR', 'w', 2, 'ebookdefault.jpg'),
(295, 'Atheis', 'Achdiat Karta Miharja', 'BALAI PUSTAKA', '2009', 1, '899.221.3', 'ACH', 'a', 2, 'ebookdefault.jpg'),
(296, 'THE GAME OF TWO QUESTS', 'MAURICE LEBLANG', 'Transmedia Pustaka', '2012', 1, '899.221.3', 'MAU', 's', 2, 'ebookdefault.jpg'),
(297, 'Kimmy Puzzle', 'Kezia Evi Wiadji', 'MEDIA PRESSINDO', '2014', 1, '899.221.3', 'KEZ', 'k', 2, 'ebookdefault.jpg'),
(298, 'Surga Yang Harus Kujaga', 'Sean Hasyim', 'Euthenia', '2016', 1, '899.221.3', 'SEA', 's', 2, 'ebookdefault.jpg'),
(299, 'MARS', 'Aishworo Ang', 'Safirah', '2011', 1, '899.221.3', 'AIS', 'm', 2, 'ebookdefault.jpg'),
(300, 'UBUR-UBUR LEMBUR', 'RADITYA DIKA ', 'GagasMedia', '2018', 1, '899.221.3', 'RAD', 'u', 2, 'ebookdefault.jpg'),
(301, 'Pacar 7 Jam', 'Devy Yuliastri Kurnia Putri', 'Zettu', '2014', 1, '899.221.3', 'DEV', 'p', 2, 'ebookdefault.jpg'),
(302, 'Protect The School', 'Kim Chi Nee', 'Sheila', '2015', 1, '899.221.3', 'KIM', 'p', 2, 'ebookdefault.jpg'),
(303, 'Masa Lalu yang Tertinggal', 'RIri Anshar', 'Euthenia', '2014', 1, '899.221.3', 'RIR', 'm', 2, 'ebookdefault.jpg'),
(304, 'Pudar', 'Anif Khasanah', 'GagasMedia', '2013', 1, '899.221.3', 'ANI', 'p', 2, 'ebookdefault.jpg'),
(305, 'BALI To REMEMBER', 'Erlin Cahyadi', 'Gramedia Pustaka Utama', '2012', 1, '899.221.3', 'ERL', 'b', 2, 'ebookdefault.jpg'),
(306, 'HEARTSTOPPER', 'JOY FIELDING', 'Gramedia Pustaka Utama', '2011', 1, '899.221.3', 'JOY', 'h', 2, 'ebookdefault.jpg'),
(307, 'Istikharah Cinta', 'Kinoysan', 'Lingkar Pena Kreativa', '2007', 1, '899.221.3', 'KIN', 'i', 2, 'ebookdefault.jpg'),
(308, 'SENI Membuat HIDUP Jadi Lebih RINGAN', 'FRANCINE JAY', 'Gramedia Pustaka Utama', '2019', 1, '899.221.3', 'FRA', 's', 2, 'ebookdefault.jpg'),
(309, 'Be Clam Be Strong Be Grateful', 'Wirda Mansur', 'KataDepan', '2017', 1, '899.221.3', 'WIR', 'b', 2, 'ebookdefault.jpg'),
(310, 'Lampau', 'SANDI FIRLY', 'GagasMedia', '2013', 1, '899.221.3', 'SAN', 'l', 2, 'ebookdefault.jpg'),
(311, 'GilakPedia', 'Chilmi Muhammad', 'de TEENS', '2013', 1, '899.221.3', 'CHI', 'g', 2, 'ebookdefault.jpg'),
(312, 'Lost & Found', 'Sisca Spencer Hoky', 'GagasMedia', '2013', 1, '899.221.3', 'SIS', 'l', 2, 'ebookdefault.jpg'),
(313, 'Seubuah Lagu untuk Tuhan', 'Agnes Davonar', 'INTI PUBLISHER', '2015', 1, '899.221.3', 'AGN', 's', 2, 'ebookdefault.jpg'),
(314, 'Milea', 'Pidi Baiq', 'Mizan Media', '2016', 1, '899.221.3', 'PID', 'm', 2, 'ebookdefault.jpg'),
(315, 'LELAKON', 'LAN FANG', 'Gramedia Pustaka Utama', '2007', 1, '899.221.3', 'LAN', 'l', 2, 'ebookdefault.jpg'),
(316, 'METER/SECOND', 'Debbie Widjaja', 'Gramedia Pustaka Utama', '2013', 1, '899.221.3', 'DEB', 'm', 2, 'ebookdefault.jpg'),
(317, 'NIkah Dini Keren! 2', 'Haekal Siregar', 'Divi Zikrul Remaja', '2005', 1, '899.221.3', 'HAE', 'n', 2, 'ebookdefault.jpg'),
(318, 'Cherrybelle CRUSH', 'Brainstorm Inc. TEAM', 'Buku PInter Indonesia', '2014', 1, '899.221.3', 'BRA', 'c', 2, 'ebookdefault.jpg'),
(319, 'PARAKANG', 'Abu Hamzah', 'Gramedia Pustaka Utama', '2016', 1, '899.221.3', 'ABU', 'p', 2, 'ebookdefault.jpg'),
(320, 'BOLEH AKU CURHAT', 'Nishihatku', 'Salam Books', '2016', 1, '899.221.3', 'NIS', 'b', 2, 'ebookdefault.jpg'),
(321, 'Perempuan-Perempuan Tersayang', 'Okke \'Sepatumerah\'', 'GagasMedia', '2015', 1, '899.221.3', 'OKK', 'P', 2, 'ebookdefault.jpg'),
(322, 'TSUNDERELLA 2015 Kebahagiaan yang sesungguhnya', 'Queen Nakey', 'Diandra Kreatif', '2016', 1, '899.221.3', 'QUE', 't', 2, 'ebookdefault.jpg'),
(323, 'TIPU DAYA SANG TAIPAN', 'CAROL MARINELLI', 'Gramedia Pustaka Utama', '2009', 1, '899.221.3', 'CAR', 't', 2, 'ebookdefault.jpg'),
(324, 'JENGHIS KHAN', 'John Man', 'Pustaka Alvabet', '2004', 1, '899.221.3', 'JOH', 'h', 2, 'ebookdefault.jpg'),
(325, 'Kicau Kacau', 'INDRA HERLAMBANG', 'Gramedia Pustaka Utama', '2011', 1, '899.221.3', 'IND', 'k', 2, 'ebookdefault.jpg'),
(326, 'The True Love in America', 'M. Syamsi Ali, M.A', 'GEMA INSANI', '2009', 1, '899.221.3', 'MSY', 't', 2, 'ebookdefault.jpg'),
(327, 'Angan', 'Sophie Maya', 'Bukune', '2013', 1, '899.221.3', 'SOP', 'a', 2, 'ebookdefault.jpg'),
(328, 'Berjuta Rasanya', 'TERE Liye', 'Mahaka Publishing', '2012', 1, '899.221.3', 'TER', 'b', 2, 'ebookdefault.jpg'),
(329, 'Rahasia Sunyi', 'Brahmanto Anindito', 'GagasMedia', '2012', 1, '899.221.3', 'BRA', 'r', 2, 'ebookdefault.jpg'),
(330, 'Surat Kecil Untuk Tuhan', 'Agnes Davonar', 'AGNESDAVONAR PUBLISHING', '2012', 1, '899.221.3', 'AGN', 's', 2, 'ebookdefault.jpg'),
(331, 'TIKIL- TITIPAN KILAT Kami antar, Kami Nyasar', 'Iwok Abqary', 'GagasMedia', '2008', 1, '899.221.3', 'IWO', 't', 2, 'ebookdefault.jpg'),
(332, 'CERITA DAPON DARI PESISIR SELATAN', 'SONNY AL-BAREGBEGI', 'Wawasan Ilmu', '2021', 1, '899.221.3', 'SON', 'c', 2, 'ebookdefault.jpg'),
(333, 'THANK YOU PROBLEM', 'Yudy Effendy', 'Atsaurah Press', '2006', 1, '899.221.3', 'YUD', 't', 2, 'ebookdefault.jpg'),
(334, 'Akhwat Excellent', 'Mazaya Hasyima\'', 'Smart Media', '2017', 1, '899.221.3', 'MAZ', 'a', 2, 'ebookdefault.jpg'),
(335, 'KAUM MUDA MENATAP MASA DEPAN INDONESIA', 'Dr. Aziz Syamsuddin', 'RMBOOKS', '2010', 1, '899.221.3', 'DRA', 'k', 2, 'ebookdefault.jpg'),
(336, 'TOLONG,MAAF, TERIMA KASIH', 'Salman Ali Rofiq', 'Noktah', '2019', 1, '899.221.3', 'SAL', 't', 2, 'ebookdefault.jpg'),
(337, 'Inspirasi Sahabat', 'Fia Afiati Nuramariah,dkk', 'CV. Insan Paripurna', '2021', 1, '899.221.3', 'FIA', 'i', 2, 'ebookdefault.jpg'),
(338, 'PRAJA MUDA KARANA INDONESIA MENGENAL GERAKAN PRAMUKA DAN KEPANDUAN 1', 'Anton Kristiandi', 'Borobudur, Inspira Nusantara', '2014', 6, '001', 'ANT', 'e l', 3, 'ebookdefault.jpg'),
(339, 'PRAMUKA TANGGUH DAN TRAMPIL MATERI DASAR KECAKAPAN DAN KETERAMPILAN ANGGOTA PRAMUKA 2', 'Anton Kristiandi', 'Borobudur, Inspira Nusantara', '2014', 6, '001', 'ANT', 'e II', 3, 'ebookdefault.jpg'),
(340, 'PRAMUKA CINTA ALAM DAN LINGKUNGAN PANDUAN PENJELAJAHAN,PETUALANGAN DAN BERTAHAN HIDUP 3', 'Anton Kristiandi', 'Borobudur, Inspira Nusantara', '2014', 6, '001', 'ANT', 'e lII', 3, 'ebookdefault.jpg'),
(341, 'PRAMUKA TANGGAP BENCANA PANDUAN MITIGASI DAN BENCANA UNTUK PRAMUKA 4', 'Anton Kristiandi', 'Borobudur, Inspira Nusantara', '2014', 6, '001', 'ANT', 'e IV', 3, 'ebookdefault.jpg'),
(342, 'PRAMUKA DAN PENGABDIAN BANGSA PANDUAN PERAN PRAMUKA DALAM PEMBANGUNAN KARAKTER GENERASI MUDA INDONES', 'Anton Kristiandi', 'Borobudur, Inspira Nusantara', '2014', 6, '001', 'ANT', 'e V', 3, 'ebookdefault.jpg'),
(343, 'TENDA BIVAK DAN SHELTER 3', 'Anton Kristiandi', 'Borobudur, Inspira Nusantara', '2015', 3, '001', 'ANT', 'e lII', 3, 'ebookdefault.jpg'),
(344, 'SANDI DAN SEMAPORE', 'Anton Kristiandi', 'Borobudur, Inspira Nusantara', '2015', 6, '001', 'ANT', 'e V', 3, 'ebookdefault.jpg'),
(345, 'PERTOLONGAN PERTAMA PADA KECELAKAAN', 'Anton Kristiandi', 'Borobudur, Inspira Nusantara', '2015', 5, '001', 'ANT', 'e VI', 3, 'ebookdefault.jpg'),
(346, 'BARIS BERBARIS', 'Anton Kristiandi', 'Borobudur, Inspira Nusantara', '2015', 6, '001', 'ANT', 'e VII', 3, 'ebookdefault.jpg'),
(347, 'RUMAH ADAT DAN PERABOTAN TRADISIONAL INDONESIA', 'Ari Ahardian', 'Citra Aji Pratama', '2016', 5, '001', 'ARI', 'e', 3, 'ebookdefault.jpg'),
(348, 'MOTIF KAIN DAN BUSANA TRADISIONAL INDONESIA', 'Ari Ahardian', 'Citra Aji Pratama', '2016', 6, '001', 'ARI', 'e', 3, 'ebookdefault.jpg'),
(349, 'RITUS DAN SIKLUS KEHIDUPAN DI INDONESIA', 'Ari Ahardian', 'Citra Aji Pratama', '2016', 5, '001', 'ARI', 'e', 3, 'ebookdefault.jpg'),
(350, 'RAGAM RUMAH IBADAH DI INDONESIA', 'Ari Ahardian', 'Citra Aji Pratama', '2016', 5, '001', 'ARI', 'e', 3, 'ebookdefault.jpg'),
(351, 'PERMAINAN TRADISIONAL ANAK INDONESIA', 'Ari Ahardian', 'Citra Aji Pratama', '2016', 6, '001', 'ARI', 'e', 3, 'ebookdefault.jpg'),
(352, 'ENSIKLOPEDIA ILMU PENGETAHUAN SOSIAL UNTUK PELAJAR', 'Puspa Tiara dan Agung Prima', 'Gading Inti Pratama', '2019', 12, '001', 'PUS', 'e', 3, 'ebookdefault.jpg'),
(353, 'ENSIKLOPEDIA ILMU PENGETAHUAN UMUM UNTUK PELAJAR', 'Galih Hadiwijaya dan Diana Hapsari', 'Gading Inti Pratama', '2019', 12, '001', 'GAL', 'e', 3, 'ebookdefault.jpg'),
(354, 'ENSIKLOPEDIA SAINS DAN TEKNOLOGI  ARSITEKTUR MUSIK', 'TIM', 'LENTERA ABADI,JAKARTA', '2007', 4, '001', 'TIM', 'e VI', 3, 'ebookdefault.jpg'),
(355, 'ENSIKLOPEDIA SAINS DAN TEKNOLOGI OLAH RAGA DUNIA MODERN', 'TIM', 'LENTERA ABADI,JAKARTA', '2016', 6, '001', 'TIM', 'e VII', 3, 'ebookdefault.jpg'),
(356, 'ENSIKLOPEDIA LINGKUNGAN HIDUP', 'Diah Rahmatika dan Pipit Pitriana', 'Ganeca exact', '2006', 1, '001', 'DIA', 'e', 3, 'ebookdefault.jpg'),
(357, 'ENSIKLOPEDIA JELAJAH ILMU PENGETAHUAN SERI SERANGGA DAN LABA LABA', 'Delik Iskandar,dkk', 'Aneka Ilmu', '', 1, '001', 'DEL', 'e', 3, 'ebookdefault.jpg'),
(358, 'ENSIKLOPEDIA JELAJAH ILMU PENGETAHUAN SERI BURUNG', 'Delik Iskandar,dkk', 'Aneka Ilmu', '', 1, '001', 'DEL', 'e', 3, 'ebookdefault.jpg'),
(375, 'BUKU TEST', 'PENULIS TEST', 'PENERBIT TEST', '2020', 6, '3v', 'PEN', 'j Vii', 3, '1654677644.jpg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `m_denda`
--

CREATE TABLE `m_denda` (
  `id_denda` int(11) NOT NULL,
  `nama_denda` varchar(20) NOT NULL,
  `jml_denda` int(50) NOT NULL,
  `desc_denda` varchar(128) NOT NULL,
  `update_by` int(11) NOT NULL,
  `update_date` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `m_denda`
--

INSERT INTO `m_denda` (`id_denda`, `nama_denda`, `jml_denda`, `desc_denda`, `update_by`, `update_date`) VALUES
(1, 'telat', 5000, 'telat pengembalian buku', 1, '2022-06-09'),
(2, 'hilang', 50000, 'menghilangkan buku', 1, '2022-06-11');

-- --------------------------------------------------------

--
-- Struktur dari tabel `m_kategori_buku`
--

CREATE TABLE `m_kategori_buku` (
  `id_kategori` int(11) NOT NULL,
  `nama_kategori` varchar(100) NOT NULL,
  `create_by` int(11) NOT NULL,
  `create_date` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `m_kategori_buku`
--

INSERT INTO `m_kategori_buku` (`id_kategori`, `nama_kategori`, `create_by`, `create_date`) VALUES
(1, 'Non Fiksi', 1, '2022-05-28'),
(2, 'Novel', 1, '2022-05-28'),
(3, 'Ensiklopedia', 1, '2022-05-28'),
(9, 'Teknologi', 0, '2022-06-11');

-- --------------------------------------------------------

--
-- Struktur dari tabel `m_menu`
--

CREATE TABLE `m_menu` (
  `id_menu` int(11) NOT NULL,
  `nama_menu` varchar(20) NOT NULL,
  `link_menu` text NOT NULL,
  `type` varchar(20) NOT NULL,
  `icon` varchar(128) NOT NULL,
  `is_active` int(1) NOT NULL,
  `editable` enum('N/A','YES','','') NOT NULL,
  `create_by` int(11) NOT NULL,
  `create_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `m_menu`
--

INSERT INTO `m_menu` (`id_menu`, `nama_menu`, `link_menu`, `type`, `icon`, `is_active`, `editable`, `create_by`, `create_date`) VALUES
(2, 'Manajemen', 'manajemen', '2', '<i class=\"mdi mdi-cog-outline\"></i>', 1, 'YES', 0, '2022-05-21'),
(4, 'Setup', 'setup', '2', '<i class=\"mdi mdi-cog-outline\"></i>', 1, 'N/A', 0, '2022-05-21'),
(14, 'Dashboard', 'dashboard', '1', '<i class=\"mdi mdi-microsoft-windows\"></i>', 1, 'YES', 0, '2022-05-21'),
(15, 'Transaksi', 'transaksi', '2', '<i class=\"mdi mdi-ballot\"></i>', 1, 'YES', 1, '2022-06-11');

-- --------------------------------------------------------

--
-- Struktur dari tabel `m_rak`
--

CREATE TABLE `m_rak` (
  `id_rak` int(11) NOT NULL,
  `nama_rak` varchar(50) NOT NULL,
  `lokasi_rak` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
  `icon_status` int(1) NOT NULL,
  `is_active` int(1) NOT NULL COMMENT 'untuk status menu',
  `editable` enum('N/A','YES') NOT NULL,
  `create_by` int(11) NOT NULL,
  `create_date` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `m_submenu`
--

INSERT INTO `m_submenu` (`id_submenu`, `id_menu`, `nama_submenu`, `url`, `icon`, `icon_status`, `is_active`, `editable`, `create_by`, `create_date`) VALUES
(1, 4, 'Menu', 'setup/menu', '<i class=\"mdi mdi-layers\"></i>', 1, 1, 'N/A', 0, '2022-05-21'),
(3, 4, 'Submenu', 'setup/submenu', '<i class=\"mdi mdi-layers-triple\"></i>', 1, 1, 'N/A', 0, '2022-05-21'),
(5, 4, 'Role User', 'setup/roleuser', '<i class=\"fas fa-cogs\"></i>', 1, 1, 'N/A', 0, '2022-05-21'),
(32, 2, 'User', 'manajemen/user', '<i class=\"mdi mdi-account-cog\"></i>', 1, 1, 'YES', 1, '2022-05-24'),
(35, 2, 'Buku', 'manajemen/buku', '<i class=\"mdi mdi-book\"></i>', 1, 1, 'YES', 1, '2022-05-28'),
(36, 2, 'Kategori Buku', 'manajemen/kategori', '<i class=\"mdi mdi-book-cog\"></i>', 1, 0, 'YES', 1, '2022-06-07'),
(37, 2, 'Denda', 'manajemen/denda', '<i class=\"mdi mdi-currency-usd-circle\"></i>', 1, 1, 'YES', 1, '2022-06-09'),
(38, 15, 'Peminjaman', 'transaksi/peminjaman', '<i class=\"mdi mdi-arrow-right-box\"></i>', 1, 1, 'YES', 1, '2022-06-11'),
(39, 15, 'Pengembalian', 'transaksi/pengembalian', '<i class=\"mdi mdi-arrow-left-box\"></i>', 1, 1, 'YES', 1, '2022-06-11');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tr_denda`
--

CREATE TABLE `tr_denda` (
  `id_tr_denda` int(11) NOT NULL,
  `jenis_denda` int(11) NOT NULL,
  `id_buku` int(11) NOT NULL,
  `jml_denda` int(50) NOT NULL,
  `id_pengembalian` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tr_denda`
--

INSERT INTO `tr_denda` (`id_tr_denda`, `jenis_denda`, `id_buku`, `jml_denda`, `id_pengembalian`) VALUES
(1, 2, 331, 50000, 1),
(2, 1, 348, 15000, 2),
(3, 2, 328, 50000, 3),
(4, 1, 343, 10000, 3);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tr_peminjaman`
--

CREATE TABLE `tr_peminjaman` (
  `id_peminjaman` int(11) NOT NULL,
  `tanggal_pinjam` date NOT NULL,
  `tanggal_kembali` date NOT NULL,
  `id_buku` varchar(100) NOT NULL,
  `id_anggota` int(11) NOT NULL,
  `id_petugas` int(11) NOT NULL,
  `status_pengembalian` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tr_peminjaman`
--

INSERT INTO `tr_peminjaman` (`id_peminjaman`, `tanggal_pinjam`, `tanggal_kembali`, `id_buku`, `id_anggota`, `id_petugas`, `status_pengembalian`) VALUES
(1, '2022-06-05', '2022-06-07', '20,356,55', 9, 1, 0),
(2, '2022-06-09', '2022-06-14', '55', 9, 2, 0),
(6, '2022-06-10', '2022-06-15', '346', 9, 1, 1),
(10, '2022-07-07', '2022-07-07', '340,315', 9, 1, 0),
(11, '2022-07-05', '2022-07-08', '336,343,339', 9, 1, 0),
(12, '2022-07-01', '2022-07-04', '312,330', 9, 1, 0),
(13, '2022-07-14', '2022-07-16', '346,306', 9, 1, 0),
(14, '2022-07-07', '2022-07-09', '140,285', 9, 1, 0),
(15, '2022-07-09', '2022-07-11', '350,105', 9, 1, 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tr_pengembalian`
--

CREATE TABLE `tr_pengembalian` (
  `id_pengembalian` int(11) NOT NULL,
  `tanggal_pengembalian` date NOT NULL,
  `id_peminjaman` int(11) NOT NULL,
  `id_anggota` int(11) NOT NULL,
  `id_petugas` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tr_pengembalian`
--

INSERT INTO `tr_pengembalian` (`id_pengembalian`, `tanggal_pengembalian`, `id_peminjaman`, `id_anggota`, `id_petugas`) VALUES
(4, '2022-06-14', 6, 9, 1);

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
  `create_date` date NOT NULL DEFAULT current_timestamp(),
  `qrcode_img` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`user_id`, `username`, `password`, `role_id`, `user_detail_id`, `is_active`, `create_date`, `qrcode_img`) VALUES
(1, 'administrator', '202cb962ac59075b964b07152d234b70', 1, 1, 1, '0000-00-00', 'administrator202207071162578319.png'),
(2, 'admin', '202cb962ac59075b964b07152d234b70', 2, 2, 1, '0000-00-00', 'admin202207071521145726.png'),
(9, '1234567', '202cb962ac59075b964b07152d234b70', 4, 11, 1, '0000-00-00', '123456720220707979494004.png');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_access_menu`
--

CREATE TABLE `user_access_menu` (
  `id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `id_menu` int(11) NOT NULL,
  `create_by` int(1) NOT NULL,
  `create_date` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `user_access_menu`
--

INSERT INTO `user_access_menu` (`id`, `role_id`, `id_menu`, `create_by`, `create_date`) VALUES
(2, 1, 2, 0, '2022-05-23'),
(3, 1, 4, 0, '2022-05-23'),
(5, 2, 1, 1, '2022-05-25'),
(10, 2, 2, 1, '2022-05-27'),
(11, 1, 14, 1, '2022-05-27'),
(12, 1, 1, 1, '2022-06-08'),
(13, 4, 1, 1, '2022-06-08'),
(14, 1, 15, 1, '2022-06-11'),
(15, 2, 15, 1, '2022-06-11'),
(17, 4, 14, 1, '2022-07-05');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_detail`
--

CREATE TABLE `user_detail` (
  `user_detail_id` int(11) NOT NULL,
  `nama` varchar(128) NOT NULL,
  `email` varchar(60) NOT NULL,
  `tlp` varchar(13) NOT NULL,
  `alamat` varchar(123) NOT NULL,
  `img` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `user_detail`
--

INSERT INTO `user_detail` (`user_detail_id`, `nama`, `email`, `tlp`, `alamat`, `img`) VALUES
(1, 'Admin System', 'system.admin@gmail.com', '6287790001615', '-', 'default.jpg'),
(2, 'Admin Perpus', 'admin.perpus@gmail.com', '62', 'Purwakarta, Indonesia', 'default.jpg'),
(11, 'Bayu Prasetyo1', 'bayu@gmail.com', '6287790001615', 'Galudra', 'default.jpg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_role`
--

CREATE TABLE `user_role` (
  `role_id` int(11) NOT NULL,
  `role_type` varchar(128) NOT NULL,
  `description` text NOT NULL,
  `editable` int(1) NOT NULL,
  `create_by` int(1) NOT NULL,
  `create_date` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `user_role`
--

INSERT INTO `user_role` (`role_id`, `role_type`, `description`, `editable`, `create_by`, `create_date`) VALUES
(1, 'Administrator', 'This is account for system administrator.', 1, 0, '2022-05-23'),
(2, 'Petugas', 'This is account for regular admin.', 1, 0, '2022-05-23'),
(4, 'Anggota', 'Role untuk umum/peminjam', 1, 0, '2022-05-25');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `data_kunjungan`
--
ALTER TABLE `data_kunjungan`
  ADD PRIMARY KEY (`id_kunjungan`);

--
-- Indeks untuk tabel `m_buku`
--
ALTER TABLE `m_buku`
  ADD PRIMARY KEY (`id_buku`);

--
-- Indeks untuk tabel `m_denda`
--
ALTER TABLE `m_denda`
  ADD PRIMARY KEY (`id_denda`);

--
-- Indeks untuk tabel `m_kategori_buku`
--
ALTER TABLE `m_kategori_buku`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indeks untuk tabel `m_menu`
--
ALTER TABLE `m_menu`
  ADD PRIMARY KEY (`id_menu`),
  ADD KEY `id_menu` (`id_menu`,`is_active`);

--
-- Indeks untuk tabel `m_rak`
--
ALTER TABLE `m_rak`
  ADD PRIMARY KEY (`id_rak`);

--
-- Indeks untuk tabel `m_submenu`
--
ALTER TABLE `m_submenu`
  ADD PRIMARY KEY (`id_submenu`),
  ADD KEY `id_submenu` (`id_submenu`,`id_menu`,`is_active`),
  ADD KEY `id_menu` (`id_menu`);

--
-- Indeks untuk tabel `tr_denda`
--
ALTER TABLE `tr_denda`
  ADD PRIMARY KEY (`id_tr_denda`);

--
-- Indeks untuk tabel `tr_peminjaman`
--
ALTER TABLE `tr_peminjaman`
  ADD PRIMARY KEY (`id_peminjaman`);

--
-- Indeks untuk tabel `tr_pengembalian`
--
ALTER TABLE `tr_pengembalian`
  ADD PRIMARY KEY (`id_pengembalian`);

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
-- AUTO_INCREMENT untuk tabel `data_kunjungan`
--
ALTER TABLE `data_kunjungan`
  MODIFY `id_kunjungan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT untuk tabel `m_buku`
--
ALTER TABLE `m_buku`
  MODIFY `id_buku` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=376;

--
-- AUTO_INCREMENT untuk tabel `m_denda`
--
ALTER TABLE `m_denda`
  MODIFY `id_denda` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `m_kategori_buku`
--
ALTER TABLE `m_kategori_buku`
  MODIFY `id_kategori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `m_menu`
--
ALTER TABLE `m_menu`
  MODIFY `id_menu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT untuk tabel `m_rak`
--
ALTER TABLE `m_rak`
  MODIFY `id_rak` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `m_submenu`
--
ALTER TABLE `m_submenu`
  MODIFY `id_submenu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT untuk tabel `tr_denda`
--
ALTER TABLE `tr_denda`
  MODIFY `id_tr_denda` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `tr_peminjaman`
--
ALTER TABLE `tr_peminjaman`
  MODIFY `id_peminjaman` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT untuk tabel `tr_pengembalian`
--
ALTER TABLE `tr_pengembalian`
  MODIFY `id_pengembalian` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT untuk tabel `user_access_menu`
--
ALTER TABLE `user_access_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT untuk tabel `user_detail`
--
ALTER TABLE `user_detail`
  MODIFY `user_detail_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT untuk tabel `user_role`
--
ALTER TABLE `user_role`
  MODIFY `role_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
