<?php
/*
 * Accounts Model
 */
class Accounts_model extends Model
{
	private $rootCategoryIndex = 0;
	private $CONST_DEFAULT_COUNTRY_CODE = 'D_CNT';
	public function __construct()
	{
		parent::Model();
	}
	
	public function GetUserInfo($userLOGIN, $userPASSW){
		$this->db->select('*');
		$this->db->from('_members');
		$this->db->where(array('login'=>$userLOGIN, 'password'=>$userPASSW, 'archive'=>'0', 'activate_status'=>'1'));
		$query = $this->db->get();
		if($query->num_rows()) 
		{
			$row = $query->row_array();
			return $row;
		}
		return false;
	}

	public function isUniqueLogin($userNAME){
		$this->db->select('*');
		$this->db->from('_members');
		$this->db->where(array('login'=>$userNAME));
		$query = $this->db->get();
		return $query->num_rows()?False:True;
	}

	public function isUniqueEmail($email){
		$this->db->select('*');
		$this->db->from('_members');
		$this->db->where(array('email'=>$email));
		$query = $this->db->get();
		return $query->num_rows()?False:True;
	}
	
	public function GetUserData($userNAME){
		$this->db->select('*');
		$this->db->from('_members');
		$this->db->where(array('login'=>$userNAME));
		$query = $this->db->get();
		if($query->num_rows()) 
		{
			return $query->row_array();
		}
		return false;
	}
	
	public function addUser($dataArr){
		$this->db->insert('_members', $dataArr);
		return TRUE;
	}
	
	public function ActivateAccount($activateCODE)
	{
		$this->db->select('*');
		$this->db->from('_members');
		$this->db->where(array('activate_code'=>$activateCODE));
		$query = $this->db->get();
		if(!$query->num_rows()) 
		{
			return FALSE;
		}
		$data = array('activate_status'=>'1');
		$this->db->where('activate_code', $activateCODE);
		$this->db->update('_members', $data);
		return TRUE;
	}

	public function SetGeneratedPass($activateCODE, $newPASS)
	{
		$this->db->select('*');
		$this->db->from('_members');
		$this->db->where(array('activate_code'=>$activateCODE));
		$query = $this->db->get();
		if(!$query->num_rows()) 
		{
			return FALSE;
		}
		$data = array('activate_status'=>'1', 'password'=>$newPASS);
		$this->db->where('activate_code', $activateCODE);
		$this->db->update('_members', $data);
		return $query->row_array();
	}
	
	public function UpdateUserPassword($userRID, $newPASS)
	{
		$data = array('password'=>$newPASS);
		$this->db->where('rid', $userRID);
		$this->db->update('_members', $data);
		return;
	}
	
}
?>