<?php
/**
 * BizFormWizard class - extension of BizForm to support wizard form
 * 
 * @package BizView
 */
class BizFormWizard extends BizForm 
{
   protected $m_FormData = null;
   
   public function GetSessionVars($sessCtxt)
	{
      //$sessCtxt->GetObjVar($this->m_Name, "FormData", $this->m_FormData);
	}

	public function SetSessionVars($sessCtxt)
	{
      //$sessCtxt->SetObjVar($this->m_Name, "FormData", $this->m_FormData);
	}
   
   /**
    * Go to next wizard page
    * @param boolean $commit true if need to commit current form data
    * @return void
    */
   public function GoNext($commit=false) //- call RenderNextWizardForm() by default
   {
      $viewobj = $this->GetViewObject();
      $nextFormName = $viewobj->GetNextWizardForm();
      if ($nextFormName != $this->m_Name) {
         $this->SetFormData();
         $viewobj->RenderWizardForm($nextFormName);
      }
   }
   
   /**
    * Go to previous wizard page
    * @return void
    */
   public function GoPrev() //- call RenderPrevWizardForm() by default
   {
      $viewobj = $this->GetViewObject();
      $prevFormName = $viewobj->GetPrevWizardForm();
      if ($prevFormName != $this->m_Name) {
         $this->SetFormData();
         $viewobj->RenderWizardForm($prevFormName);
      }
   }
   
   /**
    * Finish the wizard process
    * @return void
    */
   public function DoFinish() //- call FinishWizard() by default
   {
      global $g_BizSystem;

      $postAction = $this->GetPostAction();
      if (!$postAction) {
         $g_BizSystem->GetClientProxy()->ShowErrorMessage("Your wizard process cannot be finished due to invalid PostAction of the finish action");
         return;
      }
      else {
         // commit wizard data
         $this->SetFormData();
         $this->GetViewObject()->CommitWizardData();
         
         $this->HandlePostAction($postAction);
         return;
      }
   }
   
   /**
    * Cancel the wizard process
    * @return void
    */
   public function DoCancel() //- call CancelWizard() by default
   {
      global $g_BizSystem;
      // get postaction of the cancel button
      $postAction = $this->GetPostAction();
      if (!$postAction) {
         $g_BizSystem->GetClientProxy()->ShowErrorMessage("Your wizard process cannot be canceled due to invalid PostAction of the cancel action");
         return;
      }
      else {
         $this->HandlePostAction($postAction);
         return;
      }
   }
   
   /**
    * Get form data from wizard view session and set data to form controls
    * @return void
    */
   protected function GetFormData()
   {
      $this->m_FormData = $this->GetViewObject()->GetWizardFormData($this->m_Name);
      $viewobj = $this->GetViewObject();
      // if Formdata is empty, get data from dataobj
      if (!$this->m_FormData) {
         foreach ($this->m_RecordRow as $fldCtrl) {
            if ($fldCtrl->m_BizFieldName) { // if control based on field
               if ($viewobj->GetDataObjState($this->m_DataObjName) != "IS_QUERIED") {
                  $ok = $this->_run_search($resultRecords);
                  if (!$ok) 
                     return $this->ProcessDataObjError($ok);
                  $recArray = $resultRecords[0];
                  $viewobj->SetDataObjState($this->m_DataObjName, "IS_QUERIED");
                  $viewobj->SetDataObjectsData($this->m_DataObjName, $recArray);
               }
               $this->m_FormData[$fldCtrl->m_Name] = $viewobj->GetDataObjectsData($this->m_DataObjName, $fldCtrl->m_BizFieldName);
            }
            else
               $this->m_FormData[$fldCtrl->m_Name] = "";
         }
         //$this->$viewobj->SetWizardFormData($this->m_Name, $this->m_FormData);
      }
      
      foreach ($this->m_RecordRow as $fldCtrl) {
         $fldCtrl->SetValue($this->m_FormData[$fldCtrl->m_Name]);
      }
   }
   
   /**
    * Set form data to wizard view session
    * @return void
    */
   protected function SetFormData()
   {
      global $g_BizSystem;
      $recArray = array();
      foreach ($this->m_RecordRow as $fldCtrl) {
         $value = $g_BizSystem->GetClientProxy()->GetFormInputs($fldCtrl->m_Name);
         $this->m_FormData[$fldCtrl->m_Name] = $value;
         if ($fldCtrl->m_BizFieldName)
            $recArray[$fldCtrl->m_BizFieldName] = $value;
      }
      $this->GetViewObject()->SetWizardFormData($this->m_Name, $this->m_FormData);
      $this->GetViewObject()->SetDataObjectsData($this->m_DataObjName, $recArray);
   }
   
   /**
    * Render the form 
    */
   public function Render()
   {
      return $this->RenderHTML();
   }
   
   /**
    * Render form data in an array
    * @return array array of the control html content
    */
   protected function RenderArray()
   {
      $columns = $this->m_RecordRow->RenderColumn();
      foreach($columns as $key=>$val)
         $fields[$key]["label"] = $val;

      $this->GetFormData();
      $controls = $this->m_RecordRow->Render(); 
      if ($this->CanShowData()) {
         foreach($controls as $key=>$val) {
            $fields[$key]["control"] = $val;
         }
      }
      return $fields;
   }
   
   /**
    * Get control value
    * @parame string $controlName name of the control
    * @return mixed value of the control
    */
   public function GetControlValue($controlName) 
   {
      return $this->m_FormData[$controlName];
   }
}
?>