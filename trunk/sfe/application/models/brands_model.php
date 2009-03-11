<?php
/*
 * Brands Model
 */
class Brands_model extends Model
{
	public function __construct()
	{
		parent::Model();
		$this->db->query("SET NAMES 'utf8'"); 		
	}
	
	public function GetBrandArr($parsARR)
	{
		$brandRID = $parsARR['_brands_rid'];
		$countryRID = isset($parsARR['_countries_rid'])?$parsARR['_countries_rid']:null;
		$regionRID = isset($parsARR['_regions_rid'])?$parsARR['_regions_rid']:null;
		$cityRID = isset($parsARR['_cities_rid'])?$parsARR['_cities_rid']:null;
		$this->db->select('_brands.*, count(_pritems.rid) as broffers');
		$this->db->from('_brands');
		$this->db->join('_pritems', "_brands.rid = _pritems._brands_rid AND _pritems.archive='0'", 'LEFT');
		$this->db->join('_clients', '_clients.rid=_pritems._clients_rid AND _clients.archive=0');
		if($cityRID)
		{
			$this->db->where(array('_clients._cities_rid'=>$cityRID));
		}
		else if(!$cityRID && $regionRID)
		{
			$this->db->join('_cities', '_cities.rid=_clients._cities_rid');
			$this->db->join('_regions', '_regions.rid=_cities._regions_rid');
			$this->db->where(array('_regions.rid'=>$regionRID));
		}
		else
		{
			$this->db->join('_cities', '_cities.rid=_clients._cities_rid');
			$this->db->join('_regions', '_regions.rid=_cities._regions_rid');
			$this->db->join('_countries', '_countries.rid=_regions._countries_rid');
			$this->db->where(array('_countries.rid'=>$countryRID));
		}
		$this->db->where(array('_brands.rid'=>$brandRID));
		$this->db->groupby('_brands.rid');
		$query = $this->db->get();
		if($query->num_rows()) return $query->row_array();
		return false;
	}
	
	public function GetBrandsByLetter($parsARR)
	{
		$brandRID = $parsARR['_brands_rid'];
		$countryRID = isset($parsARR['_countries_rid'])?$parsARR['_countries_rid']:null;
		$regionRID = isset($parsARR['_regions_rid'])?$parsARR['_regions_rid']:null;
		$cityRID = isset($parsARR['_cities_rid'])?$parsARR['_cities_rid']:null;
		$sr = isset($parsARR['sr'])?$parsARR['sr']:null;
		$this->db->select('_brands.*, count(_pritems.rid) as broffers');
		$this->db->from('_brands');
		$this->db->join('_pritems', "_brands.rid = _pritems._brands_rid AND _pritems.archive='0'", 'LEFT');
		$this->db->join('_clients', '_clients.rid=_pritems._clients_rid AND _clients.archive=0');
		if($cityRID)
		{
			$this->db->where(array('_clients._cities_rid'=>$cityRID));
		}
		else if(!$cityRID && $regionRID)
		{
			$this->db->join('_cities', '_cities.rid=_clients._cities_rid');
			$this->db->join('_regions', '_regions.rid=_cities._regions_rid');
			$this->db->where(array('_regions.rid'=>$regionRID));
		}
		else
		{
			$this->db->join('_cities', '_cities.rid=_clients._cities_rid');
			$this->db->join('_regions', '_regions.rid=_cities._regions_rid');
			$this->db->join('_countries', '_countries.rid=_regions._countries_rid');
			$this->db->where(array('_countries.rid'=>$countryRID));
		}
		if($sr=='0-9')
		{
			$this->db->where("( _brands.name REGEXP '^0' OR _brands.name REGEXP '^1' OR _brands.name REGEXP '^2' OR
								_brands.name REGEXP '^3' OR _brands.name REGEXP '^4' OR _brands.name REGEXP '^5' OR
								_brands.name REGEXP '^6' OR _brands.name REGEXP '^7' OR _brands.name REGEXP '^8' OR
								_brands.name REGEXP '^9')");
		}
		else
		{ 
			$t = mb_strtoupper($sr, 'UTF-8');  
			$this->db->where("(_brands.name REGEXP '^$sr' OR  _brands.name REGEXP '^$t')");
		}
		$this->db->groupby('_brands.rid');
		$this->db->orderby('_brands.name');
		$query = $this->db->get();
		if($query->num_rows()) return $query->result_array();
		return false;
	}
	
	public function GetBrandProducts($parsARR)
	{
		$brandRID = $parsARR['_brands_rid'];
		$countryRID = isset($parsARR['_countries_rid'])?$parsARR['_countries_rid']:null;
		$regionRID = isset($parsARR['_regions_rid'])?$parsARR['_regions_rid']:null;
		$cityRID = isset($parsARR['_cities_rid'])?$parsARR['_cities_rid']:null;
		$sr = isset($parsARR['sr'])?$parsARR['sr']:null;
		$this->db->select('count(_pritems.rid) as catoffers, _categories.name, _categories.rid, _pritems._brands_rid as brandRID');
		$this->db->from('_pritems');
		$this->db->join('_categories', '_categories.rid = _pritems._categories_rid AND _categories.archive=0');
		$this->db->join('_clients', '_clients.rid=_pritems._clients_rid AND _clients.archive=0');
		if($cityRID)
		{
			$this->db->where(array('_clients._cities_rid'=>$cityRID));
		}
		else if(!$cityRID && $regionRID)
		{
			$this->db->join('_cities', '_cities.rid=_clients._cities_rid');
			$this->db->join('_regions', '_regions.rid=_cities._regions_rid');
			$this->db->where(array('_regions.rid'=>$regionRID));
		}
		else
		{
			$this->db->join('_cities', '_cities.rid=_clients._cities_rid');
			$this->db->join('_regions', '_regions.rid=_cities._regions_rid');
			$this->db->join('_countries', '_countries.rid=_regions._countries_rid');
			$this->db->where(array('_countries.rid'=>$countryRID));
		}
		$this->db->where(array('_pritems._brands_rid'=>$brandRID, '_pritems.archive'=>0, '_categories.archive'=>0));
		$this->db->groupby('_pritems._categories_rid');
		$this->db->orderby('_categories.name');				
		$query = $this->db->get();
		if($query->num_rows()) return $query->result_array();
		return false;
	}
	
}
?>