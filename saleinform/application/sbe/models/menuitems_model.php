<?phpinclude_once APPPATH."libraries/core/Crmmodel.php";class Menuitems_model extends Crmmodel{	
	public function __construct(){		parent::__construct();	}	
	public function get_ds(){		$this->db->select('SQL_CALC_FOUND_ROWS _menu_items.rid as rid, 							_menu_items.item_name as item_name,  							_menu_items.item_controller as item_controller, 							DATE_FORMAT(_menu_items.modifyDT, \'%d.%m.%Y\') as modifyDT, 							_menu_items.descr as descr, _menu_items.archive', False);		$this->db->from('_menu_items');		if($searchRule = $this->ci->get_session('searchrule')) $this->db->like($searchRule);		if($sort = $this->ci->get_session('sort'))	$this->db->orderby($sort['c'], $sort['r']);		$this->db->limit($this->ci->config->item('crm_grid_limit'), element('p', $this->ci->a_uri_assoc, null));		$query = $this->db_get('_menu_items');		return $query->num_rows()?$query->result():array();	}
		public function get_edit($rid){		$this->db->select('_menu_items.rid as rid, 							_menu_items.item_name as item_name,  							_menu_items.item_controller as item_controller, 							_menu_items.modifyDT as modifyDT, 							_menu_items.owner_users_rid,							_menu_items.descr as descr, _menu_items.archive');		$this->db->from('_menu_items');		$this->db->where(array('_menu_items.rid'=>$rid));		$query = $this->db_get('_menu_items');		return $query->num_rows()?$query->row():False;	}
	
	public function create_record(){
		$ins_arr = array('item_name'=>$this->ci->input->post('item_name'),
							'item_controller'=>$this->ci->input->post('item_controller'),
							'descr'=>$this->ci->input->post('descr'),
							'archive'=>$this->ci->input->post('archive'),
							'owner_users_rid'=>get_curr_urid(),
							'modifier_users_rid'=>get_curr_urid());		$this->db->set('createDT', 'now()', False);		$this->db->set('modifyDT', 'now()', False);
		$this->db->trans_begin();
		$this->db->insert('_menu_items', $ins_arr);
		$insRid = $this->db->insert_id();
		if ($this->db->trans_status() === FALSE){
    		$this->db->trans_rollback();
    		return False;
		} else {
    		$this->db->trans_commit();
    		return $insRid;
		}		
	}
	
	public function update_record(){
		$update_arr = array('item_name'=>$this->ci->input->post('item_name'),
							'item_controller'=>$this->ci->input->post('item_controller'),
							'descr'=>$this->ci->input->post('descr'),
							'archive'=>$this->ci->input->post('archive'),
							'modifier_users_rid'=>get_curr_urid());		$this->db->set('modifyDT', 'now()', False);
		$this->db->trans_begin();
		$this->db->update('_menu_items', $update_arr, array('rid'=>$this->ci->input->post('rid')));
		if ($this->db->trans_status() === FALSE){
    		$this->db->trans_rollback();
    		return False;
		}else{
    		$this->db->trans_commit();
    		return True;
		}		
	}
	
	public function remove_items(){
		$this->db->trans_begin();		foreach($this->ci->input->post('row') as $rid){			$this->db->delete('_menu_items', array('rid'=>$rid));			}
		if ($this->db->trans_status() === FALSE){
    		$this->db->trans_rollback();
    		return False;
		}else{
    		$this->db->trans_commit();
    		return True;
		}		
	}		public function get_list(){		$this->db->select('*');		$this->db->from('_menu_items');		$this->db->order_by('_menu_items.item_name');		$query = $this->db->get();		return $query->num_rows()?$query->result():array(); 	}				public function move_record(){		$update_doc = array('owner_users_rid'=>get_urid_byemprid($this->ci->input->post('_employeers_rid')));		$this->db->set('modifyDT', 'now()', False);		$this->db->trans_begin();		$this->db->update('_menu_items', $update_doc, array('_menu_items.rid'=>$this->ci->input->post('rid')));		if ($this->db->trans_status() === FALSE){    		$this->db->trans_rollback();    		return False;		}else{    		$this->db->trans_commit();    		return $this->ci->input->post('rid');		}			}	
}
?>