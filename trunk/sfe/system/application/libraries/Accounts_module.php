<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
/*
 * Accounts module
 * Mazvv 03-05-2007
*/
class Accounts_module 
{
	private $ciObject;
	private $objectsArr = array();
	private $STN_accounts_login_title; # login area title
	private $STN_accounts_login_label; # login label
	private $STN_accounts_password_label; # password label
	private $STN_accounts_password_confirm_label; # password confirm label
	private $STN_accounts_password_forgot_title; # forgot password title
	private $STN_accounts_registration_title; # registration title
	private $STN_accounts_registration_note; # registration note
	private $STN_accounts_display_name_label; # display_name
	private $STN_accounts_email_label; # email
	private $STN_accounts_security_code_title; # security title	
	private $STN_accounts_security_code_label; # security label	
	private $STN_accounts_security_code_confirm_label; # security confirm label
	private $STN_accounts_registration_required_note; # all of fields is required
	private $STN_accounts_registration_success_note; # registration success
	private $STN_accounts_registration_failure_note; # registration failure
	private $STN_accounts_restore_password_title; # restore password title
	private $STN_accounts_restore_password_note; # restore password note
	private $STN_accounts_registration_activation_title; # register activation title
	private $STN_accounts_registration_activation_note; # register activation note
	private $STN_accounts_activation_failure_note; # register activation failure
	private $STN_accounts_email_from; # email from
	private $STN_accounts_restore_password_failure; # restore password failure
	private $STN_accounts_restore_password_send; # restore password send
	
	public function __construct()
	{
		$this->ciObject = &get_instance();
		$this->ciObject->lang->load('accounts_module');
		$this->ciObject->load->model('accounts_model');
		$this->STN_accounts_login_title = $this->ciObject->lang->line('ACCOUNTS_MODULE_LOGIN_AREA_TITLE');
		$this->STN_accounts_login_label = $this->ciObject->lang->line('ACCOUNTS_MODULE_LOGIN_LABEL');
		$this->STN_accounts_password_label = $this->ciObject->lang->line('ACCOUNTS_MODULE_PASSWORD_LABEL');
		$this->STN_accounts_password_confirm_label = $this->ciObject->lang->line('ACCOUNTS_MODULE_PASSWORD_CONFIRM_LABEL');
		$this->STN_accounts_password_forgot_title = $this->ciObject->lang->line('ACCOUNTS_MODULE_PASSWORD_FORGOT_TITLE');
		$this->STN_accounts_registration_title = $this->ciObject->lang->line('ACCOUNTS_MODULE_REGISTRATION_TITLE');
		$this->STN_accounts_registration_note = $this->ciObject->lang->line('ACCOUNTS_MODULE_REGISTRATION_NOTE');
		$this->STN_accounts_display_name_label = $this->ciObject->lang->line('ACCOUNTS_MODULE_DISPLAY_NAME_LABEL');
		$this->STN_accounts_email_label = $this->ciObject->lang->line('ACCOUNTS_MODULE_EMAIL_LABEL');
		$this->STN_accounts_security_code_title = $this->ciObject->lang->line('ACCOUNTS_MODULE_SECURITY_CODE_TITLE');
		$this->STN_accounts_security_code_label = $this->ciObject->lang->line('ACCOUNTS_MODULE_SECURITY_CODE_LABEL');
		$this->STN_accounts_security_code_confirm_label = $this->ciObject->lang->line('ACCOUNTS_MODULE_SECURITY_CODE_CONFIRM_LABEL');
		$this->STN_accounts_registration_required_note = $this->ciObject->lang->line('ACCOUNTS_MODULE_REGISTRATION_REQUIRED_NOTE');
		$this->STN_accounts_registration_success_note = $this->ciObject->lang->line('ACCOUNTS_MODULE_REGISTRATION_SUCCESS_NOTE');
		$this->STN_accounts_registration_failure_note = $this->ciObject->lang->line('ACCOUNTS_MODULE_REGISTRATION_FAILURE_NOTE');
		$this->STN_accounts_restore_password_title = $this->ciObject->lang->line('ACCOUNTS_MODULE_RESTORE_PASSWORD_TITLE');
		$this->STN_accounts_restore_password_note = $this->ciObject->lang->line('ACCOUNTS_MODULE_RESTORE_PASSWORD_NOTE');	
		$this->STN_accounts_registration_activation_title = $this->ciObject->lang->line('ACCOUNTS_MODULE_REGISTRATION_ACTIVATION_TITLE');
		$this->STN_accounts_registration_activation_note = $this->ciObject->lang->line('ACCOUNTS_MODULE_REGISTRATION_ACTIVATION_NOTE');
		$this->STN_accounts_activation_failure_note = $this->ciObject->lang->line('ACCOUNTS_MODULE_ACTIVATION_FAILURE_NOTE');				
		$this->STN_accounts_restore_password_failure = $this->ciObject->lang->line('ACCOUNTS_MODULE_RESTORE_PASSWORD_FAILURE');
		$this->STN_accounts_restore_password_send = $this->ciObject->lang->line('ACCOUNTS_MODULE_RESTORE_PASSWORD_SEND');
		
		$this->objectsArr['accounts_login_area_title'] = $this->STN_accounts_login_title;
		$this->objectsArr['accounts_login_area_curr_url'] = $this->ciObject->uri->uri_string();
		$this->objectsArr['accounts_login_label'] = $this->STN_accounts_login_label;
		$this->objectsArr['accounts_password_label'] = $this->STN_accounts_password_label;
		$this->objectsArr['accounts_password_confirm_label'] = $this->STN_accounts_password_confirm_label;
		$this->objectsArr['accounts_password_forgot_title'] = $this->STN_accounts_password_forgot_title;
		$this->objectsArr['accounts_registration_title'] = $this->STN_accounts_registration_title;
		$this->objectsArr['accounts_registration_note'] = $this->STN_accounts_registration_note;
		$this->objectsArr['accounts_display_name_label'] = $this->STN_accounts_display_name_label;
		$this->objectsArr['accounts_email_label'] = $this->STN_accounts_email_label;
		$this->objectsArr['accounts_security_code_title'] = $this->STN_accounts_security_code_title;
		$this->objectsArr['accounts_security_code_label'] = $this->STN_accounts_security_code_label;
		$this->objectsArr['accounts_security_code_confirm_label'] = $this->STN_accounts_security_code_confirm_label;
		$this->objectsArr['accounts_registration_required_note'] = $this->STN_accounts_registration_required_note;
		$this->objectsArr['accounts_registration_success_note'] = $this->STN_accounts_registration_success_note;		
		$this->objectsArr['accounts_registration_failure_note'] = $this->STN_accounts_registration_failure_note;
		$this->objectsArr['accounts_restore_password_title'] = $this->STN_accounts_restore_password_title;
		$this->objectsArr['accounts_restore_password_note'] = $this->STN_accounts_restore_password_note;
		$this->objectsArr['accounts_registration_activation_title'] = $this->STN_accounts_registration_activation_title;
		$this->objectsArr['accounts_registration_activation_note'] = $this->STN_accounts_registration_activation_note;
		$this->objectsArr['accounts_activation_failure_note'] = $this->STN_accounts_activation_failure_note;
		$this->objectsArr['accounts_restore_password_failure'] = $this->STN_accounts_restore_password_failure;
		$this->objectsArr['accounts_restore_password_send'] = $this->STN_accounts_restore_password_send;
	}
	
	public function RenderLoginArea()
	{
		$currentSESS = $this->ciObject->session->userdata('_SI_');
		if(isset($currentSESS['SI_LOGIN']))
		{
			$this->objectsArr['accounts_login_success_note'] = sprintf($this->ciObject->lang->line('ACCOUNTS_LOGIN_SUCCESS_NOTE'), 
																		$currentSESS['SI_LOGIN']['_USER_DISPLAY_NAME_']); 

			$this->objectsArr['accounts_login_profile_title'] = $this->ciObject->lang->line('ACCOUNTS_LOGIN_PROFILE_TITLE');
			$this->objectsArr['accounts_login_edit_label'] = $this->ciObject->lang->line('ACCOUNTS_LOGIN_EDIT_LABEL');			 
			$this->objectsArr['accounts_login_chpass_label'] = $this->ciObject->lang->line('ACCOUNTS_LOGIN_CHPASS_LABEL');			 
			$this->objectsArr['accounts_login_statistic_label'] = $this->ciObject->lang->line('ACCOUNTS_LOGIN_STATISTIC_LABEL');			 
			$this->objectsArr['accounts_login_messages_label'] = $this->ciObject->lang->line('ACCOUNTS_LOGIN_MESSAGES_LABEL');			 
			$this->objectsArr['accounts_login_logout_label'] = $this->ciObject->lang->line('ACCOUNTS_LOGIN_LOGOUT_LABEL');			 
			return $this->ciObject->load->view('modules/accounts_module/loginareain.php',$this->objectsArr, True);
		}
		return $this->ciObject->load->view('modules/accounts_module/loginarea.php',$this->objectsArr, True);
	}

	public function RenderRegistrationArea()
	{
		$rules['display_name'] = "trim|required";
		$rules['login'] = "trim|required|min_length[5]|max_length[12]";
		$rules['password'] = "trim|required|matches[confirm_password]|min_length[5]";
		$rules['confirm_password'] = "trim|required";
		$rules['email'] = "trim|required|valid_email";
		$rules['security_code'] = "trim|required|matches[sc]";
		$fields['display_name'] = $this->objectsArr['accounts_display_name_label'];
		$fields['login'] = $this->objectsArr['accounts_login_label'];
		$fields['password'] = $this->objectsArr['accounts_password_label'];
		$fields['confirm_password'] = $this->objectsArr['accounts_password_confirm_label'];
		$fields['email'] = $this->objectsArr['accounts_email_label'];
		$fields['security_code'] = $this->objectsArr['accounts_security_code_confirm_label'];
		$fields['sc'] = $this->objectsArr['accounts_security_code_label'];
		$this->ciObject->validation->set_error_delimiters('<br><span style="font-size:90%;color:red;">', '</div>');
		$this->ciObject->validation->set_rules($rules);
		$this->ciObject->validation->set_fields($fields);
		if ($this->ciObject->validation->run() == FALSE)
		{
			$this->GetCaptcha();
			return $this->ciObject->load->view('modules/accounts_module/registrationarea.php',$this->objectsArr, True);
		}
		else
		{
			if(!$this->SetNoActivate()) return $this->ciObject->load->view('modules/accounts_module/registrationareafailure.php',$this->objectsArr, True);
			return $this->ciObject->load->view('modules/accounts_module/registrationactivation.php',$this->objectsArr, True);
		}
	}

	public function RenderRestorePasswordArea()
	{
		$rules['login'] = "trim|required";
		$rules['security_code'] = "trim|required|matches[sc]";
		$fields['login'] = $this->objectsArr['accounts_login_label'];
		$fields['security_code'] = $this->objectsArr['accounts_security_code_confirm_label'];
		$fields['sc'] = $this->objectsArr['accounts_security_code_label'];
		$this->ciObject->validation->set_error_delimiters('<br><span style="font-size:90%;color:red;">', '</div>');
		$this->ciObject->validation->set_rules($rules);
		$this->ciObject->validation->set_fields($fields);
		if ($this->ciObject->validation->run() == FALSE)
		{
			$this->GetCaptcha();
			return $this->ciObject->load->view('modules/accounts_module/passwordrestorearea.php',$this->objectsArr, True);
		}
		else
		{
			if(!$userDATA = $this->ciObject->accounts_model->GetUserData($_POST['login'])) return $this->ciObject->load->view('modules/accounts_module/restorepassfailure.php',$this->objectsArr, True);
			else $this->SendRestorePassEmail($userDATA);
			return $this->ciObject->load->view('modules/accounts_module/restorepasssend.php',$this->objectsArr, True);
		}
	}
	
	public function RenderActivationProcessResult($activationCODE)
	{
		if($this->ciObject->accounts_model->ActivateAccount($activationCODE))return $this->ciObject->load->view('modules/accounts_module/activationsuccess.php',$this->objectsArr, True);
		return $this->ciObject->load->view('modules/accounts_module/activationfailure.php',$this->objectsArr, True); 	
	}

	public function RenderGeneratedPassResult($activationCODE)
	{
		$pool = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$str = '';
		for ($i = 0; $i < 5; $i++)
		{
			$str .= substr($pool, mt_rand(0, strlen($pool) -1), 1);
		}
		$word = $str;
		$newPass = md5($word);
		$this->objectsArr['accounts_generated_password_failure'] = $this->ciObject->lang->line('ACCOUNTS_GENERATED_PASSWORD_FAILURE');
		if($row = $this->ciObject->accounts_model->SetGeneratedPass($activationCODE, $newPass)) 
		{
			$this->objectsArr['accounts_generated_password_content'] = sprintf($this->ciObject->lang->line('ACCOUNTS_GENERATED_PASSWORD_CONTENT'),
																				$row['display_name'],
																				$row['login'],
																				$word);
			return $this->ciObject->load->view('modules/accounts_module/generatedsuccess.php',$this->objectsArr, True);
		}
		return $this->ciObject->load->view('modules/accounts_module/generatedfailure.php',$this->objectsArr, True); 	
	}
	
	public function GetCaptcha()
	{
		$this->ciObject->load->plugin('captcha');
		$vals = array(
						'word'		 => '',
						'img_path'	 => './images/captcha/',
						'img_url'	 => base_url().'images/captcha/',
						'font_path'	 => './system/texb.ttf',
						'img_width'	 => '150',
						'img_height' => 30,
						'expiration' => 1
						);
		$this->objectsArr['accounts_registration_area_captcha'] = create_captcha($vals);
		return;
	}
	
	public function LogIn($login, $password)
	{
		$result = $this->ciObject->accounts_model->GetUserInfo($login, md5($password));
		if($result)
		{
			$currentSESS = $this->ciObject->session->userdata('_SI_');
			$currentSESS['SI_LOGIN']['_USER_RID_'] = $result['rid'];
			$currentSESS['SI_LOGIN']['_USER_DISPLAY_NAME_'] = $result['display_name'];
			$currentSESS['SI_LOGIN']['_USER_LOGIN_'] = $result['login'];
			$this->ciObject->session->set_userdata('_SI_', $currentSESS);
		}
		return $result;
	}

	public function LogOut()
	{
		$currentSESS = $this->ciObject->session->userdata('_SI_');
		if(isset($currentSESS['SI_LOGIN']))
		{ 
			unset($currentSESS['SI_LOGIN']);
			$this->ciObject->session->set_userdata('_SI_', $currentSESS);
		}
		return;
	}

	public function IsLoggedIn()
	{
		$currentSESS = $this->ciObject->session->userdata('_SI_');
		if(isset($currentSESS['SI_LOGIN']))
		{
			return TRUE; 
		}
		return FALSE;
	}
	
	public function RenderLogInFailed()
	{
		$this->objectsArr['accounts_login_failed_note'] = $this->ciObject->lang->line('ACCOUNTS_LOGIN_FAILED_NOTE');
		return $this->ciObject->load->view('modules/accounts_module/loginfailed.php',$this->objectsArr, True); 	
	}

	public function RenderChangePasswordArea()
	{
		$this->objectsArr['accounts_login_change_password_title'] = $this->ciObject->lang->line('ACCOUNTS_LOGIN_CHANGE_PASSWORD_TITLE');
		$this->objectsArr['accounts_login_change_password_note'] = $this->ciObject->lang->line('ACCOUNTS_LOGIN_CHANGE_PASSWORD_NOTE');
		$this->objectsArr['accounts_login_change_password_old'] = $this->ciObject->lang->line('ACCOUNTS_LOGIN_CHANGE_PASSWORD_OLD');
		$this->objectsArr['accounts_login_change_password_new'] = $this->ciObject->lang->line('ACCOUNTS_LOGIN_CHANGE_PASSWORD_NEW');
		$this->objectsArr['accounts_login_change_password_success'] = $this->ciObject->lang->line('ACCOUNTS_LOGIN_CHANGE_PASSWORD_SUCCESS');

		$rules['password'] = "trim|required|matches[confirm_password]|min_length[5]";
		$rules['confirm_password'] = "trim|required";
		$fields['password'] = $this->objectsArr['accounts_password_label'];
		$fields['confirm_password'] = $this->objectsArr['accounts_password_confirm_label'];
		$this->ciObject->validation->set_error_delimiters('<br><span style="font-size:90%;color:red;">', '</div>');
		$this->ciObject->validation->set_rules($rules);
		$this->ciObject->validation->set_fields($fields);
		
		if ($this->ciObject->validation->run() == FALSE)
		{
			return $this->ciObject->load->view('modules/accounts_module/changepassarea.php',$this->objectsArr, True);
		}
		else
		{
			$currentSESS = $this->ciObject->session->userdata('_SI_');
			$this->ciObject->accounts_model->UpdateUserPassword($currentSESS['SI_LOGIN']['_USER_RID_'], md5($_POST['password']));
			unset($currentSESS['SI_LOGIN']);
			$this->ciObject->session->set_userdata('_SI_', $currentSESS);
			return $this->ciObject->load->view('modules/accounts_module/changepasssuccess.php',$this->objectsArr, True);
		}
	}
	
	public function SetNoActivate()
	{
		$currentSESSID = $this->ciObject->session->userdata('session_id');
		$dataArr = array('display_name'=>$_POST['display_name'], 
							'login'=>$_POST['login'],
							'password'=>md5($_POST['password']),
							'email'=>$_POST['email'],
							'activate_code'=>$currentSESSID);
		if(!$this->ciObject->accounts_model->AddUser($dataArr)) return FALSE;
		$this->SendActivationCode($_POST['email'], $currentSESSID);
		return True;
	}
	
	public function SendRestorePassEmail($userDATA)
	{
		$this->ciObject->load->library('email');
		$this->ciObject->email->clear();
		$this->ciObject->email->to($userDATA['email']);
    	$this->ciObject->email->from($this->ciObject->lang->line('ACCOUNTS_MODULE_EMAIL_FROM'));
    	$this->ciObject->email->subject($this->STN_accounts_restore_password_title);
    	$message = sprintf($this->ciObject->lang->line('ACCOUNTS_MODULE_RESTORE_PASSWORD_EMAIL'),
    						$userDATA['display_name'], 
    						base_url(), 
    						base_url().index_page().'/accounts/generatepass/'.$userDATA['activate_code'],
    						base_url());
    	$this->ciObject->email->message($message);
    	$this->ciObject->email->send();		
	}

	public function SendActivationCode($email, $activationCODE)
	{
		$this->ciObject->load->helper('typography');
		$this->ciObject->load->library('email');
		$this->ciObject->email->clear();
		$this->ciObject->email->to($email);
    	$this->ciObject->email->from($this->ciObject->lang->line('ACCOUNTS_MODULE_EMAIL_FROM'));
    	$this->ciObject->email->subject($this->ciObject->lang->line('ACCOUNTS_ACTIVATE_EMAIL_TITLE'));
    	$message = sprintf($this->ciObject->lang->line('ACCOUNTS_MODULE_ACTIVATION_EMAIL_BODY'), 
    						base_url(), 
    						base_url().index_page().'/accounts/activate/'.$activationCODE,
    						base_url());
    	$this->ciObject->email->message($message);
   		$this->ciObject->email->send();
   		$this->ciObject->email->clear();
	}
	
}
?>