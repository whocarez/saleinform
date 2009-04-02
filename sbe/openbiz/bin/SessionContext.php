<?PHP
/**
 * SessionContext class - Session management class that has additional methods to save/get 
 * session variables of metadata based stateful objects through their GetSessionVars|SetSessionVars interfaces
 * 
 * @package BizSystem
 * @author rocky swen 
 * @copyright Copyright (c) 2005
 * @access public 
 */
 
 /**
  * Index of $_SESSION array that saves all information regarding statefull objects
  */
 define('OB_STATEFULL_DATA_SESSION_INDEX', 'ob_statefull_data');
 
 
class SessionContext
{
   protected $m_LastAccessTime;
   protected $m_Timeout = false;
   protected $m_SessObjArr = null;
   protected $m_SessObjFileName = null;
   protected $m_ViewHistory = null;
   protected $m_PrevViewObjNames = array();
   
   /**
    * SessionContext::__construct - Constructor of SessionContext, init session and set session file path
    * 
    * @return void
    **/
	function __construct()
	{
	   if (defined('SESSION_PATH'))
	     session_save_path(SESSION_PATH);

	   if(is_writable(session_save_path())) {
	   	   session_start();
	   } else {
	   	   // we cannot write in the session save path; aborting
	   	   die("Unable to write in the session save path [".session_save_path()."]");
	   }
	   
	   // retrieve objects data
	   if (defined('SESSION_PATH'))
	     $this->m_SessObjFileName = SESSION_PATH."/".session_id()."_obj";
	   
	   // record access time
	   $curTime = time();
	   if (isset($_SESSION["LastAccessTime"]))
	      $this->m_LastAccessTime = $_SESSION["LastAccessTime"];
	   else
	      $this->m_LastAccessTime = $curTime;
      $_SESSION["LastAccessTime"] =$curTime;
      
      // see if timeout
      $this->m_Timeout = false;
      if ((TIMEOUT > 0) && (($curTime - $this->m_LastAccessTime) > TIMEOUT))
         $this->m_Timeout = true;
	}
	
	/**
    * SessionContext::SetVar - set single session variable
    * 
    * @param string $varName
    * @param mixed $value
    * @return void
    **/
	public function SetVar($varName, $value)
	{
      $_SESSION[$varName] = $value;
	}
	/**
    * SessionContext::GetVar - get single session variable
    * 
    * @param string $varName
    * @return string 
    **/
	public function GetVar($varName)
	{
      if (!isset($_SESSION[$varName]))
         return "";
      return $_SESSION[$varName];
	}
	/**
    * SessionContext::ClearVar - unset single session variable
    * 
    * @param string $varName
    * @return void 
    **/
	public function ClearVar($varName)
	{
	   unset($_SESSION[$varName]);
	}
	
	/**
	 * SessionContext::ExistVarInSession
	 * @param string $varName
	 * @return boolean true if the var exists in the session otherwise false
	 **/
	public function VarExists ($varName){ 
       $exists =  (array_key_exists($varName, $_SESSION)) ? TRUE : FALSE;	   
	   return $exists;
	}	
	
	/**
    * SessionContext::SetObjVar - set single session variable of a statefulobject
    * 
    * @param string $objName - object name
    * @param string $varName - vaiable name
    * @param mixed $value - reference of the value (in/out)
    * @return void
    **/
	public function SetObjVar($objName, $varName, &$value)
	{
	   $this->m_SessObjArr[$objName][$varName] = $value;
	}

	/**
    * SessionContext::GetObjVar - get single session variable of a stateful object
    * 
    * @param string $objName - object name
    * @param string $varName - vaiable name
    * @param mixed $value - reference of the value (in/out)
    * @return void
    **/
	public function GetObjVar($objName, $varName, &$value)
	{
	   if (!$this->m_SessObjArr) 
	      return;
	   if (isset($this->m_SessObjArr[$objName][$varName]))
	   {
	      $value = $this->m_SessObjArr[$objName][$varName];
	   }
	}
	
	/**
	 * function that saves in session all the statefull information
	 * This function removes the need of an external file
	 */
	private function _SaveSessionData($session_data) {
		if (!is_array($session_data)) {
			$session_data = array();
		} else {
			// If it's array then don't touch it
		}
		
		$ob_statefull_data = $this->getVar(OB_STATEFULL_DATA_SESSION_INDEX);
		
		if (!is_array($ob_statefull_data)) {
			$ob_statefull_data = array();
		}
	
		$ob_statefull_data = array_merge($ob_statefull_data, $session_data);
		return $this->setVar(OB_STATEFULL_DATA_SESSION_INDEX, $ob_statefull_data);
	}
	
	/**
    * SessionContext::SaveSessionObjects - save session variables of all stateful objects into sessionid_obj file
    * 
    * @return void
    **/
	public function SaveSessionObjects()
	{
	   if ($this->m_SessObjFileName == null)
	      return;

	   global $g_BizSystem;
	   // loop all objects (bizview, bizform, bizdataobj) collect their session vars
	   $allobjs = $g_BizSystem->GetObjectFactory()->GetAllObjects();
	   foreach ($allobjs as $obj) {
	      if (method_exists($obj, "SetSessionVars"))
	        $obj->SetSessionVars($this);
	      // if previous view's object is used in current view, don't discard its session data
	      if (key_exists($obj->m_Name, $this->m_PrevViewObjNames))
	        unset($this->m_PrevViewObjNames[$obj->m_Name]);
	   }
	   
	   // discard useless previous view's session objects
      foreach($this->m_PrevViewObjNames as $objName=>$tmp)
         unset($this->m_SessObjArr[$objName]);
	   
	   $this->m_SessObjArr["ViewHist"] = $this->m_ViewHistory;
	   
	   return $this->_SaveSessionData($this->m_SessObjArr);
	}
	
	/**
    * SessionContext::RetrieveSessionObjects - get session variables of all stateful objects from sessionid_obj file
    * 
    * @return void
    **/
   public function RetrieveSessionObjects()
	{
		global $g_BizSystem;
		
		$this->m_SessObjArr = $this->getVar(OB_STATEFULL_DATA_SESSION_INDEX);
		
		if (!is_array($this->m_SessObjArr)) {
			$this->m_SessObjArr = array();
		} else {
			 // don't touch SessObjArr
		}
		$this->m_ViewHistory = array_key_exists('ViewHist', $this->m_SessObjArr)
									? $this->m_SessObjArr["ViewHist"]
									: NULL;
		return TRUE;
	}
	
	/**
    * SessionContext::ClearSessionObjects - clear session variables of all stateful objects
    * 
    * @return void
    **/
	public function ClearSessionObjects($keepObjects = false)
	{
	   if ($keepObjects == false)
	   {
	      unset($this->m_SessObjArr);
	      $this->m_SessObjArr = array();
	   }
	   else // add previous view's session object names in to a map
	   {
	      if (isset($this->m_SessObjArr))
	      {
	         foreach($this->m_SessObjArr as $objName=>$sessobj)
	         {
	            $this->m_PrevViewObjNames[$objName] = 1; 
	         }
	      }
	   }
	}
	
	/**
	 * SessionContext::SaveJSONArray - Save a javascript array in session
	 * @param string $json_value
	 * @param string $json_name
	 * @return void
	 **/
	public function SaveJSONArray($json_value, $json_name = NULL){
		$json_array = json_decode($json_value);

		if((bool)$json_name){ //If I want save all array in session I send the name of the array in session
			$this->SetVar($json_name, $json_array);
		}else{//I save each value in session
			foreach($json_array as $varName=>$value){
				$this->SetVar($varName, $value);
			}
		}
	}
		
	/**
    * SessionContext::GetViewHistory - get view history data of given bizform from saved in session file
    * 
    * @param string $formName - name of bizform
    * @return array - view history data represented by an associated array
    **/
	public function GetViewHistory($formname)
	{
	   global $g_BizSystem;
	   $view = $g_BizSystem->GetCurrentViewName();
	   $view_form = $formname; //$view."_".$formname;
	   return $this->m_ViewHistory[$view_form];
	}
	
	/**
    * SessionContext::SetViewHistory - set view history data of given bizform into session file
    * 
    * @param string $formName - name of bizform
    * @param array $histinfo - view history data represented by an associated array
    * @return void
    **/
	public function SetViewHistory($formname, $histinfo)
	{
	   global $g_BizSystem;
	   $view = $g_BizSystem->GetCurrentViewName();
	   $view_form = $formname; //$view."_".$formname;
	   if (!$histinfo)
	      unset($this->m_ViewHistory[$view_form]);
	   else
	      $this->m_ViewHistory[$view_form] = $histinfo;
	}

	/**
    * SessionContext::Destroy - free all session data of the current session
    * 
    * @return void
    **/
	public function Destroy()
	{
	   unset($this->m_ViewHistory);
      unset($this->m_SessObjArr);
	   
      session_destroy();
	}

	/**
	 * Check if user logged in or not
	 * @return boolean 
	 */
	public function IsUserValid()
	{
	   if (CHECKUSER == "N")
	      return true;
	   if ($this->GetVar("UserId") != "")
	      return true;
	   else
	      return false;
	}

   /**
    * SessionContext::IsTimeout - check if current session is timeout
    * 
    * @return boolean
    **/
	public function IsTimeout()
	{
	   return $this->m_Timeout;
	}

}

?>
