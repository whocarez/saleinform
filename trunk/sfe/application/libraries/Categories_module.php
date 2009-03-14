<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
/*
 * Categories module
 * Mazvv 02-05-2007
*/
class Categories_module{
	private $ciObject;
	private $topCategoriesQuan = 15;
	private $topTabbedQuan = 6;
	
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
	private $STN_categories_ware_miniicon_width = 41;
	private $STN_categories_ware_miniicon_height = 29;
	
	
	public function __construct(){
		$this->ciObject = &get_instance();
		$this->ciObject->lang->load('categories_module');
		$this->ciObject->load->helper('inflector');
		$this->ciObject->load->model('categories_model');
		$this->ciObject->load->library('keywords_module');
	}
	
	public function getCridFromSlug($slug){
		$cArr = explode('-', $slug);
		$cRid = (int)$cArr[0];
		return $cRid; 
	}
	
	public function renderCategoriesList(){
		$data['categories_list'] = $this->ciObject->categories_model->getTopCategories(null);
		$data['subcats_list'] = $this->ciObject->categories_model->getSecondLevelCategories();
		return $this->ciObject->load->view('modules/categories_module/list.php',$data, True);
	}
	
	public function renderCategoriesTree(){
		$data = array();
		$data['tree'] = $this->getTree();
		$data['cats_in_cols'] = (int)(count($this->ciObject->categories_model->getTopCategories(null))/3)+1;
		return $this->ciObject->load->view('modules/categories_module/tree.php',$data, True);
	}
	
	public function renderCategory($slug=null, $page = null){
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
			$data["middle"] = $middle;
			$data['s_subcats'] = $this->ciObject->categories_model->getSubcategories2Level($catRid);
			return $this->ciObject->load->view('modules/categories_module/category_ws.php',$data, True);	
		}
		$data['offers'] = $this->ciObject->categories_model->GetOffersByCategory($catRid, $page);
		foreach($data['offers'] as $key=>$offer) $data['offers'][$key]->img = ($offer->prItem_image)?$this->GetWareImage($offer):null; 
		$data['offers_quan'] = $this->ciObject->categories_model->getQueryRowsQuan();
		$data['offset'] = $page;
		$this->ciObject->load->library('pagination');
		$config['base_url'] = base_url().index_page().'/category/'.$catRid.'-'.$data['currcat']->slug;
		$config['total_rows'] = $data['offers_quan'];
		$config['num_links'] = 10;
		$config['first_link'] = lang('CATEGORIES_PFIRST');
		$config['last_link'] = lang('CATEGORIES_PLAST');
		$config['per_page'] = 15;
		$this->ciObject->pagination->initialize($config);
		$data['pager'] = $this->ciObject->pagination->create_links();		
		return $this->ciObject->load->view('modules/categories_module/category_pr.php',$data, True);
		
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

	public function GetWareImage($image){
		# get random image
		$this->ciObject->load->library('image_lib');
		$this->ciObject->image_lib->clear();
		$iRid = $iName = $iImage = null;
		if($image->wItem_rid){
			$iRid = $image->wItem_rid; 
			$iName = $image->wItem_name;
			$iImage = $image->wItem_image;
		} else {
			$iRid = $image->prItem_rid; 
			$iName = $image->prItem_name;
			$iImage = $image->prItem_image;
		}
		$imgORIGINAL = $this->STN_categories_ware_images_original_path.$iRid.'_'.$iName;
		$imgOFFERS  = $this->STN_categories_ware_images_offers_path.$iRid.'_'.$iName;
		if(!file_exists($imgORIGINAL)){
			$ifile=fopen($imgORIGINAL, "w");
			fwrite($ifile, $iImage);
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
			if (!$this->ciObject->image_lib->resize()){
   				echo $this->ciObject->image_lib->display_errors();
			}
		} 					
		return $imgOFFERS;
	}
	
	public function _GetPars()
	{
		/* set pars */
		/*
		 * Pars variables
		 * pp - price type
		 * l - page limit
		 * m_c - main currency
		 * a_c - add currency
		 * c_c - client's city
		 * r_c - client's region
		 * cn_c - client's country
		 * c - category rid
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
		$pars['c'] = $this->_categories_current_category_rid;
		$pars['m_c'] = $this->_categories_current_main_curr_rid;
		$pars['a_c'] = $this->_categories_current_add_curr_rid;
		$pars['c_c'] = $this->_categories_current_city_rid;
		$pars['r_c'] = $this->_categories_current_region_rid;
		$pars['cn_c'] = $this->_categories_current_country_rid;
		$pars['sr'] = $this->_categories_current_sort_rule;
		$pars['pp'] = $this->_categories_current_price_type;
		$pars['p'] = $this->_categories_current_page;
		$pars['l'] = $this->STN_categories_offers_quan_per_page;
		$pars['OP'] = $this->_categories_current_uri_assoc;
		return $pars;
	}
	
	public function GetSearchResult()
	{
		$this->objectsArr['categories_category_search_res_title'] = $this->ciObject->lang->line('CATEGORIES_MODULE_SEARCH_RES_TITLE');
		$this->objectsArr['categories_category_search_nores'] = $this->ciObject->lang->line('CATEGORIES_MODULE_SEARCH_NORES');
		if(isset($this->_categories_current_uri_assoc['ss']) && $this->_categories_current_uri_assoc['ss'])
		{
			$this->ciObject->load->library('table');
			$tmpl = array (
        					'table_open'          => '<div id="t_cllist"><table celpadding=0 cellspacing=0 >',
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
			$parsARR = $this->_GetPars();
			$parsARR['ss'] = $this->_categories_current_uri_assoc['ss'];
			$resultARR = $this->ciObject->categories_model->GetSearchResult($parsARR);
			if($resultARR)
			{
				$tableARR = array(); 
				foreach($resultARR as $row)
				{
					$row['searchSTR'] = $this->_categories_current_uri_assoc['ss'];
					$tableARR[] = $this->_RenderSearchResCell($row);
					$this->ciObject->categories_model->SetSearchStat($row);
				}
				$tableARR = $this->ciObject->table->make_columns($tableARR, 2);
				$this->objectsArr['categories_category_search_content'] = $this->ciObject->table->generate($tableARR);
				return $this->ciObject->load->view('modules/categories_module/catsearchres.php',$this->objectsArr, True);
			}
		}
		return $this->ciObject->load->view('modules/categories_module/catsearchnores.php',$this->objectsArr, True); 
	}
	
	public function _RenderSearchResCell($row)
	{
		return $this->ciObject->load->view('modules/categories_module/_cellsearch.php',$row, True);
	}
	
	public function renderTopCategories(){
		$data = array();
		$data['categories_list'] = $this->ciObject->categories_model->getTopCategories($this->topCategoriesQuan);
		foreach($data['categories_list'] as $key=>$cat){
			if($cat->imgName) $data['categories_list'][$key]->imgPath = $this->GetMainMenuIcon($cat); 
			else $data['categories_list'][$key]->imgPath = null;
		}
		return $this->ciObject->load->view('modules/categories_module/main.php',$data, True);	
	}
	
	public function renderTabbedMenu(){
		$data = array();
		$data['categories_list'] = $this->ciObject->categories_model->getTopCategories($this->topTabbedQuan);
		return $this->ciObject->load->view('modules/categories_module/topmenu.php',$data, True);	
	}
	
	public function GetMainMenuIcon($image){
		$imgNAME = $this->STN_categories_icons_images_path.$image->imgRid.'_mini_'.$image->imgName;
		if(file_exists($imgNAME)) return $imgNAME;
		$ifile=fopen($imgNAME, "w");
		fwrite($ifile,$image->image);
		fclose($ifile); 
		$config = array();
		$config['image_library'] = 'GD2';
		$config['source_image'] = $imgNAME;
		$config['create_thumb'] = FALSE;
		$config['width'] = $this->STN_categories_ware_miniicon_width;
		$config['height'] = $this->STN_categories_ware_miniicon_height;
		$this->ciObject->load->library('image_lib');
		$this->ciObject->image_lib->clear();
		$this->ciObject->image_lib->initialize($config);
		if (!$this->ciObject->image_lib->resize()){
    		echo $this->ciObject->image_lib->display_errors();
		}				
		return $imgNAME;
	}
	
	public function getTree(){
		$rows = $this->ciObject->categories_model->GetCategoriesArr();
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