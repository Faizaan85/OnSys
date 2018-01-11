
-- --------------------------------------------------------

--
-- Structure for view `ordermaster_user`
--
DROP TABLE IF EXISTS `ordermaster_user`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `ordermaster_user`  AS  select `a`.`OmId` AS `OmId`,`d`.`InId` AS `InId`,`a`.`OmCompanyCode` AS `OmCompanyCode`,`a`.`OmCompanyName` AS `OmCompanyName`,`a`.`OmCreatedOn` AS `OmCreatedOn`,`a`.`OmLpo` AS `OmLpo`,`a`.`OmPayTime` AS `OmPayTime`,`a`.`OmAdd` AS `OmAdd`,`a`.`OmTel1` AS `OmTel1`,`a`.`OmTel2` AS `OmTel2`,`a`.`OmStatus` AS `OmStatus`,`a`.`OmStore1` AS `OmStore1`,`a`.`OmStore2` AS `OmStore2`,`a`.`OmPrinted` AS `OmPrinted`,`a`.`OmDiscount` AS `OmDiscount`,`c`.`CLVATNO` AS `ClVatNo`,`b`.`UsrName` AS `OmCreatedBy` from (((`ordermaster` `a` join `users` `b` on(((`a`.`OmCreatedBy` = `b`.`UsrId`) and (`a`.`OmIsDeleted` = 0)))) join `cl001` `c` on((`c`.`CLCODE` = `a`.`OmCompanyCode`))) left join `invoicemaster` `d` on((`a`.`OmId` = `d`.`InOmId`))) ;
