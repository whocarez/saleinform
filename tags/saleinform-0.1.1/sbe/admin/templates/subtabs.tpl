<div id='Tabs_container' class='title'>
   <table cellspacing="0" cellpadding="0" border="0" width="100%">
		<tr>
			<td style="padding-left:14px; border-bottom: 1px solid #999">&nbsp;</td>
	   
		{foreach item=tab from=$tabs name=tabloop}
        <td>
         <table cellspacing="0" cellpadding="0" border="0" width="100%">
				<tr>
				{if $tab.current == 1}
      			<td class="currentTabLeft2"><img src="../images/blank.gif" width="5" height="25" border="0"></td>
      		   <td class="currentTab2" nowrap><a class="currentTabLink"  href="{$tab.url}">{$tab.caption}</A></td>
      			<td class="currentTabRight2"><img src="../images/blank.gif" width="5" height="25" border="0"></td>
      	   {else}
      	     {if $smarty.foreach.tabloop.index == 0 }
      	      <td class="otherTabFirst"><img src="../images/blank.gif" width="5" height="25" border="0"></td>
      	     {else}
      	      <td class="otherTabLeft"><img src="../images/blank.gif" width="5" height="25" border="0"></td>
      	     {/if}
		         <td class="otherTab" nowrap><a   class="otherTabLink"  href="{$tab.url}">{$tab.caption}</A></td>
			      <td class="otherTabRight"><img src="../images/blank.gif" width="5" height="25" border="0"></td>
      	   {/if}
				</tr>
			</table>
        </td>
      {/foreach}
			
			<td width="100%" style="border-bottom: 1px solid #999"><img src="../images/blank.gif" width="1" height="1" border="0" alt=""></td>
			
		</tr>

		</table>
</div>