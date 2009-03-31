<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
/*
 * Info module
 * Mazvv 18-06-2007
*/
class Info_module 
{
	private $ciObject;
	private $objectsArr = array();
	private $_current_info_uri_assoc;
	
	public function __construct()
	{
		$this->ciObject = &get_instance();
		$this->ciObject->lang->load('info_module');
		$this->_current_info_uri_assoc = $this->ciObject->uri->uri_to_assoc(2);
	}
	
	public function RenderWhatIsItArea()
	{
		$this->objectsArr['info_module_what_isit_title']=$this->ciObject->lang->line('INFO_MODULE_WHAT_ISIT_TITLE');
		$this->objectsArr['info_module_what_isit_content']=$this->ciObject->lang->line('INFO_MODULE_WHAT_ISIT_CONTENT');
		return $this->ciObject->load->view('modules/info_module/infowhatisitarea.php',$this->objectsArr, True);
	}

	public function RenderHowItWorksArea()
	{
		$this->objectsArr['info_module_how_itworks_title']=$this->ciObject->lang->line('INFO_MODULE_HOW_ITWORKS_TITLE');
		$this->objectsArr['info_module_how_itworks_content']=$this->ciObject->lang->line('INFO_MODULE_HOW_ITWORKS_CONTENT');
		return $this->ciObject->load->view('modules/info_module/infohowitworksarea.php',$this->objectsArr, True);
	}
	
	
}
?>