<?PHP
/**
 * HTMLTabs - class HTMLTabs is the base class of HTML tabs
 *
 * @package BizView
 * @author rocky swen
 * @copyright Copyright (c) 2005
 * @version 1.2
 * @access public
 */
class HTMLTabs extends MetaObject implements iUIControl
{
   public $m_TemplateFile;
   public $m_TabViews = null;
   protected $m_CurrentTab = null;
   protected $m_ActiveCssClassName = null;
   protected $m_InactiveCssClassName = null;

   /**
    * Initialize HTMLTabs with xml array
    *
    * @param array $xmlArr
    * @return void
    */
   function __construct(&$xmlArr)
   {
      global $g_BizSystem;

      $this->ReadMetadata($xmlArr);
   }

   /**
    * Read Metadata from xml array
    * @param array $xmlArr
    */
   protected function ReadMetadata(&$xmlArr)
   {
      $this->m_Name = $xmlArr["TABS"]["ATTRIBUTES"]["NAME"];
      $this->m_Package = $xmlArr["TABS"]["ATTRIBUTES"]["PACKAGE"];
      $this->m_Class = $xmlArr["TABS"]["ATTRIBUTES"]["CLASS"];
      $this->m_TemplateFile = $xmlArr["TABS"]["ATTRIBUTES"]["TEMPLATEFILE"];
      $this->m_TabViews = new MetaIterator($xmlArr["TABS"]["TABVIEWS"]["VIEW"],"TabView");
      $this->m_ActiveCssClassName = "'{$xmlArr["TABS"]["ATTRIBUTES"]["ACTIVECSSCLASSNAME"]}'";
      $this->m_InactiveCssClassName = "'{$xmlArr["TABS"]["ATTRIBUTES"]["INACTIVECSSCLASSNAME"]}'";
   }

   /**
    * Render JS Code to create multidimensional array of forms for a given HTMLTab
    *
    * @param array $forms
    * @return array $js_array 
    **/
   private function renderJSCodeForForms($forms){
      $js_array="new Array(";
   	if($forms){
   	   foreach($forms as $form){
   	      if(!is_null($form)) {
   	  	   $js_array.="new Array('{$form['NAME']}','{$form['VISIBLE']}'),";
   	  	} else {
   	  	   // No array entry will be created
   	  	}
   	   }
   	   $js_array = rtrim($js_array,',').")";
	 } else {
	    $js_array = 'null';
   	 }
      return $js_array;
   }

   /**
    * Render a URL for hide or show forms or in another case, go to URL specified in xml
    * 
    * @param tab object $tview
    * @return javascript string to either show a BizForm or load a different URL
    **/
   private function renderURL($tview){
   	  if($tview->hasForms()){
   	  	$url = "javascript:ChangeTab(this, {$tview->m_Name}_config)";
   	  } else if($tview->m_URL) {
   	  	$url = $tview->m_URL;
   	  } else {
   	  	$url = "javascript:GoToView('{$tview->m_View}')";
   	  }

   	  return $url;
   }

   /**
    * Set current tab with view name
    * 
    * @param string $viewName name of a view
    * @return void
    */
   public function SetCurrentTab($viewName)
   {
      $this->m_CurrentTab = $viewName;
   }
   
   /**
    * Ask if the $this tab object is the current tab
    * 
	* @param $tview TabView Object
	* @param $curViewObj current View Object
	* @param $curView name of the current view
	* @return boolean $current_tab  TRUE if on the current tab, otherwise FALSE
    **/
   public function IsCurrentTab($tview, $curViewobj, $curView){ //--jmmz
   	  $current_tab = false; //this variable save 'true' if is the current tab and 'false' in otherwise --jmmz
   	  if ($this->m_CurrentTab){
   	  	$current_tab = ($this->m_CurrentTab == $tview->m_Name || $this->m_CurrentTab == $tview->m_Tab)
   	  						? TRUE
   	  						: FALSE;
   	  } elseif ($tview->m_ViewSet) {
	         	// check if current view's viewset == tview->m_ViewSet
	            $current_tab = ($curViewobj->GetViewSet() == $tview->m_ViewSet) ? true : false;
       }else{
            $current_tab = ($curView == $tview->m_View || $curViewobj->m_Tab == $tview->m_Name) ? true : false;
       }

	   return $current_tab;
   }

    /**
    * Save the current tab in the session object
    * 
	* @param $tview TabView Object
	* @param $curViewObj current View Object
	* @param $curView name of the current view
	* @return void
    **/
   public function SetCurrentTabInSession($tview, $curViewobj, $curView){
	  global $g_BizSystem;

	  $session_context = $g_BizSystem->GetSessionContext();

	  if (!$session_context->VarExists('CURRENT_TAB_'.$this->m_Name)){
	  	if ($this->IsCurrentTab($tview,$curViewobj, $curView)){
	  		$session_context->SetVar('CURRENT_TAB_'.$this->m_Name,$tview->m_Name);
	  	}else{
			//Don't set var if isn't the current var
		}
	  }else{
		  $this->SetCurrentTab($session_context->GetVar('CURRENT_TAB_'.$this->m_Name));
		}
   }   
   
      

   /**
    * Render the html tabs
    * @return string html content of the tabs
    */
   public function Render()
   {
      global $g_BizSystem;
      $curView = $g_BizSystem->GetCurrentViewName();
      $curViewobj = ($curView) ? $g_BizSystem->GetObjectFactory()->GetObject($curView) : null;

      $profile = $g_BizSystem->GetUserProfile();
      $svcobj = $g_BizSystem->GetService("accessService");
      $role = isset($profile["ROLE"]) ? $profile["ROLE"] : null;

      // list all views and highlight the current view
      // pass $tabs(caption, url, target, icon, current) to template
      $smarty = BizSystem::GetSmartyTemplate();
      $tabs = array();
      $i = 0;
      foreach ($this->m_TabViews as $tview)
      {
 	   // tab is renderd if  no definition  is found in accessservice.xml (default)
         if ($svcobj->AllowViewAccess($tview->m_View, $role))
         {

         	 $tabs[$i]['name']=$tview->m_Name; //Name of each tab--jmmz
	         $tabs[$i]['forms']=$this->renderJSCodeForForms($tview->m_Forms);//Configuration of the forms to hide or show--jmmz
	         $tabs[$i]['caption'] = $tview->m_Caption;
	       
			 $tabs[$i]['url'] = $this->renderURL($tview); //Call the method to render the url--jmmz

	       //If I have forms to hide or show I add the event because I don't need an URL, I need an event
	       if( (bool) $tview->hasForms() ) {
	          $tabs[$i]['event']=$tabs[$i]['url']; //Assign The url rendered to the event on click
		      $tabs[$i]['url']='javascript:void(0)'; //If I put url in '' then the href want send me to another direction
		      $this->SetCurrentTabInSession($tview, $curViewobj, $curView); //I set the current tab wrote in session
		      $hasForms = TRUE;
	       }

	       $tabs[$i]['target'] = $tview->m_Target;
	       $tabs[$i]['icon'] = $tview->m_Icon;
	       $tabs[$i]['current'] = $this->IsCurrentTab($tview,$curViewobj, $curView); //I get the current tab.       
	       $i++;	
	   }
      }
      $this->SetClientScripts($tabs, $hasForms);
	$smarty->assign_by_ref("tabs", $tabs);
      $smarty->assign_by_ref("tabs_Name",$this->m_Name);
      
      return $smarty->fetch(BizSystem::GetTplFileWithPath($this->m_TemplateFile, $this->m_Package));
   }

   /**
    * Rerender the tabs
    * @return string html content of the menu
    */
   public function ReRender()
   {
      return $this->Render();
   }
   
   /**
    * Include client javascripts or CSS in the html content
    * @return void
    */
   protected function SetClientScripts($tabs, $hasForms)
   {
      global $g_BizSystem;
      $g_BizSystem->GetClientProxy()->AppendScripts("tabs", "tabs.js");
      $g_BizSystem->GetClientProxy()->AppendStyles("tabs", "tabs.css");
      if ($hasForms) {
         $tab_script = '<script type = "text/javascript">'.PHP_EOL;    
         foreach ($tabs as $tab) {     
            $tab_script .=   'var '.$tab['name'].'_config = '.$tab['forms'].';'.PHP_EOL;
         }
         $tab_script .=   'var '.$this->m_Name.'_active = '.$this->m_ActiveCssClassName.';'.PHP_EOL;      
         $tab_script .=   'var '.$this->m_Name.'_inactive = '.$this->m_InactiveCssClassName.';'.PHP_EOL;      
         $tab_script .= '</script>';
         $g_BizSystem->GetClientProxy()->AppendScripts("tab_forms_$this->m_Name", $tab_script, FALSE);   
      }   
   }      
   
}

/**
 * TabView - class TabView is internal class mapping to the metadata of View element in HTMLTabs
 *
 * @package BizView
 * @author rocky swen
 * @copyright Copyright (c) 2005
 * @version 1.2
 * @access public
 */
class TabView
{
   public $m_Name;
   public $m_View;
   public $m_ViewSet;
   public $m_Caption;
   public $m_URL;
   public $m_Target;
   public $m_Icon;
   public $m_Forms; //Forms for hide or show in a BizView

   /**
    * Get forms or the form to hide or show. When It has one form It hasn't the ATTRIBUTES property
    *
    * @param array $forms
    * @return array
    **/
   private function getForms($forms){
   	  $recArr=array();
   	  foreach($forms as $form){
   	  	if(!is_null($form["ATTRIBUTES"])) $recArr[]=$form["ATTRIBUTES"];
   	  	else $recArr[]=$form;
   	  }
   	  return $recArr;
   }

   /**
    * Initialize TabView with xml array
    *
    * @param array $xmlArr
    * @return void
    */
   function __construct(&$xmlArr)
   {
      $this->m_Name = $xmlArr["ATTRIBUTES"]["NAME"];
      $this->m_View = $xmlArr["ATTRIBUTES"]["VIEW"];
      $this->m_ViewSet = $xmlArr["ATTRIBUTES"]["VIEWSET"];
      $this->m_Caption =I18n::getInstance()->translate($xmlArr["ATTRIBUTES"]["CAPTION"]);
      $this->m_URL = $xmlArr["ATTRIBUTES"]["URL"];
      $this->m_Target = $xmlArr["ATTRIBUTES"]["TARGET"];
      $this->m_Icon = $xmlArr["ATTRIBUTES"]["ICON"];

      $this->m_Forms	= (!is_null($xmlArr["FORM"]))?$this->getForms($xmlArr["FORM"]):null; //Get form or forms to hide or show
   }
   
   /**
    * Return TRUE if the current tabView has forms related to it
    * @return bool
    */
   function hasForms() {
   		return (bool) $this->m_Forms;
   }   
   
}
?>
