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
	
	public function RenderNewsListArea()
	{
		$resultARR = $this->ciObject->news_model->GetNewsArr(null, $this->_current_news_current_cat_new, $this->_current_news_current_page, $this->STN_news_quan_per_page);
		$this->_current_quan_of_news = $this->ciObject->news_model->GetQueryRowsQuan();
		$newscatsARR = $this->ciObject->news_model->GetNewsCatsArr();
		#$resultARR = array_slice($resultARR, $this->_current_news_current_page, $this->STN_news_quan_per_page);	
		foreach($resultARR as $key=>$row)
		{ 
			$resultARR[$key]['title'] = stripslashes($resultARR[$key]['title']);
			$resultARR[$key]['new'] = character_limiter(auto_typography(stripslashes($resultARR[$key]['new'])), 400);
			if($resultARR[$key]['source_name'] && $resultARR[$key]['source_link']) $resultARR[$key]['source_link'] = '<a href="'.$resultARR[$key]['source_link'].'">'.$resultARR[$key]['source_name']."</a>";
			else $resultARR[$key]['source_link']='';
			$resultARR[$key]['newlink'] = anchor(base_url().index_page().'/news/n/'.$resultARR[$key]['rid'], $this->ciObject->lang->line('LAST_MODULE_NEW_DETAILS'), 'class="c69"');
			$resultARR[$key]['linkstring'] = base_url().index_page().'/news/n/'.$resultARR[$key]['rid'];
			if($row['name']) $resultARR[$key]['img'] = $this->GetNewThumbImage($row);
			else $resultARR[$key]['img'] = null;
		}
		$this->objectsArr['news_module_news_allnews_link'] = anchor(base_url().index_page().'/news', $this->ciObject->lang->line('LAST_MODULE_NEWS_ALL'), 'class="c69"'); 
		$this->objectsArr['news_module_news_cont_arr'] = $resultARR; 
		$this->objectsArr['news_module_news_pagination'] = $this->GetNewsPagination(); 
		$this->objectsArr['news_module_news_categories_cont'] = $this->RenderNewsCatsTable($newscatsARR); 
		$this->objectsArr['news_module_news_cont_area_cont'] = $this->ciObject->load->view('modules/news_module/_newscont.php',$this->objectsArr, True);
		return $this->ciObject->load->view('modules/news_module/newsarea.php',$this->objectsArr, True);
	}

	public function RenderNewsCatsTable($newscatsARR)
	{
		$this->ciObject->load->library('table');
		$this->ciObject->table->clear();
		$tmpl = array (
        				'table_open'          => '<div id="t_newscats"><table celpadding=0 cellspacing=0 >',
            	        'heading_row_start'   => '<tr>',
                	    'heading_row_end'     => '</tr>',
	                    'heading_cell_start'  => '<td>',
	                    'heading_cell_end'    => '</td>',
	                    'row_start'           => '<tr>',
	                    'row_end'             => '</tr>',
	                    'cell_start'          => '<td>',
	                    'cell_end'            => '</td>',
	                    'row_alt_start'       => '<tr>',
	                    'row_alt_end'         => '</tr>',
	                    'cell_alt_start'      => '<td>',
	                    'cell_alt_end'        => '</td>',
	                    'table_close'         => '</table></div>'
    	    	      );
		$this->ciObject->table->set_template($tmpl);
		$list = array();		
		foreach($newscatsARR as $cat) $list[] = anchor(site_url().'/news/c/'.$cat['rid'], $cat['name']).'<br><div class="descr">'.$cat['descr']."</div>";
		$new_list = $this->ciObject->table->make_columns($list, 3);
		return $this->ciObject->table->generate($new_list); 		
	}
	
	public function RenderNewArea()
	{
		#echo $this->_current_news_current_new;
		$resultARR = $this->ciObject->news_model->GetNewsArr($this->_current_news_current_new);
		$resultARR[0]['title'] = stripslashes($resultARR[0]['title']);
		$resultARR[0]['new'] = auto_typography(stripslashes($resultARR[0]['new']));
		$this->objectsArr['news_module_news_current_new'] = $resultARR[0];
		$this->objectsArr['news_module_news_author']=$resultARR[0]['author'];
		if($resultARR[0]['source_name'] && $resultARR[0]['source_link']) $this->objectsArr['news_module_news_link'] = '<a href="'.$resultARR[0]['source_link'].'">'.$resultARR[0]['source_name']."</a>";
		else $this->objectsArr['news_module_news_link']='';
		$this->objectsArr['news_module_news_allnews_link'] = anchor(base_url().index_page().'/news', $this->ciObject->lang->line('LAST_MODULE_NEWS_ALL'), 'class="c69"');; 
		$this->objectsArr['news_module_news_current_new_img'] = $this->GetNewImage($resultARR[0]);		
		$this->objectsArr['news_module_news_cont_area_cont'] = $this->ciObject->load->view('modules/news_module/_newcont.php',$this->objectsArr, True);
		return $this->ciObject->load->view('modules/news_module/newsarea.php',$this->objectsArr, True);
	}
	
	public function GetNewsPagination()
	{
		$paginationCONFIG = array('total_rows'=>$this->_current_quan_of_news, 
									'per_page'=>$this->STN_news_quan_per_page,
									'num_links'=>$this->STN_news_pagination_num_links);
		unset($this->_categories_current_uri_assoc['p']);
		$categories_category_pages_title=$this->ciObject->lang->line('NEWS_MODULE_NEWS_PAGES_TITLE');
		$paginationCONFIG['base_url']=base_url().index_page()."/news/".($this->_current_news_current_cat_new?"c/{$this->_current_news_current_cat_new}/":"")."p/";
		$paginationCONFIG['uri_segment']=$this->_current_news_current_cat_new?5:3;
		$paginationCONFIG['full_tag_open'] = '<div style="float: right; color: #888888; font-size: 90%;font-weight: bold;margin-bottom: 10px;">'.$categories_category_pages_title;
		$paginationCONFIG['full_tag_close'] = '</div>';
		$paginationCONFIG['first_link'] = $this->ciObject->lang->line('NEWS_MODULE_PAGINATION_FIRST_LINK_TITLE');
		$paginationCONFIG['last_link'] = $this->ciObject->lang->line('NEWS_MODULE_PAGINATION_LAST_LINK_TITLE');
		$paginationCONFIG['next_link'] = '&gt&gt';
		$paginationCONFIG['prev_link'] = '&lt&lt';
		$paginationCONFIG['cur_tag_open'] = '<b> [';
		$paginationCONFIG['cur_tag_close'] = ']</b>';

		$this->ciObject->load->library('pagination');
		$this->ciObject->pagination->initialize($paginationCONFIG);
		return $this->ciObject->pagination->create_links();
	}
	
	public function GetNewThumbImage($newROW)
	{
		$this->ciObject->load->library('image_lib');
		$this->ciObject->image_lib->clear();
		$imgORIGINAL = $this->STN_news_image_original_path.$newROW['rid'].'_'.$newROW['name'];
		$imgNEWS  = $this->STN_news_image_sthumb_path.$newROW['rid'].'_'.$newROW['name'];
		if(!file_exists($imgORIGINAL))
		{
			$ifile=fopen($imgORIGINAL, "w");
			fwrite($ifile, $newROW['image']);
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
		$imgNAME = $imgNEWS;
		return base_url().$imgNAME;
	}
	
	public function GetNewImage($newROW)
	{
		$this->ciObject->load->library('image_lib');
		$this->ciObject->image_lib->clear();
		$imgORIGINAL = $this->STN_news_image_original_path.$newROW['rid'].'_'.$newROW['name'];
		$imgNEWS  = $this->STN_news_image_thumb_path.$newROW['rid'].'_'.$newROW['name'];
		if(!file_exists($imgORIGINAL))
		{
			$ifile=fopen($imgORIGINAL, "w");
			fwrite($ifile, $newROW['image']);
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
		$imgNAME = $imgNEWS;
		return base_url().$imgNAME;
	}
	
	
}
?>