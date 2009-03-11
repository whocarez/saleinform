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
		$this->output->enable_profiler(True);		
		/* load needed libraries */
		$this->load->library('navline_module');
		$this->load->library('categories_module');
		$this->load->library('search_module');
		$this->load->library('clients_module');
		$this->load->library('keywords_module');
		/* generate objects */
		$this->objectsArr['nav_top_obj'] = $this->navline_module->RenderTopMenu();
		$this->objectsArr['topmenu_obj'] = $this->categories_module->renderTabbedMenu();
		$this->objectsArr['search_bar_obj'] = $this->search_module->renderNarrowBar();
		$this->objectsArr['footer_area_obj'] = $this->navline_module->RenderFooterMenu();
		$this->objectsArr['metatitle_area_obj'] = $this->keywords_module->RenderMetatitleArea();
		$this->objectsArr['keywords_area_obj'] = $this->keywords_module->RenderKeywordsArea('');
		$this->objectsArr['metadescription_area_obj'] = $this->keywords_module->RenderMetadescriptionArea();
	}
	
	public function index(){
		$this->objectsArr['categories_area_obj'] = $this->categories_module->RenderCategoriesList();
		$this->load->view('layouts/categories/categories.php', $this->objectsArr);
	}
	
	public function categoriestree(){
		$this->objectsArr['categories_area_obj'] = $this->categories_module->RenderCategoriesTree();
		$this->load->view('layouts/categories/categories.php', $this->objectsArr);
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
		$this->benchmark->mark('p20_start');
		$this->objectsArr['categories_area_obj'] = $this->categories_module->RenderCategoryContent();
		$this->benchmark->mark('p20_end');
		$this->benchmark->mark('p21_start');
		$this->objectsArr['navline_area_obj'] = $this->navline_module->RenderNavigationLine();
		$this->benchmark->mark('p21_end');
		$this->benchmark->mark('p22_start');
		$this->objectsArr['filters_area_obj'] = $this->filters_module->RenderCategoryFilters();
		$this->benchmark->mark('p22_end');
		$this->benchmark->mark('p23_start');
		$this->objectsArr['keywords_area_obj'] = $this->keywords_module->RenderKeywordsArea($this->objectsArr['categories_area_obj']);
		$this->benchmark->mark('p23_end');
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