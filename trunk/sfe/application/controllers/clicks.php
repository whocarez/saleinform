<?php/* * The Clics*/
class Clicks extends Controller{
	private $objectsArr = array();
	public function __construct(){		parent::Controller();		$this->load->model('clicks_model');	}
		public function index(){		redirect('', 'refresh');	}		public function client($cRid){		/* Переход на страницу клиента */	}		public function offer($oRid = null){		/* Переход на страницу предложения */		if(!$oRid) redirect('', 'refresh');		$url = $this->clicks_model->getOfferUrl($oRid);		if(!$url) redirect('', 'refresh');		redirect(prep_url($url->link_ware), 'refresh');	}	}
?>