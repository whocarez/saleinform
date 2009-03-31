<?php
/*
 * Filters Model
 */
class Filters_model extends Model
{
	public function __construct()
	{
		parent::Model();
		 		
	}
	
	public function GetCatManualFilters($catRID)
	{
		$this->db->select('_pars.rid, _pars.name, _parsfilters.item, _parsfilters.regular_expr, _catpars.ptype');
		$this->db->from('_catpars');
		$this->db->join('_pars', '_catpars._pars_rid=_pars.rid');
		$this->db->join('_parsfilters', '_parsfilters._catpars_rid=_catpars.rid AND _parsfilters.archive=0');
		$this->db->where(array('_catpars._categories_rid'=>$catRID, 
								'_catpars.filtered'=>1, 
								'_catpars.archive'=>0, 
								'_pars.archive'=>0));
		// MAZVV 05-07-07 Добавил разграничение по типам параметров
		//$this->db->where(array('_catpars.ptype'=>'WARE')); 
		//$this->db->groupby('_parsfilters.item');
		$this->db->orderby('_pars.name, _parsfilters.item');
		$query = $this->db->get();
		if($query->num_rows()) return $query->result_array();
		return false;
	}
	
	public function GetCatItemsFilters($catRID, $parsARR)
	{
		$countriesRID = $parsARR['c_cn'];
		$cititesRID = $parsARR['c_ct'];
		$regionsRID = $parsARR['c_rg'];
		$this->db->select('_pars.rid, _pars.name, _pritemspars.value, _catpars.ptype');
		$this->db->from('_catpars');
		$this->db->join('_pars', '_catpars._pars_rid=_pars.rid');
		$this->db->join('_pritems', '_pritems._categories_rid = _catpars._categories_rid');
		$this->db->join('_clients', '_pritems._clients_rid=_clients.rid AND _clients.archive=0');
		if($cititesRID)
		{
			$this->db->where(array('_clients._cities_rid'=>$cititesRID));
		}
		else if(!$cititesRID && $regionsRID)
		{
			$this->db->join('_cities', '_cities.rid=_clients._cities_rid AND _cities.archive=0');
			$this->db->join('_regions', "_regions.rid=_cities._regions_rid AND _regions.rid='$regionsRID'");
		}
		else
		{
			$this->db->join('_cities', '_cities.rid=_clients._cities_rid  AND _cities.archive=0');
			$this->db->join('_regions', '_regions.rid=_cities._regions_rid  AND _regions.archive=0');
			$this->db->join('_countries', "_countries.rid=_regions._countries_rid AND _countries.rid='$countriesRID' AND _countries.archive=0");
		}
		$this->db->join('_pritemspars', '_pritemspars._pritems_rid=_pritems.rid AND _pritemspars._pars_rid = _catpars._pars_rid');
		$this->db->where(array('_catpars._categories_rid'=>$catRID, 
								'_catpars.filtered'=>1, 
								'_catpars.archive'=>0, 
								'_pritems.archive'=>0, 
								'_pritemspars.archive'=>0,
								'_pars.archive'=>0));
		// MAZVV 05-07-07 Добавил разграничение по типам параметров
		# { MAZVV 09-02-08 если указан клиент то выводить лишь его параметры
		if($parsARR['cl']) $this->db->where(array('_clients_rid'=>$parsARR['cl']));
		# } MAZVV 09-02-08
		$this->db->where(array('_catpars.ptype'=>'ITEM')); 
		$this->db->groupby('_pritemspars.value');
		$this->db->orderby('_pars.name, _pritemspars.value');
		$query = $this->db->get();
		if($query->num_rows()) return $query->result_array();
		return false;
	}
	
	public function GetCatBrands($catRID, $parsARR)
	{
		$countriesRID = $parsARR['c_cn'];
		$cititesRID = $parsARR['c_ct'];
		$regionsRID = $parsARR['c_rg'];
		$this->db->select('_brands.rid, _brands.name, count(_brands.rid) as itemsCOUNT');
		$this->db->from('_pritems');
		$this->db->join('_brands', '_pritems._brands_rid=_brands.rid AND _brands.archive=0');
		$this->db->join('_clients', '_pritems._clients_rid=_clients.rid AND _clients.archive=0');
		if($cititesRID)
		{
			$this->db->where(array('_clients._cities_rid'=>$cititesRID));
		}
		else if(!$cititesRID && $regionsRID)
		{
			$this->db->join('_cities', '_cities.rid=_clients._cities_rid AND _cities.archive=0');
			$this->db->join('_regions', "_regions.rid=_cities._regions_rid AND _regions.rid='$regionsRID'");
		}
		else
		{
			$this->db->join('_cities', '_cities.rid=_clients._cities_rid  AND _cities.archive=0');
			$this->db->join('_regions', '_regions.rid=_cities._regions_rid  AND _regions.archive=0');
			$this->db->join('_countries', "_countries.rid=_regions._countries_rid AND _countries.rid='$countriesRID' AND _countries.archive=0");
		}
		
		$this->db->where(array('_pritems._categories_rid'=>$catRID, 
								'_pritems.archive'=>0, 
								'_brands.archive'=>0));
		if($parsARR['cl']) $this->db->where(array('_clients_rid'=>$parsARR['cl']));
		$this->db->groupby('_pritems._brands_rid');
		#$this->db->orderby('_brands.name');
		$this->db->orderby('itemsCOUNT DESC');
		$query = $this->db->get();
		if($query->num_rows()) return $query->result_array();
		return false;
	}
	
	public function GetCatFilters($catRID, $parsARR)
	{
		$countriesRID = $parsARR['c_cn'];
		$cititesRID = $parsARR['c_ct'];
		$regionsRID = $parsARR['c_rg'];
		$this->db->select('_pars.rid, _pars.name as parNAME, _parsfilters.rid as filterRID, _parsfilters.item as filterNAME, count(_parsfilters.item) as filterCOUNT, _catpars.ptype');
		$this->db->from('_pritems');
		$this->db->join('_wares', "_wares.rid=_pritems._wares_rid  AND _wares.archive='0'");
		$this->db->join('_brands', "_brands.rid=_wares._brands_rid  AND _brands.archive='0'");
		$this->db->join('_warespars', "_wares.rid=_warespars._wares_rid  AND _warespars.archive='0'");
		$this->db->join('_pars', "_pars.rid=_warespars._pars_rid  AND _pars.archive='0'");
		$this->db->join('_catpars', "_pars.rid=_catpars._pars_rid  AND _catpars.archive='0' AND _catpars.filtered='1'");
		$this->db->join('_parsfilters', "_catpars.rid=_parsfilters._catpars_rid  AND _parsfilters.archive='0'");
		$this->db->join('_parsvalues', "_parsfilters.rid=_parsvalues._parsfilters_rid  AND _parsvalues.archive='0' AND _warespars.value LIKE CONCAT(_parsvalues.value)");
		$this->db->join('_clients', '_pritems._clients_rid=_clients.rid AND _clients.archive=0');
		if($cititesRID)
		{
			$this->db->where(array('_clients._cities_rid'=>$cititesRID));
		}
		else if(!$cititesRID && $regionsRID)
		{
			$this->db->join('_cities', '_cities.rid=_clients._cities_rid AND _cities.archive=0');
			$this->db->join('_regions', "_regions.rid=_cities._regions_rid AND _regions.rid='$regionsRID'");
		}
		else
		{
			$this->db->join('_cities', '_cities.rid=_clients._cities_rid  AND _cities.archive=0');
			$this->db->join('_regions', '_regions.rid=_cities._regions_rid  AND _regions.archive=0');
			$this->db->join('_countries', "_countries.rid=_regions._countries_rid AND _countries.rid='$countriesRID' AND _countries.archive=0");
		}
		$this->db->where(array('_catpars._categories_rid'=>$catRID, '_pritems.archive'=>0, '_pritems._categories_rid'=>$catRID));
		if($parsARR['b']) $this->db->where(array('_brands.rid'=>$parsARR['b'])); 		
		if($parsARR['cl']) $this->db->where(array('_clients_rid'=>$parsARR['cl']));
		# { MAZVV 09-02-08 Сделал правильный подсчет по параметрам
		/*
		if(@$parsARR['cf_']){
			foreach($parsARR['cf_'] as $parRID=>$filterRIDS){
				foreach(explode('-', $filterRIDS) as $filterRID){
					$this->db->where("_wares.rid in (select _wares.rid from _wares
										JOIN _warespars ON _wares.rid=_warespars._wares_rid AND _warespars.archive='0' 
										JOIN _pars ON _pars.rid=_warespars._pars_rid AND _pars.archive='0' 
										JOIN _catpars ON _pars.rid=_catpars._pars_rid AND _catpars.archive='0' AND _catpars.filtered='1' 
										JOIN _parsfilters ON _catpars.rid=_parsfilters._catpars_rid AND _parsfilters.archive='0'
										JOIN _parsvalues ON _parsfilters.rid=_parsvalues._parsfilters_rid AND _parsvalues.archive='0' AND _warespars.value LIKE CONCAT('%',_parsvalues.value,'%') 
										where  _pars.rid = '{$parRID}' AND _parsfilters.rid = '{$filterRID}')");
				}
			}
		}*/
		# } MAZVV 09-02-08 
		$this->db->groupby('_parsfilters.item');
		$this->db->orderby('_parsfilters.numorder, _parsfilters.item');
		$query = $this->db->get();
		if($query->num_rows()) return $query->result_array();
		return false;
	}
}
?>