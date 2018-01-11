
-- --------------------------------------------------------

--
-- Structure for view `invoicemaster_user`
--
DROP TABLE IF EXISTS `invoicemaster_user`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `invoicemaster_user`  AS  select `in`.`InId` AS `InId`,`in`.`InOmId` AS `InOmId`,`in`.`InOmCompanyCode` AS `InOmCompanyCode`,`in`.`InOmCompanyName` AS `InOmCompanyName`,`in`.`InOmCreatedOn` AS `InOmCreatedOn`,`in`.`InOmLpo` AS `InOmLpo`,`in`.`inDueDate` AS `inDueDate`,`in`.`InAmount` AS `InAmount`,`in`.`InDiscount` AS `InDiscount`,`in`.`InVatPercent` AS `InVatPercent`,`in`.`InVatAmount` AS `InVatAmount`,`in`.`InNetAmount` AS `InNetAmount`,`in`.`InOmAdd` AS `InOmAdd`,`in`.`InOmTel1` AS `InOmTel1`,`in`.`InOmTel2` AS `InOmTel2`,`us`.`UsrName` AS `UsrName`,`in`.`InCreatedOn` AS `InCreatedOn`,`in`.`InViewCount` AS `InViewCount` from (`invoicemaster` `in` join `users` `us` on((`in`.`InCreatedBy` = `us`.`UsrId`))) ;
