<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
/*
 * Likeness module
 * Mazvv 23-06-2007
*/
class Likeness_module 
{
	private $ciObject;
	private $objectsArr = array();
	private $_current_likeness_uri_assoc;
	private $_current_likeness_category_rid;
	private $_current_likeness_brands_rid;
	private $_current_likeness_model;
	private $_categories_current_main_curr_rid;
	private $_categories_current_add_curr_rid;	
	private $_categories_current_city_rid;
	private $_categories_current_country_rid;
	private $_categories_current_region_rid;
	private $_categories_current_prtype_cod = 'R';
	
	
	public function __construct()
	{
		$this->ciObject = &get_instance();
		$this->ciObject->lang->load('likeness_module');
		$this->ciObject->load->model('likeness_model');
		$this->_current_likeness_uri_assoc = $this->ciObject->uri->uri_to_assoc(2);
		$this->_current_likeness_category_rid = (isset($this->_current_likeness_uri_assoc['c']))?$this->_current_likeness_uri_assoc['c']:null;
		if(isset($this->_current_likeness_uri_assoc['o'])) $this->_current_likeness_brands_rid = $this->_current_likeness_uri_assoc['o'];
		else if(isset($this->_current_likeness_uri_assoc['d'])) $this->_current_likeness_brands_rid = $this->_current_likeness_uri_assoc['d'];
		else if(isset($this->_current_likeness_uri_assoc['op'])) $this->_current_likeness_brands_rid = $this->_current_likeness_uri_assoc['op'];
		else if(isset($this->_current_likeness_uri_assoc['r'])) $this->_current_likeness_brands_rid = $this->_current_likeness_uri_assoc['r'];
		else $this->_current_likeness_brands_rid = null;
		if(isset($this->_current_likeness_uri_assoc['m'])) $this->_current_likeness_model = $this->_current_likeness_uri_assoc['m'];
		else $this->_current_likeness_model = null;
		if(isset($this->_current_likeness_uri_assoc['pp']) && $this->_current_likeness_uri_assoc['pp']) $this->_current_likeness_uri_assoc['pp'];
		
		$currentSESS = $this->ciObject->session->userdata('_SI_');
		$this->_categories_current_city_rid = $currentSESS['SI_SETTINGS']['_CITY_RID_'];
		$this->_categories_current_region_rid = $currentSESS['SI_SETTINGS']['_REGION_RID_'];
		$this->_categories_current_country_rid = $currentSESS['SI_SETTINGS']['_COUNTRY_RID_'];
		$this->_categories_current_main_curr_rid = $currentSESS['SI_SETTINGS']['_MAIN_CURR_RID_'];
		$this->_categories_current_add_curr_rid = $currentSESS['SI_SETTINGS']['_ADD_CURR_RID_'];
		
	}
	
	public function RenderLikenessListArea()
	{
		if(!$this->_current_likeness_brands_rid || 
			!$this->_current_likeness_category_rid || 
			!$this->_current_likeness_model) return '';	
		else $parsARR = array('c'=>$this->_current_likeness_category_rid, 
								'b'=>$this->_current_likeness_brands_rid,
								'm'=>$this->_current_likeness_model,
								'cityRID'=>$this->_categories_current_city_rid,
								'regionRID'=>$this->_categories_current_region_rid,
								'countryRID'=>$this->_categories_current_country_rid,	
								'maincurrRID'=>$this->_categories_current_main_curr_rid,
								'addcurrRID'=>$this->_categories_current_add_curr_rid,
								'priceTYPE'=>$this->_categories_current_prtype_cod);
		$this->objectsArr['likeness_module_result_arr'] = $this->ciObject->likeness_model->GetLikenessArr($parsARR);
		if(!$this->objectsArr['likeness_module_result_arr']) return '';
		$this->objectsArr['likeness_module_likeness_title'] = $this->ciObject->lang->line('LIKENESS_MODULE_LIKENESS_TITLE');
		return $this->ciObject->load->view('modules/likeness_module/likenessarea.php',$this->objectsArr, True); 
	}
}
?>