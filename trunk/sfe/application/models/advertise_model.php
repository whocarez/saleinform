<?php
/*
 * Advertise Model
 */
class Advertise_model extends Model
{
	public function __construct()
	{
		parent::Model();
		$this->db->query("SET NAMES 'utf8'"); 
	}
	
	public function GetAdveriseArr($position, $type)
	{
		$this->db->select('_advertises.*');
		$this->db->from('_bareas');
		$this->db->join('_advertises', "_advertises._bareas_rid=_bareas.rid AND _advertises.archive='0'");
		$this->db->where(array('_bareas.archive'=>'0', '_bareas.areatype'=>$type, '_bareas.areaposition'=>$position));
		$this->db->orderby('RAND()');
		$this->db->limit(3);
		$query = $this->db->get();
		if($query->num_rows()) return $query->result_array();
		return false;
	}
	
}
?>