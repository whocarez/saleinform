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
		$sql = "SELECT _clients.*, 
				max(_prloadsorganizer.next_load) as last_load  
				from _clients
				LEFT JOIN _prloadsorganizer ON _clients.rid=_prloadsorganizer._clients_rid  
				WHERE _clients.pr_url<>'' AND _clients.archive=0 AND _clients.pr_load=1 AND _clients.active=1
				GROUP BY _clients.rid
				ORDER BY _prloadsorganizer.next_load
				";
		$db = $g_BizSystem->GetDBConnection();
		$recObj = $db->query($sql);
		$recObj->setFetchMode(PDO::FETCH_BOTH);
		$recArr = $recObj->fetchAll();
		$clientsArrForLoad = array();
		foreach($recArr as $row)
		{
		  if(!$row['last_load'] || $row['last_load']<$now) $clientsArrForLoad[] = $row;
		}
		if(!$clientsArrForLoad) return;	
		foreach($clientsArrForLoad as $rec)
		{
			// Закрываем старые предложения от этого клиента
			//$stmt = $db->prepare("UPDATE _pritems SET archive = 1 WHERE _clients_rid = :_clients_rid");
			$stmt = $db->prepare("DELETE FROM _pritems WHERE _clients_rid = :_clients_rid");
			$stmt->bindParam(':_clients_rid', $rec['rid']);
			$stmt->execute();
			//echo $rec['rid'];
			/* { Load price */
			
			$priceOBJ = new PriceXML($rec['rid'], $rec['pr_url']);
			$loadStatus = $priceOBJ->LoadPrice();
			$stmt = $db->prepare("INSERT INTO _prloadsorganizer(_clients_rid, load_time, next_load, wares_quan, error_status, descr)
									values(:_clients_rid, NOW(), ADDDATE(NOW(), :pr_actual_days), :wares_quan, :error_status, :descr)");
			$stmt->bindParam(':_clients_rid', $rec['rid']);
			$stmt->bindParam(':pr_actual_days', $rec['pr_actual_days']);
			$stmt->bindParam(':wares_quan', $priceOBJ->LOADS_quan);
			$stmt->bindParam(':error_status', $t = $loadStatus?0:1);
			$stmt->bindParam(':descr', $priceOBJ->ERROR_content);
			//echo $priceOBJ->ERROR_content;
			$stmt->execute();
		}
	}
}
?>