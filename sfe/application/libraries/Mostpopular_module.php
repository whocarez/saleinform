<?phpif (!defined('BASEPATH')) exit('No direct script access allowed');/* * Mostpopular module * Mazvv 03-05-2007*/class Mostpopular_module{	private $ciObject;	private $objectsArr = array();	private $STN_mostpopular_icons_images_path = 'images/categories/icons/';	private $STN_mostpopular_pictures_images_path = 'images/categories/picts/'; 	private $STN_mostpopular_ware_images_offers_width = '100';	private $STN_mostpopular_ware_images_offers_height = '100';		private $_current_mostpopular_uri_assoc;	private $_current_mostpopular_uri_string;	private $_current_mostpopular_city_rid;	private $_current_mostpopular_region_rid;	private $_current_mostpopular_country_rid;
	public function __construct(){		$this->ciObject = &get_instance();		$this->ciObject->lang->load('mostpopular_module');		$this->ciObject->load->model('mostpopular_model');	}	
	public function RenderRatedClients(){		$data = array();		$data['clients'] = $this->ciObject->mostpopular_model->GetTopStores();
		return $this->ciObject->load->view('modules/mostpopular_module/ratedclients.php', $data, True);	}		public function RenderMostpopularSearchesArea(){		$searchesTags = $this->ciObject->mostpopular_model->GetTopSearches();		$data = array();		if(count($searchesTags) > 5){			$maxVal = $searchesTags[0]->popularity;			$minVal = $searchesTags[count($searchesTags)-1]->popularity;			shuffle($searchesTags);			$data['tags'] = $searchesTags;			$data['min'] = $minVal;	        $maxFsize = 250;	        $minFsize = 100;	        $data['minFsize'] = $minFsize;			$spread = $maxVal - $minVal;	        if (0 == $spread) $spread = 1;	        $step = ($maxFsize - $minFsize)/($spread);	        $data['step'] = $step;         	return $this->ciObject->load->view('modules/mostpopular_module/cloud.php', $data, True);       		}		return '';	}

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