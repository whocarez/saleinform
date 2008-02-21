<?php
/*
 * Guides Model
 */
class Guides_model extends Model
{
	public function __construct()
	{
		parent::Model();
		$this->db->query("SET NAMES 'utf8'"); 		
	}
	
	public function GetGuidesArr()
	{
		$this->db->select('_guides.*, _categories.name as name');
		$this->db->from('_guides');
		$this->db->join('_categories', "_categories.rid=_guides._categories_rid AND _categories.archive='0'");
		$this->db->orderby('_categories.name');
		$query = $this->db->get();
		if($query->num_rows()) 
		{
			return $query->result_array();
		}
		return FALSE;
	}

	public function GetCategoryGuide($catRID)
	{
		$this->db->select('_guides.*, _categories.name as name');
		$this->db->from('_guides');
		$this->db->join('_categories', "_categories.rid=_guides._categories_rid AND _categories.archive='0'");
		$this->db->where(array('_guides._categories_rid'=>$catRID));
		$this->db->orderby('_categories.name');
		$query = $this->db->get();
		if($query->num_rows()) 
		{
			return $query->row_array();
		}
		return FALSE;
	}
	
}
?>