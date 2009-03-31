<?php
/*
 * Last Model
 */
class Last_model extends Model{
	public function __construct(){
		parent::Model();
		 
	}
	
	public function GetLastNews(){
		$this->db->select("*, DATE_FORMAT(newdate, '%d-%m-%Y | %H:%i') as newDATE, newdate as forORDER", False);
		$this->db->from('_news');
		$this->db->where(array('archive'=>'0'));
		$this->db->orderby('rid DESC');
		$this->db->limit('5');
		$query = $this->db->get();
		if($query->num_rows()) return $query->result_array();
		return false;
	}

	public function GetLastOpinions()
	{
		$this->db->select("_waresuopinions.*, 
							DATE_FORMAT(_waresuopinions.createDT, '%d-%m-%Y | %H:%i') as opinionDATE,
							_members.display_name,
							_wares._categories_rid,
							_wares._brands_rid,
							_wares.slug,
							_wares.name as wareNAME");
		$this->db->from('_waresuopinions');
		$this->db->join('_wares', '_wares.rid = _waresuopinions._wares_rid');
		$this->db->join('_pritems', '_wares.rid = _pritems._wares_rid AND _pritems.archive=0');
		$this->db->join('_brands', '_brands.rid = _wares._brands_rid');
		$this->db->join('_members', '_members.rid = _waresuopinions._members_rid');
		$this->db->where(array('_waresuopinions.archive'=>'0', '_wares.archive'=>'0'));
		$this->db->orderby('_waresuopinions.createDT DESC');
		$this->db->groupby('_waresuopinions.rid');
		$this->db->limit('5');
		$query = $this->db->get();
		if($query->num_rows()) return $query->result_array();
		return false;
	}

	public function GetLastReviews()
	{
		$this->db->select("_waresrewievs.*, 
							DATE_FORMAT(_waresrewievs.datereview, '%d-%m-%Y | %H:%i') as reviewDATE,
							_wares._categories_rid,
							_wares._brands_rid,
							_wares.slug,
							_wares.name as wareNAME");
		$this->db->from('_waresrewievs');
		$this->db->join('_wares', '_wares.rid = _waresrewievs._wares_rid');
		$this->db->join('_pritems', '_wares.rid = _pritems._wares_rid AND _pritems.archive=0');
		$this->db->join('_brands', '_brands.rid = _wares._brands_rid');
		$this->db->where(array('_waresrewievs.archive'=>'0', '_wares.archive'=>'0'));
		$this->db->orderby('_waresrewievs.datereview DESC');
		$this->db->groupby('_waresrewievs.rid');
		$this->db->limit('5');
		$query = $this->db->get();
		if($query->num_rows()) return $query->result_array();
		return false;
	}
	
	public function GetLastWdetails()
	{
		$this->db->select("/*_warespars.*,*/ 
							_wares._categories_rid,
							_wares._brands_rid,
							_wares.slug,
							/*DATE_FORMAT(_warespars.modifyDT, '%d-%m-%Y | %H:%i') as wdetailsDATE,*/
							DATE_FORMAT(_wares.modifyDT, '%d-%m-%Y | %H:%i') as wdetailsDATE,
							_wares.name as wareNAME");
		//$this->db->from('_warespars');
		$this->db->from('_wares');
		//$this->db->join('_wares', '_wares.rid = _warespars._wares_rid AND _wares.archive=0');
		//$this->db->join('_warespars', '_wares.rid = _warespars._wares_rid AND _wares.archive=0');
		$this->db->join('_pritems', '_wares.rid = _pritems._wares_rid AND _pritems.archive=0');
		$this->db->join('_brands', '_brands.rid = _wares._brands_rid AND _brands.archive=0');
		$this->db->where(array('_wares.archive'=>'0'));
		$this->db->orderby('_wares.modifyDT DESC');
		//$this->db->groupby('_wares.rid');
		$this->db->limit('10');
		$query = $this->db->get();
		if($query->num_rows()) return $query->result_array();
		return false;
	}
	
	
}
?>