<?php/* * The settings*/class Settings extends Controller{	private $objectsArr = array();
	public function __construct(){		parent::Controller();		$this->output->enable_profiler(FALSE);		$this->load->library('settings_module');		$this->load->library('search_module');		$this->load->library('quickmenu_module');		$this->load->library('contacts_module');		/* generate objects */		$this->objectsArr['search_bar_obj'] = $this->search_module->RenderSearchBar();		$this->objectsArr['quickmenu_area_obj'] = $this->quickmenu_module->RenderQuickmenuArea();		$this->objectsArr['footermenu_area_obj'] = $this->quickmenu_module->RenderFootermenuArea();		$this->objectsArr['contactstoolbar_area_obj'] = $this->contacts_module->RenderContactsToolbar();	}
	public function index(){		$this->objectsArr['settings_area_obj'] = $this->settings_module->renderSetSettingsArea();		$meta = $this->constant_model->getMeta();		$this->objectsArr['title'] = $meta->meta_title;		$this->objectsArr['meta'] = array(array('name' => 'Content-type', 'content' => 'text/html; charset=utf-8', 'type' => 'equiv'),        									array('name' => 'robots', 'content' => 'no-cache'),        									array('name' => 'description', 'content' => $meta->meta_description),        									array('name' => 'keywords', 'content' => $meta->meta_keywords),        									array('name' => 'robots', 'content' => 'no-cache'));		$this->load->view('layouts/settings/settings.php', $this->objectsArr);	}
	public function changecountry(){		$this->output->enable_profiler(FALSE);		$this->output->set_output($this->settings_module->changeCountry());	}
	public function changeregion(){		$this->output->enable_profiler(FALSE);		$this->output->set_output($this->settings_module->changeRegion());	}}
?>