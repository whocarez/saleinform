<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
/*
 * Help module
 * Mazvv 25-06-2007
*/
class Help_module 
{
	private $ciObject;
	private $objectsArr = array();
	private $_current_help_uri_assoc;
	
	public function __construct()
	{
		$this->ciObject = &get_instance();
		$this->ciObject->lang->load('help_module');
		$this->ciObject->load->model('help_model');
		$this->_current_help_uri_assoc = $this->ciObject->uri->uri_to_assoc(2);
	}
	
	public function RenderHelpArea()
	{
		$this->objectsArr['help_module_area_title'] = $this->ciObject->lang->line('HELP_MODULE_AREA_TITLE');
		$this->objectsArr['help_module_area_content'] = $this->ciObject->lang->line('HELP_MODULE_AREA_CONTENT');
		return $this->ciObject->load->view('modules/help_module/helparea.php',$this->objectsArr, True); 
	}
	
	public function RenderAdvertizeArea()
	{
		$this->objectsArr['help_module_area_title'] = $this->ciObject->lang->line('HELP_MODULE_ADVERTIZE_AREA_TITLE');
		$this->objectsArr['help_module_area_content'] = $this->ciObject->lang->line('HELP_MODULE_ADVERTIZE_AREA_CONTENT');
		return $this->ciObject->load->view('modules/help_module/helparea.php',$this->objectsArr, True); 
	}

	public function RenderCurrenciesArea()
	{
		$this->objectsArr['help_module_area_title'] = $this->ciObject->lang->line('HELP_MODULE_CURRENCIES_LIST_TITLE');
		$this->objectsArr['help_module_area_content'] = $this->ciObject->help_model->GetCurrenciesArr();
		return $this->ciObject->load->view('modules/help_module/popup_currlist.php',$this->objectsArr, True); 
	}

	public function RenderPricetypesArea()
	{
		$this->objectsArr['help_module_area_title'] = $this->ciObject->lang->line('HELP_MODULE_PRTYPES_LIST_TITLE');
		$this->objectsArr['help_module_area_content'] = $this->ciObject->help_model->GetPrtypesArr();
		return $this->ciObject->load->view('modules/help_module/popup_currlist.php',$this->objectsArr, True); 
	}

	public function RenderAvailabletypesArea()
	{
		$this->objectsArr['help_module_area_title'] = $this->ciObject->lang->line('HELP_MODULE_AVTYPES_LIST_TITLE');
		$this->objectsArr['help_module_area_content'] = $this->ciObject->help_model->GetAvtypesArr();
		return $this->ciObject->load->view('modules/help_module/popup_currlist.php',$this->objectsArr, True); 
	}

	public function RenderCategoriesTreeArea()
	{
		$this->ciObject->load->plugin('tree');
		$this->objectsArr['help_module_area_title'] = $this->ciObject->lang->line('HELP_MODULE_CATEGORIES_TREE_TITLE');
		$this->objectsArr['help_module_area_content'] = $this->ciObject->help_model->GetCategoriesArr();
		$this->objectsArr['help_module_area_content'] = _transform2forest($this->objectsArr['help_module_area_content'], 'rid', '_categories_rid');
		return $this->ciObject->load->view('modules/help_module/popup_tree.php',$this->objectsArr, True); 
	}
	
}
?>