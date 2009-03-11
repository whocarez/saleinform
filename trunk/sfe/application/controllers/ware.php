<?php
/*
 * The Ware
*/
class Ware extends Controller 
{
	private $objectsArr = array();
	
	public function __construct()
	{
		parent::Controller();
		// { Enable profiler for admin only
		$currentSESS = $this->session->userdata('_SI_');
		if(isset($currentSESS['SI_LOGIN']['_USER_LOGIN_']) && $currentSESS['SI_LOGIN']['_USER_LOGIN_'] == 'admin'){
			$this->output->enable_profiler(True);		
		}
		else $this->output->enable_profiler(False);
		// } Enable profiler for admin only
		/* load needed libraries */	
		$this->load->library('lang_module');
		$this->load->library('settings_module');
		$this->load->library('search_module');
		$this->load->library('ware_module');
		$this->load->library('accounts_module');
		$this->load->library('mostpopular_module');
		$this->load->library('rating_module');
		$this->load->library('advertise_module');
		$this->load->library('linkchanges_module');
		$this->load->library('navline_module');
		$this->load->library('quickmenu_module');
		$this->load->library('contacts_module');
		$this->load->library('keywords_module');
		$this->load->library('filters_module');
		$this->load->library('categories_module');
		#$this->load->library('likeness_module');
		/* generate objects */
		$this->objectsArr['search_bar_obj'] = $this->search_module->RenderSearchBar();
		$this->objectsArr['login_area_obj'] = $this->accounts_module->RenderLoginArea();
		$this->objectsArr['settings_area_obj'] = $this->settings_module->RenderSettingsArea();
		$this->objectsArr['mostpopular_area_obj'] = $this->mostpopular_module->RenderMostpopularTabbedArea();
		$this->objectsArr['mostpopular_searches_obj'] = $this->mostpopular_module->RenderMostpopularSearchesArea();
		$this->objectsArr['rating_recomend_obj'] = $this->rating_module->RenderRatingRecomendArea();
		$this->objectsArr['rating_products_obj'] = $this->rating_module->RenderRatingProductsArea();	
		$this->objectsArr['advertise_center_obj'] = $this->advertise_module->RenderCenterLinksAdvertiseArea();
		$this->objectsArr['advertise_right_obj'] = $this->advertise_module->RenderRightLinksAdvertiseArea();
		$this->objectsArr['googleads_right_obj'] = $this->advertise_module->RenderGoogleAds_234x60_Area();
		$this->objectsArr['googleads_left_obj'] = $this->advertise_module->RenderGoogleAds_120x90_Area();
		$this->objectsArr['linkchanges_area_obj'] = $this->linkchanges_module->RenderLinkchangesArea();
		$this->objectsArr['quickmenu_area_obj'] = $this->quickmenu_module->RenderQuickmenuArea();
		$this->objectsArr['footermenu_area_obj'] = $this->quickmenu_module->RenderFootermenuArea();
		$this->objectsArr['contactstoolbar_area_obj'] = $this->contacts_module->RenderContactsToolbar();
		$this->objectsArr['metatitle_area_obj'] = $this->keywords_module->RenderMetatitleArea();
		$this->objectsArr['metadescription_area_obj'] = $this->keywords_module->RenderMetadescriptionArea();
		$this->objectsArr['filters_area_obj'] = $this->filters_module->RenderCategoryFilters();
		#$this->objectsArr['likeness_area_obj'] = $this->likeness_module->RenderLikenessListArea();
	}
	
	public function index()
	{
		$this->objectsArr['categories_area_obj'] = $this->categories_module->RenderCategoriesList();
		$this->objectsArr['keywords_area_obj'] = $this->keywords_module->RenderKeywordsArea($this->objectsArr['categories_area_obj']);	
		$this->load->view('layouts/categories.php', $this->objectsArr);
	}
	
	public function _remap($methodNAME)
	{
		if($methodNAME=='c')
		{
			$this->ShowWareInformation($this->uri->uri_to_assoc(2));	
		}
		else if($methodNAME=='cmp')
		{
			$this->ShowCompareWares();
		}
		else $this->index();
	}
	
	public function ShowWareInformation($optionsARR)
	{
		$this->objectsArr['ware_area_obj']=$this->ware_module->RenderWareInfo();
		$this->objectsArr['keywords_area_obj'] = $this->keywords_module->RenderKeywordsArea($this->objectsArr['ware_area_obj']);		
		$this->objectsArr['navline_area_obj'] = $this->navline_module->RenderNavigationLine();
		/*
		 * Create ware card
		$uriARR = $this->uri->uri_to_assoc(2);	
		if(key_exists('pdf', $uriARR) && $uriARR['pdf']=='1')
		{
     		$this->load->plugin('to_pdf');
     		pdf_create($this->objectsArr['ware_area_obj'], 'p_ver');		
		}
		*/
		$this->load->view('layouts/ware.php', $this->objectsArr);		
	}
	
	public function ShowCompareWares()
	{
		$this->objectsArr['ware_area_obj']=$this->ware_module->RenderCompareContent();
		$this->objectsArr['keywords_area_obj'] = $this->keywords_module->RenderKeywordsArea($this->objectsArr['ware_area_obj']);		
		$this->objectsArr['navline_area_obj'] = $this->navline_module->RenderNavigationLine();
		$this->load->view('layouts/ware.php', $this->objectsArr);			
	}
}
?>