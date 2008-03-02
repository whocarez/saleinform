<?php
/*
 * The Categories
*/
class Categories extends Controller 
{
	private $objectsArr = array();
	
	public function __construct()
	{
		parent::Controller();
		$this->output->enable_profiler(False);
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
		$this->load->library('navline_module');
		$this->load->library('relatedcats_module');
		$this->load->library('quickmenu_module');
		$this->load->library('filters_module');
		$this->load->library('contacts_module');
		$this->load->library('keywords_module');
		/* generate objects */
		#$this->benchmark->mark('p1_start');
		$this->objectsArr['search_bar_obj'] = $this->search_module->RenderSearchBar();
		#$this->benchmark->mark('p1_end');
		#$this->benchmark->mark('p2_start');
		$this->objectsArr['login_area_obj'] = $this->accounts_module->RenderLoginArea();
		#$this->benchmark->mark('p2_end');
		#$this->benchmark->mark('p3_start');
		$this->objectsArr['settings_area_obj'] = $this->settings_module->RenderSettingsArea();
		#$this->benchmark->mark('p3_end');
		#$this->benchmark->mark('p4_start');
		$this->objectsArr['mostpopular_area_obj'] = $this->mostpopular_module->RenderMostpopularTabbedArea();
		#$this->benchmark->mark('p4_end');
		#$this->benchmark->mark('p5_start');
		$this->objectsArr['mostpopular_searches_obj'] = $this->mostpopular_module->RenderMostpopularSearchesArea();
		#$this->benchmark->mark('p5_end');
		#$this->benchmark->mark('p6_start');
		$this->objectsArr['rating_recomend_obj'] = $this->rating_module->RenderRatingRecomendArea();
		#$this->benchmark->mark('p6_end');
		#$this->benchmark->mark('p7_start');
		$this->objectsArr['rating_products_obj'] = $this->rating_module->RenderRatingProductsArea();
		#$this->benchmark->mark('p7_end');
		#$this->benchmark->mark('p8_start');	
		$this->objectsArr['advertise_center_obj'] = $this->advertise_module->RenderCenterLinksAdvertiseArea();
		#$this->benchmark->mark('p8_end');
		#$this->benchmark->mark('p9_start');
		$this->objectsArr['advertise_right_obj'] = $this->advertise_module->RenderRightLinksAdvertiseArea();
		#$this->benchmark->mark('p9_end');
		#$this->benchmark->mark('p10_start');
		$this->objectsArr['googleads_right_obj'] = $this->advertise_module->RenderGoogleAds_234x60_Area();
		#$this->benchmark->mark('p10_end');
		#$this->benchmark->mark('p11_start');
		$this->objectsArr['googleads_left_obj'] = $this->advertise_module->RenderGoogleAds_120x90_Area();
		#$this->benchmark->mark('p11_end');
		#$this->benchmark->mark('p12_start');
		$this->objectsArr['linkchanges_area_obj'] = $this->linkchanges_module->RenderLinkchangesArea();
		#$this->benchmark->mark('p12_end');
		#$this->benchmark->mark('p13_start');
		$this->objectsArr['relatedcats_area_obj'] = $this->relatedcats_module->RenderRelatedCatsArea();
		#$this->benchmark->mark('p14_end');
		#$this->benchmark->mark('p15_start');
		$this->objectsArr['quickmenu_area_obj'] = $this->quickmenu_module->RenderQuickmenuArea();
		#$this->benchmark->mark('p15_end');
		#$this->benchmark->mark('p16_start');
		$this->objectsArr['footermenu_area_obj'] = $this->quickmenu_module->RenderFootermenuArea();
		#$this->benchmark->mark('p16_end');
		#$this->benchmark->mark('p17_start');
		$this->objectsArr['contactstoolbar_area_obj'] = $this->contacts_module->RenderContactsToolbar();
		#$this->benchmark->mark('p17_end');
		#$this->benchmark->mark('p18_start');
		$this->objectsArr['metatitle_area_obj'] = $this->keywords_module->RenderMetatitleArea();
		#$this->benchmark->mark('p18_end');
		#$this->benchmark->mark('p19_start');
		$this->objectsArr['metadescription_area_obj'] = $this->keywords_module->RenderMetadescriptionArea();
		#$this->benchmark->mark('p19_end');
		
	}
	
	public function index()
	{
		$this->ShowByAlphabetical();
	}
	
	public function _remap($methodNAME)
	{
		if($methodNAME=='sa')
		{
			$this->ShowByAlphabetical();	
		}
		else if($methodNAME=='st')
		{
			$this->ShowByTree();	
		}
		else if($methodNAME=='c' && $catRID = $this->uri->segment(3))
		{
			$this->ShowCategory();
		}
		else if($methodNAME=='ss' && $catRID = $this->uri->segment(3))
		{
			$this->GetSearch();	
		}
		else $this->index();
	}
	
	public function ShowByAlphabetical()
	{
		$this->objectsArr['categories_area_obj'] = $this->categories_module->RenderCategoriesList();
		$this->objectsArr['keywords_area_obj'] = $this->keywords_module->RenderKeywordsArea($this->objectsArr['categories_area_obj']);
		$this->load->view('layouts/categories.php', $this->objectsArr);
	}
	
	public function ShowByTree()
	{
		$this->objectsArr['categories_area_obj'] = $this->categories_module->RenderCategoriesList('T');
		$this->objectsArr['keywords_area_obj'] = $this->keywords_module->RenderKeywordsArea($this->objectsArr['categories_area_obj']);
		$this->load->view('layouts/categories.php', $this->objectsArr);
	}
	
	public function ShowCategory()
	{
		#$this->benchmark->mark('p20_start');
		$this->objectsArr['categories_area_obj'] = $this->categories_module->RenderCategoryContent();
		#$this->benchmark->mark('p20_end');
		#$this->benchmark->mark('p21_start');
		$this->objectsArr['navline_area_obj'] = $this->navline_module->RenderNavigationLine();
		#$this->benchmark->mark('p21_end');
		#$this->benchmark->mark('p22_start');
		$this->objectsArr['filters_area_obj'] = $this->filters_module->RenderCategoryFilters();
		#$this->benchmark->mark('p22_end');
		#$this->benchmark->mark('p23_start');
		$this->objectsArr['keywords_area_obj'] = $this->keywords_module->RenderKeywordsArea($this->objectsArr['categories_area_obj']);
		#$this->benchmark->mark('p23_end');
		$this->load->view('layouts/category.php', $this->objectsArr);
	}
	
	public function GetSearch()
	{
		$this->objectsArr['categories_area_obj'] = $this->categories_module->GetSearchResult();
		$this->objectsArr['navline_area_obj'] = $this->navline_module->RenderNavigationLine();
		$this->objectsArr['filters_area_obj'] = $this->filters_module->RenderCategoryFilters();
		$this->objectsArr['keywords_area_obj'] = $this->keywords_module->RenderKeywordsArea($this->objectsArr['categories_area_obj']);		
		$this->load->view('layouts/category.php', $this->objectsArr);
	}
}
?>