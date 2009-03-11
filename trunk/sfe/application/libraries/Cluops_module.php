<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
/*
 * Cluops module
 * Mazvv 31-05-2007
*/
class Cluops_module 
{
	private $ciObject;
	private $objectsArr = array();
	private $_current_cluops_uri_assoc;
	private $_current_cluops_clients_rid;
	private $_current_cluops_user_rid;
	private $_current_cluops_display_name;
	private $_current_cluops_user_login;
	
	public function __construct()
	{
		$this->ciObject = &get_instance();
		$this->ciObject->lang->load('cluops_module');
		$this->_current_cluops_uri_assoc = $this->ciObject->uri->uri_to_assoc(2);
		$this->ciObject->load->model('cluops_model');
		$this->objectsArr['cluops_module_client_options_error'] = $this->ciObject->lang->line('CLUOPS_MODULE_CLIENT_OPTIONS_ERROR');
		$this->objectsArr['cluops_module_client_nologged_error'] = $this->ciObject->lang->line('CLUOPS_MODULE_CLIENT_NOLOGGED_ERROR');
		$this->objectsArr['cluops_module_client_opinfo_content'] = $this->ciObject->lang->line('CLUOPS_MODULE_CLIENT_OPINFO_CONTENT');
		$this->objectsArr['cluops_module_client_options_title'] = $this->ciObject->lang->line('CLUOPS_MODULE_CLIENT_OPTIONS_TITLE');
		$this->objectsArr['cluops_module_client_message_title'] = $this->ciObject->lang->line('CLUOPS_MODULE_CLIENT_MESSAGE_TITLE');
		$this->objectsArr['cluops_module_client_mark_title'] = $this->ciObject->lang->line('CLUOPS_MODULE_CLIENT_MARK_TITLE');
		$this->objectsArr['cluops_module_client_message_length_title'] = $this->ciObject->lang->line('CLUOPS_MODULE_MESSAGE_LENGTH_TITLE');
		$this->objectsArr['cluops_module_client_security_code_title'] = $this->ciObject->lang->line('CLUOPS_MODULE_CLIENT_SECURITY_CODE_TITLE');
		$this->objectsArr['cluops_module_client_security_code_confirm_title'] = $this->ciObject->lang->line('CLUOPS_MODULE_CLIENT_SECURITY_CODE_CONFIRM_TITLE');
		$this->objectsArr['cluops_module_client_current_uri_string'] = '/cluops/'.$this->ciObject->uri->assoc_to_uri($this->_current_cluops_uri_assoc);
		
		$this->_current_cluops_clients_rid = (isset($this->_current_cluops_uri_assoc['c']))?$this->_current_cluops_uri_assoc['c']:null;
		$currentSESS = $this->ciObject->session->userdata('_SI_');
		$this->_current_cluops_user_rid = (isset($currentSESS['SI_LOGIN']['_USER_RID_']))?$currentSESS['SI_LOGIN']['_USER_RID_']:null;
		$this->_current_cluops_display_name = (isset($currentSESS['SI_LOGIN']['_USER_DISPLAY_NAME_']))?$currentSESS['SI_LOGIN']['_USER_DISPLAY_NAME_']:null;
		$this->_current_cluops_user_login = (isset($currentSESS['SI_LOGIN']['_USER_LOGIN_']))?$currentSESS['SI_LOGIN']['_USER_LOGIN_']:null;
	}
	
	public function RenderClientOpinionsArea()
	{
		if(!$this->_current_cluops_clients_rid) return $this->ciObject->load->view('modules/cluops_module/uopfailure.php',$this->objectsArr, True);
		if(!$this->_current_cluops_user_rid) return $this->ciObject->load->view('modules/cluops_module/uopnotlogged.php',$this->objectsArr, True);
		$rules['cluopmess'] = "trim|required|max_length[512]";
		$rules['cluopmrk'] = "trim|required";
		$rules['cluopsc'] = "trim|required|matches[cluopscw]";
		$fields['cluopmess'] = $this->objectsArr['cluops_module_client_message_title'];
		$fields['cluopmrk'] = $this->objectsArr['cluops_module_client_mark_title'];
		$fields['cluopsc'] = $this->objectsArr['cluops_module_client_security_code_confirm_title'];
		$fields['cluopscw'] = $this->objectsArr['cluops_module_client_security_code_title'];
		$this->ciObject->validation->set_error_delimiters('<br><span style="font-size:90%;color:red;">', '</div>');
		$this->ciObject->validation->set_rules($rules);
		$this->ciObject->validation->set_fields($fields);
		
		if ($this->ciObject->validation->run() == FALSE)
		{
			$this->GetCaptcha();
			return $this->ciObject->load->view('modules/cluops_module/uoparea.php',$this->objectsArr, True);
		}
		else
		{
			if($this->_AddUserOpinion()) redirect('/clients/o/'.$this->_current_cluops_clients_rid, 'refresh');
			$this->objectsArr['cluops_module_client_options_error'] = $this->ciObject->lang->line('CLUOPS_MODULE_CLIENT_SAVE_ERROR');			
			return $this->ciObject->load->view('modules/cluops_module/uopfailure.php',$this->objectsArr, True);
		}
		return;
	}
	
	public function _AddUserOpinion()
	{
		$dataARR = array('opinion'=>$_POST['cluopmess'],
							'_members_rid'=>$this->_current_cluops_user_rid,
							'mark'=>$_POST['cluopmrk'],
							'_clients_rid'=>$this->_current_cluops_clients_rid
							);	
		return $this->ciObject->cluops_model->AddUserOpinion($dataARR);
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
						'expiration' => 60
						);
		$this->objectsArr['cluops_module_client_captcha'] = create_captcha($vals);
		return;
	}
	
}
?>