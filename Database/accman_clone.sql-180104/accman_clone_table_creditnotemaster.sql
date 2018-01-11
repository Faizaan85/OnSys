
-- --------------------------------------------------------

--
-- Table structure for table `creditnotemaster`
--

DROP TABLE IF EXISTS `creditnotemaster`;
CREATE TABLE IF NOT EXISTS `creditnotemaster` (
  `cnmId` int(11) NOT NULL AUTO_INCREMENT,
  `cnmInId` int(11) NOT NULL,
  `CnmCompanyCode` varchar(6) NOT NULL,
  `CnmLpo` varchar(100) DEFAULT NULL,
  `CnmAmount` decimal(10,2) NOT NULL,
  `CnmDiscount` decimal(10,2) NOT NULL DEFAULT '0.00',
  `CnmVatPercent` decimal(5,2) NOT NULL DEFAULT '5.00',
  `CnmVatAmount` decimal(10,2) NOT NULL,
  `CnmNetAmount` decimal(11,2) NOT NULL,
  `CnmCreatedBy` int(11) NOT NULL,
  `CnmCreatedOn` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`cnmId`),
  KEY `cnmInId` (`cnmInId`),
  KEY `CnmCompanyCode` (`CnmCompanyCode`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
