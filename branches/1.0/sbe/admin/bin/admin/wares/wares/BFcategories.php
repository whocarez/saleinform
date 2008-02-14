<?php
/*
 * BFcategories class
 */
class BFcategories extends BizForm 
{ 
	protected $m_Mode = "READ";
	/*Tree*/
	private $m_TreeRootIndex = 0;
	private $m_TreeRecList = null;
	private $m_TreeCurrIndexParents = array();
	private $m_TreeRecListById = array();
	private $m_TreeRecListByParents = array();
	private $m_TreeHTML = '';
	private $m_TreeTempLevel = 0;
	/*----*/


	public function Render()
	{
	   // when in NEW mode or when parent form in NEW mode, do nothing
	   global $g_BizSystem;
	   $prtMode = "";
	   if ($this->m_ParentFormName) {
         $prtForm = $g_BizSystem->GetObjectFactory()->GetObject($this->m_ParentFormName);
         $prtMode = $prtForm->GetDisplayMode()->GetMode();
	   }
	   if ($this->m_Mode != MODE_N && $prtMode != MODE_N)
	   {
   	   if ($this->GetDataObj()) {
            if ($this->m_HistoryInfo) {
               $this->m_HistRecordId = $this->m_HistoryInfo[0];
               $this->m_CursorIndex = $this->GetIndexById($this->m_HistRecordId);
               $this->GetDataObj()->SetBookmark($this->m_HistoryInfo);
            }
            else
            {
            	$this->m_CursorIndex = $this->GetStartIndex();
            }
   	   }
	   }
	   if ($this->m_Mode == MODE_N)
         $this->UpdateActiveRecord($this->GetDataObj()->NewRecord());
         
	   global $g_BizSystem;
	   // prepare the subforms' dataobjs, since the subform relates to parent form by dataobj association
	   if ($this->m_SubForms) {
   	   foreach($this->m_SubForms as $subForm) {
            $formObj = $g_BizSystem->GetObjectFactory()->GetObject($subForm);
            $dataObj = $this->GetDataObj()->GetRefObject($formObj->m_DataObjName);
            if ($dataObj)
               $formObj->SetDataObj($dataObj);
         }
	   }
      return $this->RenderHTML();
	}
	
	
	public function RenderHTML()
	{
		if ($this->m_Mode != MODE_R) return parent::RenderHTML();
		$dispmode = $this->GetDisplayMode();
		$this->SetDisplayMode($dispmode->GetMode());
		$smarty = BizSystem::GetSmartyTemplate();
		
		$smarty->assign_by_ref("name", $this->m_Name);
		$smarty->assign_by_ref("title", $this->m_Title);
      	$smarty->assign_by_ref("formstate", $this->m_FormState);
		$smarty->assign_by_ref("toolbar", $this->m_ToolBar->Render());
		// set search rule
		$searchRule = "[archive]=0";
		$recList = array();
		// get recordset
		$this->GetDataObj()->FetchRecords($searchRule, $recList);
		
		/* Render Table */
		$cls_tbl = strlen($dispmode->m_FormatStyle[0])>0 ? "class=".$dispmode->m_FormatStyle[0] : "";
		$sHTML_tbl  = "<table width=100% border=0 cellspacing=0 cellpadding=3 $cls_tbl>\n";
		$sHTML_tbl .= "<tr><th class=head>&nbsp;&nbsp;</th></tr>\n";
		$this->CreateTree($recList); // render table rows
		$sHTML = $this->m_TreeHTML;
		$sHTML_tby = "<tbody id='".$this->m_Name."_tbody' Highlighted='".$this->m_Name."_data_".($this->m_CursorIndex+1)."' SelectedRow='".($this->m_CursorIndex+1)."'>\n";
		$sHTML = $sHTML_tbl . $sHTML_tby . $sHTML . "</tbody></table>";
		$this->SetCursorIndex($this->m_CursorIndex);
		/* ************ */
		
		$smarty->assign_by_ref("block", $sHTML);
		return $smarty->fetch($dispmode->m_TemplateFile).$this->RenderShortcutKeys();		
	}

	public function CreateTree($recList)
	{
		$this->m_TreeCurrIndexParents = array();
		$this->m_TreeRecListById = array();
		$this->m_TreeRecListByParents = array();
		$this->m_TreeHTML = '';
		$this->m_TreeTempLevel = 0;
		
		$this->m_TreeRecList = $recList;
		foreach($this->m_TreeRecList as $index=>$rec)
		{ 
			$this->m_TreeRecListById[$rec['Id']]=array('index'=>$index, 'parent'=>$rec['_categories_rid'], 'name'=>$rec['name']);
			$this->m_TreeRecListByParents[$rec['_categories_rid']][] =  array('index'=>$index, 'id'=>$rec['Id'], 'name'=>$rec['name']);
		}
		$this->m_TreeCurrIndexParents = $this->TreeGetParents($this->m_TreeRecList[$this->m_CursorIndex]['Id']);
		$this->TreeMakeTree($this->m_TreeRootIndex);
	}
	
	public function TreeGetParents($Id)
	{
		global $parents;
		$parentId = $this->m_TreeRecListById[$Id]['parent'];
		if($parentId != $this->m_TreeRootIndex)
		{
			$parents[] = $this->m_TreeRecListById[$Id]['index'];
			$this->TreeGetParents($parentId);
		}
		else
		{
			$parents[] = $this->m_TreeRecListById[$Id]['index'];
		}
      	return array_reverse($parents);
	}
	
	public function TreeMakeTree($parent)
	{
		$tmpList = $this->m_TreeRecListByParents[$parent];
		$this->m_TreeTempLevel++;
		if($tmpList)
		{
			foreach($tmpList as $rec)
			{
				$this->m_CursorIDMap[$rec['index']] = $rec["id"];
        		if($rec['id'] != $this->m_TreeRootIndex)
        		{
        			$hasSub = $this->m_SubForms ? 0 : 1;
        			$name = $this->m_Name;	
					$rownum = $rec['index']+1;
					$rowid = $name."_data_".$rownum;
					
					if ($this->m_HistRecordId != null && $this->m_HistRecordId == $rec['id']) 
					{
						#echo "HERE_1 => ".$this->m_HistRecordId." => ".$rec['name'];
               			$this->m_CursorIndex = $rec['index'];
               			$style_class = "class=rowsel";
            		}
            		else if ($rec['index'] == $this->m_CursorIndex)
            		{
            			#echo "HERE_2 => ".$this->m_CursorIndex." => ".$rec['name'];	
            			$style_class = "class=rowsel";
            		}
            		else $style_class = "class=rowodd";
					$onclick = "onclick=\"CallFunction('$name.SelectRecord($rownum,$hasSub)');\""; 
					if(!array_key_exists($rec['id'], $this->m_TreeRecListByParents)) 
						$image = '<img src="../images/topic.gif" align="absmiddle">&nbsp;&nbsp;';
					else if(array_key_exists($rec['id'], $this->m_TreeRecListByParents) && !in_array($rec['index'], $this->m_TreeCurrIndexParents))
						$image = '<img src="../images/plus.gif" align="absmiddle">&nbsp;&nbsp;';
					else $image = '<img src="../images/minus.gif" align="absmiddle">&nbsp;&nbsp;';
        			$spaces = ''; 
					for($i=1; $i<$this->m_TreeTempLevel; $i++) $spaces .= '&nbsp;&nbsp;&nbsp;&nbsp;';
		            $this->m_TreeHTML .= "<tr id='$rowid' $style_class $attr $onclick>\n<td>".$spaces.$image.$rec['name']."</td></tr>\n";
        		}
        		if(in_array($rec['index'], $this->m_TreeCurrIndexParents))
        		{  
        			$Id = $rec['id'];
        			$this->TreeMakeTree($Id, $lvl);
        			$this->m_TreeTempLevel--;
        		}
			}
		}
	}

	public function SelectRecord()
	{
		global $g_BizSystem;
		$rownum = $g_BizSystem->GetClientProxy()->GetFormInputs("__SelectedRow");
		if ($rownum < 1 || $rownum > $this->m_Range) return;
		$cursorIndex = $rownum-1;
		if ($this->m_CursorIndex == $cursorIndex)   return;
		$this->m_CursorIndex = $cursorIndex;
		return $this->ReRender(true);   // redraw the this form, and the subforms
	}
	
	public function RefreshQuery()
	{
		if ($this->m_OnSortField) 
		{
			$this->SetSortFieldFlag($this->m_OnSortField, null);
			$this->m_OnSortField = null;
			$this->GetDataObj()->ClearSortRule();
		}
		$this->m_SearchRule = "";
		$this->SetDisplayMode (MODE_R);
		$this->m_CursorIndex = $this->GetStartIndex();
		$this->m_ClearSearchRule = true;
		return $this->ReRender();
	}

	public function GetStartIndex()
	{
		$startIndex = 0;
		// set search rule
		$searchRule = "[archive]=0";
		$recList = array();
		// get recordset
		$this->GetDataObj()->FetchRecords($searchRule, $recList);
		foreach($recList as $index=>$rec)
		{
			if ($rec['_categories_rid'] == $this->m_TreeRootIndex)
			{ 
				$startIndex = $index;
				break;
			}
		}
		return $startIndex;
	}
	
	public function GetIndexById($Id)
	{
		$idIndex = 0;
		// set search rule
		$searchRule = "[archive]=0";
		$recList = array();
		// get recordset
		$this->GetDataObj()->FetchRecords($searchRule, $recList);
		foreach($recList as $index=>$rec)
		{
			if ($rec['Id'] == $Id)
			{ 
				$idIndex = $index;
				break;
			}
		}
		return $idIndex;
	}
}

?>