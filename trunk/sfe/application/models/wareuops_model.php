<?php
/*
 * Wareuops Model
 */
class Wareuops_model extends Model
{
	public function __construct()
	{
		parent::Model();
		 		
	}
	
	public function AddUserOpinion($dataARR){
		$wareROW = $this->GetWareRID($dataARR['_categories_rid'], $dataARR['_brands_rid'], $dataARR['model_alias']);
		if(!$wareROW) return false;
		$dataARR['_wares_rid'] = $wareROW['rid'];
		unset($dataARR['_categories_rid']); unset($dataARR['_brands_rid']); unset($dataARR['model_alias']);
		$this->db->insert('_waresuopinions', $dataARR);
		return TRUE;
	}
	
	public function GetWareRID($categoriesRID, $brandsRID, $modelALIAS)
	{
		$this->db->select('*');
		$this->db->from('_wares');
		$this->db->where(array('_brands_rid'=>$brandsRID, '_categories_rid'=>$categoriesRID, 'model_alias'=>$modelALIAS));
		$query = $this->db->get();
		if($query->num_rows()) return $query->row_array();
		return false;
	}
	
}
?>