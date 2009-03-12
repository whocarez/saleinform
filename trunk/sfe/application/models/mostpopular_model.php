<?php
/*
 * Mostpopular Model
 */
class Mostpopular_model extends Model{
	public function __construct($memoryMode = true){
		parent::Model();
	}
	
	public function getSearchesTags($limit = 15){
		$this->db->select('*');
		$this->db->from('_findqueries');
		$this->db->order_by('popularity desc');
		$this->db->limit($limit);
		$query = $this->db->get();
		return $query->num_rows()?$query->result():array();
	}
}
?>