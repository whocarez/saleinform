<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
/*
 * Search module
 * Mazvv 30-04-2007
*/
class Search_module{
	private $ciObject; # code igniter instance
	private $objectsArr = array(); # object's array
	/* { Module settings */
	/* } Module settings */
	
	public function __construct(){
		$this->ciObject = &get_instance();
		$this->ciObject->lang->load('search_module');
	}
	
	public function renderSearchBar(){
		return $this->ciObject->load->view('modules/search_module/searchbar.php',$this->objectsArr, True);
	}
	
	public function renderNarrowBar(){
		return $this->ciObject->load->view('modules/search_module/narrowbar.php', null, True);
	}
}
?>