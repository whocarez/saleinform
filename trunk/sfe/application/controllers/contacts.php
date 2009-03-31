<?php
/*
 * The Contacts
*/
class Contacts extends Controller{
	private $objectsArr = array();
	
	public function __construct(){
		parent::Controller();
		#$this->output->enable_profiler(TRUE);
		/* load needed libraries */
		$this->load->library('search_module');
		$this->load->library('quickmenu_module');
		$this->load->library('contacts_module');
		$this->load->library('keywords_module');
		/* generate objects */
		$this->objectsArr['search_bar_obj'] = $this->search_module->RenderSearchBar();
		$this->objectsArr['quickmenu_area_obj'] = $this->quickmenu_module->RenderQuickmenuArea();
		$this->objectsArr['footermenu_area_obj'] = $this->quickmenu_module->RenderFootermenuArea();
		$this->objectsArr['metatitle_area_obj'] = $this->keywords_module->RenderMetatitleArea();
		$this->objectsArr['metadescription_area_obj'] = $this->keywords_module->RenderMetadescriptionArea();
	}
	
	public function index()
	{
		$this->ShowContactsArea();
	}
	
	public function _remap($methodNAME)
	{
		if($methodNAME=='er')
		{
			$this->ShowWriteErrorArea();	
		}
		else if($methodNAME=='sf')
		{
			$this->ShowWriteToFriendArea();	
		}
		else $this->index();
	}
	
	public function ShowWriteErrorArea()
	{
		$this->objectsArr['contacts_area_obj'] = $this->contacts_module->RenderWriteErrorArea();
		$this->objectsArr['keywords_area_obj'] = $this->keywords_module->RenderKeywordsArea($this->objectsArr['contacts_area_obj']);
		$this->load->view('layouts/contacts.php', $this->objectsArr);
	}
	
	public function ShowWriteToFriendArea()
	{
		$this->objectsArr['contacts_area_obj'] = $this->contacts_module->RenderWriteToFriendArea();
		$this->objectsArr['keywords_area_obj'] = $this->keywords_module->RenderKeywordsArea($this->objectsArr['contacts_area_obj']);
		$this->load->view('layouts/contacts.php', $this->objectsArr);
	}

	public function ShowContactsArea()
	{
		$this->objectsArr['contacts_area_obj'] = $this->contacts_module->RenderContactsArea();
		$this->objectsArr['keywords_area_obj'] = $this->keywords_module->RenderKeywordsArea($this->objectsArr['contacts_area_obj']);
		$this->load->view('layouts/contacts.php', $this->objectsArr);
	}
	
}
?>