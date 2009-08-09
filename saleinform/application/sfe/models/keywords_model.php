<?php
/*
 * Keywords Model
 */
class Keywords_model extends Model
{
	public function __construct()
	{
		parent::Model();
		 
	}

	public function GetKeywordsOptions()
	{
		
	}
	
	public function GetLastWdetails()
	{
		$this->db->select("_warespars.*, 
							_wares._categories_rid,
							_wares._brands_rid,
							_wares.slug,
							DATE_FORMAT(_warespars.modifyDT, '%d-%m-%Y | %H:%i') as wdetailsDATE,
							_wares.name as wareNAME");
		$this->db->from('_warespars');
		$this->db->join('_wares', '_wares.rid = _warespars._wares_rid');
		$this->db->join('_brands', '_brands.rid = _wares._brands_rid');
		$this->db->where(array('_warespars.archive'=>'0', '_wares.archive'=>'0'));
		$this->db->orderby('_warespars.modifyDT DESC');
		$this->db->groupby('_warespars._wares_rid');
		$this->db->limit('10');
		$query = $this->db->get();
		if($query->num_rows()) return $query->result_array();
		return false;
	}
	
	
}
?>