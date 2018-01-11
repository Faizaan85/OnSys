
-- --------------------------------------------------------

--
-- Table structure for table `supplier_master`
--

DROP TABLE IF EXISTS `supplier_master`;
CREATE TABLE IF NOT EXISTS `supplier_master` (
  `id_supplier` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `code` varchar(6) NOT NULL,
  `short_name` varchar(15) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `contact_name` varchar(40) DEFAULT NULL,
  `tel01` varchar(25) DEFAULT NULL,
  `tel02` varchar(25) DEFAULT NULL,
  `fax` varchar(25) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `mob01` varchar(25) DEFAULT NULL,
  `mob02` varchar(25) DEFAULT NULL,
  `item_initial` varchar(2) NOT NULL,
  PRIMARY KEY (`id_supplier`,`code`,`short_name`,`full_name`,`item_initial`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `supplier_master`
--

INSERT INTO `supplier_master` (`id_supplier`, `code`, `short_name`, `full_name`, `contact_name`, `tel01`, `tel02`, `fax`, `email`, `mob01`, `mob02`, `item_initial`) VALUES
(1, 'LD001', 'DEPO', 'DEPO AUTO PARTS', '', NULL, NULL, NULL, NULL, NULL, NULL, 'D'),
(2, 'TY001', 'TYG', 'TONG YANG', '', NULL, NULL, NULL, NULL, NULL, NULL, 'T'),
(3, 'FT001', 'FPI', 'FORTUNE PARTS', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'F');
