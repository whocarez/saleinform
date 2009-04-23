<?phpif (!defined('BASEPATH')) exit('No direct script access allowed');/* * Last module * Mazvv 03-05-2007*/class Last_module{	private $ciObject;	private $objectsArr = array();	private $STN_last_module_area_title;	private $STN_last_news_area_title;	private $STN_last_opinions_area_title;	private $STN_last_reviews_area_title;	private $STN_last_wdetails_area_title;	private $_last_current_uri_assoc;	private $_last_current_category_rid;	private $_last_current_main_curr_rid;	private $_last_current_add_curr_rid;		private $_last_current_city_rid;	private $_last_current_country_rid;	private $_last_current_region_rid;	private $STN_news_image_sthumb_path = 'images/news/news_sthumb/';	private $STN_news_image_thumb_path = 'images/news/news_thumb/';	private $STN_news_image_original_path = 'images/news/original_size/';	private $STN_news_images_sthumb_width = 50;	private $STN_news_images_sthumb_height = 50;	private $STN_news_images_thumb_width = 150;	private $STN_news_images_thumb_height = 150;	
	
	public function __construct(){		$this->ciObject = &get_instance();		$this->ciObject->lang->load('last_module');		$this->ciObject->lang->load('clients_module');		$this->ciObject->load->model('last_model');		$this->STN_last_module_area_title = $this->ciObject->lang->line('LAST_MODULE_AREA_TITLE');
		$this->STN_last_news_area_title = $this->ciObject->lang->line('LAST_MODULE_NEWS_AREA_TITLE');
		$this->STN_last_opinions_area_title = $this->ciObject->lang->line('LAST_MODULE_OPINIONS_AREA_TITLE');
		$this->STN_last_reviews_area_title = $this->ciObject->lang->line('LAST_MODULE_REVIEWS_AREA_TITLE');
		$this->STN_last_wdetails_area_title = $this->ciObject->lang->line('LAST_MODULE_WDETAILS_AREA_TITLE');
		$this->_last_current_uri_assoc = $this->ciObject->uri->uri_to_assoc(2);
		$currentSESS = $this->ciObject->session->userdata('_SI_');
		$this->_last_current_city_rid = $currentSESS['SI_SETTINGS']['_CITY_RID_'];
		$this->_last_current_country_rid = $currentSESS['SI_SETTINGS']['_COUNTRY_RID_'];
		$this->_last_current_region_rid = $currentSESS['SI_SETTINGS']['_REGION_RID_'];
	}		public function RenderLastCluopinions(){		$data = array();		$this->ciObject->load->library('clients_module');		$data['opns_list'] = $this->ciObject->last_model->getLastCluopinions();		foreach($data['opns_list'] as $key=>$row){			$data['opns_list'][$key]->logo = $this->ciObject->clients_module->GetMiniLogoImage($row); 		}		return $this->ciObject->load->view('modules/last_module/lastcluops.php',$data, True);		}
	
	public function RenderLastNews(){
		$this->ciObject->load->helper('text');
		$resultARR = $this->ciObject->last_model->GetLastNews();
		if(!$resultARR) $resultARR = array();
		foreach($resultARR as $key=>$row){ 
			$resultARR[$key]['newlink'] = anchor(base_url().index_page().'/news/n/'.$resultARR[$key]['rid'], $this->ciObject->lang->line('LAST_MODULE_NEW_DETAILS'), 'class="c69"');
			$resultARR[$key]['linkstring'] = base_url().index_page().'/news/n/'.$resultARR[$key]['rid'];
			if($row['name']) $resultARR[$key]['img'] = $this->GetNewImage($row);
			else $resultARR[$key]['img'] = null;
		}
		$this->objectsArr['last_module_news_cont_arr'] = $resultARR;
		return $this->ciObject->load->view('modules/last_module/lastnews.php',$this->objectsArr, True);
	}

	public function _RenderLastOpinionsArea()
	{
		$this->ciObject->load->helper('text');
		$resultARR = $this->ciObject->last_model->GetLastOpinions();
		$resultARR = ($resultARR)?$resultARR:array();
		#var_dump($resultARR);
		foreach($resultARR as $key=>$row)
		{ 
			$resultARR[$key]['opinion'] = character_limiter($resultARR[$key]['opinion'], 256);
			$resultARR[$key]['warelink'] = base_url().index_page().'/ware/c/'.$resultARR[$key]['_categories_rid'].'/op/'.$resultARR[$key]['_brands_rid'].'/m/'.$resultARR[$key]['model_alias'];
			$resultARR[$key]['allwareops'] = anchor(base_url().index_page().'/ware/c/'.$resultARR[$key]['_categories_rid'].'/op/'.$resultARR[$key]['_brands_rid'].'/m/'.$resultARR[$key]['model_alias'], $this->ciObject->lang->line('LAST_MODULE_ALL_WARE_OPINIONS').$resultARR[$key]['wareNAME'], 'class="c69"');
		}
		$this->objectsArr['last_module_news_allcats_link'] = anchor(base_url().index_page().'/categories', $this->ciObject->lang->line('LAST_MODULE_CATEGORIES_ALL'), 'class="c69"');;		
		$this->objectsArr['last_module_opinions_cont_arr'] = $resultARR; 
		return $this->ciObject->load->view('modules/last_module/_opinionscont.php',$this->objectsArr, True);
	}

	public function _RenderLastReviewsArea()
	{
		$this->ciObject->load->helper('text');
		$resultARR = $this->ciObject->last_model->GetLastReviews();
		if(!$resultARR) return '';
		foreach($resultARR as $key=>$row)
		{ 
			$resultARR[$key]['review'] = character_limiter($resultARR[$key]['review'], 256);
			$resultARR[$key]['warelink'] = base_url().index_page().'/ware/c/'.$resultARR[$key]['_categories_rid'].'/r/'.$resultARR[$key]['_brands_rid'].'/m/'.$resultARR[$key]['model_alias'];
			$resultARR[$key]['allwarer'] = anchor(base_url().index_page().'/ware/c/'.$resultARR[$key]['_categories_rid'].'/r/'.$resultARR[$key]['_brands_rid'].'/m/'.$resultARR[$key]['model_alias'], $this->ciObject->lang->line('LAST_MODULE_ALL_WARE_REVIEWS').$resultARR[$key]['wareNAME'], 'class="c69"');
		}
		$this->objectsArr['last_module_news_allcats_link'] = anchor(base_url().index_page().'/categories', $this->ciObject->lang->line('LAST_MODULE_CATEGORIES_ALL'), 'class="c69"');;		
		$this->objectsArr['last_module_reviews_cont_arr'] = $resultARR; 
		return $this->ciObject->load->view('modules/last_module/_reviewscont.php',$this->objectsArr, True);
	}

	public function _RenderLastWdetailsArea()
	{
		$this->ciObject->load->helper('text');
		$this->ciObject->benchmark->mark('last_getwdetails_area_start');
		$resultARR = $this->ciObject->last_model->GetLastWdetails();
		$this->ciObject->benchmark->mark('last_getwdetails_area_end');
		if(!$resultARR) return '';
		foreach($resultARR as $key=>$row)
		{ 
			$resultARR[$key]['warelink'] = base_url().index_page().'/ware/c/'.$resultARR[$key]['_categories_rid'].'/d/'.$resultARR[$key]['_brands_rid'].'/m/'.$resultARR[$key]['model_alias'];
			$resultARR[$key]['allwaredet'] = anchor(base_url().index_page().'/ware/c/'.$resultARR[$key]['_categories_rid'].'/d/'.$resultARR[$key]['_brands_rid'].'/m/'.$resultARR[$key]['model_alias'], $this->ciObject->lang->line('LAST_MODULE_WDETAILS_DETAILS').$resultARR[$key]['wareNAME'], 'class="c69"');
		}
		$this->objectsArr['last_module_news_allcats_link'] = anchor(base_url().index_page().'/categories', $this->ciObject->lang->line('LAST_MODULE_CATEGORIES_ALL'), 'class="c69"');;		
		$this->objectsArr['last_module_wdetails_cont_arr'] = $resultARR; 
		return $this->ciObject->load->view('modules/last_module/_wdetailscont.php',$this->objectsArr, True);
		
	}
	
	public function GetNewImage($newROW)
	{
		$this->ciObject->load->library('image_lib');
		$this->ciObject->image_lib->clear();
		$imgORIGINAL = $this->STN_news_image_original_path.$newROW['rid'].'_'.$newROW['name'];
		$imgNEWS  = $this->STN_news_image_sthumb_path.$newROW['rid'].'_'.$newROW['name'];
		if(!file_exists($imgORIGINAL))
		{
			$ifile=fopen($imgORIGINAL, "w");
			fwrite($ifile, $newROW['image']);
			fclose($ifile);
		} 					
		if(!file_exists($imgNEWS))
		{
			$config = array();
			$config['image_library'] = 'GD2';
			$config['source_image'] = $imgORIGINAL;
			$config['new_image'] = $imgNEWS;
			$config['create_thumb'] = FALSE;
			$config['width'] = $this->STN_news_images_sthumb_width;
			$config['height'] = $this->STN_news_images_sthumb_height;
			$this->ciObject->image_lib->initialize($config);
			if (!$this->ciObject->image_lib->resize())
			{
   				echo $this->ciObject->image_lib->display_errors();
			}
		} 					
		$imgNAME = $imgNEWS;
		return base_url().$imgNAME;
	}
		
}
?>