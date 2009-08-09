<?phpinclude_once APPPATH."libraries/core/Reportmodel.php";class R_adveffectivity_model extends Reportmodel{	public function __construct(){		parent::__construct();	}		public function get_ds(){		$date_from = date('Y-m-d', strtotime($this->ci->input->post('date_report_from')));		$date_to = date('Y-m-d', strtotime($this->ci->input->post('date_report_to')));		$_advertisescompanies_rid = $this->ci->input->post('_advertisescompanies_rid');		# получить оплаты за рекламу за расчетный период		# учитываем затраты по всем статьям документа c типом ADVERTISES		$this->db->select('SUM(_finjournal.sum_value) as adv_sum, _advertisessources.source_name as source_name,								_advertisessources.rid as adv_rid, _advertisestypes.type_name as type_name');		$this->db->from('_documents');		$this->db->join('_finjournal', '_finjournal._documents_rid = _documents.rid');		$this->db->join('_advertises_headers', '_advertises_headers._documents_rid = _documents.rid');		$this->db->join('_account_states', '_finjournal._account_states_rid = _account_states.rid');		$this->db->join('_advertisessources', '_advertises_headers._advertisessources_rid = _advertisessources.rid');		$this->db->join('_advertisestypes', '_advertisessources._advertisestypes_rid = _advertisestypes.rid');		$this->db->where(array('_documents.doc_type'=>'ADVERTISES', '_account_states.koef'=>-1,								'_advertises_headers.date_doc >='=>$date_from, '_advertises_headers.date_doc <='=>$date_to));		if($_advertisescompanies_rid) $this->db->where(array('_advertises_headers._advertisescompanies_rid'=>$_advertisescompanies_rid));		$this->db->group_by('_advertisessources.rid');		$query = $this->db_get('_documents');		$payed_adv = array();		$company_type = null;		if($_advertisescompanies_rid){			$this->db->select('*');			$this->db->from('_advertisescompanies');			$this->db->where(array('rid'=>$_advertisescompanies_rid));			$company_type = $this->db->get()->row()->company_type;		}				switch ($company_type){			case 'TOURISM':{				# 1. Звонки				$this->db->select('count(DISTINCT _documents.rid) as quan,									_advertisestypes.rid as adv_type_rid,									_advertisestypes.type_name as adv_type_name,									_advertisessources.rid as adv_source_rid,									_advertisessources.source_name as adv_source_name', False);				$this->db->from('_documents');				$this->db->where(array('_documents.doc_type'=>'CALLS'));				$this->db->join('_calls_headers', '_calls_headers._documents_rid=_documents.rid');				$this->db->join('_calls_rows', '_calls_rows._calls_headers_rid=_calls_headers.rid');				$this->db->join('_advertisessources', '_advertisessources.rid=_calls_rows._advertisessources_rid');				$this->db->join('_advertisestypes', '_advertisessources._advertisestypes_rid=_advertisestypes.rid');				$this->db->where(array('_calls_headers.date_doc >='=>$date_from, '_calls_headers.date_doc <='=>$date_to));				$this->db->where("_advertisessources.rid in (select _advertisessources_rid from _advertises_headers where _advertises_headers._advertisescompanies_rid = {$_advertisescompanies_rid} )");				$this->db->group_by('_advertisessources.rid');				$query_calls = $this->db_get('_documents');				# ----------------						# 2. Заявки				$this->db->select('count(DISTINCT _documents.rid) as quan,									sum(_finjournal.sum_value*_account_states.koef) as doxod,									_advertisestypes.rid as adv_type_rid,									_advertisestypes.type_name as adv_type_name,									_advertisessources.rid as adv_source_rid,									_advertisessources.source_name as adv_source_name', False);				$this->db->from('_documents');				$this->db->where(array('_documents.doc_type'=>'DEMANDS'));				$this->db->join('_demands_headers', '_demands_headers._documents_rid=_documents.rid');				$this->db->join('_advertisessources', '_advertisessources.rid=_demands_headers._advertisessources_rid');				$this->db->join('_advertisestypes', '_advertisessources._advertisestypes_rid=_advertisestypes.rid');				$this->db->join('_finjournal', '_finjournal._documents_rid = _documents.rid', 'LEFT');				$this->db->join('_account_states', '_finjournal._account_states_rid = _account_states.rid', 'LEFT');				$this->db->where(array('_demands_headers.date_doc >='=>$date_from, '_demands_headers.date_doc <='=>$date_to));				$this->db->where("_advertisessources.rid in (select _advertisessources_rid from _advertises_headers where _advertises_headers._advertisescompanies_rid = {$_advertisescompanies_rid} )");				$this->db->group_by('_advertisessources.rid');				$query_demands = $this->db_get('_documents');				# ----------------				# формируем результат				break;							}			case 'AVIA':{				# 1. Звонки авиа				$this->db->select('count(DISTINCT _documents.rid) as quan,									_advertisestypes.rid as adv_type_rid,									_advertisestypes.type_name as adv_type_name,									_advertisessources.rid as adv_source_rid,									_advertisessources.source_name as adv_source_name', False);				$this->db->from('_documents');				$this->db->where(array('_documents.doc_type'=>'AIRCALLS'));				$this->db->join('_aircalls_headers', '_aircalls_headers._documents_rid=_documents.rid');				$this->db->join('_aircalls_rows', '_aircalls_rows._aircalls_headers_rid=_aircalls_headers.rid');				$this->db->join('_advertisessources', '_advertisessources.rid=_aircalls_rows._advertisessources_rid');				$this->db->join('_advertisestypes', '_advertisessources._advertisestypes_rid=_advertisestypes.rid');				$this->db->where(array('_aircalls_headers.date_doc >='=>$date_from, '_aircalls_headers.date_doc <='=>$date_to));				$this->db->where("_advertisessources.rid in (select _advertisessources_rid from _advertises_headers where _advertises_headers._advertisescompanies_rid = {$_advertisescompanies_rid} )");				$this->db->group_by('_advertisessources.rid');				$query_aircalls = $this->db_get('_documents');				# ----------------						# 2. Заявки авиа				$this->db->select('count(DISTINCT _documents.rid) as quan,									sum(_finjournal.sum_value*_account_states.koef) as doxod,									_advertisestypes.rid as adv_type_rid,									_advertisestypes.type_name as adv_type_name,									_advertisessources.rid as adv_source_rid,									_advertisessources.source_name as adv_source_name', False);				$this->db->from('_documents');				$this->db->where(array('_documents.doc_type'=>'DEMANDS'));				$this->db->join('_airsell_headers', '_airsell_headers._documents_rid=_documents.rid');				$this->db->join('_advertisessources', '_advertisessources.rid=_airsell_headers._advertisessources_rid');				$this->db->join('_advertisestypes', '_advertisessources._advertisestypes_rid=_advertisestypes.rid');				$this->db->join('_finjournal', '_finjournal._documents_rid = _documents.rid', 'LEFT');				$this->db->join('_account_states', '_finjournal._account_states_rid = _account_states.rid', 'LEFT');				$this->db->where(array('_airsell_headers.date_doc >='=>$date_from, '_airsell_headers.date_doc <='=>$date_to));				$this->db->where("_advertisessources.rid in (select _advertisessources_rid from _advertises_headers where _advertises_headers._advertisescompanies_rid = {$_advertisescompanies_rid} )");				$this->db->group_by('_advertisessources.rid');				$query_airsell = $this->db_get('_documents');				# ----------------				break;			}			default:{				# 1. Звонки				$this->db->select('count(DISTINCT _documents.rid) as quan,									_advertisestypes.rid as adv_type_rid,									_advertisestypes.type_name as adv_type_name,									_advertisessources.rid as adv_source_rid,									_advertisessources.source_name as adv_source_name', False);				$this->db->from('_documents');				$this->db->where(array('_documents.doc_type'=>'CALLS'));				$this->db->join('_calls_headers', '_calls_headers._documents_rid=_documents.rid');				$this->db->join('_calls_rows', '_calls_rows._calls_headers_rid=_calls_headers.rid');				$this->db->join('_advertisessources', '_advertisessources.rid=_calls_rows._advertisessources_rid');				$this->db->join('_advertisestypes', '_advertisessources._advertisestypes_rid=_advertisestypes.rid');				$this->db->where(array('_calls_headers.date_doc >='=>$date_from, '_calls_headers.date_doc <='=>$date_to));				$this->db->group_by('_advertisessources.rid');				$query_calls = $this->db_get('_documents');				# ----------------						# 2. Заявки				$this->db->select('count(DISTINCT _documents.rid) as quan,									sum(_finjournal.sum_value*_account_states.koef) as doxod,									_advertisestypes.rid as adv_type_rid,									_advertisestypes.type_name as adv_type_name,									_advertisessources.rid as adv_source_rid,									_advertisessources.source_name as adv_source_name', False);				$this->db->from('_documents');				$this->db->where(array('_documents.doc_type'=>'DEMANDS'));				$this->db->join('_demands_headers', '_demands_headers._documents_rid=_documents.rid');				$this->db->join('_advertisessources', '_advertisessources.rid=_demands_headers._advertisessources_rid');				$this->db->join('_advertisestypes', '_advertisessources._advertisestypes_rid=_advertisestypes.rid');				$this->db->join('_finjournal', '_finjournal._documents_rid = _documents.rid', 'LEFT');				$this->db->join('_account_states', '_finjournal._account_states_rid = _account_states.rid', 'LEFT');				$this->db->where(array('_demands_headers.date_doc >='=>$date_from, '_demands_headers.date_doc <='=>$date_to));				$this->db->group_by('_advertisessources.rid');				$query_demands = $this->db_get('_documents');				# ----------------				# 3. Звонки авиа				$this->db->select('count(DISTINCT _documents.rid) as quan,									_advertisestypes.rid as adv_type_rid,									_advertisestypes.type_name as adv_type_name,									_advertisessources.rid as adv_source_rid,									_advertisessources.source_name as adv_source_name', False);				$this->db->from('_documents');				$this->db->where(array('_documents.doc_type'=>'AIRCALLS'));				$this->db->join('_aircalls_headers', '_aircalls_headers._documents_rid=_documents.rid');				$this->db->join('_aircalls_rows', '_aircalls_rows._aircalls_headers_rid=_aircalls_headers.rid');				$this->db->join('_advertisessources', '_advertisessources.rid=_aircalls_rows._advertisessources_rid');				$this->db->join('_advertisestypes', '_advertisessources._advertisestypes_rid=_advertisestypes.rid');				$this->db->where(array('_aircalls_headers.date_doc >='=>$date_from, '_aircalls_headers.date_doc <='=>$date_to));				$this->db->group_by('_advertisessources.rid');				$query_aircalls = $this->db_get('_documents');				# ----------------						# 4. Заявки авиа				$this->db->select('count(DISTINCT _documents.rid) as quan,									sum(_finjournal.sum_value*_account_states.koef) as doxod,									_advertisestypes.rid as adv_type_rid,									_advertisestypes.type_name as adv_type_name,									_advertisessources.rid as adv_source_rid,									_advertisessources.source_name as adv_source_name', False);				$this->db->from('_documents');				$this->db->where(array('_documents.doc_type'=>'DEMANDS'));				$this->db->join('_airsell_headers', '_airsell_headers._documents_rid=_documents.rid');				$this->db->join('_advertisessources', '_advertisessources.rid=_airsell_headers._advertisessources_rid');				$this->db->join('_advertisestypes', '_advertisessources._advertisestypes_rid=_advertisestypes.rid');				$this->db->join('_finjournal', '_finjournal._documents_rid = _documents.rid', 'LEFT');				$this->db->join('_account_states', '_finjournal._account_states_rid = _account_states.rid', 'LEFT');				$this->db->where(array('_airsell_headers.date_doc >='=>$date_from, '_airsell_headers.date_doc <='=>$date_to));				$this->db->group_by('_advertisessources.rid');				$query_airsell = $this->db_get('_documents');				# ----------------				break;			}		}		$result = array();		if(isset($query) && $query->num_rows()){			foreach($query->result() as $row){				if(isset($result[$row->adv_rid])) $result[$row->adv_rid]['calls_quan'] = 0;  				else $result[$row->adv_rid] = array('adv_source_name'=>$row->source_name, 														'adv_type_name'=>$row->type_name,														'cost'=>$row->adv_sum,														'calls_quan'=>0,														'demands_quan'=>0,														'doxod'=>0);			}		}		if(isset($query_calls) && $query_calls->num_rows()){			foreach($query_calls->result() as $row){				if(isset($result[$row->adv_source_rid])) $result[$row->adv_source_rid]['calls_quan'] += $row->quan;  				else $result[$row->adv_source_rid] = array('adv_source_name'=>$row->adv_source_name, 														'adv_type_name'=>$row->adv_type_name,														'cost'=>0,														'calls_quan'=>$row->quan,														'demands_quan'=>0,														'doxod'=>0);			}		}		if(isset($query_demands) && $query_demands->num_rows()){			foreach($query_demands->result() as $row){				if(isset($result[$row->adv_source_rid])){					$result[$row->adv_source_rid]['demands_quan'] += $row->quan;  					$result[$row->adv_source_rid]['doxod'] += $row->doxod;				}				else $result[$row->adv_source_rid] = array('adv_source_name'=>$row->adv_source_name, 														'adv_type_name'=>$row->adv_type_name,														'cost'=>0,														'calls_quan'=>0,														'demands_quan'=>$row->quan,														'doxod'=>$row->doxod);			}		}		if(isset($query_aircalls) && $query_aircalls->num_rows()){			foreach($query_aircalls->result() as $row){				if(isset($result[$row->adv_source_rid])) $result[$row->adv_source_rid]['calls_quan'] += $row->quan;  				else $result[$row->adv_source_rid] = array('adv_source_name'=>$row->adv_source_name, 														'adv_type_name'=>$row->adv_type_name,														'cost'=>0,														'calls_quan'=>$row->quan,														'demands_quan'=>0,														'doxod'=>0);			}		}		if(isset($query_airsell) && $query_airsell->num_rows()){			foreach($query_airsell->result() as $row){				if(isset($result[$row->adv_source_rid])){					$result[$row->adv_source_rid]['demands_quan'] += $row->quan;					$result[$row->adv_source_rid]['doxod'] += $row->doxod;  				}				else $result[$row->adv_source_rid] = array('adv_source_name'=>$row->adv_source_name, 														'adv_type_name'=>$row->adv_type_name,														'cost'=>0,														'calls_quan'=>0,																'demands_quan'=>$row->quan,														'doxod'=>$row->doxod);			}		}		return $result;	}	
}
?>