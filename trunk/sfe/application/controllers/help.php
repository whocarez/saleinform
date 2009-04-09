<?php
/*
 * The Help
*/
class Help extends Controller{
	private $objectsArr = array();
	
	public function __construct(){
		parent::Controller();
		$this->load->library('search_module');
		$this->load->library('quickmenu_module');
		$this->load->library('help_module');
		$this->load->library('contacts_module');
		/* generate objects */
		$this->objectsArr['search_bar_obj'] = $this->search_module->RenderSearchBar();
		$this->objectsArr['footermenu_area_obj'] = $this->quickmenu_module->RenderFootermenuArea();
		$this->objectsArr['contactstoolbar_area_obj'] = $this->contacts_module->RenderContactsToolbar();
	}
	
	public function index(){
	}

	public function adv(){
	}
	
}
?>