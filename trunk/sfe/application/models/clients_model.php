<?php/* * Clients Model */class Clients_model extends Model{	private $ciObject;	
	public function __construct(){		parent::Model();		$this->ciObject= &get_instance();	}
	
	public function GetClientOpinions($clientsRID){		$this->db->select('_cluopinions.mark, _cluopinions.opinion, _members.display_name, DATE_FORMAT(_cluopinions.createDT, "%d-%m-%Y %H:%i:%s") as opinionDATE');		$this->db->from('_cluopinions');		$this->db->join('_members', '_cluopinions._members_rid = _members.rid');		$this->db->where(array('_clients_rid'=>$clientsRID, '_cluopinions.archive'=>0, '_members.archive'=>0));				$query = $this->db->get();		if($query->num_rows()) return $query->result_array();		return false;	}

	public function GetUrformsList(){		$this->db->select('*');		$this->db->from('_urforms');		$this->db->orderby('little_name');		$query = $this->db->get();		return $query->num_rows()?$query->result():array();	}
	
	public function GetCltypesList(){		$this->db->select('*');		$this->db->from('_cltypes');		$this->db->orderby('name');		$query = $this->db->get();		return $query->num_rows()?$query->result():array();
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
	
	public function getNewestClients($limit = 15, $cltypecode = 'ESHOP'){		$this->db->select("_clients.*, GROUP_CONCAT(DISTINCT _categories.name ORDER BY _categories.name DESC SEPARATOR ', ') as cats, _clientslogos.name as logo_name, 		_clientslogos.rid as logo_rid, _clientslogos.type as logo_type, _clientslogos.size as logo_size, _clientslogos.image as logo_image, _countries.name as country_name,		_countries.cod as country_cod, _regions.name as region_name, _cities.name as city_name", False);		$this->db->from('_clients');		$this->db->where(array('_clients.active >'=>0, '_cltypes.code'=>$cltypecode));		$this->db->join('_cities', "_cities.rid = _clients._cities_rid AND _cities.archive='0'");		$this->db->join('_regions', "_regions.rid = _cities._regions_rid AND _regions.archive='0'");		$this->db->join('_countries', "_countries.rid = _regions._countries_rid AND _countries.archive='0'");		$this->db->join('_cltypes', '_cltypes.rid = _clients._cltypes_rid', 'LEFT');		$this->db->join('_clientslogos', '_clientslogos._clients_rid = _clients.rid', 'LEFT');		$this->db->join('_clcats', '_clcats._clients_rid = _clients.rid', 'LEFT');		$this->db->join('_categories', '_clcats._categories_rid = _categories.rid', 'LEFT');		$this->db->group_by('_clients.rid');		$this->db->order_by('_clients.rid desc');		$this->db->limit($limit);		$query = $this->db->get();		return $query->num_rows()?$query->result():array();
	}
	
	public function getClientsList($letter){		$countryRID = $this->ciObject->settings_module->getSetting('_COUNTRY_RID_');		$regionRID = $this->ciObject->settings_module->getSetting('_REGION_RID_');		$cityRID = $this->ciObject->settings_module->getSetting('_CITY_RID_');		$this->db->select("_clients.*, /*count(_pritems.rid) as cloffers,*/ 							ROUND((SELECT avg(mark) FROM _cluopinions WHERE _clients_rid=_clients.rid), 0) as rating, 							ROUND((SELECT count(mark) FROM _cluopinions WHERE _clients_rid=_clients.rid), 0) as opsquan,							(SELECT count(rid) FROM _pritems WHERE _clients_rid=_clients.rid) as cloffers,							GROUP_CONCAT(DISTINCT _categories.name ORDER BY _categories.name DESC SEPARATOR ', ') as cats, 							_clientslogos.name as logo_name, _clientslogos.rid as logo_rid, _clientslogos.type as logo_type, 							_clientslogos.size as logo_size, _clientslogos.image as logo_image, _countries.name as country_name,							_countries.cod as country_cod, _regions.name as region_name, _cities.name as city_name", False);		$this->db->from('_clients');		$this->db->join('_clientslogos', "_clients.rid = _clientslogos._clients_rid", 'LEFT');				$this->db->join('_clcats', '_clcats._clients_rid = _clients.rid', 'LEFT');		$this->db->join('_categories', '_clcats._categories_rid = _categories.rid', 'LEFT');		$this->db->join('_cities', '_cities.rid=_clients._cities_rid');		$this->db->join('_regions', '_regions.rid=_cities._regions_rid');		$this->db->join('_countries', '_countries.rid=_regions._countries_rid');				if($cityRID) $this->db->where(array('_clients._cities_rid'=>$cityRID));		else if(!$cityRID && $regionRID) $this->db->where(array('_regions.rid'=>$regionRID));		else $this->db->where(array('_countries.rid'=>$countryRID));
		if($letter=='0-9'){			$this->db->where("( _clients.name REGEXP '^0' OR _clients.name REGEXP '^1' OR _clients.name REGEXP '^2' OR								_clients.name REGEXP '^3' OR _clients.name REGEXP '^4' OR _clients.name REGEXP '^5' OR								_clients.name REGEXP '^6' OR _clients.name REGEXP '^7' OR _clients.name REGEXP '^8' OR								_clients.name REGEXP '^9')");		}		else{ 			$t = mb_strtoupper($letter, 'UTF-8');  			$this->db->where("(_clients.name REGEXP '^$letter' OR  _clients.name REGEXP '^$t')");		}		$this->db->groupby('_clients.rid');		$this->db->orderby('_clients.name');		$query = $this->db->get();		return $query->num_rows?$query->result():array();	}

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
							_cities.name as _cities_name, _regions.name as _regions_name, _countries.name as _countries_name,							_countries.cod as _countries_cod, 
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
	}		public function getClientReviews($cRid, $limit=15, $offset = 0){		$this->ciObject->load->library('accounts_module');		$user = $this->ciObject->accounts_module->isLogged();		$userRid = $user?$user['_USER_RID_']:0;		$this->db->select("_cluopinions.*, DATE_FORMAT(_cluopinions.createDT, '%d/%m/%Y') as rdate, _members.login,							(select _clopinionsrates.rate from _clopinionsrates where _clopinionsrates._cluopinions_rid=_cluopinions.rid and _clopinionsrates._members_rid = {$userRid} limit 1) as urate,							(select sum(_clopinionsrates.rate) from _clopinionsrates where _clopinionsrates._cluopinions_rid=_cluopinions.rid) as r_rate");			$this->db->from('_cluopinions');		$this->db->join('_members', "_members.rid = _cluopinions._members_rid AND _members.archive='0'");		$this->db->where(array('_cluopinions._clients_rid'=>$cRid));		$this->db->limit($limit, $offset);		$this->db->order_by('_cluopinions.createDT desc');		$query = $this->db->get();		return $query->num_rows?$query->result():array();	}		public function getClientReviewsQuan($cRid){		$this->db->select("count(_cluopinions.rid) as quan");			$this->db->from('_cluopinions');		$this->db->where(array('_cluopinions._clients_rid'=>$cRid));		$query = $this->db->get();		return $query->row()->quan;	}		public function getClcats($cRid){		$this->db->select("_categories.rid, _categories.name, _categories.slug");		$this->db->from('_clcats');		$this->db->join('_categories', "_categories.rid = _clcats._categories_rid AND _categories.archive='0'");		$this->db->where(array('_clcats._clients_rid'=>$cRid));		$query = $this->db->get();		return $query->num_rows?$query->result():array();	}		public function addReview($dataARR){		$this->db->insert('_cluopinions', $dataARR);		return TRUE;	}		public function rateReview($inArr){		$this->db->insert('_clopinionsrates', $inArr);		return True;	}		public function getReviewRate($rRid){		$this->db->select('sum(_clopinionsrates.rate) as rate');		$this->db->from('_clopinionsrates');		$this->db->where(array('_cluopinions_rid'=>$rRid));		$query = $this->db->get();		return $query->num_rows()?$query->row()->rate:0;	}		public function reviewWasRated($rRid, $mRid){		$this->db->select('rid');		$this->db->from('_clopinionsrates');		$this->db->where(array('_cluopinions_rid'=>$rRid, '_members_rid'=>$mRid));		$query = $this->db->get();		return $query->num_rows()?True:False;	}	
}
?>