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
	private $STN_categories_guides_images_path = 'images/guides/';
	private $STN_categories_guides_images_width = 100;
	private $STN_categories_guides_images_height = 100;
	
	
	public function __construct()
	{
		$this->ciObject = &get_instance();
		$this->ciObject->lang->load('guides_module');
		$this->ciObject->load->model('guides_model');
		$this->ciObject->load->helper('typography');
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
		$guideIMGS = $this->ciObject->guides_model->GetGuideImages($this->objectsArr['guides_guide_category_content']['rid']);
		$this->GetGuideImages($guideIMGS);
		$this->objectsArr['guides_guide_category_content']['content'] = /*auto_typography*/($this->objectsArr['guides_guide_category_content']['content']);
		$this->objectsArr['guides_guide_category_content_title'] = sprintf($this->ciObject->lang->line('GUIDES_MODULE_CONTENT_TITLE'), $this->objectsArr['guides_guide_category_content']['name']);
		return $this->ciObject->load->view('modules/guides_module/catguide.php',$this->objectsArr, True); 
	}
	
	public function GetGuideImages($imagesROWS)
	{
		$this->ciObject->load->library('image_lib');
		$this->ciObject->image_lib->clear();
		foreach($imagesROWS as $image)
		{
			$imgGUIDE = $this->STN_categories_guides_images_path.$image['rid'].'_'.$image['name'];
			if(!file_exists($imgGUIDE))
			{
				$ifile=fopen($imgGUIDE, "w");
				fwrite($ifile, $image['image']);
				fclose($ifile);
				$config = array();
				$config['image_library'] = 'GD2';
				$config['source_image'] = $imgGUIDE;
				$config['new_image'] = $imgGUIDE;
				$config['create_thumb'] = FALSE;
				$config['width'] = $this->STN_categories_guides_images_width;
				$config['height'] = $this->STN_categories_guides_images_height;
				$this->ciObject->image_lib->initialize($config);
				if (!$this->ciObject->image_lib->resize())
				{
    				echo $this->ciObject->image_lib->display_errors();
				}				
			} else continue;					
		}
		return True;
	}	
}
?>