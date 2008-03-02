<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
/*
 * Ware module
 * Mazvv 24-05-2007
*/
class Ware_module 
{
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
	private $STN_categories_ware_original_images_path = 'images/wares/original_size/';
	private $STN_categories_ware_details_width = 150; 
	private $STN_categories_ware_details_height = 150;
	private $STN_categories_ware_sdetails_width = 50;
	private $STN_categories_ware_sdetails_height = 50;
	private $STN_categories_ware_minidetails_width = 40;
	private $STN_categories_ware_minidetails_height = 40;
	private $STN_categories_default_prtype_code = 'R';
	private $_ware_current_uri_assoc;
	private $_ware_current_sort_rule; 
	private $_ware_current_category_rid;
	private $_ware_current_brands_rid;
	private $_ware_current_model_alias;
	private $_ware_current_price_type;
	private $_ware_current_mode;
	private $_ware_current_main_curr_rid;
	private $_ware_current_add_curr_rid;	
	private $_ware_current_city_rid;
	private $_ware_current_country_rid;
	private $_ware_current_region_rid;
	private $_ware_current_page;
	private $_ware_quan_of_offers;
	
	public function __construct()
	{
		$this->ciObject = &get_instance();
		$this->ciObject->lang->load('ware_module');
		$this->ciObject->load->model('ware_model');
		
		/* { URI parsed */
		$this->_ware_current_uri_assoc = $this->ciObject->uri->uri_to_assoc(2);
		$this->_ware_current_sort_rule = (isset($this->_ware_current_uri_assoc['sr']))?$this->_ware_current_uri_assoc['sr']:$this->STN_ware_default_sort_rule_title;
		$this->_ware_current_category_rid = (isset($this->_ware_current_uri_assoc['c']))?$this->_ware_current_uri_assoc['c']:null;
		if(isset($this->_ware_current_uri_assoc['o'])) 
		{
			$this->_ware_current_brands_rid = $this->_ware_current_uri_assoc['o'];
			$this->_ware_current_mode = 'O';
		}
		else if((isset($this->_ware_current_uri_assoc['d'])))
		{
			$this->_ware_current_brands_rid = $this->_ware_current_uri_assoc['d'];
			$this->_ware_current_mode = 'D';
		}
		else if((isset($this->_ware_current_uri_assoc['op'])))
		{
			$this->_ware_current_brands_rid = $this->_ware_current_uri_assoc['op'];
			$this->_ware_current_mode = 'OP';
		}
		else if((isset($this->_ware_current_uri_assoc['r'])))
		{
			$this->_ware_current_brands_rid = $this->_ware_current_uri_assoc['r'];
			$this->_ware_current_mode = 'R';
		}
		else 
		{
			$this->_ware_current_brands_rid = null;
			$this->_ware_current_mode = null;
		}
		$this->_ware_current_model_alias = (isset($this->_ware_current_uri_assoc['m']))?$this->_ware_current_uri_assoc['m']:null;
		$this->_ware_current_price_type = (isset($this->_ware_current_uri_assoc['pp']))?$this->_ware_current_uri_assoc['pp']:$this->STN_categories_default_prtype_code;
		$currentSESS = $this->ciObject->session->userdata('_SI_');
		$this->_ware_current_city_rid = $currentSESS['SI_SETTINGS']['_CITY_RID_'];
		$this->_ware_current_region_rid = $currentSESS['SI_SETTINGS']['_REGION_RID_'];
		$this->_ware_current_country_rid = $currentSESS['SI_SETTINGS']['_COUNTRY_RID_'];
		$this->_ware_current_main_curr_rid = $currentSESS['SI_SETTINGS']['_MAIN_CURR_RID_'];
		$this->_ware_current_add_curr_rid = $currentSESS['SI_SETTINGS']['_ADD_CURR_RID_'];
		$this->_ware_current_page = (isset($this->_ware_current_uri_assoc['p']))?$this->_ware_current_uri_assoc['p']:null;
		/* } URI parsed */
		
		$this->objectsArr['ware_compare_prices_title']=$this->ciObject->lang->line('WARE_MODULE_COMPARE_PRICES_TITLE');
		$this->objectsArr['ware_detailed_info_title']=$this->ciObject->lang->line('WARE_MODULE_DETAILED_INFO_TITLE');
		$this->objectsArr['ware_users_opinions_title']=$this->ciObject->lang->line('WARE_MODULE_USERS_OPINIONS_TITLE');
		$this->objectsArr['ware_prices_range_title']=$this->ciObject->lang->line('WARE_MODULE_PRICES_RANGE_TITLE');
		$this->objectsArr['ware_user_rating_title']=$this->ciObject->lang->line('WARE_MODULE_USER_RATING_TITLE');
		$this->objectsArr['ware_reviews_info_title']=$this->ciObject->lang->line('WARE_MODULE_REVIEWS_INFO_TITLE');
		$this->objectsArr['ware_compare_prices_tab_title']=$this->ciObject->lang->line('WARE_MODULE_COMPARE_PRICES_TAB_TITLE');
		$this->objectsArr['ware_detailed_info_tab_title']=$this->ciObject->lang->line('WARE_MODULE_DETAILED_INFO_TAB_TITLE');
		$this->objectsArr['ware_users_opinions_tab_title']=$this->ciObject->lang->line('WARE_MODULE_USERS_OPINIONS_TAB_TITLE');
		$this->objectsArr['ware_reviews_info_tab_title']=$this->ciObject->lang->line('WARE_MODULE_REVIEWS_INFO_TAB_TITLE');
		$this->objectsArr['ware_ware_write_opinions_title']=$this->ciObject->lang->line('WARE_MODULE_WARE_WRITE_OPINIONS_TITLE');
		$this->objectsArr['ware_offers_price_type_title']=$this->ciObject->lang->line('WARE_MODULE_OFFERS_PRICE_TYPE_TITLE');
		$this->objectsArr['ware_offers_client_read_more']=$this->ciObject->lang->line('WARE_MODULE_OFFERS_CLIENT_READ_MORE');
	}
	
	public function RenderWareInfo()
	{
		$this->ciObject->load->library('pop_module');
		$this->ciObject->pop_module->_SetBrandPop($this->_ware_current_brands_rid);
		if($this->_ware_current_mode=='O')
		{
			$parsARR = array();
			$parsARR['m_c'] = $this->_ware_current_main_curr_rid;
			$parsARR['a_c'] = $this->_ware_current_add_curr_rid;
			$parsARR['c_c'] = $this->_ware_current_city_rid;
			$parsARR['r_c'] = $this->_ware_current_region_rid;
			$parsARR['cn_c'] = $this->_ware_current_country_rid;
			$parsARR['pp'] = $this->_ware_current_price_type;
			$parsARR['sr'] = $this->_ware_current_sort_rule;
			$parsARR['catRID'] = $this->_ware_current_category_rid;
			$parsARR['brandsRID'] = $this->_ware_current_brands_rid;
			$parsARR['modelALIAS'] = $this->_ware_current_model_alias;
			$resultARR = $this->ciObject->ware_model->GetWareOffers($parsARR);
			if(!$resultARR) redirect(base_url(), 'refresh');
			$this->_ware_quan_of_offers = count($resultARR);
			$offset = $this->_ware_current_page;
			$this->objectsArr['ware_offers_header']=$this->RenderWareOffersHeader($resultARR);
			$this->objectsArr['ware_offers_header_sortby_dropdown'] = $this->RenderSortByDropdown();
			$resultARR = array_slice($resultARR, $offset, $this->STN_ware_default_page_limit);
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
			foreach($resultARR as $row)
			{
				$tableROW = array();
				$tableROW[] = $this->_RenderCompanyInfoCell($row);
				$tableROW[] = $this->_RenderOfferStockCell($row);
				$tableROW[] = $this->_RenderCompanyRatingCell($row);
				$tableROW[] = $this->_RenderCompanyPriceCell($row);
				$this->ciObject->table->add_row($tableROW);
			}
			
			$this->objectsArr['ware_offers_table']=$this->ciObject->table->generate();
			$this->objectsArr['ware_offers_pagination']=$this->GetOffersPagination();
			$this->GetTabsLinks();			
			return $this->ciObject->load->view('modules/ware_module/wareoffers.php',$this->objectsArr, True);
		}
		if($this->_ware_current_mode=='D')
		{
			$parsARR = array();
			$parsARR['m_c'] = $this->_ware_current_main_curr_rid;
			$parsARR['a_c'] = $this->_ware_current_add_curr_rid;
			$parsARR['c_c'] = $this->_ware_current_city_rid;
			$parsARR['r_c'] = $this->_ware_current_region_rid;
			$parsARR['cn_c'] = $this->_ware_current_country_rid;
			$parsARR['pp'] = $this->_ware_current_price_type;
			$parsARR['sr'] = $this->_ware_current_sort_rule;
			$parsARR['catRID'] = $this->_ware_current_category_rid;
			$parsARR['brandsRID'] = $this->_ware_current_brands_rid;
			$parsARR['modelALIAS'] = $this->_ware_current_model_alias;
			$resultARR = $this->ciObject->ware_model->GetWareOffers($parsARR);
			if(!$resultARR) redirect(base_url(), 'refresh');
			$this->objectsArr['ware_offers_header']=$this->RenderWareOffersHeader($resultARR);
			$resultARR = $this->ciObject->ware_model->GetWareDetails($parsARR);
			if(!$resultARR) $resultARR=array();
			$emptyFLAG = true;
			foreach($resultARR as $row){if($row['value']!==null) {$emptyFLAG=false; break;}}
			$this->objectsArr['ware_offers_details_flag']=$emptyFLAG;
			$this->ciObject->load->plugin('tree');
			$this->objectsArr['ware_offers_details_noinformation'] = $this->ciObject->lang->line('WARE_MODULE_OFFERS_DETAILS_NO_INFORMATION');
			$this->objectsArr['ware_offers_details_forest'] = _transform2forest($resultARR, 'rid', '_catpars_rid');
			$this->GetTabsLinks();
			return $this->ciObject->load->view('modules/ware_module/waredetails.php',$this->objectsArr, True);
		} 
		if($this->_ware_current_mode=='OP')
		{
			$parsARR = array();
			$parsARR['m_c'] = $this->_ware_current_main_curr_rid;
			$parsARR['a_c'] = $this->_ware_current_add_curr_rid;
			$parsARR['c_c'] = $this->_ware_current_city_rid;
			$parsARR['r_c'] = $this->_ware_current_region_rid;
			$parsARR['cn_c'] = $this->_ware_current_country_rid;
			$parsARR['pp'] = $this->_ware_current_price_type;
			$parsARR['sr'] = $this->_ware_current_sort_rule;
			$parsARR['catRID'] = $this->_ware_current_category_rid;
			$parsARR['brandsRID'] = $this->_ware_current_brands_rid;
			$parsARR['modelALIAS'] = $this->_ware_current_model_alias;
			$resultARR = $this->ciObject->ware_model->GetWareOffers($parsARR);
			$this->objectsArr['ware_offers_header']=$this->RenderWareOffersHeader($resultARR);
			$resultARR = $this->ciObject->ware_model->GetWareOpinions($parsARR);
			$this->objectsArr['ware_offers_opinions_information'] = $this->ciObject->lang->line('WARE_MODULE_OFFERS_OPINIONS_NO_INFORMATION');
			if($resultARR) 
			{
				$this->objectsArr['ware_offers_opinions_information'] = '';
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
				foreach($resultARR as $row)
				{
					$this->ciObject->table->clear();
					$tableROW = array();
					$row['ware_opinion_message_title'] = $this->ciObject->lang->line('WARE_MODULE_OFFERS_OPINIONS_MESSAGE_TITLE');					
					//$tableROW[] = $this->_RenderOpinionTitleCell($row);
					$tableROW[] = $this->_RenderOpinionNameDateCell($row);
					$this->ciObject->table->add_row($tableROW);
					$tableROW = array();
					$row['ware_opinion_message_title'] = $this->ciObject->lang->line('WARE_MODULE_OFFERS_OPINIONS_MARK_TITLE');					
					//$tableROW[] = $this->_RenderOpinionTitleCell($row);
					$tableROW[] = $this->_RenderOpinionMarkCell($row);
					$this->ciObject->table->add_row($tableROW);
					$tableROW = array();
					$row['ware_opinion_message_title'] = $this->ciObject->lang->line('WARE_MODULE_OFFERS_OPINIONS_OPINION_TITLE');					
					//$tableROW[] = $this->_RenderOpinionTitleCell($row);
					$tableROW[] = $this->_RenderOpinionContentCell($row);
					$this->ciObject->table->add_row($tableROW);
					$this->objectsArr['ware_offers_opinions_information'] .= $this->ciObject->table->generate();
				}
			}
			$this->GetTabsLinks();
			return $this->ciObject->load->view('modules/ware_module/wareuopinions.php',$this->objectsArr, True); 
		}
		if($this->_ware_current_mode=='R')
		{
			$parsARR = array();
			$parsARR['m_c'] = $this->_ware_current_main_curr_rid;
			$parsARR['a_c'] = $this->_ware_current_add_curr_rid;
			$parsARR['c_c'] = $this->_ware_current_city_rid;
			$parsARR['r_c'] = $this->_ware_current_region_rid;
			$parsARR['cn_c'] = $this->_ware_current_country_rid;
			$parsARR['pp'] = $this->_ware_current_price_type;
			$parsARR['sr'] = $this->_ware_current_sort_rule;
			$parsARR['catRID'] = $this->_ware_current_category_rid;
			$parsARR['brandsRID'] = $this->_ware_current_brands_rid;
			$parsARR['modelALIAS'] = $this->_ware_current_model_alias;
			$parsARR['currREVIEW'] = (isset($this->_ware_current_uri_assoc['wr']))?$this->_ware_current_uri_assoc['wr']:null;
			$resultARR = $this->ciObject->ware_model->GetWareOffers($parsARR);
			$this->objectsArr['ware_offers_header']=$this->RenderWareOffersHeader($resultARR);
			$resultARR = $this->ciObject->ware_model->GetWareReviews($parsARR);
			$this->objectsArr['ware_offers_reviews_information'] = $this->ciObject->lang->line('WARE_MODULE_OFFERS_REVIEWS_NO_INFORMATION');
			$this->objectsArr['ware_offers_reviews_read_more'] = $this->ciObject->lang->line('WARE_MODULE_OFFERS_REVIEWS_READ_MORE');
			if($resultARR) 
			{
				$this->ciObject->load->library('table');
				$tmpl = array (
        	    	        'table_open'          => '<div id="t_wreview"><table celpadding=5 cellspacing=0 >',
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
				$this->ciObject->load->helper('text');
				if($parsARR['currREVIEW'])
				{
					$this->objectsArr['ware_offers_reviews_information'] = $this->_RenderReviewContent($resultARR[0]);				
				}
				else
				{
					foreach($resultARR as $row)
					{
						$tableROW = array();
						$suffix = '...<br><br>'.anchor(base_url().index_page().'/ware/'.$this->ciObject->uri->assoc_to_uri($this->_ware_current_uri_assoc).'/wr/'.$row['rid'], $this->objectsArr['ware_offers_reviews_read_more']);
						$row['review'] = character_limiter($row['review'], 250, $suffix);
						$tableROW[] = $this->_RenderReviewDateCell($row);
						$tableROW[] = $this->_RenderReviewContent($row); 
						$this->ciObject->table->add_row($tableROW);
					}
					$this->objectsArr['ware_offers_reviews_information'] = $this->ciObject->table->generate();
				}
			}
			$this->GetTabsLinks();
			return $this->ciObject->load->view('modules/ware_module/warereviews.php',$this->objectsArr, True);
		} 
	}

	public function RenderWareOffersHeader($resultARR)
	{
		$this->ciObject->load->helper('text');
		if(!$resultARR) return '';
		$this->objectsArr['ware_offers_header_wares_rid'] = $resultARR[0]['_wares_rid'];
		$this->ciObject->load->library('pop_module');
		$this->ciObject->pop_module->_SetWarePop($this->objectsArr['ware_offers_header_wares_rid']);
		$minbasePRICE = $resultARR[0]['minbasePRICE'];
		$maxbasePRICE = $resultARR[0]['maxbasePRICE'];
		$minaddPRICE = $resultARR[0]['minaddPRICE'];
		$maxaddPRICE = $resultARR[0]['maxaddPRICE'];
		$this->objectsArr['ware_offers_header_prtype'] = $resultARR[0]['prtypeNAME'];
		$this->objectsArr['ware_offers_header_warerating'] = $resultARR[0]['wareRATING'];
		$this->objectsArr['ware_offers_header_wareopinions'] = $resultARR[0]['wareOPINIONS'];
		$this->objectsArr['ware_offers_header_addendword'] = $resultARR[0]['addendWORD'];
		$this->objectsArr['ware_offers_header_baseendword'] = $resultARR[0]['baseendWORD'];
		$this->objectsArr['ware_offers_header_warename'] = $resultARR[0]['wareNAME'];
		$this->objectsArr['ware_offers_header_ware_descr'] = character_limiter(($resultARR[0]['wareSDESCR'])?$resultARR[0]['wareSDESCR']:$resultARR[0]['short_descr'], 256);
		$this->objectsArr['ware_offers_header_warereviews'] = $resultARR[0]['wareREWIEVS'];
		$this->GetTabsLinks();
		foreach($resultARR as $row) 
		{
			if($row['minbasePRICE']<$minbasePRICE)$minbasePRICE=$row['minbasePRICE'];
			if($row['minaddPRICE']<$minaddPRICE)$minaddPRICE=$row['minaddPRICE'];
			if($row['maxbasePRICE']>$maxbasePRICE)$maxbasePRICE=$row['maxbasePRICE'];
			if($row['maxaddPRICE']>$maxaddPRICE)$maxaddPRICE=$row['maxaddPRICE'];
		}
		$this->objectsArr['ware_offers_header_minbase_price'] = $minbasePRICE;
		$this->objectsArr['ware_offers_header_minadd_price'] = $minaddPRICE;
		$this->objectsArr['ware_offers_header_maxbase_price'] = $maxbasePRICE;
		$this->objectsArr['ware_offers_header_maxadd_price'] = $maxaddPRICE;
		$currentWAREIMAGES = $this->ciObject->ware_model->GetWareImages($row['_wares_rid']);
		if(!$currentWAREIMAGES) $currentWAREIMAGES = $this->ciObject->ware_model->GetItemImages($row['prItemIMGS']);
		if($currentWAREIMAGES) $this->objectsArr['ware_offers_header_ware_image']=$this->GetWareImage($currentWAREIMAGES);
		else $this->objectsArr['ware_offers_header_ware_image'] = null;
		$this->objectsArr['ware_offers_header_img_icons'] = array();
		if(count($currentWAREIMAGES)>1)
		{
			foreach($currentWAREIMAGES as $row) $this->objectsArr['ware_offers_header_img_icons'][] = base_url().$this->STN_categories_ware_details_simages_path.$row['rid'].'_'.$row['name'];			
		}
		$this->objectsArr['ware_offers_header_rewievs_title'] = ($this->objectsArr['ware_offers_header_wareopinions'])?anchor($this->objectsArr['ware_offers_opinions_link'], $this->ciObject->lang->line('CATEGORIES_MODULE_WARE_REWIEVES_TITLE')):$this->ciObject->lang->line('CATEGORIES_MODULE_WARE_REWIEVES_TITLE');
		$this->objectsArr['ware_offers_header_rewievs_quan_title'] = ($this->objectsArr['ware_offers_header_warereviews'])?anchor($this->objectsArr['ware_offers_reviews_link'], $this->ciObject->lang->line('WARE_MODULE_WARE_REWIEVES_QUAN_TITLE')):$this->ciObject->lang->line('WARE_MODULE_WARE_REWIEVES_QUAN_TITLE');
		$this->objectsArr['ware_offers_header_sortby_title'] = $this->ciObject->lang->line('WARE_MODULE_OFFERS_SORT_BY_TITLE');
		$this->objectsArr['ware_offers_header_write_opinions']=anchor(base_url().index_page().'/wareuops/c/'.$this->_ware_current_category_rid.'/b/'.$this->_ware_current_brands_rid.'/m/'.$this->_ware_current_model_alias, $this->ciObject->lang->line('WARE_MODULE_WARE_WRITE_OPINIONS_TITLE'));
		return $this->ciObject->load->view('modules/ware_module/offersheader.php',$this->objectsArr, True);
	}

	public function RenderSortByDropDown()
	{
		$currURI = $this->_ware_current_uri_assoc;
		unset($currURI['sr']);
		$this->objectsArr['ware_offers_header_sortby_name'] = $this->ciObject->lang->line('WARE_MODULE_OFFERS_SORT_BY_NAME');			
		$this->objectsArr['ware_offers_header_sortby_rating'] = $this->ciObject->lang->line('WARE_MODULE_OFFERS_SORT_BY_RATING');	
		$this->objectsArr['ware_offers_header_sortby_price'] = $this->ciObject->lang->line('WARE_MODULE_OFFERS_SORT_BY_PRICE');
		$this->objectsArr['ware_offers_header_sort_options'] = array(
               														base_url().index_page()."/ware/".$this->ciObject->uri->assoc_to_uri($currURI).'/sr/nm'=>$this->objectsArr['ware_offers_header_sortby_name'],
																	base_url().index_page()."/ware/".$this->ciObject->uri->assoc_to_uri($currURI).'/sr/rtn'=>$this->objectsArr['ware_offers_header_sortby_rating'],
																	base_url().index_page()."/ware/".$this->ciObject->uri->assoc_to_uri($currURI).'/sr/pr'=>$this->objectsArr['ware_offers_header_sortby_price']																	
               														);
		$this->objectsArr['ware_offers_header_current_sortby'] = base_url().index_page()."/ware/".$this->ciObject->uri->assoc_to_uri($currURI).'/sr/'.$this->_ware_current_sort_rule;
        $this->objectsArr['ware_offers_header_sort_by_js'] = 'id="o_sortby" onChange="window.location.href=(document.getElementById(\'o_sortby\').options[selectedIndex].value)"';
        return $this->ciObject->load->view('modules/ware_module/offerssortby.php',$this->objectsArr, True);
	}
	
	public function _RenderCompanyInfoCell($row)
	{
		$this->ciObject->load->helper('text');
		$row['ware_client_offer_link'] = anchor(trim($row['link_ware']), character_limiter($row['short_descr'], 70), array('alt'=>$row['short_descr']));
		$row['ware_client_offer_name'] = $row['wareNAME'];
		$row['ware_client_offer_descr'] = ($row['short_descr'])?character_limiter($row['short_descr'], 256): false;  
		$row['ware_client_info_link'] = anchor(base_url().index_page().'/clients/c/'.$row['clientRID'], $row['clientNAME']);
		$row['ware_client_address_info'] = $row['cityNAME'].', '.$row['clientSTREET'].', '.$row['clientBUILD'];
		$row['ware_client_phones_info'] =  $row['clientWPHONES'];
		$row['ware_client_read_more'] = anchor(base_url().index_page().'/clients/c/'.$row['clientRID'], $this->objectsArr['ware_offers_client_read_more']);
		return $this->ciObject->load->view('modules/ware_module/_cellname.php',$row, True);
	}

	public function _RenderOfferStockCell($row)
	{
		return $this->ciObject->load->view('modules/ware_module/_cellstock.php',$row, True);
	}
	
	public function _RenderCompanyRatingCell($row)
	{
		$row['write_rewiev_title'] = anchor(base_url().index_page().'/cluops/c/'.$row['clientRID'], $this->ciObject->lang->line('CATEGORIES_MODULE_WARE_REWIEV_TITLE'));	
		$row['ware_rewievs_title'] = anchor(base_url().index_page().'/clients/o/'.$row['clientRID'], $this->ciObject->lang->line('CATEGORIES_MODULE_WARE_REWIEVES_TITLE'));
		return $this->ciObject->load->view('modules/ware_module/_cellrating.php',$row, True);
	}

	public function _RenderCompanyPriceCell($row)
	{
		$row['ware_offers_buy_title'] = $this->ciObject->lang->line('CATEGORIES_MODULE_CATEGORY_BUY_WARE_TITLE');
		$row['ware_offer_button_link'] = $row['link_ware'];
		$button_data = array(
              			'name'=>'w_price_btn',
              			'id'=>'w_price_btn',
              			'value'=>$row['ware_offers_buy_title'],
              			'style'=>'float:right; border: 0px;margin-top: 0px; line-height: 17px; text-align: center; width: 80px;',
						'class'=>'btn',
						'type'=>'button',
						'onclick'=>"window.location.href='".$row['ware_offer_button_link']."'"		  	
            			);
		$row['ware_offer_button']=form_input($button_data);	
		return $this->ciObject->load->view('modules/ware_module/_cellprice.php',$row, True);
	}

	public function _RenderOpinionTitleCell($row)
	{
		return $this->ciObject->load->view('modules/ware_module/_celloptitle.php',$row, True);
	}

	public function _RenderOpinionNameDateCell($row)
	{
		return $this->ciObject->load->view('modules/ware_module/_cellopnamedate.php',$row, True);
	}
	
	public function _RenderOpinionMarkCell($row)
	{
		return $this->ciObject->load->view('modules/ware_module/_cellopmark.php',$row, True);
	}

	public function _RenderOpinionContentCell($row)
	{
		return $this->ciObject->load->view('modules/ware_module/_cellopcontent.php',$row, True);
	}

	public function _RenderReviewContent($row)
	{
		return $this->ciObject->load->view('modules/ware_module/_reviewcontent.php',$row, True);
	}

	public function _RenderReviewDateCell($row)
	{
		return $this->ciObject->load->view('modules/ware_module/_cellrwdate.php',$row, True);
	}
	
	public function GetWareImage($imagesROWS)
	{
		# get random image
		$this->ciObject->load->helper('array');
		$this->ciObject->load->library('image_lib');
		$this->ciObject->image_lib->clear();
		foreach($imagesROWS as $image)
		{
			$imgORIGINAL = $this->STN_categories_ware_original_images_path.$image['rid'].'_'.$image['name'];
			$imgDETAILS  = $this->STN_categories_ware_details_images_path.$image['rid'].'_'.$image['name'];
			$imgSDETAILS = $this->STN_categories_ware_details_simages_path.$image['rid'].'_'.$image['name'];
			$imgMINIDETAILS = $this->STN_categories_ware_details_miniimages_path.$image['rid'].'_'.$image['name'];			
			if(!file_exists($imgORIGINAL))
			{
				$ifile=fopen($imgORIGINAL, "w");
				fwrite($ifile, $image['image']);
				fclose($ifile);
			} 					
			if(!file_exists($imgDETAILS))
			{
				$config = array();
				$config['image_library'] = 'GD2';
				$config['source_image'] = $imgORIGINAL;
				$config['new_image'] = $imgDETAILS;
				$config['create_thumb'] = FALSE;
				$config['width'] = $this->STN_categories_ware_details_width;
				$config['height'] = $this->STN_categories_ware_details_height;
				$this->ciObject->image_lib->initialize($config);
				if (!$this->ciObject->image_lib->resize())
				{
    				echo $this->ciObject->image_lib->display_errors();
				}				
			} 					
			if(!file_exists($imgSDETAILS))
			{
				$config = array();
				$config['image_library'] = 'GD2';
				$config['source_image'] = $imgORIGINAL;
				$config['new_image'] = $imgSDETAILS;
				$config['create_thumb'] = FALSE;
				$config['width'] = $this->STN_categories_ware_sdetails_width;
				$config['height'] = $this->STN_categories_ware_sdetails_height;
				$this->ciObject->image_lib->initialize($config);
				if (!$this->ciObject->image_lib->resize())
				{
    				echo $this->ciObject->image_lib->display_errors();
				}				
			}
			if(!file_exists($imgMINIDETAILS))
			{
				$config = array();
				$config['image_library'] = 'GD2';
				$config['source_image'] = $imgORIGINAL;
				$config['new_image'] = $imgMINIDETAILS;
				$config['create_thumb'] = FALSE;
				$config['width'] = $this->STN_categories_ware_minidetails_width;
				$config['height'] = $this->STN_categories_ware_minidetails_height;
				$this->ciObject->image_lib->initialize($config);
				if (!$this->ciObject->image_lib->resize())
				{
    				echo $this->ciObject->image_lib->display_errors();
				}				
			} 					
		}
		$image = random_element($imagesROWS);
		$imgNAME = $this->STN_categories_ware_details_images_path.$image['rid'].'_'.$image['name'];
		return base_url().$imgNAME;
	}

	public function GetClientLogo($imagesROWS)
	{
		# get random image
		$this->ciObject->load->helper('array');
		$image = random_element($imagesROWS);
		$imgNAME = $this->STN_ware_clients_logo_images_path.$image['rid'].'_'.$image['name'];
		if(file_exists($imgNAME)) return base_url().$imgNAME;
		$ifile=fopen($imgNAME, "w");
		fwrite($ifile,$image['image']);
		fclose($ifile); 			
		return base_url().$imgNAME;
	}

	public function GetOffersPagination()
	{
		$paginationCONFIG = array('total_rows'=>$this->_ware_quan_of_offers, 
									'per_page'=>$this->STN_ware_default_page_limit,
									'num_links'=>$this->STN_categories_offers_pagination_num_links);
		unset($this->_ware_current_uri_assoc['p']);
		$categories_category_pages_title=$this->ciObject->lang->line('WARE_MODULE_CATEGORY_PAGES_TITLE');
		$paginationCONFIG['base_url']=base_url().index_page()."/ware/".$this->ciObject->uri->assoc_to_uri($this->_ware_current_uri_assoc).'/p/';
		$paginationCONFIG['uri_segment']=count($this->_ware_current_uri_assoc)*2+3;
		$paginationCONFIG['full_tag_open'] = '<div style="float: right; color: #888888; font-size: 90%;font-weight: bold;margin-bottom: 10px;">'.$categories_category_pages_title;
		$paginationCONFIG['full_tag_close'] = '</div>';
		$paginationCONFIG['first_link'] = $this->ciObject->lang->line('WARE_MODULE_PAGINATION_FIRST_LINK_TITLE');
		$paginationCONFIG['last_link'] = $this->ciObject->lang->line('WARE_MODULE_PAGINATION_LAST_LINK_TITLE');
		$paginationCONFIG['next_link'] = '&gt&gt';
		$paginationCONFIG['prev_link'] = '&lt&lt';
		$paginationCONFIG['cur_tag_open'] = '<b> [';
		$paginationCONFIG['cur_tag_close'] = ']<b>';
		$this->ciObject->load->library('pagination');
		$this->ciObject->pagination->initialize($paginationCONFIG);
		return $this->ciObject->pagination->create_links();
	}

	public function GetTabsLinks()
	{
		$this->objectsArr['ware_offers_offers_link']=base_url().index_page().'/ware/c/'.$this->_ware_current_category_rid.'/o/'.$this->_ware_current_brands_rid.'/m/'.$this->_ware_current_model_alias.'/pp/'.$this->_ware_current_price_type;
		$this->objectsArr['ware_offers_detailed_link']=base_url().index_page().'/ware/c/'.$this->_ware_current_category_rid.'/d/'.$this->_ware_current_brands_rid.'/m/'.$this->_ware_current_model_alias.'/pp/'.$this->_ware_current_price_type;
		$this->objectsArr['ware_offers_opinions_link']=base_url().index_page().'/ware/c/'.$this->_ware_current_category_rid.'/op/'.$this->_ware_current_brands_rid.'/m/'.$this->_ware_current_model_alias.'/pp/'.$this->_ware_current_price_type;
		$this->objectsArr['ware_offers_reviews_link']=base_url().index_page().'/ware/c/'.$this->_ware_current_category_rid.'/r/'.$this->_ware_current_brands_rid.'/m/'.$this->_ware_current_model_alias.'/pp/'.$this->_ware_current_price_type;		
		return;
	}
	
	public function RenderCompareContent()
	{
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

	public function RenderErrorContent()
	{
		$this->objectsArr['ware_module_error_content'] = $this->ciObject->lang->line('WARE_MODULE_ERROR_CONTENT');
		$this->objectsArr['ware_module_error_title'] = $this->ciObject->lang->line('WARE_MODULE_ERROR_TITLE');
		return $this->ciObject->load->view('modules/ware_module/ware_module_error.php',$this->objectsArr, True);
	}
}

?>