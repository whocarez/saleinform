<?php

/**
 * BizDataObj_SQLHelper class - class BizDataObj_SQLHelper takes care of building sql for BizDataObj
 *
 * @package BizDataObj
 * @author rocky swen
 * @copyright Copyright (c) 2005
 * @access private
 */

class BizDataObj_SQLHelper
{
   private $dataSqlObj = null;
   
   private static $m_Instance = null;

   /**
    * Get the singleton instance
    * @return BizSystem BizSystem object
    */
   public static function instance()
   {
      if (self::$m_Instance == null)
         self::$m_Instance = new BizDataObj_SQLHelper();
      return self::$m_Instance;
   }
   
   protected function GetDataSqlObj()
   {
      if (!$this->dataSqlObj)
         $this->dataSqlObj = new BizDataSql();
      return $this->dataSqlObj;
   }
   
   protected function GetNewDataSqlObj()
   {
      $this->dataSqlObj = null;
      $this->dataSqlObj = new BizDataSql();
      return $this->dataSqlObj;
   }
   
   /**
    * BizDataObj_SQLHelper::BuildQuerySQL() - Build the Select SQL statement based on the fields and search/sort rule
    *
    * @return void
    **/
   public function BuildQuerySQL($dataobj)
   {
      // todo: if no searchrule or sortrule change ...
      // build the SQL statement based on the fields and search rule
      $dataSqlObj = $this->GetNewDataSqlObj();
      // add table
      $dataSqlObj->AddMainTable($dataobj->m_MainTable);
      // add join table
      if ($dataobj->m_TableJoins) {
         foreach($dataobj->m_TableJoins as $tableJoin) {
            $tbl_col = $dataSqlObj->AddJoinTable($tableJoin);
         }
      }
      // add columns
      foreach($dataobj->m_BizRecord as $bizFld) {
         if ($bizFld->m_Column && $bizFld->m_Type == "Blob")   // ignore blob column
            continue;
         if ($bizFld->m_Column && !$bizFld->m_SqlExpression && (strpos($bizFld->m_Column,',') == 0))
            $dataSqlObj->AddTableColumn($bizFld->m_Join, $bizFld->m_Column);
         if ($bizFld->m_SqlExpression) {
            $dataSqlObj->AddSqlExpression($this->ConvertSqlExpression($dataobj, $bizFld->m_SqlExpression),$bizFld->m_Alias);
         }
      }

      $dataSqlObj->ResetSQL();

      // append SearchRule in the WHERE clause
      $sqlSearchRule = $this->RuleToSql($dataobj, $dataobj->m_SearchRule);
      $dataSqlObj->AddSqlWhere($sqlSearchRule);

      // append SearchRule in the ORDER BY clause
      $sqlSortRule = $this->RuleToSql($dataobj, $dataobj->m_SortRule);
      $dataSqlObj->AddOrderBy($sqlSortRule);

      // append SearchRule in the other SQL clause
      $sqlOtherSQLRule = $this->RuleToSql($dataobj, $dataobj->m_OtherSQLRule);
      $dataSqlObj->AddOtherSQL($sqlOtherSQLRule);

      // append SearchRule in the AccessRule clause
      $sqlAccessSQLRule = $this->RuleToSql($dataobj, $dataobj->m_AccessRule);
      $dataSqlObj->AddSqlWhere($sqlAccessSQLRule);

      // add association to SQL
      global $g_BizSystem;
      if ($dataobj->m_Association["AsscObjName"] != "" && $dataobj->m_Association["FieldRefVal"] == "") {
         $asscObj = $g_BizSystem->GetObjectFactory()->GetObject($dataobj->m_Association["AsscObjName"]);
         $dataobj->m_Association["FieldRefVal"] = $asscObj->GetFieldValue($dataobj->m_Association["FieldRef"]);
      }
      $dataSqlObj->AddAssociation($dataobj->m_Association);

      $querySQL = $dataSqlObj->GetSqlStatement() . " ";

      //echo $dataobj->m_QuerySQL."###<br>";
      return $querySQL;
   }
   
      /**
    * BizDataObj::BuildUpdateSQL() - build update sql UPDATE table SET col1=val1, col2=val2 ... WHERE idcol1='id1' AND idcol2='id2'
    *
    * @return void
    **/
   // TODO: consider the record data on main table as well as join table, this function can return a sql array.
   public function BuildUpdateSQL($dataobj)
   {
      // 
      // generate column value pairs. ignore those whose inputValue=fieldValue
      $sqlFlds = $dataobj->m_BizRecord->GetToSaveFields('UPDATE');
      $colval_pairs = null;
      foreach($sqlFlds as $fldobj) {
         $col = $fldobj->m_Column;
         
         if ($fldobj->m_ValueOnUpdate != "") // ignore ValueOnUpdate field first
         	continue;
         
         if ($fldobj->IsLobField())  // take care of blob/clob type later
            continue;
         
         // ignore the column where old value is same as new value; set the column only if new value is diff than the old value
         if ($fldobj->m_OldValue == $fldobj->m_Value)
            continue;

         $_val = $fldobj->GetSqlValue();
         $colval_pairs[$col] = ($_val===null || $_val === '') ? "''" : $_val;
      }
      if ($colval_pairs == null) return false;
      
      // take care value on update fields only
      foreach($sqlFlds as $fldobj) {
         $col = $fldobj->m_Column;
         if ($fldobj->m_ValueOnUpdate != "")
         {
            $_val = $fldobj->GetValueOnUpdate();
            $colval_pairs[$col] = ($_val===null || $_val === '') ? "''" : $_val;
         }
      }
      $sql = "";
      foreach ($colval_pairs as $col=>$val) {
         if ($sql!="") $sql .= ", $col=$val";
         else $sql .= "$col=$val";
      }
      
      $sql = "UPDATE " . $dataobj->m_MainTable . " SET " . $sql;
      
      $whereStr = $dataobj->m_BizRecord->GetKeySearchRule(true, true);  // use old value and column name
      $sql .= " WHERE " . $whereStr;
      return $sql;
   }
   
   //Added by Jixian on 2009-02-16 for implement onSaveDataObj
   public function BuildUpdateSQLforTableJoin($dataobj){
   	  $sqlArray = array();
   	  foreach ($dataobj->m_TableJoins as $tableJoin){      	
      	if ($tableJoin->m_OnSaveDataObj) {          		
      		$rec_join = $dataobj->m_BizRecord->GetJoinInputRecord($tableJoin->m_Name);		      
		      // below are just same as BuildUpdateSQL functions 
		      $colval_pairs = null;
		      foreach($rec_join as $fldobj) {
		         $col = $fldobj->m_Column;
		         
		         if ($fldobj->m_ValueOnUpdate != "") // ignore ValueOnUpdate field first
		         	continue;
		         
		         if ($fldobj->IsLobField())  // take care of blob/clob type later
		            continue;
		         
		         // ignore the column where old value is same as new value; set the column only if new value is diff than the old value
		         if ($fldobj->m_OldValue == $fldobj->m_Value)
		            continue;
		
		         $_val = $fldobj->GetSqlValue();
		         $colval_pairs[$col] = ($_val===null || $_val === '') ? "''" : $_val;
		      }
		      if ($colval_pairs == null) continue;    
		      
		      foreach($rec_join as $fldobj) {
		         $col = $fldobj->m_Column;
		         if ($fldobj->m_ValueOnUpdate != "")
		         {
		            $_val = $fldobj->GetValueOnUpdate();
		            $colval_pairs[$col] = ($_val===null || $_val === '') ? "''" : $_val;
		         }
		      }
		      $sql = "";
		      foreach ($colval_pairs as $col=>$val) {
		         if ($sql!="") $sql .= ", $col=$val";
		         else $sql .= "$col=$val";
		      }
		      
		      $sql = "UPDATE " . $tableJoin->m_Table . " SET " . $sql;		
		      $whereStr = $dataobj->m_BizRecord->GetJoinSearchRule($tableJoin, true);  // use old value 
      		  $sql .= " WHERE " .  $whereStr;
      		  $sqlArray[] = $sql;        		
      	}      	
      }
      return $sqlArray;
   } 

   /**
    * BizDataObj::BuildDeleteSQL() - build delete sql DELETE FROM table WHERE idcol1='id1' AND idcol2='id2'
    *
    * @return void
    **/
   public function BuildDeleteSQL($dataobj)
   {
      $sql = "DELETE FROM " . $dataobj->m_MainTable;
      $whereStr = $dataobj->m_BizRecord->GetKeySearchRule(false, true);  // use cur value and column name
      $sql .= " WHERE " . $whereStr;
      return $sql;
   }
   
   //Added by Jixian on 2009-02-16 for implement onSaveDataObj
   public function BuildDeleteSQLforTableJoin($dataobj){
      $sqlArray = array();
   	  foreach ($dataobj->m_TableJoins as $tableJoin){      	
      	if ($tableJoin->m_OnSaveDataObj) {          		
      		  $rec_join = $dataobj->m_BizRecord->GetJoinInputRecord($tableJoin->m_Name);
      		  $sql = "DELETE FROM " . $tableJoin->m_Table ;		
		      $whereStr = $dataobj->m_BizRecord->GetJoinSearchRule($tableJoin, false);  // use value 
      		  $sql .= " WHERE " .  $whereStr;
      		  $sqlArray[] = $sql;        		
      	}      	
      }
      return $sqlArray;	 
   }
   /**
    * BizDataObj::BuildInsertSQL() - build insert sql INSERT INTO table_name (column1, column2,...) VALUES (value1, value2,....)
    *
    * @return void
    **/
   public function BuildInsertSQL($dataobj, $joinValues=null)
   {
      // generate column value pairs.
      $sqlFlds = $dataobj->m_BizRecord->GetToSaveFields('CREATE');

      global $g_BizSystem;
      $dbinfo = $g_BizSystem->GetConfiguration()->GetDatabaseInfo($dataobj->m_Database);
      $dbtype = $dbinfo["Driver"];

      $sql_col = ""; $sql_val = "";
      foreach($sqlFlds as $fldobj) 
      {
         $col = $fldobj->m_Column;
         
         // if Field Id has null value and Id is an identity type, remove the Id's column from the array
	     if ($fldobj->m_Name == "Id" && $dataobj->m_IdGeneration == "Identity")
	        continue;
	     
         if ($fldobj->IsLobField())  // special value for blob/clob type
            $_val = $fldobj->GetInsertLobValue($dbtype);
         else {
            if ($fldobj->m_ValueOnCreate != "")
               $_val = $fldobj->GetValueOnCreate();
            else
               $_val = $fldobj->GetSqlValue();
         }

         if (!$_val || $_val == '') continue;
         $sql_col .= $col. ", ";
         $sql_val .= $_val. ", ";
      }
      
      // if joinValues is given then add join values in to the main table InsertSQL.
      if(is_array($joinValues)){
      	foreach($joinValues as $joinColumn=>$joinValue){
      		if (!$joinValue || $joinValue == '') continue;
	        $sql_col .= $joinColumn. ", ";
	        $sql_val .= "'".$joinValue. "', ";
      	}
      }
      
      $sql_col = substr($sql_col, 0, -2);
      $sql_val = substr($sql_val, 0, -2);
      
      $sql = "INSERT INTO  " . $dataobj->m_MainTable . " (" . $sql_col . ") VALUES (" . $sql_val.")";
      return $sql;
   }
   
   //Added by Jixian on 2009-02-16 for implement onSaveDataObj   
   public function BuildInsertSQLforTableJoin($dataobj){
      global $g_BizSystem;
      $dbinfo = $g_BizSystem->GetConfiguration()->GetDatabaseInfo($dataobj->m_Database);
      $dbtype = $dbinfo["Driver"];
   	
   	  $sqlArray = array();
   	  foreach ($dataobj->m_TableJoins as $tableJoin){      	
      	if ($tableJoin->m_OnSaveDataObj) {  
      		  if($dataobj->GetFieldNameByColumn($tableJoin->m_ColumnRef)=='Id')
      		  	continue;        		
      		  $rec_join = $dataobj->m_BizRecord->GetJoinInputRecord($tableJoin->m_Name);
      		  $sql_col = ""; $sql_val = "";
		      foreach($rec_join as $fldobj) 
		      {
		         $col = $fldobj->m_Column;
		         
		         // if the Field is the joint FK Field and Main DO is an identity type, remove the Id's column from the array
			     if ($fldobj->m_Column == $tableJoin->m_Column && $dataobj->m_IdGeneration == "Identity")
			        continue;
			     
		         if ($fldobj->IsLobField())  // special value for blob/clob type
		            $_val = $fldobj->GetInsertLobValue($dbtype);
		         else {
		            if ($fldobj->m_ValueOnCreate != "")
		               $_val = $fldobj->GetValueOnCreate();
		            else
		               $_val = $fldobj->GetSqlValue();
		         }
		
		         if (!$_val || $_val == '') continue;
		
		         $sql_col .= $col. ", ";
		         $sql_val .= $_val. ", ";
		      }
		      $sql_col = substr($sql_col, 0, -2);
		      $sql_val = substr($sql_val, 0, -2);      		  
      		  
      		  $sql = "INSERT INTO  " . $tableJoin->m_Table . " (" . $sql_col . ") VALUES (" . $sql_val.")";
      		  $sqlArray[$tableJoin->m_ColumnRef] = $sql;        		
      	}      	
      }
      return $sqlArray;    
   }

   //Added by Jixian on 2009-02-23 for implement onSaveDataObj   
   public function BuildInsertSQLforTableExtension($dataobj){
      global $g_BizSystem;
      $dbinfo = $g_BizSystem->GetConfiguration()->GetDatabaseInfo($dataobj->m_Database);
      $dbtype = $dbinfo["Driver"];
   	
   	  $sqlArray = array();
   	  foreach ($dataobj->m_TableJoins as $tableJoin){      	
      	if ($tableJoin->m_OnSaveDataObj) {  
      		  if($dataobj->GetFieldNameByColumn($tableJoin->m_ColumnRef)=='Id'){
	      		  $rec_join = $dataobj->m_BizRecord->GetJoinInputRecord($tableJoin->m_Name);
	      		  $sql_col = $tableJoin->m_Column.", "; 
	      		  $sql_val = "'#MAINTABLEID#', ";			      
			      foreach($rec_join as $fldobj) 
			      {
			         $col = $fldobj->m_Column;
			     	 if ($fldobj->m_Column == $tableJoin->m_Column && $dataobj->m_IdGeneration == "Identity")
		        		continue;	     
			         if ($fldobj->IsLobField())  // special value for blob/clob type
			            $_val = $fldobj->GetInsertLobValue($dbtype);
			         else {
			            if ($fldobj->m_ValueOnCreate != "")
			               $_val = $fldobj->GetValueOnCreate();
			            else
			               $_val = $fldobj->GetSqlValue();
			         }
			         				     
			         if (!$_val || $_val == '') continue;
			
			         $sql_col .= $col. ", ";
			         $sql_val .= $_val. ", ";
			      }
			      $sql_col = substr($sql_col, 0, -2);
			      $sql_val = substr($sql_val, 0, -2);      		  
	      		  
	      		  $sql = "INSERT INTO  " . $tableJoin->m_Table . " (" . $sql_col . ") VALUES (" . $sql_val.")";
	      		  $sqlArray[$tableJoin->m_ColumnRef] = $sql;      		  
      		}        				
      	}      	
      }
      return $sqlArray;    
   }
   
   /**
    * BizDataObj::RuleToSql() - Convert search/sort rule to sql clause, replace [fieldName] with table.column
    * openbiz SQL expression as "[fieldName] opr 'Value' AND/OR [fieldName] opr 'Value'...". "()" is valid syntax
    *
    * @param string $rule "[fieldName] ..."
    * @return string sql statement
    **/
   private function RuleToSql($dataobj, $rule)
   {
      global $g_BizSystem;
      
      $dataSqlObj = $this->GetDataSqlObj();

      $rule = Expression::EvaluateExpression($rule,$dataobj);

      // replace all [field] with table.column
      foreach($dataobj->m_BizRecord as $bizFld)
      {
         if (!$bizFld->m_Column && !$bizFld->m_Alias)
            continue;   // ignore if no column mapped
         $fld_pattern = "[".$bizFld->m_Name."]";
         if (strpos($rule, $fld_pattern) === false)
            continue;   // ignore if no [field] found
         else
         {
           if ($bizFld->m_Column && (strpos($bizFld->m_Column,',') != 0))
           {  // handle composite key
              $pos = strpos($rule,'=');
              $endpos = strpos($rule,"'",$pos+2);
              $keyval = substr($rule,$pos+2,(strlen($rule)-$endpos)*-1);
              $rule = $this->CompKeyRuleToSql($bizFld->m_Column,$keyval);
           }
           else
           {
            if ($bizFld->m_Alias)
               $rule = str_replace($fld_pattern, $bizFld->m_Alias, $rule);
            else
            {
               $tableColumn = $dataSqlObj->GetTableColumn($bizFld->m_Join, $bizFld->m_Column);
               $rule = str_replace($fld_pattern, $tableColumn, $rule);
            }
           }
         }
      }

      return $rule;
   }

   private function CompKeyRuleToSql($compColum, $compValue)
   {
      $dataSqlObj = $this->GetDataSqlObj();
      $colArr = split(",", $compColum);
      $valArr = split(CK_CONNECTOR, $compValue);
      $sql = "";
      for ($i=0; $i < count($colArr); $i++)
      {
          if ($i>0) $sql .= "and";
          $tableColumn = $dataSqlObj->GetTableColumn("", $colArr[$i]);
          if ($valArr[$i] == '')
            $sql .= " ($tableColumn = '" . $valArr[$i] . "' OR $tableColumn is null) ";
          else
            $sql .= " $tableColumn = '" . $valArr[$i] . "' ";
      }
      return $sql;
   }
   
   /**
    * BizDataObj::ConvertSqlExpression() - replace [field name] in the SQL expression with table_alias.column
    *
    * @param object $dataobj - the instance of BizDataObj
    * @param string $sqlExpr - SQL expression supported by the database engine. The syntax is FUNC([FieldName1]...[FieldName2]...)
    * @return string real sql expression with column names
    **/
   private function ConvertSqlExpression($dataobj, $sqlExpr)
   {
      $dataSqlObj = $this->GetDataSqlObj();
      $sqlstr = $sqlExpr;
      $startpos = 0;
      while (true) {
         $fieldname = substr_lr($sqlstr,"[","]",$startpos);
         if ($fieldname == "") break;
         else {
            $bizFld = $dataobj->m_BizRecord->get($fieldname);
            $tableColumn = $dataSqlObj->GetTableColumn($bizFld->m_Join, $bizFld->m_Column);
            $sqlstr = str_replace("[$fieldname]", $tableColumn, $sqlstr);
            $startpos = strpos($sqlstr, '['); // Move startpos to the first [ (if it exists) in order to be detect by next itteration
         }
      }
      return $sqlstr;
   }
}

/**
 * substr_lr() - help function. Get the sub string whose left and right boundary character is $left and $right.
 * The search is in $str, starting from position of $startpos. If $findfirst is true, $left must be the charater on the $startpos.
 *
 * @return string
 **/
function substr_lr(&$str,$left,$right,&$startpos,$findfirst=false)
{
   $pos0 = strpos($str, $left, $startpos);
   if ($pos0 === false) return false;
   $tmp = trim(substr($str,$startpos,$pos0-$startpos));
   if ($findfirst && $tmp!="") return false;

   $posleft = $pos0+strlen($left);
   while(true) {
      $pos1 = strpos($str, $right, $posleft);
      if ($pos1 === false) {
         if (trim($right)=="") {
            $pos1 = strlen($str); // if right is whitespace
            break;
         }
         else return false;
      }
      else {   // avoid \$right is found
      if (substr($str,$pos1-1,1) == "\\")  $posleft = $pos1+1;
      else break;
      }
   }

   $startpos = $pos1 + strlen($right);
   $retStr = substr($str, $pos0 + strlen($left), $pos1-$pos0-strlen($left));
   return $retStr;
}


?>
