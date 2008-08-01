<?php
/*
 * Price - client's price
 */
require_once(OPENBIZ_HOME."/bin/xmltoarray.php");
class PriceXML
{
	/*Statuses*/
	public $ERROR_content = '';
	public $LOADS_quan = 0;
	/**********/
	private $clientsRid;
	private $priceURL;
	private $docARR;
	private $DB;
	private $price_DATE;
	private $tmppricesstorageRID;
	private $availabletypesARR;
	private $prtypesARR;
	private $nationalCurrencyRid;
	private $clcategoriesARR;
	private $currenciesARR;
	
	public function __construct($clientsRid, $priceURL)
	{
		$this->clientsRid = $clientsRid;
		$this->priceURL = $priceURL;	
	}
	
	public function LoadPrice()
	{
		libxml_clear_errors();
		libxml_use_internal_errors(true);
        $doc = new DOMDocument();
        $doc->load($this->priceURL);
		$errors = libxml_get_errors();
        if (!empty($errors)){
        	$this->ERROR_content .= sprintf("ERROR: Ошибка загрузки прайса по адресу: %s\n", $this->priceURL); 
		}
		else {
			#try{
				$xmlName = tempnam(APP_HOME.'/tmpfiles/prices/', 'price_');
				$xmlContent = $doc->saveXML();
				unlink($xmlName);
				$fXML = fopen($xmlName.'.xml', 'w') or die("can't open pdf file to write");
      			fwrite($fXML, $xmlContent) or die("can't write to the pdf file");
      			fclose($fXML);
      			unset($doc);
      			$doc = new DOMDocument();
      			$doc->load($xmlName.'.xml');
      			if(!$doc->validate()) $this->ERROR_content .= sprintf("ERROR: Ошибка валидации прайса\n");
				$parser = new XMLParser($xmlName.'.xml', 'file', 1);
				$this->docARR = $parser->getTree();      
				$this->PrepareXML();		
      			unlink($xmlName.'.xml');
			#} catch (Exception $e) {
			#	$this->ERROR_content .= sprintf($e->getMessage());
			#	return False;
			#}
		}
		if(mktime(0, 0, 0, date("m"), date("d")-14, date("Y"))<=$this->docARR['YML_CATALOG']['ATTRIBUTES']['DATE']){
			$this->ERROR_content .= sprintf("ERROR: Прайс устарел.");
			return False;
		}
		if(empty($this->ERROR_content)){
			global $g_BizSystem;
			$this->DB = $g_BizSystem->GetDBConnection();
			try{
				//var_dump($this->docARR);
				$this->DB->beginTransaction();
				$this->DBTransaction();
				$this->TempReload();
				$this->DB->commit();
			}
			catch (Exception $e) {
  				$this->DB->rollBack();
  				$this->LOADS_quan = 0;
  				$this->ERROR_content .= sprintf("ERROR: Ошибка транзакции => ".$e->getMessage());
  				return False;
			}
			return True;
		}
		return False;
	}

	public function DBTransaction()
	{
		//$stmt = $this->DB->prepare("UPDATE _pritems SET archive = 0 WHERE _clients_rid = :_clients_rid");
		$stmt = $this->DB->prepare("DELETE FROM _pritems WHERE _clients_rid = :_clients_rid");
		$_clients_rid = $this->clientsRid;
		$stmt->bindParam(':_clients_rid', $_clients_rid);
		$stmt->execute();
		$stmt = $this->DB->prepare("DELETE FROM _tmppricesstorage WHERE _clients_rid = :_clients_rid");
		$stmt->bindParam(':_clients_rid', $_clients_rid);
		$_clients_rid = $this->clientsRid;
		$stmt->execute();
		$stmt = $this->DB->prepare("INSERT INTO _tmppricesstorage (_clients_rid, price_date, clname, clcompany, clurl) VALUES(:_clients_rid, :price_date, :clname, :clcompany, :clurl)");
		$stmt->bindParam(':_clients_rid', $_clients_rid);
		$stmt->bindParam(':price_date', $price_DATE);
		$stmt->bindParam(':clname', $company_NAME);
		$stmt->bindParam(':clcompany', $company_COMPANY);
		$stmt->bindParam(':clurl', $company_URL);
		$_clients_rid = $this->clientsRid;
		$this->price_DATE = $this->docARR['YML_CATALOG']['ATTRIBUTES']['DATE'];
		$price_DATE = $this->price_DATE; 
		$company_NAME = $this->docARR['YML_CATALOG']['SHOP']['NAME']['VALUE'];
		$company_COMPANY = $this->docARR['YML_CATALOG']['SHOP']['COMPANY']['VALUE'];
		$company_URL = $this->docARR['YML_CATALOG']['SHOP']['URL']['VALUE'];
		$stmt->execute();
		BizSystem::log(LOG_DEBUG, "PRICELOADER", "PriceLoader Info = Create New tmppricesstorage");
		$this->tmppricesstorageRID = $this->DB->lastInsertId();
		$this->GetAvailableTypes();
		$this->GetPricesTypes();
		$this->CurrenciesPROCESING();
		$this->CategoriesPROCESING();
	}
	
	public function CurrenciesPROCESING(){
		$stmt = $this->DB->prepare("SELECT _currency.cod, _countries.rid, _countries.cod as country_cod FROM _clients
									JOIN _cities ON _cities.rid = _clients._cities_rid
									JOIN _regions ON _regions.rid = _cities._regions_rid
									JOIN _countries ON _countries.rid = _regions._countries_rid
									JOIN _currency ON _currency.rid = _countries._currency_rid
									WHERE _clients.rid = :_clients_rid");
		$stmt->bindParam(':_clients_rid', $this->clientsRid);
		$stmt->execute();
		$row = $stmt->fetch(PDO::FETCH_NAMED);
		$countries_RID = $row['rid'];
		$national_CURRENCY = $row['cod'];
		$national_RATE = null;
		$current_BASE = null;
		
		foreach($this->docARR['YML_CATALOG']['SHOP']['CURRENCIES']['CURRENCY'] as $currency){
			if($currency['ATTRIBUTES']['RATE']=='1') $current_BASE = $currency['ATTRIBUTES']['ID'];
			if($currency['ATTRIBUTES']['ID']==$national_CURRENCY) $national_RATE = $currency['ATTRIBUTES']['RATE']; 
		}
		$koeff = 1;
		if($current_BASE=='RUR') $current_BASE = 'RUB';
		if($national_CURRENCY != $current_BASE){
			if(!$national_RATE || $national_RATE=='CBRF'){
				$stmt = $this->DB->prepare("SELECT cource FROM _officialcources
											JOIN _currency ON _officialcources._currency_rid = _currency.rid 	
											WHERE _countries_rid = :_countries_rid AND
											_currency.cod = :cod AND
											courcedate <= :courcedate
											ORDER BY courcedate DESC LIMIT 1");
				$stmt->bindParam(':_countries_rid', $countries_RID);
				$stmt->bindParam(':cod', $current_BASE);
				$stmt->bindParam(':courcedate', $this->price_DATE);
				$stmt->execute();
				$row = $stmt->fetch(PDO::FETCH_NAMED);
				$koeff = 1/$row['cource'];
			}
			else $koeff = $national_RATE;
		}
		$stmt_insert = $this->DB->prepare("INSERT INTO _tmppritemscources(_tmppricesstorage_rid, _currency_rid, cource) VALUES (:_tmppricesstorage_rid, :_currency_rid, :cource) ON DUPLICATE KEY UPDATE _tmppricesstorage_rid = :_tmppricesstorage_rid, _currency_rid = :_currency_rid, cource = :cource");
		$stmt_select = $this->DB->prepare("SELECT rid FROM _currency WHERE cod = :cod");
		
		foreach($this->docARR['YML_CATALOG']['SHOP']['CURRENCIES']['CURRENCY'] as $currency){
			$t = isset($currency['ATTRIBUTES']['ID'])?$currency['ATTRIBUTES']['ID']:$currency['ID'];
			if($t=='RUR') $t='RUB';
			$stmt_select->bindParam(':cod', $t);
			$stmt_select->execute();
			$row = $stmt_select->fetch(PDO::FETCH_NAMED);
			//if($t == $national_CURRENCY) {$this->nationalCurrencyRid = $row['rid']; continue;}
			$stmt_insert->bindParam(':_tmppricesstorage_rid', $this->tmppricesstorageRID);
			$stmt_insert->bindParam(':_currency_rid', $row['rid']);
			$t = $currency['ATTRIBUTES']['RATE'];
			if($t == 'CBRF'){
				$stmt_select_cource = $this->DB->prepare("SELECT cource FROM _officialcources WHERE _countries_rid = :_countries_rid AND _currency_rid = :_currency_rid ORDER BY courcedate DESC LIMIT 1");
				$stmt_select_cource->bindParam(':_countries_rid', $countries_RID);
				$stmt_select_cource->bindParam(':_currency_rid', $row['rid']);
				$stmt_select_cource->execute();
				$row1 = $stmt_select_cource->fetch(PDO::FETCH_NAMED);
				$t = $row1['cource'];	
			}
			else $t = $currency['ATTRIBUTES']['RATE']/$koeff;
			echo $currency['ATTRIBUTES']['ID'].' => '.$t.' => '.$koeff.'<br>';
			$currencyID = ($currency['ATTRIBUTES']['ID']=='RUR')?'RUB':$currency['ATTRIBUTES']['ID']; 
			if($currencyID==$national_CURRENCY) $t=1;
			$stmt_insert->bindParam(':cource', $t);
			$stmt_insert->execute();
			$this->currenciesARR[$currency['ATTRIBUTES']['ID']] = $row['rid'];
		}
		//var_dump($this->currenciesARR);
	}
	
	public function CategoriesPROCESING(){
		foreach($this->docARR['YML_CATALOG']['SHOP']['CATEGORIES']['CATEGORY'] as $row){
			$stmt = $this->DB->prepare("INSERT INTO _clcategories(_clcategories_rid, _clients_rid, clrid, name) 
										VALUES (:_clcategories_rid, :_clients_rid, :clrid, :name)
										ON DUPLICATE KEY UPDATE 
										_clcategories_rid = :_clcategories_rid, 
										_clients_rid = :_clients_rid, 
										clrid = :clrid, 
										name = :name");
			$stmt->bindParam(':_clcategories_rid', $t = isset($row['ATTRIBUTES']['PARENTID'])?$row['ATTRIBUTES']['PARENTID']:'0');
			$stmt->bindParam(':_clients_rid', $this->clientsRid);
			$stmt->bindParam(':clrid', $row['ATTRIBUTES']['ID']);
			$stmt->bindParam(':name', $row['VALUE']);
			$stmt->execute();
			//$this->OffersPROCESING($row['ATTRIBUTES']['ID'], $this->DB->lastInsertId());
		}
		$this->GetClcategories();
		$this->OffersPROCESING();
	}
	
	public function OffersPROCESING(){
		$offersQuan = count($this->docARR['YML_CATALOG']['SHOP']['OFFERS']['OFFER']);
		foreach($this->docARR['YML_CATALOG']['SHOP']['OFFERS']['OFFER'] as $row){
			if(!isset($row['CATEGORYID']) || !isset($this->clcategoriesARR[$row['CATEGORYID']['VALUE']])) continue;
			$_clcategories_rid = $this->clcategoriesARR[$row['CATEGORYID']['VALUE']];
			$stmt = $this->DB->prepare("INSERT INTO _tmppritems(_tmppricesstorage_rid, _clcategories_rid, _availabletypes_rid, offer_id, offer_type) 
										VALUES (:_tmppricesstorage_rid, :_clcategories_rid, :_availabletypes_rid, :offer_id, :offer_type)");
			$stmt->bindParam(':_tmppricesstorage_rid', $this->tmppricesstorageRID);
			$stmt->bindParam(':_clcategories_rid', $_clcategories_rid);
			$available = 'Y';
			if($row['ATTRIBUTES']['AVAILABLE']){
				if($row['ATTRIBUTES']['AVAILABLE']=='false')  $available = 'O';
			}
			$stmt->bindParam(':_availabletypes_rid', $this->availabletypesARR[$available]);
			$stmt->bindParam(':offer_id', $row['ATTRIBUTES']['ID']);
			$stmt->bindParam(':offer_type', $t=isset($row['ATTRIBUTES']['TYPE'])?$row['ATTRIBUTES']['TYPE']:'');
			$stmt->execute();
			unset($row['CATEGORYID']);
			$this->OfferAttributesPROCESING($row, $this->DB->lastInsertId());
			$this->LOADS_quan++;
			BizSystem::log(LOG_DEBUG, "--------------->", "Complete {$this->LOADS_quan}/{$offersQuan}\n");
		}
	}
	
	public function OfferAttributesPROCESING($row, $_tmppritems_rid){
		foreach($row as $itemName => $item){
			if($itemName=='ATTRIBUTES') continue;
			if(!$item['VALUE']) continue;
			else $item['VALUE'] = strip_tags($item['VALUE']); # удаляем все HTML теги		
			if($itemName == 'PRICE'){
				# if price is 0 then delete pritem and continue
				if(!$item['VALUE']){
					$stmt_d = $this->DB->prepare("DELETE FROM _tmppritems WHERE _tmppritems_rid = :_tmppritems_rid");
					$stmt_d->bindParam(':_tmppritems_rid', $_tmppritems_rid);
					$stmt_d->execute();
					return;
				}
				$stmt = $this->DB->prepare("INSERT INTO _tmpprices(_tmppritems_rid, _prtypes_rid, _currency_rid, price) 
											VALUES (:_tmppritems_rid, :_prtypes_rid, :_currency_rid, :price)");
				$stmt->bindParam(':_tmppritems_rid', $_tmppritems_rid);
				$prtype = 'R';
				if(isset($item['ATTRIBUTES']['TYPE'])) $prtype = $item['ATTRIBUTES']['TYPE'];
				$stmt->bindParam(':_prtypes_rid', $this->prtypesARR[$prtype]);
				$_currency_rid = isset($this->currenciesARR[$row['CURRENCYID']['VALUE']])?$this->currenciesARR[$row['CURRENCYID']['VALUE']]:null;
				$stmt->bindParam(':_currency_rid', $_currency_rid);
				$stmt->bindParam(':price', $item['VALUE']);
				$stmt->execute();
			}
			elseif($itemName == 'PICTURE'){
				$mimeArray = array('image/bmp', 'image/gif', 'image/jpeg', 'image/pjpeg', 'image/png',  'image/x-png', 'image/tiff');
				if($item['VALUE']){
					try{
   						$finfo = finfo_open(FILEINFO_MIME, "/usr/share/misc/magic");
   						$mime = finfo_file($finfo, $item['VALUE']);
   						if(in_array($mime, $mimeArray)){
   							$end = '';
   							switch ($mime){
   								case 'image/bmp': {$end='.bmp';break;}
   								case 'image/gif': {$end='.gif';break;}
   								case 'image/jpeg': {$end='.jpg';break;}
   								case 'image/pjpeg': {$end='.jpg';break;}
   								case 'image/png': {$end='.png';break;}
   								case 'image/x-png': {$end='.png';break;}
   								case 'image/tiff': {$end='.tiff';break;}
   							}
							$contents = file_get_contents($item['VALUE']);
							$imgName = tempnam(APP_HOME.'/tmpfiles/prices/', 'img_');
							$fIMG = fopen($imgName.$end, 'w');
   							fwrite($fIMG, $contents);
   							fclose($fIMG);
   							$stmt = $this->DB->prepare("INSERT INTO _tmppritemsimgs(_tmppritems_rid, name, type, size, image) 
   																	values(:_tmppritems_rid, :name, :type, :size, :image)");
   							$stmt->bindParam(':_tmppritems_rid', $_tmppritems_rid);
   							$tArr = array_reverse(explode('/', $imgName.$end));
   							$stmt->bindParam(':name', $tArr[0]);
   							$stmt->bindParam(':type', $mime);
   							$stmt->bindParam(':size', filesize($imgName.$end));
   							$stmt->bindParam(':image', $contents);
   							$stmt->execute();
   							unlink($imgName.$end);
   							unlink($imgName);
   						}
					}catch (Exception $e){
						$this->ERROR_content .= "ERROR: Не могу загрузить изображение по адресу {$item['VALUE']} ".$e->getMessage();
					}
				}
			}
			elseif($itemName == 'CURRENCYID') continue;
			else {
				if($itemName=='DESCRIPTION') $item['VALUE'] = str_replace('//', '; ', $item['VALUE']);
				$stmt = $this->DB->prepare("INSERT INTO _tmppritemsattrs(_tmppritems_rid, attr_name, attr_value) 
											VALUES (:_tmppritems_rid, :attr_name, :attr_value)");
				$stmt->bindParam(':_tmppritems_rid', $_tmppritems_rid);
				$stmt->bindParam(':attr_name', $itemName);
				$stmt->bindParam(':attr_value', $item['VALUE']);
				$stmt->execute();
			}
		}
	}
	
	public function GetAvailableTypes(){
		$stmt = $this->DB->prepare("SELECT rid, cod FROM _availabletypes");
		$stmt->execute();
		while ($row = $stmt->fetch(PDO::FETCH_NAMED)) $this->availabletypesARR[$row['cod']] = $row['rid'];
	}

	public function GetPricesTypes(){
		$stmt = $this->DB->prepare("SELECT rid, cod FROM _prtypes");
		$stmt->execute();
		while ($row = $stmt->fetch(PDO::FETCH_NAMED)) $this->prtypesARR[$row['cod']] = $row['rid'];
	}

	public function GetClcategories(){
		$stmt = $this->DB->prepare("SELECT rid, clrid FROM _clcategories WHERE _clients_rid=:_clients_rid");
		$stmt->bindParam(':_clients_rid', $this->clientsRid);
		$stmt->execute();
		while ($row = $stmt->fetch(PDO::FETCH_NAMED)) $this->clcategoriesARR[$row['clrid']] = $row['rid'];
	}
	
	public function TempReload(){
		// Переливка в основную базу
		# 1. Переливка курсов валют
		$stmt = $this->DB->prepare("SELECT * FROM _tmppritemscources WHERE _tmppricesstorage_rid = :_tmppricesstorage_rid" );
		$stmt->bindParam(':_tmppricesstorage_rid', $this->tmppricesstorageRID);
		$stmt->execute();
		$stmt1 = $this->DB->prepare("INSERT INTO _currcources(_clients_rid, _currency_rid, cource, courcedate) 
												VALUES(:_clients_rid, :_currency_rid, :cource, :courcedate)
												ON DUPLICATE KEY UPDATE _clients_rid = :_clients_rid, _currency_rid = :_currency_rid, cource = :cource, courcedate = :courcedate" );
		while ($row = $stmt->fetch(PDO::FETCH_NAMED)){
			$stmt1->bindParam(':_clients_rid', $this->clientsRid);
			$stmt1->bindParam(':_currency_rid', $row['_currency_rid']);
			$stmt1->bindParam(':cource', $row['cource']);
			$stmt1->bindParam(':courcedate', $this->price_DATE);
			$stmt1->execute();
		}
		# 2. Получить прописанные категории
		$stmt2 = $this->DB->prepare("SELECT * FROM _clcategories WHERE _clients_rid = :_clients_rid AND _categories_rid is not NULL" );
		$stmt2->bindParam(':_clients_rid', $this->clientsRid);
		$stmt2->execute();
		$quanIndex = 0;
		# 3. Для каждой прописанной категории получить перечень параметров предложения
		while ($row2 = $stmt2->fetch(PDO::FETCH_NAMED)){
			# 4. Получить перечень предложений по категории
			$stmt3 = $this->DB->prepare("SELECT * FROM _tmppritems
											WHERE _clcategories_rid = :_clcategories_rid" );
			$stmt3->bindParam(':_clcategories_rid', $row2['rid']);
			$stmt3->execute();
			# 5. Получить перечень параметров по категории
			$stmt4 = $this->DB->prepare("SELECT * FROM _catpars
											JOIN _pars ON _pars.rid = _catpars._pars_rid
											WHERE _categories_rid = :_categories_rid");
			$stmt4->bindParam(':_categories_rid', $row2['_categories_rid']);
			$stmt4->execute();
			
			while ($row3 = $stmt3->fetch(PDO::FETCH_NAMED)){
				# 6. Получить аттрибуты предложения
				$stmt5 = $this->DB->prepare("SELECT * FROM _tmppritemsattrs WHERE _tmppritems_rid = :_tmppritems_rid");
				# 7. Получить цены предложения
				$stmt6 = $this->DB->prepare("SELECT * FROM _tmpprices WHERE _tmppritems_rid = :_tmppritems_rid");
				# 8. Получить изображения предложения
				$stmt7 = $this->DB->prepare("SELECT * FROM _tmppritemsimgs WHERE _tmppritems_rid = :_tmppritems_rid");
				$stmt5->bindParam(':_tmppritems_rid', $row3['rid']);
				$stmt6->bindParam(':_tmppritems_rid', $row3['rid']);
				$stmt7->bindParam(':_tmppritems_rid', $row3['rid']);
				$stmt5->execute();
				$stmt6->execute();
				$stmt7->execute();
				
				$attrsArray = array();
				while ($row5 = $stmt5->fetch(PDO::FETCH_NAMED)){
					$attrsArray[$row5['attr_name']] = $row5['attr_value'];  
				}
				switch ($row3['offer_type']){
					case 'book': {
						// Переливаем книги по параметрам
						// Сначала вливаем в таблицу предложений
						$itemDescr = null;
						if(isset($attrsArray['DESCRIPTION']) && !empty($attrsArray['DESCRIPTION'])){
							$itemDescr = $attrsArray['DESCRIPTION'];
						}
						$stmt8 = $this->DB->prepare("INSERT INTO _pritems (_clients_rid, _categories_rid, _availabletypes_rid, name, short_descr,
																			link_ware, prdate, offer_id)
													 VALUES(:_clients_rid, :_categories_rid, :_availabletypes_rid, :name, :short_descr,
																			:link_ware, :prdate, :offer_id)");
						$stmt8->bindParam(':_clients_rid', $this->clientsRid);
						$stmt8->bindParam(':_categories_rid', $row2['_categories_rid']);
						$stmt8->bindParam(':_availabletypes_rid', $row3['_availabletypes_rid']);
						$stmt8->bindParam(':name', $attrsArray['NAME']);
						$stmt8->bindParam(':short_descr', $itemDescr);
						$stmt8->bindParam(':link_ware', $attrsArray['URL']);
						$stmt8->bindParam(':prdate', $this->price_DATE);
						$stmt8->bindParam(':offer_id', $row3['offer_id']);
						$stmt8->execute();
						$itemRid = $this->DB->lastInsertId();
						
						// Заливаем имеющиеся параметры
						while ($row4 = $stmt4->fetch(PDO::FETCH_NAMED)){
							if(empty($row4['tag'])) continue;
							$tag = mb_strtoupper($row4['tag']);
							if(array_key_exists($tag, $attrsArray)){
								$stmt11 = $this->DB->prepare("INSERT INTO _pritemspars(_pritems_rid, _pars_rid, value)
																			VALUES(:_pritems_rid, :_pars_rid, :value)");
								$stmt11->bindParam(':_pritems_rid', $itemRid);
								$stmt11->bindParam(':_pars_rid', $row4['_pars_rid']);
								$stmt11->bindParam(':value', $attrsArray[$tag]);
								$stmt11->execute();
							}
						}
						// Заливаем цены
						$stmt9 = $this->DB->prepare("INSERT INTO _prices(_pritems_rid, _prtypes_rid, _currency_rid, price)
																VALUES(:_pritems_rid, :_prtypes_rid, :_currency_rid, :price)");
						while($row6 = $stmt6->fetch(PDO::FETCH_NAMED)){
							$stmt9->bindParam(':_pritems_rid', $itemRid);
							$stmt9->bindParam(':_prtypes_rid', $row6['_prtypes_rid']);
							$stmt9->bindParam(':_currency_rid', $row6['_currency_rid']);
							$stmt9->bindParam(':price', $row6['price']);
							$stmt9->execute();
						}
						// Заливаем изображения, если не найден товар
						$stmt10 = $this->DB->prepare("INSERT INTO _pritemsimgs(_pritems_rid, name, type, size, image)
																VALUES(:_pritems_rid, :name, :type, :size, :image)");
						$row7 = $stmt7->fetch(PDO::FETCH_NAMED);
						if($row7){
							$stmt10->bindParam(':_pritems_rid', $itemRid);
							$stmt10->bindParam(':name', $row7['name']);
							$stmt10->bindParam(':type', $row7['type']);
							$stmt10->bindParam(':size', $row7['size']);
							$stmt10->bindParam(':image', $row7['image']);
							$stmt10->execute();
						}
						break;
					}
					case 'artist.title': {
						// Сначала вливаем в таблицу предложений
						$itemDescr = null;
						if(isset($attrsArray['DESCRIPTION']) && !empty($attrsArray['DESCRIPTION'])){
							$itemDescr = $attrsArray['DESCRIPTION'];
						}
						$stmt8 = $this->DB->prepare("INSERT INTO _pritems (_clients_rid, _categories_rid, _availabletypes_rid, name, short_descr,
																			link_ware, prdate, offer_id, model_alias)
													 VALUES(:_clients_rid, :_categories_rid, :_availabletypes_rid, :name, :short_descr,
																			:link_ware, :prdate, :offer_id, :model_alias)");
						$stmt8->bindParam(':_clients_rid', $this->clientsRid);
						$stmt8->bindParam(':_categories_rid', $row2['_categories_rid']);
						$stmt8->bindParam(':_availabletypes_rid', $row3['_availabletypes_rid']);
						$itemName = (isset($attrsArray['ARTIST']))?$attrsArray['ARTIST'].' '.$attrsArray['TITLE']:$attrsArray['TITLE'];
						$stmt8->bindParam(':name', $itemName);
						$stmt8->bindParam(':short_descr', $itemDescr);
						$stmt8->bindParam(':link_ware', $attrsArray['URL']);
						$stmt8->bindParam(':prdate', $this->priceDATE);
						$stmt8->bindParam(':offer_id', $row3['offer_id']);
						$itemAlias = $itemName;	
						$itemAlias = str_replace(' ','',$itemAlias);
						$itemAlias = str_replace('-','',$itemAlias);
						$itemAlias = str_replace('/','',$itemAlias);
						$itemAlias = str_replace('\\','',$itemAlias);
						$itemAlias = mb_strtoupper($itemAlias);
						$itemAlias = $this->toTranslit($itemAlias);
						$stmt8->bindParam(':model_alias', $itemAlias);
						$stmt8->execute();
						$itemRid = $this->DB->lastInsertId();
						// Заливаем имеющиеся параметры
						while ($row4 = $stmt4->fetch(PDO::FETCH_NAMED)){
							if(empty($row4['tag'])) continue;
							$tag = mb_strtoupper($row4['tag']);
							if(array_key_exists($tag, $attrsArray)){
								$stmt11 = $this->DB->prepare("INSERT INTO _pritemspars(_pritems_rid, _pars_rid, value)
																			VALUES(:_pritems_rid, :_pars_rid, :value)");
								$stmt11->bindParam(':_pritems_rid', $itemRid);
								$stmt11->bindParam(':_pars_rid', $row4['_pars_rid']);
								$stmt11->bindParam(':value', $attrsArray[$tag]);
								$stmt11->execute();
							}
						}
						// Заливаем цены
						$stmt9 = $this->DB->prepare("INSERT INTO _prices(_pritems_rid, _prtypes_rid, _currency_rid, price)
																VALUES(:_pritems_rid, :_prtypes_rid, :_currency_rid, :price)");
						while($row6 = $stmt6->fetch(PDO::FETCH_NAMED)){
							$stmt9->bindParam(':_pritems_rid', $itemRid);
							$stmt9->bindParam(':_prtypes_rid', $row6['_prtypes_rid']);
							$stmt9->bindParam(':_currency_rid', $row6['_currency_rid']);
							$stmt9->bindParam(':price', $row6['price']);
							$stmt9->execute();
						}
						// Заливаем изображения, если не найден товар
						$stmt10 = $this->DB->prepare("INSERT INTO _pritemsimgs(_pritems_rid, name, type, size, image)
																VALUES(:_pritems_rid, :name, :type, :size, :image)");
						$row7 = $stmt7->fetch(PDO::FETCH_NAMED);
						if($row7){
							$stmt10->bindParam(':_pritems_rid', $itemRid);
							$stmt10->bindParam(':name', $row7['name']);
							$stmt10->bindParam(':type', $row7['type']);
							$stmt10->bindParam(':size', $row7['size']);
							$stmt10->bindParam(':image', $row7['image']);
							$stmt10->execute();
						}
						break;
					}
					case 'tour': {
						// Сначала вливаем в таблицу предложений
						$itemDescr = null;
						if(isset($attrsArray['DESCRIPTION']) && !empty($attrsArray['DESCRIPTION'])){
							$itemDescr = $attrsArray['DESCRIPTION'];
						}
						$stmt8 = $this->DB->prepare("INSERT INTO _pritems (_clients_rid, _categories_rid, _availabletypes_rid, name, short_descr,
																			link_ware, prdate, offer_id)
													 VALUES(:_clients_rid, :_categories_rid, :_availabletypes_rid, :name, :short_descr,
																			:link_ware, :prdate, :offer_id)");
						$stmt8->bindParam(':_clients_rid', $this->clientsRid);
						$stmt8->bindParam(':_categories_rid', $row2['_categories_rid']);
						$stmt8->bindParam(':_availabletypes_rid', $row3['_availabletypes_rid']);
						$itemName = '';
						$itemName .= (isset($attrsArray['WORLDREGION']))?$attrsArray['WORLDREGION']:'';
						$itemName .= (isset($attrsArray['COUNTRY']))?$attrsArray['COUNTRY']:'';
						$itemName .= (isset($attrsArray['NAME']))?$attrsArray['NAME']:'';
						$itemName .= (isset($attrsArray['HOTEL_STARS']))?$attrsArray['HOTEL_STARS']:'';
						$itemName .= (isset($attrsArray['ROOM']))?$attrsArray['ROOM']:'';
						$itemName .= (isset($attrsArray['MEAL']))?$attrsArray['MEAL']:'';
						$stmt8->bindParam(':name', $itemName);
						$stmt8->bindParam(':short_descr', $itemDescr);
						$stmt8->bindParam(':link_ware', $attrsArray['URL']);
						$stmt8->bindParam(':prdate', $this->priceDATE);
						$stmt8->bindParam(':offer_id', $row3['offer_id']);
						$stmt8->execute();
						$itemRid = $this->DB->lastInsertId();
						// Заливаем имеющиеся параметры
						while ($row4 = $stmt4->fetch(PDO::FETCH_NAMED)){
							if(empty($row4['tag'])) continue;
							$tag = mb_strtoupper($row4['tag']);
							if(array_key_exists($tag, $attrsArray)){
								$stmt11 = $this->DB->prepare("INSERT INTO _pritemspars(_pritems_rid, _pars_rid, value)
																			VALUES(:_pritems_rid, :_pars_rid, :value)");
								$stmt11->bindParam(':_pritems_rid', $itemRid);
								$stmt11->bindParam(':_pars_rid', $row4['_pars_rid']);
								$stmt11->bindParam(':value', $attrsArray[$tag]);
								$stmt11->execute();
							}
						}
						// Заливаем цены
						$stmt9 = $this->DB->prepare("INSERT INTO _prices(_pritems_rid, _prtypes_rid, _currency_rid, price)
																VALUES(:_pritems_rid, :_prtypes_rid, :_currency_rid, :price)");
						while($row6 = $stmt6->fetch(PDO::FETCH_NAMED)){
							$stmt9->bindParam(':_pritems_rid', $itemRid);
							$stmt9->bindParam(':_prtypes_rid', $row6['_prtypes_rid']);
							$stmt9->bindParam(':_currency_rid', $row6['_currency_rid']);
							$stmt9->bindParam(':price', $row6['price']);
							$stmt9->execute();
						}
						// Заливаем изображения, если не найден товар
						$stmt10 = $this->DB->prepare("INSERT INTO _pritemsimgs(_pritems_rid, name, type, size, image)
																VALUES(:_pritems_rid, :name, :type, :size, :image)");
						$row7 = $stmt7->fetch(PDO::FETCH_NAMED);
						if($row7){
							$stmt10->bindParam(':_pritems_rid', $itemRid);
							$stmt10->bindParam(':name', $row7['name']);
							$stmt10->bindParam(':type', $row7['type']);
							$stmt10->bindParam(':size', $row7['size']);
							$stmt10->bindParam(':image', $row7['image']);
							$stmt10->execute();
						}
						break;
					}
					case 'ticket': {break;}
					case 'event-ticket': {break;}
					case 'vendor.model':{
						// Здесь никакие параметры не используем - льем прямо в базу
						$itemVendor = null;
						$itemModel = null;
						$itemName = null;
						$itemDescr = null;

						if(isset($attrsArray['TYPEPREFIX']) && !empty($attrsArray['TYPEPREFIX'])){
							$itemName = $attrsArray['TYPEPREFIX'].' '.$attrsArray['VENDOR'].' '.$attrsArray['MODEL'];
						} else $itemName = $attrsArray['VENDOR'].' '.$attrsArray['MODEL'];
						// Осуществяем поиск в таблице ассоциаций
						if($result = $this->GetWareRID($itemName)){ 
							$itemVendor = $result['_brands_rid'];
							$itemModel = $result['_wares_rid'];
						} else {
							if($brandRid = $this->GetBrand($attrsArray['VENDOR'])) $itemVendor = $brandRid;
							if($wareRid = $this->GetWare($attrsArray['MODEL'], $itemVendor)) $itemModel = $wareRid;
						}
						if(isset($attrsArray['DESCRIPTION']) && !empty($attrsArray['DESCRIPTION']))	$itemDescr = $attrsArray['DESCRIPTION'];
						$stmt8 = $this->DB->prepare("INSERT INTO _pritems (_clients_rid, _categories_rid, ".($itemVendor?"_brands_rid,":'').
																			($itemModel?"_wares_rid,":'')." _availabletypes_rid, name, short_descr,
																			link_ware, prdate, model, offer_id, model_alias)
													 VALUES(:_clients_rid, :_categories_rid, ".($itemVendor?":_brands_rid,":'').
																			($itemModel?":_wares_rid,":'')." :_availabletypes_rid, :name, :short_descr,
																			:link_ware, :prdate, :model, :offer_id, :model_alias)");
						$stmt8->bindParam(':_clients_rid', $this->clientsRid);
						$stmt8->bindParam(':_categories_rid', $row2['_categories_rid']);
						if($itemVendor) $stmt8->bindParam(':_brands_rid', $itemVendor);
						if($itemModel) $stmt8->bindParam(':_wares_rid', $itemModel);
						$stmt8->bindParam(':_availabletypes_rid', $row3['_availabletypes_rid']);
						$stmt8->bindParam(':name', $itemName);
						$stmt8->bindParam(':short_descr', $itemDescr);
						$stmt8->bindParam(':link_ware', $attrsArray['URL']);
						$stmt8->bindParam(':prdate', $this->price_DATE);
						$itemAlias1 = '';
						if(isset($attrsArray['MODEL']) && !empty($attrsArray['MODEL'])) $itemAlias1 = $attrsArray['MODEL'];
						$stmt8->bindParam(':model', $itemAlias1);
						$stmt8->bindParam(':offer_id', $row3['offer_id']);
						if(isset($attrsArray['MODEL']) && !empty($attrsArray['MODEL'])) $itemAlias = $attrsArray['MODEL'];
						$itemAlias = str_replace(' ','',$itemAlias);
						$itemAlias = str_replace('-','',$itemAlias);
						$itemAlias = str_replace('/','',$itemAlias);
						$itemAlias = str_replace('\\','',$itemAlias);
						$itemAlias = mb_strtoupper($itemAlias);
						$itemAlias = $this->toTranslit($itemAlias);
						$stmt8->bindParam(':model_alias', $itemAlias);
						$stmt8->execute();
						
						$itemRid = $this->DB->lastInsertId();
						// Заливаем цены
						$stmt9 = $this->DB->prepare("INSERT INTO _prices(_pritems_rid, _prtypes_rid, _currency_rid, price)
																VALUES(:_pritems_rid, :_prtypes_rid, :_currency_rid, :price)");
						while($row6 = $stmt6->fetch(PDO::FETCH_NAMED)){
							$stmt9->bindParam(':_pritems_rid', $itemRid);
							$stmt9->bindParam(':_prtypes_rid', $row6['_prtypes_rid']);
							$stmt9->bindParam(':_currency_rid', $row6['_currency_rid']);
							$stmt9->bindParam(':price', $row6['price']);
							$stmt9->execute();
						}
						// Заливаем изображения, если не найден товар
						if(!$itemModel){
							$stmt10 = $this->DB->prepare("INSERT INTO _pritemsimgs(_pritems_rid, name, type, size, image)
																	VALUES(:_pritems_rid, :name, :type, :size, :image)");
							$row7 = $stmt7->fetch(PDO::FETCH_NAMED);
							if($row7){
								$stmt10->bindParam(':_pritems_rid', $itemRid);
								$stmt10->bindParam(':name', $row7['name']);
								$stmt10->bindParam(':type', $row7['type']);
								$stmt10->bindParam(':size', $row7['size']);
								$stmt10->bindParam(':image', $row7['image']);
								$stmt10->execute();
							}
						}
						break;
					}
					default :{
						// Здесь никакие параметры не используем - льем прямо в базу
						$itemVendor = null;
						$itemModel = null;
						$itemName = null;
						$itemDescr = null;
						if(isset($attrsArray['DESCRIPTION']) && !empty($attrsArray['DESCRIPTION']))	$itemDescr = $attrsArray['DESCRIPTION'];
						if(isset($attrsArray['NAME']) && !empty($attrsArray['NAME'])){
							$itemName = $attrsArray['NAME'];
						} else if(isset($attrsArray['TITLE']) && !empty($attrsArray['TITLE'])) $itemName = $attrsArray['TITLE'];
						if(isset($attrsArray['VENDOR']) && $itemVendor = $this->GetBrand($attrsArray['VENDOR'])){
							$stmt8 = $this->DB->prepare("INSERT INTO _pritems (_clients_rid, _categories_rid, _availabletypes_rid, _brands_rid, name, short_descr,
																				link_ware, prdate, offer_id, model_alias)
														 VALUES(:_clients_rid, :_categories_rid, :_availabletypes_rid, :_brands_rid, :name, :short_descr,
																				:link_ware, :prdate, :offer_id, :model_alias)");
						}
						else {
							$stmt8 = $this->DB->prepare("INSERT INTO _pritems (_clients_rid, _categories_rid, _availabletypes_rid, name, short_descr,
																				link_ware, prdate, offer_id, model_alias)
														 VALUES(:_clients_rid, :_categories_rid, :_availabletypes_rid, :name, :short_descr,
																				:link_ware, :prdate, :offer_id, :model_alias)");
						}
						$stmt8->bindParam(':_clients_rid', $this->clientsRid);
						$stmt8->bindParam(':_categories_rid', $row2['_categories_rid']);
						$stmt8->bindParam(':_availabletypes_rid', $row3['_availabletypes_rid']);
						if($itemVendor)	$stmt8->bindParam(':_brands_rid', $itemVendor);
						$stmt8->bindParam(':name', $itemName);
						$stmt8->bindParam(':short_descr', $itemDescr);
						$stmt8->bindParam(':link_ware', $attrsArray['URL']);
						$stmt8->bindParam(':prdate', $this->price_DATE);
						$stmt8->bindParam(':offer_id', $row3['offer_id']);
						$itemAlias = $itemName;						
						$itemAlias = str_replace(' ','',$itemAlias);
						$itemAlias = str_replace('-','',$itemAlias);
						$itemAlias = str_replace('/','',$itemAlias);
						$itemAlias = str_replace('\\','',$itemAlias);
						//$itemAlias = mb_strtoupper($itemAlias);
						$itemAlias = $this->toTranslit($itemAlias);
						$stmt8->bindParam(':model_alias', $itemAlias);
						$stmt8->execute();

						# попытка найти товар в справочнике товаров
						#$stmt_ASS = $this->DB->prepare("SELECT SFE_GetPrItemsWaresRid('{$itemName}')");
						#$stmt_ASS->execute();
						
						$itemRid = $this->DB->lastInsertId();
						// Заливаем цены
						$stmt9 = $this->DB->prepare("INSERT INTO _prices(_pritems_rid, _prtypes_rid, _currency_rid, price)
																VALUES(:_pritems_rid, :_prtypes_rid, :_currency_rid, :price)");
						while($row6 = $stmt6->fetch(PDO::FETCH_NAMED)){
							$stmt9->bindParam(':_pritems_rid', $itemRid);
							$stmt9->bindParam(':_prtypes_rid', $row6['_prtypes_rid']);
							$stmt9->bindParam(':_currency_rid', $row6['_currency_rid']);
							$stmt9->bindParam(':price', $row6['price']);
							$stmt9->execute();
						}
						// Заливаем изображения, если не найден товар
						if(!$itemModel){
							$stmt10 = $this->DB->prepare("INSERT INTO _pritemsimgs(_pritems_rid, name, type, size, image)
																	VALUES(:_pritems_rid, :name, :type, :size, :image)");
							$row7 = $stmt7->fetch(PDO::FETCH_NAMED);
							if($row7){
								$stmt10->bindParam(':_pritems_rid', $itemRid);
								$stmt10->bindParam(':name', $row7['name']);
								$stmt10->bindParam(':type', $row7['type']);
								$stmt10->bindParam(':size', $row7['size']);
								$stmt10->bindParam(':image', $row7['image']);
								$stmt10->execute();
							}
						}
						break;
					}
				}
				$stmt12 = $this->DB->prepare("DELETE FROM _tmppritems WHERE rid = :rid");
				$stmt12->bindParam(':rid', $row3['rid']);
				$stmt12->execute();
				$stmt = $this->DB->prepare("SELECT count(*) as quan FROM _tmppritems WHERE _tmppricesstorage_rid = :_tmppricesstorage_rid" );
				$stmt->bindParam(':_tmppricesstorage_rid', $this->tmppricesstorageRID);
				$stmt->execute();
				$row = $stmt->fetch(PDO::FETCH_NAMED);
				if(!$row['quan']) {
					$stmt = $this->DB->prepare("DELETE FROM _tmppritems WHERE _tmppricesstorage_rid = :_tmppricesstorage_rid" );
					$stmt->bindParam(':_tmppricesstorage_rid', $this->tmppricesstorageRID);
					$stmt->execute();
				}
				$quanIndex++;
				BizSystem::log(LOG_DEBUG, "--------------->", "Load in real Storage {$quanIndex}/{$this->LOADS_quan}\n");
			}
		}
	}
	
	public function GetBrand($brandName){
		$stmt = $this->DB->prepare("SELECT _brands.rid FROM _brands 
									LEFT JOIN _brandsassoc ON _brandsassoc._brands_rid = _brands.rid 
									WHERE _brands.name = :name OR _brandsassoc.name = :name 
									AND _brands.archive = 0 AND _brandsassoc.archive = 0");
		$stmt->bindParam(':name', $brandName);
		$stmt->bindParam(':name', $brandName);
		$stmt->execute();
		$row = $stmt->fetch(PDO::FETCH_NAMED);
		if($row) return $row['rid'];
		$this->ERROR_content .= "ERROR: Бренд {$brandName} не найден в БД \n";
		return False;
	}
	
	public function GetWare($modelName, $brandRid){
		$tModelName = $modelName;
		$modelName = str_replace(' ','',$modelName);
		$modelName = str_replace('-','',$modelName);
		$modelName = str_replace('/','',$modelName);
		$modelName = str_replace('\\','',$modelName);
		$modelName = mb_strtoupper($modelName);
		$stmt = $this->DB->prepare("SELECT rid FROM _wares 
									WHERE _wares._brands_rid = :_brands_rid AND _wares.model_alias = :model_alias 
									AND _wares.archive = 0");
		$stmt->bindParam(':_brands_rid', $brandRid);
		$stmt->bindParam(':model_alias', $modelName);
		$stmt->execute();
		$row = $stmt->fetch(PDO::FETCH_NAMED);
		if($row) return $row['rid'];
		$this->ERROR_content .= "ERROR: Модель {$tModelName} не найдена в БД \n";
		return False;
	}
	
	public function GetWareRID($wareNAME){
		$stmt = $this->DB->prepare("SELECT _categories_rid, _wares_rid, _brands_rid FROM _waresassoc
									WHERE _waresassoc.name = :name AND _waresassoc.archive = 0");
		$stmt->bindParam(':name', $wareNAME);
		$stmt->execute();
		$row = $stmt->fetch(PDO::FETCH_NAMED);
		if($row) return $row;
		else return False;
	}
	
	public function PrepareXML(){
		if(isset($this->docARR['YML_CATALOG']['SHOP']['CURRENCIES']['CURRENCY']['ATTRIBUTES'])){ 
			$this->docARR['YML_CATALOG']['SHOP']['CURRENCIES']['CURRENCY'][] = $this->docARR['YML_CATALOG']['SHOP']['CURRENCIES']['CURRENCY'];
			unset($this->docARR['YML_CATALOG']['SHOP']['CURRENCIES']['CURRENCY']['ATTRIBUTES']);
			unset($this->docARR['YML_CATALOG']['SHOP']['CURRENCIES']['CURRENCY']['VALUE']);
		}
		//var_dump($this->docARR['YML_CATALOG']['SHOP']['CURRENCIES']['CURRENCY']);
		//echo $this->clientsRid.'->'.count($this->docARR['YML_CATALOG']['SHOP']['CURRENCIES']['CURRENCY']).'<br>';	
	}
	
	
	public function toTranslit($string)
	{
		$string = ereg_replace("ж","zh",$string);
		$string = ereg_replace("ё","yo",$string);
		$string = ereg_replace("й","i",$string);
		$string = ereg_replace("ю","yu",$string);
		$string = ereg_replace("ь","'",$string);
		$string = ereg_replace("ч","ch",$string);
		$string = ereg_replace("щ","sh",$string);
		$string = ereg_replace("ц","c",$string);
		$string = ereg_replace("у","u",$string);
		$string = ereg_replace("к","k",$string);
		$string = ereg_replace("е","e",$string);
		$string = ereg_replace("н","n",$string);
		$string = ereg_replace("г","g",$string);
		$string = ereg_replace("ш","sh",$string);
		$string = ereg_replace("з","z",$string);
		$string = ereg_replace("х","h",$string);
		$string = ereg_replace("ъ","''",$string);
		$string = ereg_replace("ф","f",$string);
		$string = ereg_replace("ы","y",$string);
		$string = ereg_replace("в","v",$string);
		$string = ereg_replace("а","a",$string);
		$string = ereg_replace("п","p",$string);
		$string = ereg_replace("р","r",$string);
		$string = ereg_replace("о","o",$string);
		$string = ereg_replace("л","l",$string);
		$string = ereg_replace("д","d",$string);
		$string = ereg_replace("э","yе",$string);
		$string = ereg_replace("я","jа",$string);
		$string = ereg_replace("с","s",$string);
		$string = ereg_replace("м","m",$string);
		$string = ereg_replace("и","i",$string);
		$string = ereg_replace("т","t",$string);
		$string = ereg_replace("б","b",$string);
		$string = ereg_replace("Ё","yo",$string);
		$string = ereg_replace("Й","I",$string);
		$string = ereg_replace("Ю","YU",$string);
		$string = ereg_replace("Ч","CH",$string);
		$string = ereg_replace("Ь","'",$string);
		$string = ereg_replace("Щ","SH'",$string);
		$string = ereg_replace("Ц","C",$string);
		$string = ereg_replace("У","U",$string);
		$string = ereg_replace("К","K",$string);
		$string = ereg_replace("Е","E",$string);
		$string = ereg_replace("Н","N",$string);
		$string = ereg_replace("Г","G",$string);
		$string = ereg_replace("Ш","SH",$string);
		$string = ereg_replace("З","Z",$string);
		$string = ereg_replace("Х","H",$string);
		$string = ereg_replace("Ъ","''",$string);
		$string = ereg_replace("Ф","F",$string);
		$string = ereg_replace("Ы","Y",$string);
		$string = ereg_replace("В","V",$string);
		$string = ereg_replace("А","A",$string);
		$string = ereg_replace("П","P",$string);
		$string = ereg_replace("Р","R",$string);
		$string = ereg_replace("О","O",$string);
		$string = ereg_replace("Л","L",$string);
		$string = ereg_replace("Д","D",$string);
		$string = ereg_replace("Ж","Zh",$string);
		$string = ereg_replace("Э","Ye",$string);
		$string = ereg_replace("Я","Ja",$string);
		$string = ereg_replace("С","S",$string);
		$string = ereg_replace("М","M",$string);
		$string = ereg_replace("И","I",$string);
		$string = ereg_replace("Т","T",$string);
		$string = ereg_replace("Б","B",$string);
		return $string;		
	}
	
}
?>