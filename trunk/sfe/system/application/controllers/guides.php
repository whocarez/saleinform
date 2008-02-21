<?php
/*
 * The Guides
*/
class Guides extends Controller 
{
	private $objectsArr = array();
	
	public function __construct()
	{
		parent::Controller();
		#$this->output->enable_profiler(TRUE);
		/* load needed libraries */
		$this->load->library('lang_module');
		$this->load->library('settings_module');
		$this->load->library('search_module');
		$this->load->library('categories_module');
		$this->load->library('accounts_module');
		$this->load->library('mostpopular_module');
		$this->load->library('rating_module');
		$this->load->library('advertise_module');
		$this->load->library('navline_module');
		$this->load->library('linkchanges_module');
		$this->load->library('quickmenu_module');
		$this->load->library('guides_module');
		$this->load->library('contacts_module');
		$this->load->library('keywords_module');
		/* generate objects */
		$this->objectsArr['search_bar_obj'] = $this->search_module->RenderSearchBar();
		$this->objectsArr['categories_table_obj'] = $this->categories_module->RenderCategoriesTable();
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
		$this->objectsArr['navline_area_obj'] = $this->navline_module->RenderNavigationLine();
		$this->objectsArr['contactstoolbar_area_obj'] = $this->contacts_module->RenderContactsToolbar();
		$this->objectsArr['metatitle_area_obj'] = $this->keywords_module->RenderMetatitleArea();
		$this->objectsArr['metadescription_area_obj'] = $this->keywords_module->RenderMetadescriptionArea();
	}
	
	public function index()
	{
		$this->ShowListGuides();
	}
	
	public function _remap($methodNAME)
	{
		if($methodNAME=='c')
		{
			if($this->uri->segment(3))$this->ShowCatGuide();
			else $this->ShowListGuides();	
		}
		else $this->index();
	}
	
	public function ShowListGuides()
	{
		$this->objectsArr['guides_area_obj'] = $this->guides_module->RenderGuidesListArea();
		$this->objectsArr['keywords_area_obj'] = $this->keywords_module->RenderKeywordsArea($this->objectsArr['guides_area_obj']);		
		$this->load->view('layouts/guides.php', $this->objectsArr);
	}
	
	public function ShowCatGuide()
	{
		$this->objectsArr['guides_area_obj'] = $this->guides_module->RenderCatGuideArea();
		$this->objectsArr['keywords_area_obj'] = $this->keywords_module->RenderKeywordsArea($this->objectsArr['guides_area_obj']);		
		$this->load->view('layouts/guides.php', $this->objectsArr);
	}
	
}
?>