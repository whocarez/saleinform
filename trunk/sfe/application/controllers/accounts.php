<?php
/*
 * The Accounts
*/
class Accounts extends Controller 
{
	private $objectsArr = array();
	
	public function __construct(){
		parent::Controller();
		$this->output->enable_profiler(TRUE);
		/* load needed libraries */	
		$this->load->library('navline_module');
		$this->load->library('categories_module');
		$this->load->library('search_module');
		$this->load->library('accounts_module');
		$this->load->library('keywords_module');
		/* generate objects */
		$this->objectsArr['nav_top_obj'] = $this->navline_module->RenderTopMenu();
		$this->objectsArr['topmenu_obj'] = $this->categories_module->renderTabbedMenu();
		$this->objectsArr['search_bar_obj'] = $this->search_module->renderNarrowBar();
		$this->objectsArr['footer_area_obj'] = $this->navline_module->RenderFooterMenu();
		$this->objectsArr['metatitle_area_obj'] = $this->keywords_module->RenderMetatitleArea();
		$this->objectsArr['keywords_area_obj'] = $this->keywords_module->RenderKeywordsArea('');
		$this->objectsArr['metadescription_area_obj'] = $this->keywords_module->RenderMetadescriptionArea();
	}
	
	public function index(){
		$this->objectsArr['account_area_obj'] = $this->accounts_module->loginProcessing();
		$this->load->view('layouts/accounts/accounts.php', $this->objectsArr);
	}
	
	public function login(){
		$this->objectsArr['account_area_obj'] = $this->accounts_module->loginProcessing();
		$this->load->view('layouts/accounts/accounts.php', $this->objectsArr);		
	}

	public function checkLogin($login){
		return $this->accounts_module->checkLogin($login);	
	}
	
	public function logout(){
		$this->accounts_module->logout();
		redirect('accounts', 'refresh');
	}

	public function register(){
		$this->objectsArr['account_area_obj'] = $this->accounts_module->registerProcessing();
		$this->load->view('layouts/accounts/accounts.php', $this->objectsArr);		
	}
	
	public function reloadcaptcha(){
		$this->output->enable_profiler(False);
		$this->output->set_output($this->accounts_module->getCaptcha());	
	}
	
	public function isUniqueLogin($login){
		return $this->accounts_module->isUniqueLogin($login);
	}

	public function isUniqueEmail($email){
		return $this->accounts_module->isUniqueEmail($email);
	}

	public function checkCaptcha($captcha){
		return $this->accounts_module->checkCaptcha($captcha);
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