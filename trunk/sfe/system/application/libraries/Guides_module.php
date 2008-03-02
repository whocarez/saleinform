<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
/*
 * Guides module
 * Mazvv 18-06-2007
*/
class Guides_module 
{
	private $ciObject;
	private $objectsArr = array();
	private $_current_guides_uri_assoc;
	
	public function __construct()
	{
		$this->ciObject = &get_instance();
		$this->ciObject->lang->load('guides_module');
		$this->ciObject->load->model('guides_model');
		$this->_current_guides_uri_assoc = $this->ciObject->uri->uri_to_assoc(2);
		$this->_current_guides_category_rid = (isset($this->_current_guides_uri_assoc['c']))?$this->_current_guides_uri_assoc['c']:null;
	}
	
	public function RenderGuidesListArea()
	{
		$guidesLIST = $this->ciObject->guides_model->GetGuidesArr();
		if(!$guidesLIST) return FALSE;
		$this->objectsArr['guides_alphabetical_list'] = array();
		$firstLETTER = $prevLETTER = null;
		$index = 0;
		foreach($guidesLIST as $row)
		{
			
			$firstLETTER = mb_strtoupper(mb_substr($row['name'],0,1,'UTF-8'));
			if($firstLETTER!=$prevLETTER)
			{
				$index++;
				$this->objectsArr['guides_alphabetical_list'][$index]['L'] = $firstLETTER;
				$prevLETTER = $firstLETTER;
			}
			$this->objectsArr['guides_alphabetical_list'][$index][] = $row;
			
		}
		$this->objectsArr['guides_table_show_all_title'] = $this->ciObject->lang->line('GUIDES_MODULE_SHOW_ALL_TITLE');
		return $this->ciObject->load->view('modules/guides_module/guidesalph.php',$this->objectsArr, True); 
	}
	
	public function RenderCatGuideArea()
	{
		$this->objectsArr['guides_guide_category_content'] = $this->ciObject->guides_model->GetCategoryGuide($this->_current_guides_category_rid);
		if(!$this->objectsArr['guides_guide_category_content'])
		{
			return $this->RenderGuidesListArea();	
		}
		$this->objectsArr['guides_guide_category_content_title'] = sprintf($this->ciObject->lang->line('GUIDES_MODULE_CONTENT_TITLE'), $this->objectsArr['guides_guide_category_content']['name']);
		return $this->ciObject->load->view('modules/guides_module/catguide.php',$this->objectsArr, True); 
	}
}
?>