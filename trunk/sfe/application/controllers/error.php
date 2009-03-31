<?php
/*
 * The Error
*/
class Error extends Controller{
	private $objectsArr = array();
	
	public function __construct(){
		parent::Controller();
		/* load needed libraries */	
		$this->load->library('search_module');
		$this->load->library('navline_module');
		$this->load->library('quickmenu_module');
		$this->load->library('keywords_module');
		/* generate objects */
		$this->objectsArr['search_bar_obj'] = $this->search_module->RenderSearchBar();
		$this->objectsArr['quickmenu_area_obj'] = $this->quickmenu_module->RenderQuickmenuArea();
		$this->objectsArr['footermenu_area_obj'] = $this->quickmenu_module->RenderFootermenuArea();
		$this->objectsArr['metatitle_area_obj'] = $this->keywords_module->RenderMetatitleArea();
		$this->objectsArr['metadescription_area_obj'] = $this->keywords_module->RenderMetadescriptionArea();
	}
	
	public function index(){
		$this->objectsArr['error_area_obj'] = $this->load->view('modules/error/notfound', $this->objectsArr);
		$this->load->view('layouts/error', $this->objectsArr);
	}
	
}
?>