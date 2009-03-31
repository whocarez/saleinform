<?php
/*
 * Mostpopular Model
 */
class Mostpopular_model extends Model
{
	public function __construct($memoryMode = true)
	{
		parent::Model();
		$this->db->query("SET NAMES 'utf8'");
	}
	
	public function GetTopBrands($parsARR)
	{
		$this->db->select('count(_brands.rid) as pritemsQUAN, _brands.name, _brands.rid, _brands.descr');
		$this->db->from('_brands');
		$this->db->join('_pritems', '_brands.rid=_pritems._brands_rid AND _pritems.archive=0');
		$this->db->join('_clients', '_clients.rid=_pritems._clients_rid AND _clients.archive=0');
		if(!$parsARR['catRID']) $this->db->where(array('_pritems.archive'=>'0', '_pritems.archive'=>'0'));
		else $this->db->where(array('_pritems._categories_rid'=>$parsARR['catRID'], '_pritems.archive'=>'0'));
		if($parsARR['citiesRID'])
		{
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
		$this->db->orderby('count(_brands.rid) DESC');
		$this->db->limit(10);
		$query = $this->db->get();
		if($query->num_rows()) return $query->result_array();
		return false;
	}

	public function GetTopStores($parsARR)
	{
		$this->db->select('count(_clients.rid) as pritemsQUAN, _clients.name, _clients.rid, _clients.descr');
		$this->db->from('_clients');
		$this->db->join('_pritems', "_clients.rid=_pritems._clients_rid AND _pritems.archive='0'", 'LEFT');
		if(!$parsARR['catRID']) $this->db->where(array('_pritems.archive'=>'0', '_pritems.archive'=>'0'));
		else $this->db->where(array('_pritems._categories_rid'=>$parsARR['catRID'], '_pritems.archive'=>'0', '_clients.archive'=>'0'));
		if($parsARR['citiesRID'])
		{
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
		$this->db->groupby('_clients.rid');
		$this->db->orderby('rand()');
		$this->db->limit(10);
		$query = $this->db->get();
		if($query->num_rows()) return $query->result_array();
		return false;
	}
	
	public function GetTopCategories($parsARR)
	{
		/**
		 * Has a problem with performance
		 * 
		 * as temporary dicission is turn on a cache
		 */
				
		$this->db->cache_on();
		$this->db->select('_categories.*, _categoriesimages.rid as irid, _categoriesimages.image as iimage, _categoriesimages.name as iname');
		$this->db->from('_categories');
		$this->db->join('_popularcategories', "_categories.rid = _popularcategories._categories_rid AND _popularcategories.archive='0'", 'LEFT');
		$this->db->join('_categoriesimages', "_categoriesimages._categories_rid = _categories.rid AND _categoriesimages.imgtype='PICTURE' AND _categoriesimages.archive='0'", 'LEFT');
		$this->db->where(array('_categories.archive'=>'0'));
		$this->db->groupby('_categories.rid');
		$this->db->orderby('count(_popularcategories.rid) DESC');
		$query = $this->db->get();
		$this->db->cache_off();
		if($query->num_rows()) return $query->result_array();
		return false;
	}
	
	public function GetTopSearches($catRID = null)
	{
		$this->db->select('_findqueries.*');
		$this->db->from('_findqueries');
		if($catRID) $this->db->where(array('_categories_rid'=>$catRID));
		$this->db->where(array('archive'=>'0'/*, 'resquan > '=>'0'*/)); 
		$this->db->groupby('query');
		$this->db->orderby('createDT DESC');
		$this->db->limit(10);
		$query = $this->db->get();
		if($query->num_rows()) return $query->result_array();
		return false;
	}
	
	
}
?>