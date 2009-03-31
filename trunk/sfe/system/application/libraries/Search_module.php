<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
/*
 * Search module
 * Mazvv 30-04-2007
*/
class Search_module 
{
	private $ciObject; # code igniter instance
	private $objectsArr = array(); # object's array
	/* { Module settings */
	private $STN_search_header_items = array();# main menu items
	private $STN_search_header_more_items = array();# main more menu items
	private $STN_search_title; # search title
	private $STN_search_logo_title; # logo title
	private $STN_search_btn_caption; # caption of search button
	private $STN_search_radio_btns_items = array(); # search radio buttons items captions
	private $STN_search_advertize_items = array(); # search advertize items
	private $_search_current_uri_assoc; 
	private $_search_current_uri_string;
	/* } Module settings */
	
	public function __construct()
	{
		$this->ciObject = &get_instance();
		$this->ciObject->lang->load('search_module');
		$this->_search_current_uri_assoc = $this->ciObject->uri->uri_to_assoc(2);
		$this->_search_current_uri_string = $this->ciObject->uri->assoc_to_uri($this->_search_current_uri_assoc);
		$this->STN_search_logo_title = $this->ciObject->lang->line('SEARCH_MODULE_LOGO_TITLE');
	}
	
	public function RenderSearchBar()
	{
		$this->objectsArr['search_current_in_this_cat'] = '';	
		$this->objectsArr['search_current_search_url'] = base_url().index_page().'/categories/';
		$this->objectsArr['search_current_category_rid'] = '';
		$this->objectsArr['search_current_search_string_empty'] = $this->ciObject->lang->line('SEARCH_MODULE_SEARCH_STRING_EMPTY');
		$this->objectsArr['search_current_search_btn_value'] = $this->ciObject->lang->line('SEARCH_MODULE_BTN_VALUE');
		$this->objectsArr['search_current_search_more_tab'] = $this->ciObject->lang->line('SEARCH_MODULE_HEAD_MORE_TAB');
		$this->objectsArr['search_current_search_string'] = '';		
		if(!$this->ciObject->uri->segment(1))
		{
			/* main page */
			$this->STN_search_header_items = array(array($this->ciObject->lang->line('SEARCH_MODULE_HEAD_MAIN_TAB'), base_url()),
													array($this->ciObject->lang->line('SEARCH_MODULE_HEAD_CATS_TAB'), base_url().index_page().'/categories'),
													array($this->ciObject->lang->line('SEARCH_MODULE_HEAD_GUIDES_TAB'), base_url().index_page().'/guides'),
													array($this->ciObject->lang->line('SEARCH_MODULE_HEAD_BRANDS_TAB'), base_url().index_page().'/brands'),
													array($this->ciObject->lang->line('SEARCH_MODULE_HEAD_SHOPS_TAB'), base_url().index_page().'/clients'),
													array($this->ciObject->lang->line('SEARCH_MODULE_HEAD_ADVERTIZE_TAB'), base_url().index_page().'/advertize'));
			$this->STN_search_header_more_items = array(array($this->ciObject->lang->line('SEARCH_MODULE_HEAD_SETTINGS_TAB'), base_url().index_page().'/settings'),
														array($this->ciObject->lang->line('SEARCH_MODULE_HEAD_NEWS_TAB'), base_url().index_page().'/news'),
														array($this->ciObject->lang->line('SEARCH_MODULE_HEAD_FORUM_TAB'), base_url().'/forum'),
														array($this->ciObject->lang->line('SEARCH_MODULE_HEAD_HELP_TAB'), base_url().index_page().'/help'),														
														array($this->ciObject->lang->line('SEARCH_MODULE_HEAD_CONTACTS_TAB'), base_url().index_page().'/contacts'));
			$this->objectsArr['search_current_header_item'] = 0;			
		}
		else if($this->ciObject->uri->segment(1)=='categories')
		{
			/* categories page */
			$this->ciObject->load->model('categories_model');
			if(isset($this->_search_current_uri_assoc['c']) && $this->_search_current_uri_assoc['c'] && !$this->ciObject->categories_model->GetCategoriesArr($this->_search_current_uri_assoc['c']))
			{
				$this->objectsArr['search_current_in_this_cat'] = form_checkbox('search_thiscat', '1', TRUE, 'id="search_thiscat"').$this->ciObject->lang->line('SEARCH_MODULE_SEARCH_THIS_CAT');
				$this->objectsArr['search_current_category_rid'] = $this->_search_current_uri_assoc['c'];
			}
			if(isset($this->_search_current_uri_assoc['ss'])) $this->objectsArr['search_current_search_string'] = $this->_search_current_uri_assoc['ss']; 			
			$this->STN_search_header_items = array(array($this->ciObject->lang->line('SEARCH_MODULE_HEAD_MAIN_TAB'), base_url()),
													array($this->ciObject->lang->line('SEARCH_MODULE_HEAD_CATS_TAB'), base_url().index_page().'/categories'),
													array($this->ciObject->lang->line('SEARCH_MODULE_HEAD_GUIDES_TAB'), base_url().index_page().'/guides'),
													array($this->ciObject->lang->line('SEARCH_MODULE_HEAD_BRANDS_TAB'), base_url().index_page().'/brands'),
													array($this->ciObject->lang->line('SEARCH_MODULE_HEAD_SHOPS_TAB'), base_url().index_page().'/clients'),
													array($this->ciObject->lang->line('SEARCH_MODULE_HEAD_ADVERTIZE_TAB'), base_url().index_page().'/advertize')); # main menu items
			$this->objectsArr['search_current_header_item'] = 1;
		}
		else if($this->ciObject->uri->segment(1)=='clients')
		{
			/* clients page */
			$this->STN_search_header_items = array(array($this->ciObject->lang->line('SEARCH_MODULE_HEAD_MAIN_TAB'), base_url()),
													array($this->ciObject->lang->line('SEARCH_MODULE_HEAD_CATS_TAB'), base_url().index_page().'/categories'),
													array($this->ciObject->lang->line('SEARCH_MODULE_HEAD_GUIDES_TAB'), base_url().index_page().'/guides'),
													array($this->ciObject->lang->line('SEARCH_MODULE_HEAD_BRANDS_TAB'), base_url().index_page().'/brands'),
													array($this->ciObject->lang->line('SEARCH_MODULE_HEAD_SHOPS_TAB'), base_url().index_page().'/clients'),
													array($this->ciObject->lang->line('SEARCH_MODULE_HEAD_ADVERTIZE_TAB'), base_url().index_page().'/advertize')); # main menu items
			$this->objectsArr['search_current_header_item'] = 4;			
		}
		else if($this->ciObject->uri->segment(1)=='brands')
		{
			/* clients page */
			$this->STN_search_header_items = array(array($this->ciObject->lang->line('SEARCH_MODULE_HEAD_MAIN_TAB'), base_url()),
													array($this->ciObject->lang->line('SEARCH_MODULE_HEAD_CATS_TAB'), base_url().index_page().'/categories'),
													array($this->ciObject->lang->line('SEARCH_MODULE_HEAD_GUIDES_TAB'), base_url().index_page().'/guides'),
													array($this->ciObject->lang->line('SEARCH_MODULE_HEAD_BRANDS_TAB'), base_url().index_page().'/brands'),
													array($this->ciObject->lang->line('SEARCH_MODULE_HEAD_SHOPS_TAB'), base_url().index_page().'/clients'),
													array($this->ciObject->lang->line('SEARCH_MODULE_HEAD_ADVERTIZE_TAB'), base_url().index_page().'/advertize')); # main menu items
			$this->objectsArr['search_current_header_item'] = 3;			
		}
		else if($this->ciObject->uri->segment(1)=='guides')
		{
			/* clients page */
			$this->STN_search_header_items = array(array($this->ciObject->lang->line('SEARCH_MODULE_HEAD_MAIN_TAB'), base_url()),
													array($this->ciObject->lang->line('SEARCH_MODULE_HEAD_CATS_TAB'), base_url().index_page().'/categories'),
													array($this->ciObject->lang->line('SEARCH_MODULE_HEAD_GUIDES_TAB'), base_url().index_page().'/guides'),
													array($this->ciObject->lang->line('SEARCH_MODULE_HEAD_BRANDS_TAB'), base_url().index_page().'/brands'),
													array($this->ciObject->lang->line('SEARCH_MODULE_HEAD_SHOPS_TAB'), base_url().index_page().'/clients'),
													array($this->ciObject->lang->line('SEARCH_MODULE_HEAD_ADVERTIZE_TAB'), base_url().index_page().'/advertize')); # main menu items
			$this->objectsArr['search_current_header_item'] = 2;			
		}
		else if($this->ciObject->uri->segment(1)=='settings')
		{
			/* settings page */
			$this->STN_search_header_items = array(array($this->ciObject->lang->line('SEARCH_MODULE_HEAD_MAIN_TAB'), base_url()),
													array($this->ciObject->lang->line('SEARCH_MODULE_HEAD_CATS_TAB'), base_url().index_page().'/categories'),
													array($this->ciObject->lang->line('SEARCH_MODULE_HEAD_SETTINGS_TAB'), base_url().index_page().'/settings'),
													array($this->ciObject->lang->line('SEARCH_MODULE_HEAD_BRANDS_TAB'), base_url().index_page().'/brands'),
													array($this->ciObject->lang->line('SEARCH_MODULE_HEAD_SHOPS_TAB'), base_url().index_page().'/clients'),
													array($this->ciObject->lang->line('SEARCH_MODULE_HEAD_ADVERTIZE_TAB'), base_url().index_page().'/advertize')); # main menu items
			$this->objectsArr['search_current_header_item'] = 2;			
		}
		else if($this->ciObject->uri->segment(1)=='help')
		{
			/* clients page */
			$this->STN_search_header_items = array(array($this->ciObject->lang->line('SEARCH_MODULE_HEAD_MAIN_TAB'), base_url()),
													array($this->ciObject->lang->line('SEARCH_MODULE_HEAD_CATS_TAB'), base_url().index_page().'/categories'),
													array($this->ciObject->lang->line('SEARCH_MODULE_HEAD_GUIDES_TAB'), base_url().index_page().'/guides'),
													array($this->ciObject->lang->line('SEARCH_MODULE_HEAD_BRANDS_TAB'), base_url().index_page().'/brands'),
													array($this->ciObject->lang->line('SEARCH_MODULE_HEAD_SHOPS_TAB'), base_url().index_page().'/clients'),
													array($this->ciObject->lang->line('SEARCH_MODULE_HEAD_ADVERTIZE_TAB'), base_url().index_page().'/advertize')); # main menu items
			$this->objectsArr['search_current_header_item'] = 5;			
		}
		
		else if($this->ciObject->uri->segment(1)=='advertize')
		{
			/* clients page */
			$this->STN_search_header_items = array(array($this->ciObject->lang->line('SEARCH_MODULE_HEAD_MAIN_TAB'), base_url()),
													array($this->ciObject->lang->line('SEARCH_MODULE_HEAD_CATS_TAB'), base_url().index_page().'/categories'),
													array($this->ciObject->lang->line('SEARCH_MODULE_HEAD_GUIDES_TAB'), base_url().index_page().'/guides'),
													array($this->ciObject->lang->line('SEARCH_MODULE_HEAD_BRANDS_TAB'), base_url().index_page().'/brands'),
													array($this->ciObject->lang->line('SEARCH_MODULE_HEAD_SHOPS_TAB'), base_url().index_page().'/clients'),
													array($this->ciObject->lang->line('SEARCH_MODULE_HEAD_ADVERTIZE_TAB'), base_url().index_page().'/advertize')); # main menu items
			$this->objectsArr['search_current_header_item'] = 5;			
		}
		else if($this->ciObject->uri->segment(1)=='news')
		{
			/* clients page */
			$this->STN_search_header_items = array(array($this->ciObject->lang->line('SEARCH_MODULE_HEAD_MAIN_TAB'), base_url()),
													array($this->ciObject->lang->line('SEARCH_MODULE_HEAD_CATS_TAB'), base_url().index_page().'/categories'),
													array($this->ciObject->lang->line('SEARCH_MODULE_HEAD_GUIDES_TAB'), base_url().index_page().'/guides'),
													array($this->ciObject->lang->line('SEARCH_MODULE_HEAD_BRANDS_TAB'), base_url().index_page().'/brands'),
													array($this->ciObject->lang->line('SEARCH_MODULE_HEAD_SHOPS_TAB'), base_url().index_page().'/clients'),
													array($this->ciObject->lang->line('SEARCH_MODULE_HEAD_NEWS_TAB'), base_url().index_page().'/news')); # main menu items
			$this->objectsArr['search_current_header_item'] = 5;			
		}
		
		else
		{
			/* other page */
			$this->STN_search_header_items = array(array($this->ciObject->lang->line('SEARCH_MODULE_HEAD_MAIN_TAB'), base_url()),
													array($this->ciObject->lang->line('SEARCH_MODULE_HEAD_CATS_TAB'), base_url().index_page().'/categories'),
													array($this->ciObject->lang->line('SEARCH_MODULE_HEAD_GUIDES_TAB'), base_url().index_page().'/guides'),
													array($this->ciObject->lang->line('SEARCH_MODULE_HEAD_BRANDS_TAB'), base_url().index_page().'/brands'),
													array($this->ciObject->lang->line('SEARCH_MODULE_HEAD_SHOPS_TAB'), base_url().index_page().'/clients'),
													array($this->ciObject->lang->line('SEARCH_MODULE_HEAD_ADVERTIZE_TAB'), base_url().index_page().'/advertize')); # main menu items
			$this->objectsArr['search_current_header_item'] = 200;			
		}
		
		$this->objectsArr['logo_title'] = $this->STN_search_logo_title;
		$this->objectsArr['header_items'] = $this->STN_search_header_items;
		#$this->objectsArr['more_header_items'] = $this->STN_search_header_more_items;
		$this->objectsArr['more_header_items'] = array(); # пока не используем до утряски дизайна
		return $this->ciObject->load->view('modules/search_module/searchbar.php',$this->objectsArr, True);
	}
}
?>