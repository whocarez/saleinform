<?phpclass Constant_model extends Model{	public function __construct($memoryMode = true){		parent::Model();	}
		public function GetConstants(){		$this->db->select('*');		$this->db->from('sys_options');		$this->db->where(array('archive'=>'0'));		$query = $this->db->get();		return $query->result_array();	}		public function getConstant($code){		$this->db->select('*');		$this->db->from('sys_options');		$this->db->where(array('archive'=>'0', 'cod'=>$code));		$query = $this->db->get();		return $query->num_rows()?$query->row()->value:null;	}	public function getMeta($code = null){		$this->db->select('*');		$this->db->from('_metadata');		if(!$code) $this->db->where(array('code'=>'DEFAULT'));		else $this->db->where(array('code'=>$code));		$query = $this->db->get();		return $query->num_rows()?$query->row():null;	}
}
?>