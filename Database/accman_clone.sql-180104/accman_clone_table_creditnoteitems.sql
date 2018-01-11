
-- --------------------------------------------------------

--
-- Table structure for table `creditnoteitems`
--

DROP TABLE IF EXISTS `creditnoteitems`;
CREATE TABLE IF NOT EXISTS `creditnoteitems` (
  `CniId` int(11) NOT NULL AUTO_INCREMENT,
  `CnmId` int(11) NOT NULL,
  `IiId` int(11) NOT NULL,
  `CniPartNo` varchar(15) NOT NULL,
  `CniSupplierNo` varchar(15) NOT NULL,
  `CniDescription` varchar(36) NOT NULL,
  `CniLeftQty` int(11) NOT NULL,
  `CniRightQty` int(11) NOT NULL,
  `CniTotalQty` int(11) NOT NULL,
  `CniPrice` decimal(8,2) NOT NULL,
  `CniAmount` decimal(10,2) NOT NULL,
  `CniReason` varchar(100) NOT NULL,
  `CniCreatedOn` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`CniId`),
  KEY `CnmId` (`CnmId`),
  KEY `IiId` (`IiId`),
  KEY `CniPartNo` (`CniPartNo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
