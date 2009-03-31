<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
/*
 * Clients module
 * Mazvv 30-05-2007
*/
class Clients_module 
{
	private $ciObject;
	private $objectsArr = array();
	private $_current_clients_uri_assoc;
	private $_current_clients_client_rid;
	private $_current_clients_mode;
	private $_current_clients_nav_letter; 
	private $_current_clients_main_curr_rid;
	private $_current_clients_add_curr_rid;	
	private $_current_clients_city_rid;
	private $_current_clients_country_rid;
	private $_current_clients_region_rid;
	
	
	public function __construct()
	{
		$this->ciObject = &get_instance();
		$this->ciObject->lang->load('clients_module');
		$this->_current_clients_uri_assoc = $this->ciObject->uri->uri_to_assoc(2);
		$this->ciObject->load->model('clients_model');
		if(isset($this->_current_clients_uri_assoc['c']))
		{
			$this->_current_clients_client_rid = $this->_current_clients_uri_assoc['c'];
			$this->_current_clients_mode = 'c';
		}
		if(isset($this->_current_clients_uri_assoc['o']))
		{
			$this->_current_clients_client_rid = $this->_current_clients_uri_assoc['o'];
			$this->_current_clients_mode = 'o';
		}
		if(isset($this->_current_clients_uri_assoc['p']))
		{
			$this->_current_clients_client_rid = $this->_current_clients_uri_assoc['p'];
			$this->_current_clients_mode = 'p';
		}
		$currentSESS = $this->ciObject->session->userdata('_SI_');
		$this->_current_clients_city_rid = $currentSESS['SI_SETTINGS']['_CITY_RID_'];
		$this->_current_clients_region_rid = $currentSESS['SI_SETTINGS']['_REGION_RID_'];
		$this->_current_clients_country_rid = $currentSESS['SI_SETTINGS']['_COUNTRY_RID_'];
		$this->_current_clients_main_curr_rid = $currentSESS['SI_SETTINGS']['_MAIN_CURR_RID_'];
		$this->_current_clients_add_curr_rid = $currentSESS['SI_SETTINGS']['_ADD_CURR_RID_'];
		
		$this->_current_clients_nav_letter = (isset($this->_current_clients_uri_assoc['l']))?$this->_current_clients_uri_assoc['l']:null;
		$this->objectsArr['clients_module_client_not_exist'] = $this->ciObject->lang->line('CLIENTS_MODULE_CLIENTS_NOT_EXIST');
		$this->objectsArr['clients_module_client_info_tab'] = $this->ciObject->lang->line('CLIENTS_MODULE_CLIENTS_INFO_TAB');
		$this->objectsArr['clients_module_client_opinions_tab'] = $this->ciObject->lang->line('CLIENTS_MODULE_CLIENTS_OPINIONS_TAB');
		$this->objectsArr['clients_module_client_products_tab'] = $this->ciObject->lang->line('CLIENTS_MODULE_CLIENTS_PRODUCTS_TAB');
		$this->objectsArr['clients_module_clients_list_title'] = $this->ciObject->lang->line('CLIENTS_MODULE_CLIENTS_LIST_TITLE');
		$this->objectsArr['clients_module_clients_offers_title'] = $this->ciObject->lang->line('CLIENTS_MODULE_CLIENTS_OFFERS_TITLE');
		$this->objectsArr['clients_module_clients_count_find'] = $this->ciObject->lang->line('CLIENTS_MODULE_CLIENTS_COUNT_FIND');		
		$this->objectsArr['clients_module_clients_opins_title'] = $this->ciObject->lang->line('CLIENTS_MODULE_CLIENTS_OPINS_TITLE');
		$this->objectsArr['clients_module_clients_allclients_link'] = anchor(base_url().index_page().'/clients', $this->ciObject->lang->line('CLIENTS_MODULE_CLIENTS_ALLCLIENTS_TITLE'));		
		$this->objectsArr['clients_module_client_info_tab_link'] = base_url().index_page().'/clients/c/'.$this->_current_clients_client_rid;
		$this->objectsArr['clients_module_client_opinions_tab_link'] = base_url().index_page().'/clients/o/'.$this->_current_clients_client_rid;
		$this->objectsArr['clients_module_client_products_tab_link'] = base_url().index_page().'/clients/p/'.$this->_current_clients_client_rid;
		
	}
	
	public function RenderRetailerArea()
	{
		$resultARR = $this->ciObject->clients_model->GetClientArr($this->_current_clients_client_rid);
		if(!$resultARR) return $this->ciObject->load->view('modules/clients_module/clareafailure.php',$this->objectsArr, True);
		$this->objectsArr['clients_module_client_name_title'] = $resultARR['name'];
		if($this->_current_clients_mode=='o')$retailerAREA = $this->RenderRetailerOpinions($resultARR);
		else if($this->_current_clients_mode=='p')$retailerAREA = $this->RenderRetailerProducts($resultARR);
		else $retailerAREA = $this->RenderRetailerInfo($resultARR); 
		return $retailerAREA;
	}

	public function RenderRetailersList()
	{
		$parsARR = $this->GetPars();
		$SR = null;
		if($this->_current_clients_nav_letter) $SR = $this->_current_clients_nav_letter;
		$this->objectsArr['clients_module_client_current_letter'] = mb_strtoupper($SR, 'UTF-8');
		$parsARR['sr'] = $SR;
		$resultARR = $this->ciObject->clients_model->GetClientsByLetter($parsARR);
		if(!$resultARR)
		{	
			$this->objectsArr['clients_module_clients_list_count'] = '0';
			$this->objectsArr['clients_module_clients_list_content'] = $this->ciObject->lang->line('CLIENTS_MODULE_CLIENTS_EMPTY_LIST');
		}
		else
		{
			$this->objectsArr['clients_module_clients_list_count'] = count($resultARR);
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
			$newRowsList = array();
			foreach($resultARR as $row)
			{
				$newRowsList[] = $this->_RenderClientListCell($row);  
			}
			$new_list = $this->ciObject->table->make_columns($newRowsList, 3);
			$this->objectsArr['clients_module_clients_list_content'] = $this->ciObject->table->generate($new_list);
		}
		$this->objectsArr['clients_module_client_letters_nav'] = $this->ciObject->load->view('modules/clients_module/lettersnav.php',$this->objectsArr, True);
		return $this->ciObject->load->view('modules/clients_module/clientslist.php',$this->objectsArr, True);
	}
	
	public function _RenderClientListCell($row)
	{
		$row['offers_title'] = $this->objectsArr['clients_module_clients_offers_title'];
		return $this->ciObject->load->view('modules/clients_module/_cellcllist.php',$row, True);
	}
	
	public function RenderRetailerInfo($resultARR)
	{
		$this->objectsArr['clients_module_client_title'] = $this->ciObject->lang->line('CLIENTS_MODULE_CLIENTS_TITLE');
		$this->objectsArr['clients_module_client_global_title'] = $this->ciObject->lang->line('CLIENTS_MODULE_CLIENTS_GLOBAL_TITLE');
		$this->objectsArr['clients_module_client_country_title'] = $this->ciObject->lang->line('CLIENTS_MODULE_CLIENTS_COUNTRY_TITLE');
		$this->objectsArr['clients_module_client_city_title'] = $this->ciObject->lang->line('CLIENTS_MODULE_CLIENTS_CITY_TITLE');
		$this->objectsArr['clients_module_client_region_title'] = $this->ciObject->lang->line('CLIENTS_MODULE_CLIENTS_REGION_TITLE');
		$this->objectsArr['clients_module_client_nm_title'] = $this->ciObject->lang->line('CLIENTS_MODULE_CLIENTS_NAME_TITLE');
		$this->objectsArr['clients_module_client_adress_title'] = $this->ciObject->lang->line('CLIENTS_MODULE_CLIENTS_ADRESS_TITLE');
		$this->objectsArr['clients_module_client_continfo_title'] = $this->ciObject->lang->line('CLIENTS_MODULE_CLIENTS_CONTINFO_TITLE');
		$this->objectsArr['clients_module_client_phones_title'] = $this->ciObject->lang->line('CLIENTS_MODULE_CLIENTS_PHONES_TITLE');
		$this->objectsArr['clients_module_client_icq_title'] = $this->ciObject->lang->line('CLIENTS_MODULE_CLIENTS_ICQ_TITLE');
		$this->objectsArr['clients_module_client_msn_title'] = $this->ciObject->lang->line('CLIENTS_MODULE_CLIENTS_MSN_TITLE');
		$this->objectsArr['clients_module_client_skype_title'] = $this->ciObject->lang->line('CLIENTS_MODULE_CLIENTS_SKYPE_TITLE');
		$this->objectsArr['clients_module_client_website_title'] = $this->ciObject->lang->line('CLIENTS_MODULE_CLIENTS_WEBSITE_TITLE');
		$this->objectsArr['clients_module_client_other_title'] = $this->ciObject->lang->line('CLIENTS_MODULE_CLIENTS_OTHER_TITLE');
		$this->objectsArr['clients_module_client_credit_title'] = $this->ciObject->lang->line('CLIENTS_MODULE_CLIENTS_CREDIT_TITLE');
		$this->objectsArr['clients_module_client_delvr_title'] = $this->ciObject->lang->line('CLIENTS_MODULE_CLIENTS_DELVR_TITLE');
		$this->objectsArr['clients_module_client_wtime_title'] = $this->ciObject->lang->line('CLIENTS_MODULE_CLIENTS_WTIME_TITLE');		
		$this->objectsArr['clients_module_client_offquan_title'] = $this->ciObject->lang->line('CLIENTS_MODULE_CLIENTS_OFFQUAN_TITLE');
		$this->objectsArr['clients_module_client_rating_title'] = $this->ciObject->lang->line('CLIENTS_MODULE_CLIENTS_RATING_TITLE');
		$this->objectsArr['clients_module_client_wopin_title'] = $this->ciObject->lang->line('CLIENTS_MODULE_CLIENTS_WOPIN_TITLE');
		$this->objectsArr['clients_module_client_wopin_link'] = anchor(base_url().index_page().'/cluops/c/'.$resultARR['rid'], $this->ciObject->lang->line('CLIENTS_MODULE_CLIENTS_WOPIN_TITLE'));
		$this->objectsArr['clients_module_client_opins_link'] = anchor(base_url().index_page().'/clients/o/'.$resultARR['rid'], $this->ciObject->lang->line('CLIENTS_MODULE_CLIENTS_OPINS_TITLE'));
		$resultARR['descr'] = stripslashes($resultARR['descr']);
		$this->objectsArr['clients_module_client_result_arr'] = $resultARR;
		return $this->ciObject->load->view('modules/clients_module/clientinfo.php',$this->objectsArr, True);		
	}
	
	public function RenderRetailerOpinions($resultARR)
	{
		$this->objectsArr['clients_module_client_title'] = $this->ciObject->lang->line('CLIENTS_MODULE_CLIENTS_TITLE');
		$this->objectsArr['clients_module_client_offquan_title'] = $this->ciObject->lang->line('CLIENTS_MODULE_CLIENTS_OFFQUAN_TITLE');
		$this->objectsArr['clients_module_client_rating_title'] = $this->ciObject->lang->line('CLIENTS_MODULE_CLIENTS_RATING_TITLE');
		$this->objectsArr['clients_module_client_wopin_title'] = $this->ciObject->lang->line('CLIENTS_MODULE_CLIENTS_WOPIN_TITLE');
		$this->objectsArr['clients_module_client_wopin_link'] = anchor(base_url().index_page().'/cluops/c/'.$resultARR['rid'], $this->ciObject->lang->line('CLIENTS_MODULE_CLIENTS_WOPIN_TITLE'));
		$this->objectsArr['clients_module_client_opins_link'] = anchor(base_url().index_page().'/clients/o/'.$resultARR['rid'], $this->ciObject->lang->line('CLIENTS_MODULE_CLIENTS_OPINS_TITLE'));
		$this->objectsArr['clients_module_client_result_arr'] = $resultARR;
		$resultARR = $this->ciObject->clients_model->GetClientOpinions($this->_current_clients_client_rid);
		if(!$resultARR) $this->objectsArr['clients_module_client_opinions_content'] = $this->ciObject->lang->line('CLIENTS_MODULE_CLIENTS_NOOPINIONS_CONT');
		else
		{
			$this->objectsArr['clients_module_client_opinions_content'] = '';
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
				$row['clients_opinion_message_title'] = $this->ciObject->lang->line('CLIENTS_MODULE_OFFERS_OPINIONS_MESSAGE_TITLE');					
				$tableROW[] = $this->_RenderOpinionTitleCell($row);
				$tableROW[] = $this->_RenderOpinionNameDateCell($row);
				$this->ciObject->table->add_row($tableROW);
				$tableROW = array();
				$row['clients_opinion_message_title'] = $this->ciObject->lang->line('CLIENTS_MODULE_OFFERS_OPINIONS_MARK_TITLE');					
				$tableROW[] = $this->_RenderOpinionTitleCell($row);
				$tableROW[] = $this->_RenderOpinionMarkCell($row);
				$this->ciObject->table->add_row($tableROW);
				$tableROW = array();
				$row['clients_opinion_message_title'] = $this->ciObject->lang->line('CLIENTS_MODULE_OFFERS_OPINIONS_OPINION_TITLE');					
				$tableROW[] = $this->_RenderOpinionTitleCell($row);
				$tableROW[] = $this->_RenderOpinionContentCell($row);
				$this->ciObject->table->add_row($tableROW);
				$this->objectsArr['clients_module_client_opinions_content'] .= $this->ciObject->table->generate();
			}
		}
		return $this->ciObject->load->view('modules/clients_module/clientops.php',$this->objectsArr, True);		
	}

	public function RenderRetailerProducts($resultARR)
	{
		$this->objectsArr['clients_module_client_title'] = $this->ciObject->lang->line('CLIENTS_MODULE_CLIENTS_TITLE');
		$this->objectsArr['clients_module_client_offquan_title'] = $this->ciObject->lang->line('CLIENTS_MODULE_CLIENTS_OFFQUAN_TITLE');
		$this->objectsArr['clients_module_client_rating_title'] = $this->ciObject->lang->line('CLIENTS_MODULE_CLIENTS_RATING_TITLE');
		$this->objectsArr['clients_module_client_wopin_title'] = $this->ciObject->lang->line('CLIENTS_MODULE_CLIENTS_WOPIN_TITLE');
		$this->objectsArr['clients_module_client_wopin_link'] = anchor(base_url().index_page().'/cluops/c/'.$resultARR['rid'], $this->ciObject->lang->line('CLIENTS_MODULE_CLIENTS_WOPIN_TITLE'));
		$this->objectsArr['clients_module_client_opins_link'] = anchor(base_url().index_page().'/clients/o/'.$resultARR['rid'], $this->ciObject->lang->line('CLIENTS_MODULE_CLIENTS_OPINS_TITLE'));
		$this->objectsArr['clients_module_client_result_arr'] = $resultARR;
		$resultARR = $this->ciObject->clients_model->GetClientProducts($this->_current_clients_client_rid);		
		if(!$resultARR) $this->objectsArr['clients_module_client_products_content'] = $this->ciObject->lang->line('CLIENTS_MODULE_CLIENTS_NOPRODUCTS_CONT');
		else
		{
			$this->objectsArr['clients_module_client_opinions_content'] = '';
			$this->ciObject->load->library('table');
			$tmpl = array (
       	    	        'table_open'          => '<div id="t_wuopinion"><table celpadding=0 cellspacing=0 >',
           	    	    'heading_row_start'   => '<tr>',
                	    'heading_row_end'     => '</tr>',
                    	'heading_cell_start'  => '<td>',
                    	'heading_cell_end'    => '</td>',
                    	'row_start'           => '<tr>',
                    	'row_end'             => '</tr>',
                    	'cell_start'          => '<td width="50%">',
                    	'cell_end'            => '</td>',
                    	'row_alt_start'       => '<tr>',
                    	'row_alt_end'         => '</tr>',
                    	'cell_alt_start'      => '<td width="50%">',
                    	'cell_alt_end'        => '</td>',
                    	'table_close'         => '</table></div>'
   	    	      	);
			$this->ciObject->table->set_template($tmpl);
			
			$newRowsList = array();
			foreach($resultARR as $row)
			{
				$newRowsList[] = $this->_RenderClientProdCell($row);  
			}
			$new_list = $this->ciObject->table->make_columns($newRowsList, 2);
			$this->objectsArr['clients_module_client_products_content'] = $this->ciObject->table->generate($new_list);
		}
		return $this->ciObject->load->view('modules/clients_module/clientpr.php',$this->objectsArr, True);		
	}

	public function RenderClRulesArea()
	{
		$currentSESS = $this->ciObject->session->userdata('_SI_');
		unset($currentSESS['_ADDCLIENT_']);
		$this->ciObject->session->set_userdata('_SI_', $currentSESS);
		$this->objectsArr['clients_module_rules_title'] = $this->ciObject->lang->line('CLIENTS_MODULE_CLIENTS_RULES_TITLE');		
		$this->objectsArr['clients_module_add_client_descr'] = $this->ciObject->lang->line('CLIENTS_MODULE_CLIENTS_ADD_CLIENT_DESCR');
		$this->objectsArr['clients_module_add_goregister'] = $this->ciObject->lang->line('CLIENTS_MODULE_CLIENTS_ADD_GOREGISTER');
		$this->objectsArr['clients_module_add_next_title'] = $this->ciObject->lang->line('CLIENTS_MODULE_CLIENTS_ADD_NEXT_TITLE');		
		return $this->ciObject->load->view('modules/clients_module/addclrules.php',$this->objectsArr, True);	
	}
	
	public function RenderClRegistrationArea1()
	{
		$this->objectsArr['clients_module_add_client_title'] = $this->ciObject->lang->line('CLIENTS_MODULE_CLIENTS_ADD_CLIENT_TITLE');
		$this->objectsArr['clients_module_add_step_title'] = sprintf($this->ciObject->lang->line('CLIENTS_MODULE_CLIENTS_ADD_STEP_TITLE'),'1');
		$this->objectsArr['clients_module_add_client_descr1'] = $this->ciObject->lang->line('CLIENTS_MODULE_CLIENTS_ADD_CLIENT_DESCR1');
		
		$this->objectsArr['clients_module_add_urform_label'] = $this->ciObject->lang->line('CLIENTS_MODULE_CLIENTS_ADD_URFORM_LABEL');
		$this->objectsArr['clients_module_add_urform_descr'] = $this->ciObject->lang->line('CLIENTS_MODULE_CLIENTS_ADD_URFORM_DESCR');
		$this->objectsArr['clients_module_add_urform_list'] = array();
		$urformsList = $this->ciObject->clients_model->GetUrformsList();
		foreach ($urformsList as $item) $this->objectsArr['clients_module_add_urform_list'][$item['rid']] = $item['little_name'];
		$this->objectsArr['clients_module_add_name_label'] = $this->ciObject->lang->line('CLIENTS_MODULE_CLIENTS_ADD_NAME_LABEL');
		$this->objectsArr['clients_module_add_name_descr'] = $this->ciObject->lang->line('CLIENTS_MODULE_CLIENTS_ADD_NAME_DESCR');
		$this->objectsArr['clients_module_add_cltypes_label'] = $this->ciObject->lang->line('CLIENTS_MODULE_CLIENTS_ADD_CLTYPES_LABEL');
		$this->objectsArr['clients_module_add_cltypes_descr'] = $this->ciObject->lang->line('CLIENTS_MODULE_CLIENTS_ADD_CLTYPES_DESCR');
		$this->objectsArr['clients_module_add_cltypes_list'] = array();
		$cltypesList = $this->ciObject->clients_model->GetCltypesList();
		foreach ($cltypesList as $item) $this->objectsArr['clients_module_add_cltypes_list'][$item['rid']] = $item['name'];
		
		$this->objectsArr['clients_module_add_countries_label'] = $this->ciObject->lang->line('CLIENTS_MODULE_CLIENTS_ADD_COUNTRIES_LABEL');
		$this->objectsArr['clients_module_add_countries_descr'] = $this->ciObject->lang->line('CLIENTS_MODULE_CLIENTS_ADD_COUNTRIES_DESCR');
		$this->objectsArr['clients_module_add_countries_list'] = array();

		$countriesList = $this->ciObject->clients_model->GetCountriesList();
		foreach ($countriesList as $item) $this->objectsArr['clients_module_add_countries_list'][$item['rid']] = $item['name'];
		
		$this->objectsArr['clients_module_add_regions_label'] = $this->ciObject->lang->line('CLIENTS_MODULE_CLIENTS_ADD_REGIONS_LABEL');
		$this->objectsArr['clients_module_add_regions_descr'] = $this->ciObject->lang->line('CLIENTS_MODULE_CLIENTS_ADD_REGIONS_DESCR');
		$this->objectsArr['clients_module_add_regions_list'] = array();
		$regionsList = $this->ciObject->clients_model->GetRegionsList($countriesList[0]['rid']);
		if(!$regionsList) $regionsList = array();
		foreach ($regionsList as $item) $this->objectsArr['clients_module_add_regions_list'][$item['rid']] = $item['name'];
		
		$this->objectsArr['clients_module_add_cities_label'] = $this->ciObject->lang->line('CLIENTS_MODULE_CLIENTS_ADD_CITIES_LABEL');
		$this->objectsArr['clients_module_add_cities_descr'] = $this->ciObject->lang->line('CLIENTS_MODULE_CLIENTS_ADD_CITIES_DESCR');
		$this->objectsArr['clients_module_add_cities_list'] = array();
		if($regionsList) $citiesList = $this->ciObject->clients_model->GetCitiesList($regionsList[0]['rid']);
		else $citiesList = null;
		if($citiesList)	foreach ($citiesList as $item) $this->objectsArr['clients_module_add_cities_list'][$item['rid']] = $item['name'];
		else $this->objectsArr['clients_module_add_cities_list']=array();

		$this->objectsArr['clients_module_add_zip_label'] = $this->ciObject->lang->line('CLIENTS_MODULE_CLIENTS_ADD_ZIP_LABEL');
		$this->objectsArr['clients_module_add_zip_descr'] = $this->ciObject->lang->line('CLIENTS_MODULE_CLIENTS_ADD_ZIP_DESCR');

		$this->objectsArr['clients_module_add_street_label'] = $this->ciObject->lang->line('CLIENTS_MODULE_CLIENTS_ADD_STREET_LABEL');
		$this->objectsArr['clients_module_add_street_descr'] = $this->ciObject->lang->line('CLIENTS_MODULE_CLIENTS_ADD_STREET_DESCR');
		
		$this->objectsArr['clients_module_add_build_label'] = $this->ciObject->lang->line('CLIENTS_MODULE_CLIENTS_ADD_BUILD_LABEL');
		$this->objectsArr['clients_module_add_build_descr'] = $this->ciObject->lang->line('CLIENTS_MODULE_CLIENTS_ADD_BUILD_DESCR');

		$this->objectsArr['clients_module_add_requires'] = $this->ciObject->lang->line('CLIENTS_MODULE_CLIENTS_ADD_REQUIRES');

		$this->objectsArr['clients_module_add_general_title'] = $this->ciObject->lang->line('CLIENTS_MODULE_CLIENTS_ADD_GENERAL_TITLE');
		$this->objectsArr['clients_module_add_contact_title'] = $this->ciObject->lang->line('CLIENTS_MODULE_CLIENTS_ADD_CONTACT_TITLE');
		$this->objectsArr['clients_module_add_prinfo_title'] = $this->ciObject->lang->line('CLIENTS_MODULE_CLIENTS_ADD_PRINFO_TITLE');
		$this->objectsArr['clients_module_add_personal_title'] = $this->ciObject->lang->line('CLIENTS_MODULE_CLIENTS_ADD_PERSONAL_TITLE');
		$this->objectsArr['clients_module_add_addinfo_title'] = $this->ciObject->lang->line('CLIENTS_MODULE_CLIENTS_ADD_ADDINFO_TITLE');
		$this->objectsArr['clients_module_add_slinfo_title'] = $this->ciObject->lang->line('CLIENTS_MODULE_CLIENTS_ADD_SLINFO_TITLE');
		$this->objectsArr['clients_module_add_next_title'] = $this->ciObject->lang->line('CLIENTS_MODULE_CLIENTS_ADD_NEXT_TITLE');
		
		$rules['urform'] = "trim|required";
		$rules['name'] = "trim|required|min_length[2]|max_length[45]|callback__check_client_name";
		$rules['cltype'] = "trim|required";
		$rules['country'] = "trim|required";
		$rules['region'] = "trim|required";
		$rules['city'] = "trim|required";
		$rules['zip'] = "trim|required|numeric|min_length[2]|max_length[10]";
		$rules['street'] = "trim|required|max_length[45]";
		$rules['build'] = "trim|required|max_length[45]";
		
		$fields['urform'] = $this->objectsArr['clients_module_add_urform_label'];
		$fields['name'] = $this->objectsArr['clients_module_add_name_label'];
		$fields['cltype'] = $this->objectsArr['clients_module_add_cltypes_label'];
		$fields['country'] = $this->objectsArr['clients_module_add_countries_label'];
		$fields['region'] = $this->objectsArr['clients_module_add_regions_label'];
		$fields['city'] = $this->objectsArr['clients_module_add_cities_label'];
		$fields['zip'] = $this->objectsArr['clients_module_add_zip_label'];
		$fields['street'] = $this->objectsArr['clients_module_add_street_label'];
		$fields['build'] = $this->objectsArr['clients_module_add_build_label'];

		$this->ciObject->validation->set_error_delimiters('<br><span style="font-size:90%;color:red;">', '</div>');
		$this->ciObject->validation->set_rules($rules);
		$this->ciObject->validation->set_fields($fields);
		if ($this->ciObject->validation->run() == FALSE)		
		{
			return $this->ciObject->load->view('modules/clients_module/addclient1.php',$this->objectsArr, True);
		}
		/* Заполнение переменных сессии */
		$currentSESS = $this->ciObject->session->userdata('_SI_');
		$currentSESS['_ADDCLIENT_']['_urforms_rid'] = $_POST['urform'];
		$currentSESS['_ADDCLIENT_']['name'] = $_POST['name'];
		$currentSESS['_ADDCLIENT_']['_cltypes_rid'] = $_POST['cltype'];
		$currentSESS['_ADDCLIENT_']['_countries_rid'] = $_POST['country'];
		$currentSESS['_ADDCLIENT_']['_regions_rid'] = $_POST['region'];
		$currentSESS['_ADDCLIENT_']['_cities_rid'] = $_POST['city'];
		$currentSESS['_ADDCLIENT_']['zip'] = $_POST['zip'];
		$currentSESS['_ADDCLIENT_']['street'] = $_POST['street'];
		$currentSESS['_ADDCLIENT_']['build'] = $_POST['build'];
		$currentSESS['_ADDCLIENT_']['_STEP1_'] = true;
		$this->ciObject->session->set_userdata('_SI_', $currentSESS);
		/* **************************** */
		return $this->RenderClRegistrationArea2();
	}

	public function _RenderRegionsDropDown($countryRID)
	{
		$data = array();
		$regionsList = $this->ciObject->clients_model->GetRegionsList($countryRID);
		if(!$regionsList) $regionsList = array();
		foreach ($regionsList as $item) $data[$item['rid']] = $item['name'];
		return form_dropdown('region', $data, '', 'id="region" style="width:150px" class="i" onchange="RegionChange()"');
	}

	public function _RenderCitiesDropDown($regionRID)
	{
		$data = array();
		$citiesList = $this->ciObject->clients_model->GetCitiesList($regionRID);
		if(!$citiesList) $citiesList = array();
		foreach ($citiesList as $item) $data[$item['rid']] = $item['name'];
		return form_dropdown('city', $data, '', 'id="city" style="width:150px" class="i"');
	}
	
	public function RenderClRegistrationArea2()
	{
		$currentSESS = $this->ciObject->session->userdata('_SI_');
		if(!isset($currentSESS['_ADDCLIENT_']['_STEP1_'])) return $this->RenderClRegistrationArea1();
		$this->objectsArr['clients_module_add_client_title'] = $this->ciObject->lang->line('CLIENTS_MODULE_CLIENTS_ADD_CLIENT_TITLE');
		$this->objectsArr['clients_module_add_step_title'] = sprintf($this->ciObject->lang->line('CLIENTS_MODULE_CLIENTS_ADD_STEP_TITLE'),'2');
		$this->objectsArr['clients_module_add_client_descr2'] = $this->ciObject->lang->line('CLIENTS_MODULE_CLIENTS_ADD_CLIENT_DESCR2');
		$this->objectsArr['clients_module_add_next_title'] = $this->ciObject->lang->line('CLIENTS_MODULE_CLIENTS_ADD_NEXT_TITLE');
		$this->objectsArr['clients_module_add_prev_title'] = $this->ciObject->lang->line('CLIENTS_MODULE_CLIENTS_ADD_PREV_TITLE');
		
		$this->objectsArr['clients_module_add_phones_label'] = $this->ciObject->lang->line('CLIENTS_MODULE_CLIENTS_ADD_PHONES_LABEL');
		$this->objectsArr['clients_module_add_phones_descr'] = $this->ciObject->lang->line('CLIENTS_MODULE_CLIENTS_ADD_PHONES_DESCR');

		$this->objectsArr['clients_module_add_skype_label'] = $this->ciObject->lang->line('CLIENTS_MODULE_CLIENTS_ADD_SKYPE_LABEL');
		$this->objectsArr['clients_module_add_skype_descr'] = $this->ciObject->lang->line('CLIENTS_MODULE_CLIENTS_ADD_SKYPE_DESCR');

		$this->objectsArr['clients_module_add_icq_label'] = $this->ciObject->lang->line('CLIENTS_MODULE_CLIENTS_ADD_ICQ_LABEL');
		$this->objectsArr['clients_module_add_icq_descr'] = $this->ciObject->lang->line('CLIENTS_MODULE_CLIENTS_ADD_ICQ_DESCR');

		$this->objectsArr['clients_module_add_msn_label'] = $this->ciObject->lang->line('CLIENTS_MODULE_CLIENTS_ADD_MSN_LABEL');
		$this->objectsArr['clients_module_add_msn_descr'] = $this->ciObject->lang->line('CLIENTS_MODULE_CLIENTS_ADD_MSN_DESCR');

		$this->objectsArr['clients_module_add_www_label'] = $this->ciObject->lang->line('CLIENTS_MODULE_CLIENTS_ADD_WWW_LABEL');
		$this->objectsArr['clients_module_add_www_descr'] = $this->ciObject->lang->line('CLIENTS_MODULE_CLIENTS_ADD_WWW_DESCR');

		$this->objectsArr['clients_module_add_requires'] = $this->ciObject->lang->line('CLIENTS_MODULE_CLIENTS_ADD_REQUIRES');

		$this->objectsArr['clients_module_add_general_title'] = $this->ciObject->lang->line('CLIENTS_MODULE_CLIENTS_ADD_GENERAL_TITLE');
		$this->objectsArr['clients_module_add_contact_title'] = $this->ciObject->lang->line('CLIENTS_MODULE_CLIENTS_ADD_CONTACT_TITLE');
		$this->objectsArr['clients_module_add_prinfo_title'] = $this->ciObject->lang->line('CLIENTS_MODULE_CLIENTS_ADD_PRINFO_TITLE');
		$this->objectsArr['clients_module_add_personal_title'] = $this->ciObject->lang->line('CLIENTS_MODULE_CLIENTS_ADD_PERSONAL_TITLE');
		$this->objectsArr['clients_module_add_addinfo_title'] = $this->ciObject->lang->line('CLIENTS_MODULE_CLIENTS_ADD_ADDINFO_TITLE');
		$this->objectsArr['clients_module_add_slinfo_title'] = $this->ciObject->lang->line('CLIENTS_MODULE_CLIENTS_ADD_SLINFO_TITLE');
		$this->objectsArr['clients_module_add_send_title'] = $this->ciObject->lang->line('CLIENTS_MODULE_CLIENTS_ADD_SEND_TITLE');
		
		$rules['phones'] = "trim|required|max_length[255]";
		$rules['skype'] = "trim|max_length[45]";
		$rules['icq'] = "trim|max_length[10]";
		$rules['msn'] = "trim|max_length[45]";
		$rules['www'] = "trim|required|max_length[45]";
		
		$fields['phones'] = $this->objectsArr['clients_module_add_phones_label'];
		$fields['skype'] = $this->objectsArr['clients_module_add_skype_label'];
		$fields['icq'] = $this->objectsArr['clients_module_add_icq_label'];
		$fields['msn'] = $this->objectsArr['clients_module_add_msn_label'];
		$fields['www'] = $this->objectsArr['clients_module_add_www_label'];
		$this->ciObject->validation->set_error_delimiters('<br><span style="font-size:90%;color:red;">', '</div>');
		$this->ciObject->validation->set_rules($rules);
		$this->ciObject->validation->set_fields($fields);
		if ($this->ciObject->validation->run() == FALSE)		
		{
			return $this->ciObject->load->view('modules/clients_module/addclient2.php',$this->objectsArr, True);
		}
		/* Заполнение переменных сессии */
		$currentSESS['_ADDCLIENT_']['wphones'] = $_POST['phones'];
		$currentSESS['_ADDCLIENT_']['skype'] = $_POST['skype'];
		$currentSESS['_ADDCLIENT_']['icq'] = $_POST['icq'];
		$currentSESS['_ADDCLIENT_']['msn'] = $_POST['msn'];
		$currentSESS['_ADDCLIENT_']['url'] = $_POST['www'];
		$currentSESS['_ADDCLIENT_']['_STEP2_'] = true;
		$this->ciObject->session->set_userdata('_SI_', $currentSESS);
		/* **************************** */
		return $this->RenderClRegistrationArea3();
	}
	
	public function RenderClRegistrationArea3()
	{
		$currentSESS = $this->ciObject->session->userdata('_SI_');
		if(!isset($currentSESS['_ADDCLIENT_']['_STEP1_']) || !isset($currentSESS['_ADDCLIENT_']['_STEP2_'])) return $this->RenderClRegistrationArea1();
		$this->objectsArr['clients_module_add_client_title'] = $this->ciObject->lang->line('CLIENTS_MODULE_CLIENTS_ADD_CLIENT_TITLE');
		$this->objectsArr['clients_module_add_step_title'] = sprintf($this->ciObject->lang->line('CLIENTS_MODULE_CLIENTS_ADD_STEP_TITLE'),'3');
		$this->objectsArr['clients_module_add_client_descr3'] = $this->ciObject->lang->line('CLIENTS_MODULE_CLIENTS_ADD_CLIENT_DESCR3');
		$this->objectsArr['clients_module_add_next_title'] = $this->ciObject->lang->line('CLIENTS_MODULE_CLIENTS_ADD_NEXT_TITLE');
		$this->objectsArr['clients_module_add_prev_title'] = $this->ciObject->lang->line('CLIENTS_MODULE_CLIENTS_ADD_PREV_TITLE');
		
		$this->objectsArr['clients_module_add_descr_label'] = $this->ciObject->lang->line('CLIENTS_MODULE_CLIENTS_ADD_DESCR_LABEL');
		$this->objectsArr['clients_module_add_descr_descr'] = $this->ciObject->lang->line('CLIENTS_MODULE_CLIENTS_ADD_DESCR_DESCR');

		$this->objectsArr['clients_module_add_credit_label'] = $this->ciObject->lang->line('CLIENTS_MODULE_CLIENTS_ADD_CREDIT_LABEL');
		$this->objectsArr['clients_module_add_credit_descr'] = $this->ciObject->lang->line('CLIENTS_MODULE_CLIENTS_ADD_CREDIT_DESCR');

		$this->objectsArr['clients_module_add_delivery_label'] = $this->ciObject->lang->line('CLIENTS_MODULE_CLIENTS_ADD_DELIVERY_LABEL');
		$this->objectsArr['clients_module_add_delivery_descr'] = $this->ciObject->lang->line('CLIENTS_MODULE_CLIENTS_ADD_DELIVERY_DESCR');
		
		$this->objectsArr['clients_module_add_wtime_label'] = $this->ciObject->lang->line('CLIENTS_MODULE_CLIENTS_ADD_WTIME_LABEL');
		$this->objectsArr['clients_module_add_wtime_descr'] = $this->ciObject->lang->line('CLIENTS_MODULE_CLIENTS_ADD_WTIME_DESCR');

		$this->objectsArr['clients_module_add_requires'] = $this->ciObject->lang->line('CLIENTS_MODULE_CLIENTS_ADD_REQUIRES');
		
		$this->objectsArr['clients_module_add_general_title'] = $this->ciObject->lang->line('CLIENTS_MODULE_CLIENTS_ADD_GENERAL_TITLE');
		$this->objectsArr['clients_module_add_contact_title'] = $this->ciObject->lang->line('CLIENTS_MODULE_CLIENTS_ADD_CONTACT_TITLE');
		$this->objectsArr['clients_module_add_prinfo_title'] = $this->ciObject->lang->line('CLIENTS_MODULE_CLIENTS_ADD_PRINFO_TITLE');
		$this->objectsArr['clients_module_add_personal_title'] = $this->ciObject->lang->line('CLIENTS_MODULE_CLIENTS_ADD_PERSONAL_TITLE');
		$this->objectsArr['clients_module_add_addinfo_title'] = $this->ciObject->lang->line('CLIENTS_MODULE_CLIENTS_ADD_ADDINFO_TITLE');
		$this->objectsArr['clients_module_add_slinfo_title'] = $this->ciObject->lang->line('CLIENTS_MODULE_CLIENTS_ADD_SLINFO_TITLE');
		$this->objectsArr['clients_module_add_send_title'] = $this->ciObject->lang->line('CLIENTS_MODULE_CLIENTS_ADD_SEND_TITLE');

		$rules['descr'] = "trim|required|max_length[1000]";
		$rules['credit'] = "trim|required|max_length[1000]";
		$rules['delivery'] = "trim|required|max_length[1000]";
		$rules['wtime'] = "trim|required|max_length[255]";
		
		$fields['descr'] = $this->objectsArr['clients_module_add_descr_label'];
		$fields['credit'] = $this->objectsArr['clients_module_add_credit_label'];
		$fields['delivery'] = $this->objectsArr['clients_module_add_delivery_label'];
		$fields['wtime'] = $this->objectsArr['clients_module_add_wtime_label'];
		
		$this->ciObject->validation->set_error_delimiters('<br><span style="font-size:90%;color:red;">', '</div>');
		$this->ciObject->validation->set_rules($rules);
		$this->ciObject->validation->set_fields($fields);
		if ($this->ciObject->validation->run() == FALSE)		
		{
			return $this->ciObject->load->view('modules/clients_module/addclient3.php',$this->objectsArr, True);
		}
		/* Заполнение переменных сессии */
		$currentSESS['_ADDCLIENT_']['descr'] = $_POST['descr'];
		$currentSESS['_ADDCLIENT_']['creadits_info'] = $_POST['credit'];
		$currentSESS['_ADDCLIENT_']['delivery_info'] = $_POST['delivery'];
		$currentSESS['_ADDCLIENT_']['worktime_info'] = $_POST['wtime'];
		$currentSESS['_ADDCLIENT_']['_STEP3_'] = true;
		$this->ciObject->session->set_userdata('_SI_', $currentSESS);
		/* **************************** */
		return $this->RenderClRegistrationArea4();
	}
	
	public function RenderClRegistrationArea4()
	{
		$currentSESS = $this->ciObject->session->userdata('_SI_');
		if(!isset($currentSESS['_ADDCLIENT_']['_STEP1_']) || 
			!isset($currentSESS['_ADDCLIENT_']['_STEP2_']) || 
			!isset($currentSESS['_ADDCLIENT_']['_STEP3_'])) 
		{
			return $this->RenderClRegistrationArea1();
		}
		$this->objectsArr['clients_module_add_client_title'] = $this->ciObject->lang->line('CLIENTS_MODULE_CLIENTS_ADD_CLIENT_TITLE');
		$this->objectsArr['clients_module_add_step_title'] = sprintf($this->ciObject->lang->line('CLIENTS_MODULE_CLIENTS_ADD_STEP_TITLE'),'4');
		$this->objectsArr['clients_module_add_client_descr4'] = $this->ciObject->lang->line('CLIENTS_MODULE_CLIENTS_ADD_CLIENT_DESCR4');
		$this->objectsArr['clients_module_add_next_title'] = $this->ciObject->lang->line('CLIENTS_MODULE_CLIENTS_ADD_NEXT_TITLE');
		$this->objectsArr['clients_module_add_prev_title'] = $this->ciObject->lang->line('CLIENTS_MODULE_CLIENTS_ADD_PREV_TITLE');
		$this->objectsArr['clients_module_add_client_yes'] = $this->ciObject->lang->line('CLIENTS_MODULE_CLIENTS_ADD_CLIENT_YES');
		$this->objectsArr['clients_module_add_client_no'] = $this->ciObject->lang->line('CLIENTS_MODULE_CLIENTS_ADD_CLIENT_NO');
		
		
		$this->objectsArr['clients_module_add_isprice_label'] = $this->ciObject->lang->line('CLIENTS_MODULE_CLIENTS_ADD_ISPRICE_LABEL');
		$this->objectsArr['clients_module_add_isprice_descr'] = $this->ciObject->lang->line('CLIENTS_MODULE_CLIENTS_ADD_ISPRICE_DESCR');

		$this->objectsArr['clients_module_add_adays_label'] = $this->ciObject->lang->line('CLIENTS_MODULE_CLIENTS_ADD_ADAYS_LABEL');
		$this->objectsArr['clients_module_add_adays_descr'] = $this->ciObject->lang->line('CLIENTS_MODULE_CLIENTS_ADD_ADAYS_DESCR');

		$this->objectsArr['clients_module_add_ahours_label'] = $this->ciObject->lang->line('CLIENTS_MODULE_CLIENTS_ADD_AHOURS_LABEL');
		$this->objectsArr['clients_module_add_ahours_descr'] = $this->ciObject->lang->line('CLIENTS_MODULE_CLIENTS_ADD_AHOURS_DESCR');
		
		$this->objectsArr['clients_module_add_prurl_label'] = $this->ciObject->lang->line('CLIENTS_MODULE_CLIENTS_ADD_PRURL_LABEL');
		$this->objectsArr['clients_module_add_prurl_descr'] = $this->ciObject->lang->line('CLIENTS_MODULE_CLIENTS_ADD_PRURL_DESCR');
		
		$this->objectsArr['clients_module_add_requires'] = $this->ciObject->lang->line('CLIENTS_MODULE_CLIENTS_ADD_REQUIRES');

		$this->objectsArr['clients_module_add_general_title'] = $this->ciObject->lang->line('CLIENTS_MODULE_CLIENTS_ADD_GENERAL_TITLE');
		$this->objectsArr['clients_module_add_contact_title'] = $this->ciObject->lang->line('CLIENTS_MODULE_CLIENTS_ADD_CONTACT_TITLE');
		$this->objectsArr['clients_module_add_prinfo_title'] = $this->ciObject->lang->line('CLIENTS_MODULE_CLIENTS_ADD_PRINFO_TITLE');
		$this->objectsArr['clients_module_add_personal_title'] = $this->ciObject->lang->line('CLIENTS_MODULE_CLIENTS_ADD_PERSONAL_TITLE');
		$this->objectsArr['clients_module_add_addinfo_title'] = $this->ciObject->lang->line('CLIENTS_MODULE_CLIENTS_ADD_ADDINFO_TITLE');
		$this->objectsArr['clients_module_add_slinfo_title'] = $this->ciObject->lang->line('CLIENTS_MODULE_CLIENTS_ADD_SLINFO_TITLE');
		$this->objectsArr['clients_module_add_send_title'] = $this->ciObject->lang->line('CLIENTS_MODULE_CLIENTS_ADD_SEND_TITLE');

		$rules['isprice'] = "trim|required";
		$rules['adays'] = "trim|max_length[255]";
		$rules['ahours'] = "trim|max_length[255]";
		$rules['prurl'] = "trim|max_length[255]";
		
		
		$fields['isprice'] = $this->objectsArr['clients_module_add_isprice_label'];		
		$fields['adays'] = $this->objectsArr['clients_module_add_adays_label'];
		$fields['ahours'] = $this->objectsArr['clients_module_add_ahours_label'];
		$fields['prurl'] = $this->objectsArr['clients_module_add_prurl_label'];
		
		$this->ciObject->validation->set_error_delimiters('<br><span style="font-size:90%;color:red;">', '</div>');
		$this->ciObject->validation->set_rules($rules);
		$this->ciObject->validation->set_fields($fields);
		if ($this->ciObject->validation->run() == FALSE)		
		{
			return $this->ciObject->load->view('modules/clients_module/addclient4.php',$this->objectsArr, True);
		}
		/* Заполнение переменных сессии */
		$currentSESS['_ADDCLIENT_']['pr_load'] = $_POST['isprice'];
		$currentSESS['_ADDCLIENT_']['pr_actual_days'] = $_POST['adays'];
		$currentSESS['_ADDCLIENT_']['pr_actual_hours'] = '0';
		$currentSESS['_ADDCLIENT_']['pr_actual_minutes'] = '0';
		$currentSESS['_ADDCLIENT_']['pr_url'] = $_POST['prurl'];
		$currentSESS['_ADDCLIENT_']['_STEP4_'] = true;
		$this->ciObject->session->set_userdata('_SI_', $currentSESS);
		/* **************************** */
		return $this->RenderClRegistrationArea5();
	}
	
	public function RenderClRegistrationArea5()
	{
		$currentSESS = $this->ciObject->session->userdata('_SI_');
		if(!isset($currentSESS['_ADDCLIENT_']['_STEP1_']) || 
			!isset($currentSESS['_ADDCLIENT_']['_STEP2_']) || 
			!isset($currentSESS['_ADDCLIENT_']['_STEP3_']) || 
			!isset($currentSESS['_ADDCLIENT_']['_STEP4_'])) return $this->RenderClRegistrationArea1();
		$this->objectsArr['clients_module_add_client_title'] = $this->ciObject->lang->line('CLIENTS_MODULE_CLIENTS_ADD_CLIENT_TITLE');
		$this->objectsArr['clients_module_add_step_title'] = sprintf($this->ciObject->lang->line('CLIENTS_MODULE_CLIENTS_ADD_STEP_TITLE'),'5');
		$this->objectsArr['clients_module_add_client_descr5'] = $this->ciObject->lang->line('CLIENTS_MODULE_CLIENTS_ADD_CLIENT_DESCR5');
		$this->objectsArr['clients_module_add_prev_title'] = $this->ciObject->lang->line('CLIENTS_MODULE_CLIENTS_ADD_PREV_TITLE');
		$this->objectsArr['clients_module_add_send_title'] = $this->ciObject->lang->line('CLIENTS_MODULE_CLIENTS_ADD_SEND_TITLE');		
		
		$this->objectsArr['clients_module_add_cphones_label'] = $this->ciObject->lang->line('CLIENTS_MODULE_CLIENTS_ADD_CPHONES_LABEL');
		$this->objectsArr['clients_module_add_cphones_descr'] = $this->ciObject->lang->line('CLIENTS_MODULE_CLIENTS_ADD_CPHONES_DESCR');

		$this->objectsArr['clients_module_add_cmail_label'] = $this->ciObject->lang->line('CLIENTS_MODULE_CLIENTS_ADD_CMAIL_LABEL');
		$this->objectsArr['clients_module_add_cmail_descr'] = $this->ciObject->lang->line('CLIENTS_MODULE_CLIENTS_ADD_CMAIL_DESCR');

		$this->objectsArr['clients_module_add_cperson_label'] = $this->ciObject->lang->line('CLIENTS_MODULE_CLIENTS_ADD_CPERSON_LABEL');
		$this->objectsArr['clients_module_add_cperson_descr'] = $this->ciObject->lang->line('CLIENTS_MODULE_CLIENTS_ADD_CPERSON_DESCR');

		$this->objectsArr['clients_module_add_login_label'] = $this->ciObject->lang->line('CLIENTS_MODULE_CLIENTS_ADD_LOGIN_LABEL');
		$this->objectsArr['clients_module_add_login_descr'] = $this->ciObject->lang->line('CLIENTS_MODULE_CLIENTS_ADD_LOGIN_DESCR');
		
		$this->objectsArr['clients_module_add_passwd_label'] = $this->ciObject->lang->line('CLIENTS_MODULE_CLIENTS_ADD_PASSWD_LABEL');
		$this->objectsArr['clients_module_add_passwd_descr'] = $this->ciObject->lang->line('CLIENTS_MODULE_CLIENTS_ADD_PASSWD_DESCR');
		
		$this->objectsArr['clients_module_add_cpasswd_label'] = $this->ciObject->lang->line('CLIENTS_MODULE_CLIENTS_ADD_СPASSWD_LABEL');
		$this->objectsArr['clients_module_add_cpasswd_descr'] = $this->ciObject->lang->line('CLIENTS_MODULE_CLIENTS_ADD_СPASSWD_DESCR');
		
		$this->objectsArr['clients_module_add_uemail_label'] = $this->ciObject->lang->line('CLIENTS_MODULE_CLIENTS_ADD_UEMAIL_LABEL');
		$this->objectsArr['clients_module_add_uemail_descr'] = $this->ciObject->lang->line('CLIENTS_MODULE_CLIENTS_ADD_UEMAIL_DESCR');

		$this->objectsArr['clients_module_add_dname_label'] = $this->ciObject->lang->line('CLIENTS_MODULE_CLIENTS_ADD_DNAME_LABEL');
		$this->objectsArr['clients_module_add_dname_descr'] = $this->ciObject->lang->line('CLIENTS_MODULE_CLIENTS_ADD_DNAME_DESCR');

		
		$this->objectsArr['clients_module_add_requires'] = $this->ciObject->lang->line('CLIENTS_MODULE_CLIENTS_ADD_REQUIRES');

		$this->objectsArr['clients_module_add_general_title'] = $this->ciObject->lang->line('CLIENTS_MODULE_CLIENTS_ADD_GENERAL_TITLE');
		$this->objectsArr['clients_module_add_contact_title'] = $this->ciObject->lang->line('CLIENTS_MODULE_CLIENTS_ADD_CONTACT_TITLE');
		$this->objectsArr['clients_module_add_prinfo_title'] = $this->ciObject->lang->line('CLIENTS_MODULE_CLIENTS_ADD_PRINFO_TITLE');
		$this->objectsArr['clients_module_add_personal_title'] = $this->ciObject->lang->line('CLIENTS_MODULE_CLIENTS_ADD_PERSONAL_TITLE');
		$this->objectsArr['clients_module_add_addinfo_title'] = $this->ciObject->lang->line('CLIENTS_MODULE_CLIENTS_ADD_ADDINFO_TITLE');
		$this->objectsArr['clients_module_add_slinfo_title'] = $this->ciObject->lang->line('CLIENTS_MODULE_CLIENTS_ADD_SLINFO_TITLE');
		$this->objectsArr['clients_module_add_send_title'] = $this->ciObject->lang->line('CLIENTS_MODULE_CLIENTS_ADD_SEND_TITLE');
		$this->objectsArr['clients_module_add_account_title'] = $this->ciObject->lang->line('CLIENTS_MODULE_CLIENTS_ADD_ACCOUNT_TITLE');
		$this->objectsArr['clients_module_add_client_success'] = $this->ciObject->lang->line('CLIENTS_MODULE_CLIENTS_ADD_CLIENT_SUCCESS');
		
		
		$rules['cphones'] = "trim|max_length[255]";
		$rules['cmail'] = "trim|required|max_length[255]|valid_email";
		$rules['cperson'] = "trim|required|max_length[255]";
		$rules['login'] = "trim|required|max_length[12]|callback__check_login";
		$rules['passwd'] = "trim|required|matches[cpasswd]|min_length[6]|max_length[12]";
		$rules['cpasswd'] = "trim|required|max_length[12]";
		$rules['uemail'] = "trim|required|max_length[255]|valid_email";
		$rules['dname'] = "trim|required|max_length[255]";
		
		
		$fields['cphones'] = $this->objectsArr['clients_module_add_cphones_label'];
		$fields['cmail'] = $this->objectsArr['clients_module_add_cmail_label'];
		$fields['cperson'] = $this->objectsArr['clients_module_add_cperson_label'];
		$fields['login'] = $this->objectsArr['clients_module_add_login_label'];
		$fields['passwd'] = $this->objectsArr['clients_module_add_passwd_label'];
		$fields['cpasswd'] = $this->objectsArr['clients_module_add_cpasswd_label'];
		$fields['uemail'] = $this->objectsArr['clients_module_add_uemail_label'];
		$fields['dname'] = $this->objectsArr['clients_module_add_dname_label'];
		
		$this->ciObject->validation->set_error_delimiters('<br><span style="font-size:90%;color:red;">', '</div>');
		$this->ciObject->validation->set_rules($rules);
		$this->ciObject->validation->set_fields($fields);
		if ($this->ciObject->validation->run() == FALSE)		
		{
			return $this->ciObject->load->view('modules/clients_module/addclient5.php',$this->objectsArr, True);
		}
		/* Заполнение переменных сессии */
		$currentSESS['_ADDCLIENT_']['contact_phones'] = $_POST['cphones'];
		$currentSESS['_ADDCLIENT_']['contact_email'] = $_POST['cmail'];
		$currentSESS['_ADDCLIENT_']['contact_person'] = $_POST['cperson'];
		$currentSESS['_ADDCLIENT_']['login'] = $_POST['login'];
		$currentSESS['_ADDCLIENT_']['passwd'] = $_POST['passwd'];
		$currentSESS['_ADDCLIENT_']['displayname'] = $_POST['dname'];
		$currentSESS['_ADDCLIENT_']['email'] = $_POST['uemail'];
		$currentSESS['_ADDCLIENT_']['_STEP5_'] = true;
		$this->ciObject->session->set_userdata('_SI_', $currentSESS);
		$this->_SaveClient();
		/* **************************** */
		return $this->ciObject->load->view('modules/clients_module/addclsuccess.php',$this->objectsArr, True);
	}
	
	public function _RenderOpinionTitleCell($row)
	{
		return $this->ciObject->load->view('modules/clients_module/_celloptitle.php',$row, True);
	}

	public function _RenderOpinionNameDateCell($row)
	{
		return $this->ciObject->load->view('modules/clients_module/_cellopnamedate.php',$row, True);
	}
	
	public function _RenderOpinionMarkCell($row)
	{
		return $this->ciObject->load->view('modules/clients_module/_cellopmark.php',$row, True);
	}

	public function _RenderOpinionContentCell($row)
	{
		return $this->ciObject->load->view('modules/clients_module/_cellopcontent.php',$row, True);
	}

	public function _RenderClientProdCell($row)
	{
		$row['offers_title'] = $this->objectsArr['clients_module_clients_offers_title'];
		return $this->ciObject->load->view('modules/clients_module/_cellprlist.php',$row, True);
	}
	
	public function GetPars()
	{
		$parsARR = array();
		$parsARR['_countries_rid'] = $this->_current_clients_country_rid;
		$parsARR['_regions_rid'] = $this->_current_clients_region_rid;
		$parsARR['_cities_rid'] = $this->_current_clients_city_rid;
		$parsARR['_maincurr_rid'] = $this->_current_clients_main_curr_rid;
		$parsARR['_addcurr_rid'] = $this->_current_clients_add_curr_rid;
		return $parsARR;
	}
	
	public function _SaveClient()
	{
		$currentSESS = $this->ciObject->session->userdata('_SI_');
		$clientArr = array('_cities_rid'=>$currentSESS['_ADDCLIENT_']['_cities_rid'],
							'_urforms_rid'=>$currentSESS['_ADDCLIENT_']['_urforms_rid'],
							'_cltypes_rid'=>$currentSESS['_ADDCLIENT_']['_cltypes_rid'],
							'name'=>$currentSESS['_ADDCLIENT_']['name'],
							'zip'=>$currentSESS['_ADDCLIENT_']['zip'],
							'street'=>$currentSESS['_ADDCLIENT_']['street'],
							'build'=>$currentSESS['_ADDCLIENT_']['build'],
							'wphones'=>$currentSESS['_ADDCLIENT_']['wphones'],
							'skype'=>$currentSESS['_ADDCLIENT_']['skype'],
							'icq'=>$currentSESS['_ADDCLIENT_']['icq'],
							'msn'=>$currentSESS['_ADDCLIENT_']['msn'],
							'url'=>$currentSESS['_ADDCLIENT_']['url'],
							'pr_load'=>$currentSESS['_ADDCLIENT_']['pr_load'],
							'pr_actual_days'=>$currentSESS['_ADDCLIENT_']['pr_actual_days'],
							'pr_actual_hours'=>$currentSESS['_ADDCLIENT_']['pr_actual_hours'],
							'pr_actual_minutes'=>'0',
							'pr_email'=>'',
							'descr'=>$currentSESS['_ADDCLIENT_']['descr'],
							'creadits_info'=>$currentSESS['_ADDCLIENT_']['creadits_info'],
							'delivery_info'=>$currentSESS['_ADDCLIENT_']['delivery_info'],
							'worktime_info'=>$currentSESS['_ADDCLIENT_']['worktime_info'],
							'reg_date'=>date("Y-m-d H:m:s"),
							'contact_phones'=>$currentSESS['_ADDCLIENT_']['contact_phones'],
							'contact_email'=>$currentSESS['_ADDCLIENT_']['contact_email'],
							'contact_person'=>$currentSESS['_ADDCLIENT_']['contact_person'],
							'pr_url'=>$currentSESS['_ADDCLIENT_']['pr_url']
							);
		$clientRID = $this->ciObject->clients_model->AddClient($clientArr);
		$userArr = array('_clients_rid'=>$clientRID['_clients_rid'],
						'login'=>$currentSESS['_ADDCLIENT_']['login'],
						'displayname'=>$currentSESS['_ADDCLIENT_']['displayname'],
						'passwd'=>md5($currentSESS['_ADDCLIENT_']['passwd']),
						'email'=>$currentSESS['_ADDCLIENT_']['email']
						);
		$this->ciObject->clients_model->AddUser($userArr);
		$this->_SendMailToAdmin($currentSESS['_ADDCLIENT_']);
		unset($currentSESS['_ADDCLIENT_']);
		$this->ciObject->session->set_userdata('_SI_', $currentSESS);
		return true;
	}
	
	public function _SendMailToAdmin($client_to_add)
	{
		$this->ciObject->load->library('email');
		$this->ciObject->load->library('constant_module');
		$email_to = $this->ciObject->constant_module->GetConstant('ADM_E');
		$this->ciObject->email->clear();
		$this->ciObject->email->to($email_to);
    	$this->ciObject->email->from($client_to_add['contact_email']);
    	$this->ciObject->email->subject($this->ciObject->lang->line('CLIENTS_MODULE_CLIENTS_ADD_ADM_EMAIL'));
    	$message = $client_to_add['name']."\n";
    	$this->ciObject->email->message($message);
   		$this->ciObject->email->send();
   		$this->ciObject->email->clear();
	}
}
?>