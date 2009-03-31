<?php
/*
 * The Clients
*/
class Clients extends Controller 
{
	private $objectsArr = array();
	
	public function __construct()
	{
		parent::Controller();
		#$this->output->enable_profiler(TRUE);
		/* load needed libraries */	
		$this->load->library('lang_module');
		$this->load->library('settings_module');
		$this->load->library('search_module');
		$this->load->library('clients_module');
		$this->load->library('accounts_module');
		$this->load->library('mostpopular_module');
		$this->load->library('rating_module');
		$this->load->library('advertise_module');
		$this->load->library('linkchanges_module');
		$this->load->library('navline_module');
		$this->load->library('quickmenu_module');
		$this->load->library('contacts_module');
		$this->load->library('keywords_module');
		/* generate objects */
		$this->objectsArr['search_bar_obj'] = $this->search_module->RenderSearchBar();
		$this->objectsArr['login_area_obj'] = $this->accounts_module->RenderLoginArea();
		$this->objectsArr['settings_area_obj'] = $this->settings_module->RenderSettingsArea();
		$this->objectsArr['mostpopular_area_obj'] = $this->mostpopular_module->RenderMostpopularTabbedArea();
		$this->objectsArr['mostpopular_searches_obj'] = $this->mostpopular_module->RenderMostpopularSearchesArea();
		$this->objectsArr['rating_recomend_obj'] = $this->rating_module->RenderRatingRecomendArea();
		$this->objectsArr['rating_products_obj'] = $this->rating_module->RenderRatingProductsArea();	
		$this->objectsArr['advertise_center_obj'] = $this->advertise_module->RenderCenterLinksAdvertiseArea();
		$this->objectsArr['advertise_right_obj'] = $this->advertise_module->RenderRightLinksAdvertiseArea();
		$this->objectsArr['googleads_right_obj'] = $this->advertise_module->RenderGoogleAds_234x60_Area();
		$this->objectsArr['googleads_left_obj'] = $this->advertise_module->RenderGoogleAds_120x90_Area();
		$this->objectsArr['linkchanges_area_obj'] = $this->linkchanges_module->RenderLinkchangesArea();
		$this->objectsArr['quickmenu_area_obj'] = $this->quickmenu_module->RenderQuickmenuArea();
		$this->objectsArr['footermenu_area_obj'] = $this->quickmenu_module->RenderFootermenuArea();
		$this->objectsArr['contactstoolbar_area_obj'] = $this->contacts_module->RenderContactsToolbar();
		$this->objectsArr['metatitle_area_obj'] = $this->keywords_module->RenderMetatitleArea();
		$this->objectsArr['metadescription_area_obj'] = $this->keywords_module->RenderMetadescriptionArea();
	}
	
	public function index()
	{
		$this->ShowRetailersList();
	}
	
	public function _remap($methodNAME)
	{
		if($methodNAME=='c' || $methodNAME=='o' || $methodNAME=='p')
		{
			$this->ShowRetailerInfo();	
		}
		else if($methodNAME=='l')
		{
			$this->ShowRetailersList();	
		}
		else if($methodNAME=='wo')
		{
			$this->ShowWriteOpinionArea();	
		}
		else if($methodNAME=='r')
		{
			$this->ShowRulesArea();	
		}
		else if($methodNAME=='ac1')
		{
			$this->ShowAddClientArea1();	
		}
		else if($methodNAME=='ac2')
		{
			$this->ShowAddClientArea2();	
		}
		else if($methodNAME=='ac3')
		{
			$this->ShowAddClientArea3();	
		}
		else if($methodNAME=='ac4')
		{
			$this->ShowAddClientArea4();	
		}
		else if($methodNAME=='ac5')
		{
			$this->ShowAddClientArea5();	
		}
		else if($methodNAME=='aj_change_country')
		{
			 if($countryRID = $this->uri->segment(3)) $this->_AJAX_change_country();
		}
		else if($methodNAME=='aj_change_region')
		{
			 if($regionRID = $this->uri->segment(3)) $this->_AJAX_change_region();
		}
		else $this->index();
	}
	
	public function ShowRetailerInfo()
	{
		$this->objectsArr['clients_area_obj'] = $this->clients_module->RenderRetailerArea();
		$this->objectsArr['navline_area_obj'] = $this->navline_module->RenderNavigationLine();
		$this->objectsArr['keywords_area_obj'] = $this->keywords_module->RenderKeywordsArea($this->objectsArr['clients_area_obj']);		
		$this->load->view('layouts/clients.php', $this->objectsArr);			
	}
	
	public function ShowRetailersList()
	{
		$this->objectsArr['clients_area_obj'] = $this->clients_module->RenderRetailersList();
		$this->objectsArr['navline_area_obj'] = $this->navline_module->RenderNavigationLine();
		$this->objectsArr['keywords_area_obj'] = $this->keywords_module->RenderKeywordsArea($this->objectsArr['clients_area_obj']);		
		$this->load->view('layouts/clients.php', $this->objectsArr);
	}

	public function ShowWriteOpinionArea()
	{
		$this->objectsArr['clients_area_obj'] = $this->clients_module->RenderRetailersList();
		$this->objectsArr['navline_area_obj'] = $this->navline_module->RenderNavigationLine();
		$this->objectsArr['keywords_area_obj'] = $this->keywords_module->RenderKeywordsArea($this->objectsArr['clients_area_obj']);		
		$this->load->view('layouts/clients.php', $this->objectsArr);
	}

	public function ShowAddClientArea1()
	{
		$this->objectsArr['clients_area_obj'] = $this->clients_module->RenderClRegistrationArea1();
		$this->objectsArr['navline_area_obj'] = $this->navline_module->RenderNavigationLine();
		$this->objectsArr['keywords_area_obj'] = '';		
		$this->load->view('layouts/clients.php', $this->objectsArr);
	}

	public function ShowAddClientArea2()
	{
		$this->objectsArr['clients_area_obj'] = $this->clients_module->RenderClRegistrationArea2();
		$this->objectsArr['navline_area_obj'] = $this->navline_module->RenderNavigationLine();
		$this->objectsArr['keywords_area_obj'] = '';
		$this->load->view('layouts/clients.php', $this->objectsArr);
	}
	
	public function ShowAddClientArea3()
	{
		$this->objectsArr['clients_area_obj'] = $this->clients_module->RenderClRegistrationArea3();
		$this->objectsArr['navline_area_obj'] = $this->navline_module->RenderNavigationLine();
		$this->objectsArr['keywords_area_obj'] = '';
		$this->load->view('layouts/clients.php', $this->objectsArr);
	}

	public function ShowAddClientArea4()
	{
		$this->objectsArr['clients_area_obj'] = $this->clients_module->RenderClRegistrationArea4();
		$this->objectsArr['navline_area_obj'] = $this->navline_module->RenderNavigationLine();
		$this->objectsArr['keywords_area_obj'] = '';
		$this->load->view('layouts/clients.php', $this->objectsArr);
	}
	
	public function ShowAddClientArea5()
	{
		$this->objectsArr['clients_area_obj'] = $this->clients_module->RenderClRegistrationArea5();
		$this->objectsArr['navline_area_obj'] = $this->navline_module->RenderNavigationLine();
		$this->objectsArr['keywords_area_obj'] = '';
		$this->load->view('layouts/clients.php', $this->objectsArr);
	}

	public function ShowRulesArea()
	{
		$this->objectsArr['clients_area_obj'] = $this->clients_module->RenderClRulesArea();
		$this->objectsArr['navline_area_obj'] = $this->navline_module->RenderNavigationLine();
		$this->objectsArr['keywords_area_obj'] = $this->keywords_module->RenderKeywordsArea($this->objectsArr['clients_area_obj']);
		$this->load->view('layouts/clients.php', $this->objectsArr);
	}
	
	private function _AJAX_change_country()
	{
		$countryRID = $this->uri->segment(3);
		echo $this->clients_module->_RenderRegionsDropDown($countryRID);
	}

	private function _AJAX_change_region()
	{
		$regionRID = $this->uri->segment(3);
		echo $this->clients_module->_RenderCitiesDropDown($regionRID);
	}
	
	
	public function _check_client_name($str)
	{
		$clName = $_POST['name'];
		if(isset($_POST['city'])) $clCity = $_POST['city'];
		else
		{
			$this->validation->set_message('_check_client_name', $this->lang->line('CLIENTS_MODULE_CLIENTS_ADD_CITY_ERROR'));
			return FALSE;
		}
		$this->load->model('clients_model');
		if($this->clients_model->CheckClientName($clName, $clCity))
		{
			$this->validation->set_message('_check_client_name', $this->lang->line('CLIENTS_MODULE_CLIENTS_ADD_NAME_ERROR'));
			return FALSE;
		}
		return TRUE;
	}

	public function  _check_login($str)
	{
		$login = $_POST['login'];
		if($this->clients_model->CheckNewLogin($login))
		{
			$this->validation->set_message('_check_login', $this->lang->line('CLIENTS_MODULE_CLIENTS_ADD_LOGIN_ERROR'));
			return FALSE;
		}
		return TRUE;
	}
	
}
?>