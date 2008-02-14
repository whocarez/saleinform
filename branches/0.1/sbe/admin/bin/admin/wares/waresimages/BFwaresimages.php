<?php
class BFwaresimages extends BizForm
{
   public function Download($id)
   {
      global $g_BizSystem;
      $db = $g_BizSystem->GetDBConnection();
      
      $dataobj = $this->GetDataObj();
      $table = $dataobj->m_MainTable;
      $name_col = $dataobj->GetField("name")->m_Column;
      $type_col = $dataobj->GetField("type")->m_Column;
      $size_col = $dataobj->GetField("size")->m_Column;
      $data_col = $dataobj->GetField("image")->m_Column;
      $id_col = $dataobj->GetField("Id")->m_Column;
      
      $sql = "SELECT $name_col, $type_col, $size_col, $data_col FROM $table WHERE $id_col = '$id'";
      try {
         $pdo_stmt = $db->query($sql);
      }
      catch (Exception $e) {
         $errMsg = "Error in query: " . $sql . ". " . $e->getMessage();
         echo $errMsg;
         exit;
      }
      
      list($name, $type, $size, $content) = $pdo_stmt->fetch(PDO::FETCH_NUM);
      
      unset($pdo_stmt);
      unset($db);
      
      ob_clean();
      
      header("Cache-Control: ");// leave blank to avoid IE errors
      header("Pragma: ");// leave blank to avoid IE errors
      header("Content-Disposition: attachment; filename=\"$name\"");
      header("Content-length: $size");
      header("Content-type: $type");
      echo $content;

      exit;
   }

   protected function ReadInputRecord(&$recArr)
   {
      parent::ReadInputRecord($recArr);
      // read in file data and attributes
      foreach ($_FILES as $file) {
         $error = $file['error'];
         if ($error != 0) {
            $this->ReportError($error);
            return false;
         }
         $recArr["name"] = $file['name'];
         $recArr["type"] = $file['type'];
         $recArr["size"] = $file['size'];
         $recArr["image"] = $file['tmp_name'];
         // only read the first one
         break;
      }
      return true;
   }
   
   protected function ReportError($error)
   {
      if ($error==1)
         $errorStr = "The uploaded file exceeds the upload_max_filesize directive in php.ini";
      else if ($error==2)
         $errorStr = "The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form";
      else if ($error==3)
         $errorStr = "The uploaded file was only partially uploaded";
      else if ($error==4)
         $errorStr = "No file was uploaded";
      else if ($error==6)
         $errorStr = "Missing a temporary folder";
      else if ($error==7)
         $errorStr = "Failed to write file to disk";
      else
         $errorStr = "Error in file upload";
         
      global $g_BizSystem;
      $g_BizSystem->GetClientProxy()->ShowErrorMessage($errorStr);
   }
}

?>