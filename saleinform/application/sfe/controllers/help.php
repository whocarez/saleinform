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
	
	public function index(){		redirect('help/about');		$meta = $this->constant_model->getMeta();		$this->objectsArr['title'] = $meta->meta_title;		$this->objectsArr['meta'] = array(array('name' => 'Content-type', 'content' => 'text/html; charset=utf-8', 'type' => 'equiv'),        									array('name' => 'robots', 'content' => 'no-cache'),        									array('name' => 'description', 'content' => $meta->meta_description),        									array('name' => 'keywords', 'content' => $meta->meta_keywords),        									array('name' => 'robots', 'content' => 'no-cache'));		$this->load->view('layouts/help', $this->objectsArr);
	}
	public function about(){		$meta = $this->constant_model->getMeta();		$this->objectsArr['title'] = $meta->meta_title;		$this->objectsArr['meta'] = array(array('name' => 'Content-type', 'content' => 'text/html; charset=utf-8', 'type' => 'equiv'),        									array('name' => 'robots', 'content' => 'no-cache'),        									array('name' => 'description', 'content' => $meta->meta_description),        									array('name' => 'keywords', 'content' => $meta->meta_keywords),        									array('name' => 'robots', 'content' => 'no-cache'));		$this->objectsArr['help_obj'] = $this->load->view('modules/help_module/about', $this->objectsArr, True);        											$this->load->view('layouts/help', $this->objectsArr);	}	
	public function adv(){		$meta = $this->constant_model->getMeta();		$this->objectsArr['title'] = $meta->meta_title;		$this->objectsArr['meta'] = array(array('name' => 'Content-type', 'content' => 'text/html; charset=utf-8', 'type' => 'equiv'),        									array('name' => 'robots', 'content' => 'no-cache'),        									array('name' => 'description', 'content' => $meta->meta_description),        									array('name' => 'keywords', 'content' => $meta->meta_keywords),        									array('name' => 'robots', 'content' => 'no-cache'));		$this->objectsArr['help_obj'] = $this->load->view('modules/help_module/adv', $this->objectsArr, True);         											$this->load->view('layouts/help', $this->objectsArr);
	}
	
}
?>