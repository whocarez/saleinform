<?php
/*
 * The Accounts
*/
class Accounts extends Controller 
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
		$this->load->library('categories_module');
		$this->load->library('accounts_module');
		$this->load->library('mostpopular_module');
		$this->load->library('rating_module');
		$this->load->library('advertise_module');
		$this->load->library('linkchanges_module');
		$this->load->library('quickmenu_module');
		$this->load->library('last_module');
		$this->load->library('contacts_module');
		$this->load->library('keywords_module');
		/* generate objects */
		$this->objectsArr['search_bar_obj'] = $this->search_module->RenderSearchBar();
		$this->objectsArr['categories_table_obj'] = $this->categories_module->RenderCategoriesTable();
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
		$this->objectsArr['last_area_obj'] = $this->last_module->RenderLastArea();
		$this->objectsArr['contactstoolbar_area_obj'] = $this->contacts_module->RenderContactsToolbar();
		$this->objectsArr['keywords_area_obj'] = $this->keywords_module->RenderKeywordsArea($this->objectsArr['categories_table_obj']);
		$this->objectsArr['metatitle_area_obj'] = $this->keywords_module->RenderMetatitleArea();
		$this->objectsArr['metadescription_area_obj'] = $this->keywords_module->RenderMetadescriptionArea();
	}
	
	public function index()
	{
		$this->objectsArr['account_area_obj'] = $this->accounts_module->RenderRegistrationArea();
		$this->load->view('layouts/accounts.php', $this->objectsArr);
	}
	
	public function _remap($methodNAME)
	{
		if($methodNAME=='login')
		{
			$this->LogIn();	
		}
		else if($methodNAME=='logout')
		{
			$this->LogOut();	
		}
		else if($methodNAME=='chpass')
		{
			$this->ChangePassword();	
		}
		else if($methodNAME=='restorepass')
		{
			$this->RestorePassword();
		}
		else if($methodNAME=='activate')
		{
			if($this->uri->segment(3)) $this->ActivateAccount($this->uri->segment(3));
		}
		else if($methodNAME=='generatepass')
		{
			if($this->uri->segment(3)) $this->GeneratePass($this->uri->segment(3));
		}
		else $this->index();
	}
	
	public function LogIn()
	{
		if(isset($_POST['login']) && isset($_POST['password'])) 
		{
			if(!$this->accounts_module->LogIn($_POST['login'], $_POST['password']))
				$this->objectsArr['account_area_obj'] = $this->accounts_module->RenderLogInFailed();
			else
			{
				$this->objectsArr['login_area_obj'] = $this->accounts_module->RenderLoginArea();
				$this->objectsArr['account_area_obj'] = null;
				if($this->uri->segment(1)!='accounts') redirect($_POST['curr_url'], 'refresh');				
			}
		}
		$this->load->view('layouts/accounts.php', $this->objectsArr);		
	}

	public function LogOut()
	{
		$this->accounts_module->LogOut();
		$this->objectsArr['login_area_obj'] = $this->accounts_module->RenderLoginArea();
		$this->objectsArr['account_area_obj'] = null;				
		$this->load->view('layouts/accounts.php', $this->objectsArr);		
	}

	public function ChangePassword()
	{
		if(!$this->accounts_module->IsLoggedIn()) $this->objectsArr['account_area_obj'] = null;				
		else
		{ 
			$this->objectsArr['account_area_obj'] = $this->accounts_module->RenderChangePasswordArea();
			# был осуществлен выход из системы поэтому нужно перерендерить панель входа
			$this->objectsArr['login_area_obj'] = $this->accounts_module->RenderLoginArea();
		}			
		$this->load->view('layouts/accounts.php', $this->objectsArr);		
	}

	public function RestorePassword()
	{
		$this->objectsArr['account_area_obj'] = $this->accounts_module->RenderRestorePasswordArea();
		$this->load->view('layouts/accounts.php', $this->objectsArr);
	}
	
	public function ActivateAccount($activateCODE)
	{
		$this->objectsArr['account_area_obj'] = $this->accounts_module->RenderActivationProcessResult($activateCODE);
		$this->load->view('layouts/accounts.php', $this->objectsArr);
	}

	public function GeneratePass($activateCODE)
	{
		$this->objectsArr['account_area_obj'] = $this->accounts_module->RenderGeneratedPassResult($activateCODE);
		$this->load->view('layouts/accounts.php', $this->objectsArr);
	}
	
}
?>