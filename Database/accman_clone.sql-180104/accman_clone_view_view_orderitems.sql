
-- --------------------------------------------------------

--
-- Structure for view `view_orderitems`
--
DROP TABLE IF EXISTS `view_orderitems`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_orderitems`  AS  select `a`.`OmId` AS `OmId`,`b`.`OiId` AS `OiId`,`b`.`OiPartNo` AS `OiPartNo`,`b`.`OiSupplierNo` AS `OiSupplierNo`,`b`.`OiDescription` AS `OiDescription`,`b`.`OiRightQty` AS `OiRightQty`,`b`.`OiLeftQty` AS `OiLeftQty`,`b`.`OiTotalQty` AS `OiTotalQty`,`b`.`OiPrice` AS `OiPrice`,`b`.`OiAmount` AS `OiAmount`,`b`.`OiStatus` AS `OiStatus`,`c`.`UNIT_COST` AS `Tgp`,`a`.`OmCompanyName` AS `OmCompanyName`,`a`.`OmCreatedOn` AS `OmCreatedOn`,`a`.`OmLpo` AS `OmLpo`,`a`.`OmStatus` AS `OmStatus`,`a`.`OmStore1` AS `OmStore1`,`a`.`OmStore2` AS `OmStore2`,`a`.`OmPrinted` AS `OmPrinted`,`a`.`OmIsDeleted` AS `OmIsDeleted`,`a`.`OmDiscount` AS `OmDiscount`,`d`.`UsrName` AS `OmCreatedBy`,`a`.`OmModifiedOn` AS `OmModifiedOn`,`a`.`OmModifiedBy` AS `OmModifiedBy`,`a`.`OmIsModifying` AS `OmIsModifying` from (((`ordermaster` `a` join `orderitems` `b` on(((`a`.`OmId` = `b`.`OiOmId`) and (`a`.`OmIsDeleted` = 0)))) join `item` `c` on((`b`.`OiPartNo` = `c`.`PART_NO`))) join `users` `d` on((`a`.`OmCreatedBy` = `d`.`UsrId`))) ;
