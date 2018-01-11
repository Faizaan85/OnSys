
-- --------------------------------------------------------

--
-- Table structure for table `equipment_master`
--

DROP TABLE IF EXISTS `equipment_master`;
CREATE TABLE IF NOT EXISTS `equipment_master` (
  `id_equipment` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `equip_name` varchar(50) NOT NULL,
  PRIMARY KEY (`id_equipment`,`equip_name`),
  UNIQUE KEY `equip_name_UNIQUE` (`equip_name`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `equipment_master`
--

INSERT INTO `equipment_master` (`id_equipment`, `equip_name`) VALUES
(6, 'FENDER'),
(2, 'FRONT BUMPER'),
(7, 'GRILLE'),
(4, 'HEAD LAMP'),
(5, 'RADIATOR'),
(3, 'REAR BUMPER'),
(1, 'TAIL LAMP');
