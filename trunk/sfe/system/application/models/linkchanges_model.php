<?php
/*
 * Linkchanges Model
 */
class Linkchanges_model extends Model
{
	public function __construct()
	{
		parent::Model();
		$this->db->query("SET NAMES 'utf8'"); 		
	}
	
	public function GetLinksArr($links_quan = 10, $catRID = null)
	{
		$this->db->select('_links.*');
		$this->db->from('_links');
		if($catRID)
		{
			$this->db->join("_linkstocategories", "_linkstocategories._links_rid = _links.rid AND _linkstocategories.archive = 0 AND _linkstocategories._categories_rid = $catRID");
		}
		$this->db->orderby("RAND()");
		$this->db->limit("$links_quan");
		$query = $this->db->get();
		if($query->num_rows()) return $query->result_array();
		return false;
	}
}
?>