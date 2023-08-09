-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Aug 09, 2023 at 07:03 AM
-- Server version: 10.5.21-MariaDB
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
(13, 'BH001', 'Avalan Siku', 0, '1', 'utama', '27000', '2023-06-13', 0),
(14, 'BH002', 'Avalan Kawat', 0, '1', 'utama', '31000', '2023-06-13', 0),
(15, 'BH003', 'Ceramic Filter', 20, '7', 'pembantu', '350000', '2023-06-13', 0),
(16, 'BH004', 'Magnesium Ingot 99%', 0, '1', 'pembantu', '0', '2023-06-13', 0),
(17, 'BH005', 'Nickel Sulphate', 0, '1', 'pembantu', '0', '2023-06-13', 0),
(18, 'BH006', 'Dross of Flux', 0, '1', 'pembantu', '0', '2023-07-03', 0),
(19, 'BH007', 'Refining Fluxes', 800, '1', 'pembantu', '9000', '2023-07-03', 0),
(20, 'BH008', 'Aluminium Ingot 99.7%', 7000, '1', 'utama', '34332', '2023-08-04', 0),
(21, 'BH009', 'Avalan Plat', 0, '1', 'utama', '21000', '2023-08-04', 0),
(22, 'BH0010', 'Oli Bekas', 4000, '1', 'pembantu', '4250', '2023-08-04', 0);

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
  `billet_hpp` text DEFAULT '9',
  `billet_hps` text DEFAULT '0',
  `billet_update` date NOT NULL DEFAULT curdate()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `t_billet`
--

INSERT INTO `t_billet` (`billet_id`, `billet_full`, `billet_min`, `billet_stok`, `billet_sisa`, `billet_hpp`, `billet_hps`, `billet_update`) VALUES
(1, '25522', '5900', '19622', '10', '824865000', '32319.763341430924', '2023-08-08');

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

--
-- Dumping data for table `t_cacat`
--

INSERT INTO `t_cacat` (`cacat_id`, `cacat_user`, `cacat_jumlah`, `cacat_tanggal`, `cacat_hapus`) VALUES
(2, 5, '10', '2023-07-22', 0),
(3, 5, '15', '2023-07-22', 0);

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `t_jurnal`
--

INSERT INTO `t_jurnal` (`jurnal_id`, `jurnal_nomor`, `jurnal_akun`, `jurnal_keterangan`, `jurnal_type`, `jurnal_nominal`, `jurnal_hapus`, `jurnal_tanggal`) VALUES
(309, 'PLB-16062023-1', '9', 'biaya peleburan', 'debit', '28100000', 1, '2023-06-16'),
(310, 'PLB-16062023-1', '5', 'stok billet', 'kredit', '28100000', 1, '2023-06-16'),
(311, 'PLB-30062023-2', '9', 'biaya peleburan', 'debit', '413100000', 1, '2023-06-30'),
(312, 'PLB-30062023-2', '5', 'stok billet', 'kredit', '413100000', 1, '2023-06-30'),
(313, 'PLB-04072023-3', '9', 'biaya peleburan', 'debit', '450002600', 0, '2023-07-04'),
(314, 'PLB-04072023-3', '5', 'stok billet', 'kredit', '450002600', 0, '2023-07-04'),
(315, 'PLB-21072023-1', '9', 'biaya peleburan', 'debit', '6255600', 1, '2023-07-21'),
(316, 'PLB-21072023-1', '5', 'stok billet', 'kredit', '6255600', 1, '2023-07-21'),
(317, 'PLB-21072023-1', '9', 'biaya peleburan', 'debit', '2910000', 1, '2023-07-21'),
(318, 'PLB-21072023-1', '5', 'stok billet', 'kredit', '2910000', 1, '2023-07-21'),
(319, 'PLB-04082023-2', '9', 'biaya peleburan', 'debit', '436600000', 1, '2023-08-04'),
(320, 'PLB-04082023-2', '5', 'stok billet', 'kredit', '436600000', 1, '2023-08-04'),
(321, 'PLB-05082023-3', '9', 'biaya peleburan', 'debit', '465514000', 0, '2023-08-05'),
(322, 'PLB-05082023-3', '5', 'stok billet', 'kredit', '465514000', 0, '2023-08-05'),
(323, 'PLB-05082023-4', '9', 'biaya peleburan', 'debit', '359351000', 0, '2023-08-05'),
(324, 'PLB-05082023-4', '5', 'stok billet', 'kredit', '359351000', 0, '2023-08-05');

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
(19, '', '', '', '', '', '', '', '', '', '2023-07-22', 0),
(20, 's', 'SP003', 'PT. Indonesia Asahan Aluminium', 'Surabaya Medan', '123123123', 'inalum.id', '1231231', '1', '13212312', '2023-08-04', 0),
(21, 's', 'SP004', 'Pak Bahar', 'Salodong', '123123123', 'bahar', '123123', '1', '123123123', '2023-08-04', 0);

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
(3, 'Kasir', '{\"nama\":\"Kasir\",\"menu_dashboard\":\"0\",\"menu_kontak\":\"0\",\"karyawan\":\"0\",\"karyawan_add\":\"0\",\"karyawan_del\":\"0\",\"supplier\":\"0\",\"supplier_add\":\"0\",\"supplier_del\":\"0\",\"pelanggan\":\"0\",\"pelanggan_add\":\"0\",\"pelanggan_del\":\"0\",\"rekening\":\"0\",\"rekening_add\":\"0\",\"rekening_del\":\"0\",\"menu_pembelian\":\"0\",\"bahan\":\"1\",\"bahan_add\":\"0\",\"bahan_del\":\"0\",\"bahan_po\":\"1\",\"bahan_po_add\":\"1\",\"bahan_po_del\":\"1\",\"pembelian_bahan\":\"1\",\"pembelian_bahan_add\":\"1\",\"pembelian_bahan_del\":\"1\",\"pembelian_umum\":\"1\",\"pembelian_umum_add\":\"1\",\"pembelian_umum_del\":\"1\",\"hutang\":\"1\",\"hutang_add\":\"1\",\"menu_produksi\":\"0\",\"mesin\":\"0\",\"mesin_add\":\"0\",\"mesin_del\":\"0\",\"peleburan\":\"0\",\"peleburan_add\":\"0\",\"peleburan_del\":\"0\",\"produksi\":\"0\",\"produksi_add\":\"0\",\"produksi_del\":\"0\",\"pewarnaan\":\"0\",\"pewarnaan_add\":\"0\",\"pewarnaan_del\":\"0\",\"packing\":\"0\",\"packing_add\":\"0\",\"packing_del\":\"0\",\"menu_produk\":\"0\",\"jenis_pewarnaan\":\"0\",\"jenis_pewarnaan_add\":\"0\",\"warna_produk\":\"0\",\"warna_produk_add\":\"0\",\"warna_produk_del\":\"0\",\"master_produk\":\"1\",\"master_produk_add\":\"0\",\"master_produk_del\":\"0\",\"menu_penjualan\":\"0\",\"penjualan_po\":\"1\",\"penjualan_po_add\":\"1\",\"penjualan_po_del\":\"1\",\"penjualan_produk\":\"1\",\"penjualan_produk_add\":\"1\",\"penjualan_produk_del\":\"1\",\"piutang\":\"1\",\"piutang_add\":\"1\",\"menu_keuangan\":\"0\",\"coa\":\"0\",\"coa_add\":\"0\",\"coa_del\":\"0\",\"kas\":\"0\",\"kas_add\":\"0\",\"kas_del\":\"0\",\"jurnal\":\"0\",\"jurnal_add\":\"0\",\"jurnal_del\":\"0\",\"buku_besar\":\"0\",\"buku_besar_add\":\"0\",\"buku_besar_del\":\"0\",\"penyesuaian\":\"0\",\"penyesuaian_add\":\"0\",\"penyesuaian_del\":\"0\",\"menu_laporan\":\"0\",\"laporan_bahan\":\"1\",\"laporan_produk\":\"1\",\"laporan_produksi\":\"0\",\"laporan_pembelian_po\":\"1\",\"laporan_pembelian\":\"1\",\"laporan_hutang\":\"1\",\"laporan_hutang_jatuh_tampo\":\"1\",\"laporan_penjualan\":\"1\",\"laporan_piutang\":\"1\",\"laporan_piutang_jatuh_tampo\":\"1\",\"laporan_packing\":\"0\",\"menu_inventori\":\"0\",\"opname_pembelian\":\"0\",\"opname_penjualan\":\"0\",\"penyesuaian_stok\":\"0\",\"penyesuaian_stok_add\":\"0\",\"penyesuaian_stok_del\":\"0\",\"menu_akun\":\"0\",\"akses\":\"0\",\"akses_add\":\"0\",\"akses_del\":\"0\",\"user_akun\":\"0\",\"user_akun_add\":\"0\",\"user_akun_del\":\"0\",\"admin_akun\":\"0\",\"admin_akun_add\":\"0\",\"admin_akun_del\":\"0\",\"menu_pengaturan\":\"0\",\"pajak\":\"0\",\"pajak_add\":\"0\",\"backup\":\"0\",\"informasi\":\"0\"}', '2023-06-01', 0);

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
(1, '3d00876ae06414f4347830ac266f84c4.png', 'RAJAWALI  ALUMUNIUM  PERKASA', '0411-4723184', 'Makassar', 'Jl. KIMA 16 Kav DD 7');

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

--
-- Dumping data for table `t_packing`
--

INSERT INTO `t_packing` (`packing_id`, `packing_nomor`, `packing_user`, `packing_tanggal`, `packing_hapus`) VALUES
(7, 'PC-04072023-4', '85', '2023-07-04', 1),
(8, 'PC-02082023-2', '85', '2023-08-02', 1),
(9, 'PC-04082023-3', '85', '2023-08-04', 1),
(10, 'PC-05082023-4', '85', '2023-08-05', 0);

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

--
-- Dumping data for table `t_packing_barang`
--

INSERT INTO `t_packing_barang` (`packing_barang_id`, `packing_barang_nomor`, `packing_barang_barang`, `packing_barang_stok`, `packing_barang_jenis`, `packing_barang_warna`, `packing_barang_qty`) VALUES
(11, 'PC-04072023-4', '17', '10', '2', '14', '10'),
(12, 'PC-02082023-2', '18', '100', '1', '12', '30'),
(13, 'PC-04082023-3', '19', '500', '1', '12', '500'),
(14, 'PC-05082023-4', '20', '2000', '2', '14', '1000'),
(15, 'PC-05082023-4', '18', '1000', '1', '13', '300'),
(16, 'PC-05082023-4', '17', '500', '1', '13', '240');

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
(22, 'PLB-21072023-1', '2023-07-21', '100', '10000', '50', '0', '2910000', 1),
(23, 'PLB-04082023-2', '2023-08-04', '15727', '3000000', '13200', '0', '436600000', 1),
(24, 'PLB-05082023-3', '2023-08-05', '19627', '2000000', '14000', '0', '465514000', 0),
(25, 'PLB-05082023-4', '2023-08-05', '14537', '1200000', '11522', '1368', '359351000', 0);

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
(164, 'PLB-21072023-1', '13', '11995', '100', '29000', '2900000', '2023-07-21'),
(165, 'PLB-04082023-2', '0', '25', '25', '0', '0', '2023-08-03'),
(166, 'PLB-04082023-2', '19', '500', '100', '10000', '1000000', '2023-08-03'),
(167, 'PLB-04082023-2', '16', '1000', '100', '60000', '6000000', '2023-08-03'),
(168, 'PLB-04082023-2', '15', '24', '2', '300000', '600000', '2023-08-03'),
(169, 'PLB-04082023-2', '14', '2950', '2500', '30000', '75000000', '2023-08-03'),
(170, 'PLB-04082023-2', '13', '14880', '13000', '27000', '351000000', '2023-08-03'),
(171, 'PLB-05082023-3', '19', '1000', '100', '9000', '900000', '2023-08-04'),
(172, 'PLB-05082023-3', '15', '24', '2', '350000', '700000', '2023-08-04'),
(173, 'PLB-05082023-3', '22', '10000', '3000', '4250', '12750000', '2023-08-04'),
(174, 'PLB-05082023-3', '21', '2980', '2500', '21000', '52500000', '2023-08-04'),
(175, 'PLB-05082023-3', '14', '4985', '1000', '31000', '31000000', '2023-08-04'),
(176, 'PLB-05082023-3', '13', '14970', '11000', '27000', '297000000', '2023-08-04'),
(177, 'PLB-05082023-3', '20', '12000', '2000', '34332', '68664000', '2023-08-04'),
(178, 'PLB-05082023-3', '0', '25', '25', '0', '0', '2023-08-04'),
(179, 'PLB-05082023-4', '22', '7000', '3000', '4250', '12750000', '2023-08-04'),
(180, 'PLB-05082023-4', '19', '900', '100', '9000', '900000', '2023-08-04'),
(181, 'PLB-05082023-4', '20', '10000', '3000', '34332', '102996000', '2023-08-04'),
(182, 'PLB-05082023-4', '21', '480', '480', '21000', '10080000', '2023-08-04'),
(183, 'PLB-05082023-4', '15', '22', '2', '350000', '700000', '2023-08-04'),
(184, 'PLB-05082023-4', '14', '3985', '3985', '31000', '123535000', '2023-08-04'),
(185, 'PLB-05082023-4', '13', '3970', '3970', '27000', '107190000', '2023-08-04');

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
(80, '85', 0, '', 'PB-04072023-13', '16', '2023-07-04', '2023-07-18', 'belum', '1', NULL, '', 'tunai', '', '', '15000', '0', '443535000', 1),
(81, '85', 0, '2023-07-04', 'PB-04072023-14', '18', '2023-07-04', '2023-07-18', 'lunas', '1', '2023-07-23', 'test', 'tunai', '', '', '1024', '11', '17994432', 1),
(82, '85', 0, '', 'PB-04082023-3', '16', '2023-08-04', '2023-08-04', 'belum', '1', NULL, '', 'tunai', '', '', '18000', '0', '490260000', 1),
(83, '85', 0, '', 'PB-04082023-4', '18', '2023-08-04', '2023-08-04', 'belum', '1', NULL, '', 'tunai', '', '', '1524', '11', '80142000', 1),
(84, '85', 0, '', 'PB-05082023-5', '20', '2023-08-05', '2023-08-05', 'lunas', '1', '2023-08-05', 'Lunas', 'tunai', '', '', '12000', '11', '457302240', 0),
(85, '85', 0, '', 'PB-05082023-6', '16', '2023-08-05', '2023-08-19', 'lunas', '1', '2023-08-07', 'kkk', 'tunai', '', '', '23000', '0', '621305000', 0),
(86, '85', 0, '', 'PB-05082023-7', '21', '2023-08-05', '2023-08-19', 'belum', '1', NULL, '', 'tunai', '', '', '10000', '0', '42500000', 0),
(87, '85', 0, '', 'PB-05082023-8', '18', '2023-08-05', '2023-09-05', 'belum', '1', NULL, '', 'tunai', '', '', '1024', '11', '19314000', 0);

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
(405, 'PB-04072023-13', '14', '0', '3000', '10', '32000', '95680000'),
(406, 'PB-04072023-13', '13', '0', '12000', '5', '29000', '347855000'),
(410, 'PB-04072023-14', '15', '0', '24', '0', '283800', '6811200'),
(411, 'PB-04072023-14', '19', '0', '500', '0', '9400', '4700000'),
(412, 'PB-04072023-14', '18', '0', '500', '0', '9400', '4700000'),
(413, 'PB-04082023-3', '14', '0', '3000', '50', '30000', '88500000'),
(414, 'PB-04082023-3', '13', '0', '15000', '120', '27000', '401760000'),
(415, 'PB-04082023-4', '16', '0', '1000', '0', '60000', '60000000'),
(416, 'PB-04082023-4', '19', '0', '500', '0', '10000', '5000000'),
(417, 'PB-04082023-4', '15', '0', '24', '0', '300000', '7200000'),
(418, 'PB-05082023-5', '20', '0', '12000', '0', '34332', '411984000'),
(419, 'PB-05082023-6', '21', '0', '3000', '20', '21000', '62580000'),
(420, 'PB-05082023-6', '13', '0', '15000', '30', '27000', '404190000'),
(421, 'PB-05082023-6', '14', '0', '5000', '15', '31000', '154535000'),
(422, 'PB-05082023-7', '22', '0', '10000', '0', '4250', '42500000'),
(423, 'PB-05082023-8', '19', '0', '1000', '0', '9000', '9000000'),
(424, 'PB-05082023-8', '15', '0', '24', '0', '350000', '8400000');

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
(14, '85', 'PU-04072023-3', '2023-07-04', '2023-07-18', 'lunas', '1', '2023-07-24', '-', 'tunai', '', '', '1', '0', '10000000', 1),
(15, '85', 'PU-07082023-2', '2023-08-07', '2023-08-07', 'lunas', '1', '2023-08-07', 'asd', 'tunai', '', '', '2', '0', '2000000', 0);

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
(35, 'PU-04072023-3', 'Ongkos Perbaikan Dinamo', '1', '0', '10000000', '10000000'),
(36, 'PU-07082023-2', 'Ongkos Perbaikan Dinamo', '2', '0', '1000000', '2000000');

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

--
-- Dumping data for table `t_penjualan`
--

INSERT INTO `t_penjualan` (`penjualan_id`, `penjualan_po`, `penjualan_nomor`, `penjualan_pelanggan`, `penjualan_tanggal`, `penjualan_jatuh_tempo`, `penjualan_pembayaran`, `penjualan_keterangan`, `penjualan_lampiran`, `penjualan_qty_akhir`, `penjualan_ppn`, `penjualan_total`, `penjualan_piutang`, `penjualan_status`, `penjualan_pelunasan`, `penjualan_pelunasan_jumlah`, `penjualan_pelunasan_keterangan`, `penjualan_hapus`) VALUES
(104, 0, 'PJ-23072023-1', '17', '2023-07-23', '2023-07-23', 'tunai', '-', '', '10', '0', 2000000, '1', 'belum', '2023-07-23', 1000000, '-', 1),
(105, 0, 'PJ-23072023-2', '17', '2023-07-23', '2023-07-24', 'tunai', '-', '', '10', '0', 10000000, '1', 'lunas', '2023-07-23', 50000000, '-', 1),
(106, 0, 'PJ-04082023-3', '17', '2023-08-04', '2023-08-11', 'tunai', '', '', '500', '11', -111000000, '1', 'belum', NULL, 0, NULL, 1),
(107, 0, 'PJ-05082023-4', '17', '2023-08-05', '2023-08-12', 'tunai', '', '', '500', '11', -184260000, '1', 'belum', NULL, 0, NULL, 1),
(108, 0, 'PJ-08082023-5', '17', '2023-08-08', '2023-08-22', 'tunai', '', '', '200', '11', -75480000, '1', 'belum', NULL, 0, NULL, 0),
(109, 0, 'PJ-08082023-6', '17', '2023-08-08', '2023-08-22', 'tunai', '', '', '300', '11', 0, '1', 'belum', NULL, 0, NULL, 0);

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

--
-- Dumping data for table `t_penjualan_barang`
--

INSERT INTO `t_penjualan_barang` (`penjualan_barang_id`, `penjualan_barang_nomor`, `penjualan_barang_barang`, `penjualan_barang_jenis`, `penjualan_barang_warna`, `penjualan_barang_stok`, `penjualan_barang_qty`, `penjualan_barang_potongan`, `penjualan_barang_harga`, `penjualan_barang_hps`, `penjualan_barang_subtotal`) VALUES
(394, 'PJ-23072023-1', '15', '1', '12', '1000', '10', '0', '200000', '0', '2000000'),
(395, 'PJ-23072023-2', '17', '1', '13', '490', '10', '0', '1000000', '111484.032', '10000000'),
(396, 'PJ-04082023-3', '19', '1', '12', '500', '500', '0', '50000', '32749', '-100000000'),
(397, 'PJ-05082023-4', '17', '1', '13', '500', '500', '0', '83000', '111484.032', '-166000000'),
(398, 'PJ-08082023-5', '17', '1', '13', '500', '200', '0', '85000', '111484.032', '-68000000'),
(399, 'PJ-08082023-6', '17', '1', '13', '300', '300', '0', '0', '111484.032', '0');

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
(27, 'PN-03072023-1', 'penjualan', 'keluar', 'rusak', '', '2023-07-03', 1);

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
(40, 'PN-03072023-1', '17', '3', '0', '100', '100', '0', 'berkurang');

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

--
-- Dumping data for table `t_pewarnaan`
--

INSERT INTO `t_pewarnaan` (`pewarnaan_id`, `pewarnaan_nomor`, `pewarnaan_user`, `pewarnaan_tanggal`, `pewarnaan_hapus`) VALUES
(51, 'PW-02082023-1', '85', '2023-08-02', 1),
(52, 'PW-02082023-2', '85', '2023-08-02', 1),
(53, 'PW-04082023-3', '85', '2023-08-04', 1),
(54, 'PW-05082023-4', '85', '2023-08-05', 0);

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

--
-- Dumping data for table `t_pewarnaan_barang`
--

INSERT INTO `t_pewarnaan_barang` (`pewarnaan_barang_id`, `pewarnaan_barang_nomor`, `pewarnaan_barang_barang`, `pewarnaan_barang_stok`, `pewarnaan_barang_jenis`, `pewarnaan_barang_warna`, `pewarnaan_barang_qty`) VALUES
(77, 'PW-02082023-1', '18', '300', '1', '12', '100'),
(78, 'PW-02082023-2', '18', '200', '2', '14', '50'),
(79, 'PW-04082023-3', '19', '2000', '1', '12', '500'),
(80, 'PW-05082023-4', '20', '2000', '2', '14', '2000'),
(81, 'PW-05082023-4', '18', '1000', '1', '13', '1000'),
(82, 'PW-05082023-4', '17', '500', '1', '13', '500');

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
(15, 'RAP-HLLW-2020S-050', 'HOLLOW 20 X 20 KOTAK 0.50', '8', 'RAJAWALI', '0.50', '6000', '20', '', 'ALUMINIUM', '50', '2023-06-13', '2023-06-13', 0),
(16, 'RAP-HLLW-2020-050', 'HOLLOW 20 X 20 OVAL 0.50', '8', 'RAJAWALI', '0.50', '6000', '2', '', 'Aluminium', '50', '2023-06-13', '2023-06-13', 0),
(17, 'SHPE-20202-A', 'OPENBACK SAKURA', '8', 'RAJAWALI', '0.5', '600', '0', '', 'Sakura', '12', '2023-06-29', '2023-06-29', 0),
(18, '73711060600', 'TIANG 3.5 (F) 0.60 6 MTR', '7', 'RAJAWALI', '0.60', '600', '3', '', 'ALUMINIUM', '30', '2023-08-01', '2023-08-01', 0),
(19, '71042070;600', 'HOLLOW ENGKEL (B.B.K)', '8', 'RAJAWALI', '0.70', '600', '22', '', 'ENGKEL', '30', '2023-08-03', '2023-08-03', 0),
(20, '888123812', 'SPANDREL 93MM 6 MTR', '8', 'RAJAWALI', '0.50', '600', '9', '', 'spandrel', '20', '2023-08-04', '2023-08-04', 0);

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

--
-- Dumping data for table `t_produksi`
--

INSERT INTO `t_produksi` (`produksi_id`, `produksi_nomor`, `produksi_tanggal`, `produksi_shift`, `produksi_pekerja`, `produksi_keterangan`, `produksi_mesin`, `produksi_lampiran_1`, `produksi_lampiran_2`, `produksi_barang_qty`, `produksi_total_produksi`, `produksi_billet_hps`, `produksi_billet_qty`, `produksi_jasa`, `produksi_total_akhir`, `produksi_billet_sisa`, `produksi_hapus`) VALUES
(117, 'PR-21072023-1', '2023-07-21', '78', '[\"6\"]', '-', '5', NULL, NULL, '10', '9.16', '58200', '10', '2000', '584000', '0', 1),
(118, 'PR-23072023-2', '2023-07-23', '78', '[\"6\",\"7\"]', '-', '5', NULL, NULL, '100', '2000', '58200', '10', '20000', '602000', '0', 1),
(119, 'PR-02082023-3', '2023-08-02', '78', '[\"6\"]', '', '5', NULL, NULL, '300', '267.6', '58200', '0', '0', '0', '0', 1),
(120, 'PR-04082023-4', '2023-08-04', '78', '[\"6\"]', '', '5', NULL, NULL, '2000', '1364', '33076', '1950', '1000000', '65498200', '586', 1),
(121, 'PR-05082023-5', '2023-08-05', '78', '[\"6\"]', '', '5', NULL, NULL, '3500', '3281.5', '33251', '4650', '1200000', '155817150', '1368', 0),
(122, 'PR-05082023-6', '2023-08-05', '78', '[\"7\"]', '', '5', NULL, NULL, '1000', '1222', '32320', '1250', '1000000', '41400000', '10', 0);

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

--
-- Dumping data for table `t_produksi_barang`
--

INSERT INTO `t_produksi_barang` (`produksi_barang_id`, `produksi_barang_nomor`, `produksi_barang_matras`, `produksi_barang_barang`, `produksi_barang_stok`, `produksi_barang_berat`, `produksi_barang_qty`, `produksi_barang_subtotal`, `produksi_barang_tanggal`) VALUES
(375, 'PR-21072023-1', '91102-A', '15', '0', '0.916', '10', '9.16', '2023-07-21'),
(376, 'PR-23072023-2', '91102-A', '15', '0', '20', '100', '2000', '2023-07-23'),
(377, 'PR-02082023-3', '22213', '18', '0', '0.892', '300', '267.6', '2023-08-01'),
(378, 'PR-04082023-4', '771121', '19', '0', '0.682', '2000', '1364', '2023-08-03'),
(379, 'PR-05082023-5', '22123', '20', '0', '0.872', '2000', '1744', '2023-08-04'),
(380, 'PR-05082023-5', '22123', '18', '0', '0.925', '1000', '925', '2023-08-04'),
(381, 'PR-05082023-5', '22123', '17', '0', '1.225', '500', '612.5', '2023-08-04'),
(382, 'PR-05082023-6', '22213', '17', '0', '1.222', '1000', '1222', '2023-08-04');

-- --------------------------------------------------------

--
-- Table structure for table `t_produk_barang`
--

CREATE TABLE `t_produk_barang` (
  `produk_barang_id` int(11) NOT NULL,
  `produk_barang_barang` text NOT NULL,
  `produk_barang_stok` text DEFAULT '0',
  `produk_barang_packing` text DEFAULT '0',
  `produk_barang_jenis` text NOT NULL,
  `produk_barang_warna` text NOT NULL,
  `produk_barang_hps` text DEFAULT '0',
  `produk_barang_harga` text DEFAULT '0',
  `produk_barang_tanggal` date NOT NULL DEFAULT curdate()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `t_produk_barang`
--

INSERT INTO `t_produk_barang` (`produk_barang_id`, `produk_barang_barang`, `produk_barang_stok`, `produk_barang_packing`, `produk_barang_jenis`, `produk_barang_warna`, `produk_barang_hps`, `produk_barang_harga`, `produk_barang_tanggal`) VALUES
(293, '15', '0', '0', '3', '0', '6020', '0', '2023-06-14'),
(294, '16', '0', '0', '3', '0', '46451.68', '30000', '2023-06-14'),
(295, '15', '0', '50', '1', '12', '0', '0', '2023-06-14'),
(296, '16', '0', '500', '1', '13', '0', '31500', '2023-06-14'),
(297, '16', '0', '800', '1', '12', '0', '0', '2023-06-15'),
(298, '15', '0', '0', '2', '14', '0', '0', '2023-06-15'),
(299, '16', '0', '0', '2', '14', '0', '0', '2023-06-15'),
(300, '17', '1000', '0', '3', '0', '103878', '0', '2023-06-29'),
(301, '17', '0', '500', '1', '12', '37663.75', '0', '2023-06-29'),
(302, '17', '0', '10', '2', '14', '37663.75', '0', '2023-06-29'),
(303, '17', '0', '240', '1', '13', '111484.032', '0', '2023-07-03'),
(304, '18', '0', '0', '3', '0', '155817', '0', '2023-08-01'),
(305, '18', '0', '30', '1', '12', '0', '0', '2023-08-01'),
(306, '18', '0', '0', '2', '14', '0', '0', '2023-08-01'),
(307, '19', '0', '0', '3', '0', '32749', '0', '2023-08-03'),
(308, '19', '0', '500', '1', '12', '32749', '0', '2023-08-03'),
(309, '20', '0', '0', '3', '0', '77909', '0', '2023-08-04'),
(310, '18', '1000', '300', '1', '13', '155817', '0', '2023-08-04'),
(311, '20', '2000', '1000', '2', '14', '77909', '0', '2023-08-04');

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
(8, 'Batang', 'Btg', '2023-04-14', 0);

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
(78, 'siskaeee@gmail.com', 'afa0b885505255964c06188e2b4e8f59', 'Siska Elisa', NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, NULL, '2022-12-04', 0),
(84, 'kasir@gmail.com', 'c7911af3adbd12a035b289556d96470a', 'Kasir JTM', NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, NULL, '2023-06-02', 0),
(85, 'mulyono.tunardy@gmail.com', '50909b16941c62e390316294ac9965d5', 'Mul', NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, '2023-06-12', 0);

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
(0, 'WR000', '3', 'Tanpa Warna', '-', '2023-02-18', 0),
(12, 'WR002', '1', 'CA', 'Clear Anodized', '2023-06-14', 0),
(13, 'WR003', '1', 'BR', 'Brown', '2023-06-14', 0),
(14, 'WR004', '2', 'ARTIC WHITE', 'PC Artic', '2023-06-14', 0);

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
-- AUTO_INCREMENT for table `t_bahan`
--
ALTER TABLE `t_bahan`
  MODIFY `bahan_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

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
  MODIFY `jurnal_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=325;

--
-- AUTO_INCREMENT for table `t_karyawan`
--
ALTER TABLE `t_karyawan`
  MODIFY `karyawan_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `t_kontak`
--
ALTER TABLE `t_kontak`
  MODIFY `kontak_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `t_level`
--
ALTER TABLE `t_level`
  MODIFY `level_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

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
  MODIFY `packing_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `t_packing_barang`
--
ALTER TABLE `t_packing_barang`
  MODIFY `packing_barang_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `t_pajak`
--
ALTER TABLE `t_pajak`
  MODIFY `pajak_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `t_peleburan`
--
ALTER TABLE `t_peleburan`
  MODIFY `peleburan_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `t_peleburan_barang`
--
ALTER TABLE `t_peleburan_barang`
  MODIFY `peleburan_barang_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=186;

--
-- AUTO_INCREMENT for table `t_pembelian`
--
ALTER TABLE `t_pembelian`
  MODIFY `pembelian_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=88;

--
-- AUTO_INCREMENT for table `t_pembelian_barang`
--
ALTER TABLE `t_pembelian_barang`
  MODIFY `pembelian_barang_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=425;

--
-- AUTO_INCREMENT for table `t_pembelian_umum`
--
ALTER TABLE `t_pembelian_umum`
  MODIFY `pembelian_umum_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `t_pembelian_umum_barang`
--
ALTER TABLE `t_pembelian_umum_barang`
  MODIFY `pembelian_umum_barang_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `t_penjualan`
--
ALTER TABLE `t_penjualan`
  MODIFY `penjualan_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=110;

--
-- AUTO_INCREMENT for table `t_penjualan_barang`
--
ALTER TABLE `t_penjualan_barang`
  MODIFY `penjualan_barang_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=400;

--
-- AUTO_INCREMENT for table `t_penyesuaian`
--
ALTER TABLE `t_penyesuaian`
  MODIFY `penyesuaian_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `t_penyesuaian_barang`
--
ALTER TABLE `t_penyesuaian_barang`
  MODIFY `penyesuaian_barang_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `t_pewarnaan`
--
ALTER TABLE `t_pewarnaan`
  MODIFY `pewarnaan_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT for table `t_pewarnaan_barang`
--
ALTER TABLE `t_pewarnaan_barang`
  MODIFY `pewarnaan_barang_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=83;

--
-- AUTO_INCREMENT for table `t_produk`
--
ALTER TABLE `t_produk`
  MODIFY `produk_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `t_produksi`
--
ALTER TABLE `t_produksi`
  MODIFY `produksi_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=123;

--
-- AUTO_INCREMENT for table `t_produksi_barang`
--
ALTER TABLE `t_produksi_barang`
  MODIFY `produksi_barang_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=383;

--
-- AUTO_INCREMENT for table `t_produk_barang`
--
ALTER TABLE `t_produk_barang`
  MODIFY `produk_barang_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=312;

--
-- AUTO_INCREMENT for table `t_rekening`
--
ALTER TABLE `t_rekening`
  MODIFY `rekening_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `t_satuan`
--
ALTER TABLE `t_satuan`
  MODIFY `satuan_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `t_user`
--
ALTER TABLE `t_user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=86;

--
-- AUTO_INCREMENT for table `t_warna`
--
ALTER TABLE `t_warna`
  MODIFY `warna_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `t_warna_jenis`
--
ALTER TABLE `t_warna_jenis`
  MODIFY `warna_jenis_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
