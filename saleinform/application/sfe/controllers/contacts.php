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
		/* generate objects */
		$this->objectsArr['search_bar_obj'] = $this->search_module->RenderSearchBar();
		$this->objectsArr['quickmenu_area_obj'] = $this->quickmenu_module->RenderQuickmenuArea();
		$this->objectsArr['footermenu_area_obj'] = $this->quickmenu_module->RenderFootermenuArea();
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
		$this->objectsArr['contacts_area_obj'] = $this->contacts_module->RenderWriteErrorArea();				$meta = $this->constant_model->getMeta();
		$this->objectsArr['title'] = $meta->meta_title;		$this->objectsArr['meta'] = array(array('name' => 'Content-type', 'content' => 'text/html; charset=utf-8', 'type' => 'equiv'),        									array('name' => 'robots', 'content' => 'no-cache'),        									array('name' => 'description', 'content' => $meta->meta_description),        									array('name' => 'keywords', 'content' => $meta->meta_keywords),        									array('name' => 'robots', 'content' => 'no-cache'));		
		$this->load->view('layouts/contacts.php', $this->objectsArr);
	}
	
	public function ShowWriteToFriendArea()
	{
		$this->objectsArr['contacts_area_obj'] = $this->contacts_module->RenderWriteToFriendArea();
		$meta = $this->constant_model->getMeta();		$this->objectsArr['title'] = $meta->meta_title;		$this->objectsArr['meta'] = array(array('name' => 'Content-type', 'content' => 'text/html; charset=utf-8', 'type' => 'equiv'),        									array('name' => 'robots', 'content' => 'no-cache'),        									array('name' => 'description', 'content' => $meta->meta_description),        									array('name' => 'keywords', 'content' => $meta->meta_keywords),        									array('name' => 'robots', 'content' => 'no-cache'));		
		$this->load->view('layouts/contacts.php', $this->objectsArr);
	}

	public function ShowContactsArea()
	{
		$this->objectsArr['contacts_area_obj'] = $this->contacts_module->RenderContactsArea();
		$meta = $this->constant_model->getMeta();		$this->objectsArr['title'] = $meta->meta_title;		$this->objectsArr['meta'] = array(array('name' => 'Content-type', 'content' => 'text/html; charset=utf-8', 'type' => 'equiv'),        									array('name' => 'robots', 'content' => 'no-cache'),        									array('name' => 'description', 'content' => $meta->meta_description),        									array('name' => 'keywords', 'content' => $meta->meta_keywords),        									array('name' => 'robots', 'content' => 'no-cache'));		
		$this->load->view('layouts/contacts.php', $this->objectsArr);
	}
	
}
?>