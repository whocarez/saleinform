<?php
/*
 * Settings Model
 */
class Settings_model extends Model
{
	public function __construct()
	{
		parent::Model();
		$this->db->query("SET NAMES 'utf8'"); 
	}
	
	public function GetSettings($countryRID, $regionRID = null, $cityRID = null, $addcurrencyRID = null)
	{
		if($cityRID) 
		{
			$this->db->select('_countries.rid as countryRID, _countries.name as countryNAME,
								_regions.rid as regionRID, _regions.display_name as regionNAME, 
								_cities.rid as cityRID, _cities.name as cityNAME,
								_currency.rid as currencyRID, _currency.name as currencyNAME, 
								_currency.cod as currencyCOD, _currency.endword as currencyENDWORD');
			$this->db->from('_cities');
			$this->db->join('_regions', '_cities._regions_rid = _regions.rid');
			$this->db->join('_countries', '_regions._countries_rid = _countries.rid');
			$this->db->join('_currency', '_countries._currency_rid = _currency.rid');
			$this->db->where(array('_cities.rid'=>$cityRID));	
		}
		else if($regionRID)
		{
			$this->db->select('_countries.rid as countryRID, _countries.name as countryNAME,
								_regions.rid as regionRID, _regions.display_name as regionNAME,
								_currency.rid as currencyRID, _currency.name as currencyNAME, 
								_currency.cod as currencyCOD, _currency.endword as currencyENDWORD'); 
			$this->db->from('_regions');
			$this->db->join('_countries', '_regions._countries_rid = _countries.rid');
			$this->db->join('_currency', '_countries._currency_rid = _currency.rid');
			$this->db->where(array('_regions.rid'=>$regionRID));	
		}
		else
		{
			$this->db->select('_countries.rid as countryRID, _countries.name as countryNAME,
								_currency.rid as currencyRID, _currency.name as currencyNAME, 
								_currency.cod as currencyCOD, _currency.endword as currencyENDWORD');
			$this->db->from('_countries');
			$this->db->join('_currency', '_countries._currency_rid = _currency.rid');
			$this->db->where(array('_countries.rid'=>$countryRID));	
		}
		$query = $this->db->get();
		if($query->num_rows()) 
		{
			$addCURRENCY = ($addcurrencyRID)?$this->GetAddCurrency($addcurrencyRID):array();
			$result = $query->row_array();
			return array_merge($result, $addCURRENCY);
		}
		return false;
	}
	
	public function GetAddCurrency($currencyRID)
	{
		$this->db->select('_currency.rid as addcurrencyRID, 
							_currency.cod as addcurrencyCOD, 
							_currency.name as addcurrencyNAME, _currency.endword as addcurrencyENDWORD');
		$this->db->from('_currency');
		$this->db->where(array('_currency.rid'=>$currencyRID));
		$query = $this->db->get();
		if($query->num_rows()) 
		{
			return $query->row_array();
		}
		return false;
	}
	
	public function GetOfficialCources($countryRID)
	{
		$this->db->select('_officialcources.courcedate as courceDATE, 
							_officialcources.cource as courceRATE, 
							_currency.cod as currencyCOD');
		$this->db->from('_officialcources');
		$this->db->join('_currency', '_officialcources._currency_rid = _currency.rid');
		$this->db->where(array('_officialcources._countries_rid'=>$countryRID, 
								'_officialcources.archive'=>'0'));
		$this->db->where("courcedate=(SELECT max(courcedate) from _officialcources where _officialcources._countries_rid='".$countryRID."')");
		$this->db->orderby('_currency.name ASC');
		$query = $this->db->get();
		if($query->num_rows()) 
		{
			return $query->result_array();
		}
		return false;
	}
	
	public function GetCountriesList()
	{
		$this->db->select('*');
		$this->db->from('_countries');
		$this->db->where(array('archive'=>'0'));
		$this->db->orderby('name ASC');
		$query = $this->db->get();
		if($query->num_rows()) 
		{
			//var_dump($query->result_array());
			return $query->result_array();
		}
		return false;
	}

	public function GetCurrenciesList()
	{
		$this->db->select('*');
		$this->db->from('_currency');
		$this->db->where(array('archive'=>'0'));
		$this->db->orderby('name ASC');
		$query = $this->db->get();
		if($query->num_rows()) 
		{
			return $query->result_array();
		}
		return false;
	}

	public function GetRegionsList($countryRID)
	{
		$this->db->select('*');
		$this->db->from('_regions');
		$this->db->where(array('archive'=>'0', '_countries_rid'=>$countryRID));
		$this->db->orderby('name ASC');
		$query = $this->db->get();
		if($query->num_rows()) 
		{
			return $query->result_array();
		}
		return false;
	}

	public function GetCitiesList($regionRID)
	{
		$this->db->select('*');
		$this->db->from('_cities');
		$this->db->where(array('archive'=>'0', '_regions_rid'=>$regionRID));
		$this->db->orderby('name ASC');
		$query = $this->db->get();
		if($query->num_rows()) 
		{
			return $query->result_array();
		}
		return false;
	}
	
}
?>