<?php
/*
 * Categories Model
 */
class Categories_model extends Model
{
	public function __construct()
	{
		parent::Model();
		$this->db->query("SET NAMES 'utf8'"); 		
	}
	
	public function GetCategoriesArr($categoriesRID=null)
	{
		$this->db->select('*');
		$this->db->from('_categories');
		if($categoriesRID!==null) $this->db->where(array('_categories_rid'=>$categoriesRID, 'archive'=>'0'));
		else $this->db->where(array('archive'=>'0'));
		$this->db->orderby('name');
		$query = $this->db->get();
		if($query->num_rows()) 
		{
			return $query->result_array();
		}
		return FALSE;
	}
	
	public function GetCategoryArr($categoriesRID)
	{
		$this->db->select('*');
		$this->db->from('_categories');
		$this->db->where(array('rid'=>$categoriesRID, 'archive'=>'0'));
		$this->db->orderby('name');
		$query = $this->db->get();
		if($query->num_rows()) 
		{
			return $query->row_array();
		}
		return FALSE;
	}
	
	public function GetCategoryImages($categoriesRID, $imageTYPE = null)
	{
		$this->db->select('_categoriesimages.*');
		$this->db->from('_categoriesimages');
		if($imageTYPE)	$this->db->where(array('_categories_rid'=>$categoriesRID, 'archive'=>'0', 'imgtype'=>$imageTYPE));
		else $this->db->where(array('_categories_rid'=>$categoriesRID, 'archive'=>'0'));
		$this->db->orderby('name');
		$query = $this->db->get();
		if($query->num_rows()) 
		{
			return $query->result_array();
		}
		return FALSE;
	}

	public function GetWareImages($wareRID)
	{
		$this->db->select('_waresimages.*');
		$this->db->from('_waresimages');
		$this->db->where(array('_wares_rid'=>$wareRID, 'archive'=>'0'));
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
	
	public function GetOffersByCategory($parsARR)
	{
		$currentCATEGORY = null;
		$brandRID = null;
		$priceTYPE = null;
		$priceFROM = null;
		$priceAFROM = null;
		$perPAGE = $parsARR['l'];
		$mainCURRENCYRID = $parsARR['m_c'];
		$addCURRENCYRID = $parsARR['a_c'];
		$countriesRID = $parsARR['cn_c'];
		$cititesRID = $parsARR['c_c'];
		$regionsRID = $parsARR['r_c'];
		$priceTO = null;
		$priceATO = null;
		$searchSTR = null;
		$sortRULE = null;
		$clientRID = null;
		$filterPARSARR = array();
		$ifilterPARSARR = array();
		if(!isset($parsARR['c'])) return FALSE; else {$currentCATEGORY = $parsARR['c'];unset($parsARR['c']);}
		if(isset($parsARR['pp'])) {$priceTYPE = $parsARR['pp'];unset($parsARR['pp']);}
		if(isset($parsARR['OP']['cl'])) {$clientRID = $parsARR['OP']['cl'];unset($parsARR['OP']['cl']);}
		if(isset($parsARR['OP']['b'])) {$brandRID = $parsARR['OP']['b'];unset($parsARR['OP']['b']);}
		if(isset($parsARR['OP']['ss'])) {$searchSTR = $parsARR['OP']['ss'];unset($parsARR['OP']['ss']);}
		if(isset($parsARR['OP']['pf'])) {$priceFROM = $parsARR['OP']['pf'];unset($parsARR['OP']['pf']);}
		if(isset($parsARR['OP']['pt'])) {$priceTO = $parsARR['OP']['pt'];unset($parsARR['OP']['pt']);}
		if(isset($parsARR['OP']['pfa'])) {$priceAFROM = $parsARR['OP']['pfa'];unset($parsARR['OP']['pfa']);}
		if(isset($parsARR['OP']['pta'])) {$priceATO = $parsARR['OP']['pta'];unset($parsARR['OP']['pta']);}
		if(isset($parsARR['sr'])) {$sortRULE = $parsARR['sr'];unset($parsARR['sr']);}
		# get others filters parameters
		
		foreach($parsARR['OP'] as $key=>$par)
		{
			if(stripos($key, "cf_")!==FALSE) $filterPARSARR[substr($key, 3)] = $par;
			if(stripos($key, "if_")!==FALSE) $ifilterPARSARR[substr($key, 3)] = $par;
		}
		/* Controlling specifing parameters */
		/*if($filterPARSARR)
		{
			$filteredWARES = $this->_GetWaresByFilter($currentCATEGORY['rid'], $filterPARSARR);
			if(!$filteredWARES) return false;			
		}*/
		/* -------------------------------- */
		# concat(_brands.name, ' ', _pritems.model) as wareNAME
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
							count(_pritems.rid)/*/IF(count(_warespars.value)<>0, count(_warespars.value), 1)*/ as offersQUAN, 
							_categories.iscompared, 
							_categories.isgrouped, 
							_pritems._wares_rid,
							max(DISTINCT(_pritems.short_descr)) as short_descr,
							_pritems.link_ware,
							_clients.name as clientNAME,	
							_clients.rid as clientRID,
							_clients.street as clientSTREET,
							_clients.build as clientBUILD,
							_clients.wphones as clientWPHONES,
							_cities.name as cityNAME,
							IF(_pritems._brands_rid is NULL, 0, _pritems._brands_rid) as _brands_rid,		 
							_pritems.model_alias,
							_pritems._categories_rid,
							_prtypes.cod as prCOD,
							_guides.rid as guideRID,
							_currency.endword");
		$this->db->from('_prices');
		$this->db->join('_pritems', '_pritems.rid=_prices._pritems_rid AND _pritems.archive=0');
		$this->db->join('_pritemsimgs', '_pritems.rid=_pritemsimgs._pritems_rid AND _pritemsimgs.archive=0', 'LEFT');
		$this->db->join('_clients', '_clients.rid=_pritems._clients_rid AND _clients.archive=0');
		$this->db->join('_brands', '_brands.rid=_pritems._brands_rid AND _brands.archive=0', 'LEFT');	
		$this->db->join('_categories', '_pritems._categories_rid=_categories.rid AND _categories.archive=0');
		$this->db->join('_prtypes', '_prtypes.rid=_prices._prtypes_rid AND _prtypes.archive=0');
		$this->db->join('_currency', '_prices._currency_rid=_currency.rid AND _currency.archive=0');
		$this->db->join('_guides', '_categories.rid=_guides._categories_rid AND _guides.archive=0', 'LEFT');
		$this->db->join('_currcources', '_currcources._clients_rid=_pritems._clients_rid AND _currcources._currency_rid=_prices._currency_rid AND _currcources.courcedate=_pritems.prdate AND _currcources.archive=0', 'LEFT');
		$this->db->join('_officialcources', "_officialcources._currency_rid=_prices._currency_rid AND _officialcources.courcedate = (SELECT max(courcedate) from _officialcources WHERE _countries_rid='$countriesRID') AND _officialcources.archive=0 AND _officialcources._countries_rid='$countriesRID'", 'LEFT');
		if($cititesRID)
		{
			$this->db->join('_cities', '_cities.rid=_clients._cities_rid');
			$this->db->where(array('_clients._cities_rid'=>$cititesRID));
		}
		else if(!$cititesRID && $regionsRID)
		{
			$this->db->join('_cities', '_cities.rid=_clients._cities_rid');
			$this->db->join('_regions', "_regions.rid=_cities._regions_rid AND _regions.rid='$regionsRID'");
		}
		else
		{
			$this->db->join('_cities', '_cities.rid=_clients._cities_rid');
			$this->db->join('_regions', '_regions.rid=_cities._regions_rid');
			$this->db->join('_countries', "_countries.rid=_regions._countries_rid AND _countries.rid='$countriesRID'");
		}
		$this->db->where(array('_pritems._categories_rid'=>$currentCATEGORY['rid'],
								'_pritems.archive'=>'0',
								'_prtypes.cod'=>$priceTYPE));
		if($brandRID)
		{
			$brandRID = explode('-', $brandRID);
			$b_where = '(_pritems._brands_rid = '.implode(' OR _pritems._brands_rid = ', $brandRID).')';
			$this->db->where($b_where);
		}
		if($clientRID)$this->db->where(array('_pritems._clients_rid'=>$clientRID));
		/* grouping control */
		if($currentCATEGORY['isgrouped']) $this->db->groupby('_pritems._brands_rid, _pritems.model_alias');
		else $this->db->groupby('_pritems.rid');
		/* ---------------- */
		/* specified filters */
		if($filterPARSARR) $this->db->where($this->_GetWaresFilter($currentCATEGORY['rid'],$filterPARSARR));
		/* ***************** */
		/* specified ifilters */
		if($ifilterPARSARR) $this->db->where($this->_GetItemsFilter($currentCATEGORY['rid'],$ifilterPARSARR));
		/* ***************** */
		if($priceFROM)$this->db->having(array('minbasePRICE>='=>$priceFROM));
		if($priceTO)$this->db->having(array('maxbasePRICE<='=>$priceTO));
		if($priceAFROM)$this->db->having(array('minaddPRICE>='=>$priceAFROM));
		if($priceATO)$this->db->having(array('maxaddPRICE<='=>$priceATO));
		if($searchSTR)
		{
			#$wordsARR = explode(' ', $searchSTR);
			#foreach($wordsARR as $key=>$mWord) if(empty($mWord)) unset($wordsARR[$key]);
			#$searchSTR = implode('|',$wordsARR);
			#echo $searchSTR; 
			$this->db->having(array('wareNAME like '=>'%'.$searchSTR.'%'));
		}
		/* ordering control */
		if($sortRULE=='nm')$this->db->orderby('wareNAME');
		if($sortRULE=='rtn')$this->db->orderby('wareRATING', 'DESC');
		if($sortRULE=='mpr')$this->db->orderby('minbasePRICE');
		if($sortRULE=='pr')$this->db->orderby('minbasePRICE');  
		if($sortRULE=='apr')$this->db->orderby('avgbasePRICE');  
		/* ---------------- */
		$query = $this->db->get();
		if(!$query->num_rows()) return false;
		return $query->result_array();
	}
	
	public function GetCategoryPriceTypes($catRID)
	{
		$this->db->select('_prtypes.*');
		$this->db->from('_pritems');
		$this->db->join('_prices', '_pritems.rid=_prices._pritems_rid AND _prices.archive=0');
		$this->db->join('_prtypes', '_prtypes.rid=_prices._prtypes_rid AND _prtypes.archive=0');
		$this->db->where(array('_pritems._categories_rid'=>$catRID));
		$this->db->groupby('_prtypes.rid');
		$query = $this->db->get();
		if($query->num_rows()) return $query->result_array();
		return false;
	}
	
	public function GetCategoryBrands($catRID)
	{
		$this->db->select('_brands.*');
		$this->db->from('_pritems');
		$this->db->join('_brands', '_pritems._brands_rid=_brands.rid AND _brands.archive=0');
		$this->db->where(array('_pritems._categories_rid'=>$catRID));
		$this->db->groupby('_brands.rid');
		$query = $this->db->get();
		if($query->num_rows()) return $query->result_array();
		return false;
	}

	public function _GetWaresFilter($categoryRID, $filtersPARS)
	{
		$cnstSTRING = "_pritems._wares_rid in (SELECT _wares.rid 
					FROM _warespars 
					JOIN _wares ON _wares.rid=_warespars._wares_rid AND _wares._categories_rid='$categoryRID' AND _wares.archive=0
					WHERE _warespars.archive=0 AND ";
		
		$qSTRING = "";
		$cnstSTRING = "_pritems._wares_rid in";
		foreach($filtersPARS as $key=>$par)
		{
			$v_a = explode('-', $par);
			$ts = "_parsfilters.rid = ".implode(' OR _parsfilters.rid = ', $v_a);
			$qSTRING .= $cnstSTRING." (select _wares_rid
						from _warespars
						JOIN _pars ON _pars.rid = _warespars._pars_rid AND _pars.archive = 0 AND _pars.rid = '$key'
						JOIN _catpars ON _catpars._pars_rid = _warespars._pars_rid AND _catpars.archive = 0 AND _catpars._categories_rid = '$categoryRID' 
						JOIN _parsfilters ON _parsfilters._catpars_rid = _catpars.rid AND _parsfilters.archive = 0 AND ($ts) 
						JOIN _parsvalues ON _parsvalues._parsfilters_rid = _parsfilters.rid AND _parsvalues.archive = 0 
						WHERE _warespars.value LIKE CONCAT('%',_parsvalues.value,'%') AND _warespars.archive=0)	AND ";
		}
		$qSTRING =  substr($qSTRING, 0, -4);
		#echo $qSTRING;
		return $qSTRING;
	}
	
	public function _GetItemsFilter($categoryRID, $ifilterPARSARR)
	{
		$cnstSTRING = "_pritems.rid in (SELECT _pritems_rid FROM _pritemspars 
					JOIN _pritems ON _pritems.rid=_pritemspars._pritems_rid AND _pritems._categories_rid='$categoryRID' AND _pritems.archive=0
					WHERE _pritemspars.archive='0' AND ";
		$qSTRING = "";
		foreach ($ifilterPARSARR as $key=>$ipar)
		{
			$ipar = humanize($ipar);
			$qSTRING.=$cnstSTRING."(_pritemspars._pars_rid='$key' AND _pritemspars.value LIKE '$ipar')) AND ";
		}
		$qSTRING =  substr($qSTRING, 0, -4);
		return $qSTRING;
	}
	
	public function GetSearchResult($parsARR)
	{
		$countriesRID = $parsARR['cn_c'];
		$cititesRID = $parsARR['c_c'];
		$regionsRID = $parsARR['r_c'];
		$searchSTR = null;
		if(isset($parsARR['ss'])) {$searchSTR = $parsARR['ss'];unset($parsARR['ss']);}
		$this->db->select("_categories.*, count(_pritems.rid) as catoffersQUAN");
		$this->db->from('_pritems');	
		$this->db->join('_categories', "_pritems._categories_rid=_categories.rid AND _categories.archive='0'");	
		$this->db->join('_clients', "_clients.rid=_pritems._clients_rid AND _clients.archive = '0'");
		#$this->db->join('_brands', '_brands.rid=_pritems._brands_rid');	
					if($cititesRID)
		{
			$this->db->where(array('_clients._cities_rid'=>$cititesRID));
		}
		else if(!$cititesRID && $regionsRID)
		{
			$this->db->join('_cities', '_cities.rid=_clients._cities_rid');
			$this->db->join('_regions', '_regions.rid=_cities._regions_rid');
			$this->db->where(array('_regions.rid'=>$regionsRID));
		}
		else
		{
			$this->db->join('_cities', '_cities.rid=_clients._cities_rid');
			$this->db->join('_regions', '_regions.rid=_cities._regions_rid');
			$this->db->join('_countries', '_countries.rid=_regions._countries_rid');
			$this->db->where(array('_countries.rid'=>$countriesRID));
		}
		$this->db->where("_pritems.archive='0' AND _pritems.name like '%$searchSTR%'");
		$this->db->groupby('_pritems._categories_rid');
		$this->db->orderby('count(_pritems.rid) DESC');
		$query = $this->db->get();
		if($query->num_rows()) return $query->result_array();
		return false;
	}
	
	public function SetSearchStat($row)
	{
		$insertARR = array('query'=>$row['searchSTR'], 
							'resquan'=>$row['catoffersQUAN'], 
							'_categories_rid'=>$row['rid']);
		$this->db->insert('_findqueries', $insertARR);
		return;
	}
}
?>