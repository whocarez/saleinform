<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
/*
 * Contacts module
 * Mazvv 18-06-2007
*/
class Contacts_module{
	private $ciObject;
	private $objectsArr = array();
	private $_current_contacts_uri_assoc = array();
	private $_current_contacts_uri_string;
	
	public function __construct(){
		$this->ciObject = &get_instance();
		$this->ciObject->lang->load('contacts_module');
		$this->ciObject->load->model('contacts_model');
		$this->_current_contacts_uri_assoc = $this->ciObject->uri->uri_to_assoc(2);
		$this->_current_contacts_uri_string = $this->ciObject->uri->assoc_to_uri($this->_current_contacts_uri_assoc);
	}
	
	public function RenderWriteErrorArea()
	{
		$this->objectsArr['contacts_module_write_error_title'] = $this->ciObject->lang->line('CONTACTS_MODULE_WRITE_ERROR');
		$this->objectsArr['contacts_module_write_send_btn'] = $this->ciObject->lang->line('CONTACTS_MODULE_WRITE_SEND');
		$this->objectsArr['contacts_module_write_error_uri'] = $this->ciObject->uri->assoc_to_uri($this->ciObject->uri->uri_to_assoc(3));
		$this->objectsArr['contacts_module_write_error_descr'] = $this->ciObject->lang->line('CONTACTS_MODULE_WRITE_ERROR_DESCR');
		$this->objectsArr['contacts_module_write_error_comment'] = $this->ciObject->lang->line('CONTACTS_MODULE_WRITE_COMMENT');
		$rules['error_content'] =  "trim|required|max_length[255]";
		$fields['error_content'] = $this->objectsArr['contacts_module_write_error_comment']; 
		$this->ciObject->validation->set_error_delimiters('<br><span style="font-size:90%;color:red;">', '</div>');
		$this->ciObject->validation->set_rules($rules);
		$this->ciObject->validation->set_fields($fields);
		if($this->ciObject->validation->run()==FALSE)
		{
			return $this->ciObject->load->view('modules/contacts_module/errorwrite.php',$this->objectsArr, True);
		}
		$this->objectsArr['contacts_module_write_success_title'] = $this->ciObject->lang->line('CONTACTS_MODULE_WRITE_SUCCESS_TITLE');
		$this->objectsArr['contacts_module_write_success_descr'] = $this->ciObject->lang->line('CONTACTS_MODULE_WRITE_SUCCESS_DESCR');
		$insertARR = array('content'=>$_POST['error_content'], 'status'=>'NEW');
		$this->ciObject->contacts_model->SetUserFindedError($insertARR);
		return $this->ciObject->load->view('modules/contacts_module/writesuccess.php',$this->objectsArr, True);
	}
	
	public function RenderWriteToFriendArea()
	{
		$this->objectsArr['contacts_module_write_tofriend_title'] = $this->ciObject->lang->line('CONTACTS_MODULE_WRITE_TOFRIEND');
		$this->objectsArr['contacts_module_write_send_btn'] = $this->ciObject->lang->line('CONTACTS_MODULE_WRITE_SEND');
		$this->objectsArr['contacts_module_write_tofriend_uri'] = $this->ciObject->uri->assoc_to_uri($this->ciObject->uri->uri_to_assoc(3));
		$this->objectsArr['contacts_module_write_tofriend_descr'] = $this->ciObject->lang->line('CONTACTS_MODULE_WRITE_TOFRIEND_DESCR');
		$this->objectsArr['contacts_module_write_tofriend_name_sender'] = $this->ciObject->lang->line('CONTACTS_MODULE_NAME_SENDER_TITLE');
		$this->objectsArr['contacts_module_write_tofriend_sender'] = $this->ciObject->lang->line('CONTACTS_MODULE_EMAIL_SENDER_TITLE');
		$this->objectsArr['contacts_module_write_tofriend_reciever'] = $this->ciObject->lang->line('CONTACTS_MODULE_EMAIL_RECIEVER_TITLE');
		$this->objectsArr['contacts_module_write_tofriend_comment'] = $this->ciObject->lang->line('CONTACTS_MODULE_WRITE_COMMENT');
		$rules['tofriend_content'] =  "trim|required|max_length[255]";
		$rules['sender_name'] =  "trim|required|min_length[3]|max_length[255]";
		$rules['sender_email'] =  "trim|required|valid_email";
		$rules['reciever_email'] =  "trim|required|valid_email";
		$fields['tofriend_content'] = $this->objectsArr['contacts_module_write_tofriend_comment'];
		$fields['sender_name'] = $this->objectsArr['contacts_module_write_tofriend_name_sender']; 
		$fields['sender_email'] = $this->objectsArr['contacts_module_write_tofriend_sender']; 
		$fields['reciever_email'] = $this->objectsArr['contacts_module_write_tofriend_reciever']; 
		$this->ciObject->validation->set_error_delimiters('<br><span style="font-size:90%;color:red;">', '</div>');
		$this->ciObject->validation->set_rules($rules);
		$this->ciObject->validation->set_fields($fields);
		if($this->ciObject->validation->run()==FALSE)
		{
			return $this->ciObject->load->view('modules/contacts_module/tofriendwrite.php',$this->objectsArr, True);
		}
		if($this->_SendMailToFriend())
		{
			$this->objectsArr['contacts_module_write_failure_title'] = $this->ciObject->lang->line('CONTACTS_MODULE_WRITE_FAILURE_TITLE');
			$this->objectsArr['contacts_module_write_failure_descr'] = $this->ciObject->lang->line('CONTACTS_MODULE_WRITE_SEND_FILURE');
			return $this->ciObject->load->view('modules/contacts_module/tofriendfailure.php',$this->objectsArr, True);
		}
		$this->objectsArr['contacts_module_write_success_title'] = $this->ciObject->lang->line('CONTACTS_MODULE_WRITE_SUCCESS_TITLE');
		$this->objectsArr['contacts_module_write_success_descr'] = $this->ciObject->lang->line('CONTACTS_MODULE_WRITE_SEND_SUCCESS');
		return $this->ciObject->load->view('modules/contacts_module/tofriendsuccess.php',$this->objectsArr, True);
	}
	
	public function RenderContactsToolbar(){
		return $this->ciObject->load->view('modules/contacts_module/contactstoolbar.php',$this->objectsArr, True);
	}
	
	public function _SendMailToFriend()
	{
		$fromNAME = $_POST['sender_name'];
		$fromMAIL = $_POST['sender_email'];
		$toMAIL = $_POST['reciever_email'];
		$messageMAIL = $_POST['tofriend_content'];	
		$this->ciObject->load->library('email');
		$this->ciObject->email->clear();
		$this->ciObject->email->from($fromMAIL, $fromNAME);
		$this->ciObject->email->to($toMAIL);
		$this->ciObject->email->subject('Saleinform');
		$this->ciObject->email->message($messageMAIL);
		if (!$this->ciObject->email->send()) return FALSE;
		return TRUE;
	}
	
	public function RenderContactsArea(){
		$data = array();
		$data['saveOk'] = False;
		$this->ciObject->form_validation->set_rules('name', lang('CONTACTS_MODULE_NAME_SENDER_TITLE'), 'required|trim|max_length[50]');
		$this->ciObject->form_validation->set_rules('email', lang('CONTACTS_MODULE_EMAIL_SENDER_TITLE'), 'required|trim|valid_email');
		$this->ciObject->form_validation->set_rules('comment', lang('CONTACTS_MODULE_WRITE_COMMENT'), 'required|trim||max_length[255]');
		if($this->ciObject->form_validation->run()==FALSE)
		return $this->ciObject->load->view('modules/contacts_module/contactsarea.php',$data, True);
		$this->objectsArr['contacts_module_write_success_title'] = $this->ciObject->lang->line('CONTACTS_MODULE_WRITE_SUCCESS_TITLE');
		$this->objectsArr['contacts_module_write_success_descr'] = $this->ciObject->lang->line('CONTACTS_MODULE_WRITE_SUCCESS_DESCR');
		$insertARR = array('content'=>$this->ciObject->input->post('comment'), 
							'status'=>'NEW', 
							'cemail'=>$this->ciObject->input->post('email'));
		$this->ciObject->contacts_model->SetUserSendMessage($insertARR);
		$data['saveOk'] = True;
		return $this->ciObject->load->view('modules/contacts_module/contactsarea.php', $data, True);
	}
}
?>