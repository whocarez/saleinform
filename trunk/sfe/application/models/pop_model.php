<?php
/*
 * Pop Model
 */
class Pop_model extends Model{
	public function __construct(){
		parent::Model();
	}
	
	public function SetCatPop($cRid){
		$this->db->select('_parent_rid');
		$this->db->from('_catparents');
		$this->db->where(array('_categories_rid'=>$cRid));
		$query = $this->db->get();
		$rids = array($cRid);
		foreach($query->result() as $row) $rids[] = $row->_parent_rid;		
		$whereinStr = '('.implode(',',$rids).')';
		$this->db->query("update _categories set popularity = popularity+1 where rid in {$whereinStr}");
		return;
	}

	public function SetWarePop($insertARR){
		$this->db->select('*');
		$this->db->from('_popularwares');
		$this->db->where($insertARR);
		$query = $this->db->get();
		if(!$query->num_rows()) $this->db->insert('_popularwares', $insertARR);
		return;
	}

	public function SetBrandPop($insertARR)
	{
		$this->db->select('*');
		$this->db->from('_popularbrands');
		$this->db->where($insertARR);
		$query = $this->db->get();
		if(!$query->num_rows()) $this->db->insert('_popularbrands', $insertARR);
		return;
	}

	public function SetClientPop($clientRID)
	{
		
	}
}
?>