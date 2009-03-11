<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
/*
 * Relatedcats module
 * Mazvv 31-05-2007
*/
class Filters_module 
{
	private $ciObject;
	private $objectsArr = array();
	private $STN_filters_module_area_title;
	private $_current_filters_uri_assoc;
	private $_current_filters_category_rid;
	private $_current_filters_maincurr_endword;
	private $_current_filters_addcurr_endword;
	private $_current_city_rid;
	private $_current_region_rid;
	private $_current_country_rid;
	
	public function __construct()
	{
		$this->ciObject = &get_instance();
		$this->ciObject->lang->load('filters_module');
		$this->ciObject->load->model('filters_model');
		$this->ciObject->load->model('categories_model');
		$this->STN_filters_module_area_title = $this->ciObject->lang->line('FILTERS_MODULE_FILTERS_AREA_TITLE');
		$this->_current_filters_uri_assoc = $this->ciObject->uri->uri_to_assoc(2);
		$this->_current_filters_category_rid = (isset($this->_current_filters_uri_assoc['c']))?$this->_current_filters_uri_assoc['c']:null;
		$this->objectsArr['filters_area_title'] = $this->STN_filters_module_area_title;
		$this->objectsArr['filters_current_category_rid'] = $this->_current_filters_category_rid;
		$this->objectsArr['filters_current_uri_string'] = '/categories/'.$this->ciObject->uri->assoc_to_uri($this->_current_filters_uri_assoc);
		$form_uri_assoc = $this->_current_filters_uri_assoc;
		unset($form_uri_assoc['p']);
		unset($form_uri_assoc['ss']);
		unset($form_uri_assoc['pt']);
		unset($form_uri_assoc['pf']);
		unset($form_uri_assoc['pta']);
		unset($form_uri_assoc['pfa']);
		$this->objectsArr['filters_current_form_uri_string'] = '/categories/'.$this->ciObject->uri->assoc_to_uri($form_uri_assoc);
		$currentSESS = $this->ciObject->session->userdata('_SI_');
		$this->_current_filters_maincurr_endword = $currentSESS['SI_SETTINGS']['_MAIN_CURR_ENDWORD_'];
		$this->_current_filters_addcurr_endword = $currentSESS['SI_SETTINGS']['_ADD_CURR_ENDWORD_'];
		$this->_current_city_rid = $currentSESS['SI_SETTINGS']['_CITY_RID_'];
		$this->_current_region_rid = $currentSESS['SI_SETTINGS']['_REGION_RID_'];
		$this->_current_country_rid = $currentSESS['SI_SETTINGS']['_COUNTRY_RID_'];
		$this->objectsArr['filters_current_maincurr_endword'] = $this->_current_filters_maincurr_endword;
		$this->objectsArr['filters_current_addcurr_endword'] = $this->_current_filters_addcurr_endword;
	}
	
	public function RenderCategoryFilters()
	{
		if(is_array($this->ciObject->categories_model->GetCategoriesArr($this->_current_filters_category_rid))) return '';
		else return $this->_RenderCategoryFilters();
	}

	public function _RenderCategoryFilters()
	{
		$parsARR = $this->_GetParsArr();
		$this->ciObject->load->helper('inflector');
		
		$this->objectsArr['filters_module_search_field_title'] = $this->ciObject->lang->line('FILTERS_MODULE_SEARCH_FIELD_TITLE');
		$this->objectsArr['filters_module_search_field_descr'] = $this->ciObject->lang->line('FILTERS_MODULE_SEARCH_FIELD_DESCR');
		$this->objectsArr['filters_module_prrange_field_title'] = $this->ciObject->lang->line('FILTERS_MODULE_PRRANGE_FIELD_TITLE');
		$this->objectsArr['filters_module_brands_field_title'] = $this->ciObject->lang->line('FILTERS_MODULE_BRANDS_FIELD_TITLE');
		$this->objectsArr['filters_module_filter_btn_title'] = $this->ciObject->lang->line('FILTERS_MODULE_FILTER_BTN_TITLE');
		$this->objectsArr['filters_module_filter_all_title'] = $this->ciObject->lang->line('FILTERS_MODULE_FILTER_ALL_TITLE');
		$this->objectsArr['filters_module_current_filter_title'] = $this->ciObject->lang->line('FILTERS_MODULE_CURRENT_FILTER_TITLE');
		$this->objectsArr['filters_module_current_filter_arr'] = array();

		$resultARR = $this->ciObject->filters_model->GetCatBrands($this->_current_filters_category_rid, $parsARR);
		$brandsARR = array();
		if($resultARR)
		{
			foreach($resultARR as $row)
			{
				$b_arr = $this->_current_filters_uri_assoc;
				unset($b_arr['p']);
				$b_v = isset($this->_current_filters_uri_assoc['b'])?explode('-',$this->_current_filters_uri_assoc['b']):array();
				if(in_array($row['rid'], $b_v))
				{
					$i = array_search($row['rid'], $b_v);
					unset($b_v[$i]);
					if($b_v) $b_arr['b'] = implode('-', $b_v);
					else unset($b_arr['b']);
					$this->objectsArr['filters_module_current_filter_arr']['b']['pname'] = $this->ciObject->lang->line('FILTERS_MODULE_BRANDS_FIELD_TITLE');
					$this->objectsArr['filters_module_current_filter_arr']['b']['links'][] =  array('link'=>anchor('/categories/'.$this->ciObject->uri->assoc_to_uri($b_arr), $row['name']), 'count'=>$row['itemsCOUNT']);
				}
				else
				{
					$b_v[] = $row['rid'];
					$b_arr['b'] = implode('-', $b_v);
					$brandsARR[] = array('link'=>anchor('/categories/'.$this->ciObject->uri->assoc_to_uri($b_arr), $row['name']), 'count'=>$row['itemsCOUNT']);
				}
			}
		}
		
		$resultARR = $this->ciObject->filters_model->GetCatFilters($this->_current_filters_category_rid, $parsARR);
		$filtersARR = array();
		if($resultARR)
		{
			foreach($resultARR as $row)
			{
				$f_arr = $this->_current_filters_uri_assoc;
				$par_NAME = ($row['ptype']=='WARE')?'cf_'.$row['rid']:'if_'.$row['rid'];
				unset($f_arr['p']);
				unset($f_arr[$par_NAME]);
				$p_v = isset($this->_current_filters_uri_assoc[$par_NAME])?explode('-',$this->_current_filters_uri_assoc[$par_NAME]):array();
				if(in_array($row['filterRID'], $p_v))
				{
					$i = array_search($par_NAME, $p_v);
					unset($p_v[$i]);
					if($p_v) $f_arr[$par_NAME] = implode('-', $p_v);
					else unset($f_arr[$par_NAME]);
					$this->objectsArr['filters_module_current_filter_arr'][$par_NAME]['pname'] = $row['parNAME'];
					$this->objectsArr['filters_module_current_filter_arr'][$par_NAME]['links'][] =  array('link'=>anchor('/categories/'.$this->ciObject->uri->assoc_to_uri($f_arr), $row['filterNAME']), 'count'=>$row['filterCOUNT']);
				}
				else
				{
					$p_v[] = $row['filterRID'];
					$f_arr[$par_NAME] = implode('-', $p_v);
					if(!isset($filtersARR[$row['rid']]))
					{
						$filtersARR[$row['rid']]['fname'] = $row['parNAME'];
						$filtersARR[$row['rid']]['items'][] = array('link'=>anchor('/categories/'.$this->ciObject->uri->assoc_to_uri($f_arr), $row['filterNAME']), 'count'=>$row['filterCOUNT']);
					}
					else $filtersARR[$row['rid']]['items'][] = array('link'=>anchor('/categories/'.$this->ciObject->uri->assoc_to_uri($f_arr), $row['filterNAME']), 'count'=>$row['filterCOUNT']);
				}
			}
		}
		$this->objectsArr['filters_module_filters_brands_list'] = $brandsARR;
		$this->objectsArr['filters_module_filters_fields_arr'] = $filtersARR;
		$this->objectsArr['filters_module_filters_current_vals_arr'] = $this->_current_filters_uri_assoc;
		return $this->ciObject->load->view('modules/filters_module/filtersarea.php',$this->objectsArr, True);
	}
	
	public function _GetParsArr()
	{
		$parsARR = array();
		$parsARR['c_cn'] = $this->_current_country_rid;
		$parsARR['c_rg'] = $this->_current_region_rid;
		$parsARR['c_ct'] = $this->_current_city_rid;
		# { MAZVV 09-02-2008 Исправил баг когда указан конкретный магазин
		$parsARR['cl'] = isset($this->_current_filters_uri_assoc['cl'])?$this->_current_filters_uri_assoc['cl']:null;
		# } MAZVV 09-02-2008
		$parsARR['b'] = isset($this->_current_filters_uri_assoc['b'])?$this->_current_filters_uri_assoc['b']:null;
		foreach($this->_current_filters_uri_assoc as $key=>$par)
		{
			if(stripos($key, "cf_")!==FALSE) $parsARR['cf_'][substr($key, 3)] = $par;
			if(stripos($key, "if_")!==FALSE) $parsARR['if_'][substr($key, 3)] = $par;
		}
		return $parsARR;
	}
}
?>