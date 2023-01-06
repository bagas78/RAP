-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 06, 2023 at 07:45 AM
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
  `bahan_nama` text NOT NULL,
  `bahan_stok` float NOT NULL DEFAULT 0,
  `bahan_satuan` text NOT NULL,
  `bahan_kategori` set('avalan','utama','pembantu') NOT NULL,
  `bahan_harga` text NOT NULL,
  `bahan_tanggal` date NOT NULL DEFAULT curdate(),
  `bahan_hapus` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `t_bahan`
--

INSERT INTO `t_bahan` (`bahan_id`, `bahan_nama`, `bahan_stok`, `bahan_satuan`, `bahan_kategori`, `bahan_harga`, `bahan_tanggal`, `bahan_hapus`) VALUES
(1, 'Kawat las', 64, '1', 'pembantu', '2500', '2022-12-05', 0),
(2, 'Velg sepeda', 165, '1', 'avalan', '5000', '2022-12-05', 0),
(3, 'Paku', 598, '1', 'avalan', '3000', '2022-12-05', 0),
(4, 'Plat kapal', -27, '1', 'utama', '55000', '2022-12-05', 0),
(5, 'Rel kereta', 2, '1', 'utama', '30000', '2022-12-05', 0),
(6, 'Rangka Motor', 30, '1', 'avalan', '30000', '2022-12-11', 0),
(7, 'Kawat Jemuran', 100, '1', 'pembantu', '3000', '2022-12-18', 0),
(8, 'Paku Bekas', 120, '1', 'pembantu', '1200', '2022-12-18', 0),
(9, 'Matras', 1000, '1', 'pembantu', '10000', '2022-12-21', 0);

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
  `billet_stok` text NOT NULL,
  `billet_hpp` text NOT NULL,
  `billet_update` date NOT NULL DEFAULT curdate()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `t_billet`
--

INSERT INTO `t_billet` (`billet_id`, `billet_stok`, `billet_hpp`, `billet_update`) VALUES
(1, '5', '2849.4', '2023-01-06');

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
(15, 'p', 'PL001', 'Sri Kanda', 'Alamat', '085855011542', 'sri78@gmail.com', '73898298320', '2', '-', '2022-12-02', 0);

-- --------------------------------------------------------

--
-- Table structure for table `t_logo`
--

CREATE TABLE `t_logo` (
  `logo_id` int(11) NOT NULL,
  `logo_foto` text NOT NULL,
  `logo_nama` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `t_logo`
--

INSERT INTO `t_logo` (`logo_id`, `logo_foto`, `logo_nama`) VALUES
(1, '3d00876ae06414f4347830ac266f84c4.png', 'RAJAWALI  ALUMUNIUM  PERKASA');

-- --------------------------------------------------------

--
-- Table structure for table `t_master_produk`
--

CREATE TABLE `t_master_produk` (
  `master_produk_id` int(11) NOT NULL,
  `master_produk_nomor` text NOT NULL,
  `master_produk_nama` text NOT NULL,
  `master_produk_stok` text NOT NULL DEFAULT '0',
  `master_produk_pewarnaan` text NOT NULL,
  `master_produk_harga` text NOT NULL,
  `master_produk_satuan` text NOT NULL,
  `master_produk_merk` text NOT NULL,
  `master_produk_ketebalan` text NOT NULL,
  `master_produk_panjang` text NOT NULL,
  `master_produk_lebar` text NOT NULL,
  `master_produk_berat` text NOT NULL,
  `master_produk_keterangan` text NOT NULL,
  `master_produk_hpp` text NOT NULL,
  `master_produk_hpp_total` text NOT NULL,
  `master_produk_update` date NOT NULL DEFAULT curdate(),
  `master_produk_tanggal` date NOT NULL DEFAULT curdate(),
  `master_produk_hapus` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `t_master_produk`
--

INSERT INTO `t_master_produk` (`master_produk_id`, `master_produk_nomor`, `master_produk_nama`, `master_produk_stok`, `master_produk_pewarnaan`, `master_produk_harga`, `master_produk_satuan`, `master_produk_merk`, `master_produk_ketebalan`, `master_produk_panjang`, `master_produk_lebar`, `master_produk_berat`, `master_produk_keterangan`, `master_produk_hpp`, `master_produk_hpp_total`, `master_produk_update`, `master_produk_tanggal`, `master_produk_hapus`) VALUES
(1, 'MP-06012023-1', 'Hollow 21 X 21 Kotak', '2', '1', '10000', '7', 'original', '18', '21', '21', '12', '-', '363', '726', '2023-01-04', '2023-01-04', 0),
(2, 'MP-06012023-2', 'Hollow 21 x 21 Oval', '0', '1', '20000', '7', 'original', '5', '21', '21', '5', '-', '', '', '2023-01-04', '2023-01-04', 0),
(3, 'MP-06012023-3', 'Hollow 22 x 34', '3', '2', '30000', '7', 'original', '3', '22', '34', '5', '-', '363', '1089', '2023-01-04', '2023-01-04', 0),
(4, 'MP-06012023-4', ' Openback 3', '0', '2', '40000', '7', 'original', '10', '5', '5', '10', '-', '', '', '2023-01-04', '2023-01-04', 0);

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
  `peleburan_qty_akhir` text NOT NULL,
  `peleburan_jasa` text NOT NULL,
  `peleburan_billet` text NOT NULL,
  `peleburan_biaya` text NOT NULL,
  `peleburan_hpp` text NOT NULL,
  `peleburan_hapus` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `t_peleburan`
--

INSERT INTO `t_peleburan` (`peleburan_id`, `peleburan_nomor`, `peleburan_tanggal`, `peleburan_qty_akhir`, `peleburan_jasa`, `peleburan_billet`, `peleburan_biaya`, `peleburan_hpp`, `peleburan_hapus`) VALUES
(10, 'PLB-19122022-1', '2022-12-19', '20', '10000', '10', '85000', '8500', 0),
(11, 'PLB-19122022-2', '2022-12-19', '30', '1200', '15', '86200', '5747', 0);

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
(39, 'PLB-19122022-1', '2', '10', '5000', '50000', '2022-12-19'),
(40, 'PLB-19122022-1', '1', '10', '2500', '25000', '2022-12-19'),
(41, 'PLB-19122022-2', '3', '10', '3000', '30000', '2022-12-19'),
(42, 'PLB-19122022-2', '7', '10', '3000', '30000', '2022-12-19'),
(43, 'PLB-19122022-2', '1', '10', '2500', '25000', '2022-12-19');

-- --------------------------------------------------------

--
-- Table structure for table `t_pembelian`
--

CREATE TABLE `t_pembelian` (
  `pembelian_id` int(11) NOT NULL,
  `pembelian_kategori` set('avalan','utama','umum') NOT NULL,
  `pembelian_po` int(11) NOT NULL DEFAULT 0,
  `pembelian_nomor` text NOT NULL,
  `pembelian_supplier` text NOT NULL,
  `pembelian_tanggal` date NOT NULL,
  `pembelian_jatuh_tempo` date NOT NULL,
  `pembelian_status` set('l','b') NOT NULL,
  `pembelian_keterangan` text NOT NULL,
  `pembelian_lampiran` text NOT NULL,
  `pembelian_qty_akhir` text NOT NULL,
  `pembelian_ppn` text NOT NULL,
  `pembelian_total` text NOT NULL,
  `pembelian_hapus` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `t_pembelian`
--

INSERT INTO `t_pembelian` (`pembelian_id`, `pembelian_kategori`, `pembelian_po`, `pembelian_nomor`, `pembelian_supplier`, `pembelian_tanggal`, `pembelian_jatuh_tempo`, `pembelian_status`, `pembelian_keterangan`, `pembelian_lampiran`, `pembelian_qty_akhir`, `pembelian_ppn`, `pembelian_total`, `pembelian_hapus`) VALUES
(32, 'avalan', 0, 'PA-11122022-1', '1', '2022-12-11', '2022-12-11', 'l', 'Transaksi ke 1', '', '130', '0', '425000', 0),
(33, 'avalan', 0, 'PA-11122022-2', '4', '2022-12-11', '2022-12-11', 'l', 'Transaksi ke 2', 'd9aed766c73c96bf5610fb642049a963.png', '70', '0', '225000', 0),
(34, 'avalan', 0, 'PA-11122022-3', '1', '2022-12-11', '2022-12-11', 'l', 'Transaksi ke 3', '', '600', '0', '2000000', 0),
(35, 'utama', 0, 'PB-11122022-1', '1', '2022-12-11', '2022-12-11', 'b', 'Transaksi ke 1', '', '5', '11', '249750', 0),
(37, 'umum', 0, 'PU-18122022-1', '1', '2022-12-18', '2022-12-18', 'l', 'umum 1', '', '220', '0', '444000', 0),
(38, 'avalan', 0, 'PA-18122022-4', '1', '2022-12-18', '2022-12-18', 'l', '', '', '10', '0', '50000', 0),
(39, 'avalan', 0, 'PA-18122022-5', '1', '2022-12-18', '2022-12-18', 'l', '', '', '10', '0', '300000', 0),
(40, 'avalan', 0, 'PA-18122022-6', '1', '2022-12-18', '2022-12-18', 'l', '', '', '10', '0', '300000', 0),
(41, 'avalan', 0, 'PA-18122022-7', '4', '2022-12-18', '2022-12-18', 'l', '', '', '10', '0', '300000', 0),
(42, 'umum', 0, 'PU-19122022-2', '4', '2022-12-19', '2022-12-19', 'l', '', '', '15', '0', '42500', 0),
(45, 'umum', 0, 'PU-19122022-3', '4', '2022-12-19', '2022-12-19', 'l', '', '', '10', '0', '37500', 0),
(46, 'umum', 0, 'PU-21122022-4', '4', '2022-12-21', '2022-12-21', 'l', 'matras', '', '1000', '0', '10000000', 0),
(47, 'avalan', 0, 'PA-28122022-8', '1', '2022-12-28', '2022-12-28', 'l', '-', '', '5', '0', '25,000', 0),
(48, 'avalan', 1, 'PA-03012023-9', '1', '2023-01-03', '2023-01-03', 'l', '-', '99459b1f4bf53b1d7cfafbb8a291f000.png', '10', '0', '50,000', 0);

-- --------------------------------------------------------

--
-- Table structure for table `t_pembelian_barang`
--

CREATE TABLE `t_pembelian_barang` (
  `pembelian_barang_id` int(11) NOT NULL,
  `pembelian_barang_nomor` text NOT NULL,
  `pembelian_barang_barang` text NOT NULL,
  `pembelian_barang_qty` text NOT NULL,
  `pembelian_barang_potongan` text NOT NULL,
  `pembelian_barang_harga` text NOT NULL,
  `pembelian_barang_subtotal` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `t_pembelian_barang`
--

INSERT INTO `t_pembelian_barang` (`pembelian_barang_id`, `pembelian_barang_nomor`, `pembelian_barang_barang`, `pembelian_barang_qty`, `pembelian_barang_potongan`, `pembelian_barang_harga`, `pembelian_barang_subtotal`) VALUES
(182, 'PB-11122022-1', '4', '3', '0', '55000', '165000'),
(183, 'PB-11122022-1', '5', '2', '0', '30000', '60000'),
(191, 'PA-11122022-2', '1', '50', '0', '2500', '125000'),
(192, 'PA-11122022-2', '2', '20', '0', '5000', '100000'),
(193, 'PA-11122022-1', '3', '100', '0', '3000', '300000'),
(194, 'PA-11122022-1', '1', '10', '0', '2500', '25000'),
(195, 'PA-11122022-1', '2', '20', '0', '5000', '100000'),
(206, 'PA-11122022-3', '2', '100', '0', '5000', '500000'),
(207, 'PA-11122022-3', '3', '500', '0', '3000', '1500000'),
(212, 'PA-18122022-4', '2', '10', '0', '5000', '50000'),
(213, 'PA-18122022-5', '6', '10', '0', '30000', '300000'),
(215, 'PA-18122022-6', '6', '10', '0', '30000', '300000'),
(216, 'PA-18122022-7', '6', '10', '0', '30000', '300000'),
(217, 'PU-18122022-1', '7', '100', '0', '3000', '300000'),
(218, 'PU-18122022-1', '8', '120', '0', '1200', '144000'),
(219, 'PU-19122022-2', '7', '10', '0', '3000', '30000'),
(220, 'PU-19122022-2', '1', '5', '0', '2500', '12500'),
(223, 'PU-19122022-3', '1', '5', '0', '2500', '12500'),
(224, 'PU-19122022-3', '2', '5', '0', '5000', '25000'),
(225, 'PU-21122022-4', '9', '1000', '0', '10000', '10000000'),
(227, 'PA-28122022-8', '2', '5', '0', '5,000', '25,000'),
(229, 'PA-03012023-9', '2', '10', '0', '5,000', '50,000');

-- --------------------------------------------------------

--
-- Table structure for table `t_pewarnaan`
--

CREATE TABLE `t_pewarnaan` (
  `pewarnaan_id` int(11) NOT NULL,
  `pewarnaan_nomor` text NOT NULL,
  `pewarnaan_jumlah` text NOT NULL,
  `pewarnaan_produk` text NOT NULL,
  `pewarnaan_hpp` text NOT NULL,
  `pewarnaan_hpp_total` text NOT NULL,
  `pewarnaan_jenis` text NOT NULL,
  `pewarnaan_tanggal` date NOT NULL DEFAULT curdate(),
  `pewarnaan_hapus` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `t_pewarnaan`
--

INSERT INTO `t_pewarnaan` (`pewarnaan_id`, `pewarnaan_nomor`, `pewarnaan_jumlah`, `pewarnaan_produk`, `pewarnaan_hpp`, `pewarnaan_hpp_total`, `pewarnaan_jenis`, `pewarnaan_tanggal`, `pewarnaan_hapus`) VALUES
(22, 'PWR-06012023-1', '2', '1', '363', '726', '1', '2023-01-06', 0),
(23, 'PWR-06012023-2', '3', '3', '363', '1089', '2', '2023-01-06', 0);

-- --------------------------------------------------------

--
-- Table structure for table `t_pewarnaan_jenis`
--

CREATE TABLE `t_pewarnaan_jenis` (
  `pewarnaan_jenis_id` int(11) NOT NULL,
  `pewarnaan_jenis_type` text NOT NULL,
  `pewarnaan_jenis_tanggal` date NOT NULL DEFAULT curdate()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `t_pewarnaan_jenis`
--

INSERT INTO `t_pewarnaan_jenis` (`pewarnaan_jenis_id`, `pewarnaan_jenis_type`, `pewarnaan_jenis_tanggal`) VALUES
(1, 'Anodizing', '2023-01-04'),
(2, 'Powder Coating', '2023-01-04'),
(3, 'Jual Langsung', '2023-01-04');

-- --------------------------------------------------------

--
-- Table structure for table `t_produksi`
--

CREATE TABLE `t_produksi` (
  `produksi_id` int(11) NOT NULL,
  `produksi_status` text NOT NULL,
  `produksi_nomor` text NOT NULL,
  `produksi_tanggal` date NOT NULL,
  `produksi_shift` text NOT NULL,
  `produksi_keterangan` text NOT NULL,
  `produksi_lampiran_1` text NOT NULL,
  `produksi_lampiran_2` text NOT NULL,
  `produksi_barang_qty` text NOT NULL,
  `produksi_billet_qty` text NOT NULL,
  `produksi_billet_hpp` text NOT NULL,
  `produksi_total_akhir` text NOT NULL,
  `produksi_hpp` text NOT NULL,
  `produksi_jasa` text NOT NULL,
  `produksi_setengah_jadi` text NOT NULL,
  `produksi_hapus` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `t_produksi`
--

INSERT INTO `t_produksi` (`produksi_id`, `produksi_status`, `produksi_nomor`, `produksi_tanggal`, `produksi_shift`, `produksi_keterangan`, `produksi_lampiran_1`, `produksi_lampiran_2`, `produksi_barang_qty`, `produksi_billet_qty`, `produksi_billet_hpp`, `produksi_total_akhir`, `produksi_hpp`, `produksi_jasa`, `produksi_setengah_jadi`, `produksi_hapus`) VALUES
(39, '1', 'PR-24122022-1', '2022-12-24', '78', 'ada gambar', '695369021ebe6deb7ed7c652a3a9e17f.png', 'a031438ed25ae7b454d84a301140a48f.png', '6', '5', '7124', '35124', '3193', '', '', 0),
(40, '1', 'PR-24122022-2', '2022-12-24', '78', 'Tanpa Foto', '', '', '10', '5', '2849', '30349', '2023', '', '', 0),
(44, '2', 'PR-28122022-3', '2022-12-28', '78', '-', '', '', '1', '5', '4749', '59749', '9958', '', '', 0),
(50, '3', 'PR-03012023-4', '2023-01-03', '78', '-', '', '', '1', '5', '14247', '21747', '3625', '5000', '10', 0);

-- --------------------------------------------------------

--
-- Table structure for table `t_produksi_barang`
--

CREATE TABLE `t_produksi_barang` (
  `produksi_barang_id` int(11) NOT NULL,
  `produksi_barang_nomor` text NOT NULL,
  `produksi_barang_barang` text NOT NULL,
  `produksi_barang_qty` text NOT NULL,
  `produksi_barang_harga` text NOT NULL,
  `produksi_barang_subtotal` text NOT NULL,
  `produksi_barang_tanggal` date NOT NULL DEFAULT curdate()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `t_produksi_barang`
--

INSERT INTO `t_produksi_barang` (`produksi_barang_id`, `produksi_barang_nomor`, `produksi_barang_barang`, `produksi_barang_qty`, `produksi_barang_harga`, `produksi_barang_subtotal`, `produksi_barang_tanggal`) VALUES
(44, 'PR-24122022-2', '3', '1', '3000', '3000', '2022-12-24'),
(45, 'PR-24122022-2', '1', '5', '2500', '12500', '2022-12-24'),
(75, 'PR-27122022-3', '9', '1', '10000', '10000', '2022-12-28'),
(78, 'PR-28122022-3', '4', '1', '55000', '55000', '2022-12-28'),
(81, 'PR-24122022-1', '3', '1', '3000', '3000', '2023-01-02'),
(82, 'PR-24122022-1', '2', '5', '5000', '25000', '2023-01-02'),
(100, 'PR-03012023-4', '1', '1', '2500', '2500', '2023-01-06');

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
-- Table structure for table `t_setengah_jadi`
--

CREATE TABLE `t_setengah_jadi` (
  `setengah_jadi_id` int(11) NOT NULL,
  `setengah_jadi_stok` text NOT NULL DEFAULT '0',
  `setengah_jadi_hpp` text NOT NULL DEFAULT '0',
  `setengah_jadi_update` date NOT NULL DEFAULT curdate()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `t_setengah_jadi`
--

INSERT INTO `t_setengah_jadi` (`setengah_jadi_id`, `setengah_jadi_stok`, `setengah_jadi_hpp`, `setengah_jadi_update`) VALUES
(1, '5', '363', '2023-01-06');

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
(5, 'admin@admin.com', '21232f297a57a5a743894a0e4a801fc3', 'Bagas Pramono', '2021-11-09', '085555111555', 'Alamat', 'Biodata', '4c293a141d8c17800a44b816d35238cd.png', 1, NULL, NULL, NULL, '2022-11-29', 0),
(78, 'siskae@gmail.com', 'afa0b885505255964c06188e2b4e8f59', 'Siska Elisa', NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL, NULL, '2022-12-04', 0);

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
-- Indexes for table `t_master_produk`
--
ALTER TABLE `t_master_produk`
  ADD PRIMARY KEY (`master_produk_id`);

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
-- Indexes for table `t_pewarnaan`
--
ALTER TABLE `t_pewarnaan`
  ADD PRIMARY KEY (`pewarnaan_id`);

--
-- Indexes for table `t_pewarnaan_jenis`
--
ALTER TABLE `t_pewarnaan_jenis`
  ADD PRIMARY KEY (`pewarnaan_jenis_id`);

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
-- Indexes for table `t_satuan`
--
ALTER TABLE `t_satuan`
  ADD PRIMARY KEY (`satuan_id`);

--
-- Indexes for table `t_setengah_jadi`
--
ALTER TABLE `t_setengah_jadi`
  ADD PRIMARY KEY (`setengah_jadi_id`);

--
-- Indexes for table `t_user`
--
ALTER TABLE `t_user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `t_bahan`
--
ALTER TABLE `t_bahan`
  MODIFY `bahan_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

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
-- AUTO_INCREMENT for table `t_master_produk`
--
ALTER TABLE `t_master_produk`
  MODIFY `master_produk_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

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
  MODIFY `peleburan_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `t_peleburan_barang`
--
ALTER TABLE `t_peleburan_barang`
  MODIFY `peleburan_barang_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `t_pembelian`
--
ALTER TABLE `t_pembelian`
  MODIFY `pembelian_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `t_pembelian_barang`
--
ALTER TABLE `t_pembelian_barang`
  MODIFY `pembelian_barang_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=230;

--
-- AUTO_INCREMENT for table `t_pewarnaan`
--
ALTER TABLE `t_pewarnaan`
  MODIFY `pewarnaan_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `t_pewarnaan_jenis`
--
ALTER TABLE `t_pewarnaan_jenis`
  MODIFY `pewarnaan_jenis_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `t_produksi`
--
ALTER TABLE `t_produksi`
  MODIFY `produksi_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `t_produksi_barang`
--
ALTER TABLE `t_produksi_barang`
  MODIFY `produksi_barang_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101;

--
-- AUTO_INCREMENT for table `t_satuan`
--
ALTER TABLE `t_satuan`
  MODIFY `satuan_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `t_setengah_jadi`
--
ALTER TABLE `t_setengah_jadi`
  MODIFY `setengah_jadi_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `t_user`
--
ALTER TABLE `t_user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=80;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
