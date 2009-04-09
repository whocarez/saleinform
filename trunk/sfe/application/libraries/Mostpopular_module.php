<?php
	public function __construct(){
	public function RenderRatedClients(){
		return $this->ciObject->load->view('modules/mostpopular_module/ratedclients.php', $data, True);

	public function RenderMostpopularCategoriesCarousel(){
		$topresult = $this->ciObject->mostpopular_model->GetTopCategories(4);
		foreach($topresult as $key=>$row){
			$topresult[$key]->img = $this->GetCategoryImage($row);
			$topresult[$key]->leafs = $this->ciObject->mostpopular_model->GetCategoryLeafs($row->rid, 5);
		}
		$data = array('cats'=>$topresult);
		return $this->ciObject->load->view('modules/mostpopular_module/categoriescarousel.php', $data, True);
	}

	public function GetCategoryImage($image){
		# get random image
		$imgNAME = $this->STN_mostpopular_pictures_images_path.$image->irid.'_'.$image->iname;
		if(file_exists($imgNAME)) return base_url().$imgNAME;
		$ifile=fopen($imgNAME, "w");
		fwrite($ifile,$image->iimage);
		fclose($ifile); 	
		$config = array();
		$config['image_library'] = 'GD2';
		$config['source_image'] = $imgNAME;
		$config['create_thumb'] = FALSE;
		$config['width'] = $this->STN_mostpopular_ware_images_offers_width;
		$config['height'] = $this->STN_mostpopular_ware_images_offers_height;
		$this->ciObject->load->library('image_lib');
		$this->ciObject->image_lib->clear();
		$this->ciObject->image_lib->initialize($config);
		if (!$this->ciObject->image_lib->resize())
		{
    		echo $this->ciObject->image_lib->display_errors();
		}				
		return $imgNAME;
	}
}
?>