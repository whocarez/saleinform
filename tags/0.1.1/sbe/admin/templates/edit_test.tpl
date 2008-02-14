<form id={$name} name={$name}>
<table width=100% border=0 cellspacing=0 cellpadding=0 class=tbl>
<tr><td colspan=2>
<div id="{$name}_toolbar">
<table width=100% cellspacing=0 cellpadding=1>
<tr>
<td width=0% class=title>{$title}</td></tr>
<tr  bgcolor=gray>
<td align=left colspan=2>
<table cellspacing=2 cellpadding=0><tr>
{foreach item=btn from=$toolbar}
  <td>{$btn}</td>
{/foreach}
</tr></table>
</td>
</table>
</div>
</td></tr>
<tr><td width="250" valign=top>
<table width=100% border=0 cellspacing=1 cellpadding=3>
<tr>
<td width=100 class=item align=right valign=top>{$fields.combo1.label}</td>
<td valign=top class=cell_edit>{$fields.combo1.control}</td>
</tr>
<tr>
<td width=100 class=item align=right valign=top>{$fields.edit1.label}</td>
<td valign=top class=cell_edit>{$fields.edit1.control}</td>
</tr>
<tr>
<td width=100 class=item align=right valign=top>{$fields.edit2.label}</td>
<td valign=top class=cell_edit>{$fields.edit2.control}</td>
</tr>
<tr>
<td width=100 class=item align=right valign=top>{$fields.combo2.label}</td>
<td valign=top class=cell_edit>{$fields.combo2.control}</td>
</tr>
<tr>
<td width=100 class=item align=right valign=top>{$fields.edit3.label}</td>
<td valign=top class=cell_edit>{$fields.edit3.control}</td>
</tr>
</table>
</td>
<td>
<table width=100% border=0 cellspacing=1 cellpadding=3>
<tr>
<td width=150 class=item align=right valign=top>{$fields.richedit.label}</td>
<td>{$fields.richedit.control}</td>
</tr>
</table>
</td>
</tr>
</table>
</form>