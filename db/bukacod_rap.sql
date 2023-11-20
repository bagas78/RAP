-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Nov 20, 2023 at 05:28 AM
-- Server version: 10.5.23-MariaDB
-- PHP Version: 8.1.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bukacod_rap`
--

-- --------------------------------------------------------

--
-- Table structure for table `t_akun`
--

CREATE TABLE `t_akun` (
  `akun_id` int(11) NOT NULL,
  `akun_nama` text NOT NULL,
  `akun_normal` text NOT NULL,
  `akun_tanggal` date NOT NULL DEFAULT curdate()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `t_akun`
--

INSERT INTO `t_akun` (`akun_id`, `akun_nama`, `akun_normal`, `akun_tanggal`) VALUES
(1, 'Kas', '1', '2023-01-27'),
(2, 'Piutang', '1', '2023-01-27'),
(3, 'Stok produk', '1', '2023-01-27'),
(4, 'Stok bahan baku', '1', '2023-01-27'),
(5, 'Hutang', '2', '2023-01-27'),
(6, 'Saldo', '3', '2023-01-27'),
(7, 'Penjualan produk', '4', '2023-01-27'),
(8, 'Biaya produksi', '5', '2023-01-27'),
(9, 'Biaya Peleburan', '5', '2023-08-14');

-- --------------------------------------------------------

--
-- Table structure for table `t_akun_normal`
--

CREATE TABLE `t_akun_normal` (
  `akun_normal_id` int(11) NOT NULL,
  `akun_normal_nama` text NOT NULL,
  `akun_normal_plus` text NOT NULL,
  `akun_normal_min` text NOT NULL,
  `akun_normal_tanggal` date NOT NULL DEFAULT curdate()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `t_akun_normal`
--

INSERT INTO `t_akun_normal` (`akun_normal_id`, `akun_normal_nama`, `akun_normal_plus`, `akun_normal_min`, `akun_normal_tanggal`) VALUES
(1, 'Harta', 'D', 'K', '2023-01-27'),
(2, 'Hutang', 'K', 'D', '2023-01-27'),
(3, 'Modal', 'K', 'D', '2023-01-27'),
(4, 'Pendapatan', 'K', 'D', '2023-01-27'),
(5, 'Beban', 'D', 'K', '2023-01-27');

-- --------------------------------------------------------

--
-- Table structure for table `t_bahan`
--

CREATE TABLE `t_bahan` (
  `bahan_id` int(11) NOT NULL,
  `bahan_kode` text NOT NULL,
  `bahan_nama` text NOT NULL,
  `bahan_stok` float NOT NULL DEFAULT 0,
  `bahan_satuan` text NOT NULL,
  `bahan_kategori` set('utama','pembantu') NOT NULL,
  `bahan_harga` text NOT NULL,
  `bahan_tanggal` date NOT NULL DEFAULT curdate(),
  `bahan_hapus` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `t_bahan`
--

INSERT INTO `t_bahan` (`bahan_id`, `bahan_kode`, `bahan_nama`, `bahan_stok`, `bahan_satuan`, `bahan_kategori`, `bahan_harga`, `bahan_tanggal`, `bahan_hapus`) VALUES
(0, 'BH000', 'Produk cacat', 0, '1', 'utama', '0', '2023-05-16', 0),
(13, 'BH001', 'Avalan Siku', 7040, '1', 'utama', '27708', '2023-06-13', 0),
(14, 'BH002', 'Avalan Kawat', 420, '1', 'utama', '31500', '2023-06-13', 0),
(15, 'BH003', 'Ceramic Filter', 0, '7', 'pembantu', '0', '2023-06-13', 0),
(16, 'BH004', 'Magnesium Ingot 99%', 0, '1', 'pembantu', '0', '2023-06-13', 0),
(17, 'BH005', 'Nickel Sulphate', 0, '1', 'pembantu', '0', '2023-06-13', 0),
(18, 'BH006', 'Dross of Flux', 0, '1', 'pembantu', '0', '2023-07-03', 0),
(19, 'BH007', 'Refining Fluxes', 0, '1', 'pembantu', '0', '2023-07-03', 0),
(20, 'BH008', 'Aluminium Ingot 99.7%', 0, '1', 'utama', '0', '2023-08-04', 0),
(21, 'BH009', 'Avalan Plat', 0, '1', 'utama', '0', '2023-08-04', 0),
(22, 'BH0010', 'Oli Peleburan', 0, '1', 'pembantu', '0', '2023-08-04', 0),
(23, 'BH0011', 'Solar High Speed Diesel', 1100, '9', 'pembantu', '11000', '2023-11-02', 0),
(24, 'BH0012', 'Avalan Panci', 0, '1', 'utama', '0', '2023-11-02', 0),
(25, 'BH0013', 'Gas N2 (Nitrogen) 6 M3', 0, '10', 'pembantu', '0', '2023-11-10', 0),
(26, 'BH0014', 'Amoniak - NH3 50KG MP', 0, '10', 'pembantu', '0', '2023-11-10', 0),
(27, 'BH0015', 'Caustic Soda Flake Ex Cina', 1000, '1', 'pembantu', '11300', '2023-11-13', 0);

-- --------------------------------------------------------

--
-- Table structure for table `t_bank`
--

CREATE TABLE `t_bank` (
  `bank_id` int(11) NOT NULL,
  `bank_kode` text NOT NULL,
  `bank_nama` text NOT NULL,
  `bank_tanggal` date NOT NULL DEFAULT curdate()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `t_bank`
--

INSERT INTO `t_bank` (`bank_id`, `bank_kode`, `bank_nama`, `bank_tanggal`) VALUES
(1, '002', 'BANK BRI', '2022-11-30'),
(2, '003', 'BANK EKSPOR INDONESIA', '2022-11-30'),
(3, '008', 'BANK MANDIRI', '2022-11-30'),
(4, '009', 'BANK BNI', '2022-11-30'),
(5, '427', 'BANK BNI SYARIAH', '2022-11-30'),
(6, '011', 'BANK DANAMON', '2022-11-30'),
(7, '013', 'PERMATA BANK', '2022-11-30'),
(8, '014', 'BANK BCA', '2022-11-30'),
(9, '016', 'BANK BII', '2022-11-30'),
(10, '019', 'BANK PANIN', '2022-11-30'),
(11, '020', 'BANK ARTA NIAGA KENCANA', '2022-11-30'),
(12, '022', 'BANK NIAGA', '2022-11-30'),
(13, '023', 'BANK BUANA IND', '2022-11-30'),
(14, '026', 'BANK LIPPO', '2022-11-30'),
(15, '028', 'BANK NISP', '2022-11-30'),
(16, '030', 'AMERICAN EXPRESS BANK LTD', '2022-11-30'),
(17, '031', 'CITIBANK N.A.', '2022-11-30'),
(18, '032', 'JP. MORGAN CHASE BANK, N.A.', '2022-11-30'),
(19, '033', 'BANK OF AMERICA, N.A', '2022-11-30'),
(20, '034', 'ING INDONESIA BANK', '2022-11-30'),
(21, '036', 'BANK MULTICOR TBK.', '2022-11-30'),
(22, '037', 'BANK ARTHA GRAHA', '2022-11-30'),
(23, '039', 'BANK CREDIT AGRICOLE INDOSUEZ', '2022-11-30'),
(24, '040', 'THE BANGKOK BANK COMP. LTD', '2022-11-30'),
(25, '041', 'THE HONGKONG & SHANGHAI B.C.', '2022-11-30'),
(26, '042', 'THE BANK OF TOKYO MITSUBISHI UFJ LTD', '2022-11-30'),
(27, '045', 'BANK SUMITOMO MITSUI INDONESIA', '2022-11-30'),
(28, '046', 'BANK DBS INDONESIA', '2022-11-30'),
(29, '047', 'BANK RESONA PERDANIA', '2022-11-30'),
(30, '048', 'BANK MIZUHO INDONESIA', '2022-11-30'),
(31, '050', 'STANDARD CHARTERED BANK', '2022-11-30'),
(32, '052', 'BANK ABN AMRO', '2022-11-30'),
(33, '053', 'BANK KEPPEL TATLEE BUANA', '2022-11-30'),
(34, '054', 'BANK CAPITAL INDONESIA, TBK.', '2022-11-30'),
(35, '057', 'BANK BNP PARIBAS INDONESIA', '2022-11-30'),
(36, '058', 'BANK UOB INDONESIA', '2022-11-30'),
(37, '059', 'KOREA EXCHANGE BANK DANAMON', '2022-11-30'),
(38, '060', 'RABOBANK INTERNASIONAL INDONESIA', '2022-11-30'),
(39, '061', 'ANZ PANIN BANK', '2022-11-30'),
(40, '067', 'DEUTSCHE BANK AG.', '2022-11-30'),
(41, '068', 'BANK WOORI INDONESIA', '2022-11-30'),
(42, '069', 'BANK OF CHINA LIMITED', '2022-11-30'),
(43, '076', 'BANK BUMI ARTA', '2022-11-30'),
(44, '087', 'BANK EKONOMI', '2022-11-30'),
(45, '088', 'BANK ANTARDAERAH', '2022-11-30'),
(46, '089', 'BANK HAGA', '2022-11-30'),
(47, '093', 'BANK IFI', '2022-11-30'),
(48, '095', 'BANK CENTURY, TBK.', '2022-11-30'),
(49, '097', 'BANK MAYAPADA', '2022-11-30'),
(50, '110', 'BANK JABAR', '2022-11-30'),
(51, '111', 'BANK DKI', '2022-11-30'),
(52, '112', 'BPD DIY', '2022-11-30'),
(53, '113', 'BANK JATENG', '2022-11-30'),
(54, '114', 'BANK JATIM', '2022-11-30'),
(55, '115', 'BPD JAMBI', '2022-11-30'),
(56, '116', 'BPD ACEH', '2022-11-30'),
(57, '117', 'BANK SUMUT', '2022-11-30'),
(58, '118', 'BANK NAGARI', '2022-11-30'),
(59, '119', 'BANK RIAU', '2022-11-30'),
(60, '120', 'BANK SUMSEL', '2022-11-30'),
(61, '121', 'BANK LAMPUNG', '2022-11-30'),
(62, '122', 'BPD KALSEL', '2022-11-30'),
(63, '123', 'BPD KALIMANTAN BARAT', '2022-11-30'),
(64, '124', 'BPD KALTIM', '2022-11-30'),
(65, '125', 'BPD KALTENG', '2022-11-30'),
(66, '126', 'BPD SULSEL', '2022-11-30'),
(67, '127', 'BANK SULUT', '2022-11-30'),
(68, '128', 'BPD NTB', '2022-11-30'),
(69, '129', 'BPD BALI', '2022-11-30'),
(70, '130', 'BANK NTT', '2022-11-30'),
(71, '131', 'BANK MALUKU', '2022-11-30'),
(72, '132', 'BPD PAPUA', '2022-11-30'),
(73, '133', 'BANK BENGKULU', '2022-11-30'),
(74, '134', 'BPD SULAWESI TENGAH', '2022-11-30'),
(75, '135', 'BANK SULTRA', '2022-11-30'),
(76, '145', 'BANK NUSANTARA PARAHYANGAN', '2022-11-30'),
(77, '146', 'BANK SWADESI', '2022-11-30'),
(78, '147', 'BANK MUAMALAT', '2022-11-30'),
(79, '151', 'BANK MESTIKA', '2022-11-30'),
(80, '152', 'BANK METRO EXPRESS', '2022-11-30'),
(81, '153', 'BANK SHINTA INDONESIA', '2022-11-30'),
(82, '157', 'BANK MASPION', '2022-11-30'),
(83, '159', 'BANK HAGAKITA', '2022-11-30'),
(84, '161', 'BANK GANESHA', '2022-11-30'),
(85, '162', 'BANK WINDU KENTJANA', '2022-11-30'),
(86, '164', 'HALIM INDONESIA BANK', '2022-11-30'),
(87, '166', 'BANK HARMONI INTERNATIONAL', '2022-11-30'),
(88, '167', 'BANK KESAWAN', '2022-11-30'),
(89, '200', 'BANK TABUNGAN NEGARA (PERSERO)', '2022-11-30'),
(90, '212', 'BANK HIMPUNAN SAUDARA 1906, TBK .', '2022-11-30'),
(91, '213', 'BANK TABUNGAN PENSIUNAN NASIONAL', '2022-11-30'),
(92, '405', 'BANK SWAGUNA', '2022-11-30'),
(93, '422', 'BANK JASA ARTA', '2022-11-30'),
(94, '426', 'BANK MEGA', '2022-11-30'),
(95, '427', 'BANK JASA JAKARTA', '2022-11-30'),
(96, '441', 'BANK BUKOPIN', '2022-11-30'),
(97, '451', 'BANK SYARIAH MANDIRI', '2022-11-30'),
(98, '459', 'BANK BISNIS INTERNASIONAL', '2022-11-30'),
(99, '466', 'BANK SRI PARTHA', '2022-11-30'),
(100, '472', 'BANK JASA JAKARTA', '2022-11-30'),
(101, '484', 'BANK BINTANG MANUNGGAL', '2022-11-30'),
(102, '485', 'BANK BUMIPUTERA', '2022-11-30'),
(103, '490', 'BANK YUDHA BHAKTI', '2022-11-30'),
(104, '491', 'BANK MITRANIAGA', '2022-11-30'),
(105, '494', 'BANK AGRO NIAGA', '2022-11-30'),
(106, '498', 'BANK INDOMONEX', '2022-11-30'),
(107, '501', 'BANK ROYAL INDONESIA', '2022-11-30'),
(108, '503', 'BANK ALFINDO', '2022-11-30'),
(109, '506', 'BANK SYARIAH MEGA', '2022-11-30'),
(110, '513', 'BANK INA PERDANA', '2022-11-30'),
(111, '517', 'BANK HARFA', '2022-11-30'),
(112, '520', 'PRIMA MASTER BANK', '2022-11-30'),
(113, '521', 'BANK PERSYARIKATAN INDONESIA', '2022-11-30'),
(114, '525', 'BANK AKITA', '2022-11-30'),
(115, '526', 'LIMAN INTERNATIONAL BANK', '2022-11-30'),
(116, '531', 'ANGLOMAS INTERNASIONAL BANK', '2022-11-30'),
(117, '523', 'BANK DIPO INTERNATIONAL', '2022-11-30'),
(118, '535', 'BANK KESEJAHTERAAN EKONOMI', '2022-11-30'),
(119, '536', 'BANK UIB', '2022-11-30'),
(120, '542', 'BANK ARTOS IND', '2022-11-30'),
(121, '547', 'BANK PURBA DANARTA', '2022-11-30'),
(122, '548', 'BANK MULTI ARTA SENTOSA', '2022-11-30'),
(123, '553', 'BANK MAYORA', '2022-11-30'),
(124, '555', 'BANK INDEX SELINDO', '2022-11-30'),
(125, '566', 'BANK VICTORIA INTERNATIONAL', '2022-11-30'),
(126, '558', 'BANK EKSEKUTIF', '2022-11-30'),
(127, '559', 'CENTRATAMA NASIONAL BANK', '2022-11-30'),
(128, '562', 'BANK FAMA INTERNASIONAL', '2022-11-30'),
(129, '564', 'BANK SINAR HARAPAN BALI', '2022-11-30'),
(130, '567', 'BANK HARDA', '2022-11-30'),
(131, '945', 'BANK FINCONESIA', '2022-11-30'),
(132, '946', 'BANK MERINCORP', '2022-11-30'),
(133, '947', 'BANK MAYBANK INDOCORP', '2022-11-30'),
(134, '948', 'BANK OCBC – INDONESIA', '2022-11-30'),
(135, '949', 'BANK CHINA TRUST INDONESIA', '2022-11-30'),
(136, '950', 'BANK COMMONWEALTH', '2022-11-30'),
(137, '425', 'BANK BJB SYARIAH', '2022-11-30'),
(138, '688', 'BPR KS (KARYAJATNIKA SEDAYA)', '2022-11-30'),
(139, '789', 'INDOSAT DOMPETKU', '2022-11-30'),
(140, '911', 'TELKOMSEL TCASH', '2022-11-30'),
(141, '911', 'LINKAJA', '2022-11-30');

-- --------------------------------------------------------

--
-- Table structure for table `t_billet`
--

CREATE TABLE `t_billet` (
  `billet_id` int(11) NOT NULL,
  `billet_full` text DEFAULT '0',
  `billet_min` text DEFAULT '0',
  `billet_stok` text DEFAULT '0',
  `billet_sisa` text DEFAULT '0',
  `billet_hpp` text DEFAULT '0',
  `billet_hps` text DEFAULT '0',
  `billet_update` date NOT NULL DEFAULT curdate()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `t_billet`
--

INSERT INTO `t_billet` (`billet_id`, `billet_full`, `billet_min`, `billet_stok`, `billet_sisa`, `billet_hpp`, `billet_hps`, `billet_update`) VALUES
(1, NULL, NULL, '0', '0', NULL, NULL, '2023-11-20');

-- --------------------------------------------------------

--
-- Table structure for table `t_cacat`
--

CREATE TABLE `t_cacat` (
  `cacat_id` int(11) NOT NULL,
  `cacat_user` int(11) DEFAULT NULL,
  `cacat_jumlah` text DEFAULT NULL,
  `cacat_tanggal` date DEFAULT curdate(),
  `cacat_hapus` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `t_jurnal`
--

CREATE TABLE `t_jurnal` (
  `jurnal_id` int(11) NOT NULL,
  `jurnal_nomor` text NOT NULL,
  `jurnal_akun` text NOT NULL,
  `jurnal_keterangan` text NOT NULL,
  `jurnal_barang` text DEFAULT NULL,
  `jurnal_type` enum('debit','kredit') NOT NULL,
  `jurnal_nominal` text NOT NULL,
  `jurnal_hapus` int(11) NOT NULL DEFAULT 0,
  `jurnal_tanggal` date NOT NULL DEFAULT curdate()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `t_jurnal`
--

INSERT INTO `t_jurnal` (`jurnal_id`, `jurnal_nomor`, `jurnal_akun`, `jurnal_keterangan`, `jurnal_barang`, `jurnal_type`, `jurnal_nominal`, `jurnal_hapus`, `jurnal_tanggal`) VALUES
(475, 'PLB-02112023-1', '5', 'biaya peleburan', '[\"Avalan Siku\"]', 'debit', '0', 1, '2023-11-02'),
(476, 'PLB-02112023-1', '1', 'kas berkurang', '', 'kredit', '0', 1, '2023-11-02'),
(477, 'PU-06112023-1', '4', 'pembelian umum lunas', '[\"Plat Strip\",\"Solar Mobil Hitam\",\"Materai\",\"Isi Ulang Kartu Tol\"]', 'debit', '582000', 0, '2023-11-05'),
(478, 'PU-06112023-1', '1', 'kas berkurang', '', 'kredit', '582000', 0, '2023-11-05'),
(479, 'PU-06112023-2', '4', 'pembelian umum lunas', '[\"Pelunasan Pengerjaan Forklip\",\"Air Galon\",\"Spidol,Map,Pulpen & Cutter\",\"Bensin Motor Pabrik\"]', 'debit', '708000', 0, '2023-11-05'),
(480, 'PU-06112023-2', '1', 'kas berkurang', '', 'kredit', '708000', 0, '2023-11-05'),
(481, 'PU-06112023-3', '4', 'pembelian umum lunas', '[\"Cat Protektive\",\"Baut Galvanis & Rantai Kapal\",\"DP 2 Pengerjaan Atap (Sisa 33 Juta)\",\"Jumat Berkah Grub Usman\",\"Bensin Motor Pabrik (28\\/10\\/2023)\",\"Uang Jalan Daerah ( 02\\/11\\/2023)\"]', 'debit', '8372000', 0, '2023-11-05'),
(482, 'PU-06112023-3', '1', 'kas berkurang', '', 'kredit', '8372000', 0, '2023-11-05'),
(483, 'PU-06112023-4', '4', 'pembelian umum lunas', '[\"Uang Jalan Daerah\",\"By Timbangan Sidrap\",\"Pass Kima Dari Sidrap\",\"Bensin Ke Sidrap\"]', 'debit', '626000', 0, '2023-11-05'),
(484, 'PU-06112023-4', '1', 'kas berkurang', '', 'kredit', '626000', 0, '2023-11-05'),
(485, 'PU-07112023-5', '4', 'pembelian umum lunas', '[\"Isi Ulang Kartu Tol\",\"Cas Aki Forklip\"]', 'debit', '225000', 1, '2023-11-06'),
(486, 'PU-07112023-5', '1', 'kas berkurang', '', 'kredit', '225000', 1, '2023-11-06'),
(487, 'PU-07112023-5', '4', 'pembelian umum lunas', '[\"Air Galon\",\"Fee u\\/ Pak Anas\",\"By Pass Kima Ke 2R\",\"Isi Ulang Kartu Tol\",\"By Cas Aki Mobll Hitam\"]', 'debit', '2302000', 1, '2023-11-06'),
(488, 'PU-07112023-5', '1', 'kas berkurang', '', 'kredit', '2302000', 1, '2023-11-06'),
(489, 'PU-07112023-5', '4', 'pembelian umum lunas', '[\"Isi Ulang Kartu Toll\"]', 'debit', '222000', 1, '2023-11-06'),
(490, 'PU-07112023-5', '1', 'kas berkurang', '', 'kredit', '222000', 1, '2023-11-06'),
(491, 'PU-07112023-5', '4', 'pembelian umum lunas', '[\"Masuk & Keluar Kima (2R)\",\"Isi Ulang Kartu Toll\",\"Cas Aki Forklip\",\"Air Galon\",\"Fee u\\/ Pak Anas\"]', 'debit', '2302000', 1, '2023-11-06'),
(492, 'PU-07112023-5', '1', 'kas berkurang', '', 'kredit', '2302000', 1, '2023-11-06'),
(493, 'PU-07112023-6', '4', 'pembelian umum lunas', '[\"By Masuk & Keluar Kima (2R)\",\"Fe u\\/ Pak Anas\",\"Air Galon\",\"Cas Aki Forklip\",\"Isi Kartu Tol\"]', 'debit', '2302000', 0, '2023-11-06'),
(494, 'PU-07112023-6', '1', 'kas berkurang', '', 'kredit', '2302000', 0, '2023-11-06'),
(495, 'PB-08112023-2', '4', 'pembelian bahan kredit', '[\"Avalan Siku\"]', 'debit', '25326000', 0, '2023-11-07'),
(496, 'PB-08112023-2', '2', 'hutang bertambah', '', 'kredit', '25326000', 0, '2023-11-07'),
(497, 'PU-08112023-10', '4', 'pembelian umum lunas', '[\"Bensin Motor Pabrik\"]', 'debit', '300000', 1, '2023-11-07'),
(498, 'PU-08112023-10', '1', 'kas berkurang', '', 'kredit', '300000', 1, '2023-11-07'),
(499, 'PU-08112023-7', '4', 'pembelian umum lunas', '[\"Bensin Mobil Pabrik\"]', 'debit', '300000', 0, '2023-11-07'),
(500, 'PU-08112023-7', '1', 'kas berkurang', '', 'kredit', '300000', 0, '2023-11-07'),
(501, 'PB-08112023-3', '4', 'pembelian bahan kredit', '[\"Avalan Siku\",\"Avalan Siku\"]', 'debit', '61936000', 0, '2023-11-08'),
(502, 'PB-08112023-3', '2', 'hutang bertambah', '', 'kredit', '61936000', 0, '2023-11-08'),
(503, 'PU-09112023-8', '4', 'pembelian umum lunas', '[\"Lampu Sorot\",\"Fan Ac 200x200x60\"]', 'debit', '516000', 0, '2023-11-08'),
(504, 'PU-09112023-8', '1', 'kas berkurang', '', 'kredit', '516000', 0, '2023-11-08'),
(505, 'PB-09112023-4', '4', 'pembelian bahan kredit', '[\"Avalan Siku\"]', 'debit', '56168000', 0, '2023-11-08'),
(506, 'PB-09112023-4', '2', 'hutang bertambah', '', 'kredit', '56168000', 0, '2023-11-08'),
(507, 'PB-09112023-4', '4', 'pembelian bahan kredit', '[\"Avalan Siku\"]', 'debit', '56168000', 0, '2023-11-09'),
(508, 'PB-09112023-4', '2', 'hutang bertambah', '', 'kredit', '56168000', 0, '2023-11-09'),
(509, 'PU-10112023-13', '4', 'pembelian umum lunas', '[\"Oli gardan\"]', 'debit', '10000', 1, '2023-11-09'),
(510, 'PU-10112023-13', '1', 'kas berkurang', '', 'kredit', '10000', 1, '2023-11-09'),
(511, 'PU-10112023-14', '4', 'pembelian umum lunas', '[\"Oli mesin gerindra\"]', 'debit', '10000', 0, '2023-11-09'),
(512, 'PU-10112023-14', '1', 'kas berkurang', '', 'kredit', '10000', 0, '2023-11-09'),
(513, 'PU-10112023-13', '4', 'pembelian umum lunas', '[\"Nasi Goreng\"]', 'debit', '12000', 1, '2023-11-09'),
(514, 'PU-10112023-13', '1', 'kas berkurang', '', 'kredit', '12000', 1, '2023-11-09'),
(515, 'PU-10112023-14', '4', 'pembelian umum lunas', '[\"Air Galon\"]', 'debit', '60000', 0, '2023-11-09'),
(516, 'PU-10112023-14', '1', 'kas berkurang', '', 'kredit', '60000', 0, '2023-11-09'),
(517, 'PU-11112023-15', '4', 'pembelian umum lunas', '[\"Sadel Kabel & Terminal Kabel\",\"Bensin Motor Sahar Urus STNK Mobil Pak Raimond\",\"Kipas Angin u\\/ KKPAI + Kertas Kado\",\"Jumat Berkah\"]', 'debit', '375000', 0, '2023-11-10'),
(518, 'PU-11112023-15', '1', 'kas berkurang', '', 'kredit', '375000', 0, '2023-11-10'),
(519, 'PU-13112023-16', '4', 'pembelian umum lunas', '[\"DP 3 Pengerjaan Atap Sisa Rp. 25 Juta\",\"Spidol\",\"By Panaskan Mesin\",\"By Sahar Ke BM\"]', 'debit', '8288000', 0, '2023-11-12'),
(520, 'PU-13112023-16', '1', 'kas berkurang', '', 'kredit', '8288000', 0, '2023-11-12'),
(521, '', '4', 'pembelian bahan kredit', '[]', 'debit', '', 0, '2023-11-13'),
(522, '', '2', 'hutang bertambah', '', 'kredit', '', 0, '2023-11-13'),
(523, 'PB-13112023-6', '4', 'pembelian bahan lunas', '[\"Caustic Soda Flake Ex Cina\"]', 'debit', '12543000', 0, '2023-11-13'),
(524, 'PB-13112023-6', '1', 'kas berkurang', '', 'kredit', '12543000', 0, '2023-11-13'),
(525, 'PU-15112023-17', '4', 'pembelian umum lunas', '[\"Air Galon\",\"By Daerah & Tilang Polisi\",\"Bensin Daerah\",\"Plastik Bening 1 Roll\",\"Isi ulang Kartu Toll\"]', 'debit', '1180000', 0, '2023-11-14'),
(526, 'PU-15112023-17', '1', 'kas berkurang', '', 'kredit', '1180000', 0, '2023-11-14'),
(527, 'PU-15112023-18', '4', 'pembelian umum lunas', '[\"1 Dos LAkban Bening 48x80x45\"]', 'debit', '612000', 1, '2023-11-14'),
(528, 'PU-15112023-18', '1', 'kas berkurang', '', 'kredit', '612000', 1, '2023-11-14'),
(529, 'PU-15112023-19', '4', 'pembelian umum lunas', '[\"1 Dos Lakban Bening 48x80x45\"]', 'debit', '612000', 0, '2023-11-14'),
(530, 'PU-15112023-19', '1', 'kas berkurang', '', 'kredit', '612000', 0, '2023-11-14'),
(531, 'PB-15112023-7', '4', 'pembelian bahan kredit', '[\"Avalan Siku\"]', 'debit', '9450000', 0, '2023-11-15'),
(532, 'PB-15112023-7', '2', 'hutang bertambah', '', 'kredit', '9450000', 0, '2023-11-15'),
(533, 'PB-15112023-8', '4', 'pembelian bahan kredit', '[\"Avalan Kawat\",\"Avalan Siku\"]', 'debit', '27805000', 0, '2023-11-15'),
(534, 'PB-15112023-8', '2', 'hutang bertambah', '', 'kredit', '27805000', 0, '2023-11-15'),
(535, 'PU-16112023-20', '4', 'pembelian umum lunas', '[\"Pass Kima\",\"Bensin Mobil PAbrik\"]', 'debit', '396000', 0, '2023-11-15'),
(536, 'PU-16112023-20', '1', 'kas berkurang', '', 'kredit', '396000', 0, '2023-11-15'),
(537, 'PB-08112023-2', '2', 'hutang berkurang', '[\"Avalan Siku\"]', 'debit', '25326000', 0, '2023-11-16'),
(538, 'PB-08112023-2', '1', 'kas berkurang', '', 'kredit', '25326000', 0, '2023-11-16'),
(539, 'PB-15112023-7', '2', 'hutang berkurang', '[\"Avalan Siku\"]', 'debit', '9450000', 0, '2023-11-16'),
(540, 'PB-15112023-7', '1', 'kas berkurang', '', 'kredit', '9450000', 0, '2023-11-16'),
(541, 'PB-17112023-9', '4', 'pembelian bahan kredit', '[\"Avalan Siku\"]', 'debit', '27610000', 0, '2023-11-16'),
(542, 'PB-17112023-9', '2', 'hutang bertambah', '', 'kredit', '27610000', 0, '2023-11-16'),
(543, 'PU-18112023-21', '4', 'pembelian umum lunas', '[\"Minyak Rem Forklip\",\"Kran Air\",\"Pass Kima\"]', 'debit', '129000', 0, '2023-11-17'),
(544, 'PU-18112023-21', '1', 'kas berkurang', '', 'kredit', '129000', 0, '2023-11-17'),
(545, 'PU-18112023-22', '4', 'pembelian umum lunas', '[\"Cat Protektive dan Serat No drop\",\"oli Motor pabrik\",\"Air Galon\",\"Pass Kima\"]', 'debit', '1014000', 0, '2023-11-17'),
(546, 'PU-18112023-22', '1', 'kas berkurang', '', 'kredit', '1014000', 0, '2023-11-17'),
(547, 'PU-20112023-23', '4', 'pembelian umum lunas', '[\"Tali Vanbelt\",\"By Panaskan Mesin Grub Usman\",\"Jumat Berkah Grub Usman\",\"DP 4 Pengerjaan Atap\",\"Bensin Motor Pabrik\",\"Isi Ulang Kartu Tol\",\"Parkir Bandara\"]', 'debit', '8663000', 0, '2023-11-19'),
(548, 'PU-20112023-23', '1', 'kas berkurang', '', 'kredit', '8663000', 0, '2023-11-19'),
(549, 'PB-20112023-10', '4', 'pembelian bahan kredit', '[\"Solar High Speed Diesel\"]', 'debit', '12100000', 0, '2023-11-20'),
(550, 'PB-20112023-10', '2', 'hutang bertambah', '', 'kredit', '12100000', 0, '2023-11-20');

-- --------------------------------------------------------

--
-- Table structure for table `t_karyawan`
--

CREATE TABLE `t_karyawan` (
  `karyawan_id` int(11) NOT NULL,
  `karyawan_nama` text NOT NULL,
  `karyawan_telp` text NOT NULL,
  `karyawan_alamat` text NOT NULL,
  `karyawan_tanggal` date NOT NULL DEFAULT curdate(),
  `karyawan_hapus` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `t_karyawan`
--

INSERT INTO `t_karyawan` (`karyawan_id`, `karyawan_nama`, `karyawan_telp`, `karyawan_alamat`, `karyawan_tanggal`, `karyawan_hapus`) VALUES
(6, 'Bohari', '085341932338', 'Maros', '2023-06-13', 0),
(7, 'Usman', '0812432223112', 'Takalar', '2023-06-13', 0);

-- --------------------------------------------------------

--
-- Table structure for table `t_kontak`
--

CREATE TABLE `t_kontak` (
  `kontak_id` int(11) NOT NULL,
  `kontak_jenis` set('s','p') NOT NULL,
  `kontak_kode` text NOT NULL,
  `kontak_nama` text NOT NULL,
  `kontak_alamat` text NOT NULL,
  `kontak_tlp` text NOT NULL,
  `kontak_email` text NOT NULL,
  `kontak_rek` text NOT NULL,
  `kontak_bank` text NOT NULL,
  `kontak_npwp` text NOT NULL,
  `kontak_tanggal` date NOT NULL DEFAULT curdate(),
  `kontak_hapus` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `t_kontak`
--

INSERT INTO `t_kontak` (`kontak_id`, `kontak_jenis`, `kontak_kode`, `kontak_nama`, `kontak_alamat`, `kontak_tlp`, `kontak_email`, `kontak_rek`, `kontak_bank`, `kontak_npwp`, `kontak_tanggal`, `kontak_hapus`) VALUES
(16, 's', 'SP001', 'Pak Rusmin', 'Jl. Dr. Wahidin Sudiro Husodo', '08124208138', 'rusmin_gomasjaya@gmail.com', '0251354838', '8', '0000', '2023-06-13', 0),
(17, 'p', 'PL001', 'JAYA ALUMINIUM', 'Jl. Maccini Baru', '00', '00', '00', '8', '00', '2023-06-14', 0),
(18, 's', 'SP002', 'PT. Eternal Sun Indonesia', 'Surabaya', '12313123123', 'eterna@eternal.co.id', '40450500123', '8', '123123123123', '2023-07-03', 0),
(20, 's', 'SP003', 'PT. Indonesia Asahan Aluminium', 'Surabaya Medan', '123123123', 'inalum.id', '1231231', '1', '13212312', '2023-08-04', 0),
(21, 's', 'SP004', 'Pak Bahar', 'Salodong', '123123123', 'bahar', '123123', '2', '123123123', '2023-08-04', 0),
(22, 's', 'SP005', 'Mas Budi', 'Maros', '123', '-', '123', '1', '00', '2023-11-07', 0),
(23, 's', 'SP006', 'Pak Erik', 'Jl. Korban 4.000 Jiwa', '085299651158', '-', '0', '1', '0', '2023-11-07', 0),
(24, 's', 'SP007', 'PT. Indokemika Jayatama', 'Jl.Margomulyo No 44 Surabaya', '0317483171', '-', '00', '1', '-', '2023-11-13', 0),
(25, 's', 'SP008', 'Pak Ammang', 'Jl.Sunu', '0', '00', '00', '1', '00', '2023-11-15', 0);

-- --------------------------------------------------------

--
-- Table structure for table `t_level`
--

CREATE TABLE `t_level` (
  `level_id` int(11) NOT NULL,
  `level_nama` text DEFAULT NULL,
  `level_akses` text DEFAULT NULL,
  `level_tanggal` date DEFAULT curdate(),
  `level_hapus` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `t_level`
--

INSERT INTO `t_level` (`level_id`, `level_nama`, `level_akses`, `level_tanggal`, `level_hapus`) VALUES
(3, 'Kasir', '{\"nama\":\"Kasir\",\"menu_dashboard\":\"0\",\"menu_kontak\":\"0\",\"karyawan\":\"0\",\"karyawan_add\":\"0\",\"karyawan_del\":\"0\",\"supplier\":\"0\",\"supplier_add\":\"0\",\"supplier_del\":\"0\",\"pelanggan\":\"0\",\"pelanggan_add\":\"0\",\"pelanggan_del\":\"0\",\"rekening\":\"0\",\"rekening_add\":\"0\",\"rekening_del\":\"0\",\"menu_satuan\":\"0\",\"satuan\":\"0\",\"satuan_add\":\"0\",\"satuan_del\":\"0\",\"menu_pembelian\":\"1\",\"bahan\":\"1\",\"bahan_add\":\"0\",\"bahan_del\":\"0\",\"bahan_po\":\"1\",\"bahan_po_add\":\"1\",\"bahan_po_del\":\"1\",\"pembelian_bahan\":\"1\",\"pembelian_bahan_add\":\"1\",\"pembelian_bahan_del\":\"1\",\"pembelian_umum\":\"1\",\"pembelian_umum_add\":\"1\",\"pembelian_umum_del\":\"1\",\"hutang\":\"1\",\"hutang_add\":\"1\",\"menu_produksi\":\"0\",\"mesin\":\"0\",\"mesin_add\":\"0\",\"mesin_del\":\"0\",\"peleburan\":\"0\",\"peleburan_add\":\"0\",\"peleburan_del\":\"0\",\"produksi\":\"0\",\"produksi_add\":\"0\",\"produksi_del\":\"0\",\"pewarnaan\":\"0\",\"pewarnaan_add\":\"0\",\"pewarnaan_del\":\"0\",\"packing\":\"0\",\"packing_add\":\"0\",\"packing_del\":\"0\",\"menu_produk\":\"1\",\"jenis_pewarnaan\":\"0\",\"jenis_pewarnaan_add\":\"0\",\"warna_produk\":\"0\",\"warna_produk_add\":\"0\",\"warna_produk_del\":\"0\",\"master_produk\":\"1\",\"master_produk_add\":\"0\",\"master_produk_del\":\"0\",\"menu_penjualan\":\"1\",\"penjualan_po\":\"1\",\"penjualan_po_add\":\"1\",\"penjualan_po_del\":\"1\",\"penjualan_produk\":\"1\",\"penjualan_produk_add\":\"1\",\"penjualan_produk_del\":\"1\",\"piutang\":\"1\",\"piutang_add\":\"1\",\"menu_keuangan\":\"0\",\"coa\":\"0\",\"coa_add\":\"0\",\"coa_del\":\"0\",\"kas\":\"0\",\"kas_add\":\"0\",\"kas_del\":\"0\",\"jurnal\":\"0\",\"jurnal_add\":\"0\",\"jurnal_del\":\"0\",\"buku_besar\":\"0\",\"buku_besar_add\":\"0\",\"buku_besar_del\":\"0\",\"penyesuaian\":\"0\",\"penyesuaian_add\":\"0\",\"penyesuaian_del\":\"0\",\"menu_laporan\":\"1\",\"laporan_bahan\":\"1\",\"laporan_produk\":\"1\",\"laporan_produksi\":\"0\",\"laporan_pembelian_po\":\"1\",\"laporan_pembelian\":\"1\",\"laporan_hutang\":\"1\",\"laporan_hutang_jatuh_tampo\":\"1\",\"laporan_penjualan\":\"1\",\"laporan_piutang\":\"1\",\"laporan_piutang_jatuh_tampo\":\"1\",\"laporan_pewarnaan\":\"0\",\"laporan_packing\":\"0\",\"menu_inventori\":\"0\",\"opname_pembelian\":\"0\",\"opname_penjualan\":\"0\",\"penyesuaian_stok\":\"0\",\"penyesuaian_stok_add\":\"0\",\"penyesuaian_stok_del\":\"0\",\"menu_akun\":\"0\",\"akses\":\"0\",\"akses_add\":\"0\",\"akses_del\":\"0\",\"user_akun\":\"0\",\"user_akun_add\":\"0\",\"user_akun_del\":\"0\",\"admin_akun\":\"0\",\"admin_akun_add\":\"0\",\"admin_akun_del\":\"0\",\"menu_pengaturan\":\"0\",\"pajak\":\"0\",\"pajak_add\":\"0\",\"backup\":\"0\",\"informasi\":\"0\"}', '2023-06-01', 1),
(4, 'General Admin', '{\"nama\":\"General Admin\",\"menu_dashboard\":\"1\",\"menu_kontak\":\"1\",\"karyawan\":\"1\",\"karyawan_add\":\"1\",\"karyawan_del\":\"0\",\"supplier\":\"1\",\"supplier_add\":\"1\",\"supplier_del\":\"0\",\"pelanggan\":\"1\",\"pelanggan_add\":\"1\",\"pelanggan_del\":\"0\",\"rekening\":\"1\",\"rekening_add\":\"1\",\"rekening_del\":\"0\",\"menu_satuan\":\"1\",\"satuan\":\"1\",\"satuan_add\":\"1\",\"satuan_del\":\"0\",\"menu_pembelian\":\"1\",\"bahan\":\"1\",\"bahan_add\":\"1\",\"bahan_del\":\"0\",\"bahan_po\":\"1\",\"bahan_po_add\":\"1\",\"bahan_po_del\":\"0\",\"pembelian_bahan\":\"1\",\"pembelian_bahan_add\":\"1\",\"pembelian_bahan_del\":\"0\",\"pembelian_umum\":\"1\",\"pembelian_umum_add\":\"1\",\"pembelian_umum_del\":\"0\",\"hutang\":\"1\",\"hutang_add\":\"0\",\"menu_produksi\":\"1\",\"mesin\":\"1\",\"mesin_add\":\"1\",\"mesin_del\":\"0\",\"peleburan\":\"1\",\"peleburan_add\":\"1\",\"peleburan_del\":\"0\",\"produksi\":\"1\",\"produksi_add\":\"1\",\"produksi_del\":\"0\",\"pewarnaan\":\"1\",\"pewarnaan_add\":\"1\",\"pewarnaan_del\":\"0\",\"packing\":\"1\",\"packing_add\":\"1\",\"packing_del\":\"0\",\"menu_produk\":\"1\",\"jenis_pewarnaan\":\"1\",\"jenis_pewarnaan_add\":\"0\",\"warna_produk\":\"1\",\"warna_produk_add\":\"0\",\"warna_produk_del\":\"0\",\"master_produk\":\"1\",\"master_produk_add\":\"1\",\"master_produk_del\":\"0\",\"menu_penjualan\":\"1\",\"penjualan_po\":\"1\",\"penjualan_po_add\":\"1\",\"penjualan_po_del\":\"0\",\"penjualan_produk\":\"1\",\"penjualan_produk_add\":\"1\",\"penjualan_produk_del\":\"0\",\"piutang\":\"1\",\"piutang_add\":\"1\",\"menu_keuangan\":\"1\",\"coa\":\"1\",\"coa_add\":\"1\",\"coa_del\":\"0\",\"kas\":\"1\",\"kas_add\":\"1\",\"kas_del\":\"0\",\"jurnal\":\"1\",\"jurnal_add\":\"1\",\"jurnal_del\":\"0\",\"buku_besar\":\"1\",\"buku_besar_add\":\"1\",\"buku_besar_del\":\"0\",\"penyesuaian\":\"1\",\"penyesuaian_add\":\"1\",\"penyesuaian_del\":\"0\",\"menu_laporan\":\"1\",\"laporan_bahan\":\"1\",\"laporan_produk\":\"1\",\"laporan_produksi\":\"1\",\"laporan_pembelian_po\":\"1\",\"laporan_pembelian\":\"1\",\"laporan_hutang\":\"1\",\"laporan_hutang_jatuh_tampo\":\"1\",\"laporan_penjualan\":\"1\",\"laporan_piutang\":\"1\",\"laporan_piutang_jatuh_tampo\":\"1\",\"laporan_pewarnaan\":\"1\",\"laporan_packing\":\"1\",\"menu_inventori\":\"1\",\"opname_pembelian\":\"1\",\"opname_penjualan\":\"1\",\"penyesuaian_stok\":\"1\",\"penyesuaian_stok_add\":\"0\",\"penyesuaian_stok_del\":\"0\",\"menu_akun\":\"0\",\"akses\":\"0\",\"akses_add\":\"0\",\"akses_del\":\"0\",\"user_akun\":\"0\",\"user_akun_add\":\"0\",\"user_akun_del\":\"0\",\"admin_akun\":\"0\",\"admin_akun_add\":\"0\",\"admin_akun_del\":\"0\",\"menu_pengaturan\":\"0\",\"pajak\":\"0\",\"pajak_add\":\"0\",\"backup\":\"0\",\"informasi\":\"0\"}', '2023-11-02', 0);

-- --------------------------------------------------------

--
-- Table structure for table `t_logo`
--

CREATE TABLE `t_logo` (
  `logo_id` int(11) NOT NULL,
  `logo_foto` text NOT NULL,
  `logo_nama` text NOT NULL,
  `logo_telp` text NOT NULL,
  `logo_kota` text NOT NULL,
  `logo_alamat` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `t_logo`
--

INSERT INTO `t_logo` (`logo_id`, `logo_foto`, `logo_nama`, `logo_telp`, `logo_kota`, `logo_alamat`) VALUES
(1, '3d00876ae06414f4347830ac266f84c4.png', 'PT.RAJAWALI  ALUMUNIUM  PERKASA', '0411-4723184', 'Makassar', 'Jl. KIMA 16 Kav DD 7');

-- --------------------------------------------------------

--
-- Table structure for table `t_mesin`
--

CREATE TABLE `t_mesin` (
  `mesin_id` int(11) NOT NULL,
  `mesin_kode` text NOT NULL,
  `mesin_nama` text NOT NULL,
  `mesin_hapus` int(11) NOT NULL DEFAULT 0,
  `mesin_tanggal` date NOT NULL DEFAULT curdate()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `t_mesin`
--

INSERT INTO `t_mesin` (`mesin_id`, `mesin_kode`, `mesin_nama`, `mesin_hapus`, `mesin_tanggal`) VALUES
(5, 'PRD-001-600T', 'Mesin 1 600T', 0, '2023-06-14'),
(6, 'PRD-002-800T', 'Mesin 2 800T', 0, '2023-08-04');

-- --------------------------------------------------------

--
-- Table structure for table `t_packing`
--

CREATE TABLE `t_packing` (
  `packing_id` int(11) NOT NULL,
  `packing_nomor` text DEFAULT NULL,
  `packing_user` text DEFAULT NULL,
  `packing_tanggal` date DEFAULT curdate(),
  `packing_hapus` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `t_packing_barang`
--

CREATE TABLE `t_packing_barang` (
  `packing_barang_id` int(11) NOT NULL,
  `packing_barang_nomor` text DEFAULT NULL,
  `packing_barang_barang` text DEFAULT NULL,
  `packing_barang_stok` text DEFAULT NULL,
  `packing_barang_jenis` text DEFAULT NULL,
  `packing_barang_warna` text DEFAULT NULL,
  `packing_barang_qty` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `t_pajak`
--

CREATE TABLE `t_pajak` (
  `pajak_id` int(11) NOT NULL,
  `pajak_jenis` enum('pembelian','penjualan') NOT NULL,
  `pajak_persen` text NOT NULL,
  `pajak_tanggal` date NOT NULL DEFAULT curdate(),
  `pajak_update` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `t_pajak`
--

INSERT INTO `t_pajak` (`pajak_id`, `pajak_jenis`, `pajak_persen`, `pajak_tanggal`, `pajak_update`) VALUES
(1, 'pembelian', '11', '2022-12-03', '2022-12-02 17:49:05'),
(2, 'penjualan', '11', '2022-12-03', '2022-12-02 17:49:10');

-- --------------------------------------------------------

--
-- Table structure for table `t_peleburan`
--

CREATE TABLE `t_peleburan` (
  `peleburan_id` int(11) NOT NULL,
  `peleburan_nomor` text NOT NULL,
  `peleburan_tanggal` date NOT NULL,
  `peleburan_qty_akhir` text DEFAULT NULL,
  `peleburan_jasa` text DEFAULT NULL,
  `peleburan_billet` text DEFAULT NULL,
  `peleburan_billet_sisa` text DEFAULT NULL,
  `peleburan_biaya` text DEFAULT NULL,
  `peleburan_hapus` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `t_peleburan`
--

INSERT INTO `t_peleburan` (`peleburan_id`, `peleburan_nomor`, `peleburan_tanggal`, `peleburan_qty_akhir`, `peleburan_jasa`, `peleburan_billet`, `peleburan_billet_sisa`, `peleburan_biaya`, `peleburan_hapus`) VALUES
(31, 'PLB-02112023-1', '2023-11-02', '0', '0', '9000', '0', '0', 1);

-- --------------------------------------------------------

--
-- Table structure for table `t_peleburan_barang`
--

CREATE TABLE `t_peleburan_barang` (
  `peleburan_barang_id` int(11) NOT NULL,
  `peleburan_barang_nomor` text NOT NULL,
  `peleburan_barang_barang` text NOT NULL,
  `peleburan_barang_stok` text NOT NULL,
  `peleburan_barang_qty` text NOT NULL,
  `peleburan_barang_harga` text NOT NULL,
  `peleburan_barang_subtotal` text NOT NULL,
  `peleburan_barang_tanggal` date NOT NULL DEFAULT curdate()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `t_peleburan_barang`
--

INSERT INTO `t_peleburan_barang` (`peleburan_barang_id`, `peleburan_barang_nomor`, `peleburan_barang_barang`, `peleburan_barang_stok`, `peleburan_barang_qty`, `peleburan_barang_harga`, `peleburan_barang_subtotal`, `peleburan_barang_tanggal`) VALUES
(195, 'PLB-02112023-1', '13', '0', '0', '0', '0', '2023-11-02');

-- --------------------------------------------------------

--
-- Table structure for table `t_pembelian`
--

CREATE TABLE `t_pembelian` (
  `pembelian_id` int(11) NOT NULL,
  `pembelian_user` text NOT NULL,
  `pembelian_po` int(11) NOT NULL DEFAULT 0,
  `pembelian_po_tanggal` text NOT NULL DEFAULT '',
  `pembelian_nomor` text NOT NULL,
  `pembelian_supplier` text NOT NULL,
  `pembelian_tanggal` date NOT NULL,
  `pembelian_jatuh_tempo` date NOT NULL,
  `pembelian_status` enum('lunas','belum') NOT NULL COMMENT 'l = lunas | b = belum lunas',
  `pembelian_hutang` enum('1','0') NOT NULL DEFAULT '0' COMMENT '1 = ada hutang | 0 = tidak ada',
  `pembelian_pelunasan` text DEFAULT NULL,
  `pembelian_pelunasan_keterangan` text NOT NULL,
  `pembelian_pembayaran` text DEFAULT NULL,
  `pembelian_keterangan` text NOT NULL,
  `pembelian_lampiran` text NOT NULL,
  `pembelian_qty_akhir` text DEFAULT NULL,
  `pembelian_ppn` text DEFAULT NULL,
  `pembelian_total` text DEFAULT NULL,
  `pembelian_hapus` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `t_pembelian`
--

INSERT INTO `t_pembelian` (`pembelian_id`, `pembelian_user`, `pembelian_po`, `pembelian_po_tanggal`, `pembelian_nomor`, `pembelian_supplier`, `pembelian_tanggal`, `pembelian_jatuh_tempo`, `pembelian_status`, `pembelian_hutang`, `pembelian_pelunasan`, `pembelian_pelunasan_keterangan`, `pembelian_pembayaran`, `pembelian_keterangan`, `pembelian_lampiran`, `pembelian_qty_akhir`, `pembelian_ppn`, `pembelian_total`, `pembelian_hapus`) VALUES
(109, '85', 1, '2023-11-02', 'PB-02112023-1', '16', '2023-11-02', '2023-11-02', 'lunas', '0', NULL, '', 'tunai', '', '', '500', '11', '16650000', 1),
(110, '5', 0, '', 'PB-08112023-2', '22', '2023-11-08', '2023-11-22', 'lunas', '1', '2023-11-10', 'Lunas', '7', '', '', '940', '0', '25326000', 0),
(111, '85', 0, '', 'PB-08112023-3', '23', '2023-11-08', '2024-01-08', 'belum', '1', NULL, '', '7', '', '', '2220', '0', '61936000', 0),
(112, '5', 0, '', 'PB-09112023-4', '23', '2023-11-09', '2024-01-09', 'belum', '1', NULL, '', '7', '', '', '2020', '0', '56168000', 0),
(113, '5', 0, '', '', '', '0000-00-00', '0000-00-00', '', '0', NULL, '', '', '', '', '', '', '', 0),
(114, '5', 0, '', 'PB-13112023-6', '24', '2023-11-13', '2023-11-13', 'lunas', '0', NULL, '', '7', 'Untuk Desing &amp; Matras', '', '1000', '11', '12543000', 0),
(115, '5', 0, '', 'PB-15112023-7', '25', '2023-11-15', '2023-11-15', 'lunas', '1', '2023-11-16', 'Lunas', '7', 'Rekening BRI381901031941538An.Nur Devi Sandi', '', '350', '0', '9450000', 0),
(116, '85', 0, '', 'PB-15112023-8', '23', '2023-11-15', '2023-12-15', 'belum', '1', NULL, '', '7', '', '', '950', '0', '27805000', 0),
(117, '5', 0, '', 'PB-17112023-9', '16', '2023-11-17', '2023-12-01', 'belum', '1', NULL, '', '7', 'Karung 24 Lbr', '', '1004', '0', '27610000', 0),
(118, '5', 0, '', 'PB-20112023-10', '22', '2023-11-20', '2023-11-21', 'belum', '1', NULL, '', '7', '', '', '1100', '0', '12100000', 0);

-- --------------------------------------------------------

--
-- Table structure for table `t_pembelian_barang`
--

CREATE TABLE `t_pembelian_barang` (
  `pembelian_barang_id` int(11) NOT NULL,
  `pembelian_barang_nomor` text NOT NULL,
  `pembelian_barang_barang` text NOT NULL,
  `pembelian_barang_stok` text NOT NULL,
  `pembelian_barang_qty` text NOT NULL,
  `pembelian_barang_potongan` text NOT NULL,
  `pembelian_barang_harga` text NOT NULL,
  `pembelian_barang_subtotal` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `t_pembelian_barang`
--

INSERT INTO `t_pembelian_barang` (`pembelian_barang_id`, `pembelian_barang_nomor`, `pembelian_barang_barang`, `pembelian_barang_stok`, `pembelian_barang_qty`, `pembelian_barang_potongan`, `pembelian_barang_harga`, `pembelian_barang_subtotal`) VALUES
(471, 'PB-02112023-1', '13', '0', '500', '0', '30000', '15000000'),
(472, 'PB-08112023-2', '13', '0', '940', '2', '27000', '25326000'),
(473, 'PB-08112023-3', '13', '938', '1160', '6', '28000', '32312000'),
(474, 'PB-08112023-3', '13', '938', '1060', '2', '28000', '29624000'),
(476, 'PB-09112023-4', '13', '3150', '2020', '14', '28000', '56168000'),
(477, 'PB-13112023-6', '27', '0', '1000', '0', '11300', '11300000'),
(478, 'PB-15112023-7', '13', '5156', '350', '0', '27000', '9450000'),
(479, 'PB-15112023-8', '14', '0', '420', '0', '31500', '13230000'),
(480, 'PB-15112023-8', '13', '5506', '530', '0', '27500', '14575000'),
(481, 'PB-17112023-9', '13', '6036', '1010', '6', '27500', '27610000'),
(482, 'PB-20112023-10', '23', '0', '1100', '0', '11000', '12100000');

-- --------------------------------------------------------

--
-- Table structure for table `t_pembelian_umum`
--

CREATE TABLE `t_pembelian_umum` (
  `pembelian_umum_id` int(11) NOT NULL,
  `pembelian_umum_user` text NOT NULL,
  `pembelian_umum_nomor` text NOT NULL,
  `pembelian_umum_tanggal` date NOT NULL DEFAULT curdate(),
  `pembelian_umum_jatuh_tempo` text NOT NULL,
  `pembelian_umum_status` enum('lunas','belum') NOT NULL COMMENT 'l = lunas | b = belum',
  `pembelian_umum_hutang` enum('1','0') NOT NULL COMMENT '1 = ada hutang | 0 = tidak ada',
  `pembelian_umum_pelunasan` text DEFAULT NULL,
  `pembelian_umum_pelunasan_keterangan` text DEFAULT NULL,
  `pembelian_umum_pembayaran` text NOT NULL,
  `pembelian_umum_keterangan` text NOT NULL,
  `pembelian_umum_lampiran` text NOT NULL,
  `pembelian_umum_qty_akhir` text NOT NULL,
  `pembelian_umum_ppn` text NOT NULL,
  `pembelian_umum_total` text NOT NULL,
  `pembelian_umum_hapus` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `t_pembelian_umum`
--

INSERT INTO `t_pembelian_umum` (`pembelian_umum_id`, `pembelian_umum_user`, `pembelian_umum_nomor`, `pembelian_umum_tanggal`, `pembelian_umum_jatuh_tempo`, `pembelian_umum_status`, `pembelian_umum_hutang`, `pembelian_umum_pelunasan`, `pembelian_umum_pelunasan_keterangan`, `pembelian_umum_pembayaran`, `pembelian_umum_keterangan`, `pembelian_umum_lampiran`, `pembelian_umum_qty_akhir`, `pembelian_umum_ppn`, `pembelian_umum_total`, `pembelian_umum_hapus`) VALUES
(31, '5', 'PU-06112023-1', '2023-11-01', '2023-11-01', 'lunas', '0', NULL, NULL, '7', 'Saldo Awal Rp.4.993.590Sisa Kas Rp. 4.411.590', '', '8', '0', '582000', 0),
(32, '5', 'PU-06112023-2', '2023-11-02', '2023-11-02', 'lunas', '0', NULL, NULL, '7', '\r\n\r\nSaldo Awal Rp. 4.411.590\r\n\r\nSisa KAs Rp. 3.703.590', '', '15', '0', '708000', 0),
(33, '5', 'PU-06112023-3', '2023-11-03', '2023-11-03', 'lunas', '0', NULL, NULL, '7', '\r\n\r\nSaldo Awal Rp. 3.703.590Tambahan Kas Rp.12.000.000Sisa KAs Rp. 7.331.590', '', '6', '0', '8372000', 0),
(34, '5', 'PU-06112023-4', '2023-11-04', '2023-11-04', 'lunas', '0', NULL, NULL, '7', '\r\n\r\nSaldo Awal Rp.7.331.590Sisa KAs Rp. 6.705.590', '', '4', '0', '626000', 0),
(35, '5', 'PU-07112023-5', '2023-11-06', '2023-11-06', 'lunas', '0', NULL, NULL, '7', 'Saldo Awal Rp.6.705.000Saldo Akhir Rp. 6.480.590', '', '2', '0', '225000', 1),
(36, '5', 'PU-07112023-5', '2023-11-06', '2023-11-06', 'lunas', '0', NULL, NULL, '7', 'Saldo Awal Rp. 6.705.590Saldo Akhir Rp. 4.403.590', '', '17', '0', '2302000', 1),
(37, '5', 'PU-07112023-5', '2023-11-06', '2023-11-06', 'lunas', '0', NULL, NULL, '7', 'Saldo Awal Rp. 6.705.590&nbsp;Saldo Akhir Rp. 4.403.590', '', '1', '11', '222000', 1),
(38, '5', 'PU-07112023-5', '2023-11-06', '2023-11-06', 'lunas', '0', NULL, NULL, '7', 'Saldo Awal Rp. 6.705.590&nbsp;&nbsp;saldo Akhir Rp. 4.403.590', '', '17', '0', '2302000', 1),
(39, '5', 'PU-07112023-6', '2023-11-06', '2023-11-06', 'lunas', '0', NULL, NULL, '7', 'Saldo Awal Rp. 6.705.590&nbsp;saldo akhir Rp.4.403.590', '', '17', '0', '2302000', 0),
(40, '5', 'PU-08112023-10', '2023-11-07', '2023-11-07', 'lunas', '0', NULL, NULL, '7', 'Saldo Awal Rp. 4.403.590Saldo Akhir Rp. 4.103.590', '', '1', '0', '300000', 1),
(41, '5', 'PU-08112023-7', '2023-11-07', '2023-11-07', 'lunas', '0', NULL, NULL, '7', 'Saldo Awal Rp. 4.403.590Saldo Akhir Rp. 4.103.590', '', '1', '0', '300000', 0),
(42, '5', 'PU-09112023-8', '2023-11-08', '2023-11-08', 'lunas', '0', NULL, NULL, '7', 'Saldo Awal Rp. 4.103.590Saldo Akhir Rp. 3.587.590', '', '2', '0', '516000', 0),
(45, '5', 'PU-10112023-13', '2023-11-10', '2023-11-10', 'lunas', '0', NULL, NULL, 'tunai', '<p>satu</p><p>dua</p><p>tiga</p>', '', '1', '0', '12000', 1),
(46, '5', 'PU-10112023-14', '2023-11-09', '2023-11-09', 'lunas', '0', NULL, NULL, '7', '<p>Saldo Awal Rp. 3.587.590</p><p>Saldo Akhir Rp. 3.527.590</p>', '', '12', '0', '60000', 0),
(47, '5', 'PU-11112023-15', '2023-11-10', '2023-11-10', 'lunas', '0', NULL, NULL, '7', '<p>Saldo Awal Rp. 3.527.590</p><p>Sisa KAs Rp. 3.152.590</p>', '', '4', '0', '375000', 0),
(48, '5', 'PU-13112023-16', '2023-11-11', '2023-11-11', 'lunas', '0', NULL, NULL, '7', '<p>Saldo Awal Rp. 3.152.590</p><p>Uang Masuk Rp.8.000.000</p><p>Saldo Akhir Rp. 2.864.590</p>', '', '5', '0', '8288000', 0),
(49, '5', 'PU-15112023-17', '2023-11-13', '2023-11-13', 'lunas', '0', NULL, NULL, '7', '<p>Saldo Awal Rp. 2.864.590</p><p>Saldo AKhir Rp. 1.684.590</p>', '', '16', '0', '1180000', 0),
(50, '5', 'PU-15112023-18', '2023-11-14', '2023-11-14', 'lunas', '0', NULL, NULL, '7', '<p>Saldo Awal Rp. 1.684.590</p><p>Saldo Akhir Rp. 1.372.590</p>', '', '72', '0', '612000', 1),
(51, '5', 'PU-15112023-19', '2023-11-14', '2023-11-14', 'lunas', '0', NULL, NULL, '7', '<p>Saldo Awal Rp. 1.684.590</p><p>Bon Sementara Rp. 1.028.000</p><p>Saldo Akhir Harusnya Rp. 1.072.590, Tapi Karena Ada Bon Sementara Jadi&nbsp;</p><p>SISA Kas Rp. 44.590&nbsp;</p>', '', '72', '0', '612000', 0),
(52, '5', 'PU-16112023-20', '2023-11-15', '2023-11-15', 'lunas', '0', NULL, NULL, '7', '<p>Saldo Awal Rp. 1.072.590</p><p>Saldo Akhir Rp. 676.590</p><p><br></p>', '', '2', '0', '396000', 0),
(53, '5', 'PU-18112023-21', '2023-11-16', '2023-11-16', 'lunas', '0', NULL, NULL, '7', '<p>Saldo Awal Rp. 676.590</p><p>Uang Masuk 5.000.000</p><p>Sisa Kas Rp. 5.547.590</p>', '', '3', '0', '129000', 0),
(54, '5', 'PU-18112023-22', '2023-11-17', '2023-11-17', 'lunas', '0', NULL, NULL, '7', '<p>Saldo Awal Rp. 5.547.590</p><p>Saldo Akhir Rp. 4.533.590</p>', '', '23', '0', '1014000', 0),
(55, '5', 'PU-20112023-23', '2023-11-18', '2023-11-18', 'lunas', '0', NULL, NULL, '7', '<p>Saldo Awal Rp. 4.533.590</p><p>Uang Masuk Untuk MAs Tarjo 8.000.000 (Sisa 17 Jt)</p><p>Bon Sementara Dan Untuk beli Alat Rp. 2.520.000</p><p>Sisa KAs Rp. 1.350.590</p>', '', '8', '0', '8663000', 0);

-- --------------------------------------------------------

--
-- Table structure for table `t_pembelian_umum_barang`
--

CREATE TABLE `t_pembelian_umum_barang` (
  `pembelian_umum_barang_id` int(11) NOT NULL,
  `pembelian_umum_barang_nomor` text NOT NULL,
  `pembelian_umum_barang_barang` text NOT NULL,
  `pembelian_umum_barang_qty` text NOT NULL,
  `pembelian_umum_barang_potongan` text NOT NULL,
  `pembelian_umum_barang_harga` text NOT NULL,
  `pembelian_umum_barang_subtotal` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `t_pembelian_umum_barang`
--

INSERT INTO `t_pembelian_umum_barang` (`pembelian_umum_barang_id`, `pembelian_umum_barang_nomor`, `pembelian_umum_barang_barang`, `pembelian_umum_barang_qty`, `pembelian_umum_barang_potongan`, `pembelian_umum_barang_harga`, `pembelian_umum_barang_subtotal`) VALUES
(60, 'PU-06112023-1', 'Plat Strip', '1', '0', '195000', '195000'),
(61, 'PU-06112023-1', 'Solar Mobil Hitam', '1', '0', '226000', '226000'),
(62, 'PU-06112023-1', 'Materai', '5', '0', '12000', '60000'),
(63, 'PU-06112023-1', 'Isi Ulang Kartu Tol', '1', '0', '101000', '101000'),
(64, 'PU-06112023-2', 'Pelunasan Pengerjaan Forklip', '1', '0', '500000', '500000'),
(65, 'PU-06112023-2', 'Air Galon', '12', '0', '5000', '60000'),
(66, 'PU-06112023-2', 'Spidol,Map,Pulpen & Cutter', '1', '0', '118000', '118000'),
(67, 'PU-06112023-2', 'Bensin Motor Pabrik', '1', '0', '30000', '30000'),
(68, 'PU-06112023-3', 'Cat Protektive', '1', '0', '695000', '695000'),
(69, 'PU-06112023-3', 'Baut Galvanis & Rantai Kapal', '1', '0', '92000', '92000'),
(70, 'PU-06112023-3', 'DP 2 Pengerjaan Atap (Sisa 33 Juta)', '1', '0', '7000000', '7000000'),
(71, 'PU-06112023-3', 'Jumat Berkah Grub Usman', '1', '0', '50000', '50000'),
(72, 'PU-06112023-3', 'Bensin Motor Pabrik (28/10/2023)', '1', '0', '35000', '35000'),
(73, 'PU-06112023-3', 'Uang Jalan Daerah ( 02/11/2023)', '1', '0', '500000', '500000'),
(74, 'PU-06112023-4', 'Uang Jalan Daerah', '1', '0', '300000', '300000'),
(75, 'PU-06112023-4', 'By Timbangan Sidrap', '1', '0', '20000', '20000'),
(76, 'PU-06112023-4', 'Pass Kima Dari Sidrap', '1', '0', '6000', '6000'),
(77, 'PU-06112023-4', 'Bensin Ke Sidrap', '1', '0', '300000', '300000'),
(78, 'PU-07112023-5', 'Isi Ulang Kartu Tol', '1', '0', '200000', '200000'),
(79, 'PU-07112023-5', 'Cas Aki Forklip', '1', '0', '25000', '25000'),
(80, 'PU-07112023-5', 'Air Galon', '13', '0', '5000', '65000'),
(81, 'PU-07112023-5', 'Fee u/ Pak Anas', '1', '0', '2000000', '2000000'),
(82, 'PU-07112023-5', 'By Pass Kima Ke 2R', '1', '0', '12000', '12000'),
(83, 'PU-07112023-5', 'Isi Ulang Kartu Tol', '1', '0', '200000', '200000'),
(84, 'PU-07112023-5', 'By Cas Aki Mobll Hitam', '1', '0', '25000', '25000'),
(85, 'PU-07112023-5', 'Isi Ulang Kartu Toll', '1', '0', '200000', '200000'),
(86, 'PU-07112023-5', 'Masuk & Keluar Kima (2R)', '1', '0', '12000', '12000'),
(87, 'PU-07112023-5', 'Isi Ulang Kartu Toll', '1', '0', '200000', '200000'),
(88, 'PU-07112023-5', 'Cas Aki Forklip', '1', '0', '25000', '25000'),
(89, 'PU-07112023-5', 'Air Galon', '13', '0', '5000', '65000'),
(90, 'PU-07112023-5', 'Fee u/ Pak Anas', '1', '0', '2000000', '2000000'),
(91, 'PU-07112023-6', 'By Masuk & Keluar Kima (2R)', '1', '0', '12000', '12000'),
(92, 'PU-07112023-6', 'Fe u/ Pak Anas', '1', '0', '2000000', '2000000'),
(93, 'PU-07112023-6', 'Air Galon', '13', '0', '5000', '65000'),
(94, 'PU-07112023-6', 'Cas Aki Forklip', '1', '0', '25000', '25000'),
(95, 'PU-07112023-6', 'Isi Kartu Tol', '1', '0', '200000', '200000'),
(96, 'PU-08112023-10', 'Bensin Motor Pabrik', '1', '0', '300000', '300000'),
(97, 'PU-08112023-7', 'Bensin Mobil Pabrik', '1', '0', '300000', '300000'),
(98, 'PU-09112023-8', 'Lampu Sorot', '1', '0', '190000', '190000'),
(99, 'PU-09112023-8', 'Fan Ac 200x200x60', '1', '0', '326000', '326000'),
(102, 'PU-10112023-13', 'Nasi Goreng', '1', '0', '12000', '12000'),
(103, 'PU-10112023-14', 'Air Galon', '12', '0', '5000', '60000'),
(104, 'PU-11112023-15', 'Sadel Kabel & Terminal Kabel', '1', '0', '25000', '25000'),
(105, 'PU-11112023-15', 'Bensin Motor Sahar Urus STNK Mobil Pak Raimond', '1', '0', '50000', '50000'),
(106, 'PU-11112023-15', 'Kipas Angin u/ KKPAI + Kertas Kado', '1', '0', '250000', '250000'),
(107, 'PU-11112023-15', 'Jumat Berkah', '1', '0', '50000', '50000'),
(108, 'PU-13112023-16', 'DP 3 Pengerjaan Atap Sisa Rp. 25 Juta', '1', '0', '8000000', '8000000'),
(109, 'PU-13112023-16', 'Spidol', '2', '0', '9000', '18000'),
(110, 'PU-13112023-16', 'By Panaskan Mesin', '1', '0', '200000', '200000'),
(111, 'PU-13112023-16', 'By Sahar Ke BM', '1', '0', '70000', '70000'),
(112, 'PU-15112023-17', 'Air Galon', '12', '0', '5000', '60000'),
(113, 'PU-15112023-17', 'By Daerah & Tilang Polisi', '1', '0', '350000', '350000'),
(114, 'PU-15112023-17', 'Bensin Daerah', '1', '0', '300000', '300000'),
(115, 'PU-15112023-17', 'Plastik Bening 1 Roll', '1', '0', '420000', '420000'),
(116, 'PU-15112023-17', 'Isi ulang Kartu Toll', '1', '0', '50000', '50000'),
(117, 'PU-15112023-18', '1 Dos LAkban Bening 48x80x45', '72', '0', '8500', '612000'),
(118, 'PU-15112023-19', '1 Dos Lakban Bening 48x80x45', '72', '0', '8500', '612000'),
(119, 'PU-16112023-20', 'Pass Kima', '1', '0', '6000', '6000'),
(120, 'PU-16112023-20', 'Bensin Mobil PAbrik', '1', '0', '390000', '390000'),
(121, 'PU-18112023-21', 'Minyak Rem Forklip', '1', '0', '92000', '92000'),
(122, 'PU-18112023-21', 'Kran Air', '1', '0', '31000', '31000'),
(123, 'PU-18112023-21', 'Pass Kima', '1', '0', '6000', '6000'),
(124, 'PU-18112023-22', 'Cat Protektive dan Serat No drop', '1', '0', '845000', '845000'),
(125, 'PU-18112023-22', 'oli Motor pabrik', '1', '0', '63000', '63000'),
(126, 'PU-18112023-22', 'Air Galon', '20', '0', '5000', '100000'),
(127, 'PU-18112023-22', 'Pass Kima', '1', '0', '6000', '6000'),
(128, 'PU-20112023-23', 'Tali Vanbelt', '2', '0', '85000', '170000'),
(129, 'PU-20112023-23', 'By Panaskan Mesin Grub Usman', '1', '0', '200000', '200000'),
(130, 'PU-20112023-23', 'Jumat Berkah Grub Usman', '1', '0', '50000', '50000'),
(131, 'PU-20112023-23', 'DP 4 Pengerjaan Atap', '1', '0', '8000000', '8000000'),
(132, 'PU-20112023-23', 'Bensin Motor Pabrik', '1', '0', '37000', '37000'),
(133, 'PU-20112023-23', 'Isi Ulang Kartu Tol', '1', '0', '201000', '201000'),
(134, 'PU-20112023-23', 'Parkir Bandara', '1', '0', '5000', '5000');

-- --------------------------------------------------------

--
-- Table structure for table `t_penjualan`
--

CREATE TABLE `t_penjualan` (
  `penjualan_id` int(11) NOT NULL,
  `penjualan_user` text NOT NULL,
  `penjualan_so` int(11) NOT NULL DEFAULT 0,
  `penjualan_nomor` text NOT NULL,
  `penjualan_pelanggan` text NOT NULL,
  `penjualan_tanggal` date NOT NULL,
  `penjualan_jatuh_tempo` date NOT NULL,
  `penjualan_pembayaran` text DEFAULT NULL,
  `penjualan_keterangan` text NOT NULL,
  `penjualan_lampiran` text NOT NULL,
  `penjualan_qty_akhir` text DEFAULT NULL,
  `penjualan_ppn` text DEFAULT NULL,
  `penjualan_total` float DEFAULT 0,
  `penjualan_piutang` enum('1','0') DEFAULT '0' COMMENT '1 = ada piutang , 0 = tidak ada',
  `penjualan_status` set('lunas','belum') NOT NULL,
  `penjualan_pelunasan` date DEFAULT NULL,
  `penjualan_pelunasan_jumlah` float DEFAULT 0,
  `penjualan_pelunasan_keterangan` text DEFAULT NULL,
  `penjualan_hapus` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `t_penjualan_barang`
--

CREATE TABLE `t_penjualan_barang` (
  `penjualan_barang_id` int(11) NOT NULL,
  `penjualan_barang_nomor` text NOT NULL,
  `penjualan_barang_barang` text NOT NULL,
  `penjualan_barang_jenis` text NOT NULL,
  `penjualan_barang_warna` text NOT NULL,
  `penjualan_barang_stok` text NOT NULL,
  `penjualan_barang_qty` text NOT NULL,
  `penjualan_barang_potongan` text NOT NULL,
  `penjualan_barang_harga` text NOT NULL,
  `penjualan_barang_hps` text NOT NULL,
  `penjualan_barang_subtotal` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `t_penyesuaian`
--

CREATE TABLE `t_penyesuaian` (
  `penyesuaian_id` int(11) NOT NULL,
  `penyesuaian_nomor` text DEFAULT NULL,
  `penyesuaian_jenis` enum('penjualan','pembelian') NOT NULL,
  `penyesuaian_transaksi` enum('perhitungan','masuk','keluar') NOT NULL,
  `penyesuaian_kategori` enum('umum','rusak') NOT NULL,
  `penyesuaian_keterangan` text DEFAULT NULL,
  `penyesuaian_tanggal` date DEFAULT NULL,
  `penyesuaian_hapus` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `t_penyesuaian`
--

INSERT INTO `t_penyesuaian` (`penyesuaian_id`, `penyesuaian_nomor`, `penyesuaian_jenis`, `penyesuaian_transaksi`, `penyesuaian_kategori`, `penyesuaian_keterangan`, `penyesuaian_tanggal`, `penyesuaian_hapus`) VALUES
(41, 'PN-1699433376-1', 'pembelian', 'masuk', 'umum', '', '2023-11-08', 1),
(42, 'PN-1700445930-2', 'penjualan', 'masuk', 'umum', '', '2023-11-20', 0),
(43, '', '', '', '', '', '0000-00-00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `t_penyesuaian_barang`
--

CREATE TABLE `t_penyesuaian_barang` (
  `penyesuaian_barang_id` int(11) NOT NULL,
  `penyesuaian_barang_nomor` text DEFAULT NULL,
  `penyesuaian_barang_barang` text DEFAULT NULL,
  `penyesuaian_barang_jenis` text DEFAULT NULL,
  `penyesuaian_barang_warna` text DEFAULT NULL,
  `penyesuaian_barang_jumlah` text DEFAULT NULL,
  `penyesuaian_barang_stok` text DEFAULT NULL,
  `penyesuaian_barang_selisih` text DEFAULT NULL,
  `penyesuaian_barang_status` enum('bertambah','berkurang') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `t_penyesuaian_barang`
--

INSERT INTO `t_penyesuaian_barang` (`penyesuaian_barang_id`, `penyesuaian_barang_nomor`, `penyesuaian_barang_barang`, `penyesuaian_barang_jenis`, `penyesuaian_barang_warna`, `penyesuaian_barang_jumlah`, `penyesuaian_barang_stok`, `penyesuaian_barang_selisih`, `penyesuaian_barang_status`) VALUES
(55, 'PN-1699433376-1', '13', '', '', '1000', '3150', '2150', 'berkurang'),
(56, 'PN-1700445930-2', '26', '3', '0', '600', '0', '600', 'bertambah'),
(57, 'PN-1700445930-2', '23', '3', '0', '75', '0', '75', 'bertambah'),
(58, 'PN-1700445930-2', '25', '3', '0', '250', '0', '250', 'bertambah'),
(59, 'PN-1700445930-2', '30', '1', '12', '100', '0', '100', 'bertambah'),
(60, 'PN-1700445930-2', '22', '1', '12', '50', '0', '50', 'bertambah'),
(61, 'PN-1700445930-2', '46', '1', '13', '120', '0', '120', 'bertambah');

-- --------------------------------------------------------

--
-- Table structure for table `t_pewarnaan`
--

CREATE TABLE `t_pewarnaan` (
  `pewarnaan_id` int(11) NOT NULL,
  `pewarnaan_nomor` text DEFAULT NULL,
  `pewarnaan_user` text DEFAULT NULL,
  `pewarnaan_tanggal` date DEFAULT curdate(),
  `pewarnaan_hapus` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `t_pewarnaan_barang`
--

CREATE TABLE `t_pewarnaan_barang` (
  `pewarnaan_barang_id` int(11) NOT NULL,
  `pewarnaan_barang_nomor` text DEFAULT NULL,
  `pewarnaan_barang_barang` text DEFAULT NULL,
  `pewarnaan_barang_stok` text DEFAULT NULL,
  `pewarnaan_barang_jenis` text DEFAULT NULL,
  `pewarnaan_barang_warna` text DEFAULT NULL,
  `pewarnaan_barang_qty` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `t_produk`
--

CREATE TABLE `t_produk` (
  `produk_id` int(11) NOT NULL,
  `produk_kode` text NOT NULL,
  `produk_nama` text NOT NULL,
  `produk_satuan` text NOT NULL,
  `produk_merk` text NOT NULL,
  `produk_ketebalan` text NOT NULL,
  `produk_panjang` text NOT NULL,
  `produk_lebar` text NOT NULL,
  `produk_berat` text NOT NULL,
  `produk_keterangan` text NOT NULL,
  `produk_colly` text NOT NULL COMMENT 'jumlah isi / pack',
  `produk_update` date NOT NULL DEFAULT curdate(),
  `produk_tanggal` date NOT NULL DEFAULT curdate(),
  `produk_hapus` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `t_produk`
--

INSERT INTO `t_produk` (`produk_id`, `produk_kode`, `produk_nama`, `produk_satuan`, `produk_merk`, `produk_ketebalan`, `produk_panjang`, `produk_lebar`, `produk_berat`, `produk_keterangan`, `produk_colly`, `produk_update`, `produk_tanggal`, `produk_hapus`) VALUES
(15, 'RAP-HLLW-2020S-050', 'HOLLOW 20 X 20 KOTAK 0.50', '8', 'RAJAWALI', '0.50', '6000', '20', '', 'ALUMINIUM', '50', '2023-06-13', '2023-06-13', 1),
(16, 'RAP-HLLW-2020-050', 'HOLLOW 20 X 20 OVAL 0.50', '8', 'RAJAWALI', '0.50', '6000', '2', '', 'Aluminium', '50', '2023-06-13', '2023-06-13', 1),
(17, '110156', 'OPENBACK SAKURA 0.55 6 MTR', '8', 'RAJAWALI', '0.55', '600', '10', '', 'Sakura', '12', '2023-06-29', '2023-06-29', 1),
(18, '600303', 'TIANG 3.5 (F) 23 X 34 0.60 6 MTR', '8', 'RAJAWALI', '0.60', '600', '3', '', 'ALUMINIUM', '30', '2023-08-01', '2023-08-01', 1),
(19, '601003', 'HOLLOW ENGKEL (B.K) 0.60 6 MTR', '8', 'RAJAWALI', '0.60', '600', '22', '', 'ENGKEL', '30', '2023-08-03', '2023-08-03', 1),
(20, '240152', 'SPANDREL 93MM 0.55 6 MTR', '8', 'RAJAWALI', '0.55', '600', '9', '', 'spandrel', '20', '2023-08-04', '2023-08-04', 1),
(21, '600101', 'TIANG PINTU SAKURA 0.50 6 MTR', '8', 'RAJAWALI', '0.50', '600', '22', '', 'KOMODITI', '30', '2023-09-17', '2023-09-17', 1),
(22, '520503-600', 'SIKU GARIS 1/2\" (12CM) 0.60 6MTR', '8', 'RAJAWALI', '0.60', '600', '00', '', 'ALUMINIUM', '100', '2023-11-05', '2023-11-05', 0),
(23, '530114-600', 'SPIGOT 15 X 30 1.70 6MTR', '8', 'RAJAWALI', '1.70', '600', '00', '', 'ALUMINIUM', '25', '2023-11-05', '2023-11-05', 0),
(24, '510106-600', 'PLAT STRIP 1/2\" (12.5) 0,90 6 MTR', '8', 'RAP', '0.90', '600', '00', '', 'ALUMINIUM', '50', '2023-11-07', '2023-11-07', 0),
(25, '530214-600', 'SPIGOT 13 X 26 1,70 6 MTR', '8', 'RAP', '1.70', '600', '00', '', 'ALUMINIUM', '25', '2023-11-07', '2023-11-07', 0),
(26, '530212-600', 'SPIGOT 13 X 26 1,50 6 MTR', '8', 'RAP', '1.50', '600', '00', '', 'ALUMINIUM', '25', '2023-11-07', '2023-11-07', 0),
(27, '530207-600', 'SPIGOT 13 X 26 10 6 MTR', '8', 'RAP', '1.00', '600', '00', '', 'ALUMINIUM', '25', '2023-11-07', '2023-11-07', 0),
(28, '530307-600', 'SPIGOT 12 X 14 10 6 MTR', '8', 'RAP', '1.00', '600', '00', '', 'ALUMINIUM', '50', '2023-11-07', '2023-11-07', 0),
(29, '50103-600', 'U 8 MM 0,60 6 MTR', '8', 'RAP', '0.60', '600', '00', '', 'ALUMINIUM', '100', '2023-11-07', '2023-11-07', 0),
(30, '550203-600', 'U 9 MM 0,60 6 MTR', '8', 'RAP', '0.60', '600', '00', '', 'ALUMINIUM', '100', '2023-11-07', '2023-11-07', 0),
(31, '580106-600', 'HOLLOW 40 X 40 0,90 6 MTR', '8', 'RAP', '0.90', '600', '00', '', 'ALUMINIUM', '16', '2023-11-07', '2023-11-07', 0),
(32, '580906-600', 'HOLLOW 37 X 37 0,90 6 MTR', '8', 'RAP', '0.90', '600', '00', '', 'ALUMINUM', '20', '2023-11-07', '2023-11-07', 0),
(33, '580303-600', 'HOLLOW 23 X 23 0,80 6 MTR', '8', 'RAP', '0.80', '600', '00', '', 'ALUMINIUM', '25', '2023-11-07', '2023-11-07', 0),
(34, '580403-600', 'HOLLOW 22.5 X 22.5 0,60 6 MTR', '8', 'RAP', '0.60', '600', '00', '', 'ALUMINIUM', '50', '2023-11-07', '2023-11-07', 0),
(35, '580502-600', 'HOLLOW 22 X 22 0,50 6 MTR', '8', 'RAP', '0.50', '600', '00', '', 'ALUMINIUM', '50', '2023-11-07', '2023-11-07', 0),
(36, '580602-600', 'HOLLOW 21 X 21 0,50 6 MTR', '8', 'RAP', '0.50', '600', '00', '', 'ALUMINIUM', '54', '2023-11-07', '2023-11-07', 0),
(37, '590107-600', 'HOLLOW 1 X 4 (F) 25 X 100 10 6 MTR', '8', 'RAP', '1.00', '600', '00', '', 'ALUMINIUM', '6', '2023-11-07', '2023-11-07', 0),
(38, '590207-600', 'HOLLOW 1 X 3 (F) 25 X 75 10 6 MTR', '8', 'RAP', '1.00', '600', '00', '', 'ALUMINIUM', '6', '2023-11-07', '2023-11-07', 0),
(39, '590503-600', 'HOLLOW 1 X 1 1/2 (F) -25 X 38 0,60 6 MTR', '8', 'RAP', '0.60', '600', '00', '', 'ALUMINIUM', '25', '2023-11-07', '2023-11-07', 0),
(40, '590305-600', 'HOLLOW 1 X 2 (F) 25 X 50 0,80 6 MTR', '8', 'RAP', '0.80', '600', '00', '', 'ALUMINIUM', '15', '2023-11-07', '2023-11-07', 0),
(41, '590603-600', 'HOLLOW 1 X 1 1/2 (B) - 25 X 35 0,60 6 MTR', '8', 'RAP', '0.60', '600', '00', '', 'ALUMINIUM', '25', '2023-11-07', '2023-11-07', 0),
(42, '590703-600', 'HOLLOW 1 X 1 1/2 ( 22 X 34) 0,60 6 MTR', '8', 'RAP', '0.60', '600', '00', '', 'ALUMINIUM', '25', '2023-11-07', '2023-11-07', 0),
(43, '590803-600', 'HOLLOW 1/2 X 3/4 (F) GARIS 12 X 20 0,60 6 MTR', '8', 'RAP', '0.60', '600', '00', '', 'ALUMINIUM', '60', '2023-11-07', '2023-11-07', 0),
(44, '590902-600', 'HOLLOW 10 X 16 0,50 6 MTR', '8', 'RAP', '0.50', '600', '00', '', 'ALUMINIUM', '100', '2023-11-07', '2023-11-07', 0),
(45, '591002-600', 'HOLLOW 10 X 15 0,50 6 MTR', '8', 'RAP', '0.50', '600', '00', '', 'ALUMINIUM', '90', '2023-11-07', '2023-11-07', 0),
(46, '600101-600', 'TIANG PINTU SAKURA 0,50 6 MTR', '8', 'RAP', '0.50', '600', '00', '', 'ALUMINIUM', '30', '2023-11-07', '2023-11-07', 0),
(47, '600302-600', 'TIANG 3.5 (F) 23 X 34 0,550 6 MTR', '8', 'RAP', '0.55', '600', '00', '', 'ALUMINIUM', '30', '2023-11-07', '2023-11-07', 0),
(48, '600303-600', 'TIANG 3.5 (F) 23 X 34 0,60 6 MTR', '8', 'RAP', '0.60', '600', '00', '', 'ALUMINIUM', '30', '2023-11-07', '2023-11-07', 0),
(49, '600304-600', 'TIANG 3.5 (F) 23 X 34 0,70 6 MTR', '8', 'RAP', '0.70', '600', '00', '', 'ALUMINIUM', '30', '2023-11-07', '2023-11-07', 0),
(50, '600305-600', 'TIANG 3.5 (F) 23 X 34 0,80 6 MTR', '8', 'RAP', '0.80', '600', '00', '', 'ALUMINIUM', '30', '2023-11-07', '2023-11-07', 0),
(51, '600702-600', 'HOLLOW 10 X 21 TANDUK 0,50 6 MTR', '8', 'RAP', '0.50', '600', '00', '', 'ALUMINIUM', '60', '2023-11-07', '2023-11-07', 0),
(52, '601003-600', 'HOLLOW ENGKEL (B.K) - 22.5 X 23 0,60 6 MTR', '8', 'RAP', '0.60', '600', '00', '', 'ALUMINIUM', '30', '2023-11-07', '2023-11-07', 0),
(53, '610103-600', 'PIPA 1\" - 25 0,60 6 MTR', '8', 'RAP', '0.60', '600', '00', '', 'ALUMINIUM', '25', '2023-11-07', '2023-11-07', 0),
(54, '610302-600', 'Pipa 20MM 0,50 6 MTR', '8', 'RAP', '0.50', '600', '00', '', 'ALUMINIUM', '50', '2023-11-07', '2023-11-07', 0),
(55, '610402-600', 'Pipa 19 MM 0,50 6 MTR', '8', 'RAP', '0.50', '600', '00', '', 'ALUMINIUM', '50', '2023-11-07', '2023-11-07', 0),
(56, '990103-600', 'REL GORDEN MINI 0,60 6 MTR', '8', 'RAP', '0.60', '600', '00', '', 'ALUMINIUM', '100', '2023-11-07', '2023-11-07', 0),
(57, '990204-600', 'REL ATAS LEMARI 0,70 6 MTR', '8', 'RAP', '0.70', '600', '00', '', 'ALUMINIUM', '50', '2023-11-07', '2023-11-07', 0),
(58, '990304-600', 'REL BAWAH LEMARI 0,70 6 MTR', '8', 'RAP', '0.70', '600', '00', '', 'ALUMINIUM', '50', '2023-11-07', '2023-11-07', 0),
(59, '990405-600', 'H BESAR 0,80 6 MTR', '8', 'RAP', '0.80', '600', '00', '', 'ALUMINIUM', '30', '2023-11-07', '2023-11-07', 0),
(60, '110156-600', 'OPENBACK SAKURA 0,550 6 MTR', '8', 'RAP', '0.55', '600', '00', '', 'ALUMINIUM', '12', '2023-11-07', '2023-11-07', 0),
(61, '120105-600', 'OPENBACK 3\" 0,80 6 MTR', '8', 'RAP', '0.80', '600', '00', '', 'ALUMINIUM', '12', '2023-11-07', '2023-11-07', 0),
(62, '120104-600', 'OPENBACK 3\" 0,70 6 MTR', '8', 'RAP', '0.70', '600', '00', '', 'ALUMINIUM', '12', '2023-11-07', '2023-11-07', 0),
(63, '120305-600', 'M 3\" 0,80 6 MTR', '8', 'RAP', '0.80', '600', '00', '', 'ALUMINIUM', '12', '2023-11-07', '2023-11-07', 0),
(64, '120505-600', 'JEEP 3\" 0,80 6 MTR', '8', 'RAP', '0.80', '600', '00', '', 'ALUMINIUM', '12', '2023-11-07', '2023-11-07', 0),
(65, '120705-600', 'TUTUP POLOS 0,80 6 MTR', '8', 'RAP', '0.80', '600', '00', '', 'ALUMINIUM', '20', '2023-11-07', '2023-11-07', 0),
(66, '120805-600', 'BALANGKOA 3\" 0,80 6 MTR', '8', 'RAP', '0.80', '600', '00', '', 'ALUMINIUM', '20', '2023-11-07', '2023-11-07', 0),
(67, '120905-600', 'TUTUP JEEP / CEPLOTAN 3\" 0,80 6 MTR', '8', 'RAP', '0.80', '600', '00', '', 'ALUMINIUM', '20', '2023-11-07', '2023-11-07', 0),
(68, '160105-600', 'TIANG SLIDING POLOS 50 X 28 0,80 6 MTR', '8', 'RAP', '0.80', '600', '00', '', 'ALUMINIUM', '15', '2023-11-07', '2023-11-07', 0),
(69, '190107-600', 'TIANG SWING POLOS 10 6 MTR', '8', 'RAP', '1.00', '600', '00', '', 'ALUMINIUM', '2', '2023-11-07', '2023-11-07', 0),
(70, '90207-600', 'TIANG SWING MOHER 10 6 MTR', '8', 'RAP', '1.00', '600', '00', '', 'ALUMINIUM', '2', '2023-11-07', '2023-11-07', 0),
(71, '190606-600', 'DOOR STOPPER (TATAPAN PINTU) 35MM 0,90 6 MTR', '8', 'RAP', '0.90', '600', '00', '', 'ALUMINIUM', '25', '2023-11-07', '2023-11-07', 0),
(72, '30199-600', 'TIANG TANGGA CALTEX 0,80 6 MTR', '8', 'RAP', '0.80', '600', '00', '', 'ALUMINIUM', '18', '2023-11-07', '2023-11-07', 0),
(73, '230299-600', 'INJAKAN CALTEX 1,20 6 MTR', '8', 'RAP', '1.20', '600', '00', '', 'ALUMINIUM', '25', '2023-11-07', '2023-11-07', 0),
(74, '230499-600', 'TIANG TANGGA PLN 2,20 6 MTR', '8', 'RAP', '2.20', '600', '00', '', 'ALUMINIUM', '10', '2023-11-07', '2023-11-07', 0),
(75, '230699-600', 'TIANG NEW CALTEX 0,90 6 MTR', '8', 'RAP', '0.90', '600', '00', '', 'ALUMINIUM', '12', '2023-11-07', '2023-11-07', 0),
(76, '240102-600', 'SPANDREL 93MM 0,50 6 MTR', '8', 'RAP', '0.50', '600', '00', '', 'ALUMINIUM', '20', '2023-11-07', '2023-11-07', 0);

-- --------------------------------------------------------

--
-- Table structure for table `t_produksi`
--

CREATE TABLE `t_produksi` (
  `produksi_id` int(11) NOT NULL,
  `produksi_nomor` text NOT NULL,
  `produksi_tanggal` date NOT NULL,
  `produksi_shift` text NOT NULL,
  `produksi_pekerja` text DEFAULT NULL,
  `produksi_keterangan` text NOT NULL,
  `produksi_mesin` text DEFAULT NULL,
  `produksi_lampiran_1` text DEFAULT NULL,
  `produksi_lampiran_2` text DEFAULT NULL,
  `produksi_barang_qty` text DEFAULT NULL,
  `produksi_total_produksi` text DEFAULT NULL,
  `produksi_billet_hps` text DEFAULT NULL,
  `produksi_billet_qty` text DEFAULT NULL,
  `produksi_jasa` text DEFAULT NULL,
  `produksi_total_akhir` text DEFAULT NULL,
  `produksi_billet_sisa` text DEFAULT '0',
  `produksi_hapus` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `t_produksi_barang`
--

CREATE TABLE `t_produksi_barang` (
  `produksi_barang_id` int(11) NOT NULL,
  `produksi_barang_nomor` text NOT NULL,
  `produksi_barang_matras` text NOT NULL DEFAULT '0',
  `produksi_barang_barang` text NOT NULL,
  `produksi_barang_stok` text NOT NULL DEFAULT '0',
  `produksi_barang_berat` text NOT NULL DEFAULT '0',
  `produksi_barang_qty` text NOT NULL,
  `produksi_barang_subtotal` text NOT NULL,
  `produksi_barang_tanggal` date NOT NULL DEFAULT curdate()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `t_produk_barang`
--

CREATE TABLE `t_produk_barang` (
  `produk_barang_id` int(11) NOT NULL,
  `produk_barang_stok` text DEFAULT '0',
  `produk_barang_packing` text DEFAULT '0',
  `produk_barang_barang` text DEFAULT NULL,
  `produk_barang_jenis` text DEFAULT NULL,
  `produk_barang_warna` text DEFAULT NULL,
  `produk_barang_hps` text DEFAULT '0',
  `produk_barang_harga` text DEFAULT '0',
  `produk_barang_tanggal` date NOT NULL DEFAULT curdate()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `t_rekening`
--

CREATE TABLE `t_rekening` (
  `rekening_id` int(11) NOT NULL,
  `rekening_nama` text NOT NULL,
  `rekening_bank` text NOT NULL,
  `rekening_no` text NOT NULL,
  `rekening_tanggal` date NOT NULL DEFAULT curdate(),
  `rekening_hapus` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `t_rekening`
--

INSERT INTO `t_rekening` (`rekening_id`, `rekening_nama`, `rekening_bank`, `rekening_no`, `rekening_tanggal`, `rekening_hapus`) VALUES
(7, 'PT. Rajawali Aluminium Perkasa', '12', '123456789111', '2023-06-13', 0);

-- --------------------------------------------------------

--
-- Table structure for table `t_satuan`
--

CREATE TABLE `t_satuan` (
  `satuan_id` int(11) NOT NULL,
  `satuan_kepanjangan` text NOT NULL,
  `satuan_singkatan` text NOT NULL,
  `satuan_tanggal` date NOT NULL DEFAULT curdate(),
  `satuan_hapus` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `t_satuan`
--

INSERT INTO `t_satuan` (`satuan_id`, `satuan_kepanjangan`, `satuan_singkatan`, `satuan_tanggal`, `satuan_hapus`) VALUES
(1, 'Kilogram', 'Kg', '2022-12-05', 0),
(2, '1 Kardus', 'Dus', '2022-12-05', 0),
(3, '1 Pak', 'Pak', '2022-12-05', 0),
(4, '1 Box', 'Box', '2022-12-05', 0),
(5, 'Gram', 'Gr', '2022-12-05', 0),
(6, 'Gelas', 'Gls', '2022-12-05', 0),
(7, 'Pieces', 'PCS', '2023-01-06', 0),
(8, 'Batang', 'Btg', '2023-04-14', 0),
(9, 'Liter', 'Lt', '2023-08-10', 0),
(10, 'Tabung', 'Tbg', '2023-11-10', 0);

-- --------------------------------------------------------

--
-- Table structure for table `t_user`
--

CREATE TABLE `t_user` (
  `user_id` int(11) NOT NULL,
  `user_email` text DEFAULT NULL,
  `user_password` text DEFAULT NULL,
  `user_name` varchar(50) DEFAULT NULL,
  `user_ttl` date DEFAULT NULL,
  `user_nohp` text DEFAULT NULL,
  `user_alamat` text DEFAULT NULL,
  `user_biodata` text DEFAULT NULL,
  `user_foto` text DEFAULT NULL,
  `user_level` int(11) DEFAULT NULL,
  `user_pelajaran` text DEFAULT NULL,
  `user_kelas` text DEFAULT NULL,
  `user_email_2` text DEFAULT NULL,
  `user_tanggal` date DEFAULT curdate(),
  `user_hapus` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `t_user`
--

INSERT INTO `t_user` (`user_id`, `user_email`, `user_password`, `user_name`, `user_ttl`, `user_nohp`, `user_alamat`, `user_biodata`, `user_foto`, `user_level`, `user_pelajaran`, `user_kelas`, `user_email_2`, `user_tanggal`, `user_hapus`) VALUES
(5, 'admin@admin.com', '21232f297a57a5a743894a0e4a801fc3', 'JTM', '2021-11-09', '085555111555', 'Alamat', 'Biodata', '4c293a141d8c17800a44b816d35238cd.png', 0, NULL, NULL, NULL, '2023-02-09', 0),
(78, 'siskaeee@gmail.com', 'afa0b885505255964c06188e2b4e8f59', 'Siska Elisa', NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, NULL, '2022-12-04', 1),
(84, 'kasir@gmail.com', 'c7911af3adbd12a035b289556d96470a', 'Kasir JTM', NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, NULL, '2023-06-02', 1),
(85, 'mulyono.tunardy@gmail.com', '50909b16941c62e390316294ac9965d5', 'Mul', NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, '2023-06-12', 0),
(86, 'staff@rajawaliap.co.id', 'ee787ffa162752f80e37a07146a20a14', 'STAFF', NULL, NULL, NULL, NULL, NULL, 4, NULL, NULL, NULL, '2023-11-05', 0);

-- --------------------------------------------------------

--
-- Table structure for table `t_warna`
--

CREATE TABLE `t_warna` (
  `warna_id` int(11) NOT NULL,
  `warna_kode` text NOT NULL,
  `warna_jenis` text NOT NULL,
  `warna_nama` text NOT NULL,
  `warna_keterangan` text NOT NULL,
  `warna_tanggal` date NOT NULL DEFAULT curdate(),
  `warna_hapus` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `t_warna`
--

INSERT INTO `t_warna` (`warna_id`, `warna_kode`, `warna_jenis`, `warna_nama`, `warna_keterangan`, `warna_tanggal`, `warna_hapus`) VALUES
(0, 'WR000', '3', 'MF', '-', '2023-02-18', 0),
(12, 'WR002', '1', 'CA', 'CLEAR ANODIZED', '2023-06-14', 0),
(13, 'WR003', '1', 'BR', 'BROWN ANODIZED', '2023-06-14', 0),
(14, 'WR004', '2', 'ARWH', 'ARTIC WHITE', '2023-06-14', 0),
(15, 'WR005', '2', 'MKWH', 'MILKY WHITE', '2023-09-17', 0),
(16, 'WR006', '2', 'CRBG', 'CREAM BEIGE', '2023-11-02', 0);

-- --------------------------------------------------------

--
-- Table structure for table `t_warna_jenis`
--

CREATE TABLE `t_warna_jenis` (
  `warna_jenis_id` int(11) NOT NULL,
  `warna_jenis_kode` text NOT NULL,
  `warna_jenis_type` text NOT NULL,
  `warna_jenis_keterangan` text NOT NULL,
  `warna_jenis_hapus` int(11) NOT NULL DEFAULT 0,
  `warna_jenis_tanggal` date NOT NULL DEFAULT curdate()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `t_warna_jenis`
--

INSERT INTO `t_warna_jenis` (`warna_jenis_id`, `warna_jenis_kode`, `warna_jenis_type`, `warna_jenis_keterangan`, `warna_jenis_hapus`, `warna_jenis_tanggal`) VALUES
(1, 'JN001', 'Anodizing', 'Warna CA / BR', 0, '2023-01-04'),
(2, 'JN002', 'Powder Coating', 'Warna warni', 0, '2023-01-04'),
(3, 'JN003', 'MF', 'Tidak di warnai', 0, '2023-01-04');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `t_akun`
--
ALTER TABLE `t_akun`
  ADD PRIMARY KEY (`akun_id`) USING BTREE;

--
-- Indexes for table `t_akun_normal`
--
ALTER TABLE `t_akun_normal`
  ADD PRIMARY KEY (`akun_normal_id`) USING BTREE;

--
-- Indexes for table `t_bahan`
--
ALTER TABLE `t_bahan`
  ADD PRIMARY KEY (`bahan_id`);

--
-- Indexes for table `t_bank`
--
ALTER TABLE `t_bank`
  ADD PRIMARY KEY (`bank_id`);

--
-- Indexes for table `t_billet`
--
ALTER TABLE `t_billet`
  ADD PRIMARY KEY (`billet_id`);

--
-- Indexes for table `t_cacat`
--
ALTER TABLE `t_cacat`
  ADD PRIMARY KEY (`cacat_id`);

--
-- Indexes for table `t_jurnal`
--
ALTER TABLE `t_jurnal`
  ADD PRIMARY KEY (`jurnal_id`);

--
-- Indexes for table `t_karyawan`
--
ALTER TABLE `t_karyawan`
  ADD PRIMARY KEY (`karyawan_id`);

--
-- Indexes for table `t_kontak`
--
ALTER TABLE `t_kontak`
  ADD PRIMARY KEY (`kontak_id`);

--
-- Indexes for table `t_level`
--
ALTER TABLE `t_level`
  ADD PRIMARY KEY (`level_id`);

--
-- Indexes for table `t_logo`
--
ALTER TABLE `t_logo`
  ADD PRIMARY KEY (`logo_id`);

--
-- Indexes for table `t_mesin`
--
ALTER TABLE `t_mesin`
  ADD PRIMARY KEY (`mesin_id`);

--
-- Indexes for table `t_packing`
--
ALTER TABLE `t_packing`
  ADD PRIMARY KEY (`packing_id`);

--
-- Indexes for table `t_packing_barang`
--
ALTER TABLE `t_packing_barang`
  ADD PRIMARY KEY (`packing_barang_id`);

--
-- Indexes for table `t_pajak`
--
ALTER TABLE `t_pajak`
  ADD PRIMARY KEY (`pajak_id`);

--
-- Indexes for table `t_peleburan`
--
ALTER TABLE `t_peleburan`
  ADD PRIMARY KEY (`peleburan_id`);

--
-- Indexes for table `t_peleburan_barang`
--
ALTER TABLE `t_peleburan_barang`
  ADD PRIMARY KEY (`peleburan_barang_id`);

--
-- Indexes for table `t_pembelian`
--
ALTER TABLE `t_pembelian`
  ADD PRIMARY KEY (`pembelian_id`);

--
-- Indexes for table `t_pembelian_barang`
--
ALTER TABLE `t_pembelian_barang`
  ADD PRIMARY KEY (`pembelian_barang_id`);

--
-- Indexes for table `t_pembelian_umum`
--
ALTER TABLE `t_pembelian_umum`
  ADD PRIMARY KEY (`pembelian_umum_id`);

--
-- Indexes for table `t_pembelian_umum_barang`
--
ALTER TABLE `t_pembelian_umum_barang`
  ADD PRIMARY KEY (`pembelian_umum_barang_id`);

--
-- Indexes for table `t_penjualan`
--
ALTER TABLE `t_penjualan`
  ADD PRIMARY KEY (`penjualan_id`);

--
-- Indexes for table `t_penjualan_barang`
--
ALTER TABLE `t_penjualan_barang`
  ADD PRIMARY KEY (`penjualan_barang_id`);

--
-- Indexes for table `t_penyesuaian`
--
ALTER TABLE `t_penyesuaian`
  ADD PRIMARY KEY (`penyesuaian_id`);

--
-- Indexes for table `t_penyesuaian_barang`
--
ALTER TABLE `t_penyesuaian_barang`
  ADD PRIMARY KEY (`penyesuaian_barang_id`);

--
-- Indexes for table `t_pewarnaan`
--
ALTER TABLE `t_pewarnaan`
  ADD PRIMARY KEY (`pewarnaan_id`);

--
-- Indexes for table `t_pewarnaan_barang`
--
ALTER TABLE `t_pewarnaan_barang`
  ADD PRIMARY KEY (`pewarnaan_barang_id`);

--
-- Indexes for table `t_produk`
--
ALTER TABLE `t_produk`
  ADD PRIMARY KEY (`produk_id`);

--
-- Indexes for table `t_produksi`
--
ALTER TABLE `t_produksi`
  ADD PRIMARY KEY (`produksi_id`);

--
-- Indexes for table `t_produksi_barang`
--
ALTER TABLE `t_produksi_barang`
  ADD PRIMARY KEY (`produksi_barang_id`);

--
-- Indexes for table `t_produk_barang`
--
ALTER TABLE `t_produk_barang`
  ADD PRIMARY KEY (`produk_barang_id`);

--
-- Indexes for table `t_rekening`
--
ALTER TABLE `t_rekening`
  ADD PRIMARY KEY (`rekening_id`);

--
-- Indexes for table `t_satuan`
--
ALTER TABLE `t_satuan`
  ADD PRIMARY KEY (`satuan_id`);

--
-- Indexes for table `t_user`
--
ALTER TABLE `t_user`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `t_warna`
--
ALTER TABLE `t_warna`
  ADD PRIMARY KEY (`warna_id`);

--
-- Indexes for table `t_warna_jenis`
--
ALTER TABLE `t_warna_jenis`
  ADD PRIMARY KEY (`warna_jenis_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `t_akun`
--
ALTER TABLE `t_akun`
  MODIFY `akun_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `t_akun_normal`
--
ALTER TABLE `t_akun_normal`
  MODIFY `akun_normal_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `t_bahan`
--
ALTER TABLE `t_bahan`
  MODIFY `bahan_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `t_bank`
--
ALTER TABLE `t_bank`
  MODIFY `bank_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=142;

--
-- AUTO_INCREMENT for table `t_billet`
--
ALTER TABLE `t_billet`
  MODIFY `billet_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `t_cacat`
--
ALTER TABLE `t_cacat`
  MODIFY `cacat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `t_jurnal`
--
ALTER TABLE `t_jurnal`
  MODIFY `jurnal_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=551;

--
-- AUTO_INCREMENT for table `t_karyawan`
--
ALTER TABLE `t_karyawan`
  MODIFY `karyawan_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `t_kontak`
--
ALTER TABLE `t_kontak`
  MODIFY `kontak_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `t_level`
--
ALTER TABLE `t_level`
  MODIFY `level_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `t_logo`
--
ALTER TABLE `t_logo`
  MODIFY `logo_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `t_mesin`
--
ALTER TABLE `t_mesin`
  MODIFY `mesin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `t_packing`
--
ALTER TABLE `t_packing`
  MODIFY `packing_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `t_packing_barang`
--
ALTER TABLE `t_packing_barang`
  MODIFY `packing_barang_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `t_pajak`
--
ALTER TABLE `t_pajak`
  MODIFY `pajak_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `t_peleburan`
--
ALTER TABLE `t_peleburan`
  MODIFY `peleburan_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `t_peleburan_barang`
--
ALTER TABLE `t_peleburan_barang`
  MODIFY `peleburan_barang_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=196;

--
-- AUTO_INCREMENT for table `t_pembelian`
--
ALTER TABLE `t_pembelian`
  MODIFY `pembelian_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=119;

--
-- AUTO_INCREMENT for table `t_pembelian_barang`
--
ALTER TABLE `t_pembelian_barang`
  MODIFY `pembelian_barang_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=483;

--
-- AUTO_INCREMENT for table `t_pembelian_umum`
--
ALTER TABLE `t_pembelian_umum`
  MODIFY `pembelian_umum_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT for table `t_pembelian_umum_barang`
--
ALTER TABLE `t_pembelian_umum_barang`
  MODIFY `pembelian_umum_barang_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=135;

--
-- AUTO_INCREMENT for table `t_penjualan`
--
ALTER TABLE `t_penjualan`
  MODIFY `penjualan_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=124;

--
-- AUTO_INCREMENT for table `t_penjualan_barang`
--
ALTER TABLE `t_penjualan_barang`
  MODIFY `penjualan_barang_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=424;

--
-- AUTO_INCREMENT for table `t_penyesuaian`
--
ALTER TABLE `t_penyesuaian`
  MODIFY `penyesuaian_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `t_penyesuaian_barang`
--
ALTER TABLE `t_penyesuaian_barang`
  MODIFY `penyesuaian_barang_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT for table `t_pewarnaan`
--
ALTER TABLE `t_pewarnaan`
  MODIFY `pewarnaan_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT for table `t_pewarnaan_barang`
--
ALTER TABLE `t_pewarnaan_barang`
  MODIFY `pewarnaan_barang_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=86;

--
-- AUTO_INCREMENT for table `t_produk`
--
ALTER TABLE `t_produk`
  MODIFY `produk_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=77;

--
-- AUTO_INCREMENT for table `t_produksi`
--
ALTER TABLE `t_produksi`
  MODIFY `produksi_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=128;

--
-- AUTO_INCREMENT for table `t_produksi_barang`
--
ALTER TABLE `t_produksi_barang`
  MODIFY `produksi_barang_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=391;

--
-- AUTO_INCREMENT for table `t_produk_barang`
--
ALTER TABLE `t_produk_barang`
  MODIFY `produk_barang_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=313;

--
-- AUTO_INCREMENT for table `t_rekening`
--
ALTER TABLE `t_rekening`
  MODIFY `rekening_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `t_satuan`
--
ALTER TABLE `t_satuan`
  MODIFY `satuan_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `t_user`
--
ALTER TABLE `t_user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=87;

--
-- AUTO_INCREMENT for table `t_warna`
--
ALTER TABLE `t_warna`
  MODIFY `warna_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `t_warna_jenis`
--
ALTER TABLE `t_warna_jenis`
  MODIFY `warna_jenis_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
