<?php
/*
 * Categories Model
 */
class Constant_model extends Model
{
	public function __construct($memoryMode = true)
	{
		parent::Model();
		$this->memoryMode = $memoryMode;
		$this->db->query("SET NAMES 'utf8'"); 
	}
	
	public function GetConstants()
	{
		$this->db->select('*');
		$this->db->from('sys_options');
		$this->db->where(array('archive'=>'0'));
		$query = $this->db->get();
		return $query->result_array();
	}
}
?>