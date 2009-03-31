<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
/*
 * Rating module
 * Mazvv 03-05-2007
*/
class Rating_module 
{
	private $ciObject;
	private $objectsArr = array();
	private $STN_rating_recomend_area_title; # title of recomended area
	private $STN_rating_ware_images_original_path = 'images/wares/original_size/';
	private $STN_rating_ware_images_rating_path = 'images/wares/rating_thumb/';
	private $STN_rating_ware_image_width = 80;
	private $STN_rating_ware_image_height = 80;
	private $_current_rating_uri_assoc;
	private $_current_rating_uri_string;
	private $_current_rating_city_rid;
	private $_current_rating_country_rid;
	private $_current_rating_region_rid;
	

	public function __construct()
	{
		$this->ciObject = &get_instance();
		$this->ciObject->lang->load('rating_module');
		$this->ciObject->load->model('rating_model');
		$this->_current_rating_uri_assoc = $this->ciObject->uri->uri_to_assoc(2);
		$this->_current_rating_uri_string = $this->ciObject->uri->assoc_to_uri($this->_current_rating_uri_assoc);
		$currentSESS = $this->ciObject->session->userdata('_SI_');
		$this->_current_rating_city_rid = $currentSESS['SI_SETTINGS']['_CITY_RID_'];
		$this->_current_rating_region_rid = $currentSESS['SI_SETTINGS']['_REGION_RID_'];
		$this->_current_rating_country_rid = $currentSESS['SI_SETTINGS']['_COUNTRY_RID_'];
		$this->STN_rating_recomend_area_title = $this->ciObject->lang->line('RATING_MODULE_RECOMEND_AREA_TITLE');
		$this->objectsArr['recomend_area_title'] = $this->STN_rating_recomend_area_title;
		
	}
	
	public function RenderRatingRecomendArea()
	{
		$parsARR = array('countriesRID'=>$this->_current_rating_country_rid, 
							'regionsRID'=>$this->_current_rating_region_rid, 
							'citiesRID'=>$this->_current_rating_city_rid, 		
							'catRID'=>null);
		if($this->ciObject->uri->segment(1)=='categories') 
		{
			/* Get Most rated products from current category */
			$this->ciObject->load->model('categories_model');
			if(isset($this->_current_rating_uri_assoc['c']))
			{
				if(!$this->ciObject->categories_model->GetCategoriesArr($this->_current_rating_uri_assoc['c'])) 
				$parsARR['catRID'] = $this->_current_rating_uri_assoc['c'];
			}
		}
		$resultARR = $this->ciObject->rating_model->GetRatedProducts($parsARR);
		if(!$resultARR) return '';
		$this->ciObject->load->helper('array');
		$resultARR = random_element($resultARR);
		$this->objectsArr['rating_ware_image'] = $this->GetWareImage($resultARR);
		$this->objectsArr['rating_ware_rating'] = $resultARR['wareRATING'];
		$this->objectsArr['rating_offers_quan'] = $resultARR['offersQUAN'];
		$this->objectsArr['rating_ware_sdescr'] = $resultARR['shortDESCR'];
		$this->objectsArr['rating_ware_details'] = anchor(base_url().index_page().'/ware/c/'.$resultARR['_categories_rid'].'/o/'.$resultARR['_brands_rid'].'/m/'.$resultARR['model_alias'], $this->ciObject->lang->line('RATING_MODULE_RECOMEND_WARE_DETAILS'), 'class="c69"');
		$this->objectsArr['rating_ware_name'] = anchor(base_url().index_page().'/ware/c/'.$resultARR['_categories_rid'].'/o/'.$resultARR['_brands_rid'].'/m/'.$resultARR['model_alias'], $resultARR['wareNAME']);
		return $this->ciObject->load->view('modules/rating_module/recomendarea.php',$this->objectsArr, True);
	}

	public function RenderRatingProductsArea()
	{
		return $this->ciObject->load->view('modules/rating_module/ratingarea.php',$this->objectsArr, True);
	}

	public function GetWareImage($imagesROWS)
	{
		$this->ciObject->load->library('image_lib');
		$this->ciObject->image_lib->clear();
		$imgORIGINAL = $this->STN_rating_ware_images_original_path.$imagesROWS['irid'].'_'.$imagesROWS['iname'];
		$imgRATING  = $this->STN_rating_ware_images_rating_path.$imagesROWS['irid'].'_'.$imagesROWS['iname'];
		if(!file_exists($imgORIGINAL))
		{
			$ifile=fopen($imgORIGINAL, "w");
			fwrite($ifile, $imagesROWS['image']);
			fclose($ifile);
		} 
		if(!file_exists($imgRATING))
		{
			$config = array();
			$config['image_library'] = 'GD2';
			$config['source_image'] = $imgORIGINAL;
			$config['new_image'] = $imgRATING;
			$config['create_thumb'] = FALSE;
			$config['height'] = $this->STN_rating_ware_image_height;
			$config['width'] = $this->STN_rating_ware_image_width;
			$this->ciObject->load->library('image_lib');
			$this->ciObject->image_lib->clear();
			$this->ciObject->image_lib->initialize($config);
			if (!$this->ciObject->image_lib->resize())
			{
   				echo $this->ciObject->image_lib->display_errors();
			}
		} 					
		return base_url().$imgRATING;
	}
	
}
?>