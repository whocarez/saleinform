<?php
/*
 * Clients Model
 */
class Clients_model extends Model
{
	public function __construct()
	{
		parent::Model();
		$this->db->query("SET NAMES 'utf8'"); 		
	}
	
	public function GetClientArr($clientsRID)
	{
		$this->db->select('_clients.*, count(_pritems.rid) as cloffers, 
							ROUND((SELECT avg(mark) FROM _cluopinions WHERE _clients_rid=_clients.rid), 0) as rating,
							ROUND((SELECT count(mark) FROM _cluopinions WHERE _clients_rid=_clients.rid), 0) as opsquan,
							_cities.name as _cities_name, _regions.name as _regions_name, _countries.name as _countries_name');
		$this->db->from('_clients');
		$this->db->join('_cities', "_cities.rid = _clients._cities_rid AND _cities.archive='0'");
		$this->db->join('_regions', "_regions.rid = _cities._regions_rid AND _regions.archive='0'");
		$this->db->join('_countries', "_countries.rid = _regions._countries_rid AND _countries.archive='0'");
		$this->db->join('_pritems', "_clients.rid = _pritems._clients_rid AND _pritems.archive='0'", 'LEFT');
		
		$this->db->where(array('_clients.rid'=>$clientsRID, '_clients.archive'=>'0'));
		$this->db->groupby('_clients.rid');
		$query = $this->db->get();
		if($query->num_rows()) return $query->row_array();
		return false;
	}
	
	public function GetClientsByLetter($parsARR)
	{
		$countryRID = isset($parsARR['_countries_rid'])?$parsARR['_countries_rid']:null;
		$regionRID = isset($parsARR['_regions_rid'])?$parsARR['_regions_rid']:null;
		$cityRID = isset($parsARR['_cities_rid'])?$parsARR['_cities_rid']:null;
		$sr = isset($parsARR['sr'])?$parsARR['sr']:null;
		
		$this->db->select('_clients.*, count(_pritems.rid) as cloffers, 
							ROUND((SELECT avg(mark) FROM _cluopinions WHERE _clients_rid=_clients.rid), 0) as rating, 
							ROUND((SELECT count(mark) FROM _cluopinions WHERE _clients_rid=_clients.rid), 0) as opsquan');
		$this->db->from('_clients');
		$this->db->join('_pritems', "_clients.rid = _pritems._clients_rid AND _pritems.archive='0'", 'LEFT');
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
		if($sr=='l09')
		{
			$this->db->where("( _clients.name REGEXP '^0' OR _clients.name REGEXP '^1' OR _clients.name REGEXP '^2' OR
								_clients.name REGEXP '^3' OR _clients.name REGEXP '^4' OR _clients.name REGEXP '^5' OR
								_clients.name REGEXP '^6' OR _clients.name REGEXP '^7' OR _clients.name REGEXP '^8' OR
								_clients.name REGEXP '^9')");
		}
		else if($sr)
		{ 
			$t = mb_strtoupper($sr, 'UTF-8');  
			$this->db->where("(_clients.name REGEXP '^$sr' OR  _clients.name REGEXP '^$t')");
		}
		$this->db->groupby('_clients.rid');
		$this->db->orderby('_clients.name');
		$query = $this->db->get();
		if($query->num_rows()) return $query->result_array();
		return false;
	}
	
	public function GetClientOpinions($clientsRID)
	{
		$this->db->select('_cluopinions.mark, _cluopinions.opinion, _members.display_name, DATE_FORMAT(_cluopinions.createDT, "%d-%m-%Y %H:%i:%s") as opinionDATE');
		$this->db->from('_cluopinions');
		$this->db->join('_members', '_cluopinions._members_rid = _members.rid');
		$this->db->where(array('_clients_rid'=>$clientsRID, '_cluopinions.archive'=>0, '_members.archive'=>0));		
		$query = $this->db->get();
		if($query->num_rows()) return $query->result_array();
		return false;
	}

	public function GetClientProducts($clientsRID)
	{
		$this->db->select('count(_pritems.rid) as catoffers, _categories.name, _categories.rid, _pritems._clients_rid as clientRID');
		$this->db->from('_pritems');
		$this->db->join('_categories', '_categories.rid = _pritems._categories_rid');
		$this->db->where(array('_pritems._clients_rid'=>$clientsRID, '_pritems.archive'=>0, '_categories.archive'=>0));
		$this->db->groupby('_pritems._categories_rid');
		$this->db->orderby('_categories.name');				
		$query = $this->db->get();
		if($query->num_rows()) return $query->result_array();
		return false;
	}

	public function GetUrformsList()
	{
		$this->db->select('*');
		$this->db->from('_urforms');
		$this->db->where('archive=0');
		$this->db->orderby('little_name');
		$query = $this->db->get();
		if($query->num_rows()) return $query->result_array();
		return false;
	}
	
	public function GetCltypesList()
	{
		$this->db->select('*');
		$this->db->from('_cltypes');
		$this->db->where('archive=0');
		$this->db->orderby('name');
		$query = $this->db->get();
		if($query->num_rows()) return $query->result_array();
		return false;
	}

	public function GetCountriesList()
	{
		$this->db->select('*');
		$this->db->from('_countries');
		$this->db->where('archive=0');
		$this->db->orderby('name');
		$query = $this->db->get();
		if($query->num_rows()) return $query->result_array();
		return false;
	}

	public function GetRegionsList($countryRID)
	{
		$this->db->select('*');
		$this->db->from('_regions');
		$this->db->where(array('archive'=>0, '_countries_rid'=>$countryRID));
		$this->db->orderby('name');
		$query = $this->db->get();
		if($query->num_rows()) return $query->result_array();
		return false;
	}

	public function GetCitiesList($regionRID)
	{
		$this->db->select('*');
		$this->db->from('_cities');
		$this->db->where(array('archive'=>0, '_regions_rid'=>$regionRID));
		$this->db->orderby('name');
		$query = $this->db->get();
		if($query->num_rows()) return $query->result_array();
		return false;
	}
	
	public function CheckNewLogin($login)
	{
		$query = $this->db->getwhere('_users', array('login'=>$login));
		if($query->num_rows()) return true;
		return false;
	}

	public function CheckClientName($name, $city)
	{
		$query = $this->db->getwhere('_clients', array('name'=>$name, '_cities_rid'=>$city));
		if($query->num_rows()) return true;
		return false;
	}
	
	public function AddClient($insertARR)
	{
		try
		{
			$this->db->insert('_clients', $insertARR);
			$query = $this->db->query('select last_insert_id() as _clients_rid');
			return $query->row_array();
		}
		catch (Exception $e)
		{
			return false;  
		}
		
	}
	
	public function AddUser($insertARR)
	{
		try
		{
			$this->db->insert('_users', $insertARR);
			return true;
		}
		catch(Exception $e)
		{
			return false;
		}
	}
	
}
?>