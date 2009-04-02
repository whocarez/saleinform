<?php
class Categories_model extends Model{
	public function GetCategories($categoriesRID=null){
			$this->db->where(array('_categories._categories_rid'=>$categoriesRID, '_categories.archive'=>'0'));
		}
	public function getCategoryInfo($categoriesRID){
	public function GetCategoryImages($categoriesRID, $imageTYPE = null)
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
		$query = $this->db->get();
	}

	public function GetItemImages($itemsRID){
		$itemimgsArr = explode('|', $itemsRID);
		$this->db->select('_pritemsimgs.*');
		$this->db->from('_pritemsimgs');
		/*$this->db->where(array('rid'=>$itemimgsArr[0]));
		unset($itemimgsArr[0]);*/
		foreach($itemimgsArr as $imgRid) $this->db->orwhere(array('rid'=>$imgRid));
		$this->db->orderby('name');
		$query = $this->db->get();
	}

	public function GetOffersByCategory($cRid){
		$c = $this->getCategoryInfo($cRid);
		$this->db->limit(15, $page);
		$query = $this->db->get();

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

	public function GetSearchResult($searchSTR){
	public function setSearchStat($str){

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

	public function getSecondLevelCategories(){
}
?>