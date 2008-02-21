<?php
/*
 * News Model
 */
class News_model extends Model
{
	public function __construct()
	{
		parent::Model();
		$this->db->query("SET NAMES 'utf8'"); 		
	}
	
	public function GetNewsArr($currnewRID = null, $currCAT = null)
	{
		$this->db->select("_news.*, DATE_FORMAT(newdate, '%d-%m-%Y | %H:%i') as newDATE, _newscategories.name as newCAT");
		$this->db->from('_news');
		$this->db->join('_newscategories', '_news._newscategories_rid=_newscategories.rid');
		if($currnewRID) $this->db->where(array('_news.rid'=>$currnewRID));
		if($currCAT) $this->db->where(array('_news._newscategories_rid'=>$currCAT));
		$this->db->orderby('_news.createDT', 'DESC');
		$query = $this->db->get();
		if($query->num_rows()) return $query->result_array();
		return false;
	}
	
	public function GetNewsCatsArr($catRID = null)
	{
		$this->db->select("*");
		$this->db->from('_newscategories');
		$this->db->orderby('name', 'DESC');
		if($catRID) $this->db->where(array('rid'=>$catRID));
		$query = $this->db->get();
		if($query->num_rows()) return $query->result_array();
		return false;
	}
	
}
?>