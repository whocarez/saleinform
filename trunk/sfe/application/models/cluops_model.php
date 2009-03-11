<?php
/*
 * Cluops Model
 */
class Cluops_model extends Model
{
	public function __construct(){
		parent::Model();
		$this->db->query("SET NAMES 'utf8'"); 		
	}
	
	public function addReview($dataARR){
		$this->db->insert('_cluopinions', $dataARR);
		return TRUE;
	}
}
?>