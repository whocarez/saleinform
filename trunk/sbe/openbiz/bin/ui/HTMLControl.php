<?PHP
/**
 * HTMLControl - class HTMLControl is the base class of HTML controls
 *
 * @package BizView
 * @author rocky swen
 * @copyright Copyright (c) 2005
 * @version 1.2
 * @access public
 */
class HTMLControl extends MetaObject implements iUIControl
{
   public $m_Caption;
   public $m_Image;
   public $m_Style;
   public $m_Type;
   public $m_cssClass;
   public $m_Function;
   public $m_FunctionType;
   public $m_DisplayMode;
   public $m_FieldName;
   public $m_State = "ENABLED";
   public $m_Width = null;
   public $m_Height = null;
   public $m_Upshift = null;
   public $m_Required = "N";
   public $m_Enabled = "Y";      // support expression
   public $m_HTMLAttr = "";      // support expression ?
   public $m_SelectFrom = null;  // support expression
   public $m_Hidden = "N";       // support expression
   public $m_Link = null;        // support expression
   public $m_EventHandlers = null;

   public $m_Value = "";
   public $m_BizFormName;

   protected $m_Mode;
   protected $m_DataFormat = "";

   /**
    * Initialize HTMLControl with xml array
    *
    * @param array $xmlArr xml array
    * @param BizForm $formObj BizForm instance
    * @return void
    */
   function __construct(&$xmlArr, $formObj)
   {
      $this->m_BizFormName = $formObj->m_Name;
      $this->m_Name = isset($xmlArr["ATTRIBUTES"]["NAME"]) ? $xmlArr["ATTRIBUTES"]["NAME"] : null;
      $this->m_Package = $formObj->m_Package;
      $this->m_Caption = isset($xmlArr["ATTRIBUTES"]["CAPTION"]) ? I18n::getInstance()->translate($xmlArr["ATTRIBUTES"]["CAPTION"]) : null;
      $this->m_Image = isset($xmlArr["ATTRIBUTES"]["IMAGE"]) ? $xmlArr["ATTRIBUTES"]["IMAGE"] : null;
      $this->m_Type = isset($xmlArr["ATTRIBUTES"]["TYPE"]) ? $xmlArr["ATTRIBUTES"]["TYPE"] : null;
      $this->m_cssClass = isset($xmlArr["ATTRIBUTES"]["CSSCLASS"]) ? $xmlArr["ATTRIBUTES"]["CSSCLASS"] : null;
      $this->m_Style = isset($xmlArr["ATTRIBUTES"]["STYLE"]) ? $xmlArr["ATTRIBUTES"]["STYLE"] : null;
      $this->m_FieldName = isset($xmlArr["ATTRIBUTES"]["FIELDNAME"]) ? $xmlArr["ATTRIBUTES"]["FIELDNAME"] : null;
      $this->m_FunctionType = isset($xmlArr["ATTRIBUTES"]["FUNCTIONTYPE"]) ? $xmlArr["ATTRIBUTES"]["FUNCTIONTYPE"] : null;
      $this->m_Function = isset($xmlArr["ATTRIBUTES"]["FUNCTION"]) ? $xmlArr["ATTRIBUTES"]["FUNCTION"] : null;
      $this->m_Width = isset($xmlArr["ATTRIBUTES"]["WIDTH"]) ? $xmlArr["ATTRIBUTES"]["WIDTH"] : null;
      $this->m_Upshift = isset($xmlArr["ATTRIBUTES"]["UPSHIFT"]) ? $xmlArr["ATTRIBUTES"]["UPSHIFT"] : null;
      $this->m_Height = isset($xmlArr["ATTRIBUTES"]["HEIGHT"]) ? $xmlArr["ATTRIBUTES"]["HEIGHT"] : null;
      $this->m_Required = isset($xmlArr["ATTRIBUTES"]["REQUIRED"]) ? $xmlArr["ATTRIBUTES"]["REQUIRED"] : null;
      $this->m_BlankOption=isset($xmlArr["ATTRIBUTES"]["BLANKOPTION"]) ? $xmlArr["ATTRIBUTES"]["BLANKOPTION"] : null;
      $this->m_Enabled = isset($xmlArr["ATTRIBUTES"]["ENABLED"]) ? $xmlArr["ATTRIBUTES"]["ENABLED"] : null;
      $this->m_HTMLAttr = isset($xmlArr["ATTRIBUTES"]["HTMLATTR"]) ? $xmlArr["ATTRIBUTES"]["HTMLATTR"] : null;
      $this->m_SelectFrom = isset($xmlArr["ATTRIBUTES"]["SELECTFROM"]) ? $xmlArr["ATTRIBUTES"]["SELECTFROM"] : null;
      $this->m_Hidden = isset($xmlArr["ATTRIBUTES"]["HIDDEN"]) ? $xmlArr["ATTRIBUTES"]["HIDDEN"] : null;
      $this->m_Link = isset($xmlArr["ATTRIBUTES"]["LINK"]) ? $xmlArr["ATTRIBUTES"]["LINK"] : null;
      $this->m_DisplayMode = isset($xmlArr["ATTRIBUTES"]["DISPLAYMODE"]) ? $xmlArr["ATTRIBUTES"]["DISPLAYMODE"] : null;

      $this->PrefixSelectFrom();
      if (!$this->m_Type)
         $this->m_Type = "TEXT";

      // read EventHandler element
      if (isset($xmlArr["EVENTHANDLER"]))  // 2.1 eventhanlders
         $this->m_EventHandlers = new MetaIterator($xmlArr["EVENTHANDLER"],"EventHandler");
      else if (isset($xmlArr["ATTRIBUTES"]["FUNCTION"])) {   // openbiz 2.0 compatible
         $func = isset($xmlArr["ATTRIBUTES"]["FUNCTION"]) ? $xmlArr["ATTRIBUTES"]["FUNCTION"] : null;
         $funcType = isset($xmlArr["ATTRIBUTES"]["FUNCTIONTYPE"]) ? $xmlArr["ATTRIBUTES"]["FUNCTIONTYPE"] : null;
         $postAct = isset($xmlArr["ATTRIBUTES"]["POSTACTION"]) ? $xmlArr["ATTRIBUTES"]["POSTACTION"] : null;
         $shortKey = isset($xmlArr["ATTRIBUTES"]["SHORTCUTKEY"]) ? $xmlArr["ATTRIBUTES"]["SHORTCUTKEY"] : null;
         $tempArr = array("ATTRIBUTES"=>array("NAME"=>"onevent","EVENT"=>"onclick",
                          "FUNCTION"=>$func,
                          "FUNCTIONTYPE"=>$funcType,
                          "POSTACTION"=>$postAct,
                          "SHORTCUTKEY"=>$shortKey));
         $this->m_EventHandlers = new MetaIterator($tempArr,"EventHandler");
      }
      /*if ($xmlArr["EVENTHANDLER"])  // 2.1 eventhanlders
         $this->m_EventHandlers = new MetaIterator($xmlArr["EVENTHANDLER"],"EventHandler");
      else if ($xmlArr["ATTRIBUTES"]["FUNCTION"]) {   // openbiz 2.0 compatible
         $tempArr = array("ATTRIBUTES"=>array("NAME"=>"onevent","EVENT"=>"onclick",
                          "FUNCTION"=>$xmlArr["ATTRIBUTES"]["FUNCTION"],
                          "FUNCTIONTYPE"=>$xmlArr["ATTRIBUTES"]["FUNCTIONTYPE"],
                          "POSTACTION"=>$xmlArr["ATTRIBUTES"]["POSTACTION"],
                          "SHORTCUTKEY"=>$xmlArr["ATTRIBUTES"]["SHORTCUTKEY"]));
         $this->m_EventHandlers = new MetaIterator($tempArr,"EventHandler");
      }*/
      if ($this->m_EventHandlers != null) {
         foreach ($this->m_EventHandlers as $evthdl)
            $evthdl->SetFormName($formObj->m_Name);
      }
   }

   /**
    * Get the BizForm object
    * @return BizForm BizForm instance
    */
   protected function GetFormObj()
   {
      global $g_BizSystem;
	  return $g_BizSystem->GetObjectFactory()->GetObject($this->m_BizFormName);
   }

   /**
	 * Change the BizForm name. This function is used in case of the current BizForm 
	 * inheriting from another BizDForm, HTMLControl's BizForm name should be changed to 
	 * current BizForm name, not the parent object name.
	 * @param string $bizFormName the name of BizForm obejct
	 * @return void
	 */
   public function AdjustBizFormName($bizFormName)
   {
      if ($this->m_BizFormName == $bizFormName)
         return;
      $this->m_BizFormName = $bizFormName;
      if ($this->m_EventHandlers != null) {
         foreach ($this->m_EventHandlers as $evthdl)
            $evthdl->AdjustFormName($this->m_BizFormName);
      }
   }

   /**
    * SelectFrom can have format: "selectionXmlFile(key)" or "selectionDO[field]" or "value"
    * in case of selectionXmlFile(key) or selectionDO[field], add package as prefix
    * @return avoid
    */
   private function PrefixSelectFrom()
   {
      // selectFrom can have format: "selectionXmlFile(key)" or "selectionDO[field]" or "value"
      // in case of selectionXmlFile(key) or selectionDO[field], add package as prefix
      if ($this->m_SelectFrom) {
         $dot_pos = strpos($this->m_SelectFrom, ".");
         $leftpr_pos = strpos($this->m_SelectFrom, "(");
         $leftbr_pos = strpos($this->m_SelectFrom, "[");
         if ($leftpr_pos > 0 || $leftbr_pos > 0) {
            $left_pos = $leftpr_pos > 0 ? $leftpr_pos : $leftbr_pos;
            if ($dot_pos > 0 && $dot_pos < $left_pos)
               $this->m_SelectFrom = $this->PrefixPackage($this->m_SelectFrom);
            if ($dot_pos === false)
               $this->m_SelectFrom = $this->PrefixPackage($this->m_SelectFrom);
         }
      }
   }

   /**
    * HTMLControl::SetState() - Set state (Enabled or Disabled) of this control
    *
    * @param string $state
    * @return void
    */
   public function SetState($state)
   {
      $this->m_State = $state;
   }

   /**
    * HTMLControl::SetMode() - Set display mode of this control
    *
    * @param string $mode
    * @return void
    */
   public function SetMode($mode, $dataFormat)
   {
      $this->m_Mode = $mode;
      $this->m_DataFormat = $dataFormat;
   }

   /**
    * Set control value
    * @param mixed $val value of the control
    * @return void
    */
   public function SetValue($val)
   {
	  $this->m_Value = $val;
   }

   /**
    * Get control value
    * @return mixed value of the control
    */
   public function GetValue()
   {
      return $this->m_Value;
   }

   /**
    * Get the value of given property
    * @param string $propertyName name of property
    * @return mixed valule of property
    */
   public function GetProperty($propertyName)
	{
	   $ret = parent::GetProperty($propertyName);
	   if ($ret) return $ret;
	   if ($propertyName == "Value") return $this->m_Value;
	   return $this->$propertyName;
	}

   /**
    * HTMLControl::CanDisplayed() - Check if the control can be displayed
    *
    * @return boolean
    */
   public function CanDisplayed()
   {
      if ($this->GetHidden() == "Y")
         return false;
      if (!$this->m_DisplayMode)
         return true;
      if ($this->m_DisplayMode == $this->m_Mode)
         return true;
      if (strpos($this->m_DisplayMode, $this->m_Mode) === false)
         return false;
      return true;
   }

   /**
    * HTMLControl::Render() - render the control by html
    *
    * @return string HTML text
    */
   public function Render()
   {   	
      $cType = strtoupper($this->m_Type);
      if ($cType == "TEXT")   $sHTML = $this->RenderText();
      else if ($cType == "LISTBOX")   $sHTML = $this->RenderListBox();
      else if ($cType == "TEXTAREA")   $sHTML = $this->RenderTextArea();
      else if ($cType == "CHECKBOX")   $sHTML = $this->RenderCheckBox();
      else if ($cType == "RADIO")   $sHTML = $this->RenderRadio();
      else if ($cType == "BUTTON")   $sHTML = $this->RenderButton();
      else if ($cType == "HTMLBUTTON")   $sHTML = $this->RenderHTMLButton();
      else if ($cType == "RESETBUTTON")   $sHTML = $this->RenderResetButton();
      else if ($cType == "SUBMITBUTTON")   $sHTML = $this->RenderSubmitButton();
      else if ($cType == "PASSWORD")   $sHTML = $this->RenderPassword();
      else if ($cType == "HTMLBLOCK")   $sHTML = $this->RenderHTMLBlock();
      else if ($cType == "FILE")   $sHTML = $this->RenderFile();
      else if ($cType == "HIDDEN")   $sHTML = $this->RenderHidden();
      else if ($cType == "RICHTEXT")   $sHTML = $this->RenderRichText();
      else if ($cType == "AUTOSUGGEST")   $sHTML = $this->RenderAutoSuggest();
      else $sHTML = $this->RenderText();
      return $sHTML;
   }

   /**
    * Get the style text of the control
    * @return string style text
    */
   protected function GetStyle()
   {
      $cls = $this->m_cssClass ? "class='".$this->m_cssClass."' " : null;

      $formobj = $this->GetFormObj();

      if ($this->m_Width) 
      {
        if ($this->m_Width>=0)
           $style .= "width:".$this->m_Width.";";
      } 
      else if ($formobj->m_DataObjName && $this->m_FieldName)
      {
        $cType = strtoupper($this->m_Type);
        if ($cType != "TEXTAREA")   {
          
          //  $bizobj = BizSystem::GetObjectFactory()->getObject($formobj->m_DataObjName);
          $bizobj = BizSystem::GetObjectFactory()->CreateObject($formobj->m_DataObjName);
          
          
          $length = $bizobj->GetField($this->m_FieldName)->m_Length;
          if ($length && $length>0)
          {
            $width = $length * 10;
            if ($width > 700) $width = 700;
            $style .= "width:".$width.";";
          }
        }
      }

      if ($this->m_Height && $this->m_Height>=0)
         $style .= "height:".$this->m_Height.";";
      if ($this->m_Upshift)
         $style .= "text-transform:uppercase;";
      if ($this->m_Style)
         $style .= $this->m_Style;
      if (!isset($style) && !$cls)
         return null;
      if (isset($style))
      {
         $style = Expression::EvaluateExpression($style, $formobj);
         $style = "style='$style'";
      }
      if ($cls)
         $style = $cls." ".$style;
      return $style;
   }

   /**
    * Get shortcut key function map - array (shortcut_key=>function)
    * @return array shortcut key function map
    */
   public function GetSCKeyFuncMap()
   {
      if (!$this->CanDisplayed()) return null;
      $map = array();
      $formobj = $this->GetFormObj();
      if ($this->m_EventHandlers == null)
         return null;
      foreach ($this->m_EventHandlers as $evthdl)
      {
         if ($evthdl->m_ShortcutKey) {
            $temp = ($evthdl->m_FunctionType==null) ? "" : ",'".$evthdl->m_FunctionType."'";
            $func = "CallFunction('" . $evthdl->m_Function . "'$temp)";
            $func = Expression::EvaluateExpression($func, $formobj);
            $map[$evthdl->m_ShortcutKey] = $func;
         }
      }
      return $map;
   }
   
   /**
    * Get context menu array  - array(array(menu_text, function, shortcut_key))
    * @return array context menu array 
    */
   public function GetContextMenu()
   {
      if (!$this->CanDisplayed()) return null;
      $menus = array();
      $formobj = $this->GetFormObj();
      if ($this->m_EventHandlers == null)
         return null;
      $i = 0;
      foreach ($this->m_EventHandlers as $evthdl)
      {
         if ($evthdl->m_ContextMenu) {
            $temp = ($evthdl->m_FunctionType==null) ? "" : ",'".$evthdl->m_FunctionType."'";
            $func = "CallFunction('" . $evthdl->m_Function . "'$temp)";
            $func = Expression::EvaluateExpression($func, $formobj);
            $menus[$i]['text'] = $evthdl->m_ContextMenu;
            $menus[$i]['func'] = $func;
            $menus[$i]['key'] = $evthdl->m_ShortcutKey;
         }
         $i++;
      }
      return $menus;
   }

   /**
    * Get client side function html text
    * @return string client side function html text
    */
   protected function GetFunction()
   {
      $name = $this->m_Name;
      // loop through the event handlers
      $func = "";
      // *** will link conflict with other attributes like drilldownlink?
      if ($this->m_EventHandlers == null && $this->m_Link != null) {
         $func .= " onclick=\"loadPage('" . $this->GetLink() . "');\"";
         return $func;
      }
      if ($this->m_EventHandlers == null)
         return null;
      foreach ($this->m_EventHandlers as $evthdl)
      {
         $ehName = $evthdl->m_Name;
         $event = $evthdl->m_Event;
         if (!$event) continue;
         // add direct URL support
         if ($evthdl->m_URL)
            $func .= " $event=\"loadPage('" . $evthdl->m_URL . "');\"";
         else if (strpos($evthdl->m_Function, "js:") === 0)
            $func .= " $event=\"".substr($evthdl->m_Function, 3).";\"";
         else {
            $temp = ($evthdl->m_FunctionType==null) ? "" : ",'".$evthdl->m_FunctionType."'";
            $func .= " $event=\"SetOnElement('$name:$ehName'); CallFunction('" . $evthdl->m_Function . "'$temp);\"";
            //$func .= " $event=\"this.style.cursor=''; SetOnElement('$name:$ehName'); CallFunction('" . $evthdl->m_Function . "'$temp);\"";
         }
      }

      $formobj = $this->GetFormObj();
      $func = Expression::EvaluateExpression($func, $formobj);

      /*
      if ($this->m_Function) {
         $cType = strtoupper($this->m_Type);
         if ($cType=="TEXT" || $cType=="TEXTAREA" || $cType=="LISTBOX")
            $func = "onChange=\"SetOnElement('$name'); CallFunction('" . $this->m_Function . "'$temp);\"";
         else
            $func = "onClick=\"SetOnElement('$name'); CallFunction('" . $this->m_Function . "'$temp);\"";
      }
      else if ($this->m_Link) {
         $cType = strtoupper($this->m_Type);
         if ($cType=="TEXT" || $cType=="TEXTAREA" || $cType=="LISTBOX")
            $func = "onChange=\"loadPage('".$this->m_Link."')\"";
         else
            $func = "onClick=\"loadPage('".$this->m_Link."')\"";
      }*/
      return $func;
   }

   /**
    * Get "enabled" data
    * @return string 
    */
   protected function GetEnabled()
   {
      $formobj = $this->GetFormObj();
      return Expression::EvaluateExpression($this->m_Enabled, $formobj);
   }

   /**
    * Get "hidden" data
    * @return string
    */
   protected function GetHidden()
   {
      $formobj = $this->GetFormObj();
      return Expression::EvaluateExpression($this->m_Hidden, $formobj);
   }

   /**
    * Get "link" data
    * @return string
    */
   protected function GetLink()
   {
      if ($this->m_Link == null)
         return null;
      $formobj = $this->GetFormObj();
      return Expression::EvaluateExpression($this->m_Link, $formobj);
   }

   /**
    * Get "SelectFrom" data
    * @return string
    */
   protected function GetSelectFrom()
   {
      $formobj = $this->GetFormObj();
      return Expression::EvaluateExpression($this->m_SelectFrom, $formobj);
   }

   /**
    * Get "PostAction" data
    * @param string $ehname name of the event handler
    * @return string
    */
   public function GetPostAction($ehname)
   {
      $formobj = $this->GetFormObj();
      $evthandler = $this->m_EventHandlers->get($ehname);
      if (!$evthandler) return null;
      return Expression::EvaluateExpression($evthandler->m_PostAction, $formobj);
   }

   /**
    * Render text type control
    * @return string HTML content of a control
    */
   protected function RenderText()
   {
	   if ($this->m_SelectFrom)
         return $this->RenderListBox();

      $disabledStr = ($this->GetEnabled() == "N") ? "disabled=\"true\"" : "";
      $style = $this->GetStyle();
      $func = $this->GetFunction();
      $sHTML = "<input name=\"" . $this->m_Name . "\" id=\"" . $this->m_Name ."\" value=\"" . $this->m_Value . "\" $disabledStr $this->m_HTMLAttr $style $func>";
      return $sHTML;
   }

   /**
    * Render Listbox type control
    * @return string HTML content of a control
    */
   protected function RenderListBox()
   {
      $fromlist = array();
      $this->GetFromList($fromlist);
      $value_arr = explode(',', $this->m_Value);
      $disabledStr = ($this->GetEnabled() == "N") ? "disabled=\"true\"" : "";
      $style = $this->GetStyle();
      $func = $this->GetFunction();
      $sHTML = "<select name=\"" . $this->m_Name . "[]\" id=\"" . $this->m_Name ."\" $disabledStr $this->m_HTMLAttr $style $func>";
      
      
      if ($this->m_BlankOption) // ADD a blank option 
      {
       	$entry=split(",",$this->m_BlankOption);
   		$text=$entry[0];
   		$value=($entry[1]!="") ? $entry[1] : '';
   		$entrylist=array(array("val" => $value, "txt" => $text ));
   		$fromlist=array_merge($entrylist,$fromlist);
      }
	   
      // jcgonz - 2008-11-12 - Removed blank option due the use of m_BlankOption
      //if ($this->m_Mode == MODE_Q)
      //   $sHTML .= "<option value=\"\"></option>";	 
      foreach ($fromlist as $opt) {
         $test = array_search($opt['val'], $value_arr);
         if ($test === false) {
            $selectedStr = '';
         } else {
            $selectedStr = "selected";
         }
         $sHTML .= "<option value=\"" . $opt['val'] . "\" $selectedStr>" . $opt['txt'] . "</option>";	 
      }
      $sHTML .= "</select>";
      return $sHTML;
   }

   /**
    * Render textarea type control
    * @return string HTML content of a control
    */
   protected function RenderTextArea()
   {
      $disabledStr = ($this->GetEnabled() == "N") ? "disabled=\"true\"" : "";
      $style = $this->GetStyle();
      $func = $this->GetFunction();
      $sHTML = "<textarea name=\"" . $this->m_Name . "\" id=\"" . $this->m_Name ."\" $disabledStr $this->m_HTMLAttr $style $func>".$this->m_Value."</textarea>";
      return $sHTML;
   }

   /**
    * Render rich text editor control
    * @return string HTML content of a control
    */
   protected function RenderRichText()
   {
      $ctrlname = $this->m_Name;
      $ctrlname_container = $ctrlname."_container";
      $value = $this->GetValue();
      $style = $this->GetStyle();
      $w = $this->m_Width ? $this->m_Width : 600;
      $h = $this->m_Height ? $this->m_Height : 300;
      //$func = "onclick=\"editRichText('$ctrlname',$w,$h);\"";
      if(!strlen($value)>0) // fix suggested by smarques
         $value="&nbsp;";
      $sHTML = "<div id='$ctrlname_container' $style $func>".$value."</div>\n";
	  $sHTML .= "<input type='hidden' id='hdn$ctrlname' name='$ctrlname' value=\"\">"."\n";     
      //$sHTML .= "<textarea rows=2 cols=20 id='hdn$ctrlname' name='$ctrlname'>".$value."</textarea>\n";
      $sHTML .= "<script>editRichText('$ctrlname',$w,$h);</script>";
      return $sHTML;
   }

   /**
    * Render checkbox control
    * @return string HTML content of a control
    */
   protected function RenderCheckBox()
   {
      $boolValue = $this->GetSelectFrom();
      $disabledStr = ($this->GetEnabled() == "N") ? "disabled=\"true\"" : "";
      $checkedStr = ($boolValue == $this->m_Value) ? "checked" : "";
      $style = $this->GetStyle();
      $func = $this->GetFunction();
      $sHTML = '';
      $fromlist = array();
      $this->GetFromList($fromlist);
      if (count($fromlist) > 1) {
         $value_arr = explode(',', $this->m_Value);

         foreach ($fromlist as $opt) {
            $test = array_search($opt['val'], $value_arr);
            if ($test === false) {
               $checkedStr = '';
            } else {
               $checkedStr = "checked";
            }
            $sHTML .= "<input type='checkbox' name='".$this->m_Name."[]' id=\"" . $this->m_Name ."\" value=\"" . $opt['val'] . "\" $checkedStr $disabledStr $this->m_HTMLAttr $func>" . $opt['txt'] . "";
         }
      } else {
         $sHTML = "<input type=\"checkbox\" name=\"" . $this->m_Name . "\" id=\"" . $this->m_Name ."\" value='$boolValue' $checkedStr $disabledStr $this->m_HTMLAttr $style $func>";
      }

      return $sHTML;
   }


   /**
    * Render radio button control
    * @return string HTML content of a control
    */
   protected function RenderRadio()
   {
      $fromlist = array();
      $this->GetFromList($fromlist);
      $disabledStr = ($this->GetEnabled() == "N") ? "disabled=\"true\"" : "";
      $style = $this->GetStyle();
      $func = $this->GetFunction();
      foreach ($fromlist as $opt) {
         $checkedStr = ($opt['val'] == $this->m_Value) ? "CHECKED" : "";
         $sHTML .= "<input type='radio' name='".$this->m_Name."' id=\"" . $this->m_Name ."\" value=\"" . $opt['val'] . "\" $checkedStr $disabledStr $this->m_HTMLAttr $func>" . $opt['txt'] . "";
      }
      return "<span $style>".$sHTML."</span>";
   }

   /**
    * Render image button control
    * @return string HTML content of a control
    */
   protected function RenderButton()
   {
      $style = $this->GetStyle();
      $func = $this->m_State == "ENABLED" ? $this->GetFunction() : "";
      $mouseover = "onmouseover=\"window.status='". $this->m_Caption ."'; return true;\"";
      $cls = !$this->m_cssClass ? $this->m_Type : $this->m_cssClass;
	  $disabledStr = ($this->GetEnabled() == "N") ? "disabled=\"true\"" : "";
	  
      if ($this->m_Image) {
         $out = "<img src=\"../images/" . $this->m_Image . "\" align='middle' border='0'' $mouseover class=$cls title=\"" . $this->m_Caption . "\">";
         if ($func != "")
            $out = "<a href='javascript:void(0);' $this->m_HTMLAttr $func>".$out."</a>";
      }
      else {
         $out = $this->m_Caption;
         $out = "<input type='button' value='$out' class='$cls' $this->m_HTMLAttr $disabledStr $style $func $mouseover>";
         //$out = "<span class='$cls'>$out</span>";
      }

      return $out;
   }

   /**
    * Render html button control
    * @return string HTML content of a control
    */
   protected function RenderHTMLButton()
   {
      $disabledStr = ($this->GetEnabled() == "N") ? "disabled=\"true\"" : "";
      $func = $this->GetFunction();
      $style = $this->GetStyle();
      $sHTML .= "<input type='button' name='$this->m_Name' id=\"" . $this->m_Name ."\" value='$this->m_Caption' $disabledStr $this->m_HTMLAttr $func $style>";
      return $sHTML;
   }

   /**
    * Render reset button control
    * @return string HTML content of a control
    */
   protected function RenderResetButton()
   {
      $disabledStr = ($this->GetEnabled() == "N") ? "disabled=\"true\"" : "";
      $style = $this->GetStyle();
      $func = $this->GetFunction();
      $sHTML .= "<input type='reset' name='$this->m_Name' id=\"" . $this->m_Name ."\" value='$this->m_Caption' $disabledStr $this->m_HTMLAttr $style $func>";
      return $sHTML;
   }

   /**
    * Render submit button control
    * @return string HTML content of a control
    */
   protected function RenderSubmitButton()
   {
      $disabledStr = ($this->GetEnabled() == "N") ? "disabled=\"true\"" : "";
      $style = $this->GetStyle();
      $func = $this->GetFunction();
      $sHTML .= "<input type='submit' name='$this->m_Name' id=\"" . $this->m_Name ."\" value='$this->m_Caption' $disabledStr $this->m_HTMLAttr $style $func>";
      return $sHTML;
   }

   /**
    * Render password control
    * @return string HTML content of a control
    */
   protected function RenderPassword()
   {
      $disabledStr = ($this->GetEnabled() == "N") ? "disabled=\"true\"" : "";
      $style = $this->GetStyle();
      $sHTML .= "<input type='password' name='$this->m_Name' id=\"" . $this->m_Name ."\" value='$this->m_Value' $disabledStr $this->m_HTMLAttr $style>";
      return $sHTML;
   }

   /**
    * Render html block control
    * @return string HTML content of a control
    */
   protected function RenderHTMLBlock()
   {
      $style = $this->GetStyle();
      $content = $this->m_Caption;
      if (!$content || $content==null)
         $content = $this->m_Value;
      if ($style)
         return "<span $style>".$content."</span>";
      else
         return $content;
   }

   /**
    * Render file control
    * @return string HTML content of a control
    */
   protected function RenderFile()
   {
      $disabledStr = ($this->GetEnabled() == "N") ? "DISABLED=\"true\"" : "";
      $style = $this->GetStyle();
      $sHTML .= "<input type='file' name='$this->m_Name' id=\"" . $this->m_Name ."\" value='$this->m_Value' $disabledStr $this->m_HTMLAttr $style>";
      return $sHTML;
   }

   /**
    * Render hidden control
    * @return string HTML content of a control
    */
   protected function RenderHidden()
   {
      $sHTML = "<input type='hidden' name='$this->m_Name' id=\"" . $this->m_Name ."\" value='$this->m_Value' $this->m_HTMLAttr>";
      return $sHTML;
   }

   /**
    * Render auto suggestion control supporting either simple or hidden format.
    * @return string HTML content of a control
    */
   protected function RenderAutoSuggest()
   {
      $disabledStr = ($this->GetEnabled() == "N") ? "DISABLED=\"true\"" : "";
      $selFrom = $this->m_SelectFrom;
      $pos0 = strpos($selFrom, "[");
      $pos1 = strpos($selFrom, "]");
      $first_half = substr($selFrom, 0, $pos1);
      $inputName = $this->m_Name;

      if (strpbrk($first_half, ':')) {
         $hidden_name = $this->m_Name.'_hidden';
         $inputChoice = $this->m_Name.'_hidden_choices';
         $hidden_value = 'Enter Value Here';

         if ($pos0>0 && $pos1>$pos0) {  // select from bizObj
            // support BizObjName[BizFieldName] or BizObjName[BizFieldName4Text:BizFieldName4Value]
            $bizobjName = substr($selFrom, 0, $pos0);
            $pos3 = strpos($selFrom, ":");
            if($pos3>$pos0 && $pos3<$pos1) {
               $fldName = substr($selFrom, $pos0+1, $pos3-$pos0-1);
               $fldName_v = substr($selFrom, $pos3+1, $pos1-$pos3-1);
            }
            else {
               $fldName = substr($selFrom, $pos0 + 1, $pos1 - $pos0-1);
               $fldName_v = $fldName;
            }

            global $g_BizSystem;
            $bizobj = $g_BizSystem->GetObjectFactory()->GetObject($bizobjName);
            if ($bizobj) {
               $recList = array();
               $searchRule = "[$fldName_v] = '$this->m_Value'";
               $bizobj->FetchRecords($searchRule, $recList, -1, -1, true, true); // query w/o association
               $hidden_value = $recList[0][$fldName];
            }
         }
         $sHTML = "<input type=\"text\" id=\"$hidden_name\" name=\"$hidden_name\" value=\"" . $hidden_value . "\" onfocus=\"initAutoSuggest('$this->m_BizFormName','AutoSuggest','$hidden_name','$inputChoice');\"/>";
         $sHTML .= "<div id=\"$inputChoice\" class=\"autocomplete\" style=\"display:none\"></div>";
         $sHTML .= "<INPUT NAME=\"" . $inputName . "\" ID=\"".$inputName."\" VALUE=\"" . $this->m_Value . "\" type=\"hidden\" >";
      } else {
         $inputChoice = $this->m_Name.'_choices';
         $sHTML = "<input type=\"text\" id=\"$inputName\" name=\"$inputName\" value=\"" . $this->m_Value . "\" onfocus=\"initAutoSuggest('$this->m_BizFormName','AutoSuggest','$inputName','$inputChoice');\"/>";
         $sHTML .= "<div id=\"$inputChoice\" class=\"autocomplete\" style=\"display:none\"></div>";
      }
      return $sHTML;
   }


   /**
    * Get Select from list
    * @param array $list output array
    * @return void
    */
   public function GetFromList(&$list)
   {
     $selFrom = $this->GetSelectFrom();
     $pos0 = strpos($selFrom, "(");
     $pos1 = strpos($selFrom, ")");
     if ($pos0>0 && $pos1>$pos0) {  // select from xml file
        $xmlFile = substr($selFrom, 0, $pos0);
        $tag = substr($selFrom, $pos0 + 1, $pos1 - $pos0-1);
        $tag = strtoupper($tag);
        $xmlFile = BizSystem::GetXmlFileWithPath ($xmlFile);
        if (!$xmlFile) return;
        $xmlArr = &BizSystem::GetXmlArray($xmlFile);
        if ($xmlArr) {
          $i=0;
          if (!key_exists($tag, $xmlArr["SELECTION"]))
            return;
          foreach($xmlArr["SELECTION"][$tag] as $node) {
            $list[$i]['val'] = $node["ATTRIBUTES"]["VALUE"];
            if ($node["ATTRIBUTES"]["TEXT"])
            {
            	$list[$i]['txt'] = I18n::getInstance()->translate($node["ATTRIBUTES"]["TEXT"]) ;
            }

            else
            {
            	$list[$i]['txt'] = I18n::getInstance()->translate($list[$i]['val']);
            }
            $i++;
          }
        }
        return;
     }

      $pos0 = strpos($selFrom, "[");
      $pos1 = strpos($selFrom, "]");
      if ($pos0>0 && $pos1>$pos0) {  // select from bizObj
         // support BizObjName[BizFieldName] or BizObjName[BizFieldName4Text:BizFieldName4Value]
         $bizobjName = substr($selFrom, 0, $pos0);
         $pos3 = strpos($selFrom, ":");
         if($pos3>$pos0 && $pos3<$pos1) {
            $fldName = substr($selFrom, $pos0+1, $pos3-$pos0-1);
            $fldName_v = substr($selFrom, $pos3+1, $pos1-$pos3-1);
         }
         else {
            $fldName = substr($selFrom, $pos0 + 1, $pos1 - $pos0-1);
            $fldName_v = $fldName;
         }
         $pos_comma = strpos($selFrom, ",", $pos1);
         if ($pos_comma > $pos1)
            $searchRule = trim(substr($selFrom, $pos_comma+1));
         global $g_BizSystem;
         $bizobj = $g_BizSystem->GetObjectFactory()->GetObject($bizobjName);
         if (!$bizobj)
            return;

         $recList = array();
         $old_assoc = $bizobj->m_Association;
         $bizobj->m_Association = null;
         $recList = $bizobj->DirectFetch($searchRule);
         $bizobj->m_Association = $old_assoc;

         foreach ($recList as $rec)
         {
            $list[$i]['val'] = $rec[$fldName_v];
            $list[$i]['txt'] = $rec[$fldName];
            $i++;
         }
         return;
      }
      
      // in case of a|b|c
      $recList = explode('|',$selFrom);
      foreach ($recList as $rec)
      {
         $list[$i]['val'] = $rec;
         $list[$i]['txt'] = $rec;
         $i++;
      }
      return;
   }
  
}

/**
 * Event handler class that reads EventHandler element of HTMLControl or FieldControl
 *
 * @package BizView
 * @author rocky swen
 * @copyright Copyright (c) 2005
 * @version 1.2
 * @access private
 */
class EventHandler
{
   public $m_Name;
   public $m_Event;
   public $m_Function;     // support expression
   public $m_FunctionType;
   public $m_PostAction;   // support expression
   public $m_ShortcutKey;
   public $m_ContextMenu;
   private $m_FormName;

   // add URL here so that direct url string can be given
   public $m_URL;

   function __construct(&$xmlArr)
   {
      $this->m_Name = isset($xmlArr["ATTRIBUTES"]["NAME"]) ? $xmlArr["ATTRIBUTES"]["NAME"] : null;
      $this->m_Event = isset($xmlArr["ATTRIBUTES"]["EVENT"]) ? $xmlArr["ATTRIBUTES"]["EVENT"] : null;
      $this->m_Function = isset($xmlArr["ATTRIBUTES"]["FUNCTION"]) ? $xmlArr["ATTRIBUTES"]["FUNCTION"] : null;
      $this->m_FunctionType = isset($xmlArr["ATTRIBUTES"]["FUNCTIONTYPE"]) ? $xmlArr["ATTRIBUTES"]["FUNCTIONTYPE"] : null;
      $this->m_PostAction = isset($xmlArr["ATTRIBUTES"]["POSTACTION"]) ? $xmlArr["ATTRIBUTES"]["POSTACTION"] : null;
      $this->m_ShortcutKey = isset($xmlArr["ATTRIBUTES"]["SHORTCUTKEY"]) ? $xmlArr["ATTRIBUTES"]["SHORTCUTKEY"] : null;
      $this->m_ContextMenu = isset($xmlArr["ATTRIBUTES"]["CONTEXTMENU"]) ? $xmlArr["ATTRIBUTES"]["CONTEXTMENU"] : null;
      $this->m_URL = isset($xmlArr["ATTRIBUTES"]["URL"]) ? $xmlArr["ATTRIBUTES"]["URL"] : null;
   }

   public function SetFormName($formname)
   {
      $this->m_FormName = $formname;
      if (strpos($this->m_Function, "js:")===0)
         return;
      // if no class name, add default class name. i.e. NewRecord => ObjName.NewRecord
      if ($this->m_Function) {
         $pos_dot = strpos($this->m_Function, ".");
         $pos_lpt = strpos($this->m_Function, "(");
         if (!$pos_dot || $pos_lpt < $pos_dot)
            $this->m_Function = $this->m_FormName.".".$this->m_Function;
      }
   }

   public function AdjustFormName($formname)
   {
      $this->m_FormName = $formname;
      // if no class name, add default class name. i.e. NewRecord => ObjName.NewRecord
      if ($this->m_Function) {
         $pos = strrpos($this->m_Function, ".");
         if ($pos > 0)
            $this->m_Function = $this->m_FormName.".".substr($this->m_Function, $pos+1);
      }
   }
}
?>
