<?php
/**
 * TravelCRM
 *
 * An open source CRM system for travel agencies
 *
 * @author		Mazvv (vitalii.mazur@gmail.com)
 * @license		GNU GPLv3 (http://gplv3.fsf.org) 
 * @link		http://www.travelcrm.org.ua
 */
include_once APPPATH."libraries/core/Crmcontroller.php";
class Tasks extends Crmcontroller {
	
	public function __construct(){
		parent::__construct();
		$this->lang->load('tasks');
		$this->load->model('tasks_model');
	}
	
	public function _remap($m_Name){
		switch ($m_Name) {
			case 'create': {$this->output->set_output($this->create());break;}
			case 'remove': {$this->output->set_output($this->remove());break;}
		}
	}
	
	private function create(){
		$data = array();
		$this->form_validation->set_rules('edate', lang('DATE_DESCR'), 'required|trim');
		$this->form_validation->set_rules('descr', lang('DESCR_TASK'), 'trim|required|max_length[512]');
		$data['orid'] = $this->get_orid();
		if ($this->form_validation->run() === True){
			$this->tasks_model->create_record();
		}
		$data['title'] = lang('TASKS_TITLE');
		$data['tasks_action'] = true;
		$data['tasks'] = $this->tasks_model->get_ds();
		return $this->load->view('tasks/grid', $data, True);
	}

	protected function remove(){
		if($rid = $this->input->post('rid')){
			$this->tasks_model->remove_items();	
		}
		$data['orid'] = $this->get_orid();
		$data['title'] = lang('TASKS_TITLE');
		$data['tasks'] = $this->tasks_model->get_ds();
		return $this->load->view('tasks/grid', $data, True);
	}
}

?>