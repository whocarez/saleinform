<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
/*
 * Brands module
 * Mazvv 02-05-2007
*/
class Brands_module 
{
	private $ciObject;
	private $objectsArr = array();
	private $_current_brands_uri_assoc;
	private $_current_brands_brand_rid;
	private $_current_brands_mode;
	private $_current_brands_nav_letter; 
	private $_current_brands_main_curr_rid;
	private $_current_brands_add_curr_rid;	
	private $_current_brands_city_rid;
	private $_current_brands_country_rid;
	private $_current_brands_region_rid;
	
	
	public function __construct()
	{
		$this->ciObject = &get_instance();
		$this->ciObject->lang->load('brands_module');
		$this->_current_brands_uri_assoc = $this->ciObject->uri->uri_to_assoc(2);
		$this->ciObject->load->model('brands_model');
		if(isset($this->_current_brands_uri_assoc['b']))
		{
			$this->_current_brands_brand_rid = $this->_current_brands_uri_assoc['b'];
			$this->_current_brands_mode = 'b';
		}
		if(isset($this->_current_brands_uri_assoc['p']))
		{
			$this->_current_brands_brand_rid = $this->_current_brands_uri_assoc['p'];
			$this->_current_brands_mode = 'p';
		}
		$currentSESS = $this->ciObject->session->userdata('_SI_');
		$this->_current_brands_city_rid = $currentSESS['SI_SETTINGS']['_CITY_RID_'];
		$this->_current_brands_region_rid = $currentSESS['SI_SETTINGS']['_REGION_RID_'];
		$this->_current_brands_country_rid = $currentSESS['SI_SETTINGS']['_COUNTRY_RID_'];
		$this->_current_brands_main_curr_rid = $currentSESS['SI_SETTINGS']['_MAIN_CURR_RID_'];
		$this->_current_brands_add_curr_rid = $currentSESS['SI_SETTINGS']['_ADD_CURR_RID_'];
		$this->_current_brands_nav_letter = (isset($this->_current_brands_uri_assoc['l']))?$this->_current_brands_uri_assoc['l']:null;
		$this->objectsArr['brands_module_brand_not_exist'] = $this->ciObject->lang->line('BRANDS_MODULE_BRAND_NOT_EXIST');
		$this->objectsArr['brands_module_brand_info_tab'] = $this->ciObject->lang->line('BRANDS_MODULE_BRAND_INFO_TAB');
		$this->objectsArr['brands_module_brand_products_tab'] = $this->ciObject->lang->line('BRANDS_MODULE_BRAND_PRODUCTS_TAB');
		$this->objectsArr['brands_module_brand_list_title'] = $this->ciObject->lang->line('BRANDS_MODULE_BRANDS_LIST_TITLE');
		$this->objectsArr['brands_module_brand_offers_title'] = $this->ciObject->lang->line('BRANDS_MODULE_BRAND_OFFERS_TITLE');
		$this->objectsArr['brands_module_brands_count_find'] = $this->ciObject->lang->line('BRANDS_MODULE_BRANDS_COUNT_FIND');		
		$this->objectsArr['brands_module_brands_allbrands_link'] = anchor(base_url().index_page().'/brands', $this->ciObject->lang->line('BRANDS_MODULE_BRANDS_ALLBRANDS_TITLE'));		
		$this->objectsArr['brands_module_brand_info_tab_link'] = base_url().index_page().'/brands/b/'.$this->_current_brands_brand_rid;
		$this->objectsArr['brands_module_brand_products_tab_link'] = base_url().index_page().'/brands/p/'.$this->_current_brands_brand_rid;
	}
	
	public function RenderBrandArea()
	{
		$parsARR = $this->GetPars();
		$resultARR = $this->ciObject->brands_model->GetBrandArr($parsARR);
		if(!$resultARR) return $this->ciObject->load->view('modules/brands_module/bareafailure.php',$this->objectsArr, True);
		$this->objectsArr['brands_module_brand_name_title'] = $resultARR['name'];
		if($this->_current_brands_mode=='p')$brandAREA = $this->RenderBrandProducts($resultARR);
		else $brandAREA = $this->RenderBrandInfo($resultARR); 
		return $brandAREA;
	}

	public function RenderBrandsList()
	{
		$parsARR = $this->GetPars();
		$SR = null;
		if(!$this->_current_brands_nav_letter) $SR = '0-9';
		else $SR = $this->_current_brands_nav_letter;
		$this->objectsArr['brands_module_brands_current_letter'] = mb_strtoupper($SR, 'UTF-8');
		$parsARR['sr'] = $SR;
		$resultARR = $this->ciObject->brands_model->GetBrandsByLetter($parsARR);
		if(!$resultARR)
		{	
			$this->objectsArr['brands_module_brands_list_count'] = '0';
			$this->objectsArr['brands_module_brands_list_content'] = $this->ciObject->lang->line('BRANDS_MODULE_BRANDS_EMPTY_LIST');
		}
		else
		{
			$this->objectsArr['brands_module_brands_list_count'] = count($resultARR);
			$this->ciObject->load->library('table');
			$tmpl = array (
        					'table_open'          => '<div id="t_brlist"><table celpadding=0 cellspacing=0 >',
            	    		'heading_row_start'   => '<tr>',
                			'heading_row_end'     => '</tr>',
	                		'heading_cell_start'  => '<td>',
	                		'heading_cell_end'    => '</td>',
	                		'row_start'           => '<tr>',
	                		'row_end'             => '</tr>',
	                		'cell_start'          => '<td>',
	                		'cell_end'            => '</td>',
	                		'row_alt_start'       => '<tr>',
	                		'row_alt_end'         => '</tr>',
	                		'cell_alt_start'      => '<td>',
	                		'cell_alt_end'        => '</td>',
	                		'table_close'         => '</table></div>'
    	    	    		);
			$this->ciObject->table->set_template($tmpl);
			$newRowsList = array();
			foreach($resultARR as $row)
			{
				$newRowsList[] = $this->_RenderBrandListCell($row);  
			}
			$new_list = $this->ciObject->table->make_columns($newRowsList, 2);
			$this->objectsArr['brands_module_brands_list_content'] = $this->ciObject->table->generate($new_list);
		}
		$this->objectsArr['brands_module_brand_letters_nav'] = $this->ciObject->load->view('modules/brands_module/lettersnav.php',$this->objectsArr, True);
		return $this->ciObject->load->view('modules/brands_module/brandslist.php',$this->objectsArr, True);
	}
	
	public function _RenderBrandListCell($row)
	{
		$row['offers_title'] = $this->objectsArr['brands_module_brand_offers_title'];
		return $this->ciObject->load->view('modules/brands_module/_cellbrlist.php',$row, True);
	}
	
	public function RenderBrandInfo($resultARR)
	{
		$this->objectsArr['brands_module_brand_offquan_title'] = $this->ciObject->lang->line('BRANDS_MODULE_BRAND_OFFQUAN_TITLE');
		$this->objectsArr['brands_module_brand_website_title'] = $this->ciObject->lang->line('BRANDS_MODULE_BRAND_WEBSITE_TITLE');
		$this->objectsArr['brands_module_brand_descr_title'] = $this->ciObject->lang->line('BRANDS_MODULE_BRAND_DESCR_TITLE');
		if(empty($resultARR['descr'])) $resultARR['descr'] = $this->ciObject->lang->line('BRANDS_MODULE_BRAND_EMPTY_DESCR');
		$this->objectsArr['brands_module_brand_result_arr'] = $resultARR;
		return $this->ciObject->load->view('modules/brands_module/brandinfo.php',$this->objectsArr, True);		
	}
	
	public function RenderBrandProducts($resultARR)
	{
		$parsARR = $this->GetPars();
		$this->objectsArr['brands_module_brand_offquan_title'] = $this->ciObject->lang->line('BRANDS_MODULE_BRAND_OFFQUAN_TITLE');
		$this->objectsArr['brands_module_brand_result_arr'] = $resultARR;
		$resultARR = $this->ciObject->brands_model->GetBrandProducts($parsARR);		
		if(!$resultARR) $this->objectsArr['brands_module_brand_products_content'] = $this->ciObject->lang->line('BRANDS_MODULE_BRANDS_NOPRODUCTS_CONT');
		else
		{
			$this->ciObject->load->library('table');
			$tmpl = array (
       	    	        'table_open'          => '<div id="t_wuopinion"><table celpadding=0 cellspacing=0 >',
           	    	    'heading_row_start'   => '<tr>',
                	    'heading_row_end'     => '</tr>',
                    	'heading_cell_start'  => '<td>',
                    	'heading_cell_end'    => '</td>',
                    	'row_start'           => '<tr>',
                    	'row_end'             => '</tr>',
                    	'cell_start'          => '<td>',
                    	'cell_end'            => '</td>',
                    	'row_alt_start'       => '<tr>',
                    	'row_alt_end'         => '</tr>',
                    	'cell_alt_start'      => '<td>',
                    	'cell_alt_end'        => '</td>',
                    	'table_close'         => '</table></div>'
   	    	      	);
			$this->ciObject->table->set_template($tmpl);
			$newRowsList = array();
			foreach($resultARR as $row)
			{
				$newRowsList[] = $this->_RenderBrandProdCell($row);  
			}
			$new_list = $this->ciObject->table->make_columns($newRowsList, 2);
			$this->objectsArr['brands_module_brand_products_content'] = $this->ciObject->table->generate($new_list);
		}
		return $this->ciObject->load->view('modules/brands_module/brandpr.php',$this->objectsArr, True);		
	}

	public function _RenderBrandProdCell($row)
	{
		$row['offers_title'] = $this->objectsArr['brands_module_brand_offers_title'];
		return $this->ciObject->load->view('modules/brands_module/_cellprlist.php',$row, True);
	}
	
	public function GetPars()
	{
		$parsARR = array();
		$parsARR['_brands_rid'] = $this->_current_brands_brand_rid;
		$parsARR['_countries_rid'] = $this->_current_brands_country_rid;
		$parsARR['_regions_rid'] = $this->_current_brands_region_rid;
		$parsARR['_cities_rid'] = $this->_current_brands_city_rid;
		$parsARR['_maincurr_rid'] = $this->_current_brands_main_curr_rid;
		$parsARR['_addcurr_rid'] = $this->_current_brands_add_curr_rid;
		return $parsARR;
	}
}
?>