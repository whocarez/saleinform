<?php

/**
 * RecordRow class - RecordRow is the class that contains FieldControls
 *
 * @package BizView
 */
class RecordRow extends MetaIterator implements iUIControl
{
   protected $m_SortedControlKeys;

   public function SetMode($mode, $dataFormat)
   {
      foreach ($this->m_var as $ctrl)
         $ctrl->SetMode($mode, $dataFormat);
   }

   /**
    * RecordRow::GetSortControlKeys() - Get sorted contorl keys, the sort order is defined in metadata file
    *
    * @return array - sorted key array
    */
   public function GetSortControlKeys()
   {
      if ($this->m_SortedControlKeys)
         return $this->m_SortedControlKeys;
      foreach($this->m_var as $key=>$ctrl)
      {
         if ($ctrl->m_Order)
            $keyOrder[$key] = $ctrl->m_Order;
         else
            $keyNoOrder[] = $key;
      }
      if($keyOrder) {
         asort($keyOrder);
         if ($keyNoOrder)
            $this->m_SortedControlKeys = array_merge($keyNoOrder, array_keys($keyOrder));
         else
            $this->m_SortedControlKeys = array_keys($keyOrder);
      }
      else
         $this->m_SortedControlKeys = $keyNoOrder;
      return $this->m_SortedControlKeys;
   }
   /**
    * RecordRow::SetRecordArr() - assign the record array to RecordRow object. It is usually called before calling its render method.
    *
    * @param array - record array
    * @return void
    */
   public function SetRecordArr(&$recArr)
   {
      foreach ($this->m_var as $fldCtrl) {
         if (!$recArr)
            $fldCtrl->SetValue("");
         else if (key_exists($fldCtrl->m_BizFieldName,$recArr))
            $fldCtrl->SetValue($recArr[$fldCtrl->m_BizFieldName]);
      }
   }
   public function GetDefaultRecordArr()
   {
      foreach ($this->m_var as $fldCtrl) {
         $recArr[$fldCtrl->m_BizFieldName] = $fldCtrl->GetDefaultValue();
      }
      return $recArr;
   }
   public function GetControlByField($fieldName)
   {
      foreach ($this->m_var as $fldCtrl) {
         if ($fldCtrl->m_BizFieldName == $fieldName)
            return $fldCtrl;
      }
      return null;
   }
   /**
    * RecordRow::Render() - Render the record row with thml text. It is usually called after calling its SetRecordArr method.
    *
    * @return string - html text
    */
   public function Render()
   {
      $values = array();
      $keylist = $this->GetSortControlKeys();
      foreach ($keylist as $key) {
         $fldCtrl = $this->m_var[$key];
         if (!$fldCtrl->CanDisplayed())
            continue;
         $values[$key] = $fldCtrl->Render();
      }
      return $values;
   }
   /**
    * RecordRow::RenderColumn() - Render the current record display name (header of a html table)
    *
    * @return array - display name of all fieldcontrols
    */
   public function RenderColumn()
   {
      $values = array();
      foreach ($this->GetSortControlKeys() as $key) {
         $fldCtrl = $this->m_var[$key];
         if (!$fldCtrl->CanDisplayed())
            continue;
         $colname = $fldCtrl->RenderHeader();
         if ($colname)
            $values[$key] = $colname;
      }
      return $values;
   }
   
   /**
    * RecordRow::RenderColumnStyle() - get the style properties of displayed columns 
    *
    * @return array - css of all columns
    */  
   public function RenderColumnStyle()
   {
	  $style = array();
      $keylist = $this->GetSortControlKeys();
      foreach ($keylist as $key) {
         $fldCtrl = $this->m_var[$key];
          if (!$fldCtrl->CanDisplayed())
            continue;
         $values[$key] = $fldCtrl->m_ColumnStyle;
      }
	  return $values;     
   }
}
?>