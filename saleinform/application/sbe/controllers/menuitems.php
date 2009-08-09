<?php/** * TravelCRM * * An open source CRM system for travel agencies * * @author		Mazvv (vitalii.mazur@gmail.com) * @license		GNU GPLv3 (http://gplv3.fsf.org)  * @link		http://www.travelcrm.org.ua */include_once APPPATH."libraries/core/Crmcontroller.php";
class Menuitems extends Crmcontroller {	public function __construct(){
		parent::__construct();
		$this->lang->load('menuitems');
		$this->load->model('menuitems_model');
	}
	
	public function _remap($m_Name){		switch ($m_Name) {
			case 'create': {$this->create();break;}
			case 'edit': {$this->edit();break;}
			case 'details': {$this->details();break;}
			case 'remove': {$this->remove();break;}			case 'move': {$this->move();break;}
			case 'sort': {$this->sort();break;}
			default: {$this->index();}
		}
	}
	
	public function journal(){
		$data = array();		$data['title'] = lang('MENUITEMS_TITLE');				$data['orid'] = $this->get_orid();		$data['sort'] = $this->get_session('sort');		$data['find'] = $this->find();
		$data['fields']['rid'] = array('label'=>'Id', 'colwidth'=>'10%', 'sort'=>True); 
		$data['fields']['item_name'] =  array('label'=>lang('ITEM_NAME'), 'colwidth'=>'30%', 'sort'=>True); 
		$data['fields']['item_controller'] =  array('label'=>lang('ITEM_CONTROLLER'), 'colwidth'=>'20%', 'sort'=>True); 
		$data['fields']['archive'] = array('label'=>lang('ARCHIVE'), 'colwidth'=>'20%', 'sort'=>True, 'type'=>'yes_no'); 
		$data['fields']['modifyDT'] = array('label'=>lang('MODIFYDT'), 'colwidth'=>'20%', 'sort'=>True); 

		$data['yes'] = lang('YES');
		$data['no'] = lang('NO');		$data['tools'] = $this->get_tools(); 
		$data['ds'] = $this->menuitems_model->get_ds();		$data['paging'] = $this->get_paging($this->menuitems_model->get_calc_rows());
		return $this->load->view('standart/grid', $data, True);		
	}
	
	
	private function create(){		$data = array();		$this->form_validation->set_rules('item_name', lang('ITEM_NAME'), 'required');		$this->form_validation->set_rules('item_controller', lang('ITEM_CONTROLLER'), 'trim');		$this->form_validation->set_rules('descr', lang('DESCR'), 'trim|max_length[512]');		$this->form_validation->set_rules('archive', lang('ARCHIVE'), 'trim');		$data['title'] = lang('MENUITEMS_TITLE_CREATE');		$data['orid'] = $this->get_orid();		$data['success'] = null;		if ($this->form_validation->run() === True){			if($rid = $this->menuitems_model->create_record()){				$this->session->set_flashdata('success', True);				redirect(get_currcontroller()."/edit/$rid/mrid/".get_curririd(), 'refresh');				return;			}			else {				$data['success'] = false;			} 		}		$data['content'] = $this->load->view('menuitems/create', $data, True);		return $this->load->view('layouts/main_layout', $data);	}
	
	private function edit(){		$rid = (int)$this->uri->segment(3);		if(!$rid) show_404();		$data = array();		$this->form_validation->set_rules('item_name', lang('ITEM_NAME'), 'required');		$this->form_validation->set_rules('item_controller', lang('ITEM_CONTROLLER'), 'trim');		$this->form_validation->set_rules('descr', lang('DESCR'), 'trim|max_length[512]');		$this->form_validation->set_rules('archive', lang('ARCHIVE'), 'trim');		$data['title'] = lang('MENUITEMS_TITLE_EDIT');		$data['rid'] = $rid;		$data['orid'] = $this->get_orid();		$data['ds'] = $this->menuitems_model->get_edit($rid);		$data['success'] = $this->session->flashdata('success')?$this->session->flashdata('success'):null;		if(!$data['ds']) show_404(); 		if ($this->form_validation->run() === True){			if($this->menuitems_model->update_record()) $data['success'] = true;			else $data['success'] = false;			$data['ds'] = $this->menuitems_model->get_edit($rid);		}		$data['content'] = $this->load->view('menuitems/edit', $data, True);		return $this->load->view('layouts/main_layout', $data);	}
	
	private function details(){		$rid = (int)$this->uri->segment(3);		if(!$rid) show_404();		$data = array();		$data['title'] = lang('MENUITEMS_TITLE_DETAILS');		$data['rid'] = $rid;		$data['orid'] = $this->get_orid();		$data['ds'] = $this->menuitems_model->get_edit($rid);		if(!$data['ds']) show_404(); 		$data['content'] = $this->load->view('menuitems/details', $data, True);		return $this->load->view('layouts/main_layout', $data);	}

	
	private function find(){		$data['orid'] = $this->get_orid();		$this->form_validation->set_rules('item_name', lang('ITEM_NAME'), 'trim');		$this->form_validation->set_rules('item_controller', lang('ITEM_CONTROLLER'), 'trim');		if ($this->form_validation->run() == True){			$search_rule = array();			if($this->input->post('item_name')) $search_rule['_menu_items.item_name'] = $this->input->post('item_name');			if($this->input->post('item_controller')) $search_rule['_menu_items.item_controller'] = $this->input->post('item_controller');			$this->set_searchrule($search_rule);		}		$data['search'] = $this->get_session('searchrule');		return $this->load->view('menuitems/find', $data, True);	}		private function move(){		$rid = (int)$this->uri->segment(3);		if(!$rid) show_404();		$data = array();		$this->form_validation->set_rules('_employeers_rid', lang('NEW_OWNER'), 'required');		$data['title'] = lang('MENUITEMS_TITLE_MOVE');		$data['rid'] = $rid;		$data['orid'] = $this->get_orid();		$data['ds'] = $this->menuitems_model->get_edit($rid);		$data['success'] = $this->session->flashdata('success')?$this->session->flashdata('success'):null;		if(!$data['ds']) show_404(); 		if ($this->form_validation->run() === True){			if($this->menuitems_model->move_record()) $data['success'] = true;			else $data['success'] = false;			$data['ds'] = $this->menuitems_model->get_edit($rid);		}		$data['content'] = $this->load->view('menuitems/move', $data, True);		return $this->load->view('layouts/main_layout', $data);	}	
	}