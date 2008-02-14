<?php

class DataRecord implements Iterator, ArrayAccess
{
   protected $m_var = array();
   protected $m_var_old = array();
   
   public function __construct($recArray)
   {
      $this->m_var = $recArray;
      $this->m_var_old = $recArray;
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
   
   public function __get($field)
   {
      return $this->get($field);
   }
   
   public function __set($field, $value)
   {
      $this->set($field, $value);
   }
   
   // save record - call BizDataObj UpdateRecord method
   public function Save()
   {
      
   }
   
   // delete record - call BizDataObj DeleteRecord method
   public function Delete()
   {
      
   }
   
   public function toArray()
   {
      
   }
   
}
?>