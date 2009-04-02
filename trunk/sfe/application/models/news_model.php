<?php
/*
 * News Model
 */
class News_model extends Model{
	public function __construct()
	{
		parent::Model();
		 		
	}
	
	public function getNews($currnewRID = null, $currCAT = null, $currPAGE = null){
		$this->db->select("SQL_CALC_FOUND_ROWS _news.*, DATE_FORMAT(newdate, '%d-%m-%Y | %H:%i') as newDATE, _newscategories.name as newCAT", False);
		$this->db->from('_news');
		$this->db->join('_newscategories', '_news._newscategories_rid=_newscategories.rid');
		if($currnewRID) $this->db->where(array('_news.rid'=>$currnewRID));
		if($currCAT) $this->db->where(array('_news._newscategories_rid'=>$currCAT));
		$this->db->orderby('_news.rid', 'DESC');
		$this->db->limit(10, $currPAGE);
		$query = $this->db->get();
		return $query->num_rows()?$query->result():array();
	}
	
	public function getNewsCats($cRid = null){
		$this->db->select("*");
		$this->db->from('_newscategories');
		$this->db->order_by('name', 'DESC');
		if($cRid) $this->db->where(array('rid'=>$cRid));
		$query = $this->db->get();
		return $query->num_rows()?$query->result():array();
	}
	
	/**
	 * @author Mazvv
	 * @param void
	 * @return integer $rowsQuan
	 */
	public function GetQueryRowsQuan(){
		$this->db->select('FOUND_ROWS() as rowsQuan');
		$query = $this->db->get();
		return $query->row()->rowsQuan; 	
	}
	
}
?>