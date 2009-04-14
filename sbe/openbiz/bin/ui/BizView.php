<?PHP
/**
 * BizView class - BizView is the class that contains list of forms. View is same as html page.
 *
 * @package BizView
 * @author rocky swen
 * @copyright Copyright (c) 2005
 * @access public
 */
class BizView extends MetaObject implements iSessionObject
{
   protected $m_Template;
   protected $m_ViewSet;
   protected $m_ChildFormList = array();
   protected $m_MetaChildFormList = array();
   protected $m_Parameters = null;
   protected $m_IsPopup = false;
   protected $m_Height;
   protected $m_Width;
   protected $m_ConsoleOutput = true;
   public $m_Tab;

   /**
    * BizView::__construct(). Initialize BizView with xml array
    *
    * @param array $xmlArr
    * @return void
    */
   public function __construct(&$xmlArr)
   {
      $this->ReadMetadata($xmlArr);
      $this->InitAllForms();
   }

   /**
    * Initialize all form objects. called only once by BizController in RenderView()
    */
   protected function InitAllForms()
   {
      global $g_BizSystem;
      // build forms included in the view
      foreach($this->m_MetaChildFormList as $form) {
         $pkg_form = $this->PrefixPackage($form["FORM"]);
         $formobj = $g_BizSystem->GetObjectFactory()->GetObject($pkg_form);
         if (method_exists($formobj, "SetSubForms"))
            $formobj->SetSubForms($form["SUBCTRLS"]);
         $this->AddChildForm($formobj);
      }
      foreach($this->m_ChildFormList as $formobj)
      {
         if (method_exists($formobj, "GetSubForms")) {
            $subForms = $formobj->GetSubForms();
            if ($subForms) {
               foreach ($subForms as $subformName) {
                  $this->m_ChildFormList[$subformName]->SetParentForm($formobj->m_Name);
               }
            }
         }
      }
   }

   /**
    * Read Metadata from xml array
    * @param array $xmlArr
    */
   protected function ReadMetadata(&$xmlArr)
   {
      parent::ReadMetaData($xmlArr);
      $this->m_Name = $this->PrefixPackage($this->m_Name);
      $this->m_Template = isset($xmlArr["BIZVIEW"]["ATTRIBUTES"]["TEMPLATE"]) ? $xmlArr["BIZVIEW"]["ATTRIBUTES"]["TEMPLATE"] : null;
      $this->m_ViewSet = isset($xmlArr["BIZVIEW"]["ATTRIBUTES"]["VIEWSET"]) ? $xmlArr["BIZVIEW"]["ATTRIBUTES"]["VIEWSET"] : null;
      $this->m_Tab = isset($xmlArr["BIZVIEW"]["ATTRIBUTES"]["TAB"]) ? $xmlArr["BIZVIEW"]["ATTRIBUTES"]["TAB"] : null;

      // build ControlList
      $tmpList = null;
      if (isset($xmlArr["BIZVIEW"]["CONTROLLIST"]["CONTROL"]))
         $this->ReadMetaCollection($xmlArr["BIZVIEW"]["CONTROLLIST"]["CONTROL"], $tmpList);
      if (!$tmpList) return;
      foreach ($tmpList as $ctrl)
         $this->m_MetaChildFormList[] = $ctrl["ATTRIBUTES"];

      // read in parameters
      if (isset($xmlArr["BIZVIEW"]["PARAMETERS"]["PARAMETER"]))
         $this->m_Parameters = new MetaIterator($xmlArr["BIZVIEW"]["PARAMETERS"]["PARAMETER"],"Parameter");
   }

   /**
    * BizView::GetSessionContext() - Retrieve Session data of this object
    *
    * @param SessionContext $sessCtxt
    * @return void
    */
   public function GetSessionVars($sessCtxt)
	{
	   $sessCtxt->GetObjVar($this->m_Name, "Parameters", $paramArray);
	   $this->SetParameters($paramArray);
	}
	/**
    * BizView::SetSessionContext() - Save Session data of this object
    *
    * @param SessionContext $sessCtxt
    * @return void
    */
	public function SetSessionVars($sessCtxt)
	{
	   $paramArray = $this->GetParameterArray();
	   $sessCtxt->SetObjVar($this->m_Name, "Parameters", $paramArray);
	}

	/**
	 * Get parameters in an array
	 * @return array paramater array
	 */
	private function GetParameterArray()
	{
	   $paramArray = null;
	   if (!$this->m_Parameters) return null;
	   foreach ($this->m_Parameters as $param)
	      $paramArray[$param->m_Name] = $param->m_Value;
	   return $paramArray;
	}

   /**
    * get obejct parameter value
    * @param string $paramName name of the parameter
    * @return string parameter value
    */
	public function GetParameter($paramName)
	{
	   return $this->m_Parameters->get($paramName);
	}

	/**
	 * Set parameters
	 * @param array $paramArray parameter array
	 */
	public function SetParameters($paramArray)
	{
	   if (!$paramArray) return;
	   foreach ($paramArray as $paramName=>$paramValue) {
	      if ($this->m_Parameters->get($paramName))
	        $this->m_Parameters->get($paramName)->m_Value = $paramValue;
	      else {
	        $xmlArr["ATTRIBUTES"]["NAME"] = $paramName;
	        $xmlArr["ATTRIBUTES"]["VALUE"] = $paramValue;
	        $paramobj = new Parameter($xmlArr);
	        $this->m_Parameters->set($paramName, $paramobj);
	      }
	   }
	}

   /**
    * Get the property of the object. Used in expression language
    * @param string $propertyName name of the property
    * @return string property value
    */
	public function GetProperty($propertyName)
	{
	   $ret = parent::GetProperty($propertyName);
	   if ($ret) return $ret;
      // get control object if propertyName is "type[ctrlname]"
      $pos1 = strpos($propertyName, "[");
      $pos2 = strpos($propertyName, "]");
      if ($pos1>0 && $pos2>$pos1) {
         $propType = substr($propertyName, 0, $pos1);
         $ctrlname = substr($propertyName, $pos1+1,$pos2-$pos1-1);
         if ($propType == "param") {   // get parameter
            return $this->m_Parameters->get($ctrlname);
         }
      }
	}

	/**
	 * Get view set name
	 */
	public function GetViewSet() { return $this->m_ViewSet; }

	/**
	 * Clean view history so that reloading the view will get fresh data
	 */
	public function CleanViewHistory()
	{
	   global $g_BizSystem;
	   foreach($this->m_ChildFormList as $ctrl)
	   {
	      if (method_exists($ctrl, "CleanHistoryInfo"))
	        $ctrl->CleanHistoryInfo();
	   }
	}

	/**
	 * Get the style property from an object and return as html string
	 * @param $obj BizForm Object
	 * @return string HTML/Smarty string
	 **/
	private function GetHTMLStyle($obj){
		global $g_BizSystem;

		$session_context = $g_BizSystem->GetSessionContext();

		if(!$session_context->VarExists($obj->m_Name.'_style')){
			$session_context->SetVar($obj->m_Name.'_style', $obj->m_Style);
		}else{
			//I don't set the var tabs_configuration in session
		}

		$style = Expression::EvaluateExpression( $session_context->GetVar($obj->m_Name.'_style' ), $obj );
		return (bool)$style
				? "style='{$style}'"
				: '';
	}

	/**
	 * Set the Render output to console (as calling print ...) or to a string buffer
	 * @param boolean $bConsoleOutput
	 */
	public function SetConsoleOutput($bConsoleOutput)
	{
	   $this->m_ConsoleOutput = $bConsoleOutput;
	}

	/**
	 * Add a child BizForm object
	 * @param object $ctrl BizForm object
	 */
	protected function AddChildForm($ctrl)
	{
	   $this->m_ChildFormList[$ctrl->m_Name] = $ctrl;
	}

	/**
    * BizView::SetPopupSize() - Set the view as a popup window and set its size
    *
    * @param integer $w, window width
    * @param integer $h, window height
    * @return void
    */
	public function SetPopupSize($w,$h)
   {
      $this->m_IsPopup = true;
      $this->m_Width = $w;
      $this->m_Height = $h;
   }

   /**
    * Set the display mode of the child forms
    * @param string $form form name
    * @param string $mode display mode string
    */
   public function SetFormMode($form="", $mode="")
   {
      if (!$form || !$mode)
         return;
      $bizForm = $this->m_ChildFormList[$form];
      $bizForm->SetDisplayMode($mode);
   }

   /**
    * BizView::ProcessRule() - Convert rule to search rule of bizform
    *
    * @param string $rule. It can be "[field] opr value ..." OR form.ctrl opr value
    *        opr can be =,>,>=,<,<=,!=. "LIKE %" SQL format is also valid rule
    * @return void
    */
   public function ProcessRule($form="", $rule="", $cleanActualRule = FALSE)
   {
      // convert \' to '
      $addSearchRule = str_replace("\'", "'", $rule);

      // case 1: form=... $rule=[field] opr value
      if ($form) {
         $bizForm = $this->m_ChildFormList[$form];
         if ($rule) {
            // set dependent search rule which is remembered in the session
            $bizForm->SetFixSearchRule($addSearchRule, $cleanActualRule);
         }
         return;
      }

      // case 2: form.ctrl opr value
      if ($rule) {
         // replace package.form.ctrl with [field]
         // search for all child forms to match form name.
         foreach ($this->m_ChildFormList as $bizForm)
         {
            $bFind = false;
            $formName = $bizForm->m_Name;
            while (preg_match("/$formName\.[a-zA-Z0-9_]+/i",$addSearchRule,$matches))
            {
               $match = $matches[0];
               $ctrlName = substr($match, strlen($formName)+1);
               $ctrlFieldName = $bizForm->GetControl($ctrlName)->m_BizFieldName; // not ctrl_id
               $addSearchRule = str_replace($match,"[".$ctrlFieldName."]",$addSearchRule);
               $bFind = true;
            }
            if ($bFind) {
               //echo "###".$bizForm->m_Name.",".$addSearchRule;
               // set dependent search rule which is remembered in the session
               $bizForm->SetFixSearchRule($addSearchRule, $cleanActualRule);
            }
         }
      }
   }

	/**
    * BizView::Render() - Render this view.
    *
    * @return mixed either print html content, or return html content

    */
	public function Render($bReRender=false, $smarty = false)
	{
      //return $this->_render($bReRender=false, $smarty = false);
      //modified by Jixian for fix this bug 
      return $this->_render($bReRender, $smarty);
	}

	/**
	 * ReRender the view (the view is loaded on browser)
	 * @return void
	 */
	public function ReRender()
	{
      return $this->_render(true);
	}

   /**
    * Render this view. This function is called by Render() or ReRender()
    *
    * @return mixed either print html content or return html content if called by Render(), or void if called by ReRender()
    */
	protected function _render($bReRender=false, $smarty=false)
	{			
   	   if($smarty == false)
         $smarty = BizSystem::GetSmartyTemplate();

	   global $g_BizSystem;
	   if ($bReRender == false)
         $this->SetClientScripts();

      // todo: should enforce rendering parent form before rendering subforms,
      // because subform's dataobj is a objreference of the parent dataobj.
      foreach ($this->m_ChildFormList as $form=>$formobj) {
         if ($bReRender) {
            if ($g_BizSystem->GetClientProxy()->HasFormRerendered($form) == false)
               $formobj->ReRender();
            $sHTML = $g_BizSystem->GetClientProxy()->GetFormOutput($form);
         }
         $sHTML = $formobj->Render();

         $htmlStyle =  $this->GetHTMLStyle($formobj);
         
         //Modification: html attribute added to set the initial style for a form




         //Add: Next 5 lines was added for get the initial style from a form and after set it in bizview --jmmz
         $style=($formobj->m_Style)?Expression::EvaluateExpression($formobj->m_Style,$formobj):'';
         $htmlStyle = ""; //jmmz
         if((!empty($style))&&(!is_null($style))){ //jmmz
         	$htmlStyle = "style='{$style}'"; //jmmz
         } //jmmz
         //Modification: html attribute added to set the initial style for a form --jmmz
         $controls[] = "\n<div id='" . $formobj->m_Name . "_container' {$htmlStyle}>\n" . $sHTML . "\n</div>\n";
         $forms[str_replace(".","_",$formobj->m_Name)] = "\n<div id='" . $formobj->m_Name . "_container'>\n" . $sHTML . "\n</div>\n";
         if (isset($formobj->m_jsClass))
            $newClntObjs .= "NewObject('" . $formobj->m_Name . "','" . $formobj->m_jsClass . "'); \n";
         //$newClntObjs .= "var fobj=GetObject('".$formobj->m_Name."');\n";
      }

      // add clientProxy scripts
      if ($bReRender == false)
      {
         $includedScripts = $g_BizSystem->GetClientProxy()->GetAppendedScripts();
		 $styles = $g_BizSystem->GetClientProxy()->GetAppendedStyles();
      }

      if ($this->m_IsPopup && $bReRender==false) {
         $moveToCenter = "moveToCenter(self, ".$this->m_Width.", ".$this->m_Height.");";
         $scripts = $includedScripts."\n<script>\n" . $newClntObjs . $moveToCenter . "</script>\n";
      }
      else
         $scripts = $includedScripts."\n<script>\n" . $newClntObjs . "</script>\n";
      $smarty->assign("scripts", $scripts);
      $smarty->assign("style_sheets", $styles);
      $smarty->assign_by_ref("view_description", $this->m_Description);

      $smarty->assign_by_ref("controls", $controls);
      $smarty->assign_by_ref("forms", $forms);
      if ($this->m_ConsoleOutput)
         $smarty->display(BizSystem::GetTplFileWithPath($this->m_Template, $this->m_Package));
      else
         return $smarty->fetch(BizSystem::GetTplFileWithPath($this->m_Template, $this->m_Package));
	}

   /**
    * Generate popup view metadata xml array on the fly
    * @return string xml array
    */
   public static function GetPopupViewXML($package, $formName)
   {
      // generate an xml attribute array for a dynamic bizview
      $xmlArr["BIZVIEW"]["ATTRIBUTES"]["NAME"] = "__DynPopup";
      $xmlArr["BIZVIEW"]["ATTRIBUTES"]["DESCRIPTION"] = "Openbiz Popup";
      $xmlArr["BIZVIEW"]["ATTRIBUTES"]["PACKAGE"] = $package;
      $xmlArr["BIZVIEW"]["ATTRIBUTES"]["CLASS"] = "BizView";
      $xmlArr["BIZVIEW"]["ATTRIBUTES"]["TEMPLATE"] = "popup.tpl";
      $xmlArr["BIZVIEW"]["CONTROLLIST"]["CONTROL"]["ATTRIBUTES"]["FORM"] = $formName;
      return $xmlArr;
   }

   /**
    * Include client javascript in the html content
    * @return void
    */
   protected function SetClientScripts()
   {
      global $g_BizSystem;
      $g_BizSystem->GetClientProxy()->AppendScripts("prototype", "prototype.js");
      $g_BizSystem->GetClientProxy()->AppendScripts("clientUtil", "clientUtil.js");
      $g_BizSystem->GetClientProxy()->AppendScripts("jsval", "jsval.js");
      $g_BizSystem->GetClientProxy()->AppendStyles("default", "openbiz.css");
   }
}

?>
