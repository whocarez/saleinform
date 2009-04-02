<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
/*
 * News module
 * Mazvv 03-05-2007
*/
class News_module 
{
	private $ciObject;
	private $objectsArr = array();
	private $STN_news_quan_per_page = 10;
	private $STN_news_pagination_num_links = 10;
	private $_current_news_uri_assoc;
	private $_current_news_uri_string;
	private $_current_quan_of_news;
	private $_current_news_current_page;
	private $_current_news_current_new;
	private $STN_news_image_sthumb_path = 'images/news/news_sthumb/';
	private $STN_news_image_thumb_path = 'images/news/news_thumb/';
	private $STN_news_image_original_path = 'images/news/original_size/';
	private $STN_news_images_sthumb_width = 50;
	private $STN_news_images_sthumb_height = 50;
	private $STN_news_images_thumb_width = 150;
	private $STN_news_images_thumb_height = 150;
	
	
	public function __construct()
	{
		$this->ciObject = &get_instance();
		$this->ciObject->lang->load('news_module');
		$this->ciObject->load->model('news_model');
		$this->objectsArr['news_area_title'] = $this->ciObject->lang->line('NEWS_MODULE_AREA_TITLE');
		$this->objectsArr['news_area_new_author_title'] = $this->ciObject->lang->line('NEWS_MODULE_NEW_AUTHOR_TITLE');
		$this->objectsArr['news_area_new_source_title'] = $this->ciObject->lang->line('NEWS_MODULE_NEW_SOURCE_TITLE');
		$this->_current_news_uri_assoc = $this->ciObject->uri->uri_to_assoc(2);
		$this->_current_news_current_page = (isset($this->_current_news_uri_assoc['p']) && !empty($this->_current_news_uri_assoc['p']))?$offset = $this->_current_news_uri_assoc['p']:0;
		$this->_current_news_uri_string = $this->ciObject->uri->assoc_to_uri($this->_current_news_uri_assoc);
		$this->_current_news_current_new = (isset($this->_current_news_uri_assoc['n']))?$offset = $this->_current_news_uri_assoc['n']:0;		
		$this->_current_news_current_cat_new = (isset($this->_current_news_uri_assoc['c']))?$offset = $this->_current_news_uri_assoc['c']:0;
		$this->ciObject->load->helper('typography');
	}
	
	public function getCridFromSlug($slug){
		$cArr = explode('-', $slug);
		$cRid = (int)$cArr[0];
		return $cRid; 
	}
	
	public function RenderNewsListArea($cat_slug, $page){
		$cRid = $this->getCridFromSlug($cat_slug);
		$data = array();
		$data['news'] = $this->ciObject->news_model->getNews(null, $cRid, $page);
		$data['news_quan'] = $this->ciObject->news_model->GetQueryRowsQuan();
		foreach($data['news'] as $key=>$row){
			if($row->name) $data['news'][$key]->img = $this->GetNewThumbImage($row);
			else $data['news'][$key]->img = null;
		}
		
		if($cat_slug){
			$config['base_url'] = base_url().index_page().'/newscat/'.$cat_slug.'/';
			$config['uri_segment'] = 3;
		} else {
			$config['base_url'] = base_url().index_page().'/news/';
			$config['uri_segment'] = 2;
		}
		$config['total_rows'] = $data['news_quan'];
		$config['per_page'] = '10'; 
		$config['num_links'] = 5;
		$config['first_link'] = lang('NEWS_MODULE_PAGINATION_FIRST_LINK_TITLE');
		$config['last_link'] = lang('NEWS_MODULE_PAGINATION_LAST_LINK_TITLE');
		$this->ciObject->pagination->initialize($config); 
		$data['pager'] = $this->ciObject->pagination->create_links();
		return $this->ciObject->load->view('modules/news_module/newslist', $data, True);
	}

	public function RenderNewsCats($cat_slug){
		$data = array();
		$data['active'] = $this->getCridFromSlug($cat_slug);
		$data['cats'] = $this->ciObject->news_model->getNewsCats();
		$data['middle'] = (int)(count($data['cats'])/2);
		return $this->ciObject->load->view('modules/news_module/newscats', $data, True);  		
	}
	
	public function RenderNewArea($slug){
		$nRid = $this->getCridFromSlug($slug);
		if(!$nRid) redirect('news', 'refresh');
		$data = array();
		$data['newdata'] = $this->ciObject->news_model->getNews($nRid);
		$data['newdata'] = $data['newdata'][0];
		if(!$data['newdata']) show_404();
		$data['img'] = $this->GetNewImage($data['newdata']);
		if($data['newdata']->source_name && $data['newdata']->source_link) 
			$data['source'] = '<a href="'.$data['newdata']->source_link.'" target="_blank">'.$data['newdata']->source_name."</a>";
		return $this->ciObject->load->view('modules/news_module/newarea.php', $data, True);	
	}
	
	public function GetNewThumbImage($newROW){
		$this->ciObject->load->library('image_lib');
		$this->ciObject->image_lib->clear();
		$imgORIGINAL = $this->STN_news_image_original_path.$newROW->rid.'_'.$newROW->name;
		$imgNEWS  = $this->STN_news_image_sthumb_path.$newROW->rid.'_'.$newROW->name;
		if(!file_exists($imgORIGINAL))
		{
			$ifile=fopen($imgORIGINAL, "w");
			fwrite($ifile, $newROW->image);
			fclose($ifile);
		} 					
		if(!file_exists($imgNEWS))
		{
			$config = array();
			$config['image_library'] = 'GD2';
			$config['source_image'] = $imgORIGINAL;
			$config['new_image'] = $imgNEWS;
			$config['create_thumb'] = FALSE;
			$config['width'] = $this->STN_news_images_sthumb_width;
			$config['height'] = $this->STN_news_images_sthumb_height;
			$this->ciObject->image_lib->initialize($config);
			if (!$this->ciObject->image_lib->resize())
			{
   				echo $this->ciObject->image_lib->display_errors();
			}
		} 					
		return $imgNEWS;
	}
	
	public function GetNewImage($newROW){
		$this->ciObject->load->library('image_lib');
		$this->ciObject->image_lib->clear();
		$imgORIGINAL = $this->STN_news_image_original_path.$newROW->rid.'_'.$newROW->name;
		$imgNEWS  = $this->STN_news_image_thumb_path.$newROW->rid.'_'.$newROW->name;
		if(!file_exists($imgORIGINAL))
		{
			$ifile=fopen($imgORIGINAL, "w");
			fwrite($ifile, $newROW->image);
			fclose($ifile);
		} 					
		if(!file_exists($imgNEWS))
		{
			$config = array();
			$config['image_library'] = 'GD2';
			$config['source_image'] = $imgORIGINAL;
			$config['new_image'] = $imgNEWS;
			$config['create_thumb'] = FALSE;
			$config['width'] = $this->STN_news_images_thumb_width;
			$config['height'] = $this->STN_news_images_thumb_height;
			$this->ciObject->image_lib->initialize($config);
			if (!$this->ciObject->image_lib->resize())
			{
   				echo $this->ciObject->image_lib->display_errors();
			}
		} 					
		return $imgNEWS;
	}
	
	
}
?>