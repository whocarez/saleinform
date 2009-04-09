<?php
/**
 * BizFormWizard class - extension of BizForm to support wizard form
 *
 * @package BizView
 */
class BizFormNewWizard extends BizFormWizard
{
   protected $m_FormData = null;

   public function GetSessionVars($sessCtxt)
	{
      /*$sessCtxt->GetObjVar($this->m_Name, "FormData", $this->m_FormData);
      foreach ($this->m_RecordRow as $fldCtrl) {
         $fldCtrl->SetValue($this->m_FormData[$fldCtrl->m_Name]);
      }*/
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
         foreach ($this->m_RecordRow as $fldCtrl) {
            if ($fldCtrl->m_BizFieldName)
               $recArray[$fldCtrl->m_BizFieldName] = $this->m_FormData[$fldCtrl->m_Name];
         }
	 	 $this->ValidateForm();
         $ok = $this->GetViewObject()->ValidateWizardFormData($this->m_DataObjName, $recArray);

         if (!$ok) {
            return $this->ProcessDataObjError($ok);
         } else {         	
         	$this->GetViewObject()->Render(true); //added by jixian for support progress bar
            $viewobj->RenderWizardForm($nextFormName);                       
         }
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
         $this->GetViewObject()->Render(true);//added by jixian for support progress bar
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
      if ($viewobj->GetDataObjState($this->m_DataObjName) != "IS_CREATED") {
         // if edit record, do a query. if new record, call newrecord()
         $recArray = $this->GetNewRecord();
         $viewobj->SetDataObjState($this->m_DataObjName, "IS_CREATED");
         $viewobj->SetDataObjectsData($this->m_DataObjName, $recArray);
      }
      // if Formdata is empty, get data from dataobj
      if (!$this->m_FormData) {
         foreach ($this->m_RecordRow as $fldCtrl) {
            if ($fldCtrl->m_BizFieldName) { // if control based on field
               $this->m_FormData[$fldCtrl->m_Name] = $viewobj->GetDataObjectsData($this->m_DataObjName, $fldCtrl->m_BizFieldName);
            }
            else {
               $this->m_FormData[$fldCtrl->m_Name] = "";
            }
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
         $fldCtrl->SetValue($this->m_FormData[$fldCtrl->m_Name]);
         if ($fldCtrl->m_BizFieldName)
            $recArray[$fldCtrl->m_BizFieldName] = $value;
      }
      $this->GetViewObject()->SetWizardFormData($this->m_Name, $this->m_FormData);
      $this->GetViewObject()->SetDataObjectsData($this->m_DataObjName, $recArray);
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

      if (!$this->m_ActiveRecord)
         $this->GetFormData();
      $controls = $this->m_RecordRow->Render();
      if ($this->CanShowData()) {
         foreach($controls as $key=>$val) {
            $fields[$key]["control"] = $val;
            $fields[$key]["required"] = $this->GetControl($key)->m_Required;
            $fields[$key]["description"] = $this->GetControl($key)->m_Description;
         }
      }
      return $fields;
   }

}
?>