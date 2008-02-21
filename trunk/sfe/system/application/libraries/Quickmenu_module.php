<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
/*
 * Quickmenu module
*/
class Quickmenu_module 
{
	private $ciObject;
	private $objectsArr = array();
	
	public function __construct()
	{
		$this->ciObject = &get_instance();
		$this->ciObject->lang->load('quickmenu_module');
		$this->objectsArr['quickmenu_area_title'] = $this->ciObject->lang->line('QUICKMENU_MODULE_AREA_TITLE');
		$this->objectsArr['quickmenu_area_arr']	= array(anchor(site_url(), $this->ciObject->lang->line('QUICKMENU_MODULE_ITEM_HOME')),
														anchor(site_url().'/settings', $this->ciObject->lang->line('QUICKMENU_MODULE_ITEM_SETTINGS')),
														anchor(site_url().'/categories', $this->ciObject->lang->line('QUICKMENU_MODULE_ITEM_CATEGORIES')),
														anchor(site_url().'/brands', $this->ciObject->lang->line('QUICKMENU_MODULE_ITEM_BRANDS')),
														anchor(site_url().'/clients', $this->ciObject->lang->line('QUICKMENU_MODULE_ITEM_SHOPS')),
														anchor(site_url().'/news', $this->ciObject->lang->line('QUICKMENU_MODULE_ITEM_NEWS')),
														anchor(site_url().'/guides', $this->ciObject->lang->line('QUICKMENU_MODULE_ITEM_GUIDES')),
														anchor(base_url().'forum', $this->ciObject->lang->line('QUICKMENU_MODULE_ITEM_FORUM')),
														anchor(site_url().'/advertize', $this->ciObject->lang->line('QUICKMENU_MODULE_ITEM_ADVERTIZE')),
														anchor(site_url().'/contacts', $this->ciObject->lang->line('QUICKMENU_MODULE_ITEM_NCONTACTS')),
														anchor(site_url().'/help', $this->ciObject->lang->line('QUICKMENU_MODULE_ITEM_HELP')));
		$this->objectsArr['footermenu_area_arr']= array(anchor(site_url().'/clients/r', $this->ciObject->lang->line('QUICKMENU_MODULE_ITEM_ADD_CLIENT')),
														anchor(site_url().'/advertize', $this->ciObject->lang->line('QUICKMENU_MODULE_ITEM_ADVERTIZE_FOOTER')),
														anchor(site_url().'/help', $this->ciObject->lang->line('QUICKMENU_MODULE_ITEM_FOOTER_HELP')),
														anchor(site_url().'/contacts', $this->ciObject->lang->line('QUICKMENU_MODULE_ITEM_CONTACTS')));
	}
	
	public function RenderQuickmenuArea()
	{
		return $this->ciObject->load->view('modules/quickmenu_module/quickmenuarea.php',$this->objectsArr, True);
	}
	
	public function RenderFootermenuArea()
	{
		return $this->ciObject->load->view('modules/quickmenu_module/footermenuarea.php',$this->objectsArr, True);
	}
}
?>