-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 22, 2023 at 08:50 AM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 7.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `rap`
--

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `t_bahan`
--

INSERT INTO `t_bahan` (`bahan_id`, `bahan_kode`, `bahan_nama`, `bahan_stok`, `bahan_satuan`, `bahan_kategori`, `bahan_harga`, `bahan_tanggal`, `bahan_hapus`) VALUES
(1, 'BH001', 'Kawat las', 5, '1', 'pembantu', '2500', '2022-12-05', 0),
(2, 'BH002', 'Velg sepeda', 195, '1', 'utama', '5000', '2022-12-05', 0),
(3, 'BH003', 'Paku', 765, '1', 'utama', '3000', '2022-12-05', 0),
(4, 'BH004', 'Plat kapal', 6, '1', 'utama', '55000', '2022-12-05', 0),
(5, 'BH005', 'Rel kereta', 4, '1', 'utama', '30000', '2022-12-05', 0),
(6, 'BH006', 'Rangka Motor', 40, '1', 'utama', '30000', '2022-12-11', 0),
(7, 'BH007', 'Kawat Jemuran', 80, '1', 'pembantu', '3000', '2022-12-18', 0),
(8, 'BH008', 'Paku Bekas', 120, '1', 'pembantu', '1200', '2022-12-18', 0),
(9, 'BH009', 'Matras', 0, '1', 'pembantu', '10000', '2022-12-21', 0),
(11, 'BH0010', 'Tiang Listrik', 5, '1', 'utama', '12000', '2023-02-12', 0);

-- --------------------------------------------------------

--
-- Table structure for table `t_bank`
--

CREATE TABLE `t_bank` (
  `bank_id` int(11) NOT NULL,
  `bank_kode` text NOT NULL,
  `bank_nama` text NOT NULL,
  `bank_tanggal` date NOT NULL DEFAULT curdate()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
  `billet_full` text DEFAULT NULL,
  `billet_min` text DEFAULT '0',
  `billet_stok` text DEFAULT NULL,
  `billet_sisa` text DEFAULT '0',
  `billet_hpp` text DEFAULT NULL,
  `billet_hps` text DEFAULT NULL,
  `billet_update` date NOT NULL DEFAULT curdate()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `t_billet`
--

INSERT INTO `t_billet` (`billet_id`, `billet_full`, `billet_min`, `billet_stok`, `billet_sisa`, `billet_hpp`, `billet_hps`, `billet_update`) VALUES
(1, '40', '40', '0', '7', '287000', '7175', '2023-02-22');

-- --------------------------------------------------------

--
-- Table structure for table `t_coa`
--

CREATE TABLE `t_coa` (
  `coa_id` int(11) NOT NULL,
  `coa_nomor` text NOT NULL,
  `coa_akun` text NOT NULL,
  `coa_sub` text NOT NULL,
  `coa_tanggal` date NOT NULL DEFAULT curdate()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `t_coa`
--

INSERT INTO `t_coa` (`coa_id`, `coa_nomor`, `coa_akun`, `coa_sub`, `coa_tanggal`) VALUES
(1, '112', 'Kas', '1', '2023-01-27'),
(2, '113', 'Piutang', '1', '2023-01-27'),
(3, '114', 'Stok produk', '1', '2023-01-27'),
(4, '115', 'Stok bahan baku', '1', '2023-01-27'),
(5, '116', 'Stok billet', '1', '2023-01-27'),
(6, '122', 'Utang', '2', '2023-01-27'),
(7, '132', 'Saldo', '3', '2023-01-27'),
(8, '142', 'Penjualan produk', '4', '2023-01-27'),
(9, '152', 'Biaya produksi', '5', '2023-01-27');

-- --------------------------------------------------------

--
-- Table structure for table `t_coa_sub`
--

CREATE TABLE `t_coa_sub` (
  `coa_sub_id` int(11) NOT NULL,
  `coa_sub_nomor` text NOT NULL,
  `coa_sub_akun` text NOT NULL,
  `coa_sub_plus` text NOT NULL,
  `coa_sub_min` text NOT NULL,
  `coa_sub_tanggal` date NOT NULL DEFAULT curdate()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `t_coa_sub`
--

INSERT INTO `t_coa_sub` (`coa_sub_id`, `coa_sub_nomor`, `coa_sub_akun`, `coa_sub_plus`, `coa_sub_min`, `coa_sub_tanggal`) VALUES
(1, '111', 'Harta', 'D', 'K', '2023-01-27'),
(2, '121', 'Utang', 'K', 'D', '2023-01-27'),
(3, '131', 'Modal', 'K', 'D', '2023-01-27'),
(4, '141', 'Pendapatan', 'K', 'D', '2023-01-27'),
(5, '151', 'Beban', 'D', 'K', '2023-01-27');

-- --------------------------------------------------------

--
-- Table structure for table `t_jurnal`
--

CREATE TABLE `t_jurnal` (
  `jurnal_id` int(11) NOT NULL,
  `jurnal_nomor` text NOT NULL,
  `jurnal_akun` text NOT NULL,
  `jurnal_keterangan` text NOT NULL,
  `jurnal_type` enum('debit','kredit') NOT NULL,
  `jurnal_nominal` text NOT NULL,
  `jurnal_hapus` int(11) NOT NULL DEFAULT 0,
  `jurnal_tanggal` date NOT NULL DEFAULT curdate()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `t_jurnal`
--

INSERT INTO `t_jurnal` (`jurnal_id`, `jurnal_nomor`, `jurnal_akun`, `jurnal_keterangan`, `jurnal_type`, `jurnal_nominal`, `jurnal_hapus`, `jurnal_tanggal`) VALUES
(81, 'PU-21122022-4', '4', 'stok umum', 'debit', '1000000', 0, '2022-12-21'),
(82, 'PU-21122022-4', '1', 'kas ( pembelian bahan umum )', 'kredit', '1000000', 0, '2022-12-21'),
(83, 'PU-19122022-3', '4', 'stok umum', 'debit', '37500', 0, '2022-12-19'),
(84, 'PU-19122022-3', '1', 'kas ( pembelian bahan umum )', 'kredit', '37500', 0, '2022-12-19'),
(85, 'PU-19122022-2', '4', 'stok umum', 'debit', '42500', 0, '2022-12-19'),
(86, 'PU-19122022-2', '1', 'kas ( pembelian bahan umum )', 'kredit', '42500', 0, '2022-12-19'),
(87, 'PU-18122022-1', '4', 'stok bahan baku umum', 'debit', '444000', 0, '2022-12-18'),
(88, 'PU-18122022-1', '1', 'kas ( pembelian bahan umum )', 'kredit', '444000', 0, '2022-12-18'),
(89, 'PA-28122022-8', '4', 'stok bahan baku avalan', 'debit', '25000', 0, '2022-12-28'),
(90, 'PA-28122022-8', '1', 'kas ( pembelian bahan avalan )', 'kredit', '25000', 0, '2022-12-28'),
(95, 'PA-18122022-5', '4', 'stok bahan baku avalan', 'debit', '300000', 0, '2022-12-18'),
(96, 'PA-18122022-5', '1', 'kas ( pembelian bahan avalan )', 'kredit', '300000', 0, '2022-12-18'),
(97, 'PA-18122022-4', '4', 'stok bahan baku avalan', 'debit', '50000', 0, '2022-12-18'),
(98, 'PA-18122022-4', '1', 'kas ( pembelian bahan avalan )', 'kredit', '50000', 0, '2022-12-18'),
(99, 'PA-11122022-3', '4', 'stok bahan baku avalan', 'debit', '2000000', 0, '2022-12-11'),
(100, 'PA-11122022-3', '1', 'kas ( pembelian bahan avalan )', 'kredit', '2000000', 0, '2022-12-11'),
(101, 'PA-11122022-2', '4', 'stok bahan baku avalan', 'debit', '250000', 0, '2022-12-11'),
(102, 'PA-11122022-2', '1', 'kas ( pembelian bahan avalan )', 'kredit', '250000', 0, '2022-12-11'),
(103, 'PA-11122022-1', '4', 'stok bahan baku avalan', 'debit', '700000', 0, '2022-12-11'),
(104, 'PA-11122022-1', '6', 'utang ( pembelian bahan avalan )', 'kredit', '700000', 0, '2022-12-11'),
(105, 'PB-11122022-1', '4', 'stok bahan baku utama', 'debit', '249750', 0, '2022-12-11'),
(106, 'PB-11122022-1', '6', 'utang ( pembelian bahan utama )', 'kredit', '249750', 0, '2022-12-11'),
(133, 'PL-21012023-1', '2', 'piutang (penjualan produk)', 'debit', '10000', 0, '2023-02-01'),
(134, 'PL-21012023-1', '3', 'stok produk', 'kredit', '10000', 0, '2023-02-01'),
(137, 'SAL-1675210571', '7', 'Penambahan kas bulan februari', 'kredit', '2000000', 0, '2023-02-01'),
(138, 'SAL-1675210571', '1', 'kas ( penyesuaian saldo )', 'debit', '2000000', 0, '2023-02-01'),
(139, 'PA-03012023-9', '4', 'stok bahan bakuavalan', 'debit', '50000', 0, '2023-02-07'),
(140, 'PA-03012023-9', '1', 'kas ( pembelian bahan avalan )', 'kredit', '50000', 0, '2023-02-07'),
(141, 'PA-18122022-7', '4', 'stok bahan bakuavalan', 'debit', '300000', 0, '2023-02-08'),
(142, 'PA-18122022-7', '1', 'kas ( pembelian bahan avalan )', 'kredit', '300000', 0, '2023-02-08'),
(143, 'PA-18122022-6', '4', 'stok bahan bakuavalan', 'debit', '300000', 0, '2023-02-08'),
(144, 'PA-18122022-6', '1', 'kas ( pembelian bahan avalan )', 'kredit', '300000', 0, '2023-02-08'),
(153, 'PJ-21012023-2', '2', 'piutang (penjualan produk)', 'debit', '20000', 0, '2023-02-08'),
(154, 'PJ-21012023-2', '3', 'stok produk', 'kredit', '20000', 0, '2023-02-08'),
(165, 'PL-21012023-2', '2', 'piutang (penjualan produk)', 'debit', '20000', 0, '2023-02-09'),
(166, 'PL-21012023-2', '3', 'stok produk', 'kredit', '20000', 0, '2023-02-09'),
(189, 'PR-14012023-2', '9', 'biaya produksi', 'debit', '36470', 0, '2023-02-12'),
(190, 'PR-14012023-2', '4', 'stok bahan baku', 'kredit', '36470', 0, '2023-02-12'),
(197, 'PJ-08022023-5', '2', 'piutang (penjualan produk)', 'debit', '1100', 0, '2023-02-13'),
(198, 'PJ-08022023-5', '3', 'stok produk', 'kredit', '1100', 0, '2023-02-13'),
(203, 'PR-12012023-1', '9', 'biaya produksi', 'debit', '17970', 0, '2023-02-13'),
(204, 'PR-12012023-1', '4', 'stok bahan baku', 'kredit', '17970', 0, '2023-02-13'),
(205, 'PU-28012023-5', '4', 'stok bahan bakuumum', 'debit', '12500', 0, '2023-02-07'),
(206, 'PU-28012023-5', '1', 'kas ( pembelian bahan umum )', 'kredit', '12500', 0, '2023-02-07'),
(219, 'PB-14022023-21', '4', 'stok bahan baku', 'debit', '150000', 0, '2023-02-14'),
(220, 'PB-14022023-21', '6', 'utang ( pembelian bahan  )', 'kredit', '150000', 0, '2023-02-14'),
(221, 'PB-14022023-21', '4', 'stok bahan baku', 'debit', '9000', 0, '2023-02-14'),
(222, 'PB-14022023-21', '6', 'utang ( pembelian bahan  )', 'kredit', '9000', 0, '2023-02-14'),
(225, 'PB-08022023-10', '4', 'stok bahan baku', 'debit', '80000', 0, '2023-02-15'),
(226, 'PB-08022023-10', '1', 'kas ( pembelian bahan  )', 'kredit', '80000', 0, '2023-02-15'),
(229, 'PU-15022023-2', '4', 'beli ', 'debit', '325000', 0, '2023-02-15'),
(230, 'PU-15022023-2', '1', 'kas berkurang pembelian ', 'kredit', '325000', 0, '2023-02-15'),
(231, 'PU-15022023-1', '4', 'beli ', 'debit', '110000', 0, '2023-02-15'),
(232, 'PU-15022023-1', '1', 'kas berkurang pembelian ', 'kredit', '110000', 0, '2023-02-15'),
(247, 'PLB-19122022-2', '9', 'biaya peleburan', 'debit', '122000', 0, '2022-12-19'),
(248, 'PLB-19122022-2', '5', 'stok billet', 'kredit', '122000', 0, '2022-12-19'),
(285, 'PLB-19122022-1', '9', 'biaya peleburan', 'debit', '90000', 0, '2022-12-19'),
(286, 'PLB-19122022-1', '5', 'stok billet', 'kredit', '90000', 0, '2022-12-19'),
(287, 'PLB-16022023-3', '9', 'biaya peleburan', 'debit', '75000', 0, '2023-02-16'),
(288, 'PLB-16022023-3', '5', 'stok billet', 'kredit', '75000', 0, '2023-02-16'),
(291, '', '2', 'piutang (penjualan produk)', 'debit', '', 0, '2023-02-21'),
(292, '', '3', 'stok produk', 'kredit', '', 0, '2023-02-21'),
(297, 'PJ-22022023-1', '2', 'piutang (penjualan produk)', 'debit', '66500', 0, '2023-02-22'),
(298, 'PJ-22022023-1', '3', 'stok produk', 'kredit', '66500', 0, '2023-02-22');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `t_karyawan`
--

INSERT INTO `t_karyawan` (`karyawan_id`, `karyawan_nama`, `karyawan_telp`, `karyawan_alamat`, `karyawan_tanggal`, `karyawan_hapus`) VALUES
(1, 'Saldi', '085555555555', '-', '2023-02-18', 0),
(2, 'Erwin', '081111111111', '-', '2023-02-18', 0),
(3, 'Harisal', '082222222222', '-', '2023-02-18', 0),
(4, 'Wahyudi', '083333333333', '-', '2023-02-18', 0),
(5, 'Syahrul', '087777777777', '-', '2023-02-18', 0);

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `t_kontak`
--

INSERT INTO `t_kontak` (`kontak_id`, `kontak_jenis`, `kontak_kode`, `kontak_nama`, `kontak_alamat`, `kontak_tlp`, `kontak_email`, `kontak_rek`, `kontak_bank`, `kontak_npwp`, `kontak_tanggal`, `kontak_hapus`) VALUES
(1, 's', 'SP001', 'Sudarto Aman', 'kademngan rt01 rw01', '085777888541', 'sudartoA@gmail.com', '673623281782', '4', '-', '2022-11-30', 0),
(4, 's', 'SP002', 'Setiawan Nugroho', 'kademngan rt01 rw01', '085671456243', 'setiawan@gmail.com', '673623281782', '4', '-', '2022-11-30', 0),
(15, 'p', 'PL001', 'Sri Kanda', 'Apartemen Mansion City Lantai 7 No. 32, Jalan Rumput Hijau Kav. 18, Matraman, Jakarta Timur, 13120', '085855011543', 'sri78@gmail.com', '73898298320', '2', '-', '2022-12-02', 0);

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `t_logo`
--

INSERT INTO `t_logo` (`logo_id`, `logo_foto`, `logo_nama`, `logo_telp`, `logo_kota`, `logo_alamat`) VALUES
(1, '3d00876ae06414f4347830ac266f84c4.png', 'RAJAWALI  ALUMUNIUM  PERKASA', '021-7980421', 'Jakarta', 'JL. Raya Pasar Minggu No. 17 Jakarta Selatan 12520');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `t_mesin`
--

INSERT INTO `t_mesin` (`mesin_id`, `mesin_kode`, `mesin_nama`, `mesin_hapus`, `mesin_tanggal`) VALUES
(1, 'POCITA-001-DENJI', 'Chainsaw', 0, '2022-12-03'),
(2, 'G778-899-001', 'Gerindra', 0, '2022-12-03'),
(3, 'B-765-123 R', 'Bubut', 0, '2022-12-03');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `t_peleburan`
--

INSERT INTO `t_peleburan` (`peleburan_id`, `peleburan_nomor`, `peleburan_tanggal`, `peleburan_qty_akhir`, `peleburan_jasa`, `peleburan_billet`, `peleburan_billet_sisa`, `peleburan_biaya`, `peleburan_hapus`) VALUES
(10, 'PLB-19122022-1', '2022-12-19', '20', '10000', '10', '0', '90000', 0),
(11, 'PLB-19122022-2', '2022-12-19', '30', '12000', '15', '0', '122000', 0),
(13, 'PLB-16022023-3', '2023-02-16', '10', '25000', '15', '0', '75000', 0);

-- --------------------------------------------------------

--
-- Table structure for table `t_peleburan_barang`
--

CREATE TABLE `t_peleburan_barang` (
  `peleburan_barang_id` int(11) NOT NULL,
  `peleburan_barang_nomor` text NOT NULL,
  `peleburan_barang_barang` text NOT NULL,
  `peleburan_barang_qty` text NOT NULL,
  `peleburan_barang_harga` text NOT NULL,
  `peleburan_barang_subtotal` text NOT NULL,
  `peleburan_barang_tanggal` date NOT NULL DEFAULT curdate()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `t_peleburan_barang`
--

INSERT INTO `t_peleburan_barang` (`peleburan_barang_id`, `peleburan_barang_nomor`, `peleburan_barang_barang`, `peleburan_barang_qty`, `peleburan_barang_harga`, `peleburan_barang_subtotal`, `peleburan_barang_tanggal`) VALUES
(121, 'PLB-19122022-2', '3', '10', '3000', '30000', '2023-02-16'),
(122, 'PLB-19122022-2', '7', '10', '3000', '30000', '2023-02-16'),
(123, 'PLB-19122022-2', '2', '10', '5000', '50000', '2023-02-16'),
(142, 'PLB-19122022-1', '2', '10', '5000', '50000', '2023-02-17'),
(143, 'PLB-19122022-1', '7', '10', '3000', '30000', '2023-02-17'),
(144, 'PLB-16022023-3', '2', '10', '5000', '50000', '2023-02-17');

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
  `pembelian_status` set('lunas','belum') NOT NULL,
  `pembelian_pelunasan` text DEFAULT NULL,
  `pembelian_pelunasan_keterangan` text NOT NULL,
  `pembelian_pembayaran` text DEFAULT NULL,
  `pembelian_keterangan` text NOT NULL,
  `pembelian_lampiran` text NOT NULL,
  `pembelian_qty_akhir` text DEFAULT NULL,
  `pembelian_ppn` text DEFAULT NULL,
  `pembelian_total` text DEFAULT NULL,
  `pembelian_hapus` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `t_pembelian`
--

INSERT INTO `t_pembelian` (`pembelian_id`, `pembelian_user`, `pembelian_po`, `pembelian_po_tanggal`, `pembelian_nomor`, `pembelian_supplier`, `pembelian_tanggal`, `pembelian_jatuh_tempo`, `pembelian_status`, `pembelian_pelunasan`, `pembelian_pelunasan_keterangan`, `pembelian_pembayaran`, `pembelian_keterangan`, `pembelian_lampiran`, `pembelian_qty_akhir`, `pembelian_ppn`, `pembelian_total`, `pembelian_hapus`) VALUES
(32, '5', 0, '', 'PB-11122022-1', '1', '2023-02-07', '2022-12-11', 'lunas', '', '', '4', 'Transaksi ke 1', '', '130', '0', '700000', 0),
(33, '5', 0, '', 'PB-11122022-2', '4', '2023-02-07', '2022-12-11', 'lunas', '', '', '4', 'Transaksi ke 2', 'd9aed766c73c96bf5610fb642049a963.png', '70', '0', '250000', 0),
(34, '5', 0, '', 'PB-11122022-3', '1', '2023-02-07', '2022-12-11', 'lunas', '', '', '4', 'Transaksi ke 3', '', '600', '0', '2000000', 0),
(35, '5', 0, '', 'PB-11122022-1', '1', '2023-02-07', '2022-12-11', 'lunas', '', '', '5', 'Transaksi ke 1', '', '5', '11', '249750', 0),
(37, '5', 0, '', 'PB-18122022-1', '1', '2023-02-07', '2022-12-18', 'lunas', '', '', '6', 'umum 1', '', '220', '0', '444000', 0),
(38, '5', 0, '', 'PB-18122022-4', '1', '2023-02-07', '2022-12-18', 'lunas', '', '', '4', '', '', '10', '0', '50000', 0),
(39, '5', 0, '', 'PB-18122022-5', '1', '2023-02-07', '2022-12-18', 'belum', '', '', '4', '', '', '10', '0', '300000', 0),
(40, '5', 0, '', 'PB-18122022-6', '1', '2023-02-07', '2022-12-18', 'lunas', '2023-02-08', '', '4', '', '', '10', '0', '300000', 0),
(41, '5', 0, '', 'PB-18122022-7', '4', '2023-02-07', '2022-12-18', 'lunas', '2023-02-08', '', '4', '', '', '10', '0', '300000', 0),
(42, '5', 0, '', 'PB-19122022-2', '4', '2023-02-07', '2022-12-19', 'belum', '', '', '6', '', '', '15', '0', '42500', 0),
(45, '5', 0, '', 'PB-19122022-3', '4', '2023-02-07', '2022-12-19', 'belum', '', '', '6', '', '', '10', '0', '37500', 0),
(46, '5', 0, '', 'PB-21122022-4', '4', '2023-02-07', '2022-12-21', 'belum', '', '', '6', 'matras', '', '100', '0', '1000000', 0),
(47, '5', 0, '', 'PB-28122022-8', '1', '2023-02-07', '2022-12-28', 'lunas', '', '', '4', '-', '', '5', '0', '25000', 0),
(48, '5', 0, '', 'PB-03012023-9', '1', '2023-02-07', '2023-01-03', 'lunas', '', '', 'tunai', '-', '99459b1f4bf53b1d7cfafbb8a291f000.png', '10', '0', '50000', 0),
(49, '5', 0, '', 'PB-28012023-5', '1', '2023-02-07', '2023-01-28', 'lunas', '', '', 'tunai', '-', '', '5', '0', '12500', 0),
(50, '5', 0, '2023-02-08', 'PB-08022023-10', '1', '2023-02-08', '2023-02-10', 'lunas', '2023-02-15', 'Mari kita bayar', 'tunai', '-', '', '20', '0', '80000', 0),
(51, '5', 1, '2023-02-08', 'PB-08022023-11', '1', '2023-02-08', '2023-02-10', 'belum', '', '', 'tunai', '-', '', '15', '0', '190000', 0),
(52, '5', 1, '2023-02-13', 'PB-13022023-12', '1', '2023-02-13', '2023-02-13', 'belum', '', '', 'tunai', '-', '', '10', '0', '120000', 0),
(53, '5', 1, '2023-02-13', 'PB-13022023-13', '1', '2023-02-13', '2023-02-13', 'belum', '', '', 'tunai', '-', '', '5', '0', '48000', 0),
(54, '5', 1, '2023-02-14', 'PB-14022023-20', '1', '2023-02-14', '2023-02-14', 'lunas', '', '', 'tunai', '-', '', '5', '11', '39960', 0),
(57, '5', 0, '', 'PB-14022023-21', '1', '2023-02-14', '2023-02-14', 'lunas', '', '', 'tunai', '-', '', '5', '0', '9000', 0);

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `t_pembelian_barang`
--

INSERT INTO `t_pembelian_barang` (`pembelian_barang_id`, `pembelian_barang_nomor`, `pembelian_barang_barang`, `pembelian_barang_stok`, `pembelian_barang_qty`, `pembelian_barang_potongan`, `pembelian_barang_harga`, `pembelian_barang_subtotal`) VALUES
(316, 'PB-21122022-4', '9', '0', '100', '0', '10000', '1000000'),
(317, 'PB-19122022-3', '1', '1', '5', '0', '2500', '12500'),
(318, 'PB-19122022-3', '2', '0', '5', '0', '5000', '25000'),
(319, 'PB-19122022-2', '7', '0', '10', '0', '3000', '30000'),
(320, 'PB-19122022-2', '1', '6', '5', '0', '2500', '12500'),
(321, 'PB-18122022-1', '7', '10', '100', '0', '3000', '300000'),
(322, 'PB-18122022-1', '8', '0', '120', '0', '1200', '144000'),
(323, 'PB-28122022-8', '2', '5', '5', '0', '5000', '25000'),
(324, 'PB-18122022-7', '6', '0', '10', '0', '30000', '300000'),
(325, 'PB-18122022-6', '6', '10', '10', '0', '30000', '300000'),
(326, 'PB-18122022-5', '6', '20', '10', '0', '30000', '300000'),
(327, 'PB-18122022-4', '2', '10', '10', '0', '5000', '50000'),
(328, 'PB-11122022-3', '2', '20', '100', '0', '5000', '500000'),
(329, 'PB-11122022-3', '3', '0', '500', '0', '3000', '1500000'),
(330, 'PB-11122022-2', '3', '500', '50', '0', '3000', '150000'),
(331, 'PB-11122022-2', '2', '120', '20', '0', '5000', '100000'),
(332, 'PB-11122022-1', '3', '550', '100', '0', '3000', '300000'),
(333, 'PB-11122022-1', '6', '30', '10', '0', '30000', '300000'),
(334, 'PB-11122022-1', '2', '140', '20', '0', '5000', '100000'),
(335, 'PB-11122022-1', '4', '0', '3', '0', '55000', '165000'),
(336, 'PB-11122022-1', '5', '0', '2', '0', '30000', '60000'),
(337, 'PB-03012023-9', '2', '160', '10', '0', '5000', '50000'),
(340, 'PB-08022023-11', '6', '40', '5', '0', '30000', '150000'),
(341, 'PB-08022023-11', '3', '655', '5', '0', '3000', '15000'),
(342, 'PB-08022023-11', '2', '180', '5', '0', '5000', '25000'),
(343, 'PB-13022023-12', '11', '0', '10', '0', '12000', '120000'),
(345, 'PB-28012023-5', '1', '6', '5', '0', '2500', '12500'),
(347, 'PB-13022023-13', '11', '15', '5', '1', '12000', '48000'),
(360, 'PB-08022023-10', '3', '-10', '10', '0', '3000', '30000'),
(361, 'PB-08022023-10', '2', '0', '10', '0', '5000', '50000'),
(362, 'PB-14022023-20', '11', '0', '5', '2', '12000', '36000'),
(364, 'PB-14022023-21', '3', '740', '5', '2', '3000', '9000');

-- --------------------------------------------------------

--
-- Table structure for table `t_pembelian_umum`
--

CREATE TABLE `t_pembelian_umum` (
  `pembelian_umum_id` int(11) NOT NULL,
  `pembelian_umum_user` text NOT NULL,
  `pembelian_umum_nomor` text NOT NULL,
  `pembelian_umum_tanggal` date NOT NULL DEFAULT curdate(),
  `pembelian_umum_status` set('lunas','belum') NOT NULL,
  `pembelian_umum_jatuh_tempo` text NOT NULL,
  `pembelian_umum_pelunasan` text NOT NULL,
  `pembelian_umum_pelunasan_keterangan` text NOT NULL,
  `pembelian_umum_pembayaran` text NOT NULL,
  `pembelian_umum_keterangan` text NOT NULL,
  `pembelian_umum_lampiran` text NOT NULL,
  `pembelian_umum_qty_akhir` text NOT NULL,
  `pembelian_umum_ppn` text NOT NULL,
  `pembelian_umum_total` text NOT NULL,
  `pembelian_umum_hapus` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `t_pembelian_umum`
--

INSERT INTO `t_pembelian_umum` (`pembelian_umum_id`, `pembelian_umum_user`, `pembelian_umum_nomor`, `pembelian_umum_tanggal`, `pembelian_umum_status`, `pembelian_umum_jatuh_tempo`, `pembelian_umum_pelunasan`, `pembelian_umum_pelunasan_keterangan`, `pembelian_umum_pembayaran`, `pembelian_umum_keterangan`, `pembelian_umum_lampiran`, `pembelian_umum_qty_akhir`, `pembelian_umum_ppn`, `pembelian_umum_total`, `pembelian_umum_hapus`) VALUES
(3, '5', 'PU-15022023-1', '2023-02-15', 'belum', '2023-02-15', '2023-02-15', 'Mari Kita Bayar', 'tunai', '-', '6b2f23ab0cf41ea30094bce154be9613.png', '30', '0', '110000', 0),
(5, '5', 'PU-15022023-2', '2023-02-15', 'lunas', '2023-02-15', '2023-02-15', 'Mari kita bayar', 'tunai', '-', '', '10', '0', '325000', 0);

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `t_pembelian_umum_barang`
--

INSERT INTO `t_pembelian_umum_barang` (`pembelian_umum_barang_id`, `pembelian_umum_barang_nomor`, `pembelian_umum_barang_barang`, `pembelian_umum_barang_qty`, `pembelian_umum_barang_potongan`, `pembelian_umum_barang_harga`, `pembelian_umum_barang_subtotal`) VALUES
(14, 'PU-15022023-2', 'Oli gardan', '5', '0', '25000', '125000'),
(15, 'PU-15022023-2', 'Oli mesin', '5', '0', '40000', '200000'),
(18, 'PU-15022023-1', 'Gorengan', '20', '0', '500', '10000'),
(19, 'PU-15022023-1', 'Nasi Goreng', '10', '0', '10000', '100000');

-- --------------------------------------------------------

--
-- Table structure for table `t_penjualan`
--

CREATE TABLE `t_penjualan` (
  `penjualan_id` int(11) NOT NULL,
  `penjualan_po` int(11) NOT NULL DEFAULT 0,
  `penjualan_packing` text NOT NULL DEFAULT '',
  `penjualan_pengiriman` text NOT NULL DEFAULT '',
  `penjualan_nomor` text NOT NULL,
  `penjualan_pelanggan` text NOT NULL,
  `penjualan_tanggal` date NOT NULL,
  `penjualan_jatuh_tempo` date NOT NULL,
  `penjualan_pembayaran` text DEFAULT NULL,
  `penjualan_status` set('l','b') NOT NULL,
  `penjualan_pelunasan` text DEFAULT NULL,
  `penjualan_pelunasan_keterangan` text DEFAULT NULL,
  `penjualan_keterangan` text NOT NULL,
  `penjualan_lampiran` text NOT NULL,
  `penjualan_qty_akhir` text DEFAULT NULL,
  `penjualan_ppn` text DEFAULT NULL,
  `penjualan_total` text DEFAULT NULL,
  `penjualan_hapus` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `t_penjualan`
--

INSERT INTO `t_penjualan` (`penjualan_id`, `penjualan_po`, `penjualan_packing`, `penjualan_pengiriman`, `penjualan_nomor`, `penjualan_pelanggan`, `penjualan_tanggal`, `penjualan_jatuh_tempo`, `penjualan_pembayaran`, `penjualan_status`, `penjualan_pelunasan`, `penjualan_pelunasan_keterangan`, `penjualan_keterangan`, `penjualan_lampiran`, `penjualan_qty_akhir`, `penjualan_ppn`, `penjualan_total`, `penjualan_hapus`) VALUES
(76, 0, '', '', 'PJ-22022023-1', '15', '2023-02-22', '2023-02-22', 'tunai', 'l', NULL, NULL, '-', '', '5', '0', '78500', 0);

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `t_penjualan_barang`
--

INSERT INTO `t_penjualan_barang` (`penjualan_barang_id`, `penjualan_barang_nomor`, `penjualan_barang_barang`, `penjualan_barang_jenis`, `penjualan_barang_warna`, `penjualan_barang_stok`, `penjualan_barang_qty`, `penjualan_barang_potongan`, `penjualan_barang_harga`, `penjualan_barang_hps`, `penjualan_barang_subtotal`) VALUES
(339, 'PJ-22022023-1', '10', '1', '2', '5', '2', '0', '25000', '20350', '50000'),
(340, 'PJ-22022023-1', '8', '3', '0', '10', '3', '0', '9500', '8175', '28500');

-- --------------------------------------------------------

--
-- Table structure for table `t_pewarnaan`
--

CREATE TABLE `t_pewarnaan` (
  `pewarnaan_id` int(11) NOT NULL,
  `pewarnaan_cacat` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
  `produk_update` date NOT NULL DEFAULT curdate(),
  `produk_tanggal` date NOT NULL DEFAULT curdate(),
  `produk_hapus` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `t_produk`
--

INSERT INTO `t_produk` (`produk_id`, `produk_kode`, `produk_nama`, `produk_satuan`, `produk_merk`, `produk_ketebalan`, `produk_panjang`, `produk_lebar`, `produk_berat`, `produk_keterangan`, `produk_update`, `produk_tanggal`, `produk_hapus`) VALUES
(8, 'MP001', 'Openback 3', '1', 'Original', '10', '15', '5', '5', '-', '2023-02-17', '2023-02-17', 0),
(9, 'MP002', 'Hollow 22 x 34', '1', 'Original', '6', '22', '34', '10', '-', '2023-02-17', '2023-02-17', 0),
(10, 'MP003', 'Hollow 21 x 21 Oval', '1', 'Original', '5', '21', '21', '7', '-', '2023-02-17', '2023-02-17', 0),
(11, 'MP004', 'Hollow 21 X 21 Kotak', '1', 'Original', '5', '21', '21', '7', '-', '2023-02-17', '2023-02-17', 0);

-- --------------------------------------------------------

--
-- Table structure for table `t_produksi`
--

CREATE TABLE `t_produksi` (
  `produksi_id` int(11) NOT NULL,
  `produksi_status` int(11) NOT NULL DEFAULT 0,
  `produksi_nomor` text NOT NULL,
  `produksi_tanggal` date NOT NULL,
  `produksi_shift` text NOT NULL,
  `produksi_pekerja` text NOT NULL,
  `produksi_keterangan` text NOT NULL,
  `produksi_mesin` text DEFAULT NULL,
  `produksi_lampiran_1` text DEFAULT NULL,
  `produksi_lampiran_2` text DEFAULT NULL,
  `produksi_barang_qty` text DEFAULT NULL,
  `produksi_billet_hps` text DEFAULT NULL,
  `produksi_billet_qty` text DEFAULT NULL,
  `produksi_jasa` text DEFAULT NULL,
  `produksi_total_akhir` text DEFAULT NULL,
  `produksi_billet_sisa` text DEFAULT '0',
  `produksi_pewarnaan` text DEFAULT '0' COMMENT '0 = tidak ada, 1 = proses, 2 =  selesai',
  `produksi_pewarnaan_tanggal` date DEFAULT NULL,
  `produksi_pewarnaan_keterangan` text DEFAULT NULL,
  `produksi_hapus` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `t_produksi`
--

INSERT INTO `t_produksi` (`produksi_id`, `produksi_status`, `produksi_nomor`, `produksi_tanggal`, `produksi_shift`, `produksi_pekerja`, `produksi_keterangan`, `produksi_mesin`, `produksi_lampiran_1`, `produksi_lampiran_2`, `produksi_barang_qty`, `produksi_billet_hps`, `produksi_billet_qty`, `produksi_jasa`, `produksi_total_akhir`, `produksi_billet_sisa`, `produksi_pewarnaan`, `produksi_pewarnaan_tanggal`, `produksi_pewarnaan_keterangan`, `produksi_hapus`) VALUES
(59, 1, 'PR-19022023-1', '2023-02-19', '78', '[\"1\",\"2\",\"3\"]', '-', '3', '', '', '20', '7175', '10', '10000', '81750', '5', '0', NULL, NULL, 0),
(60, 1, 'PR-19022023-2', '2023-02-19', '78', '[\"1\",\"2\",\"3\",\"4\",\"5\"]', '', '1', '', '', '8', '7175', '20', '20000', '163500', '0', '1', NULL, NULL, 0),
(61, 1, 'PR-19022023-3', '2023-02-19', '78', '[\"1\",\"2\",\"5\"]', '-', '2', '', '', '25', '7175', '10', '30000', '101750', '2', '2', '2023-02-19', 'Siap di jual mase', 0);

-- --------------------------------------------------------

--
-- Table structure for table `t_produksi_barang`
--

CREATE TABLE `t_produksi_barang` (
  `produksi_barang_id` int(11) NOT NULL,
  `produksi_barang_nomor` text NOT NULL,
  `produksi_barang_barang` text NOT NULL,
  `produksi_barang_jenis` text NOT NULL,
  `produksi_barang_warna` text NOT NULL,
  `produksi_barang_warna_cacat` text NOT NULL DEFAULT '0',
  `produksi_barang_qty` text NOT NULL,
  `produksi_barang_tanggal` date NOT NULL DEFAULT curdate()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `t_produksi_barang`
--

INSERT INTO `t_produksi_barang` (`produksi_barang_id`, `produksi_barang_nomor`, `produksi_barang_barang`, `produksi_barang_jenis`, `produksi_barang_warna`, `produksi_barang_warna_cacat`, `produksi_barang_qty`, `produksi_barang_tanggal`) VALUES
(248, 'PR-19022023-2', '11', '1', '6', '0', '2', '2023-02-19'),
(249, 'PR-19022023-2', '10', '2', '4', '0', '2', '2023-02-19'),
(250, 'PR-19022023-2', '9', '3', '0', '0', '2', '2023-02-19'),
(251, 'PR-19022023-2', '8', '3', '0', '0', '2', '2023-02-19'),
(258, 'PR-19022023-1', '8', '3', '0', '0', '10', '2023-02-19'),
(259, 'PR-19022023-1', '9', '3', '0', '0', '10', '2023-02-19'),
(262, 'PR-19022023-3', '8', '1', '2', '2', '10', '2023-02-19'),
(263, 'PR-19022023-3', '11', '2', '7', '1', '10', '2023-02-20'),
(264, 'PR-19022023-3', '10', '1', '2', '1', '5', '2023-02-20');

-- --------------------------------------------------------

--
-- Table structure for table `t_produk_barang`
--

CREATE TABLE `t_produk_barang` (
  `produk_barang_id` int(11) NOT NULL,
  `produk_barang_barang` text NOT NULL,
  `produk_barang_stok` text DEFAULT NULL,
  `produk_barang_jenis` text NOT NULL,
  `produk_barang_warna` text NOT NULL,
  `produk_barang_hps` text DEFAULT NULL,
  `produk_barang_harga` text DEFAULT '0',
  `produk_barang_tanggal` date NOT NULL DEFAULT curdate()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `t_produk_barang`
--

INSERT INTO `t_produk_barang` (`produk_barang_id`, `produk_barang_barang`, `produk_barang_stok`, `produk_barang_jenis`, `produk_barang_warna`, `produk_barang_hps`, `produk_barang_harga`, `produk_barang_tanggal`) VALUES
(231, '10', '3', '1', '2', '20350', '25000', '2023-02-22'),
(232, '11', '10', '2', '7', '10175', '22000', '2023-02-22'),
(233, '8', '7', '1', '2', '10175', '12000', '2023-02-22'),
(234, '8', '7', '3', '0', '8175', '9500', '2023-02-22'),
(235, '9', '10', '3', '0', '8175', '9000', '2023-02-22');

-- --------------------------------------------------------

--
-- Table structure for table `t_produk_warna`
--

CREATE TABLE `t_produk_warna` (
  `produk_warna_id` int(11) NOT NULL,
  `produk_warna_produk` text NOT NULL,
  `produk_warna_warna` text NOT NULL,
  `produk_warna_jenis` text NOT NULL,
  `produk_warna_stok` text NOT NULL,
  `produk_warna_hpp` text NOT NULL,
  `produk_warna_hps` text NOT NULL,
  `produk_warna_tanggal` date NOT NULL DEFAULT curdate()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `t_rekening`
--

INSERT INTO `t_rekening` (`rekening_id`, `rekening_nama`, `rekening_bank`, `rekening_no`, `rekening_tanggal`, `rekening_hapus`) VALUES
(4, 'PT. RAJAWALI ALUMUNIUM PERKASA ( BNI )', '4', '0495285835', '2023-01-23', 0),
(5, 'PT. RAJAWALI ALUMUNIUM PERKASA ( BRI )', '1', '763201007520530', '2023-01-23', 0),
(6, 'PT. RAJAWALI ALUMUNIUM PERKASA ( MANDIRI )', '3', '0700006801222', '2023-01-23', 0);

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
(7, 'Pieces', 'PCS', '2023-01-06', 0);

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t_user`
--

INSERT INTO `t_user` (`user_id`, `user_email`, `user_password`, `user_name`, `user_ttl`, `user_nohp`, `user_alamat`, `user_biodata`, `user_foto`, `user_level`, `user_pelajaran`, `user_kelas`, `user_email_2`, `user_tanggal`, `user_hapus`) VALUES
(5, 'admin@admin.com', '21232f297a57a5a743894a0e4a801fc3', 'JTM', '2021-11-09', '085555111555', 'Alamat', 'Biodata', '4c293a141d8c17800a44b816d35238cd.png', 1, NULL, NULL, NULL, '2023-02-09', 0),
(78, 'siskae@gmail.com', 'afa0b885505255964c06188e2b4e8f59', 'Siska Elisa', NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL, NULL, '2022-12-04', 0);

-- --------------------------------------------------------

--
-- Table structure for table `t_warna`
--

CREATE TABLE `t_warna` (
  `warna_id` int(11) NOT NULL,
  `warna_kode` text NOT NULL,
  `warna_nama` text NOT NULL,
  `warna_keterangan` text NOT NULL,
  `warna_tanggal` date NOT NULL DEFAULT curdate(),
  `warna_hapus` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `t_warna`
--

INSERT INTO `t_warna` (`warna_id`, `warna_kode`, `warna_nama`, `warna_keterangan`, `warna_tanggal`, `warna_hapus`) VALUES
(0, 'WR000', 'Tanpa Warna', '-', '2023-02-18', 0),
(2, 'WR001', 'Merah', '-', '2023-02-17', 0),
(3, 'WR002', 'Hitam', '-', '2023-02-17', 0),
(4, 'WR004', 'Hijau', '-', '2023-02-17', 0),
(5, 'WR006', 'Kuning', '-', '2023-02-17', 0),
(6, 'WR007', 'Biru', '-', '2023-02-17', 0),
(7, 'WR008', 'Putih', '-', '2023-02-17', 0);

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `t_warna_jenis`
--

INSERT INTO `t_warna_jenis` (`warna_jenis_id`, `warna_jenis_kode`, `warna_jenis_type`, `warna_jenis_keterangan`, `warna_jenis_hapus`, `warna_jenis_tanggal`) VALUES
(1, 'JN001', 'Anodizing', '-', 0, '2023-01-04'),
(2, 'JN002', 'Powder Coating', '-', 0, '2023-01-04'),
(3, 'JN003', 'Jual Langsung', '-', 0, '2023-01-04');

--
-- Indexes for dumped tables
--

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
-- Indexes for table `t_coa`
--
ALTER TABLE `t_coa`
  ADD PRIMARY KEY (`coa_id`);

--
-- Indexes for table `t_coa_sub`
--
ALTER TABLE `t_coa_sub`
  ADD PRIMARY KEY (`coa_sub_id`);

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
-- Indexes for table `t_pewarnaan`
--
ALTER TABLE `t_pewarnaan`
  ADD PRIMARY KEY (`pewarnaan_id`);

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
-- Indexes for table `t_produk_warna`
--
ALTER TABLE `t_produk_warna`
  ADD PRIMARY KEY (`produk_warna_id`);

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
-- AUTO_INCREMENT for table `t_bahan`
--
ALTER TABLE `t_bahan`
  MODIFY `bahan_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

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
-- AUTO_INCREMENT for table `t_coa`
--
ALTER TABLE `t_coa`
  MODIFY `coa_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `t_coa_sub`
--
ALTER TABLE `t_coa_sub`
  MODIFY `coa_sub_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `t_jurnal`
--
ALTER TABLE `t_jurnal`
  MODIFY `jurnal_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=299;

--
-- AUTO_INCREMENT for table `t_karyawan`
--
ALTER TABLE `t_karyawan`
  MODIFY `karyawan_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `t_kontak`
--
ALTER TABLE `t_kontak`
  MODIFY `kontak_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `t_logo`
--
ALTER TABLE `t_logo`
  MODIFY `logo_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `t_mesin`
--
ALTER TABLE `t_mesin`
  MODIFY `mesin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `t_pajak`
--
ALTER TABLE `t_pajak`
  MODIFY `pajak_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `t_peleburan`
--
ALTER TABLE `t_peleburan`
  MODIFY `peleburan_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `t_peleburan_barang`
--
ALTER TABLE `t_peleburan_barang`
  MODIFY `peleburan_barang_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=145;

--
-- AUTO_INCREMENT for table `t_pembelian`
--
ALTER TABLE `t_pembelian`
  MODIFY `pembelian_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT for table `t_pembelian_barang`
--
ALTER TABLE `t_pembelian_barang`
  MODIFY `pembelian_barang_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=365;

--
-- AUTO_INCREMENT for table `t_pembelian_umum`
--
ALTER TABLE `t_pembelian_umum`
  MODIFY `pembelian_umum_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `t_pembelian_umum_barang`
--
ALTER TABLE `t_pembelian_umum_barang`
  MODIFY `pembelian_umum_barang_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `t_penjualan`
--
ALTER TABLE `t_penjualan`
  MODIFY `penjualan_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=77;

--
-- AUTO_INCREMENT for table `t_penjualan_barang`
--
ALTER TABLE `t_penjualan_barang`
  MODIFY `penjualan_barang_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=341;

--
-- AUTO_INCREMENT for table `t_pewarnaan`
--
ALTER TABLE `t_pewarnaan`
  MODIFY `pewarnaan_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `t_produk`
--
ALTER TABLE `t_produk`
  MODIFY `produk_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `t_produksi`
--
ALTER TABLE `t_produksi`
  MODIFY `produksi_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT for table `t_produksi_barang`
--
ALTER TABLE `t_produksi_barang`
  MODIFY `produksi_barang_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=265;

--
-- AUTO_INCREMENT for table `t_produk_barang`
--
ALTER TABLE `t_produk_barang`
  MODIFY `produk_barang_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=236;

--
-- AUTO_INCREMENT for table `t_produk_warna`
--
ALTER TABLE `t_produk_warna`
  MODIFY `produk_warna_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `t_rekening`
--
ALTER TABLE `t_rekening`
  MODIFY `rekening_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `t_satuan`
--
ALTER TABLE `t_satuan`
  MODIFY `satuan_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `t_user`
--
ALTER TABLE `t_user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=80;

--
-- AUTO_INCREMENT for table `t_warna`
--
ALTER TABLE `t_warna`
  MODIFY `warna_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `t_warna_jenis`
--
ALTER TABLE `t_warna_jenis`
  MODIFY `warna_jenis_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
