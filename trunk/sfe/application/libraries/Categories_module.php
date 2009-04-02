<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
/*
 * Categories module
 * Mazvv 02-05-2007
*/
class Categories_module{
	private $ciObject;
	private $objectsArr = array();
	private $STN_categories_root_cat_rid = 0; # rid of root category
	private $STN_categories_title; # title for categories table
	private $STN_categories_table_show_quan = -1; # how many categories shows in main categories table (if -1 chow all)
	private $STN_categories_icons_images_path = 'images/categories/icons/';
	private $STN_categories_pictures_images_path = 'images/categories/picts/';
	private $STN_categories_offers_quan_per_page = 15;
	private $STN_categories_default_prtype_code = 'R';
	private $STN_categories_default_sort_rule = 'nm';
	private $STN_categories_offers_pagination_num_links = 5;
	private $STN_categories_ware_images_offers_path = 'images/wares/offers_thumb/';
	private $STN_categories_ware_images_original_path = 'images/wares/original_size/';
	private $STN_categories_ware_images_offers_width = 100;
	private $STN_categories_ware_images_offers_height = 100;
	private $_categories_current_uri_assoc;
	private $_categories_current_sort_rule; 
	private $_categories_current_price_type;
	private $_categories_current_main_curr_rid;
	private $_categories_current_add_curr_rid;	
	private $_categories_current_city_rid;
	private $_categories_current_country_rid;
	private $_categories_current_region_rid;
	private $_categories_current_page;
	private $_categories_quan_of_offers;
	
	
	
	public function __construct(){
		$this->ciObject = &get_instance();
		$this->ciObject->lang->load('categories_module');
		$this->ciObject->load->helper('inflector');
		$this->ciObject->load->model('categories_model');
		$this->ciObject->load->library('contacts_module');
		$this->STN_categories_title = $this->ciObject->lang->line('CATEGORIES_MODULE_TABLE_TITLE');
		$this->objectsArr['categories_title'] = $this->STN_categories_title;
		/* { URI parsed */
		$this->_categories_current_uri_assoc = $this->ciObject->uri->uri_to_assoc(2);
		$this->_categories_current_sort_rule = (isset($this->_categories_current_uri_assoc['sr']))?$this->_categories_current_uri_assoc['sr']:$this->STN_categories_default_sort_rule;
		$this->_categories_current_price_type = (isset($this->_categories_current_uri_assoc['pp']))?$this->_categories_current_uri_assoc['pp']:$this->STN_categories_default_prtype_code;
		$currentSESS = $this->ciObject->session->userdata('_SI_');
		$this->_categories_current_city_rid = $currentSESS['SI_SETTINGS']['_CITY_RID_'];
		$this->_categories_current_region_rid = $currentSESS['SI_SETTINGS']['_REGION_RID_'];
		$this->_categories_current_country_rid = $currentSESS['SI_SETTINGS']['_COUNTRY_RID_'];
		$this->_categories_current_main_curr_rid = $currentSESS['SI_SETTINGS']['_MAIN_CURR_RID_'];
		$this->_categories_current_add_curr_rid = $currentSESS['SI_SETTINGS']['_ADD_CURR_RID_'];
		$this->_categories_current_page = (isset($this->_categories_current_uri_assoc['p']))?$this->_categories_current_uri_assoc['p']:0;
		/* } URI parsed */
	}
	
	public function getCridFromSlug($slug){
		$cArr = explode('-', $slug);
		$cRid = (int)$cArr[0];
		return $cRid; 
	}
	
	public function RenderCategoriesTable(){
		$categoriesLIST = $this->ciObject->categories_model->GetCategories($this->STN_categories_root_cat_rid);
		$quanonCOL = (count($categoriesLIST)%2>0)?(count($categoriesLIST)+1)/2:count($categoriesLIST)/2;
		$this->ciObject->load->helper('array');
		$this->objectsArr['categories_table_random_item'] = random_element($categoriesLIST);
		$this->objectsArr['categories_table_show_all'] = anchor(base_url().index_page().'/categories/sa',
																$this->ciObject->lang->line('CATEGORIES_MODULE_SHOW_ALL_CATEGORIES_TITLE').'<b class="more">&nbsp;</b>',
																array('class'=>'c69', 'style'=>'float: right;'));
		
		$randomCATEGORYIMAGES = $this->ciObject->categories_model->GetCategoryImages($this->objectsArr['categories_table_random_item']->rid, 'PICTURE');
		if($randomCATEGORYIMAGES)	$this->objectsArr['categories_image_picture'] = $this->GetCategoryImage($randomCATEGORYIMAGES,'PICTURE');
		else $this->objectsArr['categories_image_picture'] = '';
																
		$i = 1;
		foreach($categoriesLIST as $row) 
		{
			if($i <= $quanonCOL) $this->objectsArr['categories_table_left_list'][] = $row;
			else $this->objectsArr['categories_table_right_list'][] = $row;
			$i++;
		}
		return $this->ciObject->load->view('modules/categories_module/categoriestable.php',$this->objectsArr, True);
	}
	
	public function RenderCategoriesList(){
		$data['categories_list'] = $this->ciObject->categories_model->getTopCategories(null);
		$data['subcats_list'] = $this->ciObject->categories_model->getSecondLevelCategories();
		return $this->ciObject->load->view('modules/categories_module/list.php',$data, True);
	}
	
	public function RenderCategoriesTree(){
		$data = array();
		$data['tree'] = $this->getTree();
		$data['cats_in_cols'] = (int)(count($this->ciObject->categories_model->getTopCategories(null))/3)+1;
		return $this->ciObject->load->view('modules/categories_module/tree.php',$data, True);
	}
	
	public function RenderCategoryContent($slug){
		if(!$catRid = $this->getCridFromSlug($slug)) show_404();
		$data = array();
		$data['currcat'] = $this->ciObject->categories_model->getCategoryInfo($catRid);
		if(!$data['currcat']) show_404();
		$data['path'] = $this->ciObject->categories_model->getCategoryPath($catRid);
		if($this->ciObject->agent->is_browser()){
			$this->ciObject->categories_model->upPopularity($catRid);		
		}
		# at first render subcategories content
		$data['subcats'] = $this->ciObject->categories_model->getCategories($catRid);
		if(count($data['subcats'])){
			$middle = count($data['subcats'])/2;
			if(($middle - (int)$middle) > 0) $middle++;
			$data["middle"] = (int)$middle;
			$data['s_subcats'] = $this->ciObject->categories_model->getSubcategories2Level($catRid);
			return $this->ciObject->load->view('modules/categories_module/category_ws.php',$data, True);	
		}
		$data['offers'] = $this->GetCategoryOffers($catRid); 
		return $this->ciObject->load->view('modules/categories_module/category_pr.php',$data, True);
	}
	
	public function GetCategoryOffers($cRid){
		/* generate current URL step by step */
		$data = array();
		$pars = $this->ciObject->uri->uri_to_assoc();
		$data['c'] = $this->ciObject->categories_model->getCategoryInfo($cRid);
		$currentCATEGORYIMAGES = $this->ciObject->categories_model->GetCategoryImages($cRid, 'ICON');
		if($currentCATEGORYIMAGES) $data['cat_icon'] = $this->GetCategoryImage($currentCATEGORYIMAGES,'ICON');
		else $data['cat_icon'] = null;
		$data['cRid'] = $cRid;
		$data['offset'] = (int)element('p', $pars);
		$data['offers1'] = $this->ciObject->categories_model->GetOffersByCategory($cRid);
		$data['offers_quan'] = $this->ciObject->categories_model->GetQueryRowsQuan();
		if (!$data['offers_quan']){
			return $this->ciObject->load->view('modules/categories_module/catnooffers.php', $data, True); 
		}
		
		foreach($data['offers1'] as $key=>$row){
			$data['offers1'][$key]->img = $this->getOfferImage($row);
		}
		$data['sort'] = element('sort', $pars)?element('sort', $pars):'price';
		$pagerPars = $pars; unset($pagerPars['p']);
		$sortPars = $pagerPars; unset($sortPars['sort']); 
		$data['pars_string'] = $this->ciObject->uri->assoc_to_uri($sortPars);
		$config['base_url'] = base_url().index_page().'/category/'.$data['c']->rid.'-'.$data['c']->slug.'/'.$this->ciObject->uri->assoc_to_uri($pagerPars).'/p/';
		$config['total_rows'] = $data['offers_quan'];
		$config['uri_segment'] = count($pars)?count($pars)*2+2:'4';
		$config['per_page'] = '15'; 
		$config['num_links'] = 5;
		$config['next_link'] = lang('CATEGORIES_MODULE_PAGINATION_NEXT_LINK_TITLE');
		$config['prev_link'] = lang('CATEGORIES_MODULE_PAGINATION_PREV_LINK_TITLE');
		$config['first_link'] = lang('CATEGORIES_MODULE_PAGINATION_FIRST_LINK_TITLE');
		$config['last_link'] = lang('CATEGORIES_MODULE_PAGINATION_LAST_LINK_TITLE');
		$this->ciObject->pagination->initialize($config); 
		$data['pager'] = $this->ciObject->pagination->create_links();
		return $this->ciObject->load->view('modules/categories_module/category_pr.php', $data, True); 
	}
	
	public function GetCategoryImage($imagesROWS, $typeP = 'ICON'){
		# get random image
		$this->ciObject->load->helper('array');
		$image = random_element($imagesROWS);
		$imgNAME = ($typeP=='ICON')?$this->STN_categories_icons_images_path.$image['rid'].'_'.$image['name']:$this->STN_categories_pictures_images_path.$image['rid'].'_'.$image['name'];
		if(file_exists($imgNAME)) return base_url().$imgNAME;
		$ifile=fopen($imgNAME, "w");
		fwrite($ifile,$image['image']);
		fclose($ifile); 
		if($typeP=='ICON')
		{
			$this->objectsArr['categories_image_icon'] = base_url().$imgNAME;
			return; 	
		}
		$config = array();
		$config['image_library'] = 'GD2';
		$config['source_image'] = $imgNAME;
		$config['create_thumb'] = FALSE;
		$config['width'] = $this->STN_categories_ware_images_offers_width;
		$config['height'] = $this->STN_categories_ware_images_offers_width;
		$this->ciObject->load->library('image_lib');
		$this->ciObject->image_lib->clear();
		$this->ciObject->image_lib->initialize($config);
		if (!$this->ciObject->image_lib->resize())
		{
    		echo $this->ciObject->image_lib->display_errors();
		}				
		$this->objectsArr['categories_image_icon'] = base_url().$imgNAME;
	}

	public function GetWareImage($imagesROWS){
		# get random image
		$this->ciObject->load->helper('array');
		$this->ciObject->load->library('image_lib');
		$this->ciObject->image_lib->clear();
		$image = random_element($imagesROWS);
		$imgORIGINAL = $this->STN_categories_ware_images_original_path.$image->rid.'_'.$image->name;
		$imgOFFERS  = $this->STN_categories_ware_images_offers_path.$image->rid.'_'.$image->name;
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
			$config['width'] = $this->STN_categories_ware_images_offers_width;
			$config['height'] = $this->STN_categories_ware_images_offers_height;
			$this->ciObject->image_lib->initialize($config);
			if (!$this->ciObject->image_lib->resize()) echo $this->ciObject->image_lib->display_errors();
		}
		return $this->STN_categories_ware_images_offers_path.$image->rid.'_'.$image->name;
	}
	
	public function getOfferImage($row){
		$img = 'images/no_image.png';
		$cWi = ($row->_wares_rid)?$this->ciObject->categories_model->GetWareImages($row->_wares_rid):null;
		if(!$cWi && $row->prItemIMGS) $cWi = $this->ciObject->categories_model->GetItemImages($row->prItemIMGS);
		if($cWi) $img = $this->GetWareImage($cWi);
		return $img;
	}
	
	public function _GetPars($cRid)
	{
		/* set pars */
		/*
		 * Pars variables
		 * pp - price type
		 * l - page limit
		 * p - num page
		 * b - brand
		 * ss - search string
		 * pf - price from 
		 * pt - price to
		 * pfa - price from addcurrency
		 * pta - price to addcurrency
		 * sr - sort rule
		 * cl - client_rid
		 */
		$pars['sr'] = $this->_categories_current_sort_rule;
		$pars['pp'] = $this->_categories_current_price_type;
		$pars['p'] = $this->_categories_current_page;
		$pars['l'] = $this->STN_categories_offers_quan_per_page;
		$pars['OP'] = $this->_categories_current_uri_assoc;
		return $pars;
	}
	
	public function searchProcessing(){
		$this->ciObject->form_validation->set_rules('searchString', lang('SEARCH_STRING_TITLE'), 'trim|required|min_length[2]|max_length[128]');
		$data = array('result'=>null);
		if($this->ciObject->form_validation->run()==False){
			return $this->ciObject->load->view('modules/categories_module/searchres.php',$data, True);
		}
		$data['s'] = $this->ciObject->input->post('searchString');
		
		$data['result'] = $this->ciObject->categories_model->GetSearchResult($this->ciObject->input->post('searchString'));
		$this->ciObject->categories_model->setSearchStat($this->ciObject->input->post('searchString'));
		return $this->ciObject->load->view('modules/categories_module/searchres.php',$data, True); 
	}

	public function searchCloud($sString){
		$data = array('result'=>null);
		$data['s'] = $sString;
		$data['result'] = $this->ciObject->categories_model->GetSearchResult($sString);
		$this->ciObject->categories_model->setSearchStat($sString);
		return $this->ciObject->load->view('modules/categories_module/searchres.php',$data, True); 
	}
	
	public function getTree(){
		$rows = $this->ciObject->categories_model->GetCategories();
		$children = array(); // children of each ID
	    $ids = array();
    	foreach ($rows as $i=>$r){
    		$row =& $rows[$i];
    		$id = $row->rid;
        	$pid = $row->_categories_rid;
        	$children[$pid][$id] =& $row;
        	if (!isset($children[$id])) $children[$id] = array();
        	$row->childNodes =& $children[$id];
        	$ids[$row->rid] = true;
		}
	    // Root elements are elements with non-found PIDs.
    	$forest = array();
    	foreach ($rows as $i=>$r){
    		$row =& $rows[$i];
        	if (!isset($ids[$row->_categories_rid])){
        		$forest[$row->rid] =& $row;
			}
        	#unset($row[$idName]); unset($row[$pidName]);
		}
    	return $forest;
	}
	
}
?>