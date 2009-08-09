<?php
/*
 * Clicks Model
 */
class Clicks_model extends Model{
	public function __construct(){
		parent::Model();
		 		
	}
	
	public function getOfferUrl($offerRid){
		$this->db->select('link_ware');
		$this->db->from('_pritems');
		$this->db->where(array('rid'=>$offerRid));
		$query = $this->db->get();
		return $query->num_rows()?$query->row():null;
	}
}
?>