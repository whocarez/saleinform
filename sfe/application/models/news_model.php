<?php
class News_model extends Model{
	public function __construct(){
	public function getNews($currnewRID = null, $currCAT = null, $currPAGE = null){
		$this->db->orderby('_news.rid', 'DESC');
		$this->db->limit(10, $currPAGE);

	public function getNewsCats($cRid = null){
	
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