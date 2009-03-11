<?php
/*
 * Siclub Model
 */
class Siclub_model extends Model
{
	public function __construct()
	{
		parent::Model();
		$this->db->query("SET NAMES 'utf8'"); 
	}
	
	public function CheckSiclubLogin($login, $password)
	{
		$this->db->select("_users.*, concat(_clients.name,' ', _urforms.little_name) as clname");
		$this->db->from('_users');
		$this->db->join('_clients', "_clients.rid=_users._clients_rid AND _clients.archive='0'");
		$this->db->join('_urforms', "_clients._urforms_rid=_urforms.rid AND _urforms.archive='0'");
		$this->db->where(array('_users.archive'=>'0', '_users.login'=>$login, '_users.passwd'=>$password));
		$query = $this->db->get();
		if($query->num_rows()) return $query->row_array();
		return false;
	}
	
	public function GetClientArr($userRID)
	{
		$this->db->select("_users.*, _clients.*, _regions.rid as regionRID, _countries.rid as countryRID, _cities.rid as cityRID");
		$this->db->from('_users');
		$this->db->join('_clients', "_clients.rid=_users._clients_rid AND _clients.archive='0'");
		$this->db->join('_urforms', "_clients._urforms_rid=_urforms.rid AND _urforms.archive='0'");
		$this->db->join('_cities', "_clients._cities_rid=_cities.rid AND _cities.archive='0'");
		$this->db->join('_regions', "_cities._regions_rid=_regions.rid AND _regions.archive='0'");
		$this->db->join('_countries', "_regions._countries_rid=_countries.rid AND _countries.archive='0'");
		$this->db->where(array('_users.archive'=>'0', '_users.rid'=>$userRID));
		$query = $this->db->get();
		if($query->num_rows()) return $query->row_array();
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
	
	public function SaveGeneralInfo($clientsRID, $updateARR)
	{
		$this->db->where('rid', $clientsRID);
		$this->db->update('_clients', $updateARR);
		return;
	}
	
	public function SaveUserInfo($clientsRID, $updateARR){
		$this->db->where('_clients_rid', $clientsRID);
		$this->db->update('_users', $updateARR);
		return;
	}
}
?>