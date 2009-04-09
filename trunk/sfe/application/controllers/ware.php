<?php
/*
 * The Ware
*/
class Ware extends Controller{
	private $objectsArr = array();
	
	public function __construct(){
		parent::Controller();
		// { Enable profiler for admin only
		$currentSESS = $this->session->userdata('_SI_');
		if(isset($currentSESS['SI_LOGIN']['_USER_LOGIN_']) && $currentSESS['SI_LOGIN']['_USER_LOGIN_'] == 'mazvv'){
			$this->output->enable_profiler(True);		
		}
		else $this->output->enable_profiler(False);
		// } Enable profiler for admin only
		/* load needed libraries */	
		$this->load->library('search_module');
		$this->load->library('ware_module');
		$this->load->library('advertise_module');
		$this->load->library('navline_module');
		$this->load->library('quickmenu_module');
		$this->load->library('contacts_module');
		$this->load->library('categories_module');
		#$this->load->library('likeness_module');
		/* generate objects */
		$this->objectsArr['search_bar_obj'] = $this->search_module->RenderSearchBar();
		$this->objectsArr['advertise_center_obj'] = $this->advertise_module->RenderCenterLinksAdvertiseArea();
		$this->objectsArr['advertise_right_obj'] = $this->advertise_module->RenderRightLinksAdvertiseArea();
		$this->objectsArr['googleads_right_obj'] = $this->advertise_module->RenderGoogleAds_234x60_Area();
		$this->objectsArr['googleads_left_obj'] = $this->advertise_module->RenderGoogleAds_120x90_Area();
		$this->objectsArr['quickmenu_area_obj'] = $this->quickmenu_module->RenderQuickmenuArea();
		$this->objectsArr['footermenu_area_obj'] = $this->quickmenu_module->RenderFootermenuArea();
		$this->objectsArr['contactstoolbar_area_obj'] = $this->contacts_module->RenderContactsToolbar();
		#$this->objectsArr['likeness_area_obj'] = $this->likeness_module->RenderLikenessListArea();
	}
	
	public function index(){
		$this->objectsArr['categories_area_obj'] = $this->categories_module->RenderCategoriesList();
		$this->load->view('layouts/categories.php', $this->objectsArr);
	}
	
	public function offer($slug = null, $offset = null){
		if(!$slug) show_404();
		$this->objectsArr['ware_area_obj']=$this->ware_module->RenderWareInfo($slug, $offset);
		$meta = $this->constant_model->getMeta();
		$this->load->view('layouts/ware/ware.php', $this->objectsArr);
	}
	
	public function editreview($wSlug){
		$this->objectsArr['ware_info_obj'] = $this->ware_module->reviewProcessing($wSlug);
		$meta = $this->constant_model->getMeta();
		$this->load->view('layouts/ware/editreview', $this->objectsArr);
	}
	
	public function reviewrate(){
		$this->output->enable_profiler(False);
		$this->output->set_output($this->ware_module->rateReview());	
	}
}
?>