<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
/*
 * Search module
 * Mazvv 30-04-2007
*/
class Search_module{
	private $ciObject; # code igniter instance
	private $objectsArr = array(); # object's array
	
	public function __construct(){
		$this->ciObject = &get_instance();
		$this->ciObject->lang->load('search_module');
	}
	
	public function RenderSearchBar(){
		$data = array();
		$this->ciObject->load->library('accounts_module');
		$data['is_logged'] = $this->ciObject->accounts_module->isLogged();
		return $this->ciObject->load->view('modules/search_module/searchbar.php',$data, True);
	}
}
?>