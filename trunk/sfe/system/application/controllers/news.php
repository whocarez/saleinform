<?php
/*
 * The News
*/
class News extends Controller 
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
		$this->load->library('categories_module');
		$this->load->library('rating_module');
		$this->load->library('advertise_module');
		$this->load->library('linkchanges_module');
		$this->load->library('navline_module');
		$this->load->library('news_module');
		$this->load->library('last_module');
		$this->load->library('quickmenu_module');
		$this->load->library('contacts_module');
		$this->load->library('keywords_module');
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
		$this->objectsArr['categories_table_obj'] = $this->categories_module->RenderCategoriesTable();
		$this->objectsArr['last_area_obj'] = $this->last_module->RenderLastArea();
		$this->objectsArr['quickmenu_area_obj'] = $this->quickmenu_module->RenderQuickmenuArea();
		$this->objectsArr['footermenu_area_obj'] = $this->quickmenu_module->RenderFootermenuArea();
		$this->objectsArr['contactstoolbar_area_obj'] = $this->contacts_module->RenderContactsToolbar();
		$this->objectsArr['metatitle_area_obj'] = $this->keywords_module->RenderMetatitleArea();
		$this->objectsArr['metadescription_area_obj'] = $this->keywords_module->RenderMetadescriptionArea();
	}
	
	public function index()
	{
		$this->ShowNewsList();
	}
	
	public function _remap($methodNAME)
	{
		if($methodNAME=='n')
		{
			if($this->uri->segment(3)) $this->ShowNew();
			else $this->ShowNewsList();	
		}
		else if($methodNAME=='c')
		{
			$this->ShowNewsList();	
		}
		else if($methodNAME=='p')
		{
			$this->ShowNewsList();	
		}
		else $this->index();
	}
	
	public function ShowNew()
	{
		$this->objectsArr['news_area_obj']=$this->news_module->RenderNewArea();
		$this->objectsArr['navline_area_obj'] = $this->navline_module->RenderNavigationLine();
		$this->objectsArr['keywords_area_obj'] = $this->keywords_module->RenderKeywordsArea($this->objectsArr['news_area_obj']);
		$this->load->view('layouts/news.php', $this->objectsArr);			
	}
	
	public function ShowNewsList()
	{
		$this->benchmark->mark('ncats_start');
		$this->objectsArr['news_area_obj']=$this->news_module->RenderNewsListArea();
		$this->objectsArr['navline_area_obj'] = $this->navline_module->RenderNavigationLine();
		$this->benchmark->mark('ncats_end');
		$this->objectsArr['keywords_area_obj'] = $this->keywords_module->RenderKeywordsArea($this->objectsArr['news_area_obj']);
		$this->load->view('layouts/news.php', $this->objectsArr);
		
	}
	
}
?>