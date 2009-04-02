<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
/*
 * Navigation line module
 * Mazvv 14-05-2007
*/
class Navline_module{
	private $ciObject;
	private $objectsArr = array();
	private $navArray = array();
	
	public function __construct(){
		$this->ciObject = &get_instance();
		$this->ciObject->lang->load('navline_module');
	}

	public function RenderNavigationLine(){
		return $this->ciObject->load->view('modules/navline_module/navline.php',$this->objectsArr, True);
	}
}
?>