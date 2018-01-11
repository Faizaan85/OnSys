
-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `UsrId` int(11) NOT NULL AUTO_INCREMENT,
  `UsrName` varchar(255) NOT NULL,
  `UsrEmail` varchar(255) NOT NULL,
  `UsrUsername` varchar(255) NOT NULL,
  `UsrPassword` varchar(255) NOT NULL,
  `UsrLevel` tinyint(4) NOT NULL DEFAULT '0',
  `UsrStoreLevel` enum('All','Store 1','Store 2') NOT NULL DEFAULT 'All',
  PRIMARY KEY (`UsrId`),
  UNIQUE KEY `UsrUsername` (`UsrUsername`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`UsrId`, `UsrName`, `UsrEmail`, `UsrUsername`, `UsrPassword`, `UsrLevel`, `UsrStoreLevel`) VALUES
(1, 'Faizaan Varteji', 'faizaan@carryonauto.com', 'faizaan85', '827ccb0eea8a706c4c34a16891f84e7b', 9, 'All'),
(2, 'test1', 'test@test.com', 'test', '827ccb0eea8a706c4c34a16891f84e7b', 5, 'All'),
(3, 'test2', 'test@test.com', 'test2', '098f6bcd4621d373cade4e832627b4f6', 0, 'All'),
(4, 'test3', 'test@test.com', 'test3', '098f6bcd4621d373cade4e832627b4f6', 0, 'All'),
(5, 'test4', 'test@test.com', 'test4', '098f6bcd4621d373cade4e832627b4f6', 0, 'All'),
(6, 'test5', 'test@test.com', 'test5', '098f6bcd4621d373cade4e832627b4f6', 0, 'All'),
(7, 'test6', 'test@test.com', 'test6', '098f6bcd4621d373cade4e832627b4f6', 0, 'All'),
(8, 'bilal ahmed', 'ahmed.bilal0585@gmail.com', 'ahmed1', '1f36c15d6a3d18d52e8d493bc8187cb9', 9, 'All'),
(9, 'shakeel ahmed', 'shakeel1970152@gamil.com', 'shakeel', 'ed6a5d43b2ec1b22e57b12a08ac439ce', 9, 'All'),
(10, 'najaf ali', 'najafsheena@gmail.com', 'najaf', 'ef28ed6ef128e1cc27ccba9ab1794ed1', 0, 'All'),
(11, 'haidar', 'haidarsharjah@gmail.com', 'haidar', 'bfd925fa86084bd0300fde7fd05ddd97', 4, 'All'),
(12, 'Ali Rashid', 'mobali70@hotmail.com', 'A', 'a8f5f167f44f4964e6c998dee827110c', 9, 'All'),
(13, 'Muhammad Ahsan', 'ahsangorsi86@yahoo.com', 'ahsan', '4cf6fe0f8babc457ccb173ae25469196', 0, 'All'),
(14, 'Kareem . K', 'kareemkp99@gmail.com', 'kareem', '202cb962ac59075b964b07152d234b70', 9, 'All');
