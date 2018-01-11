
-- --------------------------------------------------------

--
-- Structure for view `invoicemaster_user_client`
--
DROP TABLE IF EXISTS `invoicemaster_user_client`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `invoicemaster_user_client`  AS  select `in`.`InId` AS `InId`,`in`.`InOmId` AS `InOmId`,`in`.`InOmCompanyCode` AS `InOmCompanyCode`,`cl`.`CLVATNO` AS `ClVatNo`,`in`.`InOmCompanyName` AS `InOmCompanyName`,`in`.`InOmCreatedOn` AS `InOmCreatedOn`,`in`.`InOmLpo` AS `InOmLpo`,`in`.`inDueDate` AS `inDueDate`,`in`.`InAmount` AS `InAmount`,`in`.`InDiscount` AS `InDiscount`,`in`.`InVatPercent` AS `InVatPercent`,`in`.`InVatAmount` AS `InVatAmount`,`in`.`InNetAmount` AS `InNetAmount`,`in`.`InOmAdd` AS `InOmAdd`,`in`.`InOmTel1` AS `InOmTel1`,`in`.`InOmTel2` AS `InOmTel2`,`us`.`UsrName` AS `UsrName`,`in`.`InCreatedOn` AS `InCreatedOn`,`in`.`InViewCount` AS `InViewCount` from ((`invoicemaster` `in` join `users` `us` on((`in`.`InCreatedBy` = `us`.`UsrId`))) join `cl001` `cl` on((`cl`.`CLCODE` = `in`.`InOmCompanyCode`))) ;
