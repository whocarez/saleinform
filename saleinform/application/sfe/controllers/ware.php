<?php/* * The Ware*/class Ware extends Controller{	private $objectsArr = array();
	public function __construct(){		parent::Controller();		// { Enable profiler for admin only		$currentSESS = $this->session->userdata('_SI_');		if(isset($currentSESS['SI_LOGIN']['_USER_LOGIN_']) && $currentSESS['SI_LOGIN']['_USER_LOGIN_'] == 'mazvv'){			$this->output->enable_profiler(True);				}		else $this->output->enable_profiler(False);		// } Enable profiler for admin only		/* load needed libraries */			$this->load->library('search_module');		$this->load->library('ware_module');		$this->load->library('navline_module');		$this->load->library('quickmenu_module');		$this->load->library('contacts_module');		$this->load->library('categories_module');		/* generate objects */		$this->objectsArr['search_bar_obj'] = $this->search_module->RenderSearchBar();		$this->objectsArr['quickmenu_area_obj'] = $this->quickmenu_module->RenderQuickmenuArea();		$this->objectsArr['footermenu_area_obj'] = $this->quickmenu_module->RenderFootermenuArea();		$this->objectsArr['contactstoolbar_area_obj'] = $this->contacts_module->RenderContactsToolbar();		#$this->objectsArr['likeness_area_obj'] = $this->likeness_module->RenderLikenessListArea();
	}
	
	public function index(){
		$this->objectsArr['categories_area_obj'] = $this->categories_module->RenderCategoriesList();				$meta = $this->constant_model->getMeta();		$this->objectsArr['title'] = $meta->meta_title;		$this->objectsArr['meta'] = array(array('name' => 'Content-type', 'content' => 'text/html; charset=utf-8', 'type' => 'equiv'),        									array('name' => 'robots', 'content' => 'no-cache'),        									array('name' => 'description', 'content' => $meta->meta_description),        									array('name' => 'keywords', 'content' => $meta->meta_keywords),        									array('name' => 'robots', 'content' => 'no-cache'));				
		$this->load->view('layouts/categories.php', $this->objectsArr);
	}
	
	public function offer($slug = null, $offset = null){
		if(!$slug) show_404();
		$this->objectsArr['ware_area_obj']=$this->ware_module->RenderWareInfo($slug, $offset);		$offer_info = $this->ware_module->get_offer_info($slug);		#var_dump($offer_info);
		$meta = $this->constant_model->getMeta('OFFER');		$this->objectsArr['title'] = sprintf($meta->meta_title, $offer_info->name);		$this->objectsArr['meta'] = array(array('name' => 'Content-type', 'content' => 'text/html; charset=utf-8', 'type' => 'equiv'),        									array('name' => 'robots', 'content' => 'no-cache'),        									array('name' => 'description', 'content' => sprintf($meta->meta_description, $offer_info->name, $offer_info->name)),        									array('name' => 'keywords', 'content' => sprintf($meta->meta_keywords, $offer_info->name)),        									array('name' => 'robots', 'content' => 'no-cache'));				
		$this->load->view('layouts/ware/ware.php', $this->objectsArr);
	}
	
	public function editreview($wSlug){
		$this->objectsArr['ware_info_obj'] = $this->ware_module->reviewProcessing($wSlug);
		$meta = $this->constant_model->getMeta();		$this->objectsArr['title'] = $meta->meta_title;		$this->objectsArr['meta'] = array(array('name' => 'Content-type', 'content' => 'text/html; charset=utf-8', 'type' => 'equiv'),        									array('name' => 'robots', 'content' => 'no-cache'),        									array('name' => 'description', 'content' => $meta->meta_description),        									array('name' => 'keywords', 'content' => $meta->meta_keywords),        									array('name' => 'robots', 'content' => 'no-cache'));				
		$this->load->view('layouts/ware/editreview', $this->objectsArr);
	}
	
	public function reviewrate(){
		$this->output->enable_profiler(False);
		$this->output->set_output($this->ware_module->rateReview());	
	}
}
?>