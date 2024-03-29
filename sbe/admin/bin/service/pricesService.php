<?php
include_once('../bin/service/helpers/price_helper.inc');
class pricesService
{
	private $m_ERRORS = '';
	private $m_ERROR_status = 'OK';
	private $m_CLIENTS_LIST = array();
	public function runService()
	{
		global $g_BizSystem;
		$clientsQUAN = 0;
		$offersQUAN = 0;
		$now = date('Y-m-d H:i:s');
		$sql = "SELECT _clients.*, _countries.rid as _countries_rid,
				max(_prloadsorganizer.next_load) as last_load  
				from _clients
				JOIN _cities ON _cities.rid = _clients._cities_rid
				JOIN _regions ON _regions.rid = _cities._regions_rid
				JOIN _countries ON _countries.rid = _regions._countries_rid
				LEFT JOIN _prloadsorganizer ON _clients.rid=_prloadsorganizer._clients_rid  
				WHERE _clients.pr_url<>'' AND _clients.archive=0 AND _clients.pr_load=1 AND _clients.active=1
				GROUP BY _clients.rid
				ORDER BY _prloadsorganizer.next_load, _countries.rid
				";
		$db = $g_BizSystem->GetDBConnection();
		$recObj = $db->query($sql);
		$recObj->setFetchMode(PDO::FETCH_BOTH);
		$recArr = $recObj->fetchAll();
		$clientsArrForLoad = array();
		foreach($recArr as $row)
		{
			//if($row['_countries_rid'] != '5') continue;
		  	if(!$row['last_load'] || $row['last_load']<$now) $clientsArrForLoad[] = $row;
		}
		if(!$clientsArrForLoad) return;
		$currNum = 1;
		$quan = count($clientsArrForLoad);	
		foreach($clientsArrForLoad as $rec)
		{
			/* { Load price */
			BizSystem::log(LOG_DEBUG, "PRICELOADER", "PriceLoader Info = Start load price: {$rec['name']}. {$currNum} FROM {$quan}\n");
			$priceOBJ = new PriceXML($rec['rid'], $rec['pr_url']);
			$loadStatus = $priceOBJ->LoadPrice();
			if($loadStatus){
				//$stmt = $db->prepare("CREATE TEMPORARY TABLE temp_pritems (SELECT name FROM _pritems WHERE _clients_rid = :_clients_rid)");
				//$stmt->bindParam(':_clients_rid', $rec['rid']);
				//$stmt->execute();
				//$stmt = $db->prepare("SELECT SFE_GetPrItemsWaresRid(name) FROM temp_pritems");
				//$stmt->execute();
				//$stmt = $db->prepare("DROP TABLE temp_pritems");
				//$stmt->execute();
			}
			$stmt = $db->prepare("INSERT INTO _prloadsorganizer(_clients_rid, load_time, next_load, wares_quan, error_status, descr)
									values(:_clients_rid, NOW(), ADDDATE(NOW(), :pr_actual_days), :wares_quan, :error_status, :descr)");
			$stmt->bindParam(':_clients_rid', $rec['rid']);
			$stmt->bindParam(':pr_actual_days', $rec['pr_actual_days']);
			$stmt->bindParam(':wares_quan', $priceOBJ->LOADS_quan);
			$stmt->bindParam(':error_status', $t = $loadStatus?0:1);
			$stmt->bindParam(':descr', $priceOBJ->ERROR_content);
			//echo $priceOBJ->ERROR_content;
			$stmt->execute();
			BizSystem::log(LOG_DEBUG, "PRICELOADER", "PriceLoader Info = Complete load price: {$rec['name']}. {$currNum} FROM {$quan}\n");
			$currNum++;
		}
	}
}
?>