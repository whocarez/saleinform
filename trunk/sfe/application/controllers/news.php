<?php
/*
 * The News
*/
class News extends Controller{
	private $objectsArr = array();
	
	public function __construct(){
		parent::Controller();
		// { Enable profiler for admin only
		$currentSESS = $this->session->userdata('_SI_');
		if(isset($currentSESS['SI_LOGIN']['_USER_LOGIN_']) && $currentSESS['SI_LOGIN']['_USER_LOGIN_'] == 'mazvv'){
			$this->output->enable_profiler(True);		
		}
		else $this->output->enable_profiler(False);
		// } Enable profiler for admin only
		/* load needed libraries */	
		$this->load->library('accounts_module');
		$this->load->library('settings_module');
		$this->load->library('search_module');
		$this->load->library('mostpopular_module');
		$this->load->library('advertise_module');
		$this->load->library('linkchanges_module');
		$this->load->library('news_module');
		$this->load->library('quickmenu_module');
		$this->load->library('contacts_module');
		$this->load->library('keywords_module');
		/* generate objects */
		$this->objectsArr['login_area_obj'] = $this->accounts_module->RenderLoginArea();
		$this->objectsArr['search_bar_obj'] = $this->search_module->RenderSearchBar();
		$this->objectsArr['settings_area_obj'] = $this->settings_module->RenderSettingsArea();
		$this->objectsArr['mostpopular_searches_obj'] = $this->mostpopular_module->RenderMostpopularSearchesArea();
		$this->objectsArr['advertise_center_obj'] = $this->advertise_module->RenderCenterLinksAdvertiseArea();
		$this->objectsArr['advertise_right_obj'] = $this->advertise_module->RenderRightLinksAdvertiseArea();
		$this->objectsArr['googleads_right_obj'] = $this->advertise_module->RenderGoogleAds_234x60_Area();
		$this->objectsArr['googleads_left_obj'] = $this->advertise_module->RenderGoogleAds_120x90_Area();
		$this->objectsArr['linkchanges_area_obj'] = $this->linkchanges_module->RenderLinkchangesArea();
		$this->objectsArr['quickmenu_area_obj'] = $this->quickmenu_module->RenderQuickmenuArea();
		$this->objectsArr['footermenu_area_obj'] = $this->quickmenu_module->RenderFootermenuArea();
		$this->objectsArr['contactstoolbar_area_obj'] = $this->contacts_module->RenderContactsToolbar();
		$this->objectsArr['metatitle_area_obj'] = $this->keywords_module->RenderMetatitleArea();
		$this->objectsArr['metadescription_area_obj'] = $this->keywords_module->RenderMetadescriptionArea();
	}
	
	public function index($page = null){
		$this->objectsArr['news_area_obj']=$this->news_module->RenderNewsListArea(null, $page);
		$this->objectsArr['newscats_area_obj']=$this->news_module->RenderNewsCats(null);
		$this->objectsArr['keywords_area_obj'] = $this->keywords_module->RenderKeywordsArea($this->objectsArr['news_area_obj']);
		$this->load->view('layouts/news.php', $this->objectsArr);
	}

	public function category($cat_slug = null, $page = null){
		$this->objectsArr['news_area_obj']=$this->news_module->RenderNewsListArea($cat_slug, $page);
		$this->objectsArr['newscats_area_obj']=$this->news_module->RenderNewsCats($cat_slug);
		$this->objectsArr['keywords_area_obj'] = $this->keywords_module->RenderKeywordsArea($this->objectsArr['news_area_obj']);
		$this->load->view('layouts/news.php', $this->objectsArr);
	}
	
	public function shownew($slug){
		/* simple way to change places areas*/
		#$this->objectsArr['newscats_area_obj']=$this->news_module->RenderNewsCats($slug);
		#$this->objectsArr['news_area_obj']=$this->news_module->RenderNewArea($slug);
		$this->objectsArr['news_area_obj']=$this->news_module->RenderNewsCats($slug);
		$this->objectsArr['newscats_area_obj']=$this->news_module->RenderNewArea($slug);
		$this->objectsArr['keywords_area_obj'] = $this->keywords_module->RenderKeywordsArea($this->objectsArr['news_area_obj']);
		$this->load->view('layouts/news.php', $this->objectsArr);			
	}
	
}
?>