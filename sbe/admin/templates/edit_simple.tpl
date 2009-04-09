<form id='{$name}' name='{$name}'>
   <div class="content">
      <div id="{$name}_toolbar" class=tbl_toolbar>
         <ul id=toolbar>
         {foreach item=btn from=$toolbar}
           <li>{$btn}</li>
         {/foreach}
         </ul>
      </div>
      <div id="{$name}_data" style="clear:both;">
         <table width=100% border=0 cellspacing=1 cellpadding=3 class=tbl>
         {foreach item=item from=$fields}
         <tr>
         <td width=100 class=item align=right valign=top class=cell>{$item.label}
         {if $item.required=="Y"} <span class='required'>*</span>{/if}</td>
         <td valign=top class=cell_edit>{$item.control}</td>
         </tr>
         {/foreach}
         </table>
      </div>
   </div>
</form>
<script>focusFirstInput('{$name}');</script>