<?php
/*
 * Contacts Model
 */
class Contacts_model extends Model
{
	public function __construct()
	{
		parent::Model();
		$this->db->query("SET NAMES 'utf8'"); 	
	}
	
	public function SetUserFindedError($insertArr)
	{
		$this->db->insert('_uerrors', $insertArr);
		return;
	}
	
	public function SetUserSendMessage($insertArr)
	{
		$this->db->insert('_ucallbacks', $insertArr);
		return;
	}
}
?>