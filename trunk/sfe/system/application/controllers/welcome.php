<?php
/**
 * Welcome class - welcome controller
 * The first controller of saleinform  which loads by default
 * 
 * @access public
 * @author Mazvv
 * @package controllers
 * @copyright Copyright 2007 (c)
 */
class Welcome extends Controller 
{
	private $objectsArr = array();
	
	/**
	 * Welcome::__construct. Initialize welcome controller
	 * 
	 * @access public
	 * @author MAzvv
	 * @param void
	 * @return void 
	 */
	function __construct()
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
		$this->load->library('categories_module');
		$this->load->library('accounts_module');
		$this->load->library('mostpopular_module');
		$this->load->library('rating_module');
		$this->load->library('advertise_module');
		$this->load->library('linkchanges_module');
		$this->load->library('last_module');
		$this->load->library('quickmenu_module');
		$this->load->library('info_module');
		$this->load->library('contacts_module');
		$this->load->library('keywords_module');
		$this->load->library('siclub_module');
		/* generate objects */
		$this->benchmark->mark('search_bar_start');
		$this->objectsArr['search_bar_obj'] = $this->search_module->RenderSearchBar();
		$this->benchmark->mark('search_bar_end');
		
		$this->benchmark->mark('categories_table_start');
		$this->objectsArr['categories_table_obj'] = $this->categories_module->RenderCategoriesTable();
		$this->benchmark->mark('categories_table_end');
		
		$this->benchmark->mark('login_area_start');
		$this->objectsArr['login_area_obj'] = $this->accounts_module->RenderLoginArea();
		$this->benchmark->mark('login_area_end');
		
		$this->benchmark->mark('settings_area_start');
		$this->objectsArr['settings_area_obj'] = $this->settings_module->RenderSettingsArea();
		$this->benchmark->mark('settings_area_end');
		
		
		$this->objectsArr['mostpopular_area_obj'] = $this->mostpopular_module->RenderMostpopularTabbedArea();
		
		$this->benchmark->mark('mostpopular_searches_start');
		$this->objectsArr['mostpopular_searches_obj'] = $this->mostpopular_module->RenderMostpopularSearchesArea();
		$this->benchmark->mark('mostpopular_searches_end');
		
		$this->benchmark->mark('mostpopular_categories_carousel_start');
		$this->objectsArr['mostpopular_categories_carousel_obj'] = $this->mostpopular_module->RenderMostpopularCategoriesCarousel();
		$this->benchmark->mark('mostpopular_categories_carousel_end');
		
		$this->benchmark->mark('rating_recomend_start');
		$this->objectsArr['rating_recomend_obj'] = $this->rating_module->RenderRatingRecomendArea();
		$this->benchmark->mark('rating_recomend_end');
		
		$this->benchmark->mark('advertise_center_start');
		$this->objectsArr['advertise_center_obj'] = $this->advertise_module->RenderCenterLinksAdvertiseArea();
		$this->benchmark->mark('advertise_center_end');
		
		$this->benchmark->mark('advertise_right_start');
		$this->objectsArr['advertise_right_obj'] = $this->advertise_module->RenderRightLinksAdvertiseArea();
		$this->benchmark->mark('advertise_right_end');
		
		$this->benchmark->mark('googleads_right_start');
		$this->objectsArr['googleads_right_obj'] = $this->advertise_module->RenderGoogleAds_234x60_Area();
		$this->benchmark->mark('googleads_right_end');
		
		$this->benchmark->mark('googleads_left_start');
		$this->objectsArr['googleads_left_obj'] = $this->advertise_module->RenderGoogleAds_120x90_Area();
		$this->benchmark->mark('googleads_left_end');
		
		$this->benchmark->mark('linkchanges_area_start');
		$this->objectsArr['linkchanges_area_obj'] = $this->linkchanges_module->RenderLinkchangesArea();
		$this->benchmark->mark('linkchanges_area_end');
		
		$this->benchmark->mark('last_area_start');
		$this->objectsArr['last_area_obj'] = $this->last_module->RenderLastArea();
		$this->benchmark->mark('last_area_end');
		
		$this->benchmark->mark('quickmenu_area_start');
		$this->objectsArr['quickmenu_area_obj'] = $this->quickmenu_module->RenderQuickmenuArea();
		$this->benchmark->mark('quickmenu_area_end');
		
		$this->benchmark->mark('footermenu_area_start');
		$this->objectsArr['footermenu_area_obj'] = $this->quickmenu_module->RenderFootermenuArea();
		$this->benchmark->mark('footermenu_area_end');
		
		$this->benchmark->mark('whatisit_area_start');
		$this->objectsArr['whatisit_area_obj'] = $this->info_module->RenderWhatIsItArea();
		$this->benchmark->mark('whatisit_area_end');
		
		$this->benchmark->mark('howitworks_area_start');
		$this->objectsArr['howitworks_area_obj'] = $this->info_module->RenderHowItWorksArea();
		$this->benchmark->mark('howitworks_area_end');
		
		$this->benchmark->mark('contactstoolbar_area_start');
		$this->objectsArr['contactstoolbar_area_obj'] = $this->contacts_module->RenderContactsToolbar();
		$this->benchmark->mark('contactstoolbar_area_end');
		
		$this->benchmark->mark('keywords_area_start');
		$this->objectsArr['keywords_area_obj'] = $this->keywords_module->RenderKeywordsArea($this->objectsArr['categories_table_obj']);
		$this->benchmark->mark('keywords_area_end');
		
		$this->benchmark->mark('metatitle_area_start');
		$this->objectsArr['metatitle_area_obj'] = $this->keywords_module->RenderMetatitleArea();
		$this->benchmark->mark('metatitle_area_end');
		
		$this->benchmark->mark('metadescription_area_start');
		$this->objectsArr['metadescription_area_obj'] = $this->keywords_module->RenderMetadescriptionArea();
		$this->benchmark->mark('metadescription_area_end');
		
		$this->benchmark->mark('siclub_loginarea_start');
		$this->objectsArr['siclub_loginarea_obj'] = $this->siclub_module->RenderSiclubLoginArea();
		$this->benchmark->mark('siclub_loginarea_end');
		
	}
	
	/**
	 * Welcome::index - default controller's method
	 * 
	 * @access public
	 * @author Mazvv
	 * @param void
	 * @return void
	 */
	function index()
	{
		$this->load->view('layouts/welcome.php', $this->objectsArr);
	}
}
?>