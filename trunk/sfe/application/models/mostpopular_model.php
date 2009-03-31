<?php
/*
 * Mostpopular Model
 */
class Mostpopular_model extends Model{
	private $ciObject;
	public function __construct($memoryMode = true){
		parent::Model();
		$this->ciObject = &get_instance();
	}
	
	public function GetTopBrands($parsARR){
		$this->db->select('count(_brands.rid) as pritemsQUAN, _brands.name, _brands.rid, _brands.descr');
		$this->db->from('_brands');
		$this->db->join('_pritems', '_brands.rid=_pritems._brands_rid AND _pritems.archive=0');
		$this->db->join('_clients', '_clients.rid=_pritems._clients_rid AND _clients.archive=0');
		if(!$parsARR['catRID']) $this->db->where(array('_pritems.archive'=>'0', '_pritems.archive'=>'0'));
		else $this->db->where(array('_pritems._categories_rid'=>$parsARR['catRID'], '_pritems.archive'=>'0'));
		if($parsARR['citiesRID']){
			$this->db->where(array('_clients._cities_rid'=>$parsARR['citiesRID']));
		}
		else if(!$parsARR['citiesRID'] && $parsARR['regionsRID'])
		{
			$this->db->join('_cities', '_cities.rid=_clients._cities_rid');
			$this->db->join('_regions', '_regions.rid=_cities._regions_rid');
			$this->db->where(array('_regions.rid'=>$parsARR['regionsRID']));
		}
		else
		{
			$this->db->join('_cities', '_cities.rid=_clients._cities_rid');
			$this->db->join('_regions', '_regions.rid=_cities._regions_rid');
			$this->db->join('_countries', '_countries.rid=_regions._countries_rid');
			$this->db->where(array('_countries.rid'=>$parsARR['countriesRID']));
		}
		$this->db->groupby('_brands.rid');
		$this->db->orderby('_brands.popularity DESC');
		$this->db->limit(10);
		$query = $this->db->get();
		if($query->num_rows()) return $query->result_array();
		return false;
	}

	public function GetTopStores(){
		$cityRid = $this->ciObject->settings_module->getSetting('_CITY_RID_');
		$regionRid = $this->ciObject->settings_module->getSetting('_REGION_RID_');
		$countryRid = $this->ciObject->settings_module->getSetting('_COUNTRY_RID_');
		$this->db->select("(select count(_pritems.rid) from _pritems where _clients_rid = _clients.rid AND _pritems.archive = 0) as pritemsQUAN, _clients.name, _clients.popularity, _clients.rid, _clients.descr, _clients.slug");
		$this->db->from('_clients');
		$this->db->join('_cities', '_cities.rid=_clients._cities_rid '.(($cityRid)?"and _clients._cities_rid={$cityRid}":''));
		$this->db->join('_regions', '_regions.rid=_cities._regions_rid '.((!$cityRid && $regionRid)?"and _regions.rid={$regionRid}":''));
		$this->db->join('_countries', '_countries.rid=_regions._countries_rid '.(($countryRid)?"and _countries.rid={$countryRid}":''));
		$this->db->orderby('_clients.popularity', 'desc');
		$this->db->orderby('_clients.name', 'random');
		$this->db->limit(8);
		$query = $this->db->get();
		return $query->num_rows()?$query->result():array();
	}
	
	public function GetTopCategories($limit = 6){
		$this->db->select('_categories.*, _categoriesimages.rid as irid, _categoriesimages.image as iimage, _categoriesimages.name as iname');
		$this->db->from('_categories');
		$this->db->join('_categoriesimages', "_categoriesimages._categories_rid = _categories.rid AND _categoriesimages.imgtype='PICTURE' AND _categoriesimages.archive='0'");
		$this->db->where(array('_categories.archive'=>'0'));
		$this->db->where('( not _categories._categories_rid )');
		if($limit) $this->db->limit($limit);
		$this->db->order_by('popularity DESC');
		$this->db->group_by('_categories.rid');
		$query = $this->db->get();
		return $query->num_rows()?$query->result():array();
	}
	
	public function GetCategoryLeafs($cRid, $limit = 5){
		$cRid = (int)$cRid;
		$this->db->select('_categories.name, _categories.rid, _categories.slug');
		$this->db->from('_categories');
		$this->db->join('_catparents', '_categories.rid = _catparents._categories_rid');
		$this->db->where(array('_categories.archive'=>'0', '_catparents._parent_rid'=>$cRid));
		$this->db->where('_categories.rid NOT in (select _categories_rid from _categories )');
		if($limit) $this->db->limit($limit);
		$query = $this->db->get();
		return $query->num_rows()?$query->result():array();
	}
	
	public function GetTopSearches(){
		$this->db->select('_findqueries.*');
		$this->db->from('_findqueries');
		$this->db->orderby('popularity', 'DESC');
		$this->db->limit(30);
		$query = $this->db->get();
		return $query->num_rows()?$query->result():array();
	}
	
	
}
?>