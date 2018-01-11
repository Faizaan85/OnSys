
-- --------------------------------------------------------

--
-- Table structure for table `stud`
--

DROP TABLE IF EXISTS `stud`;
CREATE TABLE IF NOT EXISTS `stud` (
  `roll_no` int(11) DEFAULT NULL,
  `name` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `stud`
--

INSERT INTO `stud` (`roll_no`, `name`) VALUES
(NULL, NULL),
(2, 'Brian'),
(3, 'Charlie');
