<?php
/**
 * DataRecord - class DataRecord is the wrapper class of record array. It is recommmended to be used 
 * in data update and deletion.
 *
 * @package BizDataObj
 * @author rocky swen
 * @copyright Copyright (c) 2007
 * @access public
 **/
class DataRecord implements Iterator, ArrayAccess
{
   protected $m_var = array();
   protected $m_var_old = array();
   protected $m_BizObj = null;
   
   /**
    * Initialize DataRecord with record array.
    * Creat a new record - new DataRecord(null, $bizobj)
    * Get a current record - new DataRecord($recArr, $bizobj)
    *
    * @param array $recArray record array.
    * @param BizDataObj $bizObj BizDataObj instance
    * @return void
    */
   public function __construct($recArray, $bizObj)
   {
      if ($recArray != null && is_array($recArray))
      {
         $this->m_var = $recArray;
         $this->m_var_old = $recArray;
      }
      else
         $this->m_var = $bizObj->NewRecord();
      
      $this->m_BizObj = $bizObj;
   }
   
   // Iterator methods
   public function get($key) { return isset($this->m_var[$key]) ? $this->m_var[$key] : null; }
   public function set($key, $val) { $this->m_var[$key] = $val; }
   public function rewind() { reset($this->m_var);  }
   public function current() { return current($this->m_var); }
   public function key() { return key($this->m_var); }
   public function next() { return next($this->m_var); }
   public function valid() { return $this->current() !== false; }
   // ArrayAccess methods
   public function offsetExists($key) { return isset($this->m_var[$key]); }
   public function offsetGet($key) { return $this->get($key); } 
   public function offsetSet($key, $val) { $this->set($key, $val); } 
   public function offsetUnset($key) { unset($this->m_var[$key]); } 
   
   /**
    * Get field value
    * @param string $field name of a field
    * @return mixed value of the field
    */
   public function __get($field)
   {
      return $this->get($field);
   }
   
   /**
    * Set field value
    * @param string $field name of a field
    * @param mixed value of the field
    * @return avoid
    */
   public function __set($field, $value)
   {
      $this->set($field, $value);
   }
   
   /**
    * Save record. This function calls BizDataObj UpdateRecord method internally
    * @return boolean true for success
    */
   public function Save()
   {
      if (count($this->m_var_old) > 0)
         $ok = $this->m_BizObj->UpdateRecord($this->m_var, $this->m_var_old);
      else 
         $ok = $this->m_BizObj->InsertRecord($this->m_var);
         
      // repopulate current record with bizdataobj activerecord
      if ($ok)
      {
         $this->m_var = $this->m_BizObj->GetActiveRecord();
         $this->m_var_old = $this->m_var;
      }
      
      return $ok;
   }
   
   /**
    * Delete record. This function calls BizDataObj DeleteRecord method internally
    * @return boolean true for success
    */
   public function Delete()
   {
      return $this->m_BizObj->DeleteRecord($this->m_var);
   }
   
   public function GetError()
   {
      return $this->m_BizObj->GetErrorMessage();
   }
   
   /**
    * Return record in array
    * @return array record array
    */
   public function toArray()
   {
      return $this->m_var;
   }
   
   /**
    * Get reference object with given object name
    * @param string $objName name of the object reference
    * @return obejct the instance of reference object
    */
   public function GetRefObject($objName)
   {
      return $this->m_BizObj->GetRefObject($objName);
   }
}
?>