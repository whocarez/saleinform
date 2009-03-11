<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
/*
 * Navigation line module
 * Mazvv 14-05-2007
*/
class Navline_module 
{
	private $ciObject;
	private $objectsArr = array();
	private $navArray = array();
	
	public function __construct()
	{
		$this->ciObject = &get_instance();
		$this->ciObject->lang->load('navline_module');
		$this->navArray = array(array($this->ciObject->lang->line('NAVLINE_MODULE_MAIN_LINK_TITLE'), base_url()),
								array($this->ciObject->lang->line('NAVLINE_MODULE_CATEGORIES_LINK_TITLE'), '/categories/sa'));
		$this->CreateNavigationLineArray();
		$this->objectsArr['navline_items'] = array();
		foreach($this->navArray as $key=>$item)
		{ 
			#$this->objectsArr['navline_items'][] = ($key!=count($this->navArray)-1)?anchor($item[1], $item[0]):$item[0];
			$this->objectsArr['navline_items'][] = anchor($item[1], $item[0]);
		}
		$this->objectsArr['navline_links_line'] = implode(' > ', $this->objectsArr['navline_items']);
	}

	public function CreateNavigationLineArray()
	{
		if($this->ciObject->uri->segment(1)=='categories' && $this->ciObject->uri->segment(2)=='c' && $catRID = $this->ciObject->uri->segment(3))
		{
			$this->m_treeNodes = array();
			$categoriesLIST = $this->ciObject->categories_model->GetCategoriesArr();
			$this->ciObject->load->plugin('tree');
			if(!$categoriesLIST) return FALSE;
			$categoryNODE = getNodeParentsById($categoriesLIST, $catRID, 'rid', '_categories_rid');
			$categoryNODEARR = array();
			foreach($categoryNODE as $node) $categoryNODEARR[] = array($node['name'],'/categories/c/'.$node['rid']);
			$this->navArray = array_merge($this->navArray, $categoryNODEARR);
		}
		if($this->ciObject->uri->segment(1)=='ware' && $this->ciObject->uri->segment(2)=='c' && $catRID = $this->ciObject->uri->segment(3))
		{
			$this->m_treeNodes = array();
			$this->ciObject->load->model('categories_model');
			$this->ciObject->load->model('ware_model');
			$categoriesLIST = $this->ciObject->categories_model->GetCategoriesArr();
			$this->ciObject->load->plugin('tree');
			$wareFULLNAME = $this->ciObject->ware_model->GetWareFullName($catRID, $this->ciObject->uri->segment(5), $this->ciObject->uri->segment(7));
			if(!$categoriesLIST) return FALSE;
			if(!$wareFULLNAME) return FALSE;
			$categoryNODE = getNodeParentsById($categoriesLIST, $catRID, 'rid', '_categories_rid');
			$categoryNODEARR = array();
			foreach($categoryNODE as $node) $categoryNODEARR[] = array($node['name'],'/categories/c/'.$node['rid']);
			$categoryNODEARR[] = array($wareFULLNAME['wareFULLNAME'], $this->ciObject->uri->uri_string());
			$this->navArray = array_merge($this->navArray, $categoryNODEARR);
		}
		if($this->ciObject->uri->segment(1)=='wareuops' && $this->ciObject->uri->segment(2)=='c' && $catRID = $this->ciObject->uri->segment(3))
		{
			$this->m_treeNodes = array();
			$this->ciObject->load->model('categories_model');
			$this->ciObject->load->model('ware_model');
			$categoriesLIST = $this->ciObject->categories_model->GetCategoriesArr();
			$this->ciObject->load->plugin('tree');
			$wareFULLNAME = $this->ciObject->ware_model->GetWareFullName($catRID, $this->ciObject->uri->segment(5), $this->ciObject->uri->segment(7));
			if(!$categoriesLIST) return FALSE;
			if(!$wareFULLNAME) return FALSE;
			$categoryNODE = getNodeParentsById($categoriesLIST, $catRID, 'rid', '_categories_rid');
			$categoryNODEARR = array();
			foreach($categoryNODE as $node) $categoryNODEARR[] = array($node['name'],'/categories/c/'.$node['rid']);
			$categoryNODEARR[] = array($wareFULLNAME['wareFULLNAME'], $this->ciObject->uri->uri_string());
			$this->navArray = array_merge($this->navArray, $categoryNODEARR);
		}
		if($this->ciObject->uri->segment(1)=='clients')
		{
			$this->m_treeNodes = array();
			$this->navArray = array(array($this->ciObject->lang->line('NAVLINE_MODULE_MAIN_LINK_TITLE'), base_url()),
									array($this->ciObject->lang->line('NAVLINE_MODULE_CLIENTS_LINK_TITLE'), '/clients'));
			if(($this->ciObject->uri->segment(2)=='c' || $this->ciObject->uri->segment(2)=='o' || $this->ciObject->uri->segment(2)=='p') && $clientRID = $this->ciObject->uri->segment(3))
			{
				$this->ciObject->load->model('clients_model');	
				$clientROW = $this->ciObject->clients_model->GetClientArr($clientRID);
				if($clientROW) $this->navArray[] = array($clientROW['name'], '/clients/c/'.$clientROW['rid']);
			}
			if($this->ciObject->uri->segment(2)=='r')
			{
				$this->navArray[] = array($this->ciObject->lang->line('NAVLINE_MODULE_CLIENTS_RULES_TITLE'), '/clients/r');
			}
			if($this->ciObject->uri->segment(2)=='ac1' || $this->ciObject->uri->segment(2)=='ac2' ||
				$this->ciObject->uri->segment(2)=='ac3' || $this->ciObject->uri->segment(2)=='ac4' ||
				$this->ciObject->uri->segment(2)=='ac5')
			{
				$this->navArray[] = array($this->ciObject->lang->line('NAVLINE_MODULE_CLIENTS_ADD_TITLE'), '/clients/r');
			}
			
		}
		if($this->ciObject->uri->segment(1)=='cluops')
		{
			$this->m_treeNodes = array();
			$this->navArray = array(array($this->ciObject->lang->line('NAVLINE_MODULE_MAIN_LINK_TITLE'), base_url()),
									array($this->ciObject->lang->line('NAVLINE_MODULE_CLIENTS_LINK_TITLE'), '/clients'));
			if($this->ciObject->uri->segment(2)=='c' && $clientRID = $this->ciObject->uri->segment(3))
			{
				$this->ciObject->load->model('clients_model');	
				$clientROW = $this->ciObject->clients_model->GetClientArr($clientRID);
				if($clientROW) $this->navArray[] = array($clientROW['name'], '/clients/c/'.$clientROW['rid']);
			}
		}
		if($this->ciObject->uri->segment(1)=='brands')
		{
			$this->m_treeNodes = array();
			$this->navArray = array(array($this->ciObject->lang->line('NAVLINE_MODULE_MAIN_LINK_TITLE'), base_url()),
									array($this->ciObject->lang->line('NAVLINE_MODULE_BRANDS_LINK_TITLE'), '/brands'));
			if(($this->ciObject->uri->segment(2)=='b' || $this->ciObject->uri->segment(2)=='o' || $this->ciObject->uri->segment(2)=='p') && $brandRID = $this->ciObject->uri->segment(3))
			{
				$this->ciObject->load->model('brands_model');	
				$brandROW = $this->ciObject->brands_model->GetBrandArr($brandRID);
				if($brandROW) $this->navArray[] = array($brandROW['name'], '/brands/b/'.$brandROW['rid']);
			}
		}
		
		if($this->ciObject->uri->segment(1)=='guides')
		{
			$this->m_treeNodes = array();
			$this->navArray = array(array($this->ciObject->lang->line('NAVLINE_MODULE_MAIN_LINK_TITLE'), base_url()),
									array($this->ciObject->lang->line('NAVLINE_MODULE_GUIDES_LINK_TITLE'), '/guides'));
			if($this->ciObject->uri->segment(2)=='c' && $categoryRID = $this->ciObject->uri->segment(3))
			{
				$this->ciObject->load->model('categories_model');	
				$categoryROW = $this->ciObject->categories_model->GetCategoryArr($categoryRID);
				if($categoryROW) $this->navArray[] = array($categoryROW['name'], '/guides/c/'.$categoryROW['rid']);
			}
		}

		if($this->ciObject->uri->segment(1)=='ware' && $this->ciObject->uri->segment(2)=='cmp')
		{
			$this->m_treeNodes = array();
			if($this->ciObject->uri->segment(3)=='c' && $categoryRID = $this->ciObject->uri->segment(4))
			{
				$this->ciObject->load->model('categories_model');	
				$categoryROW = $this->ciObject->categories_model->GetCategoryArr($categoryRID);
				if($categoryROW) $this->navArray[] = array($categoryROW['name'], '/categories/c/'.$categoryROW['rid']);
				$this->navArray[] = array($this->ciObject->lang->line('NAVLINE_MODULE_COMPARES_LINK_TITLE'), '');
			}
		}
		
		if($this->ciObject->uri->segment(1)=='help')
		{
			$this->m_treeNodes = array();
			$this->navArray = array(array($this->ciObject->lang->line('NAVLINE_MODULE_MAIN_LINK_TITLE'), base_url()),
									array($this->ciObject->lang->line('NAVLINE_MODULE_HELP_LINK_TITLE'), '/help'));
		}

		if($this->ciObject->uri->segment(1)=='advertize')
		{
			$this->m_treeNodes = array();
			$this->navArray = array(array($this->ciObject->lang->line('NAVLINE_MODULE_MAIN_LINK_TITLE'), base_url()),
									array($this->ciObject->lang->line('NAVLINE_MODULE_ADVERTIZE_LINK_TITLE'), '/advertize'));
		}

		if($this->ciObject->uri->segment(1)=='news')
		{
			$this->ciObject->load->model('news_model');
			$this->navArray = array(array($this->ciObject->lang->line('NAVLINE_MODULE_MAIN_LINK_TITLE'), base_url()),
									array($this->ciObject->lang->line('NAVLINE_MODULE_NEWS_LINK_TITLE'), '/news'));
			if($this->ciObject->uri->segment(2)=='c' && $newsCatRID = $this->ciObject->uri->segment(3)){
				$rowNews = $this->ciObject->news_model->GetNewsCatsArr($newsCatRID);
				$this->navArray[] = array($rowNews[0]['name'], '/news/c/'.$rowNews[0]['rid']);
			}
		}
		
		return TRUE;	
	}
	
	public function RenderNavigationLine()
	{
		return $this->ciObject->load->view('modules/navline_module/navline.php',$this->objectsArr, True);
	}
}
?>