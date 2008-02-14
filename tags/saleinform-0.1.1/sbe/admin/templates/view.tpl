<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"> 
  <title>{$view_description}</title>
  <link rel="stylesheet" href="../css/style.css" type="text/css">
  <link rel="stylesheet" href="../css/openbiz.css" type="text/css">
  {$style_sheets}
  <script language="javascript" src="../js/clientUtil.js"></script>
  <script language="javascript" src="../js/jsval.js"></script>
  <!-- dynarch calendar includes -->
  <style type="text/css">@import url(../js/jscalendar/calendar-system.css);</style>
	<script type="text/javascript" src="../js/jscalendar/calendar.js"></script>
	<script type="text/javascript" src="../js/jscalendar/lang/calendar-en.js"></script>
	<script type="text/javascript" src="../js/jscalendar/calendar-setup.js"></script>
	<script type="text/javascript" src="../js/calendar.js"></script>
  <!-- -->
</head>
<body bgcolor="#EDEDED">
{$scripts}
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
