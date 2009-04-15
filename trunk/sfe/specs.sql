/*
SQLyog Community Edition- MySQL GUI v8.03 
MySQL - 5.0.45 : Database - saleinform
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

/* Trigger structure for table `_categories` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `Trigger_CreateRowDT_categories` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `Trigger_CreateRowDT_categories` BEFORE INSERT ON `_categories` FOR EACH ROW BEGIN
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
 SET NEW.slug = translit(NEW.name);
 END */$$


DELIMITER ;

/* Trigger structure for table `_clients` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `Trigger_CreateRowDT_clients` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `Trigger_CreateRowDT_clients` BEFORE INSERT ON `_clients` FOR EACH ROW BEGIN
  SET new.slug = translit(NEW.name);
 END */$$


DELIMITER ;

/* Trigger structure for table `_clients` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `Trigger_ModifyRowDT_clients` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `Trigger_ModifyRowDT_clients` BEFORE UPDATE ON `_clients` FOR EACH ROW BEGIN
  SET new.slug = translit(NEW.name);
 END */$$


DELIMITER ;

/* Trigger structure for table `_cluopinions` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `Trigger_CreateRowDT_cluopinions` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `Trigger_CreateRowDT_cluopinions` BEFORE INSERT ON `_cluopinions` FOR EACH ROW BEGIN
  UPDATE _clients set popularity = (popularity+NEW.mark)/2 where rid = NEW._clients_rid;
 END */$$


DELIMITER ;

/* Trigger structure for table `_cluopinions` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `Trigger_ModifyRowDT_cluopinions` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `Trigger_ModifyRowDT_cluopinions` BEFORE UPDATE ON `_cluopinions` FOR EACH ROW BEGIN
 UPDATE _clients set popularity = (popularity + NEW.mark)/2 where rid = NEW._clients_rid;
 END */$$


DELIMITER ;

/* Trigger structure for table `_news` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `Trigger_CreateRowDT_news` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `Trigger_CreateRowDT_news` BEFORE INSERT ON `_news` FOR EACH ROW BEGIN
 set NEW.slug = translit(NEW.name);
 END */$$


DELIMITER ;

/* Trigger structure for table `_news` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `Trigger_ModifyRowDT_news` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `Trigger_ModifyRowDT_news` BEFORE UPDATE ON `_news` FOR EACH ROW BEGIN
  set NEW.slug = translit(NEW.name);
 END */$$


DELIMITER ;

/* Trigger structure for table `_newscategories` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `Trigger_CreateRowDT_newscategories` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `Trigger_CreateRowDT_newscategories` BEFORE INSERT ON `_newscategories` FOR EACH ROW BEGIN
 set new.slug = translit(NEW.name);
 END */$$


DELIMITER ;

/* Trigger structure for table `_newscategories` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `Trigger_ModifyRowDT_newscategories` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `Trigger_ModifyRowDT_newscategories` BEFORE UPDATE ON `_newscategories` FOR EACH ROW BEGIN
  set new.slug = translit(NEW.name);
 END */$$


DELIMITER ;

/* Trigger structure for table `_pritems` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `Trigger_CreateRowDT_pritems` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `Trigger_CreateRowDT_pritems` BEFORE INSERT ON `_pritems` FOR EACH ROW BEGIN
 SET NEW.slug = translit(NEW.name);
 END */$$


DELIMITER ;

/* Trigger structure for table `_pritems` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `Trigger_ModifyRowDT_pritems` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `Trigger_ModifyRowDT_pritems` BEFORE UPDATE ON `_pritems` FOR EACH ROW BEGIN
 SET NEW.slug = translit(NEW.name);
 END */$$


DELIMITER ;

/* Trigger structure for table `_wares` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `Trigger_CreateRowDT_wares` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `Trigger_CreateRowDT_wares` BEFORE INSERT ON `_wares` FOR EACH ROW BEGIN
 SET NEW.slug = translit(NEW.name);
 END */$$


DELIMITER ;

/* Trigger structure for table `_wares` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `Trigger_ModifyRowDT_wares` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `Trigger_ModifyRowDT_wares` BEFORE UPDATE ON `_wares` FOR EACH ROW BEGIN
 SET NEW.slug = translit(NEW.name);
 END */$$


DELIMITER ;

/* Trigger structure for table `_waresuopinions` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `Trigger_CreateRowDT_waresuopinions` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `Trigger_CreateRowDT_waresuopinions` BEFORE INSERT ON `_waresuopinions` FOR EACH ROW BEGIN
 UPDATE _wares set popularity = ROUND((popularity+NEW.mark)/2, 0) where rid = new._wares_rid;
 END */$$


DELIMITER ;

/* Trigger structure for table `_waresuopinions` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `Trigger_ModifyRowDT_waresuopinions` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `Trigger_ModifyRowDT_waresuopinions` BEFORE UPDATE ON `_waresuopinions` FOR EACH ROW BEGIN
 UPDATE _wares set popularity = ROUND((popularity+NEW.mark)/2, 0) where rid = new._wares_rid;
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
