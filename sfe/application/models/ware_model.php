<?php/* * Ware Model */
class Ware_model extends Model{	private $ciObject;	public function __construct(){		parent::Model();		 $this->ciObject = &get_instance();	}
	public function getOfferInfo($oRid){		$this->db->select('*');		$this->db->from('_pritems');		$this->db->where(array('rid'=>$oRid));		$query = $this->db->get();		return $query->num_rows()?$query->row():array();		}
	public function getWareInfo($wRid){		$this->db->select('*');		$this->db->from('_wares');		$this->db->where(array('rid'=>$wRid));		$query = $this->db->get();		return $query->num_rows()?$query->row():array();		}
		public function getOfferImage($oRid){		$this->db->select('*');		$this->db->from('_pritemsimgs');		$this->db->where(array('_pritems_rid'=>$oRid));		$query = $this->db->get();		return $query->num_rows()?$query->row():array();		}
	public function getWareImages($wRid){		$this->db->select('*');		$this->db->from('_waresimages');		$this->db->where(array('_wares_rid'=>$wRid));		$query = $this->db->get();		return $query->num_rows()?$query->result():array();		}
		public function getWareOffers($oRid, $type='offer'){		$mCurr = $this->ciObject->settings_module->getSetting('_MAIN_CURR_RID_');;		$aCurr = $this->ciObject->settings_module->getSetting('_ADD_CURR_RID_');;		$ctRid = $this->ciObject->settings_module->getSetting('_COUNTRY_RID_');		$cityRid = $this->ciObject->settings_module->getSetting('_CITY_RID_');		$rRid = $this->ciObject->settings_module->getSetting('_REGION_RID_');		$this->db->select("SQL_CALC_FOUND_ROWS _pritems.name as wareNAME,							_pritemsimgs.rid  as prItemIMGS,							/*SFE_GetItemShortDescr(_pritems._wares_rid, _pritems.rid) as wareSDESCR,*/							min(ROUND(IF(_prices._currency_rid = '$aCurr', _prices.price,							IF(_currcources.cource is NULL, _officialcources.cource*_prices.price, _currcources.cource*_prices.price)/IF((SELECT cource FROM _currcources WHERE _clients_rid = _clients.rid AND courcedate=_pritems.prdate AND _currency_rid='$aCurr') is NULL, 								(SELECT cource FROM _officialcources WHERE _countries_rid='$ctRid' AND _currency_rid='$aCurr' AND courcedate=(SELECT max(courcedate) from _officialcources WHERE _countries_rid='$ctRid')), 								(SELECT cource FROM _currcources WHERE _clients_rid = _clients.rid AND courcedate=_pritems.prdate AND _currency_rid='$aCurr'))), 2)) as minaddPRICE,							max(ROUND(IF(_prices._currency_rid = '$aCurr', _prices.price,							IF(_currcources.cource is NULL, _officialcources.cource*_prices.price, _currcources.cource*_prices.price)/IF((SELECT cource FROM _currcources WHERE _clients_rid = _clients.rid AND courcedate=_pritems.prdate AND _currency_rid='$aCurr') is NULL, 								(SELECT cource FROM _officialcources WHERE _countries_rid='$ctRid' AND _currency_rid='$aCurr' AND courcedate=(SELECT max(courcedate) from _officialcources WHERE _countries_rid='$ctRid')), 								(SELECT cource FROM _currcources WHERE _clients_rid = _clients.rid AND courcedate=_pritems.prdate AND _currency_rid='$aCurr'))), 2)) as maxaddPRICE,							min(ROUND(IF(_currcources.cource is NULL, _officialcources.cource*_prices.price, _currcources.cource*_prices.price), 2)) as minbasePRICE,							max(ROUND(IF(_currcources.cource is NULL, _officialcources.cource*_prices.price, _currcources.cource*_prices.price), 2)) as maxbasePRICE,							_clients.popularity as clientRATING,							ROUND((SELECT count(rid) FROM _cluopinions WHERE _clients_rid=_pritems._clients_rid), 0) as clientOPINIONS,							ROUND(IF(_pritems._wares_rid is NULL, NULL, (SELECT avg(mark) FROM _waresuopinions WHERE _wares_rid=_pritems._wares_rid)), 0) as wareRATING,							ROUND(IF(_pritems._wares_rid is NULL, NULL, (SELECT count(rid) FROM _waresuopinions WHERE _wares_rid=_pritems._wares_rid)), 0) as wareOPINIONS,							ROUND(IF(_pritems._wares_rid is NULL, NULL, (SELECT count(rid) FROM _waresrewievs WHERE _wares_rid=_pritems._wares_rid)), 0) as wareREWIEVS,							DATE_FORMAT(_pritems.prdate, '%d-%m-%Y') as offerDATE,							(SELECT endword FROM _currency WHERE rid='$aCurr') as addendWORD,							(SELECT endword FROM _currency WHERE rid='$mCurr') as baseendWORD,							count(_pritems.rid) as offersQUAN, 							_pritems._wares_rid,							_pritems.short_descr as short_descr,							_pritems.link_ware,							_clients.name as clientNAME,								_clients.rid as clientRID,							_clients.slug as clientSLUG,							_clients.street as clientSTREET,							_clients.build as clientBUILD,							_clients.wphones as clientWPHONES,							_cities.name as cityNAME,							_pritems.rid as offerRID, 							_pritems.slug as offerSLUG,							_clientslogos.rid as logo_rid, _clientslogos.name as logo_name, _clientslogos.image as logo_image,							_clients.popularity as clpopularity,							(select count(_cluopinions.rid) from _cluopinions where _cluopinions._clients_rid = _clients.rid) as clops_quan, 							_pritems._categories_rid,							_availabletypes.name as avNAME,							_currency.endword", False);		$this->db->from('_prices');		$this->db->join('_pritems', '_pritems.rid=_prices._pritems_rid');		$this->db->join('_availabletypes', '_pritems._availabletypes_rid=_availabletypes.rid');		$this->db->join('_pritemsimgs', '_pritems.rid=_pritemsimgs._pritems_rid', 'LEFT');		$this->db->join('_clients', '_clients.rid=_pritems._clients_rid');		$this->db->join('_clientslogos', '_clients.rid=_clientslogos._clients_rid', 'LEFT');		$this->db->join('_prtypes', '_prtypes.rid=_prices._prtypes_rid');		$this->db->join('_currency', '_prices._currency_rid=_currency.rid');		$this->db->join('_currcources', '_currcources._clients_rid=_pritems._clients_rid AND _currcources._currency_rid=_prices._currency_rid AND _currcources.courcedate=_pritems.prdate', 'LEFT');		$this->db->join('_officialcources', "_officialcources._currency_rid=_prices._currency_rid AND _officialcources.courcedate = (SELECT max(courcedate) from _officialcources WHERE _countries_rid='$ctRid') AND _officialcources._countries_rid='$ctRid'", 'LEFT');		$this->db->join('_cities', '_cities.rid=_clients._cities_rid '.(($cityRid)?"and _clients._cities_rid={$cityRid}":''));		$this->db->join('_regions', '_regions.rid=_cities._regions_rid '.((!$cityRid && $rRid)?"and _regions.rid={$rRid}":''));		$this->db->join('_countries', '_countries.rid=_regions._countries_rid '.(($ctRid)?"and _countries.rid={$ctRid}":''));		$this->db->where(array('_prtypes.cod'=>'R'));		if($type=='offer') $this->db->where(array('_pritems.rid'=>$oRid));		else if($type=='ware') $this->db->where(array('_pritems._wares_rid'=>$oRid));		/*******************************/		$this->db->orderby('minbasePRICE');  		/* ---------------- */		/* grouping control */		$this->db->groupby('_pritems.rid'); // from one merchant we can have some offers on the same ware, that diferents, for example, by color		//$this->db->groupby('_pritems.model_alias');		/* ---------------- */		$query = $this->db->get();		return $query->num_rows()?$query->result():array();			}
	
	public function GetWareDetails($parsARR){		$mainCURRENCYRID = $parsARR['m_c'];		$addCURRENCYRID = $parsARR['a_c'];		$countriesRID = $parsARR['cn_c'];		$cititesRID = $parsARR['c_c'];		$regionsRID = $parsARR['r_c'];		$priceTYPE = $parsARR['pp'];		if(!isset($parsARR['cmp'])){			$currentCATEGORY = $parsARR['catRID'];				$modelALIAS = $parsARR['modelALIAS'];		}		$sortRULE = $parsARR['sr'];		$this->db->select("_catpars.rid as rid, _catpars._catpars_rid as _catpars_rid, _pars.name, _warespars.value, _warespars._wares_rid");		$this->db->from('_catpars');		$this->db->join('_pars', "_catpars._pars_rid = _pars.rid AND _pars.archive='0'");		if(!isset($parsARR['cmp']))	{			$this->db->join('_warespars', "_warespars._pars_rid = _pars.rid AND _warespars.archive='0' AND _warespars._wares_rid = (SELECT rid FROM _wares WHERE  _wares._brands_rid='$brandRID' AND _wares.model_alias='$modelALIAS' AND _wares.archive='0' )", 'LEFT');			$this->db->where(array('_catpars._categories_rid'=>$currentCATEGORY, '_catpars.archive'=>'0'));		}		else		{
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
	
	public function GetWareOpinions($parsARR){		$mainCURRENCYRID = $parsARR['m_c'];		$addCURRENCYRID = $parsARR['a_c'];		$countriesRID = $parsARR['cn_c'];		$cititesRID = $parsARR['c_c'];		$regionsRID = $parsARR['r_c'];		$currentCATEGORY = $parsARR['catRID'];		$priceTYPE = $parsARR['pp'];		$brandRID = $parsARR['brandsRID'];		$modelALIAS = $parsARR['modelALIAS'];		$sortRULE = $parsARR['sr'];		$this->db->select('_members.display_name, _waresuopinions.opinion, _waresuopinions.mark, DATE_FORMAT(_waresuopinions.createDT, "%d-%m-%Y %H:%i:%s") as opinionDATE');		$this->db->from('_waresuopinions');		$this->db->join('_wares', "_wares.rid=_waresuopinions._wares_rid");		$this->db->join('_members', "_members.rid=_waresuopinions._members_rid");		$this->db->where(array('_wares._brands_rid'=>$brandRID, '_wares.model_alias'=>$modelALIAS));		$this->db->orderby('_waresuopinions.createDT', 'DESC');		$query = $this->db->get();		if(!$query->num_rows()) return false;		return $query->result_array();			}
	
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