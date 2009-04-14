<?php
	public function __construct(){
	}
	
	public function index(){
		$this->objectsArr['categories_area_obj'] = $this->categories_module->RenderCategoriesList();
		$this->load->view('layouts/categories.php', $this->objectsArr);
	}
	
	public function offer($slug = null, $offset = null){
		if(!$slug) show_404();
		$this->objectsArr['ware_area_obj']=$this->ware_module->RenderWareInfo($slug, $offset);
		$meta = $this->constant_model->getMeta();
		$this->load->view('layouts/ware/ware.php', $this->objectsArr);
	}
	
	public function editreview($wSlug){
		$this->objectsArr['ware_info_obj'] = $this->ware_module->reviewProcessing($wSlug);
		$meta = $this->constant_model->getMeta();
		$this->load->view('layouts/ware/editreview', $this->objectsArr);
	}
	
	public function reviewrate(){
		$this->output->enable_profiler(False);
		$this->output->set_output($this->ware_module->rateReview());	
	}
}
?>