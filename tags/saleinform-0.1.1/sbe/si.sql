/*
SQLyog Enterprise - MySQL GUI v6.14
MySQL - 5.0.45-log : Database - saleinform
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

USE `saleinform`;

/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

/*Table structure for table `_advertises` */

CREATE TABLE `_advertises` (
  `rid` int(11) NOT NULL auto_increment,
  `content` varchar(255) NOT NULL,
  `archive` tinyint(1) NOT NULL default '0',
  `descr` text,
  `createDT` datetime NOT NULL,
  `modifyDT` datetime NOT NULL,
  `_bareas_rid` int(11) NOT NULL,
  `link` varchar(255) NOT NULL,
  PRIMARY KEY  (`rid`),
  UNIQUE KEY `_secondary` (`content`),
  KEY `FK__advertises` (`_bareas_rid`),
  CONSTRAINT `FK__advertises` FOREIGN KEY (`_bareas_rid`) REFERENCES `_bareas` (`rid`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

/*Trigger structure for table `_advertises` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `Trigger_CreateRowDT_advertises` */$$

/*!50003 CREATE TRIGGER `Trigger_CreateRowDT_advertises` BEFORE INSERT ON `_advertises` FOR EACH ROW BEGIN
 SET NEW.createDT = now();
 SET NEW.modifyDT = now();
 END */$$


/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `Trigger_ModifyRowDT_advertises` */$$

/*!50003 CREATE TRIGGER `Trigger_ModifyRowDT_advertises` BEFORE UPDATE ON `_advertises` FOR EACH ROW BEGIN
 SET NEW.modifyDT = now();
 END */$$


DELIMITER ;

/*Table structure for table `_availableparsvalues` */

CREATE TABLE `_availableparsvalues` (
  `rid` int(11) NOT NULL auto_increment,
  `_catpars_rid` int(11) NOT NULL,
  `value` varchar(255) character set utf8 NOT NULL,
  `archive` tinyint(1) NOT NULL default '0',
  `descr` text character set utf8,
  `createDT` datetime NOT NULL default '0000-00-00 00:00:00',
  `modifyDT` datetime NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`rid`),
  UNIQUE KEY `_secondary` (`_catpars_rid`),
  UNIQUE KEY `_thierd` (`value`)
) ENGINE=InnoDB DEFAULT CHARSET=cp1251;

/*Trigger structure for table `_availableparsvalues` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `Trigger_CreateRowDT_availableparsvalues` */$$

/*!50003 CREATE TRIGGER `Trigger_CreateRowDT_availableparsvalues` BEFORE INSERT ON `_availableparsvalues` FOR EACH ROW BEGIN
 SET NEW.createDT = now();
 SET NEW.modifyDT = now();
 END */$$


/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `Trigger_ModifyRowDT_availableparsvalues` */$$

/*!50003 CREATE TRIGGER `Trigger_ModifyRowDT_availableparsvalues` BEFORE UPDATE ON `_availableparsvalues` FOR EACH ROW BEGIN
 SET NEW.modifyDT = now();
 END */$$


DELIMITER ;

/*Table structure for table `_availabletypes` */

CREATE TABLE `_availabletypes` (
  `rid` int(11) NOT NULL auto_increment,
  `cod` varchar(45) default NULL,
  `name` varchar(255) default NULL,
  `archive` tinyint(1) NOT NULL default '0',
  `descr` text,
  `createDT` datetime NOT NULL,
  `modifyDT` datetime NOT NULL,
  PRIMARY KEY  (`rid`),
  UNIQUE KEY `_secondary` (`cod`),
  UNIQUE KEY `_thierd` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

/*Trigger structure for table `_availabletypes` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `Trigger_CreateRowDT_availabletypes` */$$

/*!50003 CREATE TRIGGER `Trigger_CreateRowDT_availabletypes` BEFORE INSERT ON `_availabletypes` FOR EACH ROW BEGIN
 SET NEW.createDT = now();
 SET NEW.modifyDT = now();
 END */$$


/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `Trigger_ModifyRowDT_availabletypes` */$$

/*!50003 CREATE TRIGGER `Trigger_ModifyRowDT_availabletypes` BEFORE UPDATE ON `_availabletypes` FOR EACH ROW BEGIN
 SET NEW.modifyDT = now();
 END */$$


DELIMITER ;

/*Table structure for table `_bareas` */

CREATE TABLE `_bareas` (
  `rid` int(11) NOT NULL auto_increment,
  `cod` varchar(25) NOT NULL,
  `archive` tinyint(1) NOT NULL default '0',
  `descr` text,
  `createDT` datetime NOT NULL,
  `modifyDT` datetime NOT NULL,
  `areatype` varchar(255) NOT NULL,
  `areaposition` varchar(255) NOT NULL,
  PRIMARY KEY  (`rid`),
  UNIQUE KEY `_secondary` (`cod`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

/*Trigger structure for table `_bareas` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `Trigger_CreateRowDT_bareas` */$$

/*!50003 CREATE TRIGGER `Trigger_CreateRowDT_bareas` BEFORE INSERT ON `_bareas` FOR EACH ROW BEGIN
 SET NEW.createDT = now();
 SET NEW.modifyDT = now();
 END */$$


/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `Trigger_ModifyRowDT_bareas` */$$

/*!50003 CREATE TRIGGER `Trigger_ModifyRowDT_bareas` BEFORE UPDATE ON `_bareas` FOR EACH ROW BEGIN
 SET NEW.modifyDT = now();
 END */$$


DELIMITER ;

/*Table structure for table `_brands` */

CREATE TABLE `_brands` (
  `rid` int(11) NOT NULL auto_increment,
  `name` varchar(255) default NULL,
  `url` text,
  `archive` tinyint(1) NOT NULL default '0',
  `descr` text,
  `createDT` datetime NOT NULL,
  `modifyDT` datetime NOT NULL,
  PRIMARY KEY  (`rid`),
  UNIQUE KEY `_secondary` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=3077 DEFAULT CHARSET=utf8;

/*Trigger structure for table `_brands` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `Trigger_CreateRowDT_brands` */$$

/*!50003 CREATE TRIGGER `Trigger_CreateRowDT_brands` BEFORE INSERT ON `_brands` FOR EACH ROW BEGIN
 SET NEW.createDT = now();
 SET NEW.modifyDT = now();
 END */$$


/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `Trigger_ModifyRowDT_brands` */$$

/*!50003 CREATE TRIGGER `Trigger_ModifyRowDT_brands` BEFORE UPDATE ON `_brands` FOR EACH ROW BEGIN
 SET NEW.modifyDT = now();
 END */$$


DELIMITER ;

/*Table structure for table `_brandsassoc` */

CREATE TABLE `_brandsassoc` (
  `rid` int(11) NOT NULL auto_increment,
  `_brands_rid` int(11) NOT NULL,
  `name` varchar(255) default NULL,
  `archive` tinyint(1) NOT NULL default '0',
  `descr` text,
  `createDT` datetime NOT NULL,
  `modifyDT` datetime NOT NULL,
  PRIMARY KEY  (`rid`),
  UNIQUE KEY `_secondary` (`name`),
  KEY `_brands_rid` (`_brands_rid`),
  CONSTRAINT `FK__brandsassoc_1` FOREIGN KEY (`_brands_rid`) REFERENCES `_brands` (`rid`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

/*Trigger structure for table `_brandsassoc` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `Trigger_CreateRowDT_brandsassoc` */$$

/*!50003 CREATE TRIGGER `Trigger_CreateRowDT_brandsassoc` BEFORE INSERT ON `_brandsassoc` FOR EACH ROW BEGIN
 SET NEW.createDT = now();
 SET NEW.modifyDT = now();
 END */$$


/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `Trigger_ModifyRowDT_brandsassoc` */$$

/*!50003 CREATE TRIGGER `Trigger_ModifyRowDT_brandsassoc` BEFORE UPDATE ON `_brandsassoc` FOR EACH ROW BEGIN
 SET NEW.modifyDT = now();
 END */$$


DELIMITER ;

/*Table structure for table `_categories` */

CREATE TABLE `_categories` (
  `rid` int(11) NOT NULL auto_increment,
  `_categories_rid` int(11) NOT NULL,
  `name` varchar(45) NOT NULL,
  `image` blob,
  `archive` tinyint(1) NOT NULL default '0',
  `descr` text,
  `createDT` datetime NOT NULL,
  `modifyDT` datetime NOT NULL,
  `isgrouped` tinyint(1) default '0',
  `iscompared` tinyint(1) default '0',
  PRIMARY KEY  (`rid`),
  UNIQUE KEY `_secondary` (`name`,`_categories_rid`),
  KEY `_categories_rid` (`_categories_rid`)
) ENGINE=InnoDB AUTO_INCREMENT=1598 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

/*Trigger structure for table `_categories` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `Trigger_CreateRowDT_categories` */$$

/*!50003 CREATE TRIGGER `Trigger_CreateRowDT_categories` BEFORE INSERT ON `_categories` FOR EACH ROW BEGIN
 SET NEW.createDT = now();
 SET NEW.modifyDT = now();
 END */$$


/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `Trigger_ModifyRowDT_categories` */$$

/*!50003 CREATE TRIGGER `Trigger_ModifyRowDT_categories` BEFORE UPDATE ON `_categories` FOR EACH ROW BEGIN
 SET NEW.modifyDT = now();
 END */$$


DELIMITER ;

/*Table structure for table `_categoriesimages` */

CREATE TABLE `_categoriesimages` (
  `rid` int(11) NOT NULL auto_increment,
  `_categories_rid` int(11) NOT NULL,
  `name` varchar(45) character set utf8 default NULL,
  `type` varchar(45) character set utf8 default NULL,
  `size` varchar(45) character set utf8 default NULL,
  `image` blob,
  `archive` tinyint(1) default '0',
  `descr` text character set utf8,
  `createDT` datetime default NULL,
  `modifyDT` datetime default NULL,
  `imgtype` varchar(45) character set utf8 default NULL,
  PRIMARY KEY  (`rid`),
  KEY `FK__categoriesimages` (`_categories_rid`),
  CONSTRAINT `FK__categoriesimages` FOREIGN KEY (`_categories_rid`) REFERENCES `_categories` (`rid`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

/*Trigger structure for table `_categoriesimages` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `Trigger_CreateRowDT_categoriesimages` */$$

/*!50003 CREATE TRIGGER `Trigger_CreateRowDT_categoriesimages` BEFORE INSERT ON `_categoriesimages` FOR EACH ROW BEGIN
 SET NEW.createDT = now();
 SET NEW.modifyDT = now();
 END */$$


/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `Trigger_ModifyRowDT_categoriesimages` */$$

/*!50003 CREATE TRIGGER `Trigger_ModifyRowDT_categoriesimages` BEFORE UPDATE ON `_categoriesimages` FOR EACH ROW BEGIN
 SET NEW.modifyDT = now();
 END */$$


DELIMITER ;

/*Table structure for table `_catpars` */

CREATE TABLE `_catpars` (
  `rid` int(11) NOT NULL auto_increment,
  `_categories_rid` int(11) NOT NULL,
  `_pars_rid` int(11) NOT NULL,
  `_catpars_rid` int(11) default NULL,
  `numorder` int(11) default NULL,
  `filtered` tinyint(1) NOT NULL default '0',
  `archive` tinyint(1) NOT NULL default '0',
  `descr` text,
  `createDT` datetime NOT NULL,
  `modifyDT` datetime NOT NULL,
  `likeness` tinyint(1) NOT NULL default '0',
  `ptype` varchar(10) NOT NULL default 'WARE',
  `dpart` tinyint(1) NOT NULL default '0' COMMENT 'Указывает что данный параметр используется в кратком описаниии',
  PRIMARY KEY  (`rid`),
  UNIQUE KEY `_secondary` (`_categories_rid`,`_pars_rid`,`_catpars_rid`),
  KEY `_pars_rid` (`_pars_rid`),
  KEY `_catpars_rid` (`_catpars_rid`),
  CONSTRAINT `FK__catpars_1` FOREIGN KEY (`_categories_rid`) REFERENCES `_categories` (`rid`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK__catpars_2` FOREIGN KEY (`_pars_rid`) REFERENCES `_pars` (`rid`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3820 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

/*Trigger structure for table `_catpars` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `Trigger_CreateRowDT_catpars` */$$

/*!50003 CREATE TRIGGER `Trigger_CreateRowDT_catpars` BEFORE INSERT ON `_catpars` FOR EACH ROW BEGIN
 SET NEW.createDT = now();
 SET NEW.modifyDT = now();
 END */$$


/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `Trigger_ModifyRowDT_catpars` */$$

/*!50003 CREATE TRIGGER `Trigger_ModifyRowDT_catpars` BEFORE UPDATE ON `_catpars` FOR EACH ROW BEGIN
 SET NEW.modifyDT = now();
 END */$$


DELIMITER ;

/*Table structure for table `_cities` */

CREATE TABLE `_cities` (
  `rid` int(11) NOT NULL auto_increment,
  `_regions_rid` int(11) NOT NULL,
  `name` varchar(45) NOT NULL,
  `archive` tinyint(1) NOT NULL default '0',
  `descr` text,
  `createDT` datetime NOT NULL,
  `modifyDT` datetime NOT NULL,
  PRIMARY KEY  (`rid`),
  UNIQUE KEY `_secondary` (`_regions_rid`,`name`),
  CONSTRAINT `FK__cities_1` FOREIGN KEY (`_regions_rid`) REFERENCES `_regions` (`rid`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=1378 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

/*Trigger structure for table `_cities` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `Trigger_CreateRowDT_cities` */$$

/*!50003 CREATE TRIGGER `Trigger_CreateRowDT_cities` BEFORE INSERT ON `_cities` FOR EACH ROW BEGIN
 SET NEW.createDT = now();
 SET NEW.modifyDT = now();
 END */$$


/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `Trigger_ModifyRowDT_cities` */$$

/*!50003 CREATE TRIGGER `Trigger_ModifyRowDT_cities` BEFORE UPDATE ON `_cities` FOR EACH ROW BEGIN
 SET NEW.modifyDT = now();
 END */$$


DELIMITER ;

/*Table structure for table `_clcategories` */

CREATE TABLE `_clcategories` (
  `rid` int(11) NOT NULL auto_increment,
  `_categories_rid` int(11) default NULL,
  `_clcategories_rid` int(11) NOT NULL,
  `_clients_rid` int(11) NOT NULL,
  `clrid` int(11) default NULL,
  `name` varchar(45) NOT NULL,
  `image` blob,
  `archive` tinyint(1) NOT NULL default '0',
  `descr` text,
  `createDT` datetime NOT NULL,
  `modifyDT` datetime NOT NULL,
  PRIMARY KEY  (`rid`),
  UNIQUE KEY `_clcategories_rid` (`_clcategories_rid`,`_clients_rid`,`clrid`),
  KEY `_categories_rid` (`_categories_rid`),
  KEY `FK__clcategories1` (`_clients_rid`),
  CONSTRAINT `FK__clcategories1` FOREIGN KEY (`_clients_rid`) REFERENCES `_clients` (`rid`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK__clcategories2` FOREIGN KEY (`_categories_rid`) REFERENCES `_categories` (`rid`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=12162 DEFAULT CHARSET=utf8;

/*Trigger structure for table `_clcategories` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `Trigger_CreateRowDT_clcategories` */$$

/*!50003 CREATE TRIGGER `Trigger_CreateRowDT_clcategories` BEFORE INSERT ON `_clcategories` FOR EACH ROW BEGIN
 SET NEW.createDT = now();
 SET NEW.modifyDT = now();
 END */$$


/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `Trigger_ModifyRowDT_clcategories` */$$

/*!50003 CREATE TRIGGER `Trigger_ModifyRowDT_clcategories` BEFORE UPDATE ON `_clcategories` FOR EACH ROW BEGIN
 SET NEW.modifyDT = now();
 END */$$


DELIMITER ;

/*Table structure for table `_clients` */

CREATE TABLE `_clients` (
  `rid` int(11) NOT NULL auto_increment,
  `_cities_rid` int(11) NOT NULL,
  `_urforms_rid` int(11) NOT NULL,
  `_cltypes_rid` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `image` blob,
  `zip` varchar(25) NOT NULL,
  `street` varchar(255) NOT NULL,
  `build` varchar(255) NOT NULL,
  `wphones` varchar(255) NOT NULL,
  `skype` varchar(255) default NULL,
  `icq` varchar(255) default NULL,
  `msn` varchar(255) default NULL,
  `url` varchar(255) NOT NULL,
  `pr_load` tinyint(1) NOT NULL default '0',
  `pr_actual_days` int(11) default NULL,
  `pr_actual_hours` int(11) default NULL,
  `pr_actual_minutes` int(11) default NULL,
  `pr_email` varchar(255) default NULL,
  `descr` text NOT NULL,
  `creadits_info` text NOT NULL,
  `delivery_info` text NOT NULL,
  `worktime_info` text NOT NULL,
  `reg_date` datetime NOT NULL,
  `contact_phones` varchar(255) default NULL,
  `contact_email` varchar(255) default NULL,
  `contact_person` varchar(255) default NULL,
  `archive` tinyint(1) NOT NULL default '0',
  `createDT` datetime NOT NULL,
  `modifyDT` datetime NOT NULL,
  `pr_url` varchar(255) default NULL,
  `active` tinyint(1) default NULL,
  PRIMARY KEY  (`rid`),
  UNIQUE KEY `_secondary` (`_cities_rid`,`name`),
  KEY `_urforms_rid` (`_urforms_rid`),
  KEY `_cltypes_rid` (`_cltypes_rid`),
  CONSTRAINT `FK__clients_1` FOREIGN KEY (`_cities_rid`) REFERENCES `_cities` (`rid`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK__clients_2` FOREIGN KEY (`_urforms_rid`) REFERENCES `_urforms` (`rid`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK__clients_3` FOREIGN KEY (`_cltypes_rid`) REFERENCES `_cltypes` (`rid`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

/*Trigger structure for table `_clients` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `Trigger_CreateRowDT_clients` */$$

/*!50003 CREATE TRIGGER `Trigger_CreateRowDT_clients` BEFORE INSERT ON `_clients` FOR EACH ROW BEGIN
 SET NEW.createDT = now();
 SET NEW.modifyDT = now();
 END */$$


/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `Trigger_ModifyRowDT_clients` */$$

/*!50003 CREATE TRIGGER `Trigger_ModifyRowDT_clients` BEFORE UPDATE ON `_clients` FOR EACH ROW BEGIN
 SET NEW.modifyDT = now();
 END */$$


DELIMITER ;

/*Table structure for table `_cltypes` */

CREATE TABLE `_cltypes` (
  `rid` int(11) NOT NULL auto_increment,
  `name` varchar(45) NOT NULL,
  `archive` tinyint(1) NOT NULL default '0',
  `descr` text,
  `createDT` datetime NOT NULL,
  `modifyDT` datetime NOT NULL,
  PRIMARY KEY  (`rid`),
  UNIQUE KEY `_secondary` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

/*Trigger structure for table `_cltypes` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `Trigger_CreateRowDT_cltypes` */$$

/*!50003 CREATE TRIGGER `Trigger_CreateRowDT_cltypes` BEFORE INSERT ON `_cltypes` FOR EACH ROW BEGIN
 SET NEW.createDT = now();
 SET NEW.modifyDT = now();
 END */$$


/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `Trigger_ModifyRowDT_cltypes` */$$

/*!50003 CREATE TRIGGER `Trigger_ModifyRowDT_cltypes` BEFORE UPDATE ON `_cltypes` FOR EACH ROW BEGIN
 SET NEW.modifyDT = now();
 END */$$


DELIMITER ;

/*Table structure for table `_cluopinions` */

CREATE TABLE `_cluopinions` (
  `rid` int(11) NOT NULL auto_increment,
  `_clients_rid` int(11) NOT NULL,
  `opinion` text NOT NULL,
  `_members_rid` int(11) NOT NULL,
  `archive` tinyint(1) NOT NULL default '0',
  `descr` text,
  `createDT` datetime NOT NULL,
  `modifyDT` datetime NOT NULL,
  `mark` int(11) NOT NULL,
  PRIMARY KEY  (`rid`),
  KEY `_clients_rid` (`_clients_rid`),
  KEY `FK__cluopinions_2` (`_members_rid`),
  CONSTRAINT `FK__cluopinions_1` FOREIGN KEY (`_clients_rid`) REFERENCES `_clients` (`rid`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK__cluopinions_2` FOREIGN KEY (`_members_rid`) REFERENCES `_members` (`rid`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

/*Trigger structure for table `_cluopinions` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `Trigger_CreateRowDT_cluopinions` */$$

/*!50003 CREATE TRIGGER `Trigger_CreateRowDT_cluopinions` BEFORE INSERT ON `_cluopinions` FOR EACH ROW BEGIN
 SET NEW.createDT = now();
 SET NEW.modifyDT = now();
 END */$$


/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `Trigger_ModifyRowDT_cluopinions` */$$

/*!50003 CREATE TRIGGER `Trigger_ModifyRowDT_cluopinions` BEFORE UPDATE ON `_cluopinions` FOR EACH ROW BEGIN
 SET NEW.modifyDT = now();
 END */$$


DELIMITER ;

/*Table structure for table `_countries` */

CREATE TABLE `_countries` (
  `rid` int(11) NOT NULL auto_increment,
  `_currency_rid` int(11) NOT NULL,
  `cod` varchar(45) NOT NULL,
  `name` varchar(45) NOT NULL,
  `image` blob,
  `archive` tinyint(1) NOT NULL default '0',
  `descr` text,
  `createDT` datetime NOT NULL,
  `modifyDT` datetime NOT NULL,
  PRIMARY KEY  (`rid`),
  UNIQUE KEY `_secondary` (`cod`),
  UNIQUE KEY `_thierd` (`name`),
  KEY `_currency_rid` (`_currency_rid`),
  CONSTRAINT `FK__countries_1` FOREIGN KEY (`_currency_rid`) REFERENCES `_currency` (`rid`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

/*Trigger structure for table `_countries` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `Trigger_CreateRowDT_countries` */$$

/*!50003 CREATE TRIGGER `Trigger_CreateRowDT_countries` BEFORE INSERT ON `_countries` FOR EACH ROW BEGIN
 SET NEW.createDT = now();
 SET NEW.modifyDT = now();
 END */$$


/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `Trigger_ModifyRowDT_countries` */$$

/*!50003 CREATE TRIGGER `Trigger_ModifyRowDT_countries` BEFORE UPDATE ON `_countries` FOR EACH ROW BEGIN
 SET NEW.modifyDT = now();
 END */$$


DELIMITER ;

/*Table structure for table `_currcources` */

CREATE TABLE `_currcources` (
  `rid` int(11) NOT NULL auto_increment,
  `_clients_rid` int(11) NOT NULL,
  `_currency_rid` int(11) NOT NULL,
  `cource` float NOT NULL,
  `courcedate` datetime NOT NULL,
  `archive` tinyint(1) NOT NULL default '0',
  `descr` text,
  `createDT` datetime NOT NULL,
  `modifyDT` datetime NOT NULL,
  PRIMARY KEY  (`rid`),
  UNIQUE KEY `_secondary` (`_currency_rid`,`_clients_rid`,`courcedate`),
  KEY `_clients_rid` (`_clients_rid`),
  CONSTRAINT `FK__currcources_1` FOREIGN KEY (`_clients_rid`) REFERENCES `_clients` (`rid`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK__currcources_2` FOREIGN KEY (`_currency_rid`) REFERENCES `_currency` (`rid`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=496 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

/*Trigger structure for table `_currcources` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `Trigger_CreateRowDT_currcources` */$$

/*!50003 CREATE TRIGGER `Trigger_CreateRowDT_currcources` BEFORE INSERT ON `_currcources` FOR EACH ROW BEGIN
 SET NEW.createDT = now();
 SET NEW.modifyDT = now();
 END */$$


/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `Trigger_ModifyRowDT_currcources` */$$

/*!50003 CREATE TRIGGER `Trigger_ModifyRowDT_currcources` BEFORE UPDATE ON `_currcources` FOR EACH ROW BEGIN
 SET NEW.modifyDT = now();
 END */$$


DELIMITER ;

/*Table structure for table `_currency` */

CREATE TABLE `_currency` (
  `rid` int(11) NOT NULL auto_increment,
  `cod` varchar(45) NOT NULL,
  `name` varchar(45) NOT NULL,
  `archive` tinyint(1) NOT NULL default '0',
  `descr` text,
  `createDT` datetime NOT NULL,
  `modifyDT` datetime NOT NULL,
  `endword` varchar(45) default NULL,
  PRIMARY KEY  (`rid`),
  UNIQUE KEY `_secondary` (`cod`),
  UNIQUE KEY `_thierd` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

/*Trigger structure for table `_currency` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `Trigger_CreateRowDT_currency` */$$

/*!50003 CREATE TRIGGER `Trigger_CreateRowDT_currency` BEFORE INSERT ON `_currency` FOR EACH ROW BEGIN
 SET NEW.createDT = now();
 SET NEW.modifyDT = now();
 END */$$


/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `Trigger_ModifyRowDT_currency` */$$

/*!50003 CREATE TRIGGER `Trigger_ModifyRowDT_currency` BEFORE UPDATE ON `_currency` FOR EACH ROW BEGIN
 SET NEW.modifyDT = now();
 END */$$


DELIMITER ;

/*Table structure for table `_findqueries` */

CREATE TABLE `_findqueries` (
  `rid` int(11) NOT NULL auto_increment,
  `query` varchar(255) NOT NULL,
  `resquan` int(11) NOT NULL,
  `archive` tinyint(1) NOT NULL default '0',
  `descr` text,
  `createDT` datetime NOT NULL,
  `modifyDT` datetime NOT NULL,
  `_categories_rid` int(11) default NULL,
  PRIMARY KEY  (`rid`),
  KEY `FK__findqueries` (`_categories_rid`),
  CONSTRAINT `FK__findqueries` FOREIGN KEY (`_categories_rid`) REFERENCES `_categories` (`rid`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=151 DEFAULT CHARSET=utf8;

/*Trigger structure for table `_findqueries` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `Trigger_CreateRowDT_findqueries` */$$

/*!50003 CREATE TRIGGER `Trigger_CreateRowDT_findqueries` BEFORE INSERT ON `_findqueries` FOR EACH ROW BEGIN
 SET NEW.createDT = now();
 SET NEW.modifyDT = now();
 END */$$


/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `Trigger_ModifyRowDT_findqueries` */$$

/*!50003 CREATE TRIGGER `Trigger_ModifyRowDT_findqueries` BEFORE UPDATE ON `_findqueries` FOR EACH ROW BEGIN
 SET NEW.modifyDT = now();
 END */$$


DELIMITER ;

/*Table structure for table `_geoipcountries` */

CREATE TABLE `_geoipcountries` (
  `rid` int(10) unsigned NOT NULL auto_increment,
  `begin_ip` varchar(15) NOT NULL,
  `end_ip` varchar(15) NOT NULL,
  `begin_num` int(10) unsigned NOT NULL,
  `end_num` int(10) unsigned NOT NULL,
  `country_cod` varchar(2) NOT NULL,
  `country_name` varchar(45) NOT NULL,
  PRIMARY KEY  (`rid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Table structure for table `_guides` */

CREATE TABLE `_guides` (
  `rid` int(11) NOT NULL auto_increment,
  `title` varchar(256) NOT NULL,
  `content` text NOT NULL,
  `archive` tinyint(1) NOT NULL default '0',
  `descr` text,
  `createDT` datetime NOT NULL,
  `modifyDT` datetime NOT NULL,
  `_categories_rid` int(11) NOT NULL,
  PRIMARY KEY  (`rid`),
  KEY `FK__advertises` (`_categories_rid`),
  CONSTRAINT `FK__guides` FOREIGN KEY (`_categories_rid`) REFERENCES `_categories` (`rid`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Trigger structure for table `_guides` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `Trigger_CreateRowDT_guides` */$$

/*!50003 CREATE TRIGGER `Trigger_CreateRowDT_guides` BEFORE INSERT ON `_guides` FOR EACH ROW BEGIN
 SET NEW.createDT = now();
 SET NEW.modifyDT = now();
 END */$$


/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `Trigger_ModifyRowDT_guides` */$$

/*!50003 CREATE TRIGGER `Trigger_ModifyRowDT_guides` BEFORE UPDATE ON `_guides` FOR EACH ROW BEGIN
 SET NEW.modifyDT = now();
 END */$$


DELIMITER ;

/*Table structure for table `_guidesimages` */

CREATE TABLE `_guidesimages` (
  `rid` int(11) NOT NULL auto_increment,
  `_guides_rid` int(11) NOT NULL default '0',
  `name` varchar(45) character set utf8 default NULL,
  `type` varchar(45) character set utf8 default NULL,
  `size` varchar(45) character set utf8 default NULL,
  `image` blob,
  `archive` tinyint(1) default '0',
  `descr` text character set utf8,
  `createDT` datetime default NULL,
  `modifyDT` datetime default NULL,
  PRIMARY KEY  (`rid`),
  KEY `FK__categoriesimages` (`_guides_rid`),
  CONSTRAINT `FK__guidesimages` FOREIGN KEY (`_guides_rid`) REFERENCES `_guides` (`rid`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=cp1251;

/*Trigger structure for table `_guidesimages` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `Trigger_CreateRowDT_guidesimages` */$$

/*!50003 CREATE TRIGGER `Trigger_CreateRowDT_guidesimages` BEFORE INSERT ON `_guidesimages` FOR EACH ROW BEGIN
 SET NEW.createDT = now();
 SET NEW.modifyDT = now();
 END */$$


/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `Trigger_ModifyRowDT_guidesimages` */$$

/*!50003 CREATE TRIGGER `Trigger_ModifyRowDT_guidesimages` BEFORE UPDATE ON `_guidesimages` FOR EACH ROW BEGIN
 SET NEW.modifyDT = now();
 END */$$


DELIMITER ;

/*Table structure for table `_links` */

CREATE TABLE `_links` (
  `rid` int(11) NOT NULL default '0',
  `linktext` varchar(255) character set utf8 NOT NULL,
  `link` varchar(255) character set utf8 NOT NULL,
  `archive` tinyint(1) NOT NULL default '0',
  `descr` text character set utf8,
  `createDT` datetime NOT NULL default '0000-00-00 00:00:00',
  `modifyDT` datetime NOT NULL default '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=cp1251;

/*Table structure for table `_linkstocategories` */

CREATE TABLE `_linkstocategories` (
  `rid` int(11) NOT NULL default '0',
  `_categories_rid` int(11) NOT NULL,
  `_links_rid` int(11) NOT NULL,
  `archive` tinyint(1) NOT NULL default '0',
  `descr` text character set utf8,
  `createDT` datetime NOT NULL default '0000-00-00 00:00:00',
  `modifyDT` datetime NOT NULL default '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=cp1251;

/*Table structure for table `_members` */

CREATE TABLE `_members` (
  `rid` int(11) NOT NULL auto_increment,
  `display_name` varchar(255) NOT NULL,
  `login` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `subscribed` tinyint(1) default '0',
  `archive` tinyint(1) default '0',
  `descr` text,
  `createDT` datetime NOT NULL,
  `modifyDT` datetime NOT NULL,
  `activate_code` varchar(255) default NULL,
  `activate_status` tinyint(1) default '0',
  PRIMARY KEY  (`rid`),
  KEY `secondary` (`login`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

/*Trigger structure for table `_members` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `Trigger_CreateRowDT_members` */$$

/*!50003 CREATE TRIGGER `Trigger_CreateRowDT_members` BEFORE INSERT ON `_members` FOR EACH ROW BEGIN
 SET NEW.createDT = now();
 SET NEW.modifyDT = now();
 END */$$


/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `Trigger_ModifyRowDT_members` */$$

/*!50003 CREATE TRIGGER `Trigger_ModifyRowDT_members` BEFORE UPDATE ON `_members` FOR EACH ROW BEGIN
 SET NEW.modifyDT = now();
 END */$$


DELIMITER ;

/*Table structure for table `_news` */

CREATE TABLE `_news` (
  `rid` int(11) NOT NULL auto_increment,
  `title` varchar(255) NOT NULL,
  `new` text NOT NULL,
  `newdate` datetime NOT NULL,
  `archive` tinyint(1) NOT NULL default '0',
  `descr` text,
  `createDT` datetime NOT NULL,
  `modifyDT` datetime NOT NULL,
  `_newscategories_rid` int(11) NOT NULL,
  `image` mediumblob,
  `name` varchar(45) default NULL,
  `type` varchar(45) default NULL,
  `size` varchar(45) default NULL,
  `author` varchar(255) NOT NULL,
  `source_name` varchar(255) default NULL,
  `source_link` varchar(255) default NULL,
  PRIMARY KEY  (`rid`),
  KEY `FK__news` (`_newscategories_rid`),
  CONSTRAINT `FK__news` FOREIGN KEY (`_newscategories_rid`) REFERENCES `_newscategories` (`rid`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=63 DEFAULT CHARSET=utf8;

/*Trigger structure for table `_news` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `Trigger_CreateRowDT_news_copy_copy` */$$

/*!50003 CREATE TRIGGER `Trigger_CreateRowDT_news_copy_copy` BEFORE INSERT ON `_news` FOR EACH ROW BEGIN
 SET NEW.createDT = now();
 SET NEW.modifyDT = now();
 SET NEW.newdate = now();
 END */$$


/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `Trigger_ModifyRowDT_news_copy_copy` */$$

/*!50003 CREATE TRIGGER `Trigger_ModifyRowDT_news_copy_copy` BEFORE UPDATE ON `_news` FOR EACH ROW BEGIN
 SET NEW.modifyDT = now();
 END */$$


DELIMITER ;

/*Table structure for table `_newscategories` */

CREATE TABLE `_newscategories` (
  `rid` int(11) NOT NULL auto_increment,
  `_newscategories_rid` int(11) NOT NULL,
  `name` varchar(45) NOT NULL,
  `image` blob,
  `archive` tinyint(1) NOT NULL default '0',
  `descr` text,
  `createDT` datetime NOT NULL,
  `modifyDT` datetime NOT NULL,
  PRIMARY KEY  (`rid`),
  UNIQUE KEY `_secondary` (`name`,`_newscategories_rid`),
  KEY `_categories_rid` (`_newscategories_rid`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

/*Trigger structure for table `_newscategories` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `Trigger_CreateRowDT_newscategories` */$$

/*!50003 CREATE TRIGGER `Trigger_CreateRowDT_newscategories` BEFORE INSERT ON `_newscategories` FOR EACH ROW BEGIN
 SET NEW.createDT = now();
 SET NEW.modifyDT = now();
 END */$$


/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `Trigger_ModifyRowDT_newscategories` */$$

/*!50003 CREATE TRIGGER `Trigger_ModifyRowDT_newscategories` BEFORE UPDATE ON `_newscategories` FOR EACH ROW BEGIN
 SET NEW.modifyDT = now();
 END */$$


DELIMITER ;

/*Table structure for table `_officialcources` */

CREATE TABLE `_officialcources` (
  `rid` int(11) NOT NULL auto_increment,
  `_currency_rid` int(11) NOT NULL,
  `_countries_rid` int(11) NOT NULL,
  `courcedate` date NOT NULL,
  `cource` float NOT NULL,
  `archive` tinyint(1) NOT NULL default '0',
  `descr` text,
  `createDT` datetime NOT NULL,
  `modifyDT` datetime NOT NULL,
  PRIMARY KEY  (`rid`),
  UNIQUE KEY `_secondary` (`_currency_rid`,`_countries_rid`,`courcedate`),
  KEY `_countries_rid` (`_countries_rid`),
  CONSTRAINT `FK__officialcources_1` FOREIGN KEY (`_currency_rid`) REFERENCES `_currency` (`rid`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK__officialcources_2` FOREIGN KEY (`_countries_rid`) REFERENCES `_countries` (`rid`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=707 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

/*Trigger structure for table `_officialcources` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `Trigger_CreateRowDT_officialcources` */$$

/*!50003 CREATE TRIGGER `Trigger_CreateRowDT_officialcources` BEFORE INSERT ON `_officialcources` FOR EACH ROW BEGIN
 SET NEW.createDT = now();
 SET NEW.modifyDT = now();
 END */$$


/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `Trigger_ModifyRowDT_officialcources` */$$

/*!50003 CREATE TRIGGER `Trigger_ModifyRowDT_officialcources` BEFORE UPDATE ON `_officialcources` FOR EACH ROW BEGIN
 SET NEW.modifyDT = now();
 END */$$


DELIMITER ;

/*Table structure for table `_pars` */

CREATE TABLE `_pars` (
  `rid` int(11) NOT NULL auto_increment,
  `name` varchar(255) NOT NULL,
  `tag` varchar(45) default NULL COMMENT 'Показывает какому тегу соответствует этот параметр в XML файле',
  `archive` tinyint(1) NOT NULL default '0',
  `descr` text,
  `createDT` datetime NOT NULL,
  `modifyDT` datetime NOT NULL,
  PRIMARY KEY  (`rid`),
  UNIQUE KEY `_secondary` (`name`),
  UNIQUE KEY `tag` (`tag`)
) ENGINE=InnoDB AUTO_INCREMENT=2318 DEFAULT CHARSET=utf8;

/*Trigger structure for table `_pars` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `Trigger_CreateRowDT_pars` */$$

/*!50003 CREATE TRIGGER `Trigger_CreateRowDT_pars` BEFORE INSERT ON `_pars` FOR EACH ROW BEGIN
 SET NEW.createDT = now();
 SET NEW.modifyDT = now();
 END */$$


/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `Trigger_ModifyRowDT_pars` */$$

/*!50003 CREATE TRIGGER `Trigger_ModifyRowDT_pars` BEFORE UPDATE ON `_pars` FOR EACH ROW BEGIN
 SET NEW.modifyDT = now();
 END */$$


DELIMITER ;

/*Table structure for table `_parsfilters` */

CREATE TABLE `_parsfilters` (
  `rid` int(11) NOT NULL auto_increment,
  `_catpars_rid` int(11) NOT NULL,
  `value` varchar(255) default NULL,
  `numorder` int(11) default NULL,
  `archive` tinyint(1) NOT NULL default '0',
  `descr` text,
  `createDT` datetime NOT NULL,
  `modifyDT` datetime NOT NULL,
  `item` varchar(255) NOT NULL,
  `regular_expr` varchar(255) default NULL,
  PRIMARY KEY  (`rid`),
  UNIQUE KEY `_secondary` (`_catpars_rid`,`value`),
  CONSTRAINT `FK__parsfilters_1` FOREIGN KEY (`_catpars_rid`) REFERENCES `_catpars` (`rid`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=109 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

/*Trigger structure for table `_parsfilters` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `Trigger_CreateRowDT_parsfilters` */$$

/*!50003 CREATE TRIGGER `Trigger_CreateRowDT_parsfilters` BEFORE INSERT ON `_parsfilters` FOR EACH ROW BEGIN
 SET NEW.createDT = now();
 SET NEW.modifyDT = now();
 END */$$


/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `Trigger_ModifyRowDT_parsfilters` */$$

/*!50003 CREATE TRIGGER `Trigger_ModifyRowDT_parsfilters` BEFORE UPDATE ON `_parsfilters` FOR EACH ROW BEGIN
 SET NEW.modifyDT = now();
 END */$$


DELIMITER ;

/*Table structure for table `_parsvalues` */

CREATE TABLE `_parsvalues` (
  `rid` int(11) NOT NULL auto_increment,
  `_parsfilters_rid` int(11) NOT NULL default '0',
  `value` varchar(255) character set utf8 NOT NULL default '',
  `archive` tinyint(1) NOT NULL default '0',
  `descr` text character set utf8,
  `createDT` datetime NOT NULL default '0000-00-00 00:00:00',
  `modifyDT` datetime NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`rid`),
  UNIQUE KEY `_secondary` (`_parsfilters_rid`,`value`),
  CONSTRAINT `FK__parsvalues` FOREIGN KEY (`_parsfilters_rid`) REFERENCES `_parsfilters` (`rid`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=177 DEFAULT CHARSET=cp1251;

/*Trigger structure for table `_parsvalues` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `Trigger_CreateRowDT_parsvalues` */$$

/*!50003 CREATE TRIGGER `Trigger_CreateRowDT_parsvalues` BEFORE INSERT ON `_parsvalues` FOR EACH ROW BEGIN
 SET NEW.createDT = now();
 SET NEW.modifyDT = now();
 END */$$


/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `Trigger_ModifyRowDT_parsvalues` */$$

/*!50003 CREATE TRIGGER `Trigger_ModifyRowDT_parsvalues` BEFORE UPDATE ON `_parsvalues` FOR EACH ROW BEGIN
 SET NEW.modifyDT = now();
 END */$$


DELIMITER ;

/*Table structure for table `_popularbrands` */

CREATE TABLE `_popularbrands` (
  `rid` int(11) NOT NULL auto_increment,
  `_brands_rid` int(11) NOT NULL default '0',
  `descr` text character set utf8,
  `archive` tinyint(1) default '0',
  `createDT` datetime default NULL,
  `modifyDT` datetime default NULL,
  `sessionID` varchar(112) character set utf8 NOT NULL default '',
  `hits` int(11) NOT NULL default '1',
  PRIMARY KEY  (`rid`),
  UNIQUE KEY `rid` (`_brands_rid`,`sessionID`),
  CONSTRAINT `FK__popularbrands` FOREIGN KEY (`_brands_rid`) REFERENCES `_brands` (`rid`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=21585 DEFAULT CHARSET=cp1251;

/*Trigger structure for table `_popularbrands` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `Trigger_CreateRowDT_popularbrands` */$$

/*!50003 CREATE TRIGGER `Trigger_CreateRowDT_popularbrands` BEFORE INSERT ON `_popularbrands` FOR EACH ROW BEGIN
 SET NEW.createDT = now();
 SET NEW.modifyDT = now();
 END */$$


/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `Trigger_ModifyRowDT_popularbrands` */$$

/*!50003 CREATE TRIGGER `Trigger_ModifyRowDT_popularbrands` BEFORE UPDATE ON `_popularbrands` FOR EACH ROW BEGIN
 SET NEW.modifyDT = now();
 END */$$


DELIMITER ;

/*Table structure for table `_popularcategories` */

CREATE TABLE `_popularcategories` (
  `rid` int(11) NOT NULL auto_increment,
  `_categories_rid` int(11) NOT NULL,
  `descr` text,
  `archive` tinyint(1) default '0',
  `createDT` datetime default NULL,
  `modifyDT` datetime default NULL,
  `sessionID` varchar(112) NOT NULL,
  `hits` int(11) NOT NULL default '1',
  PRIMARY KEY  (`rid`),
  UNIQUE KEY `_categories_rid` (`_categories_rid`,`sessionID`),
  CONSTRAINT `FK__popularcategories` FOREIGN KEY (`_categories_rid`) REFERENCES `_categories` (`rid`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=50772 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

/*Table structure for table `_popularclients` */

CREATE TABLE `_popularclients` (
  `rid` int(11) NOT NULL auto_increment,
  `_clients_rid` int(11) NOT NULL default '0',
  `descr` text character set utf8,
  `archive` tinyint(1) default '0',
  `createDT` datetime default NULL,
  `modifyDT` datetime default NULL,
  `sessionID` varchar(112) character set utf8 NOT NULL default '',
  `hits` int(11) NOT NULL default '1',
  PRIMARY KEY  (`rid`),
  UNIQUE KEY `rid` (`_clients_rid`,`sessionID`),
  CONSTRAINT `FK__popularclients` FOREIGN KEY (`_clients_rid`) REFERENCES `_clients` (`rid`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=cp1251;

/*Trigger structure for table `_popularclients` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `Trigger_CreateRowDT_popularclients` */$$

/*!50003 CREATE TRIGGER `Trigger_CreateRowDT_popularclients` BEFORE INSERT ON `_popularclients` FOR EACH ROW BEGIN
 SET NEW.createDT = now();
 SET NEW.modifyDT = now();
 END */$$


/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `Trigger_ModifyRowDT_popularclients` */$$

/*!50003 CREATE TRIGGER `Trigger_ModifyRowDT_popularclients` BEFORE UPDATE ON `_popularclients` FOR EACH ROW BEGIN
 SET NEW.modifyDT = now();
 END */$$


DELIMITER ;

/*Table structure for table `_popularwares` */

CREATE TABLE `_popularwares` (
  `rid` int(11) NOT NULL auto_increment,
  `_wares_rid` int(11) NOT NULL default '0',
  `descr` text character set utf8,
  `archive` tinyint(1) default '0',
  `createDT` datetime default NULL,
  `modifyDT` datetime default NULL,
  `sessionID` varchar(112) character set utf8 NOT NULL default '',
  `hits` int(11) NOT NULL default '1',
  PRIMARY KEY  (`rid`),
  UNIQUE KEY `_wares_rid` (`_wares_rid`,`sessionID`),
  CONSTRAINT `FK__popularwares` FOREIGN KEY (`_wares_rid`) REFERENCES `_wares` (`rid`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=10346 DEFAULT CHARSET=cp1251;

/*Trigger structure for table `_popularwares` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `Trigger_CreateRowDT_popularwares` */$$

/*!50003 CREATE TRIGGER `Trigger_CreateRowDT_popularwares` BEFORE INSERT ON `_popularwares` FOR EACH ROW BEGIN
 SET NEW.createDT = now();
 SET NEW.modifyDT = now();
 END */$$


/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `Trigger_ModifyRowDT_popularwares` */$$

/*!50003 CREATE TRIGGER `Trigger_ModifyRowDT_popularwares` BEFORE UPDATE ON `_popularwares` FOR EACH ROW BEGIN
 SET NEW.modifyDT = now();
 END */$$


DELIMITER ;

/*Table structure for table `_prices` */

CREATE TABLE `_prices` (
  `rid` int(11) NOT NULL auto_increment,
  `_pritems_rid` int(11) NOT NULL,
  `_prtypes_rid` int(11) NOT NULL,
  `_currency_rid` int(11) NOT NULL,
  `price` float default NULL,
  `archive` tinyint(1) NOT NULL default '0',
  `descr` text,
  `createDT` datetime NOT NULL,
  `modifyDT` datetime NOT NULL,
  PRIMARY KEY  (`rid`),
  UNIQUE KEY `_secondary` (`_pritems_rid`,`_prtypes_rid`),
  KEY `_currency_rid` (`_currency_rid`),
  KEY `_prtypes_rid` (`_prtypes_rid`),
  CONSTRAINT `FK__prices_1` FOREIGN KEY (`_pritems_rid`) REFERENCES `_pritems` (`rid`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK__prices_2` FOREIGN KEY (`_prtypes_rid`) REFERENCES `_prtypes` (`rid`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK__prices_3` FOREIGN KEY (`_currency_rid`) REFERENCES `_currency` (`rid`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=118854 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

/*Trigger structure for table `_prices` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `Trigger_CreateRowDT_prices` */$$

/*!50003 CREATE TRIGGER `Trigger_CreateRowDT_prices` BEFORE INSERT ON `_prices` FOR EACH ROW BEGIN
 SET NEW.createDT = now();
 SET NEW.modifyDT = now();
 END */$$


/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `Trigger_ModifyRowDT_prices` */$$

/*!50003 CREATE TRIGGER `Trigger_ModifyRowDT_prices` BEFORE UPDATE ON `_prices` FOR EACH ROW BEGIN
 SET NEW.modifyDT = now();
 END */$$


DELIMITER ;

/*Table structure for table `_pritems` */

CREATE TABLE `_pritems` (
  `rid` int(11) NOT NULL auto_increment,
  `_clients_rid` int(11) NOT NULL,
  `_categories_rid` int(11) NOT NULL,
  `_brands_rid` int(11) default NULL,
  `_wares_rid` int(11) default NULL,
  `_availabletypes_rid` int(11) NOT NULL,
  `name` varchar(255) default NULL,
  `short_descr` varchar(255) default NULL,
  `link_ware` text,
  `prdate` datetime default NULL,
  `archive` tinyint(1) NOT NULL default '0',
  `descr` text,
  `createDT` datetime NOT NULL,
  `modifyDT` datetime NOT NULL,
  `model` varchar(255) NOT NULL,
  `delivery` varchar(255) default NULL,
  `offer_id` varchar(45) NOT NULL,
  `model_alias` varchar(255) default NULL,
  PRIMARY KEY  (`rid`),
  UNIQUE KEY `_clients_rid` (`_clients_rid`,`archive`,`offer_id`,`prdate`),
  KEY `_categories_rid` (`_categories_rid`),
  KEY `_brands_rid` (`_brands_rid`),
  KEY `_wares_rid` (`_wares_rid`),
  KEY `_availabletypes_rid` (`_availabletypes_rid`),
  CONSTRAINT `FK__pritems` FOREIGN KEY (`_categories_rid`) REFERENCES `_categories` (`rid`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK__pritems_1` FOREIGN KEY (`_clients_rid`) REFERENCES `_clients` (`rid`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK__pritems_3` FOREIGN KEY (`_brands_rid`) REFERENCES `_brands` (`rid`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK__pritems_4` FOREIGN KEY (`_wares_rid`) REFERENCES `_wares` (`rid`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK__pritems_5` FOREIGN KEY (`_availabletypes_rid`) REFERENCES `_availabletypes` (`rid`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=118856 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

/*Trigger structure for table `_pritems` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `Trigger_CreateRowDT_pritems` */$$

/*!50003 CREATE TRIGGER `Trigger_CreateRowDT_pritems` BEFORE INSERT ON `_pritems` FOR EACH ROW BEGIN
 SET NEW.createDT = now();
 SET NEW.modifyDT = now();
 END */$$


/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `Trigger_ModifyRowDT_pritems` */$$

/*!50003 CREATE TRIGGER `Trigger_ModifyRowDT_pritems` BEFORE UPDATE ON `_pritems` FOR EACH ROW BEGIN
 SET NEW.modifyDT = now();
 END */$$


DELIMITER ;

/*Table structure for table `_pritemsimgs` */

CREATE TABLE `_pritemsimgs` (
  `rid` int(11) NOT NULL auto_increment,
  `_pritems_rid` int(11) NOT NULL,
  `name` varchar(45) default NULL,
  `type` varchar(45) default NULL,
  `size` varchar(45) default NULL,
  `image` blob NOT NULL,
  `archive` tinyint(1) NOT NULL default '0',
  `descr` text,
  `createDT` datetime NOT NULL,
  `modifyDT` datetime NOT NULL,
  PRIMARY KEY  (`rid`),
  KEY `FK__pritemsimgs1` (`_pritems_rid`),
  CONSTRAINT `FK__pritemsimgs1` FOREIGN KEY (`_pritems_rid`) REFERENCES `_pritems` (`rid`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=64679 DEFAULT CHARSET=utf8;

/*Trigger structure for table `_pritemsimgs` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `Trigger_CreateRowDT_tmppritemsimgs_copy` */$$

/*!50003 CREATE TRIGGER `Trigger_CreateRowDT_tmppritemsimgs_copy` BEFORE INSERT ON `_pritemsimgs` FOR EACH ROW BEGIN
 SET NEW.createDT = now();
 SET NEW.modifyDT = now();
 END */$$


/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `Trigger_ModifyRowDT_tmppritemsimgs_copy` */$$

/*!50003 CREATE TRIGGER `Trigger_ModifyRowDT_tmppritemsimgs_copy` BEFORE UPDATE ON `_pritemsimgs` FOR EACH ROW BEGIN
 SET NEW.modifyDT = now();
 END */$$


DELIMITER ;

/*Table structure for table `_pritemspars` */

CREATE TABLE `_pritemspars` (
  `rid` int(11) NOT NULL auto_increment,
  `_pritems_rid` int(11) NOT NULL,
  `_pars_rid` int(11) NOT NULL,
  `value` text,
  `archive` tinyint(1) NOT NULL default '0',
  `descr` text,
  `createDT` datetime NOT NULL,
  `modifyDT` datetime NOT NULL,
  PRIMARY KEY  (`rid`),
  UNIQUE KEY `_secondary` (`_pritems_rid`,`_pars_rid`),
  KEY `_catpars_rid` (`_pars_rid`),
  CONSTRAINT `FK__pritemspars` FOREIGN KEY (`_pars_rid`) REFERENCES `_pars` (`rid`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK__pritemspars1` FOREIGN KEY (`_pritems_rid`) REFERENCES `_pritems` (`rid`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Trigger structure for table `_pritemspars` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `Trigger_CreateRowDT_pritemspars` */$$

/*!50003 CREATE TRIGGER `Trigger_CreateRowDT_pritemspars` BEFORE INSERT ON `_pritemspars` FOR EACH ROW BEGIN
 SET NEW.createDT = now();
 SET NEW.modifyDT = now();
 END */$$


/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `Trigger_ModifyRowDT_pritemspars` */$$

/*!50003 CREATE TRIGGER `Trigger_ModifyRowDT_pritemspars` BEFORE UPDATE ON `_pritemspars` FOR EACH ROW BEGIN
 SET NEW.modifyDT = now();
 END */$$


DELIMITER ;

/*Table structure for table `_prloadsorganizer` */

CREATE TABLE `_prloadsorganizer` (
  `rid` int(11) NOT NULL auto_increment,
  `_clients_rid` int(11) NOT NULL,
  `load_time` datetime NOT NULL,
  `next_load` datetime NOT NULL,
  `wares_quan` int(11) NOT NULL,
  `error_status` tinyint(1) NOT NULL default '0',
  `archive` tinyint(1) NOT NULL default '0',
  `descr` text,
  `createDT` datetime NOT NULL,
  `modifyDT` datetime NOT NULL,
  PRIMARY KEY  (`rid`),
  KEY `_clients_rid` (`_clients_rid`),
  CONSTRAINT `FK__prloadsorganizer_1` FOREIGN KEY (`_clients_rid`) REFERENCES `_clients` (`rid`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=242 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

/*Trigger structure for table `_prloadsorganizer` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `Trigger_CreateRowDT_prloadsorganizer` */$$

/*!50003 CREATE TRIGGER `Trigger_CreateRowDT_prloadsorganizer` BEFORE INSERT ON `_prloadsorganizer` FOR EACH ROW BEGIN
 SET NEW.createDT = now();
 SET NEW.modifyDT = now();
 END */$$


/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `Trigger_ModifyRowDT_prloadsorganizer` */$$

/*!50003 CREATE TRIGGER `Trigger_ModifyRowDT_prloadsorganizer` BEFORE UPDATE ON `_prloadsorganizer` FOR EACH ROW BEGIN
 SET NEW.modifyDT = now();
 END */$$


DELIMITER ;

/*Table structure for table `_prtypes` */

CREATE TABLE `_prtypes` (
  `rid` int(11) NOT NULL auto_increment,
  `cod` varchar(45) default NULL,
  `name` varchar(255) default NULL,
  `archive` tinyint(1) NOT NULL default '0',
  `descr` text,
  `createDT` datetime NOT NULL,
  `modifyDT` datetime NOT NULL,
  PRIMARY KEY  (`rid`),
  UNIQUE KEY `_secondary` (`cod`),
  UNIQUE KEY `_thierd` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

/*Trigger structure for table `_prtypes` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `Trigger_CreateRowDT_prtypes` */$$

/*!50003 CREATE TRIGGER `Trigger_CreateRowDT_prtypes` BEFORE INSERT ON `_prtypes` FOR EACH ROW BEGIN
 SET NEW.createDT = now();
 SET NEW.modifyDT = now();
 END */$$


/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `Trigger_ModifyRowDT_prtypes` */$$

/*!50003 CREATE TRIGGER `Trigger_ModifyRowDT_prtypes` BEFORE UPDATE ON `_prtypes` FOR EACH ROW BEGIN
 SET NEW.modifyDT = now();
 END */$$


DELIMITER ;

/*Table structure for table `_regions` */

CREATE TABLE `_regions` (
  `rid` int(11) NOT NULL auto_increment,
  `_countries_rid` int(11) NOT NULL,
  `name` varchar(45) NOT NULL,
  `archive` tinyint(1) NOT NULL default '0',
  `descr` text,
  `createDT` datetime NOT NULL,
  `modifyDT` datetime NOT NULL,
  `display_name` varchar(45) NOT NULL,
  PRIMARY KEY  (`rid`),
  UNIQUE KEY `_secondary` (`_countries_rid`,`name`),
  CONSTRAINT `FK__regions_1` FOREIGN KEY (`_countries_rid`) REFERENCES `_countries` (`rid`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=127 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

/*Trigger structure for table `_regions` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `Trigger_CreateRowDT_regions` */$$

/*!50003 CREATE TRIGGER `Trigger_CreateRowDT_regions` BEFORE INSERT ON `_regions` FOR EACH ROW BEGIN
 SET NEW.createDT = now();
 SET NEW.modifyDT = now();
 END */$$


/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `Trigger_ModifyRowDT_regions` */$$

/*!50003 CREATE TRIGGER `Trigger_ModifyRowDT_regions` BEFORE UPDATE ON `_regions` FOR EACH ROW BEGIN
 SET NEW.modifyDT = now();
 END */$$


DELIMITER ;

/*Table structure for table `_relatedcats` */

CREATE TABLE `_relatedcats` (
  `rid` int(11) NOT NULL auto_increment,
  `_categories_rid` int(11) NOT NULL,
  `related_categories_rid` int(10) unsigned NOT NULL,
  `descr` text NOT NULL,
  `archive` tinyint(1) unsigned NOT NULL default '0',
  `createDT` datetime NOT NULL,
  `modifyDT` datetime NOT NULL,
  PRIMARY KEY  (`rid`),
  UNIQUE KEY `_secondary` (`_categories_rid`,`related_categories_rid`),
  CONSTRAINT `FK__relatedcats_1` FOREIGN KEY (`_categories_rid`) REFERENCES `_categories` (`rid`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

/*Trigger structure for table `_relatedcats` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `Trigger_CreateRowDT_relatedcats` */$$

/*!50003 CREATE TRIGGER `Trigger_CreateRowDT_relatedcats` BEFORE INSERT ON `_relatedcats` FOR EACH ROW BEGIN
 SET NEW.createDT = now();
 SET NEW.modifyDT = now();
 END */$$


/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `Trigger_ModifyRowDT_relatedcats` */$$

/*!50003 CREATE TRIGGER `Trigger_ModifyRowDT_relatedcats` BEFORE UPDATE ON `_relatedcats` FOR EACH ROW BEGIN
 SET NEW.modifyDT = now();
 END */$$


DELIMITER ;

/*Table structure for table `_subscribers` */

CREATE TABLE `_subscribers` (
  `rid` int(11) NOT NULL auto_increment,
  `ip` varchar(15) NOT NULL,
  `email` varchar(45) NOT NULL,
  `mphone` varchar(45) default NULL,
  `archive` tinyint(1) NOT NULL default '0',
  `descr` text,
  `createDT` datetime NOT NULL,
  `modifyDT` datetime NOT NULL,
  PRIMARY KEY  (`rid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Trigger structure for table `_subscribers` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `Trigger_CreateRowDT_subscribers` */$$

/*!50003 CREATE TRIGGER `Trigger_CreateRowDT_subscribers` BEFORE INSERT ON `_subscribers` FOR EACH ROW BEGIN
 SET NEW.createDT = now();
 SET NEW.modifyDT = now();
 END */$$


/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `Trigger_ModifyRowDT_subscribers` */$$

/*!50003 CREATE TRIGGER `Trigger_ModifyRowDT_subscribers` BEFORE UPDATE ON `_subscribers` FOR EACH ROW BEGIN
 SET NEW.modifyDT = now();
 END */$$


DELIMITER ;

/*Table structure for table `_tmpprices` */

CREATE TABLE `_tmpprices` (
  `rid` int(11) NOT NULL auto_increment,
  `_tmppritems_rid` int(11) NOT NULL,
  `_prtypes_rid` int(11) NOT NULL,
  `_currency_rid` int(11) NOT NULL,
  `price` float default NULL,
  `archive` tinyint(1) NOT NULL default '0',
  `descr` text,
  `createDT` datetime NOT NULL,
  `modifyDT` datetime NOT NULL,
  PRIMARY KEY  (`rid`),
  KEY `_prtypes_rid` (`_prtypes_rid`),
  KEY `_currency_rid` (`_currency_rid`),
  KEY `_secondary` (`_tmppritems_rid`,`_prtypes_rid`),
  CONSTRAINT `FK__tmpprices1` FOREIGN KEY (`_tmppritems_rid`) REFERENCES `_tmppritems` (`rid`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK__tmpprices2` FOREIGN KEY (`_currency_rid`) REFERENCES `_currency` (`rid`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK__tmpprices3` FOREIGN KEY (`_prtypes_rid`) REFERENCES `_prtypes` (`rid`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=219228 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

/*Trigger structure for table `_tmpprices` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `Trigger_CreateRowDT_tmpprices` */$$

/*!50003 CREATE TRIGGER `Trigger_CreateRowDT_tmpprices` BEFORE INSERT ON `_tmpprices` FOR EACH ROW BEGIN
 SET NEW.createDT = now();
 SET NEW.modifyDT = now();
 END */$$


/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `Trigger_ModifyRowDT_tmpprices` */$$

/*!50003 CREATE TRIGGER `Trigger_ModifyRowDT_tmpprices` BEFORE UPDATE ON `_tmpprices` FOR EACH ROW BEGIN
 SET NEW.modifyDT = now();
 END */$$


DELIMITER ;

/*Table structure for table `_tmppricesstorage` */

CREATE TABLE `_tmppricesstorage` (
  `rid` int(11) NOT NULL auto_increment,
  `_clients_rid` int(11) NOT NULL,
  `price_date` datetime NOT NULL,
  `clname` varchar(255) default NULL,
  `clcompany` varchar(255) default NULL,
  `clurl` varchar(255) default NULL,
  `archive` tinyint(1) NOT NULL default '0',
  `descr` text,
  `createDT` datetime NOT NULL,
  `modifyDT` datetime NOT NULL,
  PRIMARY KEY  (`rid`),
  UNIQUE KEY `_clients_rid` (`_clients_rid`),
  CONSTRAINT `FK__tmppricesstorage1` FOREIGN KEY (`_clients_rid`) REFERENCES `_clients` (`rid`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=212 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC COMMENT='InnoDB free: 281600 kB';

/*Trigger structure for table `_tmppricesstorage` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `Trigger_CreateRowDT_tmppricesstorage` */$$

/*!50003 CREATE TRIGGER `Trigger_CreateRowDT_tmppricesstorage` BEFORE INSERT ON `_tmppricesstorage` FOR EACH ROW BEGIN
 SET NEW.createDT = now();
 SET NEW.modifyDT = now();
 END */$$


/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `Trigger_ModifyRowDT_tmppricesstorage` */$$

/*!50003 CREATE TRIGGER `Trigger_ModifyRowDT_tmppricesstorage` BEFORE UPDATE ON `_tmppricesstorage` FOR EACH ROW BEGIN
 SET NEW.modifyDT = now();
 END */$$


DELIMITER ;

/*Table structure for table `_tmppritems` */

CREATE TABLE `_tmppritems` (
  `rid` int(11) NOT NULL auto_increment,
  `_tmppricesstorage_rid` int(11) NOT NULL,
  `_clcategories_rid` int(11) NOT NULL,
  `_availabletypes_rid` int(11) NOT NULL,
  `offer_id` varchar(45) NOT NULL,
  `offer_type` varchar(45) default NULL,
  `offer_bid` int(11) default NULL,
  `offer_cbid` int(11) default NULL,
  `archive` tinyint(1) NOT NULL default '0',
  `descr` text,
  `createDT` datetime NOT NULL,
  `modifyDT` datetime NOT NULL,
  PRIMARY KEY  (`rid`),
  UNIQUE KEY `offer_id` (`_tmppricesstorage_rid`,`offer_id`),
  KEY `_categories_rid` (`_clcategories_rid`),
  KEY `_availabletypes_rid` (`_availabletypes_rid`),
  CONSTRAINT `FK__tmppritems3` FOREIGN KEY (`_tmppricesstorage_rid`) REFERENCES `_tmppricesstorage` (`rid`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK__tmppritems_2` FOREIGN KEY (`_clcategories_rid`) REFERENCES `_clcategories` (`rid`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK__tmppritems_5` FOREIGN KEY (`_availabletypes_rid`) REFERENCES `_availabletypes` (`rid`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=219240 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

/*Trigger structure for table `_tmppritems` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `Trigger_CreateRowDT_tmppritems` */$$

/*!50003 CREATE TRIGGER `Trigger_CreateRowDT_tmppritems` BEFORE INSERT ON `_tmppritems` FOR EACH ROW BEGIN
 SET NEW.createDT = now();
 SET NEW.modifyDT = now();
 END */$$


/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `Trigger_ModifyRowDT_tmppritems` */$$

/*!50003 CREATE TRIGGER `Trigger_ModifyRowDT_tmppritems` BEFORE UPDATE ON `_tmppritems` FOR EACH ROW BEGIN
 SET NEW.modifyDT = now();
 END */$$


DELIMITER ;

/*Table structure for table `_tmppritemsattrs` */

CREATE TABLE `_tmppritemsattrs` (
  `rid` int(11) NOT NULL auto_increment,
  `_tmppritems_rid` int(11) NOT NULL,
  `attr_name` varchar(255) NOT NULL,
  `attr_value` varchar(255) NOT NULL,
  `archive` tinyint(1) NOT NULL default '0',
  `descr` text,
  `createDT` datetime NOT NULL,
  `modifyDT` datetime NOT NULL,
  PRIMARY KEY  (`rid`),
  KEY `FK__tmppritemsattrs` (`_tmppritems_rid`),
  CONSTRAINT `FK__tmppritemsattrs` FOREIGN KEY (`_tmppritems_rid`) REFERENCES `_tmppritems` (`rid`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=1038436 DEFAULT CHARSET=utf8;

/*Trigger structure for table `_tmppritemsattrs` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `Trigger_CreateRowDT_tmppritemsattrs` */$$

/*!50003 CREATE TRIGGER `Trigger_CreateRowDT_tmppritemsattrs` BEFORE INSERT ON `_tmppritemsattrs` FOR EACH ROW BEGIN
 SET NEW.createDT = now();
 SET NEW.modifyDT = now();
 END */$$


/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `Trigger_ModifyRowDT_tmppritemsattrs` */$$

/*!50003 CREATE TRIGGER `Trigger_ModifyRowDT_tmppritemsattrs` BEFORE UPDATE ON `_tmppritemsattrs` FOR EACH ROW BEGIN
 SET NEW.modifyDT = now();
 END */$$


DELIMITER ;

/*Table structure for table `_tmppritemscources` */

CREATE TABLE `_tmppritemscources` (
  `rid` int(11) NOT NULL auto_increment,
  `_tmppricesstorage_rid` int(11) NOT NULL,
  `_currency_rid` int(11) NOT NULL,
  `cource` float NOT NULL,
  `archive` tinyint(1) NOT NULL default '0',
  `descr` text,
  `createDT` datetime NOT NULL,
  `modifyDT` datetime NOT NULL,
  PRIMARY KEY  (`rid`),
  KEY `FK__tmppritemscources2` (`_currency_rid`),
  KEY `FK__tmppritemscources1` (`_tmppricesstorage_rid`),
  CONSTRAINT `FK__tmppritemscources1` FOREIGN KEY (`_tmppricesstorage_rid`) REFERENCES `_tmppricesstorage` (`rid`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK__tmppritemscources2` FOREIGN KEY (`_currency_rid`) REFERENCES `_currency` (`rid`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=599 DEFAULT CHARSET=utf8;

/*Trigger structure for table `_tmppritemscources` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `Trigger_CreateRowDT_tmppritemscources` */$$

/*!50003 CREATE TRIGGER `Trigger_CreateRowDT_tmppritemscources` BEFORE INSERT ON `_tmppritemscources` FOR EACH ROW BEGIN
 SET NEW.createDT = now();
 SET NEW.modifyDT = now();
 END */$$


/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `Trigger_ModifyRowDT_tmppritemscources` */$$

/*!50003 CREATE TRIGGER `Trigger_ModifyRowDT_tmppritemscources` BEFORE UPDATE ON `_tmppritemscources` FOR EACH ROW BEGIN
 SET NEW.modifyDT = now();
 END */$$


DELIMITER ;

/*Table structure for table `_tmppritemsimgs` */

CREATE TABLE `_tmppritemsimgs` (
  `rid` int(11) NOT NULL auto_increment,
  `_tmppritems_rid` int(11) NOT NULL,
  `name` varchar(45) default NULL,
  `type` varchar(45) default NULL,
  `size` varchar(45) default NULL,
  `image` blob NOT NULL,
  `archive` tinyint(1) NOT NULL default '0',
  `descr` text,
  `createDT` datetime NOT NULL,
  `modifyDT` datetime NOT NULL,
  PRIMARY KEY  (`rid`),
  KEY `FK__tmppritemsimgs1` (`_tmppritems_rid`),
  CONSTRAINT `FK__tmppritemsimgs1` FOREIGN KEY (`_tmppritems_rid`) REFERENCES `_tmppritems` (`rid`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=133235 DEFAULT CHARSET=utf8;

/*Trigger structure for table `_tmppritemsimgs` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `Trigger_CreateRowDT_tmppritemsimgs` */$$

/*!50003 CREATE TRIGGER `Trigger_CreateRowDT_tmppritemsimgs` BEFORE INSERT ON `_tmppritemsimgs` FOR EACH ROW BEGIN
 SET NEW.createDT = now();
 SET NEW.modifyDT = now();
 END */$$


/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `Trigger_ModifyRowDT_tmppritemsimgs` */$$

/*!50003 CREATE TRIGGER `Trigger_ModifyRowDT_tmppritemsimgs` BEFORE UPDATE ON `_tmppritemsimgs` FOR EACH ROW BEGIN
 SET NEW.modifyDT = now();
 END */$$


DELIMITER ;

/*Table structure for table `_tmppritemspars` */

CREATE TABLE `_tmppritemspars` (
  `rid` int(11) NOT NULL auto_increment,
  `_tmppritems_rid` int(11) NOT NULL,
  `_pars_rid` int(11) NOT NULL,
  `value` text,
  `archive` tinyint(1) NOT NULL default '0',
  `descr` text,
  `createDT` datetime NOT NULL,
  `modifyDT` datetime NOT NULL,
  PRIMARY KEY  (`rid`),
  UNIQUE KEY `_secondary` (`_tmppritems_rid`,`_pars_rid`),
  KEY `_catpars_rid` (`_pars_rid`),
  CONSTRAINT `FK__tmppritemspars` FOREIGN KEY (`_pars_rid`) REFERENCES `_pars` (`rid`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK__tmppritemspars1` FOREIGN KEY (`_tmppritems_rid`) REFERENCES `_tmppritems` (`rid`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Trigger structure for table `_tmppritemspars` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `Trigger_CreateRowDT_tmppritemspars` */$$

/*!50003 CREATE TRIGGER `Trigger_CreateRowDT_tmppritemspars` BEFORE INSERT ON `_tmppritemspars` FOR EACH ROW BEGIN
 SET NEW.createDT = now();
 SET NEW.modifyDT = now();
 END */$$


/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `Trigger_ModifyRowDT_tmppritemspars` */$$

/*!50003 CREATE TRIGGER `Trigger_ModifyRowDT_tmppritemspars` BEFORE UPDATE ON `_tmppritemspars` FOR EACH ROW BEGIN
 SET NEW.modifyDT = now();
 END */$$


DELIMITER ;

/*Table structure for table `_ucallbacks` */

CREATE TABLE `_ucallbacks` (
  `rid` int(11) NOT NULL auto_increment,
  `content` text NOT NULL,
  `archive` tinyint(1) NOT NULL default '0',
  `descr` text,
  `createDT` datetime NOT NULL,
  `modifyDT` datetime NOT NULL,
  `status` varchar(255) NOT NULL,
  `cemail` varchar(255) NOT NULL,
  PRIMARY KEY  (`rid`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;

/*Trigger structure for table `_ucallbacks` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `Trigger_CreateRowDT_ucallbacks` */$$

/*!50003 CREATE TRIGGER `Trigger_CreateRowDT_ucallbacks` BEFORE INSERT ON `_ucallbacks` FOR EACH ROW BEGIN
 SET NEW.createDT = now();
 SET NEW.modifyDT = now();
 END */$$


/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `Trigger_ModifyRowDT_ucallbacks` */$$

/*!50003 CREATE TRIGGER `Trigger_ModifyRowDT_ucallbacks` BEFORE UPDATE ON `_ucallbacks` FOR EACH ROW BEGIN
 SET NEW.modifyDT = now();
 END */$$


DELIMITER ;

/*Table structure for table `_uerrors` */

CREATE TABLE `_uerrors` (
  `rid` int(11) NOT NULL auto_increment,
  `content` text NOT NULL,
  `archive` tinyint(1) NOT NULL default '0',
  `descr` text,
  `createDT` datetime NOT NULL,
  `modifyDT` datetime NOT NULL,
  `status` varchar(255) NOT NULL,
  PRIMARY KEY  (`rid`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Trigger structure for table `_uerrors` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `Trigger_CreateRowDT_uerrors` */$$

/*!50003 CREATE TRIGGER `Trigger_CreateRowDT_uerrors` BEFORE INSERT ON `_uerrors` FOR EACH ROW BEGIN
 SET NEW.createDT = now();
 SET NEW.modifyDT = now();
 END */$$


/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `Trigger_ModifyRowDT_uerrors` */$$

/*!50003 CREATE TRIGGER `Trigger_ModifyRowDT_uerrors` BEFORE UPDATE ON `_uerrors` FOR EACH ROW BEGIN
 SET NEW.modifyDT = now();
 END */$$


DELIMITER ;

/*Table structure for table `_urforms` */

CREATE TABLE `_urforms` (
  `rid` int(11) NOT NULL auto_increment,
  `name` varchar(255) NOT NULL,
  `little_name` varchar(25) NOT NULL,
  `archive` tinyint(1) NOT NULL default '0',
  `descr` text,
  `createDT` datetime NOT NULL,
  `modifyDT` datetime NOT NULL,
  PRIMARY KEY  (`rid`),
  UNIQUE KEY `_secondary` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

/*Trigger structure for table `_urforms` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `Trigger_CreateRowDT_urforms` */$$

/*!50003 CREATE TRIGGER `Trigger_CreateRowDT_urforms` BEFORE INSERT ON `_urforms` FOR EACH ROW BEGIN
 SET NEW.createDT = now();
 SET NEW.modifyDT = now();
 END */$$


/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `Trigger_ModifyRowDT_urforms` */$$

/*!50003 CREATE TRIGGER `Trigger_ModifyRowDT_urforms` BEFORE UPDATE ON `_urforms` FOR EACH ROW BEGIN
 SET NEW.modifyDT = now();
 END */$$


DELIMITER ;

/*Table structure for table `_users` */

CREATE TABLE `_users` (
  `rid` int(11) NOT NULL auto_increment,
  `_clients_rid` int(11) NOT NULL,
  `displayname` varchar(45) NOT NULL,
  `login` varchar(45) NOT NULL,
  `passwd` varchar(255) NOT NULL,
  `email` varchar(45) NOT NULL,
  `archive` tinyint(1) NOT NULL default '0',
  `descr` text,
  `createDT` datetime NOT NULL,
  `modifyDT` datetime NOT NULL,
  PRIMARY KEY  (`rid`),
  UNIQUE KEY `_secondary` (`login`),
  KEY `_clients_rid` (`_clients_rid`),
  CONSTRAINT `FK__users_1` FOREIGN KEY (`_clients_rid`) REFERENCES `_clients` (`rid`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

/*Trigger structure for table `_users` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `Trigger_CreateRowDT_users` */$$

/*!50003 CREATE TRIGGER `Trigger_CreateRowDT_users` BEFORE INSERT ON `_users` FOR EACH ROW BEGIN
 SET NEW.createDT = now();
 SET NEW.modifyDT = now();
 END */$$


/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `Trigger_ModifyRowDT_users` */$$

/*!50003 CREATE TRIGGER `Trigger_ModifyRowDT_users` BEFORE UPDATE ON `_users` FOR EACH ROW BEGIN
 SET NEW.modifyDT = now();
 END */$$


DELIMITER ;

/*Table structure for table `_wares` */

CREATE TABLE `_wares` (
  `rid` int(11) NOT NULL auto_increment,
  `_brands_rid` int(11) NOT NULL,
  `_categories_rid` int(11) NOT NULL,
  `model` varchar(255) default NULL,
  `archive` tinyint(1) NOT NULL default '0',
  `descr` text,
  `createDT` datetime NOT NULL,
  `modifyDT` datetime NOT NULL,
  `model_alias` varchar(255) default NULL,
  PRIMARY KEY  (`rid`),
  UNIQUE KEY `_secondary` (`model`,`_brands_rid`),
  UNIQUE KEY `model_alias` (`model_alias`,`_brands_rid`),
  KEY `_brands_rid` (`_brands_rid`),
  KEY `_categories_rid` (`_categories_rid`),
  KEY `model_alias_only` (`model_alias`),
  CONSTRAINT `FK__wares_1` FOREIGN KEY (`_brands_rid`) REFERENCES `_brands` (`rid`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK__wares_2` FOREIGN KEY (`_categories_rid`) REFERENCES `_categories` (`rid`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=106425 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

/*Trigger structure for table `_wares` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `Trigger_CreateRowDT_wares` */$$

/*!50003 CREATE TRIGGER `Trigger_CreateRowDT_wares` BEFORE INSERT ON `_wares` FOR EACH ROW BEGIN
 DECLARE model_alias VARCHAR(255);
 SET NEW.createDT = now();
 SET NEW.modifyDT = now();
 SET model_alias = NEW.model;
 SET model_alias = UPPER(model_alias);
 SET model_alias = REPLACE(model_alias,' ','');
 SET model_alias = REPLACE(model_alias,'-','');
 SET model_alias = REPLACE(model_alias,'\\','');
 SET model_alias = REPLACE(model_alias,'/','');
 SET NEW.model_alias = model_alias;
 END */$$


/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `Trigger_CreatePritems` */$$

/*!50003 CREATE TRIGGER `Trigger_CreatePritems` AFTER INSERT ON `_wares` FOR EACH ROW BEGIN
 /*DECLARE _brands_rid INT;
 DECLARE _wares_rid INT;
 DECLARE model_alias VARCHAR(255);
 DECLARE _categories_rid INT;
 SET _brands_rid = NEW._brands_rid;
 SET _wares_rid = NEW.rid;
 SET model_alias = NEW.model_alias;
 SET _categories_rid = NEW._categories_rid;
 UPDATE _tmppritems SET _tmppritems._brands_rid = _brands_rid, _tmppritems._wares_rid = _wares_rid,  _tmppritems._categories_rid = _categories_rid WHERE _tmppritems.model_alias = model_alias AND _tmppritems._brands_rid = _brands_rid AND _tmppritems._brands_rid <> null AND _tmppritems._brands_rid <> '';
 UPDATE _pritems SET _pritems._brands_rid = _brands_rid, _pritems._wares_rid = _wares_rid, _pritems._categories_rid = _categories_rid  WHERE _pritems.model_alias = model_alias AND _pritems._brands_rid = _brands_rid AND _pritems._brands_rid <> null AND _pritems._brands_rid <> '';
*/
 END */$$


/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `Trigger_ModifyRowDT_wares` */$$

/*!50003 CREATE TRIGGER `Trigger_ModifyRowDT_wares` BEFORE UPDATE ON `_wares` FOR EACH ROW BEGIN
 DECLARE model_alias VARCHAR(255);
 SET NEW.modifyDT = now();
 SET model_alias = NEW.model;
 SET model_alias = UPPER(model_alias);
 SET model_alias = REPLACE(model_alias,' ','');
 SET model_alias = REPLACE(model_alias,'-','');
 SET model_alias = REPLACE(model_alias,'\\','');
 SET model_alias = REPLACE(model_alias,'/','');
 SET NEW.model_alias = model_alias;
 END */$$


/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `Trigger_ModifyPritems` */$$

/*!50003 CREATE TRIGGER `Trigger_ModifyPritems` AFTER UPDATE ON `_wares` FOR EACH ROW BEGIN
 DECLARE _brands_rid INT;
 DECLARE _wares_rid INT;
 DECLARE model_alias VARCHAR(255);
 DECLARE _categories_rid INT;
 SET _brands_rid = OLD._brands_rid;
 SET _wares_rid = OLD.rid;
 SET model_alias = OLD.model_alias;
 SET _categories_rid = NEW._categories_rid;
 UPDATE _tmppritems SET _tmppritems._brands_rid = _brands_rid, _tmppritems._wares_rid = _wares_rid,  _tmppritems._categories_rid = _categories_rid WHERE _tmppritems.model_alias = model_alias AND _tmppritems._brands_rid = _brands_rid AND _tmppritems._brands_rid <> null AND _tmppritems._brands_rid <> '';
 UPDATE _pritems SET _pritems._brands_rid = _brands_rid, _pritems._wares_rid = _wares_rid, _pritems._categories_rid = _categories_rid WHERE _pritems.model_alias = model_alias AND _pritems._brands_rid = _brands_rid AND _pritems._brands_rid <> null AND _pritems._brands_rid <> '';
 END */$$


DELIMITER ;

/*Table structure for table `_waresimages` */

CREATE TABLE `_waresimages` (
  `rid` int(11) NOT NULL auto_increment,
  `_wares_rid` int(11) NOT NULL,
  `image` blob NOT NULL,
  `archive` tinyint(1) NOT NULL default '0',
  `descr` text,
  `createDT` datetime NOT NULL,
  `modifyDT` datetime NOT NULL,
  `name` varchar(45) default NULL,
  `type` varchar(45) default NULL,
  `size` varchar(45) default NULL,
  PRIMARY KEY  (`rid`),
  KEY `_wares_rid` (`_wares_rid`),
  CONSTRAINT `FK__waresimages_1` FOREIGN KEY (`_wares_rid`) REFERENCES `_wares` (`rid`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=116120 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

/*Trigger structure for table `_waresimages` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `Trigger_CreateRowDT_waresimages` */$$

/*!50003 CREATE TRIGGER `Trigger_CreateRowDT_waresimages` BEFORE INSERT ON `_waresimages` FOR EACH ROW BEGIN
 SET NEW.createDT = now();
 SET NEW.modifyDT = now();
 END */$$


/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `Trigger_ModifyRowDT_waresimages` */$$

/*!50003 CREATE TRIGGER `Trigger_ModifyRowDT_waresimages` BEFORE UPDATE ON `_waresimages` FOR EACH ROW BEGIN
 SET NEW.modifyDT = now();
 END */$$


DELIMITER ;

/*Table structure for table `_waresmarks` */

CREATE TABLE `_waresmarks` (
  `rid` int(11) NOT NULL auto_increment,
  `_wares_rid` int(11) NOT NULL,
  `mark` int(11) NOT NULL,
  `ip` varchar(15) NOT NULL,
  `archive` tinyint(1) NOT NULL default '0',
  `descr` text,
  `createDT` datetime NOT NULL,
  `modifyDT` datetime NOT NULL,
  PRIMARY KEY  (`rid`),
  KEY `_wares_rid` (`_wares_rid`),
  CONSTRAINT `FK__waresmarks_1` FOREIGN KEY (`_wares_rid`) REFERENCES `_wares` (`rid`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

/*Trigger structure for table `_waresmarks` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `Trigger_CreateRowDT_waresmarks` */$$

/*!50003 CREATE TRIGGER `Trigger_CreateRowDT_waresmarks` BEFORE INSERT ON `_waresmarks` FOR EACH ROW BEGIN
 SET NEW.createDT = now();
 SET NEW.modifyDT = now();
 END */$$


/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `Trigger_ModifyRowDT_waresmarks` */$$

/*!50003 CREATE TRIGGER `Trigger_ModifyRowDT_waresmarks` BEFORE UPDATE ON `_waresmarks` FOR EACH ROW BEGIN
 SET NEW.modifyDT = now();
 END */$$


DELIMITER ;

/*Table structure for table `_warespars` */

CREATE TABLE `_warespars` (
  `rid` int(11) NOT NULL auto_increment,
  `_wares_rid` int(11) NOT NULL,
  `_pars_rid` int(11) NOT NULL,
  `value` text,
  `archive` tinyint(1) NOT NULL default '0',
  `descr` text,
  `createDT` datetime NOT NULL,
  `modifyDT` datetime NOT NULL,
  PRIMARY KEY  (`rid`),
  UNIQUE KEY `_secondary` (`_wares_rid`,`_pars_rid`),
  KEY `_catpars_rid` (`_pars_rid`),
  CONSTRAINT `FK__warespars_1` FOREIGN KEY (`_wares_rid`) REFERENCES `_wares` (`rid`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK__warespars_2` FOREIGN KEY (`_pars_rid`) REFERENCES `_pars` (`rid`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=1382197 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

/*Trigger structure for table `_warespars` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `Trigger_CreateRowDT_warespars` */$$

/*!50003 CREATE TRIGGER `Trigger_CreateRowDT_warespars` BEFORE INSERT ON `_warespars` FOR EACH ROW BEGIN
 SET NEW.createDT = now();
 SET NEW.modifyDT = now();
 END */$$


/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `Trigger_ModifyRowDT_warespars` */$$

/*!50003 CREATE TRIGGER `Trigger_ModifyRowDT_warespars` BEFORE UPDATE ON `_warespars` FOR EACH ROW BEGIN
 SET NEW.modifyDT = now();
 END */$$


DELIMITER ;

/*Table structure for table `_waresrewievs` */

CREATE TABLE `_waresrewievs` (
  `rid` int(11) NOT NULL auto_increment,
  `_wares_rid` int(11) NOT NULL,
  `review` text NOT NULL,
  `datereview` datetime NOT NULL,
  `archive` tinyint(1) NOT NULL default '0',
  `descr` text,
  `createDT` datetime NOT NULL,
  `modifyDT` datetime NOT NULL,
  `review_title` varchar(255) NOT NULL,
  PRIMARY KEY  (`rid`),
  UNIQUE KEY `_secondary` (`_wares_rid`,`review_title`),
  CONSTRAINT `FK__waresrewievs` FOREIGN KEY (`_wares_rid`) REFERENCES `_wares` (`rid`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

/*Trigger structure for table `_waresrewievs` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `Trigger_CreateRowDT_waresrewievs` */$$

/*!50003 CREATE TRIGGER `Trigger_CreateRowDT_waresrewievs` BEFORE INSERT ON `_waresrewievs` FOR EACH ROW BEGIN
 SET NEW.createDT = now();
 SET NEW.modifyDT = now();
 END */$$


/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `Trigger_ModifyRowDT_waresrewievs` */$$

/*!50003 CREATE TRIGGER `Trigger_ModifyRowDT_waresrewievs` BEFORE UPDATE ON `_waresrewievs` FOR EACH ROW BEGIN
 SET NEW.modifyDT = now();
 END */$$


DELIMITER ;

/*Table structure for table `_waresuopinions` */

CREATE TABLE `_waresuopinions` (
  `rid` int(11) NOT NULL auto_increment,
  `_wares_rid` int(11) NOT NULL,
  `opinion` text NOT NULL,
  `_members_rid` int(11) NOT NULL,
  `archive` tinyint(1) NOT NULL default '0',
  `descr` text,
  `createDT` datetime NOT NULL,
  `modifyDT` datetime NOT NULL,
  `mark` int(10) unsigned NOT NULL,
  PRIMARY KEY  (`rid`),
  KEY `_wares_rid` (`_wares_rid`),
  KEY `FK__waresuopinions_1` (`_members_rid`),
  CONSTRAINT `FK__waresuopinions` FOREIGN KEY (`_wares_rid`) REFERENCES `_wares` (`rid`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK__waresuopinions1` FOREIGN KEY (`_members_rid`) REFERENCES `_members` (`rid`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

/*Trigger structure for table `_waresuopinions` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `Trigger_CreateRowDT_waresuopinions` */$$

/*!50003 CREATE TRIGGER `Trigger_CreateRowDT_waresuopinions` BEFORE INSERT ON `_waresuopinions` FOR EACH ROW BEGIN
 SET NEW.createDT = now();
 SET NEW.modifyDT = now();
 END */$$


/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `Trigger_ModifyRowDT_waresuopinions` */$$

/*!50003 CREATE TRIGGER `Trigger_ModifyRowDT_waresuopinions` BEFORE UPDATE ON `_waresuopinions` FOR EACH ROW BEGIN
 SET NEW.modifyDT = now();
 END */$$


DELIMITER ;

/*Table structure for table `forum_badwords` */

CREATE TABLE `forum_badwords` (
  `word` varchar(255) NOT NULL default '',
  `replacement` varchar(255) NOT NULL default '',
  PRIMARY KEY  (`word`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

/*Table structure for table `forum_bans` */

CREATE TABLE `forum_bans` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(255) NOT NULL default '',
  `email` varchar(255) NOT NULL default '',
  `ip_addr` varchar(23) NOT NULL default '',
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

/*Table structure for table `forum_cats` */

CREATE TABLE `forum_cats` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(255) NOT NULL default '',
  `sort_id` int(11) NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

/*Table structure for table `forum_forums` */

CREATE TABLE `forum_forums` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(255) NOT NULL default '',
  `cat_id` int(11) NOT NULL default '0',
  `descr` text NOT NULL,
  `status` int(1) NOT NULL default '1',
  `topics` int(11) NOT NULL default '0',
  `posts` int(11) NOT NULL default '0',
  `last_topic_id` int(11) NOT NULL default '0',
  `sort_id` int(11) NOT NULL default '0',
  `auth` varchar(10) NOT NULL default '0011222223',
  `auto_lock` int(11) NOT NULL default '0',
  `increase_post_count` int(1) NOT NULL default '1',
  `hide_mods_list` int(1) NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

/*Table structure for table `forum_members` */

CREATE TABLE `forum_members` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(255) NOT NULL default '',
  `email` varchar(255) NOT NULL default '',
  `email_show` int(1) NOT NULL default '0',
  `passwd` varchar(32) NOT NULL default '',
  `regdate` int(10) NOT NULL default '0',
  `level` int(1) NOT NULL default '0',
  `rank` varchar(255) NOT NULL default '',
  `active` int(1) NOT NULL default '0',
  `active_key` varchar(32) NOT NULL default '',
  `banned` int(1) NOT NULL default '0',
  `banned_reason` text NOT NULL,
  `last_login` int(10) NOT NULL default '0',
  `last_login_show` int(1) NOT NULL default '0',
  `last_pageview` int(10) NOT NULL default '0',
  `hide_from_online_list` int(1) NOT NULL default '0',
  `posts` int(11) NOT NULL default '0',
  `template` varchar(255) NOT NULL default '',
  `language` varchar(255) NOT NULL default '',
  `date_format` varchar(255) NOT NULL default '',
  `timezone` float NOT NULL default '0',
  `dst` int(1) NOT NULL default '0',
  `enable_quickreply` int(1) NOT NULL default '0',
  `return_to_topic_after_posting` int(1) NOT NULL default '0',
  `target_blank` int(1) NOT NULL default '0',
  `hide_avatars` int(1) NOT NULL default '0',
  `hide_userinfo` int(1) NOT NULL default '0',
  `hide_signatures` int(1) NOT NULL default '0',
  `auto_subscribe_topic` int(1) NOT NULL default '0',
  `auto_subscribe_reply` int(1) NOT NULL default '0',
  `avatar_type` int(1) NOT NULL default '0',
  `avatar_remote` varchar(255) NOT NULL default '',
  `displayed_name` varchar(255) NOT NULL default '',
  `real_name` varchar(255) NOT NULL default '',
  `signature` text NOT NULL,
  `birthday` int(8) NOT NULL default '0',
  `location` varchar(255) NOT NULL default '',
  `website` varchar(255) NOT NULL default '',
  `occupation` varchar(255) NOT NULL default '',
  `interests` varchar(255) NOT NULL default '',
  `msnm` varchar(255) NOT NULL default '',
  `yahoom` varchar(255) NOT NULL default '',
  `aim` varchar(255) NOT NULL default '',
  `icq` varchar(255) NOT NULL default '',
  `jabber` varchar(255) NOT NULL default '',
  `skype` varchar(255) NOT NULL default '',
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=53 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

/*Table structure for table `forum_moderators` */

CREATE TABLE `forum_moderators` (
  `forum_id` int(11) NOT NULL default '0',
  `user_id` int(11) NOT NULL default '0',
  `rid` int(11) NOT NULL auto_increment,
  PRIMARY KEY  (`rid`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

/*Table structure for table `forum_posts` */

CREATE TABLE `forum_posts` (
  `id` int(11) NOT NULL auto_increment,
  `topic_id` int(11) NOT NULL default '0',
  `poster_id` int(11) NOT NULL default '0',
  `poster_guest` varchar(255) NOT NULL default '',
  `poster_ip_addr` varchar(23) NOT NULL default '',
  `content` text NOT NULL,
  `post_time` int(10) NOT NULL default '0',
  `post_edit_time` int(10) NOT NULL default '0',
  `post_edit_by` int(11) NOT NULL default '0',
  `enable_bbcode` int(1) NOT NULL default '1',
  `enable_smilies` int(1) NOT NULL default '1',
  `enable_sig` int(1) NOT NULL default '1',
  `enable_html` int(1) NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

/*Table structure for table `forum_searches` */

CREATE TABLE `forum_searches` (
  `sess_id` varchar(32) NOT NULL default '',
  `time` int(10) NOT NULL default '0',
  `results` text NOT NULL,
  PRIMARY KEY  (`sess_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

/*Table structure for table `forum_sessions` */

CREATE TABLE `forum_sessions` (
  `sess_id` varchar(32) NOT NULL default '',
  `user_id` int(11) NOT NULL default '0',
  `ip_addr` varchar(23) NOT NULL default '',
  `started` int(10) NOT NULL default '0',
  `updated` int(10) NOT NULL default '0',
  `location` varchar(255) NOT NULL default '',
  `pages` int(11) NOT NULL default '0',
  PRIMARY KEY  (`sess_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Table structure for table `forum_stats` */

CREATE TABLE `forum_stats` (
  `name` varchar(255) NOT NULL default '',
  `content` text NOT NULL,
  PRIMARY KEY  (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

/*Table structure for table `forum_subscriptions` */

CREATE TABLE `forum_subscriptions` (
  `topic_id` int(11) NOT NULL default '0',
  `user_id` int(11) NOT NULL default '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

/*Table structure for table `forum_topics` */

CREATE TABLE `forum_topics` (
  `id` int(11) NOT NULL auto_increment,
  `forum_id` int(11) NOT NULL default '0',
  `topic_title` varchar(255) NOT NULL default '',
  `first_post_id` int(11) NOT NULL default '0',
  `last_post_id` int(11) NOT NULL default '0',
  `count_replies` int(11) NOT NULL default '0',
  `count_views` int(11) NOT NULL default '0',
  `status_locked` int(1) NOT NULL default '0',
  `status_sticky` int(1) NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

/*Table structure for table `sys_options` */

CREATE TABLE `sys_options` (
  `rid` int(11) NOT NULL auto_increment,
  `name` varchar(45) NOT NULL,
  `value` text NOT NULL,
  `cod` varchar(5) NOT NULL,
  `archive` tinyint(1) NOT NULL default '0',
  `descr` text,
  `createDT` datetime NOT NULL,
  `modifyDT` datetime NOT NULL,
  PRIMARY KEY  (`rid`),
  UNIQUE KEY `_secondary` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

/*Trigger structure for table `sys_options` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `Trigger_CreateRowDTsys_options` */$$

/*!50003 CREATE TRIGGER `Trigger_CreateRowDTsys_options` BEFORE INSERT ON `sys_options` FOR EACH ROW BEGIN
 SET NEW.createDT = now();
 SET NEW.modifyDT = now();
 END */$$


/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `Trigger_ModifyRowDTsys_options` */$$

/*!50003 CREATE TRIGGER `Trigger_ModifyRowDTsys_options` BEFORE UPDATE ON `sys_options` FOR EACH ROW BEGIN
 SET NEW.modifyDT = now();
 END */$$


DELIMITER ;

/*Table structure for table `sys_services` */

CREATE TABLE `sys_services` (
  `rid` int(11) NOT NULL auto_increment,
  `name` varchar(45) NOT NULL,
  `service_class` varchar(255) NOT NULL,
  `service_last_status` varchar(255) NOT NULL default 'OK',
  `service_error_descr` text NOT NULL,
  `archive` tinyint(1) NOT NULL default '0',
  `descr` text,
  `createDT` datetime NOT NULL,
  `modifyDT` datetime NOT NULL,
  `startDT` datetime NOT NULL,
  PRIMARY KEY  (`rid`),
  UNIQUE KEY `_secondary` (`service_class`),
  KEY `_thierd` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

/*Trigger structure for table `sys_services` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `Trigger_CreateRowDTsys_services` */$$

/*!50003 CREATE TRIGGER `Trigger_CreateRowDTsys_services` BEFORE INSERT ON `sys_services` FOR EACH ROW BEGIN
 SET NEW.createDT = now();
 SET NEW.modifyDT = now();
 END */$$


/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `Trigger_ModifyRowDTsys_services` */$$

/*!50003 CREATE TRIGGER `Trigger_ModifyRowDTsys_services` BEFORE UPDATE ON `sys_services` FOR EACH ROW BEGIN
 SET NEW.modifyDT = now();
 END */$$


DELIMITER ;

/*Table structure for table `sys_users` */

CREATE TABLE `sys_users` (
  `rid` int(11) NOT NULL auto_increment,
  `userid` varchar(45) NOT NULL,
  `password` varchar(45) NOT NULL,
  `archive` tinyint(3) unsigned default '0',
  `descr` text,
  `createDT` datetime NOT NULL,
  `modifyDT` datetime NOT NULL,
  PRIMARY KEY  (`rid`),
  UNIQUE KEY `_secondary` (`userid`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

/*Trigger structure for table `sys_users` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `Trigger_CreateRowDTsys_users` */$$

/*!50003 CREATE TRIGGER `Trigger_CreateRowDTsys_users` BEFORE INSERT ON `sys_users` FOR EACH ROW BEGIN
 SET NEW.createDT = now();
 SET NEW.modifyDT = now();
 END */$$


/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `Trigger_ModifyRowDTsys_users` */$$

/*!50003 CREATE TRIGGER `Trigger_ModifyRowDTsys_users` BEFORE UPDATE ON `sys_users` FOR EACH ROW BEGIN
 SET NEW.modifyDT = now();
 END */$$


DELIMITER ;

/* Procedure structure for procedure `DelWaresWithoutImages` */

/*!50003 DROP PROCEDURE IF EXISTS  `DelWaresWithoutImages` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`%` PROCEDURE `DelWaresWithoutImages`()
BEGIN
  DECLARE done INT DEFAULT 0;
  DECLARE wareRid INT;
  DECLARE cur1 CURSOR FOR select _wares.rid from _wares where _wares.rid not in (select _wares_rid from _waresimages);
  DECLARE CONTINUE HANDLER FOR NOT FOUND SET done = 1;
  OPEN cur1;
  REPEAT
    FETCH cur1 INTO wareRid;
    IF NOT done THEN
       DELETE FROM _wares WHERE rid=wareRid;
    END IF;
  UNTIL done END REPEAT;
  CLOSE cur1;
    END */$$
DELIMITER ;

/* Function  structure for function  `fn_sym_blob2clob` */

/*!50003 DROP FUNCTION IF EXISTS `fn_sym_blob2clob` */;
DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` FUNCTION `fn_sym_blob2clob`(blob_in blob) RETURNS mediumtext CHARSET utf8
begin
                                    return if(blob_in is null,'',concat('"',replace(replace(blob_in,'\\','\\\\'),'"','\\"'),'"'));
                                  end */$$
DELIMITER ;

/* Function  structure for function  `fn_transaction_id` */

/*!50003 DROP FUNCTION IF EXISTS `fn_transaction_id` */;
DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` FUNCTION `fn_transaction_id`() RETURNS varchar(50) CHARSET utf8
begin
                                     declare comm_name varchar(50);
                                     declare comm_value varchar(50);
                                     declare comm_cur cursor for show status like 'Com_commit';
                                     if @@autocommit = 0 then
                                          open comm_cur;
                                          fetch comm_cur into comm_name, comm_value;
                                          close comm_cur;
                                          return concat(concat(connection_id(), '.'), comm_value);
                                     else
                                          return null;
                                     end if;
                                  end */$$
DELIMITER ;

/* Function  structure for function  `SFE_GetItemShortDescr` */

/*!50003 DROP FUNCTION IF EXISTS `SFE_GetItemShortDescr` */;
DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`%` FUNCTION `SFE_GetItemShortDescr`(wareRid INT, pritemRid INT) RETURNS varchar(255) CHARSET utf8
BEGIN
	DECLARE shortDescr VARCHAR(255);
	IF wareRid is NULL THEN 
		SELECT GROUP_CONCAT(CONCAT('<b>', _pars.name, ':</b> ', _pritemspars.value, '<br>') ORDER BY _catpars.numorder SEPARATOR '') INTO shortDescr
		FROM _pritems
		JOIN _categories ON _pritems._categories_rid = _categories.rid
		JOIN _catpars ON _categories.rid = _catpars._categories_rid
		JOIN _pars ON _pars.rid = _catpars._pars_rid
		LEFT JOIN _pritemspars ON _pritems.rid = _pritemspars._pritems_rid AND _pritemspars._pars_rid = _catpars._pars_rid
		WHERE _pritems.rid = pritemRid AND _catpars.dpart = 1;
		RETURN shortDescr; 
	END IF;
	SELECT GROUP_CONCAT(CONCAT(_pars.name, ': ', _warespars.value, '<br>') SEPARATOR '') INTO shortDescr
	FROM _wares
	JOIN _categories ON _wares._categories_rid = _categories.rid
	JOIN _catpars ON _categories.rid = _catpars._categories_rid
	JOIN _pars ON _pars.rid = _catpars._pars_rid
	JOIN _warespars ON _wares.rid = _warespars._wares_rid AND _warespars._pars_rid = _catpars._pars_rid
	WHERE _wares.rid = wareRid AND _catpars.dpart = 1;
	/*IF CHAR_LENGTH(shortDescr) > 20 THEN 
		SET shortDescr = CONCAT(SUBSTRING(shortDescr, 0, 17), '...');
	END IF;*/
	RETURN shortDescr;
END */$$
DELIMITER ;

/* Function  structure for function  `SFE_GetPrItemsWaresRid` */

/*!50003 DROP FUNCTION IF EXISTS `SFE_GetPrItemsWaresRid` */;
DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`%` FUNCTION `SFE_GetPrItemsWaresRid`(pritemNAME VARCHAR(255)) RETURNS int(11)
BEGIN
	DECLARE wareRID INT;
	DECLARE wareMODELALIAS VARCHAR(255);
	DECLARE oldpritemNAME VARCHAR(255);
	DECLARE findedQUAN INT;
	DECLARE brandsRID INT;
	SET oldpritemNAME = pritemNAME;
	SET pritemNAME = UPPER(pritemNAME);
	SET pritemNAME = REPLACE(pritemNAME,' ','');
	SET pritemNAME = REPLACE(pritemNAME,'-','');
	SET pritemNAME = REPLACE(pritemNAME,'\\','');
	SET pritemNAME = REPLACE(pritemNAME,'/','');
	-- select pritemNAME;
	select count(_wares.rid), _wares.rid, _wares._brands_rid, _wares.model_alias INTO findedQUAN, wareRID, brandsRID, wareMODELALIAS from _wares
	join _brands ON _brands.rid = _wares._brands_rid
	left join _brandsassoc ON _brandsassoc._brands_rid = _brands.rid
	where pritemNAME LIKE CONCAT('%',UPPER(_brands.name),'%',_wares.model_alias,'%') OR 
	pritemNAME LIKE CONCAT('%',UPPER(_brandsassoc.name),'%',_wares.model_alias,'%') GROUP BY _wares.rid limit 1;
	IF findedQUAN > 0 THEN
		UPDATE _pritems SET _wares_rid = wareRID, _brands_rid = brandsRID, model_alias = wareMODELALIAS WHERE _pritems.name = oldpritemNAME;
	END IF;
	RETURN brandsRID;
    END */$$
DELIMITER ;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
