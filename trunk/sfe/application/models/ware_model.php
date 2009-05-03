<?php
class Ware_model extends Model{
	public function getOfferInfo($oRid){
	public function getWareInfo($wRid){
	

	
	
	public function GetWareDetails($parsARR){
			$sqlSTR = "_warespars._pars_rid = _pars.rid AND _warespars.archive='0' AND ( _warespars._wares_rid = (SELECT rid FROM _wares WHERE  _wares._brands_rid='".$parsARR['cmp'][0]['brandsRID']."' AND _wares.model_alias='".$parsARR['cmp'][0]['modelALIAS']."' AND _wares.archive='0' ) ";
			foreach($parsARR['cmp'] as $key=>$item)
			{
				if($key=='0') continue;
				$sqlSTR .=  " OR _warespars._wares_rid = (SELECT rid FROM _wares WHERE  _wares._brands_rid='".$item['brandsRID']."' AND _wares.model_alias='".$item['modelALIAS']."' AND _wares.archive='0' )";
			}
			$this->db->join('_warespars', $sqlSTR." )", 'LEFT');
			$this->db->where(array('_catpars._categories_rid'=>$parsARR['cmp'][0]['catRID'], '_catpars.archive'=>'0'));
		}
		$this->db->orderby('numorder');
		$query = $this->db->get();
		if(!$query->num_rows()) return false;
		return $query->result_array();		
	}
	
	public function GetWareOpinions($parsARR){
	
	public function getWareReviews($wRid, $limit=15, $offset = 0){
		$this->ciObject->load->library('accounts_module');
		$user = $this->ciObject->accounts_module->isLogged();
		$userRid = $user?$user['_USER_RID_']:0;
		$this->db->select("_waresuopinions.*, DATE_FORMAT(_waresuopinions.createDT, '%d/%m/%Y') as rdate, _members.login,
							(select _wopinionsrates.rate from _wopinionsrates where _wopinionsrates._waresuopinions_rid=_waresuopinions.rid and _wopinionsrates._members_rid = {$userRid} limit 1) as urate,
							(select sum(_wopinionsrates.rate) from _wopinionsrates where _wopinionsrates._waresuopinions_rid=_waresuopinions.rid) as r_rate");	
		$this->db->from('_waresuopinions');
		$this->db->join('_members', "_members.rid = _waresuopinions._members_rid AND _members.archive='0'");
		$this->db->where(array('_waresuopinions._wares_rid'=>$wRid));
		$this->db->limit($limit, $offset);
		$this->db->order_by('_waresuopinions.createDT desc');
		$query = $this->db->get();
		return $query->num_rows?$query->result():array();
	}
	
	public function getWareReviewsQuan($wRid){
		$this->db->select("count(_waresuopinions.rid) as quan");	
		$this->db->from('_waresuopinions');
		$this->db->where(array('_waresuopinions._wares_rid'=>$wRid));
		$query = $this->db->get();
		return $query->row()->quan;
	}
	
	public function addReview($dataARR){
		$this->db->insert('_waresuopinions', $dataARR);
		return TRUE;
	}
	
	public function rateReview($inArr){
		$this->db->insert('_wopinionsrates', $inArr);
		return True;
	}
	
	public function getReviewRate($rRid){
		$this->db->select('sum(_wopinionsrates.rate) as rate');
		$this->db->from('_wopinionsrates');
		$this->db->where(array('_waresuopinions_rid'=>$rRid));
		$query = $this->db->get();
		return $query->num_rows()?$query->row()->rate:0;
	}
	
	public function reviewWasRated($rRid, $mRid){
		$this->db->select('rid');
		$this->db->from('_wopinionsrates');
		$this->db->where(array('_waresuopinions_rid'=>$rRid, '_members_rid'=>$mRid));
		$query = $this->db->get();
		return $query->num_rows()?True:False;
	}
}
?>