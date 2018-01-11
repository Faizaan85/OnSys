
-- --------------------------------------------------------

--
-- Structure for view `order_details`
--
DROP TABLE IF EXISTS `order_details`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `order_details`  AS  select `oi`.`OiId` AS `OiId`,`oi`.`OiOmId` AS `OiOmId`,`oi`.`OiPartNo` AS `OiPartNo`,`id`.`IdStore` AS `IdStore`,`id`.`IdLocation` AS `IdLocation`,`oi`.`OiSupplierNo` AS `OiSupplierNo`,`oi`.`OiDescription` AS `OiDescription`,`oi`.`OiLeftQty` AS `OiLeftQty`,`oi`.`OiRightQty` AS `OiRightQty`,`oi`.`OiTotalQty` AS `OiTotalQty`,`oi`.`OiPrice` AS `OiPrice`,`oi`.`OiAmount` AS `OiAmount`,`oi`.`OiCreatedOn` AS `OiCreatedOn`,`oi`.`OiModifiedOn` AS `OiModifiedOn`,`oi`.`OiStatus` AS `OiStatus` from (`orderitems` `oi` join `itemdetails` `id`) where (`oi`.`OiPartNo` = `id`.`IdIPART_NO`) ;
