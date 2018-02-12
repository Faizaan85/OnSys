-- phpMyAdmin SQL Dump
-- version 4.6.6
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Feb 04, 2018 at 08:07 AM
-- Server version: 5.7.16-log
-- PHP Version: 5.6.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `accman_clone`
--

-- --------------------------------------------------------

--
-- Table structure for table `purchaseitems`
--

CREATE TABLE `purchaseitems` (
  `PiId` int(11) NOT NULL COMMENT 'Purchaseitem Id',
  `PiPmId` int(11) NOT NULL COMMENT 'Purchaseitem Purchasemaster Id',
  `PiPartNo` varchar(15) NOT NULL COMMENT 'Purchaseitem Part No',
  `PiSupplierNo` varchar(15) DEFAULT NULL COMMENT 'Purchaseitem Supplier No',
  `PiDescription` varchar(100) DEFAULT NULL COMMENT 'Purchaseitem Description',
  `PiLeftQty` int(11) NOT NULL DEFAULT '0' COMMENT 'Purchaseitem Left Qty',
  `PiRightQty` int(11) NOT NULL DEFAULT '0' COMMENT 'Purchaseitem Right Qty',
  `PiTotalQty` int(11) NOT NULL COMMENT 'Purchaseitem Total Qty',
  `PiPrice` decimal(8,2) NOT NULL COMMENT 'Purchaseitem Price',
  `PiAmount` decimal(10,2) NOT NULL COMMENT 'Purchaseitem Amount',
  `PiCreatedOn` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Purchaseitem Created On'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `purchasemaster`
--

CREATE TABLE `purchasemaster` (
  `PmId` int(11) NOT NULL COMMENT 'Purchasemaster ID',
  `PmOId` int(11) DEFAULT NULL COMMENT 'Purchasemaster Order ID',
  `PmClONum` varchar(25) DEFAULT NULL COMMENT 'Purchasemaster Client Order Number',
  `PmClImNum` varchar(25) NOT NULL COMMENT 'Purchasemaster Client Invoicemaster Number',
  `PmClImDate` date NOT NULL COMMENT 'Purchasemaster Client invmaster Date',
  `PmClTrn` varchar(20) NOT NULL COMMENT 'Purchasemaster Client TRN',
  `PmClSalesmen` varchar(25) DEFAULT NULL COMMENT 'Purchasemaster Client Salesmen',
  `PmClDoNum` varchar(25) DEFAULT NULL COMMENT 'Purchasemster Client Delivery Order Num',
  `PmClDDate` date DEFAULT NULL COMMENT 'Purchasemaster Client Deliver Date',
  `PmDiscount` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT 'Purchasemaster Discount',
  `PmCreatedDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Purchasemaster Created Date',
  `PmCreatedBy` int(11) NOT NULL COMMENT 'Purchasemaster User Id'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `purchaseitems`
--
ALTER TABLE `purchaseitems`
  ADD PRIMARY KEY (`PiId`);

--
-- Indexes for table `purchasemaster`
--
ALTER TABLE `purchasemaster`
  ADD PRIMARY KEY (`PmId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `purchaseitems`
--
ALTER TABLE `purchaseitems`
  MODIFY `PiId` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Purchaseitem Id';
--
-- AUTO_INCREMENT for table `purchasemaster`
--
ALTER TABLE `purchasemaster`
  MODIFY `PmId` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Purchasemaster ID';
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
