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
	
	public function index($page = null){

	public function category($cat_slug = null, $page = null){
		$this->objectsArr['news_area_obj']=$this->news_module->RenderNewsListArea($cat_slug, $page);
		$this->objectsArr['newscats_area_obj']=$this->news_module->RenderNewsCats($cat_slug);
		$meta = $this->constant_model->getMeta();
		$this->load->view('layouts/news.php', $this->objectsArr);
	}
	
	public function shownew($slug){
		$this->load->view('layouts/news.php', $this->objectsArr);			
	}
	
}
?>