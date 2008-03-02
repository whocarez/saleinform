<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
/*
 * Settings module
 * Mazvv 03-05-2007
*/
class Settings_module 
{
	private $ciObject;
	private $objectsArr = array();
	private $STN_settings_area_title; # title of user settings area
	private $STN_settings_curr_list_title; # title of settings currencies list
	private $STN_settings_curr_cources_title; # title of settings currencies cources
	private $STN_settings_regions_title; # title of settings currencies cources
	private $STN_settings_countries_title; # title of settings countries
	private $STN_settings_cities_title; # title of settings cities
	private $STN_settings_main_curr_title; # title of main currency
	private $STN_settings_add_curr_title; # title of additional currency
	private $STN_settings_save_button_title; # title of additional currency
	private $STN_settings_change_settings_title; # title of change settings link
	private $STN_settings_empty_value; # value of empty string
	private $STN_settings_all_value; # value of all string
	private $STN_settings_default_country_rid = '5';
	private $STN_settings_default_region_rid = null;
	private $STN_settings_default_city_rid = null;
	private $STN_settings_default_add_currency_rid = '7';
	/*-----------------------------------*/
	private $_country_rid;
	private $_country_name;
	private $_region_rid;
	private $_region_name;
	private $_city_rid;
	private $_city_name;
	private $_main_currency_rid;
	private $_main_currency_cod;
	private $_main_currency_name;
	private $_add_currency_rid;
	private $_add_currency_cod;
	private $_add_currency_name;
	
	public function __construct()
	{
		$this->ciObject = &get_instance();
		$this->ciObject->lang->load('settings_module');
		$this->STN_settings_area_title = $this->ciObject->lang->line('SETTINGS_MODULE_AREA_TITLE');
		$this->STN_settings_curr_list_title = $this->ciObject->lang->line('SETTINGS_MODULE_CURRENCY_LIST_TITLE');
		$this->STN_settings_curr_cources_title = $this->ciObject->lang->line('SETTINGS_MODULE_CURRENCY_COURCES_TITLE');
		$this->STN_settings_regions_title = $this->ciObject->lang->line('SETTINGS_MODULE_REGIONS_TITLE');
		$this->STN_settings_countries_title = $this->ciObject->lang->line('SETTINGS_MODULE_COUNTRIES_TITLE');
		$this->STN_settings_cities_title = $this->ciObject->lang->line('SETTINGS_MODULE_CITIES_TITLE');
		$this->STN_settings_main_curr_title = $this->ciObject->lang->line('SETTINGS_MODULE_MAIN_CURR_TITLE');
		$this->STN_settings_add_curr_title = $this->ciObject->lang->line('SETTINGS_MODULE_ADD_CURR_TITLE');
		$this->STN_settings_save_button_title = $this->ciObject->lang->line('SETTINGS_MODULE_SAVE_BUTTON_TITLE');
		$this->STN_settings_change_settings_title = $this->ciObject->lang->line('SETTINGS_MODULE_CHANGE_SETTINGS_TITLE');
		$this->STN_settings_empty_value = $this->ciObject->lang->line('SETTINGS_MODULE_EMPTY_VALUE');
		$this->STN_settings_all_value = $this->ciObject->lang->line('SETTINGS_MODULE_ALL_VALUE');		
		$currentSESS = $this->ciObject->session->userdata('_SI_');
		$this->ciObject->load->model('settings_model');
		if(!isset($currentSESS['SI_SETTINGS'])) { $this->_SetSessionContext(); $currentSESS = $this->ciObject->session->userdata('_SI_');}
		$this->_country_rid = $currentSESS['SI_SETTINGS']['_COUNTRY_RID_'];
		$this->_country_name = $currentSESS['SI_SETTINGS']['_COUNTRY_NAME_'];
		$this->_region_rid = $currentSESS['SI_SETTINGS']['_REGION_RID_'];
		$this->_region_name = $currentSESS['SI_SETTINGS']['_REGION_NAME_'];
		$this->_city_rid = $currentSESS['SI_SETTINGS']['_CITY_RID_'];
		$this->_city_name = $currentSESS['SI_SETTINGS']['_CITY_NAME_'];
		$this->_main_currency_rid = $currentSESS['SI_SETTINGS']['_MAIN_CURR_RID_'];
		$this->_main_currency_cod = $currentSESS['SI_SETTINGS']['_MAIN_CURR_COD_'];
		$this->_main_currency_name = $currentSESS['SI_SETTINGS']['_MAIN_CURR_NAME_'];
		$this->_add_currency_rid = $currentSESS['SI_SETTINGS']['_ADD_CURR_RID_'];
		$this->_add_currency_cod = $currentSESS['SI_SETTINGS']['_ADD_CURR_COD_'];
		$this->_add_currency_name = $currentSESS['SI_SETTINGS']['_ADD_CURR_NAME_'];
	}

	public function SetCountryRid($countryRID)
	{
		$st = $this->ciObject->settings_model->GetSettings($countryRID);
		$this->_country_rid = (isset($st['countryRID']))?$st['countryRID']:null;
		$this->_country_name = (isset($st['countryNAME']))?$st['countryNAME']:null;
		$this->_region_rid = (isset($st['regionRID']))?$st['regionRID']:null;
		$this->_region_name = (isset($st['regionNAME']))?$st['regionNAME']:$this->ciObject->lang->line('SETTINGS_MODULE_ALL_VALUE');
		$this->_city_rid = (isset($st['cityRID']))?$st['cityRID']:null;
		$this->_city_name = (isset($st['cityNAME']))?$st['cityNAME']:$this->ciObject->lang->line('SETTINGS_MODULE_ALL_VALUE');
		$this->_main_currency_rid = (isset($st['currencyRID']))?$st['currencyRID']:null;
		$this->_main_currency_cod = (isset($st['currencyCOD']))?$st['currencyCOD']:null;
		$this->_main_currency_name = (isset($st['currencyNAME']))?$st['currencyNAME']:null;
		$this->_add_currency_rid = (isset($st['addcurrencyRID']))?$st['addcurrencyRID']:null;
		$this->_add_currency_cod = (isset($st['addcurrencyCOD']))?$st['addcurrencyCOD']:null;
		$this->_add_currency_name = (isset($st['addcurrencyNAME']))?$st['addcurrencyNAME']:null;
		return;
	}
	
	public function RenderSettingsArea()
	{
		$this->objectsArr['settings_area_title'] = $this->STN_settings_area_title;
		$this->objectsArr['curr_list_title'] = $this->STN_settings_curr_list_title;
		$this->objectsArr['curr_cources_title'] = $this->STN_settings_curr_cources_title;
		$this->objectsArr['settings_regions_title'] = $this->STN_settings_regions_title;
		$this->objectsArr['settings_countries_title'] = $this->STN_settings_countries_title;
		$this->objectsArr['settings_cities_title'] = $this->STN_settings_cities_title;
		$this->objectsArr['settings_main_curr_title'] = $this->STN_settings_main_curr_title;
		$this->objectsArr['settings_add_curr_title'] = $this->STN_settings_add_curr_title;
		$this->objectsArr['settings_change_settings_title'] = anchor(base_url().index_page().'/settings',
																	$this->STN_settings_change_settings_title.' <b class="more"></b>',
																	array('class'=>'c69', 'style'=>'float: right;'));
		$currentSESS = $this->ciObject->session->userdata('_SI_');
		$this->objectsArr['settings_officialcources'] = $this->ciObject->settings_model->GetOfficialCources($this->_country_rid);
		$this->objectsArr['settings_country_rid'] = $this->_country_rid;
		$this->objectsArr['settings_country_name'] = $this->_country_name;
		$this->objectsArr['settings_region_rid'] = $this->_region_rid;
		$this->objectsArr['settings_region_name'] = $this->_region_name;
		$this->objectsArr['settings_city_rid'] = $this->_city_rid;
		$this->objectsArr['settings_city_name'] = $this->_city_name;
		$this->objectsArr['settings_main_curr_rid'] = $this->_main_currency_rid;
		$this->objectsArr['settings_main_curr_cod'] = $this->_main_currency_cod;
		$this->objectsArr['settings_main_curr_name'] = $this->_main_currency_name;
		$this->objectsArr['settings_add_curr_rid'] = $this->_add_currency_rid;
		$this->objectsArr['settings_add_curr_cod'] = $this->_add_currency_cod;
		$this->objectsArr['settings_add_curr_name'] = $this->_add_currency_name;
		return $this->ciObject->load->view('modules/settings_module/settingsarea.php',$this->objectsArr, True);
	}

	public function RenderSetSettingsArea()
	{
		$this->objectsArr['settings_inform_status'] = false;
		if(isset($_POST['settings_country_rid']) && isset($_POST['settings_region_rid']) && 
			isset($_POST['settings_city_rid']) && isset($_POST['settings_add_currency_rid']))
		{
			
			$this->STN_settings_default_country_rid = $_POST['settings_country_rid'];
			$this->STN_settings_default_region_rid = $_POST['settings_region_rid'];
			$this->STN_settings_default_city_rid = $_POST['settings_city_rid'];
			$this->STN_settings_default_add_currency_rid = $_POST['settings_add_currency_rid'];
			$this->_SetSessionContext();
			$currentSESS = $this->ciObject->session->userdata('_SI_');
			$this->_country_rid = $currentSESS['SI_SETTINGS']['_COUNTRY_RID_'];
			$this->_country_name = $currentSESS['SI_SETTINGS']['_COUNTRY_NAME_'];
			$this->_region_rid = $currentSESS['SI_SETTINGS']['_REGION_RID_'];
			$this->_region_name = $currentSESS['SI_SETTINGS']['_REGION_NAME_'];
			$this->_city_rid = $currentSESS['SI_SETTINGS']['_CITY_RID_'];
			$this->_city_name = $currentSESS['SI_SETTINGS']['_CITY_NAME_'];
			$this->_main_currency_rid = $currentSESS['SI_SETTINGS']['_MAIN_CURR_RID_'];
			$this->_main_currency_cod = $currentSESS['SI_SETTINGS']['_MAIN_CURR_COD_'];
			$this->_main_currency_name = $currentSESS['SI_SETTINGS']['_MAIN_CURR_NAME_'];
			$this->_add_currency_rid = $currentSESS['SI_SETTINGS']['_ADD_CURR_RID_'];
			$this->_add_currency_cod = $currentSESS['SI_SETTINGS']['_ADD_CURR_COD_'];
			$this->_add_currency_name = $currentSESS['SI_SETTINGS']['_ADD_CURR_NAME_'];
			$this->objectsArr['settings_inform_status'] = $this->ciObject->lang->line('SETTINGS_MODULE_SETTINGS_SAVED');;
		}
		$this->objectsArr['settings_area_title'] = $this->STN_settings_area_title;
		$this->objectsArr['settings_countries_title'] = $this->STN_settings_countries_title;
		$this->objectsArr['settings_current_country_rid'] = $this->_country_rid;
		$this->objectsArr['settings_current_region_rid'] = ($this->_region_rid)?$this->_region_rid:'0';
		$this->objectsArr['settings_current_city_rid'] = ($this->_city_rid)?$this->_city_rid:'0';
		$this->objectsArr['settings_current_add_currency_rid'] = ($this->_add_currency_rid)?$this->_add_currency_rid:'0';
		$this->objectsArr['settings_countries_list'] = $this->ciObject->settings_model->GetCountriesList();		
		$this->objectsArr['settings_currencies_list'] = $this->ciObject->settings_model->GetCurrenciesList();
		$this->objectsArr['settings_regions_list'] = ($regionsLIST = $this->ciObject->settings_model->GetRegionsList($this->_country_rid))?$regionsLIST:array();
		$this->objectsArr['settings_cities_list'] = ($this->_region_rid)?$this->ciObject->settings_model->GetCitiesList($this->_region_rid):array();
		$this->objectsArr['settings_cities_list'] = ($this->objectsArr['settings_cities_list'])?$this->objectsArr['settings_cities_list']:array();
		$this->objectsArr['settings_regions_title'] = $this->STN_settings_regions_title;
		$this->objectsArr['settings_cities_title'] = $this->STN_settings_cities_title;		
		$this->objectsArr['settings_main_curr_title'] = $this->STN_settings_main_curr_title;
		$this->objectsArr['settings_add_curr_title'] = $this->STN_settings_add_curr_title;
		$this->objectsArr['settings_save_button_title'] = $this->STN_settings_save_button_title;
		$this->objectsArr['settings_all_value'] = $this->STN_settings_all_value;
		foreach($this->objectsArr['settings_currencies_list'] as $key=>$item)
		{
			if($item['rid'] == $this->_main_currency_rid) 
			{
				$this->objectsArr['settings_current_main_currency'] = $item;
				unset($this->objectsArr['settings_currencies_list'][$key]);
			}
		}
		$this->objectsArr['curr_list_title'] = $this->STN_settings_curr_list_title;	
		return $this->ciObject->load->view('modules/settings_module/setsettingsarea.php',$this->objectsArr, True);
	}
	
	public function _SetSessionContext()
	{
		$this->ciObject->load->plugin('geoip');
		$countryCod = GetCountryCod($_SERVER['REMOTE_ADDR']);
		/*
		if($countryCod=='RU'){
		$st = $this->ciObject->settings_model->GetSettings('6',
										                   $this->STN_settings_default_region_rid,
														   $this->STN_settings_default_city_rid,
														   $addcurrencyRID=$this->STN_settings_default_add_currency_rid);
		}	
		else */if($countryCod=='BY'){
		$st = $this->ciObject->settings_model->GetSettings('8',
										                   $this->STN_settings_default_region_rid,
														   $this->STN_settings_default_city_rid,
														   $addcurrencyRID=$this->STN_settings_default_add_currency_rid);
		}
		else {
		$st = $this->ciObject->settings_model->GetSettings($this->STN_settings_default_country_rid,
										                   $this->STN_settings_default_region_rid,
														   $this->STN_settings_default_city_rid,
														   $addcurrencyRID=$this->STN_settings_default_add_currency_rid);
		}
		$currentSESS['SI_SETTINGS']['_COUNTRY_RID_'] = (isset($st['countryRID']))?$st['countryRID']:null;
		$currentSESS['SI_SETTINGS']['_COUNTRY_NAME_'] = (isset($st['countryNAME']))?$st['countryNAME']:null;
		$currentSESS['SI_SETTINGS']['_REGION_RID_'] = (isset($st['regionRID']))?$st['regionRID']:null;
		$currentSESS['SI_SETTINGS']['_REGION_NAME_'] = (isset($st['regionNAME']))?$st['regionNAME']:$this->ciObject->lang->line('SETTINGS_MODULE_ALL_VALUE');
		$currentSESS['SI_SETTINGS']['_CITY_RID_'] = (isset($st['cityRID']))?$st['cityRID']:null;
		$currentSESS['SI_SETTINGS']['_CITY_NAME_'] = (isset($st['cityNAME']))?$st['cityNAME']:$this->ciObject->lang->line('SETTINGS_MODULE_ALL_VALUE');
		$currentSESS['SI_SETTINGS']['_MAIN_CURR_RID_'] = (isset($st['currencyRID']))?$st['currencyRID']:null;
		$currentSESS['SI_SETTINGS']['_MAIN_CURR_COD_'] = (isset($st['currencyCOD']))?$st['currencyCOD']:null;
		$currentSESS['SI_SETTINGS']['_MAIN_CURR_NAME_'] = (isset($st['currencyNAME']))?$st['currencyNAME']:null;
		$currentSESS['SI_SETTINGS']['_MAIN_CURR_ENDWORD_'] = (isset($st['currencyENDWORD']))?$st['currencyENDWORD']:null;
		$currentSESS['SI_SETTINGS']['_ADD_CURR_RID_'] = (isset($st['addcurrencyRID']))?$st['addcurrencyRID']:null;
		$currentSESS['SI_SETTINGS']['_ADD_CURR_COD_'] = (isset($st['addcurrencyCOD']))?$st['addcurrencyCOD']:null;
		$currentSESS['SI_SETTINGS']['_ADD_CURR_NAME_'] = (isset($st['addcurrencyNAME']))?$st['addcurrencyNAME']:null;
		$currentSESS['SI_SETTINGS']['_ADD_CURR_ENDWORD_'] = (isset($st['addcurrencyENDWORD']))?$st['addcurrencyENDWORD']:null;
		$this->ciObject->session->set_userdata('_SI_', $currentSESS);
		return;
	}
	
	public function RenderCitiesList($regionRID)
	{
		$settings_cities_list = ($regionRID)?$this->ciObject->settings_model->GetCitiesList($regionRID):array();
		if(!$settings_cities_list) $settings_cities_list = array();
		$data = array();
		
		$data[0] = $this->STN_settings_all_value;
		$options = 'name="settings_cities" id="settings_cities"  class="i" style="width: 100%; font-size: 12px;"';
		foreach($settings_cities_list as $item) $data[$item['rid']] = $item['name'];
		return form_dropdown('settings_city_rid', $data, '0', $options);
	}
}
?>