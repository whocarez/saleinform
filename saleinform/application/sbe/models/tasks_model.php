<?php
include_once APPPATH."libraries/core/Crmmodel.php";
class Tasks_model extends Crmmodel{
	
	public function __construct(){
		parent::__construct();
	}
	
	public function get_ds(){
		$this->db->select('SQL_CALC_FOUND_ROWS _tasks.rid, 
							DATE_FORMAT(_tasks.edate, \'%d.%m.%Y\') as edate,
							_tasks.done, _tasks.descr as descr', False);
		$this->db->from('_tasks');
		$this->db->where(array('owner_users_rid'=>get_curr_urid()));
		$this->db->order_by('_tasks.edate');
		$query = $this->db->get();
		return $query->num_rows()?$query->result():array();
	}
	
	public function create_record(){
		$ins_arr = array('edate'=>date('Y-m-d', strtotime($this->ci->input->post('edate'))),
							'descr'=>$this->ci->input->post('descr'),
							'owner_users_rid'=>get_curr_urid(),
							'modifier_users_rid'=>get_curr_urid());
		$this->db->set('createDT', 'now()', False);
		$this->db->set('modifyDT', 'now()', False);
		$this->db->trans_begin();
		$this->db->insert('_tasks', $ins_arr);
		$insRid = $this->db->insert_id();
		if ($this->db->trans_status() === FALSE){
    		$this->db->trans_rollback();
    		return False;
		}else{
    		$this->db->trans_commit();
    		return $insRid;
		}		
	}
	
	
	public function remove_items(){
		$this->db->trans_begin();
		$this->db->delete('_tasks', array('rid'=>$this->ci->input->post('rid')));	
		if ($this->db->trans_status() === FALSE){
    		$this->db->trans_rollback();
    		return False;
		}else{
    		$this->db->trans_commit();
    		return True;
		}		
	}
}
?>