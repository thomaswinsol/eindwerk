/*
Navicat MySQL Data Transfer

Source Server         : localhost_3306
Source Server Version : 50150
Source Host           : localhost:3306
Source Database       : webwinkel

Target Server Type    : MYSQL
Target Server Version : 50150
File Encoding         : 65001

Date: 2013-06-15 18:18:28
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `bestellingdetail`
-- ----------------------------
DROP TABLE IF EXISTS `bestellingdetail`;
CREATE TABLE `bestellingdetail` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `IDBestelling` int(11) DEFAULT NULL,
  `IDProduct` int(11) DEFAULT NULL,
  `AantalBesteld` double DEFAULT NULL,
  `Prijs` double DEFAULT NULL,
  PRIMARY KEY (`ID`),
  KEY `IDBestelling` (`IDBestelling`),
  CONSTRAINT `bestellingdetail_ibfk_1` FOREIGN KEY (`IDBestelling`) REFERENCES `bestellingheader` (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=50 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of bestellingdetail
-- ----------------------------
INSERT INTO `bestellingdetail` VALUES ('21', '21', '1', '1', null);
INSERT INTO `bestellingdetail` VALUES ('22', '22', '2', '1', null);
INSERT INTO `bestellingdetail` VALUES ('23', '23', '2', '1', null);
INSERT INTO `bestellingdetail` VALUES ('24', '24', '2', '1', null);
INSERT INTO `bestellingdetail` VALUES ('25', '25', '1', '1', null);
INSERT INTO `bestellingdetail` VALUES ('26', '25', '2', '1', null);
INSERT INTO `bestellingdetail` VALUES ('27', '26', '1', '1', null);
INSERT INTO `bestellingdetail` VALUES ('28', '26', '2', '2', null);
INSERT INTO `bestellingdetail` VALUES ('29', '27', '3', '5', null);
INSERT INTO `bestellingdetail` VALUES ('30', '27', '2', '15', null);
INSERT INTO `bestellingdetail` VALUES ('31', '30', '2', '12', null);
INSERT INTO `bestellingdetail` VALUES ('32', '31', '2', '5', null);
INSERT INTO `bestellingdetail` VALUES ('33', '32', '3', '5', null);
INSERT INTO `bestellingdetail` VALUES ('34', '33', '1', '5', null);
INSERT INTO `bestellingdetail` VALUES ('35', '34', '5', '8', null);
INSERT INTO `bestellingdetail` VALUES ('36', '35', '1', '5', null);
INSERT INTO `bestellingdetail` VALUES ('37', '36', '1', '14', null);
INSERT INTO `bestellingdetail` VALUES ('38', '37', '3', '12', null);
INSERT INTO `bestellingdetail` VALUES ('39', '38', '3', '5', null);
INSERT INTO `bestellingdetail` VALUES ('40', '39', '2', '5', null);
INSERT INTO `bestellingdetail` VALUES ('41', '40', '3', '5', null);
INSERT INTO `bestellingdetail` VALUES ('42', '41', '3', '100', null);
INSERT INTO `bestellingdetail` VALUES ('43', '42', '2', '25', null);
INSERT INTO `bestellingdetail` VALUES ('44', '43', '2', '100', null);
INSERT INTO `bestellingdetail` VALUES ('45', '44', '2', '45', null);
INSERT INTO `bestellingdetail` VALUES ('46', '45', '1', '5', null);
INSERT INTO `bestellingdetail` VALUES ('47', '46', '2', '100', null);
INSERT INTO `bestellingdetail` VALUES ('48', '47', '2', '5', null);
INSERT INTO `bestellingdetail` VALUES ('49', '48', '3', '1', null);

-- ----------------------------
-- Table structure for `bestellingheader`
-- ----------------------------
DROP TABLE IF EXISTS `bestellingheader`;
CREATE TABLE `bestellingheader` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `IDGebruiker` int(11) DEFAULT NULL,
  `datumbestelling` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `leveringsadres` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=49 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of bestellingheader
-- ----------------------------
INSERT INTO `bestellingheader` VALUES ('17', '1', '2013-06-13 21:22:00', 'xxxx');
INSERT INTO `bestellingheader` VALUES ('18', '1', '2013-06-13 21:31:06', 'xxxx');
INSERT INTO `bestellingheader` VALUES ('19', '1', '2013-06-13 21:33:09', 'xxxx');
INSERT INTO `bestellingheader` VALUES ('20', '1', '2013-06-13 21:33:34', 'xxxx');
INSERT INTO `bestellingheader` VALUES ('21', '1', '2013-06-13 21:35:11', 'xxxx');
INSERT INTO `bestellingheader` VALUES ('22', '1', '2013-06-13 21:40:49', 'xxxx');
INSERT INTO `bestellingheader` VALUES ('23', '1', '2013-06-13 21:45:00', 'xxxx');
INSERT INTO `bestellingheader` VALUES ('24', '1', '2013-06-13 21:49:22', 'xxxx');
INSERT INTO `bestellingheader` VALUES ('25', '1', '2013-06-13 21:56:21', 'xxxx');
INSERT INTO `bestellingheader` VALUES ('26', '1', '2013-06-14 09:58:40', 'xxxx');
INSERT INTO `bestellingheader` VALUES ('27', '1', '2013-06-14 12:22:19', 'xxxx');
INSERT INTO `bestellingheader` VALUES ('28', '1', '2013-06-14 15:45:00', 'xxxx');
INSERT INTO `bestellingheader` VALUES ('29', '1', '2013-06-14 15:45:50', 'xxxx');
INSERT INTO `bestellingheader` VALUES ('30', '1', '2013-06-14 15:46:14', 'xxxx');
INSERT INTO `bestellingheader` VALUES ('31', '1', '2013-06-14 15:46:33', 'xxxx');
INSERT INTO `bestellingheader` VALUES ('32', null, '2013-06-14 16:09:07', 'xxxx');
INSERT INTO `bestellingheader` VALUES ('33', null, '2013-06-14 16:09:27', 'xxxx');
INSERT INTO `bestellingheader` VALUES ('34', '1', '2013-06-14 16:14:57', 'xxxx');
INSERT INTO `bestellingheader` VALUES ('35', '1', '2013-06-14 16:18:37', 'xxxx');
INSERT INTO `bestellingheader` VALUES ('36', '1', '2013-06-14 16:21:20', 'xxxx');
INSERT INTO `bestellingheader` VALUES ('37', '1', '2013-06-14 17:43:39', 'xxxx');
INSERT INTO `bestellingheader` VALUES ('38', '1', '2013-06-14 17:44:36', 'xxxx');
INSERT INTO `bestellingheader` VALUES ('39', '1', '2013-06-14 17:44:44', 'xxxx');
INSERT INTO `bestellingheader` VALUES ('40', '1', '2013-06-14 17:45:51', 'xxxx');
INSERT INTO `bestellingheader` VALUES ('41', '1', '2013-06-14 17:46:00', 'xxxx');
INSERT INTO `bestellingheader` VALUES ('42', '1', '2013-06-14 17:46:29', 'xxxx');
INSERT INTO `bestellingheader` VALUES ('43', '1', '2013-06-14 17:46:51', 'xxxx');
INSERT INTO `bestellingheader` VALUES ('44', '1', '2013-06-14 17:47:51', 'xxxx');
INSERT INTO `bestellingheader` VALUES ('45', '1', '2013-06-14 17:48:36', 'xxxx');
INSERT INTO `bestellingheader` VALUES ('46', '1', '2013-06-14 17:49:10', 'xxxx');
INSERT INTO `bestellingheader` VALUES ('47', '1', '2013-06-14 17:52:10', 'xxxx');
INSERT INTO `bestellingheader` VALUES ('48', '1', '2013-06-14 17:52:56', 'xxxx');

-- ----------------------------
-- Table structure for `categorie`
-- ----------------------------
DROP TABLE IF EXISTS `categorie`;
CREATE TABLE `categorie` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Omschrijving` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of categorie
-- ----------------------------
INSERT INTO `categorie` VALUES ('1', 'Plaatjes');
INSERT INTO `categorie` VALUES ('2', 'Cups');
INSERT INTO `categorie` VALUES ('3', 'Krullen');

-- ----------------------------
-- Table structure for `categorieproduct`
-- ----------------------------
DROP TABLE IF EXISTS `categorieproduct`;
CREATE TABLE `categorieproduct` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `IDCategorie` int(11) DEFAULT NULL,
  `IDProduct` int(11) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of categorieproduct
-- ----------------------------
INSERT INTO `categorieproduct` VALUES ('1', '1', '1');
INSERT INTO `categorieproduct` VALUES ('2', '3', '4');

-- ----------------------------
-- Table structure for `firma`
-- ----------------------------
DROP TABLE IF EXISTS `firma`;
CREATE TABLE `firma` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Firma` varchar(50) DEFAULT NULL,
  `Straat` varchar(50) DEFAULT NULL,
  `Postcode` varchar(10) DEFAULT NULL,
  `Gemeente` varchar(50) DEFAULT NULL,
  `Tel` varchar(25) DEFAULT NULL,
  `Fax` varchar(25) DEFAULT NULL,
  `BTWnummer` varchar(25) DEFAULT NULL,
  `Email` varchar(60) DEFAULT NULL,
  `Website` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of firma
-- ----------------------------
INSERT INTO `firma` VALUES ('1', 'Saverde', 'Ingelmunstersteenweg 157 ', '8780', 'Oostrozebeke', 'T +32 56 44 45 09', 'F +32 56 44 45 12 ', 'BE 0479.417.451 ', 'info@saverde.be', 'www.saverde.be');

-- ----------------------------
-- Table structure for `foto`
-- ----------------------------
DROP TABLE IF EXISTS `foto`;
CREATE TABLE `foto` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fileName` varchar(250) NOT NULL,
  `fileNameOrig` varchar(250) DEFAULT NULL,
  `screenName` varchar(250) DEFAULT NULL,
  `mimeType` varchar(80) DEFAULT NULL,
  `fileSize` int(11) DEFAULT NULL,
  `filePath` text,
  `identifier` int(11) DEFAULT NULL,
  `label` varchar(50) DEFAULT NULL,
  `status` tinyint(1) DEFAULT NULL,
  `creationDate` timestamp NULL DEFAULT NULL,
  `lastUpdate` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of foto
-- ----------------------------
INSERT INTO `foto` VALUES ('26', 'weekend_Schorrebakkehoeve_020__Large_.jpg', 'weekend Schorrebakkehoeve 020 (Large).jpg', null, null, '73719', 'uploads/foto/', '0', null, null, '2013-06-14 18:51:30', '2013-06-14 18:51:30');
INSERT INTO `foto` VALUES ('27', 'weekend_Schorrebakkehoeve_018__Large_.jpg', 'weekend Schorrebakkehoeve 018 (Large).jpg', null, null, '127614', 'uploads/foto/', '0', null, null, '2013-06-14 18:51:30', '2013-06-14 18:51:30');
INSERT INTO `foto` VALUES ('28', 'weekend_Schorrebakkehoeve_019__Large_.jpg', 'weekend Schorrebakkehoeve 019 (Large).jpg', null, null, '131635', 'uploads/foto/', '0', null, null, '2013-06-14 18:51:30', '2013-06-14 18:51:30');
INSERT INTO `foto` VALUES ('29', 'cups.jpg', 'cups.jpg', null, null, '3471', 'uploads/foto/', '0', null, null, '2013-06-14 18:59:43', '2013-06-14 18:59:43');
INSERT INTO `foto` VALUES ('30', 'cups.jpg', 'cups.jpg', null, null, '3471', 'uploads/foto/', '0', null, null, '2013-06-15 17:47:01', '2013-06-15 17:47:01');

-- ----------------------------
-- Table structure for `foto_vertaling`
-- ----------------------------
DROP TABLE IF EXISTS `foto_vertaling`;
CREATE TABLE `foto_vertaling` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `foto_id` int(11) DEFAULT NULL,
  `taal_id` int(11) DEFAULT NULL,
  `titel` varchar(50) DEFAULT NULL,
  `teaser` varchar(50) DEFAULT NULL,
  `inhoud` varchar(255) DEFAULT NULL,
  `vertaald` int(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=175 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of foto_vertaling
-- ----------------------------
INSERT INTO `foto_vertaling` VALUES ('169', '10', '1', 'sdsdfsdfqsdqqsdqsddsfqds', 'qsddfsdfqssdfsffsdqsddqsdsqsdqdsdqs', 'qsdqsdsdqqsddssdfdfssdsdfsdsfdsdfsd', '1');
INSERT INTO `foto_vertaling` VALUES ('170', '10', '2', 'qsdqddqsd', '', '', '1');
INSERT INTO `foto_vertaling` VALUES ('173', '9', '1', 'sdqdfqsdsdsdsddssdsdfsdffdvdfgdfgdfgdfg', 'dsqsdcdsdfsdfsdsdfsdsdqdfqdfsdfsdfsd', 'qsdqdsdsfsdsdsdfsdfsdfsdsddsfsdsdfsdfsdf', '1');
INSERT INTO `foto_vertaling` VALUES ('174', '9', '2', 'fgffdddqsdfqqqqqdddsqsddfvsdfqsdsdsdfdsfqsd', '', '', '1');

-- ----------------------------
-- Table structure for `gebruiker`
-- ----------------------------
DROP TABLE IF EXISTS `gebruiker`;
CREATE TABLE `gebruiker` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `naam` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `paswoord` varchar(50) DEFAULT NULL,
  `role` enum('USER','ADMIN','GUEST') DEFAULT NULL,
  `status` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of gebruiker
-- ----------------------------
INSERT INTO `gebruiker` VALUES ('1', 'thomas', 'thomas.vanhuysse@telenet.be', 'aline', 'GUEST', '1');

-- ----------------------------
-- Table structure for `pagina`
-- ----------------------------
DROP TABLE IF EXISTS `pagina`;
CREATE TABLE `pagina` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `label` varchar(50) DEFAULT NULL,
  `status` tinyint(1) DEFAULT NULL,
  `creationDate` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of pagina
-- ----------------------------
INSERT INTO `pagina` VALUES ('9', 'label1111', '0', null);
INSERT INTO `pagina` VALUES ('10', 'label2', '0', null);

-- ----------------------------
-- Table structure for `pagina_vertaling`
-- ----------------------------
DROP TABLE IF EXISTS `pagina_vertaling`;
CREATE TABLE `pagina_vertaling` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pagina_id` int(11) DEFAULT NULL,
  `taal_id` int(11) DEFAULT NULL,
  `titel` varchar(50) DEFAULT NULL,
  `teaser` varchar(50) DEFAULT NULL,
  `inhoud` varchar(255) DEFAULT NULL,
  `vertaald` int(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=183 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of pagina_vertaling
-- ----------------------------
INSERT INTO `pagina_vertaling` VALUES ('177', '10', '1', 'sdsdfsdfqsdqqsdqsddsfqds', 'qsddfsdfqssdfsffsdqsddqsdsqsdqdsdqs', 'qsdqsdsdqqsddssdfdfssdsdfsdsfdsdfsd', '1');
INSERT INTO `pagina_vertaling` VALUES ('178', '10', '2', 'qsdqddqsd', '', '', '1');
INSERT INTO `pagina_vertaling` VALUES ('179', '9', '1', 'sdqdfqsdsdsdsddssdsdfsdffdvdfgdfgdfgdfg', 'dsqsdcdsdfsdfsdsdfsdsdqdfqdfsdfsdfsd', 'qsdqdsdsfsdsdsdfsdfsdfsdsddsfsdsdfsdfsdf', '1');
INSERT INTO `pagina_vertaling` VALUES ('180', '9', '2', 'fgffdddqsdfqqqqqdddsqsddfvsdfqsdsdsdfdsfqsd', '', '', '1');
INSERT INTO `pagina_vertaling` VALUES ('181', '27', '1', 'dfsfgsdf', 'qsddfsdfqssdfsffsddfs', 'sdfdffgdsdf', '1');
INSERT INTO `pagina_vertaling` VALUES ('182', '27', '2', '', '', '', '0');

-- ----------------------------
-- Table structure for `product`
-- ----------------------------
DROP TABLE IF EXISTS `product`;
CREATE TABLE `product` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `label` varchar(50) DEFAULT NULL,
  `status` tinyint(1) DEFAULT NULL,
  `prijs` double DEFAULT NULL,
  `homepagina` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of product
-- ----------------------------
INSERT INTO `product` VALUES ('1', 'SRH5 S637', '1', '50', '1');
INSERT INTO `product` VALUES ('2', 'SRH5 S649', '1', '60', '1');
INSERT INTO `product` VALUES ('3', 'SRH5 S65', '1', '70', '1');
INSERT INTO `product` VALUES ('4', 'KRU5 S01', '1', '200', '1');
INSERT INTO `product` VALUES ('5', 'CUP5 S03', '1', '300', '1');

-- ----------------------------
-- Table structure for `productfoto`
-- ----------------------------
DROP TABLE IF EXISTS `productfoto`;
CREATE TABLE `productfoto` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `IDProduct` int(11) DEFAULT NULL,
  `IDFoto` int(11) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of productfoto
-- ----------------------------
INSERT INTO `productfoto` VALUES ('1', '1', '18');
INSERT INTO `productfoto` VALUES ('2', '2', '20');
INSERT INTO `productfoto` VALUES ('3', '3', '22');
INSERT INTO `productfoto` VALUES ('4', '4', '23');
INSERT INTO `productfoto` VALUES ('5', '5', '24');

-- ----------------------------
-- Table structure for `productlocale`
-- ----------------------------
DROP TABLE IF EXISTS `productlocale`;
CREATE TABLE `productlocale` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `IDProduct` int(11) DEFAULT NULL,
  `titel` varchar(50) DEFAULT NULL,
  `teaser` varchar(50) DEFAULT NULL,
  `omschrijving` varchar(50) DEFAULT NULL,
  `locale` varchar(5) DEFAULT NULL,
  `vertaald` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`ID`),
  KEY `IDProduct` (`IDProduct`),
  CONSTRAINT `productlocale_ibfk_1` FOREIGN KEY (`IDProduct`) REFERENCES `product` (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of productlocale
-- ----------------------------
INSERT INTO `productlocale` VALUES ('1', '1', 'Nougatine', null, null, 'nl_BE', '1');
INSERT INTO `productlocale` VALUES ('2', '2', 'Verjaardag', null, null, 'nl_BE', '1');
INSERT INTO `productlocale` VALUES ('3', '3', 'Halloween', null, null, 'nl_BE', '1');
INSERT INTO `productlocale` VALUES ('4', '4', 'Krul', null, null, 'nl_BE', '1');
INSERT INTO `productlocale` VALUES ('5', '5', 'Cups', null, null, 'nl_BE', '1');

-- ----------------------------
-- Table structure for `taal`
-- ----------------------------
DROP TABLE IF EXISTS `taal`;
CREATE TABLE `taal` (
  `id` int(11) NOT NULL DEFAULT '0',
  `code` varchar(2) DEFAULT NULL,
  `omschrijving` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of taal
-- ----------------------------
INSERT INTO `taal` VALUES ('1', 'nl', 'nederlands');
INSERT INTO `taal` VALUES ('2', 'fr', 'frans');
