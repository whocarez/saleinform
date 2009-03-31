<?php
/*
 * Help Model
 */
class Help_model extends Model
{
	public function __construct()
	{
		parent::Model();
		 		
	}
	
	public function GetCurrenciesArr()
	{
		$this->db->select('_currency.*');
		$this->db->from('_currency');
		$this->db->where(array('archive'=>'0'));
		$this->db->orderby('_currency.cod');
		$query = $this->db->get();
		if($query->num_rows()) 
		{
			return $query->result_array();
		}
		return FALSE;
	}
	
	public function GetPrtypesArr()
	{
		$this->db->select('_prtypes.*');
		$this->db->from('_prtypes');
		$this->db->where(array('archive'=>'0'));
		$this->db->orderby('_prtypes.cod');
		$query = $this->db->get();
		if($query->num_rows()) 
		{
			return $query->result_array();
		}
		return FALSE;
	}

	public function GetAvtypesArr()
	{
		$this->db->select('_availabletypes.*');
		$this->db->from('_availabletypes');
		$this->db->where(array('archive'=>'0'));
		$this->db->orderby('_availabletypes.cod');
		$query = $this->db->get();
		if($query->num_rows()) 
		{
			return $query->result_array();
		}
		return FALSE;
	}

	public function GetCategoriesArr()
	{
		$this->db->select('_categories.*');
		$this->db->from('_categories');
		$this->db->where(array('archive'=>'0'));
		$this->db->orderby('_categories.name');
		$query = $this->db->get();
		if($query->num_rows()) 
		{
			return $query->result_array();
		}
		return FALSE;
	}
	
}
?>