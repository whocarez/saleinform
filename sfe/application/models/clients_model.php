<?php
	public function GetClientOpinions($clientsRID){
	public function GetCltypesList(){
	public function GetCountriesList(){
	public function CheckNewLogin($login){
	
	public function AddClient($insertARR)
	{
		try
		{
			$this->db->insert('_clients', $insertARR);
			$query = $this->db->query('select last_insert_id() as _clients_rid');
			return $query->row_array();
		}
		catch (Exception $e)
		{
			return false;  
		}
		
	}
	
	public function AddUser($insertARR)
	{
		try
		{
			$this->db->insert('_users', $insertARR);
			return true;
		}
		catch(Exception $e)
		{
			return false;
		}
	}
	
	public function getNewestClients($limit = 15, $cltypecode = 'ESHOP'){
		if($letter=='0-9'){
}
?>