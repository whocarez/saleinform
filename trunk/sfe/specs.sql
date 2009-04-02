/*
SQLyog Community Edition- MySQL GUI v8.04 Beta2
MySQL - 5.0.51a : Database - saleinform
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

/* Trigger structure for table `_advertises` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `Trigger_CreateRowDT_advertises` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `Trigger_CreateRowDT_advertises` BEFORE INSERT ON `_advertises` FOR EACH ROW BEGIN
 SET NEW.createDT = now();
 SET NEW.modifyDT = now();
 END */$$


DELIMITER ;

/* Trigger structure for table `_advertises` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `Trigger_ModifyRowDT_advertises` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `Trigger_ModifyRowDT_advertises` BEFORE UPDATE ON `_advertises` FOR EACH ROW BEGIN
 SET NEW.modifyDT = now();
 END */$$


DELIMITER ;

/* Trigger structure for table `_availableparsvalues` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `Trigger_CreateRowDT_availableparsvalues` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `Trigger_CreateRowDT_availableparsvalues` BEFORE INSERT ON `_availableparsvalues` FOR EACH ROW BEGIN
 SET NEW.createDT = now();
 SET NEW.modifyDT = now();
 END */$$


DELIMITER ;

/* Trigger structure for table `_availableparsvalues` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `Trigger_ModifyRowDT_availableparsvalues` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `Trigger_ModifyRowDT_availableparsvalues` BEFORE UPDATE ON `_availableparsvalues` FOR EACH ROW BEGIN
 SET NEW.modifyDT = now();
 END */$$


DELIMITER ;

/* Trigger structure for table `_availabletypes` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `Trigger_CreateRowDT_availabletypes` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `Trigger_CreateRowDT_availabletypes` BEFORE INSERT ON `_availabletypes` FOR EACH ROW BEGIN
 SET NEW.createDT = now();
 SET NEW.modifyDT = now();
 END */$$


DELIMITER ;

/* Trigger structure for table `_availabletypes` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `Trigger_ModifyRowDT_availabletypes` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `Trigger_ModifyRowDT_availabletypes` BEFORE UPDATE ON `_availabletypes` FOR EACH ROW BEGIN
 SET NEW.modifyDT = now();
 END */$$


DELIMITER ;

/* Trigger structure for table `_bareas` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `Trigger_CreateRowDT_bareas` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `Trigger_CreateRowDT_bareas` BEFORE INSERT ON `_bareas` FOR EACH ROW BEGIN
 SET NEW.createDT = now();
 SET NEW.modifyDT = now();
 END */$$


DELIMITER ;

/* Trigger structure for table `_bareas` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `Trigger_ModifyRowDT_bareas` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `Trigger_ModifyRowDT_bareas` BEFORE UPDATE ON `_bareas` FOR EACH ROW BEGIN
 SET NEW.modifyDT = now();
 END */$$


DELIMITER ;

/* Trigger structure for table `_brands` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `Trigger_CreateRowDT_brands` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `Trigger_CreateRowDT_brands` BEFORE INSERT ON `_brands` FOR EACH ROW BEGIN
 SET NEW.createDT = now();
 SET NEW.modifyDT = now();
 END */$$


DELIMITER ;

/* Trigger structure for table `_brands` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `Trigger_ModifyRowDT_brands` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `Trigger_ModifyRowDT_brands` BEFORE UPDATE ON `_brands` FOR EACH ROW BEGIN
 SET NEW.modifyDT = now();
 END */$$


DELIMITER ;

/* Trigger structure for table `_brandsassoc` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `Trigger_CreateRowDT_brandsassoc` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `Trigger_CreateRowDT_brandsassoc` BEFORE INSERT ON `_brandsassoc` FOR EACH ROW BEGIN
 SET NEW.createDT = now();
 SET NEW.modifyDT = now();
 END */$$


DELIMITER ;

/* Trigger structure for table `_brandsassoc` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `Trigger_ModifyRowDT_brandsassoc` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `Trigger_ModifyRowDT_brandsassoc` BEFORE UPDATE ON `_brandsassoc` FOR EACH ROW BEGIN
 SET NEW.modifyDT = now();
 END */$$


DELIMITER ;

/* Trigger structure for table `_categories` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `Trigger_CreateRowDT_categories` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `Trigger_CreateRowDT_categories` BEFORE INSERT ON `_categories` FOR EACH ROW BEGIN
 SET NEW.createDT = now();
 SET NEW.modifyDT = now();
 SET NEW.slug = translit(NEW.name);
 END */$$


DELIMITER ;

/* Trigger structure for table `_categories` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `Trigger_CreateAfterRow_categories` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `Trigger_CreateAfterRow_categories` AFTER INSERT ON `_categories` FOR EACH ROW BEGIN
	DECLARE next_level INT;
	DELETE FROM _catparents WHERE _categories_rid = NEW.rid;
	INSERT INTO _catparents(_categories_rid, _parent_rid, LEVEL) (SELECT NEW.rid, _parent_rid, LEVEL FROM _catparents WHERE _categories_rid = NEW._categories_rid);
	SELECT MAX(LEVEL) INTO next_level FROM _catparents WHERE _categories_rid = NEW._categories_rid;
	SET next_level =  next_level + 1;
	INSERT INTO _catparents(_categories_rid, _parent_rid, LEVEL) VALUES(NEW.rid, NEW._categories_rid, next_level);
    END */$$


DELIMITER ;

/* Trigger structure for table `_categories` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `Trigger_ModifyRowDT_categories` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `Trigger_ModifyRowDT_categories` BEFORE UPDATE ON `_categories` FOR EACH ROW BEGIN
 SET NEW.modifyDT = now();
 SET NEW.slug = translit(NEW.name);
 END */$$


DELIMITER ;

/* Trigger structure for table `_categoriesimages` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `Trigger_CreateRowDT_categoriesimages` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `Trigger_CreateRowDT_categoriesimages` BEFORE INSERT ON `_categoriesimages` FOR EACH ROW BEGIN
 SET NEW.createDT = now();
 SET NEW.modifyDT = now();
 END */$$


DELIMITER ;

/* Trigger structure for table `_categoriesimages` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `Trigger_ModifyRowDT_categoriesimages` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `Trigger_ModifyRowDT_categoriesimages` BEFORE UPDATE ON `_categoriesimages` FOR EACH ROW BEGIN
 SET NEW.modifyDT = now();
 END */$$


DELIMITER ;

/* Trigger structure for table `_catpars` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `Trigger_CreateRowDT_catpars` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `Trigger_CreateRowDT_catpars` BEFORE INSERT ON `_catpars` FOR EACH ROW BEGIN
 SET NEW.createDT = now();
 SET NEW.modifyDT = now();
 END */$$


DELIMITER ;

/* Trigger structure for table `_catpars` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `Trigger_ModifyRowDT_catpars` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `Trigger_ModifyRowDT_catpars` BEFORE UPDATE ON `_catpars` FOR EACH ROW BEGIN
 SET NEW.modifyDT = now();
 END */$$


DELIMITER ;

/* Trigger structure for table `_cities` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `Trigger_CreateRowDT_cities` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `Trigger_CreateRowDT_cities` BEFORE INSERT ON `_cities` FOR EACH ROW BEGIN
 SET NEW.createDT = now();
 SET NEW.modifyDT = now();
 END */$$


DELIMITER ;

/* Trigger structure for table `_cities` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `Trigger_ModifyRowDT_cities` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `Trigger_ModifyRowDT_cities` BEFORE UPDATE ON `_cities` FOR EACH ROW BEGIN
 SET NEW.modifyDT = now();
 END */$$


DELIMITER ;

/* Trigger structure for table `_clcategories` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `Trigger_CreateRowDT_clcategories` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `Trigger_CreateRowDT_clcategories` BEFORE INSERT ON `_clcategories` FOR EACH ROW BEGIN
 SET NEW.createDT = now();
 SET NEW.modifyDT = now();
 END */$$


DELIMITER ;

/* Trigger structure for table `_clcategories` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `Trigger_ModifyRowDT_clcategories` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `Trigger_ModifyRowDT_clcategories` BEFORE UPDATE ON `_clcategories` FOR EACH ROW BEGIN
 SET NEW.modifyDT = now();
 END */$$


DELIMITER ;

/* Trigger structure for table `_clients` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `Trigger_CreateRowDT_clients` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `Trigger_CreateRowDT_clients` BEFORE INSERT ON `_clients` FOR EACH ROW BEGIN
 SET NEW.createDT = now();
 SET NEW.modifyDT = now();
 SET new.slug = translit(NEW.name);
 END */$$


DELIMITER ;

/* Trigger structure for table `_clients` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `Trigger_ModifyRowDT_clients` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `Trigger_ModifyRowDT_clients` BEFORE UPDATE ON `_clients` FOR EACH ROW BEGIN
 SET NEW.modifyDT = now();
  SET new.slug = translit(NEW.name);
 END */$$


DELIMITER ;

/* Trigger structure for table `_cltypes` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `Trigger_CreateRowDT_cltypes` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `Trigger_CreateRowDT_cltypes` BEFORE INSERT ON `_cltypes` FOR EACH ROW BEGIN
 SET NEW.createDT = now();
 SET NEW.modifyDT = now();
 END */$$


DELIMITER ;

/* Trigger structure for table `_cltypes` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `Trigger_ModifyRowDT_cltypes` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `Trigger_ModifyRowDT_cltypes` BEFORE UPDATE ON `_cltypes` FOR EACH ROW BEGIN
 SET NEW.modifyDT = now();
 END */$$


DELIMITER ;

/* Trigger structure for table `_cluopinions` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `Trigger_CreateRowDT_cluopinions` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `Trigger_CreateRowDT_cluopinions` BEFORE INSERT ON `_cluopinions` FOR EACH ROW BEGIN
 SET NEW.createDT = now();
 SET NEW.modifyDT = now();
 UPDATE _clients set popularity = (popularity+NEW.mark)/2 where rid = NEW._clients_rid;
 END */$$


DELIMITER ;

/* Trigger structure for table `_cluopinions` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `Trigger_ModifyRowDT_cluopinions` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `Trigger_ModifyRowDT_cluopinions` BEFORE UPDATE ON `_cluopinions` FOR EACH ROW BEGIN
 SET NEW.modifyDT = now();
 UPDATE _clients set popularity = (popularity + NEW.mark)/2 where rid = NEW._clients_rid;
 END */$$


DELIMITER ;

/* Trigger structure for table `_countries` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `Trigger_CreateRowDT_countries` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `Trigger_CreateRowDT_countries` BEFORE INSERT ON `_countries` FOR EACH ROW BEGIN
 SET NEW.createDT = now();
 SET NEW.modifyDT = now();
 END */$$


DELIMITER ;

/* Trigger structure for table `_countries` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `Trigger_ModifyRowDT_countries` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `Trigger_ModifyRowDT_countries` BEFORE UPDATE ON `_countries` FOR EACH ROW BEGIN
 SET NEW.modifyDT = now();
 END */$$


DELIMITER ;

/* Trigger structure for table `_currcources` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `Trigger_CreateRowDT_currcources` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `Trigger_CreateRowDT_currcources` BEFORE INSERT ON `_currcources` FOR EACH ROW BEGIN
 SET NEW.createDT = now();
 SET NEW.modifyDT = now();
 END */$$


DELIMITER ;

/* Trigger structure for table `_currcources` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `Trigger_ModifyRowDT_currcources` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `Trigger_ModifyRowDT_currcources` BEFORE UPDATE ON `_currcources` FOR EACH ROW BEGIN
 SET NEW.modifyDT = now();
 END */$$


DELIMITER ;

/* Trigger structure for table `_currency` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `Trigger_CreateRowDT_currency` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `Trigger_CreateRowDT_currency` BEFORE INSERT ON `_currency` FOR EACH ROW BEGIN
 SET NEW.createDT = now();
 SET NEW.modifyDT = now();
 END */$$


DELIMITER ;

/* Trigger structure for table `_currency` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `Trigger_ModifyRowDT_currency` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `Trigger_ModifyRowDT_currency` BEFORE UPDATE ON `_currency` FOR EACH ROW BEGIN
 SET NEW.modifyDT = now();
 END */$$


DELIMITER ;

/* Trigger structure for table `_findqueries` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `Trigger_CreateRowDT_findqueries` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `Trigger_CreateRowDT_findqueries` BEFORE INSERT ON `_findqueries` FOR EACH ROW BEGIN
 SET NEW.createDT = now();
 SET NEW.modifyDT = now();
 END */$$


DELIMITER ;

/* Trigger structure for table `_findqueries` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `Trigger_ModifyRowDT_findqueries` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `Trigger_ModifyRowDT_findqueries` BEFORE UPDATE ON `_findqueries` FOR EACH ROW BEGIN
 SET NEW.modifyDT = now();
 END */$$


DELIMITER ;

/* Trigger structure for table `_guides` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `Trigger_CreateRowDT_guides` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `Trigger_CreateRowDT_guides` BEFORE INSERT ON `_guides` FOR EACH ROW BEGIN
 SET NEW.createDT = now();
 SET NEW.modifyDT = now();
 END */$$


DELIMITER ;

/* Trigger structure for table `_guides` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `Trigger_ModifyRowDT_guides` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `Trigger_ModifyRowDT_guides` BEFORE UPDATE ON `_guides` FOR EACH ROW BEGIN
 SET NEW.modifyDT = now();
 END */$$


DELIMITER ;

/* Trigger structure for table `_guidesimages` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `Trigger_CreateRowDT_guidesimages` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `Trigger_CreateRowDT_guidesimages` BEFORE INSERT ON `_guidesimages` FOR EACH ROW BEGIN
 SET NEW.createDT = now();
 SET NEW.modifyDT = now();
 END */$$


DELIMITER ;

/* Trigger structure for table `_guidesimages` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `Trigger_ModifyRowDT_guidesimages` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `Trigger_ModifyRowDT_guidesimages` BEFORE UPDATE ON `_guidesimages` FOR EACH ROW BEGIN
 SET NEW.modifyDT = now();
 END */$$


DELIMITER ;

/* Trigger structure for table `_members` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `Trigger_CreateRowDT_members` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `Trigger_CreateRowDT_members` BEFORE INSERT ON `_members` FOR EACH ROW BEGIN
 SET NEW.createDT = now();
 SET NEW.modifyDT = now();
 END */$$


DELIMITER ;

/* Trigger structure for table `_members` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `Trigger_ModifyRowDT_members` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `Trigger_ModifyRowDT_members` BEFORE UPDATE ON `_members` FOR EACH ROW BEGIN
 SET NEW.modifyDT = now();
 END */$$


DELIMITER ;

/* Trigger structure for table `_news` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `Trigger_CreateRowDT_news` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `Trigger_CreateRowDT_news` BEFORE INSERT ON `_news` FOR EACH ROW BEGIN
 SET NEW.createDT = now();
 SET NEW.modifyDT = now();
 set NEW.slug = translit(NEW.name);
 END */$$


DELIMITER ;

/* Trigger structure for table `_news` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `Trigger_ModifyRowDT_news` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `Trigger_ModifyRowDT_news` BEFORE UPDATE ON `_news` FOR EACH ROW BEGIN
 SET NEW.modifyDT = now();
  set NEW.slug = translit(NEW.name);
 END */$$


DELIMITER ;

/* Trigger structure for table `_newscategories` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `Trigger_CreateRowDT_newscategories` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `Trigger_CreateRowDT_newscategories` BEFORE INSERT ON `_newscategories` FOR EACH ROW BEGIN
 SET NEW.createDT = now();
 SET NEW.modifyDT = now();
 set new.slug = translit(NEW.name);
 END */$$


DELIMITER ;

/* Trigger structure for table `_newscategories` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `Trigger_ModifyRowDT_newscategories` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `Trigger_ModifyRowDT_newscategories` BEFORE UPDATE ON `_newscategories` FOR EACH ROW BEGIN
 SET NEW.modifyDT = now();
  set new.slug = translit(NEW.name);
 END */$$


DELIMITER ;

/* Trigger structure for table `_officialcources` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `Trigger_CreateRowDT_officialcources` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `Trigger_CreateRowDT_officialcources` BEFORE INSERT ON `_officialcources` FOR EACH ROW BEGIN
 SET NEW.createDT = now();
 SET NEW.modifyDT = now();
 END */$$


DELIMITER ;

/* Trigger structure for table `_officialcources` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `Trigger_ModifyRowDT_officialcources` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `Trigger_ModifyRowDT_officialcources` BEFORE UPDATE ON `_officialcources` FOR EACH ROW BEGIN
 SET NEW.modifyDT = now();
 END */$$


DELIMITER ;

/* Trigger structure for table `_pars` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `Trigger_CreateRowDT_pars` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `Trigger_CreateRowDT_pars` BEFORE INSERT ON `_pars` FOR EACH ROW BEGIN
 SET NEW.createDT = now();
 SET NEW.modifyDT = now();
 END */$$


DELIMITER ;

/* Trigger structure for table `_pars` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `Trigger_ModifyRowDT_pars` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `Trigger_ModifyRowDT_pars` BEFORE UPDATE ON `_pars` FOR EACH ROW BEGIN
 SET NEW.modifyDT = now();
 END */$$


DELIMITER ;

/* Trigger structure for table `_parsfilters` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `Trigger_CreateRowDT_parsfilters` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `Trigger_CreateRowDT_parsfilters` BEFORE INSERT ON `_parsfilters` FOR EACH ROW BEGIN
 SET NEW.createDT = now();
 SET NEW.modifyDT = now();
 END */$$


DELIMITER ;

/* Trigger structure for table `_parsfilters` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `Trigger_ModifyRowDT_parsfilters` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `Trigger_ModifyRowDT_parsfilters` BEFORE UPDATE ON `_parsfilters` FOR EACH ROW BEGIN
 SET NEW.modifyDT = now();
 END */$$


DELIMITER ;

/* Trigger structure for table `_parsvalues` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `Trigger_CreateRowDT_parsvalues` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `Trigger_CreateRowDT_parsvalues` BEFORE INSERT ON `_parsvalues` FOR EACH ROW BEGIN
 SET NEW.createDT = now();
 SET NEW.modifyDT = now();
 END */$$


DELIMITER ;

/* Trigger structure for table `_parsvalues` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `Trigger_ModifyRowDT_parsvalues` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `Trigger_ModifyRowDT_parsvalues` BEFORE UPDATE ON `_parsvalues` FOR EACH ROW BEGIN
 SET NEW.modifyDT = now();
 END */$$


DELIMITER ;

/* Trigger structure for table `_prices` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `Trigger_CreateRowDT_prices` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `Trigger_CreateRowDT_prices` BEFORE INSERT ON `_prices` FOR EACH ROW BEGIN
 SET NEW.createDT = now();
 SET NEW.modifyDT = now();
 END */$$


DELIMITER ;

/* Trigger structure for table `_prices` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `Trigger_ModifyRowDT_prices` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `Trigger_ModifyRowDT_prices` BEFORE UPDATE ON `_prices` FOR EACH ROW BEGIN
 SET NEW.modifyDT = now();
 END */$$


DELIMITER ;

/* Trigger structure for table `_pritems` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `Trigger_CreateRowDT_pritems` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `Trigger_CreateRowDT_pritems` BEFORE INSERT ON `_pritems` FOR EACH ROW BEGIN
 SET NEW.createDT = now();
 SET NEW.modifyDT = now();
 SET NEW.slug = translit(NEW.name);
 END */$$


DELIMITER ;

/* Trigger structure for table `_pritems` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `Trigger_ModifyRowDT_pritems` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `Trigger_ModifyRowDT_pritems` BEFORE UPDATE ON `_pritems` FOR EACH ROW BEGIN
 SET NEW.modifyDT = now();
 SET NEW.slug = translit(NEW.name);
 END */$$


DELIMITER ;

/* Trigger structure for table `_pritemsimgs` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `Trigger_CreateRowDT_tmppritemsimgs_copy` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `Trigger_CreateRowDT_tmppritemsimgs_copy` BEFORE INSERT ON `_pritemsimgs` FOR EACH ROW BEGIN
 SET NEW.createDT = now();
 SET NEW.modifyDT = now();
 END */$$


DELIMITER ;

/* Trigger structure for table `_pritemsimgs` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `Trigger_ModifyRowDT_tmppritemsimgs_copy` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `Trigger_ModifyRowDT_tmppritemsimgs_copy` BEFORE UPDATE ON `_pritemsimgs` FOR EACH ROW BEGIN
 SET NEW.modifyDT = now();
 END */$$


DELIMITER ;

/* Trigger structure for table `_pritemspars` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `Trigger_CreateRowDT_pritemspars` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `Trigger_CreateRowDT_pritemspars` BEFORE INSERT ON `_pritemspars` FOR EACH ROW BEGIN
 SET NEW.createDT = now();
 SET NEW.modifyDT = now();
 END */$$


DELIMITER ;

/* Trigger structure for table `_pritemspars` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `Trigger_ModifyRowDT_pritemspars` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `Trigger_ModifyRowDT_pritemspars` BEFORE UPDATE ON `_pritemspars` FOR EACH ROW BEGIN
 SET NEW.modifyDT = now();
 END */$$


DELIMITER ;

/* Trigger structure for table `_prloadsorganizer` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `Trigger_CreateRowDT_prloadsorganizer` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `Trigger_CreateRowDT_prloadsorganizer` BEFORE INSERT ON `_prloadsorganizer` FOR EACH ROW BEGIN
 SET NEW.createDT = now();
 SET NEW.modifyDT = now();
 END */$$


DELIMITER ;

/* Trigger structure for table `_prloadsorganizer` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `Trigger_ModifyRowDT_prloadsorganizer` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `Trigger_ModifyRowDT_prloadsorganizer` BEFORE UPDATE ON `_prloadsorganizer` FOR EACH ROW BEGIN
 SET NEW.modifyDT = now();
 END */$$


DELIMITER ;

/* Trigger structure for table `_prtypes` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `Trigger_CreateRowDT_prtypes` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `Trigger_CreateRowDT_prtypes` BEFORE INSERT ON `_prtypes` FOR EACH ROW BEGIN
 SET NEW.createDT = now();
 SET NEW.modifyDT = now();
 END */$$


DELIMITER ;

/* Trigger structure for table `_prtypes` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `Trigger_ModifyRowDT_prtypes` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `Trigger_ModifyRowDT_prtypes` BEFORE UPDATE ON `_prtypes` FOR EACH ROW BEGIN
 SET NEW.modifyDT = now();
 END */$$


DELIMITER ;

/* Trigger structure for table `_regions` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `Trigger_CreateRowDT_regions` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `Trigger_CreateRowDT_regions` BEFORE INSERT ON `_regions` FOR EACH ROW BEGIN
 SET NEW.createDT = now();
 SET NEW.modifyDT = now();
 END */$$


DELIMITER ;

/* Trigger structure for table `_regions` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `Trigger_ModifyRowDT_regions` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `Trigger_ModifyRowDT_regions` BEFORE UPDATE ON `_regions` FOR EACH ROW BEGIN
 SET NEW.modifyDT = now();
 END */$$


DELIMITER ;

/* Trigger structure for table `_relatedcats` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `Trigger_CreateRowDT_relatedcats` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `Trigger_CreateRowDT_relatedcats` BEFORE INSERT ON `_relatedcats` FOR EACH ROW BEGIN
 SET NEW.createDT = now();
 SET NEW.modifyDT = now();
 END */$$


DELIMITER ;

/* Trigger structure for table `_relatedcats` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `Trigger_ModifyRowDT_relatedcats` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `Trigger_ModifyRowDT_relatedcats` BEFORE UPDATE ON `_relatedcats` FOR EACH ROW BEGIN
 SET NEW.modifyDT = now();
 END */$$


DELIMITER ;

/* Trigger structure for table `_subscribers` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `Trigger_CreateRowDT_subscribers` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `Trigger_CreateRowDT_subscribers` BEFORE INSERT ON `_subscribers` FOR EACH ROW BEGIN
 SET NEW.createDT = now();
 SET NEW.modifyDT = now();
 END */$$


DELIMITER ;

/* Trigger structure for table `_subscribers` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `Trigger_ModifyRowDT_subscribers` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `Trigger_ModifyRowDT_subscribers` BEFORE UPDATE ON `_subscribers` FOR EACH ROW BEGIN
 SET NEW.modifyDT = now();
 END */$$


DELIMITER ;

/* Trigger structure for table `_tmpprices` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `Trigger_CreateRowDT_tmpprices` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `Trigger_CreateRowDT_tmpprices` BEFORE INSERT ON `_tmpprices` FOR EACH ROW BEGIN
 SET NEW.createDT = now();
 SET NEW.modifyDT = now();
 END */$$


DELIMITER ;

/* Trigger structure for table `_tmpprices` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `Trigger_ModifyRowDT_tmpprices` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `Trigger_ModifyRowDT_tmpprices` BEFORE UPDATE ON `_tmpprices` FOR EACH ROW BEGIN
 SET NEW.modifyDT = now();
 END */$$


DELIMITER ;

/* Trigger structure for table `_tmppricesstorage` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `Trigger_CreateRowDT_tmppricesstorage` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `Trigger_CreateRowDT_tmppricesstorage` BEFORE INSERT ON `_tmppricesstorage` FOR EACH ROW BEGIN
 SET NEW.createDT = now();
 SET NEW.modifyDT = now();
 END */$$


DELIMITER ;

/* Trigger structure for table `_tmppricesstorage` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `Trigger_ModifyRowDT_tmppricesstorage` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `Trigger_ModifyRowDT_tmppricesstorage` BEFORE UPDATE ON `_tmppricesstorage` FOR EACH ROW BEGIN
 SET NEW.modifyDT = now();
 END */$$


DELIMITER ;

/* Trigger structure for table `_tmppritems` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `Trigger_CreateRowDT_tmppritems` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `Trigger_CreateRowDT_tmppritems` BEFORE INSERT ON `_tmppritems` FOR EACH ROW BEGIN
 SET NEW.createDT = now();
 SET NEW.modifyDT = now();
 END */$$


DELIMITER ;

/* Trigger structure for table `_tmppritems` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `Trigger_ModifyRowDT_tmppritems` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `Trigger_ModifyRowDT_tmppritems` BEFORE UPDATE ON `_tmppritems` FOR EACH ROW BEGIN
 SET NEW.modifyDT = now();
 END */$$


DELIMITER ;

/* Trigger structure for table `_tmppritemsattrs` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `Trigger_CreateRowDT_tmppritemsattrs` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `Trigger_CreateRowDT_tmppritemsattrs` BEFORE INSERT ON `_tmppritemsattrs` FOR EACH ROW BEGIN
 SET NEW.createDT = now();
 SET NEW.modifyDT = now();
 END */$$


DELIMITER ;

/* Trigger structure for table `_tmppritemsattrs` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `Trigger_ModifyRowDT_tmppritemsattrs` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `Trigger_ModifyRowDT_tmppritemsattrs` BEFORE UPDATE ON `_tmppritemsattrs` FOR EACH ROW BEGIN
 SET NEW.modifyDT = now();
 END */$$


DELIMITER ;

/* Trigger structure for table `_tmppritemscources` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `Trigger_CreateRowDT_tmppritemscources` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `Trigger_CreateRowDT_tmppritemscources` BEFORE INSERT ON `_tmppritemscources` FOR EACH ROW BEGIN
 SET NEW.createDT = now();
 SET NEW.modifyDT = now();
 END */$$


DELIMITER ;

/* Trigger structure for table `_tmppritemscources` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `Trigger_ModifyRowDT_tmppritemscources` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `Trigger_ModifyRowDT_tmppritemscources` BEFORE UPDATE ON `_tmppritemscources` FOR EACH ROW BEGIN
 SET NEW.modifyDT = now();
 END */$$


DELIMITER ;

/* Trigger structure for table `_tmppritemsimgs` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `Trigger_CreateRowDT_tmppritemsimgs` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `Trigger_CreateRowDT_tmppritemsimgs` BEFORE INSERT ON `_tmppritemsimgs` FOR EACH ROW BEGIN
 SET NEW.createDT = now();
 SET NEW.modifyDT = now();
 END */$$


DELIMITER ;

/* Trigger structure for table `_tmppritemsimgs` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `Trigger_ModifyRowDT_tmppritemsimgs` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `Trigger_ModifyRowDT_tmppritemsimgs` BEFORE UPDATE ON `_tmppritemsimgs` FOR EACH ROW BEGIN
 SET NEW.modifyDT = now();
 END */$$


DELIMITER ;

/* Trigger structure for table `_tmppritemspars` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `Trigger_CreateRowDT_tmppritemspars` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `Trigger_CreateRowDT_tmppritemspars` BEFORE INSERT ON `_tmppritemspars` FOR EACH ROW BEGIN
 SET NEW.createDT = now();
 SET NEW.modifyDT = now();
 END */$$


DELIMITER ;

/* Trigger structure for table `_tmppritemspars` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `Trigger_ModifyRowDT_tmppritemspars` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `Trigger_ModifyRowDT_tmppritemspars` BEFORE UPDATE ON `_tmppritemspars` FOR EACH ROW BEGIN
 SET NEW.modifyDT = now();
 END */$$


DELIMITER ;

/* Trigger structure for table `_ucallbacks` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `Trigger_CreateRowDT_ucallbacks` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `Trigger_CreateRowDT_ucallbacks` BEFORE INSERT ON `_ucallbacks` FOR EACH ROW BEGIN
 SET NEW.createDT = now();
 SET NEW.modifyDT = now();
 END */$$


DELIMITER ;

/* Trigger structure for table `_ucallbacks` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `Trigger_ModifyRowDT_ucallbacks` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `Trigger_ModifyRowDT_ucallbacks` BEFORE UPDATE ON `_ucallbacks` FOR EACH ROW BEGIN
 SET NEW.modifyDT = now();
 END */$$


DELIMITER ;

/* Trigger structure for table `_uerrors` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `Trigger_CreateRowDT_uerrors` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `Trigger_CreateRowDT_uerrors` BEFORE INSERT ON `_uerrors` FOR EACH ROW BEGIN
 SET NEW.createDT = now();
 SET NEW.modifyDT = now();
 END */$$


DELIMITER ;

/* Trigger structure for table `_uerrors` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `Trigger_ModifyRowDT_uerrors` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `Trigger_ModifyRowDT_uerrors` BEFORE UPDATE ON `_uerrors` FOR EACH ROW BEGIN
 SET NEW.modifyDT = now();
 END */$$


DELIMITER ;

/* Trigger structure for table `_urforms` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `Trigger_CreateRowDT_urforms` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `Trigger_CreateRowDT_urforms` BEFORE INSERT ON `_urforms` FOR EACH ROW BEGIN
 SET NEW.createDT = now();
 SET NEW.modifyDT = now();
 END */$$


DELIMITER ;

/* Trigger structure for table `_urforms` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `Trigger_ModifyRowDT_urforms` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `Trigger_ModifyRowDT_urforms` BEFORE UPDATE ON `_urforms` FOR EACH ROW BEGIN
 SET NEW.modifyDT = now();
 END */$$


DELIMITER ;

/* Trigger structure for table `_users` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `Trigger_CreateRowDT_users` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `Trigger_CreateRowDT_users` BEFORE INSERT ON `_users` FOR EACH ROW BEGIN
 SET NEW.createDT = now();
 SET NEW.modifyDT = now();
 END */$$


DELIMITER ;

/* Trigger structure for table `_users` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `Trigger_ModifyRowDT_users` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `Trigger_ModifyRowDT_users` BEFORE UPDATE ON `_users` FOR EACH ROW BEGIN
 SET NEW.modifyDT = now();
 END */$$


DELIMITER ;

/* Trigger structure for table `_wares` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `Trigger_CreateRowDT_wares` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `Trigger_CreateRowDT_wares` BEFORE INSERT ON `_wares` FOR EACH ROW BEGIN
 SET NEW.createDT = now();
 SET NEW.modifyDT = now();
 SET NEW.slug = translit(NEW.name);
 END */$$


DELIMITER ;

/* Trigger structure for table `_wares` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `Trigger_ModifyRowDT_wares` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `Trigger_ModifyRowDT_wares` BEFORE UPDATE ON `_wares` FOR EACH ROW BEGIN
 SET NEW.modifyDT = now();
 SET NEW.slug = translit(NEW.name);
 END */$$


DELIMITER ;

/* Trigger structure for table `_waresassoc` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `Trigger_CreateRowDT_waresassoc` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `Trigger_CreateRowDT_waresassoc` BEFORE INSERT ON `_waresassoc` FOR EACH ROW BEGIN
 SET NEW.createDT = now();
 SET NEW.modifyDT = now();
 END */$$


DELIMITER ;

/* Trigger structure for table `_waresassoc` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `Trigger_ModifyRowDT_waresassoc` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `Trigger_ModifyRowDT_waresassoc` BEFORE UPDATE ON `_waresassoc` FOR EACH ROW BEGIN
 SET NEW.modifyDT = now();
 END */$$


DELIMITER ;

/* Trigger structure for table `_waresimages` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `Trigger_CreateRowDT_waresimages` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `Trigger_CreateRowDT_waresimages` BEFORE INSERT ON `_waresimages` FOR EACH ROW BEGIN
 SET NEW.createDT = now();
 SET NEW.modifyDT = now();
 END */$$


DELIMITER ;

/* Trigger structure for table `_waresimages` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `Trigger_ModifyRowDT_waresimages` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `Trigger_ModifyRowDT_waresimages` BEFORE UPDATE ON `_waresimages` FOR EACH ROW BEGIN
 SET NEW.modifyDT = now();
 END */$$


DELIMITER ;

/* Trigger structure for table `_warespars` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `Trigger_CreateRowDT_warespars` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `Trigger_CreateRowDT_warespars` BEFORE INSERT ON `_warespars` FOR EACH ROW BEGIN
 SET NEW.createDT = now();
 SET NEW.modifyDT = now();
 END */$$


DELIMITER ;

/* Trigger structure for table `_warespars` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `Trigger_ModifyRowDT_warespars` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `Trigger_ModifyRowDT_warespars` BEFORE UPDATE ON `_warespars` FOR EACH ROW BEGIN
 SET NEW.modifyDT = now();
 END */$$


DELIMITER ;

/* Trigger structure for table `_waresrewievs` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `Trigger_CreateRowDT_waresrewievs` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `Trigger_CreateRowDT_waresrewievs` BEFORE INSERT ON `_waresrewievs` FOR EACH ROW BEGIN
 SET NEW.createDT = now();
 SET NEW.modifyDT = now();
 END */$$


DELIMITER ;

/* Trigger structure for table `_waresrewievs` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `Trigger_ModifyRowDT_waresrewievs` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `Trigger_ModifyRowDT_waresrewievs` BEFORE UPDATE ON `_waresrewievs` FOR EACH ROW BEGIN
 SET NEW.modifyDT = now();
 END */$$


DELIMITER ;

/* Trigger structure for table `_waresuopinions` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `Trigger_CreateRowDT_waresuopinions` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `Trigger_CreateRowDT_waresuopinions` BEFORE INSERT ON `_waresuopinions` FOR EACH ROW BEGIN
 SET NEW.createDT = now();
 SET NEW.modifyDT = now();
 UPDATE _wares set popularity = ROUND((popularity+NEW.mark)/2, 0) where rid = new._wares_rid;
 END */$$


DELIMITER ;

/* Trigger structure for table `_waresuopinions` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `Trigger_ModifyRowDT_waresuopinions` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `Trigger_ModifyRowDT_waresuopinions` BEFORE UPDATE ON `_waresuopinions` FOR EACH ROW BEGIN
 SET NEW.modifyDT = now();
 UPDATE _wares set popularity = ROUND((popularity+NEW.mark)/2, 0) where rid = new._wares_rid;
 END */$$


DELIMITER ;

/* Trigger structure for table `sys_options` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `Trigger_CreateRowDTsys_options` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `Trigger_CreateRowDTsys_options` BEFORE INSERT ON `sys_options` FOR EACH ROW BEGIN
 SET NEW.createDT = now();
 SET NEW.modifyDT = now();
 END */$$


DELIMITER ;

/* Trigger structure for table `sys_options` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `Trigger_ModifyRowDTsys_options` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `Trigger_ModifyRowDTsys_options` BEFORE UPDATE ON `sys_options` FOR EACH ROW BEGIN
 SET NEW.modifyDT = now();
 END */$$


DELIMITER ;

/* Trigger structure for table `sys_services` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `Trigger_CreateRowDTsys_services` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `Trigger_CreateRowDTsys_services` BEFORE INSERT ON `sys_services` FOR EACH ROW BEGIN
 SET NEW.createDT = now();
 SET NEW.modifyDT = now();
 END */$$


DELIMITER ;

/* Trigger structure for table `sys_services` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `Trigger_ModifyRowDTsys_services` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `Trigger_ModifyRowDTsys_services` BEFORE UPDATE ON `sys_services` FOR EACH ROW BEGIN
 SET NEW.modifyDT = now();
 END */$$


DELIMITER ;

/* Trigger structure for table `sys_users` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `Trigger_CreateRowDTsys_users` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `Trigger_CreateRowDTsys_users` BEFORE INSERT ON `sys_users` FOR EACH ROW BEGIN
 SET NEW.createDT = now();
 SET NEW.modifyDT = now();
 END */$$


DELIMITER ;

/* Trigger structure for table `sys_users` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `Trigger_ModifyRowDTsys_users` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `Trigger_ModifyRowDTsys_users` BEFORE UPDATE ON `sys_users` FOR EACH ROW BEGIN
 SET NEW.modifyDT = now();
 END */$$


DELIMITER ;

/* Function  structure for function  `SFE_GetItemShortDescr` */

/*!50003 DROP FUNCTION IF EXISTS `SFE_GetItemShortDescr` */;
DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` FUNCTION `SFE_GetItemShortDescr`(wareRid INT, pritemRid INT) RETURNS varchar(255) CHARSET utf8
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
	
	RETURN shortDescr;
END */$$
DELIMITER ;

/* Function  structure for function  `SFE_GetPrItemsWaresRid` */

/*!50003 DROP FUNCTION IF EXISTS `SFE_GetPrItemsWaresRid` */;
DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` FUNCTION `SFE_GetPrItemsWaresRid`(pritemNAME VARCHAR(255)) RETURNS int(11)
BEGIN
	DECLARE wareRID INT;
	DECLARE wareMODELALIAS VARCHAR(255);
	DECLARE oldpritemNAME VARCHAR(255);
	DECLARE findedQUAN INT;
	DECLARE findedQUAN_1 INT;
	DECLARE brandsRID INT;
	DECLARE categoriesRID INT;
	SET oldpritemNAME = pritemNAME;
	SET pritemNAME = UPPER(pritemNAME);
	SET pritemNAME = REPLACE(pritemNAME,' ','');
	SET pritemNAME = REPLACE(pritemNAME,'-','');
	SET pritemNAME = REPLACE(pritemNAME,'\\','');
	SET pritemNAME = REPLACE(pritemNAME,'/','');
	
	select count(_wares_rid) INTO findedQUAN_1 from _waresassoc where _waresassoc.name = oldpritemNAME;
	IF findedQUAN_1 > 0 THEN RETURN 0;
	END IF;
	select count(_wares.rid), _wares.rid, _wares._brands_rid, _wares.model_alias, _wares._categories_rid INTO findedQUAN, wareRID, brandsRID, wareMODELALIAS, categoriesRID from _wares
	join _brands ON _brands.rid = _wares._brands_rid
	left join _brandsassoc ON _brandsassoc._brands_rid = _brands.rid
	where CONCAT(' ', pritemNAME, ' ') LIKE CONCAT('%',UPPER(_brands.name),_wares.model_alias,'%') OR 
	CONCAT(' ', pritemNAME, ' ') LIKE CONCAT('%',UPPER(_brandsassoc.name),_wares.model_alias,'%') GROUP BY _wares.rid limit 1;
	IF findedQUAN > 0  AND findedQUAN_1 < 1 THEN
		insert into _waresassoc(name, _wares_rid, _brands_rid, _categories_rid) values(oldpritemNAME, wareRID, brandsRID, categoriesRID);
		
	END IF;
	RETURN brandsRID;
    END */$$
DELIMITER ;

/* Function  structure for function  `translit` */

/*!50003 DROP FUNCTION IF EXISTS `translit` */;
DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` FUNCTION `translit`(s CHAR(255) ) RETURNS char(255) CHARSET utf8
    DETERMINISTIC
BEGIN
	DECLARE i INT DEFAULT 0;
	DECLARE output VARCHAR(500) CHARACTER SET 'utf8' DEFAULT '';
	DECLARE str_len INT DEFAULT CHAR_LENGTH(s);
	DECLARE c VARCHAR(1) CHARACTER SET utf8; 
	DECLARE is_trans_present TINYINT UNSIGNED; 
	DECLARE c_trans VARCHAR(3) CHARACTER SET utf8; 
	DECLARE ok_symbols VARCHAR(255) CHARACTER SET utf8
	DEFAULT '-01234567890abcdefghijklmnopqrstuvwxyz';
	
	SET s = TRIM(s); 
	SET s = LCASE(CONVERT(s USING utf8));
	WHILE i <=str_len DO 
		SET c_trans = '';
		SET is_trans_present = 0;
		SET c = CONVERT(SUBSTR(s, i, 1) USING utf8); 
		IF LOCATE(c, ok_symbols) = 0 THEN 
			SELECT COUNT(`char_to`) INTO is_trans_present FROM `_translit` WHERE `char_from`=c;
			IF is_trans_present > 0 THEN
				SELECT `char_to` INTO c_trans FROM `_translit` WHERE `char_from`=c LIMIT 1;
				
				IF c_trans IS NOT NULL AND c_trans<>'' THEN 
					SET output = CONCAT(output, c_trans);
				END IF;
			END IF;
		ELSE
			SET output = CONCAT(output, c); 
		END IF;
		SET i = i + 1;
	END WHILE;
	RETURN output; 
    END */$$
DELIMITER ;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
