<?phpinclude_once APPPATH."libraries/core/Crmmodel.php";class Curourts_model extends Crmmodel{	public function __construct(){		parent::__construct();	}
	public function get_ds(){		$this->db->select('SQL_CALC_FOUND_ROWS _curourts.rid as rid, _curourts.curourt_name as curourt_name,  							_curourts.curourt_name_lat as curourt_name_lat,							_countries.country_name as country_name,  							DATE_FORMAT(_curourts.modifyDT, \'%d.%m.%Y\') as modifyDT, 							_curourts.descr as descr, _curourts.archive', False);		$this->db->from('_curourts');		$this->db->join('_countries','_curourts._countries_rid = _countries.rid');		if($searchRule = $this->ci->get_session('searchrule')) $this->db->like($searchRule);		if($sort = $this->ci->get_session('sort'))	$this->db->orderby($sort['c'], $sort['r']);		$this->db->limit($this->ci->config->item('crm_grid_limit'), element('p', $this->ci->a_uri_assoc, null));		$query = $this->db_get('_curourts');		return $query->num_rows()?$query->result():array();	}
		public function get_edit($rid){		$this->db->select('_curourts.rid as rid, _curourts.curourt_name as curourt_name,  							_curourts.curourt_name_lat as curourt_name_lat,							_curourts._countries_rid as _countries_rid,														_curourts.modifyDT as modifyDT, 							_curourts.owner_users_rid,							_curourts.descr as descr, _curourts.archive');		$this->db->from('_curourts');		$this->db->where(array('_curourts.rid'=>$rid));		$query = $this->db_get('_curourts');		return $query->num_rows()?$query->row():False;	}
		public function create_record(){		$ins_arr = array('curourt_name'=>$this->ci->input->post('curourt_name'),							'curourt_name_lat'=>$this->ci->input->post('curourt_name_lat'),							'_countries_rid'=>$this->ci->input->post('_countries_rid'),									'descr'=>$this->ci->input->post('descr'),							'archive'=>$this->ci->input->post('archive'),							'owner_users_rid'=>get_curr_urid(),							'modifier_users_rid'=>get_curr_urid());		$this->db->set('createDT', 'now()', False);		$this->db->set('modifyDT', 'now()', False);		$this->db->trans_begin();		$this->db->insert('_curourts', $ins_arr);		$insRid = $this->db->insert_id();		if ($this->db->trans_status() === FALSE){    		$this->db->trans_rollback();    		return False;		}else{    		$this->db->trans_commit();    		return $insRid;		}			}
		public function update_record(){		$update_arr = array('curourt_name'=>$this->ci->input->post('curourt_name'),							'curourt_name_lat'=>$this->ci->input->post('curourt_name_lat'),							'_countries_rid'=>$this->ci->input->post('_countries_rid'),									'descr'=>$this->ci->input->post('descr'),							'archive'=>$this->ci->input->post('archive'),							'modifier_users_rid'=>get_curr_urid());		$this->db->set('modifyDT', 'now()', False);		$this->db->trans_begin();		$this->db->update('_curourts', $update_arr, array('rid'=>$this->ci->input->post('rid')));		if ($this->db->trans_status() === FALSE){    		$this->db->trans_rollback();    		return False;		}else{    		$this->db->trans_commit();    		return True;		}			}
		public function remove_items(){		$this->db->trans_begin();		foreach($this->ci->input->post('row') as $rid){			$this->db->delete('_curourts', array('rid'=>$rid));			}		if ($this->db->trans_status() === FALSE){    		$this->db->trans_rollback();    		return False;		}else{    		$this->db->trans_commit();    		return True;		}			}

	public function check_unique($val, $type='name', $rid=null){		$this->db->select('count(*) as quan');		$this->db->from('_curourts');		if($type=='name') $this->db->where(array('curourt_name'=>$val));		else $this->db->where(array('curourt_name_lat'=>$val));		if($rid) $this->db->where(array('rid != '=>$rid));		$query = $this->db->get();		return $query->num_rows()?$query->row()->quan:0;	}
	
	public function move_record(){		$update_doc = array('owner_users_rid'=>get_urid_byemprid($this->ci->input->post('_employeers_rid')));		$this->db->set('modifyDT', 'now()', False);		$this->db->trans_begin();		$this->db->update('_curourts', $update_doc, array('_curourts.rid'=>$this->ci->input->post('rid')));		if ($this->db->trans_status() === FALSE){    		$this->db->trans_rollback();	   		return False;		}else{    		$this->db->trans_commit();    		return $this->ci->input->post('rid');		}			}		public function get_curourtname_byrid($rid){		$this->db->select('_curourts.curourt_name as curourt_name', False);		$this->db->from('_curourts');		$this->db->where(array('rid'=>$rid));		$this->db->order_by('curourt_name');		$query = $this->db->get();		return $query->num_rows()?$query->row()->curourt_name:null; 	}		}
?>