<?php
/*
 * Cluops Model
 */
class Cluops_model extends Model
{
	public function __construct()
	{
		parent::Model();
		 		
	}
	
	public function AddUserOpinion($dataARR)
	{
		$this->db->insert('_cluopinions', $dataARR);
		return TRUE;
	}
}
?>