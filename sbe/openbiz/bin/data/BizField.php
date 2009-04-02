<?PHP

/**
 * BizField - class BizField is the class of a logic field which mapps to a table column
 *
 * @package BizDataObj
 * @author rocky swen
 * @copyright Copyright (c) 2005
 * @version 1.2
 * @access public
 **/
class BizField extends MetaObject
{
   public $m_BizObjName;
   public $m_Join = null;
   public $m_Column = null;
   public $m_Alias = null;
   public $m_Index;
   public $m_Type = null;
   public $m_Format = null;
   public $m_Length = null;
   public $m_ValueExpression = null;// support expression
   public $m_Required = null;       // support expression
   public $m_Validator = null;      // support expression
   public $m_SqlExpression = null;  // support expression
   public $m_DefaultValue = null;
   public $m_ValueOnCreate = null;
   public $m_ValueOnUpdate = null;
   public $m_OnAudit = false;

   public $m_Value = null; // the real value of the field, not from metadata
   public $m_OldValue = null; // the old value of the field

   /**
    * Initialize BizField with xml array
    *
    * @param array $xmlArr xml array
    * @param BizDataObj $bizObj BizDataObj instance
    * @return void
    */
   function __construct(&$xmlArr, $bizObj)
   {
      $this->m_Name = isset($xmlArr["ATTRIBUTES"]["NAME"]) ? $xmlArr["ATTRIBUTES"]["NAME"] : null;
      $this->m_BizObjName = $bizObj->m_Name;
      $this->m_Package = $bizObj->m_Package;
      $this->m_Join = isset($xmlArr["ATTRIBUTES"]["JOIN"]) ? $xmlArr["ATTRIBUTES"]["JOIN"] : null;
      $this->m_Column = isset($xmlArr["ATTRIBUTES"]["COLUMN"]) ? $xmlArr["ATTRIBUTES"]["COLUMN"] : null;
      $this->m_Alias = isset($xmlArr["ATTRIBUTES"]["ALIAS"]) ? $xmlArr["ATTRIBUTES"]["ALIAS"] : null;
      $this->m_ValueExpression = isset($xmlArr["ATTRIBUTES"]["VALUE"]) ? $xmlArr["ATTRIBUTES"]["VALUE"] : null;
      $this->m_DefaultValue = isset($xmlArr["ATTRIBUTES"]["DEFAULTVALUE"]) ? $xmlArr["ATTRIBUTES"]["DEFAULTVALUE"] : null;
      $this->m_Type = isset($xmlArr["ATTRIBUTES"]["TYPE"]) ? $xmlArr["ATTRIBUTES"]["TYPE"] : null;
      $this->m_Format = isset($xmlArr["ATTRIBUTES"]["FORMAT"]) ? $xmlArr["ATTRIBUTES"]["FORMAT"] : null;
      $this->m_Length = isset($xmlArr["ATTRIBUTES"]["LENGTH"]) ? $xmlArr["ATTRIBUTES"]["LENGTH"] : null;
      $this->m_Required = isset($xmlArr["ATTRIBUTES"]["REQUIRED"]) ? $xmlArr["ATTRIBUTES"]["REQUIRED"] : null;
      $this->m_Validator = isset($xmlArr["ATTRIBUTES"]["VALIDATOR"]) ? $xmlArr["ATTRIBUTES"]["VALIDATOR"] : null;
      $this->m_SqlExpression = isset($xmlArr["ATTRIBUTES"]["SQLEXPR"]) ? $xmlArr["ATTRIBUTES"]["SQLEXPR"] : null;
      $this->m_ValueOnCreate = isset($xmlArr["ATTRIBUTES"]["VALUEONCREATE"]) ? $xmlArr["ATTRIBUTES"]["VALUEONCREATE"] : null;
      $this->m_ValueOnUpdate = isset($xmlArr["ATTRIBUTES"]["VALUEONUPDATE"]) ? $xmlArr["ATTRIBUTES"]["VALUEONUPDATE"] : null;
      if (isset($xmlArr["ATTRIBUTES"]["ONAUDIT"]) && $xmlArr["ATTRIBUTES"]["ONAUDIT"]=='Y')
         $this->m_OnAudit = true;

      $this->m_BizObjName = $this->PrefixPackage($this->m_BizObjName);

      if (!$this->m_Format) $this->UseDefaultFormat();
   }

   /**
    * Use default format if no format is given
    * @return void
    */
   protected function UseDefaultFormat()
   {
      if ($this->m_Type == "Date")  $this->m_Format = '%Y-%m-%d';
      else if ($this->m_Type == "Datetime")  $this->m_Format = '%Y-%m-%d %H:%M:%S';
   }

   /**
    * Get property value
    * @param string $propertyName property name
    * @return string property value
    */
   public function GetProperty($propertyName)
	{
	   $ret = parent::GetProperty($propertyName);
	   if ($ret) return $ret;
	   if ($propertyName == "Value") return $this->GetValue();
	   return $this->$propertyName;
	}

	/**
	 * Change the BizDataObj name. This function is used in case of the current BizDataObj 
	 * inheriting from another BizDataObj, BizField's BizDataObj name should be changed to 
	 * current BizDataObj name, not the parent object name.
	 * @param string $bizObjName the name of BizDataObj obejct
	 * @return void
	 */
	public function AdjustBizObjName($bizObjName)
	{
	   if ($this->m_BizObjName != $bizObjName)
         $this->m_BizObjName = $bizObjName;
	}

	/**
	 * Get string used in sql - with single quote, or without single quote in case of number
	 * @param mixed $input the value to add quote. If null, use the current field value
	 * @return string string used in sql
	 */
	public function GetSqlValue($input=null) {
	   $val = ($input!==null) ? $input : $this->m_Value;
	   if ($val === null) {
	      return "";
	   }
	   if ($this->m_Type != 'Number')
	   {
	      if (get_magic_quotes_gpc() == 0) {
              $val = addcslashes($val, "\000\n\r\\'\"\032");
	      }
	      return "'$val'";
	   }

	   return $val;
	}

	/**
	 * Check if the field is a LOB type column
	 * @return boolean true if the field points a LOB type column
	 */
	public function IsLobField() 
	{  
		return ($this->m_Type == 'Blob' || $this->m_Type == 'Clob');
	}
	
	/**
	 * Get insert lob value when execute insert SQL. For a lob column, insert SQL first inserts 
	 * an empty entry in the lob column. Then use update to actually add the lob data. 
	 * @param string $dbType database type
	 * @return string the insert string for the lob column
	 */
	public function GetInsertLobValue($dbType)
	{
	   if ($dbType == 'oracle' || $dbType == 'oci8') {
	      if ($this->m_Type != 'Blob') return 'empty_blob()';
	      if ($this->m_Type != 'Clob') return 'empty_clob()';
	   }
	   return 'null';
	}

   /**
    * BizField::GetValue() - get the value of the field.
    * @param boolean $formatted true if want to get the formatted value
    * @return mixed string or number depending on the field type
    */
   public function GetValue($formatted=true)
   {
      // need to ensure that value are retrieved from source/cache
      //if ($this->GetDataObj()->CheckDataRetrieved() == false)
      $this->GetDataObj()->GetActiveRecord();
      $value = stripcslashes($this->m_Value);

      $value = $this->m_Value;
      if ($this->m_ValueExpression && trim($this->m_Column)=="") {
         $value = Expression::EvaluateExpression($this->m_ValueExpression,$this->GetDataObj());
      }
	  if ($this->m_Format && $formatted) {
         global $g_BizSystem;
         $value = $g_BizSystem->GetTypeManager()->ValueToFormattedString($this->m_Type, $this->m_Format, $value);
      }
	  return $value;
   }

   /**
    * BizField::SetValue() - set the value of the field.
    *
    * @param mixed $val
    * @return void
    */
   public function SetValue($val)
   {
      $this->m_Value = $val;
   }

   /**
    * Save the old value to an internal variable
    * @return void
    */
   public function SaveOldValue()
   {
      $this->m_OldValue = $this->m_Value;
   }

   /**
    * Get default value
    * @return string the default value of the field
    */
   public function GetDefaultValue()
   {
      if($this->m_DefaultValue!==null)
         return Expression::EvaluateExpression($this->m_DefaultValue, $this->GetDataObj());
      return "";
   }
   
   /**
    * Get the value when a new record is created
    * @return string the value of the field
    */
   public function GetValueOnCreate()
   {
   	  if($this->m_ValueOnCreate!==null)
         return $this->GetSqlValue(Expression::EvaluateExpression($this->m_ValueOnCreate, $this->GetDataObj()));
      return "";
   }

   /**
    * Get the value when a record is updated
    * @return string the value of the field
    */
   public function GetValueOnUpdate()
   {
   	  if($this->m_ValueOnUpdate!==null)
         return $this->GetSqlValue(Expression::EvaluateExpression($this->m_ValueOnUpdate, $this->GetDataObj()));
      return "";
   }
   
   /**
    * Get the data object instance
    * @return BizDataObj BizDataObj instance
    */
   protected function GetDataObj()
   {
      global $g_BizSystem;
	   return $g_BizSystem->GetObjectFactory()->GetObject($this->m_BizObjName);
   }

   /**
    * BizField::CheckRequired() - check if the field is a required field
    *
    * @return boolean true if the field is a required field
    */
   public function CheckRequired()
   {
      if (!$this->m_Required || $this->m_Required == "")
         return false;
      else if ($this->m_Required == "Y")
         $required = true;
      else if($required != "N")
         $required = false;
      else
         $required = Expression::EvaluateExpression($this->m_Required, $this->GetDataObj());

      return $required;
   }

   /**
    * BizField::Validate() - check if the field has valid value
    *
    * @return boolean true if validation is good
    */
   public function Validate()
   {
      $ret = true;
      if ($this->m_Validator)
         $ret = Expression::EvaluateExpression($this->m_Validator, $this->GetDataObj());
      return $ret;
   }

}

?>
