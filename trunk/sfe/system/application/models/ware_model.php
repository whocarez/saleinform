<?php
/*
 * Ware Model
 */
class Ware_model extends Model
{
	public function __construct()
	{
		parent::Model();
		$this->db->query("SET NAMES 'utf8'"); 
	}
	
	public function GetWareFullName($catRID, $brandsRID, $modelALIAS)
	{
		$this->db->select("*, _pritems.name as wareFULLNAME");
		$this->db->from('_pritems');
		$this->db->join('_brands', "_brands.rid = _pritems._brands_rid AND _brands.rid=$brandsRID", 'LEFT');
		$this->db->where(array('_pritems.archive'=>'0', '_categories_rid'=>$catRID, 'model_alias'=>$modelALIAS));
		$this->db->groupby("_pritems.name");
		$query = $this->db->get();
		if($query->num_rows()) return $query->row_array();
		return FALSE;
	}
	
	public function GetWareOffers($parsARR)
	{
		$mainCURRENCYRID = $parsARR['m_c'];
		$addCURRENCYRID = $parsARR['a_c'];
		$countriesRID = $parsARR['cn_c'];
		$cititesRID = $parsARR['c_c'];
		$regionsRID = $parsARR['r_c'];
		$priceTYPE = $parsARR['pp'];
		# заглушка для сравнения товаров
		if(!isset($parsARR['cmp']))
		{
			$currentCATEGORY = $parsARR['catRID'];			
			$brandRID = $parsARR['brandsRID'];
			$modelALIAS = $parsARR['modelALIAS'];
		}
		$sortRULE = $parsARR['sr'];
		$this->db->select("_pritems.name as wareNAME, GROUP_CONCAT(_pritemsimgs.rid SEPARATOR '|') as prItemIMGS,
							SFE_GetItemShortDescr(_pritems._wares_rid, _pritems.rid) as wareSDESCR,  
							min(ROUND(IF(_prices._currency_rid = '$addCURRENCYRID', _prices.price,
							IF(_currcources.cource is NULL, _officialcources.cource*_prices.price, _currcources.cource*_prices.price)/IF((SELECT cource FROM _currcources WHERE _clients_rid = _clients.rid AND courcedate=_pritems.prdate AND _currency_rid='$addCURRENCYRID') is NULL, 
								(SELECT cource FROM _officialcources WHERE _countries_rid='$countriesRID' AND _currency_rid='$addCURRENCYRID' AND courcedate=(SELECT max(courcedate) from _officialcources WHERE _countries_rid='$countriesRID')), 
								(SELECT cource FROM _currcources WHERE _clients_rid = _clients.rid AND courcedate=_pritems.prdate AND _currency_rid='$addCURRENCYRID'))), 2)) as minaddPRICE,
							max(ROUND(IF(_prices._currency_rid = '$addCURRENCYRID', _prices.price,
							IF(_currcources.cource is NULL, _officialcources.cource*_prices.price, _currcources.cource*_prices.price)/IF((SELECT cource FROM _currcources WHERE _clients_rid = _clients.rid AND courcedate=_pritems.prdate AND _currency_rid='$addCURRENCYRID') is NULL, 
								(SELECT cource FROM _officialcources WHERE _countries_rid='$countriesRID' AND _currency_rid='$addCURRENCYRID' AND courcedate=(SELECT max(courcedate) from _officialcources WHERE _countries_rid='$countriesRID')), 
								(SELECT cource FROM _currcources WHERE _clients_rid = _clients.rid AND courcedate=_pritems.prdate AND _currency_rid='$addCURRENCYRID'))), 2)) as maxaddPRICE,
							avg(ROUND(IF(_prices._currency_rid = '$addCURRENCYRID', _prices.price,
							IF(_currcources.cource is NULL, _officialcources.cource*_prices.price, _currcources.cource*_prices.price)/IF((SELECT cource FROM _currcources WHERE _clients_rid = _clients.rid AND courcedate=_pritems.prdate AND _currency_rid='$addCURRENCYRID') is NULL, 
								(SELECT cource FROM _officialcources WHERE _countries_rid='$countriesRID' AND _currency_rid='$addCURRENCYRID' AND courcedate=(SELECT max(courcedate) from _officialcources WHERE _countries_rid='$countriesRID')), 
								(SELECT cource FROM _currcources WHERE _clients_rid = _clients.rid AND courcedate=_pritems.prdate AND _currency_rid='$addCURRENCYRID'))), 2)) as avgaddPRICE,
							min(ROUND(IF(_currcources.cource is NULL, _officialcources.cource*_prices.price, _currcources.cource*_prices.price), 2)) as minbasePRICE,
							max(ROUND(IF(_currcources.cource is NULL, _officialcources.cource*_prices.price, _currcources.cource*_prices.price), 2)) as maxbasePRICE,
							avg(ROUND(IF(_currcources.cource is NULL, _officialcources.cource*_prices.price, _currcources.cource*_prices.price), 2)) as avgbasePRICE,
							ROUND((SELECT avg(mark) FROM _cluopinions WHERE _clients_rid=_pritems._clients_rid), 0) as clientRATING,
							ROUND((SELECT count(rid) FROM _cluopinions WHERE _clients_rid=_pritems._clients_rid), 0) as clientOPINIONS,
							ROUND(IF(_pritems._wares_rid is NULL, NULL, (SELECT avg(mark) FROM _waresuopinions WHERE _wares_rid=_pritems._wares_rid)), 0) as wareRATING,
							ROUND(IF(_pritems._wares_rid is NULL, NULL, (SELECT count(rid) FROM _waresuopinions WHERE _wares_rid=_pritems._wares_rid)), 0) as wareOPINIONS,
							ROUND(IF(_pritems._wares_rid is NULL, NULL, (SELECT count(rid) FROM _waresrewievs WHERE _wares_rid=_pritems._wares_rid)), 0) as wareREWIEVS,
							(SELECT endword FROM _currency WHERE rid='$addCURRENCYRID') as addendWORD,
							(SELECT endword FROM _currency WHERE rid='$mainCURRENCYRID') as baseendWORD,
							count(_pritems.rid) as offersQUAN, 
							_categories.iscompared, 
							_categories.isgrouped, 
							_pritems._wares_rid,
							max(_pritems.short_descr) as short_descr,
							_pritems.link_ware,
							_pritems._brands_rid,		 
							_pritems.model_alias,
							_pritems._categories_rid,
							DATE_FORMAT(_pritems.prdate, '%d-%m-%Y') as offerDATE,
							_clients.name as clientNAME,	
							_clients.rid as clientRID,
							_clients.street as clientSTREET,
							_clients.build as clientBUILD,
							_clients.wphones as clientWPHONES,
							_cities.name as cityNAME,
							_prtypes.name as prtypeNAME,
							_availabletypes.name as availabletypeNAME,
							_currency.endword");
		$this->db->from('_prices');
		$this->db->join('_pritems', '_pritems.rid=_prices._pritems_rid AND _pritems.archive=0');
		$this->db->join('_pritemsimgs', '_pritems.rid=_pritemsimgs._pritems_rid AND _pritemsimgs.archive=0', 'LEFT');
		$this->db->join('_availabletypes', '_pritems._availabletypes_rid=_availabletypes.rid AND _availabletypes.archive=0');
		$this->db->join('_clients', '_clients.rid=_pritems._clients_rid AND _clients.archive=0');
		$this->db->join('_cities', '_cities.rid=_clients._cities_rid AND _cities.archive=0');
		$this->db->join('_brands', '_brands.rid=_pritems._brands_rid AND _brands.archive=0', 'LEFT');	
		$this->db->join('_categories', '_pritems._categories_rid=_categories.rid AND _categories.archive=0');	
		$this->db->join('_prtypes', '_prtypes.rid=_prices._prtypes_rid AND _prtypes.archive=0');
		$this->db->join('_currency', '_prices._currency_rid=_currency.rid AND _currency.archive=0');
		$this->db->join('_currcources', '_currcources._clients_rid=_pritems._clients_rid AND _currcources._currency_rid=_prices._currency_rid AND _currcources.courcedate=_pritems.prdate', 'LEFT');
		$this->db->join('_officialcources', "_officialcources._currency_rid=_prices._currency_rid AND _officialcources.courcedate = (SELECT max(courcedate) from _officialcources WHERE _countries_rid='$countriesRID') AND _officialcources.archive=0 AND _officialcources._countries_rid='$countriesRID'", 'LEFT');
		if($cititesRID)
		{
			$this->db->where(array('_clients._cities_rid'=>$cititesRID));
		}
		else if(!$cititesRID && $regionsRID)
		{
			$this->db->join('_regions', "_regions.rid=_cities._regions_rid AND _regions.rid='$regionsRID'");
		}
		else
		{
			$this->db->join('_regions', '_regions.rid=_cities._regions_rid');
			$this->db->join('_countries', "_countries.rid=_regions._countries_rid AND _countries.rid='$countriesRID'");
		}
		
		# заглушка для сравнения товаров
		if(!isset($parsARR['cmp']))
		{
			$this->db->where(array('_pritems._categories_rid'=>$currentCATEGORY,
								'_pritems.archive'=>'0',
								'_prtypes.cod'=>$priceTYPE,
								'_pritems.model_alias'=>$modelALIAS));
			if(!$brandRID) $this->db->where('_pritems._brands_rid is null'); // Заглушка на случай если бренд не определен
			else $this->db->where(array('_pritems._brands_rid'=>$brandRID));
		}
		else
		{
			$sqlSTR = '(';
			foreach($parsARR['cmp'] as $item) 
			{
				if($sqlSTR != '(') $sqlSTR .= ' OR ';
				$sqlSTR .= "(_pritems._categories_rid='".$item['catRID']."' AND 
								_pritems.archive='0' AND 
								_prtypes.cod='$priceTYPE' AND 
								_pritems._brands_rid='".$item['brandsRID']."' AND
								_pritems.model_alias='".$item['modelALIAS']."' )";
				
			}
			$sqlSTR .= ')';
			$this->db->where($sqlSTR);
		}
		/*******************************/
		/* ordering control */
		if($sortRULE=='nm')$this->db->orderby('clientNAME');
		if($sortRULE=='rtn')$this->db->orderby('clientRATING', 'DESC');
		if($sortRULE=='pr')$this->db->orderby('minbasePRICE');  
		/* ---------------- */
		/* grouping control */
		$this->db->groupby('_pritems.rid'); // from one merchant we can have some offers on the same ware, that diferents, for example, by color
		//$this->db->groupby('_pritems.model_alias');
		/* ---------------- */
		$query = $this->db->get();
		if(!$query->num_rows()) return false;
		return $query->result_array();		
	}
	
	public function GetWareDetails($parsARR)
	{
		$mainCURRENCYRID = $parsARR['m_c'];
		$addCURRENCYRID = $parsARR['a_c'];
		$countriesRID = $parsARR['cn_c'];
		$cititesRID = $parsARR['c_c'];
		$regionsRID = $parsARR['r_c'];
		$priceTYPE = $parsARR['pp'];
		if(!isset($parsARR['cmp']))	
		{
			$currentCATEGORY = $parsARR['catRID'];	
			$brandRID = $parsARR['brandsRID'];
			$modelALIAS = $parsARR['modelALIAS'];
		}
		$sortRULE = $parsARR['sr'];
		$this->db->select("_catpars.rid as rid, _catpars._catpars_rid as _catpars_rid, _pars.name, _warespars.value, _warespars._wares_rid");
		$this->db->from('_catpars');
		$this->db->join('_pars', "_catpars._pars_rid = _pars.rid AND _pars.archive='0'");
		if(!isset($parsARR['cmp']))
		{
			$this->db->join('_warespars', "_warespars._pars_rid = _pars.rid AND _warespars.archive='0' AND _warespars._wares_rid = (SELECT rid FROM _wares WHERE  _wares._brands_rid='$brandRID' AND _wares.model_alias='$modelALIAS' AND _wares.archive='0' )", 'LEFT');
			$this->db->where(array('_catpars._categories_rid'=>$currentCATEGORY, '_catpars.archive'=>'0'));
		}
		else
		{
			$sqlSTR = "_warespars._pars_rid = _pars.rid AND _warespars.archive='0' AND ( _warespars._wares_rid = (SELECT rid FROM _wares WHERE  _wares._brands_rid='".$parsARR['cmp'][0]['brandsRID']."' AND _wares.model_alias='".$parsARR['cmp'][0]['modelALIAS']."' AND _wares.archive='0' ) ";
			foreach($parsARR['cmp'] as $key=>$item)
			{
				if($key=='0') continue;
				$sqlSTR .=  " OR _warespars._wares_rid = (SELECT rid FROM _wares WHERE  _wares._brands_rid='".$item['brandsRID']."' AND _wares.model_alias='".$item['modelALIAS']."' AND _wares.archive='0' )";
			}
			$this->db->join('_warespars', $sqlSTR." )", 'LEFT');
			$this->db->where(array('_catpars._categories_rid'=>$parsARR['cmp'][0]['catRID'], '_catpars.archive'=>'0'));
		}
		$this->db->orderby('numorder');
		$query = $this->db->get();
		if(!$query->num_rows()) return false;
		return $query->result_array();		
	}
	
	public function GetWareOpinions($parsARR)
	{
		$mainCURRENCYRID = $parsARR['m_c'];
		$addCURRENCYRID = $parsARR['a_c'];
		$countriesRID = $parsARR['cn_c'];
		$cititesRID = $parsARR['c_c'];
		$regionsRID = $parsARR['r_c'];
		$currentCATEGORY = $parsARR['catRID'];
		$priceTYPE = $parsARR['pp'];
		$brandRID = $parsARR['brandsRID'];
		$modelALIAS = $parsARR['modelALIAS'];
		$sortRULE = $parsARR['sr'];
		$this->db->select('_members.display_name, _waresuopinions.opinion, _waresuopinions.mark, DATE_FORMAT(_waresuopinions.createDT, "%d-%m-%Y %H:%i:%s") as opinionDATE');
		$this->db->from('_waresuopinions');
		$this->db->join('_wares', "_wares.rid=_waresuopinions._wares_rid");
		$this->db->join('_members', "_members.rid=_waresuopinions._members_rid");
		$this->db->where(array('_wares._brands_rid'=>$brandRID, '_wares.model_alias'=>$modelALIAS, '_waresuopinions.archive'=>'0'));
		$this->db->orderby('_waresuopinions.createDT', 'DESC');
		$query = $this->db->get();
		if(!$query->num_rows()) return false;
		return $query->result_array();		
	}

	public function GetWareReviews($parsARR)
	{
		$mainCURRENCYRID = $parsARR['m_c'];
		$addCURRENCYRID = $parsARR['a_c'];
		$countriesRID = $parsARR['cn_c'];
		$cititesRID = $parsARR['c_c'];
		$regionsRID = $parsARR['r_c'];
		$currentCATEGORY = $parsARR['catRID'];
		$priceTYPE = $parsARR['pp'];
		$brandRID = $parsARR['brandsRID'];
		$modelALIAS = $parsARR['modelALIAS'];
		$sortRULE = $parsARR['sr'];
		$currREVIEW = $parsARR['currREVIEW'];
		$this->db->select('_waresrewievs.rid, _waresrewievs.review_title, _waresrewievs.review, DATE_FORMAT(_waresrewievs.datereview, "%d-%m-%Y") as reviewDATE');
		$this->db->from('_waresrewievs');
		$this->db->join('_wares', "_wares.rid=_waresrewievs._wares_rid");
		$this->db->where(array('_wares._brands_rid'=>$brandRID, '_wares.model_alias'=>$modelALIAS, '_waresrewievs.archive'=>'0'));
		if($currREVIEW) $this->db->where(array('_waresrewievs.rid'=>$currREVIEW));
		$this->db->orderby('_waresrewievs.datereview', 'DESC');
		$query = $this->db->get();
		if(!$query->num_rows()) return false;
		return $query->result_array();		
	}

	public function GetWareImages($wareRID)
	{
		if(!$wareRID) return FALSE;
		$this->db->select('_waresimages.*');
		$this->db->from('_waresimages');
		$this->db->where(array('_wares_rid'=>$wareRID, 'archive'=>'0'));
		$this->db->groupby('size');
		$this->db->orderby('name');
		
		$query = $this->db->get();
		if($query->num_rows()) 
		{
			return $query->result_array();
		}
		return FALSE;
	}
	
	public function GetItemImages($itemsRID)
	{
		$itemimgsArr = explode('|', $itemsRID);
		$this->db->select('_pritemsimgs.*');
		$this->db->from('_pritemsimgs');
		$this->db->where(array('rid'=>$itemimgsArr[0]));
		unset($itemimgsArr[0]);
		foreach($itemimgsArr as $imgRid) $this->db->orwhere(array('rid'=>$imgRid));
		$this->db->orderby('name');
		$query = $this->db->get();
		if($query->num_rows()) 
		{
			return $query->result_array();
		}
		return FALSE;
	}
	
}
?>