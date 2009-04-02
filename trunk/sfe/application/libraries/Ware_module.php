<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
/*
 * Ware module
 * Mazvv 24-05-2007
*/
class Ware_module{
	private $ciObject;
	private $objectsArr = array();
	private $STN_ware_compare_prices_title; # compare price title
	#private $STN_ware_default_sort_rule_title = 'nm'; # default sort rule
	private $STN_ware_default_sort_rule_title = 'pr'; # default sort rule
	private $STN_ware_default_page_limit = 25; # default page limit
	private $STN_categories_offers_pagination_num_links = 10;
	private $STN_categories_ware_details_images_path = 'images/wares/details_thumb/';
	private $STN_categories_ware_details_simages_path = 'images/wares/details_sthumb/';
	private $STN_categories_ware_details_miniimages_path = 'images/wares/details_minithumb/';
	private $STN_categories_ware_offers_minithumb_path = 'images/wares/offers_minithumb/';	
	private $STN_categories_ware_original_images_path = 'images/wares/original_size/';
	private $STN_categories_ware_details_width = 150; 
	private $STN_categories_ware_details_height = 150;
	private $STN_categories_ware_minidetails_width = 40;
	private $STN_categories_ware_minidetails_height = 40;
	private $STN_categories_ware_minioffers_width = 80;
	private $STN_categories_ware_minioffers_height = 60;
	
	public function __construct(){
		$this->ciObject = &get_instance();
		$this->ciObject->lang->load('ware_module');
		$this->ciObject->load->model('ware_model');
	}
	
	public function getOridFromSlug($slug){
		$cArr = explode('-', $slug);
		$cRid = (int)$cArr[0];
		return $cRid; 
	}
	
	public function RenderWareInfo($slug, $offset){
		$offerRid = $this->getOridFromSlug($slug);
		$offerInfo = $this->ciObject->ware_model->getOfferInfo($offerRid);
		if(!$offerInfo) show_404();
		$this->ciObject->load->model('categories_model');
		$data = array();
		$data['path'] = $this->ciObject->categories_model->getCategoryPath($offerInfo->_categories_rid);
		$data['curr_cat'] = $this->ciObject->categories_model->getCategoryInfo($offerInfo->_categories_rid);
		$data['offer_info'] = $offerInfo;
		if($data['offer_info']->_wares_rid) $data['ware_info'] = $this->ciObject->ware_model->getWareInfo($data['offer_info']->_wares_rid);
		else $data['ware_info'] = null;
		$data['img'] = array();
		if($data['ware_info']) {
			if($t=$this->ciObject->ware_model->getWareImages($data['ware_info']->rid)) $data['img'] = $this->GetWareImages($t); 
		}
		$data['offers_list'] = $data['ware_info']?$this->ciObject->ware_model->getWareOffers($data['ware_info']->rid, 'ware'):$this->ciObject->ware_model->getWareOffers($data['offer_info']->rid);
		$this->ciObject->load->library('clients_module');
		$data['min_price'] = 0;
		$data['max_price'] = 0;
		$data['base_endw'] = '';
		foreach($data['offers_list'] as $key=>$row){
			$i = $this->ciObject->ware_model->getOfferImage($row->offerRID);
			if($i)	$data['offers_list'][$key]->img = $this->GetOfferImage($i);
			else $data['offers_list'][$key]->img = null;
			$data['offers_list'][$key]->cllogo = $this->ciObject->clients_module->GetMiniLogoImage($row);
			if(!$data['min_price'] || $row->minbasePRICE<$data['min_price']) $data['min_price'] = $row->minbasePRICE;
			if(!$data['max_price'] || $row->minbasePRICE>$data['min_price']) $data['max_price'] = $row->maxbasePRICE;
			$data['base_endw'] = $row->baseendWORD;
		}
		
		/* { Reviews */
		if($data['ware_info']) {
			$data['ware_reviews_quan'] = $this->ciObject->ware_model->getWareReviewsQuan($data['ware_info']->rid);
			$data['ware_reviews'] = $this->ciObject->ware_model->getWareReviews($data['ware_info']->rid, 5, $offset);
			$data['reviews_limit'] = 5;
			$data['reviews_offset'] = $offset;
			$data['user'] = $this->ciObject->accounts_module->isLogged();
			$this->ciObject->load->library('pagination');
			$config['base_url'] = base_url().index_page().'/offer/'.$data['offer_info']->rid.'-'.$data['ware_info']->slug;
			$config['total_rows'] = $data['ware_reviews_quan'];
			$config['per_page'] = $data['reviews_limit'];
			$this->ciObject->pagination->initialize($config);
			$data['pager'] = $this->ciObject->pagination->create_links();
		}		
		/* } Reviews */
		
		return $this->ciObject->load->view('modules/ware_module/wareinfo', $data, True);
	}

	public function GetWareImages($rows){
		# get random image
		$this->ciObject->load->helper('array');
		$this->ciObject->load->library('image_lib');
		$this->ciObject->image_lib->clear();
		$images = array();
		foreach($rows as $image){
			$imgORIGINAL = $this->STN_categories_ware_original_images_path.$image->rid.'_'.$image->name;
			$imgDETAILS  = $this->STN_categories_ware_details_images_path.$image->rid.'_'.$image->name;
			$imgMINIDETAILS = $this->STN_categories_ware_details_miniimages_path.$image->rid.'_'.$image->name;			
			if(!file_exists($imgORIGINAL)){
				$ifile=fopen($imgORIGINAL, "w");
				fwrite($ifile, $image->image);
				fclose($ifile);
			} 					
			if(!file_exists($imgDETAILS)){
				$config = array();
				$config['image_library'] = 'GD2';
				$config['source_image'] = $imgORIGINAL;
				$config['new_image'] = $imgDETAILS;
				$config['create_thumb'] = FALSE;
				$config['width'] = $this->STN_categories_ware_details_width;
				$config['height'] = $this->STN_categories_ware_details_height;
				$this->ciObject->image_lib->initialize($config);
				if (!$this->ciObject->image_lib->resize())	echo $this->ciObject->image_lib->display_errors();
			} 					
			if(!file_exists($imgMINIDETAILS)) {
				$config = array();
				$config['image_library'] = 'GD2';
				$config['source_image'] = $imgORIGINAL;
				$config['new_image'] = $imgMINIDETAILS;
				$config['create_thumb'] = FALSE;
				$config['width'] = $this->STN_categories_ware_minidetails_width;
				$config['height'] = $this->STN_categories_ware_minidetails_height;
				$this->ciObject->image_lib->initialize($config);
				if (!$this->ciObject->image_lib->resize()) echo $this->ciObject->image_lib->display_errors();
			}
			$images[] = array($this->STN_categories_ware_details_images_path.$image->rid.'_'.$image->name, 
								$this->STN_categories_ware_details_miniimages_path.$image->rid.'_'.$image->name); 					
		}
		return $images;
	}

	public function GetOfferImage($image){
		# get random image
		$this->ciObject->load->helper('array');
		$this->ciObject->load->library('image_lib');
		$this->ciObject->image_lib->clear();
		$imgORIGINAL = $this->STN_categories_ware_original_images_path.$image->rid.'_'.$image->name;
		$imgOFFERS  = $this->STN_categories_ware_offers_minithumb_path.$image->rid.'_'.$image->name;
		if(!file_exists($imgORIGINAL)){
				$ifile=fopen($imgORIGINAL, "w");
				fwrite($ifile, $image->image);
				fclose($ifile);
		} 					
		if(!file_exists($imgOFFERS)){
			$config = array();
			$config['image_library'] = 'GD2';
			$config['source_image'] = $imgORIGINAL;
			$config['new_image'] = $imgOFFERS;
			$config['create_thumb'] = FALSE;
			$config['width'] = $this->STN_categories_ware_minioffers_width;
			$config['height'] = $this->STN_categories_ware_minioffers_height;
			$this->ciObject->image_lib->initialize($config);
			if (!$this->ciObject->image_lib->resize()) echo $this->ciObject->image_lib->display_errors();
		}
		return $imgOFFERS;
	}	

	
	public function RenderCompareContent(){
		$comparedWARES = array();
		foreach($_POST as $key=>$item) if(substr($key, 0, 4) == 'cmp_') $comparedWARES[] = $item;
		$parsARR = array();
		$parsARR['m_c'] = $this->_ware_current_main_curr_rid;
		$parsARR['a_c'] = $this->_ware_current_add_curr_rid;
		$parsARR['c_c'] = $this->_ware_current_city_rid;
		$parsARR['r_c'] = $this->_ware_current_region_rid;
		$parsARR['cn_c'] = $this->_ware_current_country_rid;
		$parsARR['pp'] = $this->_ware_current_price_type;
		$parsARR['sr'] = $this->_ware_current_sort_rule;
		$detailsARR = array();
		$resultARR = array();
		$dataARR = array();
		$tableARR = array();
		$this->ciObject->load->plugin('tree');
		foreach($comparedWARES as $item)
		{
			$tempARR = explode('^#^', $item);
			#$parsARR['cmp'][] = array('catRID'=>$tempARR[0], 'brandsRID'=>$tempARR[1], 'modelALIAS'=>$tempARR[2]);
			$parsARR['catRID'] = $tempARR[0];
			$parsARR['brandsRID'] = $tempARR[1];
			$parsARR['modelALIAS'] = $tempARR[2];
			$resultARR = $this->ciObject->ware_model->GetWareOffers($parsARR);
			$resultARR = $resultARR[0];
			$detailsARR = $this->ciObject->ware_model->GetWareDetails($parsARR);
			if(!$tableARR)
			{
				$tableARR['T_name']=array($this->ciObject->lang->line('WARE_MODULE_COMPARE_NAME_TITLE'));
				$tableARR['T_prtype']=array($this->ciObject->lang->line('WARE_MODULE_COMPARE_PRICE_TYPE_TITLE'));
				$tableARR['T_prrange']=array($this->ciObject->lang->line('WARE_MODULE_COMPARE_PRICES_RANGE_TITLE'));
				$tableARR['T_rating']=array($this->ciObject->lang->line('WARE_MODULE_COMPARE_RATING_TITLE'));
				$tableARR['T_reviews']=array($this->ciObject->lang->line('WARE_MODULE_COMPARE_REVIEWS_TITLE'));
				$tableARR['T_image']=array($this->ciObject->lang->line('WARE_MODULE_COMPARE_IMAGE_TITLE'));
			}
			$tableARR['T_name'][]=$resultARR['wareNAME'];
			$tableARR['T_prtype'][]=$resultARR['prtypeNAME'];
			$prRANGE = $this->ciObject->lang->line('WARE_MODULE_COMPARE_FROM_TITLE').'&nbsp;'.$resultARR['minbasePRICE'].$resultARR['baseendWORD'].'<br>'.
						$this->ciObject->lang->line('WARE_MODULE_COMPARE_FROM_TITLE').'&nbsp;'.$resultARR['minaddPRICE'].$resultARR['addendWORD'];
			$tableARR['T_prrange'][]=$prRANGE;
			$tableARR['T_rating'][]=$resultARR['wareRATING'];
			$tableARR['T_reviews'][]=$resultARR['wareREWIEVS'];
			$currentWAREIMAGES = $this->ciObject->ware_model->GetWareImages($resultARR['_wares_rid']);
			if($currentWAREIMAGES) $tableARR['T_image'][]=$this->GetWareImage($currentWAREIMAGES);
			else $tableARR['T_image'][] = null;
			foreach($detailsARR as $item)
			{
				if(!isset($dataARR[$item['rid']])) 
				{
					$dataARR[$item['rid']] = $item;
				}
				$dataARR[$item['rid']]['valuesARR'][] = $item['value'];
			}
		}
		
		$this->objectsArr['ware_compare_wares_title'] = $this->ciObject->lang->line('WARE_MODULE_COMPARE_WARES_TITLE');
		$tableARR['DATAS'] = _transform2forest($dataARR, 'rid', '_catpars_rid');
		$this->objectsArr['ware_compare_datas_arr'] = $tableARR;
		return $this->ciObject->load->view('modules/ware_module/comparewares.php',$this->objectsArr, True);
	}

	public function reviewProcessing($slug){
		$this->ciObject->load->library('accounts_module');
		$oRid = $this->getOridFromSlug($slug);
		if(!$oRid) show_404();
		$offerInfo = $this->ciObject->ware_model->getOfferInfo($oRid);
		if(!$offerInfo) show_404();
		$data['ware'] = $this->ciObject->ware_model->getWareInfo($offerInfo->_wares_rid);
		if(!$data['ware']) show_404();
		$data['offer_info'] = 	$offerInfo;
		$this->ciObject->form_validation->set_rules('mark', lang('WARE_MY_MARK'), 'trim|required');
		$this->ciObject->form_validation->set_rules('title', lang('WARE_REVIEW_TITLE'), 'trim|required|min_length[5]|max_length[255]');
		$this->ciObject->form_validation->set_rules('review', lang('WARE_REVIEW_REVIEW'), 'trim|min_length[128]|max_length[2048]');
		$this->ciObject->form_validation->set_rules('positive', lang('WARE_REVIEW_POS'), 'trim|required|min_length[5]|max_length[255]');
		$this->ciObject->form_validation->set_rules('negative', lang('WARE_REVIEW_NEG'), 'trim|required|min_length[5]|max_length[255]');		
		$data['user'] = $this->ciObject->accounts_module->isLogged();
		if(!$data['user']) redirect('accounts', 'refresh');
		if($this->ciObject->form_validation->run()===False){
			return $this->ciObject->load->view('modules/ware_module/editreview.php', $data, True);	
		}
		$insertArr = array('title'=>$this->ciObject->input->post('title'),
							'adv'=>$this->ciObject->input->post('positive'),
							'disadv'=>$this->ciObject->input->post('negative'),
							'opinion'=>$this->ciObject->input->post('review'),
							'mark'=>((int)$this->ciObject->input->post('mark'))*2,		
							'_members_rid'=>$data['user']['_USER_RID_'],
							'_wares_rid'=>$data['ware']->rid);
		$this->ciObject->ware_model->addReview($insertArr);
		redirect('offer/'.$data['offer_info']->rid.'-'.$data['offer_info']->slug, 'refresh');
	}
	
	public function rateReview(){
		$reviewRid = $this->ciObject->input->post('review');
		$rate = $this->ciObject->input->post('rate');
		$this->ciObject->load->library('accounts_module');
		$user = $this->ciObject->accounts_module->isLogged();
		if($member_rid = element('_USER_RID_', $user)){
			if(!$this->ciObject->ware_model->reviewWasRated($reviewRid, $member_rid)){
				$insertArr = array('_waresuopinions_rid'=>$reviewRid, '_members_rid'=>$member_rid, 'rate'=>$rate);
				$this->ciObject->ware_model->rateReview($insertArr);
			}
		}
		return $this->ciObject->ware_model->getReviewRate($reviewRid);
	}
	
}

?>