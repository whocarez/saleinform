<?php
/*
 * Contacts Model
 */
class Contacts_model extends Model
{
	public function __construct()
	{
		parent::Model();
		 	
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