-- phpMyAdmin SQL Dump
-- version 4.8.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 19, 2020 at 05:07 AM
-- Server version: 10.1.31-MariaDB
-- PHP Version: 7.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `jaya`
--

-- --------------------------------------------------------

--
-- Table structure for table `bahan_baku`
--

CREATE TABLE `bahan_baku` (
  `No_bahan_baku` int(20) NOT NULL,
  `No_ktp_supplier` varchar(16) NOT NULL,
  `Nama` varchar(255) NOT NULL,
  `Harga` varchar(255) NOT NULL,
  `isi` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bahan_baku`
--

INSERT INTO `bahan_baku` (`No_bahan_baku`, `No_ktp_supplier`, `Nama`, `Harga`, `isi`) VALUES
(3, '165150200111021', 'krupuk bulat', '17500', '245'),
(4, '16515020111110', 'krupuk kotak', '15000', '2500'),
(5, '16515020111110', 'kerupuk rambak', '17000', '100');

-- --------------------------------------------------------

--
-- Table structure for table `bahan_baku_ukm`
--

CREATE TABLE `bahan_baku_ukm` (
  `No_bahan_baku_ukm` int(20) NOT NULL,
  `No_bahan_baku` int(20) NOT NULL,
  `No_ktp_pemilik` varchar(16) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `berat` varchar(20) NOT NULL,
  `isi` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bahan_baku_ukm`
--

INSERT INTO `bahan_baku_ukm` (`No_bahan_baku_ukm`, `No_bahan_baku`, `No_ktp_pemilik`, `nama`, `berat`, `isi`) VALUES
(6, 3, '123456789', 'krupuk bulat', '9955.1020408164', '245'),
(7, 5, '123456789', 'kerupuk rambak', '2000', '100');

-- --------------------------------------------------------

--
-- Table structure for table `pemesanan_bahan_baku`
--

CREATE TABLE `pemesanan_bahan_baku` (
  `No_pemesanan_bahan_baku` int(20) NOT NULL,
  `No_ktp_pemilik` varchar(16) NOT NULL,
  `No_ktp_supplier` varchar(16) NOT NULL,
  `No_bahan_baku` int(20) NOT NULL,
  `Nama_supplier` varchar(255) NOT NULL,
  `Nama_bahan_baku` varchar(255) NOT NULL,
  `Berat` varchar(255) NOT NULL,
  `tgl_dipesan` date NOT NULL,
  `tgl_pengiriman` date DEFAULT NULL,
  `keterangan` varchar(255) DEFAULT NULL,
  `harga_total` varchar(255) NOT NULL,
  `status` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pemesanan_bahan_baku`
--

INSERT INTO `pemesanan_bahan_baku` (`No_pemesanan_bahan_baku`, `No_ktp_pemilik`, `No_ktp_supplier`, `No_bahan_baku`, `Nama_supplier`, `Nama_bahan_baku`, `Berat`, `tgl_dipesan`, `tgl_pengiriman`, `keterangan`, `harga_total`, `status`) VALUES
(21, '123456789', '165150200111021', 3, 'beni ahmad', 'krupuk bulat', '2000', '2020-11-12', '2020-11-13', NULL, ' 35000000', 'diterima'),
(22, '123456789', '16515020111110', 5, 'dika bayu', 'kerupuk rambak', '2000', '2020-11-16', '2020-11-18', NULL, ' 34000000', 'diterima');

-- --------------------------------------------------------

--
-- Table structure for table `pemesanan_produk`
--

CREATE TABLE `pemesanan_produk` (
  `No_pemesanan` int(20) NOT NULL,
  `No_ktp_pemilik` varchar(16) NOT NULL,
  `No_ktp_sales` varchar(16) NOT NULL,
  `No_produk` int(20) NOT NULL,
  `Nama_produk` varchar(20) NOT NULL,
  `Nama_sales` varchar(20) NOT NULL,
  `waktu` time NOT NULL,
  `tgl_pemesanan` date NOT NULL,
  `tgl_pemasaran` date NOT NULL,
  `keterangan` varchar(255) DEFAULT NULL,
  `jumlah` varchar(255) NOT NULL,
  `setoran` varchar(255) NOT NULL,
  `status` varchar(20) NOT NULL,
  `setoran_yang_dibayar` varchar(20) DEFAULT NULL,
  `kekurangan_setoran` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pemilik`
--

CREATE TABLE `pemilik` (
  `No_ktp` varchar(16) NOT NULL,
  `Username` varchar(10) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `Nama` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pemilik`
--

INSERT INTO `pemilik` (`No_ktp`, `Username`, `Password`, `Nama`) VALUES
('123456789', 'wawan12', '8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92', 'gunawan ');

-- --------------------------------------------------------

--
-- Table structure for table `produk`
--

CREATE TABLE `produk` (
  `No_produk` int(20) NOT NULL,
  `No_bahan_baku` int(20) NOT NULL,
  `No_ktp_pemilik` varchar(16) NOT NULL,
  `Nama` varchar(255) NOT NULL,
  `Harga_satuan` varchar(255) NOT NULL,
  `keterangan` varchar(255) NOT NULL,
  `potongan_bbm` varchar(255) NOT NULL,
  `gambar` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `produk`
--

INSERT INTO `produk` (`No_produk`, `No_bahan_baku`, `No_ktp_pemilik`, `Nama`, `Harga_satuan`, `keterangan`, `potongan_bbm`, `gambar`) VALUES
(15, 6, '123456789', 'kerupuk bulat besar ', '500', 'rasa bawang', '7500', '5f942f439ac6e_5f61bf69b4217_5efb4a7061739_krupuk_bulat.jpg'),
(16, 6, '123456789', 'kerupuk  bulat kecil 100', '100', 'rasa bawang', '7500', '5fb215c8ad772_images_(1).jpg'),
(17, 6, '123456789', 'kerupuk bulat kecil 200', '200', 'rasa bawang', '7500', '5fb2159f81c9f_images.jpg'),
(18, 7, '123456789', 'krupuk rambak ', '2000', 'kerupuk rambak ', '7500', '5fb2166b427fb_download_(1).jpg');

-- --------------------------------------------------------

--
-- Table structure for table `sales`
--

CREATE TABLE `sales` (
  `No_ktp` varchar(16) NOT NULL,
  `Username` varchar(10) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `Nama` varchar(20) NOT NULL,
  `status` varchar(255) NOT NULL,
  `tgl_daftar` date NOT NULL,
  `alamat` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sales`
--

INSERT INTO `sales` (`No_ktp`, `Username`, `Password`, `Nama`, `status`, `tgl_daftar`, `alamat`) VALUES
('03240959767', 'peni', '8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92', 'peni', 'terdaftar', '2020-10-24', ''),
('213499', 'ika', '8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92', 'deni bachtiar', 'terdaftar', '2020-06-01', 'jln pulau mas 3'),
('324985717281387', 'bedu', '8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92', 'bedu', 'terdaftar', '2020-10-24', '');

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE `supplier` (
  `No_ktp` varchar(16) NOT NULL,
  `Username` varchar(10) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `Nama` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`No_ktp`, `Username`, `Password`, `Nama`) VALUES
('165150200111021', 'beni', '8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92', 'beni ahmad'),
('16515020111110', 'dika', '8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92', 'dika bayu');

-- --------------------------------------------------------

--
-- Table structure for table `tunjangan_hari_raya`
--

CREATE TABLE `tunjangan_hari_raya` (
  `No_tunjangan` int(20) NOT NULL,
  `No_ktp_pemilik` varchar(16) NOT NULL,
  `No_ktp_sales` varchar(16) NOT NULL,
  `nama_sales` varchar(20) NOT NULL,
  `nilai` varchar(255) NOT NULL,
  `tanggal` date NOT NULL,
  `keterangan` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tunjangan_hari_raya`
--

INSERT INTO `tunjangan_hari_raya` (`No_tunjangan`, `No_ktp_pemilik`, `No_ktp_sales`, `nama_sales`, `nilai`, `tanggal`, `keterangan`) VALUES
(3, '123456789', '213499', 'faizal bachtiar', '500000\r\n', '2020-06-09', 'kenaikan tunjangan '),
(4, '123456789', '03240959767', 'peni', '245000', '2020-10-07', 'awdk'),
(5, '123456789', '213499', 'deni bachtiar', '0999', '2020-10-22', 'mk');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bahan_baku`
--
ALTER TABLE `bahan_baku`
  ADD PRIMARY KEY (`No_bahan_baku`),
  ADD KEY `No_ktp_supplier` (`No_ktp_supplier`);

--
-- Indexes for table `bahan_baku_ukm`
--
ALTER TABLE `bahan_baku_ukm`
  ADD PRIMARY KEY (`No_bahan_baku_ukm`),
  ADD KEY `No_ktp_pemilik` (`No_ktp_pemilik`),
  ADD KEY `No_bahan_baku` (`No_bahan_baku`);

--
-- Indexes for table `pemesanan_bahan_baku`
--
ALTER TABLE `pemesanan_bahan_baku`
  ADD PRIMARY KEY (`No_pemesanan_bahan_baku`),
  ADD KEY `No_ktp_pemilik` (`No_ktp_pemilik`),
  ADD KEY `No_ktp_supplier` (`No_ktp_supplier`),
  ADD KEY `No_bahan_baku` (`No_bahan_baku`);

--
-- Indexes for table `pemesanan_produk`
--
ALTER TABLE `pemesanan_produk`
  ADD PRIMARY KEY (`No_pemesanan`),
  ADD KEY `No_ktp_pemilik` (`No_ktp_pemilik`),
  ADD KEY `No_ktp_sales` (`No_ktp_sales`),
  ADD KEY `No_produk` (`No_produk`);

--
-- Indexes for table `pemilik`
--
ALTER TABLE `pemilik`
  ADD PRIMARY KEY (`No_ktp`),
  ADD UNIQUE KEY `Username` (`Username`);

--
-- Indexes for table `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`No_produk`),
  ADD KEY `No_ktp_pemilik` (`No_ktp_pemilik`),
  ADD KEY `No_bahan_baku` (`No_bahan_baku`);

--
-- Indexes for table `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`No_ktp`),
  ADD UNIQUE KEY `Username` (`Username`);

--
-- Indexes for table `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`No_ktp`);

--
-- Indexes for table `tunjangan_hari_raya`
--
ALTER TABLE `tunjangan_hari_raya`
  ADD PRIMARY KEY (`No_tunjangan`),
  ADD KEY `No_ktp_pemilik` (`No_ktp_pemilik`),
  ADD KEY `No_ktp_sales` (`No_ktp_sales`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bahan_baku`
--
ALTER TABLE `bahan_baku`
  MODIFY `No_bahan_baku` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `bahan_baku_ukm`
--
ALTER TABLE `bahan_baku_ukm`
  MODIFY `No_bahan_baku_ukm` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `pemesanan_bahan_baku`
--
ALTER TABLE `pemesanan_bahan_baku`
  MODIFY `No_pemesanan_bahan_baku` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `pemesanan_produk`
--
ALTER TABLE `pemesanan_produk`
  MODIFY `No_pemesanan` int(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `produk`
--
ALTER TABLE `produk`
  MODIFY `No_produk` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `tunjangan_hari_raya`
--
ALTER TABLE `tunjangan_hari_raya`
  MODIFY `No_tunjangan` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bahan_baku`
--
ALTER TABLE `bahan_baku`
  ADD CONSTRAINT `bahan_baku_ibfk_1` FOREIGN KEY (`No_ktp_supplier`) REFERENCES `supplier` (`No_ktp`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `bahan_baku_ukm`
--
ALTER TABLE `bahan_baku_ukm`
  ADD CONSTRAINT `bahan_baku_ukm_ibfk_1` FOREIGN KEY (`No_ktp_pemilik`) REFERENCES `pemilik` (`No_ktp`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pemesanan_bahan_baku`
--
ALTER TABLE `pemesanan_bahan_baku`
  ADD CONSTRAINT `pemesanan_bahan_baku_ibfk_1` FOREIGN KEY (`No_ktp_pemilik`) REFERENCES `pemilik` (`No_ktp`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pemesanan_bahan_baku_ibfk_2` FOREIGN KEY (`No_ktp_supplier`) REFERENCES `supplier` (`No_ktp`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pemesanan_bahan_baku_ibfk_3` FOREIGN KEY (`No_bahan_baku`) REFERENCES `bahan_baku` (`No_bahan_baku`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pemesanan_produk`
--
ALTER TABLE `pemesanan_produk`
  ADD CONSTRAINT `pemesanan_produk_ibfk_1` FOREIGN KEY (`No_ktp_pemilik`) REFERENCES `pemilik` (`No_ktp`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pemesanan_produk_ibfk_2` FOREIGN KEY (`No_ktp_sales`) REFERENCES `sales` (`No_ktp`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pemesanan_produk_ibfk_3` FOREIGN KEY (`No_produk`) REFERENCES `produk` (`No_produk`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `produk`
--
ALTER TABLE `produk`
  ADD CONSTRAINT `produk_ibfk_1` FOREIGN KEY (`No_ktp_pemilik`) REFERENCES `pemilik` (`No_ktp`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `produk_ibfk_2` FOREIGN KEY (`No_bahan_baku`) REFERENCES `bahan_baku_ukm` (`No_bahan_baku_ukm`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tunjangan_hari_raya`
--
ALTER TABLE `tunjangan_hari_raya`
  ADD CONSTRAINT `tunjangan_hari_raya_ibfk_1` FOREIGN KEY (`No_ktp_pemilik`) REFERENCES `pemilik` (`No_ktp`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tunjangan_hari_raya_ibfk_2` FOREIGN KEY (`No_ktp_sales`) REFERENCES `sales` (`No_ktp`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
