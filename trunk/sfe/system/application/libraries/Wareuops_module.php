<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
/*
 * Wareuops module
 * Mazvv 29-05-2007
*/
class Wareuops_module 
{
	private $ciObject;
	private $objectsArr = array();
	private $_current_wareuops_uri_assoc;
	private $_current_wareuops_categories_rid;
	private $_current_wareuops_brands_rid;
	private $_current_wareuops_model_alias;		
	private $_current_wareuops_user_rid;
	private $_current_wareuops_display_name;
	private $_current_wareuops_user_login;
	
	public function __construct()
	{
		$this->ciObject = &get_instance();
		$this->ciObject->lang->load('wareuops_module');
		$this->_current_wareuops_uri_assoc = $this->ciObject->uri->uri_to_assoc(2);
		$this->ciObject->load->model('wareuops_model');
		$this->objectsArr['wareops_module_ware_options_error'] = $this->ciObject->lang->line('WARESUOPS_MODULE_WARE_OPTIONS_ERROR');
		$this->objectsArr['wareops_module_ware_nologged_error'] = $this->ciObject->lang->line('WARESUOPS_MODULE_WARE_NOLOGGED_ERROR');
		$this->objectsArr['wareops_module_ware_opinfo_content'] = $this->ciObject->lang->line('WARESUOPS_MODULE_WARE_OPINFO_CONTENT');
		$this->objectsArr['wareops_module_ware_options_title'] = $this->ciObject->lang->line('WARESUOPS_MODULE_WARE_OPTIONS_TITLE');
		$this->objectsArr['wareops_module_ware_message_title'] = $this->ciObject->lang->line('WARESUOPS_MODULE_WARE_MESSAGE_TITLE');
		$this->objectsArr['wareops_module_ware_mark_title'] = $this->ciObject->lang->line('WARESUOPS_MODULE_WARE_MARK_TITLE');
		$this->objectsArr['wareops_module_ware_message_length_title'] = $this->ciObject->lang->line('WARESUOPS_MODULE_MESSAGE_LENGTH_TITLE');
		$this->objectsArr['wareops_module_ware_security_code_title'] = $this->ciObject->lang->line('WARESUOPS_MODULE_WARE_SECURITY_CODE_TITLE');
		$this->objectsArr['wareops_module_ware_security_code_confirm_title'] = $this->ciObject->lang->line('WARESUOPS_MODULE_WARE_SECURITY_CODE_CONFIRM_TITLE');
		$this->objectsArr['wareops_module_ware_current_uri_string'] = '/wareuops/'.$this->ciObject->uri->assoc_to_uri($this->_current_wareuops_uri_assoc);
		
		$this->_current_wareuops_categories_rid = (isset($this->_current_wareuops_uri_assoc['c']))?$this->_current_wareuops_uri_assoc['c']:null;
		$this->_current_wareuops_brands_rid = (isset($this->_current_wareuops_uri_assoc['b']))?$this->_current_wareuops_uri_assoc['b']:null;
		$this->_current_wareuops_model_alias = (isset($this->_current_wareuops_uri_assoc['b']))?$this->_current_wareuops_uri_assoc['m']:null;
		$currentSESS = $this->ciObject->session->userdata('_SI_');
		$this->_current_wareuops_user_rid = (isset($currentSESS['SI_LOGIN']['_USER_RID_']))?$currentSESS['SI_LOGIN']['_USER_RID_']:null;
		$this->_current_wareuops_display_name = (isset($currentSESS['SI_LOGIN']['_USER_DISPLAY_NAME_']))?$currentSESS['SI_LOGIN']['_USER_DISPLAY_NAME_']:null;
		$this->_current_wareuops_user_login = (isset($currentSESS['SI_LOGIN']['_USER_LOGIN_']))?$currentSESS['SI_LOGIN']['_USER_LOGIN_']:null;
	}
	
	public function RenderWareOpinionsArea()
	{
		if(!$this->_current_wareuops_categories_rid || !$this->_current_wareuops_brands_rid || !$this->_current_wareuops_model_alias) return $this->ciObject->load->view('modules/wareuops_module/uopfailure.php',$this->objectsArr, True);
		if(!$this->_current_wareuops_user_rid) return $this->ciObject->load->view('modules/wareuops_module/uopnotlogged.php',$this->objectsArr, True);
		$rules['wuopmess'] = "trim|required|max_length[512]";
		$rules['wuopmrk'] = "trim|required";
		$rules['wuopsc'] = "trim|required|matches[wuopscw]";
		$fields['wuopmess'] = $this->objectsArr['wareops_module_ware_message_title'];
		$fields['wuopmrk'] = $this->objectsArr['wareops_module_ware_mark_title'];
		$fields['wuopsc'] = $this->objectsArr['wareops_module_ware_security_code_confirm_title'];
		$fields['wuopscw'] = $this->objectsArr['wareops_module_ware_security_code_title'];
		$this->ciObject->validation->set_error_delimiters('<br><span style="font-size:90%;color:red;">', '</div>');
		$this->ciObject->validation->set_rules($rules);
		$this->ciObject->validation->set_fields($fields);
		
		if ($this->ciObject->validation->run() == FALSE)
		{
			$this->GetCaptcha();
			return $this->ciObject->load->view('modules/wareuops_module/uoparea.php',$this->objectsArr, True);
		}
		else
		{
			if($this->_AddUserOpinion()) redirect('/ware/c/'.$this->_current_wareuops_categories_rid.'/op/'.$this->_current_wareuops_brands_rid.'/m/'.$this->_current_wareuops_model_alias, 'refresh');
			$this->objectsArr['wareops_module_ware_options_error'] = $this->ciObject->lang->line('WARESUOPS_MODULE_WARE_SAVE_ERROR');			
			return $this->ciObject->load->view('modules/wareuops_module/uopfailure.php',$this->objectsArr, True);
		}
		return;
	}
	
	public function _AddUserOpinion()
	{
		$dataARR = array('opinion'=>$_POST['wuopmess'],
							'_members_rid'=>$this->_current_wareuops_user_rid,
							'mark'=>$_POST['wuopmrk'],
							'_brands_rid'=>$this->_current_wareuops_brands_rid,
							'_categories_rid'=>$this->_current_wareuops_categories_rid,
							'model_alias'=>$this->_current_wareuops_model_alias
							);	
		return $this->ciObject->wareuops_model->AddUserOpinion($dataARR);
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
		$this->objectsArr['wareops_module_ware_captcha'] = create_captcha($vals);
		return;
	}
	
}
?>