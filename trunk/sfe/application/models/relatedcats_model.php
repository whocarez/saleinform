<?php
/*
 * Relatedcats Model
 */
class Relatedcats_model extends Model
{
	public function __construct()
	{
		parent::Model();
		$this->db->query("SET NAMES 'utf8'"); 		
	}
	
	public function GetRelatedCatsList($categoriesRID)
	{
		$this->db->select('_categories.*');
		$this->db->from('_relatedcats');
		$this->db->join('_categories', '_categories.rid=_relatedcats.related_categories_rid');
		if($categoriesRID!==null) $this->db->where(array('_relatedcats._categories_rid'=>$categoriesRID, '_relatedcats.archive'=>'0', '_categories.archive'=>'0'));
		else $this->db->where(array('archive'=>'0'));
		$this->db->orderby('name');
		$query = $this->db->get();
		if($query->num_rows()) 
		{
			return $query->result_array();
		}
		return FALSE;
	}
	
}
?>