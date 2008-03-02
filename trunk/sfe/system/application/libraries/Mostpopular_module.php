<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
/*
 * Mostpopular module
 * Mazvv 03-05-2007
*/
class Mostpopular_module 
{
	private $ciObject;
	private $objectsArr = array();
	private $STN_mostpopular_area_title; # title of most popular area
	private $STN_mostpopular_searches_title; # title of most popular searches 
	private $STN_mostpopular_brands_tab_title; # title of most popular brands
	private $STN_mostpopular_stores_tab_title; # title of most popular stores
	private $STN_mostpopular_categories_quan = 6; # quan of categories in carusel
	private $STN_mostpopular_icons_images_path = 'images/categories/icons/';
	private $STN_mostpopular_pictures_images_path = 'images/categories/picts/'; 
	private $STN_mostpopular_ware_images_offers_width = '100';
	private $STN_mostpopular_ware_images_offers_height = '100';	
	private $_current_mostpopular_uri_assoc;
	private $_current_mostpopular_uri_string;
	private $_current_mostpopular_city_rid;
	private $_current_mostpopular_region_rid;
	private $_current_mostpopular_country_rid;
	
	public function __construct()
	{
		$this->ciObject = &get_instance();
		$this->ciObject->lang->load('mostpopular_module');
		$this->ciObject->load->model('mostpopular_model');
		$this->_current_mostpopular_uri_assoc = $this->ciObject->uri->uri_to_assoc(2);
		$this->_current_mostpopular_uri_string = $this->ciObject->uri->assoc_to_uri($this->_current_mostpopular_uri_assoc);
		$currentSESS = $this->ciObject->session->userdata('_SI_');
		$this->_current_mostpopular_city_rid = $currentSESS['SI_SETTINGS']['_CITY_RID_'];
		$this->_current_mostpopular_region_rid = $currentSESS['SI_SETTINGS']['_REGION_RID_'];
		$this->_current_mostpopular_country_rid = $currentSESS['SI_SETTINGS']['_COUNTRY_RID_'];
		$this->STN_mostpopular_area_title = $this->ciObject->lang->line('MOSTPOPULAR_MODULE_AREA_TITLE');
		$this->STN_mostpopular_searches_title = $this->ciObject->lang->line('MOSTPOPULAR_MODULE_SEARCHES_TITLE');
		$this->STN_mostpopular_brands_tab_title = $this->ciObject->lang->line('MOSTPOPULAR_MODULE_BRANDS_TAB_TITLE');
		$this->STN_mostpopular_stores_tab_title = $this->ciObject->lang->line('MOSTPOPULAR_MODULE_STORES_TAB_TITLE');
		$this->objectsArr['mostpopular_area_title'] = $this->STN_mostpopular_area_title;
		$this->objectsArr['searches_title'] = $this->STN_mostpopular_searches_title;
		$this->objectsArr['brands_tab_title'] = $this->STN_mostpopular_brands_tab_title;
		$this->objectsArr['stores_tab_title'] = $this->STN_mostpopular_stores_tab_title;
		$this->objectsArr['brands_tab_link'] = base_url().index_page().'/'.$this->_current_mostpopular_uri_string;
		$this->objectsArr['stores_tab_link'] = base_url().index_page().'/'.$this->_current_mostpopular_uri_string;
	}
	
	public function RenderMostpopularTabbedArea($tab=null)
	{
		$parsARR = array('countriesRID'=>$this->_current_mostpopular_country_rid, 
							'regionsRID'=>$this->_current_mostpopular_region_rid, 
							'citiesRID'=>$this->_current_mostpopular_city_rid, 		
							'catRID'=>null);
		if(!$tab)
		{
			$this->ciObject->load->helper('array');
			$tab = random_element(array('stores', 'brands'));
		}
		$this->objectsArr['mostpopular_current_tab'] = $tab;
		if($this->ciObject->uri->segment(1)=='categories') 
		{
			/* Get Most rated products from current category */		
			$this->ciObject->load->model('categories_model');
			if(isset($this->_current_mostpopular_uri_assoc['c']))
			{ 
				if(!$this->ciObject->categories_model->GetCategoriesArr($this->_current_mostpopular_uri_assoc['c']))
				$parsARR['catRID'] = $this->_current_mostpopular_uri_assoc['c'];
			}
		}
		$resultARR = $this->ciObject->mostpopular_model->GetTopBrands($parsARR);
		if(!$resultARR) return '';
		$this->ciObject->load->helper('text');
		foreach($resultARR as $key=>$row) 
		{
			$resultARR[$key]['descr'] = character_limiter($row['descr'], 45);
			$resultARR[$key]['brand_link'] = anchor(base_url().index_page().'/brands/b/'.$resultARR[$key]['rid'], $resultARR[$key]['name']);
		}
		$this->objectsArr['mostpopular_brands_arr'] = $resultARR;
		$this->objectsArr['mostpopular_all_brands_link'] = anchor(base_url().index_page().'/brands', $this->ciObject->lang->line('MOSTPOPULAR_MODULE_ALL_BRANDS_TITLE'), 'class="c69"');
		$resultARR = $this->ciObject->mostpopular_model->GetTopStores($parsARR);
		if(!$resultARR) return '';
		foreach($resultARR as $key=>$row) 
		{
			$resultARR[$key]['descr'] = character_limiter($row['descr'], 45);
			$resultARR[$key]['client_link'] = anchor(base_url().index_page().'/clients/c/'.$resultARR[$key]['rid'], $resultARR[$key]['name']);
		}
		$this->objectsArr['mostpopular_clients_arr'] = $resultARR;
		$this->objectsArr['mostpopular_all_clients_link'] = anchor(base_url().index_page().'/clients', $this->ciObject->lang->line('MOSTPOPULAR_MODULE_ALL_CLIENTS_TITLE'), 'class="c69"');
		return $this->ciObject->load->view('modules/mostpopular_module/tabledarea.php',$this->objectsArr, True);
	}

	public function RenderMostpopularSearchesArea()
	{
		if($this->ciObject->uri->segment(1)=='categories' && isset($this->_current_mostpopular_uri_assoc['c']) && $this->_current_mostpopular_uri_assoc['c'])
		{
			$this->objectsArr['mostpopular_searches_arr'] = $this->ciObject->mostpopular_model->GetTopSearches($this->_current_mostpopular_uri_assoc['c']);
		}
		else
		{
			$this->objectsArr['mostpopular_searches_arr'] = $this->ciObject->mostpopular_model->GetTopSearches();
		}
		if(!$this->objectsArr['mostpopular_searches_arr']) $this->objectsArr['mostpopular_searches_arr'] = array();
		return $this->ciObject->load->view('modules/mostpopular_module/popularsearch.php',$this->objectsArr, True);
	}

	public function RenderMostpopularCategoriesCarousel()
	{
		$parsARR = array('countriesRID'=>$this->_current_mostpopular_country_rid, 
							'regionsRID'=>$this->_current_mostpopular_region_rid, 
							'citiesRID'=>$this->_current_mostpopular_city_rid, 		
							'catRID'=>null);
		$this->objectsArr['mostpopular_categories_carousel_title'] =  $this->ciObject->lang->line('MOSTPOPULAR_MODULE_CATEGORIES_TITLE');
		$resultARR = $this->ciObject->mostpopular_model->GetTopCategories($parsARR);
		if(!$resultARR) return '';
		$this->ciObject->load->plugin('tree');
		$forest = _transform2forest($resultARR, 'rid', '_categories_rid');
		$forest = array_slice($forest, 0, $this->STN_mostpopular_categories_quan);
		$chaptersLIST = array();
		foreach($forest as $row)
		{
			$row['iimage'] = $this->GetCategoryImage(array($row), 'PICTURE');
			$chaptersLIST[] = $row;
		}
		$this->objectsArr['mostpopular_categories_carousel'] = $chaptersLIST;
		return $this->ciObject->load->view('modules/mostpopular_module/categoriescarousel.php',$this->objectsArr, True);
	}

	public function GetCategoryImage($imagesROWS, $typeP = 'ICON')
	{
		# get random image
		$this->ciObject->load->helper('array');
		$image = random_element($imagesROWS);
		$imgNAME = ($typeP=='ICON')?$this->STN_mostpopular_icons_images_path.$image['irid'].'_'.$image['iname']:$this->STN_mostpopular_pictures_images_path.$image['irid'].'_'.$image['iname'];
		if(file_exists($imgNAME)) return base_url().$imgNAME;
		$ifile=fopen($imgNAME, "w");
		fwrite($ifile,$image['iimage']);
		fclose($ifile); 	
		$config = array();
		$config['image_library'] = 'GD2';
		$config['source_image'] = $imgNAME;
		$config['create_thumb'] = FALSE;
		$config['width'] = $this->STN_mostpopular_ware_images_offers_width;
		$config['height'] = $this->STN_mostpopular_ware_images_offers_height;
		$this->ciObject->load->library('image_lib');
		$this->ciObject->image_lib->clear();
		$this->ciObject->image_lib->initialize($config);
		if (!$this->ciObject->image_lib->resize())
		{
    		echo $this->ciObject->image_lib->display_errors();
		}				
		return base_url().$imgNAME;
	}
}
?>