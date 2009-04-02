<?PHP
/**
 * BizViewWizard class - BizViewWizard is the class that controls the wizard forms
 *
 * @package BizView
 * @author rocky swen
 * @copyright Copyright (c) 2005
 * @access public
 */
class BizViewWizard extends BizView
{
   protected $m_WizardFormsData = array();  // should be saved in session
   protected $m_WizardFormIndex = 0;
   protected $m_DataObjectsInfo = array();   // keep track of DO's isQueried, isCommitted flags
   protected $m_DataObjectsData = array();

   public function __construct(&$xmlArr)
   {
      parent::__construct($xmlArr);
   }

   public function GetSessionVars($sessCtxt)
	{
	   $sessCtxt->GetObjVar($this->m_Name, "WizardFormsData", $this->m_WizardFormsData);
	   $sessCtxt->GetObjVar($this->m_Name, "WizardFormIndex", $this->m_WizardFormIndex);
	   $sessCtxt->GetObjVar($this->m_Name, "DataObjectsData", $this->m_DataObjectsData);
	   $sessCtxt->GetObjVar($this->m_Name, "DataObjectsInfo", $this->m_DataObjectsInfo);
	}

	public function SetSessionVars($sessCtxt)
	{
	   $sessCtxt->SetObjVar($this->m_Name, "WizardFormsData", $this->m_WizardFormsData);
	   $sessCtxt->SetObjVar($this->m_Name, "WizardFormIndex", $this->m_WizardFormIndex);
	   $sessCtxt->SetObjVar($this->m_Name, "DataObjectsData", $this->m_DataObjectsData);
	   $sessCtxt->SetObjVar($this->m_Name, "DataObjectsInfo", $this->m_DataObjectsInfo);
	}

   /**
    * Do not initiate the all forms
    */
   protected function InitAllForms() {}

   /**
    * Render wizard form
    * @param string $formName name of the form
    * @param boolean $isFirstTime true if the form is rendered for the first time
    * @return mixed html content for first time render, void otherwise 
    */
   public function RenderWizardForm($formName, $isFirstTime=false)
   {
      global $g_BizSystem;
      $smarty = BizSystem::GetSmartyTemplate();

      $formobj = $g_BizSystem->GetObjectFactory()->GetObject($formName);

      if ($formobj->m_DataObjName && !key_exists($formobj->m_DataObjName, $this->m_DataObjectsData))
         $this->SetDataObjState($formobj->m_DataObjName, "");

      $htmlContainer = "\n<div id='" . $formobj->m_Name . "_container'>\n" . $formobj->Render() . "\n</div>\n";
      $newClntObj = "NewObject('" . $formobj->m_Name . "','" . $formobj->m_jsClass . "');";
      if ($isFirstTime)
      {
         $sHTML = "\n<script>\n" . $newClntObj . "\n</script>\n" . $htmlContainer;
         return $sHTML;
      }
      else   // call clientproxy redrawForm
      {
         $g_BizSystem->GetClientProxy()->RunClientScript($newClntObj);
         $g_BizSystem->GetClientProxy()->ReDrawForm($this->m_Name, $htmlContainer);
         return;
      }
   }

   /**
    * Get the form name of the current wizard page
    * @return string name of the current form
    */
   public function GetCurWizardForm()
   {
      $formName = $this->m_MetaChildFormList[$this->m_WizardFormIndex]["FORM"];
      return $this->PrefixPackage($formName);
   }

   /**
    * Get the form name of the next wizard page
    * @return string name of the form in next wizard page
    */
   public function GetNextWizardForm()
   {
      $this->m_WizardFormIndex++;
      if ($this->m_WizardFormIndex >= count($this->m_MetaChildFormList))
         $this->m_WizardFormIndex = count($this->m_MetaChildFormList) - 1;
      $formName = $this->m_MetaChildFormList[$this->m_WizardFormIndex]["FORM"];
      return $this->PrefixPackage($formName);
   }

   /**
    * Get the form name of the previous wizard page
    * @return string name of the form in previous wizard page
    */
   public function GetPrevWizardForm()
   {
      $this->m_WizardFormIndex--;
      if ($this->m_WizardFormIndex < 0)
         $this->m_WizardFormIndex = 0;
      $formName = $this->m_MetaChildFormList[$this->m_WizardFormIndex]["FORM"];
      return $this->PrefixPackage($formName);
   }

   /**
    * Get dataobject state. Wizard form can set data object state in the view session
    * @param string $dataobjName dataobject name
    */
   public function GetDataObjState($dataobjName)
   {
      return $this->m_DataObjectsInfo[$dataobjName];
   }

   /**
    * Set dataobject state. Wizard form can set data object state in the view session
    * @param string $dataobjName dataobject name
    * @param mixed $state state variable
    * @return mixed dataobject state
    */
   public function SetDataObjState($dataobjName, $state)
   {
      return $this->m_DataObjectsInfo[$dataobjName] = $state;
   }

   /**
    * Get dataobject field data
    * @param string $dataobjName dataobject name
    * @param string $fldName dataobject field name
    * @return mixed dataobject field value
    */
   public function GetDataObjectsData($dataobjName, $fldName)
   {
      return $this->m_DataObjectsData[$dataobjName][$fldName];
   }

   /**
    * Set dataobject field value
    * @param string $dataobjName dataobject name
    * @param array $recArray dataobject record array
    * @return void
    */
   public function SetDataObjectsData($dataobjName, &$recArray)
   {
      foreach ($recArray as $fldName=>$fldValue)
         $this->m_DataObjectsData[$dataobjName][$fldName] = $fldValue;
   }

   /**
    * Get wizard form data
    * @param string $wizardForm form name
    * @param string $controlName form control name
    * @return mixed form control value if controlName is given, record otherwise
    */
   public function GetWizardFormData($wizardForm, $controlName=null)
   {
      if ($controlName == null)
         return $this->m_WizardFormsData[$wizardForm];
      return $this->m_WizardFormsData[$wizardForm][$controlName];
   }

   /**
    * Validate wizard form data
    * @param string $wizardForm form name
    * @param array $dataArray form data array
    * @return boolean true if validation passes
    */
   public function ValidateWizardFormData($dataobjName, $dataArray)
   {
      global $g_BizSystem;
      $dataObj = $g_BizSystem->GetObjectFactory()->GetObject($dataobjName);
      $dataObj->m_BizRecord->SetInputRecord($dataArray);
      return $dataObj->ValidateInput();
   }

   /**
    * Set wizard form data
    * @param string $wizardForm form name
    * @param array $dataArray form data array
    * @return void
    */
   public function SetWizardFormData($wizardForm, &$dataArray)
   {
      foreach ($dataArray as $ctrlName=>$ctrlValue)
         $this->m_WizardFormsData[$wizardForm][$ctrlName] = $ctrlValue;
   }

   /**
    * Save wizard data into database or other storage
    * @return void
    */
   public function CommitWizardData()
   {
      // commit all dataobjects of wizard forms
      global $g_BizSystem;

      foreach($this->m_DataObjectsData as $dataobjName=>$dataArray)
      {
         $dataobj = $g_BizSystem->GetObjectFactory()->GetObject($dataobjName);
         //Reload dataArray to account for new ObjRef generated values
         $dataArray = $this->m_DataObjectsData[$dataobjName];

         if ($this->m_DataObjectsInfo[$dataobjName] == "IS_CREATED") {
         	//Create an empty array before inserting data from wizard
         	$newRec = $dataobj->NewRecord();
         	foreach ($dataArray as $key => $field) { if ($field != null) $newRec[$key] = $field; }               
         	$dataobj->InsertRecord($dataArray);
         } else {
            $dataobj->UpdateRecord($dataArray, $oldRec);
         }
         $this->_UpdateReferences($dataobj, $dataArray);
      }
   }

   /**
    * Update data object reference objects
    */
   private function _UpdateReferences($dataObj, $dataArray) {
      //Check for object references
      $objRef = $dataObj->m_ObjReferences;
      foreach($this->m_DataObjectsData as $dataobjName=>$someArray)
      {
         $match = $objRef->get($dataobjName);
         if($match) {
            $this->m_DataObjectsData[$dataobjName][$match->m_Column] = $dataArray[$match->m_FieldRef];
         }

      }
   }

  public function RenderStepListBar($bReRender = false) {
		$formName = $this->GetCurWizardForm();		
		if(count($this->m_MetaChildFormList)){
			if($bReRender==false){
  				$sHTML.="<div id=\"steplist_bar\">\n";
  			}
			$sHTML.="<ol class=\"steplist_bar\">\n";
			foreach($this->m_MetaChildFormList as $ctrl){
				if($ctrl['FORM']===$formName){
					$sHTML.="\t<li><strong>".$ctrl['DESCRIPTION']."</strong></li>\n";	
				}else{
					$sHTML.="\t<li>".$ctrl['DESCRIPTION']."</li>\n";
				}
			}
			$sHTML.="</ol>\n";	
			if($bReRender==false){
  				$sHTML.="</div>\n";
  			}
	 		return $sHTML;	
		}else{
			return false;
		}
  }

   /**
    * Render progress bar of the wizard. Not implemented yet.
    */
   public function RenderProgressBar($bReRender = false) {
		$formName = $this->GetCurWizardForm();	
		$total_step = count($this->m_MetaChildFormList);
						
		for($i=0; $i<count($this->m_MetaChildFormList);$i++){
			$ctrl=$this->m_MetaChildFormList[$i];
			 
			if($ctrl['FORM']===$formName){
				$current_step= $i+1;
				break;
			}
			
		}
		if($bReRender==false){
			$sHTML.="<div id=\"progress_bar\">\n";
		}		
		$sHTML.="$current_step/$total_step \n";
		if($bReRender==false){
  			$sHTML.="</div>\n";
  		}		
 		return $sHTML;	
		
   }

   /**
    * Render the wizard view
    * @return mixed either print html content, or return html content
    */
   public function Render($bReRender=false, $smarty=false)
   {
	   if($smarty == false)
         $smarty = BizSystem::GetSmartyTemplate();
      
	   global $g_BizSystem;
	   
      $this->SetClientScripts(); 
	   
      // render progress bar

      // render only current wizard form, not all forms
      $formName = $this->GetCurWizardForm();
      // ouput the form into the wizard container
      $sHTML = $this->RenderWizardForm($formName, true);
      $controls[] = "<div id='" . $this->m_Name . "'>" . $sHTML . "</div>\n";

	  //added by Jixian , Render progress bar and step list bar
	  $sProgressBar = $this->RenderProgressBar($bReRender);
	  $sStepListBar = $this->RenderStepListBar($bReRender);
      
      //Add any required scripts that will be needed in future forms
      foreach ($this->m_MetaChildFormList as $form) {
         global $g_BizSystem;
         $formobj = $g_BizSystem->GetObjectFactory()->GetObject($form['FORM']);
         $formobj->SetFieldScripts();
      }      
      
      // add clientProxy scripts 
      if ($bReRender == false)
      {
         $smarty->assign("scripts", $g_BizSystem->GetClientProxy()->GetAppendedScripts());
         $smarty->assign("style_sheets", $g_BizSystem->GetClientProxy()->GetAppendedStyles());         
      }        

      $smarty->assign_by_ref("view_description", $this->m_Description);

      $smarty->assign_by_ref("controls", $controls);      
      
      //added by Jixian , Render progress bar and step list bar
      $smarty->assign_by_ref("progress_bar", $sProgressBar);
      $smarty->assign_by_ref("steplist_bar", $sStepListBar);
      
	  if($bReRender){
	  	$g_BizSystem->GetClientProxy()->ReDrawForm('steplist_bar', $sStepListBar);
	  	$g_BizSystem->GetClientProxy()->ReDrawForm('progress_bar', $sProgressBar);	  	
	  }
	  
      if ($this->m_ConsoleOutput)
         $smarty->display(BizSystem::GetTplFileWithPath($this->m_Template, $this->m_Package));
      else
         return $smarty->fetch(BizSystem::GetTplFileWithPath($this->m_Template, $this->m_Package));
   }
}

?>
