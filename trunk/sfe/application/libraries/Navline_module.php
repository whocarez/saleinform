<?phpif (!defined('BASEPATH')) exit('No direct script access allowed');/* * Navigation line module * Mazvv 14-05-2007 */
class Navline_module{	private $ciObject;	private $objectsArr = array();	private $navArray = array();
	public function __construct(){		$this->ciObject = &get_instance();		$this->ciObject->lang->load('navline_module');		$this->ciObject->load->library('accounts_module');	}
	public function renderMainTopMenu(){		$data = array();		$data['is_logged'] = $this->ciObject->accounts_module->isLogged();		return $this->ciObject->load->view('modules/navline_module/maintopnav.php', $data, True);	}
	public function renderTopMenu(){		$data = array();		$data['is_logged'] = $this->ciObject->accounts_module->isLogged();		return $this->ciObject->load->view('modules/navline_module/topnav.php', $data, True);	}
	public function renderFooterMenu(){		return $this->ciObject->load->view('modules/navline_module/footer.php', null, True);	}}
?>