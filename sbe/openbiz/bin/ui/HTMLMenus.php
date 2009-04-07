<?PHP
/**
 * HTMLMenus - class HTMLMenus is the base class of HTML menus
 * 
 * @package BizView
 * @author rocky swen 
 * @copyright Copyright (c) 2005
 * @version 1.2
 * @access public 
 */
class HTMLMenus extends MetaObject implements iUIControl 
{
   protected $m_MenuItemsXml = null;
      
   /**
    * Initialize HTMLMenus with xml array
    *
    * @param array $xmlArr
    * @return void
    */
   function __construct(&$xmlArr)
   {
      $this->ReadMetadata($xmlArr);
      global $g_BizSystem;
      $g_BizSystem->GetClientProxy()->AppendStyles("menu", "menu.css");
	  $g_BizSystem->GetClientProxy()->AppendScripts("menu-ie-js", '<!--[if gte IE 5.5]>
		<script language="JavaScript" src="../js/ie_menu.js" type="text/JavaScript"></script>
		<![endif]-->', false); 

   }
   
   /**
    * Read Metadata from xml array 
    * @param array $xmlArr
    */
   protected function ReadMetadata(&$xmlArr)
   {
      $this->m_Name = $xmlArr["MENU"]["ATTRIBUTES"]["NAME"];
      $this->m_Package = $xmlArr["MENU"]["ATTRIBUTES"]["PACKAGE"];
      $this->m_Class = $xmlArr["MENU"]["ATTRIBUTES"]["CLASS"];
      
      $this->m_MenuItemsXml = $xmlArr["MENU"]["MENUITEM"];
   }
   
   /**
    * Render the html menu
    * @return string html content of the menu
    */
   public function Render()
   {
      // list all views and highlight the current view
      $sHTML = "<ul id='navmenu'>\n";
      $sHTML .= $this->RenderMenuItems($this->m_MenuItemsXml);
      $sHTML .= "</ul>";
      return $sHTML;
   }
   
   /**
    * Render menu items
    * @param array $menuItemArray menu item array
    * @return string html content of the menu items
    */
   protected function RenderMenuItems(&$menuItemArray)
   {
      $sHTML = "";
      if (isset($menuItemArray["ATTRIBUTES"]))
      {
         $sHTML .= $this->RenderSingleMenuItem($menuItemArray);
      }
      else 
      {
         foreach ($menuItemArray as $menuItem)
         {
            $sHTML .= $this->RenderSingleMenuItem($menuItem);
         }
      }
      return $sHTML;
   }
   
   /**
    * Render single menu item
    * @param array $menuItem menu item metadata xml array 
    * @return string html content of each menu item
    */
   protected function RenderSingleMenuItem(&$menuItem)
   {


      global $g_BizSystem;		   		   
      $profile = $g_BizSystem->GetUserProfile();
      $svcobj = $g_BizSystem->GetService("accessService");
      $role = isset($profile["ROLE"]) ? $profile["ROLE"] : null;

      if (array_key_exists('URL', $menuItem["ATTRIBUTES"])) {
         $url = $menuItem["ATTRIBUTES"]["URL"];
      } elseif (array_key_exists('VIEW', $menuItem["ATTRIBUTES"])) {
         $view = $menuItem["ATTRIBUTES"]["VIEW"];
         // menuitem's containing VIEW attribute is renderd if access is granted in accessservice.xml
         // menuitem's are rendered if no definition is found in accessservice.xml (default)
         if ($svcobj->AllowViewAccess($view, $role))
         {
           	$url="javascript:GoToView('".$view."')";
         } else {
            return '';
         }
      }
      
      $caption = I18n::getInstance()->translate($menuItem["ATTRIBUTES"]["CAPTION"]);
      $target = $menuItem["ATTRIBUTES"]["TARGET"];
      $icon = $menuItem["ATTRIBUTES"]["ICON"];
      $img = $icon ? "<img src='../images/$icon' class=menu_img> " : "";

	  if ($view) 
      	$url="javascript:GoToView('".$view."')";
            
      if ($target)
         $sHTML .= "<li><a href=\"".$url."\" target='$target'>$img".$caption."</a>";
      else
         $sHTML .= "<li><a href=\"".$url."\">$img".$caption."</a>";
      if ($menuItem["MENUITEM"]) {
         $sHTML .= "\n<ul>\n";
         $sHTML .= $this->RenderMenuItems($menuItem["MENUITEM"]);
         $sHTML .= "</ul>";
      }
      $sHTML .= "</li>\n";
      
      return $sHTML;
   }
   
   /**
    * Rerender the menu
    * @return string html content of the menu 
    */
   public function ReRender() 
   { 
   	  return $this->Render(); 
   }
}

?>
