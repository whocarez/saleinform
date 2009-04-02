<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
/*
 * Constant module
*/
class Constant_module 
{
	private $ciObject;
	private $m_Constants = array();
	
	public function __construct()
	{
		$this->ciObject = &get_instance();
		$this->ciObject->load->model('constant_model');
		$res = $this->ciObject->constant_model->GetConstants();
		foreach($res as $row) $this->m_Constants[$row['cod']] = $row['value'];
	}
	
	public function GetConstant($constCode)
	{
		if(isset($this->m_Constants[$constCode])) return $this->m_Constants[$constCode];
		return null;
	}
}
?>