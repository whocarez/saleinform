<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
/*
 * Language module
 * Mazvv 28-04-2007
*/
class Lang_module 
{
	private $ciObject;
	private $objectsArr = array();
	public function __construct()
	{
		$this->ciObject = &get_instance();
    	$this->ciObject->lang->load('si');
	}
	
}
?>