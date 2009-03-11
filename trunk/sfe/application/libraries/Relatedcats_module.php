<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
/*
 * Relatedcats module
 * Mazvv 24-05-2007
*/
class Relatedcats_module 
{
	private $ciObject;
	private $objectsArr = array();
	private $STN_relatedcats_module_area_title;
	private $_relatedcats_current_uri_assoc;
	private $_relatedcats_current_category_rid;
	
	public function __construct()
	{
		$this->ciObject = &get_instance();
		$this->ciObject->lang->load('relatedcats_module');
		$this->ciObject->load->model('relatedcats_model');
		$this->_relatedcats_current_uri_assoc = $this->ciObject->uri->uri_to_assoc(2);
		$this->_relatedcats_current_category_rid = (isset($this->_relatedcats_current_uri_assoc['c']))?$this->_relatedcats_current_uri_assoc['c']:null;
		$this->STN_relatedcats_module_area_title = $this->ciObject->lang->line('RELATEDCATS_MODULE_RELATEDCATS_AREA_TITLE');
		$this->objectsArr['relatedcats_area_title'] = $this->STN_relatedcats_module_area_title;
	}
	
	public function RenderRelatedCatsArea()
	{
		if(!$this->_relatedcats_current_category_rid) return '';
		$relatedcatsLIST = $this->ciObject->relatedcats_model->GetRelatedCatsList($this->_relatedcats_current_category_rid);
		if(!$relatedcatsLIST) return '';
		$this->objectsArr['relatedcats_links_list'] = array();
		foreach($relatedcatsLIST as $item)
		{
			$this->objectsArr['relatedcats_links_list'][]=anchor(base_url().index_page().'/categories/c/'.$item['rid'], $item['name']);
		}
		return $this->ciObject->load->view('modules/relatedcats_module/relatedcatsarea.php',$this->objectsArr, True);
	}
}
?>