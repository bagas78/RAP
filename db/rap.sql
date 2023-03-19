-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 19, 2023 at 08:02 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
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
(1, 'BH001', 'Kawat las', 90, '1', 'pembantu', '2500', '2022-12-05', 0),
(2, 'BH002', 'Velg sepeda', 95, '1', 'utama', '5000', '2022-12-05', 0),
(3, 'BH003', 'Paku', 85, '1', 'utama', '3000', '2022-12-05', 0),
(4, 'BH004', 'Plat kapal', 100, '1', 'utama', '55000', '2022-12-05', 0),
(5, 'BH005', 'Rel kereta', 90, '1', 'utama', '30000', '2022-12-05', 0),
(6, 'BH006', 'Rangka Motor', 95, '1', 'utama', '30000', '2022-12-11', 0),
(7, 'BH007', 'Kawat Jemuran', 100, '1', 'pembantu', '3000', '2022-12-18', 0),
(8, 'BH008', 'Paku Bekas', 60, '1', 'pembantu', '1200', '2022-12-18', 0),
(9, 'BH009', 'Matras', 70, '1', 'pembantu', '10000', '2022-12-21', 0),
(11, 'BH0010', 'Tiang Listrik', 90, '1', 'utama', '12000', '2023-02-12', 0);

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
  `billet_full` text DEFAULT '0',
  `billet_min` text DEFAULT '0',
  `billet_stok` text DEFAULT '0',
  `billet_sisa` text DEFAULT '0',
  `billet_hpp` text DEFAULT '9',
  `billet_hps` text DEFAULT '0',
  `billet_update` date NOT NULL DEFAULT curdate()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `t_billet`
--

INSERT INTO `t_billet` (`billet_id`, `billet_full`, `billet_min`, `billet_stok`, `billet_sisa`, `billet_hpp`, `billet_hps`, `billet_update`) VALUES
(1, '80', '80', '0', '0', '870000', '10875', '2023-03-06');

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
(9, '152', 'Biaya produksi', '5', '2023-01-27'),
(10, '153', 'Penyesuaian stok', '5', '2023-03-14');

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
(291, '', '2', 'piutang (penjualan produk)', 'debit', '', 0, '2023-02-21'),
(292, '', '3', 'stok produk', 'kredit', '', 0, '2023-02-21'),
(297, 'PJ-22022023-1', '2', 'piutang (penjualan produk)', 'debit', '66500', 0, '2023-02-22'),
(298, 'PJ-22022023-1', '3', 'stok produk', 'kredit', '66500', 0, '2023-02-22'),
(299, 'PLB-16022023-3', '9', 'biaya peleburan', 'debit', '75000', 0, '2023-02-16'),
(300, 'PLB-16022023-3', '5', 'stok billet', 'kredit', '75000', 0, '2023-02-16'),
(301, 'PLB-03032023-4', '9', 'biaya peleburan', 'debit', '310000', 0, '2023-03-03'),
(302, 'PLB-03032023-4', '5', 'stok billet', 'kredit', '310000', 0, '2023-03-03'),
(303, 'PLB-06032023-1', '9', 'biaya peleburan', 'debit', '110000', 0, '2023-03-06'),
(304, 'PLB-06032023-1', '5', 'stok billet', 'kredit', '110000', 0, '2023-03-06'),
(305, 'PLB-06032023-2', '9', 'biaya peleburan', 'debit', '760000', 0, '2023-03-06'),
(306, 'PLB-06032023-2', '5', 'stok billet', 'kredit', '760000', 0, '2023-03-06');

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
(15, 'PLB-06032023-1', '2023-03-06', '30', '15000', '50', '0', '110000', 0),
(16, 'PLB-06032023-2', '2023-03-06', '25', '10000', '30', '0', '760000', 0);

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
(148, 'PLB-06032023-1', '3', '15', '3000', '45000', '2023-03-06'),
(149, 'PLB-06032023-1', '2', '5', '5000', '25000', '2023-03-06'),
(150, 'PLB-06032023-1', '1', '10', '2500', '25000', '2023-03-06'),
(151, 'PLB-06032023-2', '6', '5', '30000', '150000', '2023-03-06'),
(152, 'PLB-06032023-2', '5', '20', '30000', '600000', '2023-03-06');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `t_pembelian`
--

INSERT INTO `t_pembelian` (`pembelian_id`, `pembelian_user`, `pembelian_po`, `pembelian_po_tanggal`, `pembelian_nomor`, `pembelian_supplier`, `pembelian_tanggal`, `pembelian_jatuh_tempo`, `pembelian_status`, `pembelian_hutang`, `pembelian_pelunasan`, `pembelian_pelunasan_keterangan`, `pembelian_pembayaran`, `pembelian_keterangan`, `pembelian_lampiran`, `pembelian_qty_akhir`, `pembelian_ppn`, `pembelian_total`, `pembelian_hapus`) VALUES
(60, '5', 0, '', 'PB-06032023-1', '1', '2023-03-06', '2023-03-06', 'belum', '1', NULL, '', 'tunai', '-', '', '300', '0', '1050000', 0),
(61, '5', 0, '', 'PB-06032023-2', '1', '2023-03-06', '2023-03-06', 'belum', '1', NULL, '', 'tunai', '-', '', '300', '0', '11500000', 0),
(62, '5', 0, '', 'PB-06032023-3', '4', '2023-03-06', '2023-03-06', 'lunas', '1', '2023-03-06', 'Sudah di bayar', 'tunai', '-', '', '400', '0', '2620000', 0),
(63, '5', 1, '2023-03-11', 'PB-11032023-4', '1', '2023-03-11', '2023-03-11', 'lunas', '0', NULL, '', 'tunai', '-', '', '20', '0', '75000', 0),
(64, '5', 0, '', 'PB-11032023-5', '1', '2023-03-11', '2023-03-11', 'lunas', '0', NULL, '', 'tunai', '-', '', '10', '0', '300000', 0);

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
(368, 'PB-06032023-1', '3', '100', '100', '0', '3000', '300000'),
(369, 'PB-06032023-1', '2', '0', '100', '0', '5000', '500000'),
(370, 'PB-06032023-1', '1', '100', '100', '0', '2500', '250000'),
(371, 'PB-06032023-2', '6', '0', '100', '0', '30000', '3000000'),
(372, 'PB-06032023-2', '5', '0', '100', '0', '30000', '3000000'),
(373, 'PB-06032023-2', '4', '0', '100', '0', '55000', '5500000'),
(374, 'PB-06032023-3', '11', '0', '100', '0', '12000', '1200000'),
(375, 'PB-06032023-3', '9', '0', '100', '0', '10000', '1000000'),
(376, 'PB-06032023-3', '8', '0', '100', '0', '1200', '120000'),
(377, 'PB-06032023-3', '7', '0', '100', '0', '3000', '300000'),
(378, 'PB-11032023-4', '2', '95', '10', '0', '5000', '50000'),
(379, 'PB-11032023-4', '1', '90', '10', '0', '2500', '25000'),
(380, 'PB-11032023-5', '5', '80', '10', '0', '30000', '300000');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `t_pembelian_umum`
--

INSERT INTO `t_pembelian_umum` (`pembelian_umum_id`, `pembelian_umum_user`, `pembelian_umum_nomor`, `pembelian_umum_tanggal`, `pembelian_umum_jatuh_tempo`, `pembelian_umum_status`, `pembelian_umum_hutang`, `pembelian_umum_pelunasan`, `pembelian_umum_pelunasan_keterangan`, `pembelian_umum_pembayaran`, `pembelian_umum_keterangan`, `pembelian_umum_lampiran`, `pembelian_umum_qty_akhir`, `pembelian_umum_ppn`, `pembelian_umum_total`, `pembelian_umum_hapus`) VALUES
(8, '5', 'PU-06032023-1', '2023-03-11', '2023-03-06', 'lunas', '1', NULL, NULL, 'tunai', '-', '', '30', '0', '140000', 0),
(9, '5', 'PU-06032023-2', '2023-03-06', '2023-03-06', 'belum', '1', '2023-03-06', 'Sudah di bayar', 'tunai', '-', '', '16', '0', '160000', 0),
(10, '5', 'PU-11032023-3', '2023-03-11', '2023-03-11', 'lunas', '1', NULL, NULL, 'tunai', '-', '', '5', '0', '5000', 0);

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
(24, 'PU-06032023-1', 'Gorengan', '20', '0', '1000', '20000'),
(25, 'PU-06032023-1', 'Nasi Goreng', '10', '0', '12000', '120000'),
(26, 'PU-06032023-2', 'Oli mesin gerindra', '1', '0', '55000', '55000'),
(27, 'PU-06032023-2', 'Baut roda', '15', '0', '7000', '105000'),
(28, 'PU-11032023-3', 'tali rafia', '5', '0', '1000', '5000');

-- --------------------------------------------------------

--
-- Table structure for table `t_penjualan`
--

CREATE TABLE `t_penjualan` (
  `penjualan_id` int(11) NOT NULL,
  `penjualan_po` int(11) NOT NULL DEFAULT 0,
  `penjualan_nomor` text NOT NULL,
  `penjualan_pelanggan` text NOT NULL,
  `penjualan_tanggal` date NOT NULL,
  `penjualan_jatuh_tempo` date NOT NULL,
  `penjualan_pembayaran` text DEFAULT NULL,
  `penjualan_status` set('lunas','belum') NOT NULL,
  `penjualan_piutang` enum('1','0') DEFAULT '0' COMMENT '1 = ada piutang , 0 = tidak ada',
  `penjualan_pelunasan` date DEFAULT NULL,
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

INSERT INTO `t_penjualan` (`penjualan_id`, `penjualan_po`, `penjualan_nomor`, `penjualan_pelanggan`, `penjualan_tanggal`, `penjualan_jatuh_tempo`, `penjualan_pembayaran`, `penjualan_status`, `penjualan_piutang`, `penjualan_pelunasan`, `penjualan_pelunasan_keterangan`, `penjualan_keterangan`, `penjualan_lampiran`, `penjualan_qty_akhir`, `penjualan_ppn`, `penjualan_total`, `penjualan_hapus`) VALUES
(94, 0, 'PJ-06032023-1', '15', '2023-03-06', '2023-03-06', 'tunai', 'lunas', '0', NULL, NULL, '-', '', '4', '0', '100000', 0),
(95, 0, 'PJ-06032023-2', '15', '2023-03-06', '2023-03-06', 'tunai', 'belum', '1', NULL, NULL, '-', '', '4', '0', '100000', 0),
(96, 0, 'PJ-11032023-3', '15', '2023-03-11', '2023-03-11', 'tunai', 'lunas', '1', '2023-03-11', 'lunas mas bro', '-', '', '2', '0', '50000', 0);

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
(378, 'PJ-06032023-1', '9', '3', '0', '10', '2', '0', '25000', '23750', '50000'),
(379, 'PJ-06032023-1', '8', '3', '0', '10', '2', '0', '25000', '23750', '50000'),
(380, 'PJ-06032023-2', '10', '3', '0', '10', '2', '0', '25000', '23750', '50000'),
(381, 'PJ-06032023-2', '8', '3', '0', '8', '2', '0', '25000', '23750', '50000'),
(382, 'PJ-11032023-3', '8', '3', '0', '6', '2', '0', '25000', '23750', '50000');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `t_penyesuaian`
--

INSERT INTO `t_penyesuaian` (`penyesuaian_id`, `penyesuaian_nomor`, `penyesuaian_jenis`, `penyesuaian_transaksi`, `penyesuaian_kategori`, `penyesuaian_keterangan`, `penyesuaian_tanggal`, `penyesuaian_hapus`) VALUES
(2, 'PN001', 'pembelian', 'perhitungan', 'umum', '-', '2023-03-19', 0),
(3, 'PN002', 'penjualan', 'perhitungan', 'umum', '-', '2023-03-19', 0),
(4, 'PN003', 'pembelian', 'perhitungan', 'umum', '-', '2023-03-19', 0);

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `t_penyesuaian_barang`
--

INSERT INTO `t_penyesuaian_barang` (`penyesuaian_barang_id`, `penyesuaian_barang_nomor`, `penyesuaian_barang_barang`, `penyesuaian_barang_jenis`, `penyesuaian_barang_warna`, `penyesuaian_barang_jumlah`, `penyesuaian_barang_stok`, `penyesuaian_barang_selisih`, `penyesuaian_barang_status`) VALUES
(3, 'PN001', '2', NULL, NULL, '90', '95', '5', 'berkurang'),
(4, 'PN001', '1', NULL, NULL, '95', '90', '5', 'bertambah'),
(5, 'PN002', '9', '3', '0', '10', '8', '2', 'bertambah'),
(6, 'PN002', '8', '3', '0', '10', '4', '6', 'bertambah'),
(7, 'PN003', '11', '', '', '100', '90', '10', 'bertambah');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `t_produk`
--

INSERT INTO `t_produk` (`produk_id`, `produk_kode`, `produk_nama`, `produk_satuan`, `produk_merk`, `produk_ketebalan`, `produk_panjang`, `produk_lebar`, `produk_berat`, `produk_keterangan`, `produk_colly`, `produk_update`, `produk_tanggal`, `produk_hapus`) VALUES
(8, 'MP001', 'Openback 3', '1', 'Original', '10', '15', '5', '5', '-', '50', '2023-02-17', '2023-02-17', 0),
(9, 'MP002', 'Hollow 22 x 34', '1', 'Original', '6', '22', '34', '10', '-', '20', '2023-02-17', '2023-02-17', 0),
(10, 'MP003', 'Hollow 21 x 21 Oval', '1', 'Original', '5', '21', '21', '7', '-', '50', '2023-02-17', '2023-02-17', 0),
(11, 'MP004', 'Hollow 21 X 21 Kotak', '1', 'Original', '5', '21', '21', '7', '-', '30', '2023-02-17', '2023-02-17', 0);

-- --------------------------------------------------------

--
-- Table structure for table `t_produksi`
--

CREATE TABLE `t_produksi` (
  `produksi_id` int(11) NOT NULL,
  `produksi_pesanan` text DEFAULT NULL,
  `produksi_penjualan` enum('1','0') DEFAULT '0' COMMENT '1 = diambil penjualan | 0 = PO produksi',
  `produksi_status` enum('1','0') NOT NULL DEFAULT '0' COMMENT '1 = proses | 0 = PO',
  `produksi_nomor` text NOT NULL,
  `produksi_tanggal` date NOT NULL,
  `produksi_shift` text NOT NULL,
  `produksi_pekerja` text DEFAULT NULL,
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
  `produksi_pewarnaan` enum('0','1','2') DEFAULT '0' COMMENT '0 = tidak ada | 1 = ada | 2 =  selesai',
  `produksi_pewarnaan_tanggal` date DEFAULT NULL,
  `produksi_packing_tanggal` date DEFAULT NULL,
  `produksi_hapus` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `t_produksi`
--

INSERT INTO `t_produksi` (`produksi_id`, `produksi_pesanan`, `produksi_penjualan`, `produksi_status`, `produksi_nomor`, `produksi_tanggal`, `produksi_shift`, `produksi_pekerja`, `produksi_keterangan`, `produksi_mesin`, `produksi_lampiran_1`, `produksi_lampiran_2`, `produksi_barang_qty`, `produksi_billet_hps`, `produksi_billet_qty`, `produksi_jasa`, `produksi_total_akhir`, `produksi_billet_sisa`, `produksi_pewarnaan`, `produksi_pewarnaan_tanggal`, `produksi_packing_tanggal`, `produksi_hapus`) VALUES
(91, '15', '0', '0', 'PR-06032023-1', '2023-03-06', '78', 'null', '-', '1', NULL, NULL, '50', '10875', '50', '10000', '553750', '0', '1', NULL, NULL, 0),
(92, '', '0', '1', 'PR-06032023-2', '2023-03-06', '78', '[\"1\",\"3\",\"5\"]', '-', '2', NULL, NULL, '40', '10875', '20', '20000', '237500', '0', '0', NULL, '2023-03-06', 0),
(93, '', '0', '1', 'PR-06032023-3', '2023-03-06', '78', '[\"2\",\"3\"]', '-', '1', NULL, NULL, '20', '10875', '10', '2000', '110750', '0', '1', NULL, NULL, 0);

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
  `produksi_barang_mf_stok` text DEFAULT NULL,
  `produksi_barang_mf` text NOT NULL DEFAULT '0',
  `produksi_barang_qty` text NOT NULL,
  `produksi_barang_warna_cacat` text NOT NULL DEFAULT '0',
  `produksi_barang_tanggal` date NOT NULL DEFAULT curdate()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `t_produksi_barang`
--

INSERT INTO `t_produksi_barang` (`produksi_barang_id`, `produksi_barang_nomor`, `produksi_barang_barang`, `produksi_barang_jenis`, `produksi_barang_warna`, `produksi_barang_mf_stok`, `produksi_barang_mf`, `produksi_barang_qty`, `produksi_barang_warna_cacat`, `produksi_barang_tanggal`) VALUES
(324, 'PR-06032023-1', '10', '2', '2', '0', '0', '10', '0', '2023-03-06'),
(325, 'PR-06032023-1', '9', '2', '2', '0', '0', '10', '0', '2023-03-06'),
(326, 'PR-06032023-1', '8', '3', '0', '0', '0', '30', '0', '2023-03-06'),
(327, 'PR-06032023-2', '11', '3', '0', '0', '0', '10', '0', '2023-03-06'),
(328, 'PR-06032023-2', '10', '3', '0', '0', '0', '10', '0', '2023-03-06'),
(329, 'PR-06032023-2', '9', '3', '0', '0', '0', '10', '0', '2023-03-06'),
(330, 'PR-06032023-2', '8', '3', '0', '0', '0', '10', '0', '2023-03-06'),
(331, 'PR-06032023-3', '10', '2', '4', '0', '0', '10', '0', '2023-03-06'),
(332, 'PR-06032023-3', '9', '1', '10', '0', '0', '10', '0', '2023-03-06');

-- --------------------------------------------------------

--
-- Table structure for table `t_produk_barang`
--

CREATE TABLE `t_produk_barang` (
  `produk_barang_id` int(11) NOT NULL,
  `produk_barang_stok` text DEFAULT '0',
  `produk_barang_barang` text NOT NULL,
  `produk_barang_jenis` text NOT NULL,
  `produk_barang_warna` text NOT NULL,
  `produk_barang_hps` text DEFAULT '0',
  `produk_barang_harga` text DEFAULT '0',
  `produk_barang_tanggal` date NOT NULL DEFAULT curdate()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `t_produk_barang`
--

INSERT INTO `t_produk_barang` (`produk_barang_id`, `produk_barang_stok`, `produk_barang_barang`, `produk_barang_jenis`, `produk_barang_warna`, `produk_barang_hps`, `produk_barang_harga`, `produk_barang_tanggal`) VALUES
(258, '0', '10', '1', '11', '0', '0', '2023-02-24'),
(259, '0', '11', '2', '7', '0', '0', '2023-02-24'),
(260, '4', '8', '3', '0', '23750', '25000', '2023-02-24'),
(261, '0', '8', '1', '10', '0', '0', '2023-03-05'),
(262, '0', '9', '1', '10', '0', '0', '2023-03-05'),
(263, '8', '10', '3', '0', '23750', '25000', '2023-03-06'),
(264, '10', '11', '3', '0', '23750', '25000', '2023-03-06'),
(265, '8', '9', '3', '0', '23750', '25000', '2023-03-06');

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
  `warna_jenis` text NOT NULL,
  `warna_nama` text NOT NULL,
  `warna_keterangan` text NOT NULL,
  `warna_tanggal` date NOT NULL DEFAULT curdate(),
  `warna_hapus` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `t_warna`
--

INSERT INTO `t_warna` (`warna_id`, `warna_kode`, `warna_jenis`, `warna_nama`, `warna_keterangan`, `warna_tanggal`, `warna_hapus`) VALUES
(0, 'WR000', '3', 'Tanpa Warna', '-', '2023-02-18', 0),
(2, 'WR001', '2', 'Merah', '-', '2023-02-17', 0),
(3, 'WR002', '2', 'Hitam', '-', '2023-02-17', 0),
(4, 'WR004', '2', 'Hijau', '-', '2023-02-17', 0),
(5, 'WR006', '2', 'Kuning', '-', '2023-02-17', 0),
(6, 'WR007', '2', 'Biru', '-', '2023-02-17', 0),
(7, 'WR008', '2', 'Putih', '-', '2023-02-17', 0),
(10, 'WR008', '1', 'CA', '-', '2023-02-23', 0),
(11, 'WR009', '1', 'BR', '-', '2023-02-23', 0);

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
(1, 'JN001', 'Anodizing', 'Warna CA / BR', 0, '2023-01-04'),
(2, 'JN002', 'Powder Coating', 'Warna warni', 0, '2023-01-04'),
(3, 'JN003', 'MF', 'Tidak di warnai', 0, '2023-01-04');

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
  MODIFY `coa_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `t_coa_sub`
--
ALTER TABLE `t_coa_sub`
  MODIFY `coa_sub_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `t_jurnal`
--
ALTER TABLE `t_jurnal`
  MODIFY `jurnal_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=307;

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
  MODIFY `peleburan_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `t_peleburan_barang`
--
ALTER TABLE `t_peleburan_barang`
  MODIFY `peleburan_barang_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=153;

--
-- AUTO_INCREMENT for table `t_pembelian`
--
ALTER TABLE `t_pembelian`
  MODIFY `pembelian_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT for table `t_pembelian_barang`
--
ALTER TABLE `t_pembelian_barang`
  MODIFY `pembelian_barang_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=381;

--
-- AUTO_INCREMENT for table `t_pembelian_umum`
--
ALTER TABLE `t_pembelian_umum`
  MODIFY `pembelian_umum_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `t_pembelian_umum_barang`
--
ALTER TABLE `t_pembelian_umum_barang`
  MODIFY `pembelian_umum_barang_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `t_penjualan`
--
ALTER TABLE `t_penjualan`
  MODIFY `penjualan_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=97;

--
-- AUTO_INCREMENT for table `t_penjualan_barang`
--
ALTER TABLE `t_penjualan_barang`
  MODIFY `penjualan_barang_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=383;

--
-- AUTO_INCREMENT for table `t_penyesuaian`
--
ALTER TABLE `t_penyesuaian`
  MODIFY `penyesuaian_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `t_penyesuaian_barang`
--
ALTER TABLE `t_penyesuaian_barang`
  MODIFY `penyesuaian_barang_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `t_produk`
--
ALTER TABLE `t_produk`
  MODIFY `produk_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `t_produksi`
--
ALTER TABLE `t_produksi`
  MODIFY `produksi_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=94;

--
-- AUTO_INCREMENT for table `t_produksi_barang`
--
ALTER TABLE `t_produksi_barang`
  MODIFY `produksi_barang_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=333;

--
-- AUTO_INCREMENT for table `t_produk_barang`
--
ALTER TABLE `t_produk_barang`
  MODIFY `produk_barang_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=266;

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
  MODIFY `warna_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `t_warna_jenis`
--
ALTER TABLE `t_warna_jenis`
  MODIFY `warna_jenis_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
