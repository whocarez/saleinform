<?php/* * Categories Model */
class Categories_model extends Model{	private $ciObject;	public function __construct(){		parent::Model();		$this->ciObject = &get_instance();	}
	public function GetCategories($categoriesRID=null){		$this->db->select('_categories.*');		$this->db->from('_categories');		if($categoriesRID!==null) {
			$this->db->where(array('_categories._categories_rid'=>$categoriesRID, '_categories.archive'=>'0'));
		}		else $this->db->where(array('_categories.archive'=>'0'));		$this->db->orderby('_categories.name');		$query = $this->db->get();		return $query->num_rows()?$query->result():array();	}
	public function getCategoryInfo($categoriesRID){		$this->db->select('_categories.*');		$this->db->from('_categories');		$this->db->where(array('_categories.rid'=>$categoriesRID, '_categories.archive'=>'0'));		$this->db->orderby('_categories.name');		$query = $this->db->get();		return $query->num_rows()?$query->row():null;	}	public function getCategoryPath($cRid){		$this->db->select('_categories.rid, _categories.slug, _categories.name');		$this->db->from('_catparents');		$this->db->join('_categories', '_categories.rid = _catparents._parent_rid');		$this->db->where(array('_catparents._categories_rid'=>$cRid));		$this->db->order_by('_catparents.level');		$query = $this->db->get();		return $query->num_rows()?$query->result():array();	}	public function upPopularity($cRid){		$path = $this->getCategoryPath($cRid);		$rids = array($cRid);		foreach($path as $c) $rids[] = (int)$c->rid;		$inStr = '('.implode(',', $rids).')';		$this->db->query("update _categories set popularity = popularity+1 where rid in {$inStr}");		return True;	}	public function getSubcategories2Level($catRid){		$cityRid = $this->ciObject->settings_module->getSetting('_CITY_RID_');		$regionRid = $this->ciObject->settings_module->getSetting('_REGION_RID_');		$countryRid = $this->ciObject->settings_module->getSetting('_COUNTRY_RID_');		$this->db->select("t.*, count(_pritems.rid)  as oquan", False);		$this->db->from("(select _categories.* from _catparents							join _categories on _categories.rid = _catparents._categories_rid							where _catparents._parent_rid in (select rid from _categories where _categories_rid = {$catRid})) t ");		$this->db->join('_pritems', '_pritems._categories_rid = t.rid ', 'LEFT');		$this->db->join('_clients', '_clients.rid=_pritems._clients_rid ', 'LEFT');		$this->db->join('_cities', '_cities.rid=_clients._cities_rid '.(($cityRid)?"and _clients._cities_rid={$cityRid}":''), 'LEFT');		$this->db->join('_regions', '_regions.rid=_cities._regions_rid '.((!$cityRid && $regionRid)?"and _regions.rid={$regionRid}":''), 'LEFT');		$this->db->join('_countries', '_countries.rid=_regions._countries_rid '.(($countryRid)?"and _countries.rid={$countryRid}":''), 'LEFT');		#if($cityRid) $this->db->where(array('_clients._cities_rid'=>$cityRid));		#else if(!$cityRid && $regionRid) $this->db->where(array('_regions.rid'=>$regionRid));		#else $this->db->where(array('_countries.rid'=>$countryRid));		$this->db->group_by("t.rid");		$this->db->order_by("t.name");		$query = $this->db->get();		return $query->num_rows()?$query->result():array();	}
	public function GetCategoryImages($categoriesRID, $imageTYPE = null)	{
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

	public function GetWareImages($wareRID){
		$this->db->select('_waresimages.*');
		$this->db->from('_waresimages');
		$this->db->where(array('_wares_rid'=>$wareRID, 'archive'=>'0'));
		$this->db->orderby('name');
		$query = $this->db->get();		return $query->num_rows()?$query->result():array();
	}

	public function GetItemImages($itemsRID){
		$itemimgsArr = explode('|', $itemsRID);
		$this->db->select('_pritemsimgs.*');
		$this->db->from('_pritemsimgs');
		/*$this->db->where(array('rid'=>$itemimgsArr[0]));
		unset($itemimgsArr[0]);*/
		foreach($itemimgsArr as $imgRid) $this->db->orwhere(array('rid'=>$imgRid));
		$this->db->orderby('name');
		$query = $this->db->get();		return $query->num_rows()?$query->result():array();
	}

	public function GetOffersByCategory($cRid){
		$c = $this->getCategoryInfo($cRid);		$mCurr = $this->ciObject->settings_module->getSetting('_MAIN_CURR_RID_');;		$aCurr = $this->ciObject->settings_module->getSetting('_ADD_CURR_RID_');;		$ctRid = $this->ciObject->settings_module->getSetting('_COUNTRY_RID_');		$cityRid = $this->ciObject->settings_module->getSetting('_CITY_RID_');		$rRid = $this->ciObject->settings_module->getSetting('_REGION_RID_');		$filterPARSARR = array();		$ifilterPARSARR = array();		$pars = $this->ciObject->uri->uri_to_assoc();		$page = element('p', $pars);		$clientRID = element('cl', $pars);		$brandRID = element('b', $pars);		$searchSTR = element('ss', $pars);		$sortRULE = element('sort', $pars);		# get others filters parameters		foreach($pars as $key=>$par){			if(stripos($key, "cf_")!==FALSE) $filterPARSARR[substr($key, 3)] = $par;			if(stripos($key, "if_")!==FALSE) $ifilterPARSARR[substr($key, 3)] = $par;		}		# concat(_brands.name, ' ', _pritems.model) as wareNAME		$this->db->select(" SQL_CALC_FOUND_ROWS _pritems.name as wareNAME,							_pritemsimgs.rid  as prItemIMGS,							/*SFE_GetItemShortDescr(_pritems._wares_rid, _pritems.rid) as wareSDESCR,*/							min(ROUND(IF(_prices._currency_rid = '$aCurr', _prices.price,							IF(_currcources.cource is NULL, _officialcources.cource*_prices.price, _currcources.cource*_prices.price)/IF((SELECT cource FROM _currcources WHERE _clients_rid = _clients.rid AND courcedate=_pritems.prdate AND _currency_rid='$aCurr') is NULL, 								(SELECT cource FROM _officialcources WHERE _countries_rid='$ctRid' AND _currency_rid='$aCurr' AND courcedate=(SELECT max(courcedate) from _officialcources WHERE _countries_rid='$ctRid')), 								(SELECT cource FROM _currcources WHERE _clients_rid = _clients.rid AND courcedate=_pritems.prdate AND _currency_rid='$aCurr'))), 2)) as minaddPRICE,							max(ROUND(IF(_prices._currency_rid = '$aCurr', _prices.price,							IF(_currcources.cource is NULL, _officialcources.cource*_prices.price, _currcources.cource*_prices.price)/IF((SELECT cource FROM _currcources WHERE _clients_rid = _clients.rid AND courcedate=_pritems.prdate AND _currency_rid='$aCurr') is NULL, 								(SELECT cource FROM _officialcources WHERE _countries_rid='$ctRid' AND _currency_rid='$aCurr' AND courcedate=(SELECT max(courcedate) from _officialcources WHERE _countries_rid='$ctRid')), 								(SELECT cource FROM _currcources WHERE _clients_rid = _clients.rid AND courcedate=_pritems.prdate AND _currency_rid='$aCurr'))), 2)) as maxaddPRICE,							min(ROUND(IF(_currcources.cource is NULL, _officialcources.cource*_prices.price, _currcources.cource*_prices.price), 2)) as minbasePRICE,							max(ROUND(IF(_currcources.cource is NULL, _officialcources.cource*_prices.price, _currcources.cource*_prices.price), 2)) as maxbasePRICE,							_clients.popularity as clientRATING,							ROUND((SELECT count(rid) FROM _cluopinions WHERE _clients_rid=_pritems._clients_rid), 0) as clientOPINIONS,							ROUND(IF(_pritems._wares_rid is NULL, NULL, (SELECT avg(mark) FROM _waresuopinions WHERE _wares_rid=_pritems._wares_rid)), 0) as wareRATING,							ROUND(IF(_pritems._wares_rid is NULL, NULL, (SELECT count(rid) FROM _waresuopinions WHERE _wares_rid=_pritems._wares_rid)), 0) as wareOPINIONS,							ROUND(IF(_pritems._wares_rid is NULL, NULL, (SELECT count(rid) FROM _waresrewievs WHERE _wares_rid=_pritems._wares_rid)), 0) as wareREWIEVS,														(SELECT endword FROM _currency WHERE rid='$aCurr') as addendWORD,							(SELECT endword FROM _currency WHERE rid='$mCurr') as baseendWORD,							count(_pritems.rid) as offersQUAN, 							_pritems._wares_rid,							max(DISTINCT(_pritems.short_descr)) as short_descr,							_pritems.link_ware,							_clients.name as clientNAME,								_clients.rid as clientRID,							_clients.street as clientSTREET,							_clients.build as clientBUILD,							_clients.wphones as clientWPHONES,							_cities.name as cityNAME,							_pritems.rid as offerRID, 							_pritems.slug as offerSLUG,							IF(_pritems._brands_rid is NULL, 0, _pritems._brands_rid) as _brands_rid,		 							_pritems._categories_rid,							_prtypes.cod as prCOD,							if(_pritems._wares_rid is NULL, _pritems.rid, _pritems._wares_rid) as g_rid,							_currency.endword", False);		$this->db->from('_prices');		$this->db->join('_pritems', '_pritems.rid=_prices._pritems_rid AND _pritems.archive=0');		$this->db->join('_pritemsimgs', '_pritems.rid=_pritemsimgs._pritems_rid AND _pritemsimgs.archive=0', 'LEFT');		$this->db->join('_clients', '_clients.rid=_pritems._clients_rid AND _clients.archive=0');		$this->db->join('_brands', '_brands.rid=_pritems._brands_rid AND _brands.archive=0', 'LEFT');		$this->db->join('_prtypes', '_prtypes.rid=_prices._prtypes_rid AND _prtypes.archive=0');		$this->db->join('_currency', '_prices._currency_rid=_currency.rid AND _currency.archive=0');		$this->db->join('_currcources', '_currcources._clients_rid=_pritems._clients_rid AND _currcources._currency_rid=_prices._currency_rid AND _currcources.courcedate=_pritems.prdate AND _currcources.archive=0', 'LEFT');		$this->db->join('_officialcources', "_officialcources._currency_rid=_prices._currency_rid AND _officialcources.courcedate = (SELECT max(courcedate) from _officialcources WHERE _countries_rid='$ctRid') AND _officialcources.archive=0 AND _officialcources._countries_rid='$ctRid'", 'LEFT');		$this->db->join('_cities', '_cities.rid=_clients._cities_rid '.(($cityRid)?"and _clients._cities_rid={$cityRid}":''), 'LEFT');		$this->db->join('_regions', '_regions.rid=_cities._regions_rid '.((!$cityRid && $rRid)?"and _regions.rid={$rRid}":''), 'LEFT');		$this->db->join('_countries', '_countries.rid=_regions._countries_rid '.(($ctRid)?"and _countries.rid={$ctRid}":''), 'LEFT');		$this->db->where(array('_pritems._categories_rid'=>$c->rid, '_pritems.archive'=>'0', '_prtypes.cod'=>'R'));		if($brandRID){			$brandRID = explode('-', $brandRID);			$b_where = '(_pritems._brands_rid = '.implode(' OR _pritems._brands_rid = ', $brandRID).')';			$this->db->where($b_where);		}		if($clientRID)$this->db->where(array('_pritems._clients_rid'=>$clientRID));		/* grouping control */		if($c->isgrouped) /*$this->db->groupby('_pritems._wares_rid'); #*/$this->db->groupby('g_rid');		else $this->db->groupby('_pritems.rid');				/* ---------------- */		/* specified filters */		if($filterPARSARR) $this->db->where($this->_GetWaresFilter($c->rid,$filterPARSARR));		/* ***************** */		/* specified ifilters */		if($ifilterPARSARR) $this->db->where($this->_GetItemsFilter($c->rid,$ifilterPARSARR));		/* ***************** */		if($searchSTR && $searchARR = $this->GetSearchExpression($searchSTR)){			foreach($searchARR as $sSTR) $this->db->having("wareNAME like '%{$sSTR}%'");		}		/* ordering control */		if($sortRULE=='name')$this->db->orderby('wareNAME');		else if($sortRULE=='rating')$this->db->orderby('wareRATING', 'DESC');		else if($sortRULE=='mpr')$this->db->orderby('minbasePRICE');		else if($sortRULE=='apr')$this->db->orderby('avgbasePRICE');		else $this->db->orderby('minbasePRICE'); 		/* ---------------- */
		$this->db->limit(15, $page);
		$query = $this->db->get();		return $query->num_rows()?$query->result():array();	}

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
						WHERE _warespars.value LIKE CONCAT(_parsvalues.value) AND _warespars.archive=0)	AND ";
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

	public function GetSearchResult($searchSTR){		$ctRid = $this->ciObject->settings_module->getSetting('_COUNTRY_RID_');		$cityRid = $this->ciObject->settings_module->getSetting('_CITY_RID_');		$rRid = $this->ciObject->settings_module->getSetting('_REGION_RID_');		$this->db->select("_categories.*, count(_pritems.rid) as catoffersQUAN", False);		$this->db->from('_pritems');		$this->db->join('_categories', "_pritems._categories_rid=_categories.rid AND _categories.archive='0'");		$this->db->join('_clients', "_clients.rid=_pritems._clients_rid AND _clients.archive = '0'");		#$this->db->join('_brands', '_brands.rid=_pritems._brands_rid');		$this->db->join('_cities', '_cities.rid=_clients._cities_rid '.(($cityRid)?"and _clients._cities_rid={$cityRid}":''), 'LEFT');		$this->db->join('_regions', '_regions.rid=_cities._regions_rid '.((!$cityRid && $rRid)?"and _regions.rid={$rRid}":''), 'LEFT');		$this->db->join('_countries', '_countries.rid=_regions._countries_rid '.(($ctRid)?"and _countries.rid={$ctRid}":''), 'LEFT');		$this->db->where(array("_pritems.archive"=>0));		if($searchSTR && $searchARR = $this->GetSearchExpression($searchSTR)){			foreach($searchARR as $sSTR) $this->db->like(array('_pritems.name'=>$sSTR));		}		$this->db->groupby('_pritems._categories_rid');		$this->db->orderby('count(_pritems.rid) DESC');		$query = $this->db->get();		return $query->num_rows()?$query->result():array();	}
	public function setSearchStat($str){		$this->db->query("insert into _findqueries(query) values('{$str}') ON DUPLICATE KEY UPDATE popularity=popularity+1");		return;	}

	/**
	* @author Mazvv
	* @param string $searchSTR
	* @return array $words
	*/
	public function GetSearchExpression($searchSTR){
		$searchARR = array();
		$wordsARR = explode(' ', $searchSTR);
		foreach($wordsARR as $key=>$mWord) if(!empty($mWord)) $searchARR[] = $mWord;
		return $searchARR;
	}

	/**
	 * @author Mazvv
	 * @param void
	 * @return integer $rowsQuan
	 */
	public function GetQueryRowsQuan(){
		$this->db->select('FOUND_ROWS() as rowsQuan');
		$query = $this->db->get();
		return $query->row()->rowsQuan;
	}

	public function getTopCategories($limit=15){
		$this->db->select('_categories.*, _categoriesimages.rid as imgRid, _categoriesimages.name as imgName, _categoriesimages.image as image');
		$this->db->from('_categories');
		$this->db->join('_categoriesimages', "_categoriesimages._categories_rid = _categories.rid AND _categoriesimages.imgtype='ICON'", 'LEFT');
		$this->db->where('( not _categories._categories_rid ) and _categories.archive = 0');
		$this->db->order_by('popularity desc');
		$this->db->group_by('_categories.rid');
		if($limit) $this->db->limit($limit);
		$query = $this->db->get();
		return $query->num_rows()?$query->result():array();
	}

	public function getSecondLevelCategories(){		$this->db->select('_categories.rid, _categories.name, _categories.slug, _categories._categories_rid');		$this->db->from('_catparents');		$this->db->join('_categories', "_catparents._parent_rid = _categories.rid AND not _categories.archive");		$this->db->where(array('_catparents.level'=>'2'));		$this->db->order_by('popularity desc');		$this->db->group_by('_catparents._parent_rid');		$this->db->order_by('_categories.name');		$query = $this->db->get();		return $query->num_rows()?$query->result():array();	}
}
?>