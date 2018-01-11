
--
-- Constraints for dumped tables
--

--
-- Constraints for table `creditnoteitems`
--
ALTER TABLE `creditnoteitems`
  ADD CONSTRAINT `creditnoteitems_ibfk_1` FOREIGN KEY (`CnmId`) REFERENCES `creditnotemaster` (`cnmId`),
  ADD CONSTRAINT `creditnoteitems_ibfk_2` FOREIGN KEY (`IiId`) REFERENCES `invoiceitems` (`IiId`),
  ADD CONSTRAINT `creditnoteitems_ibfk_3` FOREIGN KEY (`CniPartNo`) REFERENCES `item` (`PART_NO`);

--
-- Constraints for table `creditnotemaster`
--
ALTER TABLE `creditnotemaster`
  ADD CONSTRAINT `creditnotemaster_ibfk_1` FOREIGN KEY (`cnmInId`) REFERENCES `invoicemaster` (`InId`),
  ADD CONSTRAINT `creditnotemaster_ibfk_2` FOREIGN KEY (`CnmCompanyCode`) REFERENCES `cl001` (`CLCODE`);

--
-- Constraints for table `invoiceitems`
--
ALTER TABLE `invoiceitems`
  ADD CONSTRAINT `invoiceitems_ibfk_1` FOREIGN KEY (`IiInId`) REFERENCES `invoicemaster` (`InId`);

--
-- Constraints for table `invoicemaster`
--
ALTER TABLE `invoicemaster`
  ADD CONSTRAINT `invoicemaster_ibfk_2` FOREIGN KEY (`InCreatedBy`) REFERENCES `users` (`UsrId`),
  ADD CONSTRAINT `invoicemaster_ibfk_3` FOREIGN KEY (`InOmId`) REFERENCES `ordermaster` (`OmId`);

--
-- Constraints for table `itemdetails`
--
ALTER TABLE `itemdetails`
  ADD CONSTRAINT `Fkey_ParNo` FOREIGN KEY (`IdIPART_NO`) REFERENCES `item` (`PART_NO`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `orderitems`
--
ALTER TABLE `orderitems`
  ADD CONSTRAINT `Fkey_OmId` FOREIGN KEY (`OiOmId`) REFERENCES `ordermaster` (`OmId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `ordermaster`
--
ALTER TABLE `ordermaster`
  ADD CONSTRAINT `FkeyCustCode` FOREIGN KEY (`OmCompanyCode`) REFERENCES `cl001` (`CLCODE`) ON UPDATE CASCADE,
  ADD CONSTRAINT `FkeyUser` FOREIGN KEY (`OmCreatedBy`) REFERENCES `users` (`UsrId`);
