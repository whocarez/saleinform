<?php/** *  * @author Mazvv * @package Extenders */
class Menu{	private $ci;	private $a_menu_items = array();	private $a_curririd = null;	private $a_currcontroller = null;
	public function __construct() {		$this->ci = &get_instance();			$this->ci->load->model('menu_model');	}	
	public function init_menu(){		$assoc_arr = $this->ci->uri->uri_to_assoc(2);		$this->a_curririd = element('mrid', $assoc_arr, null);		$this->a_currcontroller = $this->ci->menu_model->get_controller($this->a_curririd);		$this->a_menu_items = $this->ci->menu_model->get_menu_items(get_curr_uprid());		return;	}		public function is_allowed($item_rid){		return $this->ci->menu_model->is_allowed(get_curr_uprid(), $item_rid);	}		public function get_curririd(){		return $this->a_curririd;	}		public function get_currcontroller(){		return $this->a_currcontroller;	}		public function render_menu(){		$data['items'] = transform2forest($this->ci->menu_model->get_menu_items(get_curr_uprid(), False), 'rid', 'parent');		return $this->ci->load->view('common/menu', $data, True);	}		public function get_rights(){		if($this->a_curririd) foreach($this->a_menu_items as $item){ if($item['rid'] == $this->a_curririd) return $item['item_rights'];}		return show_error(lang('MENU_SECURITY_ERROR'));	}
	public function get_item_area(){		if($this->a_curririd) foreach($this->a_menu_items as $item){if($item['rid']==$this->a_curririd) return $item['item_area'];}		return false;
	}
	
	public function get_default_search(){
		if($this->a_curririd) foreach($this->a_menu_items as $item){ if($item->rid == $this->a_curririd) return $item->constant_search_rule;}
		return false;
	}

	public function get_default_sort(){
		if($this->a_curririd) foreach($this->a_menu_items as $item){ if($item->rid == $this->a_curririd) return $item->default_sort_rule;}
		return false;
	}		public function get_irid_bycname($name){		return $this->ci->menu_model->get_irid_bycname($name);	}
}
?>