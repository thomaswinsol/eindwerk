/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50150
Source Host           : localhost:3306
Source Database       : webwinkel

Target Server Type    : MYSQL
Target Server Version : 50150
File Encoding         : 65001

Date: 2013-06-20 16:35:55
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `bestellingdetail`
-- ----------------------------
DROP TABLE IF EXISTS `bestellingdetail`;
CREATE TABLE `bestellingdetail` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `IDBestelling` int(11) DEFAULT NULL,
  `IDProduct` int(11) DEFAULT NULL,
  `AantalBesteld` double DEFAULT NULL,
  `Prijs` double DEFAULT NULL,
  `Totaal` double DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDBestelling` (`IDBestelling`),
  CONSTRAINT `bestellingdetail_ibfk_1` FOREIGN KEY (`IDBestelling`) REFERENCES `bestellingheader` (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=64 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of bestellingdetail
-- ----------------------------
INSERT INTO `bestellingdetail` VALUES ('60', '73', '6', '3', null, '0');
INSERT INTO `bestellingdetail` VALUES ('61', '75', '6', '4', '75', '300');
INSERT INTO `bestellingdetail` VALUES ('62', '76', '6', '2', '75', '150');
INSERT INTO `bestellingdetail` VALUES ('63', '77', '7', '2', '100', '200');

-- ----------------------------
-- Table structure for `bestellingheader`
-- ----------------------------
DROP TABLE IF EXISTS `bestellingheader`;
CREATE TABLE `bestellingheader` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `IDGebruiker` int(11) DEFAULT NULL,
  `datumbestelling` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `referentie` varchar(50) DEFAULT NULL,
  `leveringsadres` varchar(50) DEFAULT NULL,
  `status` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=78 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of bestellingheader
-- ----------------------------
INSERT INTO `bestellingheader` VALUES ('73', '1', '2013-06-20 11:48:04', 'test', '...', null);
INSERT INTO `bestellingheader` VALUES ('74', '1', '2013-06-20 11:49:23', 'test', '...', null);
INSERT INTO `bestellingheader` VALUES ('75', '1', '2013-06-20 11:49:51', 'test', '...', null);
INSERT INTO `bestellingheader` VALUES ('76', '1', '2013-06-20 11:50:38', 'test', '...', null);
INSERT INTO `bestellingheader` VALUES ('77', '0', '2013-06-20 16:31:07', 'xxx', '...', '1');

-- ----------------------------
-- Table structure for `categorie`
-- ----------------------------
DROP TABLE IF EXISTS `categorie`;
CREATE TABLE `categorie` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `label` varchar(20) DEFAULT NULL,
  `status` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of categorie
-- ----------------------------
INSERT INTO `categorie` VALUES ('1', 'Label Kledij', '1');
INSERT INTO `categorie` VALUES ('2', 'Label Gereedschap', '1');

-- ----------------------------
-- Table structure for `categorie_vertaling`
-- ----------------------------
DROP TABLE IF EXISTS `categorie_vertaling`;
CREATE TABLE `categorie_vertaling` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `categorie_id` int(11) DEFAULT NULL,
  `taal_id` int(11) DEFAULT NULL,
  `titel` varchar(50) DEFAULT NULL,
  `vertaald` int(1) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `categorie_id` (`categorie_id`),
  CONSTRAINT `categorie_vertaling_ibfk_1` FOREIGN KEY (`categorie_id`) REFERENCES `categorie` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=295 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of categorie_vertaling
-- ----------------------------
INSERT INTO `categorie_vertaling` VALUES ('289', '1', '1', 'Kledij', '1');
INSERT INTO `categorie_vertaling` VALUES ('290', '1', '2', '', '0');
INSERT INTO `categorie_vertaling` VALUES ('291', '1', '3', '', '0');
INSERT INTO `categorie_vertaling` VALUES ('292', '2', '1', 'Gereedschap', '1');
INSERT INTO `categorie_vertaling` VALUES ('293', '2', '2', '', '0');
INSERT INTO `categorie_vertaling` VALUES ('294', '2', '3', '', '0');

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
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of foto
-- ----------------------------
INSERT INTO `foto` VALUES ('1', 'F585401290.jpg', 'F585401290.jpg', null, null, '33548', 'uploads/foto/', '0', '111', '0', '2013-06-16 15:39:08', '2013-06-16 15:39:08');
INSERT INTO `foto` VALUES ('2', 'F580401341.jpg', 'F580401341.jpg', null, null, '38010', 'uploads/foto/', '0', '111', '0', '2013-06-16 15:39:08', '2013-06-16 15:39:08');
INSERT INTO `foto` VALUES ('3', 'F585300686.jpg', 'F585300686.jpg', null, null, '33773', 'uploads/foto/', '0', '9999', '0', '2013-06-16 15:39:09', '2013-06-16 15:39:09');
INSERT INTO `foto` VALUES ('4', 'F585300910.jpg', 'F585300910.jpg', null, null, '26472', 'uploads/foto/', '0', '111', '0', '2013-06-16 15:39:09', '2013-06-16 15:39:09');
INSERT INTO `foto` VALUES ('5', 'F455000078.jpg', 'F455000078.jpg', null, null, '26090', 'uploads/foto/', '0', '111', '0', '2013-06-16 16:50:54', '2013-06-16 16:50:54');
INSERT INTO `foto` VALUES ('6', 'F585990724.jpg', 'F585990724.jpg', null, null, '48360', 'uploads/foto/', '0', '111', '0', '2013-06-16 20:11:42', '2013-06-16 20:11:42');
INSERT INTO `foto` VALUES ('7', 'F065000009.jpg', 'F065000009.jpg', null, null, '98641', 'uploads/foto/', '0', '111', '0', '2013-06-17 19:48:07', '2013-06-17 19:48:07');

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
  PRIMARY KEY (`id`),
  KEY `foto_id` (`foto_id`),
  CONSTRAINT `foto_vertaling_ibfk_1` FOREIGN KEY (`foto_id`) REFERENCES `foto` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of foto_vertaling
-- ----------------------------
INSERT INTO `foto_vertaling` VALUES ('8', '2', '1', 'nl', 'nl', 'nl', '1');
INSERT INTO `foto_vertaling` VALUES ('9', '2', '2', 'fr', 'fr', 'fr', '1');
INSERT INTO `foto_vertaling` VALUES ('10', '2', '3', '', '', '', '0');
INSERT INTO `foto_vertaling` VALUES ('29', '1', '1', 'foto1', 'foto1', 'foto1', '1');
INSERT INTO `foto_vertaling` VALUES ('30', '1', '2', '', '', '', '0');
INSERT INTO `foto_vertaling` VALUES ('31', '1', '3', '', '', '', '0');
INSERT INTO `foto_vertaling` VALUES ('32', '3', '1', '', '', '', '0');
INSERT INTO `foto_vertaling` VALUES ('33', '3', '2', '', '', '', '0');
INSERT INTO `foto_vertaling` VALUES ('34', '3', '3', '', '', '', '0');

-- ----------------------------
-- Table structure for `gebruiker`
-- ----------------------------
DROP TABLE IF EXISTS `gebruiker`;
CREATE TABLE `gebruiker` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `naam` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `paswoord` varchar(50) DEFAULT NULL,
  `idrole` int(11) DEFAULT NULL,
  `status` tinyint(1) DEFAULT NULL,
  `eId` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of gebruiker
-- ----------------------------
INSERT INTO `gebruiker` VALUES ('1', 'webmaster', 'webmaster@syntrawest.be', '50a9c7dbf0fa09e8969978317dca12e8', '2', '1', null);
INSERT INTO `gebruiker` VALUES ('5', 'thomas', 'thomas.vanhuysse@winsol.be', '8d3152ebd103cea3509c7dcfad8f8c10', '1', '1', '5.51c09c08490a06.39894972');

-- ----------------------------
-- Table structure for `gebruiker_role`
-- ----------------------------
DROP TABLE IF EXISTS `gebruiker_role`;
CREATE TABLE `gebruiker_role` (
  `id` int(11) NOT NULL DEFAULT '0',
  `role` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of gebruiker_role
-- ----------------------------
INSERT INTO `gebruiker_role` VALUES ('1', 'USER');
INSERT INTO `gebruiker_role` VALUES ('2', 'DEALER');
INSERT INTO `gebruiker_role` VALUES ('3', 'ADMIN');

-- ----------------------------
-- Table structure for `locale`
-- ----------------------------
DROP TABLE IF EXISTS `locale`;
CREATE TABLE `locale` (
  `id` int(11) NOT NULL DEFAULT '0',
  `locale` varchar(5) DEFAULT NULL,
  `idtaal` int(11) DEFAULT NULL,
  `omschrijving` varchar(50) DEFAULT NULL,
  `status` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of locale
-- ----------------------------
INSERT INTO `locale` VALUES ('1', 'nl_BE', '1', 'Nederlands', '1');
INSERT INTO `locale` VALUES ('2', 'fr_BE', '2', 'Frans', '1');
INSERT INTO `locale` VALUES ('3', 'en_GB', '3', 'Engels', '1');
INSERT INTO `locale` VALUES ('4', 'de_DE', '4', 'Duits', '0');

-- ----------------------------
-- Table structure for `menu`
-- ----------------------------
DROP TABLE IF EXISTS `menu`;
CREATE TABLE `menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `label` varchar(50) DEFAULT NULL,
  `module` varchar(50) DEFAULT NULL,
  `action` varchar(50) DEFAULT NULL,
  `controller` varchar(50) DEFAULT NULL,
  `params` varchar(50) DEFAULT NULL,
  `status` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of menu
-- ----------------------------
INSERT INTO `menu` VALUES ('1', 'menuHome', 'default', 'home', 'index', null, '1');
INSERT INTO `menu` VALUES ('2', 'menuProduct', 'admin', 'lijst', 'product', null, '1');
INSERT INTO `menu` VALUES ('3', 'menuCategorie', 'admin', 'lijst', 'categorie', null, '1');
INSERT INTO `menu` VALUES ('4', 'menuFoto', 'admin', 'lijst', 'foto', null, '1');
INSERT INTO `menu` VALUES ('5', 'menuPagina', 'admin', 'lijst', 'pagina', null, '1');
INSERT INTO `menu` VALUES ('6', 'menuUser', 'admin', 'lijst', 'gebruiker', 'idrole,1', '1');

-- ----------------------------
-- Table structure for `menu_role`
-- ----------------------------
DROP TABLE IF EXISTS `menu_role`;
CREATE TABLE `menu_role` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idmenu` int(11) DEFAULT NULL,
  `idrole` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idmenu` (`idmenu`),
  KEY `idrole` (`idrole`),
  CONSTRAINT `menu_role_ibfk_1` FOREIGN KEY (`idmenu`) REFERENCES `menu` (`id`),
  CONSTRAINT `menu_role_ibfk_2` FOREIGN KEY (`idrole`) REFERENCES `gebruiker_role` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of menu_role
-- ----------------------------
INSERT INTO `menu_role` VALUES ('1', '1', '1');
INSERT INTO `menu_role` VALUES ('3', '1', '2');
INSERT INTO `menu_role` VALUES ('4', '2', '2');
INSERT INTO `menu_role` VALUES ('5', '3', '2');
INSERT INTO `menu_role` VALUES ('6', '4', '2');
INSERT INTO `menu_role` VALUES ('7', '5', '2');
INSERT INTO `menu_role` VALUES ('8', '6', '2');

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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of pagina
-- ----------------------------
INSERT INTO `pagina` VALUES ('1', 'about', '1', null);

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
  PRIMARY KEY (`id`),
  KEY `pagina_id` (`pagina_id`),
  CONSTRAINT `pagina_vertaling_ibfk_1` FOREIGN KEY (`pagina_id`) REFERENCES `pagina` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=42 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of pagina_vertaling
-- ----------------------------
INSERT INTO `pagina_vertaling` VALUES ('39', '1', '1', 'info', 'pag1', 'bla bla bla\r\nxxx\r\nxxx\r\nxxx\r\nyyy\r\nyyy\r\nyyy\r\nzzz\r\nzzz\r\nzzz', '1');
INSERT INTO `pagina_vertaling` VALUES ('40', '1', '2', 'xxx', '', '', '1');
INSERT INTO `pagina_vertaling` VALUES ('41', '1', '3', '', '', '', '0');

-- ----------------------------
-- Table structure for `product`
-- ----------------------------
DROP TABLE IF EXISTS `product`;
CREATE TABLE `product` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `label` varchar(50) DEFAULT NULL,
  `status` tinyint(1) DEFAULT NULL,
  `eenheidsprijs` double DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of product
-- ----------------------------
INSERT INTO `product` VALUES ('6', 'label trui', '3', '75');
INSERT INTO `product` VALUES ('7', 'label broek', '3', '100');
INSERT INTO `product` VALUES ('8', 'label boormachine', '1', '150');
INSERT INTO `product` VALUES ('9', 'label t-shirt', '1', '45');
INSERT INTO `product` VALUES ('10', 'label jas', '1', '45');
INSERT INTO `product` VALUES ('11', 'label broek2', '1', '100');
INSERT INTO `product` VALUES ('12', 'label montagelijm', '1', '0');

-- ----------------------------
-- Table structure for `product_categorie`
-- ----------------------------
DROP TABLE IF EXISTS `product_categorie`;
CREATE TABLE `product_categorie` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idproduct` int(11) DEFAULT NULL,
  `idcategorie` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idproduct` (`idproduct`),
  KEY `idcategorie` (`idcategorie`),
  CONSTRAINT `product_categorie_ibfk_1` FOREIGN KEY (`idproduct`) REFERENCES `product` (`id`),
  CONSTRAINT `product_categorie_ibfk_2` FOREIGN KEY (`idcategorie`) REFERENCES `categorie` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of product_categorie
-- ----------------------------
INSERT INTO `product_categorie` VALUES ('7', '9', '1');
INSERT INTO `product_categorie` VALUES ('9', '10', '1');
INSERT INTO `product_categorie` VALUES ('10', '11', '1');
INSERT INTO `product_categorie` VALUES ('14', '7', '1');
INSERT INTO `product_categorie` VALUES ('15', '7', '2');
INSERT INTO `product_categorie` VALUES ('16', '6', '1');

-- ----------------------------
-- Table structure for `product_foto`
-- ----------------------------
DROP TABLE IF EXISTS `product_foto`;
CREATE TABLE `product_foto` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idproduct` int(11) DEFAULT NULL,
  `idfoto` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idproduct` (`idproduct`),
  KEY `idfoto` (`idfoto`),
  CONSTRAINT `product_foto_ibfk_1` FOREIGN KEY (`idproduct`) REFERENCES `product` (`id`),
  CONSTRAINT `product_foto_ibfk_2` FOREIGN KEY (`idfoto`) REFERENCES `foto` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of product_foto
-- ----------------------------
INSERT INTO `product_foto` VALUES ('1', '6', '1');
INSERT INTO `product_foto` VALUES ('3', '7', '2');
INSERT INTO `product_foto` VALUES ('4', '8', '5');
INSERT INTO `product_foto` VALUES ('5', '9', '6');
INSERT INTO `product_foto` VALUES ('6', '10', '3');
INSERT INTO `product_foto` VALUES ('7', '11', '4');
INSERT INTO `product_foto` VALUES ('8', '12', '7');

-- ----------------------------
-- Table structure for `product_status`
-- ----------------------------
DROP TABLE IF EXISTS `product_status`;
CREATE TABLE `product_status` (
  `id` int(11) NOT NULL DEFAULT '0',
  `omschrijving` varchar(50) DEFAULT NULL,
  `status` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of product_status
-- ----------------------------
INSERT INTO `product_status` VALUES ('1', 'actief', '1');
INSERT INTO `product_status` VALUES ('2', 'inactief', '1');
INSERT INTO `product_status` VALUES ('3', 'product in de kijker', '1');

-- ----------------------------
-- Table structure for `product_vertaling`
-- ----------------------------
DROP TABLE IF EXISTS `product_vertaling`;
CREATE TABLE `product_vertaling` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) DEFAULT NULL,
  `taal_id` int(11) DEFAULT NULL,
  `titel` varchar(50) DEFAULT NULL,
  `teaser` varchar(50) DEFAULT NULL,
  `inhoud` varchar(255) DEFAULT NULL,
  `vertaald` int(1) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `product_id` (`product_id`),
  KEY `taal_id` (`taal_id`),
  CONSTRAINT `product_vertaling_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`),
  CONSTRAINT `product_vertaling_ibfk_2` FOREIGN KEY (`taal_id`) REFERENCES `taal` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=132 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of product_vertaling
-- ----------------------------
INSERT INTO `product_vertaling` VALUES ('86', '8', '1', 'boormachine', '...', '...', '1');
INSERT INTO `product_vertaling` VALUES ('87', '8', '2', '', '', '', '0');
INSERT INTO `product_vertaling` VALUES ('88', '8', '3', '', '', '', '0');
INSERT INTO `product_vertaling` VALUES ('89', '8', '4', '', '', '', '0');
INSERT INTO `product_vertaling` VALUES ('90', '8', '5', '', '', '', '0');
INSERT INTO `product_vertaling` VALUES ('91', '9', '1', 't-shirt', '', '', '1');
INSERT INTO `product_vertaling` VALUES ('92', '9', '2', '', '', '', '0');
INSERT INTO `product_vertaling` VALUES ('93', '9', '3', '', '', '', '0');
INSERT INTO `product_vertaling` VALUES ('94', '9', '4', '', '', '', '0');
INSERT INTO `product_vertaling` VALUES ('95', '9', '5', '', '', '', '0');
INSERT INTO `product_vertaling` VALUES ('101', '11', '1', 'broek2', '', '', '1');
INSERT INTO `product_vertaling` VALUES ('102', '11', '2', '', '', '', '0');
INSERT INTO `product_vertaling` VALUES ('103', '11', '3', '', '', '', '0');
INSERT INTO `product_vertaling` VALUES ('104', '11', '4', '', '', '', '0');
INSERT INTO `product_vertaling` VALUES ('105', '11', '5', '', '', '', '0');
INSERT INTO `product_vertaling` VALUES ('111', '12', '1', 'montagelijm', '', '', '1');
INSERT INTO `product_vertaling` VALUES ('112', '12', '2', '', '', '', '0');
INSERT INTO `product_vertaling` VALUES ('113', '12', '3', '', '', '', '0');
INSERT INTO `product_vertaling` VALUES ('117', '10', '1', 'jas', '', 'ned', '1');
INSERT INTO `product_vertaling` VALUES ('118', '10', '2', '', '', 'frans', '0');
INSERT INTO `product_vertaling` VALUES ('119', '10', '3', '', '', '', '0');
INSERT INTO `product_vertaling` VALUES ('123', '7', '1', 'broek', 'broek', 'bla bla bla', '1');
INSERT INTO `product_vertaling` VALUES ('124', '7', '2', 'dsdfsdf', 'qsdd', 'qsd', '1');
INSERT INTO `product_vertaling` VALUES ('125', '7', '3', '', '', '', '0');
INSERT INTO `product_vertaling` VALUES ('129', '6', '1', 'trui', 'trui', 'bla bla bla dsfjkdfsqjkmldsfqjk ds\r\ndsqlkjdsfjklmdsfqdfqslmjkdsq\r\ndskklmdsqflÃ¹\r\ndfqskldqsflmdqs\r\n\r\ndsqfkldsqfÃ¹mdqsf\r\n\r\ndkldqsldsf\r\ndqsfdsfqdf', '1');
INSERT INTO `product_vertaling` VALUES ('130', '6', '2', 'pull', 'pull', 'bla bla bla', '1');
INSERT INTO `product_vertaling` VALUES ('131', '6', '3', '', '', '', '0');

-- ----------------------------
-- Table structure for `taal`
-- ----------------------------
DROP TABLE IF EXISTS `taal`;
CREATE TABLE `taal` (
  `id` int(11) NOT NULL DEFAULT '0',
  `code` varchar(2) DEFAULT NULL,
  `omschrijving` varchar(50) DEFAULT NULL,
  `status` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of taal
-- ----------------------------
INSERT INTO `taal` VALUES ('1', 'nl', 'nederlands', '1');
INSERT INTO `taal` VALUES ('2', 'fr', 'frans', '1');
INSERT INTO `taal` VALUES ('3', 'en', 'engels', '1');
INSERT INTO `taal` VALUES ('4', 'de', 'duits', '0');
INSERT INTO `taal` VALUES ('5', 'es', 'spaans', '0');
