<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
/*
 * Advertise module
 * Mazvv 03-05-2007
*/
class Advertise_module 
{
	private $ciObject;
	private $objectsArr = array();
	private $_current_adverise_uri_assoc;
	
	public function __construct()
	{
		$this->ciObject = &get_instance();
		$this->ciObject->load->model('advertise_model');
		$this->_current_adverise_uri_assoc = $this->ciObject->uri->uri_to_assoc(2);
	}
	
	public function RenderLeftLinksAdvertiseArea()
	{
		$this->objectsArr['advertise_module_left_links_arr']=($this->ciObject->advertise_model->GetAdveriseArr('LEFT', 'LINKS'))?$this->ciObject->advertise_model->GetAdveriseArr('LEFT', 'LINKS'):array();
		if(!$this->objectsArr['advertise_module_left_links_arr']) return '';
		return $this->ciObject->load->view('modules/advertise_module/advertiseleft.php',$this->objectsArr, True);
	}
	
	public function RenderRightLinksAdvertiseArea()
	{
		$this->objectsArr['advertise_module_right_links_arr']=($this->ciObject->advertise_model->GetAdveriseArr('RIGHT', 'LINKS'))?$this->ciObject->advertise_model->GetAdveriseArr('RIGHT', 'LINKS'):array();
		if(!$this->objectsArr['advertise_module_right_links_arr']) return '';
		return $this->ciObject->load->view('modules/advertise_module/advertiseright.php',$this->objectsArr, True);
	}

	public function RenderCenterLinksAdvertiseArea()
	{
		$this->objectsArr['advertise_module_center_links_arr']=($this->ciObject->advertise_model->GetAdveriseArr('CENTER', 'LINKS'))?$this->ciObject->advertise_model->GetAdveriseArr('CENTER', 'LINKS'):array();
		if(!$this->objectsArr['advertise_module_center_links_arr']) return '';
		return $this->ciObject->load->view('modules/advertise_module/advertisecenter.php',$this->objectsArr, True);
	}
	
	public function RenderGoogleAds_234x60_Area()
	{
		return $this->ciObject->load->view('modules/advertise_module/googleadsright.php', null, True);		
	}
	
	public function RenderGoogleAds_120x90_Area()
	{
		return $this->ciObject->load->view('modules/advertise_module/googleadsleft.php', null, True);		
	}
	
}
?>