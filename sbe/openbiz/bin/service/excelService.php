<?php
/**
 * @package PluginService
 */
/**
 * excelService -
 * class excelService is the plug-in service of printing bizform to excel
 *
 * @package PluginService
 * @author rocky swen
 * @copyright Copyright (c) 2003
 * @version $Id: excelService.php,v 1.1 2006/04/07 08:01:29 rockys Exp $
 * @access public
 */
class excelService
{
   /**
    * excelService::excelService()
    *
    * @param void
    * @return void
    */
   function excelService() {}

   /**
    * excelService::renderHTML() - render the excel output with HTML format
    *
    * @param string $objname - object name which is the bizform name
    * @param string $mode - The mode used when gathering columns to export
    * @return void
    */
   function renderHTML($objname, $mode='READ')
   {
      header("Content-type: text/plain");
      header("Expires: 0");
      header("Content-disposition:  attachment; filename=".date('Y-m-d_H:i:s').".html");
      header("Cache-Control: must-revalidate, post-check=0, pre-check=0");

      global $g_BizSystem;
      // get the current UI bizobj
      $bizform = $g_BizSystem->GetObjectFactory()->GetObject($objname);    // get the existing bizform object
      $bizobj = $bizform->GetDataObj();

      echo "<table>";
      echo "<tr>";
      $keylist = $bizform->m_RecordRow->GetSortControlKeys();

      //Get a valid list of bizfields to include on the export.
      $displayControls = $bizform->GetDisplayControls($mode);
      $columnCount = count($displayControls);

      $line = "";
      foreach($keylist as $key) {
         if (in_array($key, $displayControls)) {
            echo "<td>".$bizform->GetControl($key)->m_DisplayName."</td>";
         } else {
            echo "<td></td>";
         }
      }

      echo "</tr>";
      echo "\n";

      //Export the actual rows
      $recList = array();
      $bizobj->FetchRecords("", $recList, -1, -1, false);
      foreach ($recList as $recArray)
      {
         echo "<tr>";
         foreach($keylist as $key) {
            if (in_array($key, $displayControls)) {
               echo "<td>".$recArray[$bizform->GetControl($key)->m_BizFieldName]."</td>";
            } else {
               echo "<td></td>";
            }
         }
         echo "</tr>";
         echo "\n";
      }
      echo "</table>";
   }

   /**
    * excelService::renderCSV() - render the excel output with CSV format
    *
    * @param string $objname object name which is the bizform name
    * @return void
    */
   function renderCSV($objname, $mode='READ')
   {
      header("Content-type: text/plain");
      header("Expires: 0");
      header("Content-disposition:  attachment; filename=".date('Y-m-d_H:i:s').".csv");
      header("Cache-Control: must-revalidate, post-check=0, pre-check=0");

      global $g_BizSystem;
      // get the current UI bizobj
      $bizform = $g_BizSystem->GetObjectFactory()->GetObject($objname);    // get the existing bizform object
      $bizobj = $bizform->GetDataObj();
      $keylist = $bizform->m_RecordRow->GetSortControlKeys();

      //Get a valid list of bizfields to include on the export.
      $displayControls = $bizform->GetDisplayControls($mode);
      $columnCount = count($displayControls);

      $line = "";
      foreach($keylist as $key) {
         if (in_array($key, $displayControls)) {
            $line .= "\"".$bizform->GetControl($key)->m_DisplayName."\",";
         }
      }
      $line = rtrim($line, ',');
      echo trim($line)."\n";

      $recList = array();
      $bizobj->FetchRecords("", $recList, -1, -1, false);
      foreach ($recList as $recArray)
      {
         $line = "";
         foreach($keylist as $key) {
            if (in_array($key, $displayControls)) {
               $line .= "\"".$recArray[$bizform->GetControl($key)->m_BizFieldName]."\",";
            }
         }
         $line = rtrim($line, ',');

         echo rtrim($line)."\n";
      }
   }

   /**
    * excelService::renderTAB() - render the excel output with TAB format
    *
    * @param string $objname object name which is the bizform name
    * @return void
    */
   function renderTAB($objname, $mode='READ')
   {
      header("Content-type: text/plain");
      header("Expires: 0");
      header("Content-disposition:  attachment; filename=".date('Y-m-d_H:i:s').".csv");
      header("Cache-Control: must-revalidate, post-check=0, pre-check=0");

      global $g_BizSystem;
      // get the current UI bizobj
      $bizform = $g_BizSystem->GetObjectFactory()->GetObject($objname);    // get the existing bizform object
      $bizobj = $bizform->GetDataObj();
      $keylist = $bizform->m_RecordRow->GetSortControlKeys();

      //Get a valid list of bizfields to include on the export.
      $displayControls = $bizform->GetDisplayControls($mode);
      $columnCount = count($displayControls);

      $line = "";
      foreach($keylist as $key) {
         if (in_array($key, $displayControls)) {
         $line .= "\"".$bizform->GetControl($key)->m_DisplayName."\"\t";
         }
      }
      $line = rtrim($line, ',');
      echo trim($line)."\n";

      $recList = array();
      $bizobj->FetchRecords("", $recList, -1, -1, false);
      foreach ($recList as $recArray)
      {
         $line = "";
         foreach($keylist as $key) {
            if (in_array($key, $displayControls)) {
            $line .= "\"".$recArray[$bizform->GetControl($key)->m_BizFieldName]."\"\t";
            }
         }
         $line = rtrim($line, ',');
         echo rtrim($line)."\n";
      }
   }
}

?>
