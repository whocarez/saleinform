<?php
/*
 * Categories Model
 */
class Categories_model extends Model{
	private $ciObject;	public function __construct(){
		parent::Model();
		$this->ciObject = &get_instance();
	}
	
	public function getCategoryPath($cRid){
		$this->db->select('_categories.rid, _categories.slug, _categories.name');
		$this->db->from('_catparents');
		$this->db->join('_categories', '_categories.rid = _catparents._parent_rid');
		$this->db->where(array('_catparents._categories_rid'=>$cRid));
		$this->db->order_by('_catparents.level');
		$query = $this->db->get();
		return $query->num_rows()?$query->result():array();                
	}
	
	
	public function getCategories($categoriesRID=null){
		$cityRid = $this->ciObject->settings_module->getCurrSetting('_CITY_RID_');
		$regionRid = $this->ciObject->settings_module->getCurrSetting('_REGION_RID_');
		$countryRid = $this->ciObject->settings_module->getCurrSetting('_COUNTRY_RID_');	
		$this->db->select('_categories.*');
		$this->db->from('_categories');
		if($categoriesRID!==null)$this->db->where(array('_categories._categories_rid'=>$categoriesRID));
		$this->db->where(array('_categories.archive'=>'0'));
		$this->db->orderby('_categories.name');
		$query = $this->db->get();
		return $query->num_rows()?$query->result():array();
	}
	public function getCategoryInfo($categoriesRID){
		$this->db->select('_categories.*');		$this->db->from('_categories');		$this->db->where(array('_categories.rid'=>$categoriesRID, '_categories.archive'=>'0'));
		$this->db->orderby('_categories.name');
		$query = $this->db->get();		return $query->num_rows()?$query->row():null;
	}
	public function upPopularity($cRid){
		$path = $this->getCategoryPath($cRid);
		$rids = array($cRid);
		foreach($path as $c) $rids[] = (int)$c->rid;
		$inStr = '('.implode(',', $rids).')';
		$this->db->query("update _categories set popularity = popularity+1 where rid in {$inStr}");
		return True;	
	}
	
	public function getSubcategories2Level($catRid){
		$cityRid = $this->ciObject->settings_module->getCurrSetting('_CITY_RID_');
		$regionRid = $this->ciObject->settings_module->getCurrSetting('_REGION_RID_');
		$countryRid = $this->ciObject->settings_module->getCurrSetting('_COUNTRY_RID_');	
		$this->db->select("t.*, count(_pritems.rid)  as oquan", False);
		$this->db->from("(select _categories.* from _catparents 
							join _categories on _categories.rid = _catparents._categories_rid
							where _catparents._parent_rid in (select rid from _categories where _categories_rid = {$catRid})) t ");
		$this->db->join('_pritems', '_pritems._categories_rid = t.rid ', 'LEFT');
		$this->db->join('_clients', '_clients.rid=_pritems._clients_rid ', 'LEFT');
		$this->db->join('_cities', '_cities.rid=_clients._cities_rid '.(($cityRid)?"and _clients._cities_rid={$cityRid}":''), 'LEFT');
		$this->db->join('_regions', '_regions.rid=_cities._regions_rid '.((!$cityRid && $regionRid)?"and _regions.rid={$regionRid}":''), 'LEFT');
		$this->db->join('_countries', '_countries.rid=_regions._countries_rid '.(($countryRid)?"and _countries.rid={$countryRid}":''), 'LEFT');
		#if($cityRid) $this->db->where(array('_clients._cities_rid'=>$cityRid));
		#else if(!$cityRid && $regionRid) $this->db->where(array('_regions.rid'=>$regionRid));
		#else $this->db->where(array('_countries.rid'=>$countryRid));
		$this->db->group_by("t.rid");
		$this->db->order_by("t.name");
		$query = $this->db->get();
		return $query->num_rows()?$query->result():array();
	}
	public function GetCategoryImages($categoriesRID, $imageTYPE = null){		$this->db->select('_categoriesimages.*');		$this->db->from('_categoriesimages');		if($imageTYPE)	$this->db->where(array('_categories_rid'=>$categoriesRID, 'archive'=>'0', 'imgtype'=>$imageTYPE));		else $this->db->where(array('_categories_rid'=>$categoriesRID, 'archive'=>'0'));		$this->db->orderby('name');		$query = $this->db->get();		if($query->num_rows()){			return $query->result_array();		}		return FALSE;	}
	public function GetWareImages($wareRID){		$this->db->select('_waresimages.*');		$this->db->from('_waresimages');		$this->db->where(array('_wares_rid'=>$wareRID, 'archive'=>'0'));		$this->db->orderby('name');		$query = $this->db->get();		if($query->num_rows()){			return $query->result_array();		}		return FALSE;	}
	public function GetItemImages($itemsRID){		$itemimgsArr = explode('|', $itemsRID);		$this->db->select('_pritemsimgs.*');		$this->db->from('_pritemsimgs');		$this->db->where(array('rid'=>$itemimgsArr[0]));		unset($itemimgsArr[0]);		foreach($itemimgsArr as $imgRid) $this->db->orwhere(array('rid'=>$imgRid));		$this->db->orderby('name');		$query = $this->db->get();		if($query->num_rows()){			return $query->result_array();		}		return FALSE;	}
	public function GetOffersByCategory($cRid, $offset=0){
		$cityRid = $this->ciObject->settings_module->getCurrSetting('_CITY_RID_');
		$regionRid = $this->ciObject->settings_module->getCurrSetting('_REGION_RID_');
		$countryRid = $this->ciObject->settings_module->getCurrSetting('_COUNTRY_RID_');	
		$mcurrRid = $this->ciObject->settings_module->getCurrSetting('_MAIN_CURR_RID_');
		$acurrRid = $this->ciObject->settings_module->getCurrSetting('_ADD_CURR_RID_');
		# get others filters parameters		$this->db->select(" SQL_CALC_FOUND_ROWS _pritems.name as wareNAME, _pritems.descr as wareDESCR,
							_pritemsimgs.rid as prItem_rid, _pritemsimgs.image as prItem_image, _pritemsimgs.name as prItem_name,
							_waresimages.rid as wItem_rid, _waresimages.image as wItem_image, _waresimages.name as wItem_name,
							min(ROUND(IF(_currcources.cource is NULL, _officialcources.cource*_prices.price, _currcources.cource*_prices.price), 2)) as minbasePRICE,							max(ROUND(IF(_currcources.cource is NULL, _officialcources.cource*_prices.price, _currcources.cource*_prices.price), 2)) as maxbasePRICE,
							_wares.rating as wareRATING, _wares.rates_quan as wareRATING,							(SELECT endword FROM _currency WHERE rid='$mcurrRid' limit 1) as baseendWORD,							count(_pritems.rid) as offersQUAN, 							_categories.iscompared, 							_categories.isgrouped, 							_pritems._wares_rid,							max(DISTINCT(_pritems.short_descr)) as short_descr,							_pritems.link_ware,							_clients.name as clientNAME,								_clients.rid as clientRID,							_clients.street as clientSTREET,							_clients.build as clientBUILD,							_clients.wphones as clientWPHONES,							_cities.name as cityNAME,							_pritems.model_alias,							_pritems._categories_rid,							_currency.endword", False);		$this->db->from('_prices');		$this->db->join('_pritems', '_pritems.rid=_prices._pritems_rid AND _pritems.archive=0');		$this->db->join('_pritemsimgs', '_pritems.rid=_pritemsimgs._pritems_rid AND _pritemsimgs.archive=0', 'LEFT');
		$this->db->join('_wares', '_pritems._wares_rid=_wares.rid AND _wares.archive=0', 'LEFT');
		$this->db->join('_waresimages', '_waresimages._wares_rid=_wares.rid AND _waresimages.archive=0', 'LEFT');
		$this->db->join('_clients', '_clients.rid=_pritems._clients_rid AND _clients.archive=0');		$this->db->join('_categories', '_pritems._categories_rid=_categories.rid AND _categories.archive=0');		$this->db->join('_currency', '_prices._currency_rid=_currency.rid AND _currency.archive=0');		$this->db->join('_currcources', '_currcources._clients_rid=_pritems._clients_rid AND _currcources._currency_rid=_prices._currency_rid AND _currcources.courcedate=_pritems.prdate AND _currcources.archive=0', 'LEFT');		$this->db->join('_officialcources', "_officialcources._currency_rid=_prices._currency_rid AND _officialcources.courcedate = (SELECT courcedate from _officialcources WHERE _countries_rid='$countryRid' order by courcedate desc limit 1) AND _officialcources.archive=0 AND _officialcources._countries_rid='$countryRid'", 'LEFT');
		$this->db->join('_cities', '_cities.rid=_clients._cities_rid '.(($cityRid)?"and _clients._cities_rid={$cityRid}":''), 'LEFT');
		$this->db->join('_regions', '_regions.rid=_cities._regions_rid '.((!$cityRid && $regionRid)?"and _regions.rid={$regionRid}":''), 'LEFT');
		$this->db->join('_countries', '_countries.rid=_regions._countries_rid '.(($countryRid)?"and _countries.rid={$countryRid}":''), 'LEFT');
		$this->db->where(array('_pritems._categories_rid'=>$cRid,								'_pritems.archive'=>'0'));		$this->db->groupby('_pritems.rid');		$this->db->limit(15, $offset);
		$query = $this->db->get();
		return $query->num_rows()?$query->result():array();	}
		/**
	 * @author Mazvv
	 * @param void
	 * @return integer $rowsQuan
	 */
	public function getQueryRowsQuan(){
		$this->db->select('FOUND_ROWS() as rowsQuan');
		$query = $this->db->get();
		return $query->row()->rowsQuan; 	
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
		$this->db->where("_pritems.archive='0'");
		if($searchSTR && $searchARR = $this->GetSearchExpression($searchSTR))
		{
			foreach($searchARR as $sSTR) $this->db->like(array('_pritems.name'=>'%'.$sSTR.'%'));
		}
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
	

	public function getTopCategories($limit=15){		$this->db->select('_categories.*, _categoriesimages.rid as imgRid, _categoriesimages.name as imgName, _categoriesimages.image as image');		$this->db->from('_categories');		$this->db->join('_categoriesimages', "_categoriesimages._categories_rid = _categories.rid AND _categoriesimages.imgtype='ICON'", 'LEFT');		$this->db->where('( not _categories._categories_rid ) and _categories.archive = 0');		$this->db->order_by('popularity desc');		$this->db->group_by('_categories.rid');		if($limit) $this->db->limit($limit);		$query = $this->db->get();		return $query->num_rows()?$query->result():array();	}
	public function getSecondLevelCategories(){		$this->db->select('_categories.rid, _categories.name, _categories.slug, _categories._categories_rid');		$this->db->from('_catparents');		$this->db->join('_categories', "_catparents._parent_rid = _categories.rid AND not _categories.archive");		$this->db->where(array('_catparents.level'=>'2'));		$this->db->order_by('popularity desc');		$this->db->group_by('_catparents._parent_rid');		$this->db->order_by('_categories.name');		$query = $this->db->get();		return $query->num_rows()?$query->result():array();	}}
?>