<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
/*
 * Siclub module
 * Mazvv 28-07-2007
*/
class Siclub_module 
{
	private $ciObject;
	private $objectsArr = array();
	private $_current_siclub_uri_assoc;
	
	public function __construct()
	{
		$this->ciObject = &get_instance();
		$this->ciObject->lang->load('siclub_module');
		$this->_current_siclub_uri_assoc = $this->ciObject->uri->uri_to_assoc(2);
		$this->ciObject->load->model('siclub_model');
	}

	public function RenderSiclubLoginArea()
	{
		$currentSESS = $this->ciObject->session->userdata('_SI_');
		$this->objectsArr['siclub_loginarea_title'] = $this->ciObject->lang->line('SICLUB_MODULE_LOGINAREA_TITLE');
		if(isset($_POST['login_siclub']) && isset($_POST['password_siclub']))
		{
			if($checkResult = $this->ciObject->siclub_model->CheckSiclubLogin($_POST['login_siclub'],md5($_POST['password_siclub'])))			
			{
				$currentSESS['SI_SICLUB']['_CLIENTS_RID_'] = $checkResult['_clients_rid'];
				$currentSESS['SI_SICLUB']['_USER_RID_'] = $checkResult['rid'];
				$currentSESS['SI_SICLUB']['_USER_DISPLAYNAME_'] = $checkResult['displayname'];								
				$currentSESS['SI_SICLUB']['_USER_LOGIN_'] = $checkResult['login'];
				$currentSESS['SI_SICLUB']['_USER_EMAIL_'] = $checkResult['email'];
				$currentSESS['SI_SICLUB']['_USER_CLNAME_'] = $checkResult['clname'];
				$this->ciObject->session->set_userdata('_SI_', $currentSESS);
			}
		}
		if(!isset($currentSESS['SI_SICLUB']))
		{
			$this->objectsArr['siclub_login_label'] = $this->ciObject->lang->line('SICLUB_MODULE_LOGIN_TITLE');
			$this->objectsArr['siclub_password_label'] = $this->ciObject->lang->line('SICLUB_MODULE_PASSWD_TITLE');
			$this->objectsArr['siclub_registration_title'] = $this->ciObject->lang->line('SICLUB_MODULE_REGISTRATION_TITLE');
			return $this->ciObject->load->view('modules/siclub_module/siclubloginarea.php',$this->objectsArr, True);
		}
		else
		{
			$this->objectsArr['siclub_login_success_label'] = $this->ciObject->lang->line('SICLUB_MODULE_LOGIN_SUCCESS_TITLE');
			$this->objectsArr['siclub_login_client_name'] = $currentSESS['SI_SICLUB']['_USER_CLNAME_'];
			$this->objectsArr['siclub_login_user_name'] = $currentSESS['SI_SICLUB']['_USER_DISPLAYNAME_'];
			$this->objectsArr['siclub_login_logout_label'] = $this->ciObject->lang->line('SICLUB_MODULE_LOGOUT_TITLE');

			$this->objectsArr['siclub_login_general_label'] = $this->ciObject->lang->line('SICLUB_MODULE_GENERAL_INFO_TITLE');
			$this->objectsArr['siclub_login_contacts_label'] = $this->ciObject->lang->line('SICLUB_MODULE_CONTACTS_INFO_TITLE');
			$this->objectsArr['siclub_login_addinfo_label'] = $this->ciObject->lang->line('SICLUB_MODULE_ADD_INFO_TITLE');
			$this->objectsArr['siclub_login_priceinfo_label'] = $this->ciObject->lang->line('SICLUB_MODULE_PRICE_INFO_TITLE');
			$this->objectsArr['siclub_login_personal_label'] = $this->ciObject->lang->line('SICLUB_MODULE_PERSONAL_INFO_TITLE');
			$this->objectsArr['siclub_login_account_label'] = $this->ciObject->lang->line('SICLUB_MODULE_ACCOUNT_INFO_TITLE');
			return $this->ciObject->load->view('modules/siclub_module/siclublogin.php',$this->objectsArr, True);
		}
	}
	
	public function RenderSiclubArea()
	{
		if($this->_CheckLogged())
		{
			$this->objectsArr['siclub_loginsuccess_title'] = $this->ciObject->lang->line('SICLUB_MODULE_LOGIN_SUCCESS_TITLE');			
			$this->objectsArr['siclub_loginsuccess_note'] = $this->ciObject->lang->line('SICLUB_MODULE_LOGIN_SUCCESS_NOTE');			
			return $this->ciObject->load->view('modules/siclub_module/siclubloginsuccess.php',$this->objectsArr, True);
		}
		else
		{
			$this->objectsArr['siclub_loginfailed_title'] = $this->ciObject->lang->line('SICLUB_MODULE_LOGIN_FAILED_TITLE');			
			$this->objectsArr['siclub_loginfailed_note'] = $this->ciObject->lang->line('SICLUB_MODULE_LOGIN_FAILED_NOTE');			
			return $this->ciObject->load->view('modules/siclub_module/siclubloginfailed.php',$this->objectsArr, True);
		}
	}

	public function RenderGeneralInfo()
	{
		if(!$this->_CheckLogged()) return $this->RenderSiclubArea();
		$currentSESS = $this->ciObject->session->userdata('_SI_');
		$this->objectsArr['siclub_generalinfo_res'] = $this->ciObject->siclub_model->GetClientArr($currentSESS['SI_SICLUB']['_USER_RID_']);
		$this->objectsArr['siclub_generalinfo_title'] = $this->ciObject->lang->line('SICLUB_MODULE_GENERALINFO_TITLE');					
		$this->objectsArr['siclub_urform_label'] = $this->ciObject->lang->line('SICLUB_MODULE_URFORM_LABEL');
		$this->objectsArr['siclub_urform_descr'] = $this->ciObject->lang->line('SICLUB_MODULE_URFORM_DESCR');
		$this->objectsArr['siclub_urform_list'] = array();
		$urformsList = $this->ciObject->siclub_model->GetUrformsList();
		foreach ($urformsList as $item) $this->objectsArr['siclub_urform_list'][$item['rid']] = $item['little_name'];
		$this->objectsArr['siclub_name_label'] = $this->ciObject->lang->line('SICLUB_MODULE_NAME_LABEL');
		$this->objectsArr['siclub_name_descr'] = $this->ciObject->lang->line('SICLUB_MODULE_NAME_DESCR');
		$this->objectsArr['siclub_cltypes_label'] = $this->ciObject->lang->line('SICLUB_MODULE_CLTYPES_LABEL');
		$this->objectsArr['siclub_cltypes_descr'] = $this->ciObject->lang->line('SICLUB_MODULE_CLTYPES_DESCR');
		$this->objectsArr['siclub_cltypes_list'] = array();
		$cltypesList = $this->ciObject->siclub_model->GetCltypesList();
		foreach ($cltypesList as $item) $this->objectsArr['siclub_cltypes_list'][$item['rid']] = $item['name'];
		$this->objectsArr['siclub_countries_label'] = $this->ciObject->lang->line('SICLUB_MODULE_COUNTRIES_LABEL');
		$this->objectsArr['siclub_countries_descr'] = $this->ciObject->lang->line('SICLUB_MODULE_COUNTRIES_DESCR');
		$this->objectsArr['siclub_countries_list'] = array();
		$countriesList = $this->ciObject->siclub_model->GetCountriesList();
		foreach ($countriesList as $item) $this->objectsArr['siclub_countries_list'][$item['rid']] = $item['name'];
		
		$this->objectsArr['siclub_regions_label'] = $this->ciObject->lang->line('SICLUB_MODULE_REGIONS_LABEL');
		$this->objectsArr['siclub_regions_descr'] = $this->ciObject->lang->line('SICLUB_MODULE_REGIONS_DESCR');
		$this->objectsArr['siclub_regions_list'] = array();
		$regionsList = $this->ciObject->siclub_model->GetRegionsList($this->objectsArr['siclub_generalinfo_res']['countryRID']);
		if(!$regionsList) $regionsList = array();
		foreach ($regionsList as $item) $this->objectsArr['siclub_regions_list'][$item['rid']] = $item['name'];
		
		$this->objectsArr['siclub_cities_label'] = $this->ciObject->lang->line('SICLUB_MODULE_CITIES_LABEL');
		$this->objectsArr['siclub_cities_descr'] = $this->ciObject->lang->line('SICLUB_MODULE_CITIES_DESCR');
		$this->objectsArr['siclub_cities_list'] = array();
		if($regionsList) $citiesList = $this->ciObject->siclub_model->GetCitiesList($this->objectsArr['siclub_generalinfo_res']['cityRID']);
		else $citiesList = null;
		if($citiesList)	foreach ($citiesList as $item) $this->objectsArr['siclub_cities_list'][$item['rid']] = $item['name'];
		else $this->objectsArr['siclub_cities_list']=array();

		$this->objectsArr['siclub_zip_label'] = $this->ciObject->lang->line('SICLUB_MODULE_ZIP_LABEL');
		$this->objectsArr['siclub_zip_descr'] = $this->ciObject->lang->line('SICLUB_MODULE_ZIP_DESCR');

		$this->objectsArr['siclub_street_label'] = $this->ciObject->lang->line('SICLUB_MODULE_STREET_LABEL');
		$this->objectsArr['siclub_street_descr'] = $this->ciObject->lang->line('SICLUB_MODULE_STREET_DESCR');
		
		$this->objectsArr['siclub_build_label'] = $this->ciObject->lang->line('SICLUB_MODULE_BUILD_LABEL');
		$this->objectsArr['siclub_build_descr'] = $this->ciObject->lang->line('SICLUB_MODULE_BUILD_DESCR');
		$this->objectsArr['siclub_requires'] = $this->ciObject->lang->line('SICLUB_MODULE_REQUIRES');
		$this->objectsArr['siclub_save_changes'] = $this->ciObject->lang->line('SICLUB_MODULE_SAVE_CHANGES');

		$rules['urform'] = "trim|required";
		$rules['name'] = "trim|required|min_length[2]|max_length[45]";
		$rules['cltype'] = "trim|required";
		$rules['country'] = "trim|required";
		$rules['region'] = "trim|required";
		$rules['city'] = "trim|required";
		$rules['zip'] = "trim|required|numeric|min_length[2]|max_length[10]";
		$rules['street'] = "trim|required|max_length[45]";
		$rules['build'] = "trim|required|max_length[45]";
		
		$fields['urform'] = $this->objectsArr['siclub_urform_label'];
		$fields['name'] = $this->objectsArr['siclub_name_label'];
		$fields['cltype'] = $this->objectsArr['siclub_cltypes_label'];
		$fields['country'] = $this->objectsArr['siclub_countries_label'];
		$fields['region'] = $this->objectsArr['siclub_regions_label'];
		$fields['city'] = $this->objectsArr['siclub_cities_label'];
		$fields['zip'] = $this->objectsArr['siclub_zip_label'];
		$fields['street'] = $this->objectsArr['siclub_street_label'];
		$fields['build'] = $this->objectsArr['siclub_build_label'];

		$this->ciObject->validation->set_error_delimiters('<br><span style="font-size:90%;color:red;">', '</div>');
		$this->ciObject->validation->set_rules($rules);
		$this->ciObject->validation->set_fields($fields);
		
		if ($this->ciObject->validation->run() == FALSE)		
		{
			return $this->ciObject->load->view('modules/siclub_module/generalinfo.php',$this->objectsArr, True);
		}
		$updateARR = array('_urforms_rid'=>$_POST['urform'], 'name'=>$_POST['name'], '_cltypes_rid'=>$_POST['cltype'],
							'_cities_rid'=>$_POST['city'], 'zip'=>$_POST['zip'], 'street'=>$_POST['street'], 'build'=>$_POST['build']);
		$this->ciObject->siclub_model->SaveGeneralInfo($currentSESS['SI_SICLUB']['_CLIENTS_RID_'], $updateARR);
		return $this->ciObject->load->view('modules/siclub_module/generalinfo.php',$this->objectsArr, True);
	}

	public function RenderContactsInfo()	
	{
		if(!$this->_CheckLogged()) return $this->RenderSiclubArea();
		$currentSESS = $this->ciObject->session->userdata('_SI_');
		$this->objectsArr['siclub_contactsinfo_res'] = $this->ciObject->siclub_model->GetClientArr($currentSESS['SI_SICLUB']['_USER_RID_']);
		$this->objectsArr['siclub_contactsinfo_title'] = $this->ciObject->lang->line('SICLUB_MODULE_CONTACTSINFO_TITLE');					
		$this->objectsArr['siclub_phones_label'] = $this->ciObject->lang->line('SICLUB_MODULE_PHONES_LABEL');
		$this->objectsArr['siclub_phones_descr'] = $this->ciObject->lang->line('SICLUB_MODULE_PHONES_DESCR');

		$this->objectsArr['siclub_skype_label'] = $this->ciObject->lang->line('SICLUB_MODULE_SKYPE_LABEL');
		$this->objectsArr['siclub_skype_descr'] = $this->ciObject->lang->line('SICLUB_MODULE_SKYPE_DESCR');

		$this->objectsArr['siclub_icq_label'] = $this->ciObject->lang->line('SICLUB_MODULE_ICQ_LABEL');
		$this->objectsArr['siclub_icq_descr'] = $this->ciObject->lang->line('SICLUB_MODULE_ICQ_DESCR');

		$this->objectsArr['siclub_msn_label'] = $this->ciObject->lang->line('SICLUB_MODULE_MSN_LABEL');
		$this->objectsArr['siclub_msn_descr'] = $this->ciObject->lang->line('SICLUB_MODULE_MSN_DESCR');

		$this->objectsArr['siclub_www_label'] = $this->ciObject->lang->line('SICLUB_MODULE_WWW_LABEL');
		$this->objectsArr['siclub_www_descr'] = $this->ciObject->lang->line('SICLUB_MODULE_WWW_DESCR');

		$this->objectsArr['siclub_requires'] = $this->ciObject->lang->line('SICLUB_MODULE_REQUIRES');
		$this->objectsArr['siclub_save_changes'] = $this->ciObject->lang->line('SICLUB_MODULE_SAVE_CHANGES');

		$rules['phones'] = "trim|required|max_length[255]";
		$rules['skype'] = "trim|max_length[45]";
		$rules['icq'] = "trim|max_length[10]";
		$rules['msn'] = "trim|max_length[45]";
		$rules['www'] = "trim|required|max_length[45]";
		
		$fields['phones'] = $this->objectsArr['siclub_phones_label'];
		$fields['skype'] = $this->objectsArr['siclub_skype_label'];
		$fields['icq'] = $this->objectsArr['siclub_icq_label'];
		$fields['msn'] = $this->objectsArr['siclub_msn_label'];
		$fields['www'] = $this->objectsArr['siclub_www_label'];
		$this->ciObject->validation->set_error_delimiters('<br><span style="font-size:90%;color:red;">', '</div>');
		$this->ciObject->validation->set_rules($rules);
		$this->ciObject->validation->set_fields($fields);
		if ($this->ciObject->validation->run() == FALSE)		
		{
			return $this->ciObject->load->view('modules/siclub_module/contactsinfo.php',$this->objectsArr, True);
		}
		$updateARR = array('wphones'=>$_POST['phones'], 'skype'=>$_POST['skype'], 'icq'=>$_POST['icq'],
							'msn'=>$_POST['msn'], 'url'=>$_POST['www']);
		$this->ciObject->siclub_model->SaveGeneralInfo($currentSESS['SI_SICLUB']['_CLIENTS_RID_'], $updateARR);
		return $this->ciObject->load->view('modules/siclub_module/contactsinfo.php',$this->objectsArr, True);
		
	}
	
	public function RenderAddInfo()
	{
		if(!$this->_CheckLogged()) return $this->RenderSiclubArea();
		$currentSESS = $this->ciObject->session->userdata('_SI_');
		$this->objectsArr['siclub_addinfo_res'] = $this->ciObject->siclub_model->GetClientArr($currentSESS['SI_SICLUB']['_USER_RID_']);
		$this->objectsArr['siclub_addinfo_title'] = $this->ciObject->lang->line('SICLUB_MODULE_ADDINFO_TITLE');					
		$this->objectsArr['siclub_descr_label'] = $this->ciObject->lang->line('SICLUB_MODULE_DESCR_LABEL');
		$this->objectsArr['siclub_descr_descr'] = $this->ciObject->lang->line('SICLUB_MODULE_DESCR_DESCR');

		$this->objectsArr['siclub_credit_label'] = $this->ciObject->lang->line('SICLUB_MODULE_CREDIT_LABEL');
		$this->objectsArr['siclub_credit_descr'] = $this->ciObject->lang->line('SICLUB_MODULE_CREDIT_DESCR');

		$this->objectsArr['siclub_delivery_label'] = $this->ciObject->lang->line('SICLUB_MODULE_DELIVERY_LABEL');
		$this->objectsArr['siclub_delivery_descr'] = $this->ciObject->lang->line('SICLUB_MODULE_DELIVERY_DESCR');
		
		$this->objectsArr['siclub_wtime_label'] = $this->ciObject->lang->line('SICLUB_MODULE_WTIME_LABEL');
		$this->objectsArr['siclub_wtime_descr'] = $this->ciObject->lang->line('SICLUB_MODULE_WTIME_DESCR');

		$this->objectsArr['siclub_requires'] = $this->ciObject->lang->line('SICLUB_MODULE_REQUIRES');
		$this->objectsArr['siclub_save_changes'] = $this->ciObject->lang->line('SICLUB_MODULE_SAVE_CHANGES');		
		
		$rules['descr'] = "trim|required|max_length[1000]";
		$rules['credit'] = "trim|required|max_length[1000]";
		$rules['delivery'] = "trim|required|max_length[1000]";
		$rules['wtime'] = "trim|required|max_length[255]";
		
		$fields['descr'] = $this->objectsArr['siclub_descr_label'];
		$fields['credit'] = $this->objectsArr['siclub_credit_label'];
		$fields['delivery'] = $this->objectsArr['siclub_delivery_label'];
		$fields['wtime'] = $this->objectsArr['siclub_wtime_label'];
		
		$this->ciObject->validation->set_error_delimiters('<br><span style="font-size:90%;color:red;">', '</div>');
		$this->ciObject->validation->set_rules($rules);
		$this->ciObject->validation->set_fields($fields);
		if ($this->ciObject->validation->run() == FALSE)		
		{
			return $this->ciObject->load->view('modules/siclub_module/addinfo.php',$this->objectsArr, True);
		}
		$updateARR = array('descr'=>$_POST['descr'], 'creadits_info'=>$_POST['credit'], 'delivery_info'=>$_POST['delivery'],
							'worktime_info'=>$_POST['wtime']);
		$this->ciObject->siclub_model->SaveGeneralInfo($currentSESS['SI_SICLUB']['_CLIENTS_RID_'], $updateARR);
		return $this->ciObject->load->view('modules/siclub_module/addinfo.php',$this->objectsArr, True);
	}
	
	public function RenderPriceInfo()
	{
		if(!$this->_CheckLogged()) return $this->RenderSiclubArea();
		$currentSESS = $this->ciObject->session->userdata('_SI_');
		$this->objectsArr['siclub_priceinfo_res'] = $this->ciObject->siclub_model->GetClientArr($currentSESS['SI_SICLUB']['_USER_RID_']);
		$this->objectsArr['siclub_priceinfo_title'] = $this->ciObject->lang->line('SICLUB_MODULE_PRICEINFO_TITLE');					
		$this->objectsArr['siclub_isprice_label'] = $this->ciObject->lang->line('SICLUB_MODULE_ISPRICE_LABEL');
		$this->objectsArr['siclub_isprice_descr'] = $this->ciObject->lang->line('SICLUB_MODULE_ISPRICE_DESCR');

		$this->objectsArr['siclub_adays_label'] = $this->ciObject->lang->line('SICLUB_MODULE_ADAYS_LABEL');
		$this->objectsArr['siclub_adays_descr'] = $this->ciObject->lang->line('SICLUB_MODULE_ADAYS_DESCR');

		$this->objectsArr['siclub_ahours_label'] = $this->ciObject->lang->line('SICLUB_MODULE_AHOURS_LABEL');
		$this->objectsArr['siclub_ahours_descr'] = $this->ciObject->lang->line('SICLUB_MODULE_AHOURS_DESCR');
		
		$this->objectsArr['siclub_prurl_label'] = $this->ciObject->lang->line('SICLUB_MODULE_PRURL_LABEL');
		$this->objectsArr['siclub_prurl_descr'] = $this->ciObject->lang->line('SICLUB_MODULE_PRURL_DESCR');
		
		$this->objectsArr['siclub_requires'] = $this->ciObject->lang->line('SICLUB_MODULE_REQUIRES');
		$this->objectsArr['siclub_save_changes'] = $this->ciObject->lang->line('SICLUB_MODULE_SAVE_CHANGES');
		$this->objectsArr['siclub_yes'] = $this->ciObject->lang->line('SICLUB_MODULE_YES');
		$this->objectsArr['siclub_no'] = $this->ciObject->lang->line('SICLUB_MODULE_NO');
		
		$rules['isprice'] = "trim|required";
		$rules['adays'] = "trim|max_length[255]";
		$rules['ahours'] = "trim|max_length[255";
		$rules['prurl'] = "trim|max_length[255]";
		
		
		$fields['isprice'] = $this->objectsArr['siclub_isprice_label'];		
		$fields['adays'] = $this->objectsArr['siclub_adays_label'];
		$fields['ahours'] = $this->objectsArr['siclub_ahours_label'];
		$fields['prurl'] = $this->objectsArr['siclub_prurl_label'];
		
		$this->ciObject->validation->set_error_delimiters('<br><span style="font-size:90%;color:red;">', '</div>');
		$this->ciObject->validation->set_rules($rules);
		$this->ciObject->validation->set_fields($fields);
		if ($this->ciObject->validation->run() == FALSE)		
		{
			return $this->ciObject->load->view('modules/siclub_module/priceinfo.php',$this->objectsArr, True);
		}
		$updateARR = array('pr_load'=>$_POST['isprice'], 'pr_actual_days'=>$_POST['adays'], 
							'pr_actual_hours'=>$_POST['ahours'], 'pr_url'=>$_POST['prurl']);
		$this->ciObject->siclub_model->SaveGeneralInfo($currentSESS['SI_SICLUB']['_CLIENTS_RID_'], $updateARR);
		return $this->ciObject->load->view('modules/siclub_module/priceinfo.php',$this->objectsArr, True);
	}
	
	public function RenderPersonalInfo()
	{
		if(!$this->_CheckLogged()) return $this->RenderSiclubArea();
		$currentSESS = $this->ciObject->session->userdata('_SI_');
		$this->objectsArr['siclub_personalinfo_res'] = $this->ciObject->siclub_model->GetClientArr($currentSESS['SI_SICLUB']['_USER_RID_']);
		$this->objectsArr['siclub_personalinfo_title'] = $this->ciObject->lang->line('SICLUB_MODULE_PERSONALINFO_TITLE');					
		$this->objectsArr['siclub_cphones_label'] = $this->ciObject->lang->line('SICLUB_MODULE_CPHONES_LABEL');
		$this->objectsArr['siclub_cphones_descr'] = $this->ciObject->lang->line('SICLUB_MODULE_CPHONES_DESCR');

		$this->objectsArr['siclub_cmail_label'] = $this->ciObject->lang->line('SICLUB_MODULE_CMAIL_LABEL');
		$this->objectsArr['siclub_cmail_descr'] = $this->ciObject->lang->line('SICLUB_MODULE_CMAIL_DESCR');

		$this->objectsArr['siclub_cperson_label'] = $this->ciObject->lang->line('SICLUB_MODULE_CPERSON_LABEL');
		$this->objectsArr['siclub_cperson_descr'] = $this->ciObject->lang->line('SICLUB_MODULE_CPERSON_DESCR');

		$this->objectsArr['siclub_login_label'] = $this->ciObject->lang->line('SICLUB_MODULE_LOGIN_LABEL');
		$this->objectsArr['siclub_login_descr'] = $this->ciObject->lang->line('SICLUB_MODULE_LOGIN_DESCR');
		
		$this->objectsArr['siclub_passwd_label'] = $this->ciObject->lang->line('SICLUB_MODULE_PASSWD_LABEL');
		$this->objectsArr['siclub_passwd_descr'] = $this->ciObject->lang->line('SICLUB_MODULE_PASSWD_DESCR');
		
		$this->objectsArr['siclub_cpasswd_label'] = $this->ciObject->lang->line('SICLUB_MODULE_СPASSWD_LABEL');
		$this->objectsArr['siclub_cpasswd_descr'] = $this->ciObject->lang->line('SICLUB_MODULE_СPASSWD_DESCR');
		
		$this->objectsArr['siclub_uemail_label'] = $this->ciObject->lang->line('SICLUB_MODULE_UEMAIL_LABEL');
		$this->objectsArr['siclub_uemail_descr'] = $this->ciObject->lang->line('SICLUB_MODULE_UEMAIL_DESCR');

		$this->objectsArr['siclub_dname_label'] = $this->ciObject->lang->line('SICLUB_MODULE_DNAME_LABEL');
		$this->objectsArr['siclub_dname_descr'] = $this->ciObject->lang->line('SICLUB_MODULE_DNAME_DESCR');

		
		$this->objectsArr['siclub_requires'] = $this->ciObject->lang->line('SICLUB_MODULE_REQUIRES');
		$this->objectsArr['siclub_save_changes'] = $this->ciObject->lang->line('SICLUB_MODULE_SAVE_CHANGES');		
	
		$rules['cphones'] = "trim|max_length[255]";
		$rules['cmail'] = "trim|required|max_length[255]|valid_email";
		$rules['cperson'] = "trim|required|max_length[255]";
		//$rules['login'] = "trim|required|max_length[12]|callback__check_login";
		//$rules['passwd'] = "trim|required|matches[cpasswd]|min_length[6]|max_length[12]";
		//$rules['cpasswd'] = "trim|required|max_length[12]";
		//$rules['uemail'] = "trim|required|max_length[255]|valid_email";
		//$rules['dname'] = "trim|required|max_length[255]";
		
		
		$fields['cphones'] = $this->objectsArr['siclub_cphones_label'];
		$fields['cmail'] = $this->objectsArr['siclub_cmail_label'];
		$fields['cperson'] = $this->objectsArr['siclub_cperson_label'];
		//$fields['login'] = $this->objectsArr['siclub_login_label'];
		//$fields['passwd'] = $this->objectsArr['siclub_passwd_label'];
		//$fields['cpasswd'] = $this->objectsArr['siclub_cpasswd_label'];
		//$fields['uemail'] = $this->objectsArr['siclub_uemail_label'];
		//$fields['dname'] = $this->objectsArr['siclub_dname_label'];
		
		$this->ciObject->validation->set_error_delimiters('<br><span style="font-size:90%;color:red;">', '</div>');
		$this->ciObject->validation->set_rules($rules);
		$this->ciObject->validation->set_fields($fields);
		if ($this->ciObject->validation->run() == FALSE)		
		{
			echo $this->ciObject->validation->error_string;
			return $this->ciObject->load->view('modules/siclub_module/personalinfo.php',$this->objectsArr, True);
		}
		$updateARR = array('contact_phones'=>$_POST['cphones'], 'contact_email'=>$_POST['cmail'], 
							'contact_person'=>$_POST['cperson']);
		$this->ciObject->siclub_model->SaveGeneralInfo($currentSESS['SI_SICLUB']['_CLIENTS_RID_'], $updateARR);
		return $this->ciObject->load->view('modules/siclub_module/personalinfo.php',$this->objectsArr, True);
	}

	public function RenderAccountInfo()
	{
		if(!$this->_CheckLogged()) return $this->RenderSiclubArea();
		$currentSESS = $this->ciObject->session->userdata('_SI_');
		$this->objectsArr['siclub_accountinfo_res'] = $this->ciObject->siclub_model->GetClientArr($currentSESS['SI_SICLUB']['_USER_RID_']);
		$this->objectsArr['siclub_accountinfo_title'] = $this->ciObject->lang->line('SICLUB_MODULE_ACCOUNTINFO_TITLE');					
		$this->objectsArr['siclub_cphones_label'] = $this->ciObject->lang->line('SICLUB_MODULE_CPHONES_LABEL');
		$this->objectsArr['siclub_cphones_descr'] = $this->ciObject->lang->line('SICLUB_MODULE_CPHONES_DESCR');

		$this->objectsArr['siclub_cmail_label'] = $this->ciObject->lang->line('SICLUB_MODULE_CMAIL_LABEL');
		$this->objectsArr['siclub_cmail_descr'] = $this->ciObject->lang->line('SICLUB_MODULE_CMAIL_DESCR');

		$this->objectsArr['siclub_cperson_label'] = $this->ciObject->lang->line('SICLUB_MODULE_CPERSON_LABEL');
		$this->objectsArr['siclub_cperson_descr'] = $this->ciObject->lang->line('SICLUB_MODULE_CPERSON_DESCR');

		$this->objectsArr['siclub_login_label'] = $this->ciObject->lang->line('SICLUB_MODULE_LOGIN_LABEL');
		$this->objectsArr['siclub_login_descr'] = $this->ciObject->lang->line('SICLUB_MODULE_LOGIN_DESCR');
		
		$this->objectsArr['siclub_passwd_label'] = $this->ciObject->lang->line('SICLUB_MODULE_PASSWD_LABEL');
		$this->objectsArr['siclub_passwd_descr'] = $this->ciObject->lang->line('SICLUB_MODULE_PASSWD_DESCR');
		
		$this->objectsArr['siclub_cpasswd_label'] = $this->ciObject->lang->line('SICLUB_MODULE_СPASSWD_LABEL');
		$this->objectsArr['siclub_cpasswd_descr'] = $this->ciObject->lang->line('SICLUB_MODULE_СPASSWD_DESCR');
		
		$this->objectsArr['siclub_uemail_label'] = $this->ciObject->lang->line('SICLUB_MODULE_UEMAIL_LABEL');
		$this->objectsArr['siclub_uemail_descr'] = $this->ciObject->lang->line('SICLUB_MODULE_UEMAIL_DESCR');

		$this->objectsArr['siclub_dname_label'] = $this->ciObject->lang->line('SICLUB_MODULE_DNAME_LABEL');
		$this->objectsArr['siclub_dname_descr'] = $this->ciObject->lang->line('SICLUB_MODULE_DNAME_DESCR');

		
		$this->objectsArr['siclub_requires'] = $this->ciObject->lang->line('SICLUB_MODULE_REQUIRES');
		$this->objectsArr['siclub_save_changes'] = $this->ciObject->lang->line('SICLUB_MODULE_SAVE_CHANGES');		
	
		//$rules['cphones'] = "trim|max_length[255]";
		//$rules['cmail'] = "trim|required|max_length[255]|valid_email";
		//$rules['cperson'] = "trim|required|max_length[255]";
		$rules['login_siclub'] = "trim|required|max_length[12]";
		$rules['passwd'] = "trim|matches[cpasswd]|min_length[6]|max_length[12]";
		$rules['cpasswd'] = "trim|max_length[12]";
		$rules['uemail'] = "trim|required|max_length[255]|valid_email";
		$rules['dname'] = "trim|required|max_length[255]";
		
		
		//$fields['cphones'] = $this->objectsArr['siclub_cphones_label'];
		//$fields['cmail'] = $this->objectsArr['siclub_cmail_label'];
		//$fields['cperson'] = $this->objectsArr['siclub_cperson_label'];
		$fields['login_siclub'] = $this->objectsArr['siclub_login_label'];
		$fields['passwd'] = $this->objectsArr['siclub_passwd_label'];
		$fields['cpasswd'] = $this->objectsArr['siclub_cpasswd_label'];
		$fields['uemail'] = $this->objectsArr['siclub_uemail_label'];
		$fields['dname'] = $this->objectsArr['siclub_dname_label'];
		
		$this->ciObject->validation->set_error_delimiters('<br><span style="font-size:90%;color:red;">', '</div>');
		$this->ciObject->validation->set_rules($rules);
		$this->ciObject->validation->set_fields($fields);
		if ($this->ciObject->validation->run() == FALSE)		
		{
		    return $this->ciObject->load->view('modules/siclub_module/accountinfo.php',$this->objectsArr, True);
		}
		if(!empty($_POST['passwd']))
		$updateARR = array('login'=>$_POST['login_siclub'], 'email'=>$_POST['uemail'], 
							'displayname'=>$_POST['dname'], 'passwd'=>md5($_POST['passwd']));
		else 
		$updateARR = array('login'=>$_POST['login_siclub'], 'email'=>$_POST['uemail'], 
							'displayname'=>$_POST['dname']);
		$this->ciObject->siclub_model->SaveUserInfo($currentSESS['SI_SICLUB']['_CLIENTS_RID_'], $updateARR);
		return $this->ciObject->load->view('modules/siclub_module/accountinfo.php',$this->objectsArr, True);
	}
	
	
	private function _CheckLogged()
	{
		$currentSESS = $this->ciObject->session->userdata('_SI_');
		if(isset($currentSESS['SI_SICLUB'])) return TRUE;
		return FALSE;	
	}
	
	public function SiclubAreaLogout()
	{
		$currentSESS = $this->ciObject->session->userdata('_SI_');
		if(isset($currentSESS['SI_SICLUB'])) 
		{
			
			unset($currentSESS['SI_SICLUB']);
			$this->ciObject->session->set_userdata('_SI_', $currentSESS);
		}
		return;
	}

	public function _RenderRegionsDropDown($countryRID)
	{
		$data = array();
		$regionsList = $this->ciObject->siclub_model->GetRegionsList($countryRID);
		if(!$regionsList) $regionsList = array();
		foreach ($regionsList as $item) $data[$item['rid']] = $item['name'];
		return form_dropdown('region', $data, '', 'id="region" style="width:150px" class="i" onchange="RegionChange()"');
	}

	public function _RenderCitiesDropDown($regionRID)
	{
		$data = array();
		$citiesList = $this->ciObject->siclub_model->GetCitiesList($regionRID);
		if(!$citiesList) $citiesList = array();
		foreach ($citiesList as $item) $data[$item['rid']] = $item['name'];
		return form_dropdown('city', $data, '', 'id="city" style="width:150px" class="i"');
	}
	
}
?>