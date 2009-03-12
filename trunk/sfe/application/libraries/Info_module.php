<?phpif (!defined('BASEPATH')) exit('No direct script access allowed');/* * Info module * Mazvv 18-06-2007*/class Info_module{	private $ciObject;
	public function __construct(){		$this->ciObject = &get_instance();		$this->ciObject->lang->load('info_module');	}
	public function renderWhatIsItArea(){		return $this->ciObject->load->view('modules/info_module/infowhatisitarea.php', null, True);	}
	public function renderHowItWorksArea(){		return $this->ciObject->load->view('modules/info_module/infohowitworksarea.php', null, True);	}}
?>