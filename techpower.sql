CREATE DATABASE techpower;
USE techpower;

CREATE TABLE `User`
(
 `UserID`       int NOT NULL AUTO_INCREMENT ,
 `UserName`     varchar(40) NOT NULL ,
 `UserEmail`    varchar(40) NULL ,
 `UserPassword` varchar(20) NOT NULL ,
 `UserPhone`    varchar(20) NULL ,
 `UserAddress`  varchar(40) NOT NULL ,
 `UserNIF`      int(9) NOT NULL ,

PRIMARY KEY (`UserID`),
UNIQUE KEY `AK1_Customer_CustomerName` (`UserName`)
) AUTO_INCREMENT=1 COMMENT='Basic information 
about Customer';

-- ************************************** `Sale`

CREATE TABLE `Sale`
(
 `SaleID`       int NOT NULL AUTO_INCREMENT ,
 `UserID`       int NOT NULL ,
 `SaleDate`     datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ,
 `TotalAmount`  decimal(12,2) NOT NULL ,
 `SaleFinished` bit NOT NULL ,

PRIMARY KEY (`SaleID`),
KEY `FK_Order_CustomerId_Customer` (`UserID`),
CONSTRAINT `FK_Order_CustomerId_Customer` FOREIGN KEY `FK_Order_CustomerId_Customer` (`UserID`) REFERENCES `User` (`UserID`)
) AUTO_INCREMENT=1 COMMENT='Order information
like Date, Amount';

-- ************************************** `Product`

CREATE TABLE `Product`
(
 `ProductId`      int NOT NULL AUTO_INCREMENT ,
 `ProductName`    varchar(50) NOT NULL ,
 `UnitPrice`      decimal(12,2) NULL ,
 `IsDiscontinued` bit NOT NULL DEFAULT 0 ,
 `Sku`            varchar(13) NOT NULL ,
 `Description`    varchar(5000) NOT NULL ,
 `IDCategory`     int NOT NULL ,

PRIMARY KEY (`ProductId`),
UNIQUE KEY `AK1_Product_SupplierId_ProductName` (`ProductName`),
KEY `fkIdx_136` (`IDCategory`),
CONSTRAINT `FK_136` FOREIGN KEY `fkIdx_136` (`IDCategory`) REFERENCES `Category` (`ID`)
) AUTO_INCREMENT=1 COMMENT='Basic information 
about Product';

-- ************************************** `SaleItem`

CREATE TABLE `SaleItem`
(
 `SaleID`    int NOT NULL ,
 `ProductId` int NOT NULL ,
 `UnitPrice` decimal(12,2) NOT NULL ,
 `Quantity`  int NOT NULL ,

PRIMARY KEY (`SaleID`, `ProductId`),
KEY `FK_OrderItem_OrderId_Order` (`SaleID`),
CONSTRAINT `FK_OrderItem_OrderId_Order` FOREIGN KEY `FK_OrderItem_OrderId_Order` (`SaleID`) REFERENCES `Sale` (`SaleID`),
KEY `FK_OrderItem_ProductId_Product` (`ProductId`),
CONSTRAINT `FK_OrderItem_ProductId_Product` FOREIGN KEY `FK_OrderItem_ProductId_Product` (`ProductId`) REFERENCES `Product` (`ProductId`)
) COMMENT='Information about
like Price, Quantity';

-- ************************************** `Category`

CREATE TABLE `Category`
(
 `ID`          int NOT NULL ,
 `Description` varchar(200) NOT NULL ,
 `ParentID`    int NOT NULL ,

PRIMARY KEY (`ID`),
KEY `fkIdx_133` (`ParentID`),
CONSTRAINT `FK_133` FOREIGN KEY `fkIdx_133` (`ParentID`) REFERENCES `Category` (`ID`)
);
