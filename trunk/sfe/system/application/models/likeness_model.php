<?php
/*
 * Likeness Model
 */
class Likeness_model extends Model
{
	public function __construct()
	{
		parent::Model();
		$this->db->query("SET NAMES 'utf8'"); 		
	}
	
	public function GetLikenessArr($parsARR)
	{
		$addCURRENCYRID = $parsARR['addcurrRID'];
		$mainCURRENCYRID = $parsARR['maincurrRID'];
		$countriesRID = $parsARR['countryRID'];
		$regionsRID = $parsARR['regionRID'];
		$citiesRID = $parsARR['cityRID'];
		$priceTYPE = $parsARR['priceTYPE'];
		$this->db->select("concat(_brands.name, ' ', _pritems.model) as wareNAME, 
							min(ROUND(IF(_prices._currency_rid = '$addCURRENCYRID', _prices.price,
							IF(_currcources.cource is NULL, _officialcources.cource*_prices.price, _currcources.cource*_prices.price)/IF((SELECT cource FROM _currcources WHERE _clients_rid = _clients.rid AND courcedate=_pritems.prdate AND _currency_rid='$addCURRENCYRID') is NULL, 
								(SELECT cource FROM _officialcources WHERE _countries_rid='$countriesRID' AND _currency_rid='$addCURRENCYRID' AND courcedate=(SELECT max(courcedate) from _officialcources WHERE _countries_rid='$countriesRID')), 
								(SELECT cource FROM _currcources WHERE _clients_rid = _clients.rid AND courcedate=_pritems.prdate AND _currency_rid='$addCURRENCYRID'))), 2)) as minaddPRICE,
							max(ROUND(IF(_prices._currency_rid = '$addCURRENCYRID', _prices.price,
							IF(_currcources.cource is NULL, _officialcources.cource*_prices.price, _currcources.cource*_prices.price)/IF((SELECT cource FROM _currcources WHERE _clients_rid = _clients.rid AND courcedate=_pritems.prdate AND _currency_rid='$addCURRENCYRID') is NULL, 
								(SELECT cource FROM _officialcources WHERE _countries_rid='$countriesRID' AND _currency_rid='$addCURRENCYRID' AND courcedate=(SELECT max(courcedate) from _officialcources WHERE _countries_rid='$countriesRID')), 
								(SELECT cource FROM _currcources WHERE _clients_rid = _clients.rid AND courcedate=_pritems.prdate AND _currency_rid='$addCURRENCYRID'))), 2)) as maxaddPRICE,
							avg(ROUND(IF(_prices._currency_rid = '$addCURRENCYRID', _prices.price,
							IF(_currcources.cource is NULL, _officialcources.cource*_prices.price, _currcources.cource*_prices.price)/IF((SELECT cource FROM _currcources WHERE _clients_rid = _clients.rid AND courcedate=_pritems.prdate AND _currency_rid='$addCURRENCYRID') is NULL, 
								(SELECT cource FROM _officialcources WHERE _countries_rid='$countriesRID' AND _currency_rid='$addCURRENCYRID' AND courcedate=(SELECT max(courcedate) from _officialcources WHERE _countries_rid='$countriesRID')), 
								(SELECT cource FROM _currcources WHERE _clients_rid = _clients.rid AND courcedate=_pritems.prdate AND _currency_rid='$addCURRENCYRID'))), 2)) as avgaddPRICE,
							min(ROUND(IF(_currcources.cource is NULL, _officialcources.cource*_prices.price, _currcources.cource*_prices.price), 2)) as minbasePRICE,
							max(ROUND(IF(_currcources.cource is NULL, _officialcources.cource*_prices.price, _currcources.cource*_prices.price), 2)) as maxbasePRICE,
							avg(ROUND(IF(_currcources.cource is NULL, _officialcources.cource*_prices.price, _currcources.cource*_prices.price), 2)) as avgbasePRICE,
							ROUND(IF(_pritems._wares_rid is NULL, NULL, (SELECT avg(mark) FROM _waresuopinions WHERE _wares_rid=_pritems._wares_rid)), 0) as wareRATING,
							ROUND(IF(_pritems._wares_rid is NULL, NULL, (SELECT count(rid) FROM _waresuopinions WHERE _wares_rid=_pritems._wares_rid)), 0) as wareOPINIONS,
							ROUND(IF(_pritems._wares_rid is NULL, NULL, (SELECT count(rid) FROM _waresrewievs WHERE _wares_rid=_pritems._wares_rid)), 0) as wareREWIEVS,
							(SELECT endword FROM _currency WHERE rid='$addCURRENCYRID') as addendWORD,
							(SELECT endword FROM _currency WHERE rid='$mainCURRENCYRID') as baseendWORD,
							count(_pritems.rid) as offersQUAN, 
							_categories.iscompared, 
							_categories.isgrouped, 
							_pritems._wares_rid,
							_pritems.short_descr,
							_pritems.link_ware,
							_pritems._brands_rid,		 
							_pritems.model_alias,
							_pritems._categories_rid,
							_prtypes.cod as prCOD,
							_guides.rid as guideRID,
							_currency.endword");
		$this->db->from('_prices');
		$this->db->join('_pritems', '_pritems.rid=_prices._pritems_rid');
		$this->db->join('_clients', '_clients.rid=_pritems._clients_rid');
		$this->db->join('_brands', '_brands.rid=_pritems._brands_rid');	
		$this->db->join('_categories', '_pritems._categories_rid=_categories.rid');	
		$this->db->join('_prtypes', '_prtypes.rid=_prices._prtypes_rid');
		$this->db->join('_currency', '_prices._currency_rid=_currency.rid');
		$this->db->join('_guides', '_categories.rid=_guides._categories_rid', 'LEFT');
		$this->db->join('_currcources', '_currcources._clients_rid=_pritems._clients_rid AND _currcources._currency_rid=_prices._currency_rid AND _currcources.courcedate=_pritems.prdate', 'LEFT');
		$this->db->join('_officialcources', "_officialcources._currency_rid=_prices._currency_rid AND _officialcources.courcedate = (SELECT max(courcedate) from _officialcources WHERE _countries_rid='$countriesRID')");
		$this->db->join('_catpars', "_categories.rid=_catpars._categories_rid AND _catpars.archive='0' AND _catpars.likeness='1'");
		$this->db->join('_pars', "_pars.rid=_catpars._pars_rid AND _pars.archive='0'");
		$this->db->join('_warespars', "_pritems._wares_rid=_warespars._wares_rid AND _warespars._pars_rid = _pars.rid 
										AND _warespars.archive='0' 
										AND _warespars.value in (SELECT value from _warespars JOIN _wares ON _wares._brands_rid = '".$parsARR['b']."' AND _wares._categories_rid='".$parsARR['c']."' AND _wares.model_alias='".$parsARR['m']."') 
										");

		if($citiesRID)
		{
			$this->db->where(array('_clients._cities_rid'=>$cititesRID));
		}
		else if(!$citiesRID && $regionsRID)
		{
			$this->db->join('_cities', '_cities.rid=_clients._cities_rid');
			$this->db->join('_regions', '_regions.rid=_cities._regions_rid');
			$this->db->where(array('_regions.rid'=>$regionsRID));
		}
		else
		{
			$this->db->join('_cities', '_cities.rid=_clients._cities_rid');
			$this->db->join('_regions', '_regions.rid=_cities._regions_rid');
			$this->db->join('_countries', '_countries.rid=_regions._countries_rid');
			$this->db->where(array('_countries.rid'=>$countriesRID));
		}
		$this->db->where(array('_pritems._categories_rid'=>$parsARR['c'],
								'_pritems.archive'=>'0',
								'_prtypes.cod'=>$priceTYPE,
								'_pritems.model_alias<>'=>$parsARR['m'],
									));
		$this->db->groupby('_pritems._brands_rid, _pritems.model_alias');
		$this->db->orderby('RAND(), _pritems.model_alias');
		$this->db->limit('10');
		$query = $this->db->get();
		if($query->num_rows()) 
		{
			return $query->result_array();
		}
		return FALSE;
	}
}
?>