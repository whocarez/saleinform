<?php
/*
 * The Siclub
*/
class Siclub extends Controller 
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
		$this->load->library('brands_module');
		$this->load->library('accounts_module');
		$this->load->library('mostpopular_module');
		$this->load->library('rating_module');
		$this->load->library('advertise_module');
		$this->load->library('linkchanges_module');
		$this->load->library('navline_module');
		$this->load->library('quickmenu_module');
		$this->load->library('categories_module');
		$this->load->library('contacts_module');
		$this->load->library('keywords_module');
		$this->load->library('siclub_module');
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
		$this->objectsArr['categories_table_obj'] = $this->categories_module->RenderCategoriesTable();
		$this->objectsArr['contactstoolbar_area_obj'] = $this->contacts_module->RenderContactsToolbar();
		$this->objectsArr['metatitle_area_obj'] = $this->keywords_module->RenderMetatitleArea();
		$this->objectsArr['metadescription_area_obj'] = $this->keywords_module->RenderMetadescriptionArea();
		$this->objectsArr['keywords_area_obj'] = "";
	}
	
	public function index()
	{
		$this->ShowSiclubArea();
	}
	
	public function _remap($methodNAME)
	{
		if($methodNAME=='login')
		{
			$this->ShowSiclubArea();	
		}
		else if($methodNAME=='gn')
		{
			$this->ShowGeneralInfo();
		}
		else if($methodNAME=='cnt')
		{
			$this->ShowContactsInfo();
		}
		else if($methodNAME=='add')
		{
			$this->ShowAddInfo();
		}
		else if($methodNAME=='pr')
		{
			$this->ShowPriceInfo();
		}
		else if($methodNAME=='per')
		{
			$this->ShowPersonalInfo();
		}
		else if($methodNAME=='acc')
		{
			$this->ShowAccountInfo();
		}
		else if($methodNAME=='aj_change_country')
		{
			 if($countryRID = $this->uri->segment(3)) $this->_AJAX_change_country();
		}
		else if($methodNAME=='aj_change_region')
		{
			 if($regionRID = $this->uri->segment(3)) $this->_AJAX_change_region();
		}
		else if($methodNAME=='logout')
		{
			$this->SiclubAreaLogout();
		}
		else $this->index();
	}
	
	public function ShowSiclubArea()
	{
		$this->objectsArr['siclub_loginarea_obj'] = $this->siclub_module->RenderSiclubLoginArea();
		$this->objectsArr['siclub_area_obj'] = $this->siclub_module->RenderSiclubArea();
		$this->load->view('layouts/siclub.php', $this->objectsArr);
	}

	public function ShowGeneralInfo()
	{
		$this->objectsArr['siclub_loginarea_obj'] = $this->siclub_module->RenderSiclubLoginArea();
		$this->objectsArr['siclub_area_obj'] = $this->siclub_module->RenderGeneralInfo();
		$this->load->view('layouts/siclub.php', $this->objectsArr);
	}

	public function ShowContactsInfo()
	{
		$this->objectsArr['siclub_loginarea_obj'] = $this->siclub_module->RenderSiclubLoginArea();
		$this->objectsArr['siclub_area_obj'] = $this->siclub_module->RenderContactsInfo();
		$this->load->view('layouts/siclub.php', $this->objectsArr);
	}

	public function ShowAddInfo()
	{
		$this->objectsArr['siclub_loginarea_obj'] = $this->siclub_module->RenderSiclubLoginArea();
		$this->objectsArr['siclub_area_obj'] = $this->siclub_module->RenderAddInfo();
		$this->load->view('layouts/siclub.php', $this->objectsArr);
	}

	public function ShowPriceInfo()
	{
		$this->objectsArr['siclub_loginarea_obj'] = $this->siclub_module->RenderSiclubLoginArea();
		$this->objectsArr['siclub_area_obj'] = $this->siclub_module->RenderPriceInfo();
		$this->load->view('layouts/siclub.php', $this->objectsArr);
	}
	
	public function ShowPersonalInfo()
	{
		$this->objectsArr['siclub_loginarea_obj'] = $this->siclub_module->RenderSiclubLoginArea();
		$this->objectsArr['siclub_area_obj'] = $this->siclub_module->RenderPersonalInfo();
		$this->load->view('layouts/siclub.php', $this->objectsArr);
	}

	public function ShowAccountInfo()
	{
		$this->objectsArr['siclub_loginarea_obj'] = $this->siclub_module->RenderSiclubLoginArea();
		$this->objectsArr['siclub_area_obj'] = $this->siclub_module->RenderAccountInfo();
		$this->load->view('layouts/siclub.php', $this->objectsArr);
	}
	
	public function SiclubAreaLogout()
	{
		$this->siclub_module->SiclubAreaLogout();
		redirect(site_url(), 'refresh');
	}

	private function _AJAX_change_country()
	{
		$countryRID = $this->uri->segment(3);
		echo $this->siclub_module->_RenderRegionsDropDown($countryRID);
	}

	private function _AJAX_change_region()
	{
		$regionRID = $this->uri->segment(3);
		echo $this->siclub_module->_RenderCitiesDropDown($regionRID);
	}

	public function _check_client_name($str)
	{
		$clName = $_POST['name'];
		if(isset($_POST['city'])) $clCity = $_POST['city'];
		else
		{
			$this->validation->set_message('_check_client_name', $this->lang->line('SICLUB_MODULE_CITY_ERROR'));
			return FALSE;
		}
		$this->load->model('clients_model');
		if($this->clients_model->CheckClientName($clName, $clCity))
		{
			$this->validation->set_message('_check_client_name', $this->lang->line('SICLUB_MODULE_NAME_ERROR'));
			return FALSE;
		}
		return TRUE;
	}

	public function  _check_login($str)
	{
		$login = $_POST['login'];
		if($this->clients_model->CheckNewLogin($login))
		{
			$this->validation->set_message('_check_login', $this->lang->line('SICLUB_MODULE_LOGIN_ERROR'));
			return FALSE;
		}
		return TRUE;
	}
	
}
?>