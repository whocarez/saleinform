<form id={$name} name={$name} style="margin:0" onclick="SetActiveForm('{$name}')" class='inactive_form'>
<table width=200 border=0 cellspacing=0 cellpadding=0>
<tr><td width=0% class=title>{$title}</td></tr>
<tr><td>
<div id="{$name}_toolbar">
<table width=100% cellspacing=0 cellpadding=1 class=tbl_title>
<tr>
<td width=50% align=left>
<table cellspacing=2 cellpadding=0><tr>
{foreach item=btn from=$toolbar}
  <td>{$btn}</td>
{/foreach}
<td><div id='{$name}.load_disp' style="display:none"><img src="../images/indicator.white.gif"/></div></td>
</tr></table>
</td>
<td width=50% align=right>
<table cellspacing=2 cellpadding=1><tr>
<td></td><td class="nav_w"></td><td></td>
</tr></table>
</td>
</table>
</div>
</td></tr>
<tr><td>
<div id="{$name}_data">
{$block}
</div>
</td></tr>
</table>
</form>