<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
/*
 * Pop module
 * Mazvv 03-05-2007
*/
class Pop_module 
{
	private $ciObject;
	private $objectsArr = array();
	private $STN_pop_ware_images_original_path = 'images/wares/original_size/';
	private $STN_pop_ware_images_thumb_path = 'images/wares/popcats_size/';
	private $_current_pop_uri_assoc;
	private $_current_pop_uri_string;
	private $_current_pop_city_rid;
	private $_current_pop_country_rid;
	private $_current_pop_region_rid;
	private $_current_pop_sission_id;

	public function __construct()
	{
		$this->ciObject = &get_instance();
		$this->ciObject->load->model('pop_model');
		$this->_current_pop_uri_assoc = $this->ciObject->uri->uri_to_assoc(2);
		$this->_current_pop_uri_string = $this->ciObject->uri->assoc_to_uri($this->_current_pop_uri_assoc);
		$currentSESS = $this->ciObject->session->userdata('_SI_');
		$this->_current_pop_city_rid = $currentSESS['SI_SETTINGS']['_CITY_RID_'];
		$this->_current_pop_region_rid = $currentSESS['SI_SETTINGS']['_REGION_RID_'];
		$this->_current_pop_country_rid = $currentSESS['SI_SETTINGS']['_COUNTRY_RID_'];
		$this->_current_pop_session_id = $this->ciObject->session->userdata('session_id');
	}
	
	public function _SetCategoryPop()
	{
		$this->ciObject->load->library('user_agent');
		if($this->ciObject->uri->segment(1)=='categories' && isset($this->_current_pop_uri_assoc['c']) && $this->ciObject->agent->is_browser())
		{
			$insertARR = array('_categories_rid'=>$this->_current_pop_uri_assoc['c'], 
								'sessionID'=>$this->_current_pop_session_id);
			$this->ciObject->pop_model->SetCatPop($insertARR);
		}
	}

	public function _SetWarePop($wareRid = null)
	{
		if(!$wareRid) return;
		$insertARR = array('_wares_rid'=>$wareRid, 
							'sessionID'=>$this->_current_pop_session_id);
		$this->ciObject->pop_model->SetWarePop($insertARR);
	}
	
	public function _SetClientPop()
	{
	}
	
	public function _SetBrandPop($brandRid = null)
	{
		if(!$brandRid) return;
		//echo $brandRid;
		$insertARR = array('_brands_rid'=>$brandRid, 
							'sessionID'=>$this->_current_pop_session_id);
		$this->ciObject->pop_model->SetBrandPop($insertARR);
	}
	
}
?>