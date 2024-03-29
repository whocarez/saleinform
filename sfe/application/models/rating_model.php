<?php
/*
 * Rating Model
 */
class Rating_model extends Model{
	public function __construct($memoryMode = true){
		parent::Model();
	}
	
	public function GetRatedProducts($parsARR){
		$this->db->select('_wares.name as wareNAME, 
							_wares.*, _wares.popularity as wareRATING, 
							count(_wares.rid) as offersQUAN,
							_waresimages.name as iname, 
							/*_pritems.short_descr as shortDESCR,*/
							SFE_GetItemShortDescr(_pritems._wares_rid, _pritems.rid) as shortDESCR,
							_waresimages.image as image, 
							_waresimages.rid as irid', False);
		$this->db->from('_pritems');
		$this->db->join('_wares', '_wares.rid=_pritems._wares_rid');
		$this->db->join('_waresuopinions', '_wares.rid=_waresuopinions._wares_rid');
		$this->db->join('_clients', '_clients.rid=_pritems._clients_rid');
		$this->db->join('_waresimages', '_wares.rid=_waresimages._wares_rid', 'LEFT');
		$this->db->join('_brands', '_brands.rid=_pritems._brands_rid');	
		if(!$parsARR['catRID']) $this->db->where(array('_wares.archive'=>'0', '_waresuopinions.archive'=>'0'));
		else $this->db->where(array('_wares._categories_rid'=>$parsARR['catRID'], '_wares.archive'=>'0', '_waresuopinions.archive'=>'0'));
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
		$this->db->groupby('_wares.rid');
		$this->db->having(array('wareRATING>='=>'7'));
		$this->db->orderby('wareRATING DESC');
		$this->db->limit(10);
		$query = $this->db->get();
		if($query->num_rows()) return $query->result_array();
		return false;
	}
}
?>