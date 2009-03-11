<?php
/*
 * Pop Model
 */
class Pop_model extends Model
{
	public function __construct()
	{
		parent::Model();
		$this->db->query("SET NAMES 'utf8'"); 		
	}
	
	public function SetCatPop($insertARR)
	{
		$this->db->select('*');
		$this->db->from('_popularcategories');
		$this->db->where($insertARR);
		$query = $this->db->get();
		if(!$query->num_rows()) $this->db->insert('_popularcategories', $insertARR);
		return;
	}

	public function SetWarePop($insertARR)
	{
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