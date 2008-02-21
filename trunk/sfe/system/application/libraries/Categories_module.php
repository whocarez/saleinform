<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
/*
 * Categories module
 * Mazvv 02-05-2007
*/
class Categories_module 
{
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
	private $_categories_current_category_rid;
	private $_categories_current_sort_rule; 
	private $_categories_current_price_type;
	private $_categories_current_main_curr_rid;
	private $_categories_current_add_curr_rid;	
	private $_categories_current_city_rid;
	private $_categories_current_country_rid;
	private $_categories_current_region_rid;
	private $_categories_current_page;
	private $_categories_quan_of_offers;
	
	
	
	public function __construct()
	{
		$this->ciObject = &get_instance();
		$this->ciObject->lang->load('categories_module');
		$this->ciObject->load->helper('inflector');
		$this->ciObject->load->model('categories_model');
		$this->ciObject->load->library('keywords_module');
		$this->ciObject->load->library('contacts_module');
		$this->STN_categories_title = $this->ciObject->lang->line('CATEGORIES_MODULE_TABLE_TITLE');
		$this->objectsArr['categories_title'] = $this->STN_categories_title;
		/* { URI parsed */
		$this->_categories_current_uri_assoc = $this->ciObject->uri->uri_to_assoc(2);
		$this->_categories_current_category_rid = (isset($this->_categories_current_uri_assoc['c']))?$this->_categories_current_uri_assoc['c']:null;
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
	
	public function RenderCategoriesTable()
	{
		$categoriesLIST = $this->ciObject->categories_model->GetCategoriesArr($this->STN_categories_root_cat_rid);
		$quanonCOL = (count($categoriesLIST)%2>0)?(count($categoriesLIST)+1)/2:count($categoriesLIST)/2;
		$this->ciObject->load->helper('array');
		$this->objectsArr['categories_table_random_item'] = random_element($categoriesLIST);
		$this->objectsArr['categories_table_show_all'] = anchor(base_url().index_page().'/categories/sa',
																$this->ciObject->lang->line('CATEGORIES_MODULE_SHOW_ALL_CATEGORIES_TITLE').'<b class="more">&nbsp;</b>',
																array('class'=>'c69', 'style'=>'float: right;'));
		
		$randomCATEGORYIMAGES = $this->ciObject->categories_model->GetCategoryImages($this->objectsArr['categories_table_random_item']['rid'], 'PICTURE');
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
	
	public function RenderCategoriesList($mode='A') # A-alphabetical T-tree
	{
		if($mode=='A') return $this->RenderCategoriesByAlphabetical();
		else return $this->RenderCategoriesByTree();
	}
	
	public function RenderCategoriesByAlphabetical()
	{
		$categoriesLIST = $this->ciObject->categories_model->GetCategoriesArr();
		if(!$categoriesLIST) return FALSE;
		$this->objectsArr['categories_alphabetical_list'] = array();
		$firstLETTER = $prevLETTER = null;
		$index = 0;
		foreach($categoriesLIST as $row)
		{
			
			$firstLETTER = mb_strtoupper(mb_substr($row['name'],0,1,'UTF-8'));
			if($firstLETTER!=$prevLETTER)
			{
				$index++;
				$this->objectsArr['categories_alphabetical_list'][$index]['L'] = $firstLETTER;
				$prevLETTER = $firstLETTER;
			}
			$this->objectsArr['categories_alphabetical_list'][$index][] = $row;
			
		}
		#var_dump($this->objectsArr['categories_alphabetical_list']);
		$this->objectsArr['categories_table_show_all_title'] = $this->ciObject->lang->line('CATEGORIES_MODULE_SHOW_ALL_TITLE');
		$this->objectsArr['categories_table_by_alph_title'] = $this->ciObject->lang->line('CATEGORIES_MODULE_BY_ALPH_TITLE');
		$this->objectsArr['categories_table_by_tree_title'] = $this->ciObject->lang->line('CATEGORIES_MODULE_BY_TREE_TITLE');
		return $this->ciObject->load->view('modules/categories_module/categoriesalph.php',$this->objectsArr, True); 
	}

	public function RenderCategoriesByTree()
	{
		$categoriesLIST = $this->ciObject->categories_model->GetCategoriesArr();
		$this->ciObject->load->plugin('tree');
		if(!$categoriesLIST) return FALSE;
		$forestLIST = _transform2forest($categoriesLIST, 'rid', '_categories_rid');
		$quanonCOL = (count($forestLIST)%2>0)?(count($forestLIST)+1)/2:count($forestLIST)/2;
		$this->objectsArr['categories_tree_list_1c'] = array();
		$this->objectsArr['categories_tree_list_2c'] = array();
		$i = 1;
		foreach($forestLIST as $key=>$row)
		{
			if($i<=$quanonCOL) $this->objectsArr['categories_tree_list_1c'][]=$row;
			else $this->objectsArr['categories_tree_list_2c'][]=$row;
			$i++;
		}
		$this->objectsArr['categories_table_show_all_title'] = $this->ciObject->lang->line('CATEGORIES_MODULE_SHOW_ALL_TITLE');
		$this->objectsArr['categories_table_by_alph_title'] = $this->ciObject->lang->line('CATEGORIES_MODULE_BY_ALPH_TITLE');
		$this->objectsArr['categories_table_by_tree_title'] = $this->ciObject->lang->line('CATEGORIES_MODULE_BY_TREE_TITLE');
		return $this->ciObject->load->view('modules/categories_module/categoriestree.php',$this->objectsArr, True); 
	}
	
	public function RenderCategoryContent()
	{
		if(is_array($this->ciObject->categories_model->GetCategoriesArr($this->_categories_current_category_rid))) return $this->RenderSubcategoriesContent();
		else return $this->RenderCategoryOffers();
	}
	
	public function RenderSubcategoriesContent()
	{
		$categoriesLIST = $this->ciObject->categories_model->GetCategoriesArr();
		$currentCATEGORY = $this->ciObject->categories_model->GetCategoryArr($this->_categories_current_category_rid);
		$currentCATEGORYIMAGES = $this->ciObject->categories_model->GetCategoryImages($this->_categories_current_category_rid, 'ICON');
		if($currentCATEGORYIMAGES)	$this->objectsArr['categories_image_icon'] = $this->GetCategoryImage($currentCATEGORYIMAGES,'ICON');
		else $this->objectsArr['categories_image_icon'] = '';
		$this->ciObject->load->plugin('tree');
		$this->objectsArr['categories_category_node_array'] = array();
		$forest = _transform2forest($categoriesLIST, 'rid', '_categories_rid');
		$currentNODEARR = _getNodeTree($forest, $this->_categories_current_category_rid);
		$childrensQUAN = 0;
		foreach($currentNODEARR as $row) $childrensQUAN += count($row['childNodes']);
		if(!$childrensQUAN) 
		{
			$currentNODEARR = _getNodeTree($forest, $currentCATEGORY['_categories_rid']);
			foreach($currentNODEARR as $key=>$row) if($row['rid']!=$this->_categories_current_category_rid) unset($currentNODEARR[$key]);
		}
		$index = 0;
		foreach($currentNODEARR as $row)
		{
			$quanonCOL = (count($row['childNodes'])%2>0)?(count($row['childNodes'])+1)/2:count($row['childNodes'])/2;
			$this->objectsArr['categories_category_node_array'][$index]['mainLEVEL'] = $row;
			$i = 1;
			$c_1 = array();
			$c_2 = array();
			foreach($row['childNodes'] as $key=>$node)
			{
				if($i<=$quanonCOL) $c_1[]=$node;
				else $c_2[]=$node;
				$i++;
			}
			if(!count($c_1)) $c_1[]=$row; 
			$this->objectsArr['categories_category_node_array'][$index]['1c'] = $c_1;
			$this->objectsArr['categories_category_node_array'][$index]['2c'] = $c_2;
			$index++;
		}
		$this->objectsArr['categories_category_title'] = $this->ciObject->lang->line('CATEGORIES_MODULE_CATEGORY_TITLE');
		$this->objectsArr['categories_current_category_name'] = $currentCATEGORY['name'];
		$this->objectsArr['categories_current_category_descr'] = $currentCATEGORY['descr'];
		return $this->ciObject->load->view('modules/categories_module/catsubcategories.php',$this->objectsArr, True); 
	}
	
	public function RenderCategoryOffers()
	{
		/* generate current URL step by step */
		$currentCATEGORY = $this->ciObject->categories_model->GetCategoryArr($this->_categories_current_category_rid);
		$currentCATEGORYIMAGES = $this->ciObject->categories_model->GetCategoryImages($this->_categories_current_category_rid, 'ICON');
		if($currentCATEGORYIMAGES) $this->objectsArr['categories_image_icon'] = $this->GetCategoryImage($currentCATEGORYIMAGES,'ICON');
		else $this->objectsArr['categories_image_icon'] = '';
		$this->objectsArr['categories_current_category_name'] = $currentCATEGORY['name'];
		$this->objectsArr['categories_current_category_descr'] = $currentCATEGORY['descr'];
		$this->objectsArr['categories_current_category_iscompared'] = $currentCATEGORY['iscompared'];
		$this->objectsArr['categories_current_category_isgrouped'] = $currentCATEGORY['isgrouped'];
		$this->objectsArr['categories_current_category_rid'] = $this->_categories_current_category_rid;
		$this->objectsArr['categories_category_compare_wares_title'] = $this->ciObject->lang->line('CATEGORIES_MODULE_CATEGORY_COMPARE_WARES_TITLE');		
		$this->objectsArr['categories_category_compare_nowares_compare'] = $this->ciObject->lang->line('CATEGORIES_MODULE_CATEGORY_COMPARE_NOWARES_COMPARE');		
		$this->objectsArr['categories_category_compare_prices_title'] = $this->ciObject->lang->line('CATEGORIES_MODULE_CATEGORY_COMPARE_PRICES_TITLE');
		$this->objectsArr['categories_category_compare_title'] = $this->ciObject->lang->line('CATEGORIES_MODULE_CATEGORY_COMPARE_TITLE');
		$this->objectsArr['categories_category_sort_by'] = $this->ciObject->lang->line('CATEGORIES_MODULE_CATEGORY_SORT_BY');
		$this->objectsArr['categories_category_sort_by_name'] = $this->ciObject->lang->line('CATEGORIES_MODULE_CATEGORY_SORT_BY_NAME');
		$this->objectsArr['categories_category_sort_by_popular'] = $this->ciObject->lang->line('CATEGORIES_MODULE_CATEGORY_SORT_BY_POPULAR');
		$this->objectsArr['categories_category_sort_by_rating'] = $this->ciObject->lang->line('CATEGORIES_MODULE_CATEGORY_SORT_BY_RATING');
		$this->objectsArr['categories_category_sort_by_minprice'] = $this->ciObject->lang->line('CATEGORIES_MODULE_CATEGORY_SORT_BY_MINPRICE');
		$this->objectsArr['categories_category_sort_by_avgprice'] = $this->ciObject->lang->line('CATEGORIES_MODULE_CATEGORY_SORT_BY_AVGPRICE');
		$this->objectsArr['categories_category_sort_by_price'] = $this->ciObject->lang->line('CATEGORIES_MODULE_CATEGORY_SORT_BY_PRICE');		
		$this->objectsArr['categories_category_column_name'] = $this->ciObject->lang->line('CATEGORIES_MODULE_CATEGORY_COLUMN_NAME');
		$this->objectsArr['categories_category_column_rating'] = $this->ciObject->lang->line('CATEGORIES_MODULE_CATEGORY_COLUMN_RATING');
		$this->objectsArr['categories_category_column_prices'] = $this->ciObject->lang->line('CATEGORIES_MODULE_CATEGORY_COLUMN_PRICES');
		$this->objectsArr['categories_category_price_type'] = $this->ciObject->lang->line('CATEGORIES_MODULE_CATEGORY_PRICE_TYPE');
		$PARS = $this->_GetPars();
		$PARS['c']=$currentCATEGORY;
		$this->_RenderSortByDropdown($currentCATEGORY);	
		$resultARR = $this->ciObject->categories_model->GetOffersByCategory($PARS);
		if (!$resultARR) 
		{
			$this->objectsArr['categories_category_offers_table']=$this->ciObject->lang->line('CATEGORIES_MODULE_CATEGORY_NO_OFFERS');
			if(count($this->_categories_current_uri_assoc)>1) $this->objectsArr['categories_category_offers_table']=$this->ciObject->lang->line('CATEGORIES_MODULE_CATEGORY_NO_FINDED');	
			return $this->ciObject->load->view('modules/categories_module/catnooffers.php',$this->objectsArr, True); 
		}
		else
		{
			$this->ciObject->load->library('pop_module');
			$this->ciObject->pop_module->_SetCategoryPop();
			$this->_RenderPrTypesDropdown($currentCATEGORY);
			$this->ciObject->load->library('table');
			$tmpl = array (
        	            'table_open'          => '<div id="t_offers"><table celpadding=0 cellspacing=0 >',
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
			$this->_categories_quan_of_offers = count($resultARR);
			$resultARR = array_slice($resultARR, $this->_categories_current_page, $this->STN_categories_offers_quan_per_page);
			$this->objectsArr['categories_category_guide_link'] = ($resultARR[0]['guideRID'])?anchor(site_url().'/guides/c/'.$this->_categories_current_category_rid, $this->ciObject->lang->line('CATEGORIES_MODULE_CATEGORY_GUIDE_LINK')):'';
			foreach($resultARR as $row)
			{
				$tableROW = array();
				$tableROW[] = $this->_RenderCompareCell($row);
				$tableROW[] = $this->_RenderImageCell($row);
				$tableROW[] = $this->_RenderNameCell($row);
				$tableROW[] = ($row['isgrouped'])?$this->_RenderRatingCell($row):$this->_RenderCompanyRatingCell($row);
				$tableROW[] = $this->_RenderPriceCell($row);
				$this->ciObject->table->add_row($tableROW);
			}
			
			$this->objectsArr['categories_category_offers_table']=$this->ciObject->table->generate();
			$this->objectsArr['categories_category_offers_pagination']=$this->GetOffersPagination();
		}
		return $this->ciObject->load->view('modules/categories_module/catoffers.php',$this->objectsArr, True); 
	}
	
	public function GetCategoryImage($imagesROWS, $typeP = 'ICON')
	{
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

	public function GetWareImage($imagesROWS)
	{
		# get random image
		$this->ciObject->load->helper('array');
		$this->ciObject->load->library('image_lib');
		$this->ciObject->image_lib->clear();
		$image = random_element($imagesROWS);

		foreach($imagesROWS as $image)
		{
			$imgORIGINAL = $this->STN_categories_ware_images_original_path.$image['rid'].'_'.$image['name'];
			$imgOFFERS  = $this->STN_categories_ware_images_offers_path.$image['rid'].'_'.$image['name'];
			if(!file_exists($imgORIGINAL))
			{
				$ifile=fopen($imgORIGINAL, "w");
				fwrite($ifile, $image['image']);
				fclose($ifile);
			} 					
			if(!file_exists($imgOFFERS))
			{
				$config = array();
				$config['image_library'] = 'GD2';
				$config['source_image'] = $imgORIGINAL;
				$config['new_image'] = $imgOFFERS;
				$config['create_thumb'] = FALSE;
				$config['width'] = $this->STN_categories_ware_images_offers_width;
				$config['height'] = $this->STN_categories_ware_images_offers_height;
				$this->ciObject->image_lib->initialize($config);
				if (!$this->ciObject->image_lib->resize())
				{
    				echo $this->ciObject->image_lib->display_errors();
				}
			} 					
		}
		$image = random_element($imagesROWS);
		$imgNAME = $this->STN_categories_ware_images_offers_path.$image['rid'].'_'.$image['name'];
		return base_url().$imgNAME;
	}
	
	public function _RenderSortByDropdown($currentCATEGORY)
	{
		$currURI = $this->_categories_current_uri_assoc;
		unset($currURI['sr']); unset($currURI['p']);
		$this->objectsArr['categories_category_current_sort'] = base_url().index_page()."/categories/".$this->ciObject->uri->assoc_to_uri($currURI).'/sr/'.$this->_categories_current_sort_rule;
		if($currentCATEGORY['isgrouped'])
		{
			$this->objectsArr['categories_category_sort_options'] = array(
                  														base_url().index_page()."/categories/".$this->ciObject->uri->assoc_to_uri($currURI).'/sr/nm'=>$this->objectsArr['categories_category_sort_by_name'],
                  														base_url().index_page()."/categories/".$this->ciObject->uri->assoc_to_uri($currURI).'/sr/rtn'=>$this->objectsArr['categories_category_sort_by_rating'],
                  														base_url().index_page()."/categories/".$this->ciObject->uri->assoc_to_uri($currURI).'/sr/mpr'=>$this->objectsArr['categories_category_sort_by_minprice'],
																		base_url().index_page()."/categories/".$this->ciObject->uri->assoc_to_uri($currURI).'/sr/apr'=>$this->objectsArr['categories_category_sort_by_avgprice']
                														);
		}
		else
			$this->objectsArr['categories_category_sort_options'] = array(
                  														base_url().index_page()."/categories/".$this->ciObject->uri->assoc_to_uri($currURI).'/sr/nm'=>$this->objectsArr['categories_category_sort_by_name'],
																		base_url().index_page()."/categories/".$this->ciObject->uri->assoc_to_uri($currURI).'/sr/pr'=>$this->objectsArr['categories_category_sort_by_price']
                														);
		$this->objectsArr['categories_category_sort_by_js'] = 'id="w_sortby" onChange="window.location.href=(document.getElementById(\'w_sortby\').options[selectedIndex].value)"';
		return;
	}

	public function _RenderPrTypesDropdown($currentCATEGORY)
	{
		$currURI = $this->_categories_current_uri_assoc;
		unset($currURI['pp']); unset($currURI['p']);
		$prTYPES = $this->ciObject->categories_model->GetCategoryPriceTypes($currentCATEGORY['rid']);
		$this->objectsArr['categories_category_price_types_options'] = array();
		foreach($prTYPES as $type)
		{ 
			$this->objectsArr['categories_category_price_types_options'][base_url().index_page()."/categories/".$this->ciObject->uri->assoc_to_uri($currURI).'/pp/'.$type['cod']]=$type['name'];
			if($type['cod']==$this->_categories_current_price_type) $this->objectsArr['categories_category_current_prtype']=base_url().index_page()."/categories/".$this->ciObject->uri->assoc_to_uri($currURI).'/pp/'.$type['cod'];
		}
		$this->objectsArr['categories_category_prtype_js']='id="w_prtype" onChange="window.location.href=(document.getElementById(\'w_prtype\').options[selectedIndex].value)"'; 
	}
	
	public function _RenderCompareCell($row)
	{
		return ($row['iscompared'])?$this->ciObject->load->view('modules/categories_module/_cellcompare.php',$row, True):'';
	}

	public function _RenderImageCell($row)
	{
		$currentWAREIMAGES = ($row['_wares_rid'])?$this->ciObject->categories_model->GetWareImages($row['_wares_rid']):null;
		if(!$currentWAREIMAGES && $row['prItemIMGS']) {
			$currentWAREIMAGES = $this->ciObject->categories_model->GetItemImages($row['prItemIMGS']);
		}
		if($currentWAREIMAGES)
		{ 
			$row['categories_category_ware_image'] = $this->GetWareImage($currentWAREIMAGES);
		} 
		else $row['categories_category_ware_image']=base_url().'/images/no_image.png';
		return $this->ciObject->load->view('modules/categories_module/_cellimage.php',$row, True);
	}
	
	public function _RenderNameCell($row)
	{
		$this->ciObject->load->helper('text');
		$row['categories_category_look_ware_title'] = ($row['_wares_rid'] && $row['isgrouped'])?anchor('/ware/c/'.$row['_categories_rid'].'/d/'.$row['_brands_rid'].'/m/'.$row['model_alias'].'/pp/'.$row['prCOD'], $this->ciObject->lang->line('CATEGORIES_MODULE_CATEGORY_LOOK_WARE_TITLE')):'';
		//$row['categories_category_short_descr'] = ($row['short_descr'])?character_limiter($row['short_descr'], 150):$row['wareNAME'];
		$row['categories_category_short_descr'] = ($row['wareSDESCR'])?character_limiter($row['wareSDESCR']):$row['short_descr'];
		$row['categories_category_ware_name'] = ($row['isgrouped'])?anchor('/ware/c/'.$row['_categories_rid'].'/o/'.$row['_brands_rid'].'/m/'.$row['model_alias'].'/pp/'.$row['prCOD'], $row['wareNAME']):anchor($row['link_ware'], $row['wareNAME']);
		$row['categories_category_button_link'] = ($row['isgrouped'])?base_url().index_page().'/ware/c/'.$row['_categories_rid'].'/o/'.$row['_brands_rid'].'/m/'.$row['model_alias'].'/pp/'.$row['prCOD']:$row['link_ware'];
		$row['categories_category_info_link'] = (!$row['isgrouped'])?anchor(base_url().index_page().'/clients/c/'.$row['clientRID'], $row['clientNAME']):'';
		$row['categories_category_ware_clientinfo'] = (!$row['isgrouped'])?$row['cityNAME'].', '.$row['clientSTREET'].', '.$row['clientBUILD'].'<br>'.$row['clientWPHONES']:'';
		return $this->ciObject->load->view('modules/categories_module/_cellname.php',$row, True);
	}
	
	public function _RenderRatingCell($row)
	{
		$row['write_rewiev_title'] = anchor(base_url().index_page().'/wareuops/c/'.$this->_categories_current_category_rid.'/b/'.$row['_brands_rid'].'/m/'.$row['model_alias'], $this->ciObject->lang->line('CATEGORIES_MODULE_WARE_REWIEV_TITLE'));	
		$row['ware_rewievs_title'] = anchor('/ware/c/'.$row['_categories_rid'].'/op/'.$row['_brands_rid'].'/m/'.$row['model_alias'].'/pp/'.$row['prCOD'], $this->ciObject->lang->line('CATEGORIES_MODULE_WARE_REWIEVES_TITLE'));
		$row['ware_erewievs_title'] = $this->ciObject->lang->line('CATEGORIES_MODULE_WARE_EREWIEVES_TITLE');
		if(!$row['isgrouped'] || !$row['_wares_rid']) return '&nbsp;';
		return $this->ciObject->load->view('modules/categories_module/_cellrating.php',$row, True);
	}

	public function _RenderCompanyRatingCell($row)
	{
		$row['write_rewiev_title'] = anchor(base_url().index_page().'/cluops/c/'.$row['clientRID'], $this->ciObject->lang->line('CATEGORIES_MODULE_WARE_REWIEV_TITLE'));	
		$row['ware_rewievs_title'] = anchor(base_url().index_page().'/clients/o/'.$row['clientRID'], $this->ciObject->lang->line('CATEGORIES_MODULE_WARE_REWIEVES_TITLE'));
		return $this->ciObject->load->view('modules/categories_module/_cellclientrating.php',$row, True);
	}
	
	public function _RenderPriceCell($row)
	{
		$row['ware_offers_quan_title'] = $this->ciObject->lang->line('CATEGORIES_MODULE_WARE_OFFERS_QUAN_TITLE');
		$row['ware_offers_buy_title'] = $this->ciObject->lang->line('CATEGORIES_MODULE_CATEGORY_BUY_WARE_TITLE');
		$row['categories_category_compare_prices_title'] = $this->ciObject->lang->line('CATEGORIES_MODULE_CATEGORY_COMPARE_PRICES_TITLE');
		$row['categories_category_button_link'] = ($row['isgrouped'])?base_url().index_page().'/ware/c/'.$row['_categories_rid'].'/o/'.$row['_brands_rid'].'/m/'.$row['model_alias'].'/pp/'.$row['prCOD']:$row['link_ware'];
		$button_data = array(
              			'name'=>'w_price_btn',
              			'id'=>'w_price_btn',
              			'value'=>$row['isgrouped']?$row['categories_category_compare_prices_title']:$row['ware_offers_buy_title'],
              			'style'=>'float:right; border: 0px;margin-top: 0px; line-height: 17px; text-align: center; width: 80px;',
						'class'=>'btn',
						'type'=>'button',
						/*'target'=>$row['isgrouped']?'':'_blank',*/
						'onclick'=>"window.location.href='".addslashes($row['categories_category_button_link'])."'"		  	
            			);
		$row['categories_category_ware_button']=form_input($button_data);	
		return $this->ciObject->load->view('modules/categories_module/_cellprice.php',$row, True);
	}

	public function GetOffersPagination()
	{
		$paginationCONFIG = array('total_rows'=>$this->_categories_quan_of_offers, 
									'per_page'=>$this->STN_categories_offers_quan_per_page,
									'num_links'=>$this->STN_categories_offers_pagination_num_links);
		unset($this->_categories_current_uri_assoc['p']);
		$categories_category_pages_title=$this->ciObject->lang->line('CATEGORIES_MODULE_CATEGORY_PAGES_TITLE');
		$paginationCONFIG['base_url']=base_url().index_page()."/categories/".$this->ciObject->uri->assoc_to_uri($this->_categories_current_uri_assoc).'/p/';
		$paginationCONFIG['uri_segment']=count($this->_categories_current_uri_assoc)*2+3;
		$paginationCONFIG['full_tag_open'] = '<div style="float: right; color: #888888; font-size: 8pt;font-weight: bold;margin-bottom: 10px;padding-top: 5px; padding-bottom: 5px;">'.$categories_category_pages_title;
		$paginationCONFIG['full_tag_close'] = '</div>';
		$paginationCONFIG['first_link'] = $this->ciObject->lang->line('CATEGORIES_MODULE_PAGINATION_FIRST_LINK_TITLE');
		$paginationCONFIG['last_link'] = $this->ciObject->lang->line('CATEGORIES_MODULE_PAGINATION_LAST_LINK_TITLE');
		$paginationCONFIG['next_link'] = '&gt&gt';
		$paginationCONFIG['prev_link'] = '&lt&lt';
		$paginationCONFIG['cur_tag_open'] = '<b> [';
		$paginationCONFIG['cur_tag_close'] = ']<b>';

		$this->ciObject->load->library('pagination');
		$this->ciObject->pagination->initialize($paginationCONFIG);
		return $this->ciObject->pagination->create_links();
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
	
}
?>