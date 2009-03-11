<?phpif (!defined('BASEPATH')) exit('No direct script access allowed');/* * Clients module * Mazvv 30-05-2007*/class Clients_module{	private $ciObject;	private $newestQuan = 5;	private $STN_clients_logos_images_path = 'images/clients/logos/';	private $STN_clients_logos_width = 80;	private $STN_clients_logos_height = 30;	private $STN_clients_big_logo_width = 200;	private $STN_clients_big_logo_height = 150;	private $objectsArr = array();	private $_current_clients_uri_assoc;	private $_current_clients_client_rid;	private $_current_clients_mode;	private $_current_clients_nav_letter; 	private $_current_clients_main_curr_rid;	private $_current_clients_add_curr_rid;		private $_current_clients_city_rid;	private $_current_clients_country_rid;	private $_current_clients_region_rid;
	public function __construct(){		$this->ciObject = &get_instance();		$this->ciObject->lang->load('clients_module');		$this->ciObject->load->model('clients_model');		$this->_current_clients_uri_assoc = $this->ciObject->uri->uri_to_assoc(2);	}
	
	public function RenderRetailersList(){		$data = array();		$SR = element('l', $this->_current_clients_uri_assoc);		if(!$SR) $SR = 'A';		$data['current_letter'] = mb_strtoupper($SR, 'UTF-8');		$data['clients_list'] = $this->ciObject->clients_model->getClientsList($data['current_letter']);		foreach($data['clients_list'] as $key=>$row){			$data['clients_list'][$key]->logo = $this->GetMiniLogoImage($row);		}		return $this->ciObject->load->view('modules/clients_module/list.php', $data, True);	}
		public function getCridFromSlug($slug){		$clientArr = explode('-', $slug);		$clientRid = (int)$clientArr[0];		return $clientRid; 	}	
	public function renderClientInfo($slug, $offset){		$clientRid = $this->getCridFromSlug($slug);		$this->ciObject->load->library('accounts_module');		$data = array();		$data['client_info'] = $this->ciObject->clients_model->getClient($clientRid);		if($data['client_info']->logo_name) $data['client_info']->logo = $this->GetBigLogoImage($data['client_info']);		else $data['client_info']->logo = null;		$data['client_cats'] = $this->ciObject->clients_model->getClcats($clientRid);		$data['client_reviews_quan'] = $this->ciObject->clients_model->getClientReviewsQuan($clientRid);		$data['client_reviews'] = $this->ciObject->clients_model->getClientReviews($clientRid, 5, $offset);		$data['reviews_limit'] = 5;		$data['reviews_offset'] = $offset;		$data['user'] = $this->ciObject->accounts_module->isLogged();		$this->ciObject->load->library('pagination');		$config['base_url'] = base_url().index_page().'/client/'.$data['client_info']->rid.'-'.$data['client_info']->slug;		$config['total_rows'] = $data['client_reviews_quan'];		$config['per_page'] = $data['reviews_limit'];		$this->ciObject->pagination->initialize($config);		$data['pager'] = $this->ciObject->pagination->create_links();				return $this->ciObject->load->view('modules/clients_module/clientinfo.php',$data, True);		
	}

	public function RenderNewestClients(){		$data = array();		$data['clients_list'] = $this->ciObject->clients_model->getNewestClients($this->newestQuan);		foreach($data['clients_list'] as $key=>$row){			$data['clients_list'][$key]->logo = $this->GetMiniLogoImage($row);		}		return $this->ciObject->load->view('modules/clients_module/newest_clients.php', $data, True);	}
		public function GetMiniLogoImage($image){		$imgNAME = $this->STN_clients_logos_images_path.$image->logo_rid.'_mini_'.$image->logo_name;		if(file_exists($imgNAME)) return base_url().$imgNAME;		$ifile=fopen($imgNAME, "w");		fwrite($ifile,$image->logo_image);		fclose($ifile); 		$config = array();		$config['image_library'] = 'GD2';		$config['source_image'] = $imgNAME;		$config['create_thumb'] = FALSE;		$config['width'] = $this->STN_clients_logos_width;		$config['height'] = $this->STN_clients_logos_height;		$this->ciObject->load->library('image_lib');		$this->ciObject->image_lib->clear();		$this->ciObject->image_lib->initialize($config);		if (!$this->ciObject->image_lib->resize()){    		echo $this->ciObject->image_lib->display_errors();		}			return $imgNAME;	}
	public function GetBigLogoImage($image){		$imgNAME = $this->STN_clients_logos_images_path.$image->logo_rid.'_big_'.$image->logo_name;		if(file_exists($imgNAME)) return base_url().$imgNAME;		$ifile=fopen($imgNAME, "w");		fwrite($ifile,$image->logo_image);		fclose($ifile); 		$config = array();		$config['image_library'] = 'GD2';		$config['source_image'] = $imgNAME;		$config['create_thumb'] = FALSE;		$config['width'] = $this->STN_clients_big_logo_width;		$config['height'] = $this->STN_clients_big_logo_height;		$this->ciObject->load->library('image_lib');		$this->ciObject->image_lib->clear();		$this->ciObject->image_lib->initialize($config);		if (!$this->ciObject->image_lib->resize()){    		echo $this->ciObject->image_lib->display_errors();		}			return $imgNAME;	}
	public function registerProcessing(){		$data = array();		$data['urformsList'] = $this->ciObject->clients_model->GetUrformsList();		$data['cltypesList'] = $this->ciObject->clients_model->GetCltypesList();		$data['countriesList'] = $this->ciObject->clients_model->GetCountriesList();		return $this->ciObject->load->view('modules/clients_module/regform.php', $data, True);	}
		public function getClientProducts(){		$clientRid = element('showproducts', $this->_current_clients_uri_assoc);		$data['result'] = $this->ciObject->clients_model->GetClientProducts($clientRid);		$data['client'] = 	$this->ciObject->clients_model->GetClient($clientRid);		return $this->ciObject->load->view('modules/clients_module/clientpr.php', $data, True);			}
		public function redirectToClient($cRid){		$url = 	$this->ciObject->clients_model->GetClient($cRid)->url;		redirect($url, 'refresh');	}	public function reviewProcessing($slug){		$this->ciObject->load->library('accounts_module');		$clientRid = $this->getCridFromSlug($slug);		$this->ciObject->form_validation->set_rules('mark', lang('CLIENTS_MY_MARK'), 'trim|required');		$this->ciObject->form_validation->set_rules('title', lang('CLIENTS_REVIEW_TITLE'), 'trim|required|min_length[5]|max_length[255]');		$this->ciObject->form_validation->set_rules('review', lang('CLIENTS_REVIEW_REVIEW'), 'trim|min_length[128]|max_length[2048]');		$this->ciObject->form_validation->set_rules('positive', lang('CLIENTS_REVIEW_POS'), 'trim|required|min_length[5]|max_length[255]');		$this->ciObject->form_validation->set_rules('negative', lang('CLIENTS_REVIEW_NEG'), 'trim|required|min_length[5]|max_length[255]');				$data['client'] = 	$this->ciObject->clients_model->GetClient($clientRid);		$data['user'] = $this->ciObject->accounts_module->isLogged();		if(!$data['user']) redirect('accounts', 'refresh');		if($this->ciObject->form_validation->run()===False){			return $this->ciObject->load->view('modules/clients_module/editreview.php', $data, True);			}		$insertArr = array('title'=>$this->ciObject->input->post('title'),							'adv'=>$this->ciObject->input->post('positive'),							'disadv'=>$this->ciObject->input->post('negative'),							'opinion'=>$this->ciObject->input->post('review'),							'mark'=>((int)$this->ciObject->input->post('mark'))*2,									'_members_rid'=>$data['user']['_USER_RID_'],							'_clients_rid'=>$clientRid);		$this->ciObject->load->model('cluops_model');		$this->ciObject->cluops_model->addReview($insertArr);		redirect('client/'.$data['client']->rid.'-'.$data['client']->slug, 'refresh');	}		public function rateReview(){		$reviewRid = $this->ciObject->input->post('review');		$rate = $this->ciObject->input->post('rate');		$this->ciObject->load->library('accounts_module');		$user = $this->ciObject->accounts_module->isLogged();		if($member_rid = element('_USER_RID_', $user)){			if(!$this->ciObject->clients_model->reviewWasRated($reviewRid, $member_rid)){				$insertArr = array('_cluopinions_rid'=>$reviewRid, '_members_rid'=>$member_rid, 'rate'=>$rate);				$this->ciObject->clients_model->rateReview($insertArr);			}		}		return $this->ciObject->clients_model->getReviewRate($reviewRid);	}
}
?>