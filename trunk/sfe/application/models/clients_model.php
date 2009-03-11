<?php
	public function __construct(){
	
	public function GetClientOpinions($clientsRID){

	public function GetUrformsList(){
	
	public function GetCltypesList(){
	}

	public function GetCountriesList(){
		$this->db->select('*');
		$this->db->from('_countries');
		$this->db->orderby('name');
		$query = $this->db->get();
		return $query->num_rows()?$query->result():array();
	}

	public function GetRegionsList($countryRID){
		$this->db->select('*');
		$this->db->from('_regions');
		$this->db->where(array('archive'=>0, '_countries_rid'=>$countryRID));
		$this->db->orderby('name');
		$query = $this->db->get();
		return $query->num_rows()?$query->result():array();
	}

	public function GetCitiesList($regionRID){
		$this->db->select('*');
		$this->db->from('_cities');
		$this->db->where(array('archive'=>0, '_regions_rid'=>$regionRID));
		$this->db->orderby('name');
		$query = $this->db->get();
		return $query->num_rows()?$query->result():array();
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
	
	public function getNewestClients($limit = 15, $cltypecode = 'ESHOP'){
	}
	
	public function getClientsList($letter){
		if($letter=='0-9'){

	public function GetClientProducts($clientsRID){
		$this->db->select('count(_pritems.rid) as offers_quan, _categories.name, _categories.rid, _categories.slug, 
							_pritems._clients_rid as clientRID');
		$this->db->from('_pritems');
		$this->db->join('_categories', '_categories.rid = _pritems._categories_rid');
		$this->db->where(array('_pritems._clients_rid'=>$clientsRID, '_pritems.archive'=>0, '_categories.archive'=>0));
		$this->db->groupby('_pritems._categories_rid');
		$this->db->orderby('_categories.name');				
		$query = $this->db->get();
		return $query->num_rows?$query->result():array();
	}
	
	public function getClient($clientsRID){
		$this->db->select('_clients.*, count(_pritems.rid) as cloffers, 
							ROUND((SELECT avg(mark) FROM _cluopinions WHERE _clients_rid=_clients.rid), 0) as rating,
							ROUND((SELECT count(mark) FROM _cluopinions WHERE _clients_rid=_clients.rid), 0) as opsquan,
							_cities.name as _cities_name, _regions.name as _regions_name, _countries.name as _countries_name,
							_clientslogos.rid as logo_rid, _clientslogos.name as logo_name, _clientslogos.image as logo_image', False);
		$this->db->from('_clients');
		$this->db->join('_clientslogos', "_clientslogos._clients_rid = _clients.rid", 'LEFT');
		$this->db->join('_cities', "_cities.rid = _clients._cities_rid AND _cities.archive='0'");
		$this->db->join('_regions', "_regions.rid = _cities._regions_rid AND _regions.archive='0'");
		$this->db->join('_countries', "_countries.rid = _regions._countries_rid AND _countries.archive='0'");
		$this->db->join('_pritems', "_clients.rid = _pritems._clients_rid AND _pritems.archive='0'", 'LEFT');
		
		$this->db->where(array('_clients.rid'=>$clientsRID, '_clients.archive'=>'0'));
		$this->db->groupby('_clients.rid');
		$query = $this->db->get();
		return $query->num_rows?$query->row():array();
	}
}
?>