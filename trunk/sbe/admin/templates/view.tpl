<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"> 
  <title>{$view_description}</title>
  {$style_sheets}
  {$scripts}
</head>
<body bgcolor="#EDEDED">

{$controls[0]}
<table width=100% border=0 cellspacing=10 cellpadding=0>
{section name=i loop=$controls}
   {if $smarty.section.i.index != 0}
   <tr><td>
   {$controls[i]}
   </td></tr>
   {/if}
{sectionelse}
   <b>Array $controls has no entries</b>
{/section}
</table>

</body>
</html>
