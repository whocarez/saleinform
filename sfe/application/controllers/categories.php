<?php/* * The Categories*/
class Categories extends Controller{	private $objectsArr = array();
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
		$this->load->library('search_module');		$this->load->library('categories_module');		$this->load->library('mostpopular_module');		$this->load->library('advertise_module');		$this->load->library('navline_module');		$this->load->library('relatedcats_module');		$this->load->library('quickmenu_module');		$this->load->library('contacts_module');
		/* generate objects */		$this->objectsArr['search_bar_obj'] = $this->search_module->RenderSearchBar();		$this->objectsArr['advertise_center_obj'] = $this->advertise_module->RenderCenterLinksAdvertiseArea();		$this->objectsArr['advertise_right_obj'] = $this->advertise_module->RenderRightLinksAdvertiseArea();		$this->objectsArr['googleads_right_obj'] = $this->advertise_module->RenderGoogleAds_234x60_Area();		$this->objectsArr['googleads_left_obj'] = $this->advertise_module->RenderGoogleAds_120x90_Area();		$this->objectsArr['footermenu_area_obj'] = $this->quickmenu_module->RenderFootermenuArea();		$this->objectsArr['contactstoolbar_area_obj'] = $this->contacts_module->RenderContactsToolbar();	}
	public function index(){		$meta = $this->constant_model->getMeta();		$this->objectsArr['title'] = $meta->meta_title;		$this->objectsArr['meta'] = array(array('name' => 'Content-type', 'content' => 'text/html; charset=utf-8', 'type' => 'equiv'),        									array('name' => 'robots', 'content' => 'no-cache'),        									array('name' => 'description', 'content' => $meta->meta_description),        									array('name' => 'keywords', 'content' => $meta->meta_keywords),        									array('name' => 'robots', 'content' => 'no-cache'));				$this->objectsArr['settings_area_obj'] = $this->settings_module->RenderSettingsArea();		$this->objectsArr['mostpopular_searches_obj'] = $this->mostpopular_module->RenderMostpopularSearchesArea();		$this->objectsArr['categories_area_obj'] = $this->categories_module->RenderCategoriesList();		$this->load->view('layouts/categories.php', $this->objectsArr);	}		public function tree(){		$meta = $this->constant_model->getMeta();		$this->objectsArr['title'] = $meta->meta_title;		$this->objectsArr['meta'] = array(array('name' => 'Content-type', 'content' => 'text/html; charset=utf-8', 'type' => 'equiv'),        									array('name' => 'robots', 'content' => 'no-cache'),        									array('name' => 'description', 'content' => $meta->meta_description),        									array('name' => 'keywords', 'content' => $meta->meta_keywords),        									array('name' => 'robots', 'content' => 'no-cache'));		$this->objectsArr['settings_area_obj'] = $this->settings_module->RenderSettingsArea();		$this->objectsArr['mostpopular_searches_obj'] = $this->mostpopular_module->RenderMostpopularSearchesArea();		$this->objectsArr['categories_area_obj'] = $this->categories_module->RenderCategoriesTree();		$this->load->view('layouts/categories.php', $this->objectsArr);	}		public function category($slug=null){		$this->objectsArr['settings_area_obj'] = $this->settings_module->RenderSettingsArea();		$this->objectsArr['mostpopular_searches_obj'] = $this->mostpopular_module->RenderMostpopularSearchesArea();		$this->objectsArr['relatedcats_area_obj'] = $this->relatedcats_module->RenderRelatedCatsArea();		if(!$slug) redirect('categories', 'refresh');		$this->objectsArr['categories_area_obj'] = $this->categories_module->RenderCategoryContent($slug);		$this->objectsArr['navline_area_obj'] = $this->navline_module->RenderNavigationLine();		#$this->objectsArr['filters_area_obj'] = $this->filters_module->RenderCategoryFilters();		/* { SEO */		$categoryInfo = $this->categories_model->getCategoryInfo($this->categories_module->getCridFromSlug($slug));		$meta = $this->constant_model->getMeta('CATEGORY');		$this->objectsArr['title'] = sprintf($meta->meta_title, $categoryInfo->name, $categoryInfo->name);		$this->objectsArr['meta'] = array(array('name' => 'Content-type', 'content' => 'text/html; charset=utf-8', 'type' => 'equiv'),        									array('name' => 'robots', 'content' => 'no-cache'),        									array('name' => 'description', 'content' => sprintf($meta->meta_description, $categoryInfo->name, $categoryInfo->name, $categoryInfo->name, $categoryInfo->name)),        									array('name' => 'keywords', 'content' => sprintf($meta->meta_keywords, $categoryInfo->name, $categoryInfo->name, $categoryInfo->name, $categoryInfo->name)),        									array('name' => 'robots', 'content' => 'no-cache'));        											/* } SEO */		$this->load->view('layouts/category.php', $this->objectsArr);	}		public function search(){		if(!$this->input->post('searchString')) show_404();		$this->objectsArr['categories_area_obj'] = $this->categories_module->searchProcessing();		$this->objectsArr['settings_area_obj'] = $this->settings_module->RenderSettingsArea();		$this->objectsArr['mostpopular_searches_obj'] = $this->mostpopular_module->RenderMostpopularSearchesArea();		$meta = $this->constant_model->getMeta();		$this->objectsArr['title'] = $meta->meta_title;		$this->objectsArr['meta'] = array(array('name' => 'Content-type', 'content' => 'text/html; charset=utf-8', 'type' => 'equiv'),        									array('name' => 'robots', 'content' => 'no-cache'),        									array('name' => 'description', 'content' => $meta->meta_description),        									array('name' => 'keywords', 'content' => $meta->meta_keywords),        									array('name' => 'robots', 'content' => 'no-cache'));				$this->load->view('layouts/category.php', $this->objectsArr);	}		public function cloudsearch($sString=null){		if(!$sString) show_404();		$this->objectsArr['categories_area_obj'] = $this->categories_module->searchCloud($sString);		$this->objectsArr['settings_area_obj'] = $this->settings_module->RenderSettingsArea();		$this->objectsArr['mostpopular_searches_obj'] = $this->mostpopular_module->RenderMostpopularSearchesArea();		$meta = $this->constant_model->getMeta();		$this->objectsArr['title'] = $meta->meta_title;		$this->objectsArr['meta'] = array(array('name' => 'Content-type', 'content' => 'text/html; charset=utf-8', 'type' => 'equiv'),        									array('name' => 'robots', 'content' => 'no-cache'),        									array('name' => 'description', 'content' => $meta->meta_description),        									array('name' => 'keywords', 'content' => $meta->meta_keywords),        									array('name' => 'robots', 'content' => 'no-cache'));				$this->load->view('layouts/category.php', $this->objectsArr);	}	}
?>